<?php
// phpcs:disable

get_header();
?>

<div id="main">
	<div class="container clearfix">

		<div class="main-content">
			<?php while (have_posts()) : the_post(); ?>
				<h1 class="post-title"><?php the_title(); ?></h1>
				<?php dctx_post_meta(); ?>

				<?php if (has_post_thumbnail()): ?>
					<div class="featured-image">
						<?php the_post_thumbnail('full'); ?>

						<?php if (get_post( get_post_thumbnail_id())->post_content): ?>
							 <div class="featured-image-caption">
								  <?php echo wp_kses_post(get_post( get_post_thumbnail_id() )->post_content ); ?>
							 </div>
						<?php endif; ?>
					</div>
				<?php endif; ?>

				<div><?php the_content(); ?></div>

				<div class="author-container">
					<h2>About <?php echo get_the_author_meta('first_name') . ' ' . get_the_author_meta('last_name'); ?></h2>

					<div class="clearfix">
						<div class="author-img"><a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><img src="<?php echo get_avatar_url(get_the_author_meta('ID')); ?>" alt="<?php the_author(); ?>" title="View all posts by <?php the_author(); ?>"></a></div>
						<div class="author-info"><p><?php the_author_meta('description'); ?></p></div>
					</div>
				</div>
			<?php endwhile; ?>

			<div class="comments-container">
				<h2>Comments</h2>
				<div><?php comments_template(true); ?></div>
			</div>
		</div>

		<?php get_sidebar(); ?>

	</div>
</div>

<?php get_footer(); ?>
