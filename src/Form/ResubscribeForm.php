<?php

namespace SilverStripe\Newsletter\Form;

use SilverStripe\Forms\Form;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\HiddenField;
use SilverStripe\Forms\LiteralField;
use SilverStripe\Forms\FormAction;
use SilverStripe\Control\Director;
use SilverStripe\Control\Controller;
use SilverStripe\Forms\RequiredFields;
use SilverStripe\Newsletter\Model\Recipient;

class ResubscribeForm extends Form
{
    /**
     * @param string $controller
     * @param string $name
     */
    public function __construct($controller, $name)
    {
        $fields = new FieldList(
            new HiddenField("UnsubscribeRecordIDs"),
            new HiddenField("Hash"),
            new LiteralField(
                "ResubscribeText",
                _t('Newsletter.ResubscribeText', 'Click the "Resubscribe" if you unsubscribed by accident and want to re-subscribe')
            )
        );

        $actions = new FieldList(
            new FormAction("doResubscribe", _t('Newsletter.ResubscribeButton', 'Resubscribe'))
        );

        parent::__construct($controller, $name, $fields, $actions);
    }


    /**
     * Re-subscribe the user from the given lists.
     *
     * @param array
     * @param ResubscribeForm
     */
    public function doResubscribe($data, $form)
    {
        if (isset($data['Hash']) && isset($data['UnsubscribeRecordIDs'])) {
            $recipient = Recipient::get()->filter('ValidateHash', $data['Hash'])->first();

            $mailinglists = $this->controller->getMailingListsByUnsubscribeRecords(
                $data['UnsubscribeRecordIDs']
            );

            if ($recipient && $recipient->exists() && $mailinglists && $mailinglists->count()) {
                $recipient->MailingLIsts()->addMany($mailinglists);
            }

            return Controller::curr()->redirect(
                Controller::join_links(
                    $this->controller->Link('undone'),
                    $data['Hash'],
                    $data['UnsubscribeRecordIDs']
                )
            );
        } else {
            $form->sessionMessage('This resubscribe link is invalid');

            return $this->redirectBack();
        }
    }
}
