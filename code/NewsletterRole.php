<?php

class NewsletterRole extends DataObjectDecorator {
	
	function extraDBFields() {
		return array(
			'has_many' => array(
				'UnsubscribedRecords' => 'UnsubscribeRecord'
			)
		);
	}
	
	/**
	 * Factory method for the member validator.
	 * 
	 * @TODO It's unclear where this is used.
	 *
	 * @return Member_Validator Returns an instance of a
	 *                          {@link Member_Validator} object.
	 */
	function getNewsletterSubscriptions() {
		$groups = $this->owner->Groups()->toDropDownMap('ID', 'ID');
		return $groups;
	}

	/**
	 * Unsubscribe the current {@link Member} from
	 * a newsletter.
	 * 
	 * @TODO It's unclear where this is used.
	 *
	 * @param NewsletterType $newsletterType Newsletter type to unsubscribe from
	 */
	function unsubscribeFromNewsletter($newsletterType) {
		$unsubscribeRecord = new UnsubscribeRecord();
		$unsubscribeRecord->unsubscribe($this->owner, $newsletterType);
		$this->owner->Groups()->remove($newsletterType->GroupID);
	}
	
	/**
	 * This does some cunning and automatically save the newsletter subscriptions
	 * by adding and removing the member from the appropriate
	 * groups based on a checkboxset field.
	 * This function is called by the form handler
	 * whenever form->saveInto($member); is called with an 
	 * checkboxsetfield in the data with the name
	 * "newsletterSubscriptions"
	 */
	function saveNewsletterSubscriptions($groups) {
    	$checkboxsetfield = new CheckboxSetField(
			"NewsletterSubscriptions",
			"",
			$sourceitems = DataObject::get("NewsletterType")->toDropDownMap("GroupID","Title"),
			$selectedgroups = $groups
		);
		return $this->owner->Groups()->setByCheckboxSetField($checkboxsetfield);
	}
	
	function removeAllNewsletterSubscriptions(){
		$groups = $this->owner->Groups();
		$groupIDs = $groups->getIDList();
		$newsletterTypes = DataObject::get("NewsletterType");
		if($newsletterTypes&&$newsletterTypes->count()){
			foreach($newsletterTypes as $type){
				$newsletterGroupIDs[] = $type->GroupID;
			}
		}
		if($newsletterGroupIDs) {
			foreach($newsletterGroupIDs as $newsletterGroupID){
				if($groupIDs&&in_array($newsletterGroupID, $groupIDs)){
					$groups->remove($newsletterGroupID);
				}
			}
		}
	}	
	
}

?>