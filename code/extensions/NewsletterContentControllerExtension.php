<?php
/**
 * @package  newsletter
 * Adds functions to the ContentController, functions that can be accessed on any page. For example,
 * the global unsubscribe form.
 */

class NewsletterContentControllerExtension extends Extension
{

    /**
     * Utility method to get the unsubscribe form
     */
    public static function getUnsubscribeFormObject($self, $fields = null, $actions = null)
    {
        if (!$fields) {
            $fields = FieldList::create();
        }
        if (!$actions) {
            $actions = FieldList::create();
        }
        return new Form($self, 'unsubscribeLink', $fields, $actions);
    }


    public function UnsubscribeRequestForm()
    {
        $fields = new FieldList(
            EmailField::create('email', _t("Newsletter.UnsubscribeEmail", "Your subscription email address"))
        );

        $actions = new FieldList(
            FormAction::create('sendLink',  _t('Newsletter.SendUnsubscribeLink', 'Send unsubscribe link'))
                ->addExtraClass('ss-ui-action-constructive'),
            Object::create('ResetFormAction', 'clear', _t('CMSMain_left.ss.RESET', 'Reset'))
        );

        $unsubscribeController = new UnsubscribeController();

        $form = NewsletterContentControllerExtension::getUnsubscribeFormObject($this, $fields, $actions);
        $form->setFormMethod('GET');
        $form->setFormAction(Controller::join_links(
                    Director::absoluteBaseURL(),
                    $unsubscribeController->relativeLink('sendUnsubscribeLink')
                ));
        $form->addExtraClass('cms-search-form');

        return $form;
    }
}
