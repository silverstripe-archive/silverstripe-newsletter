<?php
/**
 * URL rules for the CMS module
 * 
 * @package newsletter
 */
if(!(defined('NEWSLETTER_DIR'))){
	define('NEWSLETTER_DIR', basename(dirname(__FILE__)));
}

Config::inst()->update('Director', 'rules', array(
	'newsletterlinks/$Hash' => "TrackLinkController",
	'unsubscribe//$Action/$AutoLoginHash/$MailingList' => 'UnsubscribeController'
));