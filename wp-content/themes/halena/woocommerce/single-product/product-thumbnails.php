<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version     3.5.1

 * By agnihd: still we're not using wc_get_gallery_image_html function.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post, $product, $halena_options;

$easyzoom_class = '';


$product_single_zoom = isset( $halena_options['shop-single-zoom'] )?$halena_options['shop-single-zoom']:'1';
$product_single_zoom_mobile = isset( $halena_options['shop-single-zoom-mobile'] )?$halena_options['shop-single-zoom-mobile']:'1';

$product_layout_style = esc_attr( get_post_meta( $post->ID, 'product_layout_style', true ) );
if( $product_layout_style == '' ){
	$product_layout_style = isset($halena_options['shop-single-layout-style'])?esc_attr( $halena_options['shop-single-layout-style'] ):'1';
}

if( $product_single_zoom == '1' ){
	wp_enqueue_script( 'halena-woocommerce-easyzoom' );
	$easyzoom_class = ' easyzoom easyzoom--overlay easyzoom--with-thumbnails ';

	if( $product_single_zoom_mobile == '1' ){
		$easyzoom_class .= ' easyzoom-mobile';
	}
}
if( $product_layout_style == '4' ){
	$easyzoom_class = '';
}

if( $product_layout_style == '3' || $product_layout_style == '4' ){
	$produc_single_image_size = 'full';
}
else{
	$produc_single_image_size = 'shop_single';
}


$attachment_ids = $product->get_gallery_image_ids();

if ( $attachment_ids && $product->get_image_id() ) {
	foreach ( $attachment_ids as $attachment_id ) {
		$full_size_image = wp_get_attachment_image_src( $attachment_id, 'full' );
		$thumbnail       = wp_get_attachment_image_src( $attachment_id, 'shop_thumbnail' );
		$attributes      = array(
			'title'                   => get_post_field( 'post_title', $attachment_id ),
			'data-caption'            => get_post_field( 'post_excerpt', $attachment_id ),
			'data-src'                => $full_size_image[0],
			'data-large_image'        => $full_size_image[0],
			'data-large_image_width'  => $full_size_image[1],
			'data-large_image_height' => $full_size_image[2]
		);

		$html  = '<div data-thumb="' . esc_url( $thumbnail[0] ) . '" class="woocommerce-product-gallery__image '.$easyzoom_class.'"><a href="' . esc_url( $full_size_image[0] ) . '" data-size="'.$full_size_image[1].'x'.$full_size_image[2].'">';
		$html .= '<div class="zoom-custom-gallery" style="position: absolute; top:0; left:0; right:0; bottom: 0; z-index:3;"></div>';
		if( $product_layout_style == '4' ){
			$html .= '<div class="agni-single-products-gallery-slider-bg-image" style="background-image:url('.wp_get_attachment_image_url( $attachment_id, $produc_single_image_size ).')"></div>';
		}
		else{
			$html .= wp_get_attachment_image( $attachment_id, $produc_single_image_size, false, $attributes );

		}
 		$html .= '</a></div>';

		echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $attachment_id ); // phpcs:disable WordPress.XSS.EscapeOutput.OutputNotEscaped
	}
}
