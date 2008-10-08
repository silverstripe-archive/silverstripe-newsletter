<?php

/**
 * Romanian (Romania) language pack
 * @package modules: newsletter
 * @subpackage i18n
 */

i18n::include_locale_file('modules: newsletter', 'en_US');

global $lang;

if(array_key_exists('ro_RO', $lang) && is_array($lang['ro_RO'])) {
	$lang['ro_RO'] = array_merge($lang['en_US'], $lang['ro_RO']);
} else {
	$lang['ro_RO'] = $lang['en_US'];
}

$lang['ro_RO']['LeftAndMain']['NEWSLETTERS'] = 'Ştiri';
$lang['ro_RO']['NewsletterAdmin']['FROMEM'] = 'Adresă email expeditor';
$lang['ro_RO']['NewsletterAdmin']['PLEASEENTERMAIL'] = 'Va rugăm introduceţi o adresă de email';
$lang['ro_RO']['NewsletterAdmin']['RESEND'] = 'Retrimite';
$lang['ro_RO']['NewsletterAdmin']['SAVE'] = 'Salvează ';
$lang['ro_RO']['NewsletterAdmin']['SAVED'] = 'Salvat';
$lang['ro_RO']['NewsletterAdmin']['SEND'] = 'Trimite...';
$lang['ro_RO']['NewsletterAdmin']['SENDING'] = 'Se trimit email-urile...';
$lang['ro_RO']['NewsletterAdmin']['SENTTESTTO'] = 'Trimite test către ';
$lang['ro_RO']['NewsletterAdmin']['SHOWCONTENTS'] = 'Afişează conţinutul ';
$lang['ro_RO']['NewsletterAdmin_BouncedList.ss']['EMADD'] = 'Adresă  email';
$lang['ro_RO']['NewsletterAdmin_BouncedList.ss']['UNAME'] = 'Nume utilizator';
$lang['ro_RO']['NewsletterAdmin_left.ss']['ADDTYPE'] = 'Adaugă tip nou';
$lang['ro_RO']['NewsletterAdmin_left.ss']['CREATE'] = 'Creează ';
$lang['ro_RO']['NewsletterAdmin_left.ss']['DEL'] = 'Şterge ';
$lang['ro_RO']['NewsletterAdmin_right.ss']['CANCEL'] = 'Anulează ';
$lang['ro_RO']['NewsletterAdmin_right.ss']['ENTIRE'] = 'Trimite către toată lista de mail';
$lang['ro_RO']['NewsletterAdmin_right.ss']['SENDTEST'] = 'Trimite test către';
$lang['ro_RO']['NewsletterAdmin_right.ss']['WELCOME1'] = 'Bine aţi venit la';
$lang['ro_RO']['NewsletterAdmin_right.ss']['WELCOME2'] = 'Secţiune administrare ştiri. Te rog alege un folder din stânga.';
$lang['ro_RO']['NewsletterAdmin_SiteTree.ss']['MAILLIST'] = 'Lista de Mail';
$lang['ro_RO']['NewsletterAdmin_SiteTree.ss']['SENT'] = 'Elemente Trimise';
$lang['ro_RO']['NewsletterAdmin_UnsubscribedList.ss']['UNAME'] = 'Utilizator';
$lang['ro_RO']['NewsletterList.ss']['CHOOSEDRAFT2'] = 'adaugă unul';
$lang['ro_RO']['Newsletter_RecipientImportField.ss']['IMPORTED'] = 'Membri noi importaţi:';
$lang['ro_RO']['Newsletter_RecipientImportField.ss']['IMPORTNEW'] = 'Membri noi importaţi';
$lang['ro_RO']['Newsletter_RecipientImportField.ss']['SEC'] = 'secunde';
$lang['ro_RO']['Newsletter_RecipientImportField.ss']['UPDATED'] = 'Membri actualizaţi:';
$lang['ro_RO']['Newsletter_RecipientImportField_Table.ss']['CONTENTSOF'] = 'Conţinutul lui';

?>