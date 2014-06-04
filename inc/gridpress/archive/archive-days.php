<?php
	$days = $value;
?>
	<ul class="days <?php echo $unit_span[$content]; ?>">
	<?php foreach ($days as $day): ?>
		<li><?php echo date( 'D',strtotime($day['day'])) ?></li>
	<?php endforeach ?>
	</ul>