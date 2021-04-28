<?php
/**
 * Functions which are adjust WordPress functions.
 *
 * @package Sample
 */

// Enable strict typing mode.
declare( strict_types = 1 );

// Disable direct access.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

if ( ! function_exists( 'r1_crop_image' ) ) {
	/**
	 * Crops an image to a given size. Remade from wp_crop_image() function.
	 * Removed uniq number at the end of file name.
	 *
	 * @since    1.0.0
	 *
	 * @param string|int $src      The source file or Attachment ID.
	 * @param int        $src_x    The start x position to crop from.
	 * @param int        $src_y    The start y position to crop from.
	 * @param int        $src_w    The width to crop.
	 * @param int        $src_h    The height to crop.
	 * @param int        $dst_w    The destination width.
	 * @param int        $dst_h    The destination height.
	 * @param bool       $src_abs  Optional. If the source crop points are absolute.
	 * @param string     $dst_file Optional. The destination file to write to.
	 *
	 * @return string|WP_Error New filepath on success, WP_Error on failure.
	 */
	function r1_crop_image( $src, int $src_x, int $src_y, int $src_w, int $src_h, int $dst_w, int $dst_h, bool $src_abs = false, string $dst_file = '' ): string {
		$src_file = $src;

		if ( is_numeric( $src ) ) { // Handle int as attachment ID.
			$src_file = get_attached_file( $src );

			if ( ! file_exists( $src_file ) ) {
				// If the file doesn't exist, attempt a URL fopen on the src link.
				// This can occur with certain file replication plugins.
				$src = _load_image_to_edit_path( $src, 'full' );
			} else {
				$src = $src_file;
			}
		}

		$editor = wp_get_image_editor( $src );
		if ( is_wp_error( $editor ) ) {
			return $editor;
		}

		$src = $editor->crop( $src_x, $src_y, $src_w, $src_h, $dst_w, $dst_h, $src_abs );
		if ( is_wp_error( $src ) ) {
			return $src;
		}

		if ( empty( $dst_file ) ) {
			$dst_file = str_replace( wp_basename( $src_file ), 'cropped-' . wp_basename( $src_file ), $src_file );
		}

		$result = $editor->save( $dst_file );
		if ( is_wp_error( $result ) ) {
			return $result;
		}

		return $dst_file;
	}
}
