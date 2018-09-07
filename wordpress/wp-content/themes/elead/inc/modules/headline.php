<?php 
/**
 * Headline section
 *
 * This is the template for the content of headline section
 *
 * @package Theme Palace
 * @subpackage Elead
 * @since Elead 0.1
 */
if ( ! function_exists( 'elead_add_headline_section' ) ) :
    /**
    * Add headline section
    *
    *@since Elead 0.1
    */
    function elead_add_headline_section() {
        $options = elead_get_theme_options();

        // Check if headline is enabled
        $enable_headline = $options['headline_enable'];

        if ( true !== $enable_headline ) {
            return false;
        }

        // Get headline section details
        $section_details = array();
        $section_details = apply_filters( 'elead_filter_headline_section_details', $section_details );
        if ( empty( $section_details ) ) {
            return;
        }
        // Render headline section now.
        elead_render_headline_section( $section_details );
    }
endif;
add_action( 'elead_header_action', 'elead_add_headline_section', 5 );


if ( ! function_exists( 'elead_get_headline_section_details' ) ) :
    /**
    * headline section details.
    *
    * @since Elead 0.1
    * @param array $input headline section details.
    */
    function elead_get_headline_section_details( $input ) {
        $options = elead_get_theme_options();

        // headline type
        $headline_content_type  = $options['headline_content_type'];

        $content = array();
        switch ( $headline_content_type ) {    

            case 'post':
                $ids = array();
                
                if ( ! empty( $options['headline_content_post'] ) )
                    $ids = ( array ) $options['headline_content_post'];

                // Bail if no valid pages are selected.
                if ( empty( $ids ) ) {
                    return $input;
                }

                $args = array(
                    'no_found_rows'  => true,
                    'orderby'        => 'post__in',
                    'post_type'      => 'post',
                    'post__in'       => $ids,
                    'posts_per_page' => 5,
                );                             
          	break;
        }

        if ( ! empty( $args ) ) {
            $posts = get_posts( $args );
        }

        if ( ! empty( $posts ) ) :
            $i = 1;
            foreach ( $posts as $post ) :
                $post_id = $post->ID;
                $content[$i]['title']   = get_the_title( $post_id );
                $content[$i]['url']     = get_the_permalink( $post_id );
                $i++;
            endforeach;
        endif;

        if ( ! empty( $content ) ) {
            $input = $content;
        }
        return $input;
    }
endif;
// headline section content details.
add_filter( 'elead_filter_headline_section_details', 'elead_get_headline_section_details' );


if ( ! function_exists( 'elead_render_headline_section' ) ) :
    /**
    * Start headline section
    *
    * @return string headline content
    * @since Elead 0.1
    *
    */
    function elead_render_headline_section( $content_details ) {
        $options = elead_get_theme_options();
        if ( empty( $content_details ) ) {
            return;
        }
        $i = 1;
        ?>
        <div id="topbar-widget-wrapper">
            <div class="wrapper">
                <div class="top-bar clear">
                    <div class="spacer"></div>
                    <div id="news-ticker">
                        <?php if ( ! empty( $options['headline_label'] ) ) : ?>
                            <div class="news-title">
                                <h2 class="news-ticker-label"><?php echo esc_html( $options['headline_label'] ); ?></h2>
                            </div><!-- .news-title -->
                        <?php endif; ?>

                        <div class="news-ticker-slider" data-slick='{"slidesToShow": 1, "slidesToScroll": 1, "infinite": true, "speed": 800, "dots": false, "arrows":false, "autoplay": true,  "vertical": true, "fade": false, "draggable": true }'>
                            <?php foreach ( $content_details as $content_detail ) : 
                            if( 1 === $i ) {
                                $addheadlineclass = 'display-block';
                            } else {
                                $addheadlineclass = 'display-none';
                            } ?>
                                <div class="slick-item <?php echo esc_attr( $addheadlineclass ); ?>">
                                    <h2 class="news-ticker-title">
                                        <a href="<?php echo esc_url( $content_detail['url'] ); ?>"><?php echo esc_html( $content_detail['title'] ); ?></a>
                                    </h2>
                                </div><!-- .slick-item -->
                            <?php $i++;
                            endforeach; ?>
                        </div><!-- .news-ticker-slider -->
                    </div><!-- #news-ticker -->
                    <?php if ( true == $options['headline_social_enable'] ) : ?>
                        <ul class="social-icons">
                            <?php for ( $i = 1; $i <= 5; $i++ ) : 
                                $social_link = $options['headline_social_link_' . $i];
                                if ( ! empty( $social_link ) ) :
                                ?>
                                    <li><a href="<?php echo esc_url( $social_link ); ?>" target="_blank"></a></li>
                                <?php endif; 
                            endfor; ?>
                        </ul><!-- .social-icons -->
                    <?php endif; ?>
                </div><!-- .top-bar -->
            </div><!-- .wrapper -->
        </div><!-- .topbar-widget-wrapper -->
    <?php }
endif;