<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}


/*
 * Display search form
 * 
 * @param array args
 * @return string
 */

function agnidgwt_wcas_get_search_form( $args = array() ) {

	// Enqueue required scripts
	wp_enqueue_script( array(
		'woocommerce-general',
		'jquery-agnidgwt-wcas',
	) );

	ob_start();
	include AGNIDGWT_WCAS_DIR . 'includes/search-form.php';
	$html = ob_get_clean();

	return $html;
}

/*
 * Return ajax loader URL 
 * 
 * @param array args
 * @return string
 */

function agnidgwt_wcas_get_admin_ajax_url( $args = array() ) {

	$protocol	 = isset( $_SERVER[ 'HTTPS' ] ) ? 'https://' : 'http://';
	$ajax_url	 = admin_url( 'admin-ajax.php', $protocol );

	return add_query_arg( $args, $ajax_url );
}

/*
 * Cut string
 * 
 * @param string $string 
 * @param int $length
 * 
 * @return string
 */

function agnidgwt_wcas_str_cut( $string, $length = 40 ) {

	$string = strip_tags( $string );

	if ( strlen( $string ) > $length ) {
		$title = mb_substr( $string, 0, $length, 'utf-8' ) . '...';
	} else {
		$title = $string;
	}
	return $title;
}

/*
 * Add css classes to search form
 * 
 * @param array $args
 * @return string 
 */

function agnidgwt_wcas_search_css_classes( $args = array() ) {

	$classes = array();

	if ( AGNIDGWT_WCAS()->settings->get_opt( 'show_details_box' ) === 'on' ) {
		$classes[] = 'agnidgwt-wcas-is-detail-box';
	}

	if ( AGNIDGWT_WCAS()->settings->get_opt( 'show_submit_button' ) !== 'on' ) {
		$classes[] = 'agnidgwt-wcas-no-submit';
	}

	if ( isset( $args[ 'class' ] ) && !empty( $args[ 'class' ] ) ) {
		$classes[] = esc_html( $args[ 'class' ] );
	}

	if ( is_rtl() ) {
		$classes[] = 'agnidgwt_wcas_rtl';
	}

	return implode( ' ', $classes );
}

/*
 * Print loupe SVG ico
 */

function agnidgwt_wcas_print_ico_loupe() {
	?>
	<svg version="1.1" class="agnidgwt-wcas-ico-loupe" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
		 viewBox="0 0 51.539 51.361" enable-background="new 0 0 51.539 51.361" xml:space="preserve">
		<path d="M51.539,49.356L37.247,35.065c3.273-3.74,5.272-8.623,5.272-13.983c0-11.742-9.518-21.26-21.26-21.26
			  S0,9.339,0,21.082s9.518,21.26,21.26,21.26c5.361,0,10.244-1.999,13.983-5.272l14.292,14.292L51.539,49.356z M2.835,21.082
			  c0-10.176,8.249-18.425,18.425-18.425s18.425,8.249,18.425,18.425S31.436,39.507,21.26,39.507S2.835,31.258,2.835,21.082z"/>
	</svg>
	<?php

}

/*
 * Get product desc
 * 
 * @param int $product product object or The post ID
 * @param int $length description length
 * 
 * @return string
 */

function agnidgwt_wcas_get_product_desc( $product, $length = 130 ) {

	if ( is_numeric( $product ) ) {
		$product = wc_get_product( $product );
	}

	$output = '';

	if ( !empty( $product ) ) {

		if ( agnidgwt_wcas_compare_wc_version( '3.0', '>=' ) ) {
			$short_desc = $product->get_short_description();
		} else {
			$short_desc = $product->post->post_excerpt;
		}

		if ( !empty( $short_desc ) ) {
			$output = agnidgwt_wcas_str_cut( wp_strip_all_tags( $short_desc ), $length );
		} else {
			if ( agnidgwt_wcas_compare_wc_version( '3.0', '>=' ) ) {
				$desc = $product->get_description();
			} else {
				$short_desc = $product->post->post_content;
			}
			if ( !empty( $desc ) ) {
				$output = agnidgwt_wcas_str_cut( wp_strip_all_tags( $desc ), $length );
			}
		}
	}

	$output = html_entity_decode($output);

	return $output;
}

/*
 * Return HTML for the setting section "How to use?"
 * 
 * @return string HTML
 */

function agnidgwt_wcas_how_to_use_html() {

	$html = '';

	ob_start();

	include AGNIDGWT_WCAS_DIR . 'includes/admin/views/how-to-use.php';

	$html .= ob_get_clean();

	return $html;
}

/*
 * Minify JS
 * 
 * @see https://gist.github.com/tovic/d7b310dea3b33e4732c0
 * 
 * @param string
 * @return string
 */

