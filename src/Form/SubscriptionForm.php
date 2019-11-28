<?php

namespace SilverStripe\Newsletter\Form;

use Exception;
use Psr\Log\LoggerInterface;
use SilverStripe\Forms\Form;
use SilverStripe\Forms\FormAction;
use SilverStripe\Forms\FileField;
use SilverStripe\Forms\RequiredFields;
use SilverStripe\ORM\ArrayList;
use SilverStripe\Newsletter\Model\Recipient;
use SilverStripe\Newsletter\Model\MailingList;
use SilverStripe\Forms\CompositeField;
use SilverStripe\Newsletter\Pagetypes\SubscriptionPage;
use SilverStripe\Forms\FieldList;
use SilverStripe\Control\Email\Email;
use SilverStripe\Core\Injector\Injector;
use SilverStripe\SiteConfig\SiteConfig;
use SilverStripe\View\ArrayData;

class SubscriptionForm extends Form
{
    public function __construct($controller, $name)
    {
        $fields = singleton(Recipient::class)->getFrontEndFields()->dataFields();

        if ($fields && is_array($fields)) {
            $fields = new FieldList($fields);
        }
        else if (!$fields || $fields instanceof FieldList) {
            $fields = new FieldList();
        }

        if ($controller->MailingLists) {
            $mailinglists = MailingList::get()->filter('ID', explode(',', $controller->MailingLists));
        } else {
            $mailinglists = MailingList::get()->filter('Public', 1);
        }

        if ($mailinglists->exists()) {
            $newsletterSection = new CompositeField(
                new LabelField("Newsletters", _t("SubscriptionPage.To", "Subscribe to:"), 4),
                new CheckboxSetField("NewsletterSelection", "", $mailinglists, $mailinglists->getIDList())
            );

            $fields->push($newsletterSection);
        }

        $buttonTitle = $this->SubmissionButtonText;

        $actions = new FieldList(
            new FormAction('doSubscribe', $buttonTitle)
        );

        $required = new RequiredFields(['Email']);

        parent::__construct($controller, $name, $fields, $actions, $required);
    }

     /**
      * Subscribes a given email address to the {@link NewsletterType} associated
      * with this page
      *
      * @param array
      * @param Form
      * @param SS_HTTPRequest
      *
      * @return Redirection
      */
    public function doSubscribe($data, $form, $request)
    {
        // check to see if member already exists
        $recipient = Recipient::get()->find('Email', $data['Email']);

        if (!$recipient) {
            $recipient = new Recipient();
            $recipient->Verified = false;
        }

        $form->saveInto($recipient);
        $recipient->write();

        $days = SubscriptionPage::config()->get('days_verification_link_alive');

        if ($recipient->ValidateHash) {
            $recipient->ValidateHashExpired = date('Y-m-d H:i:s', time() + (86400 * $days));
            $recipient->write();
        } else {
            $recipient->generateValidateHashAndStore($days);
        }

        $mailinglists = new ArrayList();

        if (isset($data["NewsletterSelection"])) {
            foreach ($data["NewsletterSelection"] as $listID) {
                $mailinglist = MailingList::get()->byId($listID);

                if ($mailinglist && $mailinglist->exists()) {
                    $unsubscribed = UnsubscribeRecord::get()->filter([
                        'RecipientIDs' => $recipient->ID,
                        'MailingListID' => $listID
                    ]);

                    foreach ($unsubscribed as $unsub) {
                        $unsub->delete();
                    }

                    $mailinglists->push($mailinglist);
                    $recipient->MailingLists()->add($mailinglist);
                }
            }
        }

        $recipientInfoSection = $form->Fields();
        $emailableFields = new FieldList();

        if ($recipientInfoSection) {
            foreach ($recipientInfoSection as $field) {
                if (is_array($field->Value()) && is_a($field, FileField::class)) {
                    $funcName = $field->Name();
                    $value = $recipient->$funcName()->CMSThumbnail()->Tag();
                    $field->EmailalbeValue = $value;
                } else {
                    $field->EmailalbeValue = $field->Value();
                }

                $emailableFields->push($field);
            }
        }

        $verify = $this->controller->join_links(
            $this->controller->Link('subscribeverify'),
            $recipient->ValidateHash
        );

        $data = array(
            'FirstName' => $recipient->FirstName,
            'MemberInfoSection' => $emailableFields,
            'Email' => $recipient->Email,
            'MailingLists' => $mailinglists,
            'SubscriptionVerificationLink' => $verify,
            'HashText' => substr($recipient->ValidateHash, 0, 10)."******".substr($recipient->ValidateHash, -10),
            'SiteConfig' => SiteConfig::current_site_config(),
            'DaysExpired' => SubscriptionPage::config()->get('days_verification_link_alive'),
        );

        $this->sendEmailConfirmation($data);

        return $this->controller->redirect(
            $this->controller->Link(
                'submitted/'. $recipient->Hash
            )
        );
    }

    /**
     * Sends an email to the subscriber to confirm their emails
     *
     * @param array $data
     */
    protected function sendEmailConfirmation($data)
    {
        $email = Email::create();
        $email->setTo($data['Email']);

        $from = ($this->controller->NotificationEmailFrom)
            ? $this->controller->NotificationEmailFrom
            : Email::config()->get('admin_email');

        $email->setFrom($from);
        $email->setHTMLTemplate('SubscriptionVerificationEmail');
        $email->setSubject(
            _t(
                'Newsletter.VerifySubject',
                "Thanks for subscribing to our mailing lists, please verify your email"
            )
        );

        $email->setData(new ArrayData($data));
        $this->extend('updateEmailConfirmation', $email);

        try {
            $email->send();
        } catch (Exception $e) {
            Injector::inst()->create(LoggerInterface::class)->error($e);
        }
    }
}
