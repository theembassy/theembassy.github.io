<?php
/**
 * Simplelin Theme Customizer.
 *
 * @package Simplelin
 */

/**
 * Add postMessage support for site title and description for theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function simplelin_customize_register( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
				'selector'          => '.site-title a',
				'render_callback'   => 'simplelin_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
				'selector'          => '.site-description',
				'render_callback'   => 'simplelin_customize_partial_blogdescription',
		) );
	}
}
add_action( 'customize_register', 'simplelin_customize_register' );

/**
 * Render the site title for selective refresh partial.
 */
function simplelin_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site title for selective refresh partial.
 */
function simplelin_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Embed JS file make Theme Customizer preview reload changes asynchronously.
 */
function simplelin_customize_preview_js() {
	wp_enqueue_script( 'simplelin_customize_preview', get_template_directory_uri() . '/assets/js/customize-preview.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'simplelin_customize_preview_js' );

if ( ! function_exists( 'simplelin_sanitize_checkbox' ) ) :
	/**
	 * Sanitization callback 'checkbox' type controls. This callback sanitizes '$checked'
	 * as a boolean value, either TRUE or FALSE.
	 *
	 * @param bool $checked Whwther the checkbox is checked.
	 * @return bool Whether the checkbox is checked.
	 */
	function simplelin_sanitize_checkbox( $checked ) {
		// Boolean check.
		return ( ( isset( $checked ) && true == $checked ) ? true : false );
	}
endif;