<?php

/**
 * Represents newsletter recipient
 * 
 * @package newsletter
 */
class Recipient extends DataObject {
	static $db = array(
		'Email'					=> "Varchar(255)",
		'FirstName'				=> "Varchar(255)",
		'MiddleName'			=> "Varchar(255)",
		'Surname'				=> "Varchar(255)",
		'Salutation'			=> "Varchar(255)",
		'LanguagePreferred' 	=> "Varchar(6)", // the locale code
		'BouncedCount'	    	=> "Int", // if 0, never been bounced
		'Blacklisted'			=> "Boolean",
		// everytime, one of its belonged mailing lists is selected when sending the newletter,
		// plus one to the count, if belong to more than one
		// mailing lists that has been selected when sending the newletter, counts as '1'.
		'ReceivedCount'			=> "Int",

		// both subscribe and unsebscribe process need to valid this hash for security
		'ValidateHash'			=> "Varchar(160)",
		'ValidateHashExpired'	=> "SS_Datetime",
		'Archived'				=> "Boolean",
		'Verified'				=> "Boolean",
	);

	// a newsletter recipient could belong to many mailing lists.
	static $belongs_many_many = array(
		'MailingLists'			=> 'MailingList',
	);
	static $has_many = array(
		'SendRecipientQueue' => 'SendRecipientQueue',
	);

	static $indexes = array(
		'Email'					=> true,
		'ReceivedCount'			=> true,
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
		'Archived',
		'MailingLists.Title'=> 'Mailing List',
		'Verified',
	);

	static $summary_fields = array(
		'FirstName'			=> 'First Name',
		'MiddleName'		=> 'Middle Name',
		'Surname'			=> 'Last Name',
		'Salutation'        => 'Salutation',
		'Email'				=> 'Email',
		'Archived'		    => 'Archived',
		'Verified'			=> 'Verified',
		'Blacklisted'		=> 'Blacklisted',
		'BouncedCount'		=> 'Bounced Count',
		'ReceivedCount'		=> 'Count for Received newsletters'
	);


	public function validate() {
		$result = parent::validate();

		if (empty($this->Email)) {
			$result->error(_t('Newsletter.FieldRequired',
				'"{field}" field is required',
					array('field' => 'Email')
			));
		}

		if (!Email::validEmailAddress($this->Email)) {
			$result->error(_t('Newsletter.InvalidEmailAddress',
				'"{field}" field is invalid',
					array('field' => 'Email')
			));
		}

		return $result;
	}

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

	/**
	 * Event handler called before writing to the database. we need to deal with the unique_identifier_field here
	 * Also set LanguagePreferred as the current locale, if not set yet.
	 */
	public function onBeforeWrite() {
		// If a recipient with the same "unique identifier" already exists with a different ID, don't allow merging.
		// Note: This does not a full replacement for safeguards in the controller layer (e.g. in a subscription form), 
		// but rather a last line of defense against data inconsistencies.
		$identifierField = self::$unique_identifier_field;
		if($this->$identifierField) {
			// Note: Same logic as Member_Validator class
			$idClause = ($this->ID) ? sprintf(" AND \"Recipient\".\"ID\" <> %d", (int)$this->ID) : '';
			$existingRecord = DataObject::get_one(
				'Recipient', 
				sprintf(
					"\"%s\" = '%s' %s",
					$identifierField,
					Convert::raw2sql($this->$identifierField),
					$idClause
				)
			);
			if($existingRecord) {
				throw new ValidationException(new ValidationResult(false, _t(
					'Recipient.ValidationIdentifierFailed', 
					'Can\'t overwrite existing recipient #{id} with identical identifier ({name} = {value}))', 
					'Values in brackets show "fieldname = value", usually denoting an existing email address',
					array(
						'id' => $existingRecord->ID,
						'name' => $identifierField,
						'value' => $this->$identifierField
					)
				)));
			}
		}

		// save LanguagePreferred
		if(!$this->LanguagePreferred) {
			$this->LanguagePreferred = i18n::get_locale();
		}
		
		parent::onBeforeWrite();
	}

