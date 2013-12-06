<?php


	// set counters to 0
	$map_count = 0;
	$unit_count = 0;
	$sub_unit_count = 0;
	$item_count = 0;

	$post_type_slug 	= get_post_type_object( get_post_type() )->rewrite['slug'];
	$months 			= array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
	$last_month 		= date('m') -1;
	// get position of the current month to the end of the year
	$month_start 		= array_slice($months, $last_month);
	// get jan all the way to the current month
	$month_end 			= array_slice($months, 0, $last_month);
	// merge these two arrays together to make a month filter that starts with this current month
	$new_months 		= array_merge($month_start,$month_end);

	$query_vars_month 	= $wp_query->query_vars['month'];
	$query_vars_int_month 	= $wp_query->query_vars['int-month'];
	$query_vars_year 	= $wp_query->query_vars['year'];
	$int_month 			= ($month == null) ? null : date('m', strtotime($query_vars_month . "01"));

	$year 				= get_sched_year($int_month);
	$query_sched_string = $year . $int_month . "01";
	$query_pub_string = date('Y') . $query_vars_int_month . "01";



	$slug_to_get = get_post_type_object( get_post_type() )->rewrite['slug'];
	$args = array(
				'name' => $slug_to_get,
				'post_type' => 'page',
				'post_status' => 'publish',
				'showposts' => 1,
				'caller_get_posts'=> 1
	);
	$archive_post = get_posts($args);
echo "<pre>" ; var_dump($archive_post[0]->ID) ; echo "</pre><br>";
	if (get_field('archive_grid', $archive_post[0]->ID)) : while(has_sub_field('archive_grid', $archive_post[0]->ID)):

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
							// start pdf link
						elseif (get_row_layout() == "pdf_link"):
							require( 'pdf-link.php');
							// start accordion_editor
						elseif (get_row_layout() == "accordion_editor"):
							require( 'accordion-editor.php');
							// start accordion_links
						elseif (get_row_layout() == "accordion_links"):
							require( 'accordion-links.php');
							// start accordion_link button
						elseif (get_row_layout() == "accordion_button"):
							require( 'accordion-button.php');
							// start archive
						elseif (get_row_layout() == "archive"):
							require( 'archive.php');
							// start archive accordion last name
						elseif (get_row_layout() == "accordion_last_name"):
							require( 'archive-accordion-last-name.php');
							// start archive last name
						elseif (get_row_layout() == "archive_last_name"):
							require( 'archive-last-name.php');
							// start archive accordion publish date
						elseif (get_row_layout() == "accordion_publish_date"):
							require( 'archive-accordion-publish-date.php');
							// start archive accordion start date
						elseif (get_row_layout() == "accordion_start_date"):
							require( 'archive-accordion-start-date.php');
							// start archive start date
						elseif (get_row_layout() == "archive_start_date"):
							require( 'archive-start-date.php');
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
		<?php
	endwhile; endif;
?>