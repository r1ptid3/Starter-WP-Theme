<?php
/**
 * The main template file
 *
 * @package Sample
 *
 * @since   1.0.0
 */

// Disable direct access.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

get_header();

if ( have_posts() ) :

	get_template_part(
		'template-parts/content',
		'grid',
		array(
			'columns'    => '3',
			'square_img' => true,
			'btn_title'  => esc_html__( 'Learn More', 'sample' ),
			'length'     => 40,
		)
	);

else :

	get_template_part( 'template-parts/content', 'none' );

endif;

get_footer();
