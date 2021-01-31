<?php
/**
 * Muzeum Theme Customizer
 *
 * @package Muzeum
 * @since 1.0.0
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

 /* Call Custom Sanitization Functions */
require get_template_directory() . '/inc/customizer/sanitization-functions.php';


/* Customizer Helper Functions. */
require get_template_directory() . '/inc/customizer/customizer-helper.php';

/* Go Pro Section */
require get_template_directory() . '/inc/customizer/go-pro.php';

/**
 * Customize Colors Section in the theme customizer.
 *
 * @package muzeum
 * @since 1.0.0
 */

function muzeum_colors_section_customize( $wp_customize ) {

    // Call to Action Background color
    $wp_customize->add_setting(
        'header_btn_bgr_color',
        [
            'default'           => false,
            'sanitize_callback' => 'sanitize_hex_color',
        ]
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'header_btn_bgr_color',
            [
                'label'   => esc_html__( 'Header Button Background Color', 'muzeum' ),
                'section' => 'colors',
            ]
        )
    );

    // Call to Action Border color
    $wp_customize->add_setting(
        'header_btn_border_color',
        [
            'default'           => '#666',
            'sanitize_callback' => 'sanitize_hex_color',
        ]
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'header_btn_border_color',
            [
                'label'   => esc_html__( 'Header Button Border Color', 'muzeum' ),
                'section' => 'colors',
            ]
        )
    );

    // Call to Action Text color
    $wp_customize->add_setting(
        'header_btn_text_color',
        [
            'default'           => '#333',
            'sanitize_callback' => 'sanitize_hex_color',
        ]
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'header_btn_text_color',
            [
                'label'   => esc_html__( 'Header Button Text Color', 'muzeum' ),
                'section' => 'colors',
            ]
        )
    );

    // Primary Menu Background
    $wp_customize->add_setting(
        'main_nav_color',
        [
            'default'           => '#f1ddba',
            'sanitize_callback' => 'sanitize_hex_color',
        ]
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'main_nav_color',
            [
                'label'   => __( 'Primary Menu Color', 'muzeum' ),
                'section' => 'colors',
                'type'    => 'color',
            ]
        )
    );

    // Primary Menu Text Color
    $wp_customize->add_setting(
        'main_nav_text_color',
        [
            'default'           => '#000',
            'sanitize_callback' => 'sanitize_hex_color',
        ]
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'main_nav_text_color',
            [
                'label'   => esc_html__( 'Primary Menu Text Color', 'muzeum' ),
                'section' => 'colors',
            ]
        )
    );

    // Top Menu
    if ( has_nav_menu( 'menu-1' ) ) :

        // Top Menu Background
        $wp_customize->add_setting(
            'top_nav_color',
            [
                'default'           => '#b06500',
                'sanitize_callback' => 'sanitize_hex_color',
            ]
        );
        $wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize,
                'top_nav_color',
                [
                    'label'   => __( 'Top Menu Color', 'muzeum' ),
                    'section' => 'colors',
                    'type'    => 'color',
                ]
            )
        );

        // Top Menu Text Color
        $wp_customize->add_setting(
            'top_nav_text_color',
            [
                'default'           => '#fff',
                'sanitize_callback' => 'sanitize_hex_color',
            ]
        );
        $wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize,
                'top_nav_text_color',
                [
                    'label'   => esc_html__( 'Top Menu Text Color', 'muzeum' ),
                    'section' => 'colors',
                ]
            )
        );

    endif;

    // Headings color
    $wp_customize->add_setting(
        'headings_textcolor',
        [
            'default'           => '#333333',
            'sanitize_callback' => 'sanitize_hex_color',
        ]
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'headings_textcolor',
            [
                'label'   => esc_html__( 'Headings Text Color', 'muzeum' ),
                'section' => 'colors',
            ]
        )
    );

    // Links color
    $wp_customize->add_setting(
        'links_textcolor',
        [
            'default'           => '#253e80',
            'sanitize_callback' => 'sanitize_hex_color',
        ]
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'links_textcolor',
            [
                'label'   => esc_html__( 'Links Text Color', 'muzeum' ),
                'section' => 'colors',
            ]
        )
    );

    // Buttons color
    $wp_customize->add_setting(
        'btn_bgr_color',
        [
            'default'           => '#F2DEB9',
            'sanitize_callback' => 'sanitize_hex_color',
        ]
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'btn_bgr_color',
            [
                'label'   => esc_html__( 'Buttons Color', 'muzeum' ),
                'section' => 'colors',
            ]
        )
    );

    // Sidebar Links Text color
    $wp_customize->add_setting(
        'sidebar_link_textcolor',
        [
            'default'           => '#666',
            'sanitize_callback' => 'sanitize_hex_color',
        ]
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'sidebar_link_textcolor',
            [
                'label'   => esc_html__( 'Sidebar Links Color', 'muzeum' ),
                'section' => 'colors',
            ]
        )
    );

    // Enable custom logo
    if ( function_exists( 'the_custom_logo' ) ) :

        $wp_customize->add_setting(
            'show_default_logo',
            [
                'default'           => 1,
                'sanitize_callback' => 'muzeum_sanitize_checkbox',
                'transport'         => 'postMessage',
            ]
        );

        $wp_customize->add_control(
            'show_default_logo',
            [
                'label'   => esc_html__( 'Show Default Theme Logo', 'muzeum' ),
                'section' => 'title_tagline',
                'type'    => 'checkbox',
            ]
        );

    endif;

}

