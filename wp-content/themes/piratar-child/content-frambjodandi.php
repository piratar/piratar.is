<div class="thingfolk_text">

<?php the_post_thumbnail('medium', array( 'class' => 'thingfolk_thumb_img')); ?>

<?php the_content(); ?>
<?php
$taxonomies=get_taxonomies('','names');
$terms = wp_get_post_terms($post->ID, $taxonomies,  array("fields" => "names"));
$value = get_field( "kosnignarvefur" );

?>
<br>

<?php
$x_hlekkur = get_field( "kosnignarvefur" );

if ($x_hlekkur) {
	echo '<h4><a href="'. $x_hlekkur .'">Upplýsingar um frambjóðanda á kosningavef Pírata</a></h4>';
}	

?>

</div>
