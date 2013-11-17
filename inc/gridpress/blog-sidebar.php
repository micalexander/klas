<h2>Archives</h2>
<?php
	// Declare some helper vars
	// $previous_year = $year = 0;
	// $previous_month = $month = 0;
	$ul_open = false;

	// Get the posts
	$myposts = get_posts('numberposts=-1&orderby=post_date&order=DESC');
	$post_by_months = array();
	$post_by_years = array();
?>
<?php foreach($myposts as $post) : ?>
<?php
	// Setup the post variables
	setup_postdata($post);

	$year = mysql2date('Y', $post->post_date);
	$month = mysql2date('F', $post->post_date);
	$day = mysql2date('j', $post->post_date);

	$post_by_months[$year][$month][] = array( 'title' => $post->post_title , 'permalink' => get_permalink($post->ID));
?>
<?php endforeach; ?>
<?php  ?>
<?php foreach ($post_by_months as $years => $month_arrays): ?>
	<h2 class="blog-accordion-one-key"><?php echo $years; ?> ></h2>
	<div class="blog-accordion-one">
		<?php foreach ($month_arrays as $months => $entries): ?>
		<h3 class="blog-accordion-two-key"><?php echo $months; ?> (<?php echo count($entries)  ?>)</h3>
		<div class="blog-accordion-two">
			<ul>
				<?php foreach ($entries as $entry): ?>
				<li><a href="<?php echo $entry['permalink']; ?>"><?php echo $entry['title']; ?></a></li>
				<?php endforeach ?>
			</ul>
		</div>
	<?php endforeach ?>
	</div>
<?php endforeach ?>







