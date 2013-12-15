<div class="accordion">
	<div class="archive-filter accordion-last-name accordion-key">
		<?php
		$post_type_slug = get_post_type_object( get_post_type() )->rewrite['slug'];
		$letters = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
		$letter = $wp_query->query_vars['letter'];
		?>
		<h2 class="accordion-heading">Last Name</h2>
		<ul class="filter filter-by-letter accordion-section">
			<?php foreach ( $letters as $l ): ?>
			<li><a href="/<?php echo $taxonomy; ?>/<?php echo $term; ?>/<?php echo $l; ?>/" <?php echo $letter == $l ?  "class='selected'" : ""; ?>><?php echo $l; ?></a></li>
			<?php endforeach; ?>
			<li class="show-all"><a href="/<?php echo $taxonomy; ?>/<?php echo $term; ?>/" <?php echo empty($letter) ?  "class='selected'" : ""; ?>>Show All</a></li>
		</ul>
	</div>
</div>