<?php

/**
 * Portuguese (Portugal) language pack
 * @package modules: newsletter
 * @subpackage i18n
 */

i18n::include_locale_file('modules: newsletter', 'en_US');

global $lang;

if(array_key_exists('pt_PT', $lang) && is_array($lang['pt_PT'])) {
	$lang['pt_PT'] = array_merge($lang['en_US'], $lang['pt_PT']);
} else {
	$lang['pt_PT'] = $lang['en_US'];
}

$lang['pt_PT']['LeftAndMain']['NEWSLETTERS'] = 'Listas de Email';
$lang['pt_PT']['NewsletterAdmin']['FROMEM'] = 'Do endereço de email';
$lang['pt_PT']['NewsletterAdmin']['MEWDRAFTMEWSL'] = 'Novo rascunho de lista de email';
$lang['pt_PT']['NewsletterAdmin']['NEWLIST'] = 'Nova lista de email';
$lang['pt_PT']['NewsletterAdmin']['NEWNEWSLTYPE'] = 'Novo tipo de lista de email';
$lang['pt_PT']['NewsletterAdmin']['NEWSLTYPE'] = 'Tipo de Lista de email';
$lang['pt_PT']['NewsletterAdmin']['PLEASEENTERMAIL'] = 'Por favor insira um endereço de email';
$lang['pt_PT']['NewsletterAdmin']['RESEND'] = 'Reenviar';
$lang['pt_PT']['NewsletterAdmin']['SAVE'] = 'Gravar';
$lang['pt_PT']['NewsletterAdmin']['SAVED'] = 'Gravado';
$lang['pt_PT']['NewsletterAdmin']['SEND'] = 'Enviar...';
$lang['pt_PT']['NewsletterAdmin']['SENDING'] = 'A Enviar emails...';
$lang['pt_PT']['NewsletterAdmin']['SENTTESTTO'] = 'Enviar teste para ';
$lang['pt_PT']['NewsletterAdmin']['SHOWCONTENTS'] = 'Mostrar conteúdo';
$lang['pt_PT']['NewsletterAdmin_BouncedList.ss']['EMADD'] = 'Endereço de Email';
$lang['pt_PT']['NewsletterAdmin_BouncedList.ss']['HAVEBOUNCED'] = 'Emails devolvidos';
$lang['pt_PT']['NewsletterAdmin_BouncedList.ss']['NOBOUNCED'] = 'Nenhum email enviado foi devolvido.';
$lang['pt_PT']['NewsletterAdmin_BouncedList.ss']['UNAME'] = 'Nome de Utilizador';
$lang['pt_PT']['NewsletterAdmin_left.ss']['ADDDRAFT'] = 'Adicionar novo rascunho';
$lang['pt_PT']['NewsletterAdmin_left.ss']['ADDTYPE'] = 'Adicionar novo tipo';
$lang['pt_PT']['NewsletterAdmin_left.ss']['CREATE'] = 'Criar';
$lang['pt_PT']['NewsletterAdmin_left.ss']['DEL'] = 'Apagar';
$lang['pt_PT']['NewsletterAdmin_left.ss']['DELETEDRAFTS'] = 'Apagar os rascunhos seleccionados';
$lang['pt_PT']['NewsletterAdmin_left.ss']['GO'] = 'Ir';
$lang['pt_PT']['NewsletterAdmin_left.ss']['NEWSLETTERS'] = 'Listas de Email';
$lang['pt_PT']['NewsletterAdmin_left.ss']['SELECTDRAFTS'] = 'Seleccione os rascunhos que deseja apagar, em seguida pressione o botão abaixo';
$lang['pt_PT']['NewsletterAdmin_right.ss']['CANCEL'] = 'Cancelar';
$lang['pt_PT']['NewsletterAdmin_right.ss']['ENTIRE'] = 'Enviar para toda a lista de email';
$lang['pt_PT']['NewsletterAdmin_right.ss']['ONLYNOT'] = 'Enviar apenas para pessoas que não foi enviado anteriormente';
$lang['pt_PT']['NewsletterAdmin_right.ss']['SEND'] = 'Enviar lista de email';
$lang['pt_PT']['NewsletterAdmin_right.ss']['SENDTEST'] = 'Enviar teste para';
$lang['pt_PT']['NewsletterAdmin_right.ss']['WELCOME1'] = 'Bem vindo ao';
$lang['pt_PT']['NewsletterAdmin_right.ss']['WELCOME2'] = 'secção de administração de listas de email.  Por favor escolha uma pasta na esquerda.';
$lang['pt_PT']['NewsletterAdmin_SiteTree.ss']['DRAFTS'] = 'Rascunhos';
$lang['pt_PT']['NewsletterAdmin_SiteTree.ss']['MAILLIST'] = 'Lista de Email';
$lang['pt_PT']['NewsletterAdmin_SiteTree.ss']['SENT'] = 'Itens Enviados';
$lang['pt_PT']['NewsletterAdmin_UnsubscribedList.ss']['NOUNSUB'] = 'Nenhum utilizador removeu a assinatura desta lista de email.';
$lang['pt_PT']['NewsletterAdmin_UnsubscribedList.ss']['UNAME'] = 'Nome de Utilizador';
$lang['pt_PT']['NewsletterAdmin_UnsubscribedList.ss']['UNSUBON'] = 'Assinatura removida em';
$lang['pt_PT']['NewsletterList.ss']['CHOOSEDRAFT1'] = 'Por favor escolha um rascunho na esquerda, ou';
$lang['pt_PT']['NewsletterList.ss']['CHOOSEDRAFT2'] = 'adicione um';
$lang['pt_PT']['NewsletterList.ss']['CHOOSESENT'] = 'Por favor escolha um item enviado na esquerda.';
$lang['pt_PT']['Newsletter_RecipientImportField.ss']['CHANGED'] = 'Número de detalhes alterados:';
$lang['pt_PT']['Newsletter_RecipientImportField.ss']['IMPORTED'] = 'Novos membros importados:';
$lang['pt_PT']['Newsletter_RecipientImportField.ss']['IMPORTNEW'] = 'Novos membros importados';
$lang['pt_PT']['Newsletter_RecipientImportField.ss']['SEC'] = 'segundos';
$lang['pt_PT']['Newsletter_RecipientImportField.ss']['SKIPPED'] = 'Registos não alterados:';
$lang['pt_PT']['Newsletter_RecipientImportField.ss']['TIME'] = 'Efectuado em:';
$lang['pt_PT']['Newsletter_RecipientImportField.ss']['UPDATED'] = 'Membros actualizados:';
$lang['pt_PT']['Newsletter_RecipientImportField_Table.ss']['CONTENTSOF'] = 'Conteúdo de';
$lang['pt_PT']['Newsletter_RecipientImportField_Table.ss']['NO'] = 'Cancelar';
$lang['pt_PT']['Newsletter_RecipientImportField_Table.ss']['RECIMPORTED'] = 'Recipientes importados de';
$lang['pt_PT']['Newsletter_RecipientImportField_Table.ss']['YES'] = 'Confirmar';
$lang['pt_PT']['Newsletter_SentStatusReport.ss']['DATE'] = 'Data';
$lang['pt_PT']['Newsletter_SentStatusReport.ss']['EMAIL'] = 'Email';
$lang['pt_PT']['Newsletter_SentStatusReport.ss']['FN'] = 'Primeiro Nome';
$lang['pt_PT']['Newsletter_SentStatusReport.ss']['NEWSNEVERSENT'] = 'O Email nunca foi enviado para os seguintes assinantes';
$lang['pt_PT']['Newsletter_SentStatusReport.ss']['RES'] = 'Resultado';
$lang['pt_PT']['Newsletter_SentStatusReport.ss']['SENDBOUNCED'] = 'O envio para os seguintes destinatários foi devolvido';
$lang['pt_PT']['Newsletter_SentStatusReport.ss']['SENDFAIL'] = 'O envio para os seguintes destinatários falhou';
$lang['pt_PT']['Newsletter_SentStatusReport.ss']['SENTOK'] = 'O envio para os seguintes destinatários foi efectuado com sucesso';
$lang['pt_PT']['Newsletter_SentStatusReport.ss']['SN'] = 'Sobrenome';

?>