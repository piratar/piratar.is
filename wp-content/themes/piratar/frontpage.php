<?php
    /* Template Name: Forsíða */

    get_header();

?>

<?php if (get_field('fronttop_show')) { ?>

<div class="section section-card section-bg-image section-text-white section-align-center" style="background-image: url(<?php the_field('fronttop_background'); ?>);">

    <div class="section-overlay">

        <div class="container-fluid">

            <div class="row">

                <div class="col-md-10 offset-md-1">

                    <?php the_field('fronttop_content'); ?>

                    <p class="buttons-ctas">
                        <a href="http://piratar.karolinafund.com/" class="btn btn-primary btn-white">Styrkja</a>
                        <a href="<?php echo get_site_url(); ?>/taka-thatt/hvernig-tek-eg-thatt/" class="btn btn-primary btn-white">Taka þátt</a>
                    </p>

                </div>

            </div>

        </div>

    </div>

</div> 

<?php } else { ?>

<div class="section section-card section-bg-image section-text-white section-align-center" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/kosningar-2016.jpg);">

    <div class="section-overlay">

        <div class="container-fluid">

            <div class="row">

                <div class="col-sm-12">

                    <h1>Endurræsum Ísland</h1>

                    <p class="buttons-ctas">
                        <a href="http://piratar.karolinafund.com/" class="btn btn-primary btn-white">Styrkja</a>
                        <a href="<?php echo get_site_url(); ?>/taka-thatt/hvernig-tek-eg-thatt/" class="btn btn-primary btn-white">Taka þátt</a>
                    </p>

                </div>

            </div>

        </div>

    </div>

</div>

<?php } ?>

<div class="section section-content section-two section-bg-gray">

    <div class="section-overlay">

        <div class="container-fluid">

            <div class="row">

                <div class="two-item two-color-purple text-xs-center col-md-6">

                    <h2>Áherslumál</h2>
                    
                    <p>Við leggjum áherslu á nýja stjórnarskrá, auðlindir í almannaþágu, gjaldfrjálsa heilbrigðisþjónustu, þátttöku í ákvarðanatöku og átak gegn spillingu.</p>

                    <p class="two-button"><a href="<?php echo get_site_url(); ?>/kosningar" class="btn btn-primary btn-white">Lesa meira</a></p>

                </div>

                <div class="two-item two-color-purple-light text-xs-center col-md-6">

                    <h2>Framtíðarsýn</h2>
                    
                    <p>Ítarleg áætlun Pírata í öllum helstu málaflokkum. Þar á meðal velferðarmál, atvinnumál, landbúnaðarmál og lýðræðismál.</p>

                    <p class="two-button"><a href="<?php echo get_site_url(); ?>/kosningar/framtidarsyn" class="btn btn-primary btn-white">Lesa meira</a></p>

                </div>

            </div>

        </div>

    </div>

</div>

<?php switch_to_blog(2); ?>
<?php get_template_part( 'content', "frambjodendur" ); ?>
<?php
    restore_current_blog();
    $news = new WP_Query('frettaflokkur=frettir&posts_per_page=5');
?>

<div class="section section-grid section-bg-gray">

    <div class="container-fluid">

        <div class="row">

            <div class="col-sm-12">
                <h2 class="the-title">Fréttir</h2>
            </div>

        </div>

        <div class="row">

        <?php 
            while($news->have_posts()) : $news->the_post();
            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
            // if(has_post_thumbnail( $post->ID ) )
        ?>

            <div class="grid-item <?php if($news->current_post == 0) { echo " col-xs-12 col-md-12 col-xl-8"; } else { echo " col-xs-12 col-md-6 col-xl-4"; } ?><?php if(has_post_thumbnail($post->ID)) echo " grid-bg-image" ?>" style="background-image: url(<?php if(has_post_thumbnail($post->ID)) echo $image[0] ?>);">

                <article>

                    <div class="grid-wrap">

                        <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                        <div class="date"><?php the_time('d.m.Y'); ?></div>

                    </div>

                </article>

            </div>

            <?php if (($news->current_post+1) % 3 == 0) {
                ?><!--/div><div class="row"--><?php
            } ?>


        <?php endwhile; wp_reset_query(); ?>

        </div>

         <div class="row">

            <div class="col-sm-12 text-xs-center">
                <p>&nbsp;<br><a href="/frettir" class="btn btn-primary">Allar fréttir</a></p>
            </div>

        </div>


    </div>

</div>


<?php
    $news = new WP_Query('frettaflokkur=i-fjolmidlum&posts_per_page=6');
?>

<div class="section section-grid section-grid-minimal">

    <div class="container-fluid">

        <div class="row">

            <div class="col-sm-12">
                <h2 class="the-title">Píratar í fjölmiðlum</h2>
            </div>

        </div>

        <div class="row">

        <?php 
            while($news->have_posts()) : $news->the_post();
            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
            // if(has_post_thumbnail( $post->ID ) )
        ?>

            <div class="grid-item col-xs-12 col-md-6 col-xl-4 <?php if(has_post_thumbnail($post->ID)) echo " grid-bg-image" ?>" style="background-image: url(<?php if(has_post_thumbnail($post->ID)) echo $image[0] ?>);">

                <article>

                    <div class="grid-wrap">

                        <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                        <div class="date"><?php the_time('d.m.Y'); ?></div>

                    </div>

                </article>

            </div>

            <?php if (($news->current_post+1) % 3 == 0) {
                ?><!--/div><div class="row"--><?php
            } ?>


        <?php endwhile; wp_reset_query(); ?>

        </div>

        <div class="row">

            <div class="col-sm-12 text-xs-center">
                <p>&nbsp;<br><a href="/frettaflokkur/i-fjolmidlum/" class="btn btn-primary">Fleiri fréttir</a></p>
            </div>

        </div>

       
    </div>

</div>


<div class="section section-content section-bg-gray">

    <div class="container-fluid">

        <div class="row">

            <div class="col-md-4">

                <?php the_field('frontbox_left', 37894); ?>

            </div>

            <div class="col-md-4">

                <?php the_content(); ?>

            </div>

            <div class="col-md-4">

                <?php the_field('frontbox_right', 37894); ?>

            </div>

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
