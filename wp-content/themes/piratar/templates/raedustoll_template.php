<?php
    /* Template Name: Úr ræðustól */
    get_header();

    // set the "paged" parameter (use 'page' if the query is on a static front page)
    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
    $args = array(
        'post_type'     => 'ur-raedustol',
        'posts_per_page'    => -1,
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
        ?>
                <article class="post">
                    <h2 class="post-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h2>
                    <small class="post-meta"><?php the_date('j F Y , g:i a'); ?></small>
                    <p><?php echo get_the_excerpt(); ?>
                        <a href="<?php echo esc_url( get_permalink() ); ?>" title="">Lesa meira</a>
                        <!--nextpage-->
                    </p>
                </article>
        <?php endwhile; ?>                

            </div>

        </div>

    </div>

</div>

<?php get_footer(); ?>
