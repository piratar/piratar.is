<?php get_header(); ?>

<?php if (has_post_thumbnail( $post->ID ) ): ?>
<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ) ); ?>
    <div id="imagebanner">
        <article>
            <figure style="background-image:url(<?php echo $image[0]; ?>);"></figure>
            <div class="coloroverlay"></div>
            <div class="wrapper">
                <div class="tourinfo">
                    <h1 class="h1_title"><?php the_title(); ?></h1>
                    <div class="readmoretakkar">
                        <!-- Þurfum við þennan takka? (AVJ) --> 
                        <span class="title_time"><?php the_date('d.m.Y'); ?></span>
                    </div>
                </div>
            </div>
        </article>
    </div>
<?php endif; ?>

<div class="efnid" id="readmore">
    <div class="wrapper">
        <div class="alpha">
        <?php while ( have_posts() ) : the_post(); ?>
            <?php if(!has_post_thumbnail( $post->ID ) ): ?>
                <h1 class=""><?php the_title(); ?></h1>
                <span class=""><i><?php the_date('d.m.Y'); ?></i></span>
            <?php endif; ?>
            <?php //the_breadcrumb();  ?>
            <?php the_content(); ?>
        <?php endwhile; ?>
        </div>
        <div class="splitter h20"></div>
    </div>
</div>

<?php get_footer(); ?>
