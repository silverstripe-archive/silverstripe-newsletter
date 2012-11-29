<?php

/**
 * Provides view and edit forms at Newsletter gridfield dataobjects,
 * giving special buttons for sending out the newsletter
 */
class NewsletterGridFieldDetailForm extends GridFieldDetailForm {
}

class NewsletterGridFieldDetailForm_ItemRequest extends GridFieldDetailForm_ItemRequest {

	public function updateCMSActions($actions) {
		// remove delete button
		$actions->removeByName("action_doDelete");

		// save draft button
		$saveButton = $actions->fieldByName("action_doSave")
			->setTitle(_t('Newsletter.SAVEDRAFT', "Save draft"))
			->removeExtraClass('ss-ui-action-constructive')
			->setAttribute('data-icon', 'addpage');

		//Save as template button
		$previewButton = FormAction::create('doSaveAsTemplete', _t('Newsletter.SAVEASTEMPLATE', "Save as template"));
		$actions->push($previewButton->setAttribute('data-icon', 'savepage'));

		// send button 
		Requirements::javascript(NEWSLETTER_DIR . '/javascript/NewsletterSendConfirmation.js'); //styles for $sentReport
//		if ($this->SentDate) {
//			$sendButton = FormAction::create('doSend', _t('Newsletter.RESEND', 'Resend'));
//		} else {
			$sendButton = FormAction::create('doSend', _t('Newsletter.SaveAndSend','Save & Send...'));
//		}

		$actions->insertBefore($sendButton
				->addExtraClass('ss-ui-action-constructive')
				->setAttribute('data-icon', 'accept')
				->setUseButtonTag(true), 'action_doSave');

		return $actions;
	}

	public function ItemEditForm(){
		$form = parent::ItemEditForm();
		// Do these action update only when the current record is_a newsletter
		if($this->record && $this->record instanceof Newsletter) {
			$form->setActions($this->updateCMSActions($form->Actions()));
		}
		return $form;
	}
	/**
	 * @return string
	 */
	public function LinkPreview() {
		if($this->record && $this->record instanceof Newsletter) {
			return $this->Link()."/preview";
		}else{
			return false;
		}
	}

	public function doSend($data, $form){
		//copied from parent
		$new_record = $this->record->ID == 0;
		$controller = Controller::curr();

		try {
			$form->saveInto($this->record);
			$id = $this->record->write();
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
		NewsletterSendController::send($id);
		$message = _t('NewsletterAdmin.SendMessage',
			'Send-out process started successfully. Check the progress in the "Sent Recipients" tab');
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

	public function doPreview(){
		// TODO preview function
	}

	public function doSaveAsTemplete(){
		// TODO Save AS Template function
	}
}