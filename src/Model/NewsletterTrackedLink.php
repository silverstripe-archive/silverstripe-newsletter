<?php

namespace SilverStripe\Newsletter\Model;

use SilverStripe\ORM\DataObject;

class NewsletterTrackedLink extends DataObject
{
    private static $db = [
        'Original' => 'Varchar(255)',
        'Hash' => 'Varchar(100)',
        'Visits' => 'Int'
    ];

    private static $has_one = [
        'Newsletter' => Newsletter::class
    ];

    private static $summary_fields = [
        "Newsletter.Subject" => "Newsletter",
        "Original" => "Link URL",
        "Visits" => "Visit Counts"
    ];

    private static $table_name = 'NewsletterTrackedLink';

    private static $singular_name = 'Tracked Link';

    private static $plural_name = 'Tracked Links';

    /**
     * Generate a unique hash
     */
    public function onBeforeWrite()
    {
        parent::onBeforeWrite();

        if (!$this->Hash) {
            $this->Hash = md5(time() + rand());
        }
    }

    /**
     * Return the full link to the hashed url, not the actual link location.
     *
     * @return string
     */
    public function Link()
    {
        if (!$this->Hash) {
            $this->write();
        }

        return Controller::join_links('newsletterlinks/'. $this->Hash);
    }
}
