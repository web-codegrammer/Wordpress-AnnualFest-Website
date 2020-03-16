<?php

class ivanicof_Instagram_Widget extends WP_Widget {

	/**
	 * Unique identifier for your widget.
	 *
	 * @since    1.0.0
	 * @var      string
	 */
	protected $widget_slug = 'ivanicof_instagram';

	/**
	 * Default value holder
	 *
	 * @since    1.0.0
	 * @var      array
	 */
	protected $defaults;

	/**
	 * Specifies the classname and description, instantiates the widget and includes necessary stylesheets and JavaScript.
	 */
	public function __construct() {

		parent::__construct(
			$this->widget_slug,
			esc_html__( 'Ivanicof Instagram Widget', 'ivanicof' ),
			array(
				'description' => esc_html__( 'Easily display Instagram photos with this widget.', 'ivanicof' )
			)
		);

		$this->defaults = array(
			'title' => 'Instagram',
			'username_hashtag' => '',
			'photos_number' => 9,
			'columns' => 3,
			'photo_space' => 1,
			'photo_max_height' => 120,
			'container_size' => 500,
			'transient_time' => DAY_IN_SECONDS,
			'link_text' => esc_html__( 'Follow', 'ivanicof' ),
		);

		// Allow themes or plugins to modify default parameters
		$this->defaults = apply_filters( 'ivanicof_instagram_widget_modify_defaults', $this->defaults );


		// Register site styles and scripts
		add_action( 'wp_enqueue_scripts', array( $this, 'register_widget_styles' ) );

		// Register admin styles and scripts
		add_action( 'admin_enqueue_scripts', array( $this, 'register_admin_script' ) );

	}


	/**
	 * Outputs the content of the widget.
	 *
	 * @param array   args  The array of form elements
	 * @param array   instance The current instance of the widget
	 */
	public function widget( $args, $instance ) {

		extract( $args, EXTR_SKIP );
		$instance = wp_parse_args( (array) $instance, $this->defaults );

		$title = apply_filters( 'widget_title', $instance['title'] );

		echo wp_kses_post($before_widget);

		if ( ! empty( $title ) ) {
			echo wp_kses_post($before_title) . esc_html($title) . wp_kses_post($after_title);
		}

		$photos = $this->get_photos( $instance['username_hashtag'], $instance['transient_time'] );

		if ( is_wp_error( $photos ) ) {
			echo esc_html($photos->get_error_message());
			echo wp_kses_post($after_widget);
			return;
		}

		$photos = $this->limit_images_number( $photos, $instance['photos_number'] );
		$size = $this->calculate_image_size( $instance['container_size'], $instance['photo_space'], $instance['columns'] );

		$follow_link = $this->get_follow_link( $instance['username_hashtag'] );

		ob_start();
		include $this->get_template( ivanicof_INSTAGRAM_WIDGET_DIR .'views/widget_html' );
		$widget_content = ob_get_clean();
		
		echo $widget_content;
		echo wp_kses_post($after_widget);

	}


	/**
	 * Processes the widget's options to be saved.
	 *
	 * @param array   new_instance The new instance of values to be generated via the update.
	 * @param array   old_instance The previous instance of values before the update.
	 */
	public function update( $new_instance, $old_instance ) {

		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['username_hashtag'] = strip_tags( $new_instance['username_hashtag'] );
		$instance['photos_number'] = absint( $new_instance['photos_number'] );
		$instance['columns'] = absint( $new_instance['columns'] );
		$instance['photo_space'] = absint( $new_instance['photo_space'] );
		$instance['photo_max_height'] = absint( $new_instance['photo_max_height'] );
		$instance['container_size'] = absint( $new_instance['container_size'] );
		$instance['transient_time'] = absint( $new_instance['transient_time'] );
		$instance['link_text'] = strip_tags( $new_instance['link_text'] );

		return $instance;

	}

	/**
	 * Generates the administration form for the widget.
	 *
	 * @param array   instance The array of keys and values for the widget.
	 */
	public function form( $instance ) {

		$instance = wp_parse_args( (array) $instance, $this->defaults );

		include ivanicof_INSTAGRAM_WIDGET_DIR . 'views/admin_html.php';

	}

