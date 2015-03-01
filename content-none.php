<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package Wordpress
 * @subpackage Riiskit
 * @since Riiskit 1.0.0
 */
?>

<section class="no-results not-found">

	<header class="page__header">
		<h1 class="page__header__title">
			<?php _e( 'Nothing Found', 'riiskit' ); ?>
		</h1>
	</header> <!-- .page__header -->



	<div class="page__content">

		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p>
				<?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'riiskit' ), esc_url( admin_url( 'post-new.php' ) ) ); ?>
			</p>

		<?php elseif ( is_search() ) : ?>

			<p>
				<?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'riiskit' ); ?>
			</p>

			<?php get_search_form(); ?>

		<?php else : ?>

			<p>
				<?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. The page has probably been moved or deleted.', 'riiskit' ); ?>
			</p>

			<?php get_search_form(); ?>

		<?php endif; ?>

	</div> <!-- .page__content -->

</section> <!-- .no-results -->
