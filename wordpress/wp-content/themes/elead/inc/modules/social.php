<?php 
/**
 * Social section
 *
 * This is the template for the content of social section
 *
 * @package Theme Palace
 * @subpackage Elead
 * @since Elead 0.1
 */
if ( ! function_exists( 'elead_add_social_section' ) ) :
    /**
    * Add social section
    *
    *@since Elead 0.1
    */
    function elead_add_social_section() {
        $options = elead_get_theme_options();

        // Check if social is enabled
        $enable_social = apply_filters( 'elead_section_status', true, 'social_enable' );
        if ( is_front_page() ) {
            if ( true !== $enable_social ) {
                return false;
            }
        } else {
            if ( true !== $options['social_enable'] || true !== $options['social_entire_site_enable'] )
                return false;
        }

        // Render social section now.
        elead_render_social_section();
    }
endif;
add_action( 'elead_content_end_action', 'elead_add_social_section', 5 );

if ( ! function_exists( 'elead_render_social_section' ) ) :
    /**
    * Start social section
    *
    * @return string social content
    * @since Elead 0.1
    *
    */
    function elead_render_social_section() {
        $options    = elead_get_theme_options();
        
        ?>
        <section id="social-medias">
            <div class="wrapper">
                <ul class="social-icons">
                    <?php for ( $i = 1; $i <= 5; $i++ ) : 
                        $social_link = $options['social_title_link_' . $i];
                        if ( ! empty( $social_link ) ) :
                        ?>
                            <li><a href="<?php echo esc_url( $social_link ); ?>" target="_blank"></a></li>
                        <?php endif; 
                    endfor; ?>
                </ul><!-- .social-icons -->
            </div><!-- .wrapper -->
        </section><!-- #social-medias -->
    <?php }
endif;
