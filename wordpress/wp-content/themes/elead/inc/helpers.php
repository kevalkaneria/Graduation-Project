<?php
/**
 * elead custom helper funtions
 *
 * This is the template that includes all the other files for core featured of Photo Fusion Pro
 *
 * @package Theme Palace
 * @subpackage Elead
 * @since Elead 0.1
 */

if( ! function_exists( 'elead_check_enable_status' ) ):
	/**
	 * Check status of content.
	 *
	 * @since Elead 0.1
	 */
  	function elead_check_enable_status( $input, $content_enable ){
		 $options = elead_get_theme_options();

		 // Content status.
		 $content_status = $options[ $content_enable ];

		 // Get Page ID outside Loop.
		 $query_obj = get_queried_object();
		 $page_id   = null;
	    if ( is_object( $query_obj ) && 'WP_Post' == get_class( $query_obj ) ) {
	    	$page_id = get_queried_object_id();
	    }

		 // Front page displays in Reading Settings.
		 $page_on_front  = get_option( 'page_on_front' );

		 if ( ( ! is_home() && is_front_page() ) && ( true === $content_status ) ) {
			$input = true;
		 }
		 else {
			$input = false;
		 }
		 return ( $input );

  	}
endif;
add_filter( 'elead_section_status', 'elead_check_enable_status', 10, 2 );


if ( ! function_exists( 'elead_is_sidebar_enable' ) ) :
	/**
	 * Check if sidebar is enabled in meta box first then in customizer
	 *
	 * @since Elead 0.1
	 */
	function elead_is_sidebar_enable() {
		$options               = elead_get_theme_options();
		$sidebar_position      = $options['sidebar_position'];

		if ( is_search() ) {
			$post_sidebar_position = '';
		} else {
			$post_id = get_the_id();
			$post_sidebar_position = get_post_meta( $post_id, 'elead-sidebar-position', true );
		}

		if ( ( $sidebar_position == 'no-sidebar' && $post_sidebar_position == "" ) || $post_sidebar_position == 'no-sidebar' ) {
			return false;
		} else {
			return true;
		}

	}
endif;


if ( ! function_exists( 'elead_is_frontpage_content_enable' ) ) :
	/**
	 * Check home page ( static ) content status.
	 *
	 *.0
	 *
	 * @param bool $status Home page content status.
	 * @return bool Modified home page content status.
	 */
	function elead_is_frontpage_content_enable( $status ) {
		if ( is_front_page() ) {
			$options = elead_get_theme_options();
			$front_page_content_status = $options['enable_frontpage_content'];
			if ( false === $front_page_content_status ) {
				$status = false;
			}
		}
		return $status;
	}

endif;

add_filter( 'elead_filter_frontpage_content_enable', 'elead_is_frontpage_content_enable' );


add_action( 'elead_simple_breadcrumb', 'elead_simple_breadcrumb' , 10 );
if ( ! function_exists( 'elead_simple_breadcrumb' ) ) :

	/**
	 * Simple breadcrumb.
	 *
	 *
	 * @param  array $args Arguments
	 */
	function elead_simple_breadcrumb( $args = array() ) {

		/**
		 * Add breadcrumb.
		 *
		 */
		$options = elead_get_theme_options();
		// Bail if Breadcrumb disabled.
		$breadcrumb = $options['breadcrumb_enable'];
		if ( false === $breadcrumb ) {
			return;
		}

		$args = array(
			'show_on_front'   => false,
			'show_title'      => true,
			'show_browse'     => false,
		);
		breadcrumb_trail( $args );      

		return;
	}

endif;


add_action( 'elead_action_pagination', 'elead_pagination', 10 );
if ( ! function_exists( 'elead_pagination' ) ) :

	/**
	 * pagination.
	 *
	 * @since Elead 0.1
	 */
	function elead_pagination() {
		$options = elead_get_theme_options();
		if ( true == $options['pagination_enable'] ) {
			$pagination = $options['pagination_type'];
			if ( $pagination == 'default' ) :
				the_posts_navigation();
			elseif ( $pagination == 'numeric' || $pagination == 'infinite' ) :
				the_posts_pagination( array(
				    'mid_size' => 2,
				    'prev_text' => esc_html__( 'Previous Posts', 'elead' ),
				    'next_text' => esc_html__( 'Next Posts', 'elead' ),
				) );
			endif;
		}
	}
