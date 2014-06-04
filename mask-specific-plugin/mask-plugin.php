<?php

/*
Plugin Name:  mask Site Specific Plugin
Description: Site specific code changes for mask
*/
/* Start Adding Functions Below this Line */

// gridpress variables
// short codes
$shortcode_choices = array (
	// '[sidebar-ads]' => 'Sidebar ads',
);


/**
* Add image sizes to the template
*/

if ( function_exists( 'add_image_size' ) ) {
    add_image_size( 'rotator-image', 1000, 400, true ); //(cropped)
    add_image_size( 'main-image', 1000, 400, true ); //(cropped)
    add_image_size( 'gallery-thumbnail', 200, 260, true ); //(cropped)
    add_image_size( 'headshot-image', 100, 100, true ); //(cropped)
    add_image_size( 'map-image', 370, 118, true ); //(cropped)
    add_image_size( 'one-of-one-image', 1000, 600, true ); //(cropped)
    add_image_size( 'one-of-two-image', 490, 294, true ); //(cropped)
    add_image_size( 'one-of-three-image', 320, 192, true ); //(cropped)
    add_image_size( 'one-of-four-image', 230, 140, true ); //(cropped)
    add_image_size( 'one-of-five-image', 180, 108, true ); //(cropped)
    add_image_size( 'two-of-three-image', 660, 396, true ); //(cropped)
    add_image_size( 'two-of-five-image', 385, 231, true ); //(cropped)
    add_image_size( 'three-of-four-image', 745, 447, true ); //(cropped)
    add_image_size( 'three-of-five-image', 590, 354, true ); //(cropped)
    add_image_size( 'four-of-five-image', 795, 477, true ); //(cropped)
}

add_filter( 'attachment_fields_to_save', 'mask_attachment_field_credit_save', 10, 2 );

// filter_hook function to react on sub_menu flag

function my_wp_nav_menu_objects_sub_menu( $sorted_menu_items, $args ) {
  if ( isset( $args->sub_menu ) ) {
    $root_id = 0;

    // find the current menu item
    foreach ( $sorted_menu_items as $menu_item ) {
      if ( $menu_item->current ) {
        // set the root id based on whether the current menu item has a parent or not
        $root_id = ( $menu_item->menu_item_parent ) ? $menu_item->menu_item_parent : $menu_item->ID;
        break;
      }
    }

	// find the top level parent
	if ( ! isset( $args->direct_parent ) ) {
		$prev_root_id = $root_id;
		while ( $prev_root_id != 0 ) {
			foreach ( $sorted_menu_items as $menu_item ) {
				if ( $menu_item->ID == $prev_root_id ) {
					$prev_root_id = $menu_item->menu_item_parent;
					// don't set the root_id to 0 if we've reached the top of the menu
					if ( $prev_root_id != 0 ) $root_id = $menu_item->menu_item_parent;
						break;
					}
				}
			}
		}

		$menu_item_parents = array();
		foreach ( $sorted_menu_items as $key => $item ) {
			// init menu_item_parents
			if ( $item->ID == $root_id ) $menu_item_parents[] = $item->ID;

			if ( in_array( $item->menu_item_parent, $menu_item_parents ) ) {
				// part of sub-tree: keep!
				$menu_item_parents[] = $item->ID;
			} else {
				// not part of sub-tree: away with it!
				unset( $sorted_menu_items[$key] );
			}
		}

		return $sorted_menu_items;
	} else {
		return $sorted_menu_items;
	}
}
// add hook
add_filter( 'wp_nav_menu_objects', 'my_wp_nav_menu_objects_sub_menu', 10, 2 );

add_filter('query_vars', 'add_query_vars');

// hook add_query_vars function into query_vars
function add_query_vars($aVars) {
	$aVars[] = "month"; // represents the name of the product category as shown in the URL
	$aVars[] = "int-month"; // represents the name of the product category as shown in the URL
	$aVars[] = "int-year"; // represents the name of the product category as shown in the URL
	$aVars[] = "letter"; // represents the name of the product category as shown in the URL
	return $aVars;
}

/**
 * Get the scheduled year for filter by month
 *
 * @param $int_month, the month to check
 * @return $year variable, the desired year
 * @author Mic Alexander
 **/

function get_sched_year($int_month)
{
	if ($int_month < date('m'))
	{
		$year = strval(date('Y') +1);
	}
	else
	{
		$year = date('Y');
	}
		return $year;
}

function slugify($text)
{
	// replace non letter or digits by -
	$text = preg_replace('~[^\\pL\d]+~u', '-', $text);

	// trim
	$text = trim($text, '-');

	// transliterate
	$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

	// lowercase
	$text = strtolower($text);

	// remove unwanted characters
	$text = preg_replace('~[^-\w]+~', '', $text);

	if (empty($text))
	{
	return 'n-a';
	}

  return $text;
}

add_filter( 'wp_nav_menu_objects', 'my_wp_nav_menu_objects_sub_menu', 10, 2 );


foreach (glob(plugin_dir_path( __FILE__ ) . 'custom-post-types/*.php') as $filename)
{
	include( $filename );
}


?>
