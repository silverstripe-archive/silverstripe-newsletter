<?php

/**
 * Page type for creating a page that contains a form that visitors can
 * use to subscript to mailing lists.
 *
 * @package newsletter
 */

class SubscriptionPage extends Page
{

    private static $db = array(
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
    );

    private static $defaults = array(
        'Fields' => 'Email',
        'SubmissionButtonText' => 'Submit'
    );

    private static $singular_name = 'Newsletter Subscription Page';

    private static $plural_name = 'Newsletter Subscription Pages';

    public static $days_verification_link_alive = 2;

    public static function set_days_verification_link_alive($days)
    {
        self::$days_verification_link_alive = $days;
    }

    public static function get_days_verification_link_alive()
    {
        return self::$days_verification_link_alive;
    }

    public function requireDefaultRecords()
    {
        parent::requireDefaultRecords();

        if (!SubscriptionPage::get()->Count()) {
            $page = new SubscriptionPage();
            $page->Title = 'Newsletter Subscription';
            $page->URLSegment = 'newsletter-subscription';
            $page->SendNotification = 1;
            $page->ShowInMenus = false;
            $page->write();
            $page->publish('Stage', 'Live');
        }
    }

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields ->addFieldToTab("Root",
            $subscriptionTab = new Tab(
                _t('Newsletter.SUBSCRIPTIONFORM', 'SubscriptionForm')
            )
        );
        Requirements::javascript('newsletter/javascript/SubscriptionPage.js');
        Requirements::css('newsletter/css/SubscriptionPage.css');


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
        $frontFields = singleton('Recipient')->getFrontEndFields()->dataFields();

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
        new CheckboxSetField("MailingLists",
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
                    singleton('NewsletterAdmin')->Link()
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
     * Email field is the member's identifier, and newsletters subscription is non-sense if no email is given
     * by the user, we should force that email to be checked and required.
     */
    public function getRequired()
    {
        return (!$this->getField('Required')) ? '{"Email":"1"}' : $this->getField('Required');
    }
}

/**
 * @package newsletter
 */
class SubscriptionPage_Controller extends Page_Controller
{

    private static $allowed_actions = array(
        'index',
        'subscribeverify',
        'submitted',
        'completed',
        'Form'
    );

    /**
     * Load all the custom jquery needed to run the custom
     * validation
     */
    public function init()
    {
        parent::init();


        // block prototype validation
        //Validator::set_javascript_validation_handler('none');
        Requirements::css('newsletter/css/SubscriptionPage.css');
        // load the jquery
        Requirements::javascript(THIRDPARTY_DIR . '/jquery/jquery.js');
        Requirements::javascript(THIRDPARTY_DIR . '/jquery-validate/jquery.validate.min.js');
    }

