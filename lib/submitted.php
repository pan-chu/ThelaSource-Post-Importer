<?php


echo "<pre>";
var_dump($_POST);
echo "</pre>";


global $the_text, $the_text_array, $text_array_size, $post_array;

if ( !current_user_can( 'manage_options' ) ) {
	   wp_die( 'You do not have sufficient permission to access this page.');
}

tlspi_insert_posts();

tlspi_success();


function tlspi_insert_posts() {
	
	//$f = 2;
	//echo $_POST['post-'.$f.'-title'];
	
	//die();
		
	$temp = array();	
	
	for ($i = 1; $i <= $_POST['num_posts']; $i++) {
		if( $_POST['post'][$i]['ready'] ){
			$temp = array(
				'post_title' => $_POST['post-'.$i.'-title'],
				'post_author' => $_POST['post'][$i]['author'],
				'post_content' => $_POST['post-'.$i.'-content'],
				'post_status' => 'draft'
			);
		
			wp_insert_post($temp);
		}

	}
	

}

function tlspi_success() {

	echo '<h1> Thank you </h1>';
	echo '<p> Posts have been successfully added </p>';
	
	die();

}
