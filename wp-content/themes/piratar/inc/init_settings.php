<?php 

/* Hérna er CPT og TAX kóðinn fyrir Pírata themeið */



/* TAX fyrir Framkvæmda ár fyrir Fundargerði */
function pirates_framkvaemda_ar_tax() {
	register_taxonomy(
		'framkvaemda_ar',
		array (
			0 => 'framkvaemdaradin',
		),
		array(
			'hierarchical'      => true,
			'labels' 		=> array (
					'name'              => 'Framkvæmdaár',
					'singular_name'     => 'Framkvæmdaár',
					'menu_name'         => 'Framkvæmdaár',
					'add_new'           => 'Bæta við Framkvæmdaári',
					'add_new_item'      => 'Bæta við Framkvæmdaár á listann',
					'edit'              => 'Breyta',
					'edit_item'         => 'Breyta Framkvæmdaári',
					'new_item'          => 'Nýtt Framkvæmdaár',
					'view'              => 'Skoða',
					'view_item'         => 'Skoða Framkvæmdaár',
					'search_items'      => 'Leita',
					'not_found'         => 'Ekkert fannst',
					'not_found_in_trash'=> 'Ekkert fannst í rusli'
				),
			'show_ui'           => true,
			'query_var'         => true,
			'show_admin_column' => true,
			'rewrite' => array('slug' => 'framkvaemda_ar')
		) );
} add_action('init', 'pirates_framkvaemda_ar_tax');



/* CPT fyrir Framkvæmdaráð Pírata */
function pirates_framkvaemdarad_cpt() {
    register_post_type('framkvaemdaradin', array(
            'label' 		=> 'Framkvæmdaráð',
            'menu_icon' 	=> 'dashicons-hammer',
            'description' 	=> 'Hérna listum við Framkvæmdaráðin',
            'public' 		=> true,
            'show_ui' 		=> true,
            'show_in_menu' 	=> true,
            'capability_type'   => 'post',
            'map_meta_cap' 	=> true,
            'hierarchical' 	=> true,
            'query_var' 	=> true,
            'has_archive' 	=> true,
			'rewrite' =>	array( 'slug' => '/um-pirata/bokhald-og-rekstur/framkvaemdaradin'),
            'supports' 		=> array('title','editor','thumbnail'),
            'labels' 		=> array (
                'name'              => 'Framkvæmdaráð',
                'singular_name'     => 'Framkvæmdaráð',
                'menu_name'         => 'Framkvæmdaráð',
                'add_new'           => 'Bæta við framkvæmdaráð',
                'add_new_item'      => 'Bæta við framkvæmdaráði á listann',
                'edit'              => 'Breyta',
                'edit_item'         => 'Breyta framkvæmdaráði',
                'new_item'          => 'Nýtt framkvæmdaráð',
                'view'              => 'Skoða',
                'view_item'         => 'Skoða framkvæmdaráð',
                'search_items'      => 'Leita',
                'not_found'         => 'Ekkert fannst',
                'not_found_in_trash'=> 'Ekkert fannst í rusli'
            )
    ) );
} add_action('init', 'pirates_framkvaemdarad_cpt');




/* CPT fyrir Fréttir Pírata */
function pirates_frettir_cpt() {
    register_post_type('frettir', array(
            'label' 		=> 'Fréttir',
            'menu_icon' 	=> 'dashicons-media-spreadsheet',
            'description' 	=> 'Hérna listum við Flokksfólkið',
            'public' 		=> true,
            'show_ui' 		=> true,
            'show_in_menu' 	=> true,
            'capability_type'   => 'post',
            'map_meta_cap' 	=> true,
            'hierarchical' 	=> true,
            'query_var' 	=> true,
            'has_archive' 	=> false,
			'rewrite' =>	array( 'slug' => 'frettir/%frettaflokkur%'),
            'supports' 		=> array('title','editor','thumbnail'),
            'labels' 		=> array (
                'name'              => 'Fréttir',
                'singular_name'     => 'Fréttir',
                'menu_name'         => 'Fréttir',
                'add_new'           => 'Bæta við frétt',
                'add_new_item'      => 'Bæta við frétt á listann',
                'edit'              => 'Breyta',
                'edit_item'         => 'Breyta frétt',
                'new_item'          => 'Ný frétt',
                'view'              => 'Skoða',
                'view_item'         => 'Skoða frétt',
                'search_items'      => 'Leita',
                'not_found'         => 'Ekkert fannst',
                'not_found_in_trash'=> 'Ekkert fannst í rusli'
            )
    ) );
} add_action('init', 'pirates_frettir_cpt');



