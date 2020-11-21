<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Muzeum
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php muzeum_post_thumbnail(); ?>
	<header class="entry-header">
	<?php if ( muzeum_show_breadcrumbs() ) : ?>
		<div class="breadcrumb"><?php muzeum_breadcrumbs();?></div>
	<?php endif;
		the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<?php if ( get_edit_post_link() ) :
			muzeum_entry_header();
		endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content clearfix">
		<?php
		the_content();

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'muzeum' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php muzeum_entry_footer(); ?>
	</footer><!-- .entry-footer -->

</article><!-- #post-<?php the_ID(); ?> -->