<?php
	$image = get_sub_field('image');
	$image_link = get_sub_field("image_link");
	$target = get_sub_field('new_window') ? ' target="_blank"' : '' ;

	if ($image):
?>
		<?php echo $open_anchor = $image_link ? '<a href="' . $image_link . '" class="item-'  . $item_count . ' image-link"' . $target . '>'  : ''; ?>
			<div class="image-frame">
				<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
			</div>
		<?php echo $close_anchor = $open_anchor ? '</a>' : ''; ?>
<?php
	endif;
	// end image
?>