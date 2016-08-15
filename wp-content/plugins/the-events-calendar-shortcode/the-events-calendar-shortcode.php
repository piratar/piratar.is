<?php
/***
 Plugin Name: The Events Calendar Shortcode
 Plugin URI: https://eventcalendarnewsletter.com/the-events-calendar-shortcode/
 Description: An addon to add shortcode functionality for <a href="http://wordpress.org/plugins/the-events-calendar/">The Events Calendar Plugin (Free Version) by Modern Tribe</a>.
 Version: 1.2
 Author: Event Calendar Newsletter (Brian Hogg)
 Author URI: https://eventcalendarnewsletter.com/the-events-calendar-shortcode/
 Contributors: Brainchild Media Group, Reddit user miahelf, tallavic, hejeva2
 Contributor URL: http://brainchildmediagroup.com, http://www.reddit.com/user/miahelf
 License: GPL2 or later
 License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

// Avoid direct calls to this file
if ( !defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}

/**
 * Events calendar shortcode addon main class
 *
 * @package events-calendar-shortcode
 * @author Dandelion Web Design Inc.
 * @version 1.0.10
 */
class Events_Calendar_Shortcode
{
	/**
	 * Current version of the plugin.
	 *
	 * @since 1.0.0
	 */
	const VERSION = '1.0.11';

	/**
	 * Constructor. Hooks all interactions to initialize the class.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @see	 add_shortcode()
	 */
	public function __construct()
	{
		add_shortcode('ecs-list-events', array($this, 'ecs_fetch_events') ); // link new function to shortcode name
	} // END __construct()

