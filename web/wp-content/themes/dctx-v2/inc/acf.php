<?php
/**
 * Custom ACF functions.
 *
 * A place to custom functionality related to Advanced Custom Fields.
 *
 * @package dctx
 */

// If ACF isn't activated, then bail.
if ( ! class_exists( 'acf' ) ) {
	return false;
}

/**
 * Associate the possible block options with the appropriate section.
 *
 * @author WDS
 * @param  array $args Possible arguments.
 */
function dctx_display_block_options( $args = array() ) {

	// Get block background options.
	$background_options = get_sub_field( 'background_options' ) ? get_sub_field( 'background_options' ) : get_field( 'background_options' )['background_options'];

	// Get block other options.
	$other_options = array();

	// Set our Other Options if we have them. Some blocks may not.
	if ( get_sub_field( 'other_options' ) ) {
		$other_options = get_sub_field( 'other_options' );
	} elseif ( get_field( 'other_options' ) ) {
		$other_options = get_field( 'other_options' )['other_options'];
	}

	// Get block display options.
	$display_options = array();

	// Set our Display Options if we have them. Some blocks may not.
	if ( get_sub_field( 'display_options' ) ) {
		$display_options = get_sub_field( 'display_options' );
	} elseif ( get_field( 'display_options' ) ) {
		$display_options = get_field( 'display_options' )['display_options'];
	}

	// Get the block ID.
	$block_id = dctx_get_block_id( $args['block'] );

	// Setup defaults.
	$defaults = array(
		'background_type' => $background_options['background_type']['value'],
		'container'       => 'section',
		'class'           => 'content-block',
		'font_color'      => $display_options['font_color'],
		'id'              => $block_id,
	);

	// Parse args.
	$args = wp_parse_args( $args, $defaults );

	$background_video_markup = $background_image_markup = '';

	// Show overlay class, if it exists.
	$has_show_overlay = dctx_has_array_key( 'show_overlay', $background_options ) && true === $background_options['show_overlay'] ? ' has-overlay' : '';

	// Only try to get the rest of the settings if the background type is set to anything.
	if ( $args['background_type'] ) {
		if ( 'color' === $args['background_type'] && $background_options['background_color']['color_picker'] ) {
			$background_color = $background_options['background_color']['color_picker'];
			$args['class']   .= ' has-background color-as-background background-' . esc_attr( $background_color );
		}

		if ( 'image' === $args['background_type'] && $background_options['background_image'] ) {
			$background_image = $background_options['background_image'];

			// Construct class.
			$args['class'] .= ' has-background image-as-background' . esc_attr( $has_show_overlay );
			ob_start();
			?>
			<figure class="image-background" aria-hidden="true">
				<?php echo wp_get_attachment_image( $background_image['id'], 'full' ); ?>
			</figure>
			<?php
			$background_image_markup = ob_get_clean();
		}

		if ( 'video' === $args['background_type'] ) {
			$background_video      = $background_options['background_video'];
			$background_video_webm = $background_options['background_video_webm'];
			$background_title      = $background_options['background_video_title'];
			$args['class']        .= ' has-background video-as-background' . esc_attr( $has_show_overlay );
			// Translators: get the title of the video.
			$background_alt = $background_title ? sprintf( esc_attr( 'Video Background of %s', 'dctx' ), esc_attr( $background_options['background_video_title'] ) ) : __( 'Video Background', 'dctx' );

			ob_start();
			?>
				<video class="video-background" autoplay muted loop preload="auto" aria-hidden="true"<?php echo $background_title ? ' title="' . esc_attr( $background_title ) . '"' : ''; ?>>
						<?php if ( $background_video_webm['url'] ) : ?>
						<source src="<?php echo esc_url( $background_video_webm['url'] ); ?>" type="video/webm">
						<?php endif; ?>

						<?php if ( $background_video['url'] ) : ?>
						<source src="<?php echo esc_url( $background_video['url'] ); ?>" type="video/mp4">
						<?php endif; ?>
				</video>
				<button class="video-toggle"><span class="screen-reader-text"><?php esc_html_e( 'Toggle video playback', 'dctx' ); ?></span></button>
			<?php
			$background_video_markup = ob_get_clean();
		}

		if ( 'none' === $args['background_type'] ) {
			$args['class'] .= ' no-background';
		}
	}

	// Set the custom font color.
	if ( $args['font_color']['color_picker'] ) {
		$args['class'] .= ' has-font-color color-' . esc_attr( $args['font_color']['color_picker'] );
	}

	// Print our block container with options.
	printf(
		'<%s id="%s" class="%s">',
		esc_attr( $args['container'] ),
		esc_attr( $args['id'] ),
		esc_attr( $args['class'] )
	);

	// If we have a background video, echo our background video markup inside the block container.
	if ( $background_video_markup ) {
		echo $background_video_markup; // WPCS XSS OK.
	}

	// If we have a background image, echo our background image markup inside the block container.
	if ( $background_image_markup ) {
		echo $background_image_markup; // WPCS XSS OK.
	}
}

