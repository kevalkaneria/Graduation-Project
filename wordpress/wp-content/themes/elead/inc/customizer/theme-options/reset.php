<?php
/**
 * Reset options
 *
 * @package Theme Palace
 * @subpackage Elead
 * @since Elead 0.1
 */

/**
* Reset section
*/
// Add reset enable section
$wp_customize->add_section( 'elead_reset_section', array(
	'title'             => esc_html__('Reset all settings','elead'),
	'description'       => esc_html__( 'Caution: All settings will be reset to default. Refresh the page after clicking Save & Publish.', 'elead' ),
) );

// Add reset enable setting and control.
$wp_customize->add_setting( 'elead_theme_options[reset_options]', array(
	'default'           => $options['reset_options'],
	'sanitize_callback' => 'elead_sanitize_checkbox',
	'transport'			  => 'postMessage',
) );

$wp_customize->add_control( 'elead_theme_options[reset_options]', array(
	'label'             => esc_html__( 'Check to reset all settings', 'elead' ),
	'description'		=> esc_html__( 'This option applies for customizer theme options values.','elead' ),
	'section'           => 'elead_reset_section',
	'type'              => 'checkbox',
) );
