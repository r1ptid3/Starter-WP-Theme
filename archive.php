<?php
/**
 * The template for displaying archive pages
 *
 * @package Sample
 */

// Disable direct access.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

get_header();

?>

<?php if ( have_posts() ) : ?>

	<div class="r1-title-wrapper">
		<?php

		the_archive_title( '<h1 class="r1-title">', '</h1>' );
		the_archive_description( '<p class="r1-description">', '</p>' );

		?>
	</div>

	<?php

	get_template_part(
		'template-parts/content',
		'grid',
		array(
			'columns' => '3',
			'length'  => 40,
		)
	);

	?>

<?php else :

	get_template_part( 'template-parts/content', 'none' );

endif;

get_footer();

?>
