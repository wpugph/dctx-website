<?php //phpcs:disable

/**
* Template Name: No Title Page
*
* @package WordPress
* @subpackage dctx
* @since dctx 1.0
*/
	
	get_header(); ?>


<div id="main">
	<div class="clearfix">

		<div class="main-content">
			<?php while (have_posts()) : the_post(); ?>
				<div><?php the_content(); ?></div>
			<?php endwhile; ?>
		</div>

		<?php get_sidebar(); ?>

	</div>
</div>

<?php get_footer(); ?>
