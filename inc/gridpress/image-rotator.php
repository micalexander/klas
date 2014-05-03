<?php
		$images = get_sub_field('images');
		$class = get_sub_field('class') ? str_replace(' ', '-', strtolower(rtrim(get_sub_field('class')))) . ' ' : '' ;
	 	if( $images ):
	 ?>
	    <div id="slider" class=" flexslider <?php echo $class; ?><?php echo 'item-'  . $item_count; ?> <?php echo str_replace('_', '-', get_row_layout()); ?>">
	        <ul class="slides">
	            <?php foreach( $images as $image ): ?>
	                <li class="<?php echo $item_count; ?>">
	                    <?php
							$image_inscription = get_post_meta($image['id'], 'inscription', true);
							$image_url  = get_post_meta($image['id'], 'url', true);
							$image_inscription_type  = get_post_meta($image['id'], 'inscription_type', true);
							$target = get_post_meta($image['id'], 'new_window', true) ? ' target="_blank" ' : '';
							if (!$image_url)
							{
								$image_inscription_url  = get_post_meta($image['id'], 'inscription_url', true);
							}
							switch ($image_inscription_type)
							{
								case 'paragraph':
									$type = 'p';
									break;
								case 'heading_1':
									$type = 'h1';
									break;
								case 'heading_2':
									$type = 'h2';
									break;
								case 'heading_3':
									$type = 'h3';
									break;
								case 'heading_4':
									$type = 'h4';
									break;
							}
	                    ?>
						<?php echo $url = $image_url ? '<a href="' . $image_url . '"' . $target . '">': ''; // open "a" tag ?>
								<img class="image" src="<?php echo $image['sizes']['rotator-image']; ?>" alt="<?php echo $image['alt']; ?>" >
						<?php echo $close_url = $image_url ? '</a>' : ''; // closing "a" tag ?>
	                    <?php if ($image['caption']): ?>
		                    <p class="flex-caption"><span class="icon-caption-arrow"></span><?php echo $image['caption']; ?> <a href="<?php echo $image_url; ?>"><?php echo $image_text; ?><span class="icon-caption-link-arrow"></span></a></p>
	                	<?php endif; ?>
	                	<?php if ($image_inscription): ?>
							<?php echo $inscription_url = $image_inscription_url ? '<a class="inscription-url" href="' . $image_inscription_url . '">' : ''; // opening "a" tag and inscription url ?>
								<?php echo $heading = $image_inscription_type ? '<' . $type . ' class="inscription" >': ''; ?><?php echo $text = $image_inscription ? $image_inscription : ''; ?><?php echo $heading = $image_inscription_type ? '</' . $type . '>': ''; // heading and inscription ?>
							<?php echo $close_inscription_url = $image_inscription_url ? '</a>': ''; // close "a" tag for inscription ?>
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