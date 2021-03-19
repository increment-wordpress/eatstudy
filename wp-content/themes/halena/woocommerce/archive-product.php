<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' ); ?>
	<?php
		global $halena_options, $post;

		$agni_slider = $yith_wishlist = ''; 

		if( is_shop() ){
			$shop_id = wc_get_page_id('shop');
		}
		else if( is_product_category() ){
			$shop_id = get_queried_object_id(); 
		}
		else{
			$shop_id = $post->ID;
		}

		if(class_exists( 'YITH_WCWL' )){
			$yith_wishlist = ' has-yith-wishlist';
		}


		if( is_product_category() ){
			$agni_slides_post_id = esc_attr( get_term_meta($shop_id, 'terms_agni_sliders', true) );
		}
		else{
			$agni_slides_post_id = esc_attr( get_post_meta($shop_id, 'page_agni_sliders', true) );	
		}

		foreach ( (array) $agni_slides_post_id as $key => $slider ) {
			echo agni_slider( $slider, false );
		}

		if( !is_product_category() ){
			echo agni_page_header( $shop_id );
		}

		$shop_column_layout = esc_attr( $halena_options['shop-column-layout'] );
		$shop_has_sidebar_sticky = esc_attr( $halena_options['shop-has-sidebar-sticky'] );
		$shop_navigation = esc_attr( $halena_options['shop-navigation'] );
	    $shop_navigation_choice = esc_attr( $halena_options['shop-navigation-choice'] );

		$page_bg_color = esc_attr( get_post_meta( $shop_id, 'page_bg_color', true ) );
		$page_remove_title = esc_attr( get_post_meta( $shop_id, 'page_remove_title', true ) );
		$page_layout = esc_attr( get_post_meta( $shop_id, 'page_layout', true ) );
		$page_sidebar = esc_attr( get_post_meta( $shop_id, 'page_sidebar', true ) );

		if( $page_remove_title == '' ){
			$page_remove_title = esc_attr( $halena_options['page-remove-title'] );
		}
		if( $page_layout == '' ){
			$page_layout = isset( $halena_options['shop-layout'] )?esc_attr( $halena_options['shop-layout'] ):'container';
		}
		if( $page_sidebar == '' ){
			$page_sidebar = esc_attr( $halena_options['shop-sidebar'] );
		}

		if( $shop_has_sidebar_sticky == '1' ){
			$shop_has_sidebar_sticky = ' has-sidebar-sticky';
		}

		//if( $shop_has_sidebar_sticky == '1' ){
			$shop_has_sidebar_toggle = ' has-sidebar-toggle';
		//}

		/*$page_layout = 'container-fluid';
		$page_sidebar = 'no-sidebar';*/
	?>
	<div class="shop page-shop shop-page-container <?php echo esc_attr( $page_layout ); ?> <?php echo esc_attr( $page_sidebar ); ?> <?php if( $page_layout == 'container-fluid' ){ echo 'has-fullwidth'; }else{ echo 'has-container'; } ?> <?php echo esc_attr( $shop_column_layout ); ?>column-layout-post<?php 
			echo esc_attr( $shop_has_sidebar_sticky );
			echo esc_attr( $shop_has_sidebar_toggle );
			if( $shop_navigation_choice == '2' || $shop_navigation_choice == '3' ){ 
                echo ' has-infinite-scroll'; 
                echo esc_attr( ( $shop_navigation_choice == '3')?' has-load-more':'' );
            } ?> <?php echo esc_attr( $yith_wishlist ); ?>" <?php if( !empty($page_bg_color) ){ echo 'style="background-color:'.$page_bg_color.'"'; } ?>>
	<?php
		/**
		 * woocommerce_before_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 * @hooked WC_Structured_Data::generate_website_data() - 30
		 */
		do_action( 'woocommerce_before_main_content' );
	?>
	<?php  if( $page_remove_title != '1' ){ ?>		
	    <header class="woocommerce-products-header">

			<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

				<h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>

			<?php endif; ?>

			<?php
				/**
				 * woocommerce_archive_description hook.
				 *
				 * @hooked woocommerce_taxonomy_archive_description - 10
				 * @hooked woocommerce_product_archive_description - 10
				 */
				do_action( 'woocommerce_archive_description' );
			?>

	    </header>
    <?php } ?>

	<?php if ( woocommerce_product_loop() ) {

		wp_enqueue_style('halena-select2-style'); 
		wp_enqueue_script('halena-select2-script'); 

		/**
		 * woocommerce_before_shop_loop hook.
		 *
		 * @hooked wc_print_notices - 10
		 * @hooked woocommerce_result_count - 20
		 * @hooked woocommerce_catalog_ordering - 30
		 * @hooked woocommerce_pagination - 31
		 * @hooked agni_woocommerce_column_switcher - 32
		 * @hooked agni_woocommerce_sidebar_toggle - 33
		 */
		
		do_action( 'woocommerce_before_shop_loop' );
		
		woocommerce_product_loop_start(); 

		if ( wc_get_loop_prop( 'total' ) ) {
			while ( have_posts() ) {
				the_post();

				/**
				 * Hook: woocommerce_shop_loop.
				 *
				 * @hooked WC_Structured_Data::generate_product_data() - 10
				 */
				do_action( 'woocommerce_shop_loop' );

				wc_get_template_part( 'content', 'product' );
			}
		}

		woocommerce_product_loop_end(); 

		/**
		 * woocommerce_after_shop_loop hook.
		 *
		 * @hooked agni_woocommerce_pagination - 10
		 */
		do_action( 'agni_woocommerce_pagination' );

		/**
		 * woocommerce_after_shop_loop hook.
		 *
		 * @hooked woocommerce_pagination - 10
		 */
		do_action( 'woocommerce_after_shop_loop' );

	} else {
		/**
		 * Hook: woocommerce_no_products_found.
		 *
		 * @hooked wc_no_products_found - 10
		 */
		do_action( 'woocommerce_no_products_found' );
	} ?>

	<?php
		/**
		 * woocommerce_after_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>

	<?php if( $page_sidebar != 'no-sidebar' ){ 
		/**
		 * woocommerce_sidebar hook.
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		do_action( 'woocommerce_sidebar' );
	} ?>
	</div>
<?php get_footer( 'shop' ); ?>
