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
	'unsubscribe//$Action/$ValidateHash/$MailingList' => 'UnsubscribeController'
));

if (class_exists('MessageQueue')) {
	MessageQueue::add_interface("default", array( "queues" => "/.*/",
		"implementation" => "SimpleDBMQ",
		"encoding" => "php_serialize",
		"send" => array( "onShutdown" => "all" ),
		"delivery" => array( "onerror" => array( "log" ) ),
		"retrigger" => "yes", // on consume, retrigger if there are more items
		"onShutdownMessageLimit" => "1" // one message per async process
	));
}

Object::add_extension("SiteConfig", "NewsletterSiteConfig");

//SS_Log::add_writer(new SS_LogFileWriter(BASE_PATH . '/logN.txt'), SS_Log::NOTICE);
//SS_Log::add_writer(new SS_LogFileWriter(BASE_PATH . '/logW.txt'), SS_Log::WARN);
//SS_Log::add_writer(new SS_LogFileWriter(BASE_PATH . '/logE.txt'), SS_Log::ERR);

Session::start();

