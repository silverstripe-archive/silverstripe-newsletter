<?php

namespace SilverStripe\Newsletter\Tests;

use SilverStripe\Dev\SapphireTest;
use SilverStripe\Newsletter\Model\Recipient;

class RecipientTest extends SapphireTest
{
    protected static $fixture_file = "Base.yml";

    /**
     * @expectedException SilverStripe\ORM\ValidationException
     */
    public function testOnBeforeWrite()
    {
        $recipient = $this->objFromFixture(Recipient::class, 'normann1');

        $close = Recipient::create();
        $close->Email = 'normann1@silverstripe.com';

        $close->write();
    }
}
