<?php
/**
 * The Template for displaying all single posts.
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

agni_portfolio_single();
?>

<?php get_footer(); ?>