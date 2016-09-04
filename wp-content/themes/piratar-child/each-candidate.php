<div class="col-xs-12 col-md-6 col-lg-4 h500" id="<?php echo $fid ?>" >
    <div class="allborder">
        <div class="row">
            <div class="col-md-4">
                <a href="<?php echo esc_url(get_permalink()); ?>"><?php if(the_post_thumbnail('thingfolk_thumb', array( 'class' => 'img-responsive'))) ?></a>
            </div>
            <div class="col-md-8">
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
    </div>
</div>


