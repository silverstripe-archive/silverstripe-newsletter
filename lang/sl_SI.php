<?php

/**
 * Slovenian (Slovenia) language pack
 * @package newsletter
 * @subpackage i18n
 */

i18n::include_locale_file('newsletter', 'en_US');

global $lang;

if(array_key_exists('sl_SI', $lang) && is_array($lang['sl_SI'])) {
	$lang['sl_SI'] = array_merge($lang['en_US'], $lang['sl_SI']);
} else {
	$lang['sl_SI'] = $lang['en_US'];
}

$lang['sl_SI']['']['PREVIEWNEWSLETTER'] = 'Predogled e-obvestila';
$lang['sl_SI']['']['UNSUBSCRIBEDTITLE'] = 'Odjavljeni';
$lang['sl_SI']['BatchProcess_Controller']['ERROR'] = 'Napaka: Postopka ni možno nadaljevati';
$lang['sl_SI']['LeftAndMain']['NEWSLETTERS'] = 'E-obvestila';
$lang['sl_SI']['Member']['EMAILPASSWORDAPPENDIX'] = 'Vaše geslo je bilo spremenjeno. Ker boste to sporočilo morda še potrebovali, vam svetujemo, da ga spravite.';
$lang['sl_SI']['Member']['EMAILPASSWORDINTRO'] = 'Vaše novo geslo';
$lang['sl_SI']['Newsletter']['CONTENT'] = 'Vsebina';
$lang['sl_SI']['Newsletter']['NEWSLETTER'] = 'E-obvestila';
$lang['sl_SI']['Newsletter']['PLURALNAME'] = 'E-obvestila';
$lang['sl_SI']['Newsletter']['SENTAT'] = 'Poslano ob';
$lang['sl_SI']['Newsletter']['SENTREPORT'] = 'Poročilo o pošiljanju';
$lang['sl_SI']['Newsletter']['SINGULARNAME'] = 'E-obvestilo';
$lang['sl_SI']['Newsletter']['SUBJECT'] = 'Zadeva';
$lang['sl_SI']['NewsletterAdmin']['ADDEDTOBL'] = 'je bil dodan na seznam neustreznih';
$lang['sl_SI']['NewsletterAdmin']['BOUNCED'] = 'Nedostavljeno';
$lang['sl_SI']['NewsletterAdmin']['CHOOSEMAILINGGROUP'] = '(Izberite skupino prejemnikov)';
$lang['sl_SI']['NewsletterAdmin']['FROMEM'] = 'Pošiljateljev e-naslov';
$lang['sl_SI']['NewsletterAdmin']['IMPORT'] = 'Uvozi';
$lang['sl_SI']['NewsletterAdmin']['IMPORTFROM'] = 'Uvozi iz datoteke';
$lang['sl_SI']['NewsletterAdmin']['MENUTITLE'] = 'E-obvestila';
$lang['sl_SI']['NewsletterAdmin']['MEWDRAFTMEWSL'] = 'Osnutek novega e-obvestila';
$lang['sl_SI']['NewsletterAdmin']['NEWLIST'] = 'Nov seznam prejemnikov';
$lang['sl_SI']['NewsletterAdmin']['NEWNEWSLTYPE'] = 'Nov tip e-obvestila';
$lang['sl_SI']['NewsletterAdmin']['NEWSLTYPE'] = 'Tip e-obvestila';
$lang['sl_SI']['NewsletterAdmin']['NLSETTINGS'] = 'Nastavitve e-obvestil';
$lang['sl_SI']['NewsletterAdmin']['NONLSPECIFIED'] = 'Nobeno e-obvestilo ni izbrano';
$lang['sl_SI']['NewsletterAdmin']['PLEASEENTERMAIL'] = 'Vpišite e-naslov';
$lang['sl_SI']['NewsletterAdmin']['RECIPIENTS'] = 'Prejemniki';
$lang['sl_SI']['NewsletterAdmin']['REMOVEDFROMBL'] = 'je bil odstranjen s seznama neustreznih';
$lang['sl_SI']['NewsletterAdmin']['REMOVEDSUCCESS'] = 'je bil odstranjen s seznama prejemnikov';
$lang['sl_SI']['NewsletterAdmin']['RESEND'] = 'Ponovno pošlji';
$lang['sl_SI']['NewsletterAdmin']['SAVE'] = 'Shrani';
$lang['sl_SI']['NewsletterAdmin']['SAVED'] = 'Shranjeno';
$lang['sl_SI']['NewsletterAdmin']['SEND'] = 'Pošlji ...';
$lang['sl_SI']['NewsletterAdmin']['SENDING'] = 'Pošiljam e-obvestila ...';
$lang['sl_SI']['NewsletterAdmin']['SENTTESTTO'] = 'Poskusno pošlji na';
$lang['sl_SI']['NewsletterAdmin']['SHOWCONTENTS'] = 'Prikaži vsebino';
$lang['sl_SI']['NewsletterAdmin']['TEMPLATE'] = 'Predloga';
$lang['sl_SI']['NewsletterAdmin']['UNSUBSCRIBERS'] = 'Odjavljeni';
$lang['sl_SI']['NewsletterAdmin_BouncedList.ss']['BLACKLISTED'] = 'Označen kot neustrezen';
$lang['sl_SI']['NewsletterAdmin_BouncedList.ss']['DATE'] = 'Datum';
$lang['sl_SI']['NewsletterAdmin_BouncedList.ss']['EMADD'] = 'E-naslov';
$lang['sl_SI']['NewsletterAdmin_BouncedList.ss']['HAVEBOUNCED'] = 'Nedostavljena e-obvestila';
$lang['sl_SI']['NewsletterAdmin_BouncedList.ss']['INSTRUCTIONS'] = 'Navodila:';
$lang['sl_SI']['NewsletterAdmin_BouncedList.ss']['INSTRUCTIONS1'] = 'Če dovoljujete pošiljanje prejemnikom na seznamu neustreznih, izklopite stikalo (odstranite kljukico).';
$lang['sl_SI']['NewsletterAdmin_BouncedList.ss']['INSTRUCTIONS2'] = 'Da bi e-naslov odstranili s seznama prejemnikov e-obvestil, kliknite na ikono';
$lang['sl_SI']['NewsletterAdmin_BouncedList.ss']['NOBOUNCED'] = 'Nobeno e-poštno sporočilo ni bilo zavrnjeno.';
$lang['sl_SI']['NewsletterAdmin_BouncedList.ss']['RESON'] = 'Vzrok:';
$lang['sl_SI']['NewsletterAdmin_BouncedList.ss']['UNAME'] = 'Uporabniško ime';
$lang['sl_SI']['NewsletterAdmin_left.ss']['ADDDRAFT'] = 'Dodaj nov osnutek';
$lang['sl_SI']['NewsletterAdmin_left.ss']['ADDTYPE'] = 'Dodaj nov tip';
$lang['sl_SI']['NewsletterAdmin_left.ss']['CREATE'] = 'Ustvari';
$lang['sl_SI']['NewsletterAdmin_left.ss']['DEL'] = 'Izbriši';
$lang['sl_SI']['NewsletterAdmin_left.ss']['DELETEDRAFTS'] = 'Izbriši izbrane osnutke';
$lang['sl_SI']['NewsletterAdmin_left.ss']['GO'] = 'Pojdi';
$lang['sl_SI']['NewsletterAdmin_left.ss']['NEWSLETTERS'] = 'E-obvestila';
$lang['sl_SI']['NewsletterAdmin_left.ss']['SELECTDRAFTS'] = 'Izberite osnutke, ki jih nameravate izbrisati, in kliknite na gumb spodaj';
$lang['sl_SI']['NewsletterAdmin_right.ss']['CANCEL'] = 'Prekliči';
$lang['sl_SI']['NewsletterAdmin_right.ss']['ENTIRE'] = 'Pošlji vsem prejemnikom na seznamu';
$lang['sl_SI']['NewsletterAdmin_right.ss']['ONLYNOT'] = 'Pošlji samo tistim, katerim še ni bilo poslano';
$lang['sl_SI']['NewsletterAdmin_right.ss']['SEND'] = 'Pošlji e-obvestilo';
$lang['sl_SI']['NewsletterAdmin_right.ss']['SENDTEST'] = 'Poskusno pošlji na';
$lang['sl_SI']['NewsletterAdmin_right.ss']['WELCOME1'] = 'Dobrodošli na';
$lang['sl_SI']['NewsletterAdmin_right.ss']['WELCOME2'] = 'sklopu za upravljanje z e-obvestili. Izberite mapo na desni strani.';
$lang['sl_SI']['NewsletterAdmin_SiteTree.ss']['DRAFTS'] = 'Osnutki';
$lang['sl_SI']['NewsletterAdmin_SiteTree.ss']['MAILLIST'] = 'Seznam prejemnikov';
$lang['sl_SI']['NewsletterAdmin_SiteTree.ss']['SENT'] = 'Poslano';
$lang['sl_SI']['NewsletterAdmin_UnsubscribedList.ss']['NOUNSUB'] = 'Od tega e-obvestila se ni odjavil noben uporabnik.';
$lang['sl_SI']['NewsletterAdmin_UnsubscribedList.ss']['UNAME'] = 'Uporabniško Ime';
$lang['sl_SI']['NewsletterAdmin_UnsubscribedList.ss']['UNSUBON'] = 'Odjavljeni od';
$lang['sl_SI']['NewsletterEmailBlacklist']['PLURALNAME'] = 'Seznami neustreznih prejemnikov za pošiljanje e-obvestil ';
$lang['sl_SI']['NewsletterEmailBlacklist']['SINGULARNAME'] = 'Seznam neustreznih prejemnikov za pošiljanje e-obvestil ';
$lang['sl_SI']['NewsletterList.ss']['CHOOSEDRAFT1'] = 'Izberite osnutek na levi, ali';
$lang['sl_SI']['NewsletterList.ss']['CHOOSEDRAFT2'] = 'dodaj';
$lang['sl_SI']['NewsletterList.ss']['CHOOSESENT'] = 'Na levi izberite poslano e-obvestilo';
$lang['sl_SI']['NewsletterType']['PLURALNAME'] = 'Tipi e-obvestil';
$lang['sl_SI']['NewsletterType']['SINGULARNAME'] = 'Tip e-obvestila';
$lang['sl_SI']['Newsletter_Recipient']['PLURALNAME'] = 'Prejemniki e-obvestil';
$lang['sl_SI']['Newsletter_Recipient']['SINGULARNAME'] = 'Prejemnik e-obvestil';
$lang['sl_SI']['Newsletter_RecipientImportField.ss']['CHANGED'] = 'Število spremenjenih podatkov:';
$lang['sl_SI']['Newsletter_RecipientImportField.ss']['IMPORTED'] = 'Uvoženi novi člani:';
$lang['sl_SI']['Newsletter_RecipientImportField.ss']['IMPORTNEW'] = 'Uvoženi novi člani';
$lang['sl_SI']['Newsletter_RecipientImportField.ss']['MLRELOAD1'] = 'Da bi lahko videli nove prejemnike, ';
$lang['sl_SI']['Newsletter_RecipientImportField.ss']['MLRELOAD2'] = 'ponovno naložite seznam prejemnikov';
$lang['sl_SI']['Newsletter_RecipientImportField.ss']['SEC'] = 'sekund';
$lang['sl_SI']['Newsletter_RecipientImportField.ss']['SKIPPED'] = 'Število preskočenih zapisov:';
$lang['sl_SI']['Newsletter_RecipientImportField.ss']['TIME'] = 'Trajanje:';
$lang['sl_SI']['Newsletter_RecipientImportField.ss']['UPDATED'] = 'Posodobljeni člani:';
$lang['sl_SI']['Newsletter_RecipientImportField_Table.ss']['CONTENTSOF'] = 'Vsebina';
$lang['sl_SI']['Newsletter_RecipientImportField_Table.ss']['NO'] = 'Prekliči';
$lang['sl_SI']['Newsletter_RecipientImportField_Table.ss']['RECIMPORTED'] = 'Prejemniki uvoženi iz';
$lang['sl_SI']['Newsletter_RecipientImportField_Table.ss']['YES'] = 'Potrdi';
$lang['sl_SI']['Newsletter_SentRecipient']['PLURALNAME'] = 'Prejemniki, katerim je bilo poslano e-obvestilo';
$lang['sl_SI']['Newsletter_SentRecipient']['SINGULARNAME'] = 'Prejemnik, kateremu je bilo poslano e-obvestilo';
$lang['sl_SI']['Newsletter_SentStatusReport.ss']['DATE'] = 'Datum';
$lang['sl_SI']['Newsletter_SentStatusReport.ss']['EMAIL'] = 'E-pošta';
$lang['sl_SI']['Newsletter_SentStatusReport.ss']['FAILEDBL'] = 'E-obvestilo ni bilo poslano naslednjim prejemnikom, ker so le-ti na seznamu neustreznih';
$lang['sl_SI']['Newsletter_SentStatusReport.ss']['FN'] = 'Ime';
$lang['sl_SI']['Newsletter_SentStatusReport.ss']['NEWSNEVERSENT'] = 'Okrožnica ni bila nikoli poslana naslednjim naročnikom';
$lang['sl_SI']['Newsletter_SentStatusReport.ss']['RES'] = 'Rezultat';
$lang['sl_SI']['Newsletter_SentStatusReport.ss']['SENDBOUNCED'] = 'Pošiljanje naslednjim prejemnikom se je odbilo';
$lang['sl_SI']['Newsletter_SentStatusReport.ss']['SENDFAIL'] = 'Pošiljanje naslednjim prejemnikom ni uspelo';
$lang['sl_SI']['Newsletter_SentStatusReport.ss']['SENTOK'] = 'Pošiljanje naslednjim prejemnikom je bilo uspešno';
$lang['sl_SI']['Newsletter_SentStatusReport.ss']['SN'] = 'Priimek';
$lang['sl_SI']['SubscribeForm']['PLURALNAME'] = 'Obrazci za prijavo';
$lang['sl_SI']['SubscribeForm']['SINGULARNAME'] = 'Obrazec za prijavo';
$lang['sl_SI']['TemplateList']['NONE'] = 'Prazno';
$lang['sl_SI']['Unsubcribe']['SUBSCRIBEDTO'] = 'Prijavljeni ste na prejemanje e-obvestil iz naslednjih področij:';
$lang['sl_SI']['Unsubscribe']['EMAILADDR'] = 'E-naslov';
$lang['sl_SI']['Unsubscribe']['NOMLSELECTED'] = 'Izberite področja e-obvestil, od katerih se želite odjaviti';
$lang['sl_SI']['Unsubscribe']['NOTSUBSCRIBED'] = 'Izgleda, da %s ni prijavljen na naša e-obvestila.';
$lang['sl_SI']['Unsubscribe']['REMOVESUCCESS'] = 'Hvala. %s ne bo več prejemal_a %s.';
$lang['sl_SI']['Unsubscribe']['SHOWLISTS'] = 'Prikaži sezname';
$lang['sl_SI']['Unsubscribe']['SUCCESS'] = 'Hvala. Odjavljeni ste iz izbranih skupin';
$lang['sl_SI']['Unsubscribe']['UNSUBSCRIBE'] = 'Odjava';
$lang['sl_SI']['UnsubscribeRecord']['PLURALNAME'] = 'Poročila o odjavi';
$lang['sl_SI']['UnsubscribeRecord']['SINGULARNAME'] = 'Poročilo o odjavi';

?>