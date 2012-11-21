<?php

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
			$fields->push( new LabelField('SubscribedToLabel', _t('Unsubcribe.CHECKTOUNSUBSCRIBE', 'Check the newsletter(s) you want to unsubscribe')) );
			$fields->push( new CheckboxSetField("MailingLists", "", $lists));
			$actions->push( new FormAction('unsubscribe', _t('Unsubscribe.UNSUBSCRIBE', 'Unsubscribe') ) );
			
			$validator = new RequiredFields(array('MailingLists'));
			parent::__construct( $controller, $name, $fields, $actions, $validator);
		} else {
			parent::__construct( $controller, $name, $fields, $actions);
			$this->setMessage(_t('Unsubscribe.NOTINMAILINGLISTS', 'Sorry, your don\'t appear to be in any of our mailing lists.'), 'warning');
		}
		
		$this->disableSecurityToken();
	}

    function FormAction() {
        return $this->controller->RelativeLink('unsubscribe') . "/{$this->autohash}?executeForm=" . $this->name; 
    }

    public function getMailingLists( $member ) {
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
			new FormAction( 'sendmeunsubscribelink', _t('Unsubscribe.SENDMEUNSUBSCRIBELINK', 'Send me unsubscribe link'))
        );

        parent::__construct( $controller, $name, $fields, $actions, new RequiredFields(array('Email')));
		$this->disableSecurityToken();
    }

    function FormAction() {
        return $this->controller->RelativeLink('sendmeunsubscribelink') . "/?executeForm=" . $this->name; 
    }
}
