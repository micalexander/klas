<?php
	$shortcodes = get_sub_field("shortcodes");
	$shotcode_class = preg_replace('/\[|\]/', '', $shortcodes);
	$class = get_sub_field('class') ? vsprintf("%s" , str_replace(' -', ' ', str_replace(',', ' ', str_replace(' ', '-', strtolower(trim(get_sub_field('class'))))))) . ' ' : '' ;
	if ($shortcodes):
			$shortcode_output = do_shortcode($shortcodes);
		?>

		<div class="shortcode <?php $class; ?>">
			<div class="<?php echo $shotcode_class; ?>">
				<?php echo $shortcode_output; ?>
			</div>
		</div>
	<?php
	endif;
	// end editor
?>