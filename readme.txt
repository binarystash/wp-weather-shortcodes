=== WP Weather Shortcodes ===
Contributors: binarystash01
Donate link: http://binarystash.blogspot.com/
Tags: weather, weather widget, weather shortcode
Requires at least: 3.5
Tested up to: 3.8
Stable tag: 1.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Add weather shortcodes to your blog

== Description ==

WP Weather Shortcodes provides shortcodes for displaying the following weather data. Each can be customized according to location and date. See the FAQ for details.

* Current temperature
* Minimum temperature
* Maximum temperature
* Atmospheric pressure
* Humidity
* Wind speed

A simple generic weather widget which may be enabled via Appearance->Widgets is also included.

== Installation ==

This section describes how to install the plugin and get it working.

1. Upload the plugin folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Use the provided shortcodes. See the FAQ for details.
4. Alternatively, you can use the widget on Appearance->Widgets.

== Frequently Asked Questions ==

= What shortcodes can I use? =

* [ws_current_temp location="new york"] 
* [ws_min_temp location="manila"]
* [ws_max_temp location="manila"]
* [ws_atmospheric_pressure location="manila"]
* [ws_humidity location="manila"]
* [ws_wind_speed location="manila"]

= What other options are supported? =

Besides **location**, **units** is also available.

* [ws_current_temp location="new york" units="celsius"] - You can use either "celsius" or "fahrenheit".

= What is OpenWeatherMap.org? =

OpenWeatherMap.org is the weather data provider. Using their free service requires attribution. Hence, the first instance of the shortcode and the weather widget have links to their website. The links were placed as subtly as possible. 

== Changelog ==

= 1.0 =
* Stable version

= 1.1 =
* Removed ability to specify date; now defaults to current day