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

	});

}(jQuery));
