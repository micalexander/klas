<?php
	$image = get_sub_field('image');
	$image_link = get_sub_field("image_link");
	$image_size = get_sub_field('image_size');
	$target = get_sub_field('new_window') ? ' target="_blank"' : '' ;
	$class = get_sub_field('class') ? vsprintf("%s" , str_replace(' -', ' ', str_replace(',', ' ', str_replace(' ', '-', strtolower(trim(get_sub_field('class'))))))) . ' ' : '' ;

	if ($image):
?>
		<?php echo $open_anchor = $image_link ? '<a href="' . $image_link . '" class="' . $class . ' image-link"' . $target . '>'  : ''; ?>
			<div class="image-frame">
				<img src="<?php echo $image['sizes'][$image_size]; ?>" alt="<?php echo $image['alt']; ?>">
			</div>
		<?php echo $close_anchor = $open_anchor ? '</a>' : ''; ?>
<?php
	endif;
	// end image
?>