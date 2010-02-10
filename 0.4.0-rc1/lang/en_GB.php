<?php

/**
 * English (United Kingdom) language pack
 * @package modules: newsletter
 * @subpackage i18n
 */

i18n::include_locale_file('modules: newsletter', 'en_US');

global $lang;

if(array_key_exists('en_GB', $lang) && is_array($lang['en_GB'])) {
	$lang['en_GB'] = array_merge($lang['en_US'], $lang['en_GB']);
} else {
	$lang['en_GB'] = $lang['en_US'];
}

$lang['en_GB']['LeftAndMain']['NEWSLETTERS'] = 'Newsletters';
$lang['en_GB']['NewsletterAdmin']['FROMEM'] = 'From email address';
$lang['en_GB']['NewsletterAdmin']['MEWDRAFTMEWSL'] = 'New draft newsletter';
$lang['en_GB']['NewsletterAdmin']['NEWLIST'] = 'New mailing list';
$lang['en_GB']['NewsletterAdmin']['NEWNEWSLTYPE'] = 'New newsletter type';
$lang['en_GB']['NewsletterAdmin']['NEWSLTYPE'] = 'Newsletter Type';
$lang['en_GB']['NewsletterAdmin']['PLEASEENTERMAIL'] = 'Please enter an email address';
$lang['en_GB']['NewsletterAdmin']['RESEND'] = 'Resend';
$lang['en_GB']['NewsletterAdmin']['SAVE'] = 'Save';
$lang['en_GB']['NewsletterAdmin']['SAVED'] = 'Saved';
$lang['en_GB']['NewsletterAdmin']['SEND'] = 'Send...';
$lang['en_GB']['NewsletterAdmin']['SENDING'] = 'Sending emails...';
$lang['en_GB']['NewsletterAdmin']['SENTTESTTO'] = 'Sent test to ';
$lang['en_GB']['NewsletterAdmin']['SHOWCONTENTS'] = 'Show contents';
$lang['en_GB']['NewsletterAdmin_BouncedList.ss']['EMADD'] = 'Email address';
$lang['en_GB']['NewsletterAdmin_BouncedList.ss']['HAVEBOUNCED'] = 'Emails that have bounced';
$lang['en_GB']['NewsletterAdmin_BouncedList.ss']['NOBOUNCED'] = 'No emails sent have bounced.';
$lang['en_GB']['NewsletterAdmin_BouncedList.ss']['UNAME'] = 'User name';
$lang['en_GB']['NewsletterAdmin_left.ss']['ADDDRAFT'] = 'Add new draft';
$lang['en_GB']['NewsletterAdmin_left.ss']['ADDTYPE'] = 'Add new type';
$lang['en_GB']['NewsletterAdmin_left.ss']['CREATE'] = 'Create';
$lang['en_GB']['NewsletterAdmin_left.ss']['DEL'] = 'Delete';
$lang['en_GB']['NewsletterAdmin_left.ss']['DELETEDRAFTS'] = 'Delete the selected drafts';
$lang['en_GB']['NewsletterAdmin_left.ss']['GO'] = 'Go';
$lang['en_GB']['NewsletterAdmin_left.ss']['NEWSLETTERS'] = 'Newsletters';
$lang['en_GB']['NewsletterAdmin_left.ss']['SELECTDRAFTS'] = 'Select the drafts that you want to delete and then click the button below';
$lang['en_GB']['NewsletterAdmin_right.ss']['CANCEL'] = 'Cancel';
$lang['en_GB']['NewsletterAdmin_right.ss']['ENTIRE'] = 'Send to the entire mailing list';
$lang['en_GB']['NewsletterAdmin_right.ss']['ONLYNOT'] = 'Send to only people not previously sent to';
$lang['en_GB']['NewsletterAdmin_right.ss']['SEND'] = 'Send newsletter';
$lang['en_GB']['NewsletterAdmin_right.ss']['SENDTEST'] = 'Send test to';
$lang['en_GB']['NewsletterAdmin_right.ss']['WELCOME1'] = 'Welcome to the';
$lang['en_GB']['NewsletterAdmin_right.ss']['WELCOME2'] = 'newsletter administration section. Please choose a folder from the left.';
$lang['en_GB']['NewsletterAdmin_SiteTree.ss']['DRAFTS'] = 'Drafts';
$lang['en_GB']['NewsletterAdmin_SiteTree.ss']['MAILLIST'] = 'Mailing List';
$lang['en_GB']['NewsletterAdmin_SiteTree.ss']['SENT'] = 'Sent Items';
$lang['en_GB']['NewsletterAdmin_UnsubscribedList.ss']['NOUNSUB'] = 'No users have unsubscribed from this newsletter.';
$lang['en_GB']['NewsletterAdmin_UnsubscribedList.ss']['UNAME'] = 'User name';
$lang['en_GB']['NewsletterAdmin_UnsubscribedList.ss']['UNSUBON'] = 'Unsubscribed on';
$lang['en_GB']['NewsletterList.ss']['CHOOSEDRAFT1'] = 'Please choose a draft on the left, or';
$lang['en_GB']['NewsletterList.ss']['CHOOSEDRAFT2'] = 'add one';
$lang['en_GB']['NewsletterList.ss']['CHOOSESENT'] = 'Please choose a sent item on the left.';
$lang['en_GB']['Newsletter_RecipientImportField.ss']['CHANGED'] = 'Number of details changed:';
$lang['en_GB']['Newsletter_RecipientImportField.ss']['IMPORTED'] = 'New members imported:';
$lang['en_GB']['Newsletter_RecipientImportField.ss']['IMPORTNEW'] = 'Imported new members';
$lang['en_GB']['Newsletter_RecipientImportField.ss']['SEC'] = 'seconds';
$lang['en_GB']['Newsletter_RecipientImportField.ss']['SKIPPED'] = 'Records skipped:';
$lang['en_GB']['Newsletter_RecipientImportField.ss']['TIME'] = 'Time taken:';
$lang['en_GB']['Newsletter_RecipientImportField.ss']['UPDATED'] = 'Members updated:';
$lang['en_GB']['Newsletter_RecipientImportField_Table.ss']['CONTENTSOF'] = 'Contents of';
$lang['en_GB']['Newsletter_RecipientImportField_Table.ss']['NO'] = 'Cancel';
$lang['en_GB']['Newsletter_RecipientImportField_Table.ss']['RECIMPORTED'] = 'Recipients imported from';
$lang['en_GB']['Newsletter_RecipientImportField_Table.ss']['YES'] = 'Confirm';
$lang['en_GB']['Newsletter_SentStatusReport.ss']['DATE'] = 'Date';
$lang['en_GB']['Newsletter_SentStatusReport.ss']['EMAIL'] = 'Email';
$lang['en_GB']['Newsletter_SentStatusReport.ss']['FN'] = 'Firstname';
$lang['en_GB']['Newsletter_SentStatusReport.ss']['NEWSNEVERSENT'] = 'The Newsletter has Never Been Sent to Following Subscribers';
$lang['en_GB']['Newsletter_SentStatusReport.ss']['RES'] = 'Result';
$lang['en_GB']['Newsletter_SentStatusReport.ss']['SENDBOUNCED'] = 'Sending to the Following Recipients Bounced';
$lang['en_GB']['Newsletter_SentStatusReport.ss']['SENDFAIL'] = 'Sending to the Following Recipients Failed';
$lang['en_GB']['Newsletter_SentStatusReport.ss']['SENTOK'] = 'Sending to the Following Recipients was Successful';
$lang['en_GB']['Newsletter_SentStatusReport.ss']['SN'] = 'Surname';

?>