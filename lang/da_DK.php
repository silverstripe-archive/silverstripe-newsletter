<?php

/**
 * Danish (Denmark) language pack
 * @package modules: newsletter
 * @subpackage i18n
 */

i18n::include_locale_file('modules: newsletter', 'en_US');

global $lang;

if(array_key_exists('da_DK', $lang) && is_array($lang['da_DK'])) {
	$lang['da_DK'] = array_merge($lang['en_US'], $lang['da_DK']);
} else {
	$lang['da_DK'] = $lang['en_US'];
}

$lang['da_DK']['LeftAndMain']['NEWSLETTERS'] = 'Nyhedsbreve';
$lang['da_DK']['NewsletterAdmin']['FROMEM'] = 'Fra emailadresse';
$lang['da_DK']['NewsletterAdmin']['MEWDRAFTMEWSL'] = 'Ny kladde til nyhedsbrev';
$lang['da_DK']['NewsletterAdmin']['NEWLIST'] = 'Ny mailliste';
$lang['da_DK']['NewsletterAdmin']['NEWNEWSLTYPE'] = 'Ny nyhedsbrevstype';
$lang['da_DK']['NewsletterAdmin']['NEWSLTYPE'] = 'Nyhedsbrevstype';
$lang['da_DK']['NewsletterAdmin']['PLEASEENTERMAIL'] = 'Indtast en emailadresse';
$lang['da_DK']['NewsletterAdmin']['RESEND'] = 'Gensend';
$lang['da_DK']['NewsletterAdmin']['SAVE'] = 'Gem';
$lang['da_DK']['NewsletterAdmin']['SAVED'] = 'Gemt';
$lang['da_DK']['NewsletterAdmin']['SEND'] = 'Send...';
$lang['da_DK']['NewsletterAdmin']['SENDING'] = 'Sender emails...';
$lang['da_DK']['NewsletterAdmin']['SENTTESTTO'] = 'Send test til';
$lang['da_DK']['NewsletterAdmin']['SHOWCONTENTS'] = 'Vis indhold';
$lang['da_DK']['NewsletterAdmin_BouncedList.ss']['EMADD'] = 'Emailadresse';
$lang['da_DK']['NewsletterAdmin_BouncedList.ss']['HAVEBOUNCED'] = 'Emails der er blevet afvist';
$lang['da_DK']['NewsletterAdmin_BouncedList.ss']['NOBOUNCED'] = 'Ingen af de sendte emails er blevet afvist';
$lang['da_DK']['NewsletterAdmin_BouncedList.ss']['UNAME'] = 'Brugernavn';
$lang['da_DK']['NewsletterAdmin_left.ss']['ADDDRAFT'] = 'Tilføj ny kladde';
$lang['da_DK']['NewsletterAdmin_left.ss']['ADDTYPE'] = 'Tilføj ny type';
$lang['da_DK']['NewsletterAdmin_left.ss']['CREATE'] = 'Opret';
$lang['da_DK']['NewsletterAdmin_left.ss']['DEL'] = 'Slet';
$lang['da_DK']['NewsletterAdmin_left.ss']['DELETEDRAFTS'] = 'Slet de valgte kladder';
$lang['da_DK']['NewsletterAdmin_left.ss']['GO'] = 'Go';
$lang['da_DK']['NewsletterAdmin_left.ss']['NEWSLETTERS'] = 'Nyhedsbreve';
$lang['da_DK']['NewsletterAdmin_left.ss']['SELECTDRAFTS'] = 'Vælg de kladder, du ønsker at slette og klik på knappen nedenunder';
$lang['da_DK']['NewsletterAdmin_right.ss']['CANCEL'] = 'Annuller';
$lang['da_DK']['NewsletterAdmin_right.ss']['ENTIRE'] = 'Send til hele maillisten';
$lang['da_DK']['NewsletterAdmin_right.ss']['ONLYNOT'] = 'Send kun til folk, som der ikke tidligere er blevet sendt til';
$lang['da_DK']['NewsletterAdmin_right.ss']['SEND'] = 'Send nyhedsbrev';
$lang['da_DK']['NewsletterAdmin_right.ss']['SENDTEST'] = 'Send test til';
$lang['da_DK']['NewsletterAdmin_right.ss']['WELCOME1'] = 'Velkommen til';
$lang['da_DK']['NewsletterAdmin_right.ss']['WELCOME2'] = 'Nyhedsbrevs administration. Vælg en mappe i venstreside';
$lang['da_DK']['NewsletterAdmin_SiteTree.ss']['DRAFTS'] = 'Kladder';
$lang['da_DK']['NewsletterAdmin_SiteTree.ss']['MAILLIST'] = 'Mailliste';
$lang['da_DK']['NewsletterAdmin_SiteTree.ss']['SENT'] = 'Sendte emails';
$lang['da_DK']['NewsletterAdmin_UnsubscribedList.ss']['NOUNSUB'] = 'Ingen brugere har afmeldt sig fra dette nyhedsbrev';
$lang['da_DK']['NewsletterAdmin_UnsubscribedList.ss']['UNAME'] = 'Brugernavn';
$lang['da_DK']['NewsletterAdmin_UnsubscribedList.ss']['UNSUBON'] = 'Afmeldt';
$lang['da_DK']['NewsletterList.ss']['CHOOSEDRAFT1'] = 'Vælg en kladde i venstre side, eller';
$lang['da_DK']['NewsletterList.ss']['CHOOSEDRAFT2'] = 'tilføj en';
$lang['da_DK']['NewsletterList.ss']['CHOOSESENT'] = 'Vælg en sendt artikel i venstre side';
$lang['da_DK']['Newsletter_RecipientImportField.ss']['CHANGED'] = 'Antallet er detajler ændret:';
$lang['da_DK']['Newsletter_RecipientImportField.ss']['IMPORTED'] = 'Nye medlemmer importeret:';
$lang['da_DK']['Newsletter_RecipientImportField.ss']['IMPORTNEW'] = 'Importerede nye medlemmer';
$lang['da_DK']['Newsletter_RecipientImportField.ss']['SEC'] = 'sekunder';
$lang['da_DK']['Newsletter_RecipientImportField.ss']['SKIPPED'] = 'Artikler sprunget over:';
$lang['da_DK']['Newsletter_RecipientImportField.ss']['TIME'] = 'Tid brugt:';
$lang['da_DK']['Newsletter_RecipientImportField.ss']['UPDATED'] = 'Medlemmer opdateret:';
$lang['da_DK']['Newsletter_RecipientImportField_Table.ss']['CONTENTSOF'] = 'Indholdet af';
$lang['da_DK']['Newsletter_RecipientImportField_Table.ss']['NO'] = 'Annuller';
$lang['da_DK']['Newsletter_RecipientImportField_Table.ss']['RECIMPORTED'] = 'Modtagere importeret fra';
$lang['da_DK']['Newsletter_RecipientImportField_Table.ss']['YES'] = 'Bekræft';
$lang['da_DK']['Newsletter_SentStatusReport.ss']['DATE'] = 'Dato';
$lang['da_DK']['Newsletter_SentStatusReport.ss']['EMAIL'] = 'Email';
$lang['da_DK']['Newsletter_SentStatusReport.ss']['FN'] = 'Fornavn';
$lang['da_DK']['Newsletter_SentStatusReport.ss']['NEWSNEVERSENT'] = 'Nyhedsbrevet er aldrig blevet sendt til følgende modtagere';
$lang['da_DK']['Newsletter_SentStatusReport.ss']['RES'] = 'Resultat';
$lang['da_DK']['Newsletter_SentStatusReport.ss']['SENDBOUNCED'] = 'Forsendelse til følgende modtagere blev afvist';
$lang['da_DK']['Newsletter_SentStatusReport.ss']['SENDFAIL'] = 'Det lykkedes ikke at sende til følgende modtagere';
$lang['da_DK']['Newsletter_SentStatusReport.ss']['SENTOK'] = 'Det lykkedes at sende til følgende modtagere';
$lang['da_DK']['Newsletter_SentStatusReport.ss']['SN'] = 'Efternavn';

?>