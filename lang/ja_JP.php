<?php

/**
 * Japanese (Japan) language pack
 * @package modules: newsletter
 * @subpackage i18n
 */

i18n::include_locale_file('modules: newsletter', 'en_US');

global $lang;

if(array_key_exists('ja_JP', $lang) && is_array($lang['ja_JP'])) {
	$lang['ja_JP'] = array_merge($lang['en_US'], $lang['ja_JP']);
} else {
	$lang['ja_JP'] = $lang['en_US'];
}

$lang['ja_JP']['LeftAndMain']['NEWSLETTERS'] = 'ニューズレター';
$lang['ja_JP']['NewsletterAdmin']['FROMEM'] = '送信元メールアドレス';
$lang['ja_JP']['NewsletterAdmin']['MEWDRAFTMEWSL'] = 'ニュースレター下書き';
$lang['ja_JP']['NewsletterAdmin']['NEWLIST'] = '新規メーリングリスト';
$lang['ja_JP']['NewsletterAdmin']['NEWNEWSLTYPE'] = 'ニュースレターのタイプ';
$lang['ja_JP']['NewsletterAdmin']['NEWSLTYPE'] = 'ニュースレターのタイプ';
$lang['ja_JP']['NewsletterAdmin']['PLEASEENTERMAIL'] = 'メールアドレスを入力して下さい';
$lang['ja_JP']['NewsletterAdmin']['RESEND'] = '再送信';
$lang['ja_JP']['NewsletterAdmin']['SAVE'] = '保存';
$lang['ja_JP']['NewsletterAdmin']['SAVED'] = '保存しまいた';
$lang['ja_JP']['NewsletterAdmin']['SEND'] = '送信しました...';
$lang['ja_JP']['NewsletterAdmin']['SENDING'] = 'メール送信中...';
$lang['ja_JP']['NewsletterAdmin']['SENTTESTTO'] = 'テスト送信';
$lang['ja_JP']['NewsletterAdmin']['SHOWCONTENTS'] = 'コンテンツ表示';
$lang['ja_JP']['NewsletterAdmin_BouncedList.ss']['EMADD'] = 'メールアドレス';
$lang['ja_JP']['NewsletterAdmin_BouncedList.ss']['HAVEBOUNCED'] = 'メールが返ってきました';
$lang['ja_JP']['NewsletterAdmin_BouncedList.ss']['NOBOUNCED'] = 'メールは配信されました';
$lang['ja_JP']['NewsletterAdmin_BouncedList.ss']['UNAME'] = 'ユーザ名';
$lang['ja_JP']['NewsletterAdmin_left.ss']['ADDDRAFT'] = '下書きを追加';
$lang['ja_JP']['NewsletterAdmin_left.ss']['ADDTYPE'] = 'タイプを追加';
$lang['ja_JP']['NewsletterAdmin_left.ss']['CREATE'] = '作成';
$lang['ja_JP']['NewsletterAdmin_left.ss']['DEL'] = '削除';
$lang['ja_JP']['NewsletterAdmin_left.ss']['DELETEDRAFTS'] = '選択したドラフトを削除しました';
$lang['ja_JP']['NewsletterAdmin_left.ss']['GO'] = '実行';
$lang['ja_JP']['NewsletterAdmin_left.ss']['NEWSLETTERS'] = 'ニュースレター';
$lang['ja_JP']['NewsletterAdmin_right.ss']['CANCEL'] = 'キャンセル';
$lang['ja_JP']['NewsletterAdmin_right.ss']['SEND'] = 'ニュースレター送信';
$lang['ja_JP']['NewsletterAdmin_right.ss']['SENDTEST'] = 'テスト送信';
$lang['ja_JP']['NewsletterAdmin_right.ss']['WELCOME1'] = 'ようこそ';
$lang['ja_JP']['NewsletterAdmin_right.ss']['WELCOME2'] = 'ニュースレターを管理出来る場所です。　左のオプションからフォルダを選び下さい。';
$lang['ja_JP']['NewsletterAdmin_SiteTree.ss']['DRAFTS'] = 'ドラフト';
$lang['ja_JP']['NewsletterAdmin_SiteTree.ss']['MAILLIST'] = 'メーリングリスト';
$lang['ja_JP']['NewsletterAdmin_SiteTree.ss']['SENT'] = '送信したアイテム';
$lang['ja_JP']['NewsletterAdmin_UnsubscribedList.ss']['UNAME'] = 'ユーザ名';
$lang['ja_JP']['Newsletter_RecipientImportField.ss']['SEC'] = '秒';
$lang['ja_JP']['Newsletter_RecipientImportField.ss']['UPDATED'] = 'メンバーを更新 :';
$lang['ja_JP']['Newsletter_RecipientImportField_Table.ss']['CONTENTSOF'] = 'コンテンツ';
$lang['ja_JP']['Newsletter_RecipientImportField_Table.ss']['NO'] = 'キャンセル';
$lang['ja_JP']['Newsletter_SentStatusReport.ss']['DATE'] = '日付';
$lang['ja_JP']['Newsletter_SentStatusReport.ss']['EMAIL'] = 'Eメール';
$lang['ja_JP']['Newsletter_SentStatusReport.ss']['FN'] = '苗字';
$lang['ja_JP']['Newsletter_SentStatusReport.ss']['RES'] = '検索結果';
$lang['ja_JP']['Newsletter_SentStatusReport.ss']['SN'] = '名前';

?>