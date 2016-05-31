<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="UTF-8">
	<meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1">
    <meta http-equiv="cleartype" content="on">
<meta name="p:domain_verify" content="845dbe69683ef984602c7f8ef1a9b602"/>
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,700' rel='stylesheet' type='text/css'>

	<link href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/frame.css?v=2.0" rel="stylesheet">
	<link href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/menu.css?v=2.0" rel="stylesheet">
	<link href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/responsive.css" rel="stylesheet">

	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-instagram/0.2.2/jquery.instagram.min.js"></script>
    <?php if ( is_home() ) { ?>
    <script type="text/javascript" charset="utf-8" src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/jquery.tubular.1.0.js"></script> 
    <script type="text/javascript">
        $().ready(function() {
                //$('#videokilltheradiostar').tubular({videoId: 'DLXrKsZBJ-U'}); // where idOfYourVideo is the YouTube ID.
        });
    </script>
    <?php } else { ?>
    <?php } ?>
    
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>  
<header>
	<div id="subheader"></div>  
    <div class="wrapper" id="lilja">
        <div class="secondary">

                <?php
					wp_nav_menu( array(
						'theme_location' => 'secondary',
						'depth'          => 2,
					) );
				?>
        </div>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo"><?php bloginfo( 'name' ); ?></a>
		<div class="menubar">
			<div class="splitter"></div>
			<div class="searchbox">
				<form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s"  placeholder="Search..."/>
					<span><input type="submit" class="btn fa-input" value="go"></span>
				</form>
			</div>
            <div class="splitter"></div>
			<a href="#" class="searchicon">Search</a>
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
        <div id="svunta_menu-item-105" class="rammi">
            <div class="padding">
                <?php 
                $childpages = new WP_Query( array('post_type' => 'page', 'post_parent' => 18, 'posts_per_page' => 100, 'orderby' => 'menu_order')); 
	            while ( $childpages->have_posts() ) : $childpages->the_post(); ?>
	           <ul>
                   <?php 
                    $fela_sidu_ur_megamenu = get_field('fela_sidu_ur_megamenu');

                    if(!get_field('fela_sidu_ur_megamenu')) {
                                       ?> 
                   
                   <li><a href="<?php the_permalink(); ?>"><?php if(get_field('nickname')) { the_field('nickname'); } else { the_title(); } ?></a><div class="content"><?php the_field('sidulysing'); ?></div>

                        <?php $this_subpage=$post->ID; ?>

                        <?php 
                        //Loop through the sub-pages of the child pages next
                        $subpages = new WP_Query( array('post_type' => 'page', 'post_parent' => $this_subpage,'posts_per_page' => -1,'orderby' => 'menu_order'));
                        while ( $subpages->have_posts() ) : $subpages->the_post(); ?>
                            <ul class="children">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                <div class="content"><?php the_field('sidulysing'); ?></div>
                            </ul>
                        <?php endwhile; wp_reset_query(); ?>

                </li><!--.content -->
                      <?php } ?>
            </ul>		
            <?php endwhile; wp_reset_query(); ?>
                
            </div>
            <div class="info">
                <h2>Um Pírata</h2>
                <?php 
                    $id = 18;
                    $key = "upplysingar";
                    $meta = get_post_meta($id, $key, $single);
                    echo $meta[0];
                ?>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer imperdiet erat quis vulputate facilisis. </p> 
                <p>Vestibulum at posuere nulla. Quisque pharetra tristique orci ac molestie.</p> 
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>um-pirata" class="nanar">Nánar</a>
            </div>
        </div>
        <div id="svunta_menu-item-104" class="rammi">
            <div class="padding">
                <?php 
                $childpages = new WP_Query( array('post_type' => 'page', 'post_parent' => 16, 'posts_per_page' => 100, 'orderby' => 'menu_order')); 
	            while ( $childpages->have_posts() ) : $childpages->the_post(); ?>
	           <ul>
                   <?php 
                    $fela_sidu_ur_megamenu = get_field('fela_sidu_ur_megamenu');

                    if(!get_field('fela_sidu_ur_megamenu')) {
                                       ?> 
                   
                   <li><a href="<?php the_permalink(); ?>"><?php if(get_field('nickname')) { the_field('nickname'); } else { the_title(); } ?></a><div class="content"><?php the_field('sidulysing'); ?></div>

                        <?php $this_subpage=$post->ID; ?>

                        <?php 
                        //Loop through the sub-pages of the child pages next
                        $subpages = new WP_Query( array('post_type' => 'page', 'post_parent' => $this_subpage,'posts_per_page' => -1,'orderby' => 'menu_order'));
                        while ( $subpages->have_posts() ) : $subpages->the_post(); ?>
                            <ul class="children">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                <div class="content"><?php the_field('sidulysing'); ?></div>
                            </ul>
                        <?php endwhile; wp_reset_query(); ?>

                </li><!--.content -->
                      <?php } ?>
            </ul>		
            <?php endwhile; wp_reset_query(); ?>
                
            </div>
            <div class="info">
                <h2>Taka þátt</h2>
                <?php 
                    $id = 16;
                    $key = "Upplysingar";
                    $meta = get_post_meta($id, $key, $single);
                    echo $meta[0];
                ?>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer imperdiet erat quis vulputate facilisis. </p> 
                <p>Vestibulum at posuere nulla. Quisque pharetra tristique orci ac molestie.</p> 
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>taka-thatt" class="nanar">Nánar</a>
            </div>
        </div>
        <div id="svunta_menu-item-101" class="rammi">
            <div class="padding">
                <?php 
                $childpages = new WP_Query( array('post_type' => 'page', 'post_parent' => 14, 'posts_per_page' => 100, 'orderby' => 'menu_order')); 
	            while ( $childpages->have_posts() ) : $childpages->the_post(); ?>
	           <ul>
                   <?php 
                    $fela_sidu_ur_megamenu = get_field('fela_sidu_ur_megamenu');

                    if(!get_field('fela_sidu_ur_megamenu')) {
                                       ?> 
                   
                   <li><a href="<?php the_permalink(); ?>"><?php if(get_field('nickname')) { the_field('nickname'); } else { the_title(); } ?></a><div class="content"><?php the_field('sidulysing'); ?></div>

                        <?php $this_subpage=$post->ID; ?>

                        <?php 
                        //Loop through the sub-pages of the child pages next
                        $subpages = new WP_Query( array('post_type' => 'page', 'post_parent' => $this_subpage,'posts_per_page' => -1,'orderby' => 'menu_order'));
                        while ( $subpages->have_posts() ) : $subpages->the_post(); ?>
                            <ul class="children">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                <div class="content"><?php the_field('sidulysing'); ?></div>
                            </ul>
                        <?php endwhile; wp_reset_query(); ?>

                </li><!--.content -->
                      <?php } ?>
            </ul>		
            <?php endwhile; wp_reset_query(); ?>
                
            </div>
            <div class="info">
                <h2>Aðildarfélög</h2>
                <?php 
                    $id = 14;
                    $key = "Upplysingar";
                    $meta = get_post_meta($id, $key, $single);
                    echo $meta[0];
                ?>
                <p>Samkvæmt 10. kafla laga Pírata er heimilt að stofna aðildarfélög Pírata að uppfylltum ákveðnum skilyrðum.</p>
                <p>Aðildarfélögin eru annað hvort sérhæfð undirfélög Pírata eða svæðisbundin félög. Svæðisbundin félög sjá um málefni og framboð hvert á sínu starfssvæði.</p>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>adildarfelog" class="nanar">Nánar</a>
            </div>
        </div>
        <div id="svunta_menu-item-102" class="rammi">
            <div class="padding">
                <?php 
                $childpages = new WP_Query( array('post_type' => 'page', 'post_parent' => 11, 'posts_per_page' => 100, 'orderby' => 'menu_order')); 
	            while ( $childpages->have_posts() ) : $childpages->the_post(); ?>
	           <ul>
                   <?php 
                    $fela_sidu_ur_megamenu = get_field('fela_sidu_ur_megamenu');

                    if(!get_field('fela_sidu_ur_megamenu')) {
                                       ?> 
                   
                   <li><a href="<?php the_permalink(); ?>"><?php if(get_field('nickname')) { the_field('nickname'); } else { the_title(); } ?></a><div class="content"><?php the_field('sidulysing'); ?></div>

                        <?php $this_subpage=$post->ID; ?>

                        <?php 
                        //Loop through the sub-pages of the child pages next
                        $subpages = new WP_Query( array('post_type' => 'page', 'post_parent' => $this_subpage,'posts_per_page' => -1,'orderby' => 'menu_order'));
                        while ( $subpages->have_posts() ) : $subpages->the_post(); ?>
                            <ul class="children">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                <div class="content"><?php the_field('sidulysing'); ?></div>
                            </ul>
                        <?php endwhile; wp_reset_query(); ?>

                </li><!--.content -->
                      <?php } ?>
            </ul>		
            <?php endwhile; wp_reset_query(); ?>
                
            </div>
            <div class="info">
                <h2>Píratar á þingi</h2>
                <?php 
                    $id = 11;
                    $key = "upplysingar";
                    $meta = get_post_meta($id, $key, $single);
                    echo $meta[0];
                ?>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer imperdiet erat quis vulputate facilisis. </p> 
                <p>Vestibulum at posuere nulla. Quisque pharetra tristique orci ac molestie.</p> 
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>piratar-a-thingi/" class="nanar">Nánar</a>
            </div>
        </div>
        <div id="svunta_menu-item-103" class="rammi">
            <div class="padding">
                <?php 
                $childpages = new WP_Query( array('post_type' => 'page', 'post_parent' => 5, 'posts_per_page' => 100, 'orderby' => 'menu_order')); 
	            while ( $childpages->have_posts() ) : $childpages->the_post(); ?>
	           <ul>
                   <?php 
                    $fela_sidu_ur_megamenu = get_field('fela_sidu_ur_megamenu');

                    if(!get_field('fela_sidu_ur_megamenu')) {
                                       ?> 
                   
                   <li><a href="<?php the_permalink(); ?>"><?php if(get_field('nickname')) { the_field('nickname'); } else { the_title(); } ?></a><div class="content"><?php the_field('sidulysing'); ?></div>

                        <?php $this_subpage=$post->ID; ?>

                        <?php 
                        //Loop through the sub-pages of the child pages next
                        $subpages = new WP_Query( array('post_type' => 'page', 'post_parent' => $this_subpage,'posts_per_page' => -1,'orderby' => 'menu_order'));
                        while ( $subpages->have_posts() ) : $subpages->the_post(); ?>
                            <ul class="children">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                <div class="content"><?php the_field('sidulysing'); ?></div>
                            </ul>
                        <?php endwhile; wp_reset_query(); ?>

                </li><!--.content -->
                      <?php } ?>
            </ul>		
            <?php endwhile; wp_reset_query(); ?>
                
            </div>
            <div class="info">
                <h2>Stefna</h2>
                <?php 
                    $id = 5;
                    $key = "upplysingar";
                    $meta = get_post_meta($id, $key, $single);
                    echo $meta[0];
                ?>
                <p><strong>BEINT LÝÐRÆÐI: VIÐ VILJUM AÐ ÞÚ RÁÐIR</strong></p>
                <p>Píratar vilja að þú getir tekið þátt í ákvarðanatöku í málum sem þig varðar. Píratar vilja ekki að þú þurfir að framselja atkvæði þitt til fjögurra ára í einu. </p>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>stefna" class="nanar">Nánar</a>
            </div>
        </div>
        <div class="splitter"></div>
    </div>
