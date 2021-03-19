<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.8.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$product_tabs = apply_filters( 'woocommerce_product_tabs', array() );
global $post, $halena_options;

$page_layout = esc_attr( get_post_meta( $post->ID, 'page_layout', true ) );
$product_layout_style = esc_attr( get_post_meta( $post->ID, 'product_layout_style', true ) );
$product_tab_active = esc_attr( get_post_meta( $post->ID, 'product_single_tab_active', true ) );

if( $page_layout == '' ){
	$page_layout = isset($halena_options['shop-single-description-stretch'])?esc_attr( $halena_options['shop-single-description-stretch'] ):'container';
}
if( $product_layout_style == '' ){
	$product_layout_style = isset($halena_options['shop-single-layout-style'])?esc_attr( $halena_options['shop-single-layout-style'] ):'1';
}
if( $product_tab_active == '' ){
	$product_tab_active = isset($halena_options['shop-single-tab-active'])?esc_attr( $halena_options['shop-single-tab-active'] ):'';
}

if ( ! empty( $product_tabs ) ) : ?>
<div class="single-product-tabs">
	<div class="single-product-tabs-container">
		<?php if( $product_layout_style != '3' ){ ?>
			<div class="woocommerce-tabs wc-tabs-wrapper">
				<ul class="tabs wc-tabs nav nav-tabs list-inline">
					<?php foreach ( $product_tabs as $key => $product_tab ) : ?>
						<li class="<?php echo esc_attr( $key ); ?>_tab">
							<a href="#tab-<?php echo esc_attr( $key ); ?>">
								<?php echo wp_kses_post( apply_filters( 'woocommerce_product_' . $key . '_tab_title', $product_tab['title'], $key ) ); ?>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
				<?php foreach ( $product_tabs as $key => $product_tab ) : 
					if( $key != 'description' ){ 
						$page_layout = 'container';
					} ?>
					<div class="panel entry-content wc-tab" id="tab-<?php echo esc_attr( $key ); ?>">
						<div class="single-product-tab-<?php echo esc_attr( $key ); ?> single-product-tab-container <?php echo esc_html( $page_layout ); ?>">
							<div class="single-product-tab-content">
								<?php call_user_func( $product_tab['callback'], $key, $product_tab ); ?>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		<?php }
		else{ 
			$output = $title = $el_class = '';

			$acc_id = 'accordion-'.rand();
			echo '<div id="'.$acc_id.'" class="accordion panel-group accordion-style-1 text-left">';

			$active = '';
			$collapsed = 'collapsed';
			
			foreach ( $product_tabs as $key => $product_tab ){

				if( $product_tab_active == $key ){
					$active = 'in';
					$collapsed = '';
				}
				?>
			    <div class="panel <?php echo esc_attr( $key ); ?>_tab">
				    <a class="panel-title <?php echo esc_attr( $collapsed ); ?>" data-toggle="collapse" data-parent="#<?php echo esc_attr( $acc_id ); ?>" href="#tab-<?php echo esc_attr( $key ); ?>"><h6><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $product_tab['title'] ), $key ) ?></h6><span class="panel-icon"></span></a>
				    <div id="tab-<?php echo esc_attr( $key ); ?>" class="panel-body entry-content wc-tab collapse <?php echo esc_attr( $active ); ?>">
				    	<?php echo call_user_func( $product_tab['callback'], $key, $product_tab ); ?>
				    </div>
			    </div>
			    <?php
			    $active = '';
			    $collapsed = 'collapsed';
			}

			echo '</div>';

		 } ?>

		 <?php do_action( 'woocommerce_product_after_tabs' ); ?>

	</div>
</div>
<?php endif; ?>