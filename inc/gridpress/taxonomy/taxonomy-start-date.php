	<div class="archive-filter start-date">

		<p>Filter By Month:</p>
		<ul class="filter filter-by-month">
			<?php $i=0; ?>
			<li><a href="/<?php echo $post_type_slug; ?>/" <?php echo empty($month) ?  "class='selected'" : ""; ?>>All</a></li>
			<?php foreach ( $new_months as $m ): ?>
			<li><a href="/<?php echo $post_type_slug; ?>/<?php echo strtolower($m) . '/'; ?>"<?php echo  $month == strtolower($m) ?  'class="selected"' : ""; ?>><?php echo $m; ?></a></li>
			<?php $i++; ?>
			<?php endforeach; ?>
		</ul>
	</div>