/* TAX fyrir Fundarflokk fyrir Fundargerði */
function pirates_frettaflokkur_tax() {
	register_taxonomy(
		'frettaflokkur',
		array (
			0 => 'frettir',
		),
		array(
			'hierarchical'      => true,
			'labels' 		=> array (
					'name'              => 'Fréttaflokkur',
					'singular_name'     => 'Fréttaflokkur',
					'menu_name'         => 'Fréttaflokkur',
					'add_new'           => 'Bæta við fréttaflokk',
					'add_new_item'      => 'Bæta við fréttaflokk á listann',
					'edit'              => 'Breyta',
					'edit_item'         => 'Breyta fréttaflokk',
					'new_item'          => 'Nýr fréttaflokkur',
					'view'              => 'Skoða',
					'view_item'         => 'Skoða fréttaflokk',
					'search_items'      => 'Leita',
					'not_found'         => 'Ekkert fannst',
					'not_found_in_trash'=> 'Ekkert fannst í rusli'
				),
			'show_ui'           => true,
			'query_var'         => true,
			'show_admin_column' => true,
			'rewrite' => array('slug' => 'flokkstitill')
		) );
} add_action('init', 'pirates_frettaflokkur_tax');



/* CPT fyrir Fundargerð Pírata */
function pirates_ur_raedustol_tax() {
    register_post_type('ur-raedustol', array(
            'label' 		=> 'Úr ræðustól',
            'menu_icon' 	=> 'dashicons-megaphone',
            'description' 	=> 'Hérna listum við færslur úr ræðustól',
            'public' 		=> true,
            'show_ui' 		=> true,
            'show_in_menu' 	=> true,
            'capability_type'   => 'post',
            'map_meta_cap' 	=> true,
            'hierarchical' 	=> true,
            'query_var' 	=> true,
            'has_archive' 	=> false,
			'rewrite' =>	array( 'slug' => 'piratar-a-thingi/thingflokkur-pirata/ur-raedustol'),
            'supports' 		=> array('title','editor'),
            'labels' 		=> array (
                'name'              => 'Úr ræðustól',
				'singular_name'     => 'Úr ræðustól',
				'menu_name'         => 'Úr ræðustól',
				'add_new'           => 'Bæta við færslu úr ræðustól',
				'add_new_item'      => 'Bæta við færslu úr ræðustól á listann',
				'edit'              => 'Breyta',
				'edit_item'         => 'Breyta færslu úr ræðustól',
				'new_item'          => 'Nýr færslu úr ræðustól',
				'view'              => 'Skoða',
				'view_item'         => 'Skoða færslu úr ræðustól',
				'search_items'      => 'Leita',
				'not_found'         => 'Ekkert fannst',
				'not_found_in_trash'=> 'Ekkert fannst í rusli'
            )
    ) );
} add_action('init', 'pirates_ur_raedustol_tax');



/* TAX fyrir Fundarflokk fyrir Fundargerði */
/*function pirates_ur_raedustol_tax() {
	register_taxonomy(
		'ur_raedustol',
		array (
			0 => 'frettir',
		),
		array(
			'hierarchical'      => true,
			'labels' 		=> array (
					'name'              => 'Úr ræðustól',
					'singular_name'     => 'Úr ræðustól',
					'menu_name'         => 'Úr ræðustól',
					'add_new'           => 'Bæta við færslu úr ræðustól',
					'add_new_item'      => 'Bæta við færslu úr ræðustól á listann',
					'edit'              => 'Breyta',
					'edit_item'         => 'Breyta færslu úr ræðustól',
					'new_item'          => 'Nýr færslu úr ræðustól',
					'view'              => 'Skoða',
					'view_item'         => 'Skoða færslu úr ræðustól',
					'search_items'      => 'Leita',
					'not_found'         => 'Ekkert fannst',
					'not_found_in_trash'=> 'Ekkert fannst í rusli'
				),
			'show_ui'           => true,
			'query_var'         => true,
			'show_admin_column' => true,
			'rewrite' => array('slug' => 'ur-raedustol')
		) );
} add_action('init', 'pirates_ur_raedustol_tax');*/



