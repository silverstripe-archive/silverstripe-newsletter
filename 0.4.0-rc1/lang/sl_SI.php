<?php

/**
 * Slovenian (Slovenia) language pack
 * @package modules: newsletter
 * @subpackage i18n
 */

i18n::include_locale_file('modules: newsletter', 'en_US');

global $lang;

if(array_key_exists('sl_SI', $lang) && is_array($lang['sl_SI'])) {
	$lang['sl_SI'] = array_merge($lang['en_US'], $lang['sl_SI']);
} else {
	$lang['sl_SI'] = $lang['en_US'];
}

$lang['sl_SI']['LeftAndMain']['NEWSLETTERS'] = 'Okrožnice';
$lang['sl_SI']['NewsletterAdmin']['FROMEM'] = 'Od e-poštni naslov';
$lang['sl_SI']['NewsletterAdmin']['MEWDRAFTMEWSL'] = 'Nova neobjavljena okrožnica';
$lang['sl_SI']['NewsletterAdmin']['NEWLIST'] = 'Nov poštni seznam';
$lang['sl_SI']['NewsletterAdmin']['NEWNEWSLTYPE'] = 'Nov tip okrožnice';
$lang['sl_SI']['NewsletterAdmin']['NEWSLTYPE'] = 'Tip Okrožnice';
$lang['sl_SI']['NewsletterAdmin']['PLEASEENTERMAIL'] = 'Prosim vpišite e-poštni naslov';
$lang['sl_SI']['NewsletterAdmin']['RESEND'] = 'Ponovno pošlji';
$lang['sl_SI']['NewsletterAdmin']['SAVE'] = 'Shrani';
$lang['sl_SI']['NewsletterAdmin']['SAVED'] = 'Shranjeno';
$lang['sl_SI']['NewsletterAdmin']['SEND'] = 'Pošlji...';
$lang['sl_SI']['NewsletterAdmin']['SENDING'] = 'Pošiljam e-pošte...';
$lang['sl_SI']['NewsletterAdmin']['SENTTESTTO'] = 'Pošlji test na';
$lang['sl_SI']['NewsletterAdmin']['SHOWCONTENTS'] = 'Pokaži vsebine';
$lang['sl_SI']['NewsletterAdmin_BouncedList.ss']['EMADD'] = 'E-poštni naslov';
$lang['sl_SI']['NewsletterAdmin_BouncedList.ss']['HAVEBOUNCED'] = 'E-pošte, ki so se odbile';
$lang['sl_SI']['NewsletterAdmin_BouncedList.ss']['NOBOUNCED'] = 'Nobeno e-poštno sporočilo se ni odbilo.';
$lang['sl_SI']['NewsletterAdmin_BouncedList.ss']['UNAME'] = 'Uporabniško ime';
$lang['sl_SI']['NewsletterAdmin_left.ss']['ADDDRAFT'] = 'Dodaj novo predlogo';
$lang['sl_SI']['NewsletterAdmin_left.ss']['ADDTYPE'] = 'Dodaj nov tip';
$lang['sl_SI']['NewsletterAdmin_left.ss']['CREATE'] = 'Ustvari';
$lang['sl_SI']['NewsletterAdmin_left.ss']['DEL'] = 'Izbriši';
$lang['sl_SI']['NewsletterAdmin_left.ss']['DELETEDRAFTS'] = 'Izbriši izbrane predloge';
$lang['sl_SI']['NewsletterAdmin_left.ss']['GO'] = 'Pojdi';
$lang['sl_SI']['NewsletterAdmin_left.ss']['NEWSLETTERS'] = 'Okrožnice';
$lang['sl_SI']['NewsletterAdmin_left.ss']['SELECTDRAFTS'] = 'Izberi predloge, ki jih želiš izbrisati ter klikni gumb spodaj';
$lang['sl_SI']['NewsletterAdmin_right.ss']['CANCEL'] = 'Prekliči';
$lang['sl_SI']['NewsletterAdmin_right.ss']['ENTIRE'] = 'Pošlji celotnemu e-poštnemu seznamu';
$lang['sl_SI']['NewsletterAdmin_right.ss']['ONLYNOT'] = 'Pošlji samo ljudem, katerim prej ni bilo poslano';
$lang['sl_SI']['NewsletterAdmin_right.ss']['SEND'] = 'Pošlji okrožnico';
$lang['sl_SI']['NewsletterAdmin_right.ss']['SENDTEST'] = 'Pošlji test na';
$lang['sl_SI']['NewsletterAdmin_right.ss']['WELCOME1'] = 'Dobrodošli na';
$lang['sl_SI']['NewsletterAdmin_right.ss']['WELCOME2'] = 'sekciji "okrožnice". Prosim izberite mapo na desni strani.';
$lang['sl_SI']['NewsletterAdmin_SiteTree.ss']['DRAFTS'] = 'Predloge';
$lang['sl_SI']['NewsletterAdmin_SiteTree.ss']['MAILLIST'] = 'E-poštni Seznam';
$lang['sl_SI']['NewsletterAdmin_SiteTree.ss']['SENT'] = 'Poslane Zadeve';
$lang['sl_SI']['NewsletterAdmin_UnsubscribedList.ss']['NOUNSUB'] = 'Noben uporabnik se ni odjavil od te okrožnice.';
$lang['sl_SI']['NewsletterAdmin_UnsubscribedList.ss']['UNAME'] = 'Uporabniško Ime';
$lang['sl_SI']['NewsletterAdmin_UnsubscribedList.ss']['UNSUBON'] = 'Odjavljeni od';
$lang['sl_SI']['NewsletterList.ss']['CHOOSEDRAFT1'] = 'Prosim izberi predlogo na levi, ali';
$lang['sl_SI']['NewsletterList.ss']['CHOOSEDRAFT2'] = 'dodaj eno';
$lang['sl_SI']['NewsletterList.ss']['CHOOSESENT'] = 'Prosim izberi poslano zadevo na levi.';
$lang['sl_SI']['Newsletter_RecipientImportField.ss']['CHANGED'] = 'Število spremenjenih detajlov:';
$lang['sl_SI']['Newsletter_RecipientImportField.ss']['IMPORTED'] = 'Uvoženi novi člani:';
$lang['sl_SI']['Newsletter_RecipientImportField.ss']['IMPORTNEW'] = 'Uvoženi novi člani.';
$lang['sl_SI']['Newsletter_RecipientImportField.ss']['SEC'] = 'sekund';
$lang['sl_SI']['Newsletter_RecipientImportField.ss']['SKIPPED'] = 'Preskočenih zapisov:';
$lang['sl_SI']['Newsletter_RecipientImportField.ss']['TIME'] = 'Čas trajanja:';
$lang['sl_SI']['Newsletter_RecipientImportField.ss']['UPDATED'] = 'Posodobljeni člani:';
$lang['sl_SI']['Newsletter_RecipientImportField_Table.ss']['CONTENTSOF'] = 'Vsebine od';
$lang['sl_SI']['Newsletter_RecipientImportField_Table.ss']['NO'] = 'Prekliči';
$lang['sl_SI']['Newsletter_RecipientImportField_Table.ss']['RECIMPORTED'] = 'Prejemniki uvoženi iz';
$lang['sl_SI']['Newsletter_RecipientImportField_Table.ss']['YES'] = 'Potrdi';
$lang['sl_SI']['Newsletter_SentStatusReport.ss']['DATE'] = 'Datum';
$lang['sl_SI']['Newsletter_SentStatusReport.ss']['EMAIL'] = 'E-pošta';
$lang['sl_SI']['Newsletter_SentStatusReport.ss']['FN'] = 'Ime';
$lang['sl_SI']['Newsletter_SentStatusReport.ss']['NEWSNEVERSENT'] = 'Okrožnica ni bila nikoli poslana naslednjim naročnikom';
$lang['sl_SI']['Newsletter_SentStatusReport.ss']['RES'] = 'Rezultat';
$lang['sl_SI']['Newsletter_SentStatusReport.ss']['SENDBOUNCED'] = 'Pošiljanje naslednjim prejemnikom se je odbilo';
$lang['sl_SI']['Newsletter_SentStatusReport.ss']['SENDFAIL'] = 'Pošiljanje naslednjim prejemnikom ni uspelo';
$lang['sl_SI']['Newsletter_SentStatusReport.ss']['SENTOK'] = 'Pošiljanje naslednjim prejemnikom je bilo uspešno';
$lang['sl_SI']['Newsletter_SentStatusReport.ss']['SN'] = 'Priimek';

?>