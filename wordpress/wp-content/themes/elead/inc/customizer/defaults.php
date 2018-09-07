<?php
/**
 * Customizer default options
 *
 * @package Theme Palace
 * @subpackage Elead
 * @since Elead 0.1
 * @return array An array of default values
 */

function elead_get_default_theme_options() {
	$theme_data = wp_get_theme();
	$elead_default_options = array(

		// Theme Options
		'enable_sticky_menu'			=> false,
		'site_layout'         			=> 'wide',
		'sidebar_position'         		=> 'right-sidebar',
		'read_more_text'		        => esc_html__( 'Read More', 'elead' ),
		'breadcrumb_enable'         	=> true,
		'pagination_enable'         	=> true,
		'pagination_type'         		=> 'default',
		'copyright_text'                => sprintf( _x( 'Copyright &copy; %1$s %2$s. All Rights Reserved', '1: Year, 2: Site Title with home URL', 'elead' ), '[the-year]', '[site-link]' ),
		'scroll_top_visible'        	=> true,
		'reset_options'      			=> false,
		'enable_frontpage_content' 		=> true,

		//single post options
		'author_box_enable'				=> true,
		'post_navigation_enable'		=> true,

		// Headline Section
		'headline_enable'				=> false,
		'headline_label'				=> esc_html__( 'News', 'elead' ),
		'headline_content_type'			=> 'post',
		'headline_social_enable'		=> true,
		'headline_social_link_1'		=> esc_url( 'http://facebook.com' ),
		'headline_social_link_2'		=> esc_url( 'http://twitter.com' ),
		'headline_social_link_3'		=> esc_url( 'http://instagram.com' ),
		'headline_social_link_4'		=> esc_url( 'http://plus.google.com' ),
		'headline_social_link_5'		=> esc_url( 'http://pinterest.com' ),

		// Slider Section
		'slider_enable'					=> false,
		'slider_content_type'			=> 'page',
		'slider_btn_label'				=> esc_html__( 'Read More', 'elead' ),

		// About Section
		'about_enable'					=> false,
		'about_content_type'			=> 'page',
		'about_custom_subtitle'			=> esc_html__( 'Know Who We Are', 'elead' ),
		
		// Service Section
		'service_enable'				=> false,
		'service_section_title'			=> esc_html__( 'We are best for you', 'elead' ),
		'service_section_subtitle'		=> esc_html__( 'Our Quality Services', 'elead' ),
		'service_content_type'			=> 'post',

		// Courses Section
		'courses_enable'				=> false,
		'courses_content_type'			=> 'post',
		'courses_title'					=> esc_html__( 'Learn With Us', 'elead' ),
		'courses_sub_title'				=> esc_html__( 'Our Courses', 'elead' ),
		// call to action section
		'call_to_action_enable'			=> false,
		'call_to_action_title'			=> esc_html__( 'Choose Your Own Path', 'elead' ),
		'call_to_action_sub_title'		=> esc_html__( 'Build your career with us', 'elead' ),
		'call_to_action_btn_label_1'	=> esc_html__( 'Start Learning', 'elead' ),
		'call_to_action_btn_label_2'	=> esc_html__( 'Find Courses', 'elead' ),
		'call_to_action_btn_url_1'		=> '#',
		'call_to_action_btn_url_2'		=> '#',
		
		// team
		'team_enable'					=> false,
		'team_section_title'			=> esc_html__( 'Professional Teachers', 'elead' ),
		'team_section_subtitle'			=> esc_html__( 'Our Qualified Manpower', 'elead' ),
		'team_content_type'				=> 'post',
		'team_section_excerpt'			=> esc_html__( 'Pellentesque dui lectus, elementum non consectetur sed, lobortis sed dui. Ut facilisis metus eu vulputate fermentum. Phasellus nulla velit, lobortis ac faucibus id, maximus eu sapien.', 'elead' ),

		// social
		'social_enable'					=> true,
		'social_entire_site_enable'		=> false,
		'social_title_link_1'			=> esc_url( 'http://facebook.com' ),
		'social_title_link_2'			=> esc_url( 'http://twitter.com' ),
		'social_title_link_3'			=> esc_url( 'http://instagram.com' ),
		'social_title_link_4'			=> esc_url( 'http://plus.google.com' ),
		'social_title_link_5'			=> esc_url( 'http://pinterest.com' ),
	);

	$output = apply_filters( 'elead_default_theme_options', $elead_default_options );
	// Sort array in ascending order, according to the key:
	if ( ! empty( $output ) ) {
		ksort( $output );
	}

	return $output;
}