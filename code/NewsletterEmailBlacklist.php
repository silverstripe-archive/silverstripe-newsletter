<?php
/**
 * This class is responsible for ensuring that members who are on it receive NO email 
 * communication at all. any correspondance is caught before the email is sent.
 * @package sapphire
 * @subpackage email
 */
class NewsletterEmailBlacklist extends DataObject{
	static $db = array(
		'BlockedEmail' => 'Varchar',  
	);
	
	static $has_one = array(
		'Member' => 'Member'
	);
    
	/**
	 * Helper function to see if the email being
	 * sent has specifically been blocked.
	 */
	static function isBlocked($email) {
		$blockedEmails = DataObject::get("NewsletterEmailBlacklist")->toDropDownMap("ID","BlockedEmail");
		if($blockedEmails) {
			if(in_array($email, $blockedEmails)) {
				return true;
			}
		}
		
		return false;
	}
    
	/**
	 * Migrate data from Email_BlackList (the obsolete table)
	 * to NewsletterEmailBlacklist.
	 */
	function requireDefaultRecords() {
		parent::requireDefaultRecords();
		
		$exist = DB::query("SHOW TABLES LIKE 'Email_BlackList'")->numRecords();
		if($exist > 0) {
			DB::query("INSERT INTO `NewsletterEmailBlacklist` SELECT * FROM `Email_BlackList`");
			DB::query("RENAME TABLE `Email_BlackList` TO `_obsolete_Email_BlackList`");
			
			echo("<div style=\"padding:5px; color:white; background-color:blue;\">Data in Email_BlackList has been moved to the new NewsletterEmailBlacklist table. To drop the obsolete table, issue this SQL command: \"DROP TABLE '_obsolete_Email_BlackList'\".</div>");
		}
	}
	
}
?>