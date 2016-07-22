<?php
/**
 * Plugin Name: App look-alike menus
 * Plugin URI: http://mmenu.frebsite.nl/wordpress-plugin.html
 * Description: The best WordPress plugin for app look-alike off-canvas mega menus with sliding submenus for your WordPress website.
 * Version: 2.4.1
 * Author: Fred Heusschen
 * Author URI: http://www.frebsite.nl
 */


require_once( dirname( __FILE__ ) . '/php/mm_adminpage.php' );



class MmenuAdminPage extends MmAdminPage {
	
	protected $name			= 'mmenu';
	protected $version 		= '2.4.1';
	protected $screen_id 	= 'toplevel_page_mmenu';

	protected $options = array(
		'mm_setup' => array(
			'version',
			'menu',
			'button'
		),
		'mm_menu' => array(
			'position',
			'backgroundcolor',
			'theme',
			'breakpoint'
		),
		'mm_header'	=> array(
			'navigate',
			'navigate_title',
			'navigate_close',

			'image',
			'image_src',
			'image_scale',
			'image_height',

			'searchfield',
			'searchfield_sitesearch',
			'searchfield_placeholder',
			'searchfield_noresults',

			'buttons_html',
			'buttons_selector',
			'button_1_icon', 'button_1_href', 'button_1_target',
			'button_2_icon', 'button_2_href', 'button_2_target',
			'button_3_icon', 'button_3_href', 'button_3_target',
			'button_4_icon', 'button_4_href', 'button_4_target',
			'button_5_icon', 'button_5_href', 'button_5_target'
		),
		'mm_footer'	=> array(
			'buttons_html',
			'buttons_selector',
			'button_1_icon', 'button_1_href', 'button_1_target',
			'button_2_icon', 'button_2_href', 'button_2_target',
			'button_3_icon', 'button_3_href', 'button_3_target',
			'button_4_icon', 'button_4_href', 'button_4_target',
			'button_5_icon', 'button_5_href', 'button_5_target'
		),
		'mm_advanced' => array(
			'pagedim',
			'pageshadow',
			'slidemenu',
			'indentborder',
			'truncatelistitems',
			'counters',
			'fullsubopen',
			'fullscreen'
		)
	);

	protected $helptabs = array(
		array(
			'id'        => 'mmenu-help-menu',
			'title'     => 'Locate the menu',
			'content'   => '
				<p><strong>Locate the menu</strong><br />
					All menus used by your theme are automatically listed in the "selector" combobox. If the menu you\'re looking for isn\'t listed, you can either specify it manually or use the "locate on website" button.</p>
				<p>The "locate on website" popup makes an educated guess about what HTML element might be the menu, using common HTML patterns used by WordPress.<br />
					If that also does not find the menu, you can still specify it manually by typing the selector (for example "#my-menu") in the "selector" combobox.</p>'
		),
		array(
			'id'        => 'mmenu-help-button',
			'title'     => 'Locate the button',
			'content'   => '
				<p><strong>Locate the menu button</strong><br />
					All menu buttons used by your theme are automatically listed in the "selector" combobox. If the button you\'re looking for isn\'t listed, you can either specify it manually or use the "locate on website" button.</p>
				<p>The "locate on website" popup makes an educated guess about what HTML element might be the menu button, using common HTML patterns used by WordPress.<br />
					If that also does not find the button, you can still specify it manually by typing the selector (for example "#my-button") in the "selector" combobox.</p>'
		),
		array(
			'id'        => 'mmenu-help-icons',
			'title'     => 'Help and suboptions',
			'content'   => '
				<p><strong>Help</strong><br />
					Click on the "help"-icon next to an option (if present) to reveal additional information about the option.</p>
				<p><strong>Suboptions</strong><br />
					Click on the "gear"-icon next to an option (if present) to reveal additional (sub)options.</p>'
		),
		array(
			'id'        => 'mmenu-help-styling',
			'title'     => 'Additional styling',
			'content'   => '
				<p><strong>Vertical submenu</strong><br />
					Add the classname "Vertical" to a menu item if you want its submenu to expand below it.</p>
				<p><strong>Spacers</strong><br />
					Add the classname "Spacer" to a menu item if you want it to have more whitespace at the top.</p>
				<p><strong>Fixed elements</strong><br />
					Add the classname "Fixed" to a fixed element on your webpage if you want it to move out of view when opening the menu.</p>'
		)
    );



	public function __construct()
	{
		parent::__construct();
		add_action( 'admin_init', array( $this, 'header_image_init' ) );
	}



	/*
		The menu item + page
	*/
	public function add_menu_page()
	{
		add_menu_page( 
			'mmenu',
			'mmenu',
			'manage_options',
			'mmenu',
			array( $this, 'create_admin_page' ),
			'dashicons-menu'
		);
	}

