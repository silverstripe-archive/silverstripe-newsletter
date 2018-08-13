<?php

namespace SilverStripe\Newsletter\Extensions;

use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\Tab;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\ORM\DataExtension;

class NewsletterSiteConfigExtension extends DataExtension
{
    private static $db = [
        "GlobalUnsubscribe" => "Boolean"
    ];

    public function updateCMSFields(FieldList $fields)
    {
        $fields->addFieldToTab(
            "Root",
            new Tab(
                _t("Newsletter.Configuration", "NewsletterConfiguration"),
                $globalUnsubscribe = new CheckboxField(
                    "GlobalUnsubscribe",
                    _t("Newsletter.LabelGobalUnsubscribe", "Unsubscribe from all lists by default?")
                )
            )
        );

        $globalUnsubscribeDescription = _t(
            "Newsletter.GlobalUnsubscribeDescription",
            "Clicking any unsubscribe links in each newsletter will unsubscribe the recipient from all mailing lists
			if checked<br />
			otherwise only unsubscribe the recipient from mailing lists that the newsletter related to"
        );

        $globalUnsubscribe->setDescription($globalUnsubscribeDescription);
    }
}
