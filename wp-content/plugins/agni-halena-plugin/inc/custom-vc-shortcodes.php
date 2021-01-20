<?php
/*
 * Custom Visual Composer Shortcodes
 */
if( !class_exists( 'AgniShortcodesInitialization' ) ){
	class AgniShortcodesInitialization {
	    function __construct() {
	 
	        // Use this when creating a shortcode addon
	        add_shortcode( 'agni_section_heading', array( 'AgniShortcodesFunctions', 'agni_section_heading' ) );
			add_shortcode( 'agni_blockquote', array( 'AgniShortcodesFunctions', 'agni_blockquote' ) );
			add_shortcode( 'agni_dropcap', array( 'AgniShortcodesFunctions', 'agni_dropcap' ) );
			add_shortcode( 'agni_separator', array( 'AgniShortcodesFunctions', 'agni_separator' ) );
			add_shortcode( 'agni_call_to_action', array( 'AgniShortcodesFunctions', 'agni_call_to_action' ) );
			add_shortcode( 'agni_icon', array( 'AgniShortcodesFunctions', 'agni_icon' ) );
			add_shortcode( 'agni_service', array( 'AgniShortcodesFunctions', 'agni_service' ) );
			add_shortcode( 'agni_pricingtable', array( 'AgniShortcodesFunctions', 'agni_pricingtable' ) );
			add_shortcode( 'agni_milestone', array( 'AgniShortcodesFunctions', 'agni_milestone' ) );
			add_shortcode( 'agni_circlebar', array( 'AgniShortcodesFunctions', 'agni_circlebar' ) );
			add_shortcode( 'agni_progressbar', array( 'AgniShortcodesFunctions', 'agni_progressbar' ) );
			add_shortcode( 'agni_list', array( 'AgniShortcodesFunctions', 'agni_list' ) );
			add_shortcode( 'agni_button', array( 'AgniShortcodesFunctions', 'agni_button' ) );		
			add_shortcode( 'agni_alerts', array( 'AgniShortcodesFunctions', 'agni_alerts' ) );	
			add_shortcode( 'agni_image', array( 'AgniShortcodesFunctions', 'agni_image' ) );	
			add_shortcode( 'agni_gallery', array( 'AgniShortcodesFunctions', 'agni_gallery' ) );
			add_shortcode( 'agni_video', array( 'AgniShortcodesFunctions', 'agni_video' ) );
			add_shortcode( 'agni_gmap', array( 'AgniShortcodesFunctions', 'agni_gmap' ) );
			add_shortcode( 'agni_countdown', array( 'AgniShortcodesFunctions', 'agni_countdown' ) );
			add_shortcode( 'agni_menu', array( 'AgniShortcodesFunctions', 'agni_menu' ) );
			//add_shortcode( 'agni_menu_card', array( 'AgniShortcodesFunctions', 'agni_menu_card' ) );
			add_shortcode( 'agni_testimonials', array( 'AgniShortcodesFunctions', 'agni_testimonials' ) );
			add_shortcode( 'agni_clients', array( 'AgniShortcodesFunctions', 'agni_clients' ) );
			add_shortcode( 'agni_team', array( 'AgniShortcodesFunctions', 'agni_team' ) );
			add_shortcode( 'agni_posttypes', array( 'AgniShortcodesFunctions', 'agni_posttypes' ) );
			add_shortcode( 'agni_block', array( 'AgniShortcodesFunctions', 'agni_block' ) );
			add_shortcode( 'agni_agnislider', array( 'AgniShortcodesFunctions', 'agni_agnislider' ) );
			add_shortcode( 'agni_fancy_image', array( 'AgniShortcodesFunctions', 'agni_fancy_image' ) );
			add_shortcode( 'agni_category_box', array( 'AgniShortcodesFunctions', 'agni_category_box' ) );
			add_shortcode( 'agni_hotspot', array( 'AgniShortcodesFunctions', 'agni_hotspot' ) );
			add_shortcode( 'agni_widget_latestworks', array( 'AgniShortcodesFunctions', 'agni_widget_latestworks' ) );
			add_shortcode( 'agni_widget_latestposts', array( 'AgniShortcodesFunctions', 'agni_widget_latestposts' ) );
			add_shortcode( 'agni_widget_instagram', array( 'AgniShortcodesFunctions', 'agni_widget_instagram' ) );
			if( class_exists( 'WooCommerce' ) ){
				add_shortcode( 'agni_woo_products', array( 'AgniShortcodesFunctions', 'agni_woo_products' ) );
				add_shortcode( 'agni_woo_products_categories', array( 'AgniShortcodesFunctions', 'agni_woo_products_categories' ) );
			}	
	    }
	}
	// Finally initialize code
	new AgniShortcodesInitialization();
}
