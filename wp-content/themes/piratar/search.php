<?php 
get_header(); ?>

<div class="section section-title">

    <div class="section-overlay"></div>

    <div class="container-fluid">

        <div class="row">

            <div class="col-sm-12">

                <h1 class="the-title">Leitarniðurstöður</h1>           

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

                 <nav class="prev-next-posts">
                    <div class="prev-posts-link">
                      <?php echo get_next_posts_link( 'Eldri færslur' ); // display older posts link ?>
                    </div>
                    <div class="next-posts-link">
                      <?php echo get_previous_posts_link( 'Nýrri færslur' ); // display newer posts link ?>
                    </div>
                  </nav>

            </div>

        </div>

    </div>

</div>


<?php get_footer(); ?>
