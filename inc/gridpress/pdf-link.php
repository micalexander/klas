<?php
	$text = get_sub_field("text");
	$pdf = get_sub_field('pdf');
	$target = get_sub_field('new_window') ? 'target="_blank"' : '' ;
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
	if ($pdf):
?>
	<div class=" pdf <?php echo $class; ?><?php echo 'item-' . $item_count; ?>">
		<a class="text" href="<?php echo $pdf['url']; ?>" <?php echo $target; ?> >
		<div class="icon-pdf">PDF</div>
		<<?php echo $tag; ?>>
			<?php echo $text ? $text : ""; ?>
		</<?php echo $tag; ?>>
		</a>
	</div>
<?php
	endif;
	// end pdf link
?>