(function($){
	"use strict";

	$.entwine('ss', function($) {

		$('a.newsletter-preview-email').entwine({
			onclick: function(e) {
				var email = this.attr('href').match(/email=(.*)/);
				var prompt = this.sendPrompt(email[1]);
				if (prompt !== null) {
					var base = $('base').attr('href'); //IE needs this
					var newHref = base + this.attr('href').replace(/email=.*$/gi,'email='+prompt);
					window.location = newHref;  //open url of the send link
				}
				return false;
			},
			sendPrompt: function(email){
				var message = 'Send a test email to:';
				return prompt(message, email);
			}


		});

	});

}(jQuery));
