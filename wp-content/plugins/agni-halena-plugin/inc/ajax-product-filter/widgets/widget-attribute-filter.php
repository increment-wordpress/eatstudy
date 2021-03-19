<?php
/**
 * WC Ajax Product Filter by Attribute
 */
if (!class_exists('WCAPF_Attribute_Filter_Widget')) {
	class WCAPF_Attribute_Filter_Widget extends WP_Widget {
		/**
		 * Register widget with WordPress.
		 */
		function __construct() {
			parent::__construct(
				'wcapf-attribute-filter', // Base ID
				__('WC Ajax Product Filter by Attribute', 'agni-halena-plugin'), // Name
				array('description' => __('Filter woocommerce products by attribute.', 'agni-halena-plugin')) // Args
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
			
			// enqueue necessary scripts
			wp_enqueue_style('wcapf-style');
			wp_enqueue_style('font-awesome');
			wp_enqueue_script('wcapf-script');
			
			if (empty($instance['attr_name']) && empty($instance['query_type'])) {
				return;
			}

			$enable_multiple = (!empty($instance['enable_multiple'])) ? (bool)$instance['enable_multiple'] : '';
			$show_count = (!empty($instance['show_count'])) ? (bool)$instance['show_count'] : '';
			$enable_hierarchy = (!empty($instance['hierarchical'])) ? (bool)$instance['hierarchical'] : '';
			$show_children_only = (!empty($instance['show_children_only'])) ? (bool)$instance['show_children_only'] : '';
			$display_type = (!empty($instance['display_type'])) ? $instance['display_type'] : '';

			$attr_size_val = (!empty($instance['attr_size_val'])) ? $instance['attr_size_val'] : '';
			$attr_color_val = (!empty($instance['attr_color_val'])) ? $instance['attr_color_val'] : '';

			$attribute_name = $instance['attr_name'];
			$taxonomy   = 'pa_' . $attribute_name;
			$query_type = $instance['query_type'];
			$data_key   = ($query_type === 'and') ? 'attra-' . $attribute_name : 'attro-' . $attribute_name;

			// parse url
			$url = $_SERVER['QUERY_STRING'];
			parse_str($url, $url_array);

			$attr_size_array = $attr_color_array = array();
			$attribute_values_output = get_terms( $taxonomy );
			foreach ( $attribute_values_output as $attr_val ) {
				if( !empty($attr_val->name) ){
					if( !empty($attr_size_val[$attr_val->name]) ){
						$attr_size_array[$attr_val->name] = $attr_size_val[$attr_val->name];
					}
					
					if( !empty($attr_color_val[$attr_val->name]) ){
						$attr_color_array[$attr_val->name] = $attr_color_val[$attr_val->name];
					}
				}
			}

			$attr_args = array(
				'taxonomy'           => $taxonomy,
				'data_key'           => $data_key,
				'query_type'         => $query_type,
				'enable_multiple'    => $enable_multiple,
				'show_count'         => $show_count,
				'enable_hierarchy'   => $enable_hierarchy,
				'show_children_only' => $show_children_only,
				'url_array'          => $url_array,
				'display_type'		 => $display_type,
				'attr_size_array'	 => $attr_size_array,
				'attr_color_array'	 => $attr_color_array
			);

			// if display type list
			if ($display_type === 'dropdown') {
				wp_enqueue_style('halena-select2-style'); 
				wp_enqueue_script('halena-select2-script'); 

				$output = wcapf_dropdown_terms($attr_args);
			}
			else {
				$output = wcapf_list_terms($attr_args);
			} 
			if ($display_type === 'color') {
				if( !function_exists('agni_woocommerce_ajax_attributes_filter_scripts') ){
					function agni_woocommerce_ajax_attributes_filter_scripts( $hook ) {
					    if ( 'widgets.php' != $hook ) {
					        return;
					    }
					    wp_enqueue_style( 'wp-color-picker' );        
					    wp_enqueue_script( 'wp-color-picker' ); 
					}
					add_action( 'admin_enqueue_scripts', 'agni_woocommerce_ajax_attributes_filter_scripts' );
				}
			}
			
			$html = $output['html'];
			$found = $output['found'];

			// if display type list
			if (!empty($instance['display_type']) && $instance['display_type'] === 'list') {}

			extract($args);

			// Add class to before_widget from within a custom widget
			// http://wordpress.stackexchange.com/questions/18942/add-class-to-before-widget-from-within-a-custom-widget

			$widget_class = 'woocommerce wcapf-ajax-term-filter widget_layered_nav';
			// if $selected_terms array is empty we will hide this widget totally
			if ($found === false) {
				$widget_class .= ' wcapf-widget-hidden';
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

			echo $html;

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
			<?php
			$attribute_taxonomies = wc_get_attribute_taxonomies();
			if (sizeof($attribute_taxonomies) > 0) {
				?>
				<label for="<?php echo esc_attr( $this->get_field_id('attr_name') ); ?>"><?php printf(__('Attribute', 'agni-halena-plugin')); ?></label>
				<select class="widefat attr-choice" id="<?php echo esc_attr( $this->get_field_id('attr_name') ); ?>" name="<?php echo esc_attr( $this->get_field_name('attr_name') ); ?>">
					<?php
					foreach ($attribute_taxonomies as $taxonomy) {
						echo '<option value="' . $taxonomy->attribute_name . '" ' . ((!empty($instance['attr_name']) && $instance['attr_name'] === $taxonomy->attribute_name) ? 'selected="selected"' : '') . '>' . $taxonomy->attribute_label . '</option>';
					}
					?>
				</select>
				<?php
			} else {
				printf(__('No attribute found!', 'agni-halena-plugin'));
			}
			?>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id('display_type') ); ?>"><?php printf(__('Display Type:', 'agni-halena-plugin')) ?></label>
				<select class="widefat attr-display-type" id="<?php echo esc_attr( $this->get_field_id('display_type') ); ?>" name="<?php echo esc_attr( $this->get_field_name('display_type') ); ?>">
					<option value="list" <?php echo ((!empty($instance['display_type']) && $instance['display_type'] === 'list') ? 'selected="selected"' : ''); ?>><?php printf(__('List', 'agni-halena-plugin')); ?></option>
					<option value="dropdown" <?php echo ((!empty($instance['display_type']) && $instance['display_type'] === 'dropdown') ? 'selected="selected"' : ''); ?>><?php printf(__('Dropdown', 'agni-halena-plugin')); ?></option>
					<option value="size" <?php echo ((!empty($instance['display_type']) && $instance['display_type'] === 'size') ? 'selected="selected"' : ''); ?>><?php printf(__('Size', 'agni-halena-plugin')); ?></option>
					<option value="color" <?php echo ((!empty($instance['display_type']) && $instance['display_type'] === 'color') ? 'selected="selected"' : ''); ?>><?php printf(__('Color', 'agni-halena-plugin')); ?></option>
				</select>
			</p>
			<?php if ( !empty($attribute_taxonomies) ) {
				$hidden = $hidden_color = '';
				foreach ($attribute_taxonomies as $taxonomy) {
					$attribute_values = get_terms( 'pa_'.$taxonomy->attribute_name );
					if ( !empty( $attribute_values ) && !is_wp_error( $attribute_values ) ) { ?>
					<div class="attr-type-size-wrapper attr-type-size-wrapper-<?php echo esc_attr( $taxonomy->attribute_name ); ?> <?php 
						if( !empty($instance['display_type']) && $instance['display_type'] != 'size' ){
							echo ' hidden_by_attr';
						}
						elseif( empty($instance['display_type']) && empty($instance['attr_name']) ){
							echo esc_attr( $hidden ); 
						}
						elseif( $instance['attr_name'] != $taxonomy->attribute_name ){ 
							echo ' hidden_by_attr'; 
						} ?> 
						<?php echo (!isset($instance['display_type']) || $instance['display_type'] === 'color') ? 'hidden' : ''; ?>">
						<table class="attr-type-table attr-type-size-table">
							<thead>
								<tr><th><?php echo esc_html__( 'Terms', 'agni-halena-plugin' ); ?></th><th><?php echo esc_html__( 'Label', 'agni-halena-plugin' ); ?></th></tr>
							</thead>
							<tbody>
							<?php $attr_id = 0;
							foreach ( $attribute_values as $attr_val ) { ?>
								<tr class="attr-val">
									<td>
										<label for="<?php echo esc_attr( $this->get_field_id('attr_size_val') ); ?>[<?php echo esc_attr( $attr_val->name ) ?>]"><?php echo esc_attr( $attr_val->name ); ?></label>
									</td>
									<td>
										<input class="widefat size-label" id="<?php echo esc_attr( $this->get_field_id('attr_size_val') ).'['.$attr_val->name.']'; ?>" name="<?php echo esc_attr( $this->get_field_name( 'attr_size_val' ) ); ?>[<?php echo esc_attr( $attr_val->name ); ?>]" type="text" value="<?php echo (!empty($instance['attr_size_val'][$attr_val->name]) ? esc_attr($instance['attr_size_val'][$attr_val->name]) : ''); ?>" placeholder="<?php echo esc_attr( $attr_val->name ); ?>" />
									</td>
								</tr>
								<?php $attr_id++;
							} $hidden = ' hidden_by_attr'; ?>
							</tbody>
						</table>
					</div>

					<div class="attr-type-color-wrapper attr-type-color-wrapper-<?php echo esc_attr( $taxonomy->attribute_name ); ?> <?php 
						if( !empty($instance['display_type']) && $instance['display_type'] != 'color' ){
							echo ' hidden_by_attr';
						}
						elseif( empty($instance['display_type']) && empty($instance['attr_name']) ){
							echo esc_attr( $hidden_color ); 
						}
						elseif( $instance['attr_name'] != $taxonomy->attribute_name ){ 
							echo ' hidden_by_attr'; 
						} ?> 
						<?php echo (!isset($instance['display_type']) || $instance['display_type'] === 'size') ? 'hidden' : ''; ?>">
						<table class="attr-type-table attr-type-color-table">
							<thead>
								<tr><th><?php echo esc_html__( 'Terms', 'agni-halena-plugin' ); ?></th><th><?php echo esc_html__( 'Color', 'agni-halena-plugin' ); ?></th></tr>
							</thead>
							<tbody>
							<?php $attr_id = 0;
							foreach ( $attribute_values as $attr_val ) { ?>
								<tr class="attr-val">
									<td>
										<label for="<?php echo esc_attr( $this->get_field_id('attr_color_val') ); ?>[<?php echo esc_attr( $attr_val->name ) ?>]"><?php echo esc_html( $attr_val->name ); ?></label>
									</td>
									<td>
										<input class="widefat color-label" id="<?php echo esc_attr( $this->get_field_id('attr_color_val') ).'['.$attr_val->name.']'; ?>" name="<?php echo esc_attr( $this->get_field_name( 'attr_color_val' ) ); ?>[<?php echo esc_attr( $attr_val->name ); ?>]" type="text" value="<?php echo (!empty($instance['attr_color_val'][$attr_val->name]) ? esc_attr($instance['attr_color_val'][$attr_val->name]) : ''); ?>" />
									</td>
								</tr>
								<?php $attr_id++;
							} $hidden_color = ' hidden_by_attr'; ?>
							</tbody>
						</table>
					</div>
				<?php }
				}
			} ?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id('query_type') ); ?>"><?php printf(__('Query Type', 'agni-halena-plugin')) ?></label>
				<select class="widefat" id="<?php echo esc_attr( $this->get_field_id('query_type') ); ?>" name="<?php echo esc_attr( $this->get_field_name('query_type') ); ?>">
					<option value="and" <?php echo ((!empty($instance['query_type']) && $instance['query_type'] === 'and') ? 'selected="selected"' : ''); ?>><?php printf(__('AND', 'agni-halena-plugin')); ?></option>
					<option value="or" <?php echo ((!empty($instance['query_type']) && $instance['query_type'] === 'or') ? 'selected="selected"' : ''); ?>><?php printf(__('OR', 'agni-halena-plugin')); ?></option>
				</select>
			</p>
			<p>
				<input id="<?php echo esc_attr( $this->get_field_id('enable_multiple') ); ?>" name="<?php echo esc_attr( $this->get_field_name('enable_multiple') ); ?>" type="checkbox" value="1" <?php echo (!empty($instance['enable_multiple']) && $instance['enable_multiple'] == true) ? 'checked="checked"' : ''; ?>>
				<label for="<?php echo esc_attr( $this->get_field_id('enable_multiple') ); ?>"><?php printf(__('Enable multiple filter', 'agni-halena-plugin')); ?></label>
			</p>
			<p>
				<input id="<?php echo esc_attr( $this->get_field_id('show_count') ); ?>" name="<?php echo esc_attr( $this->get_field_name('show_count') ); ?>" type="checkbox" value="1" <?php echo (!empty($instance['show_count']) && $instance['show_count'] == true) ? 'checked="checked"' : ''; ?>>
				<label for="<?php echo esc_attr( $this->get_field_id('show_count') ); ?>"><?php printf(__('Show count', 'agni-halena-plugin')); ?></label>
			</p>
			<p>
				<input id="<?php echo esc_attr( $this->get_field_id('hierarchical') ); ?>" name="<?php echo esc_attr( $this->get_field_name('hierarchical') ); ?>" type="checkbox" value="1" <?php echo (!empty($instance['hierarchical']) && $instance['hierarchical'] == true) ? 'checked="checked"' : ''; ?>>
				<label for="<?php echo esc_attr( $this->get_field_id('hierarchical') ); ?>"><?php printf(__('Show hierarchy', 'agni-halena-plugin')); ?></label>
			</p>
			<p>
				<input id="<?php echo esc_attr( $this->get_field_id('show_children_only') ); ?>" name="<?php echo esc_attr( $this->get_field_name('show_children_only') ); ?>" type="checkbox" value="1" <?php echo (!empty($instance['show_children_only']) && $instance['show_children_only'] == true) ? 'checked="checked"' : ''; ?>>
				<label for="<?php echo esc_attr( $this->get_field_id('show_children_only') ); ?>"><?php printf(__('Only show children of the current attribute', 'agni-halena-plugin')); ?></label>
			</p>
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
			$instance['attr_name'] = (!empty($new_instance['attr_name'])) ? strip_tags($new_instance['attr_name']) : '';
			$instance['display_type'] = (!empty($new_instance['display_type'])) ? strip_tags($new_instance['display_type']) : '';
			$instance['query_type'] = (!empty($new_instance['query_type'])) ? strip_tags($new_instance['query_type']) : '';
			$instance['enable_multiple'] = (!empty($new_instance['enable_multiple'])) ? strip_tags($new_instance['enable_multiple']) : '';
			$instance['show_count'] = (!empty($new_instance['show_count'])) ? strip_tags($new_instance['show_count']) : '';
			$instance['hierarchical'] = (!empty($new_instance['hierarchical'])) ? strip_tags($new_instance['hierarchical']) : '';
			$instance['show_children_only'] = (!empty($new_instance['show_children_only'])) ? strip_tags($new_instance['show_children_only']) : '';

			if( (!empty($new_instance['attr_size_val'])) ){
				$new_text_var = array();

				$attribute_taxonomies = wc_get_attribute_taxonomies();
				foreach ($attribute_taxonomies as $taxonomy) {
					$attribute_values = get_terms( 'pa_'.$taxonomy->attribute_name );
					foreach ( $attribute_values as $attr_val ) {
						$new_text_var[$attr_val->name] = $new_instance['attr_size_val'][$attr_val->name];
					}
				}
				$instance['attr_size_val'] = $new_text_var;
			}
			if( (!empty($new_instance['attr_color_val'])) ){
				$new_color_var = array();

				$attribute_taxonomies = wc_get_attribute_taxonomies();
				foreach ($attribute_taxonomies as $taxonomy) {
					$attribute_values = get_terms( 'pa_'.$taxonomy->attribute_name );
					foreach ( $attribute_values as $attr_val ) {
						$new_color_var[$attr_val->name] = $new_instance['attr_color_val'][$attr_val->name];
					}
				}
				$instance['attr_color_val'] = $new_color_var;
			}

			return $instance;
		}
	}
}

// register widget
if (!function_exists('wcapf_register_attribute_filter_widget')) {
	function wcapf_register_attribute_filter_widget() {
		register_widget('WCAPF_Attribute_Filter_Widget');
	}
	add_action('widgets_init', 'wcapf_register_attribute_filter_widget');
}