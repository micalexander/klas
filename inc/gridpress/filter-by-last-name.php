
	<div class="archive--filter">
		<?php
		$post_type_slug = get_post_type_object( get_post_type() )->rewrite['slug'];
		$letters = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
		$letter = $wp_query->query_vars['letter'];
		?>
		<p>Filter By Last Name:</p>
		<ul class="filter archive--filter-by-letter">
			<li><a href="/<?php echo $post_type_slug; ?>/" <?php echo empty($letter) ?  "class='selected'" : ""; ?>>All</a></li>
			<?php foreach ( $letters as $l ): ?>
			<li><a href="/<?php echo $post_type_slug; ?>/<?php echo $l; ?>/" <?php echo $letter == $l ?  "class='selected'" : ""; ?>><?php echo $l; ?></a></li>
			<?php endforeach; ?>
		</ul>
	</div>
<?php
	add_filter( 'get_meta_sql', 'filter_meta_query' );
	if (!empty($letter)) {
		$args = array(
					'posts_per_page' => -1,
					'post_type' => $post_type,
					// 'tax_query' => array(
					//     array(
					//       'taxonomy' => '..._type',
					//     )
					// ),
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
					'order' => 'DESC'
			    );

	} else {
		$archive_page = $paged;
		if ( $archive_page != 0 ) {
			$archive_page--;
		}
		$archive_post_per_page = 10;
		$archive_offset = $archive_post_per_page * $archive_page;

		$args = array(
						'posts_per_page' => $archive_post_per_page,
						'post_type' => $post_type,
						'offset' => $archive_offset
						);
	}
	$query = new WP_Query($args);
	remove_filter( 'get_meta_sql', 'filter_meta_query' );
	$archive_unit_count	= $archive_unit_span_count_start;
	$items 				= array();
	$element_array 		= array();
	$post_groups	= array();
	$element_count 		= 0;

	if ($query->have_posts()) : while ($query->have_posts()): $query->the_post();

		$items_sorted = array();

		// set to false if previously set
		if ($items['main_image'])
		{
			$items['main_image'] = false;
		}
		if ($items['dates'])
		{
			$items['dates'] = false;
		}
		if ($items['days'])
		{
			$items['days'] = false;
		}
		if ($items['full_name'])
		{
			$items['full_name'] = false;
		}
		if ($items['email'])
		{
			$items['email'] = false;
		}
		if ($items['excerpt'])
		{
			$items['excerpt'] = false;
		}
		if ($items['youtube'])
		{
			$items['youtube'] = false;
		}
		if ($items['vimeo'])
		{
			$items['vimeo'] = false;
		}
		if ($items['byline'])
		{
			$items['byline'] = false;
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

							foreach ($elements as $element)
							{
								$unit_span[$element['element']] = $element['unit-span'];


								// add elements to element_array if they are not already added
								if (!in_array($element['element'], $element_array))
								{
									$element_array[] = $element['element'];
								}

								if (get_row_layout() == 'dates' && in_array('dates', $element_array))
								{

									$items['dates']['date_start'] 	= get_sub_field('date_start');
									$items['dates']['date_end'] 	= get_sub_field('date_end');
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
									$items['full_name']['first_name'] = get_sub_field('first_name');
									$items['full_name']['last_name'] = get_sub_field('last_name');
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
								elseif (in_array('byline', $element_array)) {
									$items['byline'] = get_sub_field('byline');
								}
							}
						}
					}
				}
			}
		}
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
		$post_groups[] = array($post, $items_sorted);

	endwhile;
	foreach ($post_groups as $post):
	?>
	<div class="no-margin-unit media-box<?php echo $has_image = $post[1]['main_image'] ? ' has-image' : ''; ?><?php echo ' no-margin-' . $archive_unit_span; ?> <?php echo $clear = ($archive_unit_count % $archive_unit_span_count_start) ? ' ' : 'clearleft'; ?>">
		<?php require('archive-elements.php'); ?>

	</div>
	<?php $archive_unit_count++; endforeach; ?>
	<?php else: ?>
		<p class="archive--empty">No <?php echo $post_type; ?> entries beginning with the letter "<?php echo $letter; ?>"</p>
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

