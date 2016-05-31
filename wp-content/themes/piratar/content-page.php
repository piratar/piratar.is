<?php 
    $i = 1;
    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
    $field = get_field_object('from');
    $value = get_field('from');
    $label = $field['choices'][ $value ];
?>

<?php the_content(); ?>
<div class="clear post-spt"></div>