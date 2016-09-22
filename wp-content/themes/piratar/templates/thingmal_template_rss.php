<?php
    /* Template Name: Þingmál RSS */
    get_header();
    // set the "paged" parameter (use 'page' if the query is on a static front page)
    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
    $args = array(
        'post_type'     => 'thingmal',
        'thingmalsflokkur' => 'thingmal_pirata',
        'posts_per_page'    => -1,
        'paged'             => $paged
    );
    $frettir_loop = new  WP_Query( $args );
?>

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

<div class="section section-content">

    <div class="container-fluid">

        <div class="row">

            <div class="col-sm-9 push-sm-1">

        <?php 
            while($frettir_loop->have_posts()) : $frettir_loop->the_post(); 
        ?>
                <article class="post">

                    <h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

                    <span class="post-meta"><?php the_date('j F Y , g:i a'); ?></span>

                    <div class="post-content">
                        <?php the_excerpt(); ?>
                    </div>
                    
                </article>
        <?php endwhile; ?>

            </div>

        </div>

    </div>

</div><!-- end efnid -->


<?php get_footer(); ?>
