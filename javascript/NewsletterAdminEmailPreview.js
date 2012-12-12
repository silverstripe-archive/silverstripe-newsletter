(function($){
	"use strict";

	$.entwine('ss', function($) {

		$('a.newsletter-preview-email').entwine({
			onclick: function(e) {
				var email = jQuery.url(this.attr('href')).param('email');   //using jquery-purl.js plug-in
				var prompt = this.sendPrompt(email);
				if (prompt !== null) {
					this.attr('href',this.attr('href').replace(/name=/gi,'name='+prompt));

					this._super(e);
				} else {
					return false;
				}
			},
			sendPrompt: function(email){
				var message = 'Send a preview email to:';
				return prompt(message, email);
			}


		});

	});

}(jQuery));
