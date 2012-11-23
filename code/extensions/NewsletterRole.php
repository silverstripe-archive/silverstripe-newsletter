<?php

/**
 * NewsletterRole provides extensions to the {@link Member}
 * class, with new database fields and functions specific
 * to the newsletter module.
 * 
 * @package newsletter
 */
class NewsletterRole extends DataExtension {

	public static $db = array(
		'BlacklistedEmail' => 'Boolean'
	);

	public static $has_many = array(
		'UnsubscribedRecords' => 'UnsubscribeRecord'
	);
	
	/**
	 * Update the CMS fields specifically for Member
	 * decorated by this NewsletterRole decorator.
	 * 
	 * @param FieldSet $fields CMS fields to update
	 */
	function updateCMSFields(FieldList $fields) {
		$fields->removeByName('UnsubscribedRecords');
		$fields->removeByName('BlacklistedEmail');
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
	
	/**
	 * Add the members email address to the blacklist
	 *
	 * With this method the blacklisted email table is updated to ensure that
	 * no promotional material is sent to the member (newsletters).
	 * Standard system messages are still sent such as receipts.
	 *
	 * @param bool $val Set to TRUE if the address should be added to the
	 *                  blacklist, otherwise to FALSE.
	 */
	function setBlacklistedEmail($val) {
		if($val && $this->owner->Email) {
			$blacklisting = new NewsletterEmailBlacklist();
	 		$blacklisting->BlockedEmail = $this->owner->Email;
	 		$blacklisting->MemberID = $this->owner->ID;
	 		$blacklisting->write();
		}

		$this->owner->setField("BlacklistedEmail", $val);
		// Save the BlacklistedEmail field to the Member table
		$this->owner->write();
	}
}