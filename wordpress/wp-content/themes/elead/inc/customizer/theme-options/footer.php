<?php
/**
 * Footer options
 *
 * @package Theme Palace
 * @subpackage Elead
 * @since Elead 0.1
 */

// Footer Section
$wp_customize->add_section( 'elead_section_footer',
	array(
		'title'      			=> esc_html__( 'Footer Options', 'elead' ),
		'priority'   			=> 900,
		'panel'      			=> 'elead_theme_options_panel',
	)
);

// footer text
$wp_customize->add_setting( 'elead_theme_options[copyright_text]',
	array(
		'default'       		=> $options['copyright_text'],
		'sanitize_callback'		=> 'elead_santize_allow_tag',
		'transport'				=> 'postMessage',
	)
);
$wp_customize->add_control( 'elead_theme_options[copyright_text]',
    array(
		'label'      			=> esc_html__( 'Footer Text', 'elead' ),
		'section'    			=> 'elead_section_footer',
		'type'		 			=> 'textarea',
    )
);

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'elead_theme_options[copyright_text]', array(
		'selector'            => '#colophon .site-info .wrapper p.copyright',
		'settings'            => 'elead_theme_options[copyright_text]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'elead_copyright_text_callback',
    ) );
}

// scroll top visible
$wp_customize->add_setting( 'elead_theme_options[scroll_top_visible]',
	array(
		'default'       		=> $options['scroll_top_visible'],
		'sanitize_callback'		=> 'elead_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'elead_theme_options[scroll_top_visible]',
    array(
		'label'      			=> esc_html__( 'Display Scroll Top Button', 'elead' ),
		'section'    			=> 'elead_section_footer',
		'type'		 			=> 'checkbox',
    )
);