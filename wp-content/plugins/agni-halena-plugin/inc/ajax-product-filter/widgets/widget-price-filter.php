<?php
/**
 * WC Ajax Product Filter by Price
 */
if (!class_exists('WCAPF_Price_Filter_Widget')) {
	class WCAPF_Price_Filter_Widget extends WP_Widget {
		/**
		 * Register widget with WordPress.
		 */
		function __construct() {
			parent::__construct(
				'wcapf-price-filter', // Base ID
				__('WC Ajax Product Filter by Price', 'agni-halena-plugin'), // Name
				array('description' => __('Filter woocommerce products by price.', 'agni-halena-plugin')) // Args
			);
		}

		/**
		 * Front-end display of widget.
		 *
		 * @see WP_Widget::widget()
		 *
		 * @param array $args     Widget arguments.
		 * @param array $instance Saved values from database.
		 */
		public function widget($args, $instance) {
			if (!is_post_type_archive('product') && !is_tax(get_object_taxonomies('product'))) {
				return;
			}

			global $wcapf;

			// price range for filtered products
			$filtered_price_range = $wcapf->getPriceRange(true);

			// price range for all published products
			$unfiltered_price_range = $wcapf->getPriceRange(false);

			$html = '';

			// to be sure that these values are number
			$min_val = $max_val = 0;

			if (sizeof($unfiltered_price_range) === 2) {
				$min_val = $unfiltered_price_range[0];
				$max_val = $unfiltered_price_range[1];
			}
			if( $min_val == 0 && $max_val == 0 ){
				return;
			}

			// display type, slider or list
			$display_type = $instance['display_type'];

			// required scripts
			// enqueue necessary scripts
			wp_enqueue_style('wcapf-style');
			wp_enqueue_style('font-awesome');
			wp_enqueue_script('wcapf-script');

			if ($display_type === 'slider') {
				wp_enqueue_script('wcapf-nouislider-script');
				wp_enqueue_script('wcapf-price-filter-script');
				wp_enqueue_style('wcapf-nouislider-style');
				// get values from url
				$set_min_val = null;
				if (isset($_GET['min-price']) && !empty($_GET['min-price'])) {
					$set_min_val = (int)$_GET['min-price'];
				}

				$set_max_val = null;
				if (isset($_GET['max-price']) && !empty($_GET['max-price'])) {
					$set_max_val = (int)$_GET['max-price'];
				}

			} else {
				$price_lists = $instance['price_list'];
				$show_currency = $instance['show_currency'];

				if (class_exists('WOOCS')) {
					$woocs = new WOOCS();
					$woocs_currencies = $woocs->get_currencies();
					$woocs_current_currency = $woocs->current_currency;

					$currency_symbol = $woocs_currencies[$woocs_current_currency]['symbol'];
					$currency_position = $woocs_currencies[$woocs_current_currency]['position'];
				} else {
					$currency_symbol = get_woocommerce_currency_symbol();
					$currency_position = get_option('woocommerce_currency_pos');
				}
			}

			

			extract($args);

			// Add class to before_widget from within a custom widget
			// http://wordpress.stackexchange.com/questions/18942/add-class-to-before-widget-from-within-a-custom-widget

			if ($display_type === 'slider') {
				$widget_class = 'woocommerce wcapf-price-filter-widget widget_price_filter';
			} else {
				$widget_class = 'woocommerce wcapf-price-filter-widget wcapf-ajax-term-filter widget_price_filter';
			}

			// no class found, so add it
			if (strpos($before_widget, 'class') === false) {
				$before_widget = str_replace('>', 'class="' . $widget_class . '"', $before_widget);
			}
			// class found but not the one that we need, so add it
			else {
				$before_widget = str_replace('class="', 'class="' . $widget_class . ' ', $before_widget);
			}

			echo wp_kses_post( $before_widget );

			if (!empty($instance['title'])) {
				echo wp_kses_post( $args['before_title'] . apply_filters('widget_title', $instance['title']). $args['after_title'] );
			}

			// HTML markup for price slider
			// Slider markup
			if ($display_type === 'slider') { ?>
				<div class="wcapf-price-filter-wrapper">
					<div id="wcapf-noui-slider" class="noUi-extended" data-min="<?php echo esc_attr( $min_val ) ?>" data-max="<?php echo esc_attr( $max_val ) ?>" data-set-min="<?php echo esc_attr( $set_min_val ) ?>" data-set-max="<?php echo esc_attr( $set_max_val ) ?>"></div><br/>
						<div class="slider-values">
							<span class="wcapf-slider-value" id="wcapf-noui-slider-value-min"></span> - <span class="wcapf-slider-value" id="wcapf-noui-slider-value-max"></span>
						</div>
				</div>
			<?php }
			// List markup
			elseif ($display_type === 'list') { ?>
				<div class="wcapf-layered-nav">
					<ul>
						<?php foreach ($price_lists as $price_list) {

							if (isset($_GET['min-price']) && $_GET['min-price'] == $price_list['min']) {
								echo '<li class="chosen">';
							} elseif (isset($_GET['max-price']) && $_GET['max-price'] == $price_list['max']) {
								echo '<li class="chosen">';
							} else {
								echo '<li>';
							} ?>

								<a href="javascript:void(0)" data-key-min="min-price" data-value-min="<?php echo esc_attr( $price_list['min'] ) ?>" data-key-max="max-price" data-value-max="<?php echo esc_attr( $price_list['max'] ) ?>">';

									<?php if ( !$show_currency ) {
										if ($price_list['min']) { ?>
											<span class="min"><?php echo esc_html( $price_list['min'] ) ?></span>
										<?php } ?>

										<span class="to"><?php echo esc_html( $price_list['to'] ) ?></span>

										<?php if ($price_list['max']) { ?>
											<span class="max"><?php echo esc_html( $price_list['max'] ) ?></span>
										<?php }
									} else {
										if ($currency_position === 'left') { 
											if ($price_list['min']) { ?>
												<span class="min"><?php echo esc_html( $currency_symbol . $price_list['min'] ) ?></span>
											<?php } ?>

											<span class="to"><?php echo esc_html( $price_list['to'] ) ?></span>

											<?php if ($price_list['max']) { ?>
												<span class="max"><?php echo esc_html( $currency_symbol . $price_list['max'] ) ?></span>
											<?php }
										}
										else if ($currency_position === 'left_space') { 
											if ($price_list['min']) { ?>
												<span class="min"><?php echo esc_html( $currency_symbol ).' '.esc_html( $price_list['min'] ) ?></span>
											<?php } ?>

											<span class="to"><?php esc_html( $price_list['to'] ) ?></span>

											<?php if ($price_list['max']) { ?>
												<span class="max"><?php echo esc_html( $currency_symbol ).' '.esc_html( $price_list['max'] ) ?></span>
											<?php }
										}
										else if ($currency_position === 'right') { 
											if ($price_list['min']) { ?>
												<span class="min"><?php echo esc_html( $price_list['min'] . $currency_symbol ) ?></span>
											<?php } ?>

											<span class="to"><?php echo esc_html( $price_list['to'] ) ?></span>

											<?php if ($price_list['max']) { ?>
												<span class="max"><?php echo esc_html( $price_list['max'] . $currency_symbol ) ?></span>
											<?php }
										}
										else if ($currency_position === 'right_space') { 
											if ($price_list['min']) { ?>
												<span class="min"><?php echo esc_html( $price_list['min'] ).' '.esc_html( $currency_symbol ) ?></span>
											<?php } ?>

											<span class="to"><?php esc_html( $price_list['to'] ) ?></span>

											<?php if ($price_list['max']) { ?>
												<span class="max"><?php echo esc_html( $price_list['max'] ).' '.esc_html( $currency_symbol ) ?></span>
											<?php }
										}
									} ?>
								</a>
							</li>
						<?php } ?>
					</ul>
				</div>
			<?php }

			echo wp_kses_post( $args['after_widget'] );
		}

		/**
		 * Back-end widget form.
		 *
		 * @see WP_Widget::form()
		 *
		 * @param array $instance Previously saved values from database.
		 */
		public function form($instance) {
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>"><?php printf(__('Title:', 'agni-halena-plugin')); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo (!empty($instance['title']) ? esc_attr($instance['title']) : ''); ?>">
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id('display_type') ); ?>"><?php printf(__('Display Type:', 'agni-halena-plugin')); ?></label>
				<select class="widefat price-filter-display-type" id="<?php echo esc_attr( $this->get_field_id('display_type') ); ?>" name="<?php echo esc_attr( $this->get_field_name('display_type') ); ?>">
					<option value="slider" <?php echo ((!empty($instance['display_type']) && $instance['display_type'] === 'slider') ? 'selected="selected"' : ''); ?>><?php printf(__('Slider', 'agni-halena-plugin')); ?></option>
					<option value="list" <?php echo ((!empty($instance['display_type']) && $instance['display_type'] === 'list') ? 'selected="selected"' : ''); ?>><?php printf(__('List', 'agni-halena-plugin')); ?></option>
				</select>
			</p>
			<p class="price-list-currency <?php echo (!isset($instance['display_type']) || $instance['display_type'] === 'slider') ? 'hidden' : ''; ?>">
				<input id="<?php echo esc_attr( $this->get_field_id('show_currency') ); ?>" name="<?php echo esc_attr( $this->get_field_name('show_currency') ); ?>" type="checkbox" value="1" <?php echo (!empty($instance['show_currency']) && $instance['show_currency'] == true) ? 'checked="checked"' : ''; ?>>
				<label for="<?php echo esc_attr( $this->get_field_id('show_currency') ); ?>"><?php printf(__('Show currency', 'agni-halena-plugin')); ?></label>
			</p>
			<div class="price-list-wrapper <?php echo (!isset($instance['display_type']) || $instance['display_type'] === 'slider') ? 'hidden' : ''; ?>">
				<?php if (isset($instance['price_list']) && !empty($instance['price_list'])): ?>
					<?php foreach ($instance['price_list'] as $price_list): ?>
						<p class="price-list">
							<input type="text" class="widefat min" name="<?php echo esc_attr( $this->get_field_name('price_list') ); ?>[min][]" value="<?php echo esc_attr( $price_list['min'] ); ?>" placeholder="<?php printf(__('Min price', 'agni-halena-plugin')); ?>" />
							<input type="text" class="widefat to" name="<?php echo esc_attr( $this->get_field_name('price_list') ); ?>[to][]" value="<?php echo esc_attr( $price_list['to'] ); ?>" placeholder="<?php printf(__('to', 'agni-halena-plugin')); ?>" />
							<input type="text" class="widefat max" name="<?php echo esc_attr( $this->get_field_name('price_list') ); ?>[max][]" value="<?php echo esc_attr( $price_list['max'] ); ?>" placeholder="<?php printf(__('Max price', 'agni-halena-plugin')); ?>" />
							<a href="javascript:void(0)" class="remove-price-list">&times;</a>
						</p>
					<?php endforeach ?>
				<?php else: ?>
					<p class="price-list">
						<input type="text" class="widefat min" name="<?php echo esc_attr( $this->get_field_name('price_list') ); ?>[min][]" value="" placeholder="<?php printf(__('Min price', 'agni-halena-plugin')); ?>" />
						<input type="text" class="widefat to" name="<?php echo esc_attr( $this->get_field_name('price_list') ); ?>[to][]" value="" placeholder="<?php printf(__('to', 'agni-halena-plugin')); ?>" />
						<input type="text" class="widefat max" name="<?php echo esc_attr( $this->get_field_name('price_list') ); ?>[max][]" value="" placeholder="<?php printf(__('Max price', 'agni-halena-plugin')); ?>" />
						<a href="javascript:void(0)" class="remove-price-list">&times;</a>
					</p>
				<?php endif ?>
			</div>
			<p class="add-price-list-button-wrapper <?php echo (!isset($instance['display_type']) || $instance['display_type'] === 'slider') ? 'hidden' : ''; ?>">
				<a href="javascript:void(0)" class="button add-price-list"><?php printf(__('Add', 'agni-halena-plugin')); ?></a>
			</p>
			<div class="price-list-empty hidden">
				<p class="price-list">
					<input type="text" class="widefat min" name="<?php echo esc_attr( $this->get_field_name('price_list') ); ?>[min][]" value="" placeholder="<?php printf(__('Min price', 'agni-halena-plugin')); ?>" />
					<input type="text" class="widefat to" name="<?php echo esc_attr( $this->get_field_name('price_list') ); ?>[to][]" value="" placeholder="<?php printf(__('to', 'agni-halena-plugin')); ?>" />
					<input type="text" class="widefat max" name="<?php echo esc_attr( $this->get_field_name('price_list') ); ?>[max][]" value="" placeholder="<?php printf(__('Max price', 'agni-halena-plugin')); ?>" />
					<a href="javascript:void(0)" class="remove-price-list">&times;</a>
				</p>
			</div>		

			<script type="text/javascript">
				jQuery(document).ready(function($) {
					// Hide and show price lists
					$('.price-filter-display-type').change(function(event) {
						var display_type = $(this).val(),
							widget = $(this).parent().parent();

						if (display_type == 'list') {
							widget.find('.price-list-currency').removeClass('hidden');
							widget.find('.price-list-product-count').removeClass('hidden');
							widget.find('.price-list-wrapper').removeClass('hidden');
							widget.find('.add-price-list-button-wrapper').removeClass('hidden');
						} else {
							widget.find('.price-list-currency').addClass('hidden');
							widget.find('.price-list-product-count').addClass('hidden');
							widget.find('.price-list-wrapper').addClass('hidden');
							widget.find('.add-price-list-button-wrapper').addClass('hidden');
						}
					});

					// Add price list
					$('.add-price-list').unbind().on('click', function(event) {
						var widget = $(this).parent().parent(),
							wrapper = widget.find('.price-list-wrapper'),
							markup = widget.find('.price-list-empty').clone().children();

						$(markup).appendTo(wrapper);
						return false;
					});

					// Remove price list
					$(document).unbind().on('click', '.remove-price-list', function(event) {
						$(this).parent().hide().remove();
						return false;
					});
				});
			</script>	
			<?php
		}

		/**
		 * Sanitize widget form values as they are saved.
		 *
		 * @see WP_Widget::update()
		 *
		 * @param array $new_instance Values just sent to be saved.
		 * @param array $old_instance Previously saved values from database.
		 *
		 * @return array Updated safe values to be saved.
		 */
		public function update($new_instance, $old_instance) {
			$instance = array();
			$instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
			$instance['display_type'] = (!empty($new_instance['display_type'])) ? strip_tags($new_instance['display_type']) : '';
			$instance['show_currency'] = (!empty($new_instance['show_currency'])) ? strip_tags($new_instance['show_currency']) : '';

			// price list
			if (isset($new_instance['price_list'])) {
				$min = $new_instance['price_list']['min'];
				$to = $new_instance['price_list']['to'];
				$max = $new_instance['price_list']['max'];
				$price_list = array();

				foreach ($min as $key => $mmin) {
					$mmin = $mmin;
					$mmax = $max[$key];
					$mto = !empty($to[$key]) ? $to[$key] : '-';

					if (!empty($mmin) || !empty($mmax)) {
						$price_list[] = array(
							'min' => $mmin,
							'to'  => $mto,
							'max' => $mmax,
						);
					}
				}

				$instance['price_list'] = $price_list;

			}

			return $instance;
		}
	}
}

// register widget
if (!function_exists('wcapf_register_price_filter_widget')) {
	function wcapf_register_price_filter_widget() {
		register_widget('WCAPF_Price_Filter_Widget');
	}
	add_action('widgets_init', 'wcapf_register_price_filter_widget');
}
