<?php

class WP_Weather_Shortcodes_Shortcode_Manager {
	
	private $_attribution_displayed;
	
	function __construct() {
		
		//Attach attribution to the first shortcode instance
		$this->_attribution_displayed = false;
		
		// Make shortcodes work in text widgets
		add_filter('widget_text', 'do_shortcode');
		
	}
	
	private function _add_attribution($value) {
		if ( !$this->_attribution_displayed ) {
			$output = "<a title='Data from OpenWeatherMap.org' href='http://www.openweathermap.org' target='_blank'>" . $value . "</a>";
			$this->_attribution_displayed = true;
		}
		else {
			$output = $value;
		}
		
		$output = apply_filters("wp_weather_shortcodes_shortcode_attribution_filter", $output, $value);
		
		return $output;
	}
	
	function enable() {
		
		add_shortcode( 'ws_current_temp', array(&$this,'get_current_temp') );
		add_shortcode( 'ws_min_temp', array(&$this,'get_min_temp') );
		add_shortcode( 'ws_max_temp', array(&$this,'get_max_temp') );
		add_shortcode( 'ws_atmospheric_pressure', array(&$this,'get_atmospheric_pressure') );
		add_shortcode( 'ws_humidity', array(&$this,'get_humidity') );
		add_shortcode( 'ws_wind_speed', array(&$this,'get_wind_speed') );
		add_shortcode( 'ws_icon', array(&$this, 'get_icon') );
		
	}
	
	public function get_icon($atts) {
		try {
			$this->weather = new Weather_Shortcodes_Provider($atts);
			
			$html = "<span class='owf owf-" . $this->weather->get_weather_code() . "'></span>";
			
			return $this->_add_attribution( $html );
		}
		catch( Exception $e ) {
			return $e->getMessage();
		}
		
	}
	
	public function get_current_temp($atts) {
		try {
			if ( !isset( $atts['units'] ) ) {
				$atts['units'] = 'celsius';
			}
		
			$this->weather = new Weather_Shortcodes_Provider($atts);

			switch( $atts['units'] ) {
				case "celsius": $units = "C"; break;
				case "fahrenheit": $units = "F"; break;
				default: $units = "F"; break;
			}
			
			return $this->_add_attribution( $this->weather->get_current_temp() . "&deg " . $units );
		}
		catch( Exception $e ) {
			return $e->getMessage();
		}
		
	}
	
	public function get_min_temp($atts) {
		try {
			if ( !isset( $atts['units'] ) ) {
				$atts['units'] = 'celsius';
			}
		
			$this->weather = new Weather_Shortcodes_Provider($atts);

			switch( $atts['units'] ) {
				case "celsius": $units = "C"; break;
				case "fahrenheit": $units = "F"; break;
				default: $units = "F"; break;
			}
			
			return $this->_add_attribution( $this->weather->get_min_temp() . "&deg " . $units );
		}
		catch( Exception $e ) {
			return $e->getMessage();
		}
		
	}
	
	public function get_max_temp($atts) {
		try {
			if ( !isset( $atts['units'] ) ) {
				$atts['units'] = 'celsius';
			}
		
			$this->weather = new Weather_Shortcodes_Provider($atts);

			switch( $atts['units'] ) {
				case "celsius": $units = "C"; break;
				case "fahrenheit": $units = "F"; break;
				default: $units = "F"; break;
			}
			
			return $this->_add_attribution( $this->weather->get_max_temp() . "&deg " . $units );
		}
		catch( Exception $e ) {
			return $e->getMessage();
		}
		
	}
	
	public function get_atmospheric_pressure($atts) {
		try {
			$this->weather = new Weather_Shortcodes_Provider($atts);
			return $this->_add_attribution( $this->weather->get_atmospheric_pressure() . 'hPa' );
		}
		catch( Exception $e ) {
			return $e->getMessage();
		}
		
	}
	
	public function get_humidity($atts) {
		try {
			$this->weather = new Weather_Shortcodes_Provider($atts);
			return $this->_add_attribution( $this->weather->get_humidity() . '%' );
		}
		catch( Exception $e ) {
			return $e->getMessage();
		}
		
	}
	
	public function get_wind_speed($atts) {
		try {
			$this->weather = new Weather_Shortcodes_Provider($atts);
			return $this->_add_attribution( $this->weather->get_wind_speed() . 'mps ' . $this->weather->get_wind_direction() . '&deg;' );
		}
		catch( Exception $e ) {
			return $e->getMessage();
		}
		
	}
	
}