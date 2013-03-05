<?php
/*
Plugin Name: The La Source Post Importer
Plugin URI: https://github.com/echu113/ThelaSource-Post-Importer
Description: This plugin is designed for easy posting of The Source Newspaper articles. Should be able to parse a given document into specific posts. 
Version: 2.0
Author: Enej, Eric
License: GPL2
*/
if ( !defined('ABSPATH') )
	die('-1');

define( 'TLSI_DIR_PATH', plugin_dir_path( __FILE__ ) );
define( 'TLSI_BASENAME', plugin_basename(__FILE__) );
define( 'TLSI_DIR_URL',  plugins_url( ''  , TLSI_BASENAME) );

require_once( 'lib/class.the_la_source_importer.php' );

// add the admin options page
add_action( 'admin_menu', array( 'the_la_source_importer', 'add_menu' ) );
add_action( 'admin_print_styles-settings_page_tlspi_plugin', array( 'the_la_source_importer', 'wp_enqueue_scripts' ) );
// this is from dev