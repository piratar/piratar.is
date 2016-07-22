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

if ( ! class_exists( 'GADWP_Backend_Ajax' ) ) {

	final class GADWP_Backend_Ajax {

		private $gadwp;

		public function __construct() {
			$this->gadwp = GADWP();
			
			if ( GADWP_Tools::check_roles( $this->gadwp->config->options['ga_dash_access_back'] ) && ( ( 1 == $this->gadwp->config->options['backend_item_reports'] ) || ( 1 == $this->gadwp->config->options['dashboard_widget'] ) ) ) {
				// Items action
				add_action( 'wp_ajax_gadwp_backend_item_reports', array( $this, 'ajax_item_reports' ) );
			}
			if ( current_user_can( 'manage_options' ) ) {
				// Admin Widget action
				add_action( 'wp_ajax_gadwp_dismiss_notices', array( $this, 'ajax_dismiss_notices' ) );
			}
		}

		/**
		 * Ajax handler for Item Reports
		 *
		 * @return json|int
		 */
		public function ajax_item_reports() {
			if ( ! isset( $_POST['gadwp_security_backend_item_reports'] ) || ! wp_verify_nonce( $_POST['gadwp_security_backend_item_reports'], 'gadwp_backend_item_reports' ) ) {
				wp_die( - 30 );
			}
			if ( isset( $_POST['projectId'] ) && $this->gadwp->config->options['switch_profile'] && $_POST['projectId'] !== 'false' ) {
				$projectId = $_POST['projectId'];
			} else {
				$projectId = false;
			}
			$from = $_POST['from'];
			$to = $_POST['to'];
			$query = $_POST['query'];
			if ( isset( $_POST['filter'] ) ) {
				$filter_id = $_POST['filter'];
			} else {
				$filter_id = false;
			}
			if ( ob_get_length() ) {
				ob_clean();
			}
			
			if ( ! ( GADWP_Tools::check_roles( $this->gadwp->config->options['ga_dash_access_back'] ) && ( ( 1 == $this->gadwp->config->options['backend_item_reports'] ) || ( 1 == $this->gadwp->config->options['dashboard_widget'] ) ) ) ) {
				wp_die( - 31 );
			}
			if ( $this->gadwp->config->options['ga_dash_token'] && $this->gadwp->config->options['ga_dash_tableid_jail'] && $from && $to ) {
				if ( null === $this->gadwp->gapi_controller ) {
					$this->gadwp->gapi_controller = new GADWP_GAPI_Controller();
				}
			} else {
				wp_die( - 24 );
			}
			if ( $projectId == false ) {
				$projectId = $this->gadwp->config->options['ga_dash_tableid_jail'];
			}
			$profile_info = GADWP_Tools::get_selected_profile( $this->gadwp->config->options['ga_dash_profile_list'], $projectId );
			if ( isset( $profile_info[4] ) ) {
				$this->gadwp->gapi_controller->timeshift = $profile_info[4];
			} else {
				$this->gadwp->gapi_controller->timeshift = (int) current_time( 'timestamp' ) - time();
			}
			
			if ( $filter_id ) {
				$uri_parts = explode( '/', get_permalink( $filter_id ), 4 );
				
				if ( isset( $uri_parts[3] ) ) {
					$uri = '/' . $uri_parts[3];
				} else {
					wp_die( - 25 );
				}
				
				// allow URL correction before sending an API request
				$filter = apply_filters( 'gadwp_backenditem_uri', $uri );
				
				$lastchar = substr( $filter, - 1 );
				
				if ( isset( $profile_info[6] ) && $profile_info[6] && $lastchar == '/' ) {
					$filter = $filter . $profile_info[6];
				}
				
				// Encode URL
				$filter = rawurlencode( rawurldecode( $filter ) );
			} else {
				$filter = false;
			}
			
			$queries = explode( ',', $query );
			
			$results = array();
			
			foreach ( $queries as $value ) {
				$results[] = $this->gadwp->gapi_controller->get( $projectId, $value, $from, $to, $filter );
			}
			
			wp_send_json( $results );
		}

		/**
		 * Ajax handler for dismissing Admin notices
		 *
		 * @return json|int
		 */
		public function ajax_dismiss_notices() {
			if ( ! isset( $_POST['gadwp_security_dismiss_notices'] ) || ! wp_verify_nonce( $_POST['gadwp_security_dismiss_notices'], 'gadwp_dismiss_notices' ) ) {
				wp_die( - 30 );
			}
			
			if ( ! current_user_can( 'manage_options' ) ) {
				wp_die( - 31 );
			}
			
			delete_option( 'gadwp_got_updated' );
			
			wp_die();
		}
	}
}
