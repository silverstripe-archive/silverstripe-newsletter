<?php

/**
 * Single newsletter instance. 
 * @package newsletter
 */
class Newsletter extends DataObject {

	static $db = array(
		"Status" => "Enum('Draft, Sending, Sent', 'Draft')",
		"Subject" => "Varchar(255)",
		"Content" => "HTMLText",
		"SentDate" => "Datetime",
		"SendFrom" => "Varchar(255)",
		"ReplyTo" => "Varchar(255)",
		"AsTemplate" => "Boolean",
		"Archived" => "Boolean",
		"RenderTemplate" => "Varchar",
	);

	static $has_many = array(
		"SendRecipientQueue" => "SendRecipientQueue",
		"TrackedLinks" => "Newsletter_TrackedLink"
	);

	static $many_many = array(
		"MailingLists" => "MailingList"
	);

	static $field_labels = array(
		"RenderTemplate" => "Template",
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
		$fields->removeByName("AsTemplate");
		$fields->removeByName("Archived");

		$explanationTitle = _t("Newletter.TemplateExplanationTitle",
			"Select a styled template (.ss template) that this newsletter renders with"
		);

		$fields->insertBefore(LiteralField::create("TemplateExplanationTitle", "<h5>$explanationTitle</h5>"), 
			"RenderTemplate"
		);

		if(!$this->ID) {
			$explanation1 = _t("Newletter.TemplateExplanation1", 
				"You should make your own styled SilverStripe templates	make sure your templates have a
				\$Body coded so the newletter's content could be clearly located in your templates
				");
			$explanation2 = _t("Newletter.TemplateExplanation2", 
				"Make sure your newsletter templates could be looked up in the dropdown list bellow by
				either placing them under your theme directory,	e.g. themes/mytheme/templates/email/
				");
			$explanation3 = _t("Newletter.TemplateExplanation3", 
				"or under your project directory e.g. mysite/templates/email/
				");
			$fields->insertBefore(LiteralField::create("TemplateExplanation1", "<p class='help'>$explanation1</p>"), 
				"RenderTemplate"
			);
			$fields->insertBefore(LiteralField::create("TemplateExplanation2", "<p class='help'>$explanation2
				<br />$explanation3</p>"), 
				"RenderTemplate"
			);
		}

		$templateSource = $this->templateSource();
		$fields->replaceField("RenderTemplate", 
			new DropdownField("RenderTemplate", _t('NewsletterAdmin.TEMPLATE','Template'), 
			$templateSource));

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
	 * return array containing all possible email templates file name 
	 * under the folders of both theme and project specific folder.
	 *
	 * @return array
	 */
	public function templateSource(){
		$paths = NewsletterAdmin::template_paths();

		$templates = array( 
			"SimpleNewsletterTemplate" => _t('TemplateList.SimpleNewsletterTemplate', 'Simple Newsletter Template')
		);

		if(isset($paths) && is_array($paths)){
			$absPath = Director::baseFolder();
			if( $absPath{strlen($absPath)-1} != "/" )
				$absPath .= "/";

			foreach($paths as $path){
				$path = $absPath.$path;


				if(is_dir($path)) {
					$templateDir = opendir( $path );


					// read all files in the directory
					while(($templateFile = readdir($templateDir)) !== false) {
						// *.ss files are templates
						if( preg_match( '/(.*)\.ss$/', $templateFile, $match )){
							// only grab those haveing $Body coded
							if(strpos("\$Body", file_get_contents($path."/".$templateFile)) === false){
								$templates[$match[1]] = preg_replace('/_?([A-Z])/', " $1", $match[1]);
							}

						}
					}
				}
			}
		}
		return $templates;
	}
		
	/**
	 * Returns a DataObject listing the recipients for the given status for this newsletter
	 *
	 * @param string $result 3 possible values: "Sent", (mail() returned TRUE), "Failed" (mail() returned FALSE), 
	 * or "Bounced" ({@see $email_bouncehandler}).
	 * @return DataObjectSet
	 */
	/*function SendRecipientQueue($result) {
		$SQL_result = Convert::raw2sql($result);
		return DataObject::get("SendRecipientQueue",array("\"ParentID\"='".$this->ID."'",
		"\"Result\"='".$SQL_result."'"));
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
