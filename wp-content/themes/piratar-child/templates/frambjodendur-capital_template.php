<?php 
    /*
	Template Name: Capital Prófkjör
	*/
	
	get_header();
 ?>
 
<div class="efnid">  
    <div class="wrapper2">
		<h2 class="section-title">Frambjóðendur í Höfuðborgarkjördæmi</h2>
			<div class="splitter h20"></div>
				<div class="hr hr-short hr-center avia-builder-el-11 el_after_av_textblock el_before_av_textblock "><span class="hr-inner "><span class="hr-inner-style"></span></span></div>

				<?php
					$custom_query = new WP_Query("kjordaemi=hofudborgarkjordaemi&post_type=frambjodendur&posts_per_page=-1&orderby=rand&order=ASC"); 
					
					while($custom_query->have_posts()) : $custom_query->the_post(); 
					$taxonomies=get_taxonomies('','names');
						$terms = wp_get_post_terms($post->ID, $taxonomies,  array("fields" => "names"));
				?>

					<div id="<?php echo $fid ?>" class="frambj_listi">
						<div class="narrow2">
							<a href="<?php echo esc_url(get_permalink()); ?>"><?php if(the_post_thumbnail('thingfolk_thumb', array( 'class' => 'frambj_thumb_img'))) ?></a>
						</div>
						
						<div class="wide2">
							<h3>
								<a href="<?php echo esc_url(get_permalink()); ?>" ><?php the_title(); ?></a>
							</h3>

							<p style="padding:5px;">
								<?php echo excerpt(90); ?>
							</p>
							<h4><a href="<?php the_permalink(); ?>">Kynning á frambjóðenda</a></h4>
							<?php
								$x_hlekkur = get_field( "kosnignarvefur" );

								if ($x_hlekkur) {
									echo '<h4><a href="'. $x_hlekkur .'">Upplýsingar um frambjóðanda á kosningavef Pírata</a></h4>';
								}	
								
							?>
						</div>
					</div>

				<?php endwhile; ?>
	</div>
</div>

 <?php get_footer(); ?>