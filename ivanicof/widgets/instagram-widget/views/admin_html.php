<p>
	<label for="<?php echo esc_html($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title', 'ivanicof' ); ?>:</label>
	<input class="widefat" id="<?php echo esc_html($this->get_field_id( 'title' )); ?>" name="<?php echo esc_html($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
	<small class="howto"><?php esc_html_e( 'Note: Leave empty for no title', 'ivanicof' ); ?></small>
</p>


<p>
	<label for="<?php echo esc_html($this->get_field_id( 'username_hashtag' )); ?>"><?php esc_html_e( 'Username or Hashtag', 'ivanicof' ); ?>:</label> 
	<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'username_hashtag' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'username_hashtag' )); ?>" type="text" value="<?php echo esc_attr( $instance['username_hashtag'] ); ?>" />
	<small class="howto"><?php esc_html_e( 'Multiple usernames and hastags are alowed.<br/>Example 1: @natgeo<br/>Example 2: #flowers<br/>Example 3: @natgeo, #flowers, @someother', 'ivanicof' ); ?></small>
</p>


<p>
	<label for="<?php echo esc_html($this->get_field_id( 'photos_number' )); ?>"><?php esc_html_e( 'Number of photos', 'ivanicof' ); ?>:</label><br/>
	<input class="ivanicof-instagram-widget-input-slider" type="range" min="1" step="1" max="12" id="<?php echo esc_html($this->get_field_id( 'photos_number' )); ?>" name="<?php echo esc_html($this->get_field_name( 'photos_number' )); ?>" value="<?php echo absint( $instance['photos_number'] ); ?>">
	<span class="ivanicof-instagram-widget-slider-opt-count"><?php echo absint( $instance['photos_number'] ); ?></span>
</p>


<p>
	<label for="<?php echo esc_html($this->get_field_id( 'columns' )); ?>"><?php esc_html_e( 'Columns', 'ivanicof' ); ?>:</label><br/>
	<select id="<?php echo esc_attr($this->get_field_id( 'columns' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'columns' )); ?>" class="widefat">
		<option value="1" <?php selected( $instance['columns'], 1 );?>> 1 </option>
		<option value="2" <?php selected( $instance['columns'], 2 );?>> 2 </option>
		<option value="3" <?php selected( $instance['columns'], 3 );?>> 3 </option>
		<option value="4" <?php selected( $instance['columns'], 4 );?>> 4 </option>
	</select>
	<small class="howto"><?php esc_html_e( 'Choose in how many columns you would like to display your photos', 'ivanicof' ); ?></small>
</p>


<p>
	<label for="<?php echo esc_html($this->get_field_id( 'photo_space' )); ?>"><?php esc_html_e( 'Photo spacing', 'ivanicof' ); ?>:</label><br/>
	<input class="small-text" type="text" value="<?php echo absint( $instance['photo_space'] ); ?>" id="<?php echo esc_attr($this->get_field_id( 'photo_space' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'photo_space' )); ?>" /> px
	<small class="howto"><?php esc_html_e( 'Specify a spacing between your photos', 'ivanicof' ); ?></small>
</p>

<p>
	<label for="<?php echo esc_html($this->get_field_id( 'photo_max_height' )); ?>"><?php esc_html_e( 'Photo max height', 'ivanicof' ); ?>:</label><br/>
	<input class="small-text" type="text" value="<?php echo absint( $instance['photo_max_height'] ); ?>" id="<?php echo esc_attr($this->get_field_id( 'photo_max_height' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'photo_max_height' )); ?>" /> px
	<small class="howto"><?php esc_html_e( 'Specify a maxim height size in your photos', 'ivanicof' ); ?></small>
</p>


<p>
	<label for="<?php echo esc_html($this->get_field_id( 'container_size' )); ?>"><?php esc_html_e( 'Widget container size', 'ivanicof' ); ?>:</label><br/>
	<input class="small-text widefat" type="text" value="<?php echo absint( $instance['container_size'] ); ?>" id="<?php echo esc_attr($this->get_field_id( 'container_size' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'container_size' )); ?>" /> px
	<small class="howto"><?php esc_html_e( 'If needed, fine tune the size of the entire widget to match your theme\'s sidebar width', 'ivanicof' ); ?></small>
</p>


<p>
	<label for="<?php echo esc_html($this->get_field_id( 'transient_time' )); ?>"><?php esc_html_e( 'Refresh interval', 'ivanicof' ); ?>:</label><br/>
	<select id="<?php echo esc_attr($this->get_field_id( 'transient_time' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'transient_time' )); ?>" class="widefat">
		<option value="<?php echo esc_attr(HOUR_IN_SECONDS); ?>" <?php selected( $instance['transient_time'], HOUR_IN_SECONDS );?>> 1 <?php esc_html_e( 'Hour', 'ivanicof' ); ?> </option>
		<option value="<?php echo esc_attr(6 * HOUR_IN_SECONDS); ?>" <?php selected( $instance['transient_time'], 6 * HOUR_IN_SECONDS );?>> 6 <?php esc_html_e( 'Hours', 'ivanicof' ); ?></option>
		<option value="<?php echo esc_attr(12 * HOUR_IN_SECONDS); ?>" <?php selected( $instance['transient_time'], 12 * HOUR_IN_SECONDS );?>> 12 <?php esc_html_e( 'Hour', 'ivanicof' ); ?> </option>
		<option value="<?php echo esc_attr(DAY_IN_SECONDS); ?>" <?php selected( $instance['transient_time'], DAY_IN_SECONDS );?>> 24 <?php esc_html_e( 'Hours', 'ivanicof' ); ?></option>
	</select>
	<small class="howto"><?php esc_html_e( 'Select a time interval in which the widget checks Instagram for new images', 'ivanicof' ); ?></small>
</p>

<p>
	<label for="<?php echo esc_html($this->get_field_id( 'link_text' )); ?>"><?php esc_html_e( '"Follow" link text', 'ivanicof' ); ?>:</label>
	<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'link_text' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'link_text' )); ?>" type="text" value="<?php echo esc_attr( $instance['link_text'] ); ?>" />
	<small class="howto"><?php esc_html_e( 'Specify a text for your "follow" link, or leave empty if you do not want to display the "follow" link', 'ivanicof' ); ?></small>
</p>