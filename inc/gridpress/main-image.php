<?php
	$image = get_sub_field('image');
?>
	<div class="main-image <?php echo 'item-'  . $item_count . ' ' . $unit_span; ?>">
		<img src="<?php echo $image['sizes']['main-image']; ?>" alt="<?php echo $image['alt']; ?>">
	</div>
<?php // end main image ?>
