<div class="archive-filter terms">
	<?php
	?>
	<p>Filter By Category:</p>
	<ul class="filter archive--filter-by-letter">
		<li><a href="/<?php echo $post_type_slug; ?>/" <?php echo empty($letter) ?  "class='selected'" : ""; ?>>All</a></li>
		<?php foreach ( $terms as $term ): ?>
		<li><a href="/<?php echo $term->taxonomy; ?>/<?php echo $term->slug; ?>/" <?php echo $letter == $l ?  "class='selected'" : ""; ?>><?php echo ucfirst($term->name); ?></a></li>
		<?php endforeach; ?>
	</ul>
</div>