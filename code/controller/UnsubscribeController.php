<?php
/**
 * @package  newsletter
 */

/**
 * Create a form that a user can use to unsubscribe from a mailing list
 */
class UnsubscribeController extends Page_Controller
{

    public static $days_unsubscribe_link_alive = 30;

    private static $allowed_actions = array(
        'index',
        'done',
        'undone',
        'resubscribe',
        'Form',
        'ResubscribeForm',
        'sendUnsubscribeLink'
    );

    public function __construct($data = null)
    {
        parent::__construct($data);
    }

    public function init()
    {
        parent::init();
        Requirements::css('newsletter/css/SubscriptionPage.css');
        Requirements::javascript(THIRDPARTY_DIR . '/jquery/jquery.js');
        Requirements::javascript(THIRDPARTY_DIR . '/jquery-validate/jquery.validate.min.js');
    }

    public static function set_days_unsubscribe_link_alive($days)
    {
        self::$days_unsubscribe_link_alive = $days;
    }

    public static function get_days_unsubscribe_link_alive()
    {
        return self::$days_unsubscribe_link_alive;
    }

    public function RelativeLink($action = null)
    {
        return "unsubscribe/$action";
    }

    private function getRecipient()
    {
        $validateHash = Convert::raw2sql($this->urlParams['ValidateHash']);
        if ($validateHash) {
            $recipient = Recipient::get()->filter("ValidateHash", $validateHash)->first();
            $now = date('Y-m-d H:i:s');
            if ($now <= $recipient->ValidateHashExpired) {
                return $recipient;
            }
        }
    }

    private function getMailingLists($recipient = null)
    {
        $siteConfig = DataObject::get_one("SiteConfig");
        if ($siteConfig->GlobalUnsubscribe) {
            return $mailinglists = $recipient->MailingLists();
        } else {
            $mailinglistIDs = $this->urlParams['IDs'];
            if ($mailinglistIDs) {
                $mailinglistIDs = explode(',', $mailinglistIDs);
                return $mailinglists = DataList::create("MailingList")
                    ->filter(array('ID' => $mailinglistIDs));
            }
        }
    }

    private function getMailingListsByUnsubscribeRecords($recordIDs)
    {
        $recordIDs = explode(',', $recordIDs);
        $unsubscribeRecords = DataList::create("UnsubscribeRecord")
            ->filter(array('ID' => $recordIDs));
        $mailinglists = new ArrayList();
        if ($unsubscribeRecords->count()) {
            foreach ($unsubscribeRecords as $record) {
                $list = DataObject::get_by_id("MailingList", $record->MailingListID);
                if ($list && $list->exists()) {
                    $mailinglists->push($list);
                }
            }
        }
        return $mailinglists;
    }

    public function index()
    {
        $recipient = $this->getRecipient();
        $mailinglists = $this->getMailingLists($recipient);
        if ($recipient && $recipient->exists() && $mailinglists && $mailinglists->count()) {
            $unsubscribeRecordIDs = array();
            $this->unsubscribeFromLists($recipient, $mailinglists, $unsubscribeRecordIDs);
            $url = Director::absoluteBaseURL() . $this->RelativeLink('done') . "/" . $recipient->ValidateHash . "/" .
                    implode(",", $unsubscribeRecordIDs);
            Controller::curr()->redirect($url, 302);
            return $url;
        } else {
            return $this->customise(array(
                'Title' => _t('Newsletter.INVALIDLINK', 'Invalid Link'),
                'Content' => _t('Newsletter.INVALIDUNSUBSCRIBECONTENT', 'This unsubscribe link is invalid')
            ))->renderWith('Page');
        }
    }

    public function done()
    {
        $unsubscribeRecordIDs = $this->urlParams['IDs'];
        $hash = $this->urlParams['ID'];
        if ($unsubscribeRecordIDs) {
            $fields = new FieldList(
                new HiddenField("UnsubscribeRecordIDs", "", $unsubscribeRecordIDs),
                new HiddenField("Hash", "", $hash),
                new LiteralField("ResubscribeText",
                    _t('Newsletter.ResubscribeText', 'Click the "Resubscribe" if you unsubscribed by accident and want to re-subscribe'))
            );

            $actions = new FieldList(
                new FormAction("resubscribe", _t('Newsletter.ResubscribeButton', 'Resubscribe'))
            );

            $form = new Form($this, "ResubscribeForm", $fields, $actions);
            $form->setFormAction($this->Link('resubscribe'));
            $mailinglists = $this->getMailingListsByUnsubscribeRecords($unsubscribeRecordIDs);

            if ($mailinglists && $mailinglists->count()) {
                $listTitles = "";
                foreach ($mailinglists as $list) {
                    $listTitles .= "<li>".$list->Title."</li>";
                }
                $recipient = $this->getRecipient();
                $title = $recipient->FirstName?$recipient->FirstName:$recipient->Email;
                $content = sprintf(
                    _t('Newsletter.UNSUBSCRIBEFROMLISTSSUCCESS',
                        '<h3>Thank you, %s.</h3><br />You will no longer receive: %s.'),
                    $title,
                    "<ul>".$listTitles."</ul>"
                );
            } else {
                $content =
                    _t('Newsletter.UNSUBSCRIBESUCCESS', 'Thank you.<br />You have been unsubscribed successfully');
            }
        }

        return $this->customise(array(
            'Title' => _t('Newsletter.UNSUBSCRIBEDTITLE', 'Unsubscribed'),
            'Content' => $content,
            'Form' => $form
        ))->renderWith('Page');
    }

