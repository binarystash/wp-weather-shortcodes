<h2>WP Weather Shortcodes</h2>

<form method="post" action="options.php">
	
	<?php settings_fields('wp-weather-shortcodes-settings-store'); ?>
	
	<table class="form-table">
		<tbody>
			<tr valign="top">
				<th scope="row"><label for="wp-weather-shortcodes-api-key">Openweathermap API key</label></th>
				<td>
					<input class="regular-text" name="wp-weather-shortcodes-api-key" type="text" id="wp-weather-shortcodes-api-key" value="<?php echo get_option('wp-weather-shortcodes-api-key') ?>"/>
				</td>
			</tr>
		</tbody>
		
	</table>
	
	<p>Get a free API key from <a href="http://openweathermap.org/" target="_blank">Openweathermap.org</a></p>
	
	<p class="submit">
		<input type="submit" class="button-primary" value="Save Changes" />
	</p>
</form>