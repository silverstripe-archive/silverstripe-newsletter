<?php

namespace SilverStripe\Newsletter\Tests;

use SilverStripe\Dev\SapphireTest;
use SilverStripe\Newsletter\Model\Newsletter;
use SilverStripe\Forms\FieldList;

class NewsletterTest extends SapphireTest
{
    protected static $fixture_file = "Base.yml";

    public function testGetCMSFields()
    {
        $newsletter = $this->objFromFixture(Newsletter::class, 'daily');

        $this->assertEquals(FieldList::class, $newsletter->getCMSFields());
    }
}
