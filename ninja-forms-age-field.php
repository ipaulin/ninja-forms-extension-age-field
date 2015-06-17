<?php
/**
 * Plugin Name: Ninja Forms Age Field
 * Plugin URI: http://wordpress.org/plugins/ninja-forms-age-field/
 * Description: This plugin uses date picker field on front-end for adding date of birth, and converts birth date into age number. Input date format must be: mm/dd/yyy
 * Version: 1.1.1
 * Author: Ivan Paulin
 * Author URI: http://www.ivanpaulin.com
 * License:  GPLv2 or later
 */
 
 
// Extension directory
define("NINJA_FORMS_AGE_FIELD_DIR", WP_PLUGIN_DIR."/".basename( dirname( __FILE__ ) ) );
 
// Check if Ninja Forms plugin is activated
if( in_array( 'ninja-forms/ninja-forms.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	// Load field file
	require_once( NINJA_FORMS_AGE_FIELD_DIR . "/includes/fields/age.php" );

}