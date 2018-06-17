<?php

namespace SilverStripe\Newsletter\Model;

use SilverStripe\ORM\DataObject;
use SilverStripe\Control\Email\Email;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\ReadonlyField;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\FieldList;

class Recipient extends DataObject
{
    private static $db = [
        'Email' => "Varchar(255)",
        'FirstName' => "Varchar(255)",
        'MiddleName' => "Varchar(255)",
        'Surname' => "Varchar(255)",
        'GUID' => 'Varchar(255)',
        'Salutation' => "Varchar(255)",
        'BouncedCount' => "Int",
        'Blacklisted' => "Boolean",
        'ReceivedCount' => "Int",
        'ValidateHash' => "Varchar(160)",
        'ValidateHashExpired' => "Datetime",
        'Verified'  => "Boolean(1)",
    ];

    private static $belongs_many_many = [
        'MailingLists' => MailingList::class,
    ];

    private static $has_many = [
        'SendRecipientQueue' => SendRecipientQueue::class,
    ];

    private static $indexes = [
        'Email'                    => true,
        'ReceivedCount'            => true,
    ];

    private static $default_sort = '"FirstName", "Surname"';

    private static $table_name = 'Recipient';

    private static $searchable_fields = [
        'FirstName',
        'MiddleName',
        'Surname',
        'Email',
        'Blacklisted',
        'MailingLists.Title' => [
            'title' => 'Mailing List'
        ],
        'Verified',
    ];

    private static $summary_fields = [
        'FirstName'            => 'First Name',
        'Surname'            => 'Last Name',
        'Email'                => 'Email',
        'Blacklisted'        => 'Blacklisted',
        'BouncedCount'        => 'Bounced Count',
        'ReceivedCount'        => 'Count for Received newsletters'
    ];

    private static $test_data = [
        'FirstName' => 'John',
        'MiddleName' => 'Jack',
        'Surname' => 'Doe',
        'Salutation' => 'Mr.',
        'Email' => 'john@example.org'
    ];

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
                self::class,
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

        if (!$this->GUID) {
            $this->GUID = md5($id .'-'. time());
        }

        parent::onBeforeWrite();
    }

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName('FileTracking');
        $fields->removeByName('LinkTracking');
        $fields->makeFieldReadonly('BouncedCount');
        $fields->makeFieldReadonly('ReceivedCount');
        $fields->makeFieldReadonly('ValidateHash');
        $fields->makeFieldReadonly('ValidateHashExpired');

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
        } while (Recipient::get()->filter("ValidateHash", $hash)->exists());

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
