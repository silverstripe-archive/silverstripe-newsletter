<?php

/**
 * Newsletter administration section
 *
 * @package newsletter
 */

class NewsletterAdmin extends LeftAndMain {
	static $subitem_class = 'Member';
	
	/** 
	 * @var which will be used to seperator "send items" into 2 groups, e.g. "most recent number 5", "older". 
	 */
	static $most_recent_seperator = 5; // an int which will be used to seperator "send items" into 2 groups, e.g. "most recent number 5", "older".
	
	/** 
	 * @var array Array of template paths to check 
	 */
	static $template_paths = null; //could be customised in _config 

	static $allowed_actions = array(
		'adddraft',
		'addgroup',
		'addtype',
		'autocomplete',
		'displayfilefield',
		'getformcontent',
		'getsentstatusreport',
		'getsitetree',
		'memberblacklisttoggle',
		'newmember',
		'preview',
		'remove',
		'removebouncedmember',
		'removenewsletter',
		'save',
		'savemember',
		'savenewsletter',
		'sendnewsletter',
		'showdrafts',
		'showmailtype',
		'shownewsletter',
		'showrecipients',
		'showsent',
		'MailingListEditForm',
		'TypeEditForm',
		'UploadForm',
		'NewsletterEditForm',
	);

	static $url_segment = 'newsletter';

	static $url_rule = '/$Action/$ID/$OtherID';

	static $menu_title = 'Newsletter';

	public function init() {
		// In LeftAndMain::init() the current theme is unset.
		// we need to restore the current theme here for make the dropdown of template list.
		$theme = SSViewer::current_theme();
		
		parent::init();
		
		if(isset($theme) && $theme){
			SSViewer::set_theme($theme);
		}
		
		Requirements::javascript(MCE_ROOT . 'tiny_mce_src.js');
		Requirements::javascript(SAPPHIRE_DIR . '/javascript/tiny_mce_improvements.js');

		//TODO what is going on here? where did that hover.js go? can't find it. 
		//TODO We need to reimplement a hover.js?
		Requirements::javascript(CMS_DIR . '/javascript/hover.js');
		Requirements::javascript(THIRDPARTY_DIR . '/scriptaculous/controls.js');

		Requirements::javascript(CMS_DIR . '/javascript/LeftAndMain_left.js');
		Requirements::javascript(CMS_DIR . '/javascript/LeftAndMain_right.js');
		Requirements::javascript(CMS_DIR . '/javascript/CMSMain_left.js');
		
		Requirements::javascript(CMS_DIR . '/javascript/SecurityAdmin.js');

		Requirements::javascript(NEWSLETTER_DIR . '/javascript/NewsletterAdmin_left.js');
		Requirements::javascript(NEWSLETTER_DIR . '/javascript/NewsletterAdmin_right.js');
		Requirements::javascript(NEWSLETTER_DIR . '/javascript/ProgressBar.js');

		// We don't want this showing up in every ajax-response, it should always be present in a CMS-environment
		if(!Director::is_ajax()) {
			Requirements::javascript(MCE_ROOT . 'tiny_mce_src.js');
			HtmlEditorConfig::get('cms')->setOption('ContentCSS', project() . '/css/editor.css');
			HtmlEditorConfig::get('cms')->setOption('Lang', i18n::get_tinymce_lang());
		}

		// Always block the HtmlEditorField.js otherwise it will be sent with an ajax request
		Requirements::block(SAPPHIRE_DIR . '/javascript/HtmlEditorField.js');

		Requirements::css(NEWSLETTER_DIR . '/css/NewsletterAdmin.css');
	}

	public function remove() {
		$ids = explode( ',', $_REQUEST['csvIDs'] );

		$count = 0;
		foreach( $ids as $id ) {
			if( preg_match( '/^mailtype_(\d+)$/', $id, $matches ) )
				$record = DataObject::get_by_id( 'NewsletterType', $matches[1] );
			else if( preg_match( '/^[a-z]+_\d+_(\d+)$/', $id, $matches ) )
				$record = DataObject::get_by_id( 'Newsletter', $matches[1] );

			if($record) {
				$record->delete();
			}

			FormResponse::add("removeTreeNodeByIdx(\$('sitetree'), '$id' );");
			// Don't allow a deleted draft to be edited
			FormResponse::add("$('Form_EditForm').closeIfSetTo('$matches[1]');");
			$count++;
		}

		FormResponse::status_message('Deleted '.$count.' items','good');

		return FormResponse::respond();
	}

