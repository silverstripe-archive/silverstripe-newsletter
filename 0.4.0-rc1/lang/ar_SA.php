<?php

/**
 * Arabic (Saudi Arabia) language pack
 * @package modules: newsletter
 * @subpackage i18n
 */

i18n::include_locale_file('modules: newsletter', 'en_US');

global $lang;

if(array_key_exists('ar_SA', $lang) && is_array($lang['ar_SA'])) {
	$lang['ar_SA'] = array_merge($lang['en_US'], $lang['ar_SA']);
} else {
	$lang['ar_SA'] = $lang['en_US'];
}

$lang['ar_SA']['LeftAndMain']['NEWSLETTERS'] = 'نشرات أخبارية';
$lang['ar_SA']['NewsletterAdmin']['FROMEM'] = 'من عنوان البريد الإلكتروني';
$lang['ar_SA']['NewsletterAdmin']['MEWDRAFTMEWSL'] = 'إنشاء مسودة جديدة لنشرة إخبارية';
$lang['ar_SA']['NewsletterAdmin']['NEWLIST'] = 'قائمة بريدية جديدة';
$lang['ar_SA']['NewsletterAdmin']['NEWNEWSLTYPE'] = 'إنشاء نوع جديد لنشرة إخبارية';
$lang['ar_SA']['NewsletterAdmin']['NEWSLTYPE'] = 'نوع النشرات الإخبارية';
$lang['ar_SA']['NewsletterAdmin']['PLEASEENTERMAIL'] = 'فضلاً أدخل عنوان البريد الإلكتروني';
$lang['ar_SA']['NewsletterAdmin']['RESEND'] = 'إعادة الإرسال';
$lang['ar_SA']['NewsletterAdmin']['SAVE'] = 'حفظ';
$lang['ar_SA']['NewsletterAdmin']['SAVED'] = 'محفوظ';
$lang['ar_SA']['NewsletterAdmin']['SEND'] = 'إرسال ...';
$lang['ar_SA']['NewsletterAdmin']['SENDING'] = 'إرسال البريد الإلكتروني  ...';
$lang['ar_SA']['NewsletterAdmin']['SENTTESTTO'] = 'إرسال تجربة إلى';
$lang['ar_SA']['NewsletterAdmin']['SHOWCONTENTS'] = 'عرض المحتوى';
$lang['ar_SA']['NewsletterAdmin_BouncedList.ss']['EMADD'] = 'عنوان البريد الإلكتروني';
$lang['ar_SA']['NewsletterAdmin_BouncedList.ss']['HAVEBOUNCED'] = 'Emails that have bounced';
$lang['ar_SA']['NewsletterAdmin_BouncedList.ss']['NOBOUNCED'] = 'No emails sent have bounced.';
$lang['ar_SA']['NewsletterAdmin_BouncedList.ss']['UNAME'] = 'اسم المستخدم';
$lang['ar_SA']['NewsletterAdmin_left.ss']['ADDDRAFT'] = 'إضافة مسودة جديدة';
$lang['ar_SA']['NewsletterAdmin_left.ss']['ADDTYPE'] = 'إضافة نوع جديدة';
$lang['ar_SA']['NewsletterAdmin_left.ss']['CREATE'] = 'إنشاء';
$lang['ar_SA']['NewsletterAdmin_left.ss']['DEL'] = 'حذف';
$lang['ar_SA']['NewsletterAdmin_left.ss']['DELETEDRAFTS'] = 'حذف المسودات المختارة';
$lang['ar_SA']['NewsletterAdmin_left.ss']['GO'] = 'اذهب';
$lang['ar_SA']['NewsletterAdmin_left.ss']['NEWSLETTERS'] = 'نشرات الأخبار';
$lang['ar_SA']['NewsletterAdmin_left.ss']['SELECTDRAFTS'] = 'اختر المسودة التي تريد حذفها ثم اضغط على الزر بالأسفل';
$lang['ar_SA']['NewsletterAdmin_right.ss']['CANCEL'] = 'إلغاء';
$lang['ar_SA']['NewsletterAdmin_right.ss']['ENTIRE'] = 'أرسل إلى جميع القائمة البريدية';
$lang['ar_SA']['NewsletterAdmin_right.ss']['ONLYNOT'] = 'أرسل إلى أشخاص لم ترسل إليهم من قبل';
$lang['ar_SA']['NewsletterAdmin_right.ss']['SEND'] = 'أرسل نشرة إخبارية';
$lang['ar_SA']['NewsletterAdmin_right.ss']['SENDTEST'] = 'إرسال تجربة إلى';
$lang['ar_SA']['NewsletterAdmin_right.ss']['WELCOME1'] = 'أهلاً بك في';
$lang['ar_SA']['NewsletterAdmin_right.ss']['WELCOME2'] = 'قسم إدارة النشرات الإخبارية.  فضلاً اختر مجلد من القائمة';
$lang['ar_SA']['NewsletterAdmin_SiteTree.ss']['DRAFTS'] = 'المسودات';
$lang['ar_SA']['NewsletterAdmin_SiteTree.ss']['MAILLIST'] = 'قائمة بريدية';
$lang['ar_SA']['NewsletterAdmin_SiteTree.ss']['SENT'] = 'المواد المرسلة';
$lang['ar_SA']['NewsletterAdmin_UnsubscribedList.ss']['NOUNSUB'] = 'لايوجد مستخدمين قاموا بإلغاء الاشتراك من النشرة الإخبارية';
$lang['ar_SA']['NewsletterAdmin_UnsubscribedList.ss']['UNAME'] = 'اسم المستخدم';
$lang['ar_SA']['NewsletterAdmin_UnsubscribedList.ss']['UNSUBON'] = 'إلغاء الاشتراك من';
$lang['ar_SA']['NewsletterList.ss']['CHOOSEDRAFT1'] = 'فضلاً اختر مسودة من القائمة أو';
$lang['ar_SA']['NewsletterList.ss']['CHOOSEDRAFT2'] = 'أضف';
$lang['ar_SA']['NewsletterList.ss']['CHOOSESENT'] = 'فضلاً اختر مرسلاً من القائمة';
$lang['ar_SA']['Newsletter_RecipientImportField.ss']['CHANGED'] = 'عدد التفاصيل التي تم تحديثها:';
$lang['ar_SA']['Newsletter_RecipientImportField.ss']['IMPORTED'] = 'أعضاء جدد تم استيرادهم:';
$lang['ar_SA']['Newsletter_RecipientImportField.ss']['IMPORTNEW'] = 'عضو جديد مستورد';
$lang['ar_SA']['Newsletter_RecipientImportField.ss']['SEC'] = 'ثواني';
$lang['ar_SA']['Newsletter_RecipientImportField.ss']['SKIPPED'] = 'بيانات تم تجاوزها:';
$lang['ar_SA']['Newsletter_RecipientImportField.ss']['TIME'] = 'الوقت المستغرق:';
$lang['ar_SA']['Newsletter_RecipientImportField.ss']['UPDATED'] = 'أعضاء تم تحديثهم:';
$lang['ar_SA']['Newsletter_RecipientImportField_Table.ss']['CONTENTSOF'] = 'محتويات الـ';
$lang['ar_SA']['Newsletter_RecipientImportField_Table.ss']['NO'] = 'إلغاء';
$lang['ar_SA']['Newsletter_RecipientImportField_Table.ss']['RECIMPORTED'] = 'استيراد قائمة المستقبلين من';
$lang['ar_SA']['Newsletter_RecipientImportField_Table.ss']['YES'] = 'تأكيد';
$lang['ar_SA']['Newsletter_SentStatusReport.ss']['DATE'] = 'التاريخ';
$lang['ar_SA']['Newsletter_SentStatusReport.ss']['EMAIL'] = 'البريد الإلكتروني';
$lang['ar_SA']['Newsletter_SentStatusReport.ss']['FN'] = 'الاسم الأول';
$lang['ar_SA']['Newsletter_SentStatusReport.ss']['NEWSNEVERSENT'] = 'النشرة الإخبارية لم ترسل إلى المشتركين أبداً';
$lang['ar_SA']['Newsletter_SentStatusReport.ss']['RES'] = 'النتيجة';
$lang['ar_SA']['Newsletter_SentStatusReport.ss']['SENDBOUNCED'] = 'Sending to the Following Recipients Bounced';
$lang['ar_SA']['Newsletter_SentStatusReport.ss']['SENDFAIL'] = 'خطأ في الإرسال إلى المستقبلين';
$lang['ar_SA']['Newsletter_SentStatusReport.ss']['SENTOK'] = 'تم الإرسال بنجاح لائمة المستقبلين';
$lang['ar_SA']['Newsletter_SentStatusReport.ss']['SN'] = 'الاسم العائلة';

?>