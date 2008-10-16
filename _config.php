<?php
/**
 * URL rules for the CMS module
 * 
 * @package cms
 */
Director::addRules(50, array(
	'admin/newsletter/$Action/$ID' => 'NewsletterAdmin',
	'unsubscribe/$Email/$MailingList' => 'Unsubscribe_Controller'
));

LeftAndMain::add_menu_item(
	"newsletter", 
	_t('LeftAndMain.NEWSLETTERS',"Newsletters",PR_HIGH,"Menu title"),
	"admin/newsletter/", 
	"NewsletterAdmin"
);

DataObject::add_extension('Member', 'NewsletterRole');

?>