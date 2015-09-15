/**
 * Setup namespace etc.
 *
 * @since Riiskit 1.0.0
 */

// Setup namespace
'use strict';

var riiskit = riiskit || {};

/**
 * Makes "skip to content" link work correctly in IE9, Chrome, and Opera
 * for better accessibility.
 *
 * @link http://www.nczonline.net/blog/2013/01/15/fixing-skip-to-content-links/
 *
 * @since Riiskit 1.0.0
 */

(function () {
    'use strict';

    var ua = navigator.userAgent.toLowerCase();

    if ((ua.indexOf('webkit') > -1 || ua.indexOf('opera') > -1 || ua.indexOf('msie') > -1) && document.getElementById && window.addEventListener) {

        window.addEventListener('hashchange', function () {
            var element = document.getElementById(location.hash.substring(1));

            if (element) {
                if (!/^(?:a|select|input|button|textarea)$/i.test(element.nodeName)) {
                    element.tabIndex = -1;
                }

                element.focus();
            }
        }, false);
    }
})();
/**
 * Small helper plugins
 *
 * @since Riiskit 1.0.0
 */

'use strict';

riiskit.utils = {};

/*
 * Utilities taken from Underscore.
 *
 * It's slightly modified.
 *
 * Underscore.js 1.8.3
 * http://underscorejs.org
 * (c) 2009-2015 Jeremy Ashkenas, DocumentCloud and Investigative Reporters & Editors
 * Underscore may be freely distributed under the MIT license.
 *
 * @since Riiskit 2.0.0
 */

riiskit.utils.debounce = function (func, wait, immediate) {
    var now = Date.now || function () {
        return new Date().getTime();
    };
    var timeout, args, context, timestamp, result;

    var later = function later() {
        var last = now - timestamp;

        if (last < wait && last >= 0) {
            timeout = setTimeout(later, wait - last);
        } else {
            timeout = null;
            if (!immediate) {
                result = func.apply(context, args);
                if (!timeout) context = args = null;
            }
        }
    };

    return function () {
        context = this;
        args = arguments;
        timestamp = now;
        var callNow = immediate && !timeout;
        if (!timeout) timeout = setTimeout(later, wait);
        if (callNow) {
            result = func.apply(context, args);
            context = args = null;
        }

        return result;
    };
};

riiskit.utils.throttle = function (func, wait, options) {
    var now = Date.now || function () {
        return new Date().getTime();
    };
    var context, args, result;
    var timeout = null;
    var previous = 0;

    if (!options) options = {};

    var later = function later() {
        previous = options.leading === false ? 0 : now;
        timeout = null;
        result = func.apply(context, args);
        if (!timeout) context = args = null;
    };

    return function () {
        if (!previous && options.leading === false) previous = now;
        var remaining = wait - (now - previous);
        context = this;
        args = arguments;
        if (remaining <= 0 || remaining > wait) {
            if (timeout) {
                clearTimeout(timeout);
                timeout = null;
            }
            previous = now;
            result = func.apply(context, args);
            if (!timeout) context = args = null;
        } else if (!timeout && options.trailing !== false) {
            timeout = setTimeout(later, remaining);
        }
        return result;
    };
};

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

(function ($) {
    'use strict';

    $.selector_cache = function (selector) {
        if (!$.selector_cache[selector]) {
            $.selector_cache[selector] = $(selector);
        }

        return $.selector_cache[selector];
    };
})(jQuery);