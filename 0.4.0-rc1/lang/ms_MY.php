<?php

/**
 * Malay (Malaysia) language pack
 * @package modules: newsletter
 * @subpackage i18n
 */

i18n::include_locale_file('modules: newsletter', 'en_US');

global $lang;

if(array_key_exists('ms_MY', $lang) && is_array($lang['ms_MY'])) {
	$lang['ms_MY'] = array_merge($lang['en_US'], $lang['ms_MY']);
} else {
	$lang['ms_MY'] = $lang['en_US'];
}

$lang['ms_MY']['LeftAndMain']['NEWSLETTERS'] = 'Buletin berkala';
$lang['ms_MY']['NewsletterAdmin']['FROMEM'] = 'Daripada alamat email';
$lang['ms_MY']['NewsletterAdmin']['MEWDRAFTMEWSL'] = 'Draf buletin berkala baru';
$lang['ms_MY']['NewsletterAdmin']['NEWLIST'] = 'Senarai baru mailing';
$lang['ms_MY']['NewsletterAdmin']['NEWNEWSLTYPE'] = 'Jenis buletin berkala baru';
$lang['ms_MY']['NewsletterAdmin']['NEWSLTYPE'] = 'Jenis Buletin berkala';
$lang['ms_MY']['NewsletterAdmin']['PLEASEENTERMAIL'] = 'Masukkan alamat email';
$lang['ms_MY']['NewsletterAdmin']['RESEND'] = 'Hantar semula';
$lang['ms_MY']['NewsletterAdmin']['SAVE'] = 'Simpan';
$lang['ms_MY']['NewsletterAdmin']['SAVED'] = 'Disimpan';
$lang['ms_MY']['NewsletterAdmin']['SEND'] = 'Hantar...';
$lang['ms_MY']['NewsletterAdmin']['SENDING'] = 'Menghantar email...';
$lang['ms_MY']['NewsletterAdmin']['SENTTESTTO'] = 'Penghantaran ujian kepada';
$lang['ms_MY']['NewsletterAdmin']['SHOWCONTENTS'] = 'Paparkan kandungan';
$lang['ms_MY']['NewsletterAdmin_BouncedList.ss']['EMADD'] = 'Alamat Email';
$lang['ms_MY']['NewsletterAdmin_BouncedList.ss']['HAVEBOUNCED'] = 'Email-email yang ditendang';
$lang['ms_MY']['NewsletterAdmin_BouncedList.ss']['NOBOUNCED'] = 'Tiada email yang ditendang';
$lang['ms_MY']['NewsletterAdmin_BouncedList.ss']['UNAME'] = 'ID pengguna';
$lang['ms_MY']['NewsletterAdmin_left.ss']['ADDDRAFT'] = 'Tambah draf baru';
$lang['ms_MY']['NewsletterAdmin_left.ss']['ADDTYPE'] = 'Tambah jenis baru';
$lang['ms_MY']['NewsletterAdmin_left.ss']['CREATE'] = 'Hasilkan';
$lang['ms_MY']['NewsletterAdmin_left.ss']['DEL'] = 'Haouskan';
$lang['ms_MY']['NewsletterAdmin_left.ss']['DELETEDRAFTS'] = 'Hapuskan draf terpilih';
$lang['ms_MY']['NewsletterAdmin_left.ss']['GO'] = 'Teruskan';
$lang['ms_MY']['NewsletterAdmin_left.ss']['NEWSLETTERS'] = 'Buletin berkala';
$lang['ms_MY']['NewsletterAdmin_left.ss']['SELECTDRAFTS'] = 'Pilih draf yang ingin dihapuskan dari pilihan di kiri dan klik butang di bawah';
$lang['ms_MY']['NewsletterAdmin_right.ss']['CANCEL'] = 'Batal';
$lang['ms_MY']['NewsletterAdmin_right.ss']['ENTIRE'] = 'Hantar ke seluruh senarai mailing';
$lang['ms_MY']['NewsletterAdmin_right.ss']['ONLYNOT'] = 'Hantar kepada pengguna yang belum pernah dihantar';
$lang['ms_MY']['NewsletterAdmin_right.ss']['SEND'] = 'Hantar buletin berkala';
$lang['ms_MY']['NewsletterAdmin_right.ss']['SENDTEST'] = 'Hantaran ujuan kepada';
$lang['ms_MY']['NewsletterAdmin_right.ss']['WELCOME1'] = 'Selamat datang ke';
$lang['ms_MY']['NewsletterAdmin_right.ss']['WELCOME2'] = 'bahagian pentadbiran buletin berkala. Pilih folder dari pilihan di sebelah kiri';
$lang['ms_MY']['NewsletterAdmin_SiteTree.ss']['DRAFTS'] = 'Draf';
$lang['ms_MY']['NewsletterAdmin_SiteTree.ss']['MAILLIST'] = 'Senarai mailing';
$lang['ms_MY']['NewsletterAdmin_SiteTree.ss']['SENT'] = 'Item sudah dihantar';
$lang['ms_MY']['NewsletterAdmin_UnsubscribedList.ss']['NOUNSUB'] = 'Tiada pengguna yang membatalkan langganan bagi buletin berkala ini.';
$lang['ms_MY']['NewsletterAdmin_UnsubscribedList.ss']['UNAME'] = 'ID pengguna';
$lang['ms_MY']['NewsletterAdmin_UnsubscribedList.ss']['UNSUBON'] = 'Langganan dibatalkan pada';
$lang['ms_MY']['NewsletterList.ss']['CHOOSEDRAFT1'] = 'Pilih salah satu draf dari pilihan di sebelah kiri, atau';
$lang['ms_MY']['NewsletterList.ss']['CHOOSEDRAFT2'] = 'tambah yang baru';
$lang['ms_MY']['NewsletterList.ss']['CHOOSESENT'] = 'Pilih dari senarai \'telah dikirim\' di sebelah kiri.';
$lang['ms_MY']['Newsletter_RecipientImportField.ss']['CHANGED'] = 'Bilangan butir-butiran yang diubah';
$lang['ms_MY']['Newsletter_RecipientImportField.ss']['IMPORTED'] = 'Ahli-ahli baru yang diimport:';
$lang['ms_MY']['Newsletter_RecipientImportField.ss']['IMPORTNEW'] = 'Ahli-ahli baru yang diimport';
$lang['ms_MY']['Newsletter_RecipientImportField.ss']['SEC'] = 'saat';
$lang['ms_MY']['Newsletter_RecipientImportField.ss']['SKIPPED'] = 'Rekod yang dilangkau:';
$lang['ms_MY']['Newsletter_RecipientImportField.ss']['TIME'] = 'Mada yang diambil:';
$lang['ms_MY']['Newsletter_RecipientImportField.ss']['UPDATED'] = 'Kemaskini ahli-ahli:';
$lang['ms_MY']['Newsletter_RecipientImportField_Table.ss']['CONTENTSOF'] = 'Kandungan';
$lang['ms_MY']['Newsletter_RecipientImportField_Table.ss']['NO'] = 'Batal';
$lang['ms_MY']['Newsletter_RecipientImportField_Table.ss']['RECIMPORTED'] = 'Senarai penerima diimport dari';
$lang['ms_MY']['Newsletter_RecipientImportField_Table.ss']['YES'] = 'Pengesahan';
$lang['ms_MY']['Newsletter_SentStatusReport.ss']['DATE'] = 'Tarikh';
$lang['ms_MY']['Newsletter_SentStatusReport.ss']['EMAIL'] = 'Emel';
$lang['ms_MY']['Newsletter_SentStatusReport.ss']['FN'] = 'Nama';
$lang['ms_MY']['Newsletter_SentStatusReport.ss']['NEWSNEVERSENT'] = 'Buletin berkala belum pernah dihantar kepada pelanggan berikut';
$lang['ms_MY']['Newsletter_SentStatusReport.ss']['RES'] = 'Keputusan';
$lang['ms_MY']['Newsletter_SentStatusReport.ss']['SENDBOUNCED'] = 'Cubaan menghantar kepada penerima berikut gagal dan dikembalikan';
$lang['ms_MY']['Newsletter_SentStatusReport.ss']['SENDFAIL'] = 'Cubaan menghantar kepada penerima berikut gagal';
$lang['ms_MY']['Newsletter_SentStatusReport.ss']['SENTOK'] = 'Cubaan menghantar kepada penerima berikut berjaya';
$lang['ms_MY']['Newsletter_SentStatusReport.ss']['SN'] = 'Nama keluarga';

?>