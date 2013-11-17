<?php
	$images = get_sub_field('images');
?>
	<div class=" image-gallery <?php echo 'item-' . $item_count; ?>">
		<?php foreach ($images as $image): ?>
			<a class="image-gallery-anchor <?php echo $item_count; ?>" rel="image-gallery" href="<?php echo $image['url']; ?>">
				<img class="image" src="<?php echo $image['sizes']['gallery-thumbnail']; ?>" data-target="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" title="<?php echo $image['description']; ?>" >
			</a>
	        <?php
				if($image != end($images)) {
					$item_count++;
				}
	        	endforeach;
	        ?>
	</div>
<?php
	// end image gallery
?>