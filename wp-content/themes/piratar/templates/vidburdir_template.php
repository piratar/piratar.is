<?php 
    /*
	Template Name: Viðburðir
	*/
    get_header(); 
	
	// set the "paged" parameter (use 'page' if the query is on a static front page)
	$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
	
	$args = array(
        'post_type' 	=> 'vidburdir',
		'posts_per_page' 	=> -1,
		'paged'				=> $paged
    );
    $event_loop = new  WP_Query( $args );
	
	
	
	?>

 <div class="efnid">
	<div class="wrapper">
		<div class="splitter h20"></div>
			<h2 class="section-title"><?php echo the_title(); ?></h2>
			
				<div class="splitter h20"></div>
				<div class="hr hr-short hr-center avia-builder-el-11 el_after_av_textblock el_before_av_textblock "><span class="hr-inner "><span class="hr-inner-style"></span></span></div>
				<div class="splitter h20"></div>
				
		<?php 
   
            while($event_loop->have_posts()) : $event_loop->the_post(); 
			
            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );

        ?>
            <article class="blogarticle fyrsta">
			
                <figure style="background-image: url(<?php echo $image[0]; ?>);">
                    <a href="<?php the_permalink(); ?>"><img width="270" border="0" height="131" alt="" src="<?php echo $image[0]; ?>"></a>
                    <div class="date"><span><?php the_time('F'); ?></span><?php the_time('j'); ?></div>
                </figure>
				
                <div class="textinn">
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <span class=""><?php the_field('event_date'); ?> - Klukkan: <?php the_field('event_time'); ?></span>
                    <p><?php the_excerpt(); ?> </p>
                </div>
				<div class="nav-previous alignleft"><?php next_posts_link( 'Older posts' ); ?></div>
<div class="nav-next alignright"><?php previous_posts_link( 'Newer posts' ); ?></div>
            </article>
        <?php endwhile; ?>
		
		

        <div class="splitter"></div>
    </div>

</div>

<?php get_footer(); ?>