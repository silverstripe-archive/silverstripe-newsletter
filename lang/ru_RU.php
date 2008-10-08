<?php

/**
 * Russian (Russia) language pack
 * @package modules: newsletter
 * @subpackage i18n
 */

i18n::include_locale_file('modules: newsletter', 'en_US');

global $lang;

if(array_key_exists('ru_RU', $lang) && is_array($lang['ru_RU'])) {
	$lang['ru_RU'] = array_merge($lang['en_US'], $lang['ru_RU']);
} else {
	$lang['ru_RU'] = $lang['en_US'];
}

$lang['ru_RU']['LeftAndMain']['NEWSLETTERS'] = 'Рассылки';
$lang['ru_RU']['NewsletterAdmin']['FROMEM'] = 'С адреса email';
$lang['ru_RU']['NewsletterAdmin']['MEWDRAFTMEWSL'] = 'Новый черновик рассылки';
$lang['ru_RU']['NewsletterAdmin']['NEWLIST'] = 'Новый список рассылки';
$lang['ru_RU']['NewsletterAdmin']['NEWNEWSLTYPE'] = 'Новый тип рассылки';
$lang['ru_RU']['NewsletterAdmin']['NEWSLTYPE'] = 'Тип рассылки';
$lang['ru_RU']['NewsletterAdmin']['PLEASEENTERMAIL'] = 'Пожалуйста, введите адрес email';
$lang['ru_RU']['NewsletterAdmin']['RESEND'] = 'Повтор отправки';
$lang['ru_RU']['NewsletterAdmin']['SAVE'] = 'Сохранить';
$lang['ru_RU']['NewsletterAdmin']['SAVED'] = 'Сохранено';
$lang['ru_RU']['NewsletterAdmin']['SEND'] = 'Отправка...';
$lang['ru_RU']['NewsletterAdmin']['SENDING'] = 'Отправка email...';
$lang['ru_RU']['NewsletterAdmin']['SENTTESTTO'] = 'Тестовая отправка для:';
$lang['ru_RU']['NewsletterAdmin']['SHOWCONTENTS'] = 'Показать содержимое';
$lang['ru_RU']['NewsletterAdmin_BouncedList.ss']['EMADD'] = 'Адрес email';
$lang['ru_RU']['NewsletterAdmin_BouncedList.ss']['HAVEBOUNCED'] = 'Недоставленная почта';
$lang['ru_RU']['NewsletterAdmin_BouncedList.ss']['NOBOUNCED'] = 'Все письма доставлены';
$lang['ru_RU']['NewsletterAdmin_BouncedList.ss']['UNAME'] = 'Имя пользователя';
$lang['ru_RU']['NewsletterAdmin_left.ss']['ADDDRAFT'] = 'Добавить новый черновик';
$lang['ru_RU']['NewsletterAdmin_left.ss']['ADDTYPE'] = 'Добавить новый тип';
$lang['ru_RU']['NewsletterAdmin_left.ss']['CREATE'] = 'Создать';
$lang['ru_RU']['NewsletterAdmin_left.ss']['DEL'] = 'Удалить';
$lang['ru_RU']['NewsletterAdmin_left.ss']['DELETEDRAFTS'] = 'Удалить выбранные черновики';
$lang['ru_RU']['NewsletterAdmin_left.ss']['GO'] = 'Перейти';
$lang['ru_RU']['NewsletterAdmin_left.ss']['NEWSLETTERS'] = 'Рассылки';
$lang['ru_RU']['NewsletterAdmin_left.ss']['SELECTDRAFTS'] = 'Выберите черновики, которые Вы хотите удалить, и нажмите кнопку внизу';
$lang['ru_RU']['NewsletterAdmin_right.ss']['CANCEL'] = 'Отмена';
$lang['ru_RU']['NewsletterAdmin_right.ss']['ENTIRE'] = 'Отправить всем из списка рассылки';
$lang['ru_RU']['NewsletterAdmin_right.ss']['ONLYNOT'] = 'Отправить лишь тем, кому еще не отправлено';
$lang['ru_RU']['NewsletterAdmin_right.ss']['SEND'] = 'Произвести рассылку';
$lang['ru_RU']['NewsletterAdmin_right.ss']['SENDTEST'] = 'Тестовая отправка для:';
$lang['ru_RU']['NewsletterAdmin_right.ss']['WELCOME1'] = 'Добро пожаловать в';
$lang['ru_RU']['NewsletterAdmin_right.ss']['WELCOME2'] = 'раздел управления рассылками. Пожалуйста, выберите папку слева.';
$lang['ru_RU']['NewsletterAdmin_SiteTree.ss']['DRAFTS'] = 'Черновики';
$lang['ru_RU']['NewsletterAdmin_SiteTree.ss']['MAILLIST'] = 'Лист рассылки';
$lang['ru_RU']['NewsletterAdmin_SiteTree.ss']['SENT'] = 'Отправленные';
$lang['ru_RU']['NewsletterAdmin_UnsubscribedList.ss']['NOUNSUB'] = 'От подписки на эту рассылку не отказался никто';
$lang['ru_RU']['NewsletterAdmin_UnsubscribedList.ss']['UNAME'] = 'Имя пользователя';
$lang['ru_RU']['NewsletterAdmin_UnsubscribedList.ss']['UNSUBON'] = 'Подписка отменена';
$lang['ru_RU']['NewsletterList.ss']['CHOOSEDRAFT1'] = 'Пожалуйста, выберите черновик слева или';
$lang['ru_RU']['NewsletterList.ss']['CHOOSEDRAFT2'] = 'добавьте новый';
$lang['ru_RU']['NewsletterList.ss']['CHOOSESENT'] = 'Пожалуйста, выберите отправленную рассылку слева.';
$lang['ru_RU']['Newsletter_RecipientImportField.ss']['CHANGED'] = 'Количество изменений:';
$lang['ru_RU']['Newsletter_RecipientImportField.ss']['IMPORTED'] = 'Импортировано новых участников:';
$lang['ru_RU']['Newsletter_RecipientImportField.ss']['IMPORTNEW'] = 'Импортированные новые участники';
$lang['ru_RU']['Newsletter_RecipientImportField.ss']['SEC'] = 'сек.';
$lang['ru_RU']['Newsletter_RecipientImportField.ss']['SKIPPED'] = 'Пропущенных записей:';
$lang['ru_RU']['Newsletter_RecipientImportField.ss']['TIME'] = 'Затраченное время:';
$lang['ru_RU']['Newsletter_RecipientImportField.ss']['UPDATED'] = 'Обновленных участников:';
$lang['ru_RU']['Newsletter_RecipientImportField_Table.ss']['CONTENTSOF'] = 'Содержимое в';
$lang['ru_RU']['Newsletter_RecipientImportField_Table.ss']['NO'] = 'Отменить';
$lang['ru_RU']['Newsletter_RecipientImportField_Table.ss']['RECIMPORTED'] = 'Получатели, импортированные из';
$lang['ru_RU']['Newsletter_RecipientImportField_Table.ss']['YES'] = 'Подтвердить';
$lang['ru_RU']['Newsletter_SentStatusReport.ss']['DATE'] = 'Дата';
$lang['ru_RU']['Newsletter_SentStatusReport.ss']['EMAIL'] = 'Email';
$lang['ru_RU']['Newsletter_SentStatusReport.ss']['FN'] = 'Имя';
$lang['ru_RU']['Newsletter_SentStatusReport.ss']['NEWSNEVERSENT'] = 'Рассылка никогда не отправлялась следующим подписчикам';
$lang['ru_RU']['Newsletter_SentStatusReport.ss']['RES'] = 'Результат';
$lang['ru_RU']['Newsletter_SentStatusReport.ss']['SENDBOUNCED'] = 'Рассылка, отправленная следующим получателям, вернулась';
$lang['ru_RU']['Newsletter_SentStatusReport.ss']['SENDFAIL'] = 'Отправка следующим получателям неудачна';
$lang['ru_RU']['Newsletter_SentStatusReport.ss']['SENTOK'] = 'Отправка следующим получателям произведена успешно';
$lang['ru_RU']['Newsletter_SentStatusReport.ss']['SN'] = 'Фамилия';

?>