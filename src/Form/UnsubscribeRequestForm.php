<?php

namespace SilverStripe\Newsletter\Form;

use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\EmailField;
use SilverStripe\Forms\Form;
use SilverStripe\Forms\FormAction;
use SilverStripe\Forms\RequiredFields;
use SilverStripe\Control\Controller;
use SilverStripe\Control\Director;
use SilverStripe\Control\Email\Email;
use SilverStripe\Core\Convert;
use SilverStripe\Newsletter\Model\Recipient;
use SilverStripe\Newsletter\Control\UnsubscribeController;

class UnsubscribeRequestForm extends Form
{
    public function __construct($controller, $name)
    {
        $fields = new FieldList(
            EmailField::create(
                'Email',
                _t("Newsletter.UnsubscribeEmail", "Your subscription email address")
            )
        );

        $actions = new FieldList(
            FormAction::create(
                'SendLink',
                _t('Newsletter.SendUnsubscribeLink', 'Send unsubscribe link')
            )->addExtraClass('ss-ui-action-constructive')
        );

        $unsubscribeController = UnsubscribeController::create();

        $required = new RequiredFields(
            [
            'Email'
            ]
        );

        parent::__construct($controller, $name, $fields, $actions, $required);

        $this->addExtraClass('cms-search-form');
    }

    /**
     *
     */
    public function SendLink($data, $form)
    {
        $email = Convert::raw2sql($data['Email']);
        $recipient = Recipient::get()->filter('Email', $email)->First();

        if ($recipient) {
            //get the IDs of all the Mailing Lists this user is subscribed to
            $lists = $recipient->MailingLists()->column('ID');
            $listIDs = implode(',', $lists);

            $days = $this->controller->config()->get('days_unsubscribe_link_alive');

            if ($recipient->ValidateHash) {
                $recipient->ValidateHashExpired = date('Y-m-d H:i:s', time() + (86400 * $days));
                $recipient->write();
            } else {
                $recipient->generateValidateHashAndStore($days);
            }

            $from = Email::config()->get('send_all_emails_from');

            $templateData = array(
                'Recipient' => $recipient,
                'From' => $from,
                'FirstName' => $recipient->FirstName,
                'UnsubscribeLink' => $this->controller->join_links(
                    Director::absoluteBaseURL(),
                    "unsubscribe/index/",
                    $recipient->ValidateHash,
                    $listIDs
                )
            );

            $this->sendUnsubscribeEmail($recipient, $templateData);

            $form->sessionMessage(
                _t(
                    'Newsletter.GoodEmailMessage',
                    'You have been sent an email containing an unsubscribe link'
                ),
                'good'
            );
        } else {
            // not found Recipient, just reload the form
            $form->sessionMessage(
                _t('Newsletter.BadEmailMessage', 'Email address not found'),
                "bad"
            );
        }

        return $this->controller->redirectBack();
    }
}
