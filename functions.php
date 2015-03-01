<?php
/**
 * @package WordPress
 * @subpackage Riiskit
 *
 * @since Riiskit 1.0.0
 */

/**
 * Set the content width based on the theme's design.
 */
if ( ! isset( $content_width ) ) {
	$content_width = apply_filters( 'riiskit_content_width' , 1170 ); /* pixels */
}



/**
 * Riiskit only works in WordPress 4.1 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.1-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}



if ( ! function_exists( 'riiskit_setup' ) ) :
/**
 * Riiskit setup.
 *
 * Set up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support post thumbnails.
 *
 * @since Riiskit 1.0.0
 */
	function riiskit_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on twentyfifteen, use a find and replace
		 * to change 'riiskit' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'riiskit', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		// This theme styles the visual editor to resemble the theme style.
		//add_editor_style( array( 'inc/admin/css/editor-style.css' ) );

		/**
		 * Enable support for Post Thumbnails, and declare one size.
		 * Larger images should be auto-cropped to fit, smaller ones should be ignored.
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 570, 300, true );
		add_image_size( 'riiskit-user-logo', 250, 100, false );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => __( 'Primary menu, typically used in the header etc.', 'riiskit' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
		) );

		// Remove junk from head
		remove_action('wp_head', 'rsd_link');
		remove_action('wp_head', 'wp_generator');
		remove_action('wp_head', 'feed_links', 2);
		remove_action('wp_head', 'index_rel_link');
		remove_action('wp_head', 'wlwmanifest_link');
		remove_action('wp_head', 'feed_links_extra', 3);
		remove_action('wp_head', 'start_post_rel_link', 10, 0);
		remove_action('wp_head', 'parent_post_rel_link', 10, 0);
		remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);


		// Show second row in wysiwig editor by default (kitchen sink)
		function unhide_kitchensink( $args ) {
			$args['wordpress_adv_hidden'] = false;
			return $args;
		}
		add_filter( 'tiny_mce_before_init', 'unhide_kitchensink' );

		// This theme uses its own gallery styles
		add_filter( 'use_default_gallery_style', '__return_false' );
	}

	add_action( 'after_setup_theme', 'riiskit_setup' );

endif;



/**
 * Enqueue stylesheets for the front end.
 *
 * @since Riiskit 1.0.0
 */
function riiskit_stylesheets() {
	// utilities/normalize.css
	wp_enqueue_style( 'riiskit-normalize', get_template_directory_uri() . '/css/utilities/normalize.css', array(), '3.0.2', null );

	// base/elements.css
	wp_enqueue_style( 'riiskit-elements', get_template_directory_uri() . '/css/base/elements.css', array(), '1.0.1', null );

	// style.css (main stylesheet)
	wp_enqueue_style( 'riiskit-style', get_stylesheet_uri(), array(
		'riiskit-normalize',
		'riiskit-elements',
	), '1.0.1', null );

	// modules/mobile-menu.css
	wp_enqueue_style( 'riiskit-mobile-menu', get_template_directory_uri() . '/css/modules/mobile-menu.css', array(), '1.0.1', null );

	// utilities/helpers.css
	wp_enqueue_style( 'riiskit-helpers', get_template_directory_uri() . '/css/utilities/helpers.css', array(), '1.0.1', null );
}
add_action( 'wp_enqueue_scripts', 'riiskit_stylesheets' );



/**
 * Enqueue scripts for the front end.
 *
 * @since Riiskit 1.0.0
 */
function riiskit_scripts() {
	// vendor/jquery.sidr.js
	if ( 'slideout-menu' === get_option('developer_menu_type') ) {
		wp_enqueue_script( 'riiskit-sidr', get_template_directory_uri() . '/js/vendor/jquery.sidr.js', array( 'jquery' ), '1.2.1', true );
	}

	// plugins.js
	wp_enqueue_script( 'riiskit-plugins', get_template_directory_uri() . '/js/plugins.js', array( 'jquery' ), '1.0.0', true );

	// mobile-menu.js
	wp_enqueue_script( 'riiskit-mobile-menu', get_template_directory_uri() . '/js/mobile-menu.js', array(
		'jquery',
		'riiskit-plugins',
	), '1.0.0', true );

	// main.js
	wp_enqueue_script( 'riiskit-main', get_template_directory_uri() . '/js/main.js', array(
		'jquery',
		'riiskit-plugins',
	), '1.0.2', true );
}
add_action( 'wp_enqueue_scripts', 'riiskit_scripts' );



/**
 * Inline JS and conditional JS (HTML5 shim, selectivizr).
 *
 * @since Riiskit 1.0.0
 */
