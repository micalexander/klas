(function() {
	$(document).ready(function(){

		$('.menu-item').has( "ul" ).each(function(e) {
	    	if (!$(this).data('appends')) {

				$(this).clone().removeClass('menu-item-has-children').addClass('cloned').prependTo($(this).children('ul.sub-menu'));
				$(this).closest('.menu-item').children('ul.sub-menu').children('li').children('ul.sub-menu').remove();

				$(this).data('appends','appended');
			}
		});
		var nav = responsiveNav(".nav-collapse", { // Selector
		    animate: true, // Boolean: Use CSS3 transitions, true or false
		    transition: 250, // Integer: Speed of the transition, in milliseconds
		    label: "", // String: Label for the navigation toggle
		    insert: "before", // String: Insert the toggle before or after the navigation
		    customToggle: "toggle", // Selector: Specify the ID of a custom toggle
		    openPos: "static", // String: Position of the opened nav, relative or static
		    jsClass: "js", // String: 'JS enabled' class which is added to <html> el
		    init: function(){}, // Function: Init callback
		    open: function(){
	    		if ('.menu-item ul') {
					$('.sub-menu').hide();
				}

		    }, // Function: Open callback
		    close: function(){} // Function: Close callback
		});

	});
})();

function enableNav() {
	$('.menu-item').has( "ul" ).children('a').on('click', function(e) {
		e.preventDefault();
		e.stopPropagation();
		// set clicks to the value of data['clicks'] which is unset
		var clicks = $(this).data('clicks');
		// if clicks is not set to true
		if (!clicks) {
			$(this).parent().children('ul.sub-menu').first().slideDown(150);
		} else {
			$(this).parent().children('ul.sub-menu').first().slideUp(150);
		}
		// set data['clicks'] to the opposite of its current value
		$(this).data('clicks', !clicks);
	})
}

function disableNav() {
	$('.menu-item').has( "ul" ).children('a').off('click');
	$('.sub-menu').css({ 'display': '' });
}
