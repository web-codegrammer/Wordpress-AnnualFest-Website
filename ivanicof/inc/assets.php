<?php
/**
 * Assets
 * 
 * @package ivanicof
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

 /**
 * Enqueue scripts and styles.
 */

function ivanicof_scripts() {

	wp_enqueue_style( 'ivanicof-style', get_stylesheet_uri() ,false. IVANICOF_VERSION);

	wp_style_add_data( 'ivanicof-style', 'rtl', 'replace' );

	wp_enqueue_style( 'fontawesome', trailingslashit( get_template_directory_uri() ) . 'assets/css/font-awesome.min.css' , array(), '4.7', 'all' );
	
	wp_enqueue_style( 'flexslider-css' ,trailingslashit( get_template_directory_uri() ) . 'assets/css/flexslider.css' , array(), '2.7.2', 'all');

	wp_enqueue_script( 'jquery-flexslider-js', trailingslashit(get_template_directory_uri()) . 'assets/js/jquery.flexslider-min.js', array(), '2.7.2', true );

	wp_enqueue_script( 'ivanicof-init', trailingslashit(get_template_directory_uri()) . 'assets/js/init.js', array('jquery'), '20151215', true );
	
	wp_enqueue_script( 'ivanicof-skip-link-focus-fix', trailingslashit(get_template_directory_uri()) . 'assets/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	$site_title_font = esc_html(get_theme_mod('ivanicof_typography_site_title',ivanicof_setting_default('ivanicof_typography_site_title')));
	$titles_font = esc_html(get_theme_mod('ivanicof_typography_titles',ivanicof_setting_default('ivanicof_typography_titles')));
	$texts_font = esc_html(get_theme_mod('ivanicof_typography_texts',ivanicof_setting_default('ivanicof_typography_texts')));

	$cdns = array();

	if( $site_title_font ) {
		wp_enqueue_style( 'ivanicof-site-title-font', '//fonts.googleapis.com/css?family='. $site_title_font );
		array_push($cdns,$site_title_font);
	} else {
		wp_enqueue_style( 'ivanicof-site-title-font', '//fonts.googleapis.com/css?family=Norican');
		array_push($cdns,'Unna:400,400italic,700,700italic');
	}

	if( $titles_font ) {
		if(!in_array( $titles_font , $cdns )){
			wp_enqueue_style( 'ivanicof-titles-font', '//fonts.googleapis.com/css?family='. $titles_font );
			array_push($cdns,$titles_font);
		}
				
	} else {
		if(!in_array( 'Unna:400,400italic,700,700italic' , $cdns )){
			wp_enqueue_style( 'ivanicof-titles-font', '//fonts.googleapis.com/css?family=Unna:400,400italic,700,700italic');
			array_push($cdns,'Source+Serif+Pro:400,600,700');
		}
				
	}

	if( $texts_font ) {
		if(!in_array( $texts_font , $cdns )){
			wp_enqueue_style( 'ivanicof-texts-font', '//fonts.googleapis.com/css?family='. $texts_font );
			array_push($cdns,$texts_font);
		}
	} else {
		if(!in_array( 'Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap' , $cdns )){
			wp_enqueue_style( 'ivanicof-texts-font', '//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap');
			array_push($cdns,'Montserrat:400,300,400italic,700,600');
		}
	}
}
add_action( 'wp_enqueue_scripts', 'ivanicof_scripts' );