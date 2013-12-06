<?php
		$images = get_sub_field('images');
		$class = get_sub_field('class') ? str_replace(' ', '-', strtolower(rtrim(get_sub_field('class')))) . ' ' : '' ;
	 	if( $images ):
	 ?>
	    <div id="slider" class=" flexslider <?php echo $class; ?><?php echo 'item-'  . $item_count; ?> <?php echo str_replace('_', '-', get_row_layout()); ?>">
	        <ul class="slides">
	            <?php foreach( $images as $image ): ?>
	                <li class="<?php echo $item_count; ?>">
	                    <img src="<?php echo $image['sizes']['rotator-image']; ?>" alt="<?php echo $image['alt']; ?>" />
	                    <?php
							$image_text = get_post_meta($image['id'], 'text', true);
							$image_url = get_post_meta($image['id'], 'url', true);
	                    ?>
	                    <?php if ($image['caption']): ?>
		                    <p class="flex-caption"><span class="icon-caption-arrow"></span><?php echo $image['caption']; ?> <a href="<?php echo $image_url; ?>"><?php echo $image_text; ?><span class="icon-caption-link-arrow"></span></a></p>
	                	<?php endif; ?>
	                </li>
		        <?php
					if($image != end($images)) {
						$item_count++;
					}
		        	endforeach;
		        ?>
	        </ul>
	    </div>
	<?php
		endif;
	// end image rotator
?>