<?php
	$image = get_sub_field('image');
	$class = get_sub_field('class') ? vsprintf("%s" , str_replace(' -', ' ', str_replace(',', ' ', str_replace(' ', '-', strtolower(trim(get_sub_field('class'))))))) . ' ' : '' ;
?>
	<div class="main-image <?php echo $class; ?><?php echo $unit_span; ?>">
		<img src="<?php echo $image['sizes']['main-image']; ?>" alt="<?php echo $image['alt']; ?>">
	</div>
<?php // end main image ?>
