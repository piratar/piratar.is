<?php get_header(); ?>

<div class="efnid">
	<div class="wrapper">
		<div class="alpha full">
			<?php while ( have_posts() ) : the_post(); ?>
            <h2 class="section-title">Flokksmeðlimur</h2>
			
            <div class="hr hr-short hr-center avia-builder-el-11 el_after_av_textblock el_before_av_textblock ">
			<span class="hr-inner ">
			<span class="hr-inner-style">
			</span></span>
			</div>

            <?php get_template_part( 'content', "flokksfolk" ); ?>
			<?php endwhile; ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>