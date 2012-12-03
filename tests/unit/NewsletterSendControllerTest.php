<?php

class NewsletterSendControllerTest extends SapphireTest {

	static $fixture_file = "newsletter/tests/unit/Base.yml";

	/** Test sending of all newsletters */
	function testEnqueue(){
		$newsletters = array();
		$newsletter[] = $this->objFromFixture('Newsletter','daily');
		$newsletter[] = $this->objFromFixture('Newsletter','monthly');
		$newsletter[] = $this->objFromFixture('Newsletter','all');

		$stuck1 = $this->objFromFixture('Recipient','stuck1');
		$stuck2 = $this->objFromFixture('Recipient','stuck2');

		foreach($newsletters as $newsletter) {
			$nsc = NewsletterSendController::inst();
			$nsc->enqueue($newsletter);
			$nsc->processQueue($newsletter->ID);

			foreach($newsletter->MailingLists()->Recipients() as $r) {
				$this->assertEmailSent($r->Email, $newsletter->SendFrom, $newsletter->Subject);
			}

			//check the email is sent out to the stalled item
			if ($nsc->Subject == "Monthly Newsletter") {
				$this->assertEmailSent($stuck1->Email, $newsletter->SendFrom, $newsletter->Subject);
				$this->assertFalse($this->findEmail($stuck2->Email, $newsletter->SendFrom, $newsletter->Subject),
					'Email to stuck2 was NOT sent, as expected because the retry count was too high');
			}
		}

	}
}