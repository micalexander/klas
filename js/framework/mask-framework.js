$(document).ready(function(){

	// accordion
    (function(){
        $('.accordion-section').hide();
        $('.accordion-heading').click(function(){
			var clicks = $(this).data('clicks');
			if (!clicks) {
				$(this).addClass('selected');
			    $(this).next('.accordion-section').addClass('selected').slideDown();
			    $(this).parent().siblings().children('.accordion-heading').removeClass('selected').removeData('clicks');
			    $(this).parent().parent().siblings().children().children('.accordion-heading').removeClass('selected').removeData('clicks');
			    $(this).parent().siblings().children('.accordion-heading').next('.accordion-section').removeClass('selected').slideUp();
			    $(this).parent().parent().siblings().children().children('.accordion-heading').next('.accordion-section').removeClass('selected').slideUp();
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
			    $(this).parent().siblings().children('.accordion-heading').removeClass('selected').removeData('clicks');
			    $(this).parent().parent().siblings().children().children('.accordion-heading').removeClass('selected').removeData('clicks');
			    $(this).parent().parent().siblings().children().children('.accordion-section').removeClass('selected').slideUp();
			}
			$(this).data("clicks", !clicks);
        });
    })();
});