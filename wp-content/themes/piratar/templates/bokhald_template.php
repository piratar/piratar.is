<?php
    /* Template Name: Bókhald */
    get_header();
?>

<div class="section section-title">

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

            <div class="col-sm-12 col-lg-9 push-lg-1">

                <?php the_content(); ?>

                <?php get_template_part( 'content', "bokhald" ); ?>                

            </div>

        </div>

    </div>

</div>


<?php get_footer(); ?>
