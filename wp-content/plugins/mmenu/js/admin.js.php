<?php
	header("Content-type: text/javascript", true);

	$src = dirname( dirname( __FILE__ ) ) . '/lib/';
	$arr = array(
		'websitehtml',
		'firstvisit',
		'suboptions',
		'comboboxes',
		'locate',
		'colorpicker',
		'breakpoint',
		'header',
		'dashicons',
		'buttons',
		'validation',
		'submit',
		'preview'
	);

	foreach( $arr as $lib )
	{
		echo @file_get_contents( $src . $lib . '/admin.js' ) . '

';
	}