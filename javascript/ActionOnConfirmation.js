(function($){
	/*"use strict";*/
	$.entwine('ss', function($) {
		$('#action_doSend').entwine({
			onclick: function(e) {
				var message = ss.i18n._t('NEWSLETTER.SENDCONFIRMMESSAGE',
					'Are you sure you want to send this newsletter?');
				if (confirm(message)) {
					this._super(e);
				} else {
					e.preventDefault();
					return false;
				}
			}
		});

		$("#Form_ItemEditForm_action_doDelete").entwine({
			onclick: function(e) {
				// customise confirm delete messages for clarity
				var item = 'record';
				var pageAction = $('#Form_ItemEditForm').attr('action');
				if(pageAction.indexOf('ItemEditForm/field/Recipients/item/') != -1){
					item = 'Recipient';
				}else if(pageAction.indexOf('admin/newsletter/MailingList/EditForm/field/MailingList/') == 0){
					item = 'Mailing List';
				}
				var message = ss.i18n._t('NEWSLETTERADMIN.DELETECONFIRMMESSAGE',
					'Are you sure you want to delete this '+item+'?');
					
				if (confirm(message)) {
					this._super(e);
				} else {
					e.preventDefault();
					return false;
				}
			}
		});

		/** Hide the success message when the other tab is clicked */
		$('.message.good').entwine({
			onmatch: function() {
				var self = this;
				$('a[href$="Root_SentTo"]').on('click', function(e){
					self.hide();
				});
			}

		});

	});

}(jQuery));
