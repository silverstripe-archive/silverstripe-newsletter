<?php

/**
 * Spanish (Spain) language pack
 * @package modules: newsletter
 * @subpackage i18n
 */

i18n::include_locale_file('modules: newsletter', 'en_US');

global $lang;

if(array_key_exists('es_ES', $lang) && is_array($lang['es_ES'])) {
	$lang['es_ES'] = array_merge($lang['en_US'], $lang['es_ES']);
} else {
	$lang['es_ES'] = $lang['en_US'];
}

$lang['es_ES']['LeftAndMain']['NEWSLETTERS'] = 'Boletines';
$lang['es_ES']['NewsletterAdmin']['FROMEM'] = 'Dirección remitente';
$lang['es_ES']['NewsletterAdmin']['MEWDRAFTMEWSL'] = 'Nuevo borrador de boletín';
$lang['es_ES']['NewsletterAdmin']['NEWLIST'] = 'Nueva lista de correo';
$lang['es_ES']['NewsletterAdmin']['NEWNEWSLTYPE'] = 'Nuevo tipo de boletín';
$lang['es_ES']['NewsletterAdmin']['NEWSLTYPE'] = 'Tipo de boletín';
$lang['es_ES']['NewsletterAdmin']['PLEASEENTERMAIL'] = 'Por favor introduzca una dirección de correo';
$lang['es_ES']['NewsletterAdmin']['RESEND'] = 'Reenviar';
$lang['es_ES']['NewsletterAdmin']['SAVE'] = 'Guardar';
$lang['es_ES']['NewsletterAdmin']['SAVED'] = 'Guardado';
$lang['es_ES']['NewsletterAdmin']['SEND'] = 'Enviar...';
$lang['es_ES']['NewsletterAdmin']['SENDING'] = 'Enviando correos...';
$lang['es_ES']['NewsletterAdmin']['SENTTESTTO'] = 'Se ha enviado una prueba a';
$lang['es_ES']['NewsletterAdmin']['SHOWCONTENTS'] = 'Mostrar los contenidos';
$lang['es_ES']['NewsletterAdmin_BouncedList.ss']['EMADD'] = 'E-mail';
$lang['es_ES']['NewsletterAdmin_BouncedList.ss']['HAVEBOUNCED'] = 'Emails devueltos';
$lang['es_ES']['NewsletterAdmin_BouncedList.ss']['NOBOUNCED'] = 'No han sido devueltos correos electrónicos.';
$lang['es_ES']['NewsletterAdmin_BouncedList.ss']['UNAME'] = 'Usuario';
$lang['es_ES']['NewsletterAdmin_left.ss']['ADDDRAFT'] = 'Añadir nuevo borrador';
$lang['es_ES']['NewsletterAdmin_left.ss']['ADDTYPE'] = 'Añadir nuevo tipo';
$lang['es_ES']['NewsletterAdmin_left.ss']['CREATE'] = 'Crear';
$lang['es_ES']['NewsletterAdmin_left.ss']['DEL'] = 'Eliminar';
$lang['es_ES']['NewsletterAdmin_left.ss']['DELETEDRAFTS'] = 'Eliminar los borradores seleccionados';
$lang['es_ES']['NewsletterAdmin_left.ss']['GO'] = 'Ir';
$lang['es_ES']['NewsletterAdmin_left.ss']['NEWSLETTERS'] = 'Boletines';
$lang['es_ES']['NewsletterAdmin_left.ss']['SELECTDRAFTS'] = 'Seleccione los borradores que quiere eliminar y luego pulse el siguiente botón';
$lang['es_ES']['NewsletterAdmin_right.ss']['CANCEL'] = 'Cancelar';
$lang['es_ES']['NewsletterAdmin_right.ss']['ENTIRE'] = 'Enviar a toda la lista de correo';
$lang['es_ES']['NewsletterAdmin_right.ss']['ONLYNOT'] = 'Enviar sólo a gente a la que no se le ha enviado previamente';
$lang['es_ES']['NewsletterAdmin_right.ss']['SEND'] = 'Enviar boletín';
$lang['es_ES']['NewsletterAdmin_right.ss']['SENDTEST'] = 'Enviar prueba a';
$lang['es_ES']['NewsletterAdmin_right.ss']['WELCOME1'] = 'Bienvenido a la sección de administración de boletines de notícias de ';
$lang['es_ES']['NewsletterAdmin_right.ss']['WELCOME2'] = '. Por favor, elija una carpeta de la izquierda.';
$lang['es_ES']['NewsletterAdmin_SiteTree.ss']['DRAFTS'] = 'Borradores';
$lang['es_ES']['NewsletterAdmin_SiteTree.ss']['MAILLIST'] = 'Lista de correo';
$lang['es_ES']['NewsletterAdmin_SiteTree.ss']['SENT'] = 'Elementos enviados';
$lang['es_ES']['NewsletterAdmin_UnsubscribedList.ss']['NOUNSUB'] = 'No hay usuarios que se hayan dado de baja en este boletín.';
$lang['es_ES']['NewsletterAdmin_UnsubscribedList.ss']['UNAME'] = 'Nombre de usuario';
$lang['es_ES']['NewsletterAdmin_UnsubscribedList.ss']['UNSUBON'] = 'Dado de baja el';
$lang['es_ES']['NewsletterList.ss']['CHOOSEDRAFT1'] = 'Por favor, escoja un borrador de la izquierda, o bién';
$lang['es_ES']['NewsletterList.ss']['CHOOSEDRAFT2'] = 'añada uno';
$lang['es_ES']['NewsletterList.ss']['CHOOSESENT'] = 'Por favor elija un elemento enviado de la izquierda.';
$lang['es_ES']['Newsletter_RecipientImportField.ss']['CHANGED'] = 'Número de detalles cambiados:';
$lang['es_ES']['Newsletter_RecipientImportField.ss']['IMPORTED'] = 'Nuevos miembros importados:';
$lang['es_ES']['Newsletter_RecipientImportField.ss']['IMPORTNEW'] = 'Importar nuevos miembros';
$lang['es_ES']['Newsletter_RecipientImportField.ss']['SEC'] = 'segundos';
$lang['es_ES']['Newsletter_RecipientImportField.ss']['SKIPPED'] = 'Elementos omitidos:';
$lang['es_ES']['Newsletter_RecipientImportField.ss']['TIME'] = 'Tiempo requerido:';
$lang['es_ES']['Newsletter_RecipientImportField.ss']['UPDATED'] = 'Miembros actualizados:';
$lang['es_ES']['Newsletter_RecipientImportField_Table.ss']['CONTENTSOF'] = 'Contenidos de';
$lang['es_ES']['Newsletter_RecipientImportField_Table.ss']['NO'] = 'Cancelar';
$lang['es_ES']['Newsletter_RecipientImportField_Table.ss']['RECIMPORTED'] = 'Destinatarios importados de';
$lang['es_ES']['Newsletter_RecipientImportField_Table.ss']['YES'] = 'Confirmar';
$lang['es_ES']['Newsletter_SentStatusReport.ss']['DATE'] = 'Fecha';
$lang['es_ES']['Newsletter_SentStatusReport.ss']['EMAIL'] = 'E-mail';
$lang['es_ES']['Newsletter_SentStatusReport.ss']['FN'] = 'Nombre(s)';
$lang['es_ES']['Newsletter_SentStatusReport.ss']['NEWSNEVERSENT'] = 'El Boletín Nunca ha Sido Enviado a los siguientes Suscripitores';
$lang['es_ES']['Newsletter_SentStatusReport.ss']['RES'] = 'Resultado';
$lang['es_ES']['Newsletter_SentStatusReport.ss']['SENDBOUNCED'] = 'El Envío a los Siguientes Destinatarios ha sido Devuelto';
$lang['es_ES']['Newsletter_SentStatusReport.ss']['SENDFAIL'] = 'El Wnvío a los Siguientes Destinatarios ha Fallado';
$lang['es_ES']['Newsletter_SentStatusReport.ss']['SENTOK'] = 'El envío a los Siguientes Destinatarios fue Exitoso';
$lang['es_ES']['Newsletter_SentStatusReport.ss']['SN'] = 'Apellidos';

?>