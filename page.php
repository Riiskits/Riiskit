<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other 'pages' on your WordPress site will use a different template.
 *
 * @package Wordpress
 * @subpackage Riiskit
 * @since Riiskit 1.0.0
 */

get_header(); ?>

	<section class="primary">
		<main class="content" role="main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'content', 'page' );



				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile;
			?>

		</main> <!-- .content -->
	</section> <!-- .primary -->

<?php get_footer(); ?>
