<?php
/**
 * Headline Section options
 *
 * @package Theme Palace
 * @subpackage Elead
 * @since Elead 0.1
 */

$wp_customize->add_section( 'elead_headline', array(
	'title'             => esc_html__( 'Headline','elead' ),
	'description'       => esc_html__( 'Headline Section Options.', 'elead' ),
	'panel'             => 'elead_sections_panel',
) );

// Headline Section enable setting and control.
$wp_customize->add_setting( 'elead_theme_options[headline_enable]', array(
	'sanitize_callback'	=> 'elead_sanitize_checkbox',
	'default'          	=> $options['headline_enable'],
) );

$wp_customize->add_control( 'elead_theme_options[headline_enable]', array(
	'label'            	=> esc_html__( 'Enable Headline Section', 'elead' ),
	'section'          	=> 'elead_headline',
	'type'             	=> 'checkbox',
) );

// Headline Section label setting and control.
$wp_customize->add_setting( 'elead_theme_options[headline_label]', array(
	'default'          	=> $options['headline_label'],
	'sanitize_callback'	=> 'sanitize_text_field',
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'elead_theme_options[headline_label]', array(
	'label'            	=> esc_html__( 'Headline Label', 'elead' ),
	'section'          	=> 'elead_headline',
	'type'             	=> 'text',
	'active_callback'	=> 'elead_is_headline_enable',
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'elead_theme_options[headline_label]', array(
		'selector'            => 'header #news-ticker .wrapper h2.news-ticker-label',
		'settings'            => 'elead_theme_options[headline_label]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'elead_headline_label',
    ) );
}

// Headline Section content type setting and control.
$wp_customize->add_setting( 'elead_theme_options[headline_content_type]', array(
	'default'          	=> $options['headline_content_type'],
	'sanitize_callback'	=> 'elead_sanitize_select',
) );

$wp_customize->add_control( 'elead_theme_options[headline_content_type]', array(
	'label'            	=> esc_html__( 'Headline Content Type', 'elead' ),
	'section'          	=> 'elead_headline',
	'type'             	=> 'select',
	'active_callback'	=> 'elead_is_headline_enable',
	'choices'			=> array(
            'post'      => esc_html__( 'Post', 'elead' ),
        ),
) );

// Headline Section content type post setting and control.
$wp_customize->add_setting( 'elead_theme_options[headline_content_post]', array(
	'sanitize_callback' => 'elead_sanitize_post_ids',
	'validate_callback' => 'elead_validate_post_id',
) );

$wp_customize->add_control( 'elead_theme_options[headline_content_post]', array(
	'active_callback'	=> 'elead_is_headline_enable',
	'label'             => esc_html__( 'Input Post Ids', 'elead' ),
	'description'       => esc_html__( 'Simply hover post title on dashboard to see the Post ID.ie: 11, 24, 34. Max no. of posts allowed is 5.', 'elead' ),
	'section'           => 'elead_headline',
	'type'				=> 'text'
) );

// Headline Section custom post hr setting and control
$wp_customize->add_setting( 'elead_theme_options[headline_custom_hr_line]', array(
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new Elead_Customize_Horizontal_Line( $wp_customize, 'elead_theme_options[headline_custom_hr_line]',
	array(
		'section'         => 'elead_headline',
		'active_callback' => 'elead_is_headline_enable',
		'type'			  => 'hr'
) ) );

// Headline Section custom note
$wp_customize->add_setting( 'elead_theme_options[headline_custom_note]', array(
	'sanitize_callback'	=> 'sanitize_text_field',
) );

$wp_customize->add_control( new Elead_Note_Control( $wp_customize, 'elead_theme_options[headline_custom_note]', array(
	'active_callback'	=> 'elead_is_headline_enable',
	'label'           	=> esc_html__( 'Social Link Value For Headline ', 'elead' ),
	'section'         	=> 'elead_headline',
	'type'            	=> 'description',
) ) );

// Headline social Section enable setting and control.
$wp_customize->add_setting( 'elead_theme_options[headline_social_enable]', array(
	'sanitize_callback'	=> 'elead_sanitize_checkbox',
	'default'          	=> $options['headline_social_enable'],
) );

$wp_customize->add_control( 'elead_theme_options[headline_social_enable]', array(
	'label'            	=> esc_html__( 'Enable Social Icon', 'elead' ),
	'section'          	=> 'elead_headline',
	'active_callback'	=> 'elead_is_headline_enable',
	'type'             	=> 'checkbox',
) );

for ( $i = 1; $i <= 5; $i++ ) :
	// Headline Section social title setting and control.
	$wp_customize->add_setting( 'elead_theme_options[headline_social_link_' . $i . ']', array(
		'sanitize_callback'	=> 'esc_url_raw',
		'default'          	=> $options['headline_social_link_' . $i],
	) );

	$wp_customize->add_control( 'elead_theme_options[headline_social_link_' . $i . ']', array(
		'label'            	=> sprintf( esc_html__( 'Social Link %d', 'elead' ), $i ),
		'section'          	=> 'elead_headline',
		'active_callback'	=> 'elead_is_social_headline_enable',
		'type'             	=> 'url',
		'input_attrs'	=> array(
			'placeholder'	=> esc_attr__( 'http://facebook.com', 'elead' ),
			),
	) );
endfor;