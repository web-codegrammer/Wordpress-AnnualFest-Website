<?php
/**
 * ivanicof Theme Customizer
 *
 * @package ivanicof
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function ivanicof_customize_register( $wp_customize ) {

	
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->remove_control('background_color');

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'ivanicof_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'ivanicof_customize_partial_blogdescription',
		) );
	}

	/*
	*Theme options panel
	*/
	$wp_customize->add_panel( 'ivanicof_theme_options_panel', array(
		'title' => esc_html__( 'Ivanicof Theme options', 'ivanicof' ),
		'priority' => 35,
	));

	/* Header section */
	$wp_customize->add_section( 'ivanicof_header_section' , array(
		'title'       => esc_html__( 'Header Options', 'ivanicof' ),
		'panel'		  => 'ivanicof_theme_options_panel',
		'description' => esc_html__('Set header options','ivanicof'),
	));

	//Header image overlap*/
	$wp_customize->add_setting( 'ivanicof_header_image_overlap' , array(
		'default'           => ivanicof_setting_default('ivanicof_header_image_overlap'),
		'sanitize_callback' => 'absint',
		'transport'         => 'postMessage',
	));
	$wp_customize->add_control( new Customizer_Range_Value_Control( $wp_customize, 'ivanicof_header_image_overlap_control',
		array(
			'label' 	  => esc_html__( 'Header image overlap opacity','ivanicof'),
			'type'     	  => 'range-value',
			'section' 	  => 'header_image',
			'settings'	  => 'ivanicof_header_image_overlap',
			'input_attrs' => array(
				'min'    => 0,
				'max'    => 9,
				'step'   => 1,
				'suffix' => ' opacity', //optional suffix
			  ),
		)
	) );

	//Header social icons*/
	$wp_customize->add_setting( 'ivanicof_header_social_icons' , array(
		'default'           => ivanicof_setting_default('ivanicof_header_social_icons'),
		'sanitize_callback' => 'ivanicof_switch_sanitize',
		
		
	));
	$wp_customize->add_control( new Ivanicof_Toggle_Switch_Custom_control( $wp_customize, 'ivanicof_header_social_icons_control',
		array(
			'label' 	  => esc_html__( 'Show/hide header social icons','ivanicof' ),
			'section' 	  => 'ivanicof_header_section',
			'settings'	  => 'ivanicof_header_social_icons',
		)
	) );

	//Header search form*/
	$wp_customize->add_setting( 'ivanicof_header_search_form' , array(
		'default'           => ivanicof_setting_default('ivanicof_header_search_form'),
		'sanitize_callback' => 'ivanicof_switch_sanitize',
	));

	$wp_customize->add_control( new Ivanicof_Toggle_Switch_Custom_control( $wp_customize, 'ivanicof_header_search_form_control',
		array(
			'label' 	  => esc_html__( 'Show/hide header search form','ivanicof' ),
			'section' 	  => 'ivanicof_header_section',
			'settings'	  => 'ivanicof_header_search_form',
			
		)
	) );

	//Header button down*/
	$wp_customize->add_setting( 'ivanicof_header_button_down' , array(
		'default'           => ivanicof_setting_default('ivanicof_header_button_down'),
		'sanitize_callback' => 'ivanicof_switch_sanitize',
	));

	$wp_customize->add_control( new Ivanicof_Toggle_Switch_Custom_control( $wp_customize, 'ivanicof_header_button_down_control',
		array(
			'label' 	  => esc_html__( 'Show/hide header button down','ivanicof' ),
			'section' 	  => 'ivanicof_header_section',
			'settings'	  => 'ivanicof_header_button_down',
		)
	) );
	/*End Header options*/

	/* Colors */
	//subtitle site
	$wp_customize->add_setting( 'ivanicof_subtitle_color' , array(
		'default'           => ivanicof_setting_default('ivanicof_subtitle_color'),
		'sanitize_callback' => 'sanitize_hex_color',
	));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ivanicof_subtitle_color_control',array(
			'label' 	  => esc_html__( 'Color for site subtitle','ivanicof' ),
			'section' 	  => 'colors',
			'settings'	  => 'ivanicof_subtitle_color',
		)
	) );

	//Links and accent color
	$wp_customize->add_setting( 'ivanicof_accent_color' , array(
		'default'           => ivanicof_setting_default('ivanicof_accent_color'),
		'sanitize_callback' => 'sanitize_hex_color',
	));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ivanicof_accent_color_control',array(
			'label' 	  => esc_html__( 'Set colors for links and buttons','ivanicof' ),
			'section' 	  => 'colors',
			'settings'	  => 'ivanicof_accent_color',
		)
	) );

	//navigation menu
	$wp_customize->add_setting( 'ivanicof_main_menu_color_desktop' , array(
		'default'           => ivanicof_setting_default('ivanicof_main_menu_color_desktop'),
		'sanitize_callback' => 'sanitize_hex_color',
	));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ivanicof_main_menu_color_desktop_control',array(
			'label' 	  => esc_html__( 'Background color for main menu on big devices','ivanicof' ),
			'section' 	  => 'colors',
			'settings'	  => 'ivanicof_main_menu_color_desktop',
		)
	) );

	$wp_customize->add_setting( 'ivanicof_main_menu_text_color_desktop' , array(
		'default'           => ivanicof_setting_default('ivanicof_main_menu_text_color_desktop'),
		'sanitize_callback' => 'sanitize_hex_color',
	));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ivanicof_main_menu_text_color_desktop_control',array(
			'label' 	  => esc_html__( 'Text color for main menu on big devices','ivanicof' ),
			'section' 	  => 'colors',
			'settings'	  => 'ivanicof_main_menu_text_color_desktop',
		)
	) );

	//navigation menu mobile
	$wp_customize->add_setting( 'ivanicof_main_menu_color_mobile' , array(
		'default'           => ivanicof_setting_default('ivanicof_main_menu_color_mobile'),
		'sanitize_callback' => 'sanitize_hex_color',
	));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ivanicof_main_menu_color_mobile_control',array(
			'label' 	  => esc_html__( 'Background color for main menu on mobile devices','ivanicof' ),
			'section' 	  => 'colors',
			'settings'	  => 'ivanicof_main_menu_color_mobile',
		)
	) );

	$wp_customize->add_setting( 'ivanicof_main_menu_text_color_mobile' , array(
		'default'           => ivanicof_setting_default('ivanicof_main_menu_text_color_mobile'),
		'sanitize_callback' => 'sanitize_hex_color',
	));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ivanicof_main_menu_text_color_mobile_control',array(
			'label' 	  => esc_html__( 'Text color for main menu on mobile devices','ivanicof' ),
			'section' 	  => 'colors',
			'settings'	  => 'ivanicof_main_menu_text_color_mobile',
		)
	) );
	

	/* Typography section */
	$wp_customize->add_section( 'ivanicof_typography_section' , array(
		'title'       => esc_html__( 'Typography Options', 'ivanicof' ),
		'panel'		  => 'ivanicof_theme_options_panel',
		'description' => esc_html__('Set google fonts for texts','ivanicof'),
	));

	//Site Title
	$wp_customize->add_setting( 'ivanicof_typography_site_title' , array(
		'sanitize_callback' => 'ivanicof_sanitize_fonts',
		'default'           => ivanicof_setting_default('ivanicof_typography_site_title')
	));
		
	$wp_customize->add_control( 'ivanicof_typography_site_title_control', array(
		'label'      => esc_html__( 'Google font for site title', 'ivanicof' ),
        'section'    => 'ivanicof_typography_section',
		'settings'   => 'ivanicof_typography_site_title',
		'type'		 => 'select',
		'choices'    => ivanicof_get_google_fonts()
	));

	//font weight
	$wp_customize->add_setting( 'ivanicof_typography_site_title_weight' , array(
		'sanitize_callback' => 'ivanicof_sanitize_font_weights',
		'default'           => ivanicof_setting_default('ivanicof_typography_site_title_weight'),
	));
		
	$wp_customize->add_control( 'ivanicof_typography_site_title_weight_control', array(
		'label'      => esc_html__( 'Font weight for site title', 'ivanicof' ),
        'section'    => 'ivanicof_typography_section',
		'settings'   => 'ivanicof_typography_site_title_weight',
		'type'		 => 'select',
		'choices'    => ivanicof_get_font_weights()
	));

	//font style
	$wp_customize->add_setting( 'ivanicof_typography_site_title_style' , array(
		'sanitize_callback' => 'ivanicof_sanitize_font_styles',
		'default'           => ivanicof_setting_default('ivanicof_typography_site_title_style'),
	));
		
	$wp_customize->add_control( 'ivanicof_typography_site_title_style_control', array(
		'label'      => esc_html__( 'Font style for site title', 'ivanicof' ),
        'section'    => 'ivanicof_typography_section',
		'settings'   => 'ivanicof_typography_site_title_style',
		'type'		 => 'select',
		'choices'    => ivanicof_get_font_styles()
	));


	//Titles
	$wp_customize->add_setting( 'ivanicof_typography_titles' , array(
		'sanitize_callback' => 'ivanicof_sanitize_fonts',
		'default'           => ivanicof_setting_default('ivanicof_typography_titles'),
	));
		
	$wp_customize->add_control( 'ivanicof_typography_titles_control', array(
		'label'      => esc_html__( 'Google font for titles', 'ivanicof' ),
        'section'    => 'ivanicof_typography_section',
		'settings'   => 'ivanicof_typography_titles',
		'type'		 => 'select',
		'choices'    => ivanicof_get_google_fonts()
	));

	//font weight
	$wp_customize->add_setting( 'ivanicof_typography_titles_weight' , array(
		'sanitize_callback' => 'ivanicof_sanitize_font_weights',
		'default'           => ivanicof_setting_default('ivanicof_typography_titles_weight'),
	));
		
	$wp_customize->add_control( 'ivanicof_typography_titles_weight_control', array(
		'label'      => esc_html__( 'Font weight for titles', 'ivanicof' ),
        'section'    => 'ivanicof_typography_section',
		'settings'   => 'ivanicof_typography_titles_weight',
		'type'		 => 'select',
		'choices'    => ivanicof_get_font_weights()
	));

	//font style
	$wp_customize->add_setting( 'ivanicof_typography_titles_style' , array(
		'sanitize_callback' => 'ivanicof_sanitize_font_styles',
		'default'           => ivanicof_setting_default('ivanicof_typography_titles_style'),
	));
		
	$wp_customize->add_control( 'ivanicof_typography_titles_style_control', array(
		'label'      => esc_html__( 'Font Style for titles', 'ivanicof' ),
        'section'    => 'ivanicof_typography_section',
		'settings'   => 'ivanicof_typography_titles_style',
		'type'		 => 'select',
		'choices'    => ivanicof_get_font_styles()
	));

	// Body texts
	$wp_customize->add_setting( 'ivanicof_typography_texts' , array(
		'sanitize_callback' => 'ivanicof_sanitize_fonts',
		'default'           => ivanicof_setting_default('ivanicof_typography_texts'),
	));
		
	$wp_customize->add_control( 'ivanicof_typography_texts_control', array(
		'label'      => esc_html__( 'Google font for texts', 'ivanicof' ),
        'section'    => 'ivanicof_typography_section',
		'settings'   => 'ivanicof_typography_texts',
		'type'		 => 'select',
		'choices'    => ivanicof_get_google_fonts()
	));

	//font weight
	$wp_customize->add_setting( 'ivanicof_typography_texts_weight' , array(
		'sanitize_callback' => 'ivanicof_sanitize_font_weights',
		'default'           => ivanicof_setting_default('ivanicof_typography_texts_weight'),
	));
		
	$wp_customize->add_control( 'ivanicof_typography_texts_weight_control', array(
		'label'      => esc_html__( 'Font weight for texts', 'ivanicof' ),
        'section'    => 'ivanicof_typography_section',
		'settings'   => 'ivanicof_typography_texts_weight',
		'type'		 => 'select',
		'choices'    => ivanicof_get_font_weights()
	));

	//font style
	$wp_customize->add_setting( 'ivanicof_typography_texts_style' , array(
		'sanitize_callback' => 'ivanicof_sanitize_font_styles',
		'default'           => ivanicof_setting_default('ivanicof_typography_texts_style'),
	));
		
	$wp_customize->add_control( 'ivanicof_typography_texts_style_control', array(
		'label'      => esc_html__( 'Font Style for texts', 'ivanicof' ),
        'section'    => 'ivanicof_typography_section',
		'settings'   => 'ivanicof_typography_texts_style',
		'type'		 => 'select',
		'choices'    => ivanicof_get_font_styles()
	));

	/* End typography section */
	
	/* Layout section */
	$wp_customize->add_section( 'ivanicof_layou_section' , array(
		'title'       => esc_html__( 'Layout Options', 'ivanicof' ),
		'panel'		  => 'ivanicof_theme_options_panel',
		'description' => esc_html__('Set layout','ivanicof'),
	));
	

	// sidebar
	$wp_customize->add_setting( 'ivanicof_sidebar' , array(
		'default'           => ivanicof_setting_default('ivanicof_sidebar'),
		'sanitize_callback' => 'sanitize_text_field',
		
	));

	$wp_customize->add_control( new Ivanicof_Image_Radio_Button_Custom_Control( $wp_customize, 'ivanicof_sidebar_control', array(
		'label'      => esc_html__( 'Show/Hide sidebar', 'ivanicof' ),
		'section'    => 'ivanicof_layou_section',
		'settings'   => 'ivanicof_sidebar',
		'type'		 => 'select',
		'choices'	 => array(
			'no-sidebar' => array(
				'image' => trailingslashit( get_template_directory_uri() ) . 'assets/images/sidebar-none.png',
				'name'  => esc_html__('No Sidebar','ivanicof')
			),
			'sidebar-right' => array(
				'image' => trailingslashit( get_template_directory_uri() ) . 'assets/images/sidebar-right.png',
				'name'  => esc_html__('Sidebar right (Default)','ivanicof')
			),
			'sidebar-left' => array(
				'image' => trailingslashit( get_template_directory_uri() ) . 'assets/images/sidebar-left.png',
				'name'  => esc_html__('Sidebar left','ivanicof')
			)
		)
	)));

	// Contet width %
	$wp_customize->add_setting( 'ivanicof_content_width',array(
		'default'   		=> ivanicof_setting_default('ivanicof_content_width'),
		'transport' 		=> 'postMessage',
		'sanitize_callback' => 'absint'
	));

	$wp_customize->add_control( new Customizer_Range_Value_Control( $wp_customize, 'ivanicof_content_width_control',
		array(
			'label' 	  => esc_html__( 'Content Width percentage','ivanicof' ),
			'type'     	  => 'range-value',
			'section' 	  => 'ivanicof_layou_section',
			'settings'	  => 'ivanicof_content_width',
			'input_attrs' => array(
				'min'    => 25,
				'max'    => 100,
				'step'   => 1,
				'suffix' => '%', //optional suffix
			  ),
		)
	) );

	// blog columns
	$wp_customize->add_setting( 'ivanicof_blog_columns' , array(
		'default'           => ivanicof_setting_default('ivanicof_blog_columns'),
		'sanitize_callback' => 'sanitize_text_field',
		
	));

	$wp_customize->add_control( new Ivanicof_Image_Radio_Button_Custom_Control( $wp_customize, 'ivanicof_blog_columns_control', array(
		'label'      => esc_html__( 'Blog columns', 'ivanicof' ),
		'section'    => 'ivanicof_layou_section',
		'settings'   => 'ivanicof_blog_columns',
		'type'		 => 'select',
		'choices'	 => array(
			'one-column' => array(
				'image' => trailingslashit( get_template_directory_uri() ) . 'assets/images/one-column.png',
				'name'  => esc_html__('One Column (Default)','ivanicof')
			),
			'two-columns' => array(
				'image' => trailingslashit( get_template_directory_uri() ) . 'assets/images/two-columns.png',
				'name'  => esc_html__('Two Columns','ivanicof')
			),
			
		)
	)));

	/* End layout section */

	/* Social network section */
	$wp_customize->add_section( 'ivanicof_social_section' , array(
		'title'       => esc_html__( 'Social networks info', 'ivanicof' ),
		'panel'		  => 'ivanicof_theme_options_panel',
		'description' => esc_html__('Set links of social networks','ivanicof'),
	));

	  
	/*Instagram*/     
	$wp_customize->add_setting( 'ivanicof_instagram', 
		array( 
			'sanitize_callback' => 'esc_url_raw'
		) 
	);

	$wp_customize->add_control( 'ivanicof_instagram_control', array(
		'label'      => esc_html__( 'Instagram Url', 'ivanicof' ),
        'section'    => 'ivanicof_social_section',
        'settings'    => 'ivanicof_instagram',
		
	));
	
	/* Pinterest*/
	$wp_customize->add_setting( 'ivanicof_pinterest', 
		array( 
			'sanitize_callback' => 'esc_url_raw'
		) 
	);

	$wp_customize->add_control( 'ivanicof_pinterest_control', array(
		'label'      => esc_html__( 'Pinterest Url', 'ivanicof' ),
        'section'    => 'ivanicof_social_section',
        'settings'    => 'ivanicof_pinterest',
		
    ));

	/* Facebook*/
	$wp_customize->add_setting( 'ivanicof_facebook', array( 
			'sanitize_callback' => 'esc_url_raw'
		) 
	);

	$wp_customize->add_control( 'ivanicof_facebook_control', array(
		'label'      => esc_html__( 'Facebook Url', 'ivanicof' ),
        'section'    => 'ivanicof_social_section',
        'settings'    => 'ivanicof_facebook',
		
    ));

	/* Twitter*/
	$wp_customize->add_setting( 'ivanicof_twitter', array( 
		'sanitize_callback' => 'esc_url_raw') );

	$wp_customize->add_control( 'ivanicof_twitter_control', array(
	'label'      => esc_html__( 'Twitter Url', 'ivanicof' ),
	'section'    => 'ivanicof_social_section',
	'settings'    => 'ivanicof_twitter',

	));

	/* Linkedin*/
	$wp_customize->add_setting( 'ivanicof_linkedin', array( 
		'sanitize_callback' => 'esc_url_raw') );

	$wp_customize->add_control( 'ivanicof_linkedin_control', array(
	'label'      => esc_html__( 'Linkedin Url', 'ivanicof' ),
	'section'    => 'ivanicof_social_section',
	'settings'    => 'ivanicof_linkedin',

	));

	/* tumblr*/
	$wp_customize->add_setting( 'ivanicof_tumblr', array( 
		'sanitize_callback' => 'esc_url_raw') );

	$wp_customize->add_control( 'ivanicof_tumblr_control', array(
	'label'      => esc_html__( 'tumblr Url', 'ivanicof' ),
	'section'    => 'ivanicof_social_section',
	'settings'    => 'ivanicof_tumblr',

	));

	/* End social section */

	/* Footer options */
	$wp_customize->add_section( 'ivanicof_footer_section' , array(
		'title'       => esc_html__( 'Footer Options', 'ivanicof' ),
		'panel'		  => 'ivanicof_theme_options_panel',
		'description' => esc_html__('Set Footer options','ivanicof'),
	));

	//Footer social icons*/
	$wp_customize->add_setting( 'ivanicof_footer_social_icons' , array(
		'default'           => ivanicof_setting_default('ivanicof_footer_social_icons'),
		'sanitize_callback' => 'ivanicof_switch_sanitize',
		
		
	));
	$wp_customize->add_control( new Ivanicof_Toggle_Switch_Custom_control( $wp_customize, 'ivanicof_footer_social_icons_control',
		array(
			'label' 	  => esc_html__( 'Show/hide footer social icons','ivanicof' ),
			'section' 	  => 'ivanicof_footer_section',
			'settings'	  => 'ivanicof_footer_social_icons',
		)
	) );

	/*Instagram*/     
	$wp_customize->add_setting( 'ivanicof_footer_text', array( 
			'sanitize_callback' => 'sanitize_text_field'
		) 
	);

	$wp_customize->add_control( 'ivanicof_footer_text_control', array(
		'label'      => esc_html__( 'Text info for footer', 'ivanicof' ),
        'section'    => 'ivanicof_footer_section',
        'settings'    => 'ivanicof_footer_text',
		
	));

	/* End Footer section */


	
	
}
add_action( 'customize_register', 'ivanicof_customize_register' );


