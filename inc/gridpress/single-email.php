<?php
	$email = get_sub_field('email');
?>
<div class="email <?php echo 'item-'  . $item_count . ' ' . $unit_span[$content]; ?>">
	<span class="email__address"><?php echo $email; ?></span>
</div>