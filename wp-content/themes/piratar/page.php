<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

<div class="section section-card section-title">

    <div class="container-fluid">

        <div class="row">

        	<div class="col-sm-12">

	            <h2 class="section-title"><?php echo the_title(); ?></h2>           

        	</div>

        </div>

    </div>

</div>

<div class="section section-content">

    <div class="container-fluid">

        <div class="row">

        	<div class="col-sm-9 push-sm-1">

	            <?php get_template_part( 'content', "page" ); ?>	            

        	</div>

        </div>

    </div>

</div>

<?php endwhile; ?>

<?php get_footer(); ?>
