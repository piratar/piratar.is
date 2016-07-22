<?php the_content(); ?>

<div class="yfir_rammi">  
    <div class="wrapper">


				<?php
					$custom_query = new WP_Query("post_type=framkvaemdaradin&offset=1&orderby=date"); 
					
					while($custom_query->have_posts()) : $custom_query->the_post(); 
				?>

					<h3><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h3>
					<?php the_content(); ?>
				<?php endwhile; ?>
	</div>
</div>