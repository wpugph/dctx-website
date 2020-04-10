<?php
/**
 * Customizer panels.
 *
 * @package dctx
 */

/**
 * Add a custom panels to attach sections too.
 *
 * @author WDS
 * @param object $wp_customize Instance of WP_Customize_Class.
 */
function dctx_customize_panels( $wp_customize ) {

	// Register a new panel.
	$wp_customize->add_panel(
		'site-options',
		array(
			'priority'       => 10,
			'capability'     => 'edit_theme_options',
			'theme_supports' => '',
			'title'          => esc_html__( 'Site Options', 'dctx' ),
			'description'    => esc_html__( 'Other theme options.', 'dctx' ),
		)
	);
}
add_action( 'customize_register', 'dctx_customize_panels' );
