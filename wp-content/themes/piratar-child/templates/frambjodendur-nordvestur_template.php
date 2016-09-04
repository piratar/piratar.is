<?php 
    /*
    Template Name: Norðvestur
    */

    get_header();
 ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h2 class="section-title">Frambjóðendur Norðvesturkjördæmi</h2>
        </div>
    </div>

    <div class="row">
        <?php
            $custom_query = new WP_Query("kjordaemi=nordvesturkjordaemi&post_type=frambjodendur&posts_per_page=-1&orderby=rand&order=ASC"); 
            while($custom_query->have_posts()) : $custom_query->the_post();
            $taxonomies=get_taxonomies('','names');
            $terms = wp_get_post_terms($post->ID, $taxonomies,  array("fields" => "names"));
        ?>

        <?php get_template_part( 'each', 'candidate'); ?>

        <?php endwhile; ?>
    </div>
</div>

 <?php get_footer(); ?>
