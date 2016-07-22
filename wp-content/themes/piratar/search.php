<?php get_header(); ?>
<div id="imagebanner" class="pagechange">
	<article>
		<figure style="background-image:url(http://piratar.gre.is/wp-content/uploads/2015/10/northernlights-web.jpg);">
			<img title="Mynd" alt="" src="http://piratar.gre.is/wp-content/uploads/2015/10/northernlights-web.jpg">
		</figure>
		<div class="intro">			
			<h3><span>Leitar niðurstöður fyrir :</span></h3>
			<h2 style="color:#51297e;"><?php echo get_search_query(); ?></h2>
		</div>
	</article>
</div>
<div class="efnid">
	<div class="wrapper">
		<div class="alpha full">
            <?php if ( have_posts() ) : ?>
                <?php while ( have_posts() ) : the_post(); ?>
               
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
      		<?php the_excerpt(); ?> 
                <?php endwhile; ?>
            <?php else : ?>
                <?php get_template_part( 'content', 'none' ); ?>
            <?php endif; ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>