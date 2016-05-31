<?php

if ( ! isset( $content_width ) ) {
	$content_width = 1140;
}

if ( ! function_exists( 'piratar_setup' ) ) {
	function piratar_setup() {
		
		add_theme_support( 'post-thumbnails' );
		
		add_theme_support( 'html5', array(
			'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
		) );
		

		register_nav_menus( array(
			'primary' => __( 'Primary Navigation', 'piratar' ),
		));

		register_nav_menus( array(
			'secondary' => __( 'Secondary Menu', 'piratar' ),
		));
        
        register_nav_menus( array(
			'mobile' => __( 'Navigation for Mobile', 'piratar' ),
		));
		
		add_editor_style( 'css/editor-style.css?v1' );
	}
}
add_action( 'after_setup_theme', 'piratar_setup' );

// apply tags to attachments
function wptp_add_tags_to_attachments() {
    register_taxonomy_for_object_type( 'post_tag', 'attachment' );
}
add_action( 'init' , 'wptp_add_tags_to_attachments' );

function tagstats() {
          global $wpdb;
          global $numtags;
          $wp_test = get_bloginfo ('version');
          $numtags = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->term_taxonomy WHERE taxonomy = 'post_tag'");
          if (0 < $numtags) $numtags = number_format($numtags);
          echo $numtags . '';
}

function mypost_has_gallery($postid){
    global $wpdb;
    $table = $wpdb->prefix . "posts";
    $sql = "SELECT * FROM <code>&quot; . $table . &quot;</code> WHERE ((<code>&quot; . $table . &quot;</code>.<code>post_type</code>=\"attachment\") AND (<code>&quot; . $table . &quot;</code>.<code>post_parent</code>=\"" . $postid ."\") AND (LOCATE(\"image\",<code>&quot; . $table . &quot;</code>.<code>post_mime_type</code>)>0))";
    if ( $wpdb->get_var($sql) != 0 ){
        return true;}
    else{
        return false;
    }
}

function piratar_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'piratar' ),
		'id'            => 'sidebar',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
    ));
	
	register_sidebar( array(
		'name'          => __( 'Footer Left', 'piratar' ),
		'id'            => 'footer-left',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
    ));
	
	register_sidebar( array(
		'name'          => __( 'Footer Center', 'piratar' ),
		'id'            => 'footer-center',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
    ));
	
	register_sidebar( array(
		'name'          => __( 'Footer Right', 'piratar' ),
		'id'            => 'footer-right',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
    ));
}
add_action( 'widgets_init', 'piratar_widgets_init' );

function piratar_scripts() {
	wp_enqueue_style( 'piratar-style', get_stylesheet_uri(), array(), '1.4.2' );
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'piratar_scripts' );

require get_template_directory() . '/inc/customizer.php';


// ----------------------------------------------

if ( ! function_exists( '_wp_render_title_tag' ) ) {
	function theme_slug_render_title() {
		?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<?php
	}
	add_action( 'wp_head', 'theme_slug_render_title' );
	
	function piratar_wp_title( $title, $sep ) {
		global $paged, $page;
		
		if ( is_feed() ) {
			return $title;
		}
		
		// Add the site name.
		$title .= get_bloginfo( 'name', 'display' );
		
		// Add the site description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) ) {
			$title = "$title $sep $site_description";
		}
		
		// Add a page number if necessary.
		if ( $paged >= 2 || $page >= 2 ) {
			$title = "$title $sep " . sprintf( __( 'Page %s', 'piratar' ), max( $paged, $page ) );
		}
		
		return $title;
	}
	add_filter( 'wp_title', 'piratar_wp_title', 10, 2 );
}

if ( function_exists( 'the_posts_pagination' ) ) {
	the_posts_pagination( array(
		'prev_text'          => __( 'Previous', 'piratar' ),
		'next_text'          => __( 'Next', 'piratar' ),
		'before_page_number' => '',
	) );
} else {
	function the_posts_pagination() {
		?>
		<div class="navigation">
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'piratar' ) ); ?></div>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'piratar' ) ); ?></div>
		</div>
		<?php
	}
}

if ( function_exists( 'the_post_navigation' ) ) {
	the_post_navigation( array(
		'prev_text' => '%title',
		'next_text' => '%title',
		'screen_reader_text' => '',
	) );
} else {
	function the_post_navigation() {
		?>
		<div class="navigation">
			<div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . __( '&larr;', 'piratar' ) . '</span> %title' ); ?></div>
			<div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . __( '&rarr;', 'piratar' ) . '</span>' ); ?></div>
		</div><!-- #nav-below -->
		<?php
	}
}

