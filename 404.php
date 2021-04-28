<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Sample
 */

// Disable direct access.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

get_header();

?>

	<section class="r1-section-404">
		<div class="r1-title-wrapper">
			<h1 class="r1-title"><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'sample' ); ?></h1>
		</div>

		<?php
			get_search_form();
		?>
	</section>

<?php

get_footer();
