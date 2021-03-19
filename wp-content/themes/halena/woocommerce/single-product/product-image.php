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
 * @version 3.5.1

 * By agnihd: still we're not using wc_get_gallery_image_html function.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post, $product, $halena_options;

$agni_single_products_gallery_slider_class = $product_single_360_images_src = $custom_gallery_class = $easyzoom_class = '';

//$halena_options['shop-single-zoom'], $halena_options['shop-single-lightbox']

$product_single_zoom = isset( $halena_options['shop-single-zoom'] )?$halena_options['shop-single-zoom']:'1';
$product_single_zoom_mobile = isset( $halena_options['shop-single-zoom-mobile'] )?$halena_options['shop-single-zoom-mobile']:'1';
$product_single_lightbox = isset( $halena_options['shop-single-lightbox'] )?$halena_options['shop-single-lightbox']:'1';

$agni_single_product_slider_nav_for = 'agni-single-products-gallery-slider-nav';
$agni_single_product_slider_slider_for = 'agni-single-products-gallery-slider-for';

$agni_single_product_slider_vertical = 'true';
$agni_single_product_slider_swipe_to_slide = 'false';
$agni_single_product_slider_infinite = 'false';
$agni_single_product_slider_rtl = ( is_rtl() )?'true':'false';
$agni_single_product_slider_prev_arrow = '<div class="slick-arrow-prev"><span class="agni-slick-arrows"><i class="icon-arrows-up"></span></div>';
$agni_single_product_slider_next_arrow = '<div class="slick-arrow-next"><span class="agni-slick-arrows"><i class="icon-arrows-down"></span></div>';

$agni_single_product_slider_for_arrows = 'false';
$agni_single_product_slider_for_dots = 'false';

$product_layout_style = esc_attr( get_post_meta( $post->ID, 'product_layout_style', true ) );
$product_single_360_images = get_post_meta( $post->ID, 'product_360_image', true );
$product_single_video = esc_attr( get_post_meta( $post->ID, 'product_video_url', true ) );

$attachment_ids = $product->get_gallery_image_ids(); 

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
if( $product_single_lightbox == '1' ){
	$custom_gallery_class = ' custom-gallery';
}
if( $product_layout_style == '4' ){
	$easyzoom_class = $custom_gallery_class = $agni_single_product_slider_nav_for = '';
	$agni_single_product_slider_for_arrows = 'true';
	$agni_single_product_slider_for_dots = 'true';
	$agni_single_product_slider_prev_arrow = '<div class="slick-arrow-prev"><span class="agni-slick-arrows"><i class="icon-arrows-left"></span></div>';
	$agni_single_product_slider_next_arrow = '<div class="slick-arrow-next"><span class="agni-slick-arrows"><i class="icon-arrows-right"></span></div>';
}

if( $product_layout_style != '3' ){
	$agni_single_products_gallery_slider_class = 'agni-single-products-gallery-slider';
}

if( $product_layout_style == '3' || $product_layout_style == '4' ){
	$produc_single_image_size = 'full';
	add_filter( 'woocommerce_available_variation', 'change_variation_descriptions', 10, 3 );
	function change_variation_descriptions( $data, $product, $variation ) {
		
		$data['image']['src'] = $data['image']['full_src'];
		$data['image']['src_w'] = $data['image']['full_src_w'];
		$data['image']['src_h'] = $data['image']['full_src_h'];
		$data['image']['sizes'] = '(max-width: '.$data['image']['full_src_w'].'px) 100vw, '.$data['image']['full_src_w'].'px';
		
	    return $data;     
	} 
}
else{
	$produc_single_image_size = 'shop_single';
}

if( $product_layout_style == '2' ){
	$agni_single_product_slider_vertical = 'false';
	$agni_single_product_slider_swipe_to_slide = 'true';
	$agni_single_product_slider_infinite = 'true';
	$agni_single_product_slider_prev_arrow = '<div class="slick-arrow-prev"><span class="agni-slick-arrows"><i class="icon-arrows-left"></span></div>';
	$agni_single_product_slider_next_arrow = '<div class="slick-arrow-next"><span class="agni-slick-arrows"><i class="icon-arrows-right"></span></div>';
}


