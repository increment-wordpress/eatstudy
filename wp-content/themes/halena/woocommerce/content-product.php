<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
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

global $product, $halena_options, $i, $delay;

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

// Extra post classes
$classes[] = 'shop-column';
?>
<?php
global $product_layout;
$shop_column_layout = ( !empty($product_layout) ) ? $product_layout : $halena_options['shop-column-layout']; 
$shop_hover_style = isset( $halena_options['shop-thumbnail-hover-style'] )?$halena_options['shop-thumbnail-hover-style']:'2';

$shop_hover_style = isset( $product_hover_style )?$product_hover_style:$shop_hover_style;


$classes[] = 'product-hover-style-'.$shop_hover_style;

$shop_style = $shop_attr = $product_content_css = '';

$shop_layout = esc_attr( $shop_column_layout );
$shop_gutter_value = esc_attr( $halena_options['shop-gutter-value'] );
$shop_out_of_stock_label = !empty($halena_options['shop-out-of-stock-label'])?esc_html( $halena_options['shop-out-of-stock-label'] ):'';
$shop_animation = esc_attr( $halena_options['shop-animation'] );
$shop_animation_style = esc_attr( $halena_options['shop-animation-style'] );
$shop_animation_delay = esc_attr( $halena_options['shop-animation-delay'] );
$shop_animation_duration = esc_attr( $halena_options['shop-animation-duration'] );
$shop_animation_offset = esc_attr( $halena_options['shop-animation-offset'] );
$shop_product_content_align = esc_attr( $halena_options['shop-product-content-align'] );
$shop_quick_view = isset($halena_options['shop-quickview'])?esc_attr( $halena_options['shop-quickview'] ):'1';

// processing shortcode values
$shop_gutter_value = isset($product_gutter)?$product_gutter:$shop_gutter_value;
$shop_product_content_align = isset($product_content_align)?$product_content_align:$shop_product_content_align;

if( isset($product_content_padding) ){
	$product_content_css = 'style="'.$product_content_padding.'"';
}


$classes[] = 'text-'.$shop_product_content_align;
 
$shop_style = isset( $product_bg )? 'background-color:'.$product_bg.';':$shop_style;

if( $shop_animation == '1' ){
	if( $i >= $shop_layout ){
        $delay = $i = 0;
    }
    $delay += $shop_animation_delay;
    $duration = $shop_animation_duration;
    $i += 1;
	$classes[] = ' animate';
	$shop_attr = ' data-animation="'.esc_attr($shop_animation_style).'" data-animation-offset="'.esc_attr($shop_animation_offset).'%"';
	$shop_style .= ' -webkit-animation-duration: '.$duration.'s; -webkit-animation-delay: '.$delay.'s; animation-duration: '.$duration.'s; animation-delay: '.$delay.'s;';
}

if( !empty($shop_gutter_value) ){
	$shop_style .= ' margin: '.intval($shop_gutter_value/2).'px 0; padding: 0 '.intval($shop_gutter_value/2).'px;';
}

?>
<li <?php wc_product_class( $classes, $product ); ?> style="<?php echo esc_attr( $shop_style ); ?>" <?php echo wp_kses_post( $shop_attr ); ?>>
	
	<?php
	echo '<div class="product-thumbnail">';

		/**
		 * Hook: woocommerce_before_shop_loop_item hook.
		 *
		 * @hooked woocommerce_template_loop_product_link_open - 10
		 */
		do_action( 'woocommerce_before_shop_loop_item' );

		/**
		 * Hook: woocommerce_before_shop_loop_item_title hook.
		 *
		 * @hooked woocommerce_show_product_loop_sale_flash - 10
		 * @hooked woocommerce_template_loop_product_thumbnail - 10
		 */
		do_action( 'woocommerce_before_shop_loop_item_title' );

		do_action( 'agni_template_loop_product_link_close' ); 

		echo '<div class="buttons product-buttons">';
		
			/**
			 * Hook: woocommerce_after_shop_loop_item hook.
			 *
			 * @hooked woocommerce_template_loop_product_link_close - 5
			 * @hooked woocommerce_template_loop_add_to_cart - 10
			 */
			do_action( 'woocommerce_after_shop_loop_item' ); 

			if( $shop_quick_view == '1' ){
				// Agni Quick view button
				wp_enqueue_script( 'wc-add-to-cart-variation' );
				echo '<a class="agni-quick-view-btn" href="#" data-product-id="'.esc_attr( $product->get_id() ).'" data-quick-view-btn-text="'.esc_attr__( 'Loading!', 'halena' ).'">'.esc_html__( 'Quick View', 'halena' ).'</a>';
			}
		
		echo '</div>';

		if(class_exists( 'YITH_WCWL' )){
			echo do_shortcode('[yith_wcwl_add_to_wishlist]');
		}

	echo '</div>';
	/**
	 * Hook: woocommerce_shop_loop_item_title hook.
	 *
	 * @hooked woocommerce_template_loop_product_title - 10
	 */
	echo '<div class="product-content" '.$product_content_css.'>';
		do_action( 'woocommerce_shop_loop_item_title' );

		/**
		 * Hook: woocommerce_after_shop_loop_item_title hook.
		 *
		 * @hooked woocommerce_template_loop_rating - 5
		 * @hooked woocommerce_template_loop_price - 10
		 */
		echo '<div class="product-meta">';
		
			do_action( 'woocommerce_after_shop_loop_item_title' );
		
		echo '</div>';
	echo '</div>';
		

	// display an 'Out of Stock' label on archive pages
	// if ( ! $product->managing_stock() && ! $product->is_in_stock() ){
	//     echo '<p class="stock out-of-stock-label agni-out-of-stock-label">'.esc_html( $shop_out_of_stock_label ).'</p>';
	// }

	if( $product->managing_stock() ){
		$stocks = $product->get_stock_quantity(); //number_format($product->stock,0,'','');
		if( $stocks <= 0 && !$product->backorders_allowed()){
			echo '<p class="stock out-of-stock-label agni-out-of-stock-label">'.esc_html( $shop_out_of_stock_label ).'</p>';
		}		
	}
	else if( !$product->is_in_stock() ){
		echo '<p class="stock out-of-stock-label agni-out-of-stock-label">'.esc_html( $shop_out_of_stock_label ).'</p>';
	}

	?>

</li>
