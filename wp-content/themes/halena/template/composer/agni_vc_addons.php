<?php 

if( !function_exists('agni_remove_vc_elements') ){
	function agni_remove_vc_elements() {
		vc_remove_element("vc_message");
		vc_remove_element("vc_tweetmeme");
		vc_remove_element("vc_googleplus");
		vc_remove_element("vc_facebook");
		vc_remove_element("vc_pinterest");
		vc_remove_element("vc_flickr");
		vc_remove_element("vc_posts_slider");
		vc_remove_element("vc_basic_grid");
		vc_remove_element("vc_raw_html");
		vc_remove_element("vc_raw_js");
		vc_remove_element("vc_single_image");
		vc_remove_element("vc_images_carousel");
		vc_remove_element("vc_media_grid");
		vc_remove_element("vc_masonry_grid");
		vc_remove_element("vc_gmaps");
		vc_remove_element("vc_progress_bar");
		vc_remove_element("vc_pie");
		vc_remove_element("vc_gallery");
		vc_remove_element("vc_masonry_media_grid");
		vc_remove_element("vc_icon");
		vc_remove_element("vc_video");
		vc_remove_element("vc_round_chart");
		vc_remove_element("vc_line_chart");
		vc_remove_element("vc_tweetmeme");
		vc_remove_element("vc_googleplus");
		vc_remove_element("vc_facebook");
		vc_remove_element("vc_pinterest");
		vc_remove_element("vc_flickr");
		vc_remove_element("vc_gmaps");
		vc_remove_element("vc_raw_html");
		vc_remove_element("vc_raw_js");
		vc_remove_element("vc_separator");
		vc_remove_element("vc_text_separator");
		vc_remove_element("vc_cta");
		vc_remove_element("vc_btn");
		vc_remove_element("vc_widget_sidebar");
		vc_remove_element("vc_toggle");
		vc_remove_element("rev_slider_vc");
		vc_remove_element("vc_tta_tour");
		vc_remove_element("vc_tta_pageable");
		vc_remove_element("vc_tta_tabs");
		vc_remove_element("vc_tta_accordion");
		vc_remove_element("vc_zigzag");
		vc_remove_element("vc_hoverbox");
	}

	// Hook for admin editor.
	$halena_options = get_option('halena_options');
	if( $halena_options['vc_elements'] == '0' ){
	    add_action( 'vc_build_admin_page', 'agni_remove_vc_elements', 11 );
	    add_action( 'vc_load_shortcode', 'agni_remove_vc_elements', 11 );
	}
}

// Deprecated
vc_remove_element("vc_tour");
vc_remove_element("vc_button");
vc_remove_element("vc_button2");
vc_remove_element("vc_cta");
vc_remove_element("vc_cta_button");
vc_remove_element("vc_cta_button2");

// Removing WooCommerce elements
if( !function_exists('agni_remove_woocommerce_elements') ){
	function agni_remove_woocommerce_elements() {
		if ( class_exists( 'WooCommerce' ) ) {
			vc_remove_element("woocommerce_cart");
			vc_remove_element("woocommerce_checkout");
			vc_remove_element("woocommerce_order_tracking");
			vc_remove_element("woocommerce_my_account");
			vc_remove_element("recent_products");
			vc_remove_element("featured_products");
			vc_remove_element("product");
			vc_remove_element("products");
			vc_remove_element("add_to_cart");
			vc_remove_element("add_to_cart_url");
			vc_remove_element("product_page");
			vc_remove_element("product_category");
			vc_remove_element("product_categories");
			vc_remove_element("sale_products");
			vc_remove_element("best_selling_products");
			vc_remove_element("top_rated_products");
			vc_remove_element("product_attribute");
		}
	}
}

// Processing Spacing Attributes
if( !function_exists('agni_space_atts_processor') ){
	function agni_space_atts_processor( $atts ){
		//$design_css = array();
		$device = array( '','_tab', '_mobile' );
		foreach ($device as $key => $value) {
			$design_css[$key] = '';
			if( !empty($atts['margin_top'.$value]) ){
				$design_css[$key] .= 'margin-top: ' . ( preg_match( '/(px|em|\%|pt|cm|auto)$/', $atts['margin_top'.$value] ) ? $atts['margin_top'.$value] : $atts['margin_top'.$value] . 'px' ) . '; ';
			}
			if( !empty($atts['margin_right'.$value]) ){
				$design_css[$key] .= 'margin-right: ' . ( preg_match( '/(px|em|\%|pt|cm|auto)$/', $atts['margin_right'.$value] ) ? $atts['margin_right'.$value] : $atts['margin_right'.$value] . 'px' ) . '; ';
			}
			if( !empty($atts['margin_bottom'.$value]) ){
				$design_css[$key] .= 'margin-bottom: ' . ( preg_match( '/(px|em|\%|pt|cm|auto)$/', $atts['margin_bottom'.$value] ) ? $atts['margin_bottom'.$value] : $atts['margin_bottom'.$value] . 'px' ) . '; ';
			}
			if( !empty($atts['margin_left'.$value]) ){
				$design_css[$key] .= 'margin-left: ' . ( preg_match( '/(px|em|\%|pt|cm|auto)$/', $atts['margin_left'.$value] ) ? $atts['margin_left'.$value] : $atts['margin_left'.$value] . 'px' ) . '; ';
			}
			if( !empty($atts['padding_top'.$value]) ){
				$design_css[$key] .= 'padding-top: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $atts['padding_top'.$value] ) ? $atts['padding_top'.$value] : $atts['padding_top'.$value] . 'px' ) . '; ';
			}
			if( !empty($atts['padding_right'.$value]) ){
				$design_css[$key] .= 'padding-right: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $atts['padding_right'.$value] ) ? $atts['padding_right'.$value] : $atts['padding_right'.$value] . 'px' ) . '; ';
			}
			if( !empty($atts['padding_bottom'.$value]) ){
				$design_css[$key] .= 'padding-bottom: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $atts['padding_bottom'.$value] ) ? $atts['padding_bottom'.$value] : $atts['padding_bottom'.$value] . 'px' ) . '; ';
			}
			if( !empty($atts['padding_left'.$value]) ){
				$design_css[$key] .= 'padding-left: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $atts['padding_left'.$value] ) ? $atts['padding_left'.$value] : $atts['padding_left'.$value] . 'px' ) . '; ';
			}
			if( !empty($atts['border_top'.$value]) ){
				$design_css[$key] .= 'border-top-width: ' . $atts['border_top'.$value] . 'px; ';
				if( !empty($atts['border_style'.$value]) ){
					$design_css[$key] .= 'border-top-style: ' . $atts['border_style'.$value] . '; ';
				}
			}
			if( !empty($atts['border_right'.$value]) ){
				$design_css[$key] .= 'border-right-width: ' . $atts['border_right'.$value] . 'px; ';
				if( !empty($atts['border_style'.$value]) ){
					$design_css[$key] .= 'border-right-style: ' . $atts['border_style'.$value] . '; ';
				}
			}
			if( !empty($atts['border_bottom'.$value]) ){
				$design_css[$key] .= 'border-bottom-width: ' . $atts['border_bottom'.$value] . 'px; ';
				if( !empty($atts['border_style'.$value]) ){
					$design_css[$key] .= 'border-bottom-style: ' . $atts['border_style'.$value] . '; ';
				}
			}
			if( !empty($atts['border_left'.$value]) ){
				$design_css[$key] .= 'border-left-width: ' . $atts['border_left'.$value] . 'px; ';
				if( !empty($atts['border_style'.$value]) ){
					$design_css[$key] .= 'border-left-style: ' . $atts['border_style'.$value] . '; ';
				}
			}
			if( !empty($atts['border_color'.$value]) ){
				$design_css[$key] .= 'border-color: ' . $atts['border_color'.$value].'; ';
			}
			if( !empty($atts['border_radius'.$value]) ){
				$design_css[$key] .= 'border-radius: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $atts['border_radius'.$value] ) ? $atts['border_radius'.$value] : $atts['border_radius'.$value] . 'px' ) . '; ';
			}
		}
		
		return $design_css; 
	}
}

if( !function_exists('agni_bg_atts_processor') ){
	function agni_bg_atts_processor( $atts ){
		$row_bg_css = '';
		if( !empty($atts['bg_color']) ){
			$row_bg_css .= 'background-color: ' . $atts['bg_color'] . '; ';
		}
		if( !empty($atts['bg_image']) ){
			$row_bg_css .= 'background-image: url(\'' . wp_get_attachment_url($atts['bg_image']) . '\'); ';

			$row_bg_css .= 'background-repeat:' . $atts['bg_image_repeat'] . '; ';
			$row_bg_css .= 'background-size:' . $atts['bg_image_size'] . '; ';
			$row_bg_css .= 'background-position:' . $atts['bg_image_position'] . '; ';
			$row_bg_css .= 'background-attachment:' . $atts['bg_image_attachment'] . '; ';

		}

		return $row_bg_css;

	}
}

if( !function_exists( 'agni_carousel_atts_processor' ) ){
	function agni_carousel_atts_processor( $atts ){
		$carousel_autoplay = ( $atts['carousel_autoplay'] == '1' )?'true':'false';
		$carousel_autoplay_speed = $atts['carousel_autoplay_speed'];
		$carousel_pause_on_focus = ( $atts['carousel_pause_on_focus'] == '1' )?'true':'false';
		$carousel_speed = $atts['carousel_speed'];
		$carousel_infinite = ( $atts['carousel_infinite'] == '1' )?'true':'false';
		$carousel_draggable = ( $atts['carousel_draggable'] == '1' )?'true':'false';
		$carousel_dots = ( $atts['carousel_dots'] == '1' )?'true':'false';
		$carousel_center_mode = ( $atts['carousel_center_mode'] == '1' )?'true':'false';
		$carousel_arrows = ( $atts['carousel_arrows'] == '1' )?'true':'false';
		$carousel_swipe = ( $atts['carousel_swipe'] == '1' )?'true':'false';
		$carousel_swipe_to_scroll = ( $atts['carousel_swipe_to_scroll'] == '1' )?'true':'false';

		$carousel_arrow_prev = '<button type="button" class="slick-prev">'.esc_html__( 'Previous', 'halena' ).'</button>';
		$carousel_arrow_next = '<button type="button" class="slick-next">'.esc_html__( 'Next', 'halena' ).'</button>';

		$carousel_atts = 'data-carousel-slide-to-show="'.esc_attr( $atts['columns'] ).'" data-carousel-slide-to-show-1200="'.esc_attr( $atts['carousel_columns_1200'] ).'" data-carousel-slide-to-show-992="'.esc_attr( $atts['carousel_columns_992'] ).'" data-carousel-slide-to-show-768="'.esc_attr( $atts['carousel_columns_768'] ).'" data-carousel-autoplay="'.esc_attr( $carousel_autoplay ).'" data-carousel-autoplay-speed="'.esc_attr( $carousel_autoplay_speed ).'" data-carousel-speed="'.esc_attr( $carousel_speed ).'" data-carousel-pause-on-focus="'.esc_attr( $carousel_pause_on_focus ).'" data-carousel-infinite="'.esc_attr( $carousel_infinite ).'" data-carousel-dots="'.esc_attr( $carousel_dots ).'" data-carousel-arrows="'.esc_attr( $carousel_arrows ).'" data-carousel-arrow-prev="'.esc_attr( $carousel_arrow_prev ).'" data-carousel-arrow-next="'.esc_attr( $carousel_arrow_next ).'" data-carousel-draggable="'.esc_attr( $carousel_draggable ).'" data-carousel-center-mode="'.esc_attr( $carousel_center_mode ).'" data-carousel-swipe="'.esc_attr( $carousel_swipe ).'" data-carousel-swipe-to-scroll="'.esc_attr( $carousel_swipe_to_scroll ).'"';

		return $carousel_atts;

	}
}

// Update existing shortcode value
function agni_vc_shortcode_values_update() {
	// Update Custom Heading font Value	
	$custom_heading_param = WPBMap::getParam( 'vc_custom_heading', 'use_theme_fonts' );
	$custom_heading_param['std'] = 'yes';
	vc_update_shortcode_param( "vc_custom_heading", $custom_heading_param );

	// Update Empty space Value	
	$empty_space_param = WPBMap::getParam( 'vc_empty_space', 'height' );
	$empty_space_param['std'] = '30';
	vc_update_shortcode_param( "vc_empty_space", $empty_space_param );
}
add_action( 'init', 'agni_vc_shortcode_values_update', 12 );


class AgniShortcodesFunctions {
	function __construct() {
		// We safely integrate with VC with this hook
		add_action( 'init', array( $this, 'integrateAgniWithVC' ), 12 );
		
	}
	
	public function integrateAgniWithVC() {
		// Check if Visual Composer is installed
		if ( ! defined( 'WPB_VC_VERSION' ) ) {
			// Display notice that Visual Compser is required
			add_action('admin_notices', array( $this, 'showVcVersionNotice' ));
			return;
		}

		// Including Icon Fonts list
		include ( AGNI_FRAMEWORK_DIR . '/template/composer/agni_iconfonts.php' );

		// Including Google Fonts list
		include ( AGNI_FRAMEWORK_DIR . '/template/composer/agni_googlefonts.php' );

		// Section
		$section_settings_update = array (
		  'weight' => '99',
		  'icon' => 'ion-ios-barcode-outline'
		);
		vc_map_update( 'vc_section', $section_settings_update );

		// Row
		$row_settings_update = array (
		  'weight' => '98',
		  'icon' => 'ion-ios-plus-outline'
		);
		vc_map_update( 'vc_row', $row_settings_update );

		// Column Text
		$column_text_settings_update = array (
		  'weight' => '98',
		  'icon' => 'ion-ios-paper-outline'
		);
		vc_map_update( 'vc_column_text', $column_text_settings_update );

		// Custom Heading
		$custom_heading_settings_update = array (
		  'weight' => '96',
		  'icon' => 'ion-ios-glasses-outline'
		);
		vc_map_update( 'vc_custom_heading', $custom_heading_settings_update );
		// Empty space
		$space_settings_update = array (
		  'weight' => '94',
		  'icon' => 'ion-ios-minus-empty'
		);
		vc_map_update( 'vc_empty_space', $space_settings_update );
		
		// Tab
		$tab_settings_update = array (
		  'weight' => '65',
		  'icon' => 'ion-ios-browsers-outline'
		);
		vc_map_update( 'vc_tabs', $tab_settings_update );
		// Accordion
		$accordion_settings_update = array (
		  'weight' => '64',
		  'icon' => 'ion-ios-arrow-down'
		);
		vc_map_update( 'vc_accordion', $accordion_settings_update );
		

		if( defined( 'WPCF7_PLUGIN' ) ){
			// Contact Form 7
			$contact_form_settings_update = array (
			  'weight' => '63',
			);
			vc_map_update( 'contact-form-7', $contact_form_settings_update );
		}
		
		if( class_exists( 'RevSlider' ) ){
			// Revolution slider
			$rev_settings_update = array (
			  'weight' => '62',
			);
			//vc_map_update( 'rev_slider_vc', $rev_settings_update );
			vc_remove_element("rev_slider_vc");
			vc_map_update( 'rev_slider', $rev_settings_update );
		}

		$elements_bg_atts = array(
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Background Choice', 'halena' ),
				'param_name' => 'bg_choice',
				'value' => array(
					esc_html__( 'Background Color', 'halena' ) => '1',
					esc_html__( 'Background Image', 'halena' ) => '2',
				),
				'description' => esc_html__( 'Choose your desired background option.', 'halena' ),
				'group' => esc_html__( 'Design Options', 'halena' ),
				'std' => '1',
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Background Color', 'halena' ),
				'param_name' => 'bg_color',
				'description' => esc_html__( 'Choose your desired background color for this row.', 'halena' ),
				'dependency' => array( 'element' => 'bg_choice', 'value' => '1' ),
				'group' => esc_html__( 'Design Options', 'halena' ),
				'std' => '',
			),
			array(
				'type' => 'attach_image',
				'heading' => esc_html__( 'Background Image', 'halena' ),
				'param_name' => 'bg_image',
				'description' => esc_html__( 'Choose your desired background image for this row', 'halena' ),
				'dependency' => array( 'element' => 'bg_choice', 'value' => '2' ),
				'group' => esc_html__( 'Design Options', 'halena' ),
				'std' => '',
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'BG Image Repeat', 'halena' ),
				'param_name' => 'bg_image_repeat',
				'value' => array(
					 esc_html__( 'Repeat', 'halena' ) => 'repeat',
					 esc_html__('No Repeat', 'halena') => 'no-repeat'
					),
				'description' => esc_html__( 'Choose whether your background image should be repeated to X-axis Y-axis or not.', 'halena' ),
				'dependency' => array( 'element' => 'bg_image', 'not_empty' => true),
				'group' => esc_html__( 'Design Options', 'halena' ),
				'edit_field_class' => 'vc_col-sm-3 vc_col-md-3 vc_column',
				'std' => 'repeat',
			),

			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'BG Image Size', 'halena' ),
				'param_name' => 'bg_image_size',
				'value' => array(
					 esc_html__('Cover', 'halena') => 'cover',
					 esc_html__( 'Auto', 'halena' ) => 'auto'
					),
				'description' => esc_html__( 'Choose your desired background image size.', 'halena' ),
				'dependency' => array( 'element' => 'bg_image', 'not_empty' => true),
				'group' => esc_html__( 'Design Options', 'halena' ),
				'edit_field_class' => 'vc_col-sm-3 vc_col-md-3 vc_column',
				'std' => 'cover',
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'BG Image Position', 'halena' ),
				'param_name' => 'bg_image_position',
				'value' => array(
					 esc_html__( 'center center', 'halena' ) => 'center center',
					 esc_html__( 'left top', 'halena') => 'left top',
					 esc_html__( 'left center', 'halena' ) => 'left center',
					 esc_html__( 'left bottom', 'halena' ) => 'left bottom',
					 esc_html__( 'right top', 'halena' ) => 'right top',
					 esc_html__( 'right center', 'halena' ) => 'right center',
					 esc_html__( 'right bottom', 'halena' ) => 'right bottom',
					 esc_html__( 'center top', 'halena' ) => 'center top',
					 esc_html__( 'center bottom', 'halena' ) => 'center bottom',
				),
				'description' => esc_html__( 'Choose your desired background image position', 'halena' ),
				'dependency' => array( 'element' => 'bg_image', 'not_empty' => true),
				'group' => esc_html__( 'Design Options', 'halena' ),
				'edit_field_class' => 'vc_col-sm-3 vc_col-md-3 vc_column',
				'std' => 'center center',
			),

			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'BG Image Attachment', 'halena' ),
				'param_name' => 'bg_image_attachment',
				'value' => array(
					 esc_html__( 'Scroll', 'halena' ) => 'scroll',
					 esc_html__( 'Fixed', 'halena' ) => 'fixed',
					),
				'description' => esc_html__( 'Choose your desired background image attachment', 'halena' ),
				'dependency' => array( 'element' => 'bg_image', 'not_empty' => true),
				'group' => esc_html__( 'Design Options', 'halena' ),
				'edit_field_class' => 'vc_col-sm-3 vc_col-md-3 vc_column',
				'std' => 'scroll'
			),

		);

		$elements_carousel_atts = array(
			array(
				'type' => 'checkbox',
				'heading' => esc_html__('Carousel', 'halena'),
                'param_name' => 'carousel',
                'value' => array( esc_html__( 'Yes', 'halena' ) => '1' ),
                'description' => esc_html__( 'It will display the portfolio/blog items inside the carousel.', 'halena' ),
                'group' => esc_html__( 'Carousel Settings', 'halena' ),
				'save_always' => true,
				'std' => ''
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Columns on Desktop (<1200)', 'halena'),
				'param_name' => 'carousel_columns_1200',
				'value' => array(
                    esc_html__( '1 Column', 'halena') => '1',
                    esc_html__( '2 Columns', 'halena') => '2',
                    esc_html__( '3 Columns', 'halena') => '3',
                    esc_html__( '4 Columns', 'halena') => '4',
                    esc_html__( '5 Columns', 'halena') => '5',
                    esc_html__( '6 Columns', 'halena') => '6',
				),
				'description' => esc_html__('Please select the number of columns you would like to display.', 'halena'),
                'group' => esc_html__( 'Carousel Settings', 'halena' ),
				'dependency' => array( 'element' => 'carousel', 'value' => '1' ),
				'std' => '3',
				'edit_field_class' => 'vc_col-sm-4 vc_col-md-4 vc_column',
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Tab (<992)', 'halena'),
				'param_name' => 'carousel_columns_992',
				'value' => array(
                    esc_html__( '1 Column', 'halena') => '1',
                    esc_html__( '2 Columns', 'halena') => '2',
                    esc_html__( '3 Columns', 'halena') => '3',
                    esc_html__( '4 Columns', 'halena') => '4',
                    esc_html__( '5 Columns', 'halena') => '5',
                    esc_html__( '6 Columns', 'halena') => '6',
				),
				'description' => esc_html__('Please select the number of columns you would like to display.', 'halena'),
                'group' => esc_html__( 'Carousel Settings', 'halena' ),
				'dependency' => array( 'element' => 'carousel', 'value' => '1' ),
				'std' => '2',
				'edit_field_class' => 'vc_col-sm-4 vc_col-md-4 vc_column',
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Mobile (<768)', 'halena'),
				'param_name' => 'carousel_columns_768',
				'value' => array(
                    esc_html__( '1 Column', 'halena') => '1',
                    esc_html__( '2 Columns', 'halena') => '2',
                    esc_html__( '3 Columns', 'halena') => '3',
                    esc_html__( '4 Columns', 'halena') => '4',
                    esc_html__( '5 Columns', 'halena') => '5',
                    esc_html__( '6 Columns', 'halena') => '6',
				),
				'description' => esc_html__('Please select the number of columns you would like to display.', 'halena'),
                'group' => esc_html__( 'Carousel Settings', 'halena' ),
				'dependency' => array( 'element' => 'carousel', 'value' => '1' ),
				'std' => '1',
				'edit_field_class' => 'vc_col-sm-4 vc_col-md-4 vc_column',
			),
			array(
				'type' => 'checkbox',
				'heading' => esc_html__( 'Autoplay', 'halena' ),
				'param_name' => 'carousel_autoplay',
				'value' => array( esc_html__( 'Yes', 'halena' ) => '1' ),
				'group' => esc_html__( 'Carousel Settings', 'halena' ),
				'dependency' => array( 'element' => 'carousel', 'value' => '1' ),
				'std'  => '1',
			),  
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Timeout duration', 'halena' ),
				'param_name' => 'carousel_autoplay_speed',
				'description' => esc_html__( 'Enter the duration of each slide Transition', 'halena' ),
				'group' => esc_html__( 'Carousel Settings', 'halena' ),
				'dependency' => array( 'element' => 'carousel', 'value' => '1' ),
				'std' => '3000'
			),

			array(
				'type' => 'checkbox',
				'heading' => esc_html__( 'Arrows', 'halena' ),
				'param_name' => 'carousel_arrows',
				'value' => array( esc_html__( 'Yes', 'halena' ) => '1' ),
				'group' => esc_html__( 'Carousel Settings', 'halena' ),
				'dependency' => array( 'element' => 'carousel', 'value' => '1' ),
				'std'  => '1'
			),

			array(
				'type' => 'checkbox',
				'heading' => esc_html__( 'Center Mode', 'halena' ),
				'param_name' => 'carousel_center_mode',
				'value' => array( esc_html__( 'Yes', 'halena' ) => '1' ),
				'group' => esc_html__( 'Carousel Settings', 'halena' ),
				'dependency' => array( 'element' => 'carousel', 'value' => '1' ),
				'std'  => ''
			),
			array(
				'type' => 'checkbox',
				'heading' => esc_html__( 'Dots', 'halena' ),
				'param_name' => 'carousel_dots',
				'value' => array( esc_html__( 'Yes', 'halena' ) => '1' ),
				'group' => esc_html__( 'Carousel Settings', 'halena' ),
				'dependency' => array( 'element' => 'carousel', 'value' => '1' ),
				'std'  => ''
			),
			array(
				'type' => 'checkbox',
				'heading' => esc_html__( 'Draggable', 'halena' ),
				'param_name' => 'carousel_draggable',
				'value' => array( esc_html__( 'Yes', 'halena' ) => '1' ),
				'group' => esc_html__( 'Carousel Settings', 'halena' ),
				'dependency' => array( 'element' => 'carousel', 'value' => '1' ),
				'std'  => '1'
			),
			array(
				'type' => 'checkbox',
				'heading' => esc_html__( 'Infinite', 'halena' ),
				'param_name' => 'carousel_infinite',
				'value' => array( esc_html__( 'Yes', 'halena' ) => '1' ),
				'group' => esc_html__( 'Carousel Settings', 'halena' ),
				'dependency' => array( 'element' => 'carousel', 'value' => '1' ),
				'std'  => '1'
			),

			array(
				'type' => 'checkbox',
				'heading' => esc_html__( 'Pause on Focus', 'halena' ),
				'param_name' => 'carousel_pause_on_focus',
				'value' => array( esc_html__( 'Yes', 'halena' ) => '1' ),
				'group' => esc_html__( 'Carousel Settings', 'halena' ),
				'dependency' => array( 'element' => 'carousel', 'value' => '1' ),
				'std'  => '1'
			),

			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Transition Speed', 'halena' ),
				'param_name' => 'carousel_speed',
				'description' => esc_html__( 'Enter the speed of each slide Transition', 'halena' ),
				'group' => esc_html__( 'Carousel Settings', 'halena' ),
				'dependency' => array( 'element' => 'carousel', 'value' => '1' ),
				'std' => '300',
			),

			array(
				'type' => 'checkbox',
				'heading' => esc_html__( 'Touch Swipe', 'halena' ),
				'param_name' => 'carousel_swipe',
				'value' => array( esc_html__( 'Yes', 'halena' ) => '1' ),
				'group' => esc_html__( 'Carousel Settings', 'halena' ),
				'dependency' => array( 'element' => 'carousel', 'value' => '1' ),
				'std'  => '1'
			),

			array(
				'type' => 'checkbox',
				'heading' => esc_html__( 'Swipe to scroll', 'halena' ),
				'param_name' => 'carousel_swipe_to_scroll',
				'value' => array( esc_html__( 'Yes', 'halena' ) => '1' ),
				'group' => esc_html__( 'Carousel Settings', 'halena' ),
				'dependency' => array( 'element' => 'carousel', 'value' => '1' ),
				'std'  => '1'
			),
		);

		vc_remove_param( "vc_section", "full_width" );
		vc_remove_param( "vc_section", "video_bg" );
		vc_remove_param( "vc_section", "video_bg_url" );
		vc_remove_param( "vc_section", "video_bg_parallax" );
		vc_remove_param( "vc_section", "parallax" );
		vc_remove_param( "vc_section", "parallax_image" );
		vc_remove_param( "vc_section", "parallax_speed_video" );
		vc_remove_param( "vc_section", "parallax_speed_bg" );
		vc_remove_param( "vc_section", "css_animation" );


		vc_remove_param( "vc_row", "css" );
		vc_remove_param( "vc_row", "full_width" );
		vc_remove_param( "vc_row", "video_bg" );
		vc_remove_param( "vc_row", "video_bg_url" );
		vc_remove_param( "vc_row", "video_bg_parallax" );
		vc_remove_param( "vc_row", "parallax" );
		vc_remove_param( "vc_row", "parallax_image" );
		vc_remove_param( "vc_row", "parallax_speed_video" );
		vc_remove_param( "vc_row", "parallax_speed_bg" );
		vc_remove_param( "vc_row", "css_animation" );

		vc_add_param( "vc_row", array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Row stretch', 'halena' ),
			'param_name' => 'fullwidth',
			'weight' => '1',
			'value' => array(
				esc_html__( 'Default(container)', 'halena' ) => '',
				esc_html__( 'Container w/o padding', 'halena' ) => 'has-container-column-no-padding',
				esc_html__( 'Fullwidth content', 'halena' ) => 'has-fullwidth-column',
				esc_html__( 'Fullwidth content w/o padding', 'halena' ) => 'has-fullwidth-column-no-padding',
			),
			'description' => esc_html__( 'Choose any one to display the content on this paricular row. Note. This only affect the content not background.', 'halena' ),
			'std' => '',
		));

		vc_add_param( "vc_row", array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Overflow', 'halena' ),
			'param_name' => 'overflow_visible',
			'weight' => '1',
			'value' => array( esc_html__( 'Visible', 'halena' ) => '1' ),
			'std' => ''
		));

		vc_add_param( "vc_row", array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Z index', 'halena' ),
			'param_name' => 'z-index',
			'weight' => '1',
			'description' => esc_html__( 'Enter your z-index value. it will help you to move the content to back or front', 'halena' ),
			'dependency' => array( 'element' => 'overflow_visible', 'value' => '1' ),
			'std' => '',
		));
		
		$row_bg_atts = array(
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Background Choice', 'halena' ),
				'param_name' => 'bg_choice',
				'weight' => '1',
				'value' => array(
					esc_html__( 'Background Color', 'halena' ) => '1',
					esc_html__( 'Background Image', 'halena' ) => '2',
					esc_html__( 'Background Video', 'halena' ) => '3',
				),
				'description' => esc_html__( 'Choose your desired background option.', 'halena' ),
				'group' => esc_html__( 'Design Options', 'halena' ),
				'std' => '1',
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Background Color', 'halena' ),
				'param_name' => 'bg_color',
				'weight' => '1',
				'description' => esc_html__( 'Choose your desired background color for this row.', 'halena' ),
				'dependency' => array( 'element' => 'bg_choice', 'value' => '1' ),
				'group' => esc_html__( 'Design Options', 'halena' ),
				'std' => '',
			),
			array(
				'type' => 'attach_image',
				'heading' => esc_html__( 'Background Image', 'halena' ),
				'param_name' => 'bg_image',
				'weight' => '1',
				'description' => esc_html__( 'Choose your desired background image for this row', 'halena' ),
				'dependency' => array( 'element' => 'bg_choice', 'value' => '2' ),
				'group' => esc_html__( 'Design Options', 'halena' ),
				'std' => '',
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'BG Image Repeat', 'halena' ),
				'param_name' => 'bg_image_repeat',
				'weight' => '1',
				'value' => array(
					 esc_html__( 'Repeat', 'halena' ) => 'repeat',
					 esc_html__('No Repeat', 'halena') => 'no-repeat'
					),
				'description' => esc_html__( 'Choose whether your background image should be repeated to X-axis Y-axis or not.', 'halena' ),
				'dependency' => array( 'element' => 'bg_image', 'not_empty' => true),
				'group' => esc_html__( 'Design Options', 'halena' ),
				'edit_field_class' => 'vc_col-sm-3 vc_col-md-3 vc_column',
				'std' => 'repeat',
			),

			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'BG Image Size', 'halena' ),
				'param_name' => 'bg_image_size',
				'weight' => '1',
				'value' => array(
					 esc_html__('Cover', 'halena') => 'cover',
					 esc_html__( 'Auto', 'halena' ) => 'auto',
					 esc_html__( 'Contain', 'halena' ) => 'contain'
					),
				'description' => esc_html__( 'Choose your desired background image size.', 'halena' ),
				'dependency' => array( 'element' => 'bg_image', 'not_empty' => true),
				'group' => esc_html__( 'Design Options', 'halena' ),
				'edit_field_class' => 'vc_col-sm-3 vc_col-md-3 vc_column',
				'std' => 'cover',
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'BG Image Position', 'halena' ),
				'param_name' => 'bg_image_position',
				'weight' => '1',
				'value' => array(
					 esc_html__( 'center center', 'halena' ) => 'center center',
					 esc_html__( 'left top', 'halena') => 'left top',
					 esc_html__( 'left center', 'halena' ) => 'left center',
					 esc_html__( 'left bottom', 'halena' ) => 'left bottom',
					 esc_html__( 'right top', 'halena' ) => 'right top',
					 esc_html__( 'right center', 'halena' ) => 'right center',
					 esc_html__( 'right bottom', 'halena' ) => 'right bottom',
					 esc_html__( 'center top', 'halena' ) => 'center top',
					 esc_html__( 'center bottom', 'halena' ) => 'center bottom',
				),
				'description' => esc_html__( 'Choose your desired background image position', 'halena' ),
				'dependency' => array( 'element' => 'bg_image', 'not_empty' => true),
				'group' => esc_html__( 'Design Options', 'halena' ),
				'edit_field_class' => 'vc_col-sm-3 vc_col-md-3 vc_column',
				'std' => 'center center',
			),

			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'BG Image Attachment', 'halena' ),
				'param_name' => 'bg_image_attachment',
				'weight' => '1',
				'value' => array(
					 esc_html__( 'Scroll', 'halena' ) => 'scroll',
					 esc_html__( 'Fixed', 'halena' ) => 'fixed',
					),
				'description' => esc_html__( 'Choose your desired background image attachment', 'halena' ),
				'dependency' => array( 'element' => 'bg_image', 'not_empty' => true),
				'group' => esc_html__( 'Design Options', 'halena' ),
				'edit_field_class' => 'vc_col-sm-3 vc_col-md-3 vc_column',
				'std' => 'scroll'
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Fallback BG Color', 'halena' ),
				'param_name' => 'fallback_bg_color',
				'weight' => '1',
				'description' => esc_html__( 'It will replace the backgroud image on mobile devices.', 'halena' ),
				'dependency' => array( 'element' => 'bg_image', 'not_empty' => true),
				'group' => esc_html__( 'Design Options', 'halena' ),
				'std' => '',
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Background Video Source', 'halena' ),
				'param_name' => 'bg_video_src',
				'weight' => '1',
				'value' => array(
					 esc_html__( 'YouTube', 'halena' ) => '1',
					 esc_html__( 'Selfhosted/Vimeo', 'halena') => '2',
				),
				'dependency' => array( 'element' => 'bg_choice', 'value' => '3' ),
				'group' => esc_html__( 'Design Options', 'halena' ),
				'edit_field_class' => 'vc_col-xs-12 vc_column',
				'std' => '1',
			),
			array(
				'type' => 'href',
				'heading' => esc_html__( 'Video URL', 'halena' ),
				'param_name' => 'bg_video_src_yt',
				'weight' => '1',
				'description' => esc_html__( 'Enter the YouTube video url.', 'halena' ),
				'dependency' => array( 'element' => 'bg_video_src', 'value' => '1' ),
				'group' => esc_html__( 'Design Options', 'halena' ),
				'edit_field_class' => 'vc_col-xs-12 vc_column',
				'save_always' => true,
				'std' => ''
			),
			array(
				'type' => 'attach_image',
				'heading' => esc_html__( 'Fallback image for mobile & tablets', 'halena' ),
				'param_name' => 'bg_video_src_yt_fallback',
				'weight' => '1',
				'dependency' => array( 'element' => 'bg_video_src_yt', 'not_empty' => true ),
				'group' => esc_html__( 'Design Options', 'halena' ),
				'edit_field_class' => 'vc_col-xs-12 vc_column',
				'save_always' => true,
				'std' => '',
			),
			array(
				'type' => 'href',
				'heading' => esc_html__( 'Video URL', 'halena' ),
				'param_name' => 'bg_video_src_sh',
				'weight' => '1',
				'description' => wp_kses( __( 'Enter the media link from your local server. <a target="_blank" href="#">See here</a> to get the video url.', 'halena' ), array( 'a' => array( 'href' => array(), 'target' => array() ) ) ),
				'dependency' => array( 'element' => 'bg_video_src', 'value' => '2' ),
				'group' => esc_html__( 'Design Options', 'halena' ),
				'edit_field_class' => 'vc_col-xs-12 vc_column',
				'save_always' => true,
				'std' => ''
			),
			array(
				'type' => 'attach_image',
				'heading' => esc_html__( 'Poster URL', 'halena' ),
				'param_name' => 'bg_video_src_sh_poster',
				'weight' => '1',
				'description' => esc_html__( 'This poster will be displayed before video get started.', 'halena' ),
				'dependency' => array( 'element' => 'bg_video_src_sh', 'not_empty' => true ),
				'group' => esc_html__( 'Design Options', 'halena' ),
				'edit_field_class' => 'vc_col-xs-12 vc_column',
				'save_always' => true,
				'std' => '',
			),

			array(
				'type' => 'checkbox',
				'heading' => esc_html__( 'Autoplay', 'halena' ),
				'param_name' => 'bg_video_autoplay',
				'weight' => '1',
				'value' => array( esc_html__( 'Yes', 'halena' ) => '1', ),
				'dependency' => array( 'element' => 'bg_video_src', 'value' => array('1', '2') ),
				'group' => esc_html__( 'Design Options', 'halena' ),
				'edit_field_class' => 'vc_col-xs-4 vc_col-sm-2 vc_column',
				'std' => '1'
			),
			array(
				'type' => 'checkbox',
				'heading' => esc_html__( 'Loop', 'halena' ),
				'param_name' => 'bg_video_loop',
				'weight' => '1',
				'value' => array( esc_html__( 'Yes', 'halena' ) => '1', ),
				'dependency' => array( 'element' => 'bg_video_src', 'value' => array('1', '2') ),
				'group' => esc_html__( 'Design Options', 'halena' ),
				'edit_field_class' => 'vc_col-xs-4 vc_col-sm-2 vc_column',
				'std' => ''
			),
			array(
				'type' => 'checkbox',
				'heading' => esc_html__( 'Muted', 'halena' ),
				'param_name' => 'bg_video_muted',
				'weight' => '1',
				'value' => array( esc_html__( 'Yes', 'halena' ) => '1', ),
				'dependency' => array( 'element' => 'bg_video_src', 'value' => array('1', '2') ),
				'group' => esc_html__( 'Design Options', 'halena' ),
				'edit_field_class' => 'vc_col-xs-4 vc_col-sm-2 vc_column',
				'std' => ''
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Volumne Level', 'halena' ),
				'param_name' => 'bg_video_volume',
				'weight' => '1',
				'description' => esc_html__( 'Enter your volume level. it will not applicable if video is muted.', 'halena' ),
				'dependency' => array( 'element' => 'bg_video_src', 'value' => array('1', '2') ),
				'group' => esc_html__( 'Design Options', 'halena' ),
				'edit_field_class' => 'vc_col-xs-12 vc_col-sm-12 vc_column',
				'std' => '50',
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Video Quality', 'halena' ),
				'param_name' => 'bg_video_quality',
				'weight' => '1',
				'description' => esc_html__( 'Choose your video quality by default.', 'halena' ),
				'value' => array(
					 esc_html__( 'Default', 'halena' ) => 'default',
					 esc_html__( 'HD 720p', 'halena') => 'hd720',
					 esc_html__( 'FullHD 1080p', 'halena') => 'hd1080',
				),
				'dependency' => array( 'element' => 'bg_video_src', 'value' => array('1', '2') ),
				'group' => esc_html__( 'Design Options', 'halena' ),
				'edit_field_class' => 'vc_col-xs-12 vc_column',
				'std' => 'default',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Video Start at', 'halena' ),
				'param_name' => 'bg_video_start_at',
				'weight' => '1',
				'description' => esc_html__( 'Video Start at value.', 'halena' ),
				'dependency' => array( 'element' => 'bg_video_src', 'value' => array('1', '2') ),
				'group' => esc_html__( 'Design Options', 'halena' ),
				'edit_field_class' => 'vc_col-xs-12 vc_col-sm-6 vc_column',
				'std' => '0',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Video Stop At', 'halena' ),
				'param_name' => 'bg_video_stop_at',
				'weight' => '1',
				'description' => esc_html__( 'Video Stop at value.', 'halena' ),
				'dependency' => array( 'element' => 'bg_video_src', 'value' => array('1', '2') ),
				'group' => esc_html__( 'Design Options', 'halena' ),
				'edit_field_class' => 'vc_col-xs-12 vc_col-sm-6 vc_column',
				'std' => '0',
			),

			array(
				'type' => 'checkbox',
				'heading' => esc_html__( 'BG Overlay', 'halena' ),
				'param_name' => 'bg_overlay',
				'weight' => '1',
				'value' => array( esc_html__( 'Yes', 'halena' ) => '1', ),
				'dependency' => array( 'element' => 'bg_choice', 'value' => array('2', '3') ),
				'group' => esc_html__( 'Design Options', 'halena' ),
				'edit_field_class' => 'vc_col-xs-12 vc_column',
				'std' => ''
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'BG Overlay Choice', 'halena' ),
				'param_name' => 'bg_overlay_choice',
				'weight' => '1',
				'value' => array(
				 esc_html__( 'Simple', 'halena' ) => '1',
				 esc_html__( 'Simple Gradient', 'halena' ) => '2',
				 esc_html__( 'Gradient Map', 'halena' ) => '3',
				),
				'dependency' => array( 'element' => 'bg_overlay', 'value' => '1' ),
				'group' => esc_html__( 'Design Options', 'halena' ),
				'edit_field_class' => 'vc_col-xs-12 vc_column',
				'std' => '1'
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'BG Overlay Color', 'halena' ),
				'param_name' => 'bg_overlay_color',
				'weight' => '1',
				'description' => esc_html__( 'This layer will be the overlay of the background.', 'halena' ),
				'dependency' => array( 'element' => 'bg_overlay_choice', 'value' => '1' ),
				'group' => esc_html__( 'Design Options', 'halena' ),
				'std' => '',
			),
			array(
				'type' => 'textarea',
				'heading' => esc_html__( 'BG Gradient Overlay CSS', 'halena' ),
				'param_name' => 'bg_sg_overlay_css',
				'weight' => '1',
				'description' => wp_kses( __( 'Get/Type your Gradient CSS. Ref. <a target="_blank" href="http://uigradients.com/">http://uigradients.com/</a> <a target="_blank" href="http://hex2rgba.devoth.com/">HEX to RGBA converter for transparency</a>', 'halena' ), array( 'a' => array( 'href' => array(), 'target' => array() ) ) ),
				'dependency' => array( 'element' => 'bg_overlay_choice', 'value' => '2' ),
				'group' => esc_html__( 'Design Options', 'halena' ),
				'std' => '',
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'BG Gradient Map(Duotone) Overlay Color 1', 'halena' ),
				'param_name' => 'bg_gm_overlay_color1',
				'weight' => '1',
				'description' => wp_kses( __( 'Choose the color for Shadows(Dark pixels).  <a target="_blank" href="http://demo.agnidesigns.com/halena/documentation/kb/gradient-map-duotone/">See Presets</a>', 'halena' ), array( 'a' => array( 'href' => array(), 'target' => array() ) ) ),
				'dependency' => array( 'element' => 'bg_overlay_choice', 'value' => '3' ),
				'group' => esc_html__( 'Design Options', 'halena' ),
				'std' => '',
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'BG Gradient Map(Duotone) Overlay Color 2', 'halena' ),
				'param_name' => 'bg_gm_overlay_color2',
				'weight' => '1',
				'description' => esc_html__( 'Choose the mid-tone color. You can leave this empty for no mid-tone.', 'halena' ),
				'dependency' => array( 'element' => 'bg_overlay_choice', 'value' => '3' ),
				'group' => esc_html__( 'Design Options', 'halena' ),
				'std' => '',
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'BG Gradient Map(Duotone) Overlay Color 3', 'halena' ),
				'param_name' => 'bg_gm_overlay_color3',
				'weight' => '1',
				'description' => esc_html__( 'Choose the color for Highlights(White pixels).', 'halena' ),
				'dependency' => array( 'element' => 'bg_overlay_choice', 'value' => '3' ),
				'group' => esc_html__( 'Design Options', 'halena' ),
				'std' => '',
			),

		);
		vc_add_params( "vc_row", $row_bg_atts );

		$row_space_atts = array(
			array(
				'type' => 'agni_param_heading',
				'heading' => esc_html__( 'For All devices', 'halena' ),
				'param_name' => 'spacing_heading',
				'description' => esc_html__( 'Below values will be applied to all devices. You can use px, em, %, etc. or enter just number and it will use pixels.', 'halena' ),
				'group' => esc_html__( 'Design Options', 'halena' ),
				'edit_field_class' => 'vc_col-sm-12 vc_col-md-12 vc_column',
				'std' => '',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Margin Top', 'halena' ),
				'param_name' => 'margin_top',
				'group' => esc_html__( 'Design Options', 'halena' ),
				'edit_field_class' => 'vc_col-sm-3 vc_col-md-3 vc_column',
				'std' => '',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Margin Right', 'halena' ),
				'param_name' => 'margin_right',
				'group' => esc_html__( 'Design Options', 'halena' ),
				'edit_field_class' => 'vc_col-sm-3 vc_col-md-3 vc_column',
				'std' => '',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Margin Bottom', 'halena' ),
				'param_name' => 'margin_bottom',
				'group' => esc_html__( 'Design Options', 'halena' ),
				'edit_field_class' => 'vc_col-sm-3 vc_col-md-3 vc_column',
				'std' => '',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Margin Left', 'halena' ),
				'param_name' => 'margin_left',
				'group' => esc_html__( 'Design Options', 'halena' ),
				'edit_field_class' => 'vc_col-sm-3 vc_col-md-3 vc_column',
				'std' => '',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Padding Top', 'halena' ),
				'param_name' => 'padding_top',
				'group' => esc_html__( 'Design Options', 'halena' ),
				'edit_field_class' => 'vc_col-sm-3 vc_col-md-3 vc_column',
				'std' => '',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Padding Right', 'halena' ),
				'param_name' => 'padding_right',
				'group' => esc_html__( 'Design Options', 'halena' ),
				'edit_field_class' => 'vc_col-sm-3 vc_col-md-3 vc_column',
				'std' => '',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Padding Bottom', 'halena' ),
				'param_name' => 'padding_bottom',
				'group' => esc_html__( 'Design Options', 'halena' ),
				'edit_field_class' => 'vc_col-sm-3 vc_col-md-3 vc_column',
				'std' => '',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Padding Left', 'halena' ),
				'param_name' => 'padding_left',
				'group' => esc_html__( 'Design Options', 'halena' ),
				'edit_field_class' => 'vc_col-sm-3 vc_col-md-3 vc_column',
				'std' => '',
			),

			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Border Top', 'halena' ),
				'param_name' => 'border_top',
				'description' => esc_html__( 'Don\'t include "px" string', 'halena' ),
				'group' => esc_html__( 'Design Options', 'halena' ),
				'edit_field_class' => 'vc_col-sm-3 vc_col-md-3 vc_column',
				'std' => '',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Border Right', 'halena' ),
				'param_name' => 'border_right',
				'group' => esc_html__( 'Design Options', 'halena' ),
				'edit_field_class' => 'vc_col-sm-3 vc_col-md-3 vc_column',
				'std' => '',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Border Bottom', 'halena' ),
				'param_name' => 'border_bottom',
				'group' => esc_html__( 'Design Options', 'halena' ),
				'edit_field_class' => 'vc_col-sm-3 vc_col-md-3 vc_column',
				'std' => '',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Border Left', 'halena' ),
				'param_name' => 'border_left',
				'group' => esc_html__( 'Design Options', 'halena' ),
				'edit_field_class' => 'vc_col-sm-3 vc_col-md-3 vc_column',
				'std' => '',
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Border Color', 'halena' ),
				'param_name' => 'border_color',
				'description' => esc_html__( 'Choose your desired for the border.', 'halena' ),
				'group' => esc_html__( 'Design Options', 'halena' ),
				'edit_field_class' => 'vc_col-sm-4 vc_col-md-4 vc_column',
				'std' => '',
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Border Style', 'halena' ),
				'param_name' => 'border_style',
				'value' => array(
					 esc_html__( 'No style', 'halena' ) => '',
					 esc_html__( 'Solid', 'halena' ) => 'solid',
					 esc_html__( 'Dashed', 'halena' ) => 'dashed',
					 esc_html__( 'Dotted', 'halena' ) => 'dotted',
					 esc_html__( 'Double', 'halena' ) => 'double',
					),
				'description' => esc_html__( 'Choose your desired border style.', 'halena' ),
				'group' => esc_html__( 'Design Options', 'halena' ),
				'edit_field_class' => 'vc_col-sm-4 vc_col-md-4 vc_column',
				'std' => '',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Border Radius', 'halena' ),
				'param_name' => 'border_radius',
				'description' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels.', 'halena' ),
				'group' => esc_html__( 'Design Options', 'halena' ),
				'edit_field_class' => 'vc_col-sm-4 vc_col-md-4 vc_column',
				'std' => '',
			),

			// For tab

			array(
				'type' => 'agni_param_heading',
				'heading' => esc_html__( 'For <= Tab devices', 'halena' ),
				'param_name' => 'spacing_heading_tab',
				'description' => esc_html__( 'Below values will be applied to the resolutions which are equal or greater than Desktop devices. You can use px, em, %, etc. or enter just number and it will use pixels.', 'halena' ),
				'group' => esc_html__( 'Design Options', 'halena' ),
				'edit_field_class' => 'vc_col-sm-12 vc_col-md-12 vc_column',
				'std' => '',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Margin Top', 'halena' ),
				'param_name' => 'margin_top_tab',
				'group' => esc_html__( 'Design Options', 'halena' ),
				'edit_field_class' => 'vc_col-sm-3 vc_col-md-3 vc_column',
				'std' => '',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Margin Right', 'halena' ),
				'param_name' => 'margin_right_tab',
				'group' => esc_html__( 'Design Options', 'halena' ),
				'edit_field_class' => 'vc_col-sm-3 vc_col-md-3 vc_column',
				'std' => '',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Margin Bottom', 'halena' ),
				'param_name' => 'margin_bottom_tab',
				'group' => esc_html__( 'Design Options', 'halena' ),
				'edit_field_class' => 'vc_col-sm-3 vc_col-md-3 vc_column',
				'std' => '',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Margin Left', 'halena' ),
				'param_name' => 'margin_left_tab',
				'group' => esc_html__( 'Design Options', 'halena' ),
				'edit_field_class' => 'vc_col-sm-3 vc_col-md-3 vc_column',
				'std' => '',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Padding Top', 'halena' ),
				'param_name' => 'padding_top_tab',
				'group' => esc_html__( 'Design Options', 'halena' ),
				'edit_field_class' => 'vc_col-sm-3 vc_col-md-3 vc_column',
				'std' => '',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Padding Right', 'halena' ),
				'param_name' => 'padding_right_tab',
				'group' => esc_html__( 'Design Options', 'halena' ),
				'edit_field_class' => 'vc_col-sm-3 vc_col-md-3 vc_column',
				'std' => '',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Padding Bottom', 'halena' ),
				'param_name' => 'padding_bottom_tab',
				'group' => esc_html__( 'Design Options', 'halena' ),
				'edit_field_class' => 'vc_col-sm-3 vc_col-md-3 vc_column',
				'std' => '',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Padding Left', 'halena' ),
				'param_name' => 'padding_left_tab',
				'group' => esc_html__( 'Design Options', 'halena' ),
				'edit_field_class' => 'vc_col-sm-3 vc_col-md-3 vc_column',
				'std' => '',
			),

			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Border Top', 'halena' ),
				'param_name' => 'border_top_tab',
				'description' => esc_html__( 'Don\'t include "px" string', 'halena' ),
				'group' => esc_html__( 'Design Options', 'halena' ),
				'edit_field_class' => 'vc_col-sm-3 vc_col-md-3 vc_column',
				'std' => '',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Border Right', 'halena' ),
				'param_name' => 'border_right_tab',
				'group' => esc_html__( 'Design Options', 'halena' ),
				'edit_field_class' => 'vc_col-sm-3 vc_col-md-3 vc_column',
				'std' => '',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Border Bottom', 'halena' ),
				'param_name' => 'border_bottom_tab',
				'group' => esc_html__( 'Design Options', 'halena' ),
				'edit_field_class' => 'vc_col-sm-3 vc_col-md-3 vc_column',
				'std' => '',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Border Left', 'halena' ),
				'param_name' => 'border_left_tab',
				'group' => esc_html__( 'Design Options', 'halena' ),
				'edit_field_class' => 'vc_col-sm-3 vc_col-md-3 vc_column',
				'std' => '',
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Border Color', 'halena' ),
				'param_name' => 'border_color_tab',
				'description' => esc_html__( 'Choose your desired for the border.', 'halena' ),
				'group' => esc_html__( 'Design Options', 'halena' ),
				'edit_field_class' => 'vc_col-sm-4 vc_col-md-4 vc_column',
				'std' => '',
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Border Style', 'halena' ),
				'param_name' => 'border_style_tab',
				'value' => array(
					 esc_html__( 'No style', 'halena' ) => '',
					 esc_html__( 'Solid', 'halena' ) => 'solid',
					 esc_html__( 'Dashed', 'halena' ) => 'dashed',
					 esc_html__( 'Dotted', 'halena' ) => 'dotted',
					 esc_html__( 'Double', 'halena' ) => 'double',
					),
				'description' => esc_html__( 'Choose your desired border style.', 'halena' ),
				'group' => esc_html__( 'Design Options', 'halena' ),
				'edit_field_class' => 'vc_col-sm-4 vc_col-md-4 vc_column',
				'std' => '',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Border Radius', 'halena' ),
				'param_name' => 'border_radius_tab',
				'description' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels.', 'halena' ),
				'group' => esc_html__( 'Design Options', 'halena' ),
				'edit_field_class' => 'vc_col-sm-4 vc_col-md-4 vc_column',
				'std' => '',
			),

			// for desktop
			array(
				'type' => 'agni_param_heading',
				'heading' => esc_html__( 'For <= Mobile devices', 'halena' ),
				'param_name' => 'spacing_heading_mobile',
				'description' => esc_html__( 'Below values will be applied to the resolutions which are equal or greater than Tablet devices. You can use px, em, %, etc. or enter just number and it will use pixels.', 'halena' ),
				'group' => esc_html__( 'Design Options', 'halena' ),
				'edit_field_class' => 'vc_col-sm-12 vc_col-md-12 vc_column',
				'std' => '',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Margin Top', 'halena' ),
				'param_name' => 'margin_top_mobile',
				'group' => esc_html__( 'Design Options', 'halena' ),
				'edit_field_class' => 'vc_col-sm-3 vc_col-md-3 vc_column',
				'std' => '',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Margin Right', 'halena' ),
				'param_name' => 'margin_right_mobile',
				'group' => esc_html__( 'Design Options', 'halena' ),
				'edit_field_class' => 'vc_col-sm-3 vc_col-md-3 vc_column',
				'std' => '',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Margin Bottom', 'halena' ),
				'param_name' => 'margin_bottom_mobile',
				'group' => esc_html__( 'Design Options', 'halena' ),
				'edit_field_class' => 'vc_col-sm-3 vc_col-md-3 vc_column',
				'std' => '',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Margin Left', 'halena' ),
				'param_name' => 'margin_left_mobile',
				'group' => esc_html__( 'Design Options', 'halena' ),
				'edit_field_class' => 'vc_col-sm-3 vc_col-md-3 vc_column',
				'std' => '',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Padding Top', 'halena' ),
				'param_name' => 'padding_top_mobile',
				'group' => esc_html__( 'Design Options', 'halena' ),
				'edit_field_class' => 'vc_col-sm-3 vc_col-md-3 vc_column',
				'std' => '',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Padding Right', 'halena' ),
				'param_name' => 'padding_right_mobile',
				'group' => esc_html__( 'Design Options', 'halena' ),
				'edit_field_class' => 'vc_col-sm-3 vc_col-md-3 vc_column',
				'std' => '',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Padding Bottom', 'halena' ),
				'param_name' => 'padding_bottom_mobile',
				'group' => esc_html__( 'Design Options', 'halena' ),
				'edit_field_class' => 'vc_col-sm-3 vc_col-md-3 vc_column',
				'std' => '',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Padding Left', 'halena' ),
				'param_name' => 'padding_left_mobile',
				'group' => esc_html__( 'Design Options', 'halena' ),
				'edit_field_class' => 'vc_col-sm-3 vc_col-md-3 vc_column',
				'std' => '',
			),

			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Border Top', 'halena' ),
				'param_name' => 'border_top_mobile',
				'description' => esc_html__( 'Don\'t include "px" string', 'halena' ),
				'group' => esc_html__( 'Design Options', 'halena' ),
				'edit_field_class' => 'vc_col-sm-3 vc_col-md-3 vc_column',
				'std' => '',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Border Right', 'halena' ),
				'param_name' => 'border_right_mobile',
				'group' => esc_html__( 'Design Options', 'halena' ),
				'edit_field_class' => 'vc_col-sm-3 vc_col-md-3 vc_column',
				'std' => '',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Border Bottom', 'halena' ),
				'param_name' => 'border_bottom_mobile',
				'group' => esc_html__( 'Design Options', 'halena' ),
				'edit_field_class' => 'vc_col-sm-3 vc_col-md-3 vc_column',
				'std' => '',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Border Left', 'halena' ),
				'param_name' => 'border_left_mobile',
				'group' => esc_html__( 'Design Options', 'halena' ),
				'edit_field_class' => 'vc_col-sm-3 vc_col-md-3 vc_column',
				'std' => '',
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Border Color', 'halena' ),
				'param_name' => 'border_color_mobile',
				'description' => esc_html__( 'Choose your desired for the border.', 'halena' ),
				'group' => esc_html__( 'Design Options', 'halena' ),
				'edit_field_class' => 'vc_col-sm-4 vc_col-md-4 vc_column',
				'std' => '',
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Border Style', 'halena' ),
				'param_name' => 'border_style_mobile',
				'value' => array(
					 esc_html__( 'No style', 'halena' ) => '',
					 esc_html__( 'Solid', 'halena' ) => 'solid',
					 esc_html__( 'Dashed', 'halena' ) => 'dashed',
					 esc_html__( 'Dotted', 'halena' ) => 'dotted',
					 esc_html__( 'Double', 'halena' ) => 'double',
					),
				'description' => esc_html__( 'Choose your desired border style.', 'halena' ),
				'group' => esc_html__( 'Design Options', 'halena' ),
				'edit_field_class' => 'vc_col-sm-4 vc_col-md-4 vc_column',
				'std' => '',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Border Radius', 'halena' ),
				'param_name' => 'border_radius_mobile',
				'description' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels.', 'halena' ),
				'group' => esc_html__( 'Design Options', 'halena' ),
				'edit_field_class' => 'vc_col-sm-4 vc_col-md-4 vc_column',
				'std' => '',
			),
		);

		vc_add_params( "vc_row", $row_space_atts );

		$row_parallax_atts = array(
			array(
				'type' => 'checkbox',
				'heading' => esc_html__( 'Background Parallax', 'halena' ),
				'param_name' => 'bg_parallax',
				'description' => wp_kses( __( 'Recommened - Choose "Background attachment: fixed" at Design Options for seemless parallax. This parallax effect is purely based on skrollr plugin. You can do tons of things by refer this <a href="https://github.com/Prinzhorn/skrollr">Skrollr</a>.', 'halena' ), array( 'a' => array( 'href' => array() ) ) ),
				'value' => array( esc_html__( 'Enable', 'halena' ) => '1' ),
				'group' => esc_html__( 'Parallax Settings', 'halena' ),
				'dependency' => array( 'element' => 'bg_choice', 'value' => array( '1', '2' ) ),
				'std' => '',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Element\'s Top at the Bottom.', 'halena' ),
				'param_name' => 'data_bottom_top',
				'description' => esc_html__( 'Enter the values for ex. background-color: rgba(255, 255, 255, 1), it will be triggered when the element\'s top at the bottom.', 'halena' ),
				'group' => esc_html__( 'Parallax Settings', 'halena' ),
				'dependency' => array( 'element' => 'bg_parallax', 'value' => '1' ),
				'std' => 'background-position: 0px 200px'
				
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Element\'s Center at the Center.', 'halena' ),
				'param_name' => 'data_center',
				'description' => esc_html__( 'It will be triggered when the element\'s center at the center.', 'halena' ),
				'group' => esc_html__( 'Parallax Settings', 'halena' ),
				'dependency' => array( 'element' => 'bg_parallax', 'value' => '1' ),
				'std' => 'background-position: 0px 0px'
				
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Element\'s Bottom reach the Top.', 'halena' ),
				'param_name' => 'data_top_bottom',
				'description' => esc_html__( 'It will be triggered when the element\'s bottom at the Top.', 'halena' ),
				'group' => esc_html__( 'Parallax Settings', 'halena' ),
				'dependency' => array( 'element' => 'bg_parallax', 'value' => '1' ),
				'std' => 'background-position: 0px -200px;'
				
			)
		);
		vc_add_params( "vc_row", $row_parallax_atts );

		// Column 
		vc_remove_param( "vc_column", "css_animation" );
		vc_remove_param( "vc_column", "css" );
		vc_remove_param("vc_column", "video_bg");
		vc_remove_param("vc_column", "video_bg_url");
		vc_remove_param("vc_column", "video_bg_parallax");
		vc_remove_param("vc_column", "parallax");
		vc_remove_param("vc_column", "parallax_speed_video");
		vc_remove_param("vc_column", "parallax_speed_bg");
		vc_remove_param("vc_column", "parallax_image");

		global $vc_column_width_list;
		$vc_column_width_list = array(
			esc_html__( '1 column - 1/12', 'halena' ) => '1/12',
			esc_html__( '2 columns - 1/6', 'halena' ) => '1/6',
			esc_html__( '3 columns - 1/4', 'halena' ) => '1/4',
			esc_html__( '4 columns - 1/3', 'halena' ) => '1/3',
			esc_html__( '5 columns - 5/12', 'halena' ) => '5/12',
			esc_html__( '6 columns - 1/2', 'halena' ) => '1/2',
			esc_html__( '7 columns - 7/12', 'halena' ) => '7/12',
			esc_html__( '8 columns - 2/3', 'halena' ) => '2/3',
			esc_html__( '9 columns - 3/4', 'halena' ) => '3/4',
			esc_html__( '10 columns - 5/6', 'halena' ) => '5/6',
			esc_html__( '11 column - 11/12', 'halena' ) => '11/12',
			esc_html__( '12 columns - 1/1', 'halena' ) => '1/1'
		);

		$animation_atts = array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Animation', 'halena' ),
			'description' => esc_html__( 'It will enable the animation for this particular element.', 'halena' ),
			'param_name' => 'animation',
			'group' => esc_html__( 'Animation Settings', 'halena' ),
			'value' => array( esc_html__( 'Yes', 'halena' ) => '1' ),
			'std' => ''
		);
		$animation_style_atts = array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Animation Style', 'halena' ),
			'param_name' => 'animation_style',
			'value' => array(
				'No Animation' => '',
				'fadeIn'    => 'fadeIn',
				'fadeInUp'  => 'fadeInUp',
				'fadeInDown'    => 'fadeInDown',
				'fadeInLeft'    => 'fadeInLeft',
				'fadeInRight'   => 'fadeInRight',
				'zoomIn'    => 'zoomIn',
				'bounceIn'  => 'bounceIn',
				'flipInX'   => 'flipInX',
				'flipInY'   => 'flipInY',
				'rotateIn'  => 'rotateIn',
				'rotateInDownLeft'  => 'rotateInDownLeft',
				'rotateInDownRight' => 'rotateInDownRight',
				'rotateInUpLeft'    => 'rotateInUpLeft',
				'rotateInUpRight'   => 'rotateInUpRight',
				'slideInDown'   => 'slideInDown',
				'slideInLeft'   => 'slideInLeft',
				'slideInRight'  => 'slideInRight',
				'slideInUp' => 'slideInUp',
			),
			'description' => esc_html__( 'Select how the content will be aligned in column', 'halena' ),
			'group' => esc_html__( 'Animation Settings', 'halena' ),
			'dependency' => array( 'element' => 'animation', 'value' => '1' ),
			'std' => 'fadeInUp'
		);

		$animation_delay_atts = array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Animation Delay', 'halena' ),
			'description' => esc_html__( 'Delay in seconds. for ex 0.4', 'halena' ),
			'param_name' => 'animation_delay',
			'group' => esc_html__( 'Animation Settings', 'halena' ),
			'dependency' => array( 'element' => 'animation', 'value' => '1' ),
			'std' => '0.4',
			
		);
		$animation_duration_atts = array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Animation Duration', 'halena' ),
			'description' => esc_html__( 'Duration in seconds. for ex 0.4', 'halena' ),
			'param_name' => 'animation_duration',
			'group' => esc_html__( 'Animation Settings', 'halena' ),
			'dependency' => array( 'element' => 'animation', 'value' => '1' ),
			'std' => '0.8',
			
		);
		$animation_offset_atts = array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Animation Offset', 'halena' ),
			'param_name' => 'animation_offset',
			'description' => esc_html__( 'You can use "simply number" or "%" to denote the offset. for ex. 90%. It will trigger the animation only when the element reach 90% from the top.', 'halena' ),
			'group' => esc_html__( 'Animation Settings', 'halena' ),
			'dependency' => array( 'element' => 'animation', 'value' => '1' ),
			'std' => '95%',
		);

		$col_animation_atts = array(
			$animation_atts, 
			$animation_style_atts, 
			$animation_duration_atts, 
			$animation_delay_atts, 
			$animation_offset_atts
		);
		$parallax_atts = array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Parallax', 'halena' ),
			'description' => esc_html__( 'It will enable the parallax effect for this particular element.', 'halena' ),
			'param_name' => 'parallax',
			'value' => array( esc_html__( 'Yes', 'halena' ) => '1' ),
			'group' => esc_html__( 'Parallax Settings', 'halena' ),
			'std' => ''
		);
		$parallax_start_atts = array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Parallax Start value', 'halena' ),
			'description' => esc_html__( 'Enter your starting value of parallax for ex. transform:translateY(0px);', 'halena' ),
			'param_name' => 'parallax_start',
			'group' => esc_html__( 'Parallax Settings', 'halena' ),
			'dependency' => array( 'element' => 'parallax', 'value' => '1' ),
			'std' => 'transform:translateY(50px);'
		);
		$parallax_end_atts = array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Parallax End value', 'halena' ),
			'description' => esc_html__( 'Enter your end value of parallax for ex. transform:translateY(-100px);', 'halena' ),
			'param_name' => 'parallax_end',
			'group' => esc_html__( 'Parallax Settings', 'halena' ),
			'dependency' => array( 'element' => 'parallax', 'value' => '1' ),
			'std' => 'transform:translateY(-50px);'
		);

		$col_parallax_atts = array(
			$parallax_atts,
			$parallax_start_atts,
			$parallax_end_atts
		);

		$col_general_atts = array(
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Column Alignment', 'halena' ),
				'param_name' => 'align',
				'weight' => '1',
				'value' => array(
					 esc_html__( 'Left', 'halena' ) => 'left',
					 esc_html__( 'Right', 'halena' ) => 'right',
					 esc_html__( 'Center', 'halena') => 'center'
					),
				'description' => esc_html__( 'Choose your desired Column\'s Text Alignment.', 'halena' ),
				'std' => 'left',
			),
			array(
				'type' => 'checkbox',
				'heading' => esc_html__( 'Dark Mode', 'halena' ),
				'param_name' => 'dark_mode',
				'weight' => '2',
				'description' => esc_html__( 'It will make your column\'s content/text color to white.', 'halena' ),
				'value' => array( esc_html__( 'Yes', 'halena' ) => 'has-dark-mode' ),
				'std' => '',
			),
			array(
				'type' => 'checkbox',
				'heading' => esc_html__( 'Full height', 'halena' ),
				'param_name' => 'column_fullheight',
				'weight' => '3',
				'description' => esc_html__( 'It will make your column height to 100% of the view port.', 'halena' ),
				'value' => array( esc_html__( 'Yes', 'halena' ) => '1' ),
				'std' => '',
			),
		);

		$col_bg_edge_atts = array(
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Pull BG', 'halena' ),
				'param_name' => 'bg_edge',
				'weight' => '1',
				'description' => esc_html__( 'It will pull the background element to the left/right edge.', 'halena' ),
				'value' => array(
				 esc_html__( 'None', 'halena' ) => '',
				 esc_html__( 'Left', 'halena' ) => 'left',
				 esc_html__( 'Right', 'halena' ) => 'right',
				),
				'group' => esc_html__( 'Design Options', 'halena' ),
				'edit_field_class' => 'vc_col-xs-12 vc_column',
				'std' => ''
			),
		);

		// VC Column
		vc_add_params( "vc_column", $col_animation_atts );
		vc_add_params( "vc_column", $col_parallax_atts );
		vc_add_params( "vc_column", $col_general_atts );
		vc_add_params( "vc_column", $row_bg_atts );
		vc_add_params( "vc_column", $col_bg_edge_atts );
		vc_add_params( "vc_column", $row_space_atts );
		vc_add_params( "vc_column", $row_parallax_atts );

		// VC Row inner
		vc_remove_param( "vc_row_inner", "css" );

		vc_add_param( "vc_row_inner", array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Dark Mode', 'halena' ),
			'param_name' => 'dark_mode',
			'weight' => '1',
			'description' => esc_html__( 'It will make your column\'s content/text color to white.', 'halena' ),
			'value' => array( esc_html__( 'Yes', 'halena' ) => 'has-dark-mode' ),
			'std' => '',
		));

		vc_add_params( "vc_row_inner", $row_bg_atts );
		vc_add_params( "vc_row_inner", $row_space_atts );
		vc_add_params( "vc_row_inner", $row_parallax_atts );

		// VC Column inner
		vc_remove_param( "vc_column_inner", "css" );

		vc_add_params( "vc_column_inner", $col_animation_atts );
		vc_add_params( "vc_column_inner", $col_general_atts );
		vc_add_params( "vc_column_inner", $row_bg_atts );
		vc_add_params( "vc_column_inner", $row_parallax_atts );
		vc_add_params( "vc_column_inner", $row_space_atts );

		/* VC Text block */
		vc_remove_param( "vc_column_text", "css_animation" );
		vc_remove_param( "vc_column_text", "css" );

		vc_add_params( "vc_column_text", $row_space_atts );
		vc_add_params( "vc_column_text", $col_animation_atts );
		vc_add_params( "vc_column_text", $col_parallax_atts );

		/* VC Custom Heading */

		vc_remove_param( "vc_custom_heading", "source" );
		vc_remove_param( "vc_custom_heading", "css" );

		vc_add_params( "vc_custom_heading", $row_space_atts );
		vc_add_params( "vc_custom_heading", $col_animation_atts );
		vc_add_params( "vc_custom_heading", $col_parallax_atts );
		vc_add_param( "vc_custom_heading", array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Choose Icon', 'halena' ),
			'param_name' => 'icon',
			'weight' => '1',
			'value' => '',
			'settings' => array(
				'type' => 'iconlist',
				'iconsPerPage' => 545,
			),
			'description' => wp_kses( __( '<small>Select the icon which you want <strong><a href="http://ionicons.com/">Ionicons</a>, <a href="http://fortawesome.github.io/Font-Awesome/icons/">FontAwesome</a>, <a href="http://themes-pixeden.com/font-demos/7-stroke/index.html">Pe Icon 7 Stroke</a>, <a href="http://themes-pixeden.com/font-demos/7-filled/index.html">Pe Icon 7 Filled</a> supported.</strong></small>', 'halena' ), array( 'small' => array(), 'strong' => array(), 'a' => array( 'href' => array() ) ) ),
			'std' => ''
		));
		vc_add_param( "vc_custom_heading", array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Divide Line', 'halena' ),
			'description' => esc_html__( 'It will display fancy line below the heading/Title.' , 'halena' ),
			'param_name' => 'divide_line',
			'weight' => '1',
			'value' => array( esc_html__( 'Yes', 'halena' ) => 'yes' ),
			'std' => '',
		));
		vc_add_param( "vc_custom_heading", array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Divide Line Width', 'halena' ),
			'param_name' => 'divide_line_width',
			'weight' => '1',
			'description' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels.' , 'halena' ),
			'dependency' => array( 'element' => 'divide_line', 'value' => 'yes' ),
			'std' => '80'
		));
		vc_add_param( "vc_custom_heading", array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Divide Line Height', 'halena' ),
			'param_name' => 'divide_line_height',
			'weight' => '1',
			'description' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels.', 'halena' ),
			'dependency' => array( 'element' => 'divide_line', 'value' => 'yes' ),
			'std' => '2'
		));
		vc_add_param( "vc_custom_heading", array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Divide Line Color', 'halena' ),
			'param_name' => 'divide_line_color',
			'weight' => '1',
			'description' => esc_html__( 'Choose your desired color for the Divide Line.', 'halena' ),
			'dependency' => array( 'element' => 'divide_line', 'value' => 'yes' ),
			'std' => '#1e1e20',
		));
		vc_add_param( "vc_custom_heading", array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Letter Spacing', 'halena' ),
			'param_name' => 'custom_heading_letter_spacing',
			'weight' => '0',
			'description' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels.', 'halena' ),
			'std' => ''
		));
		vc_add_param( "vc_custom_heading", array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Font Weight', 'halena' ),
			'param_name' => 'custom_heading_font_weight',
			'weight' => '0',
			'value' => array(
				 esc_html__( 'Default', 'halena' ) => '',
				 esc_html__( '200', 'halena') => '200',
				 esc_html__( '300', 'halena') => '300',
				 esc_html__( '400', 'halena') => '400',
				 esc_html__( '500', 'halena') => '500',
				 esc_html__( '600', 'halena') => '600',
				 esc_html__( '700', 'halena' ) => '700',   
				),

			'description' => esc_html__( 'Choose your desired font weight. Note: Some options may not be applicable for the choosen font. make sure that you have added this font weight at option panel', 'halena' ),
			'dependency' => array( 'element' => 'use_theme_fonts', 'value' => 'yes' ),
			'std' => ''
		));
		vc_add_param( "vc_custom_heading", array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Font Italic', 'halena' ),
			'description' => esc_html__( 'This options may/may not be applicable for the choosen font.' , 'halena' ),
			'param_name' => 'font_italic',
			'weight' => '0',
			'value' => array( esc_html__( 'Yes', 'halena' ) => 'yes' ),
			'std' => '',
		));

		vc_add_param( "vc_custom_heading", array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Responsive Font Size', 'halena' ),
			'description' => esc_html__( 'This will reduce the font size in order to fit with screen.' , 'halena' ),
			'param_name' => 'responsive_font_size',
			'weight' => '0',
			'value' => array( esc_html__( 'Yes', 'halena' ) => 'yes' ),
			'std' => '',
		));
		vc_add_param( "vc_custom_heading", array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Font size for tablets', 'halena' ),
			'param_name' => 'custom_font_size_tab',
			'weight' => '0',
			'description' => esc_html__( 'Enter responsive font size. You can use px, em, %, etc. or enter just number and it will use pixels.' , 'halena' ),
			'dependency' => array( 'element' => 'responsive_font_size', 'value' => 'yes' ),
			'std' => '',
			'edit_field_class' => 'vc_col-xs-4 vc_col-sm-4 vc_column'
		));
		vc_add_param( "vc_custom_heading", array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Font size for Mobile', 'halena' ),
			'param_name' => 'custom_font_size_mobile',
			'weight' => '0',
			'dependency' => array( 'element' => 'responsive_font_size', 'value' => 'yes' ),
			'std' => '',
			'edit_field_class' => 'vc_col-xs-4 vc_col-sm-4 vc_column'
		));

		vc_add_param( "vc_custom_heading", array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Vertical Text', 'halena' ),
			'description' => esc_html__( 'It will rotate text to 90 degree.' , 'halena' ),
			'param_name' => 'vertical_text',
			'weight' => '0',
			'value' => array( esc_html__( 'Yes', 'halena' ) => 'yes' ),
			'std' => '',
		));

		// tabs @deprecated
		vc_add_param("vc_tab", array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Active Tab', 'halena' ),
			'param_name' => 'active',
			'description' => esc_html__( 'It will make this tab Active.', 'halena' ),
			'value' => array( esc_html__( 'Yes', 'halena' ) => 'active' ),
			'std' => ''
		));

		vc_remove_param("vc_tabs", "interval");
		vc_remove_param("vc_tabs", "title");
		vc_add_param("vc_tabs", array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Tabs Style', 'halena' ),
			'param_name' => 'style',
			'weight' => '1',
			'value' => array(
				 esc_html__('Underlined', 'halena') => '1',
				 esc_html__('Bordered', 'halena' ) => '2',                      
				 esc_html__('Backgrounded', 'halena' ) => '3'
				),
			'description' => esc_html__( 'Choose your desired tabs style', 'halena' ),
			'std' => '1'
		));
		vc_add_param( "vc_tabs", array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Tab Radius', 'halena' ),
			'param_name' => 'radius',
			'weight' => '1',
			'description' => esc_html__( 'It will add radius to an active tab. You can use px, em, %, etc. or enter just number and it will use pixels.', 'halena' ),
			'std' => ''
		));
		vc_add_param( "vc_tabs", array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Tabs Alignment', 'halena' ),
			'param_name' => 'align',
			'weight' => '1',
			'value' => array(
				 esc_html__('Center', 'halena') => 'center',
				 esc_html__( 'Left', 'halena' ) => 'left',                      
				 esc_html__( 'Right', 'halena' ) => 'right'
				),
			'description' => esc_html__( 'Choose your desired tabs alignment.', 'halena' ),
			'std' => 'left'
		));
		vc_add_param("vc_tabs", array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Vertical Tabs?', 'halena' ),
			'param_name' => 'vertical',
			'weight' => '1',
			'description' => esc_html__( 'It will display the tabs vertically.', 'halena' ),
			'value' => array( esc_html__( 'Yes', 'halena' ) => 'vertical' ),
			'std' => ''
		));
		vc_add_param( "vc_tabs", array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Vertical Tabs Alignment', 'halena' ),
			'param_name' => 'vertical_align',
			'weight' => '1',
			'value' => array(
				 esc_html__('Center', 'halena') => 'center',
				 esc_html__( 'Left', 'halena' ) => 'left',                      
				 esc_html__( 'Right', 'halena' ) => 'right'
				),
			'description' => esc_html__( 'Choose your desired vertical tabs alignment. Note. it will not affect tabs content.', 'halena' ),
					'dependency' => array( 'element' => 'vertical', 'value' => 'vertical' ),
			'std' => 'left'
		));

		// Accordions  @deprecated
		// accordion & toggle
		vc_remove_param("vc_accordion_tab", "el_id");
		vc_add_param("vc_accordion_tab", array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Active', 'halena' ),
			'param_name' => 'active',
			'description' => esc_html__( 'It will make this accordion tab Active.', 'halena' ),
			'value' => array( esc_html__( 'Yes', 'halena' ) => 'in' ),
			'std' => ''
		));

		vc_remove_param("vc_accordion", "interval");
		vc_remove_param("vc_accordion", "collapsible");
		vc_remove_param("vc_accordion", "active_tab");
		vc_remove_param("vc_accordion", "disable_keyboard");
		vc_remove_param("vc_accordion", "title");
		vc_add_param("vc_accordion", array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Accordion Style', 'halena' ),
			'param_name' => 'style',
			'weight' => '1',
			'value' => array(
				 esc_html__('Style 1', 'halena') => '1',
				 esc_html__('Style 2', 'halena' ) => '2',                       
				 esc_html__('Style 3', 'halena' ) => '3'
				),
			'description' => esc_html__( 'Choose your desired accordion style', 'halena' ),
			'std' => '1'
		));
		vc_add_param( "vc_accordion", array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Alignment', 'halena' ),
			'param_name' => 'alignment',
			'weight' => '1',
			'value' => array(
				 esc_html__( 'Center', 'halena') => 'center',
				 esc_html__( 'Left', 'halena' ) => 'left',                      
				 esc_html__( 'Right', 'halena' ) => 'right'
				),
			'description' => esc_html__( 'Choose your desired accordion alignment', 'halena' ),
			'std' => 'left'
		));
		vc_add_param("vc_accordion", array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Not an Accordion?', 'halena' ),
			'param_name' => 'choice',
			'description' => esc_html__( 'It will make each accordion independent and make it as a toggle.', 'halena' ),
			'value' => array( esc_html__( 'Yes', 'halena' ) => 'yes' ),
			'std' => ''
		));

		$empty_space_atts = array(
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Height on Tablets(Optional)', 'halena' ),
				'param_name' => 'height_tab',
				'description' => esc_html__( 'Enter your desired height on tablets. Leave it empty it will inherit the main value.', 'halena' ),
				'std' => '',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Height on Mobile(Optional)', 'halena' ),
				'param_name' => 'height_mobile',
				'description' => esc_html__( 'Enter your desired height on tablets. Leave it empty it will inherit the main value.', 'halena' ),
				'std' => '',
			),

		);
		vc_add_params( "vc_empty_space", $empty_space_atts );


		/*
		Add your Visual Composer logic here.
		Lets call vc_map function to "register" our custom shortcode within Visual Composer interface.

		More info: http://kb.wpbakery.com/index.php?title=Vc_map
		*/
		// Section heading
		vc_map( array(
			'name' => esc_html__( 'Section Heading', 'halena' ),
			'base' => 'agni_section_heading',
			'icon' => 'ion-ios-compose-outline',
			'weight' => '97',
			'category' => esc_html__( 'Typography', 'halena' ),
			'description' => esc_html__( 'Various headings styles for your web page', 'halena' ),
			'params' => array(
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Choose Icon', 'halena' ),
					'param_name' => 'icon',
					'value' => '',
					'settings' => array(
						'type' => 'iconlist',
						'iconsPerPage' => 545,
					),
					'description' => wp_kses( __( '<small>Select the icon which you want <strong><a href="http://ionicons.com/">Ionicons</a>, <a href="http://fortawesome.github.io/Font-Awesome/icons/">FontAwesome</a>, <a href="http://themes-pixeden.com/font-demos/7-stroke/index.html">Pe Icon 7 Stroke</a>, <a href="http://themes-pixeden.com/font-demos/7-filled/index.html">Pe Icon 7 Filled</a> supported.</strong></small>.', 'halena' ), array( 'small' => array(), 'strong' => array(), 'a' => array( 'href' => array() ) ) ),
					'std' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Icon Size', 'halena' ),
					'param_name' => 'icon_size',
					'description' => esc_html__( 'Enter your icon size. don\'t include "px" string.' , 'halena' ),
					'dependency' => array( 'element' => 'icon', 'not_empty' => true ),
					'std' => '60'
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Icon Color', 'halena' ),
					'param_name' => 'icon_color',
					'description' => esc_html__('Choose your desired color for the icon.', 'halena' ),
					'dependency' => array( 'element' => 'icon', 'not_empty' => true ),
					'std' => '#1e1e20',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Heading Text', 'halena' ),
					'param_name' => 'heading',
					'description' => esc_html__( 'Enter your heading text or leave it empty.', 'halena' ),
					'std' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Heading Font Size', 'halena' ),
					'param_name' => 'heading_size',
					'description' => esc_html__( 'Enter your heading font size. don\'t include "px" string.' , 'halena' ),
					'dependency' => array( 'element' => 'heading', 'not_empty' => true ),
					'std' => '36'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Sub Heading Text', 'halena' ),
					'param_name' => 'sub_heading',
					'description' => esc_html__( 'Enter your sub-heading text or leave it empty.', 'halena' ),
					'std' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Sub Heading Font Size', 'halena' ),
					'param_name' => 'sub_heading_size',
					'description' => esc_html__( 'Enter your sub-heading font size. don\'t include "px" string.' , 'halena' ),
					'dependency' => array( 'element' => 'sub_heading', 'not_empty' => true ),
					'std' => '13'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Additional Text', 'halena' ),
					'param_name' => 'additional',
					'description' => esc_html__( 'Enter your additional/description text or leave it empty.', 'halena' ),
					'std' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Additional Text Font Size', 'halena' ),
					'param_name' => 'additional_size',
					'description' => esc_html__( 'Enter your additional text font size. don\'t include "px" string.' , 'halena' ),
					'dependency' => array( 'element' => 'additional', 'not_empty' => true ),
					'std' => '17'
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Divide Line', 'halena' ),
					'param_name' => 'divide_line',
					'description' => esc_html__( 'It will display fancy line above/below the headings.' , 'halena' ),
					'value' => array( esc_html__( 'Yes', 'halena' ) => 'yes' ),
					'std' => '',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Divide Line Width', 'halena' ),
					'param_name' => 'divide_line_width',
					'description' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels.', 'halena' ),
					'dependency' => array( 'element' => 'divide_line', 'value' => 'yes' ),
					'std' => '90'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Divide Line Height', 'halena' ),
					'param_name' => 'divide_line_height',
					'description' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels.', 'halena' ),
					'dependency' => array( 'element' => 'divide_line', 'value' => 'yes' ),
					'std' => '1'
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Divide Line Color', 'halena' ),
					'param_name' => 'divide_line_color',
					'description' => esc_html__('Choose your desired color for the Divide Line.', 'halena' ),
					'dependency' => array( 'element' => 'divide_line', 'value' => 'yes' ),
					'std' => '#1e1e20',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Heading Alignment', 'halena' ),
					'param_name' => 'align',
					'value' => array(
						 esc_html__( 'Left', 'halena' ) => 'left',
						 esc_html__( 'Center', 'halena') => 'center',
						 esc_html__( 'Right', 'halena' ) => 'right',
					),
					'description' => esc_html__( 'Choose your desired Heading alignment.', 'halena' ),
					'std' => 'left',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Display Order', 'halena' ),
					'param_name' => 'display_order',
					'value' => array(
						 esc_html__( 'Icon, Headings, Divide line, Addtional', 'halena' ) => 'ihda',
						 esc_html__( 'Headings, Divide line, Additional, Icon', 'halena' ) => 'hdai',
						 esc_html__( 'Additional, Headings, Divide line, Icon', 'halena' ) => 'ahdi',
						 esc_html__( 'Divide line, Headings, Additional, Icon', 'halena' ) => 'dhai',
						 esc_html__( 'Icon, Divide line, Headings, Additional', 'halena' ) => 'idha',
						 esc_html__( 'Icon, Sub Heading, Heading, Divide line, Additional', 'halena' ) => 'ishda',
						 esc_html__( 'Icon, Sub Heading, Heading, Additional, Divide line', 'halena' ) => 'ishad',
						),
					'description' => esc_html__( 'Choose your desired display order.', 'halena' ),
					'std' => 'ihda',
				),

				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Responsive Font Size', 'halena' ),
					'description' => esc_html__( 'This will reduce the heading font size in order to fit with screen.' , 'halena' ),
					'param_name' => 'responsive_font_size',
					'value' => array( esc_html__( 'Yes', 'halena' ) => 'yes' ),
					'std' => '',
				),
				$animation_atts,
				$animation_style_atts, 
				$animation_duration_atts,
				$animation_delay_atts,
				$animation_offset_atts,

				$parallax_atts,
				$parallax_start_atts,
				$parallax_end_atts,
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra class name', 'halena' ),
					'param_name' => 'class',
					'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'halena' ),
				),
			)
		) );
		
		// Blockquote
		vc_map( array(
			'name' => esc_html__( 'Blockquote', 'halena' ),
			'base' => 'agni_blockquote',
			'icon' => 'ion-ios-heart-outline',
			'weight' => '96',
			'category' => esc_html__( 'Typography', 'halena' ),
			'description' => esc_html__( 'Blockquote text for your webpage.', 'halena' ),
			'params' => array(
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Reverse Quote', 'halena' ),
					'param_name' => 'reverse',
					'description' => esc_html__( 'It will reverse your quote & text.', 'halena' ),
					'value' => array( esc_html__( 'Yes', 'halena' ) => 'yes' ),
					'std' => '',
				),
				array(
					'type' => 'textarea_html',
					'heading' => esc_html__( 'Quote Text', 'halena' ),
					'param_name' => 'content',
					'value' => '<p>I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>',
					'std' => '',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Quote Symbol', 'halena' ),
					'param_name' => 'quote',
					'description' => esc_html__( 'It will be displayed behind the quote text.', 'halena' ),
					'std' => '"',
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Quote Symbol Color', 'halena' ),
					'param_name' => 'quote_color',
					'description' => esc_html__( 'Choose your desired Quote Symbol color.', 'halena' ),
					'std' => '',
				),

				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Background Color', 'halena' ),
					'param_name' => 'background_color',
					'description' => esc_html__( 'Choose your desired Background color for quote.', 'halena' ),
					'std' => '',
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Quote Color', 'halena' ),
					'param_name' => 'color',
					'description' => esc_html__('Choose your desired color for quote.', 'halena' ),
					'std' => '',
				),
				
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra class name', 'halena' ),
					'param_name' => 'class',
					'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'halena' ),
				),
			)
		
		));
		
		// Dropcap
		vc_map( array(
			'name' => esc_html__( 'Dropcap', 'halena' ),
			'base' => 'agni_dropcap',
			'icon' => 'ion-ios-information-outline',
			'weight' => '95',
			'category' => esc_html__( 'Typography', 'halena' ),
			'description' => esc_html__( 'Dropcap Text for your webpage.', 'halena' ),
			'params' => array(
				array(
					'type' => 'textarea_html',
					'heading' => esc_html__( 'Dropcap Text', 'halena' ),
					'param_name' => 'content',
					'value' => 'I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
					'std' => '',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Dropcap Style', 'halena' ),
					'param_name' => 'dropcap_style',
					'value' => array(
						 esc_html__( 'Background', 'halena' ) => 'background',
						 esc_html__( 'Bordered', 'halena' ) => 'bordered',
						),
					'description' => esc_html__( 'Choose your desired style for the dropcap letter.', 'halena' ),
					'std' => 'background',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Dropcap Radius', 'halena' ),
					'param_name' => 'radius',
					'description' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels.', 'halena' ),
					'std' => '',
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Dropcap Background Color', 'halena' ),
					'param_name' => 'background_color',
					'description' => esc_html__('Choose your desired dropcap letter\'s background color.', 'halena' ),
					'dependency' => array( 'element' => 'dropcap_style', 'value' => 'background' ),
					'std' => '#000000',
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Dropcap Border Color', 'halena' ),
					'param_name' => 'border_color',
					'description' => esc_html__('choose your desired dropcap letter\'s border color.', 'halena' ),
					'dependency' => array( 'element' => 'dropcap_style', 'value' => 'bordered' ),
					'std' => '#000000',
				),

				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Dropcap Text Color', 'halena' ),
					'param_name' => 'color',
					'description' => esc_html__('choose your desired dropcap letter\'s color', 'halena' ),
					'std' => '',
				),
				
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra class name', 'halena' ),
					'param_name' => 'class',
					'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'halena' ),
				),
			)
		
		));
		
		// Seperator
		vc_map( array(
			'name' => esc_html__( 'separator', 'halena' ),
			'base' => 'agni_separator',
			'icon' => 'ion-ios-infinite-outline',
			'weight' => '94',
			'category' => esc_html__( 'Typography', 'halena' ),
			'description' => esc_html__( 'separator for your content', 'halena' ),
			'params' => array(
				
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Separator Choice', 'halena' ),
					'param_name' => 'choice',
					'value' => array(
						 esc_html__('Default', 'halena') => '',
						 esc_html__( 'With Text', 'halena' ) => 'text',    
						 esc_html__( 'With Icon', 'halena' ) => 'icon',    
						),
					'description' => esc_html__( 'Choose your desired separator style.', 'halena' ),
					'std' => '',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Separator Text', 'halena' ),
					'param_name' => 'text',
					'description' => esc_html__( 'Enter your text to display over the separator.', 'halena' ),
					'dependency' => array( 'element' => 'choice', 'value' => 'text' ),
					'std' => '',
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Choose Icon', 'halena' ),
					'param_name' => 'icon',
					'value' => '',
					'settings' => array(
						'type' => 'iconlist',
						'iconsPerPage' => 545,
					),
					'description' => wp_kses( __( '<small>Select the icon which you want <strong><a href="http://ionicons.com/">Ionicons</a>, <a href="http://fortawesome.github.io/Font-Awesome/icons/">FontAwesome</a>, <a href="http://themes-pixeden.com/font-demos/7-stroke/index.html">Pe Icon 7 Stroke</a>, <a href="http://themes-pixeden.com/font-demos/7-filled/index.html">Pe Icon 7 Filled</a> supported.</strong></small>.', 'halena' ), array( 'small' => array(), 'strong' => array(), 'a' => array( 'href' => array() ) ) ),
					'dependency' => array( 'element' => 'choice', 'value' => 'icon' ),
					'std' => ''
				),
				
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Separator Width', 'halena' ),
					'param_name' => 'width',
					'description' => esc_html__( 'Enter your width. You can use px, em, %, etc. or enter just number and it will use percentage', 'halena' ),
					'std' => '100'
				),
				
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Separator Style', 'halena' ),
					'param_name' => 'style',
					'value' => array(
						 esc_html__( 'Solid', 'halena') => 'solid',
						 esc_html__( 'Dashed', 'halena' ) => 'dashed', 
						 esc_html__( 'Dotted', 'halena' ) => 'dotted', 
						),
					'description' => esc_html__( 'Choose your desired separator style.', 'halena' ),
					'std' => 'solid'
				),
				
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Separator Alignment', 'halena' ),
					'param_name' => 'align',
					'value' => array(
						 esc_html__( 'Center', 'halena') => 'center',
						 esc_html__( 'Left', 'halena' ) => 'left',                      
						 esc_html__( 'Right', 'halena' ) => 'right'
						),
					'description' => esc_html__( 'Choose your desired Separator alignment.', 'halena' ),
					'std' => 'center'
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Separator Color', 'halena' ),
					'param_name' => 'color',
					'description' => esc_html__('Choose your desired Separator color.', 'halena' ),
					'std' => '',
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Separator Background Color', 'halena' ),
					'param_name' => 'background_color',
					'description' => esc_html__('Choose your desired Separator color.', 'halena' ),
					'std' => '',
				),
				
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra class name', 'halena' ),
					'param_name' => 'class',
					'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'halena' ),
				),
			)
		
		));
		
		// Call to Action
		vc_map( array(
			'name' => esc_html__( 'Call to Action', 'halena' ),
			'base' => 'agni_call_to_action',
			'icon' => 'ion-ios-bolt-outline',
			'weight' => '93',
			'category' => esc_html__( 'Content', 'halena' ),
			'description' => esc_html__( 'Simple call to action element', 'halena' ),
			'params' => array(
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Choose the style', 'halena' ),
					'param_name' => 'type',
					'value' => array(   
						 esc_html__( 'Style 1(Default)', 'halena') => '1',
						 esc_html__( 'Style 2', 'halena') => '2'
					),
					'std' => '1'
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Choose Icon', 'halena' ),
					'param_name' => 'icon',
					'value' => '',
					'settings' => array(
						'type' => 'iconlist',
						'iconsPerPage' => 545,
					),
					'description' => wp_kses( __( '<small>Select the icon which you want <strong><a href="http://ionicons.com/">Ionicons</a>, <a href="http://fortawesome.github.io/Font-Awesome/icons/">FontAwesome</a>, <a href="http://themes-pixeden.com/font-demos/7-stroke/index.html">Pe Icon 7 Stroke</a>, <a href="http://themes-pixeden.com/font-demos/7-filled/index.html">Pe Icon 7 Filled</a> supported.</strong></small>', 'halena' ), array( 'small' => array(), 'strong' => array(), 'a' => array( 'href' => array() ) ) ),
					'std' => ''
				),


				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Top Margin', 'halena' ),
					'param_name' => 'icon_margin_top',
					'description' => esc_html__( 'It will add the magin for icon. You can use px, em, %, etc. or enter just number and it will use pixels.', 'halena' ),
					'dependency' => array( 'element' => 'icon', 'not_empty' => true ),
					'std' => '',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Right Margin', 'halena' ),
					'param_name' => 'icon_margin_right',
					'dependency' => array( 'element' => 'icon', 'not_empty' => true ),
					'std' => '',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Icon Bottom Margin', 'halena' ),
					'param_name' => 'icon_margin_bottom',
					'dependency' => array( 'element' => 'icon', 'not_empty' => true ),
					'std' => '',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Title Text', 'halena' ),
					'param_name' => 'quote',
					'description' => esc_html__( 'Enter your call to action title text or leave it empty.', 'halena' ),
					'std' => '',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Title Text Font Size', 'halena' ),
					'param_name' => 'quote_size',
					'description' => esc_html__( 'Enter your call to action title/text font size. Don\'t include px string.', 'halena' ),
					'dependency' => array( 'element' => 'quote', 'not_empty' => true ),
					'std' => '36'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Additional Text', 'halena' ),
					'param_name' => 'additional_quote',
					'description' => esc_html__( 'Enter your call to action additional title text or leave it empty.', 'halena' ),
					'std' => '',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Additional Text Font Size', 'halena' ),
					'param_name' => 'additional_quote_size',
					'description' => esc_html__( 'Enter your call to action additional title/text font size. Don\'t include px string.', 'halena' ),
					'dependency' => array( 'element' => 'additional_quote', 'not_empty' => true ),
					'std' => '17'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Button Value', 'halena' ),
					'class' => 'wpb_button',
					'param_name' => 'value',
					'description' => esc_html__( 'Value for the button.', 'halena' ),
					'std' => 'Button'
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Choose Icon', 'halena' ),
					'param_name' => 'btn_icon',
					'value' => '',
					'settings' => array(
						'type' => 'iconlist',
						'iconsPerPage' => 545,
					),
					'description' => wp_kses( __( '<small>Select the icon which you want <strong><a href="http://ionicons.com/">Ionicons</a>, <a href="http://fortawesome.github.io/Font-Awesome/icons/">FontAwesome</a>, <a href="http://themes-pixeden.com/font-demos/7-stroke/index.html">Pe Icon 7 Stroke</a>, <a href="http://themes-pixeden.com/font-demos/7-filled/index.html">Pe Icon 7 Filled</a> supported.</strong></small>', 'halena' ), array( 'small' => array(), 'strong' => array(), 'a' => array( 'href' => array() ) ) ),
					'dependency' => array( 'element' => 'value', 'not_empty' => true ),
					'std' => ''
				),
				array(
					'type' => 'href',
					'heading' => esc_html__( 'Button URL', 'halena' ),
					'param_name' => 'url',
					'description' => esc_html__( 'URL for the button.', 'halena' ),
					'dependency' => array( 'element' => 'value', 'not_empty' => true ),
					'std' => '#'
				),
				
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Target', 'halena' ),
					'param_name' => 'target',
					'value' => array(   
						esc_html__( 'Same window', 'halena' ) => '_self',
						esc_html__( 'New window', 'halena' ) => '_blank'
					),
					'dependency' => array( 'element' => 'value', 'not_empty' => true ),
					'std' => '_self'
				),
				
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'button style', 'halena' ),
					'param_name' => 'style',
					'value' => array(   
						 esc_html__( 'Background(Default)', 'halena') => '',
						 esc_html__( 'Bordered', 'halena') => 'alt'
					),
					'description' => esc_html__( 'Select the button style.', 'halena' ),
					'dependency' => array( 'element' => 'value', 'not_empty' => true ),
					'std' => ''
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Radius', 'halena' ),
					'param_name' => 'radius',
					'description' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels.', 'halena' ),
					'dependency' => array( 'element' => 'value', 'not_empty' => true ),
					'std' => '50'
				),
				
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Choose button type', 'halena' ),
					'param_name' => 'choice',
					'value' => array(   
						 esc_html__( 'Default', 'halena') => 'default',
						 esc_html__( 'Primary', 'halena') => 'primary',
						 esc_html__( 'Accent', 'halena') => 'accent',
						 esc_html__( 'White', 'halena') => 'white'
					),
					'description' => esc_html__( 'Select the button type.', 'halena' ),
					'dependency' => array( 'element' => 'value', 'not_empty' => true ),
					'std' => 'default'
				),
				
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Choose the size of button', 'halena' ),
					'param_name' => 'size',
					'value' => array(   
						 esc_html__( 'Default', 'halena') => '',
						 esc_html__( 'Large', 'halena') => 'lg',
						 esc_html__( 'Small', 'halena' ) => 'sm',
						 esc_html__( 'Extra Small', 'halena' ) => 'xs',
						 esc_html__( 'Block', 'halena' ) => 'block',
					),
					'description' => esc_html__( 'Select the size of the button..', 'halena' ),
					'dependency' => array( 'element' => 'value', 'not_empty' => true ),
					'std' => ''
				),

				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Alignment', 'halena' ),
					'param_name' => 'align',
					'value' => array(
						 esc_html__( 'Left', 'halena' ) => 'left',
						 esc_html__( 'Center', 'halena') => 'center',
						 esc_html__( 'Right', 'halena' ) => 'right',
					),
					'description' => esc_html__( 'Choose your desired alignment for Call to Action.', 'halena' ),
					'std' => 'left'
				),
				
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra class name', 'halena' ),
					'param_name' => 'class',
					'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'halena' ),
				),
			)
		
		));
		
		// Icons
		vc_map( array(
			'name' => esc_html__( 'Icon', 'halena' ),
			'base' => 'agni_icon',
			'icon' => 'ion-ios-star-outline',
			'weight' => '92',
			'category' => esc_html__( 'Content', 'halena' ),
			'description' => esc_html__( 'Icon( Ionicons, Fontawesome )', 'halena' ),
			'params' => array(
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Icon Type', 'halena' ),
					'param_name' => 'icon_type',
					'value' => array(
						 esc_html__( 'Icon Fonts', 'halena' ) => 'icon',
						 esc_html__( 'Svg Icons', 'halena' ) => 'svg',
						),
					'description' => esc_html__( 'Choose your desired icon type.', 'halena' ),
					'std' => 'icon',
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Choose Icon', 'halena' ),
					'param_name' => 'icon',
					'value' => '',
					'settings' => array(
						'emptyIcon' => false,
						'type' => 'iconlist',
						'iconsPerPage' => 545,
					),
					'description' => wp_kses( __( '<small>Select the icon which you want <strong><a href="http://ionicons.com/">Ionicons</a>, <a href="http://fortawesome.github.io/Font-Awesome/icons/">FontAwesome</a>, <a href="http://themes-pixeden.com/font-demos/7-stroke/index.html">Pe Icon 7 Stroke</a>, <a href="http://themes-pixeden.com/font-demos/7-filled/index.html">Pe Icon 7 Filled</a> supported.</strong></small>', 'halena' ), array( 'small' => array(), 'strong' => array(), 'a' => array( 'href' => array() ) ) ),
					'dependency' => array( 'element' => 'icon_type', 'value' => 'icon' ),
					'std' => 'pe-7s-diamond'
				),

				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'SVG Icon Type', 'halena' ),
					'param_name' => 'svg_icon_type',
					'value' => array(
						 esc_html__( 'Choose from list', 'halena' ) => 'svg_list',
						 esc_html__( 'Upload SVG', 'halena' ) => 'svg_upload',
						),
					'description' => esc_html__( 'Choose your desired icon type.', 'halena' ),
					'dependency' => array( 'element' => 'icon_type', 'value' => 'svg' ),
					'std' => 'svg_list',
				),

				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Choose Icon', 'halena' ),
					'param_name' => 'svg_icon',
					'value' => '',
					'settings' => array(
						'emptyIcon' => false,
						'type' => 'svgiconlist',
						'iconsPerPage' => 360,
					),
					'description' => wp_kses( __( '<small>Select the icon which you want <strong><a href="http://ionicons.com/">Ionicons</a>, <a href="http://fortawesome.github.io/Font-Awesome/icons/">FontAwesome</a>, <a href="http://themes-pixeden.com/font-demos/7-stroke/index.html">Pe Icon 7 Stroke</a>, <a href="http://themes-pixeden.com/font-demos/7-filled/index.html">Pe Icon 7 Filled</a> supported.</strong></small>', 'halena' ), array( 'small' => array(), 'strong' => array(), 'a' => array( 'href' => array() ) ) ),
					'dependency' => array( 'element' => 'svg_icon_type', 'value' => 'svg_list' ),
					'std' => 'icon-ecommerce-diamond'
				),
				array(
					'type' => 'attach_image',
					'heading' => esc_html__( 'Choose SVG', 'halena' ),
					'param_name' => 'svg_icon_upload',
					'description' => esc_html__( 'Select svg file from media library.', 'halena' ),
					'dependency' => array( 'element' => 'svg_icon_type', 'value' => 'svg_upload' ),
					'std' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Icon Size', 'halena' ),
					'param_name' => 'size',
					'description' => esc_html__( 'Enter your icon size. You can use px, em, %, etc. or enter just number and it will use pixels.', 'halena' ),
					'std' => '32',
				),
				array(
					'type' => 'href',
					'heading' => esc_html__( 'Icon URL', 'halena' ),
					'param_name' => 'url',
					'description' => esc_html__( 'Enter your URL/Link for the icon or leave it empty.', 'halena' ),
					'std' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Icon Style', 'halena' ),
					'param_name' => 'icon_style',
					'value' => array(
						 esc_html__( 'Default', 'halena' ) => '',
						 esc_html__( 'Background', 'halena' ) => 'background',
						 esc_html__( 'Bordered', 'halena' ) => 'border',
						),
					'description' => esc_html__( 'Choose your desired icon style.', 'halena' ),
					'std' => '',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Width', 'halena' ),
					'param_name' => 'width',
					'description' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels.', 'halena' ),
					'dependency' => array( 'element' => 'icon_style', 'value' => array( 'border', 'background' ) ),
					'std' => '72',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Height', 'halena' ),
					'param_name' => 'height',
					'description' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels.', 'halena' ),
					'dependency' => array( 'element' => 'icon_style', 'value' => array( 'border', 'background' ) ),
					'std' => '72',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Radius', 'halena' ),
					'param_name' => 'radius',
					'description' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels.', 'halena' ),
					'dependency' => array( 'element' => 'icon_style', 'value' => array( 'border', 'background' ) ),
					'std' => '50%',
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Background Color', 'halena' ),
					'param_name' => 'background_color',
					'description' => esc_html__('Choose your desired icon background color.', 'halena' ),
					'dependency' => array( 'element' => 'icon_style', 'value' => 'background' ),
					'std' => '#f0f1f2',
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Border Color', 'halena' ),
					'param_name' => 'border_color',
					'description' => esc_html__('Choose your desired icon border color.', 'halena' ),
					'dependency' => array( 'element' => 'icon_style', 'value' => 'border' ),
					'std' => '#000000',
				),

				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Icon Color', 'halena' ),
					'param_name' => 'color',
					'description' => esc_html__('Choose your desired icon color.', 'halena' ),
					'std' => '#000000',
				),
				
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Icon Style on Hover', 'halena' ),
					'param_name' => 'hover_icon_style',
					'value' => array(
						 esc_html__( 'Default', 'halena' ) => '',
						 esc_html__( 'Background', 'halena' ) => 'background',
						 esc_html__( 'Bordered', 'halena' ) => 'border',
						),
					'description' => esc_html__( 'Choose your desired icon style when the icon hovered.', 'halena' ),
					'dependency' => array( 'element' => 'icon_style', 'value' => array( 'border', 'background' ) ),
					'std' => '',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Radius on hover', 'halena' ),
					'param_name' => 'hover_radius',
					'description' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels.', 'halena' ),
					'dependency' => array( 'element' => 'hover_icon_style', 'value' => array( 'border', 'background' ) ),
					'std' => '50%',
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Background Color on hover', 'halena' ),
					'param_name' => 'hover_background_color',
					'description' => esc_html__('Choose your desired icon background color when the icon hovered.', 'halena' ),
					'dependency' => array( 'element' => 'hover_icon_style', 'value' => 'background' ),
					'std' => '#1e1e20',
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Border Color on hover', 'halena' ),
					'param_name' => 'hover_border_color',
					'description' => esc_html__('Choose your desired icon border color when the icon hovered.', 'halena' ),
					'dependency' => array( 'element' => 'hover_icon_style', 'value' => 'border' ),
					'std' => '#000000',
				),

				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Icon Color on hover', 'halena' ),
					'param_name' => 'hover_color',
					'description' => esc_html__('Choose your desired icon color when the icon hovered.', 'halena' ),
					'std' => '#000000',
				),

				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Inline Icon', 'halena' ),
					'param_name' => 'inline',
					'description' => esc_html__( 'It will bring the buttons to the same line.', 'halena' ),
					'value' => array( esc_html__( 'Yes', 'halena' ) => 'yes' ),
					'std' => 'yes'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Padding(Gap)', 'halena' ),
					'param_name' => 'icon_padding',
					'description' => esc_html__( 'Common padding for all side. You can use simple Padding CSS here. for ex. "10px" or "5px 10px" or enter just number and it will use pixels.', 'halena' ),
					'std' => ''
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra class name', 'halena' ),
					'param_name' => 'class',
					'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'halena' ),
				),
			)
		
		));
		
		// Service Box
		vc_map( array(
			'name' => esc_html__( 'Service Box', 'halena' ),
			'base' => 'agni_service',
			'icon' => 'ion-ios-wineglass-outline',
			'weight' => '91',
			'category' => esc_html__( 'Content', 'halena' ),
			'description' => esc_html__( 'various Service boxes', 'halena' ),
			'params' => array(
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Service Choice', 'halena' ),
					'param_name' => 'choice',
					'value' => array(
						 esc_html__( 'Style 1(Default)', 'halena' ) => '1',
						 esc_html__( 'Style 2', 'halena' ) => '2',
						 esc_html__( 'Style 3', 'halena' ) => '3',
						),
					'description' => esc_html__( 'Choose your desired service box style.', 'halena' ),
					'std' => '1'
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Background Choice', 'halena' ),
					'param_name' => 'bg_choice',
					'weight' => '1',
					'value' => array(
						esc_html__( 'None', 'halena' ) => '',
						esc_html__( 'Background Color', 'halena' ) => '1',
						esc_html__( 'Background Image', 'halena' ) => '2',
						esc_html__( 'Border Color', 'halena' ) => '3',
					),
					'description' => esc_html__( 'Choose your desired background option service box.', 'halena' ),
					'std' => '',
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Background Color', 'halena' ),
					'param_name' => 'bg_color',
					'description' => esc_html__( 'Choose your desired background color for this service box.', 'halena' ),
					'dependency' => array( 'element' => 'bg_choice', 'value' => '1' ),
					'std' => '',
				),
				array(
					'type' => 'attach_image',
					'heading' => esc_html__( 'Background Image', 'halena' ),
					'param_name' => 'bg_image',
					'description' => esc_html__( 'Choose your desired background image for this service box', 'halena' ),
					'dependency' => array( 'element' => 'bg_choice', 'value' => '2' ),
					'std' => '',
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Border Color', 'halena' ),
					'param_name' => 'bg_border_color',
					'description' => esc_html__( 'Choose your desired border color for this service box.', 'halena' ),
					'dependency' => array( 'element' => 'bg_choice', 'value' => '3' ),
					'std' => '',
				),
				
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Choose Icon/Text', 'halena' ),
					'param_name' => 'text_i_icon',
					'description' => esc_html__( 'It will let you to use icon/text as per your wish.', 'halena' ),
					'value' => array(
						 esc_html__( 'Icon', 'halena' ) => '1',
						 esc_html__( 'Text', 'halena' ) => '2',
					),
					'std' => '1'
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Icon Type', 'halena' ),
					'param_name' => 'icon_type',
					'value' => array(
						 esc_html__( 'Icon Fonts', 'halena' ) => 'icon',
						 esc_html__( 'Svg Icons', 'halena' ) => 'svg',
						),
					'description' => esc_html__( 'Choose your desired icon type.', 'halena' ),
					'dependency' => array( 'element' => 'text_i_icon', 'value' => '1' ),
					'std' => 'icon',
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Choose Icon', 'halena' ),
					'param_name' => 'icon',
					'value' => '',
					'settings' => array(
						'emptyIcon' => false,
						'type' => 'iconlist',
						'iconsPerPage' => 545,
					),
					'description' => wp_kses( __( '<small>Select the icon which you want <strong><a href="http://ionicons.com/">Ionicons</a>, <a href="http://fortawesome.github.io/Font-Awesome/icons/">FontAwesome</a>, <a href="http://themes-pixeden.com/font-demos/7-stroke/index.html">Pe Icon 7 Stroke</a>, <a href="http://themes-pixeden.com/font-demos/7-filled/index.html">Pe Icon 7 Filled</a> supported.</strong></small>', 'halena' ), array( 'small' => array(), 'strong' => array(), 'a' => array( 'href' => array() ) ) ),
					'dependency' => array( 'element' => 'icon_type', 'value' => 'icon' ),
					'std' => 'pe-7s-diamond'
				),

				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'SVG Icon Type', 'halena' ),
					'param_name' => 'svg_icon_type',
					'value' => array(
						 esc_html__( 'Choose from list', 'halena' ) => 'svg_list',
						 esc_html__( 'Choose SVG', 'halena' ) => 'svg_upload',
						),
					'description' => esc_html__( 'Choose your desired icon type.', 'halena' ),
					'dependency' => array( 'element' => 'icon_type', 'value' => 'svg' ),
					'std' => 'svg_list',
				),

				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Choose Icon', 'halena' ),
					'param_name' => 'svg_icon',
					'value' => '',
					'settings' => array(
						'emptyIcon' => false,
						'type' => 'svgiconlist',
						'iconsPerPage' => 360,
					),
					'description' => wp_kses( __( '<small>Select the icon which you want <strong><a href="http://ionicons.com/">Ionicons</a>, <a href="http://fortawesome.github.io/Font-Awesome/icons/">FontAwesome</a>, <a href="http://themes-pixeden.com/font-demos/7-stroke/index.html">Pe Icon 7 Stroke</a>, <a href="http://themes-pixeden.com/font-demos/7-filled/index.html">Pe Icon 7 Filled</a> supported.</strong></small>', 'halena' ), array( 'small' => array(), 'strong' => array(), 'a' => array( 'href' => array() ) ) ),
					'dependency' => array( 'element' => 'svg_icon_type', 'value' => 'svg_list' ),
					'std' => 'icon-ecommerce-diamond'
				),
				array(
					'type' => 'attach_image',
					'heading' => esc_html__( 'Choose SVG', 'halena' ),
					'param_name' => 'svg_icon_upload',
					'description' => esc_html__( 'Select svg file from media library.', 'halena' ),
					'dependency' => array( 'element' => 'svg_icon_type', 'value' => 'svg_upload' ),
					'std' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Icon Size', 'halena' ),
					'param_name' => 'size',
					'description' => esc_html__( 'Enter your icon size. You can use px, em, %, etc. or enter just number and it will use pixels.', 'halena' ),
					'dependency' => array( 'element' => 'text_i_icon', 'value' => '1' ),
					'std' => '',
				),
				array(
					'type' => 'href',
					'heading' => esc_html__( 'Icon URL', 'halena' ),
					'param_name' => 'url',
					'description' => esc_html__( 'Enter your URL/Link for the icon or leave it empty.', 'halena' ),
					'dependency' => array( 'element' => 'text_i_icon', 'value' => '1' ),
					'std' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Icon Style', 'halena' ),
					'param_name' => 'icon_style',
					'value' => array(
						 esc_html__( 'Default', 'halena' ) => '',
						 esc_html__( 'Background', 'halena' ) => 'background',
						 esc_html__( 'Bordered', 'halena' ) => 'border',
						),
					'description' => esc_html__( 'Choose your desired icon style.', 'halena' ),
					'dependency' => array( 'element' => 'text_i_icon', 'value' => '1' ),
					'std' => '',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Width', 'halena' ),
					'param_name' => 'width',
					'description' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels.', 'halena' ),
					'dependency' => array( 'element' => 'icon_style', 'value' => array( 'border', 'background' ) ),
					'std' => '',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Height', 'halena' ),
					'param_name' => 'height',
					'description' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels.', 'halena' ),
					'dependency' => array( 'element' => 'icon_style', 'value' => array( 'border', 'background' ) ),
					'std' => '',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Radius', 'halena' ),
					'param_name' => 'radius',
					'description' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels.', 'halena' ),
					'dependency' => array( 'element' => 'icon_style', 'value' => array( 'border', 'background' ) ),
					'std' => '50%',
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Background Color', 'halena' ),
					'param_name' => 'background_color',
					'description' => esc_html__('Choose your desired icon background color.', 'halena' ),
					'dependency' => array( 'element' => 'icon_style', 'value' => 'background' ),
					'std' => '#f0f1f2',
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Border Color', 'halena' ),
					'param_name' => 'border_color',
					'description' => esc_html__('Choose your desired icon border color.', 'halena' ),
					'dependency' => array( 'element' => 'icon_style', 'value' => 'border' ),
					'std' => '#000000',
				),

				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Icon Color', 'halena' ),
					'param_name' => 'color',
					'description' => esc_html__('Choose your desired icon color.', 'halena' ),
					'dependency' => array( 'element' => 'text_i_icon', 'value' => '1' ),
					'std' => '#000000',
				),
				
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Icon Style on Hover', 'halena' ),
					'param_name' => 'hover_icon_style',
					'value' => array(
						 esc_html__( 'Default', 'halena' ) => '',
						 esc_html__( 'Background', 'halena' ) => 'background',
						 esc_html__( 'Bordered', 'halena' ) => 'border',
						),
					'description' => esc_html__( 'Choose your desired icon style when the icon hovered.', 'halena' ),
					'dependency' => array( 'element' => 'icon_style', 'value' => array( 'border', 'background' ) ),
					'std' => '',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Radius on hover', 'halena' ),
					'param_name' => 'hover_radius',
					'description' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels.', 'halena' ),
					'dependency' => array( 'element' => 'hover_icon_style', 'value' => array( 'border', 'background' ) ),
					'std' => '50%',
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Background Color on hover', 'halena' ),
					'param_name' => 'hover_background_color',
					'description' => esc_html__('Choose your desired icon background color when the icon hovered.', 'halena' ),
					'dependency' => array( 'element' => 'hover_icon_style', 'value' => 'background' ),
					'std' => '#1e1e20',
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Border Color on hover', 'halena' ),
					'param_name' => 'hover_border_color',
					'description' => esc_html__('Choose your desired icon border color when the icon hovered.', 'halena' ),
					'dependency' => array( 'element' => 'hover_icon_style', 'value' => 'border' ),
					'std' => '#000000',
				),

				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Icon Color on hover', 'halena' ),
					'param_name' => 'hover_color',
					'description' => esc_html__('Choose your desired icon color when the icon hovered.', 'halena' ),
					'dependency' => array( 'element' => 'text_i_icon', 'value' => '1' ),
					'std' => '#000000',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Service Text', 'halena' ),
					'param_name' => 'text',
					'description' => esc_html__( 'Enter your letter/number. Please do not use more the two letter, it may break the layout. ', 'halena' ),
					'dependency' => array( 'element' => 'text_i_icon', 'value' => '2' ),
					'std' => '01'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Service Text Size', 'halena' ),
					'param_name' => 'text_size',
					'description' => esc_html__( 'Enter your text/number font size. Don\'t include px string.', 'halena' ),
					'dependency' => array( 'element' => 'text', 'not_empty' => true ),
					'std' => '45'
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Service Text Color', 'halena' ),
					'param_name' => 'text_color',
					'description' => esc_html__( 'Choose your desired color for this text.', 'halena' ),
					'dependency' => array( 'element' => 'text', 'not_empty' => true ),
					'std' => '',
				),                  
				
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Service Heading', 'halena' ),
					'param_name' => 'title',
					'description' => esc_html__( 'Enter your service title/text', 'halena' ),
					'std' => 'Lorem ipsum'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Service Heading Font Size', 'halena' ),
					'param_name' => 'title_size',
					'description' => esc_html__( 'Enter your service title/text font size. Don\'t include px string.', 'halena' ),
					'dependency' => array( 'element' => 'title', 'not_empty' => true ),
					'std' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Service Heading Color', 'halena' ),
					'param_name' => 'title_color',
					'description' => esc_html__('Choose your desired color for heading', 'halena' ),
					'dependency' => array( 'element' => 'title', 'not_empty' => true ),
					'std' => '',
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Divide Line', 'halena' ),
					'param_name' => 'divide_line',
					'description' => esc_html__( 'Check this, if you want to show the divide line.', 'halena' ),
					'value' => array( esc_html__( 'Yes', 'halena' ) => '1' ),
					'std' => '1'
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Divide Line Color', 'halena' ),
					'param_name' => 'divide_line_color',
					'description' => esc_html__('Choose your desired color for divideline', 'halena' ),
					'dependency' => array( 'element' => 'divide_line', 'value' => '1' ),
					'std' => '',
				),
				
				array(
					'type' => 'textarea_html',
					'heading' => esc_html__( 'Service Description', 'halena' ),
					'param_name' => 'content',
					'std' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Service Description Color', 'halena' ),
					'param_name' => 'description_color',
					'description' => esc_html__('Choose your desired color for description', 'halena' ),
					'dependency' => array( 'element' => 'content', 'not_empty' => true ),
					'std' => '',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Button Value', 'halena' ),
					'param_name' => 'btn_value',
					'description' => esc_html__( 'Enter your call to action button value.', 'halena' ),
					'std' => ''
				),
				array(
					'type' => 'href',
					'heading' => esc_html__( 'Button URL', 'halena' ),
					'param_name' => 'btn_url',
					'description' => esc_html__( 'Enter the URL for the button.', 'halena' ),
					'dependency' => array( 'element' => 'btn_value', 'not_empty' => true ),
					'std' => '#'
				),
				
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Button style', 'halena' ),
					'param_name' => 'btn_style',
					'value' => array(   
						 esc_html__( 'Background', 'halena') => '',
						 esc_html__( 'Bordered', 'halena') => 'alt'
					),
					'description' => esc_html__( 'Choose your desired button style.', 'halena' ),
					'dependency' => array( 'element' => 'btn_value', 'not_empty' => true ),
					'std' => '',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Button Radius', 'halena' ),
					'param_name' => 'btn_radius',
					'description' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels.', 'halena' ),
					'dependency' => array( 'element' => 'btn_value', 'not_empty' => true ),
					'std' => '',
				),
				
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Button Type', 'halena' ),
					'param_name' => 'btn_choice',
					'value' => array(   
						 esc_html__( 'Default', 'halena') => 'default',
						 esc_html__( 'Primary', 'halena') => 'primary',
						 esc_html__( 'Accent', 'halena') => 'accent',
						 esc_html__( 'White', 'halena') => 'white'
					),
					'description' => esc_html__( 'Choose your desired button type.', 'halena' ),
					'dependency' => array( 'element' => 'btn_value', 'not_empty' => true ),
					'std' => 'default'
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Alignment', 'halena' ),
					'param_name' => 'align',
					'value' => array(
						 esc_html__( 'Left', 'halena' ) => 'left',
						 esc_html__( 'Center', 'halena') => 'center',
						 esc_html__( 'Right', 'halena' ) => 'right',
					),
					'description' => esc_html__( 'Choose your desired service box alignment.', 'halena' ),
					'dependency' => array( 'element' => 'choice', 'value' => array('1', '3') ),
					'std' => 'left'
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Alignment', 'halena' ),
					'param_name' => 'service_2_align',
					'value' => array(
						 esc_html__( 'Left', 'halena' ) => 'left',                      
						 esc_html__( 'Right', 'halena' ) => 'right'
						),
					'description' => esc_html__( 'Choose your desired service box alignment.', 'halena' ),
					'dependency' => array( 'element' => 'choice', 'value' => array('2') ),
					'std' => 'left'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Padding(Gap)', 'halena' ),
					'param_name' => 'service_padding',
					'description' => esc_html__( 'Common padding for all side. You can use simple Padding CSS here. for ex. "12% 24%" or "80px". or enter just number and it will use pixels.', 'halena' ),
					'std' => ''
				),
				
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra class name', 'halena' ),
					'param_name' => 'class',
					'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'halena' ),
				),

				$animation_atts,
				$animation_style_atts, 
				$animation_duration_atts,
				$animation_delay_atts,
				$animation_offset_atts,

			)
		
		));
		
		// Pricing Table
		vc_map( array(
			'name' => esc_html__( 'Pricing Table', 'halena' ),
			'base' => 'agni_pricingtable',
			'icon' => 'ion-ios-pricetags-outline',
			'weight' => '88',
			'category' => esc_html__( 'Content', 'halena' ),
			'description' => esc_html__( 'Pricing column for many purpose', 'halena' ),
			'params' => array(
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Pricing Table Style', 'halena' ),
					'param_name' => 'pricing_style',
					'value' => array(
						 esc_html__( 'Style 1', 'halena' ) => '1',
						 esc_html__( 'Style 2', 'halena' ) => '2', 
						 esc_html__( 'Style 3', 'halena' ) => '3', 
						),
					'description' => esc_html__( 'Select the style to display the featured pricing table.', 'halena' ),
					'std' => '1'
				),

				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Pricing Cost Details BG Color', 'halena' ),
					'param_name' => 'pricing_bg_color',
					'description' => esc_html__( 'select the background color for this pricing table cost details', 'halena' ),
					'std' => ''
				),  
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Heading of the table', 'halena' ),
					'param_name' => 'heading',
					'description' => esc_html__( 'title or heading of the pricing table.', 'halena' ),
					'std' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Heading Color', 'halena' ),
					'param_name' => 'pricing_heading_color',
					'description' => esc_html__( 'select the background color for this pricing table', 'halena' ),
					'dependency' => array( 'element' => 'heading', 'not_empty' => true ),
					'std' => ''
				),  
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Price', 'halena' ),
					'param_name' => 'price',
					'description' => esc_html__( 'Price or charge for the subscribers. for.eg $99', 'halena' ),
					'std' => '',
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Price Color', 'halena' ),
					'param_name' => 'price_color',
					'description' => esc_html__('choose your desired price color.', 'halena' ),
					'dependency' => array( 'element' => 'price', 'not_empty' => true ),
					'std' => '',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Interval', 'halena' ),
					'param_name' => 'interval',
					'description' => esc_html__( 'title or heading of the pricing table. for.eg mo.', 'halena' ),
					'std' => '',
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Interval Color', 'halena' ),
					'param_name' => 'pricing_interval_color',
					'description' => esc_html__('choose your desired price interval color.', 'halena' ),
					'dependency' => array( 'element' => 'interval', 'not_empty' => true ),
					'std' => '',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Button Value', 'halena' ),
					'param_name' => 'value',
					'description' => esc_html__( 'value of the pricing button. for.eg Sign Up', 'halena' ),
					'std' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Button Link', 'halena' ),
					'param_name' => 'url',
					'description' => esc_html__( 'link of the pricing button.', 'halena' ),
					'dependency' => array( 'element' => 'value', 'not_empty' => true ),
					'std' => '#'
				),

				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Button Target', 'halena' ),
					'param_name' => 'target',
					'value' => array(   
						esc_html__( 'Same window', 'halena' ) => '_self',
						esc_html__( 'New window', 'halena' ) => '_blank'
					),
					'dependency' => array( 'element' => 'value', 'not_empty' => true ),
					'std' => '_self'
				),
				
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'button Style', 'halena' ),
					'param_name' => 'style',
					'value' => array(   
						 esc_html__( 'Background', 'halena') => '',
						 esc_html__( 'Bordered', 'halena') => 'alt'
					),
					'description' => esc_html__( 'Select the button style.', 'halena' ),
					'dependency' => array( 'element' => 'value', 'not_empty' => true ),
					'std' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Button Radius', 'halena' ),
					'param_name' => 'radius',
					'description' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels.', 'halena' ),
					'dependency' => array( 'element' => 'value', 'not_empty' => true ),
					'std' => '50px'
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Button Type', 'halena' ),
					'param_name' => 'choice',
					'value' => array(   
						 esc_html__( 'Default', 'halena') => 'default',
						 esc_html__( 'Primary', 'halena') => 'primary',
						 esc_html__( 'Accent', 'halena') => 'accent',
						 esc_html__( 'White', 'halena') => 'white'
					),
					'description' => esc_html__( 'Select the button type.', 'halena' ),
					'dependency' => array( 'element' => 'value', 'not_empty' => true ),
					'std' => 'accent'
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Choose the size of button', 'halena' ),
					'param_name' => 'size',
					'value' => array(   
						 esc_html__( 'Default', 'halena') => '',
						 esc_html__( 'Large', 'halena') => 'lg',
						 esc_html__( 'Small', 'halena' ) => 'sm',
						 esc_html__( 'Extra Small', 'halena' ) => 'xs',
						 esc_html__( 'Block', 'halena' ) => 'block',
					),
					'description' => esc_html__( 'Select the size of the button.', 'halena' ),
					'dependency' => array( 'element' => 'value', 'not_empty' => true ),
					'std' => 'sm'
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Button Position', 'halena' ),
					'param_name' => 'position',
					'value' => array(   
						 esc_html__( 'Default', 'halena') => '',
						 esc_html__( 'Absolute Middle', 'halena') => 'absolute-middle',
						 esc_html__( 'Absolute Bottom', 'halena' ) => 'absolute-bottom',
					),
					'description' => esc_html__( 'Select the position of the button. It will be applicable only for style 1', 'halena' ),
					'dependency' => array( 'element' => 'value', 'not_empty' => true ),
					'std' => ''
				),
				
				array(
					'type' => 'textarea_html',
					'heading' => esc_html__( 'Service description', 'halena' ),
					'param_name' => 'content',
					'value' => '<br><li>Content</li><li>Content</li><li>Content</li><li>Content</li></br>',
				),
				
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra class name', 'halena' ),
					'param_name' => 'class',
					'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'halena' ),
				),
			)
		
		));
		vc_add_params( "agni_pricingtable", $elements_bg_atts );
		vc_add_params( "agni_pricingtable", $row_space_atts );
		
		// Milestone
		vc_map( array(
			'name' => esc_html__( 'Milestone', 'halena' ),
			'base' => 'agni_milestone',
			'icon' => 'ion-ios-paw-outline',
			'weight' => '87',
			'category' => esc_html__( 'Content', 'halena' ),
			'description' => esc_html__( 'Milestone content', 'halena' ),
			'params' => array(
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Milestone Style', 'halena' ),
					'param_name' => 'style',
					'value' => array(
						 esc_html__( 'Style 1(Default)', 'halena' ) => '1',
						 esc_html__( 'Style 2', 'halena' ) => '2', 
						),
					'std' => '1'
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Choose Icon', 'halena' ),
					'param_name' => 'icon',
					'value' => '',
					'settings' => array(
						'type' => 'iconlist',
						'iconsPerPage' => 545,
					),
					'description' => wp_kses( __( '<small>Select the icon which you want <strong><a href="http://ionicons.com/">Ionicons</a>, <a href="http://fortawesome.github.io/Font-Awesome/icons/">FontAwesome</a>, <a href="http://themes-pixeden.com/font-demos/7-stroke/index.html">Pe Icon 7 Stroke</a>, <a href="http://themes-pixeden.com/font-demos/7-filled/index.html">Pe Icon 7 Filled</a> supported.</strong></small>', 'halena' ), array( 'small' => array(), 'strong' => array(), 'a' => array( 'href' => array() ) ) ),
					'std' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Icon Size', 'halena' ),
					'param_name' => 'icon_size',
					'description' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels.', 'halena' ),
					'dependency' => array( 'element' => 'icon', 'not_empty' => true ),
					'std' => '30'
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Icon Color', 'halena' ),
					'param_name' => 'icon_color',
					'description' => esc_html__( 'Choose your desired color for icon.', 'halena' ),
					'dependency' => array( 'element' => 'icon', 'not_empty' => true ),
				),  
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Number count', 'halena' ),
					'param_name' => 'mile',
					'description' => esc_html__( 'Number count for the milestone..  for.eg <strong>99</strong>', 'halena' )
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Number count Font Choice', 'halena' ),
					'param_name' => 'mile_font_choice',
					'value' => array(
						 esc_html__( 'Primary Font(Default)', 'halena' ) => '',
						 esc_html__( 'Default Font', 'halena' ) => 'default-typo', 
						 esc_html__( 'Special Font', 'halena' ) => 'special-typo', 
						),
					'std' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Number count Font Size', 'halena' ),
					'param_name' => 'mile_font_size',
					'description' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels.', 'halena' ),
					'std' => '60'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Mile text', 'halena' ),
					'param_name' => 'title',
					'description' => esc_html__( 'Number count for the milestone.. for.eg <strong>coffee cups</strong>', 'halena' )
				),
				
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Dark Mode', 'halena' ),
					'param_name' => 'dark_mode',
					'description' => esc_html__( 'This option makes your content white.. it may helpful for dark backgrounds', 'halena' ),
					'value' => array( esc_html__( 'Yes', 'halena' ) => 'has-dark-mode' )
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Alignment', 'halena' ),
					'param_name' => 'align',
					'value' => array(
						 esc_html__( 'Center', 'halena' ) => 'center',
						 esc_html__( 'Left', 'halena' ) => 'left',                      
						 esc_html__( 'Right', 'halena' ) => 'right'
						),
					'std' => 'center'
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Count Animation', 'halena' ),
					'param_name' => 'count',
					'description' => esc_html__( 'if you want the count animation enable it.', 'halena' ),
					'value' => array( esc_html__( 'Yes', 'halena' ) => '1' ),
					'std' => '1'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Animation Offset', 'halena' ),
					'param_name' => 'animation_offset',
					'description' => esc_html__( 'You can use "simply number" or "%" to denote the offset. for ex. 90%. It will trigger the counter only when the element reach 90% from the top.', 'halena' ),
					'dependency' => array( 'element' => 'count', 'value' => '1' ),
					'std' => '90%'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Number Seperator', 'halena' ),
					'param_name' => 'mile_separator',
					'description' => esc_html__( 'You can use any letter, number or special characters. just keep empty for no seperator.', 'halena' ),
					'dependency' => array( 'element' => 'count', 'value' => '1' ),
					'std' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Number prefix', 'halena' ),
					'param_name' => 'mile_prefix',
					'description' => esc_html__( 'You can use any letter, number or special characters. just keep empty for no prefix.', 'halena' ),
					'dependency' => array( 'element' => 'count', 'value' => '1' ),
					'std' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Number suffix', 'halena' ),
					'param_name' => 'mile_suffix',
					'description' => esc_html__( 'You can use any letter, number or special characters. just keep empty for no suffix.', 'halena' ),
					'dependency' => array( 'element' => 'count', 'value' => '1' ),
					'std' => ''
				),
				
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra class name', 'halena' ),
					'param_name' => 'class',
					'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'halena' ),
				),
			)
		
		));
		
		// Progress Bar
		vc_map( array(
			'name' => esc_html__( 'Progress Bar', 'halena' ),
			'base' => 'agni_progressbar',
			'icon' => 'ion-ios-settings',
			'weight' => '86',
			'category' => esc_html__( 'Graphic', 'halena' ),
			'description' => esc_html__( 'Progress bar for your site!!..', 'halena' ),
			'params' => array(
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Progress bar Style', 'halena' ),
					'param_name' => 'style',
					'value' => array(
						 esc_html__( 'Style 1(Default)', 'halena' ) => '1',
						 esc_html__( 'Style 2', 'halena' ) => '2', 
						),
					'std' => '1'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Percentage', 'halena' ),
					'param_name' => 'percentage',
					'description' => esc_html__( 'Progress bar completion percentage for eg. 80', 'halena' ),
					'std' => '80'
				),              
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Title', 'halena' ),
					'param_name' => 'title',
					'description' => esc_html__( 'Progress bar title', 'halena' ),
					'std' => 'Progress bar'
				),  
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Track Color', 'halena' ),
					'param_name' => 'track_color',
					'description' => esc_html__( 'select the progress bar color', 'halena' ),
					'std' => ''
				),  
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Bar Color', 'halena' ),
					'param_name' => 'bar_color',
					'description' => esc_html__( 'select the progress bar color', 'halena' ),
					'std' => ''
				),  
				
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Animation Offset', 'halena' ),
					'param_name' => 'animation_offset',
					'description' => esc_html__( 'You can use "simply number" or "%" to denote the offset. for ex. 90%. It will trigger the progressbar only when the element reach 90% from the top.', 'halena' ),
					'group' => esc_html__( 'Animation Settings', 'halena' ),
					'std' => '90%'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra class name', 'halena' ),
					'param_name' => 'class',
					'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'halena' ),
				),
			)
		
		));

		// Circle Bar
		vc_map( array(
			'name' => esc_html__( 'Circle Bar', 'halena' ),
			'base' => 'agni_circlebar',
			'icon' => 'ion-ios-pie-outline',
			'weight' => '85',
			'category' => esc_html__( 'Graphic', 'halena' ),
			'description' => esc_html__( 'Circle bar for your site!!..', 'halena' ),
			'params' => array(
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Circle bar Style', 'halena' ),
					'param_name' => 'style',
					'value' => array(
						 esc_html__( 'Style 1(Default)', 'halena' ) => '1',
						 esc_html__( 'Style 2', 'halena' ) => '2', 
						),
					'description' => esc_html__( 'choose Style 2 to show icon instead of percentage', 'halena' ),
					'std' => '1'
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Choose Icon', 'halena' ),
					'param_name' => 'icon',
					'value' => '',
					'settings' => array(
						'type' => 'iconlist',
						'iconsPerPage' => 545,
					),
					'description' => wp_kses( __( '<small>Select the icon which you want <strong><a href="http://ionicons.com/">Ionicons</a>, <a href="http://fortawesome.github.io/Font-Awesome/icons/">FontAwesome</a>, <a href="http://themes-pixeden.com/font-demos/7-stroke/index.html">Pe Icon 7 Stroke</a>, <a href="http://themes-pixeden.com/font-demos/7-filled/index.html">Pe Icon 7 Filled</a> supported.</strong></small>', 'halena' ), array( 'small' => array(), 'strong' => array(), 'a' => array( 'href' => array() ) ) ),
					'dependency' => array( 'element' => 'style', 'value' => '2' ),
					'std' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Percentage to Fill', 'halena' ),
					'param_name' => 'percentage',
					'description' => esc_html__( 'Circle bar completion percentage', 'halena' ),
					'std' => '75'
				),
								
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Size', 'halena' ),
					'param_name' => 'size',
					'description' => esc_html__( 'size of circle bar..  for.eg 160', 'halena' ),
					'std' => '160'
				),
				
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Track Color', 'halena' ),
					'param_name' => 'track_color',
					'description' => esc_html__( 'select the track color for the circle bar. if you don\'t want to use color just leave it blank. ', 'halena' ),
					'std' => ''
				),
				
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Bar Color', 'halena' ),
					'param_name' => 'bar_color',
					'description' => esc_html__( 'select the bar color for the circle bar. if you don\'t want  to use color just leave it blank. ', 'halena' ),
					'std' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Scale Color', 'halena' ),
					'param_name' => 'scale_color',
					'description' => esc_html__( 'select the scale color for the circle bar. if you don\'t want  to use color just leave it blank.', 'halena' ),
					'std' => ''
				),
				
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Scale Length', 'halena' ),
					'param_name' => 'scale_length',
					'description' => esc_html__( 'scale length for circle bar.  for.eg 15', 'halena' ),
					'std' => ''
				),
				
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Line Width', 'halena' ),
					'param_name' => 'line_width',
					'description' => esc_html__( 'Line length for circle bar.  for.eg 4', 'halena' ),
					'std' => '4'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Line Cap', 'halena' ),
					'param_name' => 'line_cap',
					'description' => esc_html__( 'butt, round and square.. are the options for line cap', 'halena' ),
					'std' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Alignment', 'halena' ),
					'param_name' => 'align',
					'value' => array(
						 esc_html__( 'Center', 'halena' ) => 'center',
						 esc_html__( 'Left', 'halena' ) => 'left',                      
						 esc_html__( 'Right', 'halena' ) => 'right'
						),
					'std' => 'center'
				),
				
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Choose Animation', 'halena' ),
					'param_name' => 'animation',
					'value' => array(
						'linear'=>'defaultEasing',
						'swing'=>'swing',
						'easeInQuad'=>'easeInQuad',
						'easeOutQuad' => 'easeOutQuad',
						'easeInOutQuad'=>'easeInOutQuad',
						'easeInCubic'=>'easeInCubic',
						'easeOutCubic'=>'easeOutCubic',
						'easeInOutCubic'=>'easeInOutCubic',
						'easeInQuart'=>'easeInQuart',
						'easeOutQuart'=>'easeOutQuart',
						'easeInOutQuart'=>'easeInOutQuart',
						'easeInQuint'=>'easeInQuint',
						'easeOutQuint'=>'easeOutQuint',
						'easeInOutQuint'=>'easeInOutQuint',
						'easeInExpo'=>'easeInExpo',
						'easeOutExpo'=>'easeOutExpo',
						'easeInOutExpo'=>'easeInOutExpo',
						'easeInSine'=>'easeInSine',
						'easeOutSine'=>'easeOutSine',
						'easeInOutSine'=>'easeInOutSine',
						'easeInCirc'=>'easeInCirc',
						'easeOutCirc'=>'easeOutCirc',
						'easeInOutCirc'=>'easeInOutCirc',
						'easeInElastic'=>'easeInElastic',
						'easeOutElastic'=>'easeOutElastic',
						'easeInOutElastic'=>'easeInOutElastic',
						'easeInBack'=>'easeInBack',
						'easeOutBack'=>'easeOutBack',
						'easeInOutBack'=>'easeInOutBack',
						'easeInBounce'=>'easeInBounce',
						'easeOutBounce'=>'easeOutBounce',
						'easeInOutBounce'=>'easeInOutBounce',
					
					),
					'description' => esc_html__( 'Select the animation which you want.', 'halena' ),
					'std' => 'linear'
				),
				
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Animation Offset', 'halena' ),
					'param_name' => 'animation_offset',
					'description' => esc_html__( 'You can use "simply number" or "%" to denote the offset. for ex. 90%. It will trigger the counter only when the element reach 90% from the top.', 'halena' ),
					'group' => esc_html__( 'Animation Settings', 'halena' ),
					'std' => '90%'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra class name', 'halena' ),
					'param_name' => 'class',
					'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'halena' ),
				),
			)
		
		));
		
		// List
		vc_map( array(
			'name' => esc_html__( 'List', 'halena' ),
			'base' => 'agni_list',
			'icon' => 'ion-ios-list-outline',
			'weight' => '84',
			'category' => esc_html__( 'Content', 'halena' ),
			'description' => esc_html__( 'List with icons ( Ionicons, Fontawesome )', 'halena' ),
			'params' => array(
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Choose Icon', 'halena' ),
					'param_name' => 'icon',
					'value' => '',
					'settings' => array(
						'type' => 'iconlist',
						'iconsPerPage' => 545,
					),
					'description' => wp_kses( __( '<small>Select the icon which you want <strong><a href="http://ionicons.com/">Ionicons</a>, <a href="http://fortawesome.github.io/Font-Awesome/icons/">FontAwesome</a>, <a href="http://themes-pixeden.com/font-demos/7-stroke/index.html">Pe Icon 7 Stroke</a>, <a href="http://themes-pixeden.com/font-demos/7-filled/index.html">Pe Icon 7 Filled</a> supported.</strong></small>', 'halena' ), array( 'small' => array(), 'strong' => array(), 'a' => array( 'href' => array() ) ) ),
					'std' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Icon style', 'halena' ),
					'param_name' => 'icon_style',
					'value' => array(
						 esc_html__( 'Default', 'halena' ) => '',
						 esc_html__( 'Background', 'halena' ) => 'background',
						 esc_html__( 'Bordered', 'halena' ) => 'border',
						),
					'description' => esc_html__( 'Select how the heading will be aligned', 'halena' ),
					'std' => '',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Radius', 'halena' ),
					'param_name' => 'radius',
					'description' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels.', 'halena' ),
					'dependency' => array( 'element' => 'icon_style', 'not_empty' => true ),
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Icon Background Color', 'halena' ),
					'param_name' => 'background_color',
					'description' => esc_html__('This will apply if the heading has divide line.', 'halena' ),
					'dependency' => array( 'element' => 'icon_style', 'value' => 'background' ),
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Icon Border Color', 'halena' ),
					'param_name' => 'border_color',
					'description' => esc_html__('This will apply if the heading has border.', 'halena' ),
					'dependency' => array( 'element' => 'icon_style', 'value' => 'border' ),
				),

				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Icon Color', 'halena' ),
					'param_name' => 'color',
					'description' => esc_html__('This will apply if the heading has divide line.', 'halena' ),
				),
				
				array(
					'type' => 'textarea_html',
					'heading' => esc_html__( 'List items', 'halena' ),
					'param_name' => 'content',
					'value' => '<li>List item</li><li>List item</li><li>List item</li>',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra class name', 'halena' ),
					'param_name' => 'class',
					'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'halena' ),
				),
				
			)
		
		));
		
		// Button
		vc_map( array(
			'name' => esc_html__( 'Button', 'halena' ),
			'base' => 'agni_button',
			'icon' => 'ion-ios-circle-outline',
			'weight' => '83',
			'category' => esc_html__( 'Content', 'halena' ),
			'description' => esc_html__( 'Various Button for eg. success, block', 'halena' ),
			'params' => array(      
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Button Value', 'halena' ),
					'class' => 'wpb_button',
					'param_name' => 'value',
					'description' => esc_html__( 'Value for the button.', 'halena' ),
					'std' => 'Button'
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Choose Icon', 'halena' ),
					'param_name' => 'icon',
					'value' => '',
					'settings' => array(
						'type' => 'iconlist',
						'iconsPerPage' => 545,
					),
					'description' => wp_kses( __( '<small>Select the icon which you want <strong><a href="http://ionicons.com/">Ionicons</a>, <a href="http://fortawesome.github.io/Font-Awesome/icons/">FontAwesome</a>, <a href="http://themes-pixeden.com/font-demos/7-stroke/index.html">Pe Icon 7 Stroke</a>, <a href="http://themes-pixeden.com/font-demos/7-filled/index.html">Pe Icon 7 Filled</a> supported.</strong></small>', 'halena' ), array( 'small' => array(), 'strong' => array(), 'a' => array( 'href' => array() ) ) ),
					'std' => ''
				),
				array(
					'type' => 'href',
					'heading' => esc_html__( 'Button URL', 'halena' ),
					'param_name' => 'url',
					'description' => esc_html__( 'URL for the button.', 'halena' ),
					'std' => '#'
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Enable Modal/Lightbox', 'halena' ),
					'param_name' => 'modal',
					'description' => esc_html__( 'Add external source source to the button link.', 'halena' ),
					'value' => array( esc_html__( 'Yes', 'halena' ) => '1' ),
					'std' => ''
				),
				array(
					'type' => 'textarea_safe',
					'heading' => esc_html__( 'Modal Source', 'halena' ),
					'param_name' => 'modal_src',
					'description' => esc_html__('Your embeded URL to display a video or any html codes. all video source supported', 'halena'),
					'dependency' => array( 'element' => 'modal', 'value' => '1' ),
					'std' => ''
				),
				
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Target', 'halena' ),
					'param_name' => 'target',
					'value' => array(   
						esc_html__( 'Same window', 'halena' ) => '_self',
						esc_html__( 'New window', 'halena' ) => '_blank'
					),
					'std' => '_self'
				),
				
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'button style', 'halena' ),
					'param_name' => 'style',
					'value' => array(   
						 esc_html__( 'Background(Default)', 'halena') => '',
						 esc_html__( 'Bordered', 'halena') => 'alt',
						 esc_html__( 'Plain', 'halena') => 'plain'
					),
					'description' => esc_html__( 'Select the button style.', 'halena' ),
					'std' => ''
				),
				
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Choose button type', 'halena' ),
					'param_name' => 'choice',
					'value' => array(   
						 esc_html__( 'Default', 'halena') => 'default',
						 esc_html__( 'Primary', 'halena') => 'primary',
						 esc_html__( 'Accent', 'halena') => 'accent',
						 esc_html__( 'White', 'halena') => 'white'
					),
					'description' => esc_html__( 'Select the button type.', 'halena' ),
					'std' => 'default'
				),
				
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Choose the size of button', 'halena' ),
					'param_name' => 'size',
					'value' => array(   
						 esc_html__( 'Default', 'halena') => '',
						 esc_html__( 'Large', 'halena') => 'lg',
						 esc_html__( 'Small', 'halena' ) => 'sm',
						 esc_html__( 'Extra Small', 'halena' ) => 'xs',
						 esc_html__( 'Block', 'halena' ) => 'block',
					),
					'description' => esc_html__( 'Select the size of the button..', 'halena' ),
					'std' => ''
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Responsive Button', 'halena' ),
					'param_name' => 'responsive_button',
					'description' => esc_html__( 'This will reduce the button size in order to fit with screen.' , 'halena' ),
					'value' => array( esc_html__( 'Yes', 'halena' ) => '1' ),
					'std' => '',
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Inline Button', 'halena' ),
					'param_name' => 'inline',
					'description' => esc_html__( 'It will bring the buttons to the same line.', 'halena' ),
					'value' => array( esc_html__( 'Yes', 'halena' ) => 'inline' ),
					'std' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Button Alignment', 'halena' ),
					'param_name' => 'alignment',
					'value' => array(   
						 esc_html__( 'Left', 'halena') => 'left',
						 esc_html__( 'Center', 'halena') => 'center',
						 esc_html__( 'Right', 'halena' ) => 'right',
					),
					'description' => esc_html__( 'Select the Alignment of the button.', 'halena' ),
					'std' => 'left',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra class name', 'halena' ),
					'param_name' => 'class',
					'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'halena' ),
				),
			)
		
		));
		vc_add_params( "agni_button", $row_space_atts );
		vc_add_params( "agni_button", $col_animation_atts );
		vc_add_params( "agni_button", $col_parallax_atts );
		
		// Alerts
		vc_map( array(
			'name' => esc_html__( 'Alerts', 'halena' ),
			'base' => 'agni_alerts',
			'icon' => 'ion-ios-alarm-outline',
			'weight' => '82',
			'category' => esc_html__( 'Content', 'halena' ),
			'description' => esc_html__( 'List with icons ( Ionicons, Fontawesome )', 'halena' ),
			'params' => array(
								
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Choose the style', 'halena' ),
					'param_name' => 'choice',
					'value' => array(   
						 esc_html__( 'Success', 'halena') => 'success',
						 esc_html__( 'Danger', 'halena') => 'danger',
						 esc_html__( 'Warning', 'halena' ) => 'warning',
						 esc_html__( 'Info', 'halena' ) => 'info',
					),
					'description' => esc_html__( 'Choose the releavant alert message type. ', 'halena' ),
					'std' => 'success'
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Dismissable alert', 'halena' ),
					'param_name' => 'dismissable',
					'description' => esc_html__( 'if you want the close button. just check this.', 'halena' ),
					'value' => array( esc_html__( 'Yes', 'halena' ) => 'yes' ),
					'std' => ''
				),
				
				array(
					'type' => 'textarea_html',
					'heading' => esc_html__( 'Alert Message', 'halena' ),
					'param_name' => 'content',
					'value' => 'Nam convallis velit ac nibh imperdiet, eget euismod eros consequat.',
					'std' => ''
				),
				
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra class name', 'halena' ),
					'param_name' => 'class',
					'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'halena' ),
				),
			)
		
		));
		
		// Image
		vc_map( array(
			'name' => esc_html__( 'Image', 'halena' ),
			'base' => 'agni_image',
			'icon' => 'ion-ios-camera-outline',
			'weight' => '81',
			'category' => esc_html__( 'Content', 'halena' ),
			'description' => esc_html__( 'Choose whether to use Simple image or Before/After Image.', 'halena' ),
			'params' => array(
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Choice', 'halena' ),
					'param_name' => 'img_type',
					'description' => esc_html__( 'choose image size', 'halena' ),
					'value' => array(   
						 esc_html__( 'Simple Image', 'halena') => 'default',
						 esc_html__( 'Before/After', 'halena') => 'beforeafter',
						 esc_html__( 'Swap Image', 'halena') => 'swapimage',
					),
					'std' => 'default'
				),
				array(
					'type' => 'attach_image',
					'heading' => esc_html__( 'Image', 'halena' ),
					'param_name' => 'img_url',
					'description' => esc_html__( 'Select image from media library. It will act a before image, if you use Before/After.', 'halena' ),
					'std' => ''
				),
				array(
					'type' => 'attach_image',
					'heading' => esc_html__( 'After Image', 'halena' ),
					'param_name' => 'img_after_url',
					'description' => esc_html__( 'Select image from media library.', 'halena' ),
					'dependency' => array( 'element' => 'img_type', 'value' => array( 'beforeafter', 'swapimage') ),
					'std' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Image size', 'halena' ),
					'param_name' => 'img_size',
					'description' => esc_html__( 'choose image size', 'halena' ),
					'value' => array(   
						 esc_html__( 'thumbnail', 'halena') => 'thumbnail',
						 esc_html__( 'medium', 'halena') => 'medium',
						 esc_html__( 'large', 'halena') => 'large',
						 esc_html__( 'Full', 'halena') => 'full',
						 esc_html__( 'Custom', 'halena') => 'custom',
					),
					'std' => 'full'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Custom Image Size', 'halena' ),
					'param_name' => 'img_size_custom',
					'description' => esc_html__( 'It will hard crop all images to the mentioned dimensions.', 'halena' ),
					'dependency' => array( 'element' => 'img_size', 'value' => 'custom' ),
					'std' => '640x640'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Image Width', 'halena' ),
					'param_name' => 'img_width',
					'description' => esc_html__( 'It will help you to scale up/down as per your wish. Note: height will be adjusted automatically.', 'halena' ),
					'std' => ''
				),
				
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Add caption?', 'halena' ),
					'param_name' => 'img_caption',
					'description' => esc_html__( 'Add image caption.', 'halena' ),
					'value' => array( esc_html__( 'Yes', 'halena' ) => 'yes' ),
				),

				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Grayscale Filter', 'halena' ),
					'param_name' => 'img_gs_filter',
					'description' => esc_html__( 'It will change the thumbnail to grayscale(black&white). Note: It will not work on IE browsers.', 'halena' ),
					'value' => array( esc_html__( 'Yes', 'halena' ) => 'yes' ),
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Image alignment', 'halena' ),
					'param_name' => 'alignment',
					'value' => array(
						esc_html__( 'Left', 'halena' ) => 'left',
						esc_html__( 'Right', 'halena' ) => 'right',
						esc_html__( 'Center', 'halena' ) => 'center'
					),
					'description' => esc_html__( 'Select image alignment.', 'halena' ),
					'std' => 'left'
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Image style', 'halena' ),
					'param_name' => 'img_style',
					'value' => array(
						 esc_html__( 'None', 'halena' ) => '',
						 esc_html__( 'Background', 'halena' ) => 'background',
						 esc_html__( 'Bordered', 'halena' ) => 'bordered',
						),
					'std' => '',
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Background Color', 'halena' ),
					'param_name' => 'background_color',
					'description' => esc_html__('choose the background color for image.', 'halena' ),
					'dependency' => array( 'element' => 'img_style', 'value' => 'background' ),
					'std' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Border Color', 'halena' ),
					'param_name' => 'border_color',
					'description' => esc_html__('choose the border color for image.', 'halena' ),
					'dependency' => array( 'element' => 'img_style', 'value' => 'bordered' ),
					'std' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Radius', 'halena' ),
					'param_name' => 'radius',
					'description' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels.', 'halena' ),
					'std' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'On click action', 'halena' ),
					'param_name' => 'img_link',
					'value' => array(
						esc_html__( 'None', 'halena' ) => '1',
						esc_html__( 'Attachment Image', 'halena' ) => '2',
						esc_html__( 'Lightbox', 'halena' ) => '3',
						esc_html__( 'Custom link', 'halena' ) => '4',
					),
					'description' => esc_html__( 'Select action for click action.', 'halena' ),
					'dependency' => array( 'element' => 'img_type', 'value' => 'default' ),
					'std' => '1'
				),
				array(
					'type' => 'href',
					'heading' => esc_html__( 'Image link', 'halena' ),
					'param_name' => 'img_custom_link',
					'description' => esc_html__( 'Enter URL if you want this image to have a link (Note: parameters like "mailto:" are also accepted).', 'halena' ),
					'dependency' => array( 'element' => 'img_link', 'value' => '4', ),
					'std' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'On click target', 'halena' ),
					'param_name' => 'img_custom_link_target',
					'value' => array(
						esc_html__( 'Same Window', 'halena' ) => '_self',
						esc_html__( 'New Window', 'halena' ) => '_blank',
					),
					'description' => esc_html__( 'Select target for click action.', 'halena' ),
					'dependency' => array( 'element' => 'img_link', 'value' => '4' ),
					'std' => '_self'
				),
				$animation_atts,
				$animation_style_atts, 
				$animation_duration_atts,
				$animation_delay_atts,
				$animation_offset_atts,

				$parallax_atts,
				$parallax_start_atts,
				$parallax_end_atts,

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra class name', 'halena' ),
					'param_name' => 'class',
					'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'halena' ),
				),
			)
		) );
		
		// Gallery
		global $vc_column_width_list;
		vc_map( array(
			'name' => esc_html__( 'Gallery', 'halena' ),
			'base' => 'agni_gallery',
			'icon' => 'ion-ios-albums-outline',
			'weight' => '80',
			'category' => esc_html__( 'Media', 'halena' ),
			'description' => esc_html__( 'group of image with lightbox gallery.', 'halena' ),
			'params' => array(
				
				array(
					'type' => 'attach_images',
					'heading' => esc_html__( 'Select Image', 'halena' ),
					'param_name' => 'img_url',
					'description' => esc_html__( 'Select the image', 'halena' ),
					'std' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Image size', 'halena' ),
					'param_name' => 'img_size',
					'description' => esc_html__( 'choose image size', 'halena' ),
					'value' => array(   
						 esc_html__( 'thumbnail', 'halena') => 'thumbnail',
						 esc_html__( 'medium', 'halena') => 'medium',
						 esc_html__( 'large', 'halena') => 'large',
						 esc_html__( 'Full', 'halena') => 'full',
						 esc_html__( 'Custom', 'halena') => 'custom',
					),
					'std' => 'full'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Custom Image Size', 'halena' ),
					'param_name' => 'img_size_custom',
					'description' => esc_html__( 'It will hard crop all images to the mentioned dimensions.', 'halena' ),
					'dependency' => array( 'element' => 'img_size', 'value' => 'custom' ),
					'std' => '640x640'
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Add caption?', 'halena' ),
					'param_name' => 'img_caption',
					'description' => esc_html__( 'Add image caption.', 'halena' ),
					'value' => array( esc_html__( 'Yes', 'halena' ) => 'yes' ),
					'std' => ''
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Grayscale Filter', 'halena' ),
					'param_name' => 'img_gs_filter',
					'description' => esc_html__( 'It will change the thumbnail to grayscale(black&white). Note: It will not work on IE browsers.', 'halena' ),
					'value' => array( esc_html__( 'Yes', 'halena' ) => 'yes' ),
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'On click action', 'halena' ),
					'param_name' => 'img_link',
					'value' => array(
						esc_html__( 'None', 'halena' ) => '1',
						esc_html__( 'Attachment Image', 'halena' ) => '2',
						esc_html__( 'Lightbox', 'halena' ) => '3',
					),
					'description' => esc_html__( 'Select action for click action.', 'halena' ),
					'std' => '1'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Gap(Gutter)', 'halena' ),
					'param_name' => 'gap',
					'description' => esc_html__( 'Gap between each item. Enter values in px. Don\'t include "px" string', 'halena' ),
					'std' => '30'
				),
				array(
                    'type'     => 'dropdown',
                    'heading'    => esc_html__( 'Gallery Grid Style', 'halena' ),
                    'param_name' => 'gallery-grid-layout',
                    'description' => esc_html__( 'Choose any of one grid style. fitRows is default.', 'halena' ),
                    'value' => array(
                        esc_html__( 'FitRows(Default Grid)', 'halena') => 'fitRows',
                        esc_html__( 'Masonry', 'halena') => 'masonry',
                    ),
                    'std'  => 'fitRows'
                ),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Number of Columns', 'halena' ),
					'param_name' => 'columns',
					'value' => array(   
						 esc_html__( '1 column', 'halena' ) => '1',
						 esc_html__( '2 columns', 'halena' ) => '2',
						 esc_html__( '3 columns', 'halena' ) => '3',
						 esc_html__( '4 columns', 'halena' ) => '4',
						 esc_html__( '5 columns', 'halena' ) => '5',
						 esc_html__( '6 columns', 'halena' ) => '6',
					),
					'description' => esc_html__( 'Choose the column on desktop screen. it will adjust the columns count on responsive screens automatically.', 'halena' ),
					'std' => '3'
				),

				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Carousel Holder', 'halena' ),
					'param_name' => 'carousel_type',
					'value' => array(
						esc_html__( 'Img tag', 'halena' ) => 'img-carousel',
						esc_html__( 'Background', 'halena' ) => 'bg-carousel',
					),
					'dependency' => array( 'element' => 'carousel', 'value' => '1' ),
                	'group' => esc_html__( 'Carousel Settings', 'halena' ),
					'std' => 'img-carousel'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Height', 'halena' ),
					'param_name' => 'carousel_height',
					'description' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels. Tip. for 100% Viewport height use "100vh"', 'halena' ),
					'dependency' => array( 'element' => 'carousel_type', 'value' => 'bg-carousel' ),
                	'group' => esc_html__( 'Carousel Settings', 'halena' ),
					'std' => '500'
				),
				
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra class name', 'halena' ),
					'param_name' => 'class',
					'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'halena' ),
				),

				$animation_atts,
				$animation_style_atts, 
				$animation_duration_atts,
				$animation_delay_atts,
				$animation_offset_atts,
			)
		
		));
		vc_add_params( "agni_gallery", $elements_carousel_atts );

		// Fancy Image
		vc_map( array(
			'name' => esc_html__( 'Fancy Image', 'halena' ),
			'base' => 'agni_fancy_image',
			'icon' => 'ion-ios-camera-outline',
			'weight' => '81',
			'category' => esc_html__( 'Content', 'halena' ),
			'description' => esc_html__( 'Choose whether to use Simple image or Before/After Image.', 'halena' ),
			'params' => array(

				array(
					'type' => 'param_group',
					'heading' => esc_html__( 'Values', 'halena' ),
					'param_name' => 'values',
					'value' => urlencode( json_encode( array(
						array(
							'column' => '6',
							'column_tab' => '6',
							'column_mobile' => '6',
							'img_url' => '',
							'img_size' => 'full',
							'img_size_custom' => '640x640',
							'img_type' => 'img-holder',
							'bg_img_height' => '',
							'bg_img_height_tab' => '',
							'bg_img_height_mobile' => '',
							'bg_img_repeat' => 'repeat',
							'bg_img_size' => 'cover',
							'bg_img_position' => 'center center',
							'bg_img_attachment' => 'scroll',
							'has_fullwidth_img' => '',
							'bg_parallax' => '',
							'data_bottom_top' => 'transform: translateY(60px)',
							'data_center' => 'transform: translateY(0px)',
							'data_top_bottom' => 'transform: translateY(-60px)'
						),
						array(
							'column' => '6',
							'column_tab' => '6',
							'column_mobile' => '6',
							'img_url' => '',
							'img_size' => 'full',
							'img_size_custom' => '640x640',
							'img_type' => 'img-holder',
							'bg_img_height' => '',
							'bg_img_height_tab' => '',
							'bg_img_height_mobile' => '',
							'bg_img_repeat' => 'repeat',
							'bg_img_size' => 'cover',
							'bg_img_position' => 'center center',
							'bg_img_attachment' => 'scroll',
							'has_fullwidth_img' => '',
							'bg_parallax' => '',
							'data_bottom_top' => 'transform: translateY(60px)',
							'data_center' => 'transform: translateY(0px)',
							'data_top_bottom' => 'transform: translateY(-60px)'
						)
					) ) ),
					'params' => array(
						array(
							'type' => 'dropdown',
							'heading' => esc_html__( 'Number of Columns', 'halena' ),
							'param_name' => 'column',
							'value' => array(   
								 esc_html__( '1 column', 'halena') => '1',
								 esc_html__( '2 columns', 'halena') => '2',
								 esc_html__( '3 columns', 'halena') => '3',
								 esc_html__( '4 columns', 'halena' ) => '4',
								 esc_html__( '5 columns', 'halena' ) => '5',
								 esc_html__( '6 columns', 'halena' ) => '6',
								 esc_html__( '7 columns', 'halena' ) => '7',
								 esc_html__( '8 columns', 'halena' ) => '8',
								 esc_html__( '9 columns', 'halena' ) => '9',
								 esc_html__( '10 columns', 'halena' ) => '10',
								 esc_html__( '11 columns', 'halena' ) => '11',
								 esc_html__( '12 columns', 'halena' ) => '12'
							),
							'description' => esc_html__( 'Choose the column on desktop screen.', 'halena' ),
							'edit_field_class' => 'vc_col-sm-4 vc_col-md-4 vc_column',
							'std' => '6'
						),
						array(
							'type' => 'dropdown',
							'heading' => esc_html__( 'Columns on Tab', 'halena' ),
							'param_name' => 'column_tab',
							'value' => array(   
								 esc_html__( '1 column', 'halena') => '1',
								 esc_html__( '2 columns', 'halena') => '2',
								 esc_html__( '3 columns', 'halena') => '3',
								 esc_html__( '4 columns', 'halena' ) => '4',
								 esc_html__( '5 columns', 'halena' ) => '5',
								 esc_html__( '6 columns', 'halena' ) => '6',
								 esc_html__( '7 columns', 'halena' ) => '7',
								 esc_html__( '8 columns', 'halena' ) => '8',
								 esc_html__( '9 columns', 'halena' ) => '9',
								 esc_html__( '10 columns', 'halena' ) => '10',
								 esc_html__( '11 columns', 'halena' ) => '11',
								 esc_html__( '12 columns', 'halena' ) => '12'
							),
							'edit_field_class' => 'vc_col-sm-4 vc_col-md-4 vc_column',
							'std' => '6'
						),
						array(
							'type' => 'dropdown',
							'heading' => esc_html__( 'Columns on Mobile', 'halena' ),
							'param_name' => 'column_mobile',
							'value' => array(   
								 esc_html__( '1 column', 'halena') => '1',
								 esc_html__( '2 columns', 'halena') => '2',
								 esc_html__( '3 columns', 'halena') => '3',
								 esc_html__( '4 columns', 'halena' ) => '4',
								 esc_html__( '5 columns', 'halena' ) => '5',
								 esc_html__( '6 columns', 'halena' ) => '6',
								 esc_html__( '7 columns', 'halena' ) => '7',
								 esc_html__( '8 columns', 'halena' ) => '8',
								 esc_html__( '9 columns', 'halena' ) => '9',
								 esc_html__( '10 columns', 'halena' ) => '10',
								 esc_html__( '11 columns', 'halena' ) => '11',
								 esc_html__( '12 columns', 'halena' ) => '12'
							),
							'edit_field_class' => 'vc_col-sm-4 vc_col-md-4 vc_column',
							'std' => '6'
						),

						array(
							'type' => 'attach_image',
							'heading' => esc_html__( 'Choose Image', 'halena' ),
							'param_name' => 'img_url',
							'description' => esc_html__( 'Choose your desired background image, to display behind the content.', 'halena' ),
							'admin_label' => true,
							'std' => '',
						),
						array(
							'type' => 'dropdown',
							'heading' => esc_html__( 'Image size', 'halena' ),
							'param_name' => 'img_size',
							'description' => esc_html__( 'choose image size', 'halena' ),
							'value' => array(   
								 esc_html__( 'Full', 'halena') => 'full',
								 esc_html__( 'Custom', 'halena') => 'custom',
							),
							'dependency' => array( 'element' => 'img_url', 'not_empty' => true ),
							'std' => 'full'
						),
						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Custom Image Size', 'halena' ),
							'param_name' => 'img_size_custom',
							'description' => esc_html__( 'It will hard crop image to the mentioned dimensions.', 'halena' ),
							'dependency' => array( 'element' => 'img_size', 'value' => 'custom' ),
							'std' => '640x640'
						),
						array(
							'type' => 'dropdown',
							'heading' => esc_html__( 'Image Holder', 'halena' ),
							'param_name' => 'img_type',
							'value' => array(
								esc_html__( 'Img tag', 'halena' ) => 'img-holder',
								esc_html__( 'Background', 'halena' ) => 'bg-holder',
							),
							'std' => 'img-holder'
						),

						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'BG Image Height', 'halena' ),
							'param_name' => 'bg_img_height',
							'description' => esc_html__( 'Enter your desired height for the image. Don\'t include px string.', 'halena' ),
							'dependency' => array( 'element' => 'img_type', 'value' => 'bg-holder' ),
							'edit_field_class' => 'vc_col-sm-4 vc_col-md-4 vc_column',
							'std' => ''
						),
						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Height on Tab', 'halena' ),
							'param_name' => 'bg_img_height_tab',
							'description' => esc_html__( 'Enter your desired height for the image. Don\'t include px string.', 'halena' ),
							'dependency' => array( 'element' => 'img_type', 'value' => 'bg-holder' ),
							'edit_field_class' => 'vc_col-sm-4 vc_col-md-4 vc_column',
							'std' => ''
						),
						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Height on mobile', 'halena' ),
							'param_name' => 'bg_img_height_mobile',
							'description' => esc_html__( 'Enter your desired height for the image. Don\'t include px string.', 'halena' ),
							'dependency' => array( 'element' => 'img_type', 'value' => 'bg-holder' ),
							'edit_field_class' => 'vc_col-sm-4 vc_col-md-4 vc_column',
							'std' => ''
						),
						array(
							'type' => 'checkbox',
							'heading' => esc_html__( 'Force the Image to 100%', 'halena' ),
							'param_name' => 'has_fullwidth_img',
							'description' => esc_html__( 'It fill the image to 100% of column width even image resolution is low.', 'halena' ),
							'value' => array( esc_html__( 'Yes', 'halena' ) => '1' ),
							'dependency' => array( 'element' => 'img_type', 'value' => 'img-holder' ),
							'std' => ''
						),
						array(
							'type' => 'dropdown',
							'heading' => esc_html__( 'BG Image Repeat', 'halena' ),
							'param_name' => 'bg_img_repeat',
							'weight' => '1',
							'value' => array(
								 esc_html__( 'Repeat', 'halena' ) => 'repeat',
								 esc_html__('No Repeat', 'halena') => 'no-repeat'
								),
							'description' => esc_html__( 'Choose whether your background image should be repeated to X-axis Y-axis or not.', 'halena' ),
							'dependency' => array( 'element' => 'img_type', 'value' => 'bg-holder' ),
							'edit_field_class' => 'vc_col-sm-3 vc_col-md-3 vc_column',
							'std' => 'repeat',
						),

						array(
							'type' => 'dropdown',
							'heading' => esc_html__( 'BG Image Size', 'halena' ),
							'param_name' => 'bg_img_size',
							'weight' => '1',
							'value' => array(
								 esc_html__('Cover', 'halena') => 'cover',
								 esc_html__( 'Auto', 'halena' ) => 'auto',
								 esc_html__( 'Contain', 'halena' ) => 'contain'
								),
							'description' => esc_html__( 'Choose your desired background image size.', 'halena' ),
							'dependency' => array( 'element' => 'img_type', 'value' => 'bg-holder' ),
							'edit_field_class' => 'vc_col-sm-3 vc_col-md-3 vc_column',
							'std' => 'cover',
						),
						array(
							'type' => 'dropdown',
							'heading' => esc_html__( 'BG Image Position', 'halena' ),
							'param_name' => 'bg_img_position',
							'weight' => '1',
							'value' => array(
								 esc_html__( 'center center', 'halena' ) => 'center center',
								 esc_html__( 'left top', 'halena') => 'left top',
								 esc_html__( 'left center', 'halena' ) => 'left center',
								 esc_html__( 'left bottom', 'halena' ) => 'left bottom',
								 esc_html__( 'right top', 'halena' ) => 'right top',
								 esc_html__( 'right center', 'halena' ) => 'right center',
								 esc_html__( 'right bottom', 'halena' ) => 'right bottom',
								 esc_html__( 'center top', 'halena' ) => 'center top',
								 esc_html__( 'center bottom', 'halena' ) => 'center bottom',
							),
							'description' => esc_html__( 'Choose your desired background image position', 'halena' ),
							'dependency' => array( 'element' => 'img_type', 'value' => 'bg-holder' ),
							'edit_field_class' => 'vc_col-sm-3 vc_col-md-3 vc_column',
							'std' => 'center center',
						),

						array(
							'type' => 'dropdown',
							'heading' => esc_html__( 'BG Image Attachment', 'halena' ),
							'param_name' => 'bg_img_attachment',
							'weight' => '1',
							'value' => array(
								 esc_html__( 'Scroll', 'halena' ) => 'scroll',
								 esc_html__( 'Fixed', 'halena' ) => 'fixed',
								),
							'description' => esc_html__( 'Choose your desired background image attachment', 'halena' ),
							'dependency' => array( 'element' => 'img_type', 'value' => 'bg-holder' ),
							'edit_field_class' => 'vc_col-sm-3 vc_col-md-3 vc_column',
							'std' => 'scroll'
						),

						array(
							'type' => 'checkbox',
							'heading' => esc_html__( 'Parallax', 'halena' ),
							'param_name' => 'bg_parallax',
							'description' => wp_kses( __( 'This parallax effect is purely based on skrollr plugin. You can do tons of things by refer this <a href="https://github.com/Prinzhorn/skrollr">Skrollr</a>.', 'halena' ), array( 'a' => array( 'href' => array() ) ) ),
							'value' => array( esc_html__( 'Enable', 'halena' ) => '1' ),
							'dependency' => array( 'element' => 'bg_choice', 'value' => array( '1', '2' ) ),
							'std' => '',
						),
						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Element\'s Top at Bottom.', 'halena' ),
							'param_name' => 'data_bottom_top',
							//'description' => esc_html__( 'Enter the values for ex. background-color: rgba(255, 255, 255, 1), it will be triggered when the element\'s top at the bottom.', 'halena' ),
							'dependency' => array( 'element' => 'bg_parallax', 'value' => '1' ),
							'edit_field_class' => 'vc_col-sm-4 vc_col-md-4 vc_column',
							'std' => 'transform: translateY(60px)'
							
						),
						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Element\'s Center at Center.', 'halena' ),
							'param_name' => 'data_center',
							//'description' => esc_html__( 'It will be triggered when the element\'s center at the center.', 'halena' ),
							'dependency' => array( 'element' => 'bg_parallax', 'value' => '1' ),
							'edit_field_class' => 'vc_col-sm-4 vc_col-md-4 vc_column',
							'std' => 'transform: translateY(0px)'
							
						),
						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Element\'s Bottom at Top.', 'halena' ),
							'param_name' => 'data_top_bottom',
							//'description' => esc_html__( 'It will be triggered when the element\'s bottom at the Top.', 'halena' ),
							'dependency' => array( 'element' => 'bg_parallax', 'value' => '1' ),
							'edit_field_class' => 'vc_col-sm-4 vc_col-md-4 vc_column',
							'std' => 'transform: translateY(-60px)'
							
						)

					),
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Gap between Background Images', 'halena' ),
					'param_name' => 'img_gutter',
					'description' => esc_html__( 'Enter your desired gap. Don\'t include px string.', 'halena' ),
					'std' => '30',
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Title', 'halena' ),
					'param_name' => 'title',
					'description' => esc_html__( 'Enter your title/text', 'halena' ),
					'std' => esc_attr__( 'Lorem ipsum', 'halena' ),
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Title Size', 'halena' ),
					'param_name' => 'title_size',
					'description' => esc_html__( 'Enter yourtitle/text font size. Don\'t include px string.', 'halena' ),
					'dependency' => array( 'element' => 'title', 'not_empty' => true ),
					'std' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Title Color', 'halena' ),
					'param_name' => 'title_color',
					'description' => esc_html__('Choose your desired color for title', 'halena' ),
					'dependency' => array( 'element' => 'title', 'not_empty' => true ),
					'std' => '',
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Title Responsive', 'halena' ),
					'param_name' => 'title_responsive',
					'description' => esc_html__( 'Check this, if you want the title to be responsive.', 'halena' ),
					'value' => array( esc_html__( 'Yes', 'halena' ) => '1' ),
					'std' => ''
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Divide Line', 'halena' ),
					'param_name' => 'divide_line',
					'description' => esc_html__( 'Check this, if you want to show the divide line.', 'halena' ),
					'value' => array( esc_html__( 'Yes', 'halena' ) => '1' ),
					'std' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Divide Line Color', 'halena' ),
					'param_name' => 'divide_line_color',
					'description' => esc_html__('Choose your desired color for divideline', 'halena' ),
					'dependency' => array( 'element' => 'divide_line', 'value' => '1' ),
					'std' => '',
				),
				
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Description', 'halena' ),
					'param_name' => 'description',
					'std' => '',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Description Size', 'halena' ),
					'param_name' => 'description_size',
					'description' => esc_html__( 'Enter your description font size. Don\'t include px string.', 'halena' ),
					'dependency' => array( 'element' => 'description', 'not_empty' => true ),
					'std' => ''
				),

				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Description Color', 'halena' ),
					'param_name' => 'description_color',
					'description' => esc_html__('Choose your desired color for description', 'halena' ),
					'dependency' => array( 'element' => 'description', 'not_empty' => true ),
					'std' => '',
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Button Value', 'halena' ),
					'param_name' => 'btn_value',
					'description' => esc_html__( 'Enter your call to action button value.', 'halena' ),
					'std' => ''
				),
				array(
					'type' => 'href',
					'heading' => esc_html__( 'Button URL', 'halena' ),
					'param_name' => 'btn_url',
					'description' => esc_html__( 'Enter the URL for the button.', 'halena' ),
					'dependency' => array( 'element' => 'btn_value', 'not_empty' => true ),
					'std' => '#'
				),
				
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Button style', 'halena' ),
					'param_name' => 'btn_style',
					'value' => array(   
						 esc_html__( 'Background', 'halena') => '',
						 esc_html__( 'Bordered', 'halena') => 'alt'
					),
					'description' => esc_html__( 'Choose your desired button style.', 'halena' ),
					'dependency' => array( 'element' => 'btn_value', 'not_empty' => true ),
					'std' => '',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Button Radius', 'halena' ),
					'param_name' => 'btn_radius',
					'description' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels.', 'halena' ),
					'dependency' => array( 'element' => 'btn_value', 'not_empty' => true ),
					'std' => '',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Button Size', 'halena' ),
					'param_name' => 'btn_size',
					'value' => array(   
						 esc_html__( 'Default', 'halena') => '',
						 esc_html__( 'Large', 'halena') => 'lg',
						 esc_html__( 'Small', 'halena' ) => 'sm',
						 esc_html__( 'Extra Small', 'halena' ) => 'xs',
						 esc_html__( 'Block', 'halena' ) => 'block',
					),
					'description' => esc_html__( 'Select the size of the button.', 'halena' ),
					'dependency' => array( 'element' => 'btn_value', 'not_empty' => true ),
					'std' => ''
				),

				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Button Type', 'halena' ),
					'param_name' => 'btn_choice',
					'value' => array(   
						 esc_html__( 'Default', 'halena') => 'default',
						 esc_html__( 'Primary', 'halena') => 'primary',
						 esc_html__( 'Accent', 'halena') => 'accent',
						 esc_html__( 'White', 'halena') => 'white'
					),
					'description' => esc_html__( 'Choose your desired button type.', 'halena' ),
					'dependency' => array( 'element' => 'btn_value', 'not_empty' => true ),
					'std' => 'default'
				),

				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Alignment', 'halena' ),
					'param_name' => 'alignment',
					'value' => array(   
						 esc_html__( 'Left', 'halena') => 'flex-start',
						 esc_html__( 'Center', 'halena') => 'center',
						 esc_html__( 'Right', 'halena' ) => 'flex-end',
					),
					'description' => esc_html__( 'Select the Alignment of the content.', 'halena' ),
					'std' => 'center',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Vertical Alignment', 'halena' ),
					'param_name' => 'vertical_alignment',
					'value' => array(   
						 esc_html__( 'Top', 'halena') => 'flex-start',
						 esc_html__( 'Center', 'halena') => 'center',
						 esc_html__( 'Bottom', 'halena' ) => 'flex-end',
					),
					'description' => esc_html__( 'Select the Vertical Alignment of the content.', 'halena' ),
					'std' => 'center',
				),

				$animation_atts,
				$animation_style_atts, 
				$animation_duration_atts,
				$animation_delay_atts,
				$animation_offset_atts,

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra class name', 'halena' ),
					'param_name' => 'class',
					'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'halena' ),
				),
			)
		) );

		// Category box
		vc_map( array(
			'name' => esc_html__( 'Category Box', 'halena' ),
			'base' => 'agni_category_box',
			'icon' => 'ion-ios-camera-outline',
			'weight' => '81',
			'category' => esc_html__( 'Content', 'halena' ),
			'description' => esc_html__( 'Choose whether to use Simple image or Before/After Image.', 'halena' ),
			'params' => array(
						
				array(
					'type' => 'attach_image',
					'heading' => esc_html__( 'Choose Image', 'halena' ),
					'param_name' => 'img_url',
					'description' => esc_html__( 'Choose your desired background image, to display behind the content.', 'halena' ),
					'std' => '',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Image size', 'halena' ),
					'param_name' => 'img_size',
					'description' => esc_html__( 'choose image size', 'halena' ),
					'value' => array(   
						 esc_html__( 'Full', 'halena') => 'full',
						 esc_html__( 'Custom', 'halena') => 'custom',
					),
					'dependency' => array( 'element' => 'img_url', 'not_empty' => true ),
					'std' => 'full'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Custom Image Size', 'halena' ),
					'param_name' => 'img_size_custom',
					'description' => esc_html__( 'It will hard crop image to the mentioned dimensions.', 'halena' ),
					'dependency' => array( 'element' => 'img_size', 'value' => 'custom' ),
					'std' => '640x640'
				),

				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Force the Image to 100%', 'halena' ),
					'param_name' => 'has_fullwidth_img',
					'description' => esc_html__( 'It fill the image to 100% of column width even image resolution is low.', 'halena' ),
					'value' => array( esc_html__( 'Yes', 'halena' ) => '1' ),
					'std' => ''
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Title', 'halena' ),
					'param_name' => 'title',
					'description' => esc_html__( 'Enter your title/text', 'halena' ),
					'std' => esc_attr__( 'Lorem ipsum', 'halena' ),
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Title Size', 'halena' ),
					'param_name' => 'title_size',
					'description' => esc_html__( 'Enter yourtitle/text font size. Don\'t include px string.', 'halena' ),
					'dependency' => array( 'element' => 'title', 'not_empty' => true ),
					'std' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Title Color', 'halena' ),
					'param_name' => 'title_color',
					'description' => esc_html__('Choose your desired color for title', 'halena' ),
					'dependency' => array( 'element' => 'title', 'not_empty' => true ),
					'std' => '',
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Title BG Color', 'halena' ),
					'param_name' => 'title_bg_color',
					'description' => esc_html__('Choose your desired color for title background.', 'halena' ),
					'dependency' => array( 'element' => 'title', 'not_empty' => true ),
					'std' => '',
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Button Value', 'halena' ),
					'param_name' => 'btn_value',
					'description' => esc_html__( 'Enter your call to action button value.', 'halena' ),
					'std' => ''
				),
				array(
					'type' => 'href',
					'heading' => esc_html__( 'Button URL', 'halena' ),
					'param_name' => 'btn_url',
					'description' => esc_html__( 'Enter the URL for the button.', 'halena' ),
					'dependency' => array( 'element' => 'btn_value', 'not_empty' => true ),
					'std' => '#'
				),
				
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Button style', 'halena' ),
					'param_name' => 'btn_style',
					'value' => array(   
						 esc_html__( 'Background', 'halena') => '',
						 esc_html__( 'Bordered', 'halena') => 'alt',
						 esc_html__( 'Plain', 'halena') => 'plain'
					),
					'description' => esc_html__( 'Choose your desired button style.', 'halena' ),
					'dependency' => array( 'element' => 'btn_value', 'not_empty' => true ),
					'std' => '',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Button Radius', 'halena' ),
					'param_name' => 'btn_radius',
					'description' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels.', 'halena' ),
					'dependency' => array( 'element' => 'btn_value', 'not_empty' => true ),
					'std' => '',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Button Size', 'halena' ),
					'param_name' => 'btn_size',
					'value' => array(   
						 esc_html__( 'Default', 'halena') => '',
						 esc_html__( 'Large', 'halena') => 'lg',
						 esc_html__( 'Small', 'halena' ) => 'sm',
						 esc_html__( 'Extra Small', 'halena' ) => 'xs',
						 esc_html__( 'Block', 'halena' ) => 'block',
					),
					'description' => esc_html__( 'Select the size of the button.', 'halena' ),
					'dependency' => array( 'element' => 'btn_value', 'not_empty' => true ),
					'std' => ''
				),

				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Button Type', 'halena' ),
					'param_name' => 'btn_choice',
					'value' => array(   
						 esc_html__( 'Default', 'halena') => 'default',
						 esc_html__( 'Primary', 'halena') => 'primary',
						 esc_html__( 'Accent', 'halena') => 'accent',
						 esc_html__( 'White', 'halena') => 'white'
					),
					'description' => esc_html__( 'Choose your desired button type.', 'halena' ),
					'dependency' => array( 'element' => 'btn_value', 'not_empty' => true ),
					'std' => 'default'
				),

				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Content Position', 'halena' ),
					'param_name' => 'alignment',
					'value' => array(   
						 esc_html__( 'Left', 'halena') => 'flex-start',
						 esc_html__( 'Center', 'halena') => 'center',
						 esc_html__( 'Right', 'halena' ) => 'flex-end',
					),
					'description' => esc_html__( 'Select the Alignment of the content.', 'halena' ),
					'std' => 'center',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Content Vertical Position', 'halena' ),
					'param_name' => 'vertical_alignment',
					'value' => array(   
						 esc_html__( 'Top', 'halena') => 'flex-start',
						 esc_html__( 'Center', 'halena') => 'center',
						 esc_html__( 'Bottom', 'halena' ) => 'flex-end',
					),
					'description' => esc_html__( 'Select the Vertical Alignment of the content.', 'halena' ),
					'std' => 'center',
				),

				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Content Placement', 'halena' ),
					'param_name' => 'placement',
					'value' => array(   
						 esc_html__( 'Inner', 'halena') => 'inner',
						 esc_html__( 'Middle', 'halena') => 'middle',
						 esc_html__( 'Outer', 'halena' ) => 'outer',
					),
					'description' => esc_html__( 'choose your desired offset for the content.', 'halena' ),
					'std' => 'inner',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Text Alignment', 'halena' ),
					'param_name' => 'text_alignment',
					'value' => array(   
						 esc_html__( 'Left', 'halena') => 'left',
						 esc_html__( 'Center', 'halena') => 'center',
						 esc_html__( 'Right', 'halena' ) => 'right',
					),
					'description' => esc_html__( 'Select your desired text Alignment of the content.', 'halena' ),
					'std' => 'center',
				),

				$animation_atts,
				$animation_style_atts, 
				$animation_duration_atts,
				$animation_delay_atts,
				$animation_offset_atts,

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra class name', 'halena' ),
					'param_name' => 'class',
					'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'halena' ),
				),
			)
		) );

		if( class_exists( 'WooCommerce' ) && class_exists( 'AgniHalenaPlugin') ){
			$agniblock_options = agni_posttype_options( array( 'post_type' => 'agni_block'), false, true );

			// Product Hotspot
			vc_map( array(
				'name' => esc_html__( 'Look (Hotspot) pin', 'halena' ),
				'base' => 'agni_hotspot',
				'icon' => 'ion-ios-camera-outline',
				'weight' => '81',
				'category' => esc_html__( 'Content', 'halena' ),
				'description' => esc_html__( 'Choose whether to use Simple image or Before/After Image.', 'halena' ),
				'params' => array(

					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Look Title', 'halena' ),
						'param_name' => 'look_title',
						'description' => esc_html__( 'Enter your desired title for this look.', 'halena' ),
						'std' => 'Look title'
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Look Description', 'halena' ),
						'param_name' => 'look_desc',
						'description' => esc_html__( 'Enter your desired description for this look.', 'halena' ),
						'std' => ''
					),

					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Look Style', 'halena' ),
						'param_name' => 'look_style',
						'value' => array(   
							 esc_html__( 'Style 1', 'halena') => '1',
							 esc_html__( 'Style 2', 'halena') => '2',
						),
						'description' => esc_html__( 'Choose your desired lookbook style.', 'halena' ),
						'std' => '1'
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Solid BG color', 'halena' ),
						'param_name' => 'look_bg_color',
						'description' => esc_html__( 'Choose your desired background color for this style', 'halena' ),
						'std' => '',
					),
					array(
						'type' => 'attach_image',
						'heading' => esc_html__( 'Choose Image', 'halena' ),
						'param_name' => 'img_url',
						'description' => esc_html__( 'Choose your desired background image, to display behind the content.', 'halena' ),
						'std' => '',
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Image size', 'halena' ),
						'param_name' => 'img_size',
						'description' => esc_html__( 'choose image size', 'halena' ),
						'value' => array(   
							 esc_html__( 'Full', 'halena') => 'full',
							 esc_html__( 'Custom', 'halena') => 'custom',
						),
						'dependency' => array( 'element' => 'img_url', 'not_empty' => true ),
						'std' => 'full'
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Custom Image Size', 'halena' ),
						'param_name' => 'img_size_custom',
						'description' => esc_html__( 'It will hard crop image to the mentioned dimensions.', 'halena' ),
						'dependency' => array( 'element' => 'img_size', 'value' => 'custom' ),
						'std' => '640x640'
					),
					
					array(
						'type' => 'param_group',
						'heading' => esc_html__( 'Values', 'halena' ),
						'param_name' => 'values',
						'value' => urlencode( json_encode( array(
							array(
								'pin_coordinates' => '',
								'pin_skin' => '',
								'pin_content' => 'product',
								'product_id' => '',
								'product_thumbnail' => '1', 
								'product_title' => '1', 
								'product_price' => '1', 
								'product_description' => '', 
								'product_button' => '1',
								'agni_block_post_id' => '',
								'pin_content_position' => 'right',
							),
						) ) ),
						'params' => array(
							
							array(
								'type' => 'textfield',
								'heading' => esc_html__( 'Pin Coordinates', 'halena' ),
								'param_name' => 'pin_coordinates',
								'description' => wp_kses( __( 'Enter your image co-ordinate points left, top without string. for ex. <strong>300, 200</strong> You can find the co-ordinate with help of <a href="https://www.image-map.net or YOUR TUTORIAL LINK" target="_blank">This link</a>.', 'halena' ), array( 'a' => array( 'href' => array(), 'target' => array() ), 'strong' => '' ) ),
								'dependency' => array( 'element' => 'lookbook_style', 'value' => '1' ),
								'std' => ''
							),

							array(
								'type' => 'dropdown',
								'heading' => esc_html__( 'Pin Skin', 'halena' ),
								'param_name' => 'pin_skin',
								'weight' => '1',
								'value' => array(
									 esc_html__( 'Default', 'halena' ) => '',
									 esc_html__( 'Dark Mode', 'halena') => 'has-dark-mode'
									),
								'description' => esc_html__( 'Choose your color skin.', 'halena' ),
								'dependency' => array( 'element' => 'lookbook_style', 'value' => '1' ),
								'std' => '',
							),
							array(
								'type' => 'dropdown',
								'heading' => esc_html__( 'Pin Content Position', 'halena' ),
								'param_name' => 'pin_content_position',
								'weight' => '1',
								'value' => array(
									 esc_html__( 'Right Top', 'halena') => 'right top',
									 esc_html__( 'Left Top', 'halena' ) => 'left top',
									 esc_html__( 'Right Bottom', 'halena') => 'right bottom',
									 esc_html__( 'Left Bottom', 'halena' ) => 'left bottom'
									),
								'description' => esc_html__( 'Choose your desired position.', 'halena' ),
								'dependency' => array( 'element' => 'lookbook_style', 'value' => '1' ),
								'std' => 'right',
							),
							array(
								'type' => 'dropdown',
								'heading' => esc_html__( 'Content', 'halena' ),
								'param_name' => 'pin_content',
								'weight' => '1',
								'value' => array(
									 esc_html__( 'Product', 'halena') => 'product',
									 esc_html__( 'Agni Block', 'halena' ) => 'agni-block'
									),
								'description' => esc_html__( 'Choose your desired position.', 'halena' ),
								'std' => 'product',
							),
							array(
								'type' => 'textfield',
								'heading' => esc_html__( 'Enter your product ID', 'halena' ),
								'param_name' => 'product_id',
								'description' => esc_html__( 'Enter the product ids to display. for ex. 1021', 'halena' ),
								'std' => ''
							),
							array(
								'type' => 'checkbox',
								'heading' => esc_html__( 'Product Thumbnail', 'halena' ),
								'param_name' => 'product_thumbnail',
								'value' => array( esc_html__( 'Enable', 'halena' ) => '1' ),
								'dependency' => array( 'element' => 'product_id', 'not_empty' => true ),
								'edit_field_class' => 'vc_col-sm-4 vc_col-md-4 vc_column',
								'std' => '1',
							),
							array(
								'type' => 'checkbox',
								'heading' => esc_html__( 'Product Title', 'halena' ),
								'param_name' => 'product_title',
								'value' => array( esc_html__( 'Enable', 'halena' ) => '1' ),
								'dependency' => array( 'element' => 'product_id', 'not_empty' => true ),
								'edit_field_class' => 'vc_col-sm-4 vc_col-md-4 vc_column',
								'std' => '1',
							),
							array(
								'type' => 'checkbox',
								'heading' => esc_html__( 'Product Price', 'halena' ),
								'param_name' => 'product_price',
								'value' => array( esc_html__( 'Enable', 'halena' ) => '1' ),
								'dependency' => array( 'element' => 'product_id', 'not_empty' => true ),
								'edit_field_class' => 'vc_col-sm-4 vc_col-md-4 vc_column',
								'std' => '1',
							),
							array(
								'type' => 'checkbox',
								'heading' => esc_html__( 'Product Button', 'halena' ),
								'param_name' => 'product_button',
								'value' => array( esc_html__( 'Enable', 'halena' ) => '1' ),
								'dependency' => array( 'element' => 'product_id', 'not_empty' => true ),
								'edit_field_class' => 'vc_col-sm-4 vc_col-md-4 vc_column',
								'std' => '1',
							),


						),
					),

					$animation_atts,
					$animation_style_atts, 
					$animation_duration_atts,
					$animation_delay_atts,
					$animation_offset_atts,

					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Extra class name', 'halena' ),
						'param_name' => 'class',
						'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'halena' ),
					),
				)
			) );
			vc_add_params( "agni_hotspot", $elements_carousel_atts );
		}
		
		// Video
		vc_map( array(
			'name' => esc_html__( 'Video', 'halena' ),
			'base' => 'agni_video',
			'icon' => 'ion-ios-play-outline',
			'weight' => '79',
			'category' => esc_html__( 'Media', 'halena' ),
			'description' => esc_html__( 'Youtube, Vimeo, etc.. any embedded video', 'halena' ),
			'params' => array(
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Choose Video Type', 'halena' ),
					'param_name' => 'video_type',
					'value' => array(   
						 esc_html__( 'Youtube Video', 'halena') => '1',
						 esc_html__( 'Self Hosted Video', 'halena') => '2',
						 esc_html__( 'Lightbox Video', 'halena') => '3',
						 esc_html__( 'Embed Video', 'halena') => '4',
					),
					'description' => esc_html__( 'if you want ordinary youtube or vimeo video container. then choose Default. ', 'halena' ),
					'std' => '1'
				),
				
				array(
					'type' => 'href',
					'heading' => esc_html__( 'URL', 'halena' ),
					'param_name' => 'url',
					'description' => esc_html__( 'Youtube URL of the Video', 'halena' ),
					'dependency' => array( 'element' => 'video_type', 'value' => '1' ),
					'std' => ''
				),
				array(
					'type' => 'attach_image',
					'heading' => esc_html__( 'Fallback Image', 'halena' ),
					'param_name' => 'fallback',
					'description' => esc_html__( 'This player will not work on mobile device. so you set the fallback image here', 'halena' ),
					'dependency' => array( 'element' => 'video_type', 'value' => '1' ),
					'std' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Overlay Opacity', 'halena' ),
					'param_name' => 'overlay_opacity',
					'description' => esc_html__( 'Set your opacity amount range from 0 to 1', 'halena' ),
					'dependency' => array( 'element' => 'video_type', 'value' => '1' ),
					'std' => '0.6'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Video Height', 'halena' ),
					'param_name' => 'youtube_height',
					'description' => esc_html__( 'height of video container!.. for eg.450', 'halena' ),
					'dependency' => array( 'element' => 'video_type', 'value' => '1' ),
					'std' => '360'
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'YT video on Mobile', 'halena' ),
					'param_name' => 'mobile',
					'description' => esc_html__( 'show youtube video on mobile devices.', 'halena' ),
					'value' => array( esc_html__( 'Yes', 'halena' ) => 'true' ),
					'dependency' => array( 'element' => 'video_type', 'value' => '1' ),
					'std' => ''
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Auto Play', 'halena' ),
					'param_name' => 'auto_play',
					'description' => esc_html__( 'video starts automatically..', 'halena' ),
					'value' => array( esc_html__( 'Yes', 'halena' ) => 'true' ),
					'dependency' => array( 'element' => 'video_type', 'value' => '1' ),
					'std' => 'true'
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Loop', 'halena' ),
					'param_name' => 'loop',
					'description' => esc_html__( 'It repeat the video once completed!.', 'halena' ),
					'value' => array( esc_html__( 'Yes', 'halena' ) => 'true' ),
					'dependency' => array( 'element' => 'video_type', 'value' => '1' ),
					'std' => 'true'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Volume level', 'halena' ),
					'param_name' => 'vol',
					'description' => esc_html__( 'Set a default volume level of the video..for eg. 50', 'halena' ),
					'dependency' => array( 'element' => 'video_type', 'value' => '1' ),
					'std' => '50'
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Mute', 'halena' ),
					'param_name' => 'mute',
					'description' => esc_html__( 'Muted video', 'halena' ),
					'value' => array( esc_html__( 'Yes', 'halena' ) => 'true' ),
					'dependency' => array( 'element' => 'video_type', 'value' => '1' ),
					'std' => 'true'
				),
				
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Start at', 'halena' ),
					'param_name' => 'start_at',
					'description' => esc_html__( 'Starting from N second.. for eg. 20 ', 'halena' ),
					'dependency' => array( 'element' => 'video_type', 'value' => '1' ),
					'std' => '0'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Stop at', 'halena' ),
					'param_name' => 'stop_at',
					'description' => esc_html__( 'Starting from N second.. for eg. 30 ', 'halena' ),
					'dependency' => array( 'element' => 'video_type', 'value' => '1' ),
					'std' => '30'
				),
				
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Choose the quality', 'halena' ),
					'param_name' => 'quality',
					'value' => array(   
						 esc_html__( 'Default(small)', 'halena') => 'default',
						 esc_html__( 'Medium', 'halena') => 'medium',
						 esc_html__( 'Large', 'halena') => 'large',
						 esc_html__( '720p', 'halena' ) => 'hd720',
						 esc_html__( '1080p', 'halena' ) => 'hd1080',
						 esc_html__( 'High', 'halena' ) => 'highres',
					),
					'description' => esc_html__( 'Choose the releavant resolution quality!!.. ', 'halena' ),
					'dependency' => array( 'element' => 'video_type', 'value' => '1' ),
					'std' => 'default'
				),
				array(
					'type' => 'href',
					'heading' => esc_html__( 'Video URL', 'halena' ),
					'param_name' => 'self_url',
					'description' => esc_html__( 'To find media url go to "Media" menu at left side panel and click on your(desire) media file. now you can find url at right side panel. copy/paste the url here', 'halena' ),
					'dependency' => array( 'element' => 'video_type', 'value' => '2' ),
					'std' => ''
				),
				array(
					'type' => 'attach_image',
					'heading' => esc_html__( 'Poster Image', 'halena' ),
					'param_name' => 'self_poster',
					'description' => esc_html__( 'This poster will be shown before video get started.', 'halena' ),
					'dependency' => array( 'element' => 'video_type', 'value' => '2' ),
					'std' => ''
				),

				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Choose the player', 'halena' ),
					'param_name' => 'self_player',
					'value' => array(   
						 esc_html__( 'Default(HTML 5 player)', 'halena') => '1',
						 esc_html__( 'WordPress player', 'halena') => '2',
					),
					'description' => esc_html__( 'Choose the style which you would like to have. ', 'halena' ),
					'dependency' => array( 'element' => 'video_type', 'value' => '2' ),
					'std' => '1'
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Auto Play', 'halena' ),
					'param_name' => 'self_auto_play',
					'description' => esc_html__( 'video starts automatically..', 'halena' ),
					'value' => array( esc_html__( 'Yes', 'halena' ) => 'on' ),
					'dependency' => array( 'element' => 'video_type', 'value' => '2' ),
					'std' => 'on'
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Loop', 'halena' ),
					'param_name' => 'self_loop',
					'description' => esc_html__( 'It repeat the video once completed!.', 'halena' ),
					'value' => array( esc_html__( 'Yes', 'halena' ) => 'on' ),
					'dependency' => array( 'element' => 'video_type', 'value' => '2' ),
					'std' => 'on'
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Mute', 'halena' ),
					'param_name' => 'self_mute',
					'description' => esc_html__( 'it will Mute the video(volume 0)', 'halena' ),
					'value' => array( esc_html__( 'Yes', 'halena' ) => 'on' ),
					'dependency' => array( 'element' => 'self_player', 'value' => '1' ),
					'std' => 'on'
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Preload', 'halena' ),
					'param_name' => 'self_preload',
					'value' => array(   
						 esc_html__( 'metadata', 'halena') => 'metadata',
						 esc_html__( 'none', 'halena') => 'none',
						 esc_html__( 'auto', 'halena') => 'auto',
					),
					'dependency' => array( 'element' => 'self_player', 'value' => '2' ),
					'std' => 'metadata'
				),

				array(
					'type' => 'textarea_safe',
					'heading' => esc_html__( 'Video embed iframe', 'halena' ),
					'param_name' => 'embed',
					'description' => esc_html__('Your embeded URL to display a video. all video source supported', 'halena'),
					'dependency' => array( 'element' => 'video_type', 'value' => array( '3', '4' ) )
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Link Style to open Lightbox', 'halena' ),
					'param_name' => 'iframe_style',
					'value' => array(   
						 esc_html__( 'Button', 'halena') => '1',
						 esc_html__( 'Icon', 'halena') => '2',
					),
					'dependency' => array( 'element' => 'video_type', 'value' => '3' ),
					'std' => '1'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Button Value', 'halena' ),
					'class' => 'wpb_button',
					'param_name' => 'button_value',
					'description' => esc_html__( 'Value for the button!!..', 'halena' ),
					'dependency' => array( 'element' => 'iframe_style', 'value' => '1' ),
					'std' => 'Button'
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Choose Icon', 'halena' ),
					'param_name' => 'icon',
					'settings' => array(
						'type' => 'iconlist',
						'iconsPerPage' => 545,
					),
					'description' => wp_kses( __( '<small>Select the icon which you want <strong><a href="http://ionicons.com/">Ionicons</a>, <a href="http://fortawesome.github.io/Font-Awesome/icons/">FontAwesome</a>, <a href="http://themes-pixeden.com/font-demos/7-stroke/index.html">Pe Icon 7 Stroke</a>, <a href="http://themes-pixeden.com/font-demos/7-filled/index.html">Pe Icon 7 Filled</a> supported.</strong></small>', 'halena' ), array( 'small' => array(), 'strong' => array(), 'a' => array( 'href' => array() ) ) ),
					'dependency' => array( 'element' => 'video_type', 'value' => '3' ),
					'std' => ''
				),
				
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'button style', 'halena' ),
					'param_name' => 'button_style',
					'value' => array(   
						 esc_html__( 'Background(Default)', 'halena') => '',
						 esc_html__( 'Bordered', 'halena') => 'alt'
					),
					'description' => esc_html__( 'Select the button style...', 'halena' ),
					'dependency' => array( 'element' => 'iframe_style', 'value' => '1' ),
					'std' => ''
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Radius', 'halena' ),
					'param_name' => 'button_radius',
					'description' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels.', 'halena' ),
					'dependency' => array( 'element' => 'iframe_style', 'value' => '1' ),
				),
				
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Choose button type', 'halena' ),
					'param_name' => 'button_choice',
					'value' => array(   
						 esc_html__( 'Default', 'halena') => 'default',
						 esc_html__( 'Primary', 'halena') => 'primary',
						 esc_html__( 'Accent', 'halena') => 'accent',
						 esc_html__( 'White', 'halena') => 'white'
					),
					'description' => esc_html__( 'Select the button type...', 'halena' ),
					'dependency' => array( 'element' => 'iframe_style', 'value' => '1' ),
					'std' => 'default'
				),
				
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Choose the size of button', 'halena' ),
					'param_name' => 'button_size',
					'value' => array(   
						 esc_html__( 'Default', 'halena') => '',
						 esc_html__( 'Large', 'halena') => 'lg',
						 esc_html__( 'Small', 'halena' ) => 'sm',
						 esc_html__( 'Extra Small', 'halena' ) => 'xs',
						 esc_html__( 'Block', 'halena' ) => 'block',
					),
					'description' => esc_html__( 'Select the size of the button..', 'halena' ),
					'dependency' => array( 'element' => 'iframe_style', 'value' => '1' ),
					'std' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Button Alignment', 'halena' ),
					'param_name' => 'button_alignment',
					'value' => array(   
						 esc_html__( 'Left', 'halena') => 'left',
						 esc_html__( 'Center', 'halena') => 'center',
						 esc_html__( 'Right', 'halena' ) => 'right',
					),
					'description' => esc_html__( 'Select the Alignment of the button..', 'halena' ),
					'dependency' => array( 'element' => 'iframe_style', 'value' => '1' ),
					'std' => 'left',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Size', 'halena' ),
					'param_name' => 'size',
					'description' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels. for ex.24', 'halena' ),
					'dependency' => array( 'element' => 'iframe_style', 'value' => '2' ),
					'std' => '32',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Icon style', 'halena' ),
					'param_name' => 'icon_style',
					'value' => array(
						 esc_html__( 'Default', 'halena' ) => '',
						 esc_html__( 'Background', 'halena' ) => 'background',
						 esc_html__( 'Bordered', 'halena' ) => 'border',
						),
					'description' => esc_html__( 'Select how the heading will be aligned', 'halena' ),
					'dependency' => array( 'element' => 'iframe_style', 'value' => '2' ),
					'std' => '',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Width', 'halena' ),
					'param_name' => 'width',
					'description' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels.', 'halena' ),
					'dependency' => array( 'element' => 'icon_style', 'value' => array( 'border', 'background' ) ),
					'std' => '72',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Height', 'halena' ),
					'param_name' => 'height',
					'description' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels.', 'halena' ),
					'dependency' => array( 'element' => 'icon_style', 'value' => array( 'border', 'background' ) ),
					'std' => '72',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Radius', 'halena' ),
					'param_name' => 'radius',
					'description' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels.', 'halena' ),
					'dependency' => array( 'element' => 'icon_style', 'value' => array( 'border', 'background' ) ),
					'std' => '50%',
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Background Color', 'halena' ),
					'param_name' => 'background_color',
					'description' => esc_html__('choose the dropdown background color.', 'halena' ),
					'dependency' => array( 'element' => 'icon_style', 'value' => 'background' ),
					'std' => '#f0f1f2',
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Border Color', 'halena' ),
					'param_name' => 'border_color',
					'description' => esc_html__('choose the dropdown border color.', 'halena' ),
					'dependency' => array( 'element' => 'icon_style', 'value' => 'border' ),
					'std' => '#000000',
				),

				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Icon Color', 'halena' ),
					'param_name' => 'color',
					'description' => esc_html__('This will apply if the heading has divide line.', 'halena' ),
					'dependency' => array( 'element' => 'iframe_style', 'value' => '2' ),
					'std' => '#000000',
				),
				
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Icon style on hover', 'halena' ),
					'param_name' => 'hover_icon_style',
					'value' => array(
						 esc_html__( 'Default', 'halena' ) => '',
						 esc_html__( 'Background', 'halena' ) => 'background',
						 esc_html__( 'Bordered', 'halena' ) => 'border',
						),
					'description' => esc_html__( 'Select how the heading will be aligned', 'halena' ),
					'dependency' => array( 'element' => 'icon_style', 'value' => array( 'border', 'background' ) ),
					'std' => '',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Radius on hover', 'halena' ),
					'param_name' => 'hover_radius',
					'description' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels.', 'halena' ),
					'dependency' => array( 'element' => 'hover_icon_style', 'value' => array( 'border', 'background' ) ),
					'std' => '50%',
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Background Color on hover', 'halena' ),
					'param_name' => 'hover_background_color',
					'description' => esc_html__('choose the dropdown background color.', 'halena' ),
					'dependency' => array( 'element' => 'hover_icon_style', 'value' => 'background' ),
					'std' => '#1e1e20',
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Border Color on hover', 'halena' ),
					'param_name' => 'hover_border_color',
					'description' => esc_html__('choose the dropdown border color.', 'halena' ),
					'dependency' => array( 'element' => 'hover_icon_style', 'value' => 'border' ),
					'std' => '#000000',
				),

				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Icon Color on hover', 'halena' ),
					'param_name' => 'hover_color',
					'description' => esc_html__('This will apply if the heading has divide line!!..', 'halena' ),
					'dependency' => array( 'element' => 'iframe_style', 'value' => '2' ),
					'std' => '#ffffff',
				),
				
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra class name', 'halena' ),
					'param_name' => 'class',
					'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'halena' ),
				),
			)
		
		));
		
		// Gmap
		vc_map( array(
			'name' => esc_html__( 'Gmap', 'halena' ),
			'base' => 'agni_gmap',
			'icon' => 'ion-ios-location-outline',
			'weight' => '78',
			'category' => esc_html__( 'Graphic', 'halena' ),
			'description' => esc_html__( 'Google Map', 'halena' ),
			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Height', 'halena' ),
					'param_name' => 'height',
					'description' => esc_html__( 'Enter your desired map Height. You can use px, vh, etc. or enter just number and it will use pixels. IMPORTANT: Make sure that you\'ve added the API Key at "Halena/Theme Options/Home Settings/Additional" ', 'halena' ),
					'std' => '400',
					'edit_field_class' => 'vc_col-sm-12 vc_col-md-12 vc_column',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Height - Tab', 'halena' ),
					'param_name' => 'height_tab',
					'std' => '',
					'edit_field_class' => 'vc_col-sm-6 vc_col-xs-6 vc_column',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Height - Mobile', 'halena' ),
					'param_name' => 'height_mobile',
					'std' => '',
					'edit_field_class' => 'vc_col-sm-6 vc_col-xs-6 vc_column',
				),
				array(
					'type' => 'param_group',
					'heading' => esc_html__( 'Values', 'halena' ),
					'param_name' => 'values',
					'value' => urlencode( json_encode( array(
						array(
							'google_map_location' => esc_html__( 'Envato Head Office', 'halena' ),
							'google_map_lat' => '10.010509',
							'google_map_lng' => '77.487774',
							'google_address_1' => '',
						),
					) ) ),
					'params' => array(
						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Google Map Location', 'halena' ),
							'param_name' => 'google_map_location',
							'description' => esc_html__( 'enter the name of your location.', 'halena' ),
							'std' => 'Envato Head Office',
							'admin_label' => true,
						),
						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Google Map Latitude', 'halena' ),
							'param_name' => 'google_map_lat',
							'description' => esc_html__( 'enter your latitude value for ex. 10.010509 ', 'halena' ),
							'std' => '10.010509',
						),
						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Google Map Longitude', 'halena' ),
							'param_name' => 'google_map_lng',
							'std' => '77.487774',
						),
						array(
							'type' => 'textarea',
							'heading' => esc_html__( 'Address Line', 'halena' ),
							'param_name' => 'google_address_1',
						),
					),
				),

				array(
					'type' => 'attach_image',
					'heading' => esc_html__( 'Map Marker', 'halena' ),
					'param_name' => 'google_map_icon',
					'value' => '',
					'description' => esc_html__( 'Select image from media library. icon size should be 40x62', 'halena' ),
					'std' => ''
				),

				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Choose Zoom level', 'halena' ),
					'param_name' => 'zoom',
					'value' => array(	
						 esc_html__( '1', 'halena') => '1',
						 esc_html__( '3', 'halena') => '3',
						 esc_html__( '5', 'halena') => '5',
						 esc_html__( '7', 'halena') => '7',
						 esc_html__( '9', 'halena') => '9',
						 esc_html__( '11', 'halena') => '11',
						 esc_html__( '12', 'halena') => '12',
						 esc_html__( '13', 'halena') => '13',
						 esc_html__( '14', 'halena') => '14',
						 esc_html__( '15', 'halena') => '15',
						 esc_html__( '16', 'halena') => '16',
						 esc_html__( '17', 'halena') => '17',
						 esc_html__( '18', 'halena') => '18',
						 esc_html__( '19', 'halena') => '19',
						 esc_html__( '20', 'halena') => '20',
					),
					'std' => '16'
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Choose Map Style', 'halena' ),
					'param_name' => 'style',
					'value' => array(	
						 esc_html__( 'Style 1', 'halena') => '1',
						 esc_html__( 'Style 2', 'halena') => '2',
						 esc_html__( 'Style 3', 'halena') => '3',
						 esc_html__( 'Style 4', 'halena') => '4',
					),
					'std' => '1'
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Map Accent Color', 'halena' ),
					'param_name' => 'color',
					'description' => esc_html__('choose the color for water in the map.', 'halena' ),
					'dependency' => array( 'element' => 'style', 'value' => '3' ),
					'std' => '#1e1e20',
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Disable Dragging in Mobile', 'halena' ),
					'param_name' => 'drag',
					'description' => esc_html__( 'it will disable the dragging at mobile devices', 'halena' ),
					'value' => array( esc_html__( 'Yes', 'halena' ) => '1' ),
					'std' => '1'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'ID', 'halena' ),
					'param_name' => 'id',
					'description' => esc_html__( 'ID is mandatory to show more than one map.', 'halena' ),
					'std' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra Class', 'halena' ),
					'param_name' => 'class',
					'description' => esc_html__( 'extra class for the element.', 'halena' ),
					'std' => ''
				),
			)
		
		));

		// Countdown
		vc_map( array(
			'name' => esc_html__( 'Countdown', 'halena' ),
			'base' => 'agni_countdown',
			'icon' => 'ion-ios-timer-outline',
			'weight' => '77',
			'category' => esc_html__( 'Graphic', 'halena' ),
			'description' => esc_html__( 'counter for Comingsoon/any page.', 'halena' ),
			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Date', 'halena' ),
					'param_name' => 'date',
					'description' => esc_html__( 'you can type your deadline. for ex. 20 January 2016 10:45:00', 'halena' ),
					'std' => '20 January 2016 10:45:00'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Label', 'halena' ),
					'param_name' => 'label',
					'description' => esc_html__( 'you can type your label format.', 'halena' ),
					'std' => 'Day|Days|Hour|Hours|Minute|Minutes|Second|Seconds'
				),
				array(
                    'type' => 'dropdown',
                    'heading' => esc_html__('Countdown Style', 'halena'),
                    'param_name' => 'countdown-style',
                    'value' => array(   
                        esc_html__( 'Default', 'halena') => '',
                        esc_html__( 'Background', 'halena') => 'background',
                        esc_html__( 'Border', 'halena') => 'border',
                    ),
                    'description' => esc_html__( 'Choose content style for the layout.', 'halena' ),
                    'std' => ''
                ),
                array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Background color', 'halena' ),
					'param_name' => 'countdown-bg-color',
                    'dependency' => array( 'element' => 'countdown-style', 'value' => 'background' ),
					'std' => ''
				),
                array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Border color', 'halena' ),
					'param_name' => 'countdown-border-color',
                    'dependency' => array( 'element' => 'countdown-style', 'value' => 'border' ),
					'std' => ''
				),
                array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Countdown Color', 'halena' ),
					'param_name' => 'countdown-color',
					'std' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra class name', 'halena' ),
					'param_name' => 'class',
					'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'halena' ),
				),
			)
		
		));
		
		$custom_menus = array();
		if ( 'vc_edit_form' === vc_post_param( 'action' ) && vc_verify_admin_nonce() ) {
			$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
			if ( is_array( $menus ) && ! empty( $menus ) ) {
				foreach ( $menus as $single_menu ) {
					if ( is_object( $single_menu ) && isset( $single_menu->name, $single_menu->term_id ) ) {
						$custom_menus[ $single_menu->name ] = $single_menu->term_id;
					}
				}
			}
		}
		// Menu
		vc_map( array(
			'name' => esc_html__( 'Navigation Menu', 'halena' ),
			'base' => 'agni_menu',
			'icon' => 'ion-ios-drag',
			'weight' => '75',
			'category' => esc_html__( 'Content', 'halena' ),
			'description' => esc_html__( 'Place Menus which you have created at Appearance/Menus', 'halena' ),
			'params' => array(
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Menu', 'halena' ),
					'param_name' => 'nav_menu',
					'value' => $custom_menus,
					'description' => empty( $custom_menus ) ? esc_html__( 'Custom menus not found. Please visit Appearance > Menus page to create new menu.', 'halena' ) : esc_html__( 'Select menu to display.', 'halena' ),
					'save_always' => true,
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Fullwidth Menu', 'halena' ),
					'param_name' => 'fullwidth',
					'weight' => '1',
					'value' => array(
						esc_html__( 'Default(container)', 'halena' ) => '',
						esc_html__( 'Fullwidth Menu', 'halena' ) => '-fluid',
					),
					'description' => esc_html__( 'choose any one to display the content on this paricular row. This option affect only the content not the background.', 'halena' ),
					'std' => '',
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Background Color', 'halena' ),
					'param_name' => 'bg_color',
					'description' => esc_html__('choose the color for background.', 'halena' ),
					'std' => '#1e1e20',
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Text Color', 'halena' ),
					'param_name' => 'color',
					'description' => esc_html__('choose the color for text.', 'halena' ),
					'std' => '#fff',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra class name', 'halena' ),
					'param_name' => 'class',
					'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'halena' ),
				),
			)
		) );

		if(class_exists( 'AgniHalenaPlugin')){
			// Agnislider
			$agnislider_options = agni_posttype_options( array( 'post_type' => 'agni_slides'), false, true );
			$agniblock_options = agni_posttype_options( array( 'post_type' => 'agni_block'), false, true );
 
			$blog_options = $portfolio_options = array();

			
			// Posts & Portfolio
			$blog_categories = get_categories();
			foreach ($blog_categories as $category) {
				$blog_options[$category->name] = $category->term_id;
			}
			
			$portfolio_categories = get_terms('types');     
			foreach ($portfolio_categories as $category) {
				$portfolio_options[$category->name] = $category->term_id;
			}

			if( !empty($agnislider_options) ){
				vc_map( array(
					'name' => esc_html__( 'Agni Slider', 'halena' ),
					'base' => 'agni_agnislider',
					'icon' => 'ion-ios-monitor-outline',
					'weight' => '73',
					'category' => esc_html__( 'Media', 'halena' ),
					'description' => esc_html__( 'Display slider which you have created at Agni Slider Menu', 'halena' ),
					'params' => array(
						array(
							'type' => 'dropdown',
							'heading' => esc_html__( 'Choose Slider', 'halena' ),
							'param_name' => 'post_id',
							'description' => esc_html__( 'Note. It will ignore the parallax settings of the slider, if any.', 'halena' ),
							'value' => $agnislider_options,
							'admin_label' => true,
							'std' => ''
						),
					)
				));
			}

			vc_map( array(
				'name' => esc_html__( 'Agni Blocks', 'halena' ),
				'base' => 'agni_block',
				'icon' => 'ion-ios-monitor-outline',
				'weight' => '72',
				'category' => esc_html__( 'Content', 'halena' ),
				'description' => esc_html__( 'Display block content which you have created at Block Menu', 'halena' ),
				'params' => array(
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Choose Block', 'halena' ),
						'param_name' => 'post_id',
						'description' => esc_html__( 'choose your desired content which you created at "Blocks".', 'halena' ),
						'value' => $agniblock_options,
						'admin_label' => true,
						'std' => ''
					),
				)
			));


			vc_map( array(
				'name' => esc_html__( 'Team', 'halena' ),
				'base' => 'agni_team',
				'icon' => 'ion-ios-people-outline',
				'weight' => '70',
				'category' => esc_html__( 'Carousel', 'halena' ),
				'description' => esc_html__( 'display team by getting the team member post type', 'halena' ),
				'params' => array(

					array(
						'type' => 'param_group',
						'heading' => esc_html__( 'Values', 'halena' ),
						'param_name' => 'values',
						'value' => urlencode( json_encode( array(
							array(
								'member_img_id' => '',
								'member_name' => '',
								'member_name_link' => '',
								'member_designation' => '',
								'member_description' => '',
								'member_facebook_link' => '',
								'member_twitter_link' => '',
								'member_google_plus_link' => '',
								'member_vk_link' => '',
								'member_behance_link' => '',
								'member_pinterest_link' => '',
								'member_dribbble_link' => '',
								'member_skype_link' => '',
								'member_linkedin_link' => '',
								'member_envelope_link' => '',
								'member_number' => '',
							),
						) ) ),
						'params' => array(
							array(
								'type' => 'attach_image',
								'heading' => esc_html__( 'Upload Member Image', 'halena' ),
								'param_name' => 'member_img_id',
								'value' => '',
								'description' => esc_html__( 'Select image from media library.', 'halena' ),
							),
							array(
								'type' => 'textfield',
								'heading' => esc_html__( 'Member Name', 'halena' ),
								'param_name' => 'member_name',
								'std' => '',
							),
							array(
								'type' => 'textfield',
								'heading' => esc_html__( 'Member Name Link', 'halena' ),
								'param_name' => 'member_name_link',
								'std' => '',
							),
							
							array(
								'type' => 'textfield',
								'heading' => esc_html__( 'Member Designation', 'halena' ),
								'param_name' => 'member_designation',
								'std' => '',
							),
							array(
								'type' => 'textarea',
								'heading' => esc_html__( 'Member Description', 'halena' ),
								'param_name' => 'member_description',
								'std' => '',
							),
							array(
								'type'  => 'textfield',
								'heading' => esc_html__( 'Facebook', 'halena' ),
								'param_name' => 'member_facebook_link',
								'std' => '',
							),
							
							array(
								'type'  => 'textfield',
								'heading' => esc_html__( 'Twitter', 'halena' ),
								'param_name' => 'member_twitter_link',
								'std' => '',
							),
							
							array(
								'type'  => 'textfield',
								'heading' => esc_html__( 'Google Plus', 'halena' ),
								'param_name' => 'member_google_plus_link',
								'std' => '',
							),
							array(
								'type'  => 'textfield',
								'heading' => esc_html__( 'VK', 'halena' ),
								'param_name' => 'member_vk_link',
								'std' => '',
							),
							array(
								'type'  => 'textfield',
								'heading' => esc_html__( 'Behance', 'halena' ),
								'param_name' => 'member_behance_link',
								'std' => '',
							),
							array(
								'type'  => 'textfield',
								'heading' => esc_html__( 'Pinterest', 'halena' ),
								'param_name' => 'member_pinterest_link',
								'std' => '',
							),
							array(
								'type'  => 'textfield',
								'heading' => esc_html__( 'Dribbble', 'halena' ),
								'param_name' => 'member_dribbble_link',
								'std' => '',
							),
							array(
								'type'  => 'textfield',
								'heading' => esc_html__( 'Skype', 'halena' ),
								'param_name' => 'member_skype_link',
								'std' => '',
							),
							array(
								'type'  => 'textfield',
								'heading' => esc_html__( 'Linkedin', 'halena' ),
								'param_name' => 'member_linkedin_link',
								'std' => '',
							),
							array(
								'type'  => 'textfield',
								'heading' => esc_html__( 'Email', 'halena' ),
								'param_name' => 'member_envelope_link',
								'std' => '',
							),
							array(
								'type'  => 'textfield',
								'heading' => esc_html__( 'Phone/Mobile Number', 'halena' ),
								'param_name' => 'member_number',
								'std' => '',
							),
						),
					),

					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Number of Columns', 'halena' ),
						'param_name' => 'columns',
						'value' => array(   
							 esc_html__( '1 column', 'halena') => '1',
							 esc_html__( '2 columns', 'halena') => '2',
							 esc_html__( '3 columns', 'halena') => '3',
							 esc_html__( '4 columns', 'halena' ) => '4',
							 esc_html__( '5 columns', 'halena' ) => '5'
						),
						'description' => esc_html__( 'Choose the column on desktop screen. it will adjust the columns count on responsive screens automatically.', 'halena' ),
						'std' => '3'
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Gutter(Gap)', 'halena' ),
						'param_name' => 'team_gutter',
						'description' => esc_html__( 'It will allow you to adjust the space in between each team members.', 'halena' ),
						'std' => '30',
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Style', 'halena' ),
						'param_name' => 'team_style',
						'value' => array(   
							 esc_html__( 'Style 1', 'halena') => '1',
							 esc_html__( 'Style 2', 'halena') => '2',
						),
						'description' => esc_html__( 'Various Team display style.', 'halena' ),
						'std' => '1'
					),

					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Hover BG Color', 'halena' ),
						'param_name' => 'member_thumbnail_hover_bg_color',
						'description' => esc_html__('choose the background color for member thumbnail.', 'halena' ),
						'dependency' => array( 'element' => 'team_style', 'value' => array('1','4') ),
						'std' => '',
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Hover Text Color', 'halena' ),
						'param_name' => 'member_thumbnail_hover_color',
						'description' => esc_html__('choose the color for member thumbnail.', 'halena' ),
						'dependency' => array( 'element' => 'team_style', 'value' => array('1','4') ),
						'std' => '',
					),
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Thumbnail Hard Crop', 'halena' ),
						'param_name' => 'member_thumbnail_hardcrop',
						'value' => array( esc_html__( 'Yes', 'halena' ) => '1' ),
						'std'  => '',
					), 
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Custom Dimension', 'halena' ),
						'param_name' => 'member_thumbnail_custom',
						'description' => esc_html__( 'Just enter your desired dimension to crop. for ex. 640x640', 'halena' ),
						'dependency' => array( 'element' => 'member_thumbnail_hardcrop', 'value' => '1' ),
						'std' => '640x640',
					),
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Thumbnail Grayscale Filter', 'halena' ),
						'description' => esc_html__( 'It will change the thumbnail to grayscale(black&white). but it will not work on IE browsers.', 'halena' ),
						'param_name' => 'member_thumbnail_gs_filter',
						'value' => array( esc_html__( 'Yes', 'halena' ) => '1' ),
						'std'  => '',
					), 

					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Circle Thumbnail', 'halena' ),
						'param_name' => 'circle_avatar',
						'value' => array( esc_html__( 'Yes', 'halena' ) => '1' ),
						'std'  => '',
					), 

					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Hover - Name', 'halena' ),
						'param_name' => 'member_show_hover_name',
						'value' => array( esc_html__( 'Yes', 'halena' ) => '1' ),
						'std'  => '',
						'edit_field_class' => 'vc_col-xs-4 vc_col-sm-3 vc_column',
					), 
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Hover - Designation', 'halena' ),
						'param_name' => 'member_show_hover_designation',
						'value' => array( esc_html__( 'Yes', 'halena' ) => '1' ),
						'std'  => '',
						'edit_field_class' => 'vc_col-xs-4 vc_col-sm-3 vc_column',
					), 
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Hover - Description', 'halena' ),
						'param_name' => 'member_show_hover_description',
						'value' => array( esc_html__( 'Yes', 'halena' ) => '1' ),
						'std'  => '',
						'edit_field_class' => 'vc_col-xs-4 vc_col-sm-3 vc_column',
					), 
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Hover - Social Icons', 'halena' ),
						'param_name' => 'member_show_hover_social_icons',
						'value' => array( esc_html__( 'Yes', 'halena' ) => '1' ),
						'std'  => '',
						'edit_field_class' => 'vc_col-xs-4 vc_col-sm-3',
					), 
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Bottom - Name', 'halena' ),
						'param_name' => 'member_show_bottom_name',
						'value' => array( esc_html__( 'Yes', 'halena' ) => '1' ),
						'std'  => '1',
						'edit_field_class' => 'vc_col-xs-4 vc_col-sm-3 vc_column',
					), 
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Bottom - Designation', 'halena' ),
						'param_name' => 'member_show_bottom_designation',
						'value' => array( esc_html__( 'Yes', 'halena' ) => '1' ),
						'std'  => '1',
						'edit_field_class' => 'vc_col-xs-4 vc_col-sm-3 vc_column',
					), 
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Bottom - Description', 'halena' ),
						'param_name' => 'member_show_bottom_description',
						'value' => array( esc_html__( 'Yes', 'halena' ) => '1' ),
						'std'  => '1',
						'edit_field_class' => 'vc_col-xs-4 vc_col-sm-3 vc_column',
					), 
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Bottom - Social Icons', 'halena' ),
						'param_name' => 'member_show_bottom_social_icons',
						'value' => array( esc_html__( 'Yes', 'halena' ) => '1' ),
						'std'  => '1',
						'edit_field_class' => 'vc_col-xs-4 vc_col-sm-3 vc_column',
					),

					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Name Font Size', 'halena' ),
						'param_name' => 'member_name_size',
						'description' => esc_html__( 'Font size for the member name. Don\'t include the px string.', 'halena' ),
						'std' => '',
						'edit_field_class' => 'vc_col-xs-4 vc_col-sm-3 vc_column',
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Designation Font Size', 'halena' ),
						'param_name' => 'member_designation_size',
						'description' => esc_html__( 'Font size for the member designation. Don\'t include the px string.', 'halena' ),
						'std' => '',
						'edit_field_class' => 'vc_col-xs-4 vc_col-sm-3 vc_column',
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Description Font Size', 'halena' ),
						'param_name' => 'member_description_size',
						'description' => esc_html__( 'Font size for the member description. Don\'t include the px string.', 'halena' ),
						'std' => '',
						'edit_field_class' => 'vc_col-xs-4 vc_col-sm-3 vc_column',
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Social Icons Font Size', 'halena' ),
						'param_name' => 'member_social_icons_size',
						'description' => esc_html__( 'Font size for the member social icons. Don\'t include the px string.', 'halena' ),
						'std' => '',
						'edit_field_class' => 'vc_col-xs-4 vc_col-sm-3 vc_column',
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Hover Content Vertical Alignment', 'halena' ),
						'param_name' => 'member_hover_vertical_alignment',
						'value' => array(   
							 esc_html__( 'Top', 'halena' ) => 'flex-start',
							 esc_html__( 'Center', 'halena') => 'center',
							 esc_html__( 'Bottom', 'halena') => 'flex-end',
						),
						'description' => esc_html__( 'Choose your memeber details alignment for hover content (if any).', 'halena' ),
						'std' => 'flex-start',
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Hover Content Horizontal Alignment', 'halena' ),
						'param_name' => 'member_hover_horizontal_alignment',
						'value' => array(   
							 esc_html__( 'Left', 'halena' ) => 'flex-start',
							 esc_html__( 'Center', 'halena') => 'center',
							 esc_html__( 'Right', 'halena') => 'flex-end',
						),
						'description' => esc_html__( 'Choose your memeber details alignment for hover content (if any).', 'halena' ),
						'std' => 'flex-start',
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Bottom Content Alignment', 'halena' ),
						'param_name' => 'member_bottom_alignment',
						'value' => array(   
							 esc_html__( 'Left', 'halena' ) => 'left',
							 esc_html__( 'Center', 'halena') => 'center',
							 esc_html__( 'Right', 'halena') => 'right',
						),
						'description' => esc_html__( 'Choose your memeber details alignment for hover content (if any).', 'halena' ),
						'std' => 'left',
					),
					
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Extra class name', 'halena' ),
						'param_name' => 'class',
						'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'halena' ),
					),
					
					$animation_atts,
					$animation_style_atts, 
					$animation_duration_atts,
					$animation_delay_atts,
					$animation_offset_atts,
				)
			
			));
			vc_add_params( "agni_team", $elements_carousel_atts );
			
			vc_map( array(
				'name' => esc_html__( 'Clients', 'halena' ),
				'base' => 'agni_clients',
				'icon' => 'ion-ios-personadd-outline',
				'weight' => '69',
				'category' => esc_html__( 'Carousel', 'halena' ),
				'description' => esc_html__( 'display clients by getting the clients post type', 'halena' ),
				'params' => array(

					array(
						'type' => 'param_group',
						'heading' => esc_html__( 'Values', 'halena' ),
						'param_name' => 'values',
						'value' => urlencode( json_encode( array(
							array(
								'client_img_id' => '',
								'client_img_link' => '',
							),
						) ) ),
						'params' => array(
							array(
								'type' => 'attach_image',
								'heading' => esc_html__( 'Upload Client Logo', 'halena' ),
								'param_name' => 'client_img_id',
								'value' => '',
								'description' => esc_html__( 'Select image from media library.', 'halena' ),
							),
							array(
								'type' => 'textfield',
								'heading' => esc_html__( 'Client Link', 'halena' ),
								'param_name' => 'client_img_link',
								'std' => '',
							),
						),
					),

					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Number of Columns', 'halena' ),
						'param_name' => 'columns',
						'value' => array(   
							 esc_html__( '1 column', 'halena') => '1',
							 esc_html__( '2 columns', 'halena') => '2',
							 esc_html__( '3 columns', 'halena') => '3',
							 esc_html__( '4 columns', 'halena' ) => '4',
							 esc_html__( '5 columns', 'halena' ) => '5',
							 esc_html__( '6 columns', 'halena' ) => '6',
						),
						'description' => esc_html__( 'Choose the column on desktop screen. it will adjust the columns count on responsive screens automatically.', 'halena' ),
						'std' => '4'
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Gutter(Gap)', 'halena' ),
						'param_name' => 'client_gutter',
						'description' => esc_html__( 'It will allow you to adjust the space in between the clients.', 'halena' ),
						'std' => '30',
					),

					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Client Logo Grayscale Filter', 'halena' ),
						'description' => esc_html__( 'It will change the thumbnail to grayscale(black&white). but it will not work on IE browsers.', 'halena' ),
						'param_name' => 'client_gs_filter',
						'value' => array( esc_html__( 'Yes', 'halena' ) => '1' ),
						'std'  => '',
					), 
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Client Logo Invert Filter', 'halena' ),
						'description' => esc_html__( 'It will invery the thumbnail colors.', 'halena' ),
						'param_name' => 'client_invert_filter',
						'value' => array( esc_html__( 'Yes', 'halena' ) => '1' ),
						'std'  => '',
					), 
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Client Logo Opacity', 'halena' ),
						'param_name' => 'client_opacity',
						'description' => esc_html__( 'Enter your desired logo/image opacity between 0.0 to 1.0 or you can Leave it empty for default setting.', 'halena' ),
						'std' => '1.0',
					),

					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Display Style', 'halena' ),
						'param_name' => 'client_display_style',
						'value' => array(
							esc_html__( 'Plain(Default)', 'halena' ) => '',
							esc_html__( 'Background', 'halena' ) => 'background',
							esc_html__( 'Bordered', 'halena' ) => 'border',
						),
						'description' => esc_html__( 'Choose your desired background option.', 'halena' ),
						'std' => '',
						'save_always' => true
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Background Color', 'halena' ),
						'param_name' => 'client_bg_color',
						'description' => esc_html__( 'Choose your desired background color for each client.', 'halena' ),
						'dependency' => array( 'element' => 'client_display_style', 'value' => 'background' ),
						'std' => '#f6f7f8',
						'save_always' => true
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Border Color', 'halena' ),
						'param_name' => 'client_border_color',
						'description' => esc_html__( 'Choose your desired border for the each client.', 'halena' ),
						'dependency' => array( 'element' => 'client_display_style', 'value' => 'border' ),
						'std' => '#dddddd',
						'save_always' => true
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Padding', 'halena' ),
						'param_name' => 'client_padding',
						'description' => esc_html__( 'Common padding for all side. You can use simple Padding CSS here. for ex. "12% 24%" or "80px". or enter just number and it will use pixels.', 'halena' ),
						'std' => '25px',
					),
					
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Extra class name', 'halena' ),
						'param_name' => 'class',
						'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'halena' ),
					),
					
					$animation_atts,
					$animation_style_atts, 
					$animation_duration_atts,
					$animation_delay_atts,
					$animation_offset_atts,
					
				)
			
			));

			vc_add_params( "agni_clients", $elements_carousel_atts );

			vc_map( array(
				'name' => esc_html__( 'Testimonials', 'halena' ),
				'base' => 'agni_testimonials',
				'icon' => 'ion-ios-chatboxes-outline',
				'weight' => '68',
				'category' => esc_html__( 'Carousel', 'halena' ),
				'description' => esc_html__( 'display testimonials by getting the testimonials post type', 'halena' ),
				'params' => array(

					array(
						'type' => 'param_group',
						'heading' => esc_html__( 'Values', 'halena' ),
						'param_name' => 'values',
						'value' => urlencode( json_encode( array(
							array(
								'test_img_id' => '',
								'test_quote' => '',
								'test_author' => '',
								'test_author_designation' => '',
							),
						) ) ),
						'params' => array(
							array(
								'type' => 'attach_image',
								'heading' => esc_html__( 'Upload Avatar', 'halena' ),
								'param_name' => 'test_img_id',
								'value' => '',
								'description' => esc_html__( 'Select image from media library.', 'halena' ),
							),
							array(
								'type' => 'textarea',
								'heading' => esc_html__( 'Testimonial Text', 'halena' ),
								'param_name' => 'test_quote',
								'std' => '',
							),
							array(
								'type' => 'textfield',
								'heading' => esc_html__( 'Author Name', 'halena' ),
								'param_name' => 'test_author',
								'std' => '',
							),

							array(
								'type' => 'textfield',
								'heading' => esc_html__( 'Author Designation', 'halena' ),
								'param_name' => 'test_author_designation',
								'std' => '',
							),
						),
					),

					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Number of Columns', 'halena' ),
						'param_name' => 'columns',
						'value' => array(   
							 esc_html__( '1 column', 'halena' ) => '1',
							 esc_html__( '2 columns', 'halena') => '2',
							 esc_html__( '3 columns', 'halena') => '3',
							 esc_html__( '4 columns', 'halena') => '4',
							 esc_html__( '5 columns', 'halena') => '5',
						),
						'description' => esc_html__( 'Choose the column on desktop screen. it will adjust the columns count on responsive screens automatically.', 'halena' ),
						'std' => '1',
						'save_always' => true
					),

					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Gutter(Gap)', 'halena' ),
						'param_name' => 'testimonial_gutter',
						'description' => esc_html__( 'It will allow you to adjust the space in between each testimonials.', 'halena' ),
						'std' => '30',
					),

					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Avatar Location', 'halena' ),
						'param_name' => 'avatar_location',
						'value' => array(   
							 esc_html__( 'Top', 'halena') => '1',
							 esc_html__( 'Right', 'halena') => '2',
							 esc_html__( 'Bottom', 'halena') => '3',
							 esc_html__( 'Left', 'halena') => '4',
							 esc_html__( 'Along with Cite', 'halena') => '5',
							 esc_html__( 'Top over text', 'halena') => '6',
						),
						'description' => esc_html__( 'Various style to display testimonials. ', 'halena' ),
						//'dependency' => array( 'element' => 'testimonial_author', 'value' => '1' ),
						'std' => '1'
					),

					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Avatar Maximum Width', 'halena' ),
						'param_name' => 'testimonial_avatar_width',
						'description' => esc_html__( 'Enter your maximum avatar width. Don\'t include px string.', 'halena' ),
						//'dependency' => array( 'element' => 'testimonial_avatar', 'value' => '1' ),
						'std' => '84'
					),

					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Avatar Grayscale Filter', 'halena' ),
						'description' => esc_html__( 'It will change the thumbnail to grayscale(black&white). but it will not work on IE browsers.', 'halena' ),
						'param_name' => 'testimonial_thumbnail_gs_filter',
						'value' => array( esc_html__( 'Yes', 'halena' ) => '1' ),
						//'dependency' => array( 'element' => 'testimonial_avatar', 'value' => '1' ),
						'std'  => '',
					), 

					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Circle Avatar', 'halena' ),
						'param_name' => 'circle_avatar',
						'value' => array( esc_html__( 'Yes', 'halena' ) => '1' ),
						//'dependency' => array( 'element' => 'testimonial_avatar', 'value' => '1' ),
						'std'  => '',
					),  
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Quote Text Font Size', 'halena' ),
						'param_name' => 'testimonial_quote_size',
						'description' => esc_html__( 'Enter your quote font size. Don\'t include px string.', 'halena' ),
						//'dependency' => array( 'element' => 'testimonial_quote', 'value' => '1' ),
						'std' => ''
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Quote Display Style', 'halena' ),
						'param_name' => 'testimonial_display_style',
						'value' => array(
							esc_html__( 'Plain(Default)', 'halena' ) => '',
							esc_html__( 'Background', 'halena' ) => 'background',
							esc_html__( 'Bordered', 'halena' ) => 'border',
						),
						'description' => esc_html__( 'Choose your desired background option.', 'halena' ),
						//'dependency' => array( 'element' => 'testimonial_quote', 'value' => '1' ),
						'std' => '',
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Quote Background Color', 'halena' ),
						'param_name' => 'testimonial_bg_color',
						'description' => esc_html__( 'Choose your desired background color for each testimonial.', 'halena' ),
						'dependency' => array( 'element' => 'testimonial_display_style', 'value' => 'background' ),
						'std' => '#f6f7f8',
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Quote Border Color', 'halena' ),
						'param_name' => 'testimonial_border_color',
						'description' => esc_html__( 'Choose your desired border for the each testimonial.', 'halena' ),
						'dependency' => array( 'element' => 'testimonial_display_style', 'value' => 'border' ),
						'std' => '#dddddd',
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Quote Padding', 'halena' ),
						'param_name' => 'testimonial_padding',
						'description' => esc_html__( 'Common padding for all side. You can use simple Padding CSS here. for ex. "12% 24%" or "80px". or enter just number and it will use pixels.', 'halena' ),
						//'dependency' => array( 'element' => 'testimonial_quote', 'value' => '1' ),
						'std' => '',
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Alignment', 'halena' ),
						'param_name' => 'alignment',
						'value' => array(   
							 esc_html__( 'Left', 'halena' ) => 'flex-start',
							 esc_html__( 'Center', 'halena') => 'center',
							 esc_html__( 'Right', 'halena') => 'flex-end',
						),
						'description' => esc_html__( 'Choose your testimonials alignment', 'halena' ),
						'std' => 'flex-start',
					),
									
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Extra class name', 'halena' ),
						'param_name' => 'class',
						'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'halena' ),
					),
					
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Pagination Location', 'halena' ),
						'param_name' => 'testimonial_pagination_style',
						'description' => esc_html__( 'Choose your desired Pagination Location.', 'halena' ),
						'value' => array(   
							 esc_html__( 'Top', 'halena') => 'top',
							 esc_html__( 'Bottom', 'halena') => 'bottom',
							 esc_html__( 'Left', 'halena') => 'left',
							 esc_html__( 'Right', 'halena') => 'right',
						),
						'group' => esc_html__( 'Carousel Settings', 'halena' ),
						'dependency' => array( 'element' => 'carousel_dots', 'value' => '1' ),
						'std' => 'bottom'
					),
					$animation_atts,
					$animation_style_atts, 
					$animation_duration_atts,
					$animation_delay_atts,
					$animation_offset_atts,
					
				)
			
			));
			vc_add_params( "agni_testimonials", $elements_carousel_atts );

			vc_map( array(
				'name' => esc_html__( 'Posts, Portfolio', 'halena' ),
				'base' => 'agni_posttypes',
				'icon' => 'ion-ios-eye-outline',
				'weight' => '67',
				'category' => esc_html__( 'Content', 'halena' ),
				'description' => esc_html__( 'Choose the post & portfolio post type to show the loop!!', 'halena' ),
				'params' => array(
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Post type', 'halena' ),
						'param_name' => 'posttype',
						'value' => array(   
							esc_html__( 'Posts', 'halena') => 'post',
							esc_html__( 'Portfolio', 'halena') => 'portfolio',
						),
						'description' => esc_html__( 'Display the post from the various post types.', 'halena' ),
						'std' => 'post',
						'admin_label' => true
					),

					array(
                        'type' => 'dropdown',
                        'heading' => esc_html__('Blog Layout', 'halena'),
                        'param_name' => 'blog-layout',
                        'value' => array(
                            esc_html__( 'Standard', 'halena') => 'standard',
                            esc_html__( 'Grid', 'halena') => 'grid',
                            esc_html__( 'Modern Grid', 'halena') => 'modern',
                            esc_html__( 'List', 'halena') => 'list',
                            esc_html__( 'Minimal List', 'halena') => 'minimal-list',
                        ),
                        'dependency' => array( 'element' => 'posttype', 'value' => 'post' ),
                        'std' => 'standard'
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => esc_html__('Blog Layout', 'halena'),
                        'param_name' => 'blog-layout-grid-style',
                        'value' => array(
                            esc_html__( 'Style 1', 'halena') => '1',
                            esc_html__( 'Style 2', 'halena') => '2',
                        ),
                        'dependency' => array( 'element' => 'blog-layout', 'value' => 'grid' ),
                        'std' => '1'
                    ),
                    
                    array(
                        'type' => 'dropdown',
                        'heading' => esc_html__('Blog Layout(Columns)', 'halena'),
                        'param_name' => 'blog-column-layout',
                        'value' => array(   
                            esc_html__( '1 Column', 'halena') => '1',
                            esc_html__( '2 Columns', 'halena') => '2',
                            esc_html__( '3 Columns', 'halena') => '3',
                            esc_html__( '4 Columns', 'halena') => '4',
                            esc_html__( '5 Columns', 'halena') => '5',
                        ),
                        'description' => esc_html__( 'Choose the column layout you would like to use.', 'halena' ),
                        'dependency' => array( 'element' => 'blog-layout', 'value' => array('grid', 'modern') ),
                        'std' => '3'
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__('Post Excerpt Length', 'halena'),
                        'param_name' => 'blog-excerpt-length',
                        'description' => esc_html__('It will display the excerpt content with your desired length.', 'halena'),
                        'dependency' => array( 'element' => 'blog-layout', 'value' => array( 'standard', 'grid', 'list' ) ),
                        'std' => '150'
                    ),
                    array(
                        'type' => 'checkbox',
                        'heading' => esc_html__('Use Post Content', 'halena'),
                        'param_name' => 'blog-content-choice',
                        'value' => array( esc_html__( 'Yes', 'halena' ) => '1' ),
                        'description' => esc_html__('It will display the whole post content and ignore the above excerpt value.', 'halena'),
                        'dependency' => array( 'element' => 'blog-layout', 'value' => 'standard' ),
                        'std' => ''
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => esc_html__('Content Style', 'halena'),
                        'param_name' => 'blog-content-style',
                        'value' => array(   
                            esc_html__( 'Default', 'halena') => '',
                            esc_html__( 'Background', 'halena') => 'background',
                            esc_html__( 'Border', 'halena') => 'border',
                        ),
                        'description' => esc_html__( 'Choose content style for the layout.', 'halena' ),
                        'dependency' => array( 'element' => 'blog-layout', 'value' => array('standard', 'grid', 'modern', 'list') ),
                        'std' => ''
                    ),
                    array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Content Background color', 'halena' ),
						'param_name' => 'blog-content-bg-color',
                        'dependency' => array( 'element' => 'blog-content-style', 'value' => 'background' ),
						'std' => ''
					),
                    array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Content Border color', 'halena' ),
						'param_name' => 'blog-content-border-color',
                        'dependency' => array( 'element' => 'blog-content-style', 'value' => 'border' ),
						'std' => ''
					),
					array(
                        'type' => 'dropdown',
                        'heading' => esc_html__( 'Content Alignment', 'halena' ),
                        'param_name' => 'blog-content-align',
                        'value' => array(
                            esc_html__( 'Left', 'halena' ) => 'left', 
                            esc_html__( 'Center', 'halena' ) => 'center',                    
                            esc_html__( 'Right', 'halena' ) => 'right',
                        ),
                        'description' => esc_html__( 'Select the content to be aligned', 'halena' ),
                        'dependency' => array( 'element' => 'blog-layout', 'value' => array('standard', 'grid', 'list') ),
                        'std' => 'left'
                    ),

                    array(
                        'type'     => 'dropdown',
                        'heading'    => esc_html__( 'Blog Grid Style', 'halena' ),
                        'param_name'       => 'blog-grid-layout',
                        'description' => esc_html__( 'Choose any of one grid style. fitRows is default.', 'halena' ),
                        'value' => array(
                            esc_html__( 'FitRows(Default Grid)', 'halena' ) => 'fitRows',
                            esc_html__( 'Masonry', 'halena' ) => 'masonry',
                        ),
                        'dependency' => array( 'element' => 'blog-layout', 'value' => array('grid', 'modern') ),
                        'std'  => 'fitRows'
                    ),

                    array(
                        'type'     => 'dropdown',
                        'heading' => esc_html__('Blog Sidebar', 'halena'),
                        'param_name' => 'blog-sidebar',
                        'value' => array(
                            esc_html__( 'No Sidebar', 'halena') => 'no-sidebar',
                            esc_html__( 'Right Sidebar', 'halena') => 'has-sidebar',
                            esc_html__( 'Left Sidebar', 'halena') => 'has-sidebar left',
                        ),
                        'dependency' => array( 'element' => 'posttype', 'value' => 'post' ),
                        'std' => 'has-sidebar'
                    ),

                    // Common for Portfolio & Post
                    array(
                        'type' => 'checkbox',
                        'heading' => esc_html__( 'Carousel', 'halena' ),
                        'param_name' => 'carousel',
                        'value' => array( esc_html__( 'Yes', 'halena' ) => '1' ),
                        'description' => esc_html__( 'It will display the portfolio/blog items inside the carousel.', 'halena' ),
                        'std' => ''
                    ),
                    array(
                        'type' => 'checkbox',
                        'heading' => esc_html__( 'Ignore Thumbnail Settings', 'halena' ),
                        'param_name' => 'portfolio_thumbnail_individual_settings',
                        'value' => array( esc_html__( 'Yes', 'halena' ) => '1' ),
                        'description' => esc_html__( 'It will ignore the portfolio thumbnail width & height settings(if any).', 'halena' ),
                        'dependency' => array( 'element' => 'posttype', 'value' => 'portfolio' ),
                        'std' => ''
                    ),

					array(
                        'type' => 'checkbox',
                        'heading' => esc_html__( 'Blog Gutter', 'halena' ),
                        'param_name' => 'blog-gutter',
                        'value' => array( esc_html__( 'Yes', 'halena' ) => '1' ),
                        'description' => esc_html__( 'It will bring some space in between the items horizontally.', 'halena' ),
                        'dependency' => array( 'element' => 'blog-layout', 'value' => array( 'grid', 'modern' ) ),
                        'std' => '1'
                    ),

                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Blog Gutter Value', 'halena' ),
                        'param_name' => 'blog-gutter-value',
                        'description' => esc_html__( 'Enter the space you want to add between each item.', 'halena' ),
                        'dependency' => array( 'element' => 'blog-gutter', 'value' => '1' ),
                        'std' => '30'
                    ),

                    array(
                        'type' => 'dropdown',
                        'heading' => esc_html__( 'Blog Thumbnail Choice', 'halena' ),
                        'param_name' => 'blog-thumbnail-choice',
                        'description' => esc_html__( 'Choose your featured image style', 'halena' ),
                        'value' => array( 
                            esc_html__( 'Post Thumbnail (960x520)', 'halena' ) => 'halena-post-thumbnail',
                            esc_html__( 'Standard Thumbnail (960xauto)', 'halena' ) => 'halena-standard-thumbnail',
                            esc_html__( 'Custom', 'halena' ) => 'custom',
                        ),
                        'dependency' => array( 'element' => 'posttype', 'value' => 'post' ),
                        'std' => 'halena-post-thumbnail'
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Thumbnails Crop Size', 'halena' ),
                        'param_name' => 'blog-thumbnail-dimension-custom',
                        'description' => esc_html__( 'Set the maximum width & height of a thumbnail. Note: it may not be an actual image size but the ratio will be the same.', 'halena' ),
                        'dependency' => array( 'element' => 'blog-thumbnail-choice', 'value' => 'custom' ),
                        'std' => '640x640'
                    ),
                    array(
                        'type' => 'checkbox',
                        'heading' => esc_html__( 'Thumbnail Grayscale', 'halena' ),
                        'param_name' => 'blog-thumbnail-gs-filter',
                        'value' => array( esc_html__( 'Yes', 'halena' ) => '1' ),
                        'description' => esc_html__( 'It will change the thumbnail to grayscale(black&white). Note: It will not work on IE browsers', 'halena' ),
                        'dependency' => array( 'element' => 'posttype', 'value' => 'post' ),
                        'std' => ''
                    ),
                    
                    array(
                        'type' => 'checkbox',
                        'heading' => esc_html__( 'Thumbnail Clickable', 'halena' ),
                        'param_name' => 'blog-thumbnail-clickable',
                        'value' => array( esc_html__( 'Yes', 'halena' ) => '1' ),
                        'dependency' => array( 'element' => 'posttype', 'value' => 'post' ),
                        'std' => ''
                    ),

                    array(
                        'type' => 'checkbox',
                        'heading' => esc_html__( 'Navigation', 'halena' ),
                        'param_name' => 'blog-navigation',
                        'value' => array( esc_html__( 'Yes', 'halena' ) => '1' ),
                        'dependency' => array( 'element' => 'posttype', 'value' => 'post' ),
                        'std' => '1'
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => esc_html__( 'Navigation style', 'halena' ),
                        'param_name' => 'blog-navigation-choice',
                        'description' => esc_html__( 'Choose your pagination style', 'halena' ),
                        'value' => array( 
                            esc_html__( 'Classic', 'halena' ) => '1',
                            esc_html__( 'Number', 'halena' ) => '2',
                            esc_html__( 'Infinite', 'halena' ) => '3',
                            esc_html__( 'Infinite with Load More', 'halena' ) => '4' 
                        ),
                        'dependency' => array( 'element' => 'blog-navigation', 'value' => '1' ),
                        'std' => '1'
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Text to show on loading', 'halena' ),
                        'param_name' => 'blog-navigation-ifs-load-text',
                        'dependency' => array( 'element' => 'blog-navigation-choice', 'value' => array('3', '4') ),
                        'std' => 'Loading'
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Text to show at the end of page', 'halena' ),
                        'param_name' => 'blog-navigation-ifs-finish-text',
                        'dependency' => array( 'element' => 'blog-navigation-choice', 'value' => array('3', '4') ),
                        'std' => 'No More Items'
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Button Text', 'halena' ),
                        'param_name' => 'blog-navigation-ifs-btn-text',
                        'dependency' => array( 'element' => 'blog-navigation-choice', 'value' => '4' ),
                        'std' => 'Load More'
                    ),

					array(
                        'type' => 'dropdown',
                        'heading' => esc_html__( 'Portfolio layout(Columns)', 'halena' ),
                        'param_name' => 'portfolio-layout',
                        'value' => array(   
                            esc_html__( '1 Column', 'halena') => '1',
                            esc_html__( '2 Columns', 'halena') => '2',
                            esc_html__( '3 Columns', 'halena') => '3',
                            esc_html__( '4 Columns', 'halena') => '4',
                            esc_html__( '5 Columns', 'halena') => '5',
                        ),
                        'description' => esc_html__( 'Choose the column layout you would like to use.', 'halena' ),
                        'dependency' => array( 'element' => 'posttype', 'value' => 'portfolio' ),
                        'std' => '3'
                    ),

                    array(
                        'type' => 'checkbox',
                        'heading' => esc_html__( 'Portfolio Fullwidth', 'halena' ),
                        'param_name' => 'portfolio-fullwidth',
                        'value' => array( esc_html__( 'Yes', 'halena' ) => '1' ),
                        'description' => esc_html__( 'Kindly set your row as fullwidth to get the fullwidth portfolio. ', 'halena' ),
                        'dependency' => array( 'element' => 'posttype', 'value' => 'portfolio' ),
                        'std' => ''
                    ),

                    array(
                        'type' => 'dropdown',
                        'heading' => esc_html__( 'Portfolio Masonry Style', 'halena' ),
                        'param_name' => 'portfolio-grid',
                        'value' => array(   
                             esc_html__( 'FitRows(Default Grid)', 'halena') => 'fitRows',
                             esc_html__( 'Masonry', 'halena') => 'masonry',
                        ),
                        'description' => esc_html__( 'You can choose your isotope layout style.', 'halena' ),
                        'dependency' => array( 'element' => 'posttype', 'value' => 'portfolio' ),
                        'std' => 'fitRows'
                    ),
                    
                    array(
                        'type' => 'checkbox',
                        'heading' => esc_html__( 'Portfolio Gutter', 'halena' ),
                        'param_name' => 'portfolio-gutter',
                        'value' => array( esc_html__( 'Yes', 'halena' ) => '1' ),
                        'description' => esc_html__( 'It will bring some space in between the items horizontally.', 'halena' ),
                        'dependency' => array( 'element' => 'posttype', 'value' => 'portfolio' ),
                        'std' => '1'
                    ),

                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Portfolio Gutter Value', 'halena' ),
                        'param_name' => 'portfolio-gutter-value',
                        'description' => esc_html__( 'Enter the space you want to add between each item.', 'halena' ),
                        'dependency' => array( 'element' => 'portfolio-gutter', 'value' => '1' ),
                        'std' => '30'
                    ),

                    array(
                        'type' => 'checkbox',
                        'heading' => esc_html__( 'Portfolio Thumbnails Hard Crop', 'halena' ),
                        'param_name' => 'portfolio-thumbnail-hardcrop',
                        'value' => array( esc_html__( 'Yes', 'halena' ) => '1' ),
                        'description' => esc_html__( 'It will crop all the images by ignoring original dimension of an image.', 'halena' ),
                        'dependency' => array( 'element' => 'posttype', 'value' => 'portfolio' ),
                        'std' => ''
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Thumbnails Crop Size', 'halena' ),
                        'param_name' => 'portfolio-thumbnail-dimension-custom',
                        'description' => esc_html__( 'Set the maximum width & height of a thumbnail. Note: it may not be an actual image size but the ratio will be the same.', 'halena' ),
                        'dependency' => array( 'element' => 'portfolio-thumbnail-hardcrop', 'value' => '1' ),
                        'std' => '640x640'
                    ),
                    array(
                        'type' => 'checkbox',
                        'heading' => esc_html__( 'Thumbnail Grayscale', 'halena' ),
                        'param_name' => 'portfolio-thumbnail-gs-filter',
                        'value' => array( esc_html__( 'Yes', 'halena' ) => '1' ),
                        'description' => esc_html__( 'It will change the thumbnail to grayscale(black&white). Note: It will not work on IE browsers', 'halena' ),
                        'dependency' => array( 'element' => 'posttype', 'value' => 'portfolio' ),
                        'std' => ''
                    ),

                    array(
                        'type' => 'dropdown',
                        'heading' => esc_html__('Portfolio Hover style', 'halena'),
                        'param_name' => 'portfolio-hover-style',
                        'value' => array(
                            esc_html__('Style 1', 'halena') => '1',
                            esc_html__('Style 2', 'halena') => '2',
                            esc_html__('Style 3', 'halena') => '3',
                            esc_html__('Style 4', 'halena') => '4',
                            esc_html__('Style 5', 'halena') => '5',
                            esc_html__('Style 6', 'halena') => '6',
                            esc_html__('Style 7', 'halena') => '7',
                        ), //Must provide key => value pairs for select options
                        'description' => esc_html__( 'Various hover style for portfolio.. ', 'halena' ),
                        'dependency' => array( 'element' => 'posttype', 'value' => 'portfolio' ),
                        'std' => '1'
                    ),
                    array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Hover Background color', 'halena' ),
						'param_name' => 'portfolio-hover-bg-color',
						'dependency' => array( 'element' => 'posttype', 'value' => 'portfolio' ),
						'std' => ''
					),
                    array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Hover Content color', 'halena' ),
						'param_name' => 'portfolio-hover-color',
						'dependency' => array( 'element' => 'posttype', 'value' => 'portfolio' ),
						'std' => ''
					),
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Hover Portfolio Title', 'halena' ),
						'param_name' => 'portfolio-hover-show-title',
						'value' => array( esc_html__( 'Yes', 'halena' ) => '1' ),
						'dependency' => array( 'element' => 'posttype', 'value' => 'portfolio' ),
						'std'  => '1',
						'edit_field_class' => 'vc_col-xs-6 vc_col-sm-3 vc_column',
					), 
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Hover Portfolio Category', 'halena' ),
						'param_name' => 'portfolio-hover-show-category',
						'value' => array( esc_html__( 'Yes', 'halena' ) => '1' ),
						'dependency' => array( 'element' => 'posttype', 'value' => 'portfolio' ),
						'std'  => '1',
						'edit_field_class' => 'vc_col-xs-6 vc_col-sm-3 vc_column',
					), 
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Hover Portfolio Link', 'halena' ),
						'param_name' => 'portfolio-hover-show-link',
						'value' => array( esc_html__( 'Yes', 'halena' ) => '1' ),
						'dependency' => array( 'element' => 'posttype', 'value' => 'portfolio' ),
						'std'  => '1',
						'edit_field_class' => 'vc_col-xs-6 vc_col-sm-3 vc_column',
					), 
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Hover Portfolio Attachment Link', 'halena' ),
						'param_name' => 'portfolio-hover-show-attachment-link',
						'value' => array( esc_html__( 'Yes', 'halena' ) => '1' ),
						'dependency' => array( 'element' => 'posttype', 'value' => 'portfolio' ),
						'std'  => '1',
						'edit_field_class' => 'vc_col-xs-6 vc_col-sm-3 vc_column',
					), 

					array(
                        'type' => 'dropdown',
                        'heading' => esc_html__( 'Portfolio Bottom Caption Style', 'halena' ),
                        'param_name' => 'portfolio-bottom-style',
                        'value' => array(
							esc_html__( 'Default', 'halena' ) => '',
							esc_html__( 'Background', 'halena' ) => 'background',
							esc_html__( 'Border', 'halena' ) => 'border'
                        ), //Must provide key => value pairs for select options
                        'dependency' => array( 'element' => 'posttype', 'value' => 'portfolio' ),
                        'std' => ''
                    ),

                    array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Bottom Caption BG color', 'halena' ),
						'param_name' => 'portfolio-bottom-bg-color',
						'dependency' => array( 'element' => 'portfolio-bottom-style', 'value' => 'background' ),
						'std' => ''
					),

                    array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Bottom Caption Border color', 'halena' ),
						'param_name' => 'portfolio-bottom-border-color',
						'dependency' => array( 'element' => 'portfolio-bottom-style', 'value' => 'border' ),
						'std' => ''
					),

                    array(
                        'type' => 'checkbox',
                        'heading' => esc_html__( 'Portfolio Bottom Title', 'halena' ),
                        'param_name' => 'portfolio-bottom-title',
                        'value' => array( esc_html__( 'Yes', 'halena' ) => '1' ),
                        'dependency' => array( 'element' => 'posttype', 'value' => 'portfolio' ),
                        'std' => '',
						'edit_field_class' => 'vc_col-xs-6 vc_col-sm-3 vc_column',
                    ),
                    array(
                        'type' => 'checkbox',
                        'heading' => esc_html__( 'Portfolio Bottom Category', 'halena' ),
                        'param_name' => 'portfolio-bottom-category',
                        'value' => array( esc_html__( 'Yes', 'halena' ) => '1' ),
                        'dependency' => array( 'element' => 'posttype', 'value' => 'portfolio' ),
                        'std' => '',
						'edit_field_class' => 'vc_col-xs-6 vc_col-sm-3 vc_column',
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => esc_html__( 'Bottom Caption alignment', 'halena' ),
                        'param_name' => 'portfolio-bottom-align',
                        'value' => array(
                             esc_html__( 'Left', 'halena' ) => 'left', 
                             esc_html__( 'Center', 'halena' ) => 'center',                    
                             esc_html__( 'Right', 'halena' ) => 'right',
                            ),
                        'description' => esc_html__( 'Select the caption to be aligned', 'halena' ),
						'dependency' => array( 'element' => 'posttype', 'value' => 'portfolio' ),
                        'std' => 'left'
                    ),

                    array(
                        'type' => 'dropdown',
                        'heading' => esc_html__( 'Portfolio Link Target', 'halena' ),
                        'param_name' => 'portfolio-post-link-target',
                        'value' => array(
							esc_html__( 'Same window', 'halena' ) => '_self',
							esc_html__( 'New window', 'halena' ) => '_blank'
                        ), //Must provide key => value pairs for select options
                        'dependency' => array( 'element' => 'posttype', 'value' => 'portfolio' ),
                        'std' => '_self'
                    ),
                    
                    array(
                        'type' => 'checkbox',
                        'heading' => esc_html__( 'Portfolio Filter', 'halena' ),
                        'param_name' => 'portfolio-filter',
                        'value' => array( esc_html__( 'Yes', 'halena' ) => '1' ),
                        'dependency' => array( 'element' => 'posttype', 'value' => 'portfolio' ),
                        'std' => ''
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => esc_html__( 'Portfolio Filter Order', 'halena' ),
                        'param_name' => 'portfolio-filter-order',
                        'value' => array(   
                             esc_html__( 'Ascending', 'halena') => 'ASC',
                             esc_html__( 'Descending ', 'halena') => 'DESC',
                        ),
                        'dependency' => array( 'element' => 'portfolio-filter', 'value' => '1' ),
                        'std' => 'ASC'
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => esc_html__( 'Portfolio Filter Order by', 'halena' ),
                        'param_name' => 'portfolio-filter-orderby',
                        'value' => array(                       
                             esc_html__( 'None', 'halena') => 'none',
                             esc_html__( 'Name', 'halena') => 'name',
                             esc_html__( 'Slug', 'halena') => 'slug',
                             esc_html__( 'Term Group', 'halena') => 'term_group',
                             esc_html__( 'Term ID', 'halena') => 'term_id',
                             esc_html__( 'ID', 'halena') => 'id',
                             esc_html__( 'Description', 'halena') => 'description',
                        ),
                        'dependency' => array( 'element' => 'portfolio-filter', 'value' => '1' ),
                        'std' => 'name'
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => esc_html__( 'Portfolio Filter alignment', 'halena' ),
                        'param_name' => 'portfolio-filter-align',
                        'value' => array(
                             esc_html__( 'Left', 'halena' ) => 'left', 
                             esc_html__( 'Center', 'halena' ) => 'center',                    
                             esc_html__( 'Right', 'halena' ) => 'right',
                            ),
                        'description' => esc_html__( 'Select the filter style to be aligned', 'halena' ),
                        'dependency' => array( 'element' => 'portfolio-filter', 'value' => '1' ),
                        'std' => 'left'
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Text alternative for "All"', 'halena' ),
                        'param_name' => 'portfolio-filter-all-text',
                        'description' => esc_html__( 'Type the alternative text for the portfolio filter\'s All text', 'halena' ),
                        'dependency' => array( 'element' => 'portfolio-filter', 'value' => '1' ),
                        'std' => 'All'
                    ),
					
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Navigation', 'halena' ),
						'param_name' => 'portfolio-navigation',
						'value' => array( esc_html__( 'Yes', 'halena' ) => '1' ),
						'dependency' => array( 'element' => 'posttype', 'value' => 'portfolio' ),
						'std' => '1'
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Navigation style', 'halena' ),
						'param_name' => 'portfolio-navigation-choice',
						'description' => esc_html__( 'Choose your pagination style', 'halena' ),
						'value' => array( 
							esc_html__( 'Number', 'halena' ) => '1',
							esc_html__( 'Infinite', 'halena' ) => '2',
							esc_html__( 'Infinite with Load More', 'halena' ) => '3' 
						),
						'dependency' => array( 'element' => 'portfolio-navigation', 'value' => '1' ),
						'std' => '1'
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Text to show on loading', 'halena' ),
						'param_name' => 'portfolio-navigation-ifs-load-text',
						'dependency' => array( 'element' => 'portfolio-navigation-choice', 'value' => array('2', '3') ),
						'std' => 'Loading'
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Text to show at the end of page', 'halena' ),
						'param_name' => 'portfolio-navigation-ifs-finish-text',
						'dependency' => array( 'element' => 'portfolio-navigation-choice', 'value' => array('2', '3') ),
						'std' => 'No More Items'
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Button Text', 'halena' ),
						'param_name' => 'portfolio-navigation-ifs-btn-text',
						'dependency' => array( 'element' => 'portfolio-navigation-choice', 'value' => '3' ),
						'std' => 'Load More'
					),
					
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Number of Posts to display', 'halena' ),
						'param_name' => 'posts_per_page',
						'description' => esc_html__( 'Mention the number of posts that you want to display. -1 for infinite posts', 'halena' ),
						'group' => esc_html__( 'Posttype Settings', 'halena' ),
						'std' => '5'
					),

					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Categories', 'halena' ),
						'param_name' => 'blog-categories',
						'value' => $blog_options,
						'description' => esc_html__( 'Categories of post post type. ignore this to show all', 'halena' ),
						'dependency' => array( 'element' => 'posttype', 'value' => 'post' ),
						'group' => esc_html__( 'Posttype Settings', 'halena' ),
						'std' => ''
					),

                    array(
                        'type' => 'checkbox',
                        'heading' => esc_html__( 'Portfolio Categories', 'halena' ),
                        'param_name' => 'portfolio-categories',
                        'value' => $portfolio_options,
                        'description' => esc_html__( 'Categories of portfolio post type', 'halena' ),
                        'dependency' => array( 'element' => 'posttype', 'value' => 'portfolio' ),
						'group' => esc_html__( 'Posttype Settings', 'halena' ),
                        'std' => ''
                    ),
					
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Order', 'halena' ),
						'param_name' => 'order',
						'value' => array(   
							 esc_html__( 'Descending ', 'halena') => 'DESC',
							 esc_html__( 'Ascending', 'halena') => 'ASC',
						),
						'group' => esc_html__( 'Posttype Settings', 'halena' ),
						'std' => 'DESC'
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Order by', 'halena' ),
						'param_name' => 'orderby',
						'value' => array(                       
							 esc_html__( 'None', 'halena') => 'none',
							 esc_html__( 'Post ID', 'halena') => 'id',
							 esc_html__( 'Post author', 'halena') => 'author',
							 esc_html__( 'Post title', 'halena') => 'title',
							 esc_html__( 'Post slug', 'halena') => 'name',
							 esc_html__( 'Date', 'halena') => 'date',
							 esc_html__( 'Last modified date', 'halena') => 'modified',
							 esc_html__( 'Random', 'halena') => 'rand',
							 esc_html__( 'Comments number', 'halena') => 'comment_count',
							 esc_html__( 'Menu order', 'halena') => 'menu_order',
						),
						'group' => esc_html__( 'Posttype Settings', 'halena' ),
						'std' => 'date'
					),
					
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Posts to include', 'halena' ),
						'param_name' => 'post_in',
						'description' => esc_html__( 'Mention the posts id to includes for.eg.401', 'halena' ),
						'group' => esc_html__( 'Posttype Settings', 'halena' ),
						'std' => ''
					),
					
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Posts to exclude', 'halena' ),
						'param_name' => 'post_not_in',
						'description' => esc_html__( 'Mention the posts id to excludes for.eg.401', 'halena' ),
						'group' => esc_html__( 'Posttype Settings', 'halena' ),
						'std' => ''
					),
					
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Ignore Sticky', 'halena' ),
						'param_name' => 'ignore_sticky',
						'description' => esc_html__( 'Just check this if you want to ignore sticky posts..', 'halena' ),
						'value' => array( esc_html__( 'Yes', 'halena' ) => '1' ),
						'group' => esc_html__( 'Posttype Settings', 'halena' ),
						'dependency' => array( 'element' => 'posttype', 'value' => 'post' )
					),
					
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Autoplay', 'halena' ),
						'param_name' => 'posttype_autoplay',
						'value' => array( esc_html__( 'Yes', 'halena' ) => '1' ),
						'group' => esc_html__( 'Carousel Settings', 'halena' ),
						'dependency' => array( 'element' => 'carousel', 'value' => '1' ),
						'std'  => '1',
					),  
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Timeout duration', 'halena' ),
						'param_name' => 'posttype_autoplay_timeout',
						'description' => esc_html__( 'Enter the duration of each slide Transition', 'halena' ),
						'group' => esc_html__( 'Carousel Settings', 'halena' ),
						'dependency' => array( 'element' => 'carousel', 'value' => '1' ),
						'std' => '4000'
					),
					
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Pause on Hover', 'halena' ),
						'param_name' => 'posttype_autoplay_hover',
						'value' => array( esc_html__( 'Yes', 'halena' ) => '1' ),
						'group' => esc_html__( 'Carousel Settings', 'halena' ),
						'dependency' => array( 'element' => 'carousel', 'value' => '1' ),
						'std'  => '1'
					),
					
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Slide Speed', 'halena' ),
						'param_name' => 'posttype_autoplay_speed',
						'description' => esc_html__( 'Enter the speed of each slide Transition', 'halena' ),
						'group' => esc_html__( 'Carousel Settings', 'halena' ),
						'dependency' => array( 'element' => 'carousel', 'value' => '1' ),
						'std' => '700',
					),
					
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Loop', 'halena' ),
						'param_name' => 'posttype_loop',
						'value' => array( esc_html__( 'Yes', 'halena' ) => '1' ),
						'group' => esc_html__( 'Carousel Settings', 'halena' ),
						'dependency' => array( 'element' => 'carousel', 'value' => '1' ),
						'std'  => '1'
					),
					
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Pagination Dots', 'halena' ),
						'param_name' => 'posttype_pagination',
						'value' => array( esc_html__( 'Yes', 'halena' ) => '1' ),
						'group' => esc_html__( 'Carousel Settings', 'halena' ),
						'dependency' => array( 'element' => 'carousel', 'value' => '1' ),
						'std'  => '1'
					),
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Navigation Arrows', 'halena' ),
						'param_name' => 'posttype_navigation',
						'value' => array( esc_html__( 'Yes', 'halena' ) => '1' ),
						'group' => esc_html__( 'Carousel Settings', 'halena' ),
						'dependency' => array( 'element' => 'carousel', 'value' => '1' ),
						'std'  => '0'
					),
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Animation', 'halena' ),
						'param_name' => 'animation',
						'group' => esc_html__( 'Animation Settings', 'halena' ),
						'value' => array( esc_html__( 'Yes', 'halena' ) => '1' ),
						'std' => ''
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Animation style', 'halena' ),
						'param_name' => 'animation_style',
						'description' => esc_html__( 'Choose your animation style', 'halena' ),
						'value' => array( 
							esc_html__('fadeIn', 'halena') => 'fadeIn',
							esc_html__('fadeInDown', 'halena') => 'fadeInDown',
							esc_html__('fadeInUp', 'halena') => 'fadeInUp',
							esc_html__('fadeInRight', 'halena') => 'fadeInRight',
							esc_html__('fadeInLeft', 'halena') => 'fadeInLeft',
							esc_html__('flipInX', 'halena') => 'flipInX',
							esc_html__('flipInY', 'halena') => 'flipInY',
							esc_html__('zoomIn', 'halena') => 'zoomIn',
						),
						'group' => esc_html__( 'Animation Settings', 'halena' ),
						'dependency' => array( 'element' => 'animation', 'value' => '1' ),
						'std' => 'fadeInUp'
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Animation Duration', 'halena' ),
						'param_name' => 'animation_duration',
						'description' => esc_html__( 'Enter the value in seconds. for ex. 0.6', 'halena' ),
						'group' => esc_html__( 'Animation Settings', 'halena' ),
						'dependency' => array( 'element' => 'animation', 'value' => '1' ),
						'std' => '0.8'
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Animation Delay', 'halena' ),
						'param_name' => 'animation_delay',
						'description' => esc_html__( 'Enter the value in seconds. for ex. 0.6', 'halena' ),
						'group' => esc_html__( 'Animation Settings', 'halena' ),
						'dependency' => array( 'element' => 'animation', 'value' => '1' ),
						'std' => '0.4'
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Animation Offset', 'halena' ),
						'param_name' => 'animation_offset',
						'description' => esc_html__( 'Animation will be triggered only when portfolio reaches particular percentage on viewport. for eg. 90', 'halena' ),
						'group' => esc_html__( 'Animation Settings', 'halena' ),
						'dependency' => array( 'element' => 'animation', 'value' => '1' ),
						'std' => '90'
					),
				)
			));     
		}   

		//WooCommerce Product List
		if( class_exists( 'WooCommerce' ) ){
			$product_options = $product_cat_terms = array();
			$product_categories = get_terms('product_cat');     
			$product_cat_terms_empty['None'] = '';
			foreach ($product_categories as $category) {
				$product_options[$category->name] = $category->slug;
				$product_cat_terms[$category->name] = $category->term_id;
				$product_cat_terms_empty[$category->name] = $category->term_id;
			}

			vc_map( array(
				'name' => esc_html__('WooCommerce Products', 'halena'),
				'base' => 'agni_woo_products',
				'icon' => 'ion-ios-cart-outline',
				'weight' => '66',
				'category' => esc_html__('WooCommerce', 'halena'),
				'description' => esc_html__('Setup your product to display.', 'halena'),
				'params' => array(
					array(
						'type' => 'dropdown',
						'heading' => esc_html__('Product Type', 'halena'),
						'param_name' => 'product_type',
						'value' => array(
							esc_html__( 'All', 'halena') => 'all',
							esc_html__( 'Sale', 'halena') => 'sale',
							esc_html__( 'Featured', 'halena') => 'featured',
							esc_html__( 'Best Selling', 'halena') => 'best_selling',
							esc_html__( 'Top Rated', 'halena') => 'toprated',
						),
						'save_always' => true,
						'description' => esc_html__('Please select the type of products you would like to display.', 'halena'),
						'std' => 'all'
					),
					array(
						'type' => 'checkbox',
						'heading' => esc_html__('Product Categories', 'halena'),
						'param_name' => 'product_categories',
						'value' => $product_options,
						'save_always' => true,
						'description' => esc_html__('choose your desired Categories', 'halena'),
						'std' => ''
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__('Number Of Columns', 'halena'),
						'param_name' => 'columns',
						'value' => array(
                            esc_html__( '1 Column', 'halena') => '1',
                            esc_html__( '2 Columns', 'halena') => '2',
                            esc_html__( '3 Columns', 'halena') => '3',
                            esc_html__( '4 Columns', 'halena') => '4',
                            esc_html__( '5 Columns', 'halena') => '5',
                            esc_html__( '6 Columns', 'halena') => '6',
						),
						'save_always' => true,
						'description' => esc_html__('Please select the number of columns you would like to display.', 'halena'),
						'std' => '4'
					),

					array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Gutter', 'halena' ),
                        'param_name' => 'product_gutter_value',
                        'description' => esc_html__( 'Enter the space you want to add between each item.', 'halena' ),
                        'std' => '0'
                    ),

					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Product Background color', 'halena' ),
						'param_name' => 'product_bg',
						'std' => ''
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Product Hover Style', 'halena' ),
						'param_name' => 'product_hover_style',
						'value' => array(   
							 esc_html__( 'Style 1', 'halena') => '1',
							 esc_html__( 'Style 2', 'halena') => '2',
						),
						'std' => '1'
					),

					array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Padding Top', 'halena' ),
                        'param_name' => 'product_content_padding_top',
                        'description' => esc_html__( 'Enter your desired space above the content.', 'halena' ),
                        'std' => '',
                        'edit_field_class' => 'vc_col-xs-6 vc_col-sm-3',
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Padding Right', 'halena' ),
                        'param_name' => 'product_content_padding_right',
                        'description' => esc_html__( 'Enter your desired space on right side of the content.', 'halena' ),
                        'std' => '',
                        'edit_field_class' => 'vc_col-xs-6 vc_col-sm-3',
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Padding Bottom', 'halena' ),
                        'param_name' => 'product_content_padding_bottom',
                        'description' => esc_html__( 'Enter your desired space below the content.', 'halena' ),
                        'std' => '',
                        'edit_field_class' => 'vc_col-xs-6 vc_col-sm-3',
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Padding Left', 'halena' ),
                        'param_name' => 'product_content_padding_left',
                        'description' => esc_html__( 'Enter your desired space left of the content.', 'halena' ),
                        'std' => '',
                        'edit_field_class' => 'vc_col-xs-6 vc_col-sm-3',
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => esc_html__( 'Product Content alignment', 'halena' ),
                        'param_name' => 'product_content_align',
                        'value' => array(
                             esc_html__( 'Left', 'halena' ) => 'left', 
                             esc_html__( 'Center', 'halena' ) => 'center',                    
                             esc_html__( 'Right', 'halena' ) => 'right',
                            ),
                        'description' => esc_html__( 'Select the caption to be aligned', 'halena' ),
                        'std' => 'center'
                    ),

					array(
						'type' => 'textfield',
						'heading' => esc_html__('Number of Products to display', 'halena'),
						'param_name' => 'posts_per_page',
						'description' => esc_html__('Mention the number of posts that you want to display!!.. -1 for infinite posts', 'halena'),
						'std' => '3'
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Order', 'halena' ),
						'param_name' => 'order',
						'value' => array(   
							 esc_html__( 'Descending ', 'halena') => 'DESC',
							 esc_html__( 'Ascending', 'halena') => 'ASC',
						),
						'std' => 'DESC'
					),
					
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Order by', 'halena' ),
						'param_name' => 'order_by',
						'value' => array(                       
							 esc_html__( 'None', 'halena') => 'none',
							 esc_html__( 'Post ID', 'halena') => 'id',
							 esc_html__( 'Post author', 'halena') => 'author',
							 esc_html__( 'Post title', 'halena') => 'title',
							 esc_html__( 'Post slug', 'halena') => 'name',
							 esc_html__( 'Date', 'halena') => 'date',
							 esc_html__( 'Last modified date', 'halena') => 'modified',
							 esc_html__( 'Random', 'halena') => 'rand',
							 esc_html__( 'Comments number', 'halena') => 'comment_count',
							 esc_html__( 'Menu order', 'halena') => 'menu_order',
						),
						'std' => 'date'
					),

				)
			));

			vc_add_params( "agni_woo_products", $elements_carousel_atts );

			vc_map( array(
				'name' => esc_html__('Agni Products Categories', 'halena'),
				'base' => 'agni_woo_products_categories',
				'icon' => 'ion-ios-cart-outline',
				'weight' => '66',
				'category' => esc_html__('WooCommerce', 'halena'),
				'description' => esc_html__('Setup your product to display.', 'halena'),
				'params' => array(

					array(
						'type' => 'checkbox',
						'heading' => esc_html__('Choose Categories', 'halena'),
						'param_name' => 'ids',
						'value' => $product_cat_terms,
						'save_always' => true,
						'description' => esc_html__('choose your desired Categories', 'halena'),
						'std' => ''
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__('Choose Parent Category to display', 'halena'),
						'param_name' => 'parent',
						'value' => $product_cat_terms_empty,
						'save_always' => true,
						'description' => esc_html__('choose your desired Categories', 'halena'),
						'std' => ''
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__('Number Of Columns', 'halena'),
						'param_name' => 'columns',
						'value' => array(
                            esc_html__( '1 Column', 'halena') => '1',
                            esc_html__( '2 Columns', 'halena') => '2',
                            esc_html__( '3 Columns', 'halena') => '3',
                            esc_html__( '4 Columns', 'halena') => '4',
                            esc_html__( '5 Columns', 'halena') => '5',
                            esc_html__( '6 Columns', 'halena') => '6',
						),
						'description' => esc_html__('Please select the number of columns you would like to display.', 'halena'),
						'std' => '3'
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__('Grid Style', 'halena'),
						'param_name' => 'cat_grid_style',
						'value' => array(
                            esc_html__( 'Masonry', 'halena') => 'masonry',
                            esc_html__( 'FitRows', 'halena') => 'fitRows',
						),
						'description' => esc_html__('Please select the display grid style for the category.', 'halena'),
						'std' => 'masonry'
					),

					array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Gutter', 'halena' ),
                        'param_name' => 'cat_gutter_value',
                        'description' => esc_html__( 'Enter the space you want to add between each item.', 'halena' ),
                        'std' => '0'
                    ),

					array(
                        'type' => 'checkbox',
                        'heading' => esc_html__( 'Ignore Category Thumbnail Settings', 'halena' ),
                        'param_name' => 'cat_thumbnail_individual_settings',
                        'value' => array( esc_html__( 'Yes', 'halena' ) => '1' ),
                        'description' => esc_html__( 'It will ignore the portfolio thumbnail width & height settings(if any).', 'halena' ),
                        'std' => ''
                    ),

					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Thumbnail size', 'halena' ),
						'param_name' => 'cat_thumbnail_size',
						'description' => esc_html__( 'choose image size', 'halena' ),
						'value' => array(   
							 esc_html__( 'Shop Catalog', 'halena') => 'shop_catalog',
							 esc_html__( 'medium', 'halena') => 'medium',
							 esc_html__( 'large', 'halena') => 'large',
							 esc_html__( 'Full', 'halena') => 'full',
							 esc_html__( 'Custom', 'halena') => 'custom',
						),
						'std' => 'shop_catalog'
					),

                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Thumbnails Crop Size', 'halena' ),
                        'param_name' => 'cat_thumbnail_dimension_custom',
                        'description' => esc_html__( 'Set the maximum width & height of a thumbnail. Note: it may not be an actual image size but the ratio will be the same.', 'halena' ),
                        'dependency' => array( 'element' => 'cat_thumbnail_size', 'value' => 'custom' ),
                        'std' => '400x400'
                    ),
                    array(
						'type' => 'dropdown',
						'heading' => esc_html__('Thumbnail Hover style', 'halena'),
						'param_name' => 'cat_thumbnail_hover_style',
						'value' => array(
                            esc_html__( 'Style 1', 'halena') => '1',
                            esc_html__( 'Style 2', 'halena') => '2',
						),
						'description' => esc_html__('Please select the hover style for the category.', 'halena'),
						'std' => '1'
					),

					array(
						'type' => 'textfield',
						'heading' => esc_html__('Number of Products to display', 'halena'),
						'param_name' => 'number',
						'description' => esc_html__('Mention the number of posts that you want to display!!.. -1 for infinite posts', 'halena'),
						'std' => '6'
					),
					array(
						'type' => 'checkbox',
						'heading' => esc_html__('Hide Empty Category', 'halena'),
                        'param_name' => 'hide_empty',
                        'value' => array( esc_html__( 'Yes', 'halena' ) => '1' ),
                        'description' => esc_html__( 'It will display the portfolio/blog items inside the carousel.', 'halena' ),
						'std' => '1'
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Order', 'halena' ),
						'param_name' => 'order',
						'value' => array(   
							 esc_html__( 'Descending ', 'halena') => 'DESC',
							 esc_html__( 'Ascending', 'halena') => 'ASC',
						),
						'std' => 'DESC'
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Order by', 'halena' ),
						'param_name' => 'order_by',
						'value' => array(                       
							 esc_html__( 'None', 'halena') => 'none',
							 esc_html__( 'ID', 'halena') => 'term_id',
							 esc_html__( 'Name', 'halena') => 'name',
							 esc_html__( 'Slug', 'halena') => 'slug',
							 esc_html__( 'Count', 'halena') => 'count',
							 esc_html__( 'Term Group', 'halena') => 'term_group',
							 esc_html__( 'Term order', 'halena') => 'term_order',

						),
						'std' => 'name'
					),
				)
			));
			vc_add_params( "agni_woo_products_categories", $elements_carousel_atts );
		}

		if(class_exists( 'AgniHalenaPlugin')){
			// Latest Works
			vc_map( array(
				'name' => esc_html__( 'Latest Works', 'halena' ),
				'base' => 'agni_widget_latestworks',
				'icon' => 'ion-ios-compose-outline',
				'weight' => '63',
				'category' => esc_html__( 'Agni Widgets', 'halena' ),
				'description' => esc_html__( 'Display widget for your webpage.', 'halena' ),
				'params' => array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Title:', 'halena' ),
						'param_name' => 'latest_works_title',
						'description' => esc_html__( 'Enter your title for the widget.', 'halena' ),
						'std' => esc_html__( 'Latest Works', 'halena' )
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Number of posts to show:', 'halena' ),
						'param_name' => 'latest_works_count',
						'description' => esc_html__( 'Enter number of portfolio items to display.' , 'halena' ),
						'std' => '5'
					),
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Show by category:', 'halena' ),
						'param_name' => 'latest_works_categories',
						'value' => $portfolio_options,
						'description' => esc_html__( 'Choose your desire categories to display. leave it unchecked for all.', 'halena' ),
						'std' => '',
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Extra class name', 'halena' ),
						'param_name' => 'class',
						'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'halena' ),
					),
				)
			) );

			// Latest Posts
			vc_map( array(
				'name' => esc_html__( 'Latest Posts', 'halena' ),
				'base' => 'agni_widget_latestposts',
				'icon' => 'ion-ios-compose-outline',
				'weight' => '60',
				'category' => esc_html__( 'Agni Widgets', 'halena' ),
				'description' => esc_html__( 'Display widget for your webpage.', 'halena' ),
				'params' => array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Title:', 'halena' ),
						'param_name' => 'latest_posts_title',
						'description' => esc_html__( 'Enter your title for the widget.', 'halena' ),
						'std' => esc_html__( 'Latest Posts', 'halena' )
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Number of posts to show:', 'halena' ),
						'param_name' => 'latest_posts_count',
						'description' => esc_html__( 'Enter number of blog posts to display.' , 'halena' ),
						'std' => '5'
					),
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Show by category:', 'halena' ),
						'param_name' => 'latest_posts_categories',
						'value' => $blog_options,
						'description' => esc_html__( 'Choose your desire categories to display. leave it unchecked for all.', 'halena' ),
						'std' => '',
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Extra class name', 'halena' ),
						'param_name' => 'class',
						'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'halena' ),
					),
				)
			) );
		}

		// Instagram
		vc_map( array(
			'name' => esc_html__( 'Instagram Feed', 'halena' ),
			'base' => 'agni_widget_instagram',
			'icon' => 'ion-ios-compose-outline',
			'weight' => '57',
			'category' => esc_html__( 'Agni Widgets', 'halena' ),
			'description' => esc_html__( 'Display widget for your webpage.', 'halena' ),
			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Title:', 'halena' ),
					'param_name' => 'instagram_title',
					'description' => esc_html__( 'Enter your title for the widget.', 'halena' ),
					'std' => esc_html__( 'Instagram', 'halena' )
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( '@username or #tag: ', 'halena' ),
					'param_name' => 'instagram_username',
					'std' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Number of photos:', 'halena' ),
					'param_name' => 'instagram_count',
					'std' => '6'
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Photo size:', 'halena' ),
					'param_name' => 'instagram_size',
					'value' => array(   
						 esc_html__( 'Thumbnail', 'halena') => 'thumbnail',
						 esc_html__( 'Small', 'halena') => 'small',
						 esc_html__( 'Large', 'halena') => 'large',
						 esc_html__( 'original', 'halena') => 'Original',
					),
					'std' => 'small'
				),
				array(
                    'type' => 'dropdown',
                    'heading' => esc_html__('Number of Columns', 'halena'),
                    'param_name' => 'instagram-columns',
                    'value' => array(   
                        esc_html__( '1 Column', 'halena') => '1',
                        esc_html__( '2 Columns', 'halena') => '2',
                        esc_html__( '3 Columns', 'halena') => '3',
                        esc_html__( '4 Columns', 'halena') => '4',
                        esc_html__( '5 Columns', 'halena') => '5',
                        esc_html__( '6 Columns', 'halena') => '6',
                    ),
                    'description' => esc_html__( 'Choose the column layout you would like to use.', 'halena' ),
                    'std' => '6'
                ),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Open links in:', 'halena' ),
					'param_name' => 'instagram_target',
					'value' => array(   
						 esc_html__( 'Same Window', 'halena') => '_self',
						 esc_html__( 'New Window', 'halena') => '_blank',
					),
					'std' => '_self'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Link text:', 'halena' ),
					'param_name' => 'instagram_followlink',
					'description' => esc_html__( 'Enter your text for the Instagram link.', 'halena' ),
					'std' => esc_html__( 'Follow Me', 'halena' )
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra class name', 'halena' ),
					'param_name' => 'class',
					'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'halena' ),
				),
			)
		) );
	
	}

	/*
	Shortcode logic how it should be rendered
	*/
	public static function agni_section_heading( $atts = null, $content = null ) {
		$atts = vc_map_get_attributes( 'agni_section_heading', $atts );
		extract( $atts );
		$icon = $heading = $subheading = $additional = $divide_line = $additional_class = $additional_attr = $heading_class = '';

		if($atts['responsive_font_size'] == 'yes'){
			$heading_class = 'section-heading-text_responsive';
		}

		if( !empty($atts['icon']) ){
			$icon = '<i class="section-heading-icon '.$atts['icon'].'" style="font-size:'.$atts['icon_size'].'px; color:'.$atts['icon_color'].'"></i>';
		}
		if( !empty($atts['heading']) ){
			$atts['heading_size'] = ( !empty($atts['heading_size']) )? 'style="font-size:'.$atts['heading_size'].'px;"':'';
			$heading = '<h2 class="section-heading-text '.$heading_class.'" '.$atts['heading_size'].'><span>'.$atts['heading'].'</span></h2>';
		}
		if( !empty($atts['sub_heading']) ){
			$atts['sub_heading_size'] = ( !empty($atts['sub_heading_size']) )? 'style="font-size:'.$atts['sub_heading_size'].'px;"':'';
			$subheading = '<h6 class="section-sub-heading-text" '.$atts['sub_heading_size'].'>'.$atts['sub_heading'].'</h6>';
		}
		if( !empty($atts['additional']) ){
			$atts['additional_size'] = ( !empty($atts['additional_size']) )? 'style="font-size:'.$atts['additional_size'].'px;"':'';
			$additional = '<p class="section-additional-heading-text" '.$atts['additional_size'].'>'.$atts['additional'].'</p>';
		}

		if( $atts['divide_line'] == 'yes'  ){
			$divide_line = '<div class="section-divide-line divide-line text-'.$atts['align'].'"><span style="width:'.( preg_match( '/(px|em|\%|pt|cm)$/', $atts['divide_line_width'] ) ? $atts['divide_line_width'] : $atts['divide_line_width'] . 'px' ).'; height:'.( preg_match( '/(px|em|\%|pt|cm)$/', $atts['divide_line_height'] ) ? $atts['divide_line_height'] : $atts['divide_line_height'] . 'px' ).'; background-color:'.$atts['divide_line_color'].'"></span></div>';
		}

		if( $atts['parallax'] == '1' ){
			$additional_class = ' has-parallax';
			$additional_attr = ' data-bottom-top="'.$atts['parallax_start'].'" data-top-bottom="'.$atts['parallax_end'].'"';
		}

		switch( $atts['display_order'] ){
			case 'hdai' :
				$output = $heading . $subheading . $divide_line . $additional . $icon ;
				break;
			case 'ahdi' :
				$output = $additional . $heading . $subheading . $divide_line . $icon ;
				break;
			case 'dhai' :
				$output = $divide_line . $heading . $subheading . $additional . $icon ;
				break;
			case 'idha' :
				$output = $icon . $divide_line . $heading . $subheading . $additional ;
				break;
			case 'ishda' :
				$output = $icon . $subheading . $heading . $divide_line . $additional ;
				break;
			case 'ishad' :
				$output = $icon . $subheading . $heading . $additional . $divide_line ;
				break;
			default :
				$output = $icon . $heading . $subheading . $divide_line . $additional ;
		}
		if( $atts['animation'] == '1' ){
			$output = '<div class="animate" data-animation="'.$atts['animation_style'].'" data-animation-offset="'.$atts['animation_offset'].'" style="animation-duration: '.$atts['animation_duration'].'s; 	animation-delay: '.$atts['animation_delay'].'s; 	-moz-animation-duration: '.$atts['animation_duration'].'s; 	-moz-animation-delay: '.$atts['animation_delay'].'s; 	-webkit-animation-duration: '.$atts['animation_duration'].'s; 	-webkit-animation-delay: '.$atts['animation_delay'].'s;">'.$output.'</div>';	
		}
		$output = '<div class="'.$atts['class'].$additional_class.' agni-section-heading text-'.$atts['align'].' '.$atts['display_order'].'" '.$additional_attr.'>'.$output.'</div>';
		
		return $output;

	}
	
	// Blockquote
	public static function agni_blockquote( $atts = null, $content = null ) {
		$atts = vc_map_get_attributes( 'agni_blockquote', $atts );
		extract( $atts );   
		
		$output = $reverse_class = $style = '';
		if( $atts['reverse'] == 'yes' ){
			$reverse_class= '-reverse'; 
		}

		if( !empty($atts['color']) ){
			$style = 'style="color:'.$atts['color'].' "';
		}

		if( !empty($atts['background_color']) ){
			$output = '<div class="agni-blockquote-container" style="background-color: '.$atts['background_color'].'" >';
		}

		$output .= '<blockquote class="'.$atts['class'].' agni-blockquote'.$reverse_class.'" '.$style .'><span style="color: '.$atts['quote_color'].'">'.$atts['quote'].'</span>' . wpb_js_remove_wpautop($content, true) . '</blockquote>'; 
		if( !empty($atts['background_color']) ){
			$output .= '</div>';
		}
		return $output;
	}

	// Dropcap
	public static function agni_dropcap( $atts = null, $content = null ) {
		$atts = vc_map_get_attributes( 'agni_dropcap', $atts );
		extract( $atts );   
		
		$output = do_shortcode( $content );

		$radius = '';
		if( !empty($atts['radius']) ){
			$radius = 'border-radius:'.( preg_match( '/(px|em|\%|pt|cm)$/', $atts['radius'] ) ? $atts['radius'] : $atts['radius'] . 'px' ).';';
		}

		if( $atts['dropcap_style'] == 'background' ){
			$dropcap_style = 'style="'.$radius.' background-color:'.$atts['background_color'].'; color:'.$atts['color'].'"';
		}
		else{
			$dropcap_style = 'style="'.$radius.' border-color:'.$atts['border_color'].'; color:'.$atts['color'].'"';
		}
		$output = '<p class="'.$atts['class'].' dropcap"><span '.$dropcap_style.'>'.$output[0].'</span>'. substr( $output, 1 ) .'</p>';
		return $output;
	}
	
	// separator
	public static function agni_separator( $atts = null, $content = null ) {
		$atts = vc_map_get_attributes( 'agni_separator', $atts );
		extract( $atts );   
		
		$text = $bg = $color = '';

		if( !empty($atts['color']) ){
			$color = 'style="color:'.$atts['color'].';"';
		}

		if( $atts['choice'] == 'text' && $atts['text'] != '' ){
			$text = '<p '.$color.'>'.$atts['text'].'</p>';          
		}
		else if( $atts['choice'] == 'icon' && $atts['icon'] != '' ){
			$text = '<i class="'.$atts['icon'].'" '.$color.'></i>';
		}
		if( !empty($atts['background_color']) ){
			$bg = 'background-color:'.$atts['background_color'].';';
		}
		$output = '<div class="'.$atts['class'].' separator separator_'.$atts['align'].'" style="width:'.( preg_match( '/(px|em|\%|pt|cm)$/', $atts['width'] ) ? $atts['width'] : $atts['width'] . '%' ).'; '.$bg.'">
					<span class="sep_holder sep_holder_l"><span style="border-top-style:'.$atts['style'].'; border-color:'.$atts['color'].'" class="sep_line"></span></span>
					'.$text.'
					<span class="sep_holder sep_holder_r"><span style="border-top-style:'.$atts['style'].'; border-color:'.$atts['color'].'" class="sep_line"></span></span>
				</div>';
		
		return $output;
	}
	
	// Call to action
	public static function agni_call_to_action( $atts, $content=null ){
		$atts = vc_map_get_attributes( 'agni_call_to_action', $atts );
		extract( $atts );   
		$size = $style = $heading = $additional = $button = $button_css = $icon_margin = $icon = '';    

		if( !empty($atts['icon_margin_top']) || !empty( $atts['icon_margin_bottom'] ) || !empty( $atts['icon_margin_right'] ) ){
			$icon_margin = 'style="';
			$icon_margin .= ( !empty($atts['icon_margin_top']) ) ? 'margin-top: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $atts['icon_margin_top'] ) ? $atts['icon_margin_top'] : $atts['icon_margin_top'] . 'px' ) . '; ' : '';
			$icon_margin .= ( !empty($atts['icon_margin_right']) ) ? 'margin-right: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $atts['icon_margin_right'] ) ? $atts['icon_margin_right'] : $atts['icon_margin_right'] . 'px' ) . '; ' : '';
			$icon_margin .= ( !empty($atts['icon_margin_bottom']) ) ? 'margin-bottom: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $atts['icon_margin_bottom'] ) ? $atts['icon_margin_bottom'] : $atts['icon_margin_bottom'] . 'px' ) . '; ' : '';
			$icon_margin .= '"';
		}
		
		if( $atts['icon'] != '' ){
			$icon = '<div class="call-to-action-icon" '.$icon_margin.'><i class="'.$atts['icon'].'"></i></div>';
		}

		if( $atts['size'] != '' ){
			$size = 'btn-'.$atts['size'].'';    
		}
		if( $atts['style'] != '' ){
			$style = 'btn-'.$atts['style']; 
		}

		if( !empty($atts['button_margin_top']) || !empty( $atts['button_margin_bottom'] ) || !empty($atts['radius']) ){
			$button_css = 'style="';
			$button_css .= ( !empty($atts['button_margin_top']) ) ? 'margin-top: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $atts['button_margin_top'] ) ? $atts['button_margin_top'] : $atts['button_margin_top'] . 'px' ) . '; ' : '';
			$button_css .= ( !empty($atts['button_margin_bottom']) ) ? 'margin-bottom: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $atts['button_margin_bottom'] ) ? $atts['button_margin_bottom'] : $atts['button_margin_bottom'] . 'px' ) . '; ' : '';
			$button_css .= ( !empty($atts['radius']) ) ? 'border-radius: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $atts['radius'] ) ? $atts['radius'] : $atts['radius'] . 'px' ) . '; ' : '';
			$button_css .= '"';
		}
		
		if( !empty( $atts['quote'] ) ){
			$heading_style = ( $atts['quote_size'] )?'style="font-size: '.$atts['quote_size'].'px;"':'';
			$heading = '<h2 class="call-to-action-heading" '.$heading_style.'>'.$atts['quote'].'</h2>';
		}
		if( !empty( $atts['additional_quote'] ) ){
			$additional_heading_style = ( $atts['additional_quote_size'] )?'style="font-size: '.$atts['additional_quote_size'].'px;"':'';
			$additional = '<p class="call-to-action-additional" '.$additional_heading_style.'>'.$atts['additional_quote'].'</p>';
		}
		if( !empty( $atts['value'] ) ){
			$button = do_shortcode('[agni_button class="call-to-action-button" value="'.$atts['value'].'" icon="'.$atts['btn_icon'].'" url="'.$atts['url'].'" target="'.$atts['target'].'" style="'.$atts['style'].'" border_radius="'.$atts['radius'].'" choice="'.$atts['choice'].'" size="'.$atts['size'].'" alignment="'.$atts['align'].'" ]'); 
		}

		$output = '<div class="'.$atts['class'].' call-to-action call-to-action-style-'.$atts['type'].' text-'.$atts['align'].'">'.$icon.'<div class="call-to-action-description">' . $heading . $additional .'</div>'. $button .'</div>';  
			
		return $output;
	}
	
	// icon
	public static function agni_icon($atts=null, $content=null ){
		$atts = vc_map_get_attributes( 'agni_icon', $atts );
		extract( $atts );
		$style = $icon_style = $radius = $width = $height = $font_size = $icon_has = $icon_transparent = $icon_location = '';

		$icon_tag = 'div';
		if( $atts['inline'] == 'yes' ){
			$icon_tag = 'span';
		}
		if( !empty($atts['icon_padding']) ){
			$style = 'style="padding:'.( preg_match( '/(px|em|\%|pt|cm)$/', $atts['icon_padding'] ) ? $atts['icon_padding'] : $atts['icon_padding'] . 'px' ).'; "';
		}
		
		if( !empty($atts['radius']) ){
			$radius = 'border-radius:'.( preg_match( '/(px|em|\%|pt|cm)$/', $atts['radius'] ) ? $atts['radius'] : $atts['radius'] . 'px' ).'; ';
		}
		if( !empty($atts['size']) ){
			$font_size = 'font-size:'.( preg_match( '/(px|em|\%|pt|cm)$/', $atts['size'] ) ? $atts['size'] : $atts['size'] . 'px' ).'; ';
		}
		if( !empty($atts['width']) ){
			$width = 'width:'.( preg_match( '/(px|em|\%|pt|cm)$/', $atts['width'] ) ? $atts['width'] : $atts['width'] . 'px' ).'; ';
		}
		if( !empty($atts['height']) ){
			$height = 'height:'.( preg_match( '/(px|em|\%|pt|cm)$/', $atts['height'] ) ? $atts['height'] : $atts['height'] . 'px' ).'; ';
		}

		$icon_style = 'style="'.$font_size.$radius.'color:'.$atts['color'].'; ';
		if( $atts['icon_style'] == 'background' ){
			$icon_style .= ''.$width.$height.''.$atts['icon_style'].'-color:'.$atts[$atts['icon_style'].'_color'].';  border-color:'.$atts[$atts['icon_style'].'_color'].';';
			$icon_has = 'icon-has-'.$atts['icon_style'].'';
		}
		if( $atts['icon_style'] == 'border' ){
			$icon_style .= ''.$width.$height.''.$atts['icon_style'].'-color:'.$atts[$atts['icon_style'].'_color'].'; ';
			$icon_has = 'icon-has-'.$atts['icon_style'].'';
		}
		$icon_style .= '"';

		// Hover style
		$hover_icon_style = $hover_radius = $hover_icon_has = '';
		if( !empty($atts['hover_radius']) ){
			$hover_radius = 'border-radius:'.( preg_match( '/(px|em|\%|pt|cm)$/', $atts['hover_radius'] ) ? $atts['hover_radius'] : $atts['hover_radius'] . 'px' ).'; ';
		}

		$hover_icon_style = 'style="'.$hover_radius.'color:'.$atts['hover_color'].'; ';
		if( $atts['icon_type'] == 'svg'){
			$hover_icon_style .= 'stroke:'.$atts['hover_color'].'; ';
		}
		if( $atts['hover_icon_style'] != '' ){
			$hover_icon_style .= ''.$atts['hover_icon_style'].'-color:'.$atts['hover_'.$atts['hover_icon_style'].'_color'].'; ';
			$hover_icon_has = 'hover-icon-has-'.$atts['hover_icon_style'].'';
		}
		$hover_icon_style .= '"';

		if( $icon_has == 'icon-has-border' && $hover_icon_has == 'hover-icon-has-background' ){ 
			$icon_transparent = 'icon-background-transparent';
		}

		$svg_icon_style =  'style="stroke:'.$atts['color'].'; '; 
		$svg_icon_style .= 'width:'.( preg_match( '/(px|em|\%|pt|cm)$/', $atts['size'] ) ? $atts['size'] : $atts['size'] . 'px' ).'; ';
		$svg_icon_style .=  '"'; 

		if( $atts['icon_type'] == 'svg'){
			wp_enqueue_script( 'halena-vivus-script' );
			if( $atts['svg_icon_type'] == 'svg_upload' ){
				//codes
				$icon_location = wp_get_attachment_url( $atts['svg_icon_upload'] );
			}else{
				$output = substr($atts['svg_icon'], 5);
				$output = str_replace('-', '_', $output);
				$icon_location = AGNI_FRAMEWORK_URL . '/css/svg/'.$output.'.svg';
			}
			$ran_id = rand(10000, 99999);
			$output = '<span class="svg-icon-container '.$icon_has.' '.$hover_icon_has.'" '.$icon_style.'><span id="agni-svg-icon-'.$ran_id.'" class="agni-svg-icon" '.$svg_icon_style.' data-file="'.$icon_location.'"></span></span>';
		}
		else{
			$output = '<i class="'.$atts['icon'].' '.$icon_has.' '.$hover_icon_has.'" '.$icon_style.'></i>';
		}

		if( !empty($atts['url']) ){
			$output = '<a href="'.$atts['url'].'">'.$output.'</a>';
		}
		$output = '<'.$icon_tag.' class="'.$atts['class'].' agni-icon has-'.$icon_type.' '.$icon_transparent.'" '.$style.'><span class="agni-icon-container" '.$hover_icon_style.'>'.$output.'</span></'.$icon_tag.'>';
		
		return $output;
	}
		
	// Services
	public static function agni_service($atts=null, $content=null ){
		$atts = vc_map_get_attributes( 'agni_service', $atts );
		extract( $atts );
		
		$output = $service_has = $icon = $heading = $description = $divideline = $button = $btn_style = $btn_radius = $bg_style = $service_padding_style = $service_bg_class = $service_animation_class = $service_animation_attr = $service_animation_style = '';

		if( $atts['text_i_icon'] == '1' ){
			$icon = do_shortcode('[agni_icon icon_type="'.$atts['icon_type'].'" icon="'.$atts['icon'].'" svg_icon_type="'.$atts['svg_icon_type'].'" svg_icon="'.$atts['svg_icon'].'" svg_icon_upload="'.$atts['svg_icon_upload'].'" size="'.$atts['size'].'" url="'.$atts['url'].'" icon_style="'.$atts['icon_style'].'" width="'.$atts['width'].'" height="'.$atts['height'].'" radius="'.$atts['radius'].'" background_color="'.$atts['background_color'].'" border_color="'.$atts['border_color'].'" color="'.$atts['color'].'" hover_icon_style="'.$atts['hover_icon_style'].'" hover_radius="'.$atts['hover_radius'].'" hover_background_color="'.$atts['hover_background_color'].'" hover_border_color="'.$atts['hover_border_color'].'" hover_color="'.$atts['hover_color'].'" inline=""]');
		}
		else{
			$atts['text_size'] = ($atts['text_size'])?'font-size:'.$atts['text_size'].'px;':'';
			$atts['text_color'] = ($atts['text_color'])?'color:'.$atts['text_color'].';':'';
			if( !empty($atts['text_size']) || !empty($atts['text_color']) ){
				$text_style = 'style="'.$atts['text_size'].$atts['text_color'].'"';
			}
			$icon = ( $atts['text'] != '' )? '<h5 class="service-box-text" '.$text_style.'>'.$atts['text'].'</h5>' : '';
		}

		$atts['title_color'] = ($atts['title_color'])?'color:'.$atts['title_color'].';':'';
		if( !empty($atts['title']) ){
			$heading = '<h6 class="service-box-heading" style="font-size:'.$atts['title_size'].'px; '.$atts['title_color'].'">'.$atts['title'].'</h6>';
		}

		$atts['description_color'] = ($atts['description_color'])?'style = "color:'.$atts['description_color'].';"':'';
		$description = '<div class="service-box-description" '.$atts['description_color'].'>'.wpb_js_remove_wpautop($content, true).'</div>';
		if( $atts['divide_line'] == '1' ){
			$atts['divide_line_color'] = (!empty($atts['divide_line_color']))?'style="background-color:'.$atts['divide_line_color'].'"':'';
			$divideline = '<div class="divide-line text-'.$atts['align'].'"><span '.$atts['divide_line_color'].'></span></div>';
		}
		if( !empty( $atts['btn_value'] ) ){
			if( $atts['btn_style'] != '' ){
				$btn_style = 'btn-'.$atts['btn_style']; 
			}
			if( $atts['btn_radius'] != '' ){
				$btn_radius = 'style = "border-radius:'.( preg_match( '/(px|em|\%|pt|cm)$/', $atts['btn_radius'] ) ? $atts['btn_radius'] : $atts['btn_radius'] . 'px' ).'; "';  
			}
			$button = '<div class="service-box-btn"><a class="btn '.$btn_style.' btn-'.$atts['btn_choice'].' btn-sm" href="'.$atts['btn_url'].'" '.$btn_radius.'> '.$atts['btn_value'].'</a></div>';
		}

		if( !empty($atts['bg_choice']) ){
			if( !empty($atts['bg_color']) ){
				$bg_style = 'background-color: ' . $atts['bg_color'] . '; ';
				$service_bg_class = 'service-has-background-color ';
			}
			else if( !empty($atts['bg_image']) ){
				$bg_style .= 'background-image: url(\'' . wp_get_attachment_url($atts['bg_image']) . '\'); ';
				$service_bg_class = 'service-has-background-image ';
			}
			else {
				$bg_style = 'border-color: ' . $atts['bg_border_color'] . '; ';
				$service_bg_class = 'service-has-border ';
			}

		}
		if( !empty( $atts['service_padding'] ) ){
			$service_padding_style = 'padding: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $atts['service_padding'] ) ? $atts['service_padding'] : $atts['service_padding'] . 'px' ) . '; ';
		}
		if( !empty($bg_style) || !empty($service_padding_style) ){
			$bg_style .= $service_padding_style;
			$service_padding_style = 'style="'.$service_padding_style.'"';
		}


		switch( $atts['choice'] ){
			case '1':
				$service_align = $atts['align'];
				$output = $icon.$heading.$divideline.$description.$button;
				break;          
			case '2': 
				$service_align = $atts['service_2_align'];
				$output = '<div class="service-box-style-'.$atts['choice'].'-icon">
						'.$icon.'
					</div>
					<div class="service-box-style-'.$atts['choice'].'-text">
						'.$heading.$divideline.$description.$button.'
					</div>';
				break;
			case '3':         
				$service_align = $atts['align'];  
				$output = '<div class="service-box-style-'.$atts['choice'].'-icon">
						'.$icon.$divideline.$heading.'
					</div>
					<div class="service-box-style-'.$atts['choice'].'-text" '.$service_padding_style.'>
						'.$description.$button.'
					</div>';
				break;
			
		}

		if( $atts['animation'] == '1' ){
			$service_animation_class = ' animate';
			$service_animation_attr = 'data-animation="'.$atts['animation_style'].'" data-animation-offset="'.$atts['animation_offset'].'"';
			$service_animation_style = 'animation-duration: '.$atts['animation_duration'].'s; animation-delay: '.$atts['animation_delay'].'s; -webkit-animation-duration: '.$atts['animation_duration'].'s; -webkit-animation-delay: '.$atts['animation_delay'].'s';
			$bg_style .= $service_animation_style;
		}

		if( !empty($bg_style) ){
			$bg_style = 'style="'.$bg_style.'"';
		}

		$output = '<div class="'.$atts['class'].' service-box service-box-style-'.$atts['choice'].' text-'.$service_align.' '.$service_bg_class.$service_has.$service_animation_class.'" '.$bg_style.' '.$service_animation_attr.'>
			'.$output.'
		</div>';
		
		return $output;
		
	}
	
	//pricing table
	public static function  agni_pricingtable($atts = null, $content = null){
		$atts = vc_map_get_attributes( 'agni_pricingtable', $atts );
		extract( $atts );   
		
		$design_css = $pricing_cost_details_css = $pricing_style_3_additional_bg = $pricing_title_css = $pricing_interval_css = $has_absolute_btn = '';
		
		// Processing css
		$design_css_array = array_filter( agni_space_atts_processor( $atts ) );
		if( !empty($design_css_array[0]) || !empty($design_css_bg) ){
			$design_css .= ' style="';
			$design_css .= !empty($design_css_array[0])?$design_css_array[0]:'';
			$design_css .= $design_css_bg.'"';
		}
		if( !empty($design_css_array[0]) ){
			$design_css .= ' data-css-default="'.$design_css_array[0].'"';
		}
		if( !empty($design_css_array[1]) ){
			$design_css .= ' data-css-tab="'.$design_css_array[1].'"';
		}
		if( !empty($design_css_array[2]) ){
			$design_css .= ' data-css-mobile="'.$design_css_array[2].'"';
		}
		if( !empty($design_css_bg) ){
			$design_css .= ' data-css-existing="'.$design_css_bg.'"';
		}


		if( !empty($atts['pricing_bg_color']) ){
			$pricing_cost_details_css = 'style="background-color:'.$atts['pricing_bg_color'].'"';
			if( $atts['pricing_style'] == '3' ){
				$pricing_style_3_additional_bg = '<div class="pricing-cost-details-bg" '.$pricing_cost_details_css.'></div>';
			}
			
		}

		if( !empty($atts['heading']) ){

			$pricing_title_css = ( !empty($atts['pricing_heading_color']) )?'style="color:'.$atts['pricing_heading_color'].'"':'';
			$atts['heading'] = '<h6 class="pricing-title" '.$pricing_title_css.'>'.$atts['heading'].'</h6>';
		}
		if( !empty($atts['interval']) ){
			$pricing_interval_css = ( !empty($atts['pricing_interval_color']) )?'style="color:'.$atts['pricing_interval_color'].'"':'';
			$atts['interval'] = '<span class="pricing-interval" '.$pricing_interval_css.'>'.$atts['interval'].'</span>';
		}

		if( !empty($atts['value']) ){
			$btn_style = $style = $size = $radius = $btn_position = '';
			if( $atts['size'] != '' ){
				$size = ' btn-'.$atts['size'];  
			}
			if( $atts['style'] != '' ){
				$btn_style = ' btn-'.$atts['style'];
			}
			if( !empty($atts['radius']) ){
				$radius = 'border-radius:'.( preg_match( '/(px|em|\%|pt|cm)$/', $atts['radius'] ) ? $atts['radius'] : $atts['radius'] . 'px' ).';';
			}
			if( $radius != '' ){
				$style = 'style="'.$radius.'"';
			}
			if( $atts['position'] != '' && $atts['pricing_style'] == '1' ){
				$btn_position = ' btn-'.$atts['position'];
				$has_absolute_btn = ($atts['position'] == 'absolute-middle')?' has-absolute-middle-btn':' has-absolute-bottom-btn';
			}

			$atts['value'] = '<div class="pricing-button '.$btn_position.'"><a class="btn'.$btn_style.$size.' btn-'.$atts['choice'].'" target="'.$atts['target'].'" href="'.$atts['url'].'" '.$style.'>'.$atts['value'].'</a></div>';
		}

		if( !empty($atts['price_color']) ){
			$atts['price_color'] = 'style="color:'.$atts['price_color'].'"';
		}
		
		$output= '<div class="'.$atts['class'].' agni_custom_design_css pricing-table-content pricing-style-'.$atts['pricing_style'].''.$has_absolute_btn.'" '.$design_css.'>
			'.$pricing_style_3_additional_bg.'
			<div class="pricing-cost-details" '.$pricing_cost_details_css.'>
				'.$atts['heading'].'
				<h2 class="pricing-cost" '.$atts['price_color'].'>'.$atts['price'].$atts['interval'].'</h2>
			</div>
			<div class="pricing-feature-details">
				'.wpb_js_remove_wpautop($content, true).$atts['value'].'                
			</div>
		</div>';
		return $output;
	}
	
	// Milestone
	public static function  agni_milestone($atts = null, $content = null){
		$atts = vc_map_get_attributes( 'agni_milestone', $atts );
		extract( $atts );
		
		wp_enqueue_script( 'halena-countup-script' );

		$align = $mile_icon = '';

		if( !empty( $atts['icon'] ) ){
			$mile_icon = '<div class="mile-icon" style="color:'.$atts['icon_color'].'; font-size: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $atts['icon_size'] ) ? $atts['icon_size'] : $atts['icon_size'] . 'px' ) . '; '.'">
				<i class="'.$atts['icon'].'"></i>                                       
			</div>';
		}
		
		$output = '<div class="'.$atts['class'].' mile-content text-'.$atts['align'].' milestone-style-'.$atts['style'].' '.$atts['dark_mode'].'">
			'.$mile_icon.'
			<div class="mile-description">
				<div class="mile-count">
					<h4 class="count '.$atts['mile_font_choice'].'" style="font-size: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $atts['mile_font_size'] ) ? $atts['mile_font_size'] : $atts['mile_font_size'] . 'px' ) . '; '.'" data-count="'.$atts['mile'].'" data-count-animation="'.$atts['count'].'" data-sep="'.$atts['mile_separator'].'" data-pre="'.$atts['mile_prefix'].'" data-suf="'.$atts['mile_suffix'].'" data-animation-offset="'.$atts['animation_offset'].'" >'.$atts['mile'].'</h4>
				</div>
				<div class="mile-title">
					<p>'.$atts['title'].'</p>
				</div>
			</div>
		</div>';
				
		return $output;

	}
	
	// Progress bar
	public static function  agni_progressbar($atts = null, $content = null){
		$atts = vc_map_get_attributes( 'agni_progressbar', $atts );
		extract( $atts );
		
		$percent_1 = $percent_2 = $style = '';
		if( $atts['style'] == '1' ){
			$percent_1 = '<span class="progress-percentage">'.$atts['percentage'].'%</span>';
		}
		else{
			$percent_2 = '<h2 class="progress-percentage">'.$atts['percentage'].'%</h2>';
		}

		$output= '<div class="'.$atts['class'].' progress-bar-style-'.$atts['style'].'">
			'.$percent_2.'
			<div class="progress-bar-container">
				<p class="progress-heading">' . $atts['title'] . $percent_1 .'</p>
				<div class="progress" style="background-color:'.$atts['track_color'].';">
					<div class="progress-bar progress-bar-animate" style="background-color:'.$atts['bar_color'].'" role="progressbar" aria-valuenow="'.$atts['percentage'].'" aria-valuemin="0" aria-valuemax="100"  data-animation-offset="'.$atts['animation_offset'].'" >
						<span class="sr-only">'.$atts['percentage'].'% Complete</span>
					</div>
				</div>
			</div>
		</div>';
		
		return $output;
	}

	// Circle bar
	public static function  agni_circlebar($atts = null, $content = null){
		$atts = vc_map_get_attributes( 'agni_circlebar', $atts );
		extract( $atts );

		wp_enqueue_script( 'halena-easypiechart-script' );
		
		if( $atts['style'] == '1' ){
			$circle_content = '<p class="percent circle-bar-content"></p>';
		}
		else{
			$circle_content = '<p class="circle-bar-icon circle-bar-content"><i class="'.$atts['icon'].'"></i></p>';
		}

		$output= '<div class="'.$atts['class'].' circle-bar chart text-'.$atts['align'].'"  data-animation-offset="'.$atts['animation_offset'].'"  data-percent="'.$atts['percentage'].'" data-barcolor="'.$atts['bar_color'].'" data-trackcolor="'.$atts['track_color'].'" data-scalecolor="'.$atts['scale_color'].'" data-animation="'.$atts['animation'].'" data-scalelength="'.$atts['scale_length'].'" data-linewidth="'.$atts['line_width'].'" data-linecap="'.$atts['line_cap'].'" data-size="'.$atts['size'].'" style="width:'.$atts['size'].'px; height:'.$atts['size'].'px; line-height:'.$atts['size'].'px;">
			'.$circle_content.'
		</div>';
		
		return $output;
	}
	
	// list
	public static function agni_list( $atts = null, $content = null ) {
		$atts = vc_map_get_attributes( 'agni_list', $atts );
		extract( $atts );
		
		$radius = $icon = $icon_style = '';
		if( !empty($atts['radius']) ){
			$radius = 'border-radius:'.( preg_match( '/(px|em|\%|pt|cm)$/', $atts['radius'] ) ? $atts['radius'] : $atts['radius'] . 'px' ).';';
		}

		if( $atts['icon_style'] != '' ){
			$icon_style = 'style="'.$radius.' '.$atts['icon_style'].'-color:'.$atts[$atts['icon_style'].'_color'].'; color:'.$atts['color'].'"';
			$icon_has = 'icon-has-'.$atts['icon_style'].'';
		}
		else{
			$icon_style = 'style="color:'.$atts['color'].'"';
			$icon_has = '';
		}
		if( !empty($atts['icon']) ){
			$icon = '<i class="'.$atts['icon'].' '.$icon_has.'" '.$icon_style.'></i>';
		}

		$output = str_replace( '<li>', '<li>'.$icon, wpb_js_remove_wpautop($content, true) );
		return str_replace( '<ul>','<ul class="list '.$atts['class'].'">', $output );
	}



	// button
	public static function agni_button( $atts = null, $content = null ) {
		$atts = vc_map_get_attributes( 'agni_button', $atts );
		extract( $atts );
		
		$output = $btn_style = $style = $size = $margin = $icon = $no_btn = $additional_class = $additional_attr = $design_css = ''; 

		// Processing css
		$design_css_array = array_filter( agni_space_atts_processor( $atts ) );
		if( !empty($design_css_array[0]) ){
			$design_css .= ' style="'.$design_css_array[0].'" data-css-default="'.$design_css_array[0].'"';
		}
		if( !empty($design_css_array[1]) ){
			$design_css .= ' data-css-tab="'.$design_css_array[1].'"';
		}
		if( !empty($design_css_array[2]) ){
			$design_css .= ' data-css-mobile="'.$design_css_array[2].'"';
		}
		//$btn_url = $atts['url'];

		if( $atts['icon'] != '' ){
			$icon = '<i class="'.$atts['icon'].'"></i>';
		}
		if( $atts['size'] != '' ){
			$size = ' btn-'.$atts['size'];  
		}
		if( $atts['style'] != '' ){
			$btn_style = ' btn-'.$atts['style'];
		}
		if( $atts['value'] == '' ){
			$no_btn = ' no-btn-text';
		}

		if( $atts['responsive_button'] == '1' ){
			$additional_class .= ' agni-button-responsive';
		}

		if( $atts['parallax'] == '1' ){
			$additional_class .= ' has-parallax';
			$additional_attr = ' data-bottom-top="'.$atts['parallax_start'].'" data-top-bottom="'.$atts['parallax_end'].'"';
		}

		$output = $atts['value'].$icon;

		if( $atts['modal'] == '1' ){
			wp_enqueue_style('halena-photoswipe-style'); 
			wp_enqueue_script('halena-photoswipe-script'); 

			$additional_class .= ' custom-video-link';
			$additional_attr .= ' data-modal=\''.trim( vc_value_from_safe( $atts['modal_src'] ) ).'\'';
			$output = '<button class="agni_custom_design_css btn'.$btn_style.$size.' btn-'.$atts['choice'].'" '.$design_css.' '.$additional_attr.'>'.$output.'</button>';
		}
		else{	
			$output = '<a class="agni_custom_design_css btn'.$btn_style.$size.' btn-'.$atts['choice'].'" target="'.$atts['target'].'" href="'.$atts['url'].'" '.$design_css.' '.$additional_attr.'>'.$output.'</a>';
		}
		
		if( $atts['animation'] == '1' ){
			$output = '<div class="animate" data-animation="'.$atts['animation_style'].'" data-animation-offset="'.$atts['animation_offset'].'" style="animation-duration: '.$atts['animation_duration'].'s; 	animation-delay: '.$atts['animation_delay'].'s; 	-moz-animation-duration: '.$atts['animation_duration'].'s; 	-moz-animation-delay: '.$atts['animation_delay'].'s; 	-webkit-animation-duration: '.$atts['animation_duration'].'s; 	-webkit-animation-delay: '.$atts['animation_delay'].'s;">'.$output.'</div>';	
		}

		$output = '<div class="'.$atts['class'].$additional_class.' agni-button '.$atts['inline'].$no_btn.' text-'.$atts['alignment'].' page-scroll">'.$output.'</div>';
		
		return $output;
	}
	
	// Alerts
	public static function agni_alerts( $atts = null, $content = null ) {
		$atts = vc_map_get_attributes( 'agni_alerts', $atts );
		extract( $atts );
			
		if($atts['dismissable'] == 'yes'){
			$output = '<div class="'.$atts['class'].' alert alert-'.$atts['choice'].' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.wpb_js_remove_wpautop($content, true).'</div>';  
		}
		else{
			$output = '<div class="'.$atts['class'].' alert alert-'.$atts['choice'].'">'.wpb_js_remove_wpautop($content, true).'</div>';    
		}
		
		return $output;
	}
	
	// Image
	public static function agni_image( $atts = null, $content = null ) {
		$atts = vc_map_get_attributes( 'agni_image', $atts );
		extract( $atts );

		$grayscale = $img_link = $lightbox = $img_style = $beforeafter_class = $caption = $caption_after = $img_css = '';
		$animation = $atts['animation'];
		$animation_style = $atts['animation_style'];
		$animation_delay = $atts['animation_delay'];
		$animation_duration = $atts['animation_duration'];
		$animation_offset = $atts['animation_offset'];

		$img_css .= ( !empty($atts['background_color']) ) ? 'background-color: ' . $atts['background_color'] . '; ' : $img_css;
		$img_css .= ( !empty($atts['border_color']) ) ? 'border-color: ' . $atts['border_color'] . '; ' : $img_css;
		$img_css .= ( !empty($atts['radius']) ) ? 'border-radius: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $atts['radius'] ) ? $atts['radius'] : $atts['radius'] . 'px' ) . '; ' : $img_css;
		$img_css .= ( !empty($atts['img_width']) ) ? 'width: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $atts['img_width'] ) ? $atts['img_width'] : $atts['img_width'] . 'px' ) . '; ' : $img_css;
		if( !empty($img_css) ){
			$img_css = 'style="'.$img_css.'"';
		}

		if( $atts['img_style'] !== '' ){
			$img_style = 'image-has-'.$atts['img_style'].'';
		}
		
		$img_id = preg_replace( '/[^\d]/', '', $atts['img_url'] );
		
		if( $atts['img_size'] == 'custom' ){
			$atts['img_size'] = $atts['img_size_custom'];
		}
		$img = wpb_getImageBySize( array(
			'attach_id' => $img_id,
			'thumb_size' => $atts['img_size'],
			'class' => 'fullwidth-image attachment-'.$atts['img_size'] .' '. $img_style.''
		) );

		if( !empty($atts['img_after_url']) ){
			$img_aft_id = preg_replace( '/[^\d]/', '', $atts['img_after_url'] );
			$img_after = wpb_getImageBySize( array(
				'attach_id' => $img_aft_id,
				'thumb_size' => $atts['img_size'],
				'class' => 'fullwidth-image attachment-'.$atts['img_size'] .' '. $img_style.''
			) );
		}

		if( $atts['img_type'] == 'beforeafter' ){
			wp_enqueue_style( 'halena-beforeafter-style' );
			wp_enqueue_script( 'halena-beforeafter-script' );
			$beforeafter_class = ' ba-slider';
		}
		
		if( $atts['img_link'] == '4' ){
			$img_link = $atts['img_custom_link'];
		}
		else{
			$img_link = wp_get_attachment_url( $atts['img_url'] );
		}   

		if( $atts['img_link'] == '3' ){
			//$lightbox = 'class="custom-image"';
			wp_enqueue_style('halena-photoswipe-style'); 
			wp_enqueue_script('halena-photoswipe-script'); 

			$lightbox = ' custom-image';
		}

		$html = $img['thumbnail'];


		$img['thumbnail'] = str_replace( '<img ', '<img '.$img_css.' ', $img['thumbnail'] );
		if( $atts['img_link'] != '1' ){
			$img_data = wp_get_attachment_image_src($img_id, 'full' );
			$html = '<a href="'.$img_link.'" target="'.$atts['img_custom_link_target'].'" data-size="'.$img_data[1].'x'.$img_data[2].'">'.$img['thumbnail'].'</a>';
		}
		else{
			$html = $img['thumbnail'];
		}
		if($atts['img_gs_filter']){ 
            $grayscale = ' has-grayscale'; 
        }

		if ( !empty($atts['img_caption']) ) {
			$post = get_post( $img_id );
			$caption = $post->post_excerpt;
			if( !empty($img_aft_id) ){
				$post_after = get_post( $img_aft_id );
				$caption_after = $post_after->post_excerpt;
			}
		}

		$html = '
			<figure class="agni-image-figure">
				' . $html . '
				<figcaption class="vc_figure-caption">' . esc_html( $caption ) . '</figcaption>
			</figure>
		';

		if( !empty($img_after) && $atts['img_type'] == 'beforeafter' ){
			$img_after['thumbnail'] = str_replace( '<img ', '<img '.$img_css.' ', $img_after['thumbnail'] );
			$html .= '<div class=" resize">
		    	<figure class="agni-image-figure">
		    		'.$img_after['thumbnail'].'
		       		<figcaption class="vc_figure-caption">'.$caption_after.'</figcaption>
		       </figure>
		   </div>
		   <span class="handle"><span><i class="fa fa-arrows-h"></i></span></span>';
		}
		else if( $atts['img_type'] == 'swapimage' ){
			$img_after['thumbnail'] = str_replace( '<img ', '<img '.$img_css.' ', $img_after['thumbnail'] );
			$html .= '
		    	<figure class="agni-image-figure active">
		    		'.$img_after['thumbnail'].'
		       		<figcaption class="vc_figure-caption">'.$caption_after.'</figcaption>
		       </figure>';

		    $html = '<div class="agni-swapimage-container">
		    	'.$html.'
		    	</div>
		    	<span class="agni-swapimage-icon"><i class="icon-arrows-switch-horizontal"></i></span>';   
		   
		}

		$output = '<div class="'.$atts['class'].' agni-image custom-image-container agni-image-'.$atts['img_type'].' text-'.$atts['alignment'].$grayscale.$beforeafter_class.$lightbox.'">';
		if( $animation == '1' ){
			$output .= '<div class="animate" data-animation="'.$animation_style.'" data-animation-offset="'.$animation_offset.'" style="animation-duration: '.$animation_duration.'s;     animation-delay: '.$animation_delay.'s;     -moz-animation-duration: '.$animation_duration.'s;  -moz-animation-delay: '.$animation_delay.'s;    -webkit-animation-duration: '.$animation_duration.'s;   -webkit-animation-delay: '.$animation_delay.'s; ">';    
		}
		if( $atts['parallax'] == '1' ){
			$output .= '<div class="image-has-parallax" data-bottom-top="'.$atts['parallax_start'].'" data-top-bottom="'.$atts['parallax_end'].'">';
		}
		$output .= $html;
		if( $atts['parallax'] == '1' ){
			$output .= '</div>';
		}
		if( $animation == '1' ){
			$output .= '</div>';    
		}
		$output .= '</div>';

		return $output;
	}
	
	// Gallery
	public static function agni_gallery( $atts = null, $content = null ) {
		$atts = vc_map_get_attributes( 'agni_gallery', $atts );
		extract( $atts );


		$carousel_nav = $carousel_atts = $carousel_container_class = $gallery_class = $columns = $gallery_autoplay = $gallery_autoplay_timeout = $gallery_autoplay_hover = $gallery_loop = $gallery_autoheight = $gallery_center = $gallery_pagination = $gallery_row_attr = $gallery_column_padding = $gallery_row_margin = $gallery_lightbox = $grayscale = $img = $img_array = $gallery_grid_sizer = $gallery_row_css = $gallery_height = '';
		
			/*switch( $atts['columns'] ){
				case '1' :
					$columns = 'col-xs-12 col-sm-12 col-md-12 ';
					break;
				case '2' :
					$columns = 'col-xs-12 col-sm-12 col-md-6 ';
					break;
				case '3' :
					$columns = 'col-xs-12 col-sm-6 col-md-4 ';
					break;
				case '4' :
					$columns = 'col-xs-12 col-sm-4 col-md-3 ';
					break;
				case '5' :
					$columns = 'col-xs-6 col-sm-4 col-md-2_5 ';
					break;
				case '6' :
					$columns = 'col-xs-6 col-sm-4 col-md-2 ';
					break;
			}*/
			$gallery_row_attr = 'data-grid-layout="'.$atts['gallery-grid-layout'].'"';
			$atts['gap'] = ($atts['gap'] == '')?0:$atts['gap'];
			$gallery_column_padding = 'padding: 0 '.($atts['gap']/2).'px '.$atts['gap'].'px; ';
			$gallery_row_margin = 'margin: 0 -'.($atts['gap']/2).'px -'.$atts['gap'].'px; ';


		//if( $atts['gallery-grid-layout'] == 'masonry' ){
			wp_enqueue_script( 'halena-isotope-script' );

		//}
		if( $atts['carousel'] == '1' ){

            wp_enqueue_style( 'halena-slick-style' );
            wp_enqueue_script( 'halena-slick-script' );
                
			$gallery_class .= ' agni-carousel';
			$carousel_container_class = ' agni-carousel-container';

			if( $atts['carousel_type'] == 'bg-carousel' ){
				$gallery_height = 'height:'.( preg_match( '/(px|em|\%|pt|cm)$/', $atts['carousel_height'] ) ? $atts['carousel_height'] : $atts['carousel_height'] . 'px' ).'; ';
			}

			$atts['cat_thumbnail_individual_settings'] = '1';
			if( $atts['carousel_dots'] == '1' || $atts['carousel_arrows'] == '1' ){
				$carousel_nav = '<div class="slick-nav"></div>';
			}
			$carousel_atts = agni_carousel_atts_processor( $atts );
			if( is_rtl() ){
				$carousel_atts .= 'data-rtl="true"';
			}
			else{
				$carousel_atts .= 'data-rtl="false"';
			}
		}
		else{
			$gallery_grid_sizer = '<div class="grid-sizer agni-gallery-column '.$columns.'"></div>';
		}

		if( !empty($gallery_row_margin) ){
			$gallery_row_css = 'style="'.$gallery_row_margin.'"';
		}

		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $columns .'custom-gallery-item agni-gallery-column' , 'agni_gallery', $atts );
		
		if( $atts['img_link'] == '3' ){
			wp_enqueue_style('halena-photoswipe-style'); 
			wp_enqueue_script('halena-photoswipe-script'); 

			$gallery_lightbox = 'custom-gallery';
		}

		if($atts['img_gs_filter']){ 
            $grayscale = 'has-grayscale '; 
        }

		$slides = array_filter( explode(",", $atts['img_url']) );
		$src1 = $caption = '';
		$i = $delay = 0; 
		foreach( (array) $slides as $key => $slide_id ){
			$gallery_animation_class = $gallery_animation_attr = $gallery_animation_style = '';

			$attachment_image = get_post( $slide_id );
				$attachment_info = get_post( $slide_id );
			if ( !empty($atts['img_caption']) ) {
				$caption = '<figcaption>'.$attachment_info->post_excerpt.'</figcaption>';
			}
			
			if( $atts['img_size'] == 'custom' ){
				$img_array = wpb_getImageBySize( array(
					'attach_id' => $slide_id,
					'thumb_size' => $atts['img_size_custom'],
					'class' => 'fullwidth-image attachment-'.$atts['img_size_custom'] .' ',
				) );

				$img = $img_array['thumbnail'];
			}
			else{
				if( $atts['carousel_type'] == 'bg-carousel' ){
					$img = '<div class="agni-gallery-figure-bg" style="background-image:url('.wp_get_attachment_url( $slide_id ).');"></div>';
				}
				else{
					$img = wp_get_attachment_image( $slide_id, $atts['img_size'] );
				}
			}
			
			if( $atts['img_link'] != '1' ){
				$img_data = wp_get_attachment_image_src( $slide_id, 'full' );
				$img = '<a href="'.wp_get_attachment_url( $slide_id ).'" data-size="'.$img_data[1].'x'.$img_data[2].'">'. $img.'</a>';
			}

			$src1 .= '<div class="'.$gallery_animation_class.$grayscale.$css_class.'" style="'.$gallery_height.$gallery_column_padding.$gallery_animation_style.'" '.$gallery_animation_attr.'><figure class="agni-gallery-figure">';
			$src1 .= $img;
			$src1 .= $caption;
			$src1 .= '</figure></div>';
		
		}
		
		$output = '<div class="agni-gallery '.$atts['carousel_type'].' '.$gallery_lightbox.' '.$carousel_container_class.'"><div class="agni-gallery-row row agni-gallery-'.$atts['columns'].'-column '.$gallery_class.' '. $atts['class'].'" '.$gallery_row_attr.$carousel_atts.' '.$gallery_row_css.'>'.$src1.$gallery_grid_sizer.'</div>'.$carousel_nav.'</div>';
			
		return $output;
	}

	// Fancy Image
	public static function agni_fancy_image( $atts = null, $content = null ) {
		$atts = vc_map_get_attributes( 'agni_fancy_image', $atts );
		extract( $atts );

		$values = vc_param_group_parse_atts( $atts['values'] );
		$data = array();
		$heading_class = $img_col = $row_gutter_css = $col_gutter_css = $heading = $divideline = $description = $button = '';

		$title_color = ($atts['title_color'])?'color:'.$atts['title_color'].';':'';
		if( !empty($atts['title']) ){
			if( !empty($atts['title_responsive']) ){
				$heading_class = ' agni-fancy-title-responsive';
			}
			$heading = '<h2 class="agni-fancy-title'.$heading_class.'" style="font-size:'.$atts['title_size'].'px; '.$title_color.'"><span>'.$atts['title'].'</span></h2>';
		}

		if( !empty($atts['description']) ){
			$description_font_size = ($atts['description_size'])?' font-size:'.$atts['description_size'].'px;"':'';
			$description_color = ($atts['description_color'])?' color:'.$atts['description_color'].';':'';
			$description = '<div class="agni-fancy-description" style = "'.$description_font_size.$description_color.'">'.$atts['description'].'</div>';
		}

		if( $atts['divide_line'] == '1' ){
			$divide_line_color = (!empty($atts['divide_line_color']))?'style="background-color:'.$atts['divide_line_color'].'"':'';
			$divideline = '<div class="divide-line text-'.$align.'"><span '.$divide_line_color.'></span></div>';
		}

		if( !empty( $atts['btn_value'] ) ){
			if( $atts['btn_style'] != '' ){
				$btn_style = 'btn-'.$atts['btn_style']; 
			}
			if( $atts['btn_size'] != '' ){
				$btn_size = 'btn-'.$atts['btn_size']; 
			}

			if( $atts['btn_radius'] != '' ){
				$btn_radius = 'style = "border-radius:'.( preg_match( '/(px|em|\%|pt|cm)$/', $atts['btn_radius'] ) ? $atts['btn_radius'] : $atts['btn_radius'] . 'px' ).'; "';  
			}
			$button = '<div class="agni-fancy-btn"><a class="btn '.$btn_style.' btn-'.$atts['btn_choice'].' '.$btn_size.'" href="'.$atts['btn_url'].'" '.$btn_radius.'> '.$atts['btn_value'].'<i class="icon-arrows-slim-right"></i></a></div>';
		}

		$img_gutter = ( !empty($img_gutter) )?$img_gutter:'0';
		$col_gutter_css = 'style="padding: 0px '.(intval($img_gutter) / 2).'px;"';
		$row_gutter_css = 'style="margin: 0px -'.(intval($img_gutter) / 2).'px;"';

		foreach ( $values as $k => $v ) {
			$data[] = array(
				'column' => ( isset($v['column']) ) ? $v['column'] : '',
				'column_tab' => ( isset($v['column_tab']) ) ? $v['column_tab'] : '',
				'column_mobile' => ( isset($v['column_mobile']) ) ? $v['column_mobile'] : '',
				'img_url' => ( isset($v['img_url']) ) ? $v['img_url'] : '',
				'img_size' => ( isset($v['img_size']) ) ? $v['img_size'] : '',
				'img_size_custom' => ( isset($v['img_size_custom']) ) ? $v['img_size_custom'] : '',
				'img_type' => ( isset($v['img_type']) ) ? $v['img_type'] : '',
				'bg_img_height' => ( isset($v['bg_img_height']) ) ? $v['bg_img_height'] : '',
				'bg_img_height_tab' => ( isset($v['bg_img_height_tab']) ) ? $v['bg_img_height_tab'] : '',
				'bg_img_height_mobile' => ( isset($v['bg_img_height_mobile']) ) ? $v['bg_img_height_mobile'] : '',
				'has_fullwidth_img' => ( isset($v['has_fullwidth_img']) ) ? $v['has_fullwidth_img'] : '',
				'bg_img_repeat' => ( isset($v['bg_img_repeat']) ) ? $v['bg_img_repeat'] : '',
				'bg_img_size' => ( isset($v['bg_img_size']) ) ? $v['bg_img_size'] : '',
				'bg_img_position' => ( isset($v['bg_img_position']) ) ? $v['bg_img_position'] : '',
				'bg_img_attachment' => ( isset($v['bg_img_attachment']) ) ? $v['bg_img_attachment'] : '',
				'bg_parallax' => ( isset($v['bg_parallax']) ) ? $v['bg_parallax'] : '',
				'data_bottom_top' => ( isset($v['data_bottom_top']) ) ? $v['data_bottom_top'] : '',
				'data_center' => ( isset($v['data_center']) ) ? $v['data_center'] : '',
				'data_top_bottom' => ( isset($v['data_top_bottom']) ) ? $v['data_top_bottom'] : '',
			);
		}

		foreach ( $data as $atts ) {
			$bg_img_height = $bg_img_data = $bg_parallax = $bg_parallax_class = $has_fullwidth_img = '';
			
			$column_class = 'col-xs-'.$atts['column_mobile'].' col-sm-'.$atts['column_tab'].' col-md-'.$atts['column'];
			
			if( $atts['img_size'] == 'custom' ){
				$img_array = wpb_getImageBySize( array(
					'attach_id' => $atts['img_url'],
					'thumb_size' => $atts['img_size_custom'],
					'class' => 'fullwidth-image attachment-'.$atts['img_size_custom'] .' ',
				) );

				//for img tag
				$img_cropped = $img_array['thumbnail'];

				// for bg
				$doc = new DOMDocument();
				$doc->loadHTML($img_array['thumbnail']);
				$xpath = new DOMXPath($doc);
				$img_cropped_url = $xpath->evaluate("string(//img/@src)");

			}

			if( $atts['img_type'] == 'bg-holder' ){
				if( !empty($atts['bg_img_height']) ){
					$bg_img_height = 'height:'.$atts['bg_img_height'].'px; ';

					$bg_img_data = 'data-height="'.$atts['bg_img_height'].'" ';
					if( !empty($atts['bg_img_height_tab']) ){
						$bg_img_data .= 'data-height-tab="'.$atts['bg_img_height_tab'].'" ';
					}
					if( !empty($atts['bg_img_height_mobile']) ){
						$bg_img_data .= 'data-height-mobile="'.$atts['bg_img_height_mobile'].'" ';
					}
				}
				$img_url = wp_get_attachment_url( $atts['img_url']) ;
				if( $atts['img_size'] == 'custom' ){ 
					$img_url = $img_cropped_url;
				}
				$img = '<div class="agni-fancy-figure-bg" '.$bg_img_data.' style="'.$bg_img_height.' background-image:url('.$img_url.'); background-repeat:'.$atts['bg_img_repeat'].'; background-size:'.$atts['bg_img_size'].'; background-position:'.$atts['bg_img_position'].'; background-attachment:'.$atts['bg_img_attachment'].';"></div>';
			}
			else{
				
				$img = wp_get_attachment_image( $atts['img_url'], $atts['img_size'] );

				if( $atts['img_size'] == 'custom' ){
					$img = $img_cropped;
				}

				if( $atts['has_fullwidth_img'] == '1'){
					$has_fullwidth_img = ' has-fullwidth-img';
				}
			}

			if( $atts['bg_parallax'] == '1' ){
				$bg_parallax = 'data-top-bottom="'.$atts['data_top_bottom'].'" data-center="'.$atts['data_center'].'" data-bottom-top="'.$atts['data_bottom_top'].'"';
				$bg_parallax_class = ' parallax';
			}


			$img_col .= '<div class="agni-fancy-image-column '.$column_class.'" '.$col_gutter_css.'><figure class="agni-fancy-figure '.$bg_parallax_class.$has_fullwidth_img.'" '.$bg_parallax.'>';
			$img_col .= $img;
			$img_col .= '</figure></div>';
			
		}

		$output = '<div class="'.$class.' agni-fancy-image">';
		if( $animation == '1' ){
			$output .= '<div class="animate" data-animation="'.$animation_style.'" data-animation-offset="'.$animation_offset.'" style="animation-duration: '.$animation_duration.'s;     animation-delay: '.$animation_delay.'s;     -moz-animation-duration: '.$animation_duration.'s;  -moz-animation-delay: '.$animation_delay.'s;    -webkit-animation-duration: '.$animation_duration.'s;   -webkit-animation-delay: '.$animation_delay.'s; ">';    
		}
		$output .= '<div class="agni-fancy-image-row row" '.$row_gutter_css.'>
				'.$img_col.'
			</div>
			<div class="agni-fancy-image-content justify-content-'.$vertical_alignment.' align-items-'.$alignment.' ">
				'.$heading.$divideline.$description.$button.'
			</div>';
		if( $animation == '1' ){
			$output .= '</div>';    
		}
		$output .= '</div>';
		return $output;
	}

	// Category Box
	public static function agni_category_box( $atts = null, $content = null ) {
		$atts = vc_map_get_attributes( 'agni_category_box', $atts );
		extract( $atts );

		$img_col = $title_css = $heading = $button = $has_fullwidth_img = '';
		$animation = $atts['animation'];
		$animation_style = $atts['animation_style'];
		$animation_delay = $atts['animation_delay'];
		$animation_duration = $atts['animation_duration'];
		$animation_offset = $atts['animation_offset'];

		if( !empty($atts['title']) ){
			$title_size = ($atts['title_size'])?'font-size:'.$atts['title_size'].'px; ':'';
			$title_color = ($atts['title_color'])?'color:'.$atts['title_color'].'; ':'';
			$title_bg_color = ($atts['title_bg_color'])?'background-color:'.$atts['title_bg_color'].'; ':'';
			if( !empty($title_size) || !empty($title_color) || !empty($title_bg_color) ){
				$title_css = 'style="'.$title_size.$title_color.$title_bg_color.'"';
			}
			$heading = '<h5 class="agni-category-box-title" '.$title_css.'>'.$atts['title'].'</h5>';
		}

		if( !empty( $atts['btn_value'] ) ){
			if( $atts['btn_style'] != '' ){
				$btn_style = 'btn-'.$atts['btn_style']; 
			}
			if( $atts['btn_size'] != '' ){
				$btn_size = 'btn-'.$atts['btn_size']; 
			}

			if( $atts['btn_radius'] != '' ){
				$btn_radius = 'style = "border-radius:'.( preg_match( '/(px|em|\%|pt|cm)$/', $atts['btn_radius'] ) ? $atts['btn_radius'] : $atts['btn_radius'] . 'px' ).'; "';  
			}
			$button = '<div class="agni-category-box-btn"><a class="btn '.$btn_style.' btn-'.$atts['btn_choice'].' '.$btn_size.'" href="'.$atts['btn_url'].'" '.$btn_radius.'> '.$atts['btn_value'].'</a></div>';
		}

		if( $atts['img_size'] == 'custom' ){
			$img_array = wpb_getImageBySize( array(
				'attach_id' => $atts['img_url'],
				'thumb_size' => $atts['img_size_custom'],
				'class' => 'fullwidth-image attachment-'.$atts['img_size_custom'] .' ',
			) );

			//for img tag
			$img = $img_array['thumbnail'];

		}
		else{	
			$img = wp_get_attachment_image( $atts['img_url'], $atts['img_size'] );
		}

		$link_wrap = (!empty($atts['btn_value']))?'<a href="'.$atts['btn_url'].'"></a>':'';

		if( $atts['has_fullwidth_img'] == '1'){
			$has_fullwidth_img = ' has-fullwidth-img';
		}

		$output = '<div class="'.$atts['class'].' agni-category-box agni-category-box-content-placement-'.$atts['placement'].'  agni-category-box-content-justify-content-'.$atts['vertical_alignment'].' agni-category-box-content-align-items-'.$atts['alignment'].'">';
		if( $animation == '1' ){
			$output .= '<div class="animate" data-animation="'.$animation_style.'" data-animation-offset="'.$animation_offset.'" style="animation-duration: '.$animation_duration.'s;     animation-delay: '.$animation_delay.'s;     -moz-animation-duration: '.$animation_duration.'s;  -moz-animation-delay: '.$animation_delay.'s;    -webkit-animation-duration: '.$animation_duration.'s;   -webkit-animation-delay: '.$animation_delay.'s; ">';    
		}
		$output .= '<div class="agni-category-box-image '.$has_fullwidth_img.'">'.$link_wrap.$img.'</div>
			<div class="agni-category-box-content justify-content-'.$atts['vertical_alignment'].' align-items-'.$atts['alignment'].'">
				<div class="agni-category-box-content-inner text-'.$atts['text_alignment'].'">
				'.$heading.$button.'
				</div>
			</div>';
		if( $animation == '1' ){
			$output .= '</div>';    
		}
		$output .= '</div>';

		return $output;
	}

	// Product Hotspot
	public static function agni_hotspot( $atts = null, $content = null ) {
		$atts = vc_map_get_attributes( 'agni_hotspot', $atts );
		extract( $atts );

		wp_enqueue_script( 'halena-scalize-script' );
		wp_enqueue_style( 'halena-scalize-style' );

		$values = vc_param_group_parse_atts( $atts['values'] );
		$data = array();

		$hotspot_products = $look_details = '';

		if( $atts['look_style'] == '1' ){
			$lookbook_choice = 'agni-hotspot-scalize scalize'; 
		}
		else{
			$lookbook_choice = 'agni-hotspot-simple'; 
		}

		$look_bg_css = (!empty($atts['look_bg_color']))?'style="background-color:'.$atts['look_bg_color'].'"':'';

		if( $atts['img_size'] == 'custom' ){
			$img_array = wpb_getImageBySize( array(
				'attach_id' => $atts['img_url'],
				'thumb_size' => $atts['img_size_custom'],
				'class' => 'fullwidth-image attachment-'.$atts['img_size_custom'] .' ',
			) );

			//for img tag
			$img = $img_array['thumbnail'];

		}
		else{	
			$img = wp_get_attachment_image( $atts['img_url'], $atts['img_size'], '', array( 'class' => 'scalize-target' ) );
		}

		$img = '<div class="hotspot-image">'.$img.'</div>';

		//$look_details = '<h6 class="hotspot-title">'.$atts['look_title'].'</h6><div class="hotspot-description">'.$atts['look_desc'].'</div>';
		$look_title = ( !empty($atts['look_title']) )?'<h6 class="hotspot-title">'.$atts['look_title'].'</h6>':'';
		$look_desc = ( !empty($atts['look_desc']) )?'<div class="hotspot-desc">'.$atts['look_desc'].'</div>':'';

		if( !empty( $look_title ) || !empty( $look_desc ) ){
			$look_details = '<div class="agni-hotspot-look-details">'.$look_title.$look_desc.'</div>';
		}

		foreach ( $values as $k => $v ) {
			$data[] = array(
				'pin_coordinates' => ( isset($v['pin_coordinates']) ) ? $v['pin_coordinates'] : '',
				'pin_skin' => ( isset($v['pin_skin']) ) ? $v['pin_skin'] : '',
				'pin_content' => ( isset($v['pin_content']) ) ? $v['pin_content'] : '',
				'product_id' => ( isset($v['product_id']) ) ? $v['product_id'] : '','',
				'product_thumbnail' => ( isset($v['product_thumbnail']) ) ? $v['product_thumbnail'] : '',
				'product_title' => ( isset($v['product_title']) ) ? $v['product_title'] : '', 
				'product_price' => ( isset($v['product_price']) ) ? $v['product_price'] : '',
				//'product_description' => ( isset($v['product_description']) ) ? $v['product_description'] : '',
				'product_button' => ( isset($v['product_button']) ) ? $v['product_button'] : '',
				'agni_block_post_id' => ( isset($v['agni_block_post_id']) ) ? $v['agni_block_post_id'] : '',
				'pin_content_position' => ( isset($v['pin_content_position']) ) ? $v['pin_content_position'] : ''
			);
		}

		foreach ( $data as $atts ) {
			$hotspot_content_inner = '';
			$hotspot_coordinates = $atts['pin_coordinates'];
			$hotspot_coordinates = preg_replace('/\s+/', '', $hotspot_coordinates); 

			if( $atts['pin_content'] == 'product' ){
				global $product;
				
				$hotspot_product_id = ( !empty($atts['product_id']) )?$atts['product_id']:'';
				$hotspot_content_id = str_replace(',', '-', $hotspot_coordinates).'-'.$hotspot_product_id;
				$hotspot_product = wc_get_product( $hotspot_product_id );
				if( !$hotspot_product ){
					break;
				}
				$hotspot_product_thumbnail = get_the_post_thumbnail( $hotspot_product_id, 'shop_catalog' );
				$hotspot_product_title = $hotspot_product->get_title();
				$hotspot_product_price = $hotspot_product->get_price_html();
				$hotspot_product_button = do_shortcode( '[add_to_cart id="'.$hotspot_product_id.'" show_price="false" style=""]' );

				if( !empty($hotspot_product_thumbnail) && $atts['product_thumbnail'] == '1' ){
					$hotspot_content_inner .= '<a href="'.get_permalink( $hotspot_product_id ).'">'.$hotspot_product_thumbnail.'</a>';
				}
				$hotspot_content_inner .= '<div class="hotspot-product-content-details">';
					if( !empty($hotspot_product_title) && $atts['product_title'] == '1' ){
						$hotspot_content_inner .= '<h6 class="hotspot-product-title"><a href="'.get_permalink( $hotspot_product_id ).'">'.$hotspot_product_title.'</a></h6>';
					}
					if( !empty($hotspot_product_price) && $atts['product_price'] == '1' ){
						$hotspot_content_inner .= '<span class="hotspot-product-price">'.$hotspot_product_price.'</span>';
					}
					if( !empty($hotspot_product_button) && $atts['product_button'] == '1' ){
						$hotspot_content_inner .= $hotspot_product_button;
					}
					
				$hotspot_content_inner .= '</div>';
	        }
	        else{

	        	$hotspot_block_id = ( !empty($atts['agni_block_post_id']) )?$atts['agni_block_post_id']:'';
				$hotspot_content_id = str_replace(',', '-', $hotspot_coordinates).'-'.$hotspot_block_id;

	        	$hotspot_content_inner .= do_shortcode( '[agni_block id="'.$atts['agni_block_post_id'].'"]' );
	        }

	        if( $look_style == '1' ){
				//<a href="#" class="exit">Exit</a>
	            $hotspot_products .= '<div id="scalize-content-'.$hotspot_content_id.'" class="hotspot-content-inner scalize-content '.$atts['pin_content_position'].'" >
	            	'.$hotspot_content_inner.'
	            </div>
	            <div class="agni-hotspot-pin scalize-item-point '.$atts['pin_skin'].'" data-scalize-coordinates="'.$hotspot_coordinates.'" data-scalize-popover="#scalize-content-'.$hotspot_content_id.'">
	            	<div class="scalize-pin">
	            		<div class="agni-hotspot-plus-icon"><span class="agni-hotspot-plus-icon-horizontal-line"></span><span class="agni-hotspot-plus-icon-vertical-line"></span></div>
	            		<a href="#" class="toggle"></a>
	            	</div>
	            </div>';
	        }
	        else{
	            $hotspot_products .= '<div class="hotspot-content-inner">'.$hotspot_content_inner.'</div>';
	        }
		}

		if( $look_style != '1' ){

	        wp_enqueue_style( 'halena-slick-style' );
	        wp_enqueue_script( 'halena-slick-script' );
	        $rtl = ( is_rtl() )?'true':'false';

			$hotspot_products = '<div class="hotspot-content">
            	<div class="agni-hotspot-pin">
            		<div class="agni-hotspot-pin-overlay"></div>
            		<div class="agni-hotspot-plus-icon"><span class="agni-hotspot-plus-icon-horizontal-line"></span><span class="agni-hotspot-plus-icon-vertical-line"></span></div>
            	</div>
            	<div class="agni-hotspot-slider" data-rtl="'.$rtl.'">'.$hotspot_products.'</div>
            </div>';
		}

		$output = '<div class="agni-hotspot agni-hotspot-style-'.$look_style.' '.$class.'">';
		if( $animation == '1' ){
			$output .= '<div class="animate" data-animation="'.$animation_style.'" data-animation-offset="'.$animation_offset.'" style="animation-duration: '.$animation_duration.'s;     animation-delay: '.$animation_delay.'s;     -moz-animation-duration: '.$animation_duration.'s;  -moz-animation-delay: '.$animation_delay.'s;    -webkit-animation-duration: '.$animation_duration.'s;   -webkit-animation-delay: '.$animation_delay.'s; ">';    
		}
		$output .= '<div class="agni-hotspot-bg" '.$look_bg_css.'></div>
			<div class="agni-hotspot-container '.$lookbook_choice.'">
				'.$img.$look_details.$hotspot_products.'
	        </div>';
	    if( $animation == '1' ){
			$output .= '</div>';    
		}  
        $output .='</div>';

		return $output;
	}
	
	// video
	public static function agni_video( $atts = null, $content = null ) {
		$atts = vc_map_get_attributes( 'agni_video', $atts );
		extract( $atts );

		$id = rand(10000,99999);

		if( $atts['mobile'] != 'true' ){
			$atts['mobile'] = 'false';
		}
		if( $atts['auto_play'] != 'true' ){
			$atts['auto_play'] = 'false';
		}
		if( $atts['loop'] != 'true' ){
			$atts['loop'] = 'false';
		}
		if( $atts['mute'] != 'true' ){
			$atts['mute'] = 'false';
		}

		if( $atts['video_type'] == '1' ){

    		if (strpos($atts['url'], 'youtube') > 0) {
                wp_enqueue_script( 'halena-mbytplayer-script' );
                $player_src = 'player-yt';
            } 
            elseif (strpos($atts['url'], 'vimeo') > 0) {
                wp_enqueue_script( 'halena-mbvimeoplayer-script' );
                $player_src = 'player-vimeo';
			} 
			
			$mobile = $atts['mobile'] ? ' has-mobile-video' : '';

			$height = '';
			if( $atts['height'] != '' ){
				$height = 'style="height:'.$atts['youtube_height'].'px"';
			}
			$output = '<div class="'.$atts['class'].' agni-video">
				<div class="agni-video-container agni-video-container-'.$id.'" '.$height.'>
					<a id="agni-video-'.$id.'" class="player '.$player_src.$mobile.'" data-property="{videoURL:\''.$atts['url'].'\', containment:\'.agni-video-container-'.$id.' \', showControls:false, useOnMobile: '.$atts['mobile'].', autoPlay:'.$atts['auto_play'].', loop:'.$atts['loop'].', vol:'.$atts['vol'].', mute:'.$atts['mute'].', startAt:'.$atts['start_at'].', stopAt:'.$atts['stop_at'].', opacity:1, addRaster:false, optimizeDisplay:true, quality:\''.$atts['quality'].'\'}" style="background-image:url(\' '.wp_get_attachment_url( $atts['fallback'] ).' \')"></a>
					<div class="overlay" style="opacity:'.$atts['overlay_opacity'].'"></div>
					<div class="section-video-controls agni-video-controls">
						<a class="command command-play" href="#"></a>
						<a class="command command-pause" href="#"></a>
					</div>
				</div>
			</div>';
		}
		elseif( $atts['video_type'] == '2' ){
			$autoplay = $loop = $muted = '';
			if( $atts['self_player'] == '1' ){
				if( $atts['self_auto_play'] == 'on' ){
					$autoplay = 'autoplay ';
				}
				if( $atts['self_loop'] == 'on' ){
					$loop = 'loop ';
				}
				if( $atts['self_mute'] == 'on' ){
					$muted = 'muted ';
				}
				$output = '<div id="agni-video-'.$id.'" class="'.$atts['class'].' custom-video agni-video self-hosted embed-responsive embed-responsive-16by9">
					<video '. $autoplay . $loop . $muted . ' class="custom-self-hosted-video" poster="'.wp_get_attachment_url( $atts['self_poster'] ).'">
						<source src="'.$atts['self_url'].'" type="video/mp4">
					</video>
				</div>';
			}
			else{
				if( $atts['self_auto_play'] == 'on' ){
					$autoplay = 'autoplay = "on"';
				}
				if( $atts['self_loop'] == 'on' ){
					$loop = 'loop = "on"';
				}
				$output = '<div class="agni-video">'.do_shortcode('[video src="'.$atts['self_url'].'" '.$autoplay.' '.$loop.' preload="'.$atts['self_preload'].'" ]').'</div>';
			}
		}
		elseif( $atts['video_type'] == '3' ){
			if( $atts['iframe_style'] == '1' ){
				$output = do_shortcode('[agni_button value="'.$atts['button_value'].'" icon="'.$atts['icon'].'" size="'.$atts['button_size'].'" style="'.$atts['button_style'].'" choice="'.$atts['button_choice'].'" radius="'.$atts['button_radius'].'" alignment="'.$atts['button_alignment'].'" class="'.$atts['class'].' custom-video-link cutom-iframe-style-'.$atts['iframe_style'].'" modal="1" modal_src="'.$atts['embed'].'" ]');
			}
			else{
				wp_enqueue_style('halena-photoswipe-style'); 
				wp_enqueue_script('halena-photoswipe-script'); 

				$output = '<div class="'.$atts['class'].' custom-video-link custom-iframe-style-'.$atts['iframe_style'].'"><button data-modal=\''.trim( vc_value_from_safe( $atts['embed'] ) ).'\'>'.do_shortcode( '[agni_icon icon="'.$atts['icon'].'" size="'.$atts['size'].'" icon_style="'.$atts['icon_style'].'" width="'.$atts['width'].'" height="'.$atts['height'].'" radius="'.$atts['radius'].'" border_color="'.$atts['border_color'].'" background_color="'.$atts['background_color'].'" color="'.$atts['color'].'" hover_icon_style="'.$atts['hover_icon_style'].'" hover_radius="'.$atts['hover_radius'].'" hover_border_color="'.$atts['hover_border_color'].'" hover_background_color="'.$atts['hover_background_color'].'" hover_color="'.$atts['hover_color'].'" ]' ).'</button></div>';
			}
		} 
		else{
			$output = '<div id="agni-video-'.$id.'" class="'.$atts['class'].' custom-video agni-video embed-responsive embed-responsive-16by9">
				'.trim( vc_value_from_safe( $atts['embed'] ) ).'
			</div>  ' ; 
		}
		return $output;
	}
	
	
	// gmap
	public static function agni_gmap( $atts = null, $content = null ) {
		$atts = vc_map_get_attributes( 'agni_gmap', $atts );
		extract( $atts );

		wp_enqueue_script( 'googleapi' );

		$values = vc_param_group_parse_atts( $atts['values'] );
		$locations = array();

		foreach ( $values as $k => $v ) {
			$locations[] = array(
				'name' => $v['google_map_location'],
				'lat' => $v['google_map_lat'],
				'lng' => $v['google_map_lng'],
				'address' => ( isset( $v['google_address_1']) ) ? $v['google_address_1'] : '',
			);
		}
			
		$map_icon = ( !empty($google_map_icon) ) ? wp_get_attachment_url($google_map_icon) : get_template_directory_uri().'/img/marker.png';
		$id = ( !empty($id) ) ? $id : 'map_canvas';
		
		$output = '<div id="'.$id.'" class="map-canvas '.$class.' map-canvas-style-'.$style.'" style="height:'.( preg_match( '/(px|\%|vh)$/', $height ) ? $height : $height . 'px' ).'" data-height="'.$height.'" data-height-tab="'.$height_tab.'" data-height-mobile="'.$height_mobile.'" data-map-style="'.$style.'" data-map-accent-color="'.$color.'" data-map-drag="'.$drag.'" data-map-zoom = "'.$zoom.'" data-map="'.$map_icon.'" data-map-locations="'.htmlspecialchars(json_encode($locations)).'" data-dir="'.get_template_directory_uri().'"></div>';
			
		return $output;
	}

	// countdown
	public static function agni_countdown( $atts = null, $content = null ) {
		$atts = vc_map_get_attributes( 'agni_countdown', $atts );
		extract( $atts );

		wp_enqueue_script( 'halena-countdown-script' );

		$countdown_holder = $countdown_holder_style = '';
		
		$countdown_style = ( !empty($atts['countdown-style']) )?' countdown-has-'.$atts['countdown-style']:'';
		$countdown_bg_color = ( !empty($atts['countdown-bg-color']) )?' background-color:'.$atts['countdown-bg-color'].'; ':'';
		$countdown_border_color = ( !empty($atts['countdown-border-color']) )?' border-color:'.$atts['countdown-border-color'].'; ':'';
		$countdown_color = ( !empty($atts['countdown-color']) )?' color:'.$atts['countdown-color'].'; ':'';

		if( !empty($countdown_bg_color) || !empty($countdown_border_color) || !empty($countdown_color) ){
			$countdown_holder_style = 'style="'.$countdown_bg_color.$countdown_border_color.$countdown_color.'"';
		}
		
		$timeRef = array( 'days', 'hours', 'minutes', 'seconds' );
		foreach ($timeRef as $key => $value) {
			$countdown_holder .= '<div class="col-xs-6 col-sm-3 col-md-3">
				<div class="countdown-holder" '.$countdown_holder_style.'>
					<h2 class="'.$value.'">00</h2>
					<p class="timeRef'.ucfirst($value).'"></p>
				</div>
			</div>';
		}

		$output = '<div class="countdown'.$countdown_style.' row list-inline '.$atts['class'].'" data-counter="'.$atts['date'].'" data-label="'.$atts['label'].'">
			'.$countdown_holder.'
		</div>';
			
		return $output;
	}

	// agnislider
	public static function agni_agnislider( $atts = null, $content = null ) {
		$atts = vc_map_get_attributes( 'agni_agnislider', $atts );
		extract( $atts );  
		
		$output = agni_slider( $atts['post_id'], true );
			
		return $output;
	}

	// agnislider
	public static function agni_block( $atts = null, $content = null ) {
		$atts = vc_map_get_attributes( 'agni_block', $atts );
		extract( $atts );  
		
		$output = apply_filters('the_content', get_post_field('post_content', $atts['post_id']));
		$output = '<div class="agni-content-block">'.$output.'</div>';
		
		return $output;
	}
	
	//team
	public static function agni_team($atts=null, $content=null){
		$atts = vc_map_get_attributes( 'agni_team', $atts );
		extract( $atts );

		$values = vc_param_group_parse_atts( $atts['values'] );
		$data = array();
		
        $output = $carousel_class = $carousel_container_class = $carousel_atts = $carousel_nav = $columns = $team_gutter_row_style = $team_gutter_style = '';
        
        switch( $atts['columns'] ){
            case '1' :
                $columns = 'col-xs-12 col-sm-12 col-md-12';
                break;
            case '2' :
                $columns = 'col-xs-12 col-sm-12 col-md-6';
                break;
            case '3' :
                $columns = 'col-xs-12 col-sm-6 col-md-4';
                break;
            case '4' :
                $columns = 'col-xs-12 col-sm-4 col-md-3';
                break;
            case '5' :
                $columns = 'col-xs-12 col-sm-4 col-md-3 col-lg-2_5';
                break;
        }

        if( $atts['carousel'] == '1' ){

            wp_enqueue_style( 'halena-slick-style' );
            wp_enqueue_script( 'halena-slick-script' );

			$carousel_class .= ' agni-carousel';
			$carousel_container_class = ' agni-carousel-container';
			$atts['cat_thumbnail_individual_settings'] = '1';
			if( $atts['carousel_dots'] == '1' || $atts['carousel_arrows'] == '1' ){
				$carousel_nav = '<div class="slick-nav"></div>';
			}
			$carousel_atts = agni_carousel_atts_processor( $atts );
			if( is_rtl() ){
				$carousel_atts .= 'data-rtl="true"';
			}
			else{
				$carousel_atts .= 'data-rtl="false"';
			}
		}

        $member_thumbnail_hover_bg = esc_attr( $atts['member_thumbnail_hover_bg_color'] );
        $member_thumbnail_hover_color = esc_attr( $atts['member_thumbnail_hover_color'] );

        $member_thumbnail_hover_bg = ( !empty($member_thumbnail_hover_bg) )?'background-color:'.$member_thumbnail_hover_bg.'; ':'';
        $member_thumbnail_hover_color = ( !empty($member_thumbnail_hover_color) )?'color:'.$member_thumbnail_hover_color.'; ':'';
        $member_thumbnail_style = ( !empty($member_thumbnail_hover_color) || !empty($member_thumbnail_hover_bg) )?'style="'.$member_thumbnail_hover_color.$member_thumbnail_hover_bg.'"':'';
        
        $atts['circle_avatar'] = ($atts['circle_avatar'] == '1')?'img-circle':'';
        $atts['member_thumbnail_gs_filter'] = ( $atts['member_thumbnail_gs_filter'] == '1' )?'has-grayscale':'';

        $team_thumb_args  = array( 'class' => $atts['circle_avatar'].' team-thumbnail' ); 

        $atts['team_gutter'] = ( empty($atts['team_gutter']) )?'0':intval($atts['team_gutter']/2);
        $team_gutter_style = 'padding: '.$atts['team_gutter'].'px; ';
        $team_gutter_row_style = 'style="margin: 0px -'.$atts['team_gutter'].'px"';

        foreach ( $values as $k => $v ) {
			$data[] = array(
				'member_img_id' => ( isset($v['member_img_id']) ) ? $v['member_img_id'] : '',
				'member_name' => ( isset($v['member_name']) ) ? $v['member_name'] : '',
				'member_name_link' => ( isset($v['member_name_link']) ) ? $v['member_name_link'] : '',
				'member_designation' => ( isset($v['member_designation']) ) ? $v['member_designation'] : '',
				'member_description' => ( isset($v['member_description']) ) ? $v['member_description'] : '',
				'member_facebook_link' => ( isset($v['member_facebook_link']) ) ? $v['member_facebook_link'] : '',
				'member_twitter_link' => ( isset($v['member_twitter_link']) ) ? $v['member_twitter_link'] : '',
				'member_google_plus_link' => ( isset($v['member_google_plus_link']) ) ? $v['member_google_plus_link'] : '',
				'member_vk_link' => ( isset($v['member_vk_link']) ) ? $v['member_vk_link'] : '',
				'member_behance_link' => ( isset($v['member_behance_link']) ) ? $v['member_behance_link'] : '',
				'member_pinterest_link' => ( isset($v['member_pinterest_link']) ) ? $v['member_pinterest_link'] : '',
				'member_dribbble_link' => ( isset($v['member_dribbble_link']) ) ? $v['member_dribbble_link'] : '',
				'member_skype_link' => ( isset($v['member_skype_link']) ) ? $v['member_skype_link'] : '',
				'member_linkedin_link' => ( isset($v['member_linkedin_link']) ) ? $v['member_linkedin_link'] : '',
				'member_envelope_link' => ( isset($v['member_envelope_link']) ) ? $v['member_envelope_link'] : '',
				'member_number' => ( isset($v['member_number']) ) ? $v['member_number'] : '',
			);
		}
        //$i = $delay = 0; 
        // Check if the Query returns any posts
        foreach ($data as $atts) {
                
            $member_name = $member_description = $member_designation = $member_meta = $member_links = $member_content_hover = $member_content_bottom = $member_thumbnail = $team_animation_class = $team_animation_attr = $team_animation_style = '';
            
            $member_links_array = array('facebook', 'twitter', 'google-plus', 'vk', 'behance', 'pinterest', 'dribbble', 'skype', 'linkedin', 'envelope');
            foreach ($member_links_array as $key => $member_links_class ) {
                $member_links_prefix = '';
                $member_links_href = str_replace('-', '_', $member_links_class);
                if( !empty($atts['member_' . $member_links_href . '_link']) ){
                    $member_links_prefix = ( $member_links_class == 'envelope' )?'mailto:':'';
                    $member_links .= '<li><a href="'.$member_links_prefix.$atts['member_' . $member_links_href . '_link'].'"><i class=" fa fa-'.$member_links_class.'" ></i></a></li>';
                }
            }
            $member_links = (!empty($member_links))?'<ul class="list-inline">'.$member_links.'</ul>':$member_links;
            
            if( !empty($atts['member_name']) ){
            	$member_name = $atts['member_name'];
                if( !empty($atts['member_name_link']) ){
                    $member_name = '<a href="'.$atts['member_name_link'].'">'.$member_name.'</a>';
                }
                $member_name = '<h5 class="member-title" style="font-size:'.$member_name_size.'px">'.$member_name.'</h5>';
            }   
            
            if( !empty($atts['member_designation']) ){
                $member_designation = '<p class="member-designation-text" style="font-size:'.$member_designation_size.'px">'.$atts['member_designation'].'</p>'; 
            }

            if( !empty($atts['member_description']) ){
                $member_description = '<p class="member-description-text" style="font-size:'.$member_description_size.'px">'.$atts['member_description'].'</p>'; 
            }

            if( !empty($member_links) || !empty($atts['member_number']) ){
                $member_meta = '<div class="member-meta" style="font-size:'.$member_social_icons_size.'px">
                    '.$member_links.'
                    <span class="member-contact">'.$atts['member_number'].'</span>
                </div>';
            }

            if( $member_thumbnail_hardcrop == '1' ){
                $member_thumbnail_customcrop_dimension = explode( 'x', $member_thumbnail_custom );
                $member_thumbnail = agni_thumbnail_customcrop( $atts['member_img_id'], $member_thumbnail_customcrop_dimension[0].'x'.$member_thumbnail_customcrop_dimension[1], $atts['circle_avatar'] );
            }
            else{
                $member_thumbnail = wp_get_attachment_image( $atts['member_img_id'], 'halena-standard-thumbnail', '', $team_thumb_args );
            }
            
            $member_content_hover .= ( $member_show_hover_name == '1' )?$member_name:'';
            $member_content_hover .= ( $member_show_hover_designation == '1' )?$member_designation:'';
            $member_content_hover .= ( $member_show_hover_description == '1' )?$member_description:'';
            $member_content_hover .= ( $member_show_hover_social_icons == '1' )?$member_meta:'';

            if( !empty($member_content_hover) ){
                $member_content_hover = '<div class="member-caption-content align-items-'.$member_hover_vertical_alignment.' justify-content-'.$member_hover_horizontal_alignment.'" '.$member_thumbnail_style.'>
                    '.$member_content_hover.'
                </div>';
            }

            $member_content_bottom .= ( $member_show_bottom_name == '1' )?$member_name:'';
            $member_content_bottom .= ( $member_show_bottom_designation == '1' )?$member_designation:'';
            $member_content_bottom .= ( $member_show_bottom_description == '1' )?$member_description:'';
            $member_content_bottom .= ( $member_show_bottom_social_icons == '1' && !empty($member_meta) )?$member_meta:'';
            $member_content_bottom = ( !empty($member_content_bottom) )?'<div class="member-bottom-caption text-'.$member_bottom_alignment.'">'.$member_content_bottom.'</div>':$member_content_bottom;

            $output .= '<div class="'.$team_animation_class.'member-column '.$columns.' '.esc_attr( $member_thumbnail_gs_filter ).'" style="'.$team_gutter_style.$team_animation_style.'" '.$team_animation_attr.'>
                <div class="member-content member-post member-style-'.esc_attr( $team_style ).'">
                    <div class="member-container">
                        <div class="member-thumbnail">
                            '.$member_thumbnail.'
                        </div>
                        '.$member_content_hover.'
                    </div>
                    '.$member_content_bottom.'
                </div>
            </div>';

        } 

        //$team_type = ( $team_type == '1' )? 'carousel-team':'grid-team row';

        $output = '<div class="'.$class.' '.$carousel_class.'" data-team-gutter="'.esc_attr( $team_gutter ).'" '.$carousel_atts.' '.$team_gutter_row_style.'>'.$output.'</div>'.$carousel_nav;
	
		return '<div class="agni-team-container '.$carousel_container_class.'">'.$output.'</div>';
	}
	
	//Clients   
	public static function agni_clients($atts=null, $content=null){
		$atts = vc_map_get_attributes( 'agni_clients', $atts );
		extract( $atts );

		$values = vc_param_group_parse_atts( $atts['values'] );
		$data = array();


        global $post;
        $output = $carousel_container_class = $carousel_nav = $carousel_atts = $client_class = $client_cat = $client_bg_color = $client_border_color = $column = $client_gutter_style = $client_gutter_row_style = $client_filter = '';

        if( $atts['carousel'] == '1' ){

            wp_enqueue_style( 'halena-slick-style' );
            wp_enqueue_script( 'halena-slick-script' );
                
			$client_class .= ' agni-carousel';
			$carousel_container_class = ' agni-carousel-container';
			$atts['cat_thumbnail_individual_settings'] = '1';
			if( $atts['carousel_dots'] == '1' || $atts['carousel_arrows'] == '1' ){
				$carousel_nav = '<div class="slick-nav"></div>';
			}
			$carousel_atts = agni_carousel_atts_processor( $atts );
			if( is_rtl() ){
				$carousel_atts .= 'data-rtl="true"';
			}
			else{
				$carousel_atts .= 'data-rtl="false"';
			}
		}

		$columns = $atts['columns'];
        switch( $atts['columns'] ){
            case '2' :
                $columns = 'col-xs-12 col-sm-6 col-md-6';
                break;
            case '3' :
                $columns = 'col-xs-12 col-sm-6 col-md-4';
                break;
            case '4' :
                $columns = 'col-xs-12 col-sm-4 col-md-3';
                break;
            case '5' :
                $columns = 'col-xs-12 col-sm-4 col-md-3 col-lg-2_5';
                break;
            case '6' :
                $columns = 'col-xs-6 col-sm-3 col-md-3 col-lg-2';
                break;
            default :
                $columns = 'col-xs-12 col-sm-4 col-md-3';
        }

        $client_display_style = (!empty($atts['client_display_style']))?'has-'.$atts['client_display_style']:'' ; 
        $atts['client_gs_filter'] = ( $atts['client_gs_filter'] == '1' )?'has-grayscale':'';
        $atts['client_invert_filter'] = ( $atts['client_invert_filter'] == '1' )?'has-invert':'';

        if( !empty($atts['client_invert_filter']) || !empty($atts['client_gs_filter']) ){
            $client_filter = ' filter: ';
            $client_filter .= ( !empty($atts['client_gs_filter']) )?'grayscale(100%) ':'';
            $client_filter .= ( !empty($atts['client_invert_filter']) )?'invert(100%)':'';
        }

        $cli_thumb_args = array( 'style' => 'opacity: '.$atts['client_opacity'].'' );

		$client_gutter = ( empty($client_gutter) )?'0':intval($client_gutter/2);
		$client_gutter_style = 'padding: '.$client_gutter.'px; ';
		$client_gutter_row_style = 'style="margin: 0px -'.$client_gutter.'px"';

        foreach ( $values as $k => $v ) {
			$data[] = array(
				'client_img_id' => ( isset($v['client_img_id']) ) ? $v['client_img_id'] : '',
				'client_img_link' => ( isset($v['client_img_link']) ) ? $v['client_img_link'] : '',
			);
		}

        //$i = $delay = 0; 
        // Check if the Query returns any posts
        foreach ( $data as $atts ) {
                $client = $client_style = $client_animation_class = $client_animation_attr = $client_animation_style = '';

                if( $client_display_style == 'background' ){
                    $client_style = 'background-color: '.$client_bg_color.'; ';
                }
                else if( $client_display_style == 'border' ){
                    $client_style = 'border-color: '.$client_border_color.'; ';
                }

                if( !empty($client_padding) ){
                    $client_style .= 'padding: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $client_padding ) ? $client_padding : $client_padding . 'px' ) . '; ';
                }
                if( !empty($client_style) ){ 
                    $client_style = 'style="'.$client_style.'"'; 
                }

                if( $atts['client_img_link'] != '' ){    
                    $client = '<a href="'.$atts['client_img_link'].'">'.wp_get_attachment_image( $atts['client_img_id'], 'full', '', $cli_thumb_args  ).'</a>';
                } else{ 
                    $client = wp_get_attachment_image( $atts['client_img_id'], 'full', '', $cli_thumb_args );
                }

                $output .= '<div class="'.$client_animation_class.'client-column agni-client '.$columns.' '.esc_attr( $client_gs_filter ).' '.esc_attr( $client_invert_filter ).'" style="'.$client_gutter_style.$client_animation_style.$client_filter.'" '.$client_animation_attr.'>
                    <div class="client '.$client_display_style.'" '.$client_style.'>
                        '.$client.'
                    </div>
                </div>'; 

        } 


        $output = '<div class="agni-clients '.$client_class.'" data-clients-gutter="'.esc_attr( $client_gutter ).'" '.$carousel_atts.' '.$client_gutter_row_style.'>'.$output.'</div>'.$carousel_nav;

		return '<div class="agni-clients-container '.$carousel_container_class.'">'.$output.'</div>';
	}
	
	//Testimonials  
	public static function agni_testimonials($atts=null, $content=null){
		$atts = vc_map_get_attributes( 'agni_testimonials', $atts );
		extract( $atts );

		$values = vc_param_group_parse_atts( $atts['values'] );
		$data = array();

        $output = $quote_cat = $carousel_class = $carousel_container_class = $carousel_atts = $carousel_nav = $columns = $testimonial_style = $testimonial_gutter_row_style = $testimonial_gutter_style = $testimonial_animation_class = $testimonial_animation_attr = $testimonial_animation_style =  $testimonial_image = $testimonial_author = $testimonial_author_designation = $testimonial_quote = '';
        
            switch( $atts['columns'] ){
                case '1' :
                    $columns = 'col-xs-12 col-sm-12 col-md-12';
                    break;
                case '2' :
                    $columns = 'col-xs-12 col-sm-12 col-md-6';
                    break;
                case '3' :
                    $columns = 'col-xs-12 col-sm-6 col-md-4';
                    break;
                case '4' :
                    $columns = 'col-xs-12 col-sm-6 col-md-3';
                    break;
                case '5' :
                    $columns = 'col-xs-12 col-sm-6 col-md-3 col-lg-2_5';
                    break;
            }

        if( $atts['carousel'] == '1' ){

            wp_enqueue_style( 'halena-slick-style' );
            wp_enqueue_script( 'halena-slick-script' );
                
			$carousel_class .= ' agni-carousel';
			$carousel_container_class = ' agni-carousel-container';
			$atts['cat_thumbnail_individual_settings'] = '1';
			if( $atts['carousel_dots'] == '1' || $atts['carousel_arrows'] == '1' ){
				$carousel_nav = '<div class="slick-nav"></div>';
			}
			$carousel_atts = agni_carousel_atts_processor( $atts );
			if( is_rtl() ){
				$carousel_atts .= 'data-rtl="true"';
			}
			else{
				$carousel_atts .= 'data-rtl="false"';
			}
		}

        $testimonial_display_style = ( !empty($atts['testimonial_display_style']) )?'has-'.$atts['testimonial_display_style']:'';
        $atts['testimonial_thumbnail_gs_filter'] = ( $atts['testimonial_thumbnail_gs_filter'] == '1' )?'has-grayscale':'';
        $test_args = array( 'class' => ($atts['circle_avatar'] == '1')?'img-circle':''.' testimonial-thumbnail' ); 

        $atts['testimonial_gutter'] = ( empty($atts['testimonial_gutter']) )?'0':intval($atts['testimonial_gutter']/2);
        $testimonial_gutter_style = 'padding: '.$atts['testimonial_gutter'].'px; ';
        $testimonial_gutter_row_style = 'style="margin: 0px -'.$atts['testimonial_gutter'].'px"';

        foreach ( $values as $k => $v ) {
			$data[] = array(
				'test_img_id' => ( isset($v['test_img_id']) ) ? $v['test_img_id'] : '',
				'test_quote' => ( isset($v['test_quote']) ) ? $v['test_quote'] : '',
				'test_author' => ( isset($v['test_author']) ) ? $v['test_author'] : '',
				'test_author_designation' => ( isset($v['test_author_designation']) ) ? $v['test_author_designation'] : '',
			);
		}

        //$i = $delay = 0; 
        // Check if the Query returns any posts
        foreach ( $data as $atts ) {       
                
            $testimonial_image = $testimonial_style = $testimonial_content = $testimonial_animation_class = $testimonial_animation_attr = $testimonial_animation_style = '';

            if( !empty( $atts['test_author_designation'] ) ){
                $testimonial_author_designation = '<p class="testimonial-quote-designation">'.$atts['test_author_designation'].'</p>';
            }

            if( !empty($atts['test_img_id']) ){
                $testimonial_image_style = ( !empty($atts['testimonial_avatar_width']) )?'style="max-width:'.$atts['testimonial_avatar_width'].'px;"':'';
                $testimonial_image = '<div class="testimonial-avatar" '.$testimonial_image_style.'>'.wp_get_attachment_image( $atts['test_img_id'], 'full', '', $test_args ).'</div>';
            } 
            if( !empty($atts['test_quote']) ){
                
                $testimonial_quote_style = ( !empty($atts['testimonial_quote_size']) )?'font-size:'.$atts['testimonial_quote_size'].'px; ':'';

                if( $testimonial_display_style == 'background' ){
                    $testimonial_quote_style .= 'background-color: '.$testimonial_bg_color.'; ';
                }
                else if( $testimonial_display_style == 'border' ){
                    $testimonial_quote_style .= 'border-color: '.$testimonial_border_color.'; ';
                }
                if( !empty($testimonial_padding) ){
                    $testimonial_quote_style .= 'padding: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $testimonial_padding ) ? $testimonial_padding : $testimonial_padding . 'px' ) . '; ';
                }

                $testimonial_quote_style = ( !empty($testimonial_quote_style) )?'style="'.$testimonial_quote_style.'"':'';

                $testimonial_quote = '<div class="testimonial-quote-text" '.$testimonial_quote_style.'>'.$atts['test_quote'].'</div>';
            }
            if( !empty($atts['test_author']) ){
                $testimonial_author = '<h5 class="testimonial-quote-cite">'.$atts['test_author'].'</h5>';
            }

            if( !empty($testimonial_quote) || !empty($testimonial_author) ){
                $testimonial_meta = '<div class="testimonial-meta-content">';
                if( !empty($testimonial_image) && in_array( $avatar_location, array('3','5') ) ){
                    $testimonial_meta .= $testimonial_image;
                }
                $testimonial_meta .= '<div class="testimonial-meta">';
                $testimonial_meta .= $testimonial_author.$testimonial_author_designation;
                $testimonial_meta .= '</div>';
                $testimonial_meta .= '</div>';
            }

            if( !empty($testimonial_quote) || !empty($testimonial_meta) ){
                $testimonial_content_style = ($avatar_location == '6')?'style="margin-top: '.($atts['testimonial_avatar_width']/2).'px; "':'';
                $testimonial_content = '<div class="testimonial-content" '.$testimonial_content_style.'>
                    '.$testimonial_quote.$testimonial_meta.'
                </div>';
            }
            $testimonial_content = ( in_array( $avatar_location, array('3','5') ) )?$testimonial_content:$testimonial_image.$testimonial_content;


            $output .= '<div class="'.$testimonial_animation_class.'testimonial-column '.$columns.' '.$testimonial_thumbnail_gs_filter.'" style="'.$testimonial_gutter_style.$testimonial_animation_style.'" '.$testimonial_animation_attr.'>
                <div class="testimonial-container align-items-'.esc_attr( $alignment ).' testimonial-avatar-location-'.$avatar_location.' '.esc_attr( $testimonial_display_style ).'" '.$testimonial_style.'>
                    '.$testimonial_content.'
                </div>
            </div>';
        }  

        $output = '<div class="has-dots-'.$testimonial_pagination_style.' '.esc_attr( $class ).' '.$carousel_class.'" data-testimonial-gutter="'.esc_attr( $testimonial_gutter ).'" '.$carousel_atts.' '.$testimonial_gutter_row_style.'>'.$output.'</div>'.$carousel_nav;
		
		return '<div class="agni-testimonials-container '.$carousel_container_class.'">'.$output.'</div>' ;
	}
	
	// Post & portfolio post type
	public static function agni_posttypes( $atts = null, $content = null ) {
		$atts = vc_map_get_attributes( 'agni_posttypes', $atts );
		extract( $atts );  

		ob_start();
		
		if( $atts['posttype'] == 'portfolio' ){ 
			do_action( 'agni_portfolio_init', $atts, $shortcode = true );
		}
		elseif( $atts['posttype'] == 'post' ){  
			do_action( 'agni_posts_init', $atts, '', $shortcode = true ); 
		}
		$output = ob_get_contents();
		ob_end_clean();
		wp_reset_postdata();
		
		return $output;
	}

	// Woocommerce
	public static function agni_woo_products( $atts = null, $content = null ){
		$atts = vc_map_get_attributes( 'agni_woo_products', $atts );
		extract( $atts );  

		global $halena_options;
		$carousel_container_class = $carousel_atts = $carousel_nav = $product_class = $product_css = $product_content_padding = '';
		
		$product_gutter = !empty($atts['product_gutter_value'])?$atts['product_gutter_value']:0;

		if( $atts['carousel'] == '1' ){

            wp_enqueue_style( 'halena-slick-style' );
            wp_enqueue_script( 'halena-slick-script' );
                
			$product_class .= ' agni-carousel';
			$carousel_container_class = ' agni-carousel-container';
			$atts['cat_thumbnail_individual_settings'] = '1';
			if( $atts['carousel_dots'] == '1' || $atts['carousel_arrows'] == '1' ){
				$carousel_nav = '<div class="slick-nav"></div>';
			}
			$carousel_atts = agni_carousel_atts_processor( $atts );
			if( is_rtl() ){
				$carousel_atts .= 'data-rtl="true"';
			}
			else{
				$carousel_atts .= 'data-rtl="false"';
			}
		}

		switch( $atts['product_type'] ){
			case 'all' :
			case 'toprated' :
				$meta_query = WC()->query->get_meta_query();
				$args = array(
					'columns'				=> 3,
					'post_type'             => 'product',
					'post_status'           => 'publish',
					'ignore_sticky_posts'   => 1,
					'posts_per_page'        => $atts['posts_per_page'],
					'product_cat'           => $atts['product_categories'],
					'orderby'               => $atts['order_by'],
					'order'                 => $atts['order'],
					'meta_query'            => $meta_query
				);

				break;
			case 'sale' :
				$product_on_sale_IDs = wc_get_product_ids_on_sale();
				$meta_query   = array();
				$meta_query[] = WC()->query->visibility_meta_query();
				$meta_query[] = WC()->query->stock_status_meta_query();
				$meta_query   = array_filter( $meta_query );
				$args = array(
					'posts_per_page'    => $atts['posts_per_page'],
					'post_status'       => 'publish',
					'post_type'         => 'product',
					'product_cat'       => $atts['product_categories'],
					'orderby'           => $atts['order_by'],
					'order'             => $atts['order'],
					'meta_query'        => $meta_query,
					'post__in'          => array_merge( array( 0 ), $product_on_sale_IDs )
				);
				break;
			case 'featured' :
				$product_visibility_term_ids = wc_get_product_visibility_term_ids();
				/*$args = array(
					'post_type'             => 'product',
					'post_status'           => 'publish',
					'product_cat'           => $atts['product_categories'],
					'ignore_sticky_posts'   => 1,
					'posts_per_page'        => $atts['posts_per_page'],
					'orderby'               => $atts['order_by'],
					'order'                 => $atts['order'],
					'meta_query'            => array(
						array(
							'key'       => '_visibility',
							'value'     => array('catalog', 'visible'),
							'compare'   => 'IN'
						),
						array(
							'key'       => '_featured',
							'value'     => 'yes'
						)
					)
				);*/
				$args = array(
					'posts_per_page' => $atts['posts_per_page'],
					'post_status'    => 'publish',
					'post_type'      => 'product',
					'product_cat'    => $atts['product_categories'],
					'no_found_rows'  => 1,
					'orderby'        => $atts['order_by'],
					'order'          => $atts['order'],
					'meta_query'     => array(),
					'tax_query'      => array(
						'relation' => 'AND',
					),
				);
				
				$args['tax_query'][] = array(
					'taxonomy' => 'product_visibility',
					'field'    => 'term_taxonomy_id',
					'terms'    => $product_visibility_term_ids['featured'],
				);
				break;
			case 'best_selling' :
				$args = array(
					'post_type'             => 'product',
					'post_status'           => 'publish',
					'ignore_sticky_posts'   => 1,
					'product_cat'           => $atts['product_categories'],
					'posts_per_page'        => $atts['posts_per_page'],
					'orderby'               => $atts['order_by'],
					'order'                 => $atts['order'],
					'meta_key'              => 'total_sales',
					'orderby'               => 'meta_value_num',
					'meta_query'            => array(
						array(
							'key'       => '_visibility',
							'value'     => array( 'catalog', 'visible' ),
							'compare'   => 'IN'
						)
					)
				);
				break;
		}

		ob_start();

		if( $atts['product_type'] == 'toprated' ){
			add_filter( 'posts_clauses',  array( WC()->query, 'order_by_rating_post_clauses' ) );
		}

		if( $product_gutter != '' ){ 
			$product_class .= ' has-gutter';
			$product_css = 'style="margin: 0 -'.intval($product_gutter/2).'px;"'; 
		}

		$product_content_padding_array = array_filter( array(
			'top' => $atts['product_content_padding_top'],
			'right' => $atts['product_content_padding_right'],
			'bottom' => $atts['product_content_padding_bottom'],
			'left' => $atts['product_content_padding_left'],
		) );

		foreach ( $product_content_padding_array as $key => $value ) {
			$product_content_padding .= 'padding-'.$key.': '.( preg_match( '/(px|em|\%|pt|cm)$/', $value ) ? $value : $value . 'px' ).'; ';
		}

		$shop_grid_layout = isset($halena_options['shop-grid-layout'])?esc_attr( $halena_options['shop-grid-layout'] ):'fitRows';

		$products = new WP_Query( apply_filters( 'woocommerce_shortcode_products_query', $args, $atts ) );

		if ( $products->have_posts() ) : ?>
			<?php // echo wp_kses_post( $column ); ?>
			<?php //woocommerce_product_loop_start(); 
				echo '<ul class="products agni-shortcode-products agni-products-'.esc_attr( $atts['columns'] ).'-column '.$product_class.'" '.$product_css.' data-shop-grid="'.$shop_grid_layout.'" data-gutter="'.esc_attr( $product_gutter ).'" '.$carousel_atts.'>'; ?>
				
				<?php while ( $products->have_posts() ) : $products->the_post(); ?>

					<?php wc_get_template( 'content-product.php', array(
						'product_gutter' => $product_gutter,
						'product_content_padding' => $product_content_padding,
						'product_content_align' => $atts['product_content_align'],
						'product_hover_style' => $atts['product_hover_style'],
						'product_bg' => $atts['product_bg'],
					) ); ?>

				<?php endwhile; // end of the loop. ?>
			<?php
			echo '</ul>'; 

			echo wp_kses_post( $carousel_nav );
			//woocommerce_product_loop_end(); ?>

		<?php endif;

		wp_reset_postdata();

		$output = ob_get_contents();
		ob_end_clean();

		$output = '<div class="woocommerce columns-' . $columns . ' agni-products-'.$atts['product_type'].' '.$carousel_container_class.'">' . $output . '</div>';

		return $output;
			
	}

	public static function agni_woo_products_categories( $atts = null, $content = null ){
		$atts = vc_map_get_attributes( 'agni_woo_products_categories', $atts );
		extract( $atts );  

		//global $woocommerce_loop;
		$carousel_container_class = $carousel_nav = $carousel_atts = $shop_cat_css = $shop_cat_class = '';
		if ( isset( $atts['number'] ) ) {
			$atts['limit'] = $atts['number'];
		}

		$shop_grid_style = (!empty($atts['cat_grid_style']))?$atts['cat_grid_style']:'masonry';
		$shop_cat_gutter = !empty($atts['cat_gutter_value'])?$atts['cat_gutter_value']:0;
		$shop_cat_class .= ' shop-cat-hover-style-'.(!empty($atts['cat_thumbnail_hover_style'])?$atts['cat_thumbnail_hover_style']:'1');

		$ids = (!empty($atts['ids']))?array_filter( array_map( 'trim', explode( ',', $atts['ids'] ) ) ):'';

		// Get terms and workaround WP bug with parents/pad counts.
		$args = array(
			'orderby'    => $atts['order_by'],
			'order'      => $atts['order'],
			'hide_empty' => $atts['hide_empty'],
			'include'    => $ids,
			'pad_counts' => true,
			'child_of'   => $atts['parent'],
		);

		$product_categories = get_terms( 'product_cat', $args );

		if ( '' !== $atts['parent'] ) {
			$product_categories = wp_list_filter( $product_categories, array(
				'parent' => $atts['parent'],
			) );
		}

		if ( $hide_empty ) {
			foreach ( $product_categories as $key => $category ) {
				if ( 0 === $category->count ) {
					unset( $product_categories[ $key ] );
				}
			}
		}

		$atts['limit'] = '-1' === $atts['limit'] ? null : intval( $atts['limit'] );
		if ( $atts['limit'] ) {
			$product_categories = array_slice( $product_categories, 0, $atts['limit'] );
		}

		if( $shop_grid_style == 'masonry' ){
			wp_enqueue_script( 'halena-isotope-script' );
		}

		if( $shop_cat_gutter != '' ){ 
			$shop_cat_css = 'style="margin: 0 -'.intval($shop_cat_gutter/2).'px;"'; 
		}

		if( $atts['carousel'] == '1' ){

            wp_enqueue_style( 'halena-slick-style' );
            wp_enqueue_script( 'halena-slick-script' );
                
			$shop_cat_class .= ' agni-carousel';
			$carousel_container_class = ' agni-carousel-container';
			$atts['cat_thumbnail_individual_settings'] = '1';
			if( $atts['carousel_dots'] == '1' || $atts['carousel_arrows'] == '1' ){
				$carousel_nav = '<div class="slick-nav"></div>';
			}
			$carousel_atts = agni_carousel_atts_processor( $atts );
			if( is_rtl() ){
				$carousel_atts .= 'data-rtl="true"';
			}
			else{
				$carousel_atts .= 'data-rtl="false"';
			}
		}

		if( $atts['cat_thumbnail_individual_settings'] == '1' ){
			$shop_cat_class .= ' ignore-thumbnail-settings';
		}

		ob_start();

		if ( $product_categories ) {
			//woocommerce_product_loop_start();
			echo '<ul class="products agni-products-'.$atts['columns'].'-column agni-custom-product-categories '.$shop_cat_class.'" '.$shop_cat_css.' data-gutter="'.esc_attr( $shop_cat_gutter ).'" data-shop-grid="'.$shop_grid_style .'" '.$carousel_atts.'>';

			foreach ( $product_categories as $category ) {
				//$category['agni_thumbnail_dimension'] = '400x400';
				wc_get_template( 'content-product_cat.php', array(
					'category' => $category,
					'category_thumbnail_individual_settings' => $atts['cat_thumbnail_individual_settings'],
					'category_thumbnail_size' => $atts['cat_thumbnail_size'],
					'category_thumbnail_dimension' => $atts['cat_thumbnail_dimension_custom'],
					'category_thumbnail_gutter' => $shop_cat_gutter,
				) );
			}
			echo '<li class="grid-sizer shop-column width1x height1x"></li>';
			echo '</ul>';

			echo wp_kses_post( $carousel_nav );
			//woocommerce_product_loop_end();
		}

		woocommerce_reset_loop();

		$output = '<div class="woocommerce columns-' . $columns . ' '.$carousel_container_class.'">' . ob_get_clean() . '</div>';

		return $output;
			
	}

	// Latest Works
	public static function agni_widget_latestworks( $atts = null, $content = null ){
	    $atts = vc_map_get_attributes( 'agni_widget_latestworks', $atts );
		extract( $atts );

		$instance = array(
		    'title' => $atts['latest_works_title'],
		    'categories' => $atts['latest_works_categories'],
		    'number' => $atts['latest_works_count']
		);
	    ob_start(); 
	    	the_widget( 'halena_latest_works', $instance ); 
	    $content = ob_get_clean(); 

	    return $content;
	}

	// Latest Posts
	public static function agni_widget_latestposts( $atts = null, $content = null ){
	    $atts = vc_map_get_attributes( 'agni_widget_latestposts', $atts );
		extract( $atts );

		$instance = array(
		    'title' => $atts['latest_posts_title'],
		    'categories' => $atts['latest_posts_categories'],
		    'number' => $atts['latest_posts_count']
		);
	    ob_start(); 
	    	the_widget( 'halena_latest_posts', $instance ); 
	    $content = ob_get_clean(); 

	    return $content;
	}

	// Instagram Feed
	public static function agni_widget_instagram( $atts = null, $content = null ){
	    $atts = vc_map_get_attributes( 'agni_widget_instagram', $atts );
		extract( $atts );

		$instance = array(
		    'title' => $atts['instagram_title'],
		    'username' => $atts['instagram_username'],
		    'number' => $atts['instagram_count'],
		    'size' => $atts['instagram_size'],
		    'columns' => $atts['instagram-columns'],
		    'target' => $atts['instagram_target'],
		    'link' => $atts['instagram_followlink']
		);
	    ob_start(); 
	    	the_widget( 'halena_instagram_widget', $instance ); 
	    $content = ob_get_clean(); 

	    return $content;
	}

}
// Finally initialize code
new AgniShortcodesFunctions();

?>