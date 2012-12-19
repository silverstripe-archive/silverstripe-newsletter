<?php

/**
 * Create a form that a user can use to unsubscribe from a mailing list
 *
 * @package newsletter
 */
class Unsubscribe_Controller extends Page_Controller {

	public static $done_message;

	function __construct($data = null) {
		parent::__construct($data);
	}

	function RelativeLink($action = null) {
		return "unsubscribe/$action";
	}
	
	private function getMember(){
		$autoLoginHash = Convert::raw2sql($this->urlParams['AutoLoginHash']);
		if($autoLoginHash) {
			if(defined('Database::USE_ANSI_SQL')) {
				$member = DataObject::get_one('Member', "\"AutoLoginHash\" = '$autoLoginHash'");
			} else {
				$member = DataObject::get_one('Member', "`AutoLoginHash` = '$autoLoginHash'");
			}
			return $member;
		}
	}
	
	private function getMailingList(){
		$mailingListID = Convert::raw2sql($this->urlParams['MailingList']);

		if($mailingListID) {
			return $mailingList = DataObject::get_by_id("NewsletterType", (int)$mailingListID);
		}else{
			if(isset($_GET['MailingLists']) && !empty($_GET['MailingLists']) && is_array($_GET['MailingLists'])){
				return DataObject::get("NewsletterType", "ID IN (".implode(",", 
					Convert::raw2sql($_GET['MailingLists'])).")");
			};
		}
	}
	
	function index() {
		Session::clear("loggedInAs");
		Requirements::themedCSS("form");

		$member = $this->getMember();
		$mailingList = $this->getMailingList();

		// if the email address and mailing list is given in the URL and both are valid,
		// then unsubscribe the user
		if($member && isset($mailingList) && $mailingList->exists() && $member->inGroup($mailingList->GroupID)) {
			$this->unsubscribeFromList($member, $mailingList);
			$url = Director::absoluteBaseURL() . $this->RelativeLink('done') 
				. "/" . $member->AutoLoginHash . "/" . $mailingList->ID;
			Director::redirect($url);
			return $url;
		} elseif($member) {
			$listForm = $this->MailingListForm();
		} else {
			$listForm = $this->EmailAddressForm();
		}
		return $this->customise(array(
			'Content' => $listForm->forTemplate()
		))->renderWith('Page');
    }

	function done() {
		$form = new Form($this, "UnsubscribeSuccess", new FieldSet(), new FieldSet);
		
		if(!self::$done_message){
			$email = $this->getMember()->Email;
			$mailingList = $this->getMailingList();
			if(is_a($mailingList, "DataObjectSet")){
				$nlTitles = array();
				foreach($mailingList as $nlType) $nlTitles[] = $nlType->Title;
				$nlTypes = implode(", ", $nlTitles);
			}elseif(is_a($mailingList, "NewsletterType")){
				$nlTypes = $mailingList->Title;
			}
			self::$done_message = sprintf(_t('Unsubscribe.REMOVESUCCESS', 
				'Thank you. %s will no longer receive the %s.'), $email, $nlTypes);
		}
		$form -> setMessage(self::$done_message, 'good');
		self::$done_message = null;
    	return $this->customise(array(
    		'Title' => _t('UNSUBSCRIBEDTITLE', 'Unsubscribed'),
    		'Form' => $form
    	))->renderWith('Page');
    }

	function linksent(){
		$form = new Form($this, "UnsubscribeLinkSent", new FieldSet(), new FieldSet);
		
		if(isset($_GET['SendEmail']) && $_GET['SendEmail']){
			$form -> setMessage(sprintf(_t('Unsubscribe.LINKSENTTO', 
				"The unsubscribe link has been sent to %s"), $_GET['SendEmail']), "good");
			return $this->customise(array(
	    		'Title' => _t('Unsubscribe.LINKSENT', 'Unsubscrib Link Sent'),
	    		'Form' => $form
	    	))->renderWith('Page');
		}elseif(isset($_GET['SendError']) && $_GET['SendError']){
			$form -> setMessage(sprintf(_t('Unsubscribe.LINKSENDERR', 
				"Sorry, currently we have internal error, and can't send the unsubscribe link to %s"),
			$_GET['SendError']), "good");
			return $this->customise(array(
	    		'Title' => _t('Unsubscribe.LINKNOTSEND', 'Unsubscrib Link Can\'t Be Sent'),
	    		'Form' => $form
	    	))->renderWith('Page');
		}
	}

    /**
    * Display a form with all the mailing lists that the user is subscribed to
    */
    function MailingListForm() {
		$member = $this->getMember();
		return new Unsubscribe_MailingListForm($this, 'MailingListForm', $member);
    }

    /**
    * Display a form allowing the user to input their email address
    */
    function EmailAddressForm() {
        return new Unsubscribe_EmailAddressForm( $this, 'EmailAddressForm' );
    }

