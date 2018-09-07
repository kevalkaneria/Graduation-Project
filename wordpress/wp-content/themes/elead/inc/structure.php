<?php
/**
 * Elead basic theme structure hooks
 *
 * This file contains structural hooks.
 *
 * @package Theme Palace
 * @subpackage Elead
 * @since Elead 0.1
 */


if ( ! function_exists( 'elead_doctype' ) ) :
	/**
	 * Doctype Declaration.
	 *
	 * @since Elead 0.1
	 */
	function elead_doctype() {
	?>
		<!DOCTYPE html>
			<html <?php language_attributes(); ?>>
	<?php
	}
endif;

add_action( 'elead_doctype', 'elead_doctype', 10 );


if ( ! function_exists( 'elead_head' ) ) :
	/**
	 * Header Codes
	 *
	 * @since Elead 0.1
	 *
	 */
	function elead_head() {
		?>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
			<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<?php endif;
	}
endif;
add_action( 'elead_before_wp_head', 'elead_head', 10 );

if ( ! function_exists( 'elead_page_start' ) ) :
	/**
	 * Page starts html codes
	 *
	 * @since Elead 0.1
	 *
	 */
	function elead_page_start() {
		?>
		<div id="page" class="site">
			<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'elead' ); ?></a>

		<?php
	}
endif;

add_action( 'elead_page_start_action', 'elead_page_start', 10 );

if ( ! function_exists( 'elead_page_end' ) ) :
	/**
	 * Page end html codes
	 *
	 * @since Elead 0.1
	 *
	 */
	function elead_page_end() {
		?>
		</div><!-- #page -->
		<?php
	}
endif;
add_action( 'elead_page_end_action', 'elead_page_end', 10 );

if ( ! function_exists( 'elead_header_start' ) ) :
	/**
	 * Header start html codes
	 *
	 * @since Elead 0.1
	 *
	 */
	function elead_header_start() {
		$options = elead_get_theme_options();
		$add_sticky = ( true == $options['enable_sticky_menu'] ) ? 'sticky-header' : 'no-sticky-header';

		$description = get_bloginfo( 'description', 'display' );
		$bloginfo = get_bloginfo( 'name' );
		if( has_custom_logo() && ( ! display_header_text() || ( empty( $bloginfo ) && empty( $description ) ) ) ) {
			$addclass = 'has-site-logo';
		} elseif ( ! has_custom_logo() && ( display_header_text() || !empty( $bloginfo ) || !empty( $description ) ) ) {
			$addclass = 'has-site-details';
		}
		else {
			$addclass = 'has-site-logo-details';
		}
		?>
		<header id="masthead" class="site-header <?php echo esc_attr( $add_sticky ); ?> <?php echo esc_attr( $addclass ); ?>" role="banner">
		<?php
	}
endif;
add_action( 'elead_header_action', 'elead_header_start', 10 );

if ( ! function_exists( 'elead_site_branding' ) ) :
	/**
	 * Site branding codes
	 *
	 * @since Elead 0.1
	 *
	 */
	function elead_site_branding() {

		$options = elead_get_theme_options();
		$enable_headline = $options['headline_enable'];
		// Get headline section details
        $section_details = array();
        $section_details = apply_filters( 'elead_filter_headline_section_details', $section_details );
		
		$headline_exits = ( empty( $section_details ) || ( true !== $enable_headline ) ) ? 'no-headline-section' : 'headline-section';
		?>
		<div class="wrapper">
			<div class="site-branding <?php echo esc_attr( $headline_exits ); ?> pull-left">
				<?php if ( has_custom_logo() ) : ?>
					<div class="site-logo">
            			<?php echo get_custom_logo(); ?>
          			</div>
      			<?php endif; ?>
				<div id="site-details">
					<?php
					if ( is_front_page() && is_home() ) : ?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php else : ?>
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php
					endif;

					$description = get_bloginfo( 'description', 'display' );
					if ( $description || is_customize_preview() ) : ?>
						<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
					<?php
					endif; ?>
				</div><!-- #site-details -->
			</div><!-- .site-branding -->
			<?php
				if ( is_active_sidebar( 'header-widget' ) ) {
					echo '<div class="widget-area col-2"><a class="topbar-toggle"><i class="fa fa-search"></i></a><div class="widget-area-wrapper">';
					dynamic_sidebar( 'header-widget' );
					echo '</div></div><!-- .widget-area -->';
				}
			?>
		</div><!-- .wrapper -->
		<?php
	}
endif;
add_action( 'elead_header_action', 'elead_site_branding', 20 );

if ( ! function_exists( 'elead_site_navigation' ) ) :
	/**
	 * Site navigation codes
	 *
	 * @since Elead 0.1
	 *
	 */
	function elead_site_navigation() {
		?>
		<nav id="site-navigation" class="main-navigation" role="navigation">
			<div class="wrapper">
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
			</div>
		</nav><!-- #site-navigation -->
		<?php
	}
endif;
add_action( 'elead_header_action', 'elead_site_navigation', 30 );


if ( ! function_exists( 'elead_header_end' ) ) :
	/**
	 * Header end html codes
	 *
	 * @since Elead 0.1
	 *
	 */
	function elead_header_end() {
		?>
		</header><!-- #masthead -->
		<?php
	}
endif;

add_action( 'elead_header_action', 'elead_header_end', 50 );

