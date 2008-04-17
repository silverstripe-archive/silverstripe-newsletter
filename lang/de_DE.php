<?php

/**
 * German (Germany) language pack
 * @package modules: newsletter
 * @subpackage i18n
 */

i18n::include_locale_file('modules: newsletter', 'en_US');

global $lang;

if(array_key_exists('de_DE', $lang) && is_array($lang['de_DE'])) {
	$lang['de_DE'] = array_merge($lang['en_US'], $lang['de_DE']);
} else {
	$lang['de_DE'] = $lang['en_US'];
}

$lang['de_DE']['LeftAndMain']['NEWSLETTERS'] = 'Newsletter';
$lang['de_DE']['NewsletterAdmin']['FROMEM'] = 'Von Email Adresse';
$lang['de_DE']['NewsletterAdmin']['MEWDRAFTMEWSL'] = 'Neue Newsletter Vorlage';
$lang['de_DE']['NewsletterAdmin']['NEWLIST'] = 'Neue Mailing Liste';
$lang['de_DE']['NewsletterAdmin']['NEWNEWSLTYPE'] = 'Neuer Newsletter Typ';
$lang['de_DE']['NewsletterAdmin']['NEWSLTYPE'] = 'Newsletter Typ';
$lang['de_DE']['NewsletterAdmin']['PLEASEENTERMAIL'] = 'Bitte geben Sie eine Email Adresse ein';
$lang['de_DE']['NewsletterAdmin']['RESEND'] = 'Wiederversenden';
$lang['de_DE']['NewsletterAdmin']['SAVE'] = 'Speichern';
$lang['de_DE']['NewsletterAdmin']['SAVED'] = 'Gespeichert';
$lang['de_DE']['NewsletterAdmin']['SEND'] = 'Senden...';
$lang['de_DE']['NewsletterAdmin']['SENDING'] = 'Sende Emails...';
$lang['de_DE']['NewsletterAdmin']['SENTTESTTO'] = 'Test gesendet an';
$lang['de_DE']['NewsletterAdmin']['SHOWCONTENTS'] = 'Zeige Inhalte';
$lang['de_DE']['NewsletterAdmin_BouncedList.ss']['EMADD'] = 'Email Adresse';
$lang['de_DE']['NewsletterAdmin_BouncedList.ss']['HAVEBOUNCED'] = 'abgewiesene Emails';
$lang['de_DE']['NewsletterAdmin_BouncedList.ss']['NOBOUNCED'] = 'Keine gesendeten Emails wurden abgewiesen';
$lang['de_DE']['NewsletterAdmin_BouncedList.ss']['UNAME'] = 'Nutzername';
$lang['de_DE']['NewsletterAdmin_left.ss']['ADDDRAFT'] = 'Neuen Entwurf hinzufügen';
$lang['de_DE']['NewsletterAdmin_left.ss']['ADDTYPE'] = 'Neuen Typ hinzufügen';
$lang['de_DE']['NewsletterAdmin_left.ss']['CREATE'] = 'Erstelle...';
$lang['de_DE']['NewsletterAdmin_left.ss']['DEL'] = 'Lösche...';
$lang['de_DE']['NewsletterAdmin_left.ss']['DELETEDRAFTS'] = 'Lösche den markierten Entwurf';
$lang['de_DE']['NewsletterAdmin_left.ss']['GO'] = 'Los';
$lang['de_DE']['NewsletterAdmin_left.ss']['NEWSLETTERS'] = 'Newsletter';
$lang['de_DE']['NewsletterAdmin_left.ss']['SELECTDRAFTS'] = 'Markieren Sie die Entwürfe die Sie löschen möchten und drücken dann die nachfolgende Schaltfläche';
$lang['de_DE']['NewsletterAdmin_right.ss']['CANCEL'] = 'Abbrechen';
$lang['de_DE']['NewsletterAdmin_right.ss']['ENTIRE'] = 'Sende an die gesamte Mailing Liste';
$lang['de_DE']['NewsletterAdmin_right.ss']['ONLYNOT'] = 'Sende nur an die Personen an die zuvor nicht versendet wurde';
$lang['de_DE']['NewsletterAdmin_right.ss']['SEND'] = 'Sende Newsletter';
$lang['de_DE']['NewsletterAdmin_right.ss']['SENDTEST'] = 'Sende Test an';
$lang['de_DE']['NewsletterAdmin_right.ss']['WELCOME1'] = 'Willkommen bei dem';
$lang['de_DE']['NewsletterAdmin_right.ss']['WELCOME2'] = 'Newsletter Administrations Bereich. Bitte wählen sie eine Ordner auf der linken Seite.';
$lang['de_DE']['NewsletterAdmin_SiteTree.ss']['DRAFTS'] = 'Entwurf';
$lang['de_DE']['NewsletterAdmin_SiteTree.ss']['MAILLIST'] = 'Mailing Liste';
$lang['de_DE']['NewsletterAdmin_SiteTree.ss']['SENT'] = 'Gesendete Artikel';
$lang['de_DE']['NewsletterAdmin_UnsubscribedList.ss']['NOUNSUB'] = 'Kein Nutzer hat diesen Newsletter abbestellt';
$lang['de_DE']['NewsletterAdmin_UnsubscribedList.ss']['UNAME'] = 'Nutzername';
$lang['de_DE']['NewsletterAdmin_UnsubscribedList.ss']['UNSUBON'] = 'Abbestellt am';
$lang['de_DE']['NewsletterList.ss']['CHOOSEDRAFT1'] = 'Bitte wählen Sie einen Entwurf auf der linken Seite, oder';
$lang['de_DE']['NewsletterList.ss']['CHOOSEDRAFT2'] = 'Fügen Sie einen hinzu';
$lang['de_DE']['NewsletterList.ss']['CHOOSESENT'] = 'Bitte wählen Sie einen gesendeten Artikel auf der linken Seite';
$lang['de_DE']['Newsletter_RecipientImportField.ss']['CHANGED'] = 'Anzahl der geänderten Details:';
$lang['de_DE']['Newsletter_RecipientImportField.ss']['IMPORTED'] = 'Neu importierte Mitglieder:';
$lang['de_DE']['Newsletter_RecipientImportField.ss']['IMPORTNEW'] = 'Neue Mitglieder importiert';
$lang['de_DE']['Newsletter_RecipientImportField.ss']['SEC'] = 'Sekunden';
$lang['de_DE']['Newsletter_RecipientImportField.ss']['SKIPPED'] = 'übersprungene Datensätze:';
$lang['de_DE']['Newsletter_RecipientImportField.ss']['TIME'] = 'Benötigte Zeit:';
$lang['de_DE']['Newsletter_RecipientImportField.ss']['UPDATED'] = 'aktualisierte Mitglieder:';
$lang['de_DE']['Newsletter_RecipientImportField_Table.ss']['CONTENTSOF'] = 'Inhalte';
$lang['de_DE']['Newsletter_RecipientImportField_Table.ss']['NO'] = 'Abbrechen';
$lang['de_DE']['Newsletter_RecipientImportField_Table.ss']['RECIMPORTED'] = 'Empfänger importiert aus';
$lang['de_DE']['Newsletter_RecipientImportField_Table.ss']['YES'] = 'Bestätigen';
$lang['de_DE']['Newsletter_SentStatusReport.ss']['DATE'] = 'Datum';
$lang['de_DE']['Newsletter_SentStatusReport.ss']['EMAIL'] = 'Email';
$lang['de_DE']['Newsletter_SentStatusReport.ss']['FN'] = 'Vorname';
$lang['de_DE']['Newsletter_SentStatusReport.ss']['NEWSNEVERSENT'] = 'Der Newsletter wurde nie an folgende Teilnehmer versandt';
$lang['de_DE']['Newsletter_SentStatusReport.ss']['RES'] = 'Ergebnis';
$lang['de_DE']['Newsletter_SentStatusReport.ss']['SENDBOUNCED'] = 'Der Versand an die folgenden Empfänger wurde abgewiesen';
$lang['de_DE']['Newsletter_SentStatusReport.ss']['SENDFAIL'] = 'Das versenden an die folgenden Empfänger schlug fehl';
$lang['de_DE']['Newsletter_SentStatusReport.ss']['SENTOK'] = 'Der Versand an folgende Empfänger war erfolgreich';
$lang['de_DE']['Newsletter_SentStatusReport.ss']['SN'] = 'Nachname';

?>