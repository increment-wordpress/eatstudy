<?php 
/**
 * Theme functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package Agni Framework
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
function agni_framework_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'agni_framework_content_width', 960 );
}
add_action( 'after_setup_theme', 'agni_framework_content_width', 0 );

/**
 * Loading Custom theme functions.
 */
function halena_setup() {
    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support( 'post-thumbnails' );
    add_image_size( 'halena-standard-thumbnail', 960, 0, true );
    add_image_size( 'halena-post-thumbnail', 960, 520, true );

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus( array(
        'primary' => esc_html__( 'Primary Menu', 'halena' ),
        'quaternary' => esc_html__( 'Additional primary Menu', 'halena' ),
        'secondary' => esc_html__( 'Top Bar Menu', 'halena' ),
        'ternary' => esc_html__( 'Footer Menu', 'halena' ),
    ) );

}
add_action( 'init', 'halena_setup', 2 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function halena_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'halena' ),
        'id'            => 'halena-sidebar-1',
        'description'   => 'Main widget location that could appear on the left/right of all blog posts.',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h6 class="widget-title">',
        'after_title'   => '</h6>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer bar', 'halena' ),
        'id'            => 'halena-footerbar-1'
    ) );
}
add_action( 'widgets_init', 'halena_widgets_init' );

function halena_footer_widgets_init() {

    global $halena_options;
    $col = 'col-md-4';
    if( !empty($halena_options['footer-col']) ){
        switch($halena_options['footer-col']){
            case '2':
                $col = 'col-xs-12 col-sm-12 col-md-6';
                break;
            case '3':
                $col = 'col-xs-12 col-sm-6 col-md-4';
                break;
            case '4':
                $col = 'col-xs-12 col-sm-6 col-md-3';
                break;
            case '5':
                $col = 'col-xs-12 col-sm-4 col-md-3 col-lg-2_5';
                break;
            case '6':
                $col = 'col-xs-12 col-sm-4 col-md-3 col-lg-2';
                break;
        }
    }
    register_sidebar( array(
        'name'          => esc_html__( 'Footer bar', 'halena' ),
        'id'            => 'halena-footerbar-1',
        'description'   => 'Additional Widget location that could appear at the bottom of the pages.',
        'before_widget' => '<aside id="%1$s" class="'.$col.' widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h6 class="widget-title">',
        'after_title'   => '</h6>',
    ) );
}
add_action( 'redux/loaded', 'halena_footer_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function halena_iconfont_styles(){
    // Enqueue 3rd party CSS
    wp_enqueue_style( 'ionicons', AGNI_FRAMEWORK_CSS_URL . '/ionicons.min.css', array(), '2.0.1' );
    wp_enqueue_style( 'font-awesome', AGNI_FRAMEWORK_CSS_URL . '/font-awesome.min.css', array(), '4.7.0' );
    wp_enqueue_style( 'pe-stroke', AGNI_FRAMEWORK_CSS_URL . '/Pe-icon-7-stroke.min.css', array(), '1.2.0' );
    wp_enqueue_style( 'pe-filled', AGNI_FRAMEWORK_CSS_URL . '/Pe-icon-7-filled.min.css', array(), '1.2.0' );
    wp_enqueue_style( 'linea-arrows', AGNI_FRAMEWORK_CSS_URL . '/linea-arrows.min.css', array(), '1.0' );
    wp_enqueue_style( 'linea-basic', AGNI_FRAMEWORK_CSS_URL . '/linea-basic.min.css', array(), '1.0' );
    wp_enqueue_style( 'linea-elaboration', AGNI_FRAMEWORK_CSS_URL . '/linea-elaboration.min.css', array(), '1.0' );
    wp_enqueue_style( 'linea-ecommerce', AGNI_FRAMEWORK_CSS_URL . '/linea-ecommerce.min.css', array(), '1.0' );
    wp_enqueue_style( 'linea-software', AGNI_FRAMEWORK_CSS_URL . '/linea-software.min.css', array(), '1.0' );
    wp_enqueue_style( 'linea-music', AGNI_FRAMEWORK_CSS_URL . '/linea-music.min.css', array(), '1.0' );
    wp_enqueue_style( 'linea-weather', AGNI_FRAMEWORK_CSS_URL . '/linea-weather.min.css', array(), '1.0' );
}
add_action( 'wp_enqueue_scripts', 'halena_iconfont_styles' );

function halena_scripts() {
    global $halena_options;

    $halena_options_vc_elements = isset( $halena_options['vc_elements'] ) ? $halena_options['vc_elements'] : '0';
    $halena_options_gmap_api = isset( $halena_options['gmap-api'] ) ? $halena_options['gmap-api'] : '';
    $halena_options_google_addtional_fonts = isset( $halena_options['google-font-additional'] ) ? $halena_options['google-font-additional'] : '';

    $gmap_api = !empty($halena_options_gmap_api) ? '?key='.$halena_options_gmap_api:'';

    // Deregister vc style
    if( $halena_options_vc_elements == '0' ){
        // wp_deregister_style( 'js_composer_front' ); 
    }

    // Enqueue CSS
    wp_enqueue_style( 'halena-animate-style', AGNI_FRAMEWORK_CSS_URL . '/animate.css' );
    wp_enqueue_style( 'halena-bootstrap', AGNI_FRAMEWORK_CSS_URL . '/halena.css' );
    wp_enqueue_style( 'halena-agni-vc-styles', AGNI_FRAMEWORK_CSS_URL . '/agni-vc-styles.css', array(), wp_get_theme()->get('Version')  );
    wp_enqueue_style( 'halena-style', get_stylesheet_uri(), array(), wp_get_theme()->get('Version') );
    wp_enqueue_style( 'halena-responsive', AGNI_FRAMEWORK_CSS_URL . '/responsive.css', array(), wp_get_theme()->get('Version')  );

    // Register CSS
    wp_register_style( 'halena-beforeafter-style', AGNI_FRAMEWORK_CSS_URL . '/before-after.min.css', array(), wp_get_theme()->get('Version') );
    wp_register_style( 'halena-cd-animated-headlines-style', AGNI_FRAMEWORK_CSS_URL . '/cd-animated-headlines.min.css', array(), wp_get_theme()->get('Version') );

    wp_register_style( 'halena-photoswipe-style', AGNI_FRAMEWORK_CSS_URL . '/photoswipe.css', array(), wp_get_theme()->get('Version') );
    wp_register_style( 'halena-scalize-style', AGNI_FRAMEWORK_CSS_URL . '/scalize.css', array(), wp_get_theme()->get('Version') );
    wp_register_style( 'halena-select2-style', AGNI_FRAMEWORK_CSS_URL . '/select2.min.css', array(), wp_get_theme()->get('Version') );
    wp_register_style( 'halena-threesixty-style', AGNI_FRAMEWORK_CSS_URL . '/threesixty.css', array(), wp_get_theme()->get('Version') );
    wp_register_style( 'halena-slick-style', AGNI_FRAMEWORK_CSS_URL . '/slick.css', array(), wp_get_theme()->get('Version') );

    if( !empty($halena_options_google_addtional_fonts) ){
        wp_enqueue_style( 'halena-google-fonts-additional', '//fonts.googleapis.com/css?family='.$halena_options_google_addtional_fonts );
    }

    // Enqueue JS
    wp_enqueue_script( 'halena-plugins-script', AGNI_FRAMEWORK_JS_URL . '/halena-plugins.js', array( 'jquery' ), wp_get_theme()->get('Version'), true );
    wp_enqueue_script( 'halena-script', AGNI_FRAMEWORK_JS_URL . '/script.js', array( 'jquery', 'halena-plugins-script' ), wp_get_theme()->get('Version'), true );

    // Register JS
    wp_register_script( 'halena-mbytplayer-script', AGNI_FRAMEWORK_JS_URL . '/jquery.mb.YTPlayer.min.js', array( 'jquery' ), '', true );
    wp_register_script( 'halena-mbvimeoplayer-script', AGNI_FRAMEWORK_JS_URL . '/jquery.mb.vimeo_player.min.js', array( 'jquery' ), '', true );
    wp_register_script( 'halena-infinitescroll-script', AGNI_FRAMEWORK_JS_URL . '/infinite-scroll.pkgd.min.js', array( 'jquery' ), '', true );
    wp_register_script( 'halena-beforeafter-script', AGNI_FRAMEWORK_JS_URL . '/before-after.min.js', array( 'jquery' ), '', true );
    wp_register_script( 'halena-isotope-script', AGNI_FRAMEWORK_JS_URL . '/isotope.pkgd.min.js', array( 'jquery' ), '', true );
    wp_register_script( 'halena-countup-script', AGNI_FRAMEWORK_JS_URL . '/countUp.min.js', array( 'jquery' ), '', true );
    wp_register_script( 'halena-easypiechart-script', AGNI_FRAMEWORK_JS_URL . '/easyPieChart.min.js', array( 'jquery' ), '', true );
    wp_register_script( 'halena-countdown-script', AGNI_FRAMEWORK_JS_URL . '/countdown.min.js', array( 'jquery' ), '', true );
    wp_register_script( 'halena-cd-animated-headlines-script', AGNI_FRAMEWORK_JS_URL . '/cd-animated-headlines.min.js', array( 'jquery' ), '', true );
    wp_register_script( 'halena-particleground-script', AGNI_FRAMEWORK_JS_URL . '/particleground.min.js', array( 'jquery' ), '', true );
    wp_register_script( 'halena-gradientmap-script', AGNI_FRAMEWORK_JS_URL . '/gradientmap.min.js', array( 'jquery' ), '', true );
    wp_register_script( 'halena-vivus-script', AGNI_FRAMEWORK_JS_URL . '/vivus.min.js', array( 'jquery' ), '', true );

    wp_register_script( 'halena-photoswipe-script', AGNI_FRAMEWORK_JS_URL . '/photoswipe.min.js', array( 'jquery' ), '4.1.2', true );
    wp_register_script( 'halena-scalize-script', AGNI_FRAMEWORK_JS_URL . '/scalize.js', array( 'jquery' ), '', true );
    wp_register_script( 'halena-select2-script', AGNI_FRAMEWORK_JS_URL . '/select2.min.js', '', '4.0.3', true );
    wp_register_script( 'halena-threesixty-script', AGNI_FRAMEWORK_JS_URL . '/threesixty.min.js', array( 'jquery' ), wp_get_theme()->get('Version'), true );
    wp_register_script( 'halena-slick-script', AGNI_FRAMEWORK_JS_URL . '/slick.min.js', array( 'jquery' ), wp_get_theme()->get('Version'), true );
    wp_register_script( 'halena-woocommerce-easyzoom', AGNI_FRAMEWORK_JS_URL . '/easyzoom.min.js', array(), wp_get_theme()->get('Version'), true );
    wp_register_script( 'js-cookie', AGNI_FRAMEWORK_JS_URL . '/js.cookie.js', '', '2.2.0', true );

    wp_register_script( 'googleapi', '//maps.google.com/maps/api/js'.$gmap_api );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'halena_scripts' );

function halena_admin_scripts() {

    wp_deregister_style( 'font-awesome' );
    wp_deregister_style( 'vc_openiconic' );
    wp_deregister_style( 'vc_typicons' );
    wp_deregister_style( 'vc_entypo' );
    wp_deregister_style( 'vc_linecons' );
    wp_deregister_style( 'vc_monosocialiconsfont' );

    // vc_style
    wp_enqueue_style( 'halena-admin-style', AGNI_THEME_FILES_URL . '/assets/css/admin.css' );
    if( is_rtl() ){
        wp_enqueue_style( 'halena-admin-rtl-style', AGNI_THEME_FILES_URL . '/assets/css/admin-rtl.css' );
    }

    wp_enqueue_script( 'halena-admin-script', AGNI_FRAMEWORK_JS_URL . '/halena-admin.js', array(), wp_get_theme()->get('Version'), true );
}
add_action( 'admin_enqueue_scripts', 'halena_admin_scripts' );

add_action( 'admin_enqueue_scripts', 'halena_iconfont_styles' );

/**
 * Custom Redux Framework Option panel 
 */
function agni_get_default_theme_options(){

    global $halena_options;

    include AGNI_FRAMEWORK_DIR . '/template/theme_options_defaults.php';

    if( !class_exists( 'AgniHalenaPlugin' ) ){
        $halena_options = apply_filters( 'agni_theme_options_defaults', '' );
    }
}
add_action( 'init', 'agni_get_default_theme_options' );

/**
 * Custom Redux Framework Option panel 
 */
function agni_custom_redux_options(){
    require AGNI_FRAMEWORK_DIR . '/template/custom-redux-options.php';
}
add_action( 'init', 'agni_custom_redux_options' );

/**
 * Redirect to Theme Admin Panel
 */
function agni_theme_activation_redirect() {
    header( 'Location:' . admin_url() . 'admin.php?page=halena' );
}
add_action( 'after_switch_theme', 'agni_theme_activation_redirect' );

/**
 * Register a custom menu page Admin panel.
 */
function agni_admin_menu() {
    if ( current_user_can( 'edit_theme_options' ) ) {
        add_menu_page( 'Halena', 'Halena', 'edit_theme_options', 'halena', 'agni_admin_menu_welcome_page', AGNI_FRAMEWORK_URL  . '/img/halena_options.png', 58  );
        add_submenu_page( 'halena', esc_html__( 'Admin Panel', 'halena' ), esc_html__( 'Welcome', 'halena' ), 'edit_theme_options', 'halena', '' );
    }
}
add_action( 'admin_menu', 'agni_admin_menu' );


/**
 * Admin panel function.
 */
function agni_admin_menu_welcome_page(){
    include ( AGNI_THEME_FILES_DIR . '/admin/agni-welcome-page.php' );
}
function agni_admin_menu_import_demo(){
    return false;
}


/**
 * Post Excerpt
 */
if( !function_exists('agni_excerpt_length') ){
    function agni_excerpt_length( $charlength = null, $readmore = false ) {
        $excerpt = get_the_excerpt();
        $charlength++;

        if ( mb_strlen( $excerpt ) > $charlength ) {
            $subex = mb_substr( $excerpt, 0, $charlength - 5 );
            $exwords = explode( ' ', $subex );
            $excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
            if ( $excut < 0 ) {
                $excerpt = mb_substr( $subex, 0, $excut );
            } else {
                $excerpt = $subex;
            }
            if( $readmore == true ){
                $readmore = '<p><a class="more-link" href="'. get_permalink( get_the_ID() ) . '">' . esc_html__( 'Read More', 'halena') . '</a></p>';
                $excerpt =  $excerpt.$readmore;
            }
        } 
        return $excerpt;
    }
}

/**
 * Page Navigation
 */
if( !function_exists('agni_page_navigation') ){
    function agni_page_navigation( $query, $nav_type ) {
        global $wp_query;
        if( $query == '' ){
            $query = $wp_query;
        }

        if( get_query_var('paged') != '' ){
            $paged = get_query_var('paged');
        }
        elseif( get_query_var('page') != '' ){
            $paged = get_query_var('page');
        }
        else{
            $paged = 1;
        }
        $pages = paginate_links( array(
            'base'         => esc_url_raw( str_replace( 999999999, '%#%', get_pagenum_link( 999999999, false ) ) ), 
            'format'       => '',
            'add_args'     => '',
            'current'      => max( 1, $paged ),
            'total'        => $query->max_num_pages,
            'prev_next'    => true,
            'prev_text'    => wp_kses( __('<i class="pe-7s-angle-left"></i>', 'halena'), array( 'i' => array( 'class' => array() ) ) ),
            'next_text'    => wp_kses( __('<i class="pe-7s-angle-right"></i>', 'halena'), array( 'i' => array( 'class' => array() ) ) ),
            'type'         => 'list',
            'end_size'     => 1,
            'mid_size'     => 1
        ) );
        $output =  '<div class="'.$nav_type.' page-number-navigation navigation text-center">'.$pages.'</div>';
        return $output;
    }
}

/**
 * Portfolio Thumbnail Custom Crop
 */
if( !function_exists('agni_thumbnail_customcrop') ){
    function agni_thumbnail_customcrop( $img_id = null, $img_size = null, $img_class = null ){
        $portfolio_thumbnail = '';
        if( function_exists('wpb_getImageBySize') ){
            $img = wpb_getImageBySize( array(
                'attach_id' => $img_id,
                'thumb_size' => $img_size,
                'class' => $img_class.' attachment-'.$img_size
            ) );
            $portfolio_thumbnail = $img['thumbnail'];
        }   
        return $portfolio_thumbnail;
    }
}

/**
 * Portfolio filter
 */
if( !function_exists('agni_portfolio_filter') ){
    function agni_portfolio_filter( $term_order, $term_orderby, $filter_all_text ){
        global $halena_options, $category;
        $output = '';
        $categories = explode( ',', $category );
        $terms = get_terms( 'types', array( 'orderby' => $term_orderby, 'order' => $term_order ) );
        $count = count($terms);
        $output .= '<span class="filter-button" ><i class="pe-7f-filter"></i></span><ul id="filters" class="filter list-inline">';
        $output .= '<li><a class="active" href="#all" data-filter=".all" title="'.$filter_all_text.'">'.$filter_all_text.'</a></li>';
        if ( $count > 0 ){   
            foreach ( $terms as $term ) {   
                foreach ($categories as $cat) {
                    if(empty($cat)){ 
                        $termslug = strtolower($term->slug);
                        $output .= '<li><a href="#'.$termslug.'" data-filter=".'.$termslug.'" title="'.$term->name.'">'.$term->name.'</a></li>';
                    }
                    else if( $cat == $term->slug ){
                        $termslug = strtolower($term->slug);
                        $output .= '<li><a href="#'.$termslug.'" data-filter=".'.$termslug.'" title="'.$term->name.'">'.$term->name.'</a></li>';
                    }
                }
            }
        }
        $output .= '</ul>';
        return $output;
    }
}

/*
 * Breadcrumbs
 */
if( !function_exists('agni_breadcrumb_navigation') ){
    function agni_breadcrumb_navigation() {
        $delimiter = ' / ';
        $home = esc_html( get_bloginfo('name') );
        $before = '<span>';
        $after = '</span>';
        
        echo '<p class="breadcrumb">';
        
        global $post;
        
        $homeLink = esc_url( home_url( '/' ) );

        echo '<a href="' . $homeLink . '">'.esc_html__( 'Home', 'halena' ).'</a> ' . $delimiter .' ';

        if ( is_category() ) {
            global $wp_query;
            $cat_obj = $wp_query->get_queried_object();
            $thisCat = $cat_obj->term_id;
            $thisCat = get_category($thisCat);
            $parentCat = get_category($thisCat->parent);
            if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
            echo wp_kses_post( $before . single_cat_title('', false)  . $after );
        } elseif ( is_day() ) {
            echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
            echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
            echo wp_kses_post( $before  . get_the_time('d')  . $after );
        } elseif ( is_month() ) {
            echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
            echo wp_kses_post( $before  . get_the_time('F')  . $after );
        } elseif ( is_year() ) {
            echo wp_kses_post( $before . get_the_time('Y')  . $after );
        } elseif ( is_single() && !is_attachment() ) {
            if ( get_post_type() != 'post' ) {
                $post_type = get_post_type_object(get_post_type());
                $slug = $post_type->rewrite;
                echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>' . $delimiter . ' ';
                echo wp_kses_post( $before . get_the_title() . $after );
            } else {
                $cat = get_the_category(); $cat = $cat[0];
                echo ' ' . get_category_parents($cat, TRUE, ' ' . $delimiter . ' ') . ' ';
                echo wp_kses_post( $before  . get_the_title()  . $after );
            }
        } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
            $post_type = get_post_type_object(get_post_type());
            echo wp_kses_post( $before . $post_type->labels->singular_name . $after );
        } elseif ( is_attachment() ) {
            $parent_id  = $post->post_parent;
            $breadcrumbs = array();
            while ($parent_id) {
            $page = get_page($parent_id);
            $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
            $parent_id    = $page->post_parent;
        }
        $breadcrumbs = array_reverse($breadcrumbs);
        foreach ($breadcrumbs as $crumb) echo ' ' . $crumb . ' ' . $delimiter . ' ';
            echo wp_kses_post( $before . get_the_title()  . $after );
        } elseif ( is_page() && !$post->post_parent ) {
            echo wp_kses_post( $before  . get_the_title()  . $after );
        } elseif ( is_page() && $post->post_parent ) {
            $parent_id  = $post->post_parent;
            $breadcrumbs = array();
            while ($parent_id) {
            $page = get_page($parent_id);
            $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
            $parent_id    = $page->post_parent;
        }
        $breadcrumbs = array_reverse($breadcrumbs);
        foreach ($breadcrumbs as $crumb) echo ' ' . $crumb . ' ' . $delimiter . ' ';
            echo wp_kses_post( $before . get_the_title()  . $after );
        } elseif ( is_search() ) {
            echo wp_kses_post( $before . get_search_query()  . $after );
        } elseif ( is_tag() ) {
            echo wp_kses_post( $before. single_tag_title('', false)  . $after );
        } elseif ( is_author() ) {
        global $author;
            $userdata = get_userdata($author);
            echo wp_kses_post( $before . $userdata->display_name  . $after );
        } elseif ( is_404() ) {
            echo wp_kses_post( $before . ' 404 ' . $after );
        }
        if ( get_query_var('paged') ) {
            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
                echo 'Page' . ' ' . get_query_var('paged');
            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
        }
        echo '</p>';
    }
}

/**
 * Getting Posts from the posttype
 */
if( !function_exists('agni_posttype_options') ){
    function agni_posttype_options( $query_args, $empty, $vc = null  ) {
        $post_options = array();
        $args = wp_parse_args( $query_args, array(
            'post_type'   => 'post',
            'numberposts' => -1,
        ) );

        $posts = get_posts( $args );
        if( $empty == true ){
            $post_options = array("" => "");
        }
        if ( $posts ) {
            foreach ( $posts as $post ) {
                if( $vc == true ){
                    $post_options[ $post->post_title ] = $post->ID;
                }else{
                    $post_options[ $post->ID ] = $post->post_title;
                }
            }

        }
        return $post_options;
    }
}

/**
 * Getting Registered Menus
 */
if( !function_exists('agni_registered_menus') ){
    function agni_registered_menus( $empty ) {
        $menu_list = '';
        if( $empty == true ){
            $menu_list = array("" => "Inherit");
        }
        $menus = get_terms('nav_menu', array( 'hide_empty' => true ));
        foreach($menus as $menu){
          $menu_list[ $menu->slug ] = $menu->name;
        } 
        return $menu_list;
    }
}

// New shortcode column for Agni Slider posttype
function agni_agni_slides_columns_head($defaults) {
    $defaults['agni_slides_shortcode'] = 'Shortcode';
    return $defaults;
}
 
function agni_agni_slides_columns_content($column_name) {
    global $post;
    if ($column_name == 'agni_slides_shortcode') {
        echo '<pre><code>[agni_agnislider post_id = '.$post->ID.']</code></pre>';
    }
}

add_filter( 'manage_agni_slides_posts_columns', 'agni_agni_slides_columns_head' );
add_action( 'manage_agni_slides_posts_custom_column', 'agni_agni_slides_columns_content', 10, 1 );

/**
 * Post Format functions
 */

// Video post
if( !function_exists('agni_post_video') ){
    function agni_post_video( $post ){
        $output = '';
        $post_video_url = esc_url( get_post_meta($post, 'post_format_video_url' , true) );
        $post_video_poster = esc_url( get_post_meta($post, 'post_format_video_poster' , true) );
        $post_video_embed_url = get_post_meta($post, 'post_format_video_embed_url' , true);
        
        if(!empty($post_video_url)){
            $output = '<div class="post-video">'.do_shortcode('[video width="740" mp4="'.$post_video_url.'" webm="'.$post_video_url.'" ogv="'.$post_video_url.'" mov="'.$post_video_url.'" poster="'.$post_video_poster.'"][/video]').'</div>';
        }
        elseif(!empty($post_video_embed_url)){
            $output = '<div class="custom-video embed-responsive embed-responsive-16by9">'.$post_video_embed_url.'</div>';
        }
            
        return $output; 
    }
}

// Audio post
if( !function_exists('agni_post_audio') ){
    function agni_post_audio( $post){   
        $output = '';
        $post_audio_url = esc_url( get_post_meta($post, 'post_format_audio_url' , true) );
        if(!empty($post_audio_url)){
            $output = '<div class="post-format-indent">'.do_shortcode('[audio mp3="'.$post_audio_url.'" ogg="'.$post_audio_url.'" wmv="'.$post_audio_url.'" ][/audio]').'</div>';
        }

        return $output; 
    }
}

// Gallery post
if( !function_exists('agni_post_gallery') ){
    function agni_post_gallery($post){
        $post_media_gallery_id = $prefix = $output = '';

        $post_gallery_image = get_post_meta( $post, 'post_format_gallery_image', true );
        
        foreach ( (array) $post_gallery_image as $attachment_id => $attachment_url ) {
            $post_media_gallery_id .= $prefix.$attachment_id;
            $prefix = ',';
        }
        if( !empty($post_media_gallery_id) ){
            $output = do_shortcode('[agni_gallery img_url="'.$post_media_gallery_id.'" type="1" column="1" gap="0" gallery_pagination=""]');
        }
        return $output;
    }
}

// Link post
if( !function_exists('agni_post_link') ){
    function agni_post_link( $post ){
        $output = '';
        $post_link_text = esc_url( get_post_meta($post, 'post_format_link_url' , true) );   
        if( !empty($post_link_text) ){
            $output = '<div class="post-format-indent"><a class="post-format-link additional-heading" href="'.$post_link_text.'">'.$post_link_text.'</a></div>';
        }

        return $output;
    }
}

// Quote post
if( !function_exists('agni_post_quote') ){
    function agni_post_quote( $post ){
        $output = $cite = '';
        $post_quote_text = esc_attr( get_post_meta($post, 'post_format_quote_text' , true) );
        $post_quote_cite = esc_attr( get_post_meta($post, 'post_format_quote_cite' ,true) );
        
        if(!empty($post_quote_cite)){
            $cite = '<cite class="quote-cite ">'.$post_quote_cite.'</cite>';
        }
        if( !empty( $post_quote_text ) ){
            $output = '
                <div class="post-format-indent">
                    <p class="post-format-quote additional-heading">' . $post_quote_text . $cite .'</p>
                </div>
            ';
        }
        return $output;
    }
}

// Detect is svg 
function agni_detect_is_svg_file( $svg_file ){
    return 'svg' === pathinfo($svg_file, PATHINFO_EXTENSION);
}

// Extract svg from file
function agni_extract_svg_from_file( $svg_file, $unique_class = '' ){

    wp_enqueue_script( 'halena-vivus-script' );
    $rand = rand(10000, 99999);
    return '<span id="'.$unique_class.'-'.$rand.'" class="agni-svg-icon header-toggle-icon-svg '.$unique_class.'" data-file="'.$svg_file.'"></span>';
}

// Header Logo SVG
function agni_header_svg_logo($src = null){
    global $halena_options;

    echo agni_extract_svg_from_file( $src, 'header-logo-icon-svg' );
}
add_action( 'agni_header_svg_logo', 'agni_header_svg_logo' );

// WPML Lang bar  
if ( function_exists('icl_object_id') ) {
    function agni_wpml_languages_bar(){
        global $halena_options;
        $languages = icl_get_languages('skip_missing=0');
        $wpml_diplay_options = isset( $halena_options['header-wpml-display-options'] )?$halena_options['header-wpml-display-options']:'1';

        if(1 < count($languages)){
            echo '<div class="header-toggle header-lang-toggle header-wpml-toggle toggle-circled">';
            foreach($languages as $l){
                if( $wpml_diplay_options == '2' ){
                    $label = $l['native_name'];
                }
                else if( $wpml_diplay_options == '3' ){
                    $label = $l['language_code'];
                }
                else if( $wpml_diplay_options == '4' ){
                    $label = '<img src="'.$l['country_flag_url'].'" alt="'.$l['translated_name'].'" />';
                }
                else{
                    $label = $l['translated_name'];
                }
                if($l['active']) echo '<span>'.$label.'</span>';
            }
            echo '<ul>';
            foreach($languages as $l){
                if( $wpml_diplay_options == '2' ){
                    $label = $l['native_name'];
                }
                else if( $wpml_diplay_options == '3' ){
                    $label = $l['language_code'];
                }
                else if( $wpml_diplay_options == '4' ){
                    $label = '<img src="'.$l['country_flag_url'].'" alt="'.$l['translated_name'].'" />';
                }
                else{
                    $label = $l['translated_name'];
                }
                if(!$l['active']) echo '<li><a href="'.$l['url'].'">'.$label.'</a></li>';
            }
            echo '</ul></div>';
        }
    }
}

// Additional Classes
if( !function_exists('agni_additional_body_classes') ){
    function agni_additional_body_classes( $classes ) {
        global $halena_options;

        $page_id = get_the_ID();
        if( function_exists('is_shop') && is_shop() ){
            $page_id = wc_get_page_id('shop');
        }

        $page_dark_mode = esc_attr( get_post_meta( $page_id, 'page_dark_mode', true ) );
        
        if( isset($halena_options['layout-padding']) && $halena_options['layout-padding'] == '1' ){ $classes[] = 'has-padding'; }
        if( isset($halena_options['header-menu-style']) && $halena_options['header-menu-style'] == 'side-header-menu' ){ $classes[] = 'has-side-header'; }
        if( $page_dark_mode == '' ){
            $page_dark_mode = ( isset($halena_options['dark-mode']) && $halena_options['dark-mode'] == '1' )?'1':'';
        }
        if( $page_dark_mode == '1' ){ 
            $classes[] = 'has-dark-mode'; 
        }
        if( isset($halena_options['animation-mobile']) && $halena_options['animation-mobile'] == '1' ){ $classes[] = 'has-animation-mobile'; }
        if( isset($halena_options['parallax-mobile']) && $halena_options['parallax-mobile'] == '1' ){ $classes[] = 'has-parallax-mobile'; }
              
        return $classes;
    }
    add_filter( 'body_class','agni_additional_body_classes' );
}

// Agni Backtotop
if( !function_exists('agni_backtotop') ){
    function agni_backtotop(){
        global $halena_options;

        if( isset($halena_options['backtotop']) && $halena_options['backtotop'] == '1' ){ ?>
            <div id="back-to-top" class="back-to-top"><a href="#back-to-top"><i class="<?php echo esc_attr($halena_options['backtotop-icon']); ?>"></i></a></div>
        <?php } 
    }
    add_action( 'agni_backtotop', 'agni_backtotop' );
}

// Agni short notes
if( !function_exists('agni_shortnotes') ){
    function agni_shortnotes($page_id){
        global $halena_options;
        $halena_options['page-agni-shortnote'];

        $page_shortnote =  esc_html( get_post_meta( $page_id, 'page_agni_shortnote', true ) );
        if( empty($page_shortnote) ){
            $page_shortnote = isset($halena_options['page-agni-shortnote'])?$halena_options['page-agni-shortnote']:'';
        }

        if( !empty($page_shortnote) ){ ?>
            <div class="header-short-note">
                <span><?php echo esc_html($page_shortnote); ?></span>
            </div>
        <?php }
    }
    add_action( 'agni_shortnotes', 'agni_shortnotes' );
}

function agni_header_logo(){
    global $halena_options;

    $page_id = get_the_ID();
    if( class_exists('WooCommerce') ){
        if( is_shop() || is_product_category() || is_product_tag() ){
            $page_id = wc_get_page_id('shop');
        }
    }

    // Logo choice  
    $logo_1_class = 'logo-main';
    $logo_2_class = 'logo-additional';
    if( get_post_meta( $page_id, 'page_skin_reverse', true ) == 'on' ){
        $logo_1_class = 'logo-additional';
        $logo_2_class = 'logo-main';
    }

    ?>
    <div class="header-icon <?php if( !empty($halena_options['logo-2']['url']) ){ echo 'header-icon-additional-logo '; }?>">
        <?php  if(!empty($halena_options['logo-1']['url']) && $halena_options['header-site-title'] == '0'){  ?>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo-icon <?php echo esc_attr($logo_1_class); ?>">
                <?php $header_logo_src = !empty($halena_options['logo-1']['id'] )?get_attached_file($halena_options['logo-1']['id']):AGNI_FRAMEWORK_DIR . '/img/halena_logo.svg';  
                if( agni_detect_is_svg_file( $header_logo_src ) ){ ?>
                    <span class="logo-icon-svg"><?php do_action( 'agni_header_svg_logo', $halena_options['logo-1']['url'] ); ?></span>
                <?php } 
                else { ?>
                    <img class="logo-icon-img" src="<?php echo esc_html($halena_options['logo-1']['url']); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
                <?php } ?>
            </a><?php 
        }
        if(!empty($halena_options['logo-2']['url']) && $halena_options['header-site-title'] == '0'){  ?>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo-icon <?php echo esc_attr($logo_2_class); ?>">
                <?php $header_logo_src = !empty($halena_options['logo-2']['id'] )?get_attached_file($halena_options['logo-2']['id']):AGNI_FRAMEWORK_DIR . '/img/halena_logo.svg';  
                if( agni_detect_is_svg_file( $header_logo_src ) ){ ?>
                    <span class="logo-icon-svg"><?php do_action( 'agni_header_svg_logo', $halena_options['logo-2']['url'] ); ?></span>
                <?php } 
                else { ?>
                    <img class="logo-icon-img" src="<?php echo esc_html($halena_options['logo-2']['url']); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
                <?php } ?>
            </a><?php 
        }
        if ($halena_options['header-site-title'] == '1' ) { ?>
            <div class="site-title">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo-text <?php echo esc_attr($logo_1_class); ?>"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></a>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo-text <?php echo esc_attr($logo_2_class); ?>"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></a>
            </div>
            <?php if( $halena_options['logo-description'] == '1' ){ ?>
                <div class="site-description"><?php echo esc_html( get_bloginfo( 'description' ) ); ?></div>
            <?php } ?>
        <?php }  
        else if( !isset($halena_options['header-site-title']) ){ ?>
            <div class="site-title">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo-text"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></a>
            </div>
        <?php } ?>
    </div>
    <?php
}
add_action( 'agni_header_logo', 'agni_header_logo' );


// Header Menu 
function agni_nav_menu( $menu_class, $menu_id, $page_id ){
    $header_custom_menu_disable =  esc_attr( get_post_meta( $page_id, 'page_menu_disable', true ) );
    $header_custom_menu_choice =  esc_attr( get_post_meta( $page_id, 'page_menu_choice', true ) );
    if( $header_custom_menu_disable == '1' ){
        return '';
    }
    echo wp_nav_menu( array( 'menu' => $header_custom_menu_choice, 'menu_class' => $menu_class, 'menu_id' => $menu_id, 'container' => false, 'theme_location' => 'primary', 'fallback_cb'     => 'wp_page_menu' ) ); 
}
add_action( 'agni_nav_menu', 'agni_nav_menu', 10, 3 );

// Header additional primary Menu 
function agni_nav_menu_additional_primary( $menu_class, $menu_id, $page_id ){
    global $halena_options;

    if( $halena_options['header-additional-primary-menu'] == '1' ){ 
        $header_custom_menu_disable =  esc_attr( get_post_meta( $page_id, 'page_menu_disable', true ) );
        $header_custom_menu_choice =  esc_attr( get_post_meta( $page_id, 'page_menu_choice_additional', true ) );
        if( $header_custom_menu_disable == '1' ){
            return '';
        }
        echo wp_nav_menu( array( 'menu' => $header_custom_menu_choice, 'menu_class' => $menu_class, 'menu_id' => $menu_id, 'container' => false, 'theme_location' => 'quaternary', 'fallback_cb'     => 'wp_page_menu' ) ); 
    }
}
add_action( 'agni_nav_menu_additional_primary', 'agni_nav_menu_additional_primary', 10, 3 );

// Header Language box
if( !function_exists('agni_header_lang_box') ){
    function agni_header_lang_box(){
        global $halena_options;

        if( $halena_options['header-lang-box'] == '1' ){ ?>
            <div class="header-toggle header-lang-toggle">
                <?php $header_wishlist_svg_icon = apply_filters( 'agni_header_icon_lang_icon_filter', AGNI_FRAMEWORK_URL . '/img/halena_lang_icon.svg' ); 
                echo agni_extract_svg_from_file( $header_wishlist_svg_icon, $unique_class = 'header-lang-icon-svg' );

                echo wp_specialchars_decode( esc_html($halena_options['header-lang-list']) ); ?>
            </div>
        <?php } 
    }
    add_action( 'agni_header_icons', 'agni_header_lang_box', 10 );
}

// Header Language box
if( function_exists('agni_wpml_languages_bar') ){
    if( !function_exists('agni_header_wpml_box') ){
        function agni_header_wpml_box(){
            global $halena_options;

            if( $halena_options['header-wpml-box'] == '1' ){
                echo agni_wpml_languages_bar(); 
            }
        }
        add_action( 'agni_header_icons', 'agni_header_wpml_box', 11 );
    }
}

// Woocommerce currency switcher
if(class_exists( 'WooCommerce' ) && class_exists( 'WOOCS' )){
    if( !function_exists('agni_woocommerce_currency_box') ){
        function agni_woocommerce_currency_box(){
            global $halena_options;

            if( $halena_options['header-currency-box'] == '1' ){

                global $WOOCS;
                $currencies    = $WOOCS->get_currencies();
                $currency_list = array();
                foreach ( $currencies as $key => $currency ) {
                    if ( $WOOCS->current_currency == $key ) {
                        array_unshift( $currency_list, sprintf( '<li><a href="#" class="woocs_flag_view_item woocs_flag_view_item_current" data-currency="%s">%s</a></li>', esc_attr( $currency['name'] ), esc_html( $currency['name'] ) ) );
                    } else {
                        $currency_list[] = sprintf( '<li><a href="#" class="woocs_flag_view_item" data-currency="%s">%s</a></li>', esc_attr( $currency['name'] ), esc_html( $currency['name'] ) );
                    }
                }
                ?>
                <div class="currency list-dropdown agni-currency-switch header-currency-toggle header-toggle">
                    <span class="current"><?php echo esc_html( $currencies[ $WOOCS->current_currency ]['name'] ); ?></span>
                    <ul>
                        <?php echo implode( "\n\t", $currency_list ); ?>
                    </ul>
                </div>
            <?php }
            }

        add_action( 'agni_header_icons', 'agni_woocommerce_currency_box', 12 );
    }
}


// Woocommerce Ajax Myaccount
if(class_exists( 'WooCommerce' )){ 
    if( !function_exists('agni_woocommerce_ajax_myaccount') ){
        function agni_woocommerce_ajax_myaccount(){
            global $halena_options;

            if( $halena_options['header-myaccount-box'] == '1' ){ ?>
                <div class="header-myaccount-toggle header-toggle">
                    <a class="header-myaccount-icon-url" href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>">
                        <?php $header_myaccount_svg_icon = apply_filters( 'agni_header_icon_myaccount_icon_filter', AGNI_FRAMEWORK_URL . '/img/halena_myaccount_icon.svg' ); 
                        echo agni_extract_svg_from_file( $header_myaccount_svg_icon, $unique_class = 'header-myaccount-icon-svg' ); ?>
                    </a>
                </div>
            <?php }
        }
        add_action( 'agni_header_icons', 'agni_woocommerce_ajax_myaccount', 13 );
    }
}

// Woocommerce Ajax cart
if(class_exists( 'WooCommerce' )){ 
    if( !function_exists('agni_woocommerce_ajax_cart') ){
        function agni_woocommerce_ajax_cart(){ 
            global $halena_options;

            if( $halena_options['header-cart-box'] == '1' && $halena_options['shop-catalog-mode'] != '1' ){ ?>
                <div class="header-cart-toggle header-toggle">
                    <a class="cart-contents <?php if( is_cart() || is_checkout() || $halena_options['shop-sidebar-cart-disable'] == '1' ){ echo 'cart-link-enable'; } ?>" href="<?php echo esc_url( wc_get_cart_url() ); ?>">
                        <span class="header-cart-icon">
                            <?php if( $halena_options['header-cart-style'] == '2' ){
                                $header_cart_svg_icon = apply_filters( 'agni_header_icon_shopping_cart_icon_filter', AGNI_FRAMEWORK_URL . '/img/halena_shopping_cart_icon.svg' ); 
                                echo agni_extract_svg_from_file( $header_cart_svg_icon, $unique_class = 'header-cart-icon-svg' ); 
                            } 
                            else { ?>
                                <span class="header-cart-text"><?php echo esc_html__( 'Cart', 'halena' ); ?></span>
                            <?php } ?>
                        </span>
                        <span class="header-cart-details">
                            <?php //if( WC()->cart->cart_contents_count != '0' ){ ?>
                                <span class="product-count"><?php echo sprintf (_n( '%d', '%d', WC()->cart->cart_contents_count, 'halena' ), WC()->cart->cart_contents_count ); ?></span>
                            <?php //} ?>
                            <?php if($halena_options['header-cart-amount'] == '1'){ 
                                
                                if( isset($halena_options['header-cart-amount-inclusive']) && $halena_options['header-cart-amount-inclusive'] == '1' ){
                                    echo wc_price( WC()->cart->subtotal );
                                }
                                else{
                                    echo WC()->cart->get_cart_total(); 
                                }
                            } ?>
                        </span>
                    </a>
                </div>
            <?php }
        }
        add_action( 'agni_header_icons', 'agni_woocommerce_ajax_cart', 14 );
    }
}

// woocommerce wishlist icon
if(class_exists( 'WooCommerce' ) && class_exists( 'YITH_WCWL' )){ 
    if( !function_exists('agni_woocommerce_wishlist_icon') ){
        function agni_woocommerce_wishlist_icon(){ 
            global $halena_options;

            if( $halena_options['header-wishlist-box'] == '1' ){ ?>
                <div class="header-wishlist-toggle header-toggle">
                    <a class="wishlist-url" href="<?php echo YITH_WCWL()->get_wishlist_url(); ?>">
                        <?php $header_wishlist_svg_icon = apply_filters( 'agni_header_icon_wishlist_icon_filter', AGNI_FRAMEWORK_URL . '/img/halena_wishlist_icon.svg' ); 
                        echo agni_extract_svg_from_file( $header_wishlist_svg_icon, $unique_class = 'header-wishlist-icon-svg' ); ?>
                    </a>
                </div>

            <?php }
        }
        add_action( 'agni_header_icons', 'agni_woocommerce_wishlist_icon', 15 );
    }
}

// header Search
if( !function_exists('agni_header_search') ){
    function agni_header_search(){
        global $halena_options;

        if( $halena_options['header-search-box'] == '1' ){ ?>
            <div class="header-search search-invisible">
                <div class="header-search-overlay"></div>
                <div class="header-search-close"><i class="icon-arrows-remove"></i></div>
                <?php if( class_exists( 'WooCommerce' ) && class_exists( 'AGNIDGWT_WC_Ajax_Search' ) ){ ?>
                    <?php 
                    $search_args = array(
                        'class' => 'woocommerce',
                        'bar' => 'something else',
                        'details_box' => 'show'
                    );
                    $search_args = apply_filters( 'agnidgwt_wcas_ajax_search_shortcode_args', $search_args );
                    echo agnidgwt_wcas_get_search_form( $search_args );
                    ?>
                <?php }
                else{ ?>
                    <form id="search-form" role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <label class="screen-reader-text" for="s"><?php echo esc_html__( 'Search for:', 'halena' ); ?></label>
                        <input id="search" type="text" class="search-field" placeholder="<?php echo esc_attr($halena_options['header-search-box-text']); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'halena' ); ?>" />
                        <input type="submit" class="search-submit" value="" />
                        <?php if ( defined( 'ICL_LANGUAGE_CODE' ) ){ ?>
                            <input type="hidden" name="lang" value="<?php echo( ICL_LANGUAGE_CODE ); ?>" />
                        <?php } ?>
                    </form>
                <?php } ?>
            </div>
        <?php }
    }
    add_action( 'agni_header_icons_hidden', 'agni_header_search' );
}

// woocommerce search icon
if( !function_exists('agni_woocommerce_search_icon') ){
    function agni_woocommerce_search_icon(){ 
        global $halena_options;

        if( $halena_options['header-search-box'] == '1' ){ ?>
            <div class="header-search-toggle header-toggle">
                <?php if( isset($halena_options['header-search-style']) && $halena_options['header-search-style'] == '1' ){ ?>
                    <span class="header-search-text">
                        <?php echo esc_html__( 'Search', 'halena' ); ?>
                    </span>
                <?php }
                else { ?>
                    <?php $header_search_svg_icon = apply_filters( 'agni_header_icon_search_icon_filter', AGNI_FRAMEWORK_URL . '/img/halena_search_icon.svg' );
                    echo agni_extract_svg_from_file( $header_search_svg_icon, $unique_class = 'header-search-icon-svg' ); ?>
                <?php } ?>
            </div>
            <?php 
        }
    }
    add_action( 'agni_header_icons', 'agni_woocommerce_search_icon', 16 );
}
if( !function_exists('agni_header_social_media_icons_list') ){
    function agni_header_social_media_icons_list(){
        global $halena_options; ?>
        <ul class="social-icons list-inline">
            <?php if( $halena_options['social-media-header'] == '1' ){ 
                foreach( $halena_options['social-media-icons-header'] as $social_checkbox => $social_icons ){
                    if( $social_icons == '1' ){ ?>
                        <li><a target="<?php echo esc_attr($halena_options['header-link-target']);?>" href="<?php echo esc_url($halena_options[ $social_checkbox .'-link' ]);?>"> <i class="fa fa-<?php echo esc_attr($social_checkbox); ?>"></i></a></li>
                    <?php }
                } 
            } ?>   
        </ul>
        <?php 
    }
}

// Header social media icon
if( !function_exists('agni_header_social_media_icons') ){
    function agni_header_social_media_icons(){
        global $halena_options;

        if( $halena_options['social-media-header'] == '1' && $halena_options['social-media-header-location'] == '1' ){ ?>
            <div class="header-toggle header-social-toggle text-center">
                <?php $header_social_svg_icon = apply_filters( 'agni_header_icon_social_media_icon_filter', AGNI_FRAMEWORK_URL . '/img/halena_social_media.svg' ); 
                echo agni_extract_svg_from_file( $header_social_svg_icon, $unique_class = 'header-social-icon-svg' ); 
                echo agni_header_social_media_icons_list(); ?>
            </div>
        <?php  }
    }
    add_action( 'agni_header_icons', 'agni_header_social_media_icons', 17 );
    //add_action( 'agni_header_top_bar_social', 'agni_header_social_media_icons' );
}


// Agni Top bar
if( !function_exists('agni_header_top_bar') ){
    function agni_header_top_bar($args){
        global $halena_options;

        if( $halena_options['header-menu-style'] != 'side-header-menu' && $halena_options['header-menu-style'] != 'strip-header-menu' ){

            $header_menu_fullwidth = $args['header_menu_fullwidth'];
            $header_transparent = $args['header_transparent'];

            if( isset($halena_options['header-top-bar']) && $halena_options['header-top-bar'] == '1' ){ ?>
                <div class="header-top-bar <?php 
                    if( $header_menu_fullwidth == '1'){ echo 'fullwidth-header-menu '; } ?><?php 
                    if( $header_transparent == '1' ){ echo 'transparent-header-menu '; } ?><?php 
                    if( $halena_options['header-sticky'] == '1' ){ echo 'top-sticky '; } ?>" <?php 
                    if( $header_transparent == '1' ){ echo 'data-transparent="1" '; } ?><?php 
                    if( $halena_options['header-sticky'] == '1' ){ echo 'data-sticky="1" '; } ?><?php 
                    if( $halena_options['shrink-header-menu'] == '1' ){ echo 'data-shrink="1" '; } ?>>
                    <div class="container<?php if( $header_menu_fullwidth == '1'){ echo '-fluid'; } ?>">
                        <?php if( !empty($halena_options['header-top-email']) ){ ?>
                            <span class="top-bar-email"><i class="fa fa-envelope-o"></i><?php echo esc_html($halena_options['header-top-email']); ?></span>
                        <?php } ?>
                        <?php if( !empty($halena_options['header-top-number']) ){ ?>
                            <span class="top-bar-number"><i class="fa fa-mobile-phone"></i><?php echo esc_attr($halena_options['header-top-number']); ?></span>
                        <?php } ?>
                        <?php if( $halena_options['social-media-header'] == '1' && $halena_options['social-media-header-location'] == '2' ){ 
                            //do_action( 'agni_header_top_bar_social' );
                            echo agni_header_social_media_icons_list(); 
                        } ?>
                        <?php if( $halena_options['top-bar-nav'] == '1' ){ ?>
                            <nav class="top-nav-menu additional-nav-menu" >
                                <?php  // Top Bar Menu   
                                wp_nav_menu(array( 'menu_class' => 'top-nav-menu-content list-inline', 'menu_id' => 'top-navigation', 'container' => false, 'theme_location' => 'secondary', 'fallback_cb'     => 'wp_page_menu' ) ); ?> 
                            </nav>
                        <?php } ?>
                    </div>
                </div>
            <?php }
        }
    }
    add_action( 'agni_header_top_bar', 'agni_header_top_bar', '', 1 );
}

// Header 
if( !function_exists('agni_header') ){
    function agni_header(){ 
        global $halena_options; 
        $page_id = get_the_ID();
        if( class_exists('WooCommerce') ){
            if( is_shop() || is_product_category() || is_product_tag() ){
                $page_id = wc_get_page_id('shop');
            }
        }

        $header_custom_menu_choice =  esc_attr( get_post_meta( $page_id, 'page_menu_choice', true ) );
        $header_transparent = esc_attr( get_post_meta( $page_id, 'page_transparent', true ) );
        $header_menu_fullwidth = esc_attr( get_post_meta( $page_id, 'page_menu_fullwidth', true ) );
        $footer_text_choice = esc_attr( get_post_meta( $page_id, 'page_footer_text', true ) );

        $reverse_skin = ( esc_attr( get_post_meta( $page_id, 'page_skin_reverse', true ) ) == 'on' )?'reverse_skin':'';

        if( $header_transparent == '' ){
            $header_transparent = isset($halena_options['header-bg-transparent'])?esc_attr( $halena_options['header-bg-transparent'] ):'';
        }
        if( $header_menu_fullwidth == '' ){
            $header_menu_fullwidth = isset($halena_options['fullwidth-header-menu'])?esc_attr( $halena_options['fullwidth-header-menu'] ):'';
        }
        if( $footer_text_choice == '' ){
            $footer_text_choice = isset($halena_options['footer-text-choice'])?esc_attr( $halena_options['footer-text-choice'] ):'';
        }

        ?>
        <body <?php if( isset($halena_options['parallax-mobile']) && $halena_options['parallax-mobile'] == '1' ){ echo 'id="skrollr-body"'; } ?> <?php body_class(); ?>>

            <div class="top-padding"></div>
            <div class="bottom-padding"></div>

            <?php do_action( 'agni_backtotop' ); ?>

            <div id="page" class="hfeed site wrapper <?php if( $halena_options['layout-boxed'] == '1' ){ echo 'boxed'; } ?> ">
                <header id="masthead" class="site-header" role="banner">    

                    <?php 
                    // Header shortnotes
                    do_action( 'agni_shortnotes', $page_id );

                    // Header Top bar
                    $args = array( 
                        'header_menu_fullwidth' => $header_menu_fullwidth, 
                        'header_transparent' => $header_transparent,
                    );
                    do_action( 'agni_header_top_bar', $args );  ?>

                    <div class="header-navigation-menu <?php 
                        echo esc_attr($halena_options['header-menu-style']).' '; ?><?php
                        if( $halena_options['header-menu-style'] == 'strip-header-menu'){ echo 'side-header-menu '; } ?><?php 
                        if( $header_menu_fullwidth == '1'){ echo 'fullwidth-header-menu '; } ?><?php 
                        if( $header_transparent == '1' ){ echo 'transparent-header-menu '; } ?><?php 
                        if( $halena_options['shrink-header-menu'] == '1' ){ echo 'shrink-header-menu '; } ?><?php 
                        if( $halena_options['header-sticky'] == '1' ){ echo 'header-sticky '; } ?><?php 
                        if( !empty($halena_options['header-menu-bg-color-2']) ){ echo 'header-additional-bg-color '; } ?><?php 
                        if( !empty($halena_options['header-menu-border-1']['border-bottom']) && $halena_options['header-menu-border-1']['border-bottom'] != '0px' ){ echo 'header-menu-border '; } ?><?php 
                        if( !empty($halena_options['header-menu-border-2']['border-bottom']) && $halena_options['header-menu-border-2']['border-bottom'] != '0px' ){ echo 'header-menu-border-additional '; } ?><?php 
                        if( $halena_options['header-menu-button'] == '1' ){ echo 'has-menu-button '; } ?><?php 
                        if( $halena_options['header-additional-primary-menu-button'] == '1' ){ echo 'has-additional-primary-menu-button '; } ?><?php 
                        if( $halena_options['header-menu-has-no-arrows'] == '1' ){ echo 'has-no-arrows '; } ?><?php
                        echo esc_attr($reverse_skin);
                        ?> clearfix" <?php 
                        if( $header_transparent == '1' ){ echo 'data-transparent="1" '; }  ?><?php
                        if( $halena_options['header-sticky'] == '1' ){ echo 'data-sticky = "1" '; 
                            if( $halena_options['header-sticky-fancy'] == '1' ){
                                echo 'data-sticky-fancy = "1" ';
                            }
                        } ?><?php
                        if( $halena_options['shrink-header-menu'] == '1' ){ echo 'data-shrink="1"'; } ?>>
                        <div class="header-navigation-menu-container <?php echo esc_attr( $halena_options['header-menu-style'] ).'-container'; ?> ">
                            <?php switch ($halena_options['header-menu-style']) {
                                case 'center-header-menu': ?>
                                    <div class="header-center-menu-top-content <?php if( !empty($halena_options['header-center-menu-bg-color-2']) ){ echo 'header-center-menu-additional-bg-color'; }?>">
                                        <div class="container<?php if( $header_menu_fullwidth == '1'){ echo '-fluid'; } ?>">
                                            <div class="header-center-menu-top-flex">
                                                <div class="header-logo-container">
                                                    <?php do_action( 'agni_header_logo' ); ?>
                                                </div>
                                                <div class="header-menu-toggle-container">
                                                    <div class="tab-header-menu-toggle header-menu-toggle toggle-nav-menu <?php if( !empty($halena_options['header-menu-link-color-2']) ){ echo 'toggle-nav-menu-additional '; }?>">
                                                        <div class="burg-icon"><a href="#"><div class="burg"></div></a></div>
                                                    </div> 
                                                </div>
                                                <div class="header-additional-primary-container <?php if( !empty($halena_options['header-menu-link-color-2']) ){ echo 'nav-menu-additional-color '; }?>">
                                                    <?php do_action( 'agni_nav_menu_additional_primary', 'additional-primary-nav-menu-content nav-menu-content', 'additional-primary-navigation', $page_id ); ?>
                                                </div>
                                                <div class="header-menu-icons-container">
                                                    <?php // Header Additional items(including social icons) ?>
                                                    <div class="header-menu-icons <?php echo !empty($halena_options['header-icon-link-color-2'])?'header-menu-icons-additional-color':'' ?>">
                                                        <?php do_action( 'agni_header_icons' ); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="header-menu-content">
                                        <div class="container<?php if( $header_menu_fullwidth == '1'){ echo '-fluid'; } ?>">
                                            <div class="header-menu-flex">
                                                <div class="header-menu">
                                                    <nav class="nav-menu <?php if( !empty($halena_options['header-menu-link-color-2']) ){ echo 'nav-menu-additional-color '; }?>page-scroll" >
                                                            <?php // Main Nav menu  
                                                                do_action( 'agni_nav_menu', 'nav-menu-content', 'navigation', $page_id );
                                                            ?> 
                                                    </nav>  
                                                    <div class="header-menu-toggle-container">
                                                        <div class="tab-header-menu-toggle header-menu-toggle toggle-nav-menu <?php if( !empty($halena_options['header-menu-link-color-2']) ){ echo 'toggle-nav-menu-additional '; }?>">
                                                            <div class="burg-icon"><a href="#"><div class="burg"></div></a></div>
                                                        </div> 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php break;
                                
                                case 'default-header-menu':
                                case 'border-header-menu':
                                default : ?>
                                    <div class="header-menu-content">
                                        <div class="container<?php if( $header_menu_fullwidth == '1'){ echo '-fluid'; } ?>">
                                            <div class="header-menu-flex <?php echo esc_attr( ( !empty($halena_options['header-menu-style-default-choice'] ))?$halena_options['header-menu-style-default-choice']:'right' ); ?>-menu-flex <?php echo esc_attr( $halena_options['header-menu-style-choice-order'] ); ?>">
                                                
                                                <?php if( in_array( $halena_options['header-menu-style'], array( 'default-header-menu', 'minimal-header-menu', 'side-header-menu', 'strip-header-menu', 'border-header-menu' ) ) || empty($halena_options) ){ ?>
                                                    <div class="header-logo-container">
                                                        <?php do_action( 'agni_header_logo' ); ?>
                                                    </div>
                                                    <?php } ?>
                                                <div class="header-menu">
                                                    <?php if( $halena_options['header-menu-style'] != 'minimal-header-menu'){ ?>
                                                        <nav class="nav-menu <?php if( !empty($halena_options['header-menu-link-color-2']) ){ echo 'nav-menu-additional-color '; }?>page-scroll" >
                                                            <?php // Main Nav menu  
                                                                do_action( 'agni_nav_menu', 'nav-menu-content', 'navigation', $page_id );
                                                            ?> 
                                                        </nav>  
                                                    <?php } ?>
                                                    <div class="header-menu-toggle-container">
                                                        <div class="tab-header-menu-toggle header-menu-toggle toggle-nav-menu <?php if( !empty($halena_options['header-menu-link-color-2']) ){ echo 'toggle-nav-menu-additional '; }?>">
                                                            <div class="burg-icon"><a href="#"><div class="burg"></div></a></div>
                                                        </div> 
                                                        <?php if( $halena_options['header-menu-style'] == 'minimal-header-menu'){ ?>
                                                            <div class="header-menu-toggle toggle-nav-menu <?php if( !empty($halena_options['header-menu-link-color-2']) ){ echo 'toggle-nav-menu-additional '; }?>"><?php if( !empty($halena_options['header-menu-name']) ){ ?><div class="burg-text"><?php echo esc_attr($halena_options['header-menu-name']); ?></div><?php } if( $halena_options['header-menu-burg'] == '1' ){ ?><div class="burg-icon"><a href="#"><div class="burg"></div></a></div><?php } ?>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                                <div class="header-menu-icons-container">
                                                    <div class="header-additional-primary-container <?php if( !empty($halena_options['header-menu-link-color-2']) ){ echo 'nav-menu-additional-color '; }?>">
                                                        <?php do_action( 'agni_nav_menu_additional_primary', 'additional-primary-nav-menu-content nav-menu-content', 'additional-primary-navigation', $page_id ); ?>
                                                    </div>
                                                    <?php // Header Additional items(including social icons) ?>
                                                    <div class="header-menu-icons <?php echo !empty($halena_options['header-icon-link-color-2'])?'header-menu-icons-additional-color':'' ?>">
                                                        <?php do_action( 'agni_header_icons' ); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php break;
                            } ?>
                            
                            <?php if($halena_options['header-menu-style'] == 'side-header-menu'){ ?>
                                <div class="header-logo-container">
                                    <?php do_action( 'agni_header_logo' ); ?>
                                </div>
                            <?php } ?>
                            <div class="tab-nav-menu-wrap tab-invisible page-scroll">
                                <div class="tab-nav-menu-overlay"></div>
                                <nav class="tab-nav-menu" data-page-link=<?php echo esc_attr( (isset($halena_options['header-menu-has-parent-link']) && $halena_options['header-menu-has-parent-link'] == 1)?$halena_options['header-menu-has-parent-link']:0 ); ?>>
                                    <?php // Mobile Nav menu  
                                    do_action( 'agni_nav_menu', 'tab-nav-menu-content container-fluid', 'tab-navigation', $page_id );
                                    ?>

                                    <?php do_action( 'agni_nav_menu_additional_primary', 'additional-primary-nav-menu-content nav-menu-content', 'tab-additional-primary-navigation', $page_id ); ?>
                                </nav>
                            </div>

                            <?php if( $halena_options['header-menu-style'] == 'side-header-menu' || $halena_options['header-menu-style'] == 'strip-header-menu' ){ ?>
                                <?php if($halena_options['header-menu-style'] == 'side-header-menu'){ ?>
                                    <div class="header-menu-icons <?php echo !empty($halena_options['header-icon-link-color-2'])?'header-menu-icons-additional-color':'' ?>">
                                        <?php do_action( 'agni_header_icons' ); ?>
                                    </div>
                                <?php } ?>
                                <div class="header-additional-primary-container <?php if( !empty($halena_options['header-menu-link-color-2']) ){ echo 'nav-menu-additional-color '; }?>">
                                    <?php do_action( 'agni_nav_menu_additional_primary', 'additional-primary-nav-menu-content nav-menu-content', 'additional-primary-navigation', $page_id ); ?>
                                </div>
                                <div class="site-info">
                                    <?php if(!empty($halena_options['footer-logo']['url'])){  ?>
                                        <div class="footer-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" ><img src="<?php echo esc_url($halena_options['footer-logo']['url']); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" /></a></div>
                                    <?php }  ?>
                                    <div class="footer-content side-footer-content style-1">
                                        <?php if( $halena_options['footer-nav'] == '1' ){ echo agni_footer_nav(); } 
                                        if( $halena_options['social-media-footer'] == '1'){ echo agni_footer_social(); }
                                        if( !empty($halena_options['footer-text']) ){ echo agni_footer_text(); } ?>
                                    </div>
                                </div><!-- .site-info -->
                            <?php  } ?>
                        </div>
                        <?php if( $halena_options['header-menu-style'] == 'strip-header-menu' ){ ?>
                            <div class="strip-header-bar">
                                <div class="strip-header-logo"><?php do_action( 'agni_header_logo' ); ?></div>
                                <div class="strip-header-toggle">
                                    <div class="header-menu-toggle strip-header-menu-toggle <?php if( !empty($halena_options['header-menu-link-color-2']) ){ echo 'toggle-nav-menu-additional '; }?>"><?php if( !empty($halena_options['header-menu-name']) ){ ?><div class="burg-text" data-burg-text="<?php echo esc_attr($halena_options['header-menu-name']); ?>" data-burg-text-active="<?php echo esc_attr($halena_options['header-menu-name-active']); ?>"><?php echo esc_attr($halena_options['header-menu-name']); ?></div><?php } if( $halena_options['header-menu-burg'] == '1' ){ ?><div class="burg-icon"><a href="#"><div class="burg"></div></a></div><?php } ?>
                                    </div>
                                </div>
                                <div class="strip-header-social-icon">
                                    <?php //echo wp_kses_post( $header_menu_icons ); ?>
                                    <div class="header-menu-icons <?php echo !empty($halena_options['header-icon-link-color-2'])?'header-menu-icons-additional-color':'' ?>">
                                        <?php do_action( 'agni_header_icons' ); ?>
                                    </div>
                                </div>
                            </div>
                        <?php } 

                        // Inserting sidebar cart
                        do_action( 'agni_header_icons_hidden' ); ?>

                    </div>
                    <?php if( $footer_text_choice == '1' && $halena_options['header-menu-style'] == 'border-header-menu' ){ ?>
                        <div class="site-info <?php echo esc_attr( $halena_options['header-menu-style'] ); ?>-footer">
                            <div class="container<?php if( $halena_options['footer-fullwidth'] == '1' ){ echo '-fluid'; }?>">
                                <?php if(!empty($halena_options['footer-logo']['url'])){  ?>
                                    <div class="footer-logo <?php echo esc_attr($halena_options['footer-style']);?>"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" ><img src="<?php echo esc_url($halena_options['footer-logo']['url']); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" /></a></div>
                                <?php }  ?>
                                <div class="footer-content border-footer-content <?php echo esc_attr($halena_options['footer-style']);?>">
                                    <?php if($halena_options['footer-style'] == 'style-1' ){ 
                                        if( !empty($halena_options['footer-text']) ){ 
                                            echo '<div class="footer-text-container">'.agni_footer_text().'</div>';
                                        } 
                                        if( !empty($halena_options['social-media-footer']) ){ 
                                            echo '<div class="footer-social-container">'. agni_footer_social() .'</div>';
                                        } 
                                        if( !empty($halena_options['footer-nav']) ){ 
                                            echo '<div class="footer-menu-container">'.agni_footer_nav().'</div>';
                                        } 
                                    } ?>
                                </div>
                            </div>
                        </div><!-- .site-info -->
                        <div class="<?php echo esc_attr( $halena_options['header-menu-style'] ); ?>-right"></div>
                        <div class="<?php echo esc_attr( $halena_options['header-menu-style'] ); ?>-left"></div>
                    <?php  } ?>
                </header><!-- #masthead -->
                <div class="spacer"></div>
        
                <div id="content" class="site-content content <?php echo esc_attr($halena_options['header-menu-style']).'-content'; ?>">
    <?php }
    add_action( 'agni_header', 'agni_header' );
}

// Footer nav
if( !function_exists('agni_footer_nav') ){
    function agni_footer_nav(){
        ob_start(); ?>  
            <nav class="footer-nav-menu additional-nav-menu" >
                <?php  wp_nav_menu(array( 'menu_class' => 'footer-nav-menu-content list-inline', 'menu_id' => 'footer-navigation', 'container' => false, 'theme_location' => 'ternary', 'fallback_cb'     => '' ) ); ?> 
            </nav>
        <?php $footer_nav = ob_get_contents();
        ob_end_clean(); 

        return $footer_nav;
    } 
}

// Footer social
if( !function_exists('agni_footer_social') ){
    function agni_footer_social(){
        global $halena_options;
        ob_start(); ?>  
            <div class="footer-social">
                <ul class="social-icons list-inline">
                    <?php if( $halena_options['social-media-footer'] == '1' ){ 
                        foreach( $halena_options['social-media-icons-footer'] as $social_checkbox => $social_icons ){
                            if( $social_icons == '1' ){ ?>
                                <li><a class="<?php echo esc_attr($halena_options['social-media-style']); ?>" target="<?php echo esc_attr($halena_options['footer-link-target']);?>" href="<?php echo esc_url( $halena_options[ $social_checkbox .'-link' ] );?>"> <i class="fa fa-<?php echo esc_attr($social_checkbox);?>"></i></a></li>
                            <?php }
                        }
                    }?>   
                </ul>
            </div>
        <?php $footer_social = ob_get_contents();
        ob_end_clean();

        return $footer_social;
    }
}

// Footer text
if( !function_exists('agni_footer_text') ){
    function agni_footer_text(){
        global $halena_options;
        ob_start(); ?>  
            <div class="footer-text"><?php echo wp_kses_post( $halena_options['footer-text'] );?></div>
            <?php $footer_text = ob_get_contents();
        ob_end_clean(); 
        return $footer_text;
    }
}

// Footer
if( !function_exists('agni_footer') ){
    function agni_footer(){ 
        global $halena_options;
        $page_id = get_the_ID();

        if( class_exists('WooCommerce') ){
            if( is_shop() ){
                $page_id = wc_get_page_id('shop');
            }
        }

        $footer_bar =  esc_attr( get_post_meta( $page_id, 'page_footer_bar', true ) );
        $footer_bar_choice = esc_attr( get_post_meta( $page_id, 'page_footer_bar_choice', true ) );
        $footer_bar_contentblock = esc_attr( get_post_meta( $page_id, 'page_footer_bar_contentblock', true ) );
        $footer_bar_fullwidth = esc_attr( get_post_meta( $page_id, 'page_footer_bar_fullwidth', true ) );
        $footer_text_choice = esc_attr( get_post_meta( $page_id, 'page_footer_text', true ) );
        
        if( $footer_bar == '' ){
            $footer_bar = esc_attr( $halena_options['footer-bar'] );
            $footer_bar_choice = esc_attr( $halena_options['footer-bar-choice'] );
            $footer_bar_contentblock = (!empty($halena_options['footer-contentblock-choice']))?$halena_options['footer-contentblock-choice']:'';
        }
        if( $footer_bar_fullwidth == '' ){
            $footer_bar_fullwidth = esc_attr( $halena_options['footer-bar-fullwidth'] );
        }
        if( $footer_text_choice == '' ){
            $footer_text_choice = esc_attr( $halena_options['footer-text-choice'] );
        } ?>    
        
        <footer class="site-footer<?php if( $halena_options['footer-sticky'] == '1' ){ echo ' has-sticky-footer'; } ?>" role="contentinfo">
            <div class="site-info">
                <?php if( $footer_bar == '1' ){ ?>
                    <div id="footer-bar-area" class="footer-bar footer-bar-has-<?php echo esc_attr( ( $footer_bar_choice == '0' )?'widget':'content-block' ); ?>">
                        <div class="container<?php if( $footer_bar_fullwidth == '1' ){ echo '-fluid'; }; ?>">  
                            <?php if( $footer_bar_choice == '0' ){ ?>         
                                <div class="footer-widget-row row">
                                <?php if ( is_active_sidebar( 'halena-footerbar-1' )  ){ 
                                    dynamic_sidebar( 'halena-footerbar-1' ); 
                                } ?>
                                </div>
                            <?php } 
                            else{ ?>
                                <div class="footer-content-block">
                                <?php if( !empty($footer_bar_contentblock) ){
                                    echo do_shortcode('[agni_block post_id="'.$footer_bar_contentblock.'"]');
                                } ?>
                               </div>
                            <?php }?>
                        </div>
                    </div>
                <?php } ?>
                <?php if( $footer_text_choice == '1' ){ ?>
                    <div id="footer-colophon" class="footer-colophon">
                        <div class="container<?php if( $halena_options['footer-fullwidth'] == '1' ){ echo '-fluid'; }?>">
                            
                            <div class="footer-content footer-content-<?php echo esc_attr($halena_options['footer-style']);?>">
                                <?php if(!empty($halena_options['footer-logo']['url'])){  ?>
                                    <div class="footer-logo-container">
                                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" ><img src="<?php echo esc_url($halena_options['footer-logo']['url']); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" /></a>
                                    </div>
                                <?php }  
                                if( !empty($halena_options['footer-text']) ){ 
                                    echo '<div class="footer-text-container">'.agni_footer_text().'</div>';
                                } 
                                if( !empty($halena_options['social-media-footer']) ){ 
                                    echo '<div class="footer-social-container">'. agni_footer_social() .'</div>';
                                } 
                                if( !empty($halena_options['footer-nav']) ){ 
                                    echo '<div class="footer-menu-container">'.agni_footer_nav().'</div>';
                                } ?>
                            </div>
                        </div>
                    </div>
                <?php } 
                if( !isset( $halena_options['footer-text-choice'] ) ){ ?>
                    <div id="footer-colophon" class="footer-colophon no-option">
                        <div class="container text-center">
                            <?php echo esc_html( get_bloginfo( 'name' ) ); ?>
                        </div>
                    </div>
                <?php }?>
            </div>
        </footer><!-- .site-footer -->
    <?php }
}

// Preloader
if( !function_exists('agni_preloader') ){
    function agni_preloader(){
        global $halena_options; 

        if( $halena_options['loader'] == '1' ){ ?>
            <div id="preloader-<?php echo esc_attr($halena_options['loader-style']); ?>" class="preloader preloader-style-<?php echo esc_attr( $halena_options['loader-style'] ); ?>" data-preloader="<?php echo esc_attr($halena_options['loader']); ?>" data-preloader-style="<?php echo esc_attr($halena_options['loader-style']); ?>">
                <?php if( $halena_options['loader-style'] == '2' ){ ?>
                    <div class="preloader-container">
                        <div class="preloader-content">
                            <div class="cssload-loader"></div>
                        </div>
                    </div>
                <?php  }
                else if( $halena_options['loader-style'] == '3' ){ ?>
                    <div class="preloader-container">
                        <div class="cssload-loader">
                            <div class="cssload-flipper">
                                <div class="cssload-front"></div>
                                <div class="cssload-back"></div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div><!-- #preloader -->
        <?php } 
    }
}

if( !function_exists('agni_popup_box_content') ){
    function agni_popup_box_content(){
        
        
        global $post, $halena_options;
        $agni_block_popup_post_id = '';
        if( !empty($post->ID) ){
            $agni_block_popup_post_id = esc_attr( get_post_meta($post->ID, 'page_agni_blocks_popup', true) );
        }
        if( $agni_block_popup_post_id == '' ){
            $agni_block_popup_post_id = (isset($halena_options['page-agni-block-popup']))?esc_attr( $halena_options['page-agni-block-popup'] ):'';
        }
        if( empty($agni_block_popup_post_id) ){
            return null;
        } 
        wp_enqueue_script( 'js-cookie' );
        ?>
        <div class="agni-popup-box">
            <div class="agni-popup-box-overlay"></div>
            <div class="agni-popup-box-container">
                <div class="agni-popup-box-close"><i class="pe-7s-close"></i></div>
                <?php echo do_shortcode( '[agni_block post_id="'.$agni_block_popup_post_id.'"]' ); ?>
            </div>
        </div>
        <?php 
    }
    add_action( 'agni_popup_box', 'agni_popup_box_content' );
}

// Page 
if( !function_exists('agni_page') ){
    function agni_page(){
        global $halena_options, $post;
        $args = '';
        $page_bg_color = esc_attr( get_post_meta( $post->ID, 'page_bg_color', true ) );
        $page_remove_title = esc_attr( get_post_meta( $post->ID, 'page_remove_title', true ) );
        $page_title_align = esc_attr( get_post_meta( $post->ID, 'page_title_align', true ) );
        $page_layout = esc_attr( get_post_meta( $post->ID, 'page_layout', true ) );
        $page_sidebar = esc_attr( get_post_meta( $post->ID, 'page_sidebar', true ) );

        if( $page_remove_title == '' ){
            $page_remove_title = esc_attr( $halena_options['page-remove-title'] );
        }
        if( $page_title_align == '' ){
            $page_title_align = esc_attr( $halena_options['page-title-align'] );
        }

        if( $page_layout == '' ){
            if( !empty($halena_options['page-layout']) ){
                $page_layout = esc_attr( $halena_options['page-layout'] );
            }
            else{
                $page_layout = 'container';
            }
        }

        if( $page_sidebar == '' ){
            $page_sidebar = isset($halena_options['page-sidebar'])?esc_attr( $halena_options['page-sidebar'] ):'no-sidebar';
        }

        if( class_exists( 'WooCommerce' ) ){
            if( is_woocommerce() || is_cart() || is_checkout() || is_account_page() ){
                $page_layout = 'container';
                $page_remove_title = '';
                if( WC()->cart->cart_contents_count == 0 ){
                    $page_remove_title = '1';
                }
                if( !is_user_logged_in() && is_account_page() ){
                    $page_remove_title = '1';
                }
                /*$args = array(
                    'page_layout' => $page_layout,
                    'page_remove_title' => $page_remove_title,
                );*/
            }
        }

    ?>
    <div class="page-layout <?php if( $page_layout == 'container-fluid' ){ echo 'has-fullwidth'; }else{ echo 'has-container'; } ?>" <?php if( !empty($page_bg_color) ){ echo 'style="background-color:'.$page_bg_color.'"'; } ?>>
        <div class="page-container <?php echo esc_attr( $page_layout ); ?>">
            <div class="page-row <?php 
                echo esc_attr( $page_sidebar );
                if( $page_remove_title != '1' ){ echo ' has-title has-margin'; } 
            ?> ">
                <div class="page-column page-content">
                    <div id="primary" class="primary content-area">
                        <main id="main" class="site-main">

                            <?php while ( have_posts() ) : the_post(); ?>

                                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                    <?php if( $page_remove_title != '1' ){ ?>
                                        <div class="entry-header">
                                            <?php the_title( '<h1 class="entry-title text-'.$page_title_align.'">', '</h1>' ); ?>
                                        </div><!-- .entry-header -->
                                    <?php } ?>
                                    <div class="entry-content">
                                        <?php the_content(); ?>
                                        <?php
                                            wp_link_pages( array(
                                                'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'halena' ),
                                                'after'  => '</div>',
                                            ) );
                                        ?>
                                    </div><!-- .entry-content -->
                                </article><!-- #post-## -->

                                <?php
                                    // If comments are open or we have at least one comment, load up the comment template.
                                    if ( comments_open() || get_comments_number() ) :
                                        comments_template();
                                    endif;
                                ?>

                            <?php endwhile; // End of the loop. ?>

                        </main><!-- #main -->
                    </div><!-- #primary -->
                </div>
                <?php  if( $page_sidebar != 'no-sidebar' ){ ?>
                    <div class="page-column page-sidebar">
                        <?php get_sidebar(); ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php }
}

// Blog Single
if( !function_exists('agni_single') ){
function agni_single(){
    global $halena_options, $post; 

    $page_bg_color = esc_attr( get_post_meta( $post->ID, 'page_bg_color', true ) );
    $page_remove_title = esc_attr( get_post_meta( $post->ID, 'page_remove_title', true ) );
    $page_title_align = esc_attr( get_post_meta( $post->ID, 'page_title_align', true ) );
    $page_layout = esc_attr( get_post_meta( $post->ID, 'page_layout', true ) );
    $page_sidebar = esc_attr( get_post_meta( $post->ID, 'page_sidebar', true ) );

    if( $page_remove_title == '' ){
        $page_remove_title = esc_attr( $halena_options['blog-single-remove-title'] );
    }
    if( $page_title_align == '' ){
        $page_title_align = esc_attr( $halena_options['blog-single-title-align'] );
    }

    if( $page_layout == '' ){
        if( !empty($halena_options['blog-single-layout']) ){
            $page_layout = esc_attr( $halena_options['blog-single-layout'] );
        }
        else{
            $page_layout = 'container';
        }
    }

    if( $page_sidebar == '' ){
        $page_sidebar = isset( $halena_options['blog-single-sidebar'] )?esc_attr( $halena_options['blog-single-sidebar'] ):'has-sidebar';
    }

    ?>
    <section class="blog blog-single-post <?php if( $page_layout == 'container-fluid' ){ echo 'has-fullwidth'; }else{ echo 'has-container'; } ?>" <?php if( !empty($page_bg_color) ){ echo 'style="background-color:'.$page_bg_color.'"'; } ?>>
        <div class="blog-single-container <?php echo esc_attr( $page_layout ); ?> <?php 
            echo esc_attr( $page_sidebar );
            if( $page_remove_title != '1' ){ echo ' has-title has-margin'; } 
        ?>">
            <?php function agni_single_page_content(){
                global $halena_options, $post; 

                $page_remove_title = esc_attr( get_post_meta( $post->ID, 'page_remove_title', true ) );
                $page_title_align = esc_attr( get_post_meta( $post->ID, 'page_title_align', true ) );
                $page_sidebar = esc_attr( get_post_meta( $post->ID, 'page_sidebar', true ) );

                if( $page_remove_title == '' ){
                    $page_remove_title = esc_attr( $halena_options['blog-single-remove-title'] );
                }
                if( $page_title_align == '' ){
                    $page_title_align = esc_attr( $halena_options['blog-single-title-align'] );
                }
                if( $page_sidebar == '' ){
                    $page_sidebar = esc_attr( $halena_options['blog-single-sidebar'] );
                }

                ob_start(); ?>
                    
                    <div id="primary" class="content-area blog-single-post-content">
                        <main id="main" class="site-main" role="main">

                        <?php while ( have_posts() ) : the_post(); ?>

                            <?php  
                            $post_format = get_post_format();
                            if( !empty( $post_format ) ){
                                $post_format_function = 'agni_post_'.$post_format;
                                if( function_exists($post_format_function) ){
                                    $post_thumbnail = $post_format_function($post->ID);
                                }
                            }
                            elseif( has_post_thumbnail() ){ 
                                $post_thumbnail = get_the_post_thumbnail( '','full' );
                            }
                            ?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                                <?php if( $page_remove_title != '1' ){ ?>
                                    <div class="entry-meta <?php echo 'text-'.$page_title_align;?>">
                                        <?php echo agni_framework_post_date(); ?>
                                        <?php echo agni_framework_post_cat(); ?>
                                        <?php //echo get_the_author(); ?>
                                    </div>
                                    <?php the_title( '<h1 class="entry-title text-'.$page_title_align.'">', '</h1>' ); ?>
                                <?php } ?>

                                <?php if( !empty($post_thumbnail) && $halena_options['blog-single-thumbnail'] == '1' ){ ?> 
                                <div class="entry-thumbnail">
                                    <?php echo wp_kses_post( $post_thumbnail ); ?>
                                </div>
                                <?php } ?>

                                <div class="entry-content clearfix">
                                    <?php the_content(); ?>
                                    <?php
                                        wp_link_pages( array(
                                            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'halena' ),
                                            'after'  => '</div>',
                                        ) );
                                    ?>
                                    
                                </div><!-- .entry-content -->

                                <div class="entry-footer">
                                    <?php agni_framework_post_tag(); ?>
                                    <?php if( $halena_options['blog-sharing-panel'] == '1' ){?>
                                        <div class="post-sharing-buttons sharing-buttons">
                                            <?php if( !empty($halena_options['blog-sharing-label']) ){ 
                                                echo '<span class="post-sharing-buttons-label">'.esc_html( $halena_options['blog-sharing-label'] ).'</span>';
                                            } ?>
                                            <ul class="list-inline">
                                                <?php  if($halena_options['blog-sharing-icons'][1] == '1'){ ?>
                                                    <li><a href="http://www.facebook.com/sharer.php?u=<?php esc_url( the_permalink() );?>/&amp;t=<?php echo esc_html( str_replace( ' ', '%20', the_title('', '', false) ) ); ?>"><i class="fa fa-facebook"></i></a></li>
                                                <?php  }?>
                                                <?php  if($halena_options['blog-sharing-icons'][2] == '1'){ ?>
                                                    <li><a href="https://twitter.com/intent/tweet?text=<?php echo esc_html( str_replace( ' ', '%20', the_title('', '', false) ) ); ?> - <?php esc_url( the_permalink() ); ?>"><i class="fa fa-twitter"></i></a></li>
                                                <?php  }?>
                                                <?php  if($halena_options['blog-sharing-icons'][3] == '1'){ ?>             
                                                    <li><a href="https://plus.google.com/share?url=<?php esc_url( the_permalink() );?>"><i class="fa fa-google-plus"></i></a></li>
                                                <?php  }?>
                                                <?php  if($halena_options['blog-sharing-icons'][4] == '1'){ ?>             
                                                    <li><a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php esc_url( the_permalink() );?>&title=<?php echo esc_html( str_replace( ' ', '%20', the_title('', '', false) ) ); ?>"><i class="fa fa-linkedin"></i></a></li>
                                                <?php  }?>
                                            </ul>
                                        </div>
                                    <?php } ?>
                                </div><!-- .entry-footer -->
                            </article><!-- #post-## -->

                            <?php  if( $halena_options['author-biography'] == '1' ){  ?>
                                <div class="author-bio">
                                    <?php if( !empty($halena_options['author-biography-title']) ){ 
                                        echo '<h5 class="author-title">'.esc_html( $halena_options['author-biography-title'] ).'</h5>'; 
                                    } ?>
                                    <div class="author-content">
                                        <div class="author-avatar"><?php echo get_avatar( get_the_author_meta('email'), 100 ); ?></div>
                                        <div class="author-details">
                                            <h5 class="author-name"><?php the_author_link(); ?></h5>                
                                            <p class="author-description"><?php the_author_meta('description'); ?></p>
                                        </div>
                                    </div>
                                </div>
                            
                            <?php  } ?> 

                            <div class="post-navigation-container navigation-container">
                                <?php agni_framework_post_nav(); ?>
                            </div>  

                            <?php
                                // If comments are open or we have at least one comment, load up the comment template.
                                if ( comments_open() || get_comments_number() ) :
                                    comments_template();
                                endif;
                            ?>

                        <?php endwhile; // End of the loop. ?>

                        </main><!-- #main -->
                    </div><!-- #primary -->
                <?php $output_page_content = ob_get_contents();

                ob_end_clean(); 
                return $output_page_content;
            } ?>

            <?php 
            function agni_single_page_sidebar(){
                global $halena_options, $post; 

                $page_sidebar = esc_attr( get_post_meta( $post->ID, 'page_sidebar', true ) );

                if( $page_sidebar == '' ){
                    $page_sidebar = isset($halena_options['blog-single-sidebar'])?esc_attr( $halena_options['blog-single-sidebar'] ):'no-sidebar';
                }

                ob_start();
                if( $page_sidebar != 'no-sidebar' ){ ?>
                    <?php get_sidebar(); ?>
                <?php }
                $output_page_sidebar = ob_get_contents();

                ob_end_clean(); 
                return $output_page_sidebar;
            }

            if( $page_sidebar == 'has-sidebar left' ){
                echo agni_single_page_sidebar().agni_single_page_content();
            }
            else if( $page_sidebar == 'has-sidebar' ){
                echo agni_single_page_content().agni_single_page_sidebar();
            }
            else{
                echo agni_single_page_content();
            } ?>

        </div>
    </section>
    <?php }
}

// Portfolio Single 
if( !function_exists('agni_portfolio_single') ){
    function agni_portfolio_single(){ 
        global $halena_options, $post;

        $page_bg_color = esc_attr( get_post_meta( $post->ID, 'page_bg_color', true ) );
        $page_remove_title = esc_attr( get_post_meta( $post->ID, 'page_remove_title', true ) );
        $page_title_align = esc_attr( get_post_meta( $post->ID, 'page_title_align', true ) );
        $page_layout = esc_attr( get_post_meta( $post->ID, 'page_layout', true ) );

        if( $page_remove_title == '' ){
            $page_remove_title = esc_attr( $halena_options['portfolio-single-remove-title'] );
        }
        if( $page_title_align == '' ){
            $page_title_align = esc_attr( $halena_options['portfolio-single-title-align'] );
        }

        if( $page_layout == '' ){
            $page_layout = esc_attr( $halena_options['portfolio-single-layout'] );
        }
        
        ?>
        <div id="primary" class="portfolio-single-post content-area <?php if( $page_layout == 'container-fluid' ){ echo 'has-fullwidth'; }else{ echo 'has-container'; } ?>" <?php if( !empty($page_bg_color) ){ echo 'style="background-color:'.$page_bg_color.'"'; } ?>>
            <main id="main" class="site-main portfolio-single-post-container" role="main">        
            
                <?php while ( have_posts() ) : the_post(); ?>

                    <?php 
                    $portfolio_media = $project_details = $portfolio_single = $portfolio_project_details = $portfolio_project_title = $portfolio_project_additional = $zigzag_count = $portfolio_single_row_class = $portfolio_gutter_row_css = '';
                    $portfolio_layout = esc_attr( get_post_meta( $post->ID, 'portfolio_layout', true ) );
                    $portfolio_media_position = esc_attr( get_post_meta( $post->ID, 'portfolio_media_position', true ) );
                    $portfolio_media_side_column_count = esc_attr( get_post_meta( $post->ID, 'portfolio_media_side_column_count', true ) );
                    $portfolio_content_side_column_count = esc_attr( get_post_meta( $post->ID, 'portfolio_content_side_column_count', true ) );
                    $portfolio_side_alignment = esc_attr( get_post_meta( $post->ID, 'portfolio_side_alignment', true ) );
                    $portfolio_side_content_sticky = esc_attr( get_post_meta( $post->ID, 'portfolio_side_content_sticky', true ) );
                    $portfolio_media_gutter = esc_attr( get_post_meta( $post->ID, 'portfolio_media_gutter', true ) );
                    $portfolio_media_gutter_value = esc_attr( get_post_meta( $post->ID, 'portfolio_media_gutter_value', true ) );
                    $portfolio_layout_repeatable = get_post_meta( $post->ID, 'portfolio_layout_repeatable', true );

                    $portfolio_thumbnail_width = esc_attr( get_post_meta( $post->ID, 'portfolio_thumbnail_width', true ) );
                    $portfolio_thumbnail_height = esc_attr( get_post_meta( $post->ID, 'portfolio_thumbnail_height', true ) );
                    $portfolio_thumbnail_hover_style = esc_attr( get_post_meta( $post->ID, 'portfolio_thumbnail_hover_style', true ) );
                    $portfolio_thumbnail_custom_link = esc_url( get_post_meta( $post->ID, 'portfolio_thumbnail_custom_link', true ) );

                    $portfolio_project_title = esc_attr( get_post_meta( $post->ID, 'portfolio_project_title', true ) );
                    $portfolio_project_description = esc_attr( get_post_meta( $post->ID, 'portfolio_project_description', true ) ); // New
                    $portfolio_project_detail = get_post_meta( $post->ID, 'portfolio_project_detail', true );
                    $portfolio_project_link = esc_attr( get_post_meta( $post->ID, 'portfolio_project_link', true ) );
                    $portfolio_project_link_text = esc_attr( get_post_meta( $post->ID, 'portfolio_project_link_text', true ) );
                    $portfolio_project_link_url = esc_url( get_post_meta( $post->ID, 'portfolio_project_link_url', true ) );
                    $portfolio_additional_details_style = esc_attr( get_post_meta( $post->ID, 'portfolio_additional_details_style', true ) );
                    $portfolio_navigation = esc_attr( get_post_meta( $post->ID, 'portfolio_navigation', true ) ); // New

                    $portfolio_media_side_column_count = ( $portfolio_layout == 'side' )?$portfolio_media_side_column_count:'12';
                    $portfolio_content_side_column_count = ( $portfolio_layout == 'side' )?$portfolio_content_side_column_count:'12';

                    if( $portfolio_navigation == '' ){
                        $portfolio_navigation = $halena_options['portfolio-single-navigation'];
                    }

                    if( $portfolio_media_gutter == 'yes' ){
                        $portfolio_gutter_row_css = 'style="';
                        if( $page_layout == 'container-fluid' ){
                            $portfolio_gutter_row_css .= 'margin: -'.intval($portfolio_media_gutter_value/2).'px 0;'; 
                        }
                        else{
                            $portfolio_gutter_row_css .= 'margin: -'.intval($portfolio_media_gutter_value/2).'px; '; 
                        }
                        $portfolio_gutter_row_css .= '"'; 
                    }

                    foreach ( (array) $portfolio_layout_repeatable as $key => $media ) {
                        $portfolio_media_zigzag_column_count = $portfolio_content_zigzag_column_count = $portfolio_media_zigzag_alignment = $portfolio_description_zigzag = $portfolio_media_type = $portfolio_media_image_id = $portfolio_media_gallery = $portfolio_media_caption = $portfolio_gallery_choice = $portfolio_media_images_row = $portfolio_media_image_2_id = $portfolio_media_caption_2 = $portfolio_media_output = $portfolio_media_gallery_id = $portfolio_zigzag_media = $portfolio_zigzag_description = $portfolio_gutter_col_css = $portfolio_media_gutter_gallery = '';

                        if ( isset( $media['media_zigzag_column_count'] ) )
                            $portfolio_media_zigzag_column_count = esc_attr( $media['media_zigzag_column_count'] );

                        if ( isset( $media['description_zigzag_column_count'] ) )
                            $portfolio_description_zigzag_column_count = esc_attr( $media['description_zigzag_column_count'] );

                        if ( isset( $media['media_zigzag_alignment'] ) )
                            $portfolio_media_zigzag_alignment = esc_attr( $media['media_zigzag_alignment'] );

                        if ( isset( $media['description_zigzag'] ) )
                            $portfolio_description_zigzag = esc_attr( $media['description_zigzag'] );

                        if ( isset( $media['media_type'] ) )
                            $portfolio_media_type = esc_attr( $media['media_type'] );

                        if ( isset( $media['media_image_id'] ) )
                            $portfolio_media_image_id = esc_attr( $media['media_image_id'] );

                        if ( isset( $media['media_gallery'] ) )
                            $portfolio_media_gallery = $media['media_gallery'];

                        if ( isset( $media['media_caption'] ) )
                            $portfolio_media_caption = esc_attr( $media['media_caption'] );

                        if ( isset( $media['media_onclick'] ) )
                            $portfolio_media_onclick = esc_attr( $media['media_onclick'] );

                        if ( isset( $media['gallery_choice'] ) )
                            $portfolio_gallery_choice = esc_attr( $media['gallery_choice'] );

                        if ( isset( $media['media_grid_layout'] ) )
                            $portfolio_gallery_grid_layout = esc_attr( $media['media_grid_layout'] );

                        if ( isset( $media['media_images_row'] ) )
                            $portfolio_media_images_count = esc_attr( $media['media_images_row'] );

                        if ( isset( $media['media_carousel_type'] ) )
                            $portfolio_media_carousel_type = esc_attr( $media['media_carousel_type'] );

                        if ( isset( $media['media_carousel_height'] ) )
                            $portfolio_media_carousel_height = esc_attr( $media['media_carousel_height'] );

                        if ( isset( $media['media_image_2_id'] ) )
                            $portfolio_media_image_2_id = esc_attr( $media['media_image_2_id'] );

                        if ( isset( $media['media_caption_2'] ) )
                            $portfolio_media_caption_2 = esc_attr( $media['media_caption_2'] );

                        $portfolio_media_caption = ( $portfolio_media_caption == 'on' )?'img_caption="yes"':'';

                        switch ($portfolio_media_type) {
                            case 'image':
                                $portfolio_media_output = do_shortcode('[agni_image img_url="'.$portfolio_media_image_id.'" '.$portfolio_media_caption.' img_link="'.$portfolio_media_onclick.'" animation="1"]');

                                break;
                            case 'gallery':
                                $prefix = '';
                                foreach ( (array) $portfolio_media_gallery as $attachment_id => $attachment_url ) {
                                    $portfolio_media_gallery_id .= $prefix.$attachment_id;
                                    $prefix = ',';
                                }
                                
                                if( $portfolio_media_gutter == 'yes' ){
                                    $portfolio_media_gutter_gallery = 'gap="'.$portfolio_media_gutter_value.'"';
                                }
                                else{
                                    $portfolio_media_gutter_gallery = 'gap="0"';
                                }

                                if( $portfolio_gallery_choice == 'gallery' ){
                                    $portfolio_media_output = do_shortcode('[agni_gallery img_url="'.$portfolio_media_gallery_id.'" img_link="'.$portfolio_media_onclick.'" '.$portfolio_media_caption.' column="'.$portfolio_media_images_count.'" gallery-grid-layout="'.$portfolio_gallery_grid_layout.'" animation="1" '.$portfolio_media_gutter_gallery.']');
                                }
                                else if( $portfolio_gallery_choice == 'carousel' ){
                                    $portfolio_media_output = do_shortcode('[agni_gallery img_url="'.$portfolio_media_gallery_id.'" img_link="'.$portfolio_media_onclick.'" '.$portfolio_media_caption.' column="'.$portfolio_media_images_count.'" carousel="1" carousel_type="'.$portfolio_media_carousel_type.'" carousel_columns_1200="'.$portfolio_media_images_count.'" carousel_height="'.$portfolio_media_carousel_height.'" gallery_autoplay_hover="" animation="1" '.$portfolio_media_gutter_gallery.']');
                                }

                                break;
                            case 'beforeafter':
                                wp_enqueue_style( 'halena-beforeafter-style' );
                                wp_enqueue_script( 'halena-beforeafter-script' );
                                $portfolio_media_output = do_shortcode('[agni_image img_type="beforeafter" img_url="'.$portfolio_media_image_id.'" img_after_url="'.$portfolio_media_image_2_id.'" '.$portfolio_media_caption.' animation="1"]');
                                
                                break;
                            
                        }

                        if( $portfolio_layout == 'zigzag' ){
                            $zigzag_count++;
                            $portfolio_zigzag_media = '<div class="portfolio-zigzag-media portfolio-zigzag-column col-xs-12 col-sm-12 col-md-'.$portfolio_media_zigzag_column_count.'"><div class="portfolio-zigzag-column-inner">'.$portfolio_media_output.'</div></div>';
                            $portfolio_zigzag_description = '<div class="portfolio-zigzag-description portfolio-zigzag-column col-xs-12 col-sm-12 col-md-'.$portfolio_description_zigzag_column_count.'""><div class="portfolio-zigzag-column-inner">'.wp_specialchars_decode($portfolio_description_zigzag).'</div></div>';

                            $portfolio_media_output = ($portfolio_media_zigzag_alignment == 'md')?$portfolio_zigzag_media.$portfolio_zigzag_description:$portfolio_zigzag_description.$portfolio_zigzag_media;
                            $portfolio_media_output = '<div id="portfolio-zigzag-row-'.$zigzag_count.'" class="portfolio-zigzag-row row">'.$portfolio_media_output.'</div>';

                        }


                        if( $portfolio_media_gutter == 'yes' ){
                            $portfolio_gutter_col_css = 'style="padding: '.intval($portfolio_media_gutter_value/2).'px;"';
                        }

                        $portfolio_media .= '<div class="portfolio-'.$portfolio_layout.'-media" '.$portfolio_gutter_col_css.'>'.$portfolio_media_output.'</div>';
                    }

                    if( !empty($portfolio_project_detail) ){
                        foreach ( (array) $portfolio_project_detail as $key => $detail ) {
                            $portfolio_project_details .= '<span class="project-additional-detail">'.$detail.'</span>';
                        }
                        $portfolio_project_details = '<div class="project-additional-details">'.$portfolio_project_details.'</div>';
                    }

                    if( !empty($portfolio_project_title) ){
                        $portfolio_project_title = '<h4 class="project-title">'.$portfolio_project_title.'</h4>';
                    }
                    if( !empty($portfolio_project_description) ){
                        $portfolio_project_description = '<div class="project-description">'.$portfolio_project_description.'</div>';
                    }

                    ob_start();
                    if( $halena_options['portfolio-sharing-panel'] == '1' ){ ?>
                        <div class="portfolio-sharing-buttons sharing-buttons">
                            <span class="portfolio-sharing-icon"><i class="pe-7s-share"></i></span>
                            <ul class="portfolio-sharing-list">
                                <?php  if($halena_options['portfolio-sharing-icons'][1] == '1'){ ?>
                                    <li><a href="http://www.facebook.com/sharer.php?u=<?php esc_url( the_permalink() );?>/&amp;t=<?php echo esc_html( str_replace( ' ', '%20', the_title('', '', false) ) ); ?>"><i class="fa fa-facebook"></i></a></li>
                                <?php  }?>
                                <?php  if($halena_options['portfolio-sharing-icons'][2] == '1'){ ?>
                                    <li><a href="https://twitter.com/intent/tweet?text=<?php echo esc_html( str_replace( ' ', '%20', the_title('', '', false) ) ); ?> - <?php esc_url( the_permalink() ); ?>"><i class="fa fa-twitter"></i></a></li>
                                <?php  }?>
                                <?php  if($halena_options['portfolio-sharing-icons'][3] == '1'){ ?>             
                                    <li><a href="https://plus.google.com/share?url=<?php esc_url( the_permalink() );?>"><i class="fa fa-google-plus"></i></a></li>
                                <?php  }?>
                                <?php  if($halena_options['portfolio-sharing-icons'][4] == '1'){ ?>             
                                    <li><a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php esc_url( the_permalink() );?>&title=<?php echo esc_html( str_replace( ' ', '%20', the_title('', '', false) ) ); ?>"><i class="fa fa-linkedin"></i></a></li>
                                <?php  }?>
                            </ul>
                        </div>
                    <?php }

                    $portfolio_share_icons = ob_get_contents();
                    ob_clean();

                    if( !empty($portfolio_project_link) ){
                        $portfolio_project_link = '<div class="project-link">
                                <a href="'.$portfolio_project_link_url.'" class="btn btn-lg btn-accent" target="_blank">'.$portfolio_project_link.'</a>
                            </div>';
                    }

                    if( !empty($portfolio_project_detail) || !empty($portfolio_project_title) || !empty($portfolio_project_description) || !empty($portfolio_share_icons) || !empty($portfolio_project_link) ){
                        $portfolio_project_additional = '<div class="portfolio-project-details portfolio-project-details-style-'.$portfolio_additional_details_style.'">
                            <div class="portfolio-project-details-container container">
                                <div class="portfolio-project-details-inner">
                                    '.$portfolio_project_title.'
                                    <div class="project-content">
                                        '.$portfolio_project_description.$portfolio_project_details.'
                                    </div>
                                    '.$portfolio_project_link.'
                                </div>
                            </div>
                        </div>';
                    }

                    if( !empty($portfolio_share_icons) ){
                        $portfolio_project_additional .= $portfolio_share_icons;
                    }

                    ob_start(); ?>
                    <div class="portfolio-single-media-column col-xs-12 col-sm-12 col-md-<?php echo esc_attr( $portfolio_media_side_column_count ); ?>">
                        <div class="portfolio-single-media-container" <?php echo wp_kses_post( $portfolio_gutter_row_css ); ?>>
                            <?php echo wp_kses_post( $portfolio_media ); ?>
                        </div>
                    </div>
                    <?php
                    $portfolio_single_media = ob_get_contents();
                    ob_end_clean();

                    ob_start(); 
                    if( $portfolio_side_content_sticky == 'on' ){
                        $portfolio_side_content_sticky = ' has-fixed-single-content';
                    } ?>
                    <div class="portfolio-single-content-column col-xs-12 col-sm-12 col-md-<?php echo esc_attr( $portfolio_content_side_column_count.$portfolio_side_content_sticky ); ?>">
                        <div class="portfolio-single-content-inner">
                            <?php if( $page_remove_title != '1' ){
                                the_title( '<h1 class="portfolio-title text-'.$page_title_align.'">', '</h1>' ); ?>
                            <?php } 
                            if( !empty($post->post_content) ) {?>
                                <div class="portfolio-entry-content">
                                    <?php the_content(); ?>
                                </div>  <!-- .entry-content -->
                            <?php }
                            echo wp_kses_post( $portfolio_project_additional ); ?>
                        </div>
                    </div>
                    <?php
                    $portfolio_single_content = ob_get_contents();
                    ob_end_clean();

                    $portfolio_single = $portfolio_single_content;
                    if( $portfolio_layout == 'full' || $portfolio_layout == 'zigzag' ){
                        $portfolio_single = ( $portfolio_media_position == 'bottom' )?$portfolio_single_content.$portfolio_single_media:$portfolio_single_media.$portfolio_single_content;
                        $portfolio_single_row_class = 'portfolio-single-media-position-'.$portfolio_media_position;
                    }
                    else if( $portfolio_layout == 'side' ){
                        $portfolio_single = ( $portfolio_side_alignment == 'mc' )?$portfolio_single_media.$portfolio_single_content:$portfolio_single_content.$portfolio_single_media;
                    }
                 
                    ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class( 'portfolio-single-content portfolio-single-layout-'.$portfolio_layout ); ?>>  
                        <div class="portfolio-single-container <?php echo esc_attr( $page_layout ); ?>">
                            <div class="portfolio-single-row row <?php echo esc_attr( $portfolio_single_row_class ); ?>">
                                <?php echo $portfolio_single; ?>       
                            </div>
                        </div>
                    </article>
                    <?php if( $portfolio_navigation == '1' ){ ?>
                        <div class="portfolio-navigation-container navigation-container container-fluid">
                            <?php agni_framework_portfolio_nav(); ?>
                        </div>  
                    <?php } ?>
                    
                <?php endwhile; // end of the loop. ?>
            </main><!-- #main -->
        </div><!-- #primary -->
    <?php }
}

// 404
if( !function_exists('agni_404') ){
    function agni_404(){
        global $halena_options;

        if( $halena_options['404-choice'] == '1' && !empty($halena_options['404-contentblock-choice']) ){
            $contentblock_id = $halena_options['404-contentblock-choice'];
            if ( function_exists('icl_object_id') ) {
                if( ICL_LANGUAGE_CODE != 'en' ){
                    $contentblock_id = icl_object_id( $halena_options['404-contentblock-choice'] , 'agni_block', true, ICL_LANGUAGE_CODE );
                }
            }
            echo do_shortcode('[agni_block post_id="'.$contentblock_id.'"]');
        }
        else{
            if( !isset($halena_options['404-title']) ){
                $title_404 = esc_html__( '404', 'halena' );
            }
            else{
                $title_404 = esc_attr( $halena_options['404-title'] );
            }
            if( empty($halena_options['404-title']) ){
                $desc_404 = esc_html__( 'It looks like nothing was found at this location. Page could be removed/moved.', 'halena' );
            }
            else{
                $desc_404 = esc_attr( $halena_options['404-description-text'] );
            }
            ?><section class="page-404 page-404-content">
                <div class="page-container container">
                    <div id="primary" class="content-area">
                        <main id="main" class="site-main" role="main">
                            <div class="error-404 not-found">
                                <h1 class="page-title"><?php echo esc_html( $title_404 ); ?></h1>
                                <p><?php echo esc_html( $desc_404 ); ?></p>

                                <?php if( $halena_options['404-searchbox'] == '1'){
                                    echo get_search_form();
                                } ?>
                            </div><!-- .error-404 -->
                        </main><!-- #main -->
                    </div><!-- #primary -->
                </div>
            </section><?php 
        } 
    }
}

// Blog Posts
function agni_posts( $atts = null, $archive = null, $shortcode = null ){ 
    global $post, $halena_options; 

    $var = ( $shortcode == true )?'atts':'halena_options';

    $blog_categories = !empty(${$var}['blog-categories'])?esc_attr( ${$var}['blog-categories'] ):'';
    $blog_layout = isset( ${$var}['blog-layout'] )?esc_attr( ${$var}['blog-layout'] ):'standard';
    $blog_layout_grid_style = isset( ${$var}['blog-layout-grid-style'] )?esc_attr( ${$var}['blog-layout-grid-style'] ):'1';
    $blog_fullwidth_layout = !empty(${$var}['blog-fullwidth-layout'])?esc_attr( ${$var}['blog-fullwidth-layout'] ):'';
    $blog_column_layout = esc_attr( ${$var}['blog-column-layout'] );
    $blog_grid_layout = esc_attr( ${$var}['blog-grid-layout'] );
    $blog_navigation = esc_attr( ${$var}['blog-navigation'] );
    $blog_navigation_choice = esc_attr( ${$var}['blog-navigation-choice'] );
    $blog_navigation_ifs_btn_text = esc_attr( ${$var}['blog-navigation-ifs-btn-text'] );
    $blog_navigation_ifs_load_text = esc_attr( ${$var}['blog-navigation-ifs-load-text'] );
    $blog_navigation_ifs_finish_text = esc_attr( ${$var}['blog-navigation-ifs-finish-text'] );
    $blog_sidebar = isset( ${$var}['blog-sidebar'] )?esc_attr( ${$var}['blog-sidebar'] ):'no-sidebar';
    $blog_gutter = esc_attr( ${$var}['blog-gutter'] );
    $blog_gutter_value = esc_attr( ${$var}['blog-gutter-value'] );
    //$blog_thumbnail_hardcrop = esc_attr( ${$var}['blog-thumbnail-hardcrop'] );
    $blog_thumbnail_choice = esc_attr( ${$var}['blog-thumbnail-choice'] );
    $blog_thumbnail_dimension_custom = esc_attr( ${$var}['blog-thumbnail-dimension-custom'] );
    $blog_thumbnail_gs_filter = esc_attr( ${$var}['blog-thumbnail-gs-filter'] );
    $blog_thumbnail_clickable = isset( ${$var}['blog-thumbnail-clickable'] )?esc_attr( ${$var}['blog-thumbnail-clickable'] ):'';
    //$blog_content_choice = esc_attr( ${$var}['blog-content-choice'] );
    $blog_excerpt_length = isset( ${$var}['blog-excerpt-length'] )?esc_attr( ${$var}['blog-excerpt-length'] ):'150' ;
    //$blog_content_style = esc_attr( ${$var}['blog-content-style'] ); // New 
    //$blog_content_bg_color = esc_attr( ${$var}['blog-content-bg-color'] ); // New 
    //$blog_content_border_color = esc_attr( ${$var}['blog-content-border-color'] ); // New 
    $blog_content_align = esc_attr( ${$var}['blog-content-align'] ); // New 

    $blog_per_page = esc_attr( $halena_options['blog-per-page'] );
    $blog_post_include = esc_attr( $halena_options['blog-post-include'] );
    $blog_post_exclude = esc_attr( $halena_options['blog-post-exclude'] );
    $blog_post_order = esc_attr( $halena_options['blog-post-order'] );
    $blog_post_orderby = esc_attr( $halena_options['blog-post-orderby'] );
    $blog_carousel = esc_attr( $halena_options['blog-carousel'] );
    $blog_carousel_autoplay = esc_attr( $halena_options['blog-carousel-autoplay'] );
    $blog_carousel_autoplay_timeout = esc_attr( $halena_options['blog-carousel-autoplay-timeout'] );
    $blog_carousel_autoplay_speed = esc_attr( $halena_options['blog-carousel-autoplay-speed'] );
    $blog_carousel_autoplay_hover = esc_attr( $halena_options['blog-carousel-autoplay-hover'] );
    $blog_carousel_loop = esc_attr( $halena_options['blog-carousel-loop'] );
    $blog_carousel_pagination = esc_attr( $halena_options['blog-carousel-pagination'] );
    $blog_carousel_navigation = esc_attr( $halena_options['blog-carousel-navigation'] );
    $blog_animation = esc_attr( $halena_options['blog-animation'] );
    $blog_animation_style = esc_attr( $halena_options['blog-animation-style'] );
    $blog_animation_offset = esc_attr( $halena_options['blog-animation-offset'] );
    $blog_animation_delay = esc_attr( $halena_options['blog-animation-delay'] );
    $blog_animation_duration = esc_attr( $halena_options['blog-animation-duration'] );
    if( $shortcode == true ){
        $blog_per_page = esc_attr( $atts['posts_per_page'] );
        $blog_post_include = esc_attr( $atts['post_in'] );
        $blog_post_exclude = esc_attr( $atts['post_not_in'] );
        $blog_post_order = esc_attr( $atts['order'] );
        $blog_post_orderby = esc_attr( $atts['orderby'] );
        $blog_carousel = esc_attr( $atts['carousel'] );    
        $blog_carousel_autoplay = esc_attr( $atts['posttype_autoplay'] );
        $blog_carousel_autoplay_timeout = esc_attr( $atts['posttype_autoplay_timeout'] );
        $blog_carousel_autoplay_speed = esc_attr( $atts['posttype_autoplay_speed'] );
        $blog_carousel_autoplay_hover = esc_attr( $atts['posttype_autoplay_hover'] );
        $blog_carousel_loop = esc_attr( $atts['posttype_loop'] );
        $blog_carousel_pagination = esc_attr( $atts['posttype_pagination'] );
        $blog_carousel_navigation = esc_attr( $atts['posttype_navigation'] );
        $blog_animation = esc_attr( $atts['animation'] );
        $blog_animation_style = esc_attr( $atts['animation_style'] );
        $blog_animation_duration = esc_attr( $atts['animation_duration'] );
        $blog_animation_delay = esc_attr( $atts['animation_delay'] );
        $blog_animation_offset = esc_attr( $atts['animation_offset'] );
    }

    if( get_query_var('paged') != '' ){
        $paged = get_query_var('paged');
    }
    elseif( get_query_var('page') != '' ){
        $paged = get_query_var('page');
    }
    else{
        $paged = 1;
    }
    $include_ids = (!empty($blog_post_include))?explode( ',', $blog_post_include ):'';
    $exclude_ids = (!empty($blog_post_exclude))?explode( ',', $blog_post_exclude ):'';

    $blog_carousel_autoplay = ( $blog_carousel_autoplay == '1' )?'true':'false';
    $blog_carousel_autoplay_hover = ( $blog_carousel_autoplay_hover == '1' )?'true':'false';
    $blog_carousel_loop = ( $blog_carousel_loop == '1' )?'true':'false';
    $blog_carousel_pagination = ( $blog_carousel_pagination == '1' )?'true':'false';
    $blog_carousel_navigation = ( $blog_carousel_navigation == '1' )?'true':'false';

    $args = array(              
        'posts_per_page' => $blog_per_page,
        'max_num_pages' => $blog_per_page,
        'order' => $blog_post_order,
        'orderby' => $blog_post_orderby,
        'post__in'   => $include_ids, 
        'post__not_in'   => $exclude_ids, 
        'cat'  => $blog_categories,
        'paged'=> $paged
    ); 

    if( $archive == true ){ 
    	$blog_query = $GLOBALS['wp_query'];
    }
    else{
    	$blog_query = new WP_Query( $args );
    }           	

    $col = $post_additional_class = $i = $delay = $entry_content_style_bg = '';

    switch($blog_column_layout){
        case '1':
            $col = 'col-xs-12 col-sm-12 col-md-12 ';
            $column = 'data-post-0="1" data-post-768="1" data-post-992="1" data-post-1200="1"';
            break;
        case '2':
            $col = 'col-xs-12 col-sm-12 col-md-6 ';
            $column = 'data-post-0="1" data-post-768="1" data-post-992="2" data-post-1200="2"';
            break;
        case '3':
            $col = 'col-xs-6 col-sm-6 col-md-4 ';
            $column = 'data-post-0="1" data-post-768="2" data-post-992="3" data-post-1200="3"';
            break;
        case '4':
            $col = 'col-xs-6 col-sm-4 col-md-3 ';
            $column = 'data-post-0="1" data-post-768="2" data-post-992="3" data-post-1200="4"';
            break;
        case '5':
            $col = 'col-xs-6 col-sm-4 col-md-3 col-lg-2_5 ';
            $column = 'data-post-0="1" data-post-768="2" data-post-992="4" data-post-1200="5"';
            break;
    }
    if( $blog_carousel == '1' ){
        wp_enqueue_style( 'halena-slick-style' );
        wp_enqueue_script( 'halena-slick-script' );
        $col = '';
        $carousel_class = ' carousel-post';
    }
    else{
        $carousel_class = $column = '';
    }

    if( $blog_layout == 'grid' || $blog_layout == 'modern' ){
        $post_additional_class = 'grid-item grid-item-style-'.$blog_layout_grid_style.' '.$col;
        if( $blog_layout == 'modern' ){
            $post_additional_class .= 'modern '.$col;
        }
    }
    else if( $blog_layout == 'list' || $blog_layout == 'minimal-list' ){
        $post_additional_class = 'list-item ';
        if( $blog_layout == 'minimal-list' ){
            $post_additional_class .= 'minimal ';
        }
    }
    else{
        $post_additional_class = 'standard-item ';
    }

	if( $blog_gutter == '1' ){
        $blog_gutter_row_attr = 'data-gutter="'.$blog_gutter_value.'" ';
        $blog_gutter_row_css = 'style="';
        $blog_gutter_row_css .= 'margin: -'.intval($blog_gutter_value/2).'px; '; 
        if( $blog_fullwidth_layout == '1' ){
            $blog_gutter_row_css .= 'margin: 0 '.intval($blog_gutter_value/2).'px; '; 
        }
        $blog_gutter_row_css .= '"';
    }

    if( !function_exists('agni_post_readmore_btn') ){
        function agni_post_readmore_btn(){
            return '<a class="more-link" href="'. get_permalink( get_the_ID() ) . '">' . esc_html__( 'Read More', 'halena' ) . '</a>';
        }
    }
    
    ?>
    <section class="blog blog-post <?php echo esc_attr( ( $shortcode == true )?'shortcode-blog-post ':'' ); echo esc_html($blog_layout); ?>-layout-post <?php echo esc_attr( ($blog_fullwidth_layout == '1')?'has-fullwidth':'' ); ?>">
        <div class="blog-container container<?php echo esc_attr( ($blog_fullwidth_layout == '1')?'-fluid':'' ); echo esc_attr( ( $blog_gutter != '1' )?' blog-no-gutter':'' ); ?>">
            <div class="blog-row row <?php 
            if( $blog_navigation_choice == '3' || $blog_navigation_choice == '4' ){ 
                echo 'has-infinite-scroll ';
                echo esc_attr( ( $blog_navigation_choice == '4' )?'has-load-more ':'' );
            } 
            echo esc_attr( $blog_sidebar ); ?>">
                <div class="blog-column<?php if( $blog_carousel == '1' ){ echo ' carousel-blog-column'; }?> col-sm-12 col-md-<?php 
                    if( $blog_sidebar != 'no-sidebar' ){ 
                        echo '9'; 
                    }else { 
                        echo '12'; 
                    } ?> blog-post-content" <?php 
                    if( $blog_layout != 'standard' && $blog_layout != 'list' && $blog_layout != 'minimal-list' ){ 
                        echo 'data-blog-grid="'.$blog_grid_layout.'"'; 
                    } 

                ?>>
                    <div id="primary-blog" class="content-area">
                        <?php if( $archive == true ){ ?>
                            <header class="page-header-archive">
                                <?php if( is_search() ){ ?>
                                    <h4 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'halena' ), '<span>' . get_search_query() . '</span>' ); ?></h4>
                                <?php } 
                                else { 
                                    the_archive_title( '<h4 class="page-title">', '</h4>' );
                                    the_archive_description( '<div class="taxonomy-description">', '</div>' );
                                } ?>
                            </header>
                        <?php } ?>
                        <div id="main-blog" class="site-main<?php echo esc_attr( $carousel_class ); if( $blog_gutter == '1' ){ echo ' has-gutter'; }  ?>" <?php 
                        if( $blog_gutter == '1' && $blog_layout != 'standard' && $blog_layout != 'list' && $blog_layout != 'minimal-list' ){ 
                            echo wp_kses_post( $blog_gutter_row_css ); 
                        } ?> <?php 
			            if( $blog_gutter == '1' && $blog_layout != 'standard' && $blog_layout != 'list' && $blog_layout != 'minimal-list' ){ 
			                echo wp_kses_post( $blog_gutter_row_attr ); 
			            } ?> data-posttype-autoplay='<?php echo esc_attr( $blog_carousel_autoplay ); ?>' data-posttype-autoplay-timeout='<?php echo esc_attr( $blog_carousel_autoplay_timeout ); ?>' data-posttype-autoplay-speed='<?php echo esc_attr( $blog_carousel_autoplay_speed ); ?>' data-posttype-autoplay-hover='<?php echo esc_attr( $blog_carousel_autoplay_hover ); ?>' data-posttype-loop='<?php echo esc_attr( $blog_carousel_loop ); ?>' data-posttype-pagination='<?php echo esc_attr( $blog_carousel_pagination ); ?>'  data-posttype-navigation='<?php echo esc_attr( $blog_carousel_navigation ); ?>' <?php echo wp_kses_post( $column ); ?> data-rtl="<?php echo is_rtl()?'true':'false'; ?>">

                        <?php if ( $blog_query->have_posts() ) : 
                        	while ( $blog_query->have_posts() ) : $blog_query->the_post();

                                $post_thumbnail = $overlay = $post_title = $post_readmore_btn = $post_excerpt = $no_excerpt = $post_additional_attr = $post_additional_style = $entry_content_style_margin = '';

                                $post_format = get_post_format();
                                if( $blog_gutter == '1' && $blog_layout != 'standard' && $blog_layout != 'list' && $blog_layout != 'minimal-list' ){
                                    $post_additional_style = 'margin: '.intval($blog_gutter_value/2).'px 0; padding: 0 '.intval($blog_gutter_value/2).'px;';
                                    if( has_post_thumbnail() && $blog_layout != 'grid' ){ 
                                        $entry_content_style_margin .= ' margin: 0 '.intval($blog_gutter_value/2).'px;';
                                    }
                                }
                                $entry_content_style = ( !empty($entry_content_style_bg) || !empty($entry_content_style_margin) )?'style="'.$entry_content_style_bg.$entry_content_style_margin.'"':'';

                                if( has_post_thumbnail() ){ 
                                    if( $blog_thumbnail_choice == 'custom' ){
                                        $blog_thumbnail_customcrop_dimension = explode( 'x', $blog_thumbnail_dimension_custom );
                                        $post_thumbnail = agni_thumbnail_customcrop( get_post_thumbnail_id(), $blog_thumbnail_customcrop_dimension[0].'x'.$blog_thumbnail_customcrop_dimension[1], 'blog-thumbnail-attachment-image' );

                                    }
                                    else{
                                        $post_thumbnail = get_the_post_thumbnail( '',$blog_thumbnail_choice );

                                    }

                                    if( $blog_thumbnail_clickable == '1' ){
                                        $post_thumbnail = '<a href="'.esc_url( get_permalink() ).'">'.$post_thumbnail.'</a>';
                                    }

                                }elseif( !empty($post_format) && ($blog_layout == 'standard' || $blog_layout == 'grid') ){
                                    $post_format_function = 'agni_post_'.$post_format;
                                    if( function_exists($post_format_function) ){
                                        $post_thumbnail = $post_format_function($post->ID);
                                    }
                                }

                                if( $blog_layout == 'modern' || $blog_layout == 'minimal-list' ){
                                    $overlay = '<div class="overlay"></div>';
                                }

                                if( !empty($post_thumbnail) ){
                                    $grayscale = ($blog_thumbnail_gs_filter == '1')?'has-grayscale':'';
                                    $post_thumbnail = '<div class="entry-thumbnail '.$grayscale.'">
                                        '.$post_thumbnail.$overlay.'
                                    </div>';
                                }
                                
                                $post_title_tag = ( $blog_layout == 'standard' )?'h3':'h4';
                                $post_title = '<'.$post_title_tag.' class="entry-title"><a href="'.esc_url( get_permalink() ).'" rel="bookmark">'.get_the_title().'</a></'.$post_title_tag.'>';

                                $entry_meta = '<div class="entry-meta">
                                    '.agni_framework_post_date().agni_framework_post_cat().'
                                </div>';

                                $post_excerpt = (!empty($blog_excerpt_length))?agni_excerpt_length( $blog_excerpt_length ):'';

                                if( !empty($post_excerpt) ){
                                    $post_excerpt = '<div class="entry-post-excerpt">'.$post_excerpt.'</div>';
                                }

                                $post_readmore_btn = agni_post_readmore_btn();

                                if( $blog_animation == '1' ){

                                    if( $blog_layout == 'grid' || $blog_layout == 'modern' ){
                                        if( $i >= $blog_column_layout ){
                                            $delay = $i = 0;
                                        }
                                    }
                                    else{
                                        $delay = $i = 0;
                                    }
                                    $delay += $blog_animation_delay;
                                    $duration = $blog_animation_duration;
                                    $i += 1;

                                    $post_additional_class .= 'animate ';
                                    $post_additional_attr = 'data-animation="'.esc_attr($blog_animation_style).'" data-animation-offset="'.esc_attr($blog_animation_offset).'%"';
                                    $post_additional_style .= ' -webkit-animation-duration: '.$duration.'s; -webkit-animation-delay: '.$delay.'s; animation-duration: '.$duration.'s; animation-delay: '.$delay.'s;';
                                }
                                ?>

                                <article id="post-<?php esc_attr( the_ID() ); ?>" <?php post_class( $post_additional_class ); ?> style="<?php echo esc_attr( $post_additional_style ); ?>" <?php echo wp_kses_post( $post_additional_attr ); ?>>
                                    <?php switch( $blog_layout ){
                                        case 'grid': 
                                            echo wp_kses_post( $post_thumbnail ).'
                                            <div class="entry-content text-'.$blog_content_align.'" '.$entry_content_style.'>'.
                                                $entry_meta.$post_title.$post_excerpt.$post_readmore_btn.'
                                            </div>';
                                            break;
                                        case 'modern':
                                            echo  wp_kses_post( $post_thumbnail ).'
                                            <div class="entry-content" '.$entry_content_style.'>'.
                                                $post_title.$entry_meta.'
                                            </div>';
                                            break;
                                        case 'list':
                                            echo  wp_kses_post( $post_thumbnail ).'
                                            <div class="entry-content text-'.$blog_content_align.'" '.$entry_content_style.'>'.
                                                $entry_meta.$post_title.$post_excerpt.$post_readmore_btn.'
                                            </div>';
                                            break;
                                        case 'minimal-list':
                                            echo  wp_kses_post( $post_thumbnail ).'
                                            <div class="entry-content">
                                                <div class="entry-container container">'.
                                                $entry_meta.$post_title.'
                                                </div>
                                            </div>';
                                            break;
                                        default : 
                                            echo '<div class="entry-content text-'.$blog_content_align.'" '.$entry_content_style.'>'.
                                                $entry_meta.$post_title.'
                                            </div><div class="entry-thumbnail-container">'.$post_thumbnail.'<div class="entry-excerpt-container">'.$post_excerpt.$post_readmore_btn.'</div></div>';
                                            break;
                                    } ?>
                                </article>

                            <?php endwhile; 
                        else : ?>

                            <?php get_template_part( 'template/content', 'none' ); ?>

                        <?php endif; ?>
                        
                        <?php if( $blog_carousel != '1' && $blog_layout != 'standard' && $blog_layout != 'list' && $blog_layout != 'minimal-list' ){ ?>
                            <div class="grid-sizer <?php echo esc_attr( $col ); ?>"></div>
                        <?php }?>

                        </div><!-- #main -->
                        <?php
                        if( $blog_navigation == '1' && $blog_carousel != '1' ){ 
                            if( $blog_navigation_choice == '3' || $blog_navigation_choice == '4' ){ 
                                $load_more_button = ( $blog_navigation_choice == '4' )?'<span class="btn btn-accent">'.$blog_navigation_ifs_btn_text.'</span>':'';
                                echo '<div class="load-more" data-msg-text="'.$blog_navigation_ifs_load_text.'" data-finished-text="'.$blog_navigation_ifs_finish_text.'">'.$load_more_button.'</div>';
                            } 
                            if( $blog_navigation_choice != '1' ){ 
                                echo agni_page_navigation( $blog_query, $number_navigation = 'post-number-navigation' ); 
                            }else{ 
                                if( $archive != true && $shortcode == true && $blog_query->have_posts() ){

                                    $GLOBALS['wp_query']->max_num_pages = $blog_query->max_num_pages;
                                }
                                the_posts_navigation(array( 
                                    'prev_text' => esc_html__( 'Older posts', 'halena' ), 
                                    'next_text' => esc_html__( 'Newer Posts', 'halena' ), 
                                )); 
                            }
                        } 
                        if( !isset(${$var}['blog-navigation']) ){
                            the_posts_navigation(array( 
                                'prev_text' => esc_html__( 'Older posts', 'halena' ), 
                                'next_text' => esc_html__( 'Newer Posts', 'halena' ), 
                            )); 
                        } ?>
                    </div><!-- #primary -->
                </div>
                <?php if( $blog_sidebar != 'no-sidebar' ){ ?>
                    <div class="blog-column col-sm-12 col-md-3 blog-post-sidebar">
                        <?php get_sidebar(); ?>
                    </div>
                <?php }?>
            </div>
        </div>
    </section>
<?php }
add_action( 'agni_posts_init', 'agni_posts', 10, 3 );

// Portfolio Posts
function agni_portfolio( $atts = null, $shortcode = null ){
    global $halena_options, $post;

    $portfolio_filter_fullwidth = $portfolio_gutter_row_css = $portfolio_gutter_row_attr = $tax_args = $portfolio_thumbnail_individual_settings = '';

    $var = ( $shortcode == true )?'atts':'halena_options';

    $portfolio_categories = !empty(${$var}['portfolio-categories'])?esc_attr( ${$var}['portfolio-categories'] ):'';
    $portfolio_fullwidth = !empty(${$var}['portfolio-fullwidth'])?esc_attr( ${$var}['portfolio-fullwidth'] ):'';
    $portfolio_grid = esc_attr( ${$var}['portfolio-grid'] );
    $portfolio_layout = esc_attr( ${$var}['portfolio-layout'] );
    $portfolio_filter = esc_attr( ${$var}['portfolio-filter'] );
    $portfolio_filter_align = esc_attr( ${$var}['portfolio-filter-align'] );
    $portfolio_filter_order = esc_attr( ${$var}['portfolio-filter-order'] );
    $portfolio_filter_orderby = esc_attr( ${$var}['portfolio-filter-orderby'] );
    $portfolio_filter_all_text = esc_attr( ${$var}['portfolio-filter-all-text'] );
    $portfolio_gutter = esc_attr( ${$var}['portfolio-gutter'] );
    $portfolio_gutter_value = esc_attr( ${$var}['portfolio-gutter-value'] );
    $portfolio_hover_style = esc_attr( ${$var}['portfolio-hover-style'] );
    $portfolio_hover_color = esc_attr( ${$var}['portfolio-hover-color'] );
    $portfolio_hover_show_title = esc_attr( ${$var}['portfolio-hover-show-title'] );
    $portfolio_hover_show_category = esc_attr( ${$var}['portfolio-hover-show-category'] );
    $portfolio_hover_show_attachment_link = esc_attr( ${$var}['portfolio-hover-show-attachment-link'] );
    $portfolio_hover_show_link = esc_attr( ${$var}['portfolio-hover-show-link'] );
    $portfolio_thumbnail_hardcrop = esc_attr( ${$var}['portfolio-thumbnail-hardcrop'] );
    $portfolio_thumbnail_dimension_custom = esc_attr( ${$var}['portfolio-thumbnail-dimension-custom'] );
    $portfolio_thumbnail_gs_filter = esc_attr( ${$var}['portfolio-thumbnail-gs-filter'] );
    $portfolio_bottom_style = !empty(${$var}['portfolio-bottom-style'])?esc_attr( ${$var}['portfolio-bottom-style'] ):'';
    $portfolio_bottom_bg_color = !empty(${$var}['portfolio-bottom-bg-color'])?esc_attr( ${$var}['portfolio-bottom-bg-color'] ):'';
    $portfolio_bottom_border_color = !empty(${$var}['portfolio-bottom-border-color'])?esc_attr( ${$var}['portfolio-bottom-border-color'] ):'';
    $portfolio_bottom_align = !empty(${$var}['portfolio-bottom-align'])?esc_attr( ${$var}['portfolio-bottom-align'] ):'';
    $portfolio_bottom_title = esc_attr( ${$var}['portfolio-bottom-title'] );
    $portfolio_bottom_category = esc_attr( ${$var}['portfolio-bottom-category'] );
    $portfolio_post_link_target = esc_attr( ${$var}['portfolio-post-link-target'] );
    $portfolio_navigation = esc_attr( ${$var}['portfolio-navigation'] );
    $portfolio_navigation_choice = esc_attr( ${$var}['portfolio-navigation-choice'] );
    $portfolio_navigation_ifs_btn_text = esc_attr( ${$var}['portfolio-navigation-ifs-btn-text'] );
    $portfolio_navigation_ifs_load_text = esc_attr( ${$var}['portfolio-navigation-ifs-load-text'] );
    $portfolio_navigation_ifs_finish_text = esc_attr( ${$var}['portfolio-navigation-ifs-finish-text'] );
    
    $portfolio_hover_bg_color = esc_attr( $halena_options['portfolio-hover-bg-color']['rgba'] );
    $portfolio_carousel = esc_attr( $halena_options['portfolio-carousel'] );
    $portfolio_carousel_autoplay = esc_attr( $halena_options['portfolio-carousel-autoplay'] );
    $portfolio_carousel_autoplay_timeout = esc_attr( $halena_options['portfolio-carousel-autoplay-timeout'] );
    $portfolio_carousel_autoplay_speed = esc_attr( $halena_options['portfolio-carousel-autoplay-speed'] );
    $portfolio_carousel_autoplay_hover = esc_attr( $halena_options['portfolio-carousel-autoplay-hover'] );
    $portfolio_carousel_loop = esc_attr( $halena_options['portfolio-carousel-loop'] );
    $portfolio_carousel_pagination = esc_attr( $halena_options['portfolio-carousel-pagination'] );
    $portfolio_carousel_navigation = esc_attr( $halena_options['portfolio-carousel-navigation'] );
    $portfolio_per_page = esc_attr( $halena_options['portfolio-per-page'] );
    $portfolio_post_include = esc_attr( $halena_options['portfolio-post-include'] );
    $portfolio_post_exclude = esc_attr( $halena_options['portfolio-post-exclude'] );
    $portfolio_post_order = esc_attr( $halena_options['portfolio-post-order'] );
    $portfolio_post_orderby = esc_attr( $halena_options['portfolio-post-orderby'] );
    $portfolio_animation = esc_attr( $halena_options['portfolio-animation'] );
    $portfolio_animation_style = esc_attr( $halena_options['portfolio-animation-style'] );
    $portfolio_animation_duration = esc_attr( $halena_options['portfolio-animation-duration'] );
    $portfolio_animation_delay = esc_attr( $halena_options['portfolio-animation-delay'] );
    $portfolio_animation_offset = esc_attr( $halena_options['portfolio-animation-offset'] );
    if( $shortcode == true ){
        $portfolio_hover_bg_color = esc_attr( $atts['portfolio-hover-bg-color'] );
        $portfolio_per_page = esc_attr( $atts['posts_per_page'] );
        $portfolio_post_include = esc_attr( $atts['post_in'] );
        $portfolio_post_exclude = esc_attr( $atts['post_not_in'] );
        $portfolio_post_order = esc_attr( $atts['order'] );
        $portfolio_post_orderby = esc_attr( $atts['orderby'] );
        $portfolio_thumbnail_individual_settings = esc_attr( $atts['portfolio_thumbnail_individual_settings'] );   
        $portfolio_carousel = esc_attr( $atts['carousel'] );    
        $portfolio_carousel_autoplay = esc_attr( $atts['posttype_autoplay'] );
        $portfolio_carousel_autoplay_timeout = esc_attr( $atts['posttype_autoplay_timeout'] );
        $portfolio_carousel_autoplay_speed = esc_attr( $atts['posttype_autoplay_speed'] );
        $portfolio_carousel_autoplay_hover = esc_attr( $atts['posttype_autoplay_hover'] );
        $portfolio_carousel_loop = esc_attr( $atts['posttype_loop'] );
        $portfolio_carousel_pagination = esc_attr( $atts['posttype_pagination'] );
        $portfolio_carousel_navigation = esc_attr( $atts['posttype_navigation'] );
        $portfolio_animation = esc_attr( $atts['animation'] );
        $portfolio_animation_style = esc_attr( $atts['animation_style'] );
        $portfolio_animation_duration = esc_attr( $atts['animation_duration'] );
        $portfolio_animation_delay = esc_attr( $atts['animation_delay'] );
        $portfolio_animation_offset = esc_attr( $atts['animation_offset'] );
    }

    //$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    if( get_query_var('paged') != '' ){
        $paged = get_query_var('paged');
    }
    elseif( get_query_var('page') != '' ){
        $paged = get_query_var('page');
    }
    else{
        $paged = 1;
    }
    $include_ids = (!empty($portfolio_post_include))?explode( ',', $portfolio_post_include ):'';
    $exclude_ids = (!empty($portfolio_post_exclude))?explode( ',', $portfolio_post_exclude ):'';

    $portfolio_carousel_autoplay = ( $portfolio_carousel_autoplay == '1' )?'true':'false';
    $portfolio_carousel_autoplay_hover = ( $portfolio_carousel_autoplay_hover == '1' )?'true':'false';
    $portfolio_carousel_loop = ( $portfolio_carousel_loop == '1' )?'true':'false';
    $portfolio_carousel_pagination = ( $portfolio_carousel_pagination == '1' )?'true':'false';
    $portfolio_carousel_navigation = ( $portfolio_carousel_navigation == '1' )?'true':'false';

    if ( !empty( $portfolio_categories ) ) {            
        $tax_args = array( array(
            'taxonomy' => 'types',
            'field' => 'term_id',
            'terms' =>  explode( ',', $portfolio_categories )
        ) );
    }
    $args = array(          
        'post_type' => array( 'portfolio' ),            
        'posts_per_page' => $portfolio_per_page,
        'order' => $portfolio_post_order,
        'orderby' => $portfolio_post_orderby,
        'post__in'   => $include_ids, 
        'post__not_in'   => $exclude_ids, 
        'tax_query' => $tax_args,
        'paged'=> $paged   
    ); 
    
    $query = new WP_Query( $args );
    
    switch($portfolio_layout){
        case '1':
            $col = 'col-xs-12 col-sm-12 col-md-12';
            $column = 'data-post-0="1" data-post-768="1" data-post-992="1" data-post-1200="1"';
            break;
        case '2':
            $col = 'col-xs-12 col-sm-12 col-md-6';
            $column = 'data-post-0="1" data-post-768="1" data-post-992="2" data-post-1200="2"';
            break;
        case '3':
            $col = 'col-xs-12 col-sm-6 col-md-4';
            $column = 'data-post-0="1" data-post-768="2" data-post-992="3" data-post-1200="3"';
            break;
        case '4':
            $col = 'col-xs-12 col-sm-6 col-md-3';
            $column = 'data-post-0="1" data-post-768="2" data-post-992="3" data-post-1200="4"';
            break;
        case '5':
            $col = 'col-xs-12 col-sm-4 col-md-3 col-lg-2_5';
            $column = 'data-post-0="1" data-post-768="2" data-post-992="4" data-post-1200="5"';
            break;
    }
    if( $portfolio_carousel == '1' ){
        wp_enqueue_style( 'halena-slick-style' );
        wp_enqueue_script( 'halena-slick-script' );
        $portfolio_filter = $col = '';
        $carousel_class = ' carousel-portfolio';
    }
    else{
        $carousel_class = $column = '';
        wp_enqueue_script( 'halena-isotope-script' );
    }

    if( $portfolio_gutter == '1' ){
        $portfolio_gutter_row_attr = 'data-gutter="'.$portfolio_gutter_value.'" ';
        $portfolio_gutter_row_css = 'style="';
        if( $portfolio_carousel == '1' ){
            if( $portfolio_fullwidth == '1' ){
                $portfolio_gutter_row_css .= 'padding: 0 '.intval($portfolio_gutter_value).'px; ';
            }
        }
        else{
            $portfolio_gutter_row_css .= 'margin: 0 -'.intval($portfolio_gutter_value/2).'px; '; 
            /*if( $portfolio_fullwidth == '1' ){
                $portfolio_gutter_row_css .= 'margin: 0 '.intval($portfolio_gutter_value/2).'px; '; 
            }*/
        }
        $portfolio_gutter_row_css .= '"'; 
    }

    $portfolio_bottom_caption_css = '';
    if( $portfolio_bottom_style == 'background' && !empty($portfolio_bottom_bg_color) ){
        $portfolio_bottom_caption_css = 'style="background-color:'.$portfolio_bottom_bg_color.'; "';
    }
    else if( $portfolio_bottom_style == 'border' && !empty($portfolio_bottom_border_color) ) {
        $portfolio_bottom_caption_css = 'style="border-color:'.$portfolio_bottom_border_color.'; "';
    }

    $portfolio_bottom_caption_class = ( !empty($portfolio_bottom_style) )?' portfolio-bottom-caption-has-'.$portfolio_bottom_style:'';
    $portfolio_bottom_caption_class .= ' text-'.$portfolio_bottom_align;

    if( $portfolio_filter == '1' && $portfolio_carousel != '1' ){ 
        /*if( $portfolio_fullwidth == '1' ){
            $portfolio_filter_fullwidth = 'container-fluid ';
        }*/
        $portfolio_filter = '<div class="portfolio-filter text-'.esc_attr($portfolio_filter_align).'">'.agni_portfolio_filter( $portfolio_filter_order, $portfolio_filter_orderby, $portfolio_filter_all_text ).'</div>';
    }

    ?>
    <div id="primary-portfolio" class="page-portfolio content-area <?php echo esc_attr( ( $shortcode == true )?'shortcode-page-portfolio':'' ); ?>">
        <div id="main-portfolio" class="page-portfolio-container container<?php echo esc_attr( ( $portfolio_fullwidth == '1' )?'-fluid ':'' ); ?> site-main">
            <div class="portfolio-container<?php echo esc_attr( ( $portfolio_fullwidth == '1' )?' portfolio-fullwidth':'' ); echo esc_attr( ( $portfolio_gutter != '1' )?' portfolio-no-gutter':'' ); echo esc_attr( ( $portfolio_thumbnail_hardcrop == '1')?' has-hardcrop':'' ); 
                if( $portfolio_navigation_choice == '2' || $portfolio_navigation_choice == '3' ){ 
                    echo ' has-infinite-scroll'; 
                    echo esc_attr( ( $portfolio_navigation_choice == '3')?' has-load-more':'' );
                } ?>">

                <?php echo wp_kses_post( $portfolio_filter ); ?>
                <div class="row portfolio-row<?php echo esc_attr( $carousel_class ); if( $portfolio_thumbnail_individual_settings == '1' ){ echo ' ignore-thumbnail-settings'; } ?>" <?php echo wp_kses_post( $portfolio_gutter_row_css ); ?> <?php echo wp_kses_post( $portfolio_gutter_row_attr ); ?> data-grid="<?php echo esc_attr( $portfolio_grid ); ?>" <?php echo wp_kses_post( $column ); ?> data-posttype-autoplay="<?php echo esc_attr( $portfolio_carousel_autoplay ); ?>" data-posttype-autoplay-timeout="<?php echo esc_attr( $portfolio_carousel_autoplay_timeout ); ?>" data-posttype-autoplay-speed="<?php echo esc_attr( $portfolio_carousel_autoplay_speed ); ?>" data-posttype-autoplay-hover="<?php echo esc_attr( $portfolio_carousel_autoplay_hover ); ?>" data-posttype-loop="<?php echo esc_attr( $portfolio_carousel_loop ); ?>" data-posttype-pagination="<?php echo esc_attr( $portfolio_carousel_pagination ); ?>" data-posttype-navigation="<?php echo esc_attr( $portfolio_carousel_navigation ); ?>" data-rtl="<?php echo is_rtl()?'true':'false'; ?>">
                    <?php $i = $delay = 0; if ( $query->have_posts() ) :
                    while ( $query->have_posts() ) : $query->the_post(); 

                        $portfolio_additional_class = $portfolio_additional_attr = $portfolio_additional_style = $portfolio_category_list = $portfolio_category = $portfolio_thumbnail_hover_css = $portfolio_show_title = $portfolio_show_category = $portfolio_show_link = $portfolio_show_attachment_link = $portfolio_show_bottom = $portfolio_show_bottom_title = $portfolio_show_bottom_category = $portfolio_meta = '';
                        $portfolio_thumbnail_width = ( $portfolio_thumbnail_individual_settings != '1' )?esc_attr( get_post_meta( $post->ID, 'portfolio_thumbnail_width', true ) ):'width1x';
                        $portfolio_thumbnail_height = esc_attr( get_post_meta( $post->ID, 'portfolio_thumbnail_height', true ) );
                        $portfolio_thumbnail_hover_style = esc_attr( get_post_meta( $post->ID, 'portfolio_thumbnail_hover_style', true ) );
                        $portfolio_thumbnail_native_hover = esc_attr( get_post_meta( $post->ID, 'portfolio_thumbnail_native_hover', true ) );
                        $portfolio_thumbnail_hover_bg_color = esc_attr( get_post_meta( $post->ID, 'portfolio_thumbnail_hover_bg_color', true ) );
                        $portfolio_thumbnail_hover_color = esc_attr( get_post_meta( $post->ID, 'portfolio_thumbnail_hover_color', true ) );
                        $portfolio_thumbnail_custom_link = esc_url( get_post_meta( $post->ID, 'portfolio_thumbnail_custom_link', true ) );

                        $portfolio_thumbnail_link = ( !empty($portfolio_thumbnail_custom_link) ) ? $portfolio_thumbnail_custom_link : get_permalink();
                        $portfolio_thumbnail_hover_style = ( !empty($portfolio_thumbnail_hover_style) )?$portfolio_thumbnail_hover_style : $portfolio_hover_style;
                        $portfolio_thumbnail_native_hover = ( !empty($portfolio_thumbnail_native_hover) )?' has-native-hover':'';
                        if( $portfolio_thumbnail_hover_bg_color == '' ){
                            $portfolio_thumbnail_hover_bg_color = $portfolio_hover_bg_color;
                        } 
                        $portfolio_thumbnail_hover_bg_color = ($portfolio_thumbnail_hover_bg_color != '')?'background-color:'.$portfolio_thumbnail_hover_bg_color.'; ':'';
                        if( $portfolio_thumbnail_hover_color == '' ){
                            $portfolio_thumbnail_hover_color = $portfolio_hover_color;
                        }
                        $portfolio_thumbnail_hover_color = ($portfolio_thumbnail_hover_color != '')?'color:'.$portfolio_thumbnail_hover_color.'; ':'';
                        
                        if( $portfolio_thumbnail_hover_bg_color != '' || $portfolio_thumbnail_hover_color != '' ){
                            $portfolio_thumbnail_hover_css = 'style="'.$portfolio_thumbnail_hover_bg_color.$portfolio_thumbnail_hover_color.'"';
                        }

                        $terms = get_the_terms( $post->ID, 'types' );
                        if ( $terms && ! is_wp_error( $terms ) ) {
                            foreach ( $terms as $term ){
                                $portfolio_category .= strtolower($term->slug).' ';
                                $portfolio_category_list .= '<li><a href="'.esc_url( $portfolio_thumbnail_link ).'" target="'.esc_attr( $portfolio_post_link_target ).'">'.$term->name.'</a></li>';
                            }
                        }

                        if( $portfolio_thumbnail_hardcrop == '1'){
                            $portfolio_thumbnail_customcrop_dimension = explode( 'x', $portfolio_thumbnail_dimension_custom );
                            
                            if( $portfolio_thumbnail_individual_settings != '1' ){
                                if( $portfolio_thumbnail_width == 'width2x' && $portfolio_thumbnail_height == 'height1x' ){
                                    $portfolio_thumbnail_customcrop_dimension[0] = ($portfolio_thumbnail_customcrop_dimension[0]*2);
                                }
                                else if( $portfolio_thumbnail_width == 'width1x' && $portfolio_thumbnail_height == 'height2x' ){
                                    $portfolio_thumbnail_customcrop_dimension[1] = ($portfolio_thumbnail_customcrop_dimension[1]*2);
                                }
                                else if( $portfolio_thumbnail_width == 'width1x' && $portfolio_thumbnail_height == 'height3x' ){
                                    $portfolio_thumbnail_customcrop_dimension[1] = ($portfolio_thumbnail_customcrop_dimension[1]*3);
                                }
                                else if( $portfolio_thumbnail_width == 'width3x' && $portfolio_thumbnail_height == 'height1x' ){
                                    $portfolio_thumbnail_customcrop_dimension[0] = ($portfolio_thumbnail_customcrop_dimension[0]*3);
                                }
                                else if( $portfolio_thumbnail_width == 'width3x' && $portfolio_thumbnail_height == 'height2x' ){
                                    $portfolio_thumbnail_customcrop_dimension[0] = ($portfolio_thumbnail_customcrop_dimension[0]*3);
                                    $portfolio_thumbnail_customcrop_dimension[1] = ($portfolio_thumbnail_customcrop_dimension[1]*2);
                                }
                                else if( $portfolio_thumbnail_width == 'width2x' && $portfolio_thumbnail_height == 'height3x' ){
                                    $portfolio_thumbnail_customcrop_dimension[1] = ($portfolio_thumbnail_customcrop_dimension[1]*3);
                                    $portfolio_thumbnail_customcrop_dimension[0] = ($portfolio_thumbnail_customcrop_dimension[0]*2);
                                }
                                else if( $portfolio_thumbnail_width == 'width2x' && $portfolio_thumbnail_height == 'height2x' ){
                                    $portfolio_thumbnail_customcrop_dimension[1] = ($portfolio_thumbnail_customcrop_dimension[1]*2);
                                    $portfolio_thumbnail_customcrop_dimension[0] = ($portfolio_thumbnail_customcrop_dimension[0]*2);
                                }
                                else if( $portfolio_thumbnail_width == 'width3x' && $portfolio_thumbnail_height == 'height3x' ){
                                    $portfolio_thumbnail_customcrop_dimension[1] = ($portfolio_thumbnail_customcrop_dimension[1]*3);
                                    $portfolio_thumbnail_customcrop_dimension[0] = ($portfolio_thumbnail_customcrop_dimension[0]*3);
                                }
                            }

                            $portfolio_thumbnail = agni_thumbnail_customcrop( get_post_thumbnail_id(), $portfolio_thumbnail_customcrop_dimension[0].'x'.$portfolio_thumbnail_customcrop_dimension[1], 'portfolio-thumbnail-attachment-image' );
                            
                            if( $portfolio_gutter == '1' && $portfolio_thumbnail_individual_settings != '1' && !empty($portfolio_thumbnail) ){
                                $xpath = new DOMXPath(@DOMDocument::loadHTML($portfolio_thumbnail));
                                $src = $xpath->evaluate("string(//img/@src)");
                                $portfolio_thumbnail .= '<div class="portfollio-thumbnail-bg" style="background-image:url('.$src.')"></div>';
                            }
                            
                            $portfolio_additional_attr .= ' data-hardcrop="true" data-thumbnail-width="'.$portfolio_thumbnail_customcrop_dimension[0].'" data-thumbnail-height="'.$portfolio_thumbnail_customcrop_dimension[1].'"';
                        }
                        else{
                            $portfolio_thumbnail = get_the_post_thumbnail();
                        }
                        if( $portfolio_gutter == '1' && $portfolio_carousel != '1' ){
                            $portfolio_additional_style = 'margin: '.intval($portfolio_gutter_value/2).'px 0; padding: 0 '.intval($portfolio_gutter_value/2).'px;';
                        }

                        $portfolio_additional_class = 'portfolio-column portfolio-post portfolio-hover-style-'.esc_attr($portfolio_thumbnail_hover_style).$portfolio_thumbnail_native_hover.' all '.$portfolio_category.' '.$portfolio_thumbnail_width.' '.$portfolio_thumbnail_height.' '.$col;

                        if($portfolio_thumbnail_gs_filter){ 
                            $portfolio_additional_class .= ' has-grayscale'; 
                        }

                        if( $portfolio_hover_show_title == '1' ){
                            $portfolio_show_title = '<h5 class="portfolio-title"><a href="'.$portfolio_thumbnail_link.'" target="'.$portfolio_post_link_target.'">'.get_the_title().'</a></h5>';
                        }
                        if( $portfolio_hover_show_category == '1' ){
                            $portfolio_show_category = '<ul class="portfolio-category list-inline">'.$portfolio_category_list.'</ul>';
                        }
                        if( $portfolio_hover_show_link == '1' ){
                            $portfolio_show_link = '<a href="'.$portfolio_thumbnail_link.'" target="'.$portfolio_post_link_target.'"><i class="pe-7s-link"></i></a>';
                        }
                        if( $portfolio_hover_show_attachment_link == '1' ){
                            $portfolio_show_attachment_link = '<a href="'.wp_get_attachment_url( get_post_thumbnail_id($post->ID) ).'" class="portfolio-attachment"><i class="pe-7s-photo"></i></a>';
                        }
                        if( $portfolio_hover_show_link == '1' || $portfolio_hover_show_attachment_link == '1' ){
                            $portfolio_meta = '<div class="portfolio-meta">'.$portfolio_show_link.$portfolio_show_attachment_link.'</div>';
                        }
                        if( $portfolio_bottom_title == '1' ){
                            $portfolio_show_bottom_title = '<h5 class="portfolio-bottom-caption-title"><a href="'.$portfolio_thumbnail_link.'" target="'.$portfolio_post_link_target.'">'.get_the_title().'</a></h5>';
                        }
                        if( $portfolio_bottom_category == '1' ){
                            $portfolio_show_bottom_category = '<ul class="portfolio-bottom-caption-category list-inline">'.$portfolio_category_list.'</ul>';
                        }
                        if( $portfolio_bottom_title == '1' || $portfolio_bottom_category == '1' ){
                            $portfolio_additional_class .= ' has-bottom-caption'; 
                            $portfolio_show_bottom = '<div class="portfolio-bottom-caption '.$portfolio_bottom_caption_class.'" '.$portfolio_bottom_caption_css.'>'.$portfolio_show_bottom_title.$portfolio_show_bottom_category.'</div>';
                        }

                        /*if( $i >= $portfolio_layout ){
                            $delay = $i = 0;
                        }
                        $delay += $portfolio_animation_delay; // Animation Delay 0.4;
                        $duration = $portfolio_animation_duration;  // Animation Duration 0.8;
                        if( $portfolio_thumbnail_width == 'width2x' ){
                            $i += 2;
                        }
                        else if( $portfolio_thumbnail_width == 'width3x' ){
                            $i += 3;
                        }
                        else{
                            $i += 1;  // Animation Iteration
                        }
                        if( $portfolio_animation == '1' ){
                            $portfolio_additional_class .= ' animate';
                            $portfolio_additional_attr .= ' data-animation="'.esc_attr($portfolio_animation_style).'" data-animation-offset="'.esc_attr($portfolio_animation_offset).'%"';
                            $portfolio_additional_style .= ' -webkit-animation-duration: '.$duration.'s; -webkit-animation-delay: '.$delay.'s; animation-duration: '.$duration.'s; animation-delay: '.$delay.'s;';
                        }*/

                        ?><div id="portfolio-post-<?php esc_attr( the_ID() ); ?>" class="<?php echo esc_attr( $portfolio_additional_class ); ?>" <?php echo wp_kses_post( $portfolio_additional_attr ); ?> style="<?php echo esc_attr( $portfolio_additional_style ); ?>">
                            <div class="portfolio-content-container" <?php echo wp_kses_post( $portfolio_thumbnail_hover_css ); ?>>
                                <div class="portfolio-thumbnail">
                                    <?php echo wp_kses_post( $portfolio_thumbnail ); ?>
                                </div> 
                                <div class="portfolio-caption-content">
                                    <a class="portfolio-content-link" href="<?php echo esc_url( $portfolio_thumbnail_link ); ?>" target="<?php echo esc_attr( $portfolio_post_link_target ); ?>"></a>
                                    <div class="portfolio-content-inner" <?php if( $portfolio_thumbnail_hover_style == '3' ){ echo wp_kses_post( $portfolio_thumbnail_hover_css ); } ?>>
                                        <div class="portfolio-content-details">
                                            <?php echo wp_kses_post( $portfolio_show_title.$portfolio_show_category ); ?>
                                        </div>
                                        <?php echo wp_kses_post( $portfolio_meta ); ?>
                                    </div>
                                </div>
                            </div>
                            <?php echo wp_kses_post( $portfolio_show_bottom ); ?>
                        </div><?php 
                    endwhile;
                    endif; 

                    if( $portfolio_carousel != '1' ){ ?>
                        <div class="grid-sizer <?php echo esc_attr( $col ); ?>"></div>
                    <?php }

                    // Reset Post Data
                    wp_reset_postdata(); ?>
                </div>
                <?php 
                if( $portfolio_navigation == '1' && $portfolio_carousel != '1' ){ 
                    if( $portfolio_navigation_choice == '2' || $portfolio_navigation_choice == '3' ){ 
                        $load_more_button = ( $portfolio_navigation_choice == '3' )?'<span class="btn btn-accent">'.$portfolio_navigation_ifs_btn_text.'</span>':'';
                        echo '<div class="load-more" data-msg-text="'.$portfolio_navigation_ifs_load_text.'" data-finished-text="'.$portfolio_navigation_ifs_finish_text.'">'.$load_more_button.'</div>';
                    } 
                    
                    echo agni_page_navigation( $query, $number_navigation = 'portfolio-number-navigation' ); 
                } ?>
            </div>
        </div><!-- #main -->
    </div><!-- #primary --> 
<?php }
add_action( 'agni_portfolio_init', 'agni_portfolio', 10, 2 );


// Agni Slider Button generator
function agni_slider_button_generator( $args ){
    $output = $btn_link = '';
    $args['btn'] = ( $args['btn_text_hide'] != 'on' )?$args['btn']:'';

    if( !empty($args['btn_icon']) ){
        $args['btn_icon'] = '<i class="'.$args['btn_icon'].'"></i>';
    }
    if( !empty($args['btn_radius']) ){
        $args['btn_radius'] = 'style="border-radius:'.( preg_match( '/(px|em|\%|pt|cm)$/', $args['btn_radius'] ) ? $args['btn_radius'] : $args['btn_radius'] . 'px' ).';"';
    }
    if( $args['btn_has_animation'] == 'has-slide-content-animation'){
        $args['btn_animation_delay'] = 'style="-webkit-animation-delay: '.$args['btn_animation_delay_amount'].'ms; animation-delay: '.$args['btn_animation_delay_amount'].'ms;"';
    }
    if( $args['btn_lightbox'] == 'on' && !empty($args['btn_embed_url']) ){
        wp_enqueue_style('halena-photoswipe-style'); 
        wp_enqueue_script('halena-photoswipe-script'); 

        $args['btn_lightbox'] = 'custom-video-link has-video-lightbox';
        $btn_link = '<button class="btn btn-'.$args['btn_style'].' '.$args['btn_type'].' '.$args['btn_icon_style'].'" '.$args['btn_radius'].' data-modal=\''.$args['btn_embed_url'].'\'>'.$args['btn'].$args['btn_icon'].'</button>';
    }
    else{
        $btn_link = '<a class="btn btn-'.$args['btn_style'].' '.$args['btn_type'].' '.$args['btn_icon_style'].'" href="'.$args['btn_url'].'" target="'.$args['btn_target'].'" '.$args['btn_radius'].'>'.$args['btn'].$args['btn_icon'].'</a>';
    }
    $output = '<div class="agni-slide-btn-container agni-slide-btn page-scroll '.$args['btn_lightbox'].' '.$args['btn_animation'].'" '.$args['btn_animation_delay'].'>'.$btn_link.'</div>';

    return $output;
}

if( !function_exists('agni_page_header') ){
    function agni_page_header( $post, $term = null ){
        
        $rtl = ( is_rtl() )?'true':'false';

        if( $term == true ){
            $meta_fn = 'get_term_meta';
        }
        else{
            $meta_fn = 'get_post_meta';
        }

        $output = $slider_height = $slide_parallax = $page_header_overlay = '';
        $page_header_bg_choice = $page_header_bg_color = $page_header_bg_image = $page_header_bg_image_position = $page_header_bg_image_repeat = $page_header_bg_image_size = $agni_slide_bg_container_id = $page_header_bg_video_loop = $page_header_bg_video_src_yt_mobile  = $page_header_bg_video_autoplay = $page_header_bg_video_muted = $bg_video_loop = $player_yt_mobile = $bg_video_autoplay = $bg_video_muted = $page_header_overlay_choice = $page_header_overlay_color = $page_header_bg_sg_overlay_css = $page_header_bg_gm_overlay_color1 = $page_header_bg_gm_overlay_color2 = $page_header_bg_gm_overlay_color3 = $page_header_particle_ground = $page_header_bg = $page_header_size = $page_header_image = $page_header_title = $page_header_title_effect = $page_header_title_size = $page_header_title_color = $page_header_desc = $page_header_desc_size = $page_header_desc_color = $page_header_title_line = $page_header_title_line_color = $page_header_button1 = $page_header_button1_icon = $page_header_button1_url = $page_header_button1_style = $page_header_button1_type = $page_header_button1_radius = $page_header_button1_target = $page_header_button1_lightbox = $page_header_button2 = $page_header_button2_icon = $page_header_button2_url = $page_header_button2_style = $page_header_button2_type = $page_header_button2_radius = $page_header_button2_target = $page_header_button2_lightbox = $page_header_button1_embed_url = $page_header_buttons = $page_header_has_animation = $page_header_animation_delay = $page_header_animation_delay_amount = $page_header_arrow = $page_header_arrowicon = $page_header_arrowlink = $page_header_arrowicon_color = $page_header_content_position = $page_header_text_alignment = $slider_css = $slider_class = $slide_content_class = $slide_content_css = $slide_content_attr = '';
        
        $page_header_bg_choice = esc_attr( $meta_fn( $post, 'page_header_bg_choice', true ) );
        $page_header_bg_color = esc_attr( $meta_fn( $post, 'page_header_bg_color', true ) );
        $page_header_bg_image = esc_attr( $meta_fn( $post, 'page_header_bg_image', true ) );
        $page_header_bg_image_position = esc_attr( $meta_fn( $post, 'page_header_bg_image_position', true ) );
        $page_header_bg_image_repeat = esc_attr( $meta_fn( $post, 'page_header_bg_image_repeat', true ) );
        $page_header_bg_image_size = esc_attr( $meta_fn( $post, 'page_header_bg_image_size', true ) );

        $page_header_bg_video_src = esc_attr( $meta_fn( $post, 'page_header_bg_video_src', true ) );
        $page_header_bg_video_src_yt = esc_url( $meta_fn( $post, 'page_header_bg_video_src_yt', true ) );
        $page_header_bg_video_src_yt_fallback = esc_url( $meta_fn( $post, 'page_header_bg_video_src_yt_fallback', true ) );
        $page_header_bg_video_src_sh = esc_url( $meta_fn( $post, 'page_header_bg_video_src_sh', true ) );
        $page_header_bg_video_src_sh_poster = esc_url( $meta_fn( $post, 'page_header_bg_video_src_sh_poster', true ) );
        $page_header_bg_video_loop = esc_attr( $meta_fn( $post, 'page_header_bg_video_loop', true ) );
        $page_header_bg_video_src_yt_mobile = esc_attr( $meta_fn( $post, 'page_header_bg_video_src_yt_mobile', true ) );
        $page_header_bg_video_autoplay = esc_attr( $meta_fn( $post, 'page_header_bg_video_autoplay', true ) );
        $page_header_bg_video_muted = esc_attr( $meta_fn( $post, 'page_header_bg_video_muted', true ) );
        $page_header_bg_video_volume = esc_attr( $meta_fn( $post, 'page_header_bg_video_volume', true ) );
        $page_header_bg_video_quality = esc_attr( $meta_fn( $post, 'page_header_bg_video_quality', true ) );
        $page_header_bg_video_start_at = esc_attr( $meta_fn( $post, 'page_header_bg_video_start_at', true ) );
        $page_header_bg_video_stop_at = esc_attr( $meta_fn( $post, 'page_header_bg_video_stop_at', true ) );

        $page_header_overlay_choice = esc_attr( $meta_fn( $post, 'page_header_bg_overlay_choice', true ) );
        $page_header_overlay_color = esc_attr( $meta_fn( $post, 'page_header_bg_overlay_color', true ) );      
        $page_header_bg_sg_overlay_css = esc_attr( $meta_fn( $post, 'page_header_bg_sg_overlay_css', true ) );
        $page_header_bg_gm_overlay_color1 = esc_attr( $meta_fn( $post, 'page_header_bg_gm_overlay_color1', true ) );   
        $page_header_bg_gm_overlay_color2 = esc_attr( $meta_fn( $post, 'page_header_bg_gm_overlay_color2', true ) );   
        $page_header_bg_gm_overlay_color3 = esc_attr( $meta_fn( $post, 'page_header_bg_gm_overlay_color3', true ) );   

        $page_header_bg_particle_ground = esc_attr( $meta_fn( $post, 'page_header_bg_particle_ground', true ) );
        $page_header_bg_particle_ground_color = esc_attr( $meta_fn( $post, 'page_header_bg_particle_ground_color', true ) );       

        $page_header_image_id = esc_attr( $meta_fn( $post, 'page_header_image_id', true ) );
        $page_header_image_size = esc_attr( $meta_fn( $post, 'page_header_image_size', true ) );
        $page_header_image_size_tab = esc_attr( $meta_fn( $post, 'page_header_image_size_tab', true ) );
        $page_header_image_size_mobile = esc_attr( $meta_fn( $post, 'page_header_image_size_mobile', true ) );
        $page_header_title_choice = esc_attr( $meta_fn( $post, 'page_header_title_choice', true ) );
        $page_header_title = esc_attr( $meta_fn( $post, 'page_header_title', true ) );
        $page_header_title_rotator = esc_attr( $meta_fn( $post, 'page_header_title_rotator', true ) );
        $page_header_title_rotator_choice = esc_attr( $meta_fn( $post, 'page_header_title_rotator_choice', true ) );
        $page_header_title_size = esc_attr( $meta_fn( $post, 'page_header_title_size', true ) );   
        $page_header_title_color = esc_attr( $meta_fn( $post, 'page_header_title_color', true ) ); 
        $page_header_title_font = esc_attr( $meta_fn( $post, 'page_header_title_font', true ) );
        $page_header_title_margin_bottom = esc_attr( $meta_fn( $post, 'page_header_title_margin_bottom', true ) );
        $page_header_title_line = esc_attr( $meta_fn( $post, 'page_header_line', true ) );
        $page_header_title_line_color = esc_attr( $meta_fn( $post, 'page_header_line_color', true ) );
        $page_header_desc = esc_attr( $meta_fn( $post, 'page_header_desc', true ) );   
        $page_header_desc_size = esc_attr( $meta_fn( $post, 'page_header_desc_size', true ) );
        $page_header_desc_color = esc_attr( $meta_fn( $post, 'page_header_desc_color', true ) );   
        $page_header_desc_font = esc_attr( $meta_fn( $post, 'page_header_desc_font', true ) );
        $page_header_desc_margin_bottom = esc_attr( $meta_fn( $post, 'page_header_desc_margin_bottom', true ) );
        $page_header_arrowicon = esc_attr( $meta_fn( $post, 'page_header_arrowicon', true ) );
        $page_header_arrowlink = esc_url( $meta_fn( $post, 'page_header_arrowlink', true ) );
        $page_header_arrowicon_color = esc_attr( $meta_fn( $post, 'page_header_arrowicon_color', true ) );
        $page_header_button1 = esc_attr( $meta_fn( $post, 'page_header_button1', true ) );
        $page_header_button1_icon = esc_attr( $meta_fn( $post, 'page_header_button1_icon', true ) );
        $page_header_button1_icon_style = esc_attr( $meta_fn( $post, 'page_header_button1_icon_style', true ) );
        $page_header_button1_text_hide = esc_attr( $meta_fn( $post, 'page_header_button1_text_hide', true ) );
        $page_header_button1_url = esc_url( $meta_fn( $post, 'page_header_button1_url', true ) );
        $page_header_button1_style = esc_attr( $meta_fn( $post, 'page_header_button1_style', true ) );
        $page_header_button1_type = esc_attr( $meta_fn( $post, 'page_header_button1_type', true ) );
        $page_header_button1_radius = esc_attr( $meta_fn( $post, 'page_header_button1_radius', true ) );
        $page_header_button1_target = esc_attr( $meta_fn( $post, 'page_header_button1_target', true ) );
        $page_header_button1_lightbox = esc_attr( $meta_fn( $post, 'page_header_button1_lightbox', true ) );
        $page_header_button1_embed_url = esc_html( $meta_fn( $post, 'page_header_button1_embed_url', true ) );
        $page_header_button2 = esc_attr( $meta_fn( $post, 'page_header_button2', true ) );
        $page_header_button2_icon = esc_attr( $meta_fn( $post, 'page_header_button2_icon', true ) );
        $page_header_button2_icon_style = esc_attr( $meta_fn( $post, 'page_header_button2_icon_style', true ) );
        $page_header_button2_text_hide = esc_attr( $meta_fn( $post, 'page_header_button2_text_hide', true ) );
        $page_header_button2_url = esc_url( $meta_fn( $post, 'page_header_button2_url', true ) );
        $page_header_button2_style = esc_attr( $meta_fn( $post, 'page_header_button2_style', true ) );
        $page_header_button2_type = esc_attr( $meta_fn( $post, 'page_header_button2_type', true ) );
        $page_header_button2_radius = esc_attr( $meta_fn( $post, 'page_header_button2_radius', true ) );
        $page_header_button2_target = esc_attr( $meta_fn( $post, 'page_header_button2_target', true ) );
        $page_header_button2_lightbox = esc_attr( $meta_fn( $post, 'page_header_button2_lightbox', true ) );
        $page_header_button2_embed_url = esc_html( $meta_fn( $post, 'page_header_button2_embed_url', true ) );
        $page_header_breadcrumb = esc_attr( $meta_fn( $post, 'page_header_breadcrumb', true ) );
        $page_header_breadcrumb_color = esc_attr( $meta_fn( $post, 'page_header_breadcrumb_color', true ) );
        $page_header_animation = esc_attr( $meta_fn( $post, 'page_header_animation', true ) );
        
        $page_header_content_width = esc_attr( $meta_fn( $post, 'page_header_content_width', true ) );
        $page_header_content_width_tab = esc_attr( $meta_fn( $post, 'page_header_content_width_tab', true ) );
        $page_header_content_width_mobile = esc_attr( $meta_fn( $post, 'page_header_content_width_mobile', true ) );
        $page_header_content_position = esc_attr( $meta_fn( $post, 'page_header_content_position', true ) );
        $page_header_text_alignment = esc_attr( $meta_fn( $post, 'page_header_text_alignment', true ) );

        $page_header_padding_top = esc_attr( $meta_fn( $post, 'page_header_padding_top', true ) );
        $page_header_padding_bottom = esc_attr( $meta_fn( $post, 'page_header_padding_bottom', true ) );
        $page_header_padding_right = esc_attr( $meta_fn( $post, 'page_header_padding_right', true ) );
        $page_header_padding_left = esc_attr( $meta_fn( $post, 'page_header_padding_left', true ) );
        $page_header_padding_top_tab = esc_attr( $meta_fn( $post, 'page_header_padding_top_tab', true ) );
        $page_header_padding_bottom_tab = esc_attr( $meta_fn( $post, 'page_header_padding_bottom_tab', true ) );
        $page_header_padding_right_tab = esc_attr( $meta_fn( $post, 'page_header_padding_right_tab', true ) );
        $page_header_padding_left_tab = esc_attr( $meta_fn( $post, 'page_header_padding_left_tab', true ) );
        $page_header_padding_top_mobile = esc_attr( $meta_fn( $post, 'page_header_padding_top_mobile', true ) );
        $page_header_padding_bottom_mobile = esc_attr( $meta_fn( $post, 'page_header_padding_bottom_mobile', true ) );
        $page_header_padding_right_mobile = esc_attr( $meta_fn( $post, 'page_header_padding_right_mobile', true ) );
        $page_header_padding_left_mobile = esc_attr( $meta_fn( $post, 'page_header_padding_left_mobile', true ) );
        
        $page_header_choice = esc_attr( $meta_fn( $post, 'page_header_choice', true ) );
        $page_header_height = esc_attr( $meta_fn( $post, 'page_header_height', true ) );
        $page_header_height_tab = esc_attr( $meta_fn( $post, 'page_header_height_tab', true ) );
        $page_header_height_mobile = esc_attr( $meta_fn( $post, 'page_header_height_mobile', true ) );

        $page_header_margin_top = esc_attr( $meta_fn( $post, 'page_header_margin_top', true ) );
        $page_header_margin_right = esc_attr( $meta_fn( $post, 'page_header_margin_right', true ) );
        $page_header_margin_bottom = esc_attr( $meta_fn( $post, 'page_header_margin_bottom', true ) );
        $page_header_margin_left = esc_attr( $meta_fn( $post, 'page_header_margin_left', true ) );
        $page_header_margin_top_tab = esc_attr( $meta_fn( $post, 'page_header_margin_top_tab', true ) );
        $page_header_margin_right_tab = esc_attr( $meta_fn( $post, 'page_header_margin_right_tab', true ) );
        $page_header_margin_bottom_tab = esc_attr( $meta_fn( $post, 'page_header_margin_bottom_tab', true ) );
        $page_header_margin_left_tab = esc_attr( $meta_fn( $post, 'page_header_margin_left_tab', true ) );
        $page_header_margin_top_mobile = esc_attr( $meta_fn( $post, 'page_header_margin_top_mobile', true ) );
        $page_header_margin_right_mobile = esc_attr( $meta_fn( $post, 'page_header_margin_right_mobile', true ) );
        $page_header_margin_bottom_mobile = esc_attr( $meta_fn( $post, 'page_header_margin_bottom_mobile', true ) );
        $page_header_margin_left_mobile = esc_attr( $meta_fn( $post, 'page_header_margin_left_mobile', true ) );

        $page_header_parallax = esc_attr( $meta_fn( $post, 'page_header_parallax', true ) );
        $page_header_parallax_start = esc_attr( $meta_fn( $post, 'page_header_parallax_start', true ) );
        $page_header_parallax_end = esc_attr( $meta_fn( $post, 'page_header_parallax_end', true ) );

        //if( !empty( $page_header_bg_image ) || $page_header_bg_choice != 'bg_image' ){
        if( !empty( $page_header_bg_image ) || !empty( $page_header_bg_color ) || $page_header_bg_choice == 'bg_video' || $page_header_bg_choice == 'bg_featured' ){

            wp_enqueue_style( 'halena-slick-style' );
            wp_enqueue_script( 'halena-slick-script' );

            if( $page_header_choice == '1' ){
                $slider_height = 'data-fullscreen-height = 1';
            }
            else{
                $slider_height = 'data-height="'.$page_header_height.'" data-height-tab="'.$page_header_height_tab.'" data-height-mobile="'.$page_header_height_mobile.'"';
            }
            
            if( $page_header_parallax == 'on' ){
                $slide_parallax = 'data-0="'.$page_header_parallax_start.'" data-1500="'.$page_header_parallax_end.'"';
            }   

            if( !empty($page_header_animation) ){
                $page_header_has_animation = 'has-slide-content-animation';
                $page_header_animation_delay_amount = 0;
            }
            if( !empty($page_header_image_id) ){
                if( $page_header_has_animation == 'has-slide-content-animation'){
                    $page_header_animation_delay = ' -webkit-animation-delay: '.$page_header_animation_delay_amount.'ms; animation-delay: '.$page_header_animation_delay_amount.'ms;';
                    $page_header_animation_delay_amount += 250;
                }
                $page_header_image_width = 'data-width="'.$page_header_image_size.'" data-width-tab="'.$page_header_image_size_tab.'" data-width-mobile="'.$page_header_image_size_mobile.'"';

                $page_header_image = '<div class="agni-slide-image '.$page_header_animation.'" style="'.$page_header_animation_delay.'" '.$page_header_image_width.'>'.wp_get_attachment_image($page_header_image_id, 'full' ).'</div>';
            }

            $page_header_title = ( $page_header_title_choice == '2' )?get_the_title():$page_header_title;
            if ( !empty( $page_header_title ) ){
                if( $page_header_has_animation == 'has-slide-content-animation'){
                    $page_header_animation_delay = ' -webkit-animation-delay: '.$page_header_animation_delay_amount.'ms; animation-delay: '.$page_header_animation_delay_amount.'ms;';
                    $page_header_animation_delay_amount += 250;
                }

                if ( strpos($page_header_title, '|') !== false && $page_header_title_rotator == 'on') {
                    $page_header_title_span = $page_header_title_no_span[0] = $page_header_title_no_span[1] = '';

                    wp_enqueue_style( 'halena-cd-animated-headlines-style' );
                    wp_enqueue_script( 'halena-cd-animated-headlines-script' );

                    $page_header_title_effect = 'class="cd-headline '.$page_header_title_rotator_choice.'"';

                    $page_header_title_decode = wp_specialchars_decode( $page_header_title );
                    $pattern = '/<span>(.*?)<\/span>/';
                    $page_header_title_no_span  = preg_split( $pattern, $page_header_title_decode );

                    $page_header_title_span_content = substr($page_header_title_decode, strpos($page_header_title_decode, "<span>") + 0);
                    $page_header_title_span_content = substr($page_header_title_span_content, 0, strpos($page_header_title_span_content, "</span>") + 7);
                    $page_header_title_span_content = explode( "|", $page_header_title_span_content );
                    foreach( $page_header_title_span_content as $page_header_title_span_text ){
                        $page_header_title_span .=  '<span class="rotate">'.$page_header_title_span_text.'</span>';
                    }
                    $page_header_title_span = str_replace('<span class="rotate"><span>', '<span class="cd-words-wrapper"><span class="rotate is-visible">', $page_header_title_span);
                    
                    $page_header_title = $page_header_title_no_span[0].$page_header_title_span.$page_header_title_no_span[1];
                }
                $page_header_title = '<div class="agni-slide-title '.$page_header_animation.' '.$page_header_title_font.'" style="font-size:'.$page_header_title_size.'px; color:'.$page_header_title_color.'; margin-bottom:'.( preg_match( '/(px|em|\%|pt|cm)$/', $page_header_title_margin_bottom ) ? $page_header_title_margin_bottom : $page_header_title_margin_bottom . 'px' ).'; '.$page_header_animation_delay.'"><h2 '.$page_header_title_effect.'>'.wp_specialchars_decode( $page_header_title ).'</h2></div>';

            }

            if ( $page_header_title_line == 'on' ){
                if( $page_header_has_animation == 'has-slide-content-animation'){
                    $page_header_animation_delay = 'style="-webkit-animation-delay: '.$page_header_animation_delay_amount.'ms; animation-delay: '.$page_header_animation_delay_amount.'ms;"';
                    $page_header_animation_delay_amount += 250;
                }
                $page_header_title_line = '<div class="agni-slide-divideline divide-line '.$page_header_animation.'" '.$page_header_animation_delay.'><span style="background-color:'.$page_header_title_line_color.'"></span></div>';  
            }
            
            if ( !empty( $page_header_desc ) ){
                if( $page_header_has_animation == 'has-slide-content-animation'){
                    $page_header_animation_delay = ' -webkit-animation-delay: '.$page_header_animation_delay_amount.'ms; animation-delay: '.$page_header_animation_delay_amount.'ms;';
                    $page_header_animation_delay_amount += 250;
                }
                $page_header_desc = '<div class="agni-slide-description '.$page_header_animation.' '.$page_header_desc_font.'" style="font-size:'.$page_header_desc_size.'px; color:'.$page_header_desc_color.'; margin-bottom:'.( preg_match( '/(px|em|\%|pt|cm)$/', $page_header_desc_margin_bottom ) ? $page_header_desc_margin_bottom : $page_header_desc_margin_bottom . 'px' ).'; '.$page_header_animation_delay.'"><p>'.wp_specialchars_decode( $page_header_desc ).'</p></div>';
            }
            if( $page_header_breadcrumb == 'on' ){
                if( $page_header_has_animation == 'has-slide-content-animation'){
                    $page_header_animation_delay = ' -webkit-animation-delay: '.$page_header_animation_delay_amount.'ms; animation-delay: '.$page_header_animation_delay_amount.'ms;';
                    $page_header_animation_delay_amount += 250;
                }
                ob_start();
                agni_breadcrumb_navigation();
                $page_header_breadcrumb = ob_get_clean();
                $page_header_breadcrumb = '<div class="agni-page-header-breadcrumb '.$page_header_animation.'" style="color:'.$page_header_breadcrumb_color.'; '.$page_header_animation_delay.'">'.$page_header_breadcrumb.'</div>';
            }

            if ( !empty($page_header_arrowicon) ){
                $page_header_arrow = '<div class="agni-slide-arrow page-scroll"><a href="'.$page_header_arrowlink.'" style="color:'.$page_header_arrowicon_color.'"><i class="'.
            $page_header_arrowicon.'"></i></a></div>';
            }

            if( !empty($page_header_button1) ){
                $args = array( 
                    'btn' => $page_header_button1, 
                    'btn_icon' => $page_header_button1_icon, 
                    'btn_icon_style' => $page_header_button1_icon_style, 
                    'btn_text_hide' => $page_header_button1_text_hide, 
                    'btn_url' => $page_header_button1_url, 
                    'btn_style' => $page_header_button1_style, 
                    'btn_type' => $page_header_button1_type, 
                    'btn_radius' => $page_header_button1_radius, 
                    'btn_target' => $page_header_button1_target, 
                    'btn_lightbox' => $page_header_button1_lightbox, 
                    'btn_embed_url' => $page_header_button1_embed_url,
                    'btn_animation' => $page_header_animation, 
                    'btn_has_animation' => $page_header_has_animation, 
                    'btn_animation_delay' => $page_header_animation_delay, 
                    'btn_animation_delay_amount' => $page_header_animation_delay_amount 
                    );
                $page_header_buttons .= agni_slider_button_generator( $args );
                if( !empty($page_header_animation_delay_amount) ){
                    $page_header_animation_delay_amount += 250;
                }
            }
            if( !empty($page_header_button2) ){
                 $args = array( 
                    'btn' => $page_header_button2, 
                    'btn_icon' => $page_header_button2_icon, 
                    'btn_icon_style' => $page_header_button2_icon_style, 
                    'btn_text_hide' => $page_header_button2_text_hide, 
                    'btn_url' => $page_header_button2_url, 
                    'btn_style' => $page_header_button2_style, 
                    'btn_type' => $page_header_button2_type, 
                    'btn_radius' => $page_header_button2_radius, 
                    'btn_target' => $page_header_button2_target, 
                    'btn_lightbox' => $page_header_button2_lightbox, 
                    'btn_embed_url' => $page_header_button2_embed_url,
                    'btn_animation' => $page_header_animation, 
                    'btn_has_animation' => $page_header_has_animation, 
                    'btn_animation_delay' => $page_header_animation_delay, 
                    'btn_animation_delay_amount' => $page_header_animation_delay_amount 
                    );
                $page_header_buttons .= agni_slider_button_generator( $args );
               if( !empty($page_header_animation_delay_amount) ){
                    $page_header_animation_delay_amount += 250;
                }
            }
            if( !empty($page_header_buttons) ){
                $page_header_buttons = '<div class="agni-slide-buttons">'.$page_header_buttons.'</div>';
            } 
            

            $margin_side = array('top', 'right', 'bottom', 'left');
            $margin_device = array('', '_tab', '_mobile');
            $slide_args = array();
            foreach ( $margin_device as $device ) {
                foreach( $margin_side as $value ){
                    $slide_args['margin_'.$value.$device] = (!empty(${'page_header_margin_'.$value.$device}))?${'page_header_margin_'.$value.$device}:'';
                }
            }

            $slider_css_array = array_filter( agni_space_atts_processor( $slide_args ) );
            if( !empty($slider_css_array[0]) ){
                $slider_css .= ' style="'.$slider_css_array[0].'" data-css-default="'.$slider_css_array[0].'"';
            }
            if( !empty($slider_css_array[1]) ){
                $slider_css .= ' data-css-tab="'.$slider_css_array[1].'"';
            }
            if( !empty($slider_css_array[2]) ){
                $slider_css .= ' data-css-mobile="'.$slider_css_array[2].'"';
            }

            if( !empty($slider_css) ){
                $slider_class = 'agni_custom_design_css';
            }


            if ( !empty( $page_header_content_width ) ){
                $slide_content_css .= 'max-width:'.( preg_match( '/(px|em|\%|pt|cm)$/', $page_header_content_width ) ? $page_header_content_width : $page_header_content_width . 'px' ).'; ';
                $slide_content_class .= ' agni_custom_content_width';
                $slide_content_attr .= ' data-content-width="'.$page_header_content_width.'"';
            }
            if ( !empty( $page_header_content_width_tab ) ){
                $slide_content_attr .= ' data-content-width-tab="'.$page_header_content_width_tab.'"';
            }
            if ( !empty( $page_header_content_width_mobile ) ){
                $slide_content_attr .= ' data-content-width-mobile="'.$page_header_content_width_mobile.'"';
            }
            
            $padding_side = array('top', 'right', 'bottom', 'left');
            $padding_device = array('', '_tab', '_mobile');
            $slide_args = array();
            foreach ( $padding_device as $device ) {
                foreach( $padding_side as $value ){
                    $slide_args['padding_'.$value.$device] = (!empty(${'page_header_padding_'.$value.$device}))?${'page_header_padding_'.$value.$device}:'';
                }
            }

            $slide_css_array = array_filter( agni_space_atts_processor( $slide_args ) );

            if( !empty($slide_css_array[0]) ){
                $slide_content_css .= $slide_css_array[0];
                $slide_content_attr .= ' data-css-default="'.$slide_css_array[0].'"';
            }
            if( !empty($slide_css_array[1]) ){
                $slide_content_attr .= ' data-css-tab="'.$slide_css_array[1].'"';
            }
            if( !empty($slide_css_array[2]) ){
                $slide_content_attr .= ' data-css-mobile="'.$slide_css_array[2].'"';
            }

            if( !empty($slide_css_array) ){
                $slide_content_class .= ' agni_custom_design_css';
            }
            
            // BG
            if ( $page_header_bg_choice == 'bg_color' ){
                $page_header_bg = '<div class="agni-slide-bg agni-slide-bg-color" style="background-color:'.$page_header_bg_color.'; "></div>';
            }
            else if( $page_header_bg_choice == 'bg_image' && $page_header_bg_image != '' ){
                $page_header_bg = '<div class="agni-slide-bg agni-slide-bg-image" style="background-image:url('.esc_url( $page_header_bg_image ).'); background-repeat:'.$page_header_bg_image_repeat.'; background-position:'.$page_header_bg_image_position.'; background-size:'.$page_header_bg_image_size.'; "></div>';
            }
            else if( $page_header_bg_choice == 'bg_video' ){

                if( $page_header_bg_video_loop == 'on'){
                    $page_header_bg_video_loop = 'true';
                    $bg_video_loop = 'loop ';
                }
                else{
                    $page_header_bg_video_loop = 'false';
                }

                if( $page_header_bg_video_src_yt_mobile == 'on'){
                    $page_header_bg_video_src_yt_mobile = 'true';
                    $player_yt_mobile = ' has-mobile-video';
                }
                else{
                    $page_header_bg_video_src_yt_mobile = 'false';
                }
                
                if( $page_header_bg_video_autoplay == 'on'){
                    $page_header_bg_video_autoplay = 'true';
                    $bg_video_autoplay = 'autoplay ';
                }
                else{
                    $page_header_bg_video_autoplay = 'false';
                }
                
                if( $page_header_bg_video_muted == 'on'){
                    $page_header_bg_video_muted = 'true';
                    $bg_video_muted = 'muted ';
                }
                else{
                    $page_header_bg_video_muted = 'false';
                }

                if( $page_header_bg_video_src == '1' ){

                    if (strpos($page_header_bg_video_src_yt, 'youtube') > 0) {
                        wp_enqueue_script( 'halena-mbytplayer-script' );
                        $player_src = 'player-yt';
                    } 
                    elseif (strpos($page_header_bg_video_src_yt, 'vimeo') > 0) {
                        wp_enqueue_script( 'halena-mbvimeoplayer-script' );
                        $player_src = 'player-vimeo';
                    } 

                    $agni_slide_bg_container_id = 'agni-slide-bg-container-'.rand(10000, 99999);
                    $page_header_bg = '<a id="bgndVideo-'.$post.'" class="player '.$player_src.$player_yt_mobile.'" style="background-image:url('.$page_header_bg_video_src_yt_fallback.');" data-property="{videoURL:\''.$page_header_bg_video_src_yt.'\',containment:\'.'.$agni_slide_bg_container_id.'\', showControls:false, useOnMobile: '.$page_header_bg_video_src_yt_mobile.', autoPlay:'.$page_header_bg_video_autoplay.', loop:'.$page_header_bg_video_loop.', vol:'.$page_header_bg_video_volume.', mute:'.$page_header_bg_video_muted.', startAt:'.$page_header_bg_video_start_at.', stopAt:'.$page_header_bg_video_stop_at.', opacity:1, addRaster:false, quality:\''.$page_header_bg_video_quality.'\',}"></a>
                        <div class="section-video-controls">
                            <a class="command command-play" href="#"></a>
                            <a class="command command-pause" href="#"></a>
                        </div>';
                }
                else if( $page_header_bg_video_src == '2' ){
                    $page_header_bg = '<div id="agni-selfhosted-video-'.$post.'" class="agni-slide-bg agni-slide-bg-video self-hosted embed-responsive">
                            <video '. $bg_video_autoplay . $bg_video_loop . $bg_video_muted . ' class="custom-self-hosted-video" poster="'.$page_header_bg_video_src_sh_poster.'">
                                <source src="'.$page_header_bg_video_src_sh.'" type="video/mp4">
                            </video>
                        </div>';
                }
            }
            else if( $page_header_bg_choice == 'bg_featured' ){
                $page_header_bg = '<div class="agni-slide-bg agni-slide-bg-image agni-slide-featured-image" style="background-image:url('.esc_url( get_the_post_thumbnail_url() ).'); background-repeat:'.$page_header_bg_image_repeat.'; background-position:'.$page_header_bg_image_position.'; background-size:'.$page_header_bg_image_size.'; "></div>';
            }
            
            // BG Overlay
            if ( $page_header_bg_choice != 'bg_color' && $page_header_overlay_choice != '4' ){
                if( $page_header_overlay_choice == '3' ){
                    wp_enqueue_script( 'halena-gradientmap-script' );
                    $page_header_overlay = '<div class="agni-slide-bg-overlay agni-gradient-map-overlay gradient-map-overlay overlay" data-gm="'.$page_header_bg_gm_overlay_color1.','.$page_header_bg_gm_overlay_color2.','.$page_header_bg_gm_overlay_color3.' " style="background-image:url('.$page_header_bg_image.'); background-repeat:'.$page_header_bg_image_repeat.'; background-position:'.$page_header_bg_image_position.'; background-size:'.$page_header_bg_image_size.'; "></div>';
                }
                elseif ( $page_header_overlay_choice == '2' ) {
                    $page_header_overlay = '<div class="agni-slide-bg-overlay overlay" style="'.$page_header_bg_sg_overlay_css.';"></div>';
                }
                else{
                    $page_header_overlay = '<div class="agni-slide-bg-overlay overlay" style="background-color:'.$page_header_overlay_color.';"></div>';
                }
            }

            // BG particles
            if( $page_header_bg_particle_ground == 'on' ){
                wp_enqueue_script( 'halena-particleground-script' );
                $page_header_particle_ground = '<div class="particles" data-color="'.$page_header_bg_particle_ground_color.'"></div>';
            } 

            $output = '<div id="agni-page-header-'.$post.'" class="agni-slider agni-page-header '.$slider_class.'"'.$slider_css .' '.$slider_height.' data-slider-choice="'.$page_header_choice.'" data-slider-autoplay="false" data-slider-autoplay-speed="5000" data-slider-arrows="false" data-slider-fade="false" data-slider-dots="false" data-slider-infinite="false" data-slider-draggable="false" data-slider-slide-to-show="1" data-slider-slide-to-show-1200="1" data-slider-slide-to-show-992="1" data-slider-slide-to-show-768="1" data-rtl="'.$rtl.'">
                <div class="agni-slide '.$page_header_has_animation.'" '.$slide_parallax.'>
                    <div class="agni-slide-bg-container '.$agni_slide_bg_container_id.'">'.$page_header_bg.$page_header_overlay.$page_header_particle_ground.'</div>
                    <div class="agni-slide-content-container container '.$page_header_content_position.' text-'.$page_header_text_alignment.'">
                        <div class="agni-slide-content-inner '.$slide_content_class.' page-scroll" style="'.$slide_content_css.'" '.$slide_content_attr.'>
                            '.$page_header_image.$page_header_title.$page_header_title_line.$page_header_desc.$page_header_breadcrumb.$page_header_buttons.$page_header_arrow.'
                        </div>
                    </div>
                </div>
            </div>';

        }
        
        return $output;

    }
}

if( !function_exists('agni_slider') ){
    function agni_slider( $post, $shortcode = null ){
        global $halena_options;
        
        $rtl = ( is_rtl() )?'true':'false';
        $agni_slider_choice = get_post_meta( $post, 'agni_slides_choice', true );
        switch( $agni_slider_choice ){
        
            case 'slideshow' :
                
                wp_enqueue_style( 'halena-slick-style' );
                wp_enqueue_script( 'halena-slick-script' );

                $slides = $slideshow_animation = $slider_height = $slide_parallax = $slideshow_fullwidth_container = $slider_css = $slider_class = $slider_nav = '';
                        
                $slideshow_repeatable = get_post_meta( $post, 'agni_slides_slideshow_repeatable', true );
                
                $slideshow_choice = esc_attr( get_post_meta( $post, 'agni_slides_slideshow_choice', true ) );
                $slideshow_height = esc_attr( get_post_meta( $post, 'agni_slides_slideshow_height', true ) );
                $slideshow_height_tab = esc_attr( get_post_meta( $post, 'agni_slides_slideshow_height_tab', true ) );
                $slideshow_height_mobile = esc_attr( get_post_meta( $post, 'agni_slides_slideshow_height_mobile', true ) );

                $slideshow_margin_top = esc_attr( get_post_meta( $post, 'agni_slides_slideshow_margin_top', true ) );
                $slideshow_margin_right = esc_attr( get_post_meta( $post, 'agni_slides_slideshow_margin_right', true ) );
                $slideshow_margin_bottom = esc_attr( get_post_meta( $post, 'agni_slides_slideshow_margin_bottom', true ) );
                $slideshow_margin_left = esc_attr( get_post_meta( $post, 'agni_slides_slideshow_margin_left', true ) );
                $slideshow_margin_top_tab = esc_attr( get_post_meta( $post, 'agni_slides_slideshow_margin_top_tab', true ) );
                $slideshow_margin_right_tab = esc_attr( get_post_meta( $post, 'agni_slides_slideshow_margin_right_tab', true ) );
                $slideshow_margin_bottom_tab = esc_attr( get_post_meta( $post, 'agni_slides_slideshow_margin_bottom_tab', true ) );
                $slideshow_margin_left_tab = esc_attr( get_post_meta( $post, 'agni_slides_slideshow_margin_left_tab', true ) );
                $slideshow_margin_top_mobile = esc_attr( get_post_meta( $post, 'agni_slides_slideshow_margin_top_mobile', true ) );
                $slideshow_margin_right_mobile = esc_attr( get_post_meta( $post, 'agni_slides_slideshow_margin_right_mobile', true ) );
                $slideshow_margin_bottom_mobile = esc_attr( get_post_meta( $post, 'agni_slides_slideshow_margin_bottom_mobile', true ) );
                $slideshow_margin_left_mobile = esc_attr( get_post_meta( $post, 'agni_slides_slideshow_margin_left_mobile', true ) );

                $slideshow_parallax = esc_attr( get_post_meta( $post, 'agni_slides_slideshow_parallax', true ) );
                $slideshow_parallax_start = esc_attr( get_post_meta( $post, 'agni_slides_slideshow_parallax_start', true ) );
                $slideshow_parallax_end = esc_attr( get_post_meta( $post, 'agni_slides_slideshow_parallax_end', true ) );

                $slideshow_carousel = esc_attr( get_post_meta( $post, 'agni_slides_slideshow_carousel', true ) );
                $slideshow_carousel_992 = esc_attr( get_post_meta( $post, 'agni_slides_slideshow_carousel_992', true ) );
                $slideshow_carousel_768 = esc_attr( get_post_meta( $post, 'agni_slides_slideshow_carousel_768', true ) );
                $slideshow_carousel_0 = esc_attr( get_post_meta( $post, 'agni_slides_slideshow_carousel_0', true ) );
                $slideshow_carousel_center_mode = (esc_attr( get_post_meta( $post, 'agni_slides_slideshow_carousel_center_mode', true ) ) == 'on')?'true':'false';
                //$slideshow_carousel_margin = esc_attr( get_post_meta( $post, 'agni_slides_slideshow_carousel_margin', true ) );
                //$slideshow_animate_in = esc_attr( get_post_meta( $post, 'agni_slides_slideshow_animate_in', true ) );
                //$slideshow_animate_out = esc_attr( get_post_meta( $post, 'agni_slides_slideshow_animate_out', true ) );

                $slideshow_animation = esc_attr( get_post_meta( $post, 'agni_slides_slideshow_slide_animation', true ) );

                $slideshow_autoplay = (esc_attr( get_post_meta( $post, 'agni_slides_slideshow_autoplay', true ) ) == 'on')?'true':'false';
                $slideshow_loop = (esc_attr( get_post_meta( $post, 'agni_slides_slideshow_loop', true ) ) == 'on')?'true':'false';
                $slideshow_transition_duration = esc_attr( get_post_meta( $post, 'agni_slides_slideshow_transition_duration', true ) );
                $slideshow_transition_speed = esc_attr( get_post_meta( $post, 'agni_slides_slideshow_transition_speed', true ) );
                $slideshow_navigation = (esc_attr( get_post_meta( $post, 'agni_slides_slideshow_navigation', true ) ) == 'on')?'true':'false';
                $slideshow_navigation_prev = esc_attr( get_post_meta( $post, 'agni_slides_slideshow_navigation_prev', true ) );
                $slideshow_navigation_next = esc_attr( get_post_meta( $post, 'agni_slides_slideshow_navigation_next', true ) );

                $slideshow_pagination = (esc_attr( get_post_meta( $post, 'agni_slides_slideshow_pagination', true ) ) == 'on')?'true':'false';
                $slideshow_mousedrag = (esc_attr( get_post_meta( $post, 'agni_slides_slideshow_mousedrag', true ) ) == 'on')?'true':'false';


                if( $slideshow_choice == '1' ){
                    $slider_height = 'data-fullscreen-height = 1';
                }
                else{
                    $slider_height = 'data-height="'.$slideshow_height.'" data-height-tab="'.$slideshow_height_tab.'" data-height-mobile="'.$slideshow_height_mobile.'"';
                }
                
                if( $slideshow_parallax == 'on' && $shortcode == false ){
                    $slide_parallax = 'data-0="'.$slideshow_parallax_start.'" data-1500="'.$slideshow_parallax_end.'"';
                }

                if( $slideshow_carousel == 'on' ){
                    $slideshow_carousel = 'data-slider-center-mode="'.$slideshow_carousel_center_mode.'" data-slider-slide-to-show="'.$slideshow_carousel_992.'" data-slider-slide-to-show-1200="'.$slideshow_carousel_992.'" data-slider-slide-to-show-992="'.$slideshow_carousel_768.'" data-slider-slide-to-show-768="'.$slideshow_carousel_0.'"';

                    $slideshow_fullwidth_container = 'container-fluid';
                }
                else{
                    $slideshow_carousel = 'data-slider-center-mode="false" data-slider-slide-to-show="1" data-slider-slide-to-show-1200="1" data-slider-slide-to-show-992="1" data-slider-slide-to-show-768="1"';
                }

                if( $slideshow_animation == 'fade' ){
                    $slideshow_fade = 'true';
                }
                else{
                    $slideshow_fade = 'false';
                }

                if( $slideshow_pagination == 'true' || $slideshow_navigation == 'true' ){
                    $slider_nav = '<div class="slick-nav"></div>';
                }
                $slideshow_arrows_prev = '<button type="button" class="slick-prev">'.$slideshow_navigation_prev.'</button>';
                $slideshow_arrows_next = '<button type="button" class="slick-next">'.$slideshow_navigation_next.'</button>';

                $margin_side = array('top', 'right', 'bottom', 'left');
                $margin_device = array('', '_tab', '_mobile');
                $slide_args = array();
                foreach ( $margin_device as $device ) {
                    foreach( $margin_side as $value ){
                        $slide_args['margin_'.$value.$device] = (!empty(${'slideshow_margin_'.$value.$device}))?${'slideshow_margin_'.$value.$device}:'';
                    }
                }

                $slider_css_array = array_filter( agni_space_atts_processor( $slide_args ) );
                if( !empty($slider_css_array[0]) ){
                    $slider_css .= ' style="'.$slider_css_array[0].'" data-css-default="'.$slider_css_array[0].'"';
                }
                if( !empty($slider_css_array[1]) ){
                    $slider_css .= ' data-css-tab="'.$slider_css_array[1].'"';
                }
                if( !empty($slider_css_array[2]) ){
                    $slider_css .= ' data-css-mobile="'.$slider_css_array[2].'"';
                }

                if( !empty($slider_css) ){
                    $slider_class = 'agni_custom_design_css';
                }

                
                foreach( (array) $slideshow_repeatable as $key => $slide ){
                    $slideshow_bg_choice = $slideshow_bg_color = $slideshow_bg_image = $slideshow_bg_image_position = $slideshow_bg_image_repeat = $slideshow_bg_image_size = $slideshow_overlay =  $slideshow_overlay_choice = $slideshow_overlay_color = $slideshow_bg_sg_overlay_css = $slideshow_bg_gm_overlay_color1 = $slideshow_bg_gm_overlay_color2 = $slideshow_bg_gm_overlay_color3 = $slideshow_particle_ground = $slideshow_bg_particle_ground = $slideshow_bg_particle_ground_color = $slideshow_bg = $slideshow_size = $slideshow_image_width = $slideshow_image = $slideshow_title = $slideshow_title_effect = $slideshow_title_size = $slideshow_title_color = $slideshow_desc = $slideshow_desc_size = $slideshow_desc_color = $slideshow_title_line = $slideshow_title_line_color = $slideshow_button1 = $slideshow_button1_icon = $slideshow_button1_url = $slideshow_button1_style = $slideshow_button1_type = $slideshow_button1_radius = $slideshow_button1_target = $slideshow_button1_lightbox = $slideshow_button2 = $slideshow_button2_icon = $slideshow_button2_url = $slideshow_button2_style = $slideshow_button2_type = $slideshow_button2_radius = $slideshow_button2_target = $slideshow_button2_lightbox = $slideshow_buttons = $slideshow_arrow = $slideshow_arrowicon = $slideshow_arrowlink = $slideshow_arrowicon_color = $slideshow_has_animation = $slideshow_animation_delay = $slideshow_content_position = $slideshow_text_alignment = $slide_content_css = $slide_content_class = $slide_content_attr = $slideshow_padding_top = $slideshow_padding_bottom = $slideshow_padding_right = $slideshow_padding_left = '';

                    if( isset( $slide['slideshow_bg_choice'] ) )
                        $slideshow_bg_choice = esc_attr( $slide['slideshow_bg_choice'] );

                    if( isset( $slide['slideshow_bg_color'] ) )
                        $slideshow_bg_color = esc_attr( $slide['slideshow_bg_color'] );

                    if( isset( $slide['slideshow_bg_image'] ) )
                        $slideshow_bg_image = esc_attr( $slide['slideshow_bg_image'] );

                    if( isset( $slide['slideshow_bg_image_position'] ) )
                        $slideshow_bg_image_position = esc_attr( $slide['slideshow_bg_image_position'] );

                    if( isset( $slide['slideshow_bg_image_repeat'] ) )
                        $slideshow_bg_image_repeat = esc_attr( $slide['slideshow_bg_image_repeat'] );

                    if( isset( $slide['slideshow_bg_image_size'] ) )
                        $slideshow_bg_image_size = esc_attr( $slide['slideshow_bg_image_size'] );
                                        
                    if ( isset( $slide['slideshow_bg_overlay_choice'] ) )
                        $slideshow_overlay_choice = esc_attr( $slide['slideshow_bg_overlay_choice'] );
                        
                    if ( isset( $slide['slideshow_bg_overlay_color'] ) )
                        $slideshow_overlay_color = esc_attr( $slide['slideshow_bg_overlay_color'] );        

                    if ( isset( $slide['slideshow_bg_sg_overlay_css'] ) )
                        $slideshow_bg_sg_overlay_css = esc_attr( $slide['slideshow_bg_sg_overlay_css'] );

                    if ( isset( $slide['slideshow_bg_gm_overlay_color1'] ) )
                        $slideshow_bg_gm_overlay_color1 = esc_attr( $slide['slideshow_bg_gm_overlay_color1'] ); 

                    if ( isset( $slide['slideshow_bg_gm_overlay_color2'] ) )
                        $slideshow_bg_gm_overlay_color2 = esc_attr( $slide['slideshow_bg_gm_overlay_color2'] ); 

                    if ( isset( $slide['slideshow_bg_gm_overlay_color3'] ) )
                        $slideshow_bg_gm_overlay_color3 = esc_attr( $slide['slideshow_bg_gm_overlay_color3'] ); 

                    if ( isset( $slide['slideshow_bg_particle_ground'] ) )
                        $slideshow_bg_particle_ground = esc_attr( $slide['slideshow_bg_particle_ground'] ); 

                    if ( isset( $slide['slideshow_bg_particle_ground_color'] ) )
                        $slideshow_bg_particle_ground_color = esc_attr( $slide['slideshow_bg_particle_ground_color'] ); 

                    
                    $slideshow_animation_delay_amount = 0;
                    if ( isset( $slide['slideshow_animation'] ) ){
                        $slideshow_animation = esc_attr( $slide['slideshow_animation'] );
                        if( !empty($slideshow_animation) ){
                            $slideshow_has_animation = 'has-slide-content-animation';
                        }
                    }

                    if ( isset( $slide['slideshow_image_id'] ) && !empty( $slide['slideshow_image_id'] ) ){
                        if( $slideshow_has_animation == 'has-slide-content-animation'){
                            $slideshow_animation_delay = ' -webkit-animation-delay: '.$slideshow_animation_delay_amount.'ms; animation-delay: '.$slideshow_animation_delay_amount.'ms;';
                            $slideshow_animation_delay_amount += 250;
                        }
                        if ( isset( $slide['slideshow_image_size'] ) )
                            $slideshow_image_size = esc_attr( $slide['slideshow_image_size'] );

                        if ( isset( $slide['slideshow_image_size_tab'] ) )
                            $slideshow_image_size_tab = esc_attr( $slide['slideshow_image_size_tab'] );

                        if ( isset( $slide['slideshow_image_size_mobile'] ) )
                            $slideshow_image_size_mobile = esc_attr( $slide['slideshow_image_size_mobile'] );

                        $slideshow_image_width = 'data-width="'.$slideshow_image_size.'" data-width-tab="'.$slideshow_image_size_tab.'" data-width-mobile="'.$slideshow_image_size_mobile.'"';
                        
                        $slideshow_image = '<div class="agni-slide-image '.$slideshow_animation.'" style="'.$slideshow_animation_delay.'" '.$slideshow_image_width.'>'.wp_get_attachment_image($slide['slideshow_image_id'], 'full' ).'</div>';
                    }

                    if ( isset( $slide['slideshow_title'] ) ){
                        $slideshow_title_span = $slideshow_title_no_span[0] = $slideshow_title_no_span[1] = '';

                        if ( isset( $slide['slideshow_title_font'] ) )
                            $slideshow_title_font = esc_attr( $slide['slideshow_title_font'] ); 

                        if ( isset( $slide['slideshow_title_size'] ) )
                            $slideshow_title_size = esc_attr( $slide['slideshow_title_size'] ); 

                        if ( isset( $slide['slideshow_title_color'] ) )
                            $slideshow_title_color = esc_attr( $slide['slideshow_title_color'] );   

                        if ( isset( $slide['slideshow_title_rotator'] ) )
                            $slideshow_title_rotator = esc_attr( $slide['slideshow_title_rotator'] );

                        if ( isset( $slide['slideshow_title_rotator_choice'] ) )
                            $slideshow_title_rotator_choice = esc_attr( $slide['slideshow_title_rotator_choice'] );

                        if ( isset( $slide['slideshow_title_margin_bottom'] ) )
                            $slideshow_title_margin_bottom = esc_attr( $slide['slideshow_title_margin_bottom'] );


                        if( $slideshow_has_animation == 'has-slide-content-animation'){
                            $slideshow_animation_delay = ' -webkit-animation-delay: '.$slideshow_animation_delay_amount.'ms; animation-delay: '.$slideshow_animation_delay_amount.'ms;';
                            $slideshow_animation_delay_amount += 250;
                        }

                        if ( strpos($slide['slideshow_title'], '|') !== false && $slideshow_title_rotator == 'on') {
                            $slideshow_title_span = $slideshow_title_no_span[0] = $slideshow_title_no_span[1] = '';

                            wp_enqueue_style( 'halena-cd-animated-headlines-style' );
                            wp_enqueue_script( 'halena-cd-animated-headlines-script' );

                            $slideshow_title_effect = 'class="cd-headline '.$slideshow_title_rotator_choice.'"';

                            $slideshow_title_decode = wp_specialchars_decode( $slide['slideshow_title'] );
                            $pattern = '/<span>(.*?)<\/span>/';
                            $slideshow_title_no_span  = preg_split( $pattern, $slideshow_title_decode );

                            $slideshow_title_span_content = substr($slideshow_title_decode, strpos($slideshow_title_decode, "<span>") + 0);
                            $slideshow_title_span_content = substr($slideshow_title_span_content, 0, strpos($slideshow_title_span_content, "</span>") + 7);
                            $slideshow_title_span_content = explode( "|", $slideshow_title_span_content );
                            foreach( $slideshow_title_span_content as $slideshow_title_span_text ){
                                $slideshow_title_span .=  '<span class="rotate">'.$slideshow_title_span_text.'</span>';
                            }
                            $slideshow_title_span = str_replace('<span class="rotate"><span>', '<span class="cd-words-wrapper"><span class="rotate is-visible">', $slideshow_title_span);
                            
                            $slide['slideshow_title'] = $slideshow_title_no_span[0].$slideshow_title_span.$slideshow_title_no_span[1];
                        }

                        $slideshow_title = '<div class="agni-slide-title '.$slideshow_animation.' '.$slideshow_title_font.'" style="font-size:'.$slideshow_title_size.'px; color:'.$slideshow_title_color.'; margin-bottom:'.( preg_match( '/(px|em|\%|pt|cm)$/', $slideshow_title_margin_bottom ) ? $slideshow_title_margin_bottom : $slideshow_title_margin_bottom . 'px' ).'; '.$slideshow_animation_delay.'"><h2 '.$slideshow_title_effect.'>'.wp_specialchars_decode( esc_attr( $slide['slideshow_title'] ) ).'</h2></div>';
                    }

                    if ( isset( $slide['slideshow_line'] ) && $slide['slideshow_line'] == 'on' ){

                        if ( isset( $slide['slideshow_line_color'] ) )
                            $slideshow_title_line_color = esc_attr( $slide['slideshow_line_color'] );

                        if( $slideshow_has_animation == 'has-slide-content-animation'){
                            $slideshow_animation_delay = 'style=" -webkit-animation-delay: '.$slideshow_animation_delay_amount.'ms; animation-delay: '.$slideshow_animation_delay_amount.'ms; "';
                            $slideshow_animation_delay_amount += 250;
                        }
                        $slideshow_title_line = '<div class="agni-slide-divideline divide-line '.$slideshow_animation.'" '.$slideshow_animation_delay.'><span style="background-color:'.$slideshow_title_line_color.';"></span></div>'; 
                    }
                        
                    if ( !empty( $slide['slideshow_desc'] ) ){

                        if ( isset( $slide['slideshow_desc_font'] ) )
                            $slideshow_desc_font = esc_attr( $slide['slideshow_desc_font'] ); 

                        if ( isset( $slide['slideshow_desc_size'] ) )
                            $slideshow_desc_size = esc_attr( $slide['slideshow_desc_size'] );   

                        if ( isset( $slide['slideshow_desc_color'] ) )
                            $slideshow_desc_color = esc_attr( $slide['slideshow_desc_color'] );

                        if ( isset( $slide['slideshow_desc_margin_bottom'] ) )
                            $slideshow_desc_margin_bottom = esc_attr( $slide['slideshow_desc_margin_bottom'] );

                        if( $slideshow_has_animation == 'has-slide-content-animation'){
                            $slideshow_animation_delay = ' -webkit-animation-delay: '.$slideshow_animation_delay_amount.'ms; animation-delay: '.$slideshow_animation_delay_amount.'ms;';
                            $slideshow_animation_delay_amount += 250;
                        }
                        $slideshow_desc = '<div class="agni-slide-description '.$slideshow_animation.' '.$slideshow_desc_font.'" style="font-size:'.$slideshow_desc_size.'px; color:'.$slideshow_desc_color.'; margin-bottom:'.( preg_match( '/(px|em|\%|pt|cm)$/', $slideshow_desc_margin_bottom ) ? $slideshow_desc_margin_bottom : $slideshow_desc_margin_bottom . 'px' ).'; '.$slideshow_animation_delay.'"><p>'.wp_specialchars_decode( esc_attr( $slide['slideshow_desc'] ) ).'</p></div>';
                    }
                        
                    if ( isset( $slide['slideshow_button1'] ) )
                        $slideshow_button1 = esc_attr( $slide['slideshow_button1'] );

                    if ( isset( $slide['slideshow_button1_icon'] ) )
                        $slideshow_button1_icon = esc_attr( $slide['slideshow_button1_icon'] );

                    if ( isset( $slide['slideshow_button1_icon_style'] ) )
                        $slideshow_button1_icon_style = esc_attr( $slide['slideshow_button1_icon_style'] );

                    if ( isset( $slide['slideshow_button1_text_hide'] ) )
                        $slideshow_button1_text_hide = esc_attr( $slide['slideshow_button1_text_hide'] );
                        
                    if ( isset( $slide['slideshow_button1_url'] ) )
                        $slideshow_button1_url = esc_url( $slide['slideshow_button1_url'] );
                        
                    if ( isset( $slide['slideshow_button1_style'] ) )
                        $slideshow_button1_style = esc_attr( $slide['slideshow_button1_style'] );
                        
                    if ( isset( $slide['slideshow_button1_type'] ) )
                        $slideshow_button1_type = esc_attr( $slide['slideshow_button1_type'] );
                        
                    if ( isset( $slide['slideshow_button1_radius'] ) )
                        $slideshow_button1_radius = esc_attr( $slide['slideshow_button1_radius'] );

                    if ( isset( $slide['slideshow_button1_target'] ) )
                        $slideshow_button1_target = esc_attr( $slide['slideshow_button1_target'] );

                    if ( isset( $slide['slideshow_button1_lightbox'] ) )
                        $slideshow_button1_lightbox = esc_attr( $slide['slideshow_button1_lightbox'] );

                    if ( isset( $slide['slideshow_button1_embed_url'] ) )
                        $slideshow_button1_embed_url = esc_html( $slide['slideshow_button1_embed_url'] );

                    if ( isset( $slide['slideshow_button2'] ) )
                        $slideshow_button2 = esc_attr( $slide['slideshow_button2'] );

                    if ( isset( $slide['slideshow_button2_icon'] ) )
                        $slideshow_button2_icon = esc_attr( $slide['slideshow_button2_icon'] );

                    if ( isset( $slide['slideshow_button2_icon_style'] ) )
                        $slideshow_button2_icon_style = esc_attr( $slide['slideshow_button2_icon_style'] );

                    if ( isset( $slide['slideshow_button2_text_hide'] ) )
                        $slideshow_button2_text_hide = esc_attr( $slide['slideshow_button2_text_hide'] );
                        
                    if ( isset( $slide['slideshow_button2_url'] ) )
                        $slideshow_button2_url = esc_url( $slide['slideshow_button2_url'] );
                        
                    if ( isset( $slide['slideshow_button2_style'] ) )
                        $slideshow_button2_style = esc_attr( $slide['slideshow_button2_style'] );
                        
                    if ( isset( $slide['slideshow_button2_type'] ) )
                        $slideshow_button2_type = esc_attr( $slide['slideshow_button2_type'] );
                        
                    if ( isset( $slide['slideshow_button2_radius'] ) )
                        $slideshow_button2_radius = esc_attr( $slide['slideshow_button2_radius'] );

                    if ( isset( $slide['slideshow_button2_target'] ) )
                        $slideshow_button2_target = esc_attr( $slide['slideshow_button2_target'] );

                    if ( isset( $slide['slideshow_button2_lightbox'] ) )
                        $slideshow_button2_lightbox = esc_attr( $slide['slideshow_button2_lightbox'] );

                    if ( isset( $slide['slideshow_button2_embed_url'] ) )
                        $slideshow_button2_embed_url = esc_html( $slide['slideshow_button2_embed_url'] );

                    if ( isset( $slide['slideshow_arrowicon'] ) ){

                        if ( isset( $slide['slideshow_arrowlink'] ) )
                            $slideshow_arrowlink = esc_url( $slide['slideshow_arrowlink'] );

                        if ( isset( $slide['slideshow_arrowicon_color'] ) )
                            $slideshow_arrowicon_color = esc_attr( $slide['slideshow_arrowicon_color'] );

                        if( !empty( $slideshow_arrowlink ) ){
                            $slideshow_arrow = '<div class="agni-slide-arrow page-scroll"><a href="'.$slideshow_arrowlink.'" style="color:'.$slideshow_arrowicon_color.'"><i class="'.$slide['slideshow_arrowicon'].'"></i></a></div>';
                        }
                    }

                    if( !empty($slideshow_button1) ){

                        $args = array( 
                            'btn' => $slideshow_button1, 
                            'btn_icon' => $slideshow_button1_icon, 
                            'btn_icon_style' => $slideshow_button1_icon_style, 
                            'btn_text_hide' => $slideshow_button1_text_hide, 
                            'btn_url' => $slideshow_button1_url, 
                            'btn_style' => $slideshow_button1_style, 
                            'btn_type' => $slideshow_button1_type, 
                            'btn_radius' => $slideshow_button1_radius, 
                            'btn_target' => $slideshow_button1_target, 
                            'btn_lightbox' => $slideshow_button1_lightbox, 
                            'btn_embed_url' => $slideshow_button1_embed_url, 
                            'btn_animation' => $slideshow_animation, 
                            'btn_has_animation' => $slideshow_has_animation, 
                            'btn_animation_delay' => $slideshow_animation_delay, 
                            'btn_animation_delay_amount' => $slideshow_animation_delay_amount 
                            );
                        $slideshow_buttons .= agni_slider_button_generator( $args );
                        $slideshow_animation_delay_amount += 250;

                    }
                    if( !empty($slideshow_button2) ){

                        $args = array( 
                            'btn' => $slideshow_button2, 
                            'btn_icon' => $slideshow_button2_icon, 
                            'btn_icon_style' => $slideshow_button2_icon_style, 
                            'btn_text_hide' => $slideshow_button2_text_hide, 
                            'btn_url' => $slideshow_button2_url, 
                            'btn_style' => $slideshow_button2_style, 
                            'btn_type' => $slideshow_button2_type, 
                            'btn_radius' => $slideshow_button2_radius, 
                            'btn_target' => $slideshow_button2_target, 
                            'btn_lightbox' => $slideshow_button2_lightbox, 
                            'btn_embed_url' => $slideshow_button2_embed_url, 
                            'btn_animation' => $slideshow_animation, 
                            'btn_has_animation' => $slideshow_has_animation, 
                            'btn_animation_delay' => $slideshow_animation_delay, 
                            'btn_animation_delay_amount' => $slideshow_animation_delay_amount 
                            );
                        $slideshow_buttons .= agni_slider_button_generator( $args );
                        $slideshow_animation_delay_amount += 250;

                    }
                    if( !empty($slideshow_buttons) ){
                        $slideshow_buttons = '<div class="agni-slide-buttons">'.$slideshow_buttons.'</div>';
                    } 

                    if ( isset( $slide['slideshow_content_position'] ) )
                        $slideshow_content_position = esc_attr( $slide['slideshow_content_position'] );
                                        
                    if ( isset( $slide['slideshow_text_alignment'] ) )
                        $slideshow_text_alignment = esc_attr( $slide['slideshow_text_alignment'] );
                    
                    //$slideshow_content_choice $slideshow_content_width
                    if ( !empty( $slide['slideshow_content_width'] ) ){
                        $slideshow_content_width = esc_attr( $slide['slideshow_content_width'] );
                    }
                    if ( !empty( $slide['slideshow_content_width_tab'] ) ){
                        $slideshow_content_width_tab = esc_attr( $slide['slideshow_content_width_tab'] );
                    }
                    if ( !empty( $slide['slideshow_content_width_mobile'] ) ){
                        $slideshow_content_width_mobile = esc_attr( $slide['slideshow_content_width_mobile'] );
                    }

                    if ( isset( $slide['slideshow_content_choice'] ) ){
                        $slideshow_fullwidth_container = esc_attr( $slide['slideshow_content_choice'] );
                    }

                    if ( isset( $slide['slideshow_padding_top'] ) ){
                        $slideshow_padding_top = esc_attr( $slide['slideshow_padding_top'] );
                    }
                                        
                    if ( isset( $slide['slideshow_padding_right'] ) ){
                        $slideshow_padding_right = esc_attr( $slide['slideshow_padding_right'] );
                    }
                                        
                    if ( isset( $slide['slideshow_padding_bottom'] ) ){
                        $slideshow_padding_bottom = esc_attr( $slide['slideshow_padding_bottom'] );
                    }

                    if ( isset( $slide['slideshow_padding_left'] ) ){
                        $slideshow_padding_left = esc_attr( $slide['slideshow_padding_left'] );
                    }
                    if ( isset( $slide['slideshow_padding_top_tab'] ) ){
                        $slideshow_padding_top_tab = esc_attr( $slide['slideshow_padding_top_tab'] );
                    }
                                        
                    if ( isset( $slide['slideshow_padding_right_tab'] ) ){
                        $slideshow_padding_right_tab = esc_attr( $slide['slideshow_padding_right_tab'] );
                    }
                                        
                    if ( isset( $slide['slideshow_padding_bottom_tab'] ) ){
                        $slideshow_padding_bottom_tab = esc_attr( $slide['slideshow_padding_bottom_tab'] );
                    }

                    if ( isset( $slide['slideshow_padding_left_tab'] ) ){
                        $slideshow_padding_left_tab = esc_attr( $slide['slideshow_padding_left_tab'] );
                    }
                    if ( isset( $slide['slideshow_padding_top_mobile'] ) ){
                        $slideshow_padding_top_mobile = esc_attr( $slide['slideshow_padding_top_mobile'] );
                    }
                                        
                    if ( isset( $slide['slideshow_padding_right_mobile'] ) ){
                        $slideshow_padding_right_mobile = esc_attr( $slide['slideshow_padding_right_mobile'] );
                    }
                                        
                    if ( isset( $slide['slideshow_padding_bottom_mobile'] ) ){
                        $slideshow_padding_bottom_mobile = esc_attr( $slide['slideshow_padding_bottom_mobile'] );
                    }

                    if ( isset( $slide['slideshow_padding_left_mobile'] ) ){
                        $slideshow_padding_left_mobile = esc_attr( $slide['slideshow_padding_left_mobile'] );
                    }

                    if ( !empty( $slideshow_content_width ) ){
                        $slide_content_css .= 'max-width:'.( preg_match( '/(px|em|\%|pt|cm)$/', $slideshow_content_width ) ? $slideshow_content_width : $slideshow_content_width . 'px' ).'; ';
                        $slide_content_class .= ' agni_custom_content_width';
                        $slide_content_attr .= ' data-content-width="'.$slideshow_content_width.'"';
                    }
                    if ( !empty( $slideshow_content_width_tab ) ){
                        $slide_content_attr .= ' data-content-width-tab="'.$slideshow_content_width_tab.'"';
                    }
                    if ( !empty( $slideshow_content_width_mobile ) ){
                        $slide_content_attr .= ' data-content-width-mobile="'.$slideshow_content_width_mobile.'"';
                    }
                    
                    $padding_side = array('top', 'right', 'bottom', 'left');
                    $padding_device = array('', '_tab', '_mobile');
                    $slide_args = array();
                    foreach ( $padding_device as $device ) {
                        foreach( $padding_side as $value ){
                            $slide_args['padding_'.$value.$device] = (!empty(${'slideshow_padding_'.$value.$device}))?${'slideshow_padding_'.$value.$device}:'';
                        }
                    }

                    $slide_css_array = array_filter( agni_space_atts_processor( $slide_args ) );
                    if( !empty($slide_css_array[0]) ){
                        $slide_content_css .= $slide_css_array[0];
                        $slide_content_attr .= ' data-css-default="'.$slide_css_array[0].'"';
                    }
                    if( !empty($slide_css_array[1]) ){
                        $slide_content_attr .= ' data-css-tab="'.$slide_css_array[1].'"';
                    }
                    if( !empty($slide_css_array[2]) ){
                        $slide_content_attr .= ' data-css-mobile="'.$slide_css_array[2].'"';
                    }

                    if( !empty($slide_css_array) ){
                        $slide_content_class .= ' agni_custom_design_css';
                    }
                        
                    if ( $slideshow_bg_choice == 'bg_color' ){
                        $slideshow_bg = '<div class="agni-slide-bg agni-slide-bg-color" style="background-color:'.$slideshow_bg_color.'; "></div>';
                    }
                    else {
                        $slideshow_bg = '<div class="agni-slide-bg agni-slide-bg-image" style="background-image:url('.$slideshow_bg_image.'); background-repeat:'.$slideshow_bg_image_repeat.'; background-position:'.$slideshow_bg_image_position.'; background-size:'.$slideshow_bg_image_size.'; "></div>';
                    }
                    
                    if ( $slideshow_bg_choice != 'bg_color' && $slideshow_overlay_choice != '4'  ){
                        if( $slideshow_overlay_choice == '3' ){
                            wp_enqueue_script( 'halena-gradientmap-script' );
                            $slideshow_overlay = '<div class="agni-slide-bg-overlay agni-gradient-map-overlay gradient-map-overlay overlay" data-gm="'.$slideshow_bg_gm_overlay_color1.','.$slideshow_bg_gm_overlay_color2.','.$slideshow_bg_gm_overlay_color3.' " style="background-image:url('.$slideshow_bg_image.'); background-repeat:'.$slideshow_bg_image_repeat.'; background-position:'.$slideshow_bg_image_position.'; background-size:'.$slideshow_bg_image_size.'; "></div>';
                        }
                        elseif ( $slideshow_overlay_choice == '2' ) {
                            $slideshow_overlay = '<div class="agni-slide-bg-overlay overlay" style="'.$slideshow_bg_sg_overlay_css.';"></div>';
                        }
                        else{
                            $slideshow_overlay = '<div class="agni-slide-bg-overlay overlay" style="background-color:'.$slideshow_overlay_color.';"></div>';
                        }
                    }

                    // BG particles
                    if( $slideshow_bg_particle_ground == 'on' ){
                        wp_enqueue_script( 'halena-particleground-script' );
                        $slideshow_bg_particle_ground_color = ( $slideshow_bg_particle_ground_color != '' ) ? $slideshow_bg_particle_ground_color : 'rgba(255,255,255,0.2)';
                        $slideshow_particle_ground = '<div class="particles" data-color="'.$slideshow_bg_particle_ground_color.'"></div>';
                    } 
                    
                    $slides .= '<div class="agni-slide '.$slideshow_has_animation.'" '.$slide_parallax.'>
                        <div class="agni-slide-bg-container">'.$slideshow_bg.$slideshow_overlay.$slideshow_particle_ground.'</div>
                        <div class="agni-slide-content-container '.$slideshow_fullwidth_container.' '.$slideshow_content_position.' text-'.$slideshow_text_alignment.'">
                            <div class="agni-slide-content-inner '.$slide_content_class.' page-scroll" style="'.$slide_content_css.'" '.$slide_content_attr.'>
                                '.$slideshow_image.$slideshow_title.$slideshow_title_line.$slideshow_desc.$slideshow_buttons.$slideshow_arrow.'
                            </div>
                        </div>
                    </div>';

                }
                
                $output = '<div id="agni-slider-'.$post.'" class="agni-slider '.$slider_class.'"'.$slider_css .' '.$slider_height.' data-slider-choice="'.$slideshow_choice.'" data-slider-autoplay="'.$slideshow_autoplay.'" data-slider-autoplay-speed="'.$slideshow_transition_duration.'" data-slider-arrows="'.$slideshow_navigation.'" data-slider-arrows-prev="'.htmlspecialchars($slideshow_arrows_prev).'" data-slider-arrows-next="'.htmlspecialchars($slideshow_arrows_next).'" data-slider-fade="'.$slideshow_fade.'" data-slider-dots="'.$slideshow_pagination.'" data-slider-infinite="'.$slideshow_loop.'" data-slider-draggable="'.$slideshow_mousedrag.'" data-slider-speed="'.$slideshow_transition_speed.'" '.$slideshow_carousel.' data-rtl="'.$rtl.'">'.$slides.$slider_nav.'</div>';
                
                return $output;
                
                break;
            
            case 'textslider':
                
                wp_enqueue_style( 'halena-slick-style' );
                wp_enqueue_script( 'halena-slick-script' );

                $slides = $textslider_animation = $slider_height = $slide_parallax = $textslider_bg_choice = $textslider_bg_color = $textslider_bg_image = $textslider_bg_image_position = $textslider_bg_image_repeat = $textslider_bg_image_size = $textslider_overlay = $textslider_overlay_choice = $textslider_overlay_color = $textslider_bg_sg_overlay_css = $textslider_bg_gm_overlay_color1 = $textslider_bg_gm_overlay_color2 = $textslider_bg_gm_overlay_color3 = $textslider_particle_ground = $textslider_bg = $agni_slide_bg_container_id = $player_yt_mobile = $textslider_bg_video_mobile  = $textslider_bg_video_loop = $textslider_bg_video_autoplay = $textslider_bg_video_muted = $bg_video_loop = $bg_video_autoplay = $bg_video_muted = $slider_class = $slider_css = $slider_nav = '';
                        
                $textslider_repeatable = get_post_meta( $post, 'agni_slides_textslider_repeatable', true );
                
                $textslider_bg_choice = esc_attr( get_post_meta( $post, 'agni_slides_textslider_bg_choice', true ) );
                $textslider_bg_color = esc_attr( get_post_meta( $post, 'agni_slides_textslider_bg_color', true ) );
                $textslider_bg_image = esc_url( get_post_meta( $post, 'agni_slides_textslider_bg_image', true ) );
                $textslider_bg_image_position = esc_attr( get_post_meta( $post, 'agni_slides_textslider_bg_image_position', true ) );
                $textslider_bg_image_repeat = esc_attr( get_post_meta( $post, 'agni_slides_textslider_bg_image_repeat', true ) );
                $textslider_bg_image_size = esc_attr( get_post_meta( $post, 'agni_slides_textslider_bg_image_size', true ) );
                $textslider_bg_video_src = esc_attr( get_post_meta( $post, 'agni_slides_textslider_bg_video_src', true ) );
                $textslider_bg_video_src_yt = esc_url( get_post_meta( $post, 'agni_slides_textslider_bg_video_src_yt', true ) );
                $textslider_bg_video_src_yt_fallback = esc_url( get_post_meta( $post, 'agni_slides_textslider_bg_video_src_yt_fallback', true ) );
                $textslider_bg_video_src_sh = esc_url( get_post_meta( $post, 'agni_slides_textslider_bg_video_src_sh', true ) );
                $textslider_bg_video_src_sh_poster = esc_url( get_post_meta( $post, 'agni_slides_textslider_bg_video_src_sh_poster', true ) );

                $textslider_bg_video_loop = esc_attr( get_post_meta( $post, 'agni_slides_textslider_bg_video_loop', true ) );
                $textslider_bg_video_yt_mobile = esc_attr( get_post_meta( $post, 'agni_slides_textslider_bg_video_src_yt_mobile', true ) );
                $textslider_bg_video_autoplay = esc_attr( get_post_meta( $post, 'agni_slides_textslider_bg_video_autoplay', true ) );
                $textslider_bg_video_muted = esc_attr( get_post_meta( $post, 'agni_slides_textslider_bg_video_muted', true ) );
                $textslider_bg_video_volume = esc_attr( get_post_meta( $post, 'agni_slides_textslider_bg_video_volume', true ) );
                $textslider_bg_video_quality = esc_attr( get_post_meta( $post, 'agni_slides_textslider_bg_video_quality', true ) );
                $textslider_bg_video_start_at = esc_attr( get_post_meta( $post, 'agni_slides_textslider_bg_video_start_at', true ) );
                $textslider_bg_video_stop_at = esc_attr( get_post_meta( $post, 'agni_slides_textslider_bg_video_stop_at', true ) );

                $textslider_overlay_choice = esc_attr( get_post_meta( $post, 'agni_slides_textslider_bg_overlay_choice', true ) );
                $textslider_overlay_color = esc_attr( get_post_meta( $post, 'agni_slides_textslider_bg_overlay_color', true ) );        
                $textslider_bg_sg_overlay_css = esc_attr( get_post_meta( $post, 'agni_slides_textslider_bg_sg_overlay_css', true ) );
                $textslider_bg_gm_overlay_color1 = esc_attr( get_post_meta( $post, 'agni_slides_textslider_bg_gm_overlay_color1', true ) ); 
                $textslider_bg_gm_overlay_color2 = esc_attr( get_post_meta( $post, 'agni_slides_textslider_bg_gm_overlay_color2', true ) ); 
                $textslider_bg_gm_overlay_color3 = esc_attr( get_post_meta( $post, 'agni_slides_textslider_bg_gm_overlay_color3', true ) );

                $textslider_bg_particle_ground = esc_attr( get_post_meta( $post, 'agni_slides_textslider_bg_particle_ground', true ) );
                $textslider_bg_particle_ground_color = esc_attr( get_post_meta( $post, 'agni_slides_textslider_bg_particle_ground_color', true ) ); 

                $textslider_choice = esc_attr( get_post_meta( $post, 'agni_slides_textslider_choice', true ) );
                $textslider_height = esc_attr( get_post_meta( $post, 'agni_slides_textslider_height', true ) );
                $textslider_height_tab = esc_attr( get_post_meta( $post, 'agni_slides_textslider_height_tab', true ) );
                $textslider_height_mobile = esc_attr( get_post_meta( $post, 'agni_slides_textslider_height_mobile', true ) );

                $textslider_margin_top = esc_attr( get_post_meta( $post, 'agni_slides_textslider_margin_top', true ) );
                $textslider_margin_right = esc_attr( get_post_meta( $post, 'agni_slides_textslider_margin_right', true ) );
                $textslider_margin_bottom = esc_attr( get_post_meta( $post, 'agni_slides_textslider_margin_bottom', true ) );
                $textslider_margin_left = esc_attr( get_post_meta( $post, 'agni_slides_textslider_margin_left', true ) );
                $textslider_margin_top_tab = esc_attr( get_post_meta( $post, 'agni_slides_textslider_margin_top_tab', true ) );
                $textslider_margin_right_tab = esc_attr( get_post_meta( $post, 'agni_slides_textslider_margin_right_tab', true ) );
                $textslider_margin_bottom_tab = esc_attr( get_post_meta( $post, 'agni_slides_textslider_margin_bottom_tab', true ) );
                $textslider_margin_left_tab = esc_attr( get_post_meta( $post, 'agni_slides_textslider_margin_left_tab', true ) );
                $textslider_margin_top_mobile = esc_attr( get_post_meta( $post, 'agni_slides_textslider_margin_top_mobile', true ) );
                $textslider_margin_right_mobile = esc_attr( get_post_meta( $post, 'agni_slides_textslider_margin_right_mobile', true ) );
                $textslider_margin_bottom_mobile = esc_attr( get_post_meta( $post, 'agni_slides_textslider_margin_bottom_mobile', true ) );
                $textslider_margin_left_mobile = esc_attr( get_post_meta( $post, 'agni_slides_textslider_margin_left_mobile', true ) );

                $textslider_parallax = esc_attr( get_post_meta( $post, 'agni_slides_textslider_parallax', true ) );
                $textslider_parallax_start = esc_attr( get_post_meta( $post, 'agni_slides_textslider_parallax_start', true ) );
                $textslider_parallax_end = esc_attr( get_post_meta( $post, 'agni_slides_textslider_parallax_end', true ) );
                //$textslider_animate_in = esc_attr( get_post_meta( $post, 'agni_slides_textslider_animate_in', true ) );
                //$textslider_animate_out = esc_attr( get_post_meta( $post, 'agni_slides_textslider_animate_out', true ) );

                $textslider_animation = esc_attr( get_post_meta( $post, 'agni_slides_textslider_slide_animation', true ) );

                $textslider_autoplay = (esc_attr( get_post_meta( $post, 'agni_slides_textslider_autoplay', true ) ) == 'on')?'true':'false';
                $textslider_loop = (esc_attr( get_post_meta( $post, 'agni_slides_textslider_loop', true ) ) == 'on')?'true':'false';
                $textslider_transition_duration = esc_attr( get_post_meta( $post, 'agni_slides_textslider_transition_duration', true ) );
                $textslider_transition_speed = esc_attr( get_post_meta( $post, 'agni_slides_textslider_transition_speed', true ) );
                $textslider_navigation = (esc_attr( get_post_meta( $post, 'agni_slides_textslider_navigation', true ) ) == 'on')?'true':'false';
                $textslider_navigation_prev = esc_attr( get_post_meta( $post, 'agni_slides_textslider_navigation_prev', true ) );
                $textslider_navigation_next = esc_attr( get_post_meta( $post, 'agni_slides_textslider_navigation_next', true ) );
                $textslider_pagination = (esc_attr( get_post_meta( $post, 'agni_slides_textslider_pagination', true ) ) == 'on')?'true':'false';
                $textslider_mousedrag = (esc_attr( get_post_meta( $post, 'agni_slides_textslider_mousedrag', true ) ) == 'on')?'true':'false';

                if( $textslider_choice == '1' ){
                    $slider_height = 'data-fullscreen-height = 1';
                }
                else{
                    $slider_height = 'data-height="'.$textslider_height.'" data-height-tab="'.$textslider_height_tab.'" data-height-mobile="'.$textslider_height_mobile.'"';
                }
                
                if( $textslider_parallax == 'on' && $shortcode == false ){
                    $slide_parallax = 'data-0="'.$textslider_parallax_start.'" data-1500="'.$textslider_parallax_end.'"';
                }

                $textslider_carousel = 'data-slider-center-mode="false" data-slider-slide-to-show="1" data-slider-slide-to-show-1200="1" data-slider-slide-to-show-992="1" data-slider-slide-to-show-768="1"';

                
                if( $textslider_animation == 'fade' ){
                    $textslider_fade = 'true';
                }
                else{
                    $textslider_fade = 'false';
                }

                if( $textslider_pagination == 'true' || $textslider_navigation == 'true' ){
                    $slider_nav = '<div class="slick-nav"></div>';
                }

                $textslider_arrows_prev = '<button type="button" class="slick-prev">'.$textslider_navigation_prev.'</button>';
                $textslider_arrows_next = '<button type="button" class="slick-next">'.$textslider_navigation_next.'</button>';


                $margin_side = array('top', 'right', 'bottom', 'left');
                $margin_device = array('', '_tab', '_mobile');
                $slide_args = array();
                foreach ( $margin_device as $device ) {
                    foreach( $margin_side as $value ){
                        $slide_args['margin_'.$value.$device] = (!empty(${'textslider_margin_'.$value.$device}))?${'textslider_margin_'.$value.$device}:'';
                    }
                }

                $slider_css_array = array_filter( agni_space_atts_processor( $slide_args ) );
                if( !empty($slider_css_array[0]) ){
                    $slider_css .= ' style="'.$slider_css_array[0].'" data-css-default="'.$slider_css_array[0].'"';
                }
                if( !empty($slider_css_array[1]) ){
                    $slider_css .= ' data-css-tab="'.$slider_css_array[1].'"';
                }
                if( !empty($slider_css_array[2]) ){
                    $slider_css .= ' data-css-mobile="'.$slider_css_array[2].'"';
                }

                if( !empty($slider_css) ){
                    $slider_class = 'agni_custom_design_css';
                }
                
                foreach( (array) $textslider_repeatable as $key => $slide ){
                    $textslider_content_position = $textslider_text_alignment = $slide_content_css = $slide_content_class = $slide_content_attr = $textslider_size = $textslider_image_width = $textslider_image = $textslider_title = $textslider_title_effect = $textslider_title_size = $textslider_title_color = $textslider_desc = $textslider_desc_size = $textslider_desc_color = $textslider_title_line = $textslider_title_line_color = $textslider_button1 = $textslider_button1_icon = $textslider_button1_url = $textslider_button1_style = $textslider_button1_type = $textslider_button1_radius = $textslider_button1_target = $textslider_button1_lightbox = $textslider_button2 = $textslider_button2_icon = $textslider_button2_url = $textslider_button2_style = $textslider_button2_type = $textslider_button2_radius = $textslider_button2_target = $textslider_button2_lightbox = $textslider_buttons = $textslider_animation = $textslider_has_animation = $textslider_animation_delay = $textslider_animation_delay_amount = $textslider_arrow = $textslider_arrowicon = $textslider_arrowlink = $textslider_arrowicon_color = $textslider_padding = $textslider_padding_top = $textslider_padding_bottom = $textslider_padding_right = $textslider_padding_left = '';


                    if ( isset( $slide['textslider_animation'] ) ){
                        $textslider_animation = esc_attr( $slide['textslider_animation'] );
                        if( !empty($textslider_animation) ){
                            $textslider_has_animation = 'has-slide-content-animation';
                            $textslider_animation_delay_amount = 0;
                        }
                    }

                    if ( isset( $slide['textslider_image_id'] ) ){
                        if( $textslider_has_animation == 'has-slide-content-animation'){
                            $textslider_animation_delay = ' -webkit-animation-delay: '.$textslider_animation_delay_amount.'ms; animation-delay: '.$textslider_animation_delay_amount.'ms;';
                            $textslider_animation_delay_amount += 250;
                        }
                        if ( isset( $slide['textslider_image_size'] ) )
                            $textslider_image_size = esc_attr( $slide['textslider_image_size'] );

                        if ( isset( $slide['textslider_image_size_tab'] ) )
                            $textslider_image_size_tab = esc_attr( $slide['textslider_image_size_tab'] );

                        if ( isset( $slide['textslider_image_size_mobile'] ) )
                            $textslider_image_size_mobile = esc_attr( $slide['textslider_image_size_mobile'] );

                        $textslider_image_width = 'data-width="'.$textslider_image_size.'" data-width-tab="'.$textslider_image_size_tab.'" data-width-mobile="'.$textslider_image_size_mobile.'"';
                        
                        $textslider_image = '<div class="agni-slide-image '.$textslider_animation.'" style="'.$textslider_animation_delay.'" '.$textslider_image_width.'>'.wp_get_attachment_image($slide['textslider_image_id'], 'full' ).'</div>';
                    }

                    if ( !empty( $slide['textslider_title'] ) ){
                        $textslider_title_span = $textslider_title_no_span[0] = $textslider_title_no_span[1] = '';

                        if ( isset( $slide['textslider_title_font'] ) )
                            $textslider_title_font = esc_attr( $slide['textslider_title_font'] );   

                        if ( isset( $slide['textslider_title_size'] ) )
                            $textslider_title_size = esc_attr( $slide['textslider_title_size'] );   

                        if ( isset( $slide['textslider_title_color'] ) )
                            $textslider_title_color = esc_attr( $slide['textslider_title_color'] ); 

                        if ( isset( $slide['textslider_title_rotator'] ) )
                            $textslider_title_rotator = esc_attr( $slide['textslider_title_rotator'] );

                        if ( isset( $slide['textslider_title_rotator_choice'] ) )
                            $textslider_title_rotator_choice = esc_attr( $slide['textslider_title_rotator_choice'] );

                        if ( isset( $slide['textslider_title_margin_bottom'] ) )
                            $textslider_title_margin_bottom = esc_attr( $slide['textslider_title_margin_bottom'] );

                        if( $textslider_has_animation == 'has-slide-content-animation'){
                            $textslider_animation_delay = ' -webkit-animation-delay: '.$textslider_animation_delay_amount.'ms; animation-delay: '.$textslider_animation_delay_amount.'ms;';
                            $textslider_animation_delay_amount += 250;
                        }

                        if ( strpos($slide['textslider_title'], '|') !== false && $textslider_title_rotator == 'on') {
                            $textslider_title_span = $textslider_title_no_span[0] = $textslider_title_no_span[1] = '';

                            wp_enqueue_style( 'halena-cd-animated-headlines-style' );
                            wp_enqueue_script( 'halena-cd-animated-headlines-script' );

                            $textslider_title_effect = 'class="cd-headline '.$textslider_title_rotator_choice.'"';

                            $textslider_title_decode = wp_specialchars_decode( $slide['textslider_title'] );
                            $pattern = '/<span>(.*?)<\/span>/';
                            $textslider_title_no_span  = preg_split( $pattern, $textslider_title_decode );

                            $textslider_title_span_content = substr($textslider_title_decode, strpos($textslider_title_decode, "<span>") + 0);
                            $textslider_title_span_content = substr($textslider_title_span_content, 0, strpos($textslider_title_span_content, "</span>") + 7);
                            $textslider_title_span_content = explode( "|", $textslider_title_span_content );
                            foreach( $textslider_title_span_content as $textslider_title_span_text ){
                                $textslider_title_span .=  '<span class="rotate">'.$textslider_title_span_text.'</span>';
                            }
                            $textslider_title_span = str_replace('<span class="rotate"><span>', '<span class="cd-words-wrapper"><span class="rotate is-visible">', $textslider_title_span);
                            
                            $slide['textslider_title'] = $textslider_title_no_span[0].$textslider_title_span.$textslider_title_no_span[1];
                        }
                        $textslider_title = '<div class="agni-slide-title '.$textslider_animation.' '.$textslider_title_font.'" style="font-size:'.$textslider_title_size.'px; color:'.$textslider_title_color.'; margin-bottom:'.( preg_match( '/(px|em|\%|pt|cm)$/', $textslider_title_margin_bottom ) ? $textslider_title_margin_bottom : $textslider_title_margin_bottom . 'px' ).'; '.$textslider_animation_delay.'"><h2 '.$textslider_title_effect.'>'.wp_specialchars_decode( esc_attr( $slide['textslider_title'] ) ).'</h2></div>';
                    }

                    if ( isset( $slide['textslider_line'] ) && $slide['textslider_line'] == 'on' ){

                        if ( isset( $slide['textslider_line_color'] ) )
                            $textslider_title_line_color = esc_attr( $slide['textslider_line_color'] );

                        if( $textslider_has_animation == 'has-slide-content-animation'){
                            $textslider_animation_delay = 'style=" -webkit-animation-delay: '.$textslider_animation_delay_amount.'ms; animation-delay: '.$textslider_animation_delay_amount.'ms; "';
                            $textslider_animation_delay_amount += 250;
                        }
                        $textslider_title_line = '<div class="agni-slide-divideline divide-line '.$textslider_animation.'" '.$textslider_animation_delay.'><span style="background-color:'.$textslider_title_line_color.';"></span></div>'; 
                    }
                        
                    if ( !empty( $slide['textslider_desc'] ) ){

                        if ( isset( $slide['textslider_desc_font'] ) )
                            $textslider_desc_font = esc_attr( $slide['textslider_desc_font'] ); 

                        if ( isset( $slide['textslider_desc_size'] ) )
                            $textslider_desc_size = esc_attr( $slide['textslider_desc_size'] ); 

                        if ( isset( $slide['textslider_desc_color'] ) )
                            $textslider_desc_color = esc_attr( $slide['textslider_desc_color'] );

                        if ( isset( $slide['textslider_desc_margin_bottom'] ) )
                            $textslider_desc_margin_bottom = esc_attr( $slide['textslider_desc_margin_bottom'] );

                        if( $textslider_has_animation == 'has-slide-content-animation'){
                            $textslider_animation_delay = ' -webkit-animation-delay: '.$textslider_animation_delay_amount.'ms; animation-delay: '.$textslider_animation_delay_amount.'ms;';
                            $textslider_animation_delay_amount += 250;
                        }
                        $textslider_desc = '<div class="agni-slide-description '.$textslider_animation.' '.$textslider_desc_font.'" style="font-size:'.$textslider_desc_size.'px; color:'.$textslider_desc_color.'; margin-bottom:'.( preg_match( '/(px|em|\%|pt|cm)$/', $textslider_desc_margin_bottom ) ? $textslider_desc_margin_bottom : $textslider_desc_margin_bottom . 'px' ).'; '.$textslider_animation_delay.'"><p>'.wp_specialchars_decode( esc_attr( $slide['textslider_desc'] ) ).'</p></div>';
                    }
                        
                    if ( isset( $slide['textslider_button1'] ) )
                        $textslider_button1 = esc_attr( $slide['textslider_button1'] );

                    if ( isset( $slide['textslider_button1_icon'] ) )
                        $textslider_button1_icon = esc_attr( $slide['textslider_button1_icon'] );

                    if ( isset( $slide['textslider_button1_icon_style'] ) )
                        $textslider_button1_icon_style = esc_attr( $slide['textslider_button1_icon_style'] );

                    if ( isset( $slide['textslider_button1_text_hide'] ) )
                        $textslider_button1_text_hide = esc_attr( $slide['textslider_button1_text_hide'] );
                        
                    if ( isset( $slide['textslider_button1_url'] ) )
                        $textslider_button1_url = esc_url( $slide['textslider_button1_url'] );
                        
                    if ( isset( $slide['textslider_button1_style'] ) )
                        $textslider_button1_style = esc_attr( $slide['textslider_button1_style'] );
                        
                    if ( isset( $slide['textslider_button1_type'] ) )
                        $textslider_button1_type = esc_attr( $slide['textslider_button1_type'] );
                        
                    if ( isset( $slide['textslider_button1_radius'] ) )
                        $textslider_button1_radius = esc_attr( $slide['textslider_button1_radius'] );

                    if ( isset( $slide['textslider_button1_target'] ) )
                        $textslider_button1_target = esc_attr( $slide['textslider_button1_target'] );

                    if ( isset( $slide['textslider_button1_lightbox'] ) )
                        $textslider_button1_lightbox = esc_attr( $slide['textslider_button1_lightbox'] );

                    if ( isset( $slide['textslider_button1_embed_url'] ) )
                        $textslider_button1_embed_url = esc_html( $slide['textslider_button1_embed_url'] );

                    if ( isset( $slide['textslider_button2'] ) )
                        $textslider_button2 = esc_attr( $slide['textslider_button2'] );

                    if ( isset( $slide['textslider_button2_icon'] ) )
                        $textslider_button2_icon = esc_attr( $slide['textslider_button2_icon'] );

                    if ( isset( $slide['textslider_button2_icon_style'] ) )
                        $textslider_button2_icon_style = esc_attr( $slide['textslider_button2_icon_style'] );

                    if ( isset( $slide['textslider_button2_text_hide'] ) )
                        $textslider_button2_text_hide = esc_attr( $slide['textslider_button2_text_hide'] );
                        
                    if ( isset( $slide['textslider_button2_url'] ) )
                        $textslider_button2_url = esc_url( $slide['textslider_button2_url'] );
                        
                    if ( isset( $slide['textslider_button2_style'] ) )
                        $textslider_button2_style = esc_attr( $slide['textslider_button2_style'] );
                        
                    if ( isset( $slide['textslider_button2_type'] ) )
                        $textslider_button2_type = esc_attr( $slide['textslider_button2_type'] );
                        
                    if ( isset( $slide['textslider_button2_radius'] ) )
                        $textslider_button2_radius = esc_attr( $slide['textslider_button2_radius'] );

                    if ( isset( $slide['textslider_button2_target'] ) )
                        $textslider_button2_target = esc_attr( $slide['textslider_button2_target'] );

                    if ( isset( $slide['textslider_button2_lightbox'] ) )
                        $textslider_button2_lightbox = esc_attr( $slide['textslider_button2_lightbox'] );

                    if ( isset( $slide['textslider_button2_embed_url'] ) )
                        $textslider_button2_embed_url = esc_html( $slide['textslider_button2_embed_url'] );

                    if ( isset( $slide['textslider_arrowicon'] ) ){

                        if ( isset( $slide['textslider_arrowlink'] ) )
                            $textslider_arrowlink = esc_url( $slide['textslider_arrowlink'] );

                        if ( isset( $slide['textslider_arrowicon_color'] ) )
                            $textslider_arrowicon_color = esc_attr( $slide['textslider_arrowicon_color'] );

                        if( !empty( $textslider_arrowlink ) ){
                            $textslider_arrow = '<div class="agni-slide-arrow page-scroll"><a href="'.$textslider_arrowlink.'" style="color:'.$textslider_arrowicon_color.'"><i class="'.$slide['textslider_arrowicon'].'"></i></a></div>';
                        }
                    }

                    if( !empty($textslider_button1) ){

                        $args = array( 
                            'btn' => $textslider_button1, 
                            'btn_icon' => $textslider_button1_icon, 
                            'btn_icon_style' => $textslider_button1_icon_style, 
                            'btn_text_hide' => $textslider_button1_text_hide, 
                            'btn_url' => $textslider_button1_url, 
                            'btn_style' => $textslider_button1_style, 
                            'btn_type' => $textslider_button1_type, 
                            'btn_radius' => $textslider_button1_radius, 
                            'btn_target' => $textslider_button1_target, 
                            'btn_lightbox' => $textslider_button1_lightbox, 
                            'btn_embed_url' => $textslider_button1_embed_url, 
                            'btn_animation' => $textslider_animation, 
                            'btn_has_animation' => $textslider_has_animation, 
                            'btn_animation_delay' => $textslider_animation_delay, 
                            'btn_animation_delay_amount' => $textslider_animation_delay_amount 
                            );
                        $textslider_buttons .= agni_slider_button_generator( $args );
                        $textslider_animation_delay_amount += 250;

                    }
                    if( !empty($textslider_button2) ){

                        $args = array( 
                            'btn' => $textslider_button2, 
                            'btn_icon' => $textslider_button2_icon, 
                            'btn_icon_style' => $textslider_button2_icon_style, 
                            'btn_text_hide' => $textslider_button2_text_hide, 
                            'btn_url' => $textslider_button2_url, 
                            'btn_style' => $textslider_button2_style, 
                            'btn_type' => $textslider_button2_type, 
                            'btn_radius' => $textslider_button2_radius, 
                            'btn_target' => $textslider_button2_target, 
                            'btn_lightbox' => $textslider_button2_lightbox, 
                            'btn_embed_url' => $textslider_button2_embed_url, 
                            'btn_animation' => $textslider_animation, 
                            'btn_has_animation' => $textslider_has_animation, 
                            'btn_animation_delay' => $textslider_animation_delay, 
                            'btn_animation_delay_amount' => $textslider_animation_delay_amount 
                            );
                        $textslider_buttons .= agni_slider_button_generator( $args );
                        $textslider_animation_delay_amount += 250;

                    }
                    if( !empty($textslider_buttons) ){
                        $textslider_buttons = '<div class="agni-slide-buttons">'.$textslider_buttons.'</div>';
                    } 

                    if ( isset( $slide['textslider_content_position'] ) )
                        $textslider_content_position = esc_attr( $slide['textslider_content_position'] );
                                        
                    if ( isset( $slide['textslider_text_alignment'] ) )
                        $textslider_text_alignment = esc_attr( $slide['textslider_text_alignment'] );
                                        
                    //$textslider_content_choice $textslider_content_width
                    if ( !empty( $slide['textslider_content_width'] ) ){
                        $textslider_content_width = esc_attr( $slide['textslider_content_width'] );
                    }
                    if ( !empty( $slide['textslider_content_width_tab'] ) ){
                        $textslider_content_width_tab = esc_attr( $slide['textslider_content_width_tab'] );
                    }
                    if ( !empty( $slide['textslider_content_width_mobile'] ) ){
                        $textslider_content_width_mobile = esc_attr( $slide['textslider_content_width_mobile'] );
                    }

                    if ( isset( $slide['textslider_content_choice'] ) ){
                        $textslider_fullwidth_container = esc_attr( $slide['textslider_content_choice'] );
                    }

                    if ( isset( $slide['textslider_padding_top'] ) ){
                        $textslider_padding_top = esc_attr( $slide['textslider_padding_top'] );
                    }
                                        
                    if ( isset( $slide['textslider_padding_right'] ) ){
                        $textslider_padding_right = esc_attr( $slide['textslider_padding_right'] );
                    }
                                        
                    if ( isset( $slide['textslider_padding_bottom'] ) ){
                        $textslider_padding_bottom = esc_attr( $slide['textslider_padding_bottom'] );
                    }

                    if ( isset( $slide['textslider_padding_left'] ) ){
                        $textslider_padding_left = esc_attr( $slide['textslider_padding_left'] );
                    }
                    if ( isset( $slide['textslider_padding_top_tab'] ) ){
                        $textslider_padding_top_tab = esc_attr( $slide['textslider_padding_top_tab'] );
                    }
                                        
                    if ( isset( $slide['textslider_padding_right_tab'] ) ){
                        $textslider_padding_right_tab = esc_attr( $slide['textslider_padding_right_tab'] );
                    }
                                        
                    if ( isset( $slide['textslider_padding_bottom_tab'] ) ){
                        $textslider_padding_bottom_tab = esc_attr( $slide['textslider_padding_bottom_tab'] );
                    }

                    if ( isset( $slide['textslider_padding_left_tab'] ) ){
                        $textslider_padding_left_tab = esc_attr( $slide['textslider_padding_left_tab'] );
                    }
                    if ( isset( $slide['textslider_padding_top_mobile'] ) ){
                        $textslider_padding_top_mobile = esc_attr( $slide['textslider_padding_top_mobile'] );
                    }
                                        
                    if ( isset( $slide['textslider_padding_right_mobile'] ) ){
                        $textslider_padding_right_mobile = esc_attr( $slide['textslider_padding_right_mobile'] );
                    }
                                        
                    if ( isset( $slide['textslider_padding_bottom_mobile'] ) ){
                        $textslider_padding_bottom_mobile = esc_attr( $slide['textslider_padding_bottom_mobile'] );
                    }

                    if ( isset( $slide['textslider_padding_left_mobile'] ) ){
                        $textslider_padding_left_mobile = esc_attr( $slide['textslider_padding_left_mobile'] );
                    }

                    if ( !empty( $textslider_content_width ) ){
                        $slide_content_css .= 'max-width:'.( preg_match( '/(px|em|\%|pt|cm)$/', $textslider_content_width ) ? $textslider_content_width : $textslider_content_width . 'px' ).'; ';
                        $slide_content_class .= ' agni_custom_content_width';
                        $slide_content_attr .= ' data-content-width="'.$textslider_content_width.'"';
                    }
                    if ( !empty( $textslider_content_width_tab ) ){
                        $slide_content_attr .= ' data-content-width-tab="'.$textslider_content_width_tab.'"';
                    }
                    if ( !empty( $textslider_content_width_mobile ) ){
                        $slide_content_attr .= ' data-content-width-mobile="'.$textslider_content_width_mobile.'"';
                    }
                    
                    $padding_side = array('top', 'right', 'bottom', 'left');
                    $padding_device = array('', '_tab', '_mobile');
                    $slide_args = array();
                    foreach ( $padding_device as $device ) {
                        foreach( $padding_side as $value ){
                            $slide_args['padding_'.$value.$device] = (!empty(${'textslider_padding_'.$value.$device}))?${'textslider_padding_'.$value.$device}:'';
                        }
                    }

                    $slide_css_array = array_filter( agni_space_atts_processor( $slide_args ) );

                    if( !empty($slide_css_array[0]) ){
                        $slide_content_css .= $slide_css_array[0];
                        $slide_content_attr .= ' data-css-default="'.$slide_css_array[0].'"';
                    }
                    if( !empty($slide_css_array[1]) ){
                        $slide_content_attr .= ' data-css-tab="'.$slide_css_array[1].'"';
                    }
                    if( !empty($slide_css_array[2]) ){
                        $slide_content_attr .= ' data-css-mobile="'.$slide_css_array[2].'"';
                    }

                    if( !empty($slide_css_array) ){
                        $slide_content_class .= ' agni_custom_design_css';
                    }

                    $slides .= '<div class="agni-slide '.$textslider_has_animation.'" '.$slide_parallax.'>
                        <div class="agni-slide-content-container container '.$textslider_content_position.' text-'.$textslider_text_alignment.'">
                            <div class="agni-slide-content-inner '.$slide_content_class.' page-scroll" style="'.$slide_content_css.'" '.$slide_content_attr.'>
                                '.$textslider_image.$textslider_title.$textslider_title_line.$textslider_desc.$textslider_buttons.$textslider_arrow.'
                            </div>
                        </div>
                    </div>';

                }
                if ( $textslider_bg_choice == 'bg_color' ){
                    $textslider_bg = '<div class="agni-slide-bg agni-slide-bg-color" style="background-color:'.$textslider_bg_color.'; "></div>';
                }
                else if( $textslider_bg_choice == 'bg_image' ) {
                    $textslider_bg = '<div class="agni-slide-bg agni-slide-bg-image" style="background-image:url('.$textslider_bg_image.'); background-repeat:'.$textslider_bg_image_repeat.'; background-position:'.$textslider_bg_image_position.'; background-size:'.$textslider_bg_image_size.'; "></div>';
                }
                else{

                    if( $textslider_bg_video_loop == 'on'){
                        $textslider_bg_video_loop = 'true';
                        $bg_video_loop = 'loop ';
                    }
                    else{
                        $textslider_bg_video_loop = 'false';
                    }

                    if( $textslider_bg_video_yt_mobile == 'on'){
                        $textslider_bg_video_yt_mobile = 'true';
                        $player_yt_mobile = ' has-mobile-video';
                    }
                    else{
                        $textslider_bg_video_yt_mobile = 'false';
                    }
                    
                    if( $textslider_bg_video_autoplay == 'on'){
                        $textslider_bg_video_autoplay = 'true';
                        $bg_video_autoplay = 'autoplay ';
                        $bg_video_muted = 'muted ';
                    }
                    else{
                        $textslider_bg_video_autoplay = 'false';
                    }
                    
                    if( $textslider_bg_video_muted == 'on'){
                        $textslider_bg_video_muted = 'true';
                        $bg_video_muted = 'muted ';
                    }
                    else{
                        $textslider_bg_video_muted = 'false';
                    }

                    if( $textslider_bg_video_src == '1' ){

                        if (strpos($textslider_bg_video_src_yt, 'youtube') > 0) {
                            wp_enqueue_script( 'halena-mbytplayer-script' );
                            $player_src = 'player-yt';
                        } 
                        elseif (strpos($textslider_bg_video_src_yt, 'vimeo') > 0) {
                            wp_enqueue_script( 'halena-mbvimeoplayer-script' );
                            $player_src = 'player-vimeo';
                        } 

    
                        $agni_slide_bg_container_id = 'agni-slide-bg-container-'.rand(10000, 99999);
                        $textslider_bg = '<a id="bgndVideo-'.$post.'" class="player '.$player_src.$player_yt_mobile.'" style="background-image:url('.$textslider_bg_video_src_yt_fallback.');" data-property="{videoURL:\''.$textslider_bg_video_src_yt.'\',containment:\'.'.$agni_slide_bg_container_id.'\', showControls:false, useOnMobile: '.$textslider_bg_video_yt_mobile.', autoPlay:'.$textslider_bg_video_autoplay.', loop:'.$textslider_bg_video_loop.', vol:'.$textslider_bg_video_volume.', mute:'.$textslider_bg_video_muted.', startAt:'.$textslider_bg_video_start_at.', stopAt:'.$textslider_bg_video_stop_at.', opacity:1, addRaster:false, quality:\''.$textslider_bg_video_quality.'\',}"></a>';
                    }
                    else if( $textslider_bg_video_src == '2' ){
                        $textslider_bg = '<div id="agni-selfhosted-video-'.$post.'" class="agni-slide-bg agni-slide-bg-video self-hosted embed-responsive">
                                <video '. $bg_video_autoplay . $bg_video_loop . $bg_video_muted . ' class="custom-self-hosted-video" poster="'.$textslider_bg_video_src_sh_poster.'">
                                    <source src="'.$textslider_bg_video_src_sh.'" type="video/mp4" />
                                </video>
                            </div>';
                    }
                }
                
                if ( $textslider_bg_choice != 'bg_color' && $textslider_overlay_choice != '4' ){
                    if( $textslider_overlay_choice == '3' ){
                        wp_enqueue_script( 'halena-gradientmap-script' );
                        $textslider_overlay = '<div class="agni-slide-bg-overlay agni-gradient-map-overlay gradient-map-overlay overlay" data-gm="'.$textslider_bg_gm_overlay_color1.','.$textslider_bg_gm_overlay_color2.','.$textslider_bg_gm_overlay_color3.' " style="background-image:url('.$textslider_bg_image.'); background-repeat:'.$textslider_bg_image_repeat.'; background-position:'.$textslider_bg_image_position.'; background-size:'.$textslider_bg_image_size.'; "></div>';
                    }
                    elseif ( $textslider_overlay_choice == '2' ) {
                        $textslider_overlay = '<div class="agni-slide-bg-overlay overlay" style="'.$textslider_bg_sg_overlay_css.';"></div>';
                    }
                    else{
                        $textslider_overlay = '<div class="agni-slide-bg-overlay overlay" style="background-color:'.$textslider_overlay_color.';"></div>';
                    }
                }

                // BG particles
                if( $textslider_bg_particle_ground == 'on' ){
                    wp_enqueue_script( 'halena-particleground-script' );
                    $textslider_bg_particle_ground_color = ( $textslider_bg_particle_ground_color != '' ) ? $textslider_bg_particle_ground_color : 'rgba(255,255,255,0.2)';
                    $textslider_particle_ground = '<div class="particles" data-color="'.$textslider_bg_particle_ground_color.'"></div>';
                } 

                $output = '<div id="agni-slider-'.$post.'" class="agni-slider agni-text-slider '.$slider_class.'"'.$slider_css .' '.$slider_height.' data-slider-choice="'.$textslider_choice.'" data-slider-autoplay="'.$textslider_autoplay.'" data-slider-autoplay-speed="'.$textslider_transition_duration.'" data-slider-arrows="'.$textslider_navigation.'" data-slider-arrows-prev="'.$textslider_navigation_prev.'" data-slider-arrows-next="'.$textslider_navigation_next.'" data-slider-fade="'.$textslider_fade.'" data-slider-dots="'.$textslider_pagination.'" data-slider-infinite="'.$textslider_loop.'" data-slider-draggable="'.$textslider_mousedrag.'" data-slider-speed="'.$textslider_transition_speed.'" '.$textslider_carousel.' data-rtl="'.$rtl.'"><div class="agni-slide-bg-container '.$agni_slide_bg_container_id.'" '.$slide_parallax.'>'.$textslider_bg.$textslider_overlay.$textslider_particle_ground.'</div>'.$slides.$slider_nav.'</div>';
                
                return $output;

                break;

            case 'imageslider':
                
                wp_enqueue_style( 'halena-slick-style' );
                wp_enqueue_script( 'halena-slick-script' );
                
                $slides = $imageslider_animation = $slider_height = $slide_parallax = $imageslider_image = $imageslider_title = $imageslider_title_effect = $imageslider_title_size = $imageslider_title_color = $imageslider_desc = $imageslider_desc_size = $imageslider_desc_color = $imageslider_title_line = $imageslider_title_line_color = $imageslider_button1 = $imageslider_button1_icon = $imageslider_button1_url = $imageslider_button1_style = $imageslider_button1_type = $imageslider_button1_radius = $imageslider_button1_target = $imageslider_button1_lightbox = $imageslider_button2 = $imageslider_button2_icon = $imageslider_button2_url = $imageslider_button2_style = $imageslider_button2_type = $imageslider_button2_radius = $imageslider_button2_target = $imageslider_button2_lightbox = $imageslider_buttons = $imageslider_arrow = $imageslider_arrowicon = $imageslider_arrowlink = $imageslider_arrowicon_color = $imageslider_content_position = $imageslider_text_alignment = $imageslider_padding = $imageslider_padding_top = $imageslider_padding_bottom = $imageslider_padding_right = $imageslider_padding_left = $imageslider_has_animation = $imageslider_animation_delay = $imageslider_animation_delay_amount = $slider_css = $slider_class = $slide_content_class = $slide_content_css = $slide_content_attr = $slider_nav = '';
                        
                $imageslider_repeatable = get_post_meta( $post, 'agni_slides_imageslider_repeatable', true );
                
                $imageslider_choice = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_choice', true ) );
                $imageslider_height = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_height', true ) );
                $imageslider_height_tab = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_height_tab', true ) );
                $imageslider_height_mobile = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_height_mobile', true ) );

                $imageslider_margin_top = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_margin_top', true ) );
                $imageslider_margin_right = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_margin_right', true ) );
                $imageslider_margin_bottom = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_margin_bottom', true ) );
                $imageslider_margin_left = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_margin_left', true ) );
                $imageslider_margin_top_tab = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_margin_top_tab', true ) );
                $imageslider_margin_right_tab = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_margin_right_tab', true ) );
                $imageslider_margin_bottom_tab = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_margin_bottom_tab', true ) );
                $imageslider_margin_left_tab = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_margin_left_tab', true ) );
                $imageslider_margin_top_mobile = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_margin_top_mobile', true ) );
                $imageslider_margin_right_mobile = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_margin_right_mobile', true ) );
                $imageslider_margin_bottom_mobile = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_margin_bottom_mobile', true ) );
                $imageslider_margin_left_mobile = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_margin_left_mobile', true ) );

                $imageslider_parallax = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_parallax', true ) );
                $imageslider_parallax_start = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_parallax_start', true ) );
                $imageslider_parallax_end = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_parallax_end', true ) );
                //$imageslider_animate_in = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_animate_in', true ) );
                //$imageslider_animate_out = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_animate_out', true ) );
                
                $imageslider_animation = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_slide_animation', true ) );

                $imageslider_autoplay = (esc_attr( get_post_meta( $post, 'agni_slides_imageslider_autoplay', true ) ) == 'on')?'true':'false';
                $imageslider_loop = (esc_attr( get_post_meta( $post, 'agni_slides_imageslider_loop', true ) ) == 'on')?'true':'false';
                $imageslider_transition_duration = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_transition_duration', true ) );
                $imageslider_transition_speed = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_transition_speed', true ) );
                $imageslider_navigation = (esc_attr( get_post_meta( $post, 'agni_slides_imageslider_navigation', true ) ) == 'on')?'true':'false';
                $imageslider_navigation_prev = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_navigation_prev', true ) );
                $imageslider_navigation_next = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_navigation_next', true ) );
                $imageslider_pagination = (esc_attr( get_post_meta( $post, 'agni_slides_imageslider_pagination', true ) ) == 'on')?'true':'false';
                $imageslider_mousedrag = (esc_attr( get_post_meta( $post, 'agni_slides_imageslider_mousedrag', true ) ) == 'on')?'true':'false';

                $imageslider_image_id = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_image_id', true ) );
                $imageslider_image_size = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_image_size', true ) );
                $imageslider_image_size_tab = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_image_size_tab', true ) );
                $imageslider_image_size_mobile = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_image_size_mobile', true ) );
                $imageslider_title = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_title', true ) );
                $imageslider_title_rotator = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_title_rotator', true ) );
                $imageslider_title_rotator_choice = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_title_rotator_choice', true ) );
                $imageslider_title_font = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_title_font', true ) );   
                $imageslider_title_size = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_title_size', true ) );   
                $imageslider_title_color = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_title_color', true ) ); 
                $imageslider_title_margin_bottom = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_title_margin_bottom', true ) );
                $imageslider_title_line = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_line', true ) );
                $imageslider_title_line_color = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_line_color', true ) );
                $imageslider_desc = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_desc', true ) );
                $imageslider_desc_font = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_desc_font', true ) ); 
                $imageslider_desc_size = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_desc_size', true ) ); 
                $imageslider_desc_color = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_desc_color', true ) );
                $imageslider_desc_margin_bottom = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_desc_margin_bottom', true ) );
                $imageslider_button1 = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_button1', true ) );
                $imageslider_button1_icon = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_button1_icon', true ) );
                $imageslider_button1_icon_style = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_button1_icon_style', true ) );
                $imageslider_button1_text_hide = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_button1_text_hide', true ) );
                $imageslider_button1_url = esc_url( get_post_meta( $post, 'agni_slides_imageslider_button1_url', true ) );
                $imageslider_button1_style = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_button1_style', true ) );
                $imageslider_button1_type = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_button1_type', true ) );
                $imageslider_button1_radius = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_button1_radius', true ) );
                $imageslider_button1_target = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_button1_target', true ) );
                $imageslider_button1_lightbox = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_button1_lightbox', true ) );
                $imageslider_button1_embed_url = esc_html( get_post_meta( $post, 'agni_slides_imageslider_button1_embed_url', true ) );
                $imageslider_button2 = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_button2', true ) );
                $imageslider_button2_icon = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_button2_icon', true ) );
                $imageslider_button2_icon_style = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_button2_icon_style', true ) );
                $imageslider_button2_text_hide = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_button2_text_hide', true ) );
                $imageslider_button2_url = esc_url( get_post_meta( $post, 'agni_slides_imageslider_button2_url', true ) );
                $imageslider_button2_style = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_button2_style', true ) );
                $imageslider_button2_type = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_button2_type', true ) );
                $imageslider_button2_radius = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_button2_radius', true ) );
                $imageslider_button2_target = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_button2_target', true ) );
                $imageslider_button2_lightbox = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_button2_lightbox', true ) );
                $imageslider_button2_embed_url = esc_html( get_post_meta( $post, 'agni_slides_imageslider_button2_embed_url', true ) );
                $imageslider_animation = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_animation', true ) );
                $imageslider_arrowicon = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_arrowicon', true ) );
                $imageslider_arrowlink = esc_url( get_post_meta( $post, 'agni_slides_imageslider_arrowlink', true ) );
                $imageslider_arrowicon_color = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_arrowicon_color', true ) );

                $imageslider_content_width = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_content_width', true ) );
                $imageslider_content_width_tab = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_content_width_tab', true ) );
                $imageslider_content_width_mobile = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_content_width_mobile', true ) );
                $imageslider_content_position = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_content_position', true ) );
                $imageslider_text_alignment = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_text_alignment', true ) );

                $imageslider_padding_top = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_padding_top', true ) );
                $imageslider_padding_bottom = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_padding_bottom', true ) );
                $imageslider_padding_right = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_padding_right', true ) );
                $imageslider_padding_left = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_padding_left', true ) );
                $imageslider_padding_top_tab = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_padding_top_tab', true ) );
                $imageslider_padding_bottom_tab = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_padding_bottom_tab', true ) );
                $imageslider_padding_right_tab = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_padding_right_tab', true ) );
                $imageslider_padding_left_tab = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_padding_left_tab', true ) );
                $imageslider_padding_top_mobile = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_padding_top_mobile', true ) );
                $imageslider_padding_bottom_mobile = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_padding_bottom_mobile', true ) );
                $imageslider_padding_right_mobile = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_padding_right_mobile', true ) );
                $imageslider_padding_left_mobile = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_padding_left_mobile', true ) );


                if( $imageslider_choice == '1' ){
                    $slider_height = 'data-fullscreen-height = 1';
                }
                else{
                    $slider_height = 'data-height="'.$imageslider_height.'" data-height-tab="'.$imageslider_height_tab.'" data-height-mobile="'.$imageslider_height_mobile.'"';
                }
                
                if( $imageslider_parallax == 'on' && $shortcode == false ){
                    $slide_parallax = 'data-0="'.$imageslider_parallax_start.'" data-1500="'.$imageslider_parallax_end.'"';
                }
                $imageslider_carousel = 'data-slider-center-mode="false" data-slider-slide-to-show="1" data-slider-slide-to-show-1200="1" data-slider-slide-to-show-992="1" data-slider-slide-to-show-768="1" data-slider-carousel-margin="0"';


                if( $imageslider_animation == 'fade' ){
                    $imageslider_fade = 'true';
                }
                else{
                    $imageslider_fade = 'false';
                }
                
                if( $imageslider_pagination == 'true' || $imageslider_navigation == 'true' ){
                    $slider_nav = '<div class="slick-nav"></div>';
                }

                $imageslider_arrows_prev = '<button type="button" class="slick-prev">'.$imageslider_navigation_prev.'</button>';
                $imageslider_arrows_next = '<button type="button" class="slick-next">'.$imageslider_navigation_next.'</button>';


                if( !empty($imageslider_animation) ){
                        $imageslider_has_animation = 'has-slide-content-animation';
                        $imageslider_animation_delay_amount = 0;
                }

                if( !empty($imageslider_image_id) ){
                    if( $imageslider_has_animation == 'has-slide-content-animation'){
                        $imageslider_animation_delay = ' -webkit-animation-delay: '.$imageslider_animation_delay_amount.'ms; animation-delay: '.$imageslider_animation_delay_amount.'ms;';
                        $imageslider_animation_delay_amount += 250;
                    }
                    $imageslider_image_width = 'data-width="'.$imageslider_image_size.'" data-width-tab="'.$imageslider_image_size_tab.'" data-width-mobile="'.$imageslider_image_size_mobile.'"';
                    
                    $imageslider_image = '<div class="agni-slide-image '.$imageslider_animation.'" style="'.$imageslider_animation_delay.'" '.$imageslider_image_width.'>'.wp_get_attachment_image($imageslider_image_id, 'full' ).'</div>';
                }

                if ( !empty($imageslider_title) ){
                    $imageslider_title_span = $imageslider_title_no_span[0] = $imageslider_title_no_span[1] = '';

                    if( $imageslider_has_animation == 'has-slide-content-animation'){
                        $imageslider_animation_delay = ' -webkit-animation-delay: '.$imageslider_animation_delay_amount.'ms; animation-delay: '.$imageslider_animation_delay_amount.'ms;';
                        $imageslider_animation_delay_amount += 250;
                    }

                    if ( strpos($imageslider_title, '|') !== false && $imageslider_title_rotator == 'on') {
                        $imageslider_title_span = $imageslider_title_no_span[0] = $imageslider_title_no_span[1] = '';

                        wp_enqueue_style( 'halena-cd-animated-headlines-style' );
                        wp_enqueue_script( 'halena-cd-animated-headlines-script' );

                        $imageslider_title_effect = 'class="cd-headline '.$imageslider_title_rotator_choice.'"';

                        $imageslider_title_decode = wp_specialchars_decode( $imageslider_title );
                        $pattern = '/<span>(.*?)<\/span>/';
                        $imageslider_title_no_span  = preg_split( $pattern, $imageslider_title_decode );

                        $imageslider_title_span_content = substr($imageslider_title_decode, strpos($imageslider_title_decode, "<span>") + 0);
                        $imageslider_title_span_content = substr($imageslider_title_span_content, 0, strpos($imageslider_title_span_content, "</span>") + 7);
                        $imageslider_title_span_content = explode( "|", $imageslider_title_span_content );
                        foreach( $imageslider_title_span_content as $imageslider_title_span_text ){
                            $imageslider_title_span .=  '<span class="rotate">'.$imageslider_title_span_text.'</span>';
                        }
                        $imageslider_title_span = str_replace('<span class="rotate"><span>', '<span class="cd-words-wrapper"><span class="rotate is-visible">', $imageslider_title_span);
                        
                        $imageslider_title = $imageslider_title_no_span[0].$imageslider_title_span.$imageslider_title_no_span[1];
                    }
                    $imageslider_title = '<div class="agni-slide-title '.$imageslider_animation.' '.$imageslider_title_font.'" style="font-size:'.$imageslider_title_size.'px; color:'.$imageslider_title_color.'; margin-bottom:'.( preg_match( '/(px|em|\%|pt|cm)$/', $imageslider_title_margin_bottom ) ? $imageslider_title_margin_bottom : $imageslider_title_margin_bottom . 'px' ).'; '.$imageslider_animation_delay.'"><h2 '.$imageslider_title_effect.'>'.wp_specialchars_decode( esc_attr( $imageslider_title ) ).'</h2></div>';
                }

                if ( $imageslider_title_line == 'on' ){

                    if( $imageslider_has_animation == 'has-slide-content-animation'){
                        $imageslider_animation_delay = 'style=" -webkit-animation-delay: '.$imageslider_animation_delay_amount.'ms; animation-delay: '.$imageslider_animation_delay_amount.'ms; "';
                        $imageslider_animation_delay_amount += 250;
                    }
                    $imageslider_title_line = '<div class="agni-slide-divideline divide-line '.$imageslider_animation.'" '.$imageslider_animation_delay.'><span style="background-color:'.$imageslider_title_line_color.';"></span></div>'; 
                }
                    
                if ( !empty($imageslider_desc) ){
                    if( $imageslider_has_animation == 'has-slide-content-animation'){
                        $imageslider_animation_delay = ' -webkit-animation-delay: '.$imageslider_animation_delay_amount.'ms; animation-delay: '.$imageslider_animation_delay_amount.'ms;';
                        $imageslider_animation_delay_amount += 250;
                    }
                    $imageslider_desc = '<div class="agni-slide-description '.$imageslider_animation.' '.$imageslider_desc_font.'" style="font-size:'.$imageslider_desc_size.'px; color:'.$imageslider_desc_color.'; margin-bottom:'.( preg_match( '/(px|em|\%|pt|cm)$/', $imageslider_desc_margin_bottom ) ? $imageslider_desc_margin_bottom : $imageslider_desc_margin_bottom . 'px' ).'; '.$imageslider_animation_delay.'"><p>'.wp_specialchars_decode( $imageslider_desc ).'</p></div>';
                }

                if ( !empty($imageslider_arrowlink) ){
                    if( !empty( $imageslider_arrowlink ) ){
                        $imageslider_arrow = '<div class="agni-slide-arrow page-scroll"><a href="'.$imageslider_arrowlink.'" style="color:'.$imageslider_arrowicon_color.'"><i class="'.$imageslider_arrowicon.'"></i></a></div>';
                    }
                }

                if( !empty($imageslider_button1) ){

                    $args = array( 
                        'btn' => $imageslider_button1, 
                        'btn_icon' => $imageslider_button1_icon, 
                        'btn_icon_style' => $imageslider_button1_icon_style, 
                        'btn_text_hide' => $imageslider_button1_text_hide, 
                        'btn_url' => $imageslider_button1_url, 
                        'btn_style' => $imageslider_button1_style, 
                        'btn_type' => $imageslider_button1_type, 
                        'btn_radius' => $imageslider_button1_radius, 
                        'btn_target' => $imageslider_button1_target, 
                        'btn_lightbox' => $imageslider_button1_lightbox, 
                        'btn_embed_url' => $imageslider_button1_embed_url, 
                        'btn_animation' => $imageslider_animation, 
                        'btn_has_animation' => $imageslider_has_animation, 
                        'btn_animation_delay' => $imageslider_animation_delay, 
                        'btn_animation_delay_amount' => $imageslider_animation_delay_amount 
                        );
                    $imageslider_buttons .= agni_slider_button_generator( $args );
                    $imageslider_animation_delay_amount += 250;

                }
                if( !empty($imageslider_button2) ){

                    $args = array( 
                        'btn' => $imageslider_button2, 
                        'btn_icon' => $imageslider_button2_icon, 
                        'btn_icon_style' => $imageslider_button2_icon_style, 
                        'btn_text_hide' => $imageslider_button2_text_hide, 
                        'btn_url' => $imageslider_button2_url, 
                        'btn_style' => $imageslider_button2_style, 
                        'btn_type' => $imageslider_button2_type, 
                        'btn_radius' => $imageslider_button2_radius, 
                        'btn_target' => $imageslider_button2_target, 
                        'btn_lightbox' => $imageslider_button2_lightbox, 
                        'btn_embed_url' => $imageslider_button2_embed_url, 
                        'btn_animation' => $imageslider_animation, 
                        'btn_has_animation' => $imageslider_has_animation, 
                        'btn_animation_delay' => $imageslider_animation_delay, 
                        'btn_animation_delay_amount' => $imageslider_animation_delay_amount 
                        );
                    $imageslider_buttons .= agni_slider_button_generator( $args );
                    $imageslider_animation_delay_amount += 250;

                }
                if( !empty($imageslider_buttons) ){
                    $imageslider_buttons = '<div class="agni-slide-buttons">'.$imageslider_buttons.'</div>';
                } 
                    
                $margin_side = array('top', 'right', 'bottom', 'left');
                $margin_device = array('', '_tab', '_mobile');
                $slide_args = array();
                foreach ( $margin_device as $device ) {
                    foreach( $margin_side as $value ){
                        $slide_args['margin_'.$value.$device] = (!empty(${'imageslider_margin_'.$value.$device}))?${'imageslider_margin_'.$value.$device}:'';
                    }
                }

                $slider_css_array = array_filter( agni_space_atts_processor( $slide_args ) );
                if( !empty($slider_css_array[0]) ){
                    $slider_css .= ' style="'.$slider_css_array[0].'" data-css-default="'.$slider_css_array[0].'"';
                }
                if( !empty($slider_css_array[1]) ){
                    $slider_css .= ' data-css-tab="'.$slider_css_array[1].'"';
                }
                if( !empty($slider_css_array[2]) ){
                    $slider_css .= ' data-css-mobile="'.$slider_css_array[2].'"';
                }

                if( !empty($slider_css) ){
                    $slider_class = 'agni_custom_design_css';
                }


                if ( !empty( $imageslider_content_width ) ){
                    $slide_content_css .= 'max-width:'.( preg_match( '/(px|em|\%|pt|cm)$/', $imageslider_content_width ) ? $imageslider_content_width : $imageslider_content_width . 'px' ).'; ';
                    $slide_content_class .= ' agni_custom_content_width';
                    $slide_content_attr .= ' data-content-width="'.$imageslider_content_width.'"';
                }
                if ( !empty( $imageslider_content_width_tab ) ){
                    $slide_content_attr .= ' data-content-width-tab="'.$imageslider_content_width_tab.'"';
                }
                if ( !empty( $imageslider_content_width_mobile ) ){
                    $slide_content_attr .= ' data-content-width-mobile="'.$imageslider_content_width_mobile.'"';
                }
                
                $padding_side = array('top', 'right', 'bottom', 'left');
                $padding_device = array('', '_tab', '_mobile');
                $slide_args = array();
                foreach ( $padding_device as $device ) {
                    foreach( $padding_side as $value ){
                        $slide_args['padding_'.$value.$device] = (!empty(${'imageslider_padding_'.$value.$device}))?${'imageslider_padding_'.$value.$device}:'';
                    }
                }

                $slide_css_array = array_filter( agni_space_atts_processor( $slide_args ) );

                if( !empty($slide_css_array[0]) ){
                    $slide_content_css .= $slide_css_array[0];
                    $slide_content_attr .= ' data-css-default="'.$slide_css_array[0].'"';
                }
                if( !empty($slide_css_array[1]) ){
                    $slide_content_attr .= ' data-css-tab="'.$slide_css_array[1].'"';
                }
                if( !empty($slide_css_array[2]) ){
                    $slide_content_attr .= ' data-css-mobile="'.$slide_css_array[2].'"';
                }

                if( !empty($slide_css_array) ){
                    $slide_content_class .= ' agni_custom_design_css';
                }
                
                foreach( (array) $imageslider_repeatable as $key => $slide ){
                    $imageslider_bg_choice = $imageslider_bg_color = $imageslider_bg_image = $imageslider_bg_image_position = $imageslider_bg_image_repeat = $imageslider_bg_image_size = $imageslider_overlay =  $imageslider_overlay_choice = $imageslider_overlay_color = $imageslider_bg_sg_overlay_css = $imageslider_bg_gm_overlay_color1 = $imageslider_bg_gm_overlay_color2 = $imageslider_bg_gm_overlay_color3 = $imageslider_particle_ground = $imageslider_bg_particle_ground = $imageslider_bg_particle_ground_color = $imageslider_bg = $imageslider_size = '';

                    if( isset( $slide['imageslider_bg_choice'] ) )
                        $imageslider_bg_choice = esc_attr( $slide['imageslider_bg_choice'] );

                    if( isset( $slide['imageslider_bg_color'] ) )
                        $imageslider_bg_color = esc_attr( $slide['imageslider_bg_color'] );

                    if( isset( $slide['imageslider_bg_image'] ) )
                        $imageslider_bg_image = esc_attr( $slide['imageslider_bg_image'] );

                    if( isset( $slide['imageslider_bg_image_position'] ) )
                        $imageslider_bg_image_position = esc_attr( $slide['imageslider_bg_image_position'] );

                    if( isset( $slide['imageslider_bg_image_repeat'] ) )
                        $imageslider_bg_image_repeat = esc_attr( $slide['imageslider_bg_image_repeat'] );

                    if( isset( $slide['imageslider_bg_image_size'] ) )
                        $imageslider_bg_image_size = esc_attr( $slide['imageslider_bg_image_size'] );
                                        
                    if ( isset( $slide['imageslider_bg_overlay_choice'] ) )
                        $imageslider_overlay_choice = esc_attr( $slide['imageslider_bg_overlay_choice'] );
                        
                    if ( isset( $slide['imageslider_bg_overlay_color'] ) )
                        $imageslider_overlay_color = esc_attr( $slide['imageslider_bg_overlay_color'] );        

                    if ( isset( $slide['imageslider_bg_sg_overlay_css'] ) )
                        $imageslider_bg_sg_overlay_css = esc_attr( $slide['imageslider_bg_sg_overlay_css'] );

                    if ( isset( $slide['imageslider_bg_gm_overlay_color1'] ) )
                        $imageslider_bg_gm_overlay_color1 = esc_attr( $slide['imageslider_bg_gm_overlay_color1'] ); 

                    if ( isset( $slide['imageslider_bg_gm_overlay_color2'] ) )
                        $imageslider_bg_gm_overlay_color2 = esc_attr( $slide['imageslider_bg_gm_overlay_color2'] ); 

                    if ( isset( $slide['imageslider_bg_gm_overlay_color3'] ) )
                        $imageslider_bg_gm_overlay_color3 = esc_attr( $slide['imageslider_bg_gm_overlay_color3'] ); 

                    if ( isset( $slide['imageslider_bg_particle_ground'] ) )
                        $imageslider_bg_particle_ground = esc_attr( $slide['imageslider_bg_particle_ground'] ); 

                    if ( isset( $slide['imageslider_bg_particle_ground_color'] ) )
                        $imageslider_bg_particle_ground_color = esc_attr( $slide['imageslider_bg_particle_ground_color'] ); 

                        
                    if ( $imageslider_bg_choice == 'bg_color' ){
                        $imageslider_bg = '<div class="agni-slide-bg agni-slide-bg-color" style="background-color:'.$imageslider_bg_color.'; "></div>';
                    }
                    else {
                        $imageslider_bg = '<div class="agni-slide-bg agni-slide-bg-image" style="background-image:url('.$imageslider_bg_image.'); background-repeat:'.$imageslider_bg_image_repeat.'; background-position:'.$imageslider_bg_image_position.'; background-size:'.$imageslider_bg_image_size.'; "></div>';
                    }
                    
                    if ( $imageslider_bg_choice != 'bg_color' && $imageslider_overlay_choice != '4' ){
                        if( $imageslider_overlay_choice == '3' ){
                            wp_enqueue_script( 'halena-gradientmap-script' );
                            $imageslider_overlay = '<div class="agni-slide-bg-overlay agni-gradient-map-overlay gradient-map-overlay overlay" data-gm="'.$imageslider_bg_gm_overlay_color1.','.$imageslider_bg_gm_overlay_color2.','.$imageslider_bg_gm_overlay_color3.' " style="background-image:url('.$imageslider_bg_image.'); background-repeat:'.$imageslider_bg_image_repeat.'; background-position:'.$imageslider_bg_image_position.'; background-size:'.$imageslider_bg_image_size.'; "></div>';
                        }
                        elseif ( $imageslider_overlay_choice == '2' ) {
                            $imageslider_overlay = '<div class="agni-slide-bg-overlay overlay" style="'.$imageslider_bg_sg_overlay_css.';"></div>';
                        }
                        else{
                            $imageslider_overlay = '<div class="agni-slide-bg-overlay overlay" style="background-color:'.$imageslider_overlay_color.';"></div>';
                        }
                    }

                    // BG particles
                    if( $imageslider_bg_particle_ground == 'on' ){
                        wp_enqueue_script( 'halena-particleground-script' );
                        $imageslider_bg_particle_ground_color = ( $imageslider_bg_particle_ground_color != '' ) ? $imageslider_bg_particle_ground_color : 'rgba(255,255,255,0.2)';
                        $imageslider_particle_ground = '<div class="particles" data-color="'.$imageslider_bg_particle_ground_color.'"></div>';
                    } 
                    
                    $slides .= '<div class="agni-slide '.$imageslider_has_animation.'" '.$slide_parallax.'>
                        <div class="agni-slide-bg-container">'.$imageslider_bg.$imageslider_overlay.$imageslider_particle_ground.'</div>
                    </div>';

                }

                $output = '<div id="agni-slider-'.$post.'" class="agni-slider agni-image-slider '.$slider_class.'"'.$slider_css .' '.$slider_height.' data-slider-choice="'.$imageslider_choice.'" data-slider-autoplay="'.$imageslider_autoplay.'" data-slider-autoplay-speed="'.$imageslider_transition_duration.'" data-slider-arrows="'.$imageslider_navigation.'" data-slider-arrows-prev="'.$imageslider_navigation_prev.'" data-slider-arrows-next="'.$imageslider_navigation_next.'" data-slider-fade="'.$imageslider_fade.'" data-slider-dots="'.$imageslider_pagination.'" data-slider-infinite="'.$imageslider_loop.'" data-slider-draggable="'.$imageslider_mousedrag.'" data-slider-speed="'.$imageslider_transition_speed.'" '.$imageslider_carousel.' data-rtl="'.$rtl.'">'.$slides.'
                    <div class="agni-slide-content-container container '.$imageslider_content_position.' text-'.$imageslider_text_alignment.'">
                        <div class="agni-slide-content-inner '.$slide_content_class.' page-scroll" style="'.$slide_content_css.'" '.$slide_content_attr.'>
                            '.$imageslider_image.$imageslider_title.$imageslider_title_line.$imageslider_desc.$imageslider_buttons.$imageslider_arrow.'
                        </div>
                    </div>
                    '.$slider_nav.'
                </div>';
                
                return $output;

                break;

            case 'posttypeslider':
                
                wp_enqueue_style( 'halena-slick-style' );
                wp_enqueue_script( 'halena-slick-script' );

                $output = $blog_categories = $portfolio_categories = $posttypeslider_animation = $slider_height = $slide_parallax = $posttypeslider_title = $posttypeslider_title_size = $posttypeslider_title_color = $posttypeslider_categories = $posttypeslider_categories_size = $posttypeslider_categories_color = $posttypeslider_button1 = $posttypeslider_button1_url = $posttypeslider_button1_style = $posttypeslider_button1_type = $posttypeslider_button1_css = $posttypeslider_button1_target = $posttypeslider_buttons = $posttypeslider_content_position = $posttypeslider_text_alignment = $posttypeslider_padding = $posttypeslider_padding_top = $posttypeslider_padding_bottom = $posttypeslider_padding_right = $posttypeslider_padding_left = $posttypeslider_has_animation = $posttypeslider_animation_delay = $posttypeslider_animation_delay_amount = $posttypeslider_overlay = $posttypeslider_particle_ground = $posttypeslider_fullwidth_container = '';

                $posttypeslider_posttype_choice = esc_attr( get_post_meta( $post, 'agni_slides_posttypeslider_posttype_choice', true ) ); 
                $posttypeslider_items_per_page = esc_attr( get_post_meta( $post, 'agni_slides_posttypeslider_items_per_page', true ) ); 
                $posttypeslider_blog_categories = get_the_terms( $post, 'category' );  
                $posttypeslider_portfolio_categories = get_the_terms( $post, 'types' ); 
                $posttypeslider_posts_in = esc_attr( get_post_meta( $post, 'agni_slides_posttypeslider_posts_in', true ) ); 
                $posttypeslider_posts_not_in = esc_attr( get_post_meta( $post, 'agni_slides_posttypeslider_posts_not_in', true ) );
                $posttypeslider_items_order = esc_attr( get_post_meta( $post, 'agni_slides_posttypeslider_items_order', true ) );
                $posttypeslider_items_orderby = esc_attr( get_post_meta( $post, 'agni_slides_posttypeslider_items_orderby', true ) );
                $posttypeslider_ignore_sticky = esc_attr( get_post_meta( $post, 'agni_slides_posttypeslider_ignore_sticky', true ) );
                $posttypeslider_bg_image_position = esc_attr( get_post_meta( $post, 'agni_slides_posttypeslider_bg_image_position', true ) );
                $posttypeslider_bg_image_repeat = esc_attr( get_post_meta( $post, 'agni_slides_posttypeslider_bg_image_repeat', true ) );
                $posttypeslider_bg_image_size = esc_attr( get_post_meta( $post, 'agni_slides_posttypeslider_bg_image_size', true ) );
                $posttypeslider_overlay_choice = esc_attr( get_post_meta( $post, 'agni_slides_posttypeslider_bg_overlay_choice', true ) );
                $posttypeslider_overlay_color = esc_attr( get_post_meta( $post, 'agni_slides_posttypeslider_bg_overlay_color', true ) );        
                $posttypeslider_bg_sg_overlay_css = esc_attr( get_post_meta( $post, 'agni_slides_posttypeslider_bg_sg_overlay_css', true ) );
                $posttypeslider_bg_gm_overlay_color1 = esc_attr( get_post_meta( $post, 'agni_slides_posttypeslider_bg_gm_overlay_color1', true ) ); 
                $posttypeslider_bg_gm_overlay_color2 = esc_attr( get_post_meta( $post, 'agni_slides_posttypeslider_bg_gm_overlay_color2', true ) ); 
                $posttypeslider_bg_gm_overlay_color3 = esc_attr( get_post_meta( $post, 'agni_slides_posttypeslider_bg_gm_overlay_color3', true ) );
                $posttypeslider_bg_particle_ground = esc_attr( get_post_meta( $post, 'agni_slides_posttypeslider_bg_particle_ground', true ) );
                $posttypeslider_bg_particle_ground_color = esc_attr( get_post_meta( $post, 'agni_slides_posttypeslider_bg_particle_ground_color', true ) ); 

                $posttypeslider_choice = esc_attr( get_post_meta( $post, 'agni_slides_posttypeslider_choice', true ) );
                $posttypeslider_height = esc_attr( get_post_meta( $post, 'agni_slides_posttypeslider_height', true ) );
                $posttypeslider_height_tab = esc_attr( get_post_meta( $post, 'agni_slides_posttypeslider_height_tab', true ) );
                $posttypeslider_height_mobile = esc_attr( get_post_meta( $post, 'agni_slides_posttypeslider_height_mobile', true ) );
                $posttypeslider_parallax = esc_attr( get_post_meta( $post, 'agni_slides_posttypeslider_parallax', true ) );
                $posttypeslider_parallax_start = esc_attr( get_post_meta( $post, 'agni_slides_posttypeslider_parallax_start', true ) );
                $posttypeslider_parallax_end = esc_attr( get_post_meta( $post, 'agni_slides_posttypeslider_parallax_end', true ) );
                $posttypeslider_animate_in = esc_attr( get_post_meta( $post, 'agni_slides_posttypeslider_animate_in', true ) );
                $posttypeslider_animate_out = esc_attr( get_post_meta( $post, 'agni_slides_posttypeslider_animate_out', true ) );
                $posttypeslider_autoplay = (esc_attr( get_post_meta( $post, 'agni_slides_posttypeslider_autoplay', true ) ) == 'on')?'true':'false';
                $posttypeslider_loop = (esc_attr( get_post_meta( $post, 'agni_slides_posttypeslider_loop', true ) ) == 'on')?'true':'false';
                $posttypeslider_transition_duration = esc_attr( get_post_meta( $post, 'agni_slides_posttypeslider_transition_duration', true ) );
                $posttypeslider_transition_speed = esc_attr( get_post_meta( $post, 'agni_slides_posttypeslider_transition_speed', true ) );
                $posttypeslider_navigation = (esc_attr( get_post_meta( $post, 'agni_slides_posttypeslider_navigation', true ) ) == 'on')?'true':'false';
                $posttypeslider_pagination = (esc_attr( get_post_meta( $post, 'agni_slides_posttypeslider_pagination', true ) ) == 'on')?'true':'false';
                $posttypeslider_mousedrag = (esc_attr( get_post_meta( $post, 'agni_slides_posttypeslider_mousedrag', true ) ) == 'on')?'true':'false';

                $posttypeslider_title_choice = esc_attr( get_post_meta( $post, 'agni_slides_posttypeslider_title_choice', true ) );
                $posttypeslider_title_font = esc_attr( get_post_meta( $post, 'agni_slides_posttypeslider_title_font', true ) );   
                $posttypeslider_title_size = esc_attr( get_post_meta( $post, 'agni_slides_posttypeslider_title_size', true ) );   
                $posttypeslider_title_color = esc_attr( get_post_meta( $post, 'agni_slides_posttypeslider_title_color', true ) ); 
                $posttypeslider_categories_choice = esc_attr( get_post_meta( $post, 'agni_slides_posttypeslider_categories_choice', true ) );
                $posttypeslider_categories_font = esc_attr( get_post_meta( $post, 'agni_slides_posttypeslider_categories_font', true ) ); 
                $posttypeslider_categories_size = esc_attr( get_post_meta( $post, 'agni_slides_posttypeslider_categories_size', true ) ); 
                $posttypeslider_categories_color = esc_attr( get_post_meta( $post, 'agni_slides_posttypeslider_categories_color', true ) );
                $posttypeslider_button1 = esc_attr( get_post_meta( $post, 'agni_slides_posttypeslider_button1', true ) );
                $posttypeslider_button1_style = esc_attr( get_post_meta( $post, 'agni_slides_posttypeslider_button1_style', true ) );
                $posttypeslider_button1_type = esc_attr( get_post_meta( $post, 'agni_slides_posttypeslider_button1_type', true ) );
                $posttypeslider_button1_radius = esc_attr( get_post_meta( $post, 'agni_slides_posttypeslider_button1_radius', true ) );
                $posttypeslider_button1_target = esc_attr( get_post_meta( $post, 'agni_slides_posttypeslider_button1_target', true ) );
                $posttypeslider_animation = esc_attr( get_post_meta( $post, 'agni_slides_posttypeslider_animation', true ) );
                $posttypeslider_content_position = esc_attr( get_post_meta( $post, 'agni_slides_posttypeslider_content_position', true ) );
                $posttypeslider_text_alignment = esc_attr( get_post_meta( $post, 'agni_slides_posttypeslider_text_alignment', true ) );
                $posttypeslider_padding_top = esc_attr( get_post_meta( $post, 'agni_slides_posttypeslider_padding_top', true ) );
                $posttypeslider_padding_bottom = esc_attr( get_post_meta( $post, 'agni_slides_posttypeslider_padding_bottom', true ) );
                $posttypeslider_padding_right = esc_attr( get_post_meta( $post, 'agni_slides_posttypeslider_padding_right', true ) );
                $posttypeslider_padding_left = esc_attr( get_post_meta( $post, 'agni_slides_posttypeslider_padding_left', true ) );


                if( $posttypeslider_choice == '1' ){
                    $slider_height = 'data-fullscreen-height = 1';
                }
                else{
                    $slider_height = 'data-height="'.$posttypeslider_height.'" data-height-tab="'.$posttypeslider_height_tab.'" data-height-mobile="'.$posttypeslider_height_mobile.'"';
                }
                
                if( $posttypeslider_parallax == 'on' && $shortcode == false ){
                    $slide_parallax = 'data-0="'.$posttypeslider_parallax_start.'" data-1500="'.$posttypeslider_parallax_end.'"';
                }

                if( $shortcode == true ){
                    $posttypeslider_fullwidth_container = '-fluid';
                }
                $posttypeslider_carousel = 'data-slider-992-items="1" data-slider-768-items="1" data-slider-0-items="1" data-slider-carousel-margin="0"';

                if( !empty($posttypeslider_animation) ){
                        $posttypeslider_has_animation = 'has-slide-content-animation';
                        $posttypeslider_animation_delay_amount = 0;
                }

                if ( $posttypeslider_overlay_choice != '4' ){
                    if( $posttypeslider_overlay_choice == '3' ){
                        wp_enqueue_script( 'halena-gradientmap-script' );
                        $posttypeslider_overlay = '<div class="agni-slide-bg-overlay agni-gradient-map-overlay gradient-map-overlay overlay" data-gm="'.$posttypeslider_bg_gm_overlay_color1.','.$posttypeslider_bg_gm_overlay_color2.','.$posttypeslider_bg_gm_overlay_color3.' " style="background-image:url('.$posttypeslider_bg_image.'); background-repeat:'.$posttypeslider_bg_image_repeat.'; background-position:'.$posttypeslider_bg_image_position.'; background-size:'.$posttypeslider_bg_image_size.'; "></div>';
                    }
                    elseif ( $posttypeslider_overlay_choice == '2' ) {
                        $posttypeslider_overlay = '<div class="agni-slide-bg-overlay overlay" style="'.$posttypeslider_bg_sg_overlay_css.';"></div>';
                    }
                    else{
                        $posttypeslider_overlay = '<div class="agni-slide-bg-overlay overlay" style="background-color:'.$posttypeslider_overlay_color.';"></div>';
                    }
                }

                if( $posttypeslider_bg_particle_ground == 'on' ){
                    wp_enqueue_script( 'halena-particleground-script' );
                    $posttypeslider_bg_particle_ground_color = ( $posttypeslider_bg_particle_ground_color != '' ) ? $posttypeslider_bg_particle_ground_color : 'rgba(255,255,255,0.2)';
                    $posttypeslider_particle_ground = '<div class="particles" data-color="'.$posttypeslider_bg_particle_ground_color.'"></div>';
                } 

                $posttypeslider_padding .= 'padding-top:'.( preg_match( '/(px|em|\%|pt|cm)$/', $posttypeslider_padding_top ) ? $posttypeslider_padding_top : $posttypeslider_padding_top . 'px' ).';';
                $posttypeslider_padding .= 'padding-bottom:'.( preg_match( '/(px|em|\%|pt|cm)$/', $posttypeslider_padding_bottom ) ? $posttypeslider_padding_bottom : $posttypeslider_padding_bottom . 'px' ).';';
                $posttypeslider_padding .= 'padding-right:'.( preg_match( '/(px|em|\%|pt|cm)$/', $posttypeslider_padding_right ) ? $posttypeslider_padding_right : $posttypeslider_padding_right . 'px' ).';';
                $posttypeslider_padding .= 'padding-left:'.( preg_match( '/(px|em|\%|pt|cm)$/', $posttypeslider_padding_left ) ? $posttypeslider_padding_left : $posttypeslider_padding_left . 'px' ).';';
            
                $include_ids = (!empty($posttypeslider_posts_in))?explode( ',', $posttypeslider_posts_in ):'';
                $exclude_ids = (!empty($posttypeslider_posts_not_in))?explode( ',', $posttypeslider_posts_not_in ):'';
                
                if( $posttypeslider_posttype_choice == 'post' ){
                    if ( $posttypeslider_blog_categories && ! is_wp_error( $posttypeslider_blog_categories ) ){
                        foreach ( $posttypeslider_blog_categories as $blog_category ) {
                            $blog_categories[] = $blog_category->slug;
                        }
                        $blog_categories = join( ", ", $blog_categories );
                    }
                    $args = array(           
                        'posts_per_page' => $posttypeslider_items_per_page,
                        'order' => $posttypeslider_items_order,
                        'orderby' => $posttypeslider_items_orderby,
                        'post__in'   => $include_ids, 
                        'post__not_in'   => $exclude_ids, 
                        'category_name'  => $blog_categories,
                    ); 
                }
                else if( $posttypeslider_posttype_choice == 'portfolio' ){
                    if ( $posttypeslider_portfolio_categories && ! is_wp_error( $posttypeslider_portfolio_categories ) ){
                        foreach ( $posttypeslider_portfolio_categories as $portfolio_category ) {
                            $portfolio_categories[] = $portfolio_category->slug;
                        }
                    }
                    if ( !empty( $portfolio_categories ) ) {            
                        $tax_args = array( array(
                            'taxonomy' => 'types',
                            'field' => 'term_id',
                            'terms' =>  $portfolio_categories
                        ) );
                    }
                    $args = array(          
                        'post_type' => $posttypeslider_posttype_choice,            
                        'posts_per_page' => $posttypeslider_items_per_page,
                        'order' => $posttypeslider_items_order,
                        'orderby' => $posttypeslider_items_orderby,
                        'post__in'   => $include_ids, 
                        'post__not_in'   => $exclude_ids, 
                        'tax_query' => $tax_args,
                    ); 
                }
                $posttypeslider_query = new WP_Query( $args );

                if ( $posttypeslider_query->have_posts() ) : 
                    while ( $posttypeslider_query->have_posts() ) : $posttypeslider_query->the_post();
                        $posttypeslider_categories = wp_kses( agni_framework_post_cat(), array( 'span' => array( 'class' => array() ), 'a' => array( 'href' => array(), 'rel' => array() ) ) );
                        $posttypeslider_title = esc_attr( get_the_title() );
                        $posttypeslider_bg_image = esc_url( get_the_post_thumbnail_url() );
                        $posttypeslider_button1_url = esc_url( get_permalink() );

                        $posttypeslider_bg = '<div class="agni-slide-bg agni-slide-bg-image" style="background-image:url('.$posttypeslider_bg_image.'); background-repeat:'.$posttypeslider_bg_image_repeat.'; background-position:'.$posttypeslider_bg_image_position.'; background-size:'.$posttypeslider_bg_image_size.'; "></div>';

                        if ( !empty($posttypeslider_categories) ){
                            if( $posttypeslider_has_animation == 'has-slide-content-animation'){
                                $posttypeslider_animation_delay = ' -webkit-animation-delay: '.$posttypeslider_animation_delay_amount.'ms; animation-delay: '.$posttypeslider_animation_delay_amount.'ms;';
                                $posttypeslider_animation_delay_amount += 250;
                            }

                            $posttypeslider_categories = '<div class="agni-slide-meta '.$posttypeslider_animation.' '.$posttypeslider_categories_font.'" style="font-size:'.$posttypeslider_categories_size.'px; color:'.$posttypeslider_categories_color.'; '.$posttypeslider_animation_delay.'">'.$posttypeslider_categories.'</div>';
                        }

                        if ( !empty($posttypeslider_title) ){
                            if( $posttypeslider_has_animation == 'has-slide-content-animation'){
                                $posttypeslider_animation_delay = ' -webkit-animation-delay: '.$posttypeslider_animation_delay_amount.'ms; animation-delay: '.$posttypeslider_animation_delay_amount.'ms;';
                                $posttypeslider_animation_delay_amount += 250;
                            }

                            $posttypeslider_title = '<div class="agni-slide-title '.$posttypeslider_animation.' '.$posttypeslider_title_font.'" style="font-size:'.$posttypeslider_title_size.'px; color:'.$posttypeslider_title_color.'; '.$posttypeslider_animation_delay.'"><h2>'.$posttypeslider_title.'</h2></div>';
                        }

                        if( !empty($posttypeslider_button1) ){

                            if( !empty($posttypeslider_button1_radius) ){
                                $posttypeslider_button1_css = 'style="border-radius:'.( preg_match( '/(px|em|\%|pt|cm)$/', $posttypeslider_button1_radius ) ? $posttypeslider_button1_radius : $posttypeslider_button1_radius . 'px' ).';"';
                            }

                            if( $posttypeslider_has_animation == 'has-slide-content-animation'){
                                $posttypeslider_animation_delay = 'style="-webkit-animation-delay: '.$posttypeslider_animation_delay_amount.'ms; animation-delay: '.$posttypeslider_animation_delay_amount.'ms;"';
                                $posttypeslider_animation_delay_amount += 250;
                            }
                            $posttypeslider_buttons = '<div class="agni-slide-btn-container agni-slide-btn-1 page-scroll '.$posttypeslider_animation.'" '.$posttypeslider_animation_delay.'><a class="btn btn-'.$posttypeslider_button1_style.' '.$posttypeslider_button1_type.'" href="'.$posttypeslider_button1_url.'" target="'.$posttypeslider_button1_target.'" '.$posttypeslider_button1_css.'>'.$posttypeslider_button1.'</a></div>';

                        }
                        
                        if( !empty($posttypeslider_buttons) ){
                            $posttypeslider_buttons = '<div class="agni-slide-buttons">'.$posttypeslider_buttons.'</div>';
                        } 

                        $output .= '<div class="agni-slide '.$posttypeslider_has_animation.'" '.$slide_parallax.'>
                        <div class="agni-slide-bg-container">'.$posttypeslider_bg.$posttypeslider_overlay.$posttypeslider_particle_ground.'</div>
                        <div class="agni-slide-content-container container'.$posttypeslider_fullwidth_container.' agni-slide-align-items-'.$posttypeslider_content_position.' agni-slide-justify-content-'.$posttypeslider_text_alignment.'">
                            <div class="agni-slide-content-inner page-scroll" style="'.$posttypeslider_padding.'">
                                '.$posttypeslider_categories.$posttypeslider_title.$posttypeslider_buttons.'
                            </div>
                        </div>
                    </div>';
                        
                    endwhile; 
                endif;

                // Reset Post Data
                wp_reset_postdata(); 

                $output = '<div id="agni-slider-'.$post.'" class="agni-slider agni-posttype-slider" '.$slider_height.' data-slider-choice="'.$posttypeslider_choice.'" data-slider-autoplay-timeout="'.$posttypeslider_transition_duration.'" data-slider-smart-speed="'.$posttypeslider_transition_speed.'" data-slider-mousedrag="'.$posttypeslider_mousedrag.'" data-slider-nav="'.$posttypeslider_navigation.'" data-slider-dots="'.$posttypeslider_pagination.'" data-slider-autoplay="'.$posttypeslider_autoplay.'" data-slider-loop="'.$posttypeslider_loop.'" data-slider-animate-in="'.$posttypeslider_animate_in.'" data-slider-animate-out="'.$posttypeslider_animate_out.'" '.$posttypeslider_carousel.' data-rtl="'.$rtl.'">'.$output.'</div>';
                
                return $output;
        }
    }
}

/**
 * TGM Plugin activation function
 */
function halena_register_required_plugins() {

    $plugins = array(
        
        array(
            'name'                  => 'Agni Halena', 
            'slug'                  => 'agni-halena-plugin', 
            'source'                => AGNI_FRAMEWORK_DIR . '/template/plugins/agni-halena-plugin.zip', 
            'required'              => true,
            'version'               => '1.1.4', 
            'force_activation'      => false,
            'force_deactivation'    => false,
            'external_url'      => '',
        ),
        
        array(
            'name'                  => 'WPBakery Visual Composer', 
            'slug'                  => 'js_composer', 
            'source'                => AGNI_FRAMEWORK_DIR . '/template/plugins/js_composer.zip', 
            'required'              => true,
            'version'               => '6.5.0', 
            'force_activation'      => false,
            'force_deactivation'    => false,
            'external_url'          => '',
        ),
        
        array(
            'name'                  => 'Revolution Slider', 
            'slug'                  => 'revslider', 
            'source'                => AGNI_FRAMEWORK_DIR . '/template/plugins/revslider.zip', 
            'required'              => false,
            'version'               => '6.3.4', 
            'force_activation'      => false,
            'force_deactivation'    => false,
            'external_url'          => esc_url( 'http://revolution.themepunch.com/' ),
        ),
        
        array(
            'name'                  => 'Contact Form 7', 
            'slug'                  => 'contact-form-7', 
            'source'                => '', 
            'required'              => false,
            'version'               => '5.0.1', 
            'force_activation'      => false,
            'force_deactivation'    => false, 
            'external_url'          => esc_url( 'https://wordpress.org/plugins/contact-form-7/' ),
        ),
        
        array(
            'name'                  => 'MailChimp for WordPress', 
            'slug'                  => 'mailchimp-for-wp', 
            'source'                => '', 
            'required'              => false,
            'version'               => '4.1.15', 
            'force_activation'      => false,
            'force_deactivation'    => false, 
            'external_url'          => esc_url( 'https://wordpress.org/plugins/mailchimp-for-wp/' ),
        ),
        array(
            'name'                  => 'WooCommerce', 
            'slug'                  => 'woocommerce', 
            'source'                => '',
            'required'              => false,
            'version'               => '3.5.2', 
            'force_activation'      => false,
            'force_deactivation'    => false, 
            'external_url'          => esc_url( 'https://wordpress.org/plugins/woocommerce/' ),
        ),
        array(
            'name'                  => 'YITH WooCommerce Wishlist', 
            'slug'                  => 'yith-woocommerce-wishlist', 
            'source'                => '',
            'required'              => false,
            'version'               => '3.0.17', 
            'force_activation'      => false,
            'force_deactivation'    => false, 
            'external_url'          => esc_url( 'https://wordpress.org/plugins/yith-woocommerce-wishlist/' ),
        ),
        array(
            'name'                  => 'Envato Market', 
            'slug'                  => 'envato-market', 
            'source'                => AGNI_FRAMEWORK_DIR . '/template/plugins/envato-market.zip', 
            'required'              => false,
            'version'               => '2.0.0', 
            'force_activation'      => false,
            'force_deactivation'    => false, 
            'external_url'          => esc_url( 'https://envato.github.io/wp-envato-market/' ),
        ),
        
    );

    $config = array(  
        'default_path' => '',                      // Default absolute path to bundled plugins.
        'menu'         => 'halena-install-plugins', // Menu slug.
        'parent_slug'  => 'halena',               // Parent menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                       
        'strings'           => array(
            'page_title'                                => esc_html__( 'Install Required Plugins', 'halena' ),
            'menu_title'                                => esc_html__( 'Install Plugins', 'halena' ),
            'installing'                                => esc_html__( 'Installing Plugin: %s', 'halena' ), // %1$s = plugin name
            'oops'                                      => esc_html__( 'Something went wrong with the plugin API.', 'halena' ),
            'notice_can_install_required'               => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'halena' ), // %1$s = plugin name(s)
            'notice_can_install_recommended'            => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'halena' ), // %1$s = plugin name(s)
            'notice_cannot_install'                     => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'halena' ), // %1$s = plugin name(s)
            'notice_can_activate_required'              => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'halena' ), // %1$s = plugin name(s)
            'notice_can_activate_recommended'           => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'halena' ), // %1$s = plugin name(s)
            'notice_cannot_activate'                    => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'halena' ), // %1$s = plugin name(s)
            'notice_ask_to_update'                      => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'halena' ), // %1$s = plugin name(s)
            'notice_cannot_update'                      => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'halena' ), // %1$s = plugin name(s)
            'install_link'                              => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'halena' ),
            'activate_link'                             => _n_noop( 'Activate installed plugin', 'Activate installed plugins', 'halena' ),
            'return'                                    => esc_html__( 'Return to Required Plugins Installer', 'halena' ),
            'plugin_activated'                          => esc_html__( 'Plugin activated successfully.', 'halena' ),
            'complete'                                  => esc_html__( 'All plugins installed and activated successfully. %s', 'halena' ), // %1$s = dashboard link
            'nag_type'                                  => 'updated' // Determines admin notice type - can only be 'updated' or 'error'
        )
    );

    tgmpa( $plugins, $config );

}
add_action( 'tgmpa_register', 'halena_register_required_plugins' );
