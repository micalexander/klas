$(document).ready(function(){

	// accordion
    (function(){
        $('.accordion-section').hide();
        $('.accordion-key').click(function(){
			var clicks = $(this).data('clicks');
			if (!clicks) {
				$(this).addClass('selected');
			    $(this).children('.accordion-section').addClass('selected').slideDown();
			    $(this).siblings('.accordion-key').removeClass('selected');
			    $(this).siblings('.accordion-key').removeData('clicks');
			    $(this).siblings('.accordion-key').children('.accordion-section').removeClass('selected').slideUp();
			} else {
				$(this).removeClass('selected');
			    $(this).children('.accordion-section').removeClass('selected').slideUp();
			    $(this).siblings('.accordion-key').removeClass('selected');
			    $(this).siblings('.accordion-key').removeData('clicks');
			    $(this).siblings('.accordion-key').children('.accordion-section').removeClass('selected').slideUp();
			}
			$(this).data("clicks", !clicks);
        });
    })();

});