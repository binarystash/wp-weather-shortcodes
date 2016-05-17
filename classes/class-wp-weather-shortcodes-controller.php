<?php

class Weather_Shortcodes_Controller {

	public function __construct() {
		
		//Initialize widget
		add_action( 'widgets_init', array(&$this, 'register_widgets'));
		
		//Initialize shortcodes
		$shortcode_manager = new WP_Weather_Shortcodes_Shortcode_Manager();
		$shortcode_manager->enable();
		
		//Initialize settings page
		new WP_Weather_Shortcodes_Settings_Page();
		
		//Enqueue assets
		add_action( 'wp_enqueue_scripts', array(&$this, 'frontend_scripts') );
		add_action( 'admin_enqueue_scripts', array(&$this, 'admin_scripts') );
		
	}
	
	public function frontend_scripts() {
		
		wp_register_style('wp-weather-shortcodes-widget', WP_WEATHER_SHORTCODES_URL . '/assets/frontend/css/widget.css');
		wp_enqueue_style('wp-weather-shortcodes-widget');
		
		wp_register_style('wp-weather-shortcodes-owfont', WP_WEATHER_SHORTCODES_URL . '/assets/frontend/css/owfont-regular.min.css');
		wp_enqueue_style('wp-weather-shortcodes-owfont');
		
	}
	
	public function admin_scripts() {
		
		wp_register_style('wp-weather-shortcodes-admin', WP_WEATHER_SHORTCODES_URL . '/assets/admin/admin.css');
		wp_enqueue_style('wp-weather-shortcodes-admin');
		
	}
	
	public function register_widgets() {
		
		register_widget( 'WP_Weather_Shortcodes_Widget' );
		
	}

} 