<?php

/*
Plugin Name:  mask Site Specific Plugin
Description: Site specific code changes for mask
*/
/* Start Adding Functions Below this Line */

/**
* Add image sizes to the template
*/

if ( function_exists( 'add_image_size' ) ) {
    add_image_size( 'rotator-image', 1000, 400, true ); //(cropped)
    add_image_size( 'main-image', 1000, 400, true ); //(cropped)
    add_image_size( 'gallery-thumbnail', 200, 260, true ); //(cropped)
    add_image_size( 'carousel-image', 80, 80, false ); //(cropped)
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

/**
 * Add fields to media uploader
 *
 * @param $form_fields array, fields to include in attachment form
 * @param $post object, attachment record in database
 * @return $form_fields, modified form fields
 */

function mask_attachment_field_credit( $form_fields, $post ) {

	$form_fields['mask-text'] = array(
		'label' => 'Text',
		'input' => 'text',
		'value' => get_post_meta( $post->ID, 'text', true ),
	);

	$form_fields['mask-url-text'] = array(
		'label' => 'URL Text',
		'input' => 'text',
		'value' => get_post_meta( $post->ID, 'url-text', true ),
	);

	$form_fields['mask-url'] = array(
		'label' => 'URL',
		'input' => 'text',
		'value' => get_post_meta( $post->ID, 'url', true ),
	);

	$form_fields['mask-map-text-1'] = array(
		'label' => 'Map Line 1',
		'input' => 'text',
		'value' => get_post_meta( $post->ID, 'map-text-1', true ),
	);

	$form_fields['mask-map-text-2'] = array(
		'label' => 'Map Line 2',
		'input' => 'text',
		'value' => get_post_meta( $post->ID, 'map-text-2', true ),
	);

	$form_fields['mask-map-text-3'] = array(
		'label' => 'Map Line 3',
		'input' => 'text',
		'value' => get_post_meta( $post->ID, 'map-text-3', true ),
	);

	$form_fields['mask-map-text-4'] = array(
		'label' => 'Map Line 4',
		'input' => 'text',
		'value' => get_post_meta( $post->ID, 'map-text-4', true ),
	);

	$form_fields['mask-map-url-text'] = array(
		'label' => 'Map URL Text',
		'input' => 'text',
		'value' => get_post_meta( $post->ID, 'map-url-text', true ),
	);

	$form_fields['mask-map-url'] = array(
		'label' => 'Map URL',
		'input' => 'text',
		'value' => get_post_meta( $post->ID, 'map-url', true ),
	);

	return $form_fields;
}

add_filter( 'attachment_fields_to_edit', 'mask_attachment_field_credit', 10, 2 );

/**
 * Save values of fields in media uploader
 *
 * @param $post array, the post data for database
 * @param $attachment array, attachment fields from $_POST form
 * @return $post array, modified post data
 */

function mask_attachment_field_credit_save( $post, $attachment ) {

	if( isset( $attachment['mask-text'] ) )
		update_post_meta( $post['ID'], 'text', $attachment['mask-text'] );

	if( isset( $attachment['mask-url-text'] ) )
		update_post_meta( $post['ID'], 'url-text', $attachment['mask-url-text'] );

	if( isset( $attachment['mask-url'] ) )
		update_post_meta( $post['ID'], 'url', $attachment['mask-url'] );

	if( isset( $attachment['mask-map-text-1'] ) )
		update_post_meta( $post['ID'], 'map-text-1', $attachment['mask-map-text-1'] );

	if( isset( $attachment['mask-map-text-2'] ) )
		update_post_meta( $post['ID'], 'map-text-2', $attachment['mask-map-text-2'] );

	if( isset( $attachment['mask-map-text-3'] ) )
		update_post_meta( $post['ID'], 'map-text-3', $attachment['mask-map-text-3'] );

	if( isset( $attachment['mask-map-text-4'] ) )
		update_post_meta( $post['ID'], 'map-text-4', $attachment['mask-map-text-4'] );

	if( isset( $attachment['mask-map-url-text'] ) )
		update_post_meta( $post['ID'], 'map-url-text', $attachment['mask-map-url-text'] );

	if( isset( $attachment['mask-map-url'] ) )
		update_post_meta( $post['ID'], 'map-url', $attachment['mask-map-url'] );

	return $post;
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

?>
