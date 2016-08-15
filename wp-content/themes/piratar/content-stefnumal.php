<?php the_content(); ?>

<?php $loop = new WP_Query( array( 'post_type' => 'stefnumal', 'posts_per_page' => -1) ); ?>

<div>   
    <form role="search" action="<?php echo site_url('/'); ?>" method="get" id="searchform">
    <input type="text" name="s" placeholder="Leita að stefnumáli"/>
    <input type="hidden" name="post_type" value="stefnumal" /> <!-- // hidden 'products' value -->
    <input type="submit" alt="Search" value="Leita" />
  </form>
  <br>
 </div>

<table>
  <tr>
    <td class="">Heiti samþykktrar stefnu</td>
    <td class="">Já</td>
    <td class="">Nei</td>
    <td class="">Sitja hjá</td>
    <td class="">Dags samþ.</td>
  </tr>
  
<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

  <tr>
    <td class=""><a href="<?php echo esc_url(get_field( "stefnumal_linkur" )); ?>"><?php the_title();?></a></td>
    <td class=""><?php echo get_field( "votes_yes" ); ?></td>
    <td class=""><?php echo get_field( "votes_no" ); ?></td>
    <td class=""><?php echo get_field( "votes_draw" ); ?></td>
    <td class=""><?php echo get_field( "stefnumal_dagsetning" ); ?></td>
  </tr>

<?php endwhile; ?>

</table>