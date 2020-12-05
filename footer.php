<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Muzeum
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="wrapper widget-area" role="complementary" aria-label="<?php esc_attr_e( 'Footer', 'muzeum' ); ?>">
		<?php
		//Add content to the footer
		if ( is_active_sidebar( 'sidebar-2' ) || is_active_sidebar( 'sidebar-3' ) ) : ?>

			<?php
				if ( is_active_sidebar( 'sidebar-2' ) ) { ?>
			<div class="widget-column footer-widget-1">
				<?php dynamic_sidebar( 'sidebar-2' ); ?>
			</div>
			<?php }
				if ( is_active_sidebar( 'sidebar-3' ) ) { ?>
			<div class="widget-column footer-widget-2">
				<?php dynamic_sidebar( 'sidebar-3' ); ?>
			</div>
			<?php } ?>

			<?php endif; ?>
		</div><!-- .widget-area -->
		<div class="site-info">
		<?php esc_html_e('Designed by', 'muzeum'); ?>
			<a href="<?php echo esc_url( __('https://nasiothemes.com/', 'muzeum' ) ); ?>" class="imprint">
				<?php esc_html_e ( 'Nasio Themes', 'muzeum' ); ?>
        	</a>
			<span class="sep"> || </span>
				<?php
				/* translators: %s: CMS name, i.e. WordPress. */
				esc_html_e('Powered by', 'muzeum'); ?>
				<a href="<?php echo esc_url( __('https://wordpress.com/', 'muzeum' ) ); ?>" class="imprint">
					<?php esc_html_e ( 'WordPress', 'muzeum' ); ?>
				</a>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>