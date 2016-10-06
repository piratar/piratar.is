
<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>

	<figure class="figure figure-round figure-small figure-left">
            <div class="figure-wrap"><a href="<?php echo esc_url(get_permalink()); ?>"><img src="<?php echo  $image[0]; ?>"></a></div>
    </figure>

	<?php the_content(); ?>

    <h2>Þingferill</h2>
  
	<?php echo get_field( 'thingfolk_ferill' ); ?>

    <ul>
		<li><a target="_blank" href="<?php echo esc_url(get_field( 'thingfolk_thingstorf' )); ?>">Yfirlit yfir þingstörf viðkomandi</a></li>
    	<li><a target="_blank" href="<?php echo esc_url(get_field( 'thingfolk_vefur' )); ?>"><?php echo get_field( 'thingfolk_vefur' ); ?></a></li>
    	<li><a href="mailto:<?php echo get_field( 'thingfolk_email' ); ?>"><?php echo get_field( 'thingfolk_email' ); ?></a></li>
   </ul>
