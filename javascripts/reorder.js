function reorder(direction, object_id, type, row_container_prefix, flash) {
	flash = (flash == true) ? true : false
	var active_row = $(row_container_prefix + object_id);
	
	var switch_row = null;
	if (direction == 'up') {
		switch_row = active_row.getPrevious();
	} else if (direction == 'down') {
		switch_row = active_row.getNext();
	} else if (direction == 'top') {
		switch_row = active_row.getParent().getFirst();
	} else {
		switch_row = active_row.getParent().getLast();
	}

	var new_order  = 0;

	if (switch_row != null) {
		for(var x = switch_row; x != null; x = x.getPrevious()) { 
			new_order += 1; 
		}
		
		new Ajax('/xhrs/reorder.php?type=' + type + '&id=' + object_id + '&new_order=' + new_order, {method: 'get'}).request();
		
		if (direction == 'up') {
			active_row.injectBefore(switch_row);
		} else if (direction == 'down') {
			switch_row.injectBefore(active_row);
		} else if (direction == 'top') {
			active_row.injectTop(active_row.getParent());
		} else if (direction == 'bottom')  {
			active_row.injectAfter(switch_row);
		}

		if (active_row.hasClass('even') && switch_row.hasClass('odd') || active_row.hasClass('odd') && switch_row.hasClass('even')) {
			active_row.toggleClass('even');
			active_row.toggleClass('odd');
			switch_row.toggleClass('even');
			switch_row.toggleClass('odd');
		}
	
		if (flash) {
			active_row.setStyle('background-color', '');
			switch_row.setStyle('background-color', '');
			
			flash_element(active_row);
		} 
	}
}
	
function flash_element(elem) {
	var el = $(elem);
	el.flash = new Fx.Style(el.getProperty('id'), 'background-color', {duration: 400}).start('#d16e54', el.getStyle('background-color'));
}