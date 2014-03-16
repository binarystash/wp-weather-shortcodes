<div class="wp-weather-shortcodes-widget-form">
<p>
<label for="<?php echo $this->get_field_name( 'location' ); ?>"><?php _e( 'Location' ); ?> <span class="tip">(e.g. los angeles, london, tokyo)</span></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'location' ); ?>" name="<?php echo $this->get_field_name( 'location' ); ?>" type="text" value="<?php echo esc_attr( $location ) ? esc_attr( $location ) : "New York"; ?> " />
</p>

<p>
<label for="<?php echo $this->get_field_name( 'units' ); ?>"><?php _e( 'Units' ); ?></label> 
<select class="widefat" name="<?php echo $this->get_field_name('units') ?>">
	<option value="celsius" <?php echo ($units=='celsius') ? "selected='selected'" : "" ?>>Celsius</option>
	<option value="fahrenheit" <?php echo ($units=='fahrenheit') ? "selected='selected'" : "" ?>>Fahrenheit</option>
</select>
</p>

<p>
<label for="<?php echo $this->get_field_name( 'date' ); ?>"><?php _e( 'Date' ); ?> <span class="tip">(e.g. <?php echo date('Y-m-d') ?>)</span></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'date' ); ?>" name="<?php echo $this->get_field_name( 'date' ); ?>" type="text" value="<?php echo esc_attr( $date ); ?>" />
</p>

</div>