    public function Form()
    {
        if ($this->URLParams['Action'] === 'completed' || $this->URLParams['Action'] == 'submitted') {
            return;
        }
        $dataFields = singleton('Recipient')->getFrontEndFields()->dataFields();

        if ($this->CustomLabel) {
            $customLabel = Convert::json2array($this->CustomLabel);
        }

        $fields = array();
        if ($this->Fields) {
            $fields = explode(",", $this->Fields);
        }

        $recipientInfoSection = new CompositeField();

        $requiredFields = Convert::json2array($this->Required);
        if (!empty($fields)) {
            foreach ($fields as $field) {
                if (isset($dataFields[$field]) && $dataFields[$field]) {
                    if (is_a($dataFields[$field], "ImageField")) {
                        if (isset($requiredFields[$field])) {
                            $title = $dataFields[$field]->Title()." * ";
                        } else {
                            $title = $dataFields[$field]->Title();
                        }
                        $dataFields[$field] = new SimpleImageField(
                            $dataFields[$field]->Name(), $title
                        );
                    } else {
                        if (isset($requiredFields[$field])) {
                            if (isset($customLabel[$field])) {
                                $title = $customLabel[$field]." * ";
                            } else {
                                $title = $dataFields[$field]->Title(). " * ";
                            }
                        } else {
                            if (isset($customLabel[$field])) {
                                $title = $customLabel[$field];
                            } else {
                                $title = $dataFields[$field]->Title();
                            }
                        }
                        $dataFields[$field]->setTitle($title);
                    }
                    $recipientInfoSection->push($dataFields[$field]);
                }
            }
        }
        $formFields = new FieldList(
            new HeaderField("CustomisedHeading", $this->owner->CustomisedHeading),
            $recipientInfoSection
        );
        $recipientInfoSection->setID("MemberInfoSection");

        if ($this->MailingLists) {
            $mailinglists = DataObject::get("MailingList", "ID IN (".$this->MailingLists.")");
        }

        if (isset($mailinglists) && $mailinglists && $mailinglists->count()>1) {
            $newsletterSection = new CompositeField(
                new LabelField("Newsletters", _t("SubscriptionPage.To", "Subscribe to:"), 4),
                new CheckboxSetField("NewsletterSelection", "", $mailinglists, $mailinglists->getIDList())
            );
            $formFields->push($newsletterSection);
        }

        $buttonTitle = $this->SubmissionButtonText;
        $actions = new FieldList(
            new FormAction('doSubscribe', $buttonTitle)
        );

        if (!empty($requiredFields)) {
            $required = new RequiredFields(array_keys(array_filter($requiredFields)));
        } else {
            $required = null;
        }
        $form = new Form($this, "Form", $formFields, $actions, $required);

        // using jQuery to customise the validation of the form
        $FormName = $form->FormName();
        $validationMessage = Convert::json2array($this->ValidationMessage);

        if (!empty($requiredFields)) {
            $jsonRuleArray = array();
            $jsonMessageArray = array();
            foreach ($requiredFields as $field => $true) {
                if ($true) {
                    if (isset($validationMessage[$field]) && $validationMessage[$field]) {
                        $error = $validationMessage[$field];
                    } else {
                        $label=isset($customLabel[$field])?$customLabel[$field]:$dataFields[$field]->Title();
                        $error = sprintf(
                            _t('Newsletter.PleaseEnter', "Please enter your %s field"),
                            $label
                        );
                    }

                    if ($field === 'Email') {
                        $jsonRuleArray[] = $field.":{required: true, email: true}";
                        $message = <<<JSON
{
required: "<span class='exclamation'></span><span class='validation-bubble'>
$error<span></span></span>",
email: "<span class='exclamation'></span><span class='validation-bubble'>
Please enter a valid email address<span></span></span>"
}
JSON;
                        $jsonMessageArray[] = $field.":$message";
                    } else {
                        $jsonRuleArray[] = $field.":{required: true}";
                        $message = <<<HTML
<span class='exclamation'></span><span class='validation-bubble'>$error<span></span></span>
HTML;
                        $jsonMessageArray[] = $field.":\"$message\"";
                    }
                }
            }
            $rules = "{".implode(", ", $jsonRuleArray)."}";
            $messages = "{".implode(",", $jsonMessageArray)."}";
        } else {
            $rules = "{Email:{required: true, email: true}}";
            $emailAddrMsg = _t('Newsletter.ValidEmail', 'Please enter your email address');
            $messages = <<<JS
{Email: {
required: "<span class='exclamation'></span><span class='validation-bubble'>
$emailAddrMsg<span></span></span>",
email: "<span class='exclamation'></span><span class='validation-bubble'>
$emailAddrMsg<span></span></span>"
}}
JS;
        }

        // set the custom script for this form
        Requirements::customScript(<<<JS
(function($) {
	jQuery(document).ready(function() {
		$("#$FormName").validate({
			errorPlacement: function(error, element) {
				error.insertAfter(element);
			},
			focusCleanup: true,
			messages: $messages,
			rules: $rules
		});
	});
})(jQuery);
JS
        );

        return $form;
    }

