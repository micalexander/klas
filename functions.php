<?php

// Define own Jquery file and enqueue in footer
function mask_scripts_init() {
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js','','',false);
    wp_enqueue_script( 'jquery' );
}

add_action('wp_enqueue_scripts', 'mask_scripts_init');


// Add image sizes to the template
if ( function_exists( 'add_image_size' ) ) {

  add_image_size( 'rotator-image',     1200, 500, true );
  add_image_size( 'main-image',        1000, 400, true );
  add_image_size( 'gallery-thumbnail', 200,  260, true );
  add_image_size( 'headshot-image',    100,  100, true );

}

// Adding default menu items
function mask_menus_init() {


    register_nav_menus(
      array(
        'primary-header-menu' => __( 'Primary Header Menu' ),
        'primary-footer-menu' => __( 'Primary Footer Menu' )
      )
    );

  // Add custom navigation to theme and adds Primary Navigation menu
  if (!term_exists('Primary Header Menu', 'nav_menu')) {

      // Select this menu in the current theme

    $menu = wp_insert_term(
      'Primary Header Menu',
      'nav_menu',
       array(
        'slug' => 'primary-header-menu'
      )
    );

    update_option(
      'theme_mods_mask',
      array(
        "nav_menu_locations"  => array(
        "primary-header-menu" => $menu['term_id']
        )
      )
    );


    // Insert new page
    $home = wp_insert_post(
      array(
        'post_type'     => 'page',
        'post_title'    => 'Home',
        'post_status'   => 'publish',
        'post_author'   => 1,
        'post_category' => array(8,39)
      )
    );

    update_option( 'page_on_front', $home );
    update_option( 'show_on_front', 'page' );


    // Insert new nav_menu_item (order matters for display purposes)

    $home_nav_item_footer = wp_insert_post(
      array(
        'post_title'   => 'Home',
        'post_content' => '',
        'post_status'  => 'publish',
        'post_type'    => 'nav_menu_item'
      )
    );

    add_post_meta($home_nav_item_footer, '_menu_item_type', 'post_type');
    add_post_meta($home_nav_item_footer, '_menu_item_menu_item_parent', '0');
    add_post_meta($home_nav_item_footer, '_menu_item_object_id', $home);
    add_post_meta($home_nav_item_footer, '_menu_item_object', 'page');
    add_post_meta($home_nav_item_footer, '_menu_item_target', '');
    add_post_meta($home_nav_item_footer, '_menu_item_xfn', '');
    add_post_meta($home_nav_item_footer, '_menu_item_url', '');


    wp_set_object_terms($home_nav_item_footer, 'Primary Footer Menu', 'nav_menu');

    // Insert new nav_menu_item (order matters for display purposes)

    $home_nav_item_header = wp_insert_post(
      array(
        'post_title'   => 'Home',
        'post_content' => '',
        'post_status'  => 'publish',
        'post_type'    => 'nav_menu_item'
      )
    );

    add_post_meta($home_nav_item_header, '_menu_item_type', 'post_type');
    add_post_meta($home_nav_item_header, '_menu_item_menu_item_parent', '0');
    add_post_meta($home_nav_item_header, '_menu_item_object_id', $home);
    add_post_meta($home_nav_item_header, '_menu_item_object', 'page');
    add_post_meta($home_nav_item_header, '_menu_item_target', '');
    add_post_meta($home_nav_item_header, '_menu_item_xfn', '');
    add_post_meta($home_nav_item_header, '_menu_item_url', '');

    wp_set_object_terms($home_nav_item_header,    'Primary Header Menu', 'nav_menu');
  }

  if (!term_exists('Primary Footer Menu', 'nav_menu')) {

    $menu2 = wp_insert_term(
      'Primary Footer Menu',
      'nav_menu',
      array(
        'slug' => 'primary-footer-menu'
      )
    );

    update_option(
      'theme_mods_mask',
      array(
        "nav_menu_locations" => array(
          "primary-footer-menu" => $menu2['term_id']
        )
      )
    );
  }
}

add_action( 'init', 'mask_menus_init' );


// Registers Primary Widget Area
function mask_widgets_init() {

  register_sidebar(
    array(
      'name'          => __( 'Primary Widget Area', 'twentyten' ),
      'id'            => 'primary-widget-area',
      'description'   => __( 'The primary widget area', 'twentyten' ),
      'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
      'after_widget'  => '</li>',
      'before_title'  => '<h3 class="widget-title">',
      'after_title'   => '</h3>',
    )
  );
}

