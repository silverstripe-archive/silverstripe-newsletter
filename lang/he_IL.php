<?php

/**
 * Hebrew (Israel) language pack
 * @package modules: newsletter
 * @subpackage i18n
 */

i18n::include_locale_file('modules: newsletter', 'en_US');

global $lang;

if(array_key_exists('he_IL', $lang) && is_array($lang['he_IL'])) {
	$lang['he_IL'] = array_merge($lang['en_US'], $lang['he_IL']);
} else {
	$lang['he_IL'] = $lang['en_US'];
}

$lang['he_IL']['LeftAndMain']['NEWSLETTERS'] = 'עדכונים ורשימות תפוצה';
$lang['he_IL']['NewsletterAdmin']['FROMEM'] = 'מכתובת דוא"ל';
$lang['he_IL']['NewsletterAdmin']['MEWDRAFTMEWSL'] = 'טיוטת ניוזלטר חדשה';
$lang['he_IL']['NewsletterAdmin']['NEWLIST'] = 'רשימת תפוצה חדשה';
$lang['he_IL']['NewsletterAdmin']['NEWNEWSLTYPE'] = 'סוג ניוזלטר חדש';
$lang['he_IL']['NewsletterAdmin']['NEWSLTYPE'] = 'סוג ניוזלטר';
$lang['he_IL']['NewsletterAdmin']['PLEASEENTERMAIL'] = 'נא להזין כתובת דוא"ל';
$lang['he_IL']['NewsletterAdmin']['RESEND'] = 'שלח שנית';
$lang['he_IL']['NewsletterAdmin']['SAVE'] = 'שמור';
$lang['he_IL']['NewsletterAdmin']['SAVED'] = 'נשמר';
$lang['he_IL']['NewsletterAdmin']['SEND'] = 'שלח';
$lang['he_IL']['NewsletterAdmin']['SENDING'] = 'שולח פריטי דואר';
$lang['he_IL']['NewsletterAdmin']['SENTTESTTO'] = 'שלח דואר בדיקה ל';
$lang['he_IL']['NewsletterAdmin']['SHOWCONTENTS'] = 'הצג תוכן';
$lang['he_IL']['NewsletterAdmin_BouncedList.ss']['EMADD'] = 'כתובת דואר אלקטרוני';
$lang['he_IL']['NewsletterAdmin_BouncedList.ss']['HAVEBOUNCED'] = 'הודעות דואר חוזרות';
$lang['he_IL']['NewsletterAdmin_BouncedList.ss']['NOBOUNCED'] = 'אין הודעות דואר חוזרות';
$lang['he_IL']['NewsletterAdmin_BouncedList.ss']['UNAME'] = 'שם משתמש';
$lang['he_IL']['NewsletterAdmin_left.ss']['ADDDRAFT'] = 'הוסף טיוטה חדשה';
$lang['he_IL']['NewsletterAdmin_left.ss']['ADDTYPE'] = 'הוסף סוג חדש';
$lang['he_IL']['NewsletterAdmin_left.ss']['CREATE'] = 'צור';
$lang['he_IL']['NewsletterAdmin_left.ss']['DEL'] = 'מחק';
$lang['he_IL']['NewsletterAdmin_left.ss']['DELETEDRAFTS'] = 'מחק את הטיוטות שנבחרו';
$lang['he_IL']['NewsletterAdmin_left.ss']['GO'] = 'סע';
$lang['he_IL']['NewsletterAdmin_left.ss']['NEWSLETTERS'] = 'ניוזלטר';
$lang['he_IL']['NewsletterAdmin_left.ss']['SELECTDRAFTS'] = 'בחר בטיוטות שברצונך למחוק ולאחר מכן לחץ על הכפתור מתחת';
$lang['he_IL']['NewsletterAdmin_right.ss']['CANCEL'] = 'בטל';
$lang['he_IL']['NewsletterAdmin_right.ss']['ENTIRE'] = 'שלח לכל רשימת התפוצה';
$lang['he_IL']['NewsletterAdmin_right.ss']['ONLYNOT'] = 'שלח רק לאנשים שלא נשלח אליהם בעבר';
$lang['he_IL']['NewsletterAdmin_right.ss']['SEND'] = 'שלח ניוזלטר';
$lang['he_IL']['NewsletterAdmin_right.ss']['SENDTEST'] = 'שלח בדיקה ל';
$lang['he_IL']['NewsletterAdmin_right.ss']['WELCOME1'] = 'ברוך הבא ל';
$lang['he_IL']['NewsletterAdmin_right.ss']['WELCOME2'] = 'אזור ניהול ניוזלטר. נא בחר תיקייה משמאל';
$lang['he_IL']['NewsletterAdmin_SiteTree.ss']['DRAFTS'] = 'טיוטות';
$lang['he_IL']['NewsletterAdmin_SiteTree.ss']['MAILLIST'] = 'רשימת דיוור';
$lang['he_IL']['NewsletterAdmin_SiteTree.ss']['SENT'] = 'פריטים שנשלחו';
$lang['he_IL']['NewsletterAdmin_UnsubscribedList.ss']['NOUNSUB'] = 'אין משתמשים רשומים מהניוזלטר הזה.';
$lang['he_IL']['NewsletterAdmin_UnsubscribedList.ss']['UNAME'] = 'שם משתמש';
$lang['he_IL']['NewsletterList.ss']['CHOOSEDRAFT1'] = 'נא בחר בטיוטה שבצד שמאל , או';
$lang['he_IL']['NewsletterList.ss']['CHOOSEDRAFT2'] = 'הוסף אחד';
$lang['he_IL']['NewsletterList.ss']['CHOOSESENT'] = 'נא בחר בפריט שנשלח בצד שמאל.';
$lang['he_IL']['Newsletter_RecipientImportField.ss']['IMPORTED'] = 'משתמשים חדשים שיובאו:';
$lang['he_IL']['Newsletter_RecipientImportField.ss']['IMPORTNEW'] = 'משתמשים חדשים יובאו';
$lang['he_IL']['Newsletter_RecipientImportField.ss']['SEC'] = 'שניות';
$lang['he_IL']['Newsletter_RecipientImportField_Table.ss']['CONTENTSOF'] = 'תוכן של';
$lang['he_IL']['Newsletter_RecipientImportField_Table.ss']['NO'] = 'ביטול';
$lang['he_IL']['Newsletter_RecipientImportField_Table.ss']['RECIMPORTED'] = 'נמענים יובאו מ';
$lang['he_IL']['Newsletter_RecipientImportField_Table.ss']['YES'] = 'אישור';
$lang['he_IL']['Newsletter_SentStatusReport.ss']['DATE'] = 'תאריך';
$lang['he_IL']['Newsletter_SentStatusReport.ss']['EMAIL'] = 'דואר אלקטרוני';
$lang['he_IL']['Newsletter_SentStatusReport.ss']['FN'] = 'שם פרטי';
$lang['he_IL']['Newsletter_SentStatusReport.ss']['RES'] = 'תוצאה';
$lang['he_IL']['Newsletter_SentStatusReport.ss']['SENDBOUNCED'] = 'השליחה לנעמנים הבאים חזרה';
$lang['he_IL']['Newsletter_SentStatusReport.ss']['SENDFAIL'] = 'השליחה לנמענים הבאים נכשלה';
$lang['he_IL']['Newsletter_SentStatusReport.ss']['SENTOK'] = 'השליחה לנמענים הבאים עברה בהצלחה';
$lang['he_IL']['Newsletter_SentStatusReport.ss']['SN'] = 'שם משפחה';

?>