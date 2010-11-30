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

	function index() {
		Session::clear("loggedInAs");
		Requirements::themedCSS("form");

		// if the email address is given
		$emailAddress = Convert::raw2sql($this->urlParams['Email']);
		$mailingListID = (int)$this->urlParams['MailingList'];

		if($mailingListID) {
			$mailingList = DataObject::get_by_id("NewsletterType", $mailingListID);
		}

		// try to find the member with the email specified
		if($emailAddress) {
			if(defined('DB::USE_ANSI_SQL')) {
				$member = DataObject::get_one('Member', "\"Email\" = '$emailAddress'");
			} else {
				$member = DataObject::get_one('Member', "`Email` = '$emailAddress'");
			}
		} else {
			$member = false;
		}

		// if the email address and mailing list is given in the URL and both are valid,
		// then unsubscribe the user
		if($member && $mailingList && $member->inGroup($mailingList->GroupID)) {
			$this->unsubscribeFromList($member, $mailingList);
			$url = 'done/' . $member->Email . '/' . $mailingList->ID;
			Director::redirect(Director::absoluteBaseURL() . $this->RelativeLink() . $url);
			return;
		} elseif($member) {
			$listForm = $this->MailingListForm($member);
		} else {
			$listForm = $this->EmailAddressForm();
		}

		return $this->customise(array(
			'Content' => $listForm->forTemplate()
		))->renderWith('Page');
    }

	function done() {
		$message = self::$done_message ? self::$done_message : _t('Unsubscribe.SUCCESS', 'Thank you. You have been removed from the selected groups');

    	return $this->customise(array(
    		'Title' => _t('UNSUBSCRIBEDTITLE', 'Unsubscribed'),
    		'Content' => $message
    	))->renderWith('Page');
    }

    /**
    * Display a form with all the mailing lists that the user is subscribed to
    */
    function MailingListForm( $member = null ) {
    	$email = $this->urlParams['Email'];
       return new Unsubscribe_MailingListForm($this, 'MailingListForm', $member, $email);
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
    function showlists( $data, $form ) {
    	if(defined('DB::USE_ANSI_SQL')) {
        	$member = DataObject::get_one( 'Member', "\"Email\"='{$data['Email']}'" );
    	} else {
    		$member = DataObject::get_one( 'Member', "`Email`='{$data['Email']}'" );
    	}

         $mailingListForm = new Unsubscribe_MailingListForm( $this, 'MailingListForm', $member, $data['Email']);

         return $this->customise( array( 'Content' => $mailingListForm->forTemplate() ) )->renderWith('Page');
    }

    /**
    * Unsubscribe the user from the given lists.
    */
    function unsubscribe($data, $form) {
        $email = $this->urlParams['Email'];
        if(defined('DB::USE_ANSI_SQL')) {
        	$member = DataObject::get_one( 'Member', "\"Email\"='$email'" );
        } else  {
        	$member = DataObject::get_one( 'Member', "`Email`='$email'" );
        }
        if(!$member){
        	if(defined('DB::USE_ANSI_SQL')) {
        		$member = DataObject::get_one('Member', "\"EmailAddress\" = '$email'");
        	} else {
        		$member = DataObject::get_one('Member', "`EmailAddress` = '$email'");
        	}
        }

        if( $data['MailingLists'] ) {
           foreach( array_keys( $data['MailingLists'] ) as $listID ){

           		$nlType = DataObject::get_by_id( 'NewsletterType', $listID );
           		$nlTypeTitles[]= $nlType->Title;
              $this->unsubscribeFromList( $member, DataObject::get_by_id( 'NewsletterType', $listID ) );
           }

           $sORp = (sizeof($nlTypeTitles)>1)?"newsletters ":"newsletter ";
           //means single or plural
           $nlTypeTitles = $sORp.implode(", ", $nlTypeTitles);
	         $url = "unsubscribe/done/".$member->Email."/".$nlTypeTitles;
	      	 Director::redirect($url);
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
