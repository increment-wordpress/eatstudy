jQuery(document).ready(function ($) {

	// return false if wcapf_params variable is not found
	if (typeof wcapf_params === 'undefined') {
		return false;
	}


	// Attribute filter
	$('.color-label').each(function () {
		$(this).wpColorPicker();
	});
	// Hide and show price lists
	$('.attr-display-type').each(function () {
		$(this).change(function (event) {
			var display_type = $(this).val(),
				widget = $(this).parent().parent();

			if (display_type == 'color') {
				widget.find('.attr-type-color-wrapper').removeClass('hidden');
				//widget.find('.attr-type-color-wrapper').removeClass('hidden_by_attr');
				widget.find('.attr-type-size-wrapper').addClass('hidden');
			} else if (display_type == 'size') {
				widget.find('.attr-type-color-wrapper').addClass('hidden');
				widget.find('.attr-type-size-wrapper').removeClass('hidden');
				//widget.find('.attr-type-size-wrapper').removeClass('hidden_by_attr');
			}
			else {
				widget.find('.attr-type-size-wrapper').addClass('hidden');
				widget.find('.attr-type-color-wrapper').addClass('hidden');
			}

		});
	});

	$('.attr-choice').each(function () {
		$(this).on('change', function (event) {
			console.log($(this).val());
			var attr_size_choice = '.attr-type-size-wrapper-' + $(this).val(),
				attr_color_choice = '.attr-type-color-wrapper-' + $(this).val(),
				widget = $(this).parent().parent();

			widget.find('.attr-type-size-wrapper').addClass('hidden_by_attr');
			if (widget.find('.attr-type-size-wrapper')) {
				if (widget.find(attr_size_choice)) {
					widget.find(attr_size_choice).removeClass('hidden_by_attr');
				}
			}
			widget.find('.attr-type-color-wrapper').addClass('hidden_by_attr');
			if (widget.find('.attr-type-color-wrapper')) {
				if (widget.find(attr_color_choice)) {
					widget.find(attr_color_choice).removeClass('hidden_by_attr');
				}
			}
		});
	});

	// store widget ids those will be replaced with new data
	var widgets = {};

	$('.wcapf-ajax-term-filter').each(function (index) {
		var widget_id = $(this).attr('id');
		widgets[index] = widget_id;
	});

	// scripts to run before updating shop loop
	wcapfBeforeUpdate = function () {
		var overlay_color;

		if (wcapf_params.overlay_bg_color.length) {
			overlay_color = wcapf_params.overlay_bg_color;
		} else {
			overlay_color = 'rgba(255, 255, 255, 0.85)';
		}

		var markup = '<div class="wcapf-before-update" style="background-color: ' + overlay_color + '"></div>',
			holder,
			top_scroll_offset = 0;

		if ($(wcapf_params.shop_loop_container.length)) {
			holder = wcapf_params.shop_loop_container;
		} else if ($(wcapf_params.not_found_container).length) {
			holder = wcapf_params.not_found_container;
		}

		if (holder.length) {
			// show loading image
			$(markup).prependTo(holder);

			// scroll to top
			if (typeof wcapf_params.scroll_to_top !== 'undefined' && wcapf_params.scroll_to_top == true) {
				var scroll_to_top_offset,
					top_scroll_offset;

				if (typeof wcapf_params.scroll_to_top_offset !== 'undefined' && wcapf_params.scroll_to_top_offset.length) {
					scroll_to_top_offset = parseInt(wcapf_params.scroll_to_top_offset);
				} else {
					scroll_to_top_offset = 100;
				}

				top_scroll_offset = $(holder).offset().top - scroll_to_top_offset;

				if (top_scroll_offset < 0) {
					top_scroll_offset = 0;
				}

				$('html, body').animate({ scrollTop: top_scroll_offset }, 'slow');
			}
		}

	}

	// scripts to run after updating shop loop
	wcapfAfterUpdate = function () { }

	// load filtered products
	wcapfFilterProducts = function () {
		// run before update function: show a loading image and scroll to top
		wcapfBeforeUpdate();

		$.get(window.location.href, function (data) {
			var $data = jQuery(data),
				shop_loop = $data.find(wcapf_params.shop_loop_container),
				not_found = $data.find(wcapf_params.not_found_container);

			// replace widgets data with new data
			$.each(widgets, function (index, id) {
				var single_widget = $data.find('#' + id),
					single_widget_class = $(single_widget).attr('class');

				// update class
				$('#' + id).attr('class', single_widget_class);
				// update widget
				$('#' + id).html(single_widget.html());
			});

			// replace old shop loop with new one
			if (wcapf_params.shop_loop_container == wcapf_params.not_found_container) {
				$(wcapf_params.shop_loop_container).html(shop_loop.html());
			} else {
				if ($(wcapf_params.not_found_container).length) {
					if (shop_loop.length) {
						$(wcapf_params.not_found_container).html(shop_loop.html());
					} else if (not_found.length) {
						$(wcapf_params.not_found_container).html(not_found.html());
					}
				} else if ($(wcapf_params.shop_loop_container).length) {
					if (shop_loop.length) {
						$(wcapf_params.shop_loop_container).html(shop_loop.html());
					} else if (not_found.length) {
						$(wcapf_params.shop_loop_container).html(not_found.html());
					}
				}
			}

			// reinitialize ordering
			wcapfInitOrder();

			// reinitialize dropdown filter
			wcapfDropDownFilter();

			// Script after filter updated
			// Agni Product isotop
			$('.products:not(".related, .upsells, .carousel-products")').each(function () {
				//$(this).agni_products();
			})

			// Agni woocommerce sorting/ordering
			$('.woocommerce-ordering .orderby').agni_woocommerce_ordering();

			// Agni Add to cart popup
			$('.product_type_simple.add_to_cart_button').each(function () {
				$(this).agni_adding_to_cart_popup();
			});

			// Agni imagesloaded function
			$('.products .product-thumbnail img').agni_imagesloaded();

			// Agni Quick view
			$('.agni-quick-view-btn').each(function () {
				$(this).agni_quick_view();
			});

			// Agni sidebar toggle
			$('.has-sidebar-toggle .agni-woocommerce-sidebar-toggle').agni_woocommerce_sidebar_toggle();

			// Agni Infinite scroll 
			if ($('.shop').hasClass('has-infinite-scroll')) {
				$('.products').agni_products_infinite_scroll();
			}

			// run scripts after shop loop updated
			if (typeof wcapf_params.custom_scripts !== 'undefined' && wcapf_params.custom_scripts.length > 0) {
				eval(wcapf_params.custom_scripts);
			}
		});
	}

	// URL Parser
	wcapfGetUrlVars = function (url) {
		var vars = {}, hash;

		if (typeof url == 'undefined') {
			url = window.location.href;
		} else {
			url = url;
		}

		var hashes = url.slice(url.indexOf('?') + 1).split('&');
		for (var i = 0; i < hashes.length; i++) {
			hash = hashes[i].split('=');
			vars[hash[0]] = hash[1];
		}
		return vars;
	}

	// if current page is greater than 1 then we should set it to 1
	// everytime we add new query to url to prevent page not found error.
	wcapfFixPagination = function () {
		var url = window.location.href,
			params = wcapfGetUrlVars(url);

		if (current_page = parseInt(url.replace(/.+\/page\/([0-9]+)+/, "$1"))) {
			if (current_page > 1) {
				url = url.replace(/page\/([0-9]+)/, 'page/1');
			}
		}
		else if (typeof params['paged'] != 'undefined') {
			current_page = parseInt(params['paged']);
			if (current_page > 1) {
				url = url.replace('paged=' + current_page, 'paged=1');
			}
		}

		return url;
	}

	// update query string for categories, meta etc..
	wcapfUpdateQueryStringParameter = function (key, value, push_history, url) {
		if (typeof push_history === 'undefined') {
			push_history = true;
		}

		if (typeof url === 'undefined') {
			url = wcapfFixPagination();
		}

		var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i"),
			separator = url.indexOf('?') !== -1 ? "&" : "?",
			url_with_query;

		if (url.match(re)) {
			url_with_query = url.replace(re, '$1' + key + "=" + value + '$2');
		}
		else {
			url_with_query = url + separator + key + "=" + value;
		}

		if (push_history === true) {
			return history.pushState({}, '', url_with_query);
		} else {
			return url_with_query;
		}
	}

	// remove parameter from url
	wcapfRemoveQueryStringParameter = function (filter_key, url) {
		if (typeof url === 'undefined') {
			url = wcapfFixPagination();
		}

		var params = wcapfGetUrlVars(url),
			count_params = Object.keys(params).length,
			start_position = url.indexOf('?'),
			param_position = url.indexOf(filter_key),
			clean_url,
			clean_query;

		if (count_params > 1) {
			if ((param_position - start_position) > 1) {
				clean_url = url.replace('&' + filter_key + '=' + params[filter_key], '');
			} else {
				clean_url = url.replace(filter_key + '=' + params[filter_key] + '&', '');
			}

			var params = clean_url.split('?');
			clean_query = '?' + params[1];
		} else {
			clean_query = url.replace('?' + filter_key + '=' + params[filter_key], '');
		}

		return clean_query;
	}

	// add filter if not exists else remove filter
	wcapfSingleFilter = function (filter_key, filter_val) {
		var params = wcapfGetUrlVars(),
			query;

		if (typeof params[filter_key] !== 'undefined' && params[filter_key] == filter_val) {
			query = wcapfRemoveQueryStringParameter(filter_key);
		} else {
			query = wcapfUpdateQueryStringParameter(filter_key, filter_val, false);
		}

		// update url
		history.pushState({}, '', query);

		// filter products
		wcapfFilterProducts();
	}

	// take the key and value and make query
	wcapfMakeParameters = function (filter_key, filter_val, url) {
		var params,
			next_vals,
			empty_val = false;

		if (typeof url !== 'undefined') {
			params = wcapfGetUrlVars(url);
		} else {
			params = wcapfGetUrlVars();
		}

		if (typeof params[filter_key] != 'undefined') {
			var prev_vals = params[filter_key],
				prev_vals_array = prev_vals.split(',');

			if (prev_vals.length > 0) {
				var found = jQuery.inArray(filter_val, prev_vals_array);

				if (found >= 0) {
					// Element was found, remove it.
					prev_vals_array.splice(found, 1);

					if (prev_vals_array.length == 0) {
						empty_val = true;
					}
				} else {
					// Element was not found, add it.
					prev_vals_array.push(filter_val);
				}

				if (prev_vals_array.length > 1) {
					next_vals = prev_vals_array.join(',');
				} else {
					next_vals = prev_vals_array;
				}
			} else {
				next_vals = filter_val;
			}
		} else {
			next_vals = filter_val;
		}

		// update url and query string
		if (empty_val == false) {
			wcapfUpdateQueryStringParameter(filter_key, next_vals);
		} else {
			var query = wcapfRemoveQueryStringParameter(filter_key);
			history.pushState({}, '', query);
		}

		// filter products
		wcapfFilterProducts();
	}

	// handle the filter request
	$('.wcapf-ajax-term-filter').not('.wcapf-price-filter-widget').on('click', 'li a', function (event) {
		event.preventDefault();
		var element = $(this),
			filter_key = element.attr('data-key'),
			filter_val = element.attr('data-value'),
			enable_multiple_filter = element.attr('data-multiple-filter');

		if (enable_multiple_filter == true) {
			wcapfMakeParameters(filter_key, filter_val);
		} else {
			wcapfSingleFilter(filter_key, filter_val);
		}

	});

	// handle the filter request for price filter display type list
	$('.wcapf-price-filter-widget.wcapf-ajax-term-filter').on('click', 'li a', function (event) {
		event.preventDefault();
		var element = $(this),
			filter_key_min = element.attr('data-key-min'),
			filter_val_min = element.attr('data-value-min'),
			filter_key_max = element.attr('data-key-max'),
			filter_val_max = element.attr('data-value-max'),
			query;

		if (element.parent().hasClass('chosen')) {
			query = wcapfRemoveQueryStringParameter(filter_key_min);
			query = wcapfRemoveQueryStringParameter(filter_key_max, query);

			if (query == '') {
				query = window.location.href.split('?')[0];
			}

			history.pushState({}, '', query);
		} else {
			query = wcapfUpdateQueryStringParameter(filter_key_min, filter_val_min, false);
			query = wcapfUpdateQueryStringParameter(filter_key_max, filter_val_max, true, query);
		}

		// filter products
		wcapfFilterProducts();

	});

	// handle the pagination request
	if (wcapf_params.pagination_container.length > 0) {
		var holder = wcapf_params.pagination_container + ' a';

		$(document).on('click', holder, function (event) {
			event.preventDefault();
			var location = $(this).attr('href');
			history.pushState({}, '', location);

			// filter products
			wcapfFilterProducts();
		});
	}

	// history back and forward request handling
	$(window).bind('popstate', function (event) {
		// filter products
		wcapfFilterProducts();
	});

	// ordering
	wcapfInitOrder = function () {
		if (typeof wcapf_params.sorting_control !== 'undefined' && wcapf_params.sorting_control.length && wcapf_params.sorting_control == true) {
			$('.wcapf-before-products').find('.woocommerce-ordering').each(function (index) {
				$(this).on('submit', function (event) {
					event.preventDefault();
				});

				$(this).on('change', 'select.orderby', function (event) {
					event.preventDefault();

					var order = $(this).val(),
						filter_key = 'orderby';

					// change url
					wcapfUpdateQueryStringParameter(filter_key, order);

					// filter products
					wcapfFilterProducts();
				});
			});
		}
	}

	// init ordering
	wcapfInitOrder();

	// remove active filters
	$(document).on('click', '.wcapf-active-filters a:not(.reset)', function (event) {
		event.preventDefault();
		var element = $(this),
			filter_key = element.attr('data-key'),
			filter_val = element.attr('data-value');

		if (typeof filter_val === 'undefined') {
			var query = wcapfRemoveQueryStringParameter(filter_key);
			history.pushState({}, '', query);

			// price slider
			if ($('#wcapf-noui-slider').length && jQuery().noUiSlider) {
				var priceSlider = document.getElementById('wcapf-noui-slider'),
					min_val = parseInt($(priceSlider).attr('data-min')),
					max_val = parseInt($(priceSlider).attr('data-max'));

				if (min_val && max_val) {
					if (filter_key === 'min-price') {
						priceSlider.noUiSlider.set([min_val, null]);
					} else if (filter_key === 'max-price') {
						priceSlider.noUiSlider.set([null, max_val]);
					}
				}
			}

			// filter products
			wcapfFilterProducts();
		} else {
			wcapfMakeParameters(filter_key, filter_val);
		}
	});

	// clear all filters
	$(document).on('click', '.wcapf-active-filters a.reset', function (event) {
		event.preventDefault();
		var location = $(this).attr('data-location');
		history.pushState({}, '', location);

		// filter products
		wcapfFilterProducts();
	});

	// display type dropdown
	function formatState(state) {
		var depth = $(state.element).attr('data-depth'),
			$state = $('<span class="depth depth-' + depth + '">' + state.text + '</span>');

		return $state;
	}

	wcapfDropDownFilter = function () {
		if ($('.wcapf-select2-single').length) {
			$('.wcapf-select2-single').select2({
				templateResult: formatState,
				minimumResultsForSearch: Infinity,
				allowClear: true
			});
		}

		if ($('.wcapf-select2-multiple').length) {
			$('.wcapf-select2-multiple').select2({
				templateResult: formatState,
			});
		}

		$('.select2-dropdown').css('display', 'none');
	}

	// initialize dropdown filter
	wcapfDropDownFilter();

	$(document).on('change', '.wcapf-select2', function (event) {
		event.preventDefault();
		var filter_key = $(this).attr('name'),
			filter_val = $(this).val();

		if (!filter_val) {
			var query = wcapfRemoveQueryStringParameter(filter_key);
			history.pushState({}, '', query);
		} else {
			filter_val = filter_val.toString();
			wcapfUpdateQueryStringParameter(filter_key, filter_val);
		}

		// filter products
		wcapfFilterProducts();
	});
});