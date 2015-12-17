<?php
/**
 * @package  newsletter
 */

/**
 * Represents newsletter recipient
 */
class Recipient extends DataObject
{

    private static $db = array(
        'Email'                    => "Varchar(255)",
        'FirstName'                => "Varchar(255)",
        'MiddleName'            => "Varchar(255)",
        'Surname'                => "Varchar(255)",
        'Salutation'            => "Varchar(255)",
        'BouncedCount'            => "Int", // if 0, never been bounced
        'Blacklisted'            => "Boolean",
        // everytime, one of its belonged mailing lists is selected when sending the newletter,
        // plus one to the count, if belong to more than one
        // mailing lists that has been selected when sending the newletter, counts as '1'.
        'ReceivedCount'            => "Int",

        // both subscribe and unsebscribe process need to valid this hash for security
        'ValidateHash'            => "Varchar(160)",
        'ValidateHashExpired'    => "SS_Datetime",
        'Verified'                => "Boolean(1)",
    );

    // a newsletter recipient could belong to many mailing lists.
    private static $belongs_many_many = array(
        'MailingLists'            => 'MailingList',
    );
    private static $has_many = array(
        'SendRecipientQueue' => 'SendRecipientQueue',
    );

    private static $indexes = array(
        'Email'                    => true,
        'ReceivedCount'            => true,
    );

    private static $default_sort = '"FirstName", "Surname"';

    /**
     *
     * @var array
     * @todo Generic implementation of $searchable_fields on Recipient object,
     * with definition for different searching algorithms
     * (LIKE, FULLTEXT) and default FormFields to construct a searchform.
     */
    private static $searchable_fields = array(
        'FirstName',
        'MiddleName',
        'Surname',
        'Email',
        'Blacklisted',
        'MailingLists.Title' => array('title' => 'Mailing List'),
        'Verified',
    );

    private static $summary_fields = array(
        'FirstName'            => 'First Name',
        'Surname'            => 'Last Name',
        'Email'                => 'Email',
        'Blacklisted'        => 'Blacklisted',
        'BouncedCount'        => 'Bounced Count',
        'ReceivedCount'        => 'Count for Received newsletters'
    );

    /**
     * @var array Data used for test emails and previews.
     */
    public static $test_data = array(
        'FirstName' => 'John',
        'MiddleName' => 'Jack',
        'Surname' => 'Doe',
        'Salutation' => 'Mr.',
        'Email' => 'john@example.org'
    );

