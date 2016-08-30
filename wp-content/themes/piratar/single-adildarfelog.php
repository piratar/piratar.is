<?php get_header(); ?>
<div id="imagebanner2" class="">
    <article class="">
        <?php if (has_post_thumbnail( $post->ID ) ): ?>
        <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'figure' ); ?>
            <figure class="" style="background-image:url(<?php echo $image[0]; ?>);background-color:white;">

            </figure>

        <?php endif; ?>
        <div class="coloroverlay"></div>
        <div class="wrapper">
            <div class="tourinfo">
                <h1 class="adildartitle"><?php the_title(); ?></h1>
                <div class="readmoretakkar">
                    <!-- Þurfum við þennan takka? (AVJ) -->
                    <span class="title_time"><?php the_field('news_date'); ?></span>
                </div>
            </div>
        </div>
    </article>
</div>

<div class="efnid">

    <?php
        $terms = get_the_terms( $post->ID , 'adildarfelag' );

        // Loop over each item since it's an array
        $termname = $terms[0]->slug;
    ?>

    <div class="yfir_rammi">
        <div class="wrapper">
            <h2 class="section-title">Stjórn Pírata í <?php  echo $terms[0]->name; ?></h2>
            <div class="splitter h20"></div>
            <?php

                $custom_query = new WP_Query("adildarfelag=$termname&post_type=flokksfolk&flokkstitill=stjornarkafteinn&posts_per_page=1&orderby=date&order=ASC"); 
                while($custom_query->have_posts()) : $custom_query->the_post();
                $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );

                ?>
                <article class="blogarticle">
                    <figure style="background-image: url(<?php echo $image[0]; ?>);background-size: contain;background-color:white;">
                        <a href="<?php the_permalink(); ?>"><img width="270" border="0" height="131" alt="" src="<?php echo $image[0]; ?>"></a>
                    </figure>
                    <div class="textinn">
                        <h2><a class="purple" href="<?php the_permalink(); ?>"><?php echo the_title(); ?></a></h2>
                        <p><?php echo excerpt(25); ?><h4><a href="<?php the_permalink(); ?>">Lesa meira</a></h4></p>
                    </div>
                </article>
            <?php
                endwhile;
            ?>
            <?php wp_reset_postdata(); // reset the query ?>

            <article class="blogarticle">
                <div class="minitextinn">
                    <?php
                        $custom_query = new WP_Query("adildarfelag=$termname&post_type=flokksfolk&flokkstitill=stjorn&posts_per_page=8&orderby=title&order=ASC"); 

                        while($custom_query->have_posts()) : $custom_query->the_post();
                        @$i++;
                        if($i <= 6) {
                    ?>
                        <div class="mini_stjornar_gluggi">
                            <h2><a class="purple" href="<?php the_permalink(); ?>"><?php echo the_title(); ?></a></h2>
                        </div>
                    <?php }
                        endwhile;
                        wp_reset_postdata(); // reset the query
                    ?>
                </div>

                <div class="minitextinn" >
                    <?php 
                        $custom_query1 = new WP_Query("adildarfelag=$termname&post_type=flokksfolk&flokkstitill=stjorn&posts_per_page=8&orderby=title&order=ASC"); 
                        while($custom_query1->have_posts()) : $custom_query1->the_post(); 
                        @$x++;
                        if($x > 6) {
                    ?>
                        <div class="mini_stjornar_gluggi">
                            <h2><a class="purple" href="<?php the_permalink(); ?>"><?php echo the_title(); ?></a></h2>
                        </div>
                    <?php }
                        endwhile;
                        wp_reset_postdata(); // reset the query
                    ?>
                </div>

            </article>

        </div><!-- end wrapper -->
    </div><!-- end rammi -->

    <div class="yfir_rammi">
        <div class="wrapper">
            <h2 class="section-title">Um aðildarfélagið</h2>
                <div class="splitter h20"></div>

                <div class="adildarfelog_fix">
                    <?php while ( have_posts() ) : the_post(); ?>
                    <?php the_content(); ?>
                    <?php endwhile; ?>
                </div>

            <div class="splitter h20"></div>

            <div class="adildarfelog_fix">
                <p>Heimilisfang: <?php the_field('adildarfelog_heimilisfang'); ?></p>
                <p>Sími: <?php the_field('adildarfelog_simi'); ?> - Email: <?php the_field('adildarfelog_email'); ?></p>
                <h5>Styrktu Pírata - þinn stuðningur skiptir miklu máli!</h5>
                <p>Kt: <?php the_field('adildarfelog_kennitala'); ?></p>
                <p>Reiknings nr: <?php the_field('adildarfelog_reikningsnr'); ?></p>
            </div>

            <div class="splitter h20"></div>
        </div><!-- end wrapper -->
    </div><!-- end rammi -->

    <div class="yfir_rammi">
        <div class="wrapper">
        <?php
            $custom_query = new WP_Query("adildarfelag=$termname&post_type=log-pirata&posts_per_page=1&orderby=date&order=ASC"); 
            while($custom_query->have_posts()) : $custom_query->the_post();
            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
        ?>

            <h2 class="section-title"><a class="" href="<?php the_permalink(); ?>"><?php echo the_title(); ?></a></h2>
            <div class="splitter h20"></div>
            <article class="blogarticle">
                <p><?php echo content(25); ?></p>
                <h4><a href="<?php the_permalink(); ?>">Lesa meira um aðildarlögin</a></h4>
            </article>
            <article class="blogarticle">
                <?php the_field('log_pirata_aukarammi'); ?>
            </article>
        <?php endwhile; ?>
        </div><!-- end wrapper -->
    </div><!-- end rammi -->


    <div class="yfir_rammi">
        <div class="wrapper">
            <h2 class="section-title">Fundargerðir</h2>
                <div class="splitter h20"></div>

                <?php
                    $custom_query = new WP_Query("fundarflokkur=$termname&post_type=fundargerdir&posts_per_page=10&orderby=date&order=DESC"); 
                    while($custom_query->have_posts()) : $custom_query->the_post();
                ?>
                    <h4><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h4>
                <?php endwhile; ?>
        </div>
    </div>

    <div class="frettir">
        <div class="wrapper">
            <h2 class="section-title">Fréttir frá aðildarfélagi</h2>
                <div class="splitter h20"></div>
                <?php
                    $i = 1;
                    $custom_query = new WP_Query("frettaflokkur=$termname&post_type=frettir&posts_per_page=5"); 
                    while($custom_query->have_posts()) : $custom_query->the_post(); 
                    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
                    $class = "";

                    if ($i == 1) { 
                        $class = "fyrsta";
                    } else if ($i > 3) {
                        $class = "nedri";
                    }
                ?>

                <article class="blogarticle <?php echo $class; ?>">
                    <div class="hr hr-short hr-center avia-builder-el-11 el_after_av_textblock el_before_av_textblock "><span class="hr-inner hr-inner-news"></span></div>
                    <?php if(has_post_thumbnail( $post->ID ) ) { ?>
                    <figure style="background-image: url(<?php echo $image[0]; ?>); background-size: contain; background-color:white !important;">
                        <a href="<?php the_permalink(); ?>"><img width="270" border="0" height="131" alt="" src="<?php echo $image[0]; ?>"></a>
                        <div class="date"><span><?php the_time('F'); ?></span><?php the_time('j'); ?></div>
                    </figure>
                    <?php } else {  ?>
                <?php $logo = 'http://piratar.gre.is/wp-content/uploads/2016/07/logo.png'; ?>
                    <figure class="" style="background-image: url(<?php echo $logo; ?>); background-size: contain; background-color:white !important;">
                        <a href="<?php the_permalink(); ?>"><img width="270" border="0" height="131" alt="" src="<?php echo $image[0]; ?>"></a>
                        <div class="date"><span><?php the_time('F'); ?></span><?php the_time('j'); ?></div>
                    </figure>
                <?php } ?>

                    <div class="smaforsidutexti">
                        <h2><a class="purple" href="<?php the_permalink(); ?>"><?php echo the_title(); ?></a></h2>
                        <p><?php echo excerpt(25); ?> </p>
                    </div>
                </article>

            <?php
                if ($i == 1) {  }
                $i++;
                endwhile;
                wp_reset_postdata(); // reset the query
            ?>
            <div class="splitter"></div>
        </div><!-- end wrapper -->
    </div><!-- end frettir -->

</div><!-- end efnid -->

<?php get_footer(); ?>
