<?php
	if (!empty($query_vars_month))
	{
		$args = array(
			'posts_per_page' 	=> -1,
			'post_type' 		=> $post_type,
			'meta_key' 			=> 'single%date_start',
			'orderby' 			=> 'meta_value',
			'order' 			=> 'ASC',
			'meta_query' 		=> array(
				array(
					'key' 		=> 'single%date_start',
					'value' 	=> array( $query_sched_string, $query_sched_string+30 ),
					'compare' 	=> 'BETWEEN',
					'type' 		=> 'DATE',
				),
				array(
					'key' 		=> 'single%date_start',
					'value' 	=> date('Ymd'),
					'compare' 	=> '>='
				)
			),
    	);
    }
    else
    {
    	if (!$archive_page)
    	{
	    	$archive_page = $paged;
	    	if ( $archive_page != 0 )
	    	{
	    		$archive_page--;
	    	}

	    	$archive_offset = $archive_post_per_page * $archive_page;
    	}

		$args = array(
			'posts_per_page' 	=> $archive_post_per_page,
			'post_type' 		=> $post_type,
			'offset' 			=> $archive_offset,
			'orderby' 			=> 'meta_value',
			'meta_key' 			=> 'single%date_start',
			'meta_query' 		=> array(
				array(
					'key' 		=> 'single%date_start',
					'value' 	=> date('Ymd'),
					'compare' 	=> '>=',
					'type'		=> 'Date',
				)
			)
		);
	}

	add_filter( 'get_meta_sql', 'filter_meta_query' );
	$query = new WP_Query($args);
	remove_filter( 'get_meta_sql', 'filter_meta_query' );

	$archive_unit_count	= $archive_unit_span_count_start;
	$items 				= array();
	$element_array 		= array();
	$post_by_months 	= array();

	if ($query->have_posts()) : while ($query->have_posts()): $query->the_post();


		foreach ($elements as $element)
		{

			if ($items[$element['element']]) {
				$items[$element['element']] = false;
			}
			$unit_span[$element['element']] = $element['unit-span'];
			$date_check = $element['element'];

			// add elements to element_array if they are not already added
			if (!in_array($element['element'], $element_array))
			{
				$element_array[] = $element['element'];
			}
		}

		if (get_field('single_grid', $post->ID))
		{

			while(has_sub_field('single_grid', $post->ID))
			{
				$unit_count++;
				$unit_size = get_sub_field('unit_span');

				if (get_sub_field('unit'))
				{
					while(has_sub_field('unit'))
					{
						$sub_unit_count++;

						while(has_sub_field('nested_unit'))
						{
							$item_count++;


							if (get_row_layout() == 'dates')
							{

								$items['dates']['date_start'] 	= get_sub_field('date_start');
								$items['dates']['date_end'] 	= get_sub_field('date_end');
								$date_start_parsed 				= date_parse(get_sub_field('date_end'));
							}
							elseif (get_row_layout() == 'days' && in_array('days', $element_array))
							{
								$items['days'] = get_sub_field('days');
							}
							elseif (get_row_layout() == 'email' && in_array('email', $element_array))
							{
								$items['email'] = get_sub_field('email');
							}
							elseif (get_row_layout() == 'excerpt' && in_array('excerpt', $element_array))
							{
								$items['excerpt'] = get_sub_field('excerpt');
							}
							elseif (get_row_layout() == 'full_name' && in_array('full_name', $element_array))
							{
								$items['full_name']['first_name'] = get_sub_field('first_name');
								$items['full_name']['last_name'] = get_sub_field('last_name');
							}
							elseif (get_row_layout() == 'main_image' && in_array('main_image', $element_array))
							{
								$items['main_image'] = get_sub_field('image');
							}
							elseif (get_row_layout() == 'vimeo' && in_array('vimeo', $element_array))
							{
								$items['vimeo'] = get_sub_field('vimeo');
							}
							elseif (get_row_layout() == 'youtube' && in_array('youtube', $element_array))
							{
								$items['youtube'] = get_sub_field('youtube');
							}
							if ( in_array('byline', $element_array) )
							{
								$items['byline'] = true;
							}
							if ( in_array('title', $element_array) )
							{
								$items['title'] = true;
							}
						}
					}
				}
			}
		}

		$month_index = date("F", mktime(0, 0, 0, $date_start_parsed['month'], 10));

		$ordered = array();
		foreach($element_array as $key) {
			if(array_key_exists($key,$items)) {
				$ordered[$key] = $items[$key];
				unset($items[$key]);
			}
		}

		$post_by_months[$month_index][]		= array($post, $ordered + $items);

	endwhile;

	$month_display_group = array();
	$month_display_group_count = 0;

	foreach ($post_by_months as $month_name => $month_groups):
		$month_count = 0;

		foreach ($month_groups as $post):

		if (!in_array($month_name, $month_display_group))
		{
			$month_display_group[] = $month_name;
			$month_display_group_count++;
		}

	?>
		<div class="no-margin-unit media-box<?php echo $has_image = $post[1]['main_image'] ? ' has-image' : ''; ?><?php echo ' no-margin-' . $archive_unit_span; ?> <?php echo $clear = ($archive_unit_count % $archive_unit_span_count_start) ? ' ' : 'clearleft'; ?>">
			<div class="month-heading-wrapper <?php echo $month_display = $month_display_group_count % 2 == 0 ? 'odd' : 'even';?>">

				<h2 class=" <?php echo $month_heading = !$month_count++ ? 'month-heading' : 'subsequent month-heading';?>"><?php echo $month_name; ?></h2>
			</div>
	<?php
			require('archive-elements.php');
	?>
		</div>
	<?php $month_heading_count++; $month_count++; $archive_unit_count++; endforeach; ?>
	<?php endforeach; ?>
	<?php elseif(empty($query_vars_month)): ?>
		<p class="archive--empty">No <?php echo $post_type_slug; ?> entries found</p>
	<?php else: ?>
		<p class="archive--empty">No <?php echo $post_type_slug; ?> entries in the month of <?php echo ucfirst(date('F', strtotime($query_vars_month))); ?></p>
	<?php endif; ?>
	<?php
		wp_reset_postdata();
		$total_pages = $query->max_num_pages;

        wp_reset_postdata();
        if ($total_pages > 1)
        {

			$current_page = max(1, get_query_var('paged'));

	        $args = array(
						'base' 		=> get_pagenum_link(1) . '%_%',
						'format' 	=> 'page/%#%',
						'current' 	=> $current_page,
						'total' 	=> $total_pages,

			);
        }
	?>
    <nav role="navigation" class="archive--archive-posts-nav clearfix">
        <?php echo paginate_links( $args );?>
    </nav>

