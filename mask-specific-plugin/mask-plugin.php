<?php
/*
Plugin Name:  mask Site Specific Plugin
Description: Site specific code changes for mask
*/
/* Start Adding Functions Below this Line */

/**
* Add image sizes to the template
*/


//add pages to wordpress
// Create post object
// $homepage = array(
//   'post_type'    => 'page',
//   'post_title'    => 'Home',
//   'post_content'  => 'This is my home.',
//   'post_status'   => 'publish',
//   'post_author'   => 1,
//   'post_category' => array(8,39)
// );

// Insert the post into the database
wp_insert_post( $homepage );

if ( function_exists( 'add_image_size' ) ) {
    add_image_size( 'slide-image', 1000, 345, true ); //(cropped)
    add_image_size( 'main-image', 745, 175, true ); //(cropped)
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
	$form_fields['mask-link-name'] = array(
		'label' => 'Text',
		'input' => 'text',
		'value' => get_post_meta( $post->ID, 'text', true ),
	);

	$form_fields['mask-link-url'] = array(
		'label' => 'URL',
		'input' => 'text',
		'value' => get_post_meta( $post->ID, 'url', true ),
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
	if( isset( $attachment['mask-link-name'] ) )
		update_post_meta( $post['ID'], 'text', $attachment['mask-link-name'] );

	if( isset( $attachment['mask-link-url'] ) )
		update_post_meta( $post['ID'], 'url', $attachment['mask-link-url'] );

	return $post;
}

add_filter( 'attachment_fields_to_save', 'mask_attachment_field_credit_save', 10, 2 );



?>