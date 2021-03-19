<?php
/**
 * Agni Framework functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package Agni Framework
 */

/**
 * Defining framwork constants
 */
define('AGNI_FRAMEWORK_DIR', 			get_template_directory() );
define('AGNI_FRAMEWORK_URL', 			get_template_directory_uri() );
define('AGNI_FRAMEWORK_CSS_URL', 		AGNI_FRAMEWORK_URL . '/css');
define('AGNI_FRAMEWORK_JS_URL', 		AGNI_FRAMEWORK_URL . '/js');
define('AGNI_THEME_FILES_DIR', 			AGNI_FRAMEWORK_DIR . '/agni' );
define('AGNI_THEME_FILES_URL', 			AGNI_FRAMEWORK_URL . '/agni' );

if ( ! function_exists( 'agni_framework_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function agni_framework_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Agni Framework, use a find and replace
	 * to change 'agni_framework' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'halena', AGNI_FRAMEWORK_DIR . '/languages' );

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
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'audio',
		'gallery',
		'link',
		'quote',
		'video',
	) );

	/*
	 * Enable support for WooCommerce.
	 * See http://docs.woothemes.com/documentation/plugins/woocommerce/
	 */
	add_theme_support( 'woocommerce' );
	

}
endif; // agni_framework_setup
add_action( 'after_setup_theme', 'agni_framework_setup' );

/**
 * Modifing functions of visual Composer for theme.
 */
function agni_framework_vc_before_intialization() {	
	// Setting visual composer for theme.
	vc_set_as_theme( true );	
	
	// Disable Frontend
	//vc_disable_frontend();
	

	// Including custom functions for visual composer.
	require AGNI_FRAMEWORK_DIR . '/template/composer/agni_vc_addons.php';	

	// Disables redirect on activation.
	remove_action( 'vc_activation_hook', 'vc_page_welcome_set_redirect' );
	remove_action( 'admin_init', 'vc_page_welcome_redirect' );

}
add_action( 'vc_before_init', 'agni_framework_vc_before_intialization' );

function agni_framework_vc_after_intialization() {	

	// Setting Default Post types
	if ( function_exists( 'vc_set_default_editor_post_types' ) ) {	
		$args = array( 'page', 'post', 'portfolio', 'agni_block' );
		if( class_exists( 'WooCommerce' ) ){
			$args[] = 'product';
		}
		vc_set_default_editor_post_types( $args );	
	}

}
add_action( 'vc_after_init', 'agni_framework_vc_after_intialization' );

/**
 * Setting Revolution Slider for theme
 */
if(function_exists( 'set_revslider_as_theme' )){
	function agni_framework_revslider_as_theme() {
		set_revslider_as_theme();
	}
	add_action( 'init', 'agni_framework_revslider_as_theme' );
}

/**
 * To support SVG on media upload.
 */
function agni_additional_mime_types($mimes) {
	$mimes['eot'] = 'application/vnd.ms-fontobject';
	$mimes['otf|ttf'] = 'application/font-sfnt';
	$mimes['woff'] = 'application/font-woff';
	$mimes['woff2'] = 'application/font-woff2';
	$mimes['woff2'] = 'font/woff2';
	return $mimes;
}
add_filter('upload_mimes', 'agni_additional_mime_types');

/**
 * Load TGM Plugin action file.
 */
require AGNI_THEME_FILES_DIR . '/tgm/class-tgm-plugin-activation.php';


/**
 * Loading Custom theme functions.
 */
function agni_framework_theme_custom_functions() {

	/**
	 * Custom template tags for this theme.
	 */
	require AGNI_FRAMEWORK_DIR . '/template/template-tags.php';

	// Unique functions for the particular theme
   	require AGNI_FRAMEWORK_DIR . '/template/theme-functions.php';

	// Theme option panel value customizations
   	require AGNI_FRAMEWORK_DIR . '/template/theme-customization.php';

   	// Theme Metabox functions
   	require AGNI_FRAMEWORK_DIR . '/template/custom-metabox-functions.php';

   	// Demo content import options
   	require AGNI_FRAMEWORK_DIR . '/template/custom-demo-import-functions.php';

   	// Woocommerce function for theme.
   	if( class_exists( 'WooCommerce' ) ){
		// Theme Woocommerce function
		require AGNI_FRAMEWORK_DIR . '/template/woocommerce/functions.php';	

	}
}
add_action( 'after_setup_theme', 'agni_framework_theme_custom_functions' );
