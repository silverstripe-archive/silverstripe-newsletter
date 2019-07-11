<?php

namespace SilverStripe\Newsletter\Control;

use SilverStripe\Control\Cookie;
use SilverStripe\CMS\Controllers\ContentController;
use SilverStripe\Newsletter\Model\Newsletter;
use SilverStripe\Newsletter\Model\Recipient;

class NewsletterViewController extends ContentController
{
    public function index()
    {
        $newsletter = Newsletter::get()->byId($this->getParam('ID'));
        $recipient = Recipient::get()->filter("ValidateHash", $this->getParam('Hash'))->first();

        if (!$newsletter || !$recipient) {
            return $this->httpError(404);
        }

        $newsletterEmail = newsletterEmail::create($newsletter, $recipient);

        return $newsletterEmail->render();
    }
}
