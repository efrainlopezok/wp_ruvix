<?php
/**
 * Ruvix Landing
 *
 * 
 *
 * @package Ruvix Landin
 * @author  Ruvix
 * @license GPL-2.0+
 * @link    http://www.ruvix.com/
 */

add_action( 'customize_register', 'ruvix_landing_customizer_register' );
/**
 * Register settings and controls with the Customizer.
 *
 * @since 2.2.3
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function ruvix_landing_customizer_register( $wp_customize ) {

	$wp_customize->add_setting(
		'ruvix_landing_link_color',
		array(
			'default'           => ruvix_landing_customizer_get_default_link_color(),
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'ruvix_landing_link_color',
			array(
				'description' => __( 'Change the color of post info links, hover color of linked titles, hover color of menu items, and more.', 'ruvix-landing' ),
				'label'       => __( 'Link Color', 'ruvix-landing' ),
				'section'     => 'colors',
				'settings'    => 'ruvix_landing_link_color',
			)
		)
	);

	$wp_customize->add_setting(
		'ruvix_landing_accent_color',
		array(
			'default'           => ruvix_landing_customizer_get_default_accent_color(),
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'ruvix_landing_accent_color',
			array(
				'description' => __( 'Change the default hovers color for button.', 'ruvix-landing' ),
				'label'       => __( 'Accent Color', 'ruvix-landing' ),
				'section'     => 'colors',
				'settings'    => 'ruvix_landing_accent_color',
			)
		)
	);

}
