/*-
 * Author: Alin Marcu 
 * Author URI: https://deconf.com 
 * Copyright 2013 Alin Marcu 
 * License: GPLv2 or later 
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */

jQuery( window ).resize( function () {
	if ( typeof gadwp_drawFrontWidgetChart == "function" && typeof gadwpFrontWidgetData !== 'undefined' && !jQuery.isNumeric( gadwpFrontWidgetData ) ) {
		gadwp_drawFrontWidgetChart( gadwpFrontWidgetData );
	}
} );