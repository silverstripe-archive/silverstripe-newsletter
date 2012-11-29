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

	static $newsletterCache = null;

	/** Send the email out to the Recipient */
	public function send() {
		if (empty($newsletterCache) || $this->NewsletterID != self::$newsletterCache) {
			self::$newsletterCache = $this->Newsletter();
		}
		$n = self::$newsletterCache;

		$email = new Email(
			$n->SendFrom,
			$this->Recipient()->Email,
			$n->Subject,
			$n->Content
		);
		if (!empty($n->ReplyTo)) $email->addCustomHeader('Reply-To', $n->ReplyTo);

		$email->send();
	}


}
