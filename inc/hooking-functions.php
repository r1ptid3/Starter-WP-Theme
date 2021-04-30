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

/**
 * Remove WP version.
 *
 * @return string
 */
function remove_wp_version(): string {
	return '';
}
add_filter( 'the_generator', 'remove_wp_version' );

/**
 * Return custom message on login.
 *
 * @return string
 */
function no_wordpress_errors() {
	return esc_html__( 'Wrong password or login', 'sample' );
}
add_filter( 'login_errors', 'no_wordpress_errors' );
