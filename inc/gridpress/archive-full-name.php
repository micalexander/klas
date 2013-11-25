<?php
	$full_name = $value;
	$first_name = $value['first_name'];
	$last_name = $value['last_name'];
?>
<div class="full-name <?php echo 'item-'  . $item_count . ' ' . $unit_span; ?>">
	<span class="full-name__first"><?php echo $first_name; ?></span>
	<span class="full-name__last"><?php echo $last_name; ?></span>
</div>