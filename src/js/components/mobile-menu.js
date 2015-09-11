/**
 * Mobile togglemenu
 *
 * @since Riiskit 1.0.0
 */

jQuery(function ($) {

    "use strict";

	// Cache vars
	var body    = $('body');
    var nav     = $('.site-header__nav');
    var menu    = $('.menu-primary');
    var button  = $('.toggle-menu-btn');

	// Other vars
	var menuBreakpoint = 649;
	var active = false;

    if ( !nav || !button ) {
        return;
    }
    if ( !menu || !menu.children().length ) {
        button.addClass('hide');
        return;
    }

    // Toggle functionality
   button.on('click.riiskit', function(){
        menu.toggleClass('active');
        $(this).toggleClass('active');

        if ( active === false ) {
            active = true;
            $(this).attr('aria-pressed', 'true');
        } else {
	        active = false;
	        $(this).attr('aria-pressed', 'false');
        }
    });

    // Make the menu visible again if it's is closed while
    // the window is resized past the breakpoint.
    $.selector_cache(window).on('resize.riiskit', function(){
        if ( $.selector_cache(window).width() >= menuBreakpoint ) {
            menu.addClass('show');
        } else {
            if ( !menu.hasClass('active') ) {
                menu.removeClass('show');
            }
        }
    });

}); // end jQuery document ready
