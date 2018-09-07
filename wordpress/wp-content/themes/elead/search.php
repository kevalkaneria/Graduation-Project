<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Theme Palace
 * @subpackage Elead
 * @since Elead 0.1
 */

get_header(); ?>
	<div class="wrapper page-section">
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">
				<div id="archive-blog-wrapper" class="archive-blog-wrapper clear col-3">

				<?php
				if ( have_posts() ) : ?>

					<?php
					/* Start the Loop */
					while ( have_posts() ) : the_post();

						/**
						 * Run the loop for the search to output the results.
						 * If you want to overload this in a child theme then include a file
						 * called content-search.php and that will be used instead.
						 */
						get_template_part( 'template-parts/content', 'search' );

					endwhile;

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif; ?>
				</div><!-- .archive-blog-wrapper -->
				<?php

				/**
				* Hook - elead_action_pagination.
				*
				* @hooked elead_pagination
				*/
				do_action( 'elead_action_pagination' ); 				
				?>

			</main><!-- #main -->
		</div><!-- #primary -->
	</div><!-- .wrapper -->
<?php
get_footer();
