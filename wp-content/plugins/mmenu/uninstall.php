<?php
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) )
{
    exit();
}

$options = array(
	'mm_setup',
	'mm_menu',
	'mm_header',
	'mm_footer',
	'mm_advanced'
);
foreach( $options as $option )
{
	delete_option( $option );
}