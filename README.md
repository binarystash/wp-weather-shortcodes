# Wordpress weather shortcodes
WP Weather Shortcodes provides shortcodes for displaying current weather data on your Wordpress blog. Each can be customized according to location.

## Installation

1. Upload the plugin folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Use the provided shortcodes. See usage for details.
4. Alternatively, you can use the widget on Appearance->Widgets.

## Usage

Place the shortcode in the content or a text widget. Refer to the following examples.

### Current temperature
`[ws_current_temp location="new york"] `

### Minimum temperature
`[ws_min_temp location="new york"]`

### Maximum temperature
`[ws_max_temp location="new york"]`

### Atmospheric pressure
`[ws_atmospheric_pressure location="new york"]`

### Humidity
`[ws_humidity location="new york"]`

### Wind speed
`[ws_wind_speed location="new york"]`

### Current temperature in celsius or fahrenheit
`[ws_current_temp location="new york" units="celsius"]`

`[ws_current_temp location="new york" units="fahrenheit"]`

## Compatibility

Tested on Wordpress 3.5 to 3.8.1

## What is OpenWeatherMap.org?

OpenWeatherMap.org is the weather data provider. Using their free service requires attribution. Hence, the first instance of the shortcode and the weather widget have links to their website. The links were placed as subtly as possible. 
