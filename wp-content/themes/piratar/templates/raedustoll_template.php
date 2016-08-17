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

<div class="efnid">
    <div class="wrapper">
        <div class="alpha full">
            <div class="splitter h20"></div>
            <h2 class="section-title"><?php echo the_title(); ?></h2>
                <div class="splitter h20"></div>
                <div class="hr hr-short hr-center avia-builder-el-11 el_after_av_textblock el_before_av_textblock "><span class="hr-inner "><span class="hr-inner-style"></span></span></div>
                <div class="splitter h20"></div>
        <?php
            while($frettir_loop->have_posts()) : $frettir_loop->the_post(); 
        ?>
                <div class="thingmal_rss_feed">
                    <h3>
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h3>
                    <small><?php the_date('j F Y , g:i a'); ?></small>
                    <p><?php echo get_the_excerpt(); ?>
                        <a href="<?php echo esc_url( get_permalink() ); ?>" title="">Lesa meira</a>
                        <!--nextpage-->
                    </p>
                </div>
        <?php endwhile; ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>
