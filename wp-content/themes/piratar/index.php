<?php get_header(); ?>
<div id="imagebanner">
    <div id="videokilltheradiostar"></div>
    <article>
		<figure style="background-image:url(wp-content/themes/piratar/img/piratar-crop.jpg);">
			<img src="wp-content/themes/piratar/img/piratar-crop.jpg" alt="" title="Mynd" scale="0">
		</figure>
		<div class="intro"></div>
	</article>
</div>
<div id="boxin_kynning">
    <div class="wrapper">
        <div class="box"><h2>Styrktu Pírata!</h2></div>
        <div class="box"><h2>Viðburðadagatal</h2></div>
        <div class="box"><h2>Styrktu Pírata!</h2></div>
    </div>
</div>
<div id="boxin_kynning">
    <div class="wrapper">
        <div class='ord'><h2>Orðskýring</h2><h3>Gegnsæi</h3><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer imperdiet erat quis vulputate facilisis. Vestibulum at posuere nulla. Quisque pharetra tristique orci ac molestie. Proin mollis tortor ut laoreet placerat. Curabitur vitae ex a lorem sollicitudin congue. Vestibulum ullamcorper tellus vel scelerisque lobortis. Integer purus ligula, porttitor eget tincidunt vitae, maximus non arcu. Vestibulum euismod dolor suscipit vehicula accumsan. </p><p><a href="#" class="nanar">Nánar</a></div> <div class="splitter"></div>
    </div>
</div>
<div class="frettir">  
    <div class="wrapper">
    <h2 class="section-title">Fréttir</h2>
    <div class="splitter h20"></div>
		<?php 
            $i = 1;
            $custom_query = new WP_Query('cat=1&posts_per_page=5'); 
            while($custom_query->have_posts()) : $custom_query->the_post(); 
            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
            $class = "";
        
            if ($i == 1) { 
                $class = "fyrsta";
            } else if ($i > 3) {
                $class = "nedri";
            } 
        ?>
            <article class="blogarticle <?php echo $class; ?>">
                <figure style="background-image: url(<?php echo $image[0]; ?>);">
                    <a href="<?php the_permalink(); ?>"><img width="270" border="0" height="131" alt="" src="<?php echo $image[0]; ?>"></a>
                    <div class="date"><span><?php the_time('F'); ?></span><?php the_time('j'); ?></div>
                </figure>
                <div class="textinn">
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <p><?php the_excerpt(); ?> </p>
                </div>
            </article>
        <?php if ($i == 1) { ?><?php } ?>
        <?php 
            $i++;
            endwhile; 
        ?>
        <?php wp_reset_postdata(); // reset the query ?>
        <div class="splitter"></div>
    </div>

</div>


<?php get_footer(); ?>