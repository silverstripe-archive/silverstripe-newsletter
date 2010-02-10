<?php

/**
 * Finnish (Finland) language pack
 * @package modules: newsletter
 * @subpackage i18n
 */

i18n::include_locale_file('modules: newsletter', 'en_US');

global $lang;

if(array_key_exists('fi_FI', $lang) && is_array($lang['fi_FI'])) {
	$lang['fi_FI'] = array_merge($lang['en_US'], $lang['fi_FI']);
} else {
	$lang['fi_FI'] = $lang['en_US'];
}

$lang['fi_FI']['LeftAndMain']['NEWSLETTERS'] = 'Uutiskirjeet';
$lang['fi_FI']['NewsletterAdmin']['FROMEM'] = 'Sähköpostiosoitteesta';
$lang['fi_FI']['NewsletterAdmin']['MEWDRAFTMEWSL'] = 'Uusi uutiskirjeen luonnos';
$lang['fi_FI']['NewsletterAdmin']['NEWLIST'] = 'Uusi sähköpostilista';
$lang['fi_FI']['NewsletterAdmin']['NEWNEWSLTYPE'] = 'Uusi sähköpostilistan tyyppi';
$lang['fi_FI']['NewsletterAdmin']['NEWSLTYPE'] = 'Uutiskirjeen tyyppi';
$lang['fi_FI']['NewsletterAdmin']['PLEASEENTERMAIL'] = 'Syötä sähköpostiosoite';
$lang['fi_FI']['NewsletterAdmin']['RESEND'] = 'Lähetä uudelleen';
$lang['fi_FI']['NewsletterAdmin']['SAVE'] = 'Tallenna';
$lang['fi_FI']['NewsletterAdmin']['SAVED'] = 'Tallennettu';
$lang['fi_FI']['NewsletterAdmin']['SEND'] = 'Lähetä...';
$lang['fi_FI']['NewsletterAdmin']['SENDING'] = 'Lähetetään sähköpostia...';
$lang['fi_FI']['NewsletterAdmin']['SENTTESTTO'] = 'Lähetä testi jnk.:';
$lang['fi_FI']['NewsletterAdmin']['SHOWCONTENTS'] = 'Näytä sisältö';
$lang['fi_FI']['NewsletterAdmin_BouncedList.ss']['EMADD'] = 'Sähköpostiosoite';
$lang['fi_FI']['NewsletterAdmin_BouncedList.ss']['HAVEBOUNCED'] = 'Takaisin kimmonneet sähköpostit';
$lang['fi_FI']['NewsletterAdmin_BouncedList.ss']['NOBOUNCED'] = 'Lähetetyt sähköpostit eivät ole kimmonneet takaisin.';
$lang['fi_FI']['NewsletterAdmin_BouncedList.ss']['UNAME'] = 'Käyttäjänimi';
$lang['fi_FI']['NewsletterAdmin_left.ss']['ADDDRAFT'] = 'Lisää uusi luonnos';
$lang['fi_FI']['NewsletterAdmin_left.ss']['ADDTYPE'] = 'Lisää uusi tyyppi';
$lang['fi_FI']['NewsletterAdmin_left.ss']['CREATE'] = 'Luo';
$lang['fi_FI']['NewsletterAdmin_left.ss']['DEL'] = 'Poista';
$lang['fi_FI']['NewsletterAdmin_left.ss']['DELETEDRAFTS'] = 'Poista valitut luonnokset';
$lang['fi_FI']['NewsletterAdmin_left.ss']['GO'] = 'Siirry';
$lang['fi_FI']['NewsletterAdmin_left.ss']['NEWSLETTERS'] = 'Uutiskirjeet';
$lang['fi_FI']['NewsletterAdmin_left.ss']['SELECTDRAFTS'] = 'Valitse poistettavat luonnokset ja paina alla olevaa nappia';
$lang['fi_FI']['NewsletterAdmin_right.ss']['CANCEL'] = 'Peruuta';
$lang['fi_FI']['NewsletterAdmin_right.ss']['ENTIRE'] = 'Lähetä koko sähköpostilistalle';
$lang['fi_FI']['NewsletterAdmin_right.ss']['ONLYNOT'] = 'Lähetä ainoastaan niille, joille ei ole aikaisemmin lähetetty';
$lang['fi_FI']['NewsletterAdmin_right.ss']['SEND'] = 'Lähetä uutiskirje';
$lang['fi_FI']['NewsletterAdmin_right.ss']['SENDTEST'] = 'Lähetä testi jnk:';
$lang['fi_FI']['NewsletterAdmin_right.ss']['WELCOME1'] = 'Tervetuloa ohjelman';
$lang['fi_FI']['NewsletterAdmin_right.ss']['WELCOME2'] = 'uutiskirjeen hallintaosioon. Valitse kansio vasemmalta.';
$lang['fi_FI']['NewsletterAdmin_SiteTree.ss']['DRAFTS'] = 'Luonnokset';
$lang['fi_FI']['NewsletterAdmin_SiteTree.ss']['MAILLIST'] = 'Sähköpostilista';
$lang['fi_FI']['NewsletterAdmin_SiteTree.ss']['SENT'] = 'Lähetetyt kohdat';
$lang['fi_FI']['NewsletterAdmin_UnsubscribedList.ss']['NOUNSUB'] = 'Kukaan ei ole lopettanut tämän uutiskirjeen tilaamista.';
$lang['fi_FI']['NewsletterAdmin_UnsubscribedList.ss']['UNAME'] = 'Käyttäjänimi';
$lang['fi_FI']['NewsletterAdmin_UnsubscribedList.ss']['UNSUBON'] = 'Tilaus peruttu';
$lang['fi_FI']['NewsletterList.ss']['CHOOSEDRAFT1'] = 'Valitse luonnos vasemmalta tai';
$lang['fi_FI']['NewsletterList.ss']['CHOOSEDRAFT2'] = 'lisää uusi';
$lang['fi_FI']['NewsletterList.ss']['CHOOSESENT'] = 'Valitse lähetettävä asia vasemmalta.';
$lang['fi_FI']['Newsletter_RecipientImportField.ss']['CHANGED'] = 'Muutoksien lukumäärä:';
$lang['fi_FI']['Newsletter_RecipientImportField.ss']['IMPORTED'] = 'Seuraavat jäsenet tuotiin:';
$lang['fi_FI']['Newsletter_RecipientImportField.ss']['IMPORTNEW'] = 'Uusia jäseniä tuotiin';
$lang['fi_FI']['Newsletter_RecipientImportField.ss']['SEC'] = 'sekuntia';
$lang['fi_FI']['Newsletter_RecipientImportField.ss']['SKIPPED'] = 'Ohitetut tietueet:';
$lang['fi_FI']['Newsletter_RecipientImportField.ss']['TIME'] = 'Aikaa kulunut:';
$lang['fi_FI']['Newsletter_RecipientImportField.ss']['UPDATED'] = 'Päivitetyt jäsenet:';
$lang['fi_FI']['Newsletter_RecipientImportField_Table.ss']['CONTENTSOF'] = 'Sisältö:';
$lang['fi_FI']['Newsletter_RecipientImportField_Table.ss']['NO'] = 'Peruuta';
$lang['fi_FI']['Newsletter_RecipientImportField_Table.ss']['RECIMPORTED'] = 'Vastaannottajat tuotu paikasta';
$lang['fi_FI']['Newsletter_RecipientImportField_Table.ss']['YES'] = 'Vahvista';
$lang['fi_FI']['Newsletter_SentStatusReport.ss']['DATE'] = 'Päivämäärä';
$lang['fi_FI']['Newsletter_SentStatusReport.ss']['EMAIL'] = 'Sähköposti';
$lang['fi_FI']['Newsletter_SentStatusReport.ss']['FN'] = 'Etunimi';
$lang['fi_FI']['Newsletter_SentStatusReport.ss']['NEWSNEVERSENT'] = 'Uutiskirjettä ei ole koskaan lähetetty seuraaville henkilöille:';
$lang['fi_FI']['Newsletter_SentStatusReport.ss']['RES'] = 'Tulos';
$lang['fi_FI']['Newsletter_SentStatusReport.ss']['SENDBOUNCED'] = 'Lähetys seuraaville vastaanottajille kimposi takaisin';
$lang['fi_FI']['Newsletter_SentStatusReport.ss']['SENDFAIL'] = 'Lähetys seuraaville vastaanottajille epäonnistui';
$lang['fi_FI']['Newsletter_SentStatusReport.ss']['SENTOK'] = 'Lähetys seuraaville vastaanottajille onnistui';
$lang['fi_FI']['Newsletter_SentStatusReport.ss']['SN'] = 'Sukunimi';

?>