	public function getformcontent(){
		Session::set('currentPage', $_REQUEST['ID']);
		Session::set('currentType', $_REQUEST['type']);

		if($_REQUEST['otherID']) {
			Session::set('currentOtherID', $_REQUEST['otherID']);
		}

		SSViewer::setOption('rewriteHashlinks', false);

		$result = $this->renderWith($this->class . '_right');

		return $this->getLastFormIn($result);
	}

	/**
	 * Top level call from ajax
	 * Called when a mailing list is clicked on the left menu
	 */
	public function showrecipients($params) {
		$params = $params->allParams();
		return $this->showWithEditForm( $params, $this->getMailingListEditForm( $params['ID'] ) );
	}

	/**
	* Top level call from ajax when click on the left manu
	* Second level call when create a draft
	* Called when a draft or sent newsletter is clicked on the left menu and when a new one is added
	*/
	public function shownewsletter($params) {
		if($params instanceof SS_HTTPRequest){
			$params = $params->allParams();
		}
		return $this->showWithEditForm( $params, $this->getNewsletterEditForm( $params['ID'] ) );
	}

	/**
	 * Preview a {@link Newsletter} draft.
	 *
	 * @param SS_HTTPRequest $request Request parameters
	 */
	public function preview($request) {
		$newsletterID = (int) $request->param('ID');
		$newsletter = DataObject::get_by_id('Newsletter', $newsletterID);
		$templateName = ($newsletter && ($newsletter->Parent()->Template)) ? $newsletter->Parent()->Template : 'GenericEmail';

		// Block stylesheets and JS that are not required (email templates should have inline CSS/JS)
		Requirements::clear();

		$email = new NewsletterEmail($newsletter); 
		
		return HTTP::absoluteURLs($email->getData()->renderWith($templateName));
	}

	/**
	 * Top level call from ajax
	 * Called when a newsletter type is clicked on the left menu
	 */
	public function showmailtype($params) {
		$params = $params->allParams();
		
		return $this->showWithEditForm( $params, $this->getNewsletterTypeEditForm( $params['ID'] ) );
	}

	/**
	* Top level call from ajax
	* Called when a 'Drafts' folder is clicked on the left menu
	*/
	public function showdrafts($params) {
		$params = $params->allParams();
		return $this->ShowNewsletterFolder($params, 'Draft');
	}

	/**
	* Top level call from ajax
	* Called when a 'Sent Items' folder is clicked on the left menu
	*/
	public function showsent($params) {
		$params = $params->allParams();
		return $this->ShowNewsletterFolder($params, 'Sent');
	}

	/**
	* Shows either the 'Sent' or 'Drafts' folder using the NewsletterList template
	* Didn't see anywhere it is called from top level ajax call or from templete,
	* it is only called internally from showdrafts and showsent.
	*/
	public function ShowNewsletterFolder($params, $type) {
		$id = $params['ID'];
		if(!is_numeric($id)) {
			$id = Session::get('currentPage');
		}
		if( is_a( $id, 'NewsletterType' ) ) {
				$mailType = $id;
				$id = $mailType->ID;
		} else {
			if($id && is_numeric($id)) {
				$mailType = DataObject::get_by_id( 'NewsletterType', $id );
			}
		}
		$draftList = new NewsletterList($type, $mailType, $type);
		return $draftList->renderWith("NewsletterList");
	}

	/**
	 * This function is called only internally, so make sure that $params is not a SS_HTTPRequest from caller.
	 */
    private function showWithEditForm( $params, $editForm ) {
        if(isset($params['ID'])) {
        	Session::set('currentPage', $params['ID']);
        }
		if(isset($params['OtherID'])) {
			Session::set('currentMember', $params['OtherID']);
		}
		if(Director::is_ajax()) {
			SSViewer::setOption('rewriteHashlinks', false);
			return $editForm->formHtmlContent();
		} else {
			return array('EditForm' => $editForm);
		}
    }

