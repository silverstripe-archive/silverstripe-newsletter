<?php

/**
 * Indonesian (Indonesia) language pack
 * @package modules: newsletter
 * @subpackage i18n
 */

i18n::include_locale_file('modules: newsletter', 'en_US');

global $lang;

if(array_key_exists('id_ID', $lang) && is_array($lang['id_ID'])) {
	$lang['id_ID'] = array_merge($lang['en_US'], $lang['id_ID']);
} else {
	$lang['id_ID'] = $lang['en_US'];
}

$lang['id_ID']['LeftAndMain']['NEWSLETTERS'] = 'Laporan Berkala';
$lang['id_ID']['NewsletterAdmin']['FROMEM'] = 'Dari alamat email';
$lang['id_ID']['NewsletterAdmin']['MEWDRAFTMEWSL'] = 'Laporan berkala draft baru';
$lang['id_ID']['NewsletterAdmin']['NEWLIST'] = 'Milis(mailing list) baru';
$lang['id_ID']['NewsletterAdmin']['NEWNEWSLTYPE'] = 'Tipe laporan berkala baru';
$lang['id_ID']['NewsletterAdmin']['NEWSLTYPE'] = 'Tipe Laporan Berkala';
$lang['id_ID']['NewsletterAdmin']['PLEASEENTERMAIL'] = 'Harap masukkan alamat email';
$lang['id_ID']['NewsletterAdmin']['RESEND'] = 'Kirim ulang';
$lang['id_ID']['NewsletterAdmin']['SAVE'] = 'Simpan';
$lang['id_ID']['NewsletterAdmin']['SAVED'] = 'Tersimpan';
$lang['id_ID']['NewsletterAdmin']['SEND'] = 'Mengirim...';
$lang['id_ID']['NewsletterAdmin']['SENDING'] = 'Mengirim email...';
$lang['id_ID']['NewsletterAdmin']['SENTTESTTO'] = 'Kirim tes ke';
$lang['id_ID']['NewsletterAdmin']['SHOWCONTENTS'] = 'Pelihatkan konten';
$lang['id_ID']['NewsletterAdmin_BouncedList.ss']['EMADD'] = 'Alamat email';
$lang['id_ID']['NewsletterAdmin_BouncedList.ss']['HAVEBOUNCED'] = 'Email yang telah ditolak';
$lang['id_ID']['NewsletterAdmin_BouncedList.ss']['NOBOUNCED'] = 'Tidak ada email yang dikirim ditolak';
$lang['id_ID']['NewsletterAdmin_BouncedList.ss']['UNAME'] = 'Nama user';
$lang['id_ID']['NewsletterAdmin_left.ss']['ADDDRAFT'] = 'Tambahkan draft baru';
$lang['id_ID']['NewsletterAdmin_left.ss']['ADDTYPE'] = 'Tmbah tipe baru';
$lang['id_ID']['NewsletterAdmin_left.ss']['CREATE'] = 'Buat';
$lang['id_ID']['NewsletterAdmin_left.ss']['DEL'] = 'Hapus';
$lang['id_ID']['NewsletterAdmin_left.ss']['DELETEDRAFTS'] = 'Hapus draft yang diseleksi';
$lang['id_ID']['NewsletterAdmin_left.ss']['GO'] = 'Maju';
$lang['id_ID']['NewsletterAdmin_left.ss']['NEWSLETTERS'] = 'Laporan Berkala';
$lang['id_ID']['NewsletterAdmin_left.ss']['SELECTDRAFTS'] = 'Pilih draft yang Anda inginkan untuk dihapus lalu klik tombol di bawah ini';
$lang['id_ID']['NewsletterAdmin_right.ss']['CANCEL'] = 'Batalkan';
$lang['id_ID']['NewsletterAdmin_right.ss']['ENTIRE'] = 'Kirim ke seluruh milis';
$lang['id_ID']['NewsletterAdmin_right.ss']['ONLYNOT'] = 'Hanya kirim ke orang yang sebelumnya belum dikirimi';
$lang['id_ID']['NewsletterAdmin_right.ss']['SEND'] = 'Kirim laporan berkala';
$lang['id_ID']['NewsletterAdmin_right.ss']['SENDTEST'] = 'Kirim tes ke';
$lang['id_ID']['NewsletterAdmin_right.ss']['WELCOME1'] = 'Selamat datang ke ';
$lang['id_ID']['NewsletterAdmin_right.ss']['WELCOME2'] = 'seksi administrasi laporan berkala. Silahkan memilih folder dari sebelah kiri.';
$lang['id_ID']['NewsletterAdmin_SiteTree.ss']['DRAFTS'] = 'Draft';
$lang['id_ID']['NewsletterAdmin_SiteTree.ss']['MAILLIST'] = 'Milis(mailing list)';
$lang['id_ID']['NewsletterAdmin_SiteTree.ss']['SENT'] = 'Item yang Telah Dikirim';
$lang['id_ID']['NewsletterAdmin_UnsubscribedList.ss']['NOUNSUB'] = 'Tidak ada user yang berhenti berlangganan dari laporan berkala ini.';
$lang['id_ID']['NewsletterAdmin_UnsubscribedList.ss']['UNAME'] = 'Nama user';
$lang['id_ID']['NewsletterAdmin_UnsubscribedList.ss']['UNSUBON'] = 'Hentikan berlangganan pada';
$lang['id_ID']['NewsletterList.ss']['CHOOSEDRAFT1'] = 'Harap pilih draft di sebelah kiri, atau';
$lang['id_ID']['NewsletterList.ss']['CHOOSEDRAFT2'] = 'tambah satu';
$lang['id_ID']['NewsletterList.ss']['CHOOSESENT'] = 'Harap pilih item terkirim di sebelah kiri.';
$lang['id_ID']['Newsletter_RecipientImportField.ss']['CHANGED'] = 'Nomor detail telah diubah:';
$lang['id_ID']['Newsletter_RecipientImportField.ss']['IMPORTED'] = 'Anggota baru telah diimpor:';
$lang['id_ID']['Newsletter_RecipientImportField.ss']['IMPORTNEW'] = 'Anggota baru yang telah diimpor';
$lang['id_ID']['Newsletter_RecipientImportField.ss']['SEC'] = 'detik';
$lang['id_ID']['Newsletter_RecipientImportField.ss']['SKIPPED'] = 'Rekor telah dilompati:';
$lang['id_ID']['Newsletter_RecipientImportField.ss']['TIME'] = 'Waktu yang diambil:';
$lang['id_ID']['Newsletter_RecipientImportField.ss']['UPDATED'] = 'Member telah di-update:';
$lang['id_ID']['Newsletter_RecipientImportField_Table.ss']['CONTENTSOF'] = 'Konten dari';
$lang['id_ID']['Newsletter_RecipientImportField_Table.ss']['NO'] = 'Batalkan';
$lang['id_ID']['Newsletter_RecipientImportField_Table.ss']['RECIMPORTED'] = 'Penerima diimpor dari';
$lang['id_ID']['Newsletter_RecipientImportField_Table.ss']['YES'] = 'Membenarkan';
$lang['id_ID']['Newsletter_SentStatusReport.ss']['DATE'] = 'Tanggal';
$lang['id_ID']['Newsletter_SentStatusReport.ss']['EMAIL'] = 'Email';
$lang['id_ID']['Newsletter_SentStatusReport.ss']['FN'] = 'Nama depan';
$lang['id_ID']['Newsletter_SentStatusReport.ss']['NEWSNEVERSENT'] = 'Laporan Berkala Belum Pernah Dikirim ke Pelanggan Berikut';
$lang['id_ID']['Newsletter_SentStatusReport.ss']['RES'] = 'Hasil';
$lang['id_ID']['Newsletter_SentStatusReport.ss']['SENDBOUNCED'] = 'Penolakan dalam Mengirim ke Penerima Berikut';
$lang['id_ID']['Newsletter_SentStatusReport.ss']['SENDFAIL'] = 'Gagal dalam Mengirim ke Penerima Berikut';
$lang['id_ID']['Newsletter_SentStatusReport.ss']['SENTOK'] = 'Sukses dalam Mengirim ke Penerima Berikut';
$lang['id_ID']['Newsletter_SentStatusReport.ss']['SN'] = 'Nama Panggilan';

?>