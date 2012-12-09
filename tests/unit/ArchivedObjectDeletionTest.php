<?php

class ArchivedObjectDeletionTest extends SapphireTest{
	static $fixture_file = "newsletter/tests/unit/Base.yml";
	function testRecipientDeletion() {
		$archived = $this->objFromFixture('Recipient','archived');
		$archivedID = $archived->ID;

		//check mailing lists in general
		$mailingLists = $archived->MailingLists();
		$this->assertEquals($mailingLists->count(), 2, "Recipient 'archived' belongs two mailing lists");

		//check a spicific mailing list 
		$mlall = $this->objFromFixture('MailingList','mlall');
		$this->assertDOSContains(array(array("Email"=>"archived@silverstripe.com")), $mlall->Recipients(),
			"The mailing list 'mlall' contains Recipient 'archived'");

		// check queued item
		$sendRecipientQueue = $archived->SendRecipientQueue();
		$this->assertEquals($sendRecipientQueue->count(), 2, "Recipient 'archived' has two queued items");

		//perform deletion
		$archived->delete();

		//after deletion, check mailing lists in general
		$mailingLists = DataList::create("MailingList")
			->leftJoin("MailingList_Recipients", "\"ML_R\".\"RecipientID\" = $archivedID", "ML_R")
			->filter("RecipientID", $archivedID);
		$this->assertEquals($mailingLists->count(), 0, "Recipient 'archived' is removed from any mailing lists");

		//check a specific mailing list
		$this->assertEquals($mlall->Recipients()->filter("Email", "archived@silverstripe.com")->count(),
			0, "The mailing list 'mlall' doesn't contain Recipient 'archived'");

		//check queued item
		$sendRecipientqueue = DataList::create("SendRecipientQueue")->filter('RecipientID', $archivedID);
		$this->assertEquals($sendRecipientQueue->count(), 0,
			"queued items are removed due to the removal of Recipient 'archived'");
	}

	function testNewsletterDeletion() {
		$archived = $this->objFromFixture('Newsletter','archived');
		$archivedID = $archived->ID;

		//check mailing lists in general
		$mailingLists = $archived->MailingLists();
		$this->assertEquals($mailingLists->count(), 2, "Newsletter 'archived' has two mailing lists associated");

		//check a spicific mailing list 
		$mlall = $this->objFromFixture('MailingList','mlall');
		$this->assertDOSContains(array(array("Subject"=>"Archived")), $mlall->Newsletters(),
			"The mailing list 'mlall' is associated with Newsletter 'archived'");

		// check queued item
		$sendRecipientQueue = $archived->SendRecipientQueue();
		$this->assertEquals($sendRecipientQueue->count(), 2, "Newsletter 'archived' has two queued items");

		// check tracked links
		$links = $archived->TrackedLinks();
		$this->assertEquals($links->count(), 2, "Newsletter 'archived' has two tracked links");


		//perform deletion
		$archived->delete();

		//after deletion, check mailing lists in general
		$mailingLists = DataList::create("MailingList")
			->leftJoin("Newsletter_MailingLists", "\"N_ML\".\"NewsletterID\" = $archivedID", "N_ML")
			->filter("NewsletterID", $archivedID);
		$this->assertEquals($mailingLists->count(), 0, "no mailing list is associated with Newsletter 'archived'");

		//check a specific mailing list
		$this->assertEquals($mlall->Newsletters()->filter("Subject", "Archived")->count(),
			0, "The mailing list 'mlall' doesn't associated with Newsletter 'archived'");

		//check queued item
		$sendRecipientqueue = DataList::create("SendRecipientQueue")->filter('NewsletterID', $archivedID);
		$this->assertEquals($sendRecipientQueue->count(), 0,
			"queued items are removed due to the removal of Newsletter 'archived'");

		$links = DataList::create("Newsletter_TrackedLink")->filter('NewsletterID', $archivedID);
		$this->assertEquals($links->count(), 0,
			"tracked links are removed due to the removal of Newsletter 'archived'");		
	}
}