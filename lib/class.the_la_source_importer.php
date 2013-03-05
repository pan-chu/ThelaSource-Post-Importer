<?php

class the_la_source_importer{

	public static function tlspi_initiate_page() {
	
		
		if($_POST) { // if the form was submitted
			if ( isset( $_POST['preview_submit'] ) ) {
				require(TLSI_DIR_PATH.'/views/submitted.php');
			} else {
				require(TLSI_DIR_PATH.'/views/preview.php');
			}
		} else { // show the form
			require(TLSI_DIR_PATH.'/views/form.php');
		}
		
		

	}
	
	// add page to settings menu
	public static function add_menu() {
		add_options_page( 'Posts Importer', 'Posts Importer', 'manage_options', 'tlspi_plugin', array( 'the_la_source_importer', 'tlspi_initiate_page' ) );
	
	}
	
	public static function wp_enqueue_scripts() {
		wp_enqueue_script(
			'chosen',
			TLSI_DIR_URL.'/js/chosen.js',
			array('jquery')
		);
		
		wp_enqueue_script(
			'importer',
			TLSI_DIR_URL.'/js/importer.js'
		);
		wp_enqueue_script(
			'mirror',
			TLSI_DIR_URL.'/js/codemirror.js'
		);
		wp_enqueue_script(
			'tlspi',
			TLSI_DIR_URL.'/js/tlspi.js',
			array('jquery')
		);
		
		
		
		wp_enqueue_script(
			'mirror-xml',
			TLSI_DIR_URL.'/js/xml.js',
			array('mirror')
		);
		wp_enqueue_style(
			'chosen-css',
			TLSI_DIR_URL.'/css/chosen
			.css'
		);
		wp_enqueue_style(
			'mirror-css',
			TLSI_DIR_URL.'/css/codemirror.css'
		);
		wp_enqueue_style(
			'tlspi-css',
			TLSI_DIR_URL.'/css/tlspi.css'
		);
	}
} 