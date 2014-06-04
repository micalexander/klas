<?php
	$first_name = $value['first_name'];
	$last_name = $value['last_name'];
?>
<div class="full-name <?php echo $unit_span[$content]; ?>">
	<span class="full-name__first"><?php echo $first_name; ?></span>
	<span class="full-name__last"><?php echo $last_name; ?></span>
</div>