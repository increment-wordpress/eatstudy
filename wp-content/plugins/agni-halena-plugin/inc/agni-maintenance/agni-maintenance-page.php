<?php
/**
 * Kills WordPress execution and display HTML message with error message.
 *
 * This is the default handler for wp_die if you want a custom one for your
 * site then you can overload using the {@see 'wp_die_handler'} filter in wp_die().
 *
 * @since 3.0.0
 * @access private
 *
 * @param string|WP_Error $message Error message or WP_Error object.
 * @param string          $title   Optional. Error title. Default empty.
 * @param string|array    $args    Optional. Arguments to control behavior. Default empty array.
 */

function agni_maintenance_wp_die_handler( $message, $title = '', $args = array() ) {

    $defaults = array( 'response' => 500 );
    $r = wp_parse_args($args, $defaults);

    $have_gettext = function_exists('__');

    if ( function_exists( 'is_wp_error' ) && is_wp_error( $message ) ) {
        if ( empty( $title ) ) {
            $error_data = $message->get_error_data();
            if ( is_array( $error_data ) && isset( $error_data['title'] ) )
                $title = $error_data['title'];
        }
        $errors = $message->get_error_messages();
        switch ( count( $errors ) ) {
        case 0 :
            $message = '';
            break;
        case 1 :
            $message = "<p>{$errors[0]}</p>";
            break;
        default :
            $message = "<ul>\n\t\t<li>" . join( "</li>\n\t\t<li>", $errors ) . "</li>\n\t</ul>";
            break;
        }
    } elseif ( is_string( $message ) ) {
        $message = "<p>$message</p>";
    }

    if ( isset( $r['back_link'] ) && $r['back_link'] ) {
        $back_text = $have_gettext? __('&laquo; Back', 'agni-halena-plugin') : '&laquo; Back';
        $message .= "\n<p><a href='javascript:history.back()'>$back_text</a></p>";
    }

    if ( ! did_action( 'admin_head' ) ) :
        if ( !headers_sent() ) {
            status_header( $r['response'] );
            nocache_headers();
            header( 'Content-Type: text/html; charset=utf-8' );
        }

        if ( empty($title) )
            $title = $have_gettext ? __('WordPress &rsaquo; Error', 'agni-halena-plugin') : 'WordPress &rsaquo; Error';

        $text_direction = 'ltr';
        if ( isset($r['text_direction']) && 'rtl' == $r['text_direction'] )
            $text_direction = 'rtl';
        elseif ( function_exists( 'is_rtl' ) && is_rtl() )
            $text_direction = 'rtl';
?>
<!DOCTYPE html>
<!-- Ticket #11289, IE bug fix: always pad the error page with enough characters such that it is greater than 512 bytes, even after gzip compression abcdefghijklmnopqrstuvwxyz1234567890aabbccddeeffgghhiijjkkllmmnnooppqqrrssttuuvvwwxxyyzz11223344556677889900abacbcbdcdcededfefegfgfhghgihihjijikjkjlklkmlmlnmnmononpopoqpqprqrqsrsrtstsubcbcdcdedefefgfabcadefbghicjkldmnoepqrfstugvwxhyz1i234j567k890laabmbccnddeoeffpgghqhiirjjksklltmmnunoovppqwqrrxsstytuuzvvw0wxx1yyz2z113223434455666777889890091abc2def3ghi4jkl5mno6pqr7stu8vwx9yz11aab2bcc3dd4ee5ff6gg7hh8ii9j0jk1kl2lmm3nnoo4p5pq6qrr7ss8tt9uuvv0wwx1x2yyzz13aba4cbcb5dcdc6dedfef8egf9gfh0ghg1ihi2hji3jik4jkj5lkl6kml7mln8mnm9ono
-->
<html xmlns="http://www.w3.org/1999/xhtml" <?php if ( function_exists( 'language_attributes' ) && function_exists( 'is_rtl' ) ) language_attributes(); else echo "dir='$text_direction'"; ?>>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width">
    <?php
    global $halena_options;
    if ( function_exists( 'wp_no_robots' ) ) {
        wp_no_robots();
    }
    ?>
    <?php //wp_head(); ?>
    <link rel="stylesheet" href="<?php echo plugins_url( 'agni-maintenance-page.css', __FILE__ ); ?>" type="text/css" media="all" />  
</head>
<?php if( $halena_options['maintenance-mode-choice'] == '2' ){ ?>
<body id="error-page" class="error-page" style="background: <?php echo esc_attr( $halena_options['maintenance-mode-custom-bg']['background-color'] ); ?> url('<?php echo esc_url( $halena_options['maintenance-mode-custom-bg']['background-image'] ); ?>') <?php echo esc_attr( $halena_options['maintenance-mode-custom-bg']['background-repeat'] ); ?> <?php echo esc_attr( $halena_options['maintenance-mode-custom-bg']['background-attachment'] ); ?>; background-position: <?php echo esc_attr( $halena_options['maintenance-mode-custom-bg']['background-position'] ); ?>; background-size: <?php echo esc_attr( $halena_options['maintenance-mode-custom-bg']['background-size'] ); ?>; ">
<?php } 
else{ ?>
<body id="error-page" class="error-page">

<?php }?>
<?php endif; // ! did_action( 'admin_head' ) ?>
    <?php 
    if( $halena_options['maintenance-mode-choice'] == '1' ){
        $message = '<div id="header">
            <h4 class="agni-maintenance-mode-header-icon"><a title="'.esc_attr( get_bloginfo('name') ).'" href="'.esc_url( home_url('/') ).'">'.esc_html( get_bloginfo('name') ).'</a></h4>
        </div>  
        <div id="content" class="agni-maintenance-mode-content">
            <div class="maintenance-icon" data-icon="P"></div>
            <h1>'.esc_html__( 'We\'ll Be Right Back!', 'agni-halena-plugin' ).'</h1>
            <p>'.esc_html__( 'Sorry for the inconvenience. We\'re busy on making something cool for you.', 'agni-halena-plugin' ).'<br/>'.esc_html__( 'Please try after sometime.', 'agni-halena-plugin' ).'</p>
        </div>';
    }
    else{
        $message = $halena_options['maintenance-mode-custom'];
    }
    echo $message; ?>
    <?php //wp_footer(); ?>
</body>
</html>
<?php
    die();
}

// Activate WordPress Maintenance Mode
function wp_maintenance_mode(){

    if(!current_user_can('edit_themes') || !is_user_logged_in()){
        add_filter( 'wp_die_handler', 'agni_maintenance_wp_die_handler' );
        wp_die();
        remove_filter( 'wp_die_handler', 'agni_maintenance_wp_die_handler' );
    }

}
add_action( 'get_header', 'wp_maintenance_mode' );
