<?php
		$image = get_sub_field('image');
		$image_link = get_sub_field('image_link');
		$image_hover = get_sub_field("image_hover");
		$target = get_sub_field('new_window') ? 'target="_blank"' : '' ;

	if ($image):
?>
<a class=" img-link <?php echo 'item-' . $item_count; ?>" <?php echo $target; ?>  href="<?php echo $image_link; ?>" >
	<div class="image-frame-hover">
		<img src="<?php echo $image['url']; ?>" alt="">
		<img src="<?php echo $image_hover['url']; ?>" alt="">
	</div>
</a>
<?php
	endif;
	// end image with hover
?>