/* ------------------------------------------ */

/*
function piratar_the_posts_pagination() {
	if ( function_exists( 'the_posts_pagination' ) ) {
		the_posts_pagination( array(
			'prev_text'          => __( 'Previous', 'piratar' ),
			'next_text'          => __( 'Next', 'piratar' ),
			'before_page_number' => '',
		) );
	} else {
		?>
		<div class="navigation">
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'piratar' ) ); ?></div>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'piratar' ) ); ?></div>
		</div>
		<?php
	}
}

function piratar_the_post_navigation() {
	if ( function_exists( 'the_post_navigation' ) ) {
		the_post_navigation( array(
			'prev_text' => '%title',
			'next_text' => '%title',
			'screen_reader_text' => '',
		) );
	} else {
		?>
		<div class="navigation">
			<div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . __( '&larr;', 'piratar' ) . '</span> %title' ); ?></div>
			<div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . __( '&rarr;', 'piratar' ) . '</span>' ); ?></div>
		</div><!-- #nav-below -->
		<?php
	}
}
*/

function  strip_shortcode_gallery( $content ) {
    preg_match_all( '/'. get_shortcode_regex() .'/s', $content, $matches, PREG_SET_ORDER );
    if ( ! empty( $matches ) ) {
        foreach ( $matches as $shortcode ) {
            if ( 'gallery' === $shortcode[2] ) {
                $pos = strpos( $content, $shortcode[0] );
                if ($pos !== false)
                    return substr_replace( $content, '', $pos, strlen($shortcode[0]) );
            }
        }
    }
    return $content;
}


/*
#################
Hérna eru CustomPostTypes frá Arnari
Ég gaf mér besaleyfi að tilla þessu hérna
Ef þú skyldir geyma þennan kóða annarstaðar en hér
Þá bara færiru hann! :) 
###################
*/

function pirates_thingmalpirata_cpt() {
    register_post_type('thingmalpirata', array(
            'label' 		=> 'Þingmál Pírata',
            'menu_icon' 	=> 'dashicons-book',
            'description' 	=> 'Hérna listum við Þingmál pírata',
            'public' 		=> true,
            'show_ui' 		=> true,
            'show_in_menu' 	=> true,
            'capability_type'   => 'post',
            'map_meta_cap' 	=> true,
            'hierarchical' 	=> false,
            'query_var' 	=> true,
            'has_archive' 	=> false,
            'supports' 		=> array('title','editor','thumbnail'),
            'labels' 		=> array (

                'name'              => 'Þingmál',
                'singular_name'     => 'Þingmál',
                'menu_name'         => 'Þingmál',
                'add_new'           => 'Bæta við Þingmál',
                'add_new_item'      => 'Bæta við Þingmáli á listann',
                'edit'              => 'Breyta',
                'edit_item'         => 'Breyta Þingmáli',
                'new_item'          => 'Nýtt Þingmál',
                'view'              => 'Skoða',
                'view_item'         => 'Skoða Þingmál',
                'search_items'      => 'Leita',
                'not_found'         => 'Ekkert fannst',
                'not_found_in_trash'=> 'Ekkert fannst í rusli'
            )
    ) );
}
add_action('init', 'pirates_thingmalpirata_cpt');


function pirates_thingfolk_cpt() {
    register_post_type('thingfolk', array(
            'label' 		=> 'Þingfólk Pírata',
            'menu_icon' 	=> 'dashicons-businessman',
            'description' 	=> 'Hérna listum við Þingfólk pírata',
            'public' 		=> true,
            'show_ui' 		=> true,
            'show_in_menu' 	=> true,
            'capability_type'   => 'post',
            'map_meta_cap' 	=> true,
            'hierarchical' 	=> false,
            'query_var' 	=> true,
            'has_archive' 	=> false,
            'supports' 		=> array('title','editor','thumbnail'),
            'labels' 		=> array (

                'name'              => 'Þingfólk',
                'singular_name'     => 'Þingfólk',
                'menu_name'         => 'Þingfólk',
                'add_new'           => 'Bæta við Þingfólki',
                'add_new_item'      => 'Bæta við Þingfólki á listann',
                'edit'              => 'Breyta',
                'edit_item'         => 'Breyta Þingmanni',
                'new_item'          => 'Nýr Þingmaður',
                'view'              => 'Skoða',
                'view_item'         => 'Skoða Þingmann',
                'search_items'      => 'Leita',
                'not_found'         => 'Ekkert fannst',
                'not_found_in_trash'=> 'Ekkert fannst í rusli'
            )
    ) );
}
add_action('init', 'pirates_thingfolk_cpt');

