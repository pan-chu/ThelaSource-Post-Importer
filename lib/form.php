<?php

// add text area for document to be pasted
// add content to page

if ( !current_user_can( 'manage_options' ) ) {
	wp_die( 'You do not have sufficient permission to access this page.');
}
echo '<div class="wrap">';
echo '<h1>The La Source Newspaper Post Importer</h1>';
echo '</div>';
tlspi_make_text_area();


// add text area for document to be pasted
function tlspi_make_text_area() {
		echo '<form method="post" action="">';
		echo '<textarea rows="30" cols=100" name="preview" wrap="physical">';
		echo 'copy and paste document here...';
		echo '</textarea>';
		echo '<br>';
		echo '<input type ="submit" value="Preview" name="submit">';
		echo '<br>';
		echo '</form> <br>';
}

?>