<?php
/*
   Template Name: Portfolio
 *
 * The template for displaying all portfolio.
 *
 *
 * @package halena
 */

get_header(); ?>
<?php $agni_slider = ''; $agni_slides_post_id = esc_attr( get_post_meta($post->ID, 'page_agni_sliders', true) );	
	foreach ( (array) $agni_slides_post_id as $key => $slider ) {
		echo agni_slider( $slider, false );
	}

?>   
<?php echo agni_page_header( $post->ID ); ?>

<?php do_action( 'agni_portfolio_init', '', $shortcode = false ); ?>

<?php get_footer(); ?>
