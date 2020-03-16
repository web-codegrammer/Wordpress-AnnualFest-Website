<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package ivanicof
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
if(! function_exists( 'ivanicoft_entry_categories')):
	function ivanicof_entry_categories(){

		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ' * ', 'ivanicof' ) );
			if ( $categories_list ) {
				
				echo '<span class="cat-links">' . wp_kses_post($categories_list) . '</span>';
			}

			
		}
	}

endif;

if(! function_exists( 'ivanicoft_entry_tags')):

	function ivanicof_entry_tags(){
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( );
			if ( $tags_list ) {
				
				echo ' <span class="tags-links">' . wp_kses_post($tags_list) . '</span>';
			}
		}
	}

endif;

if ( ! function_exists( 'ivanicof_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function ivanicof_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = ' | <a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>';
		

		echo '<span class="posted-on">' . wp_kses_post($posted_on). '</span>';

	}
endif;

if ( ! function_exists( 'ivanicof_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function ivanicof_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'Written by %s', 'post author', 'ivanicof' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . wp_kses_post($byline) . '</span>'; 

	}
endif;

if ( ! function_exists( 'ivanicof_entry_comments' ) ) :
	/**
	 * Prints HTML with comments.
	 */
	function ivanicof_entry_comments() {
		
		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<footer class="entry-footer">';
			$post_link = esc_url(get_permalink());
			echo '<span class="comments-number"> <a href="' . esc_url($post_link) . '"><i class="fa fa-comment-o"></i> ';
			comments_number( '0', '1', '%' );
			echo '</a></span></footer>';
		}
		
	
	}
endif;

if ( ! function_exists( 'ivanicof_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function ivanicof_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail('ivanicof-featured-image'); ?>
			</div><!-- .post-thumbnail -->

		<?php else : 

			if ( '' !== get_the_post_thumbnail()) : ?>

			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
			
				<?php the_post_thumbnail( 'ivanicof-featured-image' ); ?>
			</a>

		<?php
			endif;
		endif; // End is_singular().
	}
endif;

if ( ! function_exists( 'ivanicof_post_format' ) ) :
	
	function ivanicof_post_format($format) {?>

		<div class="iv-formats">

		<?php if(is_sticky()):?>

			<div class="iv-format iv-sticky"><i class="fa fa-thumb-tack" aria-hidden="true"></i></div>							

		<?php endif; 

		switch($format){
			case "audio":
				echo '<a href="' . esc_url(get_post_format_link($format)) . '" class="iv-format" title="' . esc_html($format) . '"><i class="fa fa-volume-off" aria-hidden="true"></i></a>';
			break;
			case "video":
				echo '<a href="' . esc_url(get_post_format_link($format)) . '" class="iv-format" title="' . esc_html($format) . '"><i class="fa fa-video-camera" aria-hidden="true"></i></a>';
			break;
			case "quote":
				echo '<a href="' . esc_url(get_post_format_link($format)) . '" class="iv-format" title="' . esc_html($format) . '"><i class="fa fa-quote-left" aria-hidden="true"></i></a>';
			break;
			case "gallery":
				echo '<a href="' . esc_url(get_post_format_link($format)) . '" class="iv-format" title="' . esc_html($format) . '"><i class="fa fa-th" aria-hidden="true"></i></i></a>';
			break;
			case "image":
				echo '<a href="' . esc_url(get_post_format_link($format)) . '" class="iv-format" title="' . esc_html($format) . '"><i class="fa fa-picture-o" aria-hidden="true"></i></a>';
			break;
			case "link":
				echo '<a href="' . esc_url(get_post_format_link($format)).'" class="iv-format" title="' . esc_html($format) . '"><i class="fa fa-link" aria-hidden="true"></i></i></a>';
			break;
			default:
			break;
		}?>
		</div>
		<?php
	

	}
endif;

if ( ! function_exists( 'ivanicof_author_bio' ) ) :

	function ivanicof_author_bio( ) {
 
		global $post;
		 
		// Detect if it is a single post with a post author
		if ( is_single() && isset( $post->post_author ) ) {
		 
			// Get author's display name 
			$display_name = get_the_author_meta( 'display_name', $post->post_author );
			
			// If display name is not available then use nickname as display name
			if ( empty( $display_name ) ){

				$display_name = get_the_author_meta( 'nickname', $post->post_author );
			}
			
			// Get author's biographical information or description
			$user_description = get_the_author_meta( 'user_description', $post->post_author );
			
			// Get author's website URL 
			$user_website = get_the_author_meta('url', $post->post_author);
			
			// Get link to the author archive page
			$user_posts = get_author_posts_url( get_the_author_meta( 'ID' , $post->post_author));
			
			if ( ! empty( $display_name ) ){
				$author_details = sprintf('<h2 class="author_name">%1$s %2$s</h2>',esc_html__('About','ivanicof'),$display_name);
			}
			
						
			if ( ! empty( $user_description ) ){

				// Author avatar and bio
				$author_details .= '<p class="author_details">' . get_avatar( get_the_author_meta('user_email') , 90 ) . nl2br( $user_description ). '</p>';
				
			}

			$author_details .= sprintf('<p class="author_links"><a href="%1$s">%2$s %3$s</a>', $user_posts, esc_html__('View all posts by','ivanicof'), $display_name);  		
			
			// Check if author has a website in their profile
			if ( ! empty( $user_website ) ) {
			
				// Display author website link
				$author_details .= ' | <a href="' . $user_website .'" target="_blank" rel="nofollow">Website</a></p>';
			
			} else { 
				// if there is no author website then just close the paragraph
				$author_details .= '</p>';
			}
		 
				// Pass all this info to post content  
				$author_info = '<div class="author_bio_section" >' . $author_details . '</div>';
		}
			echo wp_kses_post($author_info);
	}
		 
	
endif;
