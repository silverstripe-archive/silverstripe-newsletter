<?php

/**
 * Ukrainian (Ukraine) language pack
 * @package modules: newsletter
 * @subpackage i18n
 */

i18n::include_locale_file('modules: newsletter', 'en_US');

global $lang;

if(array_key_exists('uk_UA', $lang) && is_array($lang['uk_UA'])) {
	$lang['uk_UA'] = array_merge($lang['en_US'], $lang['uk_UA']);
} else {
	$lang['uk_UA'] = $lang['en_US'];
}

$lang['uk_UA']['LeftAndMain']['NEWSLETTERS'] = 'Поштові розсилки';
$lang['uk_UA']['NewsletterAdmin']['FROMEM'] = 'Від адреси е-пошти';
$lang['uk_UA']['NewsletterAdmin']['MEWDRAFTMEWSL'] = 'Нова чернетка розсилань';
$lang['uk_UA']['NewsletterAdmin']['NEWLIST'] = 'Новий список розсилань';
$lang['uk_UA']['NewsletterAdmin']['NEWNEWSLTYPE'] = 'Новий тип розсилань';
$lang['uk_UA']['NewsletterAdmin']['NEWSLTYPE'] = 'Тип Розсилань';
$lang['uk_UA']['NewsletterAdmin']['PLEASEENTERMAIL'] = 'Будь ласка, введіть адресу е-пошти';
$lang['uk_UA']['NewsletterAdmin']['RESEND'] = 'Переслати';
$lang['uk_UA']['NewsletterAdmin']['SAVE'] = 'Зберегти';
$lang['uk_UA']['NewsletterAdmin']['SAVED'] = 'Збережено';
$lang['uk_UA']['NewsletterAdmin']['SEND'] = 'Надсилання...';
$lang['uk_UA']['NewsletterAdmin']['SENDING'] = 'Надсилання листів...';
$lang['uk_UA']['NewsletterAdmin']['SENTTESTTO'] = 'Надіслано тестове повідомлення до';
$lang['uk_UA']['NewsletterAdmin']['SHOWCONTENTS'] = 'Показати зміст';
$lang['uk_UA']['NewsletterAdmin_BouncedList.ss']['EMADD'] = 'Адреса е-пошти';
$lang['uk_UA']['NewsletterAdmin_BouncedList.ss']['HAVEBOUNCED'] = 'Недоставлена пошта';
$lang['uk_UA']['NewsletterAdmin_BouncedList.ss']['NOBOUNCED'] = 'Немає недоставленої пошти.';
$lang['uk_UA']['NewsletterAdmin_BouncedList.ss']['UNAME'] = 'Ім\'я користувача';
$lang['uk_UA']['NewsletterAdmin_left.ss']['ADDDRAFT'] = 'Додати нову чернетку';
$lang['uk_UA']['NewsletterAdmin_left.ss']['ADDTYPE'] = 'Додати новий тип';
$lang['uk_UA']['NewsletterAdmin_left.ss']['CREATE'] = 'Створити';
$lang['uk_UA']['NewsletterAdmin_left.ss']['DEL'] = 'Видалити';
$lang['uk_UA']['NewsletterAdmin_left.ss']['DELETEDRAFTS'] = 'Видалити вибрані чернетки';
$lang['uk_UA']['NewsletterAdmin_left.ss']['GO'] = 'Уперед';
$lang['uk_UA']['NewsletterAdmin_left.ss']['NEWSLETTERS'] = 'Розсилання';
$lang['uk_UA']['NewsletterAdmin_left.ss']['SELECTDRAFTS'] = 'Виберіть чернетку для видалення та натисніть кнопку нижче';
$lang['uk_UA']['NewsletterAdmin_right.ss']['CANCEL'] = 'Відмінити';
$lang['uk_UA']['NewsletterAdmin_right.ss']['ENTIRE'] = 'Надіслати до всіх зі списку розсилань';
$lang['uk_UA']['NewsletterAdmin_right.ss']['ONLYNOT'] = 'Надіслати тільки тим, кому ще не було надіслано';
$lang['uk_UA']['NewsletterAdmin_right.ss']['SEND'] = 'Розіслати';
$lang['uk_UA']['NewsletterAdmin_right.ss']['SENDTEST'] = 'Надіслати тестові повідомлення до';
$lang['uk_UA']['NewsletterAdmin_right.ss']['WELCOME1'] = 'Вітаємо у';
$lang['uk_UA']['NewsletterAdmin_right.ss']['WELCOME2'] = 'секції адміністрування розсилань. Будь ласка, оберіть теку зліва.';
$lang['uk_UA']['NewsletterAdmin_SiteTree.ss']['DRAFTS'] = 'Чернетки';
$lang['uk_UA']['NewsletterAdmin_SiteTree.ss']['MAILLIST'] = 'Списки Розсилань';
$lang['uk_UA']['NewsletterAdmin_SiteTree.ss']['SENT'] = 'Надіслані';
$lang['uk_UA']['NewsletterAdmin_UnsubscribedList.ss']['NOUNSUB'] = 'Жоден користувач не відписався від даного розсилання.';
$lang['uk_UA']['NewsletterAdmin_UnsubscribedList.ss']['UNAME'] = 'Ім\'я користувача';
$lang['uk_UA']['NewsletterAdmin_UnsubscribedList.ss']['UNSUBON'] = 'Відисаний від';
$lang['uk_UA']['NewsletterList.ss']['CHOOSEDRAFT1'] = 'Будь ласка, оберіть чернетку зліва або';
$lang['uk_UA']['NewsletterList.ss']['CHOOSEDRAFT2'] = 'додайте одну';
$lang['uk_UA']['NewsletterList.ss']['CHOOSESENT'] = 'Будь ласка, оберіть надіслане зліва';
$lang['uk_UA']['Newsletter_RecipientImportField.ss']['CHANGED'] = 'Кількість деталей змінена:';
$lang['uk_UA']['Newsletter_RecipientImportField.ss']['IMPORTED'] = 'Імпортовані нові користувачі:';
$lang['uk_UA']['Newsletter_RecipientImportField.ss']['IMPORTNEW'] = 'Імпортовані нові користувачі';
$lang['uk_UA']['Newsletter_RecipientImportField.ss']['SEC'] = 'секунд';
$lang['uk_UA']['Newsletter_RecipientImportField.ss']['SKIPPED'] = 'Пропущених записів:';
$lang['uk_UA']['Newsletter_RecipientImportField.ss']['TIME'] = 'Зайнято часу:';
$lang['uk_UA']['Newsletter_RecipientImportField.ss']['UPDATED'] = 'Користувачі оновлені:';
$lang['uk_UA']['Newsletter_RecipientImportField_Table.ss']['CONTENTSOF'] = 'Вміст';
$lang['uk_UA']['Newsletter_RecipientImportField_Table.ss']['NO'] = 'Відмінити';
$lang['uk_UA']['Newsletter_RecipientImportField_Table.ss']['RECIMPORTED'] = 'Отримувачі, імпортовані з';
$lang['uk_UA']['Newsletter_RecipientImportField_Table.ss']['YES'] = 'Підтвердити';
$lang['uk_UA']['Newsletter_SentStatusReport.ss']['DATE'] = 'Дата';
$lang['uk_UA']['Newsletter_SentStatusReport.ss']['EMAIL'] = 'Е-пошта';
$lang['uk_UA']['Newsletter_SentStatusReport.ss']['FN'] = 'Ім\'я';
$lang['uk_UA']['Newsletter_SentStatusReport.ss']['NEWSNEVERSENT'] = 'Розсилання ніколи не було надіслане наведеним користувачам';
$lang['uk_UA']['Newsletter_SentStatusReport.ss']['RES'] = 'Результат';
$lang['uk_UA']['Newsletter_SentStatusReport.ss']['SENDBOUNCED'] = 'Розсилання, надіслане наведеним користувачам, повернулося';
$lang['uk_UA']['Newsletter_SentStatusReport.ss']['SENDFAIL'] = 'Не вийшло надіслати наступним користувачам';
$lang['uk_UA']['Newsletter_SentStatusReport.ss']['SENTOK'] = 'Успішно було надіслано наведеним користувачам';
$lang['uk_UA']['Newsletter_SentStatusReport.ss']['SN'] = 'Прізвище';

?>