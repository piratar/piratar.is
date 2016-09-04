<?php get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>

<div class="container">
    <div class="row mb20">
        <div class="col-md-12">
            <h2 class="section-title"><?php echo the_title(); ?></h2>
        </div>
    </div>
    <div class="row mb20">
        <div class="col-md-12">
            <?php get_template_part( 'content', "page" ); ?>
            <?php endwhile; ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>
