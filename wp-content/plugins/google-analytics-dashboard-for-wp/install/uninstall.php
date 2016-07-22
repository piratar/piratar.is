<?php
/**
 * Author: Alin Marcu
 * Author URI: https://deconf.com
 * Copyright 2013 Alin Marcu 
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) )
	exit();

class GADWP_Uninstall {

	public static function uninstall() {
		global $wpdb;
		if ( is_multisite() ) { // Cleanup Network install
			foreach ( wp_get_sites( array( 'limit' => apply_filters( 'gadwp_sites_limit', 100 ) ) ) as $blog ) {
				switch_to_blog( $blog['blog_id'] );
				$sqlquery = $wpdb->query( "DELETE FROM $wpdb->options WHERE option_name LIKE 'gadwp_cache_%%'" );
				delete_option( 'gadash_options' );
				restore_current_blog();
			}
			delete_site_option( 'gadash_network_options' );
		} else { // Cleanup Single install
			$sqlquery = $wpdb->query( "DELETE FROM $wpdb->options WHERE option_name LIKE 'gadwp_cache_%%'" );
			delete_option( 'gadash_options' );
		}
		GADWP_Tools::unset_cookie( 'default_metric' );
		GADWP_Tools::unset_cookie( 'default_dimension' );
		GADWP_Tools::unset_cookie( 'default_view' );
	}
}