	public function create_admin_page()
	{

	    parent::create_admin_page();

	    $this->checkWritable();

	    add_thickbox();

	    $updated 	= isset( $_SESSION[ 'submit' ] );
	    $preview 	= isset( $_SESSION[ 'preview' ] );
	    $first 		= get_option( 'mm_setup', false );
		$first 		= !is_array( $first );
		$version	= get_option( 'mm_setup', array() );
		$version 	= isset( $version[ 'version' ] ) ? $version[ 'version' ] : 0;

		if ( $updated )
		{
			unset( $_SESSION[ 'submit' ] );
			$this->saveFrontend();
			$this->echo_updated( 'Settings have been saved and published.' );
		}
		if ( $preview )
		{
			unset( $_SESSION[ 'preview' ] );
			$this->saveFrontend( '-preview' );
		}

		echo '
		<div class="wrap' . ( $preview ? ' mmenu-preview' : '' ) . ( $first ? ' mmenu-setup' : '' ) . '">';

		$this->echo_title( '<span>mmenu</span> App look-alike menu for WordPress <small>' .
			'Version ' . $this->version . '</small>', 'mmenu' );


		$mm_setup 		= get_option( 'mm_setup'	, array() );
		$mm_menu 		= get_option( 'mm_menu'		, array() );
		$mm_header 		= get_option( 'mm_header'	, array() );
		$mm_footer 		= get_option( 'mm_footer'	, array() );
		$mm_advanced 	= get_option( 'mm_advanced'	, array() );


		$this->echo_form_opener( 'mmenu-settings' );


		if ( $preview )
		{
			echo '
			<div class="phone">
				<iframe src="' . get_home_url() . '?mmenu=preview"></iframe>
			</div>
			<p class="submit-preview">
				<strong>Happy with the result?</strong><br />
				<input type="submit" name="submit" value="Yes, publish it!" class="button button-primary button-large" /><br />
				<br />
				<a href="#mmenu-settings">Not yet, I need to make some more changes.</a>
			</p>';
		}

		echo '
			<input name="mm_setup[version]" value="' . ( $version + 1 ) . '" type="hidden" />';


		$this->opt_setup( 		$first, $mm_setup, $mm_menu, $mm_header, $mm_footer, $mm_advanced );
		$this->opt_menu( 		$first, $mm_setup, $mm_menu, $mm_header, $mm_footer, $mm_advanced );
		$this->opt_header( 		$first, $mm_setup, $mm_menu, $mm_header, $mm_footer, $mm_advanced );
		$this->opt_footer( 		$first, $mm_setup, $mm_menu, $mm_header, $mm_footer, $mm_advanced );
		$this->opt_advanced( 	$first, $mm_setup, $mm_menu, $mm_header, $mm_footer, $mm_advanced );


		if ( $first )
		{
			echo '
				<p class="submit">
					<a href="#" class="next button button-primary button-large">Next</a>
					<input type="submit" name="proceed" value="Save & proceed" class="button button-primary button-large" />
				</p>';
		}
		else
		{
			echo '
				<p class="submit-fixed">
					<input type="submit" name="preview" value="Save & preview" class="button" />
					<input type="submit" name="submit" value="Save & publish" class="button button-primary button-large" />
				</p>';
		}

		$this->echo_form_closer();
		$this->locate_popup();

		echo '
		</div>';
	}

	protected function opt_setup( $first, $mm_setup, $mm_menu, $mm_header, $mm_footer, $mm_advanced )
	{
		echo '
			<h2>Setup</h2>';

		if ( $first )
		{
			echo '
			<p class="intro"><strong>Great!</strong> You\'ve successfully downloaded and installed the mmenu WordPress plugin.</p>';

			$this->echo_section_opener();
			echo '
			<p>You are only a few clicks away from creating an app look-alike menu.<br />
				But first, we need to locate some elements on the website.</p>';
			$this->echo_section_closer();
		}

		$this->opt_setup_menu_selector( $first, $mm_setup );
		$this->opt_setup_button_selector( $first, $mm_setup );
	}
	protected function opt_setup_menu_selector( $first, $mm_setup )
	{
		$inp = $this->selectorInput( 'menu', $mm_setup );
		if ( $first )
		{
			$inp .= '
				<span class="first-visit-helper fvh-1">Type a selector</span>
				<span class="first-visit-helper fvh-2">Choose one from the combobox,</span>
				<span class="first-visit-helper fvh-3">Or locate it on the website.</span>
				<span class="first-visit-helper fvh-4">Click the "help"-icon for help.</span>';
		}

		$this->echo_section_opener();
		$this->echo_form_table_opener();
		$this->echo_form_table_row(
			'Locate the menu<br />
				<small>Specify a CSS selector that targets the menu container.</small>',
			$inp,
			null,
			'help'
		);

		//	explanation
		$this->echo_form_table_row(
			'',
			'<p>The selector should target the element surrounding the main <code>UL</code>.<br />
				For example, the HTML below results in the selector <code>#my-menu</code>.</p>
<pre>&lt;nav id="my-menu"&gt;
   &lt;ul&gt;
      &lt;li&gt;&lt;a href="/"&gt;Home&lt;/a&gt;&lt;/li&gt;
   &lt;/ul&gt;
&lt;/nav&gt;</pre>',
			'explanation'
		);

		$this->echo_form_table_closer();
		$this->echo_section_closer();
	}
	protected function opt_setup_button_selector( $first, $mm_setup )
	{
		$inp = $this->selectorInput( 'button', $mm_setup );
		if ( $first )
		{
			$inp .= '
				<span class="first-visit-helper fvh-1">Type a selector,</span>
				<span class="first-visit-helper fvh-2">choose one from the combobox,</span>
				<span class="first-visit-helper fvh-3">or locate the element on the website.</span>
				<span class="first-visit-helper fvh-4">Click the "help"-icon for help.</span>';
		}
		$this->echo_section_opener();
		$this->echo_form_table_opener();
		$this->echo_form_table_row(
			'Locate the menu button<br />
				<small>Specify a CSS selector that targets an anchor or a button.</small>',
			$inp,
			null,
			'help'
		);

		//	explanation
		$this->echo_form_table_row(
			'',
			'<p>The selector should target an anchor (<code>&lt;a /&gt;</code>) or a button (<code>&lt;button /&gt;</code>) for opening the menu.
				For example, the HTML below results in the selector <code>#my-button</code>.</p>
<pre>&lt;a id="my-button" href="#my-menu"&gt;open menu&lt;/a&gt;</pre>
				<p>If it doesn\'t yet look like a hamburger icon, you\'ll have to <a target="_blank" href="http://css-tricks.com/three-line-menu-navicon">do that yourself</a>.</p>',
			'explanation'
		);
		$this->echo_form_table_closer();
		$this->echo_section_closer();
	}

	protected function opt_menu( $first, $mm_setup, $mm_menu, $mm_header, $mm_footer, $mm_advanced )
	{
		if ( $first )
		{
			echo '
				<input type="hidden" name="mm_menu[position]" value="left" />
				<input type="hidden" name="mm_menu[backgroundcolor]" value="#f3f3f3" />
				<input type="hidden" name="mm_menu[breakpoint]" value="Never" />';
		}
		else
		{
			echo '
			<h2>Menu options</h2>';

			$this->opt_menu_position( $mm_menu );
			$this->opt_menu_background( $mm_menu );
			$this->opt_menu_breakpoint( $mm_menu );
		}
	}

