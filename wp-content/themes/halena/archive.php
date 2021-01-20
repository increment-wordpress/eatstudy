<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Agni Framework
 */

get_header(); 

$term_meta_id = get_queried_object_id(); 

$agni_slides_term_id = esc_attr( get_term_meta( $term_meta_id, 'terms_agni_sliders', true) );
foreach ( (array) $agni_slides_term_id as $key => $slider ) {
	echo agni_slider( $slider, false );
}

do_action( 'agni_posts_init', '', $archive = true, $shortcode = false ); 

get_footer(); ?>
