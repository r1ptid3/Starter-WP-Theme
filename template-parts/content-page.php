<?php
/**
 * Template part for displaying page content in page.php
 *
 * @package Sample
 */

// Disable direct access.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

?>

<article id="page-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="r1-title-wrapper">
		<h1 class="r1-title"><?php the_title(); ?></h1>
	</div>

	<?php r1_post_featured(); ?>

	<div class="post-content-wrapper">
		<?php the_content(); ?>

		<?php

		wp_link_pages(
			array(
				'before'      => '<div class="paging-navigation in-post"><div class="pagination"><span class="page-links-title">' . esc_html__( 'Pages:', 'sample' ) . '</span>',
				'after'       => '</div></div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			)
		);

		?>
	</div>

</article>
