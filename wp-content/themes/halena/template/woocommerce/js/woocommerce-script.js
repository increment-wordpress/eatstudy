// JavaScript Document

(function ($) {
	"use strict";

	$(document).ready(function () {

		// Qty Increment/Decrement
		$(document).on('click', '.product-qty-plus, .product-qty-minus', function () {

			// Get values
			var $qty = $(this).closest('.quantity').find('.qty'),
				currentVal = parseFloat($qty.val()),
				max = parseFloat($qty.attr('max')),
				min = parseFloat($qty.attr('min')),
				step = $qty.attr('step');

			// Format values
			if (!currentVal || currentVal === '' || currentVal === 'NaN') currentVal = 0;
			if (max === '' || max === 'NaN') max = '';
			if (min === '' || min === 'NaN') min = 0;
			if (step === 'any' || step === '' || step === undefined || parseFloat(step) === 'NaN') step = 1;

			// Change the value
			if ($(this).is('.product-qty-plus')) {

				if (max && (max == currentVal || currentVal > max)) {
					$qty.val(max);
				} else {
					$qty.val(currentVal + parseFloat(step));
				}

			} else {

				if (min && (min == currentVal || currentVal < min)) {
					$qty.val(min);
				} else if (currentVal > 0) {
					$qty.val(currentVal - parseFloat(step));
				}

			}

			// Trigger change event
			$qty.trigger('change');

		});

		// Woocommerce sidebar toggle
		//.has-sidebar-toggle
		$.fn.agni_woocommerce_sidebar_toggle = function () {
			var $this = $(this);
			$this.on('click', function (e) {
				e.preventDefault();
				if (!$('.shop-sidebar-wrap').hasClass('shop-sidebar-visible')) {
					$('.shop-sidebar-wrap').addClass('shop-sidebar-visible');
				}
				else {
					$('.shop-sidebar-wrap').removeClass('shop-sidebar-visible');
				}
				$('.shop-sidebar-wrap .shop-sidebar-overlay').on('click', function () {
					$('.shop-sidebar-wrap').removeClass('shop-sidebar-visible');
				});
			})
		}

		$('.has-sidebar-toggle .agni-woocommerce-sidebar-toggle').agni_woocommerce_sidebar_toggle();

		// Woocommerce ordering
		$.fn.agni_woocommerce_ordering = function () {
			var $woocommerce_ordering = $(this);
			$woocommerce_ordering.select2({
				minimumResultsForSearch: Infinity,
				width: 'auto',
				dropdownAutoWidth: true
			});
		}

		// Woocommerce dropdown
		$('.dropdown_product_cat').each(function () {
			$(this).select2({
				minimumResultsForSearch: Infinity
			});
		});

		$('.variations select').each(function () {
			$(this).select2({
				minimumResultsForSearch: Infinity
			});
		});

		// $('#billing_country, #billing_state, #shipping_country, #shipping_state').each(function () {
		// 	$(this).select2({
		// 		minimumResultsForSearch: Infinity
		// 	});
		// });


		// Instantiate EasyZoom instances
		if ($('.easyzoom').length) {
			if ($('.easyzoom').hasClass('easyzoom-mobile') || window.innerWidth > 767) {
				var $easyzoom = $('.easyzoom').easyZoom({
					preventClicks: false,
					loadingNotice: '',
					errorNotice: '',
				});

				var $easyzoom_api = $easyzoom.data('easyZoom');

				$('.variations select').on('change', function () {
					$easyzoom_api.teardown();
					$easyzoom_api._init();
				});
			}
		}


		$('.easyzoom').each(function () {
			$(this).on('click', function (e) {
				e.preventDefault();
				$('.custom-gallery a').trigger('click');
			})
		});

		// Shop single product slider
		$('.agni-single-products-gallery-slider .agni-single-products-gallery-slider-for').each(function () {
			var $this = $(this);
			$this.slick({
				slidesToShow: $this.data('slick-slides-to-show'), //1,
				slidesToScroll: $this.data('slick-slides-to-scroll'), //1,
				arrows: $this.data('slick-arrows'), //false,
				prevArrow: JSON.parse($this.data('slick-prev-arrow')), //'<div class="slick-arrow-prev"><span class="agni-slick-arrows"><i class="icon-arrows-up"></span></div>',
				nextArrow: JSON.parse($this.data('slick-next-arrow')), //'<div class="slick-arrow-next"><span class="agni-slick-arrows"><i class="icon-arrows-down"></span></div>',
				dots: $this.data('slick-dots'),
				infinite: $this.data('slick-infinite'), //false,
				fade: $this.data('slick-fade'),
				speed: $this.data('slick-speed'),
				adaptiveHeight: $this.data('slick-adaptive-height'),
				asNavFor: $this.data('slick-nav-for'), //'.agni-single-products-gallery-slider-nav'
				rtl: $(this).data('rtl'),
			})
		});
		$('.agni-single-products-gallery-slider .agni-single-products-gallery-slider-nav').each(function () {
			var $this = $(this);
			$('.agni-single-products-gallery-slider-nav-container').imagesLoaded(function () {
				$this.slick({
					slidesToShow: $this.data('slick-slides-to-show'), //4,
					slidesToScroll: $this.data('slick-slides-to-scroll'), //1,
					asNavFor: $this.data('slick-slider-for'), //'.agni-single-products-gallery-slider-for',
					arrows: $this.data('slick-arrows'), //true,
					prevArrow: JSON.parse($this.data('slick-prev-arrow')), //'<div class="slick-arrow-prev"><span class="agni-slick-arrows"><i class="icon-arrows-up"></span></div>',
					nextArrow: JSON.parse($this.data('slick-next-arrow')), //'<div class="slick-arrow-next"><span class="agni-slick-arrows"><i class="icon-arrows-down"></span></div>',
					infinite: $this.data('slick-infinite'), //false,
					dots: $this.data('slick-dots'), //false,
					centerMode: $this.data('slick-center-mode'), //true,
					centerPadding: $this.data('slick-center-padding'), //0,
					vertical: $this.data('slick-vertical'), //true,
					verticalSwiping: $this.data('slick-vertical-swiping'), //true,
					focusOnSelect: $this.data('slick-focus-on-select'), //true
					rtl: $(this).data('rtl'),
				})
			});
		});


		$.fn.agni_woocommerce_product_style_4_description = function () {
			if (window.innerWidth > 767) {
				var $el_style = $(this);
				var $el_desc = $el_style.find('.single-product-description');
				$el_desc.append('<span class="single-product-description-slide-toggle"></span>');

				var $el_toggle = $(this).find('.single-product-description-slide-toggle');

				$el_style.find('.slick-arrow').on('click', function () {
					$el_desc.addClass('inactive');
					if ($el_style.find('.slick-arrow').hasClass('slick-disabled')) {
						$el_desc.removeClass('inactive');
					}
				});
				$el_style.find('.slick-dots li').on('click', function () {
					var $this = $(this);
					$el_desc.addClass('inactive');
					if ($this.is(':first-child, :last-child')) {
						$el_desc.removeClass('inactive');
					}
				});
				$el_toggle.on('click', function () {
					//var $this = $(this).parent('.single-product-description');
					if (!$el_desc.hasClass('inactive')) {
						$el_desc.addClass('inactive');
					}
					else {
						$el_desc.removeClass('inactive');
					}
				});
			}
		}


		$('.product-style-4').agni_woocommerce_product_style_4_description();
		$(window).on('resize', function () {
			$('.product-style-4').agni_woocommerce_product_style_4_description();
		});

		// portfolio sticky conent
		/*if( $('.portfolio-single-content').hasClass('has-fixed-single-content') && $(window).width() > 767 ){
			var $this = $('.portfolio-single-content .portfolio-single-content-inner');
			$this.imagesLoaded( function() {
				$this.sticky({ topSpacing: 100, responsiveWidth: true });
			});
		}*/

		/*$('.single-product-description').stick_in_parent()
		  .on("sticky_kit:stick", function(e) {
			console.log("has stuck!", e.target);
		  })
		  .on("sticky_kit:unstick", function(e) {
			console.log("has unstuck!", e.target);
		  });*/

		$('.threesixty-container').each(function () {
			var $360_data = JSON.parse($(this).attr('data-360-array'));
			var three60 = $(this).ThreeSixty({
				totalFrames: $(this).data('360-array-count'),
				endFrame: $(this).data('360-array-count'),
				currentFrame: 1,
				imgArray: $360_data,
				imgList: '.threesixty_images',
				progress: '.spinner',
				//imagePath:'../assets/',
				//filePrefix: '',
				ext: $(this).data('360-array-ext'),
				height: $(this).data('360-array-image-height'),
				width: $(this).data('360-array-image-width'),
				navigation: true,
				disableSpin: false,
			});
		});
		$('.products-single-360-container').each(function () {
			var $this = $(this),
				$el_ids = $('.products-single-360-inner, .products-single-360-btn-close');

			$this.find($el_ids).hide();
			$this.children('.products-single-360-btn-open').on('click', function (e) {
				e.preventDefault();
				$this.find($el_ids).show();
			})
			$this.children('.products-single-360-btn-close').on('click', function (e) {
				e.preventDefault();
				$this.find($el_ids).hide();
			})
			$this.find('.products-single-360-inner-overlay').on('click', function () {
				$this.children('.products-single-360-btn-close').trigger('click');
			})

		})

		// Woocommerce Isotope
		$.fn.agni_products = function () {
			var $shop_container = $(this);
			$shop_container.imagesLoaded(function () {
				if ($shop_container.data('shop-grid') == 'fitRows') {
					$shop_container.isotope({
						itemSelector: '.shop-column',
						layoutMode: 'fitRows',
						fitRows: {
							columnWidth: '.shop-column',
						}
					});
				}
				else if ($shop_container.data('shop-grid') == 'masonry') {
					$shop_container.isotope({
						itemSelector: '.shop-column',
						layoutMode: 'masonry',
						masonry: {
							columnWidth: '.grid-sizer',
						}
					});
					$(window).on('resize', function () {
						$shop_container.isotope({
							itemSelector: '.shop-column',
							layoutMode: 'masonry',
							masonry: {
								columnWidth: '.grid-sizer',
							}
						});
					});
				}
			});
		}


		$.fn.agni_products_infinite_scroll = function () {
			var $this = $(this);
			var $loadonscroll = true;
			if ($this.parents('.shop').hasClass('has-load-more')) {
				$loadonscroll = false;
			}
			var $container = $this.infiniteScroll({
				path: 'nav.woocommerce-pagination a',
				append: '.shop-column',
				status: '.load-more-status',
				hideNav: 'nav.woocommerce-pagination',
				loadOnScroll: $loadonscroll,
				history: false
			});

			$container.on('append.infiniteScroll', function (event, response, path, items) {
				$(items).find('img[srcset]').each(function (i, img) {
					img.outerHTML = img.outerHTML;
				});
				console.log("respnse", response, "items", items)
				// Agni Quick view
				$('.agni-quick-view-btn').each(function () {
					$(this).agni_quick_view();
				});
			});

			var $viewMoreButton = $this.siblings('.load-more-container').find('.load-more');
			$viewMoreButton.on('click', function () {
				// load next page
				$container.infiniteScroll('loadNextPage');


				// enable loading on scroll
				$container.infiniteScroll('option', {
					loadOnScroll: true,
				});

				// hide button
				$viewMoreButton.hide();
			});
		}

		if ($('.shop').hasClass('has-infinite-scroll')) {
			$('.products').agni_products_infinite_scroll();
		}

		$.fn.agni_imagesloaded = function () {
			var $this = $(this);
			$this.css({ 'opacity': '0' })
			$this.imagesLoaded(function () {
				$this.css({ 'opacity': '1' });
			});
		}

		$('.products .product-thumbnail img').agni_imagesloaded();

		//$('.shop-page-container.has-sidebar-sticky .shop-sidebar').agni_shop_sticky_sidebar();

		// Agni woocommerce sorting/ordering
		if ($('.woocommerce-ordering .orderby').length) {
			$('.woocommerce-ordering .orderby').agni_woocommerce_ordering();
		}

		// Agni Product isotope
		$('.agni-custom-product-categories').each(function () {
			$(this).agni_products();
		})


		$.fn.agni_adding_to_cart_popup = function () {
			var $this = $(this);
			$this.on('click', function (e) {
				//$this.append('<span class="xoo-wsc-icon-spinner2 xoo-wsc-icon-atc xoo-wsc-active"><span>Adding to Cart!</span></span>');
				var $thisbutton = $(this);
				var $adding_to_cart_text = $thisbutton.parent('.product-add-to-cart-btn').data('adding-cart-text');

				if ($thisbutton.is('.ajax_add_to_cart')) {
					if (!$thisbutton.attr('data-product_id')) {
						return true;
					}

					e.preventDefault();

					if ($('body').find('.agni-ajax-add-to-cart-loader').length !== 0) {
						$('.agni-ajax-add-to-cart-loader').addClass('agni-add-to-cart-loader-visible');
					}
					else {
						$('body').prepend('<div id="agni-ajax-add-to-cart-loader" class="agni-ajax-add-to-cart-loader agni-add-to-cart-loader-visible">' + $adding_to_cart_text + '</div>');
					}

					var data = {};

					$.each($thisbutton.data(), function (key, value) {
						data[key] = value;
					});

					// Trigger event.
					$(document.body).trigger('adding_to_cart', [$thisbutton, data]);

					// Ajax action.
					$.post(wc_add_to_cart_params.wc_ajax_url.toString().replace('%%endpoint%%', 'add_to_cart'), data, function (response) {
						if (!response) {
							return;
						}

						if (response.error && response.product_url) {
							window.location = response.product_url;
							return;
						}

						// Redirect to cart option
						if (wc_add_to_cart_params.cart_redirect_after_add === 'yes') {
							window.location = wc_add_to_cart_params.cart_url;
							return;
						}

						// Trigger event so themes can refresh other areas.
						$(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, $thisbutton]);

						$('.agni-ajax-add-to-cart-loader').removeClass("agni-add-to-cart-loader-visible");
					});
				}
			})
		}

		$('.product_type_simple.add_to_cart_button').each(function () {
			$(this).agni_adding_to_cart_popup();
		});

		// Shopping cart sidebar
		/*$.fn.shopping_cart_wiget = function(){
			var $this = $(this);
			$this.children('.header-cart-toggle-open').on('click', function(t){
				t.preventDefault();
				$this.children('.header-cart-toggle-close').css({'opacity': '1', 'visibility': 'visible'});
				$this.children('.widget_shopping_cart').addClass('cart-visible').css({'right':'0px', 'visibility':'visible'});
			});
			$this.children('.header-cart-toggle-close').on('click', function(t){
				t.preventDefault();
				$this.children('.header-cart-toggle-close').css({'opacity':'0', 'visibility': 'hidden'});
				$this.children('.widget_shopping_cart').removeClass('cart-visible').css({'right':'-300px', 'visibility':'hidden'});
			});
		}

		$('.header-cart-toggle').shopping_cart_wiget();*/

		// Ajax column query string
		/*$('.col-query-string-btn').on('click', function(e){
			e.preventDefault();
			var $this = $(this);
			//var ajaxurl = $(this).data('ajax-url');
			console.log( colQueryStr.ajaxurl );
			$.ajax({
				url: colQueryStr.ajaxurl,
				type: 'POST',
				data: {
					action: 'agni_ajax_col_query'
				},
				error: function( response ){
					console.log( "Error :"+response );
				},
				success: function( response ){
					console.log( "Success :"+response );
					$this.append( $this.attr('href') );
					$this.append(response);
					$('ul.products').addClass(response);
					history.pushState({}, '', $this.attr('href'))
				},
			});
		});*/
		// Dynamic column query string
		$.fn.agni_col_qry_string_btn = function () {
			$(this).on('click', function (e) {
				e.preventDefault();
				var $this = $(this),
					$products = $('ul.products:not(".related, .upsells, .carousel-products")');

				$('.col-query-string-btn').each(function () {
					var $col = ["1", "2", "3", "4", "5", "6"];
					for (var i = $col.length - 1; i >= 0; i--) {
						$products.removeClass('agni-products-' + $col[i] + '-column');
					}
					$(this).removeClass('active');
				})
				$products.addClass($this.data('col-class'));
				$this.addClass('active');

				$products.each(function () {
					//$(this).agni_products();
				})

				history.pushState({}, '', $this.attr('href'));

			});
		}

		$('.col-query-string-btn').agni_col_qry_string_btn();


		// Agni Quick view function
		$.fn.agni_quick_view = function () {
			var $this = $(this);
			$this.on('click', function (e) {
				e.preventDefault();
				if (!$('.agni-quick-view-wrap').length) {
					$('body').append('<div class="agni-quick-view-wrap"><div class="agni-quick-view-overlay"></div><div class="agni-quick-view-close"></div><div class="agni-quick-view-content"></div><div class="agni-quick-view-preloader">' + $this.data('quick-view-btn-text') + '</div></div>');
				}
				else {
					$('.agni-quick-view-content').empty();
				}
				$('.agni-quick-view-wrap').addClass('active');
				$('.agni-quick-view-preloader').addClass('active');

				$.ajax({
					url: agni_quick_view.ajaxurl,
					type: 'POST',
					dataType: 'html',
					data: {
						action: 'agni_quick_view',
						security: agni_quick_view.security,
						agni_quick_view_product_id: $this.data('product-id'),
					},
					error: function (response) {
						console.log("Error :" + response);
					},
					success: function (response) {

						$('.agni-quick-view-preloader').removeClass('active');

						$('.agni-quick-view-content').append(response);

						$('.variations_form').tawcvs_variation_swatches_form();
						$(document.body).trigger('tawcvs_initialized');
						//$this.append(response);

						$('.agni-quick-view-close').on('click', function () {
							$('.agni-quick-view-wrap').removeClass('active');
						});

						// Variation Form
						var form_variation = $('.agni-quick-view-content').find('.variations_form');
						form_variation.each(function () {
							$(this).wc_variation_form();
						});
						form_variation.trigger('check_variations');
						form_variation.trigger('reset_image');

						if (!form_variation.length) {
							$('.agni-quick-view-product-details .single_add_to_cart_button').on('click', function () {
								$('.agni-quick-view-close').trigger('click');
							});
						}

						$(".single_variation_wrap").on("show_variation", function (event, variation) {
							$('.agni-quick-view-product-details .single_add_to_cart_button').on('click', function () {
								$('.agni-quick-view-close').trigger('click');
							});
						});
					},
				});

			});
		}

		// Agni Quick view
		$('.agni-quick-view-btn').each(function () {
			$(this).agni_quick_view();
		});

	});


	$(window).load(function () {

		$.fn.agni_add_to_cart_sticky = function () {
			var $this = $(this),
				$elem = $this.parents('.product'),
				$elem_height = $elem.height(),
				$elem_top = $elem.offset().top,
				$elem_bottom = $elem.offset().top + $elem_height - window.innerHeight;

			$(window).on('scroll', function () {

				if ($elem_top < $(this).scrollTop() && $elem_bottom > $(this).scrollTop()) {
					$this.addClass('cart-sticky-active');
				}
				else {
					$this.removeClass('cart-sticky-active');
				}

			})

		}
		$('.single-product .single-product-add-to-cart-sticky').each(function () {
			$(this).agni_add_to_cart_sticky();
		});

	});


})(jQuery);
