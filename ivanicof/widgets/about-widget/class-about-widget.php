<?php
/**
 *
 * About Widget 
 * 
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

add_action( 'widgets_init', 'ivanicof_register_about_widget');
function ivanicof_register_about_widget(){
    register_widget( 'Ivanicof_About_widget' );
}

// add image size
add_action( 'after_setup_theme', 'ivanicof_about_widget_image_size' );
function ivanicof_about_widget_image_size(){
    add_image_size( 'about_widget_image', 200, 200, true );
}

// Enqueue css
add_action( 'wp_enqueue_scripts', 'ivanicof_wd_about_style' );
function ivanicof_wd_about_style() {
    wp_enqueue_style( 'ivanicof_wd_about_styles', trailingslashit(get_template_directory_uri()) . 'widgets/about-widget/about-widget.css' );
}

// Enqueue additional admin scripts
add_action('admin_enqueue_scripts', 'ivanicof_wd_about_script');
function ivanicof_wd_about_script() {
    wp_enqueue_media();
    wp_enqueue_script('ivanicof_wd_about_script', trailingslashit(get_template_directory_uri()) . 'widgets/about-widget/about-widget.js', false, '1.0.0', true);
}

// add custom sizes to wp_prepare_attachment_for_js
function wpse_110060_image_sizes_js( $response, $attachment, $meta ){

	$size_array = array( 'about_widget_image') ;

	foreach ( $size_array as $size ):

			if ( isset( $meta['sizes'][ $size ] ) ) {
					$attachment_url = wp_get_attachment_url( $attachment->ID );
					$base_url = str_replace( wp_basename( $attachment_url ), '', $attachment_url );
					$size_meta = $meta['sizes'][ $size ];

					$response['sizes'][ $size ] = array(
							'height'        => $size_meta['height'],
							'width'         => $size_meta['width'],
							'url'           => $base_url . $size_meta['file'],
							'orientation'   => $size_meta['height'] > $size_meta['width'] ? 'portrait' : 'landscape',
					);
			}

	endforeach;

	return $response;
}
add_filter ( 'wp_prepare_attachment_for_js',  'wpse_110060_image_sizes_js' , 10, 3  );

class Ivanicof_About_widget extends WP_Widget {

    protected $defaults;

    public function __construct() {

        $widget_ops = array(
            'classname' => 'Ivanicof_About_widget',
            'description' => 'About me information',
            );
            parent::__construct( 'ivanicof_About_widget', 'About me', $widget_ops );

            $this->defaults = array(
                'title' => __('About Me','ivanicof'),
                'image_uri' => '',
                'name' => '',
                'text' => ''
            );
    }
           
    // output the widget content on the front-end
    public function widget( $args, $instance ) {

        extract( $args );
        $instance = wp_parse_args( (array) $instance, $this->defaults );
        // these are the widget options
        $title = apply_filters('widget_title', $instance['title']);
        $image = $instance['image_uri'];
        $name = $instance['name'];
        $textarea = $instance['text'];
        echo $before_widget;

        // Display the widget
        echo '<div class="widget-text ivanicof_widget_about">';


        // Check if title is set
        if ( $title ) {
            echo $before_title . esc_html($title) . $after_title ;
        }

        if($image){
            echo '<img src="'.esc_url($instance["image_uri"]).'"/>';
        }

        // Check if name is set
        if ( $name ) {
            echo '<h3 class="about_widget_name">'.esc_html($name).'</h3>' ;
        }

        // Check if textarea is set
        if( $textarea ) {
            echo '<p class="about_widget_textarea">'.esc_html($textarea).'</p>';
        }
                
        echo '</div>';
        echo $after_widget;
        
    }
    
    public function form( $instance ) {

        $title = '';
        if( !empty( $instance['title'] ) ) {
            $title = $instance['title'];
        }

        $image = '';
        if( !empty( $instance['image_uri'] ) ) {
            $image = $instance['image_uri'];
        }

        $name = '';
        if( !empty( $instance['name'] ) ) {
            $name = $instance['name'];
        }
     
        $text = '';
        if( !empty( $instance['text'] ) ) {
            $text = $instance['text'];
        }
     
        ?>
     
        <p>
            <label for="<?php echo $this->get_field_name( 'title' ); ?>"><?php esc_html_e( 'Title:','ivanicof' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'image_uri' ); ?>">Image</label>
            <img class="<?php echo $this->id ?>_img" src="<?php echo $image; ?>" style="margin:0;padding:0;max-width:100%;display:block"/>
            <input type="text" class="widefat <?php echo $this->id ?>_url" name="<?php echo $this->get_field_name( 'image_uri' ); ?>" value="<?php echo $image; ?>" style="margin-top:5px;" />
            <input type="button" id="<?php echo $this->id ?>" class="button button-primary js_custom_upload_media" value="Upload Image" style="margin-top:5px;" />
            
        </p>

        <p>
            <label for="<?php echo $this->get_field_name( 'name' ); ?>"><?php esc_html_e( 'Name:','ivanicof' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'name' ); ?>" name="<?php echo $this->get_field_name( 'name' ); ?>" type="text" value="<?php echo esc_attr( $name ); ?>" />
        </p>
     
        <p>
            <label for="<?php echo $this->get_field_name( 'text' ); ?>"><?php esc_html_e( 'Text:','ivanicof' ); ?></label>
            <textarea class="widefat" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>" type="text" ><?php echo esc_attr( $text ); ?></textarea>
        </p>
     
        <div class='mfc-text'>
             
        </div>
     <?php
        
     
       
    }
    
    // save options
   function update( $new_instance, $old_instance ) {

    $instance = $old_instance;
    $instance['title']     = isset( $new_instance['title'] ) ? wp_strip_all_tags( $new_instance['title'] ) : '';
    $instance['image_uri'] = isset( $new_instance['image_uri'] ) ? esc_url( $new_instance['image_uri'] ) : '';
    $instance['name']      = isset( $new_instance['name'] ) ? wp_strip_all_tags( $new_instance['name'] ) : '';
	$instance['text']      = isset( $new_instance['text'] ) ? wp_strip_all_tags( $new_instance['text'] ) : '';
	
	return $instance;
   }

  
        
}