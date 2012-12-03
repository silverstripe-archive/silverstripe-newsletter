<?php
class SilverStripeNavigatorItem_Newsletter extends SilverStripeNavigatorItem {
	static $priority = 5;	
	
	public function canView($member = null) {
		return Permission::checkMember($member, "CMS_ACCESS_NewsletterAdmin");
	}

}