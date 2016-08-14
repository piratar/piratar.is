<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

function cff_menu() {
    add_menu_page(
        '',
        'Facebook Feed',
        'manage_options',
        'cff-top',
        'cff_settings_page'
    );
    add_submenu_page(
        'cff-top',
        'Settings',
        'Settings',
        'manage_options',
        'cff-top',
        'cff_settings_page'
    );
}
add_action('admin_menu', 'cff_menu');
//Add styling page
function cff_styling_menu() {
    add_submenu_page(
        'cff-top',
        'Customize',
        'Customize',
        'manage_options',
        'cff-style',
        'cff_style_page'
    );
}
add_action('admin_menu', 'cff_styling_menu');

//Create Settings page
function cff_settings_page() {
    //Declare variables for fields
    $hidden_field_name      = 'cff_submit_hidden';
    $show_access_token      = 'cff_show_access_token';
    $access_token           = 'cff_access_token';
    $page_id                = 'cff_page_id';
    $cff_page_type          = 'cff_page_type';
    $num_show               = 'cff_num_show';
    $cff_post_limit         = 'cff_post_limit';
    $cff_show_others        = 'cff_show_others';
    $cff_cache_time         = 'cff_cache_time';
    $cff_cache_time_unit    = 'cff_cache_time_unit';
    $cff_locale             = 'cff_locale';
    // Read in existing option value from database
    $show_access_token_val = get_option( $show_access_token );
    $access_token_val = get_option( $access_token );
    $page_id_val = get_option( $page_id );
    $cff_page_type_val = get_option( $cff_page_type, 'page' );
    $num_show_val = get_option( $num_show, '5' );
    $cff_post_limit_val = get_option( $cff_post_limit );
    $cff_show_others_val = get_option( $cff_show_others );
    $cff_cache_time_val = get_option( $cff_cache_time, '1' );
    $cff_cache_time_unit_val = get_option( $cff_cache_time_unit, 'hours' );
    $cff_locale_val = get_option( $cff_locale, 'en_US' );

    //Timezone
    $defaults = array(
        'cff_timezone' => 'America/Chicago'
    );
    $options = wp_parse_args(get_option('cff_style_settings'), $defaults);
    $cff_timezone = $options[ 'cff_timezone' ];


    //Check nonce before saving data
    if ( ! isset( $_POST['cff_settings_nonce'] ) || ! wp_verify_nonce( $_POST['cff_settings_nonce'], 'cff_saving_settings' ) ) {
        //Nonce did not verify
    } else {
        // See if the user has posted us some information. If they did, this hidden field will be set to 'Y'.
        if( isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y' ) {
            // Read their posted value
            isset( $_POST[ $show_access_token ] ) ? $show_access_token_val = sanitize_text_field( $_POST[ $show_access_token ] ) : $show_access_token_val = '';
            isset( $_POST[ $access_token ] ) ? $access_token_val = sanitize_text_field( $_POST[ $access_token ] ) : $access_token_val = '';
            isset( $_POST[ $page_id ] ) ? $page_id_val = sanitize_text_field( $_POST[ $page_id ] ) : $page_id_val = '';
            isset( $_POST[ $cff_page_type ] ) ? $cff_page_type_val = sanitize_text_field( $_POST[ $cff_page_type ] ) : $cff_page_type_val = '';
            isset( $_POST[ $num_show ] ) ? $num_show_val = sanitize_text_field( $_POST[ $num_show ] ) : $num_show_val = '';
            isset( $_POST[ $cff_post_limit ] ) ? $cff_post_limit_val = sanitize_text_field( $_POST[ $cff_post_limit ] ) : $cff_post_limit_val = '';
            isset( $_POST[ $cff_show_others ] ) ? $cff_show_others_val = sanitize_text_field( $_POST[ $cff_show_others ] ) : $cff_show_others_val = '';
            isset( $_POST[ $cff_cache_time ] ) ? $cff_cache_time_val = sanitize_text_field( $_POST[ $cff_cache_time ] ) : $cff_cache_time_val = '';
            isset( $_POST[ $cff_cache_time_unit ] ) ? $cff_cache_time_unit_val = sanitize_text_field( $_POST[ $cff_cache_time_unit ] ) : $cff_cache_time_unit_val = '';
            isset( $_POST[ $cff_locale ] ) ? $cff_locale_val = sanitize_text_field( $_POST[ $cff_locale ] ) : $cff_locale_val = '';
            if (isset($_POST[ 'cff_timezone' ]) ) $cff_timezone = sanitize_text_field( $_POST[ 'cff_timezone' ] );

            // Save the posted value in the database
            update_option( $show_access_token, $show_access_token_val );
            update_option( $access_token, $access_token_val );
            update_option( $page_id, $page_id_val );
            update_option( $cff_page_type, $cff_page_type_val );
            update_option( $num_show, $num_show_val );
            update_option( $cff_post_limit, $cff_post_limit_val );
            update_option( $cff_show_others, $cff_show_others_val );
            update_option( $cff_cache_time, $cff_cache_time_val );
            update_option( $cff_cache_time_unit, $cff_cache_time_unit_val );
            update_option( $cff_locale, $cff_locale_val );

            $options[ 'cff_timezone' ] = $cff_timezone;
            update_option( 'cff_style_settings', $options );
            
            //Delete ALL transients
            global $wpdb;
            $table_name = $wpdb->prefix . "options";
            $wpdb->query( "
                DELETE
                FROM $table_name
                WHERE `option_name` LIKE ('%\_transient\_cff\_%')
                " );
            $wpdb->query( "
                DELETE
                FROM $table_name
                WHERE `option_name` LIKE ('%\_transient\_cff\_tle\_%')
                " );
            $wpdb->query( "
                DELETE
                FROM $table_name
                WHERE `option_name` LIKE ('%\_transient\_timeout\_cff\_%')
                " );
            // Put an settings updated message on the screen 
        ?>
        <div class="updated"><p><strong><?php _e('Settings saved.', 'custom-facebook-feed' ); ?></strong></p></div>
        <?php } ?> 

    <?php } //End nonce check ?> 
 
    <div id="cff-admin" class="wrap">
        <div id="header">
            <h2><?php _e('Custom Facebook Feed Settings', 'custom-facebook-feed'); ?></h2>
        </div>

        <?php
        $cff_active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'configuration';
        ?>
        <h2 class="nav-tab-wrapper">
            <a href="?page=cff-top&amp;tab=configuration" class="nav-tab <?php echo $cff_active_tab == 'configuration' ? 'nav-tab-active' : ''; ?>"><?php _e('Configuration', 'custom-facebook-feed'); ?></a>
            <a href="?page=cff-style" class="nav-tab <?php echo $cff_active_tab == 'customize' ? 'nav-tab-active' : ''; ?>"><?php _e('Customize', 'custom-facebook-feed'); ?></a>
            <a href="?page=cff-top&amp;tab=support" class="nav-tab <?php echo $cff_active_tab == 'support' ? 'nav-tab-active' : ''; ?>"><?php _e('Support', 'custom-facebook-feed'); ?></a>
        </h2>

        <?php if( $cff_active_tab == 'configuration' ) { //Start Extensions tab ?>

        <form name="form1" method="post" action="">
            <input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
            <?php wp_nonce_field( 'cff_saving_settings', 'cff_settings_nonce' ); ?>

            <br />
            <h3><?php _e('Configuration', 'custom-facebook-feed'); ?></h3>
            <table class="form-table">
                <tbody>
                    <tr valign="top">
                        <th scope="row"><label><?php _e('Facebook Page ID<br /><i style="font-weight: normal; font-size: 12px;">ID of your Facebook Page or Group</i>', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> id
                        Eg: id="YOUR_PAGE_ID"</code></th>
                        <td>
                            <input name="cff_page_id" id="cff_page_id" type="text" value="<?php esc_attr_e( $page_id_val, 'custom-facebook-feed' ); ?>" size="45" />
                            &nbsp;<a class="cff-tooltip-link" href="JavaScript:void(0);"><?php _e('What\'s my Page ID?', 'custom-facebook-feed'); ?></a>
                            <br /><i style="color: #666; font-size: 11px;">Eg. 1234567890123 or smashballoon</i>
                            <div class="cff-tooltip cff-more-info">
                                <ul>
                                    <li><?php _e('If you have a Facebook <b>page</b> with a URL like this: <code>https://www.facebook.com/your_page_name</code> then the Page ID is just <b>your_page_name</b>. If your page URL is structured like this: <code>https://www.facebook.com/pages/your_page_name/123654123654123</code> then the Page ID is actually the number at the end, so in this case <b>123654123654123</b>.</li>', 'custom-facebook-feed'); ?>
                                    <li><?php _e('If you have a Facebook <b>group</b> then use <a href="http://lookup-id.com/" target="_blank" title="Find my ID">this tool</a> to find your ID.', 'custom-facebook-feed'); ?></li>
                                    <li><?php _e('You can copy and paste your ID into the <a href="https://smashballoon.com/custom-facebook-feed/demo/" target="_blank">demo</a> to test it.', 'custom-facebook-feed'); ?></li>
                                </ul>
                            </div>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row" style="padding-bottom: 10px;"><?php _e('Enter my own Access Token <i style="font-weight: normal; font-size: 12px;">This is Recommended</i>', 'custom-facebook-feed'); ?></th>
                        <td>
                            <input name="cff_show_access_token" type="checkbox" id="cff_show_access_token" <?php if($show_access_token_val == true) echo "checked"; ?> />&nbsp;<a class="cff-tooltip-link" href="JavaScript:void(0);"><?php _e("What is this?", 'custom-facebook-feed'); ?></a>
                            <p class="cff-tooltip cff-more-info"><?php _e("A Facebook Access Token is not required to use this plugin, but we recommend it so that you're not reliant on the token built into the plugin. If you have your own token then you can check this box and enter it here. To get your own Access Token you can follow these <a href='https://smashballoon.com/custom-facebook-feed/access-token/' target='_blank'>step-by-step instructions</a>", 'custom-facebook-feed'); ?>.</p>
                        </td>
                    </tr>

                    <tr valign="top" class="cff-access-token-hidden">
                        <th scope="row" style="padding-bottom: 10px;"><?php _e('Facebook Access Token', 'custom-facebook-feed'); ?></th>
                        <td>
                            <input name="cff_access_token" id="cff_access_token" type="text" value="<?php esc_attr_e( $access_token_val, 'custom-facebook-feed' ); ?>" size="45" />

                            <div class="cff-notice cff-profile-error cff-access-token">
                                <?php _e("<p>This doesn't appear to be an Access Token. Please be sure that you didn't enter your App Secret instead of your Access Token.<br />Your App ID and App Secret are used to obtain your Access Token; simply paste them into the fields in the last step of the <a href='https://smashballoon.com/custom-facebook-feed/access-token/' target='_blank'>Access Token instructions</a> and click '<b>Get my Access Token</b>'.</p>", 'custom-facebook-feed'); ?>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <hr />
            <table class="form-table">
                <tbody>
                    <h3><?php _e('Settings', 'custom-facebook-feed'); ?></h3>
                    <tr valign="top" class="cff-page-type">
                        <th scope="row"><label><?php _e('Is this a page, group or profile?', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> pagetype
                        Eg: pagetype=group</code></th>
                        <td>
                            <select name="cff_page_type">
                                <option value="page" <?php if($cff_page_type_val == "page") echo 'selected="selected"' ?> ><?php _e('Page', 'custom-facebook-feed'); ?></option>
                                <option value="group" <?php if($cff_page_type_val == "group") echo 'selected="selected"' ?> ><?php _e('Group', 'custom-facebook-feed'); ?></option>
                                <option value="profile" <?php if($cff_page_type_val == "profile") echo 'selected="selected"' ?> ><?php _e('Profile', 'custom-facebook-feed'); ?></option>
                            </select>
                            <div class="cff-notice cff-profile-error cff-page-type">
                                <?php _e("<p>Due to Facebook's privacy policy you're not able to display posts from a personal profile, only from a public page or group.</p><p>If you're using a profile to represent a business, organization, product, public figure or the like, then Facebook recommends <a href='http://www.facebook.com/help/175644189234902/' target='_blank'>converting your profile to a page</a>. There are many advantages to using pages over profiles, and once you've converted then the plugin will be able to successfully retrieve and display all of your posts.</p>", 'custom-facebook-feed'); ?>
                            </div>
                        </td>
                    </tr>

                    <tr valign="top" class="cff-page-options">
                        <th scope="row"><label><?php _e('Show posts on my page by:', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> showpostsby
                        Eg: showpostsby=others</code></th>
                        <td>
                            <select name="cff_show_others" id="cff_show_others" style="width: 250px;">
                                <option value="me" <?php if($cff_show_others_val == 'me') echo 'selected="selected"' ?> ><?php _e('Only the page owner (me)', 'custom-facebook-feed'); ?></option>
                                <option value="others" <?php if($cff_show_others_val == 'others' || $cff_show_others_val == 'on') echo 'selected="selected"' ?> ><?php _e('Page owner + other people', 'custom-facebook-feed'); ?></option>
                                <option value="onlyothers" <?php if($cff_show_others_val == 'onlyothers') echo 'selected="selected"' ?> ><?php _e('Only other people', 'custom-facebook-feed'); ?></option>
                            </select>

                            <p id="cff-others-only" style="font-size: 12px;"><b>Note:</b> Only displaying posts by other people works by retrieving your posts from Facebook and then filtering out the posts by the page owner. If this option doesn't display many posts then you can retrieve more by setting the post limit option (below) to a higher number (a number 15-20 greater than the number of posts you want to display).</p>

                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row"><label><?php _e('Number of posts to display', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> num
                        Eg: num=5</code></th>
                        <td>
                            <input name="cff_num_show" type="text" value="<?php esc_attr_e( $num_show_val, 'custom-facebook-feed' ); ?>" size="4" />
                            <i style="color: #666; font-size: 11px;">Eg. 5</i>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><label><?php _e('Change the post limit', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> limit
                        Eg: limit=10</code></th>
                        <td>
                            <input name="cff_post_limit" type="text" value="<?php esc_attr_e( $cff_post_limit_val, 'custom-facebook-feed' ); ?>" size="4" />
                            <i style="color: #666; font-size: 11px;">Eg. 20</i> <a class="cff-tooltip-link" href="JavaScript:void(0);"><?php _e('What does this mean?', 'custom-facebook-feed'); ?></a>
                            <p class="cff-tooltip cff-more-info"><?php _e("Most users don't need to change the post lmit. The 'limit' is the number of posts retrieved from the Facebook API. By default the plugin retrieves 7 posts more from the Facebook API than you specify in the 'Number of posts to display' field above, as some posts are filtered out. You can alter how many posts are retrieved by manually setting this value. If you choose to retrieve a high number of posts then it will take longer for Facebook to return the posts when the plugin checks for new ones.", 'custom-facebook-feed'); ?></p>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><?php _e('Check for new Facebook posts every', 'custom-facebook-feed'); ?></th>
                        <td>
                            <input name="cff_cache_time" type="text" value="<?php esc_attr_e( $cff_cache_time_val, 'custom-facebook-feed' ); ?>" size="4" />
                            <select name="cff_cache_time_unit">
                                <option value="minutes" <?php if($cff_cache_time_unit_val == "minutes") echo 'selected="selected"' ?> ><?php _e('Minutes', 'custom-facebook-feed'); ?></option>
                                <option value="hours" <?php if($cff_cache_time_unit_val == "hours") echo 'selected="selected"' ?> ><?php _e('Hours', 'custom-facebook-feed'); ?></option>
                                <option value="days" <?php if($cff_cache_time_unit_val == "days") echo 'selected="selected"' ?> ><?php _e('Days', 'custom-facebook-feed'); ?></option>
                            </select>
                            <a class="cff-tooltip-link" href="JavaScript:void(0);"><?php _e('What does this mean?', 'custom-facebook-feed'); ?></a>
                            <p class="cff-tooltip cff-more-info"><?php _e('Your Facebook posts and comments data is temporarily cached by the plugin in your WordPress database. You can choose how long this data should be cached for. If you set the time to 60 minutes then the plugin will clear the cached data after that length of time, and the next time the page is viewed it will check for new data.', 'custom-facebook-feed'); ?></p>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row"><label><?php _e('Localization', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> locale
                        Eg: locale=es_ES</code></th>
                        <td>
                            <select name="cff_locale">
                                <option value="af_ZA" <?php if($cff_locale_val == "af_ZA") echo 'selected="selected"' ?> ><?php _e('Afrikaans', 'custom-facebook-feed'); ?></option>
                                <option value="ar_AR" <?php if($cff_locale_val == "ar_AR") echo 'selected="selected"' ?> ><?php _e('Arabic', 'custom-facebook-feed'); ?></option>
                                <option value="az_AZ" <?php if($cff_locale_val == "az_AZ") echo 'selected="selected"' ?> ><?php _e('Azerbaijani', 'custom-facebook-feed'); ?></option>
                                <option value="be_BY" <?php if($cff_locale_val == "be_BY") echo 'selected="selected"' ?> ><?php _e('Belarusian', 'custom-facebook-feed'); ?></option>
                                <option value="bg_BG" <?php if($cff_locale_val == "bg_BG") echo 'selected="selected"' ?> ><?php _e('Bulgarian', 'custom-facebook-feed'); ?></option>
                                <option value="bn_IN" <?php if($cff_locale_val == "bn_IN") echo 'selected="selected"' ?> ><?php _e('Bengali', 'custom-facebook-feed'); ?></option>
                                <option value="bs_BA" <?php if($cff_locale_val == "bs_BA") echo 'selected="selected"' ?> ><?php _e('Bosnian', 'custom-facebook-feed'); ?></option>
                                <option value="ca_ES" <?php if($cff_locale_val == "ca_ES") echo 'selected="selected"' ?> ><?php _e('Catalan', 'custom-facebook-feed'); ?></option>
                                <option value="cs_CZ" <?php if($cff_locale_val == "cs_CZ") echo 'selected="selected"' ?> ><?php _e('Czech', 'custom-facebook-feed'); ?></option>
                                <option value="cy_GB" <?php if($cff_locale_val == "cy_GB") echo 'selected="selected"' ?> ><?php _e('Welsh', 'custom-facebook-feed'); ?></option>
                                <option value="da_DK" <?php if($cff_locale_val == "da_DK") echo 'selected="selected"' ?> ><?php _e('Danish', 'custom-facebook-feed'); ?></option>
                                <option value="de_DE" <?php if($cff_locale_val == "de_DE") echo 'selected="selected"' ?> ><?php _e('German', 'custom-facebook-feed'); ?></option>
                                <option value="el_GR" <?php if($cff_locale_val == "el_GR") echo 'selected="selected"' ?> ><?php _e('Greek', 'custom-facebook-feed'); ?></option>
                                <option value="en_GB" <?php if($cff_locale_val == "en_GB") echo 'selected="selected"' ?> ><?php _e('English (UK)', 'custom-facebook-feed'); ?></option>
                                <option value="en_PI" <?php if($cff_locale_val == "en_PI") echo 'selected="selected"' ?> ><?php _e('English (Pirate)', 'custom-facebook-feed'); ?></option>
                                <option value="en_UD" <?php if($cff_locale_val == "en_UD") echo 'selected="selected"' ?> ><?php _e('English (Upside Down)', 'custom-facebook-feed'); ?></option>
                                <option value="en_US" <?php if($cff_locale_val == "en_US") echo 'selected="selected"' ?> ><?php _e('English (US)', 'custom-facebook-feed'); ?></option>
                                <option value="eo_EO" <?php if($cff_locale_val == "eo_EO") echo 'selected="selected"' ?> ><?php _e('Esperanto', 'custom-facebook-feed'); ?></option>
                                <option value="es_ES" <?php if($cff_locale_val == "es_ES") echo 'selected="selected"' ?> ><?php _e('Spanish (Spain)', 'custom-facebook-feed'); ?></option>
                                <option value="es_LA" <?php if($cff_locale_val == "es_LA") echo 'selected="selected"' ?> ><?php _e('Spanish', 'custom-facebook-feed'); ?></option>
                                <option value="et_EE" <?php if($cff_locale_val == "et_EE") echo 'selected="selected"' ?> ><?php _e('Estonian', 'custom-facebook-feed'); ?></option>
                                <option value="eu_ES" <?php if($cff_locale_val == "eu_ES") echo 'selected="selected"' ?> ><?php _e('Basque', 'custom-facebook-feed'); ?></option>
                                <option value="fa_IR" <?php if($cff_locale_val == "fa_IR") echo 'selected="selected"' ?> ><?php _e('Persian', 'custom-facebook-feed'); ?></option>
                                <option value="fb_LT" <?php if($cff_locale_val == "fb_LT") echo 'selected="selected"' ?> ><?php _e('Leet Speak', 'custom-facebook-feed'); ?></option>
                                <option value="fi_FI" <?php if($cff_locale_val == "fi_FI") echo 'selected="selected"' ?> ><?php _e('Finnish', 'custom-facebook-feed'); ?></option>
                                <option value="fo_FO" <?php if($cff_locale_val == "fo_FO") echo 'selected="selected"' ?> ><?php _e('Faroese', 'custom-facebook-feed'); ?></option>
                                <option value="fr_CA" <?php if($cff_locale_val == "fr_CA") echo 'selected="selected"' ?> ><?php _e('French (Canada)', 'custom-facebook-feed'); ?></option>
                                <option value="fr_FR" <?php if($cff_locale_val == "fr_FR") echo 'selected="selected"' ?> ><?php _e('French (France)', 'custom-facebook-feed'); ?></option>
                                <option value="fy_NL" <?php if($cff_locale_val == "fy_NL") echo 'selected="selected"' ?> ><?php _e('Frisian', 'custom-facebook-feed'); ?></option>
                                <option value="ga_IE" <?php if($cff_locale_val == "ga_IE") echo 'selected="selected"' ?> ><?php _e('Irish', 'custom-facebook-feed'); ?></option>
                                <option value="gl_ES" <?php if($cff_locale_val == "gl_ES") echo 'selected="selected"' ?> ><?php _e('Galician', 'custom-facebook-feed'); ?></option>
                                <option value="he_IL" <?php if($cff_locale_val == "he_IL") echo 'selected="selected"' ?> ><?php _e('Hebrew', 'custom-facebook-feed'); ?></option>
                                <option value="hi_IN" <?php if($cff_locale_val == "hi_IN") echo 'selected="selected"' ?> ><?php _e('Hindi', 'custom-facebook-feed'); ?></option>
                                <option value="hr_HR" <?php if($cff_locale_val == "hr_HR") echo 'selected="selected"' ?> ><?php _e('Croatian', 'custom-facebook-feed'); ?></option>
                                <option value="hu_HU" <?php if($cff_locale_val == "hu_HU") echo 'selected="selected"' ?> ><?php _e('Hungarian', 'custom-facebook-feed'); ?></option>
                                <option value="hy_AM" <?php if($cff_locale_val == "hy_AM") echo 'selected="selected"' ?> ><?php _e('Armenian', 'custom-facebook-feed'); ?></option>
                                <option value="id_ID" <?php if($cff_locale_val == "id_ID") echo 'selected="selected"' ?> ><?php _e('Indonesian', 'custom-facebook-feed'); ?></option>
                                <option value="is_IS" <?php if($cff_locale_val == "is_IS") echo 'selected="selected"' ?> ><?php _e('Icelandic', 'custom-facebook-feed'); ?></option>
                                <option value="it_IT" <?php if($cff_locale_val == "it_IT") echo 'selected="selected"' ?> ><?php _e('Italian', 'custom-facebook-feed'); ?></option>
                                <option value="ja_JP" <?php if($cff_locale_val == "ja_JP") echo 'selected="selected"' ?> ><?php _e('Japanese', 'custom-facebook-feed'); ?></option>
                                <option value="ka_GE" <?php if($cff_locale_val == "ka_GE") echo 'selected="selected"' ?> ><?php _e('Georgian', 'custom-facebook-feed'); ?></option>
                                <option value="km_KH" <?php if($cff_locale_val == "km_KH") echo 'selected="selected"' ?> ><?php _e('Khmer', 'custom-facebook-feed'); ?></option>
                                <option value="ko_KR" <?php if($cff_locale_val == "ko_KR") echo 'selected="selected"' ?> ><?php _e('Korean', 'custom-facebook-feed'); ?></option>
                                <option value="ku_TR" <?php if($cff_locale_val == "ku_TR") echo 'selected="selected"' ?> ><?php _e('Kurdish', 'custom-facebook-feed'); ?></option>
                                <option value="la_VA" <?php if($cff_locale_val == "la_VA") echo 'selected="selected"' ?> ><?php _e('Latin', 'custom-facebook-feed'); ?></option>
                                <option value="lt_LT" <?php if($cff_locale_val == "lt_LT") echo 'selected="selected"' ?> ><?php _e('Lithuanian', 'custom-facebook-feed'); ?></option>
                                <option value="lv_LV" <?php if($cff_locale_val == "lv_LV") echo 'selected="selected"' ?> ><?php _e('Latvian', 'custom-facebook-feed'); ?></option>
                                <option value="mk_MK" <?php if($cff_locale_val == "mk_MK") echo 'selected="selected"' ?> ><?php _e('Macedonian', 'custom-facebook-feed'); ?></option>
                                <option value="ml_IN" <?php if($cff_locale_val == "ml_IN") echo 'selected="selected"' ?> ><?php _e('Malayalam', 'custom-facebook-feed'); ?></option>
                                <option value="ms_MY" <?php if($cff_locale_val == "ms_MY") echo 'selected="selected"' ?> ><?php _e('Malay', 'custom-facebook-feed'); ?></option>
                                <option value="nb_NO" <?php if($cff_locale_val == "nb_NO") echo 'selected="selected"' ?> ><?php _e('Norwegian (bokmal)', 'custom-facebook-feed'); ?></option>
                                <option value="ne_NP" <?php if($cff_locale_val == "ne_NP") echo 'selected="selected"' ?> ><?php _e('Nepali', 'custom-facebook-feed'); ?></option>
                                <option value="nl_NL" <?php if($cff_locale_val == "nl_NL") echo 'selected="selected"' ?> ><?php _e('Dutch', 'custom-facebook-feed'); ?></option>
                                <option value="nn_NO" <?php if($cff_locale_val == "nn_NO") echo 'selected="selected"' ?> ><?php _e('Norwegian (nynorsk)', 'custom-facebook-feed'); ?></option>
                                <option value="pa_IN" <?php if($cff_locale_val == "pa_IN") echo 'selected="selected"' ?> ><?php _e('Punjabi', 'custom-facebook-feed'); ?></option>
                                <option value="pl_PL" <?php if($cff_locale_val == "pl_PL") echo 'selected="selected"' ?> ><?php _e('Polish', 'custom-facebook-feed'); ?></option>
                                <option value="ps_AF" <?php if($cff_locale_val == "ps_AF") echo 'selected="selected"' ?> ><?php _e('Pashto', 'custom-facebook-feed'); ?></option>
                                <option value="pt_BR" <?php if($cff_locale_val == "pt_BR") echo 'selected="selected"' ?> ><?php _e('Portuguese (Brazil)', 'custom-facebook-feed'); ?></option>
                                <option value="pt_PT" <?php if($cff_locale_val == "pt_PT") echo 'selected="selected"' ?> ><?php _e('Portuguese (Portugal)', 'custom-facebook-feed'); ?></option>
                                <option value="ro_RO" <?php if($cff_locale_val == "ro_RO") echo 'selected="selected"' ?> ><?php _e('Romanian', 'custom-facebook-feed'); ?></option>
                                <option value="ru_RU" <?php if($cff_locale_val == "ru_RU") echo 'selected="selected"' ?> ><?php _e('Russian', 'custom-facebook-feed'); ?></option>
                                <option value="sk_SK" <?php if($cff_locale_val == "sk_SK") echo 'selected="selected"' ?> ><?php _e('Slovak', 'custom-facebook-feed'); ?></option>
                                <option value="sl_SI" <?php if($cff_locale_val == "sl_SI") echo 'selected="selected"' ?> ><?php _e('Slovenian', 'custom-facebook-feed'); ?></option>
                                <option value="sq_AL" <?php if($cff_locale_val == "sq_AL") echo 'selected="selected"' ?> ><?php _e('Albanian', 'custom-facebook-feed'); ?></option>
                                <option value="sr_RS" <?php if($cff_locale_val == "sr_RS") echo 'selected="selected"' ?> ><?php _e('Serbian', 'custom-facebook-feed'); ?></option>
                                <option value="sv_SE" <?php if($cff_locale_val == "sv_SE") echo 'selected="selected"' ?> ><?php _e('Swedish', 'custom-facebook-feed'); ?></option>
                                <option value="sw_KE" <?php if($cff_locale_val == "sw_KE") echo 'selected="selected"' ?> ><?php _e('Swahili', 'custom-facebook-feed'); ?></option>
                                <option value="ta_IN" <?php if($cff_locale_val == "ta_IN") echo 'selected="selected"' ?> ><?php _e('Tamil', 'custom-facebook-feed'); ?></option>
                                <option value="te_IN" <?php if($cff_locale_val == "te_IN") echo 'selected="selected"' ?> ><?php _e('Telugu', 'custom-facebook-feed'); ?></option>
                                <option value="th_TH" <?php if($cff_locale_val == "th_TH") echo 'selected="selected"' ?> ><?php _e('Thai', 'custom-facebook-feed'); ?></option>
                                <option value="tl_PH" <?php if($cff_locale_val == "tl_PH") echo 'selected="selected"' ?> ><?php _e('Filipino', 'custom-facebook-feed'); ?></option>
                                <option value="tr_TR" <?php if($cff_locale_val == "tr_TR") echo 'selected="selected"' ?> ><?php _e('Turkish', 'custom-facebook-feed'); ?></option>
                                <option value="uk_UA" <?php if($cff_locale_val == "uk_UA") echo 'selected="selected"' ?> ><?php _e('Ukrainian', 'custom-facebook-feed'); ?></option>
                                <option value="vi_VN" <?php if($cff_locale_val == "vi_VN") echo 'selected="selected"' ?> ><?php _e('Vietnamese', 'custom-facebook-feed'); ?></option>
                                <option value="zh_CN" <?php if($cff_locale_val == "zh_CN") echo 'selected="selected"' ?> ><?php _e('Simplified Chinese (China)', 'custom-facebook-feed'); ?></option>
                                <option value="zh_HK" <?php if($cff_locale_val == "zh_HK") echo 'selected="selected"' ?> ><?php _e('Traditional Chinese (Hong Kong)', 'custom-facebook-feed'); ?></option>
                                <option value="zh_TW" <?php if($cff_locale_val == "zh_TW") echo 'selected="selected"' ?> ><?php _e('Traditional Chinese (Taiwan)', 'custom-facebook-feed'); ?></option>
                            </select>
                            <i style="color: #666; font-size: 11px;"><?php _e('Select a language', 'custom-facebook-feed'); ?></i>
                        </td>
                    </tr>

                    <tr>
                        <th><label for="cff_timezone" class="bump-left"><?php _e('Timezone', 'custom-facebook-feed'); ?></label></th>
                            <td>
                                <select name="cff_timezone" style="width: 300px;">
                                    <option value="Pacific/Midway" <?php if($cff_timezone == "Pacific/Midway") echo 'selected="selected"' ?> ><?php _e('(GMT-11:00) Midway Island, Samoa', 'custom-facebook-feed'); ?></option>
                                    <option value="America/Adak" <?php if($cff_timezone == "America/Adak") echo 'selected="selected"' ?> ><?php _e('(GMT-10:00) Hawaii-Aleutian', 'custom-facebook-feed'); ?></option>
                                    <option value="Etc/GMT+10" <?php if($cff_timezone == "Etc/GMT+10") echo 'selected="selected"' ?> ><?php _e('(GMT-10:00) Hawaii', 'custom-facebook-feed'); ?></option>
                                    <option value="Pacific/Marquesas" <?php if($cff_timezone == "Pacific/Marquesas") echo 'selected="selected"' ?> ><?php _e('(GMT-09:30) Marquesas Islands', 'custom-facebook-feed'); ?></option>
                                    <option value="Pacific/Gambier" <?php if($cff_timezone == "Pacific/Gambier") echo 'selected="selected"' ?> ><?php _e('(GMT-09:00) Gambier Islands', 'custom-facebook-feed'); ?></option>
                                    <option value="America/Anchorage" <?php if($cff_timezone == "America/Anchorage") echo 'selected="selected"' ?> ><?php _e('(GMT-09:00) Alaska', 'custom-facebook-feed'); ?></option>
                                    <option value="America/Ensenada" <?php if($cff_timezone == "America/Ensenada") echo 'selected="selected"' ?> ><?php _e('(GMT-08:00) Tijuana, Baja California', 'custom-facebook-feed'); ?></option>
                                    <option value="Etc/GMT+8" <?php if($cff_timezone == "Etc/GMT+8") echo 'selected="selected"' ?> ><?php _e('(GMT-08:00) Pitcairn Islands', 'custom-facebook-feed'); ?></option>
                                    <option value="America/Los_Angeles" <?php if($cff_timezone == "America/Los_Angeles") echo 'selected="selected"' ?> ><?php _e('(GMT-08:00) Pacific Time (US & Canada)', 'custom-facebook-feed'); ?></option>
                                    <option value="America/Denver" <?php if($cff_timezone == "America/Denver") echo 'selected="selected"' ?> ><?php _e('(GMT-07:00) Mountain Time (US & Canada)', 'custom-facebook-feed'); ?></option>
                                    <option value="America/Chihuahua" <?php if($cff_timezone == "America/Chihuahua") echo 'selected="selected"' ?> ><?php _e('(GMT-07:00) Chihuahua, La Paz, Mazatlan', 'custom-facebook-feed'); ?></option>
                                    <option value="America/Dawson_Creek" <?php if($cff_timezone == "America/Dawson_Creek") echo 'selected="selected"' ?> ><?php _e('(GMT-07:00) Arizona', 'custom-facebook-feed'); ?></option>
                                    <option value="America/Belize" <?php if($cff_timezone == "America/Belize") echo 'selected="selected"' ?> ><?php _e('(GMT-06:00) Saskatchewan, Central America', 'custom-facebook-feed'); ?></option>
                                    <option value="America/Cancun" <?php if($cff_timezone == "America/Cancun") echo 'selected="selected"' ?> ><?php _e('(GMT-06:00) Guadalajara, Mexico City, Monterrey', 'custom-facebook-feed'); ?></option>
                                    <option value="Chile/EasterIsland" <?php if($cff_timezone == "Chile/EasterIsland") echo 'selected="selected"' ?> ><?php _e('(GMT-06:00) Easter Island', 'custom-facebook-feed'); ?></option>
                                    <option value="America/Chicago" <?php if($cff_timezone == "America/Chicago") echo 'selected="selected"' ?> ><?php _e('(GMT-06:00) Central Time (US & Canada)', 'custom-facebook-feed'); ?></option>
                                    <option value="America/New_York" <?php if($cff_timezone == "America/New_York") echo 'selected="selected"' ?> ><?php _e('(GMT-05:00) Eastern Time (US & Canada)', 'custom-facebook-feed'); ?></option>
                                    <option value="America/Havana" <?php if($cff_timezone == "America/Havana") echo 'selected="selected"' ?> ><?php _e('(GMT-05:00) Cuba', 'custom-facebook-feed'); ?></option>
                                    <option value="America/Bogota" <?php if($cff_timezone == "America/Bogota") echo 'selected="selected"' ?> ><?php _e('(GMT-05:00) Bogota, Lima, Quito, Rio Branco', 'custom-facebook-feed'); ?></option>
                                    <option value="America/Caracas" <?php if($cff_timezone == "America/Caracas") echo 'selected="selected"' ?> ><?php _e('(GMT-04:30) Caracas', 'custom-facebook-feed'); ?></option>
                                    <option value="America/Santiago" <?php if($cff_timezone == "America/Santiago") echo 'selected="selected"' ?> ><?php _e('(GMT-04:00) Santiago', 'custom-facebook-feed'); ?></option>
                                    <option value="America/La_Paz" <?php if($cff_timezone == "America/La_Paz") echo 'selected="selected"' ?> ><?php _e('(GMT-04:00) La Paz', 'custom-facebook-feed'); ?></option>
                                    <option value="Atlantic/Stanley" <?php if($cff_timezone == "Atlantic/Stanley") echo 'selected="selected"' ?> ><?php _e('(GMT-04:00) Faukland Islands', 'custom-facebook-feed'); ?></option>
                                    <option value="America/Campo_Grande" <?php if($cff_timezone == "America/Campo_Grande") echo 'selected="selected"' ?> ><?php _e('(GMT-04:00) Brazil', 'custom-facebook-feed'); ?></option>
                                    <option value="America/Goose_Bay" <?php if($cff_timezone == "America/Goose_Bay") echo 'selected="selected"' ?> ><?php _e('(GMT-04:00) Atlantic Time (Goose Bay)', 'custom-facebook-feed'); ?></option>
                                    <option value="America/Glace_Bay" <?php if($cff_timezone == "America/Glace_Bay") echo 'selected="selected"' ?> ><?php _e('(GMT-04:00) Atlantic Time (Canada)', 'custom-facebook-feed'); ?></option>
                                    <option value="America/St_Johns" <?php if($cff_timezone == "America/St_Johns") echo 'selected="selected"' ?> ><?php _e('(GMT-03:30) Newfoundland', 'custom-facebook-feed'); ?></option>
                                    <option value="America/Araguaina" <?php if($cff_timezone == "America/Araguaina") echo 'selected="selected"' ?> ><?php _e('(GMT-03:00) UTC-3', 'custom-facebook-feed'); ?></option>
                                    <option value="America/Montevideo" <?php if($cff_timezone == "America/Montevideo") echo 'selected="selected"' ?> ><?php _e('(GMT-03:00) Montevideo', 'custom-facebook-feed'); ?></option>
                                    <option value="America/Miquelon" <?php if($cff_timezone == "America/Miquelon") echo 'selected="selected"' ?> ><?php _e('(GMT-03:00) Miquelon, St. Pierre', 'custom-facebook-feed'); ?></option>
                                    <option value="America/Godthab" <?php if($cff_timezone == "America/Godthab") echo 'selected="selected"' ?> ><?php _e('(GMT-03:00) Greenland', 'custom-facebook-feed'); ?></option>
                                    <option value="America/Argentina/Buenos_Aires" <?php if($cff_timezone == "America/Argentina/Buenos_Aires") echo 'selected="selected"' ?> ><?php _e('(GMT-03:00) Buenos Aires', 'custom-facebook-feed'); ?></option>
                                    <option value="America/Sao_Paulo" <?php if($cff_timezone == "America/Sao_Paulo") echo 'selected="selected"' ?> ><?php _e('(GMT-03:00) Brasilia', 'custom-facebook-feed'); ?></option>
                                    <option value="America/Noronha" <?php if($cff_timezone == "America/Noronha") echo 'selected="selected"' ?> ><?php _e('(GMT-02:00) Mid-Atlantic', 'custom-facebook-feed'); ?></option>
                                    <option value="Atlantic/Cape_Verde" <?php if($cff_timezone == "Atlantic/Cape_Verde") echo 'selected="selected"' ?> ><?php _e('(GMT-01:00) Cape Verde Is.', 'custom-facebook-feed'); ?></option>
                                    <option value="Atlantic/Azores" <?php if($cff_timezone == "Atlantic/Azores") echo 'selected="selected"' ?> ><?php _e('(GMT-01:00) Azores', 'custom-facebook-feed'); ?></option>
                                    <option value="Europe/Belfast" <?php if($cff_timezone == "Europe/Belfast") echo 'selected="selected"' ?> ><?php _e('(GMT) Greenwich Mean Time : Belfast', 'custom-facebook-feed'); ?></option>
                                    <option value="Europe/Dublin" <?php if($cff_timezone == "Europe/Dublin") echo 'selected="selected"' ?> ><?php _e('(GMT) Greenwich Mean Time : Dublin', 'custom-facebook-feed'); ?></option>
                                    <option value="Europe/Lisbon" <?php if($cff_timezone == "Europe/Lisbon") echo 'selected="selected"' ?> ><?php _e('(GMT) Greenwich Mean Time : Lisbon', 'custom-facebook-feed'); ?></option>
                                    <option value="Europe/London" <?php if($cff_timezone == "Europe/London") echo 'selected="selected"' ?> ><?php _e('(GMT) Greenwich Mean Time : London', 'custom-facebook-feed'); ?></option>
                                    <option value="Africa/Abidjan" <?php if($cff_timezone == "Africa/Abidjan") echo 'selected="selected"' ?> ><?php _e('(GMT) Monrovia, Reykjavik', 'custom-facebook-feed'); ?></option>
                                    <option value="Europe/Amsterdam" <?php if($cff_timezone == "Europe/Amsterdam") echo 'selected="selected"' ?> ><?php _e('(GMT+01:00) Amsterdam, Berlin, Bern, Rome, Stockholm, Vienna', 'custom-facebook-feed'); ?></option>
                                    <option value="Europe/Belgrade" <?php if($cff_timezone == "Europe/Belgrade") echo 'selected="selected"' ?> ><?php _e('(GMT+01:00) Belgrade, Bratislava, Budapest, Ljubljana, Prague', 'custom-facebook-feed'); ?></option>
                                    <option value="Europe/Brussels" <?php if($cff_timezone == "Europe/Brussels") echo 'selected="selected"' ?> ><?php _e('(GMT+01:00) Brussels, Copenhagen, Madrid, Paris', 'custom-facebook-feed'); ?></option>
                                    <option value="Africa/Algiers" <?php if($cff_timezone == "Africa/Algiers") echo 'selected="selected"' ?> ><?php _e('(GMT+01:00) West Central Africa', 'custom-facebook-feed'); ?></option>
                                    <option value="Africa/Windhoek" <?php if($cff_timezone == "Africa/Windhoek") echo 'selected="selected"' ?> ><?php _e('(GMT+01:00) Windhoek', 'custom-facebook-feed'); ?></option>
                                    <option value="Asia/Beirut" <?php if($cff_timezone == "Asia/Beirut") echo 'selected="selected"' ?> ><?php _e('(GMT+02:00) Beirut', 'custom-facebook-feed'); ?></option>
                                    <option value="Africa/Cairo" <?php if($cff_timezone == "Africa/Cairo") echo 'selected="selected"' ?> ><?php _e('(GMT+02:00) Cairo', 'custom-facebook-feed'); ?></option>
                                    <option value="Asia/Gaza" <?php if($cff_timezone == "Asia/Gaza") echo 'selected="selected"' ?> ><?php _e('(GMT+02:00) Gaza', 'custom-facebook-feed'); ?></option>
                                    <option value="Africa/Blantyre" <?php if($cff_timezone == "Africa/Blantyre") echo 'selected="selected"' ?> ><?php _e('(GMT+02:00) Harare, Pretoria', 'custom-facebook-feed'); ?></option>
                                    <option value="Asia/Jerusalem" <?php if($cff_timezone == "Asia/Jerusalem") echo 'selected="selected"' ?> ><?php _e('(GMT+02:00) Jerusalem', 'custom-facebook-feed'); ?></option>
                                    <option value="Europe/Minsk" <?php if($cff_timezone == "Europe/Minsk") echo 'selected="selected"' ?> ><?php _e('(GMT+02:00) Minsk', 'custom-facebook-feed'); ?></option>
                                    <option value="Asia/Damascus" <?php if($cff_timezone == "Asia/Damascus") echo 'selected="selected"' ?> ><?php _e('(GMT+02:00) Syria', 'custom-facebook-feed'); ?></option>
                                    <option value="Europe/Moscow" <?php if($cff_timezone == "Europe/Moscow") echo 'selected="selected"' ?> ><?php _e('(GMT+03:00) Moscow, St. Petersburg, Volgograd', 'custom-facebook-feed'); ?></option>
                                    <option value="Africa/Addis_Ababa" <?php if($cff_timezone == "Africa/Addis_Ababa") echo 'selected="selected"' ?> ><?php _e('(GMT+03:00) Nairobi', 'custom-facebook-feed'); ?></option>
                                    <option value="Asia/Tehran" <?php if($cff_timezone == "Asia/Tehran") echo 'selected="selected"' ?> ><?php _e('(GMT+03:30) Tehran', 'custom-facebook-feed'); ?></option>
                                    <option value="Asia/Dubai" <?php if($cff_timezone == "Asia/Dubai") echo 'selected="selected"' ?> ><?php _e('(GMT+04:00) Abu Dhabi, Muscat', 'custom-facebook-feed'); ?></option>
                                    <option value="Asia/Yerevan" <?php if($cff_timezone == "Asia/Yerevan") echo 'selected="selected"' ?> ><?php _e('(GMT+04:00) Yerevan', 'custom-facebook-feed'); ?></option>
                                    <option value="Asia/Kabul" <?php if($cff_timezone == "Asia/Kabul") echo 'selected="selected"' ?> ><?php _e('(GMT+04:30) Kabul', 'custom-facebook-feed'); ?></option>
                                    <option value="Asia/Yekaterinburg" <?php if($cff_timezone == "Asia/Yekaterinburg") echo 'selected="selected"' ?> ><?php _e('(GMT+05:00) Ekaterinburg', 'custom-facebook-feed'); ?></option>
                                    <option value="Asia/Tashkent" <?php if($cff_timezone == "Asia/Tashkent") echo 'selected="selected"' ?> ><?php _e('(GMT+05:00) Tashkent', 'custom-facebook-feed'); ?></option>
                                    <option value="Asia/Kolkata" <?php if($cff_timezone == "Asia/Kolkata") echo 'selected="selected"' ?> ><?php _e('(GMT+05:30) Chennai, Kolkata, Mumbai, New Delhi', 'custom-facebook-feed'); ?></option>
                                    <option value="Asia/Katmandu" <?php if($cff_timezone == "Asia/Katmandu") echo 'selected="selected"' ?> ><?php _e('(GMT+05:45) Kathmandu', 'custom-facebook-feed'); ?></option>
                                    <option value="Asia/Dhaka" <?php if($cff_timezone == "Asia/Dhaka") echo 'selected="selected"' ?> ><?php _e('(GMT+06:00) Astana, Dhaka', 'custom-facebook-feed'); ?></option>
                                    <option value="Asia/Novosibirsk" <?php if($cff_timezone == "Asia/Novosibirsk") echo 'selected="selected"' ?> ><?php _e('(GMT+06:00) Novosibirsk', 'custom-facebook-feed'); ?></option>
                                    <option value="Asia/Rangoon" <?php if($cff_timezone == "Asia/Rangoon") echo 'selected="selected"' ?> ><?php _e('(GMT+06:30) Yangon (Rangoon)', 'custom-facebook-feed'); ?></option>
                                    <option value="Asia/Bangkok" <?php if($cff_timezone == "Asia/Bangkok") echo 'selected="selected"' ?> ><?php _e('(GMT+07:00) Bangkok, Hanoi, Jakarta', 'custom-facebook-feed'); ?></option>
                                    <option value="Asia/Krasnoyarsk" <?php if($cff_timezone == "Asia/Krasnoyarsk") echo 'selected="selected"' ?> ><?php _e('(GMT+07:00) Krasnoyarsk', 'custom-facebook-feed'); ?></option>
                                    <option value="Asia/Hong_Kong" <?php if($cff_timezone == "Asia/Hong_Kong") echo 'selected="selected"' ?> ><?php _e('(GMT+08:00) Beijing, Chongqing, Hong Kong, Urumqi', 'custom-facebook-feed'); ?></option>
                                    <option value="Asia/Irkutsk" <?php if($cff_timezone == "Asia/Irkutsk") echo 'selected="selected"' ?> ><?php _e('(GMT+08:00) Irkutsk, Ulaan Bataar', 'custom-facebook-feed'); ?></option>
                                    <option value="Australia/Perth" <?php if($cff_timezone == "Australia/Perth") echo 'selected="selected"' ?> ><?php _e('(GMT+08:00) Perth', 'custom-facebook-feed'); ?></option>
                                    <option value="Australia/Eucla" <?php if($cff_timezone == "Australia/Eucla") echo 'selected="selected"' ?> ><?php _e('(GMT+08:45) Eucla', 'custom-facebook-feed'); ?></option>
                                    <option value="Asia/Tokyo" <?php if($cff_timezone == "Asia/Tokyo") echo 'selected="selected"' ?> ><?php _e('(GMT+09:00) Osaka, Sapporo, Tokyo', 'custom-facebook-feed'); ?></option>
                                    <option value="Asia/Seoul" <?php if($cff_timezone == "Asia/Seoul") echo 'selected="selected"' ?> ><?php _e('(GMT+09:00) Seoul', 'custom-facebook-feed'); ?></option>
                                    <option value="Asia/Yakutsk" <?php if($cff_timezone == "Asia/Yakutsk") echo 'selected="selected"' ?> ><?php _e('(GMT+09:00) Yakutsk', 'custom-facebook-feed'); ?></option>
                                    <option value="Australia/Adelaide" <?php if($cff_timezone == "Australia/Adelaide") echo 'selected="selected"' ?> ><?php _e('(GMT+09:30) Adelaide', 'custom-facebook-feed'); ?></option>
                                    <option value="Australia/Darwin" <?php if($cff_timezone == "Australia/Darwin") echo 'selected="selected"' ?> ><?php _e('(GMT+09:30) Darwin', 'custom-facebook-feed'); ?></option>
                                    <option value="Australia/Brisbane" <?php if($cff_timezone == "Australia/Brisbane") echo 'selected="selected"' ?> ><?php _e('(GMT+10:00) Brisbane', 'custom-facebook-feed'); ?></option>
                                    <option value="Australia/Hobart" <?php if($cff_timezone == "Australia/Hobart") echo 'selected="selected"' ?> ><?php _e('(GMT+10:00) Sydney', 'custom-facebook-feed'); ?></option>
                                    <option value="Asia/Vladivostok" <?php if($cff_timezone == "Asia/Vladivostok") echo 'selected="selected"' ?> ><?php _e('(GMT+10:00) Vladivostok', 'custom-facebook-feed'); ?></option>
                                    <option value="Australia/Lord_Howe" <?php if($cff_timezone == "Australia/Lord_Howe") echo 'selected="selected"' ?> ><?php _e('(GMT+10:30) Lord Howe Island', 'custom-facebook-feed'); ?></option>
                                    <option value="Etc/GMT-11" <?php if($cff_timezone == "Etc/GMT-11") echo 'selected="selected"' ?> ><?php _e('(GMT+11:00) Solomon Is., New Caledonia', 'custom-facebook-feed'); ?></option>
                                    <option value="Asia/Magadan" <?php if($cff_timezone == "Asia/Magadan") echo 'selected="selected"' ?> ><?php _e('(GMT+11:00) Magadan', 'custom-facebook-feed'); ?></option>
                                    <option value="Pacific/Norfolk" <?php if($cff_timezone == "Pacific/Norfolk") echo 'selected="selected"' ?> ><?php _e('(GMT+11:30) Norfolk Island', 'custom-facebook-feed'); ?></option>
                                    <option value="Asia/Anadyr" <?php if($cff_timezone == "Asia/Anadyr") echo 'selected="selected"' ?> ><?php _e('(GMT+12:00) Anadyr, Kamchatka', 'custom-facebook-feed'); ?></option>
                                    <option value="Pacific/Auckland" <?php if($cff_timezone == "Pacific/Auckland") echo 'selected="selected"' ?> ><?php _e('(GMT+12:00) Auckland, Wellington', 'custom-facebook-feed'); ?></option>
                                    <option value="Etc/GMT-12" <?php if($cff_timezone == "Etc/GMT-12") echo 'selected="selected"' ?> ><?php _e('(GMT+12:00) Fiji, Kamchatka, Marshall Is.', 'custom-facebook-feed'); ?></option>
                                    <option value="Pacific/Chatham" <?php if($cff_timezone == "Pacific/Chatham") echo 'selected="selected"' ?> ><?php _e('(GMT+12:45) Chatham Islands', 'custom-facebook-feed'); ?></option>
                                    <option value="Pacific/Tongatapu" <?php if($cff_timezone == "Pacific/Tongatapu") echo 'selected="selected"' ?> ><?php _e('(GMT+13:00) Nuku\'alofa', 'custom-facebook-feed'); ?></option>
                                    <option value="Pacific/Kiritimati" <?php if($cff_timezone == "Pacific/Kiritimati") echo 'selected="selected"' ?> ><?php _e('(GMT+14:00) Kiritimati', 'custom-facebook-feed'); ?></option>
                                </select>
                            </td>
                        </tr>
                    
                </tbody>
            </table>
            <?php submit_button(); ?>
            <p>Having trouble using the plugin? Check out the <a href='admin.php?page=cff-top&amp;tab=support'>Support</a> tab.</p>
        </form>
        <hr />
        <h3><?php _e('Displaying your Feed', 'custom-facebook-feed'); ?></h3>
        <p><?php _e("Copy and paste this shortcode directly into the page, post or widget where you'd like the feed to show up:", 'custom-facebook-feed'); ?></p>
        <input type="text" value="[custom-facebook-feed]" size="22" readonly="readonly" onclick="this.focus();this.select()" title="<?php _e('To copy, click the field then press Ctrl + C (PC) or Cmd + C (Mac).', 'custom-facebook-feed'); ?>" />
        <hr />
        <h3><?php _e('Customizing your Feed', 'custom-facebook-feed'); ?></h3>
        <p><?php _e("Use the <a href='admin.php?page=cff-style'>Customize</a> page to customize your feed. If you're displaying <b>multiple feeds</b> then you can override your settings and customizations by using options directly in the shortcode, like so:", 'custom-facebook-feed'); ?></p>
        <p>[custom-facebook-feed id=some-other-page-id num=3 height=500px]</p>
        <p><a href="https://smashballoon.com/custom-facebook-feed/docs/shortcodes/" target="_blank"><?php _e('See a full list of shortcode options', 'custom-facebook-feed'); ?></a></p>

        <br />
        <a href="https://smashballoon.com/custom-facebook-feed/demo" target="_blank"><img src="<?php echo plugins_url( 'img/pro.png' , __FILE__ ) ?>" /></a>

        <hr />
        <h3><?php _e('Like the plugin? Help spread the word!', 'custom-facebook-feed'); ?></h3>

        <!-- TWITTER -->
        <a href="https://twitter.com/share" class="twitter-share-button" data-url="https://wordpress.org/plugins/custom-facebook-feed/" data-text="Display your Facebook posts on your site your way using the Custom Facebook Feed WordPress plugin!" data-via="smashballoon" data-dnt="true">Tweet</a>
        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
        <style type="text/css">
        #twitter-widget-0{ float: left; width: 100px !important; }
        .IN-widget{ margin-right: 20px; }
        </style>

        <!-- FACEBOOK -->
        <div id="fb-root" style="display: none;"></div>
        <script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&appId=640861236031365&version=v2.0";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
        <div class="fb-like" data-href="https://wordpress.org/plugins/custom-facebook-feed/" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true" style="display: block; float: left; margin-right: 20px;"></div>

        <!-- LINKEDIN -->
        <script src="//platform.linkedin.com/in.js" type="text/javascript">
          lang: en_US
        </script>
        <script type="IN/Share" data-url="https://wordpress.org/plugins/custom-facebook-feed/"></script>

        <!-- GOOGLE + -->
        <script src="https://apis.google.com/js/platform.js" async defer></script>
        <div class="g-plusone" data-size="medium" data-href="https://wordpress.org/plugins/custom-facebook-feed/"></div>

    <?php } //End config tab ?>


    <?php if( $cff_active_tab == 'support' ) { //Start Support tab ?>

        <br />
        <h3>Documentation</h3>
        <p>Need help setting up, configuring or customizing the plugin? Check out the links below:</p>
        <ul>
        <li>- <?php _e('<a href="https://smashballoon.com/custom-facebook-feed/docs/free/" target="_blank">Installation and Configuration</a>', 'custom-facebook-feed'); ?></li>
        <li>- <?php _e('<a href="https://smashballoon.com/custom-facebook-feed/docs/shortcodes/" target="_blank">Shortcode Reference</a>', 'custom-facebook-feed'); ?></li>
        <li>- <?php _e('<a href="https://smashballoon.com/category/custom-facebook-feed/customizations/snippets/?cat=18" target="_blank">Custom CSS and JavaScript Snippets</a>', 'custom-facebook-feed'); ?></li>
        </ul>
        <br />
        <h3><?php _e('FAQs and Troubleshooting', 'custom-facebook-feed'); ?></h3>
        <p>Having trouble getting the plugin to work? Try the links below:</p>
        <ul>
        <li>- <?php _e('<a href="https://smashballoon.com/category/custom-facebook-feed/faq/?cat=18" target="_blank">General Questions</a>', 'custom-facebook-feed'); ?></li>
        <li>- <?php _e('<a href="https://smashballoon.com/custom-facebook-feed/faq/setup/" target="_blank">Setting Up &amp; Displaying your Feed</a>', 'custom-facebook-feed'); ?></li>
        <li>- <?php _e('<a href="https://smashballoon.com/category/custom-facebook-feed/troubleshooting/?cat=18" target="_blank">Troubleshooting &amp; Common Support Questions</a>', 'custom-facebook-feed'); ?></li>
        </ul>

        <br />
        <p><?php _e('Still need help? <a href="http://smashballoon.com/custom-facebook-feed/support/" target="_blank">Request support</a>. Please include your <b>System Info</b> below with all support requests.', 'custom-facebook-feed'); ?></p>

        <br />
        <h3><?php _e('System Info &nbsp; <i style="color: #666; font-size: 11px; font-weight: normal;">Click the text below to select all</i>', 'custom-facebook-feed'); ?></h3>

        <?php
        $access_token = get_option( $access_token );
        if ( $access_token == '' || empty($access_token) ) $access_token = '611606915581035|RdRHbHtrHseQw4C7SDUBFWIrJLA';
        ?>
        <?php $posts_json = cff_fetchUrl("https://graph.facebook.com/".get_option( trim($page_id) )."/feed?access_token=". trim($access_token) ."&limit=1"); ?>


        <textarea readonly="readonly" onclick="this.focus();this.select()" title="To copy, click the field then press Ctrl + C (PC) or Cmd + C (Mac)." style="width: 70%; height: 500px; white-space: pre; font-family: Menlo,Monaco,monospace;">
## SITE/SERVER INFO: ##
Site URL:                 <?php echo site_url() . "\n"; ?>
Home URL:                 <?php echo home_url() . "\n"; ?>
WordPress Version:        <?php echo get_bloginfo( 'version' ) . "\n"; ?>
PHP Version:              <?php echo PHP_VERSION . "\n"; ?>
Web Server Info:          <?php echo $_SERVER['SERVER_SOFTWARE'] . "\n"; ?>
PHP allow_url_fopen:      <?php echo ini_get( 'allow_url_fopen' ) ? "Yes" . "\n" : "No" . "\n"; ?>
PHP cURL:                 <?php echo is_callable('curl_init') ? "Yes" . "\n" : "No" . "\n"; ?>
JSON:                     <?php echo function_exists("json_decode") ? "Yes" . "\n" : "No" . "\n" ?>
SSL Stream:               <?php echo in_array('https', stream_get_wrappers()) ? "Yes" . "\n" : "No" . "\n" ?>

## ACTIVE PLUGINS: ##
<?php
$plugins = get_plugins();
$active_plugins = get_option( 'active_plugins', array() );

foreach ( $plugins as $plugin_path => $plugin ) {
    // If the plugin isn't active, don't show it.
    if ( ! in_array( $plugin_path, $active_plugins ) )
        continue;

    echo $plugin['Name'] . ': ' . $plugin['Version'] ."\n";
}
?>

## PLUGIN SETTINGS: ##
Use own Access Token:   <?php echo get_option( 'cff_show_access_token' ) ."\n"; ?>
Access Token:           <?php echo get_option( 'cff_access_token' ) ."\n"; ?>
Page ID:                <?php echo get_option( 'cff_page_id' ) ."\n"; ?>
Page Type:              <?php echo get_option( 'cff_page_type' ) ."\n"; ?>
Number of Posts:        <?php echo get_option( 'cff_num_show' ) ."\n"; ?>
Post Limit:             <?php echo get_option( 'cff_post_limit' ) ."\n"; ?>
Show Posts by:          <?php echo get_option( 'cff_show_others' ) ."\n"; ?>
Cache Time:             <?php echo get_option( 'cff_cache_time' ) ."\n"; ?>
Cache Unit:             <?php echo get_option( 'cff_cache_time_unit' ) ."\n"; ?>
Locale:                 <?php echo get_option( 'cff_locale' ) ."\n"; ?>
Timezone:               <?php $options = get_option( 'cff_style_settings', array() );
                        echo $options[ 'cff_timezone' ] ."\n"; ?>


## CUSTOMIZE: ##
cff_ajax => <?php echo get_option('cff_ajax') ."\n"; ?>
cff_preserve_settings => <?php echo get_option('cff_preserve_settings') ."\n"; ?>
cff_title_length => <?php echo get_option('cff_title_length') ."\n"; ?>
cff_body_length => <?php echo get_option('cff_body_length') ."\n"; ?>
<?php 
while (list($key, $val) = each($options)) {
    echo "$key => $val\n";
}
?>

## FACEBOOK API RESPONSE: ##
<?php echo $posts_json; ?>
        </textarea>

    <?php } ?>
        
        
<?php 
} //End Settings_Page 
//Create Style page
function cff_style_page() {
    //Declare variables for fields
    $style_hidden_field_name                = 'cff_style_submit_hidden';
    $style_general_hidden_field_name        = 'cff_style_general_submit_hidden';
    $style_post_layout_hidden_field_name    = 'cff_style_post_layout_submit_hidden';
    $style_typography_hidden_field_name     = 'cff_style_typography_submit_hidden';
    $style_misc_hidden_field_name           = 'cff_style_misc_submit_hidden';
    $style_custom_text_hidden_field_name    = 'cff_style_custom_text_submit_hidden';

    //Defaults need to be here on the Settings page so that they're saved when the initial settings are saved
    $defaults = array(
        //Post types
        'cff_show_links_type'       => true,
        'cff_show_event_type'       => true,
        'cff_show_video_type'       => true,
        'cff_show_photos_type'      => true,
        'cff_show_status_type'      => true,
        //Layout
        'cff_preset_layout'         => 'thumb',
        //Include
        'cff_show_text'             => true,
        'cff_show_desc'             => true,
        'cff_show_shared_links'     => true,
        'cff_show_date'             => true,
        'cff_show_media'            => true,
        'cff_show_media_link'       => true,
        'cff_show_event_title'      => true,
        'cff_show_event_details'    => true,
        'cff_show_meta'             => true,
        'cff_show_link'             => true,
        'cff_show_like_box'         => true,
        //Post Styple
        'cff_post_bg_color'         => '',
        'cff_post_rounded'          => '0',

        //Typography
        'cff_title_format'          => 'p',
        'cff_title_size'            => 'inherit',
        'cff_title_weight'          => 'inherit',
        'cff_title_color'           => '',
        'cff_posttext_link_color'   => '',
        'cff_body_size'             => '12',
        'cff_body_weight'           => 'inherit',
        'cff_body_color'            => '',
        'cff_link_title_format'     => 'p',
        'cff_link_title_size'       => 'inherit',
        'cff_link_title_color'      => '',
        'cff_link_url_color'        => '',
        'cff_link_bg_color'         => '',
        'cff_link_border_color'     => '',
        'cff_disable_link_box'      => '',
        //Event title
        'cff_event_title_format'    => 'p',
        'cff_event_title_size'      => 'inherit',
        'cff_event_title_weight'    => 'inherit',
        'cff_event_title_color'     => '',
        //Event date
        'cff_event_date_size'       => 'inherit',
        'cff_event_date_weight'     => 'inherit',
        'cff_event_date_color'      => '',
        'cff_event_date_position'   => 'below',
        'cff_event_date_formatting' => '1',
        'cff_event_date_custom'     => '',
        //Event details
        'cff_event_details_size'    => 'inherit',
        'cff_event_details_weight'  => 'inherit',
        'cff_event_details_color'   => '',
        'cff_event_link_color'      => '',
        //Date
        'cff_date_position'         => 'author',
        'cff_date_size'             => 'inherit',
        'cff_date_weight'           => 'inherit',
        'cff_date_color'            => '',
        'cff_date_formatting'       => '1',
        'cff_date_custom'           => '',
        'cff_date_before'           => '',
        'cff_date_after'            => '',
        'cff_timezone'              => 'America/Chicago',

        //Link to Facebook
        'cff_link_size'             => 'inherit',
        'cff_link_weight'           => 'inherit',
        'cff_link_color'            => '',
        'cff_facebook_link_text'    => 'View on Facebook',
        'cff_view_link_text'        => 'View Link',
        'cff_link_to_timeline'      => false,
        //Meta
        'cff_icon_style'            => 'light',
        'cff_meta_text_color'       => '',
        'cff_meta_bg_color'         => '',
        'cff_nocomments_text'       => 'No comments yet',
        'cff_hide_comments'         => '',
        //Misc
        'cff_feed_width'            => '',
        'cff_feed_width_resp'       => false,
        'cff_feed_height'           => '',
        'cff_feed_padding'          => '',
        'cff_like_box_position'     => 'bottom',
        'cff_like_box_outside'      => false,
        'cff_likebox_width'         => '',
        'cff_likebox_height'        => '',
        'cff_like_box_faces'        => false,
        'cff_like_box_border'       => false,
        'cff_like_box_cover'        => true,
        'cff_like_box_small_header' => false,
        'cff_like_box_hide_cta'     => false,

        'cff_bg_color'              => '',
        'cff_likebox_bg_color'      => '',
        'cff_like_box_text_color'   => 'blue',
        'cff_video_height'          => '',
        'cff_show_author'           => true,
        'cff_class'                 => '',
        'cff_open_links'            => true,
        'cff_cron'                  => 'unset',
        'cff_request_method'        => 'auto',
        'cff_disable_styles'        => false,

        //New
        'cff_custom_css'            => '',
        'cff_custom_js'             => '',
        'cff_title_link'            => false,
        'cff_post_tags'             => true,
        'cff_link_hashtags'         => true,
        'cff_event_title_link'      => true,
        'cff_video_action'          => 'post',
        'cff_app_id'                => '',
        'cff_show_credit'           => '',
        'cff_font_source'           => '',
        'cff_sep_color'             => '',
        'cff_sep_size'              => '1',

        //Feed Header
        'cff_show_header'           => '',
        'cff_header_outside'        => false,
        'cff_header_text'           => 'Facebook Posts',
        'cff_header_bg_color'       => '',
        'cff_header_padding'        => '',
        'cff_header_text_size'      => '',
        'cff_header_text_weight'    => '',
        'cff_header_text_color'     => '',
        'cff_header_icon'           => '',
        'cff_header_icon_color'     => '',
        'cff_header_icon_size'      => '28',

        //Author
        'cff_author_size'           => 'inherit',
        'cff_author_color'          => '',

        //Translate - general
        'cff_see_more_text'         => 'See More',
        'cff_see_less_text'         => 'See Less',
        'cff_facebook_link_text'    => 'View on Facebook',
        'cff_facebook_share_text'   => 'Share',
        'cff_show_facebook_link'    => true,
        'cff_show_facebook_share'   => true,

        'cff_translate_photos_text' => 'photos',
        'cff_translate_photo_text'  => 'Photo',
        'cff_translate_video_text'  => 'Video',

        //Translate - date
        'cff_translate_second'      => 'second',
        'cff_translate_seconds'     => 'seconds',
        'cff_translate_minute'      => 'minute',
        'cff_translate_minutes'     => 'minutes',
        'cff_translate_hour'        => 'hour',
        'cff_translate_hours'       => 'hours',
        'cff_translate_day'         => 'day',
        'cff_translate_days'        => 'days',
        'cff_translate_week'        => 'week',
        'cff_translate_weeks'       => 'weeks',
        'cff_translate_month'       => 'month',
        'cff_translate_months'      => 'months',
        'cff_translate_year'        => 'year',
        'cff_translate_years'       => 'years',
        'cff_translate_ago'         => 'ago'
    );
    //Save layout option in an array
    $options = wp_parse_args(get_option('cff_style_settings'), $defaults);
    add_option( 'cff_style_settings', $options );

    //Set the page variables
    //Post types
    $cff_show_links_type = $options[ 'cff_show_links_type' ];
    $cff_show_event_type = $options[ 'cff_show_event_type' ];
    $cff_show_video_type = $options[ 'cff_show_video_type' ];
    $cff_show_photos_type = $options[ 'cff_show_photos_type' ];
    $cff_show_status_type = $options[ 'cff_show_status_type' ];
    //Layout
    $cff_preset_layout = $options[ 'cff_preset_layout' ];
    //Include
    $cff_show_text = $options[ 'cff_show_text' ];
    $cff_show_desc = $options[ 'cff_show_desc' ];
    $cff_show_shared_links = $options[ 'cff_show_shared_links' ];
    $cff_show_date = $options[ 'cff_show_date' ];
    $cff_show_media = $options[ 'cff_show_media' ];
    $cff_show_media_link = $options[ 'cff_show_media_link' ];
    $cff_show_event_title = $options[ 'cff_show_event_title' ];
    $cff_show_event_details = $options[ 'cff_show_event_details' ];
    $cff_show_meta = $options[ 'cff_show_meta' ];
    $cff_show_link = $options[ 'cff_show_link' ];
    $cff_show_like_box = $options[ 'cff_show_like_box' ];
    //Post Style
    $cff_post_bg_color = $options[ 'cff_post_bg_color' ];
    $cff_post_rounded = $options[ 'cff_post_rounded' ];

    //Typography
    $cff_see_more_text = $options[ 'cff_see_more_text' ];
    $cff_see_less_text = $options[ 'cff_see_less_text' ];
    $cff_title_format = $options[ 'cff_title_format' ];
    $cff_title_size = $options[ 'cff_title_size' ];
    $cff_title_weight = $options[ 'cff_title_weight' ];
    $cff_title_color = $options[ 'cff_title_color' ];
    $cff_posttext_link_color = $options[ 'cff_posttext_link_color' ];
    $cff_body_size = $options[ 'cff_body_size' ];
    $cff_body_weight = $options[ 'cff_body_weight' ];
    $cff_body_color = $options[ 'cff_body_color' ];
    $cff_link_title_format = $options[ 'cff_link_title_format' ];
    $cff_link_title_size = $options[ 'cff_link_title_size' ];
    $cff_link_title_color = $options[ 'cff_link_title_color' ];
    $cff_link_url_color = $options[ 'cff_link_url_color' ];
    $cff_link_bg_color = $options[ 'cff_link_bg_color' ];
    $cff_link_border_color = $options[ 'cff_link_border_color' ];
    $cff_disable_link_box = $options[ 'cff_disable_link_box' ];

    //Event title
    $cff_event_title_format = $options[ 'cff_event_title_format' ];
    $cff_event_title_size = $options[ 'cff_event_title_size' ];
    $cff_event_title_weight = $options[ 'cff_event_title_weight' ];
    $cff_event_title_color = $options[ 'cff_event_title_color' ];
    //Event date
    $cff_event_date_size = $options[ 'cff_event_date_size' ];
    $cff_event_date_weight = $options[ 'cff_event_date_weight' ];
    $cff_event_date_color = $options[ 'cff_event_date_color' ];
    $cff_event_date_position = $options[ 'cff_event_date_position' ];
    $cff_event_date_formatting = $options[ 'cff_event_date_formatting' ];
    $cff_event_date_custom = $options[ 'cff_event_date_custom' ];
    //Event details
    $cff_event_details_size = $options[ 'cff_event_details_size' ];
    $cff_event_details_weight = $options[ 'cff_event_details_weight' ];
    $cff_event_details_color = $options[ 'cff_event_details_color' ];
    $cff_event_link_color = $options[ 'cff_event_link_color' ];
    //Date
    $cff_date_position = $options[ 'cff_date_position' ];
    $cff_date_size = $options[ 'cff_date_size' ];
    $cff_date_weight = $options[ 'cff_date_weight' ];
    $cff_date_color = $options[ 'cff_date_color' ];
    $cff_date_formatting = $options[ 'cff_date_formatting' ];
    $cff_date_custom = $options[ 'cff_date_custom' ];
    $cff_date_before = $options[ 'cff_date_before' ];
    $cff_date_after = $options[ 'cff_date_after' ];
    $cff_timezone = $options[ 'cff_timezone' ];

    //Date translate
    $cff_translate_second = $options[ 'cff_translate_second' ];
    $cff_translate_seconds = $options[ 'cff_translate_seconds' ];
    $cff_translate_minute = $options[ 'cff_translate_minute' ];
    $cff_translate_minutes = $options[ 'cff_translate_minutes' ];
    $cff_translate_hour = $options[ 'cff_translate_hour' ];
    $cff_translate_hours = $options[ 'cff_translate_hours' ];
    $cff_translate_day = $options[ 'cff_translate_day' ];
    $cff_translate_days = $options[ 'cff_translate_days' ];
    $cff_translate_week = $options[ 'cff_translate_week' ];
    $cff_translate_weeks = $options[ 'cff_translate_weeks' ];
    $cff_translate_month = $options[ 'cff_translate_month' ];
    $cff_translate_months = $options[ 'cff_translate_months' ];
    $cff_translate_year = $options[ 'cff_translate_year' ];
    $cff_translate_years = $options[ 'cff_translate_years' ];
    $cff_translate_ago = $options[ 'cff_translate_ago' ];
    //Photos translate
    $cff_translate_photos_text = $options[ 'cff_translate_photos_text' ];
    $cff_translate_photo_text = $options[ 'cff_translate_photo_text' ];
    $cff_translate_video_text = $options[ 'cff_translate_video_text' ];

    //View on Facebook link
    $cff_link_size = $options[ 'cff_link_size' ];
    $cff_link_weight = $options[ 'cff_link_weight' ];
    $cff_link_color = $options[ 'cff_link_color' ];
    $cff_facebook_link_text = $options[ 'cff_facebook_link_text' ];
    $cff_view_link_text = $options[ 'cff_view_link_text' ];
    $cff_link_to_timeline = $options[ 'cff_link_to_timeline' ];
    $cff_facebook_share_text = $options[ 'cff_facebook_share_text' ];
    $cff_show_facebook_link = $options[ 'cff_show_facebook_link' ];
    $cff_show_facebook_share = $options[ 'cff_show_facebook_share' ];
    //Meta
    $cff_icon_style = $options[ 'cff_icon_style' ];
    $cff_meta_text_color = $options[ 'cff_meta_text_color' ];
    $cff_meta_bg_color = $options[ 'cff_meta_bg_color' ];
    $cff_nocomments_text = $options[ 'cff_nocomments_text' ];
    $cff_hide_comments = $options[ 'cff_hide_comments' ];
    //Misc
    $cff_feed_width = $options[ 'cff_feed_width' ];
    $cff_feed_width_resp = $options[ 'cff_feed_width_resp' ]; 
    $cff_feed_height = $options[ 'cff_feed_height' ];
    $cff_feed_padding = $options[ 'cff_feed_padding' ];
    $cff_like_box_position = $options[ 'cff_like_box_position' ];
    $cff_like_box_outside = $options[ 'cff_like_box_outside' ];
    $cff_likebox_width = $options[ 'cff_likebox_width' ];
    $cff_likebox_height = $options[ 'cff_likebox_height' ];
    $cff_like_box_faces = $options[ 'cff_like_box_faces' ];
    $cff_like_box_border = $options[ 'cff_like_box_border' ];
    $cff_like_box_cover = $options[ 'cff_like_box_cover' ];
    $cff_like_box_small_header = $options[ 'cff_like_box_small_header' ];
    $cff_like_box_hide_cta = $options[ 'cff_like_box_hide_cta' ];


    $cff_show_media = $options[ 'cff_show_media' ];
    $cff_bg_color = $options[ 'cff_bg_color' ];
    $cff_likebox_bg_color = $options[ 'cff_likebox_bg_color' ];
    $cff_like_box_text_color = $options[ 'cff_like_box_text_color' ];
    $cff_video_height = $options[ 'cff_video_height' ];
    $cff_show_author = $options[ 'cff_show_author' ];
    $cff_class = $options[ 'cff_class' ];
    $cff_open_links = $options[ 'cff_open_links' ];
    $cff_app_id = $options[ 'cff_app_id' ];
    $cff_show_credit = $options[ 'cff_show_credit' ];
    $cff_font_source = $options[ 'cff_font_source' ];
    $cff_preserve_settings   = 'cff_preserve_settings';
    $cff_preserve_settings_val = get_option( $cff_preserve_settings );
    $cff_cron = $options[ 'cff_cron' ];
    $cff_request_method = $options[ 'cff_request_method' ];
    $cff_disable_styles = $options[ 'cff_disable_styles' ];

    //Page Header
    $cff_show_header = $options[ 'cff_show_header' ];
    $cff_header_outside = $options[ 'cff_header_outside' ];
    $cff_header_text = $options[ 'cff_header_text' ];
    $cff_header_bg_color = $options[ 'cff_header_bg_color' ];
    $cff_header_padding = $options[ 'cff_header_padding' ];
    $cff_header_text_size = $options[ 'cff_header_text_size' ];
    $cff_header_text_weight = $options[ 'cff_header_text_weight' ];
    $cff_header_text_color = $options[ 'cff_header_text_color' ];
    $cff_header_icon = $options[ 'cff_header_icon' ];
    $cff_header_icon_color = $options[ 'cff_header_icon_color' ];
    $cff_header_icon_size = $options[ 'cff_header_icon_size' ];

    //Author
    $cff_author_size = $options[ 'cff_author_size' ];
    $cff_author_color = $options[ 'cff_author_color' ];

    //New
    $cff_custom_css = $options[ 'cff_custom_css' ];
    $cff_custom_js = $options[ 'cff_custom_js' ];
    $cff_title_link = $options[ 'cff_title_link' ];
    $cff_post_tags = $options[ 'cff_post_tags' ];
    $cff_link_hashtags = $options[ 'cff_link_hashtags' ];
    $cff_event_title_link = $options[ 'cff_event_title_link' ];
    $cff_video_action = $options[ 'cff_video_action' ];
    $cff_sep_color = $options[ 'cff_sep_color' ];
    $cff_sep_size = $options[ 'cff_sep_size' ];
	
	// Texts lengths
	$cff_title_length   = 'cff_title_length';
    $cff_body_length    = 'cff_body_length';
    // Read in existing option value from database
    $cff_title_length_val = get_option( $cff_title_length, '400' );
    $cff_body_length_val = get_option( $cff_body_length, '200' );

    //Ajax
    $cff_ajax = 'cff_ajax';
    $cff_ajax_val = get_option( $cff_ajax );


    //Check nonce before saving data
    if ( ! isset( $_POST['cff_customize_nonce'] ) || ! wp_verify_nonce( $_POST['cff_customize_nonce'], 'cff_saving_customize' ) ) {
        //Nonce did not verify
    } else {
        // See if the user has posted us some information. If they did, this hidden field will be set to 'Y'.
        if( isset($_POST[ $style_hidden_field_name ]) && $_POST[ $style_hidden_field_name ] == 'Y' ) {
            //Update the General options
            if( isset($_POST[ $style_general_hidden_field_name ]) && $_POST[ $style_general_hidden_field_name ] == 'Y' ) {
                //General
                if (isset($_POST[ 'cff_feed_width' ]) ) $cff_feed_width = sanitize_text_field( $_POST[ 'cff_feed_width' ] );
                (isset($_POST[ 'cff_feed_width_resp' ]) ) ? $cff_feed_width_resp = sanitize_text_field( $_POST[ 'cff_feed_width_resp' ] ) : $cff_feed_width_resp = '';
                if (isset($_POST[ 'cff_feed_height' ]) ) $cff_feed_height = sanitize_text_field( $_POST[ 'cff_feed_height' ] );
                if (isset($_POST[ 'cff_feed_padding' ]) ) $cff_feed_padding = sanitize_text_field( $_POST[ 'cff_feed_padding' ] );
                if (isset($_POST[ 'cff_bg_color' ]) ) $cff_bg_color = sanitize_text_field( $_POST[ 'cff_bg_color' ] );
                if (isset($_POST[ 'cff_class' ]) ) $cff_class = sanitize_text_field( $_POST[ 'cff_class' ] );
                (isset($_POST[ 'cff_show_header' ])) ? $cff_show_header = sanitize_text_field( $_POST[ 'cff_show_header' ] ) : $cff_show_header = '';

                //Post types
                if (isset($_POST[ 'cff_show_links_type' ]) ) $cff_show_links_type = sanitize_text_field( $_POST[ 'cff_show_links_type' ] );
                if (isset($_POST[ 'cff_show_event_type' ]) ) $cff_show_event_type = sanitize_text_field( $_POST[ 'cff_show_event_type' ] );
                if (isset($_POST[ 'cff_show_video_type' ]) ) $cff_show_video_type = sanitize_text_field( $_POST[ 'cff_show_video_type' ] );
                if (isset($_POST[ 'cff_show_photos_type' ]) ) $cff_show_photos_type = sanitize_text_field( $_POST[ 'cff_show_photos_type' ] );
                if (isset($_POST[ 'cff_show_status_type' ]) ) $cff_show_status_type = sanitize_text_field( $_POST[ 'cff_show_status_type' ] );
                //General
                $options[ 'cff_feed_width' ] = $cff_feed_width;
                $options[ 'cff_feed_width_resp' ] = $cff_feed_width_resp;
                $options[ 'cff_feed_height' ] = $cff_feed_height;
                $options[ 'cff_feed_padding' ] = $cff_feed_padding;
                $options[ 'cff_bg_color' ] = $cff_bg_color;
                $options[ 'cff_class' ] = $cff_class;
                $options[ 'cff_show_header' ] = $cff_show_header;

                //Post types
                $options[ 'cff_show_links_type' ] = $cff_show_links_type;
                $options[ 'cff_show_event_type' ] = $cff_show_event_type;
                $options[ 'cff_show_video_type' ] = $cff_show_video_type;
                $options[ 'cff_show_photos_type' ] = $cff_show_photos_type;
                $options[ 'cff_show_status_type' ] = $cff_show_status_type;
            }
            //Update the Post Layout options
            if( isset($_POST[ $style_post_layout_hidden_field_name ]) && $_POST[ $style_post_layout_hidden_field_name ] == 'Y' ) {
                //Layout
                if (isset($_POST[ 'cff_preset_layout' ]) ) $cff_preset_layout = sanitize_text_field( $_POST[ 'cff_preset_layout' ] );
                //Include
                (isset($_POST[ 'cff_show_author' ]) ) ? $cff_show_author = sanitize_text_field( $_POST[ 'cff_show_author' ] ) : $cff_show_author = '';
                (isset($_POST[ 'cff_show_text' ]) ) ? $cff_show_text = sanitize_text_field( $_POST[ 'cff_show_text' ] ) : $cff_show_text = '';
                (isset($_POST[ 'cff_show_desc' ]) ) ? $cff_show_desc = sanitize_text_field( $_POST[ 'cff_show_desc' ] ) : $cff_show_desc = '';
                (isset($_POST[ 'cff_show_shared_links' ]) ) ? $cff_show_shared_links = sanitize_text_field( $_POST[ 'cff_show_shared_links' ] ) : $cff_show_shared_links = '';
                (isset($_POST[ 'cff_show_date' ]) ) ? $cff_show_date = sanitize_text_field( $_POST[ 'cff_show_date' ] ) : $cff_show_date = '';
                (isset($_POST[ 'cff_show_media' ]) ) ? $cff_show_media = sanitize_text_field( $_POST[ 'cff_show_media' ] ) : $cff_show_media = '';
                (isset($_POST[ 'cff_show_media_link' ]) ) ? $cff_show_media_link = sanitize_text_field( $_POST[ 'cff_show_media_link' ] ) : $cff_show_media_link = '';
                (isset($_POST[ 'cff_show_event_title' ]) ) ? $cff_show_event_title = sanitize_text_field( $_POST[ 'cff_show_event_title' ] ) : $cff_show_event_title = '';
                (isset($_POST[ 'cff_show_event_details' ]) ) ? $cff_show_event_details = sanitize_text_field( $_POST[ 'cff_show_event_details' ] ) : $cff_show_event_details = '';
                (isset($_POST[ 'cff_show_meta' ]) ) ? $cff_show_meta = sanitize_text_field( $_POST[ 'cff_show_meta' ] ) : $cff_show_meta = '';
                (isset($_POST[ 'cff_show_link' ]) ) ? $cff_show_link = sanitize_text_field( $_POST[ 'cff_show_link' ] ) : $cff_show_link = '';
                //Post Style
                (isset($_POST[ 'cff_post_bg_color' ]) ) ? $cff_post_bg_color = sanitize_text_field( $_POST[ 'cff_post_bg_color' ] ) : $cff_post_bg_color = '';
                (isset($_POST[ 'cff_post_rounded' ]) ) ? $cff_post_rounded = sanitize_text_field( $_POST[ 'cff_post_rounded' ] ) : $cff_post_rounded = '';
                if (isset($_POST[ 'cff_sep_color' ])) $cff_sep_color = sanitize_text_field( $_POST[ 'cff_sep_color' ] );
                if (isset($_POST[ 'cff_sep_size' ])) $cff_sep_size = sanitize_text_field( $_POST[ 'cff_sep_size' ] );

                //Layout
                $options[ 'cff_preset_layout' ] = $cff_preset_layout;
                //Include
                $options[ 'cff_show_author' ] = $cff_show_author;
                $options[ 'cff_show_text' ] = $cff_show_text;
                $options[ 'cff_show_desc' ] = $cff_show_desc;
                $options[ 'cff_show_shared_links' ] = $cff_show_shared_links;
                $options[ 'cff_show_date' ] = $cff_show_date;
                $options[ 'cff_show_media' ] = $cff_show_media;
                $options[ 'cff_show_media_link' ] = $cff_show_media_link;
                $options[ 'cff_show_event_title' ] = $cff_show_event_title;
                $options[ 'cff_show_event_details' ] = $cff_show_event_details;
                $options[ 'cff_show_meta' ] = $cff_show_meta;
                $options[ 'cff_show_link' ] = $cff_show_link;
                //Post Style
                $options[ 'cff_post_bg_color' ] = $cff_post_bg_color;
                $options[ 'cff_post_rounded' ] = $cff_post_rounded;
                $options[ 'cff_sep_color' ] = $cff_sep_color;
                $options[ 'cff_sep_size' ] = $cff_sep_size;

            }
            //Update the Typography options
            if( isset($_POST[ $style_typography_hidden_field_name ]) && $_POST[ $style_typography_hidden_field_name ] == 'Y' ) {
                //Character limits
                if (isset($_POST[ 'cff_title_length' ]) ) $cff_title_length_val = sanitize_text_field( $_POST[ $cff_title_length ] );
                if (isset($_POST[ 'cff_body_length' ]) ) $cff_body_length_val = sanitize_text_field( $_POST[ $cff_body_length ] );

                //Page Header
                (isset($_POST[ 'cff_header_outside' ])) ? $cff_header_outside = sanitize_text_field( $_POST[ 'cff_header_outside' ] ) : $cff_header_outside = '';
                if (isset($_POST[ 'cff_header_text' ])) $cff_header_text = sanitize_text_field( $_POST[ 'cff_header_text' ] );
                if (isset($_POST[ 'cff_header_bg_color' ])) $cff_header_bg_color = sanitize_text_field( $_POST[ 'cff_header_bg_color' ] );
                if (isset($_POST[ 'cff_header_padding' ])) $cff_header_padding = sanitize_text_field( $_POST[ 'cff_header_padding' ] );
                if (isset($_POST[ 'cff_header_text_size' ])) $cff_header_text_size = sanitize_text_field( $_POST[ 'cff_header_text_size' ] );
                if (isset($_POST[ 'cff_header_text_weight' ])) $cff_header_text_weight = sanitize_text_field( $_POST[ 'cff_header_text_weight' ] );
                if (isset($_POST[ 'cff_header_text_color' ])) $cff_header_text_color = sanitize_text_field( $_POST[ 'cff_header_text_color' ] );
                if (isset($_POST[ 'cff_header_icon' ])) $cff_header_icon = sanitize_text_field( $_POST[ 'cff_header_icon' ] );
                if (isset($_POST[ 'cff_header_icon_color' ])) $cff_header_icon_color = sanitize_text_field( $_POST[ 'cff_header_icon_color' ] );
                if (isset($_POST[ 'cff_header_icon_size' ])) $cff_header_icon_size = sanitize_text_field( $_POST[ 'cff_header_icon_size' ] );

                //Author
                if (isset($_POST[ 'cff_author_size' ])) $cff_author_size = sanitize_text_field( $_POST[ 'cff_author_size' ] );
                if (isset($_POST[ 'cff_author_color' ])) $cff_author_color = sanitize_text_field( $_POST[ 'cff_author_color' ] );

                //Typography
                if (isset($_POST[ 'cff_title_format' ]) ) $cff_title_format = sanitize_text_field( $_POST[ 'cff_title_format' ] );
                if (isset($_POST[ 'cff_title_size' ]) ) $cff_title_size = sanitize_text_field( $_POST[ 'cff_title_size' ] );
                if (isset($_POST[ 'cff_title_weight' ]) ) $cff_title_weight = sanitize_text_field( $_POST[ 'cff_title_weight' ] );
                if (isset($_POST[ 'cff_title_color' ]) ) $cff_title_color = sanitize_text_field( $_POST[ 'cff_title_color' ] );
                if (isset($_POST[ 'cff_posttext_link_color' ]) ) $cff_posttext_link_color = sanitize_text_field( $_POST[ 'cff_posttext_link_color' ] );

                (isset($_POST[ 'cff_title_link' ]) ) ? $cff_title_link = sanitize_text_field( $_POST[ 'cff_title_link' ] ) : $cff_title_link = '';
                (isset($_POST[ 'cff_post_tags' ]) ) ? $cff_post_tags = sanitize_text_field( $_POST[ 'cff_post_tags' ] ) : $cff_post_tags = '';
                (isset($_POST[ 'cff_link_hashtags' ]) ) ? $cff_link_hashtags = sanitize_text_field( $_POST[ 'cff_link_hashtags' ] ) : $cff_link_hashtags = '';

                $cff_body_size = $_POST[ 'cff_body_size' ];
                if (isset($_POST[ 'cff_body_weight' ]) ) $cff_body_weight = sanitize_text_field( $_POST[ 'cff_body_weight' ] );
                if (isset($_POST[ 'cff_body_color' ]) ) $cff_body_color = sanitize_text_field( $_POST[ 'cff_body_color' ] );
                if (isset($_POST[ 'cff_link_title_format' ]) ) $cff_link_title_format = sanitize_text_field( $_POST[ 'cff_link_title_format' ] );
                if (isset($_POST[ 'cff_link_title_size' ]) ) $cff_link_title_size = sanitize_text_field( $_POST[ 'cff_link_title_size' ] );
                if (isset($_POST[ 'cff_link_title_color' ]) ) $cff_link_title_color = sanitize_text_field( $_POST[ 'cff_link_title_color' ] );
                if (isset($_POST[ 'cff_link_url_color' ]) ) $cff_link_url_color = sanitize_text_field( $_POST[ 'cff_link_url_color' ] );
                if (isset($_POST[ 'cff_link_bg_color' ]) ) $cff_link_bg_color = sanitize_text_field( $_POST[ 'cff_link_bg_color' ] );
                if (isset($_POST[ 'cff_link_border_color' ]) ) $cff_link_border_color = sanitize_text_field( $_POST[ 'cff_link_border_color' ] );
                (isset($_POST[ 'cff_disable_link_box' ]) ) ? $cff_disable_link_box = sanitize_text_field( $_POST[ 'cff_disable_link_box' ] ) : $cff_disable_link_box = '';


                //Event title
                if (isset($_POST[ 'cff_event_title_format' ]) ) $cff_event_title_format = sanitize_text_field( $_POST[ 'cff_event_title_format' ] );
                if (isset($_POST[ 'cff_event_title_size' ]) ) $cff_event_title_size = sanitize_text_field( $_POST[ 'cff_event_title_size' ] );
                if (isset($_POST[ 'cff_event_title_weight' ]) ) $cff_event_title_weight = sanitize_text_field( $_POST[ 'cff_event_title_weight' ] );
                if (isset($_POST[ 'cff_event_title_color' ]) ) $cff_event_title_color = sanitize_text_field( $_POST[ 'cff_event_title_color' ] );
                (isset($_POST[ 'cff_event_title_link' ]) ) ? $cff_event_title_link = sanitize_text_field( $_POST[ 'cff_event_title_link' ] ) : $cff_event_title_link = '';
                //Event date
                if (isset($_POST[ 'cff_event_date_size' ]) ) $cff_event_date_size = sanitize_text_field( $_POST[ 'cff_event_date_size' ] );
                if (isset($_POST[ 'cff_event_date_weight' ]) ) $cff_event_date_weight = sanitize_text_field( $_POST[ 'cff_event_date_weight' ] );
                if (isset($_POST[ 'cff_event_date_color' ]) ) $cff_event_date_color = sanitize_text_field( $_POST[ 'cff_event_date_color' ] );
                if (isset($_POST[ 'cff_event_date_position' ]) ) $cff_event_date_position = sanitize_text_field( $_POST[ 'cff_event_date_position' ] );
                if (isset($_POST[ 'cff_event_date_formatting' ]) ) $cff_event_date_formatting = sanitize_text_field( $_POST[ 'cff_event_date_formatting' ] );
                if (isset($_POST[ 'cff_event_date_custom' ]) ) $cff_event_date_custom = sanitize_text_field( $_POST[ 'cff_event_date_custom' ] );
                //Event details
                if (isset($_POST[ 'cff_event_details_size' ]) ) $cff_event_details_size = sanitize_text_field( $_POST[ 'cff_event_details_size' ] );
                if (isset($_POST[ 'cff_event_details_weight' ]) ) $cff_event_details_weight = sanitize_text_field( $_POST[ 'cff_event_details_weight' ] );
                if (isset($_POST[ 'cff_event_details_color' ]) ) $cff_event_details_color = sanitize_text_field( $_POST[ 'cff_event_details_color' ] );
                if (isset($_POST[ 'cff_event_link_color' ]) ) $cff_event_link_color = sanitize_text_field( $_POST[ 'cff_event_link_color' ] );
                //Date
                if (isset($_POST[ 'cff_date_position' ]) ) $cff_date_position = sanitize_text_field( $_POST[ 'cff_date_position' ] );
                if (isset($_POST[ 'cff_date_size' ]) ) $cff_date_size = sanitize_text_field( $_POST[ 'cff_date_size' ] );
                if (isset($_POST[ 'cff_date_weight' ]) ) $cff_date_weight = sanitize_text_field( $_POST[ 'cff_date_weight' ] );
                if (isset($_POST[ 'cff_date_color' ]) ) $cff_date_color = sanitize_text_field( $_POST[ 'cff_date_color' ] );
                if (isset($_POST[ 'cff_date_formatting' ]) ) $cff_date_formatting = sanitize_text_field( $_POST[ 'cff_date_formatting' ] );
                if (isset($_POST[ 'cff_date_custom' ]) ) $cff_date_custom = sanitize_text_field( $_POST[ 'cff_date_custom' ] );
                if (isset($_POST[ 'cff_date_before' ]) ) $cff_date_before = sanitize_text_field( $_POST[ 'cff_date_before' ] );
                if (isset($_POST[ 'cff_date_after' ]) ) $cff_date_after = sanitize_text_field( $_POST[ 'cff_date_after' ] );
                if (isset($_POST[ 'cff_timezone' ]) ) $cff_timezone = sanitize_text_field( $_POST[ 'cff_timezone' ] );

                //Date translate
                if (isset($_POST[ 'cff_translate_second' ]) ) $cff_translate_second = sanitize_text_field( $_POST[ 'cff_translate_second' ] );
                if (isset($_POST[ 'cff_translate_seconds' ]) ) $cff_translate_seconds = sanitize_text_field( $_POST[ 'cff_translate_seconds' ] );
                if (isset($_POST[ 'cff_translate_minute' ]) ) $cff_translate_minute = sanitize_text_field( $_POST[ 'cff_translate_minute' ] );
                if (isset($_POST[ 'cff_translate_minutes' ]) ) $cff_translate_minutes = sanitize_text_field( $_POST[ 'cff_translate_minutes' ] );
                if (isset($_POST[ 'cff_translate_hour' ]) ) $cff_translate_hour = sanitize_text_field( $_POST[ 'cff_translate_hour' ] );
                if (isset($_POST[ 'cff_translate_hours' ]) ) $cff_translate_hours = sanitize_text_field( $_POST[ 'cff_translate_hours' ] );
                if (isset($_POST[ 'cff_translate_day' ]) ) $cff_translate_day = sanitize_text_field( $_POST[ 'cff_translate_day' ] );
                if (isset($_POST[ 'cff_translate_days' ]) ) $cff_translate_days = sanitize_text_field( $_POST[ 'cff_translate_days' ] );
                if (isset($_POST[ 'cff_translate_week' ]) ) $cff_translate_week = sanitize_text_field( $_POST[ 'cff_translate_week' ] );
                if (isset($_POST[ 'cff_translate_weeks' ]) ) $cff_translate_weeks = sanitize_text_field( $_POST[ 'cff_translate_weeks' ] );
                if (isset($_POST[ 'cff_translate_month' ]) ) $cff_translate_month = sanitize_text_field( $_POST[ 'cff_translate_month' ] );
                if (isset($_POST[ 'cff_translate_months' ]) ) $cff_translate_months = sanitize_text_field( $_POST[ 'cff_translate_months' ] );
                if (isset($_POST[ 'cff_translate_year' ]) ) $cff_translate_year = sanitize_text_field( $_POST[ 'cff_translate_year' ] );
                if (isset($_POST[ 'cff_translate_years' ]) ) $cff_translate_years = sanitize_text_field( $_POST[ 'cff_translate_years' ] );
                if (isset($_POST[ 'cff_translate_ago' ]) ) $cff_translate_ago = sanitize_text_field( $_POST[ 'cff_translate_ago' ] );

                //View on Facebook link
                if (isset($_POST[ 'cff_link_size' ]) ) $cff_link_size = sanitize_text_field( $_POST[ 'cff_link_size' ] );
                if (isset($_POST[ 'cff_link_weight' ]) ) $cff_link_weight = sanitize_text_field( $_POST[ 'cff_link_weight' ] );
                if (isset($_POST[ 'cff_link_color' ]) ) $cff_link_color = sanitize_text_field( $_POST[ 'cff_link_color' ] );
                if (isset($_POST[ 'cff_facebook_link_text' ]) ) $cff_facebook_link_text = sanitize_text_field( $_POST[ 'cff_facebook_link_text' ] );
                if (isset($_POST[ 'cff_facebook_share_text' ]) ) $cff_facebook_share_text = sanitize_text_field( $_POST[ 'cff_facebook_share_text' ] );
                (isset($_POST[ 'cff_show_facebook_link' ]) ) ? $cff_show_facebook_link = sanitize_text_field( $_POST[ 'cff_show_facebook_link' ] ) : $cff_show_facebook_link = '';
                (isset($_POST[ 'cff_show_facebook_share' ]) ) ? $cff_show_facebook_share = sanitize_text_field( $_POST[ 'cff_show_facebook_share' ] ) : $cff_show_facebook_share = '';
                if (isset($_POST[ 'cff_view_link_text' ]) ) $cff_view_link_text = sanitize_text_field( $_POST[ 'cff_view_link_text' ] );
                if (isset($_POST[ 'cff_link_to_timeline' ]) ) $cff_link_to_timeline = sanitize_text_field( $_POST[ 'cff_link_to_timeline' ] );

                //Character limits
                update_option( $cff_title_length, $cff_title_length_val );
                update_option( $cff_body_length, $cff_body_length_val );
                //Page Header
                $options[ 'cff_header_outside' ] = $cff_header_outside;
                $options[ 'cff_header_text' ] = $cff_header_text;
                $options[ 'cff_header_bg_color' ] = $cff_header_bg_color;
                $options[ 'cff_header_padding' ] = $cff_header_padding;
                $options[ 'cff_header_text_size' ] = $cff_header_text_size;
                $options[ 'cff_header_text_weight' ] = $cff_header_text_weight;
                $options[ 'cff_header_text_color' ] = $cff_header_text_color;
                $options[ 'cff_header_icon' ] = $cff_header_icon;
                $options[ 'cff_header_icon_color' ] = $cff_header_icon_color;
                $options[ 'cff_header_icon_size' ] = $cff_header_icon_size;
                //Author
                $options[ 'cff_author_size' ] = $cff_author_size;
                $options[ 'cff_author_color' ] = $cff_author_color;
                //Typography
                $options[ 'cff_title_format' ] = $cff_title_format;
                $options[ 'cff_title_size' ] = $cff_title_size;
                $options[ 'cff_title_weight' ] = $cff_title_weight;
                $options[ 'cff_title_color' ] = $cff_title_color;
                $options[ 'cff_posttext_link_color' ] = $cff_posttext_link_color;
                $options[ 'cff_title_link' ] = $cff_title_link;
                $options[ 'cff_post_tags' ] = $cff_post_tags;
                $options[ 'cff_link_hashtags' ] = $cff_link_hashtags;
                $options[ 'cff_body_size' ] = $cff_body_size;
                $options[ 'cff_body_weight' ] = $cff_body_weight;
                $options[ 'cff_body_color' ] = $cff_body_color;
                $options[ 'cff_link_title_format' ] = $cff_link_title_format;
                $options[ 'cff_link_title_size' ] = $cff_link_title_size;
                $options[ 'cff_link_title_color' ] = $cff_link_title_color;
                $options[ 'cff_link_url_color' ] = $cff_link_url_color;
                $options[ 'cff_link_bg_color' ] = $cff_link_bg_color;
                $options[ 'cff_link_border_color' ] = $cff_link_border_color;
                $options[ 'cff_disable_link_box' ] = $cff_disable_link_box;

                //Event title
                $options[ 'cff_event_title_format' ] = $cff_event_title_format;
                $options[ 'cff_event_title_size' ] = $cff_event_title_size;
                $options[ 'cff_event_title_weight' ] = $cff_event_title_weight;
                $options[ 'cff_event_title_color' ] = $cff_event_title_color;
                $options[ 'cff_event_title_link' ] = $cff_event_title_link;
                //Event date
                $options[ 'cff_event_date_size' ] = $cff_event_date_size;
                $options[ 'cff_event_date_weight' ] = $cff_event_date_weight;
                $options[ 'cff_event_date_color' ] = $cff_event_date_color;
                $options[ 'cff_event_date_position' ] = $cff_event_date_position;
                $options[ 'cff_event_date_formatting' ] = $cff_event_date_formatting;
                $options[ 'cff_event_date_custom' ] = $cff_event_date_custom;
                //Event details
                $options[ 'cff_event_details_size' ] = $cff_event_details_size;
                $options[ 'cff_event_details_weight' ] = $cff_event_details_weight;
                $options[ 'cff_event_details_color' ] = $cff_event_details_color;
                $options[ 'cff_event_link_color' ] = $cff_event_link_color;
                //Date
                $options[ 'cff_date_position' ] = $cff_date_position;
                $options[ 'cff_date_size' ] = $cff_date_size;
                $options[ 'cff_date_weight' ] = $cff_date_weight;
                $options[ 'cff_date_color' ] = $cff_date_color;
                $options[ 'cff_date_formatting' ] = $cff_date_formatting;
                $options[ 'cff_date_custom' ] = $cff_date_custom;
                $options[ 'cff_date_before' ] = $cff_date_before;
                $options[ 'cff_date_after' ] = $cff_date_after;
                $options[ 'cff_timezone' ] = $cff_timezone;

                //Date translate
                $options[ 'cff_translate_second' ] = $cff_translate_second;
                $options[ 'cff_translate_seconds' ] = $cff_translate_seconds;
                $options[ 'cff_translate_minute' ] = $cff_translate_minute;
                $options[ 'cff_translate_minutes' ] = $cff_translate_minutes;
                $options[ 'cff_translate_hour' ] = $cff_translate_hour;
                $options[ 'cff_translate_hours' ] = $cff_translate_hours;
                $options[ 'cff_translate_day' ] = $cff_translate_day;
                $options[ 'cff_translate_days' ] = $cff_translate_days;
                $options[ 'cff_translate_week' ] = $cff_translate_week;
                $options[ 'cff_translate_weeks' ] = $cff_translate_weeks;
                $options[ 'cff_translate_month' ] = $cff_translate_month;
                $options[ 'cff_translate_months' ] = $cff_translate_months;
                $options[ 'cff_translate_year' ] = $cff_translate_year;
                $options[ 'cff_translate_years' ] = $cff_translate_years;
                $options[ 'cff_translate_ago' ] = $cff_translate_ago;

                //View on Facebook link
                $options[ 'cff_link_size' ] = $cff_link_size;
                $options[ 'cff_link_weight' ] = $cff_link_weight;
                $options[ 'cff_link_color' ] = $cff_link_color;
                $options[ 'cff_facebook_link_text' ] = $cff_facebook_link_text;
                $options[ 'cff_facebook_share_text' ] = $cff_facebook_share_text;
                $options[ 'cff_show_facebook_link' ] = $cff_show_facebook_link;
                $options[ 'cff_show_facebook_share' ] = $cff_show_facebook_share;
                $options[ 'cff_view_link_text' ] = $cff_view_link_text;
                $options[ 'cff_link_to_timeline' ] = $cff_link_to_timeline;
            }
            //Update the Misc options
            if( isset($_POST[ $style_misc_hidden_field_name ]) && $_POST[ $style_misc_hidden_field_name ] == 'Y' ) {
                //Meta
                if (isset($_POST[ 'cff_icon_style' ])) $cff_icon_style = sanitize_text_field( $_POST[ 'cff_icon_style' ] );
                if (isset($_POST[ 'cff_meta_text_color' ])) $cff_meta_text_color = sanitize_text_field( $_POST[ 'cff_meta_text_color' ] );
                if (isset($_POST[ 'cff_meta_bg_color' ])) $cff_meta_bg_color = sanitize_text_field( $_POST[ 'cff_meta_bg_color' ] );
                if (isset($_POST[ 'cff_nocomments_text' ])) $cff_nocomments_text = sanitize_text_field( $_POST[ 'cff_nocomments_text' ] );
                if (isset($_POST[ 'cff_hide_comments' ])) $cff_hide_comments = sanitize_text_field( $_POST[ 'cff_hide_comments' ] );
                //Custom CSS
                if (isset($_POST[ 'cff_custom_css' ])) $cff_custom_css = $_POST[ 'cff_custom_css' ];
                if (isset($_POST[ 'cff_custom_js' ])) $cff_custom_js = $_POST[ 'cff_custom_js' ];
                //Misc
                (isset($_POST[ 'cff_show_like_box' ])) ? $cff_show_like_box = sanitize_text_field( $_POST[ 'cff_show_like_box' ] ) : $cff_show_like_box = '';
                if (isset($_POST[ 'cff_like_box_position' ])) $cff_like_box_position = sanitize_text_field( $_POST[ 'cff_like_box_position' ] );
                (isset($_POST[ 'cff_like_box_outside' ])) ? $cff_like_box_outside = sanitize_text_field( $_POST[ 'cff_like_box_outside' ] ) : $cff_like_box_outside = '';
                if (isset($_POST[ 'cff_likebox_bg_color' ])) $cff_likebox_bg_color = sanitize_text_field( $_POST[ 'cff_likebox_bg_color' ] );
                if (isset($_POST[ 'cff_like_box_text_color' ])) $cff_like_box_text_color = sanitize_text_field( $_POST[ 'cff_like_box_text_color' ] );

                if (isset($_POST[ 'cff_likebox_width' ])) $cff_likebox_width = sanitize_text_field( $_POST[ 'cff_likebox_width' ] );
                if (isset($_POST[ 'cff_likebox_height' ])) $cff_likebox_height = sanitize_text_field( $_POST[ 'cff_likebox_height' ] );
                (isset($_POST[ 'cff_like_box_faces' ])) ? $cff_like_box_faces = sanitize_text_field( $_POST[ 'cff_like_box_faces' ] ) : $cff_like_box_faces = '';
                (isset($_POST[ 'cff_like_box_border' ])) ? $cff_like_box_border = sanitize_text_field( $_POST[ 'cff_like_box_border' ] ) : $cff_like_box_border = '';
                (isset($_POST[ 'cff_like_box_cover' ])) ? $cff_like_box_cover = sanitize_text_field( $_POST[ 'cff_like_box_cover' ] ) : $cff_like_box_cover = '';
                (isset($_POST[ 'cff_like_box_small_header' ])) ? $cff_like_box_small_header = sanitize_text_field( $_POST[ 'cff_like_box_small_header' ] ) : $cff_like_box_small_header = '';
                (isset($_POST[ 'cff_like_box_hide_cta' ])) ? $cff_like_box_hide_cta = sanitize_text_field( $_POST[ 'cff_like_box_hide_cta' ] ) : $cff_like_box_hide_cta = '';


                if (isset($_POST[ 'cff_video_height' ])) $cff_video_height = sanitize_text_field( $_POST[ 'cff_video_height' ] );
                if (isset($_POST[ 'cff_video_action' ])) $cff_video_action = sanitize_text_field( $_POST[ 'cff_video_action' ] );
                if (isset($_POST[ 'cff_open_links' ])) $cff_open_links = sanitize_text_field( $_POST[ 'cff_open_links' ] );

                (isset($_POST[ $cff_ajax ])) ? $cff_ajax_val = sanitize_text_field( $_POST[ 'cff_ajax' ] ) : $cff_ajax_val = '';
                if (isset($_POST[ 'cff_app_id' ])) $cff_app_id = sanitize_text_field( $_POST[ 'cff_app_id' ] );
                (isset($_POST[ 'cff_show_credit' ])) ? $cff_show_credit = sanitize_text_field( $_POST[ 'cff_show_credit' ] ) : $cff_show_credit = '';
                (isset($_POST[ 'cff_font_source' ])) ? $cff_font_source = sanitize_text_field( $_POST[ 'cff_font_source' ] ) : $cff_font_source = '';
                (isset($_POST[ $cff_preserve_settings ])) ? $cff_preserve_settings_val = sanitize_text_field( $_POST[ 'cff_preserve_settings' ] ) : $cff_preserve_settings_val = '';
                if (isset($_POST[ 'cff_cron' ])) $cff_cron = sanitize_text_field( $_POST[ 'cff_cron' ] );
                if (isset($_POST[ 'cff_request_method' ])) $cff_request_method = sanitize_text_field( $_POST[ 'cff_request_method' ] );
                (isset($_POST[ 'cff_disable_styles' ])) ? $cff_disable_styles = sanitize_text_field( $_POST[ 'cff_disable_styles' ] ) : $cff_disable_styles = '';

                //Meta
                $options[ 'cff_icon_style' ] = $cff_icon_style;
                $options[ 'cff_meta_text_color' ] = $cff_meta_text_color;
                $options[ 'cff_meta_bg_color' ] = $cff_meta_bg_color;
                $options[ 'cff_nocomments_text' ] = $cff_nocomments_text;
                $options[ 'cff_hide_comments' ] = $cff_hide_comments;
                //Custom CSS
                $options[ 'cff_custom_css' ] = $cff_custom_css;
                $options[ 'cff_custom_js' ] = $cff_custom_js;
                //Misc
                $options[ 'cff_show_like_box' ] = $cff_show_like_box;
                $options[ 'cff_like_box_position' ] = $cff_like_box_position;
                $options[ 'cff_like_box_outside' ] = $cff_like_box_outside;
                $options[ 'cff_likebox_bg_color' ] = $cff_likebox_bg_color;
                $options[ 'cff_like_box_text_color' ] = $cff_like_box_text_color;

                $options[ 'cff_likebox_width' ] = $cff_likebox_width;
                $options[ 'cff_likebox_height' ] = $cff_likebox_height;
                $options[ 'cff_like_box_faces' ] = $cff_like_box_faces;
                $options[ 'cff_like_box_border' ] = $cff_like_box_border;
                $options[ 'cff_like_box_cover' ] = $cff_like_box_cover;
                $options[ 'cff_like_box_small_header' ] = $cff_like_box_small_header;
                $options[ 'cff_like_box_hide_cta' ] = $cff_like_box_hide_cta;


                $options[ 'cff_video_height' ] = $cff_video_height;
                $options[ 'cff_video_action' ] = $cff_video_action;
                $options[ 'cff_open_links' ] = $cff_open_links;

                update_option( $cff_ajax, $cff_ajax_val );
                $options[ 'cff_app_id' ] = $cff_app_id;
                $options[ 'cff_show_credit' ] = $cff_show_credit;
                $options[ 'cff_font_source' ] = $cff_font_source;
                update_option( $cff_preserve_settings, $cff_preserve_settings_val );

                $options[ 'cff_cron' ] = $cff_cron;
                $options[ 'cff_request_method' ] = $cff_request_method;
                $options[ 'cff_disable_styles' ] = $cff_disable_styles;

                if( $cff_cron == 'no' ) wp_clear_scheduled_hook('cff_cron_job');

                //Run cron when Misc settings are saved
                if( $cff_cron == 'yes' ){
                    //Clear the existing cron event
                    wp_clear_scheduled_hook('cff_cron_job');

                    $cff_cache_time = get_option( 'cff_cache_time' );
                    $cff_cache_time_unit = get_option( 'cff_cache_time_unit' );

                    //Set the event schedule based on what the caching time is set to
                    $cff_cron_schedule = 'hourly';
                    if( $cff_cache_time_unit == 'hours' && $cff_cache_time > 5 ) $cff_cron_schedule = 'twicedaily';
                    if( $cff_cache_time_unit == 'days' ) $cff_cron_schedule = 'daily';

                    wp_schedule_event(time(), $cff_cron_schedule, 'cff_cron_job');
                }

            }
            //Update the Custom Text / Translate options
            if( isset($_POST[ $style_custom_text_hidden_field_name ]) && $_POST[ $style_custom_text_hidden_field_name ] == 'Y' ) {

                //Translate
                if (isset($_POST[ 'cff_see_more_text' ])) $cff_see_more_text = sanitize_text_field( $_POST[ 'cff_see_more_text' ] );
                if (isset($_POST[ 'cff_see_less_text' ])) $cff_see_less_text = sanitize_text_field( $_POST[ 'cff_see_less_text' ] );
                if (isset($_POST[ 'cff_facebook_link_text' ])) $cff_facebook_link_text = sanitize_text_field( $_POST[ 'cff_facebook_link_text' ] );
                if (isset($_POST[ 'cff_facebook_share_text' ])) $cff_facebook_share_text = sanitize_text_field( $_POST[ 'cff_facebook_share_text' ] );

                //Social translate
                if (isset($_POST[ 'cff_translate_photos_text' ])) $cff_translate_photos_text = sanitize_text_field( $_POST[ 'cff_translate_photos_text' ] );
                if (isset($_POST[ 'cff_translate_photo_text' ])) $cff_translate_photo_text = sanitize_text_field( $_POST[ 'cff_translate_photo_text' ] );
                if (isset($_POST[ 'cff_translate_video_text' ])) $cff_translate_video_text = sanitize_text_field( $_POST[ 'cff_translate_video_text' ] );

                //Date translate
                if (isset($_POST[ 'cff_translate_second' ])) $cff_translate_second = sanitize_text_field( $_POST[ 'cff_translate_second' ] );
                if (isset($_POST[ 'cff_translate_seconds' ])) $cff_translate_seconds = sanitize_text_field( $_POST[ 'cff_translate_seconds' ] );
                if (isset($_POST[ 'cff_translate_minute' ])) $cff_translate_minute = sanitize_text_field( $_POST[ 'cff_translate_minute' ] );
                if (isset($_POST[ 'cff_translate_minutes' ])) $cff_translate_minutes = sanitize_text_field( $_POST[ 'cff_translate_minutes' ] );
                if (isset($_POST[ 'cff_translate_hour' ])) $cff_translate_hour = sanitize_text_field( $_POST[ 'cff_translate_hour' ] );
                if (isset($_POST[ 'cff_translate_hours' ])) $cff_translate_hours = sanitize_text_field( $_POST[ 'cff_translate_hours' ] );
                if (isset($_POST[ 'cff_translate_day' ])) $cff_translate_day = sanitize_text_field( $_POST[ 'cff_translate_day' ] );
                if (isset($_POST[ 'cff_translate_days' ])) $cff_translate_days = sanitize_text_field( $_POST[ 'cff_translate_days' ] );
                if (isset($_POST[ 'cff_translate_week' ])) $cff_translate_week = sanitize_text_field( $_POST[ 'cff_translate_week' ] );
                if (isset($_POST[ 'cff_translate_weeks' ])) $cff_translate_weeks = sanitize_text_field( $_POST[ 'cff_translate_weeks' ] );
                if (isset($_POST[ 'cff_translate_month' ])) $cff_translate_month = sanitize_text_field( $_POST[ 'cff_translate_month' ] );
                if (isset($_POST[ 'cff_translate_months' ])) $cff_translate_months = sanitize_text_field( $_POST[ 'cff_translate_months' ] );
                if (isset($_POST[ 'cff_translate_year' ])) $cff_translate_year = sanitize_text_field( $_POST[ 'cff_translate_year' ] );
                if (isset($_POST[ 'cff_translate_years' ])) $cff_translate_years = sanitize_text_field( $_POST[ 'cff_translate_years' ] );
                if (isset($_POST[ 'cff_translate_ago' ])) $cff_translate_ago = sanitize_text_field( $_POST[ 'cff_translate_ago' ] );

                //Translate
                $options[ 'cff_see_more_text' ] = $cff_see_more_text;
                $options[ 'cff_see_less_text' ] = $cff_see_less_text;
                $options[ 'cff_facebook_link_text' ] = $cff_facebook_link_text;
                $options[ 'cff_facebook_share_text' ] = $cff_facebook_share_text;

                //Social translate
                $options[ 'cff_translate_photos_text' ] = $cff_translate_photos_text;
                $options[ 'cff_translate_photo_text' ] = $cff_translate_photo_text;
                $options[ 'cff_translate_video_text' ] = $cff_translate_video_text;

                //Date translate
                $options[ 'cff_translate_second' ] = $cff_translate_second;
                $options[ 'cff_translate_seconds' ] = $cff_translate_seconds;
                $options[ 'cff_translate_minute' ] = $cff_translate_minute;
                $options[ 'cff_translate_minutes' ] = $cff_translate_minutes;
                $options[ 'cff_translate_hour' ] = $cff_translate_hour;
                $options[ 'cff_translate_hours' ] = $cff_translate_hours;
                $options[ 'cff_translate_day' ] = $cff_translate_day;
                $options[ 'cff_translate_days' ] = $cff_translate_days;
                $options[ 'cff_translate_week' ] = $cff_translate_week;
                $options[ 'cff_translate_weeks' ] = $cff_translate_weeks;
                $options[ 'cff_translate_month' ] = $cff_translate_month;
                $options[ 'cff_translate_months' ] = $cff_translate_months;
                $options[ 'cff_translate_year' ] = $cff_translate_year;
                $options[ 'cff_translate_years' ] = $cff_translate_years;
                $options[ 'cff_translate_ago' ] = $cff_translate_ago;

            }
            //Update the array
            update_option( 'cff_style_settings', $options );
            // Put an settings updated message on the screen 
        ?>
        <div class="updated"><p><strong><?php _e('Settings saved.', 'custom-facebook-feed' ); ?></strong></p></div>
        <?php } ?> 

    <?php } //End nonce check ?>

 
    <div id="cff-admin" class="wrap">
        <div id="header">
            <h2><?php _e('Customize', 'custom-facebook-feed'); ?></h2>
        </div>
        <form name="form1" method="post" action="">
            <input type="hidden" name="<?php echo $style_hidden_field_name; ?>" value="Y">
            <?php wp_nonce_field( 'cff_saving_customize', 'cff_customize_nonce' ); ?>

            <?php
            $cff_active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'general';
            ?>
            <h2 class="nav-tab-wrapper">
                <a href="?page=cff-style&tab=general" class="nav-tab <?php echo $cff_active_tab == 'general' ? 'nav-tab-active' : ''; ?>"><?php _e('General', 'custom-facebook-feed'); ?></a>
                <a href="?page=cff-style&tab=post_layout" class="nav-tab <?php echo $cff_active_tab == 'post_layout' ? 'nav-tab-active' : ''; ?>"><?php _e('Post Layout', 'custom-facebook-feed'); ?></a>
                <a href="?page=cff-style&tab=typography" class="nav-tab <?php echo $cff_active_tab == 'typography' ? 'nav-tab-active' : ''; ?>"><?php _e('Typography', 'custom-facebook-feed'); ?></a>
                <a href="?page=cff-style&tab=misc" class="nav-tab <?php echo $cff_active_tab == 'misc' ? 'nav-tab-active' : ''; ?>"><?php _e('Misc', 'custom-facebook-feed'); ?></a>
                <a href="?page=cff-style&tab=custom_text" class="nav-tab <?php echo $cff_active_tab == 'custom_text' ? 'nav-tab-active' : ''; ?>"><?php _e('Custom Text / Translate', 'custom-facebook-feed'); ?></a>
            </h2>
            <?php if( $cff_active_tab == 'general' ) { //Start General tab ?>

            <p class="cff_contents_links" id="general">
                <span>Quick links: </span>
                <a href="#general">General</a>
                <a href="#types">Post Types</a>
            </p>

            <input type="hidden" name="<?php echo $style_general_hidden_field_name; ?>" value="Y">
            <br />
            <table class="form-table">
                <tbody>
                    <h3><?php _e('General', 'custom-facebook-feed'); ?></h3>
                    <tr valign="top">
                        <th class="bump-left" scope="row"><label><?php _e('Feed Width', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> width
                        Eg: width=500px</code></th>
                        <td>
                            <input name="cff_feed_width" id="cff_feed_width" type="text" value="<?php esc_attr_e( $cff_feed_width, 'custom-facebook-feed' ); ?>" size="6" />
                            <span>Eg. 500px, 50%, 10em.  <i style="color: #666; font-size: 11px; margin-left: 5px;"><?php _e('Default is 100%', 'custom-facebook-feed'); ?></i></span>
                            <div id="cff_width_options">
                                <input name="cff_feed_width_resp" type="checkbox" id="cff_feed_width_resp" <?php if($cff_feed_width_resp == true) echo "checked"; ?> /><label for="cff_feed_width_resp"><?php _e('Set to be 100% width on mobile?', 'custom-facebook-feed'); ?></label>
                                <a class="cff-tooltip-link" href="JavaScript:void(0);"><?php _e('What does this mean?', 'custom-facebook-feed'); ?></a>
                                <p class="cff-tooltip cff-more-info"><?php _e("If you set a width on the feed then this will be used on mobile as well as desktop. Check this setting to set the feed width to be 100% on mobile so that it is responsive.", 'custom-facebook-feed'); ?></p>
                            </div>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th class="bump-left" scope="row"><label><?php _e('Feed Height', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> height
                        Eg: height=500px</code></th>
                        <td>
                            <input name="cff_feed_height" type="text" value="<?php esc_attr_e( $cff_feed_height, 'custom-facebook-feed' ); ?>" size="6" />
                            <span>Eg. 500px, 50em. <i style="color: #666; font-size: 11px; margin-left: 5px;"><?php _e('Leave empty to set no maximum height. If the feed exceeds this height then a scroll bar will be used.', 'custom-facebook-feed'); ?></i></span>
                        </td>
                    </tr>
                        <th class="bump-left" scope="row"><label><?php _e('Feed Padding', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> padding
                        Eg: padding=20px</code></th>
                        <td>
                            <input name="cff_feed_padding" type="text" value="<?php esc_attr_e( $cff_feed_padding, 'custom-facebook-feed' ); ?>" size="6" />
                            <span>Eg. 20px, 5%. <i style="color: #666; font-size: 11px; margin-left: 5px;"><?php _e('This is the amount of padding/spacing that goes around the feed. This is particularly useful if you intend to set a background color on the feed.', 'custom-facebook-feed'); ?></i></span>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th class="bump-left" scope="row"><label><?php _e('Feed Background Color', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> bgcolor
                        Eg: bgcolor=FF0000</code></th>
                        <td>
                            <input name="cff_bg_color" value="#<?php esc_attr_e( str_replace('#', '', $cff_bg_color), 'custom-facebook-feed' ); ?>" class="cff-colorpicker" />
                        </td>
                    </tr>
                    <tr valign="top">
                        <th class="bump-left" scope="row"><label><?php _e('Add CSS class to feed', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> class
                        Eg: class=myfeed</code></th>
                        <td>
                            <input name="cff_class" type="text" value="<?php esc_attr_e( $cff_class, 'custom-facebook-feed' ); ?>" size="25" />
                            <i style="color: #666; font-size: 11px; margin-left: 5px;"><?php _e('To add multiple classes separate each with a space, Eg. classone classtwo classthree', 'custom-facebook-feed'); ?></i>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th class="bump-left" scope="row"><label><?php _e('Show Feed Header', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> showheader
                        Eg: showheader=true</code></th>
                        <td>
                            <input type="checkbox" name="cff_show_header" id="cff_show_header" <?php if($cff_show_header == true) echo 'checked="checked"' ?> />&nbsp;<?php _e('Yes', 'custom-facebook-feed'); ?>
                            <i style="color: #666; font-size: 11px; margin-left: 5px;"><?php _e('Display a header at the top of your feed. You can customize the header <a href="?page=cff-style&tab=typography">here</a>.', 'custom-facebook-feed'); ?></i>
                        </td>
                    </tr>
                </tbody>
            </table>
            
            <hr id="types" />
            <table class="form-table">
                <tbody>
                    <h3><?php _e('Post Types', 'custom-facebook-feed'); ?></h3>
                    <tr valign="top">
                        <th scope="row"><?php _e('Only show these types of posts:', 'custom-facebook-feed'); ?><br />
                            <i style="color: #666; font-size: 11px;"><a href="https://smashballoon.com/custom-facebook-feed/" target="_blank"><?php _e('Upgrade to Pro to enable post types, photos, videos and more', 'custom-facebook-feed'); ?></a></i></th>
                        <td>
                            <div>
                                <input name="cff_show_status_type" type="checkbox" id="cff_show_status_type" disabled checked />
                                <label for="cff_show_status_type"><?php _e('Statuses', 'custom-facebook-feed'); ?></label>
                            </div>
                            <div>
                                <input type="checkbox" name="cff_show_event_type" id="cff_show_event_type" disabled checked />
                                <label for="cff_show_event_type"><?php _e('Events', 'custom-facebook-feed'); ?></label>
                            </div>
                            <div>
                                <input type="checkbox" name="cff_show_photos_type" id="cff_show_photos_type" disabled checked />
                                <label for="cff_show_photos_type"><?php _e('Photos', 'custom-facebook-feed'); ?></label>
                            </div>
                            <div>
                                <input type="checkbox" name="cff_show_video_type" id="cff_show_video_type" disabled checked />
                                <label for="cff_show_video_type"><?php _e('Videos', 'custom-facebook-feed'); ?></label>
                            </div>
                            <div>
                                <input type="checkbox" name="cff_show_links_type" id="cff_show_links_type" disabled checked />
                                <label for="cff_show_links_type"><?php _e('Links', 'custom-facebook-feed'); ?></label>
                            </div>
                            <div>
                                <input type="checkbox" name="cff_show_links_type" id="cff_show_links_type" disabled checked />
                                <label for="cff_show_links_type"><?php _e('Albums', 'custom-facebook-feed'); ?></label>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <?php submit_button(); ?>
            
            <a href="https://smashballoon.com/custom-facebook-feed/demo" target="_blank"><img src="<?php echo plugins_url( 'img/pro.png' , __FILE__ ) ?>" /></a>
            <?php } //End General tab ?>
            <?php if( $cff_active_tab == 'post_layout' ) { //Start Post Layout tab ?>

            <p class="cff_contents_links" id="layout">
                <span>Quick links: </span>
                <a href="#layout">Post Layout</a>
                <a href="#showhide">Show/Hide</a>
                <a href="#poststyle">Post Style</a>
            </p>

            <input type="hidden" name="<?php echo $style_post_layout_hidden_field_name; ?>" value="Y">
            <br />
            <h3><?php _e('Post Layouts', 'custom-facebook-feed'); ?></h3>
            <p><i style="color: #666; font-size: 11px;"><a href="https://smashballoon.com/custom-facebook-feed/" target="_blank"><?php _e('Upgrade to Pro to enable post layouts', 'custom-facebook-feed'); ?></a></i></p>

            <table class="form-table">

                <hr />
                <h3><?php _e('Show/Hide', 'custom-facebook-feed'); ?></h3>
                <table class="form-table">
                    <tbody>
                    <tr valign="top">
                        <th scope="row"><label><?php _e('Include the following in posts: <i style="font-size: 11px;">(when applicable)</i>', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> include  exclude
                        Eg: include=text,date,likebox
                        Eg: exclude=likebox

                        Options: author, text, desc, sharedlinks, date, eventtitle, eventdetails, link, likebox</code>
                        </th>
                        <td>
                            <div>
                                <input name="cff_show_author" type="checkbox" id="cff_show_author" <?php if($cff_show_author == true) echo "checked"; ?> />
                                <label for="cff_show_author"><?php _e('Author name and avatar', 'custom-facebook-feed'); ?></label>
                            </div>
                            <div>
                                <input name="cff_show_text" type="checkbox" id="cff_show_text" <?php if($cff_show_text == true) echo "checked"; ?> />
                                <label for="cff_show_text"><?php _e('Post text', 'custom-facebook-feed'); ?></label>
                            </div>
                            <div>
                                <input type="checkbox" name="cff_show_date" id="cff_show_date" <?php if($cff_show_date == true) echo 'checked="checked"' ?> />
                                <label for="cff_show_date"><?php _e('Date', 'custom-facebook-feed'); ?></label>
                            </div>
                            <div class="cff-disabled">
                                <input type="checkbox" id="cff_show_media" disabled />
                                <label for="cff_show_media"><?php _e('Photos/videos', 'custom-facebook-feed'); ?></label>
                            </div>
                            <div>
                                <input type="checkbox" name="cff_show_media_link" id="cff_show_media_link" <?php if($cff_show_media_link == true) echo 'checked="checked"' ?> />
                                <label for="cff_show_media_link"><?php _e('Media link', 'custom-facebook-feed'); ?></label><a class="cff-tooltip-link" href="JavaScript:void(0);"><?php _e('What is this?'); ?></a>
                                <p class="cff-tooltip cff-more-info"><?php _e('Display an icon and link to Facebook if the post contains either a photo or video'); ?></p>
                            </div>
                            <div>
                                <input type="checkbox" name="cff_show_shared_links" id="cff_show_shared_links" <?php if($cff_show_shared_links == true) echo 'checked="checked"' ?> />
                                <label for="cff_show_shared_links"><?php _e('Shared links', 'custom-facebook-feed'); ?></label>
                            </div>
                            <div>
                                <input type="checkbox" name="cff_show_desc" id="cff_show_desc" <?php if($cff_show_desc == true) echo 'checked="checked"' ?> />
                                <label for="cff_show_desc"><?php _e('Link, photo and video descriptions', 'custom-facebook-feed'); ?></label>
                            </div>
                            <div>
                                <input type="checkbox" name="cff_show_event_title" id="cff_show_event_title" <?php if($cff_show_event_title == true) echo 'checked="checked"' ?> />
                                <label for="cff_show_event_title"><?php _e('Event title', 'custom-facebook-feed'); ?></label>
                            </div>
                            <div>
                                <input type="checkbox" name="cff_show_event_details" id="cff_show_event_details" <?php if($cff_show_event_details == true) echo 'checked="checked"' ?> />
                                <label for="cff_show_event_details"><?php _e('Event details', 'custom-facebook-feed'); ?></label>
                            </div>
                            <div class="cff-disabled">
                                <input type="checkbox" id="cff_show_meta" disabled />
                                <label for="cff_show_meta"><?php _e('Like/shares/comments', 'custom-facebook-feed'); ?></label>
                            </div>
                            <div>
                                <input type="checkbox" name="cff_show_link" id="cff_show_link" <?php if($cff_show_link == true) echo 'checked="checked"' ?> />
                                <label for="cff_show_link"><?php _e('View on Facebook', 'custom-facebook-feed'); ?></label>
                            </div>
                        </td>
                    </tr>
                    <tr id="poststyle"><!-- Quick link --></tr>
                </tbody>
            </table>

            <hr />
            <h3><?php _e('Post Style', 'custom-facebook-feed'); ?></h3>
            <table class="form-table">
                <tbody>
                    <tr valign="top">
                        <th class="bump-left" scope="row"><label><?php _e('Background Color', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> postbgcolor
                        Eg: postbgcolor=ff0000</code></th>
                        <td>
                            <input name="cff_post_bg_color" value="#<?php esc_attr_e( str_replace('#', '', $cff_post_bg_color), 'custom-facebook-feed' ); ?>" class="cff-colorpicker" />
                        </td>
                    </tr>
                    <tr valign="top">
                        <th class="bump-left" scope="row"><label><?php _e('Rounded Corner Size', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> postcorners
                        Eg: postcorners=10</code></th>
                        <td>
                            <input name="cff_post_rounded" type="text" value="<?php esc_attr_e( $cff_post_rounded, 'custom-facebook-feed' ); ?>" size="3" />px <span><i style="color: #666; font-size: 11px; margin-left: 5px;">Eg. 5</i></span>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th class="bump-left" scope="row"><label><?php _e('Separating Line Color', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> sepcolor
                        Eg: sepcolor=CFCFCF</code></th>
                        <td>
                            <input name="cff_sep_color" value="#<?php esc_attr_e( str_replace('#', '', $cff_sep_color), 'custom-facebook-feed' ); ?>" class="cff-colorpicker" /><i style="color: #666; font-size: 11px; margin-left: 5px; position: relative; top: -10px;"><?php _e("Doesn't apply if you have a background color applied to your posts", 'custom-facebook-feed'); ?></i>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th class="bump-left" scope="row"><label><?php _e('Separating Line Thickness', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> sepsize
                        Eg: sepsize=3</code></th>
                        <td>
                            <input name="cff_sep_size" type="text" value="<?php esc_attr_e( $cff_sep_size, 'custom-facebook-feed' ); ?>" size="1" /><span>px</span> <i style="color: #666; font-size: 11px; margin-left: 5px;"><?php _e('Leave empty to hide', 'custom-facebook-feed'); ?></i>
                        </td>
                    </tr>
                </tbody>
            </table>
            
            <?php submit_button(); ?>
            <a href="https://smashballoon.com/custom-facebook-feed/demo" target="_blank"><img src="<?php echo plugins_url( 'img/pro.png' , __FILE__ ) ?>" /></a>
            <?php } //End Post Layout tab ?>
            <?php if( $cff_active_tab == 'typography' ) { //Start Typography tab ?>

            <p class="cff_contents_links" id="header">
                <span>Quick links: </span>
                <a href="#header">Feed Header</a>
                <a href="#author">Post Author</a>
                <a href="#text">Post Text</a>
                <a href="#description">Link, Photo and Video Description</a>
                <a href="#date">Post Date</a>
                <a href="#links">Shared Links</a>
                <a href="#eventtitle">Event Title</a>
                <a href="#eventdate">Event Date</a>
                <a href="#eventdetails">Event Details</a>
                <a href="#action">View on Facebook</a>
            </p>

            <input type="hidden" name="<?php echo $style_typography_hidden_field_name; ?>" value="Y">
            <br />
            <p><i style="color: #666; font-size: 11px; margin-left: 5px;"><?php _e('"Inherit" means that the text will inherit the styles from your theme.', 'custom-facebook-feed'); ?></i></p>
            
            <div id="poststuff" class="metabox-holder">
                <div class="meta-box-sortables ui-sortable">
                

                    <div id="adminform" class="postbox" style="display: block;">
                    <div class="handlediv" title="Click to toggle"><br></div>
                    <h3 class="hndle"><span><?php _e('Feed Header', 'custom-facebook-feed'); ?></span></h3>
                    <div class="inside">
                        <table class="form-table">
                            <tbody>
                                <tr valign="top">
                                    <th class="bump-left" scope="row"><label><?php _e('Display outside the scrollable area', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> headeroutside
                        Eg: headeroutside=true</code></th>
                                    <td>
                                        <input type="checkbox" name="cff_header_outside" id="cff_header_outside" <?php if($cff_header_outside == true) echo 'checked="checked"' ?> />&nbsp;<?php _e('Yes', 'custom-facebook-feed'); ?>
                                        <i style="color: #666; font-size: 11px; margin-left: 5px;"><?php _e('Only applicable if you have set a height on the feed', 'custom-facebook-feed'); ?></i>
                                    </td>
                                </tr>
                                </tr>
                                    <th class="bump-left" scope="row"><label><?php _e('Header Text', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> headertext
                        Eg: headertext='Facebook Feed'</code></th>
                                    <td>
                                        <input name="cff_header_text" type="text" value="<?php esc_attr_e( $cff_header_text, 'custom-facebook-feed' ); ?>" size="30" />
                                        <span>Eg. Facebook Feed, Events, News..</span>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <th class="bump-left" scope="row"><label><?php _e('Background Color', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> headerbg
                        Eg: headerbg=DDD</code></th>
                                    <td>
                                        <input name="cff_header_bg_color" value="#<?php esc_attr_e( str_replace('#', '', $cff_header_bg_color), 'custom-facebook-feed' ); ?>" class="cff-colorpicker" />
                                    </td>
                                </tr>
                                </tr>
                                    <th class="bump-left" scope="row"><label><?php _e('Padding', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> headerpadding
                        Eg: headerpadding=20px</code></th>
                                    <td>
                                        <input name="cff_header_padding" type="text" value="<?php esc_attr_e( $cff_header_padding, 'custom-facebook-feed' ); ?>" size="6" />
                                        <span>Eg. 20px, 5%. <i style="color: #666; font-size: 11px; margin-left: 5px;"><?php _e('This is the amount of padding/spacing that goes around the header.', 'custom-facebook-feed'); ?></i></span>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="bump-left" scope="row"><label><?php _e('Text Size', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> headertextsize
                        Eg: headertextsize=28</code></th>
                                    <td>
                                        <select name="cff_header_text_size">
                                            <option value="inherit" <?php if($cff_header_text_size == "inherit") echo 'selected="selected"' ?> >Inherit</option>
                                            <option value="10" <?php if($cff_header_text_size == "10") echo 'selected="selected"' ?> >10px</option>
                                            <option value="11" <?php if($cff_header_text_size == "11") echo 'selected="selected"' ?> >11px</option>
                                            <option value="12" <?php if($cff_header_text_size == "12") echo 'selected="selected"' ?> >12px</option>
                                            <option value="13" <?php if($cff_header_text_size == "13") echo 'selected="selected"' ?> >13px</option>
                                            <option value="14" <?php if($cff_header_text_size == "14") echo 'selected="selected"' ?> >14px</option>
                                            <option value="16" <?php if($cff_header_text_size == "16") echo 'selected="selected"' ?> >16px</option>
                                            <option value="18" <?php if($cff_header_text_size == "18") echo 'selected="selected"' ?> >18px</option>
                                            <option value="20" <?php if($cff_header_text_size == "20") echo 'selected="selected"' ?> >20px</option>
                                            <option value="24" <?php if($cff_header_text_size == "24") echo 'selected="selected"' ?> >24px</option>
                                            <option value="28" <?php if($cff_header_text_size == "28") echo 'selected="selected"' ?> >28px</option>
                                            <option value="32" <?php if($cff_header_text_size == "32") echo 'selected="selected"' ?> >32px</option>
                                            <option value="36" <?php if($cff_header_text_size == "36") echo 'selected="selected"' ?> >36px</option>
                                            <option value="42" <?php if($cff_header_text_size == "42") echo 'selected="selected"' ?> >42px</option>
                                            <option value="48" <?php if($cff_header_text_size == "48") echo 'selected="selected"' ?> >48px</option>
                                            <option value="54" <?php if($cff_header_text_size == "54") echo 'selected="selected"' ?> >54px</option>
                                            <option value="60" <?php if($cff_header_text_size == "60") echo 'selected="selected"' ?> >60px</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="bump-left" scope="row"><label><?php _e('Text Weight', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> headertextweight
                        Eg: headertextweight=bold</code></th>
                                    <td>
                                        <select name="cff_header_text_weight">
                                            <option value="inherit" <?php if($cff_header_text_weight == "inherit") echo 'selected="selected"' ?> >Inherit</option>
                                            <option value="normal" <?php if($cff_header_text_weight == "normal") echo 'selected="selected"' ?> >Normal</option>
                                            <option value="bold" <?php if($cff_header_text_weight == "bold") echo 'selected="selected"' ?> >Bold</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="bump-left" scope="row"><label><?php _e('Text Color', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> headertextcolor
                        Eg: headertextcolor=333</code></th>
                                    <td>
                                        <input name="cff_header_text_color" value="#<?php esc_attr_e( str_replace('#', '', $cff_header_text_color), 'custom-facebook-feed' ); ?>" class="cff-colorpicker" />
                                    </td>
                                </tr>
                                <tr>
                                    <th class="bump-left" scope="row"><label><?php _e('Icon Type', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> headericon
                        Eg: headericon=facebook</code></th>
                                    <td>
                                        <select name="cff_header_icon" id="cff-header-icon">
                                            <option value="facebook-square" <?php if($cff_header_icon == "facebook-square") echo 'selected="selected"' ?> >Facebook 1</option>
                                            <option value="facebook" <?php if($cff_header_icon == "facebook") echo 'selected="selected"' ?> >Facebook 2</option>
                                            <option value="calendar" <?php if($cff_header_icon == "calendar") echo 'selected="selected"' ?> >Events 1</option>
                                            <option value="calendar-o" <?php if($cff_header_icon == "calendar-o") echo 'selected="selected"' ?> >Events 2</option>
                                            <option value="picture-o" <?php if($cff_header_icon == "picture-o") echo 'selected="selected"' ?> >Photos</option>
                                            <option value="users" <?php if($cff_header_icon == "users") echo 'selected="selected"' ?> >People</option>
                                            <option value="thumbs-o-up" <?php if($cff_header_icon == "thumbs-o-up") echo 'selected="selected"' ?> >Thumbs Up 1</option>
                                            <option value="thumbs-up" <?php if($cff_header_icon == "thumbs-up") echo 'selected="selected"' ?> >Thumbs Up 2</option>
                                            <option value="comment-o" <?php if($cff_header_icon == "comment-o") echo 'selected="selected"' ?> >Speech Bubble 1</option>
                                            <option value="comment" <?php if($cff_header_icon == "comment") echo 'selected="selected"' ?> >Speech Bubble 2</option>
                                            <option value="ticket" <?php if($cff_header_icon == "ticket") echo 'selected="selected"' ?> >Ticket</option>
                                            <option value="list-alt" <?php if($cff_header_icon == "list-alt") echo 'selected="selected"' ?> >News List</option>
                                            <option value="file" <?php if($cff_header_icon == "file") echo 'selected="selected"' ?> >File 1</option>
                                            <option value="file-o" <?php if($cff_header_icon == "file-o") echo 'selected="selected"' ?> >File 2</option>
                                            <option value="file-text" <?php if($cff_header_icon == "file-text") echo 'selected="selected"' ?> >File 3</option>
                                            <option value="file-text-o" <?php if($cff_header_icon == "file-text-o") echo 'selected="selected"' ?> >File 4</option>
                                            <option value="youtube-play" <?php if($cff_header_icon == "youtube-play") echo 'selected="selected"' ?> >Video</option>
                                            <option value="youtube" <?php if($cff_header_icon == "youtube") echo 'selected="selected"' ?> >YouTube</option>
                                            <option value="vimeo-square" <?php if($cff_header_icon == "vimeo-square") echo 'selected="selected"' ?> >Vimeo</option>
                                        </select>

                                        <i id="cff-header-icon-example" class="fa fa-facebook-square"></i>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="bump-left" scope="row"><label><?php _e('Icon Color', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> headericoncolor
                        Eg: headericoncolor=FFF</code></th>
                                    <td>
                                        <input name="cff_header_icon_color" value="#<?php esc_attr_e( str_replace('#', '', $cff_header_icon_color), 'custom-facebook-feed' ); ?>" class="cff-colorpicker" />
                                    </td>
                                </tr>
                                <tr>
                                    <th class="bump-left" scope="row"><label><?php _e('Icon Size', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> headericonsize
                        Eg: headericonsize=28</code></th>
                                    <td>
                                        <select name="cff_header_icon_size" id="cff-header-icon-size">
                                            <option value="10" <?php if($cff_header_icon_size == "10") echo 'selected="selected"' ?> >10px</option>
                                            <option value="11" <?php if($cff_header_icon_size == "11") echo 'selected="selected"' ?> >11px</option>
                                            <option value="12" <?php if($cff_header_icon_size == "12") echo 'selected="selected"' ?> >12px</option>
                                            <option value="13" <?php if($cff_header_icon_size == "13") echo 'selected="selected"' ?> >13px</option>
                                            <option value="14" <?php if($cff_header_icon_size == "14") echo 'selected="selected"' ?> >14px</option>
                                            <option value="16" <?php if($cff_header_icon_size == "16") echo 'selected="selected"' ?> >16px</option>
                                            <option value="18" <?php if($cff_header_icon_size == "18") echo 'selected="selected"' ?> >18px</option>
                                            <option value="20" <?php if($cff_header_icon_size == "20") echo 'selected="selected"' ?> >20px</option>
                                            <option value="24" <?php if($cff_header_icon_size == "24") echo 'selected="selected"' ?> >24px</option>
                                            <option value="28" <?php if($cff_header_icon_size == "28") echo 'selected="selected"' ?> >28px</option>
                                            <option value="32" <?php if($cff_header_icon_size == "32") echo 'selected="selected"' ?> >32px</option>
                                            <option value="36" <?php if($cff_header_icon_size == "36") echo 'selected="selected"' ?> >36px</option>
                                            <option value="42" <?php if($cff_header_icon_size == "42") echo 'selected="selected"' ?> >42px</option>
                                            <option value="48" <?php if($cff_header_icon_size == "48") echo 'selected="selected"' ?> >48px</option>
                                            <option value="54" <?php if($cff_header_icon_size == "54") echo 'selected="selected"' ?> >54px</option>
                                            <option value="60" <?php if($cff_header_icon_size == "60") echo 'selected="selected"' ?> >60px</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr id="author"><!-- Quick link --></tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div id="adminform" class="postbox" style="display: block;">
                    <div class="handlediv"><br></div>
                    <h3 class="hndle"><span><?php _e('Post Author', 'custom-facebook-feed'); ?></span></h3>
                    <div class="inside">
                        <table class="form-table">
                            <tbody>
                                <tr>
                                    <th><label class="bump-left"><?php _e('Text Size', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> authorsize
                        Eg: authorsize=20</code></th>
                                    <td>
                                        <select name="cff_author_size">
                                            <option value="inherit" <?php if($cff_author_size == "inherit") echo 'selected="selected"' ?> >Inherit</option>
                                            <option value="10" <?php if($cff_author_size == "10") echo 'selected="selected"' ?> >10px</option>
                                            <option value="11" <?php if($cff_author_size == "11") echo 'selected="selected"' ?> >11px</option>
                                            <option value="12" <?php if($cff_author_size == "12") echo 'selected="selected"' ?> >12px</option>
                                            <option value="13" <?php if($cff_author_size == "13") echo 'selected="selected"' ?> >13px</option>
                                            <option value="14" <?php if($cff_author_size == "14") echo 'selected="selected"' ?> >14px</option>
                                            <option value="16" <?php if($cff_author_size == "16") echo 'selected="selected"' ?> >16px</option>
                                            <option value="18" <?php if($cff_author_size == "18") echo 'selected="selected"' ?> >18px</option>
                                            <option value="20" <?php if($cff_author_size == "20") echo 'selected="selected"' ?> >20px</option>
                                            <option value="24" <?php if($cff_author_size == "24") echo 'selected="selected"' ?> >24px</option>
                                            <option value="28" <?php if($cff_author_size == "28") echo 'selected="selected"' ?> >28px</option>
                                            <option value="32" <?php if($cff_author_size == "32") echo 'selected="selected"' ?> >32px</option>
                                            <option value="36" <?php if($cff_author_size == "36") echo 'selected="selected"' ?> >36px</option>
                                            <option value="42" <?php if($cff_author_size == "42") echo 'selected="selected"' ?> >42px</option>
                                            <option value="48" <?php if($cff_author_size == "48") echo 'selected="selected"' ?> >48px</option>
                                            <option value="54" <?php if($cff_author_size == "54") echo 'selected="selected"' ?> >54px</option>
                                            <option value="60" <?php if($cff_author_size == "60") echo 'selected="selected"' ?> >60px</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label class="bump-left"><?php _e('Text Color', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> authorcolor
                        Eg: authorcolor=ff0000</code></th>
                                    <td>
                                        <input name="cff_author_color" value="#<?php esc_attr_e( str_replace('#', '', $cff_author_color), 'custom-facebook-feed' ); ?>" class="cff-colorpicker" />
                                    </td>
                                </tr>
                                <tr id="text"><!-- Quick link --></tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div style="margin-top: -15px;">
                    <?php submit_button(); ?>
                </div>
                <div id="adminform" class="postbox" style="display: block;">
                    <div class="handlediv" title="Click to toggle"><br></div>
                    <h3 class="hndle"><span><?php _e('Post Text', 'custom-facebook-feed'); ?></span></h3>
                    <div class="inside">
                        <table class="form-table">
                            <tbody>
                                <tr valign="top">
                                    <th scope="row"><label class="bump-left"><?php _e('Maximum Post Text Length', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> textlength
                        Eg: textlength=200</code></th>
                                    <td>
                                        <input name="cff_title_length" type="text" value="<?php esc_attr_e( $cff_title_length_val, 'custom-facebook-feed' ); ?>" size="4" /> <span><?php _e('Characters.', 'custom-facebook-feed'); ?></span> <span>Eg. 200</span> <i style="color: #666; font-size: 11px; margin-left: 5px;"><?php _e('If the post text exceeds this length then a "See More" button will be added. Leave empty to set no maximum length.', 'custom-facebook-feed'); ?></i>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label class="bump-left"><?php _e('Format', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> textformat
                        Eg: textformat=h4</code></th>
                                    <td>
                                        <select name="cff_title_format">
                                            <option value="p" <?php if($cff_title_format == "p") echo 'selected="selected"' ?> >Paragraph</option>
                                            <option value="h3" <?php if($cff_title_format == "h3") echo 'selected="selected"' ?> >Heading 3</option>
                                            <option value="h4" <?php if($cff_title_format == "h4") echo 'selected="selected"' ?> >Heading 4</option>
                                            <option value="h5" <?php if($cff_title_format == "h5") echo 'selected="selected"' ?> >Heading 5</option>
                                            <option value="h6" <?php if($cff_title_format == "h6") echo 'selected="selected"' ?> >Heading 6</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label class="bump-left"><?php _e('Text Size', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> textsize
                        Eg: textsize=12</code></th>
                                    <td>
                                        <select name="cff_title_size">
                                            <option value="inherit" <?php if($cff_title_size == "inherit") echo 'selected="selected"' ?> >Inherit</option>
                                            <option value="10" <?php if($cff_title_size == "10") echo 'selected="selected"' ?> >10px</option>
                                            <option value="11" <?php if($cff_title_size == "11") echo 'selected="selected"' ?> >11px</option>
                                            <option value="12" <?php if($cff_title_size == "12") echo 'selected="selected"' ?> >12px</option>
                                            <option value="13" <?php if($cff_title_size == "13") echo 'selected="selected"' ?> >13px</option>
                                            <option value="14" <?php if($cff_title_size == "14") echo 'selected="selected"' ?> >14px</option>
                                            <option value="16" <?php if($cff_title_size == "16") echo 'selected="selected"' ?> >16px</option>
                                            <option value="18" <?php if($cff_title_size == "18") echo 'selected="selected"' ?> >18px</option>
                                            <option value="20" <?php if($cff_title_size == "20") echo 'selected="selected"' ?> >20px</option>
                                            <option value="24" <?php if($cff_title_size == "24") echo 'selected="selected"' ?> >24px</option>
                                            <option value="28" <?php if($cff_title_size == "28") echo 'selected="selected"' ?> >28px</option>
                                            <option value="32" <?php if($cff_title_size == "32") echo 'selected="selected"' ?> >32px</option>
                                            <option value="36" <?php if($cff_title_size == "36") echo 'selected="selected"' ?> >36px</option>
                                            <option value="42" <?php if($cff_title_size == "42") echo 'selected="selected"' ?> >42px</option>
                                            <option value="48" <?php if($cff_title_size == "48") echo 'selected="selected"' ?> >48px</option>
                                            <option value="54" <?php if($cff_title_size == "54") echo 'selected="selected"' ?> >54px</option>
                                            <option value="60" <?php if($cff_title_size == "60") echo 'selected="selected"' ?> >60px</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label class="bump-left"><?php _e('Text Weight', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> textweight
                        Eg: textweight=bold</code></th>
                                    <td>
                                        <select name="cff_title_weight">
                                            <option value="inherit" <?php if($cff_title_weight == "inherit") echo 'selected="selected"' ?> >Inherit</option>
                                            <option value="normal" <?php if($cff_title_weight == "normal") echo 'selected="selected"' ?> >Normal</option>
                                            <option value="bold" <?php if($cff_title_weight == "bold") echo 'selected="selected"' ?> >Bold</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label class="bump-left"><?php _e('Text Color', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> textcolor
                        Eg: textcolor=333</code></th>
                                    <td>
                                        <input name="cff_title_color" value="#<?php esc_attr_e( str_replace('#', '', $cff_title_color), 'custom-facebook-feed' ); ?>" class="cff-colorpicker" />
                                    </td>
                                </tr>
                                <tr>
                                    <th><label class="bump-left"><?php _e('Link Color', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> textlinkcolor
                        Eg: textlinkcolor=E69100</code></th>
                                    <td>
                                        <input name="cff_posttext_link_color" value="#<?php esc_attr_e( str_replace('#', '', $cff_posttext_link_color), 'custom-facebook-feed' ); ?>" class="cff-colorpicker" />
                                    </td>
                                </tr>
                                <tr>
                                    <th><label class="bump-left"><?php _e('Link Text to Facebook Post?', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> textlink
                        Eg: textlink=true</code></th>
                                    <td><input type="checkbox" name="cff_title_link" id="cff_title_link" <?php if($cff_title_link == true) echo 'checked="checked"' ?> />&nbsp;<?php _e('Yes', 'custom-facebook-feed'); ?></td>
                                </tr>

                                <tr>
                                    <th><label class="bump-left"><?php _e('Link Post Tags?', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> posttags
                        Eg: posttags=false</code></th>
                                    <td>
                                        <input type="checkbox" name="cff_post_tags" id="cff_post_tags" <?php if($cff_post_tags == true) echo 'checked="checked"' ?> />&nbsp;<?php _e('Yes', 'custom-facebook-feed'); ?>
                                        <a class="cff-tooltip-link" href="JavaScript:void(0);"><?php _e('What are Post Tags?', 'custom-facebook-feed'); ?></a>
                                        <p class="cff-tooltip cff-more-info"><?php _e("When you tag another Facebook page or user in your post using the @ symbol it creates a post tag, which is a link to either that Facebook page or user profile.", 'custom-facebook-feed'); ?></p>
                                    </td>
                                </tr>

                                <tr>
                                    <th><label class="bump-left"><?php _e('Link Hashtags?', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> linkhashtags
                        Eg: linkhashtags=false</code></th>
                                    <td>
                                        <input type="checkbox" name="cff_link_hashtags" id="cff_link_hashtags" <?php if($cff_link_hashtags == true) echo 'checked="checked"' ?> />&nbsp;<?php _e('Yes', 'custom-facebook-feed'); ?>
                                    </td>
                                </tr>
                                <tr id="description"><!-- Quick link --></tr>
                                </tbody>
                            </table>
                        </div>
                </div>
                <div id="adminform" class="postbox" style="display: block;">
                    <div class="handlediv" title="Click to toggle"><br></div>
                    <h3 class="hndle"><span><?php _e('Link, Photo and Video Description', 'custom-facebook-feed'); ?></span></h3>
                    <div class="inside">
                        <table class="form-table">
                            <tbody>
                                <tr valign="top">
                                    <th scope="row"><label class="bump-left"><?php _e('Maximum Description Length', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> desclength
                        Eg: desclength=150</code></th>
                                    <td>
                                        <input name="cff_body_length" type="text" value="<?php esc_attr_e( $cff_body_length_val, 'custom-facebook-feed' ); ?>" size="4" /> <span><?php _e('Characters. Eg. 200', 'custom-facebook-feed'); ?></span> <i style="color: #666; font-size: 11px; margin-left: 5px;"><?php _e('Leave empty to set no maximum length', 'custom-facebook-feed'); ?></i>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label class="bump-left"><?php _e('Text Size', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> descsize
                        Eg: descsize=11</code></th>
                                    <td>
                                        <select name="cff_body_size">
                                            <option value="inherit" <?php if($cff_body_size == "inherit") echo 'selected="selected"' ?> >Inherit</option>
                                            <option value="10" <?php if($cff_body_size == "10") echo 'selected="selected"' ?> >10px</option>
                                            <option value="11" <?php if($cff_body_size == "11") echo 'selected="selected"' ?> >11px</option>
                                            <option value="12" <?php if($cff_body_size == "12") echo 'selected="selected"' ?> >12px</option>
                                            <option value="13" <?php if($cff_body_size == "13") echo 'selected="selected"' ?> >13px</option>
                                            <option value="14" <?php if($cff_body_size == "14") echo 'selected="selected"' ?> >14px</option>
                                            <option value="16" <?php if($cff_body_size == "16") echo 'selected="selected"' ?> >16px</option>
                                            <option value="18" <?php if($cff_body_size == "18") echo 'selected="selected"' ?> >18px</option>
                                            <option value="20" <?php if($cff_body_size == "20") echo 'selected="selected"' ?> >20px</option>
                                            <option value="24" <?php if($cff_body_size == "24") echo 'selected="selected"' ?> >24px</option>
                                            <option value="28" <?php if($cff_body_size == "28") echo 'selected="selected"' ?> >28px</option>
                                            <option value="32" <?php if($cff_body_size == "32") echo 'selected="selected"' ?> >32px</option>
                                            <option value="36" <?php if($cff_body_size == "36") echo 'selected="selected"' ?> >36px</option>
                                            <option value="42" <?php if($cff_body_size == "42") echo 'selected="selected"' ?> >42px</option>
                                            <option value="48" <?php if($cff_body_size == "48") echo 'selected="selected"' ?> >48px</option>
                                            <option value="54" <?php if($cff_body_size == "54") echo 'selected="selected"' ?> >54px</option>
                                            <option value="60" <?php if($cff_body_size == "60") echo 'selected="selected"' ?> >60px</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label class="bump-left"><?php _e('Text Weight', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> descweight
                        Eg: descweight=bold</code></th>
                                    <td>
                                        <select name="cff_body_weight">
                                            <option value="inherit" <?php if($cff_body_weight == "inherit") echo 'selected="selected"' ?> >Inherit</option>
                                            <option value="normal" <?php if($cff_body_weight == "normal") echo 'selected="selected"' ?> >Normal</option>
                                            <option value="bold" <?php if($cff_body_weight == "bold") echo 'selected="selected"' ?> >Bold</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label class="bump-left"><?php _e('Text Color', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> desccolor
                        Eg: desccolor=9F9F9F</code></th>
                                    
                                    <td>
                                        <input name="cff_body_color" value="#<?php esc_attr_e( str_replace('#', '', $cff_body_color), 'custom-facebook-feed' ); ?>" class="cff-colorpicker" />
                                    </td>
                                </tr>
                                <tr id="date"><!-- Quick link --></tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            <div style="margin-top: -15px;">
                <?php submit_button(); ?>
            </div>
                <div id="adminform" class="postbox" style="display: block;">
                    <div class="handlediv" title="Click to toggle"><br></div>
                    <h3 class="hndle"><span><?php _e('Post Date', 'custom-facebook-feed'); ?></span></h3>
                    <div class="inside">
                        <table class="form-table">
                            <tbody>
                            <tr>
                                <th><label class="bump-left"><?php _e('Position', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> datepos
                        Eg: datepos=below</code></th>
                                <td>
                                    <select name="cff_date_position" style="width: 280px;">
                                        <option value="author" <?php if($cff_date_position == "author") echo 'selected="selected"' ?> >Immediately under the post author</option>
                                        <option value="above" <?php if($cff_date_position == "above") echo 'selected="selected"' ?> >At the top of the post</option>
                                        <option value="below" <?php if($cff_date_position == "below") echo 'selected="selected"' ?> >At the bottom of the post</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th><label class="bump-left"><?php _e('Text Size', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> datesize
                        Eg: datesize=14</code></th>
                                <td>
                                    <select name="cff_date_size">
                                        <option value="inherit" <?php if($cff_date_size == "inherit") echo 'selected="selected"' ?> >Inherit</option>
                                        <option value="10" <?php if($cff_date_size == "10") echo 'selected="selected"' ?> >10px</option>
                                        <option value="11" <?php if($cff_date_size == "11") echo 'selected="selected"' ?> >11px</option>
                                        <option value="12" <?php if($cff_date_size == "12") echo 'selected="selected"' ?> >12px</option>
                                        <option value="13" <?php if($cff_date_size == "13") echo 'selected="selected"' ?> >13px</option>
                                        <option value="14" <?php if($cff_date_size == "14") echo 'selected="selected"' ?> >14px</option>
                                        <option value="16" <?php if($cff_date_size == "16") echo 'selected="selected"' ?> >16px</option>
                                        <option value="18" <?php if($cff_date_size == "18") echo 'selected="selected"' ?> >18px</option>
                                        <option value="20" <?php if($cff_date_size == "20") echo 'selected="selected"' ?> >20px</option>
                                        <option value="24" <?php if($cff_date_size == "24") echo 'selected="selected"' ?> >24px</option>
                                        <option value="28" <?php if($cff_date_size == "28") echo 'selected="selected"' ?> >28px</option>
                                        <option value="32" <?php if($cff_date_size == "32") echo 'selected="selected"' ?> >32px</option>
                                        <option value="36" <?php if($cff_date_size == "36") echo 'selected="selected"' ?> >36px</option>
                                        <option value="42" <?php if($cff_date_size == "42") echo 'selected="selected"' ?> >42px</option>
                                        <option value="48" <?php if($cff_date_size == "48") echo 'selected="selected"' ?> >48px</option>
                                        <option value="54" <?php if($cff_date_size == "54") echo 'selected="selected"' ?> >54px</option>
                                        <option value="60" <?php if($cff_date_size == "60") echo 'selected="selected"' ?> >60px</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th><label class="bump-left"><?php _e('Text Weight', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> dateweight
                        Eg: dateweight=normal</code></th>
                                <td>
                                    <select name="cff_date_weight">
                                        <option value="inherit" <?php if($cff_date_weight == "inherit") echo 'selected="selected"' ?> >Inherit</option>
                                        <option value="normal" <?php if($cff_date_weight == "normal") echo 'selected="selected"' ?> >Normal</option>
                                        <option value="bold" <?php if($cff_date_weight == "bold") echo 'selected="selected"' ?> >Bold</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th><label class="bump-left"><?php _e('Text Color', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> datecolor
                        Eg: datecolor=EAD114</code></th>
                                <td>
                                    <input name="cff_date_color" value="#<?php esc_attr_e( str_replace('#', '', $cff_date_color), 'custom-facebook-feed' ); ?>" class="cff-colorpicker" />
                                </td>
                            </tr>
                                    
                            <tr>
                                <th><label class="bump-left"><?php _e('Date formatting', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> dateformat
                        Eg: dateformat=3</code></th>
                                <td>
                                    <select name="cff_date_formatting">
                                        <?php $original = strtotime('2013-07-25T17:30:00+0000'); ?>
                                        <option value="1" <?php if($cff_date_formatting == "1") echo 'selected="selected"' ?> ><?php _e('2 days ago', 'custom-facebook-feed'); ?></option>
                                        <option value="2" <?php if($cff_date_formatting == "2") echo 'selected="selected"' ?> ><?php echo date('F jS, g:i a', $original); ?></option>
                                        <option value="3" <?php if($cff_date_formatting == "3") echo 'selected="selected"' ?> ><?php echo date('F jS', $original); ?></option>
                                        <option value="4" <?php if($cff_date_formatting == "4") echo 'selected="selected"' ?> ><?php echo date('D F jS', $original); ?></option>
                                        <option value="5" <?php if($cff_date_formatting == "5") echo 'selected="selected"' ?> ><?php echo date('l F jS', $original); ?></option>
                                        <option value="6" <?php if($cff_date_formatting == "6") echo 'selected="selected"' ?> ><?php echo date('D M jS, Y', $original); ?></option>
                                        <option value="7" <?php if($cff_date_formatting == "7") echo 'selected="selected"' ?> ><?php echo date('l F jS, Y', $original); ?></option>
                                        <option value="8" <?php if($cff_date_formatting == "8") echo 'selected="selected"' ?> ><?php echo date('l F jS, Y - g:i a', $original); ?></option>
                                        <option value="9" <?php if($cff_date_formatting == "9") echo 'selected="selected"' ?> ><?php echo date("l M jS, 'y", $original); ?></option>
                                        <option value="10" <?php if($cff_date_formatting == "10") echo 'selected="selected"' ?> ><?php echo date('m.d.y', $original); ?></option>
                                        <option value="11" <?php if($cff_date_formatting == "11") echo 'selected="selected"' ?> ><?php echo date('m/d/y', $original); ?></option>
                                        <option value="12" <?php if($cff_date_formatting == "12") echo 'selected="selected"' ?> ><?php echo date('d.m.y', $original); ?></option>
                                        <option value="13" <?php if($cff_date_formatting == "13") echo 'selected="selected"' ?> ><?php echo date('d/m/y', $original); ?></option>
                                    </select>
                            </tr>

                            <tr>
                                <th><label class="bump-left"><?php _e('Timezone', 'custom-facebook-feed'); ?></label></th>
                                <td>
                                    <select name="cff_timezone" style="width: 300px;">
                                        <option value="Pacific/Midway" <?php if($cff_timezone == "Pacific/Midway") echo 'selected="selected"' ?> ><?php _e('(GMT-11:00) Midway Island, Samoa', 'custom-facebook-feed'); ?></option>
                                        <option value="America/Adak" <?php if($cff_timezone == "America/Adak") echo 'selected="selected"' ?> ><?php _e('(GMT-10:00) Hawaii-Aleutian', 'custom-facebook-feed'); ?></option>
                                        <option value="Etc/GMT+10" <?php if($cff_timezone == "Etc/GMT+10") echo 'selected="selected"' ?> ><?php _e('(GMT-10:00) Hawaii', 'custom-facebook-feed'); ?></option>
                                        <option value="Pacific/Marquesas" <?php if($cff_timezone == "Pacific/Marquesas") echo 'selected="selected"' ?> ><?php _e('(GMT-09:30) Marquesas Islands', 'custom-facebook-feed'); ?></option>
                                        <option value="Pacific/Gambier" <?php if($cff_timezone == "Pacific/Gambier") echo 'selected="selected"' ?> ><?php _e('(GMT-09:00) Gambier Islands', 'custom-facebook-feed'); ?></option>
                                        <option value="America/Anchorage" <?php if($cff_timezone == "America/Anchorage") echo 'selected="selected"' ?> ><?php _e('(GMT-09:00) Alaska', 'custom-facebook-feed'); ?></option>
                                        <option value="America/Ensenada" <?php if($cff_timezone == "America/Ensenada") echo 'selected="selected"' ?> ><?php _e('(GMT-08:00) Tijuana, Baja California', 'custom-facebook-feed'); ?></option>
                                        <option value="Etc/GMT+8" <?php if($cff_timezone == "Etc/GMT+8") echo 'selected="selected"' ?> ><?php _e('(GMT-08:00) Pitcairn Islands', 'custom-facebook-feed'); ?></option>
                                        <option value="America/Los_Angeles" <?php if($cff_timezone == "America/Los_Angeles") echo 'selected="selected"' ?> ><?php _e('(GMT-08:00) Pacific Time (US & Canada)', 'custom-facebook-feed'); ?></option>
                                        <option value="America/Denver" <?php if($cff_timezone == "America/Denver") echo 'selected="selected"' ?> ><?php _e('(GMT-07:00) Mountain Time (US & Canada)', 'custom-facebook-feed'); ?></option>
                                        <option value="America/Chihuahua" <?php if($cff_timezone == "America/Chihuahua") echo 'selected="selected"' ?> ><?php _e('(GMT-07:00) Chihuahua, La Paz, Mazatlan', 'custom-facebook-feed'); ?></option>
                                        <option value="America/Dawson_Creek" <?php if($cff_timezone == "America/Dawson_Creek") echo 'selected="selected"' ?> ><?php _e('(GMT-07:00) Arizona', 'custom-facebook-feed'); ?></option>
                                        <option value="America/Belize" <?php if($cff_timezone == "America/Belize") echo 'selected="selected"' ?> ><?php _e('(GMT-06:00) Saskatchewan, Central America', 'custom-facebook-feed'); ?></option>
                                        <option value="America/Cancun" <?php if($cff_timezone == "America/Cancun") echo 'selected="selected"' ?> ><?php _e('(GMT-06:00) Guadalajara, Mexico City, Monterrey', 'custom-facebook-feed'); ?></option>
                                        <option value="Chile/EasterIsland" <?php if($cff_timezone == "Chile/EasterIsland") echo 'selected="selected"' ?> ><?php _e('(GMT-06:00) Easter Island', 'custom-facebook-feed'); ?></option>
                                        <option value="America/Chicago" <?php if($cff_timezone == "America/Chicago") echo 'selected="selected"' ?> ><?php _e('(GMT-06:00) Central Time (US & Canada)', 'custom-facebook-feed'); ?></option>
                                        <option value="America/New_York" <?php if($cff_timezone == "America/New_York") echo 'selected="selected"' ?> ><?php _e('(GMT-05:00) Eastern Time (US & Canada)', 'custom-facebook-feed'); ?></option>
                                        <option value="America/Havana" <?php if($cff_timezone == "America/Havana") echo 'selected="selected"' ?> ><?php _e('(GMT-05:00) Cuba', 'custom-facebook-feed'); ?></option>
                                        <option value="America/Bogota" <?php if($cff_timezone == "America/Bogota") echo 'selected="selected"' ?> ><?php _e('(GMT-05:00) Bogota, Lima, Quito, Rio Branco', 'custom-facebook-feed'); ?></option>
                                        <option value="America/Caracas" <?php if($cff_timezone == "America/Caracas") echo 'selected="selected"' ?> ><?php _e('(GMT-04:30) Caracas', 'custom-facebook-feed'); ?></option>
                                        <option value="America/Santiago" <?php if($cff_timezone == "America/Santiago") echo 'selected="selected"' ?> ><?php _e('(GMT-04:00) Santiago', 'custom-facebook-feed'); ?></option>
                                        <option value="America/La_Paz" <?php if($cff_timezone == "America/La_Paz") echo 'selected="selected"' ?> ><?php _e('(GMT-04:00) La Paz', 'custom-facebook-feed'); ?></option>
                                        <option value="Atlantic/Stanley" <?php if($cff_timezone == "Atlantic/Stanley") echo 'selected="selected"' ?> ><?php _e('(GMT-04:00) Faukland Islands', 'custom-facebook-feed'); ?></option>
                                        <option value="America/Campo_Grande" <?php if($cff_timezone == "America/Campo_Grande") echo 'selected="selected"' ?> ><?php _e('(GMT-04:00) Brazil', 'custom-facebook-feed'); ?></option>
                                        <option value="America/Goose_Bay" <?php if($cff_timezone == "America/Goose_Bay") echo 'selected="selected"' ?> ><?php _e('(GMT-04:00) Atlantic Time (Goose Bay)', 'custom-facebook-feed'); ?></option>
                                        <option value="America/Glace_Bay" <?php if($cff_timezone == "America/Glace_Bay") echo 'selected="selected"' ?> ><?php _e('(GMT-04:00) Atlantic Time (Canada)', 'custom-facebook-feed'); ?></option>
                                        <option value="America/St_Johns" <?php if($cff_timezone == "America/St_Johns") echo 'selected="selected"' ?> ><?php _e('(GMT-03:30) Newfoundland', 'custom-facebook-feed'); ?></option>
                                        <option value="America/Araguaina" <?php if($cff_timezone == "America/Araguaina") echo 'selected="selected"' ?> ><?php _e('(GMT-03:00) UTC-3', 'custom-facebook-feed'); ?></option>
                                        <option value="America/Montevideo" <?php if($cff_timezone == "America/Montevideo") echo 'selected="selected"' ?> ><?php _e('(GMT-03:00) Montevideo', 'custom-facebook-feed'); ?></option>
                                        <option value="America/Miquelon" <?php if($cff_timezone == "America/Miquelon") echo 'selected="selected"' ?> ><?php _e('(GMT-03:00) Miquelon, St. Pierre', 'custom-facebook-feed'); ?></option>
                                        <option value="America/Godthab" <?php if($cff_timezone == "America/Godthab") echo 'selected="selected"' ?> ><?php _e('(GMT-03:00) Greenland', 'custom-facebook-feed'); ?></option>
                                        <option value="America/Argentina/Buenos_Aires" <?php if($cff_timezone == "America/Argentina/Buenos_Aires") echo 'selected="selected"' ?> ><?php _e('(GMT-03:00) Buenos Aires', 'custom-facebook-feed'); ?></option>
                                        <option value="America/Sao_Paulo" <?php if($cff_timezone == "America/Sao_Paulo") echo 'selected="selected"' ?> ><?php _e('(GMT-03:00) Brasilia', 'custom-facebook-feed'); ?></option>
                                        <option value="America/Noronha" <?php if($cff_timezone == "America/Noronha") echo 'selected="selected"' ?> ><?php _e('(GMT-02:00) Mid-Atlantic', 'custom-facebook-feed'); ?></option>
                                        <option value="Atlantic/Cape_Verde" <?php if($cff_timezone == "Atlantic/Cape_Verde") echo 'selected="selected"' ?> ><?php _e('(GMT-01:00) Cape Verde Is.', 'custom-facebook-feed'); ?></option>
                                        <option value="Atlantic/Azores" <?php if($cff_timezone == "Atlantic/Azores") echo 'selected="selected"' ?> ><?php _e('(GMT-01:00) Azores', 'custom-facebook-feed'); ?></option>
                                        <option value="Europe/Belfast" <?php if($cff_timezone == "Europe/Belfast") echo 'selected="selected"' ?> ><?php _e('(GMT) Greenwich Mean Time : Belfast', 'custom-facebook-feed'); ?></option>
                                        <option value="Europe/Dublin" <?php if($cff_timezone == "Europe/Dublin") echo 'selected="selected"' ?> ><?php _e('(GMT) Greenwich Mean Time : Dublin', 'custom-facebook-feed'); ?></option>
                                        <option value="Europe/Lisbon" <?php if($cff_timezone == "Europe/Lisbon") echo 'selected="selected"' ?> ><?php _e('(GMT) Greenwich Mean Time : Lisbon', 'custom-facebook-feed'); ?></option>
                                        <option value="Europe/London" <?php if($cff_timezone == "Europe/London") echo 'selected="selected"' ?> ><?php _e('(GMT) Greenwich Mean Time : London', 'custom-facebook-feed'); ?></option>
                                        <option value="Africa/Abidjan" <?php if($cff_timezone == "Africa/Abidjan") echo 'selected="selected"' ?> ><?php _e('(GMT) Monrovia, Reykjavik', 'custom-facebook-feed'); ?></option>
                                        <option value="Europe/Amsterdam" <?php if($cff_timezone == "Europe/Amsterdam") echo 'selected="selected"' ?> ><?php _e('(GMT+01:00) Amsterdam, Berlin, Bern, Rome, Stockholm, Vienna', 'custom-facebook-feed'); ?></option>
                                        <option value="Europe/Belgrade" <?php if($cff_timezone == "Europe/Belgrade") echo 'selected="selected"' ?> ><?php _e('(GMT+01:00) Belgrade, Bratislava, Budapest, Ljubljana, Prague', 'custom-facebook-feed'); ?></option>
                                        <option value="Europe/Brussels" <?php if($cff_timezone == "Europe/Brussels") echo 'selected="selected"' ?> ><?php _e('(GMT+01:00) Brussels, Copenhagen, Madrid, Paris', 'custom-facebook-feed'); ?></option>
                                        <option value="Africa/Algiers" <?php if($cff_timezone == "Africa/Algiers") echo 'selected="selected"' ?> ><?php _e('(GMT+01:00) West Central Africa', 'custom-facebook-feed'); ?></option>
                                        <option value="Africa/Windhoek" <?php if($cff_timezone == "Africa/Windhoek") echo 'selected="selected"' ?> ><?php _e('(GMT+01:00) Windhoek', 'custom-facebook-feed'); ?></option>
                                        <option value="Asia/Beirut" <?php if($cff_timezone == "Asia/Beirut") echo 'selected="selected"' ?> ><?php _e('(GMT+02:00) Beirut', 'custom-facebook-feed'); ?></option>
                                        <option value="Africa/Cairo" <?php if($cff_timezone == "Africa/Cairo") echo 'selected="selected"' ?> ><?php _e('(GMT+02:00) Cairo', 'custom-facebook-feed'); ?></option>
                                        <option value="Asia/Gaza" <?php if($cff_timezone == "Asia/Gaza") echo 'selected="selected"' ?> ><?php _e('(GMT+02:00) Gaza', 'custom-facebook-feed'); ?></option>
                                        <option value="Africa/Blantyre" <?php if($cff_timezone == "Africa/Blantyre") echo 'selected="selected"' ?> ><?php _e('(GMT+02:00) Harare, Pretoria', 'custom-facebook-feed'); ?></option>
                                        <option value="Asia/Jerusalem" <?php if($cff_timezone == "Asia/Jerusalem") echo 'selected="selected"' ?> ><?php _e('(GMT+02:00) Jerusalem', 'custom-facebook-feed'); ?></option>
                                        <option value="Europe/Minsk" <?php if($cff_timezone == "Europe/Minsk") echo 'selected="selected"' ?> ><?php _e('(GMT+02:00) Minsk', 'custom-facebook-feed'); ?></option>
                                        <option value="Asia/Damascus" <?php if($cff_timezone == "Asia/Damascus") echo 'selected="selected"' ?> ><?php _e('(GMT+02:00) Syria', 'custom-facebook-feed'); ?></option>
                                        <option value="Europe/Moscow" <?php if($cff_timezone == "Europe/Moscow") echo 'selected="selected"' ?> ><?php _e('(GMT+03:00) Moscow, St. Petersburg, Volgograd', 'custom-facebook-feed'); ?></option>
                                        <option value="Africa/Addis_Ababa" <?php if($cff_timezone == "Africa/Addis_Ababa") echo 'selected="selected"' ?> ><?php _e('(GMT+03:00) Nairobi', 'custom-facebook-feed'); ?></option>
                                        <option value="Asia/Tehran" <?php if($cff_timezone == "Asia/Tehran") echo 'selected="selected"' ?> ><?php _e('(GMT+03:30) Tehran', 'custom-facebook-feed'); ?></option>
                                        <option value="Asia/Dubai" <?php if($cff_timezone == "Asia/Dubai") echo 'selected="selected"' ?> ><?php _e('(GMT+04:00) Abu Dhabi, Muscat', 'custom-facebook-feed'); ?></option>
                                        <option value="Asia/Yerevan" <?php if($cff_timezone == "Asia/Yerevan") echo 'selected="selected"' ?> ><?php _e('(GMT+04:00) Yerevan', 'custom-facebook-feed'); ?></option>
                                        <option value="Asia/Kabul" <?php if($cff_timezone == "Asia/Kabul") echo 'selected="selected"' ?> ><?php _e('(GMT+04:30) Kabul', 'custom-facebook-feed'); ?></option>
                                        <option value="Asia/Yekaterinburg" <?php if($cff_timezone == "Asia/Yekaterinburg") echo 'selected="selected"' ?> ><?php _e('(GMT+05:00) Ekaterinburg', 'custom-facebook-feed'); ?></option>
                                        <option value="Asia/Tashkent" <?php if($cff_timezone == "Asia/Tashkent") echo 'selected="selected"' ?> ><?php _e('(GMT+05:00) Tashkent', 'custom-facebook-feed'); ?></option>
                                        <option value="Asia/Kolkata" <?php if($cff_timezone == "Asia/Kolkata") echo 'selected="selected"' ?> ><?php _e('(GMT+05:30) Chennai, Kolkata, Mumbai, New Delhi', 'custom-facebook-feed'); ?></option>
                                        <option value="Asia/Katmandu" <?php if($cff_timezone == "Asia/Katmandu") echo 'selected="selected"' ?> ><?php _e('(GMT+05:45) Kathmandu', 'custom-facebook-feed'); ?></option>
                                        <option value="Asia/Dhaka" <?php if($cff_timezone == "Asia/Dhaka") echo 'selected="selected"' ?> ><?php _e('(GMT+06:00) Astana, Dhaka', 'custom-facebook-feed'); ?></option>
                                        <option value="Asia/Novosibirsk" <?php if($cff_timezone == "Asia/Novosibirsk") echo 'selected="selected"' ?> ><?php _e('(GMT+06:00) Novosibirsk', 'custom-facebook-feed'); ?></option>
                                        <option value="Asia/Rangoon" <?php if($cff_timezone == "Asia/Rangoon") echo 'selected="selected"' ?> ><?php _e('(GMT+06:30) Yangon (Rangoon)', 'custom-facebook-feed'); ?></option>
                                        <option value="Asia/Bangkok" <?php if($cff_timezone == "Asia/Bangkok") echo 'selected="selected"' ?> ><?php _e('(GMT+07:00) Bangkok, Hanoi, Jakarta', 'custom-facebook-feed'); ?></option>
                                        <option value="Asia/Krasnoyarsk" <?php if($cff_timezone == "Asia/Krasnoyarsk") echo 'selected="selected"' ?> ><?php _e('(GMT+07:00) Krasnoyarsk', 'custom-facebook-feed'); ?></option>
                                        <option value="Asia/Hong_Kong" <?php if($cff_timezone == "Asia/Hong_Kong") echo 'selected="selected"' ?> ><?php _e('(GMT+08:00) Beijing, Chongqing, Hong Kong, Urumqi', 'custom-facebook-feed'); ?></option>
                                        <option value="Asia/Irkutsk" <?php if($cff_timezone == "Asia/Irkutsk") echo 'selected="selected"' ?> ><?php _e('(GMT+08:00) Irkutsk, Ulaan Bataar', 'custom-facebook-feed'); ?></option>
                                        <option value="Australia/Perth" <?php if($cff_timezone == "Australia/Perth") echo 'selected="selected"' ?> ><?php _e('(GMT+08:00) Perth', 'custom-facebook-feed'); ?></option>
                                        <option value="Australia/Eucla" <?php if($cff_timezone == "Australia/Eucla") echo 'selected="selected"' ?> ><?php _e('(GMT+08:45) Eucla', 'custom-facebook-feed'); ?></option>
                                        <option value="Asia/Tokyo" <?php if($cff_timezone == "Asia/Tokyo") echo 'selected="selected"' ?> ><?php _e('(GMT+09:00) Osaka, Sapporo, Tokyo', 'custom-facebook-feed'); ?></option>
                                        <option value="Asia/Seoul" <?php if($cff_timezone == "Asia/Seoul") echo 'selected="selected"' ?> ><?php _e('(GMT+09:00) Seoul', 'custom-facebook-feed'); ?></option>
                                        <option value="Asia/Yakutsk" <?php if($cff_timezone == "Asia/Yakutsk") echo 'selected="selected"' ?> ><?php _e('(GMT+09:00) Yakutsk', 'custom-facebook-feed'); ?></option>
                                        <option value="Australia/Adelaide" <?php if($cff_timezone == "Australia/Adelaide") echo 'selected="selected"' ?> ><?php _e('(GMT+09:30) Adelaide', 'custom-facebook-feed'); ?></option>
                                        <option value="Australia/Darwin" <?php if($cff_timezone == "Australia/Darwin") echo 'selected="selected"' ?> ><?php _e('(GMT+09:30) Darwin', 'custom-facebook-feed'); ?></option>
                                        <option value="Australia/Brisbane" <?php if($cff_timezone == "Australia/Brisbane") echo 'selected="selected"' ?> ><?php _e('(GMT+10:00) Brisbane', 'custom-facebook-feed'); ?></option>
                                        <option value="Australia/Hobart" <?php if($cff_timezone == "Australia/Hobart") echo 'selected="selected"' ?> ><?php _e('(GMT+10:00) Hobart', 'custom-facebook-feed'); ?></option>
                                        <option value="Asia/Vladivostok" <?php if($cff_timezone == "Asia/Vladivostok") echo 'selected="selected"' ?> ><?php _e('(GMT+10:00) Vladivostok', 'custom-facebook-feed'); ?></option>
                                        <option value="Australia/Lord_Howe" <?php if($cff_timezone == "Australia/Lord_Howe") echo 'selected="selected"' ?> ><?php _e('(GMT+10:30) Lord Howe Island', 'custom-facebook-feed'); ?></option>
                                        <option value="Etc/GMT-11" <?php if($cff_timezone == "Etc/GMT-11") echo 'selected="selected"' ?> ><?php _e('(GMT+11:00) Solomon Is., New Caledonia', 'custom-facebook-feed'); ?></option>
                                        <option value="Asia/Magadan" <?php if($cff_timezone == "Asia/Magadan") echo 'selected="selected"' ?> ><?php _e('(GMT+11:00) Magadan', 'custom-facebook-feed'); ?></option>
                                        <option value="Pacific/Norfolk" <?php if($cff_timezone == "Pacific/Norfolk") echo 'selected="selected"' ?> ><?php _e('(GMT+11:30) Norfolk Island', 'custom-facebook-feed'); ?></option>
                                        <option value="Asia/Anadyr" <?php if($cff_timezone == "Asia/Anadyr") echo 'selected="selected"' ?> ><?php _e('(GMT+12:00) Anadyr, Kamchatka', 'custom-facebook-feed'); ?></option>
                                        <option value="Pacific/Auckland" <?php if($cff_timezone == "Pacific/Auckland") echo 'selected="selected"' ?> ><?php _e('(GMT+12:00) Auckland, Wellington', 'custom-facebook-feed'); ?></option>
                                        <option value="Etc/GMT-12" <?php if($cff_timezone == "Etc/GMT-12") echo 'selected="selected"' ?> ><?php _e('(GMT+12:00) Fiji, Kamchatka, Marshall Is.', 'custom-facebook-feed'); ?></option>
                                        <option value="Pacific/Chatham" <?php if($cff_timezone == "Pacific/Chatham") echo 'selected="selected"' ?> ><?php _e('(GMT+12:45) Chatham Islands', 'custom-facebook-feed'); ?></option>
                                        <option value="Pacific/Tongatapu" <?php if($cff_timezone == "Pacific/Tongatapu") echo 'selected="selected"' ?> ><?php _e('(GMT+13:00) Nuku\'alofa', 'custom-facebook-feed'); ?></option>
                                        <option value="Pacific/Kiritimati" <?php if($cff_timezone == "Pacific/Kiritimati") echo 'selected="selected"' ?> ><?php _e('(GMT+14:00) Kiritimati', 'custom-facebook-feed'); ?></option>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <th><label class="bump-left"><?php _e('Custom format', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> datecustom
                        Eg: datecustom='D M jS, Y'</code></th>
                                <td>
                                    <input name="cff_date_custom" type="text" value="<?php esc_attr_e( $cff_date_custom, 'custom-facebook-feed' ); ?>" size="10" placeholder="Eg. F j, Y" />
                                    <a href="http://smashballoon.com/custom-facebook-feed/docs/date/" class="cff-external-link" target="_blank"><?php _e('Examples', 'custom-facebook-feed'); ?></a>
                                </td>
                            </tr>
                            <tr>
                                <th><label class="bump-left"><?php _e('Text before date', 'custom-facebook-feed'); ?></label></th>
                                <td><input name="cff_date_before" type="text" value="<?php esc_attr_e( $cff_date_before, 'custom-facebook-feed' ); ?>" size="20" placeholder="Eg. Posted" /></td>
                            </tr>
                            <tr>
                                <th><label class="bump-left"><?php _e('Text after date', 'custom-facebook-feed'); ?></label></th>
                                <td><input name="cff_date_after" type="text" value="<?php esc_attr_e( $cff_date_after, 'custom-facebook-feed' ); ?>" size="20" placeholder="Eg. by ___" /></td>
                            </tr>
                            <tr id="links"><!-- Quick link --></tr>
                            </tbody>
                        </table>
                    </div>
                </div>


                <div id="adminform" class="postbox" style="display: block;">
                    <div class="handlediv" title="Click to toggle"><br></div>
                    <h3 class="hndle"><span><?php _e('Shared Links', 'custom-facebook-feed'); ?></span></h3>
                    <div class="inside">
                        <table class="form-table">
                            <tbody>
                                <tr>
                                    <th><label class="bump-left"><?php _e('Link Title Format', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> linktitleformat
                        Eg: linktitleformat='h3'</code></th>
                                    <td>
                                        <select name="cff_link_title_format">
                                            <option value="p" <?php if($cff_link_title_format == "p") echo 'selected="selected"' ?> >Paragraph</option>
                                            <option value="h3" <?php if($cff_link_title_format == "h3") echo 'selected="selected"' ?> >Heading 3</option>
                                            <option value="h4" <?php if($cff_link_title_format == "h4") echo 'selected="selected"' ?> >Heading 4</option>
                                            <option value="h5" <?php if($cff_link_title_format == "h5") echo 'selected="selected"' ?> >Heading 5</option>
                                            <option value="h6" <?php if($cff_link_title_format == "h6") echo 'selected="selected"' ?> >Heading 6</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label class="bump-left"><?php _e('Link Title Size', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> linktitlesize
                        Eg: linktitlesize='18'</code></th>
                                    <td>
                                        <select name="cff_link_title_size">
                                            <option value="inherit" <?php if($cff_link_title_size == "inherit") echo 'selected="selected"' ?> >Inherit</option>
                                            <option value="10" <?php if($cff_link_title_size == "10") echo 'selected="selected"' ?> >10px</option>
                                            <option value="11" <?php if($cff_link_title_size == "11") echo 'selected="selected"' ?> >11px</option>
                                            <option value="12" <?php if($cff_link_title_size == "12") echo 'selected="selected"' ?> >12px</option>
                                            <option value="13" <?php if($cff_link_title_size == "13") echo 'selected="selected"' ?> >13px</option>
                                            <option value="14" <?php if($cff_link_title_size == "14") echo 'selected="selected"' ?> >14px</option>
                                            <option value="16" <?php if($cff_link_title_size == "16") echo 'selected="selected"' ?> >16px</option>
                                            <option value="18" <?php if($cff_link_title_size == "18") echo 'selected="selected"' ?> >18px</option>
                                            <option value="20" <?php if($cff_link_title_size == "20") echo 'selected="selected"' ?> >20px</option>
                                            <option value="24" <?php if($cff_link_title_size == "24") echo 'selected="selected"' ?> >24px</option>
                                            <option value="28" <?php if($cff_link_title_size == "28") echo 'selected="selected"' ?> >28px</option>
                                            <option value="32" <?php if($cff_link_title_size == "32") echo 'selected="selected"' ?> >32px</option>
                                            <option value="36" <?php if($cff_link_title_size == "36") echo 'selected="selected"' ?> >36px</option>
                                            <option value="42" <?php if($cff_link_title_size == "42") echo 'selected="selected"' ?> >42px</option>
                                            <option value="48" <?php if($cff_link_title_size == "48") echo 'selected="selected"' ?> >48px</option>
                                            <option value="54" <?php if($cff_link_title_size == "54") echo 'selected="selected"' ?> >54px</option>
                                            <option value="60" <?php if($cff_link_title_size == "60") echo 'selected="selected"' ?> >60px</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label class="bump-left"><?php _e('Link Title Color', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> linktitlecolor
                        Eg: linktitlecolor='ff0000'</code></th>
                                    <td>
                                        <input name="cff_link_title_color" value="#<?php esc_attr_e( str_replace('#', '', $cff_link_title_color), 'custom-facebook-feed' ); ?>" class="cff-colorpicker" />
                                    </td>
                                </tr>
                                <tr>
                                    <th><label class="bump-left"><?php _e('Link URL Color', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> linkurlcolor
                        Eg: linkurlcolor='999999'</code></th>
                                    <td>
                                        <input name="cff_link_url_color" value="#<?php esc_attr_e( str_replace('#', '', $cff_link_url_color), 'custom-facebook-feed' ); ?>" class="cff-colorpicker" />
                                    </td>
                                </tr>

                                <tr>
                                    <th><label class="bump-left"><?php _e('Link Box Background Color', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> linkbgcolor
                        Eg: linkbgcolor='EEE'</code></th>
                                    <td>
                                        <input name="cff_link_bg_color" value="#<?php esc_attr_e( str_replace('#', '', $cff_link_bg_color), 'custom-facebook-feed' ); ?>" class="cff-colorpicker" />
                                    </td>
                                </tr>

                                <tr>
                                    <th><label class="bump-left"><?php _e('Link Box Border Color', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> linkbordercolor
                        Eg: linkbordercolor='CCC'</code></th>
                                    <td>
                                        <input name="cff_link_border_color" value="#<?php esc_attr_e( str_replace('#', '', $cff_link_border_color), 'custom-facebook-feed' ); ?>" class="cff-colorpicker" />
                                    </td>
                                </tr>

                                <tr>
                                    <th><label class="bump-left"><?php _e('Remove Background/Border', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> disablelinkbox
                        Eg: disablelinkbox=true</code></th>
                                    <td><input type="checkbox" name="cff_disable_link_box" id="cff_disable_link_box" <?php if($cff_disable_link_box == true) echo 'checked="checked"' ?> />&nbsp;<?php _e('Yes', 'custom-facebook-feed'); ?></td>
                                </tr>
                                <tr id="eventtitle"><!-- Quick link --></tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div style="margin-top: -15px;">
                    <?php submit_button(); ?>
                </div>

                <div id="adminform" class="postbox" style="display: block;">
                    <div class="handlediv" title="Click to toggle"><br></div>
                    <h3 class="hndle"><span><?php _e('Event Title', 'custom-facebook-feed'); ?></span></h3>
                    <div class="inside">
                        <table class="form-table">
                            <tbody>
                            
                            <tr>
                                <th><label class="bump-left"><?php _e('Format', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> eventtitleformat
                        Eg: eventtitleformat=h5</code></th>
                                <td>
                                    <select name="cff_event_title_format">
                                        <option value="p" <?php if($cff_event_title_format == "p") echo 'selected="selected"' ?> >Paragraph</option>
                                        <option value="h3" <?php if($cff_event_title_format == "h3") echo 'selected="selected"' ?> >Heading 3</option>
                                        <option value="h4" <?php if($cff_event_title_format == "h4") echo 'selected="selected"' ?> >Heading 4</option>
                                        <option value="h5" <?php if($cff_event_title_format == "h5") echo 'selected="selected"' ?> >Heading 5</option>
                                        <option value="h6" <?php if($cff_event_title_format == "h6") echo 'selected="selected"' ?> >Heading 6</option>
                                    </select>
                                </td>
                            </tr>
                            
                            <tr>
                                <th><label class="bump-left"><?php _e('Text Size', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> eventtitlesize
                        Eg: eventtitlesize=12</code></th>
                                <td>
                                    <select name="cff_event_title_size">
                                        <option value="inherit" <?php if($cff_event_title_size == "inherit") echo 'selected="selected"' ?> >Inherit</option>
                                        <option value="10" <?php if($cff_event_title_size == "10") echo 'selected="selected"' ?> >10px</option>
                                        <option value="11" <?php if($cff_event_title_size == "11") echo 'selected="selected"' ?> >11px</option>
                                        <option value="12" <?php if($cff_event_title_size == "12") echo 'selected="selected"' ?> >12px</option>
                                        <option value="13" <?php if($cff_event_title_size == "13") echo 'selected="selected"' ?> >13px</option>
                                        <option value="14" <?php if($cff_event_title_size == "14") echo 'selected="selected"' ?> >14px</option>
                                        <option value="16" <?php if($cff_event_title_size == "16") echo 'selected="selected"' ?> >16px</option>
                                        <option value="18" <?php if($cff_event_title_size == "18") echo 'selected="selected"' ?> >18px</option>
                                        <option value="20" <?php if($cff_event_title_size == "20") echo 'selected="selected"' ?> >20px</option>
                                        <option value="24" <?php if($cff_event_title_size == "24") echo 'selected="selected"' ?> >24px</option>
                                        <option value="28" <?php if($cff_event_title_size == "28") echo 'selected="selected"' ?> >28px</option>
                                        <option value="32" <?php if($cff_event_title_size == "32") echo 'selected="selected"' ?> >32px</option>
                                        <option value="36" <?php if($cff_event_title_size == "36") echo 'selected="selected"' ?> >36px</option>
                                        <option value="42" <?php if($cff_event_title_size == "42") echo 'selected="selected"' ?> >42px</option>
                                        <option value="48" <?php if($cff_event_title_size == "48") echo 'selected="selected"' ?> >48px</option>
                                        <option value="54" <?php if($cff_event_title_size == "54") echo 'selected="selected"' ?> >54px</option>
                                        <option value="60" <?php if($cff_event_title_size == "60") echo 'selected="selected"' ?> >60px</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th><label class="bump-left"><?php _e('Text Weight', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> eventtitleweight
                        Eg: eventtitleweight=bold</code></th>
                                <td>
                                    <select name="cff_event_title_weight">
                                        <option value="inherit" <?php if($cff_event_title_weight == "inherit") echo 'selected="selected"' ?> >Inherit</option>
                                        <option value="normal" <?php if($cff_event_title_weight == "normal") echo 'selected="selected"' ?> >Normal</option>
                                        <option value="bold" <?php if($cff_event_title_weight == "bold") echo 'selected="selected"' ?> >Bold</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th><label class="bump-left"><?php _e('Text Color', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> eventtitlecolor
                        Eg: eventtitlecolor=666</code></th>
                                <td>
                                    <input name="cff_event_title_color" value="#<?php esc_attr_e( str_replace('#', '', $cff_event_title_color), 'custom-facebook-feed' ); ?>" class="cff-colorpicker" />
                                </td>
                            </tr>
                            <tr>
                                <th><label class="bump-left"><?php _e('Link title to Facebook event page?', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> eventtitlelink
                        Eg: eventtitlelink=true</code></th>
                                <td><input type="checkbox" name="cff_event_title_link" id="cff_event_title_link" <?php if($cff_event_title_link == true) echo 'checked="checked"' ?> />&nbsp;<?php _e('Yes', 'custom-facebook-feed'); ?></td>
                            </tr>
                            <tr id="eventdate"><!-- Quick link --></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <div id="adminform" class="postbox" style="display: block;">
                    <div class="handlediv" title="Click to toggle"><br></div>
                    <h3 class="hndle"><span><?php _e('Event Date', 'custom-facebook-feed'); ?></span></h3>
                    <div class="inside">
                        <table class="form-table">
                            <tbody>
                            
                            <tr>
                                <th><label class="bump-left"><?php _e('Text Size', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> eventdatesize
                        Eg: eventdatesize=18</code></th>
                                <td>
                                    <select name="cff_event_date_size">
                                        <option value="inherit" <?php if($cff_event_date_size == "inherit") echo 'selected="selected"' ?> >Inherit</option>
                                        <option value="10" <?php if($cff_event_date_size == "10") echo 'selected="selected"' ?> >10px</option>
                                        <option value="11" <?php if($cff_event_date_size == "11") echo 'selected="selected"' ?> >11px</option>
                                        <option value="12" <?php if($cff_event_date_size == "12") echo 'selected="selected"' ?> >12px</option>
                                        <option value="13" <?php if($cff_event_date_size == "13") echo 'selected="selected"' ?> >13px</option>
                                        <option value="14" <?php if($cff_event_date_size == "14") echo 'selected="selected"' ?> >14px</option>
                                        <option value="16" <?php if($cff_event_date_size == "16") echo 'selected="selected"' ?> >16px</option>
                                        <option value="18" <?php if($cff_event_date_size == "18") echo 'selected="selected"' ?> >18px</option>
                                        <option value="20" <?php if($cff_event_date_size == "20") echo 'selected="selected"' ?> >20px</option>
                                        <option value="24" <?php if($cff_event_date_size == "24") echo 'selected="selected"' ?> >24px</option>
                                        <option value="28" <?php if($cff_event_date_size == "28") echo 'selected="selected"' ?> >28px</option>
                                        <option value="32" <?php if($cff_event_date_size == "32") echo 'selected="selected"' ?> >32px</option>
                                        <option value="36" <?php if($cff_event_date_size == "36") echo 'selected="selected"' ?> >36px</option>
                                        <option value="42" <?php if($cff_event_date_size == "42") echo 'selected="selected"' ?> >42px</option>
                                        <option value="48" <?php if($cff_event_date_size == "48") echo 'selected="selected"' ?> >48px</option>
                                        <option value="54" <?php if($cff_event_date_size == "54") echo 'selected="selected"' ?> >54px</option>
                                        <option value="60" <?php if($cff_event_date_size == "60") echo 'selected="selected"' ?> >60px</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th><label class="bump-left"><?php _e('Text Weight', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> eventdateweight
                        Eg: eventdateweight=bold</code></th>
                                <td>
                                    <select name="cff_event_date_weight">
                                        <option value="inherit" <?php if($cff_event_date_weight == "inherit") echo 'selected="selected"' ?> >Inherit</option>
                                        <option value="normal" <?php if($cff_event_date_weight == "normal") echo 'selected="selected"' ?> >Normal</option>
                                        <option value="bold" <?php if($cff_event_date_weight == "bold") echo 'selected="selected"' ?> >Bold</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th><label class="bump-left"><?php _e('Text Color', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> eventdatecolor
                        Eg: eventdatecolor=EB6A00</code></th>
                                <td>
                                    <input name="cff_event_date_color" value="#<?php esc_attr_e( str_replace('#', '', $cff_event_date_color), 'custom-facebook-feed' ); ?>" class="cff-colorpicker" />
                                </td>
                            </tr>
                            <tr valign="top">
                                <th scope="row"><label class="bump-left"><?php _e('Date Position', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> eventdatepos
                        Eg: eventdatepos=below</code></th>
                                <td>
                                    <select name="cff_event_date_position">
                                        <option value="below" <?php if($cff_event_date_position == "below") echo 'selected="selected"' ?> ><?php _e('Below event title', 'custom-facebook-feed'); ?></option>
                                        <option value="above" <?php if($cff_event_date_position == "above") echo 'selected="selected"' ?> ><?php _e('Above event title', 'custom-facebook-feed'); ?></option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th><label class="bump-left"><?php _e('Event date formatting', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> eventdateformat
                        Eg: eventdateformat=12</code></th>
                                <td>
                                    <select name="cff_event_date_formatting">
                                        <?php $original = strtotime('2013-07-25T17:30:00+0000'); ?>
                                        <option value="14" <?php if($cff_event_date_formatting == "14") echo 'selected="selected"' ?> ><?php echo date('M j, g:ia', $original); ?></option>
                                        <option value="15" <?php if($cff_event_date_formatting == "15") echo 'selected="selected"' ?> ><?php echo date('M j, G:i', $original); ?></option>
                                        <option value="1" <?php if($cff_event_date_formatting == "1") echo 'selected="selected"' ?> ><?php echo date('F j, Y, g:ia', $original); ?></option>
                                        <option value="2" <?php if($cff_event_date_formatting == "2") echo 'selected="selected"' ?> ><?php echo date('F jS, g:ia', $original); ?></option>
                                        <option value="3" <?php if($cff_event_date_formatting == "3") echo 'selected="selected"' ?> ><?php echo date('g:ia - F jS', $original); ?></option>
                                        <option value="4" <?php if($cff_event_date_formatting == "4") echo 'selected="selected"' ?> ><?php echo date('g:ia, F jS', $original); ?></option>
                                        <option value="5" <?php if($cff_event_date_formatting == "5") echo 'selected="selected"' ?> ><?php echo date('l F jS - g:ia', $original); ?></option>
                                        <option value="6" <?php if($cff_event_date_formatting == "6") echo 'selected="selected"' ?> ><?php echo date('D M jS, Y, g:iA', $original); ?></option>
                                        <option value="7" <?php if($cff_event_date_formatting == "7") echo 'selected="selected"' ?> ><?php echo date('l F jS, Y, g:iA', $original); ?></option>
                                        <option value="8" <?php if($cff_event_date_formatting == "8") echo 'selected="selected"' ?> ><?php echo date('l F jS, Y - g:ia', $original); ?></option>
                                        <option value="9" <?php if($cff_event_date_formatting == "9") echo 'selected="selected"' ?> ><?php echo date("l M jS, 'y", $original); ?></option>
                                        <option value="10" <?php if($cff_event_date_formatting == "10") echo 'selected="selected"' ?> ><?php echo date('m.d.y - g:iA', $original); ?></option>
                                        <option value="11" <?php if($cff_event_date_formatting == "11") echo 'selected="selected"' ?> ><?php echo date('m/d/y, g:ia', $original); ?></option>
                                        <option value="12" <?php if($cff_event_date_formatting == "12") echo 'selected="selected"' ?> ><?php echo date('d.m.y - g:iA', $original); ?></option>
                                        <option value="13" <?php if($cff_event_date_formatting == "13") echo 'selected="selected"' ?> ><?php echo date('d/m/y, g:ia', $original); ?></option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th><label class="bump-left"><?php _e('Custom event date format', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> eventdatecustom
                        Eg: eventdatecustom='D M jS, Y'</code></th>
                                <td>
                                    <input name="cff_event_date_custom" type="text" value="<?php esc_attr_e( $cff_event_date_custom, 'custom-facebook-feed' ); ?>" size="10" placeholder="Eg. F j, Y - g:ia" />
                                    <a href="http://smashballoon.com/custom-facebook-feed/docs/date/" class="cff-external-link" target="_blank"><?php _e('Examples', 'custom-facebook-feed'); ?></a>
                                </td>
                            </tr>
                            <tr id="eventdetails"><!-- Quick link --></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="adminform" class="postbox" style="display: block;">
                    <div class="handlediv" title="Click to toggle"><br></div>
                    <h3 class="hndle"><span><?php _e('Event Details', 'custom-facebook-feed'); ?></span></h3>
                    <div class="inside">
                        <table class="form-table">
                            <tbody>
                            
                            <tr>
                                <th><label class="bump-left"><?php _e('Text Size', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> eventdetailssize
                        Eg: eventdetailssize=13</code></th>
                                <td>
                                    <select name="cff_event_details_size">
                                        <option value="inherit" <?php if($cff_event_details_size == "inherit") echo 'selected="selected"' ?> >Inherit</option>
                                        <option value="10" <?php if($cff_event_details_size == "10") echo 'selected="selected"' ?> >10px</option>
                                        <option value="11" <?php if($cff_event_details_size == "11") echo 'selected="selected"' ?> >11px</option>
                                        <option value="12" <?php if($cff_event_details_size == "12") echo 'selected="selected"' ?> >12px</option>
                                        <option value="13" <?php if($cff_event_details_size == "13") echo 'selected="selected"' ?> >13px</option>
                                        <option value="14" <?php if($cff_event_details_size == "14") echo 'selected="selected"' ?> >14px</option>
                                        <option value="16" <?php if($cff_event_details_size == "16") echo 'selected="selected"' ?> >16px</option>
                                        <option value="18" <?php if($cff_event_details_size == "18") echo 'selected="selected"' ?> >18px</option>
                                        <option value="20" <?php if($cff_event_details_size == "20") echo 'selected="selected"' ?> >20px</option>
                                        <option value="24" <?php if($cff_event_details_size == "24") echo 'selected="selected"' ?> >24px</option>
                                        <option value="28" <?php if($cff_event_details_size == "28") echo 'selected="selected"' ?> >28px</option>
                                        <option value="32" <?php if($cff_event_details_size == "32") echo 'selected="selected"' ?> >32px</option>
                                        <option value="36" <?php if($cff_event_details_size == "36") echo 'selected="selected"' ?> >36px</option>
                                        <option value="42" <?php if($cff_event_details_size == "42") echo 'selected="selected"' ?> >42px</option>
                                        <option value="48" <?php if($cff_event_details_size == "48") echo 'selected="selected"' ?> >48px</option>
                                        <option value="54" <?php if($cff_event_details_size == "54") echo 'selected="selected"' ?> >54px</option>
                                        <option value="60" <?php if($cff_event_details_size == "60") echo 'selected="selected"' ?> >60px</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th><label class="bump-left"><?php _e('Text Weight', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> eventdetailsweight
                        Eg: eventdetailsweight=bold</code></th>
                                <td>
                                    <select name="cff_event_details_weight">
                                        <option value="inherit" <?php if($cff_event_details_weight == "inherit") echo 'selected="selected"' ?> >Inherit</option>
                                        <option value="normal" <?php if($cff_event_details_weight == "normal") echo 'selected="selected"' ?> >Normal</option>
                                        <option value="bold" <?php if($cff_event_details_weight == "bold") echo 'selected="selected"' ?> >Bold</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th><label class="bump-left"><?php _e('Text Color', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> eventdetailscolor
                        Eg: eventdetailscolor=FFF000</code></th>
                                <td>
                                    <input name="cff_event_details_color" value="#<?php esc_attr_e( str_replace('#', '', $cff_event_details_color), 'custom-facebook-feed' ); ?>" class="cff-colorpicker" />
                                </td>
                            </tr>
                            <tr>
                                <th><label class="bump-left"><?php _e('Link Color', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> eventlinkcolor
                        Eg: eventlinkcolor=333</code></th>
                                <td>
                                    <input name="cff_event_link_color" value="#<?php esc_attr_e( str_replace('#', '', $cff_event_link_color), 'custom-facebook-feed' ); ?>" class="cff-colorpicker" />
                                </td>
                            </tr>
                            <tr id="action"><!-- Quick link --></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="adminform" class="postbox" style="display: block;">
                    <div class="handlediv" title="Click to toggle"><br></div>
                    <h3 class="hndle"><span><?php _e('Link to Facebook', 'custom-facebook-feed'); ?></span></h3>
                    <div class="inside">
                        <table class="form-table">
                            <tbody>
                                
                            <tr>
                                <th><label class="bump-left"><?php _e('Text Size', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> linksize
                        Eg: linksize=13</code></th>
                                <td>
                                    <select name="cff_link_size">
                                        <option value="inherit" <?php if($cff_link_size == "inherit") echo 'selected="selected"' ?> >Inherit</option>
                                        <option value="10" <?php if($cff_link_size == "10") echo 'selected="selected"' ?> >10px</option>
                                        <option value="11" <?php if($cff_link_size == "11") echo 'selected="selected"' ?> >11px</option>
                                        <option value="12" <?php if($cff_link_size == "12") echo 'selected="selected"' ?> >12px</option>
                                        <option value="13" <?php if($cff_link_size == "13") echo 'selected="selected"' ?> >13px</option>
                                        <option value="14" <?php if($cff_link_size == "14") echo 'selected="selected"' ?> >14px</option>
                                        <option value="16" <?php if($cff_link_size == "16") echo 'selected="selected"' ?> >16px</option>
                                        <option value="18" <?php if($cff_link_size == "18") echo 'selected="selected"' ?> >18px</option>
                                        <option value="20" <?php if($cff_link_size == "20") echo 'selected="selected"' ?> >20px</option>
                                        <option value="24" <?php if($cff_link_size == "24") echo 'selected="selected"' ?> >24px</option>
                                        <option value="28" <?php if($cff_link_size == "28") echo 'selected="selected"' ?> >28px</option>
                                        <option value="32" <?php if($cff_link_size == "32") echo 'selected="selected"' ?> >32px</option>
                                        <option value="36" <?php if($cff_link_size == "36") echo 'selected="selected"' ?> >36px</option>
                                        <option value="42" <?php if($cff_link_size == "42") echo 'selected="selected"' ?> >42px</option>
                                        <option value="48" <?php if($cff_link_size == "48") echo 'selected="selected"' ?> >48px</option>
                                        <option value="54" <?php if($cff_link_size == "54") echo 'selected="selected"' ?> >54px</option>
                                        <option value="60" <?php if($cff_link_size == "60") echo 'selected="selected"' ?> >60px</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th><label class="bump-left"><?php _e('Text Weight', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> linkweight
                        Eg: linkweight=bold</code></th>
                                <td>
                                    <select name="cff_link_weight">
                                        <option value="inherit" <?php if($cff_link_weight == "inherit") echo 'selected="selected"' ?> >Inherit</option>
                                        <option value="normal" <?php if($cff_link_weight == "normal") echo 'selected="selected"' ?> >Normal</option>
                                        <option value="bold" <?php if($cff_link_weight == "bold") echo 'selected="selected"' ?> >Bold</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th><label class="bump-left"><?php _e('Text Color', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> linkcolor
                        Eg: linkcolor=E01B5D</code></th>
                                <td>
                                    <input name="cff_link_color" value="#<?php esc_attr_e( str_replace('#', '', $cff_link_color), 'custom-facebook-feed' ); ?>" class="cff-colorpicker" />
                                </td>
                            </tr>
                            <tr>
                                <th><label class="bump-left"><?php _e('"View on Facebook" Text', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> facebooklinktext
                        Eg: facebooklinktext='Read more...'</code></th>
                                <td>
                                    <input name="cff_facebook_link_text" type="text" value="<?php echo stripslashes( esc_attr( $cff_facebook_link_text ) ); ?>" size="25" />
                                </td>
                            </tr>

                            <tr>
                                <th><label class="bump-left"><?php _e('"Share" Text', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> sharelinktext
                        Eg: sharelinktext='Share this post'</code></th>
                                <td>
                                    <input name="cff_facebook_share_text" type="text" value="<?php echo stripslashes( esc_attr( $cff_facebook_share_text ) ); ?>" size="25" />
                                </td>
                            </tr>

                            <tr>
                                <th><label class="bump-left"><?php _e('Show "View on Facebook" link', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> showfacebooklink
                        Eg: showfacebooklink=true</code></th>
                                <td>
                                    <input type="checkbox" name="cff_show_facebook_link" id="cff_show_facebook_link" <?php if($cff_show_facebook_link == true) echo 'checked="checked"' ?> />&nbsp;<?php _e('Yes', 'custom-facebook-feed'); ?>
                                </td>
                            </tr>

                            <tr>
                                <th><label class="bump-left"><?php _e('Show "Share" link', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> showsharelink
                        Eg: showsharelink=true</code></th>
                                <td>
                                    <input type="checkbox" name="cff_show_facebook_share" id="cff_show_facebook_share" <?php if($cff_show_facebook_share == true) echo 'checked="checked"' ?> />&nbsp;<?php _e('Yes', 'custom-facebook-feed'); ?>
                                </td>
                            </tr>
                            
                        </tbody>
                    </table>
                    </div>
                </div>
                </div>
            </div>
            <div style="margin-top: -15px;">
                <?php submit_button(); ?>
            </div>

            <a href="https://smashballoon.com/custom-facebook-feed/demo" target="_blank"><img src="<?php echo plugins_url( 'img/pro.png' , __FILE__ ) ?>" /></a>
            
            <?php } //End Typography tab ?>
            <?php if( $cff_active_tab == 'misc' ) { //Start Misc tab ?>

            <p class="cff_contents_links" id="comments">
                <span>Quick links: </span>
                <a href="#comments">Likes, Shares and Comments</a>
                <a href="#likebox">Like Box / Page Plugin</a>
                <a href="#css">Custom CSS</a>
                <a href="#js">Custom JavaScript</a>
                <a href="#misc">Misc Settings</a>
            </p>

            <input type="hidden" name="<?php echo $style_misc_hidden_field_name; ?>" value="Y">
            <br />
            <h3><?php _e('Likes, Shares and Comments', 'custom-facebook-feed'); ?></h3><i style="color: #666; font-size: 11px;"><a href="https://smashballoon.com/custom-facebook-feed/" target="_blank"><?php _e('Upgrade to Pro to enable likes, shares and comments', 'custom-facebook-feed'); ?></a></i>
            
            <hr id="likebox" /><!-- Quick link -->
            <h3><?php _e('Like Box / Page Plugin', 'custom-facebook-feed'); ?></h3>
            <table class="form-table">
                <tbody>
                    <tr valign="top">
                        <th class="bump-left" scope="row"><label><?php _e('Show the Like Box', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> include  exclude
                        Eg: include/exclude=likebox</code></th>
                        <td>
                            <input type="checkbox" name="cff_show_like_box" id="cff_show_like_box" <?php if($cff_show_like_box == true) echo 'checked="checked"' ?> />&nbsp;<?php _e('Yes', 'custom-facebook-feed'); ?>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th class="bump-left" scope="row"><label><?php _e('Position', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> likeboxpos
                        Eg: likeboxpos=top</code></th>
                        <td>
                            <select name="cff_like_box_position">
                                <option value="bottom" <?php if($cff_like_box_position == "bottom") echo 'selected="selected"' ?> ><?php _e('Bottom', 'custom-facebook-feed'); ?></option>
                                <option value="top" <?php if($cff_like_box_position == "top") echo 'selected="selected"' ?> ><?php _e('Top', 'custom-facebook-feed'); ?></option>
                            </select>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th class="bump-left" scope="row"><label><?php _e('Display outside the scrollable area', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> likeboxoutside
                        Eg: likeboxoutside=true</code></th>
                        <td>
                            <input type="checkbox" name="cff_like_box_outside" id="cff_like_box_outside" <?php if($cff_like_box_outside == true) echo 'checked="checked"' ?> />&nbsp;<?php _e('Yes', 'custom-facebook-feed'); ?>
                            <i style="color: #666; font-size: 11px; margin-left: 5px;"><?php _e('Only applicable if you have set a height on the feed', 'custom-facebook-feed'); ?></i>
                        </td>
                    </tr>
                
                    <tr valign="top">
                        <th class="bump-left" scope="row"><label><?php _e('Show faces of fans', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> likeboxfaces
                        Eg: likeboxfaces=true</code></th>
                        <td>
                            <input type="checkbox" name="cff_like_box_faces" id="cff_like_box_faces" <?php if($cff_like_box_faces == true) echo 'checked="checked"' ?> />&nbsp;<?php _e('Yes', 'custom-facebook-feed'); ?>
                            <i style="color: #666; font-size: 11px; margin-left: 5px;"><?php _e('Show thumbnail photos of fans who like your page', 'custom-facebook-feed'); ?></i>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th class="bump-left" scope="row"><label><?php _e('Include the Cover Photo', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> likeboxcover
                        Eg: likeboxcover=true</code></th>
                        <td>
                            <input type="checkbox" name="cff_like_box_cover" id="cff_like_box_cover" <?php if($cff_like_box_cover == true) echo 'checked="checked"' ?> />&nbsp;<?php _e('Yes', 'custom-facebook-feed'); ?>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th class="bump-left" scope="row"><label><?php _e('Use a small header', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> likeboxsmallheader
                        Eg: likeboxsmallheader=true</code></th>
                        <td>
                            <input type="checkbox" name="cff_like_box_small_header" id="cff_like_box_small_header" <?php if($cff_like_box_small_header == true) echo 'checked="checked"' ?> />&nbsp;<?php _e('Yes', 'custom-facebook-feed'); ?>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th class="bump-left" scope="row"><label><?php _e('Hide the call to action button (if available)', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> likeboxhidebtn
                        Eg: likeboxhidebtn=true</code></th>
                        <td>
                            <input type="checkbox" name="cff_like_box_hide_cta" id="cff_like_box_hide_cta" <?php if($cff_like_box_hide_cta == true) echo 'checked="checked"' ?> />&nbsp;<?php _e('Yes', 'custom-facebook-feed'); ?>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th class="bump-left" for="cff_likebox_width" scope="row"><label><?php _e('Custom Like Box Width', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> likeboxwidth
                        Eg: likeboxwidth=500</code></th>
                        <td>
                            <input name="cff_likebox_width" type="text" value="<?php esc_attr_e( $cff_likebox_width, 'custom-facebook-feed' ); ?>" size="3" />
                            <span>px <i style="color: #666; font-size: 11px; margin-left: 5px;"><?php _e('Default: 340, Min: 280, Max: 500', 'custom-facebook-feed'); ?></i></span>
                        </td>
                    </tr>
                </tbody>
            </table>

            <?php submit_button(); ?>
            <span id="css"><!-- Quick link --></span>
            <hr />
            <h3><?php _e('Custom CSS', 'custom-facebook-feed'); ?></h3>
            <table class="form-table">
                <tbody>
                    <tr valign="top">
                        <td>
                        <?php _e('Enter your own custom CSS in the box below', 'custom-facebook-feed'); ?>
                        <i style="margin-left: 5px; font-size: 11px;"><a href="https://smashballoon.com/custom-facebook-feed/docs/snippets/" target="_blank"><?php _e('See some examples', 'custom-facebook-feed'); ?></a></i>
                        </td>
                    </tr>
                    <tr valign="top" id="js"><!-- Quick link -->
                        <td>
                            <textarea name="cff_custom_css" id="cff_custom_css" style="width: 70%;" rows="7"><?php echo esc_textarea( stripslashes($cff_custom_css), 'custom-facebook-feed' ); ?></textarea>
                        </td>
                    </tr>
                </tbody>
            </table>
            <h3><?php _e('Custom JavaScript', 'custom-facebook-feed'); ?></h3>
            <table class="form-table">
                <tbody>
                    <tr valign="top">
                        <td>
                        <?php _e('Enter your own custom JavaScript/jQuery in the box below', 'custom-facebook-feed'); ?>
                        <i style="margin-left: 5px; font-size: 11px;"><a href="https://smashballoon.com/custom-facebook-feed/docs/snippets/" target="_blank"><?php _e('See some examples', 'custom-facebook-feed'); ?></a></i>
                        </td>
                    </tr>
                    <tr valign="top">
                        <td>
                            <textarea name="cff_custom_js" id="cff_custom_js" style="width: 70%;" rows="7"><?php echo esc_textarea( stripslashes($cff_custom_js), 'custom-facebook-feed' ); ?></textarea>
                        </td>
                    </tr>
                    <tr id="misc"><!-- Quick link --></tr>
                </tbody>
            </table>


            <hr />
            <h3><?php _e('Misc Settings', 'custom-facebook-feed'); ?></h3>
            <table class="form-table">
                <tbody>
                    <tr>
                        <th class="bump-left"><label class="bump-left"><?php _e('Is your theme loading the feed via Ajax?', 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> ajax
                        Eg: ajax=true</code></th>
                        <td>
                            <input name="cff_ajax" type="checkbox" id="cff_ajax" <?php if($cff_ajax_val == true) echo "checked"; ?> />
                            <label for="cff_ajax"><?php _e('Yes', 'custom-facebook-feed'); ?></label>
                            <a class="cff-tooltip-link" href="JavaScript:void(0);"><?php _e('What does this mean?', 'custom-facebook-feed'); ?></a>
                            <p class="cff-tooltip cff-more-info"><?php _e('Some modern WordPress themes use Ajax to load content into the page after it has loaded. If your theme uses Ajax to load the Custom Facebook Feed content into the page then check this box. If you are not sure then please check with the theme author.', 'custom-facebook-feed'); ?></p>
                        </td>
                    </tr>
                    <tr>
                        <th class="bump-left"><label class="bump-left"><?php _e('Facebook App ID', 'custom-facebook-feed'); ?></label></th>
                        <td>
                            <input name="cff_app_id" type="text" value="<?php esc_attr_e( $cff_app_id, 'custom-facebook-feed' ); ?>" size="18" />
                            <a class="cff-tooltip-link" href="JavaScript:void(0);"><?php _e('What is this?', 'custom-facebook-feed'); ?></a>
                            <p class="cff-tooltip cff-more-info"><?php _e("If you've registered as a Facebook developer and have an App ID then you can enter it here. You can add your website to your Facebook App by going to your App Settings, clicking 'Add Platform' and then entering your website URL.", 'custom-facebook-feed'); ?></p>
                        </td>
                    </tr>
                    <tr>
                        <th class="bump-left"><label class="bump-left"><?php _e("Preserve settings when plugin is removed", 'custom-facebook-feed'); ?></label></th>
                        <td>
                            <input name="cff_preserve_settings" type="checkbox" id="cff_preserve_settings" <?php if($cff_preserve_settings_val == true) echo "checked"; ?> />
                            <label for="cff_preserve_settings"><?php _e('Yes', 'custom-facebook-feed'); ?></label>
                            <a class="cff-tooltip-link" href="JavaScript:void(0);"><?php _e('What does this mean?', 'custom-facebook-feed'); ?></a>
                            <p class="cff-tooltip cff-more-info"><?php _e('When removing the plugin your settings are automatically deleted from your database. Checking this box will prevent any settings from being deleted. This means that you can uninstall and reinstall the plugin without losing your settings.', 'custom-facebook-feed'); ?></p>
                        </td>
                    </tr>
                    <tr>
                        <th class="bump-left"><label class="bump-left"><?php _e("Display credit link", 'custom-facebook-feed'); ?></label><code class="cff_shortcode"> credit
                        Eg: credit=true</code></th>
                        <td>
                            <input name="cff_show_credit" type="checkbox" id="cff_show_credit" <?php if($cff_show_credit == true) echo "checked"; ?> />
                            <label for="cff_show_credit"><?php _e('Yes', 'custom-facebook-feed'); ?></label>
                            <i style="color: #666; font-size: 11px; margin-left: 5px;"><?php _e('Display a link at the bottom of the feed to help promote the plugin', 'custom-facebook-feed'); ?></i>
                        </td>
                    </tr>

                    <tr>
                        <th class="bump-left"><label class="bump-left"><?php _e("Icon font source", 'custom-facebook-feed'); ?></label></th>
                        <td>
                            <select name="cff_font_source">
                                <option value="cdn" <?php if($cff_font_source == "cdn") echo 'selected="selected"' ?> ><?php _e('CDN', 'custom-facebook-feed'); ?></option>
                                <option value="local" <?php if($cff_font_source == "local") echo 'selected="selected"' ?> ><?php _e('Local copy', 'custom-facebook-feed'); ?></option>
                                <option value="none" <?php if($cff_font_source == "none") echo 'selected="selected"' ?> ><?php _e("Don't load", 'custom-facebook-feed'); ?></option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <th class="bump-left">
                            <label class="bump-left"><?php _e("Force cache to clear on interval", 'custom-facebook-feed'); ?></label>
                        </th>
                        <td>
                            <select name="cff_cron">
                                <option value="unset" <?php if($cff_cron == "unset") echo 'selected="selected"' ?> ><?php _e(' - ', 'custom-facebook-feed'); ?></option>
                                <option value="yes" <?php if($cff_cron == "yes") echo 'selected="selected"' ?> ><?php _e('Yes', 'custom-facebook-feed'); ?></option>
                                <option value="no" <?php if($cff_cron == "no") echo 'selected="selected"' ?> ><?php _e('No', 'custom-facebook-feed'); ?></option>
                            </select>

                            <a class="cff-tooltip-link" href="JavaScript:void(0);"><?php _e('What does this mean?', 'custom-facebook-feed'); ?></a>
                            <p class="cff-tooltip cff-more-info"><?php _e("If you're experiencing an issue with the plugin not auto-updating then you can set this to 'Yes' to run a scheduled event behind the scenes which forces the plugin cache to clear on a regular basis and retrieve new data from Facebook.", 'custom-facebook-feed'); ?></p>
                        </td>
                    </tr>

                    <tr>
                        <th class="bump-left"><label class="bump-left"><?php _e("Request method", 'custom-facebook-feed'); ?></label></th>
                        <td>
                            <select name="cff_request_method">
                                <option value="auto" <?php if($cff_request_method == "auto") echo 'selected="selected"' ?> ><?php _e('Auto', 'custom-facebook-feed'); ?></option>
                                <option value="1" <?php if($cff_request_method == "1") echo 'selected="selected"' ?> ><?php _e('cURL', 'custom-facebook-feed'); ?></option>
                                <option value="2" <?php if($cff_request_method == "2") echo 'selected="selected"' ?> ><?php _e('file_get_contents', 'custom-facebook-feed'); ?></option>
                                <option value="3" <?php if($cff_request_method == "3") echo 'selected="selected"' ?> ><?php _e("WP_Http", 'custom-facebook-feed'); ?></option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <th class="bump-left"><label for="cff_disable_styles" class="bump-left"><?php _e("Disable default styles", 'custom-facebook-feed'); ?></label></th>
                        <td>
                            <input name="cff_disable_styles" type="checkbox" id="cff_disable_styles" <?php if($cff_disable_styles == true) echo "checked"; ?> />
                            <label for="cff_disable_styles"><?php _e('Yes', 'custom-facebook-feed'); ?></label>
                            <a class="cff-tooltip-link" href="JavaScript:void(0);"><?php _e('What does this do?', 'custom-facebook-feed'); ?></a>
                            <p class="cff-tooltip cff-more-info"><?php _e("The plugin includes some basic text and link styles which can be disabled by enabling this setting. Note that the styles used for the layout of the posts will still be applied.", 'custom-facebook-feed'); ?></p>
                        </td>
                    </tr>

                </tbody>
            </table>

            <?php submit_button(); ?>
            <a href="https://smashballoon.com/custom-facebook-feed/demo" target="_blank"><img src="<?php echo plugins_url( 'img/pro.png' , __FILE__ ) ?>" /></a>
            <?php } //End Misc tab ?>


            <?php if( $cff_active_tab == 'custom_text' ) { //Start Custom Text tab ?>

            <p class="cff_contents_links">
                <span>Quick links: </span>
                <a href="#text">Post Text</a>
                <a href="#action">Post Action Links</a>
                <a href="#medialink">Media Links</a>
                <a href="#date">Date</a>
            </p>

            <input type="hidden" name="<?php echo $style_custom_text_hidden_field_name; ?>" value="Y">
            <br />
            <h3><?php _e('Custom Text / Translate', 'custom-facebook-feed'); ?></h3>
            <p><?php _e('Enter custom text for the words below, or translate it into the language you would like to use.', 'custom-facebook-feed'); ?></p>
            <table class="form-table cff-translate-table" style="width: 100%; max-width: 940px;">
                <tbody>

                    <thead id="text">
                        <tr>
                            <th><?php _e('Original Text', 'custom-facebook-feed'); ?></th>
                            <th><?php _e('Custom Text / Translation', 'custom-facebook-feed'); ?></th>
                            <th><?php _e('Context', 'custom-facebook-feed'); ?></th>
                        </tr>
                    </thead>

                    <tr class="cff-table-header"><th colspan="3"><?php _e('Post Text', 'custom-facebook-feed'); ?></th></tr>
                    <tr>
                        <td><label for="cff_see_more_text" class="bump-left"><?php _e('See More', 'custom-facebook-feed'); ?></label></td>
                        <td><input name="cff_see_more_text" type="text" value="<?php echo stripslashes( esc_attr( $cff_see_more_text ) ); ?>" /></td>
                        <td class="cff-context"><?php _e('Used when truncating the post text', 'custom-facebook-feed'); ?></td>
                    </tr>

                    <tr id="action"><!-- Quick link -->
                        <td><label for="cff_see_less_text" class="bump-left"><?php _e('See Less', 'custom-facebook-feed'); ?></label></td>
                        <td><input name="cff_see_less_text" type="text" value="<?php echo stripslashes( esc_attr( $cff_see_less_text ) ); ?>" /></td>
                        <td class="cff-context"><?php _e('Used when truncating the post text', 'custom-facebook-feed'); ?></td>
                    </tr>

                    <tr class="cff-table-header"><th colspan="3"><?php _e('Post Action Links', 'custom-facebook-feed'); ?></th></tr>
                    <tr>
                        <td><label for="cff_facebook_link_text" class="bump-left"><?php _e('View on Facebook', 'custom-facebook-feed'); ?></label></td>
                        <td><input name="cff_facebook_link_text" type="text" value="<?php echo stripslashes( esc_attr( $cff_facebook_link_text ) ); ?>" /></td>
                        <td class="cff-context"><?php _e('Used for the link to the post on Facebook', 'custom-facebook-feed'); ?></td>
                    </tr>
                    <tr>
                        <td><label for="cff_facebook_share_text" class="bump-left"><?php _e('Share', 'custom-facebook-feed'); ?></label></td>
                        <td><input name="cff_facebook_share_text" type="text" value="<?php echo stripslashes( esc_attr( $cff_facebook_share_text ) ); ?>" /></td>
                        <td class="cff-context"><?php _e('Used for sharing the Facebook post via Social Media', 'custom-facebook-feed'); ?></td>
                    </tr>

                    <tr id="medialink"><!-- Quick link -->
                        <td><label for="cff_translate_photos_text" class="bump-left"><?php _e('photos', 'custom-facebook-feed'); ?></label></td>
                        <td><input name="cff_translate_photos_text" type="text" value="<?php echo stripslashes( esc_attr( $cff_translate_photos_text ) ); ?>" /></td>
                        <td class="cff-context"><?php _e('Added to the end of an album name. Eg. (6 photos)', 'custom-facebook-feed'); ?></td>
                    </tr>

                    <tr class="cff-table-header"><th colspan="3"><?php _e('Media Links', 'custom-facebook-feed'); ?></th></tr>
                    <tr>
                        <td><label for="cff_translate_photo_text" class="bump-left"><?php _e('Photo', 'custom-facebook-feed'); ?></label></td>
                        <td><input name="cff_translate_photo_text" type="text" value="<?php echo stripslashes( esc_attr( $cff_translate_photo_text ) ); ?>" /></td>
                        <td class="cff-context"><?php _e('Used to link to photos on Facebook', 'custom-facebook-feed'); ?></td>
                    </tr>
                    <tr id="date"><!-- Quick link -->
                        <td><label for="cff_translate_video_text" class="bump-left"><?php _e('Video', 'custom-facebook-feed'); ?></label></td>
                        <td><input name="cff_translate_video_text" type="text" value="<?php echo stripslashes( esc_attr( $cff_translate_video_text ) ); ?>" /></td>
                        <td class="cff-context"><?php _e('Used to link to videos on Facebook', 'custom-facebook-feed'); ?></td>
                    </tr>
                    
                    <tr class="cff-table-header"><th colspan="3"><?php _e('Date', 'custom-facebook-feed'); ?></th></tr>
                    <tr>
                        <td><label for="cff_photos_text" class="bump-left"><?php _e('"Posted _ hours ago" text', 'custom-facebook-feed'); ?></label></td>
                        <td class="cff-translate-date">

                            <label for="cff_translate_second"><?php _e("second", 'custom-facebook-feed'); ?></label>
                            <input name="cff_translate_second" type="text" value="<?php echo stripslashes( esc_attr( $cff_translate_second ) ); ?>" size="20" />
                            <br />
                            <label for="cff_translate_seconds"><?php _e("seconds", 'custom-facebook-feed'); ?></label>
                            <input name="cff_translate_seconds" type="text" value="<?php echo stripslashes( esc_attr( $cff_translate_seconds ) ); ?>" size="20" />
                            <br />
                            <label for="cff_translate_minute"><?php _e("minute", 'custom-facebook-feed'); ?></label>
                            <input name="cff_translate_minute" type="text" value="<?php echo stripslashes( esc_attr( $cff_translate_minute ) ); ?>" size="20" />
                            <br />
                            <label for="cff_translate_minutes"><?php _e("minutes", 'custom-facebook-feed'); ?></label>
                            <input name="cff_translate_minutes" type="text" value="<?php echo stripslashes( esc_attr( $cff_translate_minutes ) ); ?>" size="20" />
                            <br />
                            <label for="cff_translate_hour"><?php _e("hour", 'custom-facebook-feed'); ?></label>
                            <input name="cff_translate_hour" type="text" value="<?php echo stripslashes( esc_attr( $cff_translate_hour ) ); ?>" size="20" />
                            <br />
                            <label for="cff_translate_hours"><?php _e("hours", 'custom-facebook-feed'); ?></label>
                            <input name="cff_translate_hours" type="text" value="<?php echo stripslashes( esc_attr( $cff_translate_hours ) ); ?>" size="20" />
                            <br />
                            <label for="cff_translate_day"><?php _e("day", 'custom-facebook-feed'); ?></label>
                            <input name="cff_translate_day" type="text" value="<?php echo stripslashes( esc_attr( $cff_translate_day ) ); ?>" size="20" />
                            <br />
                            <label for="cff_translate_days"><?php _e("days", 'custom-facebook-feed'); ?></label>
                            <input name="cff_translate_days" type="text" value="<?php echo stripslashes( esc_attr( $cff_translate_days ) ); ?>" size="20" />
                            <br />
                            <label for="cff_translate_week"><?php _e("week", 'custom-facebook-feed'); ?></label>
                            <input name="cff_translate_week" type="text" value="<?php echo stripslashes( esc_attr( $cff_translate_week ) ); ?>" size="20" />
                            <br />
                            <label for="cff_translate_weeks"><?php _e("weeks", 'custom-facebook-feed'); ?></label>
                            <input name="cff_translate_weeks" type="text" value="<?php echo stripslashes( esc_attr( $cff_translate_weeks ) ); ?>" size="20" />
                            <br />
                            <label for="cff_translate_month"><?php _e("month", 'custom-facebook-feed'); ?></label>
                            <input name="cff_translate_month" type="text" value="<?php echo stripslashes( esc_attr( $cff_translate_month ) ); ?>" size="20" />
                            <br />
                            <label for="cff_translate_months"><?php _e("months", 'custom-facebook-feed'); ?></label>
                            <input name="cff_translate_months" type="text" value="<?php echo stripslashes( esc_attr( $cff_translate_months ) ); ?>" size="20" />
                            <br />
                            <label for="cff_translate_year"><?php _e("year", 'custom-facebook-feed'); ?></label>
                            <input name="cff_translate_year" type="text" value="<?php echo stripslashes( esc_attr( $cff_translate_year ) ); ?>" size="20" />
                            <br />
                            <label for="cff_translate_years"><?php _e("years", 'custom-facebook-feed'); ?></label>
                            <input name="cff_translate_years" type="text" value="<?php echo stripslashes( esc_attr( $cff_translate_years ) ); ?>" size="20" />
                            <br />
                            <label for="cff_translate_ago"><?php _e("ago", 'custom-facebook-feed'); ?></label>
                            <input name="cff_translate_ago" type="text" value="<?php echo stripslashes( esc_attr( $cff_translate_ago ) ); ?>" size="20" />
                        </td>
                        <td class="cff-context"><?php _e('Used to translate the "Posted _ days ago" date text', 'custom-facebook-feed'); ?></td>
                    </tr>

                </tbody>
            </table>
            
            <?php submit_button(); ?>
            <a href="https://smashballoon.com/custom-facebook-feed/demo" target="_blank"><img src="<?php echo plugins_url( 'img/pro.png' , __FILE__ ) ?>" /></a>
            <?php } //End Custom Text tab ?>

        </form>

        <hr />
        <h3><?php _e('Like the plugin? Help spread the word!', 'custom-facebook-feed'); ?></h3>

        <!-- TWITTER -->
        <a href="https://twitter.com/share" class="twitter-share-button" data-url="https://wordpress.org/plugins/custom-facebook-feed/" data-text="Display your Facebook posts on your site your way using the Custom Facebook Feed WordPress plugin!" data-via="smashballoon" data-dnt="true">Tweet</a>
        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
        <style type="text/css">
        #twitter-widget-0{ float: left; width: 100px !important; }
        .IN-widget{ margin-right: 20px; }
        </style>

        <!-- FACEBOOK -->
        <div id="fb-root" style="display: none;"></div>
        <script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&appId=640861236031365&version=v2.0";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
        <div class="fb-like" data-href="https://wordpress.org/plugins/custom-facebook-feed/" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true" style="display: block; float: left; margin-right: 20px;"></div>

        <!-- LINKEDIN -->
        <script src="//platform.linkedin.com/in.js" type="text/javascript">
          lang: en_US
        </script>
        <script type="IN/Share" data-url="https://wordpress.org/plugins/custom-facebook-feed/"></script>

        <!-- GOOGLE + -->
        <script src="https://apis.google.com/js/platform.js" async defer></script>
        <div class="g-plusone" data-size="medium" data-href="https://wordpress.org/plugins/custom-facebook-feed/"></div>

<?php 
} //End Style_Page
//Enqueue admin styles
function cff_admin_style() {
        wp_register_style( 'custom_wp_admin_css', plugin_dir_url( __FILE__ ) . 'css/cff-admin-style.css', false, CFFVER );
        wp_enqueue_style( 'custom_wp_admin_css' );
        wp_enqueue_style( 'cff-font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css', array(), '4.5.0' );
        wp_enqueue_style( 'wp-color-picker' );
}
add_action( 'admin_enqueue_scripts', 'cff_admin_style' );
//Enqueue admin scripts
function cff_admin_scripts() {
    wp_enqueue_script( 'cff_admin_script', plugin_dir_url( __FILE__ ) . 'js/cff-admin-scripts.js', false, CFFVER );
    if( !wp_script_is('jquery-ui-draggable') ) { 
        wp_enqueue_script(
            array(
            'jquery',
            'jquery-ui-core',
            'jquery-ui-draggable'
            )
        );
    }
    wp_enqueue_script(
        array(
        'hoverIntent',
        'wp-color-picker'
        )
    );
}
add_action( 'admin_enqueue_scripts', 'cff_admin_scripts' );

// Add a Settings link to the plugin on the Plugins page
$cff_plugin_file = 'custom-facebook-feed/custom-facebook-feed.php';
add_filter( "plugin_action_links_{$cff_plugin_file}", 'cff_add_settings_link', 10, 2 );
 
//modify the link by unshifting the array
function cff_add_settings_link( $links, $file ) {
    $cff_settings_link = '<a href="' . admin_url( 'admin.php?page=cff-top' ) . '">' . __( 'Settings', 'cff-top', 'custom-facebook-feed' ) . '</a>';
    array_unshift( $links, $cff_settings_link );
 
    return $links;
}


//Cron job to clear transients
add_action('cff_cron_job', 'cff_cron_clear_cache');
function cff_cron_clear_cache() {
    //Delete all transients
    global $wpdb;
    $table_name = $wpdb->prefix . "options";
    $wpdb->query( "
        DELETE
        FROM $table_name
        WHERE `option_name` LIKE ('%\_transient\_cff\_%')
        " );
    $wpdb->query( "
        DELETE
        FROM $table_name
        WHERE `option_name` LIKE ('%\_transient\_cff\_tle\_%')
        " );
    $wpdb->query( "
        DELETE
        FROM $table_name
        WHERE `option_name` LIKE ('%\_transient\_timeout\_cff\_%')
        " );
}



//REVIEW REQUEST NOTICE

// checks $_GET to see if the nag variable is set and what it's value is
function cff_check_nag_get( $get, $nag, $option, $transient ) {
    if ( isset( $_GET[$nag] ) && $get[$nag] == 1 ) {
        update_option( $option, 'dismissed' );
    } elseif ( isset( $_GET[$nag] ) && $get[$nag] == 'later' ) {
        $time = 4 * WEEK_IN_SECONDS;
        set_transient( $transient, 'waiting', $time );
        update_option( $option, 'pending' );
    }
}

// will set a transient if the notice hasn't been dismissed or hasn't been set yet
function cff_maybe_set_transient( $transient, $option ) {
    $cff_rating_notice_waiting = get_transient( $transient );
    $notice_status = get_option( $option, false );

    if ( ! $cff_rating_notice_waiting && !( $notice_status === 'dismissed' || $notice_status === 'pending' ) ) {
        $time = 4 * WEEK_IN_SECONDS;
        set_transient( $transient, 'waiting', $time );
        update_option( $option, 'pending' );
    }
}

// generates the html for the admin notice
function cff_rating_notice_html() {

    //Only show to admins
    if ( current_user_can( 'manage_options' ) ){

        global $current_user;
        $user_id = $current_user->ID;

        /* Check that the user hasn't already clicked to ignore the message */
        if ( ! get_user_meta( $user_id, 'cff_ignore_rating_notice') ) {

            _e("
            <div class='cff_notice cff_review_notice'>
                <img src='". plugins_url( 'custom-facebook-feed/img/cff-icon.png' ) ."' alt='Custom Facebook Feed'>
                <div class='cff-notice-text'>
                    <p>It's great to see that you've been using the <strong>Custom Facebook Feed</strong> plugin for a while now. Hopefully you're happy with it!&nbsp; If so, would you consider leaving a positive review? It really helps to support the plugin and helps others to discover it too!</p>
                    <p class='cff-links'>
                        <a class='cff_notice_dismiss' href='https://wordpress.org/support/view/plugin-reviews/custom-facebook-feed' target='_blank'>Sure, I'd love to!</a>
                        &middot;
                        <a class='cff_notice_dismiss' href='" .esc_url( add_query_arg( 'cff_ignore_rating_notice_nag', '1' ) ). "'>No thanks</a>
                        &middot;
                        <a class='cff_notice_dismiss' href='" .esc_url( add_query_arg( 'cff_ignore_rating_notice_nag', '1' ) ). "'>I've already given a review</a>
                        &middot;
                        <a class='cff_notice_dismiss' href='" .esc_url( add_query_arg( 'cff_ignore_rating_notice_nag', 'later' ) ). "'>Ask Me Later</a>
                    </p>
                </div>
                <a class='cff_notice_close' href='" .esc_url( add_query_arg( 'cff_ignore_rating_notice_nag', '1' ) ). "'><i class='fa fa-close'></i></a>
            </div>
            ");

        }

    }
}

// variables to define certain terms
$transient = 'custom_facebook_rating_notice_waiting';
$option = 'cff_rating_notice';
$nag = 'cff_ignore_rating_notice_nag';

cff_check_nag_get( $_GET, $nag, $option, $transient );
cff_maybe_set_transient( $transient, $option );
$notice_status = get_option( $option, false );

// only display the notice if the time offset has passed and the user hasn't already dismissed it
if ( get_transient( $transient ) !== 'waiting' && $notice_status !== 'dismissed' ) {
    add_action( 'admin_notices', 'cff_rating_notice_html' );
}

?>