/**
 * Decide whether or not a block has expired.
 *
 * @author WDS
 * @param array $args start and end dates.
 *
 * @return bool
 */
function dctx_has_block_expired( $args = array() ) {

	// Setup defaults.
	$defaults = array(
		'start_date' => '',
		'end_date'   => '',
	);

	// Parse args.
	$args = wp_parse_args( $args, $defaults );

	// Get (Unix) times and convert to integer.
	$now   = (int) current_time( 'timestamp' );
	$start = (int) $args['start_date'];
	$end   = (int) $args['end_date'];

	// No dates? Cool, they're optional.
	if ( empty( $start ) || empty( $end ) ) {
		return false;
	}

	// The block has started, but hasn't expired yet.
	if ( $start <= $now && $end >= $now ) {
		return false;
	}

	// Yes, the block has expired.
	return true;
}

/**
 * Update Layout Titles with Subfield Image and Text Fields
 *
 * @author WDS
 * @param string $block_title Default Field Title.
 * @param array  $field Field array.
 * @param string $layout Layout type.
 * @param int    $i number.
 *
 * @url https://support.advancedcustomfields.com/forums/topic/flexible-content-blocks-friendlycustom-collapsed-name/
 *
 * @return string new ACF title.
 */
function dctx_acf_flexible_content_layout_title( $block_title, $field, $layout, $i ) {

	// Current ACF field name.
	$current_title = $block_title;

	// Remove layout title from text.
	$block_heading = '';

	// Set an expired var.
	$expired = '';

	// Get other options.
	$other_options = get_sub_field( 'other_options' ) ? get_sub_field( 'other_options' ) : get_field( 'other_options' )['other_options'];

	// Get Background Type.
	$background = get_sub_field( 'background_options' )['background_type']['value'];

	// If there's no background, just move along...
	if ( 'none' !== $background ) {
		$background_repeater = get_sub_field( 'carousel_slides' )[0]['background_options']['background_type']['value'];
		$background_type     = $background ? $background : $background_repeater;

		$type = dctx_return_flexible_content_layout_value( $background_type );

		// Load image from non-repeater sub field background image, if it exists else Load image from repeater sub field background image, if it exists - Hero.
		if ( 'image' === $background_type ) {
			$block_heading .= '<img src="' . esc_url( $type['sizes']['thumbnail'] ) . '" height="30" width="30" class="acf-flexible-title-image" />';
		}

		if ( 'video' === $background_type ) {
			$block_heading .= '<div style="font-size: 30px; height: 26px; width: 30px;" class="dashicons dashicons-format-video acf-flexible-title-image"><span class="screen-reader-text">' . esc_html__( 'Video', 'dctx' ) . '</span></div>';
		}
	}

	// Set default field title. Don't want to lose this.
	$block_heading .= '<strong>' . esc_html( $current_title ) . '</strong>';

	// ACF Flexible Content Title Fields.
	$block_title = get_sub_field( 'title' );
	$headline    = get_sub_field( 'carousel_slides' )[0]['title'];
	$text        = $block_title ? $block_title : $headline;
	$start_date  = $other_options['start_date'];
	$end_date    = $other_options['end_date'];

	// If the block has expired, add "(expired)" to the title.
	if ( dctx_has_block_expired(
			array(
				'start_date' => $start_date,
				'end_date'   => $end_date,
			)
		)
	) {
		$expired .= '<span style="color: red;">&nbsp;(' . esc_html__( 'expired', 'dctx' ) . ')</span>';
	}

	// Load title field text else Load headline text - Hero.
	if ( $text ) {
		$block_heading .= '<span class="acf-flexible-content-headline-title"> - ' . $text . '</span>';
	}

	// Return New Title.
	return $block_heading . $expired;
}
add_filter( 'acf/fields/flexible_content/layout_title/name=content_blocks', 'dctx_acf_flexible_content_layout_title', 10, 4 );

/**
 * Return flexible content field value by type
 *
 * @param string $type field type.
 * @author WDS
 * @return string field value.
 */
function dctx_return_flexible_content_layout_value( $type ) {

	if ( empty( $type ) ) {
		return;
	}

	$background_type          = get_sub_field( 'background_options' )[ "background_{$type}" ];
	$background_type_repeater = get_sub_field( 'carousel_slides' )[0]['background_options'][ "background_{$type}" ];

	return $background_type ? $background_type : $background_type_repeater;
}

if ( function_exists( 'dctx_acf_flexible_content_layout_title' ) ) {

	/**
	 * Set Admin Styles for Flexible Content Layout Image/Title in dctx_acf_flexible_content_layout_title().
	 *
	 * @author WDS
	 */
	function dctx_flexible_content_layout_title_acf_admin_head() {
	?>
	<style type="text/css">
		.acf-flexible-content .layout .acf-fc-layout-handle {
			display: flex;
			align-items: center;
		}

		.acf-flexible-title-image,
		.acf-flexible-content .layout .acf-fc-layout-order {
			margin-right: 10px;
		}

		.acf-flexible-content-headline-title {
			display: inline-block;
			margin-left: 8px;
		}
	</style>
	<?php
	}
	add_action( 'acf/input/admin_head', 'dctx_flexible_content_layout_title_acf_admin_head' );
}

