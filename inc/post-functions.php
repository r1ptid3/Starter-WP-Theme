<?php
/**
 * Custom blog functions
 *
 * @package Sample
 * @since   1.0.0
 */

// Enable strict typing mode.
declare( strict_types = 1 );

// Disable direct access.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

if ( ! function_exists( 'r1_post_featured' ) ) {
	/**
	 * Get post featured image.
	 *
	 * @since    1.0.0
	 *
	 * @param    string $layout Image container layout.
	 * @param    bool   $square Set true if image has to be square.
	 *
	 * @return   string
	 */
	function r1_post_featured( string $layout = '', bool $square = false ): string {

		// Variables declaration.
		$out            = '';
		$image          = '';
		$post_id        = get_the_id();
		$post_permalink = get_permalink();

		$start_tag = is_singular() ? '<div ' : '<a href="' . esc_url( $post_permalink ) . '"';
		$end_tag   = is_singular() ? '</div>' : '</a>';

		// Get post thumbnail.
		if ( has_post_thumbnail() ) {
			$thumb_id = get_post_thumbnail_id( $post_id );

			$thumb_title = get_post( $thumb_id )->post_title;
			$thumb_alt   = get_post_meta( $thumb_id, '_wp_attachment_image_alt', true );
			$thumb_alt   = ! empty( $thumb_alt ) ? $thumb_alt : $thumb_title;

			$thumb_src    = wp_get_attachment_image_url( $thumb_id, 'full' );
			$thumb_srcset = wp_get_attachment_image_srcset( $thumb_id, 'full' );

			$thumb_sizes = '';

			if ( '2' === $layout ) {
				$thumb_sizes = '(max-width: 767px) 100vw, 50vw';
			} elseif ( '3' === $layout ) {
				$thumb_sizes = '(max-width: 767px) 100vw, (max-width: 991px) 50vw, 33vw';
			} elseif ( '4' === $layout ) {
				$thumb_sizes = '(max-width: 767px) 100vw, (max-width: 991px) 50vw, (max-width: 1366px) 33vw, 25vw';
			} else {
				$thumb_sizes = '100vw';
			}

			if ( ! $square ) {

				$image .= get_the_post_thumbnail(
					get_the_id(),
					'full',
					array(
						'alt'   => esc_attr( $thumb_alt ),
						'sizes' => esc_attr( $thumb_sizes ),
					)
				);

			} else {

				$image .= wp_get_attachment_image(
					r1_crop_and_upload_image( $thumb_id, $thumb_title ),
					'full',
					false,
					array(
						'alt'   => esc_attr( $thumb_alt ),
						'sizes' => esc_attr( $thumb_sizes ),
					)
				);
			}
		}

		if ( ! empty( $image ) ) {

			$out .= $start_tag . ' class="post-featured">' . $image . $end_tag;

		}

		return $out;
	}
}

if ( ! function_exists( 'r1_post_title' ) ) {
	/**
	 * Get post title.
	 *
	 * @since    1.0.0
	 *
	 * @return   string
	 */
	function r1_post_title(): string {

		$out = '<h3 class="post-title">';

			$out .= '<a href="' . get_the_permalink() . '">';

				$out .= get_the_title();

			$out .= '</a>';

		$out .= '</h3>';

		return $out;
	}
}

if ( ! function_exists( 'r1_post_categories' ) ) {
	/**
	 * Get post categories.
	 *
	 * @since    1.0.0
	 *
	 * @return   string
	 */
	function r1_post_categories(): string {

		$out       = '';
		$uniq_cats = array();
		$post_cats = get_the_category();

		foreach ( $post_cats as $cat ) {
			if ( 'uncategorized' !== $cat->slug ) {
				$uniq_cats[] = $cat->term_id;
			}
		};

		if ( ! empty( $uniq_cats ) ) {

			$out .= '<div class="post-categories">';

			foreach ( $uniq_cats as $key ) {

				$out .= '<a href="' . get_category_link( $key ) . '">';

					$out .= get_cat_name( $key );

				$out .= '</a>';

			}

			$out .= '</div>';

		}

		return $out;
	}
}

