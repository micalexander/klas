<?php


	// set counters to 0
	$map_count = 0;
	$unit_count = 0;
	$sub_unit_count = 0;
	$item_count = 0;

	$post_type 			= get_post_type();
	$post_type_slug 	= get_post_type_object( $post_type )->rewrite['slug'];
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
				'post_type' => 'page',
				'post_status' => 'publish',
				'showposts' => 1,
				'caller_get_posts'=> 1
	);
	$taxonomy_post = get_posts($args);
	if (get_field('taxonomy_grid', get_page_by_path($taxonomy)->ID)) : while(has_sub_field('taxonomy_grid', get_page_by_path($taxonomy)->ID)):

		$unit_count++;
		$unit_size = get_sub_field('unit_span');
		$grid_class = get_sub_field('class') ? vsprintf("%s" , str_replace(' -', ' ', str_replace(',', ' ', str_replace(' ', '-', strtolower(trim(get_sub_field('class'))))))) . ' ' : '' ;
		?>
			<div class="unit <?php echo $grid_class; ?><?php echo 'unit-'  . $unit_count . ' ' . $unit_size; ?> ">
			<?php
				if (get_sub_field('unit')) : while(has_sub_field('unit')):
					$sub_unit_count++;
					$sub_unit_size = get_sub_field('nested_unit_span');
					$sub_class = get_sub_field('class') ? vsprintf("%s" , str_replace(' -', ' ', str_replace(',', ' ', str_replace(' ', '-', strtolower(trim(get_sub_field('class'))))))) . ' ' : '' ;
				?>
				<div class="no-margin-unit <?php echo $sub_class; ?><?php echo 'unit-'  . $sub_unit_count . ' no-margin-' . $sub_unit_size; ?> ">
				<?php
					while(has_sub_field('nested_unit')):
						$item_count++;
							// start main image
						if (get_row_layout() == 'main_image'):
							require_once __DIR__ . '/../main-image.php' ;
							// start slides
						elseif (get_row_layout() == 'image_rotator'):
							require_once __DIR__ . '/../image-rotator.php' ;
							// start slides
						elseif (get_row_layout() == 'image_carousel'):
							require_once __DIR__ . '/../image-carousel.php';
							// start map
						elseif (get_row_layout() == 'map'):
							require_once __DIR__ . '/../map.php';
							// start heading
						elseif (get_row_layout() == "heading"):
							require_once __DIR__ . '/../heading.php';
							// start editor
						elseif (get_row_layout() == "editor"):
							require_once __DIR__ . '/../editor.php';
							// start text_link
						elseif (get_row_layout() == "text_link"):
							require_once __DIR__ . '/../text-link.php';
							// start text to image link (lightbox)
						elseif (get_row_layout() == "text_to_image_link"):
							require_once __DIR__ . '/../text-image-link.php';
							// start text_rotator
						elseif (get_row_layout() == "text_rotator"):
							require_once __DIR__ . '/../text-rotator.php';
							// start button_link
						elseif (get_row_layout() == "button_link"):
							require_once __DIR__ . '/../button-link.php';
							// start blockquote
						elseif (get_row_layout() == "blockquote"):
							require_once __DIR__ . '/../blockquote.php';
							// start blockquote rotator
						elseif (get_row_layout() == "blockquote_rotator"):
							require_once __DIR__ . '/../blockqoute-rotator.php';
							// start image
						elseif (get_row_layout() == "image"):
							require_once __DIR__ . '/../image.php';
							// start image with hover
						elseif (get_row_layout() == "image_with_hover"):
							require_once __DIR__ . '/../image-with-hover.php';
							// start image gallery
						elseif (get_row_layout() == "image_gallery"):
							require_once __DIR__ . '/../image-gallery.php';
							// start pdf link
						elseif (get_row_layout() == "pdf_link"):
							require_once __DIR__ . '/../pdf-link.php';
							// start accordion_editor
						elseif (get_row_layout() == "accordion_editor"):
							require_once __DIR__ . '/../accordion-editor.php';
							// start accordion_links
						elseif (get_row_layout() == "accordion_links"):
							require_once __DIR__ . '/../accordion-links.php';
							// start accordion_link button
						elseif (get_row_layout() == "accordion_button"):
							require_once __DIR__ . '/../accordion-button.php';
							// start taxonomy
						elseif (get_row_layout() == "taxonomy"):
							require( 'taxonomy.php');
							// start taxonomy accordion last name
						elseif (get_row_layout() == "accordion_last_name"):
							require( 'taxonomy-accordion-last-name.php');
							// start taxonomy last name
						elseif (get_row_layout() == "taxonomy_last_name"):
							require( 'taxonomy-last-name.php');
							// start taxonomy accordion publish date
						elseif (get_row_layout() == "accordion_publish_date"):
							require( 'taxonomy-accordion-publish-date.php');
							// start taxonomy accordion start date
						elseif (get_row_layout() == "accordion_start_date"):
							require( 'taxonomy-accordion-start-date.php');
							// start taxonomy start date
						elseif (get_row_layout() == "taxonomy_start_date"):
							require( 'taxonomy-start-date.php');
							// start youtube video
						elseif (get_row_layout() == "youtube"):
							require_once __DIR__ . '/../youtube.php';
							// start vimeo video
						elseif (get_row_layout() == "vimeo"):
							require_once __DIR__ . '/../vimeo.php';
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