	/**
	 * Fetch and return required events.
	 * @param  array $atts 	shortcode attributes
	 * @return string 	shortcode output
	 */
	public function ecs_fetch_events( $atts )
	{
		/**
		 * Check if events calendar plugin method exists
		 */
		if ( !function_exists( 'tribe_get_events' ) ) {
			return;
		}

		global $wp_query, $post;
		$output = '';

		$atts = shortcode_atts( array(
			'cat' => '',
			'month' => '',
			'limit' => 5,
			'eventdetails' => 'true',
			'time' => null,
			'past' => null,
			'venue' => 'false',
			'author' => null,
			'message' => 'There are no upcoming events at this time.',
			'key' => 'End Date',
			'order' => 'ASC',
			'viewall' => 'false',
			'excerpt' => 'false',
			'thumb' => 'false',
			'thumbwidth' => '',
			'thumbheight' => '',
			'contentorder' => 'title, thumbnail, excerpt, date, venue',
			'event_tax' => '',
		), $atts, 'ecs-list-events' );

		// Category
		if ( $atts['cat'] ) {
			if ( strpos( $atts['cat'], "," ) !== false ) {
				$atts['cats'] = explode( ",", $atts['cat'] );
				$atts['cats'] = array_map( 'trim', $atts['cats'] );
			} else {
				$atts['cats'] = $atts['cat'];
			}

			$atts['event_tax'] = array(
				'relation' => 'OR',
				array(
					'taxonomy' => 'tribe_events_cat',
					'field' => 'name',
					'terms' => $atts['cats'],
				),
				array(
					'taxonomy' => 'tribe_events_cat',
					'field' => 'slug',
					'terms' => $atts['cats'],
				)
			);
		}

		// Past Event
		$meta_date_compare = '>=';
		$meta_date_date = date( 'Y-m-d' );

		if ( $atts['time'] == 'past' || !empty( $atts['past'] ) ) {
			$meta_date_compare = '<';
		}

		// Key
		if ( str_replace( ' ', '', trim( strtolower( $atts['key'] ) ) ) == 'startdate' ) {
			$atts['key'] = '_EventStartDate';
		} else {
			$atts['key'] = '_EventEndDate';
		}
		// Date
		$atts['meta_date'] = array(
			array(
				'key' => $atts['key'],
				'value' => $meta_date_date,
				'compare' => $meta_date_compare,
				'type' => 'DATETIME'
			)
		);

		// Specific Month
		if ( $atts['month'] == 'current' ) {
			$atts['month'] = date( 'Y-m' );
		}
		if ($atts['month']) {
			$month_array = explode("-", $atts['month']);
			
			$month_yearstr = $month_array[0];
			$month_monthstr = $month_array[1];
			$month_startdate = date( "Y-m-d", strtotime( $month_yearstr . "-" . $month_monthstr . "-01" ) );
			$month_enddate = date( "Y-m-01", strtotime( "+1 month", strtotime( $month_startdate ) ) );

			$atts['meta_date'] = array(
				array(
					'key' => $atts['key'],
					'value' => array($month_startdate, $month_enddate),
					'compare' => 'BETWEEN',
					'type' => 'DATETIME'
				)
			);
		}

		$posts = get_posts( array(
			'post_type' => 'tribe_events',
			'posts_per_page' => $atts['limit'],
			'tax_query'=> $atts['event_tax'],
			'meta_key' => $atts['key'],
			'orderby' => 'meta_value',
			'author' => $atts['author'],
			'order' => $atts['order'],
			'meta_query' => array( $atts['meta_date'] )
		) );

		if ($posts) {
			$output .= '<ul class="ecs-event-list">';
			$atts['contentorder'] = explode( ',', $atts['contentorder'] );

			foreach( $posts as $post ) :
				setup_postdata( $post );

				$output .= '<li class="ecs-event">';

				// Put Values into $output
				foreach ( $atts['contentorder'] as $contentorder ) {
					switch ( trim( $contentorder ) ) {
						case 'title' :
							$output .= '<h4 class="entry-title summary" style="margin-bottom:0px !important;">' .
											'<a href="' . tribe_get_event_link() . '" rel="bookmark">' . apply_filters( 'ecs_event_list_title', get_the_title(), $atts ) . '</a>
										</h4>';
							break;

						case 'thumbnail' :
							if( self::isValid($atts['thumb']) ) {
								$thumbWidth = is_numeric($atts['thumbwidth']) ? $atts['thumbwidth'] : '';
								$thumbHeight = is_numeric($atts['thumbheight']) ? $atts['thumbheight'] : '';
								if( !empty($thumbWidth) && !empty($thumbHeight) ) {
									$output .= get_the_post_thumbnail(get_the_ID(), array($thumbWidth, $thumbHeight) );
								} else {

									$size = ( !empty($thumbWidth) && !empty($thumbHeight) ) ? array( $thumbWidth, $thumbHeight ) : 'medium';

									if ( $thumb = get_the_post_thumbnail( get_the_ID(), $size ) ) {
										$output .= '<a href="' . tribe_get_event_link() . '">';
										$output .= $thumb;
										$output .= '</a>';
									}
								}
							}
							break;

						case 'excerpt' :
							if( self::isValid($atts['excerpt']) ) {
								$excerptLength = is_numeric($atts['excerpt']) ? $atts['excerpt'] : 100;
								$output .= '<p class="ecs-excerpt">' .
												self::get_excerpt($excerptLength) .
											'</p>';
							}
							break;

						case 'date' :
							if( self::isValid($atts['eventdetails']) ) {
								$output .= '<span class="duration time">' . apply_filters( 'ecs_event_list_details', tribe_events_event_schedule_details(), $atts ) . '</span>';
							}
							break;

						case 'venue' :
							if( self::isValid($atts['venue']) ) {
								$output .= '<span class="duration venue"><em> at </em>' . apply_filters( 'ecs_event_list_venue', tribe_get_venue(), $atts ) . '</span>';
							}
							break;
					}
				}
				$output .= '</li>';
			endforeach;
			$output .= '</ul>';

			if( self::isValid($atts['viewall']) ) {
				$output .= '<span class="ecs-all-events"><a href="' . apply_filters( 'ecs_event_list_viewall_link', tribe_get_events_link(), $atts ) .'" rel="bookmark">' . translate( 'View All Events', 'tribe-events-calendar' ) . '</a></span>';
			}

		} else { //No Events were Found
			$output .= translate( $atts['message'], 'tribe-events-calendar' );
		} // endif

		wp_reset_query();

		return $output;
	}

	/**
	 * Checks if the plugin attribute is valid
	 *
	 * @since 1.0.5
	 *
	 * @param string $prop
	 * @return boolean
	 */
	private function isValid( $prop )
	{
		return ($prop !== 'false');
	}

	/**
	 * Fetch and trims the excerpt to specified length
	 *
	 * @param integer $limit Characters to show
	 * @param string $source  content or excerpt
	 *
	 * @return string
	 */
	private function get_excerpt( $limit, $source = null )
	{
		$excerpt = get_the_excerpt();
		if( $source == "content" ) {
			$excerpt = get_the_content();
		}

		$excerpt = preg_replace(" (\[.*?\])", '', $excerpt);
		$excerpt = strip_tags( strip_shortcodes($excerpt) );
		$excerpt = substr($excerpt, 0, $limit);
		$excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
		$excerpt .= '...';

		return $excerpt;
	}
}

/**
 * Instantiate the main class
 *
 * @since 1.0.0
 * @access public
 *
 * @var	object	$events_calendar_shortcode holds the instantiated class {@uses Events_Calendar_Shortcode}
 */
global $events_calendar_shortcode;
$events_calendar_shortcode = new Events_Calendar_Shortcode();
