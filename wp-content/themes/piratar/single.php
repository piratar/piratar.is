<?php get_header(); ?>
<?php 
        $field = get_field_object('from');
        $value = get_field('from');
        $label = $field['choices'][ $value ];
        $available = get_field('available');
        $merki = get_field('merki');
        $flag = get_field('flag');
        $duration = get_field('duration');
        $departures = get_field('departures');
        $departure_time = get_field('departure_time');
        $tour_info = get_field('tour_info');
        $reccomend_to_bring = get_field('reccomend_to_bring');
        $includednot_included = get_field('requirements');
        $accommodation = get_field('accommodation');
        $highlights = get_field('highlights');
        $attention = get_field('attention');
        $mymap = get_field('map');
        $activityId = get_field('activityId');
        $partner_service = get_field('partner_service');
        $pricefrom = get_field('pricefrom');

        if ($partner_service == true) {
           $partner_service_text = "Saga Travel Partner Service" ;
           $partner_service_class = "partnerservice";
        } else {
          $partner_service_text = "" ;
          $partner_service_class = "";
        }
    ?>
<div id="imagebanner">
    <?php
        foreach ($flag as &$value) {
            if ($value) {
                if ($value == "bestseller") { $nafnrib = "best seller"; } else {  $nafnrib = $value; }
            echo '<div class="ribbon ribbon-big ribbon-' . $value . '"><div class="banner"><div class="text">' . $nafnrib . '</div></div></div>';
            }
        }
    ?>
	<article>
		<?php if (has_post_thumbnail( $post->ID ) ): ?>
		<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'figure' ); ?>
			<figure style="background-image:url(<?php echo $image[0]; ?>);">
				<img title="Mynd" alt="" src="<?php echo $image[0]; ?>">
			</figure>
		<?php else : ?>	
			<figure style="background-image:url(https://piratar.is/wp-content/uploads/2015/10/northernlights-web.jpg);">
				<img title="Mynd" alt="" src="https://piratar.is/wp-content/uploads/2015/10/northernlights-web.jpg">
			</figure>
		<?php endif; ?>	
        <div class="coloroverlay"></div>
        <div class="wrapper">
            <div class="tourinfo">			
                <h3 class="tour-tourid <?php echo $partner_service_class; ?>"><?php echo get_field('tourid'); ?> <span><?php echo $partner_service_text; ?></span></h3>
                <h1 class="tour-title"><?php the_title(); ?></h1>
                <div class="readmoretakkar">
                    <?php if (!empty($activityId)) { ?>
			             <a href="#readmore">Read More</a><?php if (!empty($mymap)) { ?>, <a href="#wpgmza_map">See on map</a><?php } ?> or just <a href="#bokun-w757">book your trip now</a>
                    <?php } else { ?>
                        <a href="#readmore">Read More</a><?php if (!empty($mymap)) { ?> or <a href="#wpgmza_map">See on map</a><?php } ?>
                    <?php } ?>
                </div>
            </div>
        </div>
	</article>
    
	<div class="menuinblack">
		<div class="showtours_tabs">
            <div class="touricons">
            <?php
                foreach ($merki as &$value) {
                    echo "<div class='icon_".$value."'></div>";
                }
            ?></div>
            
            <?php if (!empty($activityId)) { ?>
			<!--div class="submit"><a href="#bokun-w757"><span>Book now!</span></a></div-->
            <?php } ?>
		</div>
	</div>
</div>
<div class="efnid" id="readmore">
	<div class="wrapper">

		<div class="alpha">
		<?php while ( have_posts() ) : the_post(); ?>
            <h2><?php echo get_field('short_description'); ?></h2>
			<!--h3 class="tour-transporation"><span>Transporation:</span> <?php echo get_field('transporation'); ?></h3>
			<h3 class="tour-operated"><span>Operated:</span> <?php echo get_field('operated'); ?></h3-->

			<?php the_content(); ?>
            <div id="TA_socialButtonBubbles933" class="TA_socialButtonBubbles">
