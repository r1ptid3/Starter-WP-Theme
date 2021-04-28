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

global $post;

$first_post_loop = get_posts( 'post_type=' . get_post_type() . '&numberposts=1&order=ASC' );
$first_post      = $first_post_loop[0];

$last_post_loop = get_posts( 'post_type=' . get_post_type() . '&numberposts=1' );
$last_post      = $last_post_loop[0];

$next_post = get_next_post() ? get_next_post() : $first_post;
$prev_post = get_previous_post() ? get_previous_post() : $last_post;
$p_type    = get_post_type_object( get_post()->post_type );

if ( ! get_next_post() && ! get_previous_post() ) {
	return;
}

?>

<nav class="navigation post-navigation" role="navigation">
	<ul class="nav-links">

		<?php if ( $prev_post && $next_post->ID !== $prev_post->ID ) : ?>

			<?php $thumbnail = get_the_post_thumbnail_url( $prev_post->ID, 'thumbnail' ); ?>

			<li class="prev-post">
				<?php if ( ! empty( $thumbnail ) ) : ?>

				<a class="post-navigation__thumb" href="<?php the_permalink( $prev_post ); ?>">
					<img src="<?php echo esc_url( $thumbnail ); ?>" alt="<?php echo esc_attr( $prev_post->post_title ); ?>" />
				</a>

				<?php endif; ?>

				<div class="post-navigation__text">	
					<a href="<?php the_permalink( $prev_post ); ?>">
						<span class="post-link"><?php echo esc_html__( 'Previous Post', 'sample' ); ?></span>
						<span class="post-title"><?php echo wp_kses_post( $prev_post->post_title ); ?></span>
					</a>
				</div>
			</li>

		<?php else : ?>

			<li class="prev-post disabled"></li>

		<?php endif ?>


		<?php if ( $next_post ) : ?>

			<?php $thumbnail = get_the_post_thumbnail_url( $next_post->ID, 'thumbnail' ); ?>

			<li class="next-post">
				<div class="post-navigation__text">
					<a href="<?php the_permalink( $next_post ); ?>">
						<span class="post-link"><?php echo esc_html__( 'Next Post', 'sample' ); ?></span>
						<span class="post-title"><?php echo wp_kses_post( $next_post->post_title ); ?></span>
					</a>
				</div>

				<?php if ( ! empty( $thumbnail ) ) : ?>

				<a class="post-navigation__thumb" href="<?php the_permalink( $next_post ); ?>">
					<img src="<?php echo esc_url( $thumbnail ); ?>" alt="<?php echo esc_attr( $next_post->post_title ); ?>" />
				</a>

				<?php endif; ?>
			</li>

		<?php else : ?>

			<li class="next-post disabled"></li>

		<?php endif ?>

	</ul>
</nav>
