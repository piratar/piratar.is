<?php
    /* Template Name: Fréttir old */
    get_header();

    // set the "paged" parameter (use 'page' if the query is on a static front page)
    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
    $args = array(
        'frettaflokkur'     => 'frettir',
        'posts_per_page'    => 5,
        'paged'             => $paged
    );
    $frettir_loop = new  WP_Query( $args );
?>

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

            <div class="col-sm-12 col-lg-9 push-lg-1">

                <?php
            while($frettir_loop->have_posts()) : $frettir_loop->the_post(); 
            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );

         ?>
            <article class="post">
          
                    <h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <div class="post-meta"><?php the_date('j F Y , g:i a'); ?></div>
                    <p><?php the_excerpt(); ?> </p>
          
            </article>
        <?php endwhile; ?>      

        <p><a href="<?php echo get_site_url() ?>/frettir" class="btn btn-primary">Allar fréttir</a></p>


            </div>

        </div>

    </div>

</div>

<?php get_footer(); ?>
