<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package ivanicof
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<section class="not-found">
				<header class="page-header">
					<h1>404 <span>error</span></h1>
					<h2 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'ivanicof' ); ?></h2>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'ivanicof' ); ?></p>

					<?php get_search_form(); ?>
					
				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
