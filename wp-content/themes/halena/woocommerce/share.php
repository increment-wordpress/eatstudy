<?php
/**
 * Share template
 *
 * @author Your Inspiration Themes
 * @package YITH WooCommerce Wishlist
 * @version 2.0.13
 */

if ( ! defined( 'YITH_WCWL' ) ) {
    exit;
} // Exit if accessed directly
?>

<div class="yith-wcwl-share">
    <h4 class="yith-wcwl-share-title"><?php echo esc_html( $share_title ) ?></h4>
    <ul class="product-sharing-buttons sharing-buttons list-inline">
        <?php if( $share_facebook_enabled ): ?>
            <li>
                <a class="facebook" href="https://www.facebook.com/sharer.php?s=100&amp;p%5Btitle%5D=<?php echo esc_attr( $share_link_title ) ?>&amp;p%5Burl%5D=<?php echo urlencode( $share_link_url ) ?>" title="<?php _e( 'Facebook', 'halena' ) ?>"><i class="fa fa-facebook"></i></a>
            </li>
        <?php endif; ?>

        <?php if( $share_twitter_enabled ): ?>
            <li>
                <a class="twitter" href="https://twitter.com/share?url=<?php echo urlencode( $share_link_url ) ?>&amp;text=<?php echo esc_attr( $share_twitter_summary ) ?>" title="<?php _e( 'Twitter', 'halena' ) ?>"><i class="fa fa-twitter"></i></a>
            </li>
        <?php endif; ?>

        <?php if( $share_pinterest_enabled ): ?>
            <li>
                <a class="pinterest" href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode( $share_link_url ) ?>&amp;description=<?php echo esc_attr( $share_summary ) ?>" title="<?php _e( 'Pinterest', 'halena' ) ?>"><i class="fa fa-pinterest"></i></a>
            </li>
        <?php endif; ?>

        <?php if( $share_googleplus_enabled ): ?>
            <li>
                <a class="googleplus" href="https://plus.google.com/share?url=<?php echo urlencode( $share_link_url ) ?>&amp;title=<?php echo esc_attr( $share_link_title ) ?>" title="<?php _e( 'Google+', 'halena' ) ?>"><i class="fa fa-google-plus"></i></a>
            </li>
        <?php endif; ?>

        <?php if( $share_email_enabled ): ?>
            <li>
                <a class="email" href="mailto:?subject=<?php echo urlencode( apply_filters( 'yith_wcwl_email_share_subject', __( 'I wanted you to see this site', 'halena' ) ) )?>&amp;body=<?php echo apply_filters( 'yith_wcwl_email_share_body', urlencode( $share_link_url ) ) ?>&amp;title=<?php echo esc_attr( $share_link_title ) ?>" title="<?php _e( 'Email', 'halena' ) ?>"><i class="fa fa-envelope-o"></i></a>
            </li>
        <?php endif; ?>
    </ul>
</div>