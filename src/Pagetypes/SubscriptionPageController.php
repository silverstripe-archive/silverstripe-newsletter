<?php

namespace SilverStripe\Newsletter\Pagetypes;

use PageController;
use SilverStripe\Newsletter\Form\SubscriptionForm;
use SilverStripe\Newsletter\Model\UnsubscribeRecord;

class SubscriptionPageController extends PageController
{
    private static $allowed_actions = [
        'index',
        'subscribeverify',
        'submitted',
        'completed',
        'Form'
    ];

    /**
     * @return SubscriptionForm
     */
    public function Form()
    {
        if ($this->URLParams['Action'] === 'completed' || $this->URLParams['Action'] == 'submitted') {
            return;
        }

        $form = SubscriptionForm::create($this, __FUNCTION__);

        return $form;
    }

    /**
     *  Unsubscribes a $member from $newsletterType
     *
     * @param Member
     *
     * @return bool
     */
    protected function removeUnsubscribe($member)
    {
        $result = UnsubscribeRecord::get()->filter(
            [
            'MemberID' => $member->ID
            ]
        );

        if ($result && $result->exists()) {
            $result->delete();

            return true;
        }

        return false;
    }

    public function submitted()
    {
        if ($id = $this->urlParams['ID']) {
            $recipientData = Recipient::get()->byId($id)->toMap();
        }

        $daysExpired = SubscriptionPage::config()->get('days_verification_link_alive');
        $recipientData['SubscritionSubmittedContent2'] =
            sprintf(
                _t(
                    'Newsletter.SubscritionSubmittedContent2',
                    'The verification link will be valid for %s days. If you did not mean to subscribe, '
                    . 'simply ignore the verification email'
                ),
                $daysExpired
            );

        return $this->customise([
            'Title' => _t('Newsletter.SubscriptionSubmitted', 'Subscription submitted!'),
            'Content' => $this->customise($recipientData)->renderWith('Includes/SubscriptionSubmitted'),
        ])->renderWith('Page');
    }

    public function subscribeverify()
    {
        if ($hash = $this->urlParams['ID']) {
            $recipient = Recipient::get()->filter(
                [
                "ValidateHash" => $hash
                ]
            );

            if ($recipient && $recipient->exists()) {
                $now = date('Y-m-d H:i:s');
                if ($now <= $recipient->ValidateHashExpired) {
                    $recipient->Verified = true;

                    // extends the ValidateHashExpired so the a unsubscirbe link will stay alive in that peroid by law
                    $days = UnsubscribeController::config()->get('days_unsubscribe_link_alive');
                    $recipient->ValidateHashExpired = date('Y-m-d H:i:s', time() + (86400 * $days));

                    $recipient->write();
                    $mailingLists = $recipient->MailingLists();
                    $ids = implode(",", $mailingLists->getIDList());
                    $templateData = array(
                        'FirstName' => $recipient->FirstName,
                        'MailingLists' => $mailingLists,
                        'UnsubscribeLink' =>
                            Director::BaseURL(). "unsubscribe/index/".$recipient->ValidateHash."/".$ids,
                        'HashText' => $recipient->getHashText(),
                        'SiteConfig' => $this->SiteConfig(),
                    );
                    //send notification email
                    if ($this->SendNotification) {
                        $email = Email::create();
                        $email->setTo($recipient->Email);
                        $from = $this->NotificationEmailFrom?$this->NotificationEmailFrom:Email::config()->get('send_all_emails_from');
                        $email->setFrom($from);
                        $email->setTemplate('SubscriptionConfirmationEmail');
                        $email->setSubject(
                            _t(
                                'Newsletter.ConfirmSubject',
                                "Confirmation of your subscription to our mailing lists"
                            )
                        );

                        $email->populateTemplate($templateData);
                        $email->send();
                    }

                    $url = $this->Link('completed')."/".$recipient->ID;
                    $this->redirect($url);
                }
            }
            if ($recipient && $recipient->exists()) {
                $recipientData = $recipient->toMap();
            } else {
                $recipientData = array();
            }

            $daysExpired = SubscriptionPage::get_days_verification_link_alive();
            $recipientData['VerificationExpiredContent1'] =
                sprintf(
                    _t(
                        'Newsletter.VerificationExpiredContent1',
                        'The verification link is only validate for %s days.'
                    ),
                    $daysExpired
                );

            return $this->customise(
                array(
                'Title' => _t(
                    'Newsletter.VerificationExpired',
                    'The verification link has been expired'
                ),
                'Content' => $this->customise($recipientData)->renderWith('VerificationExpired'),
                )
            )->renderWith('Page');
        }
    }

    public function completed()
    {
        if ($id = $this->urlParams['ID']) {
            $recipientData = Recipient::get()->byId($id)->toMap();
        }

        return $this->customise(
            [
            'Title' => _t('Newsletter.SubscriptionCompleted', 'Subscription Completed!'),
            'Content' => $this->customise($recipientData)
                ->renderWith('SubscriptionCompleted'),
            ]
        );
    }
}
