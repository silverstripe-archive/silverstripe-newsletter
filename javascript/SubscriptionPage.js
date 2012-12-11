(function($) {
	"use strict";

	$.entwine('ss', function($) {

		$('#Actions ul li').entwine({
			onclick: function(e) {
				//add active state to the current button
				$('#Actions ul li').removeClass('active');
				this.addClass('active');
				var panel = $('.ActionsPanel');

				if (this.hasClass('yes') && this.hasClass('active')){
					panel.show();
				}
				else {
					console.log('no');
					panel.hide();
				}
			}
		});

	});
}(jQuery));