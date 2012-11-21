<?php
/**
 * URL rules for the CMS module
 * 
 * @package newsletter
 */

define('NEWSLETTER_DIR', 'newsletter');
Director::addRules(50, array(
	'newsletterlinks/$Hash' => "TrackLinkController",
	'unsubscribe//$Action/$AutoLoginHash/$MailingList' => 'UnsubscribeController'
));

Object::add_extension('NewsletterEmail', 'TrackingLinksEmail');
DataObject::add_extension('Member', 'NewsletterRole');
