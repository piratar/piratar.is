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

if ( ! class_exists( 'GADWP_Common_Ajax' ) ) {

	final class GADWP_Common_Ajax {

		private $gadwp;

		public function __construct() {
			$this->gadwp = GADWP();
			
			if ( GADWP_Tools::check_roles( $this->gadwp->config->options['ga_dash_access_back'] ) || GADWP_Tools::check_roles( $this->gadwp->config->options['ga_dash_access_front'] ) ) {
				add_action( 'wp_ajax_gadwp_set_error', array( $this, 'ajax_set_error' ) );
			}
		}

		/**
		 * Ajax handler for storing JavaScript Errors
		 *
		 * @return json|int
		 */
		public function ajax_set_error() {
			if ( ! isset( $_POST['gadwp_security_set_error'] ) || ! ( wp_verify_nonce( $_POST['gadwp_security_set_error'], 'gadwp_backend_item_reports' ) || wp_verify_nonce( $_POST['gadwp_security_set_error'], 'gadwp_frontend_item_reports' ) ) ) {
				wp_die( - 40 );
			}
			
			GADWP_Tools::set_cache( 'last_error', date( 'Y-m-d H:i:s' ) . ': ' . esc_html( $_POST['response'] ), 24 * 60 * 60 );
			
			wp_die();
		}
	}
}
