<?php

class WP_Weather_Shortcodes_ProviderTest extends PHPUnit_Framework_TestCase {

	protected $_ws_provider;

	function setUp() {

		$this->_ws_provider = new Weather_Shortcodes_Provider( array('tokyo') );

	}

	function test_get_current_temp() {

		$this->assertEquals( 33.19 , $this->_ws_provider->get_current_temp() );

	}
	
	function test_get_min_temp() {

		$this->assertEquals( 27.84 , $this->_ws_provider->get_min_temp() );

	}

}