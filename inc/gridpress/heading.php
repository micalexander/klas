<?php
	$heading = get_sub_field('heading');
	$type = get_sub_field('heading_type');
	$link = get_sub_field('link');
	$target = get_sub_field('new_window') ? 'target="_blank"' : '' ;
	if ($heading):
	switch ($type) {
		case 'heading_2':
			$tag = 'h2';
			break;
		case 'heading_1':
			$tag = 'h1';
			break;
		case 'heading_3':
			$tag = 'h3';
			break;
		case 'heading_4':
			$tag = 'h4';
			break;
	}
?>
	<?php echo $open_anchor = $link ? '<a href="' . $link . '" ' . $target .' >' : ''; ?>
		<<?php echo $tag; ?> <?php echo 'class="item-'  . $item_count . '"'; ?>>
			<?php echo $heading; ?>
		</<?php echo $tag; ?>>
	<?php echo $close_anchor = $open_anchor ? '</a>' : ''; ?>
	<?php
	endif;
	// end heading
?>