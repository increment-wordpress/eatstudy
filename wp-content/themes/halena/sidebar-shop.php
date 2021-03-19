<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Agni Framework
 */

if ( ! is_active_sidebar( 'halena-sidebar-2' ) ) {
	return;
}
?>

<div id="secondary" class="widget-area sidebar shop-sidebar shop-sidebar-wrap" role="complementary">
	<div class="shop-sidebar-overlay"></div>
	<div class="shop-sidebar-container">
		<?php dynamic_sidebar( 'halena-sidebar-2' ); ?>
	</div>
</div><!-- #secondary -->
