

<div class="efnid">
	<div class="wrapper">
		<div class="alpha full">

            <div class="splitter h20"></div>
            <h2 class="section-title"><?php echo the_title(); ?></h2>
            <div class="splitter h20"></div>
            <div class="hr hr-short hr-center avia-builder-el-11 el_after_av_textblock el_before_av_textblock "><span class="hr-inner "><span class="hr-inner-style"></span></span></div>
            

            <div class="splitter h20"></div>

<?php
$terms = get_terms( array(
    'taxonomy' => 'fstr_loggjafanr'

) );

if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
	
    echo '<ul>';
    foreach ( $terms as $term ) {

        echo '<li>' . $term->name . '</li>';
		
			$thingmenn = get_terms( array(
			'taxonomy' => 'fstr_thingmadur',
			) );
			echo '<div class="fyrirspurnarlisti">';
			foreach ( $thingmenn as $thingmadr ) {
				
				echo '<h3>' . $thingmadr->name . '</h3>';

				
				$args2 = array(
				'post_type' => 'radherrafyrirspurnir',
				'fstr_thingmadur' => $thingmadr->slug
				);

		
					$wp_query = new WP_Query($args2);
					
					echo '<ul class="bullet_fix">';
					// starting loop
					while ($wp_query->have_posts()) : $wp_query->the_post();

					echo '							
								<li class=""><a href="' . get_field('fstr_althingi_url') . ' ">
									' . get_the_title() . '
								</a><span class="nav_inline_fix">' . ' - ' . get_field('fstr_svar') . '</span></li>';
								
					endwhile;
					echo '</ul>';
				
				
				
			}
			echo '</div>';
		wp_reset_query();
    }
    echo '</ul>';
	
}
// Reset Query
wp_reset_query();
?>

		</div>
	</div>
</div>
