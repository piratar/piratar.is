<?php get_header(); ?>

<div class="efnid">
	<div class="wrapper">
		<div class="alpha full">

	<?php 

	$custom_terms = get_terms('bokhalds_ar');

	foreach($custom_terms as $custom_term) {
		wp_reset_query();
		$args = array('post_type' => 'bokhald',
			'tax_query' => array(
				array(
					'taxonomy' => 'bokhalds_ar',
					'field' => 'slug',
					'terms' => $custom_term->slug,
				),
			),

			'orderby' => 'slug',
		 );

		 $loop = new WP_Query($args);
		 if($loop->have_posts()) {
			echo '<h1>'.$custom_term->name.'</h1>';
			echo '<h3>Veljið mánuð til að skoða:</h3>';

			while($loop->have_posts()) : $loop->the_post();
				echo '- <a href="'.get_permalink().'">'.get_the_title().'</a><br>';
			endwhile;
		 }
	}
?>
</div>
	</div>
		</div>
<?php get_footer(); ?>