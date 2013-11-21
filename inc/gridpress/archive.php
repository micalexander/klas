<?php
	$archive = get_sub_field('archive');
	$archive_unit_span = get_sub_field('archive_unit_span');
	$post_type = get_sub_field('post_type');
	$post_per_page = get_sub_field('post_per_page');
	$filter_by =  get_sub_field('filter_by');
	$elements = get_sub_field('elements');

	if ($post_type)
	{
		if ($filter_by == 'last_name')
		{
			require('filter-by-last-name.php');
		}
		elseif ($filter_by == 'month')
		{
			require('filter-by-month.php');
		}
	}
?>

