<?php

foreach ($post[1] as $content => $value) {

	if ($content == 'byline')
	{
		require('archive-byline.php');

	}
	if($content == 'dates')
	{
		require('archive-dates.php');

	}
	if($content == 'days')
	{
		require('archive-days.php');

	}
	if($content == 'email')
	{
		require('archive-email.php');

	}
	if($content == 'excerpt')
	{
		require('archive-excerpt.php');

	}
	if($content == 'full_name')
	{
		require('archive-full-name.php');

	}
	if($content == 'relationship')
	{
		// require('archive-relationship.php');

	}
	if($content == 'main_image')
	{
		require('archive-main-image.php');

	}
	if($content == 'vimeo')
	{
		// require('archive-vimeo.php');

	}
	if($content == 'youtube')
	{
		// require('archive-youtube.php');

	}
}



?>