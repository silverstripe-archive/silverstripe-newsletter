<?php

/**
 * Bosnian (Bosnia and Herzegovina) language pack
 * @package modules: newsletter
 * @subpackage i18n
 */

i18n::include_locale_file('modules: newsletter', 'en_US');

global $lang;

if(array_key_exists('bs_BA', $lang) && is_array($lang['bs_BA'])) {
	$lang['bs_BA'] = array_merge($lang['en_US'], $lang['bs_BA']);
} else {
	$lang['bs_BA'] = $lang['en_US'];
}

$lang['bs_BA']['LeftAndMain']['NEWSLETTERS'] = 'Novinske brošure';
$lang['bs_BA']['NewsletterAdmin']['FROMEM'] = 'Od (e-mail adresa)';
$lang['bs_BA']['NewsletterAdmin']['MEWDRAFTMEWSL'] = 'Novi privremeni nacrt novinske brošure';
$lang['bs_BA']['NewsletterAdmin']['NEWLIST'] = 'Nova e-mail lista';
$lang['bs_BA']['NewsletterAdmin']['NEWNEWSLTYPE'] = 'Novi tip novinske brošure';
$lang['bs_BA']['NewsletterAdmin']['NEWSLTYPE'] = 'Tip novinske brošure';
$lang['bs_BA']['NewsletterAdmin']['PLEASEENTERMAIL'] = 'Molimo, unesite e-mail adresu';
$lang['bs_BA']['NewsletterAdmin']['RESEND'] = 'Pošalji ponovo';
$lang['bs_BA']['NewsletterAdmin']['SAVE'] = 'Snimi';
$lang['bs_BA']['NewsletterAdmin']['SAVED'] = 'Snimljeno';
$lang['bs_BA']['NewsletterAdmin']['SEND'] = 'Pošalji...';
$lang['bs_BA']['NewsletterAdmin']['SENDING'] = 'Slanje e-mail poruka...';
$lang['bs_BA']['NewsletterAdmin']['SENTTESTTO'] = 'Test poslan na';
$lang['bs_BA']['NewsletterAdmin']['SHOWCONTENTS'] = 'Prikaži sadržaj';
$lang['bs_BA']['NewsletterAdmin_BouncedList.ss']['EMADD'] = 'E-mail adresa';
$lang['bs_BA']['NewsletterAdmin_BouncedList.ss']['HAVEBOUNCED'] = 'E-mail poruke koje su vraćene';
$lang['bs_BA']['NewsletterAdmin_BouncedList.ss']['NOBOUNCED'] = 'Nijedna poslana poruka nije vraćena.';
$lang['bs_BA']['NewsletterAdmin_BouncedList.ss']['UNAME'] = 'Korisničko ime';
$lang['bs_BA']['NewsletterAdmin_left.ss']['ADDDRAFT'] = 'Dodaj novi nacrt';
$lang['bs_BA']['NewsletterAdmin_left.ss']['ADDTYPE'] = 'Dodaj novi tip';
$lang['bs_BA']['NewsletterAdmin_left.ss']['CREATE'] = 'Kreiraj';
$lang['bs_BA']['NewsletterAdmin_left.ss']['DEL'] = 'Izbriši';
$lang['bs_BA']['NewsletterAdmin_left.ss']['DELETEDRAFTS'] = 'Izbriši izabrane nacrte';
$lang['bs_BA']['NewsletterAdmin_left.ss']['GO'] = 'Idi';
$lang['bs_BA']['NewsletterAdmin_left.ss']['NEWSLETTERS'] = 'Novinske brošure';
$lang['bs_BA']['NewsletterAdmin_left.ss']['SELECTDRAFTS'] = 'Izbertie nacrte koje želite izbrisati i kliknite na tipku ispod';
$lang['bs_BA']['NewsletterAdmin_right.ss']['CANCEL'] = 'Poništi';
$lang['bs_BA']['NewsletterAdmin_right.ss']['ENTIRE'] = 'Pošalji na cijelu e-mail listu';
$lang['bs_BA']['NewsletterAdmin_right.ss']['ONLYNOT'] = 'Pošalji samo korisnicima kojima prethodno nije poslano';
$lang['bs_BA']['NewsletterAdmin_right.ss']['SEND'] = 'Pošalji novinsku brošuru';
$lang['bs_BA']['NewsletterAdmin_right.ss']['SENDTEST'] = 'Pošalji test na';
$lang['bs_BA']['NewsletterAdmin_right.ss']['WELCOME1'] = 'Dobrodošli u';
$lang['bs_BA']['NewsletterAdmin_right.ss']['WELCOME2'] = 'administracijski odjel za novinske brošure. Molimo, izaberite direktorij sa lijeve strane.';
$lang['bs_BA']['NewsletterAdmin_SiteTree.ss']['DRAFTS'] = 'Nacrti';
$lang['bs_BA']['NewsletterAdmin_SiteTree.ss']['MAILLIST'] = 'E-mail lista';
$lang['bs_BA']['NewsletterAdmin_SiteTree.ss']['SENT'] = 'Poslane stavke';
$lang['bs_BA']['NewsletterAdmin_UnsubscribedList.ss']['NOUNSUB'] = 'Nijedan korisnik nije otkazao pretplatu za ovu novinsku brošuru.';
$lang['bs_BA']['NewsletterAdmin_UnsubscribedList.ss']['UNAME'] = 'Korisničko ime';
$lang['bs_BA']['NewsletterAdmin_UnsubscribedList.ss']['UNSUBON'] = 'Otkazana pretplata na';
$lang['bs_BA']['NewsletterList.ss']['CHOOSEDRAFT1'] = 'Molimo, izaberite nacrt sa lijeve strane, ili';
$lang['bs_BA']['NewsletterList.ss']['CHOOSEDRAFT2'] = 'dodajte novi';
$lang['bs_BA']['NewsletterList.ss']['CHOOSESENT'] = 'Molimo, izaberite poslanu stavku sa lijeve strane.';
$lang['bs_BA']['Newsletter_RecipientImportField.ss']['CHANGED'] = 'Broj promijenjenih detalja:';
$lang['bs_BA']['Newsletter_RecipientImportField.ss']['IMPORTED'] = 'Novi uvezeni članovi:';
$lang['bs_BA']['Newsletter_RecipientImportField.ss']['IMPORTNEW'] = 'Uvezeni novi članovi';
$lang['bs_BA']['Newsletter_RecipientImportField.ss']['SEC'] = 'sekundi';
$lang['bs_BA']['Newsletter_RecipientImportField.ss']['SKIPPED'] = 'Preskočeni zapisi:';
$lang['bs_BA']['Newsletter_RecipientImportField.ss']['TIME'] = 'Oduzeto vrijeme:';
$lang['bs_BA']['Newsletter_RecipientImportField.ss']['UPDATED'] = 'Ažurirani članovi:';
$lang['bs_BA']['Newsletter_RecipientImportField_Table.ss']['CONTENTSOF'] = 'Sadržaj';
$lang['bs_BA']['Newsletter_RecipientImportField_Table.ss']['NO'] = 'Poništi';
$lang['bs_BA']['Newsletter_RecipientImportField_Table.ss']['RECIMPORTED'] = 'Primaoci uvezeni iz';
$lang['bs_BA']['Newsletter_RecipientImportField_Table.ss']['YES'] = 'Potvrdi';
$lang['bs_BA']['Newsletter_SentStatusReport.ss']['DATE'] = 'Datum';
$lang['bs_BA']['Newsletter_SentStatusReport.ss']['EMAIL'] = 'E-mail';
$lang['bs_BA']['Newsletter_SentStatusReport.ss']['FN'] = 'Ime';
$lang['bs_BA']['Newsletter_SentStatusReport.ss']['NEWSNEVERSENT'] = 'Novinska brošura nikada nije poslana slijedećim pretplatnicima';
$lang['bs_BA']['Newsletter_SentStatusReport.ss']['RES'] = 'Rezultat';
$lang['bs_BA']['Newsletter_SentStatusReport.ss']['SENDBOUNCED'] = 'Slanje slijedećim primaocima je odbijeno';
$lang['bs_BA']['Newsletter_SentStatusReport.ss']['SENDFAIL'] = 'Slanje slijedećim primaocima nije uspjelo';
$lang['bs_BA']['Newsletter_SentStatusReport.ss']['SENTOK'] = 'Slanje slijedećim primaocima je uspješno';
$lang['bs_BA']['Newsletter_SentStatusReport.ss']['SN'] = 'Prezime';

?>