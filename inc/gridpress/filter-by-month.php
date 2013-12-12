<?php
	/**
	 * Get the scheduled year for filter by month
	 *
	 * @param $int_month, the month to check
	 * @return $year variable, the desired year
	 * @author Mic Alexander
	 **/

	function get_sched_year($int_month)
	{
		if ($int_month < date('m'))
		{
			$year = strval(date('Y') +1);
		}
		else
		{
			$year = date('Y');
		}
			return $year;
	}

?>
	<div class="archive--filter">
<?php
		$post_type_slug = get_post_type_object( get_post_type() )->rewrite['slug'];
		$months = array("Jan", "Feb", "March", "April", "May", "June", "July", "Aug", "Sept", "Oct", "Nov", "Dec");
		$last_month = date('m') -1;
		$month_start = array_slice($months, $last_month);
		$month_end = array_slice($months, 0, $last_month);
		$new_months = array_merge($month_start,$month_end);
		$month = $wp_query->query_vars['month'];
		$int_month = ($month == null) ? null : date('m', strtotime($month . "01"));
		$year = get_sched_year($int_month);
		$query_sched_string = $year . $int_month . "01";
?>
		<p>Filter By Month:</p>
		<ul class="filter-by-month clearfix">
			<?php $i=0; ?>
			<li><a href="/<?php echo $post_type_slug; ?>/" <?php echo empty($month) ?  "class='selected'" : ""; ?>>All</a> |&nbsp;</li>
			<?php foreach ( $new_months as $m ): ?>
			<li><a href="/<?php echo $post_type_slug; ?>/<?php echo strtolower($m) . '/'; ?>"<?php echo  $month == strtolower($m) ?  'class="selected"' : ""; ?>><?php echo $m; ?></a><?php echo $pipe = ($i <= 10) ? " |&nbsp;" : ""; ?></li>
			<?php $i++; ?>
			<?php endforeach; ?>
		</ul>
	</div>
	<?php
	$term_slug = $wp_query->query_vars[$taxonomy];
	add_filter( 'get_meta_sql', 'filter_meta_query' );
	if (!empty($month))
	{
		$args = array(
					'posts_per_page' => -1,
					'post_type' => $post_type,
					'orderby' => 'meta_value',
	              	'order' => 'ASC',
					// 'tax_query' => array(
					// 					array(
					// 						'taxonomy' => $taxonomy,
					// 						'field' => 'slug',
					// 						'terms' => $term
					// 					)
					// 				),
					'meta_query' => array(
										array(
											'key' => '%date_start',
											'value' => array( $query_sched_string, $query_sched_string+30 ),
											'compare' => 'BETWEEN',
											'type' => 'DATE',
										),
									    array(
											'key' => '%date_end',
											'value' => chr(ord($query_sched_string)+1),
											'compare' => '!='
									    )
									),
            	);
    }
    else
    {
    	$archive_page = $paged;
    	if ( $archive_page != 0 )
    	{
    		$archive_page--;
    	}
    	$archive_post_per_page = 10;
    	$archive_offset = $archive_post_per_page * $archive_page;

		$args = array(
					'posts_per_page' => $archive_post_per_page,
					'post_type' => $post_type,
					'offset' => $archive_offset,
					'order' => 'ASC',
					'orderby' => 'meta_value',
					'meta_query' => array(
										array(
											'key' => '%date_start',
											'value' => date('Ymd'),
											'compare' => '>=',
										),
									),
				);
	}

	$query = new WP_Query($args);
	remove_filter( 'get_meta_sql', 'filter_meta_query' );


	$i 					= 0;
	$items 				= array();
	$items_sorted 		= array();
	$element_array 		= array();
	$post_by_months 	= array();
	$post_item_sorted 	= array();
	$element_count 		= 0;

	if ($query->have_posts()) : while ($query->have_posts()): $query->the_post();

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
							foreach ($elements as $element)
							{

								$unit_span = $element['unit-span'];
								$date_check = $element['element'];
								if (!in_array($element['element'], $element_array))
								{

								$element_array[] = $element['element'];
								}

								if (get_row_layout() == 'dates') {

									$items['dates']['date_start'] = get_sub_field('date_start');
									$items['dates']['date_end'] = get_sub_field('date_end');
									$date_start_parsed = date_parse(get_sub_field('date_end'));
								}
								elseif (get_row_layout() == 'days' && in_array('days', $element_array))
								{
									$items['days'] = get_sub_field('days');
								}
								elseif (get_row_layout() == 'email' && in_array('email', $element_array)) {
									$items['email'] = get_sub_field('email');
								}
								elseif (get_row_layout() == 'excerpt' && in_array('excerpt', $element_array)) {
									$items['excerpt'] = get_sub_field('excerpt');
								}
								elseif (get_row_layout() == 'full_name' && in_array('full_name', $element_array)) {
									$items['full_name'] = get_sub_field('full_name');
								}
								elseif (get_row_layout() == 'main_image' && in_array('main_image', $element_array)) {
									$items['main_image'] = get_sub_field('image');
								}
								elseif (get_row_layout() == 'vimeo' && in_array('vimeo', $element_array)) {
									$items['vimeo'] = get_sub_field('vimeo');
								}
								elseif (get_row_layout() == 'youtube' && in_array('youtube', $element_array)) {
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
		}

		$month_index = date("F", mktime(0, 0, 0, $date_start_parsed['month'], 10));




		while( count( $items_sorted) != count($items) )
		{
			foreach ( $items as $item => $value )
			{

				if ( $element_array[$element_count] == $item )
				{
					$items_sorted[$item] = $value;
					$element_count++;

				}
			}
		}

		$element_count = 0;
		$post_by_months[$month_index][]		= array($post, $items_sorted);


		// echo "<pre>" ; var_dump($items_sorted) ; echo "</pre><br>";
	endwhile;

	foreach ($post_by_months as $month_name => $month_groups):
	?>
	<div>
	<?php
		$post_item_count = 0;
		foreach ($month_groups as $group):

		?>
		<div class="no-margin-unit media-box <?php echo ' no-margin-' . $archive_unit_span; ?>">
		<?php




			echo "<pre>" ; var_dump($group[0]) ; echo "</pre><br>";


		$post_item_count++;

		?>

		</div>
		<?php endforeach; ?>
	</div>
	<?php endforeach; ?>
	<?php $i++; ?>
	<?php else: ?>
	<p class="archive--empty">No <?php echo $post_type; ?> entries beginning with the month "<?php echo $letter; ?>"</p>
	<?php endif; ?>
	<?php
		wp_reset_postdata();
		$total_pages = $query->max_num_pages;

        wp_reset_postdata();
        if ($total_pages > 1)
        {

          $current_page = max(1, get_query_var('paged'));

	        $args = array(
						'base' => get_pagenum_link(1) . '%_%',
						'format' => 'page/%#%',
						'current' => $current_page,
						'total' => $total_pages,

		            );
        }
	?>
    <nav role="navigation" class="archive--archive-posts-nav clearfix">
        <?php echo paginate_links( $args );?>
    </nav>

