<?php

/**
 * Italian (Italy) language pack
 * @package modules: newsletter
 * @subpackage i18n
 */

i18n::include_locale_file('modules: newsletter', 'en_US');

global $lang;

if(array_key_exists('it_IT', $lang) && is_array($lang['it_IT'])) {
	$lang['it_IT'] = array_merge($lang['en_US'], $lang['it_IT']);
} else {
	$lang['it_IT'] = $lang['en_US'];
}

$lang['it_IT']['LeftAndMain']['NEWSLETTERS'] = 'Newsletter';
$lang['it_IT']['NewsletterAdmin']['FROMEM'] = 'Dall\'indirizzo email';
$lang['it_IT']['NewsletterAdmin']['MEWDRAFTMEWSL'] = 'Nuova bozza di newsletter';
$lang['it_IT']['NewsletterAdmin']['NEWLIST'] = 'Nuova mailing list';
$lang['it_IT']['NewsletterAdmin']['NEWNEWSLTYPE'] = 'Nuovo tipo di newsletter';
$lang['it_IT']['NewsletterAdmin']['NEWSLTYPE'] = 'Tipo di newsletter';
$lang['it_IT']['NewsletterAdmin']['PLEASEENTERMAIL'] = 'Per favore inserisci un indirizzo email';
$lang['it_IT']['NewsletterAdmin']['RESEND'] = 'Invia nuovamente';
$lang['it_IT']['NewsletterAdmin']['SAVE'] = 'Salva';
$lang['it_IT']['NewsletterAdmin']['SAVED'] = 'Salvato';
$lang['it_IT']['NewsletterAdmin']['SEND'] = 'Invia...';
$lang['it_IT']['NewsletterAdmin']['SENDING'] = 'Invio e-mail...';
$lang['it_IT']['NewsletterAdmin']['SENTTESTTO'] = 'Inviato test a';
$lang['it_IT']['NewsletterAdmin']['SHOWCONTENTS'] = 'Visualizza contenuti';
$lang['it_IT']['NewsletterAdmin_BouncedList.ss']['EMADD'] = 'Indirizzo email';
$lang['it_IT']['NewsletterAdmin_BouncedList.ss']['HAVEBOUNCED'] = 'Email rifiutate dal server';
$lang['it_IT']['NewsletterAdmin_BouncedList.ss']['NOBOUNCED'] = 'Nessuna email rifiutata dal server';
$lang['it_IT']['NewsletterAdmin_BouncedList.ss']['UNAME'] = 'Nome utente';
$lang['it_IT']['NewsletterAdmin_left.ss']['ADDDRAFT'] = 'Inserisci nuova bozza';
$lang['it_IT']['NewsletterAdmin_left.ss']['ADDTYPE'] = 'Inserisci nuovo tipo';
$lang['it_IT']['NewsletterAdmin_left.ss']['CREATE'] = 'Crea';
$lang['it_IT']['NewsletterAdmin_left.ss']['DEL'] = 'Cancella';
$lang['it_IT']['NewsletterAdmin_left.ss']['DELETEDRAFTS'] = 'Cancella le bozze selezionate';
$lang['it_IT']['NewsletterAdmin_left.ss']['GO'] = 'Vai';
$lang['it_IT']['NewsletterAdmin_left.ss']['NEWSLETTERS'] = 'Newsletter';
$lang['it_IT']['NewsletterAdmin_left.ss']['SELECTDRAFTS'] = 'Seleziona le bozze che vuoi rimuovere e clicca il pulsante di seguito';
$lang['it_IT']['NewsletterAdmin_right.ss']['CANCEL'] = 'Cancella';
$lang['it_IT']['NewsletterAdmin_right.ss']['ENTIRE'] = 'Invia all\'intera mailing list';
$lang['it_IT']['NewsletterAdmin_right.ss']['ONLYNOT'] = 'Inviato solamente alle persone a cui non è stata precedentemente inviata';
$lang['it_IT']['NewsletterAdmin_right.ss']['SEND'] = 'Invia newsletter';
$lang['it_IT']['NewsletterAdmin_right.ss']['SENDTEST'] = 'Invia test a';
$lang['it_IT']['NewsletterAdmin_right.ss']['WELCOME1'] = 'Benvenuto su';
$lang['it_IT']['NewsletterAdmin_right.ss']['WELCOME2'] = 'Sezione di amministrazione della newsletter. Per favore scegli una cartella sulla sinistra.';
$lang['it_IT']['NewsletterAdmin_SiteTree.ss']['DRAFTS'] = 'Bozze';
$lang['it_IT']['NewsletterAdmin_SiteTree.ss']['MAILLIST'] = 'Mailing List';
$lang['it_IT']['NewsletterAdmin_SiteTree.ss']['SENT'] = 'Oggetti inviati';
$lang['it_IT']['NewsletterAdmin_UnsubscribedList.ss']['NOUNSUB'] = 'Nessun utente è stato rimosso da questa newsletter.';
$lang['it_IT']['NewsletterAdmin_UnsubscribedList.ss']['UNAME'] = 'Nome utente';
$lang['it_IT']['NewsletterAdmin_UnsubscribedList.ss']['UNSUBON'] = 'Disiscritto da';
$lang['it_IT']['NewsletterList.ss']['CHOOSEDRAFT1'] = 'Per favore seleziona una bozza sulla sinistra, oppure';
$lang['it_IT']['NewsletterList.ss']['CHOOSEDRAFT2'] = 'inseriscine una';
$lang['it_IT']['NewsletterList.ss']['CHOOSESENT'] = 'Per favore scegli un oggetto inviato sulla sinistra.';
$lang['it_IT']['Newsletter_RecipientImportField.ss']['CHANGED'] = 'Numero di dettagli cambiati:';
$lang['it_IT']['Newsletter_RecipientImportField.ss']['IMPORTED'] = 'Nuovi membri importati:';
$lang['it_IT']['Newsletter_RecipientImportField.ss']['IMPORTNEW'] = 'Nuovi membri importati';
$lang['it_IT']['Newsletter_RecipientImportField.ss']['SEC'] = 'secondi';
$lang['it_IT']['Newsletter_RecipientImportField.ss']['SKIPPED'] = 'Record saltati:';
$lang['it_IT']['Newsletter_RecipientImportField.ss']['TIME'] = 'Tempo impiegato:';
$lang['it_IT']['Newsletter_RecipientImportField.ss']['UPDATED'] = 'Membri aggiornati:';
$lang['it_IT']['Newsletter_RecipientImportField_Table.ss']['CONTENTSOF'] = 'Contenuto di';
$lang['it_IT']['Newsletter_RecipientImportField_Table.ss']['NO'] = 'Cancella';
$lang['it_IT']['Newsletter_RecipientImportField_Table.ss']['RECIMPORTED'] = 'Indirizzi importati da';
$lang['it_IT']['Newsletter_RecipientImportField_Table.ss']['YES'] = 'Conferma';
$lang['it_IT']['Newsletter_SentStatusReport.ss']['DATE'] = 'Data';
$lang['it_IT']['Newsletter_SentStatusReport.ss']['EMAIL'] = 'Email';
$lang['it_IT']['Newsletter_SentStatusReport.ss']['FN'] = 'Nome';
$lang['it_IT']['Newsletter_SentStatusReport.ss']['NEWSNEVERSENT'] = 'La newsletter non è mai stata inviata ai seguenti iscritti:';
$lang['it_IT']['Newsletter_SentStatusReport.ss']['RES'] = 'Risultato';
$lang['it_IT']['Newsletter_SentStatusReport.ss']['SENDBOUNCED'] = 'L\'invio ai seguenti indirizzi è stato rifiutato dal server';
$lang['it_IT']['Newsletter_SentStatusReport.ss']['SENDFAIL'] = 'Invio ai seguenti indirizzi fallito';
$lang['it_IT']['Newsletter_SentStatusReport.ss']['SENTOK'] = 'Invio ai seguenti indirizzi avvenuto con successo';
$lang['it_IT']['Newsletter_SentStatusReport.ss']['SN'] = 'Cognome';

?>