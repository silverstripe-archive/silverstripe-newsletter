<?php

/**
 * Slovak (Slovakia) language pack
 * @package modules: newsletter
 * @subpackage i18n
 */

i18n::include_locale_file('modules: newsletter', 'en_US');

global $lang;

if(array_key_exists('sk_SK', $lang) && is_array($lang['sk_SK'])) {
	$lang['sk_SK'] = array_merge($lang['en_US'], $lang['sk_SK']);
} else {
	$lang['sk_SK'] = $lang['en_US'];
}

$lang['sk_SK']['LeftAndMain']['NEWSLETTERS'] = 'Newsletters';
$lang['sk_SK']['NewsletterAdmin']['FROMEM'] = 'Z e-mailovej adresy';
$lang['sk_SK']['NewsletterAdmin']['MEWDRAFTMEWSL'] = 'Nový návrh newsletter-a';
$lang['sk_SK']['NewsletterAdmin']['NEWLIST'] = 'Nový mailing list';
$lang['sk_SK']['NewsletterAdmin']['NEWNEWSLTYPE'] = 'Nový typ newsletter-a';
$lang['sk_SK']['NewsletterAdmin']['NEWSLTYPE'] = 'Typ Newsletter-a';
$lang['sk_SK']['NewsletterAdmin']['PLEASEENTERMAIL'] = 'Prosím zadajte e-mailovú adresu';
$lang['sk_SK']['NewsletterAdmin']['RESEND'] = 'Poslať znovu';
$lang['sk_SK']['NewsletterAdmin']['SAVE'] = 'Uložiť';
$lang['sk_SK']['NewsletterAdmin']['SAVED'] = 'Uložené';
$lang['sk_SK']['NewsletterAdmin']['SEND'] = 'Poslať...';
$lang['sk_SK']['NewsletterAdmin']['SENDING'] = 'Posielam e-maily...';
$lang['sk_SK']['NewsletterAdmin']['SENTTESTTO'] = 'Poslať test pre';
$lang['sk_SK']['NewsletterAdmin']['SHOWCONTENTS'] = 'Ukázať obsah';
$lang['sk_SK']['NewsletterAdmin_BouncedList.ss']['EMADD'] = 'E-mailová adresa';
$lang['sk_SK']['NewsletterAdmin_BouncedList.ss']['HAVEBOUNCED'] = 'E-maily, ktoré nebolo možné odoslať';
$lang['sk_SK']['NewsletterAdmin_BouncedList.ss']['NOBOUNCED'] = 'Všetky e-maily boli úspečne odoslané.';
$lang['sk_SK']['NewsletterAdmin_BouncedList.ss']['UNAME'] = 'Používateľské meno';
$lang['sk_SK']['NewsletterAdmin_left.ss']['ADDDRAFT'] = 'Pridať nový návrh';
$lang['sk_SK']['NewsletterAdmin_left.ss']['ADDTYPE'] = 'Pridať nový typ';
$lang['sk_SK']['NewsletterAdmin_left.ss']['CREATE'] = 'Vytvoriť';
$lang['sk_SK']['NewsletterAdmin_left.ss']['DEL'] = 'Vymazať';
$lang['sk_SK']['NewsletterAdmin_left.ss']['DELETEDRAFTS'] = 'Vymazať vybrané návrhy';
$lang['sk_SK']['NewsletterAdmin_left.ss']['GO'] = 'Vykonať';
$lang['sk_SK']['NewsletterAdmin_left.ss']['NEWSLETTERS'] = 'Newsletters';
$lang['sk_SK']['NewsletterAdmin_left.ss']['SELECTDRAFTS'] = 'Vyberte návrhy, ktoré chcete vymazať a potom kliknite na tlačidlo nižšie';
$lang['sk_SK']['NewsletterAdmin_right.ss']['CANCEL'] = 'Zrušiť';
$lang['sk_SK']['NewsletterAdmin_right.ss']['ENTIRE'] = 'Poslať všetkým členom mailing listu';
$lang['sk_SK']['NewsletterAdmin_right.ss']['ONLYNOT'] = 'Poslať iba ľuďom, ktorým predtým nebolo poslané';
$lang['sk_SK']['NewsletterAdmin_right.ss']['SEND'] = 'Poslať newsletter';
$lang['sk_SK']['NewsletterAdmin_right.ss']['SENDTEST'] = 'Poslať test pre';
$lang['sk_SK']['NewsletterAdmin_right.ss']['WELCOME1'] = 'Vitajte v';
$lang['sk_SK']['NewsletterAdmin_right.ss']['WELCOME2'] = 'sekcii administrácie newsletter-u. Prosím vyberte si adresár zľava.';
$lang['sk_SK']['NewsletterAdmin_SiteTree.ss']['DRAFTS'] = 'Návrhy';
$lang['sk_SK']['NewsletterAdmin_SiteTree.ss']['MAILLIST'] = 'Mailing list';
$lang['sk_SK']['NewsletterAdmin_SiteTree.ss']['SENT'] = 'Poslané položky';
$lang['sk_SK']['NewsletterAdmin_UnsubscribedList.ss']['NOUNSUB'] = 'Žiadni používatelia sa neodhlásili z príjmu tohto newsletter-a.';
$lang['sk_SK']['NewsletterAdmin_UnsubscribedList.ss']['UNAME'] = 'Používateľské meno';
$lang['sk_SK']['NewsletterAdmin_UnsubscribedList.ss']['UNSUBON'] = 'Odhlásený z';
$lang['sk_SK']['NewsletterList.ss']['CHOOSEDRAFT1'] = 'Prosím, vyberte si návrh zľava alebo';
$lang['sk_SK']['NewsletterList.ss']['CHOOSEDRAFT2'] = 'jeden pridajte';
$lang['sk_SK']['NewsletterList.ss']['CHOOSESENT'] = 'Prosím vyberte si poslanú položku zľava';
$lang['sk_SK']['Newsletter_RecipientImportField.ss']['CHANGED'] = 'Počet zmenených detailov:';
$lang['sk_SK']['Newsletter_RecipientImportField.ss']['IMPORTED'] = 'Noví importovaní členovia:';
$lang['sk_SK']['Newsletter_RecipientImportField.ss']['IMPORTNEW'] = 'Importovaní noví členovia';
$lang['sk_SK']['Newsletter_RecipientImportField.ss']['SEC'] = 'sekundy';
$lang['sk_SK']['Newsletter_RecipientImportField.ss']['SKIPPED'] = 'Preskočené záznamy:';
$lang['sk_SK']['Newsletter_RecipientImportField.ss']['TIME'] = 'Potrebný čas:';
$lang['sk_SK']['Newsletter_RecipientImportField.ss']['UPDATED'] = 'Aktualizovaní členovia:';
$lang['sk_SK']['Newsletter_RecipientImportField_Table.ss']['CONTENTSOF'] = 'Obsah';
$lang['sk_SK']['Newsletter_RecipientImportField_Table.ss']['NO'] = 'Zrušiť';
$lang['sk_SK']['Newsletter_RecipientImportField_Table.ss']['RECIMPORTED'] = 'Príjemcovia importovaní z';
$lang['sk_SK']['Newsletter_RecipientImportField_Table.ss']['YES'] = 'Potvrdiť';
$lang['sk_SK']['Newsletter_SentStatusReport.ss']['DATE'] = 'Dátum';
$lang['sk_SK']['Newsletter_SentStatusReport.ss']['EMAIL'] = 'E-mailová adresa';
$lang['sk_SK']['Newsletter_SentStatusReport.ss']['FN'] = 'Krstné meno';
$lang['sk_SK']['Newsletter_SentStatusReport.ss']['NEWSNEVERSENT'] = 'Nasledujúcim odoberateľom nebol ešte nikdy zaslaný newsletter';
$lang['sk_SK']['Newsletter_SentStatusReport.ss']['RES'] = 'Výsledok';
$lang['sk_SK']['Newsletter_SentStatusReport.ss']['SENDBOUNCED'] = 'Posielanie nasledujúcim príjemcom zlyhalo.';
$lang['sk_SK']['Newsletter_SentStatusReport.ss']['SENDFAIL'] = 'Odoslanie nasledujúcim príjemcom zlyhalo';
$lang['sk_SK']['Newsletter_SentStatusReport.ss']['SENTOK'] = 'Odoslanie nasledujúcim príjemcom bolo úspešné';
$lang['sk_SK']['Newsletter_SentStatusReport.ss']['SN'] = 'Priezvisko';

?>