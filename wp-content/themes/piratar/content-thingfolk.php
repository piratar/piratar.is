<?php the_content(); ?>

<?php $loop = new WP_Query( array( 'post_type' => 'thingfolk', 'posts_per_page' => -1,'orderby'=>'menu_order','order'=>'ASC') ); ?>

<div class="splitter h20"></div>
<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

<div class="thingfolks_listi">
    <div class="narrow"><a href="<?php echo esc_url(get_permalink()); ?>"><?php the_post_thumbnail('thingfolk_thumb', array( 'class' => 'thingfolk_thumb_img')); ?></a></div>
    <div class="wide">
        <h3>
            <a href="<?php echo esc_url(get_permalink()); ?>" ><?php the_title(); ?></a>
        </h3>

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

