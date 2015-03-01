<?php
/**
 * The Template for displaying all single posts and attachments.
 *
 * @package Wordpress
 * @subpackage Riiskit
 * @since Riiskit 1.0.0
 */

get_header(); ?>

	<section id="primary" class="primary">
		<main class="content" role="main">

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'content' );



			the_post_navigation( array(
				'next_text' => '<span class="screenreader">' . __( 'Next post:', 'riiskit' ) . '</span> ' .
					'<span class="post-title">%title</span>',
				'prev_text' => '<span class="screenreader">' . __( 'Previous post:', 'riiskit' ) . '</span> ' .
					'<span class="post-title">%title</span>',
			) );



			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile;
		?>

		</main> <!-- .content -->
	</section> <!-- .primary -->

<?php get_footer(); ?>