function pirates_stefnumal_cpt() {
    register_post_type('stefnumal', array(
            'label' 		=> 'Stefnumál Pírata',
            'menu_icon' 	=> 'dashicons-media-text',
            'description' 	=> 'Hérna listum við Stefnumál pírata',
            'public' 		=> true,
            'show_ui' 		=> true,
            'show_in_menu' 	=> true,
            'capability_type'   => 'post',
            'map_meta_cap' 	=> true,
            'hierarchical' 	=> false,
            'query_var' 	=> true,
            'has_archive' 	=> false,
            'supports' 		=> array('title','editor'),
            'labels' 		=> array (

                'name'              => 'Stefnumál',
                'singular_name'     => 'Stefnumál',
                'menu_name'         => 'Stefnumál',
                'add_new'           => 'Bæta við Stefnumáli',
                'add_new_item'      => 'Bæta við Stefnumáli á listann',
                'edit'              => 'Breyta',
                'edit_item'         => 'Breyta Stefnumáli',
                'new_item'          => 'Nýtt Stefnumál',
                'view'              => 'Skoða',
                'view_item'         => 'Skoða Stefnumál',
                'search_items'      => 'Leita',
                'not_found'         => 'Ekkert fannst',
                'not_found_in_trash'=> 'Ekkert fannst í rusli'
            )
    ) );
}

add_action('init', 'pirates_stefnumal_cpt');

function pirates_stefnuflokkun1_tax() {
	register_taxonomy(
		'stefnuflokkun1',
		array (
		0 => 'stefnumal',
		),
                    array(
		'hierarchical'      => true,
		'labels' 		=> array (

                'name'              => 'Stefnuflokkun 1',
                'singular_name'     => 'Stefnuflokkun 1',
                'menu_name'         => 'Stefnuflokkun 1',
                'add_new'           => 'Bæta við Stefnuflokkun 1',
                'add_new_item'      => 'Bæta við Stefnuflokkun 1 á listann',
                'edit'              => 'Breyta',
                'edit_item'         => 'Breyta Stefnuflokkun 1',
                'new_item'          => 'Ný Stefnuflokkun 1',
                'view'              => 'Skoða',
                'view_item'         => 'Skoða Stefnuflokkun 1',
                'search_items'      => 'Leita',
                'not_found'         => 'Ekkert fannst',
                'not_found_in_trash'=> 'Ekkert fannst í rusli'
            ),
		'show_ui'           => true,
		'query_var'         => true,
		'show_admin_column' => true,
		'rewrite' => array('slug' => 'stefnuflokkun1')
	) );
} add_action('init', 'pirates_stefnuflokkun1_tax');

function pirates_stefnuflokkun2_tax() {
	register_taxonomy(
		'stefnuflokkun2',
		array (
		0 => 'stefnumal',
		),
                    array(
		'hierarchical'      => true,
		'labels' 		=> array (

                'name'              => 'Stefnuflokkun 2',
                'singular_name'     => 'Stefnuflokkun 2',
                'menu_name'         => 'Stefnuflokkun 2',
                'add_new'           => 'Bæta við Stefnuflokkun 2',
                'add_new_item'      => 'Bæta við Stefnuflokkun 2 á listann',
                'edit'              => 'Breyta',
                'edit_item'         => 'Breyta Stefnuflokkun 2',
                'new_item'          => 'Ný Stefnuflokkun 2',
                'view'              => 'Skoða',
                'view_item'         => 'Skoða Stefnuflokkun 2',
                'search_items'      => 'Leita',
                'not_found'         => 'Ekkert fannst',
                'not_found_in_trash'=> 'Ekkert fannst í rusli'
            ),
		'show_ui'           => true,
		'query_var'         => true,
		'show_admin_column' => true,
		'rewrite' => array('slug' => 'stefnuflokkun2')
	) );
} add_action('init', 'pirates_stefnuflokkun2_tax');