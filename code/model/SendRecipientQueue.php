<?php
/**
 * Database record for recipients that have had the newsletter sent to them, or are about to have a newsletter sent.
 *
 * @package newsletter
 */
class SendRecipientQueue extends DataObject {
	/**
	 *	Result has 4 possible values: "Sent", (mail() returned TRUE), "Failed" (mail() returned FALSE),
	 * 	"Bounced" ({@see $email_bouncehandler}), or "BlackListed" (sending to is disabled).
	 */
	static $db = array(
		"Priority" => "Int",
		"Result" => "Enum('Scheduled, InProcess, Sent, Failed, Bounced, BlackListed', 'Scheduled')",
	);
	static $has_one = array(
		"Newsletter" => "Newsletter",
		"Recipient" => "Recipient"
	);

	/** Send the email out to the Recipient */
	public function send() {

	}


}
