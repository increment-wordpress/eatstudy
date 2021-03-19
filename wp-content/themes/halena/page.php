<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Agni Framework
 */
 
get_header(); ?>
<?php $agni_slider = ''; $agni_slides_post_id = esc_attr( get_post_meta($post->ID, 'page_agni_sliders', true) );	
	foreach ( (array) $agni_slides_post_id as $key => $slider ) {
		echo agni_slider( $slider, false );
	}

?>    
<?php echo agni_page_header( $post->ID ); 

agni_page();

get_footer(); ?>
