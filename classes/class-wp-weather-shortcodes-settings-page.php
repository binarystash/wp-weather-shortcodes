<?php

class WP_Weather_Shortcodes_Settings_Page {
	
	function __construct() {
		
		add_action('admin_menu', array( &$this, 'set_up_page' ) );
		add_action('admin_init', array( &$this, 'settings_store') );

	}
	
	function settings_store() {

		register_setting('wp-weather-shortcodes-settings-store', 'wp-weather-shortcodes-api-key');
		
	}
	
	function set_up_page() {
		
		add_submenu_page(
			'options-general.php',
			'WP Weather Shortcodes',
			'WP Weather Shortcodes',
			'manage_options',
			'wp-weather-shortcodes-settings',
			array( &$this, 'display_page' )
		);
	
	}
	
	function display_page() {
		
		include WP_WEATHER_SHORTCODES_DIR . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'wp-weather-shortcodes-options.php';
		
	}
	
}