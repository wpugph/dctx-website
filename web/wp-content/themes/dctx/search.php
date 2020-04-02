<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package DCTx
 * @since 1.0.0
 */

// phpcs:disable

get_header();
?>

<div id="main">
	<h1 class="page-title">Search results for '<?php echo $_GET['s']; ?>'</h1>

	<div class="container clearfix">
		
		<div class="main-content">
			<?php if (have_posts()) : ?>
				<div class="posts">
					<?php while (have_posts()) : the_post(); ?>
						<div class="post">
							<h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

							<?php dctx_post_meta(); ?>

							<p class="post-excerpt"><?php the_excerpt(); ?></p>
							<div class="read-more"><a href="<?php the_permalink(); ?>" class="button">Continue reading</a></div>
						</div>
					<?php endwhile; ?>
				</div>

				<?php dctx_numeric_posts_nav(); ?>
			<?php else : ?>
				<p class="align-center">No result found. Please try again.</p>
			<?php endif; ?>
		</div>

		<?php get_sidebar(); ?>

	</div>
</div>

<?php get_footer(); ?>
