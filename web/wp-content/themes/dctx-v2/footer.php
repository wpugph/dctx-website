<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package dctx
 */

?>

	<footer class="site-footer background-gallery">

		<?php get_sidebar(); ?>

		<nav id="footer-navigation" class="footer-navigation" aria-label="<?php esc_attr_e( 'Footer Navigation', 'dctx' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'fallback_cb'    => false,
					'theme_location' => 'footer',
					'menu_id'        => 'footer-menu',
					'menu_class'     => 'menu container',
					'container'      => true,
				)
			);
			?>
		</nav><!-- #site-navigation-->

		<div class="site-info">
			<?php dctx_display_copyright_text(); ?>
			<?php dctx_display_social_network_links(); ?>
		</div><!-- .site-info -->
	</footer><!-- .site-footer container-->

	<?php wp_footer(); ?>

	<?php dctx_display_mobile_menu(); ?>

</body>
</html>
