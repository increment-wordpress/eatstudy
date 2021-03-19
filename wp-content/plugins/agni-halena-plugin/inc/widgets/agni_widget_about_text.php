<?php
/*
Plugin Name: Halena About Widget
Plugin URI: http://demo.agnidesigns.com/halena
Description: A Simple widget for displaying various widgets posts.
Version: 1.0
Author: AgniDesigns
Author URI: http://themeforest.net/user/AgniHD
Text Domain: halena
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

*/

class halena_about_text extends WP_Widget {

	public function __construct(){
 
		parent::__construct(
			'halena_about_text',
			esc_html__( 'Halena: About Text', 'agni-halena-plugin' ),
				array(
					'classname'   => 'widget_halena_about_text',
					'description' => esc_html__( 'Extented version of text widget which allows you to set image & heading.', 'agni-halena-plugin' )
				)
			);			
	   
	}
	
	public function widget( $args, $instance ) {
		extract( $args );

		
		$title = apply_filters('widget_title', $instance['title'] );
		$heading = $instance['heading'];
		$image_id = $instance['image_id'];
		$description = $instance['description'];
		
		echo wp_kses_post( $before_widget );
			
		if ( $title )
			echo wp_kses_post( $before_title . $title . $after_title );  ?>

		<div class="about-text-details">
			<?php echo wp_get_attachment_image( $image_id, 'halena-post-thumbnail' ); ?>
			<?php if( !empty( $heading ) ) {?>
				<h6 class="about-text-title"><?php echo esc_html( $heading ); ?></h6>
				<div class="divide-line"><span></span></div>
			<?php } ?>
			<p class="about-text-description"><?php echo esc_html( $description ); ?></p>
		</div>
		<?php	echo wp_kses_post( $after_widget );

	}
		
	public function form( $instance ) {

		$defaults = array( 'title' => esc_html__('About Me', 'agni-halena-plugin'), 'heading' => '', 'image_id' => '', 'description' => '');
		
		foreach ($instance as $value) {
			$value = esc_attr($value);
		}
		unset($value );
		$instance = wp_parse_args( (array) $instance , $defaults ); ?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e('Title:', 'agni-halena-plugin'); ?></label>
			<input  type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>"  />
		</p>

		 <p>
            <input type="text" value="<?php echo esc_attr( $instance['image_id'] ); ?>" class="process_custom_images" name="<?php echo esc_attr( $this->get_field_name( 'image_id' ) ); ?>" max="" min="1" step="1">
            <button class="set_custom_images button"><?php esc_html_e('Add Image', 'agni-halena-plugin'); ?></button>
        </p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'heading' ) ); ?>"><?php esc_html_e('Heading:', 'agni-halena-plugin'); ?></label>
			<input  type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'heading' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'heading' ) ); ?>" value="<?php echo esc_attr( $instance['heading'] ); ?>"  />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>"><?php esc_html_e('Description:', 'agni-halena-plugin'); ?></label>
			<textarea class="widefat" rows="16" cols="20" id="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'description' ) ); ?>"><?php echo wp_kses_post( $instance['description'] ); ?></textarea>
		</p>
		
		
	<?php }
	
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['heading'] = strip_tags( $new_instance['heading'] );
		$instance['image_id'] = strip_tags( $new_instance['image_id'] );
		$instance['description'] = strip_tags( $new_instance['description'] );

		return $instance;
	}
	
}

function register_halena_about_text_script() {
	wp_enqueue_media();
	wp_enqueue_script('agni_about_text', plugin_dir_url(__FILE__) . 'agni_widget_about_text.js', array( 'jquery' ), '', true);
}
add_action ( 'admin_enqueue_scripts', 'register_halena_about_text_script');

function register_halena_about_text() {
    register_widget( 'halena_about_text' );
}

add_action( 'widgets_init', 'register_halena_about_text');