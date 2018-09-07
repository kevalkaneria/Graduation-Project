<?php
/**
 * Elead functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Theme Palace
 * @subpackage Elead
 * @since Elead 0.1
 */

if ( ! function_exists( 'elead_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function elead_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Theme Palace, use a find and replace
		 * to change 'elead' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'elead', get_template_directory() . '/languages' );

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
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 360, 300, true );
		add_image_size( 'elead-medium', 400, 400, true );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary', 'elead' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'elead_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// This setup supports logo, site-title & site-description
		add_theme_support( 'custom-logo', array(
			'height'      => 70,
			'width'       => 120,
			'flex-height' => true,
			'flex-width'  => true,
			'header-text' => array( 'site-title', 'site-description' ),
		) );

		/*
		 * This theme styles the visual editor to resemble the theme style,
		 * specifically font, colors, icons, and column width.
		 */
		$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		add_editor_style( array( 'assets/css/editor-style' .$min. '.css' ) );

		// Indicate widget sidebars can use selective refresh in the Customizer.
		add_theme_support( 'customize-selective-refresh-widgets' );	
	}
endif;
add_action( 'after_setup_theme', 'elead_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function elead_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'elead_content_width', 640 );
}
add_action( 'after_setup_theme', 'elead_content_width', 0 );

if ( ! function_exists( 'elead_fonts_url' ) ) :
/**
 * Register Google fonts
 *
 * @return string Google fonts URL for the theme.
 */
function elead_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	// body fonts

	/* translators: If there are characters in your language that are not supported by Oxygen, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Oxygen font: on or off', 'elead' ) ) {
		$fonts[] = 'Oxygen:300,400,700';
	}
	
	// header fonts

	/* translators: If there are characters in your language that are not supported by Playfair Display, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Playfair Display font: on or off', 'elead' ) ) {
		$fonts[] = 'Playfair Display:400,700,900';
	}
	
	/* translators: If there are characters in your language that are not supported by Raleway, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Raleway font: on or off', 'elead' ) ) {
		$fonts[] = 'Raleway:300,400,500';
	}
	
	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

/**
 * Enqueue scripts and styles.
 */
function elead_scripts() {

	$options = elead_get_theme_options();
	// Add custom fonts, used in the main stylesheet.
	$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
	wp_enqueue_style( 'elead-fonts', elead_fonts_url(), array(), null );
	
	wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/assets/plugins/css/font-awesome' .$min. '.css', array(), '4.6.3' );

	wp_enqueue_style( 'slick', get_template_directory_uri() . '/assets/plugins/css/slick' .$min. '.css', array(), '1.6.0' );
	
	wp_enqueue_style( 'slick-theme', get_template_directory_uri() . '/assets/plugins/css/slick-theme' .$min. '.css', array(), '1.6.0' );
	
	wp_enqueue_style( 'elead-style', get_stylesheet_uri() );

	wp_enqueue_style( 'elead-color', get_template_directory_uri() . '/assets/css/red' .$min. '.css', array(), '' );

	// Load the html5 shiv.
	wp_enqueue_script( 'elead-html5', get_template_directory_uri() . '/assets/js/html5' .$min. '.js', array(), '3.7.3' );
	wp_script_add_data( 'elead-html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'elead-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix' .$min. '.js', array(), '20160412', true );

	wp_enqueue_script( 'elead-navigation', get_template_directory_uri() . '/assets/js/navigation' .$min. '.js', array(), '20151215', true );

	wp_enqueue_script( 'jquery-slick', get_template_directory_uri() . '/assets/plugins/js/slick' .$min. '.js', array('jquery'), '1.6.0', true );
	
	wp_enqueue_script( 'jquery-parallax', get_template_directory_uri() . '/assets/plugins/js/jquery.parallax' .$min. '.js', array('jquery'), '0.6.2', true );

	wp_enqueue_script( 'elead-custom', get_template_directory_uri() . '/assets/js/custom' .$min. '.js', array('jquery'), '', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'elead_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Load core file
 */
require get_template_directory() . '/inc/core.php';