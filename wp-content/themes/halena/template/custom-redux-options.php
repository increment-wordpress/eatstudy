<?php
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }


    // This is your option name where all the Redux data is stored.
    $opt_name = "halena_options";

    
    /*
     * Adding redux admin css
     */
    function agni_redux_admin_scripts(){
        wp_dequeue_style( 'redux-admin-css' );
        wp_enqueue_style( 'agni-redux-css', AGNI_THEME_FILES_URL . '/assets/css/redux-admin.css' );
        if( is_rtl() ){
            wp_dequeue_style( 'redux-rtl-css' );
            wp_enqueue_style( 'agni-redux-rtl-css', AGNI_THEME_FILES_URL . '/assets/css/redux-admin-rtl.css' );
        }
    }
    add_action( "redux/page/{$opt_name}/enqueue", 'agni_redux_admin_scripts' );

    function agni_redux_custom_fonts( $font_array ) {
        // Custom Font list
        $custom_font_list = $font_list = array();
        $upload_dir = wp_upload_dir();
        $custom_dirname = 'agni-fonts';
        $file_dirname = $upload_dir['basedir'].'/'.$custom_dirname;
        
         if( is_dir($file_dirname) ){
            if ($handle = opendir($file_dirname)) {
                $blacklist = array('.', '..', '.DS_Store');
                while (false !== ($file = readdir($handle))) {
                    if (!in_array($file, $blacklist)) {
                        $font_list[$file] = $file;
                    }
                }
                closedir($handle);
            }
        }

        // Typekit font list
        $agni_typekit_options = get_option( 'agni_typekit_options' );
        $kit = $agni_typekit_options['agni_typekit_id'];
        if( !empty($agni_typekit_options['agni_typekit_id']) ){
            global $wp_filesystem;
            if (empty($wp_filesystem)) {
                require_once (ABSPATH . '/wp-admin/includes/file.php');
                WP_Filesystem();
            }
            $json = wp_remote_get( 'https://typekit.com/api/v1/json/kits/' . $kit . '/published' );
            
            $kits = json_decode( $json['body'] );
            $fonts = array();
            foreach ($kits->kit->families AS $fontFamily){
                $font_list[$fontFamily->name] = $fontFamily->slug;
            }
        }
        // Store in array
        if( !empty($font_list) ){
            $font_array = array(
                'Custom & Typekit Fonts' => $font_list,
            );
        }
        return $font_array;
    }
    add_filter( "redux/{$opt_name}/field/typography/custom_fonts", 'agni_redux_custom_fonts' );
    /* 
     * Remove redux menu under the tools 
     */
    function remove_redux_menu() {
        remove_submenu_page('tools.php','redux-about');
    }
    add_action( 'admin_menu', 'remove_redux_menu', 12 );

    /*
     * Adding extension added additionally for demo import
     */

    if(!function_exists('redux_register_custom_extension_loader')) :
        function redux_register_custom_extension_loader($ReduxFramework) {
            //$path = ABSPATH . 'wp-content/plugins/agni-halena-plugin/inc/extensions/';
            $path = WP_PLUGIN_DIR . '/agni-halena-plugin/inc/extensions/';
            $folders = scandir( $path, 1 );        
            foreach($folders as $folder) {
                if ($folder === '.' or $folder === '..' or !is_dir($path . $folder) ) {
                    continue;   
                } 
                $extension_class = 'ReduxFramework_Extension_' . $folder;
                if( !class_exists( $extension_class ) ) {
                    // In case you wanted override your override, hah.
                    $class_file = $path . $folder . '/extension_' . $folder . '.php';
                    $class_file = apply_filters( 'redux/extension/'.$ReduxFramework->args['opt_name'].'/'.$folder, $class_file );
                    if( $class_file ) {
                        require_once( $class_file );
                        $extension = new $extension_class( $ReduxFramework );
                    }
                }
            }
        }
        // Modify {$redux_opt_name} to match your opt_name
        add_action("redux/extensions/{$opt_name}/before", 'redux_register_custom_extension_loader', 0);
    endif;

    /*
     *
     * --> Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
     *
     */

    $sampleHTML = '';
    if ( file_exists( get_template_directory() . '/info-html.html' ) ) {
        Redux_Functions::initWpFilesystem();

        global $wp_filesystem;

        $sampleHTML = $wp_filesystem->get_contents( get_template_directory() . '/info-html.html' );
    }

    $theme = wp_get_theme(); // For use with some settings. Not necessary.
    
    $args = array(
        'opt_name' => 'halena_options',
        'display_name' => $theme->get('Name'),
        'display_version' => $theme->get('Version'),
        'page_slug' => 'halena-theme-options',
        'page_title' => esc_html__('Theme Options', 'halena'),
        'update_notice' => TRUE,
        'admin_bar' => TRUE,
        'menu_type' => 'submenu',
        'menu_title' => esc_html__('Theme Options', 'halena'),
        'menu_icon' => AGNI_FRAMEWORK_URL  . '/img/halena_options.png',
        'allow_sub_menu' => TRUE,
        'page_parent' => 'halena',
        'page_parent_post_type' => 'your_post_type',
        'page_priority' => '59',
        'customizer' => FALSE,
        'default_mark' => '*',
        'footer_credit'     => '',
        'output' => TRUE,
        'output_tag' => TRUE,
        'settings_api' => TRUE,
        'page_permissions' => 'edit_theme_options',
        'save_defaults' => TRUE,
        'show_import_export' => TRUE,
        'transient_time' => '3600',
        'network_sites' => TRUE,
        'dev_mode' => FALSE,
        'hints' => array(
            'icon' => 'el el-bulb',
            'icon_position' => 'right',
            'icon_color' => '#333333',
            'icon_size' => 'normal',
            'tip_style' => array(
                'color' => 'light',
            ),
            'tip_position' => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect' => array(
                'show' => array(
                    'duration' => '500',
                    'event' => 'mouseover',
                ),
                'hide' => array(
                    'duration' => '500',
                    'event' => 'mouseleave unfocus',
                ),
            ),
        ),
    );

    // ADMIN BAR LINKS -> Setup custom links in the admin bar menu as external items.
    $args['admin_bar_links'][] = array(
        'id'    => 'redux-docs',
        'href'  => esc_url( 'http://docs.reduxframework.com/' ),
        'title' => esc_html__( 'Documentation', 'halena' ),
    );

    $args['admin_bar_links'][] = array(
        //'id'    => 'redux-support',
        'href'  => 'http://github.com/ReduxFramework/redux-framework/issues',
        'title' => esc_html__( 'Support', 'halena' ),
    );

    $args['admin_bar_links'][] = array(
        'id'    => 'redux-extensions',
        'href'  => 'reduxframework.com/extensions',
        'title' => esc_html__( 'Extensions', 'halena' ),
    );

    // Panel Intro text -> before the form
   
    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */


    /*
     * ---> START HELP TABS
     */

    $tabs = array(
        array(
            'id'      => 'redux-help-tab-1',
            'title'   => esc_html__( 'Theme Information 1', 'halena' ),
            'content' => esc_html__( 'This is the tab content, HTML is allowed.', 'halena' )
        ),
        array(
            'id'      => 'redux-help-tab-2',
            'title'   => esc_html__( 'Theme Information 2', 'halena' ),
            'content' => esc_html__( 'This is the tab content, HTML is allowed.', 'halena' )
        )
    );
    Redux::setHelpTab( $opt_name, $tabs );

    // Set the help sidebar
    $content = esc_html__( 'This is the sidebar content, HTML is allowed.', 'halena' );
    Redux::setHelpSidebar( $opt_name, $content );


    /*
     * <--- END HELP TABS
     */


    /*
     *
     * ---> START SECTIONS
     *
     */

    /*

        As of Redux 3.5+, there is an extensive API. This API can be used in a mix/match mode allowing for


     */

    
    // -> START Basic Fields
    Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Home Settings', 'halena' ),
        'id'    => 'home-settings',
        'icon'  => 'el el-home'
    ) );
    
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'General', 'halena' ),
        'id'         => 'home-general-options',
        'subsection' => true,
        'desc'       => esc_html__( 'The following options will allow you to set body background, logo, etc.', 'halena' ),
        'fields' => array(
            
            array(
                'id' => 'body-background',
                'type' => 'background',
                'output' => array('body, .content'),
                'title' => esc_html__('Body Background', 'halena'),
                'subtitle' => esc_html__('Body background with image, color, etc.', 'halena'),
                //'default' => array( 'background-color' => '#fbfbfb', ),
            ),
            array(
                'id' => 'dark-mode',
                'type' => 'switch',
                'title' => esc_html__('Dark Mode', 'halena'),
                'subtitle' => esc_html__('Enable this to display adapt the theme for darker skin.', 'halena'),
                'default' => '0'
            ),
            array(
                'id' => 'color-1',
                'type' => 'color',
                'transparent' => false,
                'output' => array(  ), 
                'title' => esc_html__('Accent color', 'halena'),
                'default' => '',
                'validate' => 'color',
                'hint'     => array(
                    'title'   => 'Highlighting Lines',
                    'content' => esc_html__('It applies the color to element borders/lines, heading underlines.', 'halena'),
                )
            ),
            
            array(
                'id' => 'color-2',
                'type' => 'color',
                'transparent' => false,
                'output' => array(  ),
                'title' => esc_html__('Primary color', 'halena'),
                'default' => '',
                'validate' => 'color',
                'hint'     => array(
                    'title'   => 'Main color',
                    'content' => esc_html__('It applies the color to H tags & buttons', 'halena'),
                )
            ),
            array(
                'id' => 'color-3',
                'type' => 'color',
                'transparent' => false,
                'output' => array(  ),
                'title' => esc_html__('Default color', 'halena'),
                'default' => '',
                'validate' => 'color',
                'hint'     => array(
                    'title'   => 'Body color',
                    'content' => esc_html__('It applies the color to body content & button this is a basic color for all text.', 'halena'),
                )
            ),
        ),
    ));

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Typography', 'halena' ),
        'id'         => 'home-typography-options',
        'subsection' => true,
        'desc'       => esc_html__( 'The following options will allow you to set body background, logo, etc.', 'halena' ),
        'fields' => array(
            array(
                'id' => 'font-1',
                'type' => 'typography',
                'title' => esc_html__('H Tags Font(Primary)', 'halena'),
                'google' => true, // Disable google fonts. Won't work if you haven't defined your google api key
                //'fonts' => $font_list,
                //'font-weight' => false,
                //'font-style' => false,
                //'subsets' => false,
                'font-backup' => true, // Select a backup non-google font in addition to a google font
                'font-size'=> false,
                'line-height'=> false,
                'letter-spacing'=> true, // Defaults to false
                'color'=> false,
                'text-align' => false,
                'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                'output' => array('h1, h2, h3, h4, h5, h6,.h1,.h2,.h3,.h4,.h5,.h6, .primary-typo, .vc_tta-title-text'), // An array of CSS selectors to apply this font style to dynamically
                'units' => 'em', // Defaults to px
                'subtitle' => esc_html__('This options applies to Heading tags', 'halena'),
                'desc' => esc_html__('Font weight & style may not be applicable/shown for Custom & typekit Fonts(if any). For those cases, you\'ve to add custom css manually.' , 'halena'),
                'preview' => false,
                'default' => array(
                    'font-family' => '',
                    'font-backup' => '',
                    'google' => true,),
            ),
            array(
                'id' => 'font-h1-fontsize',
                'type' => 'text',
                'title' => esc_html__('H1 Font Size', 'halena'),
                'desc' => esc_html__( 'Font size in px. Do not enter "px"', 'halena' ),
                'default' => '48',
                'class' => 'text',
                'validate' => 'numeric',
            ),
            array(
                'id' => 'font-h2-fontsize',
                'type' => 'text',
                'title' => esc_html__('H2 Font Size', 'halena'),
                'default' => '40',
                'class' => 'text',
                'validate' => 'numeric',
            ),
            array(
                'id' => 'font-h3-fontsize',
                'type' => 'text',
                'title' => esc_html__('H3 Font Size', 'halena'),
                'default' => '34',
                'class' => 'text',
                'validate' => 'numeric',
            ),
            array(
                'id' => 'font-h4-fontsize',
                'type' => 'text',
                'title' => esc_html__('H4 Font Size', 'halena'),
                'default' => '28',
                'class' => 'text',
                'validate' => 'numeric',
            ),
            array(
                'id' => 'font-h5-fontsize',
                'type' => 'text',
                'title' => esc_html__('H5 Font Size', 'halena'),
                'default' => '24',
                'class' => 'text',
                'validate' => 'numeric',
            ),
            array(
                'id' => 'font-h6-fontsize',
                'type' => 'text',
                'title' => esc_html__('H6 Font Size', 'halena'),
                'default' => '20',
                'class' => 'text',
                'validate' => 'numeric',
            ),
            array(
                'id' => 'font-1-lineheight',
                'type' => 'text',
                'title' => esc_html__('H Tag Line Height', 'halena'),
                'default' => '',
            ),
            array(
                'id' => 'font-1-text-transform',
                'type'     => 'select',
                'title'    => esc_html__( 'Text Transform', 'halena' ),
                'options'  => array(
                    'none' => 'None',
                    'uppercase' => 'Uppercase',
                    'lowercase' => 'Lowercase',
                    'capitalize' => 'Capitalize',
                ),
                'default'  => 'none'
            ),
            array(
                'id' => 'font-2',
                'type' => 'typography',
                'title' => esc_html__('Additional Heading Font(Additional)', 'halena'),
                'google' => true, // Disable google fonts. Won't work if you haven't defined your google api key
                //'fonts' => $font_list,
                'font-backup' => true, // Select a backup non-google font in addition to a google font
                'font-size'=>false,
                'line-height'=>false,
                'letter-spacing'=>true, // Defaults to false
                'color'=>false,
                'text-align' => false,
                'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                'output' => array('.section-sub-heading-text, .additional-typo'), // An array of CSS selectors to apply this font style to dynamically
                'units' => 'em', // Defaults to px
                'subtitle' => esc_html__('This will apply to all additional heading content which is inside section heading shortcode element.', 'halena'),
                'desc' => esc_html__('Font weight & style may not be applicable for Custom Fonts(if any).', 'halena'),
                'preview' => false,
                'default' => array(
                    'font-family' => '',
                    'font-backup' => '',
                    'google' => true,),
            ),
            array(
                'id' => 'font-2-lineheight',
                'type' => 'text',
                'title' => esc_html__('Additional Heading Line Height', 'halena'),
                'default' => '',
            ),
            array(
                'id' => 'font-2-text-transform',
                'type'     => 'select',
                'title'    => esc_html__( 'Text Transform', 'halena' ),
                'options'  => array(
                    'none' => 'None',
                    'uppercase' => 'Uppercase',
                    'lowercase' => 'Lowercase',
                    'capitalize' => 'Capitalize',
                ),
                'default'  => 'none'
            ),
            array(
                'id' => 'font-3',
                'type' => 'typography',
                'title' => esc_html__('Body Font(Default)', 'halena'),
                'google' => true, // Disable google fonts. Won't work if you haven't defined your google api key
                //'fonts' => $font_list,
                'font-backup' => true, // Select a backup non-google font in addition to a google font
                'font-size'=> false,
                'line-height'=> false,
                'letter-spacing'=> true, // Defaults to false
                'color'=> false,
                'text-align' => false,
                'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                'output' => array('body, .default-typo'), // An array of CSS selectors to apply this font style to dynamically
                'units' => 'em', // Defaults to px
                'subtitle' => esc_html__('This is a base/default font for all body content.', 'halena'),
                'desc' => esc_html__('Font weight & style may not be applicable for Custom Fonts(if any).', 'halena'),
                'preview' => false,
                'default' => array(
                    'font-family' => '',
                    'font-backup' => '',
                    'font-size' => '',
                    'google' => true,),
            ),
            array(
                'id' => 'font-3-fontsize',
                'type' => 'text',
                'title' => esc_html__('Body Font Size', 'halena'),
                'default' => '16',
                'class' => 'text',
                'validate' => 'numeric',
            ),
            array(
                'id' => 'font-3-lineheight',
                'type' => 'text',
                'title' => esc_html__('Body Line Height', 'halena'),
                'default' => '',
            ),
            array(
                'id' => 'font-3-text-transform',
                'type'     => 'select',
                'title'    => esc_html__( 'Text Transform', 'halena' ),
                'options'  => array(
                    'none' => 'None',
                    'uppercase' => 'Uppercase',
                    'lowercase' => 'Lowercase',
                    'capitalize' => 'Capitalize',
                ),
                'default'  => 'none'
            ),

            array(
                'id' => 'font-4',
                'type' => 'typography',
                'title' => esc_html__('Special Font', 'halena'),
                'google' => true, // Disable google fonts. Won't work if you haven't defined your google api key
                //'fonts' => $font_list,
                'font-backup' => true, // Select a backup non-google font in addition to a google font
                'font-size'=> false,
                'line-height'=> false,
                'letter-spacing'=> true, // Defaults to false
                'color'=> false,
                'text-align' => false,
                'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                'output' => array('.special-typo'), // An array of CSS selectors to apply this font style to dynamically
                'units' => 'em', // Defaults to px
                'subtitle' => esc_html__('This is a base/default font for all body content.', 'halena'),
                'desc' => esc_html__('Font weight & style may not be applicable for Custom Fonts(if any).', 'halena'),
                'preview' => false,
                'default' => array(
                    'font-family' => '',
                    'font-backup' => '',
                    'font-size' => '',
                    'google' => true,),
            ),
            array(
                'id' => 'font-4-lineheight',
                'type' => 'text',
                'title' => esc_html__('Special Font Line Height', 'halena'),
                'default' => '',
            ),
            array(
                'id' => 'font-4-text-transform',
                'type'     => 'select',
                'title'    => esc_html__( 'Text Transform', 'halena' ),
                'options'  => array(
                    'none' => 'None',
                    'uppercase' => 'Uppercase',
                    'lowercase' => 'Lowercase',
                    'capitalize' => 'Capitalize',
                ),
                'default'  => 'none'
            ),

            array(
                'id' => 'google-font-additional',
                'type' => 'text',
                'title' => esc_html__('Additional Google Fonts', 'halena'),
                'subtitle' => esc_html__('You can add all necessary fonts here by adding standard embed code.', 'halena'),
                'desc' => wp_kses(__('Go to <a href="https://fonts.google.com/">Google Fonts</a> choose your desired font families and add the here. Then add CSS at Custom Coding tab.', 'halena'), array( 'a' => array( 'href' => array() ), 'strong' => array() ) ),
                'default' => '',
                'placeholder' => 'Catamaran|Playfair+Display'
            ),

        )

    ) );

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Layout', 'halena' ),
        'id'         => 'home-layout-options',
        'subsection' => true,
        'desc'       => esc_html__( 'Here, you can setup site layout options.', 'halena' ),
        'fields' => array(

            array(
                'id' => 'layout-padding',
                'type' => 'switch',
                'title' => esc_html__('Content Padding/Border', 'halena'),
                'subtitle' => esc_html__('Enable this to display border/padding around the content/layout of the site.', 'halena'),
                'default' => '0'
            ),
            array(
                'id'       => 'layout-padding-size',
                'type'     => 'border',
                'required' => array('layout-padding', '=', '1'),
                'title'    => esc_html__( 'Amount of pixels', 'halena' ),
                'subtitle' => esc_html__( 'It will display the border above & below to the menu items.', 'halena' ),
                'all'      => true,
                'style' => false,
                // An array of CSS selectors to apply this font style to
                'desc'     => esc_html__( 'This is the description field, again good for additional info.', 'halena' ),
                'default'  => array(
                    'border-color'  => '#fff',
                    'border-top'    => '30px', 
                    'border-width' => '30px',
                )
            ),

            array(
                'id' => 'layout-container',
                'type' => 'switch',
                'title' => esc_html__('Container Settings', 'halena'),
                'subtitle' => esc_html__('By Enabling this you can controls the container width on each break point.', 'halena'),
                'default' => '0'
            ),
            array(
                'id' => 'layout-container-768',
                'type' => 'slider',
                'required' => array('layout-container', '=', '1'),
                'title' => esc_html__('Container Width >768', 'halena'),
                'desc' => esc_html__('this container width apply when viewport width is more than 768px.', 'halena'),
                "default" => "750",
                "min" => "360",
                "step" => "5",
                "max" => "750",
            ),
            array(
                'id' => 'layout-container-992',
                'type' => 'slider',
                'required' => array('layout-container', '=', '1'),
                'title' => esc_html__('Container Width >992', 'halena'),
                "default" => "970",
                "min" => "480",
                "step" => "5",
                "max" => "970",
            ),
            array(
                'id' => 'layout-container-1200',
                'type' => 'slider',
                'required' => array('layout-container', '=', '1'),
                'title' => esc_html__('Container Width >1200', 'halena'),
                "default" => "1170",
                "min" => "600",
                "step" => "5",
                "max" => "1170",
            ),
            array(
                'id' => 'layout-container-1500',
                'type' => 'slider',
                'required' => array('layout-container', '=', '1'),
                'title' => esc_html__('Container Width >1500', 'halena'),
                "default" => "1170",
                "min" => "720",
                "step" => "5",
                "max" => "1470",
            ),
            array(
                'id'             => 'layout-container-padding',
                'type'           => 'spacing',
                'required' => array('layout-container', '=', '1'),
                // An array of CSS selectors to apply this font style to
                'mode'           => 'padding',
                // absolute, padding, margin, defaults to padding
                'all'            => false,
                // Have one field that applies to all
                'top'           => false,     // Disable the top
                'bottom'        => false,     // Disable the bottom
                'units'          => array( 'em', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
                'units_extended' => 'true',    // Allow users to select any type of unit
                'title'          => esc_html__( 'Container inner Padding', 'halena' ),
                'subtitle'       => esc_html__( 'Here, you can set padding to the container.', 'halena' ),
                'default'        => array(
                    'padding-left'    => '15px',
                    'padding-right' => '15px',
                ),
                'output'         => array( '.container' )
            ),

            array(
                'id' => 'layout-boxed',
                'type' => 'switch',
                'title' => esc_html__('Boxed Layout', 'halena'),
                'subtitle' => esc_html__('Enable this to display all the content inside the box', 'halena'),
                'default' => '0'
            ),
            array(
                'id' => 'layout-boxed-768',
                'type' => 'slider',
                'required' => array('layout-boxed', '=', '1'),
                'title' => esc_html__('Box Width >768', 'halena'),
                'desc' => esc_html__('this container width apply when viewport width is more than 768px.', 'halena'),
                "default" => "750",
                "min" => "500",
                "step" => "5",
                "max" => "750",
            ),
            array(
                'id' => 'layout-boxed-992',
                'type' => 'slider',
                'required' => array('layout-boxed', '=', '1'),
                'title' => esc_html__('Box Width >992', 'halena'),
                "default" => "970",
                "min" => "650",
                "step" => "5",
                "max" => "970",
            ),
            array(
                'id' => 'layout-boxed-1200',
                'type' => 'slider',
                'required' => array('layout-boxed', '=', '1'),
                'title' => esc_html__('Box Width >1200', 'halena'),
                "default" => "1170",
                "min" => "800",
                "step" => "5",
                "max" => "1170",
            ),
            array(
                'id' => 'layout-boxed-1500',
                'type' => 'slider',
                'required' => array('layout-boxed', '=', '1'),
                'title' => esc_html__('Box Width >1500', 'halena'),
                "default" => "1170",
                "min" => "1000",
                "step" => "5",
                "max" => "1470",
            ),
            array(
                'id' => 'boxed-background-color',
                'type' => 'color',
                'required' => array('layout-boxed', '=', '1'),
                'transparent' => false,
                'mode' => 'background',
                'output' => array( '.boxed' ), 
                'title' => esc_html__('Boxed background color', 'halena'),
                'default' => '',
                'validate' => 'color',
            ),

        )

    ) );

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Additional', 'halena' ),
        'id'         => 'home-additional-options',
        'subsection' => true,
        'desc'       => esc_html__( 'Some additional options to control preloader, back to top.', 'halena' ),
        'fields' => array(

            array(
                'id' => 'page-agni-block-popup',
                'type' => 'select',
                'title' => esc_html__('Content Block for Popup', 'halena'),
                'options' => agni_posttype_options( array( 'post_type' => 'agni_block'), false ), //Must provide key => value pairs for select options
                'default' => '',
            ),

            array(
                'id'       => 'page-agni-shortnote',
                'type'     => 'text',
                'title'    => esc_html__('Fixed Short note', 'halena'),
                'subtitle' => esc_html__('You can display the offer & shipping information or any kind of notice you would like to show the visitors', 'halena'),
                'desc'     => esc_html__('for ex. Express delivery for shopping more than $300 & Free shipping all over the world!', 'halena'),
                'default'  => '',
            ),
            array(
                'id' => 'loader',
                'type' => 'switch',
                'title' => esc_html__('PreLoader', 'halena'),
                'subtitle' => esc_html__('Just enable this to show the preloader', 'halena'),
                'default' => ''
            ),
            array(
                'id' => 'loader-style',
                'type' => 'image_select',
                'required' => array('loader', '=', '1'),
                'title' => esc_html__('PreLoader Style', 'halena'),
                'options' => array(                            
                    //'1' => array('alt' => 'Loader With Percentage', 'img' => AGNI_FRAMEWORK_URL . '/template/img/preloader-1.png'),
                    '2' => array('alt' => 'Static Loader 1', 'img' => AGNI_FRAMEWORK_URL . '/template/img/preloader-2.png'),
                    '3' => array('alt' => 'Static Loader 2', 'img' => AGNI_FRAMEWORK_URL . '/template/img/preloader-3.png'),
                ), //Must provide key => value(array:title|img) pairs for radio options
                'default' => '1'
            ),
            array(
                'id' => 'loader-bg-color',
                'type' => 'color',
                'required' => array('loader', '=', '1'),
                'transparent' => false,
                'output' => array( '.preloader .preloader-container' ), 
                'mode' => 'background',
                'title' => esc_html__('Loader BG color ', 'halena'),
                'default' => '#ffffff',
                'validate' => 'color',
            ),
            array(
                'id' => 'loader-color',
                'type' => 'color',
                'required' => array('loader', '=', '1'),
                'transparent' => false,
                'output' => array( '#jpreBar, #jpreButton, .preloader-style-2 .cssload-loader, .preloader-style-3 .cssload-front' ), 
                'mode' => 'background',
                'title' => esc_html__('Loader color ', 'halena'),
                'subtitle' => esc_html__('Pick the preloader color.', 'halena'),
                'default' => '#1e1e20',
                'validate' => 'color',
            ),
            array(
                'id' => 'loader-back-color',
                'type' => 'color',
                'required' => array('loader-style', '=', '3'),
                'transparent' => false,
                'output' => array( '.preloader-style-3 .cssload-back' ), 
                'mode' => 'background',
                'title' => esc_html__('Loader color ', 'halena'),
                'subtitle' => esc_html__('Pick the preloader back color.', 'halena'),
                'default' => '#333333',
                'validate' => 'color',
            ),
            /*array(
                'id'       => 'loader-close',
                'type'     => 'checkbox',
                'required' => array('loader-style', '=', '1'),
                'title'    => esc_html__( 'Loader Close Button', 'halena' ),
                'subtitle' => esc_html__( 'Once everything is loaded, It will wait for your command.', 'halena' ),
                'default'  => '0'// 1 = on | 0 = off
            ),
            array(
                'id' => 'loader-close-button-text',
                'type' => 'text',
                'required' => array('loader-close', '=', '1'),
                'title' => esc_html__('Loader Close Button', 'halena'),
                'default' => 'Proceed!',
                'class' => 'text'
            ),*/
            
            array(
                'id' => 'backtotop',
                'type' => 'switch',
                'title' => esc_html__('Back to top', 'halena'),
                'subtitle' => esc_html__('Just enable this to show the preloader', 'halena'),
                'default' => '1'
            ),
            array(
                'id' => 'backtotop-icon',
                'type' => 'text',
                'required' => array('backtotop', '=', '1'),
                'title' => esc_html__('Back to top icon', 'halena'),
                'subtitle' => esc_html__('type the icon class for eg. ion-ios-arrow-up For more. refer ionicons, fontawesome', 'halena'),
                'default' => 'ion-ios-arrow-up',
                'class' => 'text'
            ),
            array(
                'id' => 'animation-mobile',
                'type' => 'switch',
                'title' => esc_html__('Animation for mobile devices', 'halena'),
                'subtitle' => esc_html__('Just enable this to show the animation effects of each sections at mobile', 'halena'),
                'default' => '0'
            ),
            array(
                'id' => 'parallax-mobile',
                'type' => 'switch',
                'title' => esc_html__('Parallax for mobile devices', 'halena'),
                'subtitle' => esc_html__('Just enable this to show the parallax effects at mobile', 'halena'),
                'default' => '0'
            ),
            array(
                'id' => 'vc_elements',
                'type' => 'switch',
                'title' => esc_html__('Visual Composer Default Shortcodes/Elements', 'halena'),
                'subtitle' => esc_html__('Just enable this to show the built-in Visual Composer elements', 'halena'),
                'default' => '0'
            ),
            array(
                'id' => 'gmap-api',
                'type' => 'text',
                'title' => esc_html__('Google Map API key', 'halena'),
                'subtitle' => esc_html__('you can get the API key from https://developers.google.com/maps/documentation/javascript/get-api-key', 'halena'),
                'default' => '',
            ),
        )

    ) );


    Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Header Settings', 'halena' ),
        'id'    => 'header-settings',
        'icon'  => 'el el-star'
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Basic & Logo', 'halena' ),
        'id'         => 'header-basic-logo-options',
        'subsection' => true,
        'desc'       => esc_html__( 'Upload your logo/Customize your site title here.', 'halena' ),
        'fields' => array(
            array(
                'id' => 'header-site-title',
                'type' => 'switch',
                'title' => esc_html__('Site Title', 'halena'),
                'subtitle' => esc_html__('if you want to display the site title as a logo, just enable this.', 'halena'),
                'default' => 0, // 1 = on | 0 = off
                'on' => 'Enable',
                'off' => 'Disable',
            ),

            array(
                'id' => 'header-logo-choice',
                'required' => array('header-site-title', '=', '0'),
                'type'     => 'select',
                'title'    => esc_html__( 'Logo Choice', 'halena' ),
                //Must provide key => value pairs for radio options
                'options'  => array(
                    'default' => 'Default',
                    'svg' => 'SVG',
                ),
                'default'  => 'default'
            ),

            array(
                'id' => 'logo-1',
                'type' => 'media',
                'required' => array('header-site-title', '=', '0'),
                'title' => esc_html__('Logo 1', 'halena'),
                'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'url' => true,
                'subtitle' => esc_html__('This is main logo and will be displayed when you are at the top.', 'halena'),
                'default'  => array(
                    'url' => AGNI_FRAMEWORK_URL  . '/img/halena_logo.svg',
                ),
            ),

            array(
                'id' => 'logo-2',
                'type' => 'media',
                'required' => array('header-site-title', '=', '0'),
                'title' => esc_html__('Logo 2(Optional)', 'halena'),
                'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'subtitle' => esc_html__('This is additional logo and will override the Logo 1 except at the top. ', 'halena'),
                'hint'     => array(
                    'title'   => 'Additional Logo',
                    'content' => 'This logo will be useful when you want to use lite logo at top and dark at rest of the place or vice-versa.',
                )
            ),
            array(
                'id' => 'logo-1-svg-color',
                'type' => 'color',
                'required' => array('header-logo-choice', '=', 'svg'),
                'transparent' => false,
                'output' => array( '.header-icon .logo-main .header-logo-icon-svg' ), 
                'mode' => 'fill',
                'title' => esc_html__('Logo color 1', 'halena'),
                'subtitle' => esc_html__('Pick the logo color.', 'halena'),
                'default' => '',
                'validate' => 'color',
            ),
            array(
                'id' => 'logo-2-svg-color',
                'type' => 'color',
                'required' => array('header-logo-choice', '=', 'svg'),
                'transparent' => false,
                'output' => array( '.header-icon .logo-additional .header-logo-icon-svg' ), 
                'mode' => 'fill',
                'title' => esc_html__('Logo color 2', 'halena'),
                'subtitle' => esc_html__('Pick the logo color.', 'halena'),
                'default' => '',
                'validate' => 'color',
            ),
            
            array(
                'id' => 'logo-1-font',
                'type' => 'typography',
                'required' => array('header-site-title', '=', '1'),
                'title' => esc_html__('Site Title 1 Font options', 'halena'),
                'google' => true, // Disable google fonts. Won't work if you haven't defined your google api key
                //'fonts' => $font_list,
                'font-backup' => true, // Select a backup non-google font in addition to a google font
                'font-style'=>false, // Includes font-style and weight. Can use font-style or font-weight to declare
                'font-size'=>false,
                'line-height'=>false,
                'letter-spacing'=>true, // Defaults to false
                'text-align' => false,
                'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                'output' => array('.header-icon .logo-text.logo-main'), // An array of CSS selectors to apply this font style to dynamically
                'units' => 'em',  // Defaults to px
                'subtitle' => esc_html__('if you use the text logo, it will be helpful', 'halena'),
                'desc' => esc_html__('Font weight & style may not be applicable for Custom Fonts(if any).', 'halena'),
                'preview' => false,
                'default' => array(
                    'font-style' => '700',
                    'font-family' => 'Catamaran',
                    'letter-spacing' => '-0.06em',
                    'color' => '#333333',
                    'google' => true,
                ),
            ),
            array(
                'id' => 'logo-2-font',
                'type' => 'typography',
                'required' => array('header-site-title', '=', '1'),
                'title' => esc_html__('Site Title 2 Font options(optional)', 'halena'),
                'google' => true, // Disable google fonts. Won't work if you haven't defined your google api key
                //'fonts' => $font_list,
                'font-backup' => true, // Select a backup non-google font in addition to a google font
                'font-style'=>false, // Includes font-style and weight. Can use font-style or font-weight to declare
                'font-size'=>false,
                'line-height'=>false,
                'letter-spacing'=>true, // Defaults to false
                'text-align' => false,
                'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                'output' => array('.header-sticky .header-icon .logo-text.logo-additional'), // An array of CSS selectors to apply this font style to dynamically
                'units' => 'em',  // Defaults to px
                'subtitle' => esc_html__('This is an optional and helpful when you\'re using sticky header.' , 'halena'),
                'desc' => esc_html__('Font weight & style may not be applicable for Custom Fonts(if any).', 'halena'),
                'preview' => false,
                'default' => array(
                    'font-style' => '700',
                    'font-family' => 'Catamaran',
                    'letter-spacing' => '-0.06em',
                    'color' => '#333333',
                    'google' => true,
                ),
            ),
            array(
                'id' => 'logo-description',
                'type' => 'switch',
                'required' => array('header-site-title', '=', '1'),
                'title' => esc_html__('Logo Descripiton', 'halena'),
                'subtitle' => esc_html__( 'if you use the description for the logo, it will be helpful', 'halena' ),
                'default' => '', // 1 = on | 0 = off
            ),
            array(
                'id' => 'custom-logo-width',
                'type' => 'switch',
                'required' => array('header-site-title', '=', '0'),
                'title' => esc_html__('Custom logo width/Height', 'halena'),
                'subtitle' => esc_html__('it will help you to increase the logo size.', 'halena'),
                'default' => 0, // 1 = on | 0 = off
                'on' => 'Yes',
                'off' => 'No',
            ),
            array(
                'id'            => 'custom-logo-width-value',
                'type'          => 'slider',
                'required'      => array('custom-logo-width', '=', '1'),
                'title'         => esc_html__( 'Choose the logo width', 'halena' ),
                'default'       => 100,
                'min'           => 60,
                'step'          => 1,
                'max'           => 360,
            ),
            array(
                'id'            => 'custom-logo-height-value',
                'type'          => 'slider',
                'required'      => array('custom-logo-width', '=', '1'),
                'title'         => esc_html__( 'Choose the logo Height', 'halena' ),
                'default'       => 50,
                'min'           => 20,
                'step'          => 1,
                'max'           => 200,
            ),

            array(
                'id'            => 'header-min-height',
                'type'          => 'slider',
                'title'         => esc_html__( 'Minimum header height', 'halena' ),
                'default'       => 110,
                'min'           => 50,
                'step'          => 1,
                'max'           => 500,
                'default'       => '110'
            ),
            array(
                'id' => 'header-menu-style',
                'type' => 'image_select',
                'title' => esc_html__('Header Style', 'halena'),
                'subtitle' => esc_html__('Choose the header display style.', 'halena'),
                'options' => array(                            
                    'default-header-menu' => array('alt' => 'Default Menu', 'img' => AGNI_FRAMEWORK_URL . '/template/img/header-style-1.png'),
                    'minimal-header-menu' => array('alt' => 'Minimal Menu', 'img' => AGNI_FRAMEWORK_URL . '/template/img/header-style-2.png'),
                    'center-header-menu' => array('alt' => 'Center Header Menu', 'img' => AGNI_FRAMEWORK_URL . '/template/img/header-style-3.png'),
                    'strip-header-menu' => array('alt' => 'Strip Header Menu', 'img' => AGNI_FRAMEWORK_URL . '/template/img/header-style-4.png'),
                    'side-header-menu' => array('alt' => 'Sidebar Header Menu', 'img' => AGNI_FRAMEWORK_URL . '/template/img/header-style-5.png'),
                    //'border-header-menu' => array('alt' => 'Border Header Menu', 'img' => AGNI_FRAMEWORK_URL . '/template/img/header-style-6.png'),
                ), //Must provide key => value(array:title|img) pairs for radio options
                'default' => 'default-header-menu'
            ),
            array(
                'id' => 'header-menu-style-default-choice',
                'required' => array('header-menu-style', 'equals', array('default-header-menu', 'minimal-header-menu')),
                'type'     => 'radio',
                'title'    => esc_html__( 'Menu Items Alignment', 'halena' ),
                //Must provide key => value pairs for radio options
                'options'  => array(
                    'right' => 'Right',
                    'center' => 'Center',
                    'left' => 'Left',
                ),
                'default'  => 'center'
            ),
            array(
                'id' => 'header-menu-style-choice-order',
                'required' => array('header-menu-style', 'equals', array('default-header-menu', 'minimal-header-menu')),
                'type'     => 'select',
                'title'    => esc_html__( 'Menu Items Order', 'halena' ),
                //Must provide key => value pairs for radio options
                'options'  => array(
                    'lmi' => 'Logo + Menu + Icons',
                    'mli' => 'Menu + Logo + Icons',
                    'lim' => 'Logo + Icons + Menu',
                ),
                'default'  => 'mli'
            ),
            array(
                'id'       => 'header-menu-name',
                'type'     => 'text',
                'required' => array( 'header-menu-style', 'equals', array('minimal-header-menu', 'strip-header-menu') ),
                'title'    => esc_html__( 'Menu Name', 'halena' ),
                'subtitle' => esc_html__( 'Name/Text to display above to the hamburger icon.', 'halena' ),
                'default'  => esc_html__('Menu', 'halena'),
            ),
            array(
                'id'       => 'header-menu-name-active',
                'type'     => 'text',
                'required' => array( 'header-menu-style', 'equals', array('strip-header-menu') ),
                'title'    => esc_html__( 'Menu Name on Active', 'halena' ),
                'subtitle' => esc_html__( 'Name/Text to display after clicking hamburger icon/Menu Name.', 'halena' ),
                'default'  => esc_html__('Close', 'halena'),
            ),
            array(
                'id'       => 'header-minimal-menu-color',
                'type'     => 'color',
                'transparent' => false,
                'required' => array('header-menu-style', 'equals', array('minimal-header-menu', 'strip-header-menu')),
                'title'    => esc_html__( 'Hamburger Icon/Text color 1', 'halena' ),
                'default'  => '',
                'output'   => array( '.burg, .burg:before, .burg:after' ),
                'mode'     => 'background',
                'validate' => 'color',
            ),

            array(
                'id'       => 'header-minimal-menu-color-2',
                'type'     => 'color',
                'transparent' => false,
                'required' => array('header-menu-style', 'equals', array('minimal-header-menu', 'strip-header-menu')),
                'title'    => esc_html__( 'Hamburger Icon/Text color 2(Optional)', 'halena' ),
                'default'  => '',
                'output'   => array( '.header-sticky.top-sticky .toggle-nav-menu-additional .burg, .header-sticky.top-sticky .toggle-nav-menu-additional .burg:before, .header-sticky.top-sticky .toggle-nav-menu-additional .burg:after' ),
                'mode'     => 'background',
                'validate' => 'color',
            ),

            

            array(
                'id' => 'header-menu-burg',
                'type' => 'checkbox',
                'required' => array( 'header-menu-style', 'equals', array('minimal-header-menu', 'strip-header-menu') ),
                'title' => esc_html__('Hamburger Icon', 'halena'),
                'subtitle' => esc_html__( 'This will enable the hamburger icon for desktop.', 'halena' ),
                'default' => 1, // 1 = on | 0 = off
            ),

            array(
                'id'       => 'header-center-menu-bg-color-1',
                'type'     => 'color_rgba',
                'required' => array('header-menu-style', 'equals', 'center-header-menu'),
                'title'    => esc_html__( 'Header Logo Background color', 'halena' ),
                'subtitle' => esc_html__( 'Main Logo background color. You can even set the Transparency to the background color at the top.', 'halena' ),
                'default'  => '',
                //'output'   => array( '.center-header-menu .header-icon, .reverse_skin.header-sticky.top-sticky.center-header-menu .header-icon.header-center-menu-additional-bg-color' ),
                'output'   => array( '.center-header-menu .header-center-menu-top-content, .reverse_skin.header-sticky.top-sticky.center-header-menu .header-center-menu-top-content' ),
                'mode'     => 'background',
                'validate' => 'colorrgba',
            ),
            array(
                'id'       => 'header-center-menu-bg-color-2',
                'type'     => 'color_rgba',
                'required' => array('header-menu-style', 'equals', 'center-header-menu'),
                'title'    => esc_html__( 'Header Logo Background color 2(Optional)', 'halena' ),
                'subtitle' => esc_html__( 'background color except at the top.', 'halena' ),
                //'output'   => array( '.header-sticky.top-sticky.center-header-menu .header-icon.header-center-menu-additional-bg-color, .reverse_skin.center-header-menu .header-icon' ),
                'output'   => array( '.header-sticky.top-sticky.center-header-menu .header-center-menu-top-content.header-center-menu-additional-bg-color, .reverse_skin.center-header-menu .header-center-menu-top-content' ),
                'mode'     => 'background',
                'validate' => 'colorrgba',
            ),
            array(
                'id'       => 'header-strip-bg-color-1',
                'type'     => 'color_rgba',
                'required' => array('header-menu-style', 'equals', 'strip-header-menu'),
                'title'    => esc_html__( 'Header Strip Background color', 'halena' ),
                'subtitle' => esc_html__( 'Header Strip background color. You can even set the Transparency to the background color at the top.', 'halena' ),
                'default'  => array(
                    'color' => '#f6f6f6',
                    'alpha' => '1'
                ),
                'output'   => array( '.strip-header-bar' ),
                'mode'     => 'background',
                'validate' => 'colorrgba',
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'General', 'halena' ),
        'id'         => 'header-general-options',
        'subsection' => true,
        'desc'       => esc_html__( 'Here, you can customize header style, size, icons etc.', 'halena' ),
        'fields' => array(
            
            array(
                'id' => 'header-sticky',
                'type' => 'switch',
                'required' => array('layout-boxed', '!=', '1'),
                'title' => esc_html__('Sticky Header', 'halena'),
                'subtitle' => esc_html__('Disable sticky header by turning off', 'halena'),
                "default" => 1,
            ),
            array(
                'id' => 'header-sticky-fancy',
                'type' => 'checkbox',
                'required' => array( 'header-sticky', '=', '1' ),
                'title' => esc_html__('Sticky only when scroll Up', 'halena'),
                'default' => 0, // 1 = on | 0 = off
            ),

            array(
                'id' => 'header-bg-transparent',
                'type' => 'checkbox',
                'title' => esc_html__('Transparent Header', 'halena'),
                'subtitle' => esc_html__( 'This option make whole header background transparent completely. And this will not affect the sticky header(if enabled).', 'halena' ),
                'desc' => esc_html__( 'This option can be overwritten by each page\'s Page option.', 'halena' ),
                'default' => 0, // 1 = on | 0 = off
            ),
            array(
                'id' => 'shrink-header-menu',
                'type' => 'checkbox',
                'required' => array( 'header-menu-style', '!=', 'side-header-menu' ),
                'title' => esc_html__('Shrink Header', 'halena'),
                'subtitle' => esc_html__( 'This option is used to reduce the height of the menu to 60px.', 'halena' ),
                'default' => 0, // 1 = on | 0 = off
            ),
            array(
                'id' => 'fullwidth-header-menu',
                'type' => 'checkbox',
                'required' => array( 'header-menu-style', '!=', 'side-header-menu' ),
                'title' => esc_html__('Fullwidth Header', 'halena'),
                'default' => 1, // 1 = on | 0 = off
            ),
            array(
                'id'             => 'header-menu-outer-margin',
                'type'           => 'spacing',
                // An array of CSS selectors to apply this font style to
                'mode'           => 'margin',
                // absolute, padding, margin, defaults to padding
                //'all'            => true,
                // Have one field that applies to all
                'top'         => false,     // Disable the right
                'bottom'          => false,     // Disable the left
                'units'          => array( 'em', 'px', '%' ),
                'title'          => esc_html__( 'Header Margin', 'halena' ),
                'default'        => array(
                    'margin-right' => '25px',
                    'margin-left' => '25px'
                ),
                'output'         => array( '.fullwidth-header-menu .header-menu-content' )
            ),
            
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Styling', 'halena' ),
        'id'         => 'header-styling-options',
        'subsection' => true,
        'desc'       => esc_html__( 'Here, you can customize header background and border.', 'halena' ),
        'fields' => array(
            array(
                'id'       => 'header-menu-bg-color-1',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Header Menu Background color', 'halena' ),
                'subtitle' => esc_html__( 'Main Menu background color. You can even set the Transparency to the background color at the top.', 'halena' ),
                'default'  => array(
                    'color' => '#ffffff',
                    'alpha' => '1'
                ),
                'output'   => array( '.header-navigation-menu, .reverse_skin.header-sticky.top-sticky.header-navigation-menu.header-additional-bg-color:not(.side-header-menu), .tab-nav-menu, .border-header-menu + .border-header-menu-footer, .border-header-menu-right, .border-header-menu-left' ),
                'mode'     => 'background',
                'validate' => 'colorrgba',
            ),
            array(
                'id'       => 'header-menu-bg-color-2',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Header Menu Background color 2(Optional)', 'halena' ),
                'subtitle' => esc_html__( 'background color except at the top.', 'halena' ),
                'output'   => array( '.header-sticky.top-sticky.header-navigation-menu.header-additional-bg-color:not(.side-header-menu), .reverse_skin.header-navigation-menu' ),
                'mode'     => 'background',
                'validate' => 'colorrgba',
            ),
            array(
                'id'       => 'header-menu-overlay',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Overlay Menu BG color', 'halena' ),
                'subtitle' => esc_html__( 'background color will be applied to mobile menu & Minimal overlay menu(Hamburger).', 'halena' ),
                'default'  => array(
                    'color' => '#ffffff',
                    'alpha' => '1.0'
                ),
                'output'   => array( '.tab-nav-menu' ),
                'mode'     => 'background',
                'validate' => 'colorrgba',
            ),

            array(
                'id'       => 'header-menu-border-1',
                'type'     => 'border',
                'title'    => esc_html__( 'Header Menu Border', 'halena' ),
                'subtitle' => esc_html__( 'Main border above & below to the menu items at the top.', 'halena' ),
                'all'      => true,
                'top'      => false,
                'left'      => false,
                'right'      => false,
                'color'     => false,
                // An array of CSS selectors to apply this font style to
                'default'  => array(
                    'border-style'  => 'solid',
                    'border-bottom' => '0px'
                )
            ), 
            array(
                'id'       => 'header-menu-border-color-1',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Header Menu Border Color', 'halena' ),
                'subtitle' => esc_html__( 'Main border color above & below to the menu items at the top.', 'halena' ),
                'output'   => array( '.header-navigation-menu .header-menu-content, .reverse_skin.header-sticky.top-sticky.header-navigation-menu.header-menu-border-additional:not(.side-header-menu) .header-menu-content, .reverse_skin.header-sticky.top-sticky.side-header-menu.header-menu-border-additional:not(.side-header-menu) .tab-nav-menu, .header-navigation-menu .header-menu-flex > div:first-child .header-icon, .reverse_skin.header-sticky.top-sticky.header-navigation-menu.header-menu-border-additional:not(.side-header-menu)  .header-menu-flex > div:first-child .header-icon, .header-navigation-menu:not(.center-header-menu) .header-menu-flex > div:last-child .header-menu-icons, .reverse_skin.header-sticky.top-sticky.header-navigation-menu.header-menu-border-additional:not(.side-header-menu):not(.center-header-menu) .header-menu-flex > div:last-child .header-menu-icons, .header-navigation-menu.center-header-menu .header-menu-content, .reverse_skin.header-sticky.top-sticky.header-navigation-menu.center-header-menu.header-menu-border-additional:not(.side-header-menu) .header-menu-content' ),
                'mode'  => 'border-color',
                'validate' => 'colorrgba',
            ), 
            array(
                'id'       => 'header-menu-border-2',
                'type'     => 'border',
                'title'    => esc_html__( 'Header Menu Border 2(Optional)', 'halena' ),
                'subtitle' => esc_html__( 'Optional border above & below to the menu items except at the top.', 'halena' ),
                'all'      => true,
                'top'      => false,
                'left'      => false,
                'right'      => false,
                'color'     => false,
                'default'  => array(
                    'border-style'  => '',
                    'border-bottom' => ''
                )
            ),  
            array(
                'id'       => 'header-menu-border-color-2',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Header Menu Border Color 2(Optional)', 'halena' ),
                'subtitle' => esc_html__( 'Main border color above & below to the menu items except at the top.', 'halena' ),
                'output'   => array( '.header-sticky.top-sticky.header-navigation-menu.header-menu-border-additional:not(.side-header-menu) .header-menu-content, .header-sticky.top-sticky.side-header-menu.header-menu-border-additional:not(.side-header-menu) .tab-nav-menu, .reverse_skin.header-navigation-menu .header-menu-content, .header-sticky.top-sticky.header-navigation-menu.header-menu-border-additional:not(.side-header-menu) .header-menu-flex > div:first-child .header-icon, .reverse_skin.header-navigation-menu .header-menu-flex > div:first-child .header-icon, .header-sticky.top-sticky.header-navigation-menu.header-menu-border-additional:not(.side-header-menu):not(.center-header-menu) .header-menu-flex > div:last-child .header-menu-icons, .reverse_skin.header-navigation-menu .header-menu-flex:not(.center-header-menu) > div:last-child .header-menu-icons, .header-sticky.top-sticky.header-navigation-menu.center-header-menu.header-menu-border-additional:not(.side-header-menu) .header-menu-content, .reverse_skin.header-navigation-menu.center-header-menu .header-menu-content' ),
                'mode'  => 'border-color',
                'validate' => 'colorrgba',
            ),    
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Top Bar', 'halena' ),
        'id'         => 'header-top-bar-options',
        'subsection' => true,
        'desc'       => esc_html__( 'Here, you can customize header topbar and topbar\'s menu.', 'halena' ),
        'fields' => array(
            array(
                'id' => 'header-top-bar',
                'type' => 'switch',
                'required' => array( 'header-menu-style', '!=', 'side-header-menu' ),
                'title' => esc_html__('Top Bar', 'halena'),
                'subtitle' => esc_html__('This is top bar which is shown above to the header menu.', 'halena'),
                'desc' => esc_html__('Note: This bar will be hidden on mobile devices.', 'halena'),
                'default' => 0, // 1 = on | 0 = off
                'on' => 'On',
                'off' => 'Off',
            ),
            array(
                'id'       => 'header-top-email',
                'type'     => 'text',
                'required' => array('header-top-bar', '=', '1'),
                'title'    => esc_html__( 'Email Address', 'halena' ),
                'default'  => 'yourmail@mail.com',
            ),array(
                'id'       => 'header-top-number',
                'type'     => 'text',
                'required' => array('header-top-bar', '=', '1'),
                'title'    => esc_html__( 'Contact number', 'halena' ),
                'default'  => '(000) 000-0000',
            ),
            array(
                'id'       => 'header-top-color',
                'type'     => 'color',
                'required' => array('header-top-bar', '=', '1'),
                'title'    => esc_html__( 'Top bar Color', 'halena' ),
                'default'  => '#555555',
                'output'   => array( '.header-top-bar' ),
            ),
            array(
                'id' => 'top-bar-nav',
                'type' => 'checkbox',
                'required' => array('header-top-bar', '=', '1'),
                'title' => esc_html__('Top Bar Menu', 'halena'),
                'default' => 0, // 1 = on | 0 = off
            ),
            array(
                'id'       => 'header-top-menu-color',
                'type'     => 'link_color',
                'required' => array('top-bar-nav', '=', '1'),
                'title'    => esc_html__( 'Top Bar Menu Links Color', 'halena' ),
                'subtitle' => esc_html__( 'Just choose you color for regular & hover links. its applicable only on menu items.', 'halena' ),
                'active'    => false, // Disable Active Color
                'default'  => array(
                    'regular' => '#999',
                    'hover'   => '#1e1e20',
                ),
                'output'   => array( '.top-nav-menu a' ),
            ),
            
            array(
                'id'       => 'header-top-bg-color',
                'type'     => 'color_rgba',
                'required' => array('header-top-bar', '=', '1'),
                'title'    => esc_html__( 'Header Top Bar Background color', 'halena' ),
                'subtitle' => esc_html__( 'You can even set the Transparency to the background color.', 'halena' ),
                'default'  => array(
                    'color' => '#f6f6f6',
                    'alpha' => '1'
                ),
                'output'   => array( '.header-top-bar' ),
                'mode'     => 'background',
                'validate' => 'colorrgba',
            ),
        )
    ) );
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Header Menu', 'halena' ),
        'id'         => 'header-menu-options',
        'subsection' => true,
        'desc'       => esc_html__( 'Here, you can change menu items color, font, etc.', 'halena' ),
        'fields' => array(
            
            array(
                'id' => 'header-font',
                'type' => 'typography',
                'title' => esc_html__('Header Menu font options', 'halena'),
                'google' => true, // Disable google fonts. Won't work if you haven't defined your google api key
                //'fonts' => $font_list,
                'font-backup' => true, // Select a backup non-google font in addition to a google font
                'font-style'=>false, // Includes font-style and weight. Can use font-style or font-weight to declare
                'font-size'=>false,
                'line-height'=>false,
                'letter-spacing'=>true, // Defaults to false
                'text-align' => false,
                'color'=>false,
                'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                'output' => array('.nav-menu a, .tab-nav-menu a'), // An array of CSS selectors to apply this font style to dynamically
                'units' => 'em',  // Defaults to px
                'subtitle' => esc_html__('if you use the text logo, it will be helpful', 'halena'),
                'desc' => esc_html__('Font weight & style may not be applicable for Custom Fonts(if any).', 'halena'),
                'preview' => false,
                'default' => array(
                    'font-weight' => '',
                    'font-family' => '',
                    'google' => true,
                ),
            ),
            array(
                'id' => 'header-fontsize',
                'type' => 'text',
                'title' => esc_html__('Header Menu Font Size', 'halena'),
                'desc' => esc_html__( 'Font size in px. Do not enter "px"', 'halena' ),
                'default' => '17',
                'class' => 'text',
                'validate' => 'numeric',
            ),
            array(
                'id' => 'header-text-transform',
                'type'     => 'select',
                'title'    => esc_html__( 'Header Menu Text Transform', 'halena' ),
                'options'  => array(
                    'none' => 'None',
                    'uppercase' => 'Uppercase',
                    'lowercase' => 'Lowercase',
                    'capitalize' => 'Capitalize',
                ),
                'default'  => 'none'
            ),
            array(
                'id' => 'header-fontsize-2',
                'type' => 'text',
                'title' => esc_html__('Header Sub Menu Font Size (Optional)', 'halena'),
                'desc' => esc_html__( 'It will apply the font size to the sub-level menus. Font size in px. Do not enter "px"', 'halena' ),
                'default' => '',
                'class' => 'text',
                'validate' => 'numeric',
            ),
            array(
                'id' => 'header-text-transform-2',
                'type'     => 'select',
                'title'    => esc_html__( 'Header Sub Menu Text Transform (Optional)', 'halena' ),
                'options'  => array(
                    'none' => 'None',
                    'uppercase' => 'Uppercase',
                    'lowercase' => 'Lowercase',
                    'capitalize' => 'Capitalize',
                ),
                'default'  => ''
            ),
            array(
                'id'       => 'header-menu-link-color-1',
                'type'     => 'link_color',
                'title'    => esc_html__( 'Header Menu Links Color', 'halena' ),
                'subtitle' => esc_html__( 'Main menu color for regular & hover links. it will be applied at the top.', 'halena' ),
                'active'    => false, // Disable Active Color
                'default'  => array(
                    'regular' => '#333333',
                    'hover'   => '#1e1e20',
                ),
                'output'   => array( '.nav-menu a', '.nav-menu-content li a', '.tab-nav-menu a', '.reverse_skin.header-sticky.top-sticky:not(.side-header-menu) .nav-menu-additional-color .nav-menu-content > li > a', '.reverse_skin.header-sticky.top-sticky:not(.side-header-menu) .nav-menu-additional-color .additional-primary-nav-menu-content li > a' ),
            ),
            array(
                'id'       => 'header-menu-link-color-2',
                'type'     => 'link_color',
                'title'    => esc_html__( 'Header Menu Links Color 2(Optional)', 'halena' ),
                'subtitle' => esc_html__( 'Menu link color except at the top.', 'halena' ),
                'active'    => false, // Disable Active Color
                'default'  => array(
                    'regular' => '',
                    'hover'   => '',
                ),
                'output'   => array( '.header-sticky.top-sticky:not(.side-header-menu) .nav-menu-additional-color .nav-menu-content > li > a', '.reverse_skin .nav-menu-content > li > a', '.reverse_skin .additional-primary-nav-menu-content li > a' ),
            ),

            array(
                'id' => 'header-menu-button',
                'type' => 'checkbox',
                'title' => esc_html__('Header Menu Button', 'halena'),
                'subtitle' => esc_html__( 'It will apply the button style to the last menu item.', 'halena' ),
                'default' => 0, // 1 = on | 0 = off
            ),
            array(
                'id'             => 'header-menu-button-padding',
                'required' => array('header-menu-button', '=', '1'),
                'type'           => 'spacing',
                // An array of CSS selectors to apply this font style to
                'mode'           => 'padding',
                // absolute, padding, margin, defaults to padding
                //'all'            => true,
                // Have one field that applies to all
                //'right'         => false,     // Disable the right
                //'left'          => false,     // Disable the left
                'units'          => 'px',      // You can specify a unit value. Possible: px, em, %
                'units_extended' => 'false',    // Allow users to select any type of unit
                'title'          => esc_html__( 'Menu Button Padding', 'halena' ),
                'default'        => array(
                    'padding-top'    => '6px',
                    'padding-bottom' => '6px',
                    'padding-right' => '16px',
                    'padding-left' => '16px'
                ),
                'output'         => array( '.has-menu-button ul.nav-menu-content >li:last-child >a, .has-menu-button div.nav-menu-content >ul >li:last-child >a' )
            ),

            array(
                'id' => 'header-menu-button-fontsize',
                'type' => 'text',
                'required' => array('header-menu-button', '=', '1'),
                'title' => esc_html__('Button Font Size', 'halena'),
                'default' => '',
                'class' => 'text',
                'validate' => 'numeric',
            ),

            array(
                'id' => 'header-menu-button-border-color',
                'type' => 'color',
                'required' => array('header-menu-button', '=', '1'),
                'transparent' => false,
                'output' => array( '.has-menu-button ul.nav-menu-content:not(.additional-primary-nav-menu-content) >li:last-child >a, .has-menu-button div.nav-menu-content:not(.additional-primary-nav-menu-content) >ul >li:last-child >a' ), 
                'mode' => 'border-color',
                'title' => esc_html__('Button Border color ', 'halena'),
                'default' => '#1e1e20',
                'validate' => 'color',
            ),
            array(
                'id' => 'header-menu-button-color',
                'type' => 'color',
                'required' => array('header-menu-button', '=', '1'),
                'transparent' => false,
                'output' => array( '.has-menu-button ul.nav-menu-content:not(.additional-primary-nav-menu-content) >li:last-child >a, .has-menu-button div.nav-menu-content:not(.additional-primary-nav-menu-content) >ul >li:last-child >a' ), 
                'mode' => 'color',
                'title' => esc_html__('Button color', 'halena'),
                'default' => '#1e1e20',
                'validate' => 'color',
            ),

            array(
                'id' => 'header-additional-primary-menu',
                'type' => 'switch',
                'title' => esc_html__('Header Additional Menu', 'halena'),
                'default' => 0, // 1 = on | 0 = off
                'on' => 'Enable',
                'off' => 'Disable',
            ),
            array(
                'id' => 'header-additional-primary-menu-button',
                'type' => 'checkbox',
                'required' => array('header-additional-primary-menu', '=', '1'),
                'title' => esc_html__('Header Additional Menu Button', 'halena'),
                'subtitle' => esc_html__( 'It will apply the button style to the last menu item.', 'halena' ),
                'default' => 0, // 1 = on | 0 = off
            ),

            array(
                'id'             => 'header-additional-primary-menu-button-padding',
                'required' => array('header-additional-primary-menu-button', '=', '1'),
                'type'           => 'spacing',
                // An array of CSS selectors to apply this font style to
                'mode'           => 'padding',
                // absolute, padding, margin, defaults to padding
                //'all'            => true,
                // Have one field that applies to all
                //'right'         => false,     // Disable the right
                //'left'          => false,     // Disable the left
                'units'          => 'px',      // You can specify a unit value. Possible: px, em, %
                'units_extended' => 'false',    // Allow users to select any type of unit
                'title'          => esc_html__( 'Menu Button Padding', 'halena' ),
                'default'        => array(
                    'padding-top'    => '6px',
                    'padding-bottom' => '6px',
                    'padding-right' => '16px',
                    'padding-left' => '16px'
                ),
                'output'         => array( '.has-menu-button ul.nav-menu-content >li:last-child >a, .has-menu-button div.nav-menu-content >ul >li:last-child >a' )
            ),

            array(
                'id' => 'header-additional-primary-menu-button-fontsize',
                'type' => 'text',
                'required' => array('header-additional-primary-menu-button', '=', '1'),
                'title' => esc_html__('Button Font Size', 'halena'),
                'default' => '',
                'class' => 'text',
                'validate' => 'numeric',
            ),

            array(
                'id' => 'header-additional-primary-menu-button-border-color',
                'type' => 'color',
                'required' => array('header-additional-primary-menu-button', '=', '1'),
                'transparent' => false,
                'output' => array( '.has-additional-primary-menu-button ul.additional-primary-nav-menu-content >li:last-child >a, .has-additional-primary-menu-button div.additional-primary-nav-menu-content >ul >li:last-child >a' ), 
                'mode' => 'border-color',
                'title' => esc_html__('Button Border color ', 'halena'),
                'default' => '#1e1e20',
                'validate' => 'color',
            ),
            array(
                'id' => 'header-additional-primary-menu-button-color',
                'type' => 'color',
                'required' => array('header-additional-primary-menu-button', '=', '1'),
                'transparent' => false,
                'output' => array( '.has-additional-primary-menu-button ul.additional-primary-nav-menu-content >li:last-child >a, .has-additional-primary-menu-button div.additional-primary-nav-menu-content >ul >li:last-child >a' ), 
                'mode' => 'color',
                'title' => esc_html__('Button color', 'halena'),
                'default' => '#555555',
                'validate' => 'color',
            ),

            array(
                'id' => 'header-menu-has-no-arrows',
                'type' => 'checkbox',
                'title' => esc_html__('Remove Header Menu Arrows', 'halena'),
                'default' => 1, // 1 = on | 0 = off
            ),


            array(
                'id' => 'header-menu-has-parent-link',
                'type' => 'checkbox',
                'title' => esc_html__('Enable the parent menu on mobile.', 'halena'),
                'default' => 0, // 1 = on | 0 = off
            ),

            
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Header Icons', 'halena' ),
        'id'         => 'header-icons-option',
        'subsection' => true,
        'desc'       => esc_html__( 'Here, you can enable/disable, sort the social media icons for header.', 'halena' ),
        'fields' => array(

            array(
                'id' => 'header-search-box',
                'type' => 'switch',
                'title' => esc_html__('Search Box', 'halena'),
                'default' => 0, // 1 = on | 0 = off
                'on' => 'Enable',
                'off' => 'Disable',
            ),

            array(
                'id'       => 'header-search-style',
                'required' => array('header-search-box', '=', '1'),
                'type'     => 'select',
                'title'    => esc_html__( 'Search style', 'halena' ),
                //Must provide key => value pairs for radio options
                'options'  => array(
                    '1' => 'Text',
                    '2' => 'Icon',
                ),
                'default'  => '2'
            ),

            array(
                'id'       => 'header-search-box-overlay',
                'type'     => 'color_rgba',
                'required' => array('header-search-box', '=', '1'),
                'title'    => esc_html__( 'Search Box BG color', 'halena' ),
                'default'  => array(
                    'color' => '#ffffff',
                    'alpha' => '0.9'
                ),
                'output'   => array( '.header-search-overlay' ),
                'mode'     => 'background',
                'validate' => 'colorrgba',
            ),
            array(
                'id' => 'header-search-box-color',
                'type' => 'color',
                'required' => array('header-search-box', '=', '1'),
                'transparent' => false,
                'output' => array( '.header-search input[type="text"]' ), 
                'mode' => 'color',
                'title'    => esc_html__( 'Search Box color', 'halena' ),
                'default' => '#1e1e20',
                'validate' => 'color',
            ),
            array(
                'id'       => 'header-search-box-text',
                'type'     => 'text',
                'required' => array('header-search-box', '=', '1'),
                'title'    => esc_html__( 'Search Box Placeholder Text', 'halena' ),
                'subtitle' => esc_html__( 'This text will be displayed inside the search input.', 'halena' ),
                'default'  => 'Search for products...',
            ),
            array(
                'id'       => 'header-search-box-order',
                'required' => array('header-search-box', '=', '1'),
                'type'     => 'select',
                'title'    => esc_html__( 'Display Order', 'halena' ),
                //Must provide key => value pairs for radio options
                'options'  => array(
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                    '7' => '7',
                    '8' => '8',
                ),
                'default'  => '1'
            ),
            array(
                'id' => 'header-lang-box',
                'type' => 'switch',
                'title' => esc_html__('Language Boxes', 'halena'),
                'default' => 0, // 1 = on | 0 = off
                'on' => 'Enable',
                'off' => 'Disable',
            ),
            array(
                'id'       => 'header-lang-name',
                'type'     => 'text',
                'required' => array('header-lang-box', '=', '1'),
                'title'    => esc_html__( 'Language Menu Name', 'halena' ),
                'subtitle' => esc_html__( 'Name to display inside the language menu in the header. You also can display the icon by placing the html tag.', 'halena' ),
                'desc' => esc_html__( ' for icon ref. http://fortawesome.github.io/Font-Awesome/icons/', 'halena' ),
                'default'  => '<i class="icon-basic-world"></i>',
            ),
            array(
                'id'       => 'header-lang-list',
                'type'     => 'editor',
                'required' => array('header-lang-box', '=', '1'),
                'title'    => esc_html__('Language List', 'halena'),
                'subtitle' => esc_html__('To give your own langauage link, just go to text mode and replace \'#\' with your link.', 'halena'),
                'default'  => '<ul><li><a href="#">EN</a></li><li><a href="#">TA</a></li><li><a href="#">ES</a></li></ul>',
                'args'   => array(
                    'wpautop'   => false,
                    'media_buttons'=> false,
                )
            ),
            array(
                'id'       => 'header-lang-order',
                'required' => array('header-lang-box', '=', '1'),
                'type'     => 'select',
                'title'    => esc_html__( 'Display Order', 'halena' ),
                //Must provide key => value pairs for radio options
                'options'  => array(
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                    '7' => '7',
                    '8' => '8',
                ),
                'default'  => '2'
            ),
            array(
                'id' => 'header-wpml-box',
                'type' => 'switch',
                //'required' => array('header-lang-box', '=', '1'),
                'title' => esc_html__('WPML Language Switch', 'halena'),
                'subtitle' => esc_html__( 'It will work only when you have WPML plugin activated', 'halena' ),
                'default' => 0, // 1 = on | 0 = off
                'on' => 'Enable',
                'off' => 'Disable',
            ),
            array(
                'id'       => 'header-wpml-display-options',
                'required' => array('header-wpml-box', '=', '1'),
                'type'     => 'select',
                'title'    => esc_html__( 'Display Options', 'halena' ),
                //Must provide key => value pairs for radio options
                'options'  => array(
                    '1' => 'Translated Name',
                    '2' => 'Native Name',
                    '3' => 'Language code',
                    '4' => 'Flag',
                ),
                'default'  => '1'
            ),
            array(
                'id'       => 'header-wpml-order',
                'required' => array('header-wpml-box', '=', '1'),
                'type'     => 'select',
                'title'    => esc_html__( 'Display Order', 'halena' ),
                //Must provide key => value pairs for radio options
                'options'  => array(
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                    '7' => '7',
                    '8' => '8',
                ),
                'default'  => '3'
            ),
            array(
                'id' => 'header-myaccount-box',
                'type' => 'switch',
                'title' => esc_html__('My Account Icon', 'halena'),
                'default' => 0, // 1 = on | 0 = off
                'on' => 'Enable',
                'off' => 'Disable',
            ),
            array(
                'id'       => 'header-myaccount-order',
                'required' => array('header-myaccount-box', '=', '1'),
                'type'     => 'select',
                'title'    => esc_html__( 'Display Order', 'halena' ),
                //Must provide key => value pairs for radio options
                'options'  => array(
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                    '7' => '7',
                    '8' => '8',
                ),
                'default'  => '4'
            ),
            array(
                'id' => 'header-cart-box',
                'type' => 'switch',
                'title' => esc_html__('Shopping Cart Box', 'halena'),
                'subtitle' => esc_html__('It will work only when Woocommerce is activated.', 'halena'),
                'default' => 0, // 1 = on | 0 = off
                'on' => 'Enable',
                'off' => 'Disable',
            ),
            array(
                'id'       => 'header-cart-style',
                'required' => array('header-cart-box', '=', '1'),
                'type'     => 'select',
                'title'    => esc_html__( 'Cart style', 'halena' ),
                //Must provide key => value pairs for radio options
                'options'  => array(
                    '1' => 'Text',
                    '2' => 'Icon',
                ),
                'default'  => '1'
            ),
            array(
                'id' => 'header-cart-amount',
                'type' => 'checkbox',
                'required' => array( 'header-cart-box', '=', '1' ),
                'title' => esc_html__('Cart Amount', 'halena'),
                'default' => 1, // 1 = on | 0 = off
            ),
            array(
                'id' => 'header-cart-amount-inclusive',
                'type' => 'checkbox',
                'required' => array( 'header-cart-amount', '=', '1' ),
                'title' => esc_html__('Display Amount Inclusive tax.', 'halena'),
                'default' => '', // 1 = on | 0 = off
            ),
            array(
                'id'       => 'header-cart-order',
                'required' => array('header-cart-box', '=', '1'),
                'type'     => 'select',
                'title'    => esc_html__( 'Display Order', 'halena' ),
                //Must provide key => value pairs for radio options
                'options'  => array(
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                    '7' => '7',
                    '8' => '8',
                ),
                'default'  => '5'
            ),

            array(
                'id' => 'header-wishlist-box',
                'type' => 'switch',
                'title' => esc_html__('Wishlist Box', 'halena'),
                'subtitle' => esc_html__('It will work only when Woocommerce & yith wishlist plugin is activated.', 'halena'),
                'default' => 0, // 1 = on | 0 = off
                'on' => 'Enable',
                'off' => 'Disable',
            ),
            array(
                'id'       => 'header-wishlist-order',
                'required' => array('header-wishlist-box', '=', '1'),
                'type'     => 'select',
                'title'    => esc_html__( 'Display Order', 'halena' ),
                //Must provide key => value pairs for radio options
                'options'  => array(
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                    '7' => '7',
                    '8' => '8',
                ),
                'default'  => '6'
            ),

            array(
                'id' => 'header-currency-box',
                'type' => 'switch',
                'title' => esc_html__('Currency Switch', 'halena'),
                'subtitle' => esc_html__('It will work only when Woocommerce currency switcher plugin is actived.', 'halena'),
                'default' => 0, // 1 = on | 0 = off
                'on' => 'Enable',
                'off' => 'Disable',
            ),
            array(
                'id'       => 'header-currency-order',
                'required' => array('header-currency-box', '=', '1'),
                'type'     => 'select',
                'title'    => esc_html__( 'Display Order', 'halena' ),
                //Must provide key => value pairs for radio options
                'options'  => array(
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                    '7' => '7',
                    '8' => '8',
                ),
                'default'  => '7'
            ),

            array(
                'id' => 'social-media-header',
                'type' => 'switch',
                'title' => esc_html__('Social Media Icons', 'halena'),
                'subtitle' => esc_html__('enable this to show the list of social media icons', 'halena'),
                "default" => 0,
                'on' => 'Enable',
                'off' => 'Disable',
            ),
            array(
                'id' => 'social-media-header-location',
                'required' => array('social-media-header', '=', '1'),
                'type'     => 'radio',
                'title'    => esc_html__( 'Location', 'halena' ),
                'subtitle' => esc_html__( 'Here, You can set the place where you want to display the social media icons', 'halena' ),
                'desc'     => esc_html__( 'Note : Top Menu option only work when you enabled Top Bar.', 'halena' ),
                //Must provide key => value pairs for radio options
                'options'  => array(
                    '1' => 'Default(Header menu)',
                    '2' => 'at Top Bar',
                ),
                'default'  => '1'
            ),
            array(
                'id'       => 'header-social-order',
                'required' => array('header-wishlist-box', '=', '1'),
                'type'     => 'select',
                'title'    => esc_html__( 'Display Order', 'halena' ),
                //Must provide key => value pairs for radio options
                'options'  => array(
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                    '7' => '7',
                    '8' => '8',
                ),
                'default'  => '8'
            ),
            array(
                'id' => 'header-link-target',
                'required' => array('social-media-header', '=', '1'),
                'type' => 'select',
                'title' => esc_html__('Link target', 'halena'),
                'subtitle' => esc_html__('Choose the target of the link on click.', 'halena'),
                'options' => array(
                    '_self' => 'Same window', 
                    '_blank' => 'New window',
                ), //Must provide key => value pairs for select options
                'default' => '_self'
            ),
            array(
                'id'       => 'social-media-icons-header',
                'type'     => 'sortable',
                'required' => array('social-media-header', '=', '1'),
                'mode'     => 'checkbox', // checkbox or text
                'title'    => esc_html__( 'Choose your icons', 'halena' ),
                'subtitle' => esc_html__( 'Enable the Social icon which you want to display in header', 'halena' ),
                'options'  => array(
                    'facebook' => 'Facebook',
                    'twitter' => 'Twitter',
                    'google-plus' => 'Google Plus',
                    'bitbucket' => 'BitBucket',
                    'behance' => 'Behance',
                    'dribbble' => 'Dribbble',
                    'flickr' => 'Flickr',
                    'github' => 'GitHub',
                    'instagram' => 'instagram',
                    'linkedin' => 'Linkedin',
                    'pinterest' => 'Pinterest',
                    'reddit' => 'Reddit',
                    'soundcloud' => 'SoundCloud',
                    'skype' => 'Skype',
                    'stack-overflow' => 'StackOverflow',
                    'tumblr' => 'Tumblr',
                    'vimeo' => 'Vimeo',
                    'vk' => 'VK',
                    'weibo' => 'Weibo',
                    'whatsapp' => 'WhatsApp',
                    'youtube' => 'YouTube',
                ),
                'default'  => array(
                    'facebook' => true,
                    'twitter' => true,
                    'google-plus' => false,
                    'bitbucket' => false,
                    'behance' => false,
                    'dribbble' => true,
                    'flickr' => false,
                    'github' => false,
                    'instagram' => false,
                    'linkedin' => false,
                    'pinterest' => false,
                    'reddit' => false,
                    'soundcloud' => false,
                    'skype' => false,
                    'stack-overflow' => false,
                    'tumblr' => false,
                    'vimeo' => false,
                    'vk' => false,
                    'weibo' => false,
                    'whatsapp' => false,
                    'youtube' => false,
                )
            ),      

            array(
                'id'       => 'header-icon-link-color-1',
                'type'     => 'link_color',
                'title'    => esc_html__( 'Header Icons Color 1', 'halena' ),
                'subtitle' => esc_html__( 'This is main color for regular & hover icons links.', 'halena' ),
                'active'    => false, // Disable Active Color
                'default'  => array(
                    'regular' => '#555555',
                    'hover'   => '#1e1e20',
                ),
            ),
            array(
                'id'       => 'header-icon-link-color-2',
                'type'     => 'link_color',
                'title'    => esc_html__( 'Header Icons Color 2(Optional)', 'halena' ),
                'subtitle' => esc_html__( 'It will override the Header Icons Color 1 except at the top.', 'halena' ),
                'active'    => false, // Disable Active Color
                'default'  => array(
                    'regular' => '',
                    'hover'   => '',
                ),
            ), 
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Footer Settings', 'halena' ),
        'id'    => 'footer-settings',
        'icon'  => 'el el-tint'
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'General & Colophon', 'halena' ),
        'id'         => 'footer-general-options',
        'subsection' => true,
        'desc'       => esc_html__( 'This option allows you to change footer colophon text, color, etc.', 'halena' ),
        'fields' => array(

            array(
                'id' => 'footer-text-choice',
                'type' => 'switch',
                'title' => esc_html__('Footer Info.', 'halena'),
                'default' => 1, // 1 = on | 0 = off
            ),

            array(
                'id' => 'footer-style',
                'type' => 'select',
                'required' => array('footer-text-choice', '=', '1'),
                'title' => esc_html__('Footer Style', 'halena'),
                'subtitle' => esc_html__('Choose the any of the one footer style.', 'halena'),
                'options' => array(
                    'style-1' => 'Style 1', 
                    'style-2' => 'Style 2',
                ), //Must provide key => value pairs for select options
                'default' => 'style-1'
            ),
            array(
                'id' => 'footer-sticky',
                'type' => 'checkbox',
                'title' => esc_html__('Footer Sticky', 'halena'),
                'subtitle' => esc_html__('It will stick the footer to the bottom of page.', 'halena'),
                'default' => '0'// 1 = on | 0 = off
            ),
            array(
                'id' => 'footer-fullwidth',
                'type' => 'checkbox',
                'required' => array('footer-text-choice', '=', '1'),
                'title' => esc_html__('Fullwidth', 'halena'),
                'subtitle' => esc_html__('It will make the footer width 100%.', 'halena'),
                'default' => '0'// 1 = on | 0 = off
            ),
            array(
                'id'       => 'footer-colophon-bg-color',
                'type'     => 'color_rgba',
                'required' => array('footer-text-choice', '=', '1'),
                'title'    => esc_html__( 'Footer Colophon Background color', 'halena' ),
                'subtitle' => esc_html__( 'You can even set the Transparency to the background color.', 'halena' ),
                'default'  => array(
                    'color' => '#f6f6f6',
                    'alpha' => '1'
                ),
                'output'   => array( '.site-footer' ),
                'mode'     => 'background',
                'validate' => 'colorrgba',
            ),
            array(
                'id' => 'footer-logo',
                'type' => 'media',
                'required' => array('footer-text-choice', '=', '1'),
                'title' => esc_html__('Footer Logo', 'halena'),
                'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                //'desc' => esc_html__('Basic media uploader with disabled URL input field.', 'halena'),
                'url' => true,
                'subtitle' => esc_html__('Here, you can upload logo to display in the footer.', 'halena'),
            ),
            array(
                'id'             => 'footer-logo-padding',
                'type'           => 'spacing',
                'required' => array('footer-text-choice', '=', '1'),
                // An array of CSS selectors to apply this font style to
                'mode'           => 'padding',
                // absolute, padding, margin, defaults to padding
                'all'            => false,
                // Have one field that applies to all
                'right'         => false,     // Disable the right
                'left'          => false,     // Disable the left
                'units'          => array( 'em', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
                'units_extended' => 'true',    // Allow users to select any type of unit
                'title'          => esc_html__( 'Logo Top/Bottom inner Padding', 'halena' ),
                'subtitle'       => esc_html__( 'Here, you can set padding to the logo image. it will add space inside the logo.', 'halena' ),
                'desc'           => esc_html__( 'Note: it won\'t affect the height of the footer', 'halena' ),
                'default'        => array(
                    'padding-top'    => '0px',
                    'padding-bottom' => '0px',
                ),
                'output'         => array( '.footer-logo img' )
            ),
            array(
                'id' => 'footer-text',
                'type' => 'editor',
                'required' => array('footer-text-choice', '=', '1'),
                'title' => esc_html__('Footer Text', 'halena'),
                'subtitle' => esc_html__('you can type your footer text/content here..', 'halena'),
                'default' => 'Copyright &copy; 2017 All Rights Reserved. ',
                'args'   => array(
                    'media_buttons'    => false,
                    'textarea_rows'    => 3,
                    'teeny'     => false
                )
            ),
            array(
                'id' => 'footer-nav',
                'type' => 'checkbox',
                'required' => array('footer-text-choice', '=', '1'),
                'title' => esc_html__('Footer Menu', 'halena'),
                'default' => 0, // 1 = on | 0 = off
            ),
            array(
                'id'       => 'footer-menu-link-color',
                'type'     => 'link_color',
                'required' => array('footer-nav', '=', '1'),
                'title'    => esc_html__( 'Footer Menu Links Color', 'halena' ),
                'subtitle' => esc_html__( 'Just choose you color for regular & hover links. its applicable only on menu items.', 'halena' ),
                'active'    => false, // Disable Active Color
                'default'  => array(
                    'regular' => '#555555',
                    'hover'   => '#1e1e20',
                ),
                'output'   => array( '.footer-nav-menu a' ),
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Widget bar', 'halena' ),
        'id'         => 'footer-widget-options',
        'subsection' => true,
        'desc'       => esc_html__( 'Here, you can control the widget bar inside the footer.', 'halena' ),
        'fields' => array(
            array(
                'id' => 'footer-bar',
                'type' => 'switch',
                'title' => esc_html__('Footer Bar', 'halena'),
                'subtitle' => esc_html__('Disable footer widget by turning off', 'halena'),
                "default" => 0,
            ),
            array(
                'id' => 'footer-bar-choice',
                'type' => 'radio',
                'required' => array('footer-bar', '=', '1'),
                'title' => esc_html__('Footer Bar Choice', 'halena'),
                'options' => array(
                    '0' => 'Widget Bar', 
                    '1' => 'Content Block',
                ), //Must provide key => value pairs for select options
                "default" => '0',
            ),
            array(
                'id' => 'footer-contentblock-choice',
                'type' => 'select',
                'required' => array('footer-bar-choice', '=', '1'),
                'title' => esc_html__('Footer Bar Choice', 'halena'),
                'options' => agni_posttype_options( array( 'post_type' => 'agni_block'), false ), //Must provide key => value pairs for select options
                "default" => '',
            ),
            array(
                'id' => 'footer-bar-fullwidth',
                'type' => 'checkbox',
                'required' => array('footer-bar-choice', '=', '0'),
                'title' => esc_html__('Fullwidth', 'halena'),
                'subtitle' => esc_html__('It will make the footer width 100%.', 'halena'),
                'default' => '0'// 1 = on | 0 = off
            ),
            array(
                'id' => 'footer-col',
                'type' => 'select',
                'required' => array('footer-bar-choice', '=', '0'),
                'title' => esc_html__('Footer Widget Columns', 'halena'),
                'options' => array(
                    '2' => '2 Columns', 
                    '3' => '3 Columns', 
                    '4' => '4 Columns',
                    '5' => '5 Columns',
                    '6' => '6 Columns',
                ), //Must provide key => value pairs for select options
                'default' => '3'
            ),
            array(
                'id' => 'footer-background',
                'type' => 'background',
                'required' => array('footer-bar', '=', '1'),
                'output' => array('.footer-bar'),
                'title' => esc_html__('Footer Bar background', 'halena'),
                'subtitle' => esc_html__('Pick the background color/image for header ', 'halena'),
                'default' => array( 'background-color' => '#f6f6f6', ),
            ), 
            
            array(
                'id' => 'footerbar-color-1',
                'type' => 'color',
                'required' => array('footer-bar-choice', '=', '0'),
                'transparent' => false,
                'output' => array( '.footer-bar .widget-title' ), 
                'title' => esc_html__('Title color ', 'halena'),
                'subtitle' => esc_html__('Pick the title font color..', 'halena'),
                'default' => '#333333',
                'validate' => 'color',
            ),
            array(
                'id' => 'footerbar-color-2',
                'type' => 'color',
                'required' => array('footer-bar-choice', '=', '0'),
                'transparent' => false,
                'output' => array( '.footer-bar .widget, .footer-bar .widget i' ), 
                'title' => esc_html__('Text color ', 'halena'),
                'subtitle' => esc_html__('Pick the text font color..', 'halena'),
                'default' => '#555555',
                'validate' => 'color',
            ),
            array(
                'id'       => 'footerbar-color-3',
                'type'     => 'link_color',
                'required' => array('footer-bar-choice', '=', '0'),
                'title'    => esc_html__( 'Links Color', 'halena' ),
                'subtitle' => esc_html__( 'Just choose you color for regular & hover links.', 'halena' ),
                'active'    => false, // Disable Active Color
                'default'  => array(
                    'regular' => '#333333',
                    'hover'   => '#333333',
                ),
                'output'   => array( '.footer-bar .widget a' ),
            ),
        )
    ));

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Social Media', 'halena' ),
        'id'         => 'footer-social-media-icons',
        'subsection' => true,
        'desc'       => esc_html__( 'Here, you can enable/disable, sort the social media icons in footer.', 'halena' ),
        'fields' => array(
            array(
                'id' => 'social-media-footer',
                'type' => 'switch',
                'title' => esc_html__('Social Media Icons', 'halena'),
                'subtitle' => esc_html__('enable this to show the list of social media icons to display in the footer', 'halena'),
                "default" => 1,
                'on' => 'Enable',
                'off' => 'Disable',
            ),
            array(
                'id' => 'social-media-style',
                'type' => 'select',
                'required' => array('social-media-footer', '=', '1'),
                'title' => esc_html__('Social Media Icons Style', 'halena'),
                'options' => array(
                    'no-circled' => 'Default', 
                    'circled' => 'Circled',
                ), //Must provide key => value pairs for select options
                'default' => 'no-circled'
            ),
            array(
                'id'       => 'footer-social-link-color',
                'type'     => 'link_color',
                'required' => array('social-media-footer', '=', '1'),
                'title'    => esc_html__( 'Footer Social Links Color', 'halena' ),
                'active'    => false, // Disable Active Color
                'default'  => array(
                    'regular' => '#333333',
                    'hover'   => '#1e1e20',
                ),
            ),
            array(
                'id' => 'footer-link-target',
                'required' => array('social-media-footer', '=', '1'),
                'type' => 'select',
                'title' => esc_html__('Link target', 'halena'),
                'subtitle' => esc_html__('Choose the target of the icon when clicked.', 'halena'),
                'options' => array(
                    '_self' => 'Same window', 
                    '_blank' => 'New window',
                ), //Must provide key => value pairs for select options
                'default' => '_self'
            ),
            array(
                'id'       => 'social-media-icons-footer',
                'type'     => 'sortable',
                'required' => array('social-media-footer', '=', '1'),
                'mode'     => 'checkbox', // checkbox or text
                'title'    => esc_html__( 'Choose your icons', 'halena' ),
                'subtitle' => esc_html__( 'Enable the Social icon which you want to display in footer', 'halena' ),
                'options'  => array(
                    'facebook' => 'Facebook',
                    'twitter' => 'Twitter',
                    'google-plus' => 'Google Plus',
                    'bitbucket' => 'BitBucket',
                    'behance' => 'Behance',
                    'dribbble' => 'Dribbble',
                    'flickr' => 'Flickr',
                    'github' => 'GitHub',
                    'instagram' => 'instagram',
                    'linkedin' => 'Linkedin',
                    'pinterest' => 'Pinterest',
                    'reddit' => 'Reddit',
                    'soundcloud' => 'SoundCloud',
                    'skype' => 'Skype',
                    'stack-overflow' => 'StackOverflow',
                    'tumblr' => 'Tumblr',
                    'vimeo' => 'Vimeo',
                    'vk' => 'VK',
                    'weibo' => 'Weibo',
                    'whatsapp' => 'WhatsApp',
                    'youtube' => 'YouTube',
                ),
                'default'  => array(
                    'facebook' => true,
                    'twitter' => true,
                    'google-plus' => false,
                    'bitbucket' => false,
                    'behance' => false,
                    'dribbble' => true,
                    'flickr' => false,
                    'github' => false,
                    'instagram' => false,
                    'linkedin' => false,
                    'pinterest' => false,
                    'reddit' => false,
                    'soundcloud' => false,
                    'skype' => false,
                    'stack-overflow' => false,
                    'tumblr' => false,
                    'vimeo' => false,
                    'vk' => false,
                    'weibo' => false,
                    'whatsapp' => false,
                    'youtube' => false,
                )
            ),       
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Page Settings', 'halena' ),
        'id'    => 'page-settings',
        'icon'  => 'el el-tint',
        'desc' => esc_html__('you can override the below settings at each page.', 'halena'),
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Page', 'halena' ),
        'id'         => 'page-options',
        'subsection' => true,
        'desc'       => esc_html__( 'This allows you setup the blog layout, sidebar, etc.', 'halena' ),
        'fields' => array(
            
            array(
                'id' => 'page-layout',
                'type' => 'image_select',
                'title' => esc_html__('Page Layout', 'halena'),
                'subtitle' => esc_html__('Choose your desired page layout.', 'halena'),
                'options' => array(
                    'container' => 'Container', 
                    'container-fluid' => 'Fullwidth',
                ), //Must provide key => value pairs for select options
                'options' => array(                            
                    'container' => array('alt' => 'Container', 'title' => 'Container', 'img' => AGNI_FRAMEWORK_URL . '/template/img/layout-1.png'),
                    'container-fluid' => array('alt' => 'Fullwidth', 'title' => 'Fullwidth', 'img' => AGNI_FRAMEWORK_URL . '/template/img/layout-2.png'),
                ), //Must provide key => value(array:title|img) pairs for radio options
                'default' => 'container'
            ),
            array(
                'id' => 'page-sidebar',
                'type'     => 'radio',
                'title' => esc_html__('Page Sidebar', 'halena'),
                'options' => array(
                    'no-sidebar' => 'No Sidebar', 
                    'has-sidebar' => 'Right Sidebar',
                    'has-sidebar left' => 'Left Sidebar',
                ), //Must provide key => value pairs for select options
                'default' => 'no-sidebar'
            ),
            array(
                'id' => 'page-remove-title',
                'type' => 'checkbox',
                'title' => esc_html__('Remove Title', 'halena'),
                'subtitle' => esc_html__('It will remove the default title on each page.', 'halena'),
                'default' => '1'// 1 = on | 0 = off
            ),
            array(
                'id' => 'page-title-align',
                'type' => 'radio',
                'required' => array('page-remove-title', '=', '0'),
                'title' => esc_html__('Page Title Alignment', 'halena'),
                'options' => array(
                    'left' => esc_html__('Left', 'halena'),
                    'center' => esc_html__('Center', 'halena'), 
                    'right' => esc_html__('Right', 'halena'), 
                ), 
                'default' => 'left'
            ),
            
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Blog Single', 'halena' ),
        'id'         => 'page-blog-single-options',
        'subsection' => true,
        'desc'       => esc_html__( 'This allows you setup the blog layout, sidebar, etc.', 'halena' ),
        'fields' => array(
            array(
                'id' => 'blog-single-layout',
                'type' => 'image_select',
                'title' => esc_html__('Blog Single Layout', 'halena'),
                'subtitle' => esc_html__('Choose your desired blog single layout.', 'halena'),
                'options' => array(
                    'container' => 'Container', 
                    'container-fluid' => 'Fullwidth',
                ), //Must provide key => value pairs for select options
                'options' => array(                            
                    'container' => array('alt' => 'Container', 'title' => 'Container', 'img' => AGNI_FRAMEWORK_URL . '/template/img/layout-1.png'),
                    'container-fluid' => array('alt' => 'Fullwidth', 'title' => 'Fullwidth', 'img' => AGNI_FRAMEWORK_URL . '/template/img/layout-2.png'),
                ), //Must provide key => value(array:title|img) pairs for radio options
                'default' => 'container'
            ),
            array(
                'id' => 'blog-single-sidebar',
                'type'     => 'radio',
                'title' => esc_html__('Blog Single Sidebar', 'halena'),
                'options' => array(
                    'no-sidebar' => 'No Sidebar', 
                    'has-sidebar' => 'Right Sidebar',
                    'has-sidebar left' => 'Left Sidebar',
                ), //Must provide key => value pairs for select options
                'default' => 'no-sidebar'
            ),
            array(
                'id' => 'blog-single-remove-title',
                'type' => 'checkbox',
                'title' => esc_html__('Remove Title', 'halena'),
                'subtitle' => esc_html__('It will remove the default title on each blog single.', 'halena'),
                'default' => '0'// 1 = on | 0 = off
            ),
            array(
                'id' => 'blog-single-title-align',
                'type' => 'radio',
                'required' => array('blog-single-remove-title', '=', '0'),
                'title' => esc_html__('Title Alignment', 'halena'),
                'options' => array(
                    'left' => esc_html__('Left', 'halena'),
                    'center' => esc_html__('Center', 'halena'), 
                    'right' => esc_html__('Right', 'halena'), 
                ), 
                'default' => 'center'
            ),
        )
    ) );
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Portfolio Single', 'halena' ),
        'id'         => 'page-portfolio-single-options',
        'subsection' => true,
        'desc'       => esc_html__( 'This allows you setup the portfolio layout, sidebar, etc.', 'halena' ),
        'fields' => array(
            array(
                'id' => 'portfolio-single-layout',
                'type' => 'image_select',
                'title' => esc_html__('Portfolio Single Layout', 'halena'),
                'subtitle' => esc_html__('Choose your desired portfolio single layout.', 'halena'),
                'options' => array(
                    'container' => 'Container', 
                    'container-fluid' => 'Fullwidth',
                ), //Must provide key => value pairs for select options
                'options' => array(                            
                    'container' => array('alt' => 'Container', 'title' => 'Container', 'img' => AGNI_FRAMEWORK_URL . '/template/img/layout-1.png'),
                    'container-fluid' => array('alt' => 'Fullwidth', 'title' => 'Fullwidth', 'img' => AGNI_FRAMEWORK_URL . '/template/img/layout-2.png'),
                ), //Must provide key => value(array:title|img) pairs for radio options
                'default' => 'container'
            ),
            array(
                'id' => 'portfolio-single-remove-title',
                'type' => 'checkbox',
                'title' => esc_html__('Remove Title', 'halena'),
                'subtitle' => esc_html__('It will remove the default title on each portfolio single.', 'halena'),
                'default' => '0'// 1 = on | 0 = off
            ),
            array(
                'id' => 'portfolio-single-title-align',
                'type' => 'radio',
                'required' => array('portfolio-single-remove-title', '=', '0'),
                'title' => esc_html__('Title Alignment', 'halena'),
                'options' => array(
                    'left' => esc_html__('Left', 'halena'),
                    'center' => esc_html__('Center', 'halena'), 
                    'right' => esc_html__('Right', 'halena'), 
                ), 
                'default' => 'left'
            ),
        )
    ) );
    if( class_exists( 'WooCommerce' ) ){
        Redux::setSection( $opt_name, array(
            'title'      => esc_html__( 'Shop Single', 'halena' ),
            'id'         => 'page-shop-single-options',
            'subsection' => true,
            'desc'       => esc_html__( 'This allows you setup the shop layout, sidebar, etc.', 'halena' ),
            'fields' => array(
                array(
                    'id' => 'shop-single-description-stretch',
                    'type' => 'image_select',
                    'title' => esc_html__('Shop Description Stretch', 'halena'),
                    'subtitle' => esc_html__('Choose your product page description width.', 'halena'),
                    'options' => array(
                        'container' => 'Container', 
                        'container-fluid' => 'Fullwidth',
                    ), //Must provide key => value pairs for select options
                    'options' => array(                            
                        'container' => array('alt' => 'Container', 'title' => 'Container', 'img' => AGNI_FRAMEWORK_URL . '/template/img/layout-1.png'),
                        'container-fluid' => array('alt' => 'Fullwidth', 'title' => 'Fullwidth', 'img' => AGNI_FRAMEWORK_URL . '/template/img/layout-2.png'),
                    ), //Must provide key => value(array:title|img) pairs for radio options
                    'default' => 'container'
                ),
                array(
                    'id' => 'shop-single-sidebar',
                    'type'     => 'radio',
                    'title' => esc_html__('Shop Single Sidebar', 'halena'),
                    'options' => array(
                        'no-sidebar' => 'No Sidebar', 
                        'has-sidebar' => 'Right Sidebar',
                        'has-sidebar left' => 'Left Sidebar',
                    ), //Must provide key => value pairs for select options
                    'default' => 'no-sidebar'
                ),
            )
        ) );
    }

    Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Blog Settings', 'halena' ),
        'id'    => 'blog-settings',
        'icon'  => 'el el-bookmark'
    ) );
    
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'General', 'halena' ),
        'id'         => 'blog-general-options',
        'subsection' => true,
        'desc'       => esc_html__( 'This allows you setup the blog layout, sidebar, etc.', 'halena' ),
        'fields' => array(
            
            array(
                'id' => 'blog-layout',
                'type' => 'select',
                'title' => esc_html__('Blog Layout', 'halena'),
                'options' => array(
                    'standard' => 'Standard', 
                    'grid' => 'Grid',
                    'modern' => 'Modern Grid',
                    'list' => 'List',
                    'minimal-list' => 'Minimal List',
                ), //Must provide key => value pairs for select options
                'default' => 'standard'
            ),
            array(
                'id' => 'blog-layout-grid-style',
                'type' => 'select',
                'required' => array('blog-layout', '=', 'grid'),
                'title' => esc_html__('Grid Style', 'halena'),
                'options' => array(
                    '1' => 'Style 1', 
                    '2' => 'Style 2',
                ), //Must provide key => value pairs for select options
                'default' => '1'
            ),
            
            array(
                'id' => 'blog-column-layout',
                'type' => 'image_select',
                'required' => array(
                    array( 'blog-layout', '!=', 'standard'),
                    array( 'blog-layout', '!=', 'list'),
                    array( 'blog-layout', '!=', 'minimal-list'),
                ),
                'title' => esc_html__('Blog Column Count', 'halena'),
                'desc' => esc_html__('Choose a column count for your blog', 'halena'),
                'options' => array(                            
                    '1' => array('alt' => '1 Column', 'img' => AGNI_FRAMEWORK_URL . '/template/img/portfolio-1c.png'),
                    '2' => array('alt' => '2 Column', 'img' => AGNI_FRAMEWORK_URL . '/template/img/portfolio-2c.png'),
                    '3' => array('alt' => '3 Column', 'img' => AGNI_FRAMEWORK_URL . '/template/img/portfolio-3c.png'),
                    '4' => array('alt' => '4 Column', 'img' => AGNI_FRAMEWORK_URL . '/template/img/portfolio-4c.png'),
                    '5' => array('alt' => '5 Column', 'img' => AGNI_FRAMEWORK_URL . '/template/img/portfolio-5c.png'),
                ), //Must provide key => value(array:title|img) pairs for radio options
                'default' => '3'
            ),
            array(
                'id' => 'blog-excerpt-length',
                'type' => 'text',
                'required' => array(
                    array( 'blog-layout', '!=', 'modern'),
                    array( 'blog-layout', '!=', 'minimal-list'),
                ),
                'title' => esc_html__('Post Excerpt Length', 'halena'),
                'subtitle' => esc_html__('It will display the excerpt content with your desired length.', 'halena'),
                'default' => '150'// 1 = on | 0 = off
            ),
           
            array(
                'id' => 'blog-content-align',
                'type' => 'radio',
                'required' => array( 
                    array( 'blog-layout', '!=', 'modern' ), 
                    array( 'blog-layout', '!=', 'minimal-list' )
                ),
                'title' => esc_html__('Content Alignment', 'halena'),
                'desc' => esc_html__('Select the content to be aligned.', 'halena'),
                'options' => array(
                    'left' => 'Left',            
                    'center' => 'Center',
                    'right' => 'Right',
                ), //Must provide key => value(array:title|img) pairs for radio options
                'default' => 'left'// 1 = on | 0 = off
            ),
            array(
                'id'       => 'blog-grid-layout',
                'type'     => 'radio',
                'required' => array(
                    array( 'blog-layout', '!=', 'standard'),
                    array( 'blog-layout', '!=', 'list'),
                    array( 'blog-layout', '!=', 'minimal-list'),
                ),
                'title'    => esc_html__( 'Blog Grid Style', 'halena' ),
                'subtitle' => esc_html__( 'Choose any of one grid style. fitRows is default.', 'halena' ),
                //Must provide key => value pairs for radio options
                'options'  => array(
                    'fitRows' => 'FitRows(Default Grid)',
                    'masonry' => 'Masonry',
                ),
                'default'  => 'fitRows'
            ),

            array(
                'id' => 'blog-sidebar',
                'type'     => 'radio',
                'title' => esc_html__('Blog Sidebar', 'halena'),
                'options' => array(
                    'no-sidebar' => 'No Sidebar', 
                    'has-sidebar' => 'Right Sidebar',
                    'has-sidebar left' => 'Left Sidebar',
                ), //Must provide key => value pairs for select options
                'default' => 'has-sidebar'
            ),
            array(
                'id' => 'blog-fullwidth-layout',
                'type' => 'checkbox',
                'title' => esc_html__('Fullwidth', 'halena'),
                'subtitle' => esc_html__('It uses the 100% of the screen width to display the content.', 'halena'),
                'default' => '0'// 1 = on | 0 = off
            ),
            array(
                'id' => 'blog-carousel',
                'type' => 'switch',
                'title' => esc_html__('Blog Carousel', 'halena'),
                'subtitle' => esc_html__('It will display the blog items inside the carousel.', 'halena'),
                'default' => '0'// 1 = on | 0 = off
            ),
            array(
                'id' => 'blog-carousel-autoplay',
                'type' => 'checkbox',
                'required' => array('blog-carousel', '=', '1'),
                'title' => esc_html__('Autoplay', 'halena'),
                'default' => '1'// 1 = on | 0 = off
            ),

            array(
                'id' => 'blog-carousel-autoplay-timeout',
                'type' => 'slider',
                'required' => array('blog-carousel-autoplay', '=', '1'),
                'title' => esc_html__('Autoplay Timeout', 'halena'),
                "default" => "4000",
                "min" => "400",
                "step" => "100",
                "max" => "10000",
            ),
            array(
                'id' => 'blog-carousel-autoplay-speed',
                'type' => 'slider',
                'required' => array('blog-carousel-autoplay', '=', '1'),
                'title' => esc_html__('Autoplay Speed', 'halena'),
                "default" => "600",
                "min" => "50",
                "step" => "10",
                "max" => "2000",
            ),
            array(
                'id' => 'blog-carousel-autoplay-hover',
                'type' => 'checkbox',
                'required' => array('blog-carousel-autoplay', '=', '1'),
                'title' => esc_html__('Stop on Hover', 'halena'),
                'desc' => esc_html__('It will stop the carousel when you hover the carousel elements.', 'halena'),
                'default' => '1'// 1 = on | 0 = off
            ),
            array(
                'id' => 'blog-carousel-loop',
                'type' => 'checkbox',
                'required' => array('blog-carousel', '=', '1'),
                'title' => esc_html__('Loop', 'halena'),
                'default' => '1'// 1 = on | 0 = off
            ),
            array(
                'id' => 'blog-carousel-pagination',
                'type' => 'checkbox',
                'required' => array('blog-carousel', '=', '1'),
                'title' => esc_html__('Pagination Dots', 'halena'),
                'default' => '1'// 1 = on | 0 = off
            ),
            array(
                'id' => 'blog-carousel-navigation',
                'type' => 'checkbox',
                'required' => array('blog-carousel', '=', '1'),
                'title' => esc_html__('Navigation Arrows', 'halena'),
                'default' => '0'// 1 = on | 0 = off
            ),

            array(
                'id' => 'blog-gutter',
                'type' => 'checkbox',
                'required' => array(
                    array( 'blog-layout', '!=', 'standard'),
                    array( 'blog-layout', '!=', 'list'),
                    array( 'blog-layout', '!=', 'minimal-list'),
                ),
                'title' => esc_html__('Gutter', 'halena'),
                'subtitle' => esc_html__('It will bring some space in between the items horizontally.', 'halena'),
                'default' => '1'// 1 = on | 0 = off
            ),
            array(
                'id' => 'blog-gutter-value',
                'type' => 'text',
                'required' => array('blog-gutter', '=', '1'),
                'title' => esc_html__('Gutter Value', 'halena'),
                'subtitle' => esc_html__('Enter the space you want to add between each item.', 'halena'),
                'default' => '30'// 1 = on | 0 = off
            ),

            array(
                'id'       => 'blog-thumbnail-choice',
                'type'     => 'radio',
                'title'    => esc_html__( 'Blog Thumbnails Choice', 'halena' ),
                'subtitle' => esc_html__( 'Choose any of one featured image size.', 'halena' ),
                //Must provide key => value pairs for radio options
                'options'  => array(
                    'halena-post-thumbnail' => 'Post Thumbnail (960x520)',
                    'halena-standard-thumbnail' => 'Standard Thumbnail (960xauto)',
                    'custom' => 'Custom',
                ),
                'default'  => 'halena-post-thumbnail'
            ),
            array(
                'id' => 'blog-thumbnail-dimension-custom',
                'type' => 'text',
                'required' => array('blog-thumbnail-choice', '=', 'custom'),
                'title' => esc_html__('Thumbnails Crop Size', 'halena'),
                'subtitle' => esc_html__('You can mention your own dimension for ex. 640x640', 'halena'),
                'desc' => esc_html__('Set the maximum width & height of a thumbnail. Note: it may not be an actual image size but the ratio will be the same.', 'halena'),
                'default' => '640x640',
            ),

            array(
                'id' => 'blog-thumbnail-gs-filter',
                'type' => 'checkbox',
                'title' => esc_html__('Thumbnail Grayscale', 'halena'),
                'subtitle' => esc_html__('It will change the thumbnail to grayscale(black&white). Note: It will not work on IE browsers', 'halena'),
                'default' => '0'// 1 = on | 0 = off
            ),

            array(
                'id' => 'blog-thumbnail-clickable',
                'type' => 'checkbox',
                'title' => esc_html__('Thumbnail Clickable', 'halena'),
                'subtitle' => esc_html__('It will make blog thumbnail clickable & set the post thumbnails to open corresponding post.', 'halena'),
                'default' => '0'// 1 = on | 0 = off
            ),
            array(
                'id'       => 'blog-navigation',
                'type'     => 'radio',
                'title'    => esc_html__( 'Blog Navigation Style', 'halena' ),
                'subtitle' => esc_html__( 'Choose any of one navigation style to display on the blog page.', 'halena' ),
                //Must provide key => value pairs for radio options
                'options'  => array(
                    '1' => 'Classic',
                    '2' => 'Number',
                    '3' => 'Infinite',
                    '4' => 'Infinite & Load More button',
                ),
                'default'  => '1'
            ),
            array(
                'id' => 'blog-navigation',
                'type' => 'switch',
                'required' => array('blog-carousel', '=', '0'),
                'title' => esc_html__('Blog Navigation', 'halena'),
                'desc' => esc_html__('It will enable the navigation link on blog page..', 'halena'),
                'default' => '1'// 1 = on | 0 = off
            ),
            array(
                'id'       => 'blog-navigation-choice',
                'type'     => 'radio',
                'required' => array('blog-navigation', '=', '1'),
                'title'    => esc_html__( 'Blog Navigation Style', 'halena' ),
                'subtitle' => esc_html__( 'Choose any of one navigation style to display on the blog page.', 'halena' ),
                //Must provide key => value pairs for radio options
                'options'  => array(
                    '1' => 'Classic',
                    '2' => 'Number',
                    '3' => 'Infinite',
                    '4' => 'Infinite & Load More button',
                ),
                'default'  => '1'
            ),

            array(
                'id' => 'blog-navigation-ifs-load-text',
                'type' => 'text',
                'required' => array(
                    array( 'blog-navigation-choice', '!=', '1'),
                    array( 'blog-navigation-choice', '!=', '2'),
                ),
                'title' => esc_html__('Text to show on loading.', 'halena'),
                'default' => esc_html__('Loading', 'halena'),
            ),
            array(
                'id' => 'blog-navigation-ifs-finish-text',
                'type' => 'text',
                'required' => array(
                    array( 'blog-navigation-choice', '!=', '1'),
                    array( 'blog-navigation-choice', '!=', '2'),
                ),
                'title' => esc_html__('Text to show at the end of page.', 'halena'),
                'default' => esc_html__('No More Posts', 'halena'),
            ),

            array(
                'id' => 'blog-navigation-ifs-btn-text',
                'type' => 'text',
                'required' => array('blog-navigation-choice', '=', '4'),
                'title' => esc_html__('Button Text', 'halena'),
                'default' => esc_html__('Load More', 'halena'),
            ),
            
            array(
                'id' => 'blog-animation',
                'type' => 'switch',
                'title' => esc_html__('Blog Animation', 'halena'),
                'subtitle' => esc_html__('It will enable the animation for your blog.', 'halena'),
                'desc' => esc_html__('This animation will show the items one by one only when it reaches the viewport.', 'halena'),
                'default' => '0'// 1 = on | 0 = off
            ),
            array(
                'id' => 'blog-animation-style',
                'type' => 'select',
                'required' => array('blog-animation', '=', '1'),
                'title' => esc_html__('Animation Style', 'halena'),
                'options' => array(
                    'fadeIn' => esc_html__('fadeIn', 'halena'),
                    'fadeInDown' => esc_html__('fadeInDown', 'halena'),
                    'fadeInUp' => esc_html__('fadeInUp', 'halena'),
                    'fadeInRight' => esc_html__('fadeInRight', 'halena'),
                    'fadeInLeft' => esc_html__('fadeInLeft', 'halena'),
                    'flipInX' => esc_html__('flipInX', 'halena'),
                    'flipInY' => esc_html__('flipInY', 'halena'),
                    'zoomIn' => esc_html__('zoomIn', 'halena'),
                ), //Must provide key => value pairs for select options
                'default' => 'fadeInUp'
            ),
            array(
                'id' => 'blog-animation-duration',
                'type' => 'text',
                'required' => array('blog-animation', '=', '1'),
                'title' => esc_html__('Animation Duration ', 'halena'),
                'desc' => esc_html__('Enter the value in seconds. for ex. 0.6', 'halena'),
                'validate' => 'numeric',
                "default" => "0.8",
            ),

            array(
                'id' => 'blog-animation-delay',
                'type' => 'text',
                'required' => array('blog-animation', '=', '1'),
                'title' => esc_html__('Animation Delay ', 'halena'),
                'desc' => esc_html__('Enter the value in seconds. for ex. 0.6', 'halena'),
                'validate' => 'numeric',
                "default" => "0.4",
            ),
            array(
                'id' => 'blog-animation-offset',
                'type' => 'slider',
                'required' => array('blog-animation', '=', '1'),
                'title' => esc_html__('Animation Offset ', 'halena'),
                'desc' => esc_html__('animation will be triggered only when blog reaches particular percentage on viewport', 'halena'),
                "default" => "90",
                "min" => "20",
                "step" => "5",
                "max" => "100",
            ),

        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Posttype Settings', 'halena' ),
        'id'         => 'blog-posttype-options',
        'subsection' => true,
        'desc'       => esc_html__( 'This allows you setup the blog layout, sidebar, etc.', 'halena' ),
        'fields' => array(
            array(
                'id' => 'blog-per-page',
                'type' => 'text',
                'title' => esc_html__('Number of Blog items per page', 'halena'),
                'subtitle' => esc_html__('type the number of post to show in a blog page', 'halena'),
                'validate' => 'numeric',
                'default' => '6',
                'class' => 'text'
            ),
            array(
                'id'       => 'blog-categories',
                'type'     => 'select',
                'multi'    => true,
                'data'     => 'categories',
                'title'    => esc_html__( 'Choose the categories to display', 'halena' ),
                'desc' => esc_html__( 'You can select multiple categories. leave it empty to display all categories', 'halena' ),
                'default' => ''
            ),
            
            array(
                'id' => 'blog-post-include',
                'type' => 'text',
                'title' => esc_html__('Blog Items include', 'halena'),
                'subtitle' => esc_html__('you can exclude the items by typing post ids for ex. 70, 45', 'halena'),
                'default' => '',
                'class' => 'text'
            ),

            array(
                'id' => 'blog-post-exclude',
                'type' => 'text',
                'title' => esc_html__('Blog Items exclude', 'halena'),
                'subtitle' => esc_html__('you can exclude the items by typing post ids for ex. 60', 'halena'),
                'desc' => esc_html__('If this is used in the same query as blog item, it will be ignored', 'halena'),
                'default' => '',
                'class' => 'text'
            ),

            array(
                'id' => 'blog-post-order',
                'type' => 'select',
                'title' => esc_html__('Blog items Order', 'halena'),
                'desc' => esc_html__('Blog posts sorting order.', 'halena'),
                'options' => array(
                    'DESC' => esc_html__('Descending', 'halena'),
                    'ASC' => esc_html__('Ascending', 'halena'), 
                ), //Must provide key => value pairs for select options
                'default' => 'DESC'
            ),
            array(
                'id' => 'blog-post-orderby',
                'type' => 'select',
                'title' => esc_html__('Blog Items Orderby', 'halena'),
                'desc' => esc_html__('Blog posts sorting orderby.', 'halena'),
                'options' => array(
                    'none' => esc_html__('None', 'halena'),
                    'id' => esc_html__('Post ID', 'halena'),
                    'author' => esc_html__('Post Author', 'halena'),
                    'title' => esc_html__('Post Title', 'halena'),
                    'name' => esc_html__('Post Slug', 'halena'),
                    'date' => esc_html__('Date', 'halena'),
                    'modified' => esc_html__('Last Modified Date', 'halena'),
                    'rand' => esc_html__('Random', 'halena'),
                    'comment_count' => esc_html__('comment-count', 'halena'),
                    'menu_order' => esc_html__('menu_order', 'halena'),
                ), //Must provide key => value pairs for select options
                'default' => 'date'
            ),
            array(
                'id'       => 'blog-posttype-slug',
                'type'     => 'text',
                'title'    => esc_html__( 'Custom Blog Slug Name', 'halena' ),
                'subtitle' => wp_kses( __( 'It will change the existing url prefix "blog". Once you changed the custom slug, its mandatory to perform <a href="#">flush_rewrite_rules</a>.', 'halena' ), array( 'a' => array( 'href' => array() ) ) ),
                'default'  => '',
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Singles', 'halena' ),
        'id'         => 'blog-single-options',
        'subsection' => true,
        'desc'       => esc_html__( 'Here, you can enable/disable some of the necessary share icons.', 'halena' ),
        'fields' => array(
            
            array(
                'id' => 'blog-single-thumbnail',
                'type' => 'switch',
                'title' => esc_html__('Blog Single Thumbnail', 'halena'),
                'subtitle' => esc_html__('It enables the post thumbnail(if any) on the post.', 'halena'),
                "default" => 1,
            ),

            array(
                'id' => 'author-biography',
                'type' => 'switch',
                'title' => esc_html__('Author Biography', 'halena'),
                'subtitle' => esc_html__('It enables the author biography on each post.', 'halena'),
                "default" => 0,
            ),
            array(
                'id' => 'author-biography-title',
                'type' => 'text',
                'required' => array('author-biography', '=', '1'),
                'title' => esc_html__('Author Biography Title', 'halena'),
                'subtitle' => esc_html__('you can use the Word Next or Newer', 'halena'),
                'default' => '',
            ),
            
            array(
                'id' => 'blog-single-prev',
                'type' => 'text',
                'title' => esc_html__('Blog single Previous Text ', 'halena'),
                'subtitle' => esc_html__('you can use the Word Previous or Older', 'halena'),
                'default' => 'Prev',
                'class' => 'text'
            ),
            
            array(
                'id' => 'blog-single-next',
                'type' => 'text',
                'title' => esc_html__('Blog single Next Text ', 'halena'),
                'subtitle' => esc_html__('you can use the Word Next or Newer', 'halena'),
                'default' => 'Next',
                'class' => 'text'
            ),
            
            array(
                'id' => 'blog-sharing-panel',
                'type' => 'switch',
                'title' => esc_html__('Blog Sharing icons', 'halena'),
                'subtitle' => esc_html__('This option enable the sharing panel at the bottom of every post.', 'halena'),
                'default' => 1, // 1 = on | 0 = off
                'on' => 'Enable',
                'off' => 'Disable',
            ),
            array(
                'id' => 'blog-sharing-label',
                'type' => 'text',
                'required' => array('blog-sharing-panel', '=', '1'),
                'title' => esc_html__('Sharing Label', 'halena'),
                'default' => esc_html__('Share :', 'halena'),
            ),
            array(
                'id'       => 'blog-sharing-icons',
                'type'     => 'checkbox',
                'required' => array('blog-sharing-panel', '=', '1'),
                'title'    => esc_html__( 'Share Icons', 'halena' ),
                //Must provide key => value pairs for multi checkbox options
                'options'  => array(
                    '1' => 'Facebook',
                    '2' => 'Twitter',
                    '3' => 'Google Plus',
                    '4' => 'Linkedin'
                ),
                //See how std has changed? you also don't need to specify opts that are 0.
                'default'  => array(
                    '1' => '1',
                    '2' => '1',
                    '3' => '1',
                    '4' => '1'
                )
            ),
        )

    ) );

    Redux::setSection( $opt_name, array(
        'icon' => 'el-icon-eye-open',
        'title' => esc_html__('Portfolio Settings', 'halena'),
        'id' => 'portfolio-settings',
    ) );
    
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'General', 'halena' ),
        'id'         => 'portfolio-general-options',
        'subsection' => true,
        'desc'       => esc_html__( 'This option allows you to setup the portfolio grid, layout style. Note: Most of these portfolio settings apply only when you choose portfolio at template attributes', 'halena' ),
        'fields' => array(
            array(
                'id' => 'portfolio-layout',
                'type' => 'image_select',
                'title' => esc_html__('Portfolio Layout(Columns)', 'halena'),
                'subtitle' => esc_html__('Layout for your portfolio page ', 'halena'),
                'desc' => esc_html__('Choose an image to your portfolio page', 'halena'),
                'options' => array(                            
                    '1' => array('alt' => '1 Column', 'img' => AGNI_FRAMEWORK_URL . '/template/img/portfolio-1c.png'),
                    '2' => array('alt' => '2 Column', 'img' => AGNI_FRAMEWORK_URL . '/template/img/portfolio-2c.png'),
                    '3' => array('alt' => '3 Column', 'img' => AGNI_FRAMEWORK_URL . '/template/img/portfolio-3c.png'),
                    '4' => array('alt' => '4 Column', 'img' => AGNI_FRAMEWORK_URL . '/template/img/portfolio-4c.png'),
                    '5' => array('alt' => '5 Column', 'img' => AGNI_FRAMEWORK_URL . '/template/img/portfolio-5c.png'),
                    //'2r' => array('alt' => '2 Row', 'img' => AGNI_FRAMEWORK_URL . '/template/img/portfolio-5c.png'),
                ), //Must provide key => value(array:title|img) pairs for radio options
                'default' => '3'
            ),
            array(
                'id' => 'portfolio-fullwidth',
                'type' => 'checkbox',
                'title' => esc_html__('Fullwidth', 'halena'),
                'subtitle' => esc_html__('If you need fullwidth portfolio section. just enable it.', 'halena'),
                'default' => '0'// 1 = on | 0 = off
            ),

            array(
                'id' => 'portfolio-carousel',
                'type' => 'switch',
                'title' => esc_html__('Portfolio Carousel', 'halena'),
                'subtitle' => esc_html__('It will display the portfolio items inside the carousel.', 'halena'),
                'default' => '0'// 1 = on | 0 = off
            ),
            array(
                'id' => 'portfolio-carousel-autoplay',
                'type' => 'checkbox',
                'required' => array('portfolio-carousel', '=', '1'),
                'title' => esc_html__('Autoplay', 'halena'),
                'default' => '1'// 1 = on | 0 = off
            ),

            array(
                'id' => 'portfolio-carousel-autoplay-timeout',
                'type' => 'slider',
                'required' => array('portfolio-carousel-autoplay', '=', '1'),
                'title' => esc_html__('Autoplay Timeout', 'halena'),
                "default" => "4000",
                "min" => "400",
                "step" => "100",
                "max" => "10000",
            ),
            array(
                'id' => 'portfolio-carousel-autoplay-speed',
                'type' => 'slider',
                'required' => array('portfolio-carousel-autoplay', '=', '1'),
                'title' => esc_html__('Autoplay Speed', 'halena'),
                "default" => "600",
                "min" => "50",
                "step" => "10",
                "max" => "2000",
            ),
            array(
                'id' => 'portfolio-carousel-autoplay-hover',
                'type' => 'checkbox',
                'required' => array('portfolio-carousel-autoplay', '=', '1'),
                'title' => esc_html__('Stop on Hover', 'halena'),
                'desc' => esc_html__('It will stop the carousel when you hover the carousel elements.', 'halena'),
                'default' => '1'// 1 = on | 0 = off
            ),
            array(
                'id' => 'portfolio-carousel-loop',
                'type' => 'checkbox',
                'required' => array('portfolio-carousel', '=', '1'),
                'title' => esc_html__('Loop', 'halena'),
                'default' => '1'// 1 = on | 0 = off
            ),
            array(
                'id' => 'portfolio-carousel-pagination',
                'type' => 'checkbox',
                'required' => array('portfolio-carousel', '=', '1'),
                'title' => esc_html__('Pagination Dots', 'halena'),
                'default' => '1'// 1 = on | 0 = off
            ),
            array(
                'id' => 'portfolio-carousel-navigation',
                'type' => 'checkbox',
                'required' => array('portfolio-carousel', '=', '1'),
                'title' => esc_html__('Navigation Arrows', 'halena'),
                'default' => '0'// 1 = on | 0 = off
            ),

            array(
                'id'       => 'portfolio-grid',
                'type'     => 'radio',
                'required' => array('portfolio-carousel', '=', '0'),
                'title'    => esc_html__( 'Portfolio Masonry Style', 'halena' ),
                'subtitle' => esc_html__( 'You can choose your isotope layout style.', 'halena' ),
                //Must provide key => value pairs for radio options
                'options'  => array(
                    'fitRows' => 'Grid',
                    'masonry' => 'Masonry',
                ),
                'default'  => 'fitRows'
            ),

            array(
                'id' => 'portfolio-gutter',
                'type' => 'checkbox',
                'title' => esc_html__('Gutter', 'halena'),
                'subtitle' => esc_html__('It will bring some space in between the items horizontally.', 'halena'),
                'default' => '1'// 1 = on | 0 = off
            ),
            array(
                'id' => 'portfolio-gutter-value',
                'type' => 'text',
                'required' => array('portfolio-gutter', '=', '1'),
                'title' => esc_html__('Gutter Value', 'halena'),
                'subtitle' => esc_html__('Enter the space you want to add between each item.', 'halena'),
                'validate' => 'numeric',
                'default' => '30'// 1 = on | 0 = off
            ),

            array(
                'id' => 'portfolio-thumbnail-hardcrop',
                'type' => 'checkbox',
                'title' => esc_html__('Portfolio Thumbnails Hard Crop', 'halena'),
                'subtitle' => esc_html__('It will crop all the images by ignoring original dimension of an image.', 'halena'),
                'default' => '0'// 1 = on | 0 = off
            ),
            array(
                'id' => 'portfolio-thumbnail-dimension-custom',
                'type' => 'text',
                'required' => array('portfolio-thumbnail-hardcrop', '=', '1'),
                'title' => esc_html__('Thumbnails Crop Size', 'halena'),
                'subtitle' => esc_html__('You can mention your own dimension for ex. 640x640', 'halena'),
                'desc' => esc_html__('Set the maximum width & height of a thumbnail. Note: it may not be an actual image size but the ratio will be the same.', 'halena'),
                'default' => '640x640',
            ),

            array(
                'id' => 'portfolio-thumbnail-gs-filter',
                'type' => 'checkbox',
                'title' => esc_html__('Thumbnail Grayscale', 'halena'),
                'subtitle' => esc_html__('It will change the thumbnail to grayscale(black&white). Note: It will not work on IE browsers', 'halena'),
                'default' => '0'// 1 = on | 0 = off
            ),

            array(
                'id' => 'portfolio-hover-style',
                'type' => 'image_select',
                'title' => esc_html__('Portfolio Hover style', 'halena'),
                'options' => array(                            
                    '1' => array('alt' => 'Style 1', 'img' => AGNI_FRAMEWORK_URL . '/template/img/portfolio-hover-1.png'),
                    '2' => array('alt' => 'Style 2', 'img' => AGNI_FRAMEWORK_URL . '/template/img/portfolio-hover-2.png'),
                    '3' => array('alt' => 'Style 4', 'img' => AGNI_FRAMEWORK_URL . '/template/img/portfolio-hover-5.png'),
                    '4' => array('alt' => 'Style 6', 'img' => AGNI_FRAMEWORK_URL . '/template/img/portfolio-hover-7.png'),
                    '5' => array('alt' => 'Style 8', 'img' => AGNI_FRAMEWORK_URL . '/template/img/portfolio-hover-10.png'),
                    '6' => array('alt' => 'Style 9', 'img' => AGNI_FRAMEWORK_URL . '/template/img/portfolio-hover-15.png'),
                    '7' => array('alt' => 'Style 10', 'img' => AGNI_FRAMEWORK_URL . '/template/img/portfolio-hover-16.png'),
                ), //Must provide key => value(array:title|img) pairs for radio options
                'default' => '1'
            ),
            array(
                'id'       => 'portfolio-hover-bg-color',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Hover Background color', 'halena' ),
                'validate' => 'colorrgba',
            ),
            array(
                'id' => 'portfolio-hover-color',
                'type' => 'color',
                'transparent' => false,
                'title' => esc_html__('Hover Content color', 'halena'),
                'default' => '',
                'validate' => 'color',
            ),
            array(
                'id' => 'portfolio-hover-show-title',
                'type' => 'checkbox',
                'title' => esc_html__('Hover Portfolio Title', 'halena'),
                'default' => '0'// 1 = on | 0 = off
            ),
            array(
                'id' => 'portfolio-hover-show-title',
                'type' => 'checkbox',
                'title' => esc_html__('Hover Portfolio Title', 'halena'),
                'default' => '1'// 1 = on | 0 = off
            ),
            array(
                'id' => 'portfolio-hover-show-category',
                'type' => 'checkbox',
                'title' => esc_html__('Hover Portfolio Category', 'halena'),
                'default' => '1'// 1 = on | 0 = off
            ),
            array(
                'id' => 'portfolio-hover-show-link',
                'type' => 'checkbox',
                'title' => esc_html__('Hover Portfolio Link', 'halena'),
                'default' => '1'// 1 = on | 0 = off
            ),
            array(
                'id' => 'portfolio-hover-show-attachment-link',
                'type' => 'checkbox',
                'title' => esc_html__('Hover Portfolio Attachment Link', 'halena'),
                'default' => '1'// 1 = on | 0 = off
            ),
            
            array(
                'id' => 'portfolio-bottom-style',
                'type' => 'select',
                'title' => esc_html__('Portfolio Bottom Caption Style', 'halena'),
                'options' => array(
                    '' => 'Default', 
                    'background' => 'Background',
                    'border' => 'Border'
                ), //Must provide key => value pairs for select options
                'default' => ''
            ),
            array(
                'id' => 'portfolio-bottom-title',
                'type' => 'checkbox',
                'title' => esc_html__('Portfolio Bottom Title', 'halena'),
                'subtitle' => esc_html__('It will display the title at the bottom of their respective item.', 'halena'),
                'default' => '0'// 1 = on | 0 = off
            ),
            array(
                'id' => 'portfolio-bottom-category',
                'type' => 'checkbox',
                'title' => esc_html__('Portfolio Bottom Category', 'halena'),
                'subtitle' => esc_html__('It will display the categories at the bottom of their respective item.', 'halena'),
                'default' => '0'// 1 = on | 0 = off
            ),
            
            array(
                'id' => 'portfolio-post-link-target',
                'type' => 'select',
                'title' => esc_html__('Portfolio Link target', 'halena'),
                'subtitle' => esc_html__('Choose the target of the portfolio items link.', 'halena'),
                'options' => array(
                    '_self' => 'Same window', 
                    '_blank' => 'New window',
                ), //Must provide key => value pairs for select options
                'default' => '_self'
            ),
            
            array(
                'id' => 'portfolio-filter',
                'type' => 'checkbox',
                'required' => array('portfolio-carousel', '=', '0'),
                'title' => esc_html__('Filter', 'halena'),
                'subtitle' => esc_html__('If you don\'t want to show the filter disabe it!. ', 'halena'),
                'default' => '1'// 1 = on | 0 = off
            ),
            array(
                'id' => 'portfolio-filter-order',
                'type' => 'select',
                'required' => array('portfolio-filter', '=', '1'),
                'title' => esc_html__('Portfolio Filter Order', 'halena'),
                'options' => array(
                    'DESC' => esc_html__('Descending', 'halena'),
                    'ASC' => esc_html__('Ascending', 'halena'), 
                ), //Must provide key => value pairs for select options
                'default' => 'ASC'
            ),
            array(
                'id' => 'portfolio-filter-orderby',
                'type' => 'select',
                'required' => array('portfolio-filter', '=', '1'),
                'title' => esc_html__('Portfolio Filter Orderby', 'halena'),
                'options' => array(
                    'none' => esc_html__('None', 'halena'),
                    'name' => esc_html__( 'Name', 'halena'),
                    'slug' => esc_html__( 'Slug', 'halena'),
                    'term_group' => esc_html__( 'Term Group', 'halena'),
                    'term_id' => esc_html__( 'Term ID', 'halena'),
                    'id' => esc_html__( 'ID', 'halena'),
                    'description' => esc_html__( 'Description', 'halena'),
                ), 
                'default' => 'name'
            ),
            array(
                'id' => 'portfolio-filter-align',
                'type' => 'radio',
                'required' => array('portfolio-filter', '=', '1'),
                'title' => esc_html__('Portfolio Filter Align', 'halena'),
                'options' => array(
                    'left' => esc_html__('Left', 'halena'),
                    'center' => esc_html__('Center', 'halena'), 
                    'right' => esc_html__('Right', 'halena'), 
                ), 
                'default' => 'left'
            ),
            array(
                'id' => 'portfolio-filter-all-text',
                'type' => 'text',
                'required' => array('portfolio-filter', '=', '1'),
                'title' => esc_html__('Text alternative for "All"', 'halena'),
                'subtitle' => esc_html__('type the alternative text for the portfolio filter\'s All text', 'halena'),
                'default' => esc_html__('All', 'halena'),
            ),
            array(
                'id' => 'portfolio-navigation',
                'type' => 'switch',
                'required' => array('portfolio-carousel', '=', '0'),
                'title' => esc_html__('Portfolio Navigation', 'halena'),
                'desc' => esc_html__('It will enable the navigation link on portfolio page..', 'halena'),
                'default' => '1'// 1 = on | 0 = off
            ),
            array(
                'id'       => 'portfolio-navigation-choice',
                'type'     => 'radio',
                'required' => array('portfolio-navigation', '=', '1'),
                'title'    => esc_html__( 'Portfolio Navigation Style', 'halena' ),
                'subtitle' => esc_html__( 'Choose any of one navigation style to display on the portfolio page.', 'halena' ),
                //Must provide key => value pairs for radio options
                'options'  => array(
                    '1' => 'Number',
                    '2' => 'Infinite',
                    '3' => 'Infinite & Load More button',
                ),
                'default'  => '1'
            ),
             array(
                'id' => 'portfolio-navigation-ifs-load-text',
                'type' => 'text',
                'required' => array(
                    array( 'portfolio-navigation-choice', '!=', '1'),
                ),
                'title' => esc_html__('Text to show on loading.', 'halena'),
                'default' => esc_html__('Loading', 'halena'),
            ),
            array(
                'id' => 'portfolio-navigation-ifs-finish-text',
                'type' => 'text',
                'required' => array(
                    array( 'portfolio-navigation-choice', '!=', '1'),
                ),
                'title' => esc_html__('Text to show at the end of page.', 'halena'),
                'default' => esc_html__('No More Items', 'halena'),
            ),

            array(
                'id' => 'portfolio-navigation-ifs-btn-text',
                'type' => 'text',
                'required' => array('portfolio-navigation-choice', '=', '3'),
                'title' => esc_html__('Button Text', 'halena'),
                'default' => esc_html__('Load More', 'halena'),
            ),
            array(
                'id' => 'portfolio-animation',
                'type' => 'switch',
                'title' => esc_html__('Portfolio Animation', 'halena'),
                'subtitle' => esc_html__('If you don\'t want the animation on each portfolio item disable it.', 'halena'),
                'desc' => esc_html__('This animation will show the items one by one only when it reaches the viewport.', 'halena'),
                'default' => '1'// 1 = on | 0 = off
            ),
            array(
                'id' => 'portfolio-animation-style',
                'type' => 'select',
                'required' => array('portfolio-animation', '=', '1'),
                'title' => esc_html__('Animation Style', 'halena'),
                'options' => array(
                    'fadeIn' => esc_html__('fadeIn', 'halena'),
                    'fadeInDown' => esc_html__('fadeInDown', 'halena'),
                    'fadeInUp' => esc_html__('fadeInUp', 'halena'),
                    'fadeInRight' => esc_html__('fadeInRight', 'halena'),
                    'fadeInLeft' => esc_html__('fadeInLeft', 'halena'),
                    'flipInX' => esc_html__('flipInX', 'halena'),
                    'flipInY' => esc_html__('flipInY', 'halena'),
                    'zoomIn' => esc_html__('zoomIn', 'halena'),
                ), //Must provide key => value pairs for select options
                'default' => 'fadeInUp'
            ),
            array(
                'id' => 'portfolio-animation-duration',
                'type' => 'text',
                'required' => array('portfolio-animation', '=', '1'),
                'title' => esc_html__('Animation Duration ', 'halena'),
                'desc' => esc_html__('Enter the value in seconds. for ex. 0.6', 'halena'),
                'validate' => 'numeric',
                "default" => "0.8",
            ),

            array(
                'id' => 'portfolio-animation-delay',
                'type' => 'text',
                'required' => array('portfolio-animation', '=', '1'),
                'title' => esc_html__('Animation Delay ', 'halena'),
                'desc' => esc_html__('Enter the value in seconds. for ex. 0.6', 'halena'),
                'validate' => 'numeric',
                "default" => "0.4",
            ),
            array(
                'id' => 'portfolio-animation-offset',
                'type' => 'slider',
                'required' => array('portfolio-animation', '=', '1'),
                'title' => esc_html__('Animation Offset ', 'halena'),
                'desc' => esc_html__('animation will be triggered only when portfolio reaches particular percentage on viewport', 'halena'),
                "default" => "90",
                "min" => "20",
                "step" => "5",
                "max" => "100",
            ),
        )
    ) );
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Posttype Settings', 'halena' ),
        'id'         => 'porfolio-posttype-options',
        'subsection' => true,
        'desc'       => esc_html__( 'Here, you can setup the post count, order, etc. Note: Most of these portfolio settings apply only when you choose portfolio at template attributes', 'halena' ),
        'fields' => array(
            array(
                'id' => 'portfolio-per-page',
                'type' => 'text',
                'title' => esc_html__('Number of Portfolio items per page', 'halena'),
                'subtitle' => esc_html__('type the number of post to show in a portfolio page', 'halena'),
                'validate' => 'numeric',
                'default' => '6',
                'class' => 'text'
            ),
            array(
                'id'       => 'portfolio-categories',
                'type'     => 'select',
                'multi'    => true,
                'data' => 'terms',
                'args' => array('taxonomies'=>'types', 'args'=>array()),
                'title'    => esc_html__( 'Choose the categories to display', 'halena' ),
                'desc' => esc_html__( 'You can select multiple categories. leave it empty to display all categories', 'halena' ),
                'default' => ''
            ),
            
            array(
                'id' => 'portfolio-post-include',
                'type' => 'text',
                'title' => esc_html__('Portfolio Items include', 'halena'),
                'subtitle' => esc_html__('you can exclude the items by typing post ids for ex. 70, 45', 'halena'),
                'default' => '',
                'class' => 'text'
            ),

            array(
                'id' => 'portfolio-post-exclude',
                'type' => 'text',
                'title' => esc_html__('Portfolio Items exclude', 'halena'),
                'subtitle' => esc_html__('you can exclude the items by typing post ids for ex. 60', 'halena'),
                'desc' => esc_html__('If this is used in the same query as portfolio item, it will be ignored', 'halena'),
                'default' => '',
                'class' => 'text'
            ),

            array(
                'id' => 'portfolio-post-order',
                'type' => 'select',
                'title' => esc_html__('Portfolio items Order', 'halena'),
                'desc' => esc_html__('Portfolio posts sorting order.', 'halena'),
                'options' => array(
                    'DESC' => esc_html__('Descending', 'halena'),
                    'ASC' => esc_html__('Ascending', 'halena'), 
                ), //Must provide key => value pairs for select options
                'default' => 'DESC'
            ),
            array(
                'id' => 'portfolio-post-orderby',
                'type' => 'select',
                'title' => esc_html__('Portfolio Items Orderby', 'halena'),
                'desc' => esc_html__('Portfolio posts sorting orderby.', 'halena'),
                'options' => array(
                    'none' => esc_html__('None', 'halena'),
                    'id' => esc_html__('Post ID', 'halena'),
                    'author' => esc_html__('Post Author', 'halena'),
                    'title' => esc_html__('Post Title', 'halena'),
                    'name' => esc_html__('Post Slug', 'halena'),
                    'date' => esc_html__('Date', 'halena'),
                    'modified' => esc_html__('Last Modified Date', 'halena'),
                    'rand' => esc_html__('Random', 'halena'),
                    'comment_count' => esc_html__('comment-count', 'halena'),
                    'menu_order' => esc_html__('menu_order', 'halena'),
                ), //Must provide key => value pairs for select options
                'default' => 'date'
            ),
            array(
                'id'       => 'portfolio-posttype-archive',
                'type'     => 'switch',
                'title'    => esc_html__( 'Portfolio Archive page', 'halena' ),
                'subtitle' => wp_kses( __( 'It will reserve the /portfolio page for displaying all created portfolio items.', 'halena' ), array( 'a' => array( 'href' => array() ) ) ),
                'default'  => '1',
            ),
            array(
                'id'       => 'portfolio-posttype-slug',
                'type'     => 'text',
                'title'    => esc_html__( 'Custom Portfolio Slug Name', 'halena' ),
                'subtitle' => wp_kses( __( 'It will change the existing url prefix "portfolio". Once you changed the custom slug, its mandatory to perform <a href="#">flush_rewrite_rules</a>.', 'halena' ), array( 'a' => array( 'href' => array() ) ) ),
                'default'  => '',
            ),
        )
    ) );
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Singles', 'halena' ),
        'id'         => 'porfolio-sharing-options',
        'subsection' => true,
        'desc'       => esc_html__( 'Here, you can enable/disable some of the necessary share icons.', 'halena' ),
        'fields' => array(
            array(
                'id' => 'portfolio-single-navigation',
                'type' => 'switch',
                'title' => esc_html__('Portfolio Navigation', 'halena'),
                'desc' => esc_html__('It will enable the navigation link on portfolio page..', 'halena'),
                'default' => '1'// 1 = on | 0 = off
            ),

            array(
                'id' => 'portfolio-single-prev',
                'type' => 'text',
                'required' => array('portfolio-single-navigation', '=', '1'),
                'title' => esc_html__('Portfolio single Previous Text ', 'halena'),
                'subtitle' => esc_html__('you can use the Word Previous or Older', 'halena'),
                'default' => esc_html__('Prev', 'halena'),
                'class' => 'text'
            ),
            
            array(
                'id' => 'portfolio-single-next',
                'type' => 'text',
                'required' => array('portfolio-single-navigation', '=', '1'),
                'title' => esc_html__('Portfolio single Next Text ', 'halena'),
                'subtitle' => esc_html__('you can use the Word Next or Newer', 'halena'),
                'default' => esc_html__('Next', 'halena'),
                'class' => 'text'
            ),
            array(
                'id' => 'portfolio-sharing-panel',
                'type' => 'switch',
                'title' => esc_html__('Portfolio Sharing icons', 'halena'),
                'subtitle' => esc_html__('This option enable the sharing panel at the bottom of every portfolio item.', 'halena'),
                'default' => 1, // 1 = on | 0 = off
                'on' => 'Enable',
                'off' => 'Disable',
            ),
            array(
                'id'       => 'portfolio-sharing-icons',
                'type'     => 'checkbox',
                'required' => array('portfolio-sharing-panel', '=', '1'),
                'title'    => esc_html__( 'Share Icons', 'halena' ),
                //Must provide key => value pairs for multi checkbox options
                'options'  => array(
                    '1' => 'Facebook',
                    '2' => 'Twitter',
                    '3' => 'Google Plus',
                    '4' => 'Linkedin'
                ),
                //See how std has changed? you also don't need to specify opts that are 0.
                'default'  => array(
                    '1' => '1',
                    '2' => '1',
                    '3' => '1',
                    '4' => '1'
                )
            ),
        )
            
    ) );

    if( class_exists( 'WooCommerce' ) ){
        Redux::setSection( $opt_name, array(
            'title' => esc_html__( 'Shop Settings', 'halena' ),
            'id'    => 'shop-settings',
            'icon'  => 'el el-shopping-cart'
        ) );
        
        Redux::setSection( $opt_name, array(
            'title'      => esc_html__( 'General', 'halena' ),
            'id'         => 'shop-general-options',
            'subsection' => true,
            'desc'       => esc_html__( 'Here, you can enable/disable basic shop options.', 'halena' ),
            'fields' => array(
                
                array(
                    'id' => 'shop-column-layout',
                    'type' => 'image_select',
                    'title' => esc_html__('Shop Layout(Columns) DEPRECATED', 'halena'),
                    'subtitle' => esc_html__('Layout for your Shop page.', 'halena'),
                    'desc' => esc_html__(' NOTE: For Woocommerce 3.3.3 or later, IT CAN BE CONTROLLED AT Appearance/Customize/Woocommerce/Product Catalog', 'halena'),
                    'options' => array(
                        '1' => array('alt' => '1 Column', 'img' => AGNI_FRAMEWORK_URL . '/template/img//portfolio-1c.png'),
                        '2' => array('alt' => '2 Columns', 'img' => AGNI_FRAMEWORK_URL . '/template/img//portfolio-2c.png'),
                        '3' => array('alt' => '3 Columns', 'img' => AGNI_FRAMEWORK_URL . '/template/img/portfolio-3c.png'),
                        '4' => array('alt' => '4 Columns', 'img' => AGNI_FRAMEWORK_URL . '/template/img/portfolio-4c.png'),
                        '5' => array('alt' => '5 Columns', 'img' => AGNI_FRAMEWORK_URL . '/template/img/portfolio-5c.png'),
                        '6' => array('alt' => '6 Columns', 'img' => AGNI_FRAMEWORK_URL . '/template/img/portfolio-6c.png'),
                    ), //Must provide key => value(array:title|img) pairs for radio options
                    'default' => '4'
                ),
                array(
                    'id' => 'shop-products-per-page',
                    'type' => 'text',
                    'title' => esc_html__('Products per page', 'halena'),
                    'subtitle' => esc_html__('Enter no.of products to show on shop page.', 'halena'),
                    'default' => '16'
                ),

                array(
                    'id'       => 'shop-grid-layout',
                    'type'     => 'radio',
                    'title'    => esc_html__( 'Shop Grid Style', 'halena' ),
                    'subtitle' => esc_html__( 'Choose any of one grid style. fitRows is default and ', 'halena' ),
                    //Must provide key => value pairs for radio options
                    'options'  => array(
                        'fitRows' => 'FitRows(Default Grid)',
                        'masonry' => 'Masonry',
                    ),
                    'default'  => 'fitRows'
                ),
                array(
                    'id' => 'shop-sidebar',
                    'type'     => 'radio',
                    'title' => esc_html__('Shop Sidebar', 'halena'),
                    'options' => array(
                        'no-sidebar' => 'No Sidebar', 
                        'has-sidebar' => 'Right Sidebar',
                        'has-sidebar left' => 'Left Sidebar',
                    ), //Must provide key => value pairs for select options
                    'default' => 'has-sidebar left'
                ),
                array(
                    'id' => 'shop-has-sidebar-sticky',
                    'type' => 'checkbox',
                    'required' => array('shop-sidebar', '!=', 'no-sidebar'),
                    'title' => esc_html__('Sticky Sidebar', 'halena'),
                    'subtitle' => esc_html__('It will keep the sidebar at the top always.', 'halena'),
                    'default' => ''// 1 = on | 0 = off
                ),
                
                array(
                    'id' => 'shop-layout',
                    'type' => 'image_select',
                    'title' => esc_html__('shop Layout', 'halena'),
                    'subtitle' => esc_html__('Choose your desired shop layout.', 'halena'),
                    'options' => array(
                        'container' => 'Container', 
                        'container-fluid' => 'Fullwidth',
                    ), //Must provide key => value pairs for select options
                    'options' => array(                            
                        'container' => array('alt' => 'Container', 'title' => 'Container', 'img' => AGNI_FRAMEWORK_URL . '/template/img/layout-1.png'),
                        'container-fluid' => array('alt' => 'Fullwidth', 'title' => 'Fullwidth', 'img' => AGNI_FRAMEWORK_URL . '/template/img/layout-2.png'),
                    ), //Must provide key => value(array:title|img) pairs for radio options
                    'default' => 'container-fluid'
                ),
                array(
                    'id' => 'shop-product-bg-color',
                    'type' => 'color',
                    'transparent' => false,
                    'mode' => 'background',
                    'output' => array( '.agni-products .shop-column:not(.product-category)' ), 
                    'title' => esc_html__('Product Background Color', 'halena'),
                    'desc' => esc_html__('Individual product\'s background color.', 'halena'),
                    'default' => '#f0f0f0',
                    'validate' => 'color',
                ),
                array(
                    'id' => 'shop-gutter-value',
                    'type' => 'text',
                    'title' => esc_html__('Gutter Value', 'halena'),
                    'subtitle' => esc_html__('Enter the space you want to add between each item.', 'halena'),
                    'default' => '0'// 1 = on | 0 = off
                ),
                array(
                    'id'             => 'shop-product-content-padding',
                    'type'           => 'spacing',
                    // An array of CSS selectors to apply this font style to
                    'mode'           => 'padding',
                    // absolute, padding, margin, defaults to padding
                    'all'            => false,
                    // Have one field that applies to all
                    'top'           => true,     // Disable the top
                    'bottom'        => true,     // Disable the bottom
                    'left'          => true,
                    'right'         => true,
                    'units'          => array( 'em', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
                    'units_extended' => 'true',    // Allow users to select any type of unit
                    'title'          => esc_html__( 'Product content Padding', 'halena' ),
                    'subtitle'       => esc_html__( 'Here, you can set padding to the shop products.', 'halena' ),
                    'default'        => array(
                        'padding-top'    => '20px',
                        'padding-bottom' => '20px',
                        'padding-left'    => '25px',
                        'padding-right' => '25px',
                    ),
                    'output'         => array( '.woocommerce .product-content' )
                ),
                // Product alignment
                array(
                    'id' => 'shop-product-content-align',
                    'type' => 'radio',
                    'title' => esc_html__( 'Product content Alignment', 'halena' ),
                    'options' => array(
                        'left' => esc_html__('Left', 'halena'),
                        'center' => esc_html__('Center', 'halena'), 
                        'right' => esc_html__('Right', 'halena'), 
                    ), 
                    'default' => 'center'
                ),
                array(
                    'id' => 'shop-thumbnail-hardcrop',
                    'type' => 'checkbox',
                    'title' => esc_html__('Shop Thumbnails Hard Crop', 'halena'),
                    'subtitle' => esc_html__('It will crop all the images by ignoring original dimension of an image.', 'halena'),
                    'default' => '0'// 1 = on | 0 = off
                ),
                array(
                    'id' => 'shop-thumbnail-dimension-custom',
                    'type' => 'text',
                    'required' => array('shop-thumbnail-hardcrop', '=', '1'),
                    'title' => esc_html__('Thumbnails Crop Size', 'halena'),
                    'subtitle' => esc_html__('You can mention your own dimension for ex. 640x640', 'halena'),
                    'desc' => esc_html__('Set the maximum width & height of a thumbnail. Note: it may not be an actual image size but the ratio will be the same.', 'halena'),
                    'default' => '640x640',
                ),

                array(
                    'id' => 'shop-secondary-thumbnail',
                    'type' => 'switch',
                    //'required' => array('shop-carousel', '=', '0'),
                    'title' => esc_html__('Disable Shop Secondary Thumbnail', 'halena'),
                    'desc' => esc_html__('It helps you to enable/disable the thumbnail which displays when you hover the product on shop page, if any.', 'halena'),
                    'default' => '0', // 1 = on | 0 = off
                    'on' => 'Yes',
                    'off' => 'No',
                ),
                array(
                    'id' => 'shop-sale-flash',
                    'type' => 'select',
                    'title' => esc_html__('Sale Flash', 'halena'),
                    'options' => array(
                        '1' => esc_html__('Default', 'halena'),
                        '2' => esc_html__('Percentage Offer', 'halena'),
                        '3' => esc_html__('Discount Amount', 'halena'),
                    ), //Must provide key => value pairs for select options
                    'default' => '2'
                ),
                array(
                    'id' => 'shop-sale-flash-off-text',
                    'type' => 'text',
                    'required' => array('shop-sale-flash', '=', '2'),
                    'title' => esc_html__('Offer Text', 'halena'),
                    'default' => esc_html__(' Off.', 'halena'),
                ),
                array(
                    'id' => 'shop-sale-flash-discount-text',
                    'type' => 'text',
                    'required' => array('shop-sale-flash', '=', '3'),
                    'title' => esc_html__('Discount Symbol', 'halena'),
                    'default' => '-',
                ),
                array(
                    'id' => 'shop-out-of-stock-label',
                    'type' => 'text',
                    'title' => esc_html__('Out of Stock Label', 'halena'),
                    'default' => esc_html__('Sold Out', 'halena'),
                ),


                array(
                    'id' => 'shop-add-to-cart-loader-text',
                    'type' => 'text',
                    'title' => esc_html__('Add to cart Loader Text', 'halena'),
                    'default' => esc_html__('Adding to Cart!', 'halena'),
                ),

                array(
                    'id' => 'shop-quickview',
                    'type' => 'switch',
                    'title' => esc_html__('Shop Quickview', 'halena'),
                    'desc' => esc_html__('It will enable/disable the quick view feature.', 'halena'),
                    'default' => '1'// 1 = on | 0 = off
                ),

                array(
                    'id' => 'shop-breadcrumb',
                    'type' => 'switch',
                    'title' => esc_html__('Shop Breadcrumb', 'halena'),
                    'desc' => esc_html__('It will enable/disable the Sorting order dropdown.', 'halena'),
                    'default' => '1'// 1 = on | 0 = off
                ),

                array(
                    'id' => 'shop-col-switch',
                    'type' => 'switch',
                    'title' => esc_html__('Shop Column Switch', 'halena'),
                    'desc' => esc_html__('It will enable/disable the quick view feature.', 'halena'),
                    'default' => '1'// 1 = on | 0 = off
                ),
                array(
                    'id' => 'shop-result-count',
                    'type' => 'switch',
                    'title' => esc_html__('Shop Result Count', 'halena'),
                    'desc' => esc_html__('It will enable/disable text that shows number of results on page.', 'halena'),
                    'default' => '1'// 1 = on | 0 = off
                ),
                array(
                    'id' => 'shop-ordering',
                    'type' => 'switch',
                    'title' => esc_html__('Shop Ordering', 'halena'),
                    'desc' => esc_html__('It will enable/disable the Sorting order dropdown.', 'halena'),
                    'default' => '1'// 1 = on | 0 = off
                ),

                array(
                    'id' => 'shop-thumbnail-hover-style',
                    'type' => 'select',
                    'title' => esc_html__('Thumbnail Hover Style', 'halena'),
                    'options' => array(
                        '1' => esc_html__('Style 1', 'halena'),
                        '2' => esc_html__('Style 2', 'halena'),
                    ), //Must provide key => value pairs for select options
                    'default' => '2'
                ),
                
                array(
                    'id' => 'shop-navigation',
                    'type' => 'switch',
                    //'required' => array('shop-carousel', '=', '0'),
                    'title' => esc_html__('Shop Navigation', 'halena'),
                    'desc' => esc_html__('It will enable the navigation link on shop page.', 'halena'),
                    'default' => '1'// 1 = on | 0 = off
                ),
                array(
                    'id'       => 'shop-navigation-choice',
                    'type'     => 'radio',
                    'required' => array('shop-navigation', '=', '1'),
                    'title'    => esc_html__( 'Shop Navigation Style', 'halena' ),
                    'subtitle' => esc_html__( 'Choose any of one navigation style to display on the shop page.', 'halena' ),
                    //Must provide key => value pairs for radio options
                    'options'  => array(
                        '1' => 'Number',
                        '2' => 'Infinite',
                        '3' => 'Infinite & Load More button',
                    ),
                    'default'  => '1'
                ),
                array(
                    'id' => 'shop-navigation-ifs-load-text',
                    'type' => 'text',
                    'required' => array(
                        array( 'shop-navigation-choice', '!=', '1'),
                    ),
                    'title' => esc_html__('Text to show on loading.', 'halena'),
                    'default' => esc_html__('Loading...', 'halena'),
                ),
                array(
                    'id' => 'shop-navigation-ifs-finish-text',
                    'type' => 'text',
                    'required' => array(
                        array( 'shop-navigation-choice', '!=', '1'),
                    ),
                    'title' => esc_html__('Text to show at the end of page.', 'halena'),
                    'default' => esc_html__('No More Products', 'halena'),
                ),

                array(
                    'id' => 'shop-navigation-ifs-btn-text',
                    'type' => 'text',
                    'required' => array('shop-navigation-choice', '=', '3'),
                    'title' => esc_html__('Button Text', 'halena'),
                    'default' => esc_html__('Load More', 'halena'),
                ),
                array(
                    'id' => 'shop-animation',
                    'type' => 'switch',
                    'title' => esc_html__('Shop Animation', 'halena'),
                    'subtitle' => esc_html__('If you don\'t want the animation on each shop item disable it.', 'halena'),
                    'desc' => esc_html__('This animation will show the items one by one only when it reaches the viewport.', 'halena'),
                    'default' => '1'// 1 = on | 0 = off
                ),
                array(
                    'id' => 'shop-animation-style',
                    'type' => 'select',
                    'required' => array('shop-animation', '=', '1'),
                    'title' => esc_html__('Animation Style', 'halena'),
                    'options' => array(
                        'fadeIn' => esc_html__('fadeIn', 'halena'),
                        'fadeInDown' => esc_html__('fadeInDown', 'halena'),
                        'fadeInUp' => esc_html__('fadeInUp', 'halena'),
                        'fadeInRight' => esc_html__('fadeInRight', 'halena'),
                        'fadeInLeft' => esc_html__('fadeInLeft', 'halena'),
                        'flipInX' => esc_html__('flipInX', 'halena'),
                        'flipInY' => esc_html__('flipInY', 'halena'),
                        'zoomIn' => esc_html__('zoomIn', 'halena'),
                    ), //Must provide key => value pairs for select options
                    'default' => 'fadeInUp'
                ),
                array(
                    'id' => 'shop-animation-duration',
                    'type' => 'text',
                    'required' => array('shop-animation', '=', '1'),
                    'title' => esc_html__('Animation Duration ', 'halena'),
                    'desc' => esc_html__('Enter the value in seconds. for ex. 0.6', 'halena'),
                    'validate' => 'numeric',
                    "default" => "0.8",
                ),

                array(
                    'id' => 'shop-animation-delay',
                    'type' => 'text',
                    'required' => array('shop-animation', '=', '1'),
                    'title' => esc_html__('Animation Delay ', 'halena'),
                    'desc' => esc_html__('Enter the value in seconds. for ex. 0.6', 'halena'),
                    'validate' => 'numeric',
                    "default" => "0.4",
                ),
                array(
                    'id' => 'shop-animation-offset',
                    'type' => 'slider',
                    'required' => array('shop-animation', '=', '1'),
                    'title' => esc_html__('Animation Offset ', 'halena'),
                    'desc' => esc_html__('animation will be triggered only when shop reaches particular percentage on viewport', 'halena'),
                    "default" => "90",
                    "min" => "20",
                    "step" => "5",
                    "max" => "100",
                ),
            )
        ) );

        Redux::setSection( $opt_name, array(
            'title'      => esc_html__( 'Catalog Mode', 'halena' ),
            'id'         => 'shop-catalog-mode-options',
            'subsection' => true,
            'desc'       => esc_html__( 'Here, you can control catalog mode settings.', 'halena' ),
            'fields' => array(

                array(
                    'id' => 'shop-catalog-mode',
                    'type' => 'switch',
                    'title' => esc_html__('Catalog Mode', 'halena'),
                    'subtitle' => esc_html__('It will remove the purchasable options & features from the shop.', 'halena'),
                    'default' => 0, // 1 = on | 0 = off
                    'on' => 'Enable',
                    'off' => 'Disable',
                ),

                array(
                    'id' => 'shop-catalog-mode-price',
                    'type' => 'checkbox',
                    'required' => array('shop-catalog-mode', '=', '1'),
                    'title' => esc_html__('Hide Price', 'halena'),
                    'subtitle' => esc_html__('It will hide the price from shop page & single page.', 'halena'),
                    'default' => '0'// 1 = on | 0 = off
                ),
                /*array(
                    'id' => 'shop-catalog-mode-custom-links',
                    'type' => 'checkbox',
                    'required' => array('shop-catalog-mode', '=', '1'),
                    'title' => esc_html__('Show Custom links on singles page', 'halena'),
                    'default' => '0'// 1 = on | 0 = off
                ),*/
                
            )
        ) );

        Redux::setSection( $opt_name, array(
            'title'      => esc_html__( 'Cart Settings', 'halena' ),
            'id'         => 'shop-cart-page-options',
            'subsection' => true,
            'desc'       => esc_html__( 'Here, you can control cart page, sidebar cart settings.', 'halena' ),
            'fields' => array(

                /*array(
                    'id' => 'shop-cart-page-style',
                    'type' => 'select',
                    'title' => esc_html__('Cart page style', 'halena'),
                    'options' => array(
                        '1' => esc_html__('Style 1', 'halena'),
                        '2' => esc_html__('Style 2', 'halena'),
                    ), //Must provide key => value pairs for select options
                    'default' => '1'
                ),*/
                array(
                    'id' => 'shop-cart-crosssell',
                    'type' => 'switch',
                    'title' => esc_html__('Cross Sell Products', 'halena'),
                    'subtitle' => esc_html__('It will enable Up sells products suggestion on product page.', 'halena'),
                    'default' => 1, // 1 = on | 0 = off
                    'on' => 'Enable',
                    'off' => 'Disable',
                ),

                //$halena_options = get_option('halena_options');
                array(
                    'id' => 'shop-sidebar-cart-disable',
                    'type' => 'switch',
                    'title' => esc_html__('Disable Sidebar Cart', 'halena'),
                    'subtitle' => esc_html__('It will disable sidebar cart for header cart icon click.', 'halena'),
                    'default' => 0, // 1 = on | 0 = off
                    'on' => 'Enable',
                    'off' => 'Disable',
                ),
                array(
                    'id' => 'shop-sidebar-cart-title',
                    'type' => 'text',
                    'title' => esc_html__('Sidebar Cart Title', 'halena'),
                    'subtitle' => esc_html__('Enter your cart title for sidebar.', 'halena'),
                    'default' => esc_html__('Your Cart', 'halena')
                ),
                array(
                    'id' => 'shop-sidebar-cart-empty-text',
                    'type' => 'text',
                    'title' => esc_html__('Sidebar Cart Text when empty', 'halena'),
                    'default' => esc_html__('Your cart is empty', 'halena')
                ),

                array(
                    'id' => 'shop-sidebar-cart-subtotal-label',
                    'type' => 'text',
                    'title' => esc_html__('Sidebar Subtotal Label', 'halena'),
                    'subtitle' => esc_html__('Enter your subtotal text.', 'halena'),
                    'default' => esc_html__('Subtotal', 'halena')
                ),

                array(
                    'id' => 'shop-sidebar-cart-cart-label',
                    'type' => 'text',
                    'title' => esc_html__('Sidebar Cart button Label', 'halena'),
                    'subtitle' => esc_html__('it will enable the Cart link on Sidebar Cart. Make it empty to disable.', 'halena'),
                    'default' => esc_html__('View Cart', 'halena')
                ),

                array(
                    'id' => 'shop-sidebar-cart-checkout-label',
                    'type' => 'text',
                    'title' => esc_html__('Sidebar Checkout Label', 'halena'),
                    'subtitle' => esc_html__('it will enable the checkout link on Sidebar Cart. Make it empty to disable.', 'halena'),
                    'default' => esc_html__('Checkout', 'halena')
                ),

                array(
                    'id' => 'shop-sidebar-cart-shop-label',
                    'type' => 'text',
                    'title' => esc_html__('Sidebar Continue Shopping button Label', 'halena'),
                    'subtitle' => esc_html__('it will enable the Continue Shopping link on Sidebar Cart. Make it empty to disable.', 'halena'),
                    'default' => esc_html__('Continue Shopping', 'halena')
                ),
                array(
                    'id' => 'shop-sidebar-cart-shop-link',
                    'type' => 'text',
                    'title' => esc_html__('Link for Sidebar Continue Shopping button', 'halena'),
                    'subtitle' => esc_html__('Empty link will not redirect, simply shows/return to current page.', 'halena'),
                    'default' => ''
                ),
                
            )
        ) );


        Redux::setSection( $opt_name, array(
            'title'      => esc_html__( 'Singles', 'halena' ),
            'id'         => 'shop-single-options',
            'subsection' => true,
            'desc'       => esc_html__( 'Here, you can enable/disable some of the necessary share icons.', 'halena' ),
            'fields' => array(
                array(
                    'id' => 'shop-single-layout-style',
                    'type' => 'select',
                    'title' => esc_html__('Shop Layout Style', 'halena'),
                    'subtitle' => esc_html__('Choose your desired layout style.', 'halena'),
                    'options' => array(
                        '1' => 'Style 1', 
                        '2' => 'Style 2',
                        '3' => 'Style 3',
                        '4' => 'Style 4',
                    ), //Must provide key => value pairs for select options for radio options
                    'default' => '1'
                ),

                array(
                    'id'       => 'shop-single-tab-active',
                    //'required' => array('shop-single-layout-style', '=', '3'),
                    'required' => array(
                        array( 'shop-single-layout-style', '=', '3' ),
                    ),
                    'type'     => 'select',
                    'title'    => esc_html__( 'Active Tab', 'halena' ),
                    //Must provide key => value pairs for radio options
                    'options'  => array(
                        '' => 'None',
                        'description' => 'Description',
                        'additional_information' => 'Additional Information',
                        'reviews' => 'Reviews',
                    ),
                    'default'  => ''
                ),

                array(
                    'id' => 'shop-single-layout-sticky',
                    'type' => 'checkbox',
                    //'required' => array('shop-single-layout-style', '=', '3'),
                    'required' => array(
                        array( 'shop-single-layout-style', '=', '3' ),
                    ),
                    'title' => esc_html__('Single Product Sticky', 'halena'),
                    'subtitle' => esc_html__('It will sticky the product contents.', 'halena'),
                    'default' => '0'// 1 = on | 0 = off
                ),

                array(
                    'id' => 'shop-single-cart-style',
                    'type' => 'select',
                    'title' => esc_html__('Single Product Add to Cart style', 'halena'),
                    'options' => array(
                        '1' => esc_html__('Style 1', 'halena'),
                        '2' => esc_html__('Style 2', 'halena'),
                    ), //Must provide key => value pairs for select options
                    'default' => '1'
                ),

                array(
                    'id' => 'shop-single-cart-label',
                    'type' => 'text',
                    'title' => esc_html__('Single Product Cart Label', 'halena'),
                    'subtitle' => esc_html__('Its only applicable for Cart style 2.', 'halena'),
                    'default' => esc_html__('Quantity', 'halena')
                ),
                /* 
                hide tabs (description, additional info, review)
                */
                array(
                    'id' => 'shop-single-add-to-cart-sticky',
                    'type' => 'switch',
                    'title' => esc_html__('Sticky Add to Cart', 'halena'),
                    'subtitle' => esc_html__('It will show the sticky add to cart button at the bottom of the product.', 'halena'),
                    'default' => '', // 1 = on | 0 = off
                    'on' => 'Enable',
                    'off' => 'Disable',
                ),
                array(
                    'id' => 'shop-single-ajax-add-to-cart',
                    'type' => 'switch',
                    'title' => esc_html__('Ajax Add to cart', 'halena'),
                    'subtitle' => esc_html__('It will enable ajax enabled button on single page.', 'halena'),
                    'default' => 1, // 1 = on | 0 = off
                    'on' => 'Enable',
                    'off' => 'Disable',
                ),
                array(
                    'id' => 'shop-single-zoom',
                    'type' => 'switch',
                    'title' => esc_html__('Hover Zoom', 'halena'),
                    'subtitle' => esc_html__('It will enable zoom when you hover on product images.', 'halena'),
                    'default' => 1, // 1 = on | 0 = off
                    'on' => 'Enable',
                    'off' => 'Disable',
                ),
                array(
                    'id' => 'shop-single-zoom-mobile',
                    'type' => 'switch',
                    'required' => array('shop-single-zoom', '=', '1'),
                    'title' => esc_html__('Hover Zoom on Mobile', 'halena'),
                    'subtitle' => esc_html__('It will enable/disable zoom for mobile when you hover on product images.', 'halena'),
                    'default' => 1, // 1 = on | 0 = off
                    'on' => 'Enable',
                    'off' => 'Disable',
                ),
                array(
                    'id' => 'shop-single-lightbox',
                    'type' => 'switch',
                    'title' => esc_html__('Lightbox', 'halena'),
                    'subtitle' => esc_html__('It will enable lightbox when you click on product images.', 'halena'),
                    'default' => 1, // 1 = on | 0 = off
                    'on' => 'Enable',
                    'off' => 'Disable',
                ),
                array(
                    'id' => 'shop-single-upsell',
                    'type' => 'switch',
                    'title' => esc_html__('Up Sell Products', 'halena'),
                    'subtitle' => esc_html__('It will enable Up sells products suggestion on product page.', 'halena'),
                    'default' => 1, // 1 = on | 0 = off
                    'on' => 'Enable',
                    'off' => 'Disable',
                ),
                array(
                    'id' => 'shop-single-related',
                    'type' => 'switch',
                    'title' => esc_html__('Related Products', 'halena'),
                    'subtitle' => esc_html__('It will enable related products suggestion on product page.', 'halena'),
                    'default' => 1, // 1 = on | 0 = off
                    'on' => 'Enable',
                    'off' => 'Disable',
                ),

                array(
                    'id' => 'shop-single-breadcrumb',
                    'type' => 'switch',
                    'title' => esc_html__('Breadcrumb', 'halena'),
                    'subtitle' => esc_html__('It will enable lightbox when you click on product images.', 'halena'),
                    'default' => 1, // 1 = on | 0 = off
                    'on' => 'Enable',
                    'off' => 'Disable',
                ),

                array(
                    'id' => 'shop-single-sku',
                    'type' => 'switch',
                    'title' => esc_html__('SKU', 'halena'),
                    'subtitle' => esc_html__('It will enable lightbox when you click on product images.', 'halena'),
                    'default' => 1, // 1 = on | 0 = off
                    'on' => 'Enable',
                    'off' => 'Disable',
                ),

                array(
                    'id' => 'shop-single-meta',
                    'type' => 'switch',
                    'title' => esc_html__('Meta data (Category/Tags)', 'halena'),
                    'default' => 1, // 1 = on | 0 = off
                    'on' => 'Enable',
                    'off' => 'Disable',
                ),
                array(
                    'id' => 'shop-single-rating',
                    'type' => 'switch',
                    'title' => esc_html__('Rating', 'halena'),
                    'subtitle' => esc_html__('It will show the avg rating of the product (if any).', 'halena'),
                    'default' => 1, // 1 = on | 0 = off
                    'on' => 'Enable',
                    'off' => 'Disable',
                ),

                array(
                    'id' => 'shop-single-short-desc',
                    'type' => 'switch',
                    'title' => esc_html__('Short Description', 'halena'),
                    'subtitle' => esc_html__('It will display the short description of the product.', 'halena'),
                    'default' => 1, // 1 = on | 0 = off
                    'on' => 'Enable',
                    'off' => 'Disable',
                ),

                array(
                    'id' => 'shop-single-navigation',
                    'type' => 'switch',
                    'title' => esc_html__('Navigation', 'halena'),
                    'default' => 1, // 1 = on | 0 = off
                    'on' => 'Enable',
                    'off' => 'Disable',
                ),

                array(
                    'id' => 'shop-sharing-panel',
                    'type' => 'switch',
                    'title' => esc_html__('Shop Single Page Sharing icons', 'halena'),
                    'subtitle' => esc_html__('This option enable the sharing panel at the bottom of every product.', 'halena'),
                    'default' => 1, // 1 = on | 0 = off
                    'on' => 'Enable',
                    'off' => 'Disable',
                ),
                array(
                    'id'       => 'shop-sharing-icons',
                    'type'     => 'checkbox',
                    'required' => array('shop-sharing-panel', '=', '1'),
                    'title'    => esc_html__( 'Share Icons', 'halena' ),
                    //Must provide key => value pairs for multi checkbox options
                    'options'  => array(
                        '1' => 'Facebook',
                        '2' => 'Twitter',
                        '3' => 'Google Plus',
                        '4' => 'Linkedin'
                    ),
                    //See how std has changed? you also don't need to specify opts that are 0.
                    'default'  => array(
                        '1' => '1',
                        '2' => '1',
                        '3' => '1',
                        '4' => '1'
                    )
                ),
            )

        ) );
    }
    
    Redux::setSection( $opt_name, array(
        'icon' => 'el-icon-road',
        'id'         => '404-error-options',
        'title' => esc_html__('404 Error Page', 'halena'),
        'desc' => esc_html__('you change your 404 page content here.', 'halena'),
        'fields' => array(
            
            array(
                'id' => '404-choice',
                'type' => 'radio',
                'title' => esc_html__('404 Choice', 'halena'),
                'options' => array(
                    '0' => 'Default', 
                    '1' => 'Content Block',
                ), //Must provide key => value pairs for select options
                "default" => '0',
            ),
            array(
                'id' => '404-contentblock-choice',
                'type' => 'select',
                'required' => array('404-choice', '=', '1'),
                'title' => esc_html__('Choose 404 Block', 'halena'),
                'options' => agni_posttype_options( array( 'post_type' => 'agni_block'), false ), //Must provide key => value pairs for select options
                "default" => '',
            ),
            array(
                'id' => '404-title',
                'type' => 'text',
                'required' => array('404-choice', '=', '0'),
                'title' => esc_html__('404 Title', 'halena'),
                'subtitle' => esc_html__('404 Title', 'halena'),
                'default' => '404'
            ),
            array(
                'id' => '404-description-text',
                'type' => 'editor',
                'required' => array('404-choice', '=', '0'),
                'title' => esc_html__('404 Description Text', 'halena'),
                'subtitle' => esc_html__('you can type your 404 description here..', 'halena'),
                'default' => 'It looks like nothing was found at this location. Maybe try a search?',
                'args'   => array(
                    'media_buttons'    => false,
                    'textarea_rows'    => 3
                )
            ),
            array(
                'id' => '404-searchbox',
                'type' => 'checkbox',
                'required' => array('404-choice', '=', '0'),
                'title' => esc_html__('Search Box', 'halena'),
                'default' => '1'// 1 = on | 0 = off
            ),  
            
        )
    ) );
    Redux::setSection( $opt_name, array(
        'icon' => 'el-icon-cogs',
        'id'         => 'maintenance-options',
        'title' => esc_html__('Maintenance Mode', 'halena'),
        'desc' => esc_html__('you change your maintenance page content/settings here.', 'halena'),
        'fields' => array(
            array(
                'id' => 'maintenance-mode',
                'type' => 'switch',
                'title' => esc_html__('Maintenance Mode', 'halena'),
                'default' => '0'// 1 = on | 0 = off
            ),  
            array(
                'id' => 'maintenance-mode-choice',
                'type' => 'select',
                'required' => array('maintenance-mode', '=', '1'),
                'title' => esc_html__('Maintenance Mode Choice', 'halena'),
                'options' => array(
                    '1' => esc_html__('Preset', 'halena'),
                    '2' => esc_html__('Custom', 'halena'),
                ), //Must provide key => value pairs for select options
                'default' => '1'
            ),
            array(
                'id' => 'maintenance-mode-custom-bg',
                'type' => 'background',
                'required' => array('maintenance-mode-choice', '=', '2'),
                'title' => esc_html__('Background for Maintenance Mode', 'halena'),
                //'default' => array( 'background-color' => '#fbfbfb', ),
            ),

            array(
                'id' => 'maintenance-mode-custom',
                'type' => 'editor',
                'required' => array('maintenance-mode-choice', '=', '2'),
                'title' => esc_html__('HTML codes for Maintenance Mode', 'halena'),
                'subtitle' => esc_html__('you can type your HTML codes for Maintenance mode page.', 'halena'),
                'default' => '<div id="header"><h4 class="agni-maintenance-mode-header-icon"><a title="YOURSITE TITLE" href="YOURSITE LINK">YOUR SITE NAME</a></h4></div><div id="content" class="agni-maintenance-mode-content"><div class="maintenance-icon" data-icon="P"></div><h2>We\'ll be right back!</h2><p>Sorry for the inconvenience. We\'re busy on making something cool for you.<br/>Please try after sometime</p></div>',
                'args'   => array(
                    'media_buttons'    => true,
                    'textarea_rows'    => 8
                )
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'icon' => 'el-icon-group',
        'id'         => 'social-links-options',
        'title' => esc_html__('Social Network links', 'halena'),
        'desc' => esc_html__('Fill your links for social network.', 'halena'),
        'fields' => array(
        
            array(
                'id' => 'facebook-link',
                'type' => 'text',
                'title' => esc_html__('Facebook Link', 'halena'),
                'subtitle' => esc_html__('Link your profile page', 'halena'),
                'validate' => 'url',
                'default' => esc_url( 'http://facebook.com/profile/' )
            ),
            array(
                'id' => 'twitter-link',
                'type' => 'text',
                'title' => esc_html__('Twitter Link', 'halena'),
                'validate' => 'url',
                'default' => esc_url( 'http://twitter.com/' )
            ),
            array(
                'id' => 'google-plus-link',
                'type' => 'text',
                'title' => esc_html__('Google + Link', 'halena'),
                'validate' => 'url',
                'default' => esc_url( 'http://google.com/' )
            ),
            array(
                'id' => 'bitbucket-link',
                'type' => 'text',
                'title' => esc_html__('BitBucket Link', 'halena'),
                'validate' => 'url',
                'default' => esc_url( 'http://bitbucket.org/' )
            ),
            array(
                'id' => 'behance-link',
                'type' => 'text',
                'title' => esc_html__('Behance Link', 'halena'),
                'validate' => 'url',
                'default' => esc_url( 'http://behance.net/' )
            ),
            array(
                'id' => 'dribbble-link',
                'type' => 'text',
                'title' => esc_html__('Dribbble Link', 'halena'),
                'validate' => 'url',
                'default' => esc_url( 'http://dribbble.com/' )
            ),
            array(
                'id' => 'flickr-link',
                'type' => 'text',
                'title' => esc_html__('Flickr Link', 'halena'),
                'validate' => 'url',
                'default' => esc_url( 'http://flickr.com/' )
            ),
            array(
                'id' => 'github-link',
                'type' => 'text',
                'title' => esc_html__('GitHub Link', 'halena'),
                'validate' => 'url',
                'default' => esc_url( 'http://github.com/' )
            ),
            array(
                'id' => 'instagram-link',
                'type' => 'text',
                'title' => esc_html__('Instagram Link', 'halena'),
                'validate' => 'url',
                'default' => esc_url( 'http://instagram.com/' )
            ),
            array(
                'id' => 'linkedin-link',
                'type' => 'text',
                'title' => esc_html__('Linkedin Link', 'halena'),
                'validate' => 'url',
                'default' => esc_url( 'http://linkedin.com/' )
            ),
            array(
                'id' => 'pinterest-link',
                'type' => 'text',
                'title' => esc_html__('Pinterest Link', 'halena'),
                'validate' => 'url',
                'default' => esc_url( 'http://pinterest.com/' )
            ),
            array(
                'id' => 'reddit-link',
                'type' => 'text',
                'title' => esc_html__('Reddit Link', 'halena'),
                'validate' => 'url',
                'default' => esc_url( 'http://reddit.com/' )
            ),
            array(
                'id' => 'soundcloud-link',
                'type' => 'text',
                'title' => esc_html__('SoundCloud Link', 'halena'),
                'validate' => 'url',
                'default' => esc_url( 'http://soundcloud.com/' )
            ),
            array(
                'id' => 'skype-link',
                'type' => 'text',
                'title' => esc_html__('Skype Link', 'halena'),                        
                'default' => 'skype:yourname?call'
            ),
            array(
                'id' => 'stack-overflow-link',
                'type' => 'text',
                'title' => esc_html__('Stack Overflow Link', 'halena'),
                'validate' => 'url',
                'default' => esc_url( 'http://stackoverflow.com/' )
            ),
            array(
                'id' => 'tumblr-link',
                'type' => 'text',
                'title' => esc_html__('Tumblr Link', 'halena'),
                'validate' => 'url',
                'default' => esc_url( 'http://tumblr.com/' )
            ),
            array(
                'id' => 'vimeo-link',
                'type' => 'text',
                'title' => esc_html__('Vimeo Link', 'halena'),
                'validate' => 'url',
                'default' => esc_url( 'http://vimeo.com/' )
            ),
            array(
                'id' => 'vk-link',
                'type' => 'text',
                'title' => esc_html__('VK Link', 'halena'),
                'validate' => 'url',
                'default' => esc_url( 'http://vk.com/' )
            ),
            array(
                'id' => 'weibo-link',
                'type' => 'text',
                'title' => esc_html__('Weibo Link', 'halena'),
                'validate' => 'url',
                'default' => esc_url( 'http://weibo.com/' )
            ),
            array(
                'id' => 'whatsapp-link',
                'type' => 'text',
                'title' => esc_html__('WhatsApp Link', 'halena'),
                'default' => 'whatsapp://send?text=http://www.whatsapp.com'
            ),
            array(
                'id' => 'youtube-link',
                'type' => 'text',
                'title' => esc_html__('Youtube Link', 'halena'),
                'validate' => 'url',
                'default' => esc_url( 'http://youtube.com/' )
            ),
            
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Custom Coding', 'halena' ),
        'id'         => 'custom-coding-options',
        'icon'  => 'el el-leaf',
        'desc'       => esc_html__( 'This section used for advance customization, you can add your own codes here.', 'halena' ),
        'fields'     => array(
            array(
                'id'       => 'css-code',
                'type'     => 'ace_editor',
                'title'    => esc_html__( 'CSS Code', 'halena' ),
                'subtitle' => esc_html__( 'Paste your CSS code here.', 'halena' ),
                'mode'     => 'css',
                'theme'    => 'monokai',
                'desc'     => 'You can write your own CSS here.',
                'default'  => "#header{\n   margin: 0 auto;\n}\n/* your styles here & you can delete above reference */"
            ),
            array(
                'id'       => 'js-code',
                'type'     => 'ace_editor',
                'title'    => esc_html__( 'JS Code', 'halena' ),
                'subtitle' => esc_html__( 'Paste your JS code here.', 'halena' ),
                'mode'     => 'javascript',
                'theme'    => 'chrome',
                'desc'     => 'You can write your own jQuery here.',
                'default'  => "jQuery(document).ready(function(){\n\t/* your jquery here */\n});"
            ),

        )
    ) );
    
    /*
     * <--- END SECTIONS
     */

    /**
     * Initialize Redux Options
     */
    Redux::init( $opt_name );

    /**
     * This is a test function that will let you see when the compiler hook occurs.
     * It only runs if a field    set with compiler=>true is changed.
     * */
    function compiler_action( $options, $css, $changed_values ) {
        echo '<h1>The compiler hook has run!</h1>';
        echo "<pre>";
        print_r( $changed_values ); // Values that have changed since the last save
        echo "</pre>";
    }

    /**
     * Custom function for the callback validation referenced above
     * */
    if ( ! function_exists( 'redux_validate_callback_function' ) ) {
        function redux_validate_callback_function( $field, $value, $existing_value ) {
            $error   = false;
            $warning = false;

            //do your validation
            if ( $value == 1 ) {
                $error = true;
                $value = $existing_value;
            } elseif ( $value == 2 ) {
                $warning = true;
                $value   = $existing_value;
            }

            $return['value'] = $value;

            if ( $error == true ) {
                $return['error'] = $field;
                $field['msg']    = 'your custom error message';
            }

            if ( $warning == true ) {
                $return['warning'] = $field;
                $field['msg']      = 'your custom warning message';
            }

            return $return;
        }
    }

    /**
     * Custom function for the callback referenced above
     */
    if ( ! function_exists( 'redux_my_custom_field' ) ) {
        function redux_my_custom_field( $field, $value ) {
            print_r( $field );
            echo '<br/>';
            print_r( $value );
        }
    }

    /**
     * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
     * Simply include this function in the child themes functions.php file.
     * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
     * so you must use AGNI_FRAMEWORK_URL  if you want to use any of the built in icons
     * */
    function dynamic_section( $sections ) {
        //$sections = array();
        $sections[] = array(
            'title'  => esc_html__( 'Section via hook', 'halena' ),
            'desc'   => esc_html__( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'halena' ),
            'icon'   => 'el el-paper-clip',
            // Leave this as a blank section, no options just some intro text set above.
            'fields' => array()
        );

        return $sections;
    }

    /**
     * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
     * */
    function change_arguments( $args ) {
        //$args['dev_mode'] = true;

        return $args;
    }

    /**
     * Filter hook for filtering the default value of any given field. Very useful in development mode.
     * */
    function change_defaults( $defaults ) {
        $defaults['str_replace'] = 'Testing filter hook!';

        return $defaults;
    }
