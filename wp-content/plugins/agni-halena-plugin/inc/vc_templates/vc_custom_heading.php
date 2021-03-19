<?php
/**
 * Shortcode attributes
 * @var $atts
 * //@var $source
 * @var $divide_line
 * @var $divide_line_width
 * @var $divide_line_color
 * @var $custom_heading_letter_spacing
 * @var $custom_heading_font_weight
 * @var $responsive_font_size
 * @var $vertical_text
 * @var $text
 * //@var $link
 * @var $google_fonts
 * @var $font_container
 * @var $el_class
 * @var $css
 * @var $font_container_data - returned from $this->getAttributes
 * @var $google_fonts_data - returned from $this->getAttributes
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Custom_heading
 */

$additional_class = $additional_attr = $design_css = $css = $custom_heading_css_tab = $custom_heading_css_mobile = '';

// This is needed to extract $font_container_data and $google_fonts_data
extract( $this->getAttributes( $atts ) );

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

extract( $this->getStyles( $el_class, $css, $google_fonts_data, $font_container_data, $atts ) );

$settings = get_option( 'wpb_js_google_fonts_subsets' );
if ( is_array( $settings ) && ! empty( $settings ) ) {
	$subsets = '&subset=' . implode( ',', $settings );
} else {
	$subsets = '';
}

if ( isset( $google_fonts_data['values']['font_family'] ) ) {
	wp_enqueue_style( 'vc_google_fonts_' . vc_build_safe_css_class( $google_fonts_data['values']['font_family'] ), '//fonts.googleapis.com/css?family=' . $google_fonts_data['values']['font_family'] . $subsets );
}

wp_dequeue_style( 'vc_google_fonts_abril_fatfaceregular' );

if( $custom_heading_font_weight != '' ){
	$custom_heading_font_weight = 'font-weight:'.$custom_heading_font_weight.'; ';
}
if( $font_italic == 'yes' ){
	$font_italic = 'font-style:italic; ';
}
if( $custom_heading_letter_spacing != '' ){
	$custom_heading_letter_spacing =  ( preg_match( '/(px|em|\%|pt|cm)$/', $custom_heading_letter_spacing ) ? 'letter-spacing:'. $custom_heading_letter_spacing : 'letter-spacing:'. $custom_heading_letter_spacing . 'px' ).'; ';
}
$custom_heading_css = esc_attr( implode( ';', $styles ) ) . '; '.$custom_heading_font_weight.$font_italic.$custom_heading_letter_spacing;

if( !empty($custom_font_size_tab) ){
	$custom_heading_css_tab = ( preg_match( '/(px|em|\%|pt|cm)$/', $custom_font_size_tab ) ? 'font-size:'. $custom_font_size_tab : 'font-size:'. $custom_font_size_tab . 'px' ).'; ';
}
if( !empty($custom_font_size_mobile) ){
	$custom_heading_css_mobile = ( preg_match( '/(px|em|\%|pt|cm)$/', $custom_font_size_mobile ) ? 'font-size:'. $custom_font_size_mobile : 'font-size:'. $custom_font_size_mobile . 'px' ).'; ';
}

$css_class .= ( !empty($custom_font_size_tab) || !empty($custom_font_size_mobile) )?' has-custom-font-size':'';

// Processing css
$design_css = '';
$design_css_array = array_filter( agni_space_atts_processor( $atts ) );
if( !empty($design_css_array[0]) || !empty($custom_heading_css) ){
	//$custom_heading_css = !empty($design_css_array[0])?$design_css_array[0].$custom_heading_css:$custom_heading_css
	$design_css .= ' style="';
	$design_css .= !empty($design_css_array[0])?$design_css_array[0]:'';
	$design_css .= $custom_heading_css.'"';

	$css_class .= ' agni_custom_design_css';
}
if( !empty($design_css_array[0]) ){
	$design_css .= ' data-css-default="'.$design_css_array[0].'"';
}
if( !empty($design_css_array[1]) || !empty($custom_heading_css_tab) ){
	$design_css .= ' data-css-tab="';
	$design_css .= !empty($design_css_array[1])?$design_css_array[1]:'';
	$design_css .= $custom_heading_css_tab.'"';
}
if( !empty($design_css_array[2]) || !empty($custom_heading_css_mobile) ){
	$design_css .= ' data-css-mobile="';
	$design_css .= !empty($design_css_array[2])?$design_css_array[2]:'';
	$design_css .= $custom_heading_css_mobile.'"';
}
if( !empty($custom_heading_css) ){
	$design_css .= ' data-css-existing="'.$custom_heading_css.'"';
}

if ( ! empty( $link ) ) {
	$link = vc_build_link( $link );
	$text = '<a href="' . esc_attr( $link['url'] ) . '"'
	        . ( $link['target'] ? ' target="' . esc_attr( $link['target'] ) . '"' : '' )
	        . ( $link['title'] ? ' title="' . esc_attr( $link['title'] ) . '"' : '' )
	        . '>' . $text . '</a>';
}
if( $icon != '' ){
	$icon = '<i class="'.$icon.'"></i>  -  ';
}

if( $divide_line == 'yes' ){
	$divide_line = '<div class="divide-line text-'.$font_container_data['values']['text_align'].' "><span style="width:'.( preg_match( '/(px|em|\%|pt|cm)$/', $divide_line_width ) ? $divide_line_width : $divide_line_width . 'px' ).'; height:'.( preg_match( '/(px|em|\%|pt|cm)$/', $divide_line_height ) ? $divide_line_height : $divide_line_height . 'px' ).'; background-color:'.$divide_line_color.'"></span></div>';
}

if( $vertical_text == 'yes'){
	$css_class .= ' has-vertical-text ';
}

if($responsive_font_size == 'yes'){
	$css_class .= ' agni_custom_heading_responsive ';
}
$css_class .= ' agni_custom_heading_content ';

if( $parallax == '1' ){
	$additional_class = ' column-has-parallax';
	$additional_attr = 'data-bottom-top="'.$parallax_start.'" data-top-bottom="'.$parallax_end.'"';
}

$output = '';
$output .= '<div class="agni_custom_heading page-scroll'.$additional_class.'" '.$additional_attr.'>';
if( $animation == '1' ){
	$output .= '<div class="animate" data-animation="'.$animation_style.'" data-animation-offset="'.$animation_offset.'" style="animation-duration: '.$animation_duration.'s; 	animation-delay: '.$animation_delay.'s; 	-moz-animation-duration: '.$animation_duration.'s; 	-moz-animation-delay: '.$animation_delay.'s; 	-webkit-animation-duration: '.$animation_duration.'s; 	-webkit-animation-delay: '.$animation_delay.'s;">';	
}
$output .= '<' . $font_container_data['values']['tag'] . ' class="' . esc_attr( $css_class ) . '" ' . $design_css . '>';
$output .= '<span>'.$icon.$text.'</span>';
$output .= '</' . $font_container_data['values']['tag'] . '>';
$output .= $divide_line;
if( $animation == '1' ){
	$output .= '</div>';	
}
$output .= '</div>';

echo  $output;