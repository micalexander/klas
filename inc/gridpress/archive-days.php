<?php
	$days = $item_value;


?>
	<ul class="days <?php echo 'item-'  . $item_count . ' ' . $unit_span; ?>">
	<?php foreach ($days as $day): ?>
		<li><?php echo date( 'D',strtotime($day['day'])) ?></li>
	<?php endforeach ?>
	</ul>