<div class="section section-people">

    <div class="section-overlay">

        <div class="container-fluid">

            <div class="row">

                <div class="col-sm-12">

                    <h3>Suðvesturkjördæmi</h3>

                    <?php $kjord = new WP_Query('kjordaemi=sudvesturkjordaemi&posts_per_page=-1&order=ASC&orderby=menu_order'); ?>

                    <ul class="row">

                        <?php
                            $k = 1;
                            while($kjord->have_posts()) : $kjord->the_post();
                            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'candidate' );
                            $name = explode(" ", get_the_title()); $name = array_slice($name, 0, -1); $name = implode(" ", $name);
                            if ($image[0] == false) $image[0] =  get_template_directory_uri() . "/img/framb-default.png";
                            if (get_post_field("menu_order", $post->ID) != 0) {
                        ?>

                        <li class="col-xs-6 col-lg-4 person"><figure><div><img src="<?php echo $image[0]; ?>" alt="<?php echo $name; ?>"><div class="person-overlay"></div></div><span class="person-num"><?php echo $k; ?></span></figure><div class="person-wrap"><a href="<?php the_permalink(); ?>"><?php echo $name; ?></a></div></li>
                    
                        <?php $k++; } endwhile; wp_reset_query(); ?>

                    </ul>                      

                </div>

            </div>

            <div class="row">

                <div class="col-sm-12">

                    <h3>Reykjavíkurkjördæmi norður</h3>

                    <?php $kjord = new WP_Query('kjordaemi=reykjavikurkjordaemi-nordur&posts_per_page=-1&order=ASC&orderby=menu_order'); ?>

                    <ul class="row">

                        <?php
                            $k = 1;
                            while($kjord->have_posts()) : $kjord->the_post();
                            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'candidate' );
                            $name = explode(" ", get_the_title()); $name = array_slice($name, 0, -1); $name = implode(" ", $name);
                            if ($image[0] == false) $image[0] =  get_template_directory_uri() . "/img/framb-default.png";
                            if (get_post_field("menu_order", $post->ID) != 0) {
                        ?>

                        <li class="col-xs-6 col-lg-4 person"><figure><div><img src="<?php echo $image[0]; ?>" alt="<?php echo $name; ?>"><div class="person-overlay"></div></div><span class="person-num"><?php echo $k; ?></span></figure><div class="person-wrap"><a href="<?php the_permalink(); ?>"><?php echo $name; ?></a></div></li>
                    
                        <?php $k++; } endwhile; wp_reset_query(); ?>

                    </ul>

                </div>

            </div>

            <div class="row">

                <div class="col-sm-12">

                    <h3>Reykjavíkurkjördæmi suður</h3>

                    <?php $kjord = new WP_Query('kjordaemi=reykjavikurkjordaemi-sudur&posts_per_page=-1&order=ASC&orderby=menu_order'); ?>

                    <ul class="row">

                        <?php
                            $k = 1;
                            while($kjord->have_posts()) : $kjord->the_post();
                            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'candidate' );
                            $name = explode(" ", get_the_title()); $name = array_slice($name, 0, -1); $name = implode(" ", $name);
                            if ($image[0] == false) $image[0] =  get_template_directory_uri() . "/img/framb-default.png";
                            if (get_post_field("menu_order", $post->ID) != 0) {
                        ?>

                        <li class="col-xs-6 col-lg-4 person"><figure><div><img src="<?php echo $image[0]; ?>" alt="<?php echo $name; ?>"><div class="person-overlay"></div></div><span class="person-num"><?php echo $k; ?></span></figure><div class="person-wrap"><a href="<?php the_permalink(); ?>"><?php echo $name; ?></a></div></li>
                    
                        <?php $k++; } endwhile; wp_reset_query(); ?>

                    </ul>

                </div>

            </div>

            <div class="row">

                <div class="col-sm-12">

                    <h3>Suðurkjördæmi</h3>
                    
                    <?php $kjord = new WP_Query('kjordaemi=sudurkjordaemi&posts_per_page=-1&order=ASC&orderby=menu_order'); ?>

                    <ul class="row">

                        <?php
                            $k = 1;
                            while($kjord->have_posts()) : $kjord->the_post();
                            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'candidate' );
                            $name = explode(" ", get_the_title()); $name = array_slice($name, 0, -1); $name = implode(" ", $name);
                            if ($image[0] == false) $image[0] =  get_template_directory_uri() . "/img/framb-default.png";
                            if (get_post_field("menu_order", $post->ID) != 0) {
                        ?>

                        <li class="col-xs-6 col-lg-4 person"><figure><div><img src="<?php echo $image[0]; ?>" alt="<?php echo $name; ?>"><div class="person-overlay"></div></div><span class="person-num"><?php echo $k; ?></span></figure><div class="person-wrap"><a href="<?php the_permalink(); ?>"><?php echo $name; ?></a></div></li>
                    
                        <?php $k++; } endwhile; wp_reset_query(); ?>

                    </ul>

                </div>

            </div>

            <div class="row">

                <div class="col-sm-12">

                    <h3>Norðausturkjördæmi</h3>

                    <?php $kjord = new WP_Query('kjordaemi=nordausturkjordaemi&posts_per_page=-1&order=ASC&orderby=menu_order'); ?>

                    <ul class="row">

                        <?php
                            $k = 1;
                            while($kjord->have_posts()) : $kjord->the_post();
                            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'candidate' );
                            $name = explode(" ", get_the_title()); $name = array_slice($name, 0, -1); $name = implode(" ", $name);
                            if ($image[0] == false) $image[0] =  get_template_directory_uri() . "/img/framb-default.png";
                            if (get_post_field("menu_order", $post->ID) != 0) {
                        ?>

                        <li class="col-xs-6 col-lg-4 person"><figure><div><img src="<?php echo $image[0]; ?>" alt="<?php echo $name; ?>"><div class="person-overlay"></div></div><span class="person-num"><?php echo $k; ?></span></figure><div class="person-wrap"><a href="<?php the_permalink(); ?>"><?php echo $name; ?></a></div></li>
                    
                        <?php $k++; } endwhile; wp_reset_query(); ?>

                    </ul>

                </div>

            </div>

            <div class="row">

                <div class="col-sm-12">

                    <h3>Norðvesturkjördæmi</h3>

                    <?php $kjord = new WP_Query('kjordaemi=nordvesturkjordaemi&posts_per_page=-1&order=ASC&orderby=menu_order'); ?>

                    <ul class="row">

                        <?php
                            $k = 1;
                            while($kjord->have_posts()) : $kjord->the_post();
                            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'candidate' );
                            $name = explode(" ", get_the_title()); $name = array_slice($name, 0, -1); $name = implode(" ", $name);
                            if ($image[0] == false) $image[0] =  get_template_directory_uri() . "/img/framb-default.png";
                            if (get_post_field("menu_order", $post->ID) != 0) {
                        ?>

                        <li class="col-xs-6 col-lg-4 person"><figure><div><img src="<?php echo $image[0]; ?>" alt="<?php echo $name; ?>"><div class="person-overlay"></div></div><span class="person-num"><?php echo $k; ?></span></figure><div class="person-wrap"><a href="<?php the_permalink(); ?>"><?php echo $name; ?></a></div></li>
                    
                        <?php $k++; } endwhile; wp_reset_query(); ?>

                    </ul>

                </div>

            </div>

        </div>

    </div>

</div>