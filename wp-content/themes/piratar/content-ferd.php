<?php 
    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
    $field = get_field_object('from');
    $value = get_field('from');
    $label = $field['choices'][ $value ];
    $merki = get_field('merki');
    $flag = get_field('flag');
$pricefrom = get_field('pricefrom');
    $partner_service = get_field('partner_service');
    $partner_service_text = "";
    $partner_service_class = "";
    if ($partner_service == true) { $partner_service_text = "<span>Saga Travel Partner Service</span>"; $partner_service_class = "class='partnerservice'"; } 
?>
    <article class="tour privatetours <?php echo $value?> gre">
        <h2 class="taglabel"><?php echo $label; ?></h2>
        <div class="mynd">
            <figure style="background-image: url(<?php echo $image[0]; ?>);">
                <a href="<?php the_permalink(); ?>"><img src="<?php echo $image[0]; ?>" width="270" height="131" border="0" alt="" /></a>
            </figure>
        </div>
        <span class="description">
            <h3 <?php echo $partner_service_class; ?>><a href="<?php the_permalink(); ?>"><?php echo get_field('tourid'); ?> <?php echo $partner_service_text; ?></a></h3>
            <h2><?php the_title(); ?></h2>
            <?php echo get_field('short_description'); ?><br />
            <?php if ($Departures) { echo '<div class="departures"><div class="splitter h10"></div><i class="fa fa-calendar"></i> ' . $Departures . "</div>"; } ?>
            <?php if ($Duration) { echo '<div class="departures"><i class="fa fa-clock-o"></i> ' . $Duration . "</div>"; } ?>
            <div class="touricons">
            <?php
                foreach ($merki as &$value) {
                    echo "<div class='icon_".$value."'></div>";
                }
            ?></div>
            <?php
                foreach ($flag as &$value) {
                    if ($value) {
                        if ($value == "bestseller") { $nafnrib = "best seller"; } else {  $nafnrib = $value; }
                        echo '<div class="ribbon ribbon-small ribbon-' . $value . '"><div class="banner"><div class="text">' . $nafnrib . '</div></div></div>';
                    }
                }
            ?>
            </span>
            <div class="verdfra">
            <?php if (!empty($pricefrom)) { 
                $format_number = number_format($pricefrom, 0, ',', '.');
            ?>
                <h3 class="tour-operated" style="margin-bottom:2px;">Price from</h3>
                <strong><?php echo $format_number; ?> ISK</strong> per person.<br/><br/>
            <?php } ?>
            </div>
    </article>