<?php

/**
 * Sinhalese (Sri Lanka) language pack
 * @package modules: newsletter
 * @subpackage i18n
 */

i18n::include_locale_file('modules: newsletter', 'en_US');

global $lang;

if(array_key_exists('si_LK', $lang) && is_array($lang['si_LK'])) {
	$lang['si_LK'] = array_merge($lang['en_US'], $lang['si_LK']);
} else {
	$lang['si_LK'] = $lang['en_US'];
}

$lang['si_LK']['LeftAndMain']['NEWSLETTERS'] = 'පුවත් හසුන්';
$lang['si_LK']['NewsletterAdmin']['FROMEM'] = 'යවන්නා';
$lang['si_LK']['NewsletterAdmin']['MEWDRAFTMEWSL'] = 'අලුත් කටු පුවත් හසුනක්';
$lang['si_LK']['NewsletterAdmin']['NEWLIST'] = 'අලුත් ලිපි ලයිස්තුවක්';
$lang['si_LK']['NewsletterAdmin']['NEWNEWSLTYPE'] = 'අලුත් පුවත් හසුන් වර්ගයක්';
$lang['si_LK']['NewsletterAdmin']['NEWSLTYPE'] = 'පුවත් හසුන් වර්ගය';
$lang['si_LK']['NewsletterAdmin']['PLEASEENTERMAIL'] = 'ඊමේල් ඇතුල් කරන්න';
$lang['si_LK']['NewsletterAdmin']['RESEND'] = 'නැවත යවන්න';
$lang['si_LK']['NewsletterAdmin']['SAVE'] = 'සේවි කරන්න';
$lang['si_LK']['NewsletterAdmin']['SAVED'] = 'සේවි කරන ලදී ';
$lang['si_LK']['NewsletterAdmin']['SEND'] = 'යවන්න';
$lang['si_LK']['NewsletterAdmin']['SENDING'] = 'ඊමේල් යවනවා';
$lang['si_LK']['NewsletterAdmin']['SENTTESTTO'] = 'පරික්ශාව යවන ලදී';
$lang['si_LK']['NewsletterAdmin']['SHOWCONTENTS'] = 'අන්ර්ගතය පෙන්වන්න';
$lang['si_LK']['NewsletterAdmin_BouncedList.ss']['EMADD'] = 'ඊමේල් ලිපිනය';
$lang['si_LK']['NewsletterAdmin_BouncedList.ss']['HAVEBOUNCED'] = 'අසාර්තක ඊමේල්';
$lang['si_LK']['NewsletterAdmin_BouncedList.ss']['NOBOUNCED'] = 'අසාර්තක ඊමේල් නැත';
$lang['si_LK']['NewsletterAdmin_BouncedList.ss']['UNAME'] = 'නම';
$lang['si_LK']['NewsletterAdmin_left.ss']['ADDDRAFT'] = 'අලුත් කටු සටහනක් ඵකතු කරන්න';
$lang['si_LK']['NewsletterAdmin_left.ss']['ADDTYPE'] = 'අලුත් වර්ගයක් එකතු කරන්න';
$lang['si_LK']['NewsletterAdmin_left.ss']['CREATE'] = 'හදන්න';
$lang['si_LK']['NewsletterAdmin_left.ss']['DEL'] = 'මකන්න';
$lang['si_LK']['NewsletterAdmin_left.ss']['DELETEDRAFTS'] = 'තෝරාගත් කටු සටහන් මකන්න';
$lang['si_LK']['NewsletterAdmin_left.ss']['GO'] = 'යන්න';
$lang['si_LK']['NewsletterAdmin_left.ss']['NEWSLETTERS'] = 'පුවත් හසුන්';
$lang['si_LK']['NewsletterAdmin_left.ss']['SELECTDRAFTS'] = 'මකන්න අවශය කටු සටහන් තෝරා බොත්තම ඹබන්න';
$lang['si_LK']['NewsletterAdmin_right.ss']['CANCEL'] = 'අවල0ගු කරන්න';
$lang['si_LK']['NewsletterAdmin_right.ss']['ENTIRE'] = 'සම්පූර්ණ ලිපින ලැයිස්තුවට යවන්න';
$lang['si_LK']['NewsletterAdmin_right.ss']['ONLYNOT'] = 'කලින් නොයැවූ අයට යවන්න';
$lang['si_LK']['NewsletterAdmin_right.ss']['SEND'] = 'පුවත් හසුන යවන්න';
$lang['si_LK']['NewsletterAdmin_right.ss']['SENDTEST'] = 'පරික්ශාව යවන ලදී';
$lang['si_LK']['NewsletterAdmin_right.ss']['WELCOME1'] = 'ආයුබෝවන්';
$lang['si_LK']['NewsletterAdmin_right.ss']['WELCOME2'] = 'පුවත් හසුන් මෙහෙයවීම. වමෙන් ගොනුවක් තෝරන්න';
$lang['si_LK']['NewsletterAdmin_SiteTree.ss']['DRAFTS'] = 'කටු සටහන්';
$lang['si_LK']['NewsletterAdmin_SiteTree.ss']['MAILLIST'] = 'ලිපි ලයිස්තුව';
$lang['si_LK']['NewsletterAdmin_SiteTree.ss']['SENT'] = 'යැවු ලිපි';
$lang['si_LK']['NewsletterAdmin_UnsubscribedList.ss']['NOUNSUB'] = 'කිසිවකු මෙම පුවත් හසුනින් ඉවත් වී නැත';
$lang['si_LK']['NewsletterAdmin_UnsubscribedList.ss']['UNAME'] = 'නම';
$lang['si_LK']['NewsletterAdmin_UnsubscribedList.ss']['UNSUBON'] = 'ඉවත් වූයේ';
$lang['si_LK']['NewsletterList.ss']['CHOOSEDRAFT1'] = 'කටු සටහනක් වමෙන් තෝරන්න, හෝ';
$lang['si_LK']['NewsletterList.ss']['CHOOSEDRAFT2'] = 'එකක් එකතු කරන්න';
$lang['si_LK']['NewsletterList.ss']['CHOOSESENT'] = 'යැවු අයිතමයක් වමෙන් තෝරන්න';
$lang['si_LK']['Newsletter_RecipientImportField.ss']['CHANGED'] = 'වෙනස් කළ දත්ත ගනන';
$lang['si_LK']['Newsletter_RecipientImportField.ss']['IMPORTED'] = 'අලුත්සාමාජිකයන් ගෙන්වන ලදී';
$lang['si_LK']['Newsletter_RecipientImportField.ss']['IMPORTNEW'] = 'ගෙන්වූ අලුත්සාමාජිකයන්';
$lang['si_LK']['Newsletter_RecipientImportField.ss']['SEC'] = 'තත්පර';
$lang['si_LK']['Newsletter_RecipientImportField.ss']['SKIPPED'] = 'දත්ත මගහරින ලදී';
$lang['si_LK']['Newsletter_RecipientImportField.ss']['TIME'] = 'වැයවු වේලාව';
$lang['si_LK']['Newsletter_RecipientImportField.ss']['UPDATED'] = 'සාමාජිකයන් යාවත්කාලීන කරන ලදී';
$lang['si_LK']['Newsletter_RecipientImportField_Table.ss']['CONTENTSOF'] = 'අන්ර්ගතය';
$lang['si_LK']['Newsletter_RecipientImportField_Table.ss']['NO'] = 'අවල0ගු කරන්න';
$lang['si_LK']['Newsletter_RecipientImportField_Table.ss']['RECIMPORTED'] = 'ලබන්නන් ගෙන්වූයේ';
$lang['si_LK']['Newsletter_RecipientImportField_Table.ss']['YES'] = 'සහතික කරන්න';
$lang['si_LK']['Newsletter_SentStatusReport.ss']['DATE'] = 'දිනය';
$lang['si_LK']['Newsletter_SentStatusReport.ss']['EMAIL'] = 'ඊමේල්';
$lang['si_LK']['Newsletter_SentStatusReport.ss']['FN'] = 'මුල් නම';
$lang['si_LK']['Newsletter_SentStatusReport.ss']['NEWSNEVERSENT'] = 'මෙම පුවත් හසුන කිසිවකුටත් යවා නැත';
$lang['si_LK']['Newsletter_SentStatusReport.ss']['RES'] = 'පිලිතුරැ';
$lang['si_LK']['Newsletter_SentStatusReport.ss']['SENDBOUNCED'] = 'පහත අයට යැවීම අසාර්තකයි';
$lang['si_LK']['Newsletter_SentStatusReport.ss']['SENDFAIL'] = 'පහත ලබන්නන්ට යැවීම අසාර්තකයි';
$lang['si_LK']['Newsletter_SentStatusReport.ss']['SENTOK'] = 'පහත අයට පුවත් හසුන යවන ලදී';
$lang['si_LK']['Newsletter_SentStatusReport.ss']['SN'] = 'වාසගම';

?>