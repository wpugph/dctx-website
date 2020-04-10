<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package dctx
 */

if ( ! function_exists( 'dctx_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 *
	 * @author WDS
	 */
	function dctx_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: the date the post was published */
			esc_html_x( 'Posted on %s', 'post date', 'dctx' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		$byline = sprintf(
			/* translators: the post author */
			esc_html_x( 'by %s', 'post author', 'dctx' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'dctx_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 *
	 * @author WDS
	 */
	function dctx_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'dctx' ) );
			if ( $categories_list && dctx_categorized_blog() ) {
				/* translators: the post category */
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'dctx' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html__( ', ', 'dctx' ) );
			if ( $tags_list ) {
				/* translators: the post tags */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'dctx' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link( esc_html__( 'Leave a comment', 'dctx' ), esc_html__( '1 Comment', 'dctx' ), esc_html__( '% Comments', 'dctx' ) );
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				/* translators: %s: Name of current post */
				esc_html__( 'Edit %s', 'dctx' ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

/**
 * Display SVG Markup.
 *
 * @param array $args The parameters needed to get the SVG.
 *
 * @author WDS
 */
function dctx_display_svg( $args = array() ) {
	echo dctx_get_svg( $args ); // WPCS XSS Ok.
}

/**
 * Return SVG markup.
 *
 * @param array $args The parameters needed to display the SVG.
 * @author WDS
 * @return string
 */
function dctx_get_svg( $args = array() ) {

	// Make sure $args are an array.
	if ( empty( $args ) ) {
		return esc_html__( 'Please define default parameters in the form of an array.', 'dctx' );
	}

	// Define an icon.
	if ( false === array_key_exists( 'icon', $args ) ) {
		return esc_html__( 'Please define an SVG icon filename.', 'dctx' );
	}

	// Set defaults.
	$defaults = array(
		'icon'   => '',
		'title'  => '',
		'desc'   => '',
		'fill'   => '',
		'height' => '',
		'width'  => '',
	);

	// Parse args.
	$args = wp_parse_args( $args, $defaults );

	// Figure out which title to use.
	$block_title = ( $args['title'] ) ? $args['title'] : $args['icon'];

	// Generate random IDs for the title and description.
	$random_number  = wp_rand( 0, 99999 );
	$block_title_id = 'title-' . sanitize_title( $block_title ) . '-' . $random_number;
	$desc_id        = 'desc-' . sanitize_title( $block_title ) . '-' . $random_number;

	// Set ARIA.
	$aria_hidden     = ' aria-hidden="true"';
	$aria_labelledby = '';

	if ( $args['title'] && $args['desc'] ) {
		$aria_labelledby = ' aria-labelledby="' . $block_title_id . ' ' . $desc_id . '"';
		$aria_hidden     = '';
	}

	// Set SVG parameters.
	$fill   = ( $args['fill'] ) ? ' fill="' . $args['fill'] . '"' : '';
	$height = ( $args['height'] ) ? ' height="' . $args['height'] . '"' : '';
	$width  = ( $args['width'] ) ? ' width="' . $args['width'] . '"' : '';

	// Start a buffer...
	ob_start();
	?>

	<svg
	<?php
		echo dctx_get_the_content( $height ); // WPCS XSS OK.
		echo dctx_get_the_content( $width ); // WPCS XSS OK.
		echo dctx_get_the_content( $fill ); // WPCS XSS OK.
	?>
		class="icon icon-<?php echo esc_attr( $args['icon'] ); ?>"
	<?php
		echo dctx_get_the_content( $aria_hidden ); // WPCS XSS OK.
		echo dctx_get_the_content( $aria_labelledby ); // WPCS XSS OK.
	?>
		role="img">
		<title id="<?php echo esc_attr( $block_title_id ); ?>">
			<?php echo esc_html( $block_title ); ?>
		</title>

		<?php
		// Display description if available.
		if ( $args['desc'] ) :
		?>
			<desc id="<?php echo esc_attr( $desc_id ); ?>">
				<?php echo esc_html( $args['desc'] ); ?>
			</desc>
		<?php endif; ?>

		<?php
		// Use absolute path in the Customizer so that icons show up in there.
		if ( is_customize_preview() ) :
		?>
			<use xlink:href="<?php echo esc_url( get_parent_theme_file_uri( '/assets/images/svg-icons.svg#icon-' . esc_html( $args['icon'] ) ) ); ?>"></use>
		<?php else : ?>
			<use xlink:href="#icon-<?php echo esc_html( $args['icon'] ); ?>"></use>
		<?php endif; ?>

	</svg>

	<?php
	// Get the buffer and return.
	return ob_get_clean();
}

/**
 * Trim the title length.
 *
 * @param array $args Parameters include length and more.
 *
 * @author WDS
 * @return string
 */
function dctx_get_the_title( $args = array() ) {

	// Set defaults.
	$defaults = array(
		'length' => 12,
		'more'   => '...',
	);

	// Parse args.
	$args = wp_parse_args( $args, $defaults );

	// Trim the title.
	return wp_trim_words( get_the_title( get_the_ID() ), $args['length'], $args['more'] );
}

/**
 * Limit the excerpt length.
 *
 * @param array $args Parameters include length and more.
 *
 * @author WDS
 * @return string
 */
function dctx_get_the_excerpt( $args = array() ) {

	// Set defaults.
	$defaults = array(
		'length' => 20,
		'more'   => '...',
		'post'   => '',
	);

	// Parse args.
	$args = wp_parse_args( $args, $defaults );

	// Trim the excerpt.
	return wp_trim_words( get_the_excerpt( $args['post'] ), absint( $args['length'] ), esc_html( $args['more'] ) );
}

/**
 * Echo the copyright text saved in the Customizer.
 *
 * @author WDS
 * @return bool
 */
function dctx_display_copyright_text() {

	// Grab our customizer settings.
	$copyright_text = get_theme_mod( 'dctx_copyright_text' );

	// Stop if there's nothing to display.
	if ( ! $copyright_text ) {
		return false;
	}

	echo dctx_get_the_content( do_shortcode( $copyright_text ) ); // phpcs: xss ok.
}

/**
 * Get the Twitter social sharing URL for the current page.
 *
 * @author WDS
 * @return string
 */
function dctx_get_twitter_share_url() {
	return add_query_arg(
		array(
			'text' => rawurlencode( html_entity_decode( get_the_title() ) ),
			'url'  => rawurlencode( get_the_permalink() ),
		),
		'https://twitter.com/share'
	);
}

/**
 * Get the Facebook social sharing URL for the current page.
 *
 * @author WDS
 * @return string
 */
function dctx_get_facebook_share_url() {
	return add_query_arg( 'u', rawurlencode( get_the_permalink() ), 'https://www.facebook.com/sharer/sharer.php' );
}

/**
 * Get the LinkedIn social sharing URL for the current page.
 *
 * @author WDS
 * @return string
 */
function dctx_get_linkedin_share_url() {
	return add_query_arg(
		array(
			'title' => rawurlencode( html_entity_decode( get_the_title() ) ),
			'url'   => rawurlencode( get_the_permalink() ),
		),
		'https://www.linkedin.com/shareArticle'
	);
}

/**
 * Display the social links saved in the customizer.
 *
 * @author WDS
 */
function dctx_display_social_network_links() {

	// Create an array of our social links for ease of setup.
	// Change the order of the networks in this array to change the output order.
	$social_networks = array( 'facebook', 'instagram', 'linkedin', 'twitter' );

	?>
	<ul class="social-icons">
		<?php
		// Loop through our network array.
		foreach ( $social_networks as $network ) :

			// Look for the social network's URL.
			$network_url = get_theme_mod( 'dctx_' . $network . '_link' );

			// Only display the list item if a URL is set.
			if ( ! empty( $network_url ) ) :
			?>
				<li class="social-icon <?php echo esc_attr( $network ); ?>">
					<a href="<?php echo esc_url( $network_url ); ?>">
						<?php
						dctx_display_svg(
							array(
								'icon' => $network . '-square',
							)
						);
						?>
						<span class="screen-reader-text">
						<?php
							echo /* translators: the social network name */ sprintf( esc_html( 'Link to %s', 'dctx' ), ucwords( esc_html( $network ) ) ); // WPCS: XSS OK.
						?>
						</span>
					</a>
				</li><!-- .social-icon -->
			<?php
			endif;
		endforeach;
		?>
	</ul><!-- .social-icons -->
	<?php
}

/**
 * Display a card.
 *
 * @author WDS
 * @param array $args Card defaults.
 */
function dctx_display_card( $args = array() ) {

	// Setup defaults.
	$defaults = array(
		'title' => '',
		'image' => '',
		'text'  => '',
		'url'   => '',
		'class' => '',
	);

	// Parse args.
	$args = wp_parse_args( $args, $defaults );
	?>
	<div class="<?php echo esc_attr( $args['class'] ); ?> card">

		<a href="<?php echo esc_url( $args['url'] ); ?>" tabindex="-1">
			<?php if ( $args['image'] ) : ?>
				<?php echo wp_kses_post( $args['image'] ); ?>
			<?php else : ?>
				<img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/images/placeholder.png" class="card-image" loading="lazy" alt="<?php echo sprintf( esc_attr( 'Featured image for %s', 'dctx' ), esc_attr( $args['title'] ) ); ?>">
			<?php endif; ?>
		</a>

		<div class="card-section">

		<?php if ( $args['title'] ) : ?>
			<h3 class="card-title"><a href="<?php echo esc_url( $args['url'] ); ?>"><?php echo esc_html( $args['title'] ); ?></a></h3>
		<?php endif; ?>

		<?php if ( $args['text'] ) : ?>
			<p class="card-text"><?php echo esc_html( $args['text'] ); ?></p>
		<?php endif; ?>

		<?php if ( $args['url'] ) : ?>
			<a class="button button-card" href="<?php echo esc_url( $args['url'] ); ?>"><?php esc_html_e( 'Read More', 'dctx' ); ?></a>
		<?php endif; ?>

		</div><!-- .card-section -->
	</div><!-- .card -->
	<?php
}

/**
 * Display header button.
 *
 * @author WDS
 * @author Corey Collins
 * @return string
 */
function dctx_display_header_button() {

	// Get our button setting.
	$button_setting = get_theme_mod( 'dctx_header_button' );

	// If we have no button displayed, don't display the markup.
	if ( 'none' === $button_setting ) {
		return '';
	}

	// Grab our button and text values.
	$button_url  = get_theme_mod( 'dctx_header_button_url' );
	$button_text = get_theme_mod( 'dctx_header_button_text' );
	?>
	<div class="site-header-action">
		<?php
		// If we're doing a URL, just make this LOOK like a button but be a link.
		if ( 'link' === $button_setting && $button_url ) :
		?>
			<a href="<?php echo esc_url( $button_url ); ?>" class="button button-link"><?php echo esc_html( $button_text ?: __( 'More Information', 'dctx' ) ); ?></a>
		<?php else : ?>
			<button type="button" class="cta-button" aria-expanded="false" aria-label="<?php esc_html_e( 'Search', 'dctx' ); ?>">
				<?php esc_html_e( 'Search', 'dctx' ); ?>
			</button>
			<div class="form-container" aria-hidden="true">
				<?php get_search_form(); ?>
			</div><!-- .form-container -->
		<?php endif; ?>
	</div><!-- .header-trigger -->
	<?php
}

/**
 * Displays numeric pagination on archive pages.
 *
 * @param array $args Array of params to customize output.
 *
 * @author WDS
 * @return void.
 * @author Corey Collins
 */
function dctx_display_numeric_pagination( $args = array() ) {

	// Set defaults.
	$defaults = array(
		'prev_text' => '&laquo;',
		'next_text' => '&raquo;',
		'mid_size'  => 4,
	);

	// Parse args.
	$args = wp_parse_args( $args, $defaults );

	if ( is_null( paginate_links( $args ) ) ) {
		return;
	}
	?>

	<nav class="pagination-container container" aria-label="<?php esc_html_e( 'numeric pagination', 'dctx' ); ?>">
		<?php echo paginate_links( $args ); // WPCS: XSS OK. ?>
	</nav>

	<?php
}

/**
 * Displays the mobile menu with off-canvas background layer.
 *
 * @return string An empty string if no menus are found at all.
 *
 * @author WDS
 * @author Corey Collins
 */
function dctx_display_mobile_menu() {

	// Bail if no mobile or primary menus are set.
	if ( ! has_nav_menu( 'mobile' ) && ! has_nav_menu( 'primary' ) ) {
		return '';
	}

	// Set a default menu location.
	$menu_location = 'primary';

	// If we have a mobile menu explicitly set, use it.
	if ( has_nav_menu( 'mobile' ) ) {
		$menu_location = 'mobile';
	}
	?>
	<div class="off-canvas-screen"></div>
	<nav class="off-canvas-container" aria-label="<?php esc_html_e( 'Mobile Menu', 'dctx' ); ?>" aria-hidden="true" tabindex="-1">
		<button type="button" class="off-canvas-close" aria-label="<?php esc_html_e( 'Close Menu', 'dctx' ); ?>">
			<span class="close"></span>
		</button>
		<?php
		// Mobile menu args.
		$mobile_args = array(
			'theme_location'  => $menu_location,
			'container'       => 'div',
			'container_class' => 'off-canvas-content',
			'container_id'    => '',
			'menu_id'         => 'site-mobile-menu',
			'menu_class'      => 'mobile-menu',
			'fallback_cb'     => false,
			'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
		);

		// Display the mobile menu.
		wp_nav_menu( $mobile_args );
		?>
	</nav>
	<?php
}

/**
 * Return bool for button text.
 *
 * @param [string] $key link array key.
 * @param [array]  $array link array.
 * @author jomurgel <jo@webdevstudios.com>
 * @since NEXT
 *
 * @return bool
 */
function dctx_has_array_key( $key, $array = array() ) {

	if ( ! is_array( $array ) || ( ! $array || ! $key ) ) {
		return false;
	}

	return is_array( $array ) && array_key_exists( $key, $array ) && ! empty( $array[ $key ] );
}
