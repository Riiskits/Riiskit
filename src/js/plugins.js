
/**
 * Small helper plugins
 *
 * @since Riiskit 1.0.0
 */

/**
 * Better way to cache jQuery selectors.
 *
 * Usage: $.selector_cache('.element');
 *
 * @link https://eamann.com/tech/selector-caching-jquery/#comment-41220
 * @todo https://gist.github.com/jtsternberg/14978579a9edf42ed069
 *
 * @since Riiskit 1.0.0
 */

( function ($){
	$.selector_cache = function (selector) {
		if ( ! $.selector_cache[selector] ) {
			$.selector_cache[selector] = $(selector);
		}

		return $.selector_cache[selector];
	};
}(jQuery));


/**
 * Makes "skip to content" link work correctly in IE9, Chrome, and Opera
 * for better accessibility.
 *
 * @link http://www.nczonline.net/blog/2013/01/15/fixing-skip-to-content-links/
 *
 * @since Riiskit 1.0.0
 */

( function (){
	var ua = navigator.userAgent.toLowerCase();

	if ( ( ua.indexOf( 'webkit' ) > -1 || ua.indexOf( 'opera' ) > -1 || ua.indexOf( 'msie' ) > -1 ) &&
		document.getElementById && window.addEventListener ) {

		window.addEventListener( 'hashchange', function() {
			var element = document.getElementById( location.hash.substring( 1 ) );

			if ( element ) {
				if ( ! /^(?:a|select|input|button|textarea)$/i.test( element.nodeName ) ) {
					element.tabIndex = -1;
				}

				element.focus();
			}
		}, false );
	}
}());
