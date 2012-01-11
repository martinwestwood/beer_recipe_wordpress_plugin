jQuery(function(jQuery) {
	
	jQuery('.grain_add').click(function() {
		jQuery('#grains_table .tbody>.tr:last')
			.clone(true)
			.insertAfter('#grains_table .tbody>.tr:last')
			.addClass('more')
			.find('input[type=text], input[type=number], select').val('')
			.attr('name', function(index, name) {
				return name.replace(/(\d+)/, function(fullMatch, n) {
					return Number(n) + 1;
				});
			})
			.parent().find('input, select')
			.attr('id', function(index, id) {
				return id.replace(/(\d+)/, function(fullMatch, n) {
					return Number(n) + 1;
				});
			})
			.parent().find('input.grain')
			.attr('onfocus', function(index, onfocus) {
				return onfocus.replace(/(\d+)/, function(fullMatch, n) {
					return Number(n) + 1;
				});
			})
		return false;
	});
	
	jQuery('.grain_remove').click(function(){
		jQuery(this).parent().parent().remove();
		return false;
	});
	
	jQuery('#grains_table .tbody').sortable({
		opacity: 0.6,
		revert: true,
		cursor: 'move',
		handle: '.sort'
	});
    
    
    jQuery('.hop_add').click(function() {
		jQuery('#hops_table .tbody>.tr:last')
			.clone(true)
			.insertAfter('#hops_table .tbody>.tr:last')
			.addClass('more')
			.find('input[type=text], input[type=number], select').val('')
			.attr('name', function(index, name) {
				return name.replace(/(\d+)/, function(fullMatch, n) {
					return Number(n) + 1;
				});
			})
			.parent().find('input, select')
			.attr('id', function(index, id) {
				return id.replace(/(\d+)/, function(fullMatch, n) {
					return Number(n) + 1;
				});
			})
			.parent().find('input.hop')
			.attr('onfocus', function(index, onfocus) {
				return onfocus.replace(/(\d+)/, function(fullMatch, n) {
					return Number(n) + 1;
				});
			})
		return false;
	});
	
	jQuery('.hop_remove').click(function(){
		jQuery(this).parent().parent().remove();
		return false;
	});
	
	jQuery('#hops_table .tbody').sortable({
		opacity: 0.6,
		revert: true,
		cursor: 'move',
		handle: '.sort'
	});
    
    
    
	
	jQuery('.brewery_add').click(function() {
		jQuery('#breweries_table .tbody>.tr:last')
			.clone(true)
			.insertAfter('#breweries_table .tbody>.tr:last')
			.addClass('more')
			.find('input[type=text], input[type=number], select').val('')
			.attr('name', function(index, name) {
				return name.replace(/(\d+)/, function(fullMatch, n) {
					return Number(n) + 1;
				});
			})
			.parent().find('input, select')
			.attr('id', function(index, id) {
				return id.replace(/(\d+)/, function(fullMatch, n) {
					return Number(n) + 1;
				});
			})
			.parent().find('input.brewery')
			.attr('onfocus', function(index, onfocus) {
				return onfocus.replace(/(\d+)/, function(fullMatch, n) {
					return Number(n) + 1;
				});
			})
		return false;
	});
	
	jQuery('.brewery_remove').click(function(){
		jQuery(this).parent().parent().remove();
		return false;
	});
	
	jQuery('#breweries_table .tbody').sortable({
		opacity: 0.6,
		revert: true,
		cursor: 'move',
		handle: '.sort'
	});
    
	
	//On Click Event
	jQuery('.image_radio label').click(function() {
		jQuery('.image_radio label').removeClass('active'); //Remove any 'active' class
		jQuery(this).addClass('active'); //Add 'active' class to selected tab
	});

});