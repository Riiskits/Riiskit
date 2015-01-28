
// Author: Christoffer Riis

jQuery( function($) {

    "use strict";



    // use the same breakpoint as defined in CSS
    var menuBreakpoint = 649;



    // ===== CSS3 SUPPORT DETECTION =====

	// svg
	if ( ! document.implementation.hasFeature('http://www.w3.org/TR/SVG11/feature#Image', '1.1') ) {
		document.documentElement.className += ' no-svg';
	}



    // ===== MOBILE MENU =====

	( function() {

		var nav = $.selector_cache('.site-header__nav'),
        	button,
        	menu;

        if ( ! nav ) {
            return;
        }

        button = nav.find('.toggle-menu-btn');
        if ( ! button ) {
            return;
        }

        menu = nav.find('.menu-primary');
        if ( ! menu || ! menu.children().length ) {
            button.addClass('hide');
            return;
        }


	    // Toggle

	    if ( $.selector_cache('body').hasClass('mobile-menu-type__toggle') ) {

	        ( function() {
	           button.on('click.riiskit', function() {
	                menu.toggleClass('active');
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

	    if ( $.selector_cache('body').hasClass('mobile-menu-type__slideout') && jQuery().sidr ) {

	        ( function() {
		        var sidrIsOpen = false;
		        var sidrSelector = 'rk-slideout';

				menu.attr('id', 'rk-slideout');


				// Config
	            if ( $.selector_cache('body').hasClass('mobile-menu-pos--left') ) {
	                $.selector_cache('.toggle-menu-btn').sidr({
	                    name: sidrSelector,
	                    side: 'left',
	                    onOpen: function(){ sidrIsOpen = true; },
	                    onClose: function(){ sidrIsOpen = false; },
	                    displace: false,
	                });
	            } else {
	                $.selector_cache('.toggle-menu-btn').sidr({
	                    name: sidrSelector,
	                    side: 'right',
	                    onOpen: function(){ sidrIsOpen = true; },
	                    onClose: function(){ sidrIsOpen = false; },
	                    displace: false,
	                });
	            }


	            // Closing sidr

	            // clicked outside sidr
	            $.selector_cache('.site-header, .primary, .site-footer').on('click.riiskit', function() {
	                $.sidr('close', sidrSelector);
	            });

	            // resized window past the breakpoint
	            $.selector_cache(window).on('resize.riiskit', function() {
	                if( $.selector_cache(window).width() >= menuBreakpoint ) {
	                    if ( sidrIsOpen ) {
	                    	$.sidr('close', sidrSelector);
	                    }

	                    menu.addClass('show');
	                } else {
	                    menu.removeClass('show');
	                }
	            });
	        } ());
	    } // end slideout
	} ()); // end mobile menu
});
