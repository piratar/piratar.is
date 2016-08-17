<div>
    <h2><?php _e( 'Nothing Found', 'piratar' ); ?></h2>
    <?php if ( is_search() ): ?>
        <p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'piratar' ); ?></p>
    <?php else: ?>
        <p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'piratar' ); ?></p>
    <?php endif; ?>
    <?php get_search_form(); ?>
</div>
<div class="clear post-spt"></div>
