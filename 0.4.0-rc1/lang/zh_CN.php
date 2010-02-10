<?php

/**
 * Chinese (China) language pack
 * @package modules: newsletter
 * @subpackage i18n
 */

i18n::include_locale_file('modules: newsletter', 'en_US');

global $lang;

if(array_key_exists('zh_CN', $lang) && is_array($lang['zh_CN'])) {
	$lang['zh_CN'] = array_merge($lang['en_US'], $lang['zh_CN']);
} else {
	$lang['zh_CN'] = $lang['en_US'];
}

$lang['zh_CN']['LeftAndMain']['NEWSLETTERS'] = '新闻邮件管理';
$lang['zh_CN']['NewsletterAdmin']['FROMEM'] = '发件人电邮地址';
$lang['zh_CN']['NewsletterAdmin']['MEWDRAFTMEWSL'] = '新建新闻邮件草稿';
$lang['zh_CN']['NewsletterAdmin']['NEWLIST'] = '新建收件人清单';
$lang['zh_CN']['NewsletterAdmin']['NEWNEWSLTYPE'] = '新建新闻邮件类型';
$lang['zh_CN']['NewsletterAdmin']['NEWSLTYPE'] = '新闻邮件的类型';
$lang['zh_CN']['NewsletterAdmin']['PLEASEENTERMAIL'] = '请输入一个电邮地址';
$lang['zh_CN']['NewsletterAdmin']['RESEND'] = '重新发送';
$lang['zh_CN']['NewsletterAdmin']['SAVE'] = '保存';
$lang['zh_CN']['NewsletterAdmin']['SAVED'] = '已保存';
$lang['zh_CN']['NewsletterAdmin']['SEND'] = '发送中...';
$lang['zh_CN']['NewsletterAdmin']['SENDING'] = '发送电邮中...';
$lang['zh_CN']['NewsletterAdmin']['SENTTESTTO'] = '发送测试给';
$lang['zh_CN']['NewsletterAdmin']['SHOWCONTENTS'] = '显示内容';
$lang['zh_CN']['NewsletterAdmin_BouncedList.ss']['EMADD'] = '电邮地址';
$lang['zh_CN']['NewsletterAdmin_BouncedList.ss']['HAVEBOUNCED'] = '被打回的电邮';
$lang['zh_CN']['NewsletterAdmin_BouncedList.ss']['NOBOUNCED'] = '没有发送后被退回的电邮。';
$lang['zh_CN']['NewsletterAdmin_BouncedList.ss']['UNAME'] = '用户名';
$lang['zh_CN']['NewsletterAdmin_left.ss']['ADDDRAFT'] = '新建邮件草稿';
$lang['zh_CN']['NewsletterAdmin_left.ss']['ADDTYPE'] = '新建新闻快递类型';
$lang['zh_CN']['NewsletterAdmin_left.ss']['CREATE'] = '创建中...';
$lang['zh_CN']['NewsletterAdmin_left.ss']['DEL'] = '删除中...';
$lang['zh_CN']['NewsletterAdmin_left.ss']['DELETEDRAFTS'] = '删除所选草稿';
$lang['zh_CN']['NewsletterAdmin_left.ss']['GO'] = '执行';
$lang['zh_CN']['NewsletterAdmin_left.ss']['NEWSLETTERS'] = '新闻邮件';
$lang['zh_CN']['NewsletterAdmin_left.ss']['SELECTDRAFTS'] = '请选择您想删除的草稿，然后点击下面的按钮';
$lang['zh_CN']['NewsletterAdmin_right.ss']['CANCEL'] = '删除';
$lang['zh_CN']['NewsletterAdmin_right.ss']['ENTIRE'] = '发送给全部收信人';
$lang['zh_CN']['NewsletterAdmin_right.ss']['ONLYNOT'] = '只发送给上次未发送的收信人';
$lang['zh_CN']['NewsletterAdmin_right.ss']['SEND'] = '发送新闻邮件';
$lang['zh_CN']['NewsletterAdmin_right.ss']['SENDTEST'] = '发送测试给';
$lang['zh_CN']['NewsletterAdmin_right.ss']['WELCOME1'] = '欢迎来到';
$lang['zh_CN']['NewsletterAdmin_right.ss']['WELCOME2'] = '新闻邮件管理系统。请从左边选择一个文件夹';
$lang['zh_CN']['NewsletterAdmin_SiteTree.ss']['DRAFTS'] = '草稿';
$lang['zh_CN']['NewsletterAdmin_SiteTree.ss']['MAILLIST'] = '收件人清单';
$lang['zh_CN']['NewsletterAdmin_SiteTree.ss']['SENT'] = '已发送的';
$lang['zh_CN']['NewsletterAdmin_UnsubscribedList.ss']['NOUNSUB'] = '没有会员取消订阅该新闻邮件';
$lang['zh_CN']['NewsletterAdmin_UnsubscribedList.ss']['UNAME'] = '用户名';
$lang['zh_CN']['NewsletterAdmin_UnsubscribedList.ss']['UNSUBON'] = '取消订阅于';
$lang['zh_CN']['NewsletterList.ss']['CHOOSEDRAFT1'] = '请从左边选择一个草稿，或者';
$lang['zh_CN']['NewsletterList.ss']['CHOOSEDRAFT2'] = '添加新的';
$lang['zh_CN']['NewsletterList.ss']['CHOOSESENT'] = '请从左边选择一个以发送邮件。';
$lang['zh_CN']['Newsletter_RecipientImportField.ss']['CHANGED'] = '被更新的详细信息：';
$lang['zh_CN']['Newsletter_RecipientImportField.ss']['IMPORTED'] = '被导入的新会员：';
$lang['zh_CN']['Newsletter_RecipientImportField.ss']['IMPORTNEW'] = '导入新的会员';
$lang['zh_CN']['Newsletter_RecipientImportField.ss']['SEC'] = '秒';
$lang['zh_CN']['Newsletter_RecipientImportField.ss']['SKIPPED'] = '被跳过的记录：';
$lang['zh_CN']['Newsletter_RecipientImportField.ss']['TIME'] = '费时：';
$lang['zh_CN']['Newsletter_RecipientImportField.ss']['UPDATED'] = '被更新的会员：';
$lang['zh_CN']['Newsletter_RecipientImportField_Table.ss']['CONTENTSOF'] = '%s文件内容';
$lang['zh_CN']['Newsletter_RecipientImportField_Table.ss']['NO'] = '取消';
$lang['zh_CN']['Newsletter_RecipientImportField_Table.ss']['RECIMPORTED'] = '从%s文件导入的会员';
$lang['zh_CN']['Newsletter_RecipientImportField_Table.ss']['YES'] = '确认';
$lang['zh_CN']['Newsletter_SentStatusReport.ss']['DATE'] = '日期';
$lang['zh_CN']['Newsletter_SentStatusReport.ss']['EMAIL'] = '电邮';
$lang['zh_CN']['Newsletter_SentStatusReport.ss']['FN'] = '名';
$lang['zh_CN']['Newsletter_SentStatusReport.ss']['NEWSNEVERSENT'] = '该邮件从未发送给下列订阅人';
$lang['zh_CN']['Newsletter_SentStatusReport.ss']['RES'] = '结果';
$lang['zh_CN']['Newsletter_SentStatusReport.ss']['SENDBOUNCED'] = '给下列收件人发送邮件被打回';
$lang['zh_CN']['Newsletter_SentStatusReport.ss']['SENDFAIL'] = '给下列收件人发送邮件失败';
$lang['zh_CN']['Newsletter_SentStatusReport.ss']['SENTOK'] = '给下列收件人发送邮件成功';
$lang['zh_CN']['Newsletter_SentStatusReport.ss']['SN'] = '姓';

?>