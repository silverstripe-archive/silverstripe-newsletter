<?php
/**
 * URL rules for the CMS module
 * 
 * @package newsletter
 */

define('NEWSLETTER_DIR', 'newsletter');
Director::addRules(50, array(
	'unsubscribe//$Action/$Email/$MailingList' => 'UnsubscribeController',
	'newsletterlinks/$Hash' => "TrackLinkController"
));

DataObject::add_extension('Member', 'NewsletterRole');
Object::add_extension('NewsletterEmail', 'TrackingLinksEmail');