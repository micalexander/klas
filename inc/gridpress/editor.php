<?php
	$editors = get_sub_field("editor");
	if ($editors):

		foreach ($editors as $editor):
		$class = $editor['class'] ? str_replace(' ', '-', strtolower(rtrim($editor['class']))) . ' ' : '' ;
	?>
			<div class=" editor <?php echo $class; ?><?php echo 'item-'  . $item_count; ?>"><?php echo $editor['editor']; ?></div>
	<?php
				$item_count++;
			if($editor = end($editors)) {
			}
		endforeach;
	endif;
	// end editor
?>