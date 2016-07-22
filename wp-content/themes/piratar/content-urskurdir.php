<?php the_content(); ?>



<?php $loop = new WP_Query( array( 'post_type' => 'urskurdarnefnd', 'posts_per_page' => -1) ); ?>

<div>   
    <form role="search" action="<?php echo site_url('/'); ?>" method="get" id="searchform">
    <input type="text" name="s" placeholder="Leita af stefnumáli"/>
    <input type="hidden" name="post_type" value="stefnumal" /> <!-- // hidden 'products' value -->
    <input type="submit" alt="Search" value="Leita" />
  </form>
  <br>
 </div>

<table>
  <tr>
    <td class="">Úrskurðir</td>
    <td class="">Málsnúmer</td>
    <td class="">Málsár</td>
    <td class="">Dagsetning</td>
  </tr>
  
<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
<?php
		$malsar = get_the_terms( $post->ID , 'urskurdarnefnd_malsnumer' );
		$malsnumerstring = $malsar[0]->slug;
		$malsnumer = get_the_terms( $post->ID , 'urskurdarnefnd_mals_ar' );
		$malsarstring = $malsnumer[0]->slug;
	?>
  <tr>
    <td class=""><a href="<?php echo the_permalink(); ?>"><?php the_title();?></a></td>
    <td class=""><?php echo $malsnumerstring; ?></td>
    <td class=""><?php echo $malsarstring; ?></td>
    <td class=""><?php the_date(); ?></td>

  </tr>

<?php endwhile; ?>

</table>