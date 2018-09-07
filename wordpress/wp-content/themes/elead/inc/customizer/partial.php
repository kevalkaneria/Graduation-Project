<?php
/**
 * Partial functions
 *
 * @package Theme Palace
 * @subpackage Elead
 * @since Elead 0.1
 */

if ( ! function_exists( 'elead_about_sub_title' ) ) :
	// about label
	function elead_about_sub_title() {
		$options = elead_get_theme_options();
		return esc_html( $options['about_custom_subtitle'] );
	}
endif;

if ( ! function_exists( 'elead_service_title' ) ) :
	// service label
	function elead_service_title() {
		$options = elead_get_theme_options();
		return esc_html( $options['service_section_title'] );
	}
endif;

if ( ! function_exists( 'elead_service_sub_title' ) ) :
	// service label
	function elead_service_sub_title() {
		$options = elead_get_theme_options();
		return esc_html( $options['service_section_subtitle'] );
	}
endif;

if ( ! function_exists( 'elead_courses_title' ) ) :
	// courses label
	function elead_courses_title() {
		$options = elead_get_theme_options();
		return esc_html( $options['courses_title'] );
	}
endif;

if ( ! function_exists( 'elead_courses_subtitle' ) ) :
	// courses label
	function elead_courses_subtitle() {
		$options = elead_get_theme_options();
		return esc_html( $options['courses_sub_title'] );
	}
endif;

if ( ! function_exists( 'elead_call_to_action_title' ) ) :
	// call to action label
	function elead_call_to_action_title() {
		$options = elead_get_theme_options();
		return esc_html( $options['call_to_action_title'] );
	}
endif;

if ( ! function_exists( 'elead_call_to_action_sub_title' ) ) :
	// call to action label
	function elead_call_to_action_sub_title() {
		$options = elead_get_theme_options();
		return esc_html( $options['call_to_action_sub_title'] );
	}
endif;

if ( ! function_exists( 'elead_team_subtitle' ) ) :
	// team label
	function elead_team_subtitle() {
		$options = elead_get_theme_options();
		return esc_html( $options['team_section_title'] );
	}
endif;

if ( ! function_exists( 'elead_team_subtitle' ) ) :
	// team label
	function elead_team_subtitle() {
		$options = elead_get_theme_options();
		return esc_html( $options['team_section_subtitle'] );
	}
endif;

if ( ! function_exists( 'elead_copyright_text_callback' ) ) :
	// testimonial label
	function elead_copyright_text_callback() {
		$options = elead_get_theme_options();
		return esc_html( $options['copyright_text'] );
	}
endif;

if ( ! function_exists( 'elead_blog_title' ) ) :
	// testimonial label
	function elead_blog_title() {
		$options = elead_get_theme_options();
		return esc_html( $options['blog_section_title'] );
	}
endif;

if ( ! function_exists( 'elead_blog_sub_title' ) ) :
	// testimonial label
	function elead_blog_sub_title() {
		$options = elead_get_theme_options();
		return esc_html( $options['blog_section_subtitle'] );
	}
endif;