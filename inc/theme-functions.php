<?php
/**
 * Custom theme functions.
 *
 * @package Sample
 */

// Enable strict typing mode.
declare( strict_types = 1 );

// Disable direct access.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

if ( ! function_exists( 'r1_get_image_id_by_slug' ) ) {
	/**
	 * Retrieves the attachment ID from the file URL.
	 *
	 * @since    1.0.0
	 *
	 * @param string $path The attachment slug.
	 *
	 * @return int Attachment ID
	 */
	function r1_get_image_id_by_slug( string $path ): int {
		global $wpdb;

		// phpcs:ignore
		$attachment = $wpdb->get_col( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_name = %s;", strtolower( $path ) ) );

		$id = ! empty( $attachment ) ? (int) $attachment[0] : 0;

		return $id;
	}
}

if ( ! function_exists( 'r1_crop_and_upload_image' ) ) {
	/**
	 * Crops an image to a square. Upload image via wp_insert_attachment with all available sizes.
	 *
	 * @since    1.0.0
	 *
	 * @param int    $thumb_id    The attachment ID.
	 * @param string $thumb_title The attachment Title.
	 *
	 * @return int new attachment ID on success, WP_Error on failure.
	 */
	function r1_crop_and_upload_image( int $thumb_id, string $thumb_title ): int {
		$src_file  = get_attached_file( $thumb_id );
		$dest_file = str_replace( wp_basename( $src_file ), 'cropped-' . wp_basename( $src_file ), $src_file );

		if ( ! file_exists( $dest_file ) ) {

			$thumb_obj = wp_get_attachment_image_src( $thumb_id, 'full' );

			$thumb_width  = $thumb_obj[1];
			$thumb_height = $thumb_obj[2];

			// Check is'n image a square.
			if ( $thumb_width !== $thumb_height ) {

				// Get cropped properties.
				if ( $thumb_width < $thumb_height ) {

					$thumb_smallest_side = $thumb_width;

					$start_x = 0;
					$start_y = ( $thumb_height - $thumb_width ) / 2;

					$dest_x = $thumb_width;
					$dest_y = $thumb_smallest_side;

				} else {

					$thumb_smallest_side = $thumb_height;

					$start_x = ( $thumb_width - $thumb_height ) / 2;
					$start_y = 0;

					$dest_x = $thumb_smallest_side;
					$dest_y = $thumb_height;

				}

				// Create a cropped image.
				$cropped_image = r1_crop_image( $thumb_id, $start_x, $start_y, $thumb_smallest_side, $thumb_smallest_side, $dest_x, $dest_y, false );

				// Upload image via wp_insert_attachment with all available predefined sizes.
				require_once ABSPATH . 'wp-load.php';

				$wordpress_upload_dir = wp_upload_dir();

				$new_file_path = $cropped_image;
				$new_file_mime = mime_content_type( $cropped_image );

				if ( ! in_array( $new_file_mime, get_allowed_mime_types(), true ) ) {
					die( 'WordPress doesn\'t allow this type of uploads.' );
				}

				$upload_id = wp_insert_attachment(
					array(
						'guid'           => $new_file_path,
						'post_mime_type' => $new_file_mime,
						'post_title'     => 'cropped_' . $thumb_title,
						'post_content'   => '',
						'post_status'    => 'inherit',
					),
					$new_file_path
				);

				// wp_generate_attachment_metadata() won't work if you do not include this file.
				require_once ABSPATH . 'wp-admin/includes/image.php';

				// Generate and save the attachment metas into the database.
				wp_update_attachment_metadata( $upload_id, wp_generate_attachment_metadata( $upload_id, $new_file_path ) );

			} else {

				return $thumb_id;

			}
		}

		$id_from_db = r1_get_image_id_by_slug( 'cropped_' . $thumb_title );
		$thumb_id   = 0 !== $id_from_db ? $id_from_db : $thumb_id;

		return $thumb_id;
	}
}