/* CPT fyrir Þingmál Pírata */
function pirates_thingmalpirata_cpt() {
    register_post_type('thingmal', array(
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
} add_action('init', 'pirates_thingmalpirata_cpt');


/* TAX fyrir Þingmál */
function pirates_thingmalsflokkur_tax() {
	register_taxonomy(
		'thingmalsflokkur',
		array (
			0 => 'thingmal',
		),
		array(
			'hierarchical'      => true,
			'labels' 		=> array (
					'name'              => 'Þingmálsflokkur',
					'singular_name'     => 'Þingmálsflokkur',
					'menu_name'         => 'Þingmálsflokkur',
					'add_new'           => 'Bæta við þingmálsflokk',
					'add_new_item'      => 'Bæta við þingmálsflokk á listann',
					'edit'              => 'Breyta',
					'edit_item'         => 'Breyta þingmálsflokk',
					'new_item'          => 'Nýr þingmálsflokkur',
					'view'              => 'Skoða',
					'view_item'         => 'Skoða þingmálsflokk',
					'search_items'      => 'Leita',
					'not_found'         => 'Ekkert fannst',
					'not_found_in_trash'=> 'Ekkert fannst í rusli'
				),
			'show_ui'           => true,
			'query_var'         => true,
			'show_admin_column' => true,
			'rewrite' => array('slug' => 'thingmalsflokkur')
		) );
} add_action('init', 'pirates_thingmalsflokkur_tax');



/* CPT fyrir Fundargerð Pírata */
function pirates_flokksfolk_cpt() {
    register_post_type('flokksfolk', array(
            'label' 		=> 'Flokksfólk',
            'menu_icon' 	=> 'dashicons-universal-access-alt',
            'description' 	=> 'Hérna listum við Flokksfólkið',
            'public' 		=> true,
            'show_ui' 		=> true,
            'show_in_menu' 	=> true,
            'capability_type'   => 'post',
            'map_meta_cap' 	=> true,
            'hierarchical' 	=> true,
            'query_var' 	=> true,
            'has_archive' 	=> false,
			'rewrite' =>	array( 'slug' => 'flokksfolk/%adildarfelag%'),
            'supports' 		=> array('title','editor','thumbnail'),
            'labels' 		=> array (
                'name'              => 'Flokksfólk',
                'singular_name'     => 'Flokksfólk',
                'menu_name'         => 'Flokksfólk',
                'add_new'           => 'Bæta við Flokksmanneskju',
                'add_new_item'      => 'Bæta við Flokksmanneskju á listann',
                'edit'              => 'Breyta',
                'edit_item'         => 'Breyta flokksmanneskju',
                'new_item'          => 'Ný flokksmanneskja',
                'view'              => 'Skoða',
                'view_item'         => 'Skoða flokksmanneskju',
                'search_items'      => 'Leita',
                'not_found'         => 'Ekkert fannst',
                'not_found_in_trash'=> 'Ekkert fannst í rusli'
            )
    ) );
} add_action('init', 'pirates_flokksfolk_cpt');



/* TAX fyrir Fundarflokk fyrir Fundargerði */
function pirates_flokkstitill_tax() {
	register_taxonomy(
		'flokkstitill',
		array (
			0 => 'flokksfolk',
		),
		array(
			'hierarchical'      => true,
			'labels' 		=> array (
					'name'              => 'Flokkstitill',
					'singular_name'     => 'Flokkstitill',
					'menu_name'         => 'Flokkstitill',
					'add_new'           => 'Bæta við Flokkstitill',
					'add_new_item'      => 'Bæta við Flokkstitill á listann',
					'edit'              => 'Breyta',
					'edit_item'         => 'Breyta Flokkstitill',
					'new_item'          => 'Nýr Flokkstitill',
					'view'              => 'Skoða',
					'view_item'         => 'Skoða Flokkstitill',
					'search_items'      => 'Leita',
					'not_found'         => 'Ekkert fannst',
					'not_found_in_trash'=> 'Ekkert fannst í rusli'
				),
			'show_ui'           => true,
			'query_var'         => true,
			'show_admin_column' => true,
			'rewrite' => array('slug' => 'flokkstitill')
		) );
} add_action('init', 'pirates_flokkstitill_tax');



/* TAX fyrir Fundarflokk fyrir Fundargerði 
function pirates_flokks_landshluti_tax() {
	register_taxonomy(
		'flokks_landshluti',
		array (
			0 => 'flokksfolk',
		),
		array(
			'hierarchical'      => true,
			'labels' 		=> array (
					'name'              => 'Aðildafélag',
					'singular_name'     => 'Aðildafélag',
					'menu_name'         => 'Aðildafélag',
					'add_new'           => 'Bæta við Aðildafélag',
					'add_new_item'      => 'Bæta við fundaflokk á listann',
					'edit'              => 'Breyta',
					'edit_item'         => 'Breyta Aðildafélag',
					'new_item'          => 'Nýr Aðildafélag',
					'view'              => 'Skoða',
					'view_item'         => 'Skoða Aðildafélag',
					'search_items'      => 'Leita',
					'not_found'         => 'Ekkert fannst',
					'not_found_in_trash'=> 'Ekkert fannst í rusli'
				),
			'show_ui'           => true,
			'query_var'         => true,
			'show_admin_column' => true,
			'rewrite' => array('slug' => 'flokks_landshluti')
		) );
} add_action('init', 'pirates_flokks_landshluti_tax');*/



/* CPT fyrir Frambjóðendur Pírata */
function pirates_frambjodendur_cpt() {
    register_post_type('frambjodendur', array(
            'label' 		=> 'Frambjóðendur',
            'menu_icon' 	=> 'dashicons-universal-access',
            'description' 	=> 'Hérna listum við Fundargerðir',
            'public' 		=> true,
            'show_ui' 		=> true,
            'show_in_menu' 	=> true,
            'capability_type'   => 'post',
            'map_meta_cap' 	=> true,
            'hierarchical' 	=> true,
            'query_var' 	=> true,
            'has_archive' 	=> false,
			'rewrite' =>	array( 'slug' => 'frambjodendur'),
            'supports' 		=> array('title','editor','thumbnail'),
            'labels' 		=> array (
                'name'              => 'Frambjóðendur',
                'singular_name'     => 'Frambjóðendur',
                'menu_name'         => 'Frambjóðendur',
                'add_new'           => 'Bæta við Frambjóðenda',
                'add_new_item'      => 'Bæta við Frambjóðenda á listann',
                'edit'              => 'Breyta',
                'edit_item'         => 'Breyta Frambjóðenda',
                'new_item'          => 'Nýr Frambjóðendi',
                'view'              => 'Skoða',
                'view_item'         => 'Skoða Frambjóðenda',
                'search_items'      => 'Leita',
                'not_found'         => 'Ekkert fannst',
                'not_found_in_trash'=> 'Ekkert fannst í rusli'
            )
    ) );
} add_action('init', 'pirates_frambjodendur_cpt');



/* CPT fyrir Fundargerð Pírata */
function pirates_fundagerd_cpt() {
    register_post_type('fundargerdir', array(
            'label' 		=> 'Fundargerðir',
            'menu_icon' 	=> 'dashicons-edit',
            'description' 	=> 'Hérna listum við Fundargerðir',
            'public' 		=> true,
            'show_ui' 		=> true,
            'show_in_menu' 	=> true,
            'capability_type'   => 'post',
            'map_meta_cap' 	=> true,
            'hierarchical' 	=> true,
            'query_var' 	=> true,
            'has_archive' 	=> false,
			'rewrite' =>	array( 'slug' => 'fundargerdir/%fundarflokkur%'),
            'supports' 		=> array('title','editor','thumbnail'),
            'labels' 		=> array (
                'name'              => 'Fundargerðir',
                'singular_name'     => 'Fundargerðir',
                'menu_name'         => 'Fundargerðir',
                'add_new'           => 'Bæta við fundargerð',
                'add_new_item'      => 'Bæta við fundargerð á listann',
                'edit'              => 'Breyta',
                'edit_item'         => 'Breyta fundargerð',
                'new_item'          => 'Ný fundargerð',
                'view'              => 'Skoða',
                'view_item'         => 'Skoða fundargerð',
                'search_items'      => 'Leita',
                'not_found'         => 'Ekkert fannst',
                'not_found_in_trash'=> 'Ekkert fannst í rusli'
            )
    ) );
} add_action('init', 'pirates_fundagerd_cpt');



/* TAX fyrir Fundarflokk fyrir Fundargerði */
function pirates_fundarflokkur_tax() {
	register_taxonomy(
		'fundarflokkur',
		array (
			0 => 'fundargerdir',
		),
		array(
			'hierarchical'      => true,
			'labels' 		=> array (
					'name'              => 'Fundaflokkur',
					'singular_name'     => 'Fundaflokkur',
					'menu_name'         => 'Fundaflokkur',
					'add_new'           => 'Bæta við fundaflokki',
					'add_new_item'      => 'Bæta við fundaflokk á listann',
					'edit'              => 'Breyta',
					'edit_item'         => 'Breyta fundaflokki',
					'new_item'          => 'Nýr fundaflokkur',
					'view'              => 'Skoða',
					'view_item'         => 'Skoða fundaflokk',
					'search_items'      => 'Leita',
					'not_found'         => 'Ekkert fannst',
					'not_found_in_trash'=> 'Ekkert fannst í rusli'
				),
			'show_ui'           => true,
			'query_var'         => true,
			'show_admin_column' => true,
			'rewrite' => array('slug' => 'fundarflokkur')
		) );
} add_action('init', 'pirates_fundarflokkur_tax');



/* CPT fyrir Aðildarfélög Pírata */
function pirates_adildarfelog_cpt() {
    register_post_type('adildarfelog', array(
            'label' 		=> 'Aðildarfélög',
            'menu_icon' 	=> 'dashicons-networking',
            'description' 	=> 'Hérna listum við aðildarfélögin',
            'public' 		=> true,
            'show_ui' 		=> true,
            'show_in_menu' 	=> true,
            'capability_type'   => 'page',
            'map_meta_cap' 	=> true,
            'hierarchical' 	=> true,
            'query_var' 	=> true,
            'has_archive' 	=> false,
            'supports' 		=> array('title','editor','thumbnail'),
            'labels' 		=> array (
                'name'              => 'Aðildarfélög',
                'singular_name'     => 'Aðildarfélög',
                'menu_name'         => 'Aðildarfélög',
                'add_new'           => 'Bæta við aðildarfélag',
                'add_new_item'      => 'Bæta við aðildarfélagi á listann',
                'edit'              => 'Breyta',
                'edit_item'         => 'Breyta aðildarfélagi',
                'new_item'          => 'Nýtt aðildarfélag',
                'view'              => 'Skoða',
                'view_item'         => 'Skoða aðildarfélag',
                'search_items'      => 'Leita',
                'not_found'         => 'Ekkert fannst',
                'not_found_in_trash'=> 'Ekkert fannst í rusli'
            )
    ) );
} add_action('init', 'pirates_adildarfelog_cpt');



/* TAX fyrir Aðildarfélög - Kjördæmi */
function pirates_kjordaemi_tax() {
	register_taxonomy(
		'kjordaemi',
		array (
			0 => 'frambjodendur',
		),
		array(
			'hierarchical'      => true,
			'labels' 		=> array (
					'name'              => 'Kjördæmi',
					'singular_name'     => 'Kjördæmi',
					'menu_name'         => 'Kjördæmi',
					'add_new'           => 'Bæta við kjördæmi',
					'add_new_item'      => 'Bæta við kjördæmi á listann',
					'edit'              => 'Breyta',
					'edit_item'         => 'Breyta kjördæmi',
					'new_item'          => 'Nýtt kjördæmi',
					'view'              => 'Skoða',
					'view_item'         => 'Skoða kjördæmi',
					'search_items'      => 'Leita',
					'not_found'         => 'Ekkert fannst',
					'not_found_in_trash'=> 'Ekkert fannst í rusli'
				),
			'show_ui'           => true,
			'query_var'         => true,
			'show_admin_column' => true
		) );
} add_action('init', 'pirates_kjordaemi_tax');



/* CPT fyrir Fundargerð Pírata */
function pirates_log_cpt() {
    register_post_type('log-pirata', array(
            'label' 		=> 'Lög Pírata',
            'menu_icon' 	=> 'dashicons-welcome-learn-more',
            'description' 	=> 'Hérna listum við Lög aðildafélaga',
            'public' 		=> true,
            'show_ui' 		=> true,
            'show_in_menu' 	=> true,
            'capability_type'   => 'post',
            'map_meta_cap' 	=> true,
            'hierarchical' 	=> true,
            'query_var' 	=> true,
            'has_archive' 	=> false,
			'rewrite' =>	array( 'slug' => 'log-pirata'),
            'supports' 		=> array('title','editor'),
            'labels' 		=> array (
                'name'              => 'Lög Pírata',
                'singular_name'     => 'Lög Pírata',
                'menu_name'         => 'Lög Pírata',
                'add_new'           => 'Bæta við lagar færslu',
                'add_new_item'      => 'Bæta við lagar færslu á listann',
                'edit'              => 'Breyta',
                'edit_item'         => 'Breyta lagar færslu',
                'new_item'          => 'Ný lagar færsla',
                'view'              => 'Skoða',
                'view_item'         => 'Skoða lagar færslu',
                'search_items'      => 'Leita',
                'not_found'         => 'Ekkert fannst',
                'not_found_in_trash'=> 'Ekkert fannst í rusli'
            )
    ) );
} add_action('init', 'pirates_log_cpt');



/* TAX fyrir Aðildarfélög - Aðildarfélag */
function pirates_adildarfelag_tax() {
	register_taxonomy(
		'adildarfelag',
		array (
			0 => 'adildarfelog',
			1 => 'flokksfolk',
			2 => 'frambjodendur',
			3 => 'log-pirata'
		),
		array(
			'hierarchical'      => true,
			'labels' 		=> array (
					'name'              => 'Aðildarfélag',
					'singular_name'     => 'Aðildarfélag',
					'menu_name'         => 'Aðildarfélag',
					'add_new'           => 'Bæta við Aðildarfélagi',
					'add_new_item'      => 'Bæta við Aðildarfélag á listann',
					'edit'              => 'Breyta',
					'edit_item'         => 'Breyta Aðildarfélagi',
					'new_item'          => 'Nýtt kjördæmi',
					'view'              => 'Skoða',
					'view_item'         => 'Skoða Aðildarfélag',
					'search_items'      => 'Leita',
					'not_found'         => 'Ekkert fannst',
					'not_found_in_trash'=> 'Ekkert fannst í rusli'
				),
			'show_ui'           => true,
			'query_var'         => true,
			'show_admin_column' => true
		) );
} add_action('init', 'pirates_adildarfelag_tax');



/* TAX fyrir Aðildarfélög - Aðildarfélag */
function pirates_adildarfelagnav_tax() {
	register_taxonomy(
		'adildarfelagnav',
		array (
			0 => 'adildarfelog'
		),
		array(
			'hierarchical'      => true,
			'labels' 		=> array (
					'name'              => 'Staðsettning á Megamenu',
				),
			'show_ui'           => true,
			'query_var'         => true,
			'show_in_menu' => true
		) );
} add_action('init', 'pirates_adildarfelagnav_tax');



/* CPT fyrir Þingfólk Pírata */
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
			'rewrite' =>	array( 'slug' => 'piratar-a-thingi/thingfolk'),
            'supports' 		=> array('title','editor','thumbnail', 'page-attributes'),
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
} add_action('init', 'pirates_thingfolk_cpt');



/* CPT fyrir Stefnumál Pírata */
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
} add_action('init', 'pirates_stefnumal_cpt');



