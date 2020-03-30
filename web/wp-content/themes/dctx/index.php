<?php get_header(); ?>

<div id="main">
	<div class="container clearfix">

		<div class="main-content">

			<?php if (have_posts()) : ?>
				<ul class="posts">
					<?php while (have_posts()) : the_post(); ?>
						<li>
							<h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
							<p class="post-meta"><?php dctx_post_meta(); ?></p>
							<p class="post-excerpt"><?php the_excerpt(); ?></p>
							<div class="read-more"><a href="<?php the_permalink(); ?>" class="button">Continue reading</a></div>
						</li>
					<?php endwhile; ?>
				</ul>

				<?php dctx_numeric_posts_nav(); ?>
			<?php else : ?>
				<p>No result found.</p>
			<?php endif; ?>

		</div>

		<?php get_sidebar(); ?>

	</div>
</div>

<?php get_footer(); ?>
