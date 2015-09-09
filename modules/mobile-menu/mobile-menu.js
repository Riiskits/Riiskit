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