	protected function opt_menu_position( $mm_menu )
	{
		$this->echo_section_opener();
		$this->echo_form_table_opener();
		$this->echo_form_table_row(
			'Position the menu<br />
				<small>Select how to position the menu; at the left, at the bottom, at the right or at the top side of the page.</small>',
			$this->html_radio_preview(
				array( $mm_menu, 'mm_menu', 'position' ),
				array(
					'left' 		=> 'At the left',
					'bottom'	=> 'At the bottom',
					'right'		=> 'At the right',
					'top'		=> 'At the top'
				)
			)
		);
		$this->echo_form_table_closer();
		$this->echo_section_closer();
	}
	protected function opt_menu_background( $mm_menu )
	{
		$this->echo_section_opener();
		$this->echo_form_table_opener();
		$this->echo_form_table_row(
			'Choose a background color<br />
				<small>Any color will do. Dark, light, black or white, the menu will always look good.</small>',
			$this->html_input( array( $mm_menu,'mm_menu', 'backgroundcolor' ) ) .
			$this->html_input( array( $mm_menu,'mm_menu', 'theme' ), 'hidden' )
		);
		$this->echo_form_table_closer();
		$this->echo_section_closer();
	}
	protected function opt_menu_breakpoint( $mm_menu )
	{
		$this->echo_section_opener();
		$this->echo_form_table_opener();
		$this->echo_form_table_row(
			'The menu on wider screens<br />
				<small>As of what screen width should the mobile menu always be visible?</small>',
			'<span class="combobox is-combobox">' . $this->html_input( array( $mm_menu, 'mm_menu', 'breakpoint' ), 'text', 'placeholder="1400px"' ) . '
				<select id="breakpoint_select">
					<option value=""></option>
					<option value="Never">Never show the mobile menu on wider screens</option>
					<optgroup label="Common breakpoints">
						<option value="768px">768px</option>
						<option value="1224px">1224px</option>
						<option value="1824px">1824px</option>
					</optgroup>
					<optgroup id="theme_breakpoints_list" label="Defined by the theme"></optgroup>
				</select>
			</span>',
			null,
			'help'
		);

		//	explanation
		$this->echo_form_table_row(
			'',
			'<p>Type or select a <code>min-width</code> (in pixels). When the visitor resizes his screen larger than the given width, the mobile menu will become visible on the left next to the page.
				For example, typing <code>1400</code> will result in the media query <code>screen and (min-width: 1400px)</code>.</p>
			<br />
			<p>If you don\'t want the mobile menu to always be visible on wider screens, empty the value or select the "Never" option.</p>',
			'explanation'
		);
		$this->echo_form_table_closer();
		$this->echo_section_closer();
	}

	protected function opt_header( $first, $mm_setup, $mm_menu, $mm_header, $mm_footer, $mm_advanced )
	{
		if ( $first )
		{
			echo '
				<input type="hidden" name="mm_header[navigate]" value="button" />
				<input type="hidden" name="mm_header[image]" value="no" />
				<input type="hidden" name="mm_header[searchfield]" value="no" />';
		}
		else
		{
			echo '
			<h2>Header options</h2>';

			$this->opt_header_navigate( $mm_header );
			$this->opt_header_image( $mm_header );
			$this->opt_header_searchfield( $mm_header );
			$this->opt_header_buttons( $mm_header );
		}
	}
	protected function opt_header_navigate( $mm_header )
	{
		$this->echo_section_opener();
		$this->echo_form_table_opener();
		$this->echo_form_table_row(
			'Select how to navigate<br />
				<small>Select how to navigate between different levels in the menu.</small>',
			$this->html_radio_preview(
				array( $mm_header, 'mm_header', 'navigate' ),
				array(
					'button'		=> 'With a back-button',
					'breadcrumbs'	=> 'With breadcrumbs',
					'iconpanels'	=> 'By showing a small part of the parent level',
					'dropdown'		=> 'With dropdown submenus',
				), 'button'
			),
			null,
			true
		);

		//	header close option
		$this->echo_form_table_row(
			'',
			$this->html_checkbox( array( $mm_header, 'mm_header', 'navigate_close' ) ) .
				'<label for="mm_header_navigate_close">Add a button that closes the menu.</label>',
			'suboptions'
		);

		//	header title option
		$this->echo_form_table_row(
			'',
			'<label for="mm_header_navigate_title">Specify the title above the main <code>UL</code>:</label><br />' .
				$this->html_input( array( $mm_header, 'mm_header', 'navigate_title' ), 'text', 'placeholder="Menu"' ),
			'suboptions'
		);

		$this->echo_form_table_closer();
		$this->echo_section_closer();
	}
	protected function opt_header_image( $mm_header )
	{
		$this->echo_section_opener();
		$this->echo_form_table_opener();
		$this->echo_form_table_row(
			'Add a logo or photo<br />
				<small>Personalize the menu by prepending it with a company logo or maybe a photo of yourself.</small>',
			$this->html_radio_preview(
				array( $mm_header, 'mm_header', 'image' ),
				array(
					'no'	=> 'No thanks',
					'yes'	=> 'Yes please!'
				), 'yes'
			) . $this->html_input( array( $mm_header, 'mm_header', 'image_src' ), 'hidden' ),
			null,
			true
		);

		//	header image size option
		$this->echo_form_table_row(
			'',
			'<label for="mm_header_image_scale">Specify how the image should be scaled.</label><br />' .
				$this->html_select( array( $mm_header, 'mm_header', 'image_scale' ),
					array(
						'contain'	=> 'Scale down the image to fit in the available space.',
						'cover' 	=> 'Strech out the image to cover up the available space.'
					)
				),
			'suboptions'
		);

		//	header image height option
		$this->echo_form_table_row(
			'',
			'<label for="mm_header_image_height">Specify the preferred height for the image.<br />
				<small>Note that adding a searchfield or buttons will decrease the available height.</small></label><br />' .
				$this->html_select( array( $mm_header, 'mm_header', 'image_height' ),
					array(
						'4' => '160px',
						'3' => '120px',
						'2' => '80px',
						'1'	=> '40px'
					)
				),
			'suboptions'
		);

		$this->echo_form_table_closer();
		$this->echo_section_closer();
	}
	protected function opt_header_searchfield( $mm_header )
	{
		$this->echo_section_opener();
		$this->echo_form_table_opener();
		$this->echo_form_table_row(
			'Add a searchfield<br />
				<small>Enable your visitors to search through the menu items by prepending a searchfield to the menu.</small>',
			$this->html_radio_preview(
				array( $mm_header, 'mm_header', 'searchfield' ),
				array(
					'no'	=> 'No thanks',
					'yes'	=> 'Yes please!'
				), 'yes'
			),
			null,
			true
		);

		//	search site option
		$this->echo_form_table_row(
			'',
			$this->html_checkbox( array( $mm_header, 'mm_header', 'searchfield_sitesearch' ) ) .
				'<label for="mm_header_searchfield_sitesearch">Add a submit button to search the website.</label>',
			'suboptions'
		);

		//	placeholder option
		$this->echo_form_table_row(
			'',
			'<label for="mm_header_searchfield_placeholder">Specify the placeholder text for the searchfield:</label><br />' .
				$this->html_input( array( $mm_header,'mm_header', 'searchfield_placeholder' ), 'text', 'placeholder="Search"' ),
			'suboptions'
		);

		//	no results option
		$this->echo_form_table_row(
			'',
			'<label for="mm_header_searchfield_noresults">Specify the text (or HTML) to show when no results are found:</label><br />' .
				$this->html_input( array( $mm_header, 'mm_header', 'searchfield_noresults' ), 'text', 'placeholder="No results found."' ),
			'suboptions'
		);

		$this->echo_form_table_closer();
		$this->echo_section_closer();
	}
	protected function opt_header_buttons( $mm_header )
	{
		$this->echo_section_opener();
		$this->echo_form_table_opener();

		$this->opt_buttons( $mm_header, 'mm_header' );

		$this->echo_form_table_closer();
		$this->echo_section_closer();
	}

