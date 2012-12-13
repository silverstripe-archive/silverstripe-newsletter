(function($){
	"use strict";

	$.entwine('ss', function($) {

		$('#action_doSend').entwine({
			onclick: function(e) {
				if (this.confirmSend()) {
					this._super(e);
				} else {
					return false;
				}
			},
			confirmSend: function(){
				var message = 'Are you sure you want to send this newsletter?';
				return confirm(message);
			}


		});

		/** Hide the success message when the second tab is clicked */
		$('.message.good').entwine({
			onmatch: function() {
				var self = this;
				$('a[href$="Root_SentTo"]').on('click',function(e){
					self.hide();
				});

			}
		});

	});

}(jQuery));
