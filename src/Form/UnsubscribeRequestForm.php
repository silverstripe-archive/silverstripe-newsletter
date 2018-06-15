<?php

namespace SilverStripe\Newsletter\Form;

use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\EmailField;
use SilverStripe\Forms\Form;

class UnsubscribeRequestForm extends Form
{
    public function __construct($controller, $name)
    {
        $fields = new FieldList(
            EmailField::create('Email', _t("Newsletter.UnsubscribeEmail", "Your subscription email address"))
        );

        $actions = new FieldList(
            FormAction::create('SendLink',
                _t('Newsletter.SendUnsubscribeLink', 'Send unsubscribe link')
            )->addExtraClass('ss-ui-action-constructive')
        );

        $unsubscribeController = UnsubscribeController::create();

        $required = new RequiredFields('email');

        parent::__construct($controller, $name, $fields, $actions, $required);

        $this->setFormMethod('GET');
        $this->setFormAction(Controller::join_links(
                    Director::absoluteBaseURL(),
                    $unsubscribeController->relativeLink('sendUnsubscribeLink')
                ));
        $this->addExtraClass('cms-search-form');
    }
}
