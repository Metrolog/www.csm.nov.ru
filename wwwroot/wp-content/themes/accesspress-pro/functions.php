<?php
/**
 * Accesspress Pro functions and definitions
 *
 * @package Accesspress Pro
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'accesspress_pro_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function accesspress_pro_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Accesspress Pro, use a find and replace
	 * to change 'accesspress-pro' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'accesspress-pro', get_template_directory() . '/languages' );

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
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// Enable support fo Woocommerce
	add_theme_support( 'woocommerce' );

	add_image_size( 'event-thumbnail', 135, 100, true); //Latest News Events Small Image
	add_image_size( 'featured-thumbnail', 350, 245, array('center','top')); //Featured Image
	add_image_size( 'portfolio-thumbnail', 560, 450, array('center','center')); //Portfolio Image	
    add_image_size( 'shop-thumbnail', 300, 300, array('center','center')); //Portfolio Image	

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'accesspress-pro' ),
	) );
	
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'accesspress_pro_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // accesspress_pro_setup
add_action( 'after_setup_theme', 'accesspress_pro_setup' );


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/accesspress-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/accesspress-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Implement the Theme Option feature.
 */
require get_template_directory() . '/inc/admin-panel/theme-options.php';

/**
 * Implement the custom metabox feature
 */
require get_template_directory() . '/inc/accesspress-metabox.php';

/**
 * Implement the custom Post Types Features
 */
require get_template_directory() . '/inc/accesspress-posts-types.php';

/**
 * Implement the custom Shortcodes
 */
require get_template_directory() . '/inc/accesspress-shortcodes.php';

/**
 * Implement the custom Shortcodes
 */
require get_template_directory() . '/inc/accesspress-widgets.php';

/**
 * Implement the Google Fonts
 */
require get_template_directory() . '/inc/google-fonts.php';

/**
 * Implement the TGM
 */
require get_template_directory() . '/inc/class-tgm-plugin-activation.php';

/**
 * Import
 */
require get_template_directory() . '/inc/import/ap-importer.php';