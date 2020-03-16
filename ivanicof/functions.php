<?php
/**
 * ivanicof functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ivanicof
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }
$ivanicof_theme = wp_get_theme();

define( 'IVANICOF_VERSION', $ivanicof_theme->get('Version') );


if ( ! function_exists( 'ivanicof_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function ivanicof_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on ivanicof, use a find and replace
		 * to change 'ivanicof' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'ivanicof', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		//add_image_size( 'ivanicof-featured-image', 2000, 1200, true );
		add_image_size( 'ivanicof-featured-image', 1400, 600, true );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'ivanicof' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'ivanicof_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		/*
		* Enable support for Post Formats.
		*
		* See: https://codex.wordpress.org/Post_Formats
		*/
		add_theme_support(
			'post-formats',
			array(
				'image',
				'video',
				'quote',
				'link',
				'gallery',
				'audio',
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'ivanicof_setup' );

/**
 * Enable support for custom editor styles if using the classic editor.
 *
 * @link  https://developer.wordpress.org/reference/functions/add_editor_style/
 * @since 1.0.0
 */
function ivanicof_classic_editor_styles() {

	// Return if the block editor is not found.
	if ( ! function_exists( 'register_block_type' ) ) {

		return;

	}

	// Add editor styles for the classic editor.
	if ( ! get_current_screen()->is_block_editor() ) {

		add_editor_style( 'editor-style.css' );

	}

}
add_action( 'admin_print_styles', 'ivanicof_classic_editor_styles', 10, 0 );


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function ivanicof_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'ivanicof_content_width', 1400);
}
add_action( 'after_setup_theme', 'ivanicof_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ivanicof_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'ivanicof' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'ivanicof' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'ivanicof_widgets_init' );

/**
 * Filter post links.
 *
 * split titles
 */
add_filter( 'next_post_link','ivanicof_next_post_link' , 10, 4 );

function ivanicof_next_post_link( $output, $format, $link, $post ) {
	if ( ! $post ) {
	return '';
  }

  return sprintf(
	  '<div class="nav-next"><span class="next"><a href="%1$s" title="%2$s">%3$s</a></span></div>',
		esc_url(get_permalink( $post )),
		$post->post_title,
		wp_trim_words($post->post_title,3,'...')
  );
}

add_filter( 'previous_post_link', 'ivanicof_previous_post_link', 10, 4 );

function ivanicof_previous_post_link( $output, $format, $link, $post ) {
	if ( ! $post ) {
	return '';
  }

  return sprintf(
	  '<div class="nav-previous"><span class="prev"><a href="%1$s" title="%2$s">%3$s</a></span></div>',
		esc_url(get_permalink( $post )),
		$post->post_title,
		wp_trim_words($post->post_title,3,'...')
  );
}

/**
 * Filter widget tag cloud.
 *
 * Remove Tag-Clouds inline style
 */

add_filter('wp_generate_tag_cloud', 'ivanicof_remove_tagcloud_inline_style',10,1);
function ivanicof_remove_tagcloud_inline_style($input){
  return preg_replace('/ style=("|\')(.*?)("|\')/','',$input);  
  
}

/**
 * A get_post_gallery() polyfill for Gutenberg
 *
 * @param string $gallery The current gallery html that may have already been found (through shortcodes).
 * @param int $post The post id.
 * @return string The gallery html.
 */
function ivanicof_get_post_gallery( $gallery, $post ) {
	// Already found a gallery so lets quit.
	if ( $gallery ) {
		return $gallery;
	}
	// Check the post exists.
	$post = get_post( $post );
	if ( ! $post ) {
		return $gallery;
	}
	// Not using Gutenberg so let's quit.
	if ( ! function_exists( 'has_blocks' ) ) {
		return $gallery;
	}
	// Not using blocks so let's quit.
	if ( ! has_blocks( $post->post_content ) ) {
		return $gallery;
	}
	/**
	 * Search for gallery blocks and then, if found, return the html from the
	 * first gallery block.
	 *
	 * Thanks to Gabor for help with the regex:
	 * https://twitter.com/javorszky/status/1043785500564381696.
	 */
	$pattern = "/<!--\ wp:gallery.*-->([\s\S]*?)<!--\ \/wp:gallery -->/i";
	preg_match_all( $pattern, $post->post_content, $the_galleries );
	// Check a gallery was found and if so change the gallery html.
	if ( ! empty( $the_galleries[1] ) ) {
	
		$gallery = reset( $the_galleries[1] );
		
	}
	return $gallery;
}
add_filter( 'get_post_gallery', 'ivanicof_get_post_gallery', 10, 2 );

add_filter( 'comment_form_defaults', 'ivanicof_modify_fields_form' );

function ivanicof_modify_fields_form( $args ){

	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );

	$author = '<input placeholder="'.esc_html__( 'Name' ,'ivanicof') . ( $req ? ' *' : '' ).'" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .'" size="30"' . $aria_req . ' />';
	$email = '<div class="fields-wrap"><input placeholder="'.esc_html__( 'Email' ,'ivanicof') . ( $req ? ' *' : '' ).'" id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) .'" size="30"' . $aria_req . ' />';
	$url = '<input placeholder="'.esc_html__( 'Website' ,'ivanicof').'" id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .'" size="30" /></div>';
	$comment = '<textarea placeholder="'. esc_html__( 'Comment', 'ivanicof' ).'" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>';
	
	
	$args['fields']['author'] = $author;
	$args['fields']['email'] = $email;
	$args['fields']['url'] = $url;
	$args['comment_field'] = $comment;

	return $args;

}

/**
 * Modify comments form fields order
 */

add_filter( 'comment_form_fields', 'ivanicof_modify_order_fields' );

function ivanicof_modify_order_fields( $fields ){
	
	$val = $fields['comment'];
	$val2 = $fields['cookies'];
	unset($fields['comment']);
	unset($fields['cookies']);

	$fields += array('comment' => $val );
	$fields += array('cookies' => $val2 );

	return $fields;
}


/**
 * required files.
 */

require get_template_directory() . '/inc/includes.php';