	/**
	 * Get predefined template which can be overridden by child themes
	 *
	 * @since 1.0.0
	 *
	 * @param string  $template
	 * @return string      - File Path
	 */
	private function get_template( $template ) {
		
		$template_slug = rtrim( $template, '.php' );
		$template = $template_slug . '.php';

		if ( $theme_file = locate_template( array( '/core/widgets/'.$template ) ) ) :
			$file = $theme_file;
		else :
			$file = $template;
		endif;

		return $file;
	}

	/**
	 * Get photos form Instagram base on username or hashtag with transient caching for one day
	 *
	 * @since 1.0.0
	 *
	 * @param string  $username_or_hashtag Searched username or hashtag
	 * @param int  $transient_time Time in seconds
	 * @return array  List of all photos sizes with additional information
	 */
	protected function get_photos( $usernames_or_hashtags, $transient_time ) {

		if ( empty( $usernames_or_hashtags ) ) {
			return false;
		}

		$transient_key = $this->generate_transient_key( $usernames_or_hashtags );

		$cached = get_transient( $transient_key );

		if ( !empty( $cached ) ) {
			return $cached;
		}

		$usernames_or_hashtags = explode( ',', $usernames_or_hashtags );

		$images = array();

		foreach ( $usernames_or_hashtags as  $username_or_hashtag ) {

			$username_or_hashtag = trim( $username_or_hashtag );

			$url = $this->get_instagram_url( $username_or_hashtag );
			$data = $this->get_instagram_data( $url );

			if ( is_wp_error( $data )) {
				return $data;
			}

			$images[] = $data;
		}

		$images =  array_reduce( $images, 'array_merge', array() );

		usort( $images, function ( $a, $b ) {
				if ( $a['time'] == $b['time'] ) return 0;
				return ( $a['time'] < $b['time'] ) ? 1 : -1;
			} );

		set_transient( $transient_key, $images, $transient_time );

		return $images;
	}



	function generate_transient_key( $usernames_or_hashtags ) {

		$id = $this->id . $usernames_or_hashtags;

		$transient_key = md5( 'ivanicof_instagram_widget_' . $id );

		return $transient_key;

	}


	/**
	 * Function to return endpoint URL or simple URL for follow link
	 *
	 * @since 1.0.0
	 *
	 * @param string  $searched_term
	 * @return string    - URL
	 */
	protected function get_instagram_url( $searched_term ) {

		$searched_term = trim( strtolower( $searched_term ) );

		switch ( substr( $searched_term, 0, 1 ) ) {
		case '#':
			return $url = 'https://instagram.com/explore/tags/' . str_replace( '#', '', $searched_term );
			break;

		default:
			return $url = 'https://instagram.com/' . str_replace( '@', '', $searched_term );
			break;
		}
	}


	/**
	 * Make remote request base on Instagram endpoints, get JSON and collect all images.
	 *
	 * @since 1.0.0
	 *
	 * @param string  $url - Instagram URL API endpoint
	 * @return array        - List of collected images
	 */
	protected function get_instagram_data( $url ) {

		$request = wp_remote_get( $url );

		if ( is_wp_error( $request ) || empty( $request ) ) {
			return new WP_Error( 'invalid_response', esc_html__( 'Unable to communicate with Instagram.', 'ivanicof' ) );
		}

		$body = wp_remote_retrieve_body( $request );

		$shared      = explode( 'window._sharedData = ', $body );
		$json  = explode( ';</script>', $shared[1] );
		$data = json_decode( $json[0], true );

		if ( empty( $data ) ) {
			return new WP_Error( 'bad_json', esc_html__( 'Instagram has returned empty data. Please check your username/hashtag.',  'ivanicof' ) );
		}

		if ( isset( $data['entry_data']['ProfilePage'][0]['graphql']['user']['edge_owner_to_timeline_media']['edges'] ) ) {
			$images = $data['entry_data']['ProfilePage'][0]['graphql']['user']['edge_owner_to_timeline_media']['edges'];
		} elseif ( isset( $data['entry_data']['TagPage'][0]['graphql']['hashtag']['edge_hashtag_to_media']['edges'] ) ) {
			$images = $data['entry_data']['TagPage'][0]['graphql']['hashtag']['edge_hashtag_to_media']['edges'];
		} else {
			return new WP_Error( 'bad_json_2', esc_html__( 'Instagram has returned invalid data.',  'ivanicof' ) );
		}

		$images = $this->parse_instagram_images( $images );

		if ( empty( $images ) ) {
			return new WP_Error( 'no_images', esc_html__( 'Images not found. This may be a temporary problem. Please try again soon.', 'ivanicof' ) );
		}

		return $images;

	}


