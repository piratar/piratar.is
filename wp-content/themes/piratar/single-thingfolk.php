<?php get_header(); ?>

<div class="section section-card section-title <?php if($image) echo " section-bg-image" ?>" style="background-image: url(<?php echo $image[0] ?>);">

    <div class="section-overlay"></div>

    <div class="container-fluid">

        <div class="row">

        	<div class="col-sm-12">

	            <h2 class="the-title"><?php echo the_title(); ?></h2>           

        	</div>

        </div>

    </div>

</div>

<div class="section section-content">

    <div class="container-fluid">

        <div class="row">

               <div class="col-sm-12 col-lg-9 push-lg-1 post">

	            <?php get_template_part( 'content', "single_thingfolk" ); ?>

        	</div>

        </div>

    </div>

</div>


<?php get_footer(); ?>
