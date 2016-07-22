<?php

add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
    wp_enqueue_style( 'parentchild-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'parentchild-editorstyle', get_template_directory_uri() . '/css/editor-style.css' );
    wp_enqueue_style( 'parentchild-flag-icon', get_template_directory_uri() . '/css/flag-icon.css' );
    wp_enqueue_style( 'parentchild-awesome', get_template_directory_uri() . '/css/font-awesome.min.css' );
    wp_enqueue_style( 'parentchild-frame', get_template_directory_uri() . '/css/frame.css' );
    wp_enqueue_style( 'parentchild-menu', get_template_directory_uri() . '/css/menu.css' );
    wp_enqueue_style( 'parentchild-responsive', get_template_directory_uri() . '/css/responsive.css' );

}

