<?php

namespace SilverStripe\Newsletter\Extensions;

use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\EmailField;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Core\Extension;
use SilverStripe\Newsletter\Form\UnsubscribeRequestForm;

class NewsletterContentControllerExtension extends Extension
{
    private static $allowed_actions = [
        'UnsubscribeRequestForm'
    ];

    public function UnsubscribeRequestForm()
    {
        return UnsubscribeRequestForm::create($this->owner, __FUNCTION__);
    }
}
