<?php
	$text_links = get_sub_field("text_link");
	if ($text_links):

		foreach ($text_links as $text_link):
		$target = $text_link['new_window'] ? ' target="_blank"' : '' ;
		$class = $text_link['class'] ? str_replace(' ', '-', strtolower(rtrim($text_link['class']))) . ' ' : '' ;
	?>

		<?php echo $open_anchor = $text_link['link'] ? '<a href="' . $text_link['link'] . '" class="' . $class . $target . '>' : '<p>'; ?>
			<?php echo $text_link['text']; ?>
		<?php echo $close_anchor = $open_anchor ? '</a>' : '</p>'; ?>
	<?php
			if($text_link != end($text_links)) {
				$item_count++;
			}
		endforeach;

	endif;
	// end text_link
?>