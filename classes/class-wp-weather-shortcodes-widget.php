<?php

class WP_Weather_Shortcodes_Widget extends WP_Widget {

	private $_error = array();

	public function __construct() {
		parent::__construct(
	 		'wp_weather_shortcodes_widget', // Base ID
			'WP Weather Shortcodes Widget' // Name
		);
	}

	public function widget( $args, $instance ) {
		extract( $args );
		
		$atts = array(
			'location'=> $instance['location'],
			'units'=> $instance['units'],
			'date'=>date('Y-m-d')
		);
		
		$weather = new Weather_Shortcodes_Provider($atts);
		
		$attribution = '<div class="wp-weather-shortcodes-attribution">Data provided by <br/> <a href="http://www.openweathermap.org" target="_blank">OpenWeatherMap.org</a></div>';
		
		$attribution = apply_filters("wp_weather_shortcodes_widget_attribution_filter",$attribution);
		
		echo $before_widget;
		include WP_WEATHER_SHORTCODES_DIR . "/includes/wp-weather-shortcodes-box.php";
		echo $after_widget;
	}


	public function form( $instance ) {
		$location = isset( $instance['location'] )  ? $instance['location'] : "New York";
		$units = isset( $instance['units'] )  ? $instance['units'] : "celsius";
		
		include WP_WEATHER_SHORTCODES_DIR . "/includes/wp-weather-shortcodes-form.php";
	}

	public function update( $new_instance, $old_instance ) {
	
		//Validate data
		if ( !isset( $new_instance['location'] ) ) {
			$new_instance['location'] = "New York";
		}
		
		if ( !isset( $new_instance['units'] ) ) {
			$new_instance['units'] = "celsius";
		}
		else {
			if ( !in_array( $new_instance['units'], array( 'celsius', 'fahrenheit' ) ) ) {
				$new_instance['units'] = "celsius";
			}
		}
		
		
		//Prepare new values
		$instance = array();
		$instance['location'] = sanitize_text_field( $new_instance['location'] );
		$instance['units'] = sanitize_text_field( $new_instance['units'] );
		
		return $instance;
	}
}