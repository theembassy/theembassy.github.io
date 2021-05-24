<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Log_Lolla
 */


 /**
  * Add 'continue reading' link text to post content
  *
  * @return string
  */
 function log_lolla_add_readmore_to_content() {
   $arrow = log_lolla_get_arrow_html( 'right' );

	 $read_more = sprintf(
     '%1$s %2$s',
		 /* translators: %s: continue reading. */
		 esc_html_x( 'Continue reading', 'continue-reading', 'log-lolla' ),
		 $arrow
	 );

	 return $read_more;
 }


 /**
  * Add 'continue reading' link text to post excerpt
  *
  * @param [string] $excerpt the post excerpt
  * @return string
  */
 function log_lolla_add_readmore_to_excerpt( $excerpt ) {
   $arrow = log_lolla_get_arrow_html( 'right' );

	 $read_more = sprintf(
		 '<p><a class="more-link" href="' . esc_url( get_permalink() ) . '" title="' . the_title_attribute( 'echo=0') . '">%1$s %2$s</a></p>',
     /* translators: %s: continue reading. */
		 esc_html_x( 'Continue reading', 'continue-reading', 'log-lolla' ),
     $arrow
	 );

	 return $excerpt . $read_more;
 }
 add_filter( 'get_the_excerpt', 'log_lolla_add_readmore_to_excerpt' );




/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function log_lolla_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'log_lolla_body_classes' );



/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function log_lolla_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'log_lolla_pingback_header' );

?>