	protected function opt_footer( $first, $mm_setup, $mm_menu, $mm_header, $mm_footer, $mm_advanced )
	{
		if ( !$first )
		{
			echo '
			<h2>Footer options</h2>';

			$this->opt_footer_buttons( $mm_footer );
		}
	}
	protected function opt_footer_buttons( $mm_footer )
	{
		$this->echo_section_opener();
		$this->echo_form_table_opener();

		$this->opt_buttons( $mm_footer, 'mm_footer' );

		$this->echo_form_table_closer();
		$this->echo_section_closer();
	}

	protected function opt_advanced( $first, $mm_setup, $mm_menu, $mm_header, $mm_footer, $mm_advanced )
	{
		if ( $first )
		{
			echo '
				<input type="hidden" name="mm_advanced[pageshadow]" value="yes" />
				<input type="hidden" name="mm_advanced[slidemenu]" value="yes" />
				<input type="hidden" name="mm_advanced[indentborder]" value="yes" />
				<input type="hidden" name="mm_advanced[truncatelistitems]" value="yes" />
				<input type="hidden" name="mm_advanced[counters]" value="yes" />
				<input type="hidden" name="mm_advanced[fullsubopen]" value="yes" />';
		}
		else
		{
			echo '
			<h2>Advanced options</h2>
			<p class="intro">Some options to finetune the look and feel of your menu.</p>';

			$this->echo_section_opener();

			echo '
			<div class="advanced-options">';

			$this->opt_advanced_pageshadow( $mm_advanced );
			$this->opt_advanced_pagedim( $mm_advanced );
			$this->opt_advanced_slidemenu( $mm_advanced );
			$this->opt_advanced_indentborder( $mm_advanced );
			$this->opt_advanced_truncatelistitems( $mm_advanced );
			$this->opt_advanced_counters( $mm_advanced );
			$this->opt_advanced_fullsubopen( $mm_advanced );
			$this->opt_advanced_fullscreen( $mm_advanced );

			echo '
			</div>';

			$this->echo_section_closer();
		}
	}

	protected function opt_advanced_pageshadow( $mm_advanced )
	{
		echo '
				<div>' . 
					$this->html_checkbox( array( $mm_advanced, 'mm_advanced', 'pageshadow' ) ) .
					'<label for="mm_advanced_pageshadow">Add a shadow to the page.</label>' .
				'</div>';
	}
	protected function opt_advanced_pagedim( $mm_advanced )
	{
		echo '
				<div>' . 
					$this->html_checkbox( array( $mm_advanced, 'mm_advanced', 'pagedim' ) ) .
					'<label for="mm_advanced_pagedim">Dim out the page to black.</label>' .
				'</div>';
	}
	protected function opt_advanced_slidemenu( $mm_advanced )
	{
		echo '
				<div>' . 
					$this->html_checkbox( array( $mm_advanced, 'mm_advanced', 'slidemenu' ) ) .
					'<label for="mm_advanced_slidemenu">Slide out the menu a bit.</label>' .
				'</div>';
	}
	protected function opt_advanced_indentborder( $mm_advanced )
	{
		echo '
				<div>' . 
					$this->html_checkbox( array( $mm_advanced, 'mm_advanced', 'indentborder' ) ) .
					'<label for="mm_advanced_indentborder">Indent the menu item borders.</label>' .
				'</div>';
	}
	protected function opt_advanced_truncatelistitems( $mm_advanced )
	{
		echo '
				<div>' . 
					$this->html_checkbox( array( $mm_advanced, 'mm_advanced', 'truncatelistitems' ) ) .
					'<label for="mm_advanced_truncatelistitems">Truncate menu items to a single line.</label>' .
				'</div>';
	}
	protected function opt_advanced_counters( $mm_advanced )
	{
		echo '
				<div>' . 
					$this->html_checkbox( array( $mm_advanced, 'mm_advanced', 'counters' ) ) .
					'<label for="mm_advanced_counters">Add a counter for submenus.</label>' .
				'</div>';
	}
	protected function opt_advanced_fullsubopen( $mm_advanced )
	{
		echo '
				<div>' . 
					$this->html_checkbox( array( $mm_advanced, 'mm_advanced', 'fullsubopen' ) ) .
					'<label for="mm_advanced_fullsubopen">&lt;a href="#"&gt; opens submenu</label>' .
				'</div>';
	}
	protected function opt_advanced_fullscreen( $mm_advanced )
	{
		echo '
				<div>' . 
					$this->html_checkbox( array( $mm_advanced, 'mm_advanced', 'fullscreen' ) ) .
					'<label for="mm_advanced_fullscreen">Open the menu fullscreen.</label>' .
				'</div>';
	}


