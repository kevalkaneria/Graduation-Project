<?php
/**
 * Slider Section options
 *
 * @package Theme Palace
 * @subpackage Elead
 * @since Elead 0.1
 */

$wp_customize->add_section( 'elead_slider', array(
	'title'             => esc_html__( 'Slider','elead' ),
	'description'       => esc_html__( 'Slider Section Options.', 'elead' ),
	'panel'             => 'elead_sections_panel',
) );

// Slider Section enable setting and control.
$wp_customize->add_setting( 'elead_theme_options[slider_enable]', array(
	'sanitize_callback'	=> 'elead_sanitize_checkbox',
	'default'          	=> $options['slider_enable'],
) );

$wp_customize->add_control( 'elead_theme_options[slider_enable]', array(
	'label'            	=> esc_html__( 'Enable Slider Section', 'elead' ),
	'section'          	=> 'elead_slider',
	'type'             	=> 'checkbox',
) );

$wp_customize->add_control( new Elead_Customize_Horizontal_Line( $wp_customize, 'elead_theme_options[slider_hr]',
	array(
		'section'         => 'elead_slider',
		'active_callback' => 'elead_is_slider_enable',
		'type'			  => 'hr'
) ) );

// Add slider content type setting and control.
$wp_customize->add_setting( 'elead_theme_options[slider_content_type]', array(
	'default'           => $options['slider_content_type'],
	'sanitize_callback' => 'elead_sanitize_select'
) );

$wp_customize->add_control( 'elead_theme_options[slider_content_type]', array(
	'label'           	=> esc_html__( 'Content Type', 'elead' ),
	'description'     	=> esc_html__( 'Recommended slider image size is 1920x1080 px', 'elead' ),
	'section'         	=> 'elead_slider',
	'type'            	=> 'select',
	'active_callback' 	=> 'elead_is_slider_enable',
	'choices'         	=> array(
            'page'      => esc_html__( 'Page', 'elead' ),
        ), 
) );


// Slider Section page setting and control
for ( $i = 1; $i <= 4; $i++ ) {
	// Show page drop-down setting and control
	$wp_customize->add_setting( 'elead_theme_options[slider_content_page_'.$i.']', array(
		'sanitize_callback' => 'elead_sanitize_page'
	) );

	$wp_customize->add_control( 'elead_theme_options[slider_content_page_'.$i.']', array(
		'label'           	=> sprintf( esc_html__( 'Select Page %d', 'elead' ), $i ),
		'section'        	=> 'elead_slider',
		'active_callback' 	=> 'elead_is_slider_enable',
		'type'				=> 'dropdown-pages'
	) );
}

// Slider Section button label setting and control.
$wp_customize->add_setting( 'elead_theme_options[slider_btn_label]', array(
	'default'           => $options['slider_btn_label'],
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'elead_theme_options[slider_btn_label]', array(
	'active_callback'	=> 'elead_is_slider_enable',
	'label'             => esc_html__( 'Input link button label', 'elead' ),
	'section'           => 'elead_slider',
	'type'				=> 'text'
) );
