<?php
/**
 * Include and setup custom metaboxes and fields. (make sure you copy this file to outside the CMB2 directory)
 *
 * Be sure to replace all instances of 'yourprefix_' with your project's prefix.
 * http://nacin.com/2010/05/11/in-wordpress-prefix-everything/
 *
 * @category YourThemeOrPlugin
 * @package  Demo_CMB2
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/CMB2
 */

/*
 * Post format
 */
add_action( 'cmb2_init', 'agni_post_format_meta' );
function agni_post_format_meta() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = 'post_format_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$quote_post_option = new_cmb2_box( array(
		'id'            => $prefix . 'quote_post_options',
		'title'         => esc_html__( 'Quote Post Options', 'halena' ),
		'object_types'  => array( 'post' ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
	) );

	$quote_post_option->add_field( array(
			'name' => esc_html__('Quote Text', 'halena' ),
			'id' => $prefix.'quote_text',
			'type' => 'textarea_small'
	) );
	$quote_post_option->add_field( array(
			'name' => esc_html__('Quote author', 'halena' ),
			'id' => $prefix.'quote_cite',
			'type' => 'text_small'
	) );
	
	$link_post_option = new_cmb2_box( array(
		'id'            => $prefix . 'link_post_options',
		'title'         => esc_html__( 'Link Post Options', 'halena' ),
		'object_types'  => array( 'post' ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true,
	) );

	$link_post_option->add_field( array( 
		'name'	=> esc_html__('Link', 'halena' ), 
		'desc'	=> esc_html__('Type URL to display into the post', 'halena' ), 
		'id'	=> $prefix.'link_url', 
		'type'	=> 'text_url',
	) );
	
	$audio_post_option = new_cmb2_box( array(
		'id'            => $prefix . 'audio_post_options',
		'title'         => esc_html__( 'Audio Post Options', 'halena' ),
		'object_types'  => array( 'post' ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, 
	) );

	$audio_post_option->add_field( array( 
		'name'	=> esc_html__('Self Hosted Audio Link', 'halena' ), 
		'id'	=> $prefix.'audio_url', 
		'type'	=> 'file'
	) );
	
	$video_post_option = new_cmb2_box( array(
		'id'            => $prefix . 'video_post_options',
		'title'         => esc_html__( 'Video Post Options', 'halena' ),
		'object_types'  => array( 'post' ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, 
	) );

	$video_post_option->add_field( array( 
		'name'	=> esc_html__('Self Hosted Video Link', 'halena' ), 
		'desc'	=> esc_html__('Fill one of any video source info!!..', 'halena' ), 
		'id'	=> $prefix.'video_url', 
		'type'	=> 'file'
	) );
	$video_post_option->add_field( array( 
		'name'	=> esc_html__('Video Poster', 'halena' ), 
		'desc'	=> esc_html__('Only applicable for self hosted video', 'halena' ), 
		'id'	=> $prefix.'video_poster', 
		'type'	=> 'file'
	) );
	$video_post_option->add_field( array( 
		'name'	=> esc_html__('Embed Link', 'halena' ), 
		'desc'	=> esc_html__('enter the youtube, vimeo or any video embed link ', 'halena' ), 
		'id'	=> $prefix.'video_embed_url', 
		'type'	=> 'textarea_small',
		'sanitization_cb' => false
	) );
	
	$gallery_post_option = new_cmb2_box( array(
		'id'            => $prefix . 'gallery_post_options',
		'title'         => esc_html__( 'Gallery Post Options', 'halena' ),
		'object_types'  => array( 'post' ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true,
		 
	) );

	$gallery_post_option->add_field( array( 
		'name'	=> esc_html__('Choose Images ', 'halena' ), 
		'id'	=> $prefix . 'gallery_image', 
		'type'	=> 'file_list'			
	) );
}

/*
 * Page Options
 */
add_action( 'cmb2_init', 'agni_page_meta' );

function agni_page_meta() {
	
	// Start with an underscore to hide fields from custom fields list
	$prefix = 'page_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$page_option = new_cmb2_box( array(
		'id'            => $prefix . 'page_options',
		'title'         => esc_html__( 'Page Options', 'halena' ),
		'object_types'  => array( 'page', 'portfolio', 'post', 'product' ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
	) );

    $page_option->add_field( array(
		'name' => esc_html__( 'Page/Shop Description Stretch (width)', 'halena' ),
		'desc' => esc_html__('Inherit will use from the global(Halena -> Page options) settings. Note: Product layout style 4 on single product page, woocommerce pages like cart, checkout, my account pages will ignore this field.', 'halena' ),
		'id' => $prefix . 'layout',
		'type'	=> 'select',
		'options' => array( 
			'' 					=> esc_html__('Inherit', 'halena' ), 
            'container'			=> esc_html__('Container', 'halena'),
            'container-fluid'	=> esc_html__('Fullwidth', 'halena'),
		),
        'default'	=> '',
		'before_row' => '<h3>Layout Options</h3>'
	) );

	$page_option->add_field( array(
        'name'             => esc_html__( 'Sidebar', 'halena' ),
		'desc' 			   => esc_html__('This will not applicable for portfolio pages. Sidebar is diabled for portfolio.', 'halena' ),
        'id'               => $prefix . 'sidebar',
        'type'             => 'radio_inline',
        'options'          => array(
            ''		=> esc_html__('Inherit', 'halena'),
            'no-sidebar'		=> esc_html__('No Sidebar', 'halena'),
            'has-sidebar'	=> esc_html__('Right Sidebar', 'halena'),
            'has-sidebar left'		=> esc_html__('Left Sidebar', 'halena'),
        ),
        'default'			=> ''
    ) );

	$page_option->add_field( array(
		'name' => esc_html__('Agni Slider List', 'halena' ),
		'desc' => esc_html__('Here, you can choose the slider which is created under Agni Slider Menu(left side).', 'halena' ),
		'id' => $prefix.'agni_sliders',
		'type' => 'select',
		'options' => agni_posttype_options( array( 'post_type' => 'agni_slides'), true ),
		'before_row' => '<h3>Content Options</h3>'
	) );

	$page_option->add_field( array(
		'name' => esc_html__('Choose Content Block for Popup', 'halena' ),
		'desc' => esc_html__('Here, you can choose the slider which is created under Agni Slider Menu(left side).', 'halena' ),
		'id' => $prefix.'agni_blocks_popup',
		'type' => 'select',
		'options' => agni_posttype_options( array( 'post_type' => 'agni_block'), true ),
	) );
	$page_option->add_field( array(
		'name'	=> esc_html__('Fixed Shortnote', 'halena' ), 
		'desc'	=> esc_html__('for ex. Express delivery for shopping more than $300 & Free shipping all over the world!', 'halena' ), 
		'id'	=> $prefix.'agni_shortnote', 
		'type'	=> 'textarea_small',
		'attributes'  => array(
	        'rows'        => 2,
	    ),
		'default' => '',
	) );


	$page_option->add_field( array(
		'name'	=> esc_html__('Background Color', 'halena' ), 
		'id'	=> $prefix.'bg_color', 
		'type'	=> 'colorpicker',
		'default' => '',
	) );
	$page_option->add_field( array(
		'name' => esc_html__( 'Dark Mode', 'halena' ),
		'id' => $prefix . 'dark_mode',
		'type'	=> 'select',
		'options' => array( 
			'' => esc_html__('Inherit', 'halena' ), 
			'1' => esc_html__('Yes', 'halena' ), 
			'0' => esc_html__('No', 'halena' ), 
		),
        'default'	=> '',
	) );

	$page_option->add_field( array(
		'name' => esc_html__('Remove Title', 'halena' ),
		'desc' => esc_html__('Inherit will use from the global(option panel) settings. This option will not applicable for Shop single, portfolio template, latest post pages.', 'halena' ),
		'id' => $prefix.'remove_title',
		'type'	=> 'select',
		'options' => array( 
			'' => esc_html__('Inherit', 'halena' ), 
			'1' => esc_html__('Yes', 'halena' ), 
			'0' => esc_html__('No', 'halena' ), 
		),
		'default' => '',
	) );
	$page_option->add_field( array(
		'name'	=> esc_html__('Title Alignment', 'halena' ),
		'id'	=> $prefix . 'title_align',
		'type'	=> 'radio_inline',
		'options' => array( 
			''		=> esc_html__('Inherit', 'halena'),
			'left' => esc_html__('Left', 'halena' ), 
			'center' => esc_html__('Center', 'halena' ), 
			'right' => esc_html__('Right', 'halena' ), 
		),
		'default'  => ''
	) );

	$page_option->add_field( array(
		'name' => esc_html__('Disable Menu', 'halena' ),
		'id' => $prefix.'menu_disable',
		'type'	=> 'select',
		'options' => array( 
			'' => esc_html__('Inherit', 'halena' ), 
			'1' => esc_html__('Yes', 'halena' ), 
			'0' => esc_html__('No', 'halena' ), 
		),
		'default' => '',
		'before_row' => '<h3>Menu Options</h3>'
	) );

	$page_option->add_field( array(
		'name' => esc_html__('Menu Choice', 'halena' ),
		'id' => $prefix.'menu_choice',
		'type'	=> 'select',
		'options' => agni_registered_menus( true ),
		'default' => '',
	) );
	$page_option->add_field( array(
		'name' => esc_html__('Additional Menu Choice', 'halena' ),
		'id' => $prefix.'menu_choice_additional',
		'type'	=> 'select',
		'options' => agni_registered_menus( true ),
		'default' => '',
	) );
	$page_option->add_field( array(
		'name' => esc_html__('Fullwidth', 'halena' ),
		'id' => $prefix.'menu_fullwidth',
		'type'	=> 'select',
		'options' => array( 
			'' => esc_html__('Inherit', 'halena' ), 
			'1' => esc_html__('Yes', 'halena' ), 
			'0' => esc_html__('No', 'halena' ), 
		),
		'default' => '',
	) );

	$page_option->add_field( array(
		'name' => esc_html__('Transparent Menu', 'halena' ),
		'id' => $prefix.'transparent',
		'type'	=> 'select',
		'options' => array( 
			'' => esc_html__('Inherit', 'halena' ), 
			'1' => esc_html__('Yes', 'halena' ), 
			'0' => esc_html__('No', 'halena' ), 
		),
		'default' => '',
	) );

	$page_option->add_field( array(
		'name' => esc_html__('Reverse Menu Skin', 'halena' ),
		'desc' => esc_html__('It will reverse(interchange) your current header menu bar skin.', 'halena' ),
		'id' => $prefix.'skin_reverse',
		'type'	=> 'checkbox',
		'default' => '',
	) );

	$page_option->add_field( array(
		'name' => esc_html__('Footer Bar', 'halena' ),
		'id' => $prefix.'footer_bar',
		'type'	=> 'select',
		'options' => array( 
			'' => esc_html__('Inherit', 'halena' ), 
			'1' => esc_html__('Enable', 'halena' ), 
			'0' => esc_html__('Disable', 'halena' ), 
		),
		'default' => '',
		'before_row' => '<h3>Footer Options</h3>'
	) );

	$page_option->add_field( array(
		'name' => esc_html__('Footer Bar Choice', 'halena' ),
		'desc' => esc_html__('Choose footer bar. ', 'halena' ),
		'id' => $prefix.'footer_bar_choice',
		'type'	=> 'select',
		'options' => array( 
			''  => '', 
			'1' => esc_html__('Content Block', 'halena' ), 
			'0' => esc_html__('Widget Bar', 'halena' ), 
		),
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'footer_bar' ,
 			'data-conditional-value' => '1',
 		),
		'default' => '',
	) );

	$page_option->add_field( array(
		'name' => esc_html__( 'Footer Bar Fullwidth', 'halena' ),
		'id' => $prefix . 'footer_bar_fullwidth',
		'type'	=> 'select',
		'options' => array( 
			'' => esc_html__('Inherit', 'halena' ), 
			'1' => esc_html__('Yes', 'halena' ), 
			'0' => esc_html__('No', 'halena' ), 
		),
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'footer_bar_choice' ,
 			'data-conditional-value' => '0',
 		),
        'default'	=> '',
	) );
	$page_option->add_field( array(
		'name' => esc_html__('Content Block Choice', 'halena' ),
		'desc' => esc_html__('Choose footer bar. ', 'halena' ),
		'id' => $prefix.'footer_bar_contentblock',
		'type'	=> 'select',
		'options' => agni_posttype_options( array( 'post_type' => 'agni_block'), true ),
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'footer_bar_choice' ,
 			'data-conditional-value' => '1',
 		),
	) );

	$page_option->add_field( array(
		'name' => esc_html__('Footer Info.', 'halena' ),
		'id' => $prefix.'footer_text',
		'type'	=> 'select',
		'options' => array( 
			'' => esc_html__('Inherit', 'halena' ), 
			'1' => esc_html__('Enable', 'halena' ), 
			'0' => esc_html__('Disable', 'halena' ), 
		),
		'default' => '',
	) );
}

/*
 * Portfolio
 */
add_action( 'cmb2_init', 'agni_portfolio_meta' );
function agni_portfolio_meta() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = 'portfolio_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$portfolio_option = new_cmb2_box( array(
		'id'            => $prefix . 'portfolio_options',
		'title'         => esc_html__( 'Portfolio Options', 'halena' ),
		'object_types'  => array( 'portfolio' ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
	) );

	// Portfolio Layout Settings
	$portfolio_option->add_field( array( 
        'name'             => esc_html__( 'Portfolio Layout', 'halena' ),
        'id'               => $prefix . 'layout',
        'type'             => 'radio_image',
        'options'          => array(
            'plain'			=> esc_html__('Plain/Simple Portfolio', 'halena'),
            'side'			=> esc_html__('Side Portfolio', 'halena'),
            'full'			=> esc_html__('Fullwidth Portfolio', 'halena'),
            'zigzag'		=> esc_html__('ZigZag Portfolio', 'halena'),
        ),
        'images_path'      => AGNI_FRAMEWORK_URL . '/template/img/',
        'images'           => array(
            'plain'			=> 'portfolio-layout-0.jpg',
            'side'			=> 'portfolio-layout-1.jpg',
            'full'			=> 'portfolio-layout-2.jpg',
            'zigzag'		=> 'portfolio-layout-3.jpg',
        ),
        'default'			=> 'plain',
        'before_row' => '<h3>Portfolio Layout Options</h3>'
    ) );

    $portfolio_option->add_field( array(
		'name' => esc_html__('Media Position', 'halena' ),
		'desc' => esc_html__('Choose the position of the media to display. Behind Content option will display the content at right side only when you trigger.', 'halena' ),
		'id' => $prefix.'media_position',
		'type'	=> 'select',
		'options' => array( 
			'top' => esc_html__('At Top', 'halena' ), 
			'bottom' => esc_html__('At Bottom', 'halena' ), 
			//'behind' => esc_html__('Behind Content', 'halena' ), 
		),
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'layout' ,
 			'data-conditional-value' => json_encode(array('full', 'zigzag')),
 		),
		'default' => 'top',
	) );

	$portfolio_option->add_field( array(
		'name' => esc_html__('Columns Count', 'halena' ),
		'desc'	=> esc_html__('No. of Columns for Media. Note: Total column count should be 12. ', 'halena' ), 
		'id' => $prefix.'media_side_column_count',
		'type'	=> 'select',
		'options' => array( 
			'2' => esc_html__('2 Columns', 'halena' ), 
			'3' => esc_html__('3 Columns', 'halena' ), 
			'4' => esc_html__('4 Columns', 'halena' ), 
			'5' => esc_html__('5 Columns', 'halena' ),
			'6' => esc_html__('6 Columns', 'halena' ), 
			'7' => esc_html__('7 Columns', 'halena' ), 
			'8' => esc_html__('8 Columns', 'halena' ), 
			'9' => esc_html__('9 Columns', 'halena' ), 
			'10' => esc_html__('10 Columns', 'halena' ), 
		),
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'layout' ,
 			'data-conditional-value' => 'side',
 		),
		'default' => '6',
		'row_classes' => 'agni-slide-col agni-slide-animate-in',
		'before_row' => '<div class="cmb-row agni-slide-row agni-slide-animate-container">'
	) );
	$portfolio_option->add_field( array(
		'name' => esc_html__('Media Columns Count', 'halena' ),
		'desc'	=> esc_html__('No. of Columns for Content.', 'halena' ), 
		'id' => $prefix.'content_side_column_count',
		'type'	=> 'select',
		'options' => array( 
			'2' => esc_html__('2 Columns', 'halena' ), 
			'3' => esc_html__('3 Columns', 'halena' ), 
			'4' => esc_html__('4 Columns', 'halena' ), 
			'5' => esc_html__('5 Columns', 'halena' ),
			'6' => esc_html__('6 Columns', 'halena' ), 
			'7' => esc_html__('7 Columns', 'halena' ), 
			'8' => esc_html__('8 Columns', 'halena' ), 
			'9' => esc_html__('9 Columns', 'halena' ), 
			'10' => esc_html__('10 Columns', 'halena' ), 
		),
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'layout' ,
 			'data-conditional-value' => 'side',
 		),
 		'show_names' => false,
		'default' => '6',
		'row_classes' => 'agni-slide-col agni-slide-animate-in',
		'after_row' => '</div>'
	) );
	$portfolio_option->add_field( array(
		'name' => esc_html__('Alignment', 'halena' ),
		'desc'	=> esc_html__('.', 'halena' ), 
		'id' => $prefix.'side_alignment',
		'type'	=> 'radio_inline',
		'options' => array( 
			'mc' => esc_html__('Media + Content', 'halena' ), 
			'cm' => esc_html__('Content + Media', 'halena' )
		),
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'layout' ,
 			'data-conditional-value' => 'side',
 		),
 		'default' => 'mc'
	) );
	$portfolio_option->add_field( array( 
		'name'	=> esc_html__('Content Sticky', 'halena' ),
		'id'	=> $prefix.'side_content_sticky',
		'type'	=> 'checkbox',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'layout' ,
 			'data-conditional-value' => 'side',
 		),
	) );

	$portfolio_option->add_field( array( 
		'name'	=> esc_html__('Media Gap(Gutter)', 'halena' ),
		'desc'	=> esc_html__('Enable to show the gutter between each media', 'halena' ), 
		'id'	=> $prefix.'media_gutter',
		'type'	=> 'radio_inline',
		'options' => array( 
			'yes' => esc_html__('Yes', 'halena' ), 
			'no' => esc_html__('No', 'halena' )
		),
 		'default' => 'yes'
	) );
	$portfolio_option->add_field( array( 
		'name'	=> esc_html__('Gutter Value', 'halena' ), 
		'desc'	=> esc_html__('Gap between each media item. Enter values in px. Don\'t include "px" string', 'halena' ), 
		'id'	=> $prefix.'media_gutter_value', 
		'type'	=> 'text_small',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'media_gutter' ,
 			'data-conditional-value' => 'yes',
 		),
		'default' => '30',
	) );

	$portfolio_layout_repeatable = $portfolio_option->add_field( array(
		'id'          => $prefix . 'layout_repeatable',
		'type'        => 'group',
		'options'     => array(
			'group_title'   => esc_html__( 'Media {#}', 'halena' ), // {#} gets replaced by row number
			'add_button'    => esc_html__( 'Add another Media', 'halena' ),
			'remove_button' => esc_html__( 'Remove Media', 'halena' ),
			'sortable'      => true, // beta
		)
	) );

	$portfolio_option->add_group_field( $portfolio_layout_repeatable, array(
		'name' => esc_html__('Columns Count', 'halena' ),
		'desc'	=> esc_html__('No. of Columns for Media.', 'halena' ), 
		'id' => 'media_zigzag_column_count',
		'type'	=> 'select',
		'options' => array( 
			'2' => esc_html__('2 Columns', 'halena' ), 
			'3' => esc_html__('3 Columns', 'halena' ), 
			'4' => esc_html__('4 Columns', 'halena' ), 
			'5' => esc_html__('5 Columns', 'halena' ),
			'6' => esc_html__('6 Columns', 'halena' ), 
			'7' => esc_html__('7 Columns', 'halena' ), 
			'8' => esc_html__('8 Columns', 'halena' ), 
			'9' => esc_html__('9 Columns', 'halena' ), 
			'10' => esc_html__('10 Columns', 'halena' ), 
		),
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'layout' ,
 			'data-conditional-value' => 'zigzag',
 		),
		'default' => '6',
		'row_classes' => 'agni-slide-col agni-slide-animate-in',
		'before_row' => '<div class="cmb-row agni-slide-row agni-slide-animate-container">'
	) );
	$portfolio_option->add_group_field( $portfolio_layout_repeatable, array(
		//'name' => esc_html__('Media Columns Count', 'halena' ),
		'desc'	=> esc_html__('No. of Columns for Description.', 'halena' ), 
		'id' => 'description_zigzag_column_count',
		'type'	=> 'select',
		'options' => array( 
			'2' => esc_html__('2 Columns', 'halena' ), 
			'3' => esc_html__('3 Columns', 'halena' ), 
			'4' => esc_html__('4 Columns', 'halena' ), 
			'5' => esc_html__('5 Columns', 'halena' ),
			'6' => esc_html__('6 Columns', 'halena' ), 
			'7' => esc_html__('7 Columns', 'halena' ), 
			'8' => esc_html__('8 Columns', 'halena' ), 
			'9' => esc_html__('9 Columns', 'halena' ), 
			'10' => esc_html__('10 Columns', 'halena' ), 
		),
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'layout' ,
 			'data-conditional-value' => 'zigzag',
 		),
 		'show_names' => false,
		'default' => '6',
		'row_classes' => 'agni-slide-col agni-slide-animate-in',
		'after_row' => '</div>'
	) );
	$portfolio_option->add_group_field( $portfolio_layout_repeatable, array(
		'name' => esc_html__('Alignment', 'halena' ),
		'id' => 'media_zigzag_alignment',
		'type'	=> 'radio_inline',
		'options' => array( 
			'md' => esc_html__('Media + Description', 'halena' ), 
			'dm' => esc_html__('Description + Media', 'halena' )
		),
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'layout' ,
 			'data-conditional-value' => 'zigzag',
 		),
 		'default' => '1'
	) );

	$portfolio_option->add_group_field( $portfolio_layout_repeatable, array(
		'name' => esc_html__('Description', 'halena' ),
		'desc'	=> esc_html__('It will display the description about this image/section at side.', 'halena' ), 
		'id' => 'description_zigzag',
		'type' => 'textarea',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'layout' ,
 			'data-conditional-value' => 'zigzag',
 		),
	) );
	//Vertical align

	$portfolio_option->add_group_field( $portfolio_layout_repeatable, array(
		'name' => esc_html__('Media Type', 'halena' ),
		'id' => 'media_type',
		'type'	=> 'radio_inline',
		'options' => array( 
			'image' => esc_html__('Image', 'halena' ), 
			'gallery' => esc_html__('Gallery/Slider', 'halena' ), 
			'beforeafter' => esc_html__('Before-After', 'halena' ), 
			//'video' => esc_html__('Video', 'halena' ), 
		),
		'default' => 'image',
	) );

	$portfolio_option->add_group_field( $portfolio_layout_repeatable, array( 
		'name'	=> esc_html__('Choose Image', 'halena' ), 
		'id'	=> 'media_image', 
		'type'	=> 'file',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $portfolio_layout_repeatable, 'media_type' ) ),
 			'data-conditional-value' => json_encode( array( 'image', 'beforeafter' ) ),
 		),
	) );

	$portfolio_option->add_group_field( $portfolio_layout_repeatable, array(
		'name'	=> esc_html__('Choose Images ', 'halena' ), 
		'id'	=> 'media_gallery', 
		'type'	=> 'file_list',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $portfolio_layout_repeatable, 'media_type' ) ),
 			'data-conditional-value' => 'gallery',
 		),	
	) );

	$portfolio_option->add_group_field( $portfolio_layout_repeatable, array(
		'name' => esc_html__('Show Image(s) Caption', 'halena' ),
		'desc'	=> esc_html__('It will display the caption of the image(s) at the bottom.', 'halena' ), 
		'id' => 'media_caption',
		'type' => 'checkbox',
	) );
	$portfolio_option->add_group_field( $portfolio_layout_repeatable, array(
		'name' => esc_html__('On Click', 'halena' ),
		'id' => 'media_onclick',
		'type'	=> 'select',
		'options' => array( 
			'1' => esc_html__('None', 'halena' ), 
			'2' => esc_html__('Attachment Image', 'halena' ), 
			'3' => esc_html__('Lightbox', 'halena' ), 
		),
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $portfolio_layout_repeatable, 'media_type' ) ),
 			'data-conditional-value' => json_encode( array( 'image', 'gallery') ),
 		),
		'default' => '1',
	) );

	$portfolio_option->add_group_field( $portfolio_layout_repeatable, array(
		'name' => esc_html__('Gallery Choice', 'halena' ),
		'id' => 'gallery_choice',
		'type'	=> 'radio_inline',
		'options' => array( 
			'gallery' => esc_html__('Grid Gallery', 'halena' ), 
			'carousel' => esc_html__('Carousel', 'halena' ), 
			'' => esc_html__('None', 'halena' ), 
		),
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $portfolio_layout_repeatable, 'media_type' ) ),
 			'data-conditional-value' => 'gallery',
 		),
		'default' => '',
	) );
	$portfolio_option->add_group_field( $portfolio_layout_repeatable, array(
		'name' => esc_html__('Grid Style', 'halena' ),
		'id' => 'media_grid_layout',
		'type'	=> 'select',
		'options' => array( 
			'fitRows' => esc_html__('FitRows(Default)', 'halena' ), 
			'masonry' => esc_html__('Masonry', 'halena' ), 
		),
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $portfolio_layout_repeatable, 'gallery_choice' ) ),
 			'data-conditional-value' => 'gallery'
 		),
		'default' => 'fitRows'
	) );
	$portfolio_option->add_group_field( $portfolio_layout_repeatable, array(
		'name' => esc_html__('Number of Images', 'halena' ),
		'desc'	=> esc_html__('images per row.', 'halena' ), 
		'id' => 'media_images_row',
		'type'	=> 'select',
		'options' => array( 
			'1' => esc_html__('1', 'halena' ), 
			'2' => esc_html__('2', 'halena' ), 
			'3' => esc_html__('3', 'halena' ), 
			'4' => esc_html__('4', 'halena' ), 
			'5' => esc_html__('5', 'halena' ),
			'6' => esc_html__('6', 'halena' ),
		),
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $portfolio_layout_repeatable, 'gallery_choice' ) ),
 			'data-conditional-value' => json_encode( array('gallery', 'carousel') )
 		),
		'default' => '3'
	) );
	$portfolio_option->add_group_field( $portfolio_layout_repeatable, array(
		'name' => esc_html__('Carousel Holder', 'halena' ),
		'id' => 'media_carousel_type',
		'type'	=> 'select',
		'options' => array( 
			'img-carousel' => esc_html__('Img tag', 'halena' ), 
			'bg-carousel' => esc_html__('Background Image', 'halena' ), 
		),
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $portfolio_layout_repeatable, 'gallery_choice' ) ),
 			'data-conditional-value' => 'carousel'
 		),
		'default' => 'img-carousel'
	) );
	$portfolio_option->add_group_field( $portfolio_layout_repeatable, array( 
		'name'	=> esc_html__('Carousel Height', 'halena' ), 
		'desc' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels. Tip. for 100% Viewport height use "100vh"', 'halena' ),
		'id'	=> 'media_carousel_height', 
		'type'	=> 'text',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $portfolio_layout_repeatable, 'media_carousel_type' ) ),
 			'data-conditional-value' => 'bg-carousel'
 		),
		'default' => '500'
	) );

	$portfolio_option->add_group_field( $portfolio_layout_repeatable, array( 
		'name'	=> esc_html__('Choose After Image', 'halena' ), 
		'id'	=> 'media_image_2', 
		'type'	=> 'file',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $portfolio_layout_repeatable, 'media_type' ) ),
 			'data-conditional-value' => 'beforeafter',
 		),
	) );

	$portfolio_option->add_group_field( $portfolio_layout_repeatable, array(
		'name' => esc_html__('Show After Image Caption', 'halena' ),
		'desc'	=> esc_html__('It will display the caption of the image(s) at the bottom.', 'halena' ), 
		'id' => 'media_caption_2',
		'type' => 'checkbox',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $portfolio_layout_repeatable, 'media_image_2' ) ),
 		),
	) );

	// Portfolio Additional Settings
	$portfolio_option->add_field( array( 
		'name'	=> esc_html__('Project Title', 'halena' ), 
		'id'	=> $prefix.'project_title', 
		'type'	=> 'text',
		'before_row' => '<h3>Portfolio Additional Settings</h3>'
	) );
	$portfolio_option->add_field( array( 
		'name' => esc_html__('Project Description', 'halena' ),
		'desc'	=> esc_html__('It will display the description of the project.', 'halena' ), 
		'id' => $prefix.'project_description',
		'attributes' => array(
			'rows' => '6'
		),
		'type' => 'textarea',
	) );
	$portfolio_option->add_field( array( 
		'name'	=> esc_html__('Project Details', 'halena' ), 
		'id'	=> $prefix.'project_detail', 
		'type'	=> 'textarea_small',
		'attributes' => array(
			'placeholder' => 'Date : 27 Oct 2016',
			'rows'        => 1,
			'columns'        => 30,
		),
		'repeatable' => true,
	) );

	$portfolio_option->add_field( array( 
		'name'	=> esc_html__('Project Link Text', 'halena' ), 
		'desc'	=> esc_html__('value for the project link button.', 'halena' ), 
		'id'	=> $prefix.'project_link', 
		'type'	=> 'text_small',
	) );
	$portfolio_option->add_field( array( 
		'name'	=> esc_html__('Project Link URL', 'halena' ), 
		'desc'	=> esc_html__('url for the project link button.', 'halena' ), 
		'id'	=> $prefix.'project_link_url', 
		'type'	=> 'text_url',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'project_link' ,
 		),
	) );
	$portfolio_option->add_field( array(
		'name' => esc_html__('Addiitonal Details Style', 'halena' ),
		'id' => $prefix.'additional_details_style',
		'type'	=> 'select',
		'options' => array( 
			'1' => esc_html__('Side by Side (Description + Details)', 'halena' ), 
			'2' => esc_html__('Side by Side (Details + Description)', 'halena' ), 
			'3' => esc_html__('One by One (Description + Details)', 'halena' ), 
			'4' => esc_html__('One by One (Details + Description)', 'halena' ), 
		),
		'default' => '1',
	) );

	$portfolio_option->add_field( array( 
		'name'	=> esc_html__('Portfolio Navigation', 'halena' ),
		'id'	=> $prefix.'navigation',
		//'type'	=> 'radio_image',
		'type'	=> 'select',
		'options' => array( 
			'' => esc_html__('Inherit', 'halena' ), 
			'1' => esc_html__('Enable', 'halena' ), 
			'0' => esc_html__('Disable', 'halena' ),
		),
		'default' => '',
	) );

	// Portfolio Thumbnail Options
	$portfolio_option->add_field( array( 
		'name'	=> esc_html__('Portfolio Custom Link', 'halena' ), 
		'desc'	=> esc_html__('This custom link will replace the actual portfolio single page link.', 'halena' ), 
		'id'	=> $prefix.'thumbnail_custom_link', 
		'type'	=> 'text_url',
		'before_row' => '<h3>Portfolio Thumbnail Settings</h3>'
	) );
	$portfolio_option->add_field( array( 
		'name'	=> esc_html__('Portfolio Thumbnail Width', 'halena' ),
		'desc'	=> esc_html__('It will be ignored, if you\'re using carousels.', 'halena'),
		'id'	=> $prefix.'thumbnail_width',
		'type'	=> 'radio_inline',
		'options' => array( 
			'width1x' => esc_html__('1x', 'halena' ), 
			//'width1_5x' => esc_html__('1.5x', 'halena' ), 
			'width2x' => esc_html__('2x', 'halena' ), 
			'width3x' => esc_html__('3x', 'halena' ), 
		),
		'default' => 'width1x',
	) );
	$portfolio_option->add_field( array( 
		'name'	=> esc_html__('Portfolio Thumbnail Height', 'halena' ),
		'desc'	=> esc_html__('It will be ignored, If you\'re using carousels or If you disabled the Portfolio Thumbnails Hard Crop at Halena/Portfolio Settings & Shortcode elements.', 'halena'),
		'id'	=> $prefix.'thumbnail_height',
		'type'	=> 'radio_inline',
		'options' => array( 
			'height1x' => esc_html__('1x', 'halena' ), 
			//'height1_5x' => esc_html__('1.5x', 'halena' ), 
			'height2x' => esc_html__('2x', 'halena' ), 
			'height3x' => esc_html__('3x', 'halena' ), 
		),
		'default' => 'height1x',
	) );
	$portfolio_option->add_field( array( 
		'name'	=> esc_html__('Portfolio Thumbnail Hover Style', 'halena' ),
		'id'	=> $prefix.'thumbnail_hover_style',
		//'type'	=> 'radio_image',
		'type'	=> 'select',
		'options' => array( 
			'' => esc_html__('Inherit', 'halena' ), 
			'1' => esc_html__('Style 1', 'halena' ), 
			'2' => esc_html__('Style 2', 'halena' ), 
			'3' => esc_html__('Style 3', 'halena' ), 
			'4' => esc_html__('Style 4', 'halena' ), 
			'5' => esc_html__('Style 5', 'halena' ), 
			'6' => esc_html__('Style 6', 'halena' ), 
			'7' => esc_html__('Style 7', 'halena' )
		),
		'default' => '',
	) );
	$portfolio_option->add_field( array( 
		'name'	=> esc_html__('Hover Background Color', 'halena' ), 
		'id'	=> $prefix.'thumbnail_hover_bg_color', 
		'type'	=> 'rgba_colorpicker',
 		'default' => ''
	) );
	$portfolio_option->add_field( array( 
		'name'	=> esc_html__('Hover Content Color', 'halena' ), 
		'id'	=> $prefix.'thumbnail_hover_color', 
		'type'	=> 'colorpicker',
	) );
	$portfolio_option->add_field( array( 
		'name'	=> esc_html__('Keep Hovered', 'halena' ),
		'id'	=> $prefix.'thumbnail_native_hover',
		'type'	=> 'checkbox',
	) );
}

