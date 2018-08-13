<?php

namespace SilverStripe\Newsletter\Tests;

use SilverStripe\Dev\FunctionalTest;
use SilverStripe\Newsletter\Control\UnsubscribeController;
use SilverStripe\Newsletter\Model\Recipient;
use SilverStripe\Newsletter\Model\MailingList;
use SilverStripe\Security\Member;
use SilverStripe\Control\Director;
use SilverStripe\Security\Group;
use SilverStripe\Core\Config\Config;

class UnsubscribeTest extends FunctionalTest
{
    protected static $fixture_file = 'Base.yml';

    protected $page;

    public function setUp()
    {
        parent::setUp();

        $this->page = new UnsubscribeController();
    }

    public function testIndexWithAutoLoginHashAndNewsletterType()
    {
        $member = $this->objFromFixture(Recipient::class, "normann1");
        $list = $this->objFromFixture(MailingList::class, 'ml1');
        $hash = $member->generateValidateHashAndStore();

        $this->assertTrue($list->Recipients()->find('ID', $member->ID)->exists());

        $response = $this->get($this->page->Link('index/'. $hash .'/'. $list->ID));
        $this->assertContains(
            'unsubscribe/done/'. $hash .'/'. $list->ID,
            $response->getHeader('Location')
        );

        $this->assertFalse($member->inGroup($group));
    }

    public function testDoneMessage()
    {
        $url1 = 'unsubscribe/done/94l4ee9ib8kkw3s08k8wwcs4g/1';
        $url2 = html_entity_decode(
            'unsubscribe/done/94l4ee9ib8kkw3s08k8wwcs4g?MailingLists[1]=1&MailingLists[2]=2'
        );

        $body1 = $this->get($url1)->getBody();
        $body2 = $this->get($url2)->getBody();

        $message1 = 'You have been unsubscribed successfully';

        $this->AssertContains($message1, $body1);
    }
}
