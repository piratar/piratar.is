<?php
require_once( dirname( __FILE__ ) . '/mm_html.php' );


class MmAdminPage extends MmHtml {

	protected $version		= '';
	protected $helptabs 	= array();
	protected $helpsidebar	= '';

	
	public function __construct()
	{
		add_action( 'admin_menu', array( $this, 'add_menu_page' ) );
		add_action( 'admin_init', array( $this, 'register_settings' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_css_js' ) );
		add_action( 'admin_footer', array( $this, 'admin_inline_css_js' ) );

		add_filter( 'contextual_help', array( $this, 'plugin_help' ), 10, 3 );

		if ( isset( $_POST[ 'submit' ] ) )
		{
			$_SESSION[ 'submit' ] = $_POST[ 'submit' ];
		}
		if ( isset( $_POST[ 'preview' ] ) )
		{
			$_SESSION[ 'preview' ] = $_POST[ 'preview' ];
		}
	}


	public function create_admin_page()
	{
		if ( !current_user_can( 'manage_options' ) )
	    {
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	    }
	}

	public function admin_inline_css_js()
	{
	    echo '
		<script type="text/javascript">
	    	var ' . $this->name . ' = { 
	    		version: "' . $this->version . '",
	    		home_url: "' . get_home_url(). '"
	    	};
		</script>';
	}
	public function admin_css_js( $screen_id )
	{
		if ( $screen_id == $this->screen_id )
		{
			wp_enqueue_style( 	'mm-admin', plugin_dir_url( dirname( __FILE__ ) ) . 'css/admin.css.php' );
			wp_enqueue_script(	'mm-admin', plugin_dir_url( dirname( __FILE__ ) ) . 'js/admin.js.php', array( 'jquery' ) );
		}
	}

	public function plugin_help( $contextual_help, $screen_id, $screen )
	{
		if ( $screen_id == $this->screen_id )
		{
			if ( count( $this->helptabs ) > 0 )
			{
	            foreach ( $this->helptabs as $tab )
	            {
	                $screen->add_help_tab( $tab );
	            }
	            if ( $this->helpsidebar )
	            {
	            	$screen->set_help_sidebar( $this->helpsidebar );
	            }
			}
		}
		return '';
	}

	public function register_settings()
	{
		foreach( $this->options as $option => $suboptions )
		{
			register_setting( 'mmenu-settings', $option );
		}
	}
}