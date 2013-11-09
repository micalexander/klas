(function() {
	$(document).ready(function(){

		$('.image-rotator, .text-rotator, .blockquote-rotator').flexslider({
		    slideshowSpeed: 4000,
		    animationSpeed: 800,
		    // Primary Controls
			controlNav: false,
			directionNav: true,
			prevText: "Previous",
			nextText: "Next",
			// Secondary Navigation
			keyboard: true,
			multipleKeyboard: false,
			mousewheel: false,
			pausePlay: false,
			pauseText: 'Pause',
			playText: 'Play',
		    animation: 'fade',
		    easing: 'swing'
		});
		$('.image-carousel').flexslider({
			animation: "slide",
		    // animationLoop: false,
		    itemWidth: 180,
		    itemMargin: 10
		});
	});
})();