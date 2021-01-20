<?php 

function halena_options(){
	global $halena_options;	
	
	wp_enqueue_style( 'halena-custom-styles', AGNI_FRAMEWORK_CSS_URL . '/custom.css' );

	$style = '';
	if( isset($halena_options) ){
		/*if( $halena_options['loader'] != '1' ){
			$style .= 'body{
					visibility: hidden;
				}';
		}*/
			
		if( $halena_options['layout-container'] == '1' ){
			$style .= '/* Container */
			@media (min-width:768px) {
				.container {
					width: '.$halena_options['layout-container-768'].'px;
				}
				.boxed{
					width: '.$halena_options['layout-boxed-768'].'px;
				}
			}
			@media (min-width:992px) {
				.container, .container .megamenu .sub-menu {
					width: '.$halena_options['layout-container-992'].'px;
				}
				.boxed{
					width: '.$halena_options['layout-boxed-992'].'px;
				}
			}
			@media (min-width:1200px) {
				.container, .container .megamenu .sub-menu {
					width: '.$halena_options['layout-container-1200'].'px;
				}
				.boxed{
					width: '.$halena_options['layout-boxed-1200'].'px;
				}
			}
			@media (min-width:1500px) {
				.container, .container .megamenu .sub-menu{
					width: '.$halena_options['layout-container-1500'].'px;
				}
				.boxed{
					width: '.$halena_options['layout-boxed-1500'].'px;
				}
			}';
		}

		if( $halena_options['custom-logo-width'] == '1' ){
			$custom_width = esc_attr( $halena_options['custom-logo-width-value'] );
			$custom_height = esc_attr( $halena_options['custom-logo-height-value'] );
			$style .= '.header-icon img{
					max-width:'.$custom_width.'px;
				}
				.header-icon .header-logo-icon-svg{
					max-width:'.$custom_width.'px;
					height: '.$custom_height.'px;
				}';
			/*$custom_height = esc_attr( $halena_options['custom-logo-width-value'] );
			$nav_menu_line_height = ($custom_height - 24) + 80;

			$style .= '.header-icon img{
					max-height:'.$custom_height.'px;
					height:'.$custom_height.'px;
				}
				@media (max-width: 767px) {	
					.header-icon img {
						max-height:24px;
					}
				}';
			if( $halena_options['header-menu-style'] == 'default-header-menu' || $halena_options['header-menu-style'] == 'minimal-header-menu' ){
				$style .= '.nav-menu{
						line-height: '.$nav_menu_line_height.'px;
					}';
			}*/
		}

	
		$style .= '/* Halena Custom CSS */
		

			body{
				font-size: '.$halena_options['font-3-fontsize'].'px;
				line-height: '.$halena_options['font-3-lineheight'].';
				text-transform: '.$halena_options['font-3-text-transform'].';
			}
			h1, .h1{
				font-size: '.$halena_options['font-h1-fontsize'].'px;
			}
			h2, .h2{
				font-size: '.$halena_options['font-h2-fontsize'].'px;
			}
			h3, .h3{
				font-size: '.$halena_options['font-h3-fontsize'].'px;
			}
			h4, .h4{
				font-size: '.$halena_options['font-h4-fontsize'].'px;
			}
			h5, .h5{
				font-size: '.$halena_options['font-h5-fontsize'].'px;
			}
			h6, .h6{
				font-size: '.$halena_options['font-h6-fontsize'].'px;
			}

			ul.nav-menu-content:not(.additional-primary-nav-menu-content) >li, div.nav-menu-content:not(.additional-primary-nav-menu-content) ul > li, ul.nav-menu-content:not(.additional-primary-nav-menu-content) >li >a, div.nav-menu-content:not(.additional-primary-nav-menu-content) ul > li > a, .side-header-menu ul.tab-nav-menu-content >li >a, .side-header-menu div.nav-menu-content:not(.additional-primary-nav-menu-content) ul > li > a{
				font-size: '.$halena_options['header-fontsize'].'px;
			}
			.nav-menu a, .tab-nav-menu a, ul.nav-menu-content >li >a, div.nav-menu-content ul > li > a, .side-header-menu ul.tab-nav-menu-content >li >a, .side-header-menu div.nav-menu-content ul > li > a{
				text-transform: '.$halena_options['header-text-transform'].';
			}
			.nav-menu a, .tab-nav-menu a{
				font-size: '.$halena_options['header-fontsize-2'].'px;
			}
			.nav-menu a, .tab-nav-menu a{
				text-transform: '.$halena_options['header-text-transform-2'].';
			}
			
			.burg-text{
				color: '.$halena_options['header-minimal-menu-color'].';
			}
			@media (max-width: 1199px) {
				.header-navigation-menu.strip-header-menu{
					background-color: '.(!empty($halena_options['header-strip-bg-color-1']['rgba'])?$halena_options['header-strip-bg-color-1']['rgba']:'').';
				}
			}
			@media (min-width: 992px) {
				.header-menu-flex{
					min-height: '.$halena_options['header-min-height'].'px;
				}
			}
			@media (min-width: 1200px) {

				.strip-header-menu .activeBurg.burg:before, .strip-header-menu .activeBurg.burg:after{
					background-color: '.$halena_options['header-minimal-menu-color'].';
				}
				.strip-header-menu.header-sticky.top-sticky .toggle-nav-menu-additional .activeBurg.burg:before, .strip-header-menu.header-sticky.top-sticky .toggle-nav-menu-additional .activeBurg.burg:after{
					background-color: '.$halena_options['header-minimal-menu-color-2'].';
				}
			}
			.header-sticky.top-sticky .toggle-nav-menu-additional .burg-text{
				color: '.$halena_options['header-minimal-menu-color-2'].';
			}
			
			h1, h2, h3, h4, h5, h6,.h1,.h2,.h3,.h4,.h5,.h6, .primary-typo, .vc_tta-title-text{
				line-height: '.$halena_options['font-1-lineheight'].';
				text-transform: '.$halena_options['font-1-text-transform'].';
			}
			.section-sub-heading-text, .additional-typo{
				line-height: '.$halena_options['font-2-lineheight'].';
				text-transform: '.$halena_options['font-2-text-transform'].';
			}

			.has-menu-button ul.nav-menu-content >li:last-child >a, .has-menu-button div.nav-menu-content >ul >li:last-child >a{
				font-size: '.$halena_options['header-menu-button-fontsize'].'px;
			}
			/*.has-menu-button ul.nav-menu-content >li:last-child >a, .has-menu-button div.nav-menu-content >ul >li:last-child >a{
				color: '.$halena_options['header-menu-button-color'].' !important;
			}*/

			.header-menu-icons .header-lang-toggle{
				-webkit-box-ordinal-group: '.($halena_options['header-lang-order'] - 1).';
				-webkit-order: '.$halena_options['header-lang-order'].';
				-ms-flex-order: '.$halena_options['header-lang-order'].';
				order: '.$halena_options['header-lang-order'].';
			} 
			.header-menu-icons .header-wpml-toggle{
				-webkit-box-ordinal-group: '.($halena_options['header-wpml-order'] - 1).';
				-webkit-order: '.$halena_options['header-wpml-order'].';
				-ms-flex-order: '.$halena_options['header-wpml-order'].';
				order: '.$halena_options['header-wpml-order'].';
			}
			.header-menu-icons .header-myaccount-toggle{
				-webkit-box-ordinal-group: '.($halena_options['header-myaccount-order'] + 1).';
				-webkit-order: '.$halena_options['header-myaccount-order'].';
				-ms-flex-order: '.$halena_options['header-myaccount-order'].';
				order: '.$halena_options['header-myaccount-order'].';
			}
			.header-menu-icons .header-currency-toggle{
				-webkit-box-ordinal-group: '.($halena_options['header-currency-order'] + 1).';
				-webkit-order: '.($halena_options['header-currency-order'] + 1).';
				-ms-flex-order: '.$halena_options['header-currency-order'].';
				order: '.$halena_options['header-currency-order'].';
			}
			.header-menu-icons .header-cart-toggle{
				-webkit-box-ordinal-group: '.($halena_options['header-cart-order'] + 1).';
				-webkit-order: '.$halena_options['header-cart-order'].';
				-ms-flex-order: '.$halena_options['header-cart-order'].';
				order: '.$halena_options['header-cart-order'].';
			} 
			.header-menu-icons .header-search-toggle{
				-webkit-box-ordinal-group: '.($halena_options['header-search-box-order'] + 1).';
				-webkit-order: '.$halena_options['header-search-box-order'].';
				-ms-flex-order: '.$halena_options['header-search-box-order'].';
				order: '.$halena_options['header-search-box-order'].';
			} 
			.header-menu-icons .header-social-toggle{
				-webkit-box-ordinal-group: '.($halena_options['header-social-order'] + 1).';
				-webkit-order: '.$halena_options['header-social-order'].';
				-ms-flex-order: '.$halena_options['header-social-order'].';
				order: '.$halena_options['header-social-order'].';
			}
			.header-menu-icons .header-wishlist-toggle{
				-webkit-box-ordinal-group: '.($halena_options['header-wishlist-order'] + 1).';
				-webkit-order: '.$halena_options['header-wishlist-order'].';
				-ms-flex-order: '.$halena_options['header-wishlist-order'].';
				order: '.$halena_options['header-wishlist-order'].';
			}

			.special-typo{
				line-height: '.$halena_options['font-4-lineheight'].';
				text-transform: '.$halena_options['font-4-text-transform'].';
			}

			.preloader-style-2 .cssload-loader:before{
				border-color: '.$halena_options['loader-bg-color'].';
			}

			/* Halena Custom Colors */
			.additional-nav-menu a:hover, .nav-menu-content li a:hover, .nav-menu-content li a:active, .nav-menu-content li.current-menu-item:not(.current_page_item) > a, .nav-menu-content li ul li.current-menu-item:not(.current_page_item) > a, .nav-menu-content .current_page_ancestor .current-menu-item:not(.current_page_item) > a:hover, .tab-nav-menu a:hover, .header-toggle ul a:hover, .agni-slide-buttons .btn-white.btn-plain i, .post-author a, .post-sharing-buttons a:hover, .widget_halena_social_icons a:hover, .filter a:hover, .filter a:focus, .filter a.active, .agni-section-heading .section-heading-icon{
				color: '.$halena_options['color-1'].';
			}
			.owl-dot.active span, .ba-slider .handle span, .posts-navigation .nav-links a, .post-password-form input[type="submit"], .search-form .search-submit, .mc4wp-form input[type="submit"], .member-post .member-divide-line span {
				background-color: '.$halena_options['color-1'].';
			}
			blockquote, table thead th, .owl-dot span, .widget_halena_social_icons a:hover, .milestone-style-1  .mile-count h3:after, .feature-box-title:after {
				border-color: '.$halena_options['color-1'].';
			}

			input[type="text"], input[type="email"], input[type="url"], input[type="password"], input[type="search"], textarea, a, .h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6, .h1 .small, .h1 small, .h2 .small, .h2 small, .h3 .small, .h3 small, .h4 .small, .h4 small, .h5 .small, .h5 small, .h6 .small, .h6 small, h1 .small, h1 small, h2 .small, h2 small, h3 .small, h3 small, h4 .small, h4 small, h5 .small, h5 small, h6 .small, h6 small, .nav-menu a, .header-icon .logo-text, .nav-menu-content .current_page_ancestor .current-menu-item:not(.current_page_item) > a, .toggle-nav-menu, .footer-bar .textwidget i, .blog-single-post .tags-links a, .post-format-link:before, .post-format-quote:before, .comment-form input[type="submit"], .widget_tag_cloud a, .widget_halena_instagram .follow-link, .portfolio-post .portfolio-content-container, .mfp-image-popup .mfp-close-btn-in .mfp-close, .service-box i, .countdown-has-background .countdown-holder, .countdown-has-border .countdown-holder{
				color: '.$halena_options['color-2'].';
			}
			.burg, .burg:before, .burg:after, .cd-headline.type .cd-words-wrapper::after, .divide-line span, .progress-bar, .nav-tabs-style-3 .nav-tabs li.active, .accordion-style-3 .panel-title:not(.collapsed), .cssload-back{
				background-color: '.$halena_options['color-2'].';
			}
			.comment-form input[type="submit"], .sidebar .widget-title:after, .widget_halena_instagram .follow-link, .nav-tabs-style-1 .nav-tabs li.active a, .nav-tabs li a:hover, .nav-tabs li a:focus, .nav-tabs-style-2 .nav-tabs li.active, .accordion-style-3 .panel-title:not(.collapsed){
				border-color: '.$halena_options['color-2'].';
			}

			body, .header-social a, .post-sharing-buttons a, .portfolio-bottom-caption .portfolio-bottom-caption-category li{
				color: '.$halena_options['color-3'].';
			}

			/* Nav menu Color */
			.nav-menu-content li.current-menu-item:not(.current_page_item) > a, .nav-menu-content li ul li.current-menu-item:not(.current_page_item) > a, .nav-menu-content li.current-menu-item:not(.current_page_item) > a:hover, .nav-menu-content li ul li.current-menu-item:not(.current_page_item) > a:hover{
				color: '.$halena_options['header-menu-link-color-1']['hover'].';
			}
			.nav-menu-content .current_page_ancestor .current-menu-item:not(.current_page_item) > a {
			    color:'.$halena_options['header-menu-link-color-1']['regular'].';
			}
			.nav-menu-content .current_page_ancestor .current-menu-item:not(.current_page_item) > a:hover {
				color:'.$halena_options['header-menu-link-color-1']['hover'].';
			}

			/* Buttons */
			.btn-default, input.btn-default {
				color: #fff;
				background-color: '.$halena_options['color-3'].';
				border-color: '.$halena_options['color-3'].';
			}
			.btn-primary, input.btn-primary {
				color: #fff;
				background-color: '.$halena_options['color-2'].';
				border-color: '.$halena_options['color-2'].';
			}
			.btn-accent, input.btn-accent {
				color: #fff;
				background-color: '.$halena_options['color-1'].';
				border-color: '.$halena_options['color-1'].';
			}
			.btn-alt, .btn-alt:focus, .btn-alt:hover, input.btn-alt, input.btn-alt:focus, input.btn-alt:hover {
				background-color: transparent;
			}
			.btn-default.btn-alt, input.btn-default.btn-alt {
				color: '.$halena_options['color-3'].';
				border-color: '.$halena_options['color-3'].';
			}
			.btn-primary.btn-alt, input.btn-primary.btn-alt {
				color: '.$halena_options['color-2'].';
				border-color: '.$halena_options['color-2'].';
			}
			.btn-accent.btn-alt, input.btn-accent.btn-alt {
				color: '.$halena_options['color-1'].';
				border-color: '.$halena_options['color-1'].';
			}
			.btn-link {
				color: '.$halena_options['color-2'].';
				border-color: transparent;
			}
			.btn-link:hover {
				border-color: '.$halena_options['color-2'].';
			}

			/* Layout Content Padding */
			.has-padding, .has-padding .top-padding, .has-padding .bottom-padding, .has-padding .header-sticky, .has-padding .header-top-bar, .has-padding .header-navigation-menu{
				border-width: '.$halena_options['layout-padding-size']['border-top'].';
			}
			@media (max-width:767px) {
				.has-padding, .has-padding .top-padding, .has-padding .bottom-padding{
					border-width: 0;
				}
			}
			@media (min-width:1200px) {
				.has-padding .side-header-menu{
					margin-left: '.$halena_options['layout-padding-size']['border-top'].';
					margin-top: '.$halena_options['layout-padding-size']['border-top'].';
					bottom: '.$halena_options['layout-padding-size']['border-top'].';
				}
			}
			@media (min-width:768px) {
				.has-padding .mfp-main .mfp-container{
					border-width: '.$halena_options['layout-padding-size']['border-top'].';
				}
			}
			.has-padding, .has-padding .top-padding, .has-padding .bottom-padding, .has-padding .header-top-bar, .has-padding .header-navigation-menu, .has-padding .mfp-main .mfp-container{
				border-color: '.$halena_options['layout-padding-size']['border-color'].';
			}
			@media (min-width: 992px){
				.has-sticky-footer {
				    bottom: '.$halena_options['layout-padding-size']['border-top'].';
				}
			}

			.toggle-circled{
			    border-color: '.$halena_options['header-icon-link-color-1']['regular'].';
			}
			.header-social a, .header-toggle a, .header-toggle span{
			    color: '.$halena_options['header-icon-link-color-1']['regular'].';
			    fill: '.$halena_options['header-icon-link-color-1']['regular'].';
			}
			.header-toggle ul a:hover{
			    color: '.$halena_options['header-icon-link-color-1']['hover'].';
			}
			.header-sticky.top-sticky:not(.side-header-menu) .header-menu-icons-additional-color .toggle-circled{
			    border-color: '.$halena_options['header-icon-link-color-2']['regular'].';
			}
			.header-sticky.top-sticky:not(.side-header-menu) .header-menu-icons-additional-color .header-social a, .header-sticky.top-sticky:not(.side-header-menu) .header-menu-icons-additional-color .header-toggle a, .header-sticky.top-sticky:not(.side-header-menu) .header-menu-icons-additional-color .header-toggle span{
			    color: '.$halena_options['header-icon-link-color-2']['regular'].';
			    fill: '.$halena_options['header-icon-link-color-2']['regular'].';
			}
			.header-sticky.top-sticky:not(.side-header-menu) .header-menu-icons-additional-color .header-toggle ul a:hover{
			    color: '.$halena_options['header-icon-link-color-2']['hover'].';
			}
			
			.toggle-nav-menu{
				color: '.$halena_options['header-menu-link-color-1']['regular'].';
			}
			.header-sticky.top-sticky .toggle-nav-menu.toggle-nav-menu-additional{
				color: '.$halena_options['header-menu-link-color-2']['regular'].';
			}
			/*.burg-text{
				color: '.$halena_options['header-menu-link-color-1']['regular'].';
			}
			.burg, .burg:before, .burg:after{
				background-color: '.$halena_options['header-menu-link-color-1']['regular'].';
			}*/

			.header-sticky.top-sticky .toggle-nav-menu-additional .burg, .header-sticky.top-sticky .toggle-nav-menu-additional .burg:before, .header-sticky.top-sticky .toggle-nav-menu-additional .burg:after{
				background-color: '.$halena_options['header-menu-link-color-2']['regular'].';
			}
			.activeBurg.burg, .activeBurg.burg:before, .activeBurg.burg:after{
				background-color: '.$halena_options['header-menu-link-color-1']['regular'].';
			}
			.header-sticky.top-sticky .toggle-nav-menu-additional .activeBurg.burg, .header-sticky.top-sticky .toggle-nav-menu-additional .activeBurg.burg:before, .header-sticky.top-sticky .toggle-nav-menu-additional .activeBurg.burg:after{
				background-color: '.$halena_options['header-menu-link-color-1']['regular'].';
			}
			.header-navigation-menu .header-menu-content, .reverse_skin.header-sticky.top-sticky.header-navigation-menu.header-menu-border-additional:not(.side-header-menu) .header-menu-content, .reverse_skin.header-sticky.top-sticky.side-header-menu.header-menu-border-additional:not(.side-header-menu) .tab-nav-menu{
				border-top:0;
				border-left:0;
				border-right:0;
				border-bottom: ' . $halena_options['header-menu-border-1']['border-bottom'].';
			}
			.header-navigation-menu.center-header-menu .header-menu-content, .reverse_skin.header-sticky.top-sticky.header-navigation-menu.center-header-menu.header-menu-border-additional:not(.side-header-menu) .header-menu-content{
				border-top: ' . $halena_options['header-menu-border-1']['border-bottom'].';
			}
			.header-navigation-menu .header-menu-flex > div:first-child .header-icon, .reverse_skin.header-sticky.top-sticky.header-navigation-menu.header-menu-border-additional:not(.side-header-menu)  .header-menu-flex > div:first-child .header-icon{
				border-right: ' . $halena_options['header-menu-border-1']['border-bottom'].';
			}
			.header-navigation-menu:not(.center-header-menu) .header-menu-flex > div:last-child .header-menu-icons, .reverse_skin.header-sticky.top-sticky.header-navigation-menu.header-menu-border-additional:not(.side-header-menu):not(.center-header-menu) .header-menu-flex > div:last-child .header-menu-icons{
				border-left: ' . $halena_options['header-menu-border-1']['border-bottom'].';
			}
			.header-navigation-menu .header-menu-content, .reverse_skin.header-sticky.top-sticky.header-navigation-menu.header-menu-border-additional:not(.side-header-menu) .header-menu-content, .reverse_skin.header-sticky.top-sticky.side-header-menu.header-menu-border-additional:not(.side-header-menu) .tab-nav-menu, .header-navigation-menu.center-header-menu .header-menu-content, .reverse_skin.header-sticky.top-sticky.header-navigation-menu.center-header-menu.header-menu-border-additional:not(.side-header-menu) .header-menu-content, .header-navigation-menu .header-menu-flex > div:first-child .header-icon, .reverse_skin.header-sticky.top-sticky.header-navigation-menu.header-menu-border-additional:not(.side-header-menu)  .header-menu-flex > div:first-child .header-icon, .header-navigation-menu:not(.center-header-menu) .header-menu-flex > div:last-child .header-menu-icons, .reverse_skin.header-sticky.top-sticky.header-navigation-menu.header-menu-border-additional:not(.side-header-menu):not(.center-header-menu) .header-menu-flex > div:last-child .header-menu-icons{
				border-style: '  . $halena_options['header-menu-border-1']['border-style'].';
			}

			.header-sticky.top-sticky.header-navigation-menu.header-menu-border-additional:not(.side-header-menu) .header-menu-content, .header-sticky.top-sticky.side-header-menu.header-menu-border-additional:not(.side-header-menu) .tab-nav-menu, .reverse_skin.header-navigation-menu .header-menu-content{
				border-bottom: ' . $halena_options['header-menu-border-2']['border-bottom'].';
			}
			.header-sticky.top-sticky.header-navigation-menu.center-header-menu.header-menu-border-additional:not(.side-header-menu) .header-menu-content, .reverse_skin.header-navigation-menu.center-header-menu .header-menu-content{
				border-top: ' . $halena_options['header-menu-border-2']['border-bottom'].';
			}
			.header-sticky.top-sticky.header-navigation-menu.header-menu-border-additional:not(.side-header-menu) .header-menu-flex > div:first-child .header-icon, .reverse_skin.header-navigation-menu .header-menu-flex > div:first-child .header-icon{
				border-right: ' . $halena_options['header-menu-border-2']['border-bottom'].';
			}
			.header-sticky.top-sticky.header-navigation-menu.header-menu-border-additional:not(.side-header-menu):not(.center-header-menu) .header-menu-flex > div:last-child .header-menu-icons,.reverse_skin.header-navigation-menu:not(.center-header-menu) .header-menu-flex > div:last-child .header-menu-icons{
				border-left: ' . $halena_options['header-menu-border-2']['border-bottom'].';
			}
			.header-sticky.top-sticky.header-navigation-menu.header-menu-border-additional:not(.side-header-menu) .header-menu-content, .header-sticky.top-sticky.side-header-menu.header-menu-border-additional:not(.side-header-menu) .tab-nav-menu, .reverse_skin.header-navigation-menu .header-menu-content, 

			.header-sticky.top-sticky.header-navigation-menu.center-header-menu.header-menu-border-additional:not(.side-header-menu) .header-menu-content, .reverse_skin.header-navigation-menu.center-header-menu .header-menu-content, 

			.header-sticky.top-sticky.header-navigation-menu.header-menu-border-additional:not(.side-header-menu) .header-menu-flex > div:first-child .header-icon, .reverse_skin.header-navigation-menu .header-menu-flex > div:first-child .header-icon, 

			.header-sticky.top-sticky.header-navigation-menu.header-menu-border-additional:not(.side-header-menu):not(.center-header-menu) .header-menu-flex > div:last-child .header-menu-icons,.reverse_skin.header-navigation-menu:not(.center-header-menu) .header-menu-flex > div:last-child .header-menu-icons{
				border-style: '  . $halena_options['header-menu-border-2']['border-style'].';
			}
			
			/* Reverse Skin */
			.reverse_skin .toggle-circled{
			    border-color: '.$halena_options['header-icon-link-color-2']['regular'].';
			}
			.reverse_skin .header-social a, .reverse_skin .header-toggle a, .reverse_skin .header-toggle span{
			    color: '.$halena_options['header-icon-link-color-2']['regular'].';
			    fill: '.$halena_options['header-icon-link-color-2']['regular'].';
			}
			.reverse_skin .header-toggle ul a:hover{
			    color: '.$halena_options['header-icon-link-color-2']['hover'].';
			}
			.reverse_skin.header-sticky.top-sticky:not(.side-header-menu) .header-menu-icons-additional-color .toggle-circled{
			    border-color: '.$halena_options['header-icon-link-color-1']['regular'].';
			}
			.reverse_skin.header-sticky.top-sticky:not(.side-header-menu) .header-menu-icons-additional-color .header-social a, .reverse_skin.header-sticky.top-sticky:not(.side-header-menu) .header-menu-icons-additional-color .header-toggle a, .reverse_skin.header-sticky.top-sticky:not(.side-header-menu) .header-menu-icons-additional-color .header-toggle span{
			    color: '.$halena_options['header-icon-link-color-1']['regular'].';
			    fill: '.$halena_options['header-icon-link-color-1']['regular'].';
			}
			.reverse_skin.header-sticky.top-sticky:not(.side-header-menu) .header-menu-icons-additional-color .header-toggle ul a:hover{
			    color: '.$halena_options['header-icon-link-color-1']['hover'].';
			}
			
			.reverse_skin .toggle-nav-menu{
				color: '.$halena_options['header-menu-link-color-2']['regular'].';
			}
			.reverse_skin.header-sticky.top-sticky .toggle-nav-menu.toggle-nav-menu-additional{
				color: '.$halena_options['header-menu-link-color-1']['regular'].';
			}
			.reverse_skin .burg, .reverse_skin .burg:before, .reverse_skin .burg:after{
				background-color: '.$halena_options['header-menu-link-color-2']['regular'].';
			}

			.reverse_skin.header-sticky.top-sticky .toggle-nav-menu-additional .burg, .reverse_skin.header-sticky.top-sticky .toggle-nav-menu-additional .burg:before, .reverse_skin.header-sticky.top-sticky .toggle-nav-menu-additional .burg:after{
				background-color: '.$halena_options['header-menu-link-color-1']['regular'].';
			}
			.reverse_skin .activeBurg.burg, .reverse_skin .activeBurg.burg:before, .reverse_skin .activeBurg.burg:after{
				background-color: '.$halena_options['header-menu-link-color-1']['regular'].';
			}
			.reverse_skin.header-sticky.top-sticky .toggle-nav-menu-additional .activeBurg.burg, .reverse_skin.header-sticky.top-sticky .toggle-nav-menu-additional .activeBurg.burg:before, .reverse_skin.header-sticky.top-sticky .toggle-nav-menu-additional .activeBurg.burg:after{
				background-color: '.$halena_options['header-menu-link-color-1']['regular'].';
			}

			.footer-social .circled{
				color: '.$halena_options['footer-social-link-color']['regular'].';
			}
			.footer-social a, .footer-social .circled{
				color: '.$halena_options['footer-social-link-color']['regular'].';
			}
			.footer-social .circled{
				border-color: '.$halena_options['footer-social-link-color']['regular'].';
			}
			.footer-social a:hover, .footer-social .circled:hover{
				color: '.$halena_options['footer-social-link-color']['hover'].';
			}
			.footer-social .circled:hover{
				border-color: '.$halena_options['footer-social-link-color']['hover'].';
			}
			/*.activeBurg.burg, .header-sticky.top-sticky .toggle-nav-menu-additional .activeBurg.burg, .reverse_skin .activeBurg.burg, .reverse_skin.header-sticky.top-sticky .toggle-nav-menu-additional .activeBurg.burg{
				background-color: transparent;
			}*/
			.portfolio-navigation-container .post-navigation a {
			    background-color: transparent;
		}';
	}

	// Woocommerce
	if( isset($halena_options) && class_exists('WooCommerce') ){
		$style .= '.woocommerce .price, .woocommerce .price ins, .woocommerce .star-rating:before, .woocommerce .star-rating span:before, .woocommerce .widget_price_filter .price_slider_amount .button, .woocommerce #comments .star-rating span:before, .woocommerce p.stars a.star-1:after, .woocommerce p.stars a.star-2:after, .woocommerce p.stars a.star-3:after, .woocommerce p.stars a.star-4:after, .woocommerce p.stars a.star-5:after, .woocommerce .page-cart-summary .shop_table input[type="submit"], .woocommerce .page-cart-summary .shop_table .coupon input[type="submit"]:hover, .woocommerce-shipping-calculator .shipping-calculator-button, .woocommerce .checkout_coupon input[type="submit"], .woocommerce .woocommerce-checkout-review-order-table .order-total span, .woocommerce-MyAccount-navigation li.is-active a, .single-product-page .yith-wcwl-add-to-wishlist a.add_to_wishlist:before, .single-product-page .yith-wcwl-wishlistexistsbrowse a:before, .single-product-page .yith-wcwl-wishlistaddedbrowse a:before, .single-product-page a.compare:before, .single-product-page .yith-wcwl-wishlistexistsbrowse a:before, .single-product-page .yith-wcwl-wishlistaddedbrowse a:before{
				color: '.$halena_options['color-1'].';
			}
			.woocommerce .products .product-thumbnail .product-buttons a.add_to_cart_button.loading, .woocommerce .products .product-thumbnail .product-buttons a.add_to_cart_button.added, .woocommerce-dropdown-list, .woocommerce .sidebar .widget_shopping_cart .buttons a, .woocommerce .widget_price_filter .ui-slider .ui-slider-handle, .woocommerce .widget_price_filter .ui-slider .ui-slider-range, .single-product-page .single-product-description button, .product-type-external .single-product-page .single-product-description a.single_add_to_cart_button, .woocommerce .page-cart-calculation .cart-collaterals .wc-proceed-to-checkout a:hover, .woocommerce .login input[type="submit"], .woocommerce-checkout-payment .place-order input[type="submit"]:hover, .header-cart-toggle .buttons a, #yith-quick-view-close, #yith-quick-view-content .single_add_to_cart_button, #cboxClose{
				background-color: '.$halena_options['color-1'].';
			}
			.woocommerce .widget_price_filter .price_slider_amount .button{
				border-color: '.$halena_options['color-1'].';
			}

			.woocommerce .sidebar .widget_shopping_cart .remove, .woocommerce-billing-fields label, .shipping_address label{
				color: '.$halena_options['color-2'].';
			}
			.woocommerce .page-cart-calculation .cart-collaterals .wc-proceed-to-checkout a, .woocommerce .page-cart-calculation .cart-collaterals .wc-proceed-to-checkout a, .woocommerce .cart_totals .shipping-calculator-form button, .woocommerce-checkout-payment .place-order input[type="submit"], .woocommerce-MyAccount-content .edit-account input[type="submit"], .woocommerce .track_order input[type="submit"]{
				background-color: '.$halena_options['color-2'].';
			}
			.woocommerce .cart_totals .shipping-calculator-form button, .woocommerce .wishlist_table td.product-add-to-cart a{
				border-color: '.$halena_options['color-2'].';
			}
			.woocommerce .price del, .woocommerce-dropdown-list, .toggle-woocommerce-dropdown, .single-product-page .single-product-description del .amount, .single-product-page .single-product-description table .label{
				color: '.$halena_options['color-3'].';
			}
			.woocommerce .lost_reset_password input[type="submit"]{
				background-color: '.$halena_options['color-3'].';
			}';
	}

	wp_add_inline_style( 'halena-custom-styles', $style );
	
	//custom css
	if(!empty($halena_options["css-code"])){
		wp_add_inline_style( 'halena-custom-styles', $halena_options["css-code"] );
	}
	
	//custom js
	if(!empty($halena_options["js-code"])){
		wp_add_inline_script( 'jquery-migrate', '(function($) {' . $halena_options["js-code"] . ' })(jQuery)' );
	}
	
}
add_action( 'wp_enqueue_scripts', 'halena_options', 999 );

?>