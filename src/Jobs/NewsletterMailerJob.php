<?php

namespace SilverStripe\Newsletter\Jobs;

use SilverStripe\Newsletter\Model\Newsletter;
use SilverStripe\Newsletter\Model\SendRecipientQueue;
use SilverStripe\Core\Injector\Injector;
use SilverStripe\Core\Environment;
use SilverStripe\Core\Config\Config;
use Psr\Log\LoggerInterface;
use Symbiote\QueuedJobs\Services\QueuedJob;
use Symbiote\QueuedJobs\Services\AbstractQueuedJob;

class NewsletterMailerJob extends AbstractQueuedJob
{
    private static $process_page_size = 10;

    /**
     * @param int $newsletterId
     */
    public function __construct($newsletterId = null)
    {
        parent::__construct();

        if ($newsletterId && ($newsletter = Newsletter::get()->byId($newsletterId))) {
            $this->setObject(
                $newsletter,
                'Newsletter'
            );
        }
    }

    /**
     * Sitemap job is going to run for a while...
     *
     * @return int
     */
    public function getJobType()
    {
        return QueuedJob::QUEUED;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return _t(__CLASS__ . '.MAILER', 'Newsletter Mailer');
    }

    /**
     * Return a signature for this queued job
     *
     * @return string
     */
    public function getSignature()
    {
        return md5(get_class($this) . $this->NewsletterID);
    }

    /**
     * This is run once per job, set ups the mailing queue.
     */
    public function setup()
    {
        parent::setup();

        Environment::increaseTimeLimitTo();
        Environment::increaseMemoryLimitTo();

        $newsletter = $this->getObject('Newsletter');

        if (!$newsletter) {
            $this->addMessage('Newsletter object missing', 'ERROR');
            $this->completeJob();

            return;
        }

        $lists = $newsletter->MailingLists();
        $queueCount = 0;

        foreach ($lists as $list) {
            foreach ($list->Recipients()->column('ID') as $recipientID) {
                $existingQueue = SendRecipientQueue::get()->filter(
                    [
                    'RecipientID' => $recipientID,
                    'NewsletterID' => $newsletter->ID
                    ]
                );

                if ($existingQueue->exists()) {
                    $queueCount++;

                    continue;
                }

                $queueItem = SendRecipientQueue::create();
                $queueItem->NewsletterID = $newsletter->ID;
                $queueItem->RecipientID = $recipientID;
                $queueItem->Status = 'Scheduled';
                $queueItem->write();
                $queueCount++;
            }
        }

        $this->currentStep = 0;
        $this->totalSteps = $queueCount * 2; // one to mark, one to send
        $this->isComplete = false;
    }

    public function process()
    {
        Environment::increaseTimeLimitTo();
        Environment::increaseMemoryLimitTo();

        $newsletter = $this->getObject('Newsletter');

        if (!$newsletter) {
            $this->completeJob();
            $this->addMessage('Newsletter object missing', 'ERROR');

            return true;
        }

        $remainingChildren = $newsletter->SendRecipientQueue()->filter('Status', 'Scheduled');

        $pageSize = Config::inst()->get(__CLASS__, 'process_page_size');

        // if there's no more, we're done!
        if (!$remainingChildren->exists()) {
            $this->completeJob();

            return true;
        }

        $records = $remainingChildren->limit($pageSize)->column('ID');
        $send = [];

        // mark all as in progress first.
        foreach ($records as $recordId) {
            $this->currentStep++;

            $record = SendRecipientQueue::get()->byId($recordId);

            if ($record) {
                $record->Status = 'InProgress';

                try {
                    $record->write();
                    $send[] = $recordId;
                } catch (Exception $e) {
                    $this->addMessage($e->getMessage(), 'ERROR');

                    Injector::inst()->get(LoggerInterface::class)
                        ->error($e->getMessage());
                }
            }
        }

        // send each of notices
        foreach ($send as $recordId) {
            $this->currentStep++;

            $record = SendRecipientQueue::get()->byId($recordId);

            if ($record) {
                try {
                    $record->send();
                } catch (Exception $e) {
                    $this->addMessage($e->getMessage(), 'ERROR');

                    Injector::inst()->get(LoggerInterface::class)
                        ->error($e->getMessage());
                }
            }
        }
    }

    /**
     * Marks the job as complete
     */
    protected function completeJob()
    {
        $this->isComplete = true;
        $this->currentStep = $this->totalSteps;

        $newsletter = $this->getObject('Newsletter');

        if ($newsletter) {
            $newsletter->Status = 'Sent';
            $newsletter->extend('onCompleteJob');
            $newsletter->write();
        }
    }
}
