<?php get_header(); ?>

<div class="efnid" id="readmore">
    <div class="wrapper">
        <div class="alpha">
        <?php while ( have_posts() ) : the_post(); ?>

             <h1><?php the_title(); ?></h1>


        <?php
            the_content();
        ?>
            <div class="splitter h20"></div>
        <?php
            $x = get_field('fundargerd_upload');

            if($x) {
                $url = $x['url'];
                echo do_shortcode('[pdf-embedder url=" ' . $url . '"]');
        ?>
        </div>

        <div class="splitter h20"></div>
        <h2><a href="<?php echo $url ?>" download>Smellið hér til að hala niður fundargerðinni</a></h2>
    </div>
            <?php } else { ?>
                    </div>
                </div>
        <?php   } ?>
    <?php endwhile;  ?>
</div>

<?php get_footer(); ?>
