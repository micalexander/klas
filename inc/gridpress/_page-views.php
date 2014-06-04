<?php
	// set counters to 0
	$map_count = 0;
	$unit_count = 0;
	$sub_unit_count = 0;
	$item_count = 0;

	if (get_field('grid', $post->ID)) : while(has_sub_field('grid', $post->ID)):
		$unit_count++;
		$unit_size = get_sub_field('unit_span');
		$unit_wrapper_class = get_sub_field('wrapper_class') ? vsprintf("%s" , str_replace(' -', ' ', str_replace(',', ' ', str_replace(' ', '-', strtolower(trim(get_sub_field('wrapper_class'))))))) . ' ' : '' ;
		$unit_class = get_sub_field('class') ? vsprintf("%s" , str_replace(' -', ' ', str_replace(',', ' ', str_replace(' ', '-', strtolower(trim(get_sub_field('class'))))))) . ' ' : '' ;
		$background_image = get_sub_field('background_image') ? get_sub_field('background_image') : '';
		$background_image_style = $background_image ? 'style="background-image: url('. $background_image['url'] . ');"' : '';
		$has_background_image = $background_image ? 'has-background-image' : '';
		?>
		<div class="unit-wrapper  <?php echo $unit_wrapper_class . $has_background_image; ?>" <?php echo $background_image_style ?>>
			<div class="unit-width">
			<div class="unit <?php echo $unit_class; ?><?php echo 'unit-'  . $unit_count . ' ' . $unit_size; ?> ">
			<?php
				if (get_sub_field('unit')) : while(has_sub_field('unit')):
					$sub_unit_count++;
					$sub_unit_size = get_sub_field('nested_unit_span');
					$sub_class = get_sub_field('class') ? vsprintf("%s" , str_replace(' -', ' ', str_replace(',', ' ', str_replace(' ', '-', strtolower(trim(get_sub_field('class'))))))) . ' ' : '' ;
				?>
				<div class="no-margin-unit <?php echo $sub_class; ?> <?php echo 'unit-'  . $sub_unit_count . ' no-margin-' . $sub_unit_size; ?>">
					<?php
						while(has_sub_field('nested_unit')):
							$item_count++;
								// start main image
							if (get_row_layout() == 'main_image'):
								require( 'main-image.php' );
								// start slides
							elseif (get_row_layout() == 'image_rotator'):
								require( 'image-rotator.php' );
								// start slides
							elseif (get_row_layout() == 'image_carousel'):
								require( 'image-carousel.php');
								// start map
							elseif (get_row_layout() == 'map'):
								require( 'map.php');
								// start title
							elseif (get_row_layout() == 'title'):
								require( 'title.php');
								// start sub-nav
							elseif (get_row_layout() == 'sub_menu'):
								require( 'sub-menu.php');
								// start heading
							elseif (get_row_layout() == "heading"):
								require( 'heading.php');
								// start editor
							elseif (get_row_layout() == "editor"):
								require( 'editor.php');
								// start text_link
							elseif (get_row_layout() == "text_link"):
								require( 'text-link.php');
								// start text to image link (lightbox)
							elseif (get_row_layout() == "text_to_image_link"):
								require( 'text-image-link.php');
								// start text_rotator
							elseif (get_row_layout() == "text_rotator"):
								require( 'text-rotator.php');
								// start button_link
							elseif (get_row_layout() == "button_link"):
								require( 'button-link.php');
								// start blockquote
							elseif (get_row_layout() == "blockquote"):
								require( 'blockquote.php');
								// start blockquote rotator
							elseif (get_row_layout() == "blockquote_rotator"):
								require( 'blockqoute-rotator.php');
								// start image
							elseif (get_row_layout() == "image"):
								require( 'image.php');
								// start image with hover
							elseif (get_row_layout() == "image_with_hover"):
								require( 'image-with-hover.php');
								// start image gallery
							elseif (get_row_layout() == "image_gallery"):
								require( 'image-gallery.php');
								// start image link gallery
							elseif (get_row_layout() == "image_link_gallery"):
								require( 'image-link-gallery.php');
								// start pdf link
							elseif (get_row_layout() == "pdf_link"):
								require( 'pdf-link.php');
								// start accordion_links
							elseif (get_row_layout() == "accordion_editor"):
								// start accordion_editor
								require( 'accordion-editor.php');
								// start accordion_links
							elseif (get_row_layout() == "accordion_links"):
								require( 'accordion-links.php');
								// start accordion_link button
							elseif (get_row_layout() == "accordion_button"):
								require( 'accordion-button.php');
								// start shortcode
							elseif (get_row_layout() == "shortcode"):
								require( 'shortcode.php');
								// start youtube video
							elseif (get_row_layout() == "youtube"):
								require( 'youtube.php');
								// start vimeo video
							elseif (get_row_layout() == "vimeo"):
								require( 'vimeo.php');
								// end flexible editor
							endif;
						endwhile;
						?>
						</div>
					<?php

					endwhile; endif;
					?>
				</div>
			</div>
		</div>
		<?php
	endwhile; endif;
?>