<?php
	if ( $value == true ):
		$author_first_name = get_the_author_meta('first_name', $post->post_author);
		$author_last_name = get_the_author_meta('last_name', $post->post_author);
	?>
		<p class="byline <?php echo $unit_span[$content]; ?>">Posted <?php echo get_the_time('F j, Y',$post[0]->ID) . " " . get_the_time('g:i A'); ?> By <?php echo ucwords($author_first_name) . " " . ucwords($author_last_name); ?></p>
<?php
	endif;
?>