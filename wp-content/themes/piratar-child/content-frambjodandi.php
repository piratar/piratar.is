<div class="thingfolk_text">

<?php the_post_thumbnail('medium', array( 'class' => 'thingfolk_thumb_img')); ?>

<?php the_content(); ?>
<?php
$taxonomies=get_taxonomies('','names');
$terms = wp_get_post_terms($post->ID, $taxonomies,  array("fields" => "names"));
?>
<br><p>Býður sig fram í: 
	<?php 
		$arrlength = count(@$terms);
		for($x = 0; $x < $arrlength; $x++) {
		echo $string = $terms[$x] . ' ';

		}
	?>
	</p>
</div>