function riiskit_scripts_head() { ?>
	<!--[if (lt IE 9) & (!IEMobile)]>
		<script src="<?php echo get_template_directory_uri(); ?>/js/vendor/html5.js"></script>
    <![endif]-->

	<!--[if (lt IE 9) & (!IEMobile)]>
		<script src="<?php echo get_template_directory_uri(); ?>/js/vendor/selectivizr.min.js"></script>
    <![endif]-->

	<!-- Battle the FOUC (remove if using Modernizr) -->
	<script>(function(H){H.className=H.className.replace(/\bno-js\b/,'js')})(document.documentElement)</script>
<?php }
add_action( 'wp_head', 'riiskit_scripts_head' );



/**
 * Change the three dots in excerpts when there is more text than shown.
 *
 * @since Riiskit 1.0.0
*/
function riiskit_new_excerpt_more( $more ) {
	return '&hellip;';
}
add_filter('excerpt_more', 'riiskit_new_excerpt_more');



/**
 * Extend the default WordPress body classes.
 *
 * @since Riiskit 1.0.0
 *
 * @param array $classes A list of existing body class values.
 * @return array The filtered body class list.
 */
function riiskit_body_classes( $classes ) {
	if ( is_singular() && ! is_front_page() ) {
		$classes[] = 'singular';
	}

	// Mobile menus
	$classes[] = 'mobile-menu';

	if ( 'toggle-menu' === get_option('developer_menu_type') ) {
		$classes[] = 'mobile-menu-type__toggle';
	}
	if ( 'slideout-menu' === get_option('developer_menu_type') ) {
		$classes[] = 'mobile-menu-type__slideout';
	}

	return $classes;
}
add_filter( 'body_class', 'riiskit_body_classes' );



/*
 * Theme constants.
 *
 * @since Riiskit 1.0.0
 */
if ( function_exists( 'wp_get_theme' ) ) {
	// get WP_Theme object of riiskit
	$riiskit_theme = wp_get_theme();

	// get infos from parent theme if using a child theme
	$riiskit_theme = $riiskit_theme -> parent() ? $riiskit_theme -> parent() : $riiskit_theme;

	// store theme info to object
	$riiskit_theme_data['version'] 		= $riiskit_theme -> version;
	$riiskit_theme_data['author']		= $riiskit_theme -> {'Author'};
	$riiskit_theme_data['authorname']	= $riiskit_theme -> display( 'Author', false );
	$riiskit_theme_data['authoruri']    = $riiskit_theme -> {'Author URI'};
}
if ( ! defined( 'RIISKIT_VER' ) ) {
	define( 'RIISKIT_VER' , $riiskit_theme_data['version'] );
}
if ( ! defined( 'RIISKIT_BASE' ) ) {
	define( 'RIISKIT_BASE' , get_template_directory().'/' );
}
if ( ! defined( 'RIISKIT_BASE_URL' ) ) {
	define( 'RIISKIT_BASE_URL' , get_template_directory_uri() . '/' );
}
if ( ! defined( 'RIISKIT_AUTHOR' ) ) {
	define( 'RIISKIT_AUTHOR' , $riiskit_theme_data['author'] );
}
if ( ! defined( 'RIISKIT_AUTHOR_NAME' ) ) {
	define( 'RIISKIT_AUTHOR_NAME' , $riiskit_theme_data['authorname'] );
}
if ( ! defined( 'RIISKIT_AUTHOR_URL' ) ) {
	define( 'RIISKIT_AUTHOR_URL' , $riiskit_theme_data['authoruri'] );
}



/**
 * Useful utility functions for common tasks.
 *
 * @since Riiskit 1.1.0
 */
require_once( RIISKIT_BASE . 'inc/utility-functions.php' );

/**
 * Useful template tags extending the WP API.
 *
 * @since Riiskit 1.0.0
 */
require_once( RIISKIT_BASE . 'inc/template-tags.php' );

/**
 * CPTs, taxonomies etc.
 *
 * @since Riiskit 1.0.0
 */
//require_once( RIISKIT_BASE . 'inc/admin/preset-library.php' );

/**
 * Plugin filters.
 *
 * @since Riiskit 1.0.0
 */
//require_once( RIISKIT_BASE . 'inc/plugin-filters.php' );

/**
 * WP Customizer theme options.
 *
 * @since Riiskit 1.0.0
 */
require_once( RIISKIT_BASE . 'inc/admin/customizer.php' );

/**
 * Custom admin logo etc.
 *
 * @since Riiskit 1.0.0
 */
//require_once( RIISKIT_BASE . 'inc/admin/admin.php' );

/**
 * User role capabilities.
 *
 * @since Riiskit 1.0.0
 */
require_once( RIISKIT_BASE . 'inc/admin/roles.php' );

?>