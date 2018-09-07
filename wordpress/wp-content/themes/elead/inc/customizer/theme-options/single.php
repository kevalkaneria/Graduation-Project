<?php
/**
 * Single post options
 *
 * @package Theme Palace
 * @subpackage Elead
 * @since Elead 0.1
 */

$wp_customize->add_section( 'elead_single', array(
	'title'            		=> esc_html__( 'Single Post','elead' ),
	'description'      		=> esc_html__( 'Single Post Options.', 'elead' ),
	'panel'            		=> 'elead_theme_options_panel',
) );

// post navigation enable setting and control.
$wp_customize->add_setting( 'elead_theme_options[post_navigation_enable]', array(
	'sanitize_callback'		=> 'elead_sanitize_checkbox',
	'default'             	=> $options['post_navigation_enable'],
) );

$wp_customize->add_control( 'elead_theme_options[post_navigation_enable]', array(
	'label'               	=> esc_html__( 'Enable Post Navigation', 'elead' ),
	'section'             	=> 'elead_single',
	'type'                	=> 'checkbox',
) );

// author box enable setting and control.
$wp_customize->add_setting( 'elead_theme_options[author_box_enable]', array(
	'sanitize_callback'		=> 'elead_sanitize_checkbox',
	'default'             	=> $options['author_box_enable'],
) );

$wp_customize->add_control( 'elead_theme_options[author_box_enable]', array(
	'label'               	=> esc_html__( 'Enable Author Box', 'elead' ),
	'section'             	=> 'elead_single',
	'type'                	=> 'checkbox',
) );
