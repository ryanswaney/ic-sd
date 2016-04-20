<?php
/**
 * icsd functions and definitions
 *
 * @package icsd
 */

if ( ! function_exists( 'icsd_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function icsd_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on icsd, use a find and replace
	 * to change 'icsd' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'icsd', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Let WordPress manage a custom logo.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded logo <img> in the document head, and expect WordPress to
	 * provide it for us.
	 *
	 * @link https://codex.wordpress.org/Function_Reference/add_theme_support#Custom_Logo
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 100,
		'width'       => 100,
		'flex-height' => true,
		'flex-width'  => true,
		'header-text' => array( 'site-title', 'site-description' )
	)
	);

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'icsd' ),
		'social' => esc_html__( 'Social Media', 'icsd' ),
		'footer-1' => esc_html__( 'Footer (1) Menu', 'icsd' ),
		'footer-2' => esc_html__( 'Footer (2) Menu', 'icsd' )
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array( 'video', 'gallery' ) );

	// Set up the WordPress core custom background feature.
	/*
	add_theme_support( 'custom-background', apply_filters( 'icsd_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
	*/
}
endif; // icsd_setup
add_action( 'after_setup_theme', 'icsd_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function icsd_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'icsd_content_width', 640 );
}
add_action( 'after_setup_theme', 'icsd_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function icsd_scripts() {
	wp_enqueue_style( 'icsd-style', get_stylesheet_uri() );

	//wp_enqueue_script( 'icsd-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	//wp_enqueue_script( 'icsd-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	wp_enqueue_script( 'okaynav-js', get_template_directory_uri() . '/js/jquery.okayNav-min.js', array('jquery'), '2.0.4', true );

	wp_enqueue_script( 'icsd-js', get_template_directory_uri() . '/js/icsd.js', array('jquery'), '20130115', true );


	if ( is_singular( 'events' ) || is_front_page() ) {

		wp_enqueue_script( 'google-maps', 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false', null, null, true );
		wp_enqueue_script( 'icsd-event-map', get_template_directory_uri() . '/js/acf-to-gmap.js', array('jquery'), '20130115', true );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'icsd_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Custom Functions for ACF fields
**/
require get_template_directory() . '/inc/acf-extras.php';

/**
 * Shortcodes
**/
require get_template_directory() . '/inc/shortcodes.php';

/**
 * Custom Post Type for Events
 */
require get_template_directory() . '/inc/cpt-events.php';

/**
 * Custom Post Type for Agendas
 */
require get_template_directory() . '/inc/cpt-agendas.php';
