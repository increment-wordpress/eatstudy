<?php
function agni_custom_fonts_upload(){

	if( !empty($_POST['text']) ){
		$text = $_POST['text'];

		$upload_dir = wp_upload_dir();
		$custom_dirname = 'agni-fonts';
		$file_dirname = $upload_dir['basedir'].'/'.$custom_dirname;

		$font_dir = $file_dirname.'/'.$text;
		agni_custom_font_mkdir( $font_dir );
	}

	if( !empty($_FILES['files']['name'][0]) ){
		$files = $_FILES['files'];

		$success_msg = $error_msg = '';

		$allowed_file_types = array('eot' =>'application/vnd.ms-fontobject', 'otf|ttf' =>'application/font-sfnt','woff' =>'application/font-woff', 'woff2' => 'application/font-woff2', 'woff2' => 'font/woff2', 'svg' => 'image/svg+xml');

		$upload_overrides = array( 'test_form' => false, 'unique_filename_callback' => 'agni_font_file_overwrite', 'mimes' => $allowed_file_types );

		foreach ($files['name'] as $key => $value) {
			if ($files['name'][$key]) {
				$file = array(
					'name'     => $files['name'][$key],
					'type'     => $files['type'][$key],
					'tmp_name' => $files['tmp_name'][$key],
					'error'    => $files['error'][$key],
					'size'     => $files['size'][$key]
				);

				add_filter( 'upload_dir', 'agni_get_new_upload_dir' );

				$movefile = wp_handle_upload( $file, $upload_overrides );

				remove_filter( 'upload_dir', 'agni_get_new_upload_dir' );

				if ( $movefile && !isset( $movefile['error'] ) ) {
					$success_msg .= '<p><strong>'.$file['name'].'</strong> Uploaded Successfully.</p>';
				} else {
					$error_msg .= '<p><strong>'.$file['name'].'</strong> '.$movefile['error'].'</p>';
				}

			}
		}
		
		if(!empty($success_msg)){
			echo '<div class="updated">'.$success_msg.'</div>';
		}
		if(!empty($error_msg)){
			echo '<div class="error">'.$error_msg.'</div>';
		}
	}
	return false;
}


function agni_custom_font_delete(){

	if( !empty($_POST['delete']) ){
		$font_name = $_POST['delete'];

		$upload_dir = wp_upload_dir();
		$custom_dirname = 'agni-fonts';
		$file_dirname = $upload_dir['basedir'].'/'.$custom_dirname;

	    $delete_files = glob( $file_dirname.'/'.$font_name.'/*' ); // get all file names
		foreach($delete_files as $delete_file){ // iterate files
			if(is_file($delete_file)){
				unlink($delete_file); // delete file
			}
		}
		if(rmdir($file_dirname.'/'.$font_name)){
			echo '<div class="updated"><p><strong>'.$font_name.'</strong> Removed successfully.</p></div>';
		}
		else{
			echo '<div class="error"><p>Error on removing '.$font_name.'</p></div>';
		}
	}
	return false;
}
