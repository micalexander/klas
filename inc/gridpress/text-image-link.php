<?php
	$image = get_sub_field('image');
	$text = get_sub_field("text");
	$type = get_sub_field("text_type");
	$class = get_sub_field('class') ? str_replace(' ', '-', strtolower(rtrim(get_sub_field('class')))) . ' ' : '' ;
	switch ($type) {
		case 'paragraph_text':
			$tag = 'p';
			break;
		case 'heading_1':
			$tag = 'h1';
			break;
		case 'heading_2':
			$tag = 'h2';
			break;
		case 'heading_3':
			$tag = 'h3';
			break;
		case 'heading_4':
			$tag = 'h4';
			break;
	}
?>
	<div class="text-lightbox <?php echo $class; ?><?php echo 'item-'  . $item_count; ?>">
		<div class="icon-text-lightbox">
		</div>
		<<?php echo $tag; ?>>
			<a class="text-lightbox-anchor" rel="image-link" href="<?php echo $image['url']; ?>">
				<?php echo $text; ?>
			</a>
		</<?php echo $tag; ?>>
	</div>
<?php
	// end text to image link
?>