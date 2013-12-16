<?php
	$args = array(
				'posts_per_page' => $archive_post_per_page,
				'post_type' => $post_type,
				'offset' => $archive_offset,
				'orderby' => 'date',
				'order' => 'DSC'
	);

	$query = new WP_Query($args);

	$archive_unit_count	= $archive_unit_span_count_start;
	$items 				= array();
	$element_array 		= array();
	$post_by_terms 	= array();

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


							if (get_row_layout() == 'dates' && in_array('days', $element_array))
							{

								$items['dates']['date_start'] 	= get_sub_field('date_start');
								$items['dates']['date_end'] 	= get_sub_field('date_end');
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


		$ordered = array();
		foreach($element_array as $key) {
			if(array_key_exists($key,$items)) {
				$ordered[$key] = $items[$key];
				unset($items[$key]);
			}
		}

		$term_objects = wp_get_post_terms( $post->ID, $taxonomies );

		foreach ($term_objects as $term_object)
		{
			$post_by_terms[$term_object->slug][]		= array($post, $ordered + $items);

		}

	endwhile;

	$term_display_group = array();
	$term_display_group_count = 0;

	foreach ($post_by_terms as $term_name => $term_groups):
		$term_count = 0;

		foreach ($term_groups as $post):

		if (!in_array($term_name, $term_display_group))
		{
			$term_display_group[] = $term_name;
			$term_display_group_count++;
		}

	?>
		<div class="no-margin-unit media-box<?php echo $has_image = $post[1]['main_image'] ? ' has-image' : ''; ?><?php echo ' no-margin-' . $archive_unit_span; ?> <?php echo $clear = ($archive_unit_count % $archive_unit_span_count_start) ? ' ' : 'clearleft'; ?>">
			<div class="term-heading-wrapper <?php echo $term_display = $term_display_group_count % 2 == 0 ? 'odd' : 'even';?>">

				<h2 class=" <?php echo $term_heading = !$term_count++ ? 'term-heading' : 'subsequent term-heading';?>"><?php echo $term_name; ?></h2>
			</div>
	<?php
			require('archive-elements.php');
	?>
		</div>
	<?php $term_heading_count++; $term_count++; $archive_unit_count++; endforeach; ?>
	<?php endforeach; ?>
	<?php else: ?>
		<p class="archive--empty">No categorized <?php echo $post_type_slug; ?> entries</p>
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

