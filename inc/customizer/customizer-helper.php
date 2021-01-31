<?php

function muzeum_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'muzeum_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'muzeum_customize_partial_blogdescription',
			)
		);
	}
}
add_action( 'customize_register', 'muzeum_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function muzeum_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function muzeum_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function muzeum_customize_preview_js() {
	wp_enqueue_script( 'muzeum-customizer', get_template_directory_uri() . '/static/js/customizer.js', array( 'customize-preview' ), MUZEUM_VERSION, true );
	wp_enqueue_style( 'muzeum-customize-css', get_template_directory_uri() . '/static/css/customizer.css', array('customize-preview' ), MUZEUM_VERSION );
}
add_action( 'customize_preview_init', 'muzeum_customize_preview_js' );


/**
 * Get lighter/darker color when given a hex value.
 *
 * @param string $hex Get the hex value from the customizer api.
 * @param int $steps Steps should be between -255 and 255. Negative = darker, positive = lighter.
 * @link https://wordpress.org/themes/scaffold
 * @license GPL-2.0-or-later
 * @since 1.0.0
 * 
 */

function muzeum_brightness( $hex, $steps ) {

	$steps = max( -255, min( 255, $steps ) );

	// Normalize into a six character long hex string.
	$hex = str_replace( '#', '', $hex );
	if ( strlen( $hex ) === 3 ) {
		$hex = str_repeat( substr( $hex, 0, 1 ), 2 ) . str_repeat( substr( $hex, 1, 1 ), 2 ) . str_repeat( substr( $hex, 2, 1 ), 2 );
	}

	// Split into three parts: R, G and B.
	$color_parts = str_split( $hex, 2 );
	$return      = '#';

	foreach ( $color_parts as $color ) {
		$color   = hexdec( $color ); // Convert to decimal.
		$color   = max( 0, min( 255, $color + $steps ) ); // Adjust color.
		$return .= str_pad( dechex( $color ), 2, '0', STR_PAD_LEFT ); // Make two char hex code.
	}

	return sanitize_hex_color( $return );
}

/* Check to show or hide breadcrumbs */
function muzeum_show_breadcrumbs(){
	
	return is_single() ? get_theme_mod( 'show_breadcrumbs', 1 ) : get_theme_mod( 'show_page_breadcrumbs', 1 );

}