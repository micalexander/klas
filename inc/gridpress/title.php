<?php
	$title = get_sub_field('title');
	$type = get_sub_field('title_type');
	$link = get_sub_field('link');
	$target = get_sub_field('new_window') ? 'target="_blank"' : '' ;
	$class = get_sub_field('class') ? vsprintf("%s" , str_replace(' -', ' ', str_replace(',', ' ', str_replace(' ', '-', strtolower(trim(get_sub_field('class'))))))) . ' ' : '' ;
	if ($title):
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
		<<?php echo $tag; ?> <?php echo 'class="title ' . $class . '"'; ?>>
			<?php echo get_the_title(); ?>
		</<?php echo $tag; ?>>
	<?php echo $close_anchor = $open_anchor ? '</a>' : ''; ?>
	<?php
	endif;
	// end title
?>