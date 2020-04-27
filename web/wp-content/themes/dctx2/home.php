<?php
/**
 * The template for the Blog archive.
 *
 * This is the template that displays all posts by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package dctx
 */

get_header(); ?>

	<main id="main" class="site-main">

		<header class="blog-header full-width">

			<div class="container">

				<h1 class="page-title"><?php echo esc_html__( 'Blog', 'dctx' ); ?></h1>

			</div><!-- .container -->

		</header><!-- .blog-header -->

		<div class="article-wrapper">

			<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content', 'blog' );

			endwhile; // End of the loop.
			?>
		</div><!-- .article-wrapper -->

	</main><!-- #main -->

<?php get_footer(); ?>