    public function validate()
    {
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
     * Event handler called before writing to the database. we need to deal with the unique_identifier_field here
     */
    public function onBeforeWrite()
    {
        // If a recipient with the same "unique identifier" already exists with a different ID, don't allow merging.
        // Note: This does not a full replacement for safeguards in the controller layer (e.g. in a subscription form),
        // but rather a last line of defense against data inconsistencies.
        $identifierField = self::$unique_identifier_field;
        if ($this->$identifierField) {
            // Note: Same logic as Member_Validator class
            $idClause = ($this->ID) ? sprintf(" AND \"Recipient\".\"ID\" <> %d", (int) $this->ID) : '';
            $existingRecord = DataObject::get_one(
                'Recipient',
                sprintf(
                    "\"%s\" = '%s' %s",
                    $identifierField,
                    Convert::raw2sql($this->$identifierField),
                    $idClause
                )
            );
            if ($existingRecord) {
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

        parent::onBeforeWrite();
    }

    public function getCMSFields()
    {
        $fields = new FieldList();
        $fields->push(new TabSet("Root", $mainTab = new Tab("Main")));
        $mainTab->setTitle(_t('SiteTree.TABMAIN', "Main"));

        $fields->addFieldToTab('Root.Main', new TextField('Email', $this->fieldLabel('Email')));

        $fields->addFieldsToTab(
            'Root.Main',
            array(
                Object::create('TextField', 'Salutation', $this->fieldLabel('Salutation')),
                Object::create('TextField', 'FirstName', $this->fieldLabel('First Name')),
                Object::create('TextField', 'MiddleName', $this->fieldLabel('Middle Name')),
                Object::create('TextField', 'Surname', $this->fieldLabel('Surname'))
            )
        );

        if (!empty($this->ID)) {
            $fields->addFieldToTab('Root.Main',
                Object::create('CheckboxSetField',
                    'MailingLists',
                    $this->fieldLabel('MailingLists'),
                    MailingList::get()->map('ID', 'FullTitle')
                ));
        }

        $fields->addFieldsToTab(
            'Root.Main',
            array(
                Object::create('ReadonlyField', 'BouncedCount', $this->fieldLabel('BouncedCount')),
                Object::create('CheckboxField', 'Verified', $this->fieldLabel('Verified'))
                    ->setDescription(
                        _t('Newsletter.VerifiedDesc', 'Has this user verified his subscription?')
                    ),
                Object::create('CheckboxField', 'Blacklisted', $this->fieldLabel('Blacklisted'))
                    ->setDescription(
                        _t(
                            'Newsletter.BlacklistedDesc',
                            'Excluded from emails, either by automated process or manually. '
                            . 'An invalid address or undeliverable email will eventually result in blacklisting.'
                        )
                    ),
                Object::create('ReadonlyField', 'ReceivedCount', $this->fieldLabel('ReceivedCount'))
                    ->setDescription(
                        _t(
                            'Newsletter.ReceivedCountDesc',
                            'Number of emails sent without undeliverable errors. '
                            . 'Only one indication that an email has actually been received and read.'
                        )
                    )
            )
        );

        $this->extend('updateCMSFields', $fields);

        return $fields;
    }

    public function fieldLabels($includerelations = true)
    {
        $labels = parent::fieldLabels($includerelations);

        $labels['Salutation'] = _t('Newsletter.FieldSalutation', 'Salutation');
        $labels['FirstName'] = _t('Newsletter.FieldFirstName', 'FirstName');
        $labels['Surname'] = _t('Newsletter.FieldSurname', 'Surname');
        $labels['MiddleName'] = _t('Newsletter.FieldMiddleName', 'Middle Name');
        $labels['Mailinglists'] = _t('Newsletter.FieldMailinglists', 'Mailinglists');
        $labels['BouncedCount'] = _t('Newsletter.FieldBouncedCount', 'Bounced Count');
        $labels['Verified'] = _t('Newsletter.FieldVerified', 'Verified?');
        $labels['Blacklisted'] = _t('Newsletter.FieldBlacklisted', 'Blacklisted?');
        $labels['ReceivedCount'] = _t('Newsletter.FieldReceivedCount', 'Received Count');

        return $labels;
    }

    /** Returns the title of this Recipient for the MailingList auto-complete add field. The title includes the
     * email address, so that users with the same name can be distinguished. */
    public function getTitle()
    {
        $f = '';
        if (!empty($this->FirstName)) {
            $f = "$this->FirstName ";
        }
        $m = '';
        if (!empty($this->MiddleName)) {
            $m = "$this->MiddleName ";
        }
        $s = '';
        if (!empty($this->Surname)) {
            $s = "$this->Surname ";
        }
        $e = '';
        if (!empty($this->Email)) {
            $e = "($this->Email)";
        }
        return $f.$m.$s.$e;
    }

    public function getHashText()
    {
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
    public function generateValidateHashAndStore($lifetime = 2)
    {
        do {
            $generator = new RandomGenerator();
            $hash = $generator->randomToken();
        } while (DataObject::get_one('Recipient', "\"ValidateHash\" = '$hash'"));

        $this->ValidateHash = $hash;
        $this->ValidateHashExpired = date('Y-m-d H:i:s', time() + (86400 * $lifetime));

        $this->write();

        return $hash;
    }

    public function onBeforeDelete()
    {
        parent::onBeforeDelete();

        //SendRecipientQueue
        $queueditems = $this->SendRecipientQueue();
        if ($queueditems && $queueditems->exists()) {
            foreach ($queueditems as $item) {
                $item->delete();
            }
        }

        //remove this from its belonged mailing lists
        $mailingLists = $this->MailingLists()->removeAll();
    }

    public function canDelete($member = null)
    {
        $can = parent::canDelete($member);
        $queueditems = $this->SendRecipientQueue();
        if ($queueditems->count()) {
            foreach ($queueditems as $queueditem) {
                $can = $can && !($queueditem->Status === 'Scheduled' && $queueditem->Status === 'InProgress');
            }
        }
        return $can;
    }

    public function getFrontEndFields($params = null)
    {
        $fields = parent::getFrontEndFields($params);
        $exludes = array(
            "BouncedCount",
            "Blacklisted",
            "ReceivedCount",
            "ValidateHash",
            "ValidateHashExpired",
            "Verified",
        );

        foreach ($exludes as $exclude) {
            $fields->removeByName($exclude);
        }
        return $fields;
    }
}
