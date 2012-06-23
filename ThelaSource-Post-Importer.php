<?php
/*
Plugin Name: The La Source Post Importer
Plugin URI: https://github.com/echu113/ThelaSource-Post-Importer
Description: This plugin is designed for easy posting of The Source Newspaper articles. Should be able to parse a given document into specific posts. 
Version: 1.0
Author: Enej, Eric
License: GPL2
*/
if ( !defined('ABSPATH') )
	die('-1');

require_once( 'lib/class.the_la_source_importer.php' );

// add the admin options page
add_action('admin_menu', array('the_la_source_importer', 'add_menu' ) );
