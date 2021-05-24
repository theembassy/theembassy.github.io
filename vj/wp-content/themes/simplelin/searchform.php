<?php
/**
 * Template for displaying search forms in Simplelin
 *
 * @package Simplelin
 */

?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search...', 'placeholder', 'simplelin' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
		<button type="submit" class="search-submit"><i class="fa fa-search fa-lg"></i></button>
	</label>
</form>