/* TAX fyrir Stefnumál Pírata, Stefnuflokkun 1 */
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



/* TAX fyrir Stefnumál Pírata, Stefnuflokkun 2 */
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



/* CPT fyrir Úrskurðarnefnd Pírata */
function pirates_urskurdarnefnd_cpt() {
    register_post_type('urskurdarnefnd', array(
            'label' 		=> 'Úrskurðarnefnd Pírata',
            'menu_icon' 	=> 'dashicons-index-card',
            'description' 	=> 'Hérna listum við Úrskurðarnefnd Pírata',
            'public' 		=> true,
            'show_ui' 		=> true,
            'show_in_menu' 	=> true,
            'capability_type'   => 'post',
            'map_meta_cap' 	=> true,
            'hierarchical' 	=> false,
            'query_var' 	=> true,
            'has_archive' 	=> true,
			'rewrite' =>	array( 'slug' => 'urskurdarnefnd/urskurdir'),
            'supports' 		=> array('title','editor'),
            'labels' 		=> array (
                'name'              => 'Úrskurðir',
                'singular_name'     => 'Úrskurðir',
                'menu_name'         => 'Úrskurðir',
                'add_new'           => 'Bæta við úrskurð',
                'add_new_item'      => 'Bæta við úrskurð á listann',
                'edit'              => 'Breyta',
                'edit_item'         => 'Breyta úrskurði',
                'new_item'          => 'Nýr úrskurður',
                'view'              => 'Skoða',
                'view_item'         => 'Skoða úrskurð',
                'search_items'      => 'Leita',
                'not_found'         => 'Ekkert fannst',
                'not_found_in_trash'=> 'Ekkert fannst í rusli'
            )
    ) );
} add_action('init', 'pirates_urskurdarnefnd_cpt');



