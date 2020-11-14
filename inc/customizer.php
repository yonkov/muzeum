<?php
/**
 * Muzeum Theme Customizer
 *
 * @package Muzeum
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
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
	wp_enqueue_script( 'muzeum-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), MUZEUM_VERSION, true );
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

/* Customize Color Sections */

function muzeum_colors_section_customize ($wp_customize) {

	//Primary Menu Background
	$wp_customize->add_setting( 'main_nav_color' , array(
		'default'     => "#7c5c0a",
        'sanitize_callback' => 'sanitize_hex_color'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'main_nav_color', array(
		'label'        => __( 'Primary Menu Color', 'muzeum' ),
		'section'    => 'colors',
		'type'     => 'color',
	) ) );

	//Primary Menu Text Color
    $wp_customize->add_setting('main_nav_text_color', array(
        'default' => '#fff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'main_nav_text_color', array(
        'label' => esc_html__('Primary Menu Text Color', 'muzeum'),
        'section' => 'colors',
	)));
	
	//Top Menu
	if ( has_nav_menu( 'menu-1' ) ) :

		//Top Menu Background
		$wp_customize->add_setting( 'top_nav_color' , array(
			'default'     => "#7c3c0a",
			'sanitize_callback' => 'sanitize_hex_color'
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'top_nav_color', array(
			'label'        => __( 'Top Menu Color', 'muzeum' ),
			'section'    => 'colors',
			'type'     => 'color',
		) ) );

		//Top Menu Text Color
		$wp_customize->add_setting('top_nav_text_color', array(
			'default' => '#fff',
			'sanitize_callback' => 'sanitize_hex_color',
		));
		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'top_nav_text_color', array(
			'label' => esc_html__('Top Menu Text Color', 'muzeum'),
			'section' => 'colors',
		)));
	
	endif;

	// Enable custom logo
	if (function_exists('the_custom_logo')) :
	
		$wp_customize->add_setting( 'show_default_logo', array(
				'default' => 1,
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control('show_default_logo', array(
				'label' => esc_html__('Show Default Theme Logo', 'muzeum'),
				'section' => 'title_tagline',
				'type' => 'checkbox',
			)
		);

	endif;
	
}

add_action('customize_register', 'muzeum_colors_section_customize');

/**
 * Output the Customizer CSS to wp_head
 */
function muzeum_customizer_css() {

	$primary_menu_color = get_theme_mod( 'main_nav_color', '#7c5c0a');
	$top_menu_color = get_theme_mod( 'top_nav_color', '#7c3c0a' ); 
	
	$primary_menu_text_color = get_theme_mod('main_nav_text_color', '#fff'); 
	$top_menu_text_color = get_theme_mod('top_nav_text_color', '#fff'); 
	
	?>

	<style>
		.main-nav {
			background-color: <?php echo sanitize_hex_color( $primary_menu_color ); // WPCS: XSS ok. ?>;
		}

		.main-nav li:hover, .main-nav li.focus {
			background-color: <?php echo muzeum_brightness( $primary_menu_color, -20 ); // WPCS: XSS ok. ?>;
		}

		.main-nav .menu-toggle {
			background-color: <?php echo sanitize_hex_color( $primary_menu_color ); // WPCS: XSS ok. ?>;
		}

		.main-nav.toggled .menu-toggle {
			background-color: <?php echo muzeum_brightness( $primary_menu_color, -50 ); // WPCS: XSS ok. ?>;
		}

		.main-nav a {
			color: <?php echo esc_attr($primary_menu_text_color); ?>;
		}

		@media (min-width:40em){

			.main-nav ul ul li {
				background-color: <?php echo muzeum_brightness( $primary_menu_color, -35 ); // WPCS: XSS ok. ?>;
			}
			.main-nav li li:hover,
			.main-nav li li.focus {
				background-color: <?php echo muzeum_brightness( $primary_menu_color, -50 ); // WPCS: XSS ok. ?>;
			}
		}

	<?php if ( has_nav_menu( 'menu-1' ) ) : ?>

		.top-nav {
			background-color: <?php echo sanitize_hex_color( $top_menu_color ); // WPCS: XSS ok. ?>;
		}

		.top-nav li:hover, .top-nav li.focus {
			background-color: <?php echo muzeum_brightness( $top_menu_color, -20 ); // WPCS: XSS ok. ?>;
		}

		.top-nav .menu-toggle {
			background-color: <?php echo sanitize_hex_color( $top_menu_color ); // WPCS: XSS ok. ?>;
		}

		.top-nav.toggled .menu-toggle {
			background-color: <?php echo muzeum_brightness( $top_menu_color, -50 ); // WPCS: XSS ok. ?>;
		}

		.top-nav a {
			color: <?php echo esc_attr($top_menu_text_color); ?>;
		}

		@media (min-width:40em){

			.top-nav ul ul li {
				background-color: <?php echo muzeum_brightness( $top_menu_color, -35 ); // WPCS: XSS ok. ?>;
			}
			.top-nav li li:hover,
			.top-nav li li.focus {
				background-color: <?php echo muzeum_brightness( $top_menu_color, -50 ); // WPCS: XSS ok. ?>;
			}

		}

	<?php endif; ?>

	</style>
	<?php
}
add_action( 'wp_head', 'muzeum_customizer_css' );