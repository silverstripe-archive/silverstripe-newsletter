<?php

/**
 * Dutch (Netherlands) language pack
 * @package modules: newsletter
 * @subpackage i18n
 */

i18n::include_locale_file('modules: newsletter', 'en_US');

global $lang;

if(array_key_exists('nl_NL', $lang) && is_array($lang['nl_NL'])) {
	$lang['nl_NL'] = array_merge($lang['en_US'], $lang['nl_NL']);
} else {
	$lang['nl_NL'] = $lang['en_US'];
}

$lang['nl_NL']['LeftAndMain']['NEWSLETTERS'] = 'Nieuwsbrieven';
$lang['nl_NL']['NewsletterAdmin']['FROMEM'] = 'Van emailadres';
$lang['nl_NL']['NewsletterAdmin']['MEWDRAFTMEWSL'] = 'Nieuwe concept nieuwsbrief';
$lang['nl_NL']['NewsletterAdmin']['NEWLIST'] = 'Nieuwe mailinglijst';
$lang['nl_NL']['NewsletterAdmin']['NEWNEWSLTYPE'] = 'Nieuw nieuwsbrief type';
$lang['nl_NL']['NewsletterAdmin']['NEWSLTYPE'] = 'Nieuwsbrief Type';
$lang['nl_NL']['NewsletterAdmin']['PLEASEENTERMAIL'] = 'Geef een emailadres op';
$lang['nl_NL']['NewsletterAdmin']['RESEND'] = 'Opnieuw verzenden';
$lang['nl_NL']['NewsletterAdmin']['SAVE'] = 'Bewaar';
$lang['nl_NL']['NewsletterAdmin']['SAVED'] = 'Bewaard';
$lang['nl_NL']['NewsletterAdmin']['SEND'] = 'Verzenden...';
$lang['nl_NL']['NewsletterAdmin']['SENDING'] = 'Emails worden verzonden...';
$lang['nl_NL']['NewsletterAdmin']['SENTTESTTO'] = 'Test verzenden naar ';
$lang['nl_NL']['NewsletterAdmin']['SHOWCONTENTS'] = 'Toon inhoud';
$lang['nl_NL']['NewsletterAdmin_BouncedList.ss']['EMADD'] = 'Emailadres';
$lang['nl_NL']['NewsletterAdmin_BouncedList.ss']['HAVEBOUNCED'] = 'Geweigerde emails';
$lang['nl_NL']['NewsletterAdmin_BouncedList.ss']['NOBOUNCED'] = 'Alle verzonden mails zijn geaccepteerd.';
$lang['nl_NL']['NewsletterAdmin_BouncedList.ss']['UNAME'] = 'Gebruikersnaam';
$lang['nl_NL']['NewsletterAdmin_left.ss']['ADDDRAFT'] = 'Concept toevoegen';
$lang['nl_NL']['NewsletterAdmin_left.ss']['ADDTYPE'] = 'Type toevoegen';
$lang['nl_NL']['NewsletterAdmin_left.ss']['CREATE'] = 'Aanmaken';
$lang['nl_NL']['NewsletterAdmin_left.ss']['DEL'] = 'Verwijderen';
$lang['nl_NL']['NewsletterAdmin_left.ss']['DELETEDRAFTS'] = 'Geselecteerde concepten verwijderen';
$lang['nl_NL']['NewsletterAdmin_left.ss']['GO'] = 'Doen';
$lang['nl_NL']['NewsletterAdmin_left.ss']['NEWSLETTERS'] = 'Nieuwsbrieven';
$lang['nl_NL']['NewsletterAdmin_left.ss']['SELECTDRAFTS'] = 'Selecteer de concepten die U wilt verwijderen en klik op onderstaande knop';
$lang['nl_NL']['NewsletterAdmin_right.ss']['CANCEL'] = 'Annuleer';
$lang['nl_NL']['NewsletterAdmin_right.ss']['ENTIRE'] = 'Naar de volledige mailinglijst verzenden';
$lang['nl_NL']['NewsletterAdmin_right.ss']['ONLYNOT'] = 'Alleen verzenden naar mensen waarnaar nog niet verzonden is';
$lang['nl_NL']['NewsletterAdmin_right.ss']['SEND'] = 'Nieuwsbrief verzenden';
$lang['nl_NL']['NewsletterAdmin_right.ss']['SENDTEST'] = 'Test verzenden naar';
$lang['nl_NL']['NewsletterAdmin_right.ss']['WELCOME1'] = 'Welkom bij';
$lang['nl_NL']['NewsletterAdmin_right.ss']['WELCOME2'] = 'nieuwsbrief beheer onderdeel. Kies een map aan de linkerkant.';
$lang['nl_NL']['NewsletterAdmin_SiteTree.ss']['DRAFTS'] = 'Concepten';
$lang['nl_NL']['NewsletterAdmin_SiteTree.ss']['MAILLIST'] = 'Mailing Lijst';
$lang['nl_NL']['NewsletterAdmin_SiteTree.ss']['SENT'] = 'Verzonden Items';
$lang['nl_NL']['NewsletterAdmin_UnsubscribedList.ss']['NOUNSUB'] = 'Er zijn geen gebruikers die zich hebben uitgeschreven.';
$lang['nl_NL']['NewsletterAdmin_UnsubscribedList.ss']['UNAME'] = 'Gebruikersnaam';
$lang['nl_NL']['NewsletterAdmin_UnsubscribedList.ss']['UNSUBON'] = 'Uitgeschreven op';
$lang['nl_NL']['NewsletterList.ss']['CHOOSEDRAFT1'] = 'Kies een concept aan de linker kant, of';
$lang['nl_NL']['NewsletterList.ss']['CHOOSEDRAFT2'] = 'voeg er een toe';
$lang['nl_NL']['NewsletterList.ss']['CHOOSESENT'] = 'Kiese een verzonden item aan de linker kant.';
$lang['nl_NL']['Newsletter_RecipientImportField.ss']['CHANGED'] = 'Aantal details gewijzigd:';
$lang['nl_NL']['Newsletter_RecipientImportField.ss']['IMPORTED'] = 'Nieuwe abonnees geimporteerd:';
$lang['nl_NL']['Newsletter_RecipientImportField.ss']['IMPORTNEW'] = 'Nieuwe abonnees geimporteerd';
$lang['nl_NL']['Newsletter_RecipientImportField.ss']['SEC'] = 'seconden';
$lang['nl_NL']['Newsletter_RecipientImportField.ss']['SKIPPED'] = 'Records overgeslagen:';
$lang['nl_NL']['Newsletter_RecipientImportField.ss']['TIME'] = 'Tijdsduur:';
$lang['nl_NL']['Newsletter_RecipientImportField.ss']['UPDATED'] = 'Abonnees gewijzigd:';
$lang['nl_NL']['Newsletter_RecipientImportField_Table.ss']['CONTENTSOF'] = 'Inhoud van';
$lang['nl_NL']['Newsletter_RecipientImportField_Table.ss']['NO'] = 'Annuleer';
$lang['nl_NL']['Newsletter_RecipientImportField_Table.ss']['RECIMPORTED'] = 'Ontvangers geimporteerd uit';
$lang['nl_NL']['Newsletter_RecipientImportField_Table.ss']['YES'] = 'Bevestigen';
$lang['nl_NL']['Newsletter_SentStatusReport.ss']['DATE'] = 'Datum';
$lang['nl_NL']['Newsletter_SentStatusReport.ss']['EMAIL'] = 'Email';
$lang['nl_NL']['Newsletter_SentStatusReport.ss']['FN'] = 'Voornaam';
$lang['nl_NL']['Newsletter_SentStatusReport.ss']['NEWSNEVERSENT'] = 'De Nieuwsbrief is nog nooit verzonden naar de volgende ontvangers';
$lang['nl_NL']['Newsletter_SentStatusReport.ss']['RES'] = 'Resultaat';
$lang['nl_NL']['Newsletter_SentStatusReport.ss']['SENDBOUNCED'] = 'Verzendingen naar de volgende ontvangers zijn geweigerd';
$lang['nl_NL']['Newsletter_SentStatusReport.ss']['SENDFAIL'] = 'Verzenden naar de volgende ontvangers is mislukt';
$lang['nl_NL']['Newsletter_SentStatusReport.ss']['SENTOK'] = 'Verzenden naar de volgende ontvangers is succesvol verlopen';
$lang['nl_NL']['Newsletter_SentStatusReport.ss']['SN'] = 'Achternaam';

?>