<?php

/**
 * Settings API data
 */
class AGNIDGWT_WCAS_Settings {
	/*
	 * @var string
	 * Unique settings slug
	 */

	private $setting_slug = AGNIDGWT_WCAS_SETTINGS_KEY;

	/*
	 * @var array
	 * All options values in one array
	 */
	public $opt;

	/*
	 * @var object
	 * Settings API object
	 */
	public $settings_api;

	public function __construct() {
		global $agnidgwt_wcas_settings;

		// Set global variable with settings
		$settings = get_option( $this->setting_slug );
		if ( !isset( $settings ) || empty( $settings ) ) {
			$agnidgwt_wcas_settings = array();
		} else {
			$agnidgwt_wcas_settings = $settings;
		}

		$this->opt = $agnidgwt_wcas_settings;

	}

	/*
	 * Set settings sections
	 * 
	 * @return array settings sections
	 */

	public function settings_sections() {

		$sections = array(
			array(
				'id'	 => 'agnidgwt_wcas_basic',
				'title'	 => __( 'Basic', 'agni-halena-plugin' )
			),
			array(
				'id'	 => 'agnidgwt_wcas_advanced',
				'title'	 => __( 'Advanced', 'agni-halena-plugin' )
			),
			array(
				'id'	 => 'agnidgwt_wcas_details_box',
				'title'	 => __( 'Extra Details', 'agni-halena-plugin' )
			),
			array(
				'id'	 => 'agnidgwt_wcas_style',
				'title'	 => __( 'Style', 'agni-halena-plugin' )
			),
//			array(
//				'id'	 => 'agnidgwt_wcas_performance',
//				'title'	 => __( 'Performance', 'agni-halena-plugin' )
//			)
		);
		return apply_filters( 'agnidgwt_wcas_settings_sections', $sections );
	}

