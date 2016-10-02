<?php
    /* Template Name: Forsíða */

    get_header();
?>

<div class="section section-card section-bg-image section-text-white section-align-center" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/kosningar-2016.jpg);">

    <div class="section-overlay">

        <div class="container-fluid">

            <div class="row">

                <div class="col-sm-12">

                    <h1>Við viljum að þú ráðir</h1>
                    <h2>Meira lýðræði í krafti fjöldans</h2>
                    <p><a href="http://piratar.karolinafund.com/" class="btn btn-primary">Styrkja</a> <a href="<?php echo get_site_url(); ?>/" class="btn btn-primary">Taka þátt</a></p>

                </div>

            </div>

        </div>

    </div>

</div>

<div class="section section-content section-bg-gray">

    <div class="section-overlay">

        <div class="container-fluid">

            <div class="row">

                <div class="col-sm-12">
                    <h2 class="the-title">Stefnan</h2>
                </div>

            </div>

            <div class="row">

                <div class="col-sm-4">

                    <h2>Uppfærum Ísland með nýrri stjórnarskrá</h2>
                    
                    <p>Píratar eru sannfærðir um að lögfesting nýrrar stjórnarskrár sé grunnforsenda mikilvægra samfélagslegra umbóta á Íslandi.</p>

                </div>

                <div class="col-sm-4">

                    <h2>Tryggjum réttláta dreifingu arðs af auðlindum</h2>
                    
                    <p>Píratar vilja að íslenska þjóðin fái sanngjarnan arð af nýtingu sameiginlegra auðlinda sinna.</p>

                </div>

                <div class="col-sm-4">

                    <h2>Endurreisum gjaldfrjálsa heilbrigðisþjónustu</h2>
                    
                    <p>Píratar standa vörð um þessi sjálfsögðu mannréttindi og stefna að því að heilbrigðisþjónusta og nauðsynleg lyfjakaup verði gjaldfrjáls.</p>

                </div>

            </div>

            <div class="row stefna-cta">

                <div class="col-sm-4">

                    <h2>Eflum aðkomu almennings að ákvarðanatöku</h2>
                    
                    <p>Píratar treysta fólkinu í landinu til þess að taka góðar og skynsamlegar ákvarðanir um líf sitt og samfélag.</p>

                </div>

                <div class="col-sm-4">

                    <h2>Endurvekjum traust og tæklum spillingu</h2>
                    
                    <p>Píratar álíta gagnsæi nauðsynlega forsendu fyrir ábyrgð í stjórnsýslu og upplýstri þátttöku almennings í lýðræðinu.</p>

                </div>

                <div class="col-sm-4">
                    
                    <p><a href="<?php echo get_site_url(); ?>/kosningar" class="btn btn-primary pull-right">Ýtarleg stefna Pírata</a></p>

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

            <div class="grid-item <?php if($news->current_post == 0) { echo " col-sm-8"; } else { echo " col-sm-4"; } ?><?php if(has_post_thumbnail($post->ID)) echo " grid-bg-image" ?>" style="background-image: url(<?php if(has_post_thumbnail($post->ID)) echo $image[0] ?>);">

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

    </div>

</div>


<?php
    $news = new WP_Query('frettaflokkur=i-fjolmidlum&posts_per_page=6');
?>

<div class="section section-grid ">

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

            <div class="grid-item col-sm-4 <?php if(has_post_thumbnail($post->ID)) echo " grid-bg-image" ?>" style="background-image: url(<?php if(has_post_thumbnail($post->ID)) echo $image[0] ?>);">

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


<div class="section section-content section-bg-gray">

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
