<?php

foreach ($items_sorted as $item => $item_value)
{

	if ($item_value && $item == 'byline')
	{
		require('archive-byline.php');

	}
	if($item_value && $item == 'dates')
	{
		require('archive-dates.php');

	}
	if($item_value && $item == 'days')
	{
		require('archive-days.php');

	}
	if($item_value && $item == 'email')
	{
		require('archive-email.php');

	}
	if($item_value && $item == 'excerpt')
	{
		require('archive-excerpt.php');

	}
	if($item_value && $item == 'full_name')
	{
		require('archive-full-name.php');

	}
	if($item_value && $item == 'relationship')
	{
		// require('archive-relationship.php');

	}
	if($item_value && $item == 'main_image')
	{
		require('archive-main-image.php');

	}
	if($item_value && $item == 'vimeo')
	{
		// require('archive-vimeo.php');

	}
	if($item_value && $item == 'youtube')
	{
		// require('archive-youtube.php');

	}

}


?>