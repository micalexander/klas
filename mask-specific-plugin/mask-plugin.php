<?php
/*
Plugin Name:  mask Site Specific Plugin
Description: Site specific code changes for mask
Author: michael alexander
Author URL: http://www.micalexander.com/
Copyright: Micahel Alexander
Text Domain: mask
*/

require_once plugin_dir_path( __FILE__ ) . 'mask.php';


// Add image sizes to the template
if ( function_exists( 'add_image_size' ) ) {

  add_image_size( 'rotator-image',     1200, 500, true );
  add_image_size( 'main-image',        1000, 400, true );
  add_image_size( 'gallery-thumbnail', 200,  260, true );
  add_image_size( 'headshot-image',    100,  100, true );

}
