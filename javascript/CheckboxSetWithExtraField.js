(function($) {
	$(document).ready(function() {
    	$("table.checkboxsetwithextrafield").livequery(function(){
			$(this).tableDnD({
				//TODO: refresh odd/even class for each row after drop action.				
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
		});
		
		$("table.checkboxsetwithextrafield tbody tr").livequery("mouseover", function(){
			jQuery($(this).children(".dragHandle")[0]).addClass('showDragHandle');
		});
		
		$("table.checkboxsetwithextrafield tbody tr").livequery("mouseout", function(){
			jQuery($(this).children(".dragHandle")[0]).removeClass('showDragHandle');
		});
	});
})(jQuery);