</header>
<div class="mobileheader"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Saga Travel</a> <a id="my-hamburger" class="wpmm-button" href="#my-menu"></a></div>
<div class="mobilekarfa">
<div id="bokun-w1952_fb75c2b3_cfb7_42f9_83cd_f240be1d7621_mobile">Loading...</div><script type="text/javascript">
            var w1952_fb75c2b3_cfb7_42f9_83cd_f240be1d7621;
            (function(d, t) {
              var host = 'widgets.bokun.is';
              var frameUrl = 'https://' + host + '/widgets/1952?bookingChannelUUID=50023d82-f5db-478c-afd6-1d7a5a32f27b&amp;lang=EN&amp;ccy=ISK&amp;hash=w1952_fb75c2b3_cfb7_42f9_83cd_f240be1d7621_mobile';
              var s = d.createElement(t), options = {'host': host, 'frameUrl': frameUrl, 'widgetHash':'w1952_fb75c2b3_cfb7_42f9_83cd_f240be1d7621_mobile', 'autoResize':true,'height':'','width':'100%', 'minHeight': 0,'async':true, 'ssl':true, 'affiliateTrackingCode': '' };
              s.src = 'https://' + host + '/assets/javascripts/widgets/embedder.js';
              s.onload = s.onreadystatechange = function() {
                var rs = this.readyState; if (rs) if (rs != 'complete') if (rs != 'loaded') return;
                try { 
                  w1952_fb75c2b3_cfb7_42f9_83cd_f240be1d7621_mobile = new BokunWidgetEmbedder(); w1952_fb75c2b3_cfb7_42f9_83cd_f240be1d7621_mobile.initialize(options); w1952_fb75c2b3_cfb7_42f9_83cd_f240be1d7621_mobile.display();
                } catch (e) {}
              };
              var scr = d.getElementsByTagName(t)[0], par = scr.parentNode; par.insertBefore(s, scr);
            })(document, 'script');
            </script>    
</div>