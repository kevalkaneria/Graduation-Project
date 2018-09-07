<?php
/**
 * Team Section options
 *
 * @package Theme Palace
 * @subpackage Elead
 * @since Elead 0.1
 */

$wp_customize->add_section( 'elead_team', array(
	'title'             => esc_html__( 'Team','elead' ),
	'description'       => esc_html__( 'Team Section Options.', 'elead' ),
	'panel'             => 'elead_sections_panel',
) );

// team section enable setting and control.
$wp_customize->add_setting( 'elead_theme_options[team_enable]', array(
	'sanitize_callback'	=> 'elead_sanitize_checkbox',
	'default'          	=> $options['team_enable'],
) );

$wp_customize->add_control( 'elead_theme_options[team_enable]', array(
	'label'            	=> esc_html__( 'Enable Team Section', 'elead' ),
	'section'          	=> 'elead_team',
	'type'             	=> 'checkbox',
) );

// team section title setting and control.
$wp_customize->add_setting( 'elead_theme_options[team_section_title]', array(
	'sanitize_callback'	=> 'sanitize_text_field',
	'default'          	=> $options['team_section_title'],
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'elead_theme_options[team_section_title]', array(
	'label'            	=> esc_html__( 'Section Title', 'elead' ),
	'section'          	=> 'elead_team',
	'type'             	=> 'text',
	'active_callback'	=> 'elead_is_team_enable',
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'elead_theme_options[team_section_title]', array(
		'selector'            => '#team-members .entry-header h1.entry-title',
		'settings'            => 'elead_theme_options[team_section_title]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'elead_team_title',
    ) );
}

// team section subtitle setting and control.
$wp_customize->add_setting( 'elead_theme_options[team_section_subtitle]', array(
	'sanitize_callback'	=> 'sanitize_text_field',
	'default'          	=> $options['team_section_subtitle'],
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'elead_theme_options[team_section_subtitle]', array(
	'label'            	=> esc_html__( 'Section SubTitle', 'elead' ),
	'section'          	=> 'elead_team',
	'type'             	=> 'text',
	'active_callback'	=> 'elead_is_team_enable',
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'elead_theme_options[team_section_subtitle]', array(
		'selector'            => '#team-members .entry-header p.entry-title-desc',
		'settings'            => 'elead_theme_options[team_section_subtitle]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'elead_team_subtitle',
    ) );
}

// team section excerpt setting and control.
$wp_customize->add_setting( 'elead_theme_options[team_section_excerpt]', array(
	'sanitize_callback'	=> 'wp_kses_post',
	'default'          	=> $options['team_section_excerpt'],
) );

$wp_customize->add_control( 'elead_theme_options[team_section_excerpt]', array(
	'label'            	=> esc_html__( 'Section Description', 'elead' ),
	'section'          	=> 'elead_team',
	'type'             	=> 'textarea',
	'active_callback'	=> 'elead_is_team_enable',
) );

// team post hr setting and control
$wp_customize->add_setting( 'elead_theme_options[team_hr]', array(
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new Elead_Customize_Horizontal_Line( $wp_customize, 'elead_theme_options[team_hr]',
	array(
		'section'         => 'elead_team',
		'active_callback' => 'elead_is_team_enable',
		'type'			  => 'hr'
) ) );

// team section content type setting and control.
$wp_customize->add_setting( 'elead_theme_options[team_content_type]', array(
	'default'          	=> $options['team_content_type'],
	'sanitize_callback'	=> 'elead_sanitize_select',
) );

$wp_customize->add_control( 'elead_theme_options[team_content_type]', array(
	'label'            	=> esc_html__( 'Team Content Type', 'elead' ),
	'section'          	=> 'elead_team',
	'type'             	=> 'select',
	'active_callback'	=> 'elead_is_team_enable',
	'choices'			=> array(
            'post'      => esc_html__( 'Post', 'elead' ),
        ),
) );

// team section content type post setting and control.
$wp_customize->add_setting( 'elead_theme_options[team_content_post]', array(
	'sanitize_callback' => 'elead_sanitize_post_ids',
	'validate_callback' => 'elead_validate_post_id',
) );

$wp_customize->add_control( 'elead_theme_options[team_content_post]', array(
	'active_callback'	=> 'elead_is_team_enable',
	'label'             => esc_html__( 'Input Post Ids', 'elead' ),
	'description'       => esc_html__( 'Simply hover post title on dashboard to see the Post ID. Max no. of posts allowed is 4. ie: 11, 24, 34', 'elead' ),
	'section'           => 'elead_team',
	'type'				=> 'text'
) );