<?php
	$editor = get_sub_field("editor");
	$class = get_sub_field('class') ? vsprintf("%s" , str_replace(' -', ' ', str_replace(',', ' ', str_replace(' ', '-', strtolower(trim(get_sub_field('class'))))))) . ' ' : '' ;
	if ($editor):
		?>

	<?php
	?>
		<div class=" editor <?php echo $class; ?>"><?php echo $editor; ?></div>
	<?php
	endif;
	// end editor
?>