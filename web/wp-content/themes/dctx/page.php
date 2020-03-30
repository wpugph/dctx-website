<?php get_header(); ?>

<div id="main">
	<div class="container clearfix">

		<div class="main-content">
			<?php while (have_posts()) : the_post(); ?>
				<h1><?php the_title(); ?></h1>
				<div><?php the_content(); ?></div>
			<?php endwhile; ?>
		</div>

		<?php get_sidebar(); ?>

	</div>
</div>

<?php if (!is_page(15)): ?>
	<?php include_once('partials/volunteer.php'); ?>
<?php endif; ?>

<?php get_footer(); ?>
