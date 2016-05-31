<?php
/**
 * Plugin Name: WP Weather Shortcodes
 * Plugin URI: http://binarystash.blogspot.com/2013/11/wp-booklet.html
 * Description: Add weather shortcodes to your blog
 * Version: 1.2.2
 * Author: BinaryStash
 * Author URI:  binarystash.blogspot.com
 * License: GPLv2 (http://www.gnu.org/licenses/gpl-2.0.html)
 */
 
if(!defined('WP_WEATHER_SHORTCODES_DIR')){
	define('WP_WEATHER_SHORTCODES_DIR', realpath(plugin_dir_path(__FILE__)) . DIRECTORY_SEPARATOR );
} 

if(!defined('WP_WEATHER_SHORTCODES_URL')){
	define('WP_WEATHER_SHORTCODES_URL', plugin_dir_url(__FILE__) );
}

/*
 * Include classes
 */
 
$wp_weather_shortcodes_classes = array(
	'class-wp-weather-shortcodes-provider.php',
	'class-wp-weather-shortcodes-widget.php',
	'class-wp-weather-shortcodes-controller.php',
	'class-wp-weather-shortcodes-shortcode-manager.php',
	'class-wp-weather-shortcodes-settings-page.php'
); 
 
foreach( $wp_weather_shortcodes_classes as $class ) {
	
	include WP_WEATHER_SHORTCODES_DIR . 'classes' . DIRECTORY_SEPARATOR . $class;
	
}

/*
 * Initialize plugin
 */

function weather_shortcodes_instantiate() {
	new Weather_Shortcodes_Controller();
}
add_action( 'plugins_loaded', 'weather_shortcodes_instantiate', 15 );