    /**
    * Unsubscribe the user from the given lists.
    */
    public function resubscribe()
    {
        if (isset($_POST['Hash']) && isset($_POST['UnsubscribeRecordIDs'])) {
            $recipient = DataObject::get_one(
                'Recipient',
                "\"ValidateHash\" = '" . Convert::raw2sql($_POST['Hash']) . "'"
            );
            $mailinglists = $this->getMailingListsByUnsubscribeRecords($_POST['UnsubscribeRecordIDs']);
            if ($recipient && $recipient->exists() && $mailinglists && $mailinglists->count()) {
                $recipient->MailingLIsts()->addMany($mailinglists);
            }
            $url = Director::absoluteBaseURL() . $this->RelativeLink('undone') . "/" . $_POST['Hash']. "/" .
                    $_POST['UnsubscribeRecordIDs'];
            Controller::curr()->redirect($url, 302);
            return $url;
        } else {
            return $this->customise(array(
                'Title' => _t('Newsletter.INVALIDRESUBSCRIBE', 'Invalid resubscrible'),
                'Content' => _t('Newsletter.INVALIDRESUBSCRIBECONTENT', 'This resubscribe link is invalid')
            ))->renderWith('Page');
        }
    }

    public function undone()
    {
        $recipient = $this->getRecipient();
        $mailinglists = $this->getMailingLists($recipient);

        if ($mailinglists && $mailinglists->count()) {
            $listTitles = "";
            foreach ($mailinglists as $list) {
                $listTitles .= "<li>".$list->Title."</li>";
            }

            $title = $recipient->FirstName?$recipient->FirstName:$recipient->Email;
            $content = sprintf(
                _t('Newsletter.RESUBSCRIBEFROMLISTSSUCCESS',
                    '<h3>Thank you. %s!</h3><br />You have been resubscribed to: %s.'),
                $title,
                "<ul>".$listTitles."</ul>"
            );
        } else {
            $content =_t(
                'Newsletter.RESUBSCRIBESUCCESS',
                'Thank you.<br />You have been resubscribed successfully.'
            );
        }

        return $this->customise(array(
            'Title' => _t('Newsletter.RESUBSCRIBED', 'Resubscribed'),
            'Content' => $content,
        ))->renderWith('Page');
    }

    protected function unsubscribeFromLists($recipient, $lists, &$recordsIDs)
    {
        if ($lists && $lists->count()) {
            foreach ($lists as $list) {
                $recipient->Mailinglists()->remove($list);
                $unsubscribeRecord = new UnsubscribeRecord();
                $unsubscribeRecord->unsubscribe($recipient, $list);
                $recordsIDs[] = $unsubscribeRecord->ID;
            }
        }
    }

    /** Send an email with a link to unsubscribe from all this user's newsletters */
    public function sendUnsubscribeLink(SS_HTTPRequest $request)
    {
        //get the form object (we just need its name to set the session message)
        $form = NewsletterContentControllerExtension::getUnsubscribeFormObject($this);

        $email = Convert::raw2sql($request->requestVar('email'));
        $recipient = Recipient::get()->filter('Email', $email)->First();

        if ($recipient) {
            //get the IDs of all the Mailing Lists this user is subscribed to
            $lists = $recipient->MailingLists()->column('ID');
            $listIDs = implode(',', $lists);

            $days = UnsubscribeController::get_days_unsubscribe_link_alive();
            if ($recipient->ValidateHash) {
                $recipient->ValidateHashExpired = date('Y-m-d H:i:s', time() + (86400 * $days));
                $recipient->write();
            } else {
                $recipient->generateValidateHashAndStore($days);
            }

            $templateData = array(
                'FirstName' => $recipient->FirstName,
                'UnsubscribeLink' =>
                    Director::absoluteBaseURL() . "unsubscribe/index/" . $recipient->ValidateHash . "/$listIDs"
            );
            //send unsubscribe link email
            $email = new Email();
            $email->setTo($recipient->Email);
            $from = Email::getAdminEmail();
            $email->setFrom($from);
            $email->setTemplate('UnsubscribeLinkEmail');
            $email->setSubject(_t(
                'Newsletter.ConfirmUnsubscribeSubject',
                'Confirmation of your unsubscribe request'
            ));
            $email->populateTemplate($templateData);
            $email->send();

            $form->sessionMessage(
                _t(
                    'Newsletter.GoodEmailMessage',
                    'You have been sent an email containing an unsubscribe link'
                ),
                'good'
            );
        } else {
            //not found Recipient, just reload the form
            $form->sessionMessage(_t('Newsletter.BadEmailMessage', 'Email address not found'), "bad");
        }

        Controller::curr()->redirectBack();
    }
}