add_action( 'customize_register', 'muzeum_colors_section_customize' );


/**
 * Customize the Header Image Options Section in the theme customizer.
 *
 * @package muzeum
 * @since 1.0.1
 */

function muzeum_customize_register_banner_and_header( $wp_customize ) {

    $wp_customize->add_section(
        'header_options',
        [
            'title'       => esc_html__( 'Header Options', 'muzeum' ),
            'description' => esc_html__( 'Customize the header section and the call to action button on the header of the Homepage. To Change the colors of the call to action button, navigate to "Colors" section in the theme customizer', 'muzeum' ),
            'priority'    => 99,
        ]
    );

   // Header background size
   $wp_customize->add_setting(
       'header-background-size',
       [
           'default'           => 1,
           'sanitize_callback' => 'muzeum_sanitize_select',
       ]
   );

   $wp_customize->add_control(
       'header-background-size',
       [
           'label'       => esc_html__( 'Header Background Size', 'muzeum' ),
           'section'     => 'header_options',
           'description' => esc_html__( 'Resize the header image to adjust to the width of the whole screen or choose to keep its initial width.', 'muzeum' ),
           'type'        => 'select',
           'choices'     => [
               0 => esc_html( 'cover' ),
               1 => esc_html( 'initial' ),
           ],
       ]
   );

   // Header Image Position
   $wp_customize->add_setting(
       'header-background-position',
       [
           'default'           => 'top',
           'sanitize_callback' => 'muzeum_sanitize_select',
       ]
   );

   $wp_customize->add_control(
       'header-background-position',
       [
           'label'       => esc_html__( 'Header Background Position', 'muzeum' ),
           'section'     => 'header_options',
           'description' => esc_html__( 'Choose how you want to position the header image.', 'muzeum' ),
           'type'        => 'select',
           'choices'     => [
               'top'    => esc_html( 'top' ),
               'center' => esc_html( 'center' ),
               'bottom' => esc_html( 'bottom' ),
           ],
       ]
   );

   // Header Background Repeat
   $wp_customize->add_setting(
       'header-background-repeat',
       [
           'default'           => 1,
           'sanitize_callback' => 'muzeum_sanitize_select',
       ]
   );

   $wp_customize->add_control(
       'header-background-repeat',
       [
           'label'       => esc_html__( 'Header Background Repeat', 'muzeum' ),
           'section'     => 'header_options',
           'description' => esc_html__( 'Choose whether to repeat the header image in order to fill the header area. The default header image should be set to be repeated.', 'muzeum' ),
           'type'        => 'select',
           'choices'     => [
               0 => esc_html( 'no-repeat' ),
               1 => esc_html( 'repeat' ),
           ],
       ]
   );

   // Header Overlay

    function muzeum_customize_opacity_range() {
        return apply_filters(
            'muzeum_customize_opacity_range',
            [
                'min'  => 0,
                'max'  => 9,
                'step' => 1,
            ]
        );
    }

    $wp_customize->add_setting(
        'cover_template_overlay_opacity',
        [
            'default'           => '0',
			'sanitize_callback' => 'absint',
			'transport'         => 'postMessage',
        ]
    );

    $wp_customize->add_control(
        'cover_template_overlay_opacity',
        [
            'label'       => __( 'Header Image Overlay Opacity', 'muzeum' ),
            'description' => __( 'Make sure that the contrast is high enough so that the text is readable.', 'muzeum' ),
            'section'     => 'header_options',
            'type'        => 'range',
            'input_attrs' => muzeum_customize_opacity_range(),
        ]
    );

    /**
     * CALL TO ACTION button on homepage
     */

    // Banner label
    $wp_customize->add_setting(
        'banner_label',
        [
            'default'           => esc_html__( 'Get Started', 'muzeum' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        ]
    );

    $wp_customize->add_control(
        'banner_label',
        [
            'label'       => esc_html__( 'Banner Text', 'muzeum' ),
            'section'     => 'header_options',
            'description' => esc_html__( 'Change the default text of the call to action button in the header of the homepage. If you want to remove it, just keep this field empty', 'muzeum' ),
            'type'        => 'text',
        ]
    );

    // Banner Link
    $wp_customize->add_setting(
        'banner_link',
        [
            'default'           => '#',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'postMessage',
        ]
    );

    $wp_customize->add_control(
        'banner_link',
        [
            'label'       => esc_html__( 'Banner Link', 'muzeum' ),
            'section'     => 'header_options',
            'description' => esc_html__( 'Add link to the button. You can link it to the About page or the Contact page or to a specific section from the Homepage.', 'muzeum' ),
            'type'        => 'url',
        ]
    );

}

add_action( 'customize_register', 'muzeum_customize_register_banner_and_header' );

/**
 * Register Blog Settings Section in the theme customizer.
 *
 * @package muzeum
 * @since 1.0.0
 */
function muzeum_register_blog_theme_customizer( $wp_customize ) {
    $wp_customize->add_section(
        'blog_options',
        [
            'title'       => esc_html__( 'Post Settings', 'muzeum' ),
            'description' => esc_html__( 'Choose what type of post information to show in the post archives or individual blog posts. The post meta information includes published date, author, category tags or comments. You can display or remove this information if you want. You can also enable or disable breadcrumbs. Breadcrumbs can improve user experience by making it easier for your readers to navigate on the website.', 'muzeum' ),
        ]
    );
    /* Show categories entry meta */
    $wp_customize->add_setting(
        'show_post_categories',
        [
            'default'           => 1,
            'sanitize_callback' => 'muzeum_sanitize_checkbox',
        ]
    );
    $wp_customize->add_control(
        'show_post_categories',
        [
            'label'       => esc_html__( 'Show post categories', 'muzeum' ),
            'description' => esc_html__( 'Show the categories, associated to the post.', 'muzeum' ),
            'section'     => 'blog_options',
            'type'        => 'checkbox',
        ]
    );
    /* Show tags entry meta */
    $wp_customize->add_setting(
        'show_post_tags',
        [
            'default'           => 1,
            'sanitize_callback' => 'muzeum_sanitize_checkbox',
        ]
    );
    $wp_customize->add_control(
        'show_post_tags',
        [
            'label'       => esc_html__( 'Show post tags', 'muzeum' ),
            'description' => esc_html__( 'Show the tags, associated to the post.', 'muzeum' ),
            'section'     => 'blog_options',
            'type'        => 'checkbox',
        ]
    );
    /* Show Published date entry meta */
    $wp_customize->add_setting(
        'show_post_date',
        [
            'default'           => 1,
            'sanitize_callback' => 'muzeum_sanitize_checkbox',
        ]
    );
    $wp_customize->add_control(
        'show_post_date',
        [
            'label'       => esc_html__( 'Show post date', 'muzeum' ),
            'description' => esc_html__( 'Show the published date of the post.', 'muzeum' ),
            'section'     => 'blog_options',
            'type'        => 'checkbox',
        ]
    );
    /* Show Published author entry meta */
    $wp_customize->add_setting(
        'show_post_author',
        [
            'default'           => 1,
            'sanitize_callback' => 'muzeum_sanitize_checkbox',
        ]
    );
    $wp_customize->add_control(
        'show_post_author',
        [
            'label'       => esc_html__( 'Show post author', 'muzeum' ),
            'description' => esc_html__( 'Show the published date of the post.', 'muzeum' ),
            'section'     => 'blog_options',
            'type'        => 'checkbox',
        ]
    );
    /* Show Post Comments */
    $wp_customize->add_setting(
        'show_post_comments',
        [
            'default'           => 1,
            'sanitize_callback' => 'muzeum_sanitize_checkbox',
        ]
    );
    $wp_customize->add_control(
        'show_post_comments',
        [
            'label'       => esc_html__( 'Show Comments', 'muzeum' ),
            'description' => esc_html__( 'Display the number of comments.', 'muzeum' ),
            'section'     => 'blog_options',
            'type'        => 'checkbox',
        ]
    );
    /* Show or hide breadcrumbs */
    $wp_customize->add_setting(
        'show_breadcrumbs',
        [
            'default'           => 1,
            'sanitize_callback' => 'muzeum_sanitize_checkbox',
        ]
    );
    $wp_customize->add_control(
        'show_breadcrumbs',
        [
            'label'       => esc_html__( 'Show breadcrumbs on posts', 'muzeum' ),
            'description' => esc_html__( 'Show simple breadcrumps on single posts', 'muzeum' ),
            'section'     => 'blog_options',
            'type'        => 'checkbox',
        ]
    );

    $wp_customize->add_setting(
        'show_page_breadcrumbs',
        [
            'default'           => 1,
            'sanitize_callback' => 'muzeum_sanitize_checkbox',
        ]
    );
    $wp_customize->add_control(
        'show_page_breadcrumbs',
        [
            'label'       => esc_html__( 'Show breadcrumbs on pages', 'muzeum' ),
            'description' => esc_html__( 'Show simple breadcrumps on pages', 'muzeum' ),
            'section'     => 'blog_options',
            'type'        => 'checkbox',
        ]
    );

}

add_action( 'customize_register', 'muzeum_register_blog_theme_customizer' );


/**
 * Output the Customizer Color Section CSS to wp_head
 */
function muzeum_customizer_css() {

    $primary_menu_color = get_theme_mod( 'main_nav_color', '#f1ddba' );
    $primary_menu_link  = get_background_image();
    $top_menu_color     = get_theme_mod( 'top_nav_color', '#b06500' );

    $primary_menu_text_color = get_theme_mod( 'main_nav_text_color', '#000' );
    $top_menu_text_color     = get_theme_mod( 'top_nav_text_color', '#fff' );

    $links_text_color          = get_theme_mod( 'links_textcolor', '#253e80' );
    $headings_text_color       = get_theme_mod( 'headings_textcolor', '#333' );
    $sidebar_text_color        = get_theme_mod( 'sidebar_link_textcolor', '#666' );
    $call_to_action_bgr        = get_theme_mod( 'header_btn_bgr_color', false );
    $call_to_action_border     = get_theme_mod( 'header_btn_border_color', '#666' );
    $call_to_action_text_color = get_theme_mod( 'header_btn_text_color', '#333' );
    $btn_bgr_color             = get_theme_mod( 'btn_bgr_color', '#F2DEB9' );

    ?>

    <style>
        .main-nav {
            background-color: <?php echo esc_attr( $primary_menu_color ); // WPCS: XSS ok. ?>;
            <?php
            if ( ! empty( get_background_image() ) ) :
                ?>
                 background-image: url("<?php echo esc_url( get_background_image() ); ?>"); <?php endif; ?>
        }

        .main-nav li a:hover, .main-nav li.focus > a {
            background-color: <?php echo esc_attr( muzeum_brightness( $primary_menu_color, -35 ) ); // WPCS: XSS ok. ?>;
            <?php
            if ( ! empty( get_background_image() ) ) :
                ?>
                 background-image: url("<?php echo esc_url( get_background_image() ); ?>"); <?php endif; ?>
        }

        .main-nav .burger,
        .main-nav .burger::before,
        .main-nav .burger::after {
            border-bottom: 2px solid <?php echo esc_attr( $primary_menu_text_color ); ?>;
            transition: .12s all;
        }

        .main-nav a {
            color: <?php echo esc_attr( $primary_menu_text_color ); ?>;
        }

        @media (min-width:40em){

            .main-nav ul ul li {
                background-color: <?php echo esc_attr( muzeum_brightness( $primary_menu_color, -50 ) ); // WPCS: XSS ok. ?>;
                <?php
                if ( ! empty( get_background_image() ) ) :
                    ?>
                     background-image: url("<?php echo esc_url( get_background_image() ); ?>"); <?php endif; ?>

            }
            .main-nav li li a:hover,
            .main-nav li li.focus > a {
                background-color: <?php echo esc_attr( muzeum_brightness( $primary_menu_color, -75 ) ); // WPCS: XSS ok. ?>;
                <?php
                if ( ! empty( get_background_image() ) ) :
                    ?>
                     background-image: url("<?php echo esc_url( get_background_image() ); ?>"); <?php endif; ?>

            }

            .main-nav li li li.focus a {
                background-color: <?php echo esc_attr( muzeum_brightness( $primary_menu_color, -75 ) ); // WPCS: XSS ok. ?>;
                <?php
                if ( ! empty( get_background_image() ) ) :
                    ?>
                     background-image: url("<?php echo esc_url( get_background_image() ); ?>"); <?php endif; ?>

            }
        }

    <?php if ( has_nav_menu( 'menu-1' ) ) : ?>

        .top-nav,
        .top-nav .search-form .form-group input {
            background-color: <?php echo esc_attr( $top_menu_color ); // WPCS: XSS ok. ?>;
        }

        .top-nav input[type="search"]:-webkit-autofill,
        .top-nav input[type="search"]:-webkit-autofill:hover, 
        .top-nav input[type="search"]:-webkit-autofill:focus, 
        .top-nav input[type="search"]:-webkit-autofill:active  {
            -webkit-box-shadow: 0 0 0 30px <?php echo esc_attr( $top_menu_color ); ?> inset;
        }

        .top-nav li a:hover, .top-nav li.focus a {
            background-color: <?php echo esc_attr( muzeum_brightness( $top_menu_color, -15 ) ); // WPCS: XSS ok. ?>;
            transition: .3s;
        }

        .top-nav .burger,
        .top-nav .burger::before,
        .top-nav .burger::after {
            border-bottom: 2px solid <?php echo esc_attr( $top_menu_text_color ); ?>;
            transition: .12s all;
        }

        .top-nav a {
            color: <?php echo esc_attr( $top_menu_text_color ); ?>;
        }
        .top-search-form input::placeholder {
            color: <?php echo esc_attr( $top_menu_text_color ); ?>;
        }

        .top-nav input[type="search"]:-webkit-autofill {
            -webkit-text-fill-color: <?php echo esc_attr( $top_menu_text_color ); ?>;
            caret-color: <?php echo esc_attr( $top_menu_text_color ); ?>;
        }

        @media (min-width:40em){

            .top-nav ul ul li {
                background-color: <?php echo esc_attr( muzeum_brightness( $top_menu_color, -25 ) ); // WPCS: XSS ok. ?>;
            }
            .top-nav li li a:hover,
            .top-nav li li.focus > a {
                background-color: <?php echo esc_attr( muzeum_brightness( $top_menu_color, -35 ) ); // WPCS: XSS ok. ?>;
            }
            .top-nav li li li.focus a {
                background-color: <?php echo esc_attr( muzeum_brightness( $top_menu_color, -35 ) ); // WPCS: XSS ok. ?>;
            }

        }

    <?php endif; ?>

        a {
            color: <?php echo esc_attr( $links_text_color ); ?>;
        }

        .entry-title a, .call-to-action a {
            color: <?php echo esc_attr( $headings_text_color ); ?>;
        }

        <?php if ( $call_to_action_border ) : ?>
        .call-to-action, .call-to-action:hover {
            border: 1px solid <?php echo esc_attr( $call_to_action_border ); ?>;
        }
        <?php endif; ?>

        <?php if ( $call_to_action_bgr ) : ?>
        .call-to-action{
            background: <?php echo esc_attr( $call_to_action_bgr ); ?>;
        }
        <?php endif; ?>

        .call-to-action a {
            color: <?php echo esc_attr( $call_to_action_text_color ); ?>;
        }

        .widget ul a {
            color: <?php echo esc_attr( $sidebar_text_color ); ?>;
        }

        button,
            input[type="button"],
            input[type="reset"],
            input[type="submit"] {
                background: <?php echo esc_attr( $btn_bgr_color ); ?>;
        }

    </style>
    <?php
}
add_action( 'wp_head', 'muzeum_customizer_css' );
