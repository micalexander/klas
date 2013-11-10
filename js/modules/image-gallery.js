function replaceImage() {
	$('.image').each(function() {
		var data_target = $(this).attr('data-target');
		var src = $(this).attr('src');
		$(this).attr( 'src', data_target );
		$(this).attr( 'data-target', src );
	});
};

function putBackImage() {
	$('.image').each(function() {
		var data_target = $(this).attr('data-target');
		var src = $(this).attr('src');
		$(this).attr( 'data-target', src );
		$(this).attr( 'src', data_target );
	});
};
