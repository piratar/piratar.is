<?php

if ( post_password_required() ) {
	return;
}

function piratar_comment_nav() {
	// Are there comments to navigate through?
	if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
	?>
	<nav class="navigation comment-navigation">
		<div class="nav-links">
			<?php
				if ( $prev_link = get_previous_comments_link( __( 'Older Comments', 'piratar' ) ) ) :
					printf( '<div class="nav-previous">%s</div>', $prev_link );
				endif;

				if ( $next_link = get_next_comments_link( __( 'Newer Comments', 'piratar' ) ) ) :
					printf( '<div class="nav-next">%s</div>', $next_link );
				endif;
			?>
		</div><!-- .nav-links -->
	</nav><!-- .comment-navigation -->
	<?php
	endif;
}

?>
<div id="comments">
	<h3 id="comments-title">
	<?php
		printf( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'piratar' ),
			number_format_i18n( get_comments_number() ), get_the_title() );
	?>
	</h3>
	<?php piratar_comment_nav(); ?>
	<?php if ( have_comments() ) : ?>
		<ol class="commentlist">
			<?php
				wp_list_comments( array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 56,
				) );
			?>
		</ol>
		<?php piratar_comment_nav(); ?>
	<?php endif; ?>
	
	<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'piratar' ); ?></p>
	<?php endif; ?>
	
	<?php comment_form(); ?>
</div><!-- #comments -->