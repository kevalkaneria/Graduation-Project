<?php
/**
 * Customizer active callbacks
 *
 * @package Theme Palace
 * @subpackage Elead
 * @since Elead 0.1
 */

if ( ! function_exists( 'elead_is_pagination_enable' ) ) :
	/**
	 * Check if pagination is enabled.
	 *
	 * @since Elead 0.1
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function elead_is_pagination_enable( $control ) {
		return $control->manager->get_setting( 'elead_theme_options[pagination_enable]' )->value();
	}
endif;

if ( ! function_exists( 'elead_is_headline_enable' ) ) :
	/**
	 * Check if headline is enabled.
	 *
	 * @since Elead 0.1
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function elead_is_headline_enable( $control ) {
		return $control->manager->get_setting( 'elead_theme_options[headline_enable]' )->value();
	}
endif;

if ( ! function_exists( 'elead_is_social_headline_enable' ) ) :
	/**
	 * Check if headline is enabled.
	 *
	 * @since Elead 0.1
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function elead_is_social_headline_enable( $control ) {
		$content_type = $control->manager->get_setting( 'elead_theme_options[headline_social_enable]' )->value();
		if ( elead_is_headline_enable( $control ) &&  true === $content_type )
			return true;
		else
			return false;
	}
endif;

if ( ! function_exists( 'elead_is_slider_enable' ) ) :
	/**
	 * Check if slider is enabled.
	 *
	 * @since Elead 0.1
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function elead_is_slider_enable( $control ) {
		return $control->manager->get_setting( 'elead_theme_options[slider_enable]' )->value();
	}
endif;

if ( ! function_exists( 'elead_is_about_enable' ) ) :
	/**
	 * Check if about is enabled.
	 *
	 * @since Elead 0.1
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function elead_is_about_enable( $control ) {
		return $control->manager->get_setting( 'elead_theme_options[about_enable]' )->value();
	}
endif;

if ( ! function_exists( 'elead_is_service_enable' ) ) :
	/**
	 * Check if service is enabled.
	 *
	 * @since Elead 0.1
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function elead_is_service_enable( $control ) {
		return $control->manager->get_setting( 'elead_theme_options[service_enable]' )->value();
	}
endif;

if ( ! function_exists( 'elead_is_courses_enable' ) ) :
	/**
	 * Check if courses is enabled.
	 *
	 * @since Elead 0.1
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function elead_is_courses_enable( $control ) {
		return $control->manager->get_setting( 'elead_theme_options[courses_enable]' )->value();
	}
endif;

if ( ! function_exists( 'elead_is_call_to_action_enable' ) ) :
	/**
	 * Check if call to action is enabled.
	 *
	 * @since Elead 0.1
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function elead_is_call_to_action_enable( $control ) {
		return $control->manager->get_setting( 'elead_theme_options[call_to_action_enable]' )->value();
	}
endif;

if ( ! function_exists( 'elead_is_team_enable' ) ) :
	/**
	 * Check if team is enabled.
	 *
	 * @since Elead 0.1
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function elead_is_team_enable( $control ) {
		return $control->manager->get_setting( 'elead_theme_options[team_enable]' )->value();
	}
endif;

if ( ! function_exists( 'elead_is_social_enable' ) ) :
	/**
	 * Check if social is enabled.
	 *
	 * @since Elead 0.1
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function elead_is_social_enable( $control ) {
		return $control->manager->get_setting( 'elead_theme_options[social_enable]' )->value();
	}
endif;