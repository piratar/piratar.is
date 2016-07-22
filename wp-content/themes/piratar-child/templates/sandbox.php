<?php 
    /*
	Template Name: Sandbox
	*/
	
	get_header();
 ?>
 
<div class="efnid">  
    <div class="wrapper">
		<h2 class="section-title">Frambjóðendur Suðurkjördæmi</h2>
			<div class="splitter h20"></div>
				<div class="hr hr-short hr-center avia-builder-el-11 el_after_av_textblock el_before_av_textblock "><span class="hr-inner "><span class="hr-inner-style"></span></span></div>

				<?php
					$custom_query = new WP_Query("kjordaemi=hofudborgarkjordaemi&post_type=frambjodendur&posts_per_page=-1&orderby=name&order=ASC"); 
					
					while($custom_query->have_posts()) : $custom_query->the_post(); 
						$taxonomies=get_taxonomies('','names');
						$terms = wp_get_post_terms($post->ID, $taxonomies,  array("fields" => "names"));
		
				?>

					<div class="thingfolks_listi">
						<div class="narrow"><a href="<?php echo esc_url(get_permalink()); ?>"><?php the_post_thumbnail('thingfolk_thumb', array( 'class' => 'thingfolk_thumb_img')); ?></a></div>
						
						<div class="wide">
							<h3>
								<a href="<?php echo esc_url(get_permalink()); ?>" ><?php the_title(); ?></a>
							</h3>

							<p>
								<?php echo excerpt(80); ?>
								<p>Býður sig fram í: 
																	<?php 
																		$arrlength = count($terms);
																		for($x = 0; $x < $arrlength; $x++) {
																		echo $string = $terms[$x] . ' ';

																		}

																	?>
																</p>
								<h4><a href="<?php the_permalink(); ?>">Lesa meira</a></h4>
							</p>
						</div>
					</div>

				<?php endwhile; ?>
	</div>
</div>
 
 <?php get_footer(); ?>