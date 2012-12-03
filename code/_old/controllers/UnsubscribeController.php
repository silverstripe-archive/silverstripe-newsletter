<?php

/**
 * Create a form that a user can use to unsubscribe from a mailing list
 *
 * @package newsletter
 */
class UnsubscribeController extends Page_Controller {

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
			$member = DataObject::get_one('Member', "\"AutoLoginHash\" = '$autoLoginHash'");
			return $member;
		}
	}
	
	private function getMailingList(){
		$mailingListID = (int)$this->urlParams['MailingList'];

		//TODO NewsletterType deprecated
		if($mailingListID) {
			return $mailingList = DataObject::get_by_id("NewsletterType", $mailingListID);
		}else{
			if(isset($_GET['MailingLists']) && !empty($_GET['MailingLists']) && is_array($_GET['MailingLists'])){
				return DataObject::get("NewsletterType", "ID IN (".implode(",", $_GET['MailingLists']).")");
			};
		}
	}
	

	function index() {
		Session::clear("loggedInAs");
		Requirements::themedCSS("form");
		$member = $this->getMember();
		if ($member) {
			$listForm = $this->MailingListForm();
			$mailingList = $this->getMailingList();
			$mailingLists = $listForm->getMailingLists($member);
			// if the email address and mailing list is given in the URL and both are valid,
			// or the user is only in 1 Mailing list, then unsubscribe the user
			if ((!$mailingList || !$mailingList->exists()) && $mailingLists && $mailingLists->count() == 1)
				$mailingList = $mailingLists->First();
			if($mailingList && $mailingList->exists() && $member->inGroup($mailingList->GroupID)) {
				$this->unsubscribeFromList($member, $mailingList);
				$url = Director::absoluteBaseURL() . $this->RelativeLink('done') . "/" . $member->AutoLoginHash . "/" . $mailingList->ID;
				Director::redirect($url);
				return $url;
			}
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
			//TODO NewsletterType deprecated
			if(is_a($mailingList, "DataObjectSet")){
				$nlTitles = array();
				foreach($mailingList as $nlType) $nlTitles[] = $nlType->Title;
				$nlTypes = implode(", ", $nlTitles);
			}elseif(is_a($mailingList, "NewsletterType")){
				$nlTypes = $mailingList->Title;
			}
			self::$done_message = sprintf(_t('Unsubscribe.REMOVESUCCESS', 'Thank you. %s will no longer receive the %s.'), $email, $nlTypes);
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
			$form -> setMessage(sprintf(_t('Unsubscribe.LINKSENTTO', "The unsubscribe link has been sent to %s"), $_GET['SendEmail']), "good");
			return $this->customise(array(
	    		'Title' => _t('Unsubscribe.LINKSENT', 'Unsubscrib Link Sent'),
	    		'Form' => $form
	    	))->renderWith('Page');
		}elseif(isset($_GET['SendError']) && $_GET['SendError']){
			$form -> setMessage(sprintf(_t('Unsubscribe.LINKSENDERR', "Sorry, currently we have internal error, and can't send the unsubscribe link to %s"), $_GET['SendError']), "good");
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
	 *
	 * @return Form
	 */
	function EmailAddressForm() {
		return new Unsubscribe_EmailAddressForm( $this, 'EmailAddressForm' );
	}
	
    /**
    * Show the lists for the user with the given email address
    */
/*    function sendmeunsubscribelink($data) {
		if(isset($data['Email']) && $data['Email']) {
			$member = DataObject::get_one("Member", "Email = '".$data['Email']."'");
			if($member){
				if(!$from = Email::getAdminEmail()){
					$from = 'noreply@'.Director::BaseURL();
				}
				$to = $member->Email;
				$subject = _t('Unsubscribe.UNSUBSCRIBEEMAILSUBJECT', 'Unsubscribe Link');
				if($member->AutoLoginHash){
					$member->AutoLoginExpired = date('Y-m-d', time() + (86400 * 2));
					$member->write();
				}else{
					$member->generateAutologinTokenAndStoreHash();
				}
				$email = new Email($from, $to, $subject);
				$email->populateTemplate(array(
					'Subject' => $subject,
					'Form' => $from,
					'To' => $to,
					'Link' => Director::absoluteBaseURL() . $this->RelativeLink('index') ."/" . $member->AutoLoginHash,
					'Member' => $member
				));
				$email->setTemplate('UnsubscribeEmail');
				$this->extend('updateSendmeunsubscribelink', $email, $member);
				$result = $email->send();
				if($result){
					Director::redirect(Director::absoluteBaseURL() . $this->RelativeLink('linksent') . "?SendEmail=".$data['Email']);
				}else{
					Director::redirect(Director::absoluteBaseURL() . $this->RelativeLink('linksent') . "?SendError=".$data['Email']);
				}
			}else{
				$form = $this->EmailAddressForm();
				$message = sprintf(_t("Unsubscribe.NOTSIGNUP", "Sorry, '%s' doesn't appear to be an sign-up member with us"), $data['Email']);
				$form->sessionMessage($message, 'bad');
				Director::redirectBack();
			}
		} else {
			$form = $this->EmailAddressForm();
			$message = _t("Unsubscribe.NOEMAILGIVEN", "Sorry, please type in a valid email address");
			$form->sessionMessage($message, 'bad');
			Director::redirectBack();
		}
	}*/
	
    /**
    * Unsubscribe the user from the given lists.
    */
	function unsubscribe($data) {
		$member = $this->getMember();
		if( $data['MailingLists'] ) {
			$mailingLists = array();
			//TODO NewsletterType deprecated
			foreach( array_keys( $data['MailingLists'] ) as $listID ){
				$list = DataObject::get_by_id( 'NewsletterType', $listID );
				$this->unsubscribeFromList( $member, $list);
				$mailingLists[] = "MailingLists[]=".$listID;
			}
			$liststring = implode("&", $mailingLists);
			Director::redirect(Director::absoluteBaseURL() . $this->RelativeLink('done') . "/" . $member->AutoLoginHash . "?" . $liststring);
			return;
		} else {
			$form->addErrorMessage('MailingLists', _t('Unsubscribe.NOMLSELECTED', 'You need to select at least one mailing list to unsubscribe from.'), 'bad');
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
