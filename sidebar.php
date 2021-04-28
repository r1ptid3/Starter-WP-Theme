<?php
/**
 * The sidebar containing the main widget area
 *
 * @package Sample
 */

// Disable direct access.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<!-- .r1-sidebar -->
<aside class="r1-sidebar">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside>
<!-- \.r1-sidebar -->