add_action( 'cmb2_init', 'agni_product_meta' );
function agni_product_meta() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = 'product_';

	$product_option = new_cmb2_box( array(
		'id'            => $prefix . 'product_options',
		'title'         => esc_html__( 'Product Options', 'halena' ),
		'object_types'  => array( 'product' ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
	) );

	$product_option->add_field( array(
		'name'	=> esc_html__( 'Layout Style', 'halena' ),
		'id'	=> $prefix.'layout_style',
		'type'	=> 'select',
		'options' => array( 
			'' => esc_html__('Inherit', 'halena' ), 
			'1' => esc_html__('Style 1', 'halena' ), 
			'2' => esc_html__('Style 2', 'halena' ), 
			'3' => esc_html__('Style 3', 'halena' ), 
			'4' => esc_html__('Style 4', 'halena' ), 
		),
		'default' => '',
	) );
	$product_option->add_field( array(
		'name'	=> esc_html__( 'Active Tab', 'halena' ),
		'id'	=> $prefix.'single_tab_active',
		'type'	=> 'select',
		'options' => array( 
			'' => esc_html__('None', 'halena' ), 
			'description' => esc_html__('Description', 'halena' ), 
			'additional_information' => esc_html__('Additional Information', 'halena' ), 
			'reviews' => esc_html__('Reviews', 'halena' ), 
		),
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'layout_style' ,
 			'data-conditional-value' => '3',
 		),
		'default' => '',
	) );
	$product_option->add_field( array(
		'name'	=> esc_html__( 'Product Sticky', 'halena' ),
		'id'	=> $prefix.'layout_sticky',
		'type'	=> 'select',
		'options' => array( 
			'' => esc_html__('Inherit', 'halena' ), 
			'1' => esc_html__('Enable', 'halena' ), 
			'0' => esc_html__('Disable', 'halena' ),
		),
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'layout_style' ,
 			'data-conditional-value' => '3',
 		),
		'default' => '',
	) );

	$product_option->add_field( array(
		'name'	=> esc_html__( 'Product Cart style', 'halena' ),
		'id'	=> $prefix.'cart_style',
		'type'	=> 'select',
		'options' => array( 
			'' => esc_html__('Inherit', 'halena' ), 
			'1' => esc_html__('Style 1', 'halena' ), 
			'2' => esc_html__('Style 2', 'halena' ), 
		),
		'default' => '',
	) );
	$product_option->add_field( array(
		'name'	=> esc_html__( 'Sticky Add to Cart', 'halena' ),
		'id'	=> $prefix.'add_to_cart_sticky',
		'type'	=> 'select',
		'options' => array( 
			'' => esc_html__('Inherit', 'halena' ), 
			'1' => esc_html__('Enable', 'halena' ), 
			'0' => esc_html__('Disable', 'halena' ), 
		),
		'default' => '',
	) );

	$product_option->add_field( array(
		'name'	=> esc_html__( 'Embed Video URL', 'halena' ), 
		'desc'	=> esc_html__( 'Enter your desired embed video url.', 'halena' ), 
		'id'	=> $prefix.'video_url', 
		'type'	=> 'textarea_small',
		'sanitization_cb' => false,
		'attributes'  => array(
	        'rows'        => 2,
	    ),
	) );

	$product_option->add_field( array(
		'name'	=> esc_html__( '360 degree viewer', 'halena' ), 
		'desc'	=> esc_html__( 'Choose Sequence of Images. Add atleast 30 images to see flawless 360 deg image.', 'halena' ), 
		'id'	=> $prefix . '360_image', 
		'type'	=> 'file_list'			
	) );
}

add_action( 'cmb2_init', 'agni_term_options_meta' );
function agni_term_options_meta() {
	
	// Start with an underscore to hide fields from custom fields list
	$prefix = 'terms_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$term_option = new_cmb2_box( array(
		'id'            => $prefix . 'term_options',
		'title'         => esc_html__( 'Term Options', 'halena' ),
		'object_types'  => array( 'term' ), // Post type
		'taxonomies'       => array( 'category', 'post_tag', 'types', 'product_cat' ), // Tells CMB2 which taxonomies should have these fields
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
	) );
	$term_option->add_field( array(
		'name'	=> esc_html__('Product Category Width', 'halena' ),
		'desc'	=> esc_html__('It will be ignored, if you\'re using carousels.', 'halena'),
		'id'	=> $prefix.'thumbnail_width',
		'type'	=> 'radio_inline',
		'options' => array( 
			'width1x' => esc_html__('1x', 'halena' ), 
			//'width1_5x' => esc_html__('1.5x', 'halena' ), 
			'width2x' => esc_html__('2x', 'halena' ), 
			'width3x' => esc_html__('3x', 'halena' ), 
		),
		'default' => 'width1x',
	) );
	$term_option->add_field( array(
		'name'	=> esc_html__('Product Category Height', 'halena' ),
		'desc'	=> esc_html__('It will be ignored, If you\'re using carousels or If you disabled the Portfolio Thumbnails Hard Crop at Halena/Portfolio Settings & Shortcode elements.', 'halena'),
		'id'	=> $prefix.'thumbnail_height',
		'type'	=> 'radio_inline',
		'options' => array( 
			'height1x' => esc_html__('1x', 'halena' ), 
			//'height1_5x' => esc_html__('1.5x', 'halena' ), 
			'height2x' => esc_html__('2x', 'halena' ), 
			'height3x' => esc_html__('3x', 'halena' ), 
		),
		'default' => 'height1x',
	) );
	$term_option->add_field( array(
		'name' => esc_html__('Agni Slider List', 'halena' ),
		'desc' => esc_html__('Here, you can choose the slider which is created under Agni Slider Menu(left side).', 'halena' ),
		'id' => $prefix.'agni_sliders',
		'type' => 'select',
		'options' => agni_posttype_options( array( 'post_type' => 'agni_slides'), true ),
	) );
}

/**
 * Page Header Options
 */
add_action( 'cmb2_init', 'agni_page_header_meta' );
function agni_page_header_meta() {
	
	// Start with an underscore to hide fields from custom fields list
	$prefix = 'page_header_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$page_header_option = new_cmb2_box( array(
		'id'            => $prefix . 'page_header_options',
		'title'         => esc_html__( 'Page Header Options', 'halena' ),
		'object_types'  => array( 'page', 'post', 'portfolio', 'product' ), // Post type add "term" for category & tags
		//'taxonomies'       => array( 'category', 'post_tag', 'types', 'product_cat' ), // Tells CMB2 which taxonomies should have these fields
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
	) );

	$page_header_option->add_field( array(
		'name'	=> esc_html__('Background Choice', 'halena' ),
		'id'	=> $prefix.'bg_choice',
		'type'	=> 'radio_inline',
		'options' => array( 
			'bg_color' => esc_html__('BG Color', 'halena' ), 
			'bg_image' => esc_html__('BG Image', 'halena' ), 
			'bg_video' => esc_html__('BG Video', 'halena' ), 
			'bg_featured' => esc_html__('BG Featured Image', 'halena' ), 
		),
		'default'  => 'bg_image',
		'before_row' => '<h3>Background Options</h3>'
	) );
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Background Color', 'halena' ), 
		'id'	=> $prefix.'bg_color', 
		'type'	=> 'colorpicker',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'bg_choice' ,
 			'data-conditional-value' => 'bg_color',
 		)
	) );
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Background Image', 'halena' ), 
		'id'	=> $prefix.'bg_image', 
		'type'	=> 'file',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'bg_choice' ,
 			'data-conditional-value' => 'bg_image',
 		)
	) );
	$page_header_option->add_field( array(
		'name'	=> esc_html__('Background Position', 'halena' ),
		'id'	=> $prefix.'bg_image_position',
		'type'	=> 'select',
		'options' => array( 
			'left top' => esc_html__('left top', 'halena' ), 
			'left center' => esc_html__('left center', 'halena' ), 
			'left bottom' => esc_html__('left bottom', 'halena' ), 
			'right top' => esc_html__('right top', 'halena' ), 
			'right center' => esc_html__('right center', 'halena' ), 
			'right bottom' => esc_html__('right bottom', 'halena' ), 
			'center top' => esc_html__('center top', 'halena' ), 
			'center center' => esc_html__('center center', 'halena' ), 
			'center bottom' => esc_html__('center bottom', 'halena' ), 
		),
		'default' => 'center center',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'bg_choice' ,
 			'data-conditional-value' => json_encode( array( 'bg_image', 'bg_featured' ) ),
 		)
	) );
	$page_header_option->add_field( array(
		'name'	=> esc_html__('Background Repeat', 'halena' ),
		'id'	=> $prefix.'bg_image_repeat',
		'type'	=> 'select',
		'options' => array( 
			'repeat' => esc_html__('repeat', 'halena' ), 
			'no-repeat' => esc_html__('no-repeat', 'halena' ), 
		),
		'default' => 'repeat',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'bg_choice' ,
 			'data-conditional-value' => json_encode( array( 'bg_image', 'bg_featured' ) ),
 		)
	) );
	$page_header_option->add_field( array(
		'name'	=> esc_html__('Background Size', 'halena' ),
		'id'	=> $prefix.'bg_image_size',
		'type'	=> 'select',
		'options' => array( 
			'cover' => esc_html__('cover', 'halena' ), 
			'auto' => esc_html__('auto', 'halena' ), 
		),
		'default' => 'cover',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'bg_choice' ,
 			'data-conditional-value' => json_encode( array( 'bg_image', 'bg_featured' ) ),
 		)
	) );

	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Background Video Source', 'halena' ),
		'id'	=> $prefix.'bg_video_src', 
		'type'	=> 'radio_inline',
		'options' => array( 
			'' => esc_html__('No Source', 'halena' ), 
			'1' => esc_html__('YouTube/Vimeo', 'halena' ), 
			'2' => esc_html__('Selfhosted/Vimeo', 'halena' ), 
		),
		'default' => '',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'bg_choice' ,
 			'data-conditional-value' => 'bg_video',
 		)
	) );
	$page_header_option->add_field( array(  
		'name'	=> esc_html__('Video URL', 'halena' ), 
		'desc'	=> esc_html__('video url from youtube or vimeo', 'halena' ), 
		'id'	=> $prefix.'bg_video_src_yt', 
		'type'	=> 'text_url',
		'attributes' => array(
			'required' => false, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'bg_video_src' ,
			'data-conditional-value' => '1',
		)
	) );
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Fallback image for mobile & tablets', 'halena' ), 
		'id'	=> $prefix.'bg_video_src_yt_fallback', 
		'type'	=> 'file',
		'attributes' => array(
			'data-conditional-id' => $prefix . 'bg_video_src_yt' ,
		)
	) );
	$page_header_option->add_field( array(  
		'name'	=> esc_html__('Video URL', 'halena' ), 
		'desc'	=> esc_html__('Choose the media from your local server', 'halena' ), 
		'id'	=> $prefix.'bg_video_src_sh',
		'type'	=> 'file',
		'attributes' => array(
			'data-conditional-id' => $prefix . 'bg_video_src' ,
			'data-conditional-value' => '2',
		)
	) );
	
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Poster URL', 'halena' ), 
		'desc'	=> esc_html__('This poster will be displayed before video get started', 'halena' ),
		'id'	=> $prefix.'bg_video_src_sh_poster', 
		'type'	=> 'file',
		'attributes' => array(
			'required' => false, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'bg_video_src_sh' ,
		)
	) );
	$page_header_option->add_field( array( 
		'name' => esc_html__('YT Video on Mobile', 'halena' ),
		'desc' => esc_html__('Enable to make youtube video playable on mobile devices.', 'halena' ),
		'id' => $prefix.'bg_video_src_yt_mobile',
		'type' => 'checkbox',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'bg_video_src' ,
 			'data-conditional-value' => '1',
 		)
	) );
	$page_header_option->add_field( array( 
		'name' => esc_html__('Autoplay', 'halena' ),
		'desc' => esc_html__('Enable to make video autoplay.', 'halena' ),
		'id' => $prefix.'bg_video_autoplay',
		'type' => 'checkbox',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'bg_video_src' ,
 			'data-conditional-value' => json_encode(array('1', '2')),
 		)
	) );
	$page_header_option->add_field( array( 
		'name' => esc_html__('Loop', 'halena' ),
		'desc' => esc_html__('Enable to make video loop.', 'halena' ),
		'id' => $prefix.'bg_video_loop',
		'type' => 'checkbox',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'bg_video_src' ,
 			'data-conditional-value' => json_encode(array('1', '2')),
 		)
	) );
	$page_header_option->add_field( array( 
		'name' => esc_html__('Muted', 'halena' ),
		'desc' => esc_html__('Enable to make video quiet.', 'halena' ),
		'id' => $prefix.'bg_video_muted',
		'type' => 'checkbox',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'bg_video_src' ,
 			'data-conditional-value' => json_encode(array('1', '2')),
 		)
	) );

	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Volumne Level', 'halena' ), 
		'desc'	=> esc_html__('Enter your volume level. it will not applicable if video is muted.', 'halena' ), 
		'id'	=> $prefix.'bg_video_volume', 
		'type'	=> 'text_small',
		'default' => '50',
		'attributes' => array(
			'type'  => 'number',
			'min'  => '0',
			'max'  => '100',
			'step'  => '1',
			'data-conditional-id'    => $prefix . 'bg_video_src' ,
			'data-conditional-value' => '1',
		),
	) );

	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Video Quality', 'halena' ),
		'desc'	=> esc_html__('choose your video quality by default.', 'halena' ),
		'id'	=> $prefix.'bg_video_quality', 
		'type'	=> 'radio_inline',
		'options' => array( 
			'default' => esc_html__('Default', 'halena' ), 
			'hd720' => esc_html__('HD 720p', 'halena' ), 
			'hd1080' => esc_html__('FullHD 1080p', 'halena' ), 
		),
		'default' => 'default',
		'attributes' => array(
 			'data-conditional-id'    => $prefix . 'bg_video_src' ,
			'data-conditional-value' => '1',
 		)
	) );
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Video Start at/Stop at', 'halena' ), 
		'desc'	=> esc_html__('Video Start at value', 'halena' ), 
		'id'	=> $prefix.'bg_video_start_at', 
		'type'	=> 'text_small',
		'default' => '0',
		'attributes' => array(
 			'data-conditional-id'    => $prefix . 'bg_video_src' ,
			'data-conditional-value' => '1',
 		),
		'row_classes' => 'agni-slide-col agni-slide-height-desktop',
		'before_row' => '<div class="cmb-row agni-slide-row agni-slide-height-container">'
	) );
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Video Stop At', 'halena' ), 
		'desc'	=> esc_html__('Video Stop at value', 'halena' ), 
		'id'	=> $prefix.'bg_video_stop_at', 
		'type'	=> 'text_small',
		'default' => '0',
		'attributes' => array(
 			'data-conditional-id'    => $prefix . 'bg_video_src' ,
			'data-conditional-value' => '1',
 		),
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-height-mobile',
		'after_row' => '</div>'
	) );
	
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('BG Overlay Choice', 'halena' ),
		'desc'	=> esc_html__('Gradient Map(Duotone) will not work on IE & Edge.', 'halena' ), 
		'id'	=> $prefix.'bg_overlay_choice', 
		'type'	=> 'radio_inline',
		'options' => array( 
			'1' => esc_html__('Simple', 'halena' ), 
			'2' => esc_html__('Simple Gradient', 'halena' ), 
			'3' => esc_html__('Gradient Map(Duotone)', 'halena' ), 
			'4' => esc_html__('No Overlay', 'halena' ), 
		),
		'default' => '4',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'bg_choice' ,
 			'data-conditional-value' => json_encode( array( 'bg_video','bg_image', 'bg_featured' ) ),
 		)
	) );
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('BG Overlay Color', 'halena' ), 
		'desc'	=> esc_html__('This layer will be the overlay of the slider.', 'halena' ), 
		'id'	=> $prefix.'bg_overlay_color', 
		'type'	=> 'rgba_colorpicker',
		'default' => '',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'bg_overlay_choice' ,
 			'data-conditional-value' => '1',
 		)
	) );
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('BG Gradient Overlay CSS', 'halena' ), 
		'desc'	=> wp_kses( __( 'Get/Type your Gradient CSS. Ref. <a target="_blank" href="http://uigradients.com/">http://uigradients.com/</a> <a target="_blank" href="http://hex2rgba.devoth.com/">HEX to RGBA converter for transparency</a>', 'halena' ), array( 'a' => array( 'href' => array(), 'target' => array() ) ) ),
		'id'	=> $prefix.'bg_sg_overlay_css', 
		'type'	=> 'textarea_code',
		'default' => '',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'bg_overlay_choice' ,
 			'data-conditional-value' => '2',
 		)
	) );
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('BG Gradient Map(Duotone) Overlay Color 1', 'halena' ), 
		'desc'	=> wp_kses( __( 'Choose the color for Shadows(Dark pixels). <a target="_blank" href="http://demo.agnidesigns.com/halena/documentation/kb/gradient-map-duotone/">See Presets</a>', 'halena' ), array( 'a' => array( 'href' => array(), 'target' => array() ) ) ),
		'id'	=> $prefix.'bg_gm_overlay_color1', 
		'type'	=> 'colorpicker',
		'default' => '',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'bg_overlay_choice' ,
 			'data-conditional-value' => '3',
 		)
	) );
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('BG Gradient Map(Duotone) Overlay Color 2', 'halena' ), 
		'desc'	=> esc_html__('Choose the mid-tone color. You can leave this empty for no mid-tone.', 'halena' ), 
		'id'	=> $prefix.'bg_gm_overlay_color2', 
		'type'	=> 'colorpicker',
		'default' => '',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'bg_overlay_choice' ,
 			'data-conditional-value' => '3',
 		)
	) );
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('BG Gradient Map(Duotone) Overlay Color 3', 'halena' ), 
		'desc'	=> esc_html__('Choose the color for Highlights(White pixels).', 'halena' ), 
		'id'	=> $prefix.'bg_gm_overlay_color3', 
		'type'	=> 'colorpicker',
		'default' => '',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'bg_overlay_choice',
 			'data-conditional-value' => '3',
 		)
	) );

	$page_header_option->add_field( array(
		'name' => esc_html__('Particle Ground', 'halena' ),
		'desc' => esc_html__('It will enable the particles for the background.', 'halena' ),
		'id' => $prefix . 'bg_particle_ground',
		'type' => 'checkbox',
	) );
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Particle Ground Color', 'halena' ), 
		'desc'	=> esc_html__('Choose the color and transparency for the particle ground.', 'halena' ), 
		'id'	=> $prefix.'bg_particle_ground_color', 
		'type'	=> 'rgba_colorpicker',
		'default' => '',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'bg_particle_ground',
 		)
	) );

	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Image', 'halena' ), 
		'id'	=> $prefix.'image', 
		'type'	=> 'file',
		'before_row' => '<h3>Content Options</h3>'
	) );
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Max Image width', 'halena' ), 
		'desc'	=> esc_html__('Enter your image width, don\'t include "px" string', 'halena' ), 
		'id'	=> $prefix.'image_size', 
		'type'	=> 'text_small',
		'default' => '240',
		'attributes' => array(
			'type'  => 'number',
			'min'  => '100',
			'max'  => '1000',
			'step'  => '5',
 			//'required' => true,
 			'data-conditional-id'    => $prefix .'image',
 			//'data-conditional-id'    => 'agni_slides_repeatable[{#}][title]',
		),
		'row_classes' => 'agni-slide-col agni-slide-height-desktop',
		'before_row' => '<div class="cmb-row agni-slide-row agni-slide-height-container">'
	) );
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Max Image width', 'halena' ), 
		'desc'	=> esc_html__('Enter your image width for tablets', 'halena' ), 
		'id'	=> $prefix.'image_size_tab', 
		'type'	=> 'text_small',
		'default' => '160',
		'attributes' => array(
			'type'  => 'number',
			'min'  => '40',
			'max'  => '700',
			'step'  => '5',
 			//'required' => true,
 			'data-conditional-id'    => $prefix .'image',
 			//'data-conditional-id'    => 'agni_slides_repeatable[{#}][title]',
		),
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-height-tab',
	) );
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Max Image width', 'halena' ), 
		'desc'	=> esc_html__('Enter your image width for mobiles', 'halena' ), 
		'id'	=> $prefix.'image_size_mobile', 
		'type'	=> 'text_small',
		'default' => '100',
		'attributes' => array(
			'type'  => 'number',
			'min'  => '20',
			'max'  => '300',
			'step'  => '5',
 			//'required' => true,
 			'data-conditional-id'    => $prefix .'image',
 			//'data-conditional-id'    => 'agni_slides_repeatable[{#}][title]',
		),
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-height-mobile',
		'after_row' => '</div>'
	) );
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Title Choice', 'halena' ),
		'id'	=> $prefix.'title_choice', 
		'type'	=> 'radio_inline',
		'options' => array( 
			'1' => esc_html__('Custom Title', 'halena' ), 
			'2' => esc_html__('Page Title', 'halena' ), 
		),
		'default' => '1',
	) );
	$page_header_option->add_field( array(
		'name' => esc_html__('Title', 'halena' ),
		'desc' => esc_html__('To use a text effect. Add the texts with delimiter "|" inside <span> tag. For ex. Hello, <span>This is|Sample|Text</span>', 'halena' ),
		'id' => $prefix . 'title',
		'type' => 'text',
		'sanitization_cb' => false,
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'title_choice' ,
 			'data-conditional-value' => '1',
 		)
	) );
	$page_header_option->add_field( array(
		'name' => esc_html__('Title Rotator', 'halena' ),
		'desc' => esc_html__('Check this for Title rotator. it enables the text effects to the title.', 'halena' ),
		'id' => $prefix . 'title_rotator',
		'type' => 'checkbox',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix .'title',
		),
	) );
	$page_header_option->add_field( array(
		'name'	=> esc_html__('Choose Rotator Effect', 'halena' ),
		'id'	=> $prefix . 'title_rotator_choice',
		'type'	=> 'select',
		'options' => array( 
			'type letters' => esc_html__('Type', 'halena' ), 
			'zoom' => esc_html__('Zoom', 'halena' ), 
		),
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix .'title_rotator',
		),
		'default'  => 'scale letters'
	) );
	$page_header_option->add_field( array(
		'name' => esc_html__('Title Font', 'halena' ),
		'desc' => esc_html__('It will apply the font to the Title which you choose at "Halena/Theme Options/General Settings/Typography".', 'halena' ),
		'id' => $prefix . 'title_font',
		'type' => 'select',
		'options' => array( 
			'primary-typo' => esc_html__('Primary Font', 'halena' ), 
			'default-typo' => esc_html__('Default Font', 'halena' ), 
			'additional-typo' => esc_html__('Additional Font', 'halena' ), 
			'special-typo' => esc_html__('Special Font', 'halena' ), 
		),
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix .'title_choice',
 			'data-conditional-value' => json_encode( array( '1', '2' ) ),
		),
		'default' => 'primary-typo',
	) );

	$page_header_option->add_field( array(
		'name'	=> esc_html__('Title Font Size', 'halena' ), 
		'desc'	=> esc_html__('Enter your title font size, don\'t include "px" string', 'halena' ), 
		'id'	=> $prefix . 'title_size', 
		'type'	=> 'text_small',
		'default' => '',
		'attributes' => array(
			'type'  => 'number',
			'min'  => '30',
			'max'  => '200',
			'step'  => '1',
 			//'required' => true,
 			'data-conditional-id'    => $prefix .'title_choice',
 			'data-conditional-value' => json_encode( array( '1', '2' ) ),
		),
	) );
	$page_header_option->add_field( array(
		'name'	=> esc_html__('Title Color', 'halena' ), 
		'desc'	=> esc_html__('Choose the color for title', 'halena' ), 
		'id'	=> $prefix . 'title_color', 
		'type'	=> 'colorpicker',
		'default' => '#f0f0f0',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix .'title_choice',
 			'data-conditional-value' => json_encode( array( '1', '2' ) ),
 		)
	) );
	$page_header_option->add_field( array(
		'name'	=> esc_html__('Title Margin Bottom', 'halena' ), 
		'desc'	=> esc_html__('Enter the bottom margin for the title.', 'halena' ), 
		'id'	=> $prefix . 'title_margin_bottom', 
		'type'	=> 'text_small',
		'default' => '35',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix .'title_choice',
 			'data-conditional-value' => json_encode( array( '1', '2' ) ),
 		)
	) );
	$page_header_option->add_field( array(
		'name' => esc_html__('Description', 'halena' ),
		'id' => $prefix . 'desc',
		'type' => 'textarea_small',
		'sanitization_cb' => false,
		'attributes'  => array(
	        'placeholder' => 'A small amount of text',
	        'rows'        => 2,
	    ),
	) );
	$page_header_option->add_field( array(
		'name' => esc_html__('Description Font', 'halena' ),
		'desc' => esc_html__('It will apply the font to the Description which you choose at "Halena/Theme Options/General Settings/Typography".', 'halena' ),
		'id' => $prefix . 'desc_font',
		'type' => 'select',
		'options' => array( 
			'primary-typo' => esc_html__('Primary Font', 'halena' ), 
			'default-typo' => esc_html__('Default Font', 'halena' ), 
			'additional-typo' => esc_html__('Additional Font', 'halena' ), 
			'special-typo' => esc_html__('Special Font', 'halena' ), 
		),
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix .'desc',
		),
		'default' => 'default-typo',
	) );
	$page_header_option->add_field( array(
		'name'	=> esc_html__('Description Font Size', 'halena' ), 
		'desc'	=> esc_html__('Enter your title font size, don\'t include "px" string', 'halena' ), 
		'id'	=> $prefix . 'desc_size', 
		'type'	=> 'text_small',
		'default' => '',
		'attributes' => array(
			'type'  => 'number',
			'min'  => '15',
			'max'  => '60',
			'step'  => '1',
			//'required' => true,
 			'data-conditional-id'    => $prefix .'desc',
 			//'data-conditional-id'    => 'agni_slides_repeatable[{#}][title]',
		),
	) );
	$page_header_option->add_field( array(
		'name'	=> esc_html__('Description Color ', 'halena' ), 
		'desc'	=> esc_html__('choose the description color', 'halena' ), 
		'id'	=> $prefix . 'desc_color', 
		'type'	=> 'colorpicker',
		'default' => '#f0f0f0',
		'attributes' => array(
 			'data-conditional-id'    => $prefix .'desc',
 		)
	) );
	$page_header_option->add_field( array(
		'name'	=> esc_html__('Description Margin Bottom', 'halena' ), 
		'desc'	=> esc_html__('Enter the bottom margin for the description.', 'halena' ), 
		'id'	=> $prefix . 'desc_margin_bottom', 
		'type'	=> 'text_small',
		'default' => '30',
		'attributes' => array(
 			'data-conditional-id'    => $prefix .'desc',
 		)
	) );

	$page_header_option->add_field( array(
		'name' => esc_html__('Divide Line', 'halena' ),
		'desc' => esc_html__('Checking this for FadeInUp animation.', 'halena' ),
		'id' => $prefix . 'line',
		'type' => 'checkbox',
	) );
	$page_header_option->add_field( array(
		'name'	=> esc_html__('Divide Line Color ', 'halena' ), 
		'desc'	=> esc_html__('choose the description color', 'halena' ), 
		'id'	=> $prefix . 'line_color', 
		'type'	=> 'colorpicker',
		'default' => '#f0f0f0',
		'attributes' => array(
 			'data-conditional-id'    => $prefix .'line',
 		)
	) );
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Button 1', 'halena' ), 
		'desc'	=> esc_html__('button 1 info', 'halena' ), 
		'id'	=> $prefix . 'button1', 
		'type'	=> 'text_small'
	) );
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Button 1 Icon', 'halena' ),
		'id'	=> $prefix . 'button1_icon',
		'type'	=> 'select',
		'options' => array( 
			'' => esc_html__('No icon', 'halena' ), 
			'icon-arrows-slim-right' => esc_html__('Arrow Right', 'halena' ), 
		),
		'default' => '',
		'attributes' => array(
			'data-conditional-id' => $prefix .'button1',
		)
	) );
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Button 1 Icon Style', 'halena' ),
		'id'	=> $prefix . 'button1_icon_style',
		'type'	=> 'select',
		'options' => array( 
			'' => esc_html__('Default', 'halena' ), 
			'has-big-btn' => esc_html__('Big Rounded', 'halena' ), 
		),
		'default' => '',
		'attributes' => array(
			'data-conditional-id' => $prefix .'button1_icon',
		)
	) );
	$page_header_option->add_field( array(
		'name' => esc_html__('Hide Button 1 Text', 'halena' ),
		'desc' => esc_html__('It will hide the button text.', 'halena' ),
		'id' => $prefix . 'button1_text_hide',
		'type' => 'checkbox',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => $prefix .'button1_icon',
 			//'data-conditional-value' => 'on',
 		),
	) );
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Button 1 URL', 'halena' ), 
		'desc'	=> esc_html__('button href', 'halena' ), 
		'id'	=> $prefix . 'button1_url', 
		'type'	=> 'text_url',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => $prefix .'button1',
 			//'data-conditional-value' => 'on',
 		)
	) );
	
	$page_header_option->add_field( array(
		'name'	=> esc_html__('Button 1 Style', 'halena' ),
		'id'	=> $prefix . 'button1_style',
		'type'	=> 'select',
		'options' => array( 
			'default' => esc_html__('Default', 'halena' ), 
			'primary' => esc_html__('Primary', 'halena' ), 
			'accent' => esc_html__('Accent', 'halena' ), 
			'white' => esc_html__('White', 'halena' ), 
		),
		'default' => 'white',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => $prefix .'button1',
 			//'data-conditional-value' => 'on',
 		),
	) );
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Button 1 Type', 'halena' ),
		'id'	=> $prefix . 'button1_type',
		'type'	=> 'radio_inline',
		'options' => array( 
			'btn-normal' => esc_html__('background', 'halena' ), 
			'btn-alt' => esc_html__('Bordered', 'halena' ), 
			'btn-plain' => esc_html__('Plain', 'halena' ), 
		),
		'default' => 'btn-normal',
		'attributes' => array(
			'data-conditional-id' => $prefix .'button1',
		)
	) );
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Button 1 Radius', 'halena' ), 
		'desc'	=> esc_html__('You can use px, em, %, etc. or enter just number and it will use pixels.', 'halena' ), 
		'id'	=> $prefix . 'button1_radius', 
		'type'	=> 'text_small',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => $prefix .'button1',
 			//'data-conditional-value' => 'on',
 		),
	) );
	$page_header_option->add_field( array(
		'name'	=> esc_html__('Button 1 Target', 'halena' ),
		'id'	=> $prefix . 'button1_target',
		'type'	=> 'select',
		'options' => array( 
			'_self' => esc_html__('Same Window', 'halena' ), 
			'_blank' => esc_html__('New Window', 'halena' ), 
		),
		'default' => '_self',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => $prefix .'button1',
 			//'data-conditional-value' => 'on',
 		),
	) );
	$page_header_option->add_field( array(
		'name' => esc_html__('Button 1 has Lightbox Video?', 'halena' ),
		'desc' => esc_html__('Checking this for enabling modal/lightbox.', 'halena' ),
		'id' => $prefix . 'button1_lightbox',
		'type' => 'checkbox',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => $prefix .'button1',
 			//'data-conditional-value' => 'on',
 		),
	) );	
	$page_header_option->add_field( array(
		'name'	=> esc_html__('Button 1 Embed code', 'halena' ), 
		'desc'	=> esc_html__('enter the youtube, vimeo or any video embed link. This code will ignore the actual button link', 'halena' ), 
		'id'	=> $prefix.'button1_embed_url', 
		'type'	=> 'textarea_small',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => $prefix .'button1_lightbox',
 			//'data-conditional-value' => 'on',
 		),
		'sanitization_cb' => false
	) );
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Button 2', 'halena' ), 
		'desc'	=> esc_html__('button 2 info', 'halena' ), 
		'id'	=> $prefix . 'button2', 
		'type'	=> 'text_small'
	) );
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Button 2 Icon', 'halena' ),
		'id'	=> $prefix . 'button2_icon',
		'type'	=> 'select',
		'options' => array( 
			'' => esc_html__('No icon', 'halena' ), 
			'icon-arrows-slim-right' => esc_html__('Arrow Right', 'halena' ), 
		),
		'default' => '',
		'attributes' => array(
			'data-conditional-id' => $prefix .'button2',
		)
	) );
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Button 2 Icon Style', 'halena' ),
		'id'	=> $prefix . 'button2_icon_style',
		'type'	=> 'select',
		'options' => array( 
			'' => esc_html__('Default', 'halena' ), 
			'has-big-btn' => esc_html__('Big Rounded', 'halena' ), 
		),
		'default' => '',
		'attributes' => array(
			'data-conditional-id' => $prefix .'button2_icon',
		)
	) );
	$page_header_option->add_field( array(
		'name' => esc_html__('Hide Button 2 Text', 'halena' ),
		'desc' => esc_html__('It will hide the button text.', 'halena' ),
		'id' => $prefix . 'button2_text_hide',
		'type' => 'checkbox',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => $prefix .'button2_icon',
 			//'data-conditional-value' => 'on',
 		),
	) );
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Button 2 URL', 'halena' ), 
		'desc'	=> esc_html__('button href', 'halena' ), 
		'id'	=> $prefix . 'button2_url', 
		'type'	=> 'text_url',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => $prefix .'button2',
 			//'data-conditional-value' => 'on',
 		)
	) );
	
	$page_header_option->add_field( array(
		'name'	=> esc_html__('Button 2 Style', 'halena' ),
		'id'	=> $prefix . 'button2_style',
		'type'	=> 'select',
		'options' => array( 
			'default' => esc_html__('Default', 'halena' ), 
			'primary' => esc_html__('Primary', 'halena' ), 
			'accent' => esc_html__('Accent', 'halena' ), 
			'white' => esc_html__('White', 'halena' ), 
		),
		'default' => 'white',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => $prefix .'button2',
 			//'data-conditional-value' => 'on',
 		),
	) );
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Button 2 Type', 'halena' ),
		'id'	=> $prefix . 'button2_type',
		'type'	=> 'radio_inline',
		'options' => array( 
			'btn-normal' => esc_html__('background', 'halena' ), 
			'btn-alt' => esc_html__('Bordered', 'halena' ), 
			'btn-plain' => esc_html__('Plain', 'halena' ), 
		),
		'default' => 'btn-normal',
		'attributes' => array(
			'data-conditional-id' => $prefix .'button2',
		)
	) );
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Button 2 Radius', 'halena' ), 
		'desc'	=> esc_html__('You can use px, em, %, etc. or enter just number and it will use pixels.', 'halena' ), 
		'id'	=> $prefix . 'button2_radius', 
		'type'	=> 'text_small',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => $prefix .'button2',
 			//'data-conditional-value' => 'on',
 		),
	) );
	$page_header_option->add_field( array(
		'name'	=> esc_html__('Button 2 Target', 'halena' ),
		'id'	=> $prefix . 'button2_target',
		'type'	=> 'select',
		'options' => array( 
			'_self' => esc_html__('Same Window', 'halena' ), 
			'_blank' => esc_html__('New Window', 'halena' ), 
		),
		'default' => '_self',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => $prefix .'button2',
 			//'data-conditional-value' => 'on',
 		),
	) );	
	$page_header_option->add_field( array(
		'name' => esc_html__('Button 2 has Lightbox Video?', 'halena' ),
		'desc' => esc_html__('Checking this for FadeInDown animation.', 'halena' ),
		'id' => $prefix . 'button2_lightbox',
		'type' => 'checkbox',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => $prefix .'button2',
 			//'data-conditional-value' => 'on',
 		),
	) );
	$page_header_option->add_field( array(
		'name'	=> esc_html__('Button 2 Embed code', 'halena' ), 
		'desc'	=> esc_html__('enter the youtube, vimeo or any video embed link. This code will ignore the actual button link', 'halena' ), 
		'id'	=> $prefix.'button2_embed_url', 
		'type'	=> 'textarea_small',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => $prefix .'button2_lightbox',
 			//'data-conditional-value' => 'on',
 		),
		'sanitization_cb' => false
	) );

	$page_header_option->add_field( array(
		'name' => esc_html__('Breadcrumb(Navigation)', 'halena' ),
		'desc' => esc_html__('check this to show the navigation link at header', 'halena' ),
		'id'	=> $prefix.'breadcrumb',
		'type'	=> 'checkbox',
	) );
	$page_header_option->add_field( array(
		'name'	=> esc_html__('Breadcrumb Color ', 'halena' ), 
		'desc'	=> esc_html__('choose the description color', 'halena' ), 
		'id'	=> $prefix . 'breadcrumb_color', 
		'type'	=> 'colorpicker',
		'default' => '#f0f0f0',
		'attributes' => array(
 			'data-conditional-id'    => $prefix .'breadcrumb',
 		)
	) );

	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Bottom Arrow Icon', 'halena' ),
		'id'	=> $prefix . 'arrowicon',
		'type'	=> 'select',
		'options' => array( 
			'' => esc_html__('No icon', 'halena' ), 
			'pe-7s-angle-down' => esc_html__('Angle Down', 'halena' ), 
			'pe-7s-angle-down-circle' => esc_html__('Angle Down Circled', 'halena' ), 
			'ion-ios-arrow-thin-down' => esc_html__('Arrow Down', 'halena' ), 
			'pe-7s-bottom-arrow' => esc_html__('Arrow Down Circled', 'halena' ), 
			'pe-7s-mouse' => esc_html__('Mouse', 'halena' ), 
		),
		'default' => '',
	) );
	$page_header_option->add_field( array(
		'name'	=> esc_html__('Bottom Arrow link', 'halena' ), 
		'id'	=> $prefix . 'arrowlink', 
		'type'	=> 'text_url',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => $prefix .'arrowicon',
 			//'data-conditional-value' => 'on',
 		),
	) );
	
	$page_header_option->add_field( array(
		'name'	=> esc_html__('Bottom Arrow Color', 'halena' ), 
		'desc'	=> esc_html__('Choose the color for the bottom arrow', 'halena' ), 
		'id'	=> $prefix . 'arrowicon_color', 
		'type'	=> 'colorpicker',
		'attributes' => array(
			//'required' => true, // Will be required only if visible.
			'data-conditional-id' => $prefix .'arrowicon',
		)		
	) );
	$page_header_option->add_field( array(
		'name' => esc_html__('Animation', 'halena' ),
		'desc' => esc_html__('Checking this for FadeInDown animation.', 'halena' ),
		'id' => $prefix . 'animation',
		'type'	=> 'select',
		'options' => array( 
			'' => esc_html__('No Animation', 'halena' ), 
			'fade-in' => esc_html__('fadeIn', 'halena' ), 
			'fade-in-down' => esc_html__('fadeInDown', 'halena' ),
			'fade-in-up' => esc_html__('fadeInUp', 'halena' ),
			'zoom-in' => esc_html__('zoomIn', 'halena' ),
		),
		'default' => '',
	) );
	
	$page_header_option->add_field( array(
		'name'	=> esc_html__('Content stretch', 'halena' ), 
		'id'	=> $prefix.'content_choice', 
		'type'	=> 'radio_inline',
		'options' => array( 
			'container' => esc_html__( 'Container', 'halena' ), 
			'container-fluid' => esc_html__( 'Fullwidth', 'halena' ), 
		),
		'default'  => 'container'
	) );

	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Content Width', 'halena' ), 
		'id'	=> $prefix.'content_width', 
		'type'	=> 'text_small',
		'default' => '',
		'row_classes' => 'agni-slide-col agni-slide-height-desktop',
		'before_row' => '<div class="cmb-row agni-slide-row agni-slide-height-container">'
	) );
	$page_header_option->add_field( array( 
		//'name'	=> esc_html__('Content Width', 'halena' ), 
		'id'	=> $prefix.'content_width_tab', 
		'desc'	=> esc_html__('content width for tab', 'halena' ), 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-height-tab',
	) );
	$page_header_option->add_field( array( 
		//'name'	=> esc_html__('Content Width', 'halena' ), 
		'id'	=> $prefix.'content_width_mobile', 
		'desc'	=> esc_html__('content width for mobile', 'halena' ), 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-height-mobile',
		'after_row' => '</div>'
	) );
	
	$page_header_option->add_field( array(
		'name'	=> esc_html__('Content Position', 'halena' ),
		'id'	=> $prefix.'content_position',
		'type'	=> 'select',
		'options' => array( 
			'j-flex-start a-flex-start' => esc_html__('left top', 'halena' ), 
			'j-flex-start a-center' => esc_html__('left center', 'halena' ), 
			'j-flex-start a-flex-end' => esc_html__('left bottom', 'halena' ), 
			'j-flex-end a-flex-start' => esc_html__('right top', 'halena' ), 
			'j-flex-end a-center' => esc_html__('right center', 'halena' ), 
			'j-flex-end a-flex-end' => esc_html__('right bottom', 'halena' ), 
			'j-center a-flex-start' => esc_html__('center top', 'halena' ), 
			'j-center a-center' => esc_html__('center center', 'halena' ), 
			'j-center a-flex-end' => esc_html__('center bottom', 'halena' ),
		),
		'default'  => 'j-flex-start a-center'
	) );

	$page_header_option->add_field( array(
		'name'	=> esc_html__('Content Alignment', 'halena' ),
		'id'	=> $prefix.'text_alignment',
		'type'	=> 'radio_inline',
		'options' => array( 
			'left' => esc_html__( 'Left', 'halena' ), 
			'center' => esc_html__( 'Center', 'halena' ), 
			'right' => esc_html__( 'Right', 'halena' ), 
		),
		'default'  => 'left'
	) );

	$page_header_option->add_field( array(
		'name'	=> esc_html__('Padding Values', 'halena' ), 
		'desc'	=> esc_html__('Padding Top. You can use px, em, %, etc. or enter just number and it will use pixels.', 'halena' ), 
		'id'	=> $prefix.'padding_top', 
		'type'	=> 'text_small',
		'default' => '',
		'row_classes' => 'agni-slide-col agni-slide-padding-top',
		'before_row' => '<div class="cmb-row agni-slide-row agni-slide-padding-container">'
	) );

	$page_header_option->add_field( array(
		//'name'	=> esc_html__('Padding Right', 'halena' ), 
		'desc'	=> esc_html__('Padding Right', 'halena' ), 
		'id'	=> $prefix.'padding_right', 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-right'
		
	) );
	$page_header_option->add_field( array(
		//'name'	=> esc_html__('Padding Bottom', 'halena' ), 
		'desc'	=> esc_html__('Padding Bottom', 'halena' ), 
		'id'	=> $prefix.'padding_bottom', 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-bottom',
	) );
	$page_header_option->add_field( array(
		//'name'	=> esc_html__('Padding Left', 'halena' ), 
		'desc'	=> esc_html__('Padding Left', 'halena' ), 
		'id'	=> $prefix.'padding_left', 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-left',
		'after_row' => '</div>'
	) );
	$page_header_option->add_field( array(
		'name'	=> esc_html__('Padding Values for Tablets', 'halena' ), 
		'desc'	=> esc_html__('Padding Top', 'halena' ), 
		'id'	=> $prefix.'padding_top_tab', 
		'type'	=> 'text_small',
		'default' => '',
		'row_classes' => 'agni-slide-col agni-slide-padding-top',
		'before_row' => '<div class="cmb-row agni-slide-row agni-slide-padding-container">'
	) );

	$page_header_option->add_field( array(
		//'name'	=> esc_html__('Padding Right', 'halena' ), 
		'desc'	=> esc_html__('Padding Right', 'halena' ), 
		'id'	=> $prefix.'padding_right_tab', 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-right'
		
	) );
	$page_header_option->add_field( array(
		//'name'	=> esc_html__('Padding Bottom', 'halena' ), 
		'desc'	=> esc_html__('Padding Bottom', 'halena' ), 
		'id'	=> $prefix.'padding_bottom_tab', 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-bottom',
	) );
	$page_header_option->add_field( array(
		//'name'	=> esc_html__('Padding Left', 'halena' ), 
		'desc'	=> esc_html__('Padding Left', 'halena' ), 
		'id'	=> $prefix.'padding_left_tab', 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-left',
		'after_row' => '</div>'
	) );

	$page_header_option->add_field( array(
		'name'	=> esc_html__('Padding Values for mobile', 'halena' ), 
		'desc'	=> esc_html__('Padding Top', 'halena' ), 
		'id'	=> $prefix.'padding_top_mobile', 
		'type'	=> 'text_small',
		'default' => '',
		'row_classes' => 'agni-slide-col agni-slide-padding-top',
		'before_row' => '<div class="cmb-row agni-slide-row agni-slide-padding-container">'
	) );

	$page_header_option->add_field( array(
		//'name'	=> esc_html__('Padding Right', 'halena' ), 
		'desc'	=> esc_html__('Padding Right', 'halena' ), 
		'id'	=> $prefix.'padding_right_mobile', 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-right'
		
	) );
	$page_header_option->add_field( array(
		//'name'	=> esc_html__('Padding Bottom', 'halena' ), 
		'desc'	=> esc_html__('Padding Bottom', 'halena' ), 
		'id'	=> $prefix.'padding_bottom_mobile', 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-bottom',
	) );
	$page_header_option->add_field( array(
		//'name'	=> esc_html__('Padding Left', 'halena' ), 
		'desc'	=> esc_html__('Padding Left', 'halena' ), 
		'id'	=> $prefix.'padding_left_mobile', 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-left',
		'after_row' => '</div>'
	) );

	$page_header_option->add_field( array(
		'name'	=> esc_html__('Page Header Choice', 'halena' ),
		'id'	=> $prefix.'choice',
		'type'	=> 'radio_inline',
		'options' => array( 
			'1' => esc_html__('Full Height(100%)', 'halena' ), 
			'2' => esc_html__('Custom Height', 'halena' ), 
		),
		'default' => '1',
		'before_row' => '<h3>Basic Options</h3>'
	) );
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Page Header Height', 'halena' ), 
		'desc'	=> esc_html__('Enter your slider height, don\'t include "px" string', 'halena' ), 
		'id'	=> $prefix.'height', 
		'type'	=> 'text_small',
		'default' => '600',
		'attributes' => array(
			'required' => false, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'choice',
			'data-conditional-value' => '2',
		),
		'row_classes' => 'agni-slide-col agni-slide-height-desktop',
		'before_row' => '<div class="cmb-row agni-slide-row agni-slide-height-container">'
	) );
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Page Header Height(Tablet devices)', 'halena' ), 
		'desc'	=> esc_html__('Height on Tablets', 'halena' ), 
		'id'	=> $prefix.'height_tab', 
		'type'	=> 'text_small',
		'default' => '480',
		'attributes' => array(
			'required' => false, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'choice',
			'data-conditional-value' => '2',
		),
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-height-tab',
	) );
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Page Header Height(Mobile devices)', 'halena' ), 
		'desc'	=> esc_html__('Height on Mobiles', 'halena' ), 
		'id'	=> $prefix.'height_mobile', 
		'type'	=> 'text_small',
		'default' => '360',
		'attributes' => array(
			'required' => false, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'choice',
			'data-conditional-value' => '2',
		),
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-height-mobile',
		'after_row' => '</div>'
	) );

	$page_header_option->add_field( array(
		'name'	=> esc_html__('Margin Values', 'halena' ), 
		'desc'	=> esc_html__('margin top value for the slider. You can use px, em, %, etc. or enter just number and it will use pixels.', 'halena' ), 
		'id'	=> $prefix.'margin_top', 
		'type'	=> 'text_small',
		'default' => '',
		'row_classes' => 'agni-slide-col agni-slide-padding-top',
		'before_row' => '<div class="cmb-row agni-slide-row agni-slide-padding-container">'
	) );
	$page_header_option->add_field( array(
		//'name'	=> esc_html__('Margin Values', 'halena' ), 
		'desc'	=> esc_html__('margin right value', 'halena' ), 
		'id'	=> $prefix.'margin_right', 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-right'
	) );
	$page_header_option->add_field( array(
		//'name'	=> esc_html__('Margin Values', 'halena' ), 
		'desc'	=> esc_html__('margin bottom value', 'halena' ), 
		'id'	=> $prefix.'margin_bottom', 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-bottom'
	) );
	$page_header_option->add_field( array(
		//'name'	=> esc_html__('Margin Values', 'halena' ), 
		'desc'	=> esc_html__('margin left value', 'halena' ), 
		'id'	=> $prefix.'margin_left', 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-left',
		'after_row' => '</div>'
	) );
	$page_header_option->add_field( array(
		'name'	=> esc_html__('Margin Values for Tablets', 'halena' ), 
		'desc'	=> esc_html__('margin top value', 'halena' ), 
		'id'	=> $prefix.'margin_top_tab', 
		'type'	=> 'text_small',
		'default' => '',
		'row_classes' => 'agni-slide-col agni-slide-padding-top',
		'before_row' => '<div class="cmb-row agni-slide-row agni-slide-padding-container">'
	) );
	$page_header_option->add_field( array(
		//'name'	=> esc_html__('Margin Values', 'halena' ), 
		'desc'	=> esc_html__('margin right value', 'halena' ), 
		'id'	=> $prefix.'margin_right_tab', 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-right'
	) );
	$page_header_option->add_field( array(
		//'name'	=> esc_html__('Margin Values', 'halena' ), 
		'desc'	=> esc_html__('margin bottom value', 'halena' ), 
		'id'	=> $prefix.'margin_bottom_tab', 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-bottom'
	) );
	$page_header_option->add_field( array(
		//'name'	=> esc_html__('Margin Values', 'halena' ), 
		'desc'	=> esc_html__('margin left value', 'halena' ), 
		'id'	=> $prefix.'margin_left_tab', 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-left',
		'after_row' => '</div>'
	) );
	$page_header_option->add_field( array(
		'name'	=> esc_html__('Margin Values for Mobile', 'halena' ), 
		'desc'	=> esc_html__('margin top value', 'halena' ), 
		'id'	=> $prefix.'margin_top_mobile', 
		'type'	=> 'text_small',
		'default' => '',
		'row_classes' => 'agni-slide-col agni-slide-padding-top',
		'before_row' => '<div class="cmb-row agni-slide-row agni-slide-padding-container">'
	) );
	$page_header_option->add_field( array(
		//'name'	=> esc_html__('Margin Values', 'halena' ), 
		'desc'	=> esc_html__('margin right value', 'halena' ), 
		'id'	=> $prefix.'margin_right_mobile', 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-right'
	) );
	$page_header_option->add_field( array(
		//'name'	=> esc_html__('Margin Values', 'halena' ), 
		'desc'	=> esc_html__('margin bottom value', 'halena' ), 
		'id'	=> $prefix.'margin_bottom_mobile', 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-bottom'
	) );
	$page_header_option->add_field( array(
		//'name'	=> esc_html__('Margin Values', 'halena' ), 
		'desc'	=> esc_html__('margin left value', 'halena' ), 
		'id'	=> $prefix.'margin_left_mobile', 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-left',
		'after_row' => '</div>'
	) );

	$page_header_option->add_field( array(
		'name' => esc_html__('Parallax', 'halena' ),
		'desc' => esc_html__('Check this to enable parallax, its purely based on skrollr.', 'halena' ),
		'id' => $prefix.'parallax',
		'type' => 'checkbox',
	) );
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Parallax Value', 'halena' ), 
		'desc'	=> esc_html__('Enter the css property for the slider\'s top at the top of the screen. for eg.transform:translateY(0px); if don\'t want parallax just leave this empty', 'halena' ), 
		'id'	=> $prefix.'parallax_start', 
		'type'	=> 'textarea_small',
		'default'  => 'transform:translateY(0px);',
		'attributes' => array(
	        'rows'        => 2,
	        'placeholder' => 'Parallax Starting Value',
			'required' => false, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'parallax',
		),
		'row_classes' => 'agni-slide-col agni-slide-parallax-start',
		'before_row' => '<div class="cmb-row agni-slide-row agni-slide-parallax-container">'
	) );
	
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Parallax End Value', 'halena' ), 
		'desc'	=> esc_html__('Enter the css property for the slider\'s bottom when at the top of the screen. for eg.transform:translateY(600px); if don\'t want parallax just leave this empty', 'halena' ), 
		'id'	=> $prefix.'parallax_end', 
		'type'	=> 'textarea_small',
		'default'  => 'transform:translateY(600px);',
		'attributes' => array(
			'rows'        => 2,
			'placeholder' => 'Parallax End Value',
			'required' => false, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'parallax',
		),
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-parallax-end',
		'after_row' => '</div>'
	) );

}

