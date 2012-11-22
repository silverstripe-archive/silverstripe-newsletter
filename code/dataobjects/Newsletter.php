<?php

/**
 * Single newsletter instance.  Each {@link Newsletter} belongs to a {@link NewsletterType}. 
 * @package newsletter
 */
class Newsletter extends DataObject {

	static $db = array(
		"Status" => "Enum('Draft, Send', 'Draft')",
		"Content" => "HTMLText",
		"Subject" => "Varchar(255)",
		"SentDate" => "Datetime"
	);

	static $has_one = array(
		"Parent" => "NewsletterType",
	);

	static $has_many = array(
		"Recipients" => "Newsletter_Recipient",
		"SentRecipients" => "Newsletter_SentRecipient",
		"TrackedLinks" => "Newsletter_TrackedLink"
	);

	/**
	 * Returns a FieldSet with which to create the CMS editing form.
	 * You can use the extend() method of FieldSet to create customised forms for your other
	 * data objects.
	 *
	 * @param Controller
	 * @return FieldSet
	 */
	function getCMSFields($controller = null) {
		$group = DataObject::get_by_id("Group", $this->Parent()->GroupID);
		$sentReport = $this->renderWith("Newsletter_SentStatusReport");
		$previewLink = Director::absoluteBaseURL() . 'admin/newsletter/preview/' . $this->ID;
		Requirements::css(SAPPHIRE_DIR . '/css/TableListField.css'); // styles for $sentReport
		$ret = new FieldSet(
			new TabSet("Root",
				$mailTab = new Tab(_t('Newsletter.NEWSLETTER', 'Newsletter'),
					new TextField("Subject", _t('Newsletter.SUBJECT', 'Subject'), $this->Subject),
					new HtmlEditorField("Content", _t('Newsletter.CONTENT', 'Content')),
					new LiteralField('PreviewNewsletter', "<p><a href=\"$previewLink\" target=\"_blank\">" . _t('PREVIEWNEWSLETTER', 'Preview this newsletter') . "</a></p>")
				),
				$sentToTab = new Tab(_t('Newsletter.SENTREPORT', 'Sent Status Report'),
					new LiteralField("SentStatusReport", $sentReport)
				),
				$tracked = new Tab('TrackedLinks', $trackedTable = new TableListField(
					'TrackedLinks',
					'Newsletter_TrackedLink',
					array(
						'Original' => 'Link',
						'Visits'   => 'Visits'
					),
					'"NewsletterID" = ' . $this->ID,
					'"Visits" DESC'
				))
			)
		);

		$tracked->setTitle(_t('Newsletter.TRACKEDLINKS', 'Tracked Links'));
		$trackedTable->setPermissions(array('show'));

		if($this->Status != 'Draft') {
			$mailTab->push( new ReadonlyField("SentDate", _t('Newsletter.SENTAT', 'Sent at'), $this->SentDate) );
		}
		
		$this->extend("updateCMSFields", $ret);
		return $ret;
	}

	/**
	 * @return FieldSet
	 */
	public function getCMSActions() {
		$actions = new FieldSet();

		if ($this->SentDate) {
			$actions->push(new FormAction('send', _t('Newsletter.RESEND', 'Resend')));
		} else {
			$actions->push(new FormAction('send', _t('Newsletter.SEND','Send...')));
		}

		$actions->push(new FormAction('save',_t('Newsletter.SAVE', 'Save')));

		$this->extend('updateCMSActions', $actions);
		return $actions;
	}

	/**
	 * Returns a DataObject listing the recipients for the given status for this newsletter
	 *
	 * @param string $result 3 possible values: "Sent", (mail() returned TRUE), "Failed" (mail() returned FALSE), or "Bounced" ({@see $email_bouncehandler}).
	 * @return DataObjectSet
	 */
	function SentRecipients($result) {
		$SQL_result = Convert::raw2sql($result);
		return DataObject::get("Newsletter_SentRecipient",array("\"ParentID\"='".$this->ID."'", "\"Result\"='".$SQL_result."'"));
	}

	/**
	 * Returns a DataObjectSet containing the subscribers who have never been sent this Newsletter
	 *
	 * @return DataObjectSet
	 */
	function UnsentSubscribers() {
		// Get a list of everyone who has been sent this newsletter
		$sent_recipients = DataObject::get("Newsletter_SentRecipient","\"ParentID\"='".$this->ID."'");
		// If this Newsletter has not been sent to anyone yet, $sent_recipients will be null
		if ($sent_recipients != null) {
			$sent_recipients_array = $sent_recipients->toNestedArray('MemberID');
		} else {
			$sent_recipients_array = array();
		}

		// Get a list of all the subscribers to this newsletter
        if(defined('DB::USE_ANSI_SQL')) {
			$subscribers = DataObject::get( 'Member', "\"GroupID\"='".$this->Parent()->GroupID."'", null, "INNER JOIN \"Group_Members\" ON \"MemberID\"=\"Member\".\"ID\"" );
        } else {
        	$subscribers = DataObject::get( 'Member', "`GroupID`='".$this->Parent()->GroupID."'", null, "INNER JOIN `Group_Members` ON `MemberID`=`Member`.`ID`" );
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

	function getNewsletterType() {
		return DataObject::get_by_id('NewsletterType', $this->ParentID);
	}

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
 * Database record for recipients that have had the newsletter sent to them.
 *
 * @package newsletter
 */
class Newsletter_SentRecipient extends DataObject {
	/**
	 *	Result has 4 possible values: "Sent", (mail() returned TRUE), "Failed" (mail() returned FALSE),
	 * 	"Bounced" ({@see $email_bouncehandler}), or "BlackListed" (sending to is disabled).
	 */
	static $db = array(
		"Email" => "Varchar(255)",
		"Result" => "Enum('Sent, Failed, Bounced, BlackListed', 'Sent')",
	);
	static $has_one = array(
		"Member" => "Member",
		"Parent" => "Newsletter" 
	);
}

/**
 * Single recipient of the newsletter
 *
 * @package newsletter
 */
class Newsletter_Recipient extends DataObject {

	static $db = array(
		"ParentID" => "Int",
	);
	static $has_one = array(
		"Member" => "Member",
	);
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
