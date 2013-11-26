<?php

	$archive_unit_span = get_sub_field('archive_unit_span');
	$archive_post_type = get_sub_field('post_type');
	$archive_post_per_page = get_sub_field('post_per_page');
	$filter_by =  get_sub_field('filter_by');
	$elements = get_sub_field('elements');
	switch ($archive_unit_span) {
		case 'one-of-one':
			$archive_unit_span_count_start = 1;
			break;
		case 'one-of-two':
			$archive_unit_span_count_start = 2;
			break;
		case 'one-of-three':
			$archive_unit_span_count_start = 3;
			break;
		case 'one-of-four':
			$archive_unit_span_count_start = 4;
			break;
		case 'one-of-five':
			$archive_unit_span_count_start = 5;
			break;
	}

	if ($post_type)
	{
		if ($filter_by == 'last_name')
		{
			require('filter-by-last-name.php');
		}
		elseif ($filter_by == 'start_date')
		{
			require('filter-by-start-date.php');
		}
	}
?>

