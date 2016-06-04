[![Build Status](https://travis-ci.org/binarystash/wp-weather-shortcodes.svg?branch=master)](https://travis-ci.org/binarystash/wp-weather-shortcodes)

# Wordpress weather shortcodes
WP Weather Shortcodes provides shortcodes for displaying current weather data on your Wordpress blog. Each can be customized according to location.

## Installation

1. Upload the plugin folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Input OpenWeather API key under Dashboard->Settings->WP Weather Shortcodes. Wrong data may be displayed if you skip this step.
4. Use the provided shortcodes. See usage for details.
5. Alternatively, you can use the widget on Appearance->Widgets.

## Usage

Place the shortcode in the WYSIWYG editor or a text widget. Refer to the following examples.

##### Current temperature
`[ws_current_temp location="new york"] `

##### Minimum temperature
`[ws_min_temp location="new york"]`

##### Maximum temperature
`[ws_max_temp location="new york"]`

##### Atmospheric pressure
`[ws_atmospheric_pressure location="new york"]`

##### Humidity
`[ws_humidity location="new york"]`

##### Wind speed
`[ws_wind_speed location="new york"]`

##### Current temperature in celsius or fahrenheit
`[ws_current_temp location="new york" units="celsius"]`

`[ws_current_temp location="new york" units="fahrenheit"]`

##### Weather icon

`[ws_icon location="beijing"]`

## Using alternative provider

If a different weather data provider needs to be used, add the `wp_weather_shortcodes_provider_day_filter` filter. See example below.

```php
<?php
function my_own_weather_provider($day) {
	/* Modify $day */
	return $day;
}
add_filter("wp_weather_shortcodes_provider_day_filter", "my_own_weather_provider");
```

## Modifying attribution

OpenWeatherMap.org is the default weather data provider. Using their free service requires attribution. Hence, the first instance of the shortcode and the weather widget have links to their website. If a different provider is used, you may remove them using the following filters.

```php
<?php
function my_own_shortcode_attribution($text, $value) {
	return $value;
}
add_filter("wp_weather_shortcodes_shortcode_attribution_filter", "my_own_shortcode_attribution", 10, 2);

function my_own_widget_attribution($text) {
	$text = "";
	return $text;
}
add_filter("wp_weather_shortcodes_widget_attribution_filter", "my_own_widget_attribution");
```

## Compatibility

Tested on Wordpress 3.5 to 3.8.1

## Support

Report bugs at https://github.com/binarystash/wp-weather-shortcodes/issues.
 
