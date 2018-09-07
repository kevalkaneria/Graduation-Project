<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Theme Palace
 * @subpackage Elead
 * @since Elead 0.1
 */

/**
 * elead_content_end_action hook
 * @hooked elead_add_social_section - 5
 * @hooked elead_content_end -  10
 *
 */
do_action( 'elead_content_end_action' );

/**
 * elead_footer hook
 *
 * @hooked elead_footer_start -  10
 * @hooked elead_footer_widget -  20
 * @hooked elead_footer_site_info -  30
 * @hooked elead_footer_end -  40
 * @hooked elead_scroll_up -  50
 *
 */
do_action( 'elead_footer' );

/**
 * elead_page_end_action hook
 *
 * @hooked elead_page_end -  10
 *
 */
do_action( 'elead_page_end_action' ); 
?>

<?php wp_footer(); ?>

</body>
</html>