/**
 * Load colors dynamically into select field from dctx_get_theme_colors()
 *
 * @author WDS
 * @param array $field field options.
 * @return array new field choices.
 *
 * @author Corey Colins <corey@webdevstudios.com>
 */
function dctx_acf_load_color_picker_field_choices( $field ) {

	// Reset choices.
	$field['choices'] = array();

	// Grab our colors array.
	$colors = dctx_get_theme_colors();

	// Loop through colors.
	foreach ( $colors as $key => $color ) {

		// Create display markup.
		$color_output = '<div style="display: flex; align-items: center;"><span style="background-color:' . esc_attr( $color ) . '; border: 1px solid #ccc;display:inline-block; height: 15px; margin-right: 10px; width: 15px;"></span>' . esc_html( $key ) . '</div>';

		// Set values.
		$field['choices'][ sanitize_title( $key ) ] = $color_output;
	}

	// Return the field.
	return $field;
}
add_filter( 'acf/load_field/name=color_picker', 'dctx_acf_load_color_picker_field_choices' );

/**
 * Get the theme colors for this project. Set these first in the Sass partial then migrate them over here.
 *
 * @author WDS
 * @return array The array of our color names and hex values.
 * @author Corey Collins
 */
function dctx_get_theme_colors() {
	return array(
		esc_html__( 'Alto', 'dctx' )           => '#ddd',
		esc_html__( 'Black', 'dctx' )          => '#000',
		esc_html__( 'Blue', 'dctx' )           => '#21759b',
		esc_html__( 'Cod Gray', 'dctx' )       => '#111',
		esc_html__( 'Dove Gray', 'dctx' )      => '#666',
		esc_html__( 'Gallery', 'dctx' )        => '#eee',
		esc_html__( 'Gray', 'dctx' )           => '#808080',
		esc_html__( 'Gray Alt', 'dctx' )       => '#929292',
		esc_html__( 'Light Yellow', 'dctx' )   => '#fff9c0',
		esc_html__( 'Mineshaft', 'dctx' )      => '#333',
		esc_html__( 'Silver', 'dctx' )         => '#ccc',
		esc_html__( 'Silver Chalice', 'dctx' ) => '#aaa',
		esc_html__( 'White', 'dctx' )          => '#fff',
		esc_html__( 'Whitesmoke', 'dctx' )     => '#f1f1f1',
	);
}

/**
 * Adds h1 or h2 heading for hero based on location.
 *
 * @author WDS
 * @param string $block_title acf value.
 * @author jomurgel <jo@webdevstudios.com>
 * @return void
 */
function dctx_display_hero_heading( $block_title ) {

	// Bail if our title is empty.
	if ( empty( $block_title ) ) {
		return;
	}

	// Set hero title to h1 if it's the first block not on the homepage.
	$index   = get_row_index();
	$heading = 1 === $index && ! ( is_front_page() && is_home() ) ? 'h1' : 'h2';

	echo sprintf( '<%1$s class="hero-title">%2$s</%1$s>', esc_attr( $heading ), esc_html( $block_title ) );
}

/**
 * Echo link function
 *
 * @param array $args defaults args - link array and whether or not to append button class.
 * @author jomurgel <jo@webdevstudios.com>
 * @since NEXT
 */
function dctx_display_link( $args = array() ) {
	echo dctx_get_link( $args ); // WPCS: XSS Ok.
}

/**
 * Get link markup from button/link array.
 *
 * @param array $args defaults args - link array and whether or not to append button class.
 * @author jomurgel <jo@webdevstudios.com>
 * @since NEXT
 *
 * @return string button markup.
 */
function dctx_get_link( $args = array() ) {

	// Defaults.
	$defaults = array(
		'button' => false, // display as button?
		'class'  => '',
		'link'   => get_field( 'button_link' ),
	);

	// Parse those args.
	$args = wp_parse_args( $args, $defaults );

	// Make args pretty readable and default.
	$button_array = $args['link'] ?: $defaults['link'];

	// Start output buffer.
	ob_start();

	if ( ! is_array( $button_array ) ) {
		ob_get_clean();
		return;
	}

	// Append button class if button exists.
	$classes = $args['button'] ? ' button' : '';

	// Append class.
	$classes .= ' ' . $args['class'];

	// Get title else default to "Read More".
	$title = dctx_has_array_key( 'title', $button_array ) ? $button_array['title'] : esc_html__( 'Read More', 'dctx' );

	// Get url.
	$url = dctx_has_array_key( 'url', $button_array ) ? $button_array['url'] : '';

	// Get target, else default internal.
	$target = dctx_has_array_key( 'target', $button_array ) ? $button_array['target'] : '_self';
	?>

	<a href="<?php echo esc_url( $url ); ?>" class="<?php echo esc_attr( $classes ); ?>" target="<?php echo esc_attr( $target ); ?>"><?php echo esc_html( $title ); ?></a>

	<?php
	// Return output buffer value.
	return ob_get_clean();
}
