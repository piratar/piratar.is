<?php get_header(); ?>

<div class="efnid" id="readmore">
	<div class="wrapper">
		
		<div class="alpha">
		<?php while ( have_posts() ) : the_post(); ?>

		 <h1><?php the_title(); ?></h1>

		<?php //the_breadcrumb();  ?>
		<?php the_content(); ?>
		<div class="splitter h20"></div>
		<?php the_field('log_pirata_aukarammi'); ?>
		<?php endwhile; ?>
		</div>

		<div class="splitter h20"></div>
	</div>
    
</div>

<?php get_footer(); ?>