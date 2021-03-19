<?php
$output = $title = $interval = $el_class = $active = $choice = $nav_tabs = $tab_content = $vertical_align = '';
extract( shortcode_atts( array(
	'style' => '1',
	'vertical' => '',
	'vertical_align' => 'left',
	'radius' => '',
	'align' => 'left',
	'el_class' => ''
), $atts ) );


$el_class = $this->getExtraClass( $el_class );

wp_enqueue_script( 'jquery-ui-tabs' );
$element = 'wpb_tabs';

// Extract tab titles
preg_match_all( '/vc_tab([^\]]+)/i', $content, $matches, PREG_OFFSET_CAPTURE );
$tab_titles = array();
/**
 * vc_tabs
 *
 */
if ( isset( $matches[1] ) ) {
	$tab_titles = $matches[1];
}
if( !empty($radius) ){
	$radius = 'style="border-radius:' . ( preg_match( '/(px|em|\%|pt|cm)$/', $radius ) ? $radius : $radius . 'px' ) . '"';
}
if( !empty($vertical) ){
	$vertical =  'nav-tabs-type-'.$vertical.' ';
	$vertical_align =  'text-'.$vertical_align;
}
$tabs_nav = '';
$tabs_nav .= '<ul class="nav nav-tabs list-inline wpb_tour_tabs_wrapper '.$vertical_align.'" '.$radius.'>';
foreach ( $tab_titles as $tab ) {
	$tab_atts = shortcode_parse_atts($tab[0]);
	if(isset($tab_atts['title']) ) {
		if( isset( $tab_atts['active'] ) ){
			$active = $tab_atts['active'];	
		}
		else{
			$active = '';	
		}
		$tabs_nav .= '<li class="'.$active.'"><a  data-toggle="tab" href="#tab-' . ( isset( $tab_atts['tab_id'] ) ? $tab_atts['tab_id'] : sanitize_title( $tab_atts['title'] ) ) . '">' . $tab_atts['title'] . '</a></li>';
	}
}
$tabs_nav .= '</ul>' . "\n";

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, trim( $element . ' wpb_content_element ' . $el_class ), $this->settings['base'], $atts );

$output .= "\n\t" . '<div class="tabs '.$css_class.' nav-tabs-style-'.$style.' '.$vertical.'text-'.$align.'" data-interval="' . $interval . '">';
$output .= "\n\t\t\t" . $tabs_nav;
$output .= "\n\t\t\t" . '<div class=" tab-content">'.wpb_js_remove_wpautop( $content );


$output .= "\n\t\t" . '</div>' . $this->endBlockComment( '.wpb_wrapper' );
$output .= "\n\t" . '</div> ' . $this->endBlockComment( $element );

echo  $output;
