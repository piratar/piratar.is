<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

<?php $cand_terms = wp_get_post_terms($post->ID, "kjordaemi"); ?>
<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>

<div class="section section-title section-candidate">

    <div class="section-overlay" style="background-image: url(<?php echo $image[0]; ?>);"></div>

    <div class="container-fluid">

        <div class="row">

        	<div class="col-sm-12">

        		<figure class="figure figure-round figure-small"><div class="figure-wrap"><?php the_post_thumbnail('candidate'); ?></div></figure>

	            <h2 class="the-title"><?php the_title(); ?></h2>

	            <p><?php echo $cand_terms[0]->name; ?></p>

        	</div>

        </div>

    </div>

</div>

<div class="section section-content">

    <div class="container-fluid">

        <div class="row">

        	<div class="col-sm-12 col-lg-9 push-lg-1">

	            <?php get_template_part( 'content', "frambjodandi" ); ?>           

        	</div>

        </div>

    </div>

</div>

<?php endwhile; ?>

<?php get_footer(); ?>