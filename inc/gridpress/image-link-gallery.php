<?php
	$images = get_sub_field('images');
	$class = get_sub_field('class') ? str_replace(' ', '-', strtolower(rtrim(get_sub_field('class')))) . ' ' : '' ;
	$columns = get_sub_field('columns');
	$column_count = $columns;
?>
	<div class=" image-link-gallery <?php echo $class; ?><?php echo 'item-' . $item_count; ?>">
		<?php
		foreach ($images as $image):

			$image_incription = get_post_meta($image['id'], 'inscription', true);
			$image_url  = get_post_meta($image['id'], 'url', true);
			$image_inscription_type  = get_post_meta($image['id'], 'inscription_type', true);
			if (!$image_url)
			{
				$image_inscription_url  = get_post_meta($image['id'], 'inscription_url', true);
			}
			$target = get_post_meta($image['id'], 'new_window', true) ? ' target="_blank" ' : '';
			$clear = $column_count % $columns == 0 ? 'first-column' : '';
			switch ($image_inscription_type)
			{
				case 'paragraph':
					$type = 'p';
					break;
				case 'heading_1':
					$type = 'h1';
					break;
				case 'heading_2':
					$type = 'h2';
					break;
				case 'heading_3':
					$type = 'h3';
					break;
				case 'heading_4':
					$type = 'h4';
					break;
			}
		?>

			<?php echo $url = $image_url ? '<a href="' . $image_url . '"' . $target . ' class="image-link-gallery-wrapper ' . $clear . '">': '<div class="image-link-gallery-wrapper ' . $clear . '">'; // open "a" tag or "div" ?>
				<?php echo $inscription_url = $image_inscription_url ? '<a class="inscription-url" href="' . $image_inscription_url . '">' : ''; // opening "a" tag and inscription url ?>
					<?php echo $heading = $image_inscription_type ? '<' . $type . ' class="inscription" >': ''; ?><?php echo $text = $image_incription ? $image_incription : ''; ?><?php echo $heading = $image_inscription_type ? '</' . $type . '>': ''; // heading and inscription ?>
				<?php echo $close_inscription_url = $image_inscription_url ? '</a>': ''; // close "a" tag for inscription ?>
					<img class="image" src="<?php echo $image['sizes']['gallery-thumbnail']; ?>" alt="<?php echo $image['alt']; ?>" title="<?php echo $image['caption']; ?>" >
			<?php echo $close_url = $image_url ? '</a>' : '</div>'; // closing "a" tag or "div" ?>
	        <?php
				if($image != end($images)) {
					$item_count++;
				}
				$column_count++;
	        	endforeach;
	        ?>
	</div>
<?php
	// end image gallery
?>