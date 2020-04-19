<?php
/**
 * Template Name: RapidPass
 *
 * This template displays a page with a sidebar on the right side of the screen.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package dctx
 */

get_header(); ?>

	<main id="main" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'rapidpass' );

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php get_footer(); ?>
