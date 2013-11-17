<?php
	$accordions = get_sub_field("accordion");
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
?>
	<ul class=" accordion-editor <?php echo 'item-' . $item_count; ?>">
		<?php foreach ($accordions as $accordion): ?>
		<li>
			<<?php echo $tag; ?> class="accordion-heading icon-accordion-heading <?php echo $item_count; ?>">
				<?php echo $accordion['heading'] ? $accordion['heading'] : ''; ?>
			</<?php echo $tag; ?>>
			<div class="accordion-section">
				<div class="accordion-margin">
					<?php echo $accordion['editor'] ? $accordion['editor'] : '' ; ?>
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
	// end accordion_editor
?>