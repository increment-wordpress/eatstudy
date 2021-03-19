<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $width
 * @var $css
 * @var $offset
 * @var $animation - added additionally
 * @var $animation_duration - added additionally
 * @var $animation_delay - added additionally
 * @var $animation_offset - added additionally
 * @var $align - added additionally
 * @var $dark_mode - added additionally
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Column_Inner
 */
$output = $design_css = $column_bg_css = $bg_parallax_class = $column_inner_bg_css = $column_inner_bg_overlay = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$width = wpb_translateColumnWidthToSpan( $width );
$width = vc_column_offset_class_merge( $offset, $width );
// NEED TO BE IMPROVED to create custom css
if ( empty( $el_id ) ) {
	$el_id = 'agni-column-'.rand(10000, 99999);
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

if( $bg_parallax == '1' ){
	$bg_parallax = 'data-top-bottom="'.$data_top_bottom.'" data-center="'.$data_center.'" data-bottom-top="'.$data_bottom_top.'"';
	$bg_parallax_class = ' parallax';
}

if( !empty($bg_color) ){
	$column_inner_bg_css .= 'background-color: ' . $bg_color . '; ';
}
if( !empty($bg_image) ){
	$column_inner_bg_css .= 'background-image: url(\'' . wp_get_attachment_url($bg_image) . '\'); ';

	$column_inner_bg_css .= 'background-repeat:' . $bg_image_repeat . '; ';
	$column_inner_bg_css .= 'background-size:' . $bg_image_size . '; ';
	$column_inner_bg_css .= 'background-position:' . $bg_image_position . '; ';
	$column_inner_bg_css .= 'background-attachment:' . $bg_image_attachment . '; ';

	if( !empty($fallback_bg_color) ){
		$column_inner_bg_css .= 'background-color: ' . $fallback_bg_color . '; ';
		$fallback_bg = 'has-fallback';
	}
}
if( !empty($column_inner_bg_css) ){
	$column_inner_bg_css = 'style="'.$column_inner_bg_css.'"';
}
if( $bg_choice == '1' ){
	$column_inner_bg = '<div class="section-column-inner-bg section-column-inner-bg-color '.$bg_parallax_class.'" '.$column_inner_bg_css.' '.$bg_parallax.'></div>';
}
else if( $bg_choice == '2' ){
	$column_inner_bg = '<div class="section-column-inner-bg section-column-inner-bg-image '.$bg_parallax_class.'" '.$column_inner_bg_css.' '.$bg_parallax.'></div>';
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
        $column_inner_bg = '<a id="bgndVideo-'.$el_id.'" class="player '.$player_src.'" style="background-image:url('.wp_get_attachment_url($bg_video_src_yt_fallback).');" data-property="{videoURL:\''.$bg_video_src_yt.'\',containment:\'.section-column-inner-bg-container-'.$el_id.'\', showControls:false, autoPlay:'.$yt_bg_video_autoplay.', loop:'.$yt_bg_video_loop.', vol:'.$bg_video_volume.', mute:'.$yt_bg_video_muted.', startAt:'.$bg_video_start_at.', stopAt:'.$bg_video_stop_at.', opacity:1, addRaster:false, quality:\''.$bg_video_quality.'\'}"></a>
            <!--<div class="section-video-controls">
                <a class="command command-play" href="#"></a>
                <a class="command command-pause" href="#"></a>
            </div>-->';
    }
    else if( $bg_video_src == '2' ){
        $column_inner_bg = '<div id="section-selfhosted-video-'.$el_id.'" class="section-column-inner-bg section-column-inner-bg-video self-hosted embed-responsive">
                <video '. $bg_video_autoplay . $bg_video_loop . $bg_video_muted . ' class="custom-self-hosted-video" poster="'.wp_get_attachment_url($bg_video_src_sh_poster).'">
                    <source src="'.$bg_video_src_sh.'" type="video/mp4">
                </video>
            </div>';
    }
}

if( $bg_overlay == '1' ){
	$column_inner_bg_overlay = '<div class="section-column-inner-bg-overlay overlay" style="background-color:'.$bg_overlay_color.';"></div>';
	if( $bg_overlay_choice == '3' ){
        wp_enqueue_script( 'halena-gradientmap-script' );
	    $column_inner_bg_overlay = '<div class="section-column-inner-bg-overlay section-column-inner-gradient-map-overlay gradient-map-overlay overlay '.$bg_parallax_class.'" data-gm="'.$bg_gm_overlay_color1.','.$bg_gm_overlay_color2.','.$bg_gm_overlay_color3.' " '.$column_inner_bg_css.' '.$bg_parallax.'></div>';
	}
	elseif ( $bg_overlay_choice == '2' ) {
	    $column_inner_bg_overlay = '<div class="section-column-inner-bg-overlay overlay" style="'.strip_tags($bg_sg_overlay_css).';"></div>';
	}
}
if( !empty($column_inner_bg) ){
	$column_inner_bg = '<div class="section-column-bg-container section-column-bg-container-'.$el_id.'">'.$column_inner_bg.$column_inner_bg_overlay.'</div>';
}

$css_classes = array(
	$this->getExtraClass( $el_class ),
	'wpb_column',
	'agni_column_container',
	'vc_column_container',
	$width
);

$wrapper_attributes = array();

$css_classes = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_classes ) ) . '"';

$output .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';
$output .= $column_inner_bg;
$output .= '<div class="agni_column-inner vc_column-inner agni_custom_design_css '. esc_attr( trim( 'text-'.$align .' ' . $dark_mode ) ) .'" '.$design_css.'>';
$output .= '<div class="wpb_wrapper">';
if( !empty($animation) ){
	$output .= '<div class="animate" data-animation-offset="'.$animation_offset.'" data-animation="'.$animation_style.'" style="animation-duration: '.$animation_duration.'s; 	animation-delay: '.$animation_delay.'s; 	-moz-animation-duration: '.$animation_duration.'s; 	-moz-animation-delay: '.$animation_delay.'s; 	-webkit-animation-duration: '.$animation_duration.'s; 	-webkit-animation-delay: '.$animation_delay.'s; ">';	
}
$output .= wpb_js_remove_wpautop($content);
if( !empty($animation) ){
	$output .= '</div>';	
}
$output .= '</div>';
$output .= '</div>';
$output .= '</div>';

echo  $output;
