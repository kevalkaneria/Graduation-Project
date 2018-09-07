<?php
/**
 * Blog page options
 *
 * @package Theme Palace
 * @subpackage Elead
 * @since Elead 0.1
 */

$wp_customize->add_section( 'elead_blog', array(
	'title'            		=> esc_html__( 'Blog Page Options','elead' ),
	'description'      		=> esc_html__( 'Blog Page Options.', 'elead' ),
	'panel'            		=> 'elead_theme_options_panel',
) );

// Read more text.
$wp_customize->add_setting( 'elead_theme_options[read_more_text]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			  => $options['read_more_text'],
) );

$wp_customize->add_control( 'elead_theme_options[read_more_text]', array(
	'label'       => esc_html__( 'Read More Text', 'elead' ),
	'section'     => 'elead_blog',
	'type'        => 'text',
) );
