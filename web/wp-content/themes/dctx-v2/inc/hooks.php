<?php
/**
 * Action hooks and filters.
 *
 * A place to put hooks and filters that aren't necessarily template tags.
 *
 * @package dctx
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @author WDS
 * @return array
 */
function dctx_body_classes( $classes ) {

	// @codingStandardsIgnoreStart
	// Allows for incorrect snake case like is_IE to be used without throwing errors.
	global $is_IE, $is_edge, $is_safari;

	// If it's IE, add a class.
	if ( $is_IE ) {
		$classes[] = 'ie';
	}

	// If it's Edge, add a class.
	if ( $is_edge ) {
		$classes[] = 'edge';
	}

	// If it's Safari, add a class.
	if ( $is_safari ) {
		$classes[] = 'safari';
	}

	// Are we on mobile?
	if ( wp_is_mobile() ) {
		$classes[] = 'mobile';
	}
	// @codingStandardsIgnoreEnd

	// Give all pages a unique class.
	if ( is_page() ) {
		$classes[] = 'page-' . basename( get_permalink() );
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds "no-js" class. If JS is enabled, this will be replaced (by javascript) to "js".
	$classes[] = 'no-js';

	// Add a cleaner class for the scaffolding page template.
	if ( is_page_template( 'template-scaffolding.php' ) ) {
		$classes[] = 'template-scaffolding';
	}

	// Add a `has-sidebar` class if we're using the sidebar template.
	if ( is_page_template( 'template-sidebar-right.php' ) || is_page_template( 'template-sidebar-left.php' ) || is_singular( 'post' ) ) {
		$classes[] = 'has-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'dctx_body_classes' );

/**
 * Flush out the transients used in dctx_categorized_blog.
 *
 * @author WDS
 * @return string
 */
function dctx_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return false;
	}
	// Like, beat it. Dig?
	delete_transient( 'dctx_categories' );
}
add_action( 'delete_category', 'dctx_category_transient_flusher' );
add_action( 'save_post', 'dctx_category_transient_flusher' );

/**
 * Customize "Read More" string on <!-- more --> with the_content();
 *
 * @author WDS
 * @return string
 */
function dctx_content_more_link() {
	return ' <a class="more-link" href="' . get_permalink() . '">' . esc_html__( 'Read More', 'dctx' ) . '...</a>';
}
add_filter( 'the_content_more_link', 'dctx_content_more_link' );

/**
 * Customize the [...] on the_excerpt();
 *
 * @author WDS
 * @param string $more The current $more string.
 * @return string
 */
function dctx_excerpt_more( $more ) {
	return sprintf( ' <a class="more-link" href="%1$s">%2$s</a>', get_permalink( get_the_ID() ), esc_html__( 'Read more...', 'dctx' ) );
}
add_filter( 'excerpt_more', 'dctx_excerpt_more' );

/**
 * Enable custom mime types.
 *
 * @author WDS
 * @param array $mimes Current allowed mime types.
 * @return array
 */
function dctx_custom_mime_types( $mimes ) {
	$mimes['svg']  = 'image/svg+xml';
	$mimes['svgz'] = 'image/svg+xml';
	return $mimes;
}
add_filter( 'upload_mimes', 'dctx_custom_mime_types' );

/**
 * Disable the "Cancel reply" link. It doesn't seem to work anyway, and it only makes the "Leave Reply" heading confusing.
 */
add_filter( 'cancel_comment_reply_link', '__return_false' );

// Create shortcode for SVG.
// Usage [svg icon="facebook-square" title="facebook" desc="like us on facebook" fill="#000000" height="20px" width="20px"].
add_shortcode( 'svg', 'dctx_display_svg' );

/**
 * Display the customizer header scripts.
 *
 * @author Greg Rickaby
 * @return string
 */
function dctx_display_customizer_header_scripts() {

	// Check for header scripts.
	$scripts = get_theme_mod( 'dctx_header_scripts' );

	// None? Bail...
	if ( ! $scripts ) {
		return false;
	}

	// Otherwise, echo the scripts!
	echo dctx_get_the_content( $scripts ); // WPCS XSS OK.
}
add_action( 'wp_head', 'dctx_display_customizer_header_scripts', 999 );

/**
 * Display the customizer footer scripts.
 *
 * @author Greg Rickaby
 * @return string
 */
function dctx_display_customizer_footer_scripts() {

	// Check for footer scripts.
	$scripts = get_theme_mod( 'dctx_footer_scripts' );

	// None? Bail...
	if ( ! $scripts ) {
		return false;
	}

	// Otherwise, echo the scripts!
	echo dctx_get_the_content( $scripts ); // WPCS XSS OK.
}
add_action( 'wp_footer', 'dctx_display_customizer_footer_scripts', 999 );

/**
 * Adds OG tags to the head for better social sharing.
 *
 * @return string Just an empty string if Yoast is found.
 * @author Corey Collins
 */
function dctx_add_og_tags() {

	// Bail if Yoast is installed, since it will handle things.
	if ( class_exists( 'WPSEO_Options' ) ) {
		return '';
	}

	// Set a post global on single posts. This avoids grabbing content from the first post on an archive page.
	if ( is_singular() ) {
		global $post;
	}

	// Get the post content.
	$post_content = ! empty( $post ) ? $post->post_content : '';

	// Strip all tags from the post content we just grabbed.
	$default_content = ( $post_content ) ? wp_strip_all_tags( strip_shortcodes( $post_content ) ) : $post_content;

	// Set our default title.
	$default_title = get_bloginfo( 'name' );

	// Set our default URL.
	$default_url = get_permalink();

	// Set our base description.
	$default_base_description = ( get_bloginfo( 'description' ) ) ? get_bloginfo( 'description' ) : esc_html__( 'Visit our website to learn more.', 'dctx' );

	// Set the card type.
	$default_type = 'article';

	// Get our custom logo URL. We'll use this on archives and when no featured image is found.
	$logo_id    = get_theme_mod( 'custom_logo' );
	$logo_image = ( $logo_id ) ? wp_get_attachment_image_src( $logo_id, 'full' ) : '';
	$logo_url   = ( $logo_id ) ? $logo_image[0] : '';

	// Set our final defaults.
	$card_title            = $default_title;
	$card_description      = $default_base_description;
	$card_long_description = $default_base_description;
	$card_url              = $default_url;
	$card_image            = $logo_url;
	$card_type             = $default_type;

	// Let's start overriding!
	// All singles.
	if ( is_singular() ) {

		if ( has_post_thumbnail() ) {
			$card_image = get_the_post_thumbnail_url();
		}
	}

	// Single posts/pages that aren't the front page.
	if ( is_singular() && ! is_front_page() ) {

		$card_title            = get_the_title() . ' - ' . $default_title;
		$card_description      = ( $default_content ) ? wp_trim_words( $default_content, 53, '...' ) : $default_base_description;
		$card_long_description = ( $default_content ) ? wp_trim_words( $default_content, 140, '...' ) : $default_base_description;
	}

	// Categories, Tags, and Custom Taxonomies.
	if ( is_category() || is_tag() || is_tax() ) {

		$term_name      = single_term_title( '', false );
		$card_title     = $term_name . ' - ' . $default_title;
		$specify        = ( is_category() ) ? esc_html__( 'categorized in', 'dctx' ) : esc_html__( 'tagged with', 'dctx' );
		$queried_object = get_queried_object();
		$card_url       = get_term_link( $queried_object );
		$card_type      = 'website';

		// Translators: get the term name.
		$card_long_description = $card_description = sprintf( esc_html__( 'Posts %1$s %2$s.', 'dctx' ), $specify, $term_name );
	}

	// Search results.
	if ( is_search() ) {

		$search_term = get_search_query();
		$card_title  = $search_term . ' - ' . $default_title;
		$card_url    = get_search_link( $search_term );
		$card_type   = 'website';

		// Translators: get the search term.
		$card_long_description = $card_description = sprintf( esc_html__( 'Search results for %s.', 'dctx' ), $search_term );
	}

	if ( is_home() ) {

		$posts_page = get_option( 'page_for_posts' );
		$card_title = get_the_title( $posts_page ) . ' - ' . $default_title;
		$card_url   = get_permalink( $posts_page );
		$card_type  = 'website';
	}

	// Front page.
	if ( is_front_page() ) {

		$front_page = get_option( 'page_on_front' );
		$card_title = ( $front_page ) ? get_the_title( $front_page ) . ' - ' . $default_title : $default_title;
		$card_url   = get_home_url();
		$card_type  = 'website';
	}

	// Post type archives.
	if ( is_post_type_archive() ) {

		$post_type_name = get_post_type();
		$card_title     = $post_type_name . ' - ' . $default_title;
		$card_url       = get_post_type_archive_link( $post_type_name );
		$card_type      = 'website';
	}

	// Media page.
	if ( is_attachment() ) {
		$attachment_id = get_the_ID();
		$card_image    = ( wp_attachment_is_image( $attachment_id ) ) ? wp_get_attachment_image_url( $attachment_id, 'full' ) : $card_image;
	}

	?>
	<meta property="og:title" content="<?php echo esc_attr( $card_title ); ?>" />
	<meta property="og:description" content="<?php echo esc_attr( $card_description ); ?>" />
	<meta property="og:url" content="<?php echo esc_url( $card_url ); ?>" />
	<?php if ( $card_image ) : ?>
		<meta property="og:image" content="<?php echo esc_url( $card_image ); ?>" />
	<?php endif; ?>
	<meta property="og:site_name" content="<?php echo esc_attr( $default_title ); ?>" />
	<meta property="og:type" content="<?php echo esc_attr( $card_type ); ?>" />
	<meta name="description" content="<?php echo esc_attr( $card_long_description ); ?>" />
	<?php
}
add_action( 'wp_head', 'dctx_add_og_tags' );

/**
 * Removes or Adjusts the prefix on category archive page titles.
 *
 * @param string $block_title The default $block_title of the page.
 * @return string The updated $block_title.
 * @author Corey Collins
 */
function dctx_remove_archive_title_prefix( $block_title ) {

	// Get the single category title with no prefix.
	$single_cat_title = single_term_title( '', false );

	if ( is_category() || is_tag() || is_tax() ) {
		return esc_html( $single_cat_title );
	}

	return $block_title;
}
add_filter( 'get_the_archive_title', 'dctx_remove_archive_title_prefix' );

/**
 * Disables wpautop to remove empty p tags in rendered Gutenberg blocks.
 *
 * @param string $content The starting post content.
 * @return string The updated post content.
 * @author Corey Collins
 */
function dctx_remove_empty_p_tags_from_content( $content ) {

	// If we have blocks in place, don't add wpautop.
	if ( has_blocks() ) {
		return $content;
	}

	return wpautop( $content );
}
remove_filter( 'the_content', 'wpautop' );
add_filter( 'the_content', 'dctx_remove_empty_p_tags_from_content' );

/**
 * Adds lazy loading attribute to images for Chrome native lazy loading. This is for images used outside of the Gutenberg Image block.
 *
 * @param array $attr Our default attributes.
 * @return array $attr Our updated attributes.
 * @author Corey Collins
 */
function dctx_add_chrome_lazy_loading_to_images( $attr ) {

	$attr['loading'] = 'lazy';

	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'dctx_add_chrome_lazy_loading_to_images' );

/**
 * Allows the loading attribute to be used in images.
 *
 * @param array $allowedposttags Allowed tags by WordPress.
 * @return array $allowedposttags Updated tags to be allowed.
 * @author Corey Collins
 */
function dctx_allow_img_attributes( $allowedposttags ) {

	$allowedposttags['img'] = array(
		'loading' => true,
		'width'   => true,
		'height'  => true,
		'src'     => true,
		'class'   => true,
		'srcset'  => true,
		'alt'     => true,
		'title'   => true,
	);

	return $allowedposttags;
}
add_filter( 'wp_kses_allowed_html', 'dctx_allow_img_attributes', 1 );

/**
 * Filters the output of blocks to add Chrome native lazy loading.
 *
 * @param mixed $block_content The HTML markup for the block.
 * @param array $block The block object.
 * @return mixed $block_content The HTML markup for the block.
 * @author Corey Collins
 */
function dctx_add_lazy_loading_to_image_block( $block_content, $block ) {

	// We only want to filter core blocks here, because our custom blocks are handled differently.
	if ( $block['blockName'] && strpos( $block['blockName'], 'core/' ) === false ) {
		return $block_content;
	}

	$block_content = str_replace( '<img', '<img loading="lazy"', $block_content );

	return $block_content;
}
add_filter( 'render_block', 'dctx_add_lazy_loading_to_image_block', 10, 2 );
