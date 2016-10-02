<?php
	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
    if ($image[0] == false) $image[0] =  get_template_directory_uri() . "/img/framb-default.png";
    if (get_post_field("menu_order", $post->ID) != 0) {
?>
<li class="person"><figure><div><img src="<?php echo $image[0]; ?>"><div class="person-overlay"></div></div><span class="person-num"><?php echo $k; ?></span></figure><div class="person-wrap"><a href="#"><?php the_title(); ?></a></div></li>
<?php $k++; } ?>