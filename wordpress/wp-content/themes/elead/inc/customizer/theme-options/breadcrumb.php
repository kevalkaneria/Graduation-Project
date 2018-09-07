<?php
/**
 * Breadcrumb options
 *
 * @package Theme Palace
 * @subpackage Elead
 * @since Elead 0.1
 */

$wp_customize->add_section( 'elead_breadcrumb', array(
	'title'             => esc_html__( 'Breadcrumb','elead' ),
	'description'       => esc_html__( 'Breadcrumb section options.', 'elead' ),
	'panel'             => 'elead_theme_options_panel',
) );

// Breadcrumb enable setting and control.
$wp_customize->add_setting( 'elead_theme_options[breadcrumb_enable]', array(
	'sanitize_callback'	=> 'elead_sanitize_checkbox',
	'default'          	=> $options['breadcrumb_enable'],
) );

$wp_customize->add_control( 'elead_theme_options[breadcrumb_enable]', array(
	'label'            	=> esc_html__( 'Enable Breadcrumb', 'elead' ),
	'section'          	=> 'elead_breadcrumb',
	'type'             	=> 'checkbox',
) );
