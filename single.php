<?php
/**
 * The template for displaying all single posts
 *
 * @package Sample
 */

// Disable direct access.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

get_header();

?>

	<main id="primary" class="site-main">

		<?php

		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'article' );

			get_template_part( 'template-parts/content', 'navigation' );

			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile;

		?>

	</main>

<?php
get_footer();
