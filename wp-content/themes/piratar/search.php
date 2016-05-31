<?php get_header(); ?>
<div id="imagebanner" class="pagechange">
	<article>
		<figure style="background-image:url(http://piratar.gre.is/wp-content/uploads/2015/10/northernlights-web.jpg);">
			<img title="Mynd" alt="" src="http://piratar.gre.is/wp-content/uploads/2015/10/northernlights-web.jpg">
		</figure>
		<div class="intro">			
			<h3><span>Search Results for</span></h3>
			<h2><?php echo get_search_query(); ?></h2>
		</div>
	</article>
</div>
<div class="efnid">
	<div class="wrapper">
		<div class="alpha full">
            <?php if ( have_posts() ) : ?>
                <?php while ( have_posts() ) : the_post(); ?>
                
                <?php get_template_part( 'content', get_post_format() ); ?>
                <?php endwhile; ?>
            <?php else : ?>
                <?php get_template_part( 'content', 'none' ); ?>
            <?php endif; ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>