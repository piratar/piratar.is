<?php
    /* Template Name: Forsíða */

    get_header();
?>

<div class="section section-card section-bg-image section-text-white section-align-center" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/kosningar-2016.jpg);">

    <div class="section-overlay">

        <div class="container-fluid">

            <div class="row">

                <div class="col-sm-12">

                    <h1>Hópfjármögnun Pírata</h1>
                    <h2>Kraftur fjöldans í samstarfi við Karolina Fund</h2>
                    <p><a href="http://piratar.karolinafund.com/" class="btn btn-primary">Styrkja</a></p>

                </div>

            </div>

        </div>

    </div>

</div>

<div class="section section-bg-graylightest">

    <div class="container-fluid">

        <div class="row">

            <div class="col-sm-4">

                <?php the_field('frontbox_left', 37894); ?>

            </div>

            <div class="col-sm-4">

                <?php the_content(); ?>

            </div>

            <div class="col-sm-4">

                <?php the_field('frontbox_right', 37894); ?>

            </div>

        </div>

    </div>

</div>

<?php
    $news = new WP_Query('frettaflokkur=frettir&posts_per_page=5');
?>

<!--div class="box nedrabox" style="height:400px;">
    <?php the_field('frontbox_lover_right', 37894); ?>
</div-->

<div class="section section-grid">

    <div class="container-fluid">

        <div class="row">

            <div class="col-sm-12">
                <h2 class="the-title">Fréttir</h2>
            </div>

        </div>

        <div class="row">

        <?php 
            while($news->have_posts()) : $news->the_post();
            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
            // if(has_post_thumbnail( $post->ID ) )
        ?>

            <div class="grid-item <?php if($news->current_post == 0) { echo " col-sm-8"; } else { echo " col-sm-4"; } ?><?php if(has_post_thumbnail($post->ID)) echo " grid-bg-image" ?>" style="background-image: url(<?php if(has_post_thumbnail($post->ID)) echo $image[0] ?>);">

                <article>

                    <div class="grid-wrap">

                        <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                        <div class="date"><?php the_time('F j'); ?></div>

                    </div>

                </article>

            </div>

            <?php if (($news->current_post+1) % 3 == 0) {
                ?><!--/div><div class="row"--><?php
            } ?>


        <?php endwhile; ?>

        </div>

    </div>

</div>


<div class="section section-content socialbar nomobile">

    <div class="container-fluid">

        <div class="row">

            <div class="col-sm-12">
            
                <h2 class="the-title">Samfélagsmiðlar</h2>
        
                <div class="hr hr-short hr-center avia-builder-el-11 el_after_av_textblock el_before_av_textblock "><span class="hr-inner "><span class="hr-inner-style"></span></span></div>
        
                <?php echo do_shortcode('[instagram-feed]'); ?>

            </div>

        </div>

    </div>

</div>

<?php get_footer(); ?>
