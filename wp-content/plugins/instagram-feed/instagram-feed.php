<?php 
/*
Plugin Name: Instagram Feed
Plugin URI: http://smashballoon.com/instagram-feed
Description: Display beautifully clean, customizable, and responsive Instagram feeds
Version: 1.4.7
Author: Smash Balloon
Author URI: http://smashballoon.com/
License: GPLv2 or later
Text Domain: instagram-feed

Copyright 2016  Smash Balloon LLC (email : hey@smashballoon.com)
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.
This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

define( 'SBIVER', '1.4.7' );

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
//Include admin
include dirname( __FILE__ ) .'/instagram-feed-admin.php';

// Add shortcodes
add_shortcode('instagram-feed', 'display_instagram');
function display_instagram($atts, $content = null) {


    /******************* SHORTCODE OPTIONS ********************/

    $options = get_option('sb_instagram_settings');
    
    //Pass in shortcode attrbutes
    $atts = shortcode_atts(
    array(
        'id' => isset($options[ 'sb_instagram_user_id' ]) ? $options[ 'sb_instagram_user_id' ] : '',
        'width' => isset($options[ 'sb_instagram_width' ]) ? $options[ 'sb_instagram_width' ] : '',
        'widthunit' => isset($options[ 'sb_instagram_width_unit' ]) ? $options[ 'sb_instagram_width_unit' ] : '',
        'widthresp' => isset($options[ 'sb_instagram_feed_width_resp' ]) ? $options[ 'sb_instagram_feed_width_resp' ] : '',
        'height' => isset($options[ 'sb_instagram_height' ]) ? $options[ 'sb_instagram_height' ] : '',
        'heightunit' => isset($options[ 'sb_instagram_height_unit' ]) ? $options[ 'sb_instagram_height_unit' ] : '',
        'sortby' => isset($options[ 'sb_instagram_sort' ]) ? $options[ 'sb_instagram_sort' ] : '',
        'num' => isset($options[ 'sb_instagram_num' ]) ? $options[ 'sb_instagram_num' ] : '',
        'cols' => isset($options[ 'sb_instagram_cols' ]) ? $options[ 'sb_instagram_cols' ] : '',
        'disablemobile' => isset($options[ 'sb_instagram_disable_mobile' ]) ? $options[ 'sb_instagram_disable_mobile' ] : '',
        'imagepadding' => isset($options[ 'sb_instagram_image_padding' ]) ? $options[ 'sb_instagram_image_padding' ] : '',
        'imagepaddingunit' => isset($options[ 'sb_instagram_image_padding_unit' ]) ? $options[ 'sb_instagram_image_padding_unit' ] : '',
        'background' => isset($options[ 'sb_instagram_background' ]) ? $options[ 'sb_instagram_background' ] : '',
        'showbutton' => isset($options[ 'sb_instagram_show_btn' ]) ? $options[ 'sb_instagram_show_btn' ] : '',
        'buttoncolor' => isset($options[ 'sb_instagram_btn_background' ]) ? $options[ 'sb_instagram_btn_background' ] : '',
        'buttontextcolor' => isset($options[ 'sb_instagram_btn_text_color' ]) ? $options[ 'sb_instagram_btn_text_color' ] : '',
        'buttontext' => isset($options[ 'sb_instagram_btn_text' ]) ? $options[ 'sb_instagram_btn_text' ] : '',
        'imageres' => isset($options[ 'sb_instagram_image_res' ]) ? $options[ 'sb_instagram_image_res' ] : '',
        'showfollow' => isset($options[ 'sb_instagram_show_follow_btn' ]) ? $options[ 'sb_instagram_show_follow_btn' ] : '',
        'followcolor' => isset($options[ 'sb_instagram_folow_btn_background' ]) ? $options[ 'sb_instagram_folow_btn_background' ] : '',
        'followtextcolor' => isset($options[ 'sb_instagram_follow_btn_text_color' ]) ? $options[ 'sb_instagram_follow_btn_text_color' ] : '',
        'followtext' => isset($options[ 'sb_instagram_follow_btn_text' ]) ? $options[ 'sb_instagram_follow_btn_text' ] : '',
        'showheader' => isset($options[ 'sb_instagram_show_header' ]) ? $options[ 'sb_instagram_show_header' ] : '',
        'headercolor' => isset($options[ 'sb_instagram_header_color' ]) ? $options[ 'sb_instagram_header_color' ] : '',
        'class' => '',
        'ajaxtheme' => isset($options[ 'sb_instagram_ajax_theme' ]) ? $options[ 'sb_instagram_ajax_theme' ] : ''
    ), $atts);


    /******************* VARS ********************/

    //User ID
    $sb_instagram_user_id = trim($atts['id']);

    //Container styles
    $sb_instagram_width = $atts['width'];
    $sb_instagram_width_unit = $atts['widthunit'];
    $sb_instagram_height = $atts['height'];
    $sb_instagram_height_unit = $atts['heightunit'];
    $sb_instagram_image_padding = $atts['imagepadding'];
    $sb_instagram_image_padding_unit = $atts['imagepaddingunit'];
    $sb_instagram_background = $atts['background'];

    //Set to be 100% width on mobile?
    $sb_instagram_width_resp = $atts[ 'widthresp' ];
    ( $sb_instagram_width_resp == 'on' || $sb_instagram_width_resp == 'true' || $sb_instagram_width_resp == true ) ? $sb_instagram_width_resp = true : $sb_instagram_width_resp = false;
    if( $atts[ 'widthresp' ] == 'false' ) $sb_instagram_width_resp = false;

    //Layout options
    $sb_instagram_cols = $atts['cols'];

    $sb_instagram_styles = 'style="';
    if($sb_instagram_cols == 1) $sb_instagram_styles .= 'max-width: 640px; ';
    if ( !empty($sb_instagram_width) ) $sb_instagram_styles .= 'width:' . $sb_instagram_width . $sb_instagram_width_unit .'; ';
    if ( !empty($sb_instagram_height) && $sb_instagram_height != '0' ) $sb_instagram_styles .= 'height:' . $sb_instagram_height . $sb_instagram_height_unit .'; ';
    if ( !empty($sb_instagram_background) ) $sb_instagram_styles .= 'background-color: ' . $sb_instagram_background . '; ';
    if ( !empty($sb_instagram_image_padding) ) $sb_instagram_styles .= 'padding-bottom: ' . (2*intval($sb_instagram_image_padding)).$sb_instagram_image_padding_unit . '; ';
    $sb_instagram_styles .= '"';

    //Header
    $sb_instagram_show_header = $atts['showheader'];
    ( $sb_instagram_show_header == 'on' || $sb_instagram_show_header == 'true' || $sb_instagram_show_header == true ) ? $sb_instagram_show_header = true : $sb_instagram_show_header = false;
    if( $atts[ 'showheader' ] === 'false' ) $sb_instagram_show_header = false;
    $sb_instagram_header_color = str_replace('#', '', $atts['headercolor']);

    //Load more button
    $sb_instagram_show_btn = $atts['showbutton'];
    ( $sb_instagram_show_btn == 'on' || $sb_instagram_show_btn == 'true' || $sb_instagram_show_btn == true ) ? $sb_instagram_show_btn = true : $sb_instagram_show_btn = false;
    if( $atts[ 'showbutton' ] === 'false' ) $sb_instagram_show_btn = false;
    $sb_instagram_btn_background = str_replace('#', '', $atts['buttoncolor']);
    $sb_instagram_btn_text_color = str_replace('#', '', $atts['buttontextcolor']);
    //Load more button styles
    $sb_instagram_button_styles = 'style="';
    if ( !empty($sb_instagram_btn_background) ) $sb_instagram_button_styles .= 'background: #'.$sb_instagram_btn_background.'; ';
    if ( !empty($sb_instagram_btn_text_color) ) $sb_instagram_button_styles .= 'color: #'.$sb_instagram_btn_text_color.';';
    $sb_instagram_button_styles .= '"';

    //Follow button vars
    $sb_instagram_show_follow_btn = $atts['showfollow'];
    ( $sb_instagram_show_follow_btn == 'on' || $sb_instagram_show_follow_btn == 'true' || $sb_instagram_show_follow_btn == true ) ? $sb_instagram_show_follow_btn = true : $sb_instagram_show_follow_btn = false;
    if( $atts[ 'showfollow' ] === 'false' ) $sb_instagram_show_follow_btn = false;
    $sb_instagram_follow_btn_background = str_replace('#', '', $atts['followcolor']);
    $sb_instagram_follow_btn_text_color = str_replace('#', '', $atts['followtextcolor']);
    $sb_instagram_follow_btn_text = $atts['followtext'];
    //Follow button styles
    $sb_instagram_follow_btn_styles = 'style="';
    if ( !empty($sb_instagram_follow_btn_background) ) $sb_instagram_follow_btn_styles .= 'background: #'.$sb_instagram_follow_btn_background.'; ';
    if ( !empty($sb_instagram_follow_btn_text_color) ) $sb_instagram_follow_btn_styles .= 'color: #'.$sb_instagram_follow_btn_text_color.';';
    $sb_instagram_follow_btn_styles .= '"';
    //Follow button HTML
    $sb_instagram_follow_btn_html = '<div class="sbi_follow_btn"><a href="http://instagram.com/" '.$sb_instagram_follow_btn_styles.' target="_blank"><i class="fa fa-instagram"></i>'.$sb_instagram_follow_btn_text.'</a></div>';


    //Mobile
    $sb_instagram_disable_mobile = $atts['disablemobile'];
    ( $sb_instagram_disable_mobile == 'on' || $sb_instagram_disable_mobile == 'true' || $sb_instagram_disable_mobile == true ) ? $sb_instagram_disable_mobile = ' sbi_disable_mobile' : $sb_instagram_disable_mobile = '';
    if( $atts[ 'disablemobile' ] === 'false' ) $sb_instagram_disable_mobile = '';

    //Class
    !empty( $atts['class'] ) ? $sbi_class = ' ' . trim($atts['class']) : $sbi_class = '';

    //Ajax theme
    $sb_instagram_ajax_theme = $atts['ajaxtheme'];
    ( $sb_instagram_ajax_theme == 'on' || $sb_instagram_ajax_theme == 'true' || $sb_instagram_ajax_theme == true ) ? $sb_instagram_ajax_theme = true : $sb_instagram_ajax_theme = false;
    if( $atts[ 'disablemobile' ] === 'false' ) $sb_instagram_ajax_theme = false;


    /******************* CONTENT ********************/

    $sb_instagram_content = '<div id="sb_instagram" class="sbi' . $sbi_class . $sb_instagram_disable_mobile;
    if ( !empty($sb_instagram_height) ) $sb_instagram_content .= ' sbi_fixed_height ';
    $sb_instagram_content .= ' sbi_col_' . trim($sb_instagram_cols);
    if ( $sb_instagram_width_resp ) $sb_instagram_content .= ' sbi_width_resp';
    $sb_instagram_content .= '" '.$sb_instagram_styles .' data-id="' . $sb_instagram_user_id . '" data-num="' . trim($atts['num']) . '" data-res="' . trim($atts['imageres']) . '" data-cols="' . trim($sb_instagram_cols) . '" data-options=\'{&quot;sortby&quot;: &quot;'.$atts['sortby'].'&quot;, &quot;headercolor&quot;: &quot;'.$sb_instagram_header_color.'&quot;, &quot;imagepadding&quot;: &quot;'.$sb_instagram_image_padding.'&quot;}\'>';

    //Header
    if( $sb_instagram_show_header ) $sb_instagram_content .= '<div class="sb_instagram_header" style="padding: '.(2*intval($sb_instagram_image_padding)) . $sb_instagram_image_padding_unit .'; padding-bottom: 0;"></div>';

    //Images container
    $sb_instagram_content .= '<div id="sbi_images" style="padding: '.$sb_instagram_image_padding . $sb_instagram_image_padding_unit .';">';

    //Error messages
    $sb_instagram_error = false;
    if( empty($sb_instagram_user_id) || !isset($sb_instagram_user_id) ){
        $sb_instagram_content .= '<div class="sb_instagram_error"><p>Please enter a User ID on the Instagram Feed plugin Settings page</p></div>';
        $sb_instagram_error = true;
    }
    if( empty($options[ 'sb_instagram_at' ]) || !isset($options[ 'sb_instagram_at' ]) ){
        $sb_instagram_content .= '<div class="sb_instagram_error"><p>Please enter an Access Token on the Instagram Feed plugin Settings page</p></div>';
        $sb_instagram_error = true;
    }

    //Loader
    if( !$sb_instagram_error ) $sb_instagram_content .= '<div class="sbi_loader fa-spin"></div>';

    //Load section
    $sb_instagram_content .= '</div><div id="sbi_load"';
    if($sb_instagram_image_padding == 0 || !isset($sb_instagram_image_padding)) $sb_instagram_content .= ' style="padding-top: 5px"';
    $sb_instagram_content .= '>';

    //Load More button
    if( $sb_instagram_show_btn && !$sb_instagram_error ) $sb_instagram_content .= '<a class="sbi_load_btn" href="javascript:void(0);" '.$sb_instagram_button_styles.'>'.$atts['buttontext'].'</a>';

    //Follow button
    if( $sb_instagram_show_follow_btn && !$sb_instagram_error ) $sb_instagram_content .= $sb_instagram_follow_btn_html;

    $sb_instagram_content .= '</div>'; //End #sbi_load
    
    $sb_instagram_content .= '</div>'; //End #sb_instagram

    //If using an ajax theme then add the JS to the bottom of the feed
    if($sb_instagram_ajax_theme){
        $sb_instagram_content .= '<script type="text/javascript">var sb_instagram_js_options = {"sb_instagram_at":"'.trim($options['sb_instagram_at']).'"};</script>';
        $sb_instagram_content .= "<script type='text/javascript' src='".plugins_url( '/js/sb-instagram.min.js?ver='.SBIVER , __FILE__ )."'></script>";
    }
 
    //Return our feed HTML to display
    return $sb_instagram_content;

}


