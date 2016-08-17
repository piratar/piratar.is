<?php
    /* Template Name: Fundagerðir RSS */
    get_header();
?>

<?php // Get RSS Feed(s)
include_once( ABSPATH . WPINC . '/feed.php' );

// Get a SimplePie feed object from the specified feed source.
$rss = fetch_feed( 'http://blog.piratar.is/thingflokkur/fundargerdir-2/feed/?post_type=pdf' );

if ( ! is_wp_error( $rss ) ) : // Checks that the object is created correctly

    // Figure out how many total items there are, but limit it to 5. 
    $maxitems = $rss->get_item_quantity( 5 ); 

    // Build an array of all the items, starting with element 0 (first element).
    $rss_items = $rss->get_items( 0, $maxitems );

endif;
?>

<div class="efnid">
    <div class="wrapper">
        <div class="alpha full">
            <div class="splitter h20"></div>
            <h2 class="section-title"><?php echo the_title(); ?></h2>
            <div class="splitter h20"></div>
            <div class="hr hr-short hr-center avia-builder-el-11 el_after_av_textblock el_before_av_textblock "><span class="hr-inner "><span class="hr-inner-style"></span></span></div>
            <div class="splitter h20"></div>

                <?php if ( $maxitems == 0 ) : ?>
                    <li><?php _e( 'Nothing to feed', 'my-text-domain' ); ?></li>
                <?php else : ?>
                    <?php // Loop through each feed item and display each item as a hyperlink. ?>
                    <?php foreach ( $rss_items as $item ) : ?>
                            <div class="thingmal_rss_feed">
                                <h3>
                                    <a href="<?php echo esc_url( $item->get_permalink() ); ?>"
                                    title="<?php printf( __( 'Posted %s', 'my-text-domain' ), $item->get_date('j F Y | g:i a') ); ?>">
                                    <?php echo esc_html( $item->get_title() ); ?>
                                    </a>
                                </h3>
                                <small><?php echo $item->get_date(); ?></small>
                                <p><?php echo $item->get_content(); ?>
                                    <a href="<?php echo esc_url( $item->get_permalink() ); ?>" title="">Lesa meira</a>
                                </p>
                            </div>
                    <?php endforeach; ?>
                <?php endif; ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>
