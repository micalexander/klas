
	<div class="archive--filter">
		<?php
		$post_type_slug = get_post_type_object( get_post_type() )->rewrite['slug'];
		$letters = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
		$letter = $wp_query->query_vars['letter'];
		?>
		<p>Filter By Last Name:</p>
		<ul class="farchive--ilter-by-letter">
			<li><a href="/<?php echo $post_type_slug; ?>/" <?php echo empty($letter) ?  "class='selected'" : ""; ?>>All</a></li>
			<?php foreach ( $letters as $l ): ?>
			<li><a href="/<?php echo $post_type_slug; ?>/<?php echo $l; ?>/" <?php echo $letter == $l ?  "class='selected'" : ""; ?>><?php echo $l; ?></a></li>
			<?php endforeach; ?>
		</ul>
	</div>
<?php

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
				          'key' => 'post_type_last_name',
				          'value' => array( $letter, chr(ord($letter)+1) ),
				          'orderby' => 'meta_value',
				                'compare' => 'BETWEEN',
				                'order' => 'ASC'
				        ),
				        array(
							'key' => 'post_type_last_name',
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
	$i=0;
	if ($query->have_posts()) : while ($query->have_posts()): $query->the_post();

?>

	<div class="no-margin-unit media-box <?php echo ' no-margin-' . $archive_unit_span; ?>">
	<?php
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
								$unit_span = $element['unit-span'];
								$item = $element['element'];
								require('archive-elements.php');

							}
						}
					}
				}
			}
		}
	?>
	</div>
	<?php $i++; endwhile; ?>
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

