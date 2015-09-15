
/**
 * Small helper plugins
 *
 * @since Riiskit 1.0.0
 */

'use strict';

(function (b, c) {
  var $ = b.jQuery || b.Cowboy || (b.Cowboy = {}),
      a;$.throttle = a = function (e, f, j, i) {
    var h,
        d = 0;if (typeof f !== "boolean") {
      i = j;j = f;f = c;
    }function g() {
      var o = this,
          m = +new Date() - d,
          n = arguments;function l() {
        d = +new Date();j.apply(o, n);
      }function k() {
        h = c;
      }if (i && !h) {
        l();
      }h && clearTimeout(h);if (i === c && m > e) {
        l();
      } else {
        if (f !== true) {
          h = setTimeout(i ? k : l, i === c ? e - m : e);
        }
      }
    }if ($.guid) {
      g.guid = j.guid = j.guid || $.guid++;
    }return g;
  };$.debounce = function (d, e, f) {
    return f === c ? a(d, e, false) : a(d, f, e !== false);
  };
})(undefined);

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
  $.selector_cache = function (selector) {
    if (!$.selector_cache[selector]) {
      $.selector_cache[selector] = $(selector);
    }

    return $.selector_cache[selector];
  };
})(jQuery);

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
/*
 * jQuery throttle / debounce - v1.1 - 3/7/2010
 * http://benalman.com/projects/jquery-throttle-debounce-plugin/
 *
 * Copyright (c) 2010 "Cowboy" Ben Alman
 * Dual licensed under the MIT and GPL licenses.
 * http://benalman.com/about/license/
 *
 * @since Riiskit 1.0.0
 */