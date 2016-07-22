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

if ( ! class_exists( 'GADWP_Tracking' ) ) {

	class GADWP_Tracking {

		private $gadwp;

		public function __construct() {
			$this->gadwp = GADWP();
			
			add_action( 'wp_head', array( $this, 'tracking_code' ), 99 );
			add_action( 'wp_enqueue_scripts', array( $this, 'load_scripts' ) );
		}

		public function load_scripts() {
			if ( $this->gadwp->config->options['ga_event_tracking'] && ! wp_script_is( 'jquery' ) ) {
				wp_enqueue_script( 'jquery' );
			}
		}

		public function tracking_code() {
			if ( GADWP_Tools::check_roles( $this->gadwp->config->options['ga_track_exclude'], true ) || ( $this->gadwp->config->options['ga_dash_excludesa'] && current_user_can( 'manage_network' ) ) ) {
				return;
			}
			$traking_mode = $this->gadwp->config->options['ga_dash_tracking'];
			$traking_type = $this->gadwp->config->options['ga_dash_tracking_type'];
			if ( $traking_mode > 0 ) {
				if ( ! $this->gadwp->config->options['ga_dash_tableid_jail'] ) {
					return;
				}
				if ( $traking_type == "classic" ) {
					echo "\n<!-- BEGIN GADWP v" . GADWP_CURRENT_VERSION . " Classic Tracking - https://deconf.com/google-analytics-dashboard-wordpress/ -->\n";
					if ( $this->gadwp->config->options['ga_event_tracking'] ) {
						require_once 'tracking/events-classic.php';
					}
					require_once 'tracking/code-classic.php';
					echo "\n<!-- END GADWP Classic Tracking -->\n\n";
				} else {
					echo "\n<!-- BEGIN GADWP v" . GADWP_CURRENT_VERSION . " Universal Tracking - https://deconf.com/google-analytics-dashboard-wordpress/ -->\n";
					if ( $this->gadwp->config->options['ga_event_tracking'] || $this->gadwp->config->options['ga_aff_tracking'] || $this->gadwp->config->options['ga_hash_tracking'] ) {
						require_once 'tracking/events-universal.php';
					}
					require_once 'tracking/code-universal.php';
					echo "\n<!-- END GADWP Universal Tracking -->\n\n";
				}
			}
		}
	}
}
