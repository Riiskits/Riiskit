<?php
/**
 * Template Name: Template
 *
 * Description: A page template that…
 *
 * @package WordPress
 * @subpackage Riiskit
 *
 * @since Riiskit 1.0.0
 */

get_header(); ?>

	<div class="primary">
		<main class="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

			<?php endwhile; ?>

		</main> <!-- .content -->
	</div> <!-- .primary -->

<?php get_footer(); ?>