add_action( 'cmb2_init', 'agni_slider_meta' );
function agni_slider_meta() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = 'agni_slides_';
	
	$agni_slider_option = new_cmb2_box( array(
		'id'            => $prefix . 'agni_slider_option',
		'title'         => esc_html__( 'Agni Slider Options', 'halena' ),
		'object_types'  => array( 'agni_slides' ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
	) );
	$agni_slider_option->add_field( array( 
		'name'	=> esc_html__('Slider Choice', 'halena' ), 
		'desc'	=> esc_html__('choose your slider, And fill the details below. ', 'halena' ), 
		'id'	=> $prefix.'choice', 
		'type'	=> 'radio_inline',
		'options' => array( 
			'slideshow' => esc_html__('Default(Slider/Carousel)', 'halena' ), 	
			'textslider' => esc_html__('Static Background Image/Video', 'halena' ),
			'imageslider' => esc_html__('Static Text', 'halena' ),
			//'posttypeslider' => esc_html__('Posttype Slider', 'halena' ),
		)
	) );	
	
	$slideshow_slider_options = new_cmb2_box( array(
		'id'            => $prefix . 'slideshow_options',
		'title'         => esc_html__( 'Slider/Carousel Options', 'halena' ),
		'object_types'  => array( 'agni_slides' ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
	) );

	// $group_field_id is the field id string, so in this case: $prefix . 'demo'
	$slideshow_repeatable = $slideshow_slider_options->add_field( array(
		'id'          => $prefix . 'slideshow_repeatable',
		'type'        => 'group',
		'options'     => array(
			'group_title'   => esc_html__( 'Slide {#}', 'halena' ), // {#} gets replaced by row number
			'add_button'    => esc_html__( 'Add another Slide', 'halena' ),
			'remove_button' => esc_html__( 'Remove Slide', 'halena' ),
			'sortable'      => true, // beta
		),
	) );

	/**
	 * Group fields works the same, except ids only need
	 * to be unique to the group. Prefix is not needed.
	 *
	 * The parent field's id needs to be passed as the first argument.
	 */

	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		'name'	=> esc_html__('Background Choice', 'halena' ),
		'id'	=> 'slideshow_bg_choice',
		'type'	=> 'radio_inline',
		'options' => array( 
			'bg_color' => esc_html__('BG Color', 'halena' ), 
			'bg_image' => esc_html__('BG Image', 'halena' ), 
		),
		'default'  => 'bg_image',
		'before_row' => '<h3>Background Options</h3>'
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array( 
		'name'	=> esc_html__('Background Color', 'halena' ), 
		'id'	=> 'slideshow_bg_color', 
		'type'	=> 'colorpicker',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $slideshow_repeatable, 'slideshow_bg_choice' ) ),
 			'data-conditional-value' => 'bg_color',
 		)
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array( 
		'name'	=> esc_html__('Background Image', 'halena' ), 
		'id'	=> 'slideshow_bg_image', 
		'type'	=> 'file',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $slideshow_repeatable, 'slideshow_bg_choice' ) ),
 			'data-conditional-value' => 'bg_image',
 		)
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		'name'	=> esc_html__('Background Position', 'halena' ),
		'id'	=> 'slideshow_bg_image_position',
		'type'	=> 'select',
		'options' => array( 
			'left top' => esc_html__('left top', 'halena' ), 
			'left center' => esc_html__('left center', 'halena' ), 
			'left bottom' => esc_html__('left bottom', 'halena' ), 
			'right top' => esc_html__('right top', 'halena' ), 
			'right center' => esc_html__('right center', 'halena' ), 
			'right bottom' => esc_html__('right bottom', 'halena' ), 
			'center top' => esc_html__('center top', 'halena' ), 
			'center center' => esc_html__('center center', 'halena' ), 
			'center bottom' => esc_html__('center bottom', 'halena' ), 
		),
		'default' => 'center center',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => json_encode( array( $slideshow_repeatable, 'slideshow_bg_image' ) ),
 		),
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		'name'	=> esc_html__('Background Repeat', 'halena' ),
		'id'	=> 'slideshow_bg_image_repeat',
		'type'	=> 'select',
		'options' => array( 
			'repeat' => esc_html__('repeat', 'halena' ), 
			'no-repeat' => esc_html__('no-repeat', 'halena' ), 
		),
		'default' => 'repeat',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => json_encode( array( $slideshow_repeatable, 'slideshow_bg_image' ) ),
 		),
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		'name'	=> esc_html__('Background Size', 'halena' ),
		'id'	=> 'slideshow_bg_image_size',
		'type'	=> 'select',
		'options' => array( 
			'cover' => esc_html__('cover', 'halena' ), 
			'auto' => esc_html__('auto', 'halena' ), 
		),
		'default' => 'cover',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => json_encode( array( $slideshow_repeatable, 'slideshow_bg_image' ) ),
 		),
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array( 
		'name'	=> esc_html__('BG Overlay Choice', 'halena' ),
		'id'	=> 'slideshow_bg_overlay_choice', 
		'type'	=> 'radio_inline',
		'options' => array( 
			'1' => esc_html__('Simple', 'halena' ), 
			'2' => esc_html__('Simple Gradient', 'halena' ), 
			'3' => esc_html__('Gradient Map(Duotone)', 'halena' ), 
			'4' => esc_html__('No Overlay', 'halena' ), 
		),
		'default' => '4',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $slideshow_repeatable, 'slideshow_bg_choice' ) ),
 			'data-conditional-value' => json_encode( array( 'bg_video','bg_image' ) ),
 		)
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array( 
		'name'	=> esc_html__('BG Overlay Color', 'halena' ), 
		'desc'	=> esc_html__('This layer will be the overlay of the slider.', 'halena' ), 
		'id'	=> 'slideshow_bg_overlay_color', 
		'type'	=> 'rgba_colorpicker',
		'default' => '',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $slideshow_repeatable, 'slideshow_bg_overlay_choice' ) ),
 			'data-conditional-value' => '1',
 		)
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array( 
		'name'	=> esc_html__('BG Gradient Overlay CSS', 'halena' ), 
		'desc'	=> wp_kses( __( 'Get/Type your Gradient CSS. Ref. <a target="_blank" href="http://uigradients.com/">http://uigradients.com/</a> <a target="_blank" href="http://hex2rgba.devoth.com/">HEX to RGBA converter for transparency</a>', 'halena' ), array( 'a' => array( 'href' => array(), 'target' => array() ) ) ),
		'id'	=> 'slideshow_bg_sg_overlay_css', 
		'type'	=> 'textarea_code',
		'default' => '',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $slideshow_repeatable, 'slideshow_bg_overlay_choice' ) ),
 			'data-conditional-value' => '2',
 		)
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array( 
		'name'	=> esc_html__('BG Gradient Map(Duotone) Overlay Color 1', 'halena' ), 
		'desc'	=> wp_kses( __( 'Choose the color for Shadows(Dark pixels). <a target="_blank" href="http://demo.agnidesigns.com/halena/documentation/kb/gradient-map-duotone/">See Presets</a>', 'halena' ), array( 'a' => array( 'href' => array(), 'target' => array() ) ) ),
		'id'	=> 'slideshow_bg_gm_overlay_color1', 
		'type'	=> 'colorpicker',
		'default' => '',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $slideshow_repeatable, 'slideshow_bg_overlay_choice' ) ),
 			'data-conditional-value' => '3',
 		)
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array( 
		'name'	=> esc_html__('BG Gradient Map(Duotone) Overlay Color 2', 'halena' ), 
		'desc'	=> esc_html__('Choose the mid-tone color. You can leave this empty for no mid-tone.', 'halena' ), 
		'id'	=> 'slideshow_bg_gm_overlay_color2', 
		'type'	=> 'colorpicker',
		'default' => '',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $slideshow_repeatable, 'slideshow_bg_overlay_choice' ) ),
 			'data-conditional-value' => '3',
 		)
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array( 
		'name'	=> esc_html__('BG Gradient Map(Duotone) Overlay Color 3', 'halena' ), 
		'desc'	=> esc_html__('Choose the color for Highlights(White pixels).', 'halena' ), 
		'id'	=> 'slideshow_bg_gm_overlay_color3', 
		'type'	=> 'colorpicker',
		'default' => '',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $slideshow_repeatable, 'slideshow_bg_overlay_choice' ) ),
 			'data-conditional-value' => '3',
 		)
	) );

	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array( 
		'name' => esc_html__('Particle Ground', 'halena' ),
		'desc' => esc_html__('It will enable the particles for the background.', 'halena' ),
		'id' => 'slideshow_bg_particle_ground',
		'type' => 'checkbox',
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(  
		'name'	=> esc_html__('Particle Ground Color', 'halena' ), 
		'desc'	=> esc_html__('Choose the color and transparency for the particle ground.', 'halena' ), 
		'id'	=> 'slideshow_bg_particle_ground_color', 
		'type'	=> 'rgba_colorpicker',
		'default' => '',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $slideshow_repeatable, 'slideshow_bg_particle_ground' ) ),
 		)
	) );

	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array( 
        'name'  => esc_html__('Image', 'halena' ), 
        'id'    => 'slideshow_image', 
        'type'  => 'file',
        'before_row' => '<h3>Content Options</h3>'
    ) );
    $slideshow_slider_options->add_group_field( $slideshow_repeatable, array( 
        'name'  => esc_html__('Max Image width', 'halena' ), 
        'desc'  => esc_html__('Enter your image width, don\'t include "px" string', 'halena' ), 
        'id'    => 'slideshow_image_size', 
        'type'  => 'text_small',
        'default' => '240',
        'attributes' => array(
            'type'  => 'number',
            'min'  => '100',
            'max'  => '1000',
            'step'  => '5',
            //'required' => true,
            'data-conditional-id'    => json_encode( array( $slideshow_repeatable, 'slideshow_image' ) ),
        ),
        'row_classes' => 'agni-slide-col agni-slide-height-desktop',
        'before_row' => '<div class="cmb-row agni-slide-row agni-slide-height-container">'
    ) );
    $slideshow_slider_options->add_group_field( $slideshow_repeatable, array( 
        //'name'  => esc_html__('Max Image width', 'halena' ), 
        'desc'  => esc_html__('Enter your image width for tablets', 'halena' ), 
        'id'    => 'slideshow_image_size_tab', 
        'type'  => 'text_small',
        'default' => '160',
        'attributes' => array(
            'type'  => 'number',
            'min'  => '40',
            'max'  => '700',
            'step'  => '5',
            //'required' => true,
            'data-conditional-id'    => json_encode( array( $slideshow_repeatable, 'slideshow_image' ) ),
        ),
        'show_names' => false,
        'row_classes' => 'agni-slide-col agni-slide-height-tab',
    ) );
    $slideshow_slider_options->add_group_field( $slideshow_repeatable, array( 
        //'name'  => esc_html__('Max Image width', 'halena' ), 
        'desc'  => esc_html__('Enter your image width for mobiles', 'halena' ), 
        'id'    => 'slideshow_image_size_mobile', 
        'type'  => 'text_small',
        'default' => '100',
        'attributes' => array(
            'type'  => 'number',
            'min'  => '20',
            'max'  => '300',
            'step'  => '5',
            //'required' => true,
            'data-conditional-id'    => json_encode( array( $slideshow_repeatable, 'slideshow_image' ) ),
        ),
        'show_names' => false,
        'row_classes' => 'agni-slide-col agni-slide-height-mobile',
        'after_row' => '</div>'
    ) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		'name' => esc_html__('Title', 'halena' ),
		'desc' => esc_html__('To use a text effect. Add the texts with delimiter "|" inside <span> tag. For ex. Hello, <span>This is|Sample|Text</span>', 'halena' ),
		'id' => 'slideshow_title',
		'type' => 'text',
		'sanitization_cb' => false,
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		'name' => esc_html__('Title Rotator', 'halena' ),
		'desc' => esc_html__('Check this for Title rotator. it enables the text effects to the title.', 'halena' ),
		'id' => 'slideshow_title_rotator',
		'type' => 'checkbox',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $slideshow_repeatable, 'slideshow_title' ) ),
		),
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		'name'	=> esc_html__('Choose Rotator Effect', 'halena' ),
		'id'	=> 'slideshow_title_rotator_choice',
		'type'	=> 'select',
		'options' => array( 
			'type letters' => esc_html__('Type', 'halena' ), 
			'zoom' => esc_html__('Zoom', 'halena' ), 
		),
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $slideshow_repeatable, 'slideshow_title_rotator' ) ),
		),
		'default'  => 'scale letters'
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		'name' => esc_html__('Title Font', 'halena' ),
		'desc' => esc_html__('It will apply the font to the Title which you choose at "Halena/Theme Options/General Settings/Typography".', 'halena' ),
		'id' => 'slideshow_title_font',
		'type' => 'select',
		'options' => array( 
			'primary-typo' => esc_html__('Primary Font', 'halena' ), 
			'default-typo' => esc_html__('Default Font', 'halena' ), 
			'additional-typo' => esc_html__('Additional Font', 'halena' ), 
			'special-typo' => esc_html__('Special Font', 'halena' ), 
		),
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $slideshow_repeatable, 'slideshow_title' ) ),
		),
		'default' => 'primary-typo',
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		'name'	=> esc_html__('Title Font Size', 'halena' ), 
		'desc'	=> esc_html__('Enter your title font size, don\'t include "px" string', 'halena' ), 
		'id'	=> 'slideshow_title_size', 
		'type'	=> 'text_small',
		'default' => '',
		'attributes' => array(
			'type'  => 'number',
			'min'  => '30',
			'max'  => '200',
			'step'  => '1',
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $slideshow_repeatable, 'slideshow_title' ) ),
 			//'data-conditional-id'    => 'agni_slides_slideshow_repeatable[{#}][slideshow_title]',
		),
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		'name'	=> esc_html__('Title Color', 'halena' ), 
		'desc'	=> esc_html__('Choose the color for title', 'halena' ), 
		'id'	=> 'slideshow_title_color', 
		'type'	=> 'colorpicker',
		'default' => '#f0f0f0',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $slideshow_repeatable, 'slideshow_title' ) ),
 			//'data-conditional-id'    => 'agni_slides_slideshow_repeatable[{#}][slideshow_title]',
 		)
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		'name'	=> esc_html__('Title Margin Bottom', 'halena' ), 
		'desc'	=> esc_html__('Enter the bottom margin for the title.', 'halena' ), 
		'id'	=> 'slideshow_title_margin_bottom', 
		'type'	=> 'text_small',
		'default' => '35',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $slideshow_repeatable, 'slideshow_title' ) ),
 			//'data-conditional-id'    => 'agni_slides_slideshow_repeatable[{#}][slideshow_title]',
 		)
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		'name' => esc_html__('Description', 'halena' ),
		'id' => 'slideshow_desc',
		'type' => 'textarea_small',
		'sanitization_cb' => false,
		'attributes'  => array(
	        'placeholder' => 'A small amount of text',
	        'rows'        => 2,
	    ),
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		'name' => esc_html__('Description Font', 'halena' ),
		'desc' => esc_html__('It will apply the font to the Description which you choose at "Halena/Theme Options/General Settings/Typography".', 'halena' ),
		'id' => 'slideshow_desc_font',
		'type' => 'select',
		'options' => array( 
			'primary-typo' => esc_html__('Primary Font', 'halena' ), 
			'default-typo' => esc_html__('Default Font', 'halena' ), 
			'additional-typo' => esc_html__('Additional Font', 'halena' ), 
			'special-typo' => esc_html__('Special Font', 'halena' ), 
		),
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $slideshow_repeatable, 'slideshow_desc' ) ),
		),
		'default' => 'default-typo',
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		'name'	=> esc_html__('Description Font Size', 'halena' ), 
		'desc'	=> esc_html__('Enter your title font size, don\'t include "px" string', 'halena' ), 
		'id'	=> 'slideshow_desc_size', 
		'type'	=> 'text_small',
		'default' => '',
		'attributes' => array(
			'type'  => 'number',
			'min'  => '15',
			'max'  => '60',
			'step'  => '1',
			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $slideshow_repeatable, 'slideshow_desc' ) ),
 			//'data-conditional-id'    => 'agni_slides_slideshow_repeatable[{#}][slideshow_title]',
		),
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		'name'	=> esc_html__('Description Color ', 'halena' ), 
		'desc'	=> esc_html__('choose the description color', 'halena' ), 
		'id'	=> 'slideshow_desc_color', 
		'type'	=> 'colorpicker',
		'default' => '#f0f0f0',
		'attributes' => array(
 			'data-conditional-id'    => json_encode( array( $slideshow_repeatable, 'slideshow_desc' ) ),
 		)
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		'name'	=> esc_html__('Description Margin Bottom', 'halena' ), 
		'desc'	=> esc_html__('Enter the bottom margin for the description.', 'halena' ), 
		'id'	=> 'slideshow_desc_margin_bottom', 
		'type'	=> 'text_small',
		'default' => '30',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $slideshow_repeatable, 'slideshow_desc' ) ),
 			//'data-conditional-id'    => 'agni_slides_slideshow_repeatable[{#}][slideshow_title]',
 		)
	) );

	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		'name' => esc_html__('Divide Line', 'halena' ),
		'desc' => esc_html__('Checking this for FadeInUp animation.', 'halena' ),
		'id' => 'slideshow_line',
		'type' => 'checkbox',
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		'name'	=> esc_html__('Divide Line Color ', 'halena' ), 
		'desc'	=> esc_html__('choose the description color', 'halena' ), 
		'id'	=> 'slideshow_line_color', 
		'type'	=> 'colorpicker',
		'default' => '#f0f0f0',
		'attributes' => array(
 			'data-conditional-id'    => json_encode( array( $slideshow_repeatable, 'slideshow_line' ) ),
 		)
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array( 
		'name'	=> esc_html__('Button 1', 'halena' ), 
		'desc'	=> esc_html__('button 1 info', 'halena' ), 
		'id'	=> 'slideshow_button1', 
		'type'	=> 'text_small'
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array( 
		'name'	=> esc_html__('Button 1 Icon', 'halena' ),
		'id'	=> 'slideshow_button1_icon',
		'type'	=> 'select',
		'options' => array( 
			'' => esc_html__('No icon', 'halena' ), 
			'icon-arrows-slim-right' => esc_html__('Arrow Right', 'halena' ), 
		),
		'default' => '',
		'attributes' => array(
			'data-conditional-id' => json_encode( array( $slideshow_repeatable, 'slideshow_button1' ) ),
		)
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array( 
		'name'	=> esc_html__('Button 1 Icon Style', 'halena' ),
		'id'	=> 'slideshow_button1_icon_style',
		'type'	=> 'select',
		'options' => array( 
			'' => esc_html__('Default', 'halena' ), 
			'has-big-btn' => esc_html__('Big Rounded', 'halena' ), 
		),
		'default' => '',
		'attributes' => array(
			'data-conditional-id' => json_encode( array( $slideshow_repeatable, 'slideshow_button1_icon' ) ),
		)
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array( 
		'name' => esc_html__('Hide Button 1 Text', 'halena' ),
		'desc' => esc_html__('It will hide the button text.', 'halena' ),
		'id' => 'slideshow_button1_text_hide',
		'type' => 'checkbox',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => json_encode( array( $slideshow_repeatable, 'slideshow_button1_icon_style' ) ),
 			//'data-conditional-value' => 'on',
 		),
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array( 
		'name'	=> esc_html__('Button 1 URL', 'halena' ), 
		'desc'	=> esc_html__('button href', 'halena' ), 
		'id'	=> 'slideshow_button1_url', 
		'type'	=> 'text_url',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => json_encode( array( $slideshow_repeatable, 'slideshow_button1' ) ),
 			//'data-conditional-value' => 'on',
 		)
	) );
	
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		'name'	=> esc_html__('Button 1 Style', 'halena' ),
		'id'	=> 'slideshow_button1_style',
		'type'	=> 'select',
		'options' => array( 
			'default' => esc_html__('Default', 'halena' ), 
			'primary' => esc_html__('Primary', 'halena' ), 
			'accent' => esc_html__('Accent', 'halena' ), 
			'white' => esc_html__('White', 'halena' ), 
		),
		'default' => 'white',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => json_encode( array( $slideshow_repeatable, 'slideshow_button1' ) ),
 			//'data-conditional-value' => 'on',
 		),
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array( 
		'name'	=> esc_html__('Button 1 Type', 'halena' ),
		'id'	=> 'slideshow_button1_type',
		'type'	=> 'radio_inline',
		'options' => array( 
			'btn-normal' => esc_html__('background', 'halena' ), 
			'btn-alt' => esc_html__('Bordered', 'halena' ), 
			'btn-plain' => esc_html__('Plain', 'halena' ), 
		),
		'default' => 'btn-normal',
		'attributes' => array(
			'data-conditional-id' => json_encode( array( $slideshow_repeatable, 'slideshow_button1' ) ),
		)
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array( 
		'name'	=> esc_html__('Button 1 Radius', 'halena' ), 
		'desc'	=> esc_html__('You can use px, em, %, etc. or enter just number and it will use pixels.', 'halena' ), 
		'id'	=> 'slideshow_button1_radius', 
		'type'	=> 'text_small',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => json_encode( array( $slideshow_repeatable, 'slideshow_button1' ) ),
 			//'data-conditional-value' => 'on',
 		),
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		'name'	=> esc_html__('Button 1 Target', 'halena' ),
		'id'	=> 'slideshow_button1_target',
		'type'	=> 'select',
		'options' => array( 
			'_self' => esc_html__('Same Window', 'halena' ), 
			'_blank' => esc_html__('New Window', 'halena' ), 
		),
		'default' => '_self',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => json_encode( array( $slideshow_repeatable, 'slideshow_button1' ) ),
 			//'data-conditional-value' => 'on',
 		),
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		'name' => esc_html__('Button 1 has Lightbox Video?', 'halena' ),
		'desc' => esc_html__('Checking this for FadeInDown animation.', 'halena' ),
		'id' => 'slideshow_button1_lightbox',
		'type' => 'checkbox',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => json_encode( array( $slideshow_repeatable, 'slideshow_button1' ) ),
 			//'data-conditional-value' => 'on',
 		),
	) );	
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		'name'	=> esc_html__('Button 1 Embed code', 'halena' ), 
		'desc'	=> esc_html__('enter the youtube, vimeo or any video embed link. This code will ignore the actual button link', 'halena' ), 
		'id'	=> 'slideshow_button1_embed_url', 
		'type'	=> 'textarea_small',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => json_encode( array( $slideshow_repeatable, 'slideshow_button1_lightbox' ) ),
 			//'data-conditional-value' => 'on',
 		),
		'sanitization_cb' => false
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array( 
		'name'	=> esc_html__('Button 2', 'halena' ), 
		'desc'	=> esc_html__('button 2 info', 'halena' ), 
		'id'	=> 'slideshow_button2', 
		'type'	=> 'text_small'
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array( 
		'name'	=> esc_html__('Button 2 Icon', 'halena' ),
		'id'	=> 'slideshow_button2_icon',
		'type'	=> 'select',
		'options' => array( 
			'' => esc_html__('No icon', 'halena' ), 
			'icon-arrows-slim-right' => esc_html__('Arrow Right', 'halena' ), 
		),
		'default' => '',
		'attributes' => array(
			'data-conditional-id' => json_encode( array( $slideshow_repeatable, 'slideshow_button2' ) ),
		)
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array( 
		'name'	=> esc_html__('Button 2 Icon Style', 'halena' ),
		'id'	=> 'slideshow_button2_icon_style',
		'type'	=> 'select',
		'options' => array( 
			'' => esc_html__('Default', 'halena' ), 
			'has-big-btn' => esc_html__('Big Rounded', 'halena' ), 
		),
		'default' => '',
		'attributes' => array(
			'data-conditional-id' => json_encode( array( $slideshow_repeatable, 'slideshow_button2_icon' ) ),
		)
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array( 
		'name' => esc_html__('Hide Button 2 Text', 'halena' ),
		'desc' => esc_html__('It will hide the button text.', 'halena' ),
		'id' => 'slideshow_button2_text_hide',
		'type' => 'checkbox',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => json_encode( array( $slideshow_repeatable, 'slideshow_button2_icon_style' ) ),
 			//'data-conditional-value' => 'on',
 		),
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array( 
		'name'	=> esc_html__('Button 2 URL', 'halena' ), 
		'desc'	=> esc_html__('button href', 'halena' ), 
		'id'	=> 'slideshow_button2_url', 
		'type'	=> 'text_url',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => json_encode( array( $slideshow_repeatable, 'slideshow_button2' ) ),
 			//'data-conditional-value' => 'on',
 		)
	) );
	
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		'name'	=> esc_html__('Button 2 Style', 'halena' ),
		'id'	=> 'slideshow_button2_style',
		'type'	=> 'select',
		'options' => array( 
			'default' => esc_html__('Default', 'halena' ), 
			'primary' => esc_html__('Primary', 'halena' ), 
			'accent' => esc_html__('Accent', 'halena' ), 
			'white' => esc_html__('White', 'halena' ), 
		),
		'default' => 'white',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => json_encode( array( $slideshow_repeatable, 'slideshow_button2' ) ),
 			//'data-conditional-value' => 'on',
 		),
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array( 
		'name'	=> esc_html__('Button 2 Type', 'halena' ),
		'id'	=> 'slideshow_button2_type',
		'type'	=> 'radio_inline',
		'options' => array( 
			'btn-normal' => esc_html__('background', 'halena' ), 
			'btn-alt' => esc_html__('Bordered', 'halena' ), 
			'btn-plain' => esc_html__('Plain', 'halena' ), 
		),
		'default' => 'btn-normal',
		'attributes' => array(
			'data-conditional-id' => json_encode( array( $slideshow_repeatable, 'slideshow_button2' ) ),
		)
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array( 
		'name'	=> esc_html__('Button 2 Radius', 'halena' ), 
		'desc'	=> esc_html__('You can use px, em, %, etc. or enter just number and it will use pixels.', 'halena' ), 
		'id'	=> 'slideshow_button2_radius', 
		'type'	=> 'text_small',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => json_encode( array( $slideshow_repeatable, 'slideshow_button2' ) ),
 			//'data-conditional-value' => 'on',
 		),
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		'name'	=> esc_html__('Button 2 Target', 'halena' ),
		'id'	=> 'slideshow_button2_target',
		'type'	=> 'select',
		'options' => array( 
			'_self' => esc_html__('Same Window', 'halena' ), 
			'_blank' => esc_html__('New Window', 'halena' ), 
		),
		'default' => '_self',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => json_encode( array( $slideshow_repeatable, 'slideshow_button2' ) ),
 			//'data-conditional-value' => 'on',
 		),
	) );	
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		'name' => esc_html__('Button 2 has Lightbox Video?', 'halena' ),
		'desc' => esc_html__('Checking this for FadeInDown animation.', 'halena' ),
		'id' => 'slideshow_button2_lightbox',
		'type' => 'checkbox',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => json_encode( array( $slideshow_repeatable, 'slideshow_button2' ) ),
 			//'data-conditional-value' => 'on',
 		),
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		'name'	=> esc_html__('Button 2 Embed code', 'halena' ), 
		'desc'	=> esc_html__('enter the youtube, vimeo or any video embed link. This code will ignore the actual button link', 'halena' ), 
		'id'	=> 'slideshow_button2_embed_url', 
		'type'	=> 'textarea_small',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => json_encode( array( $slideshow_repeatable, 'slideshow_button2_lightbox' ) ),
 			//'data-conditional-value' => 'on',
 		),
		'sanitization_cb' => false
	) );

	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		'name' => esc_html__('Text Animation', 'halena' ),
		'desc' => esc_html__('Checking this for FadeInDown animation.', 'halena' ),
		'id' => 'slideshow_animation',
		'type'	=> 'select',
		'options' => array( 
			'' => esc_html__('No Animation', 'halena' ), 
			'fade-in' => esc_html__('fadeIn', 'halena' ), 
			'fade-in-down' => esc_html__('fadeInDown', 'halena' ),
			'fade-in-up' => esc_html__('fadeInUp', 'halena' ),
			'zoom-in' => esc_html__('zoomIn', 'halena' ),
		),
		'default' => '',
	) );

	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array( 
		'name'	=> esc_html__('Bottom Arrow Icon', 'halena' ),
		'id'	=> 'slideshow_arrowicon',
		'type'	=> 'select',
		'options' => array( 
			'' => esc_html__('No icon', 'halena' ), 
			'pe-7s-angle-down' => esc_html__('Angle Down', 'halena' ), 
			'pe-7s-angle-down-circle' => esc_html__('Angle Down Circled', 'halena' ), 
			'ion-ios-arrow-thin-down' => esc_html__('Arrow Down', 'halena' ), 
			'pe-7s-bottom-arrow' => esc_html__('Arrow Down Circled', 'halena' ), 
			'pe-7s-mouse' => esc_html__('Mouse', 'halena' ), 
		),
		'default' => '',
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		'name'	=> esc_html__('Bottom Arrow link', 'halena' ), 
		'id'	=> 'slideshow_arrowlink', 
		'type'	=> 'text_url',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => json_encode( array( $slideshow_repeatable, 'slideshow_arrowicon' ) ),
 			//'data-conditional-value' => 'on',
 		),
	) );
	
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		'name'	=> esc_html__('Bottom Arrow Color', 'halena' ), 
		'desc'	=> esc_html__('Choose the color for the bottom arrow', 'halena' ), 
		'id'	=> 'slideshow_arrowicon_color', 
		'type'	=> 'colorpicker',
		'attributes' => array(
			//'required' => true, // Will be required only if visible.
			'data-conditional-id' => json_encode( array( $slideshow_repeatable, 'slideshow_arrowicon' ) ),
		)		
	) );
	
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		'name'	=> esc_html__('Content stretch', 'halena' ), 
		'id'	=> 'slideshow_content_choice', 
		'type'	=> 'radio_inline',
		'options' => array( 
			'container' => esc_html__( 'Container', 'halena' ), 
			'container-fluid' => esc_html__( 'Fullwidth', 'halena' ), 
		),
		'default'  => 'container'
	) );

	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array( 
		'name'	=> esc_html__('Content Width', 'halena' ), 
		'id'	=> 'slideshow_content_width', 
		'type'	=> 'text_small',
		'default' => '',
		'row_classes' => 'agni-slide-col agni-slide-height-desktop',
		'before_row' => '<div class="cmb-row agni-slide-row agni-slide-height-container">'
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array( 
		//'name'	=> esc_html__('Content Width', 'halena' ), 
		'id'	=> 'slideshow_content_width_tab', 
		'desc'	=> esc_html__('content width for tab', 'halena' ), 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-height-tab',
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array( 
		//'name'	=> esc_html__('Content Width', 'halena' ), 
		'id'	=> 'slideshow_content_width_mobile', 
		'desc'	=> esc_html__('content width for mobile', 'halena' ), 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-height-mobile',
		'after_row' => '</div>'
	) );
	
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		'name'	=> esc_html__('Content Position', 'halena' ),
		'id'	=> 'slideshow_content_position',
		'type'	=> 'select',
		'options' => array( 
			'j-flex-start a-flex-start' => esc_html__('left top', 'halena' ), 
			'j-flex-start a-center' => esc_html__('left center', 'halena' ), 
			'j-flex-start a-flex-end' => esc_html__('left bottom', 'halena' ), 
			'j-flex-end a-flex-start' => esc_html__('right top', 'halena' ), 
			'j-flex-end a-center' => esc_html__('right center', 'halena' ), 
			'j-flex-end a-flex-end' => esc_html__('right bottom', 'halena' ), 
			'j-center a-flex-start' => esc_html__('center top', 'halena' ), 
			'j-center a-center' => esc_html__('center center', 'halena' ), 
			'j-center a-flex-end' => esc_html__('center bottom', 'halena' ),
		),
		'default'  => 'j-flex-start a-center'
	) );

	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		'name'	=> esc_html__('Content Alignment', 'halena' ),
		'id'	=> 'slideshow_text_alignment',
		'type'	=> 'radio_inline',
		'options' => array( 
			'left' => esc_html__( 'Left', 'halena' ), 
			'center' => esc_html__( 'Center', 'halena' ), 
			'right' => esc_html__( 'Right', 'halena' ), 
		),
		'default'  => 'left'
	) );

	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		'name'	=> esc_html__('Padding Values', 'halena' ), 
		'desc'	=> esc_html__('Padding Top. You can use px, em, %, etc. or enter just number and it will use pixels.', 'halena' ), 
		'id'	=> 'slideshow_padding_top', 
		'type'	=> 'text_small',
		'default' => '',
		'row_classes' => 'agni-slide-col agni-slide-padding-top',
		'before_row' => '<div class="cmb-row agni-slide-row agni-slide-padding-container">'
	) );

	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		//'name'	=> esc_html__('Padding Right', 'halena' ), 
		'desc'	=> esc_html__('Padding Right', 'halena' ), 
		'id'	=> 'slideshow_padding_right', 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-right'
		
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		//'name'	=> esc_html__('Padding Bottom', 'halena' ), 
		'desc'	=> esc_html__('Padding Bottom', 'halena' ), 
		'id'	=> 'slideshow_padding_bottom', 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-bottom',
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		//'name'	=> esc_html__('Padding Left', 'halena' ), 
		'desc'	=> esc_html__('Padding Left', 'halena' ), 
		'id'	=> 'slideshow_padding_left', 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-left',
		'after_row' => '</div>'
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		'name'	=> esc_html__('Padding Values for Tablets', 'halena' ), 
		'desc'	=> esc_html__('Padding Top', 'halena' ), 
		'id'	=> 'slideshow_padding_top_tab', 
		'type'	=> 'text_small',
		'default' => '',
		'row_classes' => 'agni-slide-col agni-slide-padding-top',
		'before_row' => '<div class="cmb-row agni-slide-row agni-slide-padding-container">'
	) );

	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		//'name'	=> esc_html__('Padding Right', 'halena' ), 
		'desc'	=> esc_html__('Padding Right', 'halena' ), 
		'id'	=> 'slideshow_padding_right_tab', 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-right'
		
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		//'name'	=> esc_html__('Padding Bottom', 'halena' ), 
		'desc'	=> esc_html__('Padding Bottom', 'halena' ), 
		'id'	=> 'slideshow_padding_bottom_tab', 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-bottom',
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		//'name'	=> esc_html__('Padding Left', 'halena' ), 
		'desc'	=> esc_html__('Padding Left', 'halena' ), 
		'id'	=> 'slideshow_padding_left_tab', 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-left',
		'after_row' => '</div>'
	) );

	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		'name'	=> esc_html__('Padding Values for mobile', 'halena' ), 
		'desc'	=> esc_html__('Padding Top', 'halena' ), 
		'id'	=> 'slideshow_padding_top_mobile', 
		'type'	=> 'text_small',
		'default' => '',
		'row_classes' => 'agni-slide-col agni-slide-padding-top',
		'before_row' => '<div class="cmb-row agni-slide-row agni-slide-padding-container">'
	) );

	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		//'name'	=> esc_html__('Padding Right', 'halena' ), 
		'desc'	=> esc_html__('Padding Right', 'halena' ), 
		'id'	=> 'slideshow_padding_right_mobile', 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-right'
		
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		//'name'	=> esc_html__('Padding Bottom', 'halena' ), 
		'desc'	=> esc_html__('Padding Bottom', 'halena' ), 
		'id'	=> 'slideshow_padding_bottom_mobile', 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-bottom',
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		//'name'	=> esc_html__('Padding Left', 'halena' ), 
		'desc'	=> esc_html__('Padding Left', 'halena' ), 
		'id'	=> 'slideshow_padding_left_mobile', 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-left',
		'after_row' => '</div>'
	) );

	$slideshow_slider_options->add_field( array(
		'name'	=> esc_html__('Slider Choice', 'halena' ),
		'id'	=> $prefix.'slideshow_choice',
		'type'	=> 'radio_inline',
		'options' => array( 
			'1' => esc_html__('Full Height(100%)', 'halena' ), 
			'2' => esc_html__('Custom Height', 'halena' ), 
		),
		'default' => '1',
		'before_row' => '<h3>Basic Options</h3>'
	) );
	$slideshow_slider_options->add_field( array( 
		'name'	=> esc_html__('Slider Height', 'halena' ), 
		'desc'	=> esc_html__('Enter your slider height, don\'t include "px" string', 'halena' ), 
		'id'	=> $prefix.'slideshow_height', 
		'type'	=> 'text_small',
		'default' => '600',
		'attributes' => array(
			'required' => false, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'slideshow_choice',
			'data-conditional-value' => '2',
		),
		'row_classes' => 'agni-slide-col agni-slide-height-desktop',
		'before_row' => '<div class="cmb-row agni-slide-row agni-slide-height-container">'
	) );
	$slideshow_slider_options->add_field( array( 
		'name'	=> esc_html__('Slider Height(Tablet devices)', 'halena' ), 
		'desc'	=> esc_html__('Height on Tablets', 'halena' ), 
		'id'	=> $prefix.'slideshow_height_tab', 
		'type'	=> 'text_small',
		'default' => '480',
		'attributes' => array(
			'required' => false, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'slideshow_choice',
			'data-conditional-value' => '2',
		),
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-height-tab',
	) );
	$slideshow_slider_options->add_field( array( 
		'name'	=> esc_html__('Slider Height(Mobile devices)', 'halena' ), 
		'desc'	=> esc_html__('Height on Mobiles', 'halena' ), 
		'id'	=> $prefix.'slideshow_height_mobile', 
		'type'	=> 'text_small',
		'default' => '360',
		'attributes' => array(
			'required' => false, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'slideshow_choice',
			'data-conditional-value' => '2',
		),
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-height-mobile',
		'after_row' => '</div>'
	) );
	$slideshow_slider_options->add_field( array( 
		'name'	=> esc_html__('Margin Values', 'halena' ), 
		'desc'	=> esc_html__('margin top value for the slider. You can use px, em, %, etc. or enter just number and it will use pixels.', 'halena' ), 
		'id'	=> $prefix.'slideshow_margin_top', 
		'type'	=> 'text_small',
		'default' => '',
		'row_classes' => 'agni-slide-col agni-slide-padding-top',
		'before_row' => '<div class="cmb-row agni-slide-row agni-slide-padding-container">'
	) );
	$slideshow_slider_options->add_field( array( 
		//'name'	=> esc_html__('Margin Values', 'halena' ), 
		'desc'	=> esc_html__('margin right value', 'halena' ), 
		'id'	=> $prefix.'slideshow_margin_right', 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-right'
	) );
	$slideshow_slider_options->add_field( array( 
		//'name'	=> esc_html__('Margin Values', 'halena' ), 
		'desc'	=> esc_html__('margin bottom value', 'halena' ), 
		'id'	=> $prefix.'slideshow_margin_bottom', 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-bottom'
	) );
	$slideshow_slider_options->add_field( array( 
		//'name'	=> esc_html__('Margin Values', 'halena' ), 
		'desc'	=> esc_html__('margin left value', 'halena' ), 
		'id'	=> $prefix.'slideshow_margin_left', 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-left',
		'after_row' => '</div>'
	) );
	$slideshow_slider_options->add_field( array( 
		'name'	=> esc_html__('Margin Values for Tablets', 'halena' ), 
		'desc'	=> esc_html__('margin top value', 'halena' ), 
		'id'	=> $prefix.'slideshow_margin_top_tab', 
		'type'	=> 'text_small',
		'default' => '',
		'row_classes' => 'agni-slide-col agni-slide-padding-top',
		'before_row' => '<div class="cmb-row agni-slide-row agni-slide-padding-container">'
	) );
	$slideshow_slider_options->add_field( array( 
		//'name'	=> esc_html__('Margin Values', 'halena' ), 
		'desc'	=> esc_html__('margin right value', 'halena' ), 
		'id'	=> $prefix.'slideshow_margin_right_tab', 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-right'
	) );
	$slideshow_slider_options->add_field( array( 
		//'name'	=> esc_html__('Margin Values', 'halena' ), 
		'desc'	=> esc_html__('margin bottom value', 'halena' ), 
		'id'	=> $prefix.'slideshow_margin_bottom_tab', 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-bottom'
	) );
	$slideshow_slider_options->add_field( array( 
		//'name'	=> esc_html__('Margin Values', 'halena' ), 
		'desc'	=> esc_html__('margin left value', 'halena' ), 
		'id'	=> $prefix.'slideshow_margin_left_tab', 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-left',
		'after_row' => '</div>'
	) );
	$slideshow_slider_options->add_field( array( 
		'name'	=> esc_html__('Margin Values for Mobile', 'halena' ), 
		'desc'	=> esc_html__('margin top value', 'halena' ), 
		'id'	=> $prefix.'slideshow_margin_top_mobile', 
		'type'	=> 'text_small',
		'default' => '',
		'row_classes' => 'agni-slide-col agni-slide-padding-top',
		'before_row' => '<div class="cmb-row agni-slide-row agni-slide-padding-container">'
	) );
	$slideshow_slider_options->add_field( array( 
		//'name'	=> esc_html__('Margin Values', 'halena' ), 
		'desc'	=> esc_html__('margin right value', 'halena' ), 
		'id'	=> $prefix.'slideshow_margin_right_mobile', 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-right'
	) );
	$slideshow_slider_options->add_field( array( 
		//'name'	=> esc_html__('Margin Values', 'halena' ), 
		'desc'	=> esc_html__('margin bottom value', 'halena' ), 
		'id'	=> $prefix.'slideshow_margin_bottom_mobile', 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-bottom'
	) );
	$slideshow_slider_options->add_field( array( 
		//'name'	=> esc_html__('Margin Values', 'halena' ), 
		'desc'	=> esc_html__('margin left value', 'halena' ), 
		'id'	=> $prefix.'slideshow_margin_left_mobile', 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-left',
		'after_row' => '</div>'
	) );
	$slideshow_slider_options->add_field( array(
		'name' => esc_html__('Carousel', 'halena' ),
		'desc' => esc_html__('To use slider as a carousel enable this.', 'halena' ),
		'id' => $prefix.'slideshow_carousel',
		'type' => 'checkbox',
	) );
	$slideshow_slider_options->add_field( array( 
		'name'	=> esc_html__('Carousel Items', 'halena' ), 
		'desc'	=> esc_html__('Items per row', 'halena' ), 
		'id'	=> $prefix.'slideshow_carousel_992', 
		'type'	=> 'text_small',
		'default' => '3',
		'attributes' => array(
			'type'  => 'number',
			'min'  => '1',
			'max'  => '5',
			'step'  => '1',
			'required' => false, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'slideshow_carousel',
			'data-conditional-value' => 'on',
		),
		'row_classes' => 'agni-slide-col agni-slide-height-desktop',
		'before_row' => '<div class="cmb-row agni-slide-row agni-slide-height-container">'
	) );
	$slideshow_slider_options->add_field( array( 
		'name'	=> esc_html__('Carousel Items(Tablets)', 'halena' ), 
		'desc'	=> esc_html__('Items per row on Tablets', 'halena' ), 
		'id'	=> $prefix.'slideshow_carousel_768', 
		'type'	=> 'text_small',
		'default' => '2',
		'attributes' => array(
			'type'  => 'number',
			'min'  => '1',
			'max'  => '4',
			'step'  => '1',
			'required' => false, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'slideshow_carousel',
			'data-conditional-value' => 'on',
		),
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-height-tab',
	) );
	$slideshow_slider_options->add_field( array( 
		'name'	=> esc_html__('Carousel Items(Mobile)', 'halena' ), 
		'desc'	=> esc_html__('Items per row on Mobiles', 'halena' ), 
		'id'	=> $prefix.'slideshow_carousel_0', 
		'type'	=> 'text_small',
		'default' => '1',
		'attributes' => array(
			'type'  => 'number',
			'min'  => '1',
			'max'  => '3',
			'step'  => '1',
			'required' => false, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'slideshow_carousel',
			'data-conditional-value' => 'on',
		),
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-height-mobile',
		'after_row' => '</div>'
	) );
	$slideshow_slider_options->add_field( array(
		'name' => esc_html__('Center Mode', 'halena' ),
		'id' => $prefix.'slideshow_center_mode',
		'type' => 'checkbox',
		'attributes' => array(
			'required' => false, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'slideshow_carousel',
			'data-conditional-value' => 'on',
		),
	) );
	$slideshow_slider_options->add_field( array(
		'name' => esc_html__('Parallax', 'halena' ),
		'desc' => esc_html__('Check this to enable parallax, its purely based on skrollr.', 'halena' ),
		'id' => $prefix.'slideshow_parallax',
		'type' => 'checkbox',
	) );
	$slideshow_slider_options->add_field( array( 
		'name'	=> esc_html__('Parallax Value', 'halena' ), 
		'desc'	=> esc_html__('Enter the css property for the slider\'s top at the top of the screen. for eg.transform:translateY(0px); if don\'t want parallax just leave this empty', 'halena' ), 
		'id'	=> $prefix.'slideshow_parallax_start', 
		'type'	=> 'textarea_small',
		'default'  => 'transform:translateY(0px);',
		'attributes' => array(
	        'rows'        => 2,
	        'placeholder' => 'Parallax Starting Value',
			'required' => false, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'slideshow_parallax',
		),
		'row_classes' => 'agni-slide-col agni-slide-parallax-start',
		'before_row' => '<div class="cmb-row agni-slide-row agni-slide-parallax-container">'
	) );
	
	$slideshow_slider_options->add_field( array( 
		'name'	=> esc_html__('Parallax End Value', 'halena' ), 
		'desc'	=> esc_html__('Enter the css property for the slider\'s bottom when at the top of the screen. for eg.transform:translateY(600px); if don\'t want parallax just leave this empty', 'halena' ), 
		'id'	=> $prefix.'slideshow_parallax_end', 
		'type'	=> 'textarea_small',
		'default'  => 'transform:translateY(600px);',
		'attributes' => array(
			'rows'        => 2,
			'placeholder' => 'Parallax End Value',
			'required' => false, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'slideshow_parallax',
		),
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-parallax-end',
		'after_row' => '</div>'
	) );
	$slideshow_slider_options->add_field( array(
		'name'	=> esc_html__('Autoplay', 'halena' ),
		'id'	=> $prefix.'slideshow_autoplay',
		'type'	=> 'checkbox',
	) );
	$slideshow_slider_options->add_field( array( 
		'name'	=> esc_html__('Autoplay Speed', 'halena' ), 
		'desc'	=> esc_html__('Enter your transition duration in ms.', 'halena' ), 
		'id'	=> $prefix.'slideshow_transition_duration', 
		'type'	=> 'text_small',
		'default' => '6000',
		'attributes' => array(
			'type'  => 'number',
			'min'  => '3000',
			'max'  => '20000',
			'step'  => '100',
			'required' => false, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'slideshow_autoplay',
			'data-conditional-value' => 'on',
		),
	) );

	$slideshow_slider_options->add_field( array( 
		'name'	=> esc_html__('Transition Speed', 'halena' ), 
		'desc'	=> esc_html__('Enter your transition speed in ms.', 'halena' ), 
		'id'	=> $prefix.'slideshow_transition_speed', 
		'type'	=> 'text_small',
		'default' => '400',
		'attributes' => array(
			'type'  => 'number',
			'min'  => '100',
			'max'  => '1200',
			'step'  => '10'
		),
	) );

	$slideshow_slider_options->add_field( array(
		'name'	=> esc_html__('Loop', 'halena' ),
		'id'	=> $prefix.'slideshow_loop',
		'type'	=> 'checkbox',
	) );

	$slideshow_slider_options->add_field( array(
		'name'	=> esc_html__('Slide Animation', 'halena' ),
		'id'	=> $prefix.'slideshow_slide_animation',
		'type'	=> 'select',
		'options' => array( 
			'fade' => esc_html__('Fade', 'halena' ), 
			'slide' => esc_html__('Slide', 'halena' ),
		),
		'default' => 'slide',
	) );
	$slideshow_slider_options->add_field( array(
		'name'	=> esc_html__('Navigation Arrows', 'halena' ),
		'id'	=> $prefix.'slideshow_navigation',
		'type'	=> 'checkbox',
	) );
	$slideshow_slider_options->add_field( array( 
		'name'	=> esc_html__('Nav Prev Text', 'halena' ), 
		'desc'	=> esc_html__('Enter your text/label for Previous. for ex. Previous', 'halena' ), 
		'id'	=> $prefix.'slideshow_navigation_prev', 
		'type'	=> 'text_small',
		'attributes' => array(
			'required' => false, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'slideshow_navigation',
		),
		'sanitization_cb' => false,
		'default' => 'Previous',
	) );
	$slideshow_slider_options->add_field( array( 
		'name'	=> esc_html__('Nav next Text', 'halena' ), 
		'desc'	=> esc_html__('Enter your text/label for next. for ex. Next', 'halena' ), 
		'id'	=> $prefix.'slideshow_navigation_next', 
		'type'	=> 'text_small',
		'attributes' => array(
			'required' => false, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'slideshow_navigation',
		),
		'sanitization_cb' => false,
		'default' => 'Next ',
	) );

	$slideshow_slider_options->add_field( array(
		'name'	=> esc_html__('Pagination Dots', 'halena' ),
		'id'	=> $prefix.'slideshow_pagination',
		'type'	=> 'checkbox',
	) );
	$slideshow_slider_options->add_field( array(
		'name'	=> esc_html__('Mouse Drag', 'halena' ),
		'id'	=> $prefix.'slideshow_mousedrag',
		'type'	=> 'checkbox',
	) );

	
	// Text Slider
	$textslider_slider_options = new_cmb2_box( array(
		'id'            => $prefix . 'textslider_options',
		'title'         => esc_html__( 'Text Slider Options', 'halena' ),
		'object_types'  => array( 'agni_slides' ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
	) );
	
	// $group_field_id is the field id string, so in this case: $prefix . 'demo'
	$textslider_repeatable = $textslider_slider_options->add_field( array(
		'id'          => $prefix . 'textslider_repeatable',
		'type'        => 'group',
		'options'     => array(
			'group_title'   => esc_html__( 'Slide {#}', 'halena' ), // {#} gets replaced by row number
			'add_button'    => esc_html__( 'Add another Slide', 'halena' ),
			'remove_button' => esc_html__( 'Remove Slide', 'halena' ),
			'sortable'      => true, // beta
		),
	) );

	/**
	 * Group fields works the same, except ids only need
	 * to be unique to the group. Prefix is not needed.
	 *
	 * The parent field's id needs to be passed as the first argument.
	 */

	$textslider_slider_options->add_group_field( $textslider_repeatable, array( 
        'name'  => esc_html__('Image', 'halena' ), 
        'id'    => 'textslider_image', 
        'type'  => 'file',
        'before_row' => '<h3>Content Options</h3>'
    ) );
    $textslider_slider_options->add_group_field( $textslider_repeatable, array( 
        'name'  => esc_html__('Max Image width', 'halena' ), 
        'desc'  => esc_html__('Enter your image width, don\'t include "px" string', 'halena' ), 
        'id'    => 'textslider_image_size', 
        'type'  => 'text_small',
        'default' => '240',
        'attributes' => array(
            'type'  => 'number',
            'min'  => '100',
            'max'  => '1000',
            'step'  => '5',
            //'required' => true,
            'data-conditional-id'    => json_encode( array( $textslider_repeatable, 'textslider_image' ) ),
        ),
        'row_classes' => 'agni-slide-col agni-slide-height-desktop',
        'before_row' => '<div class="cmb-row agni-slide-row agni-slide-height-container">'
    ) );
    $textslider_slider_options->add_group_field( $textslider_repeatable, array( 
        //'name'  => esc_html__('Max Image width', 'halena' ), 
        'desc'  => esc_html__('Enter your image width for tablets', 'halena' ), 
        'id'    => 'textslider_image_size_tab', 
        'type'  => 'text_small',
        'default' => '160',
        'attributes' => array(
            'type'  => 'number',
            'min'  => '40',
            'max'  => '700',
            'step'  => '5',
            //'required' => true,
            'data-conditional-id'    => json_encode( array( $textslider_repeatable, 'textslider_image' ) ),
        ),
        'show_names' => false,
        'row_classes' => 'agni-slide-col agni-slide-height-tab',
    ) );
    $textslider_slider_options->add_group_field( $textslider_repeatable, array( 
        //'name'  => esc_html__('Max Image width', 'halena' ), 
        'desc'  => esc_html__('Enter your image width for mobiles', 'halena' ), 
        'id'    => 'textslider_image_size_mobile', 
        'type'  => 'text_small',
        'default' => '100',
        'attributes' => array(
            'type'  => 'number',
            'min'  => '20',
            'max'  => '300',
            'step'  => '5',
            //'required' => true,
            'data-conditional-id'    => json_encode( array( $textslider_repeatable, 'textslider_image' ) ),
        ),
        'show_names' => false,
        'row_classes' => 'agni-slide-col agni-slide-height-mobile',
        'after_row' => '</div>'
    ) );
	$textslider_slider_options->add_group_field( $textslider_repeatable, array(
		'name' => esc_html__('Title', 'halena' ),
		'desc' => esc_html__('To use a text effect. Add the texts with delimiter "|" inside <span> tag. For ex. Hello, <span>This is|Sample|Text</span>', 'halena' ),
		'id' => 'textslider_title',
		'type' => 'text',
		'sanitization_cb' => false,
	) );
	$textslider_slider_options->add_group_field( $textslider_repeatable, array(
		'name' => esc_html__('Title Rotator', 'halena' ),
		'desc' => esc_html__('Check this for Title rotator. it enables the text effects to the title.', 'halena' ),
		'id' => 'textslider_title_rotator',
		'type' => 'checkbox',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $textslider_repeatable, 'textslider_title' ) ),
		),
	) );
	$textslider_slider_options->add_group_field( $textslider_repeatable, array(
		'name'	=> esc_html__('Choose Rotator Effect', 'halena' ),
		'id'	=> 'textslider_title_rotator_choice',
		'type'	=> 'select',
		'options' => array( 
			'type letters' => esc_html__('Type', 'halena' ), 
			'zoom' => esc_html__('Zoom', 'halena' ), 
		),
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $textslider_repeatable, 'textslider_title_rotator' ) ),
		),
		'default'  => 'scale letters'
	) );
	$textslider_slider_options->add_group_field( $textslider_repeatable, array(
		'name' => esc_html__('Title Font', 'halena' ),
		'desc' => esc_html__('It will apply the font to the Title which you choose at "Halena/Theme Options/General Settings/Typography".', 'halena' ),
		'id' => 'textslider_title_font',
		'type' => 'select',
		'options' => array( 
			'primary-typo' => esc_html__('Primary Font', 'halena' ), 
			'default-typo' => esc_html__('Default Font', 'halena' ), 
			'additional-typo' => esc_html__('Additional Font', 'halena' ), 
			'special-typo' => esc_html__('Special Font', 'halena' ), 
		),
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $textslider_repeatable, 'textslider_title' ) ),
		),
		'default' => 'primary-typo',
	) );
	$textslider_slider_options->add_group_field( $textslider_repeatable, array(
		'name'	=> esc_html__('Title Font Size', 'halena' ), 
		'desc'	=> esc_html__('Enter your title font size, don\'t include "px" string', 'halena' ), 
		'id'	=> 'textslider_title_size', 
		'type'	=> 'text_small',
		'default' => '',
		'attributes' => array(
			'type'  => 'number',
			'min'  => '30',
			'max'  => '200',
			'step'  => '1',
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $textslider_repeatable, 'textslider_title' ) ),
 			//'data-conditional-id'    => 'agni_slides_textslider_repeatable[{#}][textslider_title]',
		),
	) );
	$textslider_slider_options->add_group_field( $textslider_repeatable, array(
		'name'	=> esc_html__('Title Color', 'halena' ), 
		'desc'	=> esc_html__('Choose the color for title', 'halena' ), 
		'id'	=> 'textslider_title_color', 
		'type'	=> 'colorpicker',
		'default' => '#f0f0f0',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $textslider_repeatable, 'textslider_title' ) ),
 			//'data-conditional-id'    => 'agni_slides_textslider_repeatable[{#}][textslider_title]',
 		)
	) );
	$textslider_slider_options->add_group_field( $textslider_repeatable, array(
		'name'	=> esc_html__('Title Margin Bottom', 'halena' ), 
		'desc'	=> esc_html__('Enter the bottom margin for the title.', 'halena' ), 
		'id'	=> 'textslider_title_margin_bottom', 
		'type'	=> 'text_small',
		'default' => '35',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $textslider_repeatable, 'textslider_title' ) ),
 		)
	) );
	$textslider_slider_options->add_group_field( $textslider_repeatable, array(
		'name' => esc_html__('Description', 'halena' ),
		'id' => 'textslider_desc',
		'type' => 'textarea_small',
		'sanitization_cb' => false,
		'attributes'  => array(
	        'placeholder' => 'A small amount of text',
	        'rows'        => 2,
	    ),
	) );
	$textslider_slider_options->add_group_field( $textslider_repeatable, array(
		'name' => esc_html__('Description Font', 'halena' ),
		'desc' => esc_html__('It will apply the font to the Description which you choose at "Halena/Theme Options/General Settings/Typography".', 'halena' ),
		'id' => 'textslider_desc_font',
		'type' => 'select',
		'options' => array( 
			'primary-typo' => esc_html__('Primary Font', 'halena' ), 
			'default-typo' => esc_html__('Default Font', 'halena' ), 
			'additional-typo' => esc_html__('Additional Font', 'halena' ), 
			'special-typo' => esc_html__('Special Font', 'halena' ), 
		),
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $textslider_repeatable, 'textslider_desc' ) ),
		),
		'default' => 'default-typo',
	) );
	$textslider_slider_options->add_group_field( $textslider_repeatable, array(
		'name'	=> esc_html__('Description Font Size', 'halena' ), 
		'desc'	=> esc_html__('Enter your title font size, don\'t include "px" string', 'halena' ), 
		'id'	=> 'textslider_desc_size', 
		'type'	=> 'text_small',
		'default' => '',
		'attributes' => array(
			'type'  => 'number',
			'min'  => '15',
			'max'  => '60',
			'step'  => '1',
			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $textslider_repeatable, 'textslider_desc' ) ),
 			//'data-conditional-id'    => 'agni_slides_textslider_repeatable[{#}][textslider_title]',
		),
	) );
	$textslider_slider_options->add_group_field( $textslider_repeatable, array(
		'name'	=> esc_html__('Description Color ', 'halena' ), 
		'desc'	=> esc_html__('choose the description color', 'halena' ), 
		'id'	=> 'textslider_desc_color', 
		'type'	=> 'colorpicker',
		'default' => '#f0f0f0',
		'attributes' => array(
 			'data-conditional-id'    => json_encode( array( $textslider_repeatable, 'textslider_desc' ) ),
 		)
	) );
	$textslider_slider_options->add_group_field( $textslider_repeatable, array(
		'name'	=> esc_html__('Description Margin Bottom', 'halena' ), 
		'desc'	=> esc_html__('Enter the bottom margin for the description.', 'halena' ), 
		'id'	=> 'textslider_desc_margin_bottom', 
		'type'	=> 'text_small',
		'default' => '30',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $textslider_repeatable, 'textslider_desc' ) ),
 			//'data-conditional-id'    => 'agni_slides_slideshow_repeatable[{#}][slideshow_title]',
 		)
	) );

	$textslider_slider_options->add_group_field( $textslider_repeatable, array(
		'name' => esc_html__('Divide Line', 'halena' ),
		'desc' => esc_html__('Checking this for FadeInUp animation.', 'halena' ),
		'id' => 'textslider_line',
		'type' => 'checkbox',
	) );
	$textslider_slider_options->add_group_field( $textslider_repeatable, array(
		'name'	=> esc_html__('Divide Line Color ', 'halena' ), 
		'desc'	=> esc_html__('choose the description color', 'halena' ), 
		'id'	=> 'textslider_line_color', 
		'type'	=> 'colorpicker',
		'default' => '#f0f0f0',
		'attributes' => array(
 			'data-conditional-id'    => json_encode( array( $textslider_repeatable, 'textslider_line' ) ),
 		)
	) );
	$textslider_slider_options->add_group_field( $textslider_repeatable, array( 
		'name'	=> esc_html__('Button 1', 'halena' ), 
		'desc'	=> esc_html__('button 1 info', 'halena' ), 
		'id'	=> 'textslider_button1', 
		'type'	=> 'text_small'
	) );
	$textslider_slider_options->add_group_field( $textslider_repeatable, array( 
		'name'	=> esc_html__('Button 1 Icon', 'halena' ),
		'id'	=> 'textslider_button1_icon',
		'type'	=> 'select',
		'options' => array( 
			'' => esc_html__('No icon', 'halena' ), 
			'icon-arrows-slim-right' => esc_html__('Arrow Right', 'halena' ), 
		),
		'default' => '',
		'attributes' => array(
			'data-conditional-id' => json_encode( array( $textslider_repeatable, 'textslider_button1' ) ),
		)
	) );
	$textslider_slider_options->add_group_field( $textslider_repeatable, array( 
		'name'	=> esc_html__('Button 1 Icon Style', 'halena' ),
		'id'	=> 'textslider_button1_icon_style',
		'type'	=> 'select',
		'options' => array( 
			'' => esc_html__('Default', 'halena' ), 
			'has-big-btn' => esc_html__('Big Rounded', 'halena' ), 
		),
		'default' => '',
		'attributes' => array(
			'data-conditional-id' => json_encode( array( $textslider_repeatable, 'textslider_button1_icon' ) ),
		)
	) );
	$textslider_slider_options->add_group_field( $textslider_repeatable, array( 
		'name' => esc_html__('Hide Button 1 Text', 'halena' ),
		'desc' => esc_html__('It will hide the button text.', 'halena' ),
		'id' => 'textslider_button1_text_hide',
		'type' => 'checkbox',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => json_encode( array( $textslider_repeatable, 'textslider_button1_icon_style' ) ),
 			//'data-conditional-value' => 'on',
 		),
	) );
	$textslider_slider_options->add_group_field( $textslider_repeatable, array( 
		'name'	=> esc_html__('Button 1 URL', 'halena' ), 
		'desc'	=> esc_html__('button href', 'halena' ), 
		'id'	=> 'textslider_button1_url', 
		'type'	=> 'text_url',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => json_encode( array( $textslider_repeatable, 'textslider_button1' ) ),
 			//'data-conditional-value' => 'on',
 		)
	) );
	
	$textslider_slider_options->add_group_field( $textslider_repeatable, array(
		'name'	=> esc_html__('Button 1 Style', 'halena' ),
		'id'	=> 'textslider_button1_style',
		'type'	=> 'select',
		'options' => array( 
			'default' => esc_html__('Default', 'halena' ), 
			'primary' => esc_html__('Primary', 'halena' ), 
			'accent' => esc_html__('Accent', 'halena' ), 
			'white' => esc_html__('White', 'halena' ), 
		),
		'default' => 'white',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => json_encode( array( $textslider_repeatable, 'textslider_button1' ) ),
 			//'data-conditional-value' => 'on',
 		),
	) );
	$textslider_slider_options->add_group_field( $textslider_repeatable, array( 
		'name'	=> esc_html__('Button 1 Type', 'halena' ),
		'id'	=> 'textslider_button1_type',
		'type'	=> 'radio_inline',
		'options' => array( 
			'btn-normal' => esc_html__('background', 'halena' ), 
			'btn-alt' => esc_html__('Bordered', 'halena' ), 
			'btn-plain' => esc_html__('Plain', 'halena' ), 
		),
		'default' => 'btn-normal',
		'attributes' => array(
			'data-conditional-id' => json_encode( array( $textslider_repeatable, 'textslider_button1' ) ),
		)
	) );
	$textslider_slider_options->add_group_field( $textslider_repeatable, array( 
		'name'	=> esc_html__('Button 1 Radius', 'halena' ), 
		'desc'	=> esc_html__('You can use px, em, %, etc. or enter just number and it will use pixels.', 'halena' ), 
		'id'	=> 'textslider_button1_radius', 
		'type'	=> 'text_small',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => json_encode( array( $textslider_repeatable, 'textslider_button1' ) ),
 			//'data-conditional-value' => 'on',
 		),
	) );
	$textslider_slider_options->add_group_field( $textslider_repeatable, array(
		'name'	=> esc_html__('Button 1 Target', 'halena' ),
		'id'	=> 'textslider_button1_target',
		'type'	=> 'select',
		'options' => array( 
			'_self' => esc_html__('Same Window', 'halena' ), 
			'_blank' => esc_html__('New Window', 'halena' ), 
		),
		'default' => '_self',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => json_encode( array( $textslider_repeatable, 'textslider_button1' ) ),
 			//'data-conditional-value' => 'on',
 		),
	) );
	$textslider_slider_options->add_group_field( $textslider_repeatable, array(
		'name' => esc_html__('Button 1 has Lightbox Video?', 'halena' ),
		'desc' => esc_html__('Checking this for FadeInDown animation.', 'halena' ),
		'id' => 'textslider_button1_lightbox',
		'type' => 'checkbox',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => json_encode( array( $textslider_repeatable, 'textslider_button1' ) ),
 			//'data-conditional-value' => 'on',
 		),
	) );	
	$textslider_slider_options->add_group_field( $textslider_repeatable, array(
		'name'	=> esc_html__('Button 1 Embed code', 'halena' ), 
		'desc'	=> esc_html__('enter the youtube, vimeo or any video embed link. This code will ignore the actual button link', 'halena' ), 
		'id'	=> 'textslider_button1_embed_url', 
		'type'	=> 'textarea_small',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => json_encode( array( $textslider_repeatable, 'textslider_button1_lightbox' ) ),
 			//'data-conditional-value' => 'on',
 		),
		'sanitization_cb' => false
	) );
	$textslider_slider_options->add_group_field( $textslider_repeatable, array( 
		'name'	=> esc_html__('Button 2', 'halena' ), 
		'desc'	=> esc_html__('button 2 info', 'halena' ), 
		'id'	=> 'textslider_button2', 
		'type'	=> 'text_small'
	) );
	$textslider_slider_options->add_group_field( $textslider_repeatable, array( 
		'name'	=> esc_html__('Button 2 Icon', 'halena' ),
		'id'	=> 'textslider_button2_icon',
		'type'	=> 'select',
		'options' => array( 
			'' => esc_html__('No icon', 'halena' ), 
			'icon-arrows-slim-right' => esc_html__('Arrow Right', 'halena' ), 
		),
		'default' => '',
		'attributes' => array(
			'data-conditional-id' => json_encode( array( $textslider_repeatable, 'textslider_button2' ) ),
		)
	) );
	$textslider_slider_options->add_group_field( $textslider_repeatable, array( 
		'name'	=> esc_html__('Button 2 Icon Style', 'halena' ),
		'id'	=> 'textslider_button2_icon_style',
		'type'	=> 'select',
		'options' => array( 
			'' => esc_html__('Default', 'halena' ), 
			'has-big-btn' => esc_html__('Big Rounded', 'halena' ), 
		),
		'default' => '',
		'attributes' => array(
			'data-conditional-id' => json_encode( array( $textslider_repeatable, 'textslider_button2_icon' ) ),
		)
	) );
	$textslider_slider_options->add_group_field( $textslider_repeatable, array( 
		'name' => esc_html__('Hide Button 2 Text', 'halena' ),
		'desc' => esc_html__('It will hide the button text.', 'halena' ),
		'id' => 'textslider_button2_text_hide',
		'type' => 'checkbox',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => json_encode( array( $textslider_repeatable, 'textslider_button2_icon_style' ) ),
 			//'data-conditional-value' => 'on',
 		),
	) );
	$textslider_slider_options->add_group_field( $textslider_repeatable, array( 
		'name'	=> esc_html__('Button 2 URL', 'halena' ), 
		'desc'	=> esc_html__('button href', 'halena' ), 
		'id'	=> 'textslider_button2_url', 
		'type'	=> 'text_url',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => json_encode( array( $textslider_repeatable, 'textslider_button2' ) ),
 			//'data-conditional-value' => 'on',
 		)
	) );
	
	$textslider_slider_options->add_group_field( $textslider_repeatable, array(
		'name'	=> esc_html__('Button 2 Style', 'halena' ),
		'id'	=> 'textslider_button2_style',
		'type'	=> 'select',
		'options' => array( 
			'default' => esc_html__('Default', 'halena' ), 
			'primary' => esc_html__('Primary', 'halena' ), 
			'accent' => esc_html__('Accent', 'halena' ), 
			'white' => esc_html__('White', 'halena' ), 
		),
		'default' => 'white',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => json_encode( array( $textslider_repeatable, 'textslider_button2' ) ),
 			//'data-conditional-value' => 'on',
 		),
	) );
	$textslider_slider_options->add_group_field( $textslider_repeatable, array( 
		'name'	=> esc_html__('Button 2 Type', 'halena' ),
		'id'	=> 'textslider_button2_type',
		'type'	=> 'radio_inline',
		'options' => array( 
			'btn-normal' => esc_html__('background', 'halena' ), 
			'btn-alt' => esc_html__('Bordered', 'halena' ), 
			'btn-plain' => esc_html__('Plain', 'halena' ), 
		),
		'default' => 'btn-normal',
		'attributes' => array(
			'data-conditional-id' => json_encode( array( $textslider_repeatable, 'textslider_button2' ) ),
		)
	) );
	$textslider_slider_options->add_group_field( $textslider_repeatable, array( 
		'name'	=> esc_html__('Button 2 Radius', 'halena' ), 
		'desc'	=> esc_html__('You can use px, em, %, etc. or enter just number and it will use pixels.', 'halena' ), 
		'id'	=> 'textslider_button2_radius', 
		'type'	=> 'text_small',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => json_encode( array( $textslider_repeatable, 'textslider_button2' ) ),
 			//'data-conditional-value' => 'on',
 		),
	) );
	$textslider_slider_options->add_group_field( $textslider_repeatable, array(
		'name'	=> esc_html__('Button 2 Target', 'halena' ),
		'id'	=> 'textslider_button2_target',
		'type'	=> 'select',
		'options' => array( 
			'_self' => esc_html__('Same Window', 'halena' ), 
			'_blank' => esc_html__('New Window', 'halena' ), 
		),
		'default' => '_self',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => json_encode( array( $textslider_repeatable, 'textslider_button2' ) ),
 			//'data-conditional-value' => 'on',
 		),
	) );	
	$textslider_slider_options->add_group_field( $textslider_repeatable, array(
		'name' => esc_html__('Button 2 has Lightbox Video?', 'halena' ),
		'desc' => esc_html__('Checking this for FadeInDown animation.', 'halena' ),
		'id' => 'textslider_button2_lightbox',
		'type' => 'checkbox',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => json_encode( array( $textslider_repeatable, 'textslider_button2' ) ),
 			//'data-conditional-value' => 'on',
 		),
	) );
	$textslider_slider_options->add_group_field( $textslider_repeatable, array(
		'name'	=> esc_html__('Button 2 Embed code', 'halena' ), 
		'desc'	=> esc_html__('enter the youtube, vimeo or any video embed link. This code will ignore the actual button link', 'halena' ), 
		'id'	=> 'textslider_button2_embed_url', 
		'type'	=> 'textarea_small',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => json_encode( array( $textslider_repeatable, 'textslider_button2_lightbox' ) ),
 			//'data-conditional-value' => 'on',
 		),
		'sanitization_cb' => false
	) );

	$textslider_slider_options->add_group_field( $textslider_repeatable, array(
		'name' => esc_html__('Text Animation', 'halena' ),
		'desc' => esc_html__('Checking this for FadeInDown animation.', 'halena' ),
		'id' => 'textslider_animation',
		'type'	=> 'select',
		'options' => array( 
			'' => esc_html__('No Animation', 'halena' ), 
			'fade-in' => esc_html__('fadeIn', 'halena' ), 
			'fade-in-down' => esc_html__('fadeInDown', 'halena' ),
			'fade-in-up' => esc_html__('fadeInUp', 'halena' ),
			'zoom-in' => esc_html__('zoomIn', 'halena' ),
		),
		'default' => '',
	) );

	$textslider_slider_options->add_group_field( $textslider_repeatable, array( 
		'name'	=> esc_html__('Bottom Arrow Icon', 'halena' ),
		'id'	=> 'textslider_arrowicon',
		'type'	=> 'select',
		'options' => array( 
			'' => esc_html__('No icon', 'halena' ), 
			'pe-7s-angle-down' => esc_html__('Angle Down', 'halena' ), 
			'pe-7s-angle-down-circle' => esc_html__('Angle Down Circled', 'halena' ), 
			'ion-ios-arrow-thin-down' => esc_html__('Arrow Down', 'halena' ), 
			'pe-7s-bottom-arrow' => esc_html__('Arrow Down Circled', 'halena' ), 
			'pe-7s-mouse' => esc_html__('Mouse', 'halena' ), 
		),
		'default' => '',
	) );
	$textslider_slider_options->add_group_field( $textslider_repeatable, array(
		'name'	=> esc_html__('Bottom Arrow link', 'halena' ), 
		'id'	=> 'textslider_arrowlink', 
		'type'	=> 'text_url',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => json_encode( array( $textslider_repeatable, 'textslider_arrowicon' ) ),
 			//'data-conditional-value' => 'on',
 		),
	) );
	
	$textslider_slider_options->add_group_field( $textslider_repeatable, array(
		'name'	=> esc_html__('Bottom Arrow Color', 'halena' ), 
		'desc'	=> esc_html__('Choose the color for the bottom arrow', 'halena' ), 
		'id'	=> 'textslider_arrowicon_color', 
		'type'	=> 'colorpicker',
		'attributes' => array(
			//'required' => true, // Will be required only if visible.
			'data-conditional-id' => json_encode( array( $textslider_repeatable, 'textslider_arrowicon' ) ),
		)		
	) );

	$textslider_slider_options->add_group_field( $textslider_repeatable, array(
		'name'	=> esc_html__('Content stretch', 'halena' ), 
		'id'	=> 'textslider_content_choice', 
		'type'	=> 'radio_inline',
		'options' => array( 
			'container' => esc_html__( 'Container', 'halena' ), 
			'container-fluid' => esc_html__( 'Fullwidth', 'halena' ), 
		),
		'default'  => 'container'
	) );

	$textslider_slider_options->add_group_field( $textslider_repeatable, array( 
		'name'	=> esc_html__('Content Width', 'halena' ), 
		'id'	=> 'textslider_content_width', 
		'type'	=> 'text_small',
		'default' => '',
		'row_classes' => 'agni-slide-col agni-slide-height-desktop',
		'before_row' => '<div class="cmb-row agni-slide-row agni-slide-height-container">'
	) );
	$textslider_slider_options->add_group_field( $textslider_repeatable, array( 
		//'name'	=> esc_html__('Content Width', 'halena' ), 
		'id'	=> 'textslider_content_width_tab', 
		'desc'	=> esc_html__('content width for tab', 'halena' ), 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-height-tab',
	) );
	$textslider_slider_options->add_group_field( $textslider_repeatable, array( 
		//'name'	=> esc_html__('Content Width', 'halena' ), 
		'id'	=> 'textslider_content_width_mobile', 
		'desc'	=> esc_html__('content width for mobile', 'halena' ), 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-height-mobile',
		'after_row' => '</div>'
	) );
	
	$textslider_slider_options->add_group_field( $textslider_repeatable, array(
		'name'	=> esc_html__('Content Position', 'halena' ),
		'id'	=> 'textslider_content_position',
		'type'	=> 'select',
		'options' => array( 
			'j-flex-start a-flex-start' => esc_html__('left top', 'halena' ), 
			'j-flex-start a-center' => esc_html__('left center', 'halena' ), 
			'j-flex-start a-flex-end' => esc_html__('left bottom', 'halena' ), 
			'j-flex-end a-flex-start' => esc_html__('right top', 'halena' ), 
			'j-flex-end a-center' => esc_html__('right center', 'halena' ), 
			'j-flex-end a-flex-end' => esc_html__('right bottom', 'halena' ), 
			'j-center a-flex-start' => esc_html__('center top', 'halena' ), 
			'j-center a-center' => esc_html__('center center', 'halena' ), 
			'j-center a-flex-end' => esc_html__('center bottom', 'halena' ),
		),
		'default'  => 'j-flex-start a-center'
	) );

	$textslider_slider_options->add_group_field( $textslider_repeatable, array(
		'name'	=> esc_html__('Content Alignment', 'halena' ),
		'id'	=> 'textslider_text_alignment',
		'type'	=> 'radio_inline',
		'options' => array( 
			'left' => esc_html__( 'Left', 'halena' ), 
			'center' => esc_html__( 'Center', 'halena' ), 
			'right' => esc_html__( 'Right', 'halena' ), 
		),
		'default'  => 'left'
	) );

	$textslider_slider_options->add_group_field( $textslider_repeatable, array(
		'name'	=> esc_html__('Padding Values', 'halena' ), 
		'desc'	=> esc_html__('Padding Top. You can use px, em, %, etc. or enter just number and it will use pixels.', 'halena' ), 
		'id'	=> 'textslider_padding_top', 
		'type'	=> 'text_small',
		'default' => '',
		'row_classes' => 'agni-slide-col agni-slide-padding-top',
		'before_row' => '<div class="cmb-row agni-slide-row agni-slide-padding-container">'
	) );

	$textslider_slider_options->add_group_field( $textslider_repeatable, array(
		//'name'	=> esc_html__('Padding Right', 'halena' ), 
		'desc'	=> esc_html__('Padding Right', 'halena' ), 
		'id'	=> 'textslider_padding_right', 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-right'
		
	) );
	$textslider_slider_options->add_group_field( $textslider_repeatable, array(
		//'name'	=> esc_html__('Padding Bottom', 'halena' ), 
		'desc'	=> esc_html__('Padding Bottom', 'halena' ), 
		'id'	=> 'textslider_padding_bottom', 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-bottom',
	) );
	$textslider_slider_options->add_group_field( $textslider_repeatable, array(
		//'name'	=> esc_html__('Padding Left', 'halena' ), 
		'desc'	=> esc_html__('Padding Left', 'halena' ), 
		'id'	=> 'textslider_padding_left', 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-left',
		'after_row' => '</div>'
	) );
	$textslider_slider_options->add_group_field( $textslider_repeatable, array(
		'name'	=> esc_html__('Padding Values for Tablets', 'halena' ), 
		'desc'	=> esc_html__('Padding Top', 'halena' ), 
		'id'	=> 'textslider_padding_top_tab', 
		'type'	=> 'text_small',
		'default' => '',
		'row_classes' => 'agni-slide-col agni-slide-padding-top',
		'before_row' => '<div class="cmb-row agni-slide-row agni-slide-padding-container">'
	) );

	$textslider_slider_options->add_group_field( $textslider_repeatable, array(
		//'name'	=> esc_html__('Padding Right', 'halena' ), 
		'desc'	=> esc_html__('Padding Right', 'halena' ), 
		'id'	=> 'textslider_padding_right_tab', 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-right'
		
	) );
	$textslider_slider_options->add_group_field( $textslider_repeatable, array(
		//'name'	=> esc_html__('Padding Bottom', 'halena' ), 
		'desc'	=> esc_html__('Padding Bottom', 'halena' ), 
		'id'	=> 'textslider_padding_bottom_tab', 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-bottom',
	) );
	$textslider_slider_options->add_group_field( $textslider_repeatable, array(
		//'name'	=> esc_html__('Padding Left', 'halena' ), 
		'desc'	=> esc_html__('Padding Left', 'halena' ), 
		'id'	=> 'textslider_padding_left_tab', 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-left',
		'after_row' => '</div>'
	) );

	$textslider_slider_options->add_group_field( $textslider_repeatable, array(
		'name'	=> esc_html__('Padding Values for mobile', 'halena' ), 
		'desc'	=> esc_html__('Padding Top', 'halena' ), 
		'id'	=> 'textslider_padding_top_mobile', 
		'type'	=> 'text_small',
		'default' => '',
		'row_classes' => 'agni-slide-col agni-slide-padding-top',
		'before_row' => '<div class="cmb-row agni-slide-row agni-slide-padding-container">'
	) );

	$textslider_slider_options->add_group_field( $textslider_repeatable, array(
		//'name'	=> esc_html__('Padding Right', 'halena' ), 
		'desc'	=> esc_html__('Padding Right', 'halena' ), 
		'id'	=> 'textslider_padding_right_mobile', 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-right'
		
	) );
	$textslider_slider_options->add_group_field( $textslider_repeatable, array(
		//'name'	=> esc_html__('Padding Bottom', 'halena' ), 
		'desc'	=> esc_html__('Padding Bottom', 'halena' ), 
		'id'	=> 'textslider_padding_bottom_mobile', 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-bottom',
	) );
	$textslider_slider_options->add_group_field( $textslider_repeatable, array(
		//'name'	=> esc_html__('Padding Left', 'halena' ), 
		'desc'	=> esc_html__('Padding Left', 'halena' ), 
		'id'	=> 'textslider_padding_left_mobile', 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-left',
		'after_row' => '</div>'
	) );
	

	$textslider_slider_options->add_field( array(
		'name'	=> esc_html__('Background Choice', 'halena' ),
		'id'	=> $prefix.'textslider_bg_choice',
		'type'	=> 'radio_inline',
		'options' => array( 
			'bg_color' => esc_html__('BG Color', 'halena' ), 
			'bg_image' => esc_html__('BG Image', 'halena' ), 
			'bg_video' => esc_html__('BG Video', 'halena' ), 
		),
		'default'  => 'bg_image',
		'before_row' => '<h3>Background Options</h3>'
	) );
	$textslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Background Color', 'halena' ), 
		'id'	=> $prefix.'textslider_bg_color', 
		'type'	=> 'colorpicker',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'textslider_bg_choice' ,
 			'data-conditional-value' => 'bg_color',
 		)
	) );
	$textslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Background Image', 'halena' ), 
		'id'	=> $prefix.'textslider_bg_image', 
		'type'	=> 'file',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'textslider_bg_choice' ,
 			'data-conditional-value' => 'bg_image',
 		)
	) );
	$textslider_slider_options->add_field( array(
		'name'	=> esc_html__('Background Position', 'halena' ),
		'id'	=> $prefix.'textslider_bg_image_position',
		'type'	=> 'select',
		'options' => array( 
			'left top' => esc_html__('left top', 'halena' ), 
			'left center' => esc_html__('left center', 'halena' ), 
			'left bottom' => esc_html__('left bottom', 'halena' ), 
			'right top' => esc_html__('right top', 'halena' ), 
			'right center' => esc_html__('right center', 'halena' ), 
			'right bottom' => esc_html__('right bottom', 'halena' ), 
			'center top' => esc_html__('center top', 'halena' ), 
			'center center' => esc_html__('center center', 'halena' ), 
			'center bottom' => esc_html__('center bottom', 'halena' ), 
		),
		'default' => 'center center',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => $prefix . 'textslider_bg_image' ,
 		),
	) );
	$textslider_slider_options->add_field( array(
		'name'	=> esc_html__('Background Repeat', 'halena' ),
		'id'	=> $prefix.'textslider_bg_image_repeat',
		'type'	=> 'select',
		'options' => array( 
			'repeat' => esc_html__('repeat', 'halena' ), 
			'no-repeat' => esc_html__('no-repeat', 'halena' ), 
		),
		'default' => 'repeat',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => $prefix . 'textslider_bg_image' ,
 		),
	) );
	$textslider_slider_options->add_field( array(
		'name'	=> esc_html__('Background Size', 'halena' ),
		'id'	=> $prefix.'textslider_bg_image_size',
		'type'	=> 'select',
		'options' => array( 
			'cover' => esc_html__('cover', 'halena' ), 
			'auto' => esc_html__('auto', 'halena' ), 
		),
		'default' => 'cover',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => $prefix . 'textslider_bg_image' ,
 		),
	) );
	$textslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Background Video Source', 'halena' ),
		'id'	=> $prefix.'textslider_bg_video_src', 
		'type'	=> 'radio_inline',
		'options' => array( 
			'' => esc_html__('No Source', 'halena' ), 
			'1' => esc_html__('YouTube/Vimeo', 'halena' ), 
			'2' => esc_html__('Selfhosted/Vimeo', 'halena' ), 
		),
		'default' => '',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'textslider_bg_choice' ,
 			'data-conditional-value' => 'bg_video',
 		)
	) );
	$textslider_slider_options->add_field( array(  
		'name'	=> esc_html__('Video URL', 'halena' ), 
		'desc'	=> esc_html__('video url only from youtube or vimeo', 'halena' ), 
		'id'	=> $prefix.'textslider_bg_video_src_yt', 
		'type'	=> 'text_url',
		'attributes' => array(
			//'required' => false, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'textslider_bg_video_src' ,
			'data-conditional-value' => '1',
		)
	) );
	$textslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Fallback image for mobile & tablets', 'halena' ), 
		'id'	=> $prefix.'textslider_bg_video_src_yt_fallback', 
		'type'	=> 'file',
		'attributes' => array(
			'data-conditional-id' => $prefix . 'textslider_bg_video_src_yt' ,
		)
	) );
	$textslider_slider_options->add_field( array(  
		'name'	=> esc_html__('Video URL', 'halena' ), 
		'desc'	=> esc_html__('Choose the media from your local server', 'halena' ), 
		'id'	=> $prefix.'textslider_bg_video_src_sh',
		'type'	=> 'file',
		'attributes' => array(
			'data-conditional-id' => $prefix . 'textslider_bg_video_src' ,
			'data-conditional-value' => '2',
		)
	) );
	
	$textslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Poster URL', 'halena' ), 
		'desc'	=> esc_html__('This poster will be displayed before video get started', 'halena' ),
		'id'	=> $prefix.'textslider_bg_video_src_sh_poster', 
		'type'	=> 'file',
		'attributes' => array(
			'required' => false, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'textslider_bg_video_src_sh' ,
		)
	) );
	$textslider_slider_options->add_field( array(
		'name' => esc_html__('YT Video on Mobile', 'halena' ),
		'desc' => esc_html__('Enable to make youtube video playable on mobile devices.', 'halena' ),
		'id' => $prefix.'textslider_bg_video_src_yt_mobile',
		'type' => 'checkbox',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'textslider_bg_video_src' ,
 			'data-conditional-value' => '1',
 		)
	) );
	$textslider_slider_options->add_field( array(
		'name' => esc_html__('Autoplay', 'halena' ),
		'desc' => esc_html__('Enable to make video autoplay.', 'halena' ),
		'id' => $prefix.'textslider_bg_video_autoplay',
		'type' => 'checkbox',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'textslider_bg_video_src' ,
 			'data-conditional-value' => json_encode(array('1', '2')),
 		)
	) );
	$textslider_slider_options->add_field( array(
		'name' => esc_html__('Loop', 'halena' ),
		'desc' => esc_html__('Enable to make video loop.', 'halena' ),
		'id' => $prefix.'textslider_bg_video_loop',
		'type' => 'checkbox',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'textslider_bg_video_src' ,
 			'data-conditional-value' => json_encode(array('1', '2')),
 		)
	) );
	$textslider_slider_options->add_field( array(
		'name' => esc_html__('Muted', 'halena' ),
		'desc' => esc_html__('Enable to make video quiet.', 'halena' ),
		'id' => $prefix.'textslider_bg_video_muted',
		'type' => 'checkbox',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'textslider_bg_video_src' ,
 			'data-conditional-value' => json_encode(array('1', '2')),
 		)
	) );

	$textslider_slider_options->add_field( array(
		'name'	=> esc_html__('Volumne Level', 'halena' ), 
		'desc'	=> esc_html__('Enter your volume level. it will not applicable if video is muted.', 'halena' ), 
		'id'	=> $prefix.'textslider_bg_video_volume', 
		'type'	=> 'text_small',
		'default' => '50',
		'attributes' => array(
			'type'  => 'number',
			'min'  => '0',
			'max'  => '100',
			'step'  => '1',
			'data-conditional-id'    => $prefix . 'textslider_bg_video_src' ,
			'data-conditional-value' => '1',
		),
	) );

	$textslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Video Quality', 'halena' ),
		'desc'	=> esc_html__('choose your video quality by default.', 'halena' ),
		'id'	=> $prefix.'textslider_bg_video_quality', 
		'type'	=> 'radio_inline',
		'options' => array( 
			'default' => esc_html__('Default', 'halena' ), 
			'hd720' => esc_html__('HD 720p', 'halena' ), 
			'hd1080' => esc_html__('FullHD 1080p', 'halena' ), 
		),
		'default' => 'default',
		'attributes' => array(
 			'data-conditional-id'    => $prefix . 'textslider_bg_video_src' ,
			'data-conditional-value' => '1',
 		)
	) );
	$textslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Video Start at/Stop at', 'halena' ), 
		'desc'	=> esc_html__('Video Start at value', 'halena' ), 
		'id'	=> $prefix.'textslider_bg_video_start_at', 
		'type'	=> 'text_small',
		'default' => '0',
		'attributes' => array(
 			'data-conditional-id'    => $prefix . 'textslider_bg_video_src' ,
			'data-conditional-value' => '1',
 		),
		'row_classes' => 'agni-slide-col agni-slide-height-desktop',
		'before_row' => '<div class="cmb-row agni-slide-row agni-slide-height-container">'
	) );
	$textslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Video Stop At', 'halena' ), 
		'desc'	=> esc_html__('Video Stop at value', 'halena' ), 
		'id'	=> $prefix.'textslider_bg_video_stop_at', 
		'type'	=> 'text_small',
		'default' => '0',
		'attributes' => array(
 			'data-conditional-id'    => $prefix . 'textslider_bg_video_src' ,
			'data-conditional-value' => '1',
 		),
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-height-mobile',
		'after_row' => '</div>'
	) );

	$textslider_slider_options->add_field( array( 
		'name'	=> esc_html__('BG Overlay Choice', 'halena' ),
		'desc'	=> esc_html__('Gradient Map will not work on video bg.', 'halena' ),
		'id'	=> $prefix.'textslider_bg_overlay_choice', 
		'type'	=> 'radio_inline',
		'options' => array( 
			'1' => esc_html__('Simple', 'halena' ), 
			'2' => esc_html__('Simple Gradient', 'halena' ), 
			'3' => esc_html__('Gradient Map(Duotone)', 'halena' ), 
			'4' => esc_html__('No Overlay', 'halena' ), 
		),
		'default' => '4',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'textslider_bg_choice' ,
 			'data-conditional-value' => json_encode( array( 'bg_video','bg_image' ) ),
 		)
	) );
	$textslider_slider_options->add_field( array( 
		'name'	=> esc_html__('BG Overlay Color', 'halena' ), 
		'desc'	=> esc_html__('This layer will be the overlay of the slider.', 'halena' ), 
		'id'	=> $prefix.'textslider_bg_overlay_color', 
		'type'	=> 'rgba_colorpicker',
		'default' => '',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'textslider_bg_overlay_choice' ,
 			'data-conditional-value' => '1',
 		)
	) );
	$textslider_slider_options->add_field( array( 
		'name'	=> esc_html__('BG Gradient Overlay CSS', 'halena' ), 
		'desc'	=> wp_kses( __( 'Get/Type your Gradient CSS. Ref. <a target="_blank" href="http://uigradients.com/">http://uigradients.com/</a> <a target="_blank" href="http://hex2rgba.devoth.com/">HEX to RGBA converter for transparency</a>', 'halena' ), array( 'a' => array( 'href' => array(), 'target' => array() ) ) ),
		'id'	=> $prefix.'textslider_bg_sg_overlay_css', 
		'type'	=> 'textarea_code',
		'default' => '',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'textslider_bg_overlay_choice' ,
 			'data-conditional-value' => '2',
 		)
	) );
	$textslider_slider_options->add_field( array( 
		'name'	=> esc_html__('BG Gradient Map(Duotone) Overlay Color 1', 'halena' ), 
		'desc'	=> wp_kses( __( 'Choose the color for Shadows(Dark pixels). <a target="_blank" href="http://demo.agnidesigns.com/halena/documentation/kb/gradient-map-duotone/">See Presets</a>', 'halena' ), array( 'a' => array( 'href' => array(), 'target' => array() ) ) ),
		'id'	=> $prefix.'textslider_bg_gm_overlay_color1', 
		'type'	=> 'colorpicker',
		'default' => '',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'textslider_bg_overlay_choice' ,
 			'data-conditional-value' => '3',
 		)
	) );
	$textslider_slider_options->add_field( array( 
		'name'	=> esc_html__('BG Gradient Map(Duotone) Overlay Color 2', 'halena' ), 
		'desc'	=> esc_html__('Choose the mid-tone color. You can leave this empty for no mid-tone.', 'halena' ), 
		'id'	=> $prefix.'textslider_bg_gm_overlay_color2', 
		'type'	=> 'colorpicker',
		'default' => '',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'textslider_bg_overlay_choice' ,
 			'data-conditional-value' => '3',
 		)
	) );
	$textslider_slider_options->add_field( array( 
		'name'	=> esc_html__('BG Gradient Map(Duotone) Overlay Color 3', 'halena' ), 
		'desc'	=> esc_html__('Choose the color for Highlights(White pixels).', 'halena' ), 
		'id'	=> $prefix.'textslider_bg_gm_overlay_color3', 
		'type'	=> 'colorpicker',
		'default' => '',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'textslider_bg_overlay_choice',
 			'data-conditional-value' => '3',
 		)
	) );

	$textslider_slider_options->add_field( array( 
		'name' => esc_html__('Particle Ground', 'halena' ),
		'desc' => esc_html__('It will enable the particles for the background.', 'halena' ),
		'id' => $prefix . 'textslider_bg_particle_ground',
		'type' => 'checkbox',
	) );
	$textslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Particle Ground Color', 'halena' ), 
		'desc'	=> esc_html__('Choose the color and transparency for the particle ground.', 'halena' ), 
		'id'	=> $prefix.'textslider_bg_particle_ground_color', 
		'type'	=> 'rgba_colorpicker',
		'default' => '',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'textslider_bg_particle_ground',
 		)
	) );

	$textslider_slider_options->add_field( array(
		'name'	=> esc_html__('Slider Choice', 'halena' ),
		'id'	=> $prefix.'textslider_choice',
		'type'	=> 'radio_inline',
		'options' => array( 
			'1' => esc_html__('Full Height(100%)', 'halena' ), 
			'2' => esc_html__('Custom Height', 'halena' ), 
		),
		'default' => '1',
		'before_row' => '<h3>Basic Options</h3>'
	) );
	$textslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Slider Height', 'halena' ), 
		'desc'	=> esc_html__('Enter your slider height, don\'t include "px" string', 'halena' ), 
		'id'	=> $prefix.'textslider_height', 
		'type'	=> 'text_small',
		'default' => '600',
		'attributes' => array(
			'required' => false, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'textslider_choice',
			'data-conditional-value' => '2',
		),
		'row_classes' => 'agni-slide-col agni-slide-height-desktop',
		'before_row' => '<div class="cmb-row agni-slide-row agni-slide-height-container">'
	) );
	$textslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Slider Height(Tablet devices)', 'halena' ), 
		'desc'	=> esc_html__('Height on Tablets', 'halena' ), 
		'id'	=> $prefix.'textslider_height_tab', 
		'type'	=> 'text_small',
		'default' => '480',
		'attributes' => array(
			'required' => false, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'textslider_choice',
			'data-conditional-value' => '2',
		),
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-height-tab',
	) );
	$textslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Slider Height(Mobile devices)', 'halena' ), 
		'desc'	=> esc_html__('Height on Mobiles', 'halena' ), 
		'id'	=> $prefix.'textslider_height_mobile', 
		'type'	=> 'text_small',
		'default' => '360',
		'attributes' => array(
			'required' => false, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'textslider_choice',
			'data-conditional-value' => '2',
		),
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-height-mobile',
		'after_row' => '</div>'
	) );

	$textslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Margin Values', 'halena' ), 
		'desc'	=> esc_html__('margin top value for the slider. You can use px, em, %, etc. or enter just number and it will use pixels.', 'halena' ), 
		'id'	=> $prefix.'textslider_margin_top', 
		'type'	=> 'text_small',
		'default' => '',
		'row_classes' => 'agni-slide-col agni-slide-padding-top',
		'before_row' => '<div class="cmb-row agni-slide-row agni-slide-padding-container">'
	) );
	$textslider_slider_options->add_field( array( 
		//'name'	=> esc_html__('Margin Values', 'halena' ), 
		'desc'	=> esc_html__('margin right value', 'halena' ), 
		'id'	=> $prefix.'textslider_margin_right', 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-right'
	) );
	$textslider_slider_options->add_field( array( 
		//'name'	=> esc_html__('Margin Values', 'halena' ), 
		'desc'	=> esc_html__('margin bottom value', 'halena' ), 
		'id'	=> $prefix.'textslider_margin_bottom', 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-bottom'
	) );
	$textslider_slider_options->add_field( array( 
		//'name'	=> esc_html__('Margin Values', 'halena' ), 
		'desc'	=> esc_html__('margin left value', 'halena' ), 
		'id'	=> $prefix.'textslider_margin_left', 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-left',
		'after_row' => '</div>'
	) );
	$textslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Margin Values for Tablets', 'halena' ), 
		'desc'	=> esc_html__('margin top value', 'halena' ), 
		'id'	=> $prefix.'textslider_margin_top_tab', 
		'type'	=> 'text_small',
		'default' => '',
		'row_classes' => 'agni-slide-col agni-slide-padding-top',
		'before_row' => '<div class="cmb-row agni-slide-row agni-slide-padding-container">'
	) );
	$textslider_slider_options->add_field( array( 
		//'name'	=> esc_html__('Margin Values', 'halena' ), 
		'desc'	=> esc_html__('margin right value', 'halena' ), 
		'id'	=> $prefix.'textslider_margin_right_tab', 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-right'
	) );
	$textslider_slider_options->add_field( array( 
		//'name'	=> esc_html__('Margin Values', 'halena' ), 
		'desc'	=> esc_html__('margin bottom value', 'halena' ), 
		'id'	=> $prefix.'textslider_margin_bottom_tab', 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-bottom'
	) );
	$textslider_slider_options->add_field( array( 
		//'name'	=> esc_html__('Margin Values', 'halena' ), 
		'desc'	=> esc_html__('margin left value', 'halena' ), 
		'id'	=> $prefix.'textslider_margin_left_tab', 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-left',
		'after_row' => '</div>'
	) );
	$textslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Margin Values for Mobile', 'halena' ), 
		'desc'	=> esc_html__('margin top value', 'halena' ), 
		'id'	=> $prefix.'textslider_margin_top_mobile', 
		'type'	=> 'text_small',
		'default' => '',
		'row_classes' => 'agni-slide-col agni-slide-padding-top',
		'before_row' => '<div class="cmb-row agni-slide-row agni-slide-padding-container">'
	) );
	$textslider_slider_options->add_field( array( 
		//'name'	=> esc_html__('Margin Values', 'halena' ), 
		'desc'	=> esc_html__('margin right value', 'halena' ), 
		'id'	=> $prefix.'textslider_margin_right_mobile', 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-right'
	) );
	$textslider_slider_options->add_field( array( 
		//'name'	=> esc_html__('Margin Values', 'halena' ), 
		'desc'	=> esc_html__('margin bottom value', 'halena' ), 
		'id'	=> $prefix.'textslider_margin_bottom_mobile', 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-bottom'
	) );
	$textslider_slider_options->add_field( array( 
		//'name'	=> esc_html__('Margin Values', 'halena' ), 
		'desc'	=> esc_html__('margin left value', 'halena' ), 
		'id'	=> $prefix.'textslider_margin_left_mobile', 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-left',
		'after_row' => '</div>'
	) );

	$textslider_slider_options->add_field( array(
		'name' => esc_html__('Parallax', 'halena' ),
		'desc' => esc_html__('Check this to enable parallax, its purely based on skrollr.', 'halena' ),
		'id' => $prefix.'textslider_parallax',
		'type' => 'checkbox',
	) );
	$textslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Parallax Value', 'halena' ), 
		'desc'	=> esc_html__('Enter the css property for the slider\'s top at the top of the screen. for eg.transform:translateY(0px); if don\'t want parallax just leave this empty', 'halena' ), 
		'id'	=> $prefix.'textslider_parallax_start', 
		'type'	=> 'textarea_small',
		'default'  => 'transform:translateY(0px);',
		'attributes' => array(
	        'rows'        => 2,
	        'placeholder' => 'Parallax Starting Value',
			'required' => false, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'textslider_parallax',
		),
		'row_classes' => 'agni-slide-col agni-slide-parallax-start',
		'before_row' => '<div class="cmb-row agni-slide-row agni-slide-parallax-container">'
	) );
	
	$textslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Parallax End Value', 'halena' ), 
		'desc'	=> esc_html__('Enter the css property for the slider\'s bottom when at the top of the screen. for eg.transform:translateY(600px); if don\'t want parallax just leave this empty', 'halena' ), 
		'id'	=> $prefix.'textslider_parallax_end', 
		'type'	=> 'textarea_small',
		'default'  => 'transform:translateY(600px);',
		'attributes' => array(
			'rows'        => 2,
			'placeholder' => 'Parallax End Value',
			'required' => false, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'textslider_parallax',
		),
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-parallax-end',
		'after_row' => '</div>'
	) );
	$textslider_slider_options->add_field( array(
		'name'	=> esc_html__('Autoplay', 'halena' ),
		'id'	=> $prefix.'textslider_autoplay',
		'type'	=> 'checkbox',
	) );
	$textslider_slider_options->add_field( array(
		'name'	=> esc_html__('Autoplay Speed', 'halena' ), 
		'desc'	=> esc_html__('Enter your transition duration in ms.', 'halena' ), 
		'id'	=> $prefix.'textslider_transition_duration', 
		'type'	=> 'text_small',
		'default' => '6000',
		'attributes' => array(
			'type'  => 'number',
			'min'  => '3000',
			'max'  => '20000',
			'step'  => '100',
			'required' => false, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'textslider_autoplay',
			'data-conditional-value' => 'on',
		),
	) );

	$textslider_slider_options->add_field( array(
		'name'	=> esc_html__('Transition Speed', 'halena' ), 
		'desc'	=> esc_html__('Enter your transition speed in ms.', 'halena' ), 
		'id'	=> $prefix.'textslider_transition_speed', 
		'type'	=> 'text_small',
		'default' => '400',
		'attributes' => array(
			'type'  => 'number',
			'min'  => '100',
			'max'  => '1200',
			'step'  => '10'
		),
	) );


	$textslider_slider_options->add_field( array(
		'name'	=> esc_html__('Loop', 'halena' ),
		'id'	=> $prefix.'textslider_loop',
		'type'	=> 'checkbox',
	) );

	$textslider_slider_options->add_field( array(
		'name'	=> esc_html__('Slide Animation', 'halena' ),
		'id'	=> $prefix.'textslider_slide_animation',
		'type'	=> 'select',
		'options' => array( 
			'fade' => esc_html__('Fade', 'halena' ), 
			'slide' => esc_html__('Slide', 'halena' ),
		),
		'default' => 'slide',
	) );

	$textslider_slider_options->add_field( array(
		'name'	=> esc_html__('Navigation Arrows', 'halena' ),
		'id'	=> $prefix.'textslider_navigation',
		'type'	=> 'checkbox',
	) );
	$textslider_slider_options->add_field( array(
		'name'	=> esc_html__('Nav Prev Text', 'halena' ), 
		'desc'	=> esc_html__('Enter your text/label for Previous. for ex. Previous', 'halena' ), 
		'id'	=> $prefix.'textslider_navigation_prev', 
		'type'	=> 'text_small',
		'attributes' => array(
			'required' => false, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'textslider_navigation',
		),
		'sanitization_cb' => false,
		'default' => 'Previous',
	) );
	$textslider_slider_options->add_field( array(
		'name'	=> esc_html__('Nav next Text', 'halena' ), 
		'desc'	=> esc_html__('Enter your text/label for next. for ex. Next', 'halena' ), 
		'id'	=> $prefix.'textslider_navigation_next', 
		'type'	=> 'text_small',
		'attributes' => array(
			'required' => false, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'textslider_navigation',
		),
		'sanitization_cb' => false,
		'default' => 'Next ',
	) );
	$textslider_slider_options->add_field( array(
		'name'	=> esc_html__('Pagination Dots', 'halena' ),
		'id'	=> $prefix.'textslider_pagination',
		'type'	=> 'checkbox',
	) );
	$textslider_slider_options->add_field( array(
		'name'	=> esc_html__('Mouse Drag', 'halena' ),
		'id'	=> $prefix.'textslider_mousedrag',
		'type'	=> 'checkbox',
	) );

	// Image Slider
	$imageslider_slider_options = new_cmb2_box( array(
		'id'            => $prefix . 'imageslider_options',
		'title'         => esc_html__( 'Background Slider Options', 'halena' ),
		'object_types'  => array( 'agni_slides' ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
	) );
	
	
	// $group_field_id is the field id string, so in this case: $prefix . 'demo'
	$imageslider_repeatable = $imageslider_slider_options->add_field( array(
		'id'          => $prefix . 'imageslider_repeatable',
		'type'        => 'group',
		'options'     => array(
			'group_title'   => esc_html__( 'Slide {#}', 'halena' ), // {#} gets replaced by row number
			'add_button'    => esc_html__( 'Add another Slide', 'halena' ),
			'remove_button' => esc_html__( 'Remove Slide', 'halena' ),
			'sortable'      => true, // beta
		),
	) );

	$imageslider_slider_options->add_group_field( $imageslider_repeatable, array(
		'name'	=> esc_html__('Background Choice', 'halena' ),
		'id'	=> 'imageslider_bg_choice',
		'type'	=> 'radio_inline',
		'options' => array( 
			'bg_color' => esc_html__('BG Color', 'halena' ), 
			'bg_image' => esc_html__('BG Image', 'halena' ), 
		),
		'default'  => 'bg_image',
		'before_row' => '<h3>Background Options</h3>'
	) );
	$imageslider_slider_options->add_group_field( $imageslider_repeatable, array( 
		'name'	=> esc_html__('Background Color', 'halena' ), 
		'id'	=> 'imageslider_bg_color', 
		'type'	=> 'colorpicker',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $imageslider_repeatable, 'imageslider_bg_choice' ) ),
 			'data-conditional-value' => 'bg_color',
 		)
	) );
	$imageslider_slider_options->add_group_field( $imageslider_repeatable, array( 
		'name'	=> esc_html__('Background Image', 'halena' ), 
		'id'	=> 'imageslider_bg_image', 
		'type'	=> 'file',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $imageslider_repeatable, 'imageslider_bg_choice' ) ),
 			'data-conditional-value' => 'bg_image',
 		)
	) );
	$imageslider_slider_options->add_group_field( $imageslider_repeatable, array(
		'name'	=> esc_html__('Background Position', 'halena' ),
		'id'	=> 'imageslider_bg_image_position',
		'type'	=> 'select',
		'options' => array( 
			'left top' => esc_html__('left top', 'halena' ), 
			'left center' => esc_html__('left center', 'halena' ), 
			'left bottom' => esc_html__('left bottom', 'halena' ), 
			'right top' => esc_html__('right top', 'halena' ), 
			'right center' => esc_html__('right center', 'halena' ), 
			'right bottom' => esc_html__('right bottom', 'halena' ), 
			'center top' => esc_html__('center top', 'halena' ), 
			'center center' => esc_html__('center center', 'halena' ), 
			'center bottom' => esc_html__('center bottom', 'halena' ), 
		),
		'default' => 'center center',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => json_encode( array( $imageslider_repeatable, 'imageslider_bg_image' ) ),
 		),
	) );
	$imageslider_slider_options->add_group_field( $imageslider_repeatable, array(
		'name'	=> esc_html__('Background Repeat', 'halena' ),
		'id'	=> 'imageslider_bg_image_repeat',
		'type'	=> 'select',
		'options' => array( 
			'repeat' => esc_html__('repeat', 'halena' ), 
			'no-repeat' => esc_html__('no-repeat', 'halena' ), 
		),
		'default' => 'repeat',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => json_encode( array( $imageslider_repeatable, 'imageslider_bg_image' ) ),
 		),
	) );
	$imageslider_slider_options->add_group_field( $imageslider_repeatable, array(
		'name'	=> esc_html__('Background Size', 'halena' ),
		'id'	=> 'imageslider_bg_image_size',
		'type'	=> 'select',
		'options' => array( 
			'cover' => esc_html__('cover', 'halena' ), 
			'auto' => esc_html__('auto', 'halena' ), 
		),
		'default' => 'cover',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => json_encode( array( $imageslider_repeatable, 'imageslider_bg_image' ) ),
 		),
	) );

	$imageslider_slider_options->add_group_field( $imageslider_repeatable, array( 
		'name'	=> esc_html__('BG Overlay Choice', 'halena' ),
		'id'	=> 'imageslider_bg_overlay_choice', 
		'type'	=> 'radio_inline',
		'options' => array( 
			'1' => esc_html__('Simple', 'halena' ), 
			'2' => esc_html__('Simple Gradient', 'halena' ), 
			'3' => esc_html__('Gradient Map(Duotone)', 'halena' ), 
			'4' => esc_html__('No Overlay', 'halena' ), 
		),
		'default' => '4',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $imageslider_repeatable, 'imageslider_bg_choice' ) ),
 			'data-conditional-value' => json_encode( array( 'bg_video','bg_image' ) ),
 		)
	) );
	$imageslider_slider_options->add_group_field( $imageslider_repeatable, array( 
		'name'	=> esc_html__('BG Overlay Color', 'halena' ), 
		'desc'	=> esc_html__('This layer will be the overlay of the slider.', 'halena' ), 
		'id'	=> 'imageslider_bg_overlay_color', 
		'type'	=> 'rgba_colorpicker',
		'default' => '',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $imageslider_repeatable, 'imageslider_bg_overlay_choice' ) ),
 			'data-conditional-value' => '1',
 		)
	) );
	$imageslider_slider_options->add_group_field( $imageslider_repeatable, array( 
		'name'	=> esc_html__('BG Gradient Overlay CSS', 'halena' ), 
		'desc'	=> wp_kses( __( 'Get/Type your Gradient CSS. Ref. <a target="_blank" href="http://uigradients.com/">http://uigradients.com/</a> <a target="_blank" href="http://hex2rgba.devoth.com/">HEX to RGBA converter for transparency</a>', 'halena' ), array( 'a' => array( 'href' => array(), 'target' => array() ) ) ),
		'id'	=> 'imageslider_bg_sg_overlay_css', 
		'type'	=> 'textarea_code',
		'default' => '',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $imageslider_repeatable, 'imageslider_bg_overlay_choice' ) ),
 			'data-conditional-value' => '2',
 		)
	) );
	$imageslider_slider_options->add_group_field( $imageslider_repeatable, array( 
		'name'	=> esc_html__('BG Gradient Map(Duotone) Overlay Color 1', 'halena' ), 
		'desc'	=> wp_kses( __( 'Choose the color for Shadows(Dark pixels). <a target="_blank" href="http://demo.agnidesigns.com/halena/documentation/kb/gradient-map-duotone/">See Presets</a>', 'halena' ), array( 'a' => array( 'href' => array(), 'target' => array() ) ) ),
		'id'	=> 'imageslider_bg_gm_overlay_color1', 
		'type'	=> 'colorpicker',
		'default' => '',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $imageslider_repeatable, 'imageslider_bg_overlay_choice' ) ),
 			'data-conditional-value' => '3',
 		)
	) );
	$imageslider_slider_options->add_group_field( $imageslider_repeatable, array( 
		'name'	=> esc_html__('BG Gradient Map(Duotone) Overlay Color 2', 'halena' ), 
		'desc'	=> esc_html__('Choose the mid-tone color. You can leave this empty for no mid-tone.', 'halena' ), 
		'id'	=> 'imageslider_bg_gm_overlay_color2', 
		'type'	=> 'colorpicker',
		'default' => '',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $imageslider_repeatable, 'imageslider_bg_overlay_choice' ) ),
 			'data-conditional-value' => '3',
 		)
	) );
	$imageslider_slider_options->add_group_field( $imageslider_repeatable, array( 
		'name'	=> esc_html__('BG Gradient Map(Duotone) Overlay Color 3', 'halena' ), 
		'desc'	=> esc_html__('Choose the color for Highlights(White pixels).', 'halena' ), 
		'id'	=> 'imageslider_bg_gm_overlay_color3', 
		'type'	=> 'colorpicker',
		'default' => '',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $imageslider_repeatable, 'imageslider_bg_overlay_choice' ) ),
 			'data-conditional-value' => '3',
 		)
	) );

	$imageslider_slider_options->add_group_field( $imageslider_repeatable, array( 
		'name' => esc_html__('Particle Ground', 'halena' ),
		'desc' => esc_html__('It will enable the particles for the background.', 'halena' ),
		'id' => 'imageslider_bg_particle_ground',
		'type' => 'checkbox',
	) );
	$imageslider_slider_options->add_group_field( $imageslider_repeatable, array( 
		'name'	=> esc_html__('Particle Ground Color', 'halena' ), 
		'desc'	=> esc_html__('Choose the color and transparency for the particle ground.', 'halena' ), 
		'id'	=> 'imageslider_bg_particle_ground_color', 
		'type'	=> 'rgba_colorpicker',
		'default' => '',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $imageslider_repeatable, 'imageslider_bg_particle_ground' ) ),
 		)
	) );

	$imageslider_slider_options->add_field( array( 
        'name'  => esc_html__('Image', 'halena' ), 
        'id'    => $prefix.'imageslider_image', 
        'type'  => 'file',
        'before_row' => '<h3>Content Options</h3>'
    ) );
    $imageslider_slider_options->add_field( array( 
        'name'  => esc_html__('Max Image width', 'halena' ), 
        'desc'  => esc_html__('Enter your image width, don\'t include "px" string', 'halena' ), 
        'id'    => $prefix.'imageslider_image_size', 
        'type'  => 'text_small',
        'default' => '240',
        'attributes' => array(
            'type'  => 'number',
            'min'  => '100',
            'max'  => '1000',
            'step'  => '5',
            //'required' => true,
            'data-conditional-id'    => $prefix .'imageslider_image',
            //'data-conditional-id'    => 'agni_slides_repeatable[{#}][title]',
        ),
        'row_classes' => 'agni-slide-col agni-slide-height-desktop',
        'before_row' => '<div class="cmb-row agni-slide-row agni-slide-height-container">'
    ) );
    $imageslider_slider_options->add_field( array( 
        'name'  => esc_html__('Max Image width', 'halena' ), 
        'desc'  => esc_html__('Enter your image width for tablets', 'halena' ), 
        'id'    => $prefix.'imageslider_image_size_tab', 
        'type'  => 'text_small',
        'default' => '160',
        'attributes' => array(
            'type'  => 'number',
            'min'  => '40',
            'max'  => '700',
            'step'  => '5',
            //'required' => true,
            'data-conditional-id'    => $prefix .'imageslider_image',
            //'data-conditional-id'    => 'agni_slides_repeatable[{#}][title]',
        ),
        'show_names' => false,
        'row_classes' => 'agni-slide-col agni-slide-height-tab',
    ) );
    $imageslider_slider_options->add_field( array( 
        'name'  => esc_html__('Max Image width', 'halena' ), 
        'desc'  => esc_html__('Enter your image width for mobiles', 'halena' ), 
        'id'    => $prefix.'imageslider_image_size_mobile', 
        'type'  => 'text_small',
        'default' => '100',
        'attributes' => array(
            'type'  => 'number',
            'min'  => '20',
            'max'  => '300',
            'step'  => '5',
            //'required' => true,
            'data-conditional-id'    => $prefix .'imageslider_image',
            //'data-conditional-id'    => 'agni_slides_repeatable[{#}][title]',
        ),
        'show_names' => false,
        'row_classes' => 'agni-slide-col agni-slide-height-mobile',
        'after_row' => '</div>'
    ) );
	$imageslider_slider_options->add_field( array(
		'name' => esc_html__('Title', 'halena' ),
		'desc' => esc_html__('To use a text effect. Add the texts with delimiter "|" inside <span> tag. For ex. Hello, <span>This is|Sample|Text</span>', 'halena' ),
		'id' => $prefix . 'imageslider_title',
		'type' => 'text',
		'sanitization_cb' => false,
	) );
	$imageslider_slider_options->add_field( array(
		'name' => esc_html__('Title Rotator', 'halena' ),
		'desc' => esc_html__('Check this for Title rotator. it enables the text effects to the title.', 'halena' ),
		'id' => $prefix . 'imageslider_title_rotator',
		'type' => 'checkbox',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix .'imageslider_title',
		),
	) );
	$imageslider_slider_options->add_field( array(
		'name'	=> esc_html__('Choose Rotator Effect', 'halena' ),
		'id'	=> $prefix . 'imageslider_title_rotator_choice',
		'type'	=> 'select',
		'options' => array( 
			'type letters' => esc_html__('Type', 'halena' ), 
			'zoom' => esc_html__('Zoom', 'halena' ), 
		),
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix .'imageslider_title_rotator',
		),
		'default'  => 'scale letters'
	) );
	$imageslider_slider_options->add_field( array(
		'name' => esc_html__('Title Font', 'halena' ),
		'desc' => esc_html__('It will apply the font to the Title which you choose at "Halena/Theme Options/General Settings/Typography".', 'halena' ),
		'id' => $prefix . 'imageslider_title_font',
		'type' => 'select',
		'options' => array( 
			'primary-typo' => esc_html__('Primary Font', 'halena' ), 
			'default-typo' => esc_html__('Default Font', 'halena' ), 
			'additional-typo' => esc_html__('Additional Font', 'halena' ), 
			'special-typo' => esc_html__('Special Font', 'halena' ), 
		),
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'imageslider_title',
		),
		'default' => 'primary-typo',
	) );
	$imageslider_slider_options->add_field( array(
		'name'	=> esc_html__('Title Font Size', 'halena' ), 
		'desc'	=> esc_html__('Enter your title font size, don\'t include "px" string', 'halena' ), 
		'id'	=> $prefix . 'imageslider_title_size', 
		'type'	=> 'text_small',
		'default' => '',
		'attributes' => array(
			'type'  => 'number',
			'min'  => '30',
			'max'  => '200',
			'step'  => '1',
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'imageslider_title',
 			//'data-conditional-id'    => 'agni_slides_imageslider_repeatable[{#}][imageslider_title]',
		),
	) );
	$imageslider_slider_options->add_field( array(
		'name'	=> esc_html__('Title Color', 'halena' ), 
		'desc'	=> esc_html__('Choose the color for title', 'halena' ), 
		'id'	=> $prefix . 'imageslider_title_color', 
		'type'	=> 'colorpicker',
		'default' => '#f0f0f0',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'imageslider_title',
 			//'data-conditional-id'    => 'agni_slides_imageslider_repeatable[{#}][imageslider_title]',
 		)
	) );

	$imageslider_slider_options->add_field( array(
		'name'	=> esc_html__('Title Margin Bottom', 'halena' ), 
		'desc'	=> esc_html__('Enter the bottom margin for the title.', 'halena' ), 
		'id'	=> $prefix . 'imageslider_title_bottom', 
		'type'	=> 'text_small',
		'default' => '30',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'imageslider_title',
 			//'data-conditional-id'    => 'agni_slides_imageslider_repeatable[{#}][imageslider_title]',
 		)
	) );
	$imageslider_slider_options->add_field( array(
		'name' => esc_html__('Description', 'halena' ),
		'id' => $prefix . 'imageslider_desc',
		'type' => 'textarea_small',
		'sanitization_cb' => false,
		'attributes'  => array(
	        'placeholder' => 'A small amount of text',
	        'rows'        => 2,
	    ),
	) );
	$imageslider_slider_options->add_field( array(
		'name' => esc_html__('Description Font', 'halena' ),
		'desc' => esc_html__('It will apply the font to the Description which you choose at "Halena/Theme Options/General Settings/Typography".', 'halena' ),
		'id' => $prefix . 'imageslider_desc_font',
		'type' => 'select',
		'options' => array( 
			'primary-typo' => esc_html__('Primary Font', 'halena' ), 
			'default-typo' => esc_html__('Default Font', 'halena' ), 
			'additional-typo' => esc_html__('Additional Font', 'halena' ), 
			'special-typo' => esc_html__('Special Font', 'halena' ), 
		),
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'imageslider_desc',
		),
		'default' => 'default-typo',
	) );
	$imageslider_slider_options->add_field( array(
		'name'	=> esc_html__('Description Font Size', 'halena' ), 
		'desc'	=> esc_html__('Enter your title font size, don\'t include "px" string', 'halena' ), 
		'id'	=> $prefix . 'imageslider_desc_size', 
		'type'	=> 'text_small',
		'default' => '',
		'attributes' => array(
			'type'  => 'number',
			'min'  => '15',
			'max'  => '60',
			'step'  => '1',
			//'required' => true,
 			'data-conditional-id'    => $prefix . 'imageslider_desc',
 			//'data-conditional-id'    => 'agni_slides_imageslider_repeatable[{#}][imageslider_title]',
		),
	) );
	$imageslider_slider_options->add_field( array(
		'name'	=> esc_html__('Description Color ', 'halena' ), 
		'desc'	=> esc_html__('choose the description color', 'halena' ), 
		'id'	=> $prefix . 'imageslider_desc_color', 
		'type'	=> 'colorpicker',
		'default' => '#f0f0f0',
		'attributes' => array(
 			'data-conditional-id'    => $prefix . 'imageslider_desc',
 		)
	) );
	$imageslider_slider_options->add_field( array(
		'name'	=> esc_html__('Description Margin Bottom', 'halena' ), 
		'desc'	=> esc_html__('Enter the bottom margin for the description.', 'halena' ), 
		'id'	=> $prefix . 'imageslider_description_bottom', 
		'type'	=> 'text_small',
		'default' => '30',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'imageslider_description',
 			//'data-conditional-id'    => 'agni_slides_imageslider_repeatable[{#}][imageslider_title]',
 		)
	) );

	$imageslider_slider_options->add_field( array(
		'name' => esc_html__('Divide Line', 'halena' ),
		'desc' => esc_html__('Checking this for FadeInUp animation.', 'halena' ),
		'id' => $prefix . 'imageslider_line',
		'type' => 'checkbox',
	) );
	$imageslider_slider_options->add_field( array(
		'name'	=> esc_html__('Divide Line Color ', 'halena' ), 
		'desc'	=> esc_html__('choose the description color', 'halena' ), 
		'id'	=> $prefix . 'imageslider_line_color', 
		'type'	=> 'colorpicker',
		'default' => '#f0f0f0',
		'attributes' => array(
 			'data-conditional-id'    => $prefix . 'imageslider_line',
 		)
	) );
	$imageslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Button 1', 'halena' ), 
		'desc'	=> esc_html__('button 1 info', 'halena' ), 
		'id'	=> $prefix . 'imageslider_button1', 
		'type'	=> 'text_small'
	) );
	$imageslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Button 1 Icon', 'halena' ),
		'id'	=> $prefix . 'imageslider_button1_icon',
		'type'	=> 'select',
		'options' => array( 
			'' => esc_html__('No icon', 'halena' ), 
			'icon-arrows-slim-right' => esc_html__('Arrow Right', 'halena' ), 
		),
		'default' => '',
		'attributes' => array(
			'data-conditional-id' => $prefix . 'imageslider_button1',
		)
	) );
	$imageslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Button 1 Icon Style', 'halena' ),
		'id'	=> $prefix . 'imageslider_button1_icon_style',
		'type'	=> 'select',
		'options' => array( 
			'' => esc_html__('Default', 'halena' ), 
			'has-big-btn' => esc_html__('Big Rounded', 'halena' ), 
		),
		'default' => '',
		'attributes' => array(
			'data-conditional-id' => $prefix .'imageslider_button1_icon',
		)
	) );
	$imageslider_slider_options->add_field( array( 
		'name' => esc_html__('Hide Button 1 Text', 'halena' ),
		'desc' => esc_html__('It will hide the button text.', 'halena' ),
		'id' => $prefix . 'imageslider_button1_text_hide',
		'type' => 'checkbox',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => $prefix .'imageslider_button1_icon_style',
 			//'data-conditional-value' => 'on',
 		),
	) );
	$imageslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Button 1 URL', 'halena' ), 
		'desc'	=> esc_html__('button href', 'halena' ), 
		'id'	=> $prefix . 'imageslider_button1_url', 
		'type'	=> 'text_url',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => $prefix . 'imageslider_button1',
 			//'data-conditional-value' => 'on',
 		)
	) );
	
	$imageslider_slider_options->add_field( array(
		'name'	=> esc_html__('Button 1 Style', 'halena' ),
		'id'	=> $prefix . 'imageslider_button1_style',
		'type'	=> 'select',
		'options' => array( 
			'default' => esc_html__('Default', 'halena' ), 
			'primary' => esc_html__('Primary', 'halena' ), 
			'accent' => esc_html__('Accent', 'halena' ), 
			'white' => esc_html__('White', 'halena' ), 
		),
		'default' => 'white',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => $prefix . 'imageslider_button1',
 			//'data-conditional-value' => 'on',
 		),
	) );
	$imageslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Button 1 Type', 'halena' ),
		'id'	=> $prefix . 'imageslider_button1_type',
		'type'	=> 'radio_inline',
		'options' => array( 
			'btn-normal' => esc_html__('background', 'halena' ), 
			'btn-alt' => esc_html__('Bordered', 'halena' ), 
			'btn-plain' => esc_html__('Plain', 'halena' ), 
		),
		'default' => 'btn-normal',
		'attributes' => array(
			'data-conditional-id' => $prefix . 'imageslider_button1',
		)
	) );
	$imageslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Button 1 Radius', 'halena' ), 
		'desc'	=> esc_html__('You can use px, em, %, etc. or enter just number and it will use pixels.', 'halena' ), 
		'id'	=> $prefix . 'imageslider_button1_radius', 
		'type'	=> 'text_small',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => $prefix . 'imageslider_button1',
 			//'data-conditional-value' => 'on',
 		),
	) );
	$imageslider_slider_options->add_field( array(
		'name'	=> esc_html__('Button 1 Target', 'halena' ),
		'id'	=> $prefix . 'imageslider_button1_target',
		'type'	=> 'select',
		'options' => array( 
			'_self' => esc_html__('Same Window', 'halena' ), 
			'_blank' => esc_html__('New Window', 'halena' ), 
		),
		'default' => '_self',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => $prefix . 'imageslider_button1',
 			//'data-conditional-value' => 'on',
 		),
	) );
	$imageslider_slider_options->add_field( array(
		'name' => esc_html__('Button 1 has Lightbox Video?', 'halena' ),
		'desc' => esc_html__('Checking this for FadeInDown animation.', 'halena' ),
		'id' => $prefix . 'imageslider_button1_lightbox',
		'type' => 'checkbox',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => $prefix . 'imageslider_button1',
 			//'data-conditional-value' => 'on',
 		),
	) );	
	$imageslider_slider_options->add_field( array(
		'name'	=> esc_html__('Button 1 Embed code', 'halena' ), 
		'desc'	=> esc_html__('enter the youtube, vimeo or any video embed link. This code will ignore the actual button link', 'halena' ), 
		'id'	=> $prefix . 'imageslider_button1_embed_url', 
		'type'	=> 'textarea_small',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => $prefix . 'imageslider_button1_lightbox',
 			//'data-conditional-value' => 'on',
 		),
		'sanitization_cb' => false
	) );
	$imageslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Button 2', 'halena' ), 
		'desc'	=> esc_html__('button 2 info', 'halena' ), 
		'id'	=> $prefix . 'imageslider_button2', 
		'type'	=> 'text_small'
	) );
	$imageslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Button 2 Icon', 'halena' ),
		'id'	=> $prefix . 'imageslider_button2_icon',
		'type'	=> 'select',
		'options' => array( 
			'' => esc_html__('No icon', 'halena' ), 
			'icon-arrows-slim-right' => esc_html__('Arrow Right', 'halena' ), 
		),
		'default' => '',
		'attributes' => array(
			'data-conditional-id' => $prefix . 'imageslider_button2',
		)
	) );
	$imageslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Button 2 Icon Style', 'halena' ),
		'id'	=> $prefix . 'imageslider_button2_icon_style',
		'type'	=> 'select',
		'options' => array( 
			'' => esc_html__('Default', 'halena' ), 
			'has-big-btn' => esc_html__('Big Rounded', 'halena' ), 
		),
		'default' => '',
		'attributes' => array(
			'data-conditional-id' => $prefix .'imageslider_button2_icon',
		)
	) );
	$imageslider_slider_options->add_field( array( 
		'name' => esc_html__('Hide Button 2 Text', 'halena' ),
		'desc' => esc_html__('It will hide the button text.', 'halena' ),
		'id' => $prefix . 'imageslider_button2_text_hide',
		'type' => 'checkbox',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => $prefix .'imageslider_button2_icon_style',
 			//'data-conditional-value' => 'on',
 		),
	) );
	$imageslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Button 2 URL', 'halena' ), 
		'desc'	=> esc_html__('button href', 'halena' ), 
		'id'	=> $prefix . 'imageslider_button2_url', 
		'type'	=> 'text_url',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => $prefix . 'imageslider_button2',
 			//'data-conditional-value' => 'on',
 		)
	) );
	
	$imageslider_slider_options->add_field( array(
		'name'	=> esc_html__('Button 2 Style', 'halena' ),
		'id'	=> $prefix . 'imageslider_button2_style',
		'type'	=> 'select',
		'options' => array( 
			'default' => esc_html__('Default', 'halena' ), 
			'primary' => esc_html__('Primary', 'halena' ), 
			'accent' => esc_html__('Accent', 'halena' ), 
			'white' => esc_html__('White', 'halena' ), 
		),
		'default' => 'white',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => $prefix . 'imageslider_button2',
 			//'data-conditional-value' => 'on',
 		),
	) );
	$imageslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Button 2 Type', 'halena' ),
		'id'	=> $prefix . 'imageslider_button2_type',
		'type'	=> 'radio_inline',
		'options' => array( 
			'btn-normal' => esc_html__('background', 'halena' ), 
			'btn-alt' => esc_html__('Bordered', 'halena' ), 
			'btn-plain' => esc_html__('Plain', 'halena' ), 
		),
		'default' => 'btn-normal',
		'attributes' => array(
			'data-conditional-id' => $prefix . 'imageslider_button2',
		)
	) );
	$imageslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Button 2 Radius', 'halena' ), 
		'desc'	=> esc_html__('You can use px, em, %, etc. or enter just number and it will use pixels.', 'halena' ), 
		'id'	=> $prefix . 'imageslider_button2_radius', 
		'type'	=> 'text_small',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => $prefix . 'imageslider_button2',
 			//'data-conditional-value' => 'on',
 		),
	) );
	$imageslider_slider_options->add_field( array(
		'name'	=> esc_html__('Button 2 Target', 'halena' ),
		'id'	=> $prefix . 'imageslider_button2_target',
		'type'	=> 'select',
		'options' => array( 
			'_self' => esc_html__('Same Window', 'halena' ), 
			'_blank' => esc_html__('New Window', 'halena' ), 
		),
		'default' => '_self',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => $prefix . 'imageslider_button2',
 			//'data-conditional-value' => 'on',
 		),
	) );	
	$imageslider_slider_options->add_field( array(
		'name' => esc_html__('Button 2 has Lightbox Video?', 'halena' ),
		'desc' => esc_html__('Checking this for FadeInDown animation.', 'halena' ),
		'id' => $prefix . 'imageslider_button2_lightbox',
		'type' => 'checkbox',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => $prefix . 'imageslider_button2',
 			//'data-conditional-value' => 'on',
 		),
	) );
	$imageslider_slider_options->add_field( array(
		'name'	=> esc_html__('Button 2 Embed code', 'halena' ), 
		'desc'	=> esc_html__('enter the youtube, vimeo or any video embed link. This code will ignore the actual button link', 'halena' ), 
		'id'	=> $prefix . 'imageslider_button2_embed_url', 
		'type'	=> 'textarea_small',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => $prefix . 'imageslider_button2_lightbox',
 			//'data-conditional-value' => 'on',
 		),
		'sanitization_cb' => false
	) );

	$imageslider_slider_options->add_field( array(
		'name' => esc_html__('Text Animation', 'halena' ),
		'desc' => esc_html__('Checking this for FadeInDown animation.', 'halena' ),
		'id' => $prefix . 'imageslider_animation',
		'type'	=> 'select',
		'options' => array( 
			'' => esc_html__('No Animation', 'halena' ), 
			'fade-in' => esc_html__('fadeIn', 'halena' ), 
			'fade-in-down' => esc_html__('fadeInDown', 'halena' ),
			'fade-in-up' => esc_html__('fadeInUp', 'halena' ),
			'zoom-in' => esc_html__('zoomIn', 'halena' ),
		),
		'default' => '',
	) );

	$imageslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Bottom Arrow Icon', 'halena' ),
		'id'	=> $prefix . 'imageslider_arrowicon',
		'type'	=> 'select',
		'options' => array( 
			'' => esc_html__('No icon', 'halena' ), 
			'pe-7s-angle-down' => esc_html__('Angle Down', 'halena' ), 
			'pe-7s-angle-down-circle' => esc_html__('Angle Down Circled', 'halena' ), 
			'ion-ios-arrow-thin-down' => esc_html__('Arrow Down', 'halena' ), 
			'pe-7s-bottom-arrow' => esc_html__('Arrow Down Circled', 'halena' ), 
			'pe-7s-mouse' => esc_html__('Mouse', 'halena' ), 
		),
		'default' => '',
	) );
	$imageslider_slider_options->add_field( array(
		'name'	=> esc_html__('Bottom Arrow link', 'halena' ), 
		'id'	=> $prefix . 'imageslider_arrowlink', 
		'type'	=> 'text_url',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => $prefix . 'imageslider_arrowicon',
 			//'data-conditional-value' => 'on',
 		),
	) );
	
	$imageslider_slider_options->add_field( array(
		'name'	=> esc_html__('Bottom Arrow Color', 'halena' ), 
		'desc'	=> esc_html__('Choose the color for the bottom arrow', 'halena' ), 
		'id'	=> $prefix . 'imageslider_arrowicon_color', 
		'type'	=> 'colorpicker',
		'attributes' => array(
			//'required' => true, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'imageslider_arrowicon',
		)		
	) );

	$imageslider_slider_options->add_field( array(
		'name'	=> esc_html__('Content stretch', 'halena' ), 
		'id'	=> $prefix.'imageslider_content_choice', 
		'type'	=> 'radio_inline',
		'options' => array( 
			'container' => esc_html__( 'Container', 'halena' ), 
			'container-fluid' => esc_html__( 'Fullwidth', 'halena' ), 
		),
		'default'  => 'container'
	) );

	$imageslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Content Width', 'halena' ), 
		'id'	=> $prefix.'imageslider_content_width', 
		'type'	=> 'text_small',
		'default' => '',
		'row_classes' => 'agni-slide-col agni-slide-height-desktop',
		'before_row' => '<div class="cmb-row agni-slide-row agni-slide-height-container">'
	) );
	$imageslider_slider_options->add_field( array( 
		//'name'	=> esc_html__('Content Width', 'halena' ), 
		'id'	=> $prefix.'imageslider_content_width_tab', 
		'desc'	=> esc_html__('content width for tab', 'halena' ), 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-height-tab',
	) );
	$imageslider_slider_options->add_field( array( 
		//'name'	=> esc_html__('Content Width', 'halena' ), 
		'id'	=> $prefix.'imageslider_content_width_mobile', 
		'desc'	=> esc_html__('content width for mobile', 'halena' ), 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-height-mobile',
		'after_row' => '</div>'
	) );
	
	$imageslider_slider_options->add_field( array(
		'name'	=> esc_html__('Content Position', 'halena' ),
		'id'	=> $prefix.'imageslider_content_position',
		'type'	=> 'select',
		'options' => array( 
			'j-flex-start a-flex-start' => esc_html__('left top', 'halena' ), 
			'j-flex-start a-center' => esc_html__('left center', 'halena' ), 
			'j-flex-start a-flex-end' => esc_html__('left bottom', 'halena' ), 
			'j-flex-end a-flex-start' => esc_html__('right top', 'halena' ), 
			'j-flex-end a-center' => esc_html__('right center', 'halena' ), 
			'j-flex-end a-flex-end' => esc_html__('right bottom', 'halena' ), 
			'j-center a-flex-start' => esc_html__('center top', 'halena' ), 
			'j-center a-center' => esc_html__('center center', 'halena' ), 
			'j-center a-flex-end' => esc_html__('center bottom', 'halena' ),
		),
		'default'  => 'j-flex-start a-center'
	) );

	$imageslider_slider_options->add_field( array(
		'name'	=> esc_html__('Content Alignment', 'halena' ),
		'id'	=> $prefix.'imageslider_text_alignment',
		'type'	=> 'radio_inline',
		'options' => array( 
			'left' => esc_html__( 'Left', 'halena' ), 
			'center' => esc_html__( 'Center', 'halena' ), 
			'right' => esc_html__( 'Right', 'halena' ), 
		),
		'default'  => 'left'
	) );

	$imageslider_slider_options->add_field( array(
		'name'	=> esc_html__('Padding Values', 'halena' ), 
		'desc'	=> esc_html__('Padding Top. You can use px, em, %, etc. or enter just number and it will use pixels.', 'halena' ), 
		'id'	=> $prefix.'imageslider_padding_top', 
		'type'	=> 'text_small',
		'default' => '',
		'row_classes' => 'agni-slide-col agni-slide-padding-top',
		'before_row' => '<div class="cmb-row agni-slide-row agni-slide-padding-container">'
	) );

	$imageslider_slider_options->add_field( array(
		//'name'	=> esc_html__('Padding Right', 'halena' ), 
		'desc'	=> esc_html__('Padding Right', 'halena' ), 
		'id'	=> $prefix.'imageslider_padding_right', 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-right'
		
	) );
	$imageslider_slider_options->add_field( array(
		//'name'	=> esc_html__('Padding Bottom', 'halena' ), 
		'desc'	=> esc_html__('Padding Bottom', 'halena' ), 
		'id'	=> $prefix.'imageslider_padding_bottom', 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-bottom',
	) );
	$imageslider_slider_options->add_field( array(
		//'name'	=> esc_html__('Padding Left', 'halena' ), 
		'desc'	=> esc_html__('Padding Left', 'halena' ), 
		'id'	=> $prefix.'imageslider_padding_left', 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-left',
		'after_row' => '</div>'
	) );
	$imageslider_slider_options->add_field( array(
		'name'	=> esc_html__('Padding Values for Tablets', 'halena' ), 
		'desc'	=> esc_html__('Padding Top', 'halena' ), 
		'id'	=> $prefix.'imageslider_padding_top_tab', 
		'type'	=> 'text_small',
		'default' => '',
		'row_classes' => 'agni-slide-col agni-slide-padding-top',
		'before_row' => '<div class="cmb-row agni-slide-row agni-slide-padding-container">'
	) );

	$imageslider_slider_options->add_field( array(
		//'name'	=> esc_html__('Padding Right', 'halena' ), 
		'desc'	=> esc_html__('Padding Right', 'halena' ), 
		'id'	=> $prefix.'imageslider_padding_right_tab', 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-right'
		
	) );
	$imageslider_slider_options->add_field( array(
		//'name'	=> esc_html__('Padding Bottom', 'halena' ), 
		'desc'	=> esc_html__('Padding Bottom', 'halena' ), 
		'id'	=> $prefix.'imageslider_padding_bottom_tab', 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-bottom',
	) );
	$imageslider_slider_options->add_field( array(
		//'name'	=> esc_html__('Padding Left', 'halena' ), 
		'desc'	=> esc_html__('Padding Left', 'halena' ), 
		'id'	=> $prefix.'imageslider_padding_left_tab', 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-left',
		'after_row' => '</div>'
	) );

	$imageslider_slider_options->add_field( array(
		'name'	=> esc_html__('Padding Values for mobile', 'halena' ), 
		'desc'	=> esc_html__('Padding Top', 'halena' ), 
		'id'	=> $prefix.'imageslider_padding_top_mobile', 
		'type'	=> 'text_small',
		'default' => '',
		'row_classes' => 'agni-slide-col agni-slide-padding-top',
		'before_row' => '<div class="cmb-row agni-slide-row agni-slide-padding-container">'
	) );

	$imageslider_slider_options->add_field( array(
		//'name'	=> esc_html__('Padding Right', 'halena' ), 
		'desc'	=> esc_html__('Padding Right', 'halena' ), 
		'id'	=> $prefix.'imageslider_padding_right_mobile', 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-right'
		
	) );
	$imageslider_slider_options->add_field( array(
		//'name'	=> esc_html__('Padding Bottom', 'halena' ), 
		'desc'	=> esc_html__('Padding Bottom', 'halena' ), 
		'id'	=> $prefix.'imageslider_padding_bottom_mobile', 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-bottom',
	) );
	$imageslider_slider_options->add_field( array(
		//'name'	=> esc_html__('Padding Left', 'halena' ), 
		'desc'	=> esc_html__('Padding Left', 'halena' ), 
		'id'	=> $prefix.'imageslider_padding_left_mobile', 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-left',
		'after_row' => '</div>'
	) );

	$imageslider_slider_options->add_field( array(
		'name'	=> esc_html__('Slider Choice', 'halena' ),
		'id'	=> $prefix.'imageslider_choice',
		'type'	=> 'radio_inline',
		'options' => array( 
			'1' => esc_html__('Full Height(100%)', 'halena' ), 
			'2' => esc_html__('Custom Height', 'halena' ), 
		),
		'default' => '1',
		'before_row' => '<h3>Basic Options</h3>'
	) );
	$imageslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Slider Height', 'halena' ), 
		'desc'	=> esc_html__('Enter your slider height, don\'t include "px" string', 'halena' ), 
		'id'	=> $prefix.'imageslider_height', 
		'type'	=> 'text_small',
		'default' => '600',
		'attributes' => array(
			'required' => false, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'imageslider_choice',
			'data-conditional-value' => '2',
		),
		'row_classes' => 'agni-slide-col agni-slide-height-desktop',
		'before_row' => '<div class="cmb-row agni-slide-row agni-slide-height-container">'
	) );
	$imageslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Slider Height(Tablet devices)', 'halena' ), 
		'desc'	=> esc_html__('Height on Tablets', 'halena' ), 
		'id'	=> $prefix.'imageslider_height_tab', 
		'type'	=> 'text_small',
		'default' => '480',
		'attributes' => array(
			'required' => false, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'imageslider_choice',
			'data-conditional-value' => '2',
		),
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-height-tab',
	) );
	$imageslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Slider Height(Mobile devices)', 'halena' ), 
		'desc'	=> esc_html__('Height on Mobiles', 'halena' ), 
		'id'	=> $prefix.'imageslider_height_mobile', 
		'type'	=> 'text_small',
		'default' => '360',
		'attributes' => array(
			'required' => false, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'imageslider_choice',
			'data-conditional-value' => '2',
		),
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-height-mobile',
		'after_row' => '</div>'
	) );
	$imageslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Margin Values', 'halena' ), 
		'desc'	=> esc_html__('margin top value for the slider. You can use px, em, %, etc. or enter just number and it will use pixels.', 'halena' ), 
		'id'	=> $prefix.'imageslider_margin_top', 
		'type'	=> 'text_small',
		'default' => '',
		'row_classes' => 'agni-slide-col agni-slide-padding-top',
		'before_row' => '<div class="cmb-row agni-slide-row agni-slide-padding-container">'
	) );
	$imageslider_slider_options->add_field( array( 
		//'name'	=> esc_html__('Margin Values', 'halena' ), 
		'desc'	=> esc_html__('margin right value', 'halena' ), 
		'id'	=> $prefix.'imageslider_margin_right', 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-right'
	) );
	$imageslider_slider_options->add_field( array( 
		//'name'	=> esc_html__('Margin Values', 'halena' ), 
		'desc'	=> esc_html__('margin bottom value', 'halena' ), 
		'id'	=> $prefix.'imageslider_margin_bottom', 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-bottom'
	) );
	$imageslider_slider_options->add_field( array( 
		//'name'	=> esc_html__('Margin Values', 'halena' ), 
		'desc'	=> esc_html__('margin left value', 'halena' ), 
		'id'	=> $prefix.'imageslider_margin_left', 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-left',
		'after_row' => '</div>'
	) );
	$imageslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Margin Values for Tablets', 'halena' ), 
		'desc'	=> esc_html__('margin top value', 'halena' ), 
		'id'	=> $prefix.'imageslider_margin_top_tab', 
		'type'	=> 'text_small',
		'default' => '',
		'row_classes' => 'agni-slide-col agni-slide-padding-top',
		'before_row' => '<div class="cmb-row agni-slide-row agni-slide-padding-container">'
	) );
	$imageslider_slider_options->add_field( array( 
		//'name'	=> esc_html__('Margin Values', 'halena' ), 
		'desc'	=> esc_html__('margin right value', 'halena' ), 
		'id'	=> $prefix.'imageslider_margin_right_tab', 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-right'
	) );
	$imageslider_slider_options->add_field( array( 
		//'name'	=> esc_html__('Margin Values', 'halena' ), 
		'desc'	=> esc_html__('margin bottom value', 'halena' ), 
		'id'	=> $prefix.'imageslider_margin_bottom_tab', 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-bottom'
	) );
	$imageslider_slider_options->add_field( array( 
		//'name'	=> esc_html__('Margin Values', 'halena' ), 
		'desc'	=> esc_html__('margin left value', 'halena' ), 
		'id'	=> $prefix.'imageslider_margin_left_tab', 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-left',
		'after_row' => '</div>'
	) );
	$imageslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Margin Values for Mobile', 'halena' ), 
		'desc'	=> esc_html__('margin top value', 'halena' ), 
		'id'	=> $prefix.'imageslider_margin_top_mobile', 
		'type'	=> 'text_small',
		'default' => '',
		'row_classes' => 'agni-slide-col agni-slide-padding-top',
		'before_row' => '<div class="cmb-row agni-slide-row agni-slide-padding-container">'
	) );
	$imageslider_slider_options->add_field( array( 
		//'name'	=> esc_html__('Margin Values', 'halena' ), 
		'desc'	=> esc_html__('margin right value', 'halena' ), 
		'id'	=> $prefix.'imageslider_margin_right_mobile', 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-right'
	) );
	$imageslider_slider_options->add_field( array( 
		//'name'	=> esc_html__('Margin Values', 'halena' ), 
		'desc'	=> esc_html__('margin bottom value', 'halena' ), 
		'id'	=> $prefix.'imageslider_margin_bottom_mobile', 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-bottom'
	) );
	$imageslider_slider_options->add_field( array( 
		//'name'	=> esc_html__('Margin Values', 'halena' ), 
		'desc'	=> esc_html__('margin left value', 'halena' ), 
		'id'	=> $prefix.'imageslider_margin_left_mobile', 
		'type'	=> 'text_small',
		'default' => '',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-left',
		'after_row' => '</div>'
	) );
	
	$imageslider_slider_options->add_field( array(
		'name' => esc_html__('Parallax', 'halena' ),
		'desc' => esc_html__('Check this to enable parallax, its purely based on skrollr.', 'halena' ),
		'id' => $prefix.'imageslider_parallax',
		'type' => 'checkbox',
	) );
	$imageslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Parallax Value', 'halena' ), 
		'desc'	=> esc_html__('Enter the css property for the slider\'s top at the top of the screen. for eg.transform:translateY(0px); if don\'t want parallax just leave this empty', 'halena' ), 
		'id'	=> $prefix.'imageslider_parallax_start', 
		'type'	=> 'textarea_small',
		'default'  => 'transform:translateY(0px);',
		'attributes' => array(
	        'rows'        => 2,
	        'placeholder' => 'Parallax Starting Value',
			'required' => false, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'imageslider_parallax',
		),
		'row_classes' => 'agni-slide-col agni-slide-parallax-start',
		'before_row' => '<div class="cmb-row agni-slide-row agni-slide-parallax-container">'
	) );
	
	$imageslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Parallax End Value', 'halena' ), 
		'desc'	=> esc_html__('Enter the css property for the slider\'s bottom when at the top of the screen. for eg.transform:translateY(600px); if don\'t want parallax just leave this empty', 'halena' ), 
		'id'	=> $prefix.'imageslider_parallax_end', 
		'type'	=> 'textarea_small',
		'default'  => 'transform:translateY(600px);',
		'attributes' => array(
			'rows'        => 2,
			'placeholder' => 'Parallax End Value',
			'required' => false, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'imageslider_parallax',
		),
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-parallax-end',
		'after_row' => '</div>'
	) );
	$imageslider_slider_options->add_field( array(
		'name'	=> esc_html__('Autoplay', 'halena' ),
		'id'	=> $prefix.'imageslider_autoplay',
		'type'	=> 'checkbox',
	) );

	$imageslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Autoplay Speed', 'halena' ), 
		'desc'	=> esc_html__('Enter your transition duration in ms.', 'halena' ), 
		'id'	=> $prefix.'imageslider_transition_duration', 
		'type'	=> 'text_small',
		'default' => '6000',
		'attributes' => array(
			'type'  => 'number',
			'min'  => '3000',
			'max'  => '20000',
			'step'  => '100',
			'required' => false, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'imageslider_autoplay',
			'data-conditional-value' => 'on',
		),
	) );
	$imageslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Transition Speed', 'halena' ), 
		'desc'	=> esc_html__('Enter your transition speed in ms.', 'halena' ), 
		'id'	=> $prefix.'imageslider_transition_speed', 
		'type'	=> 'text_small',
		'default' => '400',
		'attributes' => array(
			'type'  => 'number',
			'min'  => '100',
			'max'  => '1200',
			'step'  => '10'
		),
	) );
	$imageslider_slider_options->add_field( array(
		'name'	=> esc_html__('Loop', 'halena' ),
		'id'	=> $prefix.'imageslider_loop',
		'type'	=> 'checkbox',
	) );
	$imageslider_slider_options->add_field( array(
		'name'	=> esc_html__('Slide Animation', 'halena' ),
		'id'	=> $prefix.'imageslider_slide_animation',
		'type'	=> 'select',
		'options' => array( 
			'fade' => esc_html__('Fade', 'halena' ), 
			'slide' => esc_html__('Slide', 'halena' ),
		),
		'default' => 'slide',
	) );
	$imageslider_slider_options->add_field( array(
		'name'	=> esc_html__('Navigation Arrows', 'halena' ),
		'id'	=> $prefix.'imageslider_navigation',
		'type'	=> 'checkbox',
	) );
	$imageslider_slider_options->add_field( array(
		'name'	=> esc_html__('Nav Prev Text', 'halena' ), 
		'desc'	=> esc_html__('Enter your text/label for Previous. for ex. Previous', 'halena' ), 
		'id'	=> $prefix.'imageslider_navigation_prev', 
		'type'	=> 'text_small',
		'attributes' => array(
			'required' => false, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'imageslider_navigation',
		),
		'sanitization_cb' => false,
		'default' => 'Previous',
	) );
	$imageslider_slider_options->add_field( array(
		'name'	=> esc_html__('Nav next Text', 'halena' ), 
		'desc'	=> esc_html__('Enter your text/label for next. for ex. Next', 'halena' ), 
		'id'	=> $prefix.'imageslider_navigation_next', 
		'type'	=> 'text_small',
		'attributes' => array(
			'required' => false, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'imageslider_navigation',
		),
		'sanitization_cb' => false,
		'default' => 'Next ',
	) );
	$imageslider_slider_options->add_field( array(
		'name'	=> esc_html__('Pagination Dots', 'halena' ),
		'id'	=> $prefix.'imageslider_pagination',
		'type'	=> 'checkbox',
	) );
	$imageslider_slider_options->add_field( array(
		'name'	=> esc_html__('Mouse Drag', 'halena' ),
		'id'	=> $prefix.'imageslider_mousedrag',
		'type'	=> 'checkbox',
	) );

	// Posttype Slider
	$posttypeslider_slider_options = new_cmb2_box( array(
		'id'            => $prefix . 'posttypeslider_options',
		'title'         => esc_html__( 'Posttype Slider Options', 'halena' ),
		'object_types'  => array( 'agni_slides' ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
	) );

	$posttypeslider_slider_options->add_field( array(
		'name'	=> esc_html__('Posttype Choice', 'halena' ),
		'desc'	=> esc_html__('Choose your desired posttype to create a slider', 'halena' ), 
		'id'	=> $prefix.'posttypeslider_posttype_choice',
		'type'	=> 'radio_inline',
		'options' => array( 
			'post' => esc_html__('Post', 'halena' ), 
			'portfolio' => esc_html__('Portfolio', 'halena' ), 
			//'product' => esc_html__('Products', 'halena' ), 
		),
		'default'  => 'post',
	) );

	$posttypeslider_slider_options->add_field( array(
		'name'	=> esc_html__('Number of Items to display', 'halena' ), 
		'id'	=> $prefix.'posttypeslider_items_per_page', 
		'type'	=> 'text_small',
		'default' => '3',
		'before_row' => '<h3>Posttype Options</h3>'
	) );
	$posttypeslider_slider_options->add_field( array(
		'name'           => esc_html__('Post Categories', 'halena' ),
		'desc'           => esc_html__('Choose your desired categories to display in the slider. Nothing means all categories.', 'halena' ), 
		'id'             => $prefix.'posttypeslider_blog_categories',
		'taxonomy'       => 'category', //Enter Taxonomy Slug
		'type'           => 'taxonomy_multicheck_inline',
		'text'           => array(
			'no_terms_text' => 'Sorry, No Category could be found.' // Change default text. Default: "No terms"
		),
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'posttypeslider_posttype_choice' ,
 			'data-conditional-value' => 'post',
 		)
	) );
	$posttypeslider_slider_options->add_field( array(
		'name'           => esc_html__('Portfolio Categories', 'halena' ),
		'desc'           => esc_html__('Choose your desired categories to display in the slider. Nothing means all categories.', 'halena' ), 
		'id'             => $prefix.'posttypeslider_portfolio_categories',
		'taxonomy'       => 'types', //Enter Taxonomy Slug
		'type'           => 'taxonomy_multicheck_inline',
		'text'           => array(
			'no_terms_text' => 'Sorry, No Category could be found.' // Change default text. Default: "No terms"
		),
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'posttypeslider_posttype_choice' ,
 			'data-conditional-value' => 'portfolio',
 		)
	) );
	$posttypeslider_slider_options->add_field( array(
		'name'	=> esc_html__('Items to Include', 'halena' ), 
		'desc'  => esc_html__('Enter your item ids to include. for ex. 101, 103 Just keep it empty to include all items.', 'halena' ), 
		'id'	=> $prefix.'posttypeslider_post_in', 
		'type'	=> 'text_small',
		'default' => '',
	) );
	$posttypeslider_slider_options->add_field( array(
		'name'	=> esc_html__('Items to Exclude', 'halena' ), 
		'desc'  => esc_html__('Enter your item ids to exclude. for ex. 101, 103', 'halena' ), 
		'id'	=> $prefix.'posttypeslider_post_not_in', 
		'type'	=> 'text_small',
		'default' => '',
	) );
	$posttypeslider_slider_options->add_field( array(
		'name'	=> esc_html__('Order', 'halena' ),
		'desc'	=> esc_html__('Featured Image background position', 'halena' ), 
		'id'	=> $prefix.'posttypeslider_items_order',
		'type'	=> 'select',
		'options' => array( 
			'DESC' => esc_html__( 'Descending ', 'halena'),
			'ASC' => esc_html__( 'Ascending', 'halena'),
		),
		'default' => 'DESC',
	) );

	$posttypeslider_slider_options->add_field( array(
		'name'	=> esc_html__('Orderby', 'halena' ),
		'desc'	=> esc_html__('Featured Image background position', 'halena' ), 
		'id'	=> $prefix.'posttypeslider_items_orderby',
		'type'	=> 'select',
		'options' => array( 
			'none' => esc_html__( 'None', 'halena'),
			'id' => esc_html__( 'Post ID', 'halena'),
			'author' => esc_html__( 'Post author', 'halena'),
			'title' => esc_html__( 'Post title', 'halena'),
			'name' => esc_html__( 'Post slug', 'halena'),
			'date' => esc_html__( 'Date', 'halena'),
			'modified' => esc_html__( 'Last modified date', 'halena'),
			'rand' => esc_html__( 'Random', 'halena'),
			'comment_count' => esc_html__( 'Comments number', 'halena'),
			'menu_order' => esc_html__( 'Menu order', 'halena'),
		),
		'default' => 'none',
	) );

	$posttypeslider_slider_options->add_field( array( 
		'name' => esc_html__('Ignore Sticky', 'halena' ),
		'desc' => esc_html__('It will enable the particles for the background.', 'halena' ),
		'id' => $prefix.'posttypeslider_ignore_sticky',
		'type' => 'checkbox',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'posttypeslider_posttype_choice' ,
 			'data-conditional-value' => 'post',
 		)
	) );

	$posttypeslider_slider_options->add_field( array(
		'name'	=> esc_html__('Featured Image Position', 'halena' ),
		'desc'	=> esc_html__('Featured Image background position', 'halena' ), 
		'id'	=> $prefix.'posttypeslider_bg_image_position',
		'type'	=> 'select',
		'options' => array( 
			'left top' => esc_html__('left top', 'halena' ), 
			'left center' => esc_html__('left center', 'halena' ), 
			'left bottom' => esc_html__('left bottom', 'halena' ), 
			'right top' => esc_html__('right top', 'halena' ), 
			'right center' => esc_html__('right center', 'halena' ), 
			'right bottom' => esc_html__('right bottom', 'halena' ), 
			'center top' => esc_html__('center top', 'halena' ), 
			'center center' => esc_html__('center center', 'halena' ), 
			'center bottom' => esc_html__('center bottom', 'halena' ), 
		),
		'default' => 'center center',
		'before_row' => '<h3>Content Options</h3>'
	) );
	$posttypeslider_slider_options->add_field( array(
		'name'	=> esc_html__('Featured Image Repeat', 'halena' ),
		'id'	=> $prefix.'posttypeslider_bg_image_repeat',
		'type'	=> 'select',
		'options' => array( 
			'repeat' => esc_html__('repeat', 'halena' ), 
			'no-repeat' => esc_html__('no-repeat', 'halena' ), 
		),
		'default' => 'repeat',
	) );
	$posttypeslider_slider_options->add_field( array(
		'name'	=> esc_html__('Featured Image Size', 'halena' ),
		'id'	=> $prefix.'posttypeslider_bg_image_size',
		'type'	=> 'select',
		'options' => array( 
			'cover' => esc_html__('cover', 'halena' ), 
			'auto' => esc_html__('auto', 'halena' ), 
		),
		'default' => 'cover',
	) );

	$posttypeslider_slider_options->add_field( array( 
		'name'	=> esc_html__('BG Overlay Choice', 'halena' ),
		'desc'	=> esc_html__('Gradient Map will not work on video bg.', 'halena' ),
		'id'	=> $prefix.'posttypeslider_bg_overlay_choice', 
		'type'	=> 'radio_inline',
		'options' => array( 
			'1' => esc_html__('Simple', 'halena' ), 
			'2' => esc_html__('Simple Gradient', 'halena' ), 
			'3' => esc_html__('Gradient Map(Duotone)', 'halena' ), 
			'4' => esc_html__('No Overlay', 'halena' ), 
		),
		'default' => '4',
	) );
	$posttypeslider_slider_options->add_field( array( 
		'name'	=> esc_html__('BG Overlay Color', 'halena' ), 
		'desc'	=> esc_html__('This layer will be the overlay of the slider.', 'halena' ), 
		'id'	=> $prefix.'posttypeslider_bg_overlay_color', 
		'type'	=> 'rgba_colorpicker',
		'default' => '',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'posttypeslider_bg_overlay_choice' ,
 			'data-conditional-value' => '1',
 		)
	) );
	$posttypeslider_slider_options->add_field( array( 
		'name'	=> esc_html__('BG Gradient Overlay CSS', 'halena' ), 
		'desc'	=> wp_kses( __( 'Get/Type your Gradient CSS. Ref. <a target="_blank" href="http://uigradients.com/">http://uigradients.com/</a> <a target="_blank" href="http://hex2rgba.devoth.com/">HEX to RGBA converter for transparency</a>', 'halena' ), array( 'a' => array( 'href' => array(), 'target' => array() ) ) ),
		'id'	=> $prefix.'posttypeslider_bg_sg_overlay_css', 
		'type'	=> 'textarea_code',
		'default' => '',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'posttypeslider_bg_overlay_choice' ,
 			'data-conditional-value' => '2',
 		)
	) );
	$posttypeslider_slider_options->add_field( array( 
		'name'	=> esc_html__('BG Gradient Map(Duotone) Overlay Color 1', 'halena' ), 
		'desc'	=> wp_kses( __( 'Choose the color for Shadows(Dark pixels). <a target="_blank" href="http://demo.agnidesigns.com/halena/documentation/kb/gradient-map-duotone/">See Presets</a>', 'halena' ), array( 'a' => array( 'href' => array(), 'target' => array() ) ) ),
		'id'	=> $prefix.'posttypeslider_bg_gm_overlay_color1', 
		'type'	=> 'colorpicker',
		'default' => '',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'posttypeslider_bg_overlay_choice' ,
 			'data-conditional-value' => '3',
 		)
	) );
	$posttypeslider_slider_options->add_field( array( 
		'name'	=> esc_html__('BG Gradient Map(Duotone) Overlay Color 2', 'halena' ), 
		'desc'	=> esc_html__('Choose the mid-tone color. You can leave this empty for no mid-tone.', 'halena' ), 
		'id'	=> $prefix.'posttypeslider_bg_gm_overlay_color2', 
		'type'	=> 'colorpicker',
		'default' => '',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'posttypeslider_bg_overlay_choice' ,
 			'data-conditional-value' => '3',
 		)
	) );
	$posttypeslider_slider_options->add_field( array( 
		'name'	=> esc_html__('BG Gradient Map(Duotone) Overlay Color 3', 'halena' ), 
		'desc'	=> esc_html__('Choose the color for Highlights(White pixels).', 'halena' ), 
		'id'	=> $prefix.'posttypeslider_bg_gm_overlay_color3', 
		'type'	=> 'colorpicker',
		'default' => '',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'posttypeslider_bg_overlay_choice',
 			'data-conditional-value' => '3',
 		)
	) );

	$posttypeslider_slider_options->add_field( array( 
		'name' => esc_html__('Particle Ground', 'halena' ),
		'desc' => esc_html__('It will enable the particles for the background.', 'halena' ),
		'id' => $prefix.'posttypeslider_bg_particle_ground',
		'type' => 'checkbox',
	) );
	$posttypeslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Particle Ground Color', 'halena' ), 
		'desc'	=> esc_html__('Choose the color and transparency for the particle ground.', 'halena' ), 
		'id'	=> $prefix.'posttypeslider_bg_particle_ground_color', 
		'type'	=> 'rgba_colorpicker',
		'default' => '',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'posttypeslider_bg_particle_ground',
 		)
	) );

	$posttypeslider_slider_options->add_field( array(
		'name'	=> esc_html__('Show Post Title', 'halena' ),
		'id'	=> $prefix.'posttypeslider_title_choice',
		'type'	=> 'select',
		'options' => array( 
			'yes' => esc_html__('Yes', 'halena' ), 
			'no' => esc_html__('No', 'halena' ), 
		),
		'default' => 'yes',
	) );

	$posttypeslider_slider_options->add_field( array(
		'name' => esc_html__('Title Font', 'halena' ),
		'desc' => esc_html__('It will apply the font to the Title which you choose at "Halena/Theme Options/General Settings/Typography".', 'halena' ),
		'id' => $prefix . 'posttypeslider_title_font',
		'type' => 'select',
		'options' => array( 
			'primary-typo' => esc_html__('Primary Font', 'halena' ), 
			'default-typo' => esc_html__('Default Font', 'halena' ), 
			'additional-typo' => esc_html__('Additional Font', 'halena' ), 
			'special-typo' => esc_html__('Special Font', 'halena' ), 
		),
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'posttypeslider_title_choice' ,
 			'data-conditional-value' => 'yes',
		),
		'default' => 'primary-typo',
	) );

	$posttypeslider_slider_options->add_field( array(
		'name'	=> esc_html__('Title Font Size', 'halena' ), 
		'desc'	=> esc_html__('Enter your title font size, don\'t include "px" string', 'halena' ), 
		'id'	=> $prefix . 'posttypeslider_title_size', 
		'type'	=> 'text_small',
		'default' => '',
		'attributes' => array(
			'type'  => 'number',
			'min'  => '30',
			'max'  => '200',
			'step'  => '1',
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'posttypeslider_title_choice' ,
 			'data-conditional-value' => 'yes',
		),
	) );
	$posttypeslider_slider_options->add_field( array(
		'name'	=> esc_html__('Title Color', 'halena' ), 
		'desc'	=> esc_html__('Choose the color for title', 'halena' ), 
		'id'	=> $prefix . 'posttypeslider_title_color', 
		'type'	=> 'colorpicker',
		'default' => '#f0f0f0',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'posttypeslider_title_choice' ,
 			'data-conditional-value' => 'yes',
 		)
	) );
	$posttypeslider_slider_options->add_field( array(
		'name'	=> esc_html__('Show Categories', 'halena' ),
		'id'	=> $prefix.'posttypeslider_categories_choice',
		'type'	=> 'select',
		'options' => array( 
			'yes' => esc_html__('Yes', 'halena' ), 
			'no' => esc_html__('No', 'halena' ), 
		),
		'default' => 'yes',
	) );
	$posttypeslider_slider_options->add_field( array(
		'name' => esc_html__('Categories Font', 'halena' ),
		'desc' => esc_html__('It will apply the font to the Categories which you choose at "Halena/Theme Options/General Settings/Typography".', 'halena' ),
		'id' => $prefix . 'posttypeslider_categories_font',
		'type' => 'select',
		'options' => array( 
			'primary-typo' => esc_html__('Primary Font', 'halena' ), 
			'default-typo' => esc_html__('Default Font', 'halena' ), 
			'additional-typo' => esc_html__('Additional Font', 'halena' ), 
			'special-typo' => esc_html__('Special Font', 'halena' ), 
		),
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'posttypeslider_title_choice' ,
 			'data-conditional-value' => 'yes',
		),
		'default' => 'default-typo',
	) );

	$posttypeslider_slider_options->add_field( array(
		'name'	=> esc_html__('Categories Font Size', 'halena' ), 
		'desc'	=> esc_html__('Enter your Categories font size, don\'t include "px" string', 'halena' ), 
		'id'	=> $prefix . 'posttypeslider_categories_size', 
		'type'	=> 'text_small',
		'default' => '',
		'attributes' => array(
			'type'  => 'number',
			'min'  => '8',
			'max'  => '40',
			'step'  => '1',
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'posttypeslider_title_choice' ,
 			'data-conditional-value' => 'yes',
		),
	) );
	$posttypeslider_slider_options->add_field( array(
		'name'	=> esc_html__('Categories Color', 'halena' ), 
		'desc'	=> esc_html__('Choose the color for Categories', 'halena' ), 
		'id'	=> $prefix . 'posttypeslider_categories_color', 
		'type'	=> 'colorpicker',
		'default' => '#f0f0f0',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'posttypeslider_title_choice' ,
 			'data-conditional-value' => 'yes',
 		)
	) );

	$posttypeslider_slider_options->add_field( array(
		'name'	=> esc_html__('Read More Text', 'halena' ), 
		'id'	=> $prefix.'posttypeslider_button1', 
		'type'	=> 'text_small',
		'default' => 'Read More',
		'attributes' => array(
			'data-conditional-id'    => $prefix .'posttypeslider_button1',
 			'data-conditional-value' => 'yes',
		)
	) );
	$posttypeslider_slider_options->add_field( array(
		'name'	=> esc_html__('Read More Style', 'halena' ),
		'id'	=> $prefix . 'posttypeslider_button1_style',
		'type'	=> 'select',
		'options' => array( 
			'default' => esc_html__('Default', 'halena' ), 
			'primary' => esc_html__('Primary', 'halena' ), 
			'accent' => esc_html__('Accent', 'halena' ), 
			'white' => esc_html__('White', 'halena' ), 
		),
		'default' => 'white',
		'attributes' => array(
			'data-conditional-id'    => $prefix .'posttypeslider_button1',
		)
	) );
	$posttypeslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Read More Type', 'halena' ),
		'id'	=> $prefix . 'posttypeslider_button1_type',
		'type'	=> 'radio_inline',
		'options' => array( 
			'btn-normal' => esc_html__('background', 'halena' ), 
			'btn-alt' => esc_html__('Bordered', 'halena' ), 
			'btn-plain' => esc_html__('Plain', 'halena' ), 
		),
		'default' => 'btn-normal',
		'attributes' => array(
			'data-conditional-id'    => $prefix .'posttypeslider_button1',
		)
	) );
	$posttypeslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Read More Radius', 'halena' ), 
		'desc'	=> esc_html__('You can use px, em, %, etc. or enter just number and it will use pixels.', 'halena' ), 
		'id'	=> $prefix . 'posttypeslider_button1_radius', 
		'type'	=> 'text_small',
		'attributes' => array(
			'data-conditional-id'    => $prefix .'posttypeslider_button1',
		)
	) );
	$posttypeslider_slider_options->add_field( array(
		'name'	=> esc_html__('Read More Target', 'halena' ),
		'id'	=> $prefix . 'posttypeslider_button1_target',
		'type'	=> 'select',
		'options' => array( 
			'_self' => esc_html__('Same Window', 'halena' ), 
			'_blank' => esc_html__('New Window', 'halena' ), 
		),
		'default' => '_self',
		'attributes' => array(
			'data-conditional-id'    => $prefix .'posttypeslider_button1',
		)
	) );	
	$posttypeslider_slider_options->add_field( array(
		'name' => esc_html__('Animation', 'halena' ),
		'desc' => esc_html__('Checking this for FadeInDown animation.', 'halena' ),
		'id' => $prefix . 'posttypeslider_animation',
		'type'	=> 'select',
		'options' => array( 
			'' => esc_html__('No Animation', 'halena' ), 
			'fade-in' => esc_html__('fadeIn', 'halena' ), 
			'fade-in-down' => esc_html__('fadeInDown', 'halena' ),
			'fade-in-up' => esc_html__('fadeInUp', 'halena' ),
			'zoom-in' => esc_html__('zoomIn', 'halena' ),
		),
		'default' => '',
	) );
	
	$posttypeslider_slider_options->add_field( array(
		'name'	=> esc_html__('Text Alignment', 'halena' ),
		'id'	=> $prefix . 'posttypeslider_text_alignment',
		'type'	=> 'radio_inline',
		'options' => array( 
			'flex-start' => esc_html__( 'Left', 'halena' ), 
			'center' => esc_html__( 'Center', 'halena' ), 
			'flex-end' => esc_html__( 'Right', 'halena' ), 
		),
		'default'  => 'flex-start'
	) );
	
	$posttypeslider_slider_options->add_field( array(
		'name'	=> esc_html__('Vertical Alignment', 'halena' ),
		'id'	=> $prefix . 'posttypeslider_content_position',
		'type'	=> 'radio_inline',
		'options' => array( 
			'flex-start' => esc_html__( 'Top', 'halena' ), 
			'center' => esc_html__( 'Center', 'halena' ), 
			'flex-end' => esc_html__( 'Bottom', 'halena' ), 
		),
		'default'  => 'center'
	) );
	$posttypeslider_slider_options->add_field( array(
		'name'	=> esc_html__('Padding Values', 'halena' ), 
		'desc'	=> esc_html__('Padding Top. You can use px, em, %, etc. or enter just number and it will use pixels.', 'halena' ), 
		'id'	=> $prefix.'posttypeslider_padding_top', 
		'type'	=> 'text_small',
		'default' => '0',
		'row_classes' => 'agni-slide-col agni-slide-padding-top',
		'before_row' => '<div class="cmb-row agni-slide-row agni-slide-padding-container">'
	) );

	$posttypeslider_slider_options->add_field( array(
		//'name'	=> esc_html__('Padding Right', 'halena' ), 
		'desc'	=> esc_html__('Padding Right', 'halena' ), 
		'id'	=> $prefix.'posttypeslider_padding_right', 
		'type'	=> 'text_small',
		'default' => '0',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-right'
		
	) );
	$posttypeslider_slider_options->add_field( array(
		//'name'	=> esc_html__('Padding Bottom', 'halena' ), 
		'desc'	=> esc_html__('Padding Bottom', 'halena' ), 
		'id'	=> $prefix.'posttypeslider_padding_bottom', 
		'type'	=> 'text_small',
		'default' => '0',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-bottom',
	) );
	$posttypeslider_slider_options->add_field( array(
		//'name'	=> esc_html__('Padding Left', 'halena' ), 
		'desc'	=> esc_html__('Padding Left', 'halena' ), 
		'id'	=> $prefix.'posttypeslider_padding_left', 
		'type'	=> 'text_small',
		'default' => '0',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-left',
		'after_row' => '</div>'
	) );

	$posttypeslider_slider_options->add_field( array(
		'name'	=> esc_html__('Slider Choice', 'halena' ),
		'id'	=> $prefix.'posttypeslider_choice',
		'type'	=> 'radio_inline',
		'options' => array( 
			'1' => esc_html__('Full Height(100%)', 'halena' ), 
			'2' => esc_html__('Custom Height', 'halena' ), 
		),
		'default' => '1',
		'before_row' => '<h3>Basic Options</h3>'
	) );
	$posttypeslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Slider Height', 'halena' ), 
		'desc'	=> esc_html__('Enter your slider height, don\'t include "px" string', 'halena' ), 
		'id'	=> $prefix.'posttypeslider_height', 
		'type'	=> 'text_small',
		'default' => '600',
		'attributes' => array(
			'required' => false, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'posttypeslider_choice',
			'data-conditional-value' => '2',
		),
		'row_classes' => 'agni-slide-col agni-slide-height-desktop',
		'before_row' => '<div class="cmb-row agni-slide-row agni-slide-height-container">'
	) );
	$posttypeslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Slider Height(Tablet devices)', 'halena' ), 
		'desc'	=> esc_html__('Height on Tablets', 'halena' ), 
		'id'	=> $prefix.'posttypeslider_height_tab', 
		'type'	=> 'text_small',
		'default' => '480',
		'attributes' => array(
			'required' => false, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'posttypeslider_choice',
			'data-conditional-value' => '2',
		),
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-height-tab',
	) );
	$posttypeslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Slider Height(Mobile devices)', 'halena' ), 
		'desc'	=> esc_html__('Height on Mobiles', 'halena' ), 
		'id'	=> $prefix.'posttypeslider_height_mobile', 
		'type'	=> 'text_small',
		'default' => '360',
		'attributes' => array(
			'required' => false, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'posttypeslider_choice',
			'data-conditional-value' => '2',
		),
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-height-mobile',
		'after_row' => '</div>'
	) );
	$posttypeslider_slider_options->add_field( array(
		'name' => esc_html__('Parallax', 'halena' ),
		'desc' => esc_html__('Check this to enable parallax, its purely based on skrollr.', 'halena' ),
		'id' => $prefix.'posttypeslider_parallax',
		'type' => 'checkbox',
	) );
	$posttypeslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Parallax Value', 'halena' ), 
		'desc'	=> esc_html__('Enter the css property for the slider\'s top at the top of the screen. for eg.transform:translateY(0px); if don\'t want parallax just leave this empty', 'halena' ), 
		'id'	=> $prefix.'posttypeslider_parallax_start', 
		'type'	=> 'textarea_small',
		'default'  => 'transform:translateY(0px);',
		'attributes' => array(
	        'rows'        => 2,
	        'placeholder' => 'Parallax Starting Value',
			'required' => false, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'posttypeslider_parallax',
		),
		'row_classes' => 'agni-slide-col agni-slide-parallax-start',
		'before_row' => '<div class="cmb-row agni-slide-row agni-slide-parallax-container">'
	) );
	
	$posttypeslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Parallax End Value', 'halena' ), 
		'desc'	=> esc_html__('Enter the css property for the slider\'s bottom when at the top of the screen. for eg.transform:translateY(600px); if don\'t want parallax just leave this empty', 'halena' ), 
		'id'	=> $prefix.'posttypeslider_parallax_end', 
		'type'	=> 'textarea_small',
		'default'  => 'transform:translateY(600px);',
		'attributes' => array(
			'rows'        => 2,
			'placeholder' => 'Parallax End Value',
			'required' => false, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'posttypeslider_parallax',
		),
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-parallax-end',
		'after_row' => '</div>'
	) );
	$posttypeslider_slider_options->add_field( array(
		'name'	=> esc_html__('Autoplay', 'halena' ),
		'id'	=> $prefix.'posttypeslider_autoplay',
		'type'	=> 'checkbox',
	) );
	$posttypeslider_slider_options->add_field( array(
		'name'	=> esc_html__('Loop', 'halena' ),
		'id'	=> $prefix.'posttypeslider_loop',
		'type'	=> 'checkbox',
	) );
	$posttypeslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Transition Duration', 'halena' ), 
		'desc'	=> esc_html__('Enter your transition duration in ms.', 'halena' ), 
		'id'	=> $prefix.'posttypeslider_transition_duration', 
		'type'	=> 'text_small',
		'default' => '6000',
		'attributes' => array(
			'type'  => 'number',
			'min'  => '3000',
			'max'  => '20000',
			'step'  => '100'
		),
		'row_classes' => 'agni-slide-col agni-slide-animate-in',
		'before_row' => '<div class="cmb-row agni-slide-row agni-slide-animate-container">'
	) );
	$posttypeslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Transition Speed', 'halena' ), 
		'desc'	=> esc_html__('Enter your transition speed in ms.', 'halena' ), 
		'id'	=> $prefix.'posttypeslider_transition_speed', 
		'type'	=> 'text_small',
		'default' => '400',
		'attributes' => array(
			'type'  => 'number',
			'min'  => '100',
			'max'  => '1200',
			'step'  => '10'
		),
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-animate-out',
		'after_row' => '</div>'
	) );
	$posttypeslider_slider_options->add_field( array(
		'name'	=> esc_html__('Animation In', 'halena' ),
		'id'	=> $prefix.'posttypeslider_animate_in',
		'type'	=> 'select',
		'options' => array( 
			'fadeIn' => esc_html__('fadeIn', 'halena' ), 
			'fadeInDown' => esc_html__('fadeInDown', 'halena' ),
			'fadeInRight' => esc_html__('fadeInRight', 'halena' ),
			'fadeInLeft' => esc_html__('fadeInLeft', 'halena' ),
			'fadeInUp' => esc_html__('fadeInUp', 'halena' ),
			'flipInX' => esc_html__('flipInX', 'halena' ),
			'slideInUp' => esc_html__('slideInUp', 'halena' ),
			'slideInDown' => esc_html__('slideInDown', 'halena' ),
			'slideInLeft' => esc_html__('slideInLeft', 'halena' ),
			'slideInRight' => esc_html__('slideInRight', 'halena' ),
			'zoomIn' => esc_html__('zoomIn', 'halena' ),
		),
		'default' => 'slideInRight',
		'row_classes' => 'agni-slide-col agni-slide-animate-in',
		'before_row' => '<div class="cmb-row agni-slide-row agni-slide-animate-container">'
	) );
	$posttypeslider_slider_options->add_field( array(
		'name'	=> esc_html__('Animation Out', 'halena' ),
		'id'	=> $prefix.'posttypeslider_animate_out',
		'type'	=> 'select',
		'options' => array( 
			'fadeOut' => esc_html__('fadeOut', 'halena' ), 
			'fadeOutDown' => esc_html__('fadeOutDown', 'halena' ),
			'fadeOutRight' => esc_html__('fadeOutRight', 'halena' ),
			'fadeOutLeft' => esc_html__('fadeOutLeft', 'halena' ),
			'fadeOutUp' => esc_html__('fadeOutUp', 'halena' ),
			'flipOutX' => esc_html__('flipOutX', 'halena' ),
			'slideOutUp' => esc_html__('slideOutUp', 'halena' ),
			'slideOutDown' => esc_html__('slideOutDown', 'halena' ),
			'slideOutLeft' => esc_html__('slideOutLeft', 'halena' ),
			'slideOutRight' => esc_html__('slideOutRight', 'halena' ),
			'zoomOut' => esc_html__('zoomOut', 'halena' ),
		),
		'default' => 'slideOutLeft',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-animate-out',
		'after_row' => '</div>'
	) );
	$posttypeslider_slider_options->add_field( array(
		'name'	=> esc_html__('Navigation Arrows', 'halena' ),
		'id'	=> $prefix.'posttypeslider_navigation',
		'type'	=> 'checkbox',
	) );
	$posttypeslider_slider_options->add_field( array(
		'name'	=> esc_html__('Pagination Dots', 'halena' ),
		'id'	=> $prefix.'posttypeslider_pagination',
		'type'	=> 'checkbox',
	) );
	$posttypeslider_slider_options->add_field( array(
		'name'	=> esc_html__('Mouse Drag', 'halena' ),
		'id'	=> $prefix.'posttypeslider_mousedrag',
		'type'	=> 'checkbox',
	) );
	
}


