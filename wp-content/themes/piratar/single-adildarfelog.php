<?php get_header(); ?>

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

<?php
    $terms = get_the_terms( $post->ID , 'adildarfelag' );

    // Loop over each item since it's an array
    $termname = $terms[0]->slug;
?>

<div class="section section-content section-bg-gray">

    <div class="container-fluid">

        <div class="row">

            <div class="col-sm-12">
                <h2 class="the-title">Stjórn Pírata í <?php  echo $terms[0]->name; ?></h2>
            </div>

        </div>

        <div class="row">

            <div class="col-sm-7">

                 <?php

                $custom_query = new WP_Query("adildarfelag=$termname&post_type=flokksfolk&flokkstitill=stjornarkafteinn&posts_per_page=1&orderby=date&order=ASC"); 
                while($custom_query->have_posts()) : $custom_query->the_post();
                $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );

                ?>
                <article class="post">

                    <figure class="figure-round figure-small figure-right"><div class="figure-wrap"><img src="<?php echo $image[0]; ?>"></div></figure>
                 
                    <h2><a href="<?php the_permalink(); ?>"><?php echo the_title(); ?></a></h2>
                    <p><?php echo excerpt(25); ?><h4><a href="<?php the_permalink(); ?>">Lesa meira</a></h4></p>
             
                </article>
            <?php
                endwhile;
            ?>
            <?php wp_reset_postdata(); // reset the query ?>

            </div>

            <div class="col-sm-5">
                <h3>Aðrir í stjórn</h3>
                <ul>
                 <?php
                        $custom_query = new WP_Query("adildarfelag=$termname&post_type=flokksfolk&flokkstitill=stjorn&posts_per_page=8&orderby=title&order=ASC"); 

                        while($custom_query->have_posts()) : $custom_query->the_post();
                        @$i++;
                        if($i <= 6) {
                    ?>
                        
                            <li><a href="<?php the_permalink(); ?>"><?php echo the_title(); ?></a></li>
                        
                    <?php }
                        endwhile;
                        wp_reset_postdata(); // reset the query
                    ?>
                    </ul>
            </div>



        </div>

    </div>

</div>

<div class="section section-content">

    <div class="container-fluid">

        <div class="row">

            <div class="col-sm-12">
                <h2 class="the-title">Um aðildarfélagið</h2>
            </div>

        </div>

        <div class="row">

            <div class="col-sm-6">

                <?php while ( have_posts() ) : the_post(); ?>
                <?php the_content(); ?>
                <?php endwhile; ?>

            </div>

            <div class="col-sm-6">

                <p>Heimilisfang: <?php the_field('adildarfelog_heimilisfang'); ?></p>
                <p>Sími: <?php the_field('adildarfelog_simi'); ?> - Email: <?php the_field('adildarfelog_email'); ?></p>
                <h5>Styrktu Pírata</h5>
                <p>Kt: <?php the_field('adildarfelog_kennitala'); ?></p>
                <p>Reiknings nr: <?php the_field('adildarfelog_reikningsnr'); ?></p>

            </div>

        </div>

    </div>

</div>


<?php
    $custom_query = new WP_Query("adildarfelag=$termname&post_type=log-pirata&posts_per_page=1&orderby=date&order=ASC"); 
    while($custom_query->have_posts()) : $custom_query->the_post();
    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
?>

<div class="section section-content section-bg-gray">

    <div class="container-fluid">

        <div class="row">

            <div class="col-sm-12">
                <h2 class="the-title"><?php echo the_title(); ?></h2>
            </div>

        </div>

        <div class="row">

            <div class="col-sm-6">

                <p><?php echo content(25); ?></p>

                <h4><a href="<?php the_permalink(); ?>">Lesa meira um aðildarlögin</a></h4>

            </div>

            <div class="col-sm-6">

                <?php the_field('log_pirata_aukarammi'); ?>

            </div>

        </div>

    </div>

</div>

 <?php endwhile; ?>

<div class="section section-content">

    <div class="container-fluid">

        <div class="row">

            <div class="col-sm-12">
                <h2 class="the-title">Fundargerðir</h2>
            </div>

        </div>

        <div class="row">

            <div class="col-sm-12">

                <div class="row">

                    <div class="col-sm-6">

                        <ul>
                        <?php
                            $custom_query = new WP_Query("fundarflokkur=$termname&post_type=fundargerdir&posts_per_page=999&orderby=date&order=ASC"); 
                            while($custom_query->have_posts()) : $custom_query->the_post();
                        ?>
                            <li><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></li>
                        <?php

                        if ($custom_query->current_post == floor($custom_query->found_posts / 2)) {
                            ?></ul></div><div class="col-sm-6"><ul><?php
                        }

                         endwhile; ?>
                        </ul>


                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


<?php $news = new WP_Query("frettaflokkur=$termname&post_type=frettir&posts_per_page=5"); ?>

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

<?php get_footer(); ?>