$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
$post_thumbnail_id = $product->get_image_id();
$wrapper_classes   = apply_filters( 'woocommerce_single_product_image_gallery_classes', array(
	'woocommerce-product-gallery',
	'woocommerce-product-gallery--' . ( $product->get_image_id() ? 'with-images' : 'without-images' ),
	'woocommerce-product-gallery--columns-' . absint( $columns ),
	'images',
	'agni-single-products-gallery',
	$agni_single_products_gallery_slider_class,
	''
) );

?>
<div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>" data-columns="<?php echo esc_attr( $columns ); ?>" style="opacity: 0; transition: opacity .25s ease-in-out;">
	<div class="agni-single-products-gallery-wrapper">
		<figure class="woocommerce-product-gallery__wrapper <?php echo esc_attr( $agni_single_product_slider_slider_for.$custom_gallery_class ); ?>"  data-slick-slides-to-show="1" data-slick-slides-to-scroll="1" data-slick-arrows="<?php echo esc_attr( $agni_single_product_slider_for_arrows ); ?>" data-slick-prev-arrow="<?php echo htmlspecialchars(json_encode($agni_single_product_slider_prev_arrow)); ?>" data-slick-next-arrow="<?php echo htmlspecialchars(json_encode($agni_single_product_slider_next_arrow)); ?>" data-slick-dots="<?php echo esc_attr( $agni_single_product_slider_for_dots ); ?>" data-slick-infinite="false" data-slick-fade="true" data-slick-speed="300" data-slick-adaptive-height="true" data-slick-nav-for="<?php echo (!empty($agni_single_product_slider_nav_for))?'.'.esc_attr( $agni_single_product_slider_nav_for ):''; ?>" data-rtl="<?php echo esc_attr( $agni_single_product_slider_rtl ); ?>">
			<?php 

			$thumbnail_size    = apply_filters( 'woocommerce_product_thumbnails_large_size', 'full' );
			$full_size_image   = wp_get_attachment_image_src( $post_thumbnail_id, $thumbnail_size );

			$attributes = array(
				'title'                   => get_post_field( 'post_title', $post_thumbnail_id ),
				'data-caption'            => get_post_field( 'post_excerpt', $post_thumbnail_id ),
				'data-src'                => $full_size_image[0],
				'data-large_image'        => $full_size_image[0],
				'data-large_image_width'  => $full_size_image[1],
				'data-large_image_height' => $full_size_image[2],
			);

			if ( $product->get_image_id() ) {
				wp_enqueue_style('halena-photoswipe-style'); 
				wp_enqueue_script('halena-photoswipe-script');

				$html  = '<div data-thumb="' . get_the_post_thumbnail_url( $post->ID, 'shop_thumbnail' ) . '" class="woocommerce-product-gallery__image '.$easyzoom_class.'"><a href="' . esc_url( $full_size_image[0] ) . '" data-size="'.$full_size_image[1].'x'.$full_size_image[2].'">';
				$html .= '<div class="zoom-custom-gallery" style="position: absolute; top:0; left:0; right:0; bottom: 0; z-index:9;"></div>';
				if( $product_layout_style == '4' ){
					$html .= '<div class="agni-single-products-gallery-slider-bg-image" style="background-image:url('.get_the_post_thumbnail_url( $post->ID, 'full' ).')"></div>';
				}
				else{
					$html .= get_the_post_thumbnail( $post->ID, $produc_single_image_size, $attributes );
				}
				$html .= '</a></div>';

			} else {
				$html  = '<div class="woocommerce-product-gallery__image--placeholder">';
				$html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src( 'woocommerce_single' ) ), esc_html__( 'Awaiting product image', 'halena' ) );
				$html .= '</div>';
			}
			

			echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id ); // phpcs:disable WordPress.XSS.EscapeOutput.OutputNotEscaped
			
			do_action( 'woocommerce_product_thumbnails' );
			?>
		</figure>
	</div>
	<?php if( !empty($attachment_ids) || !empty($product_single_360_images) || !empty($product_single_video) ){ ?>
		<div class="agni-single-products-gallery-slider-nav-container">
			<?php if( $product_layout_style != '3' && $product_layout_style != '4' && !empty($attachment_ids) ){ ?>
				<div class="<?php echo esc_attr( $agni_single_product_slider_nav_for ); ?>" data-slick-slides-to-show="<?php echo (count($attachment_ids) < 4)?esc_attr( count($attachment_ids) + 1 ):'4'; ?>" data-slick-slides-to-scroll="1" data-slick-arrows="true" data-slick-prev-arrow="<?php echo htmlspecialchars(json_encode($agni_single_product_slider_prev_arrow)); ?>" data-slick-next-arrow="<?php echo htmlspecialchars(json_encode($agni_single_product_slider_next_arrow)); ?>" data-slick-infinite="<?php echo esc_attr( $agni_single_product_slider_infinite ); ?>" data-slick-dots="false" data-slick-center-mode="true" data-slick-center-padding="0" data-swipe-to-slide="<?php echo esc_attr( $agni_single_product_slider_swipe_to_slide ); ?>" data-slick-vertical="<?php echo esc_attr( $agni_single_product_slider_vertical ); ?>" data-slick-vertical-swiping="true" data-slick-focus-on-select="true"  data-slick-slider-for="<?php echo (!empty($agni_single_product_slider_slider_for))?'.'.esc_attr( $agni_single_product_slider_slider_for ):''; ?>" data-rtl="<?php echo esc_attr( $agni_single_product_slider_rtl ); ?>"><?php 
					$products_nav = '<div class="agni-single-products-thumb">'.get_the_post_thumbnail( $post->ID, 'shop_thumbnail' ).'</div>'; 
					foreach ($attachment_ids as $attachment_id) {
						$products_nav .= '<div class="agni-single-products-thumb">'.wp_get_attachment_image( $attachment_id, 'shop_thumbnail', false ).'</div>';
					}
					echo wp_kses_post( $products_nav ); 
				?>
				</div>
			<?php } ?>
			<?php if( !empty($product_single_360_images) ){ 
				wp_enqueue_style( 'halena-threesixty-style' );
				wp_enqueue_script( 'halena-threesixty-script' );
		        $product_single_360_images_src = array_values($product_single_360_images);
		        $img_size = getimagesize($product_single_360_images_src[0]); ?>

				<div class="products-single-360-container">
					<a href="#" class="products-single-360-btn products-single-360-btn-open"><img width="50" height="44" src="<?php echo esc_url( AGNI_FRAMEWORK_URL ) ?>/img/agni-360deg.png" /></a>

					<div class="products-single-360-inner">
						<div class="products-single-360-inner-overlay"></div>
						<div class="threesixty threesixty-container" data-360-array="<?php echo htmlspecialchars(json_encode($product_single_360_images_src)); ?>" data-360-array-count="<?php echo count( $product_single_360_images_src ); ?>" data-360-array-image-width="<?php echo esc_attr( $img_size[0] ); ?>" data-360-array-image-height="<?php echo esc_attr( $img_size[1] ); ?>" data-360-array-ext="<?php echo pathinfo($product_single_360_images_src[0], PATHINFO_EXTENSION); ?>">
						    <div class="spinner">
						        <span>0%</span>
						    </div>
						    <ol class="threesixty_images"></ol>
						</div>
					</div>
					<a href="#" class="products-single-360-btn products-single-360-btn-close"><i class="icon-arrows-remove"></i></a>
				</div>
			<?php } ?>
			<?php if( !empty($product_single_video) ){ ?>
				<div class="products-single-video-container custom-video-link">
					<button class="products-single-video-btn" data-modal='<?php echo esc_html( $product_single_video ); ?>'><img width="50" height="44" src="<?php echo esc_url( AGNI_FRAMEWORK_URL ) ?>/img/agni-play.png" /></button>
				</div>
			<?php } ?>

		</div>
	<?php } ?>
</div>

<?php 
?>
