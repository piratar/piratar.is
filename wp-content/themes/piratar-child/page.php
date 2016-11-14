<?php get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>

<div class="section section-content">
	<div class="container-fluid">
		<div class="row">
			
			
			<div class="splitter h20"></div>
            <h2 class="section-title"><?php echo the_title(); ?></h2>
            <div class="splitter h20"></div>
            <div class="hr hr-short hr-center avia-builder-el-11 el_after_av_textblock el_before_av_textblock "><span class="hr-inner "><span class="hr-inner-style"></span></span></div>
            
			
            <div class="splitter h20"></div>
            <?php get_template_part( 'content', "page" ); ?>
		</div>
	</div>
</div>
<?php endwhile; ?>
<?php get_footer(); ?>
