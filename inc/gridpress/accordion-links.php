<?php
	$accordions = get_sub_field("accordion");
	$type = get_sub_field("heading_type");
	switch ($type) {
		case 'paragraph_text':
			$tag = 'p';
			$next_tag = 'p';
			break;
		case 'heading_1':
			$tag = 'h1';
			$next_tag = 'h2';
			break;
		case 'heading_2':
			$tag = 'h2';
			$next_tag = 'h3';
			break;
		case 'heading_3':
			$tag = 'h3';
			$next_tag = 'h4';
			break;
		case 'heading_4':
			$tag = 'h4';
			$next_tag = 'h5';
			break;
	}
?>
	<ul class=" accordion-links <?php echo 'item-' . $item_count; ?>">
		<?php
			foreach ($accordions as $accordion):
				$links = $accordion['links'];
		?>

		<li class="accordion-key">
			<<?php echo $tag; ?> class="accordion-heading icon-accordion-heading">
				<?php echo $accordion['heading'] ? $accordion['heading'] : ''; ?>
			</<?php echo $tag; ?>>
			<div class="accordion-section">
				<div class="accordion-margin">
					<?php foreach ($links as $link): ?>
						<<?php echo $link['text_2_type'] == 'url' ? 'a href="' . $link['text_2'] . '"' : $next_tag ; ?><?php echo $link['text_2_type'] == 'class' ? ' class="' . str_replace(' ', '-', strtolower(rtrim($link['text_2']))) . ' ' .$item_count . '"' : '' ; ?>>
						<?php echo $link['text'] ? $link['text'] : '' ; ?>
						</<?php echo $link['text_2_type'] == 'url' ? 'a' : $next_tag ; ?>>
						<?php echo $link['text_2_type'] == 'text' ? '<' . $next_tag . ' class="' . $item_count . '">' . $link['text_2'] . '</' . $next_tag . '>' : '' ; ?>
				        <?php
							if($link != end($links)) {
								$item_count++;
							}
				        	endforeach;
				        ?>
				</div>
			</div>
		</li>
	    <?php
			if($accordion != end($accordions)) {
				$item_count++;
			}
	    	endforeach;
	    ?>
	</ul>
<?php
	// end accordion_links
?>