    /**
     *  unsubscribes a $member from $newsletterType
     *
     */
    protected function removeUnsubscribe($newletterType, $member)
    {
        //TODO NewsletterType deprecated
        //TODO UnsubscribeRecord deprecated
        $result = DataObject::get_one("UnsubscribeRecord", "NewsletterTypeID = ".
                Convert::raw2sql($newletterType->ID)." AND MemberID = ".Convert::raw2sql($member->ID)."");
        if ($result && $result->exists()) {
            $result->delete();
        }
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
        if (!isset($data['Email'])) {
            $form->addErrorMessage('Email', _t('Newsletter.ValidEmail', 'Please enter your email address'), 'error');
            return $this->redirectBack();
        } elseif (!Email::is_valid_address($data['Email'])) {
            $form->addErrorMessage('Email', _t('Newsletter.InvalidEmailAddress', '"{field}" field is invalid', array('field' => 'Email')), 'error');
            return $this->redirectBack();
        }

        // check to see if member already exists
        $recipient = Recipient::get()->find('Email', $data['Email']);

        if (!$recipient) {
            $recipient = new Recipient();
            $recipient->Verified = false;   //set new recipient as un-verified, if they subscribe through the website
        }

        $form->saveInto($recipient);
        $recipient->write();

        $days = self::get_days_verification_link_alive();
        if ($recipient->ValidateHash) {
            $recipient->ValidateHashExpired = date('Y-m-d H:i:s', time() + (86400 * $days));   //extend the expiry date
            //default 2 days for validating
            $recipient->write();
        } else {
            $recipient->generateValidateHashAndStore($days); //default 2 days for validating
        }

        $mailinglists = new ArrayList();

        if (isset($data["NewsletterSelection"])) {
            foreach ($data["NewsletterSelection"] as $listID) {
                $mailinglist = DataObject::get_by_id("MailingList", $listID);

                if ($mailinglist && $mailinglist->exists()) {
                    //remove recipient from unsubscribe if needed
                    //$this->removeUnsubscribe($newsletterType,$recipient);

                    $mailinglists->push($mailinglist);
                    $recipient->MailingLists()->add($mailinglist);
                }
            }
        } else {
            // if the page has associate with one newsletter type, it won't appear in front form, but the
            // recipient needs to be added to the related mailling list.

            if ($this->MailingLists && ($listIDs = explode(",", $this->MailingLists))) {
                foreach ($listIDs as $listID) {
                    $mailinglist = DataObject::get_by_id("MailingList", $listID);
                    if ($mailinglist && $mailinglist->exists()) {
                        //remove recipient from unsubscribe records if the recipient
                        // unsubscribed from mailing list before
                        //$this->removeUnsubscribe($mailingList,$recipient);
                        $mailinglists->push($mailinglist);
                        $recipient->MailingLists()->add($mailinglist);
                    }
                }
            } else {
                user_error('No Newsletter type selected to subscribe to', E_USER_WARNING);
            }
        }

        $recipientInfoSection = $form->Fields()->fieldByName('MemberInfoSection')->FieldList();
        $emailableFields = new FieldList();
        if ($recipientInfoSection) {
            foreach ($recipientInfoSection as $field) {
                if (is_array($field->Value()) && is_a($field, 'SimpleImageField')) {
                    $funcName = $field->Name();
                    $value = $recipient->$funcName()->CMSThumbnail()->Tag();
                    $field->EmailalbeValue = $value;
                } else {
                    $field->EmailalbeValue = $field->Value();
                }

                $emailableFields->push($field);
            }
        }
        $templateData = array(
            'FirstName' => $recipient->FirstName,
            'MemberInfoSection' => $emailableFields,
            'MailingLists' => $mailinglists,
            'SubscriptionVerificationLink' =>
                Controller::join_links($this->Link('subscribeverify'), "/".$recipient->ValidateHash),
            'HashText' => substr($recipient->ValidateHash, 0, 10)."******".substr($recipient->ValidateHash, -10),
            'SiteConfig' => $this->SiteConfig(),
            'DaysExpired' => SubscriptionPage::get_days_verification_link_alive(),
        );

        //Send Verification Email
        $email = new Email();
        $email->setTo($recipient->Email);
        $from = $this->NotificationEmailFrom?$this->NotificationEmailFrom:Email::getAdminEmail();
        $email->setFrom($from);
        $email->setTemplate('SubscriptionVerificationEmail');
        $email->setSubject(_t(
            'Newsletter.VerifySubject',
            "Thanks for subscribing to our mailing lists, please verify your email"
        ));
        $email->populateTemplate($templateData);
        $email->send();

        $url = $this->Link('submitted')."/".$recipient->ID;
        $this->redirect($url);
    }

    public function submitted()
    {
        if ($id = $this->urlParams['ID']) {
            $recipientData = DataObject::get_by_id("Recipient", $id)->toMap();
        }

        $daysExpired = SubscriptionPage::get_days_verification_link_alive();
        $recipientData['SubscritionSubmittedContent2'] =
             sprintf(
                _t(
                    'Newsletter.SubscritionSubmittedContent2',
                    'The verification link will be valid for %s days. If you did not mean to subscribe, '
                    . 'simply ignore the verification email'
                ),
                $daysExpired
            );

        return $this->customise(array(
            'Title' => _t('Newsletter.SubscriptionSubmitted', 'Subscription submitted!'),
            'Content' => $this->customise($recipientData)->renderWith('SubscriptionSubmitted'),
        ))->renderWith('Page');
    }

    public function subscribeverify()
    {
        if ($hash = $this->urlParams['ID']) {
            $recipient = DataObject::get_one("Recipient", "\"ValidateHash\" = '".Convert::raw2sql($hash)."'");
            if ($recipient && $recipient->exists()) {
                $now = date('Y-m-d H:i:s');
                if ($now <= $recipient->ValidateHashExpired) {
                    $recipient->Verified = true;

                    // extends the ValidateHashExpired so the a unsubscirbe link will stay alive in that peroid by law
                    $days = UnsubscribeController::get_days_unsubscribe_link_alive();
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
                        $email = new Email();
                        $email->setTo($recipient->Email);
                        $from = $this->NotificationEmailFrom?$this->NotificationEmailFrom:Email::getAdminEmail();
                        $email->setFrom($from);
                        $email->setTemplate('SubscriptionConfirmationEmail');
                        $email->setSubject(_t(
                            'Newsletter.ConfirmSubject',
                            "Confirmation of your subscription to our mailing lists"
                        ));

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
                 sprintf(_t('Newsletter.VerificationExpiredContent1',
                    'The verification link is only validate for %s days.'), $daysExpired);

            return $this->customise(array(
                'Title' => _t(
                    'Newsletter.VerificationExpired',
                    'The verification link has been expired'
                ),
                'Content' => $this->customise($recipientData)->renderWith('VerificationExpired'),
            ))->renderWith('Page');
        }
    }

    public function completed()
    {
        if ($id = $this->urlParams['ID']) {
            $recipientData = DataObject::get_by_id("Recipient", $id)->toMap();
        }
        return $this->customise(array(
            'Title' => _t('Newsletter.SubscriptionCompleted', 'Subscription Completed!'),
            'Content' => $this->customise($recipientData)->renderWith('SubscriptionCompleted'),
        ))->renderWith('Page');
    }
}