	/**
	 * Create settings fields
	 *
	 * @return array settings fields
	 */
	function settings_fields() {
		$settings_fields = array(
			'agnidgwt_wcas_basic'		 => apply_filters( 'agnidgwt_wcas_basic_settings', array(
				array(
					'name'		 => 'suggestions_limit',
					'label'		 => __( 'Suggestions limit', 'agni-halena-plugin' ),
					'type'		 => 'number',
					'size'		 => 'small',
					'desc'		 => __( 'Maximum number of suggestions rows.', 'agni-halena-plugin' ),
					'default'	 => 10,
				),
				array(
					'name'		 => 'min_chars',
					'label'		 => __( 'Minimum characters', 'agni-halena-plugin' ),
					'type'		 => 'number',
					'size'		 => 'small',
					'desc'		 => __( 'Minimum number of characters required to trigger autosuggest.', 'agni-halena-plugin' ),
					'default'	 => 3,
				),
				array(
					'name'		 => 'show_submit_button',
					'label'		 => __( 'Show submit button', 'agni-halena-plugin' ),
					'type'		 => 'checkbox',
					'size'		 => 'small',
					'default'	 => 'off',
				),
				array(
					'name'		 => 'search_submit_text',
					'label'		 => __( 'Search submit button text', 'agni-halena-plugin' ),
					'type'		 => 'text',
					'desc'		 => __( 'To display a loupe icon leave this field empty.', 'agni-halena-plugin' ),
					'default'	 => __( 'Search', 'agni-halena-plugin' ),
				),
				array(
					'name'		 => 'search_placeholder',
					'label'		 => __( 'Search input placeholder', 'agni-halena-plugin' ),
					'type'		 => 'text',
					'default'	 => __( 'Search for products...', 'agni-halena-plugin' ),
				),
				array(
					'name'		 => 'show_details_box',
					'label'		 => __( 'Show details box', 'agni-halena-plugin' ),
					'type'		 => 'checkbox',
					'size'		 => 'small',
					'desc'		 => __( 'The Details box is an additional container for extended information. The details are changed dynamically when you hover the mouse over one of the suggestions.', 'agni-halena-plugin' ),
					'default'	 => 'off',
				)
			) ),
			'agnidgwt_wcas_advanced'	 => apply_filters( 'agnidgwt_wcas_advanced_settings', array(
				array(
					'name'	 => 'search_head',
					'label'	 => '<h3>' . __( 'Product search', 'agni-halena-plugin' ) . '</h3>',
					'type'	 => 'head',
				),
				array(
					'name'		 => 'search_in_product_content',
					'label'		 => __( 'Search in products content', 'agni-halena-plugin' ),
					'type'		 => 'checkbox',
					'default'	 => 'off',
				),
				array(
					'name'		 => 'search_in_product_excerpt',
					'label'		 => __( 'Search in products excerpt', 'agni-halena-plugin' ),
					'type'		 => 'checkbox',
					'default'	 => 'off',
				),
				array(
					'name'		 => 'search_in_product_sku',
					'label'		 => __( 'Search in products SKU', 'agni-halena-plugin' ),
					'type'		 => 'checkbox',
					'default'	 => 'off',
				),
				array(
					'name'		 => 'exclude_out_of_stock',
					'label'		 => __( "Exclude 'out of stock' products", 'agni-halena-plugin' ),
					'type'		 => 'checkbox',
					'default'	 => 'off',
				),
				array(
					'name'	 => 'search_in_taxonomy_head',
					'label'	 => '<h3>' . __( 'Taxonomy search', 'agni-halena-plugin' ) . '</h3>',
					'type'	 => 'head',
				),
				array(
					'name'		 => 'show_matching_categories',
					'label'		 => __( 'Show matching categories', 'agni-halena-plugin' ),
					'type'		 => 'checkbox',
					'default'	 => 'on',
				),
				array(
					'name'		 => 'show_matching_tags',
					'label'		 => __( 'Show matching tags', 'agni-halena-plugin' ),
					'type'		 => 'checkbox',
					'default'	 => 'off',
				),
				array(
					'name'	 => 'product_suggestion_head',
					'label'	 => '<h3>' . __( 'Suggestions output', 'agni-halena-plugin' ) . '</h3>',
					'type'	 => 'head',
				),
				array(
					'name'		 => 'show_product_image',
					'label'		 => __( 'Show product image', 'agni-halena-plugin' ),
					'type'		 => 'checkbox',
					'default'	 => 'off',
				),
				array(
					'name'		 => 'show_product_price',
					'label'		 => __( 'Show price', 'agni-halena-plugin' ),
					'type'		 => 'checkbox',
					'default'	 => 'off',
				),
				array(
					'name'		 => 'show_product_desc',
					'label'		 => __( 'Show product description', 'agni-halena-plugin' ),
					'type'		 => 'checkbox',
					'default'	 => 'off',
				),
				array(
					'name'		 => 'show_product_sku',
					'label'		 => __( 'Show SKU', 'agni-halena-plugin' ),
					'type'		 => 'checkbox',
					'default'	 => 'off',
				),
//				array(
//					'name'		 => 'show_sale_badge',
//					'label'		 => __( 'Show sale badge', 'agni-halena-plugin' ),
//					'type'		 => 'checkbox',
//					'default'	 => 'off',
//				),
//				array(
//					'name'		 => 'show_featured_badge',
//					'label'		 => __( 'Show featured badge', 'agni-halena-plugin' ),
//					'type'		 => 'checkbox',
//					'default'	 => 'off',
//				),
			) ),
			'agnidgwt_wcas_details_box'	 => apply_filters( 'agnidgwt_wcas_details_box_settings', array(
				array(
					'name'	 => 'tax_details_tax_head',
					'label'	 => '<h3>' . __( 'Category and tag details:', 'agni-halena-plugin' ) . '</h3>',
					'type'	 => 'head',
				),
				array(
					'name'		 => 'show_for_tax',
					'label'		 => __( 'Show', 'agni-halena-plugin' ),
					'type'		 => 'select',
					'options'	 => array(
						'all'		 => __( 'All Product', 'agni-halena-plugin' ),
						'featured'	 => __( 'Featured Products', 'agni-halena-plugin' ),
						'onsale'	 => __( 'On-sale Products', 'agni-halena-plugin' ),
					),
					'default'	 => 'on',
				),
				array(
					'name'		 => 'orderby_for_tax',
					'label'		 => __( 'Order by', 'agni-halena-plugin' ),
					'type'		 => 'select',
					'options'	 => array(
						'date'	 => __( 'Date', 'agni-halena-plugin' ),
						'price'	 => __( 'Price', 'agni-halena-plugin' ),
						'rand'	 => __( 'Random', 'agni-halena-plugin' ),
						'sales'	 => __( 'Sales', 'agni-halena-plugin' ),
					),
					'default'	 => 'on',
				),
				array(
					'name'		 => 'order_for_tax',
					'label'		 => __( 'Order by', 'agni-halena-plugin' ),
					'type'		 => 'select',
					'options'	 => array(
						'desc'	 => __( 'DESC', 'agni-halena-plugin' ),
						'asc'	 => __( 'ASC', 'agni-halena-plugin' ),
					),
					'default'	 => 'desc',
				),
				array(
					'name'	 => 'tax_details_product_other',
					'label'	 => '<h3>' . __( 'Other', 'agni-halena-plugin' ) . '</h3>',
					'type'	 => 'head',
				),
				array(
					'name'		 => 'details_box_position',
					'label'		 => __( 'Details box position', 'agni-halena-plugin' ),
					'type'		 => 'select',
					'desc'		 => __( 'If your search form is very close to the right window screen, then select left.', 'agni-halena-plugin' ),
					'options'	 => array(
						'left'	 => __( 'Left', 'agni-halena-plugin' ),
						'right'	 => __( 'Right', 'agni-halena-plugin' ),
					),
					'default'	 => 'right',
				)
			) ),
			'agnidgwt_wcas_style'		 => apply_filters( 'agnidgwt_wcas_style_settings', array(
				array(
					'name'	 => 'search_form',
					'label'	 => '<h3>' . __( 'Search form', 'agni-halena-plugin' ) . '</h3>',
					'type'	 => 'head',
				),
				array(
					'name'		 => 'bg_input_color',
					'label'		 => __( 'Search input background', 'agni-halena-plugin' ),
					'type'		 => 'color',
					'default'	 => '',
				),
				array(
					'name'		 => 'text_input_color',
					'label'		 => __( 'Search input text', 'agni-halena-plugin' ),
					'type'		 => 'color',
					'default'	 => '',
				),
				array(
					'name'		 => 'border_input_color',
					'label'		 => __( 'Search input border', 'agni-halena-plugin' ),
					'type'		 => 'color',
					'default'	 => '',
				),
				array(
					'name'		 => 'bg_submit_color',
					'label'		 => __( 'Search submit background', 'agni-halena-plugin' ),
					'type'		 => 'color',
					'default'	 => '',
				),
				array(
					'name'		 => 'text_submit_color',
					'label'		 => __( 'Search submit text', 'agni-halena-plugin' ),
					'type'		 => 'color',
					'default'	 => '',
				),
				array(
					'name'	 => 'syggestions_style_head',
					'label'	 => '<h3>' . __( 'Suggestions', 'agni-halena-plugin' ) . '</h3>',
					'type'	 => 'head',
				),
				array(
					'name'		 => 'sug_bg_color',
					'label'		 => __( 'Suggestion background', 'agni-halena-plugin' ),
					'type'		 => 'color',
					'default'	 => '',
				),
				array(
					'name'		 => 'sug_hover_color',
					'label'		 => __( 'Suggestion selected', 'agni-halena-plugin' ),
					'type'		 => 'color',
					'default'	 => '',
				),
				array(
					'name'		 => 'sug_text_color',
					'label'		 => __( 'Text color', 'agni-halena-plugin' ),
					'type'		 => 'color',
					'default'	 => '',
				),
				array(
					'name'		 => 'sug_highlight_color',
					'label'		 => __( 'Highlight color', 'agni-halena-plugin' ),
					'type'		 => 'color',
					'default'	 => '',
				),
				array(
					'name'		 => 'sug_border_color',
					'label'		 => __( 'Border color', 'agni-halena-plugin' ),
					'type'		 => 'color',
					'default'	 => '',
				),
				array(
					'name'		 => 'sug_width',
					'label'		 => __( 'Suggestions width', 'agni-halena-plugin' ),
					'type'		 => 'number',
					'size'		 => 'small',
					'desc'		 => ' px. ' . __( 'Overvrite the suggestions container width. Leave this field empty to adjust the suggestions container width to the search input width.', 'agni-halena-plugin' ),
					'default'	 => '',
				),
				array(
					'name'	 => 'preloader',
					'label'	 => '<h3>' . __( 'Preloader', 'agni-halena-plugin' ) . '</h3>',
					'type'	 => 'head',
				),
				array(
					'name'		 => 'show_preloader',
					'label'		 => __( 'Show preloader', 'agni-halena-plugin' ),
					'type'		 => 'checkbox',
					'default'	 => 'on',
				),
				array(
					'name'		 => 'preloader_url',
					'label'		 => __( 'Upload preloader image', 'agni-halena-plugin' ),
					'type'		 => 'file',
					'default'	 => '',
				),
			) )
		);


		return $settings_fields;
	}

