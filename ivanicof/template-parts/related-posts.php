<?php
/**
 * Template part for displaying related posts
 *
 *
 * @package ivanicof
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
 // Get a list of the current post's categories
 global $post;
 $categories = get_the_category( $post->ID );
 $catidlist = '';
 foreach( $categories as $category) {
     $catidlist .= $category->cat_ID . ",";
 }

 // Build our category based custom query arguments
  $custom_query_args = array( 
     'posts_per_page' => 20, // Number of related posts to display
     'post__not_in' => array($post->ID), // Ensure that the current post is not displayed
     'orderby' => 'rand', // Randomize the results
     'cat' => $catidlist, // Select posts in the same categories as the current post
 );

 // Initiate the custom query
 $custom_query = new WP_Query( $custom_query_args );

 
 // Run the loop and output data for the results
 if ( $custom_query->have_posts() ) : 

    echo '<div class="slider-wrap"><h2 class="flexslider-title">'.esc_html__('Related Posts','ivanicof').'</h2>';?>
 
 <div class="flexslider ">
    <ul class="slides">

    <?php while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>
                
     <li>
        <?php 
            if(!has_post_thumbnail() || '' == get_the_post_thumbnail()):?>

                <img src="<?php echo esc_url(get_template_directory_uri() .'/assets/images/300.png');?>" alt="">
                
        <?php else:
                the_post_thumbnail('thumbnail'); 
            
            endif; ?>
        <a href="<?php echo esc_url(get_the_permalink()); ?>" class="flex-caption"><?php the_title('<h3>','</h3>'); ?></a>
       
     </li>
    <?php endwhile; 
    // Reset postdata
    wp_reset_postdata();?>
    </ul>
 </div>
 <?php endif; ?>
    
