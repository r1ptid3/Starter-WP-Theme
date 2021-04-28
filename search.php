<?php
/**
 * The template for displaying search results pages
 *
 * @package Sample
 */

// Disable direct access.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

get_header();

if ( have_posts() ) : ?>

	<div class="r1-title-wrapper">
		<h1 class="r1-title">
			<?php
				// translators: search keyword.
				printf( esc_html__( 'Showing search results for: %s', 'sample' ), esc_html( sanitize_text_field( wp_unslash( $_GET['s'] ) ) ) ); // phpcs:ignore 
			?>
		</h1>
	</div>

	<?php

	get_template_part(
		'template-parts/content',
		'grid',
		array(
			'columns' => '3',
			'length'  => 100,
		)
	);

else :

	get_template_part( 'template-parts/content', 'none' );

endif;

get_footer();
