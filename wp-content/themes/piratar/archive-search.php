<?php
/* Template Name: Custom Search */
get_header(); ?>

<div class="section section-card section-title">

    <div class="section-overlay"></div>

    <div class="container-fluid">

        <div class="row">

            <div class="col-sm-12">

                <h2 class="the-title">Leitarniðurstöður: <?php echo "$s"; ?></h2>

            </div>

        </div>

    </div>

</div>

<div class="section section-content">

    <div class="container-fluid">

        <div class="row">

            <div class="col-sm-12 col-lg-9 push-lg-1 post">

                <table>
                <tr>
                    <td class="">Heiti samþykktrar stefnu</td>
                    <td class="">Dags samþ.</td>
                </tr>
             <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>  
                <tr>
                    <td class=""><a href="<?php echo esc_url(get_field( "stefnumal_linkur" )); ?>"><?php the_title();?></a></td>
                    <td class=""><?php echo get_field( "stefnumal_dagsetning" ); ?></td>
                  </tr>
            <?php endwhile; ?>
            <?php endif; ?>
            </table>


            </div>

        </div>

    </div>

</div>


<?php get_footer(); ?>
