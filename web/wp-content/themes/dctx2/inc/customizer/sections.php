<?php
/**
 * Customizer sections.
 *
 * @package dctx
 */

/**
 * Register the section sections.
 *
 * @author WDS
 * @param object $wp_customize Instance of WP_Customize_Class.
 */
function dctx_customize_sections( $wp_customize ) {

	// Register additional scripts section.
	$wp_customize->add_section(
		'dctx_additional_scripts_section',
		array(
			'title'    => esc_html__( 'Additional Scripts', 'dctx' ),
			'priority' => 10,
			'panel'    => 'site-options',
		)
	);

	// Register a social links section.
	$wp_customize->add_section(
		'dctx_social_links_section',
		array(
			'title'       => esc_html__( 'Social Media', 'dctx' ),
			'description' => esc_html__( 'Links here power the display_social_network_links() template tag.', 'dctx' ),
			'priority'    => 90,
			'panel'       => 'site-options',
		)
	);

	// Register a header section.
	$wp_customize->add_section(
		'dctx_header_section',
		array(
			'title'    => esc_html__( 'Header Customizations', 'dctx' ),
			'priority' => 90,
			'panel'    => 'site-options',
		)
	);

	// Register a footer section.
	$wp_customize->add_section(
		'dctx_footer_section',
		array(
			'title'    => esc_html__( 'Footer Customizations', 'dctx' ),
			'priority' => 90,
			'panel'    => 'site-options',
		)
	);
}
add_action( 'customize_register', 'dctx_customize_sections' );
