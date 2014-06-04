var playNice = jQuery.noConflict();
playNice(document).ready(function() {
	playNice('.acf-flexible-content .layout').attr('data-toggle', 'closed').children('table').hide();
});