<?php
/**
 * Functions and definitions
 *
 * @package Sample
 *
 * @since   1.0.0
 */

// Enable strict typing mode.
declare( strict_types = 1 );

// Disable direct access.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

if ( ! defined( 'R1__VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'R1__VERSION', '1.0.0' );
}

if ( ! function_exists( 'sample_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * @since  1.0.0
	 *
	 * @return void
	 */
	function sample_setup(): void {

		// Make theme available for translation.
		load_theme_textdomain( 'sample', get_template_directory() . '/languages' );

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );

		// Register theme menu locations.
		register_nav_menus(
			array(
				'main-menu' => esc_html__( 'Primary', 'sample' ),
			)
		);

		// Switch default core markup for search form, comment form, and comments to output valid HTML5.
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
				'sample_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);
	}
}

add_action( 'after_setup_theme', 'sample_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * @global int $content_width
 *
 * @return void
 */
function sample_content_width(): void {
	$GLOBALS['content_width'] = apply_filters( 'sample_content_width', 1170 );
}
add_action( 'after_setup_theme', 'sample_content_width', 0 );

/**
 * Register widget area
 *
 * @since    1.0.0
 *
 * @return  void
 */
function sample_widgets_init(): void {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'sample' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'sample' ),
			'before_widget' => '<div id="%1$s" class="r1-widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="r1-widget__title">',
			'after_title'   => '</h4>',
		)
	);
}
add_action( 'widgets_init', 'sample_widgets_init' );

/**
 * Register the theme assets
 *
 * @since   1.0.0
 *
 * @return  void
 */
function sample_assets(): void {
	// Theme's styles.
	wp_enqueue_style(
		'slick',
		get_template_directory_uri() . '/assets/css/slick.css',
		array(),
		R1__VERSION,
		'all'
	);
	wp_enqueue_style(
		'sample-theme',
		get_template_directory_uri() . '/assets/css/main.css',
		array( 'slick' ),
		R1__VERSION,
		'all'
	);

	// Theme's scripts.
	wp_enqueue_script(
		'slick-slider',
		get_template_directory_uri() . '/assets/js/slick.min.js',
		array( 'jquery' ),
		'3.1.1',
		false
	);
	wp_enqueue_script(
		'sample-scripts',
		get_template_directory_uri() . '/assets/js/common.js',
		array( 'slick-slider' ),
		R1__VERSION,
		true
	);

	// Theme's fonts.
	wp_enqueue_style(
		'sample-fonts',
		'https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap',
		array(),
		R1__VERSION,
		true
	);

	// Enqueue comment reply script.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'sample_assets' );


/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/hooking-functions.php';

/**
 * Custom blog functions which output post sections.
 */
require get_template_directory() . '/inc/post-functions.php';

/**
 * Functions which are adjust or change WordPress functions.
 */
require get_template_directory() . '/inc/wp-functions.php';

/**
 * Custom theme functions.
 */
require get_template_directory() . '/inc/theme-functions.php';

/**
 * Helper functions.
 */
require get_template_directory() . '/inc/helper-functions.php';
