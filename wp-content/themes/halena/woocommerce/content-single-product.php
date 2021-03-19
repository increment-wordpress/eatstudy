<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

?>

<?php
	/**
	 * woocommerce_before_single_product hook
	 *
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'woocommerce_before_single_product' );

	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }
?>
<?php 
global $halena_options, $post, $product; 

wp_enqueue_style( 'halena-slick-style' );
wp_enqueue_script( 'halena-slick-script' );
        
$page_bg_color = esc_attr( get_post_meta( $post->ID, 'page_bg_color', true ) );
$page_layout = esc_attr( get_post_meta( $post->ID, 'page_layout', true ) );
$product_layout_style = esc_attr( get_post_meta( $post->ID, 'product_layout_style', true ) );
$product_cart_style = esc_attr( get_post_meta( $post->ID, 'product_cart_style', true ) );
$add_to_cart_sticky = esc_attr( get_post_meta( $post->ID, 'product_add_to_cart_sticky', true ) );

if( $page_layout == '' ){
	$page_layout = isset($halena_options['shop-single-description-stretch'])?esc_attr( $halena_options['shop-single-description-stretch'] ):'container';
}
if( $product_layout_style == '' ){
	$product_layout_style = isset($halena_options['shop-single-layout-style'])?esc_attr( $halena_options['shop-single-layout-style'] ):'1';
}
if( $product_cart_style == '' ){
	$product_cart_style = isset($halena_options['shop-single-cart-style'])?esc_attr( $halena_options['shop-single-cart-style'] ):'1';
}
if( $add_to_cart_sticky == '' ){
	$add_to_cart_sticky = isset($halena_options['shop-single-add-to-cart-sticky'])?esc_attr( $halena_options['shop-single-add-to-cart-sticky'] ):'';
}

if( $product_layout_style == '3' ){
	$product_images_col_class = 'col-xs-12 col-sm-12 col-md-8';
	$product_desc_col_class = 'col-xs-12 col-sm-12 col-md-4';
}
else if( $product_layout_style == '4' ){
	$product_images_col_class = 'col-xs-12 col-sm-12 col-md-12';
	$product_desc_col_class = 'col-xs-12 col-sm-12 col-md-12';
}
else{
	$product_images_col_class = 'col-xs-12 col-sm-12 col-md-7';
	$product_desc_col_class = 'col-xs-12 col-sm-12 col-md-5';
}

// Additional Classes
function agni_additional_post_classes( $classes ) {

    global $halena_options, $post;
	$product_layout_style = esc_attr( get_post_meta( $post->ID, 'product_layout_style', true ) );
	$product_layout_sticky = esc_attr( get_post_meta( $post->ID, 'product_layout_sticky', true ) );

	if( $product_layout_style == '' ){
		$product_layout_style = isset($halena_options['shop-single-layout-style'])?esc_attr( $halena_options['shop-single-layout-style'] ):'1';
	}
	if( $product_layout_sticky == '' ){
		$product_layout_sticky = isset($halena_options['shop-single-layout-sticky'])?esc_attr( $halena_options['shop-single-layout-sticky'] ):'';
	}
	$classes[] = 'product-style-'.$product_layout_style; 

	if( $product_layout_sticky == '1' ){
		$classes[] = 'has-single-sticky'; 
	}

    return $classes;
}
add_filter( 'post_class', 'agni_additional_post_classes' );

if( $product->is_type( 'variable' ) ){
	wp_enqueue_style('halena-select2-style'); 
	wp_enqueue_script('halena-select2-script'); 
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>
	<div class="single-product-page" <?php if( !empty($page_bg_color) ){ echo 'style="background-color:'.$page_bg_color.'"'; } ?>>
		<div class="single-product-container <?php echo 'container'; //echo esc_attr( $page_layout ); ?>">
			<div class="single-product-row row clearfix">
				<div class="<?php echo esc_html( $product_images_col_class ); ?> single-product-images">
					<?php
						/**
						 * woocommerce_before_single_product_summary hook
						 *
						 * @hooked woocommerce_show_product_sale_flash - 10
						 * @hooked woocommerce_show_product_images - 20
						 */
						do_action( 'woocommerce_before_single_product_summary' );
					?>
				</div>
				<div class="<?php echo esc_html( $product_desc_col_class ); ?> single-product-description single-product-cart-style-<?php echo esc_html( $product_cart_style ); ?>">
					<div class="single-product-description-inner">
					<div class="summary entry-summary">

						<?php
							/**
							 * woocommerce_single_product_summary hook
							 *
							 * @hooked woocommerce_breadcrumb - 4 (moved by agnihd)
							 * @hooked woocommerce_template_single_title - 5
							 * @hooked woocommerce_template_single_rating - 10
							 * @hooked woocommerce_template_single_price - 10
							 * @hooked woocommerce_template_single_excerpt - 20
							 * @hooked woocommerce_template_single_add_to_cart - 30
							 * @hooked woocommerce_template_single_meta - 40
							 * @hooked woocommerce_template_single_sharing - 50
							 * @hooked agni_framework_product_nav - 51 (added by agnihd)
			 				 * @hooked WC_Structured_Data::generate_product_data() - 60
							 */
							do_action( 'woocommerce_single_product_summary' );
						?>

					</div><!-- .summary -->
					<?php 
					/**
					 * agni_woocommerce_single_product_data_tabs hook
					 *
					 * @hooked woocommerce_output_product_data_tabs - 10
					 */
					if( $product_layout_style == '3' ){
						do_action( 'agni_woocommerce_single_product_data_tabs' );
					} 

					?>
					</div>
				</div>
			</div>
		</div>

		<?php if( $add_to_cart_sticky == '1' ){ 
			do_action( 'agni_woocommerce_single_product_add_to_cart_sticky', get_the_ID() ); 
		} ?>

	</div>
	<?php
		/**
		 * agni_woocommerce_single_product_data_tabs hook
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 */
		if( $product_layout_style != '3' ){
			do_action( 'agni_woocommerce_single_product_data_tabs' );
		}
		/**
		 * woocommerce_after_single_product_summary hook
		 *
		 * @hooked woocommerce_upsell_display - 15
		 * @hooked woocommerce_output_related_products - 20
		 */
		do_action( 'woocommerce_after_single_product_summary' );
	?>


</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>
