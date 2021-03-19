<?php
/**
 * The template for displaying product category thumbnails within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product_cat.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product_layout, $halena_options;

// Extra Classes
$classes[] = 'shop-column';

?>
<?php
global $product_layout;
global $delay, $i;
$halena_options['shop-column-layout'] = ( !empty($product_layout) ) ? $product_layout : $halena_options['shop-column-layout']; 

$product_layout = null;
$shop_style = $shop_attr = '';
$thumb_args = array();


$thumb_args = array( 
	'category_thumbnail_individual_settings' => !empty($category_thumbnail_individual_settings)?$category_thumbnail_individual_settings:'', 
	'category_thumbnail_size' => !empty($category_thumbnail_size)?$category_thumbnail_size:'shop_catalog',
	'category_thumbnail_dimension' => !empty($category_thumbnail_dimension)?$category_thumbnail_dimension:'',
);

$shop_layout = esc_attr( $halena_options['shop-column-layout'] );
$shop_gutter_value = esc_attr( $halena_options['shop-gutter-value'] );
$shop_animation = esc_attr( $halena_options['shop-animation'] );
$shop_animation_style = esc_attr( $halena_options['shop-animation-style'] );
$shop_animation_delay = esc_attr( $halena_options['shop-animation-delay'] );
$shop_animation_duration = esc_attr( $halena_options['shop-animation-duration'] );
$shop_animation_offset = esc_attr( $halena_options['shop-animation-offset'] );

if( !empty($category_thumbnail_gutter) ){
	$shop_gutter_value = $category_thumbnail_gutter;
}

if( $thumb_args['category_thumbnail_individual_settings'] != '1' ){
	$term_id = $category->term_id; 
	$classes[] = esc_html( get_term_meta( $term_id, 'terms_thumbnail_width', true ) );
	$classes[] = esc_html( get_term_meta( $term_id, 'terms_thumbnail_height', true ) );
}

if( $shop_animation == '1' ){
	if( $i >= $shop_layout ){
        $delay = $i = 0;
    }
    $delay += $shop_animation_delay;
    $duration = $shop_animation_duration;
    $i += 1;
	$classes[] = ' animate';
	$shop_attr .= ' data-animation="'.esc_attr($shop_animation_style).'" data-animation-offset="'.esc_attr($shop_animation_offset).'%"';
	$shop_style .= ' -webkit-animation-duration: '.$duration.'s; -webkit-animation-delay: '.$delay.'s; animation-duration: '.$duration.'s; animation-delay: '.$delay.'s;';
}

if( !empty($shop_gutter_value) ){
	$shop_style .= ' margin: '.intval($shop_gutter_value/2).'px 0; padding: 0 '.intval($shop_gutter_value/2).'px;';
}
?>

<li <?php wc_product_cat_class( $classes, $category ); ?> style="<?php echo esc_attr( $shop_style ); ?>" <?php echo wp_kses_post( $shop_attr ); ?>>
	<?php
	/**
	 * woocommerce_before_subcategory hook.
	 *
	 * @hooked woocommerce_template_loop_category_link_open - 10
	 */
	do_action( 'woocommerce_before_subcategory', $category );

	/**
	 * woocommerce_before_subcategory_title hook.
	 *
	 * @hooked woocommerce_subcategory_thumbnail - 10
	 */
	do_action( 'woocommerce_before_subcategory_title', $category, $thumb_args );

	/**
	 * woocommerce_shop_loop_subcategory_title hook.
	 *
	 * @hooked woocommerce_template_loop_category_title - 10
	 */
	do_action( 'woocommerce_shop_loop_subcategory_title', $category );

	/**
	 * woocommerce_after_subcategory_title hook.
	 */
	do_action( 'woocommerce_after_subcategory_title', $category );

	/**
	 * woocommerce_after_subcategory hook.
	 *
	 * @hooked woocommerce_template_loop_category_link_close - 10
	 */
	do_action( 'woocommerce_after_subcategory', $category ); ?>
</li>
