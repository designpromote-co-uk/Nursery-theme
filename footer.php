<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package DesignPromote
 * @subpackage Nursery
 * @since Nursery 1.0
 */
?>

		</div><!-- #main -->
		<footer id="colophon" class="site-footer" role="contentinfo">
			<?php get_sidebar( 'main' ); ?>

			<div class="site-info">
				<?php do_action( 'nursery_credits' ); ?>
				<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'nursery' ) ); ?>" title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', 'nursery' ); ?>"><?php printf( __( 'Proudly powered by %s', 'nursery' ), 'WordPress' ); ?></a>
			</div><!-- .site-info -->
		</footer><!-- #colophon -->
	</div><!-- #page -->

	<?php wp_footer(); ?>
</body>
</html>