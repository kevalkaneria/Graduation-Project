<?php
/**
 * Social Section options
 *
 * @package Theme Palace
 * @subpackage Elead
 * @since Elead 0.1
 */

$wp_customize->add_section( 'elead_social', array(
	'title'             => esc_html__( 'Social','elead' ),
	'description'       => esc_html__( 'Social Section Options', 'elead' ),
	'panel'             => 'elead_sections_panel',
) );

// social Section enable setting and control.
$wp_customize->add_setting( 'elead_theme_options[social_enable]', array(
	'sanitize_callback'	=> 'elead_sanitize_checkbox',
	'default'          	=> $options['social_enable'],
) );

$wp_customize->add_control( 'elead_theme_options[social_enable]', array(
	'label'            	=> esc_html__( 'Enable Social Section', 'elead' ),
	'section'          	=> 'elead_social',
	'type'             	=> 'checkbox',
) );

// social Section enable on entire site setting and control.
$wp_customize->add_setting( 'elead_theme_options[social_entire_site_enable]', array(
	'sanitize_callback'	=> 'elead_sanitize_checkbox',
	'default'          	=> $options['social_entire_site_enable'],
) );

$wp_customize->add_control( 'elead_theme_options[social_entire_site_enable]', array(
	'label'            	=> esc_html__( 'Enable Section Entire Site', 'elead' ),
	'section'          	=> 'elead_social',
	'type'             	=> 'checkbox',
	'active_callback'	=> 'elead_is_social_enable',
) );

for ( $i = 1; $i <= 5; $i++ ) :
	// social Section title setting and control.
	$wp_customize->add_setting( 'elead_theme_options[social_title_link_' . $i . ']', array(
		'sanitize_callback'	=> 'esc_url_raw',
		'default'          	=> $options['social_title_link_' . $i],
	) );

	$wp_customize->add_control( 'elead_theme_options[social_title_link_' . $i . ']', array(
		'label'            	=> sprintf( esc_html__( 'Social Link %d', 'elead' ), $i ),
		'section'          	=> 'elead_social',
		'type'             	=> 'url',
		'active_callback'	=> 'elead_is_social_enable',
		'input_attrs'	=> array(
			'placeholder'	=> esc_attr__( 'http://facebook.com', 'elead' ),
			),
	) );
endfor;
