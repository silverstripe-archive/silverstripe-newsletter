<?php

namespace SilverStripe\Newsletter\Form\GridField;

use SilverStripe\Forms\GridField\GridFieldDetailForm_ItemRequest;
use SilverStripe\Forms\FormAction;
use SilverStripe\Forms\HiddenField;
use SilverStripe\Forms\LiteralField;
use SilverStripe\Newsletter\Model\Newsletter;
use SilverStripe\Security\Member;
use SilverStripe\View\ArrayData;
use SilverStripe\View\Requirements;
use SilverStripe\Control\Controller;
use SilverStripe\Core\Config\Config;

class NewsletterGridFieldDetailForm_ItemRequest extends GridFieldDetailForm_ItemRequest
{
    private static $allowed_actions = [
        'ItemEditForm',
        'emailpreview',
        'doSend',
        'preview'
    ];

    protected function getFormActions()
    {
        $actions = parent::getFormActions();

        if (empty($this->record->Status) || $this->record->Status == "Draft") {
            // save draft button
            $actions->fieldByName("MajorActions.action_doSave")
                ->setTitle(_t('Newsletter.SAVE', "Save"))
                ->removeExtraClass('ss-ui-action-constructive')
                ->setAttribute('data-icon', 'addpage');
        } else {    //sending or sent, "save as new" button
            $saveAsNewButton = FormAction::create('doSaveAsNew', _t('Newsletter.Duplicate', "Duplicate"));
            $actions->replaceField(
                "action_doSave",
                $saveAsNewButton
                    ->addExtraClass('btn action btn-primary font-icon-back-in-time')
                    ->setUseButtonTag(true),
                'action_doSaveAsNew'
            );
        }

        // send button
        if ($this->record->Status == "Draft") { //only allow sending when the newsletter is "Draft"
            $sendButton = FormAction::create('doSend', _t('Newsletter.Send', 'Send'));
            $actions->insertBefore(
                $sendButton
                    ->addExtraClass('btn action btn-primary font-icon-rocket')
                    ->setUseButtonTag(true),
                'action_doSave'
            );

            $viewPreviewButton = FormAction::create('doViewPreview', _t('Newsletter.ViewPreview', 'View Preview'));
            $actions->insertBefore(
                $viewPreviewButton
                    ->addExtraClass('btn action btn-outline btn-outline-info btn-hide-outline font-icon-eye')
                    ->setUseButtonTag(true),
                'action_doDelete'
            );

            $sendPreviewButton = FormAction::create('doSendPreview', _t('Newsletter.SendPreview', 'Send Test Preview'));
            $actions->insertBefore(
                $sendPreviewButton
                    ->addExtraClass('btn action btn-outline btn-outline-info btn-hide-outline font-icon-rocket')
                    ->setUseButtonTag(true),
                'action_doDelete'
            );
        }

        return $actions;
    }

    /**
     * Send the preview/test email
     */
    public function emailpreview()
    {
        $origState = Config::inst()->get('SSViewer', 'theme_enabled');
        Config::inst()->update('SSViewer', 'theme_enabled', true);

        $request = Controller::curr()->getRequest();
        $emailVar = $request->getVar('email');

        $recipient = new Recipient(Recipient::config()->get('test_data'));

        if ($request && !empty($emailVar)) {
            $recipient->Email = Convert::raw2js($emailVar);
        } else {
            $recipient->Email = Member::currentUser()->Email;
        }

        $newsletter = $this->record;
        $email = NewsletterEmail::create($newsletter, $recipient, true);
        $email->send();
        Config::inst()->update('SSViewer', 'theme_enabled', $origState);

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

    /**
     * @param array $data
     * @param Form  $form
     */
    public function doSaveAsNew($data, $form)
    {
        $originalID = $data['NEWSLETTER_ORIGINAL_ID'];
        $origNewsletter = Newsletter::get()->byId($originalID);
        $controller = Controller::curr();

        if (!$origNewsletter) {
            return Controller::curr()->redirectBack();
        }

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

            // save once to get the new Newsletter created so as to add to mailing list
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
            $responseNegotiator = new PjaxResponseNegotiator(
                array(
                'CurrentForm' => function () use (&$form) {
                    return $form->forTemplate();
                },
                'default' => function () use (&$controller) {
                    return $controller->redirectBack();
                }
                )
            );
            if ($controller->getRequest()->isAjax()) {
                $controller->getRequest()->addHeader('X-Pjax', 'CurrentForm');
            }
            return $responseNegotiator->respond($controller->getRequest());
        }

        $form->sessionMessage(
            _t(
                'NewsletterAdmin.SaveAsNewMessage',
                'New Newsletter created as copy of the sent newsletter'
            ),
            'good'
        );

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
            $this->record->scheduleSend();
            $this->gridField->getList()->add($this->record);
        } catch (ValidationException $e) {
            $form->sessionMessage($e->getResult()->message(), 'bad');
            $responseNegotiator = new PjaxResponseNegotiator(
                array(
                'CurrentForm' => function () use (&$form) {
                    return $form->forTemplate();
                },
                'default' => function () use (&$controller) {
                    return $controller->redirectBack();
                }
                )
            );
            if ($controller->getRequest()->isAjax()) {
                $controller->getRequest()->addHeader('X-Pjax', 'CurrentForm');
            }
            return $responseNegotiator->respond($controller->getRequest());
        }

        $message = _t(
            'NewsletterAdmin.SendMessage',
            'Send-out process started successfully. Check the progress in the "Sent To" tab'
        );

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

    public function doSendPreview($data, $form)
    {
        $form->saveInto($this->record);
        $this->record->write();

        return $this->record->render();
    }

    public function doViewPreview($data, $form)
    {
        $form->saveInto($this->record);
        $this->record->write();

        return $this->controller->redirect($this->Link('preview'), 302);
    }

    public function preview()
    {
        if ($this->record && $this->record->canView()) {
            return $this->record->render();
        } else {
            $this->controller->httpError(404);
        }
    }
}