    /**
    * Show the lists for the user with the given email address
    */
    function sendmeunsubscribelink( $data) {
		if(isset($data['Email']) && $data['Email']) {
			$member = DataObject::get_one("Member", "Email = '".Convert::raw2sql($data['Email'])."'");
			if($member){
				if(!$from = Email::getAdminEmail()){
					$from = 'noreply@'.Director::BaseURL();
				}
				$to = $member->Email;
				$subject = "Unsubscribe Link";
				if($member->AutoLoginHash){
					
					$member->AutoLoginExpired = date('Y-m-d', time() + (86400 * 2));
					$member->write();
				}else{
					$member->generateAutologinHash();
				}
				$link = Director::absoluteBaseURL() . $this->RelativeLink('index') ."/" . $member->AutoLoginHash;
				$membername = $member->getName();
				$body = $this->customise(array(
		    		'Content' => <<<HTML
Dear $membername,<br />
<p>Please click the link below to unsubscribe from our newsletters<br />
$link<br />
<br >
<br >
Thanks
</p>
HTML
		    	))->renderWith('UnsubscribeEmail', 'Page');
				$email = new Email($from, $to, $subject, $body);
				$result = $email -> send();
				if($result){
					Director::redirect(Director::absoluteBaseURL() 
						. $this->RelativeLink('linksent') . "?SendEmail=".$data['Email']);
				}else{
					Director::redirect(Director::absoluteBaseURL() 
						. $this->RelativeLink('linksent') . "?SendError=".$data['Email']);
				}
			}else{
				$form = $this->EmailAddressForm();
				$message = sprintf(_t("Unsubscribe.NOTSIGNUP", 
					"Sorry, '%s' doesn't appear to be an sign-up member with us"), $data['Email']);
				$form->sessionMessage($message, 'bad');
				Director::redirectBack();
			}
		} else {
			$form = $this->EmailAddressForm();
			$message = _t("Unsubscribe.NOEMAILGIVEN", "Sorry, please type in a valid email address");
			$form->sessionMessage($message, 'bad');
			Director::redirectBack();
		}
	}

    /**
    * Unsubscribe the user from the given lists.
    */
	function unsubscribe($data) {
		$member = $this->getMember();

		if( $data['MailingLists'] ) {
			$mailingLists = array();
			foreach( array_keys( $data['MailingLists'] ) as $listID ){
				$list = DataObject::get_by_id( 'NewsletterType', Convert::raw2sql($listID ));
				$this->unsubscribeFromList( $member, $list);
				$mailingLists[] = "MailingLists[]=".$listID;
			}
			$liststring = implode("&", $mailingLists);
			Director::redirect(Director::absoluteBaseURL() . $this->RelativeLink('done') . "/
				" . $member->AutoLoginHash . "?" . $liststring);
			return;
		} else {
			$form->addErrorMessage('MailingLists', _t('Unsubscribe.NOMLSELECTED', 
				'You need to select at least one mailing list to unsubscribe from.'), 'bad');
			Director::redirectBack();
		}
	}

    protected function unsubscribeFromList( $member, $list ) {
        // track unsubscriptions
        $member->Groups()->remove( $list->GroupID );
        $unsubscribeRecord = new UnsubscribeRecord();
        $unsubscribeRecord->unsubscribe($member, $list);
    }


}

/**
 * 2nd step form for the Unsubcribe page.
 * The form will list all the mailing lists that the user is subscribed to.
 *
 * @package newsletter
 */
class Unsubscribe_MailingListForm extends Form {

    protected $autohash;

	function __construct( $controller, $name, $member) {
		$this->autohash = $member->AutoLoginHash;

		$fields = new FieldSet();
		$actions = new FieldSet();

		// get all the mailing lists for this user
		$lists = $this->getMailingLists( $member );

		if( $lists ) {
			$fields->push( new LabelField('SubscribedToLabel', _t('Unsubcribe.CHECKTOUNSUBSCRIBE', 
				'Check the newsletter(s) you want to unsubscribe')) );
			$fields->push( new CheckboxSetField("MailingLists", "", $lists));
			$actions->push( new FormAction('unsubscribe', _t('Unsubscribe.UNSUBSCRIBE', 'Unsubscribe') ) );
			
			$validator = new RequiredFields(array('MailingLists'));
			parent::__construct( $controller, $name, $fields, $actions, $validator);
		} else {
			parent::__construct( $controller, $name, $fields, $actions);
			$this->setMessage(_t('Unsubscribe.NOTINMAILINGLISTS', 
				'Sorry, your don\'t appear to be in any of our mailing lists.'), 'warning');
		}
		
		$this->disableSecurityToken();
	}

    function FormAction() {
        return $this->controller->RelativeLink('unsubscribe') . "/{$this->autohash}?executeForm=" . $this->name;
    }

    protected function getMailingLists( $member ) {
        // get all the newsletter types that the member is subscribed to
    	if(defined('Database::USE_ANSI_SQL')) {
    		return DataObject::get( 'NewsletterType', "\"MemberID\"='{$member->ID}'", null, 
    			"LEFT JOIN \"Group_Members\" USING(\"GroupID\")" );
    	} else {
    		return DataObject::get( 'NewsletterType', "`MemberID`='{$member->ID}'", null, 
    			"LEFT JOIN `Group_Members` USING(`GroupID`)" );
    	}

    }
}

/**
 * 1st step form for the Unsubcribe page.
 * The form will let people enter an email address and press a button to continue.
 *
 * @package newsletter
 */
class Unsubscribe_EmailAddressForm extends Form {

    function __construct( $controller, $name ) {

        $fields = new FieldSet(
	    	new EmailField( 'Email', _t('Unsubscribe.EMAILADDR', 'Email address') )
        );

        $actions = new FieldSet(
	    	new FormAction( 'sendmeunsubscribelink', 
	    		_t('Unsubscribe.SENDMEUNSUBSCRIBELINK', 'Send me unsubscribe link'))
        );

        parent::__construct( $controller, $name, $fields, $actions, new RequiredFields(array('Email')));
		$this->disableSecurityToken();
    }

    function FormAction() {
        return $this->controller->RelativeLink('sendmeunsubscribelink') . "/?executeForm=" . $this->name;
    }
}

?>
