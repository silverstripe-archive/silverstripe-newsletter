<?php

namespace SilverStripe\Newsletter\Test\Behaviour;

use SilverStripe\BehatExtension\Context\SilverStripeContext;
use SilverStripe\BehatExtension\Context\BasicContext;
use SilverStripe\BehatExtension\Context\LoginContext;
use SilverStripe\BehatExtension\Context\EmailContext;
use SilverStripe\Framework\Test\Behaviour\CmsFormsContext;
use SilverStripe\Framework\Test\Behaviour\CmsUiContext;

// PHPUnit
require_once 'PHPUnit/Autoload.php';
require_once 'PHPUnit/Framework/Assert/Functions.php';

/**
 * Features context
 *
 * Context automatically loaded by Behat.
 * Uses subcontexts to extend functionality.
 */
class FeatureContext extends SilverStripeContext
{
    /**
     * Initializes context.
     * Every scenario gets it's own context object.
     *
     * @param array   $parameters     context parameters (set them up through behat.yml)
     */
    public function __construct(array $parameters)
    {
        $this->useContext('BasicContext', new BasicContext($parameters));
        $this->useContext('LoginContext', new LoginContext($parameters));
        $this->useContext('CmsFormsContext', new CmsFormsContext($parameters));
        $this->useContext('CmsUiContext', new CmsUiContext($parameters));
        $this->useContext('EmailContext', new EmailContext($parameters));

        parent::__construct($parameters);
    }

    /**
     * @Given /^"([^"]*)" should be subscribed to "([^"]*)"$/
     */
    public function thenEmailShouldBeSubscribedToMailinglist($email, $mailinglistTitle)
    {
        $recipient = \Recipient::get()->filter('Email', $email)->First();
        assertNotNull($recipient, 'Could not find Recipient with ' . $email);

        $mailinglist = \MailingList::get()->filter('Title', $mailinglistTitle)->First();
        assertNotNull($mailinglist, 'Could not find MailingList with ' . $mailinglistTitle);

        assertContains($mailinglistTitle, $recipient->MailingLists()->column('Title'));
    }

    /**
     * @Given /^the newsletter subscription for "([^"]*)" (should|should not) be verified$/
     */
    public function theNewsletterSubscriptionForIsVerified($email, $shouldOrNot = '')
    {
        $recipient = \Recipient::get()->filter('Email', $email)->First();
        assertNotNull($recipient, 'Could not find Recipient with ' . $email);

        $assertion = ($shouldOrNot == 'should') ? 'assertTrue' : 'assertFalse';
        $assertion((bool)$recipient->Verified);
    }

    /**
     * @Given /^I add the "([^"]*)" mailinglist to the "([^"]*)" page$/
     */
    public function iAddTheMailinglistToThePage($mailinglistTitle, $pageUrl)
    {
        $mailinglist = \MailingList::get()->filter('Title', $mailinglistTitle)->First();
        assertNotNull($mailinglist, 'Could not find MailingList with ' . $mailinglistTitle);

        $page = \SubscriptionPage::get()->filter('URLSegment', $pageUrl)->First();
        assertNotNull($page);

        $lists = $page->MailingLists ? explode(',', $page->MailingLists) : array();
        $lists[] = $mailinglist->ID;
        $page->MailingLists = implode(',', $lists);
        $page->write();
        $page->publish('Stage', 'Live');
    }
}
