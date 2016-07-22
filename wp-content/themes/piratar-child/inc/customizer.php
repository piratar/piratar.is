<?php

function cleansimplewhite_customize_register( $wp_customize ) {
	$colors = array();
	$colors[] = array(
		'slug'    => 'header_link_color',
		'default' => '#3366bb',
		'label'   => __( 'Header Link Color', 'clean-simple-white' ),
	);
	$colors[] = array(
		'slug'    => 'header_text_color',
		'default' => '#444',
		'label'   => __( 'Header Description Color', 'clean-simple-white' ),
	);
	
	foreach ( $colors as $color ) {
		$wp_customize->add_setting( $color[ 'slug' ], array(
			'default'           => $color[ 'default' ],
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				$color['slug'], 
				array(
					'label'    => $color['label'], 
					'section'  => 'colors',
					'settings' => $color['slug'],
				)
			)
		);
	}
	
	$wp_customize->remove_control( 'header_textcolor' );
}
add_action( 'customize_register', 'cleansimplewhite_customize_register' );

function cleansimplewhite_customize_css() {
	?>
	<style>
	/*#main-content {
		float: right;
	}
	#sidebar {
		float: left;
		margin: 10px 0 10px 10px;
	}*/
	</style>
	<?php
}
add_action( 'wp_head', 'cleansimplewhite_customize_css');
