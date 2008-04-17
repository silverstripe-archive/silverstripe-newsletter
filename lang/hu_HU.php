<?php

/**
 * Hungarian (Hungary) language pack
 * @package modules: newsletter
 * @subpackage i18n
 */

i18n::include_locale_file('modules: newsletter', 'en_US');

global $lang;

if(array_key_exists('hu_HU', $lang) && is_array($lang['hu_HU'])) {
	$lang['hu_HU'] = array_merge($lang['en_US'], $lang['hu_HU']);
} else {
	$lang['hu_HU'] = $lang['en_US'];
}

$lang['hu_HU']['LeftAndMain']['NEWSLETTERS'] = 'Hírlevelek';
$lang['hu_HU']['NewsletterAdmin']['FROMEM'] = 'E-mail címekből';
$lang['hu_HU']['NewsletterAdmin']['MEWDRAFTMEWSL'] = 'Új hírlevélpiszkozat';
$lang['hu_HU']['NewsletterAdmin']['NEWLIST'] = 'Új levelezőlista';
$lang['hu_HU']['NewsletterAdmin']['NEWNEWSLTYPE'] = 'Új levelezési lista típusa';
$lang['hu_HU']['NewsletterAdmin']['NEWSLTYPE'] = 'Hírlevél típusa';
$lang['hu_HU']['NewsletterAdmin']['PLEASEENTERMAIL'] = 'Írj be egy e-mail címet.';
$lang['hu_HU']['NewsletterAdmin']['RESEND'] = 'Újraküldés';
$lang['hu_HU']['NewsletterAdmin']['SAVE'] = 'Mentés';
$lang['hu_HU']['NewsletterAdmin']['SAVED'] = 'Elmentve.';
$lang['hu_HU']['NewsletterAdmin']['SEND'] = 'Küldés…';
$lang['hu_HU']['NewsletterAdmin']['SENDING'] = 'E-mailek küldése…';
$lang['hu_HU']['NewsletterAdmin']['SENTTESTTO'] = 'Teszt elküldve ide: ';
$lang['hu_HU']['NewsletterAdmin']['SHOWCONTENTS'] = 'Tartalom mutatása';
$lang['hu_HU']['NewsletterAdmin_BouncedList.ss']['EMADD'] = 'E-mail cím';
$lang['hu_HU']['NewsletterAdmin_BouncedList.ss']['HAVEBOUNCED'] = 'Visszaküldött e-mailek';
$lang['hu_HU']['NewsletterAdmin_BouncedList.ss']['NOBOUNCED'] = 'Egyetlen elküldött levél sem jött vissza.';
$lang['hu_HU']['NewsletterAdmin_BouncedList.ss']['UNAME'] = 'Felhasználónév';
$lang['hu_HU']['NewsletterAdmin_left.ss']['ADDDRAFT'] = 'Új piszkozat hozzáadása';
$lang['hu_HU']['NewsletterAdmin_left.ss']['ADDTYPE'] = 'Új típus hozzáadása';
$lang['hu_HU']['NewsletterAdmin_left.ss']['CREATE'] = 'Létrehozás';
$lang['hu_HU']['NewsletterAdmin_left.ss']['DEL'] = 'Törlés';
$lang['hu_HU']['NewsletterAdmin_left.ss']['DELETEDRAFTS'] = 'Kiválasztott piszkozatok törlése';
$lang['hu_HU']['NewsletterAdmin_left.ss']['GO'] = 'Mehet';
$lang['hu_HU']['NewsletterAdmin_left.ss']['NEWSLETTERS'] = 'Hírlevelek';
$lang['hu_HU']['NewsletterAdmin_left.ss']['SELECTDRAFTS'] = 'Válaszd ki a törlendő piszkozatokat, majd kattints a lentebbi gombra.';
$lang['hu_HU']['NewsletterAdmin_right.ss']['CANCEL'] = 'Mégsem';
$lang['hu_HU']['NewsletterAdmin_right.ss']['ENTIRE'] = 'Küldés az egész levelezési listának';
$lang['hu_HU']['NewsletterAdmin_right.ss']['ONLYNOT'] = 'Küldés csak olyan embereknek, akiknek korábban nem került elküldésre';
$lang['hu_HU']['NewsletterAdmin_right.ss']['SEND'] = 'Hírlevél küldése';
$lang['hu_HU']['NewsletterAdmin_right.ss']['SENDTEST'] = 'Teszt küldése ide:';
$lang['hu_HU']['NewsletterAdmin_right.ss']['WELCOME1'] = 'Üdvözlünk';
$lang['hu_HU']['NewsletterAdmin_right.ss']['WELCOME2'] = 'hírlevél adminisztrátori részében. Kérünk, válassz egy mappát a bal oldalról.';
$lang['hu_HU']['NewsletterAdmin_SiteTree.ss']['DRAFTS'] = 'Piszkozatok';
$lang['hu_HU']['NewsletterAdmin_SiteTree.ss']['MAILLIST'] = 'Levelezési lista';
$lang['hu_HU']['NewsletterAdmin_SiteTree.ss']['SENT'] = 'Elküldött elmek';
$lang['hu_HU']['NewsletterAdmin_UnsubscribedList.ss']['NOUNSUB'] = 'Egy felhasználó sem iratkozott le a hírlvélről.';
$lang['hu_HU']['NewsletterAdmin_UnsubscribedList.ss']['UNAME'] = 'Felhasználónév';
$lang['hu_HU']['NewsletterAdmin_UnsubscribedList.ss']['UNSUBON'] = 'Leiratkozott ekkor';
$lang['hu_HU']['NewsletterList.ss']['CHOOSEDRAFT1'] = 'Válassz egy piszkozatot a bal oldalon, vagy ';
$lang['hu_HU']['NewsletterList.ss']['CHOOSEDRAFT2'] = 'hozz létre egyet';
$lang['hu_HU']['NewsletterList.ss']['CHOOSESENT'] = 'Kérünk, válassz ki egy elküldött elemet a bal oldali listából. ';
$lang['hu_HU']['Newsletter_RecipientImportField.ss']['CHANGED'] = 'Megváltoztatott részletek száma: ';
$lang['hu_HU']['Newsletter_RecipientImportField.ss']['IMPORTED'] = 'Új importált tagok:';
$lang['hu_HU']['Newsletter_RecipientImportField.ss']['IMPORTNEW'] = 'Importált új tagok';
$lang['hu_HU']['Newsletter_RecipientImportField.ss']['SEC'] = 'másodperc';
$lang['hu_HU']['Newsletter_RecipientImportField.ss']['SKIPPED'] = 'A kihagyott elemek:';
$lang['hu_HU']['Newsletter_RecipientImportField.ss']['TIME'] = 'Eltelt idő:';
$lang['hu_HU']['Newsletter_RecipientImportField.ss']['UPDATED'] = 'Frissített tagok:';
$lang['hu_HU']['Newsletter_RecipientImportField_Table.ss']['CONTENTSOF'] = 'Tartalom:';
$lang['hu_HU']['Newsletter_RecipientImportField_Table.ss']['NO'] = 'Mégse';
$lang['hu_HU']['Newsletter_RecipientImportField_Table.ss']['RECIMPORTED'] = 'Címzettek importálási helye: ';
$lang['hu_HU']['Newsletter_RecipientImportField_Table.ss']['YES'] = 'Megerősítés';
$lang['hu_HU']['Newsletter_SentStatusReport.ss']['DATE'] = 'Dátum';
$lang['hu_HU']['Newsletter_SentStatusReport.ss']['EMAIL'] = 'E-mail';
$lang['hu_HU']['Newsletter_SentStatusReport.ss']['FN'] = 'Keresztnév';
$lang['hu_HU']['Newsletter_SentStatusReport.ss']['NEWSNEVERSENT'] = 'Még soha nem került elküldésre a következő feliratkozottaknak';
$lang['hu_HU']['Newsletter_SentStatusReport.ss']['RES'] = 'Eredmény';
$lang['hu_HU']['Newsletter_SentStatusReport.ss']['SENDBOUNCED'] = 'A következő címzetteknek való elküldés sikeretelen volt, az e-mail visszaküldésre került';
$lang['hu_HU']['Newsletter_SentStatusReport.ss']['SENDFAIL'] = 'A következő címzetteknek való elküldés sikeretelen volt';
$lang['hu_HU']['Newsletter_SentStatusReport.ss']['SENTOK'] = 'Az üzenetküldés a következő címzetteknek sikeres volt';
$lang['hu_HU']['Newsletter_SentStatusReport.ss']['SN'] = 'Családi név';

?>