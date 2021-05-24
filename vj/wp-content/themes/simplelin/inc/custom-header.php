<?php
/**
 * Custom header implementation
 *
 * @link https://codex.wordpress.org/Custom_Headers
 *
 * @package Simplelin
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses word_blog_header_style()
 */
function simplelin_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'simplelin_custom_header_args', array(
		'default-image'         => '',
		'default-text-color'    => '333333',
		'width'                 => '1920',
		'height'                => 250,
		'flex-height'           => true,
		'wp-head-callback'      => 'simplelin_header_style',

	) ) );
}
add_action( 'after_setup_theme', 'simplelin_custom_header_setup' );

if ( ! function_exists( 'simplelin_header_style' ) ) :
	/**
	 * Styles the header image and text displayed on the blog.
	 *
	 * @see simplelin_custom_header_setup().
	 */
	function simplelin_header_style() {
		$header_text_color = get_header_textcolor();
		$header_image = get_header_image();

		/*
		 * If no custom options for text are set, let's bail.
		 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
		 */
		if ( empty( $header_image ) && $header_text_color == get_theme_support( 'custom-header', 'default-text-color' ) ) {
			return;
		}

		// If we get this far, we have custom styles. Let's do this.
		?>
		<style>
			.inside-header {
				background: url(<?php header_image(); ?>);
				background-size: cover;
			}

		<?php
			// Has the text been hidden?
			if ( ! display_header_text() ) :
		?>
			.site-title,
			.site-description {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
			}
	<?php
		// If the user has set a custom color for the text use that.
		else :
	?>
		.site-title a,
		.site-description {
			color: #<?php echo esc_attr( $header_text_color ); ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif;