<?php
	$heading = get_sub_field("heading");
	$type = get_sub_field("heading_type");
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
	<<?php echo $tag . ' class=" rotator item-'  . $item_count; ?>><?php echo $heading; ?></<?php echo $tag; ?>>
<?php
	endif;
	$items = get_sub_field('text');
	if($items):
?>
	<div id="slider" class="text-rotator">
	    <ul class="slides">
	        <?php foreach ($items as $item): ?>
				<li class="<?php echo $item_count; ?>" ><p><?php echo $item['text']; ?></p></li>
	        <?php
				if($item != end($items)) {
					$item_count++;
				}
	        	endforeach;
	        ?>
	    </ul>
	</div>
<?php
	endif;
	// end text_rotator
?>