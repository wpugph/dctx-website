<?php
/**
 * Template part for displaying page content in home.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package dctx
 */

?>

	<article <?php post_class( 'container' ); ?>>
		<header class="entry-header">
			<?php
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );

			if ( 'post' === get_post_type() ) :
			?>
				<div class="entry-meta">
					<?php dctx_posted_on(); ?>
				</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php the_excerpt(); ?>
			<a class="button read-more" href="<?php echo esc_url( get_permalink() ); ?>"><?php echo esc_html__( 'Continue Reading', 'dctx' ); ?></a>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php dctx_entry_footer(); ?>
		</footer><!-- .entry-footer -->
	</article><!-- #post-## -->