	/**
	 * Parse instagram images
	 *
	 * @since  1.0.1
	 *
	 * @param array   $images - Raw Images
	 * @return array           - List of images prepared for displaying
	 */
	protected function parse_instagram_images( $images ) {

		$pretty_images = array();

		foreach ( $images as $image ) {
			
			$pretty_images[] = array(
				'caption'    => isset( $image['node']['edge_media_to_caption']['edges'][0]['node']['text'] ) ? $image['node']['edge_media_to_caption']['edges'][0]['node']['text'] : '',
				'link'       => trailingslashit( 'https://instagram.com/p/' . $image['node']['shortcode'] ),
				'time'     	 => $image['node']['taken_at_timestamp'],
				'comments'   => $image['node']['edge_media_to_comment']['count'],
				'likes'   	 => $image['node']['edge_liked_by']['count'],
				'thumbnail'   => preg_replace( '/^https?\:/i', '', $image['node']['thumbnail_resources'][0]['src'] ), //150
				'small'       => preg_replace( '/^https?\:/i', '', $image['node']['thumbnail_resources'][1]['src'] ), //240
				'medium'       => preg_replace( '/^https?\:/i', '', $image['node']['thumbnail_resources'][2]['src'] ), //320
				'large'       => preg_replace( '/^https?\:/i', '', $image['node']['thumbnail_resources'][3]['src'] ), //480
				'original'    => preg_replace( '/^https?\:/i', '', $image['node']['display_url'] ),
			);

		}

		return $pretty_images;
	}


	/**
	 * Limit number of displayed images on front-end
	 *
	 * @since  1.0.0
	 *
	 * @param array   $photos - Lists of images
	 * @param number  $limit  - Max number of image that we want to show
	 * @return array             - Limited List
	 */
	protected function limit_images_number( $photos, $limit = 1 ) {
		if ( empty( $photos ) || is_wp_error( $photos ) ) {
			return array();
		}
		return array_slice( $photos, 0, $limit );
	}

	/**
	 * Calculate which images size  to use base on container width and photo space and calculate images columns
	 *
	 * @since  1.0.0
	 *
	 * @param int     $container_size
	 * @param int     $photo_space
	 * @param int     $columns
	 * @return array              - Proper image size and flex column calculation
	 */
	public function calculate_image_size( $container_size, $photo_space, $columns ) {

		$width = ( $container_size - ( $photo_space * ( $columns - 1 ) ) ) / $columns;
		$flex = 100 / $columns;

		$size = array();
		$size['flex'] = $flex;

		switch ( $width ) {

		case $width <= 150 :
			$size['thumbnail'] = 'thumbnail';
			break;

		case $width <= 240 :
			$size['thumbnail'] = 'small';
			break;

		case $width <= 320 :
			$size['thumbnail'] = 'medium';
			break;

		case $width <= 480 :
			$size['thumbnail'] = 'large';
			break;

		default:
			$size['thumbnail'] = 'original';
			break;
		}

		return $size;

	}

	/**
	 * Check if is one username or hashtag.
	 *
	 * @since 1.0.0
	 *
	 * @param string  $usernames_or_hashtags String from username or hashtag input field
	 * @return string    Follow URL or empty string
	 */
	protected function get_follow_link( $usernames_or_hashtags ) {

		$usernames_hashtags_array = explode( ',', $usernames_or_hashtags );
		$number_of_username_hashtag = count( $usernames_hashtags_array );

		if ( $number_of_username_hashtag !== 1 ) return '';

		return  $this->get_instagram_url( $usernames_or_hashtags );
	}


	/**
	 * Registers and enqueues widget-specific styles.
	 */
	public function register_widget_styles() {
		wp_enqueue_style( $this->widget_slug.'-widget-styles', ivanicof_INSTAGRAM_WIDGET_URL . 'css/widget.css' );
	}

	/**
	 * Registers and enqueues admin specific scripts.
	 */
	public function register_admin_script() {
		wp_enqueue_script( $this->widget_slug.'-admin-script', ivanicof_INSTAGRAM_WIDGET_URL . 'js/admin.js', true, ivanicof_INSTAGRAM_WIDGET_VER );
		wp_enqueue_style( $this->widget_slug.'-admin-styles', ivanicof_INSTAGRAM_WIDGET_URL . 'css/admin.css' );
	}


}
