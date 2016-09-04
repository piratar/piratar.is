<?php 
    /*
    Template Name: Capital Prófkjör
    */
    
    get_header();
 ?>
 
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="section-title">Frambjóðendur í Höfuðborgarkjördæmi</h2>
        </div>
    </div>

    <div class="row">
        <?php
            $custom_query = new WP_Query("kjordaemi=hofudborgarkjordaemi&post_type=frambjodendur&posts_per_page=-1&orderby=rand&order=ASC");
            while($custom_query->have_posts()) : $custom_query->the_post();
            $taxonomies=get_taxonomies('','names');
                $terms = wp_get_post_terms($post->ID, $taxonomies,  array("fields" => "names"));
        ?>

            <div class="col-md-4 allborder h500" id="<?php echo $fid ?>" >
                <div class="row">
                    <div class="col-md-4">
                        <a href="<?php echo esc_url(get_permalink()); ?>"><?php if(the_post_thumbnail('thingfolk_thumb', array( 'class' => 'img-responsive'))) ?></a>
                    </div>
                    <div class="col-md-8">
                        <h3>
                            <a href="<?php echo esc_url(get_permalink()); ?>" ><?php the_title(); ?></a>
                        </h3>
                        <p style="padding:5px;">
                            <?php echo excerpt(90); ?>
                        </p>
                        <h4><a href="<?php the_permalink(); ?>">Kynning á frambjóðenda</a></h4>
                        <?php
                            $x_hlekkur = get_field( "kosnignarvefur" );

                            if ($x_hlekkur) {
                                echo '<h4><a href="'. $x_hlekkur .'">Upplýsingar um frambjóðanda á kosningavef Pírata</a></h4>';
                            }
                        ?>
                    </div>
                </div>
            </div>

        <?php endwhile; ?>
    </div>
</div> <!-- end container -->

 <?php get_footer(); ?>
