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

if ( ! class_exists( 'GADWP_Config' ) ) {

	final class GADWP_Config {

		public $options;

		public function __construct() {
			// Get plugin options
			$this->get_plugin_options();
			// Automatic updates
			add_filter( 'auto_update_plugin', array( $this, 'automatic_update' ), 10, 2 );
			// Provide language packs for all available Network languages
			if ( is_multisite() ) {
				add_filter( 'plugins_update_check_locales', array( $this, 'translation_updates' ), 10, 1 );
			}
		}

		public function get_major_version( $version ) {
			$exploded_version = explode( '.', $version );
			if ( isset( $exploded_version[2] ) ) {
				return $exploded_version[0] . '.' . $exploded_version[1] . '.' . $exploded_version[2];
			} else {
				return $exploded_version[0] . '.' . $exploded_version[1] . '.0';
			}
		}

		public function automatic_update( $update, $item ) {
			$item = (array) $item;
			if ( is_multisite() && ! is_main_site() ) {
				return;
			}
			if ( ! isset( $item['new_version'] ) || ! isset( $item['plugin'] ) || ! $this->options['automatic_updates_minorversion'] ) {
				return $update;
			}
			if ( isset( $item['slug'] ) && $item['slug'] == 'google-analytics-dashboard-for-wp' ) {
				// Only when a minor update is available
				return ( $this->get_major_version( GADWP_CURRENT_VERSION ) == $this->get_major_version( $item['new_version'] ) );
			}
			return $update;
		}

		public function translation_updates( $locales ) {
			$languages = get_available_languages();
			return array_values( $languages );
		}

		// Validates data before storing
		private static function validate_data( $options ) {
			if ( isset( $options['ga_realtime_pages'] ) ) {
				$options['ga_realtime_pages'] = (int) $options['ga_realtime_pages'];
			}
			if ( isset( $options['ga_crossdomain_tracking'] ) ) {
				$options['ga_crossdomain_tracking'] = (int) $options['ga_crossdomain_tracking'];
			}
			if ( isset( $options['ga_crossdomain_list'] ) ) {
				$options['ga_crossdomain_list'] = sanitize_text_field( $options['ga_crossdomain_list'] );
			}
			if ( isset( $options['ga_dash_clientid'] ) ) {
				$options['ga_dash_clientid'] = sanitize_text_field( $options['ga_dash_clientid'] );
			}
			if ( isset( $options['ga_dash_clientsecret'] ) ) {
				$options['ga_dash_clientsecret'] = sanitize_text_field( $options['ga_dash_clientsecret'] );
			}
			if ( isset( $options['ga_dash_style'] ) ) {
				$options['ga_dash_style'] = sanitize_text_field( $options['ga_dash_style'] );
			}
			if ( isset( $options['ga_event_downloads'] ) ) {
				if ( empty( $options['ga_event_downloads'] ) ) {
					$options['ga_event_downloads'] = 'zip|mp3*|mpe*g|pdf|docx*|pptx*|xlsx*|rar*';
				}
				$options['ga_event_downloads'] = sanitize_text_field( $options['ga_event_downloads'] );
			}
			if ( isset( $options['ga_speed_samplerate'] ) && ( $options['ga_speed_samplerate'] < 1 || $options['ga_speed_samplerate'] > 100 ) ) {
				$options['ga_speed_samplerate'] = 1;
			}
			if ( isset( $options['ga_target_geomap'] ) ) {
				$options['ga_target_geomap'] = sanitize_text_field( $options['ga_target_geomap'] );
			}
			if ( isset( $options['ga_author_dimindex'] ) ) {
				$options['ga_author_dimindex'] = (int) $options['ga_author_dimindex'];
			}
			if ( isset( $options['ga_category_dimindex'] ) ) {
				$options['ga_category_dimindex'] = (int) $options['ga_category_dimindex'];
			}
			if ( isset( $options['ga_tag_dimindex'] ) ) {
				$options['ga_tag_dimindex'] = (int) $options['ga_tag_dimindex'];
			}
			if ( isset( $options['ga_user_dimindex'] ) ) {
				$options['ga_user_dimindex'] = (int) $options['ga_user_dimindex'];
			}
			if ( isset( $options['ga_pubyear_dimindex'] ) ) {
				$options['ga_pubyear_dimindex'] = (int) $options['ga_pubyear_dimindex'];
			}
			if ( isset( $options['ga_aff_tracking'] ) ) {
				$options['ga_aff_tracking'] = (int) $options['ga_aff_tracking'];
			}
			if ( isset( $options['ga_cookiedomain'] ) ) { // v4.9
				$options['ga_cookiedomain'] = sanitize_text_field( $options['ga_cookiedomain'] );
			}
			if ( isset( $options['ga_cookiename'] ) ) { // v4.9
				$options['ga_cookiename'] = sanitize_text_field( $options['ga_cookiename'] );
			}
			if ( isset( $options['ga_cookieexpires'] ) && $options['ga_cookieexpires'] ) { // v4.9
				$options['ga_cookieexpires'] = (int) $options['ga_cookieexpires'];
			}
			if ( isset( $options['ga_event_affiliates'] ) ) {
				if ( empty( $options['ga_event_affiliates'] ) ) {
					$options['ga_event_affiliates'] = '/out/';
				}
				$options['ga_event_affiliates'] = sanitize_text_field( $options['ga_event_affiliates'] );
			}

			$token = json_decode( $options['ga_dash_token'] ); // v4.8.2
			if ( isset( $token->token_type ) ) {
				unset( $options['ga_dash_refresh_token'] );
			}

			return $options;
		}

		public function set_plugin_options( $network_settings = false ) {
			// Handle Network Mode
			$options = $this->options;
			$get_network_options = get_site_option( 'gadash_network_options' );
			$old_network_options = (array) json_decode( $get_network_options );
			if ( is_multisite() ) {
				if ( $network_settings ) { // Retrieve network options, clear blog options, store both to db
					$network_options['ga_dash_token'] = $this->options['ga_dash_token'];
					$options['ga_dash_token'] = '';
					if ( is_network_admin() ) {
						$network_options['ga_dash_profile_list'] = $this->options['ga_dash_profile_list'];
						$options['ga_dash_profile_list'] = array();
						$network_options['ga_dash_clientid'] = $this->options['ga_dash_clientid'];
						$options['ga_dash_clientid'] = '';
						$network_options['ga_dash_clientsecret'] = $this->options['ga_dash_clientsecret'];
						$options['ga_dash_clientsecret'] = '';
						$network_options['ga_dash_userapi'] = $this->options['ga_dash_userapi'];
						$options['ga_dash_userapi'] = 0;
						$network_options['ga_dash_network'] = $this->options['ga_dash_network'];
						$network_options['ga_dash_excludesa'] = $this->options['ga_dash_excludesa'];
						$network_options['automatic_updates_minorversion'] = $this->options['automatic_updates_minorversion'];
						unset( $options['ga_dash_network'] );
						if ( isset( $this->options['ga_dash_tableid_network'] ) ) {
							$network_options['ga_dash_tableid_network'] = $this->options['ga_dash_tableid_network'];
							unset( $options['ga_dash_tableid_network'] );
						}
					}
					update_site_option( 'gadash_network_options', json_encode( $this->validate_data( array_merge( $old_network_options, $network_options ) ) ) );
				}
			}
			update_option( 'gadash_options', json_encode( $this->validate_data( $options ) ) );
		}

		private function get_plugin_options() {
			/*
			 * Get plugin options
			 */
			global $blog_id;

			if ( ! get_option( 'gadash_options' ) ) {
				GADWP_Install::install();
			}
			$this->options = (array) json_decode( get_option( 'gadash_options' ) );
			// Maintain Compatibility
			$this->maintain_compatibility();
			// Handle Network Mode
			if ( is_multisite() ) {
				$get_network_options = get_site_option( 'gadash_network_options' );
				$network_options = (array) json_decode( $get_network_options );
				if ( isset( $network_options['ga_dash_network'] ) && ( $network_options['ga_dash_network'] ) ) {
					if ( ! is_network_admin() && ! empty( $network_options['ga_dash_profile_list'] ) && isset( $network_options['ga_dash_tableid_network']->$blog_id ) ) {
						$network_options['ga_dash_profile_list'] = array( 0 => GADWP_Tools::get_selected_profile( $network_options['ga_dash_profile_list'], $network_options['ga_dash_tableid_network']->$blog_id ) );
						$network_options['ga_dash_tableid_jail'] = $network_options['ga_dash_profile_list'][0][1];
					}
					$this->options = array_merge( $this->options, $network_options );
				} else {
					$this->options['ga_dash_network'] = 0;
				}
			}
		}

		private function maintain_compatibility() {
			$flag = false;

			if ( GADWP_CURRENT_VERSION != get_option( 'gadwp_version' ) ) {
				$flag = true;
				update_option( 'gadwp_version', GADWP_CURRENT_VERSION );
				update_option( 'gadwp_got_updated', true );
				$rebuild_token = json_decode( $this->options['ga_dash_token'] ); // v4.8.2
				if ( is_object( $rebuild_token ) && ! isset( $rebuild_token->token_type ) ) {
					if ( isset( $this->options['ga_dash_refresh_token'] ) ) {
						$rebuild_token->refresh_token = $this->options['ga_dash_refresh_token'];
					}
					$rebuild_token->token_type = "Bearer";
					$this->options['ga_dash_token'] = json_encode( $rebuild_token );
					unset( $this->options['ga_dash_refresh_token'] );
					$this->set_plugin_options( true );
				} else {
					unset( $this->options['ga_dash_refresh_token'] );
				}
				GADWP_Tools::clear_cache();
				GADWP_Tools::delete_cache( 'last_error' );
				if ( is_multisite() ) { // Cleanup errors and cookies on the entire network
					foreach ( wp_get_sites( array( 'limit' => apply_filters( 'gadwp_sites_limit', 100 ) ) ) as $blog ) {
						switch_to_blog( $blog['blog_id'] );
						GADWP_Tools::delete_cache( 'gapi_errors' );
						restore_current_blog();
					}
				} else {
					GADWP_Tools::delete_cache( 'gapi_errors' );
				}
				GADWP_Tools::unset_cookie( 'default_metric' );
				GADWP_Tools::unset_cookie( 'default_dimension' );
				GADWP_Tools::unset_cookie( 'default_view' );
			}
			if ( ! isset( $this->options['ga_enhanced_links'] ) ) {
				$this->options['ga_enhanced_links'] = 0;
				$flag = true;
			}
			if ( ! isset( $this->options['ga_dash_network'] ) ) {
				$this->options['ga_dash_network'] = 0;
				$flag = true;
			}
			if ( ! isset( $this->options['ga_enhanced_excludesa'] ) ) {
				$this->options['ga_dash_excludesa'] = 0;
				$flag = true;
			}
			if ( ! isset( $this->options['ga_dash_remarketing'] ) ) {
				$this->options['ga_dash_remarketing'] = 0;
				$flag = true;
			}
			if ( ! isset( $this->options['ga_dash_adsense'] ) ) {
				$this->options['ga_dash_adsense'] = 0;
				$flag = true;
			}
			if ( ! isset( $this->options['ga_speed_samplerate'] ) ) {
				$this->options['ga_speed_samplerate'] = 1;
				$flag = true;
			}
			if ( ! isset( $this->options['automatic_updates_minorversion'] ) ) {
				$this->options['automatic_updates_minorversion'] = 1;
				$flag = true;
			}
			if ( ! isset( $this->options['ga_event_bouncerate'] ) ) {
				$this->options['ga_event_bouncerate'] = 0;
				$flag = true;
			}
			if ( ! is_array( $this->options['ga_dash_access_front'] ) || empty( $this->options['ga_dash_access_front'] ) ) {
				$this->options['ga_dash_access_front'] = array();
				$this->options['ga_dash_access_front'][] = 'administrator';
				$flag = true;
			}

			if ( ! is_array( $this->options['ga_dash_profile_list'] ) ) {
				$this->options['ga_dash_profile_list'] = array();
				$flag = true;
			}

			if ( ! is_array( $this->options['ga_dash_access_back'] ) || empty( $this->options['ga_dash_access_back'] ) ) {
				$this->options['ga_dash_access_back'] = array();
				$this->options['ga_dash_access_back'][] = 'administrator';
				$flag = true;
			}
			if ( ! is_array( $this->options['ga_track_exclude'] ) ) {
				$this->options['ga_track_exclude'] = array();
				$flag = true;
			}
			if ( ! isset( $this->options['ga_crossdomain_tracking'] ) ) {
				$this->options['ga_crossdomain_tracking'] = 0;
				$flag = true;
			}
			if ( ! isset( $this->options['ga_crossdomain_list'] ) ) {
				$this->options['ga_crossdomain_list'] = '';
				$flag = true;
			}
			if ( ! isset( $this->options['ga_author_dimindex'] ) ) {
				$this->options['ga_author_dimindex'] = 0;
				$flag = true;
			}
			if ( ! isset( $this->options['ga_tag_dimindex'] ) ) {
				$this->options['ga_tag_dimindex'] = 0;
				$flag = true;
			}
			if ( ! isset( $this->options['ga_category_dimindex'] ) ) {
				$this->options['ga_category_dimindex'] = 0;
				$flag = true;
			}
			$options['ga_tag_dimindex'] = 0;
			if ( ! isset( $this->options['ga_user_dimindex'] ) ) {
				$this->options['ga_user_dimindex'] = 0;
				$flag = true;
			}
			if ( ! isset( $this->options['ga_pubyear_dimindex'] ) ) {
				$this->options['ga_pubyear_dimindex'] = 0;
				$flag = true;
			}
			if ( ! isset( $this->options['ga_event_affiliates'] ) ) {
				$this->options['ga_event_affiliates'] = '/out/';
				$flag = true;
			}
			if ( ! isset( $this->options['ga_aff_tracking'] ) ) {
				$this->options['ga_aff_tracking'] = 0;
				$flag = true;
			}
			if ( ! isset( $this->options['ga_hash_tracking'] ) ) {
				$this->options['ga_hash_tracking'] = 0;
				$flag = true;
			}
			if ( ! isset( $this->options['backend_item_reports'] ) ) { // v4.8
				$this->options['backend_item_reports'] = 1;
				$flag = true;
			}
			if ( isset( $this->options['ga_dash_default_metric'] ) ) { // v4.8.1
				unset( $this->options['ga_dash_default_metric'] );
				$flag = true;
			}
			if ( isset( $this->options['ga_dash_default_dimension'] ) ) { // v4.8.1
				unset( $this->options['ga_dash_default_dimension'] );
				$flag = true;
			}
			if ( isset( $this->options['item_reports'] ) ) { // v4.8
				$this->options['backend_item_reports'] = $this->options['item_reports'];
				unset( $this->options['item_reports'] );
				$flag = true;
			}
			if ( isset( $this->options['ga_dash_frontend_stats'] ) ) { // v4.8
				$this->options['frontend_item_reports'] = $this->options['ga_dash_frontend_stats'];
				unset( $this->options['ga_dash_frontend_stats'] );
				$flag = true;
			}
			if ( ! isset( $this->options['dashboard_widget'] ) ) { // v4.7
				$this->options['dashboard_widget'] = 1;
				$flag = true;
			}
			if ( ! isset( $this->options['api_backoff'] ) ) { // v4.8.1.3
				$this->options['api_backoff'] = 0;
				$flag = true;
			}
			if ( isset( $this->options['ga_tracking_code'] ) ) {
				unset( $this->options['ga_tracking_code'] );
				$flag = true;
			}
			if ( isset( $this->options['ga_dash_tableid'] ) ) { // v4.9
				unset( $this->options['ga_dash_tableid'] );
				$flag = true;
			}
			if ( isset( $this->options['ga_dash_frontend_keywords'] ) ) { // v4.8
				unset( $this->options['ga_dash_frontend_keywords'] );
				$flag = true;
			}
			if ( isset( $this->options['ga_dash_apikey'] ) ) { // v4.9.1.3
				unset( $this->options['ga_dash_apikey'] );
				$flag = true;
			}
			if ( isset( $this->options['ga_dash_jailadmins'] ) ) { // v4.7
				if ( isset( $this->options['ga_dash_jailadmins'] ) ) {
					$this->options['switch_profile'] = 0;
					unset( $this->options['ga_dash_jailadmins'] );
					$flag = true;
				} else {
					$this->options['switch_profile'] = 1;
					unset( $this->options['ga_dash_jailadmins'] );
					$flag = true;
				}
			}
			if ( ! isset( $this->options['ga_cookiedomain'] ) ) {
				$this->options['ga_cookiedomain'] = '';
				$flag = true;
			}
			if ( ! isset( $this->options['ga_cookiedomain'] ) ) { // v4.9
				$this->options['ga_cookiedomain'] = '';
				$flag = true;
			}
			if ( ! isset( $this->options['ga_cookiename'] ) ) { // v4.9
				$this->options['ga_cookiename'] = '';
				$flag = true;
			}
			if ( ! isset( $this->options['ga_cookieexpires'] ) ) { // v4.9
				$this->options['ga_cookieexpires'] = '';
				$flag = true;
			}

			if ( $flag ) {
				$this->set_plugin_options( false );
			}
		}
	}
}
