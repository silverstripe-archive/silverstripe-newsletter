<?php

/**
 * Provides view and edit forms at Newsletter gridfield dataobjects,
 * giving special buttons for sending out the newsletter
 */
class NewsletterGridFieldDetailForm extends GridFieldDetailForm {


}

class NewsletterGridFieldDetailForm_ItemRequest extends GridFieldDetailForm_ItemRequest {

	public function addCMSActions($actions) {
		Requirements::javascript(NEWSLETTER_DIR . '/javascript/NewsletterSendConfirmation.js'); // styles for $sentReport
//		if ($this->SentDate) {
//			$action = FormAction::create('doSend', _t('Newsletter.RESEND', 'Resend'));
//		} else {
			$action = FormAction::create('doSend', _t('Newsletter.SEND','Send...'));
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
		Debug::Show($data);die;
		return parent::doSave($data, $form);

		Debug::show($data);

			$msg = _t('NewsletterAdmin.SendMessage','Send-out process started successfully. Check the process in the newsletter "Sent Recipients" tab');
			$this->sessionMessage($msg, 'good');
			$this->controller->redirectBack();
	}




}