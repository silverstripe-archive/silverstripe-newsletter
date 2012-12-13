<?php

/**
 * Provides view and edit forms at Newsletter gridfield dataobjects,
 * giving special buttons for sending out the newsletter
 */
class NewsletterGridFieldDetailForm extends GridFieldDetailForm {
}

class NewsletterGridFieldDetailForm_ItemRequest extends GridFieldDetailForm_ItemRequest {

	public function updateCMSActions($actions) {
		if (empty($this->record->Status) || $this->record->Status == "Draft") {
			// save draft button
			$actions->fieldByName("action_doSave")
				->setTitle(_t('Newsletter.SAVEDRAFT', "Save Draft"))
				->removeExtraClass('ss-ui-action-constructive')
				->setAttribute('data-icon', 'addpage');
		} else {    //sending or sent, "save as new" button
			$saveAsNewButton = FormAction::create('doSaveAsNew', _t('Newsletter.SaveAsNew',"Save as new Draft..."));
			$actions->replaceField("action_doSave",
				$saveAsNewButton
				->addExtraClass('ss-ui-action-constructive')
				->setAttribute('data-icon', 'addpage')
				->setUseButtonTag(true), 'action_doSaveAsNew');
		}

		// send button
		if ($this->record->Status == "Draft") { //only allow sending when the newsletter is "Draft"
			Requirements::javascript(NEWSLETTER_DIR . '/javascript/NewsletterSendConfirmation.js');
			$sendButton = FormAction::create('doSend', _t('Newsletter.SendAndArchive','Send and Archive'));
			$actions->insertBefore($sendButton
							->addExtraClass('ss-ui-action-constructive')
							->setAttribute('data-icon', 'accept')
							->setUseButtonTag(true), 'action_doSave');
		}
		$actions->removeByName("action_doDelete");

		if($this->record && $this->record instanceof Newsletter){
			$archiveButton = FormAction::create('doArchive', _t('Newsletter.ArchiveButton', "Archive"))
				->addExtraClass('ss-ui-action-distructive')
				->setAttribute('data-icon', 'plug-disconnect-prohibition')
				->setUseButtonTag(true);
			$actions->push($archiveButton);
		}

		return $actions;
	}

	public function ItemEditForm(){
		$form = parent::ItemEditForm();
		// Do these action update only when the current record is_a newsletter
		if($this->record && $this->record instanceof Newsletter) {
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
	public function getSilverStripeNavigator() {
		$newsletter = $this->record;
		if($newsletter) {
			$navigator = new SilverStripeNavigator($newsletter);

			//create the link the send a preview email
			$member = Member::currentUser();
			$emailLink = '?email=';
			if ($member) {
				$emailLink .= $member->Email;
			}

			$navigator->customise(new ArrayData(array('EmailPreviewLink' => $newsletter->Link('emailpreview'.$emailLink))));
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
	public function emailpreview(SS_HTTPRequest $request = null) {
		$emailVar = $request->getVar('email');
		if ($request && !empty($emailVar)) {
			$testEmail = new stdClass();
			$testEmail->Email = Convert::raw2js($emailVar);
		} else {
			$testEmail = Member::currentUser();
		}

		//set some fields on our fake object for the email test
		$testEmail->FirstName = "HereAsFirstName";
		$testEmail->MiddleName = "HereAsMiddleName";
		$testEmail->Surname = "HereAsSurname";
		$testEmail->Salutation = "HereAsSalutation";

		$newsletter = $this->record;
		$email = new NewsletterEmail($newsletter, $testEmail, true);
		$email->send();

		return Controller::curr()->redirectBack();
	}

	/**
	 * @return string
	 */
	public function LinkPreview() {
		if($this->record && $this->record instanceof Newsletter) {
			return $this->Link('preview');
		}else{
			return false;
		}
	}

	public function doSaveAsNew($data, $form){
		$newNewsletter = new Newsletter();
		$controller = Controller::curr();

		try {
			//write once without validation
			Newsletter::set_validation_enabled(false);
			$newNewsletter->write();
			Newsletter::set_validation_enabled(true);

			$form->saveInto($newNewsletter);

			$newNewsletter->Status = 'Draft';  //custom: changing the status of to indicate we are sending

			//add a (1) (2) count to new newsletter names if the subject name already exists elsewhere
			$subjectCount = 0;
			$newSubject = $newNewsletter->Subject;
			do {
				if ($subjectCount > 0) $newSubject = $newNewsletter->Subject . " ($subjectCount)";
				$existingSubjectCount = Newsletter::get()->filter(array('Subject'=>$newSubject))->count();
				$subjectCount++;
			} while($existingSubjectCount != 0);
			$newNewsletter->Subject = $newSubject;

			$newNewsletter->write();
		} catch(ValidationException $e) {
			$form->sessionMessage($e->getResult()->message(), 'bad');
			$responseNegotiator = new PjaxResponseNegotiator(array(
				'CurrentForm' => function() use(&$form) {
					return $form->forTemplate();
				},
				'default' => function() use(&$controller) {
					return $controller->redirectBack();
				}
			));
			if($controller->getRequest()->isAjax()){
				$controller->getRequest()->addHeader('X-Pjax', 'CurrentForm');
			}
			return $responseNegotiator->respond($controller->getRequest());
		}

		$form->sessionMessage(_t('NewsletterAdmin.SaveAsNewMessage',
			'New Newsletter created as copy of sent newsletter'), 'good');

		//create a link to the newly created object and open that instead of the old sent newsletter we had open before
		$link = Controller::join_links($this->gridField->Link('item'),$newNewsletter->ID ? $newNewsletter->ID : 'new');
		$link = str_replace('_Sent','',$link);
		return Controller::curr()->redirect($link);
	}

	public function doSend($data, $form){
		//copied from parent
		$new_record = $this->record->ID == 0;
		$controller = Controller::curr();

		try {
			$form->saveInto($this->record);
			$this->record->Status = 'Sending';  //custom: changing the status of to indicate we are sending
			$this->record->write();
			$this->gridField->getList()->add($this->record);
		} catch(ValidationException $e) {
			$form->sessionMessage($e->getResult()->message(), 'bad');
			$responseNegotiator = new PjaxResponseNegotiator(array(
				'CurrentForm' => function() use(&$form) {
					return $form->forTemplate();
				},
				'default' => function() use(&$controller) {
					return $controller->redirectBack();
				}
			));
			if($controller->getRequest()->isAjax()){
				$controller->getRequest()->addHeader('X-Pjax', 'CurrentForm');
			}
			return $responseNegotiator->respond($controller->getRequest());
		}

		//custom code
		$nsc = NewsletterSendController::inst();
		$nsc->enqueue($this->record);
		$nsc->processQueueOnShutdown($this->record->ID);

		$message = _t('NewsletterAdmin.SendMessage',
			'Send-out process started successfully. Check the progress in the "Sent Recipient Queue" tab');
		//end custom code

		$form->sessionMessage($message, 'good');

		if($new_record) {
			return Controller::curr()->redirect($this->Link());
		} elseif($this->gridField->getList()->byId($this->record->ID)) {
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

	public function preview($data){
		return $this->record->render();
	}


	public function doArchive($data, $form){
		$this->record->Archived = true;
		$this->record->write();
		$controller = Controller::curr();
		$noActionURL = $controller->removeAction($data['url']);
		$controller->getRequest()->addHeader('X-Pjax', 'Content');
		return $controller->redirect($noActionURL, 302);
	}

}