<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Theme Palace
 * @subpackage Elead
 * @since Elead 0.1
 */
$options = elead_get_theme_options();
get_header(); ?>
	<div class="wrapper page-section clear">
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">

				<?php
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content', 'single' );
					if ( true === $options['post_navigation_enable'] ) {
						the_post_navigation();
					}

					/**
					 * Hook elead_author_profile
					 *  
					 * @hooked elead_get_author_profile 
					*/
					do_action( 'elead_author_profile' );

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

				endwhile; // End of the loop.
				?>
			</main><!-- #main -->
		</div><!-- #primary -->
		<?php
		if ( elead_is_sidebar_enable() ) {
			get_sidebar();
		} ?>
	</div><!-- .page-section -->
<?php 
get_footer();