    public function getEditForm( $id ) {
        $form = $this->getNewsletterTypeEditForm( $id );
		$form->disableDefaultAction();
		return $form;
    }

    /**
     * Get the EditForm
     */
    public function EditForm() {
		// Include JavaScript to ensure HtmlEditorField works.
		HtmlEditorField::include_js();
		
    	if((isset($_REQUEST['ID']) && isset($_REQUEST['Type']) && $_REQUEST['Type'] == 'Newsletter') || isset($_REQUEST['action_savenewsletter'])) {
    		$form = $this->NewsletterEditForm();
    	} else {

			// If a mailing list member is being added to a group, then call the Recipient form
			if((isset($_REQUEST['fieldName']) && 'Recipients' == $_REQUEST['fieldName']) || (!empty($_REQUEST['MemberSearch']))) {
				$form = $this->MailingListEditForm();
			} else {
				$form = $this->TypeEditForm();
			}
    	}
		if($form) $form->disableDefaultAction();
		return $form;
    }

    public function NewsletterEditForm() {
    	$id = isset($_REQUEST['ID']) ? $_REQUEST['ID'] : $this->currentPageID();
    	if(!is_numeric($id)) {
    		$id = 0;
    	}
    	return $this->getNewsletterEditForm($id);
    }

    public function TypeEditForm() {
    	$id = isset($_REQUEST['ID']) ? $_REQUEST['ID'] : $this->currentPageID();
    	if(!is_numeric($id)) {
    		$id = 0;
    	}
    	return $this->getNewsletterTypeEditForm($id);
    }
    public function MailingListEditForm() {
    	$id = isset($_REQUEST['ID']) ? $_REQUEST['ID'] : $this->currentPageID();
    	return $this->getMailingListEditForm($id);
    }

	public function getNewsletterTypeEditForm($id) {
        if(!is_numeric($id)) {
        	$id = Session::get('currentPage');
        }
	    if( is_a( $id, 'NewsletterType' ) ) {
	    		$mailType = $id;
	    		$id = $mailType->ID;
	    } else {
	    	if($id && is_numeric($id)) {
	    		$mailType = DataObject::get_by_id( 'NewsletterType', $id );
	    	}
	    }

		if(isset($mailType) && is_object($mailType) && $mailType->GroupID) {
			$group = DataObject::get_one("Group", "\"ID\" = $mailType->GroupID");
		}
		if(isset($mailType) && $mailType) {
			$fields = $mailType->getCMSFields();

			$fields->push($idField = new HiddenField("ID"));
			$fields->push( new HiddenField( "executeForm", "", "TypeEditForm" ) );
			$idField->setValue($id);

			$actions = new FieldSet(new FormAction('save', _t('NewsletterAdmin.SAVE', 'Save')));

			$form = new Form($this, "TypeEditForm", $fields, $actions);
			$form->loadDataFrom($mailType);
			// This saves us from having to change all the JS in response to renaming this form to TypeEditForm
			$form->setHTMLID('Form_EditForm');
			$this->extend('updateEditForm', $form);
		} else {
			$form = false;
		}

		return $form;
	}