add_action( 'widgets_init', 'mask_widgets_init' );

// Registers Editor Styles
add_editor_style( 'css/editor-style.css' );

// Remove theme/plugin editor
define( 'DISALLOW_FILE_EDIT', true );

// Add custom logo to Wordpress Login page(s). Logo should be no bigger than 323 pixels wide by 67 pixels high
function mask_login_logo() { ?>
  <style type="text/css">
    body.login div#login h1 a {
      background: url('<?php bloginfo( 'template_directory' ) ?>/wp-login-logo-mask.png') no-repeat 0 0;
      margin: 0 0 0 23px;
      width: 100%;
      height: 70px;
    }
  </style>
<?php }

add_action( 'login_enqueue_scripts', 'mask_login_logo' );

// Register theme support for post thumbnails/featured images + example
add_theme_support( 'post-thumbnails' );

// Template for comments and pingbacks. Via _s @since 1.0
if ( ! function_exists( '_s_comment' ) ) :
  function _s_comment( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    switch ( $comment->comment_type ) :
      case 'pingback' :
      case 'trackback' :
    ?>
    <li class="post pingback">
      <p><?php _e( 'Pingback:', '_s' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', '_s' ), ' ' ); ?></p>
    <?php
        break;
      default :
    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
      <article id="comment-<?php comment_ID(); ?>" class="comment">
        <footer>
          <div class="comment-author vcard">
            <?php echo get_avatar( $comment, 40 ); ?>
            <?php printf( __( '%s <span class="says">says:</span>', '_s' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
          </div><!-- .comment-author .vcard -->
          <?php if ( $comment->comment_approved == '0' ) : ?>
            <em><?php _e( 'Your comment is awaiting moderation.', '_s' ); ?></em>
            <br />
          <?php endif; ?>

          <div class="comment-meta commentmetadata">
            <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time pubdate datetime="<?php comment_time( 'c' ); ?>">
            <?php
              /* translators: 1: date, 2: time */
              printf( __( '%1$s at %2$s', '_s' ), get_comment_date(), get_comment_time() ); ?>
            </time></a>
            <?php edit_comment_link( __( '(Edit)', '_s' ), ' ' );
            ?>
          </div><!-- .comment-meta .commentmetadata -->
        </footer>

        <div class="comment-content"><?php comment_text(); ?></div>

        <div class="reply">
          <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
        </div><!-- .reply -->
      </article><!-- #comment-## -->

    <?php
        break;
    endswitch;
  }
endif; // ends check for _s_comment()

// Activate plugins and prevent from being deactivated
function run_activate_plugin( $plugin ) {

  $current = get_option( 'active_plugins' );
  $plugin  = plugin_basename( trim( $plugin ) );

  if ( !in_array( $plugin, $current ) ) {

    $current[] = $plugin;

    sort( $current );

    do_action( 'activate_plugin', trim( $plugin ) );

    update_option( 'active_plugins', $current );

    do_action( 'activate_' . trim( $plugin ) );
    do_action( 'activated_plugin', trim( $plugin) );
  }

  return null;
}

// BrowserSync
function apply_browsersync() {
?>
<script id="__bs_script__">//<![CDATA[
    document.write("<script async src='http://HOST:3000/browser-sync/browser-sync-client.js?v=2.18.12'><\/script>".replace("HOST", location.hostname));
//]]></script>
<?php
}

add_action( 'wp_footer', 'apply_browsersync' );

// Set permalink structure to post name
function run_options_once() {

  $check = get_option('mask_activation_check');

  if ( $check != "set" ) {

    // set permalinks
    global $wp_rewrite;

    $wp_rewrite->set_permalink_structure( '/%postname%/' );
    $wp_rewrite->flush_rules();

    // Add marker so it doesn't run in future
    add_option('mask_activation_check', "set");
  }
}

// Set rewrite rules
function mask_add_rewrite_rules($aRules) {

  $new_rules = array(

  );

  return $new_rules + $aRules;
}

// hook add_rewrite_rules function into rewrite_rules_array
add_filter('rewrite_rules_array', 'mask_add_rewrite_rules');
