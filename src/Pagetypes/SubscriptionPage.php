<?php

namespace SilverStripe\Newsletter\Pagetypes;

use SilverStripe\Forms\Tab;
use SilverStripe\Forms\HeaderField;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\CheckboxSetField;
use SilverStripe\Forms\LiteralField;
use SilverStripe\Forms\CompositeField;
use SilverStripe\Forms\HTMLEditor\HtmlEditorField;
use SilverStripe\Forms\HiddenField;
use SilverStripe\Newsletter\Model\Recipient;
use SilverStripe\Newsletter\Model\MailingList;
use SilverStripe\Newsletter\Form\CheckboxSetWithExtraField;
use Page;
use SilverStripe\Newsletter\Control\NewsletterAdmin;

class SubscriptionPage extends Page
{
    private static $db = [
        'Fields' => 'Text',
        'Required' => 'Text',
        'CustomisedHeading' => 'Text',
        'CustomLabel' => 'Text',
        'ValidationMessage' => 'Text',
        'MailingLists' => 'Text',
        'SubmissionButtonText' => 'Varchar',
        'SendNotification' => 'Boolean',
        'NotificationEmailSubject' => 'Varchar',
        'NotificationEmailFrom' => 'Varchar',
        'OnCompleteMessage' => 'HTMLText',
    ];

    private static $defaults = [
        'Fields' => 'Email',
        'SubmissionButtonText' => 'Submit'
    ];

    private static $singular_name = 'Newsletter Subscription Page';

    private static $plural_name = 'Newsletter Subscription Pages';

    private static $days_verification_link_alive = 2;

    private static $table_name = 'SubscriptionPage';

    private static $icon = 'silverstripe/newsletter:client/images/subscription-icon.png';

    public function requireDefaultRecords()
    {
        parent::requireDefaultRecords();

        if (self::config()->get('create_default_pages')) {
            if (!SubscriptionPage::get()->Count()) {
                $page = SubscriptionPage::create();
                $page->Title = 'Newsletter Subscription';
                $page->URLSegment = 'newsletter-subscription';
                $page->SendNotification = 1;
                $page->ShowInMenus = false;
                $page->write();
                $page->publishRecursive();
            }
        }
    }

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields ->addFieldToTab(
            "Root",
            $subscriptionTab = new Tab(
                _t('Newsletter.SUBSCRIPTIONFORM', 'SubscriptionForm')
            )
        );

        $subscriptionTab->push(
            new HeaderField(
                "SubscriptionFormConfig",
                _t('Newsletter.SUBSCRIPTIONFORMCONFIGURATION', "Subscription Form Configuration")
            )
        );

        $subscriptionTab->push(
            new TextField('CustomisedHeading', 'Heading at the top of the form')
        );

        //Fields selction
        $frontFields = singleton(Recipient::class)->getFrontEndFields()->dataFields();

        $fieldCandidates = array();

        if (count($frontFields)) {
            foreach ($frontFields as $fieldName => $dataField) {
                $fieldCandidates[$fieldName]= $dataField->Title()?$dataField->Title():$dataField->Name();
            }
        }

        //Since Email field is the Recipient's identifier,
        //and newsletters subscription is non-sence if no email is given by the user,
        //we should force that email to be checked and required.
        //FisrtName should be checked as default, though it might not be required
        $defaults = array("Email", "FirstName");

        $extra = array('CustomLabel'=>"Varchar","ValidationMessage"=>"Varchar","Required" =>"Boolean");
        $extraValue = array(
            'CustomLabel'=>$this->CustomLabel,
            "ValidationMessage"=>$this->ValidationMessage,
            "Required" =>$this->Required
        );

        $subscriptionTab->push(
            $fieldsSelection = new CheckboxSetWithExtraField(
                "Fields",
                _t('Newsletter.SelectFields', "Select the fields to display on the subscription form"),
                $fieldCandidates,
                $extra,
                $defaults,
                $extraValue
            )
        );

        $fieldsSelection->setCellDisabled(array("Email"=>array("Value", "Required")));

        //Mailing Lists selection
        $mailinglists = MailingList::get();
        $newsletterSelection = $mailinglists && $mailinglists->count()?
        new CheckboxSetField(
            "MailingLists",
            _t("Newsletter.SubscribeTo", "Newsletters to subscribe to"),
            $mailinglists->map('ID', 'FullTitle'),
            $mailinglists
        ):
        new LiteralField(
            "NoMailingList",
            sprintf(
                '<p>%s</p>',
                sprintf(
                    'You haven\'t defined any mailing list yet, please go to '
                    . '<a href=\"%s\">the newsletter administration area</a> '
                    . 'to define a mailing list.',
                    singleton(NewsletterAdmin::class)->Link()
                )
            )
        );
        $subscriptionTab->push(
            $newsletterSelection
        );

        $subscriptionTab->push(
            new TextField("SubmissionButtonText", "Submit Button Text")
        );

        $subscriptionTab->push(
            new LiteralField(
                'BottomTaskSelection',
                sprintf(
                    '<div id="SendNotificationControlls" class="field actions">'.
                    '<label class="left">%s</label>'.
                    '<ul><li class="ss-ui-button no" data-panel="no">%s</li>'.
                    '<li class="ss-ui-button yes" data-panel="yes">%s</li>'.
                    '</ul></div>',
                    _t('Newsletter.SendNotif', 'Send notification email to the subscriber'),
                    _t('Newsletter.No', 'No'),
                    _t('Newsletter.Yes', 'Yes')
                )
            )
        );

        $subscriptionTab->push(
            CompositeField::create(
                new HiddenField(
                    "SendNotification",
                    "Send Notification"
                ),
                new TextField(
                    "NotificationEmailSubject",
                    _t('Newsletter.NotifSubject', "Notification Email Subject Line")
                ),
                new TextField(
                    "NotificationEmailFrom",
                    _t('Newsletter.FromNotif', "From Email Address for Notification Email")
                )
            )->addExtraClass('SendNotificationControlledPanel')
        );

        $subscriptionTab->push(
            new HtmlEditorField(
                'OnCompleteMessage',
                _t('Newsletter.OnCompletion', 'Message shown on subscription completion')
            )
        );
        return $fields;
    }

    /**
     * Email field is the member's identifier, and newsletters subscription is
     * non-sense if no email is given by the user, we should force that email
     * to be checked and required.
     */
    public function getRequired()
    {
        return (!$this->getField('Required')) ? '{"Email":"1"}' : $this->getField('Required');
    }
}
