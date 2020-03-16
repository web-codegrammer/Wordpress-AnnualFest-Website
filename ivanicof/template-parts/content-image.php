<?php
/**
 * Template part for displaying image post
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
		
		if ( is_singular() ) :
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
                edit_post_link( esc_html__( ' Edit', 'ivanicof' ), '<span class="edit-link">', '</span>' ); 
                ?>
				
			</div><!-- .entry-meta -->
		<?php endif; ?>
		

	</header><!-- .entry-header -->
		
    <?php ivanicof_post_thumbnail();

    if( is_single() || '' === get_the_post_thumbnail()):?>
	
	<div class="entry-content">
	<?php	
		the_content();
		ivanicof_entry_tags();
        wp_link_pages();?>
    </div><!-- .entry-content -->
	<?php endif; ?>
	
</article><!-- #post-<?php the_ID(); ?> -->

