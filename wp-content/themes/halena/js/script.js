// JavaScript Document
(function ($) {
	"use strict";
	// makes sure the whole site is loaded	
	$(window).on('load', function () {

		// will first fade out the loading animation
		$(".preloader").fadeOut(500, function () {
			$("body").css({ 'visibility': 'visible' });
		});

		// if (!(/Android|iPhone|iPad|iPod|BlackBerry/i).test(navigator.userAgent || navigator.vendor || window.opera)) {
		// 	// youtube video
		// 	$(".player").each(function () {
		// 		var $this = $(this);
		// 		if ($this.hasClass('player-yt')) {
		// 			$this.YTPlayer();
		// 		}
		// 		else if ($this.hasClass('player-vimeo')) {
		// 			$this.vimeo_player();
		// 		}
		// 		//$(this).YTPlayer();
		// 	});
		// }
		// else {
		// 	// youtube video fallback
		// 	$(".player").each(function () {
		// 		$(this).addClass('player-background');
		// 	});
		// 	$('.section-video-controls').css({ 'display': 'none' });
		// }

		// youtube video
		$(".player").each(function () {
			var $this = $(this);

			if (!(/Android|iPhone|iPad|iPod|BlackBerry/i).test(navigator.userAgent || navigator.vendor || window.opera) || $this.hasClass('has-mobile-video')) {
				if ($this.hasClass('player-yt')) {
					$this.YTPlayer();
				}
				else if ($this.hasClass('player-vimeo')) {
					$this.vimeo_player();
				}
				//$(this).YTPlayer();
			}
			else {
				// youtube video fallback
				$this.addClass('player-background');
				$('.section-video-controls').css({ 'display': 'none' });
			}
		})

		if (!(/Android|iPhone|iPad|iPod|BlackBerry/i).test(navigator.userAgent || navigator.vendor || window.opera)) {
			// skrollr
			skrollr.init({
				smoothScrolling: false,
				mobileDeceleration: 0.004,
				forceHeight: false
			});
		}
		else if ($('body').hasClass('has-parallax-mobile')) {
			// skrollr
			skrollr.init({
				mobileCheck: function () {
					//hack - forces mobile version to be off
					return false;
				},
				smoothScrolling: false,
				mobileDeceleration: 0.004,
				forceHeight: false
			});
			$(".agni-slides").css({ "touch-action": "auto" });

		}
		else {
			// skrollr fallback
			$('html').addClass('no-Skrollr');
		}


		// Newsletter Popup window
		$('.agni-popup-box').each(function () {
			var $this = $(this);
			var visits = Cookies.get('visits') || 0;
			visits++;

			Cookies.set('visits', visits, { expires: 1, path: '/' });

			if (Cookies.get('visits') > 1) {
				$this.removeClass('agni-popup-box-show');
			}
			else {
				$this.addClass('agni-popup-box-show');
			}

			$this.find('.agni-popup-box-overlay, .agni-popup-box-close').on('click', function () {
				$this.removeClass('agni-popup-box-show');
			});

		})

	})

	jQuery(document).on('ready', function () {
		/*$('body:not(.vc_editor) .preloader').each(function(){
			if( $(this).data('preloader-style') == '1' ){
				$('body').jpreLoader({
					splashID: "#preloader-1",
					loaderVPos: '50%',
					autoClose: $(this).data('close-button'),
					closeBtnText: $(this).data('close-button-text'),
				}, function(){
					// callback
				});
			}
		})	*/
		//$("body").css({'visibility':'visible'}); 

		if ((/Android|iPhone|iPad|iPod|BlackBerry/i).test(navigator.userAgent || navigator.vendor || window.opera) && !$('body').hasClass('has-animation-mobile')) {
			$("div").removeClass('animate');
		}
		// browser check
		var is_chrome = navigator.userAgent.indexOf('Chrome') > -1;
		var is_explorer = navigator.userAgent.indexOf('MSIE') > -1 || navigator.appVersion.indexOf('Trident/') > 0;
		var is_firefox = navigator.userAgent.indexOf('Firefox') > -1;
		var is_safari = navigator.userAgent.indexOf("Safari") > -1;
		var is_opera = !!window.opera || navigator.userAgent.indexOf(' OPR/') >= 0;
		if ((is_chrome) && (is_safari)) { is_safari = false; }

		if (is_safari) {
			$('html').addClass('safari');
		}
		else if (is_explorer) {
			$('html').addClass('ie');
		}
		else if (is_firefox) {
			$('html').addClass('firefox');
		}
		else if (is_opera) {
			$('html').addClass('opera');
		}
		else {
			$('html').addClass('chrome');
		}

		// back to top			
		var offset = 400;
		var duration = 1000;
		$('.back-to-top').fadeOut(duration);
		$(window).on('scroll', function () {
			($(this).scrollTop() > offset) ? $('.back-to-top').fadeIn(duration) : $('.back-to-top').fadeOut(duration);
		});

		$('.back-to-top').on('click', function (event) {
			event.preventDefault();
			$('html, body').animate({ scrollTop: 0 }, duration);
			return false;
		})

		$.fn.agni_content_min_height_detection = function () {
			var $footer_height = $('.site-footer').height();
			var $header_height = $('.header-navigation-menu:not(.transparent-header-menu)').height();
			var $window_height = window.innerHeight;
			var new_height = $window_height - ($footer_height + $header_height);
			$("#content").css({ 'min-height': new_height + "px" })

		}
		if (window.innerHeight >= $(document).height()) {
			$(document).agni_content_min_height_detection();
		}

		// one page scroll
		$('.page-scroll a').on('click', function (event) {
			if ($(this).is('[href*="#"]')) {
				$('html, body').stop().animate({
					scrollTop: ($('.header-sticky').height() && !$('.header-sticky').hasClass('side-header-menu')) ? $(this.hash).offset().top - 50 : $(this.hash).offset().top,
				}, 1500, 'easeInOutExpo');
				event.preventDefault();
			}
		});

		// Agni Slider Image width Calculation
		$.fn.agni_slider_img_custom_width_calc = function () {
			$(this).each(function () {
				if (window.innerWidth >= 768 && window.innerWidth <= 991) {
					$(this).find('img').css({ 'max-width': $(this).data('width-tab') });
				}
				else if (window.innerWidth <= 767) {
					$(this).find('img').css({ 'max-width': $(this).data('width-mobile') });
				}
				else {
					$(this).find('img').css({ 'max-width': $(this).data('width') });
				}
			});
		}
		$('.agni-slide-image').each(function () {
			$(this).agni_slider_img_custom_width_calc();
		});
		$(window).on('resize', function () {
			$('.agni-slide-image').each(function () {
				$(this).agni_slider_img_custom_width_calc();
			});
		});

		// Agni Slider Content width Calculation
		$.fn.agni_slider_content_custom_width_calc = function () {
			$(this).each(function () {
				if (window.innerWidth >= 768 && window.innerWidth <= 991) {
					$(this).css({ 'max-width': $(this).data('content-width-tab') });
				}
				else if (window.innerWidth <= 767) {
					$(this).css({ 'max-width': $(this).data('content-width-mobile') });
				}
				else {
					$(this).css({ 'max-width': $(this).data('content-width') });
				}
			});
		}
		$('.agni_custom_content_width').each(function () {
			$(this).agni_slider_content_custom_width_calc();
		});
		$(window).on('resize', function () {
			$('.agni_custom_content_width').each(function () {
				$(this).agni_slider_content_custom_width_calc();
			});
		});

		// Agni Slider & Page Header Height Calculation
		$.fn.full_height_calc = function () {
			$(this).each(function () {
				var viewport_height = $(window).height();
				var top_bar_transparent = $('.header-top-bar').data('transparent');
				var top_bar_height = (top_bar_transparent !== undefined && top_bar_transparent != '1') ? $('.header-top-bar').height() : '';
				var navigation_menu_height = '';
				if (!$('.header-navigation-menu').is('.strip-header-menu, .side-header-menu')) {
					navigation_menu_height = ($('.header-navigation-menu').data('transparent') != '1') ? $('.header-navigation-menu').height() : '';
				}
				var border_header_footer = ($('.border-header-menu-footer').height()) ? $('.border-header-menu-footer').height() : '';
				var ignore_height = +navigation_menu_height + +top_bar_height + +border_header_footer;

				$(this).css('height', viewport_height - ignore_height)
			});
		}
		$.fn.custom_height_calc = function () {
			$(this).each(function () {
				if (window.innerWidth >= 768 && window.innerWidth <= 1024) {
					$(this).css({ 'height': $(this).data('height-tab') });
				}
				else if (window.innerWidth <= 767) {
					$(this).css({ 'height': $(this).data('height-mobile') });
				}
				else {
					$(this).css({ 'height': $(this).data('height') });
				}
			});
		}

		// Agni Slider function
		$.fn.agni_slider = function () {
			var $this = $(this);
			if ($this.data('slider-choice') == '1') {
				$this.full_height_calc();
				$(window).on('resize', function () {
					$('.agni-slider').full_height_calc();
				});
			}
			else if ($this.data('slider-choice') == '2') {
				$this.custom_height_calc();
				$(window).on('resize', function () {
					$('.agni-slider').custom_height_calc();
				});
			}

			$this.slick({
				slide: '.agni-slide',
				slidesToScroll: 1,
				slidesToShow: $this.data('slider-slide-to-show'), //1,
				autoplay: $this.data('slider-autoplay'),
				autoplaySpeed: $this.data('slider-autoplay-speed'),
				appendArrows: $this.children('.slick-nav'),
				appendDots: $this.children('.slick-nav'),
				arrows: $this.data('slider-arrows'),
				nextArrow: $this.data('slider-arrows-next'),
				prevArrow: $this.data('slider-arrows-prev'),
				centerMode: $this.data('slider-center-mode'),
				dots: $this.data('slider-dots'),
				fade: $this.data('slider-fade'),
				draggable: $this.data('slider-draggable'),
				infinite: $this.data('slider-infinite'),
				speed: $this.data('slider-speed'),
				rtl: $this.data('rtl'),
				responsive: [{
					breakpoint: 1200, //large
					settings: {
						slidesToShow: $this.data('slider-slide-to-show-1200'),
					}
				}, {
					breakpoint: 992, //desktop
					settings: {
						slidesToShow: $this.data('slider-slide-to-show-992'),
					}
				}, {
					breakpoint: 768, //mobile
					settings: {
						slidesToShow: $this.data('slider-slide-to-show-768'),
					}
				}],
			});
		}

		// Agni Slider 
		$('.agni-slider').each(function () {
			$(this).agni_slider();
		});

		// Gradient Map Overlay
		$('.gradient-map-overlay').each(function () {
			var gm_value = $(this).data('gm');
			GradientMaps.applyGradientMap($(this)[0], gm_value);
		});

		// Particle ground function
		$.fn.agni_particle_ground = function () {
			$(this).particleground({
				density: 12000, // How many particles will be generated: one particle every n pixels
				dotColor: $(this).data('color'),
				lineColor: $(this).data('color'),
				particleRadius: 3, // Dot size
				lineWidth: 0.35,
				proximity: 75, // How close two dots need to be before they join
				parallaxMultiplier: 15, // The lower the number, the more extreme the parallax effect
			});
		}

		// Particle ground
		$('.particles').each(function () {
			$(this).agni_particle_ground();
		})

		// Strip menu
		$.fn.is_visible = function () {
			return this.css('visibility');
		};

		$.fn.visibilityToggle = function () {
			return this.css('visibility', function (i, visibility) {
				return (visibility == 'visible') ? 'hidden' : 'visible';
			});
		};

		$('.strip-header-menu .strip-header-menu-toggle').on('click', function (t) {
			t.preventDefault();
			if ($(this).parents('.strip-header-bar').siblings('.strip-header-menu-container').css('visibility') == 'hidden') {
				$(this).parents('.strip-header-menu').addClass('strip-header-menu-opened');
				$('.strip-header-menu-content').css({ 'left': '250px' });
			}
			else {
				$(this).parents('.strip-header-menu').removeClass('strip-header-menu-opened');
				$('.strip-header-menu-content').css({ 'left': '0px' });
			}

			var burg_text = $(this).children('.burg-text').data('burg-text');
			var burg_text_active = $(this).children('.burg-text').data('burg-text-active');
			var burg_text_display = $(this).children('.burg-text').text();

			if (burg_text == burg_text_display) {
				$(this).children('.burg-text').text(burg_text_active).animate(5000);
			}
			else {
				$(this).children('.burg-text').text(burg_text).animate(5000);
			}

		});

		// Header toggle class for offset function
		$.fn.agni_offset_toggle_class = function (offset, selector, reverse) {
			if (reverse == 1) {
				($(window).scrollTop() < offset) ? $(this).addClass(selector) : $(this).removeClass(selector);
			}
			else {
				($(window).scrollTop() < offset) ? $(this).removeClass(selector) : $(this).addClass(selector);
			}
			return this;
		};

		// Header spacer function
		$.fn.agni_spacer = function () {
			var $headerMenuHeight = (window.innerWidth < 1200) ? $('.header-navigation-menu:not(.transparent-header-menu)').height() : $('.header-navigation-menu:not(.transparent-header-menu, .side-header-menu)').height();
			var $headerTopHeight = ($('.header-top-bar:not(.transparent-header-menu)').is(":visible")) ? $('.header-top-bar:not(.transparent-header-menu)').height() : 0;
			var $spacerHeight = $headerTopHeight + $headerMenuHeight;
			$('.spacer').css({ 'height': $spacerHeight });
			return this;
		};

		// Header menu sticky
		$('.header-navigation-menu').each(function () {
			var $element = $(this);
			// Header Sticky
			if ($element.data('sticky') == '1') {
				$element.agni_offset_toggle_class(400, 'top-sticky');
				$(window).on('scroll', function () {
					$element.agni_offset_toggle_class(400, 'top-sticky');
				});

				if ($element.data('sticky-fancy') == '1') {
					// Hide Header on on scroll down
					var lastScrollTop = 0;
					var min = 10;
					var topvalue = ($('#wpadminbar').outerHeight()) ? $('#wpadminbar').outerHeight() : 0;
					var navbarHeight = $element.outerHeight();
					$(window).on('scroll', function (event) {
						if ($element.hasClass('header-sticky-nav-up')) {
							$('.header-sticky-nav-up').css({ 'top': -navbarHeight + topvalue });
						}
						else {
							$('.header-sticky-nav-down').css({ 'top': topvalue });
						}

						var st = $(this).scrollTop();
						// Make sure they scroll more than min value
						if (Math.abs(lastScrollTop - st) <= min)
							return;

						// If they scrolled down and are past the navbar, add class .nav-up.
						// This is necessary so you never see what is "behind" the navbar.
						if (st > lastScrollTop && st > navbarHeight) {
							// Scroll Down
							$element.removeClass('header-sticky-nav-down').addClass('header-sticky-nav-up');
							$('.agni-nav-menu').css({ 'top': '' });
						} else {
							// Scroll Up
							if (st + $(window).height() < $(document).height()) {
								$element.removeClass('header-sticky-nav-up').addClass('header-sticky-nav-down');
								if ($('.agni-nav-menu').hasClass('agni-nav-menu-sticky')) {
									$('.agni-nav-menu').css({ 'top': '50px' });
								}
								else {
									$('.agni-nav-menu').css({ 'top': '' });
								}
							}
						}

						lastScrollTop = st;
					});
				}
			}

			// Header Transparent
			if ($element.data('transparent') == '1') {
				$element.agni_offset_toggle_class(400, 'transparent-header-menu', 1);
				$(window).on('scroll', function () {
					$element.agni_offset_toggle_class(400, 'transparent-header-menu', 1);
				});
			}
			// Header Shrink
			if ($element.data('shrink') != '1' && $element.hasClass('header-sticky')) {
				$element.agni_offset_toggle_class(400, 'shrink-header-menu');
				$(window).on('scroll', function () {
					$element.agni_offset_toggle_class(400, 'shrink-header-menu');
				});
			}

			// Header Spacer
			if ($element.data('transparent') != '1') {
				$element.agni_spacer();
				$(window).on('resize', function () {
					$element.agni_spacer();
				})
			}

		});

		// Header Cart
		$('.header-cart-toggle .cart-contents:not(.cart-link-enable)').on('click', function (c) {
			c.preventDefault();
		})

		// Header Search
		$('.header-search-toggle').on('click', function (c) {

			$('.header-search').removeClass('search-invisible');

			setTimeout(function () {
				$('.header-search #agnidgwt-wcas-search').focus();
			}, 800);

		});

		$('.header-search .header-search-close').on('click', function () {
			$('.header-search').addClass('search-invisible');
		});


		// tab-nav-menu
		$.fn.agni_tab_nav_menu_accordion = function (option) {
			var obj,
				item;
			var options = $.extend({
				Speed: 220,
				autostart: true,
				autohide: 1
			},
				option);
			obj = $(this);

			obj.find('.tab-nav-menu-content li.menu-item-has-children').append('<span class="has-dropdown-menu"></span>');
			if (obj.data('page-link') == 1) {
				item = obj.find("ul").parent("li").children("span");
			}
			else {
				item = obj.find("ul").parent("li").children("a, span");
			}
			item.attr("data-option", "off");

			item.unbind('click').on("click", function (m) {
				m.preventDefault();
				var a = $(this);
				if (options.autohide) {
					a.parent().parent().find("a[data-option='on']").parent("li").children("ul").slideUp(options.Speed / 1.2,
						function () {
							$(this).parent("li").children("a").attr("data-option", "off");
						})
				}
				if (a.attr("data-option") == "off") {
					a.parent("li").children("ul").slideDown(options.Speed,
						function () {
							a.attr("data-option", "on");
						});
				}
				if (a.attr("data-option") == "on") {
					a.attr("data-option", "off");
					a.parent("li").children("ul").slideUp(options.Speed)
				}
			});
			if (options.autostart) {
				obj.find("a").each(function () {

					$(this).parent("li").parent("ul").slideDown(options.Speed,
						function () {
							$(this).parent("li").children("a").attr("data-option", "on");
						})
				})
			}

		}

		$('.header-menu-toggle').on('click', function (e) {
			e.preventDefault();
			$('.tab-nav-menu >ul >li').animate({
				opacity: 0
			}, 200).animate({
				bottom: '-25px'
			}, 50);

			if ($('.tab-nav-menu-wrap').hasClass('tab-invisible')) {
				$('.tab-nav-menu-wrap').removeClass('tab-invisible');
				//$('.tab-nav-menu').removeClass('tab-invisible');
				$(this).find('.burg').addClass('activeBurg');
			}
			else {
				$('.tab-nav-menu-wrap').addClass('tab-invisible');
				//$('.tab-nav-menu').addClass('tab-invisible');
				$(this).find('.burg').removeClass('activeBurg');
			}
			$('.tab-nav-menu-wrap .tab-nav-menu-overlay').on('click', function () {
				$('.tab-nav-menu-wrap').addClass('tab-invisible');
			});
			var delay = 600;
			var duration = 400;
			if ($(".header-navigation-menu").hasClass("strip-header-menu")) {
				delay = 250;
			}
			$('.tab-nav-menu >ul >li').each(function () {
				$(this).delay(delay).animate({
					opacity: 1,
					bottom: 0,
				}, duration);
				delay += 150;
			});
		})

		$(".tab-nav-menu").agni_tab_nav_menu_accordion({
			Speed: 200,
			autostart: false,
			autohide: true
		});
		if (!$('.header-navigation-menu').hasClass('strip-header-menu') || window.innerWidth <= 1199) {
			$(".header-navigation-menu .tab-nav-menu-content li:not('.menu-item-has-children') a").on('click', function (m) {
				/*$('.tab-nav-menu').animate({
					opacity: 0
				}, 100 );
				$('.tab-nav-menu').delay(600).animate({
					right: '-100%'
				}, 50 );
				$('.tab-nav-menu').delay(700).animate({
					opacity: 1
				}, 50 );*/
				$('.tab-nav-menu-wrap').removeClass('tab-visible').addClass('tab-invisible');
				$('.header-menu-toggle').find('.burg').removeClass('activeBurg');
			});
		}

		// Footer Sticky
		$.fn.footer_height_detection = function () {
			$this = $(this);
			return (window.innerWidth > 991) ? $this.siblings('.content').css({ 'margin-bottom': $this.height() }) : $this.siblings('.content').css({ 'margin-bottom': '0' });
		}
		$('.has-sticky-footer').footer_height_detection();
		$(window).on('resize', function () {
			$('.has-sticky-footer').footer_height_detection();
		});

		// Custom Nav menu Sticky
		$('.agni-nav-menu').each(function () {
			var $element = $(this);
			var distance = $element.offset().top;
			$(this).parents('.section-row').css({ 'z-index': '1' });
			if ($('.header-navigation-menu').data('sticky') == '1' && !$('.header-navigation-menu').data('sticky-fancy') == '1') {
				distance = $element.offset().top - 50;
			}
			if ($element.data('sticky') == '1') {
				$element.agni_offset_toggle_class(distance, 'agni-nav-menu-sticky');
				$(window).on('scroll', function () {
					$element.agni_offset_toggle_class(distance, 'agni-nav-menu-sticky');
					if ($('.header-navigation-menu').data('sticky') == '1' && !$('.header-navigation-menu').data('sticky-fancy') == '1') {
						if ($('.agni-nav-menu').hasClass('agni-nav-menu-sticky')) {
							$('.agni-nav-menu-sticky').css({ 'top': '50px' });
						}
						else {
							$('.agni-nav-menu').css({ 'top': '' });
						}
					}
				});
			}
		});

		// mbYTPlayer controls 
		$('.player').each(function () {
			// $(this).on("YTPPlay", function (e) {
			// 	$(this).siblings('div').children('.command-play').css({ 'display': 'none' });
			// 	$(this).siblings('div').children('.command-pause').css({ 'display': 'inline-block' });
			// });
			// $(this).on("YTPPause", function (e) {
			// 	$(this).siblings('div').children('.command-pause').css({ 'display': 'none' });
			// 	$(this).siblings('div').children('.command-play').css({ 'display': 'inline-block' });
			// });

			// $(this).siblings('div').find('.command-play').click(function (event) {
			// 	event.preventDefault();
			// 	$(this).parent('div').parent('div').find(".player").YTPPlay();
			// })
			// $(this).siblings('div').find('.command-pause').click(function (event) {
			// 	event.preventDefault();
			// 	$(this).parent('div').parent('div').find(".player").YTPPause();
			// })

			var $this = $(this);
			var $btn_div = $this.siblings('.section-video-controls');


			$this.on("YTPPlay", function (e) {
				$btn_div.find('.command-play').css({ 'display': 'none' });
				$btn_div.find('.command-pause').css({ 'display': 'inline-block' });
			});
			$this.on("YTPPause", function (e) {
				$btn_div.find('.command-pause').css({ 'display': 'none' });
				$btn_div.find('.command-play').css({ 'display': 'inline-block' });
			});

			$btn_div.find('.command-play').click(function (event) {
				event.preventDefault();
				$this.YTPPlay();
			})
			$btn_div.find('.command-pause').click(function (event) {
				event.preventDefault();
				$this.YTPPause();
			})

		});

		// Before & After Slider
		$('.ba-slider').each(function () {
			$(this).beforeAfter();
		});

		// Mile Count up function
		$.fn.agni_milestone_count = function (options) {
			$('.mile-count .count').each(function () {
				if ($(this).data('count-animation') == '1') {
					var defaults = {
						startVal: 0,
						endVal: $(this).attr("data-count"),
						duration: 1.5,
						options: {
							useEasing: true,
							useGrouping: true,
							decimals: '',
							separator: $(this).attr("data-sep"),
							prefix: $(this).attr("data-pre"),
							suffix: $(this).attr("data-suf")
						}
					},
						options = $.extend({}, defaults, options);
					var mile_count = new countUp(this, options.startVal, options.endVal, options.decimals, options.duration, options.options);

					var $element = $(this);
					$element.waypoint(function () {
						mile_count.start();
						this.destroy();
					}, {
						offset: $element.data('animation-offset')
					})
				}
			})
		};
		$('.mile-count .count').each(function () {
			if ($(this).data('count-animation') == '1') {
				$(this).agni_milestone_count();
			}
		});

		// Caorusel 
		$.fn.agni_carousel = function () {
			var $this = $(this);
			$this.imagesLoaded(function () {
				$this.slick({
					slidesToScroll: 1,
					slidesToShow: $this.data('carousel-slide-to-show'), //1,
					autoplay: $this.data('carousel-autoplay'),
					autoplaySpeed: $this.data('carousel-autoplay-speed'),
					nextArrow: $this.data('carousel-arrow-next'),
					prevArrow: $this.data('carousel-arrow-prev'),
					appendArrows: $this.siblings('.slick-nav'),
					appendDots: $this.siblings('.slick-nav'),
					arrows: $this.data('carousel-arrows'),
					centerMode: $this.data('carousel-center-mode'),
					dots: $this.data('carousel-dots'),
					draggable: $this.data('carousel-draggable'),
					infinite: $this.data('carousel-infinite'),
					pauseOnFocus: $this.data('carousel-pause-on-focus'),
					speed: $this.data('carousel-speed'),
					swipe: $this.data('carousel-swipe'),
					swipeToSlide: $this.data('carousel-swipe-to-scroll'),
					rtl: $this.data('rtl'),
					//mobileFirst: true,
					responsive: [{
						breakpoint: 1200, //large
						settings: {
							slidesToShow: $this.data('carousel-slide-to-show-1200'),
						}
					}, {
						breakpoint: 992, //desktop
						settings: {
							slidesToShow: $this.data('carousel-slide-to-show-992'),
						}
					}, {
						breakpoint: 768, //mobile
						settings: {
							slidesToShow: $this.data('carousel-slide-to-show-768'),
						}
					}],
				});
			});
		}

		// Carousel Posts function	
		$.fn.carousel_posttype = function () {
			$(this).slick({
				autoplay: $(this).data('posttype-autoplay'),
				autoplaySpeed: $(this).data('posttype-autoplay-timeout'),
				pauseOnHover: $(this).data('posttype-autoplay-hover'),
				speed: $(this).data('posttype-autoplay-speed'),
				nextArrow: '<i class="ion-ios-arrow-thin-left"></i>',
				prevArrow: '<i class="ion-ios-arrow-thin-right"></i>',
				dots: $(this).data('posttype-pagination'),
				infinite: $(this).data('posttype-loop'),
				slidesToShow: $(this).data('post-1200'),
				slidesToScroll: 1,
				swipeToSlide: true,
				rtl: $(this).data('rtl'),
				mobileFirst: true,
				responsive: [{
					breakpoint: 991,
					settings: {
						slidesToShow: $(this).data('post-992'),
					}

				}, {

					breakpoint: 767,
					settings: {
						slidesToShow: $(this).data('post-768'),
					}

				}, {

					breakpoint: 0,
					settings: {
						slidesToShow: $(this).data('post-0'),
					}

				}]

			});
		};

		// carousel testimonials function
		$.fn.carousel_agni_hotspot = function () {
			$(this).slick({
				autoplay: false,
				arrows: true,
				dots: false,
				infinite: false,
				prevArrow: '<div class="slick-arrow-prev"><span class="agni-slick-arrows"><i class="icon-arrows-left"></span></div>',
				nextArrow: '<div class="slick-arrow-next"><span class="agni-slick-arrows"><i class="icon-arrows-right"></span></div>',
				slidesToShow: 1,
				slidesToScroll: 1,
				swipeToSlide: true,
				rtl: $(this).data('rtl'),

			})
		};

		// sharing popup function
		$.fn.post_sharing_buttons = function () {
			$(this).find('a:not(.email)').on('click', function (s) {
				s.preventDefault();
				window.open($(this).attr('href'), 'popUpWindow', 'height=700, width=800, left=10, top=10, resizable=yes, scrollbars=yes, toolbar=yes, menubar=no, location=no, directories=no, status=yes');
			})
		};

		// Photoswipe popup gallery
		$.fn.custom_gallery_photoswipe_popup = function () { // the containers for all your galleries	
			$(this).photoswipeimage({
				bgOpacity: 1,
				loop: true,
				shareEl: false,
				thumb: true, //added by agnihd
			});
		}


		// Photoswipe popup video
		$.fn.custom_html_photoswipe_popup = function () {
			$(this).photoswipehtml({
				history: false,
				focus: false,
				showAnimationDuration: 0,
				hideAnimationDuration: 0,
				closeOnScroll: false,
				bgOpacity: 0.8,
				fullscreenEl: false,
				shareEl: false,
			});
		}

		// Agni Gallery	
		$.fn.agni_gallery = function () {
			var $gallery_container = $(this);
			var $gallery_row = '.agni-gallery-row:not(.agni-carousel)';
			$gallery_container.imagesLoaded(function () {
				if ($gallery_container.find($gallery_row).data('grid-layout') == 'fitRows') {
					$gallery_container.find($gallery_row).isotope({
						itemSelector: '.agni-gallery-column',
						layoutMode: 'fitRows',
						fitRows: {
							columnWidth: '.grid-sizer',
						}
					});
				}
				else if ($gallery_container.find($gallery_row).data('grid-layout') == 'masonry') {
					$gallery_container.find($gallery_row).isotope({
						itemSelector: '.agni-gallery-column',
						layoutMode: 'masonry',
						masonry: {
							columnWidth: '.grid-sizer',
						}
					});
				}
			});
		}

		// Agni Portfolio function for isotope & filter
		$.fn.agni_portfolio = function () {
			var $portfolio_container = $(this);
			var $portfolio_row = '.portfolio-row:not(.carousel-portfolio)';
			$portfolio_container.imagesLoaded({ background: '.portfollio-thumbnail-bg' }, function () {
				if ($portfolio_container.find($portfolio_row).data('grid') == 'masonry') {
					$portfolio_container.find($portfolio_row).isotope({
						itemSelector: '.portfolio-column',
						layoutMode: 'masonry',
						masonry: {
							columnWidth: '.grid-sizer'
						}
					});
				}
				/*else if( $portfolio_container.find($portfolio_row).data('grid') == 'fitRows' ){
					$portfolio_container.find($portfolio_row).isotope({
						itemSelector: '.portfolio-column',
						layoutMode: 'fitRows',
						fitRows: {
							columnWidth: '.grid-sizer',
						}
					});
				}*/

			});
			// filter
			$('.filter a').on('click', function (e) {
				$portfolio_container.find('.portfolio-column').removeClass('animate animated fadeInUp');
				e.preventDefault();
				$(this).addClass('active');
				$(this).parent().siblings().find('a').removeClass('active');

				var selector = $(this).attr('data-filter');
				$portfolio_container.find($portfolio_row).isotope({ filter: selector })
				$('.portfolio-column').each(function () {
					if (!$(this).hasClass(selector.replace(".", ""))) {
						$(this).addClass('filterhide');
					}
					else {
						$(this).removeClass('filterhide');
					}

				});
			});
		}

		// Agni Gallery call
		$('.agni-gallery').each(function () {
			$(this).agni_gallery();
		})

		// Agni Portfolio call
		$('.portfolio-container').each(function () {
			$(this).agni_portfolio();
		})

		//Circle bar
		$('.chart').each(function () {
			var $element = $(this);

			$element.waypoint(function () {
				$element.easyPieChart({
					barColor: $element.data('barcolor'),
					trackColor: $element.data('trackcolor'),
					scaleColor: $element.data('scalecolor'),
					easing: $element.data('animation'),
					scaleLength: $element.data('scalelength'),
					lineCap: $element.data('linecap'),
					lineWidth: $element.data('linewidth'),
					size: $element.data('size'),
					onStep: function (from, to, percent) {
						$(this.el).find('.percent').text(Math.round(percent));
					}
				});
				this.destroy();
			}, {
				offset: $element.data('animation-offset')
			});
		});


		$('.progress-bar-animate').each(function () {
			var $element = $(this);

			$element.waypoint(function () {
				if ($element.attr('role') == 'progressbar') {
					$element.css({ 'width': $element.attr('aria-valuenow') + '%' });
				}
				this.destroy();
			}, {
				offset: $element.data('animation-offset')
			});
		});

		// Carousel 
		$('.agni-carousel').each(function () {
			$(this).agni_carousel();
		});

		// Carousel Posts, Portfolio & Products
		$('.carousel-post, .carousel-portfolio').each(function () {
			$(this).carousel_posttype();
		});


		if ($('.custom-gallery').length != 0 || $('.custom-image').length != 0 || $('.custom-video-link button').length != 0) {
			var $pswp_wrapper = '<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true"><div class="pswp__bg"></div><div class="pswp__scroll-wrap"><div class="pswp__container"><div class="pswp__item"></div><div class="pswp__item"></div><div class="pswp__item"></div></div><div class="pswp__ui pswp__ui--hidden"><div class="pswp__top-bar pswp--svg"><div class="pswp__counter"></div><button class="pswp__button pswp__button--close" title="Close (Esc)"></button><button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button><button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button><div class="pswp__preloader"><div class="pswp__preloader__icn"><div class="pswp__preloader__cut"><div class="pswp__preloader__donut"></div></div></div></div></div><button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"> </button><button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"> </button><div class="pswp__caption"><div class="pswp__caption__center"></div></div></div></div></div>';
			$('body').append($pswp_wrapper);
		}
		// PhotoSwipe Popup Gallery
		$('.custom-gallery, .custom-image').each(function () {
			$(this).custom_gallery_photoswipe_popup();
		});

		// PhotoSwipe Popup html
		$('.custom-video-link button').each(function () {
			$(this).custom_html_photoswipe_popup();
		});

		// sharing popup
		$('.sharing-buttons').each(function () {
			$(this).post_sharing_buttons();
		});

		// portfolio sticky conent
		if ($('.portfolio-single-content').hasClass('has-fixed-single-content') && window.innerWidth > 767) {
			var $this = $('.portfolio-single-content');
			$this.imagesLoaded(function () {
				$this.sticky('.portfolio-single-row');
			});
		}

		$.fn.portfolio_thumbnail_height_detection = function ($gutter) {
			$(this).each(function () {
				function gcd(a, b) {
					return (b == 0) ? a : gcd(b, a % b);
				}

				var $actual_width = $(this).data('thumbnail-width');
				var $actual_height = $(this).data('thumbnail-height');
				var $bottom_caption_height = $(this).find('.portfolio-bottom-caption').innerHeight();
				var $desired_width = $(this).width();

				var r = gcd($actual_width, $actual_height);

				if ($(this).hasClass('width2x')) {
					$desired_width = $desired_width - $gutter;
				}
				else if ($(this).hasClass('width3x')) {
					$desired_width = $desired_width - ($gutter * 2);
				}
				else {
					$desired_width = $desired_width;
				}

				var $thumbnail_height = Math.round($desired_width * ($actual_height / r) / ($actual_width / r));
				if ($(this).hasClass('height2x')) {
					$thumbnail_height = $thumbnail_height + $gutter + $bottom_caption_height;
				}
				else if ($(this).hasClass('height3x')) {
					$thumbnail_height = $thumbnail_height + ($gutter * 2) + ($bottom_caption_height * 2);
				}

				$(this).find('.portfolio-thumbnail').css({ 'height': $thumbnail_height });
			})

		}

		$.fn.custom_thumbnail_height_detection = function ($args) {
			$(this).each(function () {
				var $par_el = $args[0];
				var $cap_el = $args[1];
				var $gutter = $(this).parents($par_el).parent().data('gutter');
				function gcd(a, b) {
					return (b == 0) ? a : gcd(b, a % b);
				}

				var $actual_width = $(this).data('thumbnail-width');
				var $actual_height = $(this).data('thumbnail-height');
				var $bottom_caption_height = 0;
				if ($(this).parents($par_el).parent().hasClass('shop-cat-hover-style-1')) {
					var $bottom_caption_height = $(this).siblings($cap_el).innerHeight();
				}

				var $desired_width = $(this).width();

				var r = gcd($actual_width, $actual_height);

				if ($(this).hasClass('width2x')) {
					$desired_width = $desired_width - $gutter;
				}
				else if ($(this).hasClass('width3x')) {
					$desired_width = $desired_width - ($gutter * 2);
				}
				else {
					$desired_width = $desired_width;
				}

				var $thumbnail_height = Math.round($desired_width * ($actual_height / r) / ($actual_width / r));

				if ($(this).parents($par_el).hasClass('height2x') && !$(this).parents($par_el).hasClass('width2x')) {
					$thumbnail_height = $thumbnail_height + $gutter + $bottom_caption_height;
				}
				else if ($(this).parents($par_el).hasClass('height3x') && !$(this).parents($par_el).hasClass('width3x')) {
					$thumbnail_height = $thumbnail_height + ($gutter * 2) + ($bottom_caption_height * 2);
				}

				$(this).css({ 'height': $thumbnail_height });
			})

		}

		var $args = ['.shop-column', '.product-category-title'];
		$('.agni-custom-product-categories:not(.ignore-thumbnail-settings) .agni-custom-cropped-thumbnail').custom_thumbnail_height_detection($args);

		// Portfolio thumbnail height & Gutter corrections
		$('.portfolio-container .portfolio-row:not(.ignore-thumbnail-settings)').each(function () {
			if ($(this).data('gutter') > 0 && !$(this).hasClass('portfolio-no-gutter')) {
				var $gutter = $(this).data('gutter');
				$(this).find('.portfolio-column').each(function () {
					if (window.innerWidth > 767 && $(this).data('hardcrop') == true) {
						$(this).portfolio_thumbnail_height_detection($gutter);
						$(window).on('resize', function () {
							$('.portfolio-column').portfolio_thumbnail_height_detection($gutter)
						})
					}

				})
			}

		});

		// Column BG 
		$.fn.agni_column_edge_calculation = function () {
			$(this).each(function () {
				var $this = $(this);
				var $elm_width = $this.width();
				var $left_offset = $this.offset().left;
				var $right_offset = (window.innerWidth - ($this.offset().left + $this.outerWidth()));
				if (window.innerWidth > 767) {
					if ($this.data('bg-edge') == 'left') {
						$this.find('.section-column-bg, .section-column-bg-overlay').css({
							"width": $elm_width + $left_offset,
							'transform': 'translateX(-' + $left_offset + 'px)',
						});
					}
					else if ($this.data('bg-edge') == 'right') {
						$this.find('.section-column-bg, .section-column-bg-overlay').css({
							"width": $elm_width + $right_offset,
						});
					}
				}
			})
		}

		// Column BG 
		$('.section-column-bg-container.has-bg-edge').agni_column_edge_calculation();
		$(window).on('resize', function () {
			$('.section-column-bg-container.has-bg-edge').agni_column_edge_calculation();
		})

		// Empty Space
		$('.agni_empty_space').custom_height_calc();
		$(window).on('resize', function () {
			$('.agni_empty_space').custom_height_calc();
		})

		// Responsive CSS
		$.fn.custom_css_responsive = function () {
			$(this).each(function () {
				var $this = $(this);
				var $old_css = '', $new_css = '', $existing_css = '';
				$old_css = ($this.attr('style')) ? $this.attr('style') : '';
				if ($this.data('css-existing')) {
					$old_css = $(this).data('css-existing');
				}
				if ($this.data('css-mobile') && window.innerWidth <= 767) {
					$new_css = $this.data('css-mobile');
				}
				else if ($this.data('css-tab') && window.innerWidth <= 991) {
					$new_css = $this.data('css-tab');
				}
				else if ($this.data('css-default')) {
					$new_css = $this.data('css-default');
				}
				$old_css = $old_css.replace($new_css, '');
				if ($old_css != '' || $new_css != '') {
					$new_css = $old_css + $new_css;
				}
				$this.attr('style', $new_css);
			});
		}
		$('.agni_custom_design_css').custom_css_responsive();
		$(window).on('resize', function () {
			$('.agni_custom_design_css').custom_css_responsive();
		})

		// Icon 
		$('.icon-has-border.hover-icon-has-background').hover(function () {
			$(this).parents('.agni-icon').removeClass('icon-background-transparent');
		}, function () {
			$(this).parents('.agni-icon').addClass('icon-background-transparent');
		})

		$('.agni-icon.has-svg').each(function () {
			var $icon_id = $(this).find('.agni-svg-icon').attr('id');
			var $icon_type = $(this).find('.agni-svg-icon').data('type');
			var $icon_file = $(this).find('.agni-svg-icon').data('file');
			new Vivus($icon_id, { type: 'delayed', file: $icon_file, delayStart: 300, duration: 150, pathTimingFunction: Vivus.EASE_OUT });
		})
		$('.header-toggle-icon-svg').each(function () {
			var $icon_id = $(this).attr('id');
			//var $icon_type = $(this).find('.agni-svg-icon').data('type');
			var $icon_file = $(this).data('file');
			new Vivus($icon_id, { type: 'delayed', file: $icon_file, delayStart: 300, duration: 150, pathTimingFunction: Vivus.EASE_OUT });
		});

		// Swap image
		$.fn.agni_swapimage = function () {
			$(this).find('.agni-image-figure').each(function () {
				var $img_el = $(this);
				if ($img_el.hasClass('active')) {
					$img_el.removeClass('active');
				}
				else {
					$img_el.addClass('active');
				}
			})
		}

		$('.agni-image-swapimage').click(function () {
			$(this).agni_swapimage();
		})

		// Hotspot Pin
		if ($('.agni-hotspot-scalize').length != 0) {
			$('.agni-hotspot-scalize').scalize({
				selector: '.scalize-item-point',
				styleSelector: 'scalize-item-point-content',
				animationPopoverIn: 'fadeIn',
				animationPopoverOut: 'fadeOut',
			})
		}

		$('.agni-hotspot-slider').each(function () {
			$(this).carousel_agni_hotspot();
		})
		$('.agni-hotspot-simple .agni-hotspot-pin').each(function () {
			var $this = $(this);
			var $el = $this.parent('.hotspot-content');
			var $this_overlay = $this.children('.agni-hotspot-pin-overlay');
			$this.on('click', function () {
				console.log("triggered");
				if ($el.hasClass('active')) {
					$el.removeClass('active');
				}
				else {
					$el.addClass('active');
				}

			})
		})

		// Sticky for shop sidebar
		$.fn.agni_shop_sticky_sidebar = function () {
			if (window.innerWidth > 991) {
				$(this).stickySidebar({
					topSpacing: 100,
					bottomSpacing: 65,
					containerSelector: '.shop-page-container',
					//innerWrapperSelector: '.single-product-description-inner'
				});
			}
		}
		$('.shop-page-container.has-sidebar-sticky .shop-sidebar').agni_shop_sticky_sidebar();


		// To do: Sticky for shop single
		$.fn.agni_shop_sticky_single = function () {
			$(this).stickySidebar({
				topSpacing: 100,
				bottomSpacing: 65,
				containerSelector: '.single-product-container',
				//innerWrapperSelector: '.single-product-description-inner'
			});
		}
		$('.product-style-3.has-single-sticky .single-product-description').agni_shop_sticky_single();


		// coming soon countdown
		$('.countdown').each(function () {
			// Coming Soon
			var $date = $(this).data('counter');
			var $label = $(this).data('label');
			$(this).countdown({
				date: $date, // add the countdown's end date (i.e. 3 november 2012 12:00:00)
				format: "on", // on (03:07:52) | off (3:7:52) - two_digits set to ON maintains layout consistency
				label: $label // add the countdown's label (i.e Day|Days|Hour|Hours|Minute|Minutes|Second|Seconds)
			});
		});

		// Waypoint Animation
		$('.animate').each(function () {
			var $element = $(this);

			$element.waypoint(function () {
				$element.addClass($element.data('animation') + ' animated').css('visibility', 'visible').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
					$(this).removeClass($element.data('animation') + ' animated');
				});
				this.destroy();
			}, {
				offset: $element.data('animation-offset')
			});
		});

		$.fn.initializeMap_v2 = function ($args) {
			switch ($args[3]) {
				case 2:
					var styles = [{ "stylers": [{ "hue": "#ff1a00" }, { "invert_lightness": true }, { "saturation": -100 }, { "lightness": 33 }, { "gamma": 0.5 }] }, { "featureType": "water", "elementType": "geometry", "stylers": [{ "color": "#2D333C" }] }];
					break;
				case 3:
					var styles = [{ "featureType": "administrative", "elementType": "labels.text.fill", "stylers": [{ "color": "#444444" }] }, { "featureType": "landscape", "elementType": "all", "stylers": [{ "color": "#f2f2f2" }] }, { "featureType": "poi", "elementType": "all", "stylers": [{ "visibility": "off" }] }, { "featureType": "road", "elementType": "all", "stylers": [{ "saturation": -100 }, { "lightness": 45 }] }, { "featureType": "road.highway", "elementType": "all", "stylers": [{ "visibility": "simplified" }] }, { "featureType": "road.arterial", "elementType": "labels.icon", "stylers": [{ "visibility": "off" }] }, { "featureType": "transit", "elementType": "all", "stylers": [{ "visibility": "off" }] }, { "featureType": "water", "elementType": "all", "stylers": [{ "color": $args[4] }, { "visibility": "on" }] }];
					break;
				case 4:
					var styles = [{ "featureType": "all", "elementType": "labels.text.fill", "stylers": [{ "saturation": 36 }, { "color": "#000000" }, { "lightness": 40 }] }, { "featureType": "all", "elementType": "labels.text.stroke", "stylers": [{ "visibility": "on" }, { "color": "#000000" }, { "lightness": 16 }] }, { "featureType": "all", "elementType": "labels.icon", "stylers": [{ "visibility": "off" }] }, { "featureType": "administrative", "elementType": "geometry.fill", "stylers": [{ "color": "#000000" }, { "lightness": 20 }] }, { "featureType": "administrative", "elementType": "geometry.stroke", "stylers": [{ "color": "#000000" }, { "lightness": 17 }, { "weight": 1.2 }] }, { "featureType": "landscape", "elementType": "geometry", "stylers": [{ "color": "#000000" }, { "lightness": 20 }] }, { "featureType": "poi", "elementType": "geometry", "stylers": [{ "color": "#000000" }, { "lightness": 21 }] }, { "featureType": "road.highway", "elementType": "geometry.fill", "stylers": [{ "color": "#000000" }, { "lightness": 17 }] }, { "featureType": "road.highway", "elementType": "geometry.stroke", "stylers": [{ "color": "#000000" }, { "lightness": 29 }, { "weight": 0.2 }] }, { "featureType": "road.arterial", "elementType": "geometry", "stylers": [{ "color": "#000000" }, { "lightness": 18 }] }, { "featureType": "road.local", "elementType": "geometry", "stylers": [{ "color": "#000000" }, { "lightness": 16 }] }, { "featureType": "transit", "elementType": "geometry", "stylers": [{ "color": "#000000" }, { "lightness": 19 }] }, { "featureType": "water", "elementType": "geometry", "stylers": [{ "color": "#000000" }, { "lightness": 17 }] }];
					break;
				default:
					var styles = [{ "featureType": "landscape", "elementType": "labels", "stylers": [{ "visibility": "off" }] }, { "featureType": "transit", "elementType": "labels", "stylers": [{ "visibility": "off" }] }, { "featureType": "poi", "elementType": "labels", "stylers": [{ "visibility": "off" }] }, { "featureType": "water", "elementType": "labels", "stylers": [{ "visibility": "off" }] }, { "featureType": "road", "elementType": "labels.icon", "stylers": [{ "visibility": "off" }] }, { "stylers": [{ "hue": "#00aaff" }, { "saturation": -100 }, { "gamma": 2.15 }, { "lightness": 12 }] }, { "featureType": "road", "elementType": "labels.text.fill", "stylers": [{ "visibility": "on" }, { "lightness": 24 }] }, { "featureType": "road", "elementType": "geometry", "stylers": [{ "lightness": 57 }] }];
			}

			//var locations = jQuery.parseJSON( $args[1] );
			var locations = $args[1];

			var map = new google.maps.Map(document.getElementById($args[0]), {
				zoom: $args[6],
				center: new google.maps.LatLng(locations[0].lat, locations[0].lng),
				mapTypeControl: false,
				scrollwheel: false,
				draggable: $args[5],
				mapTypeControlOptions: {
					mapTypeIds: ['Styled']
				},
				navigationControl: true,
				navigationControlOptions: { style: google.maps.NavigationControlStyle.SMALL },
				mapTypeId: 'Styled',
			});
			var styledMapType = new google.maps.StyledMapType(styles, { name: 'Styled' });
			map.mapTypes.set('Styled', styledMapType);

			var infowindow = new google.maps.InfoWindow();

			var markerIcon = new google.maps.MarkerImage($args[2],
				new google.maps.Size(40, 62),
				new google.maps.Point(0, 0)
			);
			var marker, i;

			for (i = 0; i < locations.length; i++) {
				marker = new google.maps.Marker({
					position: new google.maps.LatLng(locations[i].lat, locations[i].lng),
					map: map,
					icon: markerIcon,
					title: locations[i].name,
					zIndex: 3
				});

				google.maps.event.addListener(marker, 'click', (function (marker, i) {
					return function () {
						infowindow.setContent("<h6>" + locations[i].name + "</h6>" + locations[i].address);
						infowindow.open(map, marker);
					}
				})(marker, i));
			}
		}

		// google map
		$('.map-canvas').custom_height_calc();
		$(window).on('resize', function () {
			$('.map-canvas').custom_height_calc();
		})
		$('.map-canvas').each(function () {
			var $element = $(this);
			var mapstyle = $element.data('map-style');
			var mapcolor = $element.data('map-accent-color');
			var mapdrag = ((/Android|iPhone|iPad|iPod|BlackBerry/i).test(navigator.userAgent || navigator.vendor || window.opera) && $element.data('map-drag') == '1') ? false : true;
			var mapzoom = $element.data('map-zoom');
			var template_url = $element.data('dir');
			var showImage = $element.data('map');
			var divId = $element.attr('id');
			var get_loc = $element.data('map-locations');

			var $args = [divId, get_loc, showImage, mapstyle, mapcolor, mapdrag, mapzoom];
			$element.initializeMap_v2($args);
		})

	});

})(jQuery);
