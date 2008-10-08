<?php

/**
 * Esperanto language pack
 * @package modules: newsletter
 * @subpackage i18n
 */

i18n::include_locale_file('modules: newsletter', 'en_US');

global $lang;

if(array_key_exists('eo_XX', $lang) && is_array($lang['eo_XX'])) {
	$lang['eo_XX'] = array_merge($lang['en_US'], $lang['eo_XX']);
} else {
	$lang['eo_XX'] = $lang['en_US'];
}

$lang['eo_XX']['LeftAndMain']['NEWSLETTERS'] = 'Informiloj';
$lang['eo_XX']['NewsletterAdmin']['FROMEM'] = 'De retpoŝta adreso';
$lang['eo_XX']['NewsletterAdmin']['MEWDRAFTMEWSL'] = 'Nova malneta novaĵletero';
$lang['eo_XX']['NewsletterAdmin']['NEWLIST'] = 'Nova dissendolisto';
$lang['eo_XX']['NewsletterAdmin']['NEWNEWSLTYPE'] = 'Nova tipo de novaĵletero';
$lang['eo_XX']['NewsletterAdmin']['NEWSLTYPE'] = 'Tipo de novaĵletero';
$lang['eo_XX']['NewsletterAdmin']['PLEASEENTERMAIL'] = 'Bonvolu enmeti retpoŝtan adreson';
$lang['eo_XX']['NewsletterAdmin']['RESEND'] = 'Resendu';
$lang['eo_XX']['NewsletterAdmin']['SAVE'] = 'Konservu';
$lang['eo_XX']['NewsletterAdmin']['SAVED'] = 'Konservis';
$lang['eo_XX']['NewsletterAdmin']['SEND'] = 'Sendu...';
$lang['eo_XX']['NewsletterAdmin']['SENDING'] = 'Sendas retpoŝtajn mesaĝojn...';
$lang['eo_XX']['NewsletterAdmin']['SENTTESTTO'] = 'Sendis teston al';
$lang['eo_XX']['NewsletterAdmin']['SHOWCONTENTS'] = 'Montru enhavon';
$lang['eo_XX']['NewsletterAdmin_BouncedList.ss']['EMADD'] = 'Retpoŝta adreso';
$lang['eo_XX']['NewsletterAdmin_BouncedList.ss']['HAVEBOUNCED'] = 'Retpoŝtaj mesaĝoj nesendeblaj';
$lang['eo_XX']['NewsletterAdmin_BouncedList.ss']['NOBOUNCED'] = 'Neniuj retpoŝtaj mesaĝoj senditaj estas nesendeblaj.';
$lang['eo_XX']['NewsletterAdmin_BouncedList.ss']['UNAME'] = 'Salutnomo';
$lang['eo_XX']['NewsletterAdmin_left.ss']['ADDDRAFT'] = 'Almetu novan projekton';
$lang['eo_XX']['NewsletterAdmin_left.ss']['ADDTYPE'] = 'Enmetu novan tipon ';
$lang['eo_XX']['NewsletterAdmin_left.ss']['CREATE'] = 'Kreu';
$lang['eo_XX']['NewsletterAdmin_left.ss']['DEL'] = 'Forigu';
$lang['eo_XX']['NewsletterAdmin_left.ss']['DELETEDRAFTS'] = 'Forigu la elektitajn projektojn';
$lang['eo_XX']['NewsletterAdmin_left.ss']['GO'] = 'Ek';
$lang['eo_XX']['NewsletterAdmin_left.ss']['NEWSLETTERS'] = 'Novaĵleteroj';
$lang['eo_XX']['NewsletterAdmin_left.ss']['SELECTDRAFTS'] = 'Elektu la projektojn forigotajn kaj poste alklaku la butonon sube';
$lang['eo_XX']['NewsletterAdmin_right.ss']['CANCEL'] = 'Rezigni';
$lang['eo_XX']['NewsletterAdmin_right.ss']['ENTIRE'] = 'Sendi la tutan dissendoliston';
$lang['eo_XX']['NewsletterAdmin_right.ss']['ONLYNOT'] = 'Sendi nur al homoj, al kiuj vi ne antaŭe sendis';
$lang['eo_XX']['NewsletterAdmin_right.ss']['SEND'] = 'Sendu novaĵleteron';
$lang['eo_XX']['NewsletterAdmin_right.ss']['SENDTEST'] = 'Sendi teston al';
$lang['eo_XX']['NewsletterAdmin_right.ss']['WELCOME1'] = 'Bonvenon al la';
$lang['eo_XX']['NewsletterAdmin_right.ss']['WELCOME2'] = 'Sekcio por mastrumi novaĵleterojn. Bonvolu elekti tekon maldekstre.';
$lang['eo_XX']['NewsletterAdmin_SiteTree.ss']['DRAFTS'] = 'Malnetoj';
$lang['eo_XX']['NewsletterAdmin_SiteTree.ss']['MAILLIST'] = 'Dissendolisto';
$lang['eo_XX']['NewsletterAdmin_SiteTree.ss']['SENT'] = 'Eroj senditaj';
$lang['eo_XX']['NewsletterAdmin_UnsubscribedList.ss']['NOUNSUB'] = 'Neniuj uzantoj malabonis ĉi tiun novaĵleteron.';
$lang['eo_XX']['NewsletterAdmin_UnsubscribedList.ss']['UNAME'] = 'Salutnomo';
$lang['eo_XX']['NewsletterAdmin_UnsubscribedList.ss']['UNSUBON'] = 'Malabonis je';
$lang['eo_XX']['NewsletterList.ss']['CHOOSEDRAFT1'] = 'Bonvolu elekti projekton maldekstre, aŭ';
$lang['eo_XX']['NewsletterList.ss']['CHOOSEDRAFT2'] = 'almetu iun';
$lang['eo_XX']['NewsletterList.ss']['CHOOSESENT'] = 'Bonvolu elekti senditan eron maldekstre.';
$lang['eo_XX']['Newsletter_RecipientImportField.ss']['CHANGED'] = 'Nombro de detaloj ŝanĝitaj: ';
$lang['eo_XX']['Newsletter_RecipientImportField.ss']['IMPORTED'] = 'Novaj membroj importitaj:';
$lang['eo_XX']['Newsletter_RecipientImportField.ss']['IMPORTNEW'] = 'Importitaj novaj membroj';
$lang['eo_XX']['Newsletter_RecipientImportField.ss']['SEC'] = 'sekundojn';
$lang['eo_XX']['Newsletter_RecipientImportField.ss']['SKIPPED'] = 'Rikordoj ignoritaj:';
$lang['eo_XX']['Newsletter_RecipientImportField.ss']['TIME'] = 'Tempo pasinta:';
$lang['eo_XX']['Newsletter_RecipientImportField.ss']['UPDATED'] = 'Membroj ĝisdatigitaj:';
$lang['eo_XX']['Newsletter_RecipientImportField_Table.ss']['CONTENTSOF'] = 'Enhavo de';
$lang['eo_XX']['Newsletter_RecipientImportField_Table.ss']['NO'] = 'Rezigni';
$lang['eo_XX']['Newsletter_RecipientImportField_Table.ss']['RECIMPORTED'] = 'Ricevintoj importitaj el';
$lang['eo_XX']['Newsletter_RecipientImportField_Table.ss']['YES'] = 'Konfirmu';
$lang['eo_XX']['Newsletter_SentStatusReport.ss']['DATE'] = 'Dato';
$lang['eo_XX']['Newsletter_SentStatusReport.ss']['EMAIL'] = 'Retpoŝto';
$lang['eo_XX']['Newsletter_SentStatusReport.ss']['FN'] = 'Antaŭnomo';
$lang['eo_XX']['Newsletter_SentStatusReport.ss']['NEWSNEVERSENT'] = 'La informilo neniam estas sendita al la sekvaj abonantoj';
$lang['eo_XX']['Newsletter_SentStatusReport.ss']['RES'] = 'Rezulto';
$lang['eo_XX']['Newsletter_SentStatusReport.ss']['SENDBOUNCED'] = 'Sendi al la sekvaj ricevontoj malsukcesis';
$lang['eo_XX']['Newsletter_SentStatusReport.ss']['SENDFAIL'] = 'Sendi al la sekvaj ricevontoj malsukcesis';
$lang['eo_XX']['Newsletter_SentStatusReport.ss']['SENTOK'] = 'Sendi al la sekvaj ricevontoj sukcesis';
$lang['eo_XX']['Newsletter_SentStatusReport.ss']['SN'] = 'Familia nomo';

?>