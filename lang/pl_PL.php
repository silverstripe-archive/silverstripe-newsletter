<?php

/**
 * Polish (Poland) language pack
 * @package modules: newsletter
 * @subpackage i18n
 */

i18n::include_locale_file('modules: newsletter', 'en_US');

global $lang;

if(array_key_exists('pl_PL', $lang) && is_array($lang['pl_PL'])) {
	$lang['pl_PL'] = array_merge($lang['en_US'], $lang['pl_PL']);
} else {
	$lang['pl_PL'] = $lang['en_US'];
}

$lang['pl_PL']['LeftAndMain']['NEWSLETTERS'] = 'Newslettery';
$lang['pl_PL']['NewsletterAdmin']['FROMEM'] = 'Adres nadawcy';
$lang['pl_PL']['NewsletterAdmin']['MEWDRAFTMEWSL'] = 'Nowe oczekujące newslettery';
$lang['pl_PL']['NewsletterAdmin']['NEWLIST'] = 'Nowa lista mailingowa';
$lang['pl_PL']['NewsletterAdmin']['NEWNEWSLTYPE'] = 'Nowy rodzaj newslettera';
$lang['pl_PL']['NewsletterAdmin']['NEWSLTYPE'] = 'Rodzaj newslettera';
$lang['pl_PL']['NewsletterAdmin']['PLEASEENTERMAIL'] = 'Proszę wprowadź adres e-mail';
$lang['pl_PL']['NewsletterAdmin']['RESEND'] = 'Prześlij ponownie';
$lang['pl_PL']['NewsletterAdmin']['SAVE'] = 'Zapisz';
$lang['pl_PL']['NewsletterAdmin']['SAVED'] = 'Zapisane';
$lang['pl_PL']['NewsletterAdmin']['SEND'] = 'Wyślij ...';
$lang['pl_PL']['NewsletterAdmin']['SENDING'] = 'Wysyłanie emaili ...';
$lang['pl_PL']['NewsletterAdmin']['SENTTESTTO'] = 'Wysłano test do';
$lang['pl_PL']['NewsletterAdmin']['SHOWCONTENTS'] = 'Pokaż zawartość';
$lang['pl_PL']['NewsletterAdmin_BouncedList.ss']['EMADD'] = 'Adres e-mail';
$lang['pl_PL']['NewsletterAdmin_BouncedList.ss']['HAVEBOUNCED'] = 'Email został odrzucony';
$lang['pl_PL']['NewsletterAdmin_BouncedList.ss']['NOBOUNCED'] = 'Brak odrzuconych maili';
$lang['pl_PL']['NewsletterAdmin_BouncedList.ss']['UNAME'] = 'Nazwa użytkownika';
$lang['pl_PL']['NewsletterAdmin_left.ss']['ADDDRAFT'] = 'Dodaj nową wersję roboczą';
$lang['pl_PL']['NewsletterAdmin_left.ss']['ADDTYPE'] = 'Dodaj nowy wzór';
$lang['pl_PL']['NewsletterAdmin_left.ss']['CREATE'] = 'Stwórz ...';
$lang['pl_PL']['NewsletterAdmin_left.ss']['DEL'] = 'Usuń ...';
$lang['pl_PL']['NewsletterAdmin_left.ss']['DELETEDRAFTS'] = 'Usuń zaznaczone wersje robocze';
$lang['pl_PL']['NewsletterAdmin_left.ss']['GO'] = 'Idź';
$lang['pl_PL']['NewsletterAdmin_left.ss']['NEWSLETTERS'] = 'Newslettery';
$lang['pl_PL']['NewsletterAdmin_left.ss']['SELECTDRAFTS'] = 'Wybierz wersje robocze które chcesz usunąć i kliknij przycisk poniżej';
$lang['pl_PL']['NewsletterAdmin_right.ss']['CANCEL'] = 'Anuluj';
$lang['pl_PL']['NewsletterAdmin_right.ss']['ENTIRE'] = 'Wyślij do całej listy mailingowej';
$lang['pl_PL']['NewsletterAdmin_right.ss']['ONLYNOT'] = 'Wyślij tylko do osób do których poprzednio nie wysłałeś';
$lang['pl_PL']['NewsletterAdmin_right.ss']['SEND'] = 'Wyślij newsletter';
$lang['pl_PL']['NewsletterAdmin_right.ss']['SENDTEST'] = 'Wyślij test do ';
$lang['pl_PL']['NewsletterAdmin_right.ss']['WELCOME1'] = 'Witamy w';
$lang['pl_PL']['NewsletterAdmin_right.ss']['WELCOME2'] = 'Administracja newsletterem. Proszę wybrać folder po lewej';
$lang['pl_PL']['NewsletterAdmin_SiteTree.ss']['DRAFTS'] = 'Oczekujące';
$lang['pl_PL']['NewsletterAdmin_SiteTree.ss']['MAILLIST'] = 'Lista mailingowa';
$lang['pl_PL']['NewsletterAdmin_SiteTree.ss']['SENT'] = 'Wyślij pozycję';
$lang['pl_PL']['NewsletterAdmin_UnsubscribedList.ss']['NOUNSUB'] = 'Nie ma użytkowników nie zapisanych do tego newslettera';
$lang['pl_PL']['NewsletterAdmin_UnsubscribedList.ss']['UNAME'] = 'Nazwa użytkownika';
$lang['pl_PL']['NewsletterAdmin_UnsubscribedList.ss']['UNSUBON'] = 'Nie zapisany';
$lang['pl_PL']['NewsletterList.ss']['CHOOSEDRAFT1'] = 'Proszę wybrać wersje robocze po lewej lub';
$lang['pl_PL']['NewsletterList.ss']['CHOOSEDRAFT2'] = 'dodaj jeden';
$lang['pl_PL']['NewsletterList.ss']['CHOOSESENT'] = 'Proszę wybrać pozycję wyślij po lewej';
$lang['pl_PL']['Newsletter_RecipientImportField.ss']['CHANGED'] = 'Ilość zmienionych detali:';
$lang['pl_PL']['Newsletter_RecipientImportField.ss']['IMPORTED'] = 'Nowi użytkownicy zaimportowani:';
$lang['pl_PL']['Newsletter_RecipientImportField.ss']['IMPORTNEW'] = 'zaimportowani nowi użytkownicy';
$lang['pl_PL']['Newsletter_RecipientImportField.ss']['SEC'] = 'sekundy';
$lang['pl_PL']['Newsletter_RecipientImportField.ss']['SKIPPED'] = 'Archiwalne dokumenty:';
$lang['pl_PL']['Newsletter_RecipientImportField.ss']['TIME'] = 'Czas zużyty:';
$lang['pl_PL']['Newsletter_RecipientImportField.ss']['UPDATED'] = 'Uaktualnieni użytkownicy:';
$lang['pl_PL']['Newsletter_RecipientImportField_Table.ss']['CONTENTSOF'] = 'Zawartość';
$lang['pl_PL']['Newsletter_RecipientImportField_Table.ss']['NO'] = 'Anuluj';
$lang['pl_PL']['Newsletter_RecipientImportField_Table.ss']['RECIMPORTED'] = 'Odbiorcy pobrani z ';
$lang['pl_PL']['Newsletter_RecipientImportField_Table.ss']['YES'] = 'Potwierdź';
$lang['pl_PL']['Newsletter_SentStatusReport.ss']['DATE'] = 'Data';
$lang['pl_PL']['Newsletter_SentStatusReport.ss']['EMAIL'] = 'Email';
$lang['pl_PL']['Newsletter_SentStatusReport.ss']['FN'] = 'Imię';
$lang['pl_PL']['Newsletter_SentStatusReport.ss']['NEWSNEVERSENT'] = 'Newsletter nigdy nie był wysłany do następujących użytkowników';
$lang['pl_PL']['Newsletter_SentStatusReport.ss']['RES'] = 'Rezultat';
$lang['pl_PL']['Newsletter_SentStatusReport.ss']['SENDBOUNCED'] = 'Wysłanie do następujących odbiorców zostało odrzucone';
$lang['pl_PL']['Newsletter_SentStatusReport.ss']['SENDFAIL'] = 'Wysyłanie do następujących odbiorców nie powiodło się';
$lang['pl_PL']['Newsletter_SentStatusReport.ss']['SENTOK'] = 'Wysyłanie do następujących odbiorców powiodło się';
$lang['pl_PL']['Newsletter_SentStatusReport.ss']['SN'] = 'Nazwisko';

?>