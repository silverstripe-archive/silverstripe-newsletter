<?php

/**
 * Turkish (Turkey) language pack
 * @package modules: newsletter
 * @subpackage i18n
 */

i18n::include_locale_file('modules: newsletter', 'en_US');

global $lang;

if(array_key_exists('tr_TR', $lang) && is_array($lang['tr_TR'])) {
	$lang['tr_TR'] = array_merge($lang['en_US'], $lang['tr_TR']);
} else {
	$lang['tr_TR'] = $lang['en_US'];
}

$lang['tr_TR']['LeftAndMain']['NEWSLETTERS'] = 'Haber bildirimleri';
$lang['tr_TR']['NewsletterAdmin']['FROMEM'] = 'Gönderen eposta adresi';
$lang['tr_TR']['NewsletterAdmin']['MEWDRAFTMEWSL'] = 'Yeni taslak haber mektubu';
$lang['tr_TR']['NewsletterAdmin']['NEWLIST'] = 'Yeni eposta listesi';
$lang['tr_TR']['NewsletterAdmin']['NEWNEWSLTYPE'] = 'Yeni haber mektubu türü';
$lang['tr_TR']['NewsletterAdmin']['NEWSLTYPE'] = 'Haber Mektubu Türü';
$lang['tr_TR']['NewsletterAdmin']['PLEASEENTERMAIL'] = 'Lütfen bir eposta adresi giriniz';
$lang['tr_TR']['NewsletterAdmin']['RESEND'] = 'Tekrar gönder';
$lang['tr_TR']['NewsletterAdmin']['SAVE'] = 'Kaydet';
$lang['tr_TR']['NewsletterAdmin']['SAVED'] = 'Kaydedildi';
$lang['tr_TR']['NewsletterAdmin']['SEND'] = 'Gönder...';
$lang['tr_TR']['NewsletterAdmin']['SENDING'] = 'e-postalar gönderiliyor...';
$lang['tr_TR']['NewsletterAdmin']['SENTTESTTO'] = 'Test postası şu adrese gönderildi:';
$lang['tr_TR']['NewsletterAdmin']['SHOWCONTENTS'] = 'İçeriği göster';
$lang['tr_TR']['NewsletterAdmin_BouncedList.ss']['EMADD'] = 'Eposta adresi';
$lang['tr_TR']['NewsletterAdmin_BouncedList.ss']['HAVEBOUNCED'] = 'Geri dönen gönderilmiş epostalar';
$lang['tr_TR']['NewsletterAdmin_BouncedList.ss']['NOBOUNCED'] = 'Gönderilen hiçbir eposta geri dönmedi.';
$lang['tr_TR']['NewsletterAdmin_BouncedList.ss']['UNAME'] = 'Kullanıcı adı';
$lang['tr_TR']['NewsletterAdmin_left.ss']['ADDDRAFT'] = 'Yeni taslak ekle';
$lang['tr_TR']['NewsletterAdmin_left.ss']['ADDTYPE'] = 'Yeni tür ekle';
$lang['tr_TR']['NewsletterAdmin_left.ss']['CREATE'] = 'Yeni Oluştur';
$lang['tr_TR']['NewsletterAdmin_left.ss']['DEL'] = 'Sil';
$lang['tr_TR']['NewsletterAdmin_left.ss']['DELETEDRAFTS'] = 'Seçili taslakları sil';
$lang['tr_TR']['NewsletterAdmin_left.ss']['GO'] = 'Git';
$lang['tr_TR']['NewsletterAdmin_left.ss']['NEWSLETTERS'] = 'Haber Mektupları';
$lang['tr_TR']['NewsletterAdmin_left.ss']['SELECTDRAFTS'] = 'Silmek istediğiniz taslakları seçip aşağıdaki tuşa basınız';
$lang['tr_TR']['NewsletterAdmin_right.ss']['CANCEL'] = 'İptal';
$lang['tr_TR']['NewsletterAdmin_right.ss']['ENTIRE'] = 'Tüm haber mektubu abonelerine yolla';
$lang['tr_TR']['NewsletterAdmin_right.ss']['ONLYNOT'] = 'Sadece daha önceden gönderilmemiş abonelere gönder';
$lang['tr_TR']['NewsletterAdmin_right.ss']['SEND'] = 'Haber mektubu gönder';
$lang['tr_TR']['NewsletterAdmin_right.ss']['SENDTEST'] = 'Deneme mektubunu şu eposta adresine gönder:';
$lang['tr_TR']['NewsletterAdmin_right.ss']['WELCOME1'] = 'Hoşgeldiniz. Bulunduğunuz yer: ';
$lang['tr_TR']['NewsletterAdmin_right.ss']['WELCOME2'] = 'Haber mektubu yönetim paneli.  Lütfen sol kısımdan bir klasör seçiniz.';
$lang['tr_TR']['NewsletterAdmin_SiteTree.ss']['DRAFTS'] = 'Taslaklar';
$lang['tr_TR']['NewsletterAdmin_SiteTree.ss']['MAILLIST'] = 'Mektup Listesi';
$lang['tr_TR']['NewsletterAdmin_SiteTree.ss']['SENT'] = 'Gönderilmiş Öğeler';
$lang['tr_TR']['NewsletterAdmin_UnsubscribedList.ss']['NOUNSUB'] = 'Haber mektubu aboneliğinizden ayrılan kimse yok.';
$lang['tr_TR']['NewsletterAdmin_UnsubscribedList.ss']['UNAME'] = 'Kullanıcı adı';
$lang['tr_TR']['NewsletterAdmin_UnsubscribedList.ss']['UNSUBON'] = 'Abonelikten ayrıldığı liste';
$lang['tr_TR']['NewsletterList.ss']['CHOOSEDRAFT1'] = 'Lütfen sol kısımdan bir taslak seçin veya';
$lang['tr_TR']['NewsletterList.ss']['CHOOSEDRAFT2'] = 'yeni bir tane taslak ekleyin';
$lang['tr_TR']['NewsletterList.ss']['CHOOSESENT'] = 'Lütfen sol kısımdan gönderilmiş bir tane mektup seçin.';
$lang['tr_TR']['Newsletter_RecipientImportField.ss']['CHANGED'] = 'Değiştirilen bilgi sayısı:';
$lang['tr_TR']['Newsletter_RecipientImportField.ss']['IMPORTED'] = 'İçe aktarılan üyeler:';
$lang['tr_TR']['Newsletter_RecipientImportField.ss']['IMPORTNEW'] = 'Yeni üyeler içe aktarıldı.';
$lang['tr_TR']['Newsletter_RecipientImportField.ss']['SEC'] = 'saniye';
$lang['tr_TR']['Newsletter_RecipientImportField.ss']['SKIPPED'] = 'Atlanan kayıtlar:';
$lang['tr_TR']['Newsletter_RecipientImportField.ss']['TIME'] = 'Geçen süre:';
$lang['tr_TR']['Newsletter_RecipientImportField.ss']['UPDATED'] = 'Güncellenen üyeler:';
$lang['tr_TR']['Newsletter_RecipientImportField_Table.ss']['CONTENTSOF'] = 'İçeriği';
$lang['tr_TR']['Newsletter_RecipientImportField_Table.ss']['NO'] = 'İptal';
$lang['tr_TR']['Newsletter_RecipientImportField_Table.ss']['RECIMPORTED'] = 'Alıcılar buradan içe aktarıldı: ';
$lang['tr_TR']['Newsletter_RecipientImportField_Table.ss']['YES'] = 'Onayla';
$lang['tr_TR']['Newsletter_SentStatusReport.ss']['DATE'] = 'Tarih';
$lang['tr_TR']['Newsletter_SentStatusReport.ss']['EMAIL'] = 'Eposta';
$lang['tr_TR']['Newsletter_SentStatusReport.ss']['FN'] = 'İsim';
$lang['tr_TR']['Newsletter_SentStatusReport.ss']['NEWSNEVERSENT'] = 'Bu haber mektubu aşağıdaki üyelere hiçbir zaman gönderilemedi';
$lang['tr_TR']['Newsletter_SentStatusReport.ss']['RES'] = 'Sonuç';
$lang['tr_TR']['Newsletter_SentStatusReport.ss']['SENDBOUNCED'] = 'Aşağıdaki Alıcılara haber mektubu gönderilirken eposta geri geldi';
$lang['tr_TR']['Newsletter_SentStatusReport.ss']['SENDFAIL'] = 'Aşağıdaki Alıcılara haber mektubu gönderilirken hata oluştu';
$lang['tr_TR']['Newsletter_SentStatusReport.ss']['SENTOK'] = 'Aşağıdaki Alıcılara haber mektubunun gönderilmesi başarılı';
$lang['tr_TR']['Newsletter_SentStatusReport.ss']['SN'] = 'Soyisim';

?>