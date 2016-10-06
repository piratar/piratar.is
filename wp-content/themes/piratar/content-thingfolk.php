<?php the_content(); ?>

<?php $loop = new WP_Query( array( 'post_type' => 'thingfolk', 'posts_per_page' => -1,'orderby'=>'menu_order','order'=>'ASC') ); ?>

<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

    <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>

<div class="row">

    <div class="col-sm-2">

        <figure class="figure figure-round">
            <div class="figure-wrap"><a href="<?php echo esc_url(get_permalink()); ?>"><img src="<?php echo  $image[0]; ?>"></a></div>
        </figure>
    
    </div>

    <div class="col-sm-10">

        <h2><a href="<?php echo esc_url(get_permalink()); ?>" ><?php the_title(); ?></a></h2>

        <p>
            Netfang:
            <a href="mailto:<?php echo get_field( "thingfolk_email" ); ?>"><?php echo get_field( "thingfolk_email" ); ?></a>
            <br>
            Vefur:
            <a target="_blank" href="<?php echo esc_url(get_field( "thingfolk_vefur" )); ?>"><?php echo get_field( "thingfolk_vefur" ); ?></a>
        </p>

    </div>

</div>

<?php endwhile; ?>

