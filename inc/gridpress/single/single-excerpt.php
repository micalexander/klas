<?php
	$excerpt = get_sub_field('excerpt');
	if ($excerpt) :
?>
<div class="excerpt <?php echo $unit_span[$content]; ?>">
	<p><?php echo $excerpt; ?></p>
</div>
<?php endif; ?>