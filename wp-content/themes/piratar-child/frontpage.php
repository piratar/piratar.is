<?php 
    /*
	Template Name: Kosningarforsíða
	*/

get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>

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



<div class="section section-content section-kosningar">

    <div class="container-fluid">

        <div class="row">

        	<div class="col-sm-12 col-lg-8">

	            <?php get_template_part( 'content', "page" ); ?>	            

        	</div>

        </div>

    </div>

</div>

<?php endwhile; ?>


<div class="section section-content section-two section-bg-gray">

    <div class="section-overlay">

        <div class="container-fluid">

            <div class="row">

                <?php 

                global $post;
                $postslug = $post->post_name;

                if ($postslug == "framtidarsyn") { ?>

                <div class="two-item two-color-purple text-xs-center col-md-12">

                    <h2>Áherslumál</h2>
                    
                    <p>Við leggjum áherslu á nýja stjórnarskrá, auðlindir í almannaþágu, gjaldfrjálsa heilbrigðisþjónustu, þáttöku í ákvarðanatöku og átak gegn spillingu.</p>

                    <p class="two-button"><a href="<?php echo get_site_url(); ?>/" class="btn btn-primary btn-white">Lesa meira</a></p>

                </div>

                <?php } elseif ($postslug == "kosningarforsida") { ?>

                <div class="two-item two-color-purple-light text-xs-center col-md-12">

                    <h2>Framtíðarsýn</h2>
                    
                    <p>Ítarleg áætlun Pírata í öllum helstu málaflokkum. Þar á meðal velferðarmál, atvinnumál, landbúnaðarmál og lýðræðismál.</p>

                    <p class="two-button"><a href="<?php echo get_site_url(); ?>/framtidarsyn" class="btn btn-primary btn-white">Lesa meira</a></p>

                </div>

                <?php } ?>

            </div>

        </div>

    </div>

</div>

<?php get_footer(); ?>

