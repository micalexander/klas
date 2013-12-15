<?php

	if (get_field('single_grid')) : while(has_sub_field('single_grid')):

		$unit_count++;
		$unit_size = get_sub_field('unit_span');
		?>
		<div class="unit <?php echo 'unit-'  . $unit_count . ' ' . $unit_size; ?> ">
		<?php
			if (get_sub_field('unit')) : while(has_sub_field('unit')):
				$sub_unit_count++;
				$sub_unit_size = get_sub_field('nested_unit_span');
	?>
			<div class="no-margin-unit <?php echo 'unit-'  . $sub_unit_count . ' no-margin-' . $sub_unit_size; ?> ">
				<?php
					while(has_sub_field('nested_unit')):
						$item_count++;
							// start accordion_link button
						if (get_row_layout() == "accordion_button"):
							require_once(__DIR__ . '/../accordion-button.php');
							// start accordion_editor
						elseif (get_row_layout() == "accordion_editor"):
							require_once(__DIR__ . '/../accordion-editor.php');
							// start accordion_links
						elseif (get_row_layout() == "accordion_links"):
							require_once(__DIR__ . '/../accordion-links.php');
							// start archive byline
						elseif (get_row_layout() == "byline"):
							require( 'single-byline.php');
							// start archive dates
						elseif (get_row_layout() == "dates"):
							require( 'single-dates.php');
							// start archive days
						elseif (get_row_layout() == "days"):
							require( 'single-days.php');
							// start archive email
						elseif (get_row_layout() == "email"):
							require( 'single-email.php');
							// start archive excerpt
						elseif (get_row_layout() == "excerpt"):
							require( 'single-excerpt.php');
							// start archive full name
						elseif (get_row_layout() == "full_name"):
							require( 'single-full-name.php');
							// start blockquote
						elseif (get_row_layout() == "blockquote"):
							require_once(__DIR__ . '/../blockquote.php');
							// start blockquote rotator
						elseif (get_row_layout() == "blockquote_rotator"):
							require_once(__DIR__ . '/../blockqoute-rotator.php');
							// start button_link
						elseif (get_row_layout() == "button_link"):
							require_once(__DIR__ . '/../button-link.php');
							// start editor
						elseif (get_row_layout() == "editor"):
							require_once(__DIR__ . '/../editor.php');
							// start heading
						elseif (get_row_layout() == "heading"):
							require_once(__DIR__ . '/../heading.php');
							// start image carousel
						elseif (get_row_layout() == 'image_carousel'):
							require_once(__DIR__ . '/../image-carousel.php');
							// start image rotator
						elseif (get_row_layout() == 'image_rotator'):
							require_once(__DIR__ . '/../image-rotator.php' );
							// start image
						elseif (get_row_layout() == "image"):
							require_once(__DIR__ . '/../image.php');
							// start image gallery
						elseif (get_row_layout() == "image_gallery"):
							require_once(__DIR__ . '/../image-gallery.php');
							// start image with hover
						elseif (get_row_layout() == "image_with_hover"):
							require_once(__DIR__ . '/../image-with-hover.php');
							// start main image
						elseif (get_row_layout() == 'main_image'):
							require_once(__DIR__ . '/../main-image.php' );
							// start map
						elseif (get_row_layout() == 'map'):
							require_once(__DIR__ . '/../map.php');
							// start pdf link
						elseif (get_row_layout() == "pdf_link"):
							require_once(__DIR__ . '/../pdf-link.php');
							// start sub-nav
						elseif (get_row_layout() == 'sub_menu'):
							require_once(__DIR__ . '/../sub-menu.php');
							// start text_link
						elseif (get_row_layout() == "text_link"):
							require_once(__DIR__ . '/../text-link.php');
							// start text to image link (lightbox)
						elseif (get_row_layout() == "text_to_image_link"):
							require_once(__DIR__ . '/../text-image-link.php');
							// start text_rotator
						elseif (get_row_layout() == "text_rotator"):
							require_once(__DIR__ . '/../text-rotator.php');
							// single title
						elseif (get_row_layout() == "title"):
							require_once(__DIR__ . '/../title.php');
							// start youtube video
						elseif (get_row_layout() == "youtube"):
							require_once(__DIR__ . '/../youtube.php');
							// start vimeo video
						elseif (get_row_layout() == "vimeo"):
							require_once(__DIR__ . '/../vimeo.php');
							// end flexible editor
						endif;
					endwhile;
					?>
					</div>
				<?php

				endwhile; endif;
				?>
			</div>
		<?php
	endwhile; endif;
?>