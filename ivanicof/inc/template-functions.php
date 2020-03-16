<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package ivanicof
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function ivanicof_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	if(is_search() || is_archive() || is_home()){
		$classes[] = 'post-list';
	}

	return $classes;
}
add_filter( 'body_class', 'ivanicof_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function ivanicof_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'ivanicof_pingback_header' );

/**
 * get google fonts for customizer
 */
if ( ! function_exists( 'ivanicof_get_google_fonts' ) ) :
 function ivanicof_get_google_fonts(){
	 return array(
		'Source Sans Pro:400,700,400italic,700italic' => 'Source Sans Pro',
		'Open Sans:400italic,700italic,400,700' => 'Open Sans',
		'Oswald:400,700' => 'Oswald',
		'Playfair Display:400,700,400italic' => 'Playfair Display',
		'Montserrat:400,700' => 'Montserrat',
		'Lobster' => 'Lobster',
		'Raleway:400,700' => 'Raleway',
		'Droid Sans:400,700' => 'Droid Sans',
		'Lato:400,700,400italic,700italic' => 'Lato',
		'Arvo:400,700,400italic,700italic' => 'Arvo',
		'Lora:400,700,400italic,700italic' => 'Lora',
		'Merriweather:400,300italic,300,400italic,700,700italic' => 'Merriweather',
		'Oxygen:400,300,700' => 'Oxygen',
		'PT Serif:400,700' => 'PT Serif',
		'PT Sans:400,700,400italic,700italic' => 'PT Sans',
		'PT Sans Narrow:400,700' => 'PT Sans Narrow',
		'Cabin:400,700,400italic' => 'Cabin',
		'Fjalla One:400' => 'Fjalla One',
		'Francois One:400' => 'Francois One',
		'Josefin Sans:400,300,600,700' => 'Josefin Sans',
		'Libre Baskerville:400,400italic,700' => 'Libre Baskerville',
		'Pacifico:400' => 'Pacifico',
		'Arimo:400,700,400italic,700italic' => 'Arimo',
		'Ubuntu:400,700,400italic,700italic' => 'Ubuntu',
		'Unna:400,400italic,700,700italic' => 'Unna',
		'Norican' => 'Norican',
		'Bitter:400,700,400italic' => 'Bitter',
		'Droid Serif:400,700,400italic,700italic' => 'Droid Serif',
		'Roboto:400,400italic,700,700italic' => 'Roboto',
		'Open Sans Condensed:700,300italic,300' => 'Open Sans Condensed',
		'Roboto Condensed:400italic,700italic,400,700' => 'Roboto Condensed',
		'Roboto Slab:400,700' => 'Roboto Slab',
		'Source Serif Pro:400,600,700' => 'Source Serif Pro',
		'Yanone Kaffeesatz:400,700' => 'Yanone Kaffeesatz',
		'Rokkitt:400' => 'Rokkitt',
	);
 }
endif;

 /**
 * get google fonts weights
 */
if ( ! function_exists( 'ivanicof_get_font_weights' ) ) :
	function ivanicof_get_font_weights(){
	return $font_weights = array(
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

  }


  function ivanicof_get_font_styles(){
	return $font_weights = array(
				'normal' => 'normal',
				'italic' => 'italic'
		);

}
endif;

/**
 * get google fonts styles
 */
if ( ! function_exists( 'ivanicof_get_font_styles' ) ) :
	function ivanicof_get_font_styles(){
		return $font_weights = array(
					'normal' => 'normal',
					'italic' => 'italic'
			);

	}
endif;

/**
 * Convert gallery to slider
 */
if ( ! function_exists( 'ivanicof_gallery_to_slider' ) ) :

	function ivanicof_gallery_to_slider($gallery){
		
		$pattern = '@src="([^"]+)"@';
		preg_match_all( $pattern , $gallery, $match );
		$src = array_pop($match);
		if($src):
			echo '<div class="flexslider">
			<ul class="slides">';
			foreach ($src as $key => $value) {
				echo '<li>
				<img src="'.esc_url($value).'" />
			  </li>';
			}
			echo '</ul></div>';
		endif;
		
	}
	  
endif;


/**
 * Add pagination 
 */
if ( ! function_exists( 'ivanicof_pagination' ) ) :

	function ivanicof_pagination(){
		if( !class_exists( 'Jetpack' ) || (class_exists( 'Jetpack' ) && !Jetpack::is_module_active( 'infinite-scroll' )) ){
			if( !get_theme_mod('ivanicof_pagination_type','next-prev') === 'next-prev'){
	
				the_posts_navigation();
			
				}else{
			
				the_posts_pagination( array(
					'prev_text'          => '<i class="fa fa-angle-left"></i> ' . esc_html__( 'Previous', 'ivanicof' ),
					'next_text'          => esc_html__( 'Next', 'ivanicof' ) . ' <i class="fa fa-angle-right"></i>',
					'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'ivanicof' ) . ' </span>',
				) );
			} 
		}
	}
endif;

