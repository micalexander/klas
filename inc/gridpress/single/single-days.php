<?php
	$days = get_sub_field('days');
?>
	<ul class="days <?php echo 'item-'  . $item_count . ' ' . $unit_span[$content]; ?>">
	<?php foreach ($days as $day): ?>
		<li><?php echo date( 'D',strtotime($day['day'])) ?></li>
	<?php endforeach ?>
	</ul>