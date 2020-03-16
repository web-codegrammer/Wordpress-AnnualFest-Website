<?php
/**
 * Extend Recent Posts Widget 
 *
 * Adds different formatting to the default WordPress Recent Posts Widget
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

Class Ivanicof_Recent_Posts_Widget extends WP_Widget_Recent_Posts {

        function widget($args, $instance) {

            if ( ! isset( $args['widget_id'] ) ) {
                $args['widget_id'] = $this->id;
            }

            $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : esc_html__( 'Recent Posts' ,'ivanicof');

            /** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
            $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

            $number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 6;
            if ( ! $number ){
                $number = 6;
            }
                
            $show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;

            /**
             * Filter the arguments for the Recent Posts widget.
             *
             * @since 3.4.0
             *
             * @see WP_Query::get_posts()
             *
             * @param array $args An array of arguments used to retrieve the recent posts.
             */
            $r = new WP_Query( apply_filters( 'widget_posts_args', array(
                'posts_per_page'      => $number,
                'no_found_rows'       => true,
                'post_status'         => 'publish',
                'ignore_sticky_posts' => true
            ) ) );

            if ($r->have_posts()) :
            ?>
            <?php echo wp_kses_post($args['before_widget']); ?>
            <?php if ( $title ) {
                echo wp_kses_post($args['before_title']) . esc_html($title) . wp_kses_post($args['after_title']);
            } ?>
            <ul>
            <?php while ( $r->have_posts() ) : $r->the_post(); ?>
                <li>
                <a href="<?php the_permalink(); ?>">
                    <?php if(has_post_thumbnail()):
                            the_post_thumbnail('thumbnail'); 
                    endif; ?>
                    <div class="widget_info">
                        <?php get_the_title() ? the_title() : the_ID(); ?>
                        <?php if ( $show_date ) : ?>
                            <span class="post-date"><?php echo get_the_date('d M Y'); ?></span>
                        <?php endif; ?>
                    </div>
                    </a>
                </li>
            <?php endwhile; ?>
            </ul>
            <?php echo wp_kses_post($args['after_widget']); ?>
            <?php
            // Reset the global $the_post as this query will have stomped on it
            wp_reset_postdata();

            endif;
        }
}
// Enqueue css
add_action( 'wp_enqueue_scripts', 'ivanicof_wd_re_posts_style' );
function ivanicof_wd_re_posts_style() {
    wp_enqueue_style( 'ivanicof_re_widget_styles', trailingslashit(get_template_directory_uri()) . 'widgets/recent-posts/recent-posts.css' );
}

function ivanicof_recent_widget_registration() {
  unregister_widget('WP_Widget_Recent_Posts');
  register_widget('Ivanicof_Recent_Posts_Widget');
}
add_action('widgets_init', 'ivanicof_recent_widget_registration');