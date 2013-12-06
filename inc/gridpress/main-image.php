<?php
	$image = get_sub_field('image');
	$class = get_sub_field('class') ? str_replace(' ', '-', strtolower(rtrim(get_sub_field('class')))) . ' ' : '' ;
?>
	<div class="main-image <?php echo $class; ?><?php echo 'item-'  . $item_count . ' ' . $unit_span; ?>">
		<img src="<?php echo $image['sizes']['main-image']; ?>" alt="<?php echo $image['alt']; ?>">
	</div>
<?php // end main image ?>
