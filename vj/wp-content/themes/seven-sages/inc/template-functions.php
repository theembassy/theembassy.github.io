<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Seven_Sages
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function seven_sages_body_classes_filter_callback( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'seven_sages_body_classes_filter_callback' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function seven_sages_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'seven_sages_pingback_header' );
