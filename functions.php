<?php
/**
 * Muzeum functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Muzeum
 */

if ( ! defined( 'MUZEUM_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'MUZEUM_VERSION', '1.2.0' );
}

if ( ! function_exists( 'muzeum_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function muzeum_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Muzeum, use a find and replace
		 * to change 'muzeum' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'muzeum', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Top', 'muzeum' ),
				'menu-2' => esc_html__( 'Primary', 'muzeum' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'muzeum_custom_background_args',
				array(
					'default-color' => '#ffffff',
					'default-image' => get_template_directory_uri() . '/static/img/whitenoise-360x370.png',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'muzeum_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function muzeum_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'muzeum_content_width', 640 );
}
add_action( 'after_setup_theme', 'muzeum_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function muzeum_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'muzeum' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'muzeum' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer 1', 'muzeum' ),
			'id'            => 'sidebar-2',
			'description'   => __( 'Add widgets here to appear in your footer.', 'muzeum' ),
			'before_widget' => '<section id="%1$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="heading">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer 2', 'muzeum' ),
			'id'            => 'sidebar-3',
			'description'   => __( 'Add widgets here to appear in your footer.', 'muzeum' ),
			'before_widget' => '<section id="%1$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
}
add_action( 'widgets_init', 'muzeum_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function muzeum_scripts() {
	wp_enqueue_style( 'muzeum-style', get_stylesheet_uri(), array(), MUZEUM_VERSION );
	wp_style_add_data( 'muzeum-style', 'rtl', 'replace' );
	// Load Ionicons font
	wp_enqueue_script( 'muzeum-ionicons-module', get_template_directory_uri() . '/static/js/ionicons/ionicons.esm.js', array(), '5.2.3', true );
	wp_enqueue_script( 'muzeum-ionicons', get_template_directory_uri() . '/static/js/ionicons/ionicons.js', array(), '5.2.3', true );

	wp_enqueue_script( 'muzeum-navigation', get_template_directory_uri() . '/static/js/navigation.js', array(), MUZEUM_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'muzeum_scripts' );

// Append type="module" to Ionicons module script
function muzeum_add_type_module_attribute( $tag, $handle ) {
	if ( $handle !== 'muzeum-ionicons-module' ) {
		return $tag;
	}
	// add type='module' script attribute
	$new_tag = str_replace( ' src', " type='module' src", $tag );
	return $new_tag;
}
add_filter( 'script_loader_tag', 'muzeum_add_type_module_attribute', 10, 2 );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Add option to add site logo from the customizer
 *
 * @since WordPress 4.5
 */
function muzeum_the_logo() {

	$show_default_logo = get_theme_mod( 'show_default_logo', 1 );

	// shim for wp versions older than 4.5
	if ( ! function_exists( 'the_custom_logo' ) ) {
		return;
	}

	// Display the default theme logo if no logo is specified
	if ( ! has_custom_logo() ) :
		// if user did not remove the default theme logo
		if ( $show_default_logo || is_customize_preview() ) :
			muzeum_default_logo_markup( $show_default_logo );

		endif;

	else :
		// allow the user to upload cutom logo and replace the theme logo

		the_custom_logo();
		if ( is_customize_preview() ) {
			muzeum_default_logo_markup( $show_default_logo );
		}

	endif;
}

/**
 * The Html for the default site logo
 * Keep the html for the Customizer Live Preview for better UX
 *
 * @since muzeum 1.1.5
 */
function muzeum_default_logo_markup( $logo ) { ?>
	<a href="<?php echo esc_attr( home_url() ); ?>">
		<img class="default-logo custom-logo <?php echo $logo ? '' : 'no-logo'; ?>"
		src="<?php echo esc_url( get_template_directory_uri() ); ?>/static/img/museum-logo.png"
		alt="<?php echo esc_attr( 'muzeum theme logo' ); ?>" />
	</a>
	<?php
}

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function muzeum_body_classes( $classes ) {

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'muzeum_body_classes' );

/* Post Pagination on Archives */
function muzeum_the_posts_navigation() {
	$muzeum_prev_arrow = ( is_rtl() ? '&rarr;' : '&larr;' );
	$muzeum_next_arrow = ( is_rtl() ? '&larr;' : '&rarr;' );
	the_posts_navigation(
		array(
			'prev_text'          => $muzeum_prev_arrow . __( ' Older posts', 'muzeum' ),
			'next_text'          => __( 'Newer posts', 'muzeum' ) . $muzeum_next_arrow,
			'screen_reader_text' => __( 'Posts navigation', 'muzeum' ),
		)
	);
}

/* Post navigation in single.php */
function muzeum_the_post_navigation() {
	$muzeum_prev_arrow = ( is_rtl() ? '&rarr;' : '&larr;' );
	$muzeum_next_arrow = ( is_rtl() ? '&larr;' : '&rarr;' );
	the_post_navigation(
		array(
			'prev_text'          => '<span class="nav-subtitle">' . $muzeum_prev_arrow . '</span> <span class="nav-title">%title</span>',
			'next_text'          => '<span class="nav-title">%title </span>' . '<span class="nav-subtitle">' . $muzeum_next_arrow . '</span>',
			'screen_reader_text' => __( 'Posts navigation', 'muzeum' ),
		)
	);
}

/* Show the correct icon on post archives */
function muzeum_archive_page_icon() {
	if ( is_category() ) {
		return '<ion-icon name="folder-outline"></ion-icon>';
	} elseif ( is_tag() ) {
		return '<ion-icon name="pricetags-outline"></ion-icon>';
	} elseif ( is_author() ) {
		return '<ion-icon name="person-outline"></ion-icon>';
	}
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
 * a 'Continue reading' link.
 *
 * @since muzeum 1.0.0
 *
 * @param string $link Link to single post/page.
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function muzeum_excerpt_more( $link ) {
	if ( is_admin() ) {
		return $link;
	}
	$link = sprintf(
		'<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Name of current post */
		sprintf( __( 'Read the full post %1$s<span class="screen-reader-text">"%2$s"</span>', 'muzeum' ), ( is_rtl() ? '&larr;' : '&rarr;' ), esc_html( get_the_title( get_the_ID() ) ) )
	);
	return ' &hellip; ' . $link;
}

add_filter( 'excerpt_more', 'muzeum_excerpt_more' );

/* Add search list item to top menu bar */

function muzeum_add_search_box( $items, $args ) {
	// stop execution if it is not the top menu
	if ( $args->theme_location !== 'menu-1' ) {
		return $items;
	}

	ob_start();
	?>
	
	<li class="top-search">
		<a href="#" class="search-icon">
			<ion-icon name="search"></ion-icon>
		</a>
		<div class="top-search-form"><?php get_search_form(); ?></div>
	</li> 
	<?php

	$items .= ob_get_clean();

	return $items;

}

add_filter( 'wp_nav_menu_items', 'muzeum_add_search_box', 10, 2 );

/**
 * Register Google fonts
 *
 * @return string Google fonts URL for the theme.
 */
function muzeum_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext,cyrillic';

	/* translators: If there are characters in your language that are not supported by Concert One, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Alegreya font: on or off', 'muzeum' ) ) {
		$fonts[] = 'Alegreya:400,400italic,800,800italic';
	}

	$query_args = array(
		'family' => urlencode( implode( '|', $fonts ) ),
		'subset' => urlencode( $subsets ),
	);

	if ( $fonts ) {
		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}

/**
 * Add preconnect for Google Fonts for performance
 *
 * @since muzeum 1.0.0
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function muzeum_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'muzeum-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'muzeum_resource_hints', 10, 2 );


/**
 * Enqueue fonts
 */

function muzeum_fonts() {
	// Add google fonts
	wp_enqueue_style( 'muzeum-custom-fonts', muzeum_fonts_url(), array(), null );
}
add_action( 'wp_enqueue_scripts', 'muzeum_fonts' );

/**
 * Add very simple breadcrumps to posts and pages
 *
 * @since v.1.0.0
 */
function muzeum_breadcrumbs() {

	if ( is_front_page() ) {
		return;
	}
	?>

	<a href="<?php echo esc_url( home_url() ); ?>"><?php _e( 'Home', 'muzeum' ); ?></a>

	<?php
	if ( is_category() || is_single() ) {
		echo '&nbsp;&nbsp;&#187;&nbsp;&nbsp;';
		the_category( ' &bull; ' );
		if ( is_single() ) {
			echo ' &nbsp;&nbsp;&#187;&nbsp;&nbsp; ';
			the_title();
		}
	} elseif ( is_page() ) {
		echo '&nbsp;&nbsp;&#187;&nbsp;&nbsp;';
		echo the_title();
	}

}

/**
 * Call to action button on homepage
 *
 * @since v.1.0.1
 */
function muzeum_call_to_action() {
	if ( is_front_page() ) :

		$banner_label = get_theme_mod( 'banner_label', __( 'Get Started', 'muzeum' ) );
		$banner_link  = get_theme_mod( 'banner_link', '#' );

		if ( $banner_label && $banner_link || is_customize_preview() ) :

			muzeum_call_to_action_markup( $banner_label, $banner_link );

		endif;

	endif;
}


/**
 * Display the header call to action button html
 * Keep the html for the Customizer Live Preview for better UX
 *
 * @since v.1.1.5
 * @link https://codex.wordpress.org/Theme_Customization_API#Part_3:_Configure_Live_Preview_.28Optional.29
 */
function muzeum_call_to_action_markup( $label, $link ) {
	?>
	<button class="call-to-action <?php echo esc_attr( ! $link ? 'banner-no-link ' : '' ), esc_attr( ! $label ? 'banner-no-label' : '' ); ?>">
		<a href="<?php echo esc_url( $link ); ?>" 
			aria-label="<?php printf( /* translators: get started */ esc_attr__( 'Get Started', 'muzeum' ) ); ?>">
			<?php printf( /* translators: right arrow (LTR) / left arrow (RTL) */ esc_html( $label ) . ' ' . '%s', is_rtl() ? '&larr;' : '&rarr;' ); ?>
		</a>
	</button>
	<?php
}

/**
 * Facebook Open Graph
 *
 * Display featured posts as og:image on single page
 *
 * @link https://stackoverflow.com/questions/28735174/wordpress-ogimage-featured-image
 * @since v.1.0.3
 */

function muzeum_fb_open_graph() {
	if ( is_single() && has_post_thumbnail() ) {
		echo '<meta property="og:image" content="' . esc_attr( get_the_post_thumbnail_url( get_the_ID() ) ) . '" />';
	}
}

add_action( 'wp_head', 'muzeum_fb_open_graph' );
