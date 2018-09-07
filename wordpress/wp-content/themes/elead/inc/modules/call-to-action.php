<?php 
/**
 * Call to action section
 *
 * This is the template for the content of call to action section
 *
 * @package Theme Palace
 * @subpackage Elead
 * @since Elead 0.1
 */
if ( ! function_exists( 'elead_add_call_to_action_section' ) ) :
    /**
    * Add call to action section
    *
    *@since Elead 0.1
    */
    function elead_add_call_to_action_section() {
        $options = elead_get_theme_options();

        // Check if call_to_action is enabled
        $enable_call_to_action = apply_filters( 'elead_section_status', true, 'call_to_action_enable' );

        if ( true !== $enable_call_to_action ) {
            return false;
        }

        // Render call to action section now.
        elead_render_call_to_action_section();
    }
endif;
add_action( 'elead_primary_content_action', 'elead_add_call_to_action_section', 50 );

if ( ! function_exists( 'elead_render_call_to_action_section' ) ) :
    /**
    * Start call to action section
    *
    * @return string call_to_action content
    * @since Elead 0.1
    *
    */
    function elead_render_call_to_action_section() {
        $options = elead_get_theme_options();
        $title = ! empty( $options['call_to_action_title'] ) ? $options['call_to_action_title'] : '';
        $sub_title = ! empty( $options['call_to_action_sub_title'] ) ? $options['call_to_action_sub_title'] : '';
        $btn_label_1 = ! empty( $options['call_to_action_btn_label_1'] ) ? $options['call_to_action_btn_label_1'] : '';
        $btn_url_1 = ! empty( $options['call_to_action_btn_url_1'] ) ? $options['call_to_action_btn_url_1'] : '';
        $btn_lable_2 = ! empty( $options['call_to_action_btn_label_2'] ) ? $options['call_to_action_btn_label_2'] : '';
        $btn_url_2 = ! empty( $options['call_to_action_btn_url_2'] ) ? $options['call_to_action_btn_url_2'] : '';
        ?>
        <section id="promotion" class="page-section align-center parallax" style="background-image:url('<?php echo esc_url( get_template_directory_uri() . '/assets/uploads/promotion.jpg' ); ?>')" data-stellar-background-ratio="0.5" data-stellar-vertical-offset="0">
            <div class="wrapper">
                <?php if ( ! empty( $title ) ) : ?>
                <header class="entry-header">
                    <?php if ( ! empty( $title ) ) : ?>
                        <h2 class="entry-title"><?php echo esc_html( $title ); ?></h2>
                    <?php endif;
                    if ( ! empty( $sub_title ) ) : ?>
                        <p class="entry-title-desc"><?php echo esc_html( $sub_title ); ?></p>
                    <?php endif; ?>
                </header>
                <?php endif; ?>
                <?php if ( ! empty( $btn_url_1 ) ) : ?>
                    <div class="view-more">
                        <?php if ( ! empty( $btn_url_1 ) ) : ?>
                            <a href="<?php echo esc_url( $btn_url_1 ); ?>" class="btn btn-fill"><?php echo esc_html( $btn_label_1 ); ?></a>
                        <?php endif; ?>
                        <?php if ( ! empty( $btn_url_2 ) ) : ?>
                            <a href="<?php echo esc_url( $btn_url_2 ); ?>" class="btn btn-transparent"><?php echo esc_html( $btn_lable_2 ); ?></a>
                        <?php endif; ?>
                    </div><!-- .view-more -->
                <?php endif; ?>
            </div><!-- .wrapper -->
        </section><!-- #promotion -->
    <?php }
endif;
