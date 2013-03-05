<?php

if ( !current_user_can( 'manage_options' ) ) {
	   wp_die( 'You do not have sufficient permission to access this page.');
}

tlspi_insert_posts();

tlspi_success();


function tlspi_insert_posts() {
	global $wpdb;
	
	$temp = array();	
	
	for ($i = 1; $i <= (int)$_POST['num_posts']; $i++) {
		 
		if( isset($_POST['posts'][$i]) && is_array( $_POST['posts'][$i] ) ):
		
			if( isset( $_POST['posts'][$i]['categories'] ) &&  is_array( $_POST['posts'][$i]['categories'] )  ):
				$categories = $_POST['posts'][$i]['categories'];
			else:
				$categories = array();
			endif;
			
			$temp = array(
				'post_title' => $_POST['posts'][$i]['title'],
				'post_author' => $_POST['posts'][$i]['author'],
				'post_content' => $_POST['posts'][$i]['content'],
				'post_category' => $categories,
				'post_excerpt' => $_POST['posts'][$i]['excerpt'],
				'post_status' => 'draft',
				'post_date'   => date('Y-m-d H:i:s', time()-( 60*$i ) )
			);
			
			$first_img = '';
	  		ob_start();
	  		ob_end_clean();
	  		$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $_POST['posts'][$i]['content'], $matches);
	  		
	
	  		if( isset($matches [1] [0]) )
	  			$first_img = $matches [1] [0];
			
			
			$new_post_id = wp_insert_post( $temp );
			
			echo "just added : ".$_POST['posts'][$i]['title']. " <a href='".admin_url('post.php?post='.$id.'&action=edit')."'>Edit</a> <br />";
			
			
			if( !empty($first_img) ):
				$img_id = $wpdb->get_var( "SELECT ID FROM $wpdb->posts WHERE guid = '$first_img'" );
			
			if( is_numeric($img_id) )
				add_post_meta($new_post_id, '_thumbnail_id', $img_id, true); 
				
				unset($img_id);
			endif;
		endif;
		
		
	}
	

}

function tlspi_success() {

	echo '<h1> Thank you </h1>';
	echo '<p> Posts have been successfully added </p>';
	
	die();

}
