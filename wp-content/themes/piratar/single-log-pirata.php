<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>

<div class="section section-card section-title <?php if($image) echo " section-bg-image" ?>" style="background-image: url(<?php echo $image[0] ?>);">

    <div class="section-overlay"></div>

    <div class="container-fluid">

        <div class="row">

            <div class="col-sm-12">

                <h2 class="the-title"><?php echo the_title(); ?></h2>           

            </div>

        </div>

    </div>

</div>

<div class="section section-content">

    <div class="container-fluid">

        <div class="row">

            <div class="col-sm-12 col-lg-9 push-lg-1 post">

                <?php get_template_part( 'content', "page" ); ?> 

                <?php the_field('log_pirata_aukarammi'); ?>              

            </div>

        </div>

    </div>

</div>

<?php endwhile; ?>

<?php get_footer(); ?>