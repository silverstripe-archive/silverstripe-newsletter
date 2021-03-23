<?php

namespace SilverStripe\Newsletter\Model;

use SilverStripe\ORM\DataObject;
use SilverStripe\Newsletter\Control\Email\NewsletterEmail;

class SendRecipientQueue extends DataObject
{
    private static $db = [
        "Status" => "Enum('Scheduled, InProgress, Sent, Failed, Bounced, BlackListed', 'Scheduled')",
        "RetryCount" => "Int(0)"
    ];

    private static $has_one = [
        "Newsletter" => Newsletter::class,
        "Recipient" => Recipient::class
    ];

    private static $summary_fields = [
        "Status",
        "Newsletter.Subject",
        "Recipient.Email",
        "RetryCount",
        "LastEdited",
    ];

    private static $default_sort = [
        'LastEdited DESC'
    ];

    private static $table_name = 'SendRecipientQueue';

    public function canCreate($member = null, $context = [])
    {
        // can only be created by PHP
        return false;
    }

    public function canEdit($member = null)
    {
        return false;
    }

    /**
     * @param boolean $includeRelations
     */
    public function fieldLabels($includeRelations = true)
    {
        $labels = parent::fieldLabels($includeRelations);

        $labels["Status"] = _t('Newsletter.FieldStatus', "Status");
        $labels["Recipient.Email"] = _t('Newsletter.FieldEmail', "Email");
        $labels["RetryCount"] = _t('Newsletter.FieldRetryCount', "Retry Count");
        $labels["LastEdited"] = _t('Newsletter.FieldLastEdited', "Last Edited");

        return $labels;
    }

    /**
     *
     */
    public function send()
    {
        $recipient = $this->Recipient();
        $newsletter = $this->Newsletter();

        if (!$recipient || !$newsletter) {
            $this->Status = 'Failed';
            $this->write();

            return;
        }

        if ($recipient && empty($recipient->Blacklisted) && $recipient->Verified) {
            $email = NewsletterEmail::create(
                $newsletter,
                $recipient
            );

            if (!empty($newsletter->ReplyTo)) {
                $email->setReplyTo($newsletter->ReplyTo);
            }

            try {
                $success = $email->send();
            } catch (Exception $e) {
                $tsuccess = false;
            }

            if ($success) {
                $this->Status = 'Sent';
                $recipient->ReceivedCount = $recipient->ReceivedCount + 1;
            } else {
                $this->Status = 'Failed';
                $recipient->BouncedCount = $recipient->BouncedCount + 1;
            }

            $recipient->write();
        } else {
            $this->Status = 'BlackListed';
        }

        $this->write();
    }
}
