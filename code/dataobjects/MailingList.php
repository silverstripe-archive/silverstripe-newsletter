<?php

/**
 * Represents a specific containner of newsletter recipients 
 * 
 * @package newsletter
 */
class MailingList extends DataObject {

	/* the database fields */
	static $db = array(
		'Title'					=> "Varchar"
	);

	/* a mailing list could contains many newsletter recipients */
	static $many_many = array(
		'Recipients'			=> "Recipient"
	);

	//Only for statistics purpose, we keep a unsubscribed count field for each MailingList <=> Recipient peer.
	static $many_many_extraFields = array(
		"Recipients" => array(
			'UnsubscribeCounts'	=> "Int", // if 0, this recipient has naver unsubscribe from this mailing list.
		)
	);
}