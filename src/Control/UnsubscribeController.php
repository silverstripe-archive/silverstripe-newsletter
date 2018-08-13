<?php

namespace SilverStripe\Newsletter\Control;

use PageController;
use SilverStripe\Newsletter\Model\Recipient;
use SilverStripe\SiteConfig\SiteConfig;
use SilverStripe\View\Requirements;
use SilverStripe\ORM\ArrayList;
use SilverStripe\ORM\FieldType\DBField;
use SilverStripe\Core\Convert;
use SilverStripe\Newsletter\Model\UnsubscribeRecord;
use SilverStripe\Newsletter\Model\MailingList;
use SilverStripe\Control\Director;
use SilverStripe\Newsletter\Form\ResubscribeForm;
use SilverStripe\Newsletter\Extensions\NewsletterContentControllerExtension;

class UnsubscribeController extends PageController
{
    private static $days_unsubscribe_link_alive = 30;

    private static $allowed_actions = [
        'index',
        'done',
        'undone',
        'resubscribe',
        'Form',
        'ResubscribeForm',
        'UnsubscribeRequestForm'
    ];

    public function init()
    {
        parent::init();

        Requirements::css('silverstripe/newsletter:client/css/SubscriptionPage.css');
    }

    /**
     * @param string $action
     *
     * @return string
     */
    public function RelativeLink($action = null)
    {
        return "unsubscribe/$action";
    }

    /**
     * @param string $action
     *
     * @return string
     */
    public function Link($action = null)
    {
        return "unsubscribe/$action";
    }

    /**
     * @return Recipient
     */
    protected function getRecipient()
    {
        $validateHash = Convert::raw2sql($this->urlParams['ValidateHash']);

        if ($validateHash) {
            $recipient = Recipient::get()->filter("ValidateHash", $validateHash)->first();
            $now = date('Y-m-d H:i:s');

            if ($recipient) {
                if ($now <= $recipient->ValidateHashExpired) {
                    return $recipient;
                }
            }
        }
    }

    /**
     * @param Recipient $recipient
     *
     * @return SS_List
     */
    protected function getMailingLists($recipient = null)
    {
        $siteConfig = SiteConfig::current_site_config();

        if ($siteConfig->GlobalUnsubscribe) {
            return $recipient->MailingLists();
        } else {
            $mailinglistIDs = $this->urlParams['IDs'];

            if ($mailinglistIDs) {
                $mailinglistIDs = explode(',', $mailinglistIDs);

                return MailingList::get()->filter(
                    [
                    'ID' => $mailinglistIDs
                    ]
                );
            }
        }

        return new ArrayList();
    }

    public function getMailingListsByUnsubscribeRecords($recordIDs)
    {
        $recordIDs = explode(',', $recordIDs);
        $unsubscribeRecords = UnsubscribeRecord::get()
            ->filter(array('ID' => $recordIDs));

        $mailinglists = new ArrayList();

        if ($unsubscribeRecords->count()) {
            foreach ($unsubscribeRecords as $record) {
                $list = MailingList::get()->byId($record->MailingListID);

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
            $unsubscribeRecordIDs = [];

            $this->unsubscribeFromLists(
                $recipient,
                $mailinglists,
                $unsubscribeRecordIDs
            );

            return $this->redirect(static::join_links(
                Director::absoluteBaseURL(),
                $this->RelativeLink('done'),
                $recipient->ValidateHash,
                implode(",", $unsubscribeRecordIDs)
            ), 302);
        } else {
            return $this->customise([
                'Title' => _t('Newsletter.INVALIDLINK', 'Invalid Link'),
                'Content' => _t('Newsletter.INVALIDUNSUBSCRIBECONTENT', 'This unsubscribe link is invalid')
            ]);
        }
    }

    /**
     * @return ResubscribeForm
     */
    public function ResubscribeForm()
    {
        return ResubscribeForm::create($this, __FUNCTION__);
    }

    /**
     *
     */
    public function done()
    {
        $unsubscribeRecordIDs = $this->urlParams['IDs'];
        $hash = $this->urlParams['ID'];
        $content = '';

        if ($unsubscribeRecordIDs) {
            $mailinglists = $this->getMailingListsByUnsubscribeRecords(
                $unsubscribeRecordIDs
            );

            if ($mailinglists && $mailinglists->count()) {
                $listTitles = "";

                foreach ($mailinglists as $list) {
                    $listTitles .= "<li>".$list->Title."</li>";
                }

                $recipient = $this->getRecipient();
                $title = $recipient->FirstName?$recipient->FirstName:$recipient->Email;
                $content = sprintf(
                    _t(
                        'Newsletter.UNSUBSCRIBEFROMLISTSSUCCESS',
                        '<h3>Thank you, %s.</h3><br />You will no longer receive: %s.'
                    ),
                    $title,
                    "<ul>".$listTitles."</ul>"
                );
            } else {
                $content =
                    _t('Newsletter.UNSUBSCRIBESUCCESS', 'Thank you.<br />You have been unsubscribed successfully');
            }
        }

        $form = $this->ResubscribeForm();
        $form->loadDataFrom($this->request->postVars());

        return $this->customise([
            'Title' => _t('Newsletter.UNSUBSCRIBEDTITLE', 'Unsubscribed'),
            'Content' => DBField::create_field('HTMLText', $content),
            'Form' => $form
        ]);
    }

    /**
     *
     */
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
                _t(
                    'Newsletter.RESUBSCRIBEFROMLISTSSUCCESS',
                    '<h3>Thank you. %s!</h3><br />You have been resubscribed to: %s.'
                ),
                $title,
                "<ul>".$listTitles."</ul>"
            );
        } else {
            $content =_t(
                'Newsletter.RESUBSCRIBESUCCESS',
                'Thank you.<br />You have been resubscribed successfully.'
            );
        }

        return $this->customise([
            'Title' => _t('Newsletter.RESUBSCRIBED', 'Resubscribed'),
            'Content' => DBField::create_field('HTMLText',$content),
        ]);
    }

    /**
     * @param Recipient $recipient
     * @param SS_List   $lists
     * @param array     $recordsIds
     */
    protected function unsubscribeFromLists($recipient, $lists, &$recordsIDs)
    {
        if ($lists && $lists->count()) {
            foreach ($lists as $list) {
                $recipient->Mailinglists()->remove($list);
                $unsubscribeRecord = UnsubscribeRecord::create();
                $unsubscribeRecord->unsubscribe($recipient, $list);
                $recordsIDs[] = $unsubscribeRecord->ID;

                $this->extend('onUnsubscribeFromLists', $recipient, $lists);
            }
        }
    }

    /**
     * @param Recipient $recipient
     * @param array     $data
     */
    public function sendUnsubscribeEmail($recipient, $data)
    {
        $email = Email::create();
        $email->setTo($recipient->Email);
        $email->setTemplate('UnsubscribeLinkEmail');
        $email->setSubject(_t(
            'Newsletter.ConfirmUnsubscribeSubject',
            'Confirmation of your unsubscribe request'
        ));

        $email->populateTemplate($data);

        $this->extend('updateUnsubscribeEmail', $email);

        $email->send();
    }
}
