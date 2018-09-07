<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Theme Palace
 * @subpackage Elead
 * @since Elead 0.1
 */
$options = elead_get_theme_options();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php $tags = get_the_tags();
	if ( ! empty( $tags ) ) : ?>
		<div class="entry-meta align-center">
			<span class="tag-links">
				<?php foreach ( $tags as $tag ) : ?>
					<a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>" rel="tag"><?php echo esc_html( $tag->name ); ?></a>
				<?php endforeach; ?>
			</span><!-- .tag-links -->
		</div><!-- .entry-meta -->
	<?php endif;

	$header_image_meta = elead_header_image_meta_option();
	if ( is_array( $header_image_meta ) ) {
		$header_image_meta = $header_image_meta[1];
	} 
	if ( 'show-both' == $header_image_meta ) { 
		if ( has_post_thumbnail() ) : ?>
			<figure class="featured-image">
				<?php the_post_thumbnail( 'full', array( 'alt' => the_title_attribute( 'echo=0' ) ) ); ?>
			</figure>
		<?php endif; 
	} ?>

	<div class="entry-container">
        <footer class="entry-footer">
			<?php if ( 'post' === get_post_type() ) : ?>
            	<p class="entry-meta align-center">	
					<?php elead_posted_on(); ?>
				</p><!-- .entry-meta -->        
			<?php endif; ?>
        </footer><!-- .entry-footer -->

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