endif;

if ( ! function_exists( 'elead_trim_content' ) ) :
	/**
	 * custom excerpt function
	 * 
	 * @since Elead 0.1
	 * @return  no of words to display
	 */
	function elead_trim_content( $length = 40, $post_obj = null ) {
		global $post;
		if ( is_null( $post_obj ) ) {
			$post_obj = $post;
		}

		$length = absint( $length );
		if ( $length < 1 ) {
			$length = 40;
		}

		$source_content = $post_obj->post_content;
		if ( ! empty( $post_obj->post_excerpt ) ) {
			$source_content = $post_obj->post_excerpt;
		}

		$source_content = preg_replace( '`\[[^\]]*\]`', '', $source_content );
		$trimmed_content = wp_trim_words( $source_content, $length, '...' );

	   return apply_filters( 'elead_trim_content', $trimmed_content );
	}
endif;


if ( ! function_exists( 'elead_custom_content_width' ) ) :

	/**
	 * Custom content width.
	 *
	 * @since Elead 0.1
	 */
	function elead_custom_content_width() {

		global $content_width;
		$sidebar_position = elead_layout();
		switch ( $sidebar_position ) {

		  case 'no-sidebar':
		    $content_width = 1170;
		    break;

		  case 'left-sidebar':
		  case 'right-sidebar':
		    $content_width = 819;
		    break;

		  default:
		    break;
		}
		if ( ! is_active_sidebar( 'sidebar-1' ) ) {
			$content_width = 1170;
		}

	}
endif;
add_action( 'template_redirect', 'elead_custom_content_width' );


if ( ! function_exists( 'elead_layout' ) ) :
	/**
	 * Check home page layout option
	 *
	 * @since Elead 0.1
	 *
	 * @return string Theme Palace layout value
	 */
	function elead_layout() {
		$options = elead_get_theme_options();

		$sidebar_position = $options['sidebar_position'];
		$sidebar_position = apply_filters( 'elead_sidebar_position', $sidebar_position );
		// Check if single and static blog page
		if ( is_singular() ) {
			
			$post_sidebar_position = get_post_meta( get_the_ID(), 'elead-sidebar-position', true );
			if ( isset( $post_sidebar_position ) && ! empty( $post_sidebar_position ) ) {
				$sidebar_position = $post_sidebar_position;
			}
		}
		// var_dump($sidebar_position);
		if ( is_archive() || is_home() || is_search() ) {
			if ( class_exists( 'WooCommerce' ) && ( is_shop() ) ) {
				$sidebar_position = $options['sidebar_position'];
			} else {
				$sidebar_position = 'no-sidebar';
			}
		}
		return $sidebar_position;
	}
endif;

if ( ! function_exists( 'elead_footer_sidebar_class' ) ) :
	/**
	 * Count the number of footer sidebars to enable dynamic classes for the footer
	 *
	 * @since Elead 0.1
	 */
	function elead_footer_sidebar_class() {
		$data = array();
		$active_sidebar = array();
	   	$count = 0;

	   	if ( is_active_sidebar( 'elead-footer-widget-area' ) ) {
	   		$active_sidebar[] 	= 'elead-footer-widget-area';
	      	$count++;
	   	}

	   	if ( is_active_sidebar( 'elead-footer-widget-area-2' ) ){
	   		$active_sidebar[] 	= 'elead-footer-widget-area-2';
	      	$count++;
		}

	   	if ( is_active_sidebar( 'elead-footer-widget-area-3' ) ){
	   		$active_sidebar[] 	= 'elead-footer-widget-area-3';
	      	$count++;
	   	}

	   	if ( is_active_sidebar( 'elead-footer-widget-area-4' ) ){
	   		$active_sidebar[] 	= 'elead-footer-widget-area-4';
	      	$count++;
	   	}

	   	$class = '';

	   	switch ( $count ) {
        	case '1':
            $class = 'col-1';
            break;
        	case '2':
            $class = 'col-2';
            break;
        	case '3':
            $class = 'col-3';
            break;
            case '4':
            $class = 'col-4';
            break;
	   	}

		$data['active_sidebar'] = $active_sidebar;
		$data['class']     		= $class;

	   	return $data;
	}