	public function getMailingListEditForm($id) {
        if(!is_numeric($id)) {
        		$id = Session::get('currentPage');
		}
	    if( is_a( $id, 'NewsletterType' ) ) {
	    		$mailType = $id;
	    		$id = $mailType->ID;
	    } else {
	    	if($id && is_numeric($id)) {
	    		$mailType = DataObject::get_by_id( 'NewsletterType', $id );
	    	}
	    }
		$group = null;

		if(isset($mailType) && is_object($mailType) && $mailType->GroupID) {
			$group = DataObject::get_one("Group", "\"ID\" = $mailType->GroupID");
		}

		if(isset($mailType) && is_object($mailType) && $group) {
			$fields = new FieldSet(
				new TabSet("Root",
					new Tab(_t('NewsletterAdmin.RECIPIENTS', 'Recipients'),
						$recipients = new MemberTableField(
							$this,
							"Recipients",
							$group
							)
					),
					new Tab(_t('NewsletterAdmin.IMPORT', 'Import'),
						$importField = new RecipientImportField("ImportFile",_t('NewsletterAdmin.IMPORTFROM', 'Import from file'), $group )
					),
					new Tab(_t('NewsletterAdmin.UNSUBSCRIBERS', 'Unsubscribers'),
					$unsubscribedList = new UnsubscribedList("Unsubscribed", $mailType)
					),
					new Tab(_t('NewsletterAdmin.BOUNCED','Bounced'), $bouncedList = new BouncedList("Bounced", $mailType )
					)
				)
			);

			$recipients->setController($this);
			$importField->setController($this);
	      	$unsubscribedList->setController($this);
			$bouncedList->setController($this);

			$importField->setTypeID($id);

			$fields->push($idField = new HiddenField("ID"));
			$fields->push( new HiddenField( "executeForm", "", "MailingListEditForm" ) );
			$idField->setValue($id);
			// Save button is not used in Mailing List section
			$actions = new FieldSet(new HiddenField("save"));

			$form = new Form($this, "MailingListEditForm", $fields, $actions);
			$form->loadDataFrom(array(
				'Title' => $mailType->Title,
				'FromEmail' => $mailType->FromEmail
			));
			// This saves us from having to change all the JS in response to renaming this form to MailingListEditForm
			$form->setHTMLID('Form_EditForm');
			$this->extend('updateEditForm', $form);
		} else {
			$fields = new FieldSet(
				new LiteralField('GroupWarning', _t('NewsletterAdmin.NO_GROUP', 'No mailing group selected'))
			);
			$form = new Form($this, "MailingListEditForm", $fields, new FieldSet());
		}

		return $form;
	}

	/**
	 * Removes a bounced member from the mailing list
	 * top level call from front-ajax
	 * @return String
	 */
	function removebouncedmember($params) {
		$params = $params->allParams();

		// First remove the Bounce entry
		$id = Convert::raw2sql($params['ID']);
		if (is_numeric($id)) {
			$bounceObject = DataObject::get_by_id('Email_BounceRecord', $id);
			if($bounceObject) {
				// Remove this bounce record
				$bounceObject->delete();

				$memberObject = DataObject::get_by_id('Member', $bounceObject->MemberID);
				$groupID = Convert::raw2sql($_REQUEST['GroupID']);
				if(is_numeric($groupID) && is_object($memberObject)) {
					// Remove the member from the mailing list
					$memberObject->Groups()->remove($groupID);
				} else {
					user_error("NewsletterAdmin::removebouncedmember: Bad parameters: Group=$groupID, Member=".$bounceObject->MemberID, E_USER_ERROR);
				}
				FormResponse::status_message($memberObject->Email.' '._t('NewsletterAdmin.REMOVEDSUCCESS', 'was removed from the mailing list'), 'good');
				FormResponse::add("$('Form_EditForm').getPageFromServer($('Form_EditForm_ID').value, 'recipients');");
				return FormResponse::respond();
			}
		} else {
			user_error("NewsletterAdmin::removebouncedmember: Bad parameters: Group=$groupID, Member=".$bounceObject->MemberID, E_USER_ERROR);
		}
	}

	/**
	 * Reloads the "Sent Status Report" tab via ajax
	 * top level call from ajax
	 */
	function getsentstatusreport($params) {
		$params = $params->allParams();
		
		if(Director::is_ajax()) {
			$newsletter = DataObject::get_by_id( 'Newsletter', $params['ID'] );
			$sent_status_report = $newsletter->renderWith("Newsletter_SentStatusReport");
			return $sent_status_report;
		}
	}

	/**
	 * this function is only used once and only works for the class TemplateteList DropdownField,
	 * due to the TemplateList is also used only once and not necessarily be there, we will make this function
	 * deprecated, meanwhile TemplateList.php will be removed.
	 *
	 * @deprecated 2.4 Please use NewsletterAdmin::template_paths() and NewsletterAdmin::templateSource(). @see NewsletterType::getCMSFields();
	 */
	public static function template_path() {
		user_error("NewsletterAdmin::template_path() is deprecated; use NewsletterAdmin::template_paths() and NewsletterAdmin::templateSource()", E_USER_NOTICE);
		if(self::$template_path) return self::$template_path;
		else return self::$template_path = project() . '/templates/email';
	}
	
