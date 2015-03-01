<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package WordPress
 * @subpackage Riiskit
 * @since Riiskit 1.0.0
 */

get_header(); ?>

	<div id="primary" class="primary">
		<main class="content" role="main">

			<section class="error-404 not-found">

				<header class="page__header">
					<h1 class="page__header__title">
						<?php _e( 'Page not found', 'riiskit' ); ?>
					</h1>
				</header> <!-- .page__header -->



				<div class="page__content">
					<p>
						<?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. The page has probably been moved or deleted.', 'riiskit' ); ?>
					</p>
				</div> <!-- .page__content -->

			</section> <!-- .error-404 .not-found -->

		</main> <!-- .content -->
	</div> <!-- .primary -->

<?php get_footer(); ?>
