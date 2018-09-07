<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Theme Palace
 * @subpackage Elead
 * @since Elead 0.1
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function elead_body_classes( $classes ) {
	$options = elead_get_theme_options();

	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Add a class for layout
	$classes[] = esc_attr( $options['site_layout'] );

	// Add a class for sidebar
	$sidebar_position = elead_layout();

	if ( is_singular() ) {
		$selected_sidebar = get_post_meta( get_the_id(), 'elead-selected-sidebar', true );
		$post_sidebar = ! empty( $selected_sidebar ) ? $selected_sidebar : 'sidebar-1';
	} else {
		$post_sidebar = 'sidebar-1';
	}

	if ( is_active_sidebar( $post_sidebar ) ) {
		$classes[] = esc_attr( $sidebar_position );
	} else {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'elead_body_classes' );