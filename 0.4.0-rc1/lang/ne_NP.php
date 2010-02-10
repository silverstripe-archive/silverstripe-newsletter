<?php

/**
 * Nepali (Nepal) language pack
 * @package modules: newsletter
 * @subpackage i18n
 */

i18n::include_locale_file('modules: newsletter', 'en_US');

global $lang;

if(array_key_exists('ne_NP', $lang) && is_array($lang['ne_NP'])) {
	$lang['ne_NP'] = array_merge($lang['en_US'], $lang['ne_NP']);
} else {
	$lang['ne_NP'] = $lang['en_US'];
}

$lang['ne_NP']['LeftAndMain']['NEWSLETTERS'] = 'खबरपत्रहरु';
$lang['ne_NP']['NewsletterAdmin']['FROMEM'] = 'ईमेल ठेगाना बाट';
$lang['ne_NP']['NewsletterAdmin']['MEWDRAFTMEWSL'] = 'नयाँ द्राफ्त खबरपत्र ';
$lang['ne_NP']['NewsletterAdmin']['NEWLIST'] = 'नयाँ मेलिङ लिस्ट';
$lang['ne_NP']['NewsletterAdmin']['NEWNEWSLTYPE'] = 'नयाँ खबरपत्र किसिम';
$lang['ne_NP']['NewsletterAdmin']['NEWSLTYPE'] = 'खबरपत्र किसिम';
$lang['ne_NP']['NewsletterAdmin']['PLEASEENTERMAIL'] = 'कृपया एउटा ईमेल ठेगाना लेखनुहोस्';
$lang['ne_NP']['NewsletterAdmin']['RESEND'] = 'फेरी पठाउ';
$lang['ne_NP']['NewsletterAdmin']['SAVE'] = 'सेभ गर्';
$lang['ne_NP']['NewsletterAdmin']['SAVED'] = 'सेभ गरियो';
$lang['ne_NP']['NewsletterAdmin']['SEND'] = 'पठाउ...';
$lang['ne_NP']['NewsletterAdmin']['SENDING'] = 'ईमेल पठाउदै छ...';
$lang['ne_NP']['NewsletterAdmin']['SENTTESTTO'] = 'टेस्ट पठाउनुहोस्';
$lang['ne_NP']['NewsletterAdmin']['SHOWCONTENTS'] = 'सामाग्रीहरु देखाउ';
$lang['ne_NP']['NewsletterAdmin_BouncedList.ss']['EMADD'] = 'ईमेल ठेगाना';
$lang['ne_NP']['NewsletterAdmin_BouncedList.ss']['HAVEBOUNCED'] = 'फर्किएका ईमेलहरु ';
$lang['ne_NP']['NewsletterAdmin_BouncedList.ss']['NOBOUNCED'] = 'कुनै पनि पठाईएका ईमेलहरु फर्किएका छैनन् ';
$lang['ne_NP']['NewsletterAdmin_BouncedList.ss']['UNAME'] = 'प्रयोगकताको नाम';
$lang['ne_NP']['NewsletterAdmin_left.ss']['ADDDRAFT'] = 'नयाँ draft थप';
$lang['ne_NP']['NewsletterAdmin_left.ss']['ADDTYPE'] = 'नयाँ किसिम थप';
$lang['ne_NP']['NewsletterAdmin_left.ss']['CREATE'] = 'बनाउ';
$lang['ne_NP']['NewsletterAdmin_left.ss']['DEL'] = 'हटाउ';
$lang['ne_NP']['NewsletterAdmin_left.ss']['DELETEDRAFTS'] = 'छानिएका draftहरु हटाउनुहोस् ';
$lang['ne_NP']['NewsletterAdmin_left.ss']['GO'] = 'जाउ';
$lang['ne_NP']['NewsletterAdmin_left.ss']['NEWSLETTERS'] = 'खबरपत्रहरु';
$lang['ne_NP']['NewsletterAdmin_left.ss']['SELECTDRAFTS'] = 'तपाईंले हटाउन खोज्नुभएको draftहरु छन्नुस् र तलको बटन थिचुनुहोस्';
$lang['ne_NP']['NewsletterAdmin_right.ss']['CANCEL'] = 'क्यान्सिल गर्नुस्';
$lang['ne_NP']['NewsletterAdmin_right.ss']['ENTIRE'] = 'सबै मेलइङ लिस्टलाई पठाउनुहोस्';
$lang['ne_NP']['NewsletterAdmin_right.ss']['ONLYNOT'] = 'पहिला नपठाउएका मान्छेलाई मात्र पठाउनुहोस्';
$lang['ne_NP']['NewsletterAdmin_right.ss']['SEND'] = 'खबरपत्रहरु पठाउनुहोस्';
$lang['ne_NP']['NewsletterAdmin_right.ss']['SENDTEST'] = 'टेस्ट पठाउनुहोस्';
$lang['ne_NP']['NewsletterAdmin_right.ss']['WELCOME1'] = 'स्वागत छ !';
$lang['ne_NP']['NewsletterAdmin_right.ss']['WELCOME2'] = 'खबरपत्रहरु मिलउने ठाउँ । कृपया बाँयाबाट एउटा फोल्डर छन्नुहोस् ।';
$lang['ne_NP']['NewsletterAdmin_SiteTree.ss']['DRAFTS'] = 'द्राफ्ट्हरु';
$lang['ne_NP']['NewsletterAdmin_SiteTree.ss']['MAILLIST'] = 'मेलइङ लिस्ट';
$lang['ne_NP']['NewsletterAdmin_SiteTree.ss']['SENT'] = 'पठाईएका सामाग्रीहरु';
$lang['ne_NP']['NewsletterAdmin_UnsubscribedList.ss']['NOUNSUB'] = 'कुनै पनि प्रयोगकर्ताले यो खबरपत्रको सदस्यता खारेज गरिएको  छैन ।';
$lang['ne_NP']['NewsletterAdmin_UnsubscribedList.ss']['UNAME'] = 'प्रयोगकताको नाम';
$lang['ne_NP']['NewsletterAdmin_UnsubscribedList.ss']['UNSUBON'] = 'सदस्यता खारेज गरिएको मिति ';
$lang['ne_NP']['NewsletterList.ss']['CHOOSEDRAFT1'] = 'कृपया बाँयाबाट एउटा draft छन्नुहोस् , अथवा';
$lang['ne_NP']['NewsletterList.ss']['CHOOSEDRAFT2'] = 'एउटा थप';
$lang['ne_NP']['NewsletterList.ss']['CHOOSESENT'] = 'कृपया बाँयाबाट एउटा पठाइएको सामाग्री छन्नुहोस् ।';
$lang['ne_NP']['Newsletter_RecipientImportField.ss']['CHANGED'] = 'विवरणको नम्बर परिवर्तन गारियो:';
$lang['ne_NP']['Newsletter_RecipientImportField.ss']['IMPORTED'] = 'नयाँ कार्यकर्ताहरु आर्यातित् गरियो';
$lang['ne_NP']['Newsletter_RecipientImportField.ss']['IMPORTNEW'] = 'आर्यातित् नयाँ कार्यकर्ताहरु';
$lang['ne_NP']['Newsletter_RecipientImportField.ss']['SEC'] = 'सेकेणसहरु';
$lang['ne_NP']['Newsletter_RecipientImportField.ss']['SKIPPED'] = 'रेकडहरु छुटाईयो: ';
$lang['ne_NP']['Newsletter_RecipientImportField.ss']['TIME'] = 'लागेको समय';
$lang['ne_NP']['Newsletter_RecipientImportField.ss']['UPDATED'] = 'कार्यकर्ताहरु उप्डेट गरियो:';
$lang['ne_NP']['Newsletter_RecipientImportField_Table.ss']['CONTENTSOF'] = 'सामाग्रीहरु';
$lang['ne_NP']['Newsletter_RecipientImportField_Table.ss']['NO'] = 'क्यान्सिल गर्नुस्';
$lang['ne_NP']['Newsletter_RecipientImportField_Table.ss']['RECIMPORTED'] = 'यहाँबाट प्राप्तगर्नेमन्छेहरु आर्यातित्';
$lang['ne_NP']['Newsletter_RecipientImportField_Table.ss']['YES'] = 'पुषटि गर्नुस्';
$lang['ne_NP']['Newsletter_SentStatusReport.ss']['DATE'] = 'मिति';
$lang['ne_NP']['Newsletter_SentStatusReport.ss']['EMAIL'] = 'ईमेल';
$lang['ne_NP']['Newsletter_SentStatusReport.ss']['FN'] = 'पहिलो नाम';
$lang['ne_NP']['Newsletter_SentStatusReport.ss']['NEWSNEVERSENT'] = 'तलको मन्छेलाई खबरपत्रहरु कहिल्य पठाईएको छैन ';
$lang['ne_NP']['Newsletter_SentStatusReport.ss']['RES'] = 'परीणाम';
$lang['ne_NP']['Newsletter_SentStatusReport.ss']['SENDBOUNCED'] = 'तलको प्राप्तगर्नेमन्छेलाई पठाईएको फर्कियो';
$lang['ne_NP']['Newsletter_SentStatusReport.ss']['SENDFAIL'] = 'तलको प्राप्तगर्नेमन्छेलाई पठाउन सकिएन्';
$lang['ne_NP']['Newsletter_SentStatusReport.ss']['SENTOK'] = 'तलको प्राप्तगर्नेमन्छेलाई पठाउने कार्य सफल भयो';
$lang['ne_NP']['Newsletter_SentStatusReport.ss']['SN'] = 'थर';

?>