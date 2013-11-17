(function() {
	$(document).ready(function(){

		$('.image-rotator').flexslider({
		    slideshowSpeed: 4000,
		    animationSpeed: 800,
		    // Primary Controls
			controlNav: true,
			directionNav: true,
			prevText: "",
			nextText: "",
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
		$('.text-rotator, .blockquote-rotator').flexslider({
		    slideshowSpeed: 4000,
		    animationSpeed: 800,
		    // Primary Controls
			controlNav: true,
			directionNav: false,
			prevText: "",
			nextText: "",
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
		    itemWidth: 220,
		    itemMargin: 10
		});
	});
})();