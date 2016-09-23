<?php get_header(); ?>

<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ) ); ?>

<div class="section section-title">

    <div class="section-overlay"></div>

    <div class="container-fluid">

        <div class="row">

            <div class="col-sm-12">

                <h2 class="the-title"><?php the_title(); ?></h2>
                <div class="post-date"><?php the_date('d.m.Y'); ?></div>

            </div>

        </div>

    </div>

</div>

<div class="section section-content">

    <div class="container-fluid">

        <div class="row">

            <div class="col-sm-9 push-sm-1">

                <?php echo $image[0] ?>

                <?php while ( have_posts() ) : the_post(); ?>
                    <?php if(!has_post_thumbnail( $post->ID ) ): ?>
                        <h1 class=""><?php the_title(); ?></h1>
                        <span class=""><i><?php the_date('d.m.Y'); ?></i></span>
                    <?php endif; ?>
                    <?php //the_breadcrumb();  ?>
                    <?php the_content(); ?>
                <?php endwhile; ?>         

            </div>

        </div>

    </div>

</div>


<?php get_footer(); ?>
