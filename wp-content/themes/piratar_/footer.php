<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package piratar
 */

?>

	</div><!-- #content -->
	</div><!-- #page -->
	</div><!-- .container -->
<div class="container">

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'piratar' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'piratar' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'piratar' ), 'piratar', '<a href="http://www.piratar.is" rel="designer">Píratar</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
	</div><!-- #container -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>