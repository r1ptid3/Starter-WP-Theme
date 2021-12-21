<?php
/**
 * The template for displaying the header
 *
 * This is the template that displays all of the <head> section and everything up until main.
 *
 * @package Sample
 *
 * @since   1.0.0
 */

// Disable direct access.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

$options = function_exists( 'pll_current_language' ) ? 'options-' . pll_current_language( 'slug' ) : 'options-en';

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">

		<meta name="viewport" content="user-scalable=1.0, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="format-detection" content="telephone=no">

		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>

		<!-- .r1-preloader -->
		<div class="r1-preloader"></div>
		<!-- \.r1-preloader -->

		<!-- .r1-header -->
		<header class="r1-header">
			<div class="r1-header__container r1-container">
				<div class="r1-header__logotype">
					<a href="<?php echo esc_url( get_home_url( '' ) ); ?>">
						<img src="<?php echo esc_attr( get_template_directory_uri() ); ?>/assets/img/logotype.png" alt="" />
					</a>
				</div>
				<nav class="r1-header__nav">
					<?php

					wp_nav_menu(
						array(
							'theme_location' => 'main-menu',
							'container'      => '',
						)
					);

					?>
				</nav>
				<div class="r1-header__links">
					<a href="<?php echo esc_url( get_search_link() ); ?>" class="r1-header__link search-link">Search</a>
					<a href="javascript:" class="r1-header__link mobile-menu-trigger">
						<span></span>
						<span></span>
						<span></span>
					</a>
				</div>
			</div>
		</header>

		<div class="r1-overlay"></div>
		<!-- \.r1-header -->

		<!-- .r1-content-wrapper -->
		<div class="r1-content-wrapper r1-container">

			<?php

			if ( is_singular( 'post' ) ) {
				get_sidebar();
			}

			?>

			<!-- .r1-main -->
			<main class="r1-main">