	/*
	 * Print optin value
	 * 
	 * @param string $option_key
	 * @param string $default default value if option not exist
	 * 
	 * @return string
	 */

	public function get_opt( $option_key, $default = '' ) {

		$value = '';

		if ( is_string( $option_key ) && !empty( $option_key ) ) {

			$settings = get_option( $this->setting_slug );

			if ( is_array( $settings ) && array_key_exists( $option_key, $settings ) ) {
				$value = $settings[ $option_key ];
			} else {

				// Catch default
				foreach ( $this->settings_fields() as $section ) {
					foreach ( $section as $field ) {
						if ( $field[ 'name' ] === $option_key && isset( $field[ 'default' ] ) ) {
							$value = $field[ 'default' ];
						}
					}
				}
			}
		}

		if ( empty( $value ) && !empty( $default ) ) {
			$value = $default;
		}

		return apply_filters( 'agnidgwt_wcas_return_option_value', $value, $option_key );
	}

	/**
	 * Handles output of the settings
	 */
	public static function output() {

		$settings = AGNIDGWT_WCAS()->settings->settings_api;

		//include_once AGNIDGWT_WCAS_DIR . 'includes/admin/views/settings.php';
	}

}

/*
 * Disable details box setting tab if the option id rutns off
 */
add_filter( 'agnidgwt_wcas_settings_sections', 'agnidgwt_wcas_hide_settings_detials_tab' );

function agnidgwt_wcas_hide_settings_detials_tab( $sections ) {

	if ( AGNIDGWT_WCAS()->settings->get_opt( 'show_details_box' ) !== 'on' && is_array( $sections ) ) {

		$i = 0;
		foreach ( $sections as $section ) {

			if ( isset( $section[ 'id' ] ) && $section[ 'id' ] === 'agnidgwt_wcas_details_box' ) {
				unset( $sections[ $i ] );
			}

			$i++;
		}
	}

	return $sections;
}
