<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Theme Palace
 * @subpackage Elead
 * @since Elead 0.1
 */

if ( ! function_exists( 'elead_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function elead_posted_on() {
		$options = elead_get_theme_options();
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$year  = get_the_time('Y');
	    $month = get_the_time('m');
	    $post_type = get_post_type();

		if ( 'post' === $post_type ) {
			$date_url = get_month_link( $year, $month );
		} else {
			$date_url = get_month_link( get_the_date( 'Y' ), get_the_date( 'm' ) );
		}

		$posted_on = '<a href="' . esc_url( $date_url ) . '" rel="bookmark">' . $time_string . '</a>';

		$byline = '<span class="author vcard"><span class="screen-reader-text">' . esc_html__( 'Author','elead' ) . '</span><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>';
		
		echo '<span class="byline"> ' . $byline . '</span>';
		
		echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

		echo '<span class="comments-link"><a href="' . esc_url( get_comments_link( get_the_ID() ) ) .'">';

		comments_number( esc_html__( 'No Comment', 'elead' ), esc_html__( '1 Comment', 'elead' ), esc_html__( '% Comments', 'elead' ) );

		echo '</a></span><!-- .comments-links -->';
	}
endif;

if ( ! function_exists( 'elead_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function elead_entry_footer() {

		edit_post_link(
			sprintf(
				/* translators: %s: Name of current post */
				esc_html__( 'Edit %s', 'elead' ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function elead_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'elead_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'elead_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so elead_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so elead_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in elead_categorized_blog.
 */
function elead_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'elead_categories' );
}
add_action( 'edit_category', 'elead_category_transient_flusher' );
add_action( 'save_post',     'elead_category_transient_flusher' );


if ( ! function_exists( 'elead_post_date' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function elead_post_date() {
		global $post;
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$year  = get_the_time('Y');
	    $month = get_the_time('m');
	    $post_type = get_post_type();

		if ( 'post' === $post_type ) {
			$date_url = get_month_link( $year, $month );
		} else {
			$date_url = get_month_link( get_the_date( 'Y' ), get_the_date( 'm' ) );
		}

		$post_on = '<a href="' . esc_url( $date_url ) . '" rel="bookmark">' . $time_string . '</a>';

		echo '<span class="posted-on">' . $post_on . '</span>';
	}
endif;