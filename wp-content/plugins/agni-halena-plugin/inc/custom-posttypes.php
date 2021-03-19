<?php

/*
 * Custom post type portfolio
 */
 
 if( !function_exists( 'register_portfolio_posttype' ) ){
	function register_portfolio_posttype() {
		global $halena_options;

		$portfolio_slug = 'portfolio';
		if( !empty($halena_options['portfolio-posttype-slug']) ){
			$portfolio_slug = $halena_options['portfolio-posttype-slug'];
		}
		$portfolio_archive = true;
		if( !empty( $halena_options['portfolio-posttype-archive'] ) ){
			$portfolio_archive = $halena_options['portfolio-posttype-archive'];
		}

		$labels = array(
			'name'                => _x( 'Portfolio', 'Portfolio General Name', 'agni-halena-plugin' ),
			'singular_name'       => _x( 'Portfolio', 'Portfolio Singular Name', 'agni-halena-plugin' ),
			'menu_name'           => __( 'Portfolio', 'agni-halena-plugin' ),
			'parent_item_colon'   => __( 'Parent Item:', 'agni-halena-plugin' ),
			'all_items'           => __( 'All Items', 'agni-halena-plugin' ),
			'view_item'           => __( 'View Item', 'agni-halena-plugin' ),
			'add_new_item'        => __( 'Add New Item', 'agni-halena-plugin' ),
			'add_new'             => __( 'Add New', 'agni-halena-plugin' ),
			'edit_item'           => __( 'Edit Item', 'agni-halena-plugin' ),
			'update_item'         => __( 'Update Item', 'agni-halena-plugin' ),
			'search_items'        => __( 'Search Item', 'agni-halena-plugin' ),
			'not_found'           => __( 'Not found', 'agni-halena-plugin' ),
			'not_found_in_trash'  => __( 'Not found in Trash', 'agni-halena-plugin' ),
		);
		$post_type_args = array(
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'thumbnail', 'comments', 'page-attributes' ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'menu_icon'           => 'dashicons-portfolio',
			'can_export'          => true,
			'has_archive'         => $portfolio_archive,
			'rewrite' 			=> array( 'slug' => $portfolio_slug, 'with_front' => false ),
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
			'show_in_rest' 		  => true,
		);
		register_post_type( 'portfolio', $post_type_args );

	}

	// Hook into the 'init' action
	add_action( 'init', 'register_portfolio_posttype');

	register_taxonomy('types', array('portfolio'), array('hierarchical' => true, 'label' => 'Portfolio Categories', 'singular_label' => 'Category', 'show_ui' => true, 'show_admin_column' => true, 'query_var' => true, 'rewrite' => true));

}

/**
 * Block Custom Post Type
 */ 
 if( !function_exists( 'register_block_posttype' ) ){
    function register_block_posttype() {
        $labels = array(
            'name'              => _x( 'Blocks', 'post type general name','agni-halena-plugin' ),
            'singular_name'     => _x( 'Block', 'post type singular name','agni-halena-plugin' ),
            'add_new'           => __( 'Add New Block','agni-halena-plugin' ),
            'add_new_item'      => __( 'Add New Block','agni-halena-plugin' ),
            'all_items'         => __( 'All Blocks','agni-halena-plugin' ),
            'edit_item'         => __( 'Edit Block','agni-halena-plugin' ),
            'new_item'          => __( 'New Block','agni-halena-plugin' ),
            'view_item'         => __( 'View Block','agni-halena-plugin' ),
            'search_items'      => __( 'Search Blocks','agni-halena-plugin' ),
            'not_found'         => __( 'Block','agni-halena-plugin' ),
            'not_found_in_trash'=> __( 'Block','agni-halena-plugin' ),
            'parent_item_colon' => __( 'Block','agni-halena-plugin' ),
            'menu_name'         => __( 'Blocks','agni-halena-plugin' )
        );
        
        $taxonomies = array();
        
        
        $post_type_args = array(
            'labels'            => $labels,
            'singular_label'    => __( 'Block','agni-halena-plugin' ),
            'public'            => true,
            'show_ui'           => true,
            'show_in_nav_menus' => false,
            'publicly_queryable'=> true,
            'query_var'         => true,
            'capability_type'   => 'page',
            'has_archive'       => false,
            'hierarchical'      => false,
            'exclude_from_search' => true,
            'rewrite'           => array('slug' => 'agni_block', 'with_front' => false  ),
            'supports'          => array('title', 'editor'),
            'menu_position'     => 6, // Where it is in the menu. Change to 6 and it's below posts. 11 and it's below media, etc.
            'menu_icon'         => 'dashicons-layout',
            'taxonomies'        => $taxonomies,
			'show_in_rest' 		  => true,
         );
         register_post_type('agni_block',$post_type_args);
    }
    add_action('init', 'register_block_posttype');

	register_taxonomy('block_types', array('agni_block'), array('hierarchical' => true, 'label' => 'Block Categories', 'singular_label' => 'Category', 'show_ui' => true, 'show_admin_column' => true, 'query_var' => true, 'rewrite' => true));
}


/**
 * Agni Slider Post Type
 */	
 if( !function_exists( 'register_slides_posttype' ) ){
	function register_slides_posttype() {
		$labels = array(
			'name' 				=> _x( 'Sliders', 'post type general name','agni-halena-plugin' ),
			'singular_name'		=> _x( 'Slider', 'post type singular name','agni-halena-plugin' ),
			'add_new' 			=> __( 'Add New Slider','agni-halena-plugin' ),
			'add_new_item' 		=> __( 'Add New Slider','agni-halena-plugin' ),
			'all_items' 		=> __( 'All Sliders','agni-halena-plugin' ),
			'edit_item' 		=> __( 'Edit Slider','agni-halena-plugin' ),
			'new_item' 			=> __( 'New Slider','agni-halena-plugin' ),
			'view_item' 		=> __( 'View Slider','agni-halena-plugin' ),
			'search_items' 		=> __( 'Search Sliders','agni-halena-plugin' ),
			'not_found' 		=> __( 'Slider','agni-halena-plugin' ),
			'not_found_in_trash'=> __( 'Slider','agni-halena-plugin' ),
			'parent_item_colon' => __( 'Slider','agni-halena-plugin' ),
			'menu_name'			=> __( 'Agni Slider','agni-halena-plugin' )
		);
		
		$taxonomies = array();
		
		
		$post_type_args = array(
			'labels' 			=> $labels,
			'singular_label' 	=> __('Slide','agni-halena-plugin'),
			'public' 			=> true,
			'show_ui' 			=> true,
			'show_in_nav_menus'	=> false,
			'publicly_queryable'=> true,
			'query_var'			=> true,
			'capability_type' 	=> 'post',
			'has_archive' 		=> false,
			'hierarchical' 		=> false,
			'rewrite' 			=> array('slug' => 'agni_slides', 'with_front' => false  ),
			'supports' 			=> array('title', 'author'),
			'menu_position' 	=> 6, // Where it is in the menu. Change to 6 and it's below posts. 11 and it's below media, etc.
			'menu_icon' 		=> 'dashicons-images-alt',
			'taxonomies'		=> $taxonomies
		 );
		 register_post_type('agni_slides',$post_type_args);
	}
	add_action('init', 'register_slides_posttype');
}

function agni_flush_rewrite_rules()
{
	flush_rewrite_rules();
}
add_action('after_theme_switch', 'agni_flush_rewrite_rules');

