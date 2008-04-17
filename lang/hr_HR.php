<?php

/**
 * Croatian (Croatia) language pack
 * @package modules: newsletter
 * @subpackage i18n
 */

i18n::include_locale_file('modules: newsletter', 'en_US');

global $lang;

if(array_key_exists('hr_HR', $lang) && is_array($lang['hr_HR'])) {
	$lang['hr_HR'] = array_merge($lang['en_US'], $lang['hr_HR']);
} else {
	$lang['hr_HR'] = $lang['en_US'];
}

$lang['hr_HR']['LeftAndMain']['NEWSLETTERS'] = 'Newsletters';
$lang['hr_HR']['NewsletterAdmin']['FROMEM'] = 'Od (email adresa)';
$lang['hr_HR']['NewsletterAdmin']['MEWDRAFTMEWSL'] = 'Novi privremeni (draft) newsletter';
$lang['hr_HR']['NewsletterAdmin']['NEWLIST'] = 'Nova mailing lista';
$lang['hr_HR']['NewsletterAdmin']['NEWNEWSLTYPE'] = 'Nova vrsta newslettera';
$lang['hr_HR']['NewsletterAdmin']['NEWSLTYPE'] = 'Vrsta newslettera';
$lang['hr_HR']['NewsletterAdmin']['PLEASEENTERMAIL'] = 'Molim upišite email adresu';
$lang['hr_HR']['NewsletterAdmin']['RESEND'] = 'Pošalji ponovo';
$lang['hr_HR']['NewsletterAdmin']['SAVE'] = 'Spremi';
$lang['hr_HR']['NewsletterAdmin']['SAVED'] = 'Spremljeno';
$lang['hr_HR']['NewsletterAdmin']['SEND'] = 'Pošalji...';
$lang['hr_HR']['NewsletterAdmin']['SENDING'] = 'Slanje emailova....';
$lang['hr_HR']['NewsletterAdmin']['SENTTESTTO'] = 'Pošalji test na';
$lang['hr_HR']['NewsletterAdmin']['SHOWCONTENTS'] = 'Pokaži sadrćaj';
$lang['hr_HR']['NewsletterAdmin_BouncedList.ss']['EMADD'] = 'Email adresa';
$lang['hr_HR']['NewsletterAdmin_BouncedList.ss']['HAVEBOUNCED'] = 'Emailovi koji odskaču';
$lang['hr_HR']['NewsletterAdmin_BouncedList.ss']['NOBOUNCED'] = 'No emails sent have bounced.';
$lang['hr_HR']['NewsletterAdmin_BouncedList.ss']['UNAME'] = 'Korisničko ime';
$lang['hr_HR']['NewsletterAdmin_left.ss']['ADDDRAFT'] = 'Add new draft';
$lang['hr_HR']['NewsletterAdmin_left.ss']['ADDTYPE'] = 'Dodaj novu vrstu';
$lang['hr_HR']['NewsletterAdmin_left.ss']['CREATE'] = 'Stvori';
$lang['hr_HR']['NewsletterAdmin_left.ss']['DEL'] = 'Obriši';
$lang['hr_HR']['NewsletterAdmin_left.ss']['DELETEDRAFTS'] = 'Obrišite označene';
$lang['hr_HR']['NewsletterAdmin_left.ss']['GO'] = 'Idi';
$lang['hr_HR']['NewsletterAdmin_left.ss']['NEWSLETTERS'] = 'Newsletteri';
$lang['hr_HR']['NewsletterAdmin_left.ss']['SELECTDRAFTS'] = 'Označite koje želite obrisati i kliknite gumb ispod';
$lang['hr_HR']['NewsletterAdmin_right.ss']['CANCEL'] = 'Otkaži';
$lang['hr_HR']['NewsletterAdmin_right.ss']['ENTIRE'] = 'Pošalji cijeloj mailing listi ';
$lang['hr_HR']['NewsletterAdmin_right.ss']['ONLYNOT'] = 'Pošalji samo korisnicima kojima prethodno nije poslano';
$lang['hr_HR']['NewsletterAdmin_right.ss']['SEND'] = 'Pošalji newsletter';
$lang['hr_HR']['NewsletterAdmin_right.ss']['SENDTEST'] = 'Pošalji test na';
$lang['hr_HR']['NewsletterAdmin_right.ss']['WELCOME1'] = 'Dobrodošli na';
$lang['hr_HR']['NewsletterAdmin_right.ss']['WELCOME2'] = 'administraciju newslettera. Odaberite direktorij s lijeve strane.
';
$lang['hr_HR']['NewsletterAdmin_SiteTree.ss']['DRAFTS'] = 'Privremeni';
$lang['hr_HR']['NewsletterAdmin_SiteTree.ss']['MAILLIST'] = 'Mailing liste';
$lang['hr_HR']['NewsletterAdmin_SiteTree.ss']['SENT'] = 'Poslani';
$lang['hr_HR']['NewsletterAdmin_UnsubscribedList.ss']['NOUNSUB'] = 'Nema odjavljenih korisnika sa ovog newslettera';
$lang['hr_HR']['NewsletterAdmin_UnsubscribedList.ss']['UNAME'] = 'Korisničko ime';
$lang['hr_HR']['NewsletterAdmin_UnsubscribedList.ss']['UNSUBON'] = 'Odjavljen ';
$lang['hr_HR']['NewsletterList.ss']['CHOOSEDRAFT1'] = 'Odaberite draft s lijeve strane ili';
$lang['hr_HR']['NewsletterList.ss']['CHOOSEDRAFT2'] = 'dodajte novi';
$lang['hr_HR']['NewsletterList.ss']['CHOOSESENT'] = 'Odaberite poslano s lijeve strane';
$lang['hr_HR']['Newsletter_RecipientImportField.ss']['CHANGED'] = 'Broj promjenjenih detalja:';
$lang['hr_HR']['Newsletter_RecipientImportField.ss']['IMPORTED'] = 'Novi uzeveni članovi:';
$lang['hr_HR']['Newsletter_RecipientImportField.ss']['IMPORTNEW'] = '\'Uvezeni\' novi članovi';
$lang['hr_HR']['Newsletter_RecipientImportField.ss']['SEC'] = 'sekundi';
$lang['hr_HR']['Newsletter_RecipientImportField.ss']['SKIPPED'] = 'Preskočeno zapisa:';
$lang['hr_HR']['Newsletter_RecipientImportField.ss']['TIME'] = 'Oduzeto vrijeme:';
$lang['hr_HR']['Newsletter_RecipientImportField.ss']['UPDATED'] = 'Ažurirani članovi:';
$lang['hr_HR']['Newsletter_RecipientImportField_Table.ss']['CONTENTSOF'] = 'Sadržaj';
$lang['hr_HR']['Newsletter_RecipientImportField_Table.ss']['NO'] = 'Otkaži';
$lang['hr_HR']['Newsletter_RecipientImportField_Table.ss']['RECIMPORTED'] = 'Primatelji uvezeni iz';
$lang['hr_HR']['Newsletter_RecipientImportField_Table.ss']['YES'] = 'Odobri';
$lang['hr_HR']['Newsletter_SentStatusReport.ss']['DATE'] = 'Datum';
$lang['hr_HR']['Newsletter_SentStatusReport.ss']['EMAIL'] = 'Email';
$lang['hr_HR']['Newsletter_SentStatusReport.ss']['FN'] = 'Ime';
$lang['hr_HR']['Newsletter_SentStatusReport.ss']['NEWSNEVERSENT'] = 'Newsletter nikada nije poslan slijedećim pretplatnicima';
$lang['hr_HR']['Newsletter_SentStatusReport.ss']['RES'] = 'Rezultat';
$lang['hr_HR']['Newsletter_SentStatusReport.ss']['SENDBOUNCED'] = 'Slanje slijedećim primateljima je odbijeno:';
$lang['hr_HR']['Newsletter_SentStatusReport.ss']['SENDFAIL'] = 'Slanje slijedećim primateljima nije uspjelo';
$lang['hr_HR']['Newsletter_SentStatusReport.ss']['SENTOK'] = 'Slanje slijedećim primateljima je uspješno';
$lang['hr_HR']['Newsletter_SentStatusReport.ss']['SN'] = 'Prezime';

?>