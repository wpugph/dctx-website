<?php get_header(); ?>

<div id="main">
	<div class="container clearfix">
		
		<div class="main-content">
			<h1 class="page-title">Search results for '<?php echo $_GET['s']; ?>'</h1>

			<?php if (have_posts()) : ?>
				<ul class="posts">
					<?php while (have_posts()) : the_post(); ?>
						<li>
							<h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

							<?php if (get_post_type() == 'post') : ?>
								<p class="post-meta"><?php dctx_post_meta(); ?></p>
							<?php endif; ?>

							<p class="post-excerpt"><?php the_excerpt(); ?></p>
							<div class="read-more"><a href="<?php the_permalink(); ?>" class="button">Continue reading</a></div>
						</li>
					<?php endwhile; ?>
				</ul>

				<?php dctx_numeric_posts_nav(); ?>
			<?php else : ?>
				<p>No result found. Please try again.</p>
			<?php endif; ?>
		</div>

		<?php get_sidebar(); ?>

	</div>
</div>

<?php get_footer(); ?>
