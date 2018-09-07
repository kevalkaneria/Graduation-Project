<?php 
/**
 * About section
 *
 * This is the template for the content of about section
 *
 * @package Theme Palace
 * @subpackage Elead
 * @since Elead 0.1
 */
if ( ! function_exists( 'elead_add_about_section' ) ) :
    /**
    * Add about section
    *
    *@since Elead 0.1
    */
    function elead_add_about_section() {
        $options = elead_get_theme_options();

        // Check if about is enabled
        $enable_about = apply_filters( 'elead_section_status', true, 'about_enable' );

        if ( true !== $enable_about ) {
            return false;
        }

        // Get about section details
        $section_details = array();
        $section_details = apply_filters( 'elead_filter_about_section_details', $section_details );
        if ( empty( $section_details ) ) {
            return;
        }
        // Render about section now.
        elead_render_about_section( $section_details );
    }
endif;
add_action( 'elead_primary_content_action', 'elead_add_about_section', 20 );


if ( ! function_exists( 'elead_get_about_section_details' ) ) :
    /**
    * about section details.
    *
    * @since Elead 0.1
    * @param array $input about section details.
    */
    function elead_get_about_section_details( $input ) {
        $options = elead_get_theme_options();

        // about type
        $about_content_type  = $options['about_content_type'];

        $content = array();
        switch ( $about_content_type ) {

            case 'page':
                $page_id = '';
                
                if ( ! empty( $options['about_content_page'] ) )
                    $page_id = absint( $options['about_content_page'] );

                // Bail if no valid pages are selected.
                if ( empty( $page_id ) ) {
                    return $input;
                }

                $img_array = null;
                if ( has_post_thumbnail( $page_id ) ) {
                    $img_array = wp_get_attachment_image_src( get_post_thumbnail_id( $page_id ), 'full' );
                } else {
                    $img_array[0] =  get_template_directory_uri().'/assets/uploads/no-featured-image-500x500.jpg';
                }
                if ( isset( $img_array ) ) {
                    $content[0]['img_array'] = $img_array;
                }
                $content[0]['title']    = get_the_title( $page_id );
                $content[0]['url']      = get_the_permalink( $page_id );
                $content[0]['excerpt']  = get_post_field( 'post_content', $page_id );
                $content[0]['trim_excerpt']  = elead_trim_content( 50, get_post( $page_id ) );
                                            
            break;
        }

        if ( ! empty( $content ) ) {
            $input = $content;
        }
        return $input;
    }
endif;
// about section content details.
add_filter( 'elead_filter_about_section_details', 'elead_get_about_section_details' );

if ( ! function_exists( 'elead_render_about_section' ) ) :
    /**
    * Start about section
    *
    * @return string about content
    * @since Elead 0.1
    *
    */
    function elead_render_about_section( $content_details ) {
        $options = elead_get_theme_options();
        $about_content_type  = $options['about_content_type'];
        $about_subtitle  = ! empty( $options['about_custom_subtitle'] ) ? $options['about_custom_subtitle'] : '';
        $readmore   = ! empty( $options['read_more_text'] ) ? $options['read_more_text'] : esc_html__( 'Read More', 'elead' );

        if ( empty( $content_details ) ) {
            return;
        }

        foreach ( $content_details as $content_detail ) : ?>
        
        <section id="about" class="col-2">
            <div class="wrapper page-section">
                <div class="row">
                    <div class="hentry about-header">
                    <?php if( ! empty( $content_detail['title'] ) || ! empty( $about_subtitle ) ) : ?>
                        <header class="entry-header">
                            <?php if( ! empty( $content_detail['title'] ) ) { ?>
                                <h2 class="entry-title"><?php echo esc_html( $content_detail['title'] ); ?></h2>
                            <?php } 
                            if ( ! empty( $about_subtitle ) ) : ?>
                                <p class="entry-title-desc"><?php echo esc_html( $about_subtitle ); ?></p>
                            <?php endif; ?>
                        </header><!-- .entry-header -->
                    <?php endif; ?>           
                    </div><!-- .hentry -->

                    <div class="hentry">
                        <div class="about-image-wrapper clear">
                            <div class="image-wrap single-image">
                                <div class="featured-image" style="background-image:url('<?php echo esc_url( $content_detail['img_array'][0] ); ?>')">
                                </div><!-- .featured-image -->
                            </div><!-- .image-wrap -->
                        </div><!-- .about-image-wrapper -->                        
                    </div><!-- .hentry -->

                    <div class="hentry about-content">
                        <div class="entry-content">
                            <?php if( ! empty( $content_detail['trim_excerpt'] ) ) : ?>
                                <p><?php echo wp_kses_post( $content_detail['trim_excerpt'] ); ?></p>
                            <?php endif;
                            if( ! empty( $readmore ) ) : ?>
                                <a href="<?php echo ! empty( $content_detail['url'] ) ? esc_url( $content_detail['url'] ) : '#'; ?>" class="btn btn-transparent"><?php echo esc_html( $readmore ); ?></a>
                            <?php endif; ?>
                        </div><!-- .entry-content -->
                    </div><!-- .hentry -->
                </div><!-- .row -->
            </div><!-- .wrapper -->
            <div class="page-decoration">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/uploads/decoration.png' ); ?>" alt="<?php esc_attr__( 'Decoration','elead' ); ?>">
            </div>
        </section><!-- #hero-section -->
        <?php endforeach;
    }
endif;