add_action( 'cmb2_init', 'agni_team_member_meta' );
/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_init' hook.
 */
function agni_team_member_meta() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = 'member_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$team_member_option = new_cmb2_box( array(
		'id'            => $prefix . 'team_member',
		'title'         => esc_html__( 'Team Members', 'halena' ),
		'object_types'  => array( 'team' ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
	) );	
		
	$team_member_option->add_field( array( 
		'name'	=> esc_html__('Image/photo', 'halena' ), 
		'id'	=> $prefix.'image_url', 
		'type'	=> 'file',
	) );

	$team_member_option->add_field( array( 
		'name'	=> esc_html__('Hash Navigation Thumbnail', 'halena' ), 
		'id'	=> $prefix.'hash_image_url', 
		'type'	=> 'file',
	) );
	
	$team_member_option->add_field( array( 
		'name'	=> esc_html__('Name', 'halena' ),  
		'id'	=> $prefix.'name', 
		'type'	=> 'text_small',
	) );
	
	$team_member_option->add_field( array( 
		'name'	=> esc_html__('Link for Name', 'halena' ),  
		'id'	=> $prefix.'name_link', 
		'type'	=> 'text_url',
	) );
	
	$team_member_option->add_field( array( 
		'name'	=> esc_html__('Designation', 'halena' ),  
		'id'	=> $prefix.'designation', 
		'type'	=> 'text_small',
	) );
	$team_member_option->add_field( array( 
		'name'	=> esc_html__('Divide Line', 'halena' ),
		'id'	=> $prefix.'line',
		'type'	=> 'checkbox',
	) );
	$team_member_option->add_field( array(
		'name'=> esc_html__('Description', 'halena'),
		'desc'  => esc_html__('Additional information about the member', 'halena'),
		'id'    => $prefix.'description',
		'type'  => 'textarea_small'
	) );
	$team_member_option->add_field( array(
		'name'=> esc_html__('Facebook', 'halena'),
		'desc'  => esc_html__('Facebook link', 'halena'),
		'id'    => $prefix.'facebook_link',
		'type'  => 'text_url'
	) );
	
	$team_member_option->add_field( array(
		'name'=> esc_html__('Twitter', 'halena'),
		'id'    => $prefix.'twitter_link',
		'type'  => 'text_url'
	) );
	
	$team_member_option->add_field( array(
		'name'=> esc_html__('Google Plus', 'halena'),
		'id'    => $prefix.'google_plus_link',
		'type'  => 'text_url'
	) );
	$team_member_option->add_field( array(
		'name'=> esc_html__('VK', 'halena'),
		'id'    => $prefix.'vk_link',
		'type'  => 'text_url'
	) );
	$team_member_option->add_field( array(
		'name'=> esc_html__('Behance', 'halena'),
		'id'    => $prefix.'behance_link',
		'type'  => 'text_url'
	) );
	$team_member_option->add_field( array(
		'name'=> esc_html__('Pinterest', 'halena'),
		'id'    => $prefix.'pinterest_link',
		'type'  => 'text_url'
	) );
	$team_member_option->add_field( array(
		'name'=> esc_html__('Dribbble', 'halena'),
		'id'    => $prefix.'dribbble_link',
		'type'  => 'text_url'
	) );
	$team_member_option->add_field( array(
		'name'=> esc_html__('Skype', 'halena'),
		'id'    => $prefix.'skype_link',
		'type'  => 'text_small'
	) );
	$team_member_option->add_field( array(
		'name'=> esc_html__('Linkedin', 'halena'),
		'id'    => $prefix.'linkedin_link',
		'type'  => 'text_url'
	) );
	$team_member_option->add_field( array(
		'name'=> esc_html__('Email', 'halena'),
		'id'    => $prefix.'envelope_link',
		'type'  => 'text_email',
	) );
	$team_member_option->add_field( array(
		'name'=> esc_html__('Phone/Mobile Number', 'halena'),
		'id'    => $prefix.'number',
		'type'  => 'text_small'
	) );
	
}

