<?php

/**
 * Norwegian Bokmal (Norway) language pack
 * @package modules: newsletter
 * @subpackage i18n
 */

i18n::include_locale_file('modules: newsletter', 'en_US');

global $lang;

if(array_key_exists('nb_NO', $lang) && is_array($lang['nb_NO'])) {
	$lang['nb_NO'] = array_merge($lang['en_US'], $lang['nb_NO']);
} else {
	$lang['nb_NO'] = $lang['en_US'];
}

$lang['nb_NO']['LeftAndMain']['NEWSLETTERS'] = 'Nyhetsbrev';
$lang['nb_NO']['NewsletterAdmin']['FROMEM'] = 'Fra epostadresse';
$lang['nb_NO']['NewsletterAdmin']['MEWDRAFTMEWSL'] = 'Ny brevkladd';
$lang['nb_NO']['NewsletterAdmin']['NEWLIST'] = 'Ny epostliste';
$lang['nb_NO']['NewsletterAdmin']['NEWNEWSLTYPE'] = 'Ny type nyhetsbrev';
$lang['nb_NO']['NewsletterAdmin']['NEWSLTYPE'] = 'Nyhetsbrev-type';
$lang['nb_NO']['NewsletterAdmin']['PLEASEENTERMAIL'] = 'Venligst skriv inn en epost-adresse';
$lang['nb_NO']['NewsletterAdmin']['RESEND'] = 'Send på nytt';
$lang['nb_NO']['NewsletterAdmin']['SAVE'] = 'Lagre';
$lang['nb_NO']['NewsletterAdmin']['SAVED'] = 'Lagret';
$lang['nb_NO']['NewsletterAdmin']['SEND'] = 'Send...';
$lang['nb_NO']['NewsletterAdmin']['SENDING'] = 'Sender eposter...';
$lang['nb_NO']['NewsletterAdmin']['SENTTESTTO'] = 'Sendt test til';
$lang['nb_NO']['NewsletterAdmin']['SHOWCONTENTS'] = 'Vis innhold';
$lang['nb_NO']['NewsletterAdmin_BouncedList.ss']['EMADD'] = 'Epost adresse';
$lang['nb_NO']['NewsletterAdmin_BouncedList.ss']['HAVEBOUNCED'] = 'Eposter som er avvist';
$lang['nb_NO']['NewsletterAdmin_BouncedList.ss']['NOBOUNCED'] = 'Ingen eposter som blir sendt er avvist.';
$lang['nb_NO']['NewsletterAdmin_BouncedList.ss']['UNAME'] = 'Brukernavn';
$lang['nb_NO']['NewsletterAdmin_left.ss']['ADDDRAFT'] = 'Opprett nytt utkast';
$lang['nb_NO']['NewsletterAdmin_left.ss']['ADDTYPE'] = 'Legg til ny type';
$lang['nb_NO']['NewsletterAdmin_left.ss']['CREATE'] = 'Opprett';
$lang['nb_NO']['NewsletterAdmin_left.ss']['DEL'] = 'Slett';
$lang['nb_NO']['NewsletterAdmin_left.ss']['DELETEDRAFTS'] = 'Slett markerte utkast';
$lang['nb_NO']['NewsletterAdmin_left.ss']['GO'] = 'Utfør';
$lang['nb_NO']['NewsletterAdmin_left.ss']['NEWSLETTERS'] = 'Nyhetsbrev';
$lang['nb_NO']['NewsletterAdmin_left.ss']['SELECTDRAFTS'] = 'Marker utkastene du vil slette og trykk på knappen under';
$lang['nb_NO']['NewsletterAdmin_right.ss']['CANCEL'] = 'Avbryt';
$lang['nb_NO']['NewsletterAdmin_right.ss']['ENTIRE'] = 'Send til hele epostlisten';
$lang['nb_NO']['NewsletterAdmin_right.ss']['ONLYNOT'] = 'Bare send til de som ikke har mottatt før';
$lang['nb_NO']['NewsletterAdmin_right.ss']['SEND'] = 'Send nyhetsbrev';
$lang['nb_NO']['NewsletterAdmin_right.ss']['SENDTEST'] = 'Send test til';
$lang['nb_NO']['NewsletterAdmin_right.ss']['WELCOME1'] = 'Velkommen til';
$lang['nb_NO']['NewsletterAdmin_right.ss']['WELCOME2'] = 'Nyhetsbrev administrasjonsseksjon. Venligst velg en mappe fra venstre side.';
$lang['nb_NO']['NewsletterAdmin_SiteTree.ss']['DRAFTS'] = 'Utkast';
$lang['nb_NO']['NewsletterAdmin_SiteTree.ss']['MAILLIST'] = 'Postlister';
$lang['nb_NO']['NewsletterAdmin_SiteTree.ss']['SENT'] = 'Sendte elementer';
$lang['nb_NO']['NewsletterAdmin_UnsubscribedList.ss']['NOUNSUB'] = 'Ingen brukere har avsluttet abonnementet på dette nyhetsbrevet.';
$lang['nb_NO']['NewsletterAdmin_UnsubscribedList.ss']['UNAME'] = 'Brukernavn';
$lang['nb_NO']['NewsletterAdmin_UnsubscribedList.ss']['UNSUBON'] = 'Avsluttet abonementet på';
$lang['nb_NO']['NewsletterList.ss']['CHOOSEDRAFT1'] = 'Venligst velg et utkast fra venstre side, eller';
$lang['nb_NO']['NewsletterList.ss']['CHOOSEDRAFT2'] = 'legg til en';
$lang['nb_NO']['NewsletterList.ss']['CHOOSESENT'] = 'Venligst velg et sendt element fra venstre meny.';
$lang['nb_NO']['Newsletter_RecipientImportField.ss']['CHANGED'] = 'Antall detaljer endret:';
$lang['nb_NO']['Newsletter_RecipientImportField.ss']['IMPORTED'] = 'Nye importerte medlemmer:';
$lang['nb_NO']['Newsletter_RecipientImportField.ss']['IMPORTNEW'] = 'Importer nye medlemmer';
$lang['nb_NO']['Newsletter_RecipientImportField.ss']['SEC'] = 'sekunder';
$lang['nb_NO']['Newsletter_RecipientImportField.ss']['SKIPPED'] = 'Oppslag som ble droppet:';
$lang['nb_NO']['Newsletter_RecipientImportField.ss']['TIME'] = 'Tid brukt:';
$lang['nb_NO']['Newsletter_RecipientImportField.ss']['UPDATED'] = 'Oppdaterte medlemmer:';
$lang['nb_NO']['Newsletter_RecipientImportField_Table.ss']['CONTENTSOF'] = 'Innhold av';
$lang['nb_NO']['Newsletter_RecipientImportField_Table.ss']['NO'] = 'Avbryt';
$lang['nb_NO']['Newsletter_RecipientImportField_Table.ss']['RECIMPORTED'] = 'Mottagere importert fra';
$lang['nb_NO']['Newsletter_RecipientImportField_Table.ss']['YES'] = 'Bekreft';
$lang['nb_NO']['Newsletter_SentStatusReport.ss']['DATE'] = 'Dato';
$lang['nb_NO']['Newsletter_SentStatusReport.ss']['EMAIL'] = 'Epost';
$lang['nb_NO']['Newsletter_SentStatusReport.ss']['FN'] = 'Fornavn';
$lang['nb_NO']['Newsletter_SentStatusReport.ss']['NEWSNEVERSENT'] = 'Nyhetsbrevet har Aldri blitt Send til Følgende Abonnenter';
$lang['nb_NO']['Newsletter_SentStatusReport.ss']['RES'] = 'Resultat';
$lang['nb_NO']['Newsletter_SentStatusReport.ss']['SENDBOUNCED'] = 'Sending til Følgende Mottakere Avvist';
$lang['nb_NO']['Newsletter_SentStatusReport.ss']['SENDFAIL'] = 'Sending til Følgene Mottakere Feilet';
$lang['nb_NO']['Newsletter_SentStatusReport.ss']['SENTOK'] = 'Sending til Følgende Mottakere Vellykket';
$lang['nb_NO']['Newsletter_SentStatusReport.ss']['SN'] = 'Etternavn';

?>