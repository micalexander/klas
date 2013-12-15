	<div class="accordion">
		<div class="archive-filter accordion-start-date accordion-key">

			<h2 class="accordion-heading">Month</h2>
			<ul class="filter filter-by-month accordion-section">
				<?php $i=0; ?>
				<div><a href="/<?php echo $taxonomy; ?>/<?php echo $term; ?>/" <?php echo empty($month) ?  "class='selected'" : ""; ?>><?php echo date('Y');?> - <?php echo date('Y')+1;  ?></a></div>
				<?php foreach ( $new_months as $m ): ?>
				<li class="month"><a href="/<?php echo $taxonomy; ?>/<?php echo $term; ?>/<?php echo strtolower($m) . '/'; ?>"<?php echo  $month == strtolower($m) ?  'class="selected"' : ""; ?>><?php echo $m; ?></a></li>
				<?php $i++; ?>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>