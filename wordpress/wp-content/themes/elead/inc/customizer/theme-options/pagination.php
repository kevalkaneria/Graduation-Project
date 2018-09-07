<?php
/**
 * pagination options
 *
 * @package Theme Palace
 * @subpackage Elead
 * @since Elead 0.1
 */

// Add pagination section
$wp_customize->add_section( 'elead_pagination', array(
	'title'               => esc_html__('Pagination','elead'),
	'description'         => esc_html__( 'Pagination section options.', 'elead' ),
	'panel'               => 'elead_theme_options_panel',
) );

// pagination enable setting and control.
$wp_customize->add_setting( 'elead_theme_options[pagination_enable]', array(
	'sanitize_callback'   => 'elead_sanitize_checkbox',
	'default'             => $options['pagination_enable'],
) );

$wp_customize->add_control( 'elead_theme_options[pagination_enable]', array(
	'label'               => esc_html__( 'Pagination Enable', 'elead' ),
	'section'             => 'elead_pagination',
	'type'                => 'checkbox',
) );

// pagination type setting and control.
$wp_customize->add_setting( 'elead_theme_options[pagination_type]', array(
	'sanitize_callback'   => 'elead_sanitize_select',
	'default'             => $options['pagination_type'],
) );

$wp_customize->add_control( 'elead_theme_options[pagination_type]', array(
	'label'               => esc_html__( 'Pagination Type', 'elead' ),
	'description'		  => esc_html__( 'Works on Blog and Archive Page Only', 'elead' ),
	'section'             => 'elead_pagination',
	'type'                => 'select',
	'choices'			  => elead_pagination_options(),
	'active_callback'	  => 'elead_is_pagination_enable',
) );
