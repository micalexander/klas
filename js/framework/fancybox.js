(function() {
	$(document).ready(function(){

		$('.text-lightbox-anchor, .image-gallery-anchor').fancybox({
			padding		 : 0,
			// openEffect    : 'elastic',
			// closeEffect   : 'elastic',
			maxWidth 	  : 1000,
			speedIn	      : 4000,
			speedOut	  : 4000,
			helpers		  : {
				title         : {
					type: 'inside'
				}
			}

		});

		$('.bio-lightbox').fancybox({
			padding		 : 0,
			autoScale	 : false,
			openEffect	 : 'fade',
			closeEffect	 : 'fade',
			speedIn		 : 200,
			speedOut	 : 200,
		});

		$(".v-video, .y-video").fancybox({
			padding: 0,
			openEffect  : 'none',
			closeEffect : 'none',
			'width'			: 1000,
			// 'height'		: 687,
			helpers : {
				media : {}
			}
		});
	});
})();