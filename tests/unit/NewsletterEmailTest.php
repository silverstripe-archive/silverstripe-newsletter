<?php

namespace SilverStripe\Newsletter\Tests;

use SilverStripe\Dev\SapphireTest;
use SilverStripe\Newsletter\Model\Newsletter;
use SilverStripe\Newsletter\Model\Recipient;
use SilverStripe\Newsletter\Control\Email\NewsletterEmail;

/**
 *
 */
class NewsletterEmailTest extends SapphireTest
{
    protected static $fixture_file = "Base.yml";

    /**
     *
     */
    public function testConstructor()
    {
        $newsletter = $this->objFromFixture(Newsletter::class, 'all');
        $recipient = $this->objFromFixture(Recipient::class, 'normann1');
        $email = new NewsletterEmail($newsletter, $recipient);
        $data = $email->getData();

        $this->assertEquals($newsletter->Subject, $data['Subject']);
    }

    /**
     *
     */
    public function testCreatesUniqueUnsubscribeLink()
    {
        $newsletter = $this->objFromFixture(Newsletter::class, 'all');
        $recipient = $this->objFromFixture(Recipient::class, 'normann1');
        $email = new NewsletterEmail($newsletter, $recipient);

        $recipient2 = $this->objFromFixture(Recipient::class, 'normann2');
        $email2 = new NewsletterEmail($newsletter, $recipient2);

        $this->assertContains('unsubscribe/index', $email->UnsubscribeLink());
        $this->assertNotEquals(
            $email->UnsubscribeLink(),
            $email2->UnsubscribeLink()
        );
    }
}
