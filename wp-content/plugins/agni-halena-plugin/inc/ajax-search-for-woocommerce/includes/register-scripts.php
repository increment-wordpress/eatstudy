<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

class AGNIDGWT_WCAS_Scripts {

	function __construct() {

		add_action( 'wp_enqueue_scripts', array( $this, 'js_scripts' ) );

		//add_action( 'wp_print_styles', array( $this, 'css_style' ) );
	}

	/*
	 * Register scripts.
	 * Uses a WP hook wp_enqueue_scripts
	 */

	public function js_scripts() {

		if ( !is_admin() ) {

			//Strings translation
			$t = array(
				'sale_badge'	 => _x( 'sale', 'For product badge: on sale', 'agni-halena-plugin' ),
				'featured_badge' => _x( 'featured', 'For product badge: featured', 'agni-halena-plugin' ),
			);

			// Main JS
			$localize = array(
				't'						 => $t,
				'ajax_search_endpoint'	 => agnidgwt_wcas_get_admin_ajax_url( array( 'action', AGNIDGWT_WCAS_SEARCH_ACTION ) ),
				'ajax_details_endpoint'	 => agnidgwt_wcas_get_admin_ajax_url(),
				'action_search'			 => AGNIDGWT_WCAS_SEARCH_ACTION,
				'action_result_details'	 => AGNIDGWT_WCAS_RESULT_DETAILS_ACTION,
				'details_box_pos'		 => false, //AGNIDGWT_WCAS()->settings->get_opt( 'details_box_position' ),
				'min_chars'				 => 1,
				'width'					 => 'auto',
				'show_details_box'		 => false,
				'show_images'			 => true, //false,
				'show_price'			 => true, //false,
				'show_desc'				 => false,
				'show_sale_badge'		 => false,
				'show_featured_badge'	 => false,
				'is_rtl'				 => is_rtl() == true ? true : false,
				'show_preloader'		 => true, //false,
				'preloader_url'			 => '',
			);

			// Ajax by wc-ajax fontnd endpoint
			if ( AGNIDGWT_WCAS_WC_AJAX_ENDPOINT && class_exists( 'WC_AJAX' ) ) {
				$localize[ 'ajax_search_endpoint' ]	 = WC_AJAX::get_endpoint( AGNIDGWT_WCAS_SEARCH_ACTION );
				$localize[ 'ajax_details_endpoint' ] = WC_AJAX::get_endpoint( AGNIDGWT_WCAS_RESULT_DETAILS_ACTION );

				//@todo custom endpoint
			}

			// Min characters
			/*$min_chars = AGNIDGWT_WCAS()->settings->get_opt( 'min_chars' );
			if ( !empty( $min_chars ) && is_numeric( $min_chars ) ) {
				$localize[ 'min_chars' ] = absint( $min_chars );
			}*/
			
			$sug_width = AGNIDGWT_WCAS()->settings->get_opt( 'sug_width' );
			if ( !empty( $sug_width ) && is_numeric( $sug_width ) && $sug_width > 100 ) {
				$localize[ 'sug_width' ] = absint( $sug_width );
			}
						


			// Show/hide details BOX
			if ( AGNIDGWT_WCAS()->settings->get_opt( 'show_details_box' ) === 'on' ) {
				$localize[ 'show_details_box' ] = true;
			}

			// Show/hide images
			if ( AGNIDGWT_WCAS()->settings->get_opt( 'show_product_image' ) === 'on' ) {
				$localize[ 'show_images' ] = true;
			}

			// Show/hide price
			if ( AGNIDGWT_WCAS()->settings->get_opt( 'show_product_price' ) === 'on' ) {
				$localize[ 'show_price' ] = true;
			}

			// Show/hide description
			if ( AGNIDGWT_WCAS()->settings->get_opt( 'show_product_desc' ) === 'on' ) {
				$localize[ 'show_desc' ] = true;
			}

			// Show/hide description
			if ( AGNIDGWT_WCAS()->settings->get_opt( 'show_product_sku' ) === 'on' ) {
				$localize[ 'show_sku' ] = true;
			}

			// Show/hide sale badge
			if ( AGNIDGWT_WCAS()->settings->get_opt( 'show_sale_badge' ) === 'on' ) {
				$localize[ 'show_sale_badge' ] = true;
			}

			// Show/hide featured badge
			if ( AGNIDGWT_WCAS()->settings->get_opt( 'show_featured_badge' ) === 'on' ) {
				$localize[ 'show_featured_badge' ] = true;
			}
			
			// Set preloader
			if ( AGNIDGWT_WCAS()->settings->get_opt( 'show_preloader' ) === 'on' ) {
				$localize[ 'show_preloader' ] = true;

				$localize[ 'preloader_url' ] = esc_url( trim( AGNIDGWT_WCAS()->settings->get_opt( 'preloader_url' ) ) );
			}

			if ( AGNIDGWT_WCAS_DEBUG === false ) {
				//wp_register_script( 'jquery-agnidgwt-wcas', AGNIDGWT_WCAS_URL . 'assets/js/jquery.agnidgwt-wcas.min.js', array( 'jquery' ), AGNIDGWT_WCAS_VERSION, true );
			} else {
				wp_register_script( 'jquery-agnidgwt-wcas', AGNIDGWT_WCAS_URL . 'assets/js/jquery.agnidgwt-wcas.js', array( 'jquery' ), AGNIDGWT_WCAS_VERSION, true );
			}
			wp_localize_script( 'jquery-agnidgwt-wcas', 'agnidgwt_wcas', $localize );
		}
	}

	/*
	 * Register and enqueue style
	 * Uses a WP hook wp_print_styles
	 */

	public function css_style() {

		// Main CSS
		wp_register_style( 'agnidgwt-wcas-style', AGNIDGWT_WCAS_URL . 'assets/css/style.css', array(), AGNIDGWT_WCAS_VERSION );

		wp_enqueue_style( 'agnidgwt-wcas-style' );
	}

}

$attach_scripts = new AGNIDGWT_WCAS_Scripts;
?>