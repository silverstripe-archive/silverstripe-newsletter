<?php

/**
 * Catalan (Andorra) language pack
 * @package modules: newsletter
 * @subpackage i18n
 */

i18n::include_locale_file('modules: newsletter', 'en_US');

global $lang;

if(array_key_exists('ca_AD', $lang) && is_array($lang['ca_AD'])) {
	$lang['ca_AD'] = array_merge($lang['en_US'], $lang['ca_AD']);
} else {
	$lang['ca_AD'] = $lang['en_US'];
}

$lang['ca_AD']['LeftAndMain']['NEWSLETTERS'] = 'Notícies';
$lang['ca_AD']['NewsletterAdmin']['FROMEM'] = 'Adreça de correu des de';
$lang['ca_AD']['NewsletterAdmin']['MEWDRAFTMEWSL'] = 'Nou esborrany de butlletí';
$lang['ca_AD']['NewsletterAdmin']['NEWLIST'] = 'Nova llista de correu';
$lang['ca_AD']['NewsletterAdmin']['NEWNEWSLTYPE'] = 'Nou tipus de butlletí';
$lang['ca_AD']['NewsletterAdmin']['NEWSLTYPE'] = 'Tipus de butlletí';
$lang['ca_AD']['NewsletterAdmin']['PLEASEENTERMAIL'] = 'Si us plau, introduïu una adreça de correu electrònic';
$lang['ca_AD']['NewsletterAdmin']['RESEND'] = 'Reenvia';
$lang['ca_AD']['NewsletterAdmin']['SAVE'] = 'Desa';
$lang['ca_AD']['NewsletterAdmin']['SAVED'] = 'S\'ha desat';
$lang['ca_AD']['NewsletterAdmin']['SEND'] = 'Envia...';
$lang['ca_AD']['NewsletterAdmin']['SENDING'] = 'S\'estan enviant els correus...';
$lang['ca_AD']['NewsletterAdmin']['SENTTESTTO'] = 'Envia una prova a';
$lang['ca_AD']['NewsletterAdmin']['SHOWCONTENTS'] = 'Mostra els continguts';
$lang['ca_AD']['NewsletterAdmin_BouncedList.ss']['EMADD'] = 'Adreça de correu';
$lang['ca_AD']['NewsletterAdmin_BouncedList.ss']['HAVEBOUNCED'] = 'Correus que han rebotat';
$lang['ca_AD']['NewsletterAdmin_BouncedList.ss']['NOBOUNCED'] = 'Cap correu enviat ha rebotat.';
$lang['ca_AD']['NewsletterAdmin_BouncedList.ss']['UNAME'] = 'Nom d\'usuari';
$lang['ca_AD']['NewsletterAdmin_left.ss']['ADDDRAFT'] = 'Afegeix un nou esborrany';
$lang['ca_AD']['NewsletterAdmin_left.ss']['ADDTYPE'] = 'Afegeix un nou tipus';
$lang['ca_AD']['NewsletterAdmin_left.ss']['CREATE'] = 'Crea';
$lang['ca_AD']['NewsletterAdmin_left.ss']['DEL'] = 'Suprimeix';
$lang['ca_AD']['NewsletterAdmin_left.ss']['DELETEDRAFTS'] = 'Suprimeix els esborranys seleccionats';
$lang['ca_AD']['NewsletterAdmin_left.ss']['GO'] = 'Vés';
$lang['ca_AD']['NewsletterAdmin_left.ss']['NEWSLETTERS'] = 'Butlletins';
$lang['ca_AD']['NewsletterAdmin_left.ss']['SELECTDRAFTS'] = 'Seleccioneu els esborranys que voleu eliminar i després premeu al botó de sota';
$lang['ca_AD']['NewsletterAdmin_right.ss']['CANCEL'] = 'Cancel·la';
$lang['ca_AD']['NewsletterAdmin_right.ss']['ENTIRE'] = 'Envia a tota la llista de correu';
$lang['ca_AD']['NewsletterAdmin_right.ss']['ONLYNOT'] = 'Envia només a gent a qui no s\'ha enviat abans';
$lang['ca_AD']['NewsletterAdmin_right.ss']['SEND'] = 'Envia el butlletí';
$lang['ca_AD']['NewsletterAdmin_right.ss']['SENDTEST'] = 'Envia una prova a';
$lang['ca_AD']['NewsletterAdmin_right.ss']['WELCOME1'] = 'Benvingut a la secció del ';
$lang['ca_AD']['NewsletterAdmin_right.ss']['WELCOME2'] = 'd\'administració dels butlletins. Si us plau, trieu una carpeta de la dreta.';
$lang['ca_AD']['NewsletterAdmin_SiteTree.ss']['DRAFTS'] = 'Esborranys';
$lang['ca_AD']['NewsletterAdmin_SiteTree.ss']['MAILLIST'] = 'Llista de correu';
$lang['ca_AD']['NewsletterAdmin_SiteTree.ss']['SENT'] = 'Elements enviats';
$lang['ca_AD']['NewsletterAdmin_UnsubscribedList.ss']['NOUNSUB'] = 'Cap usuari s\'ha desubscrit d\'aquest butlletí.';
$lang['ca_AD']['NewsletterAdmin_UnsubscribedList.ss']['UNAME'] = 'Nom d\'usuari';
$lang['ca_AD']['NewsletterAdmin_UnsubscribedList.ss']['UNSUBON'] = 'Desubscrit el';
$lang['ca_AD']['NewsletterList.ss']['CHOOSEDRAFT1'] = 'Si us plau, trieu un esborrany de l\'esquerra, o bé';
$lang['ca_AD']['NewsletterList.ss']['CHOOSEDRAFT2'] = 'afegiu-ne un de nou';
$lang['ca_AD']['NewsletterList.ss']['CHOOSESENT'] = 'Si us plau, trieu un element enviat de l\'esquerra.';
$lang['ca_AD']['Newsletter_RecipientImportField.ss']['CHANGED'] = 'Nombre de detalls canviats:';
$lang['ca_AD']['Newsletter_RecipientImportField.ss']['IMPORTED'] = 'Nous membres importats:';
$lang['ca_AD']['Newsletter_RecipientImportField.ss']['IMPORTNEW'] = 'S\'han importat nous membres';
$lang['ca_AD']['Newsletter_RecipientImportField.ss']['SEC'] = 'segons';
$lang['ca_AD']['Newsletter_RecipientImportField.ss']['SKIPPED'] = 'Registres omesos:';
$lang['ca_AD']['Newsletter_RecipientImportField.ss']['TIME'] = 'Temps transcorregut:';
$lang['ca_AD']['Newsletter_RecipientImportField.ss']['UPDATED'] = 'Membres actualitzats:';
$lang['ca_AD']['Newsletter_RecipientImportField_Table.ss']['CONTENTSOF'] = 'Continguts de';
$lang['ca_AD']['Newsletter_RecipientImportField_Table.ss']['NO'] = 'Cancel·la';
$lang['ca_AD']['Newsletter_RecipientImportField_Table.ss']['RECIMPORTED'] = 'Destinataris importats de';
$lang['ca_AD']['Newsletter_RecipientImportField_Table.ss']['YES'] = 'Confirma';
$lang['ca_AD']['Newsletter_SentStatusReport.ss']['DATE'] = 'Data';
$lang['ca_AD']['Newsletter_SentStatusReport.ss']['EMAIL'] = 'Correu electrònic';
$lang['ca_AD']['Newsletter_SentStatusReport.ss']['FN'] = 'Nom';
$lang['ca_AD']['Newsletter_SentStatusReport.ss']['NEWSNEVERSENT'] = 'El butlletí no s\'ha enviat mai als següents subscriptors';
$lang['ca_AD']['Newsletter_SentStatusReport.ss']['RES'] = 'Resultat';
$lang['ca_AD']['Newsletter_SentStatusReport.ss']['SENDBOUNCED'] = 'L\'enviament als següents destinataris ha rebotat';
$lang['ca_AD']['Newsletter_SentStatusReport.ss']['SENDFAIL'] = 'Ha fallat l\'enviament als següents destinataris';
$lang['ca_AD']['Newsletter_SentStatusReport.ss']['SENTOK'] = 'L\'enviament als següents destinataris ha tingut èxit';
$lang['ca_AD']['Newsletter_SentStatusReport.ss']['SN'] = 'Cognom';

?>