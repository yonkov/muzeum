<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Muzeum
 */


if ( ! function_exists( 'muzeum_entry_header' ) ) :

	function muzeum_entry_header() {

		if ( 'page' !== get_post_type() ) {

			/**
			 * Prints HTML with meta information for the current post-date/time.
			 */

			// check user settings in theme customizer
			$show_post_published_date = get_theme_mod( 'show_post_date', 1 );

			if ( $show_post_published_date ) {

				$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';

				$time_string = sprintf(
					$time_string,
					esc_attr( get_the_date( DATE_W3C ) ),
					esc_html( get_the_date() )
				);

				$posted_on = sprintf(
					esc_html( '%s', 'post date' ),
					'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
				);

				echo '<ion-icon name="calendar-outline"></ion-icon><span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

			}

			/**
			 * Prints HTML with meta information for the current author.
			 */
			$show_post_author = get_theme_mod( 'show_post_author', 1 );

			if ( $show_post_author ) {

				$byline = sprintf(
					esc_html( '%s', 'post author' ),
					'<ion-icon name="person-outline"></ion-icon><span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
				);

				echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

			}

			/**
			 * Prints HTML with meta information for the current post category.
			 */
			/* translators: used between list items, there is a space after the comma */
			$display_category_list = get_theme_mod( 'show_post_categories', 1 );

			if ( $display_category_list ) {
				$category_list = get_the_category_list( esc_html( ', ' ) );?>
				<?php if ( $category_list ) : ?>
				<ion-icon name="folder-outline"></ion-icon>
				<span class="cat-links">
					<?php printf( /* category list */esc_html( '%s' ), $category_list ); // xss ok. ?>
				</span>
					<?php
				endif;
			}
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'muzeum' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			),
			'<span class="edit-link">',
			'</span>'
		);

	}
endif;

if ( ! function_exists( 'muzeum_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function muzeum_entry_footer() {
		$display_tag_list = get_theme_mod( 'show_post_tags', 1 );
		$display_comments = get_theme_mod( 'show_post_comments', 1 );
		// Hide tags for pages.
		if ( 'page' !== get_post_type() ) {
			if ( $display_tag_list ) {
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', esc_html( ', ' ) );
				if ( $tags_list ) {
					/* translators: 1: list of tags. */
					printf( '<ion-icon name="pricetags-outline"></ion-icon><span class="tags-links">' . esc_html( '%s' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				}
			}
		}

		if ( $display_comments ) {

			if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
				echo '<ion-icon name="chatbox-outline"></ion-icon><span class="comments-link">';
				comments_popup_link(
					sprintf(
						wp_kses(
							/* translators: %s: post title */
							__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'muzeum' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						wp_kses_post( get_the_title() )
					)
				);
				echo '</span>';
			}
		}

	}
endif;

if ( ! function_exists( 'muzeum_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function muzeum_post_thumbnail( $size = '' ) {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail( $size ); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php
					the_post_thumbnail(
						$size,
						array(
							'alt' => the_title_attribute(
								array(
									'echo' => false,
								)
							),
						)
					);
				?>
			</a>

			<?php
		endif; // End is_singular().
	}
endif;

if ( ! function_exists( 'wp_body_open' ) ) :
	/**
	 * Shim for sites older than 5.2.
	 *
	 * @link https://core.trac.wordpress.org/ticket/12563
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
endif;

/**
 * Shim for WordPress < 5.3
 *
 * remove type='javascript' attribute to ensure W3C compatibility and be able to load modules
 */
function muzeum_clean_script_tag( $input ) {
	$input = str_replace( "type='text/javascript' ", '', $input );
	return $input;
}
add_filter( 'script_loader_tag', 'muzeum_clean_script_tag' );