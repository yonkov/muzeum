<?php
/**
 * Sample implementation of the Custom Header feature
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

register_default_headers(
	array(
		'default-image' => array(
			'url'           => get_template_directory_uri() . '/static/img/transparent-header.png',
			'thumbnail_url' => get_template_directory_uri() . '/static/img/transparent-header.png',
			'description'   => __( 'Default Header Image', 'muzeum' ),
		),
	)
);

function muzeum_custom_header_setup() {
	add_theme_support(
		'custom-header',
		apply_filters(
			'muzeum_custom_header_args',
			array(
				'default-image'      => get_template_directory_uri() . '/static/img/transparent-header.png',
				'default-text-color' => '000000',
				'width'              => 2200,
				'height'             => 480,
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
		$header_text_color   = get_header_textcolor();
		$background_position = get_theme_mod( 'header-background-position', 'top' );
		$has_background_size     = get_theme_mod( 'header-background-size', 1 );
		$has_background_repeat   = get_theme_mod( 'header-background-repeat', 1 );
		$overlay  = get_theme_mod('cover_template_overlay_opacity', '0');

		?>
		<style type="text/css">
		<?php if ( has_header_image() ) : ?>
			.site-branding {
				background-image: url(<?php header_image(); ?>);
				background-position: <?php echo esc_attr( $background_position ); ?>;
				<?php if ( !$has_background_size ) : ?> background-size: cover; <?php endif; ?>
				<?php if ( !$has_background_repeat ) : ?> background-repeat: no-repeat; <?php endif; ?>
				min-height: 220px;
			}
		<?php endif;
		if ($overlay || is_customize_preview() ) : ?>
			.site-branding::before {
				position: absolute;
				content: '';
				width: 100%;
				height: 100%;
				background: rgba(0, 0, 0, .<?php echo esc_attr($overlay); ?>);
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
