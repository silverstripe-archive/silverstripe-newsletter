<?php

/**
 * 2nd step form for the Unsubcribe page.
 * The form will list all the mailing lists that the user is subscribed to.
 *
 * @package newsletter
 */
class Unsubscribe_MailingListForm extends Form {

    protected $memberEmail;

    function __construct( $controller, $name, $member, $email ) {

    	if($member) {
        $this->memberEmail = $member->Email;
    	}

        $fields = new FieldSet();
        $actions = new FieldSet();

        if($member) {
	        // get all the mailing lists for this user
	        $lists = $this->getMailingLists( $member );
        } else {
        	$lists = false;
        }

        if( $lists ) {
	    $fields->push( new LabelField('SubscribedToLabel', _t('Unsubcribe.SUBSCRIBEDTO', 'You are subscribed to the following lists:')) );

            foreach( $lists as $list ) {
                $fields->push( new CheckboxField( "MailingLists[{$list->ID}]", $list->Title ) );
            }

            $actions->push( new FormAction('unsubscribe', _t('Unsubscribe.UNSUBSCRIBE', 'Unsubscribe') ) );
        } else {
	    $fields->push( new LabelField('NotSubscribedToLabel',sprintf(_t('Unsubscribe.NOTSUBSCRIBED', 'I\'m sorry, but %s doesn\'t appear to be in any of our mailing lists.'), $email) ) );
        }

        parent::__construct( $controller, $name, $fields, $actions );
    }

    function FormAction() {
        return $this->controller->RelativeLink() . "{$this->memberEmail}?executeForm=" . $this->name;
    }

    protected function getMailingLists( $member ) {
        // get all the newsletter types that the member is subscribed to
    	if(defined('DB::USE_ANSI_SQL')) {
    		return DataObject::get( 'NewsletterType', "\"MemberID\"='{$member->ID}'", null, "LEFT JOIN \"Group_Members\" USING(\"GroupID\")" );
    	} else {
    		return DataObject::get( 'NewsletterType', "`MemberID`='{$member->ID}'", null, "LEFT JOIN `Group_Members` USING(`GroupID`)" );
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
	    new FormAction( 'showlists', _t('Unsubscribe.SHOWLISTS', 'Show lists') )
        );

        parent::__construct( $controller, $name, $fields, $actions );
    }

    function FormAction() {
        return parent::FormAction() . ( isset($_REQUEST['showqueries']) ? '&showqueries=1' : '' );
    }
}

/**
 * Final stage form for the Unsubcribe page.
 * The form just gives you a success message.
 *
 * @package newsletter
 */
class Unsubscribe_Successful extends Form {
	function __construct($controller, $name){
		$fields = new FieldSet();
		$actions = new FieldSet();
		parent::__construct($controller, $name, $fields, $actions);
	}
	function setSuccessfulMessage($email, $newsletterTypes) {
		Requirements::themedCSS("form");
		$this->setMessage(sprintf(_t('Unsubscribe.REMOVESUCCESS', 'Thank you. %s will no longer receive the %s.'), $email, $newsletterTypes), "good");
	}
}