<?php 
    /*
    Template Name: Frambjóðendalisti
    */

    get_header();
 ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h2 class="section-title">Frambjóðendur Pírata</h2>
        </div>
    </div>

    <div class="row">
        <?php
            $custom_query = new WP_Query("post_type=frambjodendur&posts_per_page=-1&orderby=name&order=ASC"); 
            while($custom_query->have_posts()) : $custom_query->the_post();
        ?>



        <?php get_template_part( 'each', 'candidate'); ?>

        <?php endwhile; ?>
    </div>
</div>

 <?php get_footer(); ?>