/* TAX fyrir Úrskurðarnefnd Pírata, Úrskurðarnefndar flokkur 1 */
function pirates_urskurdarnefnd_malsnumer() {
	register_taxonomy(
		'urskurdarnefnd_malsnumer',
		array (
		0 => 'urskurdarnefnd',
		),
                    array(
		'hierarchical'  => true,
		'labels' 		=> array (
                'name'              => 'Málsnúmer',
                'singular_name'     => 'Málsnúmer',
                'menu_name'         => 'Málsnúmer',
                'add_new'           => 'Bæta við málsnúmeri',
                'add_new_item'      => 'Bæta við málsnúmeri á listann',
                'edit'              => 'Breyta',
                'edit_item'         => 'Breyta málsnúmeri',
                'new_item'          => 'Nýtt málsnúmer',
                'view'              => 'Skoða',
                'view_item'         => 'Skoða málsnúmer',
                'search_items'      => 'Leita',
                'not_found'         => 'Ekkert fannst',
                'not_found_in_trash'=> 'Ekkert fannst í rusli'
            ),
		'show_ui'           => true,
		'query_var'         => true,
		'show_admin_column' => true
	) );
} add_action('init', 'pirates_urskurdarnefnd_malsnumer');



/* TAX fyrir Úrskurðarnefnd Pírata, Úrskurðarnefndar flokkur 2 */
function pirates_urskurdarnefnd_malsar() {
	register_taxonomy(
		'urskurdarnefnd_mals_ar',
		array (
		0 => 'urskurdarnefnd',
		),
                    array(
		'hierarchical'  => true,
		'labels' 		=> array (
                'name'              => 'Málsár',
                'singular_name'     => 'Málsár',
                'menu_name'         => 'Málsár',
                'add_new'           => 'Bæta við málsári',
                'add_new_item'      => 'Bæta við málsári á listann',
                'edit'              => 'Breyta',
                'edit_item'         => 'Breyta málsári',
                'new_item'          => 'Nýtt málsár',
                'view'              => 'Skoða',
                'view_item'         => 'Skoða málsár',
                'search_items'      => 'Leita',
                'not_found'         => 'Ekkert fannst',
                'not_found_in_trash'=> 'Ekkert fannst í rusli'
            ),
		'show_ui'           => true,
		'query_var'         => true,
		'show_admin_column' => true
	) );
} add_action('init', 'pirates_urskurdarnefnd_malsar');