if ( ! function_exists( 'r1_post_author' ) ) {
	/**
	 * Get post author.
	 *
	 * @since    1.0.0
	 *
	 * @return   string
	 */
	function r1_post_author(): string {

		$avatar = get_avatar( get_the_author_meta( 'ID' ) );

		$out = '<div class="post-author">';

		if ( ! empty( $avatar ) ) {
			$out .= sprintf( '%s', $avatar );
		} else {
			$out .= '<img src="' . get_template_directory_uri() . '/assets/img/unknown.png">';
		}

		$out .= get_the_author_posts_link();

		$out .= '</div>';

		return $out;
	}
}

if ( ! function_exists( 'r1_post_date' ) ) {
	/**
	 * Get post date.
	 *
	 * @since    1.0.0
	 *
	 * @return   string
	 */
	function r1_post_date(): string {

		$date = get_day_link( (int) get_the_date( 'Y' ), (int) get_the_date( 'm' ), (int) get_the_date( 'd' ) );

		$out = '<div class="post-date">';

			$out .= '<a href="' . esc_url( $date ) . '">';

				$out .= esc_html( get_the_date( get_option( 'date_format' ) ) );

			$out .= '</a>';

		$out .= '</div>';

		return $out;
	}
}

if ( ! function_exists( 'r1_post_comments' ) ) {
	/**
	 * Get post comments count.
	 *
	 * @since    1.0.0
	 *
	 * @return   string
	 */
	function r1_post_comments(): string {

		$comments = get_comments_number();

		$out = '<div class="post-comments-count">';

		if ( ! post_password_required() && comments_open() ) {

			$out .= '<a href="' . get_permalink() . '#comments">' . get_comments_number() . '</a>';

		} else {

			$out .= '<span>' . get_comments_number() . '</span>';

		}

		$out .= '</div>';

		return $out;
	}
}

if ( ! function_exists( 'r1_post_read_more' ) ) {
	/**
	 * Get post comments count.
	 *
	 * @since    1.0.0
	 *
	 * @param    string $button_title Button title.
	 *
	 * @return   string
	 */
	function r1_post_read_more( $button_title = '' ): string {

		$out         = '';
		$post_link   = get_permalink();
		$post_target = '_self';

		$out .= '<div class="blog-readmore-wrap">';

			$out .= '<a class="blog-readmore r1_button" href="' . esc_url( $post_link ) . '" target="' . esc_attr( $post_target ) . '">';

				$out .= '<span>' . esc_html( $button_title ) . '</span>';

			$out .= '</a>';

		$out .= '</div>';

		return $out;
	}
}

if ( ! function_exists( 'r1_post_content' ) ) {
	/**
	 * Get post content.
	 *
	 * @since    1.0.0
	 *
	 * @param    string $button_title Button title.
	 * @param    int    $max_length   Max content length.
	 *
	 * @return   string
	 */
	function r1_post_content( string $button_title = '', int $max_length = -1 ): string {

		$out     = '';
		$excerpt = get_the_excerpt();
		$content = get_the_content();
		$content = apply_filters( 'the_content', $content );
		$content = str_replace( ']]>', ']]&gt;', $content );

		$button_title = empty( $button_title ) ? esc_html__( 'Read More', 'sample' ) : $button_title;

		if ( has_excerpt() ) {

			$content  = esc_html( $excerpt );
			$content .= r1_post_read_more( $button_title );

		} else {

			if ( -1 !== $max_length ) {

				if ( strlen( $content ) > $max_length ) {

					$content = trim( preg_replace( '/[\s]{2,}/', ' ', strip_shortcodes( wp_strip_all_tags( $content ) ) ) );
					$content = mb_substr( $content, 0, $max_length ) . '...';

					$content .= r1_post_read_more( $button_title );

				}

				if ( 0 === $max_length ) {
					$content = '';
				}
			}
		}

		ob_start();

			wp_link_pages(
				array(
					'before'      => '<div class="paging-navigation in-post"><div class="pagination"><span class="page-links-title">' . esc_html__( 'Pages:', 'sample' ) . '</span>',
					'after'       => '</div></div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
				)
			);

		$content .= ob_get_clean();

		// Generate output HTML.
		$out .= '<div class="post-content-wrapper">';

			$out .= $content;

		$out .= '</div>';

		return $out;
	}
}
