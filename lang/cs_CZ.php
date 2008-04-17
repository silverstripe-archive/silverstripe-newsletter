<?php

/**
 * Czech (Czech Republic) language pack
 * @package modules: newsletter
 * @subpackage i18n
 */

i18n::include_locale_file('modules: newsletter', 'en_US');

global $lang;

if(array_key_exists('cs_CZ', $lang) && is_array($lang['cs_CZ'])) {
	$lang['cs_CZ'] = array_merge($lang['en_US'], $lang['cs_CZ']);
} else {
	$lang['cs_CZ'] = $lang['en_US'];
}

$lang['cs_CZ']['LeftAndMain']['NEWSLETTERS'] = 'Newsletter';
$lang['cs_CZ']['NewsletterAdmin']['FROMEM'] = 'Z emailové adresy';
$lang['cs_CZ']['NewsletterAdmin']['MEWDRAFTMEWSL'] = 'Nový koncept newsletteru';
$lang['cs_CZ']['NewsletterAdmin']['NEWLIST'] = 'Nový mailing list';
$lang['cs_CZ']['NewsletterAdmin']['NEWNEWSLTYPE'] = 'Nový typ newsletteru';
$lang['cs_CZ']['NewsletterAdmin']['NEWSLTYPE'] = 'Typ newsletteru';
$lang['cs_CZ']['NewsletterAdmin']['PLEASEENTERMAIL'] = 'Prosím zadejte emailovou adresu';
$lang['cs_CZ']['NewsletterAdmin']['RESEND'] = 'Znovu poslat';
$lang['cs_CZ']['NewsletterAdmin']['SAVE'] = 'Uložit';
$lang['cs_CZ']['NewsletterAdmin']['SAVED'] = 'Uloženo';
$lang['cs_CZ']['NewsletterAdmin']['SEND'] = 'Poslat...';
$lang['cs_CZ']['NewsletterAdmin']['SENDING'] = 'Posílám emaily...';
$lang['cs_CZ']['NewsletterAdmin']['SENTTESTTO'] = 'Test poslán';
$lang['cs_CZ']['NewsletterAdmin']['SHOWCONTENTS'] = 'Zobrazit obsah';
$lang['cs_CZ']['NewsletterAdmin_BouncedList.ss']['EMADD'] = 'Emailová adresa';
$lang['cs_CZ']['NewsletterAdmin_BouncedList.ss']['HAVEBOUNCED'] = 'Emaily, které nebylo možné odeslat';
$lang['cs_CZ']['NewsletterAdmin_BouncedList.ss']['NOBOUNCED'] = 'Všechny emaily byly úspěšně odeslány.';
$lang['cs_CZ']['NewsletterAdmin_BouncedList.ss']['UNAME'] = 'Uživatelské jméno';
$lang['cs_CZ']['NewsletterAdmin_left.ss']['ADDDRAFT'] = 'Přidat nový koncept';
$lang['cs_CZ']['NewsletterAdmin_left.ss']['ADDTYPE'] = 'Přidat nový typ';
$lang['cs_CZ']['NewsletterAdmin_left.ss']['CREATE'] = 'Vytvořit';
$lang['cs_CZ']['NewsletterAdmin_left.ss']['DEL'] = 'Smazat';
$lang['cs_CZ']['NewsletterAdmin_left.ss']['DELETEDRAFTS'] = 'Smazat vybrané koncepty';
$lang['cs_CZ']['NewsletterAdmin_left.ss']['GO'] = 'Proveď';
$lang['cs_CZ']['NewsletterAdmin_left.ss']['NEWSLETTERS'] = 'Newslettery';
$lang['cs_CZ']['NewsletterAdmin_left.ss']['SELECTDRAFTS'] = 'Vyberte koncepty, které chcete smazat. Pak klikněte na tlačítko níže';
$lang['cs_CZ']['NewsletterAdmin_right.ss']['CANCEL'] = 'Zrušit';
$lang['cs_CZ']['NewsletterAdmin_right.ss']['ENTIRE'] = 'Zaslat celému mailing listu';
$lang['cs_CZ']['NewsletterAdmin_right.ss']['ONLYNOT'] = 'Zaslat jen lidem, kteří zprávu předtím nedostali';
$lang['cs_CZ']['NewsletterAdmin_right.ss']['SEND'] = 'Zaslat newsletter';
$lang['cs_CZ']['NewsletterAdmin_right.ss']['SENDTEST'] = 'Test poslán';
$lang['cs_CZ']['NewsletterAdmin_right.ss']['WELCOME1'] = 'Vítejte v';
$lang['cs_CZ']['NewsletterAdmin_right.ss']['WELCOME2'] = 'sekci administrace novinek. Prosím vyberte složku vlevo.';
$lang['cs_CZ']['NewsletterAdmin_SiteTree.ss']['DRAFTS'] = 'Koncepty';
$lang['cs_CZ']['NewsletterAdmin_SiteTree.ss']['MAILLIST'] = 'Mailing list';
$lang['cs_CZ']['NewsletterAdmin_SiteTree.ss']['SENT'] = 'Poslané položky';
$lang['cs_CZ']['NewsletterAdmin_UnsubscribedList.ss']['NOUNSUB'] = 'Žádní uživatelé se neodhlásili z příjmu tohoto newsletteru.';
$lang['cs_CZ']['NewsletterAdmin_UnsubscribedList.ss']['UNAME'] = 'Uživateské jméno';
$lang['cs_CZ']['NewsletterAdmin_UnsubscribedList.ss']['UNSUBON'] = 'Odhlášen z';
$lang['cs_CZ']['NewsletterList.ss']['CHOOSEDRAFT1'] = 'Prosím vyberte koncept vlevo nebo';
$lang['cs_CZ']['NewsletterList.ss']['CHOOSEDRAFT2'] = 'přidejte nový';
$lang['cs_CZ']['NewsletterList.ss']['CHOOSESENT'] = 'Prosím vyberte zaslanou položku vlevo.';
$lang['cs_CZ']['Newsletter_RecipientImportField.ss']['CHANGED'] = 'Počet změněných detailů:';
$lang['cs_CZ']['Newsletter_RecipientImportField.ss']['IMPORTED'] = 'Noví importovaní členové:';
$lang['cs_CZ']['Newsletter_RecipientImportField.ss']['IMPORTNEW'] = 'Importováni noví členové';
$lang['cs_CZ']['Newsletter_RecipientImportField.ss']['SEC'] = 'vteřin';
$lang['cs_CZ']['Newsletter_RecipientImportField.ss']['SKIPPED'] = 'Záznamů přeskočeno:';
$lang['cs_CZ']['Newsletter_RecipientImportField.ss']['TIME'] = 'Čas:';
$lang['cs_CZ']['Newsletter_RecipientImportField.ss']['UPDATED'] = 'Aktualizovaní členové:';
$lang['cs_CZ']['Newsletter_RecipientImportField_Table.ss']['CONTENTSOF'] = 'Obsah';
$lang['cs_CZ']['Newsletter_RecipientImportField_Table.ss']['NO'] = 'Zrušit';
$lang['cs_CZ']['Newsletter_RecipientImportField_Table.ss']['RECIMPORTED'] = 'Příjemci importováni z';
$lang['cs_CZ']['Newsletter_RecipientImportField_Table.ss']['YES'] = 'Potvrdit';
$lang['cs_CZ']['Newsletter_SentStatusReport.ss']['DATE'] = 'Datum';
$lang['cs_CZ']['Newsletter_SentStatusReport.ss']['EMAIL'] = 'Email';
$lang['cs_CZ']['Newsletter_SentStatusReport.ss']['FN'] = 'Křestní jméno';
$lang['cs_CZ']['Newsletter_SentStatusReport.ss']['NEWSNEVERSENT'] = 'Následujícím odebíratelům nebyly nikdy zaslán newsletter';
$lang['cs_CZ']['Newsletter_SentStatusReport.ss']['RES'] = 'Výsledek';
$lang['cs_CZ']['Newsletter_SentStatusReport.ss']['SENDBOUNCED'] = 'Zaslání následujícím příjemcům selhalo';
$lang['cs_CZ']['Newsletter_SentStatusReport.ss']['SENDFAIL'] = 'Zaslání následujícím příjemců selhalo';
$lang['cs_CZ']['Newsletter_SentStatusReport.ss']['SENTOK'] = 'Zaslání následujícím příjemcům bylo úspěšné';
$lang['cs_CZ']['Newsletter_SentStatusReport.ss']['SN'] = 'Příjmení';

?>