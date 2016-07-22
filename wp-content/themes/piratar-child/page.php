<?php get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
<div id="imagebanner2" class="">
	<article class="">
		<?php if (has_post_thumbnail( $post->ID ) ): ?>
		<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'figure' ); ?>
			<figure class="" style="background-image:url(<?php echo $image[0]; ?>);background-color:white;background-size:contain;">

			</figure>

		<?php endif; ?>	
        <div class="coloroverlay"></div>
        <div class="wrapper">
            <div class="tourinfo">			
                <h1 class="adildartitle"><?php the_title(); ?></h1>
                <div class="readmoretakkar">
					<!-- Þurfum við þennan takka? (AVJ) --> 
					<span class="title_time"><?php the_field('news_date'); ?></span>
                </div>
            </div>
        </div>
	</article>
</div>
<div class="efnid">
	<div class="wrapper">
		<div class="alpha full">
			
			
			<div class="splitter h20"></div>
            <h2 class="section-title"><?php echo the_title(); ?></h2>
            <div class="splitter h20"></div>
            <div class="hr hr-short hr-center avia-builder-el-11 el_after_av_textblock el_before_av_textblock "><span class="hr-inner "><span class="hr-inner-style"></span></span></div>
            
			
            <div class="splitter h20"></div>
            <?php get_template_part( 'content', "page" ); ?>
			<?php endwhile; ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>