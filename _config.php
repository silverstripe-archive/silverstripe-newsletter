<?php
/**
 * URL rules for the CMS module
 * 
 * @package cms
 */
Director::addRules(50, array(
	'unsubscribe/$Email/$MailingList' => 'Unsubscribe_Controller'
));

DataObject::add_extension('Member', 'NewsletterRole');

?>