<?php 
get_header(); ?>

<div class="section section-title">

    <div class="section-overlay"></div>

    <div class="container-fluid">

        <div class="row">

            <div class="col-sm-12">

                <h1 class="the-title">Fréttir</h1>           

            </div>

        </div>

    </div>

</div>


<div class="section section-content">

    <div class="container-fluid">

        <div class="row">

            <div class="col-sm-12 col-lg-9 push-lg-1 post">

                <?php while ( have_posts() ) : the_post(); ?>

                 <article class="post">

                        <h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <div class="post-meta"><?php the_time('d.m.Y'); ?></div>

                        <?php the_excerpt(); ?>

                </article>                


                <?php endwhile; ?>

                <div class="nav-previous alignleft"><?php next_posts_link( 'Eldri fréttir' ); ?></div>
                <div class="nav-next alignright"><?php previous_posts_link( 'Nýrri fréttir' ); ?></div>

            </div>

        </div>

    </div>

</div>


<div class="section section-content section-bg-gray">

    <div class="container-fluid">

        <div class="row">

            <div class="col-sm-12">

                <h2 class="the-title">Flokkar</h2>

            </div>

        </div>

        <div class="row">

                <?php

                $args = array( 'parent' => 0 );
 
                $terms = get_terms( 'frettaflokkur', $args );
                if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
                    //echo '<ul class="row">';
                    foreach ( $terms as $term ) {
                        echo '<div class="col-sm-4"><a href="' . get_term_link($term) . '">' . $term->name . '</a></div>';
                    }
                    //echo '</ul>';
                }

                ?>



        </div>

    </div>

</div>


<?php get_footer(); ?>
