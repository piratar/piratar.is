<?php the_content(); ?>

<?php
$taxonomies=get_taxonomies('','names');
$terms = wp_get_post_terms($post->ID, $taxonomies,  array("fields" => "names"));
$value = get_field( "kosnignarvefur" );

?>

<?php
$x_hlekkur = get_field( "kosnignarvefur" );

if ($x_hlekkur) {
	//echo '<p><a href="'. $x_hlekkur .'">Upplýsingar um frambjóðanda á kosningavef Pírata</a></p>';
}	

?>
