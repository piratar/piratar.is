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

if ( ! class_exists( 'GADWP_Backend_Setup' ) ) {

	final class GADWP_Backend_Setup {

		private $gadwp;

		public function __construct() {
			$this->gadwp = GADWP();

			// Styles & Scripts
			add_action( 'admin_enqueue_scripts', array( $this, 'load_styles_scripts' ) );
			// Site Menu
			add_action( 'admin_menu', array( $this, 'site_menu' ) );
			// Network Menu
			add_action( 'network_admin_menu', array( $this, 'network_menu' ) );
			// Settings link
			add_filter( "plugin_action_links_" . plugin_basename( GADWP_DIR . 'gadwp.php' ), array( $this, 'settings_link' ) );
			// Updated admin notice
			add_action( 'admin_notices', array( $this, 'admin_notice' ) );
		}

		/**
		 * Add Site Menu
		 */
		public function site_menu() {
			global $wp_version;
			if ( current_user_can( 'manage_options' ) ) {
				include ( GADWP_DIR . 'admin/settings.php' );
				add_menu_page( __( "Google Analytics", 'google-analytics-dashboard-for-wp' ), __( "Google Analytics", 'google-analytics-dashboard-for-wp' ), 'manage_options', 'gadash_settings', array( 'GADWP_Settings', 'general_settings' ), version_compare( $wp_version, '3.8.0', '>=' ) ? 'dashicons-chart-area' : GADWP_URL . 'admin/images/gadash-icon.png' );
				add_submenu_page( 'gadash_settings', __( "General Settings", 'google-analytics-dashboard-for-wp' ), __( "General Settings", 'google-analytics-dashboard-for-wp' ), 'manage_options', 'gadash_settings', array( 'GADWP_Settings', 'general_settings' ) );
				add_submenu_page( 'gadash_settings', __( "Backend Settings", 'google-analytics-dashboard-for-wp' ), __( "Backend Settings", 'google-analytics-dashboard-for-wp' ), 'manage_options', 'gadash_backend_settings', array( 'GADWP_Settings', 'backend_settings' ) );
				add_submenu_page( 'gadash_settings', __( "Frontend Settings", 'google-analytics-dashboard-for-wp' ), __( "Frontend Settings", 'google-analytics-dashboard-for-wp' ), 'manage_options', 'gadash_frontend_settings', array( 'GADWP_Settings', 'frontend_settings' ) );
				add_submenu_page( 'gadash_settings', __( "Tracking Code", 'google-analytics-dashboard-for-wp' ), __( "Tracking Code", 'google-analytics-dashboard-for-wp' ), 'manage_options', 'gadash_tracking_settings', array( 'GADWP_Settings', 'tracking_settings' ) );
				add_submenu_page( 'gadash_settings', __( "Errors & Debug", 'google-analytics-dashboard-for-wp' ), __( "Errors & Debug", 'google-analytics-dashboard-for-wp' ), 'manage_options', 'gadash_errors_debugging', array( 'GADWP_Settings', 'errors_debugging' ) );
			}
		}

		/**
		 * Add Network Menu
		 */
		public function network_menu() {
			global $wp_version;
			if ( current_user_can( 'manage_netwrok' ) ) {
				include ( GADWP_DIR . 'admin/settings.php' );
				add_menu_page( __( "Google Analytics", 'google-analytics-dashboard-for-wp' ), "Google Analytics", 'manage_netwrok', 'gadash_settings', array( 'GADWP_Settings', 'general_settings_network' ), version_compare( $wp_version, '3.8.0', '>=' ) ? 'dashicons-chart-area' : GADWP_URL . 'admin/images/gadash-icon.png' );
				add_submenu_page( 'gadash_settings', __( "General Settings", 'google-analytics-dashboard-for-wp' ), __( "General Settings", 'google-analytics-dashboard-for-wp' ), 'manage_netwrok', 'gadash_settings', array( 'GADWP_Settings', 'general_settings_network' ) );
				add_submenu_page( 'gadash_settings', __( "Errors & Debug", 'google-analytics-dashboard-for-wp' ), __( "Errors & Debug", 'google-analytics-dashboard-for-wp' ), 'manage_network', 'gadash_errors_debugging', array( 'GADWP_Settings', 'errors_debugging' ) );
			}
		}

		/**
		 * Styles & Scripts conditional loading (based on current URI)
		 *
		 * @param
		 *            $hook
		 */
		public function load_styles_scripts( $hook ) {
			$new_hook = explode( '_page_', $hook );

			if ( isset( $new_hook[1] ) ) {
				$new_hook = '_page_' . $new_hook[1];
			} else {
				$new_hook = $hook;
			}

			$lang = get_bloginfo( 'language' );
			$lang = explode( '-', $lang );
			$lang = $lang[0];

			/*
			 * GADWP main stylesheet
			 */
			wp_enqueue_style( 'gadwp', GADWP_URL . 'admin/css/gadwp.css', null, GADWP_CURRENT_VERSION );

			/*
			 * GADWP UI
			 */

			if ( GADWP_Tools::get_cache( 'gapi_errors' ) ) {
				$ed_bubble = '!';
			} else {
				$ed_bubble = '';
			}

			wp_enqueue_script( 'gadwp-backend-ui', plugins_url( 'js/ui.js', __FILE__ ), array( 'jquery' ), GADWP_CURRENT_VERSION, true );

			/* @formatter:off */
			wp_localize_script( 'gadwp-backend-ui', 'gadwp_ui_data', array(
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'security' => wp_create_nonce( 'gadwp_dismiss_notices' ),
				'ed_bubble' => $ed_bubble,
			)
			);
			/* @formatter:on */

			if ( $this->gadwp->config->options['switch_profile'] && count( $this->gadwp->config->options['ga_dash_profile_list'] ) > 1 ) {
				$views = array();
				foreach ( $this->gadwp->config->options['ga_dash_profile_list'] as $items ) {
					if ( $items[3] ) {
						$views[$items[1]] = esc_js( GADWP_Tools::strip_protocol( $items[3] ) ); // . ' &#8658; ' . $items[0] );
					}
				}
			} else {
				$views = false;
			}

			/*
			 * Main Dashboard Widgets Styles & Scripts
			 */
			$widgets_hooks = array( 'index.php' );

			if ( in_array( $new_hook, $widgets_hooks ) ) {
				if ( GADWP_Tools::check_roles( $this->gadwp->config->options['ga_dash_access_back'] ) && $this->gadwp->config->options['dashboard_widget'] ) {

					if ( $this->gadwp->config->options['ga_target_geomap'] ) {
						$country_codes = GADWP_Tools::get_countrycodes();
						if ( isset( $country_codes[$this->gadwp->config->options['ga_target_geomap']] ) ) {
							$region = $this->gadwp->config->options['ga_target_geomap'];
						} else {
							$region = false;
						}
					} else {
						$region = false;
					}

					wp_enqueue_style( 'gadwp-nprogress', GADWP_URL . 'common/nprogress/nprogress.css', null, GADWP_CURRENT_VERSION );

					wp_enqueue_style( 'gadwp-backend-item-reports', GADWP_URL . 'admin/css/admin-widgets.css', null, GADWP_CURRENT_VERSION );

					wp_register_style( 'jquery-ui-tooltip-html', GADWP_URL . 'common/realtime/jquery.ui.tooltip.html.css' );

					wp_enqueue_style( 'jquery-ui-tooltip-html' );

					wp_register_script( 'jquery-ui-tooltip-html', GADWP_URL . 'common/realtime/jquery.ui.tooltip.html.js' );

					wp_register_script( 'googlejsapi', 'https://www.google.com/jsapi?autoload=%7B%22modules%22%3A%5B%7B%22name%22%3A%22visualization%22%2C%22version%22%3A%221%22%2C%22language%22%3A%22' . $lang . '%22%2C%22packages%22%3A%5B%22corechart%22%2C%20%22table%22%2C%20%22orgchart%22%2C%20%22geochart%22%5D%7D%5D%7D%27', array(), null );

					wp_enqueue_script( 'gadwp-nprogress', GADWP_URL . 'common/nprogress/nprogress.js', array( 'jquery' ), GADWP_CURRENT_VERSION );

					wp_enqueue_script( 'gadwp-backend-dashboard-reports', GADWP_URL . 'common/js/reports.js', array( 'jquery', 'googlejsapi', 'gadwp-nprogress', 'jquery-ui-tooltip', 'jquery-ui-core', 'jquery-ui-position', 'jquery-ui-tooltip-html' ), GADWP_CURRENT_VERSION, true );

					/* @formatter:off */
					wp_localize_script( 'gadwp-backend-dashboard-reports', 'gadwpItemData', array(
						'ajaxurl' => admin_url( 'admin-ajax.php' ),
						'security' => wp_create_nonce( 'gadwp_backend_item_reports' ),
						'dateList' => array(
							'realtime' => __( "Real-Time", 'google-analytics-dashboard-for-wp' ),
							'today' => __( "Today", 'google-analytics-dashboard-for-wp' ),
							'yesterday' => __( "Yesterday", 'google-analytics-dashboard-for-wp' ),
							'7daysAgo' => sprintf( __( "Last %d Days", 'google-analytics-dashboard-for-wp' ), 7 ),
							'14daysAgo' => sprintf( __( "Last %d Days", 'google-analytics-dashboard-for-wp' ), 14 ),
							'30daysAgo' => sprintf( __( "Last %d Days", 'google-analytics-dashboard-for-wp' ), 30 ),
							'90daysAgo' => sprintf( __( "Last %d Days", 'google-analytics-dashboard-for-wp' ), 90 ),
							'365daysAgo' =>  sprintf( _n( "%s Year", "%s Years", 1, 'google-analytics-dashboard-for-wp' ), __('One', 'google-analytics-dashboard-for-wp') ),
							'1095daysAgo' =>  sprintf( _n( "%s Year", "%s Years", 3, 'google-analytics-dashboard-for-wp' ), __('Three', 'google-analytics-dashboard-for-wp') ),
						),
						'reportList' => array(
							'sessions' => __( "Sessions", 'google-analytics-dashboard-for-wp' ),
							'users' => __( "Users", 'google-analytics-dashboard-for-wp' ),
							'organicSearches' => __( "Organic", 'google-analytics-dashboard-for-wp' ),
							'pageviews' => __( "Page Views", 'google-analytics-dashboard-for-wp' ),
							'visitBounceRate' => __( "Bounce Rate", 'google-analytics-dashboard-for-wp' ),
							'locations' => __( "Location", 'google-analytics-dashboard-for-wp' ),
							'contentpages' =>  __( "Pages", 'google-analytics-dashboard-for-wp' ),
							'referrers' => __( "Referrers", 'google-analytics-dashboard-for-wp' ),
							'searches' => __( "Searches", 'google-analytics-dashboard-for-wp' ),
							'trafficdetails' => __( "Traffic", 'google-analytics-dashboard-for-wp' ),
							'technologydetails' => __( "Technology", 'google-analytics-dashboard-for-wp' ),
						),
						'i18n' => array(
							__( "A JavaScript Error is blocking plugin resources!", 'google-analytics-dashboard-for-wp' ), //0
							__( "Traffic Mediums", 'google-analytics-dashboard-for-wp' ),
							__( "Visitor Type", 'google-analytics-dashboard-for-wp' ),
							__( "Search Engines", 'google-analytics-dashboard-for-wp' ),
							__( "Social Networks", 'google-analytics-dashboard-for-wp' ),
							__( "Sessions", 'google-analytics-dashboard-for-wp' ),
							__( "Users", 'google-analytics-dashboard-for-wp' ),
							__( "Page Views", 'google-analytics-dashboard-for-wp' ),
							__( "Bounce Rate", 'google-analytics-dashboard-for-wp' ),
							__( "Organic Search", 'google-analytics-dashboard-for-wp' ),
							__( "Pages/Session", 'google-analytics-dashboard-for-wp' ),
							__( "Invalid response", 'google-analytics-dashboard-for-wp' ),
							__( "Not enough data collected", 'google-analytics-dashboard-for-wp' ),
							__( "This report is unavailable", 'google-analytics-dashboard-for-wp' ),
							__( "report generated by", 'google-analytics-dashboard-for-wp' ), //14
							__( "This plugin needs an authorization:", 'google-analytics-dashboard-for-wp' ) . ' <a href="' . menu_page_url( 'gadash_settings', false ) . '">' . __( "authorize the plugin", 'google-analytics-dashboard-for-wp' ) . '</a>.',
							__( "Browser", 'google-analytics-dashboard-for-wp' ), //16
							__( "Operating System", 'google-analytics-dashboard-for-wp' ),
							__( "Screen Resolution", 'google-analytics-dashboard-for-wp' ),
							__( "Mobile Brand", 'google-analytics-dashboard-for-wp' ),
							__( "REFERRALS", 'google-analytics-dashboard-for-wp' ), //20
							__( "KEYWORDS", 'google-analytics-dashboard-for-wp' ),
							__( "SOCIAL", 'google-analytics-dashboard-for-wp' ),
							__( "CAMPAIGN", 'google-analytics-dashboard-for-wp' ),
							__( "DIRECT", 'google-analytics-dashboard-for-wp' ),
							__( "NEW", 'google-analytics-dashboard-for-wp' ), //25
						),
						'rtLimitPages' => $this->gadwp->config->options['ga_realtime_pages'],
						'colorVariations' => GADWP_Tools::variations( $this->gadwp->config->options['ga_dash_style'] ),
						'region' => $region,
						'language' => get_bloginfo( 'language' ),
						'viewList' => $views,
						'scope' => 'admin-widgets',
					)
					);
					/* @formatter:on */
				}
			}

			/*
			 * Posts/Pages List Styles & Scripts
			 */
			$contentstats_hooks = array( 'edit.php' );
			if ( in_array( $hook, $contentstats_hooks ) ) {
				if ( GADWP_Tools::check_roles( $this->gadwp->config->options['ga_dash_access_back'] ) && $this->gadwp->config->options['backend_item_reports'] ) {

					if ( $this->gadwp->config->options['ga_target_geomap'] ) {
						$country_codes = GADWP_Tools::get_countrycodes();
						if ( isset( $country_codes[$this->gadwp->config->options['ga_target_geomap']] ) ) {
							$region = $this->gadwp->config->options['ga_target_geomap'];
						} else {
							$region = false;
						}
					} else {
						$region = false;
					}

					wp_enqueue_style( 'gadwp-nprogress', GADWP_URL . 'common/nprogress/nprogress.css', null, GADWP_CURRENT_VERSION );

					wp_enqueue_style( 'gadwp-backend-item-reports', GADWP_URL . 'admin/css/item-reports.css', null, GADWP_CURRENT_VERSION );

					wp_enqueue_style( "wp-jquery-ui-dialog" );

					wp_register_script( 'googlejsapi', 'https://www.google.com/jsapi?autoload=%7B%22modules%22%3A%5B%7B%22name%22%3A%22visualization%22%2C%22version%22%3A%221%22%2C%22language%22%3A%22' . $lang . '%22%2C%22packages%22%3A%5B%22corechart%22%2C%20%22table%22%2C%20%22orgchart%22%2C%20%22geochart%22%5D%7D%5D%7D%27', array(), null );

					wp_enqueue_script( 'gadwp-nprogress', GADWP_URL . 'common/nprogress/nprogress.js', array( 'jquery' ), GADWP_CURRENT_VERSION );

					wp_enqueue_script( 'gadwp-backend-item-reports', GADWP_URL . 'common/js/reports.js', array( 'gadwp-nprogress', 'googlejsapi', 'jquery', 'jquery-ui-dialog' ), GADWP_CURRENT_VERSION, true );

					/* @formatter:off */
					wp_localize_script( 'gadwp-backend-item-reports', 'gadwpItemData', array(
						'ajaxurl' => admin_url( 'admin-ajax.php' ),
						'security' => wp_create_nonce( 'gadwp_backend_item_reports' ),
						'dateList' => array(
							'today' => __( "Today", 'google-analytics-dashboard-for-wp' ),
							'yesterday' => __( "Yesterday", 'google-analytics-dashboard-for-wp' ),
							'7daysAgo' => sprintf( __( "Last %d Days", 'google-analytics-dashboard-for-wp' ), 7 ),
							'14daysAgo' => sprintf( __( "Last %d Days", 'google-analytics-dashboard-for-wp' ), 14 ),
							'30daysAgo' => sprintf( __( "Last %d Days", 'google-analytics-dashboard-for-wp' ), 30 ),
							'90daysAgo' => sprintf( __( "Last %d Days", 'google-analytics-dashboard-for-wp' ), 90 ),
							'365daysAgo' =>  sprintf( _n( "%s Year", "%s Years", 1, 'google-analytics-dashboard-for-wp' ), __('One', 'google-analytics-dashboard-for-wp') ),
							'1095daysAgo' =>  sprintf( _n( "%s Year", "%s Years", 3, 'google-analytics-dashboard-for-wp' ), __('Three', 'google-analytics-dashboard-for-wp') ),
						),
						'reportList' => array(
							'uniquePageviews' => __( "Unique Views", 'google-analytics-dashboard-for-wp' ),
							'users' => __( "Users", 'google-analytics-dashboard-for-wp' ),
							'organicSearches' => __( "Organic", 'google-analytics-dashboard-for-wp' ),
							'pageviews' => __( "Page Views", 'google-analytics-dashboard-for-wp' ),
							'visitBounceRate' => __( "Bounce Rate", 'google-analytics-dashboard-for-wp' ),
							'locations' => __( "Location", 'google-analytics-dashboard-for-wp' ),
							'referrers' => __( "Referrers", 'google-analytics-dashboard-for-wp' ),
							'searches' => __( "Searches", 'google-analytics-dashboard-for-wp' ),
							'trafficdetails' => __( "Traffic", 'google-analytics-dashboard-for-wp' ),
							'technologydetails' => __( "Technology", 'google-analytics-dashboard-for-wp' ),
						),
						'i18n' => array(
							__( "A JavaScript Error is blocking plugin resources!", 'google-analytics-dashboard-for-wp' ), //0
							__( "Traffic Mediums", 'google-analytics-dashboard-for-wp' ),
							__( "Visitor Type", 'google-analytics-dashboard-for-wp' ),
							__( "Social Networks", 'google-analytics-dashboard-for-wp' ),
							__( "Search Engines", 'google-analytics-dashboard-for-wp' ),
							__( "Unique Views", 'google-analytics-dashboard-for-wp' ),
							__( "Users", 'google-analytics-dashboard-for-wp' ),
							__( "Page Views", 'google-analytics-dashboard-for-wp' ),
							__( "Bounce Rate", 'google-analytics-dashboard-for-wp' ),
							__( "Organic Search", 'google-analytics-dashboard-for-wp' ),
							__( "Pages/Session", 'google-analytics-dashboard-for-wp' ),
							__( "Invalid response", 'google-analytics-dashboard-for-wp' ),
							__( "Not enough data collected", 'google-analytics-dashboard-for-wp' ),
							__( "This report is unavailable", 'google-analytics-dashboard-for-wp' ),
							__( "report generated by", 'google-analytics-dashboard-for-wp' ), //14
							__( "This plugin needs an authorization:", 'google-analytics-dashboard-for-wp' ) . ' <a href="' . menu_page_url( 'gadash_settings', false ) . '">' . __( "authorize the plugin", 'google-analytics-dashboard-for-wp' ) . '</a>.',
							__( "Browser", 'google-analytics-dashboard-for-wp' ), //16
							__( "Operating System", 'google-analytics-dashboard-for-wp' ),
							__( "Screen Resolution", 'google-analytics-dashboard-for-wp' ),
							__( "Mobile Brand", 'google-analytics-dashboard-for-wp' ),
						),
						'colorVariations' => GADWP_Tools::variations( $this->gadwp->config->options['ga_dash_style'] ),
						'region' => $region,
						'language' => get_bloginfo( 'language' ),
						'viewList' => false,
						'scope' => 'admin-item',
						)
					);
					/* @formatter:on */
				}
			}

			/*
			 * Settings Styles & Scripts
			 */
			$settings_hooks = array( '_page_gadash_settings', '_page_gadash_backend_settings', '_page_gadash_frontend_settings', '_page_gadash_tracking_settings', '_page_gadash_errors_debugging' );

			if ( in_array( $new_hook, $settings_hooks ) ) {
				wp_enqueue_style( 'wp-color-picker' );
				wp_enqueue_script( 'wp-color-picker' );
				wp_enqueue_script( 'wp-color-picker-script-handle', plugins_url( 'js/wp-color-picker-script.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
				wp_enqueue_script( 'gadwp-settings', plugins_url( 'js/settings.js', __FILE__ ), array( 'jquery' ), GADWP_CURRENT_VERSION, true );
			}
		}

		/**
		 * Add "Settings" link in Plugins List
		 *
		 * @param
		 *            $links
		 * @return array
		 */
		public function settings_link( $links ) {
			$settings_link = '<a href="' . esc_url( get_admin_url( null, 'admin.php?page=gadash_settings' ) ) . '">' . __( "Settings", 'google-analytics-dashboard-for-wp' ) . '</a>';
			array_unshift( $links, $settings_link );
			return $links;
		}

		/**
		 *  Add an admin notice after a manual or atuomatic update
		 */
		function admin_notice() {
			$currentScreen = get_current_screen();

			if ( ! current_user_can( 'manage_options' ) || $currentScreen->base != 'dashboard' ) {
				return;
			}

			if ( get_option( 'gadwp_got_updated' ) ) :
				?>
<div id="gadwp-notice" class="notice is-dismissible">
    <p><?php echo sprintf( __('Google Analytics Dashboard for WP has been updated to version %s.', 'google-analytics-dashboard-for-wp' ), GADWP_CURRENT_VERSION).' '.sprintf( __('For details, check out %1$s and %2$s.', 'google-analytics-dashboard-for-wp' ), sprintf(' <a href="https://deconf.com/google-analytics-dashboard-wordpress/?utm_source=gadwp_notice&utm_medium=link&utm_content=release_notice&utm_campaign=gadwp">%s</a> ', __('the documentation page', 'google-analytics-dashboard-for-wp') ), sprintf(' <a href="%1$s">%2$s</a>', esc_url( get_admin_url( null, 'admin.php?page=gadash_settings' ) ), __('the plugin&#39;s settings page', 'google-analytics-dashboard-for-wp') ) ); ?></p>
</div>

			<?php
			endif;
		}
	}
}
