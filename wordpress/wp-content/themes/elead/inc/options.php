<?php
/**
 * elead options
 *
 * @package Theme Palace
 * @subpackage Elead
 * @since Elead 0.1
 */

if ( ! function_exists( 'elead_site_layout' ) ) :
    /**
     * Site Layout
     * @return array site layout options
     */
    function elead_site_layout() {
        $elead_site_layout = array(
            'wide'  => esc_html__( 'Wide', 'elead' ),
            'boxed' => esc_html__( 'Boxed', 'elead' ),
        );

        $output = apply_filters( 'elead_site_layout', $elead_site_layout );

        return $output;
    }
endif;


if ( ! function_exists( 'elead_sidebar_position' ) ) :
    /**
     * Sidebar position
     * @return array Sidbar positions
     */
    function elead_sidebar_position() {
        $elead_sidebar_position = array(
            'right-sidebar' => esc_html__( 'Right', 'elead' ),
            'no-sidebar'    => esc_html__( 'No Sidebar', 'elead' ),
        );

        $output = apply_filters( 'elead_sidebar_position', $elead_sidebar_position );

        return $output;
    }
endif;


if ( ! function_exists( 'elead_selected_sidebar' ) ) :
    /**
     * Sidebar selected
     * @return array Sidbar selected
     */
    function elead_selected_sidebar() {
        $elead_selected_sidebar = array(
            'sidebar-1'                 => esc_html__( 'Primary Sidebar', 'elead' ),
            'elead-optional-sidebar'    => esc_html__( 'Optional Sidebar 1', 'elead' ),
        );

        $output = apply_filters( 'elead_selected_sidebar', $elead_selected_sidebar );

        return $output;
    }
endif;


if ( ! function_exists( 'elead_header_image' ) ) :
    /**
     * Header image options
     * @return array Header image options
     */
    function elead_header_image() {
        $elead_header_image = array(
            'show-both' => esc_html__( 'Show Both( Featured and Header Image )', 'elead' ),
            'enable'    => esc_html__( 'Enable( Featured Image )', 'elead' ),
            'default'   => esc_html__( 'Default ( Customizer Header Image )', 'elead' ),
        );

        $output = apply_filters( 'elead_header_image', $elead_header_image );

        return $output;
    }
endif;

if ( ! function_exists( 'elead_pagination_options' ) ) :
    /**
     * Pagination
     * @return array site pagination options
     */
    function elead_pagination_options() {
        $elead_pagination_options = array(
            'numeric'  => esc_html__( 'Numeric', 'elead' ),
            'default'  => esc_html__( 'Default(Older/Newer)', 'elead' ),
        );

        $output = apply_filters( 'elead_pagination_options', $elead_pagination_options );

        return $output;
    }
endif;