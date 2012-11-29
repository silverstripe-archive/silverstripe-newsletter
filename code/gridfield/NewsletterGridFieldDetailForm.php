<?php

/**
 * Provides view and edit forms at Newsletter gridfield dataobjects,
 * giving special buttons for sending out the newsletter
 */
class NewsletterGridFieldDetailForm extends GridFieldDetailForm {


}

class NewsletterGridFieldDetailForm_ItemRequest extends GridFieldDetailForm_ItemRequest {

	public function addCMSActions($actions) {
		Requirements::javascript(NEWSLETTER_DIR . '/javascript/NewsletterSendConfirmation.js'); //styles for $sentReport
//		if ($this->SentDate) {
//			$action = FormAction::create('doSend', _t('Newsletter.RESEND', 'Resend'));
//		} else {
			$action = FormAction::create('doSend', _t('Newsletter.SaveAndSend','Save & Send...'));
//		}

		$actions->push($action
				->addExtraClass('ss-ui-action-constructive')
				->setAttribute('data-icon', 'accept')
				->setUseButtonTag(true));
		return $actions;
	}

	public function ItemEditForm(){
		$form = parent::ItemEditForm();
		$form->setActions($this->addCMSActions($form->Actions()));
		return $form;
	}

	public function doSave($data, $form){
		return parent::doSave($data, $form);
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




}