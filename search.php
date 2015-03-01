<?php
/**
 * The template for displaying search results pages.
 *
 * @package WordPress
 * @subpackage Riiskit
 * @since Riiskit 1.0
 */

get_header(); ?>

	<section id="primary" class="primary">
		<main class="content" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="content__header">
				<h1 class="content__title">
					<?php printf( __( 'Search Results for: %s', 'riiskit' ), get_search_query() ); ?>
				</h1>
			</header> <!-- .content__header -->



			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'content', 'search' );

			endwhile;



			the_posts_pagination( array(
				'prev_text'          => __( 'Previous page', 'riiskit' ),
				'next_text'          => __( 'Next page', 'riiskit' ),
				'before_page_number' => '<span class="meta-nav screenreader">' . __( 'Page', 'riiskit' ) . ' </span>',
			) );

		else :
			get_template_part( 'content', 'none' );

		endif;
		?>

		</main> <!-- .content -->
	</section> <!-- .primary -->

<?php get_footer(); ?>
