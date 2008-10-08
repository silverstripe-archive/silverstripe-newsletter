<?php

/**
 * Punjabi (India) language pack
 * @package modules: newsletter
 * @subpackage i18n
 */

i18n::include_locale_file('modules: newsletter', 'en_US');

global $lang;

if(array_key_exists('pa_IN', $lang) && is_array($lang['pa_IN'])) {
	$lang['pa_IN'] = array_merge($lang['en_US'], $lang['pa_IN']);
} else {
	$lang['pa_IN'] = $lang['en_US'];
}

$lang['pa_IN']['LeftAndMain']['NEWSLETTERS'] = 'ਅਖ਼ਬਾਰਾਂ';
$lang['pa_IN']['NewsletterAdmin']['FROMEM'] = 'ਈਮੇਲ ਪਤੇ ਤੋ  ';
$lang['pa_IN']['NewsletterAdmin']['MEWDRAFTMEWSL'] = 'ਨਵਾਂ ਕੱਚਾ ਖ਼ਬਰ-ਅੰਕ';
$lang['pa_IN']['NewsletterAdmin']['NEWLIST'] = 'New mailing list';
$lang['pa_IN']['NewsletterAdmin']['NEWNEWSLTYPE'] = 'ਨਵੀ ਖ਼ਬਰ-ਅੰਕ ਦੀ ਿਕਸਮ ';
$lang['pa_IN']['NewsletterAdmin']['NEWSLTYPE'] = 'ਖ਼ਬਰ-ਅੰਕ	ਦੀ ਿਕਸਮ ';
$lang['pa_IN']['NewsletterAdmin']['PLEASEENTERMAIL'] = 'ਿਕ੍ਰਪਾ ਕਰਕੇ ਇੱਕ ਈਮੇਲ ਪਤਾ ਪਾਉ';
$lang['pa_IN']['NewsletterAdmin']['RESEND'] = 'ਦੁਬਾਰਾ ਭੇਜੋ   ';
$lang['pa_IN']['NewsletterAdmin']['SAVE'] = 'ਬਚਾਓ';
$lang['pa_IN']['NewsletterAdmin']['SAVED'] = 'ਬਚਾਇਆ';
$lang['pa_IN']['NewsletterAdmin']['SEND'] = 'ਭੇਜੋ ...
';
$lang['pa_IN']['NewsletterAdmin']['SENDING'] = 'ਭੇਜ ਰਹੇ ਈਮੇਲ...';
$lang['pa_IN']['NewsletterAdmin']['SENTTESTTO'] = 'Sent test to';
$lang['pa_IN']['NewsletterAdmin']['SHOWCONTENTS'] = 'ਸਮਾਨ ਿਦਖਾਓ';
$lang['pa_IN']['NewsletterAdmin_BouncedList.ss']['EMADD'] = 'ਈਮੇਲ ਪਤਾ';
$lang['pa_IN']['NewsletterAdmin_BouncedList.ss']['HAVEBOUNCED'] = 'Emails that have bounced';
$lang['pa_IN']['NewsletterAdmin_BouncedList.ss']['NOBOUNCED'] = 'No emails sent have bounced.';
$lang['pa_IN']['NewsletterAdmin_BouncedList.ss']['UNAME'] = 'User name';
$lang['pa_IN']['NewsletterAdmin_left.ss']['ADDDRAFT'] = 'ਨਵਾਂ draft ਜੋੜ ੋ ';
$lang['pa_IN']['NewsletterAdmin_left.ss']['ADDTYPE'] = 'ਨਵੀ ਿਕਸਮ ਜੋੜ ੋ ';
$lang['pa_IN']['NewsletterAdmin_left.ss']['CREATE'] = 'ਬਣਾਉ';
$lang['pa_IN']['NewsletterAdmin_left.ss']['DEL'] = 'ਕੱਟੋਂ';
$lang['pa_IN']['NewsletterAdmin_left.ss']['DELETEDRAFTS'] = 'ਚੁਣੇ ਹੋਏ ਡਰਾਫਟ ਕੱਟੋਂ';
$lang['pa_IN']['NewsletterAdmin_left.ss']['GO'] = 'ਈਮੇਲ';
$lang['pa_IN']['NewsletterAdmin_left.ss']['NEWSLETTERS'] = 'ਅਖ਼ਬਾਰਾਂ';
$lang['pa_IN']['NewsletterAdmin_left.ss']['SELECTDRAFTS'] = 'Select the drafts that you want to delete and then click the button below';
$lang['pa_IN']['NewsletterAdmin_right.ss']['CANCEL'] = 'ਰੱਦ';
$lang['pa_IN']['NewsletterAdmin_right.ss']['ENTIRE'] = 'Send to the entire mailing list';
$lang['pa_IN']['NewsletterAdmin_right.ss']['ONLYNOT'] = 'Send to only people not previously sent to';
$lang['pa_IN']['NewsletterAdmin_right.ss']['SEND'] = 'Send newsletter';
$lang['pa_IN']['NewsletterAdmin_right.ss']['SENDTEST'] = 'Send test to';
$lang['pa_IN']['NewsletterAdmin_right.ss']['WELCOME1'] = 'ਜੀ ਆਇਆਂ ਨੂੰ';
$lang['pa_IN']['NewsletterAdmin_right.ss']['WELCOME2'] = 'ਖ਼ਬਰਾਂ ਬੰਦੋਬਸਤ ਭਾਗ।  ਿਕ੍ਰਪਾ ਕਰਕੇ ਖੱਬੇਉ ਇਕ ਫੋਲਡਰ ਚੁਣੋ।';
$lang['pa_IN']['NewsletterAdmin_SiteTree.ss']['DRAFTS'] = 'Drafts';
$lang['pa_IN']['NewsletterAdmin_SiteTree.ss']['MAILLIST'] = 'ਮੇਿਲੰਗ ਸੂਚੀ	';
$lang['pa_IN']['NewsletterAdmin_SiteTree.ss']['SENT'] = 'Sent Items';
$lang['pa_IN']['NewsletterAdmin_UnsubscribedList.ss']['NOUNSUB'] = 'No users have unsubscribed from this newsletter.';
$lang['pa_IN']['NewsletterAdmin_UnsubscribedList.ss']['UNAME'] = 'User name';
$lang['pa_IN']['NewsletterAdmin_UnsubscribedList.ss']['UNSUBON'] = 'Unsubscribed on';
$lang['pa_IN']['NewsletterList.ss']['CHOOSEDRAFT1'] = 'ਿਕ੍ਰਪਾ ਕਰਕੇ ਖੱਬੇਓ ਇੱਕ draft ਚੁਣੋ  ';
$lang['pa_IN']['NewsletterList.ss']['CHOOSEDRAFT2'] = 'add one';
$lang['pa_IN']['NewsletterList.ss']['CHOOSESENT'] = 'ਿਕ੍ਰਪਾ ਕਰਕੇ ਖੱਬੇਓ ਇੱਕ sent item ਚੁਣੋ  ';
$lang['pa_IN']['Newsletter_RecipientImportField.ss']['CHANGED'] = 'Number of details changed:';
$lang['pa_IN']['Newsletter_RecipientImportField.ss']['IMPORTED'] = 'New members imported:';
$lang['pa_IN']['Newsletter_RecipientImportField.ss']['IMPORTNEW'] = 'Imported new members';
$lang['pa_IN']['Newsletter_RecipientImportField.ss']['SEC'] = 'ਸਿਕ ੰਟ';
$lang['pa_IN']['Newsletter_RecipientImportField.ss']['SKIPPED'] = 'Records skipped:';
$lang['pa_IN']['Newsletter_RecipientImportField.ss']['TIME'] = 'Time taken:';
$lang['pa_IN']['Newsletter_RecipientImportField.ss']['UPDATED'] = 'Members updated:';
$lang['pa_IN']['Newsletter_RecipientImportField_Table.ss']['CONTENTSOF'] = 'Contents of';
$lang['pa_IN']['Newsletter_RecipientImportField_Table.ss']['NO'] = 'ਰੱਦ';
$lang['pa_IN']['Newsletter_RecipientImportField_Table.ss']['RECIMPORTED'] = 'Recipients imported from';
$lang['pa_IN']['Newsletter_RecipientImportField_Table.ss']['YES'] = 'Confirm';
$lang['pa_IN']['Newsletter_SentStatusReport.ss']['DATE'] = 'Date';
$lang['pa_IN']['Newsletter_SentStatusReport.ss']['EMAIL'] = 'ਇਮੇਲ';
$lang['pa_IN']['Newsletter_SentStatusReport.ss']['FN'] = 'ਪਹਿਲਾ ਨਾਮ';
$lang['pa_IN']['Newsletter_SentStatusReport.ss']['NEWSNEVERSENT'] = 'The Newsletter has Never Been Sent to Following Subscribers';
$lang['pa_IN']['Newsletter_SentStatusReport.ss']['RES'] = 'Result';
$lang['pa_IN']['Newsletter_SentStatusReport.ss']['SENDBOUNCED'] = 'Sending to the Following Recipients Bounced';
$lang['pa_IN']['Newsletter_SentStatusReport.ss']['SENDFAIL'] = 'Sending to the Following Recipients Failed';
$lang['pa_IN']['Newsletter_SentStatusReport.ss']['SENTOK'] = 'Sending to the Following Recipients was Successful';
$lang['pa_IN']['Newsletter_SentStatusReport.ss']['SN'] = 'ਗੋਤ';

?>