<?php

namespace SilverStripe\Newsletter\Model;

use SilverStripe\ORM\DataObject;

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
        "Recipient.Email",
        "RetryCount",
        "LastEdited",
    ];

    private static $default_sort = [
        'LastEdited DESC'
    ];

    private static $table_name = 'SendRecipientQueue';

    public function fieldLabels($includelrelations = true)
    {
        $labels = parent::fieldLabels($includelrelations);

        $labels["Status"] = _t('Newsletter.FieldStatus', "Status");
        $labels["Recipient.Email"] = _t('Newsletter.FieldEmail', "Email");
        $labels["RetryCount"] = _t('Newsletter.FieldRetryCount', "Retry Count");
        $labels["LastEdited"] = _t('Newsletter.FieldLastEdited', "Last Edited");

        return $labels;
    }

    public function send($newsletter = null, $recipient = null)
    {
        if (empty($newsletter)) {
            $newsletter = $this->Newsletter();
        }
        if (empty($recipient)) {
            $recipient = $this->Recipient();
        }

        //check recipient not blacklisted and verified
        if ($recipient && empty($recipient->Blacklisted) && !empty($recipient->Verified)) {
            $email = new NewsLetterEmail(
                $newsletter,
                $recipient
            );
            if (!empty($newsletter->ReplyTo)) {
                $email->addCustomHeader('Reply-To', $newsletter->ReplyTo);
            }

            $success = $email->send();

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