#############################

//Allows shortcodes in theme
add_filter('widget_text', 'do_shortcode');

//Enqueue stylesheet
add_action( 'wp_enqueue_scripts', 'sb_instagram_styles_enqueue' );
function sb_instagram_styles_enqueue() {
    wp_register_style( 'sb_instagram_styles', plugins_url('css/sb-instagram.min.css', __FILE__), array(), SBIVER );
    wp_enqueue_style( 'sb_instagram_styles' );

    $options = get_option('sb_instagram_settings');
    if(isset($options['sb_instagram_disable_awesome'])){
        if( !$options['sb_instagram_disable_awesome'] || !isset($options['sb_instagram_disable_awesome']) ) wp_enqueue_style( 'sb_instagram_icons', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css', array(), '4.6.3' );
    }
    
}

//Enqueue scripts
add_action( 'wp_enqueue_scripts', 'sb_instagram_scripts_enqueue' );
function sb_instagram_scripts_enqueue() {
    //Register the script to make it available
    wp_register_script( 'sb_instagram_scripts', plugins_url( '/js/sb-instagram.min.js' , __FILE__ ), array('jquery'), SBIVER, true ); //http://www.minifier.org/

    //Options to pass to JS file
    $sb_instagram_settings = get_option('sb_instagram_settings');

    //Access token
    isset($sb_instagram_settings[ 'sb_instagram_at' ]) ? $sb_instagram_at = trim($sb_instagram_settings['sb_instagram_at']) : $sb_instagram_at = '';

    $data = array(
        'sb_instagram_at' => $sb_instagram_at
    );

    isset($sb_instagram_settings[ 'sb_instagram_ajax_theme' ]) ? $sb_instagram_ajax_theme = trim($sb_instagram_settings['sb_instagram_ajax_theme']) : $sb_instagram_ajax_theme = '';
    ( $sb_instagram_ajax_theme == 'on' || $sb_instagram_ajax_theme == 'true' || $sb_instagram_ajax_theme == true ) ? $sb_instagram_ajax_theme = true : $sb_instagram_ajax_theme = false;

    //Enqueue it to load it onto the page
    if( !$sb_instagram_ajax_theme ) wp_enqueue_script('sb_instagram_scripts');

    //Pass option to JS file
    wp_localize_script('sb_instagram_scripts', 'sb_instagram_js_options', $data);
}

//Custom CSS
add_action( 'wp_head', 'sb_instagram_custom_css' );
function sb_instagram_custom_css() {
    $options = get_option('sb_instagram_settings');
    
    isset($options[ 'sb_instagram_custom_css' ]) ? $sb_instagram_custom_css = trim($options['sb_instagram_custom_css']) : $sb_instagram_custom_css = '';

    //Show CSS if an admin (so can see Hide Photos link), if including Custom CSS or if hiding some photos
    ( current_user_can( 'manage_options' ) || !empty($sb_instagram_custom_css) ) ? $sbi_show_css = true : $sbi_show_css = false;

    if( $sbi_show_css ) echo '<!-- Instagram Feed CSS -->';
    if( $sbi_show_css ) echo "\r\n";
    if( $sbi_show_css ) echo '<style type="text/css">';

    if( !empty($sb_instagram_custom_css) ){
        echo "\r\n";
        echo stripslashes($sb_instagram_custom_css);
    }

    if( current_user_can( 'manage_options' ) ){
        echo "\r\n";
        echo "#sbi_mod_error{ display: block; }";
    }

    if( $sbi_show_css ) echo "\r\n";
    if( $sbi_show_css ) echo '</style>';
    if( $sbi_show_css ) echo "\r\n";
}


//Custom JS
add_action( 'wp_footer', 'sb_instagram_custom_js' );
function sb_instagram_custom_js() {
    $options = get_option('sb_instagram_settings');
    isset($options[ 'sb_instagram_custom_js' ]) ? $sb_instagram_custom_js = trim($options['sb_instagram_custom_js']) : $sb_instagram_custom_js = '';

    if( !empty($sb_instagram_custom_js) ) echo '<!-- Instagram Feed JS -->';
    if( !empty($sb_instagram_custom_js) ) echo "\r\n";
    if( !empty($sb_instagram_custom_js) ) echo '<script type="text/javascript">';
    if( !empty($sb_instagram_custom_js) ) echo "\r\n";
    if( !empty($sb_instagram_custom_js) ) echo "jQuery( document ).ready(function($) {";
    if( !empty($sb_instagram_custom_js) ) echo "\r\n";
    if( !empty($sb_instagram_custom_js) ) echo "window.sbi_custom_js = function(){";
    if( !empty($sb_instagram_custom_js) ) echo "\r\n";
    if( !empty($sb_instagram_custom_js) ) echo stripslashes($sb_instagram_custom_js);
    if( !empty($sb_instagram_custom_js) ) echo "\r\n";
    if( !empty($sb_instagram_custom_js) ) echo "}";
    if( !empty($sb_instagram_custom_js) ) echo "\r\n";
    if( !empty($sb_instagram_custom_js) ) echo "});";
    if( !empty($sb_instagram_custom_js) ) echo "\r\n";
    if( !empty($sb_instagram_custom_js) ) echo '</script>';
    if( !empty($sb_instagram_custom_js) ) echo "\r\n";    
}

//Run function on plugin activate
function sb_instagram_activate() {
    $options = get_option('sb_instagram_settings');
    $options[ 'sb_instagram_show_btn' ] = true;
    $options[ 'sb_instagram_show_header' ] = true;
    $options[ 'sb_instagram_show_follow_btn' ] = true;
    update_option( 'sb_instagram_settings', $options );
}
register_activation_hook( __FILE__, 'sb_instagram_activate' );

//Uninstall
function sb_instagram_uninstall()
{
    if ( ! current_user_can( 'activate_plugins' ) )
        return;

    //If the user is preserving the settings then don't delete them
    $options = get_option('sb_instagram_settings');
    $sb_instagram_preserve_settings = $options[ 'sb_instagram_preserve_settings' ];
    if($sb_instagram_preserve_settings) return;

    //Settings
    delete_option( 'sb_instagram_settings' );
}
register_uninstall_hook( __FILE__, 'sb_instagram_uninstall' );

?>