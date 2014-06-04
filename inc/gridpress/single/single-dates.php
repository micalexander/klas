<?php
	$date_start = date("n/j/y", strtotime(get_sub_field('date_start')));
	$date_end = date("n/j/y", strtotime(get_sub_field('date_end')));
	$time_start = date("g:iA", strtotime(get_sub_field('time_start')));
	$time_end = date("g:iA", strtotime(get_sub_field('time_end')));
?>
<div class="dates <?php echo $unit_span[$content]; ?>">
	<span class="dates__heading">Dates: </span>
	<span class="dates__start"><?php echo $date_start; ?></span>
	<span class="dates__seperator"> - </span>
	<span class="dates__end"><?php echo $date_end; ?></span>
</div>