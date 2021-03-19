<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Agni Framework
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php echo esc_html( get_bloginfo( 'charset' ) ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php echo esc_url( get_bloginfo( 'pingback_url' ) ); ?>">
	
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-29X21S91KH"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());
		
		gtag('config', 'G-29X21S91KH');
	</script>
	<!--End Global site tag (gtag.js) - Google Analytics -->
	
	<!-- Facebook Pixel Code -->
	<script>
		!function(f,b,e,v,n,t,s)
		{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
			n.callMethod.apply(n,arguments):n.queue.push(arguments)};
		 if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
		 n.queue=[];t=b.createElement(e);t.async=!0;
		 t.src=v;s=b.getElementsByTagName(e)[0];
		 s.parentNode.insertBefore(t,s)}
		(window, document,'script','https://connect.facebook.net/en_US/fbevents.js');
		fbq('init', '585724802383873');
		fbq('track', 'PageView');
	</script>
	<noscript>
		<img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=585724802383873&ev=PageView&noscript=1"/>
	</noscript>
	<!-- End Facebook Pixel Code -->
	
	<?php wp_head(); ?>
</head>

<?php do_action( 'agni_header' ); ?>