/* CPT fyrir Fyrirspurnir frá ráðherra Pírata */
function pirates_fptr_cpt() {
    register_post_type('radherrafyrirspurnir', array(
            'label' 		=> 'Fyrirspurnir til ráðherra',
            'menu_icon' 	=> 'dashicons-testimonial',
            'description' 	=> 'Hérna listum við fyrirspurnir frá Pírötum til ráðherra',
            'public' 		=> true,
            'show_ui' 		=> true,
            'show_in_menu' 	=> true,
            'capability_type'   => 'post',
            'map_meta_cap' 	=> true,
            'hierarchical' 	=> false,
            'query_var' 	=> true,
            'has_archive' 	=> false,
			'rewrite' =>	array( 'slug' => 'piratar-a-thingi/radherrafyrirspurnir'),
            'supports' 		=> array('title','editor'),
            'labels' 		=> array (
                'name'              => 'Fyrirspurnir',
                'singular_name'     => 'Fyrirspurnir',
                'menu_name'         => 'Fyrirspurnir',
                'add_new'           => 'Bæta við fyrirspurn',
                'add_new_item'      => 'Bæta við fyrirspurn á listann',
                'edit'              => 'Breyta',
                'edit_item'         => 'Breyta fyrirspurningu',
                'new_item'          => 'Ný fyrirspurn',
                'view'              => 'Skoða',
                'view_item'         => 'Skoða fyrirspurn',
                'search_items'      => 'Leita',
                'not_found'         => 'Ekkert fannst',
                'not_found_in_trash'=> 'Ekkert fannst í rusli'
            )
    ) );
} add_action('init', 'pirates_fptr_cpt');



