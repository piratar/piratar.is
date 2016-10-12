
<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>

<div class="section section-title">

    <div class="container-fluid">

        <div class="row">

            <div class="col-sm-12 col-lg-9 push-lg-1">

                <h2 class="the-title"><?php echo the_title(); ?></h2>
                <div class="post-date"><?php the_date('d.m.Y'); ?></div>        

            </div>

        </div>

    </div>

</div>
<div class="section section-content">

    <div class="container-fluid">

        <div class="row">

            <div class="col-sm-12 col-lg-9 push-lg-1">

                <article class="post">

                    <img src="<?php echo $image[0] ?>" class="post-featured">

                        <?php the_content(); ?>
                   
                </article>

            </div>

        </div>

    </div>

</div>

<?php endwhile; ?>

<?php get_footer(); ?>
