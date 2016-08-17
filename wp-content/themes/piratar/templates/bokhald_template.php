<?php
    /* Template Name: Bókhald */
    get_header();
?>

<div class="efnid">
    <div class="wrapper">
        <div class="alpha full">
            <?php while ( have_posts() ) : the_post(); ?>
                <h2 class="section-title"><?php echo the_title(); ?></h2>
                <div class="splitter h20"></div>
                <?php the_content(); ?>
                <?php get_template_part( 'content', "bokhald" ); ?>
            <?php endwhile; ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>
