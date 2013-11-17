(function() {
	$(document).ready(function(){

		var nav = responsiveNav(".nav-collapse", { // Selector
		    animate: true, // Boolean: Use CSS3 transitions, true or false
		    transition: 250, // Integer: Speed of the transition, in milliseconds
		    label: "Menu", // String: Label for the navigation toggle
		    insert: "after", // String: Insert the toggle before or after the navigation
		    customToggle: "", // Selector: Specify the ID of a custom toggle
		    openPos: "static", // String: Position of the opened nav, relative or static
		    jsClass: "js", // String: 'JS enabled' class which is added to <html> el
		    init: function(){}, // Function: Init callback
		    open: function(){}, // Function: Open callback
		    close: function(){} // Function: Close callback
		});
	});
})();

function enableNav() {

	if ('.menu-item ul') {
		$('.sub-menu').hide();
	}

	$('.menu-item a').click(function(e) {
		e.preventDefault();
		e.stopPropagation();
		if ($(this).parent('.menu-item:has(> ul)')) {
			// set clicks to the value of data['clicks'] which is unset
			var clicks = $(this).data('clicks');
			// if clicks is not set to true
			if (!clicks) {
				if (!$(this).data('appends')) {
	   				$(this).parent().clone().prependTo($(this).parent().children('ul.sub-menu'));
	   				$(this).closest('.menu-item').children('ul.sub-menu').children('li').children('ul.sub-menu').remove();
				};
    			$(this).parent().children('ul.sub-menu').slideDown();
    			// $(this).closest('.menu-item').children('.sub-menu').slideDown();
    		} else {
    			$(this).parent().children('ul.sub-menu').slideUp();
			}
			// set data['clicks'] to the opposite of its value
			$(this).data('clicks', !clicks).data('appends','appended');
    	}
	})
}

function disableNav() {
	$('.menu-item a').off();
	$('.sub-menu').css({ 'display': '' });
}
