<?php
    /* Template Name: Stefnumál */
    get_header();
?>

<div class="efnid">
    <div class="wrapper">
        <div class="alpha full">
            <?php while ( have_posts() ) : the_post(); ?>
                <h2 class="section-title"><?php echo the_title(); ?></h2>
                <?php get_template_part( 'content', "stefnumal" ); ?>
            <?php endwhile; ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>
