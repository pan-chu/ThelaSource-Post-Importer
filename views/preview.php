<?php

    
global $the_text, $the_text_array, $text_array_size, $post_array;

if ( !current_user_can( 'manage_options' ) ) {
	   wp_die( 'You do not have sufficient permission to access this page.');
}

tlspi_parse_show();

function tlspi_parse_show() {
	   global $user_ID;
       $the_text_real = trim($_POST['preview']);

       $the_text_array_real = explode("\n", $the_text_real);

       $title = '';
       $content = '';
       $author = '';
       $posts = array();
       $post = array();
       $count = 0;
      
       foreach($the_text_array_real as $line):
		   //echo strlen($line);
		   // echo "<br />".$line;
	       if( strlen($line) <= 1 ) {
	       		// skip this line
	            $count++;
	            // echo "skip this line<br />";
	       } else {
	       	   // echo "store this line<br />";
	           $count = 0;
	           if( empty( $title ) ) {
	           	//	echo 'this line is a title<br />';
	                   $title = stripslashes($line);
	           } else {
	          // 	echo 'this line is content<br />';
	                   $content .="<p>".stripslashes($line)."</p>";
	           }
	       }

           // echo $count."<br />";

	       if( $count > 2 ) {
	       // if we get more then 3 empty lines then we can safely say that we are dealing with a new article
	           if( !empty($title) && !empty($content) ) {
	                   $post['title'] = $title;
	                   $post['content'] = $content;
	                   $posts[] = $post;
	
	                   $post = array();
	                   $title = '';
	                   $content = '';
	                   $author = '';
	       		}

           }

       endforeach;
	   // store the last items here any way
	   $post['title'] = $title;
	   $post['content'] = $content;
	   $posts[] = $post;
      
       echo '<h1> Preview </h1>';
       
       echo '<p> Please make appropriate adjustments to each post and check ready. The posts that have not been checked will NOT be added into WordPress. </p>';
       
       echo '<form method="post" action="">';
       
       $count_post = 1;
       foreach ($posts as $apost):
       		echo '<div class="the_post_wrap">';
       		echo '<div class="the_title">';
       		
       		echo '<input type="text"  id="title-'.$count_post.'" name="posts['.$count_post.'][title]" value="'.mb_convert_encoding($apost['title'], "HTML-ENTITIES", "UTF-8").'"><br />';
       		echo "</div>";
       		echo '<div class="the_content">';
       		// $apost['content'] = tlspi_convert_text_to_links( $apost['content'] );
       		$content =	mb_convert_encoding($apost['content'] , "HTML-ENTITIES", "UTF-8");
       		$excerpt = explode( '.', $content);
       		
       		$content = make_clickable( $content );
       		
       		wp_editor( $content, 'post_'.$count_post.'_content' , array( 'textarea_name' => 'posts['.$count_post.'][content]')); 
       		echo '
       		<label style="display:block; margin-top:20px; ">Excerpt</label>
       		<textarea  style="width:100%; height:100px;" name="posts['.$count_post.'][excerpt]">'.strip_tags ($excerpt[0]).'.</textarea>
       		</div>';
       		echo "<div class='post-meta submitbox '>
       			Categories:<br />
       		";
       		echo '<select class="categories" name="posts['.$count_post.'][categories][]" id="cat-'.$count_post.'" multiple="true" >'; 
       		$args = array(
	'type'                     => 'post',
	'orderby'                  => 'name',
	'order'                    => 'ASC',
	'hide_empty'               => 0,
	'hierarchical'             => 1);
	       		$categories = get_categories( $args );
	       		foreach($categories as $category):
       				echo "<option value='".$category->term_id."' /> ".$category->name."</option>";
       				
       			endforeach;
       		echo "</select>";
       		echo '<p>';
       		echo '<label>Author:<br /> ';
       		wp_dropdown_users( array(
		'who' => 'authors',
		'name' => 'posts['.$count_post.'][author]',
		'selected' => empty($user_ID),
		'include_selected' => true
	) );	
       		echo '</label></p><br /><br />';
       		echo "</div>";
       		echo "</div>";
       		       	
       		$count_post ++;
       endforeach;
       
       echo '<input type="hidden" name="num_posts" value="'.$count_post.'">';
       
       echo "<input type='submit' name='preview_submit' value='Add Posts!' class='button-primary' />";
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
	<?php
}

