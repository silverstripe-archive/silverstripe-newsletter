(function($){
	"use strict";

	$.entwine('ss', function($) {

		$('a.newsletter-preview-email').entwine({
			onclick: function(e) {
				var email = jQuery.url(this.attr('href')).param('email');   //using jquery-purl.js plug-in
				var prompt = this.sendPrompt(email);
				if (prompt !== null) {
					var newHref = this.attr('href').replace(/email=.*$/gi,'email='+prompt);
					window.location = newHref;  //open url of the send link
				}
				return false;
			},
			sendPrompt: function(email){
				var message = 'Send a preview email to:';
				return prompt(message, email);
			}


		});

	});

}(jQuery));
