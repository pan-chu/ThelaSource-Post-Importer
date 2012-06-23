<?php

class the_la_source_impoter{

	public static function tlspi_initiate_page() {
	
		
		if($_POST) { // if the form was submitted
			if ($_POST['preview_submit']) {
				require('submitted.php');
			} else {
				require('preview.php');
			}
		} else { // show the form
			require('form.php');
		}
		
		

	}
	
	// add page to settings menu
	public static function add_menu() {
		add_options_page( 'Posts Importer', 'Posts Importer', 'manage_options', 'plugin', array( 'the_la_source_impoter', 'tlspi_initiate_page' );
	
	}



} 