<div class="wp-weather-shortcodes-widget">
	<div class="wp-weather-shortcodes-location"><?php echo $atts['location'] ?></div>
	<div class="wp-weather-shortcodes-date"><?php echo $atts['date'] ?></div>
	<div class="wp-weather-shortcodes-temp"><?php echo $weather->get_current_temp() ?>&deg; <span class="units"><?php echo $instance['units'] == "celsius" ? "C" : "F" ?></span></div>
	<div class="wp-weather-shortcodes-atmpressure detail"><span class="label">Atm. pressure:</span> <?php echo $weather->get_atmospheric_pressure(); ?><span class="units">hPa</span></div>
	<div class="wp-weather-shortcodes-humidity detail"><span class="label">Humidity:</span> <?php echo $weather->get_humidity() ?><span class="units">%</span></div>
	<div class="wp-weather-shortcodes-windspeed detail"><span class="label">Wind:</span> <?php echo $weather->get_wind_speed() ?><span class="units">mps</span> <?php echo $weather->get_wind_direction() ?>&deg;</div>
	<div class="wp-weather-shortcodes-weathermap"><a target="_blank" href="http://openweathermap.org/Maps?zoom=10&lat=<?php echo $weather->get_lat() ?>&lon=<?php echo $weather->get_lon() ?>&layers=B0TTTTTT">View map</a>
	<div class="wp-weather-shortcodes-attribution">Data provided by <br/> <a href="http://www.openweathermap.org" target="_blank">OpenWeatherMap.org</a></div>
</div>