function agnidgwt_wcas_minify_js( $input ) {

	if ( trim( $input ) === "" )
		return $input;
	return preg_replace(
	array(
		// Remove comment(s)
		'#\s*("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')\s*|\s*\/\*(?!\!|@cc_on)(?>[\s\S]*?\*\/)\s*|\s*(?<![\:\=])\/\/.*(?=[\n\r]|$)|^\s*|\s*$#',
		// Remove white-space(s) outside the string and regex
		'#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\'|\/\*(?>.*?\*\/)|\/(?!\/)[^\n\r]*?\/(?=[\s.,;]|[gimuy]|$))|\s*([!%&*\(\)\-=+\[\]\{\}|;:,.<>?\/])\s*#s',
		// Remove the last semicolon
		'#;+\}#',
		// Minify object attribute(s) except JSON attribute(s). From `{'foo':'bar'}` to `{foo:'bar'}`
		'#([\{,])([\'])(\d+|[a-z_]\w*)\2(?=\:)#i',
		// --ibid. From `foo['bar']` to `foo.bar`
		'#([\w\)\]])\[([\'"])([a-z_]\w*)\2\]#i',
		// Replace `true` with `!0`
		'#(?<=return |[=:,\(\[])true\b#',
		// Replace `false` with `!1`
		'#(?<=return |[=:,\(\[])false\b#',
		// Clean up ...
		'#\s*(\/\*|\*\/)\s*#'
	), array(
		'$1',
		'$1$2',
		'}',
		'$1$3',
		'$1.$3',
		'!0',
		'!1',
		'$1'
	), $input );
}

/*
 * Minify CSS
 * 
 * @see https://gist.github.com/tovic/d7b310dea3b33e4732c0
 * 
 * @param string
 * @return string
 */

function agnidgwt_wcas_minify_css( $input ) {

	if ( trim( $input ) === "" )
		return $input;
	// Force white-space(s) in `calc()`
	if ( strpos( $input, 'calc(' ) !== false ) {
		$input = preg_replace_callback( '#(?<=[\s:])calc\(\s*(.*?)\s*\)#', function($matches) {
			return 'calc(' . preg_replace( '#\s+#', "\x1A", $matches[ 1 ] ) . ')';
		}, $input );
	}
	return preg_replace(
	array(
		// Remove comment(s)
		'#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')|\/\*(?!\!)(?>.*?\*\/)|^\s*|\s*$#s',
		// Remove unused white-space(s)
		'#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\'|\/\*(?>.*?\*\/))|\s*+;\s*+(})\s*+|\s*+([*$~^|]?+=|[{};,>~+]|\s*+-(?![0-9\.])|!important\b)\s*+|([[(:])\s++|\s++([])])|\s++(:)\s*+(?!(?>[^{}"\']++|"(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')*+{)|^\s++|\s++\z|(\s)\s+#si',
		// Replace `0(cm|em|ex|in|mm|pc|pt|px|vh|vw|%)` with `0`
		'#(?<=[\s:])(0)(cm|em|ex|in|mm|pc|pt|px|vh|vw|%)#si',
		// Replace `:0 0 0 0` with `:0`
		'#:(0\s+0|0\s+0\s+0\s+0)(?=[;\}]|\!important)#i',
		// Replace `background-position:0` with `background-position:0 0`
		'#(background-position):0(?=[;\}])#si',
		// Replace `0.6` with `.6`, but only when preceded by a white-space or `=`, `:`, `,`, `(`, `-`
		'#(?<=[\s=:,\(\-]|&\#32;)0+\.(\d+)#s',
		// Minify string value
		'#(\/\*(?>.*?\*\/))|(?<!content\:)([\'"])([a-z_][-\w]*?)\2(?=[\s\{\}\];,])#si',
		'#(\/\*(?>.*?\*\/))|(\burl\()([\'"])([^\s]+?)\3(\))#si',
		// Minify HEX color code
		'#(?<=[\s=:,\(]\#)([a-f0-6]+)\1([a-f0-6]+)\2([a-f0-6]+)\3#i',
		// Replace `(border|outline):none` with `(border|outline):0`
		'#(?<=[\{;])(border|outline):none(?=[;\}\!])#',
		// Remove empty selector(s)
		'#(\/\*(?>.*?\*\/))|(^|[\{\}])(?:[^\s\{\}]+)\{\}#s',
		'#\x1A#'
	), array(
		'$1',
		'$1$2$3$4$5$6$7',
		'$1',
		':0',
		'$1:0 0',
		'.$1',
		'$1$3',
		'$1$2$4$5',
		'$1$2$3',
		'$1:0',
		'$1$2',
		' '
	), $input );
}

function agnidgwt_wcas_compare_wc_version( $version, $op ) {
	if ( function_exists( 'WC' ) && ( version_compare( WC()->version, $version, $op )) ) {
		return true;
	}
	return false;
}

/**
 * Get rating HTML
 * @param $product object WC_Product
 * @return string
 */
function agnidgwt_wcas_get_rating_html( $product ) {
	$html = '';

	if ( agnidgwt_wcas_compare_wc_version( '3.0', '>=' ) ) {
		$html = wc_get_rating_html( $product->get_average_rating() );
	} else {
		$html = $product->get_rating_html();
	}

	return $html;
}
