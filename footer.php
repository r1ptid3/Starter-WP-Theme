<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the .r1-main <main> tag and all content after.
 *
 * @package Sample
 *
 * @since   1.0.0
 */

// Disable direct access.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

?>

			</main>
			<!-- \.r1-main -->

		</div>
		<!-- \.r1-content-wrapper -->

		<!-- .r1-footer -->
		<footer class="r1-footer">
			<div class="r1-container">
				<p class="r1-footer__copyright">Copyright @ 2021. All rights reserved</p>
			</div>
		</footer>
		<!-- \.r1-footer -->

		<!-- .r1-button-up -->
		<div class="r1-button-up">
			<img src="<?php echo esc_attr( get_template_directory_uri() ); ?>/assets/img/arrow-up.png" alt="" />
		</div>
		<!-- \.r1-button-up -->

		<?php wp_footer(); ?>
	</body>

</html>
