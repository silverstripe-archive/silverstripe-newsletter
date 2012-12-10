<?php

class RecipientGridFieldDetailForm extends GridFieldDetailForm {
}

class RecipientGridFieldDetailForm_ItemRequest extends GridFieldDetailForm_ItemRequest {

	public function updateCMSActions($actions) {
		$actions->removeByName("action_doDelete");
		if(!$this->record->Archived){
			$archiveButton = FormAction::create('doArchive', _t('Newsletter.ArchiveButton', "Archive"))
					->addExtraClass('ss-ui-action-distructive')
					->setAttribute('data-icon', 'plug-disconnect-prohibition')
					->setUseButtonTag(true);
			$actions->push($archiveButton);
		}else{
			$unarchiveButton = FormAction::create('doUnarchive', _t('Newsletter.UnarchiveButton', "Unarchive"))
					->addExtraClass('ss-ui-action-constructive')
					->setAttribute('data-icon', 'addpage')
					->setUseButtonTag(true);
			$actions->push($unarchiveButton);
		}
		return $actions;
	}

	public function ItemEditForm(){
		$form = parent::ItemEditForm();
		// Do these action update only when the current record is_a newsletter
		if($this->record && $this->record instanceof Recipient) {
			$form->setActions($this->updateCMSActions($form->Actions()));
		}
		return $form;
	}

	public function doArchive($data, $form){
		$this->record->Archived = true;
		$this->record->write();
		$controller = Controller::curr();
		$noActionURL = $controller->removeAction($data['url']);
		$controller->getRequest()->addHeader('X-Pjax', 'Content');
		return $controller->redirect($noActionURL, 302);
	}

	public function doUnarchive($data, $form){
		$this->record->Archived = false;
		$this->record->write();
		$controller = Controller::curr();
		return $this->edit($controller->getRequest());
	}

}