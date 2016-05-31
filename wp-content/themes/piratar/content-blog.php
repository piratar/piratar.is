<?php 
    $i = 1;
    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
    $field = get_field_object('from');
    $value = get_field('from');
    $label = $field['choices'][ $value ];
    $merki = get_field('merki');
?>
<article class="blogitem <?php echo $value?> mb20">
    <!--h2><?php echo $label; ?></h2-->
    <div class="mynd">
        <figure style="background-image: url(<?php echo $image[0]; ?>);">
            <a href="<?php the_permalink(); ?>"><img src="<?php echo $image[0]; ?>" width="270" height="131" border="0" alt="" /></a>
        </figure>
    </div>
    <div class="texti">
        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <time><?php the_time('F j, Y'); ?></time>
       <?php the_excerpt(); ?> 
    </div>
    
</article>
