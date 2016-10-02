<?php
function my_theme_enqueue_styles() {
    wp_enqueue_style( 'parentchild-style', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );

// Show all frambjóðendur og kjördæmi archive pages
function my_modify_main_query( $query ) {
	if ($query->is_main_query() && !is_admin()) {
		$query->query_vars["posts_per_page"] = -1;
		$query->query_vars["orderby"] = "menu_order";
		$query->query_vars["order"] = "ASC";
	}
}
add_action( "pre_get_posts", "my_modify_main_query" );