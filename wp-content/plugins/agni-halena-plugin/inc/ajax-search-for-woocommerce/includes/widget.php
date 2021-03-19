<?php

if ( class_exists( 'WC_Widget' ) ) {


	add_action( 'widgets_init', function() {
		register_widget( 'AGNIDGWT_WCAS_Search_Widget' );
	} );

	class AGNIDGWT_WCAS_Search_Widget extends WC_Widget {

		/**
		 * Constructor
		 */
		public function __construct() {

			
			$this->widget_cssclass		 = 'woocommerce widget_search agnidgwt_wcas_ajax_search';
			$this->widget_description	 = __( 'Ajax (live) search form for WooCommerce', 'agni-halena-plugin' );
			$this->widget_id			 = 'agnidgwt_wcas_ajax_search';
			$this->widget_name			 = __( 'Woo Ajax Search', 'agni-halena-plugin' );
			$this->settings				 = array(
				'title'			 => array(
					'type'	 => 'text',
					'std'	 => '',
					'label'	 => __( 'Title', 'agni-halena-plugin' )
				)
			);


			parent::__construct();
		}

		/**
		 * Outputs the content of the widget
		 *
		 * @param array $args
		 * @param array $instance
		 */
		public function widget( $args, $instance ) {

			$this->widget_start( $args, $instance );

			echo agnidgwt_wcas_get_search_form();

			$this->widget_end( $args );
		}

	}

}