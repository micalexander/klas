<?php
	$images = get_sub_field('images');
	$class = get_sub_field('class') ? str_replace(' ', '-', strtolower(rtrim(get_sub_field('class')))) . ' ' : '' ;
	$columns = get_sub_field('columns');
	$column_count = $columns;
?>
	<div class=" image-gallery <?php echo $class; ?><?php echo 'item-' . $item_count; ?>">
		<?php
			foreach ($images as $image):
			$image_inscription = get_post_meta($image['id'], 'inscription', true);
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
			<a class="image-gallery-anchor <?php echo $item_count . ' ' . $clear; ?>" rel="image-gallery" href="<?php echo $image['url']; ?>" title="<?php echo $image['caption']; ?>">
				<?php echo $inscription_url = $image_inscription_url ? '<a class="inscription-url" href="' . $image_inscription_url . '">' : ''; // opening "a" tag and inscription url ?>
					<?php echo $heading = $image_inscription_type ? '<' . $type . ' class="inscription" >': ''; ?><?php echo $text = $image_inscription ? $image_inscription : ''; ?><?php echo $heading = $image_inscription_type ? '</' . $type . '>': ''; // heading and inscription ?>
				<?php echo $close_inscription_url = $image_inscription_url ? '</a>': ''; // close "a" tag for inscription ?>
				<img class="image" src="<?php echo $image['sizes']['gallery-thumbnail']; ?>" data-target="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
			</a>
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