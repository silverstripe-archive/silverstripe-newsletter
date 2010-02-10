<?php
/**
 * URL rules for the CMS module
 * 
 * @package newsletter
 */

define('NEWSLETTER_DIR', 'newsletter');
Director::addRules(50, array(
	'unsubscribe//$Action/$Email/$MailingList' => 'Unsubscribe_Controller'
));

DataObject::add_extension('Member', 'NewsletterRole');

?>