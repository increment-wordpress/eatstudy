<?php

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

$empty_cart_txt 	= isset( $halena_options['shop-sidebar-cart-empty-text']) ? $halena_options['shop-sidebar-cart-empty-text'] : '';
$head_title 		= isset( $halena_options['shop-sidebar-cart-title']) ? $halena_options['shop-sidebar-cart-title']: '';
?>


<div class="xoo-wsc-header">
	<h6 class="xoo-wsc-ctxt"><?php echo esc_html( $head_title ); ?></h6>
	<span class="xoo-wsc-icon-cross xoo-wsc-close"></span>
</div>

<div class="xoo-wsc-body">
	<div class="xoo-wsc-content">
		<?php do_action( 'woocommerce_before_cart_contents' ); ?>
		<?php if(WC()->cart->is_empty()): ?>
			<span class="xoo-wsc-ecnt"><?php echo esc_html( $empty_cart_txt ); ?></span>
		<?php else: ?>

			<?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

				$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {

					$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );

					$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
					
					$product_name =  apply_filters( 'woocommerce_cart_item_name', sprintf( '<h6 class="xoo-wsc-product-title cart-product-title"><a href="%s">%s</a></h6>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key );
								

					$product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );

					?>

					<div class="xoo-wsc-product" data-xoo_wsc="<?php echo esc_attr( $cart_item_key ); ?>">
						<div class="xoo-wsc-img-col">
							<a href="<?php echo esc_url( $product_permalink ) ?>"><?php echo wp_kses( $thumbnail, array( 'img' => array( 'src' => array(), 'srcset' => array(), 'class' => array(), 'width' => array(), 'height' => array(), 'sizes' => array(), 'alt' => array() ) ) ); ?></a>
						</div>
						<div class="xoo-wsc-sum-col">
							<a href="<?php echo esc_url( $product_permalink ) ?>" class="xoo-wsc-pname"><?php echo wp_kses( $product_name, array( 'h6' => array( 'class' => array() ), 'a' => array( 'href' => array() ) ) ); ?></a>
							<?php 

							// echo ( $_product->is_type('variable') || $_product->is_type('variation') ) ? wc_get_formatted_variation($_product) : '';
							
							echo wc_get_formatted_cart_item_data( $cart_item );

							?>
							<div class="xoo-wsc-price">
								<span><?php echo wp_kses( $cart_item['quantity'], array( 'span' => array( 'class' => array() ) ) ); ?></span> x <span><?php echo wp_kses( $product_price, array( 'span' => array( 'class' => array() ) ) ); ?></span> 
							</div>
							<a href="#" class="xoo-wsc-remove"><?php echo esc_html_e('Remove','agni-halena-plugin'); ?></a>
						</div>
					</div>
				<?php } ?>
			<?php } ?>
		<?php endif; ?>

		<div class="xoo-wsc-updating">
			<span class="xoo-wsc-icon-spinner2" aria-hidden="true"></span>
			<span class="xoo-wsc-uopac"></span>
		</div>
	</div>
</div>

