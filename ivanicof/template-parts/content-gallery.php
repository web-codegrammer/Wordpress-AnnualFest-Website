<?php
/**
 * Template part for displaying gallery posts
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
                edit_post_link( esc_html__( ' Edit', 'ivanicof' ), '<span class="edit-link">', '</span>' ); ?>
				
			</div><!-- .entry-meta -->
		<?php endif; ?>
		
    </header><!-- .entry-header -->
     
	<?php 
	
	if ( get_post_gallery(get_the_ID())) :
		
        echo '<div class="entry-gallery">';
			ivanicof_gallery_to_slider(get_post_gallery(get_the_ID(),false));
        echo '</div>';
	else:
		ivanicof_post_thumbnail();
	endif; ?>

	<div class="entry-content">
		<?php
		if(is_singular()){
			the_content( );
			ivanicof_entry_tags();
		}else{
			echo '<div class="read_more"><a href="'.esc_url(get_permalink()).'">'.esc_html__('Read More','ivanicof').'</a><i class="fa fa-angle-double-right"></i></div>';
		}

		wp_link_pages();
		?>
<footer class="entry-footer">
	
	<?php ivanicof_entry_comments();?>
</footer><!-- .entry-footer -->
	</div><!-- .entry-content -->

	
</article><!-- #post-<?php the_ID(); ?> -->

