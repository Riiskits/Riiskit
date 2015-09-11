/*
 * This is the main script used to init stuff etc.
 *
 * @since Riiskit 1.0.0
 */

jQuery(function ($) {

    "use strict";

	// your code here

}); // end jQuery document ready


/**
 * Small plugins
 *
 * @since Riiskit 1.0.0
 */

/**
 * Avoid console errors in browsers that lack a console.
 *
 * @since Riiskit 1.0.0
 */

(function() {
    var method;
    var noop = function () {};
    var methods = [
        'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
        'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
        'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
        'timeline', 'timelineEnd', 'timeStamp', 'trace', 'warn'
    ];
    var length = methods.length;
    var console = (window.console = window.console || {});

    while (length--) {
        method = methods[length];

        // Only stub undefined methods.
        if (!console[method]) {
            console[method] = noop;
        }
    }
}());


/**
 * Better way to cache jQuery selectors
 *
 * Usage: $.selector_cache('.element');
 *
 * @link https://eamann.com/tech/selector-caching-jquery/#comment-41220
 * @todo https://gist.github.com/jtsternberg/14978579a9edf42ed069
 *
 * @since Riiskit 1.0.0
 */

(function ($) {
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

(function () {
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

/**
 * Mobile menu
 *
 * @since Riiskit 1.0.0
 */

jQuery(function ($) {

    "use strict";


	// Cache vars
	var body = $('body');

	// Other vars
	var menuBreakpoint = 649; // Use the same breakpoint as defined in CSS
	var active	= false;

	var nav		= $('.site-header__nav');
	var menu	= $('.menu-primary');
	var button	= $('.toggle-menu-btn');

    if ( ! nav || ! button ) {
        return;
    }
    if ( ! menu || ! menu.children().length ) {
        button.addClass('hide');
        return;
    }


    // Toggle
    if ( body.hasClass('mobile-menu-type__toggle') ) {

        (function () {
           button.on('click.riiskit', function() {
                menu.toggleClass('active');

                if ( active === false ) {
	                active = true;

		            $(this).attr('aria-pressed', 'true');
		        } else {
			        active = false;

			        $(this).attr('aria-pressed', 'false');
		        }
            } );

            // Make the menu visible again if it's is closed while
            // the window is resized past the breakpoint
            $.selector_cache(window).on('resize.riiskit', function() {
                if ( $.selector_cache(window).width() >= menuBreakpoint ) {
                    menu.addClass('show');
                } else {
                    if ( ! menu.hasClass('active') ) {
                        menu.removeClass('show');
                    }
                }
            });
        } ());
    } // end toggle


    // Slideout with sidr.js
    if ( body.hasClass('mobile-menu-type__slideout') && jQuery().sidr ) {

        (function () {
	        var sidrIsOpen = false;
	        var sidrSelector = 'rk-slideout';

			menu.attr('id', 'rk-slideout');


            // Config, and adding / removing click outside listener for closing
            button.sidr({
                name: sidrSelector,
                side: 'right',
                onOpen: function(){
                    sidrIsOpen = true;
                    button.attr('aria-pressed', 'true');
                    // Add listener for clicks outside the menu when open
                    $.selector_cache('.site-header, .site-main, .site-footer').on('click.riiskit', function() {
                        $.sidr('close', sidrSelector);
                        button.attr('aria-pressed', 'false');
                    });
                },
                onClose: function(){
                    sidrIsOpen = false;
                    button.attr('aria-pressed', 'false');
                     $.selector_cache('.site-header, .site-main, .site-footer').off('click.riiskit');
                },
                displace: false,
            });

            // resized window past the breakpoint
            $.selector_cache(window).on('resize.riiskit', function() {
                if( $.selector_cache(window).width() >= menuBreakpoint ) {
                    if ( sidrIsOpen ) {
                    	$.sidr('close', sidrSelector);

                    	button.attr('aria-pressed', 'false');
                    }

                    menu.addClass('show');
                } else {
                    menu.removeClass('show');
                }
            });
        } ());
    } // end slideout

}); // end jQuery document ready
