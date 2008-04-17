<?php

/**
 * Bulgarian (Bulgaria) language pack
 * @package modules: newsletter
 * @subpackage i18n
 */

i18n::include_locale_file('modules: newsletter', 'en_US');

global $lang;

if(array_key_exists('bg_BG', $lang) && is_array($lang['bg_BG'])) {
	$lang['bg_BG'] = array_merge($lang['en_US'], $lang['bg_BG']);
} else {
	$lang['bg_BG'] = $lang['en_US'];
}

$lang['bg_BG']['LeftAndMain']['NEWSLETTERS'] = 'Бюлетини';
$lang['bg_BG']['NewsletterAdmin']['FROMEM'] = 'От e-mail адрес';
$lang['bg_BG']['NewsletterAdmin']['MEWDRAFTMEWSL'] = 'Нова чернова на бюлетин';
$lang['bg_BG']['NewsletterAdmin']['NEWLIST'] = 'Нов email списък';
$lang['bg_BG']['NewsletterAdmin']['NEWNEWSLTYPE'] = 'Нов вид бюлетин';
$lang['bg_BG']['NewsletterAdmin']['NEWSLTYPE'] = 'Вид бюлетин';
$lang['bg_BG']['NewsletterAdmin']['PLEASEENTERMAIL'] = 'Моля въведете e-mail адрес';
$lang['bg_BG']['NewsletterAdmin']['RESEND'] = 'Изпрати отново';
$lang['bg_BG']['NewsletterAdmin']['SAVE'] = 'Съхрани';
$lang['bg_BG']['NewsletterAdmin']['SAVED'] = 'Съхранен';
$lang['bg_BG']['NewsletterAdmin']['SEND'] = 'Изпрати...';
$lang['bg_BG']['NewsletterAdmin']['SENDING'] = 'Изпращам email-и...';
$lang['bg_BG']['NewsletterAdmin']['SENTTESTTO'] = 'Изпратен тест на';
$lang['bg_BG']['NewsletterAdmin']['SHOWCONTENTS'] = 'Покажи съдържание';
$lang['bg_BG']['NewsletterAdmin_BouncedList.ss']['EMADD'] = 'Е-mail адрес';
$lang['bg_BG']['NewsletterAdmin_BouncedList.ss']['HAVEBOUNCED'] = 'Еmail-и които са върнати обратно';
$lang['bg_BG']['NewsletterAdmin_BouncedList.ss']['NOBOUNCED'] = 'Няма email-и които да са върнати.';
$lang['bg_BG']['NewsletterAdmin_BouncedList.ss']['UNAME'] = 'Потребителско име';
$lang['bg_BG']['NewsletterAdmin_left.ss']['ADDDRAFT'] = 'Добави нова чернова';
$lang['bg_BG']['NewsletterAdmin_left.ss']['ADDTYPE'] = 'Добави нов вид';
$lang['bg_BG']['NewsletterAdmin_left.ss']['CREATE'] = 'Създай';
$lang['bg_BG']['NewsletterAdmin_left.ss']['DEL'] = 'Изтрий';
$lang['bg_BG']['NewsletterAdmin_left.ss']['DELETEDRAFTS'] = 'Изтрий избраните чернови';
$lang['bg_BG']['NewsletterAdmin_left.ss']['GO'] = 'Давай';
$lang['bg_BG']['NewsletterAdmin_left.ss']['NEWSLETTERS'] = 'Бюлетини';
$lang['bg_BG']['NewsletterAdmin_left.ss']['SELECTDRAFTS'] = 'Изберете черновите които искате да изтриете и после натиснете бутона по-долу';
$lang['bg_BG']['NewsletterAdmin_right.ss']['CANCEL'] = 'Отмени';
$lang['bg_BG']['NewsletterAdmin_right.ss']['ENTIRE'] = 'Изпрати до целия списък от мейли';
$lang['bg_BG']['NewsletterAdmin_right.ss']['ONLYNOT'] = 'Изпрати само на хората, на които не е било изпратено преди';
$lang['bg_BG']['NewsletterAdmin_right.ss']['SEND'] = 'Изпрати бюлетин';
$lang['bg_BG']['NewsletterAdmin_right.ss']['SENDTEST'] = 'Изпрати тест на';
$lang['bg_BG']['NewsletterAdmin_right.ss']['WELCOME1'] = 'Добре дошли в';
$lang['bg_BG']['NewsletterAdmin_right.ss']['WELCOME2'] = 'секция за управление на бюлетини. Моля изберете папка от ляво';
$lang['bg_BG']['NewsletterAdmin_SiteTree.ss']['DRAFTS'] = 'Чернови';
$lang['bg_BG']['NewsletterAdmin_SiteTree.ss']['MAILLIST'] = 'Списък с мейли';
$lang['bg_BG']['NewsletterAdmin_SiteTree.ss']['SENT'] = 'Изпратени';
$lang['bg_BG']['NewsletterAdmin_UnsubscribedList.ss']['NOUNSUB'] = 'Няма потребители отписали се от този бюлетин.';
$lang['bg_BG']['NewsletterAdmin_UnsubscribedList.ss']['UNAME'] = 'Потребителско име';
$lang['bg_BG']['NewsletterAdmin_UnsubscribedList.ss']['UNSUBON'] = 'Отписан на';
$lang['bg_BG']['NewsletterList.ss']['CHOOSEDRAFT1'] = 'Моля изберете чернова от ляво, или';
$lang['bg_BG']['NewsletterList.ss']['CHOOSEDRAFT2'] = 'добави едно';
$lang['bg_BG']['NewsletterList.ss']['CHOOSESENT'] = 'Моля, изберете изпратено писмо от ляво.';
$lang['bg_BG']['Newsletter_RecipientImportField.ss']['CHANGED'] = 'Брой променени детайли:';
$lang['bg_BG']['Newsletter_RecipientImportField.ss']['IMPORTED'] = 'Нови потребители импортирани:';
$lang['bg_BG']['Newsletter_RecipientImportField.ss']['IMPORTNEW'] = 'Импортирани нови потребители';
$lang['bg_BG']['Newsletter_RecipientImportField.ss']['SEC'] = 'секунди';
$lang['bg_BG']['Newsletter_RecipientImportField.ss']['SKIPPED'] = 'Прескочени записи:';
$lang['bg_BG']['Newsletter_RecipientImportField.ss']['TIME'] = 'Отнето време:';
$lang['bg_BG']['Newsletter_RecipientImportField.ss']['UPDATED'] = 'Потребители обновени:';
$lang['bg_BG']['Newsletter_RecipientImportField_Table.ss']['CONTENTSOF'] = 'Съдържания от';
$lang['bg_BG']['Newsletter_RecipientImportField_Table.ss']['NO'] = 'Отмени';
$lang['bg_BG']['Newsletter_RecipientImportField_Table.ss']['RECIMPORTED'] = 'Получатели импортирани от';
$lang['bg_BG']['Newsletter_RecipientImportField_Table.ss']['YES'] = 'Потвърди';
$lang['bg_BG']['Newsletter_SentStatusReport.ss']['DATE'] = 'Дата';
$lang['bg_BG']['Newsletter_SentStatusReport.ss']['EMAIL'] = 'Еmail';
$lang['bg_BG']['Newsletter_SentStatusReport.ss']['FN'] = 'Име';
$lang['bg_BG']['Newsletter_SentStatusReport.ss']['NEWSNEVERSENT'] = 'Бюлетинът никога не е изпращан на следните абонати';
$lang['bg_BG']['Newsletter_SentStatusReport.ss']['RES'] = 'Резултат';
$lang['bg_BG']['Newsletter_SentStatusReport.ss']['SENDBOUNCED'] = 'Изпращане до следните получатели върнато';
$lang['bg_BG']['Newsletter_SentStatusReport.ss']['SENDFAIL'] = 'Изпращане до следните получатели неосъществено';
$lang['bg_BG']['Newsletter_SentStatusReport.ss']['SENTOK'] = 'Пращането до следните получатели е успешно';
$lang['bg_BG']['Newsletter_SentStatusReport.ss']['SN'] = 'Фамилия';

?>