/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function ivanicof_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function ivanicof_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function ivanicof_customize_preview_js() {

	wp_enqueue_script( 'ivanicof-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'ivanicof_customize_preview_js' );

//Sanitizes Fonts
function ivanicof_sanitize_fonts( $input ) {
	$valid = ivanicof_get_google_fonts();
	
	if ( array_key_exists( $input, $valid ) ) {
		return $input;
	} else {
		return '';
	}
}

function ivanicof_sanitize_font_weights( $input ){
	$valid = array(
		'100'=>'100',
		'200'=>'200',
		'300'=>'300',
		'400'=>'400',
		'500'=>'500',
		'600'=>'600',
		'700'=>'700',
		'800'=>'800',
		'900'=>'900',
	);

	if ( array_key_exists( $input, $valid ) ) {
		return $input;
	} else {
		return '400';
	}
}

function ivanicof_sanitize_font_styles($input){
	$valid = array(
		'normal' => 'normal',
		'italic' => 'italic'
	);

	if ( array_key_exists( $input, $valid ) ) {
		return $input;
	} else {
		return 'normal';
	}
}

function ivanicof_switch_sanitize( $input ) {
	if ( true === $input ) {
		return 1;
	} else {
		return 0;
	}
}

if ( class_exists( 'WP_Customize_Control' ) ) {
				
	require_once( get_template_directory() . '/inc/customizer/custom-controls/custom-controls.php' );
}
