<?php
/**
 * @package  newsletter
 */

/**
 * Provides view and edit forms at Newsletter gridfield dataobjects,
 * giving special buttons for sending out the newsletter
 */
class NewsletterGridFieldDetailForm extends GridFieldDetailForm
{
}

class NewsletterGridFieldDetailForm_ItemRequest extends GridFieldDetailForm_ItemRequest
{
    private static $allowed_actions = array(
        'ItemEditForm',
        'emailpreview',
    );

    public function updateCMSActions($actions)
    {
        if (empty($this->record->Status) || $this->record->Status == "Draft") {
            // save draft button
            $actions->fieldByName("action_doSave")
                ->setTitle(_t('Newsletter.SAVE', "Save"))
                ->removeExtraClass('ss-ui-action-constructive')
                ->setAttribute('data-icon', 'addpage');
        } else {    //sending or sent, "save as new" button
            $saveAsNewButton = FormAction::create('doSaveAsNew', _t('Newsletter.SaveAsNew', "Save as new ..."));
            $actions->replaceField("action_doSave",
                $saveAsNewButton
                ->addExtraClass('ss-ui-action-constructive')
                ->setAttribute('data-icon', 'addpage')
                ->setUseButtonTag(true), 'action_doSaveAsNew');
        }

        // send button
        if ($this->record->Status == "Draft") { //only allow sending when the newsletter is "Draft"
            $sendButton = FormAction::create('doSend', _t('Newsletter.Send', 'Send'));
            $actions->insertBefore($sendButton
                            ->addExtraClass('ss-ui-action-constructive')
                            ->setAttribute('data-icon', 'accept')
                            ->setUseButtonTag(true), 'action_doSave');
        }
        return $actions;
    }

    public function ItemEditForm()
    {
        $form = parent::ItemEditForm();
        // Do these action update only when the current record is_a newsletter
        if ($this->record && $this->record instanceof Newsletter) {
            $form->setActions($this->updateCMSActions($form->Actions()));

            $form->Fields()->push(new HiddenField("PreviewURL", "PreviewURL", $this->LinkPreview()));
            // Added in-line to the form, but plucked into different view by LeftAndMain.Preview.js upon load
            $navField = new LiteralField('SilverStripeNavigator', $this->getSilverStripeNavigator());
            $navField->setAllowHTML(true);
            $form->Fields()->push($navField);
        }
        return $form;
    }

    /**
     * Used for preview controls
     *
     * @return ArrayData
     */
    public function getSilverStripeNavigator()
    {
        $newsletter = $this->record;
        if ($newsletter) {
            $navigator = new SilverStripeNavigator($newsletter);

            //create the link the send a preview email
            $member = Member::currentUser();
            $emailLink = '?email=';
            if ($member) {
                $emailLink .= $member->Email;
            }

            $navigator->customise(
                new ArrayData(array('EmailPreviewLink' => $newsletter->Link('emailpreview'.$emailLink)))
            );
            Requirements::javascript(NEWSLETTER_DIR . '/javascript/NewsletterAdminEmailPreview.js');

            return $navigator->renderWith('NewsletterAdmin_SilverStripeNavigator');
        } else {
            return false;
        }
    }

    /**
     * Send the preview/test email
     * @param SS_HTTPRequest $request
     */
    public function emailpreview(SS_HTTPRequest $request = null)
    {
        $emailVar = $request->getVar('email');

        $recipient = new Recipient(Recipient::$test_data);
        if ($request && !empty($emailVar)) {
            $recipient->Email = Convert::raw2js($emailVar);
        } else {
            $recipient->Email = Member::currentUser()->Email;
        }

        $newsletter = $this->record;
        $email = new NewsletterEmail($newsletter, $recipient, true);
        $email->send();

        return Controller::curr()->redirectBack();
    }

    /**
     * @return string
     */
    public function LinkPreview()
    {
        if ($this->record && $this->record instanceof Newsletter) {
            return $this->Link('preview');
        } else {
            return false;
        }
    }

