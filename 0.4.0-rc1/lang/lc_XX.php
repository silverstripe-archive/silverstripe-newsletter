<?php

/**
 * LOLCAT language pack
 * @package modules: newsletter
 * @subpackage i18n
 */

i18n::include_locale_file('modules: newsletter', 'en_US');

global $lang;

if(array_key_exists('lc_XX', $lang) && is_array($lang['lc_XX'])) {
	$lang['lc_XX'] = array_merge($lang['en_US'], $lang['lc_XX']);
} else {
	$lang['lc_XX'] = $lang['en_US'];
}

$lang['lc_XX']['LeftAndMain']['NEWSLETTERS'] = 'NEWSLETTERZ';
$lang['lc_XX']['NewsletterAdmin']['FROMEM'] = 'FRUM EMAIL ADDRES';
$lang['lc_XX']['NewsletterAdmin']['MEWDRAFTMEWSL'] = 'NEW DRAFT NEWSLETTERZ';
$lang['lc_XX']['NewsletterAdmin']['NEWLIST'] = 'NEW MAILING LISTZ';
$lang['lc_XX']['NewsletterAdmin']['NEWNEWSLTYPE'] = 'NEW NEWSLETTRZ TYPE';
$lang['lc_XX']['NewsletterAdmin']['NEWSLTYPE'] = 'NEWSLETTR TYPE';
$lang['lc_XX']['NewsletterAdmin']['PLEASEENTERMAIL'] = 'PLEEZ ENTR AN EMAIL ADDRESZ CUD U PLEEZ';
$lang['lc_XX']['NewsletterAdmin']['RESEND'] = 'RESEND';
$lang['lc_XX']['NewsletterAdmin']['SAVE'] = 'SAYV';
$lang['lc_XX']['NewsletterAdmin']['SAVED'] = 'SAVD';
$lang['lc_XX']['NewsletterAdmin']['SEND'] = 'SEND...';
$lang['lc_XX']['NewsletterAdmin']['SENDING'] = 'SENDIN EMAILS...';
$lang['lc_XX']['NewsletterAdmin']['SENTTESTTO'] = 'I R SENT TEST 2';
$lang['lc_XX']['NewsletterAdmin']['SHOWCONTENTS'] = 'SHOW CONTENTS. KTHX.';
$lang['lc_XX']['NewsletterAdmin_BouncedList.ss']['EMADD'] = 'EMAIL ADDRESZ';
$lang['lc_XX']['NewsletterAdmin_BouncedList.ss']['HAVEBOUNCED'] = 'EMAILS DAT HAS BOUNCD';
$lang['lc_XX']['NewsletterAdmin_BouncedList.ss']['NOBOUNCED'] = 'NO EMAILS SENT HAS BOUNCD.';
$lang['lc_XX']['NewsletterAdmin_BouncedList.ss']['UNAME'] = 'USR NAYM';
$lang['lc_XX']['NewsletterAdmin_left.ss']['ADDDRAFT'] = 'ADD NEW DRAFT';
$lang['lc_XX']['NewsletterAdmin_left.ss']['ADDTYPE'] = 'ADD NEW TYPE';
$lang['lc_XX']['NewsletterAdmin_left.ss']['CREATE'] = 'CREATE';
$lang['lc_XX']['NewsletterAdmin_left.ss']['DEL'] = 'DELETE';
$lang['lc_XX']['NewsletterAdmin_left.ss']['DELETEDRAFTS'] = 'DELETE TEH SELECTD DRAFTS';
$lang['lc_XX']['NewsletterAdmin_left.ss']['GO'] = 'GOGOGO111!!!1';
$lang['lc_XX']['NewsletterAdmin_left.ss']['NEWSLETTERS'] = 'NEWZLETTERZ';
$lang['lc_XX']['NewsletterAdmin_left.ss']['SELECTDRAFTS'] = 'SELECT TEH DRAFTS DAT U WANTS 2 DELETE AN DEN CLICK TEH BUTN BELOW';
$lang['lc_XX']['NewsletterAdmin_right.ss']['CANCEL'] = 'ABANDONZZZ';
$lang['lc_XX']['NewsletterAdmin_right.ss']['ENTIRE'] = 'SEND 2 TEH ENTIRE MAILIN LIST';
$lang['lc_XX']['NewsletterAdmin_right.ss']['ONLYNOT'] = 'SEND 2 ONLY PEEPS NOT PREVIOUSLY SENT 2';
$lang['lc_XX']['NewsletterAdmin_right.ss']['SEND'] = 'SEND NEWSLETTR';
$lang['lc_XX']['NewsletterAdmin_right.ss']['SENDTEST'] = 'SEND TEST 2';
$lang['lc_XX']['NewsletterAdmin_right.ss']['WELCOME1'] = 'WELCUM TO TEH';
$lang['lc_XX']['NewsletterAdmin_right.ss']['WELCOME2'] = 'NEWSLETTR ADMININISTRASHUN SECSHUN. PLEEZ CHOOSE FOLDR FROM TEH LEFT.';
$lang['lc_XX']['NewsletterAdmin_SiteTree.ss']['DRAFTS'] = 'DRAFTZ';
$lang['lc_XX']['NewsletterAdmin_SiteTree.ss']['MAILLIST'] = 'TEH MAILING LI5+';
$lang['lc_XX']['NewsletterAdmin_SiteTree.ss']['SENT'] = 'SENT ITEMZ';
$lang['lc_XX']['NewsletterAdmin_UnsubscribedList.ss']['NOUNSUB'] = 'NO USRZ HAS UNSUBSCRIBD FRUM DIS NEWSLETTR.';
$lang['lc_XX']['NewsletterAdmin_UnsubscribedList.ss']['UNAME'] = 'USR NAYM';
$lang['lc_XX']['NewsletterAdmin_UnsubscribedList.ss']['UNSUBON'] = 'UNSUBSCRIBD ON';
$lang['lc_XX']['NewsletterList.ss']['CHOOSEDRAFT1'] = 'PLZ CHOOSE DRAFT ON TEH LEFT, OR';
$lang['lc_XX']['NewsletterList.ss']['CHOOSEDRAFT2'] = 'ADD 1';
$lang['lc_XX']['NewsletterList.ss']['CHOOSESENT'] = 'PLZ CHOOSE SENT ITEM ON TEH LEFT.';
$lang['lc_XX']['Newsletter_RecipientImportField.ss']['CHANGED'] = 'NUMBR OV DETAILS CHANGD:';
$lang['lc_XX']['Newsletter_RecipientImportField.ss']['IMPORTED'] = 'NEW MEMBERS IMPORTD:';
$lang['lc_XX']['Newsletter_RecipientImportField.ss']['IMPORTNEW'] = 'IMPORTED NEW MEMBERZ, K?';
$lang['lc_XX']['Newsletter_RecipientImportField.ss']['SEC'] = 'SECUNDZ';
$lang['lc_XX']['Newsletter_RecipientImportField.ss']['SKIPPED'] = 'RECORDS SKIPPD';
$lang['lc_XX']['Newsletter_RecipientImportField.ss']['TIME'] = 'TIEM TAKEN:';
$lang['lc_XX']['Newsletter_RecipientImportField.ss']['UPDATED'] = 'MEMBERS UPDATD:';
$lang['lc_XX']['Newsletter_RecipientImportField_Table.ss']['CONTENTSOF'] = 'CONTENTZ OV';
$lang['lc_XX']['Newsletter_RecipientImportField_Table.ss']['NO'] = 'ABANDONZ';
$lang['lc_XX']['Newsletter_RecipientImportField_Table.ss']['RECIMPORTED'] = 'RECIPIENTS IMPORTD FRUM';
$lang['lc_XX']['Newsletter_RecipientImportField_Table.ss']['YES'] = 'K!';
$lang['lc_XX']['Newsletter_SentStatusReport.ss']['DATE'] = 'DATE';
$lang['lc_XX']['Newsletter_SentStatusReport.ss']['EMAIL'] = 'EMAIL';
$lang['lc_XX']['Newsletter_SentStatusReport.ss']['FN'] = 'FURST NAYM';
$lang['lc_XX']['Newsletter_SentStatusReport.ss']['NEWSNEVERSENT'] = 'TEH NEWSLETTR IZ NEVR BEEN SENT TO TEH FOLLOWIN SUBSCRIBERZ';
$lang['lc_XX']['Newsletter_SentStatusReport.ss']['RES'] = 'REZULTZ';
$lang['lc_XX']['Newsletter_SentStatusReport.ss']['SENDBOUNCED'] = 'SENDIN 2 TEH FOLLOWIN RECIPIENTS BOUNCD';
$lang['lc_XX']['Newsletter_SentStatusReport.ss']['SENDFAIL'] = 'SENDIN 2 TEH FOLLOWIN RECIPIENTS FAILD';
$lang['lc_XX']['Newsletter_SentStatusReport.ss']['SENTOK'] = 'SENDIN 2 TEH FOLLOWIN RECIPIENTS WUZ SUCCESFUL';
$lang['lc_XX']['Newsletter_SentStatusReport.ss']['SN'] = 'SHURNAYM';

?>