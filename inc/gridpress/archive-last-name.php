<div class="archive-filter last-name">
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