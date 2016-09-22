<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="UTF-8">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1">
    <meta http-equiv="cleartype" content="on">
    <meta name="p:domain_verify" content="845dbe69683ef984602c7f8ef1a9b602"/>
    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,700' rel='stylesheet' type='text/css'>
    <link href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/piratar.min.css" rel="stylesheet">

    <title> <?php wp_title('', true,''); ?> </title>

    <script type="text/javascript">

        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-40280156-1']);
        _gaq.push(['_trackPageview']);

        (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();

    </script>

    <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>  

<header>

    <div id="grunge"><span></span><span></span><span></span><span></span><span></span><span></span></div>

    <div class="wrapper" id="lilja">

         <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo"><img src="<?php echo get_template_directory_uri(); ?>/img/logo.svg" alt="<?php bloginfo( 'name' ); ?>"></a>

        <div class="menubar">

            <div class="searchbox">
                <form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s"  placeholder="Leita..."/>
                    <span><input type="submit" class="btn fa-input" value="go"></span>
                </form>
            </div>

            <a href="#" class="searchicon">Leita</a>
            
            <menu>
                <?php
                    wp_nav_menu( array(
                        'theme_location' => 'primary',
                        'depth'          => 1,
                    ) );
                ?>
            </menu>
            
        </div>

    </div>

    <div class="submenu">
        <!-- UM PÍRATA -->
        <div id="svunta_menu-item-37244" class="rammi">
            <div class="padding">
                <?php 
                $childpages = new WP_Query( array('post_type' => 'page', 'post_parent' => 152, 'posts_per_page' => 100, 'orderby' => 'menu_order', 'order' => 'ASC')); 
                while ( $childpages->have_posts() ) : $childpages->the_post(); ?>
               <ul>
                   <?php 
                    $fela_sidu_ur_megamenu = get_field('fela_sidu_ur_megamenu');

                    if(!get_field('fela_sidu_ur_megamenu')) {
                                       ?> 
                   <li>
                   <a href="<?php the_permalink(); ?>"><?php if(get_field('nickname')) { the_field('nickname'); } else { the_title(); } ?></a>
                   <div class="content nav_inline_fix"><?php the_field('sidulysing'); ?></div>

                        <?php $this_subpage=$post->ID; ?>
                        <div class="content"><p>
                        <?php 
                        //Loop through the sub-pages of the child pages next
                        $subpages = new WP_Query( array('post_type' => 'page', 'post_parent' => $this_subpage,'posts_per_page' => -1,'orderby' => 'menu_order', 'order' => 'ASC'));
                        while ( $subpages->have_posts() ) : $subpages->the_post(); ?>

                             <!--<a href="<?php //the_permalink(); ?>"><?php //the_title(); ?></a>-->


                        <?php endwhile; wp_reset_query(); ?>
                    </div>
                </li><!--.content -->
                      <?php } ?>
            </ul>
            <?php if (($childpages->current_post+1) % 3 == 0) {
                ?>
            </div><div class="padding">
            <?php } ?>
            <?php endwhile; wp_reset_query(); ?>
            </div>

        </div>

        <!-- UM PÍRATA -->
        <div id="svunta_menu-item-105" class="rammi">
            <div class="padding">
                <?php 
                $childpages = new WP_Query( array('post_type' => 'page', 'post_parent' => 18, 'posts_per_page' => 100, 'orderby' => 'menu_order', 'order' => 'ASC')); 
                while ( $childpages->have_posts() ) : $childpages->the_post(); ?>
               <ul>
                   <?php 
                    $fela_sidu_ur_megamenu = get_field('fela_sidu_ur_megamenu');

                    if(!get_field('fela_sidu_ur_megamenu')) {
                                       ?> 
                   <li>
                   <a href="<?php the_permalink(); ?>"><?php if(get_field('nickname')) { the_field('nickname'); } else { the_title(); } ?></a>
                   <div class="content nav_inline_fix"><?php the_field('sidulysing'); ?></div>

                        <?php $this_subpage=$post->ID; ?>
                        <div class="content"><p>
                        <?php 
                        //Loop through the sub-pages of the child pages next
                        $subpages = new WP_Query( array('post_type' => 'page', 'post_parent' => $this_subpage,'posts_per_page' => -1,'orderby' => 'menu_order', 'order' => 'ASC'));
                        while ( $subpages->have_posts() ) : $subpages->the_post(); ?>

                             <!--<a href="<?php //the_permalink(); ?>"><?php //the_title(); ?></a>-->


                        <?php endwhile; wp_reset_query(); ?>
                    </div>
                </li><!--.content -->
                      <?php } ?>
            </ul>
            <?php if (($childpages->current_post+1) % 3 == 0) {
                ?>
            </div><div class="padding">
            <?php } ?>
            <?php endwhile; wp_reset_query(); ?>
            </div>

        </div>
        <!-- TAKA ÞÁTT -->
        <div id="svunta_menu-item-104" class="rammi">
            <div class="padding">
                <?php 
                $childpages = new WP_Query( array('post_type' => 'page', 'post_parent' => 16, 'posts_per_page' => 100, 'orderby' => 'menu_order', 'order' => 'ASC')); 
                while ( $childpages->have_posts() ) : $childpages->the_post(); ?>
               <ul>
                   <?php 
                    $fela_sidu_ur_megamenu = get_field('fela_sidu_ur_megamenu');

                    if(!get_field('fela_sidu_ur_megamenu')) {
                                       ?> 
                   <li><a href="<?php the_permalink(); ?>"><?php if(get_field('nickname')) { the_field('nickname'); } else { the_title(); } ?></a>
                   <div class="content nav_inline_fix"><?php the_field('sidulysing'); ?></div>

                        <?php $this_subpage=$post->ID; ?>

                        <?php 
                        //Loop through the sub-pages of the child pages next
                        $subpages = new WP_Query( array('post_type' => 'page', 'post_parent' => $this_subpage,'posts_per_page' => -1,'orderby' => 'menu_order', 'order' => 'ASC'));
                        while ( $subpages->have_posts() ) : $subpages->the_post(); ?>
                            <div class="children">
                               
                                <div class="content"><?php the_field('sidulysing'); ?></div>
                            </div>
                        <?php endwhile; wp_reset_query(); ?>

                </li><!--.content -->
                      <?php } ?>
            </ul>
            <?php if (($childpages->current_post+1) % 3 == 0) {
                ?>
            </div><div class="padding">
            <?php } ?>
            <?php endwhile; wp_reset_query(); ?>
            </div>

        </div>
        <!-- AÐILDARFÉLÖG -->
        <div id="svunta_menu-item-101" class="rammi">
            <div class="padding">
                <?php 
                $childpages = new WP_Query( array('post_type' => 'page', 'post_parent' => 14, 'posts_per_page' => 100, 'orderby' => 'menu_order', 'order' => 'ASC')); 
                while ( $childpages->have_posts() ) : $childpages->the_post(); ?>
               <ul>
                   <?php 
                    $fela_sidu_ur_megamenu = get_field('fela_sidu_ur_megamenu');

                    if(!get_field('fela_sidu_ur_megamenu')) {
                                       ?> 
                   <li>
                   <a href="<?php the_permalink(); ?>"><?php if(get_field('nickname')) { the_field('nickname'); } else { the_title(); } ?></a>
                   <div class="content nav_inline_fix"><?php the_field('sidulysing'); ?></div>

                        <?php $this_subpage=$post->ID; ?>

                        <?php 
                        //Loop through the sub-pages of the child pages next
                        $subpages = new WP_Query( array('post_type' => 'page', 'post_parent' => $this_subpage,'posts_per_page' => -1,'orderby' => 'menu_order', 'order' => 'ASC'));
                        while ( $subpages->have_posts() ) : $subpages->the_post(); ?>
                            <div class="children">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                <div class="content"><?php the_field('sidulysing'); ?></div>
                            </div>
                        <?php endwhile; wp_reset_query(); ?>

                </li><!--.content -->
                      <?php } ?>
            </ul>
            <?php if (($childpages->current_post+1) % 3 == 0) {
                ?>
            </div><div class="padding">
            <?php } ?>
            <?php endwhile; wp_reset_query(); ?>
            </div>

        </div>
        <!-- PÍRATAR Á ÞINGI -->
        <div id="svunta_menu-item-102" class="rammi">
            <div class="padding">
                <?php 
                $childpages = new WP_Query( array('post_type' => 'page', 'post_parent' => 11, 'posts_per_page' => 100, 'orderby' => 'menu_order', 'order' => 'ASC'));
                while ( $childpages->have_posts() ) : $childpages->the_post(); 
                ?>
                
               <ul>
                   <?php 
                    $fela_sidu_ur_megamenu = get_field('fela_sidu_ur_megamenu');

                    if(!get_field('fela_sidu_ur_megamenu')) {
                                       ?> 
                   <li><a href="<?php the_permalink(); ?>"><?php if(get_field('nickname')) { the_field('nickname'); } else { the_title(); } ?></a>
                   <div class="content nav_inline_fix"><?php the_field('sidulysing'); ?></div>

                        <?php $this_subpage=$post->ID; ?>

                        <?php 
                        //Loop through the sub-pages of the child pages next
                        $subpages = new WP_Query( array('post_type' => 'page', 'post_parent' => $this_subpage,'posts_per_page' => -1,'orderby' => 'menu_order', 'order' => 'ASC'));
                        while ( $subpages->have_posts() ) : $subpages->the_post(); ?>
                            <div class="children">
                                <!--<a href="<?php //the_permalink(); ?>"><?php //the_title(); ?></a>-->
                                <div class="content"><?php the_field('sidulysing'); ?></div>
                            </div>
                        <?php endwhile; wp_reset_query(); ?>

                </li><!--.content -->
                      <?php } ?>
            </ul>
            <?php if (($childpages->current_post+1) % 3 == 0) {
                ?>
            </div><div class="padding">
            <?php } ?>
            <?php endwhile; wp_reset_query(); ?>
            </div>

        </div>
        <!-- STEFNA -->
        <div id="svunta_menu-item-103" class="rammi">
            <div class="padding">
                <?php 
                $childpages = new WP_Query( array('post_type' => 'page', 'post_parent' => 5, 'posts_per_page' => 100, 'orderby' => 'menu_order', 'order' => 'ASC')); 
                while ( $childpages->have_posts() ) : $childpages->the_post(); ?>
               <ul>
                   <?php 
                    $fela_sidu_ur_megamenu = get_field('fela_sidu_ur_megamenu');

                    if(!get_field('fela_sidu_ur_megamenu')) {
                                       ?> 
                   <li><a href="<?php the_permalink(); ?>"><?php if(get_field('nickname')) { the_field('nickname'); } else { the_title(); } ?></a>
                   <div class="content nav_inline_fix"><?php the_field('sidulysing'); ?></div>

                        <?php $this_subpage=$post->ID; ?>

                        <?php 
                        //Loop through the sub-pages of the child pages next
                        $subpages = new WP_Query( array('post_type' => 'page', 'post_parent' => $this_subpage,'posts_per_page' => -1,'orderby' => 'menu_order', 'order' => 'ASC'));
                        while ( $subpages->have_posts() ) : $subpages->the_post(); ?>
                            <ul class="children">
                                <!--<a href="<?php //the_permalink(); ?>"><?php //the_title(); ?></a>-->
                                <div class="content"><?php the_field('sidulysing'); ?></div>
                            </ul>
                        <?php endwhile; wp_reset_query(); ?>

                </li><!--.content -->
                      <?php } ?>
            </ul>
            <?php if (($childpages->current_post+1) % 3 == 0) {
                ?>
            </div><div class="padding">
            <?php } ?>
            <?php endwhile; wp_reset_query(); ?>
            </div>
            <!-- Ég eyddi öllu nema þessum til að stytta kóðann --> 
            <!-- 
            <div class="info">
                <h2>Stefna</h2>
                <?php 
                    /*$id = 5;
                    $key = "upplysingar";
                    $meta = get_post_meta($id, $key, $single);
                    echo $meta[0];*/
                ?>
                <p><strong>BEINT LÝÐRÆÐI: VIÐ VILJUM AÐ ÞÚ RÁÐIR</strong></p>
                <p>Píratar vilja að þú getir tekið þátt í ákvarðanatöku í málum sem þig varðar. Píratar vilja ekki að þú þurfir að framselja atkvæði þitt til fjögurra ára í einu. </p>
                <a href="<?php //echo esc_url( home_url( '/' ) ); ?>stefna" class="nanar">Nánar</a>
            </div>
        </div> -->
        <div class="splitter"></div>
    </div>
</div>
</header>


