<?php get_header(); ?>
<div class="efnid">  
    <div class="wrapper2">
		<h2 class="section-title">Leitar niðurstöður fyrir : <i><?php echo get_search_query(); ?></i></h2>
			<div class="splitter h20"></div>
				<div class="hr hr-short hr-center avia-builder-el-11 el_after_av_textblock el_before_av_textblock "><span class="hr-inner "><span class="hr-inner-style"></span></span></div>
				<?php echo do_shortcode( '[searchandfilter post_types="frambjodendur" fields="search"]' ); ?>
				
            <?php if ( have_posts() ) : ?>
                <?php while ( have_posts() ) : the_post(); ?>
               
                <div class="frambj_listi">
						<div class="narrow2">
							<a href="<?php echo esc_url(get_permalink()); ?>"><?php if(the_post_thumbnail('thingfolk_thumb', array( 'class' => 'frambj_thumb_img'))) ?></a>
						</div>
						
						<div class="wide2">
							<h3>
								<a href="<?php echo esc_url(get_permalink()); ?>" ><?php the_title(); ?></a>
							</h3>

							<p>
								<?php echo excerpt(150); ?>
								<p>Býður sig fram í: 
																	<?php 
																	$taxonomies=get_taxonomies('','names');
																	$terms = wp_get_post_terms($post->ID, $taxonomies,  array("fields" => "names"));
																		$arrlength = count($terms);
																		for($x = 0; $x < $arrlength; $x++) {
																		echo $string = $terms[$x] . ' <br>';

																		}

																	?>
																</p>
								<h4><a href="<?php the_permalink(); ?>">Lesa meira</a></h4>
							</p>
						</div>
					</div>
                <?php endwhile; ?>
            <?php else : ?>
                <?php get_template_part( 'content', 'none' ); ?>
            <?php endif; ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>