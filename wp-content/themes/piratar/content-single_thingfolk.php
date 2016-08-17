<div class="thingfolk_text">

<?php the_post_thumbnail('medium', array( 'class' => 'thingfolk_thumb_img')); ?>

<?php the_content(); ?>

    <div class="splitter h20"></div>
    <h2 class="section-title">Þingferill</h2>
    <div class="splitter h20"></div>
    <div class="hr hr-short hr-center avia-builder-el-11 el_after_av_textblock el_before_av_textblock "><span class="hr-inner "><span class="hr-inner-style"></span></span></div>
    
<?php echo get_field( 'thingfolk_ferill' ); ?>
    <a target="_blank" href="<?php echo esc_url(get_field( 'thingfolk_thingstorf' )); ?>">Yfirlit yfir þingstörf viðkomandi</a>
    <br>
    <a target="_blank" href="<?php echo esc_url(get_field( 'thingfolk_vefur' )); ?>"><?php echo get_field( 'thingfolk_vefur' ); ?></a>
    <br>
    <a href="mailto:<?php echo get_field( 'thingfolk_email' ); ?>"><?php echo get_field( 'thingfolk_email' ); ?></a>
</div>
