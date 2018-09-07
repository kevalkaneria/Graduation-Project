<?php
/**
 * The template for displaying search form
 *
 * @package Theme Palace
 * @subpackage Elead
 * @since Elead 0.1
 */

?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url('/') ); ?>">
	<label>
		<span class="screen-reader-text"><?php esc_html_e( 'Search for:', 'elead' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php esc_attr_e( 'Search', 'elead' ) ?>" value="<?php echo get_search_query(); ?>" name="s">
	</label>
	<button type="submit" class="search-submit"><span class="screen-reader-text"><?php esc_html_e( 'Search', 'elead' ); ?></span><i class="fa fa-search"></i></button>
</form><!--.search-form-->