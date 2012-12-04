
(function($){
	$.entwine('ss', function($) {
		$('table.checkboxsetwithextrafield').entwine({
			UUID: null,
			onmatch: function() {
				this._super();
				this.tableDnD({
					onDragClass: "DnD_whiledragging",
					dragHandle: ".dragHandle",
					onDragStart: function(table, row) {
						indicator = document.createElement('div');
						$(indicator).html('Moving ...');
						$(row).append($(indicator));
					},
					onDrop:function(table, row){
						jQuery($(row).find(".dragHandle")[0]).empty();
					}
				});
			},
			onunmatch: function() {
				this._super();
			}
		});
		$('table.checkboxsetwithextrafield tbody tr').entwine({
			onmouseover: function() {
				jQuery($(this).children(".dragHandle")[0]).addClass('showDragHandle');
			},
			onmouseout: function() {
				jQuery($(this).children(".dragHandle")[0]).removeClass('showDragHandle');
			},
			onmouseup: function() {
				jQuery($(this).find(".dragHandle")[0]).empty();
			}
		});
	});
}(jQuery));