<?php

	$taxonomy_unit_span = get_sub_field('taxonomy_unit_span');
	$taxonomy_post_per_page = get_sub_field('post_per_page');
	$filter_by =  get_sub_field('filter_by');
	$elements = get_sub_field('elements');
	switch ($taxonomy_unit_span)
	{
		case 'one-of-one':
			$taxonomy_unit_span_count_start = 1;
			break;
		case 'one-of-two':
			$taxonomy_unit_span_count_start = 2;
			break;
		case 'one-of-three':
			$taxonomy_unit_span_count_start = 3;
			break;
		case 'one-of-four':
			$taxonomy_unit_span_count_start = 4;
			break;
		case 'one-of-five':
			$taxonomy_unit_span_count_start = 5;
			break;
	}

	foreach (get_post_types() as $key => $type)
	{
		if (get_object_taxonomies( $type )[0] == $taxonomy)
		{
			$post_type = $type;
		}

	}

	if ($post_type)
	{
		if ($filter_by == 'last_name')
		{
			require('taxonomy-filter-by-last-name.php');
		}
		elseif ($filter_by == 'start_date')
		{
			require('taxonomy-filter-by-start-date.php');
		}
		elseif ($filter_by == 'published_date')
		{
			require('taxonomy-filter-by-publish-date.php');
		}
	}

	if (!$taxonomy_page)
	{
    	$taxonomy_page = $paged;
    	if ( $taxonomy_page != 0 )
    	{
    		$taxonomy_page--;
    	}

    	$taxonomy_offset = $taxonomy_post_per_page * $taxonomy_page;
	}


?>

