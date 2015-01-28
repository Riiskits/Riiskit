/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */


( function( $ ) {

	"use strict";

	// Footer text
	wp.customize('footer_text', function(value) {
		value.bind( function(to) {
			$('.site-footer__text').text(to);
		} );
	} );

} )( jQuery );
