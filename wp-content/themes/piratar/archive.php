<?php get_header(); ?>

<div id="imagebanner" class="archivechange">
    <article>
        <?php 
            //$size ="full";
            $queried_object = get_queried_object();
            $term_id = $queried_object->term_id;
            $taxonomy = $queried_object->taxonomy;
            $term = get_term( $term_id, $taxonomy );
            $subhead = get_field('sub_headline', $term);
            $image = s8_get_taxonomy_image_src($term, $size);

        if ($image['src']): ?>
            <figure style="background-image:url(<?php echo $image['src']; ?>);">
                <img title="Mynd" alt="" src="<?php echo $image['src']; ?>">
            </figure>
        <?php else : ?> 
            <figure style="background-image:url(https://piratar.is/wp-content/uploads/2015/10/northernlights-web.jpg);">
                <img title="Mynd" alt="" src="https://piratar.is/wp-content/uploads/2015/10/northernlights-web.jpg">
            </figure>
        <?php endif; ?> 
        <div class="wrapper">
            <div class="tourinfo">          
                <h1 class="tour-title"><?php echo single_tag_title( '', false ); ?></h1>
                <h3 class="tour-subheadline"><?php echo $subhead; ?></h3>
            </div>
        </div>
    </article>
</div>

<div class="efnid">
    <div class="wrapper">
        <div class="alpha full">
            <?php if ( in_category( 'blog' )) { ?>
            <div class="splitter h20"></div>
            <h2 class="section-title blog">Blog</h2>
            <div class="splitter h20"></div>
            <div class="hr hr-short hr-center avia-builder-el-11 el_after_av_textblock el_before_av_textblock "><span class="hr-inner "><span class="hr-inner-style"></span></span></div>

            <div class="splitter h20"></div>
            <?php } else { ?>

            <div ><?php echo category_description(); ?></div>
            <div class="splitter h20"></div>
            <div class="splitter h20"></div>
            <!--div class="hr hr-short hr-center avia-builder-el-11 el_after_av_textblock el_before_av_textblock "><span class="hr-inner "><span class="hr-inner-style"></span></span></div-->

            <div class="splitter h20"></div>
        <?php }  ?>
        <?php if ( have_posts() ) : ?>

            <?php while ( have_posts() ) : the_post(); ?>
                <?php
                    if ( in_category( 'blog' )) {
                        get_template_part( 'content', "blog" );
                    } elseif ( in_category( 'staff-member' )) {
                        get_template_part( 'content', "blog" );
                    } else {
                        get_template_part( 'content', get_post_format() );
                    }
                ?>
            <?php endwhile; ?>
            <div class="splitter h20"></div>
            <?php
            the_posts_pagination( array(
                'prev_text'          => __( 'Previous', 'piratar' ),
                'next_text'          => __( 'Next', 'piratar' ),
                'before_page_number' => '',
            ) );
            //piratar_the_posts_pagination();
            ?>
        <?php else: ?>
            <?php get_template_part( 'content', 'none' ); ?>
        <?php endif; ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>
