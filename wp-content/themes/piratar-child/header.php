<!DOCTYPE html>

<html <?php language_attributes(); ?> class="no-js">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,700' rel='stylesheet' type='text/css'>
    <link href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/piratar.min.css" rel="stylesheet">

    <title><?php is_front_page() ? bloginfo('description') : wp_title('', true, 'right'); ?> – <?php bloginfo('name'); ?></title>

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

<body <?php body_class("site-kosningar"); ?>>

<header>

    <a href="#content" class="sr-only sr-only-focusable">Skip to main content</a>

    <div class="wrapper" id="lilja">
 
        <?php switch_to_blog(1); ?>

        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo"><img src="<?php echo get_template_directory_uri(); ?>/img/logo-xp-white.svg" alt="<?php bloginfo( 'name' ); ?>"></a>

        <?php restore_current_blog(); ?>

        <div class="menubar">

            <div class="p-menu">
                <?php
                    
                    wp_nav_menu( array(
                        'theme_location' => 'primary',
                        'depth'          => 1,
                    ) );
                ?>
            </div>

        </div>

        <div id="mobile-button"><a href="#">Valmynd <i class="fa fa-bars" aria-hidden="true"></i><i class="fa fa-times" aria-hidden="true"></i></a></div>

    </div>

    <div class="submenu">
        <div id="svunta_menu-item-30" class="rammi">
            <div class="padding">

            </div>
        </div>
        <!-- Norðvestur-->
        <div id="svunta_menu-item-38328" class="rammi">
            <div class="padding">
                <?php 
                $childpages = new WP_Query( array('post_type' => 'page', 'post_parent' => 19, 'posts_per_page' => 100, 'orderby' => 'menu_order', 'order' => 'ASC')); 

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
                    </div></p>
                </li><!--.content -->
                      <?php } ?>
            </ul>
            <?php endwhile; wp_reset_query(); ?>
            </div>

        </div>
        <!-- Suður -->
        <div id="svunta_menu-item-38339" class="rammi">
            <div class="padding">
                <?php 
                $childpages = new WP_Query( array('post_type' => 'page', 'post_parent' => 22, 'posts_per_page' => 100, 'orderby' => 'menu_order', 'order' => 'ASC')); 

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
                    </p></div>
                </li><!--.content -->
                      <?php } ?>
            </ul>
            <?php endwhile; wp_reset_query(); ?>

            </div>

        </div>

        <!-- Capital -->
        <div id="svunta_menu-item-38340" class="rammi">
            <div class="padding">
                <?php 
                $childpages = new WP_Query( array('post_type' => 'page', 'post_parent' => 24, 'posts_per_page' => 100, 'orderby' => 'menu_order', 'order' => 'ASC')); 

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
                       <div class="content">
                           <p>
                               <?php 
                               //Loop through the sub-pages of the child pages next
                               $subpages = new WP_Query( array('post_type' => 'page', 'post_parent' => $this_subpage,'posts_per_page' => -1,'orderby' => 'menu_order', 'order' => 'ASC'));
                               while ( $subpages->have_posts() ) : $subpages->the_post(); ?>

                                    <!--<a href="<?php //the_permalink(); ?>"><?php //the_title(); ?></a>-->


                               <?php endwhile; wp_reset_query(); ?>
                            </p>
                       </div>
                   </li><!--.content -->
                   <?php } ?>
                </ul>
            <?php endwhile; wp_reset_query(); ?>

            </div>
        </div>
    </div>

</header>

<div class="content">