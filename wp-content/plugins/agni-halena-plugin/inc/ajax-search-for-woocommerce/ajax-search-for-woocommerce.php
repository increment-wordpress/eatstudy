<?php

/**
 * Plugin Name: AJAX Search for WooCommerce
 * Plugin URI: https://wordpress.org/plugins/ajax-search-for-woocommerce/
 * Description: Allows your customers to search products easily and quickly. It will display the results instantly while typing in an inputbox.
 * Version: 1.1.6
 * Author: Damian Góra
 * Author URI: http://damiangora.com
 * Text Domain: ajax-search-for-woocommerce
 * Domain Path: /languages/
 * 
 */
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

if ( !class_exists( 'AGNIDGWT_WC_Ajax_Search' ) ) {

	final class AGNIDGWT_WC_Ajax_Search {

		private static $instance;
		private $tnow;
		public $settings;
		public $search;
		//public $result_details;

		public static function get_instance() {
			if ( !isset( self::$instance ) && !( self::$instance instanceof AGNIDGWT_WC_Ajax_Search ) ) {

				self::$instance = new AGNIDGWT_WC_Ajax_Search;
				
				self::$instance->constants();
				
				self::$instance->includes();
				//self::$instance->hooks();

				self::$instance->settings		 = new AGNIDGWT_WCAS_Settings;
				self::$instance->search			 = new AGNIDGWT_WCAS_Search;
				//self::$instance->result_details	 = new AGNIDGWT_WCAS_Result_Details;
			}
			self::$instance->tnow = time();

			return self::$instance;
		}

		/**
		 * Constructor Function
		 */
		private function __construct() {
			self::$instance = $this;
		}

		/**
		 * Setup plugin constants
		 */
		private function constants() {

			$this->define( 'AGNIDGWT_WCAS_VERSION', '1.1.6' );
			$this->define( 'AGNIDGWT_WCAS_NAME', 'Ajax Search for WooCommerce' );
			$this->define( 'AGNIDGWT_WCAS_FILE', __FILE__ );
			$this->define( 'AGNIDGWT_WCAS_DIR', plugin_dir_path(__FILE__) );
			$this->define( 'AGNIDGWT_WCAS_URL', plugin_dir_url(__FILE__) );

			$this->define( 'AGNIDGWT_WCAS_SETTINGS_KEY', 'agnidgwt_wcas_settings' );

			$this->define( 'AGNIDGWT_WCAS_SEARCH_ACTION', 'agnidgwt_wcas_ajax_search' );
			$this->define( 'AGNIDGWT_WCAS_RESULT_DETAILS_ACTION', 'agnidgwt_wcas_result_details' );

			$this->define( 'AGNIDGWT_WCAS_WOO_PRODUCT_POST_TYPE', 'product' );
			$this->define( 'AGNIDGWT_WCAS_WOO_PRODUCT_CATEGORY', 'product_cat' );
			$this->define( 'AGNIDGWT_WCAS_WOO_PRODUCT_TAG', 'product_tag' );

			$this->define( 'AGNIDGWT_WCAS_WC_AJAX_ENDPOINT', true );


			$this->define( 'AGNIDGWT_WCAS_DEBUG', true );


		}

		/**
		 * Define constant if not already set
		 * @param  string $name
		 * @param  string|bool $value
		 */
		private function define( $name, $value ) {
			if ( !defined( $name ) ) {
				define( $name, $value );
			}
		}

		/**
		 * Include required core files.
		 */
		public function includes() {

			require_once AGNIDGWT_WCAS_DIR . 'includes/functions.php';

			require_once AGNIDGWT_WCAS_DIR . 'includes/admin/settings/class-settings.php';

			require_once AGNIDGWT_WCAS_DIR . 'includes/register-scripts.php';

			require_once AGNIDGWT_WCAS_DIR . 'includes/widget.php';
			require_once AGNIDGWT_WCAS_DIR . 'includes/class-search.php';
		}


	}

}

// Init the plugin
function AGNIDGWT_WCAS() {
	return AGNIDGWT_WC_Ajax_Search::get_instance();
}

add_action( 'woocommerce_init', 'AGNIDGWT_WCAS' );
