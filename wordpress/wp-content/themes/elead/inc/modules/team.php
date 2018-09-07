<?php 
/**
 * Team section
 *
 * This is the template for the content of team section
 *
 * @package Theme Palace
 * @subpackage Elead
 * @since Elead 0.1
 */
if ( ! function_exists( 'elead_add_team_section' ) ) :
    /**
    * Add team section
    *
    *@since Elead 0.1
    */
    function elead_add_team_section() {
        $options = elead_get_theme_options();

        // Check if team is enabled
        $enable_team = apply_filters( 'elead_section_status', true, 'team_enable' );

        if ( true !== $enable_team ) {
            return false;
        }

        // Get team section details
        $section_details = array();
        $section_details = apply_filters( 'elead_filter_team_section_details', $section_details );
        if ( empty( $section_details ) ) {
            return;
        }
        // Render team section now.
        elead_render_team_section( $section_details );
    }
endif;
add_action( 'elead_primary_content_action', 'elead_add_team_section', 70 );


if ( ! function_exists( 'elead_get_team_section_details' ) ) :
    /**
    * team section details.
    *
    * @since Elead 0.1
    * @param array $input team section details.
    */
    function elead_get_team_section_details( $input ) {
        $options = elead_get_theme_options();

        // team type
        $team_content_type  = $options['team_content_type'];

        switch ( $team_content_type ) {

            case 'post':
                $ids = array();
                
                if ( ! empty( $options['team_content_post'] ) )
                    $ids = ( array ) $options['team_content_post'];

                // Bail if no valid pages are selected.
                if ( empty( $ids ) ) {
                    return $input;
                }

                $args = array(
                    'no_found_rows'  => true,
                    'orderby'        => 'post__in',
                    'post_type'      => 'post',
                    'post__in'       => $ids,
                    'posts_per_page' => 4,
                );                             
            break;
        } 

        if ( ! empty( $args ) ) {
            $posts = get_posts( $args );
            if ( ! empty( $posts ) ) :
                $i = 1;
                foreach ( $posts as $post ) :
                    $post_id = $post->ID;
                    $img_array = array();
                    if ( has_post_thumbnail( $post_id ) ) {
                        $img_array = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'elead-medium' );
                    } else {
                        $img_array[0] =  get_template_directory_uri().'/assets/uploads/no-featured-image-500x500.jpg';
                        $img_array[1] =  400;
                        $img_array[2] =  400;
                    }

                    if ( isset( $img_array ) ) {
                        $content[$i]['img_array'] = $img_array;
                    }
                    $content[$i]['id']      = $post_id;
                    $content[$i]['title']   = get_the_title( $post_id );
                    $content[$i]['url']     = get_the_permalink( $post_id );
                    $i++;
                endforeach;
            endif;
        }

        if ( ! empty( $content ) ) {
            $input = $content;
        }
        return $input;
    }
endif;
// team section content details.
add_filter( 'elead_filter_team_section_details', 'elead_get_team_section_details' );


if ( ! function_exists( 'elead_render_team_section' ) ) :
    /**
    * Start team section
    *
    * @return string team content
    * @since Elead 0.1
    *
    */
    function elead_render_team_section( $content_details ) {
        $options    = elead_get_theme_options();
        $team_content_type  = $options['team_content_type'];
        $team_title      = ! empty( $options['team_section_title'] ) ? $options['team_section_title'] : '';
        $team_subtitle   = ! empty( $options['team_section_subtitle']  ) ? $options['team_section_subtitle']  : '';
        $team_excerpt    = ! empty( $options['team_section_excerpt']   ) ? $options['team_section_excerpt']   : '';

        if ( empty( $content_details ) ) {
            return;
        }
        ?>
        <section id="professional" class="page-section col-3">
            <div class="wrapper">
                <div class="row">
                    <div class="hentry">
                        <div class="professional-teacher align-left">
                            <header class="entry-header">
                                <?php if ( ! empty( $team_title ) ) : ?>
                                    <h2 class="entry-title"><?php echo esc_html( $team_title ); ?></h2>
                                <?php endif; 
                                if ( ! empty( $team_subtitle ) ) : ?>
                                    <p class="entry-title-desc"><?php echo esc_html( $team_subtitle ); ?></p>
                                <?php endif; ?>
                            </header>
                            <?php if ( ! empty( $team_excerpt ) ) : ?>
                                <div class="entry-content">
                                    <p><?php echo esc_html( $team_excerpt ); ?></p>
                                </div><!-- .entry-content -->
                            <?php endif; ?>
                        </div><!-- .professional-teacher -->
                    </div><!-- .hentry -->

                    <?php foreach ( $content_details as $content_detail ) : ?>
                        <div class="hentry">
                            <div class="professional-teacher">
                                <?php if( ! empty( $content_detail['img_array'][0] ) ) { ?>
                                    <a href="<?php echo ! empty( $content_detail['url'] ) ? esc_url( $content_detail['url'] ) : '#'; ?>"><img src="<?php echo esc_url( $content_detail['img_array'][0] ); ?>" width="<?php echo esc_attr( $content_detail['img_array'][1] ); ?>" height="<?php echo esc_attr( $content_detail['img_array'][2] ); ?>"></a>
                                <?php } ?>
                                <div class="hover-content">
                                    <?php if( ! empty( $content_detail['title'] ) ) { ?>
                                        <h5><a href="<?php echo ! empty( $content_detail['url'] ) ? esc_url( $content_detail['url'] ) : '#'; ?>"><?php echo esc_html( $content_detail['title'] ); ?></a></h5>
                                    <?php } ?>
                                </div><!-- .hover-content -->
                            </div><!-- .professional-teacher -->
                        </div><!-- .hentry -->
                    <?php endforeach; ?>
                </div><!-- .row -->
            </div><!-- .wrapper -->
        </section><!-- #professional -->
    <?php }
endif;
