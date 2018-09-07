<?php
/**
* Homepage (Static ) options
*
* @package Theme Palace
* @subpackage Elead
* @since Elead 0.1
*/

// Homepage (Static ) setting and control.
$wp_customize->add_setting( 'elead_theme_options[enable_frontpage_content]', array(
	'sanitize_callback'   => 'elead_sanitize_checkbox',
	'default'             => $options['enable_frontpage_content'],
) );

$wp_customize->add_control( 'elead_theme_options[enable_frontpage_content]', array(
	'label'       	=> esc_html__( 'Enable Content', 'elead' ),
	'description' 	=> esc_html__( 'Check to enable content on static front page only.', 'elead' ),
	'section'     	=> 'static_front_page',
	'type'        	=> 'checkbox',
) );