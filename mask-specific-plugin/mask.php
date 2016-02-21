<?php

require_once plugin_dir_path( __FILE__ ) . '/vendor/inflector.php';

if( ! class_exists('mask') ) :

class mask extends Inflector {

  /**
   * __construct A dummy constructor to ensure mask is only initialized once
   * @return N/A
   */
  function __construct() {

    /* Do nothing here */

  }

  function initialize() {

    add_filter( 'wp_nav_menu_objects', array($this, 'wp_nav_menu_objects_sub_menu'), 10, 2 );

  }

  /**
   * Filter the menu items
   * @param  array $sorted_menu_items Array of menu items
   * @param  array $args              Array of menu args
   * @return array                    Sorted menu items
   */
  function wp_nav_menu_objects_sub_menu( $sorted_menu_items, $args ) {

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
              if ( $prev_root_id != 0 ) {

                $root_id = $menu_item->menu_item_parent;

                break;

              }
            }
          }
        }

        $menu_item_parents = array();

        foreach ( $sorted_menu_items as $key => $item ) {

          // init menu_item_parents
          if ( $item->ID == $root_id ) {

            $menu_item_parents[] = $item->ID;

          }

          if ( in_array( $item->menu_item_parent, $menu_item_parents ) ) {

            // part of sub-tree: keep!
            $menu_item_parents[] = $item->ID;

          }
          else {

            // not part of sub-tree: away with it!
            unset( $sorted_menu_items[$key] );

          }
        }
      }

      return $sorted_menu_items;

    }
    else {

      return $sorted_menu_items;

    }
  }


  /**
   * Get image and meta including title, alt, caption, and description
   * @param  string $size     Size of image to retrieve
   * @param  integer $post_id Post id of post to get image from
   * @return string           Image url
   */
  function get_image( $size = null, $post_id = null )
  {
    $img = wp_prepare_attachment_for_js(get_post_thumbnail_id($post_id));

    if ($size != null)
    {
      if (!array_key_exists($size, $img['sizes']))
      {
          return $img['url'];
      }
      else
      {
          return $img['sizes'][$size]['url'];
      }
    }
    else
    {
      return $img;
    }
  }

  /**
   * Pull in the partial
   * @param  string $pagename slug of the page to pull in
   * @return N/A
   */
  function get_partial($pagename) {

    get_template_part('partial-' . $pagename );
  }

  /**
   * Check to see if partial exist in theme directory
   * @param  string $pagename slug of the page
   * @return boolean           true or false
   */
  function partial_exist($pagename) {

    if (file_exists(get_template_directory() .  '/partial-' . $pagename . '.php' )) {

      return true;
    }

    return false;
  }

  /**
   * Get sub menu
   * @param  string  $template_location slug of template location
   * @param  integer $depth             What level of the menu should show
   * @return html                       Sub nav
   */
  function get_sub_menu( $template_location = '', $depth = 2 ) {

    $template_locations = get_registered_nav_menus();

    if (!in_array($template_location, array_keys($template_locations))) {

      return false;

    }

    $args = array(
      'theme_location' => $template_location,
      'sub_menu'       => true,
      'depth'          => $depth,
    );

    wp_nav_menu($args);

  }

  /**
   * threeedots Truncate text to a specific character count and append three dots
   * @param  string  $string The text to check
   * @param  integer $limit  How many characters to truncate it to
   * @param  string  $break  spacer
   * @param  string  $pad    Characters to pad
   * @return text            Text that has be truncated or left alone if under limit
   */
  function threedots($string, $limit = 100, $break=" ", $pad="  ...")
  {
    // return with no change if string is shorter than $limit
    if(mb_strlen($string, 'UTF-8') <= $limit) return $string;

    // is $break present between $limit and the end of the string?
    if(false !== ($breakpoint = mb_strpos($string, $break, $limit, "UTF-8")))
    {
      if($breakpoint < mb_strlen($string, 'UTF-8') - 1)
      {
        // $string = substr($string, 0, $breakpoint) . $pad;
        $string = mb_substr($string, 0, $breakpoint, "UTF-8") . $pad;
      }
    }

    #put all opened tags into an array
    preg_match_all ( "#<([a-z]+)( .*)?(?!/)>#iU", $string, $result );
    $openedtags = $result[1];

    #put all closed tags into an array
    preg_match_all ( "#</([a-z]+)>#iU", $string, $result );

    $closedtags = $result[1];
    $len_opened = count ( $openedtags );

    # all tags are closed
    if( count ( $closedtags ) == $len_opened )
    {
      return $string;
    }

    $openedtags = array_reverse ( $openedtags );

    # close tags
    for( $i = 0; $i < $len_opened; $i++ )
    {
      if ( !in_array ( $openedtags[$i], $closedtags ) )
      {
        $string .= "</" . $openedtags[$i] . ">";
      }
      else
      {
        unset ( $closedtags[array_search ( $openedtags[$i], $closedtags)] );
      }
    }

    return $string;

  }
}

function mask() {

  global $mask;

  if( !isset($mask) ) {

    $mask = new mask();

    $mask->initialize();

  }

  return $mask;
}


// initialize
mask();

endif; // class_exists check
