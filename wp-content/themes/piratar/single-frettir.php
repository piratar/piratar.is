<?php get_header(); ?>

<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "large" ); ?>

<div class="section section-title">

    <div class="section-overlay"></div>

    <div class="container-fluid">

        <div class="row">

            <div class="col-sm-12 col-lg-9 push-lg-1 post">

                <h2 class="the-title"><?php the_title(); ?></h2>
                <div class="post-date"><?php the_date('d.m.Y'); ?></div>

            </div>

        </div>

    </div>

</div>

<div class="section section-content">

    <div class="container-fluid">

        <div class="row">

            <div class="col-sm-12 col-lg-9 push-lg-1 post">

                <article class="post">

                    <img src="<?php echo $image[0] ?>" class="post-featured">

                    <?php while ( have_posts() ) : the_post(); ?>
                        <?php the_content(); ?>
                    <?php endwhile; ?>

                </article>

            </div>

        </div>

    </div>

</div>


<?php get_footer(); ?>