/* TAX fyrir Fyrirspurnir frá Pírötum, Þingmaðr */
function pirates_fstr_thingmadur() {
	register_taxonomy(
		'fstr_thingmadur',
		array (
		0 => 'radherrafyrirspurnir',
		),
                    array(
		'hierarchical'  => true,
		'labels' 		=> array (
                'name'              => 'Þingmaður',
                'singular_name'     => 'Þingmaður',
                'menu_name'         => 'Þingmaður',
                'add_new'           => 'Bæta við þingmanni',
                'add_new_item'      => 'Bæta við þingmanni á listann',
                'edit'              => 'Breyta',
                'edit_item'         => 'Breyta þingmanni',
                'new_item'          => 'Nýr þingmaður',
                'view'              => 'Skoða',
                'view_item'         => 'Skoða þingmann',
                'search_items'      => 'Leita',
                'not_found'         => 'Ekkert fannst',
                'not_found_in_trash'=> 'Ekkert fannst í rusli'
            ),
		'show_ui'           => true,
		'query_var'         => true,
		'show_admin_column' => true
	) );
} add_action('init', 'pirates_fstr_thingmadur');



/* TAX fyrir Fyrirspurnir frá Pírötum, Löggjafa númer */
function pirates_fstr_loggjafanr() {
	register_taxonomy(
		'fstr_loggjafanr',
		array (
		0 => 'radherrafyrirspurnir',
		),
                    array(
		'hierarchical'  => true,
		'labels' 		=> array (
                'name'              => 'Löggjafa númer og ár',
                'singular_name'     => 'Löggjafa númer og ár',
                'menu_name'         => 'Löggjafa númer og ár',
                'add_new'           => 'Bæta við löggjafa númeri og ári',
                'add_new_item'      => 'Bæta við löggjafa númer og ári á listann',
                'edit'              => 'Breyta',
                'edit_item'         => 'Breyta löggjafa númeri og ári',
                'new_item'          => 'Nýtt löggjafa númer og ár',
                'view'              => 'Skoða',
                'view_item'         => 'Skoða löggjafa númer og ár',
                'search_items'      => 'Leita',
                'not_found'         => 'Ekkert fannst',
                'not_found_in_trash'=> 'Ekkert fannst í rusli'
            ),
		'show_ui'           => true,
		'query_var'         => true,
		'show_admin_column' => true
	) );
} add_action('init', 'pirates_fstr_loggjafanr');



/* CPT fyrir viðburði Pírata */
function pirates_events_cpt() {
    register_post_type('vidburdir', array(
            'label' 		=> 'Viðburðir',
            'menu_icon' 	=> 'dashicons-admin-site',
            'description' 	=> 'Hérna listum við viðburði hjá Pírutum',
            'public' 		=> true,
            'show_ui' 		=> true,
            'show_in_menu' 	=> true,
            'capability_type'   => 'post',
            'map_meta_cap' 	=> true,
            'hierarchical' 	=> false,
            'query_var' 	=> true,
            'has_archive' 	=> false,
			'rewrite' =>	array( 'slug' => 'taka-thatt/vidburdir'),
            'supports' 		=> array('title','editor','thumbnail'),
            'labels' 		=> array (
                'name'              => 'Viðburðir',
                'singular_name'     => 'Viðburðir',
                'menu_name'         => 'Viðburðir',
                'add_new'           => 'Bæta við viðburð',
                'add_new_item'      => 'Bæta við viðburð á listann',
                'edit'              => 'Breyta',
                'edit_item'         => 'Breyta viðburði',
                'new_item'          => 'Nýr viðburður',
                'view'              => 'Skoða',
                'view_item'         => 'Skoða viðburð',
                'search_items'      => 'Leita',
                'not_found'         => 'Ekkert fannst',
                'not_found_in_trash'=> 'Ekkert fannst í rusli'
            )
    ) );
} add_action('init', 'pirates_events_cpt');



/* TAX fyrir Fyrirspurnir frá Pírötum, Löggjafa númer */
function pirates_events_categories() {
	register_taxonomy(
		'vidburdir_flokkar',
		array (
		0 => 'vidburdir',
		),
                    array(
		'hierarchical'  => true,
		'labels' 		=> array (
                'name'              => 'Flokkun á viðburði',
                'singular_name'     => 'Flokkun á viðburði',
                'menu_name'         => 'Flokkun á viðburði',
                'add_new'           => 'Bæta við flokki',
                'add_new_item'      => 'Bæta við flokki á listann',
                'edit'              => 'Breyta',
                'edit_item'         => 'Breyta flokki',
                'new_item'          => 'Nýr flokkur',
                'view'              => 'Skoða',
                'view_item'         => 'Skoða flokk',
                'search_items'      => 'Leita',
                'not_found'         => 'Ekkert fannst',
                'not_found_in_trash'=> 'Ekkert fannst í rusli'
            ),
		'show_ui'           => true,
		'query_var'         => true,
		'show_admin_column' => true
	) );
} add_action('init', 'pirates_events_categories');
















































































