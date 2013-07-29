<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package Skyflat
 */
?>

	</div><!-- #main -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<?php  get_sidebar( 'footer' ); ?>
		<div class="site-info">
			<?php do_action( 'skyflat_credits' ); ?>
			<a href="http://wordpress.org/" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'skyflat' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s', 'skyflat' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( __( 'Theme: %1$s by %2$s.', 'skyflat' ), 'Skyflat', '<a href="http://www.florian.girardey.net/" rel="designer">Florian Girardey</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>