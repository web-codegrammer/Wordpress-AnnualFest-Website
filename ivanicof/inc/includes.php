<?php
/**
 * requiored files
 *
 *
 * @package ivanicof
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-hooks.php';

/**
 * Customizer defaults.
 */
require get_template_directory() . '/inc/customizer/defaults.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Dynamic Styles.
 */
require get_template_directory() . '/inc/customizer/dynamic-styles.php';


/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Assets.
 */
require get_template_directory() . '/inc/assets.php';

/**
 * widget Recent posts.
 */
require get_template_directory() . '/widgets/recent-posts/class-recent-posts-widget.php';

/**
 * widget Instagram (thanks meks).
 */
require get_template_directory() . '/widgets/instagram-widget/instagram-widget.php';