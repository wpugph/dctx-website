<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package dctx
 */

?>

	<article <?php post_class( 'container' ); ?>>
		<header class="entry-header">
			<?php
			if ( is_single() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif;
			if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php dctx_posted_on(); ?>
			</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php
				the_excerpt(
					sprintf(
						wp_kses(
							/* translators: %s: Name of current post. */
							__( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'dctx' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					)
				);

				wp_link_pages(
					array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'dctx' ),
						'after'  => '</div>',
					)
				);
			?>
			<div class="read-more"><a href="<?php the_permalink(); ?>" class="button">Continue reading</a></div>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php dctx_entry_footer(); ?>
		</footer><!-- .entry-footer -->
	</article><!-- #post-## -->
