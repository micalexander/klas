<?php
	$excerpt = get_sub_field('excerpt');
?>
<div class="excerpt <?php echo 'item-'  . $item_count . ' ' . $unit_span; ?>">
	<p><?php echo $excerpt; ?></p>
</div>