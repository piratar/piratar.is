<?php get_header(); ?>

<div class="efnid" id="readmore">
	<div class="wrapper">
		
		<div class="alpha full">
		<?php while ( have_posts() ) : the_post(); ?>
		
		<div class="splitter h20"></div>
            <h2 class="section-title"><?php echo the_title(); ?></h2>
            <div class="splitter h20"></div>
            <div class="hr hr-short hr-center avia-builder-el-11 el_after_av_textblock el_before_av_textblock "><span class="hr-inner "><span class="hr-inner-style"></span></span></div>
            
			
            <div class="splitter h20"></div>
		
		
		<?php //the_breadcrumb();  ?>
		<?php the_content(); ?>

		<?php endwhile; ?>
		</div>

		<div class="splitter h20"></div>
	</div>
    
</div>

<?php get_footer(); ?>