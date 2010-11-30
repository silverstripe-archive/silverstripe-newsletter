(function($) {
	$(document).ready(function() {
		
		/**
		 * @todo tableDnD is not live query compatibile.
		 *
		 * Needs to reapply events when tab is changed.
		 */
    	$("table.checkboxsetwithextrafield").tableDnD({
			onDragClass: "DnD_whiledragging",
			dragHandle: "dragHandle",
			onDragStart: function(table, row) {
				indicator = document.createElement('div');
				indicator.innerHTML = 'Moving the row ...';
				$(row).append(indicator);
			},
			onDrop:function(table, row){
				jQuery($(row).children(".dragHandle")[0]).empty();
			}
		});
		
		$("table.checkboxsetwithextrafield tbody tr").live("mouseover", function(){
			jQuery($(this).children(".dragHandle")[0]).addClass('showDragHandle');
		});
		
		$("table.checkboxsetwithextrafield tbody tr").live("mouseout", function(){
			jQuery($(this).children(".dragHandle")[0]).removeClass('showDragHandle');
		});
	});
})(jQuery);


