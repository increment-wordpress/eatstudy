<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>

	<?php
		global $halena_options, $post;

		$agni_slides_post_id = esc_attr( get_post_meta($post->ID, 'page_agni_sliders', true) );	
		foreach ( (array) $agni_slides_post_id as $key => $slider ) {
			echo agni_slider( $slider, false );
		}

		echo agni_page_header( $post->ID );


		$page_remove_title = esc_attr( get_post_meta( $post->ID, 'page_remove_title', true ) );
		$page_sidebar = esc_attr( get_post_meta( $post->ID, 'page_sidebar', true ) );


		if( $page_remove_title == '' ){
			$page_remove_title = esc_attr( $halena_options['page-remove-title'] );
		}
		if( $page_sidebar == '' ){
			$page_sidebar = isset($halena_options['shop-single-sidebar'])?esc_attr( $halena_options['shop-single-sidebar'] ):'no-sidebar';
		}

	?>
	<div class="shop page-single-shop">
		<div class="page-single-shop-container">
			<?php
				/**
				 * woocommerce_before_main_content hook
				 *
				 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
				 * @hooked woocommerce_breadcrumb - 20
				 */
				do_action( 'woocommerce_before_main_content' );
			?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php wc_get_template_part( 'content', 'single-product' ); ?>

				<?php endwhile; // end of the loop. ?>
			

			<?php
				/**
				 * woocommerce_after_main_content hook
				 *
				 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
				 */
				do_action( 'woocommerce_after_main_content' );
			?>
			<?php
				if( $page_sidebar != 'no-sidebar' ){ 
					/**
					 * woocommerce_sidebar hook
					 *
					 * @hooked woocommerce_get_sidebar - 10
					 */
					do_action( 'woocommerce_sidebar' );

				}
			?>
		</div>
	</div>

<?php get_footer( 'shop' ); ?>
