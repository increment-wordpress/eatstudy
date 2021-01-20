<?php
/*
Plugin Name: Agni Typekit
Description: Easily add Typekit to your WordPress Site.
License: GNU GPL V2

Its a plugin to add Typekit font on WordPress site developed AgniHD based on Captain Typekit by Captain Theme

*/

function agni_typekit_embed_code()
{
	$agni_typekit_options = get_option( 'agni_typekit_options' );
	if ( $agni_typekit_options['agni_typekit_id'] != '' ) {
		wp_enqueue_script( 'agni-typekit-id-script', '//use.typekit.net/'. esc_attr( $agni_typekit_options['agni_typekit_id'] ).'.js', array( 'jquery' ), '', false );
		wp_add_inline_script( 'agni-typekit-id-script', 'try{Typekit.load();}catch(e){}' );
	}
}
add_action( 'wp_enqueue_scripts', 'agni_typekit_embed_code' );

// define default settings
function agni_typekit_add_defaults()
{
	$tmp = get_option( 'agni_typekit_options' );
	if ( !is_array( $tmp ) ) {
		$arr = array( 'agni_typekit_id' => '' );
		update_option( 'agni_typekit_options', $arr );
	}
}
register_activation_hook( __FILE__, 'agni_typekit_add_defaults' );


// whitelist settings
function agni_typekit_init()
{
	register_setting( 'agni_typekit_options', 'agni_typekit_options', 'agni_typekit_validate_options' );
}
add_action( 'admin_init', 'agni_typekit_init' );


// sanitize and validate input
function agni_typekit_validate_options( $input )
{
	$input['agni_typekit_id'] = wp_filter_nohtml_kses( $input['agni_typekit_id'] );
	return $input;
}

// add the options page
function agni_typekit_add_options_page()
{
	add_submenu_page('halena', esc_html__( 'Typekit Fonts', 'agni-halena-plugin' ), esc_html__( 'TypeKit Fonts', 'agni-halena-plugin' ), 'edit_theme_options', 'halena-typekit-font', 'agni_typekit_render_form' );
}
add_action( 'admin_menu', 'agni_typekit_add_options_page', 99 );


