<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Muzeum
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'muzeum' ); ?></a>

	<header id="masthead" class="site-header">

		<?php if ( has_nav_menu( 'menu-1' ) ) : ?>
		
		<nav id="top-navigation" class="site-menu top-nav">
			<button class="menu-toggle" data-toggle="collapse" aria-controls="top-menu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="menu-toggle-icon">
                	<input class="burger-check" id="burger-check" type="checkbox"><label for="burger-check" class="burger"></label>
                </span>
            </button>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'top-menu',
				)
			); ?>
		</nav><!-- #site-navigation -->
		
		<?php endif; ?>
		
		<div class="site-branding  <?php echo esc_attr(!display_header_text() ? 'no-title': '');?>">
			<div class="hero-wrapper">
				<?php muzeum_the_logo(); ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					
				<?php $muzeum_description = get_bloginfo( 'description', 'display' );
				if ( $muzeum_description || is_customize_preview() ) : ?>
					<p class="site-description"><?php echo $muzeum_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
				<?php endif;
				muzeum_call_to_action(); ?>
			</div>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="site-menu main-nav">
			<button class="menu-toggle" data-toggle="collapse" aria-controls="top-menu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="menu-toggle-icon">
                	<input class="burger-check" id="burger-check" type="checkbox"><label for="burger-check" class="burger"></label>
                </span>
            </button>
			
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-2',
					'menu_id'        => 'primary-menu',
				)
			);
			?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->