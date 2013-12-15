<?php

foreach ($post[1] as $content => $value) {

	if ($content == 'byline')
	{
		require('taxonomy-byline.php');

	}
	if($content == 'dates')
	{
		require('taxonomy-dates.php');

	}
	if($content == 'days')
	{
		require('taxonomy-days.php');

	}
	if($content == 'email')
	{
		require('taxonomy-email.php');

	}
	if($content == 'excerpt')
	{
		require('taxonomy-excerpt.php');

	}
	if($content == 'full_name')
	{
		require('taxonomy-full-name.php');

	}
	if($content == 'relationship')
	{
		// require('taxonomy-relationship.php');

	}
	if($content == 'main_image')
	{
		require('taxonomy-main-image.php');

	}
	if($content == 'title')
	{
		require('taxonomy-title.php');

	}
	if($content == 'vimeo')
	{
		// require('taxonomy-vimeo.php');

	}
	if($content == 'youtube')
	{
		// require('taxonomy-youtube.php');

	}
}



?>