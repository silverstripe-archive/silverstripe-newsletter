<?php

/**
 * Estonian (Estonia) language pack
 * @package modules: newsletter
 * @subpackage i18n
 */

i18n::include_locale_file('modules: newsletter', 'en_US');

global $lang;

if(array_key_exists('et_EE', $lang) && is_array($lang['et_EE'])) {
	$lang['et_EE'] = array_merge($lang['en_US'], $lang['et_EE']);
} else {
	$lang['et_EE'] = $lang['en_US'];
}

$lang['et_EE']['LeftAndMain']['NEWSLETTERS'] = 'Uudiskirjad';
$lang['et_EE']['NewsletterAdmin']['FROMEM'] = 'E-posti aadressilt';
$lang['et_EE']['NewsletterAdmin']['MEWDRAFTMEWSL'] = 'Uus uudiskirja visand';
$lang['et_EE']['NewsletterAdmin']['NEWLIST'] = 'Uus meililist';
$lang['et_EE']['NewsletterAdmin']['NEWNEWSLTYPE'] = 'Uus uudiskirja tüüp';
$lang['et_EE']['NewsletterAdmin']['NEWSLTYPE'] = 'Tüüp';
$lang['et_EE']['NewsletterAdmin']['PLEASEENTERMAIL'] = 'Palun sisesta e-posti aadress';
$lang['et_EE']['NewsletterAdmin']['RESEND'] = 'Saada uuesti';
$lang['et_EE']['NewsletterAdmin']['SAVE'] = 'Salvesta';
$lang['et_EE']['NewsletterAdmin']['SAVED'] = 'Salvestatud';
$lang['et_EE']['NewsletterAdmin']['SEND'] = 'Saada...';
$lang['et_EE']['NewsletterAdmin']['SENDING'] = 'Saadan e-poste...';
$lang['et_EE']['NewsletterAdmin']['SENTTESTTO'] = 'Test saadeti aadressile';
$lang['et_EE']['NewsletterAdmin']['SHOWCONTENTS'] = 'Näita sisu';
$lang['et_EE']['NewsletterAdmin_BouncedList.ss']['EMADD'] = 'E-posti aadress';
$lang['et_EE']['NewsletterAdmin_BouncedList.ss']['HAVEBOUNCED'] = 'Tagasi saadetud kirjad';
$lang['et_EE']['NewsletterAdmin_BouncedList.ss']['NOBOUNCED'] = 'Ühtegi saadetud e-posti pole tagasi saadetud.';
$lang['et_EE']['NewsletterAdmin_BouncedList.ss']['UNAME'] = 'Kasutajanimi';
$lang['et_EE']['NewsletterAdmin_left.ss']['ADDDRAFT'] = 'Lisa uus visand';
$lang['et_EE']['NewsletterAdmin_left.ss']['ADDTYPE'] = 'Lisa uus tüüp';
$lang['et_EE']['NewsletterAdmin_left.ss']['CREATE'] = 'Loo';
$lang['et_EE']['NewsletterAdmin_left.ss']['DEL'] = 'Kustuta';
$lang['et_EE']['NewsletterAdmin_left.ss']['DELETEDRAFTS'] = 'Kustuta valitud visandid';
$lang['et_EE']['NewsletterAdmin_left.ss']['GO'] = 'Mine';
$lang['et_EE']['NewsletterAdmin_left.ss']['NEWSLETTERS'] = 'Uudiskirjad';
$lang['et_EE']['NewsletterAdmin_left.ss']['SELECTDRAFTS'] = 'Vali visandid, mida soovid kustutada ning klõpsa allolevat nuppu';
$lang['et_EE']['NewsletterAdmin_right.ss']['CANCEL'] = 'Tühista';
$lang['et_EE']['NewsletterAdmin_right.ss']['ENTIRE'] = 'Saada kogu meililistile';
$lang['et_EE']['NewsletterAdmin_right.ss']['ONLYNOT'] = 'Saada ainult nendele, kellele eelnevalt saadetud pole';
$lang['et_EE']['NewsletterAdmin_right.ss']['SEND'] = 'Saada uudiskiri';
$lang['et_EE']['NewsletterAdmin_right.ss']['SENDTEST'] = 'Saada test';
$lang['et_EE']['NewsletterAdmin_right.ss']['WELCOME1'] = 'Tere tulemast';
$lang['et_EE']['NewsletterAdmin_right.ss']['WELCOME2'] = 'uudiskirja administreerimise rubriiki. Palun valige kaust vasakult.';
$lang['et_EE']['NewsletterAdmin_SiteTree.ss']['DRAFTS'] = 'Visandid';
$lang['et_EE']['NewsletterAdmin_SiteTree.ss']['MAILLIST'] = 'Meililist';
$lang['et_EE']['NewsletterAdmin_SiteTree.ss']['SENT'] = 'Saadetud kirjad';
$lang['et_EE']['NewsletterAdmin_UnsubscribedList.ss']['NOUNSUB'] = 'Ükski kasutaja pole selle uudiskirja tellimust tühistanud.';
$lang['et_EE']['NewsletterAdmin_UnsubscribedList.ss']['UNAME'] = 'Kasutajanimi';
$lang['et_EE']['NewsletterAdmin_UnsubscribedList.ss']['UNSUBON'] = 'Tellimus tühistatud';
$lang['et_EE']['NewsletterList.ss']['CHOOSEDRAFT1'] = 'Palun vali visand vasakult, või';
$lang['et_EE']['NewsletterList.ss']['CHOOSEDRAFT2'] = 'lisa uus';
$lang['et_EE']['NewsletterList.ss']['CHOOSESENT'] = 'Palun vali saadetud kiri vasakult.';
$lang['et_EE']['Newsletter_RecipientImportField.ss']['CHANGED'] = 'Muudetud üksikasjade arv:';
$lang['et_EE']['Newsletter_RecipientImportField.ss']['IMPORTED'] = 'Uued imporditud liikmed:';
$lang['et_EE']['Newsletter_RecipientImportField.ss']['IMPORTNEW'] = 'Imporditud uued liikmed';
$lang['et_EE']['Newsletter_RecipientImportField.ss']['SEC'] = 'sekundit';
$lang['et_EE']['Newsletter_RecipientImportField.ss']['SKIPPED'] = 'Vahele jäetud kirjed:';
$lang['et_EE']['Newsletter_RecipientImportField.ss']['TIME'] = 'Aega võttis:';
$lang['et_EE']['Newsletter_RecipientImportField.ss']['UPDATED'] = 'Uuendatud liikmed:';
$lang['et_EE']['Newsletter_RecipientImportField_Table.ss']['CONTENTSOF'] = 'Sisu';
$lang['et_EE']['Newsletter_RecipientImportField_Table.ss']['NO'] = 'Tühista';
$lang['et_EE']['Newsletter_RecipientImportField_Table.ss']['RECIMPORTED'] = 'Vastuvõtjad imporditud';
$lang['et_EE']['Newsletter_RecipientImportField_Table.ss']['YES'] = 'Kinnita';
$lang['et_EE']['Newsletter_SentStatusReport.ss']['DATE'] = 'Kuupäev';
$lang['et_EE']['Newsletter_SentStatusReport.ss']['EMAIL'] = 'E-post';
$lang['et_EE']['Newsletter_SentStatusReport.ss']['FN'] = 'Eesnimi';
$lang['et_EE']['Newsletter_SentStatusReport.ss']['NEWSNEVERSENT'] = 'Uudiskirja ei ole kunagi saadetud järgnevatele vastuvõtjatele';
$lang['et_EE']['Newsletter_SentStatusReport.ss']['RES'] = 'Tulemus';
$lang['et_EE']['Newsletter_SentStatusReport.ss']['SENDBOUNCED'] = 'Järgnevatelt vastuvõtjatelt saadeti kiri tagasi';
$lang['et_EE']['Newsletter_SentStatusReport.ss']['SENDFAIL'] = 'Järgnevatele vastuvõtjatele saatmine ebaõnnestus';
$lang['et_EE']['Newsletter_SentStatusReport.ss']['SENTOK'] = 'Järgnevatele vastuvõtjatele saatmine õnnestus';
$lang['et_EE']['Newsletter_SentStatusReport.ss']['SN'] = 'Perekonnanimi';

?>