    public function doSaveAsNew($data, $form)
    {
        $originalID = $data['NEWSLETTER_ORIGINAL_ID'];
        $origNewsletter = DataObject::get_by_id("Newsletter", $originalID);
        $controller = Controller::curr();

        try {
            $newNewsletter = clone $origNewsletter;

            //unset doesn't work, set system used fields to nulls.
            $newNewsletter->ID = null;
            $newNewsletter->Created = null;
            $newNewsletter->Status = null;
            $newNewsletter->LastEdited = null;
            $newNewsletter->SentDate = null;

            //write once without validation
            Newsletter::set_validation_enabled(false);
            //save once to get the new Newsletter created so as to add to mailing list
            $newNewsletter->write($showDebug = false, $forceInsert = true);
            $origMailinglists = $origNewsletter->MailingLists();
            if ($origMailinglists && $origMailinglists->count()) {
                $newNewsletter->MailingLists()->addMany($origMailinglists);
            }
            Newsletter::set_validation_enabled(true);
            $newNewsletter->Status = 'Draft';  //custom: changing the status of to indicate we are sending

            //add a (1) (2) count to new newsletter names if the subject name already exists elsewhere
            $subjectCount = 0;
            $newSubject = $newNewsletter->Subject;
            do {
                if ($subjectCount > 0) {
                    $newSubject = $newNewsletter->Subject . " ($subjectCount)";
                }
                $existingSubjectCount = Newsletter::get()->filter(array('Subject'=>$newSubject))->count();
                $subjectCount++;
            } while ($existingSubjectCount != 0);
            $newNewsletter->Subject = $newSubject;

            $newNewsletter->write();
        } catch (ValidationException $e) {
            $form->sessionMessage($e->getResult()->message(), 'bad');
            $responseNegotiator = new PjaxResponseNegotiator(array(
                'CurrentForm' => function () use (&$form) {
                    return $form->forTemplate();
                },
                'default' => function () use (&$controller) {
                    return $controller->redirectBack();
                }
            ));
            if ($controller->getRequest()->isAjax()) {
                $controller->getRequest()->addHeader('X-Pjax', 'CurrentForm');
            }
            return $responseNegotiator->respond($controller->getRequest());
        }

        $form->sessionMessage(_t('NewsletterAdmin.SaveAsNewMessage',
            'New Newsletter created as copy of the sent newsletter'), 'good');

        //create a link to the newly created object and open that instead of the old sent newsletter we had open before
        $link = Controller::join_links($this->gridField->Link('item'), $newNewsletter->ID ? $newNewsletter->ID : 'new');
        $link = str_replace('_Sent', '', $link);
        return Controller::curr()->redirect($link);
    }

    public function doSend($data, $form)
    {
        //copied from parent
        $new_record = $this->record->ID == 0;
        $controller = Controller::curr();

        try {
            $form->saveInto($this->record);
            $this->record->Status = 'Sending';  //custom: changing the status of to indicate we are sending
            $this->record->write();
            $this->gridField->getList()->add($this->record);
        } catch (ValidationException $e) {
            $form->sessionMessage($e->getResult()->message(), 'bad');
            $responseNegotiator = new PjaxResponseNegotiator(array(
                'CurrentForm' => function () use (&$form) {
                    return $form->forTemplate();
                },
                'default' => function () use (&$controller) {
                    return $controller->redirectBack();
                }
            ));
            if ($controller->getRequest()->isAjax()) {
                $controller->getRequest()->addHeader('X-Pjax', 'CurrentForm');
            }
            return $responseNegotiator->respond($controller->getRequest());
        }

        //custom code
        $nsc = NewsletterSendController::inst();
        $nsc->enqueue($this->record);
        $nsc->processQueueOnShutdown($this->record->ID);


        //javascript hides the success message appropriately
        Requirements::javascript(NEWSLETTER_DIR . '/javascript/NewsletterSendConfirmation.js');
        $message = _t('NewsletterAdmin.SendMessage',
            'Send-out process started successfully. Check the progress in the "Sent To" tab');
        //end custom code

        $form->sessionMessage($message, 'good');

        if ($new_record) {
            return Controller::curr()->redirect($this->Link());
        } elseif ($this->gridField->getList()->byId($this->record->ID)) {
            // Return new view, as we can't do a "virtual redirect" via the CMS Ajax
            // to the same URL (it assumes that its content is already current, and doesn't reload)
            return $this->edit(Controller::curr()->getRequest());
        } else {
            // Changes to the record properties might've excluded the record from
            // a filtered list, so return back to the main view if it can't be found
            $noActionURL = $controller->removeAction($data['url']);
            $controller->getRequest()->addHeader('X-Pjax', 'Content');
            return $controller->redirect($noActionURL, 302);
        }
    }

    public function preview($data)
    {
        return $this->record->render();
    }
}
