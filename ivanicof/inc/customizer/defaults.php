<?php
/**
 * ivanicof Theme Customizer defaults
 *
 * @package ivanicof
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
/**
* Set our Customizer default options
*/
if ( ! function_exists( 'ivanicof_setting_default' ) ) {

	function ivanicof_setting_default($theme_mod) {
		$customizer_defaults = array(
			'ivanicof_typography_site_title'  			=> 'Norican',
			'ivanicof_typography_titles'      			=> 'Unna:400,400italic,700,700italic',
			'ivanicof_typography_texts'       			=> 'Open Sans:400italic,700italic,400,700',
			'ivanicof_sidebar'                 			=> 'sidebar-right',
			'ivanicof_blog_columns'						=> 'one-column',
			'ivanicof_content_width'           			=> 100,
			'ivanicof_typography_site_title_weight' 	=> '400',
			'ivanicof_typography_site_title_style' 		=> 'normal',
			'ivanicof_typography_titles_weight' 		=> '400',
			'ivanicof_typography_titles_style'    		=> 'normal',
			'ivanicof_typography_texts_weight' 			=> '400',
			'ivanicof_typography_texts_style'  			=> 'normal',
			'ivanicof_header_image_overlap'				=> 7,
			'ivanicof_header_button_down'      			=> true,
			'ivanicof_header_search_form'				=> true,
			'ivanicof_header_social_icons'				=> true,
			'ivanicof_footer_social_icons'				=> true,
			'ivanicof_accent_color'                     => '#e09813',
			'ivanicof_subtitle_color'					=> '#999',
			'ivanicof_main_menu_color_desktop'			=> '#fff',
			'ivanicof_main_menu_color_mobile'			=> '#000',
			'ivanicof_main_menu_text_color_desktop'     => '#e09813',
			'ivanicof_main_menu_text_color_mobile'     	=> '#e09813'
			
		);

		return isset($customizer_defaults[$theme_mod]) ? $customizer_defaults[$theme_mod] : false;
	}
}