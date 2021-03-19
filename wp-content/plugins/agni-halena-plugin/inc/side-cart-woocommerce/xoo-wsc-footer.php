<?php

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


$subtotal_txt 		= isset($halena_options['shop-sidebar-cart-subtotal-label']) ? $halena_options['shop-sidebar-cart-subtotal-label'] : ''; //Subtotal Text
$cart_txt 			= isset($halena_options['shop-sidebar-cart-cart-label']) ? $halena_options['shop-sidebar-cart-cart-label'] : ''; //Cart Text
$chk_txt 			= isset($halena_options['shop-sidebar-cart-checkout-label']) ? $halena_options['shop-sidebar-cart-checkout-label'] : ''; //Checkout Text
$cont_txt 			= isset($halena_options['shop-sidebar-cart-shop-label']) ? $halena_options['shop-sidebar-cart-shop-label'] : ''; //Continue Text
//shop-sidebar-cart-shop-label, 
$cont_txt_link		= isset($halena_options['shop-sidebar-cart-shop-link']) ? $halena_options['shop-sidebar-cart-shop-link'] : '';
?>

<?php if(!empty($cart_txt) || !empty($chk_txt) || !empty($cont_txt)): // If any footer button exists , add footer div ?>

	<div class="xoo-wsc-footer">

		<div class="xoo-wsc-footer-a">
			<h6 class="xoo-wsc-subtotal">
				<span><?php echo esc_html($subtotal_txt) ?></span> <?php echo wc_price(WC()->cart->subtotal); ?>
			</h6>
		</div>

		<div class="xoo-wsc-footer-b">
			<?php $hide_btns = WC()->cart->is_empty() ? 'style="display: none;"' : '';?>

			<?php if(!empty($cart_txt)): ?>
				<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="button xoo-wsc-cart btn" <?php echo esc_attr( $hide_btns ); ?>><?php echo esc_html($cart_txt); ?></a>
			<?php endif; ?>

			<?php if(!empty($chk_txt)): ?>
				<a  href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="button xoo-wsc-chkt btn" <?php echo esc_attr( $hide_btns ); ?>><?php echo esc_html($chk_txt); ?></a>
			<?php endif; ?>

			<?php if(!empty($cont_txt)): ?>
				<a  href="<?php echo esc_url( !empty($cont_txt_link)?$cont_txt_link:'#'); ?>" class="xoo-wsc-cont"><?php echo esc_html( $cont_txt ); ?></a>
			<?php endif; ?>
		</div>

	</div>

	<?php endif; ?>

</div>