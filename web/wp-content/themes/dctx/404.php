<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package DCTx
 * @since 1.0.0
 */

// phpcs:disable

get_header();
?>

<div id="main">
	<div class="container clearfix">
		<div class="main-content">
			<h1>404 Error</h1>

			<p>We cannot seem to find what you were looking for. Maybe we can still help you.</p>

			<ul>
				<li>You can search our site using the form provided below.</li>
				<li>You can visit <a href="<?php echo get_bloginfo('url'); ?>">the homepage.</a></li>
				<li>Or you can view some of our recent posts.</li>
			</ul>

			<?php include_once(TEMPLATEPATH . '/searchform.php'); ?>

			<h3>Recent Posts</h3>

			<?php query_posts('posts_per_page=5'); ?>

			<?php if (have_posts()) : ; ?>
				<ul>
					<?php while (have_posts()) : the_post() ?>
						<li><a href="<?php the_permalink() ?>" title="Permalink for : <?php the_title(); ?>"><?php the_title(); ?></a>
					<?php endwhile; ?>
				</ul>
			<?php endif; ?>
		</div>
	</div>
</div>

<?php get_footer(); ?>