add_action( 'cmb2_init', 'agni_clients_meta' );
/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_init' hook.
 */
function agni_clients_meta() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = 'clients_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$clients_option = new_cmb2_box( array(
		'id'            => $prefix . 'clients',
		'title'         => esc_html__( 'Clients', 'halena' ),
		'object_types'  => array( 'clients' ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
	) );	
		
	$clients_option->add_field( array( 
		'name'	=> esc_html__('Image/photo', 'halena' ), 
		'id'	=> $prefix.'image', 
		'type'	=> 'file',
	) );
	
	$clients_option->add_field( array( 
		'name'	=> esc_html__('Link for Image', 'halena' ),  
		'id'	=> $prefix.'image_link', 
		'type'	=> 'text_url',
	) );
}
	
add_action( 'cmb2_init', 'agni_testimonials_meta' );
/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_init' hook.
 */
function agni_testimonials_meta() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = 'testimonial_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$testimonials_option = new_cmb2_box( array(
		'id'            => $prefix . 'testimonials',
		'title'         => esc_html__( 'Testimonials', 'halena' ),
		'object_types'  => array( 'testimonials' ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
	) );	
		
	$testimonials_option->add_field( array( 
		'name'	=> esc_html__('Avatar of author', 'halena' ), 
		'id'	=> $prefix.'image', 
		'type'	=> 'file',
	) );
	
	$testimonials_option->add_field( array(
		'name'=> esc_html__('Testimonial Text', 'halena'),
		'desc'  => esc_html__('quote said by the author..', 'halena'),
		'id'    => $prefix.'quote',
		'type'  => 'textarea_small'
	) );
	
	$testimonials_option->add_field( array(
		'name'=> esc_html__('Author Name', 'halena'),
		'id'    => $prefix.'author',
		'type'  => 'text_small'
	) );
	$testimonials_option->add_field( array(
		'name'=> esc_html__('Author Designation', 'halena'),
		'id'    => $prefix.'author_designation',
		'type'  => 'text_small'
	) );
}
