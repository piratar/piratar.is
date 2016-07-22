/*-
 * Author: Alin Marcu Author 
 * URI: https://deconf.com 
 * Copyright 2013 Alin Marcu 
 * License: GPLv2 or later 
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */

jQuery(function () {
      jQuery('#gadwp-widget *').tooltip({
		  items: "[data-gadwp]",
          content: function () {
              return jQuery(this).attr("data-gadwp");
          }
      });
  });
