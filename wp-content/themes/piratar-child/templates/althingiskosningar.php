<?php
    /*
	Template Name: Alþingiskosningar
	*/
get_header(); ?>

	<div>
		<h3>Stefnan</h3>
	</div>

	<div id="boxin_kynning">
		<h3>Topp 5 úr kjördæmum</h3>
		<div class="wrapper">
			<div class="box">
				<?php the_field('nordvesturbox', 42); ?>
			</div>
			<div class="box">
				<?php the_field('sudurbox', 42); ?>
			</div>
			<div  class="box">
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
			<div class="box">
				<?php the_field('forsidubox_6', 42); ?>
			</div>
		</div>
	</div>

	<div>
		<a href="#">Sja alla</a>
	</div>

	<div id="boxin_kynning" class="">
		<h3>Píratar í fréttum</h3>
		<div class="wrapper">
			<div class="alpha full">
				<?php the_content(); ?>
			</div>
		</div>
	</div>


	<div id="boxin_kynning" class="">
		<div class="wrapper">
			<div class="box">
				<h2>Taka þátt</h2>
			</div>
			<div class="box">
				<h2>Fyrir fjölmiðla</h2>
			</div>
			<div class="box">
				<h2>Hvernig á að kjósa?</h2>
			</div>
		</div>
	</div>

<?php get_footer(); ?>
