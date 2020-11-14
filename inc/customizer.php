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

 /* Call Custom Sanitization Functions */
require get_template_directory() . '/inc/sanitization-functions.php';


/**
 * Customizer Helper Functions.
 *
 */

require get_template_directory() . '/inc/customizer-helper.php';

/**
 * Customize Colors Section in the theme customizer.
 *
 * @package muzeum
 * @since 1.0.0
 */

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


/**
 * Register Blog Settings Section in the theme customizer.
 *
 * @package muzeum
 * @since 1.0.0
 */
function muzeum_register_blog_theme_customizer( $wp_customize ) {
    $wp_customize->add_section( 'blog_options', array(
        'title'       => esc_html__( 'Post Settings', 'muzeum' ),
        'description' => esc_html__( 'Choose what post meta information to show in the post archives or individual blog posts. The post meta information includes published date, author, category tags or comments. You can display or remove this information if you want.', 'muzeum' ),
	) );
	/* Show categories entry meta */
    $wp_customize->add_setting( 'show_post_categories', array(
        'default'           => 1,
        'sanitize_callback' => 'muzeum_sanitize_checkbox',
    ) );
    $wp_customize->add_control( 'show_post_categories', array(
        'label'       => esc_html__( 'Show post categories', 'muzeum' ),
        'description' => esc_html__( 'Show the categories, associated to the post.', 'muzeum' ),
        'section'     => 'blog_options',
        'type'        => 'checkbox',
    ) );
    /* Show tags entry meta */
    $wp_customize->add_setting( 'show_post_tags', array(
        'default'           => 1,
        'sanitize_callback' => 'muzeum_sanitize_checkbox',
    ) );
    $wp_customize->add_control( 'show_post_tags', array(
        'label'       => esc_html__( 'Show post tags', 'muzeum' ),
        'description' => esc_html__( 'Show the tags, associated to the post.', 'muzeum' ),
        'section'     => 'blog_options',
        'type'        => 'checkbox',
    ) );
    /* Show Published date entry meta */
    $wp_customize->add_setting( 'show_post_date', array(
        'default'           => 1,
        'sanitize_callback' => 'muzeum_sanitize_checkbox',
    ) );
    $wp_customize->add_control( 'show_post_date', array(
        'label'       => esc_html__( 'Show post date', 'muzeum' ),
        'description' => esc_html__( 'Show the published date of the post.', 'muzeum' ),
        'section'     => 'blog_options',
        'type'        => 'checkbox',
    ) );
    /* Show Published author entry meta */
    $wp_customize->add_setting( 'show_post_author', array(
        'default'           => 1,
        'sanitize_callback' => 'muzeum_sanitize_checkbox',
    ) );
    $wp_customize->add_control( 'show_post_author', array(
        'label'       => esc_html__( 'Show post author', 'muzeum' ),
        'description' => esc_html__( 'Show the published date of the post.', 'muzeum' ),
        'section'     => 'blog_options',
        'type'        => 'checkbox',
	) );
	/* Show Post Comments */
    $wp_customize->add_setting( 'show_post_comments', array(
        'default'           => 1,
        'sanitize_callback' => 'muzeum_sanitize_checkbox',
    ) );
    $wp_customize->add_control( 'show_post_comments', array(
        'label'       => esc_html__( 'Show Comments', 'muzeum' ),
        'description' => esc_html__( 'Display the number of comments.', 'muzeum' ),
        'section'     => 'blog_options',
        'type'        => 'checkbox',
    ) );

}

add_action( 'customize_register', 'muzeum_register_blog_theme_customizer' );