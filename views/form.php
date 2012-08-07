<?php

// add text area for document to be pasted
// add content to page

if ( !current_user_can( 'manage_options' ) ) {
	wp_die( 'You do not have sufficient permission to access this page.');
}

tlspi_make_text_area();


// add text area for document to be pasted
function tlspi_make_text_area() { ?>
	<div class="wrap"> 
		<h1>The La Source Newspaper Post Importer</h1> 
 
		<form method="post" action=""> 
			<label>copy and paste document here... <br />
			<textarea rows="60" cols="100" name="preview" id="code" ></textarea> </label>
			
			<br> 
			<input type ="submit" value="Preview" name="submit" class="button-primary"> 
			<br>
		</form> <br> 
		<script>
			var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
				mode: { name: "xml", alignCDATA: true},
				lineNumbers: true
			});
		</script>
	</div>
<?php
}
