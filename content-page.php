<?php
/**
 * The template used for displaying page content
 *
 * @package Wordpress
 * @subpackage Riiskit
 * @since Riiskit 1.0.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry__header">
		<h1 class="entry__header__title">
			<?php the_title(); ?>
		</h1>
	</header> <!-- .entry__header -->



	<div class="entry__content">
		<?php
		the_content();



		wp_link_pages( array(
			'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'riiskit' ) . '</span>',
			'after'       => '</div>',
			'link_before' => '<span>',
			'link_after'  => '</span>',
			'pagelink'    => '<span class="screenreader">' . __( 'Page', 'riiskit' ) . ' </span>%',
			'separator'   => '<span class="screenreader">, </span>',
		) );
		?>
	</div> <!-- .entry__content -->

</article> <!-- #post-## -->
