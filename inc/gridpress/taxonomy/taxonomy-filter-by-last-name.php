<?php

	if (!empty($letter)) {
		$args = array(
					'posts_per_page' => -1,
					'post_type' => $post_type,
					'order' => 'DESC',
					'meta_key' => '%last_name',
					'meta_query' => array(
						array(
							'key' => '%last_name',
							'value' => array( $letter, chr(ord($letter)+1) ),
							'orderby' => 'meta_value',
							'compare' => 'BETWEEN',
							'order' => 'ASC'
						),
						array(
							'key' => '%last_name',
							'value' => chr(ord($letter)+1),
							'orderby' => 'meta_value',
							'compare' => '!='
						)
					),
					'tax_query' => array(
										array(
											'taxonomy' => $taxonomy,
											'field' => 'slug',
											'terms' => $term,
										)
					)
			    );

	}
	else
	{

		$args = array(
					'posts_per_page' => $taxonomy_post_per_page,
					'post_type' => $post_type,
					'offset' => $taxonomy_offset,
					'orderby' => 'date',
					'order' => 'DSC',
					'tax_query' => array(
										array(
											'taxonomy' => $taxonomy,
											'field' => 'slug',
											'terms' => $term,
										)
					)
		);
	}
	add_filter( 'get_meta_sql', 'filter_meta_query' );
	$query = new WP_Query($args);
	remove_filter( 'get_meta_sql', 'filter_meta_query' );

	$taxonomy_unit_count	= $taxonomy_unit_span_count_start;
	$items 				= array();
	$element_array 		= array();
	$post_groups		= array();

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

			while( has_sub_field('single_grid', $post->ID) )
			{
				$unit_count++;
				$unit_size = get_sub_field('unit_span');

				if ( get_sub_field('unit') )
				{
					while( has_sub_field('unit') )
					{
						$sub_unit_count++;

						while( has_sub_field('nested_unit') )
						{

							$item_count++;

							if ( get_row_layout() == 'dates' && in_array('dates', $element_array) )
							{

								$items['dates']['date_start'] 	= get_sub_field('date_start');
								$items['dates']['date_end'] 	= get_sub_field('date_end');
							}
							elseif ( get_row_layout() == 'days' && in_array('days', $element_array) )
							{
								$items['days'] = get_sub_field('days');
							}
							elseif ( get_row_layout() == 'email' && in_array('email', $element_array) )
							{
								$items['email'] = get_sub_field('email');
							}
							elseif ( get_row_layout() == 'excerpt' && in_array('excerpt', $element_array) )
							{
								$items['excerpt'] = get_sub_field('excerpt');
							}
							elseif ( get_row_layout() == 'full_name' && in_array('full_name', $element_array) )
							{
								$items['full_name']['first_name'] = get_sub_field('first_name');
								$items['full_name']['last_name'] = get_sub_field('last_name');
							}
							elseif ( get_row_layout() == 'main_image' && in_array('main_image', $element_array) )
							{
								$items['main_image'] = get_sub_field('image');
							}
							elseif ( get_row_layout() == 'vimeo' && in_array('vimeo', $element_array) )
							{
								$items['vimeo'] = get_sub_field('vimeo');
							}
							elseif ( get_row_layout() == 'youtube' && in_array('youtube', $element_array) )
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

		$post_groups[] = array($post, $ordered + $items);

	endwhile;

	foreach ($post_groups as $post):

	?>
		<div class="no-margin-unit media-box<?php echo $has_image = $post[1]['main_image'] ? ' has-image' : ''; ?><?php echo ' no-margin-' . $taxonomy_unit_span; ?> <?php echo $clear = ($taxonomy_unit_count % $taxonomy_unit_span_count_start) ? ' ' : 'clearleft'; ?>">
	<?php
			require('taxonomy-elements.php');
	?>

		</div>
	<?php $taxonomy_unit_count++; endforeach; ?>
	<?php else: ?>
		<p class="taxonomy--empty">No <?php echo $post_type; ?> entries beginning with the letter "<?php echo $letter; ?>"</p>
	<?php endif; ?>
	<?php

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
    <nav role="navigation" class="taxonomy--taxonomy-posts-nav clearfix">
        <?php echo paginate_links( $args );?>
    </nav>

