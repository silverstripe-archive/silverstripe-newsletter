<?php

/**
 * Chinese (Taiwan) language pack
 * @package modules: newsletter
 * @subpackage i18n
 */

i18n::include_locale_file('modules: newsletter', 'en_US');

global $lang;

if(array_key_exists('zh_TW', $lang) && is_array($lang['zh_TW'])) {
	$lang['zh_TW'] = array_merge($lang['en_US'], $lang['zh_TW']);
} else {
	$lang['zh_TW'] = $lang['en_US'];
}

$lang['zh_TW']['LeftAndMain']['NEWSLETTERS'] = '新聞郵件管理';
$lang['zh_TW']['NewsletterAdmin']['FROMEM'] = '從電子郵件';
$lang['zh_TW']['NewsletterAdmin']['MEWDRAFTMEWSL'] = '新建新聞郵件草稿';
$lang['zh_TW']['NewsletterAdmin']['NEWLIST'] = '新收件人清單';
$lang['zh_TW']['NewsletterAdmin']['NEWNEWSLTYPE'] = '新增新聞郵件類型';
$lang['zh_TW']['NewsletterAdmin']['NEWSLTYPE'] = '新聞郵件類型';
$lang['zh_TW']['NewsletterAdmin']['PLEASEENTERMAIL'] = '請輸入電子郵件';
$lang['zh_TW']['NewsletterAdmin']['RESEND'] = '重送';
$lang['zh_TW']['NewsletterAdmin']['SAVE'] = '儲存';
$lang['zh_TW']['NewsletterAdmin']['SAVED'] = '已儲存';
$lang['zh_TW']['NewsletterAdmin']['SEND'] = '送出...';
$lang['zh_TW']['NewsletterAdmin']['SENDING'] = '發送中...';
$lang['zh_TW']['NewsletterAdmin']['SENTTESTTO'] = '測試發送給';
$lang['zh_TW']['NewsletterAdmin']['SHOWCONTENTS'] = '顯示內容';
$lang['zh_TW']['NewsletterAdmin_BouncedList.ss']['EMADD'] = '電子郵件';
$lang['zh_TW']['NewsletterAdmin_BouncedList.ss']['HAVEBOUNCED'] = '被退回的電子郵件';
$lang['zh_TW']['NewsletterAdmin_BouncedList.ss']['NOBOUNCED'] = '沒有被退回的電子郵件';
$lang['zh_TW']['NewsletterAdmin_BouncedList.ss']['UNAME'] = '帳號';
$lang['zh_TW']['NewsletterAdmin_left.ss']['ADDDRAFT'] = '新增草稿';
$lang['zh_TW']['NewsletterAdmin_left.ss']['ADDTYPE'] = '新增類型';
$lang['zh_TW']['NewsletterAdmin_left.ss']['CREATE'] = '新增';
$lang['zh_TW']['NewsletterAdmin_left.ss']['DEL'] = '刪除';
$lang['zh_TW']['NewsletterAdmin_left.ss']['DELETEDRAFTS'] = '刪除已選擇的草稿';
$lang['zh_TW']['NewsletterAdmin_left.ss']['GO'] = '執行';
$lang['zh_TW']['NewsletterAdmin_left.ss']['NEWSLETTERS'] = '新聞郵件';
$lang['zh_TW']['NewsletterAdmin_left.ss']['SELECTDRAFTS'] = '選擇您要刪除的草稿並點擊按鈕';
$lang['zh_TW']['NewsletterAdmin_right.ss']['CANCEL'] = '取消';
$lang['zh_TW']['NewsletterAdmin_right.ss']['ENTIRE'] = '發送給全部收信人';
$lang['zh_TW']['NewsletterAdmin_right.ss']['ONLYNOT'] = '發送給上次未發送的收信人';
$lang['zh_TW']['NewsletterAdmin_right.ss']['SEND'] = '發送新聞郵件';
$lang['zh_TW']['NewsletterAdmin_right.ss']['SENDTEST'] = '發送測試郵件給';
$lang['zh_TW']['NewsletterAdmin_right.ss']['WELCOME1'] = '歡迎來到';
$lang['zh_TW']['NewsletterAdmin_right.ss']['WELCOME2'] = '新聞郵件管理：請選擇左邊的一個資料夾';
$lang['zh_TW']['NewsletterAdmin_SiteTree.ss']['DRAFTS'] = '草稿';
$lang['zh_TW']['NewsletterAdmin_SiteTree.ss']['MAILLIST'] = '郵遞清單';
$lang['zh_TW']['NewsletterAdmin_SiteTree.ss']['SENT'] = '已送出的郵件';
$lang['zh_TW']['NewsletterAdmin_UnsubscribedList.ss']['NOUNSUB'] = '沒有人取消訂閱';
$lang['zh_TW']['NewsletterAdmin_UnsubscribedList.ss']['UNAME'] = '帳號';
$lang['zh_TW']['NewsletterAdmin_UnsubscribedList.ss']['UNSUBON'] = '取消訂閱日期';
$lang['zh_TW']['NewsletterList.ss']['CHOOSEDRAFT1'] = '請選擇左邊的一個草稿或';
$lang['zh_TW']['NewsletterList.ss']['CHOOSEDRAFT2'] = '新增一個';
$lang['zh_TW']['NewsletterList.ss']['CHOOSESENT'] = '請選擇左邊的一個已送新聞郵件';
$lang['zh_TW']['Newsletter_RecipientImportField.ss']['CHANGED'] = '被更新數量：';
$lang['zh_TW']['Newsletter_RecipientImportField.ss']['IMPORTED'] = '新會員已匯入';
$lang['zh_TW']['Newsletter_RecipientImportField.ss']['IMPORTNEW'] = '匯入新會員';
$lang['zh_TW']['Newsletter_RecipientImportField.ss']['SEC'] = '秒';
$lang['zh_TW']['Newsletter_RecipientImportField.ss']['SKIPPED'] = '被跳過數量：';
$lang['zh_TW']['Newsletter_RecipientImportField.ss']['TIME'] = '花費時間：';
$lang['zh_TW']['Newsletter_RecipientImportField.ss']['UPDATED'] = '會員已更新';
$lang['zh_TW']['Newsletter_RecipientImportField_Table.ss']['CONTENTSOF'] = '內容';
$lang['zh_TW']['Newsletter_RecipientImportField_Table.ss']['NO'] = '取消';
$lang['zh_TW']['Newsletter_RecipientImportField_Table.ss']['RECIMPORTED'] = '收件人匯入點';
$lang['zh_TW']['Newsletter_RecipientImportField_Table.ss']['YES'] = '確認';
$lang['zh_TW']['Newsletter_SentStatusReport.ss']['DATE'] = '日期';
$lang['zh_TW']['Newsletter_SentStatusReport.ss']['EMAIL'] = '電子郵件';
$lang['zh_TW']['Newsletter_SentStatusReport.ss']['FN'] = '名';
$lang['zh_TW']['Newsletter_SentStatusReport.ss']['NEWSNEVERSENT'] = '下列的訂閱者沒有收到';
$lang['zh_TW']['Newsletter_SentStatusReport.ss']['RES'] = '結果';
$lang['zh_TW']['Newsletter_SentStatusReport.ss']['SENDBOUNCED'] = '下列的電子郵件被退回';
$lang['zh_TW']['Newsletter_SentStatusReport.ss']['SENDFAIL'] = '下列的收件人沒有收到';
$lang['zh_TW']['Newsletter_SentStatusReport.ss']['SENTOK'] = '下列的收件人有收到';
$lang['zh_TW']['Newsletter_SentStatusReport.ss']['SN'] = '姓';

?>