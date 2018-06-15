<?php

namespace SilverStripe\Newsletter\Pagetypes;

use Page;

class UnsubscriptionPage extends Page
{

    private static $defaults = [
        'Content' => 'Enter your email address and we will send you an email with an unsubscribe link'
    ];
}
