<?php

	$dates = $value;
	$date_start = date("n/j/y", strtotime($value['date_start']));
	$date_end = date("n/j/y", strtotime($value['date_end']));
	$time_start = date("g:iA", strtotime($value['time_start']));
	$time_end = date("g:iA", strtotime($value['time_end']));
?>
<div class="dates <?php echo 'item-'  . $item_count . ' ' . $unit_span; ?>">
	<span class="dates__heading">Dates: </span>
	<span class="dates__start"><?php echo $date_start; ?></span>
	<span class="dates__seperator"> - </span>
	<span class="dates__end"><?php echo $date_end; ?></span>
</div>