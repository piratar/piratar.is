<?php
    /*
	Template Name: Alþingiskosningar
	*/
get_header(); ?>

	<div>
		<h3>Stefnan</h3>
	</div>

	<h3>Topp 5 úr kjördæmum</h3>
	<div id="boxin_kynning">
		<div class="wrapper">
			<div class="box">
				<?php the_field('nordvesturbox', 42); ?>
			</div>
			<div class="box">
				<?php the_field('sudurbox', 42); ?>
			</div>
			<div id="myList" class="box">
				<?php the_field('capitalbox', 42); ?>            
			</div>
		</div>
		<div class="wrapper">
			<div class="box">
				<?php the_field('forsidubox_4', 42); ?>
			</div>
			<div class="box">
				<?php the_field('forsidubox_5', 42); ?>
			</div>
			<div id="myList" class="box">
				<?php the_field('forsidubox_6', 42); ?>            
			</div>
		</div>
	</div>

	<h3>Píratar í fréttum</h3>
	<div id="boxin_kynning" class="">
		<div class="wrapper">
			<div class="alpha full">
				<?php the_content(); ?>
			</div>
			<div class="box nedrabox">
				<?php the_field('kosningarbox1', 42); ?>            
			</div>
		</div>
	</div>


	<h3>Hvernig á að kjósa?</h3>

<?php get_footer(); ?>
