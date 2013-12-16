<?php
	$post_by_months = array();
	$post_by_years = array();

	// Declare some helper vars
	// $previous_year = $year = 0;
	// $previous_month = $month = 0;

	$args = array(
				'posts_per_page' => $archive_post_per_page,
				'post_type' => $post_type,
				'offset' => $archive_offset,
				'orderby' => 'date',
				'order' => 'DSC'
	);

	// Get the posts
	$query = new WP_Query($args);
	$post_by_terms = array();

?>
<?php if ($query->have_posts()) : while ($query->have_posts()): $query->the_post();?>
<?php
	// Setup the post variables
	// setup_postdata($post);



	$term_objects = wp_get_post_terms( $post->ID, $taxonomies );

	foreach ($term_objects as $term_object)
	{
		$post_by_terms[$term_object->slug][] = array( 'title' => $post->post_title , 'permalink' => get_permalink($post->ID));
	}

endwhile; endif;
?>



		<ul class="accordion">
<?php foreach ($post_by_terms as $term => $entries): ?>
			<li  class="archive-filter accordion-published-month accordion-key" >
			<h3 class="accordion-heading"><?php echo $term; ?> (<?php echo count($entries); ?>)</h3>
			<div class="accordion-section">
				<?php $i=0; ?>
				<?php foreach ($entries as $entry): ?>
				<a href="<?php echo $entry['permalink']; ?>"><?php echo $entry['title']; ?></a><br>
				<?php $i++; ?>
				<?php if ($i == 5): ?>
				<div class="more"><a href="<?php //echo get_post_type_archive_link( $post_type ) . $years . '/' . date('m', strtotime($months)); ?> ">more</a></div>
					<?php break; ?>
				<?php endif ?>
				<?php endforeach ?>
			</div>
			</li>
<?php endforeach; wp_reset_query(); wp_reset_postdata(); ?>
</ul>