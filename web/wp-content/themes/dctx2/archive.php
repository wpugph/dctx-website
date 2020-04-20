<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package dctx
 */

get_header(); ?>

	<main id="main" class="site-main">

		<header class="blog-header full-width">

			<div class="container">

				<?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>

			</div><!-- .container -->

		</header><!-- .blog-header -->
		<div class="article-wrapper">

		<?php if ( have_posts() ) : ?>

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
					* Include the Post-Format-specific template for the content.
					* If you want to override this in a child theme, then include a file
					* called content-___.php (where ___ is the Post Format name) and that will be used instead.
					*/
				get_template_part( 'template-parts/content', 'blog' );

			endwhile;

			dctx_display_numeric_pagination();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>
		</div><!-- .article-wrapper -->
	</main><!-- #main -->
<?php get_footer(); ?>
