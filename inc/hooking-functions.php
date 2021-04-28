<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Sample
 */

// Enable strict typing mode.
declare( strict_types = 1 );

// Disable direct access.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * Adds custom classes to the array of body classes.
 *
 * @param  array $classes Classes for the body element.
 *
 * @return array
 */
function sample_body_classes( array $classes ): array {
	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'sample_body_classes' );
