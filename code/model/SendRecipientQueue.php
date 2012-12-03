<?php
/**
 * Database record for recipients that have had the newsletter sent to them, or are about to have a newsletter sent.
 *
 * @package newsletter
 */
class SendRecipientQueue extends DataObject {
	/**
	 *	Status has 4 possible values: "Sent", (mail() returned TRUE), "Failed" (mail() returned FALSE),
	 * 	"Bounced" ({@see $email_bouncehandler}), or "BlackListed" (sending to is disabled).
	 */
	static $db = array(
		"Priority" => "Int(50)",
		"Status" => "Enum('Scheduled, InProcess, Sent, Failed, Bounced, BlackListed', 'Scheduled')",
		"RetryCount" => "Int(0)"    //number of times this email got "stuck" in the queue
	);
	static $has_one = array(
		"Newsletter" => "Newsletter",
		"Recipient" => "Recipient"
	);

	static $field_labels = array(
		"Status" => 'Status',
		"Recipient.Email" => 'Email',
		"RetryCount" => 'Retry Count',
		"Priority" => 'Priority'
	);

	static $summary_fields = array(
		"Status",
		"Recipient.Email" => 'Recipient.Email',
		"RetryCount",
		"Priority"
	);

	static $default_sort = array(
		'LastEdited DESC'
	);

	/** Send the email out to the Recipient */
	public function send($newsletter = null, $recipient = null) {
		if (empty($newsletter)) $newsletter = $this->Newsletter();
		if (empty($recipient)) $recipient = $this->Recipient();

		if (empty($recipient->Blacklisted)) {
			$email = new Email(
				$newsletter->SendFrom,
				$recipient->Email,
				$newsletter->Subject,
				$newsletter->Content
			);
			if (!empty($newsletter->ReplyTo)) $email->addCustomHeader('Reply-To', $newsletter->ReplyTo);

			$success = $email->send();

			if ($success) {
				$this->Status = 'Sent';
				$recipient->ReceivedCount = $recipient->ReceivedCount + 1;
			} else {
				$this->Status = 'Failed';
				$recipient->BouncedCount = $recipient->BouncedCount + 1;
			}
			$recipient->write();
		} else {
			$this->Status = 'BlackListed';
		}

		$this->write();
	}

}
