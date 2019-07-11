<?php

namespace SilverStripe\Newsletter\Control;

use SilverStripe\Control\Cookie;
use SilverStripe\CMS\Controllers\ContentController;
use SilverStripe\Newsletter\Model\NewsletterTrackedLink;

class TrackLinkController extends ContentController
{
    public function init()
    {
        parent::init();

        if ($params = $this->getURLParams()) {
            if (isset($params['Hash'])) {
                $link = NewsletterTrackedLink::get()->filter("Hash", $hash);

                if ($link) {
                    // check for them visiting this link before
                    if (!Cookie::get('ss-newsletter-link-'.$hash)) {
                        $link->Visits++;
                        $link->write();

                        Cookie::set('ss-newsletter-link-'. $hash, true);
                    }

                    return $this->redirect($link->Original, 301);
                }
            }
        }

        return $this->httpError(404);
    }
}
