<?php
// Exit if accessed directly
if ( !defined( 'AGNIDGWT_WCAS_FILE' ) ) {
	exit;
}

global $halena_options;
$placeholder_text = !empty( $halena_options['header-search-box-text'] )?esc_attr( $halena_options['header-search-box-text'] ):esc_html__( 'Search for products...', 'agni-halena-plugin' );
$submit_text = AGNIDGWT_WCAS()->settings->get_opt( 'search_submit_text' );
$has_submit = 'on'; //AGNIDGWT_WCAS()->settings->get_opt( 'show_submit_button' );

?>

<div class="agnidgwt-wcas-search-wrapp <?php echo agnidgwt_wcas_search_css_classes( $args ); ?>">
    <form class="agnidgwt-wcas-search-form" role="search" action="<?php echo esc_url( home_url( '/' ) ) ?>" method="get">
        <div class="agnidgwt-wcas-sf-wrapp">
			<?php 
			if($has_submit !== 'on'){
			agnidgwt_wcas_print_ico_loupe();
			}
			?>	
            <label class="screen-reader-text" for="agnidgwt-wcas-search"><?php _e( 'Products search', 'agni-halena-plugin' ) ?></label>
			
            <input 
				type="search"
				id="agnidgwt-wcas-search"
				class="agnidgwt-wcas-search-input"
				name="s"
				value="<?php echo get_search_query() ?>"
				placeholder="<?php echo esc_html( $placeholder_text ); //AGNIDGWT_WCAS()->settings->get_opt( 'search_placeholder', __( 'Search for products...', 'agni-halena-plugin' ) ) ?>"
				/>
			<div class="agnidgwt-wcas-preloader"></div>
			
			<?php if($has_submit === 'on'): ?>
				<button type="submit" class="agnidgwt-wcas-search-submit"><i class="icon-basic-magnifier"></i><?php //echo empty( $submit_text ) ? agnidgwt_wcas_print_ico_loupe() : esc_html( $submit_text ); ?></button>
			<?php endif; ?>
			
			<input type="hidden" name="post_type" value="product" />
			<input type="hidden" name="agnidgwt_wcas" value="1" />

			<?php
// WPML compatible
			if ( defined( 'ICL_LANGUAGE_CODE' ) ):
				?>
				<input type="hidden" name="lang" value="<?php echo( ICL_LANGUAGE_CODE ); ?>" />
			<?php endif ?>

        </div>
    </form>
</div>