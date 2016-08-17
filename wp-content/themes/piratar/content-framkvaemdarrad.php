<?php the_content(); ?>

<div class="yfir_rammi">
    <div class="wrapper">
        <h2 class="section-title">Framkvæmdaráð Pírata</h2>
            <div class="splitter h20"></div>

            <?php
                $custom_query = new WP_Query("post_type=framkvaemdaradin&posts_per_page=1&orderby=date"); 
                while($custom_query->have_posts()) : $custom_query->the_post(); 
            ?>

                <h3><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h3>
                <?php the_content(); ?>
                <h3><a href="/um-pirata/bokhald-og-rekstur/framkvaemdarad/framkvaemdarad-fyrri-ara/">> Framkvæmdaráð fyrri ára</a></h3>
            <?php endwhile; ?>
    </div>
</div>

<div class="yfir_rammi">
    <div class="wrapper">
        <h2 class="section-title">Fundargerðir</h2>
            <div class="splitter h20"></div>

            <?php
                $custom_query = new WP_Query("fundarflokkur=framkvaemdarad&post_type=fundargerdir&posts_per_page=10&orderby=date&order=DESC"); 
                while($custom_query->have_posts()) : $custom_query->the_post(); 
            ?>

                <h3><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h3>

            <?php endwhile; ?>
    </div>
</div>

