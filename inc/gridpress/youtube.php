<?php
	$heading = get_sub_field('heading');
	$video_link = get_sub_field('video_link');
	$video_image = get_sub_field('video_image');
	$type = get_sub_field("heading_type");
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
	if ($heading):
?>
	<<?php echo $tag; ?> <?php echo 'class=" video item-' . $item_count .'"'; ?>>
		<?php
			echo $heading ? $heading : '';
		?>
	</<?php echo $tag; ?>>
<?php
	endif;
	if ($video_link):
?>
	<div class=" video-wrapper <?php echo $class; ?><?php echo 'item-' . $item_count; ?>">
   		<a class="y-video" href="<?php echo $video_link; ?>">
   			<img src="<?php echo $video_image['url'] ? $video_image['url'] : ""; ?>">
   		</a>
	</div>
	<?php
	endif;
	// end youtube video
?>