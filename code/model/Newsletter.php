<?php

/**
 * Single newsletter instance. 
 * @package newsletter
 */
class Newsletter extends DataObject {

	static $db = array(
		"Status" => "Enum('Draft, Send', 'Draft')",
		"Subject" => "Varchar(255)",
		"Content" => "HTMLText",
		"SentDate" => "Datetime",
		"SendFrom" => "Varchar",
		"ReplyTo" => "Varchar",
	);

	static $has_many = array(
		"SendRecipientQueue" => "SendRecipientQueue",
		"TrackedLinks" => "Newsletter_TrackedLink"
	);

	static $many_many = array(
		"MailingLists" => "MailingList"
	);
	/**
	 * Returns a FieldSet with which to create the CMS editing form.
	 * You can use the extend() method of FieldSet to create customised forms for your other
	 * data objects.
	 *
	 * @param Controller
	 * @return FieldSet
	 */
	function getCMSFields() {
		$fields = parent::getCMSFields();
		$fields->removeByName("Status");
		$fields->removeByName("SentDate");

		if($this && $this->exists()){
			$fields->removeByName("MailingLists");
			$mailinglists = DataObject::get("MailingList");

			$fields->addFieldToTab("Root.Main",
				new CheckboxSetField("MailingLists", "Send To", $mailinglists)
			);
		}

		return $fields;
	}

	/**
	 * @return FieldGroup
	 */




	/**
	 * Returns a DataObject listing the recipients for the given status for this newsletter
	 *
	 * @param string $result 3 possible values: "Sent", (mail() returned TRUE), "Failed" (mail() returned FALSE), 
	 * or "Bounced" ({@see $email_bouncehandler}).
	 * @return DataObjectSet
	 */
	/*function SendRecipientQueue($result) {
		$SQL_result = Convert::raw2sql($result);
		return DataObject::get("SendRecipientQueue",array("\"ParentID\"='".$this->ID."'", "\"Result\"='".$SQL_result."'"));
	}*/

	/**
	 * Returns a DataObjectSet containing the subscribers who have never been sent this Newsletter
	 *
	 * @return DataObjectSet
	 */
	function UnsentSubscribers() {
		// Get a list of everyone who has been sent this newsletter
		$sent_recipients = DataObject::get("SendRecipientQueue","\"NewsletterID\"='".$this->ID."'");
		// If this Newsletter has not been sent to anyone yet, $sent_recipients will be null
		if ($sent_recipients != null) {
			$sent_recipients_array = $sent_recipients->toNestedArray('MemberID');
		} else {
			$sent_recipients_array = array();
		}

		// Get a list of all the subscribers to this newsletter
		if(defined('DB::USE_ANSI_SQL')) {
			$subscribers = DataObject::get(
				'Member', 
				"\"GroupID\"='".$this->Newsletter()->GroupID."'",
				null, 
				"INNER JOIN \"Group_Members\" ON \"MemberID\"=\"Member\".\"ID\"" 
			);
		} else {
			$subscribers = DataObject::get(
				'Member', 
				"`GroupID`='".$this->Newsletter()->GroupID."'",
				null, 
				"INNER JOIN `Group_Members` ON `MemberID`=`Member`.`ID`" 
			);
		}

		// If this Newsletter has no subscribers, $subscribers will be null
		if ($subscribers != null) {
			$subscribers_array = $subscribers->toNestedArray();
		} else {
			$subscribers_array = array();
		}

		// Get list of subscribers who have not been sent this newsletter:
		$unsent_subscribers_array = array_diff_key($subscribers_array, $sent_recipients_array);

		// Create new data object set containing the subscribers who have not been sent this newsletter:
		$unsent_subscribers = new DataObjectSet();
		foreach($unsent_subscribers_array as $key => $data) {
			$unsent_subscribers->push(new ArrayData($data));
		}

		return $unsent_subscribers;
	}

	function getTitle() {
		return $this->getField('Subject');
	}

	//TODO NewsletterType deprecated
	/*function getNewsletterType() {
		return DataObject::get_by_id('NewsletterType', $this->ParentID);
	}*/

	function getContentBody(){
		$content = $this->obj('Content');
		
		$this->extend("updateContentBody", $content);
		return $content;
	}

	static function newDraft($parentID, $subject, $content) {
    	if( is_numeric($parentID)) {
     	   $newsletter = new Newsletter();
	        $newsletter->Status = 'Draft';
	        $newsletter->Title = $newsletter->Subject = $subject;
	        $newsletter->ParentID = $parentID;
	        $newsletter->Content = $content;
	        $newsletter->write();
	    } else {
	        user_error( $parentID, E_USER_ERROR );
	    }
    	return $newsletter;
  	}
	
	function PreviewLink(){
		return Controller::curr()->AbsoluteLink()."preview/".$this->ID;
	}

}


/**
 * S@deprecated Newsletter_Recipient will be catched simplely by {@link Recipient} Blacklisted flag.
 *
 * @package newsletter
 */
class Newsletter_Recipient extends DataObject {
}

/**
 * Tracked link is a record of a link from the {@link Newsletter}
 *
 * @package newsletter
 */
class Newsletter_TrackedLink extends DataObject {
	
	static $db = array(
		'Original' => 'Varchar(255)',
		'Hash' => 'Varchar(100)',
		'Visits' => 'Int'
	);
	
	static $has_one = array(
		'Newsletter' => 'Newsletter'
	);
	
	/**
	 * Generate a unique hash
	 */
	function onBeforeWrite() {
		parent::onBeforeWrite();
		
		if(!$this->Hash) $this->Hash = md5(time() + rand());
	}
	
	/**
	 * Return the full link to the hashed url, not the
	 * actual link location
	 *
	 * @return String
	 */
	function Link() {
		if(!$this->Hash) $this->write();
		
		return 'newsletterlinks/'. $this->Hash;
	}

	function UnsubscribeLink(){
		$emailAddr = $this->To();
		$member=DataObject::get_one("Member", "Email = '".$emailAddr."'");
		if($member){
			if($member->AutoLoginHash){
				$member->AutoLoginExpired = date('Y-m-d', time() + (86400 * 2));
				$member->write();
			}else{
				$member->generateAutologinHash();
			}
			$nlTypeID = $this->nlType->ID;
			return Director::absoluteBaseURL() . "unsubscribe/index/".$member->AutoLoginHash."/$nlTypeID";
		}
	}
}
