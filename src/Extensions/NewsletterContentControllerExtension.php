<?php

namespace SilverStripe\Newsletter\Extensions;

use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\EmailField;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Core\Extension;

class NewsletterContentControllerExtension extends Extension
{
    public function UnsubscribeRequestForm()
    {
        return UnsubscribeRequestForm::create($this, __FUNCTION__);
    }
}
