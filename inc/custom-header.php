<?php
/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php the_header_image_tag(); ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package Muzeum
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses muzeum_header_style()
 */

register_default_headers( array(
    'default-image' => array(
        'url'           => get_template_directory_uri() . '/static/img/transparent-header.png',
        'thumbnail_url' => get_template_directory_uri() . '/static/img/transparent-header.png',
        'description'   => __( 'Default Header Image', 'muzeum' )
    ),
) );

function muzeum_custom_header_setup() {
	add_theme_support(
		'custom-header',
		apply_filters(
			'muzeum_custom_header_args',
			array(
				'default-image'      => get_template_directory_uri() . '/static/img/transparent-header.png',
				'default-text-color' => '000000',
				'width'              => 2200,
				'height'             => 370,
				'flex-height'        => true,
				'wp-head-callback'   => 'muzeum_header_style',
			)
		)
	);
}
add_action( 'after_setup_theme', 'muzeum_custom_header_setup' );

if ( ! function_exists( 'muzeum_header_style' ) ) :
	/**
	 * Styles the header image and text displayed on the blog.
	 *
	 * @see muzeum_custom_header_setup().
	 */
	function muzeum_header_style() {
		$header_text_color = get_header_textcolor();

		/*
		 * If no custom options for text are set, let's bail.
		 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
		 */
		if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
			//return;
		}

		// If we get this far, we have custom styles. Let's do this.
		?>
		<style type="text/css">
		<?php if (has_header_image()) : ?>
			.site-branding {
				background-image: url(<?php header_image(); ?>);
				background-repeat: no-repeat;
				background-size: cover;
			}
		<?php endif;	
		// Has the text been hidden?
		if ( ! display_header_text() ) :
			?>
			.site-title,
			.site-description {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
				}
			<?php
			// If the user has set a custom color for the text use that.
		else :
			?>
			.site-title a,
			.site-description {
				color: #<?php echo esc_attr( $header_text_color ); ?>;
			}
		<?php endif; ?>
		</style>
		<?php
	}
endif;
