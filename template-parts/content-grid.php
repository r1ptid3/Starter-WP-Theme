<?php
/**
 * Template part for displaying posts with grid layout.
 *
 * @param array $args :
 * [columns]    - column count in grid layout;
 * [square_img] - to create, upload & use square image;
 * [length]     - content length;
 * [btn_title]  - "read more" button title;
 *
 * @package Sample
 */

// Disable direct access.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

?>

<section class="r1-section-posts grid columns-<?php echo esc_attr( $args['columns'] ); ?>">

	<?php

	while ( have_posts() ) :
		the_post();

		get_template_part(
			'template-parts/content',
			'article',
			array(
				'columns'    => '3',
				'square_img' => true,
				'btn_title'  => esc_html( $args['btn_title'] ),
				'length'     => esc_attr( $args['length'] ),
			)
		);
	endwhile;
	?>

</section>

<?php the_posts_navigation(); ?>
