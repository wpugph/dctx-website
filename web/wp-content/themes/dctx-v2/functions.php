<?php
/**
 * dctx functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package dctx
 */

if ( ! function_exists( 'dctx_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * @author WDS
	 */
	function dctx_setup() {
		/**
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on dctx, use a find and replace
		 * to change 'dctx' to the name of your theme in all the template files.
		 * You will also need to update the Gulpfile with the new text domain
		 * and matching destination POT file.
		 */
		load_theme_textdomain( 'dctx', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/**
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'full-width', 1920, 1080, false );

		// Register navigation menus.
		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary Menu', 'dctx' ),
				'mobile'  => esc_html__( 'Mobile Menu', 'dctx' ),
				'footer'  => esc_html__( 'Footer Menu', 'dctx' ),
			)
		);

		/**
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'dctx_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Custom logo support.
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 500,
				'flex-height' => true,
				'flex-width'  => true,
				'header-text' => array( 'site-title', 'site-description' ),
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Gutenberg color palette support.
		add_theme_support( 'editor-color-palette', dctx_get_theme_colors_gutenberg() );

		// Gutenberg support for full-width/wide alignment of supported blocks.
		add_theme_support( 'align-wide' );

		// Gutenberg defaults for font sizes.
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name' => __( 'Small', 'dctx' ),
					'size' => 12,
					'slug' => 'small',
				),
				array(
					'name' => __( 'Normal', 'dctx' ),
					'size' => 16,
					'slug' => 'normal',
				),
				array(
					'name' => __( 'Large', 'dctx' ),
					'size' => 36,
					'slug' => 'large',
				),
				array(
					'name' => __( 'Huge', 'dctx' ),
					'size' => 50,
					'slug' => 'huge',
				),
			)
		);

		// Gutenberg editor styles support.
		add_theme_support( 'editor-styles' );
		add_editor_style( 'style-editor.css' );

		// Gutenberg responsive embed support.
		add_theme_support( 'responsive-embeds' );
	}
endif; // dctx_setup.
add_action( 'after_setup_theme', 'dctx_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 * @author WDS
 */
function dctx_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'dctx_content_width', 640 );
}
add_action( 'after_setup_theme', 'dctx_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 * @author WDS
 */
function dctx_widgets_init() {

	// Define sidebars.
	$sidebars = array(
		'footer-bar' => esc_html__( 'Footer Bar', 'dctx' ),
	);

	// Loop through each sidebar and register.
	foreach ( $sidebars as $sidebar_id => $sidebar_name ) {
		register_sidebar(
			array(
				'name'          => $sidebar_name,
				'id'            => $sidebar_id,
				'description'   => /* translators: the sidebar name */ sprintf( esc_html__( 'Widget area for %s', 'dctx' ), $sidebar_name ),
				'before_widget' => '<aside class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);
	}

}
add_action( 'widgets_init', 'dctx_widgets_init' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load styles and scripts.
 */
require get_template_directory() . '/inc/scripts.php';

/**
 * Load custom ACF features.
 */
require get_template_directory() . '/inc/acf.php';

/**
 * Load ACF Gutenberg block registration.
 */
require get_template_directory() . '/inc/acf-gutenberg.php';

/**
 * Load custom ACF search functionality.
 */
require get_template_directory() . '/inc/acf-search.php';

/**
 * Load custom filters and hooks.
 */
require get_template_directory() . '/inc/hooks.php';

/**
 * Load custom queries.
 */
require get_template_directory() . '/inc/queries.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Scaffolding Library.
 */
require get_template_directory() . '/inc/scaffolding.php';
