<?php
/**
 * Template part for displaying video posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ivanicof
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		
		if ( is_single() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			
			ivanicof_entry_categories();
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			ivanicof_post_format(get_post_format());
		
		endif;

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php
				ivanicof_posted_by();
				ivanicof_posted_on();
				edit_post_link( esc_html__( ' Edit', 'ivanicof' ), '<span class="edit-link">', '</span>' ); ?>
				
			</div><!-- .entry-meta -->
		<?php endif; ?>
		

	</header><!-- .entry-header -->
	<?php
		$content = apply_filters( 'the_content', get_the_content() );
		$video   = false;

		// Only get video from the content if a playlist isn't present.
	if ( false === strpos( $content, 'wp-playlist-script' ) ) {
		$video = get_media_embedded_in_content( $content, array( 'video', 'object', 'embed', 'iframe' ) );
	}
	 	
	if ( ! is_single() ) :
		if(! empty($video) ):
			foreach ( $video as $video_html ) {
				echo '<div class="entry-video">';
					echo $video_html;
				echo '</div>';
			}
		else:
			ivanicof_post_thumbnail();
		endif; 
	endif;

	if(is_single()): ?>

	<div class="entry-content">
		<?php
		
			the_content();
			ivanicof_entry_tags();
			wp_link_pages();
		?>

	</div><!-- .entry-content -->
<?php endif; ?>

	
</article><!-- #post-<?php the_ID(); ?> -->

