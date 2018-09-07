<?php
/**
 * Layout options
 *
 * @package Theme Palace
 * @subpackage Elead
 * @since Elead 0.1
 */

// Add sidebar section
$wp_customize->add_section( 'elead_layout', array(
	'title'               => esc_html__('Layout','elead'),
	'description'         => esc_html__( 'Layout section options.', 'elead' ),
	'panel'               => 'elead_theme_options_panel',
) );

// Sidebar position setting and control.
$wp_customize->add_setting( 'elead_theme_options[sidebar_position]', array(
	'sanitize_callback'   => 'elead_sanitize_select',
	'default'             => $options['sidebar_position'],
) );

$wp_customize->add_control( 'elead_theme_options[sidebar_position]', array(
	'label'               => esc_html__( 'Sidebar Position', 'elead' ),
	'section'             => 'elead_layout',
	'type'                => 'select',
	'choices'			  => elead_sidebar_position(),
) );

// Site layout setting and control.
$wp_customize->add_setting( 'elead_theme_options[site_layout]', array(
	'sanitize_callback'   => 'elead_sanitize_select',
	'default'             => $options['site_layout'],
) );

$wp_customize->add_control( 'elead_theme_options[site_layout]', array(
	'label'               => esc_html__( 'Site Layout', 'elead' ),
	'section'             => 'elead_layout',
	'type'                => 'select',
	'choices'			  => elead_site_layout(),
) );

// sticky menu custom post hr setting and control
$wp_customize->add_setting( 'elead_theme_options[sticky_menu_custom_hr_line]', array(
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new Elead_Customize_Horizontal_Line( $wp_customize, 'elead_theme_options[sticky_menu_custom_hr_line]',
	array(
		'section'         => 'elead_layout',
		'type'			  => 'hr'
) ) );

// sticky menu custom note
$wp_customize->add_setting( 'elead_theme_options[sticky_menu_custom_note]', array(
	'sanitize_callback'	=> 'sanitize_text_field',
) );

$wp_customize->add_control( new Elead_Note_Control( $wp_customize, 'elead_theme_options[sticky_menu_custom_note]', array(
	'label'           	=> esc_html__( 'Option To Make Sticky Menu', 'elead' ),
	'section'         	=> 'elead_layout',
	'type'            	=> 'description',
) ) );

// sticky enable setting and control.
$wp_customize->add_setting( 'elead_theme_options[enable_sticky_menu]', array(
	'sanitize_callback'   => 'elead_sanitize_checkbox',
	'default'             => $options['enable_sticky_menu'],
) );

$wp_customize->add_control( 'elead_theme_options[enable_sticky_menu]', array(
	'label'               => esc_html__( 'Enable sticky Menu', 'elead' ),
	'section'             => 'elead_layout',
	'type'                => 'checkbox',
) );