	protected function locate_popup()
	{
		require_once 'lib/locate/locate-popup.html';
	}

	protected function selectorInput( $id, $optn, $ostr = 'mm_setup', $plch = null, $type = null )
	{
		$plch = ( $plch ) ? $plch : '#my-' . $id;
		$type = ( $type ) ? $type : $id;

		return '
			<p class="combobox_locate"><span class="combobox">' . $this->html_input( array( $optn, $ostr, $id ), 'text', 'placeholder="' . $plch . '"' ) . '
					<select id="' . $id . '_select"></select>
				</span>
				<a href="#TB_inline?width=600&height=500&inlineId=locate" class="button locate thickbox" data-type="' . $type . '">Locate on the website</a></p>
			<p class="selector-warning">
				<strong>Uh oh...</strong><br />
				This selector targets more than one element, only the first will be used.<br />
				<a class="button dismiss" href="#">OK, I understand</a></p>
			<p class="selector-error">
				<strong>Oops!</strong><br />
				No element found with this selector! Are you sure it is correct?<br />
				<a class="button dismiss" href="#">Yes, I\'m sure</a></p>';
	}

	protected function opt_buttons( $optn, $ostr = 'mm_header' )
	{
		$this->echo_form_table_row(
			'Add buttons<br />
				<small>Type some HTML, specify a jQuery selector that targets a single or multiple anchors and/or create buttons manually.</small>',

			'<div class="buttons_html">' .
				$this->html_input( array( $optn, $ostr, 'buttons_html' ), 'text', 'placeholder="&lt;a href=&quot;/&quot;&gt;Home&lt;/a&gt;"' ) .
			'</div>' .
			$this->selectorInput( 'buttons_selector', $optn, $ostr, 'ul.buttons a', 'anchors' ) .
			'<div class="buttons">' .
				$this->createButtonHead() . 
				$this->createButton( 'button_1', $optn, $ostr ) . 
				$this->createButton( 'button_2', $optn, $ostr ) .
				$this->createButton( 'button_3', $optn, $ostr ) .
				$this->createButton( 'button_4', $optn, $ostr ) .
				$this->createButton( 'button_5', $optn, $ostr ) .
				$this->createButtonFoot() .
			'</div>'
		);
	}
	protected function createButton( $id, $optn, $ostr )
	{
		$icn = ( isset( $optn[ $id . '_icon' ] ) )
			? ' dashicons ' . $optn[ $id . '_icon' ]
			: '';

		return '
			<div class="buttons-button">
				<div data-target="#' . $ostr . '_' . $id . '_icon' . '" class="button dashicons-picker' . $icn . '"></div>
				' . $this->html_input( 	array( $optn, $ostr, $id . '_icon' )	, 'hidden' ) . '
				' . $this->html_input( 	array( $optn, $ostr, $id . '_href' )	, 'text', 'placeholder="http://website.com"' ) . '
				' . $this->html_select( array( $optn, $ostr, $id . '_target' )	,
						array(
							'_self'		=> '_self',
							'_blank' 	=> '_blank'
						)
					) . '
				<a href="#" class="dashicons dashicons-no"></a>
			</div>';
	}
	protected function createButtonHead()
	{
		return '
			<div class="buttons-head">
				<span>href:</span>
				<span>target:</span>
			</div>';
	}
	protected function createButtonFoot()
	{
		return '
			<div class="buttons-foot">
				<a href="#" class="button">Add button</a>
			</div>';
	}

	protected function checkWritable()
	{
		$dir = dirname( __FILE__ ) . '/';
		$str = 'wp-content/plugins/mmenu/';
		$err = array();

		foreach(
			array( 
				'css/mmenu.css',
				'css/mmenu-preview.css',
				'js/mmenu.js',
				'js/mmenu-preview.js'
			) as $file
		) {
			if ( !is_writable( $dir . $file ) )
			{
				$err[] = '<p>The file <strong>' . $str . $file . '</strong> is not writable, you need to chmod its permissions to at least 664.</p>';
			}
		}

		if ( count( $err ) > 0 )
		{
	        echo '
	        	<div class="error">' . implode( '', $err ) . '</div>';
		}
	}



	/*
		Change text on media-upload
	*/
	public function header_image_init()
	{
		global $pagenow;
	    if ( 'media-upload.php' == $pagenow || 'async-upload.php' == $pagenow )
	    {
	        add_filter( 'gettext', array( $this, 'header_image_button_text' ), 1, 3 );
	    }
	}
	public function header_image_button_text( $translated_text, $text, $domain )
	{
		if ( 'Insert into Post' == $text )
		{
			$referer = strpos( wp_get_referer(), 'mmenu-header-image' );
			if ( $referer != '' )
			{
				return 'Use this image!';
			}
		}
		return $translated_text;
	}



	/*
		Save the frontend .js and .css file
	*/
	protected function sanitizeStr( $str )
	{
		$str = str_replace( "'", "\'", $str );
		return $str;
	}
	protected function saveFrontend( $fileAffix = '' )
	{
		$mm = array();
		foreach( $this->options as $option => $suboptions )
		{
			$k = substr( $option, 3 );
			$mm[ $k ] = get_option( $option );
			if ( !isset( $mm[ $k ] ) )
			{
				$mm[ $k ] = array();
			}
			foreach( $suboptions as $suboption )
			{
				if ( !isset( $mm[ $k ][ $suboption ] ) )
				{
					$mm[ $k ][ $suboption ] = '';
				}
				$mm[ $k ][ $suboption ] = $this->sanitizeStr( $mm[ $k ][ $suboption ] );
			}
		}

		if ( $mm[ 'menu' ][ 'breakpoint' ] == 'Never' )
		{
			 $mm[ 'menu' ][ 'breakpoint' ] = false;
		}


		//	Create onDocumentReady script
		$o = array();
		$c = array();


		//	Counters
		if ( $mm[ 'advanced' ][ 'counters' ] == 'yes' )
		{
			$o[] = 'counters: true';
		}


		//	Extensions
		$x = array();

		if ( $mm[ 'menu' ][ 'theme' ] != 'light' )
		{
			$x[] = 'theme-' . $mm[ 'menu' ][ 'theme' ];
		}

		if ( $mm[ 'advanced' ][ 'pageshadow' ] == 'yes' )
		{
			$x[] = 'pageshadow';
		}
		if ( $mm[ 'advanced' ][ 'pagedim' ] == 'yes' )
		{
			$x[] = 'pagedim-black';
		}

		if ( $mm[ 'advanced' ][ 'slidemenu' ] == 'yes' && 
			$mm[ 'menu' ][ 'position' ] != 'bottom' &&
			$mm[ 'menu' ][ 'position' ] != 'top'
		) {
			$x[] = 'effect-slide-menu';
		}

		if ( $mm[ 'advanced' ][ 'indentborder' ] != 'yes' )
		{
			$x[] = 'border-full';
		}

		if ( $mm[ 'advanced' ][ 'truncatelistitems' ] != 'yes' )
		{
			$x[] = 'multiline';
		}

		if ( $mm[ 'advanced' ][ 'fullscreen' ] == 'yes' )
		{
			$x[] = 'fullscreen';
		}

		if ( $mm[ 'menu' ][ 'breakpoint' ] )
		{
			$x[] = 'widescreen';
		}

		if ( count( $x ) > 0 )
		{
			$o[] = '
			extensions: ["' . implode( '", "', $x ) . '"]';
		}


		//	IconPanels
		if ( $mm[ 'header' ][ 'navigate' ] == 'iconpanels' )
		{
			$o[] = '
			iconPanels: true';
		}


		//	OffCanvas
		$x = array();
		$x[] = 'moveBackground: false';
		
		if ( $mm[ 'menu' ][ 'position' ] != 'left' )
		{
			$x[] = 'position: "' . $mm[ 'menu' ][ 'position' ] . '"';
		}

		if ( $mm[ 'menu' ][ 'position' ] == 'bottom' ||
			$mm[ 'menu' ][ 'position' ] == 'top'
		) {
			$x[] = 'zposition: "front"';
		}

		if ( count( $x ) > 0 )
		{
			$o[] = '
			offCanvas: {
				' . implode( ",\n\t\t\t\t", $x ) . '
			}';
		}


		//	Searchfield
		$x = array();
		if ( $mm[ 'header' ][ 'searchfield' ] == 'yes' )
		{
			if ( strlen( $mm[ 'header' ][ 'searchfield_placeholder' ] ) > 0 )
			{
				$x[] = 'placeholder: "' . $mm[ 'header' ][ 'searchfield_placeholder' ] . '"';
			}
			if ( strlen( $mm[ 'header' ][ 'searchfield_noresults' ] ) > 0 )
			{
				$x[] = 'noResults: "' . $mm[ 'header' ][ 'searchfield_noresults' ] . '"';
			}
		}

		if ( count( $x ) > 0 )
		{
			$o[] = '
			searchfield: {
				' . implode( ",\n\t\t\t\t", $x ) . '
			}';
		}


		//	Navbar
		$x = array();
		if ( $mm[ 'header' ][ 'navigate' ] == 'button' )
		{
			if ( strlen( $mm[ 'header' ][ 'navigate_title' ] ) > 0 )
			{
				$x[] = 'title: "' . $mm[ 'header' ][ 'navigate_title' ] . '"';
			}
		}
		if ( $mm[ 'header' ][ 'navigate' ] == 'iconpanels' ||
			 $mm[ 'header' ][ 'navigate' ] == 'dropdown'
		) {
			$x[] = 'add: false';
		}

		if ( count( $x ) > 0 )
		{
			$o[] = '
			navbar: {
				' . implode( ",\n\t\t\t\t", $x ) . '
			}';
		}


		//	Navbars
		$n = array();


		//	Header image
		if ( $mm[ 'header' ][ 'image' ] == 'yes' )
		{
			if ( $mm[ 'header' ][ 'navigate' ] == 'iconpanels' )
			{
				$available = 4;
			}
			else
			{
				$available = 3;
			}
			if ( $mm[ 'header' ][ 'searchfield' ] == 'yes' )
			{
				$available--;
			}
			if ( strlen( $mm[ 'header' ][ 'buttons_html' ] ) > 0 )
			{
				$available--;
			}
			else if ( strlen( $mm[ 'header' ][ 'buttons_selector' ] ) > 0 )
			{
				$available--;
			}
			else
			{
				for ( $i = 1; $i <= 5; $i++ )
				{
					if ( strlen( $mm[ 'header' ][ 'button_' . $i . '_icon' ] ) > 0 )
					{
						$available--;
						break;
					}
				}
			}
			$height = intval( $mm[ 'header' ][ 'image_height' ] );
			if ( $available < $height )
			{
				$height = $available;
			}

			$n[] = '{
					height: ' . $height . ',
					content: [ "<div class=\"mm-header-image\" />" ]
				}';
		}


		//	Header searchfield
		if ( $mm[ 'header' ][ 'searchfield' ] == 'yes' )
		{
			$n[] = '{
					content: [ "searchfield" ]
				}';
		}

		//	Header breadcrumbs
		if ( $mm[ 'header' ][ 'navigate' ] == 'breadcrumbs' )
		{
			$n[] = '{
					content: [ "breadcrumbs" ]
				}';
		}

		//	Header back, title, close
		if ( $mm[ 'header' ][ 'navigate' ] == 'button' )
		{
			$x = array();
			$x[] = 'prev';
			$x[] = 'title';

			if ( $mm[ 'header' ][ 'navigate_close' ] == 'yes' )
			{
				$x[] = 'close';
			}

			if ( count( $x ) > 0 )
			{
				$n[] = '{
					content: [ "' . implode( '", "', $x ) . '" ]
				}';	
			}
		}

		//	Header + footer buttons
		foreach( array( 'header', 'footer' ) as $bar )
		{
			$x = array();
			if ( strlen( $mm[ $bar ][ 'buttons_html' ] ) > 0 )
			{
				$x[] = $mm[ $bar ][ 'buttons_html' ];
			}
			if ( strlen( $mm[ $bar ][ 'buttons_selector' ] ) > 0 )
			{
				$x[] = $mm[ $bar ][ 'buttons_selector' ];
			}
			for ( $i = 1; $i <= 5; $i++ )
			{
				if ( strlen( $mm[ $bar ][ 'button_' . $i . '_icon' ] ) > 0 )
				{
					$x[] = '<a'
						. ' href="' . $mm[ $bar ][ 'button_' . $i . '_href' ] . '"'
						. ' target="' . $mm[ $bar ][ 'button_' . $i . '_target' ] . '">'
						. '<span class=" dashicons ' . $mm[ $bar ][ 'button_' . $i . '_icon' ] . '" >&nbsp;</span>'
						. '</a>';
				}
			}

			if ( count( $x ) > 0 )
			{
				$n[] = '{
						position: "' . ( $bar == 'header' ? 'top' : 'bottom' ) . '",
						content: [ \'' . implode( '\', \'', $x ) . '\' ]
					}';
			}
		}

		if ( count( $n ) > 0 )
		{
			$o[] = '
			navbars: [
				' . implode( ",", $n ) . '
			]';
		}


		//	Sliding submenus
		if ( $mm[ 'header' ][ 'navigate' ] == 'dropdown' )
		{
			$o[] = '
			slidingSubmenus: false';
		}


		//	Conf
		$x = array();
		$x[] = 'pageSelector: "> div:not(#wpadminbar)"';

		if ( count( $x) > 0 )
		{
			$c[] = '
			offCanvas: {
				' . implode( ",\n\t\t\t\t", $x ) . '
			}';
		}

		if ( $mm[ 'header' ][ 'searchfield' ] == 'yes' &&
			$mm[ 'header' ][ 'searchfield_sitesearch' ] == 'yes'
		) {
			$c[] = '
			searchfield: {
				form: {
					method: $sform.attr( \'method\' ) || \'get\',
					action: $sform.attr( \'action\' ) || \'/\'
				},
				input: {
					name: \'s\'
				},
				submit: true
			}';
		}



		//	Concatenate mmenu JS and CSS from originals
		
		$dir = dirname( __FILE__ ) . '/';
  		$src = $dir . 'mmenu/';

  		$js = @file_get_contents( $src . 'jquery.mmenu.all.min.js' );
  		$js .= '
jQuery(document).ready(function($) {
	$("#wpadminbar")
		.css( "position", "fixed" )
		.addClass( "mm-slideout" );

	var $menu 	= $("' . $mm[ 'setup' ][ 'menu' ] . '").first().clone(),
		$button = $("' . $mm[ 'setup' ][ 'button' ] . '");';

		if ( $mm[ 'header' ][ 'searchfield' ] == 'yes' &&
			$mm[ 'header' ][ 'searchfield_sitesearch' ] == 'yes'
		) {
			$js .= '

	var $sform = $(\'input[name="s"]\').closest( \'form\' ).first();';
		}

		$js .= '

	var $selected = $menu.find( "li.current-menu-item" );
	var $vertical = $menu.find( "li.Vertical" );
	var $dividers = $menu.find( "li.Divider" );

	$menu.children().not( "ul" ).remove();
	$menu.add( $menu.find( "ul, li" ) )
		.removeAttr( "class" )
		.removeAttr( "id" );

	$menu.addClass( "wpmm-menu" );

	$selected.addClass( "Selected" );
	$vertical.addClass( "Vertical" );
	$dividers.addClass( "Divider" );

	$menu.mmenu({
		' . implode( ",", $o ) . '
	}, {
		' . implode( ",", $c ) . '
	});';

	if ( $mm[ 'advanced' ][ 'fullsubopen' ] == 'yes' )
	{
		$js .= '

	$menu
		.find( ".mm-listview" )
		.find( ".mm-next" )
		.next()
		.filter( "[href=\'#\']" )
		.prev()
		.addClass( "mm-fullsubopen" );';
	}

		$js .= '

	var api = $menu.data( "mmenu" );

	$button
		.addClass( "wpmm-button" )
		.off( "click" )
		.on( "click", function( e ) {
			e.preventDefault();
			e.stopImmediatePropagation();
			api.open();
		});';

		if ( $fileAffix == '-preview' ) //	:/
		{
			$js .= '
	$("body").on(
		"click",
		"a",
		function( e ) {
			if ( !e.isDefaultPrevented() )
			{
				if ( !confirm( "You are leaving the preview, changes you\'ve made to the mobile menu will no longer take effect." ) ) {
					e.preventDefault();
				}
			}
		}
	);
	setTimeout(function() {
		api.open();
	}, 1000);';
		}

		$js .= '

	function mm_hasBg( $e )
	{
		var bg = true;
		switch( $e.css( "background-color" ) )
		{
			case "":
			case "none":
			case "inherit":
			case "undefined":
			case "transparent":
			case "rgba(0,0,0,0)":
			case "rgba( 0,0,0,0 )":
			case "rgba(0, 0, 0, 0)":
			case "rgba( 0, 0, 0, 0 )":
				bg = false;
				break;
		}
		return bg;
	}

	var $node = $(".mm-page");
	if ( !mm_hasBg( $node ) )
	{
		$node.addClass( "wpmm-force-bg" );
		$node = $("body");
		if ( !mm_hasBg( $node ) )
		{
			$node.addClass( "wpmm-force-bg" );
			$node = $("html");
			if ( !mm_hasBg( $node ) )
			{
				$node.addClass( "wpmm-force-bg" );
			}
		}
	}
});';



  		$css = @file_get_contents( $src . 'jquery.mmenu.all.css' );
  		$css .= '
.wpmm-menu
{
	background-color: ' . $mm[ 'menu' ][ 'backgroundcolor' ] . ' !important;
}
.wpmm-force-bg
{
	background-color: inherit;
}
html.wpmm-force-bg
{
	background-color: #fff;
}

.wpmm-menu .mm-navbar .dashicons
{
	font-size: 20px;
	line-height: 20px;
	height: 20px
}

.wpmm-menu .mm-listview > li > .dropdown-toggle
{
	display: none;
}';

		//	Header
		if ( $mm[ 'header' ][ 'image' ] == 'yes' )
		{
			$pos = ( $mm[ 'header' ][ 'image_scale' ] == 'cover' )
				? '0'
				: '20px';

			$css .= '

.mm-header-image
{
	background: url(' . $mm[ 'header' ][ 'image_src' ] . ') center center / ' . $mm[ 'header' ][ 'image_scale' ] . ' no-repeat transparent;
	padding: 0 !important;
	position: absolute;
	top: ' . $pos . ';
	right: ' . $pos . ';
	bottom: ' . $pos . ';
	left: ' . $pos . ';
}';
		}

  		//	Widescreen
  		if ( $mm[ 'menu' ][ 'breakpoint' ] )
		{
			$css .= '
@media screen and (min-width:' . intval( $mm[ 'menu' ][ 'breakpoint' ], 10 ) . 'px) {
' . @file_get_contents( $src . 'jquery.mmenu.widescreen.css' ) . '

	.wpmm-button ,
	' . $mm[ 'setup' ][ 'menu' ] . '
	{
		display: none !important;
	}
}
';
		}


		@file_put_contents( $dir . 'js/mmenu' . $fileAffix . '.js', $js );
		@file_put_contents( $dir . 'css/mmenu' . $fileAffix . '.css', $css );
	}


	public function admin_css_js( $screen_id )
	{

		if ( $screen_id == $this->screen_id )
		{
		    wp_enqueue_style(	'wp-color-picker' );
    		wp_enqueue_script(	'wp-color-picker' );

   			wp_enqueue_style( 	'dashicons' );

			wp_enqueue_script(	'media-upload' );

			wp_enqueue_style( 	'mmenu', plugin_dir_url( __FILE__ ) . 'mmenu/jquery.mmenu.all.css' );
			wp_enqueue_script(	'mmenu', plugin_dir_url( __FILE__ ) . 'mmenu/jquery.mmenu.all.min.js' );
		}

		parent::admin_css_js( $screen_id );
	}

}



class MmenuFrontend {

	public function __construct()
	{
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_filter( 'wp_nav_menu_args', array( $this, 'nav_menu_args' ) );
	}

	public function nav_menu_args( $args )
	{
		if ( !$args[ 'container_id' ] )
		{
			$args[ 'container_id' ] = 'menu-location-' . $args[ 'theme_location' ];
		}
		return $args;
	}

	public function enqueue_scripts()
	{
		$version = get_option( 'mm_setup', array() );
		$version = isset( $version[ 'version' ] ) ? $version[ 'version' ] : 0;

		wp_enqueue_style( 'dashicons' );

		if ( current_user_can( 'manage_options' ) &&
			isset( $_GET[ 'mmenu' ] )
		) {
			if ( $_GET[ 'mmenu' ] == 'locate' )
			{
				wp_enqueue_script( 	'mm-locate', plugin_dir_url( __FILE__ ) . 'lib/locate/admin-locate.js', array( 'jquery' ) );
		   		wp_enqueue_style( 	'mm-locate', plugin_dir_url( __FILE__ ) . 'lib/locate/admin-locate.css' );
			}
			else if ( $_GET[ 'mmenu' ] == 'breakpoint' )
			{
				wp_enqueue_script( 	'mm-admin-setup', plugin_dir_url( __FILE__ ) . 'lib/breakpoint/admin-breakpoint.js', array( 'jquery' ) );
			}
			else if ( $_GET[ 'mmenu' ] == 'preview' )
			{
		   		wp_enqueue_script( 	'mmenu', plugin_dir_url( __FILE__ ) . 'js/mmenu-preview.js', array( 'jquery' ), $version );
		   		wp_enqueue_style( 	'mmenu', plugin_dir_url( __FILE__ ) . 'css/mmenu-preview.css', '', $version );
			}

			add_action( 'wp_footer', array( $this, 'echo_mmenu_js' ) );
		}
		else
		{
			$menu = get_option( 'mm_menu', false );
			if ( $menu )
			{
			   	wp_enqueue_script( 	'mmenu', plugin_dir_url( __FILE__ ) . 'js/mmenu.js', array( 'jquery' ), $version );
			   	wp_enqueue_style( 	'mmenu', plugin_dir_url( __FILE__ ) . 'css/mmenu.css', '', $version );
			}
		}
    }
	public function echo_mmenu_js()
	{
		echo '
<script type="text/javascript">
	window.mmenu = {};
</script>';
	}
}


// Instantiate the class.
if ( is_admin() )
{
	new MmenuAdminPage();
}
else
{
	new MmenuFrontend();
}