<?php 



?>
<?php get_header(); ?>



<div class="section section-title">

    <div class="container-fluid">

        <div class="row">

            <div class="col-sm-12">

                <h2 class="the-title"><?php echo single_cat_title(); ?></h2>           

            </div>

        </div>

    </div>

</div>

<div class="section section-people">

    <div class="container-fluid">

        <div class="row">

            <div class="col-sm-12">

                <ul class="row">

                <?php $k = 1; ?>
                <?php while ( have_posts() ) : the_post(); ?>
                <?php
                    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
                    if ($image[0] == false) $image[0] =  get_template_directory_uri() . "/img/framb-default.png";
                    if (get_post_field("menu_order", $post->ID) != 0) {
                ?>
                    <li class="person col-sm-4"><figure><div><img src="<?php echo $image[0]; ?>"><div class="person-overlay"></div></div><span class="person-num"><?php echo $k; ?></span></figure><div class="person-wrap"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></div></li>
                <?php $k++; } ?>
                <?php endwhile; ?>

                </ul>

            </div>

        </div>

    </div>

</div>

<?php get_footer(); ?>
