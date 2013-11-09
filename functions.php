<?php

// Define own Jquery file and enqueue in footer
function mask_scripts_init() {
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js','','',false);
    wp_enqueue_script( 'jquery' );
}
add_action('wp_enqueue_scripts', 'mask_scripts_init');

function mask_menus_init() {
	register_nav_menus(
		array(
				'primary-header-menu' => __( 'Primary Header Menu' )
			)
	);
	wp_create_nav_menu( 'Primary Navigation', array( 'slug' => 'primary-nav' ) );
}

add_action( 'init', 'mask_menus_init' );

// Add custom navigation to theme and adds Primary Navigation menu
if (!term_exists('primary-nav', 'nav_menu')) {

    $menu = wp_insert_term('Primary Navigation', 'nav_menu', array('slug' => 'primary-nav'));

    // Select this menu in the current theme
    update_option('theme_mods_'.get_current_theme(), array("nav_menu_locations" => array("primary" => $menu['term_id'])));

    // Insert new page
    $page = wp_insert_post(array('post_title' => 'Blog',
                                 'post_content' => '',
                                 'post_status' => 'publish',
                                 'post_type' => 'page'));

    // Insert new nav_menu_item
    $nav_item = wp_insert_post(array('post_title' => 'Home',
                                     'post_content' => '',
                                     'post_status' => 'publish',
                                     'post_type' => 'nav_menu_item'));


    add_post_meta($nav_item, '_menu_item_type', 'post_type');
    add_post_meta($nav_item, '_menu_item_menu_item_parent', '0');
    // add_post_meta($nav_item, '_menu_item_object_id', $page);
    add_post_meta($nav_item, '_menu_item_object', 'page');
    add_post_meta($nav_item, '_menu_item_target', '');
    add_post_meta($nav_item, '_menu_item_classes', 'a:1:{i:0;s:0:"";}');
    add_post_meta($nav_item, '_menu_item_xfn', '');
    add_post_meta($nav_item, '_menu_item_url', '');

    wp_set_object_terms($nav_item, 'primary-nav', 'nav_menu');
}

// Registers Primary Widget Area
function mask_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Primary Widget Area', 'twentyten' ),
		'id' => 'primary-widget-area',
		'description' => __( 'The primary widget area', 'twentyten' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
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
            background: url('<?php bloginfo( 'template_directory' ) ?>/img/wp-login-logo-mask.png') no-repeat 0 0;
			margin: 0 0 0 23px;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'mask_login_logo' );

// Register theme support for post thumbnails/featured images + example
add_theme_support( 'post-thumbnails' );
//add_image_size( $name, $width, $height, $hard_crop[boolean] );

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

function run_activate_plugin( $plugin ) {
    $current = get_option( 'active_plugins' );
    $plugin = plugin_basename( trim( $plugin ) );

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

function run_options_once() {
  $check = get_option('mask_activation_check');

	if ( $check != "set" ) {

		// Create post object
		$homepage = array(
		  'post_type'    => 'page',
		  'post_title'    => 'Home',
		  'post_status'   => 'publish',
		  'post_author'   => 1,
		  'post_category' => array(8,39)
		);

		$about_us = array(
		  'post_type'    => 'page',
		  'post_title'    => 'About us',
		  'post_status'   => 'publish',
		  'post_author'   => 1,
		  'post_category' => array(8,39)
		);

		$contact_us = array(
		  'post_type'    => 'page',
		  'post_title'    => 'Contact us',
		  'post_status'   => 'publish',
		  'post_author'   => 1,
		  'post_category' => array(8,39)
		);
		// Insert the post into the database
		wp_insert_post( $homepage );
		wp_insert_post( $about_us );
		wp_insert_post( $contact_us );

	    // Add marker so it doesn't run in future
	    add_option('mask_activation_check', "set");
	}
}

add_action('init', 'run_options_once');

// set permalinks
add_action( 'init', function() {
    global $wp_rewrite;
    $wp_rewrite->set_permalink_structure( '/%postname%/' );
} );

run_activate_plugin( 'mask-specific-plugin/mask-plugin.php' );

?>