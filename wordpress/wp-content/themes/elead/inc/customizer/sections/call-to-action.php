<?php
/**
 * Call to action Section options
 *
 * @package Theme Palace
 * @subpackage Elead
 * @since Elead 0.1
 */

$wp_customize->add_section( 'elead_call_to_action', array(
	'title'             => esc_html__( 'Call to Action','elead' ),
	'description'       => esc_html__( 'Call to Action Section Options.', 'elead' ),
	'panel'             => 'elead_sections_panel',
) );

// Call To Action Section enable setting and control.
$wp_customize->add_setting( 'elead_theme_options[call_to_action_enable]', array(
	'sanitize_callback'	=> 'elead_sanitize_checkbox',
	'default'          	=> $options['call_to_action_enable'],
) );

$wp_customize->add_control( 'elead_theme_options[call_to_action_enable]', array(
	'label'            	=> esc_html__( 'Enable Call to Action Section', 'elead' ),
	'section'          	=> 'elead_call_to_action',
	'type'             	=> 'checkbox',
) );

// Call To Action Section title setting and control.
$wp_customize->add_setting( 'elead_theme_options[call_to_action_title]', array(
	'sanitize_callback'	=> 'sanitize_text_field',
	'default'          	=> $options['call_to_action_title'],
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'elead_theme_options[call_to_action_title]', array(
	'label'            	=> esc_html__( 'Title', 'elead' ), 
	'section'          	=> 'elead_call_to_action',
	'type'             	=> 'text',
	'active_callback'	=> 'elead_is_call_to_action_enable',
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'elead_theme_options[call_to_action_title]', array(
		'selector'            => '#promotion .wrapper .entry-header h2.entry-title',
		'settings'            => 'elead_theme_options[call_to_action_title]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'elead_call_to_action_title',
    ) );
}

// Call To Action Section subtitle setting and control.
$wp_customize->add_setting( 'elead_theme_options[call_to_action_sub_title]', array(
	'sanitize_callback'	=> 'sanitize_text_field',
	'default'          	=> $options['call_to_action_sub_title'],
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'elead_theme_options[call_to_action_sub_title]', array(
	'label'            	=> esc_html__( 'Sub Title', 'elead' ),
	'section'          	=> 'elead_call_to_action',
	'type'             	=> 'text',
	'active_callback'	=> 'elead_is_call_to_action_enable',
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'elead_theme_options[call_to_action_sub_title]', array(
		'selector'            => '#promotion .wrapper .entry-header p.entry-title-desc',
		'settings'            => 'elead_theme_options[call_to_action_sub_title]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'elead_call_to_action_sub_title',
    ) );
}

// post hr setting and control
$wp_customize->add_setting( 'elead_theme_options[call_to_action_hr_1]', array(
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new Elead_Customize_Horizontal_Line( $wp_customize, 'elead_theme_options[call_to_action_hr_1]',
	array(
		'section'         => 'elead_call_to_action',
		'active_callback' => 'elead_is_call_to_action_enable',
		'type'			  => 'hr'
) ) );

for ( $i = 1; $i <= 2; $i++ ) {
	// post hr setting and control
	$wp_customize->add_setting( 'elead_theme_options[call_to_action_hr_' . $i . ']', array(
		'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_control( new Elead_Customize_Horizontal_Line( $wp_customize, 'elead_theme_options[call_to_action_hr_' . $i . ']',
		array(
			'section'         => 'elead_call_to_action',
			'active_callback' => 'elead_is_call_to_action_enable',
			'type'			  => 'hr'
	) ) );

	// Call To Action Section button label setting and control.
	$wp_customize->add_setting( 'elead_theme_options[call_to_action_btn_label_' . $i . ']', array(
		'sanitize_callback'	=> 'sanitize_text_field',
		'default'          	=> $options['call_to_action_btn_label_' . $i],
	) );

	$wp_customize->add_control( 'elead_theme_options[call_to_action_btn_label_' . $i . ']', array(
		'label'            	=> sprintf( esc_html__( 'Button Label %d', 'elead' ), $i ),
		'section'          	=> 'elead_call_to_action',
		'type'             	=> 'text',
		'active_callback'	=> 'elead_is_call_to_action_enable',
	) );

	// Call To Action Section button url setting and control.
	$wp_customize->add_setting( 'elead_theme_options[call_to_action_btn_url_' . $i . ']', array(
		'sanitize_callback'	=> 'esc_url_raw',
		'default'          	=> $options['call_to_action_btn_url_' . $i],
	) );

	$wp_customize->add_control( 'elead_theme_options[call_to_action_btn_url_' . $i . ']', array(
		'label'            	=> sprintf( esc_html__( 'Button URL %d', 'elead' ), $i ),
		'section'          	=> 'elead_call_to_action',
		'type'             	=> 'url',
		'active_callback'	=> 'elead_is_call_to_action_enable',
	) );
}
