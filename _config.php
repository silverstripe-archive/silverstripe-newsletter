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