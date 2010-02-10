<?php

/**
 * Spanish (Mexico) language pack
 * @package modules: newsletter
 * @subpackage i18n
 */

i18n::include_locale_file('modules: newsletter', 'en_US');

global $lang;

if(array_key_exists('es_MX', $lang) && is_array($lang['es_MX'])) {
	$lang['es_MX'] = array_merge($lang['en_US'], $lang['es_MX']);
} else {
	$lang['es_MX'] = $lang['en_US'];
}

$lang['es_MX']['LeftAndMain']['NEWSLETTERS'] = 'Boletines';
$lang['es_MX']['NewsletterAdmin']['FROMEM'] = 'Dirección del remitente';
$lang['es_MX']['NewsletterAdmin']['MEWDRAFTMEWSL'] = 'Nuevo boceto de boletín';
$lang['es_MX']['NewsletterAdmin']['NEWLIST'] = 'Nueva lista de correo';
$lang['es_MX']['NewsletterAdmin']['NEWNEWSLTYPE'] = 'Nuevo tipo de boletín';
$lang['es_MX']['NewsletterAdmin']['NEWSLTYPE'] = 'Tipo de boletín';
$lang['es_MX']['NewsletterAdmin']['PLEASEENTERMAIL'] = 'Por favor introduce una dirección de correo';
$lang['es_MX']['NewsletterAdmin']['RESEND'] = 'Reenviar';
$lang['es_MX']['NewsletterAdmin']['SAVE'] = 'Guardar';
$lang['es_MX']['NewsletterAdmin']['SAVED'] = 'Guardado';
$lang['es_MX']['NewsletterAdmin']['SEND'] = 'Enviar...';
$lang['es_MX']['NewsletterAdmin']['SENDING'] = 'Enviando correos...';
$lang['es_MX']['NewsletterAdmin']['SENTTESTTO'] = 'Se ha enviado una prueba a';
$lang['es_MX']['NewsletterAdmin']['SHOWCONTENTS'] = 'Mostrar contenidos';
$lang['es_MX']['NewsletterAdmin_BouncedList.ss']['EMADD'] = 'Correo-e';
$lang['es_MX']['NewsletterAdmin_BouncedList.ss']['HAVEBOUNCED'] = 'Correos-e devueltos';
$lang['es_MX']['NewsletterAdmin_BouncedList.ss']['NOBOUNCED'] = 'No han sido devueltos correos electrónicos.';
$lang['es_MX']['NewsletterAdmin_BouncedList.ss']['UNAME'] = 'Usuario';
$lang['es_MX']['NewsletterAdmin_left.ss']['ADDDRAFT'] = 'Agregar nuevo boceto';
$lang['es_MX']['NewsletterAdmin_left.ss']['ADDTYPE'] = 'Agregar nuevo tipo';
$lang['es_MX']['NewsletterAdmin_left.ss']['CREATE'] = 'Crear...';
$lang['es_MX']['NewsletterAdmin_left.ss']['DEL'] = 'Eliminar...';
$lang['es_MX']['NewsletterAdmin_left.ss']['DELETEDRAFTS'] = 'Eliminar los bocetos seleccionados';
$lang['es_MX']['NewsletterAdmin_left.ss']['GO'] = 'Ir';
$lang['es_MX']['NewsletterAdmin_left.ss']['NEWSLETTERS'] = 'Boletines';
$lang['es_MX']['NewsletterAdmin_left.ss']['SELECTDRAFTS'] = 'Selecciona los borradores que quieres eliminar y luego pulsa el siguiente botón';
$lang['es_MX']['NewsletterAdmin_right.ss']['CANCEL'] = 'Cancelar';
$lang['es_MX']['NewsletterAdmin_right.ss']['ENTIRE'] = 'Enviar a toda la lista de correo';
$lang['es_MX']['NewsletterAdmin_right.ss']['ONLYNOT'] = 'Enviar sólo a gente a la que no se le ha enviado previamente';
$lang['es_MX']['NewsletterAdmin_right.ss']['SEND'] = 'Enviar boletín';
$lang['es_MX']['NewsletterAdmin_right.ss']['SENDTEST'] = 'Enviar prueba a';
$lang['es_MX']['NewsletterAdmin_right.ss']['WELCOME1'] = 'Bienvenido a';
$lang['es_MX']['NewsletterAdmin_right.ss']['WELCOME2'] = 'sección de administración de boletines. Por favor, elije una carpeta de la izquierda.';
$lang['es_MX']['NewsletterAdmin_SiteTree.ss']['DRAFTS'] = 'Bocetos';
$lang['es_MX']['NewsletterAdmin_SiteTree.ss']['MAILLIST'] = 'Lista de correo';
$lang['es_MX']['NewsletterAdmin_SiteTree.ss']['SENT'] = 'Elementos enviados';
$lang['es_MX']['NewsletterAdmin_UnsubscribedList.ss']['NOUNSUB'] = 'No hay usuarios que se hayan dado de baja en este boletín.';
$lang['es_MX']['NewsletterAdmin_UnsubscribedList.ss']['UNAME'] = 'Nombre de usuario';
$lang['es_MX']['NewsletterAdmin_UnsubscribedList.ss']['UNSUBON'] = 'Dado de baja';
$lang['es_MX']['NewsletterList.ss']['CHOOSEDRAFT1'] = 'Por favor, elije un boceto de la izquierda, o bien';
$lang['es_MX']['NewsletterList.ss']['CHOOSEDRAFT2'] = 'añade uno';
$lang['es_MX']['NewsletterList.ss']['CHOOSESENT'] = 'Por favor elije un elemento enviado de la izquierda.';
$lang['es_MX']['Newsletter_RecipientImportField.ss']['CHANGED'] = 'Número de detalles cambiados:';
$lang['es_MX']['Newsletter_RecipientImportField.ss']['IMPORTED'] = 'Nuevos miembros importados:';
$lang['es_MX']['Newsletter_RecipientImportField.ss']['IMPORTNEW'] = 'Importar nuevos miembros';
$lang['es_MX']['Newsletter_RecipientImportField.ss']['SEC'] = 'segundos';
$lang['es_MX']['Newsletter_RecipientImportField.ss']['SKIPPED'] = 'Elementos omitidos:';
$lang['es_MX']['Newsletter_RecipientImportField.ss']['TIME'] = 'Tiempo requerido:';
$lang['es_MX']['Newsletter_RecipientImportField.ss']['UPDATED'] = 'Miembros actualizados:';
$lang['es_MX']['Newsletter_RecipientImportField_Table.ss']['CONTENTSOF'] = 'Contenidos de';
$lang['es_MX']['Newsletter_RecipientImportField_Table.ss']['NO'] = 'Cancelar';
$lang['es_MX']['Newsletter_RecipientImportField_Table.ss']['RECIMPORTED'] = 'Destinatarios importados de';
$lang['es_MX']['Newsletter_RecipientImportField_Table.ss']['YES'] = 'Confirmar';
$lang['es_MX']['Newsletter_SentStatusReport.ss']['DATE'] = 'Fecha';
$lang['es_MX']['Newsletter_SentStatusReport.ss']['EMAIL'] = 'Correo-e';
$lang['es_MX']['Newsletter_SentStatusReport.ss']['FN'] = 'Nombre(s)';
$lang['es_MX']['Newsletter_SentStatusReport.ss']['NEWSNEVERSENT'] = 'El Boletín Nunca ha Sido Enviado a los siguientes Suscripitores';
$lang['es_MX']['Newsletter_SentStatusReport.ss']['RES'] = 'Resultado';
$lang['es_MX']['Newsletter_SentStatusReport.ss']['SENDBOUNCED'] = 'El Envío a los Siguientes Destinatarios ha sido Devuelto';
$lang['es_MX']['Newsletter_SentStatusReport.ss']['SENDFAIL'] = 'El envío a los Siguientes Destinatarios ha Fallado';
$lang['es_MX']['Newsletter_SentStatusReport.ss']['SENTOK'] = 'El envío a los Siguientes Destinatarios fue Exitoso';
$lang['es_MX']['Newsletter_SentStatusReport.ss']['SN'] = 'Apellidos';

?>