<?php
	$post_by_months = array();
	$post_by_years = array();

	// Declare some helper vars
	// $previous_year = $year = 0;
	// $previous_month = $month = 0;

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

	// Get the posts
	$query = new WP_Query($args);
	$post_by_months = array();
	$post_by_years = array();

?>

<?php if ($query->have_posts()) : while ($query->have_posts()): $query->the_post();?>
<?php
	// Setup the post variables
	// setup_postdata($post);

	$year = mysql2date('Y', $post->post_date);
	$month = mysql2date('F', $post->post_date);
	$day = mysql2date('j', $post->post_date);

	$post_by_months[$year][$month][] = array( 'title' => $post->post_title , 'permalink' => get_permalink($post->ID));

endwhile; endif;
?>

<ul class="accordion">
<?php foreach ($post_by_months as $years => $month_arrays): ?>
	<li class="archive-filter accordion-published-year accordion-key">

	<h2 class="accordion-heading"><?php echo $years; ?></h2>
	<div class="filter filter-by-month accordion-section">
		<?php foreach ($month_arrays as $months => $entries): ?>
		<ul class="accordion">
			<li  class="archive-filter accordion-published-month accordion-key" >
			<h3 class="accordion-heading"><?php echo $months; ?> (<?php echo count($entries); ?>)</h3>
			<div class="accordion-section">
				<?php $i=0; ?>
				<?php foreach ($entries as $entry): ?>
				<a href="<?php echo $entry['permalink']; ?>"><?php echo $entry['title']; ?></a>
				<?php $i++; ?>
				<?php if ($i == 1): ?>
				<div class="more"><a href="<?php echo get_post_type_archive_link( $post_type ) . $years . '/' . date('m', strtotime($months)); ?> ">more</a></div>
					<?php break; ?>
				<?php endif ?>
				<?php endforeach ?>
			</div>
			</li>
		</ul>
		<?php endforeach ?>
	</div>
	</li>
<?php endforeach; wp_reset_query(); wp_reset_postdata(); ?>
</ul>