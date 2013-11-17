<?php
	$image = get_sub_field('image');
	$image_link = get_sub_field("image_link");
	$target = get_sub_field('new_window') ? 'target="_blank"' : '' ;

	if ($image):
?>
		<a class=" img-link <?php echo 'item-' . $item_count; ?>" <?php echo $target; ?> href="<?php echo $image_link; ?>" >
			<div class="image-frame">
				<img src="<?php echo $image['url']; ?>" alt="">
			</div>
		</a>
<?php
	endif;
	// end image
?>