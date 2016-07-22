<?php

?>
<h2 class="nav-tab-wrapper">
    <a href="#" class="nav-tab">Display Options</a>
    <a href="#" class="nav-tab">Social Options</a>
</h2>
<p>hi voting</p>

<form method="post" action="options.php">
 
            <?php settings_fields( 'frontpage_bar_options' ); ?>
            <?php do_settings_sections( 'frontpage_bar_options' ); ?> 
         
            <?php submit_button( 'Vista'); ?>
             
</form>
<?php 

/* */

function voting_initialize_settings() {
	/* */
	
	//
	if ( false == get_option( 'frontpage_bar_options' )) {
		add_option('frontpage_bar_options');
	}
}


https://paulund.co.uk/theme-options-page