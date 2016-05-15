<?php

class Weather_Shortcodes_Provider {
	
	protected $_min_temp;
	protected $_max_temp;
	protected $_atmospheric_pressure;
	protected $_humidity;
	protected $_wind_speed;
	protected $_day;
	protected $_location;
	protected $_units;
	protected $_current_temp;
	protected $_wind_direction;
	protected $_lat;
	protected $_lon;
	protected $_weather_code;
	
	function __construct( $args ) {
		
		$this->_units = isset( $args['units'] ) ? $args['units'] : "";
		$this->_location = isset( $args['location'] ) ? $args['location'] : "";
		$this->_day = date('Y-m-d');
		
		$this->_validate_attributes();
		
		$this->_get_weather();
	}
	
	protected function _validate_attributes() {
		//Location
		if ( empty( $this->_location ) ) {
			throw new Exception("Location can't be blank");
		}
		
		//Date
		$day_arr = explode("-",$this->_day);
		if ( count( $day_arr ) == 3 ) {
			if ( !checkdate( $day_arr[1], $day_arr[2], $day_arr[0] ) ) {
				throw new Exception("Invalid date");
			}
		}
		else {
			throw new Exception("Invalid date");
		}
		
		//Units
		if ( !empty( $this->_units ) ) {
			if ( !in_array( $this->_units, array('celsius','fahrenheit','') ) ) {
				throw new Exception("Invalid units");
			}
		}
	}
	
	protected function _get_weather() {
		$slug = "weather_shortcodes_" . $this->_location . "&" . $this->_day . "&" . $this->_units;
		
		$transient = get_transient( $slug );
		
		if ( $transient ) {
			$weather_object = $transient;
		}
		else {
			$query_vars = array(
				'q'=>$this->_location,
				'cnt'=>'14',
				'mode'=>'json',
				'units'=>$this->_units == 'celsius' ? 'metric' : '',
				'APPID'=>get_option('wp-weather-shortcodes-api-key')
			);
			
			$api_uri = "http://api.openweathermap.org/data/2.5/forecast/daily?";
			$query = $api_uri . http_build_query($query_vars);
			
			$ch = curl_init($query);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$return = json_decode( curl_exec( $ch ) );
			curl_close($ch);
			
			set_transient( $slug, $return, HOUR_IN_SECONDS );
			
			$weather_object = $return;
		}
		
		$this->_lat = $weather_object->city->coord->lat;
		$this->_lon = $weather_object->city->coord->lon;
		
		foreach( $weather_object->list as $day ) {
			if( date('Y-m-d',$day->dt ) == $this->_day ) {
				$this->_min_temp = $day->temp->min;
				$this->_max_temp = $day->temp->max;
				$this->_atmospheric_pressure = $day->pressure;
				$this->_humidity = $day->humidity;
				$this->_wind_speed = $day->speed;
				$this->_current_temp = $day->temp->day;
				$this->_wind_direction = $day->deg;
				$this->_weather_code = $day->weather[0]->id;
				
				echo "<pre>";
				print_r( $day );
				echo "</pre>";
				
			}
		}
	}
	
	function get_current_temp() { return $this->_current_temp; }
	function get_min_temp() { return $this->_min_temp; }
	function get_max_temp() { return $this->_max_temp; }
	function get_atmospheric_pressure() { return $this->_atmospheric_pressure; }
	function get_humidity() { return $this->_humidity; }
	function get_wind_direction() { return $this->_wind_direction; }
	function get_wind_speed() { return $this->_wind_speed; }
	function get_lat() { return $this->_lat; }
	function get_lon() { return $this->_lon; }
	function get_weather_code() { return $this->_weather_code; }
	
}