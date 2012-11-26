<?php

/**
 * Represents newsletter recipient
 * 
 * @package newsletter
 */
class Recipient extends DataObject {
	static $db = array(
		'Salutation'			=> "Varchar(32)",
		'FristName'				=> "Varchar",
		'MiddleName'			=> "Varchar",
		'Surname'				=> "Varchar",
		'Email'					=> "Varchar(256)",
		'LanguagePreferred' 	=> "Varchar(6)", // the locale code
		'BouncedCount'	    	=> "Int", // if 0, never been bounced
		'Blacklisted'			=> "Boolean",
		// everytime, one of its belonged mailing lists is selected when sending the newletter, plus one to the count, if belong to more than one
		// mailing lists that has been selected when sending the newletter, counts as '1'.
		'RecievedCount'			=> "Int",

		'ValidateHash'			=> "Varchar(160)", // both subscribe and unsebscribe process need to valid this hash for security
		'ValidateHashExpired'	=> "SS_Datetime",
	);

	// a newsletter recipient could belong to many mailing lists.
	static $belongs_many_many = array(
		'MailingLists'			=> 'MailingList',
	);

	static $indexes = array(
		'Email'					=> true,
		'RecievedCount'			=> true,
	);

	static $default_sort = '"FirstName", "Surname"';

	/**
	 *
	 * @var array
	 * @todo Generic implementation of $searchable_fields on Recipient object,
	 * with definition for different searching algorithms
	 * (LIKE, FULLTEXT) and default FormFields to construct a searchform.
	 */
	static $searchable_fields = array(
		'FirstName',
		'MiddleName',
		'Surname',
		'Email',
		'Blacklisted',
		'MailingLists.Title'=> 'Mailing List',
	);
	
	static $summary_fields = array(
		'FirstName'			=> 'First Name',
		'MiddleName'		=> 'Middle Name',
		'Surname'			=> 'Last Name',
		'Email'				=> 'Email',
		'Blacklisted'		=> 'Black listed?',
		'BouncedCount'		=> 'Bounced Count',
		'RecievedCount'		=> 'Count for Recieved newsletters'
	);

	/**
	 * The unique field used to identify this recipient.
	 * Duplication will not be allowed for this feild.
	 * 
	 * @var string
	 */
	protected static $unique_identifier_field = 'Email';

	/**
	 * Ensure the LanguagePreferred is set to something sensible by default.
	 */
	public function populateDefaults() {
		parent::populateDefaults();
		$this->LanguagePreferred = i18n::get_locale();
	}
}