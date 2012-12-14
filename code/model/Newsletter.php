<?php

/**
 * Single newsletter instance. 
 * @package newsletter
 */
class Newsletter extends DataObject implements CMSPreviewable{

	static $db = array(
		"Status"				=> "Enum('Draft, Sending, Sent', 'Draft')",
		"Subject"				=> "Varchar(255)",
		"Content"				=> "HTMLText",
		"SentDate"				=> "Datetime",
		"SendFrom"				=> "Varchar(255)",
		"ReplyTo"				=> "Varchar(255)",
		"RenderTemplate"		=> "Varchar",
	);

	static $has_many = array(
		"SendRecipientQueue"	=> "SendRecipientQueue",
		"TrackedLinks"			=> "Newsletter_TrackedLink"
	);

	static $many_many = array(
		"MailingLists"			=> "MailingList"
	);

	static $field_labels = array(
		"SendFrom"				=> "From Address",
		"ReplyTo"				=> "Reply To",
		"Content"				=> "Content",
	);

	static $searchable_fields = array(
		"Subject",
		"Content",
		"SendFrom",
		"SentDate"
	);

	static $default_sort = array(
		"LastEdited DESC"
	);

	static $summary_fields = array(
		"Subject",
		"Content",
		"SendFrom",
		"SentDate",
		"Status"
	);

	static $required_fields = array(
		'Subject', 'SendFrom'
	);
	static $required_relations = array(
		'MailingLists'
	);


	public function validate() {
		$result = parent::validate();

		foreach(self::$required_fields as $field) {
			if (empty($this->$field)) {
				$result->error(_t('Newsletter.FieldRequired',
					'"{field}" field is required',
						array('field' => isset(self::$field_labels[$field])?self::$field_labels[$field]:$field)
				));
			}
		}

		if (!empty($this->ID)) {
			foreach(self::$required_relations as $relation) {
				if ($this->$relation()->Count() == 0) {
					$result->error(_t('Newsletter.RelationRequired',
						'Select at least one "{relation}"',
							array('relation' => $relation)
					));
				}
			}
		}

		return $result;
	}

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

		$fields->removeFieldFromTab('Root.SendRecipientQueue',"SendRecipientQueue");
		$fields->removeByName('SendRecipientQueue');
		$fields->removeByName('TrackedLinks');

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
			new DropdownField("RenderTemplate", _t('NewsletterAdmin.RENDERTEMPLATE',
				'Template the newsletter render to'), 
			$templateSource));

		if($this && $this->exists()){
			$fields->removeByName("MailingLists");
			$mailinglists = MailingList::get();

			$fields->addFieldToTab("Root.Main",
				new CheckboxSetField(
					"MailingLists", 
					_t('Newsletter.SendTo', "Send To", 'Selects mailing lists from set of checkboxes'), 
					$mailinglists
				)
			);
		}

		if($this->Status === 'Sending' || $this->Status === 'Sent') {
			//make the whole field read-only
			$fields = $fields->transform(new ReadonlyTransformation());
			$fields->push(new HiddenField("NEWSLETTER_ORIGINAL_ID", "", $this->ID));

			$gridFieldConfig = GridFieldConfig::create()->addComponents(
				new GridFieldSummaryHeader(),    //only works on SendRecipientQueue items, not TrackedLinks
				new GridFieldSortableHeader(),
				new GridFieldDataColumns(),
				new GridFieldFilterHeader(),
				new GridFieldPageCount(),
				new GridFieldPaginator(30)
			);

			//only show the TrackedLinks tab, if there are tracked links in the newsletter and the status is "Sent"
			if($this->TrackedLinks()->count() > 0) {
				$fields->addFieldToTab('Root.TrackedLinks',GridField::create(
						'TrackedLinks',
						_t('NewsletterAdmin.TrackedLinks', 'Tracked Links'),
						$this->TrackedLinks(),
						$gridFieldConfig
					)
				);
			}

			//Create the Sent To Queue grid
			if (class_exists("GridFieldAjaxRefresh") && $this->SendRecipientQueue()->exists()) {
				//only use auto-refresh, if there is a send out currently in-progress, otherwise no-point, waste of request
				if ($this->SendRecipientQueue()->filter(array('Status'=>array('Scheduled','InProgress')))->count() > 0) {
					$gridFieldConfig->addComponent(new GridFieldAjaxRefresh(5000,true));
				}
			}

			$sendRecipientGrid = GridField::create(
				'SendRecipientQueue',
				_t('NewsletterAdmin.SentTo', 'Sent to'),
				$this->SendRecipientQueue(),
				$gridFieldConfig
			);

			$fields->addFieldToTab('Root.SentTo',$sendRecipientGrid);

			if ($this->Status == "Sending") {  //only show restart queue button if the newsletter is stuck in "sending"
				$fields->addFieldToTab('Root.SentTo',
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
			}
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
	 * **deprecated**
	 * @return DataObjectSet
	 */
	/*function UnsentSubscribers() {
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
	}*/

	function getTitle() {
		return $this->getField('Subject');
	}

	function render() {
		if(!$templateName = $this->RenderTemplate) {
			$templateName = 'SimpleNewsletterTemplate';
		}
		// Block stylesheets and JS that are not required (email templates should have inline CSS/JS)
		Requirements::clear();
		$fakeRecipient = new Recipient();
		$fakeRecipient->FirstName = "HereAsFirstName";
		$fakeRecipient->MiddleName = "HereAsMiddleName";
		$fakeRecipient->Surname = "HereAsSurname";
		$fakeRecipient->Email = "HereAsEmail@test.com";
		$fakeRecipient->Salutation = "HereAsSalutation";

		$newsletterEmail = new NewsletterEmail($this, $fakeRecipient, true);
		return HTTP::absoluteURLs($newsletterEmail->getData()->renderWith($templateName));
	}

	public function canDelete($member = null) {
		$can = parent::canDelete($member);
		if($this->Status !== 'Sending') return $can;
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

	public function onBeforeDelete(){
		parent::onBeforeDelete();
		//SendRecipientQueue
		$queueditems = $this->SendRecipientQueue();
		if($queueditems && $queueditems->exists()){
			foreach($queueditems as $item){
				$item->delete();
			}
		}

		//TrackedLinks
		$trackedLinks = $this->TrackedLinks();
		if($trackedLinks && $trackedLinks->exists()){
			foreach($trackedLinks as $link){
				$link->delete();
			}
		}

		//remove this from its belonged mailing lists
		$mailingLists = $this->MailingLists()->removeAll();
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
}
