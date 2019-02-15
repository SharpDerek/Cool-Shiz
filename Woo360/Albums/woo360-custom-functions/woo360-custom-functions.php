<?php
/*
Plugin Name: Woo360 Custom Functions
Plugin URI: http://www.madwire.com/
Description: Custom proprietary functions for Woo360 sites. Does not update with the theme. Developers can simply edit this plugin's files like a functions.php file and changes should appear on the site.
Version: 0.1
Author: Madwire
Author URI: http://www.madwire.com/
*/

require_once(plugin_dir_path(__FILE__).'/inc/posttypes.php');

define( 'WOO360_ALBUM_DIR', plugin_dir_path( __FILE__ ) );
define( 'WOO360_ALBUM_URL', plugins_url( '/', __FILE__ ) );

require_once WOO360_ALBUM_DIR . 'classes/woo360-album-module.php';