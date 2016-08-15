<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

function sb_instagram_menu() {
    add_menu_page(
        'Instagram Feed',
        'Instagram Feed',
        'manage_options',
        'sb-instagram-feed',
        'sb_instagram_settings_page'
    );
    add_submenu_page(
        'sb-instagram-feed',
        'Settings',
        'Settings',
        'manage_options',
        'sb-instagram-feed',
        'sb_instagram_settings_page'
    );
}
add_action('admin_menu', 'sb_instagram_menu');

function sb_instagram_settings_page() {

    //Hidden fields
    $sb_instagram_settings_hidden_field = 'sb_instagram_settings_hidden_field';
    $sb_instagram_configure_hidden_field = 'sb_instagram_configure_hidden_field';
    $sb_instagram_customize_hidden_field = 'sb_instagram_customize_hidden_field';

    //Declare defaults
    $sb_instagram_settings_defaults = array(
        'sb_instagram_at'                   => '',
        'sb_instagram_user_id'              => '',
        'sb_instagram_preserve_settings'    => '',
        'sb_instagram_ajax_theme'           => false,
        'sb_instagram_width'                => '100',
        'sb_instagram_width_unit'           => '%',
        'sb_instagram_feed_width_resp'      => false,
        'sb_instagram_height'               => '',
        'sb_instagram_num'                  => '20',
        'sb_instagram_height_unit'          => '',
        'sb_instagram_cols'                 => '4',
        'sb_instagram_disable_mobile'       => false,
        'sb_instagram_image_padding'        => '5',
        'sb_instagram_image_padding_unit'   => 'px',
        'sb_instagram_sort'                 => 'none',
        'sb_instagram_background'           => '',
        'sb_instagram_show_btn'             => true,
        'sb_instagram_btn_background'       => '',
        'sb_instagram_btn_text_color'       => '',
        'sb_instagram_btn_text'             => 'Load More...',
        'sb_instagram_image_res'            => 'auto',
        //Header
        'sb_instagram_show_header'          => true,
        'sb_instagram_header_color'         => '',
        //Follow button
        'sb_instagram_show_follow_btn'      => true,
        'sb_instagram_folow_btn_background' => '',
        'sb_instagram_follow_btn_text_color' => '',
        'sb_instagram_follow_btn_text'      => 'Follow on Instagram',
        //Misc
        'sb_instagram_custom_css'           => '',
        'sb_instagram_custom_js'            => '',
        'sb_instagram_disable_awesome'      => false
    );
    //Save defaults in an array
    $options = wp_parse_args(get_option('sb_instagram_settings'), $sb_instagram_settings_defaults);
    update_option( 'sb_instagram_settings', $options );

    //Set the page variables
    $sb_instagram_at = $options[ 'sb_instagram_at' ];
    $sb_instagram_user_id = $options[ 'sb_instagram_user_id' ];
    $sb_instagram_preserve_settings = $options[ 'sb_instagram_preserve_settings' ];
    $sb_instagram_ajax_theme = $options[ 'sb_instagram_ajax_theme' ];
    $sb_instagram_width = $options[ 'sb_instagram_width' ];
    $sb_instagram_width_unit = $options[ 'sb_instagram_width_unit' ];
    $sb_instagram_feed_width_resp = $options[ 'sb_instagram_feed_width_resp' ];
    $sb_instagram_height = $options[ 'sb_instagram_height' ];
    $sb_instagram_height_unit = $options[ 'sb_instagram_height_unit' ];
    $sb_instagram_num = $options[ 'sb_instagram_num' ];
    $sb_instagram_cols = $options[ 'sb_instagram_cols' ];
    $sb_instagram_disable_mobile = $options[ 'sb_instagram_disable_mobile' ];
    $sb_instagram_image_padding = $options[ 'sb_instagram_image_padding' ];
    $sb_instagram_image_padding_unit = $options[ 'sb_instagram_image_padding_unit' ];
    $sb_instagram_sort = $options[ 'sb_instagram_sort' ];
    $sb_instagram_background = $options[ 'sb_instagram_background' ];
    $sb_instagram_show_btn = $options[ 'sb_instagram_show_btn' ];
    $sb_instagram_btn_background = $options[ 'sb_instagram_btn_background' ];
    $sb_instagram_btn_text_color = $options[ 'sb_instagram_btn_text_color' ];
    $sb_instagram_btn_text = $options[ 'sb_instagram_btn_text' ];
    $sb_instagram_image_res = $options[ 'sb_instagram_image_res' ];
    //Header
    $sb_instagram_show_header = $options[ 'sb_instagram_show_header' ];
    $sb_instagram_header_color = $options[ 'sb_instagram_header_color' ];
    //Follow button
    $sb_instagram_show_follow_btn = $options[ 'sb_instagram_show_follow_btn' ];
    $sb_instagram_folow_btn_background = $options[ 'sb_instagram_folow_btn_background' ];
    $sb_instagram_follow_btn_text_color = $options[ 'sb_instagram_follow_btn_text_color' ];
    $sb_instagram_follow_btn_text = $options[ 'sb_instagram_follow_btn_text' ];
    //Misc
    $sb_instagram_custom_css = $options[ 'sb_instagram_custom_css' ];
    $sb_instagram_custom_js = $options[ 'sb_instagram_custom_js' ];
    $sb_instagram_disable_awesome = $options[ 'sb_instagram_disable_awesome' ];


    //Check nonce before saving data
    if ( ! isset( $_POST['sb_instagram_settings_nonce'] ) || ! wp_verify_nonce( $_POST['sb_instagram_settings_nonce'], 'sb_instagram_saving_settings' ) ) {
        //Nonce did not verify
    } else {
        // See if the user has posted us some information. If they did, this hidden field will be set to 'Y'.
        if( isset($_POST[ $sb_instagram_settings_hidden_field ]) && $_POST[ $sb_instagram_settings_hidden_field ] == 'Y' ) {

            if( isset($_POST[ $sb_instagram_configure_hidden_field ]) && $_POST[ $sb_instagram_configure_hidden_field ] == 'Y' ) {

                $sb_instagram_at = sanitize_text_field( $_POST[ 'sb_instagram_at' ] );
                $sb_instagram_user_id = sanitize_text_field( $_POST[ 'sb_instagram_user_id' ] );

                isset($_POST[ 'sb_instagram_preserve_settings' ]) ? $sb_instagram_preserve_settings = sanitize_text_field( $_POST[ 'sb_instagram_preserve_settings' ] ) : $sb_instagram_preserve_settings = '';
                isset($_POST[ 'sb_instagram_ajax_theme' ]) ? $sb_instagram_ajax_theme = sanitize_text_field( $_POST[ 'sb_instagram_ajax_theme' ] ) : $sb_instagram_ajax_theme = '';

                $options[ 'sb_instagram_at' ] = $sb_instagram_at;
                $options[ 'sb_instagram_user_id' ] = $sb_instagram_user_id;
                $options[ 'sb_instagram_preserve_settings' ] = $sb_instagram_preserve_settings;
                $options[ 'sb_instagram_ajax_theme' ] = $sb_instagram_ajax_theme;
            } //End config tab post

            if( isset($_POST[ $sb_instagram_customize_hidden_field ]) && $_POST[ $sb_instagram_customize_hidden_field ] == 'Y' ) {
                
                //Validate and sanitize width field
                $safe_width = intval( sanitize_text_field( $_POST['sb_instagram_width'] ) );
                if ( ! $safe_width ) $safe_width = '';
                if ( strlen( $safe_width ) > 4 ) $safe_width = substr( $safe_width, 0, 4 );
                $sb_instagram_width = $safe_width;

                $sb_instagram_width_unit = sanitize_text_field( $_POST[ 'sb_instagram_width_unit' ] );
                isset($_POST[ 'sb_instagram_feed_width_resp' ]) ? $sb_instagram_feed_width_resp = sanitize_text_field( $_POST[ 'sb_instagram_feed_width_resp' ] ) : $sb_instagram_feed_width_resp = '';

                //Validate and sanitize height field
                $safe_height = intval( sanitize_text_field( $_POST['sb_instagram_height'] ) );
                if ( ! $safe_height ) $safe_height = '';
                if ( strlen( $safe_height ) > 4 ) $safe_height = substr( $safe_height, 0, 4 );
                $sb_instagram_height = $safe_height;

                $sb_instagram_height_unit = sanitize_text_field( $_POST[ 'sb_instagram_height_unit' ] );

                //Validate and sanitize number of photos field
                $safe_num = intval( sanitize_text_field( $_POST['sb_instagram_num'] ) );
                if ( ! $safe_num ) $safe_num = '';
                if ( strlen( $safe_num ) > 4 ) $safe_num = substr( $safe_num, 0, 4 );
                $sb_instagram_num = $safe_num;

                $sb_instagram_cols = sanitize_text_field( $_POST[ 'sb_instagram_cols' ] );
                isset($_POST[ 'sb_instagram_disable_mobile' ]) ? $sb_instagram_disable_mobile = sanitize_text_field( $_POST[ 'sb_instagram_disable_mobile' ] ) : $sb_instagram_disable_mobile = '';

                //Validate and sanitize padding field
                $safe_padding = intval( sanitize_text_field( $_POST['sb_instagram_image_padding'] ) );
                if ( ! $safe_padding ) $safe_padding = '';
                if ( strlen( $safe_padding ) > 4 ) $safe_padding = substr( $safe_padding, 0, 4 );
                $sb_instagram_image_padding = $safe_padding;

                $sb_instagram_image_padding_unit = sanitize_text_field( $_POST[ 'sb_instagram_image_padding_unit' ] );
                $sb_instagram_sort = sanitize_text_field( $_POST[ 'sb_instagram_sort' ] );
                $sb_instagram_background = sanitize_text_field( $_POST[ 'sb_instagram_background' ] );
                isset($_POST[ 'sb_instagram_show_btn' ]) ? $sb_instagram_show_btn = sanitize_text_field( $_POST[ 'sb_instagram_show_btn' ] ) : $sb_instagram_show_btn = '';
                $sb_instagram_btn_background = sanitize_text_field( $_POST[ 'sb_instagram_btn_background' ] );
                $sb_instagram_btn_text_color = sanitize_text_field( $_POST[ 'sb_instagram_btn_text_color' ] );
                $sb_instagram_btn_text = sanitize_text_field( $_POST[ 'sb_instagram_btn_text' ] );
                $sb_instagram_image_res = sanitize_text_field( $_POST[ 'sb_instagram_image_res' ] );
                //Header
                isset($_POST[ 'sb_instagram_show_header' ]) ? $sb_instagram_show_header = sanitize_text_field( $_POST[ 'sb_instagram_show_header' ] ) : $sb_instagram_show_header = '';
                $sb_instagram_header_color = sanitize_text_field( $_POST[ 'sb_instagram_header_color' ] );
                //Follow button
                isset($_POST[ 'sb_instagram_show_follow_btn' ]) ? $sb_instagram_show_follow_btn = sanitize_text_field( $_POST[ 'sb_instagram_show_follow_btn' ] ) : $sb_instagram_show_follow_btn = '';
                $sb_instagram_folow_btn_background = sanitize_text_field( $_POST[ 'sb_instagram_folow_btn_background' ] );
                $sb_instagram_follow_btn_text_color = sanitize_text_field( $_POST[ 'sb_instagram_follow_btn_text_color' ] );
                $sb_instagram_follow_btn_text = sanitize_text_field( $_POST[ 'sb_instagram_follow_btn_text' ] );
                //Misc
                $sb_instagram_custom_css = $_POST[ 'sb_instagram_custom_css' ];
                $sb_instagram_custom_js = $_POST[ 'sb_instagram_custom_js' ];
                isset($_POST[ 'sb_instagram_disable_awesome' ]) ? $sb_instagram_disable_awesome = sanitize_text_field( $_POST[ 'sb_instagram_disable_awesome' ] ) : $sb_instagram_disable_awesome = '';

                $options[ 'sb_instagram_width' ] = $sb_instagram_width;
                $options[ 'sb_instagram_width_unit' ] = $sb_instagram_width_unit;
                $options[ 'sb_instagram_feed_width_resp' ] = $sb_instagram_feed_width_resp;
                $options[ 'sb_instagram_height' ] = $sb_instagram_height;
                $options[ 'sb_instagram_height_unit' ] = $sb_instagram_height_unit;
                $options[ 'sb_instagram_num' ] = $sb_instagram_num;
                $options[ 'sb_instagram_cols' ] = $sb_instagram_cols;
                $options[ 'sb_instagram_disable_mobile' ] = $sb_instagram_disable_mobile;
                $options[ 'sb_instagram_image_padding' ] = $sb_instagram_image_padding;
                $options[ 'sb_instagram_image_padding_unit' ] = $sb_instagram_image_padding_unit;
                $options[ 'sb_instagram_sort' ] = $sb_instagram_sort;
                $options[ 'sb_instagram_background' ] = $sb_instagram_background;
                $options[ 'sb_instagram_show_btn' ] = $sb_instagram_show_btn;
                $options[ 'sb_instagram_btn_background' ] = $sb_instagram_btn_background;
                $options[ 'sb_instagram_btn_text_color' ] = $sb_instagram_btn_text_color;
                $options[ 'sb_instagram_btn_text' ] = $sb_instagram_btn_text;
                $options[ 'sb_instagram_image_res' ] = $sb_instagram_image_res;
                //Header
                $options[ 'sb_instagram_show_header' ] = $sb_instagram_show_header;
                $options[ 'sb_instagram_header_color' ] = $sb_instagram_header_color;
                //Follow button
                $options[ 'sb_instagram_show_follow_btn' ] = $sb_instagram_show_follow_btn;
                $options[ 'sb_instagram_folow_btn_background' ] = $sb_instagram_folow_btn_background;
                $options[ 'sb_instagram_follow_btn_text_color' ] = $sb_instagram_follow_btn_text_color;
                $options[ 'sb_instagram_follow_btn_text' ] = $sb_instagram_follow_btn_text;
                //Misc
                $options[ 'sb_instagram_custom_css' ] = $sb_instagram_custom_css;
                $options[ 'sb_instagram_custom_js' ] = $sb_instagram_custom_js;
                $options[ 'sb_instagram_disable_awesome' ] = $sb_instagram_disable_awesome;
                
            } //End customize tab post
            
            //Save the settings to the settings array
            update_option( 'sb_instagram_settings', $options );

        ?>
        <div class="updated"><p><strong><?php _e('Settings saved.', 'instagram-feed' ); ?></strong></p></div>
        <?php } ?>

    <?php } //End nonce check ?>


    <div id="sbi_admin" class="wrap">

        <div id="header">
            <h1><?php _e('Instagram Feed', 'instagram-feed'); ?></h1>
        </div>
    
        <form name="form1" method="post" action="">
            <input type="hidden" name="<?php echo $sb_instagram_settings_hidden_field; ?>" value="Y">
            <?php wp_nonce_field( 'sb_instagram_saving_settings', 'sb_instagram_settings_nonce' ); ?>

            <?php $sbi_active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'configure'; ?>
            <h2 class="nav-tab-wrapper">
                <a href="?page=sb-instagram-feed&amp;tab=configure" class="nav-tab <?php echo $sbi_active_tab == 'configure' ? 'nav-tab-active' : ''; ?>"><?php _e('1. Configure', 'instagram-feed'); ?></a>
                <a href="?page=sb-instagram-feed&amp;tab=customize" class="nav-tab <?php echo $sbi_active_tab == 'customize' ? 'nav-tab-active' : ''; ?>"><?php _e('2. Customize', 'instagram-feed'); ?></a>
                <a href="?page=sb-instagram-feed&amp;tab=display" class="nav-tab <?php echo $sbi_active_tab == 'display' ? 'nav-tab-active' : ''; ?>"><?php _e('3. Display Your Feed', 'instagram-feed'); ?></a>
                <a href="?page=sb-instagram-feed&amp;tab=support" class="nav-tab <?php echo $sbi_active_tab == 'support' ? 'nav-tab-active' : ''; ?>"><?php _e('Support', 'instagram-feed'); ?></a>
            </h2>

            <?php if( $sbi_active_tab == 'configure' ) { //Start Configure tab ?>
            <input type="hidden" name="<?php echo $sb_instagram_configure_hidden_field; ?>" value="Y">

            <table class="form-table">
                <tbody>
                    <h3><?php _e('Configure', 'instagram-feed'); ?></h3>

                    <div id="sbi_config">
                        <!-- <a href="https://instagram.com/oauth/authorize/?client_id=1654d0c81ad04754a898d89315bec227&redirect_uri=https://smashballoon.com/instagram-feed/instagram-token-plugin/?return_uri=<?php echo admin_url('admin.php?page=sb-instagram-feed'); ?>&response_type=token" class="sbi_admin_btn"><?php _e('Log in and get my Access Token and User ID', 'instagram-feed'); ?></a> -->
                        <a href="https://instagram.com/oauth/authorize/?client_id=3a81a9fa2a064751b8c31385b91cc25c&scope=basic+public_content&redirect_uri=https://smashballoon.com/instagram-feed/instagram-token-plugin/?return_uri=<?php echo admin_url('admin.php?page=sb-instagram-feed'); ?>&response_type=token" class="sbi_admin_btn"><?php _e('Log in and get my Access Token and User ID', 'instagram-feed'); ?></a>
                        <a href="https://smashballoon.com/instagram-feed/token/" target="_blank" style="position: relative; top: 14px; left: 15px;"><?php _e('Button not working?', 'instagram-feed'); ?></a>
                    </div>
                    
                    <tr valign="top">
                        <th scope="row"><label><?php _e('Access Token', 'instagram-feed'); ?></label></th>
                        <td>
                            <input name="sb_instagram_at" id="sb_instagram_at" type="text" value="<?php esc_attr_e( $sb_instagram_at, 'instagram-feed' ); ?>" size="60" maxlength="60" placeholder="Click button above to get your Access Token" />
                            &nbsp;<a class="sbi_tooltip_link" href="JavaScript:void(0);"><?php _e("What is this?", 'instagram-feed'); ?></a>
                            <p class="sbi_tooltip"><?php _e("In order to display your photos you need an Access Token from Instagram. To get yours, simply click the button above and log into Instagram. You can also use the button on <a href='https://smashballoon.com/instagram-feed/token/' target='_blank'>this page</a>.", 'instagram-feed'); ?></p>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row"><label><?php _e('Show Photos From:', 'instagram-feed'); ?></label><code class="sbi_shortcode"> type
                            Eg: type=user id=12986477
                        </code></th>
                        <td>
                            <span>
                                <?php $sb_instagram_type = 'user'; ?>
                                <input type="radio" name="sb_instagram_type" id="sb_instagram_type_user" value="user" <?php if($sb_instagram_type == "user") echo "checked"; ?> />
                                <label class="sbi_radio_label" for="sb_instagram_type_user">User ID(s):</label>
                                <input name="sb_instagram_user_id" id="sb_instagram_user_id" type="text" value="<?php esc_attr_e( $sb_instagram_user_id, 'instagram-feed' ); ?>" size="25" />
                                &nbsp;<a class="sbi_tooltip_link" href="JavaScript:void(0);"><?php _e("What is this?", 'instagram-feed'); ?></a>
                                <p class="sbi_tooltip"><?php _e("These are the IDs of the Instagram accounts you want to display photos from. To get your ID simply click on the button above and log into Instagram.<br /><br />You can also display photos from other peoples Instagram accounts. To find their User ID you can use <a href='https://smashballoon.com/instagram-feed/find-instagram-user-id/' target='_blank'>this tool</a>. You can separate multiple IDs using commas.", 'instagram-feed'); ?></p><br />
                            </span>

                            <div class="sbi_notice sbi_user_id_error">
                                <?php _e("<p>Please be sure to enter your numeric <b>User ID</b> and not your Username. You can find your User ID by clicking the blue Instagram Login button above, or by entering your username into <a href='https://smashballoon.com/instagram-feed/find-instagram-user-id/' target='_blank'>this tool</a>.</p>", 'instagram-feed'); ?>
                            </div>
                            
                            <span class="sbi_pro sbi_row">
                                <input disabled type="radio" name="sb_instagram_type" id="sb_instagram_type_hashtag" value="hashtag" <?php if($sb_instagram_type == "hashtag") echo "checked"; ?> />
                                <label class="sbi_radio_label" for="sb_instagram_type_hashtag">Hashtag:</label>
                                <input readonly type="text" size="25" />
                                &nbsp;<a class="sbi_tooltip_link sbi_pro" href="JavaScript:void(0);"><?php _e("What is this?", 'instagram-feed'); ?></a><span class="sbi_note"> - <a href="https://smashballoon.com/instagram-feed/" target="_blank">Upgrade to Pro to show posts by Hashtag</a></span>
                                <p class="sbi_tooltip"><?php _e("Display posts from a specific hashtag instead of from a user", 'instagram-feed'); ?></p>
                            </span>

                            <div class="sbi_pro sbi_row">
                                <input disabled type="radio" name="sb_instagram_type" id="sb_instagram_type_self_likes" value="liked" <?php if($sb_instagram_type == "liked") echo "checked"; ?> />
                                <label class="sbi_radio_label" for="sb_instagram_type_self_likes">Liked:</label>
                                <input readonly type="text" size="25" />
                                    &nbsp;<a class="sbi_tooltip_link sbi_pro" href="JavaScript:void(0);"><?php _e("What is this?"); ?></a><span class="sbi_note"> - <a href="https://smashballoon.com/instagram-feed/" target="_blank">Upgrade to Pro to show posts that you've Liked</a></span>
                                <p class="sbi_tooltip"><?php _e("Display posts that your user account has liked."); ?></p>
                            </div>

                            <span class="sbi_pro sbi_row">
                                <input disabled type="radio" name="sb_instagram_type" id="sb_instagram_type_location" value="location" <?php if($sb_instagram_type == "location") echo "checked"; ?> />
                                <label class="sbi_radio_label" for="sb_instagram_type_location">Location:</label>
                                <input readonly type="text" size="25" />
                                &nbsp;<a class="sbi_tooltip_link sbi_pro" href="JavaScript:void(0);"><?php _e("What is this?", 'instagram-feed'); ?></a><span class="sbi_note"> - <a href="https://smashballoon.com/instagram-feed/" target="_blank">Upgrade to Pro to show posts by Location</a></span>
                                <p class="sbi_tooltip"><?php _e("Display posts from an Instagram location ID or location coordinates.", 'instagram-feed'); ?></p>
                            </span>

                            <span class="sbi_note" style="margin: 10px 0 0 0; display: block;"><?php _e('Separate multiple IDs using commas', 'instagram-feed'); ?></span>
                           
                        </td>
                    </tr>

                    <tr>
                        <th class="bump-left"><label for="sb_instagram_preserve_settings" class="bump-left"><?php _e("Preserve settings when plugin is removed", 'instagram-feed'); ?></label></th>
                        <td>
                            <input name="sb_instagram_preserve_settings" type="checkbox" id="sb_instagram_preserve_settings" <?php if($sb_instagram_preserve_settings == true) echo "checked"; ?> />
                            <label for="sb_instagram_preserve_settings"><?php _e('Yes', 'instagram-feed'); ?></label>
                            <a class="sbi_tooltip_link" href="JavaScript:void(0);"><?php _e('What does this mean?', 'instagram-feed'); ?></a>
                            <p class="sbi_tooltip"><?php _e('When removing the plugin your settings are automatically erased. Checking this box will prevent any settings from being deleted. This means that you can uninstall and reinstall the plugin without losing your settings.', 'instagram-feed'); ?></p>
                        </td>
                    </tr>

                    <tr>
                        <th class="bump-left"><label for="sb_instagram_ajax_theme" class="bump-left"><?php _e("Are you using an Ajax powered theme?", 'instagram-feed'); ?></label></th>
                        <td>
                            <input name="sb_instagram_ajax_theme" type="checkbox" id="sb_instagram_ajax_theme" <?php if($sb_instagram_ajax_theme == true) echo "checked"; ?> />
                            <label for="sb_instagram_ajax_theme"><?php _e('Yes', 'instagram-feed'); ?></label>
                            <a class="sbi_tooltip_link" href="JavaScript:void(0);"><?php _e('What does this mean?', 'instagram-feed'); ?></a>
                            <p class="sbi_tooltip"><?php _e("When navigating your site, if your theme uses Ajax to load content into your pages (meaning your page doesn't refresh) then check this setting. If you're not sure then please check with the theme author.", 'instagram-feed'); ?></p>
                        </td>
                    </tr>
                </tbody>
            </table>

            <?php submit_button(); ?>
        </form>

        <p><i class="fa fa-chevron-circle-right" aria-hidden="true"></i>&nbsp; <?php _e('Next Step: <a href="?page=sb-instagram-feed&tab=customize">Customize your Feed</a>', 'instagram-feed'); ?></p>

        <p><i class="fa fa-life-ring" aria-hidden="true"></i>&nbsp; <?php _e('Need help setting up the plugin? Check out our <a href="http://smashballoon.com/instagram-feed/free/" target="_blank">setup directions</a>', 'instagram-feed'); ?></p>


    <?php } // End Configure tab ?>



    <?php if( $sbi_active_tab == 'customize' ) { //Start Configure tab ?>

    <p class="sb_instagram_contents_links" id="general">
        <span>Quick links: </span>
        <a href="#general">General</a>
        <a href="#photos">Photos</a>
        <a href="#headeroptions">Header</a>
        <a href="#loadmore">'Load More' Button</a>
        <a href="#follow">'Follow' Button</a>
        <a href="#customcss">Custom CSS</a>
        <a href="#customjs">Custom JavaScript</a>
    </p>

    <input type="hidden" name="<?php echo $sb_instagram_customize_hidden_field; ?>" value="Y">

        <h3><?php _e('Customize', 'instagram-feed'); ?></h3>

        <table class="form-table">
            <tbody>
                <tr valign="top">
                    <th scope="row"><label><?php _e('Width of Feed', 'instagram-feed'); ?></label><code class="sbi_shortcode"> width  widthunit
                        Eg: width=50 widthunit=%</code></th>
                    <td>
                        <input name="sb_instagram_width" type="text" value="<?php esc_attr_e( $sb_instagram_width, 'instagram-feed' ); ?>" id="sb_instagram_width" size="4" maxlength="4" />
                        <select name="sb_instagram_width_unit" id="sb_instagram_width_unit">
                            <option value="px" <?php if($sb_instagram_width_unit == "px") echo 'selected="selected"' ?> ><?php _e('px', 'instagram-feed'); ?></option>
                            <option value="%" <?php if($sb_instagram_width_unit == "%") echo 'selected="selected"' ?> ><?php _e('%', 'instagram-feed'); ?></option>
                        </select>
                        <div id="sb_instagram_width_options">
                            <input name="sb_instagram_feed_width_resp" type="checkbox" id="sb_instagram_feed_width_resp" <?php if($sb_instagram_feed_width_resp == true) echo "checked"; ?> /><label for="sb_instagram_feed_width_resp"><?php _e('Set to be 100% width on mobile?'); ?></label>
                            <a class="sbi_tooltip_link" href="JavaScript:void(0);"><?php _e('What does this mean?'); ?></a>
                            <p class="sbi_tooltip"><?php _e("If you set a width on the feed then this will be used on mobile as well as desktop. Check this setting to set the feed width to be 100% on mobile so that it is responsive."); ?></p>
                        </div>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label><?php _e('Height of Feed', 'instagram-feed'); ?></label><code class="sbi_shortcode"> height  heightunit
                        Eg: height=500 heightunit=px</code></th>
                    <td>
                        <input name="sb_instagram_height" type="text" value="<?php esc_attr_e( $sb_instagram_height, 'instagram-feed' ); ?>" size="4" maxlength="4" />
                        <select name="sb_instagram_height_unit">
                            <option value="px" <?php if($sb_instagram_height_unit == "px") echo 'selected="selected"' ?> ><?php _e('px', 'instagram-feed'); ?></option>
                            <option value="%" <?php if($sb_instagram_height_unit == "%") echo 'selected="selected"' ?> ><?php _e('%', 'instagram-feed'); ?></option>
                        </select>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label><?php _e('Background Color', 'instagram-feed'); ?></label><code class="sbi_shortcode"> background
                        Eg: background=d89531</code></th>
                    <td>
                        <input name="sb_instagram_background" type="text" value="<?php esc_attr_e( $sb_instagram_background, 'instagram-feed' ); ?>" class="sbi_colorpick" />
                    </td>
                </tr>
            </tbody>
        </table>

        <hr id="photos" />
        <h3><?php _e('Photos', 'instagram-feed'); ?></h3>

        <table class="form-table">
            <tbody>
                <tr valign="top">
                    <th scope="row"><label><?php _e('Sort Photos By', 'instagram-feed'); ?></label><code class="sbi_shortcode"> sortby
                        Eg: sortby=random</code></th>
                    <td>
                        <select name="sb_instagram_sort">
                            <option value="none" <?php if($sb_instagram_sort == "none") echo 'selected="selected"' ?> ><?php _e('Newest to oldest', 'instagram-feed'); ?></option>
                            <!-- <option value="most-recent" <?php if($sb_instagram_sort == "most-recent") echo 'selected="selected"' ?> ><?php _e('Newest to Oldest', 'instagram-feed'); ?></option>
                            <option value="least-recent" <?php if($sb_instagram_sort == "least-recent") echo 'selected="selected"' ?> ><?php _e('Oldest to newest', 'instagram-feed'); ?></option>
                            <option value="most-liked" <?php if($sb_instagram_sort == "most-liked") echo 'selected="selected"' ?> ><?php _e('Most liked first', 'instagram-feed'); ?></option>
                            <option value="least-liked" <?php if($sb_instagram_sort == "least-liked") echo 'selected="selected"' ?> ><?php _e('Least liked first', 'instagram-feed'); ?></option>
                            <option value="most-commented" <?php if($sb_instagram_sort == "most-commented") echo 'selected="selected"' ?> ><?php _e('Most commented first', 'instagram-feed'); ?></option>
                            <option value="least-commented" <?php if($sb_instagram_sort == "least-commented") echo 'selected="selected"' ?> ><?php _e('Least commented first', 'instagram-feed'); ?></option> -->
                            <option value="random" <?php if($sb_instagram_sort == "random") echo 'selected="selected"' ?> ><?php _e('Random', 'instagram-feed'); ?></option>
                        </select>
                    </td>
                </tr>
                <tr valign="top" class="sbi_pro">
                    <th scope="row"><label><?php _e("Enable Pop-up Lightbox", 'instagram-feed'); ?></label></th>
                    <td>
                        <span class="sbi_note"><a href="https://smashballoon.com/instagram-feed/" target="_blank"><?php _e('Upgrade to Pro to enable the Pop-up Lightbox.', 'instagram-feed'); ?></a></span>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label><?php _e('Number of Photos', 'instagram-feed'); ?></label><code class="sbi_shortcode"> num
                        Eg: num=6</code></th>
                    <td>
                        <input name="sb_instagram_num" type="text" value="<?php esc_attr_e( $sb_instagram_num, 'instagram-feed' ); ?>" size="4" maxlength="4" />
                        <span class="sbi_note"><?php _e('Number of photos to show initially. Maximum of 33.', 'instagram-feed'); ?></span>
                        &nbsp;<a class="sbi_tooltip_link" href="JavaScript:void(0);"><?php _e("Using multiple IDs or hashtags?", 'instagram-feed'); ?></a>
                            <p class="sbi_tooltip"><?php _e("If you're displaying photos from multiple User IDs or hashtags then this is the number of photos which will be displayed from each.", 'instagram-feed'); ?></p>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label><?php _e('Number of Columns', 'instagram-feed'); ?></label><code class="sbi_shortcode"> cols
                        Eg: cols=3</code></th>
                    <td>

                        <select name="sb_instagram_cols">
                            <option value="1" <?php if($sb_instagram_cols == "1") echo 'selected="selected"' ?> ><?php _e('1', 'instagram-feed'); ?></option>
                            <option value="2" <?php if($sb_instagram_cols == "2") echo 'selected="selected"' ?> ><?php _e('2', 'instagram-feed'); ?></option>
                            <option value="3" <?php if($sb_instagram_cols == "3") echo 'selected="selected"' ?> ><?php _e('3', 'instagram-feed'); ?></option>
                            <option value="4" <?php if($sb_instagram_cols == "4") echo 'selected="selected"' ?> ><?php _e('4', 'instagram-feed'); ?></option>
                            <option value="5" <?php if($sb_instagram_cols == "5") echo 'selected="selected"' ?> ><?php _e('5', 'instagram-feed'); ?></option>
                            <option value="6" <?php if($sb_instagram_cols == "6") echo 'selected="selected"' ?> ><?php _e('6', 'instagram-feed'); ?></option>
                            <option value="7" <?php if($sb_instagram_cols == "7") echo 'selected="selected"' ?> ><?php _e('7', 'instagram-feed'); ?></option>
                            <option value="8" <?php if($sb_instagram_cols == "8") echo 'selected="selected"' ?> ><?php _e('8', 'instagram-feed'); ?></option>
                            <option value="9" <?php if($sb_instagram_cols == "9") echo 'selected="selected"' ?> ><?php _e('9', 'instagram-feed'); ?></option>
                            <option value="10" <?php if($sb_instagram_cols == "10") echo 'selected="selected"' ?> ><?php _e('10', 'instagram-feed'); ?></option>
                        </select>

                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label><?php _e('Image Resolution', 'instagram-feed'); ?></label><code class="sbi_shortcode"> imageres
                        Eg: imageres=thumb</code></th>
                    <td>

                        <select name="sb_instagram_image_res">
                            <option value="auto" <?php if($sb_instagram_image_res == "auto") echo 'selected="selected"' ?> ><?php _e('Auto-detect (recommended)', 'instagram-feed'); ?></option>
                            <option value="thumb" <?php if($sb_instagram_image_res == "thumb") echo 'selected="selected"' ?> ><?php _e('Thumbnail (150x150)', 'instagram-feed'); ?></option>
                            <option value="medium" <?php if($sb_instagram_image_res == "medium") echo 'selected="selected"' ?> ><?php _e('Medium (306x306)', 'instagram-feed'); ?></option>
                            <option value="full" <?php if($sb_instagram_image_res == "full") echo 'selected="selected"' ?> ><?php _e('Full size (640x640)', 'instagram-feed'); ?></option>
                        </select>

                        &nbsp;<a class="sbi_tooltip_link" href="JavaScript:void(0);"><?php _e("What does Auto-detect mean?", 'instagram-feed'); ?></a>
                            <p class="sbi_tooltip"><?php _e("Auto-detect means that the plugin automatically sets the image resolution based on the size of your feed.", 'instagram-feed'); ?></p>

                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label><?php _e('Padding around Images', 'instagram-feed'); ?></label><code class="sbi_shortcode"> imagepadding  imagepaddingunit</code></th>
                    <td>
                        <input name="sb_instagram_image_padding" type="text" value="<?php esc_attr_e( $sb_instagram_image_padding, 'instagram-feed' ); ?>" size="4" maxlength="4" />
                        <select name="sb_instagram_image_padding_unit">
                            <option value="px" <?php if($sb_instagram_image_padding_unit == "px") echo 'selected="selected"' ?> ><?php _e('px', 'instagram-feed'); ?></option>
                            <option value="%" <?php if($sb_instagram_image_padding_unit == "%") echo 'selected="selected"' ?> ><?php _e('%', 'instagram-feed'); ?></option>
                        </select>
                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row"><label><?php _e("Disable mobile layout", 'instagram-feed'); ?></label><code class="sbi_shortcode"> disablemobile
                        Eg: disablemobile=true</code></th>
                    <td>
                        <input type="checkbox" name="sb_instagram_disable_mobile" id="sb_instagram_disable_mobile" <?php if($sb_instagram_disable_mobile == true) echo 'checked="checked"' ?> />
                        &nbsp;<a class="sbi_tooltip_link" href="JavaScript:void(0);"><?php _e("What does this mean?", 'instagram-feed'); ?></a>
                            <p class="sbi_tooltip"><?php _e("By default on mobile devices the layout automatically changes to use fewer columns. Checking this setting disables the mobile layout.", 'instagram-feed'); ?></p>
                    </td>
                </tr>
            </tbody>
        </table>

        <?php submit_button(); ?>

        <hr />
        <h3><?php _e("Carousel", 'instagram-feed'); ?></h3>
        <p style="padding-bottom: 18px;"><a href="https://smashballoon.com/instagram-feed/" target="_blank">Upgrade to Pro to enable Carousels</a></p>

        <hr id="headeroptions" />
        <h3><?php _e("Header", 'instagram-feed'); ?></h3>
        <table class="form-table">
            <tbody>
                <tr valign="top">
                    <th scope="row"><label><?php _e("Show the Header", 'instagram-feed'); ?></label><code class="sbi_shortcode"> showheader
                        Eg: showheader=false</code></th>
                    <td>
                        <input type="checkbox" name="sb_instagram_show_header" id="sb_instagram_show_header" <?php if($sb_instagram_show_header == true) echo 'checked="checked"' ?> />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label><?php _e('Header Text Color', 'instagram-feed'); ?></label><code class="sbi_shortcode"> headercolor
                        Eg: headercolor=fff</code></th>
                    <td>
                        <input name="sb_instagram_header_color" type="text" value="<?php esc_attr_e( $sb_instagram_header_color, 'instagram-feed' ); ?>" class="sbi_colorpick" />
                    </td>
                </tr>
            </tbody>
        </table>

        <hr />
        <h3><?php _e("Caption", 'instagram-feed'); ?></h3>
        <p style="padding-bottom: 18px;"><a href="https://smashballoon.com/instagram-feed/" target="_blank">Upgrade to Pro to enable Photo Captions</a></p>

        <hr />
        <h3><?php _e("Likes &amp; Comments", 'instagram-feed'); ?></h3>
        <p style="padding-bottom: 18px;"><a href="https://smashballoon.com/instagram-feed/" target="_blank">Upgrade to Pro to enable Likes &amp; Comments</a></p>

        <hr id="loadmore" />
        <h3><?php _e("'Load More' Button", 'instagram-feed'); ?></h3>
        <table class="form-table">
            <tbody>
                <tr valign="top">
                    <th scope="row"><label><?php _e("Show the 'Load More' button", 'instagram-feed'); ?></label><code class="sbi_shortcode"> showbutton
                        Eg: showbutton=false</code></th>
                    <td>
                        <input type="checkbox" name="sb_instagram_show_btn" id="sb_instagram_show_btn" <?php if($sb_instagram_show_btn == true) echo 'checked="checked"' ?> />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label><?php _e('Button Background Color', 'instagram-feed'); ?></label><code class="sbi_shortcode"> buttoncolor
                        Eg: buttoncolor=8224e3</code></th>
                    <td>
                        <input name="sb_instagram_btn_background" type="text" value="<?php esc_attr_e( $sb_instagram_btn_background, 'instagram-feed' ); ?>" class="sbi_colorpick" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label><?php _e('Button Text Color', 'instagram-feed'); ?></label><code class="sbi_shortcode"> buttontextcolor
                        Eg: buttontextcolor=eeee22</code></th>
                    <td>
                        <input name="sb_instagram_btn_text_color" type="text" value="<?php esc_attr_e( $sb_instagram_btn_text_color, 'instagram-feed' ); ?>" class="sbi_colorpick" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label><?php _e('Button Text', 'instagram-feed'); ?></label><code class="sbi_shortcode"> buttontext
                        Eg: buttontext="Show more.."</code></th>
                    <td>
                        <input name="sb_instagram_btn_text" type="text" value="<?php esc_attr_e( $sb_instagram_btn_text, 'instagram-feed' ); ?>" size="20" />
                    </td>
                </tr>
            </tbody>
        </table>

        <?php submit_button(); ?>

        <hr id="follow" />
        <h3><?php _e("'Follow' Button", 'instagram-feed'); ?></h3>
        <table class="form-table">
            <tbody>
                <tr valign="top">
                    <th scope="row"><label><?php _e("Show the Follow button", 'instagram-feed'); ?></label><code class="sbi_shortcode"> showfollow
                        Eg: showfollow=true</code></th>
                    <td>
                        <input type="checkbox" name="sb_instagram_show_follow_btn" id="sb_instagram_show_follow_btn" <?php if($sb_instagram_show_follow_btn == true) echo 'checked="checked"' ?> />
                    </td>
                </tr>

                <!-- <tr valign="top">
                    <th scope="row"><label><?php _e("Button Position", 'instagram-feed'); ?></label></th>
                    <td>
                        <select name="sb_instagram_follow_btn_position">
                            <option value="top" <?php if($sb_instagram_follow_btn_position == "top") echo 'selected="selected"' ?> ><?php _e('Top', 'instagram-feed'); ?></option>
                            <option value="bottom" <?php if($sb_instagram_follow_btn_position == "bottom") echo 'selected="selected"' ?> ><?php _e('Bottom', 'instagram-feed'); ?></option>
                        </select>
                    </td>
                </tr> -->

                <tr valign="top">
                    <th scope="row"><label><?php _e('Button Background Color', 'instagram-feed'); ?></label><code class="sbi_shortcode"> followcolor
                        Eg: followcolor=28a1bf</code></th>
                    <td>
                        <input name="sb_instagram_folow_btn_background" type="text" value="<?php esc_attr_e( $sb_instagram_folow_btn_background, 'instagram-feed' ); ?>" class="sbi_colorpick" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label><?php _e('Button Text Color', 'instagram-feed'); ?></label><code class="sbi_shortcode"> followtextcolor
                        Eg: followtextcolor=000</code></th>
                    <td>
                        <input name="sb_instagram_follow_btn_text_color" type="text" value="<?php esc_attr_e( $sb_instagram_follow_btn_text_color, 'instagram-feed' ); ?>" class="sbi_colorpick" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label><?php _e('Button Text', 'instagram-feed'); ?></label><code class="sbi_shortcode"> followtext
                        Eg: followtext="Follow me"</code></th>
                    <td>
                        <input name="sb_instagram_follow_btn_text" type="text" value="<?php esc_attr_e( $sb_instagram_follow_btn_text, 'instagram-feed' ); ?>" size="30" />
                    </td>
                </tr>
            </tbody>
        </table>




        <hr id="filtering" />
        <h3><?php _e('Post Filtering', 'instagram-feed'); ?></h3>
        <table class="form-table">
            <tbody>
                <tr valign="top" class="sbi_pro">
                    <th scope="row"><label><?php _e('Remove photos containing these words or hashtags', 'instagram-feed'); ?></label></th>
                    <td>
                       <input disabled name="sb_instagram_exclude_words" id="sb_instagram_exclude_words" type="text" style="width: 70%;" value="" />
                        <br />
                        <span class="sbi_note" style="margin-left: 0;"><?php _e('Separate words/hashtags using commas', 'instagram-feed'); ?></span>
                        &nbsp;<a class="sbi_tooltip_link sbi_pro" href="JavaScript:void(0);"><?php _e("What is this?", 'instagram-feed'); ?></a>
                            <p class="sbi_tooltip"><?php _e("You can use this setting to remove photos which contain certain words or hashtags in the caption. Separate multiple words or hashtags using commas.", 'instagram-feed'); ?></p>
                    </td>
                </tr>

                <tr valign="top" class="sbi_pro">
                    <th scope="row"><label><?php _e('Show photos containing these words or hashtags', 'instagram-feed'); ?></label></th>
                    <td>
                        <input disabled name="sb_instagram_include_words" id="sb_instagram_include_words" type="text" style="width: 70%;" value="" />
                        <br />
                        <span class="sbi_note" style="margin-left: 0;"><?php _e('Separate words/hashtags using commas', 'instagram-feed'); ?></span>
                        &nbsp;<a class="sbi_tooltip_link sbi_pro" href="JavaScript:void(0);"><?php _e("What is this?", 'instagram-feed'); ?></a>
                            <p class="sbi_tooltip"><?php _e("You can use this setting to only show photos which contain certain words or hashtags in the caption. For example, adding <code>sheep, cow, dog</code> will show any photos which contain either the word sheep, cow, or dog. Separate multiple words or hashtags using commas.", 'instagram-feed'); ?></p>
                    </td>
                </tr>
            </tbody>
        </table>
        <p style="padding-bottom: 18px;"><a href="https://smashballoon.com/instagram-feed/" target="_blank">Upgrade to Pro to enable Post Filtering options</a></p>


        <hr id="moderation" />
        <h3><?php _e('Moderation', 'instagram-feed'); ?></h3>
        <table class="form-table">
            <tbody>
                <tr valign="top" class="sbi_pro">
                    <th scope="row"><label><?php _e('Hide specific photos', 'instagram-feed'); ?></label></th>
                    <td>
                        <textarea disabled name="sb_instagram_hide_photos" id="sb_instagram_hide_photos" style="width: 70%;" rows="3"></textarea>
                        <br />
                        <span class="sbi_note" style="margin-left: 0;"><?php _e('Separate IDs using commas', 'instagram-feed'); ?></span>
                        &nbsp;<a class="sbi_tooltip_link sbi_pro" href="JavaScript:void(0);"><?php _e("What is this?", 'instagram-feed'); ?></a>
                            <p class="sbi_tooltip"><?php _e("You can use this setting to hide specific photos in your feed. Just click the 'Hide Photo' link in the photo pop-up in your feed to get the ID of the photo, then copy and paste it into this text box.", 'instagram-feed'); ?></p>
                    </td>
                </tr>

                <tr valign="top" class="sbi_pro">
                    <th scope="row"><label><?php _e('Block users', 'instagram-feed'); ?></label></th>
                    <td>
                        <input disabled name="sb_instagram_block_users" id="sb_instagram_block_users" type="text" style="width: 70%;" value="" />
                        <br />
                        <span class="sbi_note" style="margin-left: 0;"><?php _e('Separate usernames using commas', 'instagram-feed'); ?></span>
                        &nbsp;<a class="sbi_tooltip_link sbi_pro" href="JavaScript:void(0);"><?php _e("What is this?", 'instagram-feed'); ?></a>
                            <p class="sbi_tooltip"><?php _e("You can use this setting to block photos from certain users in your feed. Just enter the usernames here which you want to block. Separate multiple usernames using commas.", 'instagram-feed'); ?></p>
                    </td>
                </tr>

            </tbody>
        </table>
        <p style="padding-bottom: 18px;"><a href="https://smashballoon.com/instagram-feed/" target="_blank">Upgrade to Pro to enable Moderation options</a></p>



        <hr id="customcss" />
        <h3><?php _e('Misc', 'instagram-feed'); ?></h3>

        <table class="form-table">
            <tbody>
                <tr valign="top">
                    <td style="padding-bottom: 0;">
                    <?php _e('<strong style="font-size: 15px;">Custom CSS</strong><br />Enter your own custom CSS in the box below', 'instagram-feed'); ?>
                    </td>
                </tr>
                <tr valign="top">
                    <td>
                        <textarea name="sb_instagram_custom_css" id="sb_instagram_custom_css" style="width: 70%;" rows="7"><?php echo esc_textarea( stripslashes($sb_instagram_custom_css), 'instagram-feed' ); ?></textarea>
                    </td>
                </tr>
                <tr valign="top" id="customjs">
                    <td style="padding-bottom: 0;">
                    <?php _e('<strong style="font-size: 15px;">Custom JavaScript</strong><br />Enter your own custom JavaScript/jQuery in the box below', 'instagram-feed'); ?>
                    </td>
                </tr>
                <tr valign="top">
                    <td>
                        <textarea name="sb_instagram_custom_js" id="sb_instagram_custom_js" style="width: 70%;" rows="7"><?php echo esc_textarea( stripslashes($sb_instagram_custom_js), 'instagram-feed' ); ?></textarea>
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="form-table">
            <tbody>
                <tr valign="top">
                    <th scope="row"><label><?php _e("Disable Font Awesome", 'instagram-feed'); ?></label></th>
                    <td>
                        <input type="checkbox" name="sb_instagram_disable_awesome" id="sb_instagram_disable_awesome" <?php if($sb_instagram_disable_awesome == true) echo 'checked="checked"' ?> /> Yes
                    </td>
                </tr>
            </tbody>
        </table>

        <?php submit_button(); ?>

    </form>

    <p><i class="fa fa-chevron-circle-right" aria-hidden="true"></i>&nbsp; <?php _e('Next Step: <a href="?page=sb-instagram-feed&tab=display">Display your Feed</a>', 'instagram-feed'); ?></p>

    <p><i class="fa fa-life-ring" aria-hidden="true"></i>&nbsp; <?php _e('Need help setting up the plugin? Check out our <a href="http://smashballoon.com/instagram-feed/free/" target="_blank">setup directions</a>', 'instagram-feed'); ?></p>


    <?php } //End Customize tab ?>



    <?php if( $sbi_active_tab == 'display' ) { //Start Display tab ?>

        <h3><?php _e('Display your Feed', 'instagram-feed'); ?></h3>
        <p><?php _e("Copy and paste the following shortcode directly into the page, post or widget where you'd like the feed to show up:", 'instagram-feed'); ?></p>
        <input type="text" value="[instagram-feed]" size="16" readonly="readonly" style="text-align: center;" onclick="this.focus();this.select()" title="<?php _e('To copy, click the field then press Ctrl + C (PC) or Cmd + C (Mac).', 'instagram-feed'); ?>" />

        <h3 style="padding-top: 10px;"><?php _e( 'Multiple Feeds', 'instagram-feed' ); ?></h3>
        <p><?php _e("If you'd like to display multiple feeds then you can set different settings directly in the shortcode like so:", 'instagram-feed'); ?>
        <code>[instagram-feed num=9 cols=3]</code></p>
        <p>You can display as many different feeds as you like, on either the same page or on different pages, by just using the shortcode options below. For example:<br />
        <code>[instagram-feed]</code><br />
        <code>[instagram-feed id="ANOTHER_USER_ID"]</code><br />
        <code>[instagram-feed id="ANOTHER_USER_ID, YET_ANOTHER_USER_ID" num=4 cols=4 showfollow=false]</code>
        </p>
        <p><?php _e("See the table below for a full list of available shortcode options:", 'instagram-feed'); ?></p>

        <p><span class="sbi_table_key"></span><?php _e('Pro version only', 'instagram-feed'); ?></p>

        <table class="sbi_shortcode_table">
            <tbody>
                <tr valign="top">
                    <th scope="row"><?php _e('Shortcode option', 'instagram-feed'); ?></th>
                    <th scope="row"><?php _e('Description', 'instagram-feed'); ?></th>
                    <th scope="row"><?php _e('Example', 'instagram-feed'); ?></th>
                </tr>

                <tr class="sbi_table_header"><td colspan=3><?php _e("Configure Options", 'instagram-feed'); ?></td></tr>
                <tr class="sbi_pro">
                    <td>type</td>
                    <td><?php _e("Display photos from a User ID (user)<br />Display posts from a Hashtag (hashtag)<br />Display posts from a Location (location)<br />Display posts from Coordinates (coordinates)", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed type=user]</code><br /><code>[instagram-feed type=hashtag]</code><br/><code>[instagram-feed type=location]</code><br /><code>[instagram-feed type=coordinates]</code></td>
                </tr>
                <tr>
                    <td>id</td>
                    <td><?php _e('An Instagram User ID. Separate multiple IDs by commas.', 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed id="1234567"]</code></td>
                </tr>
                <tr class="sbi_pro">
                    <td>hashtag</td>
                    <td><?php _e('Any hashtag. Separate multiple IDs by commas.', 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed hashtag="#awesome"]</code></td>
                </tr>
                <tr class="sbi_pro">
                    <td>location</td>
                    <td><?php _e('The ID of the location. Separate multiple IDs by commas.', 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed location="213456451"]</code></td>
                </tr>
                <tr class="sbi_pro">
                    <td>coordinates</td>
                    <td><?php _e('The coordinates to display photos from. Separate multiple sets of coordinates by commas.<br />The format is (latitude,longitude,distance).', 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed coordinates="(25.76,-80.19,500)"]</code></td>
                </tr>

                <tr class="sbi_table_header"><td colspan=3><?php _e("Customize Options", 'instagram-feed'); ?></td></tr>
                <tr>
                    <td>width</td>
                    <td><?php _e("The width of your feed. Any number.", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed width=50]</code></td>
                </tr>
                <tr>
                    <td>widthunit</td>
                    <td><?php _e("The unit of the width. 'px' or '%'", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed widthunit=%]</code></td>
                </tr>
                <tr>
                    <td>height</td>
                    <td><?php _e("The height of your feed. Any number.", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed height=250]</code></td>
                </tr>
                <tr>
                    <td>heightunit</td>
                    <td><?php _e("The unit of the height. 'px' or '%'", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed heightunit=px]</code></td>
                </tr>
                <tr>
                    <td>background</td>
                    <td><?php _e("The background color of the feed. Any hex color code.", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed background=#ffff00]</code></td>
                </tr>
                <tr>
                    <td>class</td>
                    <td><?php _e("Add a CSS class to the feed container", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed class=feedOne]</code></td>
                </tr>

                <tr class="sbi_table_header"><td colspan=3><?php _e("Photos Options", 'instagram-feed'); ?></td></tr>
                <tr>
                    <td>sortby</td>
                    <td><?php _e("Sort the posts by Newest to Oldest (none) or Random (random)", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed sortby=random]</code></td>
                </tr>
                <tr>
                    <td>num</td>
                    <td><?php _e("The number of photos to display initially. Maximum is 33.", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed num=10]</code></td>
                </tr>
                <tr>
                    <td>cols</td>
                    <td><?php _e("The number of columns in your feed. 1 - 10.", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed cols=5]</code></td>
                </tr>
                <tr>
                    <td>imageres</td>
                    <td><?php _e("The resolution/size of the photos. 'auto', full', 'medium' or 'thumb'.", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed imageres=full]</code></td>
                </tr>
                <tr>
                    <td>imagepadding</td>
                    <td><?php _e("The spacing around your photos", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed imagepadding=10]</code></td>
                </tr>
                <tr>
                    <td>imagepaddingunit</td>
                    <td><?php _e("The unit of the padding. 'px' or '%'", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed imagepaddingunit=px]</code></td>
                </tr>
                <tr class="sbi_pro">
                    <td>disablelightbox</td>
                    <td><?php _e("Whether to disable the photo Lightbox. It is enabled by default.", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed disablelightbox=true]</code></td>
                </tr>
                <tr>
                    <td>disablemobile</td>
                    <td><?php _e("Disable the mobile layout. 'true' or 'false'.", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed disablemobile=true]</code></td>
                </tr>

                <tr class="sbi_pro">
                    <td>hovercolor</td>
                    <td><?php _e("The background color when hovering over a photo. Any hex color code.", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed hovercolor=#ff0000]</code></td>
                </tr>
                <tr class="sbi_pro">
                    <td>hovertextcolor</td>
                    <td><?php _e("The text/icon color when hovering over a photo. Any hex color code.", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed hovertextcolor=#fff]</code></td>
                </tr>


                <tr class="sbi_table_header"><td colspan=3><?php _e("Carousel Options", 'instagram-feed'); ?></td></tr>
                <tr class="sbi_pro">
                    <td>carousel</td>
                    <td><?php _e("Display this feed as a carousel", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed carousel=true]</code></td>
                </tr>
                <tr class="sbi_pro">
                    <td>carouselarrows</td>
                    <td><?php _e("Display directional arrows on the carousel", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed carouselarrows=true]</code></td>
                </tr>
                <tr class="sbi_pro">
                    <td>carouselpag</td>
                    <td><?php _e("Display pagination links below the carousel", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed carouselpag=true]</code></td>
                </tr>
                <tr class="sbi_pro">
                    <td>carouselautoplay</td>
                    <td><?php _e("Make the carousel autoplay", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed carouselautoplay=true]</code></td>
                </tr>
                <tr class="sbi_pro">
                    <td>carouseltime</td>
                    <td><?php _e("The interval time between slides for autoplay. Time in miliseconds.", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed carouseltime=8000]</code></td>
                </tr>


                <tr class="sbi_table_header"><td colspan=3><?php _e("Header Options", 'instagram-feed'); ?></td></tr>
                <tr>
                    <td>showheader</td>
                    <td><?php _e("Whether to show the feed Header. 'true' or 'false'.", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed showheader=false]</code></td>
                </tr>
                <tr>
                    <td>headercolor</td>
                    <td><?php _e("The color of the Header text. Any hex color code.", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed headercolor=#333]</code></td>
                </tr>
                
                <tr class="sbi_table_header"><td colspan=3><?php _e("'Load More' Button Options", 'instagram-feed'); ?></td></tr>
                <tr>
                    <td>showbutton</td>
                    <td><?php _e("Whether to show the 'Load More' button. 'true' or 'false'.", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed showbutton=false]</code></td>
                </tr>
                <tr>
                    <td>buttoncolor</td>
                    <td><?php _e("The background color of the button. Any hex color code.", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed buttoncolor=#000]</code></td>
                </tr>
                <tr>
                    <td>buttontextcolor</td>
                    <td><?php _e("The text color of the button. Any hex color code.", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed buttontextcolor=#fff]</code></td>
                </tr>
                <tr>
                    <td>buttontext</td>
                    <td><?php _e("The text used for the button.", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed buttontext="Load More Photos"]</code></td>
                </tr>

                <tr class="sbi_table_header"><td colspan=3><?php _e("'Follow on Instagram' Button Options", 'instagram-feed'); ?></td></tr>
                <tr>
                    <td>showfollow</td>
                    <td><?php _e("Whether to show the 'Follow on Instagram' button. 'true' or 'false'.", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed showfollow=false]</code></td>
                </tr>
                <tr>
                    <td>followcolor</td>
                    <td><?php _e("The background color of the button. Any hex color code.", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed followcolor=#ff0000]</code></td>
                </tr>
                <tr>
                    <td>followtextcolor</td>
                    <td><?php _e("The text color of the button. Any hex color code.", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed followtextcolor=#fff]</code></td>
                </tr>
                <tr>
                    <td>followtext</td>
                    <td><?php _e("The text used for the button.", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed followtext="Follow me"]</code></td>
                </tr>
                
                <tr class="sbi_table_header"><td colspan=3><?php _e("Caption Options", 'instagram-feed'); ?></td></tr>
                <tr class="sbi_pro">
                    <td>showcaption</td>
                    <td><?php _e("Whether to show the photo caption. 'true' or 'false'.", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed showcaption=false]</code></td>
                </tr>
                <tr class="sbi_pro">
                    <td>captionlength</td>
                    <td><?php _e("The number of characters of the caption to display", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed captionlength=50]</code></td>
                </tr>
                <tr class="sbi_pro">
                    <td>captioncolor</td>
                    <td><?php _e("The text color of the caption. Any hex color code.", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed captioncolor=#000]</code></td>
                </tr>
                <tr class="sbi_pro">
                    <td>captionsize</td>
                    <td><?php _e("The size of the caption text. Any number.", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed captionsize=24]</code></td>
                </tr>

                <tr class="sbi_table_header"><td colspan=3><?php _e("Likes &amp; Comments Options", 'instagram-feed'); ?></td></tr>
                <tr class="sbi_pro">
                    <td>showlikes</td>
                    <td><?php _e("Whether to show the Likes &amp; Comments. 'true' or 'false'.", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed showlikes=false]</code></td>
                </tr>
                <tr class="sbi_pro">
                    <td>likescolor</td>
                    <td><?php _e("The color of the Likes &amp; Comments. Any hex color code.", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed likescolor=#FF0000]</code></td>
                </tr>
                <tr class="sbi_pro">
                    <td>likessize</td>
                    <td><?php _e("The size of the Likes &amp; Comments. Any number.", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed likessize=14]</code></td>
                </tr>

                <tr class="sbi_table_header"><td colspan=3><?php _e("Post Filtering Options", 'instagram-feed'); ?></td></tr>
                <tr class="sbi_pro">
                    <td>excludewords</td>
                    <td><?php _e("Remove posts which contain certain words or hashtags in the caption.", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed excludewords="bad, words"]</code></td>
                </tr>
                <tr class="sbi_pro">
                    <td>includewords</td>
                    <td><?php _e("Only display posts which contain certain words or hashtags in the caption.", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed includewords="sunshine"]</code></td>
                </tr>

            </tbody>
        </table>

        <p><i class="fa fa-life-ring" aria-hidden="true"></i>&nbsp; <?php _e('Need help setting up the plugin? Check out our <a href="http://smashballoon.com/instagram-feed/free/" target="_blank">setup directions</a>', 'instagram-feed'); ?></p>

    <?php } //End Display tab ?>


    <?php if( $sbi_active_tab == 'support' ) { //Start Support tab ?>

        <h3><?php _e('Setting up and Customizing the plugin', 'instagram-feed'); ?></h3>
        <p><i class="fa fa-life-ring" aria-hidden="true"></i>&nbsp; <?php _e('<a href="https://smashballoon.com/instagram-feed/free/" target="_blank">Click here for step-by-step setup directions</a>', 'instagram-feed'); ?></p>
        <p style="max-width: 960px;">See below for a short video demonstrating how to set up, customize and use the plugin. <b>Please note</b> that the video shows the set up and use of the <b><a href="https://smashballoon.com/instagram-feed/" target="_blank">PRO version</a></b> of the plugin, but the process is the same for this free version. The only difference is some of the features available.</p>
        <iframe class="youtube-video" src="//www.youtube.com/embed/V_fJ_vhvQXM?theme=light&amp;showinfo=0&amp;controls=2" width="960" height="540" frameborder="0" allowfullscreen="allowfullscreen" style="border: 1px solid #ddd;"></iframe>

        <br />
        <br />
        <p><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp; <?php _e('Still need help? <a href="http://smashballoon.com/instagram-feed/support/" target="_blank">Request support</a>. Please include your <b>System Info</b> below with all support requests.', 'instagram-feed'); ?></p>

        <h3><?php _e('System Info &nbsp; <i style="color: #666; font-size: 11px; font-weight: normal;">Click the text below to select all</i>', 'instagram-feed'); ?></h3>


        <?php $sbi_options = get_option('sb_instagram_settings'); ?>
        <textarea readonly="readonly" onclick="this.focus();this.select()" title="To copy, click the field then press Ctrl + C (PC) or Cmd + C (Mac)." style="width: 100%; max-width: 960px; height: 500px; white-space: pre; font-family: Menlo,Monaco,monospace;">
## SITE/SERVER INFO: ##
Site URL:                 <?php echo site_url() . "\n"; ?>
Home URL:                 <?php echo home_url() . "\n"; ?>
WordPress Version:        <?php echo get_bloginfo( 'version' ) . "\n"; ?>
PHP Version:              <?php echo PHP_VERSION . "\n"; ?>
Web Server Info:          <?php echo $_SERVER['SERVER_SOFTWARE'] . "\n"; ?>

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
sb_instagram_plugin_type => Instagram Feed Free
<?php 
while (list($key, $val) = each($sbi_options)) {
    echo "$key => $val\n";
}
?>
        </textarea>

        
<?php 
} //End Support tab 
?>


    <hr />

    <a href="https://smashballoon.com/instagram-feed/demo" target="_blank" style="display: block; margin: 20px 0 0 0; float: left; clear: both;">
        <img src="<?php echo plugins_url( 'img/instagram-pro-promo.png' , __FILE__ ) ?>" alt="Instagram Feed Pro">
    </a>

    <p class="sbi_plugins_promo dashicons-before dashicons-admin-plugins"> Check out our other free plugins: <a href="https://wordpress.org/plugins/custom-facebook-feed/" target="_blank">Facebook</a> and <a href="https://wordpress.org/plugins/custom-twitter-feeds/" target="_blank">Twitter</a>.</p>

    <div class="sbi_share_plugin">
        <h3><?php _e('Like the plugin? Help spread the word!'); ?></h3>

        <!-- TWITTER -->
        <a href="https://twitter.com/share" class="twitter-share-button" data-url="https://wordpress.org/plugins/instagram-feed/" data-text="Display beautifully clean, customizable, and responsive feeds from multiple Instagram accounts" data-via="smashballoon" data-dnt="true">Tweet</a>
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
        <div class="fb-like" data-href="https://wordpress.org/plugins/instagram-feed/" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true" style="display: block; float: left; margin-right: 20px;"></div>

        <!-- LINKEDIN -->
        <script src="//platform.linkedin.com/in.js" type="text/javascript">
          lang: en_US
        </script>
        <script type="IN/Share" data-url="https://wordpress.org/plugins/instagram-feed/"></script>

        <!-- GOOGLE + -->
        <script src="https://apis.google.com/js/platform.js" async defer></script>
        <div class="g-plusone" data-size="medium" data-href="https://wordpress.org/plugins/instagram-feed/"></div>
    </div>

</div> <!-- end #sbi_admin -->

<?php } //End Settings page

function sb_instagram_admin_style() {
        wp_register_style( 'sb_instagram_admin_css', plugins_url('css/sb-instagram-admin.css', __FILE__), array(), SBIVER );
        wp_enqueue_style( 'sb_instagram_font_awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css' );
        wp_enqueue_style( 'sb_instagram_admin_css' );
        wp_enqueue_style( 'wp-color-picker' );
}
add_action( 'admin_enqueue_scripts', 'sb_instagram_admin_style' );

function sb_instagram_admin_scripts() {
    wp_enqueue_script( '', plugins_url( 'js/sb-instagram-admin.js' , __FILE__ ), array(), SBIVER );

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
add_action( 'admin_enqueue_scripts', 'sb_instagram_admin_scripts' );

// Add a Settings link to the plugin on the Plugins page
$sbi_plugin_file = 'instagram-feed/instagram-feed.php';
add_filter( "plugin_action_links_{$sbi_plugin_file}", 'sbi_add_settings_link', 10, 2 );
 
//modify the link by unshifting the array
function sbi_add_settings_link( $links, $file ) {
    $sbi_settings_link = '<a href="' . admin_url( 'admin.php?page=sb-instagram-feed' ) . '">' . __( 'Settings', 'sb-instagram-feed', 'instagram-feed' ) . '</a>';
    array_unshift( $links, $sbi_settings_link );
 
    return $links;
}

/* Display a notice that can be dismissed regarding updating the Instagram Access Token */
add_action('admin_notices', 'sbi_new_token_notice_2016');
function sbi_new_token_notice_2016() {

    //Only show to admins
    if( current_user_can('manage_options') ){

        global $current_user;
            $user_id = $current_user->ID;

        // Use this to show notice again
        // delete_user_meta($user_id, 'sb_instagram_ignore_notice_2016');

        /* Check that the user hasn't already clicked to ignore the message */
        if ( ! get_user_meta($user_id, 'sb_instagram_ignore_notice_2016') ) {

            _e("
            <div class='sb_instagram_notice'>
                <p class='sb_instagram_notice_title'><i class='fa fa-exclamation-circle' aria-hidden='true'></i> <b>Important</b></p>
                <p><b>Just installed the plugin?</b> You can ignore this notice and hide it using the 'Dismiss' button in the top right corner.</p>
                <p><b>Just updated the plugin?</b> Due to the recent Instagram API changes, in order for the Instagram Feed plugin to continue working after <b><u>June 1st</u></b> you must obtain and save a new Access Token by using the Instagram button on the plugin's <a href='".get_admin_url()."admin.php?page=sb-instagram-feed'>Settings page</a>. This is required even if you recently already obtained a new token. Apologies for any inconvenience.</p>
                <a class='sb_instagram_dismiss' href='" .esc_url( add_query_arg( 'sb_instagram_token_nag_ignore_2016', '0' ) ). "'><i class='fa fa-times-circle' aria-hidden='true'></i> Dismiss</a>
            </div>
            ");

        }

    }

}
add_action('admin_init', 'sb_instagram_token_nag_ignore_2016');
function sb_instagram_token_nag_ignore_2016() {
    global $current_user;
        $user_id = $current_user->ID;
        if ( isset($_GET['sb_instagram_token_nag_ignore_2016']) && '0' == $_GET['sb_instagram_token_nag_ignore_2016'] ) {
             add_user_meta($user_id, 'sb_instagram_ignore_notice_2016', 'true', true);
    }
}



//REVIEW REQUEST NOTICE

// checks $_GET to see if the nag variable is set and what it's value is
function sbi_check_nag_get( $get, $nag, $option, $transient ) {
    if ( isset( $_GET[$nag] ) && $get[$nag] == 1 ) {
        update_option( $option, 'dismissed' );
    } elseif ( isset( $_GET[$nag] ) && $get[$nag] == 'later' ) {
        $time = 2 * WEEK_IN_SECONDS;
        set_transient( $transient, 'waiting', $time );
        update_option( $option, 'pending' );
    }
}

// will set a transient if the notice hasn't been dismissed or hasn't been set yet
function sbi_maybe_set_transient( $transient, $option ) {
    $sbi_rating_notice_waiting = get_transient( $transient );
    $notice_status = get_option( $option, false );

    if ( ! $sbi_rating_notice_waiting && !( $notice_status === 'dismissed' || $notice_status === 'pending' ) ) {
        $time = 2 * WEEK_IN_SECONDS;
        set_transient( $transient, 'waiting', $time );
        update_option( $option, 'pending' );
    }
}

// generates the html for the admin notice
function sbi_rating_notice_html() {

    //Only show to admins
    if ( current_user_can( 'manage_options' ) ){

        global $current_user;
        $user_id = $current_user->ID;

        /* Check that the user hasn't already clicked to ignore the message */
        if ( ! get_user_meta( $user_id, 'sbi_ignore_rating_notice') ) {

            _e("
            <div class='sbi_notice sbi_review_notice'>
                <img src='". plugins_url( 'instagram-feed/img/sbi-icon.png' ) ."' alt='Instagram Feed'>
                <div class='ctf-notice-text'>
                    <p>It's great to see that you've been using the <strong>Instagram Feed</strong> plugin for a while now. Hopefully you're happy with it!&nbsp; If so, would you consider leaving a positive review? It really helps to support the plugin and helps others to discover it too!</p>
                    <p class='links'>
                        <a class='sbi_notice_dismiss' href='https://wordpress.org/support/view/plugin-reviews/instagram-feed' target='_blank'>Sure, I'd love to!</a>
                        &middot;
                        <a class='sbi_notice_dismiss' href='" .esc_url( add_query_arg( 'sbi_ignore_rating_notice_nag', '1' ) ). "'>No thanks</a>
                        &middot;
                        <a class='sbi_notice_dismiss' href='" .esc_url( add_query_arg( 'sbi_ignore_rating_notice_nag', '1' ) ). "'>I've already given a review</a>
                        &middot;
                        <a class='sbi_notice_dismiss' href='" .esc_url( add_query_arg( 'sbi_ignore_rating_notice_nag', 'later' ) ). "'>Ask Me Later</a>
                    </p>
                </div>
                <a class='sbi_notice_close' href='" .esc_url( add_query_arg( 'sbi_ignore_rating_notice_nag', '1' ) ). "'><i class='fa fa-close'></i></a>
            </div>
            ");

        }

    }
}

// variables to define certain terms
$transient = 'instagram_feed_rating_notice_waiting';
$option = 'sbi_rating_notice';
$nag = 'sbi_ignore_rating_notice_nag';

sbi_check_nag_get( $_GET, $nag, $option, $transient );
sbi_maybe_set_transient( $transient, $option );
$notice_status = get_option( $option, false );

// only display the notice if the time offset has passed and the user hasn't already dismissed it
if ( get_transient( $transient ) !== 'waiting' && $notice_status !== 'dismissed' ) {
    add_action( 'admin_notices', 'sbi_rating_notice_html' );
}


?>