<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Theme Palace
 * @subpackage Elead
 * @since Elead 0.1
 */

get_header(); ?>
	<div class="wrapper page-section">
		<div class="page-decoration">
	        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/uploads/decoration.png' ); ?>" alt="<?php esc_attr_e( 'Decoration','elead' ); ?>">
	    </div>
		<section class="error-404 not-found">
			<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/uploads/404.png' ); ?>" alt="<?php esc_attr_e( '404', 'elead' ); ?>">
			<header class="page-header">
				<h1 class="section-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'elead' ); ?></h1>
			</header><!-- .page-header -->

			<div class="entry-content">
				<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'elead' ); ?></p>

				<?php get_search_form(); ?>

			</div><!-- .page-content -->
		</section><!-- .error-404 -->
	</div><!-- .wrapper/page-section -->
<?php
get_footer();
