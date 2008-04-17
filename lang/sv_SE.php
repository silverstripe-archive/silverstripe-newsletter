<?php

/**
 * Swedish (Sweden) language pack
 * @package modules: newsletter
 * @subpackage i18n
 */

i18n::include_locale_file('modules: newsletter', 'en_US');

global $lang;

if(array_key_exists('sv_SE', $lang) && is_array($lang['sv_SE'])) {
	$lang['sv_SE'] = array_merge($lang['en_US'], $lang['sv_SE']);
} else {
	$lang['sv_SE'] = $lang['en_US'];
}

$lang['sv_SE']['LeftAndMain']['NEWSLETTERS'] = 'Nyhetsbrev';
$lang['sv_SE']['NewsletterAdmin']['FROMEM'] = 'Från-epostadress';
$lang['sv_SE']['NewsletterAdmin']['MEWDRAFTMEWSL'] = 'Nytt utkast för nyhetsbrev';
$lang['sv_SE']['NewsletterAdmin']['NEWLIST'] = 'Ny utskickslista';
$lang['sv_SE']['NewsletterAdmin']['NEWNEWSLTYPE'] = 'Ny nyhetsbrevstyp';
$lang['sv_SE']['NewsletterAdmin']['NEWSLTYPE'] = 'Nyhetsbrevstyp';
$lang['sv_SE']['NewsletterAdmin']['PLEASEENTERMAIL'] = 'Var god och ange en e-postadress';
$lang['sv_SE']['NewsletterAdmin']['RESEND'] = 'Skicka igen';
$lang['sv_SE']['NewsletterAdmin']['SAVE'] = 'Spara';
$lang['sv_SE']['NewsletterAdmin']['SAVED'] = 'Sparad';
$lang['sv_SE']['NewsletterAdmin']['SEND'] = 'Skicka...';
$lang['sv_SE']['NewsletterAdmin']['SENDING'] = 'Skickar e-brev...';
$lang['sv_SE']['NewsletterAdmin']['SENTTESTTO'] = 'Skicka test till';
$lang['sv_SE']['NewsletterAdmin']['SHOWCONTENTS'] = 'Visa innehåll';
$lang['sv_SE']['NewsletterAdmin_BouncedList.ss']['EMADD'] = 'E-postadress';
$lang['sv_SE']['NewsletterAdmin_BouncedList.ss']['HAVEBOUNCED'] = 'E-brev som har studsat';
$lang['sv_SE']['NewsletterAdmin_BouncedList.ss']['NOBOUNCED'] = 'Inga skickade e-brev har studsat';
$lang['sv_SE']['NewsletterAdmin_BouncedList.ss']['UNAME'] = 'Användarnamn';
$lang['sv_SE']['NewsletterAdmin_left.ss']['ADDDRAFT'] = 'Lägg till nytt utkast';
$lang['sv_SE']['NewsletterAdmin_left.ss']['ADDTYPE'] = 'Lägg till ny typ';
$lang['sv_SE']['NewsletterAdmin_left.ss']['CREATE'] = 'Skapa';
$lang['sv_SE']['NewsletterAdmin_left.ss']['DEL'] = 'Radera';
$lang['sv_SE']['NewsletterAdmin_left.ss']['DELETEDRAFTS'] = 'Radera de markerade utkasten';
$lang['sv_SE']['NewsletterAdmin_left.ss']['GO'] = 'Kör';
$lang['sv_SE']['NewsletterAdmin_left.ss']['NEWSLETTERS'] = 'Nyhetsbrev';
$lang['sv_SE']['NewsletterAdmin_left.ss']['SELECTDRAFTS'] = 'Markera de utkast du vill radera och klicka sedan på knappen nedan';
$lang['sv_SE']['NewsletterAdmin_right.ss']['CANCEL'] = 'Avbryt';
$lang['sv_SE']['NewsletterAdmin_right.ss']['ENTIRE'] = 'Skicka till hela sändlistan';
$lang['sv_SE']['NewsletterAdmin_right.ss']['ONLYNOT'] = 'Skicka bara till de som det inte har skickats till tidigare';
$lang['sv_SE']['NewsletterAdmin_right.ss']['SEND'] = 'Skicka nyhetsbrev';
$lang['sv_SE']['NewsletterAdmin_right.ss']['SENDTEST'] = 'Skicka test till';
$lang['sv_SE']['NewsletterAdmin_right.ss']['WELCOME1'] = 'Välkommen till';
$lang['sv_SE']['NewsletterAdmin_right.ss']['WELCOME2'] = 'nyhetsbrevs-sektion. Välj en mapp till vänster.';
$lang['sv_SE']['NewsletterAdmin_SiteTree.ss']['DRAFTS'] = 'Utkast';
$lang['sv_SE']['NewsletterAdmin_SiteTree.ss']['MAILLIST'] = 'Sändlista';
$lang['sv_SE']['NewsletterAdmin_SiteTree.ss']['SENT'] = 'Skickade artiklar';
$lang['sv_SE']['NewsletterAdmin_UnsubscribedList.ss']['NOUNSUB'] = 'Inga användare har sagt upp prenumerationen på det här nyhetsbrevet.';
$lang['sv_SE']['NewsletterAdmin_UnsubscribedList.ss']['UNAME'] = 'Användarnamn';
$lang['sv_SE']['NewsletterAdmin_UnsubscribedList.ss']['UNSUBON'] = 'Sa upp prenumerationen den';
$lang['sv_SE']['NewsletterList.ss']['CHOOSEDRAFT1'] = 'Välj ett utkast till vänster, eller';
$lang['sv_SE']['NewsletterList.ss']['CHOOSEDRAFT2'] = 'lägg till en';
$lang['sv_SE']['NewsletterList.ss']['CHOOSESENT'] = 'Var god välj en artikel till vänster';
$lang['sv_SE']['Newsletter_RecipientImportField.ss']['CHANGED'] = 'Antal detaljer ändrade:';
$lang['sv_SE']['Newsletter_RecipientImportField.ss']['IMPORTED'] = 'Nya medlemmar importerade:';
$lang['sv_SE']['Newsletter_RecipientImportField.ss']['IMPORTNEW'] = 'Importera nya medlemmar';
$lang['sv_SE']['Newsletter_RecipientImportField.ss']['SEC'] = 'sekunder';
$lang['sv_SE']['Newsletter_RecipientImportField.ss']['TIME'] = 'Tidsåtgång:';
$lang['sv_SE']['Newsletter_RecipientImportField.ss']['UPDATED'] = 'Uppdaterade medlemmar:';
$lang['sv_SE']['Newsletter_RecipientImportField_Table.ss']['CONTENTSOF'] = 'Innehåll';
$lang['sv_SE']['Newsletter_RecipientImportField_Table.ss']['NO'] = 'Ångra';
$lang['sv_SE']['Newsletter_RecipientImportField_Table.ss']['RECIMPORTED'] = 'Mottagare importerade från';
$lang['sv_SE']['Newsletter_RecipientImportField_Table.ss']['YES'] = 'Bekräfta';
$lang['sv_SE']['Newsletter_SentStatusReport.ss']['DATE'] = 'Datum';
$lang['sv_SE']['Newsletter_SentStatusReport.ss']['EMAIL'] = 'E-post';
$lang['sv_SE']['Newsletter_SentStatusReport.ss']['FN'] = 'Förnamn';
$lang['sv_SE']['Newsletter_SentStatusReport.ss']['NEWSNEVERSENT'] = 'Inget nyhetsbrev har skickats till följande prenumeranter';
$lang['sv_SE']['Newsletter_SentStatusReport.ss']['RES'] = 'Resultat';
$lang['sv_SE']['Newsletter_SentStatusReport.ss']['SENDBOUNCED'] = 'Sändningen till följande mottagare studsade';
$lang['sv_SE']['Newsletter_SentStatusReport.ss']['SENDFAIL'] = 'Sändingen till följande mottagare misslyckades';
$lang['sv_SE']['Newsletter_SentStatusReport.ss']['SENTOK'] = 'Sändningen till följande mottagare lyckades';
$lang['sv_SE']['Newsletter_SentStatusReport.ss']['SN'] = 'Efternamn';

?>