endif;


if ( ! function_exists( 'elead_header_image_meta_option' ) ) :
	/**
	 * Check header image option meta
	 *
	 * @since Elead 0.1
	 *
	 * @return string Header image meta option
	 */
	function elead_header_image_meta_option() {

		$header_image = get_header_image();
		if ( ! is_front_page() ) :		
			if ( is_archive() || is_404() || is_search() ) {
				if ( ! empty( $header_image ) )
					return $header_image;
				else
					return get_template_directory_uri() . '/assets/uploads/banner-01.jpg';
			} else {
				global $post;
				if( is_object( $post ) )
					$post_id = $post->ID;
				else
					$post_id = '';

				$header_image_meta = get_post_meta( $post_id, 'elead-header-image', true );

				if ( 'enable' == $header_image_meta && has_post_thumbnail( $post_id ) ) {
					return wp_get_attachment_url( get_post_thumbnail_id( $post_id ) );
				}elseif ( 'default' == $header_image_meta ) {
					if ( ! empty( $header_image ) )
						return $header_image;
					else
						return get_template_directory_uri() . '/assets/uploads/banner-01.jpg';
				} elseif ( 'disable' == $header_image_meta ) {
					return false;
				} elseif ( 'show-both' == $header_image_meta ) {
					if ( ! empty( $header_image ) )
						$header_img = $header_image;
					else
						$header_img = get_template_directory_uri() . '/assets/uploads/banner-01.jpg';

					$header_image_both_flag = array( $header_img, 'show-both' );
					return $header_image_both_flag;
				} else {
					if ( ! empty( $header_image ) )
						return $header_image;
					else
						return get_template_directory_uri() . '/assets/uploads/banner-01.jpg';
				}
			} 
		endif;
	}
endif;


if ( ! function_exists( 'elead_title_as_per_template' ) ) :
	/**
	 * Return title as per template rendered
	 *
	 * @since Elead 0.1
	 *
	 * @return string Template title
	 */
	function elead_title_as_per_template() {
		if ( is_singular() ) {
			the_title();
		} elseif( is_404() ) {
			esc_html_e( '404', 'elead' );
		} elseif( is_search() ){
			printf( esc_html__( 'Search Result for: %s', 'elead' ), get_search_query() );
		} elseif ( is_archive() ) {
			the_archive_title();
		} elseif ( is_home() ) {
			echo wp_kses_post( get_the_title( get_option( 'page_for_posts') ) );
		}
	}
endif;

if ( ! function_exists( 'elead_get_author_profile' ) ) :
	/**
	 * Function to get author profile
	 *
	 * @since Elead 0.1
	 */           
	function elead_get_author_profile(){
		$options = elead_get_theme_options();
		if ( true === $options['author_box_enable'] ) : ?>

			<div id="about-author">
			    <div class="entry-content">
                    <div class="author-image">
			            <?php echo get_avatar( get_the_author_meta( 'ID' ), 150 );  ?>
			            <div class="author-name">
			            	<h6><?php the_author_posts_link(); ?></h6>
                        	<span class="author"><?php esc_html_e( 'Author', 'elead' ); ?></span>
                        </div><!--.author-name-->         
			        </div>

			        <div class="author-content">
                        <p><?php the_author_meta( 'description' ); ?></p>
                    </div><!-- .author-content --> 
			    </div><!-- .entry-content -->
			</div><!-- #about-author -->
		<?php
		endif;
	}	
endif;
add_action( 'elead_author_profile', 'elead_get_author_profile' );