/* Shortcode function til að ná í feed titla af external url */
function megamenu_feed_title_loop_shortcode( $atts ) {
    
    extract( shortcode_atts( array(
        'postcount' => 3,
		'feedurl' 	=> '',
		'cssclass' 	=> '',
		'cssid'		=> ''
    ), $atts ) );
    
    $output = '<div class="megamenu_loop megamenu_feed_title_loop"><p>';
    
    $rss = fetch_feed( $feedurl );

    if ( ! is_wp_error( $rss ) ) :
	
		// Checks that the object is created correctly
        // Figure out how many total items there are, but limit it to 5. 
        $maxitems = $rss->get_item_quantity( $postcount ); 
        // Build an array of all the items, starting with element 0 (first element).
        $rss_items = $rss->get_items( 0, $maxitems );
    endif;
    
    foreach ( $rss_items as $item ) :
    
        $output .= '<a id="'. $cssid .'" class="' . $cssclass . '" href="' . $item->get_permalink() . '">' . $item->get_title() . '</a>, ';
		
    endforeach;
	
	$final_output = substr($output, 0, -2);
	$final_output .= '</div></p>';
    return $final_output;
}
add_shortcode('megamenu-url-feed', 'megamenu_feed_title_loop_shortcode'); 



/* Shortcode function til að ná í fréttir og lúppa í megamenu */
function megamenu_news_loop_shortcode( $atts ) {
    
    extract( shortcode_atts( array(
        'newscount' => 1,
		'cssclass' 	=> '',
		'cssid'		=> ''
    ), $atts ) );
    
    $output = '<div class="megamenu_loop megamenu_news_loop"><p>';
    
    $args = array(
        'frettaflokkur' => 'frettir',
		'posts_per_page' => $newscount
		
    );
    $frettir_loop = new  WP_Query( $args );
    
    while($frettir_loop->have_posts()) : $frettir_loop->the_post(); 
    
	$output .= '<a id="'. $cssid .'" class="' . $cssclass . '" href="' . get_permalink() . '">' . get_the_title() . '</a>, ';
		
    endwhile;
	
	
	$final_output = substr($output, 0, -2);
	$final_output .= '</p></div>';
    return $final_output;
}
add_shortcode('megamenu-news-loop', 'megamenu_news_loop_shortcode');



/* Shortcode function til að ná í viðburði og lúppa í megamenu */
function megamenu_event_loop_shortcode( $atts ) {
    
    extract( shortcode_atts( array(
        'eventscount' => 1,
		'cssclass' 	=> '',
		'cssid'		=> ''
    ), $atts ) );
    
    $output = '<div class="megamenu_loop megamenu_event_loop"><p>';
    
    $args = array(
        'category_name' => 'vidburdir',
		'posts_per_page' => $eventscount
		
    );
    $frettir_loop = new  WP_Query( $args );
    
    while($frettir_loop->have_posts()) : $frettir_loop->the_post(); 
    
	$output .= '<a id="'. $cssid .'" class="' . $cssclass . '" href="' . get_permalink() . '">' . get_the_title() . '</a>, ';
		
    endwhile;
	
	
	$final_output = substr($output, 0, -2);
	$final_output .= '</p></div>';
    return $final_output;
}
add_shortcode('megamenu-event-loop', 'megamenu_event_loop_shortcode');



/* Shortcode function til að ná í fyrirspurnir til ráðherra titlum. */
function megamenu_fstr_loop_shortcode( $atts ) {
    
    extract( shortcode_atts( array(
        'newscount' => 1,
		'cssclass' 	=> '',
		'cssid'		=> ''
    ), $atts ) );
    
    $output = '<div class="megamenu_loop megamenu_news_loop"><p>';
    
    $args = array(
        'post_type' => 'radherrafyrirspurnir',
		'posts_per_page' => $newscount
		
    );
    $frettir_loop = new  WP_Query( $args );
    
    while($frettir_loop->have_posts()) : $frettir_loop->the_post(); 
    
	$output .= '<a id="'. $cssid .'" class="' . $cssclass . '" href="' . get_permalink() . '">' . get_the_title() . '</a>, ';
		
    endwhile;
	
	
	$final_output = substr($output, 0, -2);
	$final_output .= '</p></div>';
    return $final_output;
}
add_shortcode('megamenu-fstr-loop', 'megamenu_fstr_loop_shortcode');



/* Shortcode function til að ná í fyrirspurnir til ráðherra titlum. */
function megamenu_events_loop_shortcode( $atts ) {
    
    extract( shortcode_atts( array(
        'newscount' => 0,
		'cssclass' 	=> '',
		'cssid'		=> ''
    ), $atts ) );
    
    $output = '<div class="megamenu_loop megamenu_news_loop"><p>';
    
    $args = array(
        'post_type' => 'vidburdir',
		'posts_per_page' => $newscount
		
    );
    $frettir_loop = new  WP_Query( $args );
    
    while($frettir_loop->have_posts()) : $frettir_loop->the_post(); 
    
	$output .= '<a id="'. $cssid .'" class="' . $cssclass . '" href="' . get_permalink() . '">' . get_the_title() . '</a>, ';
		
    endwhile;
	
	
	$final_output = substr($output, 0, -2);
	$final_output .= '</p></div>';
    return $final_output;
}
add_shortcode('megamenu-events-loop', 'megamenu_events_loop_shortcode');













































































































