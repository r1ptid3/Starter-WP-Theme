<?php
/**
 * The template for displaying all pages
 *
 * @package Sample
 */

// Disable direct access.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

get_header();

if ( have_posts() ) :

	while ( have_posts() ) :
		the_post();

		get_template_part( 'template-parts/content', 'page' );

		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;

	endwhile;

else :

	get_template_part( 'template-parts/content', 'none' );

endif;

get_footer();
