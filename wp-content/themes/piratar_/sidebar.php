<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package piratar
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>
<div class="col-md-4 col-xs-12" >
<div id="secondary" class="widget-area" role="complementary">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</div><!-- #secondary -->
</div><!-- .col-md-4>-->
</div><!-- .row -->
