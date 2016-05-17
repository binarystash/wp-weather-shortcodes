<?php

class WP_Weather_Shortcodes_ProviderTest extends PHPUnit_Framework_TestCase {

	protected $_ws_provider;

	function setUp() {

		$this->_ws_provider = new Weather_Shortcodes_Provider( array('location'=>'tokyo') );

	}

	function test_get_current_temp() {

		$this->assertEquals( 25.04 , $this->_ws_provider->get_current_temp() );

	}
	
	function test_get_min_temp() {

		$this->assertEquals( 21.72 , $this->_ws_provider->get_min_temp() );

	}
	
	function test_get_max_temp() {

		$this->assertEquals( 25.04 , $this->_ws_provider->get_max_temp() );

	}
	
	function test_get_atmospheric_pressure() {

		$this->assertEquals( 972.39 , $this->_ws_provider->get_atmospheric_pressure() );

	}
	
	
	function test_get_humidity() {

		$this->assertEquals( 85 , $this->_ws_provider->get_humidity() );

	}
	//start here
	function test_get_wind_direction() {

		$this->assertEquals( 115 , $this->_ws_provider->get_wind_direction() );

	}
	
	function test_get_wind_speed() {

		$this->assertEquals( 1.06 , $this->_ws_provider->get_wind_speed() );

	}
	
	function test_get_lat() {

		$this->assertEquals( 6.81304 , $this->_ws_provider->get_lat() );

	}
	
	function test_get_lon() {

		$this->assertEquals( 125.708481 , $this->_ws_provider->get_lon() );

	}
	
	function test_weather_code() {

		$this->assertEquals( 501 , $this->_ws_provider->get_weather_code() );

	}
	
}