if ( ! function_exists( 'elead_content_start' ) ) :
	/**
	 * Site content codes
	 *
	 * @since Elead 0.1
	 *
	 */
	function elead_content_start() {
		?>
		<div id="content" class="site-content">
		<?php
	}
endif;
add_action( 'elead_content_start_action', 'elead_content_start', 10 );

if ( ! function_exists( 'elead_content_end' ) ) :
	/**
	 * Site content codes
	 *
	 * @since Elead 0.1
	 *
	 */
	function elead_content_end() {
		?>
		</div><!-- #content -->
		<?php
	}
endif;
add_action( 'elead_content_end_action', 'elead_content_end', 10 );

if ( ! function_exists( 'elead_add_breadcrumb' ) ) :

	/**
	 * Add breadcrumb.
	 *
	 * @since Elead 0.1
	 */
	function elead_add_breadcrumb() {
		$options = elead_get_theme_options();
		// Bail if Breadcrumb disabled.
		$breadcrumb = $options['breadcrumb_enable'];
		if ( false === $breadcrumb ) {
			return;
		}
		// Bail if Home Page.
		if ( is_front_page() && ! is_home() ) {
			return;
		}

		echo '<div id="breadcrumb-list">';
				/**
				 * elead_simple_breadcrumb hook
				 *
				 * @hooked elead_simple_breadcrumb -  10
				 *
				 */
				do_action( 'elead_simple_breadcrumb' );
		echo '</div><!-- #breadcrumb-list -->';
		return;
	}

endif;
add_action( 'elead_add_breadcrumb', 'elead_add_breadcrumb' , 20 );


if ( ! function_exists( 'elead_footer_start' ) ) :
	/**
	 * Site footer start
	 *
	 * @since Elead 0.1
	 *
	 */
	function elead_footer_start() {
		?>
		<footer id="colophon" class="site-footer" role="contentinfo">
		<?php
	}
endif;
add_action( 'elead_footer', 'elead_footer_start', 10 );


if ( ! function_exists( 'elead_footer_widget' ) ) :
	/**
	 * Site footer widgets
	 *
	 * @since Elead 0.1
	 *
	 */
	function elead_footer_widget() {
		$options = elead_get_theme_options();
		$footer_sidebar_data = elead_footer_sidebar_class();
		$footer_sidebar 	 = $footer_sidebar_data['active_sidebar'];
		$footer_class 		 = $footer_sidebar_data['class'];
		if ( empty( $footer_sidebar ) ) {
			return;
		} ?>
        <div class="footer-widget-area page-section <?php echo esc_attr( $footer_class ); ?>">
            <div class="wrapper">
		      	<?php foreach( $footer_sidebar as $active_widget ) : ?>
					<div class="hentry">
			      		<?php 
			      		if ( is_active_sidebar( esc_attr( $active_widget ) ) ){
			      			dynamic_sidebar( esc_attr( $active_widget ) );
			      		}
			      		?>
			      	</div>
		      	<?php endforeach; ?>
	      	</div><!-- .wrapper --> 
        </div><!-- .footer-widget-area -->
		<?php
	}
endif;
add_action( 'elead_footer', 'elead_footer_widget', 20 );


if ( ! function_exists( 'elead_footer_site_info' ) ) :
	/**
	 * Site footer site info
	 *
	 * @since Elead 0.1
	 *
	 */
	function elead_footer_site_info() {
		$options = elead_get_theme_options();
		$search = array( '[the-year]', '[site-link]' );

        $replace = array( date( 'Y' ), '<a href="'. esc_url( home_url( '/' ) ) .'">'. esc_html( get_bloginfo( 'name', 'display' ) ) . '</a>' );

        $options['copyright_text'] = str_replace( $search, $replace, $options['copyright_text'] );

		$copyright_text = $options['copyright_text']; ?>
		
	    <div class="site-info">
	    	<div class="wrapper">
				<?php if ( ! empty( $copyright_text ) ) :  ?>
	    			<p class="copyright pull-left"><?php echo wp_kses_post( $copyright_text ); ?></p>
				<?php endif; ?>
	    		<p class="powered-by pull-right"><?php printf( esc_html__( '%1$s by %2$s', 'elead' ), 'Elead', '<a href="' . esc_url( 'https://www.themepalace.com/' ) . '" rel="designer" target="_blank">Theme Palace</a>' ); ?></p>
	    	</div><!-- .wrapper -->
	    </div><!-- end .site-info -->
		<?php 
	}
endif;
add_action( 'elead_footer', 'elead_footer_site_info', 30 );


if ( ! function_exists( 'elead_footer_end' ) ) :
	/**
	 * Site footer end
	 *
	 * @since Elead 0.1
	 *
	 */
	function elead_footer_end() {
		?>
		</footer><!-- #colophon -->
		<?php
	}
endif;
add_action( 'elead_footer', 'elead_footer_end', 40 );

if ( ! function_exists( 'elead_scroll_up' ) ) :
	/**
	 * Scroll Up Function
	 *
	 * @since Elead 0.1
	 *
	 */
	function elead_scroll_up() {
		$options = elead_get_theme_options();
		if ( true === $options['scroll_top_visible'] ) : ?>   
	        <div class="backtotop"><i class="fa fa-angle-up"></i></div><!-- .backtotop -->
	    <?php endif;
	}
endif;
add_action( 'elead_footer', 'elead_scroll_up', 50 );

