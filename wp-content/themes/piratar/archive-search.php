<?php
/* Template Name: Custom Search */
get_header(); ?>

<div class="efnid">
    <div class="wrapper">
        <div class="alpha full">
            <h3>Leitar niðurstöður fyrir : <?php echo "$s"; ?> </h3>   
            <a href="#" onclick="history.go(-1)">Til baka</a>
            <table>
                <tr>
                    <td class="">Heiti samþykktrar stefnu</td>
                    <td class="">Dags samþ.</td>
                </tr>
             <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>  
                <tr>
                    <td class=""><a href="<?php echo esc_url(get_field( "stefnumal_linkur" )); ?>"><?php the_title();?></a></td>
                    <td class=""><?php echo get_field( "stefnumal_dagsetning" ); ?></td>
                  </tr>
            <?php endwhile; ?>
            <?php endif; ?>
            </table>
        </div>
    </div>
</div>

<?php get_footer(); ?>
<?php echo $value = get_field( "stefnumal_linkur" ); ?>
