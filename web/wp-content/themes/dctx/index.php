<?php get_header(); ?>

<div id="main">
	<h1 class="page-title">Blog</h1>

	<div class="container clearfix">

		<div class="main-content">

			<?php if (have_posts()) : ?>
				<div class="posts">
					<?php while (have_posts()) : the_post(); ?>
						<li>
							<h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

							<?php dctx_post_meta(); ?>

							<div class="post-excerpt"><?php the_excerpt(); ?></div>
							<div class="read-more"><a href="<?php the_permalink(); ?>" class="button">Continue reading</a></div>
						</li>
					<?php endwhile; ?>
				</div>

				<?php dctx_numeric_posts_nav(); ?>
			<?php else : ?>
				<p>No result found.</p>
			<?php endif; ?>

		</div>

		<?php get_sidebar(); ?>

	</div>
</div>

<?php get_footer(); ?>
