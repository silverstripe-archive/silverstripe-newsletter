<?php

class NewsletterNavigatorTest extends SapphireTest {
	static $fixture_file = "newsletter/tests/unit/Base.yml";
	public function testGetItem() {
		$newsletter = $this->objFromFixture('Newsletter', 'daily');
		$navigator = new SilverStripeNavigator($newsletter);
		
		$items = $navigator->getItems();
		$classes = array_map('get_class', $items->toArray());
		$this->assertContains('SilverStripeNavigatorItem_Newsletter', $classes,
			'newsleter navigator item picked up'
		);
	}


	public function testCanView() {
		$newsletter = $this->objFromFixture('Newsletter', 'daily');
		//$admin = $this->objFromFixture('Member', 'admin');
		//$newsletteradmin = $this->objFromFixture('Member', 'newsletteradmin');
		$navigator = new SilverStripeNavigator($newsletter);
		
		// TODO Shouldn't be necessary but SapphireTest logs in as ADMIN by default
		$this->logInWithPermission('CMS_ACCESS_NewsletterAdmin');
		$items = $navigator->getItems();
		$classes = array_map('get_class', $items->toArray());
		$this->assertNotContains('SilverStripeNavigatorTest_ProtectedNewsletterItem', $classes);
		$this->assertContains('SilverStripeNavigatorItem_Newsletter', $classes);
	}
}

class SilverStripeNavigatorTest_ProtectedNewsletterItem extends SilverStripeNavigatorItem_Newsletter implements TestOnly {
	public function canView($member = null) {
		if(!$member) $member = Member::currentUser();
		return Permission::checkMember($member, 'ADMIN');
	}
}