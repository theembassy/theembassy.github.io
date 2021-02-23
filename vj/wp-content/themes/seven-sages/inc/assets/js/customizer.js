/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	/**
	 * Container width for Page
	 *
	 * Applied for:
	 *
	 * Entire Site
	 */
	wp.customize( 'seven-sages[container-width-site]', function( value ) {
		value.bind( function( newval ) {
			var selector  = '.site-content,';
				selector += '.ss-custom-headers.default-width,';
				selector += '.site-header .ss-header-container,';
				selector += '.site-footer .ss-container';

			if ( jQuery( 'style#container_width_site' ).length ) {
				jQuery( 'style#container_width_site' ).html( selector + ' { max-width:' + newval + 'px;}' );
			} else {
				jQuery( 'head' ).append( '<style id="container_width_site"> ' + selector + ' { max-width:' + newval + 'px;}</style>' );
				setTimeout(function() {
					jQuery( 'style#container_width_site' ).not( ':last' ).remove();
				}, 100);
			}
		} );
	} );

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-title a, .site-description' ).css( {
					'color': to
				} );
			}
		} );
	} );
} )( jQuery );
