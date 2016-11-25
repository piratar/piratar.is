<?php
/**
 * Plugin Name: Rename Media Files
 * Plugin URI:  http://blog.milandinic.com/wordpress/plugins/rename-media-files/
 * Description: Rename names of media files.
 * Author:      Milan Dinić
 * Author URI:  http://blog.milandinic.com/
 * Version:     1.0.1
 * License:     GPL
 * Text Domain: rename-media-files
 * Domain Path: /languages/
 */

/**
 * Used code from:
 *
 * 	Enable Media Replace
 * 	Media Tags
 * 	WP Smush.it
 * 	AJAX Thumbnail Rebuild
 */

/* Exit if accessed directly */
if ( ! defined( 'ABSPATH' ) ) exit;

/* Load on init */
add_action( 'init', 'rename_media_files_init' );

/**
 * Hook functions on init
 *
 * @since 0.1
 */
function rename_media_files_init() {

	/* Add filters to load & save media edit screen for field */
	add_filter( 'attachment_fields_to_edit', 'rename_media_files_fields_to_edit', 11, 2 );
	add_filter( 'attachment_fields_to_save', 'rename_media_files_attachment_fields_to_save', 11, 2 );

	/* Show donate link in plugin's links row */
	add_filter( 'plugin_action_links', 'rename_media_files_filter_plugin_actions', 10, 2 );
}

/**
 * Load plugin's translation
 *
 * @since 1.0
 */
function rename_media_files_load_textdomain() {
	load_plugin_textdomain( 'rename-media-files', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}

/**
 * Add action links to plugins page
 *
 * Thanks to Dion Hulse for guide
 * and Adminize plugin for implementation
 *
 * @link http://dd32.id.au/wordpress-plugins/?configure-link
 * @link http://bueltge.de/wordpress-admin-theme-adminimize/674/
 *
 * @since 1.0
 *
 * @param array $links Default links of plugin
 * @param string $file Name of plugin's file
 * @return array $links New & old links of plugin
 */
function rename_media_files_filter_plugin_actions( $links, $file ) {
	/* Load translations */
	rename_media_files_load_textdomain();

	static $this_plugin;

	if ( ! $this_plugin )
		$this_plugin = plugin_basename( __FILE__ );

	if ( $file == $this_plugin ) {
		$donate_link = '<a href="http://blog.milandinic.com/donate/">' . __( 'Donate', 'rename-media-files' ) . '</a>';
		$wpdev_link  = '<a href="http://blog.milandinic.com/wordpress/custom-development/">' . __( 'WordPress Developer', 'rename-media-files' ) . '</a>';

		$links = array_merge( array( $donate_link, $wpdev_link ), $links ); // Before other links
	}

	return $links;
}

/**
 * Add field on media edit screen
 *
 * @since 0.1
 *
 * @param array $form_fields Existing form fields
 * @param object $post Current attachment post object
 * @return array $form_fields New form fields
 */
function rename_media_files_fields_to_edit( $form_fields, $post ) {
	/* Only show if not in Thickbox iframe */
	if ( defined( 'IFRAME_REQUEST' ) && true === IFRAME_REQUEST )
		return $form_fields;

	/* Load translations */
	rename_media_files_load_textdomain();

	/* Get original filename */
	$orig_file = get_attached_file( $post->ID );
	$orig_filename = basename( $orig_file );

	/* Setup a new field */
    $form_fields['rename_media_files_input'] = array(
       	'label' => __( 'New file name:', 'rename-media-files' ),
   		'value' => '',
		'helps' => sprintf( __( 'Enter a new file name in the field above. (current filename is <strong>%1$s</strong>)', 'rename-media-files'), $orig_filename )
	);

    return $form_fields;
}

/**
 * Save form field value on media edit screen
 *
 * @since 0.1
 *
 * @param array $post Current attachment post data
 * @param array $attachment Data submitted via form
 * @return array $post Current attachment post data
 */
function rename_media_files_attachment_fields_to_save( $post, $attachment ) {

	/* Only proceed if new filename is submitted */
	if ( isset( $attachment['rename_media_files_input'] ) && $attachment['rename_media_files_input'] ) {
		/* Get original filename */
		$orig_file = get_attached_file( $post['ID'] );
		$orig_filename = basename( $orig_file );

		/* Get original path of file */
		$orig_dir_path = substr( $orig_file, 0, ( strrpos( $orig_file, "/" ) ) );

		/* Get image sizes */
		$image_sizes = array_merge( get_intermediate_image_sizes(), array( 'full' ) );

		/* If image, get URLs to original sizes */
		if ( wp_attachment_is_image( $post['ID'] ) ) {
			$orig_image_urls = array();

			foreach ( $image_sizes as $image_size ) {
				$orig_image_data = wp_get_attachment_image_src( $post['ID'], $image_size );
				$orig_image_urls[$image_size] = $orig_image_data[0];
			}
		/* Otherwise, get URL to original file */
		} else {
			$orig_attachment_url = wp_get_attachment_url( $post['ID'] );
		}

		/* Make new filename and path */
		$new_filename= wp_unique_filename( $orig_dir_path, $attachment['rename_media_files_input'] );
		$new_file = $orig_dir_path . "/" . $new_filename;

		/* Make new file with desired name */
		copy( $orig_file, $new_file );

		/* Update file location in database */
		update_attached_file( $post['ID'], $new_file );

		/* Update guid for attachment */
		$post_for_guid = get_post( $post['ID'] );
		$guid = str_replace( $orig_filename, $new_filename, $post_for_guid->guid );

		wp_update_post( array(
			'ID' => $post['ID'],
			'guid' => $guid
		) );

		/* Update attachment's metadata */
		wp_update_attachment_metadata( $post['ID'], wp_generate_attachment_metadata( $post['ID'], $new_file) );

		/* Load global so that we can save to the database */
		global $wpdb;

		/* If image, get URLs to new sizes and update posts with old URLs */
		if ( wp_attachment_is_image( $post['ID'] ) ) {
			foreach ( $image_sizes as $image_size ) {
				$orig_image_url = $orig_image_urls[$image_size];
				$new_image_data = wp_get_attachment_image_src( $post['ID'], $image_size );
				$new_image_url = $new_image_data[0];

				$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->posts SET post_content = REPLACE(post_content, %s, %s);", $orig_image_url, $new_image_url ) );
			}
		/* Otherwise, get URL to new file and update posts with old URL */
		} else {
			$new_attachment_url = wp_get_attachment_url( $post['ID'] );

			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->posts SET post_content = REPLACE(post_content, %s, %s);" ), $orig_attachment_url, $new_attachment_url );
		}
	}

    return $post;
}