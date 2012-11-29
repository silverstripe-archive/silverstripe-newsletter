<?php
class NewsletterSendController extends Controller {

	static $itemsToBatchProcess = 50;   //number of emails to send out in "batches" to avoid spin up costs
	static $stuckTimeout = 10;  //minutes after which we consider an "InProcess" item in the queue "stuck"
	static $retryLimit = 5; //number of times to retry sending email that get "stuck"

	/**
	 * Adds users to the queue for sending out a newsletter.
	 * Processed all users that are CURRENTLY in the mailing lists associated with this MailingList and adds them
	 * to the queue.
	 * @static
	 * @param $id The ID of the Newsletter DataObject to send
	 */
	static function enqueue(Newsletter $newsletter) {
		$lists = $newsletter->MailingLists();
		$queueCount = 0;
		foreach($lists as $list) {
			foreach($list->Recipients() as $recipient) {
				$queueItem = SendRecipientQueue::create();
				$queueItem->NewsletterID = $list->ID;
				$queueItem->Recipient = $recipient->ID;
				$queueItem->write();
				$queueCount++;
			}
		}

		return $queueCount;
	}

	static function processQueueOnShutdown(Newsletter $newsletter = null) {
		if (class_exists('MessageQueue')) {
			if (!empty($newsletter) && !empty($newsletter->ID)) {
				//start processing of email sending for this newsletter ID after shutdown
				MessageQueue::send("newsletter", new MethodInvocationMessage(get_class(), "processQueue", $newsletter->ID));
			}

			MessageQueue::consume_on_shutdown();
		} else {
			//do the sending in real-time, if there is not MessageQueue to do it out-of-process
			self::processQueue($newsletter->ID);
		}
	}

	/**
	 * Restart the processing of any queue items that are "stuck" in the InProcess status, but haven't been sent.
	 * We treat
	 * @static
	 */
	static function cleanUpStalledQueue($newsletterID) {
		$stuckQueueItems = SendRecipientQueue::get()->filter(array(
			'NewsletterID' => $newsletterID,
			'Status' => 'InProcess',
			'LastEdited:LessThan' => date('Y-m-d H:i:m',strtotime('-'.self::$stuckTimeout.' minutes'))
		));

		$stuckCount = $stuckQueueItems->Count();
		if ($stuckCount  > 0) {
			foreach($stuckQueueItems as $item){
				if ($item->RetryCount < self::$retryLimit) {
					$item->RetryCount = $item->RetryCount + 1;
					$item->Status = "Scheduled";    //retry the item
					$item->write();
				} else {    //enough retries, stop this email and mark it as failed
					$item->Status = "Failed";
					$item->write();
				}
			}
		}

		return $stuckCount;
	}

	static function processQueue($newsletterID){
		if (!empty($newsletterID)) {
			$newsletter = Newsletter::get()->byID($newsletterID);
			if (!empty($newsletter)) {
				//try to clean up any stuck items
				self::cleanUpStalledQueue($newsletterID);

				// Start a transaction, or if we are in MySQL, create a lock on the SendRecipientQueue table.
				$conn = DB::getConn();
				if ($conn instanceof MySQLDatabase) $conn->query('lock table SendRecipientQueue write');
				else if (method_exists($conn, 'startTransaction')) $conn->startTransaction();

				$queueItems = null;
				try {
					//get the first X items to process
					$queueItems = SendRecipientQueue::get()
							->filter(array('NewsletterID' => $newsletterID, 'Status' => 'Scheduled'))
							->sort('Created ASC')
							->filter(self::$itemsToBatchProcess);

					//set them all to "in process" at once
					foreach($queueItems as $item){
						$item->Status = 'InProcess';
						$item->write();
					}

					// Commit transaction, or in MySQL just release the lock
					if ($conn instanceof MySQLDatabase) $res = $conn->query('unlock tables');
					else if (method_exists($conn, 'endTransaction')) $conn->endTransaction();
				} catch (Exception $e) {
					// Rollback, or in MySQL just release the lock
					if ($conn instanceof MySQLDatabase) $res = $conn->query('unlock tables');
					else if (method_exists($conn, 'transactionRollback')) $conn->transactionRollback();

					//retry the processing
					self::processQueueOnShutdown($newsletterID);
				}

				//do the actual mail out
				if (!empty($queueItems) && $queueItems->Count() > 0) {
					foreach($queueItems as $item) {
						$item->send();
					}

					//do more processing, in case there are more items to process, do nothing if we've reached the end
					self::processQueueOnShutdown($newsletterID);
				} else {
					//mark the send process as complete
					$newsletter->SentDate = SS_Datetime::now()->getValue();
					$newsletter->Status = 'Sent';
					$newsletter->write();
				}
			}
		}
	}

}