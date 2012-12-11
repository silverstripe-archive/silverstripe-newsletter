(function($) {
	"use strict";

	$.entwine('ss', function($) {

		$('#Actions ul li').entwine({
			onclick: function(e) {
				//add active state to the current button
				$('#Actions ul li').removeClass('active');
				this.addClass('active');
				//$('li.dms-active').append('<span class="arrow"></span>');

				//hide all inner field sections
				var panel = $('#ActionsPanel');
				panel.find('div.fieldgroup-field').hide();

				//show the correct group of controls
				panel.find('.'+this.data('panel')).closest('div.fieldgroup-field').show();
			}
		});

	});
}(jQuery));