<ul id="ADfbRjs" class="TA_links UrqVnkT">
<li id="X8mFIaQ915rc" class="f3YZrcUQS">
<a target="_blank" href="http://www.tripadvisor.com/Attraction_Review-g189954-d2226993-Reviews-Saga_Travel_Day_Tours-Akureyri_Northeast_Region.html"><img src="https://www.tripadvisor.com/img/cdsi/img2/branding/socialWidget/20x28_green-21693-2.png"/></a>
</li>
</ul>
</div>
<script src="https://www.tripadvisor.com/WidgetEmbed-socialButtonBubbles?amp;locationId=2226993&amp;color=green&amp;size=rect&amp;uniq=933&amp;lang=en_US&amp;display_version=2"></script>
		<?php endwhile; ?>
		</div>
		<div class="delta">
            <?php if (!empty($mymap)) { ?>
            <!--div class="seemap_btn"><a href="#wpgmza_map"><span>See map!</span></a></div-->
            <?php } ?>
            
            <?php if (!empty($pricefrom)) { ?>
			<h3 class="tour-operated" style="margin-bottom:2px;">Price from</h3>
			<?php echo str_replace("From ", "", $pricefrom); ?> ISK per person.<br/><br/>
			<?php } ?>
            <?php if (!empty($label)) { ?>
			<h3 class="tour-operated" style="margin-bottom:2px;">Departure from</h3>
			<?php echo str_replace("From ", "", $label); ?><br/><br/>
			<?php } ?>
            <?php if (!empty($tour_info)) { ?>
			<h3 class="tour-operated">Tour Info</h3>
			<?php echo $tour_info; ?>
			<?php } ?>
            <?php if (!empty($highlights)) { ?>
			<h3 class="tour-operated">Highlights</h3>
			<?php echo $highlights; ?>
			<?php } ?>
            
            <?php if (!empty($available)) { ?>
			<h3 class="tour-operated" style="margin-bottom:2px;">Available</h3>
			<?php echo $available; ?><br/><br/>
			<?php } ?>
            
            
            <?php if (!empty($departures)) { ?>
			<h3 class="tour-operated" style="margin-bottom:2px;">Operated</h3>
			<?php echo $departures; ?><br/><br/>
			<?php } ?> 
            <?php if (!empty($departure_time)) { ?>
			<h3 class="tour-operated" style="margin-bottom:2px;">Departure time</h3>
			<?php echo $departure_time; ?><br/><br/>
			<?php } ?> 
            
            <?php if (!empty($duration)) { ?>
			<h3 class="tour-operated" style="margin-bottom:2px;">Duration</h3>
			<?php echo $duration; ?><br/><br/>
			<?php } ?>
            
			<?php if (!empty($includednot_included)) { ?>
			<h3 class="tour-operated">Included</h3>
			<?php echo $includednot_included; ?>
			<?php } ?>
			<?php if (!empty($accommodation)) { ?>
			<h3 class="tour-operated">Accommodation</h3>
			<?php echo $accommodation; ?>
			<?php } ?>
            <?php if (!empty($attention)) { ?>
			<h3 class="tour-operated">Note</h3>
			<?php echo $attention; ?>
			<?php } ?>
            
            <?php if (!empty($reccomend_to_bring)) { ?>
			<h3 class="tour-operated">We recommend you bring</h3>
			<?php echo $reccomend_to_bring; ?>
			<?php } ?>
			<?php get_sidebar(); ?>
           
		</div>
        <?php
            if (strpos($post->post_content,'[gallery') !== false){

        ?>
       
            <div class="deltagamma"><!--h2><span>Image Gallery</span></h2-->
            <?php

            $image_list = '<ul id="myContent">';
            foreach( $galleries as $gallery ) {
                foreach( $gallery as $image ) {
                    $lengt = strlen($image)-12;
                    $endirinn = strlen($image)-4;
                    $image_list .= '<li><a href="'. substr($image,0,$lengt) . substr($image,$endirinn,4) .'" class="grouped_elements" rel="group1"><img src="'.$image.'"  class="galleryimg" /></a></li>';
                }
            }
            $image_list .= '</ul>';
            echo  $image_list;
            ?>
                </div>
            <?php 
                } else {

                } 
        ?>
		<div class="splitter h20"></div>
	</div>
    
</div>
<?php if (!empty($mymap)) { ?>
    <div class="map">
        <?php echo $mymap; ?>
        <div class="activatemap"></div>
        <div class="wrapper">
            <div class="maptexti">
                <h2><?php the_title(); ?></h2>
                <p>Click on the map to see tour locations</p>
            </div>
        </div>
    </div>
    <?php } ?>
<?php get_footer(); ?>