<?php

/**
 * French (France) language pack
 * @package modules: newsletter
 * @subpackage i18n
 */

i18n::include_locale_file('modules: newsletter', 'en_US');

global $lang;

if(array_key_exists('fr_FR', $lang) && is_array($lang['fr_FR'])) {
	$lang['fr_FR'] = array_merge($lang['en_US'], $lang['fr_FR']);
} else {
	$lang['fr_FR'] = $lang['en_US'];
}

$lang['fr_FR']['LeftAndMain']['NEWSLETTERS'] = 'Newsletters';
$lang['fr_FR']['NewsletterAdmin']['FROMEM'] = 'Email expéditeur';
$lang['fr_FR']['NewsletterAdmin']['MEWDRAFTMEWSL'] = 'Nouvelle liste brouillon';
$lang['fr_FR']['NewsletterAdmin']['NEWLIST'] = 'Nouvelle liste d\'emails';
$lang['fr_FR']['NewsletterAdmin']['NEWNEWSLTYPE'] = 'Nouveau type de news-lettre';
$lang['fr_FR']['NewsletterAdmin']['NEWSLTYPE'] = 'Type de news-lettre';
$lang['fr_FR']['NewsletterAdmin']['PLEASEENTERMAIL'] = 'Entrer une adresse mail s\'il vous plaît';
$lang['fr_FR']['NewsletterAdmin']['RESEND'] = 'Réenvoyer';
$lang['fr_FR']['NewsletterAdmin']['SAVE'] = 'Enregistrer';
$lang['fr_FR']['NewsletterAdmin']['SAVED'] = 'Enregistré';
$lang['fr_FR']['NewsletterAdmin']['SEND'] = 'Envoyer...';
$lang['fr_FR']['NewsletterAdmin']['SENDING'] = 'Emails en cours d\'envoi...';
$lang['fr_FR']['NewsletterAdmin']['SENTTESTTO'] = 'Envoyer un test à';
$lang['fr_FR']['NewsletterAdmin']['SHOWCONTENTS'] = 'Afficher les contenus';
$lang['fr_FR']['NewsletterAdmin_BouncedList.ss']['EMADD'] = 'Adresse email';
$lang['fr_FR']['NewsletterAdmin_BouncedList.ss']['HAVEBOUNCED'] = 'Emails non reçus';
$lang['fr_FR']['NewsletterAdmin_BouncedList.ss']['NOBOUNCED'] = 'Tous les emails envoyés ont été reçus.';
$lang['fr_FR']['NewsletterAdmin_BouncedList.ss']['UNAME'] = 'Nom d\'utilisateur';
$lang['fr_FR']['NewsletterAdmin_left.ss']['ADDDRAFT'] = 'Ajouter un nouveau brouillon';
$lang['fr_FR']['NewsletterAdmin_left.ss']['ADDTYPE'] = 'Ajouter un nouveau type';
$lang['fr_FR']['NewsletterAdmin_left.ss']['CREATE'] = 'Créer...';
$lang['fr_FR']['NewsletterAdmin_left.ss']['DEL'] = 'Supprimer...';
$lang['fr_FR']['NewsletterAdmin_left.ss']['DELETEDRAFTS'] = 'Supprimer les brouillons sélectionnés';
$lang['fr_FR']['NewsletterAdmin_left.ss']['GO'] = 'Go';
$lang['fr_FR']['NewsletterAdmin_left.ss']['NEWSLETTERS'] = 'News-Lettres';
$lang['fr_FR']['NewsletterAdmin_left.ss']['SELECTDRAFTS'] = 'Sélectionner les brouillons que vous voulez supprimer et puis cliquer sur le bouton ci-dessous';
$lang['fr_FR']['NewsletterAdmin_right.ss']['CANCEL'] = 'Annuler';
$lang['fr_FR']['NewsletterAdmin_right.ss']['ENTIRE'] = 'Envoyer à toute la liste d\'emails';
$lang['fr_FR']['NewsletterAdmin_right.ss']['ONLYNOT'] = 'Envoyer seulement aux personnes ne l\'ayant pas encore reçu';
$lang['fr_FR']['NewsletterAdmin_right.ss']['SEND'] = 'Envoyer à la liste d\'email';
$lang['fr_FR']['NewsletterAdmin_right.ss']['SENDTEST'] = 'Envoyer un test à';
$lang['fr_FR']['NewsletterAdmin_right.ss']['WELCOME1'] = 'Bienvenue dans le';
$lang['fr_FR']['NewsletterAdmin_right.ss']['WELCOME2'] = 'Section administration des listes. Choisir un dossier à gauche s\'il vous plaît.';
$lang['fr_FR']['NewsletterAdmin_SiteTree.ss']['DRAFTS'] = 'Brouillons';
$lang['fr_FR']['NewsletterAdmin_SiteTree.ss']['MAILLIST'] = 'Liste d\'adresses';
$lang['fr_FR']['NewsletterAdmin_SiteTree.ss']['SENT'] = 'Envoyés';
$lang['fr_FR']['NewsletterAdmin_UnsubscribedList.ss']['NOUNSUB'] = 'Aucun utilisateur ne s\'est désinscrit de cette liste d\'adresses';
$lang['fr_FR']['NewsletterAdmin_UnsubscribedList.ss']['UNAME'] = 'Nom d\'utilisateur';
$lang['fr_FR']['NewsletterAdmin_UnsubscribedList.ss']['UNSUBON'] = 'Désinscrit de';
$lang['fr_FR']['NewsletterList.ss']['CHOOSEDRAFT1'] = 'Choisir un brouillon à gauche s\'il vous plaît, ou';
$lang['fr_FR']['NewsletterList.ss']['CHOOSEDRAFT2'] = 'Ajouter un';
$lang['fr_FR']['NewsletterList.ss']['CHOOSESENT'] = 'Choisir un envoi à gauche s\'il vous plaît.';
$lang['fr_FR']['Newsletter_RecipientImportField.ss']['CHANGED'] = 'Nombre de détails modifiés :';
$lang['fr_FR']['Newsletter_RecipientImportField.ss']['IMPORTED'] = 'Nouveaux membres importés :';
$lang['fr_FR']['Newsletter_RecipientImportField.ss']['IMPORTNEW'] = 'Nouveaux membres importés';
$lang['fr_FR']['Newsletter_RecipientImportField.ss']['SEC'] = 'secondes';
$lang['fr_FR']['Newsletter_RecipientImportField.ss']['SKIPPED'] = 'Enregistrements sautés :';
$lang['fr_FR']['Newsletter_RecipientImportField.ss']['TIME'] = 'Temps nécéssité :';
$lang['fr_FR']['Newsletter_RecipientImportField.ss']['UPDATED'] = 'Membres modifiés :';
$lang['fr_FR']['Newsletter_RecipientImportField_Table.ss']['CONTENTSOF'] = 'Contenu de';
$lang['fr_FR']['Newsletter_RecipientImportField_Table.ss']['NO'] = 'Annuler';
$lang['fr_FR']['Newsletter_RecipientImportField_Table.ss']['RECIMPORTED'] = 'Destinataires importé de';
$lang['fr_FR']['Newsletter_RecipientImportField_Table.ss']['YES'] = 'Confirmer';
$lang['fr_FR']['Newsletter_SentStatusReport.ss']['DATE'] = 'Date';
$lang['fr_FR']['Newsletter_SentStatusReport.ss']['EMAIL'] = 'Email';
$lang['fr_FR']['Newsletter_SentStatusReport.ss']['FN'] = 'Prénom';
$lang['fr_FR']['Newsletter_SentStatusReport.ss']['NEWSNEVERSENT'] = 'La news-lettre n\'a jamais été envoyée aux inscrits suivants';
$lang['fr_FR']['Newsletter_SentStatusReport.ss']['RES'] = 'Résultat';
$lang['fr_FR']['Newsletter_SentStatusReport.ss']['SENDBOUNCED'] = 'Envois aux Destinataires Suivants Non Reçus';
$lang['fr_FR']['Newsletter_SentStatusReport.ss']['SENDFAIL'] = 'Envois aux Destinataires Suivants Echoué';
$lang['fr_FR']['Newsletter_SentStatusReport.ss']['SENTOK'] = 'L\'Envoi aux Destinataires Suivants a été Réussi';
$lang['fr_FR']['Newsletter_SentStatusReport.ss']['SN'] = 'Nom de famille';

?>