	/**
	 * looked-up the email template_paths. 
	 * if not set, will look up both theme folder and project folder
	 * in both cases, email folder exsits or Email folder exists
	 * return an array containing all folders pointing to the bunch of email templates
	 *
	 * @return array
	 */
	public static function template_paths() {
		if(!isset(self::$template_paths)) {
			if(file_exists("../".THEMES_DIR."/".SSViewer::current_theme()."/templates/email")){
				self::$template_paths[] = THEMES_DIR."/".SSViewer::current_theme()."/templates/email";
			}
			
			if(file_exists("../".THEMES_DIR."/".SSViewer::current_theme()."/templates/Email")){
				self::$template_paths[] = THEMES_DIR."/".SSViewer::current_theme()."/templates/Email";
			}
			
			if(file_exists("../".project() . '/templates/email')){
				self::$template_paths[] = project() . '/templates/email';
			}
			
			if(file_exists("../".project() . '/templates/Email')){
				self::$template_paths[] = project() . '/templates/Email';
			}
		}
		else {
			if(is_string(self::$template_paths)) {
				self::$template_paths = array(self::$template_paths);
			}
		}
		
		return self::$template_paths;
	}
	
	/**
	 * return array containing all possible email templates file name 
	 * under the folders of both theme and project specific folder.
	 *
	 * @return array
	 */
	public function templateSource(){
		$paths = self::template_paths();
		$templates = array( "" => _t('TemplateList.NONE', 'None') );

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
							// change a 
							$templates[$match[1]] = preg_replace('/_?([A-Z])/', " $1", $match[1]);
						}
					}
				}
			}
		}
		
		return $templates;
	}

	/* Does not seem to be used
	public function showdraft( $params ) {
        	return $this->showWithEditForm( $params, $this->getNewsletterEditForm( $params['ID'] ) );
	}
	*/

	public function getNewsletterEditForm($myId){
		$email = DataObject::get_by_id("Newsletter", $myId);
		if($email) {

			$fields = $email->getCMSFields($this);
			$fields->push($idField = new HiddenField("ID"));
			$idField->setValue($myId);
			$fields->push($ParentidField = new HiddenField("ParentID"));
			$ParentidField->setValue($email->ParentID);
			$fields->push($typeField = new HiddenField("Type"));
			$typeField->setValue('Newsletter');
			//$fields->push(new HiddenField("executeForm", "", "EditForm") );

			$actions = new FieldSet();

			if( $email->SentDate )
				$actions->push(new FormAction('send',_t('NewsletterAdmin.RESEND','Resend')));
			else
				$actions->push(new FormAction('send',_t('NewsletterAdmin.SEND','Send...')));

			$actions->push(new FormAction('save',_t('NewsletterAdmin.SAVE', 'Save')));

			$form = new Form($this, "NewsletterEditForm", $fields, $actions);
			$form->loadDataFrom($email);
			// This saves us from having to change all the JS in response to renaming this form to NewsletterEditForm
			$form->setHTMLID('Form_EditForm');

			if($email->Status != 'Draft') {
				$readonlyFields = $form->Fields()->makeReadonly();
				$form->setFields($readonlyFields);
			}

			$this->extend('updateEditForm', $form);
			return $form;
		} else {
			user_error( 'Unknown Email ID: ' . $myId, E_USER_ERROR );
		}
	}

	public function SendProgressBar() {
		$progressBar = new ProgressBar( 'SendProgressBar', _t('NewsletterAdmin.SENDING','Sending emails...') );
		return $progressBar->FieldHolder();
	}

	/**
	 * Sends a newsletter given by the url 
	 */
	public function sendnewsletter() {

		$id = isset($_REQUEST['ID']) ? $_REQUEST['ID'] : $_REQUEST['NewsletterID'];

		if( !$id ) {
		        FormResponse::status_message(_t('NewsletterAdmin.NONLSPECIFIED', 'No newsletter specified'),'bad');
			return FormResponse::respond();
		}

		$newsletter = DataObject::get_by_id("Newsletter", $id);
		$nlType = $newsletter->getNewsletterType();

		$e = new NewsletterEmail($newsletter, $nlType);
		$e->Subject = $subject = $newsletter->Subject;

		// TODO Make this dynamic

		if( $nlType && $nlType->FromEmail )
			$e->From = $from = $nlType->FromEmail;
		else
			$e->From = $from = Email::getAdminEmail();

		if(isset($_REQUEST['TestEmail'])) $e->To = $_REQUEST['TestEmail'];
		$e->setTemplate( $nlType->Template );

		$messageID = base64_encode( $newsletter->ID . '_' . date( 'd-m-Y H:i:s' ) );

		switch($_REQUEST['SendType']) {
			case "Test":
				if($_REQUEST['TestEmail']) {
					$e->To = $_REQUEST['TestEmail'];
					$e->setTemplate( $nlType->Template );

					self::sendToAddress( $e, $_REQUEST['TestEmail'], $messageID );
					FormResponse::status_message(_t('NewsletterAdmin.SENTTESTTO','Sent test to ') . $_REQUEST['TestEmail'],'good');
				} else {
					FormResponse::status_message(_t('NewsletterAdmin.PLEASEENTERMAIL','Please enter an email address'),'bad');
				}
			    break;
			case "List":
				// Send to the entire mailing list.
				$groupID = $nlType->GroupID;
				
				if(defined('DB::USE_ANSI_SQL')) {
					$members = DataObject::get( 'Member', "\"GroupID\"='$groupID'", null, "INNER JOIN \"Group_Members\" ON \"MemberID\"=\"Member\".\"ID\"" );
				} else {
					$members = DataObject::get( 'Member', "`GroupID`='$groupID'", null, "INNER JOIN `Group_Members` ON `MemberID`=`Member`.`ID`" );
				}
				
				echo self::sendToList($subject, $from, $newsletter, $nlType, $messageID, $members);
				break;
			case "Unsent":
				// Send to only those who have not already been sent this newsletter.
				$only_to_unsent = 1;
      		
				echo self::sendToList( $subject, $from, $newsletter, $nlType, $messageID, $newsletter->UnsentSubscribers());
				break;
		}

		return FormResponse::respond();
	}


	static function sendToAddress( $email, $address, $messageID = null ) {
		$email->To = $address;
		$email->send();
    }

	static function sendToList($subject, $from, $newsletter, $nlType, $messageID = null, $recipients) {
		$emailProcess = new NewsletterEmailProcess($subject, $from, $newsletter, $nlType, $messageID, $recipients);
		
		return $emailProcess->start();
	}

	/**
	 * Top level call, $param is a SS_HTTPRequest Object
	 *
	 * @todo When is $params an object? Typically it's the form request
	 * data as an array...
	 */
	public function save($params, $form) {
		if(is_object($params)) $params = $params->allParams();

		// Both the Newsletter type and the Newsletter draft call save() when "Save" button is clicked
		// @todo this is a hack. It needs to be cleaned up. Two different classes shouldn't share the
		// same submit handler since they have different behaviour!
		if(isset($_REQUEST['Type']) && $_REQUEST['Type'] == 'Newsletter') {
			return $this->savenewsletter($params, $form);
		}

		$id = $_REQUEST['ID'];
		$className = 'NewsletterType';

		if(defined('DB::USE_ANSI_SQL')) {
			$record = DataObject::get_one($className, "\"$className\".\"ID\" = $id");
		} else {
			$record = DataObject::get_one($className, "`$className`.ID = $id");
		}
		// Is the template attached to the type, or the newsletter itself?

		$record->Template = addslashes( $_REQUEST['Template'] );

		$form->saveInto($record);
		$record->write();

		FormResponse::set_node_title("mailtype_$id", $record->Title);
		FormResponse::status_message(_t('NewsletterAdmin.SAVED','Saved'), 'good');
		$result = $this->getActionUpdateJS($record);
		return FormResponse::respond();
	}

	/*
	 * Internal call found so far.
	 */
	public function savenewsletter($urlParams, $form) {
		$id = $_REQUEST['ID'];

		$className = 'Newsletter';
		if(defined('DB::USE_ANSI_SQL')) {
			$record = DataObject::get_one($className, "\"$className\".\"ID\" = $id");
		} else {
			$record = DataObject::get_one($className, "`$className`.ID = $id");
		}

		// Is the template attached to the type, or the newsletter itself?
		$type = $record->getNewsletterType();

		$form->saveInto($record);
		$record->write();

		$id = 'draft_'.$record->ParentID.'_'.$record->ID;

		FormResponse::set_node_title($id, $record->Title);
		FormResponse::status_message('Saved', 'good');
		// Get the new action buttons
		$actionList = '';
		foreach($form->Actions() as $action) {
			$actionList .= $action->Field() . ' ';
		}
		FormResponse::add("$('Form_EditForm').loadActionsFromString('" . Convert::raw2js($actionList) . "');");
		return FormResponse::respond();
	}

	/*
	 * Saves the settings on the 'Bounced' tab of the 'Mailing List' allowing members to be added to NewsletterEmailBlacklist
	 *
	 */
	public function memberblacklisttoggle($urlParams) {
		$id = $urlParams['ID'];
		$bounceObject = DataObject::get_by_id('Email_BounceRecord', $id);
		$memberObject = DataObject::get_by_id('Member', $bounceObject->MemberID);
		// If the email is currently not blocked, block it
		if (FALSE == $memberObject->BlacklistedEmail) {
			$memberObject->setBlacklistedEmail(TRUE);
			FormResponse::status_message($memberObject->Email.' '._t('NewsletterAdmin.ADDEDTOBL', 'was added to blacklist'), 'good');
		} else {
			// Unblock the email
			$memberObject->setBlacklistedEmail(FALSE);
			FormResponse::status_message($memberObject->Email.' '._t('NewsletterAdmin.REMOVEDFROMBL','was removed from blacklist'), 'good');
		}
		return FormResponse::respond();
	}

  	function NewsletterAdminSiteTree() {
      return $this->getsitetree();
  	}

  	function getsitetree() {
      return $this->renderWith('NewsletterAdmin_SiteTree');
  	}

	/**
	 * This method is called when a user changes subsite in the dropdownfield.
	 * It is added temporarily to prevent error when changing subsite in newsletter admin
	 * TODO: fully implement it to display the newsletter tree
	 */
	public function SiteTreeAsUL() {
		return "Please refresh the page";
	}

	public function AddRecordForm() {
		$m = new MemberTableField($this,"Members", $this->currentPageID());
		return $m->AddRecordForm();
	}

	/**
	 * Ajax autocompletion
	 */
	public function autocomplete() {
		$fieldName = $this->urlParams['ID'];
		$fieldVal = $_REQUEST[$fieldName];

		$matches = DataObject::get("Member","\"$fieldName\" LIKE '" . addslashes($fieldVal) . "%'");
		if($matches) {
			echo "<ul>";
			foreach($matches as $match) {
				$data = $match->FirstName;
				$data .= ",$match->Surname";
				$data .= ",$match->Email";
				$data .= ",$match->Password";
				echo "<li>" . $match->$fieldName . "<span class=\"informal\">($match->FirstName $match->Surname, $match->Email)</span><span class=\"informal data\">$data</li>";
			}
			echo "</ul>";
		}
	}

	function savemember() {
		$data = $_REQUEST;

		$className = $this->stat('subitem_class');

		$id = $_REQUEST['ID'];
		if($id == 'new') $id = null;

		if($id) {
			if(defined('DB::USE_ANSI_SQL')) {
				$record = DataObject::get_one($className, "\"$className\".\"ID\" = $id");
			} else {
				$record = DataObject::get_one($className, "`$className`.ID = $id");
			}
		} else {
            // send out an email to notify the user that they have been subscribed
			$record = new $className();
		}

		$record->update($data);
		$record->ID = $id;
		$record->write();

		$record->Groups()->add($data['GroupID']);

		$FirstName = Convert::raw2js($record->FirstName);
		$Surname = Convert::raw2js($record->Surname);
		$Email = Convert::raw2js($record->Email);
		$Password = Convert::raw2js($record->Password);
		$response = <<<JS
			$('MemberList').setRecordDetails($record->ID, {
				FirstName : "$FirstName",
				Surname : "$Surname",
				Email : "$Email"
			});
			$('MemberList').clearAddForm();
JS;
		FormResponse::add($response);
		FormResponse::status_message(_t('NewsletterAdmin.SAVED'), 'good');

		return FormResponse::respond();
	}


	public function NewsletterTypes() {
		return DataObject::get("NewsletterType","");
	}

	/**
	 * Called by AJAX to create a new newsletter type
	 * Top level call
	 */
	public function addtype( $params ) {
		$params = $params->allParams();
		$params['ID'] = $typeid = $this->newNewsletterType();

		$form = $this->getNewsletterTypeEditForm($typeid);
		return $this->showWithEditForm( $params, $form );
	}

	/**
	 * Called by AJAX to create a new newsletter draft
	 * Top level call
	 */
	public function adddraft( $params) {
		$params = $params->allParams();

		$draftID = $this->newDraft( $_REQUEST['ParentID'] );
		// Needed for shownewsletter() to work
		$params['ID'] = $draftID;
		return $this->shownewsletter($params);
	}

    /**
    * Create a new newsletter type
    */
    private function newNewsletterType() {

        // create the new type
        $newsletterType = new NewsletterType();
        $newsletterType->Title = _t('NewsletterAdmin.NEWNEWSLTYPE','New newsletter type');
        $newsletterType->write();

        // BUGFIX: Return only the ID of the new newsletter type
        return $newsletterType->ID;
    }

   private function newDraft( $parentID ) {
		if(!$parentID || !is_numeric( $parentID)) {
			$parent = DataObject::get_one("NewsletterType");
			if ($parent) {
				$parentID = $parent->ID;
			} else {
				// BUGFIX: It could be that no Newsletter types have been created, if so add one to prevent errors.
				$parentID = $this->newNewsletterType();
			}
		}
		if( $parentID && is_numeric( $parentID ) ) {
			$parent = DataObject::get_by_id("NewsletterType", $parentID);
			// BUGFIX: It could be that no Newsletter types have been created, if so add one to prevent errors.
			if(!$parent) {
				$parentID = $this->newNewsletterType();
			}
			$newsletter = new Newsletter();
			$newsletter->Status = 'Draft';
			$newsletter->Title = $newsletter->Subject = _t('NewsletterAdmin.MEWDRAFTMEWSL','New draft newsletter');
			$newsletter->ParentID = $parentID;
			$newsletter->write();
		} else {
			user_error( "You must first create a newsletter type before creating a draft", E_USER_ERROR );
		}

		return $newsletter->ID;
	}

	public function newmember() {
		Session::clear('currentMember');
		$newMemberForm = array(
			"MemberForm" => $this->getMemberForm('new'),
		);

		if(Director::is_ajax()) {
			SSViewer::setOption('rewriteHashlinks', false);
			$customised = $this->customise($newMemberForm);
			$result = $customised->renderWith($this->class . "_rightbottom");
			$parts = split('</?form[^>]*>', $result);
			echo $parts[1];

		} else {
			return $newMemberForm;
		}
	}

	public function EditedMember() {
		if(Session::get('currentMember'))
			return DataObject::get_by_id("Member", Session::get('currentMember'));
	}

	public function Link($action = null) {
		return "admin/newsletter/";
	}

	public function displayfilefield() {

		$id = $this->urlParams['ID'];

		return $this->customise( array( 'ID' => $id, "UploadForm" => $this->UploadForm() ) )->renderWith('Newsletter_RecipientImportField');
	}

	function UploadForm( $id = null ) {

		if( !$id )
			$id = $this->urlParams['ID'];

		$fields = new FieldSet(
			new FileField( "ImportFile", "" ),
			//new HiddenField( "action_import", "", "1" ),
			new HiddenField( "ID", "", $id )
		);

		$actions = new FieldSet(
			new FormAction( "action_import", _t('NewsletterAdmin.SHOWCONTENTS','Show contents') )
		);

		return new RecipientImportField_UploadForm( $this, "UploadForm", $fields, $actions );
	}

	function getMenuTitle() {
		return _t('LeftAndMain.NEWSLETTERS',"Newsletters",PR_HIGH,"Menu title");
	}
}
