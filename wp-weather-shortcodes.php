<?php
/**
 * Plugin Name: WP Weather Shortcodes
 * Plugin URI: http://binarystash.blogspot.com/2013/11/wp-booklet.html
 * Description: Add weather shortcodes to your blog
 * Version: 1.0
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
			'date'=> $instance['date'],
			'units'=> $instance['units']
		);
		
		$weather = new Weather_Day($atts);
		
		echo $before_widget;
		include WP_WEATHER_SHORTCODES_DIR . "/includes/wp-weather-shortcodes-box.php";
		echo $after_widget;
	}


	public function form( $instance ) {
		$location = isset( $instance['location'] )  ? $instance['location'] : "New York";
		$units = isset( $instance['units'] )  ? $instance['units'] : "celsius";
		$date = isset( $instance['date'] )  ? $instance['date'] : date('Y-m-d');
		
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
		
		if ( !isset( $new_instance['date'] ) ) {
			$new_instance['date'] = date('Y-m-d');
		}
		else {
			$date_arr = explode( "-" , $new_instance['date']);
			if ( isset( $date_arr[0] ) && isset( $date_arr[1] ) && isset( $date_arr[2] ) ) {
				if ( !checkdate( $date_arr[1], $date_arr[2], $date_arr[0] ) ) {
					$new_instance['date'] = date('Y-m-d');
				}
			} 
			else {
				$new_instance['date'] = date('Y-m-d');
			}
		}
		
		//Prepare new values
		$instance = array();
		$instance['location'] = sanitize_text_field( $new_instance['location'] );
		$instance['units'] = sanitize_text_field( $new_instance['units'] );
		$instance['date'] = sanitize_text_field( $new_instance['date'] );
		
		return $instance;
	}
}

class Weather_Shortcodes_Controller {

	private $_attribution_displayed;

	public function __construct() {
		//Make attribution display once
		$this->_attribution_displayed = false;
	
		//Shortcodes
		add_shortcode( 'ws_current_temp', array(&$this,'get_current_temp') );
		add_shortcode( 'ws_min_temp', array(&$this,'get_min_temp') );
		add_shortcode( 'ws_max_temp', array(&$this,'get_max_temp') );
		add_shortcode( 'ws_atmospheric_pressure', array(&$this,'get_atmospheric_pressure') );
		add_shortcode( 'ws_humidity', array(&$this,'get_humidity') );
		add_shortcode( 'ws_wind_speed', array(&$this,'get_wind_speed') );
		
		add_filter('widget_text', 'do_shortcode');
		
		//Widget
		add_action( 'widgets_init', array(&$this, 'register_widgets'));
		
		//Enqueue scripts
		add_action( 'wp_enqueue_scripts', array(&$this, 'frontend_scripts') );
		add_action( 'admin_enqueue_scripts', array(&$this, 'admin_scripts') );
		
	}
	
	private function add_attribution($output) {
		if ( !$this->_attribution_displayed ) {
			$output = "<a title='Data from OpenWeatherMap.org' href='http://www.openweathermap.org' target='_blank'>" . $output . "</a>";
			$this->_attribution_displayed = true;
		}
		return $output;
	}
	
	public function frontend_scripts() {
		wp_enqueue_style('wp-weather-shortcodes-widget', WP_WEATHER_SHORTCODES_URL . '/css/widget/widget.css');
	}
	
	public function admin_scripts() {
		wp_enqueue_style('wp-weather-shortcodes-admin', WP_WEATHER_SHORTCODES_URL . '/css/admin/admin.css');
	}
	
	public function register_widgets() {
		register_widget( 'WP_Weather_Shortcodes_Widget' );
	}

	public function get_current_temp($atts) {
		try {
			if ( !isset( $atts['units'] ) ) {
				$atts['units'] = 'celsius';
			}
		
			$this->weather = new Weather_Day($atts);

			switch( $atts['units'] ) {
				case "celsius": $units = "C"; break;
				case "fahrenheit": $units = "F"; break;
				default: $units = "F"; break;
			}
			
			return $this->add_attribution( $this->weather->get_current_temp() . "&deg " . $units );
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
		
			$this->weather = new Weather_Day($atts);

			switch( $atts['units'] ) {
				case "celsius": $units = "C"; break;
				case "fahrenheit": $units = "F"; break;
				default: $units = "F"; break;
			}
			
			return $this->add_attribution( $this->weather->get_min_temp() . "&deg " . $units );
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
		
			$this->weather = new Weather_Day($atts);

			switch( $atts['units'] ) {
				case "celsius": $units = "C"; break;
				case "fahrenheit": $units = "F"; break;
				default: $units = "F"; break;
			}
			
			return $this->add_attribution( $this->weather->get_max_temp() . "&deg " . $units );
		}
		catch( Exception $e ) {
			return $e->getMessage();
		}
		
	}
	
	public function get_atmospheric_pressure($atts) {
		try {
			$this->weather = new Weather_Day($atts);
			return $this->add_attribution( $this->weather->get_atmospheric_pressure() . 'hPa' );
		}
		catch( Exception $e ) {
			return $e->getMessage();
		}
		
	}
	
	public function get_humidity($atts) {
		try {
			$this->weather = new Weather_Day($atts);
			return $this->add_attribution( $this->weather->get_humidity() . '%' );
		}
		catch( Exception $e ) {
			return $e->getMessage();
		}
		
	}
	
	public function get_wind_speed($atts) {
		try {
			$this->weather = new Weather_Day($atts);
			return $this->add_attribution( $this->weather->get_wind_speed() . 'mps ' . $this->weather->get_wind_direction() . '&deg;' );
		}
		catch( Exception $e ) {
			return $e->getMessage();
		}
		
	}
	
} 
/*
input:
object = {
	location
	units [celsius,fahrenheit] (optional)
	day [yyyy-mm-dd] (optional)
}

output:
object = {
	min_temp
	max_temp
	atmospheric_pressure
	humidity
	wind_speed
	wind_direction
	day
	location
} 
 */
class Weather_Day {
	
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
	
	function __construct( $args ) {
		
		$this->_units = isset( $args['units'] ) ? $args['units'] : "";
		$this->_location = isset( $args['location'] ) ? $args['location'] : "";
		$this->_day = isset( $args['day'] ) ? $args['day'] : date("Y-m-d");
		
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
				'units'=>$this->_units == 'celsius' ? 'metric' : ''
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
	
}
 
function weather_shortcodes_instantiate() {
	new Weather_Shortcodes_Controller();
}
add_action( 'plugins_loaded', 'weather_shortcodes_instantiate', 15 );