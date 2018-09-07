<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Theme Palace
 * @subpackage Elead
 * @since Elead 0.1
 */
$options = elead_get_theme_options();
get_header(); ?>
	<div class="wrapper page-section">
        <header class="page-header align-center">
            <h2 class="section-title"><?php esc_html_e( 'Welcome to Our Blog','elead' ); ?></h2>
            <p class="entry-title-desc"><?php esc_html_e( 'Complete Articles','elead' ); ?></p>
        </header><!-- .entry-header -->    
	    <div class="page-decoration">
	        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/uploads/decoration.png' ); ?>" alt="<?php esc_attr_e( 'Decoration','elead' ); ?>">
	    </div>

		<div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">
                <div id="archive-blog-wrapper" class="archive-blog-wrapper clear col-3">

					<?php
					if ( have_posts() ) :

						$i = 1;
						/* Start the Loop */
						while ( have_posts() ) : the_post();
							/**
							 * elead_blog_content_action hook
							 *
							 * @hooked elead_blog_content -  10
							 *
							 */
							do_action( 'elead_blog_content_action', $i );
							$i++;
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
