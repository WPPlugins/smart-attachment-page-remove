<?php

/**
 * The smart Attachment Page Remove Plugin
 *
 * smart Attachment Page Remove allows you to completely remove Attachment Pages from your Blog
 *
 * @wordpress-plugin
 * Plugin Name: smart Attachment Page Remove
 * Plugin URI: http://petersplugins.com/free-wordpress-plugins/smart-attachment-page-remove/
 * Description: Completely remove Attachment Pages from your Blog
 * Version: 1.1
 * Author: Peter Raschendorfer
 * Author URI: http://petersplugins.com
 * Text Domain: smart-attachment-page-remove
 * License: GPL2+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

 
// If this file is called directly, abort
if ( ! defined( 'WPINC' ) ) {
	die;
}


/**
 * Load core plugin class and run the plugin
 */
require_once( plugin_dir_path( __FILE__ ) . '/inc/class-smart-attachment-page-remove.php' );
$pp_smart_attachment_page_remove = new PP_Smart_Attachment_Page_Remove( __FILE__ );

?>