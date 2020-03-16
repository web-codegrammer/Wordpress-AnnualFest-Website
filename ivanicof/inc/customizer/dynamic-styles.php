<?php
/**
 * includes
 *
 * @package ivanicof
 */
if ( !defined( 'ABSPATH' ) ) { exit; }

/**
 * Set dynamic styles
 */

function ivanicof_custom_styles() {

    //Fonts
    $site_title_font= esc_html(get_theme_mod('ivanicof_typography_site_title',ivanicof_setting_default('ivanicof_typography_site_title')));
    $site_title_font_weight= esc_html(get_theme_mod('ivanicof_typography_site_title_weight',ivanicof_setting_default('ivanicof_typography_site_title_weight')));
    $site_title_font_style= esc_html(get_theme_mod('ivanicof_typography_site_title_style',ivanicof_setting_default('ivanicof_typography_site_title_style')));

    $titles_font = esc_html(get_theme_mod('ivanicof_typography_titles',ivanicof_setting_default('ivanicof_typography_titles')));
    $titles_font_weight= esc_html(get_theme_mod('ivanicof_typography_titles_weight',ivanicof_setting_default('ivanicof_typography_titles_weight')));
    $titles_font_style= esc_html(get_theme_mod('ivanicof_typography_titles_style',ivanicof_setting_default('ivanicof_typography_titles_style')));

    $texts_font = esc_html(get_theme_mod('ivanicof_typography_texts',ivanicof_setting_default('ivanicof_typography_texts')));
    $texts_font_weight= esc_html(get_theme_mod('ivanicof_typography_texts_weight',ivanicof_setting_default('ivanicof_typography_texts_weight')));
    $texts_font_style= esc_html(get_theme_mod('ivanicof_typography_texts_style',ivanicof_setting_default('ivanicof_typography_texts_style')));

    // header image
    $image_header_overlap = get_theme_mod('ivanicof_header_image_overlap',ivanicof_setting_default('ivanicof_header-image-overlap'));
    
    // Sidebar
    $sidebar = esc_html(get_theme_mod('ivanicof_sidebar',ivanicof_setting_default('ivanicof_sidebar')));

    // Content width
    $content_width = esc_html(get_theme_mod('ivanicof_content_width',ivanicof_setting_default('ivanicof_content_width')));
    
    //Blog columns 
    $blog_columns = esc_html(get_theme_mod('ivanicof_blog_columns',ivanicof_setting_default('ivanicof_blog_columns')));
    
    //Colors

    $link_accent_colors = get_theme_mod('ivanicof_accent_color',ivanicof_setting_default('ivanicof_accent_color'));
    
    $subtitle_color = get_theme_mod('ivanicof_subtitle_color',ivanicof_setting_default('ivanicof_subtitle_color'));
    
    $main_menu_color_desktop = get_theme_mod('ivanicof_main_menu_color_desktop',ivanicof_setting_default('ivanicof_main_menu_color_desktop'));
    
    $main_menu_text_color_desktop = get_theme_mod('ivanicof_main_menu_text_color_desktop',ivanicof_setting_default('ivanicof_main_menu_text_color_desktop'));
    
    $main_menu_color_mobile = get_theme_mod('ivanicof_main_menu_color_mobile',ivanicof_setting_default('ivanicof_main_menu_color_mobile'));

    $main_menu_text_color_mobile = get_theme_mod('ivanicof_main_menu_text_color_mobile',ivanicof_setting_default('ivanicof_main_menu_text_color_mobile'));
    
    $custom ="";

    if ( $site_title_font) {
		$font_pieces = explode(":", $site_title_font);
		$custom .= ".site-title{ 
                        font-family: $font_pieces[0];
                        font-weight:$site_title_font_weight; 
                        font-style:$site_title_font_style; 
                    }\n";
    }

	if ( $titles_font ) {
		$font_pieces = explode(":", $titles_font);
		$custom .= "h1, h2, h3, h4, h5, h6,.entry-title a,.entry-title,.widget.title,.main-navigation{ 
                        font-family: $font_pieces[0];
                        font-weight: $titles_font_weight; 
                        font-style: $titles_font_style; }\n";
    }
    
	if ( $texts_font ) {
		$font_pieces = explode(":", $texts_font);
		$custom .= "body,p ,button, input, select, textarea { 
                        font-family: $font_pieces[0];
                        font-weight:$texts_font_weight; 
                        font-style:$texts_font_style;
                    }\n";
    }

    if( $content_width){
        $custom .= ".site-content { 
                        width:$content_width%;
                    }\n";
    }

    if ( $image_header_overlap) {
        $custom .= ".site-header .wrap-image .header-image-overlap{ 
                        background-color: rgba(0,0,0,.$image_header_overlap);
                    }\n";
    }

    if($subtitle_color){
        $custom .= ".site-description{ 
            color: $subtitle_color
        }\n";
    }

    if($link_accent_colors){
        $custom .= "a{ 
            color: $link_accent_colors;
        }
        .site-branding #button-down{
            color: $link_accent_colors;
            border: 1px solid $link_accent_colors;
        }
        .site-branding #button-down:before{
            border-left: 1px solid $link_accent_colors;
            border-bottom: 1px solid $link_accent_colors;
        }
        button, input[type='button'], input[type='reset'], input[type='submit']{
            background-color: $link_accent_colors;
        }
        #button-up{
            border: 1px solid $link_accent_colors;
            color: $link_accent_colors;
        }\n";
    }

    if($main_menu_color_desktop){
        $custom .= "@media screen and (min-width: 37.5em){
                        .main-navigation{ 
                            background-color:$main_menu_color_desktop !important; 
                        }
                       
                    }\n";
    }

    if($main_menu_text_color_desktop){
        $custom .= "@media screen and (min-width: 37.5em){
                        .main-navigation a{
                            color:$main_menu_text_color_desktop !important;
                        }
                    }\n";
    }

    if($main_menu_color_mobile){
        $custom .= "@media screen and (max-width: 37.5em){
                        .main-navigation{ 
                            background-color:$main_menu_color_mobile !important;
                            
                        }
                        
                    }\n";
    }

    if($main_menu_text_color_mobile){
        $custom .= "@media screen and (max-width: 37.5em){
                        .main-navigation a{
                            color:$main_menu_text_color_mobile !important;
                        }
                    }\n";
    }

    if($blog_columns){
        if($blog_columns == "two-columns"){
            $custom .="
            @media screen and (min-width: 37.5em){
                .posts-content{
                    display:flex;
                    flex-wrap:wrap;
                }
                .posts-content .post{
                    flex:0 0 50%;
                    max-width:50%;
                    padding-left:15px;
                    padding-right:15px;
                }
            }
            ";
        }
    }

    if($sidebar){
        if($sidebar == "sidebar-right"){
            $custom .="
            .widget-area{display:block;}
            .content-area {
                float: left;
                margin: 0 -30% 0 0;
                width: 100%;
            }
            .site-main {
                margin: 3rem 30% 0 0;
            }
            .site-content .widget-area {
                float: right;
                overflow: hidden;
                width: 30%;
            }
            .site-footer {
                clear: both;
                width: 100%;
            }
            
            .no-sidebar .content-area {
                float: none;
                margin-left: auto;
                margin-right: auto;
            }
            .no-sidebar .site-main {
                margin-right: 0;
            }";
        }

        if($sidebar == "sidebar-left"){
            $custom .="
            .widget-area{display:block;}
            .content-area {
                float: right;
                margin: 0 0 0 -30%;
                width: 100%;
            }
            .site-main {
                margin: 3rem 0 0 30%;
            }
            .site-content .widget-area {
                float: left;
                overflow: hidden;
                width: 30%;
            }
            .site-footer {
                clear: both;
                width: 100%;
            }
            
            .no-sidebar .content-area {
                float: none;
                margin-left: auto;
                margin-right: auto;
            }
            .no-sidebar .site-main {
                margin-right: 0;
            }";
        }

        $custom .="
            @media screen and ( max-width: 1024px) {
                .widget-area{display:block;}
                .content-area {
                    float: none;
                    margin: 0;
                    width: 100%;
                }
                .site-main {
                    margin: 3rem 0 0;
                }
                .site-content .widget-area {
                    float: none;
                    width: auto;
                }

            }";

       
    }

    if( !empty($custom) ){ ?>

        <style id="custom_css">
            <?php echo esc_html($custom); ?>
        </style>

    <?php }
	
}

add_action('wp_head' ,'ivanicof_custom_styles');
