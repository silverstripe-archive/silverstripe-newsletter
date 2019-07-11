<?php

namespace SilverStripe\Newsletter\Model;

use SilverStripe\ORM\DataObject;

class UnsubscribeRecord extends DataObject
{
    private static $has_one = [
        'MailingList' => 'MailingList',
        'Recipient' => 'Recipient'
    ];

    private static $table_name = 'UnsubscribeRecord';

    public function unsubscribe($recipient, $mailinglist)
    {
        $this->RecipientID = (is_numeric($recipient))
            ? $recipient
            : $recipient->ID;

        $this->MailingListID = (is_numeric($mailinglist))
            ? $mailinglist
            : $mailinglist->ID;

        $this->write();
    }
}
