<?php


global $the_text, $the_text_array, $text_array_size, $post_array;

if ( !current_user_can( 'manage_options' ) ) {
	   wp_die( 'You do not have sufficient permission to access this page.');
}

tlspi_parse_show();

function tlspi_parse_show() {

       $the_text_real = trim($_POST['preview']);

       $the_text_array_real = explode("\n", $the_text_real);

       //echo "<pre>";
       //var_dump($the_text_array_real);
       //echo "</pre>";
       $title = '';
       $content = '';
       $author = '';
       $posts = array();
       $post = array();
       $count = 0;
       foreach($the_text_array_real as $line):
               // echo "<pre>";
               // var_dump($line);
               // echo "</pre>";

               if( strlen($line) == 1 ) {
                       $count++;
               } else {

                       $count = 0;
                       if( empty( $title ) ) {
                               $title = stripslashes($line);
                       } else if( empty($author) ){
                               $author = stripslashes($line);
                       } else {
                               $content .="".stripslashes($line)."\n";
                       }



               }

               // echo $count."<br />";

               if( $count > 2 ) {
                       if( !empty($title) && !empty($author) && !empty($content) ) {
                               $post['title'] = $title;
                               $post['author'] = $author;
                               $post['content'] = $content;
                               $posts[] = $post;

                               $post = array();
                               $title = '';
                               $content = '';
                               $author = '';
                       }

                       /*
                       echo "title: ". $title."<br />";
                       echo "author: ".$author."<br />";
                       echo "content :<br />".$content."<br />";
                       */

                       /*
                       echo "=== NEW POST ===";
                       */

               }

       endforeach;

       
       echo '<h1> Preview </h1>';
       
       echo '<p> Please make appropriate adjustments to each post and check ready. The posts that have not been checked will NOT be added into WordPress. </p>';
       
       echo '<form method="post" action="">';
       
       $count_post = 1;
       foreach ($posts as $apost):
       		echo '<h3>POST '.$count_post.'</h3>';
       		echo '<label for="title-'.$count_post.'">Title:</label><br \> <input type="text" id="title-'.$count_post.'" name="post-'.$count_post.'-title" value="'.mb_convert_encoding($apost['title'], "HTML-ENTITIES", "UTF-8").'"><br />';
       		echo '<label>Author:<br /> ';
       		
       		tlspi_get_user_form( $apost['author'], $count_post );
       		/*
       		<input type="text" name="post-'.$count_post.'-author" value="'.mb_convert_encoding(, "HTML-ENTITIES", "UTF-8").'"><br />';
			*/
       		echo '</label><label>Content:<label><br />';
       		$content =	mb_convert_encoding($apost['content'] , "HTML-ENTITIES", "UTF-8");
       		wp_editor( $content, 'post-'.$count_post.'-content' ); 
       		// <textarea  name="post-'.$count_post.'-content">';
       		//echo 
       		// echo '</textarea> <br />
       		echo 'ready? 
       		<input type="checkbox" name="post['.$count_post.'][ready]" />
       		       		<br /><br /><br />';
       		$count_post ++;
       endforeach;
       
       echo '<input type="hidden" name="num_posts" value="'.$count_post.'">';
       
       echo "<input type='submit' name='preview_submit' value='Add Posts!' />";
       echo '</form>';
       
}

function tlspi_get_user_form( $author_text, $count ){

	$author_array = explode($author_text, " ");
	
	foreach($author_array as $author_piece):
		
		if($author_piece != 'by')
		{
			$users = get_users('search=$author_piece');
			if(!empty($users))
			{
				break;
			}
		}
	endforeach;
	
	if( empty($users) )
		$users = get_users(); 
	?>
	<select name="post[<?php echo $count; ?>][author]"> tried to find '<?php echo $author_text; ?>'
		<?php foreach($users as $user): ?>
			<option value="<?php echo $user->ID; ?>"><?php echo $user->display_name; ?></option>
		<?php endforeach; ?>
	</select>
	<br \><br \>
	<?
}