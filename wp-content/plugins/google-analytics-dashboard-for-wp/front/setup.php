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

if ( ! class_exists( 'GADWP_Frontend_Setup' ) ) {

	final class GADWP_Frontend_Setup {

		private $gadwp;

		public function __construct() {
			$this->gadwp = GADWP();

			// Styles & Scripts
			add_action( 'wp_enqueue_scripts', array( $this, 'load_styles_scripts' ) );
		}

		/**
		 * Styles & Scripts conditional loading
		 *
		 * @param
		 *            $hook
		 */
		public function load_styles_scripts() {
			$lang = get_bloginfo( 'language' );
			$lang = explode( '-', $lang );
			$lang = $lang[0];

			/*
			 * Item reports Styles & Scripts
			 */
			if ( GADWP_Tools::check_roles( $this->gadwp->config->options['ga_dash_access_front'] ) && $this->gadwp->config->options['frontend_item_reports'] ) {

				wp_enqueue_style( 'gadwp-nprogress', GADWP_URL . 'common/nprogress/nprogress.css', null, GADWP_CURRENT_VERSION );

				wp_enqueue_style( 'gadwp-frontend-item-reports', GADWP_URL . 'front/css/item-reports.css', null, GADWP_CURRENT_VERSION );

				$country_codes = GADWP_Tools::get_countrycodes();
				if ( $this->gadwp->config->options['ga_target_geomap'] && isset( $country_codes[$this->gadwp->config->options['ga_target_geomap']] ) ) {
					$region = $this->gadwp->config->options['ga_target_geomap'];
				} else {
					$region = false;
				}

				wp_enqueue_style( "wp-jquery-ui-dialog" );

				wp_register_script( 'googlejsapi', 'https://www.google.com/jsapi?autoload=%7B%22modules%22%3A%5B%7B%22name%22%3A%22visualization%22%2C%22version%22%3A%221%22%2C%22language%22%3A%22' . $lang . '%22%2C%22packages%22%3A%5B%22corechart%22%2C%20%22table%22%2C%20%22orgchart%22%2C%20%22geochart%22%5D%7D%5D%7D%27', array(), null );

				wp_enqueue_script( 'gadwp-nprogress', GADWP_URL . 'common/nprogress/nprogress.js', array( 'jquery' ), GADWP_CURRENT_VERSION );

				wp_enqueue_script( 'gadwp-frontend-item-reports', GADWP_URL . 'common/js/reports.js', array( 'gadwp-nprogress', 'googlejsapi', 'jquery', 'jquery-ui-dialog' ), GADWP_CURRENT_VERSION, true );

				/* @formatter:off */
				wp_localize_script( 'gadwp-frontend-item-reports', 'gadwpItemData', array(
					'ajaxurl' => admin_url( 'admin-ajax.php' ),
					'security' => wp_create_nonce( 'gadwp_frontend_item_reports' ),
					'dateList' => array(
						'today' => __( "Today", 'google-analytics-dashboard-for-wp' ),
						'yesterday' => __( "Yesterday", 'google-analytics-dashboard-for-wp' ),
						'7daysAgo' => sprintf( __( "Last %d Days", 'google-analytics-dashboard-for-wp' ), 7 ),
						'14daysAgo' => sprintf( __( "Last %d Days", 'google-analytics-dashboard-for-wp' ), 14 ),
						'30daysAgo' =>  sprintf( __( "Last %d Days", 'google-analytics-dashboard-for-wp' ), 30 ),
						'90daysAgo' =>  sprintf( __( "Last %d Days", 'google-analytics-dashboard-for-wp' ), 90 ),
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
							__( "Search Engines", 'google-analytics-dashboard-for-wp' ),
							__( "Social Networks", 'google-analytics-dashboard-for-wp' ),
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
							__( "This plugin needs an authorization:", 'google-analytics-dashboard-for-wp' ) . ' <strong>' . __( "authorize the plugin", 'google-analytics-dashboard-for-wp' ) . '</strong>!',
							__( "Browser", 'google-analytics-dashboard-for-wp' ), //16
							__( "Operating System", 'google-analytics-dashboard-for-wp' ),
							__( "Screen Resolution", 'google-analytics-dashboard-for-wp' ),
							__( "Mobile Brand", 'google-analytics-dashboard-for-wp' ),
					),
					'colorVariations' => GADWP_Tools::variations( $this->gadwp->config->options['ga_dash_style'] ),
					'region' => $region,
					'language' => get_bloginfo( 'language' ),
					'filter' => $_SERVER["REQUEST_URI"],
					'viewList' => false,
					'scope' => 'front-item',
				 )
				);
				/* @formatter:on */
			}
		}
	}
}
