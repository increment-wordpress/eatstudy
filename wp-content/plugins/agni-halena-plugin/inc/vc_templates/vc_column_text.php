<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $css_animation
 * @var $css
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Column_text
 */
$el_id = $el_class = $additional_class = $additional_attr = $design_css = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$class_to_filter = 'agni_text_column agni-text-block ';
$class_to_filter .= $this->getExtraClass( $el_class );
$id = ($el_id)?'id="'.$el_id.'"':"";
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );
$output = wpb_js_remove_wpautop( $content, true );
if( $parallax == '1' ){
	$additional_class .= ' has-parallax';
	$additional_attr .= ' data-bottom-top="'.$parallax_start.'" data-top-bottom="'.$parallax_end.'"';
}

// Processing css
$design_css = '';
$additional_class .= ' agni_custom_design_css';
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

if( $animation == '1' ){
	$output = '<div class="animate" data-animation="'.$animation_style.'" data-animation-offset="'.$animation_offset.'" style="animation-duration: '.$animation_duration.'s; 	animation-delay: '.$animation_delay.'s; 	-moz-animation-duration: '.$animation_duration.'s; 	-moz-animation-delay: '.$animation_delay.'s; 	-webkit-animation-duration: '.$animation_duration.'s; 	-webkit-animation-delay: '.$animation_delay.'s;">'.$output.'</div>';	
}
$output = '
	<div '.esc_attr( $id ).' class="' . esc_attr( $css_class ) . $additional_class. '" '.$additional_attr.' '.$design_css.'>
		' . $output . '
	</div>
';

echo  $output;
