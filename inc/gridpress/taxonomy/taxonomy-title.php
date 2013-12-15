<?php
	if ( $value == true ):
		$title = get_the_title($post[0]->ID);
	?>
		<h2 class="title <?php echo 'item-'  . $item_count . ' ' . $unit_span[$content]; ?>"><?php echo $title; ?></h2>
<?php
	endif;
?>