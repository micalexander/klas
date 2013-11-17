<?php
	$editors = get_sub_field("editor");
	if ($editors):

		foreach ($editors as $editor):
	?>
			<div class=" editor <?php echo 'item-'  . $item_count; ?>"><?php echo $editor['editor']; ?></div>
	<?php
				$item_count++;
			if($editor = end($editors)) {
			}
		endforeach;
	endif;
	// end editor
?>