<?php

	$image = $value;
	if ($image) :
?>
		<div class="no-margin-unit main-image <?php echo ' no-margin-' . $unit_span[$content]; ?>">
			<img src="<?php echo $image['sizes']['one-of-five-image']; ?>" alt="<?php echo $image['alt']; ?>">
		</div>
	<?php endif; ?>
	<?php // end main image ?>
