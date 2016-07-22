<?php
	header("Content-type: text/css", true);

	$src = dirname( dirname( __FILE__ ) ) . '/lib/';
	$arr = array(
		'layout',
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
		echo @file_get_contents( $src . $lib . '/admin.css' ) . '

';
	}