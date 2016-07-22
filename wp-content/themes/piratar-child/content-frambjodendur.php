<?php $loop = new WP_Query( array( 'post_type' => 'frambjodendur', 'posts_per_page' => -1,'orderby'=>'menu_order','order'=>'ASC') ); ?>
<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

<div class="thingfolks_listi">
	<div class="narrow">
		<a href="<?php echo esc_url(get_permalink()); ?>"><?php the_post_thumbnail('thingfolk_thumb', array( 'class' => 'thingfolk_thumb_img')); ?></a>
	</div>
	
<div class="wide">
	<h3>
		<a href="<?php echo esc_url(get_permalink()); ?>" ><?php the_title(); ?></a>
	</h3>
	<p>
	<?php echo get_the_excerpt(); ?>	
	<a href="<?php echo esc_url( get_permalink() ); ?>" title="">Lesa meira</a>
	</p>
</div>
</div>
<?php endwhile; ?>

