<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ivanicof
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php 
if ( function_exists( 'wp_body_open' ) ) {
    wp_body_open();
} else {
    do_action( 'wp_body_open' );
}?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'ivanicof' ); ?></a>
 
	<header id="masthead" class="site-header">
		<div class="wrap-image" style="background-image: url( <?php echo esc_url(get_header_image()); ?> );"> 
			<div class="<?php echo get_header_image() ? 'header-image-overlap':'';?>">
				<div class="site-branding <?php echo get_header_image() ? 'has-header-image':''; ?>">
					<?php
						if( get_theme_mod('ivanicof_header_social_icons',ivanicof_setting_default('ivanicof_header_social_icons'))):
							do_action( 'ivanicof_social_icons');
						endif;
						the_custom_logo();
						$ivanicof_description = get_bloginfo( 'description', 'display' );
						if ( $ivanicof_description || is_customize_preview() ) :
							?>
							<p class="site-description"><?php echo esc_html($ivanicof_description); ?></p>
						<?php endif; 
						if ( is_front_page() && is_home() ) :
							?>
							<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
							<?php
						else :
							?>
							<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
							<?php
						endif;

						if( get_theme_mod('ivanicof_header_search_form',ivanicof_setting_default('ivanicof_header_search_form'))):
							get_search_form();
						endif;
						

						if( get_header_image() && get_theme_mod('ivanicof_header_button_down',ivanicof_setting_default('ivanicof_header_button_down'))):?>
							<span id="button-down"></span>
						<?php endif;
					?>
				</div><!-- .site-branding -->
			</div>
		</div>
		<a id="menu_button" class="menu-toggle fa fa-bars" href="#"></a>
		<nav id="site-navigation" class="main-navigation">
		
			<a id="close-button" href="#" class="fa fa-times" aria-hidden="true"></a> 
			
			<?php
			wp_nav_menu( array(
				'theme_location' => 'menu-1',
				'menu_id'        => 'primary-menu',
			) );
			?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
