<?php

/**
 * Single newsletter instance. 
 * @package newsletter
 */
class Newsletter extends DataObject implements CMSPreviewable{

	static $db = array(
		"Status" => "Enum('Draft, Sending, Sent', 'Draft')",
		"Subject" => "Varchar(255)",
		"Template" => "Boolean",
		"Content" => "HTMLText",
		"SentDate" => "Datetime",
		"SendFrom" => "Varchar(255)",
		"ReplyTo" => "Varchar(255)",
		"RenderTemplate" => "Varchar",
	);

	static $has_many = array(
		"SendRecipientQueue" => "SendRecipientQueue",
		"TrackedLinks" => "Newsletter_TrackedLink"
	);

	static $many_many = array(
		"MailingLists" => "MailingList"
	);

	static $castings = array(
		"Template" => "Boolean",
	);

	static $field_labels = array(
		"SendFrom" => "From Address",
		"ReplyTo" => "Reply To",
		"Template" => "Is Template",
		"Content" => "Content Summary",
	);

	static $searchable_fields = array(
		"Subject",
	);

	static $default_sort = array(
		"LastEdited DESC"
	);

	static $summary_fields = array(
		"Subject",
		"Content",
		"SendFrom",
		"ReplyTo",
		"Template",
		"Status",
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

		$fields->removeByName('Status');
		$fields->addFieldToTab('Root.Main',new ReadonlyField('Status'),'Subject');
		$fields->removeByName("SentDate");
		if ($this->Status == "Sent") {
			$fields->addFieldToTab('Root.Main',new ReadonlyField('SentDate','Sent Date'),'Subject');
		}

		$gridFieldConfig = GridFieldConfig::create()->addComponents(
			new GridFieldToolbarHeader(),
			new GridFieldSortableHeader(),
			new GridFieldDataColumns(),
			new GridFieldFilterHeader(),
			new GridFieldPageCount(),
			new GridFieldPaginator(30)
		);

		$sendRecipientGrid = GridField::create(
			'SendRecipientQueue',
			_t('NewsletterAdmin.SendRecipientQueue', 'Send Recipient Queue'),
			$this->SendRecipientQueue(),
			$gridFieldConfig
		);

		$fields->removeFieldFromTab('Root.SendRecipientQueue',"SendRecipientQueue");
		$fields->removeByName('SendRecipientQueue');
		$fields->addFieldToTab('Root.SendRecipientQueues',$sendRecipientGrid);

		//only show the TrackedLinks tab, if there are tracked links in the newsletter and the status is "Sent"
		if($this->Status !== 'Sent' || $this->TrackedLinks()->count() == 0) {
			$fields->removeByName('TrackedLinks');
		}else{
			$config = $fields->dataFieldByName('TrackedLinks')->getConfig();
			$config->removeComponentsByType('GridFieldDeleteAction')
				->removeComponentsByType('GridFieldAddNewButton')
				->removeComponentsByType('GridFieldButtonRow')
				->removeComponentsByType('GridFieldAddExistingAutocompleter')
				->removeComponentsByType('GridFieldDetailForm')
				->removeComponentsByType('GridFieldEditButton');
		}

		$fields->addFieldToTab('Root.SendRecipientQueues',
			new LiteralField('RestartQueueButton',
				'<a class="ss-ui-button" href="'.Controller::join_links(
					Director::absoluteBaseURL(),'dev/tasks/NewsletterSendController?newsletter='.$this->ID)
					.'" title="Restart queue processing"'.
				'<button name="action_RestartQueue" value="Restart queue processing" '.
				'class="action" '.
				'id="action_RestartQueue" role="button" aria-disabled="false">'.
						'<span class="ui-button-icon-primary ui-icon btn-icon-arrow-circle-double"></span>'.
				'<span class="ui-button-text">Restart Queue Processing</span>'.
				'</button></a>'));

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
			$mailinglists = MailingList::get()->filter(array('Disabled'=>false));

			$fields->addFieldToTab("Root.Main",
				new CheckboxSetField(
					"MailingLists", 
					_t('Newsletter.SendTo', "Send To", 'Selects a mailinglist from a dropdown'), 
					$mailinglists
				)
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
	 * Returns a DataObjectSet containing the subscribers who have never been sent this Newsletter
	 *
	 * @return DataObjectSet
	 */
	function UnsentSubscribers() {
		// Get a list of everyone who has been sent this newsletter
		$sentRecipients = DataObject::get("SendRecipientQueue","\"NewsletterID\"='".$this->ID."'");

		// If this Newsletter has not been sent to anyone yet, $sentRecipients will be null
		if ($sentRecipients != null) {
			$sentRecipientsArray = $sentRecipients->toNestedArray('MemberID');
		} else {
			$sentRecipientsArray = array();
		}

		// Get a list of all the subscribers to this newsletter
		$subscribers = DataObject::get(
			'Member', 
			"\"GroupID\"='".$this->Newsletter()->GroupID."'",
			null, 
			"INNER JOIN \"Group_Members\" ON \"MemberID\"=\"Member\".\"ID\"" 
		);

		// If this Newsletter has no subscribers, $subscribers will be null
		if ($subscribers != null) {
			$subscribersArray = $subscribers->toNestedArray();
		} else {
			$subscribersArray = array();
		}

		// Get list of subscribers who have not been sent this newsletter:
		$unsentSubscribersArray = array_diff_key($subscribersArray, $sentRecipientsArray);

		// Create new data object set containing the subscribers who have not been sent this newsletter:
		$unsentSubscribers = new DataObjectSet();
		foreach($unsentSubscribersArray as $key => $data) {
			$unsentSubscribers->push(new ArrayData($data));
		}

		return $unsentSubscribers;
	}

	function getTitle() {
		return $this->getField('Subject');
	}

	function render() {
		if(!$templateName = $this->RenderTemplate) {
			$templateName = 'SimpleNewsletterTemplate';
		}
		// Block stylesheets and JS that are not required (email templates should have inline CSS/JS)
		Requirements::clear();
		$fakeRecipent = new Recipient();
		$fakeRecipent->FirstName = "HereAsFirstName";
		$fakeRecipent->Surname = "HereAsSurname";
		$fakeRecipent->Email = "HereAsEmail@test.com";
		$fakeRecipent->Salutation = "HereAsSalutation";

		$newsletterEmail = new NewsletterEmail($this, $fakeRecipent, true);
		return HTTP::absoluteURLs($newsletterEmail->getData()->renderWith($templateName));
	}

	function canArchive(){
		if($this->Status !== 'Sending') return true;
		else return false;
	}


	function getContentBody(){
		$content = $this->obj('Content');
		
		$this->extend("updateContentBody", $content);
		return $content;
	}


  	public function Link($action = null) {
		return Controller::join_links(singleton('NewsletterAdmin')->Link('Newsletter'),
			'/EditForm/field/Newsletter/item/', $this->ID, $action);
	}

	/**
	 * @return String
	 */
	public function CMSEditLink() {
		return Controller::join_links(singleton('NewsletterAdmin')->Link('Newsletter'),
			'/EditForm/field/Newsletter/item/', $this->ID, 'edit');
	}
}


/**
 * @deprecated Newsletter_Recipient will be catched simplely by {@link Recipient} Blacklisted flag.
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

	static $summary_fields = array(
		"Newsletter.Subject" => "Newsletter",
		"Original" => "Link URL",
		"Visits" => "Visit Counts"
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
		$member = Member::get()->filter('Email', $emailAddr)->First();
		if($member){
			if($member->ValidateHash){
				$member->ValidateHashExpired = date('Y-m-d', time() + (86400 * 2));
				$member->write();
			}else{
				$member->generateValidateHashAndStore();
			}
			$nlTypeID = $this->nlType->ID;
			return Director::absoluteBaseURL() . "unsubscribe/index/".$member->ValidateHash."/$nlTypeID";
		}
	}
}
