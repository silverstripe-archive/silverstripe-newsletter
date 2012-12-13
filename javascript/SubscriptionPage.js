(function($) {
	/*"use strict";*/

	$.entwine('ss', function($) {
		$('#SendNotificationControlls ul li').entwine({
			onmatch: function() {
				this._super();
				if($('#Form_EditForm_SendNotification').val()==='0'){
					$('.SendNotificationControlledPanel').hide();
					if (this.hasClass('no')) this.addClass('active');
				}else{
					$('.SendNotificationControlledPanel').show();
					if (this.hasClass('yes')) this.addClass('active');
				}
			},

			onclick: function(e) {
				this.addClass('active');
				this.siblings('.active').removeClass('active');

				if(this.hasClass('yes')){
					$('.SendNotificationControlledPanel').show();
					$('#Form_EditForm_SendNotification').val('1');

				}else{
					$('.SendNotificationControlledPanel').hide();
					$('#Form_EditForm_SendNotification').val('0');
				}
			}
		});
	});
}(jQuery));