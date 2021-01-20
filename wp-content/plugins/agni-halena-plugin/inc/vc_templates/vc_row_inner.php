<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $css - removed
 * @var $el_id
 * @var $equal_height
 * @var $content_placement
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Row_Inner
 */
$el_class = $equal_height = $content_placement = $el_id = $design_css = $row_inner_bg_css = $row_inner_bg_overlay = $bg_parallax_class = $row_inner_css_classes = '';
$output = $after_output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$wrapper_attributes = array();
// build attributes for wrapper
// NEED TO BE IMPROVED to create custom css
if ( empty( $el_id ) ) {
	$el_id = 'agni-row-inner-'.rand(10000, 99999);
}
$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';

// Processing css
$design_css = '';
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

$el_class = $this->getExtraClass( $el_class );
$css_classes = array(
	'section-row-inner',
	'vc_inner',
	'agni_custom_design_css',
	$el_class,
);


if (!empty($atts['gap'])) {
	$row_inner_css_classes .= ' vc_column-gap-'.$atts['gap'];
}

if ( ! empty( $equal_height ) ) {
	$flex_row = true;
	$row_inner_css_classes .= ' vc_row-o-equal-height';
}

if ( ! empty( $content_placement ) ) {
	$flex_row = true;
	$row_inner_css_classes .= ' vc_row-o-content-' . $content_placement;
}

if ( ! empty( $flex_row ) ) {
	$row_inner_css_classes .= ' vc_row-flex';
}

if ( 'yes' === $disable_element ) {
	if ( vc_is_page_editable() ) {
		$row_inner_css_classes .= ' vc_hidden-lg vc_hidden-xs vc_hidden-sm vc_hidden-md';
	} else {
		return '';
	}
}

if( $bg_parallax == '1' ){
	$bg_parallax = 'data-top-bottom="'.$data_top_bottom.'" data-center="'.$data_center.'" data-bottom-top="'.$data_bottom_top.'"';
	$bg_parallax_class = ' parallax';
}

if( !empty($bg_color) ){
	$row_inner_bg_css .= 'background-color: ' . $bg_color . '; ';
}
if( !empty($bg_image) ){
	$row_inner_bg_css .= 'background-image: url(\'' . wp_get_attachment_url($bg_image) . '\'); ';

	$row_inner_bg_css .= 'background-repeat:' . $bg_image_repeat . '; ';
	$row_inner_bg_css .= 'background-size:' . $bg_image_size . '; ';
	$row_inner_bg_css .= 'background-position:' . $bg_image_position . '; ';
	$row_inner_bg_css .= 'background-attachment:' . $bg_image_attachment . '; ';

	if( !empty($fallback_bg_color) ){
		$row_inner_bg_css .= 'background-color: ' . $fallback_bg_color . '; ';
		$fallback_bg = 'has-fallback';
	}
}
if( !empty($row_inner_bg_css) ){
	$row_inner_bg_css = 'style="'.$row_inner_bg_css.'"';
}
if( $bg_choice == '1' ){
	$row_inner_bg = '<div class="section-row-inner-bg section-row-inner-bg-color '.$bg_parallax_class.'" '.$row_inner_bg_css.' '.$bg_parallax.'></div>';
}
else if( $bg_choice == '2' ){
	$row_inner_bg = '<div class="section-row-inner-bg section-row-inner-bg-image '.$bg_parallax_class.'" '.$row_inner_bg_css.' '.$bg_parallax.'></div>';
}
else if( $bg_choice == '3' ){

    if( $bg_video_loop == '1'){
        $yt_bg_video_loop = 'true';
        $bg_video_loop = 'loop ';
    }
    else{
        $yt_bg_video_loop = 'false';
    }
    
    if( $bg_video_autoplay == '1'){
        $yt_bg_video_autoplay = 'true';
        $bg_video_autoplay = 'autoplay ';
    }
    else{
        $yt_bg_video_autoplay = 'false';
    }
    
    if( $bg_video_muted == '1'){
        $yt_bg_video_muted = 'true';
        $bg_video_muted = 'muted ';
    }
    else{
        $yt_bg_video_muted = 'false';
    }

    if( $bg_video_src == '1' ){
    	if (strpos($textslider_bg_video_src_yt, 'youtube') > 0) {
            wp_enqueue_script( 'halena-mbytplayer-script' );
            $player_src = 'player-yt';
        } 
        elseif (strpos($textslider_bg_video_src_yt, 'vimeo') > 0) {
            wp_enqueue_script( 'halena-mbvimeoplayer-script' );
            $player_src = 'player-vimeo';
        } 
        $row_inner_bg = '<a id="bgndVideo-'.$el_id.'" class="player '.$player_src.'" style="background-image:url('.wp_get_attachment_url($bg_video_src_yt_fallback).');" data-property="{videoURL:\''.$bg_video_src_yt.'\',containment:\'.section-row-inner-bg-container-'.$el_id.'\', showControls:false, autoPlay:'.$yt_bg_video_autoplay.', loop:'.$yt_bg_video_loop.', vol:'.$bg_video_volume.', mute:'.$yt_bg_video_muted.', startAt:'.$bg_video_start_at.', stopAt:'.$bg_video_stop_at.', opacity:1, addRaster:false, quality:\''.$bg_video_quality.'\'}"></a>
            <!--<div class="section-video-controls">
                <a class="command command-play" href="#"></a>
                <a class="command command-pause" href="#"></a>
            </div>-->';
    }
    else if( $bg_video_src == '2' ){
        $row_inner_bg = '<div id="section-selfhosted-video-'.$el_id.'" class="section-row-inner-bg section-row-inner-bg-video self-hosted embed-responsive">
                <video '. $bg_video_autoplay . $bg_video_loop . $bg_video_muted . ' class="custom-self-hosted-video" poster="'.wp_get_attachment_url($bg_video_src_sh_poster).'">
                    <source src="'.$bg_video_src_sh.'" type="video/mp4">
                </video>
            </div>';
    }
}

if( $bg_overlay == '1' ){
	$row_inner_bg_overlay = '<div class="section-row-inner-bg-overlay overlay" style="background-color:'.$bg_overlay_color.';"></div>';
	if( $bg_overlay_choice == '3' ){
		wp_enqueue_script( 'halena-gradientmap-script' );
	    $row_inner_bg_overlay = '<div class="section-row-inner-bg-overlay section-row-inner-gradient-map-overlay gradient-map-overlay overlay '.$bg_parallax_class.'" data-gm="'.$bg_gm_overlay_color1.','.$bg_gm_overlay_color2.','.$bg_gm_overlay_color3.' " '.$row_inner_bg_css.' '.$bg_parallax.'></div>';
	}
	elseif ( $bg_overlay_choice == '2' ) {
	    $row_inner_bg_overlay = '<div class="section-row-inner-bg-overlay overlay" style="'.strip_tags($bg_sg_overlay_css).';"></div>';
	}
}

if( !empty($row_inner_bg) ){
	$row_inner_bg = '<div class="section-row-inner-bg-container section-row-inner-bg-container-'.$el_id.'">'.$row_inner_bg.$row_inner_bg_overlay.'</div>';
}

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( array_unique( $css_classes ) ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( $css_class ). ' '. esc_attr( $dark_mode ) .'" '.$design_css.'';

$output .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';
$output .= $row_inner_bg;
$output .= '<div class="vc_row vc_row_fluid '. esc_attr( trim( $row_inner_css_classes ) ).'">';
$output .= wpb_js_remove_wpautop( $content );
$output .= '</div>';
$output .= '</div>';
$output .= $after_output;

echo  $output;
