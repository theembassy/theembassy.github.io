/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.header-title .text' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.header-subtitle .text' ).text( to );
		} );
	} );


	// Footer copyright
	wp.customize( 'footer_copyright', function( value ) {
		value.bind( function( to ) {
			$( '.footer-copyright .link' ).text( to );
		} );
	} );
	// Footer copyright link
	wp.customize( 'footer_copyright_link', function( value ) {
		value.bind( function( to ) {
			$( '.footer-copyright .link' ).attr( 'href', to );
		} );
	} );


	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.header-title, .header-subtitle' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.header-title, .header-subtitle' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.header-title a, .header-subtitle' ).css( {
					'color': to
				} );
			}
		} );
	} );
} )( jQuery );