	public function getCMSFields() {
		$fields = new FieldList();
		$fields->push(new TabSet("Root", $mainTab = new Tab("Main")));
		$mainTab->setTitle(_t('SiteTree.TABMAIN', "Main"));

		//$fields->addFieldToTab('Root.Main',new TextField('Email',self::$summary_fields['Email']);
		$fields->addFieldToTab('Root.Main',new TextField('Email',self::$summary_fields['Email']));

		$fields->addFieldToTab('Root.Main',new TextField('Salutation',self::$summary_fields['Salutation']));
		$fields->addFieldToTab('Root.Main',new TextField('FirstName',self::$summary_fields['FirstName']));
		$fields->addFieldToTab('Root.Main',new TextField('MiddleName',self::$summary_fields['MiddleName']));
		$fields->addFieldToTab('Root.Main',new TextField('Surname',self::$summary_fields['Surname']));

		$fields->addFieldToTab('Root.Main',new CheckboxSetField('MailingLists','Mailing Lists',MailingList::get()->map()));

		$fields->addFieldToTab('Root.Main',new ReadonlyField('BouncedCount',self::$summary_fields['BouncedCount']));
		$fields->addFieldToTab('Root.Main',new CheckboxField('Blacklisted',self::$summary_fields['Blacklisted']));
		$fields->addFieldToTab('Root.Main',new ReadonlyField('ReceivedCount',self::$summary_fields['ReceivedCount']));

		return $fields;
	}

	/** Returns the title of this Recipient for the MailingList auto-complete add field. The title includes the
	 * email address, so that users with the same name can be distinguished. */
	public function getTitle() {
		$f = '';
		if (!empty($this->FirstName)) $f = "$this->FirstName ";
		$m = '';
		if (!empty($this->MiddleName)) $m = "$this->MiddleName ";
		$s = '';
		if (!empty($this->Surname)) $s = "$this->Surname ";
		$e = '';
		if (!empty($this->Email)) $e = "($this->Email)";
		return $f.$m.$s.$e;
	}

	public function getHashText(){
		return substr($this->ValidateHash, 0, 10)."******".substr($this->ValidateHash, -10);
	}

	/**
	 * Generate an auto login token which can be used to reset the password,
	 * at the same time hashing it and storing in the database.
	 *
	 * @param int $lifetime The lifetime of the auto login hash in days (by default 2 days)
	 *
	 * @returns string Token that should be passed to the client (but NOT persisted).
	 *
	 * @todo Make it possible to handle database errors such as a "duplicate key" error
	 */
	public function generateValidateHashAndStore($lifetime = 2) {
		do {
			$generator = new RandomGenerator();
			$hash = $generator->randomToken();
		} while(DataObject::get_one('Recipient', "\"ValidateHash\" = '$hash'"));

		$this->ValidateHash = $hash;
		$this->ValidateHashExpired = date('Y-m-d H:i:s', time() + (86400 * $lifetime));

		$this->write();

		return $hash;
	}

	public function onBeforeDelete(){
		parent::onBeforeDelete();

		//SendRecipientQueue
		$queueditems = $this->SendRecipientQueue();
		if($queueditems && $queueditems->exists()){
			foreach($queueditems as $item){
				$item->delete();
			}
		}

		//remove this from its belonged mailing lists
		$mailingLists = $this->MailingLists()->removeAll();
	}


	public function canArchive($member = null){
		$can = parent::canDelete($member);
		return $can && !($this->Archived);
	}

	public function canDelete($member = null) {
		$can = parent::canDelete($member);
		$queueditems = $this->SendRecipientQueue();
		if($queueditems->count()){
			foreach($queueditems as $queueditem){
				$can = $can && !($queueditem->Status === 'Scheduled' && $queueditem->Status === 'InProgress');
			}
		}
		if($this->Archived || !$this->Verified ) return $can;
		else return false;
	}

	public function getFrontEndFields($params = null) {
		$fields = parent::getFrontEndFields($params);
		$exludes = array(
			"BouncedCount",
			"Blacklisted",
			"ReceivedCount",
			"ValidateHash",
			"ValidateHashExpired",
			"LanguagePreferred",
			"Archived",
			"Verified",
		);

		foreach($exludes as $exclude) {
			$fields->removeByName($exclude);
		}
		return $fields;
	}
}