$(document).ready(function(){

	// accordion
    (function(){
        $('.accordion-section').hide();
        $('.accordion-heading').click(function(){
			var clicks = $(this).data('clicks');
			if (!clicks) {
				$(this).addClass('selected');
			    $(this).next('.accordion-section').addClass('selected').slideDown();
			    $(this).siblings('.accordion-heading').removeClass('selected');
			    $(this).siblings('.accordion-heading').removeData('clicks');
			    $(this).siblings('.accordion-heading').next('.accordion-section').removeClass('selected').slideUp();
			    $(this).siblings().children().children().click(function() {
			    	var childClicks = $(this).data('clicks');
			    	if (!childClicks) {
				    	$(this).addClass('selected');
				    	$(this).siblings().removeClass('selected');
				    } else {
				    	$(this).removeClass('selected');
				    	$(this).removeData('clicks');
				    }
			    });
			} else {
				$(this).removeClass('selected');
			    $(this).next('.accordion-section').removeClass('selected').slideUp();
			    $(this).siblings('.accordion-heading').removeClass('selected');
			    $(this).siblings('.accordion-heading').removeData('clicks');
			    $(this).siblings('.accordion-heading').next('.accordion-section').removeClass('selected').slideUp();
			}
			$(this).data("clicks", !clicks);
        });
    })();
});