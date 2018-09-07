<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Theme Palace
 * @subpackage Elead
 * @since Elead 0.1
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( is_front_page() ) {
		the_title( '<h2 class="entry-title">', '</h2>' );
	} 

	$header_image_meta = get_post_meta( get_the_id(), 'elead-header-image', true );

	if ( 'show-both' == $header_image_meta ) { 
		if ( has_post_thumbnail() ) : ?>
			<figure class="featured-image">
				<?php the_post_thumbnail( 'full', array( 'alt' => the_title_attribute( 'echo=0' ) ) ); ?>
			</figure>
		<?php endif; 
	} ?>

	<div class="entry-container">
		<div class="entry-content">
			<?php
				the_content( sprintf(
					/* translators: %s: Name of current post. */
					wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'elead' ), array( 'span' => array( 'class' => array() ) ) ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				) );

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'elead' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->

		<?php elead_entry_footer(); ?>
	</div><!-- .entry-container -->
</article><!-- #post-## -->
