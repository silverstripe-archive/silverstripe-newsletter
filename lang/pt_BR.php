<?php

/**
 * Portuguese (Brazil) language pack
 * @package modules: newsletter
 * @subpackage i18n
 */

i18n::include_locale_file('modules: newsletter', 'en_US');

global $lang;

if(array_key_exists('pt_BR', $lang) && is_array($lang['pt_BR'])) {
	$lang['pt_BR'] = array_merge($lang['en_US'], $lang['pt_BR']);
} else {
	$lang['pt_BR'] = $lang['en_US'];
}

$lang['pt_BR']['LeftAndMain']['NEWSLETTERS'] = 'Newsletters';
$lang['pt_BR']['NewsletterAdmin']['FROMEM'] = 'Do endereço de email';
$lang['pt_BR']['NewsletterAdmin']['MEWDRAFTMEWSL'] = 'Novo rascunho de newsletter';
$lang['pt_BR']['NewsletterAdmin']['NEWLIST'] = 'Nova mauling list';
$lang['pt_BR']['NewsletterAdmin']['NEWNEWSLTYPE'] = 'Novo tipo de newsletter';
$lang['pt_BR']['NewsletterAdmin']['NEWSLTYPE'] = 'Tipo de Newsletter';
$lang['pt_BR']['NewsletterAdmin']['PLEASEENTERMAIL'] = 'Por favor entre um endereço de email';
$lang['pt_BR']['NewsletterAdmin']['RESEND'] = 'Reenviar';
$lang['pt_BR']['NewsletterAdmin']['SAVE'] = 'Salvar';
$lang['pt_BR']['NewsletterAdmin']['SAVED'] = 'Salvo';
$lang['pt_BR']['NewsletterAdmin']['SEND'] = 'Enviar...';
$lang['pt_BR']['NewsletterAdmin']['SENDING'] = 'Enviando emails...';
$lang['pt_BR']['NewsletterAdmin']['SENTTESTTO'] = 'Enviar teste para';
$lang['pt_BR']['NewsletterAdmin']['SHOWCONTENTS'] = 'Exibir conteúdo';
$lang['pt_BR']['NewsletterAdmin_BouncedList.ss']['EMADD'] = 'Endereço de email';
$lang['pt_BR']['NewsletterAdmin_BouncedList.ss']['HAVEBOUNCED'] = 'Emails que foram devolvidos';
$lang['pt_BR']['NewsletterAdmin_BouncedList.ss']['NOBOUNCED'] = 'Nenhum email enviado foi devolvido.';
$lang['pt_BR']['NewsletterAdmin_BouncedList.ss']['UNAME'] = 'Nome do usuário';
$lang['pt_BR']['NewsletterAdmin_left.ss']['ADDDRAFT'] = 'Adicionar novo rascunho';
$lang['pt_BR']['NewsletterAdmin_left.ss']['ADDTYPE'] = 'Adicionar novo tipo';
$lang['pt_BR']['NewsletterAdmin_left.ss']['CREATE'] = 'Criar';
$lang['pt_BR']['NewsletterAdmin_left.ss']['DEL'] = 'Remover';
$lang['pt_BR']['NewsletterAdmin_left.ss']['DELETEDRAFTS'] = 'Remover os rascunhos selecionados';
$lang['pt_BR']['NewsletterAdmin_left.ss']['GO'] = 'Ir';
$lang['pt_BR']['NewsletterAdmin_left.ss']['NEWSLETTERS'] = 'Newsletters';
$lang['pt_BR']['NewsletterAdmin_left.ss']['SELECTDRAFTS'] = 'Selecione os rascunhos que pretende eliminar e, em seguida, clique no botão abaixo';
$lang['pt_BR']['NewsletterAdmin_right.ss']['CANCEL'] = 'Cancelar';
$lang['pt_BR']['NewsletterAdmin_right.ss']['ENTIRE'] = 'Enviar para toda a lista';
$lang['pt_BR']['NewsletterAdmin_right.ss']['ONLYNOT'] = 'Enviar só para pessoas para quem nunca foi enviado';
$lang['pt_BR']['NewsletterAdmin_right.ss']['SEND'] = 'Enviar newsletter';
$lang['pt_BR']['NewsletterAdmin_right.ss']['SENDTEST'] = 'Enviar teste para';
$lang['pt_BR']['NewsletterAdmin_right.ss']['WELCOME1'] = 'Bem vindo ao';
$lang['pt_BR']['NewsletterAdmin_right.ss']['WELCOME2'] = 'seção de administração de newsletter. Por favor escolha uma pasta da esquerda.';
$lang['pt_BR']['NewsletterAdmin_SiteTree.ss']['DRAFTS'] = 'rascunhos';
$lang['pt_BR']['NewsletterAdmin_SiteTree.ss']['MAILLIST'] = 'Mailing List';
$lang['pt_BR']['NewsletterAdmin_SiteTree.ss']['SENT'] = 'Items Enviados';
$lang['pt_BR']['NewsletterAdmin_UnsubscribedList.ss']['NOUNSUB'] = 'Nenhum utilizador anulou a subscrição desta newsletter.';
$lang['pt_BR']['NewsletterAdmin_UnsubscribedList.ss']['UNAME'] = 'Nome do usuário';
$lang['pt_BR']['NewsletterAdmin_UnsubscribedList.ss']['UNSUBON'] = 'Anular subscrição em';
$lang['pt_BR']['NewsletterList.ss']['CHOOSEDRAFT1'] = 'Por favor, escolha um rascuro à esquerda, ou';
$lang['pt_BR']['NewsletterList.ss']['CHOOSEDRAFT2'] = 'adicionar um';
$lang['pt_BR']['NewsletterList.ss']['CHOOSESENT'] = 'Por favor escolha um item enviado na esquerda';
$lang['pt_BR']['Newsletter_RecipientImportField.ss']['CHANGED'] = 'Número de detalhes alterados:';
$lang['pt_BR']['Newsletter_RecipientImportField.ss']['IMPORTED'] = 'Novos membros importados:';
$lang['pt_BR']['Newsletter_RecipientImportField.ss']['IMPORTNEW'] = 'Importados novos membros';
$lang['pt_BR']['Newsletter_RecipientImportField.ss']['SEC'] = 'segundos';
$lang['pt_BR']['Newsletter_RecipientImportField.ss']['SKIPPED'] = 'Registros pulados:';
$lang['pt_BR']['Newsletter_RecipientImportField.ss']['TIME'] = 'Tempo demorado:';
$lang['pt_BR']['Newsletter_RecipientImportField.ss']['UPDATED'] = 'Menbros actualizados';
$lang['pt_BR']['Newsletter_RecipientImportField_Table.ss']['CONTENTSOF'] = 'Conteúdos de';
$lang['pt_BR']['Newsletter_RecipientImportField_Table.ss']['NO'] = 'Cancelar';
$lang['pt_BR']['Newsletter_RecipientImportField_Table.ss']['RECIMPORTED'] = 'Destinatários importados de';
$lang['pt_BR']['Newsletter_RecipientImportField_Table.ss']['YES'] = 'Confirme';
$lang['pt_BR']['Newsletter_SentStatusReport.ss']['DATE'] = 'Data';
$lang['pt_BR']['Newsletter_SentStatusReport.ss']['EMAIL'] = 'Email';
$lang['pt_BR']['Newsletter_SentStatusReport.ss']['FN'] = 'Nome';
$lang['pt_BR']['Newsletter_SentStatusReport.ss']['NEWSNEVERSENT'] = 'A Newsletter Nunca Foi Enviada para os Seguintes Subscritores';
$lang['pt_BR']['Newsletter_SentStatusReport.ss']['RES'] = 'Resultado';
$lang['pt_BR']['Newsletter_SentStatusReport.ss']['SENDBOUNCED'] = 'O envio para os Seguintes Destinatários foi devolvido';
$lang['pt_BR']['Newsletter_SentStatusReport.ss']['SENDFAIL'] = 'O envio para os Seguintes Destinatários  Falhou';
$lang['pt_BR']['Newsletter_SentStatusReport.ss']['SENTOK'] = 'O Envio para os Seguintes Destinatários foi bem Sucedido';
$lang['pt_BR']['Newsletter_SentStatusReport.ss']['SN'] = 'Sobrenome';

?>