// create the options page
function agni_typekit_render_form()
{
	ob_start();
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Typekit Fonts', 'agni-halena-plugin' ) ?></h1>

		<form method="post" action="options.php">
			<?php settings_fields( 'agni_typekit_options' ); ?>
			<?php $agni_typekit_options = get_option( 'agni_typekit_options' ); ?>

			<div class="form-table">
				<h2 class="agni-typekit-text-field-title"><?php esc_html_e( 'Enter Typekit Kit ID', 'agni-halena-plugin' ) ?></h2>
				<input class="agni-typekit-text-field" type="text" size="20" maxlength="20" name="agni_typekit_options[agni_typekit_id]" value="<?php echo esc_attr( $agni_typekit_options['agni_typekit_id'] ); ?>" style="padding: 15px 25px; border: 0; border-radius: 40px; background-color: #222; color: #fff; font-size: 20px;" />
				<p class="typekit-instruction"><?php echo wp_kses(__( 'See the instructions at <a href="#instructions" target="blank">bottom</a>', 'agni-halena-plugin' ), array( 'a' => array( 'href' => array() ) ) ); ?></p>
			</div>
			<p class="agni-typekit-form-submit submit">
				<input type="submit" class="button button-primary button-large" value="<?php esc_attr_e( 'Save Typkit kit ID', 'agni-halena-plugin' ) ?>" />
			</p>
		</form><br/>
	
	<?php if ( $agni_typekit_options['agni_typekit_id'] != '' ) { ?>
		<h3><?php echo esc_html_e( 'Font List :', 'agni-halena-plugin' ); ?></h3>
		<p><?php echo esc_html_e( 'List of font you\'re using on Typekit.', 'agni-halena-plugin' ); ?></p>
		
		<?php
		$kit = esc_attr( $agni_typekit_options['agni_typekit_id'] );

		$json = wp_remote_get( 'https://typekit.com/api/v1/json/kits/' . $kit . '/published' );
		
		$kits = json_decode( $json['body'] );

		$fonts = array(); 
		?>
		
		<table class="widefat">
		<thead>
			<tr>
				<?php echo '<th>'.esc_html__( 'Font', 'agni-halena-plugin' ).'</th><th>'.esc_html__( 'Font Family', 'agni-halena-plugin' ).'</th><th>'.esc_html__( 'Variations', 'agni-halena-plugin' ).'</th><th>'.esc_html__( 'URL', 'agni-halena-plugin' ).'</th>'; ?>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<?php echo '<th>'.esc_html__( 'Font', 'agni-halena-plugin' ).'</th><th>'.esc_html__( 'Font Family', 'agni-halena-plugin' ).'</th><th>'.esc_html__( 'Variations', 'agni-halena-plugin' ).'</th><th>'.esc_html__( 'URL', 'agni-halena-plugin' ).'</th>'; ?>
			</tr>
		</tfoot>
		<tbody>
		
		<?php
		// Need to remove the strong/code html and target with Table CSS Styles
		foreach ($kits->kit->families AS $fontFamily)
		{
			echo '<tr><td><strong>';
			
			echo esc_html( $fontFamily->name );
			
			echo '</strong></td><td><code>';
			
			echo esc_html( $fontFamily->slug );
			
			echo '</code></td><td>';
			
			$variations = $fontFamily->variations;
			
			// Dear Developers reading the following. I am SURE there is a better way to do the following, but at the time of writing this I couldn't think of it (especially due to be NOT REALLY being a plugin developer. I would love for you to let me know a better way. Better yet, make a pull request on the GitHub Repo for it. PS. I'm thinking like another foreach statement within the first one? With conditionals for stuff like Italic/Bold/etc.? Something like a switch is needed. Anyway, I'll worry about that real soon!
			$font_variations_list = '';
			foreach ( $variations as $variation => $value ){
				$font_variations_list .=  str_replace('n', '', $value).'00, ';
			}
			echo trim( $font_variations_list, ', ');
			echo '</td><td>';
			
			echo '<a href="http://typekit.com/fonts/' . $fontFamily->slug . '">';
			_e( 'View on Typekit', 'agni-halena-plugin' );
			echo '</a></td></tr>';
			
		}
		
		?>
		
		</tbody>
		
		</table><br/>	
	
	<?php } ?>

	<h3><?php esc_html_e( 'Font usage :', 'agni-halena-plugin' ); ?></h3>
	<p><?php echo sprintf( wp_kses( __( 'Add your desire CSS codes at <a href="%s">Custom CSS</a>', 'agni-halena-plugin' ), array(  'a' => array( 'href' => array() ) ) ), esc_url( admin_url() . 'admin.php?page=halena-theme-options&tab=29' ) ); ?></p>
	<pre class="agni-typekit-font-usage" style="background-color: #fff; padding: 10px;"><?php 
	echo 'p {
  font-family: "Arial", sans-serif;
  font-weight: 400;
  font-style: italic;
}'; ?></pre><br/>

	<h3 id="instructions"><?php esc_html_e('Instructions', 'agni-halena-plugin'); ?></h3>
	<ol>
		<li><?php echo wp_kses(__( 'Go to <a href="https://typekit.com/" target="blank">typekit.com</a> and register for an account', 'agni-halena-plugin' ), array( 'a' => array( 'href' => array() ) ) ); ?></li>
		<li><?php esc_html_e('Choose a few fonts to add to your account and Publish them', 'agni-halena-plugin'); ?></li>
		<li><?php esc_html_e('Click Kit Editor at the top right and get your Typekit kit ID(at the bottom)', 'agni-halena-plugin'); ?></li>
	</ol>
		
	</div>
<?php
	echo ob_get_clean();
}

// Omit closing PHP tag baby!