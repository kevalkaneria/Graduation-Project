<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Theme Palace
 * @subpackage Elead
 * @since Elead 0.1
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<figure class="featured-image">
        <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
            <?php  
            if ( has_post_thumbnail() ) :
                the_post_thumbnail( 'post-thumbnail', $attr = array( 'alt' => the_title_attribute( 'echo=0' ) ) );
            else :
                echo '<img src="' . esc_url( get_template_directory_uri().'/assets/uploads/no-featured-image-360x300.jpg' ) . '" alt="' . esc_attr( get_the_title() ) . '">';
            endif; 
            ?>
        </a><!-- .post-thumbnail -->

        <p class="entry-meta">
            <?php elead_post_date(); ?>
        </p><!-- .entry-meta -->       
    </figure>
    <div class="entry-container">
        <div class="blog-post-content">
            <header class="entry-header">
                <?php the_category(); ?>
                <?php  
                if ( is_single() ) :
                    the_title( '<h1 class="entry-title">', '</h1>' );
                else :
                    the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
                endif;
                ?>   
            </header>

            <div class="entry-content">
                <p><?php the_excerpt();

                wp_link_pages( array(
                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'elead' ),
                    'after'  => '</div>',
                ) );
                ?>
                </p>
            </div><!-- .entry-content -->
        </div><!-- .blog-post-content -->

        <footer class="entry-footer">
            <p class="entry-meta">
               <a href="<?php the_permalink(); ?>">
                <?php echo ( ! empty( $options['read_more_text'] ) ) ? esc_html( $options['read_more_text'] ) : esc_html_e( 'Read More', 'elead' );  ?>
                </a>
            </p><!-- .entry-meta -->        
        </footer>

    </div><!-- .entry-container -->
</article><!-- #post-## -->