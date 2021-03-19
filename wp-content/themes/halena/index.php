<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Agni Framework
 */

get_header(); ?>

<?php if(!is_front_page()){ $page = new stdClass(); $page->ID = get_option( 'page_for_posts' ); $agni_slider = ''; $agni_slides_post_id = esc_attr(get_post_meta($page->ID, 'page_agni_sliders', true));	
	foreach ( (array) $agni_slides_post_id as $key => $slider ) {
		echo agni_slider( $slider, false );
	}
		
	echo agni_page_header( $page->ID );
} 

do_action( 'agni_posts_init', '', '', $shortcode = false ); 

get_footer(); ?>
