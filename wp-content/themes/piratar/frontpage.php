<?php
    /* Template Name: Forsíða */

    get_header();
?>

<div id="imagebanner">
    <div id="videokilltheradiostar"></div>
    <article>
        <figure style="background-image:url(wp-content/themes/piratar/img/piratar-crop.jpg);">

        </figure>
        <div class="intro"></div>
    </article>
</div>

<div id="boxin_kynning">
    <div class="wrapper">
        <div class="box" style="height:270px;">
            <?php the_field('frontbox_left', 37894); ?>
        </div>
        <div class="box middlebox" >
            <!--<h2>Viðburðadagatal</h2>
            <?php //echo do_shortcode('[ecs-list-events limit="3"]'); ?>
            <p>&nbsp;</p>
            <a href="/vidburdir/">Opna dagatal</a>-->
            <?php the_content(); ?>
        </div>
        <div class="box" style="height:270px;">
            <?php the_field('frontbox_right', 37894); ?>
        </div>
    </div>
</div>




<div class="frettir">
    <div class="wrapper">
        <div class="ord">
            <div class="box nedrabox" style="height:400px;">
                <?php the_field('frontbox_lover_right', 37894); ?>
            </div>
        </div>

        <?php
            $i = 1;
            $custom_query = new WP_Query('frettaflokkur=frettir&posts_per_page=5');
            while($custom_query->have_posts()) : $custom_query->the_post();
            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
            $class = "";
            if ($i == 1) {
                $class = "fyrsta";
            } else if ($i > 3) {
                $class = "nedri";
            }
        ?>
        <?php if ($i == 1) { ?>

        <?php } ?>
            <article class="blogarticle <?php echo $class; ?>">
               <?php if ($i == 1) { ?><h2 class="section-title"><a href="/piratar-a-thingi/frettir/">Fréttir</a></h2><?php } ?>
                <div class="hr hr-short hr-center avia-builder-el-11 el_after_av_textblock el_before_av_textblock "><span class="hr-inner hr-inner-news"></span></div>
                <?php if(has_post_thumbnail( $post->ID ) ) { ?>
                <figure style="background-image: url(<?php echo $image[0]; ?>);background-size:contain;">
                    <a href="<?php the_permalink(); ?>"><img width="270" border="0" height="131" alt="" src="<?php echo $image[0]; ?>"></a>
                    <div class="date"><span><?php the_time('F'); ?></span><?php the_time('j'); ?></div>
                </figure>
                <?php } else {  ?>
            <?php $logo = 'http://piratar.gre.is/wp-content/uploads/2016/07/logo.png'; ?>
                <figure class="" style="background-image: url(<?php echo $logo; ?>);background-size:contain;">
                    <a href="<?php the_permalink(); ?>"><img width="270" border="0" height="131" alt="" src="<?php echo $image[0]; ?>"></a>
                    <div class="date"><span><?php the_time('F'); ?></span><?php the_time('j'); ?></div>
                </figure>
            <?php } ?>
                <div class="smaforsidutexti">
                    <h2><a class="title_uppercase" href="<?php the_permalink(); ?>"><?php echo the_title(); ?></a></h2>
                    <p><?php echo excerpt(30); ?><a class="title_uppercase" href="<?php the_permalink(); ?>">Lesa meira</a></p>
                </div>
            </article>
        <?php if ($i == 1) { ?>
        <div class="splitter h20"></div>
        <?php } ?>
        <?php
            $i++;
            endwhile;
        ?>
        <?php wp_reset_postdata(); // reset the query ?>
        <div class="splitter h20"></div>
        <div class="splitter h20"></div>
        <h2><a href="/piratar-a-thingi/frettir/">Sjá allar fréttir</a></h2>
    </div>

</div>
<div class="socialbar nomobile">
    <div class="wrapper">
        <h2 class="section-title">Samfélagsmiðlar</h2>
        <div class="hr hr-short hr-center avia-builder-el-11 el_after_av_textblock el_before_av_textblock "><span class="hr-inner "><span class="hr-inner-style"></span></span></div>
        <?php echo do_shortcode('[instagram-feed]'); ?>
    </div>
</div>

<?php get_footer(); ?>
