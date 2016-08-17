<?php

get_header(); 

?>

<div id="imagebanner">

    <article>
        <?php if (has_post_thumbnail( $post->ID ) ): ?>
        <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'figure' ); ?>
            <figure style="background-image:url(<?php echo $image[0]; ?>);">
            </figure>
        <?php endif; ?> 
        <div class="coloroverlay"></div>
        <div class="wrapper">
            <div class="tourinfo">
                <h1 class="tour-title"><?php the_title(); ?></h1>
                <div class="readmoretakkar">
                    <!-- Þurfum við þennan takka? (AVJ) --> 
                    <span class="title_time"><?php the_field('event_date'); ?> - Klukkan: <?php the_field('event_time'); ?></span>
                    <br><br><span class="title_time"><?php $terms = get_the_terms($post->id, 'vidburdir_flokkar'); echo $terms[0]->name; ?></span>
                </div>
            </div>
        </div>
    </article>

</div>

<div class="post_content">
    <div class="wrapper">

        <div class="alpha">
        <?php while ( have_posts() ) : the_post(); ?>
            <?php the_content(); ?>
        <?php endwhile; ?>
        </div>

        <div class="splitter h20"></div>
    </div>

</div>
    <?php
        $location = get_field('event_address');
        if( !empty($location) ):
        ?>
        <div class="stretch_hori">
            <div class="acf-map">
                <div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
            </div>
        </div>
    <?php endif; ?>
<?php get_footer(); ?>
