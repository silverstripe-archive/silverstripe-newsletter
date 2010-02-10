<?php

/**
 * Serbian (Serbia) language pack
 * @package modules: newsletter
 * @subpackage i18n
 */

i18n::include_locale_file('modules: newsletter', 'en_US');

global $lang;

if(array_key_exists('sr_RS', $lang) && is_array($lang['sr_RS'])) {
	$lang['sr_RS'] = array_merge($lang['en_US'], $lang['sr_RS']);
} else {
	$lang['sr_RS'] = $lang['en_US'];
}

$lang['sr_RS']['LeftAndMain']['NEWSLETTERS'] = 'Листе за е-пошту';
$lang['sr_RS']['NewsletterAdmin']['FROMEM'] = 'Од адреса е-поште';
$lang['sr_RS']['NewsletterAdmin']['MEWDRAFTMEWSL'] = 'Нови нацрт листе за е-пошту';
$lang['sr_RS']['NewsletterAdmin']['NEWLIST'] = 'Нова листа за слање';
$lang['sr_RS']['NewsletterAdmin']['NEWNEWSLTYPE'] = 'Нови тип листе за е-пошту';
$lang['sr_RS']['NewsletterAdmin']['NEWSLTYPE'] = 'Тип листе за е-пошту';
$lang['sr_RS']['NewsletterAdmin']['PLEASEENTERMAIL'] = 'Унесите адресе е-поште';
$lang['sr_RS']['NewsletterAdmin']['RESEND'] = 'Пошаљи поново';
$lang['sr_RS']['NewsletterAdmin']['SAVE'] = 'Сачувај';
$lang['sr_RS']['NewsletterAdmin']['SAVED'] = 'Сачувано';
$lang['sr_RS']['NewsletterAdmin']['SEND'] = 'Пошаљи...';
$lang['sr_RS']['NewsletterAdmin']['SENDING'] = 'Шаљем е-поруке...';
$lang['sr_RS']['NewsletterAdmin']['SENTTESTTO'] = 'Тест послат на';
$lang['sr_RS']['NewsletterAdmin']['SHOWCONTENTS'] = 'Прикажи садржај';
$lang['sr_RS']['NewsletterAdmin_BouncedList.ss']['EMADD'] = 'Адреса е-поште';
$lang['sr_RS']['NewsletterAdmin_BouncedList.ss']['HAVEBOUNCED'] = 'Е-поруке које су враћене';
$lang['sr_RS']['NewsletterAdmin_BouncedList.ss']['NOBOUNCED'] = 'Ниједна послата е-порука није враћена.';
$lang['sr_RS']['NewsletterAdmin_BouncedList.ss']['UNAME'] = 'Корисничко име';
$lang['sr_RS']['NewsletterAdmin_left.ss']['ADDDRAFT'] = 'Додај нови нацрт';
$lang['sr_RS']['NewsletterAdmin_left.ss']['ADDTYPE'] = 'Додај нови тип';
$lang['sr_RS']['NewsletterAdmin_left.ss']['CREATE'] = 'Направи';
$lang['sr_RS']['NewsletterAdmin_left.ss']['DEL'] = 'Избриши';
$lang['sr_RS']['NewsletterAdmin_left.ss']['DELETEDRAFTS'] = 'Избриши изабране нацрте';
$lang['sr_RS']['NewsletterAdmin_left.ss']['GO'] = 'Иди';
$lang['sr_RS']['NewsletterAdmin_left.ss']['NEWSLETTERS'] = 'Листе за е-пошту';
$lang['sr_RS']['NewsletterAdmin_left.ss']['SELECTDRAFTS'] = 'Изаберите нацрте које желите да избришете и кликните на дугме';
$lang['sr_RS']['NewsletterAdmin_right.ss']['CANCEL'] = 'Откажи';
$lang['sr_RS']['NewsletterAdmin_right.ss']['ENTIRE'] = 'Пошаљи целој листи за слање';
$lang['sr_RS']['NewsletterAdmin_right.ss']['ONLYNOT'] = 'Пошаљи само људима којима раније није слато';
$lang['sr_RS']['NewsletterAdmin_right.ss']['SEND'] = 'Пошаљи листу за е-пошту';
$lang['sr_RS']['NewsletterAdmin_right.ss']['SENDTEST'] = 'Пошаљи тест на';
$lang['sr_RS']['NewsletterAdmin_right.ss']['WELCOME1'] = 'Добродошли у ';
$lang['sr_RS']['NewsletterAdmin_right.ss']['WELCOME2'] = 'одељак за администрацију листа за е-пошту. Изаберите фасциклу са леве стране';
$lang['sr_RS']['NewsletterAdmin_SiteTree.ss']['DRAFTS'] = 'Нацрти';
$lang['sr_RS']['NewsletterAdmin_SiteTree.ss']['MAILLIST'] = 'Листе за е-пошту';
$lang['sr_RS']['NewsletterAdmin_SiteTree.ss']['SENT'] = 'Послате ставке';
$lang['sr_RS']['NewsletterAdmin_UnsubscribedList.ss']['NOUNSUB'] = 'Ниједан корисник се није одјавио са ове листе за е-пошту';
$lang['sr_RS']['NewsletterAdmin_UnsubscribedList.ss']['UNAME'] = 'Корисничко име';
$lang['sr_RS']['NewsletterAdmin_UnsubscribedList.ss']['UNSUBON'] = 'Отказана претплата';
$lang['sr_RS']['NewsletterList.ss']['CHOOSEDRAFT1'] = 'Изаберите нацрт на левој трани, или';
$lang['sr_RS']['NewsletterList.ss']['CHOOSEDRAFT2'] = 'додај један';
$lang['sr_RS']['NewsletterList.ss']['CHOOSESENT'] = 'Изаберите послату ставку са леве стране.';
$lang['sr_RS']['Newsletter_RecipientImportField.ss']['CHANGED'] = 'Број промењених детаља:';
$lang['sr_RS']['Newsletter_RecipientImportField.ss']['IMPORTED'] = 'Нови увежени чланови:';
$lang['sr_RS']['Newsletter_RecipientImportField.ss']['IMPORTNEW'] = 'Нови увежени чланови';
$lang['sr_RS']['Newsletter_RecipientImportField.ss']['SEC'] = 'секунди';
$lang['sr_RS']['Newsletter_RecipientImportField.ss']['SKIPPED'] = 'Прескочени записи:';
$lang['sr_RS']['Newsletter_RecipientImportField.ss']['TIME'] = 'Време узимања:';
$lang['sr_RS']['Newsletter_RecipientImportField.ss']['UPDATED'] = 'Ажурирани чланови:';
$lang['sr_RS']['Newsletter_RecipientImportField_Table.ss']['CONTENTSOF'] = 'Садржај ';
$lang['sr_RS']['Newsletter_RecipientImportField_Table.ss']['NO'] = 'Откажи';
$lang['sr_RS']['Newsletter_RecipientImportField_Table.ss']['RECIMPORTED'] = 'Примаоци увезени из';
$lang['sr_RS']['Newsletter_RecipientImportField_Table.ss']['YES'] = 'Потврди';
$lang['sr_RS']['Newsletter_SentStatusReport.ss']['DATE'] = 'Датум';
$lang['sr_RS']['Newsletter_SentStatusReport.ss']['EMAIL'] = 'Е-пошта';
$lang['sr_RS']['Newsletter_SentStatusReport.ss']['FN'] = 'Име';
$lang['sr_RS']['Newsletter_SentStatusReport.ss']['NEWSNEVERSENT'] = 'Поруке никада нису биле послате следећим претплатницима';
$lang['sr_RS']['Newsletter_SentStatusReport.ss']['RES'] = 'Резултати';
$lang['sr_RS']['Newsletter_SentStatusReport.ss']['SENDBOUNCED'] = 'Поруке послате следећим примаоцима су се вратиле';
$lang['sr_RS']['Newsletter_SentStatusReport.ss']['SENDFAIL'] = 'Слање следећим примаоцима није успело';
$lang['sr_RS']['Newsletter_SentStatusReport.ss']['SENTOK'] = 'Слање следећим примаоцима је било успешно';
$lang['sr_RS']['Newsletter_SentStatusReport.ss']['SN'] = 'Презиме';

?>