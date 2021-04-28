<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @package Sample
 */

// Disable direct access.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

if ( post_password_required() ) {
	return;
}

?>

<div class="r1-comments">

	<?php if ( have_comments() ) : ?>

		<h3 class="r1-comments__title">

			<?php

			$comments_count = get_comments_number();

			printf(
				esc_html(
					/* translators: 1: comment count number */
					_nx(
						'%1$s Comment',
						'%1$s Comments',
						$comments_count,
						'comments title',
						'sample',
					)
				),
				number_format_i18n( $comments_count ), // phpcs:ignore
			);

			?>

		</h3>

		<ul class="r1-comments__list">

			<?php

			wp_list_comments(
				array(
					'style' => 'ul',
				)
			);

			?>

		</ul>

		<?php

		the_comments_navigation();

	endif;

	comment_form();

	?>

</div>
